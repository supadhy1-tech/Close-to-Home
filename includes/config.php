<?php
// MongoDB Configuration for Atlas
require_once __DIR__ . '/../vendor/autoload.php';

use MongoDB\Client;
use MongoDB\Driver\ServerApi;

// Load .env file for local development
if (file_exists(__DIR__ . '/../.env')) {
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/..');
    $dotenv->load();
}

// MongoDB Atlas Connection String - using environment variables
define('MONGODB_URI', $_ENV['MONGODB_URI'] ?? getenv('MONGODB_URI') ?? '');
define('DB_NAME', $_ENV['DB_NAME'] ?? getenv('DB_NAME') ?? 'close_to_saginaw');

// Global MongoDB client and database
$mongoClient = null;
$db = null;

try {
    if (empty(MONGODB_URI)) {
        die("MongoDB URI is not set. Please check your environment variables.");
    }

    // Specify Stable API version 1
    $apiVersion = new ServerApi(ServerApi::V1);
    
    // Create a new client and connect to the server
    $mongoClient = new Client(MONGODB_URI, [], ['serverApi' => $apiVersion]);
    
    // Select database
    $db = $mongoClient->selectDatabase(DB_NAME);
    
    // Ping the database to verify connection
    $db->command(['ping' => 1]);
    
} catch (Exception $e) {
    die("MongoDB Connection failed: " . $e->getMessage());
}

// Helper function to convert MongoDB document to array
function mongoToArray($document) {
    if ($document instanceof MongoDB\Model\BSONDocument) {
        return $document->getArrayCopy();
    }
    return $document;
}

// Helper function to handle ObjectId
function toObjectId($id) {
    if ($id instanceof MongoDB\BSON\ObjectId) {
        return $id;
    }
    if (is_string($id) && strlen($id) === 24) {
        try {
            return new MongoDB\BSON\ObjectId($id);
        } catch (Exception $e) {
            return null;
        }
    }
    return null;
}

// Helper function to get ID as string
function getIdString($document) {
    if (isset($document['_id'])) {
        if ($document['_id'] instanceof MongoDB\BSON\ObjectId) {
            return (string)$document['_id'];
        }
    }
    return null;
}

// Helper function for pagination
function paginate($collection, $filter = [], $options = [], $page = 1, $perPage = 10) {
    $skip = ($page - 1) * $perPage;
    $options['skip'] = $skip;
    $options['limit'] = $perPage;
    
    $cursor = $collection->find($filter, $options);
    $total = $collection->countDocuments($filter);
    
    return [
        'data' => iterator_to_array($cursor),
        'total' => $total,
        'page' => $page,
        'perPage' => $perPage,
        'totalPages' => ceil($total / $perPage)
    ];
}

function getMongoClient() {
    static $client = null;
    
    if ($client === null) {
        // Read URI from environment variable
        $uri = $_ENV['MONGODB_URI'] ?? getenv('MONGODB_URI') ?? '';

        if (empty($uri)) {
            die("MongoDB URI is not set. Please check your environment variables.");
        }
        
        // Specify Stable API version 1
        $apiVersion = new ServerApi(ServerApi::V1);
        
        // Create a new client and connect to the server
        $client = new Client($uri, [], ['serverApi' => $apiVersion]);
        
        try {
            // Send a ping to confirm a successful connection
            $client->selectDatabase('admin')->command(['ping' => 1]);
        } catch (Exception $e) {
            error_log("MongoDB connection failed: " . $e->getMessage());
            die("Database connection error. Please try again later.");
        }
    }
    
    return $client;
}

function getDatabase() {
    $client = getMongoClient();
    $dbName = $_ENV['DB_NAME'] ?? getenv('DB_NAME') ?? 'close_to_saginaw';
    return $client->selectDatabase($dbName);
}

function getCollection($collectionName) {
    $db = getDatabase();
    return $db->selectCollection($collectionName);
}

/**
 * Initialize MongoDB indexes for the tour_requests collection
 * This function can be called manually to create indexes
 * It's safe to call multiple times - MongoDB will skip existing indexes
 */
function initializeMongoDBIndexes() {
    try {
        // Get the tour_requests collection
        $collection = getCollection('tour_requests');
        
        // Create availability check index
        $collection->createIndex(
            [
                'preferred_date' => 1,
                'preferred_time' => 1,
                'location' => 1,
                'status' => 1
            ],
            ['name' => 'availability_check_index']
        );
        
        // Create date index
        $collection->createIndex(
            ['preferred_date' => 1],
            ['name' => 'date_index']
        );
        
        // Create location index
        $collection->createIndex(
            ['location' => 1],
            ['name' => 'location_index']
        );
        
        // Create email index
        $collection->createIndex(
            ['email' => 1],
            ['name' => 'email_index']
        );
        
        return true;
        
    } catch (Exception $e) {
        error_log("Error creating MongoDB indexes: " . $e->getMessage());
        return false;
    }
}

// Set default timezone
date_default_timezone_set('America/Detroit');

?>
