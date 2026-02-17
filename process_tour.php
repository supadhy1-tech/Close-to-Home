<?php
/**
 * Process Tour Request Form - MongoDB Version with Dual Email Notifications
 * Enhanced with Double-Booking Prevention
 * Sends emails to: 1) Admin (owner) and 2) Customer (confirmation)
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
$preferred_date = trim($_POST['preferred_date'] ?? '');
$preferred_time = trim($_POST['preferred_time'] ?? '');
$number_of_guests = (int)($_POST['number_of_guests'] ?? 1);
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

if (empty($preferred_date)) {
    $errors[] = "Preferred date is required";
}

if (empty($preferred_time)) {
    $errors[] = "Preferred time is required";
}

// If there are errors, redirect back with errors
if (!empty($errors)) {
    $_SESSION['errors'] = $errors;
    $_SESSION['form_data'] = $_POST;
    header('Location: contact.php#tour-section');
    exit;
}

try {
    // Get tour_requests collection
    $collection = getCollection('tour_requests');
    
    // Initialize indexes on first run (safe to call multiple times)
    static $indexesInitialized = false;
    if (!$indexesInitialized) {
        initializeMongoDBIndexes();
        $indexesInitialized = true;
    }
    
    // Convert date string to MongoDB date
    $dateTimestamp = strtotime($preferred_date);
    $mongoDate = new UTCDateTime($dateTimestamp * 1000);
    
    // **DOUBLE BOOKING PREVENTION**
    // Check if the time slot is already booked
    $startOfDay = new MongoDB\BSON\UTCDateTime($dateTimestamp * 1000);
    $endOfDay = new MongoDB\BSON\UTCDateTime(($dateTimestamp + 86400) * 1000);
    
    $existingBooking = $collection->findOne([
        'preferred_date' => [
            '$gte' => $startOfDay,
            '$lt' => $endOfDay
        ],
        'preferred_time' => $preferred_time,
        'location' => $location,
        'status' => ['$ne' => 'cancelled']
    ]);
    
    if ($existingBooking) {
        $_SESSION['errors'] = ["Sorry, this time slot is already booked. Please select a different time."];
        $_SESSION['form_data'] = $_POST;
        header('Location: contact.php#tour-section');
        exit;
    }
    
    // Prepare document
    $document = [
        'name' => $name,
        'email' => $email,
        'phone' => $phone,
        'preferred_date' => $mongoDate,
        'preferred_time' => $preferred_time,
        'number_of_guests' => $number_of_guests,
        'message' => $message,
        'location' => $location,
        'created_at' => new UTCDateTime(),
        'status' => 'pending',
        'confirmed_date' => null,
        'confirmed_time' => null,
        'assigned_to' => null,
        'notes' => ''
    ];
    
    // Insert document
    $result = $collection->insertOne($document);
    
    if ($result->getInsertedCount() > 0) {
        // Send email to admin (owner)
        $adminEmailSent = sendAdminNotificationEmail($name, $email, $phone, $location, $preferred_date, $preferred_time, $number_of_guests, $message);
        
        if (!$adminEmailSent) {
            error_log("Admin notification email failed for tour request from: $email");
        }
        
        // Send confirmation email to customer
        $customerEmailSent = sendCustomerConfirmationEmail($name, $email, $location, $preferred_date, $preferred_time, $number_of_guests);
        
        if (!$customerEmailSent) {
            error_log("Customer confirmation email failed for: $email");
        }
        
        $_SESSION['success'] = "Thank you for requesting a tour! We've sent a confirmation to your email and will contact you soon.";
        header('Location: contact.php?tour_success=1');
        exit;
    } else {
        throw new Exception("Failed to submit tour request");
    }
    
} catch (Exception $e) {
    $_SESSION['errors'] = ["An error occurred. Please try again later."];
    error_log("Tour request error: " . $e->getMessage());
    header('Location: contact.php#tour-section');
    exit;
}

/**
 * Send notification email to admin/owner
 * Returns true on success, false on failure
 */
