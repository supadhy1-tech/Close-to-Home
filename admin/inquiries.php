<?php
require_once('auth.php');
requireLogin();

use MongoDB\BSON\ObjectId;

// Handle status update
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    if ($_POST['action'] === 'update_status') {
        $id = sanitizeInput($_POST['id']);
        $status = sanitizeInput($_POST['status']);
        $notes = sanitizeInput($_POST['notes'] ?? '');
        
        $contactInquiriesCollection = getCollection('contact_inquiries');
        $contactInquiriesCollection->updateOne(
            ['_id' => new ObjectId($id)],
            ['$set' => [
                'status' => $status,
                'notes' => $notes,
                'assigned_to' => $_SESSION['admin_id']
            ]]
        );
        
        logActivity($_SESSION['admin_id'], 'update_inquiry', 'contact_inquiries', $id, "Updated inquiry status to: $status");
        header('Location: inquiries.php?success=updated');
        exit();
    }
}

// Get filters
$status_filter = isset($_GET['status']) ? $_GET['status'] : 'new';
$location_filter = isset($_GET['location']) ? $_GET['location'] : 'all';
$search = isset($_GET['search']) ? $_GET['search'] : '';

// Build query filter
$filter = [];

if ($status_filter !== 'all') {
    $filter['status'] = $status_filter;
}

if ($location_filter !== 'all') {
    $filter['location'] = $location_filter;
}

if ($search) {
    $filter['$or'] = [
        ['name' => new MongoDB\BSON\Regex($search, 'i')],
        ['email' => new MongoDB\BSON\Regex($search, 'i')],
        ['phone' => new MongoDB\BSON\Regex($search, 'i')]
    ];
}

// Get inquiries
$contactInquiriesCollection = getCollection('contact_inquiries');
$inquiryCursor = $contactInquiriesCollection->find(
    $filter,
    ['sort' => ['created_at' => -1]]
);
$inquiries = iterator_to_array($inquiryCursor);

// Get assigned user names
$adminUsersCollection = getCollection('admin_users');
foreach ($inquiries as &$inquiry) {
    if (isset($inquiry['assigned_to'])) {
        try {
            $user = $adminUsersCollection->findOne(['_id' => new ObjectId($inquiry['assigned_to'])]);
            $inquiry['assigned_to_name'] = $user ? $user['full_name'] : null;
        } catch (Exception $e) {
            $inquiry['assigned_to_name'] = null;
        }
    } else {
        $inquiry['assigned_to_name'] = null;
    }
}

