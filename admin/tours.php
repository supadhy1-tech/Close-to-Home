<?php
require_once('auth.php');
requireLogin();

use MongoDB\BSON\ObjectId;

// Handle tour updates
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    if ($_POST['action'] === 'update') {
        $id = sanitizeInput($_POST['id']);
        $status = sanitizeInput($_POST['status']);
        $confirmed_date = sanitizeInput($_POST['confirmed_date'] ?? '');
        $confirmed_time = sanitizeInput($_POST['confirmed_time'] ?? '');
        $notes = sanitizeInput($_POST['notes'] ?? '');
        
        $tourRequestsCollection = getCollection('tour_requests');
        $updateData = [
            'status' => $status,
            'notes' => $notes,
            'assigned_to' => $_SESSION['admin_id']
        ];
        
        if ($confirmed_date) {
            $updateData['confirmed_date'] = $confirmed_date;
        }
        if ($confirmed_time) {
            $updateData['confirmed_time'] = $confirmed_time;
        }
        
        $tourRequestsCollection->updateOne(
            ['_id' => new ObjectId($id)],
            ['$set' => $updateData]
        );
        
        logActivity($_SESSION['admin_id'], 'update_tour', 'tour_requests', $id, "Updated tour status to: $status");
        header('Location: tours.php?success=updated');
        exit();
    }
}

// Get tours
$status_filter = isset($_GET['status']) ? $_GET['status'] : 'pending';
$location_filter = isset($_GET['location']) ? $_GET['location'] : 'all';

$filter = [];

if ($status_filter !== 'all') {
    $filter['status'] = $status_filter;
}

if ($location_filter !== 'all') {
    $filter['location'] = $location_filter;
}

$tourRequestsCollection = getCollection('tour_requests');
$tourCursor = $tourRequestsCollection->find(
    $filter,
    ['sort' => ['preferred_date' => 1, 'preferred_time' => 1]]
);
$tours = iterator_to_array($tourCursor);

// Get assigned user names
$adminUsersCollection = getCollection('admin_users');
foreach ($tours as &$tour) {
    if (isset($tour['assigned_to'])) {
        try {
            $user = $adminUsersCollection->findOne(['_id' => new ObjectId($tour['assigned_to'])]);
            $tour['assigned_to_name'] = $user ? $user['full_name'] : null;
        } catch (Exception $e) {
            $tour['assigned_to_name'] = null;
        }
    } else {
        $tour['assigned_to_name'] = null;
    }
}

