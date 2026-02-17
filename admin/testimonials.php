<?php
require_once('auth.php');
requireLogin();

use MongoDB\BSON\ObjectId;
use MongoDB\BSON\UTCDateTime;

// Handle testimonial actions
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    $id = sanitizeInput($_POST['id']);
    $testimonialsCollection = getCollection('testimonials');
    
    if ($_POST['action'] === 'approve') {
        $testimonialsCollection->updateOne(
            ['_id' => new ObjectId($id)],
            ['$set' => [
                'approved' => true,
                'approved_by' => $_SESSION['admin_id'],
                'approved_at' => new UTCDateTime()
            ]]
        );
        logActivity($_SESSION['admin_id'], 'approve_testimonial', 'testimonials', $id, 'Approved testimonial');
        header('Location: testimonials.php?success=approved');
        exit();
    } elseif ($_POST['action'] === 'reject') {
        $testimonialsCollection->deleteOne(['_id' => new ObjectId($id)]);
        logActivity($_SESSION['admin_id'], 'reject_testimonial', 'testimonials', $id, 'Rejected testimonial');
        header('Location: testimonials.php?success=rejected');
        exit();
    } elseif ($_POST['action'] === 'feature') {
        $featured = $_POST['featured'] === '1' ? true : false;
        $testimonialsCollection->updateOne(
            ['_id' => new ObjectId($id)],
            ['$set' => ['is_featured' => $featured]]
        );
        logActivity($_SESSION['admin_id'], 'feature_testimonial', 'testimonials', $id, 'Changed feature status');
        header('Location: testimonials.php?success=updated');
        exit();
    }
}

// Get testimonials
$filter_status = isset($_GET['filter']) ? $_GET['filter'] : 'pending';
$location_filter = isset($_GET['location']) ? $_GET['location'] : 'all';

$filter = [];

if ($filter_status === 'pending') {
    $filter['approved'] = false;
} elseif ($filter_status === 'approved') {
    $filter['approved'] = true;
} elseif ($filter_status === 'featured') {
    $filter['is_featured'] = true;
}

if ($location_filter !== 'all') {
    $filter['location'] = $location_filter;
}

$testimonialsCollection = getCollection('testimonials');
$testimonialCursor = $testimonialsCollection->find(
    $filter,
    ['sort' => ['created_at' => -1]]
);
$testimonials = iterator_to_array($testimonialCursor);

// Get approved user names
$adminUsersCollection = getCollection('admin_users');
foreach ($testimonials as &$testimonial) {
    if (isset($testimonial['approved_by'])) {
        try {
            $user = $adminUsersCollection->findOne(['_id' => new ObjectId($testimonial['approved_by'])]);
            $testimonial['approved_by_name'] = $user ? $user['full_name'] : null;
        } catch (Exception $e) {
            $testimonial['approved_by_name'] = null;
        }
    } else {
        $testimonial['approved_by_name'] = null;
    }
}

