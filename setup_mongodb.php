<?php
/**
 * MongoDB Database Setup Script
 * Run this file once to initialize your MongoDB database with collections and sample data
 */

require_once __DIR__ . '/vendor/autoload.php';

use MongoDB\Client;
use MongoDB\Driver\ServerApi;

// Your MongoDB Atlas connection string
$mongoUri = "mongodb+srv://hari1:hari1@cluster0.a96iriq.mongodb.net/?appName=Cluster0";
$dbName = "close_to_saginaw";

echo "========================================\n";
echo "MongoDB Database Setup for Close to Saginaw\n";
echo "========================================\n\n";

try {
    // Create MongoDB client
    $apiVersion = new ServerApi(ServerApi::V1);
    $client = new Client($mongoUri, [], ['serverApi' => $apiVersion]);
    
    // Select database
    $db = $client->selectDatabase($dbName);
    
    // Test connection
    echo "✓ Connected to MongoDB Atlas\n";
    $db->command(['ping' => 1]);
    echo "✓ Database '$dbName' is accessible\n\n";
    
    // Create collections and insert sample data
    
    // 1. Admin Users Collection
    echo "Creating admin_users collection...\n";
    $adminUsers = $db->selectCollection('admin_users');
    
    // Create unique index on username
    $adminUsers->createIndex(['username' => 1], ['unique' => true]);
    $adminUsers->createIndex(['email' => 1]);
    
    // Insert default admin (password: admin123)
    $result = $adminUsers->insertOne([
        'username' => 'admin',
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
        'full_name' => 'System Administrator',
        'email' => 'admin@closetosaginaw.com',
        'role' => 'super_admin',
        'is_active' => true,
        'last_login' => null,
        'created_at' => new MongoDB\BSON\UTCDateTime(),
        'updated_at' => new MongoDB\BSON\UTCDateTime()
    ]);
    echo "✓ Admin user created (username: admin, password: admin123)\n\n";
    
    // 2. Testimonials Collection
    echo "Creating testimonials collection...\n";
    $testimonials = $db->selectCollection('testimonials');
    $testimonials->createIndex(['approved' => 1]);
    $testimonials->createIndex(['is_featured' => 1]);
    
    $sampleTestimonials = [
        [
            'author_name' => 'Jennifer M.',
            'relationship' => 'Family Member',
            'rating' => 5,
            'testimonial_text' => 'My mom has been living at Close to Saginaw for just over one year. The staff has been fantastic not only with my mom but with me also. They truly make everyone feel like family. My questions or concerns have always been addressed in a timely manner.',
            'is_featured' => true,
            'created_at' => new MongoDB\BSON\UTCDateTime(),
            'approved' => true,
            'approved_by' => null,
            'approved_at' => new MongoDB\BSON\UTCDateTime()
        ],
        [
            'author_name' => 'Robert T.',
            'relationship' => 'Family Member',
            'rating' => 5,
            'testimonial_text' => 'This is the cleanest, most home-like assisted living facility I have ever been in. The staff is extraordinarily friendly and helpful. My dad receives excellent care and I can see how happy he is every time I visit.',
            'is_featured' => true,
            'created_at' => new MongoDB\BSON\UTCDateTime(),
            'approved' => true,
            'approved_by' => null,
            'approved_at' => new MongoDB\BSON\UTCDateTime()
        ],
        [
            'author_name' => 'Sarah P.',
            'relationship' => 'Family Member',
            'rating' => 5,
            'testimonial_text' => 'The memory care program here is outstanding. My mother\'s quality of life has improved dramatically since moving in. The activities keep her engaged, and the specialized care team truly understands her needs. We are so grateful.',
            'is_featured' => true,
            'created_at' => new MongoDB\BSON\UTCDateTime(),
            'approved' => true,
            'approved_by' => null,
            'approved_at' => new MongoDB\BSON\UTCDateTime()
        ],
        [
            'author_name' => 'Michael D.',
            'relationship' => 'Son',
            'rating' => 5,
            'testimonial_text' => 'After visiting several facilities, we chose Close to Saginaw for my father and it was the best decision. The care is exceptional and the community is warm and welcoming.',
            'is_featured' => false,
            'created_at' => new MongoDB\BSON\UTCDateTime(),
            'approved' => true,
            'approved_by' => null,
            'approved_at' => new MongoDB\BSON\UTCDateTime()
        ]
    ];
    
    $testimonials->insertMany($sampleTestimonials);
    echo "✓ Inserted " . count($sampleTestimonials) . " sample testimonials\n\n";
    
    // 3. Staff Members Collection
    echo "Creating staff_members collection...\n";
    $staffMembers = $db->selectCollection('staff_members');
    
    $sampleStaff = [
        [
            'first_name' => 'Emily',
            'last_name' => 'Johnson',
            'email' => 'ejohnson@closetosaginaw.com',
            'phone' => '989-555-0101',
            'position' => 'Director of Nursing',
            'department' => 'nursing',
            'hire_date' => new MongoDB\BSON\UTCDateTime(strtotime('2020-01-15') * 1000),
            'status' => 'active',
            'certifications' => 'RN, BSN',
            'notes' => '',
            'created_at' => new MongoDB\BSON\UTCDateTime(),
            'updated_at' => new MongoDB\BSON\UTCDateTime()
        ],
        [
            'first_name' => 'Michael',
            'last_name' => 'Brown',
            'email' => 'mbrown@closetosaginaw.com',
            'phone' => '989-555-0102',
            'position' => 'Activities Coordinator',
            'department' => 'activities',
            'hire_date' => new MongoDB\BSON\UTCDateTime(strtotime('2021-03-20') * 1000),
            'status' => 'active',
            'certifications' => '',
            'notes' => '',
            'created_at' => new MongoDB\BSON\UTCDateTime(),
            'updated_at' => new MongoDB\BSON\UTCDateTime()
        ],
        [
            'first_name' => 'Sarah',
            'last_name' => 'Davis',
            'email' => 'sdavis@closetosaginaw.com',
            'phone' => '989-555-0103',
            'position' => 'Head Chef',
            'department' => 'dining',
            'hire_date' => new MongoDB\BSON\UTCDateTime(strtotime('2019-06-01') * 1000),
            'status' => 'active',
            'certifications' => 'ServSafe Certified',
            'notes' => '',
            'created_at' => new MongoDB\BSON\UTCDateTime(),
            'updated_at' => new MongoDB\BSON\UTCDateTime()
        ],
        [
            'first_name' => 'James',
            'last_name' => 'Wilson',
            'email' => 'jwilson@closetosaginaw.com',
            'phone' => '989-555-0104',
            'position' => 'Maintenance Supervisor',
            'department' => 'maintenance',
            'hire_date' => new MongoDB\BSON\UTCDateTime(strtotime('2020-09-10') * 1000),
            'status' => 'active',
            'certifications' => '',
            'notes' => '',
            'created_at' => new MongoDB\BSON\UTCDateTime(),
            'updated_at' => new MongoDB\BSON\UTCDateTime()
        ]
    ];
    
    $staffMembers->insertMany($sampleStaff);
    echo "✓ Inserted " . count($sampleStaff) . " sample staff members\n\n";
    
    // 4. Create other collections with indexes
    echo "Creating additional collections...\n";
    
    // Contact Inquiries
    $contactInquiries = $db->selectCollection('contact_inquiries');
    $contactInquiries->createIndex(['status' => 1]);
    $contactInquiries->createIndex(['created_at' => -1]);
    echo "✓ contact_inquiries collection created\n";
    
    // Tour Requests
    $tourRequests = $db->selectCollection('tour_requests');
    $tourRequests->createIndex(['status' => 1]);
    $tourRequests->createIndex(['preferred_date' => 1]);
    echo "✓ tour_requests collection created\n";
    
    // Residents
    $residents = $db->selectCollection('residents');
    $residents->createIndex(['status' => 1]);
    $residents->createIndex(['care_level' => 1]);
    $residents->createIndex(['room_number' => 1]);
    echo "✓ residents collection created\n";
    
    // Medications
    $medications = $db->selectCollection('medications');
    $medications->createIndex(['resident_id' => 1]);
    $medications->createIndex(['is_active' => 1]);
    echo "✓ medications collection created\n";
    
    // Care Plans
    $carePlans = $db->selectCollection('care_plans');
    $carePlans->createIndex(['resident_id' => 1]);
    echo "✓ care_plans collection created\n";
    
    // Activity Log
    $activityLog = $db->selectCollection('activity_log');
    $activityLog->createIndex(['user_id' => 1]);
    $activityLog->createIndex(['created_at' => -1]);
    echo "✓ activity_log collection created\n";
    
    echo "\n========================================\n";
    echo "✓ Setup Complete!\n";
    echo "========================================\n\n";
    echo "Database: $dbName\n";
    echo "Collections created: 9\n";
    echo "Indexes created: 15\n\n";
    echo "Default Admin Login:\n";
    echo "  Username: admin\n";
    echo "  Password: admin123\n";
    echo "  ⚠️  CHANGE THIS PASSWORD AFTER FIRST LOGIN!\n\n";
    echo "Next Steps:\n";
    echo "1. Your website is ready to use!\n";
    echo "2. Visit your website and test the connection\n";
    echo "3. Log in to admin panel and change the default password\n";
    echo "4. Start adding your content!\n\n";
    
} catch (Exception $e) {
    echo "✗ Error: " . $e->getMessage() . "\n";
    echo "\nPlease check:\n";
    echo "1. Your MongoDB connection string is correct\n";
    echo "2. Your IP address is whitelisted in MongoDB Atlas\n";
    echo "3. Your database user credentials are correct\n";
    exit(1);
}
?>