$current_user = getCurrentUser();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inquiries - Admin Dashboard</title>
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
                    <h1 class="h2"><i class="bi bi-envelope"></i> Contact Inquiries</h1>
                </div>

                <?php if (isset($_GET['success'])): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    Inquiry updated successfully!
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
                <?php endif; ?>

                <!-- Filters -->
                <div class="card mb-4">
                    <div class="card-body">
                        <form method="GET" class="row g-3">
                            <div class="col-md-3">
                                <label class="form-label">Status</label>
                                <select name="status" class="form-select" onchange="this.form.submit()">
                                    <option value="new" <?php echo $status_filter === 'new' ? 'selected' : ''; ?>>New</option>
                                    <option value="all" <?php echo $status_filter === 'all' ? 'selected' : ''; ?>>All</option>
                                    <option value="contacted" <?php echo $status_filter === 'contacted' ? 'selected' : ''; ?>>Contacted</option>
                                    <option value="scheduled" <?php echo $status_filter === 'scheduled' ? 'selected' : ''; ?>>Scheduled</option>
                                    <option value="completed" <?php echo $status_filter === 'completed' ? 'selected' : ''; ?>>Completed</option>
                                    <option value="closed" <?php echo $status_filter === 'closed' ? 'selected' : ''; ?>>Closed</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Location</label>
                                <select name="location" class="form-select" onchange="this.form.submit()">
                                    <option value="all" <?php echo $location_filter === 'all' ? 'selected' : ''; ?>>All Locations</option>
                                    <option value="saginaw" <?php echo $location_filter === 'saginaw' ? 'selected' : ''; ?>>Saginaw</option>
                                    <option value="baycity" <?php echo $location_filter === 'baycity' ? 'selected' : ''; ?>>Bay City</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Search</label>
                                <div class="search-bar">
                                    <i class="bi bi-search"></i>
                                    <input type="text" name="search" class="form-control" placeholder="Search by name, email, or phone..." value="<?php echo htmlspecialchars($search); ?>">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Inquiries Table -->
                <div class="card">
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Location</th>
                                        <th>Contact</th>
                                        <th>Care Type</th>
                                        <th>Status</th>
                                        <th>Received</th>
                                        <th>Assigned To</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (count($inquiries) > 0): ?>
                                        <?php foreach ($inquiries as $inquiry): ?>
                                        <tr>
                                            <td><strong><?php echo htmlspecialchars($inquiry['name']); ?></strong></td>
                                            <td>
                                                <span class="badge bg-<?php echo $inquiry['location'] == 'baycity' ? 'success' : 'primary'; ?>">
                                                    <?php echo $inquiry['location'] == 'baycity' ? 'Bay City' : 'Saginaw'; ?>
                                                </span>
                                            </td>
                                            <td>
                                                <small>
                                                    <i class="bi bi-envelope"></i> <?php echo htmlspecialchars($inquiry['email']); ?><br>
                                                    <i class="bi bi-telephone"></i> <?php echo htmlspecialchars($inquiry['phone']); ?>
                                                </small>
                                            </td>
                                            <td><?php echo htmlspecialchars($inquiry['care_type'] ?? 'N/A'); ?></td>
                                            <td><?php echo getStatusBadge($inquiry['status']); ?></td>
                                            <td><small><?php echo formatDateTime($inquiry['created_at']); ?></small></td>
                                            <td>
                                                <small><?php echo $inquiry['assigned_to_name'] ? htmlspecialchars($inquiry['assigned_to_name']) : '-'; ?></small>
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-sm btn-outline-primary" 
                                                        data-bs-toggle="modal" 
                                                        data-bs-target="#viewInquiryModal<?php echo (string)$inquiry['_id']; ?>">
                                                    <i class="bi bi-eye"></i>
                                                </button>
                                            </td>
                                        </tr>

                                        <!-- View/Edit Modal -->
                                        <div class="modal fade" id="viewInquiryModal<?php echo (string)$inquiry['_id']; ?>" tabindex="-1">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Inquiry Details</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                    </div>
                                                    <form method="POST">
                                                        <input type="hidden" name="action" value="update_status">
                                                        <input type="hidden" name="id" value="<?php echo (string)$inquiry['_id']; ?>">
                                                        <div class="modal-body">
                                                            <div class="mb-3">
                                                                <strong>Name:</strong> <?php echo htmlspecialchars($inquiry['name']); ?>
                                                            </div>
                                                            <div class="mb-3">
                                                                <strong>Email:</strong> <?php echo htmlspecialchars($inquiry['email']); ?>
                                                            </div>
                                                            <div class="mb-3">
                                                                <strong>Phone:</strong> <?php echo htmlspecialchars($inquiry['phone']); ?>
                                                            </div>
                                                            <div class="mb-3">
                                                                <strong>Care Type:</strong> <?php echo htmlspecialchars($inquiry['care_type'] ?? 'N/A'); ?>
                                                            </div>
                                                            <div class="mb-3">
                                                                <strong>Message:</strong><br>
                                                                <?php echo nl2br(htmlspecialchars($inquiry['message'])); ?>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label">Status</label>
                                                                <select name="status" class="form-select">
                                                                    <option value="new" <?php echo $inquiry['status'] === 'new' ? 'selected' : ''; ?>>New</option>
                                                                    <option value="contacted" <?php echo $inquiry['status'] === 'contacted' ? 'selected' : ''; ?>>Contacted</option>
                                                                    <option value="scheduled" <?php echo $inquiry['status'] === 'scheduled' ? 'selected' : ''; ?>>Scheduled</option>
                                                                    <option value="completed" <?php echo $inquiry['status'] === 'completed' ? 'selected' : ''; ?>>Completed</option>
                                                                    <option value="closed" <?php echo $inquiry['status'] === 'closed' ? 'selected' : ''; ?>>Closed</option>
                                                                </select>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label">Notes</label>
                                                                <textarea name="notes" class="form-control" rows="3"><?php echo htmlspecialchars($inquiry['notes'] ?? ''); ?></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary">Update</button>
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
                                                    <i class="bi bi-inbox"></i>
                                                    <h5>No inquiries found</h5>
                                                    <p>New inquiries will appear here</p>
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