function sendAdminNotificationEmail($name, $email, $phone, $location, $preferred_date, $preferred_time, $number_of_guests, $message) {
    
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

        $mail->setFrom('notifications@saginawclosetohome.com', 'Close to Saginaw Website');
        $mail->addAddress('notifications@saginawclosetohome.com', 'Close to Home');
        // $mail->addAddress('saginaw2160@gmail.com', 'Owner');
        $mail->addAddress('upadhyayashish853@gmail.com','Ashish Upadhyay');
        $mail->addReplyTo($email, $name);

        

        
        // Content
        $mail->isHTML(true);
        $mail->Subject = '🔔 New Tour Request - Close to Home';
        
        $locationDisplay = ucfirst($location);
        $phoneFormatted = formatPhone($phone);
        
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
                .highlight { background: #e8f5e9; padding: 10px; border-radius: 4px; margin-top: 20px; text-align: center; }
            </style>
        </head>
        <body>
            <div class='container'>
                <div class='header'>
                    <h2>🔔 New Tour Request Received</h2>
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
                    
                    <div class='highlight'>
                        <div class='label' style='margin-bottom: 10px;'>📅 Tour Details</div>
                        <div style='font-size: 18px; color: #1a4d2e;'><strong>{$preferred_date}</strong> at <strong>{$preferred_time}</strong></div>
                        <div style='margin-top: 5px; color: #666;'>{$number_of_guests} guest(s)</div>
                    </div>
                    
                    " . (!empty($message) ? "
                    <div class='field'>
                        <span class='label'>💬 Message</span>
                        <div class='message-box'>{$message}</div>
                    </div>
                    " : "") . "
                    
                    <div style='margin-top: 30px; padding: 15px; background: #1a4d2e; color: white; text-align: center; border-radius: 4px;'>
                        <strong>Action Required:</strong> Please contact {$name} to confirm the tour appointment.
                    </div>
                </div>
                <div class='footer'>
                    <p>This request was submitted through the Close to Saginaw website.</p>
                    <p>Reply directly to this email to contact {$name}.</p>
                </div>
            </div>
        </body>
        </html>
        ";
        
        $mail->AltBody = "NEW TOUR REQUEST\n\n" .
                         "Name: {$name}\n" .
                         "Email: {$email}\n" .
                         "Phone: {$phoneFormatted}\n" .
                         "Location: {$locationDisplay}\n" .
                         "Preferred Date: {$preferred_date}\n" .
                         "Preferred Time: {$preferred_time}\n" .
                         "Number of Guests: {$number_of_guests}\n" .
                         (!empty($message) ? "Message: {$message}\n" : "") .
                         "\n---\n" .
                         "Please contact {$name} at {$email} or {$phoneFormatted} to confirm the tour.";
        
        $mail->send();
        return true;
        
    } catch (Exception $e) {
        error_log("PHPMailer Error (Admin Email): {$mail->ErrorInfo}");
        return false;
    }
}

/**
 * Send confirmation email to customer
 * Returns true on success, false on failure
 */
