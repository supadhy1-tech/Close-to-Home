<?php
require_once 'includes/config.php';
// require_once 'includes/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Validate and sanitize inputs
    $location = isset($_POST['location']) ? htmlspecialchars(trim($_POST['location'])) : 'saginaw';
    $author_name = htmlspecialchars(trim($_POST['author_name']));
    $relationship = htmlspecialchars(trim($_POST['relationship']));
    $rating = intval($_POST['rating']);
    $testimonial_text = htmlspecialchars(trim($_POST['testimonial_text']));
    
    // Validate required fields
    if (empty($author_name) || empty($relationship) || empty($testimonial_text) || $rating < 1 || $rating > 5) {
        header('Location: experiences.php?error=missing_fields&location=' . $location);
        exit();
    }
    
    // Validate location
    if (!in_array($location, ['saginaw', 'baycity'])) {
        $location = 'saginaw'; // Default fallback
    }
    
    try {
        // Get testimonials collection
        $testimonialsCollection = getCollection('testimonials');
        
        // Create document to insert
        $document = [
            'location' => $location,
            'author_name' => $author_name,
            'relationship' => $relationship,
            'rating' => $rating,
            'testimonial_text' => $testimonial_text,
            'approved' => false, // Pending admin approval
            'is_featured' => false,
            'created_at' => new MongoDB\BSON\UTCDateTime()
        ];
        
        // Insert document
        $result = $testimonialsCollection->insertOne($document);
        
        if ($result->getInsertedCount() === 1) {
            header('Location: experiences.php?success=testimonial&location=' . $location);
            exit();
        } else {
            header('Location: experiences.php?error=database&location=' . $location);
            exit();
        }
    } catch (Exception $e) {
        // Log error for debugging
        error_log("Testimonial submission error: " . $e->getMessage());
        header('Location: experiences.php?error=database&location=' . $location);
        exit();
    }
} else {
    header('Location: experiences.php');
    exit();
}
?>