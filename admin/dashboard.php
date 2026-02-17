<?php
require_once('auth.php');
requireLogin();

use MongoDB\BSON\UTCDateTime;

// Get dashboard statistics
$stats = [];

// Total Residents
$residentsCollection = getCollection('residents');
$stats['total_residents'] = $residentsCollection->countDocuments(['status' => 'active']);

// New Inquiries (last 7 days)
$sevenDaysAgo = new UTCDateTime((time() - (7 * 24 * 60 * 60)) * 1000);
$contactInquiriesCollection = getCollection('contact_inquiries');
$stats['new_inquiries'] = $contactInquiriesCollection->countDocuments([
    'created_at' => ['$gte' => $sevenDaysAgo],
    'status' => 'new'
]);

// Pending Tours
$tourRequestsCollection = getCollection('tour_requests');
$stats['pending_tours'] = $tourRequestsCollection->countDocuments(['status' => 'pending']);

// Pending Testimonials
$testimonialsCollection = getCollection('testimonials');
$stats['pending_testimonials'] = $testimonialsCollection->countDocuments(['approved' => false]);

// Active Staff
$staffMembersCollection = getCollection('staff_members');
$stats['active_staff'] = $staffMembersCollection->countDocuments(['status' => 'active']);

// Recent Activities
$activityLogCollection = getCollection('activity_log');
$adminUsersCollection = getCollection('admin_users');

$activityCursor = $activityLogCollection->find(
    [],
    [
        'sort' => ['created_at' => -1],
        'limit' => 10
    ]
);
$recent_activities = [];
foreach ($activityCursor as $activity) {
    // Get user name
    $user = $adminUsersCollection->findOne(['_id' => new MongoDB\BSON\ObjectId($activity['user_id'])]);
    $activity['full_name'] = $user ? $user['full_name'] : 'Unknown User';
    $recent_activities[] = $activity;
}

// Recent Inquiries
$inquiryCursor = $contactInquiriesCollection->find(
    [],
    [
        'sort' => ['created_at' => -1],
        'limit' => 5
    ]
);
$recent_inquiries = iterator_to_array($inquiryCursor);

// Upcoming Tours
$tourCursor = $tourRequestsCollection->find(
    ['status' => ['$in' => ['pending', 'confirmed']]],
    [
        'sort' => ['preferred_date' => 1],
        'limit' => 5
    ]
);
$upcoming_tours = iterator_to_array($tourCursor);

