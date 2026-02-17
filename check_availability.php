<?php
header('Content-Type: application/json');

// Include MongoDB configuration
require_once 'includes/config.php';

// Get parameters
$date = isset($_GET['date']) ? trim($_GET['date']) : '';
$location = isset($_GET['location']) ? trim($_GET['location']) : '';

// Validate input
if (empty($date) || empty($location)) {
    echo json_encode([
        'success' => false,
        'error' => 'Missing parameters',
        'booked_slots' => []
    ]);
    exit;
}

try {
    // Get tour_requests collection
    $collection = getCollection('tour_requests');
    
    // Query MongoDB for bookings at this location (not cancelled)
    $filter = [
        'location' => $location,
        'status' => ['$ne' => 'cancelled']
    ];
    
    $options = [
        'projection' => ['preferred_date' => 1, 'preferred_time' => 1, '_id' => 0]
    ];
    
    $cursor = $collection->find($filter, $options);
    
    $booked_slots = [];
    
    // Loop through all bookings and check if they match the selected date
    foreach ($cursor as $document) {
        if (isset($document['preferred_date']) && isset($document['preferred_time'])) {
            
            // Convert MongoDB UTCDateTime to PHP DateTime and format as YYYY-MM-DD
            $bookingDate = $document['preferred_date']->toDateTime()->format('Y-m-d');
            
            // If this booking is for the selected date, add the time to booked slots
            if ($bookingDate === $date) {
                $booked_slots[] = $document['preferred_time'];
            }
        }
    }
    
    // Return JSON response
    echo json_encode([
        'success' => true,
        'booked_slots' => $booked_slots,
        'date' => $date,
        'location' => $location
    ]);
    
} catch (Exception $e) {
    error_log("Availability check error: " . $e->getMessage());
    echo json_encode([
        'success' => false,
        'error' => 'Query failed: ' . $e->getMessage(),
        'booked_slots' => []
    ]);
}
?>