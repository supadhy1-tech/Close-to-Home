<?php
/**
 * Process Contact/Inquiry Form - MongoDB Version with Dual Email Notifications
 * Sends emails to: 1) Admin (owner) and 2) Customer (auto-reply)
 */
session_start();

require_once 'includes/config.php';
require_once 'vendor/autoload.php'; // Composer autoloader - loads PHPMailer automatically

use MongoDB\BSON\UTCDateTime;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Only allow POST requests
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: contact.php');
    exit;
}

// Sanitize and validate input
$name = trim($_POST['name'] ?? '');
$email = trim($_POST['email'] ?? '');
$phone = trim($_POST['phone'] ?? '');
$care_type = trim($_POST['care_type'] ?? '');
$message = trim($_POST['message'] ?? '');
$location = trim($_POST['location'] ?? 'saginaw');

$errors = [];

// Validation
if (empty($name)) {
    $errors[] = "Name is required";
}

if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = "Valid email is required";
}

if (empty($phone)) {
    $errors[] = "Phone number is required";
}

if (empty($message)) {
    $errors[] = "Message is required";
}

// If there are errors, redirect back with errors
if (!empty($errors)) {
    $_SESSION['errors'] = $errors;
    $_SESSION['form_data'] = $_POST;
    header('Location: contact.php');
    exit;
}

try {
    // Get contact_inquiries collection
    $collection = getCollection('contact_inquiries');
    
    // Prepare document
    $document = [
        'name' => $name,
        'email' => $email,
        'phone' => $phone,
        'care_type' => $care_type,
        'message' => $message,
        'location' => $location,
        'created_at' => new UTCDateTime(),
        'status' => 'new',
        'assigned_to' => null,
        'notes' => ''
    ];
    
    // Insert document
    $result = $collection->insertOne($document);
    
    if ($result->getInsertedCount() > 0) {
        // Send email to admin (owner)
        $adminEmailSent = sendAdminNotificationEmail($name, $email, $phone, $location, $care_type, $message);
        
        if (!$adminEmailSent) {
            error_log("Admin notification email failed for contact inquiry from: $email");
        }
        
        // Send auto-reply email to customer
        $customerEmailSent = sendCustomerAutoReplyEmail($name, $email, $location);
        
        if (!$customerEmailSent) {
            error_log("Customer auto-reply email failed for: $email");
        }
        
        $_SESSION['success'] = "Thank you for your inquiry! We've sent a confirmation to your email and will contact you soon.";
        header('Location: contact.php?success=1');
        exit;
    } else {
        throw new Exception("Failed to submit inquiry");
    }
    
} catch (Exception $e) {
    $_SESSION['errors'] = ["An error occurred. Please try again later."];
    error_log("Contact inquiry error: " . $e->getMessage());
    header('Location: contact.php');
    exit;
}

/**
 * Send notification email to admin/owner
 * Returns true on success, false on failure
 */
