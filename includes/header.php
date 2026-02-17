<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($page_title) ? $page_title . ' | ' : ''; ?>Close to Home - Premier Assisted Living & Memory Care</title>
    <meta name="description" content="Close to Home provides compassionate assisted living, memory care, and independent living services in Saginaw, Michigan.">
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@300;400;700&family=Lato:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <!-- Header -->
    <header class="main-header">
        <nav class="navbar">
            <div class="nav-container">
                <a href="/index.php" class="logo">
                    <i class="fas fa-home"></i> Close to Home
                </a>
                
                <div class="mobile-menu-toggle" id="mobileMenuToggle">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>

             <ul class="nav-menu" id="navMenu">
    <li><a href="/index.php" class="<?= basename($_SERVER['PHP_SELF']) == 'index.php' ? 'active' : ''; ?>">Home</a></li>

    <li class="dropdown">
        <a href="/services.php" class="<?= basename($_SERVER['PHP_SELF']) == 'services.php' || strpos($_SERVER['PHP_SELF'], 'services/') !== false ? 'active' : ''; ?>">
            Services <i class="fas fa-chevron-down"></i>
        </a>
        <ul class="dropdown-menu">
            <li><a href="/services/assisted-living.php"><i class="fas fa-hands-helping"></i> Assisted Living</a></li>
            <li><a href="/services/memory-care.php"><i class="fas fa-brain"></i> Memory Care</a></li>
            <li><a href="/services/independent-living.php"><i class="fas fa-house-user"></i> Independent Living</a></li>
            <li><a href="/services/rehabilitation.php"><i class="fas fa-heartbeat"></i> Rehabilitation Services</a></li>
            <li><a href="/services/respite-care.php"><i class="fas fa-clock"></i> Respite Care</a></li>
            <li><a href="/services/life-enrichment.php"><i class="fas fa-palette"></i> Life Enrichment</a></li>
        </ul>
    </li>

    <li><a href="/about.php" class="<?= basename($_SERVER['PHP_SELF']) == 'about.php' ? 'active' : ''; ?>">About Us</a></li>

    <li class="dropdown">
        <a href="/locations.php" class="<?= basename($_SERVER['PHP_SELF']) == 'locations.php' || strpos($_SERVER['PHP_SELF'], 'locations/') !== false ? 'active' : ''; ?>">
            Locations <i class="fas fa-chevron-down"></i>
        </a>
        <ul class="dropdown-menu">
            <li><a href="/locations/saginaw.php"><i class="fas fa-map-marker-alt"></i> Saginaw</a></li>
            <li><a href="/locations/baycity.php"><i class="fas fa-map-marker-alt"></i> Bay City</a></li>
        </ul>
    </li>

   <li><a href="/experiences-saginaw.php" class="<?= (basename($_SERVER['PHP_SELF']) == 'experiences-saginaw.php' || basename($_SERVER['PHP_SELF']) == 'experiences-baycity.php') ? 'active' : ''; ?>">Experiences</a></li>
    <li><a href="/gallery.php" class="<?= basename($_SERVER['PHP_SELF']) == 'gallery.php' ? 'active' : ''; ?>">Gallery</a></li>
    <li><a href="/contact.php" class="<?= basename($_SERVER['PHP_SELF']) == 'contact.php' ? 'active' : ''; ?>">Contact</a></li>

    <li><a href="/contact.php#tour-section" class="cta-nav">Schedule Tour</a></li>

    <!-- 🔐 Staff Login / Dashboard -->
    <?php if (isset($_SESSION['user_id'])): ?>
        <li><a href="/admin/dashboard.php" class="staff-nav-btn">Dashboard</a></li>
        <li><a href="/admin/logout.php" class="staff-logout">Logout</a></li>
    <?php else: ?>
        <li>
            <a href="/admin/login.php" class="staff-nav-btn">
                <i class="fas fa-user-lock"></i> Staff Login
            </a>
        </li>
    <?php endif; ?>
</ul>

            </div>
        </nav>
    </header>