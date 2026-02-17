<?php
// Admin Authentication and Session Management
session_start();

require_once(__DIR__ . '/../includes/config.php');
// require_once(__DIR__ . '/../includes/db.php');

use MongoDB\BSON\ObjectId;
use MongoDB\BSON\UTCDateTime;

// Check if user is logged in
function isLoggedIn() {
    return isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true;
}

// Check if user has required role
function hasRole($required_role) {
    if (!isLoggedIn()) {
        return false;
    }
    
    $user_role = $_SESSION['admin_role'];
    
    if ($required_role === 'super_admin') {
        return $user_role === 'super_admin';
    } elseif ($required_role === 'admin') {
        return in_array($user_role, ['super_admin', 'admin']);
    } else {
        return true; // staff and above
    }
}

// Require login - redirect if not logged in
function requireLogin() {
    if (!isLoggedIn()) {
        header('Location: login.php');
        exit();
    }
}

// Require specific role
function requireRole($role) {
    requireLogin();
    if (!hasRole($role)) {
        header('Location: dashboard.php?error=insufficient_permissions');
        exit();
    }
}

// Login user
function loginUser($username, $password) {
    $adminUsersCollection = getCollection('admin_users');
    
    $user = $adminUsersCollection->findOne([
        'username' => $username,
        'is_active' => true
    ]);
    
    if ($user && password_verify($password, $user['password'])) {
        // Set session variables
        $_SESSION['admin_logged_in'] = true;
        $_SESSION['admin_id'] = (string)$user['_id'];
        $_SESSION['admin_username'] = $user['username'];
        $_SESSION['admin_name'] = $user['full_name'];
        $_SESSION['admin_email'] = $user['email'];
        $_SESSION['admin_role'] = $user['role'];
        
        // Update last login
        $ip_address = $_SERVER['REMOTE_ADDR'];
        $adminUsersCollection->updateOne(
            ['_id' => $user['_id']],
            ['$set' => ['last_login' => new UTCDateTime()]]
        );
        
        // Log activity
        logActivity((string)$user['_id'], 'login', 'admin_users', (string)$user['_id'], 'User logged in', $ip_address);
        
        return true;
    }
    
    return false;
}

// Logout user
function logoutUser() {
    if (isLoggedIn()) {
        logActivity($_SESSION['admin_id'], 'logout', 'admin_users', $_SESSION['admin_id'], 'User logged out');
    }
    
    session_destroy();
    header('Location: login.php');
    exit();
}

// Log activity
function logActivity($user_id, $action, $table_name = null, $record_id = null, $description = null, $ip_address = null) {
    $activityLogCollection = getCollection('activity_log');
    
    if ($ip_address === null) {
        $ip_address = $_SERVER['REMOTE_ADDR'];
    }
    
    $logEntry = [
        'user_id' => $user_id,
        'action' => $action,
        'table_name' => $table_name,
        'record_id' => $record_id,
        'description' => $description,
        'ip_address' => $ip_address,
        'created_at' => new UTCDateTime()
    ];
    
    $activityLogCollection->insertOne($logEntry);
}

// Get current user info
function getCurrentUser() {
    if (!isLoggedIn()) {
        return null;
    }
    
    return [
        'id' => $_SESSION['admin_id'],
        'username' => $_SESSION['admin_username'],
        'name' => $_SESSION['admin_name'],
        'email' => $_SESSION['admin_email'],
        'role' => $_SESSION['admin_role']
    ];
}

// Format date
function formatDate($date) {
    if (!$date) return 'N/A';
    
    // Handle MongoDB UTCDateTime
    if ($date instanceof MongoDB\BSON\UTCDateTime) {
        $date = $date->toDateTime()->format('Y-m-d H:i:s');
    }
    
    return date('M j, Y', strtotime($date));
}

// Format datetime
function formatDateTime($datetime) {
    if (!$datetime) return 'N/A';
    
    // Handle MongoDB UTCDateTime
    if ($datetime instanceof MongoDB\BSON\UTCDateTime) {
        $datetime = $datetime->toDateTime()->format('Y-m-d H:i:s');
    }
    
    return date('M j, Y g:i A', strtotime($datetime));
}

// Get status badge HTML
function getStatusBadge($status) {
    $badges = [
        'new' => '<span class="badge bg-primary text-white">New</span>',
        'pending' => '<span class="badge bg-warning text-dark">Pending</span>',
        'contacted' => '<span class="badge bg-info text-white">Contacted</span>',
        'confirmed' => '<span class="badge bg-success text-white">Confirmed</span>',
        'completed' => '<span class="badge bg-success text-white">Completed</span>',
        'cancelled' => '<span class="badge bg-danger text-white">Cancelled</span>',
        'closed' => '<span class="badge bg-secondary text-white">Closed</span>',
        'active' => '<span class="badge bg-success text-white">Active</span>',
        'inactive' => '<span class="badge bg-secondary text-white">Inactive</span>',
        'discharged' => '<span class="badge bg-warning text-dark">Discharged</span>',
        'deceased' => '<span class="badge bg-dark text-white">Deceased</span>',
        'transferred' => '<span class="badge bg-info text-white">Transferred</span>',
        'scheduled' => '<span class="badge bg-info text-white">Scheduled</span>'
    ];
    
    return $badges[strtolower($status)] ?? '<span class="badge bg-secondary text-white">' . ucfirst($status) . '</span>';
}

// Sanitize input
function sanitizeInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>