function sendAdminNotificationEmail($name, $email, $phone, $location, $care_type, $message) {
    
    $mail = new PHPMailer(true);
    
    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.zoho.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'notifications@saginawclosetohome.com';
        $mail->Password   = '7ar2JUiZBif1'; // generate from Zoho account
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        $mail->setFrom('notifications@saginawclosetohome.com', 'Close to Saginaw');
        $mail->addAddress($email, $name); // Send to customer
        // $mail->addAddress('saginaw2160@gmail.com', 'Owner'); // Send to owner
        $mail->addAddress('upadhyayashish853@gmail.com ','Ashish Upadhyay'); // Send to developer for testing
        $mail->addReplyTo('notifications@saginawclosetohome.com', 'Close to Saginaw');


        
        // Content
        $mail->isHTML(true);
        $mail->Subject = '📬 New Contact Inquiry - Close to Saginaw';
        
        $locationDisplay = ucfirst($location);
        $phoneFormatted = formatPhone($phone);
        $careTypeDisplay = !empty($care_type) ? ucwords(str_replace('_', ' ', $care_type)) : 'Not specified';
        
        $mail->Body = "
        <html>
        <head>
            <style>
                body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
                .container { max-width: 600px; margin: 0 auto; padding: 20px; background: #fff; }
                .header { background: #1a4d2e; color: white; padding: 20px; text-align: center; border-radius: 8px 8px 0 0; }
                .header h2 { margin: 0; font-size: 24px; }
                .content { background: #f9f9f9; padding: 30px; border: 1px solid #ddd; border-top: none; border-radius: 0 0 8px 8px; }
                .field { margin-bottom: 20px; padding: 15px; background: white; border-left: 4px solid #d4a373; border-radius: 4px; }
                .label { font-weight: bold; color: #1a4d2e; font-size: 14px; text-transform: uppercase; display: block; margin-bottom: 5px; }
                .value { color: #333; font-size: 16px; }
                .message-box { background: #fff9e6; padding: 15px; border-left: 4px solid #d4a373; border-radius: 4px; margin-top: 10px; }
                .footer { text-align: center; padding: 20px; color: #666; font-size: 12px; }
                .action-box { margin-top: 30px; padding: 15px; background: #1a4d2e; color: white; text-align: center; border-radius: 4px; }
            </style>
        </head>
        <body>
            <div class='container'>
                <div class='header'>
                    <h2>📬 New Contact Inquiry Received</h2>
                </div>
                <div class='content'>
                    <div class='field'>
                        <span class='label'>👤 Name</span>
                        <span class='value'>{$name}</span>
                    </div>
                    
                    <div class='field'>
                        <span class='label'>📧 Email</span>
                        <span class='value'><a href='mailto:{$email}' style='color: #1a4d2e;'>{$email}</a></span>
                    </div>
                    
                    <div class='field'>
                        <span class='label'>📱 Phone</span>
                        <span class='value'><a href='tel:{$phone}' style='color: #1a4d2e;'>{$phoneFormatted}</a></span>
                    </div>
                    
                    <div class='field'>
                        <span class='label'>📍 Location</span>
                        <span class='value'>{$locationDisplay}</span>
                    </div>
                    
                    <div class='field'>
                        <span class='label'>🏥 Care Type Interest</span>
                        <span class='value'>{$careTypeDisplay}</span>
                    </div>
                    
                    <div class='field'>
                        <span class='label'>💬 Message</span>
                        <div class='message-box'>{$message}</div>
                    </div>
                    
                    <div class='action-box'>
                        <strong>Action Required:</strong> Please contact {$name} to respond to their inquiry.
                    </div>
                </div>
                <div class='footer'>
                    <p>This inquiry was submitted through the Close to Saginaw website contact form.</p>
                    <p>Reply directly to this email to contact {$name}.</p>
                </div>
            </div>
        </body>
        </html>
        ";
        
        $mail->AltBody = "NEW CONTACT INQUIRY\n\n" .
                         "Name: {$name}\n" .
                         "Email: {$email}\n" .
                         "Phone: {$phoneFormatted}\n" .
                         "Location: {$locationDisplay}\n" .
                         "Care Type Interest: {$careTypeDisplay}\n" .
                         "Message: {$message}\n" .
                         "\n---\n" .
                         "Please contact {$name} at {$email} or {$phoneFormatted} to respond to their inquiry.";
        
        $mail->send();
        return true;
        
    } catch (Exception $e) {
        error_log("PHPMailer Error (Admin Email): {$mail->ErrorInfo}");
        return false;
    }
}

/**
 * Send auto-reply email to customer
 * Returns true on success, false on failure
 */
function sendCustomerAutoReplyEmail($name, $email, $location) {
    
    $mail = new PHPMailer(true);
    
    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.zoho.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'notifications@saginawclosetohome.com';
        $mail->Password   = '7ar2JUiZBif1';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        $mail->setFrom('notifications@saginawclosetohome.com', 'Close to Saginaw');
        $mail->addAddress($email, $name); // Customer
        $mail->addReplyTo('notifications@saginawclosetohome.com', 'Close to Saginaw');

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'Thank You for Contacting Close to Saginaw';
        
        $firstName = explode(' ', $name)[0]; // Get first name
        
        // Determine contact phone based on location
        $contactPhone = ($location === 'bay_city') ? '(989) 316-2697' : '(989) 401-3581';
        
        $mail->Body = "
        <html>
        <head>
            <style>
                body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; margin: 0; padding: 0; }
                .container { max-width: 600px; margin: 0 auto; padding: 20px; }
                .header { background: linear-gradient(135deg, #1a4d2e 0%, #2d7a4c 100%); color: white; padding: 40px 20px; text-align: center; border-radius: 8px 8px 0 0; }
                .header h1 { margin: 0 0 10px 0; font-size: 28px; font-weight: 300; }
                .header p { margin: 0; font-size: 16px; color: #d4a373; }
                .content { background: #fff; padding: 40px 30px; border: 1px solid #ddd; border-top: none; }
                .greeting { font-size: 18px; color: #1a4d2e; margin-bottom: 20px; }
                .confirmation-box { background: #e8f5e9; padding: 25px; border-radius: 8px; margin: 30px 0; border-left: 4px solid #1a4d2e; text-align: center; }
                .confirmation-box h2 { margin: 0 0 10px 0; color: #1a4d2e; font-size: 20px; }
                .confirmation-box p { margin: 5px 0; color: #666; }
                .next-steps { background: #f9f9f9; padding: 20px; border-radius: 8px; margin: 20px 0; }
                .next-steps h3 { margin: 0 0 15px 0; color: #1a4d2e; font-size: 18px; }
                .next-steps ul { margin: 0; padding-left: 20px; }
                .next-steps li { margin-bottom: 10px; color: #666; }
                .contact-box { background: #1a4d2e; color: white; padding: 25px; border-radius: 8px; text-align: center; margin: 30px 0; }
                .contact-box h3 { margin: 0 0 15px 0; color: #d4a373; }
                .contact-box p { margin: 5px 0; font-size: 16px; }
                .contact-box a { color: white; text-decoration: none; font-weight: bold; }
                .footer { text-align: center; padding: 30px 20px; color: #666; font-size: 13px; border-top: 1px solid #ddd; }
                .footer p { margin: 5px 0; }
            </style>
        </head>
        <body>
            <div class='container'>
                <div class='header'>
                    <h1>Close to Saginaw</h1>
                    <p>Assisted Living & Memory Care</p>
                </div>
                
                <div class='content'>
                    <p class='greeting'>Dear {$firstName},</p>
                    
                    <p>Thank you for reaching out to Close to Saginaw! We appreciate your interest in our community and the opportunity to assist you or your loved one.</p>
                    
                    <div class='confirmation-box'>
                        <h2>✓ Your Inquiry Has Been Received</h2>
                        <p>We have received your message and will respond within 24 hours.</p>
                    </div>
                    
                    <div class='next-steps'>
                        <h3>What Happens Next?</h3>
                        <ul>
                            <li>A member of our care team will review your inquiry</li>
                            <li>We'll reach out to discuss your needs in detail</li>
                            <li>We can schedule a personalized tour of our facility</li>
                            <li>We'll answer any questions you have about our services</li>
                        </ul>
                    </div>
                    
                    <p>At Close to Saginaw, we provide:</p>
                    <ul style='color: #666; margin-left: 20px;'>
                        <li>Compassionate assisted living care</li>
                        <li>Specialized memory care services</li>
                        <li>Personalized care plans tailored to individual needs</li>
                        <li>A warm, home-like environment</li>
                        <li>Experienced and caring staff available 24/7</li>
                    </ul>
                    
                    <div class='contact-box'>
                        <h3>Need Immediate Assistance?</h3>
                        <p>📞 <a href='tel:{$contactPhone}'>{$contactPhone}</a></p>
                        <p>📧 <a href='mailto:saginaw2160@gmail.com'>saginaw2160@gmail.com</a></p>
                        <p style='margin-top: 15px; font-size: 14px; color: #d4a373;'>We're here Monday - Friday, 9 AM - 5 PM</p>
                    </div>
                    
                    <p style='margin-top: 30px;'>We look forward to speaking with you soon and helping you find the perfect care solution.</p>
                    
                    <p style='margin-top: 20px;'>Warm regards,<br>
                    <strong style='color: #1a4d2e;'>The Close to Saginaw Team</strong></p>
                </div>
                
                <div class='footer'>
                    <p><strong>Close to Saginaw</strong></p>
                    <p>Zilwaukee, Michigan</p>
                    <p style='margin-top: 15px;'>© " . date('Y') . " Close to Saginaw. All rights reserved.</p>
                    <p style='margin-top: 10px; font-size: 11px;'>
                        This email was sent because you submitted an inquiry on our website.<br>
                        If you did not make this request, please disregard this email.
                    </p>
                </div>
            </div>
        </body>
        </html>
        ";
        
        $mail->AltBody = "Dear {$firstName},\n\n" .
                         "Thank you for reaching out to Close to Saginaw!\n\n" .
                         "YOUR INQUIRY HAS BEEN RECEIVED\n" .
                         "--------------------------------\n" .
                         "We have received your message and will respond within 24 hours.\n\n" .
                         "WHAT HAPPENS NEXT?\n" .
                         "- A member of our care team will review your inquiry\n" .
                         "- We'll reach out to discuss your needs in detail\n" .
                         "- We can schedule a personalized tour of our facility\n" .
                         "- We'll answer any questions you have about our services\n\n" .
                         "NEED IMMEDIATE ASSISTANCE?\n" .
                         "Phone: {$contactPhone}\n" .
                         "Email: saginaw2160@gmail.com\n" .
                         "Hours: Monday - Friday, 9 AM - 5 PM\n\n" .
                         "We look forward to speaking with you soon!\n\n" .
                         "Warm regards,\n" .
                         "The Close to Saginaw Team";
        
        $mail->send();
        return true;
        
    } catch (Exception $e) {
        error_log("PHPMailer Error (Customer Email): {$mail->ErrorInfo}");
        return false;
    }
}

/**
 * Helper function to format phone numbers
 */
function formatPhone($phone) {
    $phone = preg_replace('/[^0-9]/', '', $phone);
    if (strlen($phone) == 10) {
        return '(' . substr($phone, 0, 3) . ') ' . substr($phone, 3, 3) . '-' . substr($phone, 6);
    }
    return $phone;
}
?>