$current_user = getCurrentUser();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Testimonials - Admin Dashboard</title>
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
                    <h1 class="h2"><i class="bi bi-star"></i> Testimonials</h1>
                </div>

                <?php if (isset($_GET['success'])): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    Testimonial <?php echo $_GET['success']; ?> successfully!
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
                <?php endif; ?>

                <!-- Filter -->
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-8">
                                <label class="form-label">Status</label>
                                <div class="btn-group" role="group">
                                    <a href="testimonials.php?filter=pending&location=<?php echo $location_filter; ?>" class="btn btn-outline-primary <?php echo $filter_status === 'pending' ? 'active' : ''; ?>">
                                        Pending Approval
                                    </a>
                                    <a href="testimonials.php?filter=approved&location=<?php echo $location_filter; ?>" class="btn btn-outline-primary <?php echo $filter_status === 'approved' ? 'active' : ''; ?>">
                                        Approved
                                    </a>
                                    <a href="testimonials.php?filter=featured&location=<?php echo $location_filter; ?>" class="btn btn-outline-primary <?php echo $filter_status === 'featured' ? 'active' : ''; ?>">
                                        Featured
                                    </a>
                                    <a href="testimonials.php?filter=all&location=<?php echo $location_filter; ?>" class="btn btn-outline-primary <?php echo $filter_status === 'all' ? 'active' : ''; ?>">
                                        All
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Location</label>
                                <select class="form-select" onchange="window.location.href='testimonials.php?filter=<?php echo $filter_status; ?>&location=' + this.value">
                                    <option value="all" <?php echo $location_filter === 'all' ? 'selected' : ''; ?>>All Locations</option>
                                    <option value="saginaw" <?php echo $location_filter === 'saginaw' ? 'selected' : ''; ?>>Saginaw</option>
                                    <option value="baycity" <?php echo $location_filter === 'baycity' ? 'selected' : ''; ?>>Bay City</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Testimonials Grid -->
                <div class="row">
                    <?php if (count($testimonials) > 0): ?>
                        <?php foreach ($testimonials as $testimonial): ?>
                        <div class="col-md-6 mb-4">
                            <div class="card h-100">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-start mb-3">
                                        <div>
                                            <span class="badge bg-<?php echo $testimonial['location'] == 'baycity' ? 'success' : 'primary'; ?> mb-2">
                                                <?php echo $testimonial['location'] == 'baycity' ? 'Bay City' : 'Saginaw'; ?>
                                            </span>
                                            <h5 class="card-title mb-0"><?php echo htmlspecialchars($testimonial['author_name']); ?></h5>
                                            <small class="text-muted"><?php echo htmlspecialchars($testimonial['relationship']); ?></small>
                                        </div>
                                        <div>
                                            <?php for ($i = 0; $i < $testimonial['rating']; $i++): ?>
                                            <i class="bi bi-star-fill text-warning"></i>
                                            <?php endfor; ?>
                                        </div>
                                    </div>
                                    
                                    <p class="card-text"><?php echo nl2br(htmlspecialchars($testimonial['testimonial_text'])); ?></p>
                                    
                                    <div class="d-flex justify-content-between align-items-center mt-3">
                                        <div>
                                            <small class="text-muted">
                                                Submitted: <?php echo formatDate($testimonial['created_at']); ?>
                                            </small>
                                        </div>
                                        <div>
                                            <?php if ($testimonial['approved'] ?? false): ?>
                                                <span class="badge bg-success">Approved</span>
                                            <?php else: ?>
                                                <span class="badge bg-warning">Pending</span>
                                            <?php endif; ?>
                                            
                                            <?php if ($testimonial['is_featured'] ?? false): ?>
                                                <span class="badge bg-info">Featured</span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer bg-white">
                                    <?php if (!($testimonial['approved'] ?? false)): ?>
                                    <form method="POST" style="display: inline;">
                                        <input type="hidden" name="action" value="approve">
                                        <input type="hidden" name="id" value="<?php echo (string)$testimonial['_id']; ?>">
                                        <button type="submit" class="btn btn-sm btn-success">
                                            <i class="bi bi-check-circle"></i> Approve
                                        </button>
                                    </form>
                                    <form method="POST" style="display: inline;">
                                        <input type="hidden" name="action" value="reject">
                                        <input type="hidden" name="id" value="<?php echo (string)$testimonial['_id']; ?>">
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to reject this testimonial?')">
                                            <i class="bi bi-x-circle"></i> Reject
                                        </button>
                                    </form>
                                    <?php else: ?>
                                    <form method="POST" style="display: inline;">
                                        <input type="hidden" name="action" value="feature">
                                        <input type="hidden" name="id" value="<?php echo (string)$testimonial['_id']; ?>">
                                        <input type="hidden" name="featured" value="<?php echo ($testimonial['is_featured'] ?? false) ? '0' : '1'; ?>">
                                        <button type="submit" class="btn btn-sm btn-outline-info">
                                            <i class="bi bi-star"></i> 
                                            <?php echo ($testimonial['is_featured'] ?? false) ? 'Unfeature' : 'Feature'; ?>
                                        </button>
                                    </form>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="col-12">
                            <div class="empty-state">
                                <i class="bi bi-chat-quote"></i>
                                <h5>No testimonials found</h5>
                                <p>Testimonials will appear here when submitted</p>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>