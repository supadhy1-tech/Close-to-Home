<?php
// Initialize $stats if not already set (to prevent warnings)
if (!isset($stats)) {
    $stats = [
        'new_inquiries' => 0,
        'pending_tours' => 0,
        'pending_testimonials' => 0
    ];
    
    // Try to get actual stats if database connection exists
    if (isset($conn) && $conn) {
        // New Inquiries
        $result = mysqli_query($conn, "SELECT COUNT(*) as count FROM contact_inquiries WHERE status = 'new'");
        if ($result) {
            $row = mysqli_fetch_assoc($result);
            $stats['new_inquiries'] = $row['count'] ?? 0;
        }
        
        // Pending Tours
        $result = mysqli_query($conn, "SELECT COUNT(*) as count FROM tour_requests WHERE status = 'pending'");
        if ($result) {
            $row = mysqli_fetch_assoc($result);
            $stats['pending_tours'] = $row['count'] ?? 0;
        }
        
        // Pending Testimonials
        $result = mysqli_query($conn, "SELECT COUNT(*) as count FROM testimonials WHERE approved = 0");
        if ($result) {
            $row = mysqli_fetch_assoc($result);
            $stats['pending_testimonials'] = $row['count'] ?? 0;
        }
    }
}
?>
<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="position-sticky pt-3">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link <?php echo $current_page === 'dashboard' ? 'active' : ''; ?>" href="dashboard.php">
                    <i class="bi bi-speedometer2"></i> Dashboard
                </a>
            </li>
            

            
            <li class="nav-item">
                <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                    <span>OPERATIONS</span>
                </h6>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo $current_page === 'inquiries' ? 'active' : ''; ?>" href="inquiries.php">
                    <i class="bi bi-envelope"></i> Inquiries
                    <?php if (isset($stats['new_inquiries']) && $stats['new_inquiries'] > 0): ?>
                    <span class="badge bg-warning rounded-pill"><?php echo $stats['new_inquiries']; ?></span>
                    <?php endif; ?>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo $current_page === 'tours' ? 'active' : ''; ?>" href="tours.php">
                    <i class="bi bi-calendar-event"></i> Tour Requests
                    <?php if (isset($stats['pending_tours']) && $stats['pending_tours'] > 0): ?>
                    <span class="badge bg-success rounded-pill"><?php echo $stats['pending_tours']; ?></span>
                    <?php endif; ?>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo $current_page === 'testimonials' ? 'active' : ''; ?>" href="testimonials.php">
                    <i class="bi bi-star"></i> Testimonials
                    <?php if (isset($stats['pending_testimonials']) && $stats['pending_testimonials'] > 0): ?>
                    <span class="badge bg-info rounded-pill"><?php echo $stats['pending_testimonials']; ?></span>
                    <?php endif; ?>
                </a>
            </li>
            
           
        
        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
            <span>QUICK ACTIONS</span>
        </h6>
        <ul class="nav flex-column mb-2">
            <li class="nav-item">
                <a class="nav-link" href="../index.php" target="_blank">
                    <i class="bi bi-box-arrow-up-right"></i> View Website
                </a>
            </li>
        </ul>
    </div>
</nav>
```