$current_user = getCurrentUser();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tour Requests - Admin Dashboard</title>
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
                    <h1 class="h2"><i class="bi bi-calendar-event"></i> Tour Requests</h1>
                </div>

                <?php if (isset($_GET['success'])): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    Tour updated successfully!
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
                <?php endif; ?>

                <!-- Filter -->
                <div class="card mb-4">
                    <div class="card-body">
                        <form method="GET" class="row g-3">
                            <div class="col-md-4">
                                <label class="form-label">Status</label>
                                <select name="status" class="form-select" onchange="this.form.submit()">
                                    <option value="pending" <?php echo $status_filter === 'pending' ? 'selected' : ''; ?>>Pending</option>
                                    <option value="confirmed" <?php echo $status_filter === 'confirmed' ? 'selected' : ''; ?>>Confirmed</option>
                                    <option value="all" <?php echo $status_filter === 'all' ? 'selected' : ''; ?>>All</option>
                                    <option value="completed" <?php echo $status_filter === 'completed' ? 'selected' : ''; ?>>Completed</option>
                                    <option value="cancelled" <?php echo $status_filter === 'cancelled' ? 'selected' : ''; ?>>Cancelled</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Location</label>
                                <select name="location" class="form-select" onchange="this.form.submit()">
                                    <option value="all" <?php echo $location_filter === 'all' ? 'selected' : ''; ?>>All Locations</option>
                                    <option value="saginaw" <?php echo $location_filter === 'saginaw' ? 'selected' : ''; ?>>Saginaw</option>
                                    <option value="baycity" <?php echo $location_filter === 'baycity' ? 'selected' : ''; ?>>Bay City</option>
                                </select>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Tours Table -->
                <div class="card">
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Location</th>
                                        <th>Contact</th>
                                        <th>Preferred Date/Time</th>
                                        <th>Confirmed Date/Time</th>
                                        <th>Guests</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (count($tours) > 0): ?>
                                        <?php foreach ($tours as $tour): ?>
                                        <tr>
                                            <td><strong><?php echo htmlspecialchars($tour['name'] ?? 'N/A'); ?></strong></td>
                                            <td>
                                                <span class="badge bg-<?php echo (isset($tour['location']) && $tour['location'] == 'baycity') ? 'success' : 'primary'; ?>">
                                                    <?php echo (isset($tour['location']) && $tour['location'] == 'baycity') ? 'Bay City' : 'Saginaw'; ?>
                                                </span>
                                            </td>
                                            <td>
                                                <small>
                                                    <i class="bi bi-envelope"></i> <?php echo htmlspecialchars($tour['email'] ?? 'N/A'); ?><br>
                                                    <i class="bi bi-telephone"></i> <?php echo htmlspecialchars($tour['phone'] ?? 'N/A'); ?>
                                                </small>
                                            </td>
                                            <td>
                                                <small>
                                                    <?php echo isset($tour['preferred_date']) ? formatDate($tour['preferred_date']) : 'N/A'; ?><br>
                                                    <?php echo htmlspecialchars($tour['preferred_time'] ?? 'Flexible'); ?>
                                                </small>
                                            </td>
                                            <td>
                                                <small>
                                                    <?php echo (isset($tour['confirmed_date']) && $tour['confirmed_date']) ? formatDate($tour['confirmed_date']) : '-'; ?><br>
                                                    <?php echo htmlspecialchars($tour['confirmed_time'] ?? '-'); ?>
                                                </small>
                                            </td>
                                            <td><?php echo $tour['number_of_guests'] ?? 1; ?></td>
                                            <td><?php echo getStatusBadge($tour['status'] ?? 'pending'); ?></td>
                                            <td>
                                                <button type="button" class="btn btn-sm btn-outline-primary" 
                                                        data-bs-toggle="modal" 
                                                        data-bs-target="#editTourModal<?php echo (string)$tour['_id']; ?>">
                                                    <i class="bi bi-pencil"></i>
                                                </button>
                                            </td>
                                        </tr>

                                        <!-- Edit Modal -->
                                        <div class="modal fade" id="editTourModal<?php echo (string)$tour['_id']; ?>" tabindex="-1">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Manage Tour Request</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                    </div>
                                                    <form method="POST">
                                                        <input type="hidden" name="action" value="update">
                                                        <input type="hidden" name="id" value="<?php echo (string)$tour['_id']; ?>">
                                                        <div class="modal-body">
                                                            <div class="mb-3">
                                                                <strong>Name:</strong> <?php echo htmlspecialchars($tour['name'] ?? 'N/A'); ?>
                                                            </div>
                                                            <div class="mb-3">
                                                                <strong>Location:</strong> 
                                                                <span class="badge bg-<?php echo (isset($tour['location']) && $tour['location'] == 'baycity') ? 'success' : 'primary'; ?>">
                                                                    <?php echo (isset($tour['location']) && $tour['location'] == 'baycity') ? 'Bay City' : 'Saginaw'; ?>
                                                                </span>
                                                            </div>
                                                            <div class="mb-3">
                                                                <strong>Requested:</strong> 
                                                                <?php echo isset($tour['preferred_date']) ? formatDate($tour['preferred_date']) : 'N/A'; ?> 
                                                                at <?php echo htmlspecialchars($tour['preferred_time'] ?? 'Flexible'); ?>
                                                            </div>
                                                            <div class="mb-3">
                                                                <strong>Guests:</strong> <?php echo $tour['number_of_guests'] ?? 1; ?>
                                                            </div>
                                                            <?php if (isset($tour['message']) && $tour['message']): ?>
                                                            <div class="mb-3">
                                                                <strong>Message:</strong><br>
                                                                <?php echo nl2br(htmlspecialchars($tour['message'])); ?>
                                                            </div>
                                                            <?php endif; ?>
                                                            <div class="mb-3">
                                                                <label class="form-label">Status *</label>
                                                                <select name="status" class="form-select" required>
                                                                    <option value="pending" <?php echo ($tour['status'] ?? 'pending') === 'pending' ? 'selected' : ''; ?>>Pending</option>
                                                                    <option value="confirmed" <?php echo ($tour['status'] ?? '') === 'confirmed' ? 'selected' : ''; ?>>Confirmed</option>
                                                                    <option value="completed" <?php echo ($tour['status'] ?? '') === 'completed' ? 'selected' : ''; ?>>Completed</option>
                                                                    <option value="cancelled" <?php echo ($tour['status'] ?? '') === 'cancelled' ? 'selected' : ''; ?>>Cancelled</option>
                                                                </select>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-6 mb-3">
                                                                    <label class="form-label">Confirmed Date</label>
                                                                    <input type="date" name="confirmed_date" class="form-control" 
                                                                           value="<?php echo $tour['confirmed_date'] ?? ''; ?>">
                                                                </div>
                                                                <div class="col-md-6 mb-3">
                                                                    <label class="form-label">Confirmed Time</label>
                                                                    <input type="time" name="confirmed_time" class="form-control" 
                                                                           value="<?php echo $tour['confirmed_time'] ?? ''; ?>">
                                                                </div>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label">Notes</label>
                                                                <textarea name="notes" class="form-control" rows="3"><?php echo htmlspecialchars($tour['notes'] ?? ''); ?></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary">Update Tour</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="8" class="text-center py-4">
                                                <div class="empty-state">
                                                    <i class="bi bi-calendar-x"></i>
                                                    <h5>No tour requests found</h5>
                                                    <p>Tour requests will appear here</p>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>