$current_user = getCurrentUser();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Close to Saginaw</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="css/admin.css">
</head>
<body>
    <?php include('includes/header.php'); ?>
    
    <div class="container-fluid">
        <div class="row">
            <?php include('includes/sidebar.php'); ?>
            
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2"><i class="bi bi-speedometer2"></i> Dashboard</h1>
                    <div class="btn-toolbar mb-2 mb-md-0">
                        <div class="btn-group me-2">
                            <button type="button" class="btn btn-sm btn-outline-secondary">
                                <i class="bi bi-calendar"></i> Today
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Statistics Cards -->
                <div class="row mb-4">
                    <div class="col-md-4 mb-3">
                        <div class="card stat-card bg-warning text-white">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="card-subtitle mb-2">New Inquiries</h6>
                                        <h2 class="card-title mb-0"><?php echo $stats['new_inquiries']; ?></h2>
                                    </div>
                                    <div class="stat-icon">
                                        <i class="bi bi-envelope-fill"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer bg-transparent border-0">
                                <a href="inquiries.php" class="text-white text-decoration-none">
                                    <small>View inquiries <i class="bi bi-arrow-right"></i></small>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 mb-3">
                        <div class="card stat-card bg-success text-white">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="card-subtitle mb-2">Pending Tours</h6>
                                        <h2 class="card-title mb-0"><?php echo $stats['pending_tours']; ?></h2>
                                    </div>
                                    <div class="stat-icon">
                                        <i class="bi bi-calendar-check-fill"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer bg-transparent border-0">
                                <a href="tours.php" class="text-white text-decoration-none">
                                    <small>Manage tours <i class="bi bi-arrow-right"></i></small>
                                </a>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-4 mb-3">
                        <div class="card stat-card bg-primary text-white">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="card-subtitle mb-2">Pending Testimonials</h6>
                                        <h2 class="card-title mb-0"><?php echo $stats['pending_testimonials']; ?></h2>
                                    </div>
                                    <div class="stat-icon">
                                        <i class="bi bi-star-fill"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer bg-transparent border-0">
                                <a href="testimonials.php" class="text-white text-decoration-none">
                                    <small>Review testimonials <i class="bi bi-arrow-right"></i></small>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Main Content Row -->
                <div class="row">
                    <!-- Recent Inquiries -->
                    <div class="col-md-6 mb-4">
                        <div class="card">
                            <div class="card-header bg-white">
                                <h5 class="card-title mb-0">
                                    <i class="bi bi-envelope"></i> Recent Inquiries
                                </h5>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table table-hover mb-0">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Care Type</th>
                                                <th>Status</th>
                                                <th>Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($recent_inquiries as $inquiry): ?>
                                            <tr>
                                                <td><?php echo htmlspecialchars($inquiry['name']); ?></td>
                                                <td><small><?php echo htmlspecialchars($inquiry['care_type'] ?? 'N/A'); ?></small></td>
                                                <td><?php echo getStatusBadge($inquiry['status']); ?></td>
                                                <td><small><?php echo formatDate($inquiry['created_at']); ?></small></td>
                                            </tr>
                                            <?php endforeach; ?>
                                            <?php if (count($recent_inquiries) == 0): ?>
                                            <tr>
                                                <td colspan="4" class="text-center text-muted">No recent inquiries</td>
                                            </tr>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="card-footer bg-white text-center">
                                <a href="inquiries.php" class="text-decoration-none">View All Inquiries</a>
                            </div>
                        </div>
                    </div>

                    <!-- Upcoming Tours -->
                    <div class="col-md-6 mb-4">
                        <div class="card">
                            <div class="card-header bg-white">
                                <h5 class="card-title mb-0">
                                    <i class="bi bi-calendar-event"></i> Upcoming Tours
                                </h5>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table table-hover mb-0">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Date</th>
                                                <th>Time</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($upcoming_tours as $tour): ?>
                                            <tr>
                                                <td><?php echo htmlspecialchars($tour['name']); ?></td>
                                                <td><small><?php echo formatDate($tour['preferred_date']); ?></small></td>
                                                <td><small><?php echo htmlspecialchars($tour['preferred_time'] ?? 'TBD'); ?></small></td>
                                                <td><?php echo getStatusBadge($tour['status']); ?></td>
                                            </tr>
                                            <?php endforeach; ?>
                                            <?php if (count($upcoming_tours) == 0): ?>
                                            <tr>
                                                <td colspan="4" class="text-center text-muted">No upcoming tours</td>
                                            </tr>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="card-footer bg-white text-center">
                                <a href="tours.php" class="text-decoration-none">View All Tours</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Activity -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header bg-white">
                                <h5 class="card-title mb-0">
                                    <i class="bi bi-clock-history"></i> Recent Activity
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="activity-timeline">
                                    <?php foreach ($recent_activities as $activity): ?>
                                    <div class="activity-item">
                                        <div class="activity-icon bg-primary">
                                            <i class="bi bi-circle-fill"></i>
                                        </div>
                                        <div class="activity-content">
                                            <p class="mb-0">
                                                <strong><?php echo htmlspecialchars($activity['full_name']); ?></strong>
                                                <?php echo htmlspecialchars($activity['description'] ?? $activity['action']); ?>
                                            </p>
                                            <small class="text-muted">
                                                <i class="bi bi-clock"></i> <?php echo formatDateTime($activity['created_at']); ?>
                                            </small>
                                        </div>
                                    </div>
                                    <?php endforeach; ?>
                                    <?php if (count($recent_activities) == 0): ?>
                                    <p class="text-center text-muted">No recent activity</p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>