function sendCustomerConfirmationEmail($name, $email, $location, $preferred_date, $preferred_time, $number_of_guests) {
    
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
        $mail->addReplyTo('notifications@saginawclosetohome.com', 'Close to Saginaw');

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'Tour Request Confirmation - Close to Saginaw';
        
        $locationDisplay = ucfirst($location);
        $firstName = explode(' ', $name)[0]; // Get first name
        
        // Determine contact phone based on location
        $contactPhone = ($location === 'baycity') ? '(989) 316-2697' : '(989) 401-3581';
        
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
                .confirmation-box { background: #e8f5e9; padding: 25px; border-radius: 8px; margin: 30px 0; border-left: 4px solid #1a4d2e; }
                .confirmation-box h2 { margin: 0 0 15px 0; color: #1a4d2e; font-size: 20px; }
                .detail-row { display: flex; justify-content: space-between; padding: 10px 0; border-bottom: 1px solid #d4e8d8; }
                .detail-row:last-child { border-bottom: none; }
                .detail-label { font-weight: bold; color: #1a4d2e; }
                .detail-value { color: #333; }
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
                .btn { display: inline-block; background: #d4a373; color: white; padding: 12px 30px; text-decoration: none; border-radius: 5px; margin: 10px 0; font-weight: bold; }
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
                    
                    <p>Thank you for requesting a tour of Close to Saginaw! We're delighted that you're considering our community for yourself or your loved one.</p>
                    
                    <div class='confirmation-box'>
                        <h2>✓ Your Tour Request Has Been Received</h2>
                        <div class='detail-row'>
                            <span class='detail-label'>📍 Location:</span>
                            <span class='detail-value'>{$locationDisplay}</span>
                        </div>
                        <div class='detail-row'>
                            <span class='detail-label'>📅 Preferred Date:</span>
                            <span class='detail-value'>{$preferred_date}</span>
                        </div>
                        <div class='detail-row'>
                            <span class='detail-label'>⏰ Preferred Time:</span>
                            <span class='detail-value'>{$preferred_time}</span>
                        </div>
                        <div class='detail-row'>
                            <span class='detail-label'>👥 Number of Guests:</span>
                            <span class='detail-value'>{$number_of_guests}</span>
                        </div>
                    </div>
                    
                    <div class='next-steps'>
                        <h3>What Happens Next?</h3>
                        <ul>
                            <li>Our team will review your request within 24 hours</li>
                            <li>We'll contact you to confirm your tour date and time</li>
                            <li>You'll receive directions and parking information</li>
                            <li>Feel free to prepare any questions you'd like to ask during your visit</li>
                        </ul>
                    </div>
                    
                    <p>During your tour, you'll have the opportunity to:</p>
                    <ul style='color: #666; margin-left: 20px;'>
                        <li>Explore our beautiful facility and amenities</li>
                        <li>Meet our compassionate care team</li>
                        <li>Learn about our personalized care programs</li>
                        <li>Ask questions about our services and pricing</li>
                        <li>See resident rooms and common areas</li>
                    </ul>
                    
                    <div class='contact-box'>
                        <h3>Need to Reach Us?</h3>
                        <p>📞 <a href='tel:{$contactPhone}'>{$contactPhone}</a></p>
                        <p>📧 <a href='mailto:saginaw2160@gmail.com'>saginaw2160@gmail.com</a></p>
                        <p style='margin-top: 15px; font-size: 14px; color: #d4a373;'>We're here Monday - Friday, 9 AM - 5 PM</p>
                    </div>
                    
                    <p style='margin-top: 30px;'>We look forward to meeting you and showing you why families trust Close to Saginaw for their loved ones' care.</p>
                    
                    <p style='margin-top: 20px;'>Warm regards,<br>
                    <strong style='color: #1a4d2e;'>The Close to Saginaw Team</strong></p>
                </div>
                
                <div class='footer'>
                    <p><strong>Close to Saginaw</strong></p>
                    <p>Zilwaukee, Michigan</p>
                    <p style='margin-top: 15px;'>© " . date('Y') . " Close to Saginaw. All rights reserved.</p>
                    <p style='margin-top: 10px; font-size: 11px;'>
                        This email was sent because you requested a tour on our website.<br>
                        If you did not make this request, please disregard this email.
                    </p>
                </div>
            </div>
        </body>
        </html>
        ";
        
        $mail->AltBody = "Dear {$firstName},\n\n" .
                         "Thank you for requesting a tour of Close to Saginaw!\n\n" .
                         "TOUR REQUEST CONFIRMATION\n" .
                         "------------------------\n" .
                         "Location: {$locationDisplay}\n" .
                         "Preferred Date: {$preferred_date}\n" .
                         "Preferred Time: {$preferred_time}\n" .
                         "Number of Guests: {$number_of_guests}\n\n" .
                         "WHAT HAPPENS NEXT?\n" .
                         "- Our team will review your request within 24 hours\n" .
                         "- We'll contact you to confirm your tour date and time\n" .
                         "- You'll receive directions and parking information\n\n" .
                         "CONTACT US:\n" .
                         "Phone: {$contactPhone}\n" .
                         "Email: saginaw2160@gmail.com\n\n" .
                         "We look forward to meeting you!\n\n" .
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