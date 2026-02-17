<?php 
$page_title = "Photo Gallery";
include 'includes/header.php'; 

// Detect location from query param, default to saginaw
$location = isset($_GET['location']) && $_GET['location'] === 'baycity' ? 'baycity' : 'saginaw';

// =============================================
// GALLERY PHOTO LIST — SAGINAW
// To add/change photos:
// 1. Upload your image to /images/gallery/saginaw/
// 2. Add a new entry in the $gallery_saginaw array below
// =============================================
$gallery_saginaw = [
    ['title' => 'Private Suites',     'img' => 'privatesuites.jpg',    'category' => 'rooms',      'color' => '#4a8aa8'],
    ['title' => 'Dining Room',        'img' => 'happy.jpg',            'category' => 'dining',     'color' => '#d4a373'],
    ['title' => 'Activity Center',    'img' => 'activity-singing-sagiaw.jpg',   'category' => 'activities', 'color' => '#1a4d2e'],
    ['title' => 'Fitness Room',       'img' => 'fitness-center.jpg',    'category' => 'activities', 'color' => '#2d7a4c'],
    ['title' => 'Library',            'img' => 'library.jpg',           'category' => 'common',     'color' => '#b88a5f'],
    ['title' => 'Community Lounge',   'img' => 'saginaw-living.jpg',  'category' => 'common',     'color' => '#5a8a82'],
    ['title' => 'Walking Path',       'img' => 'walkingpath.jpg',      'category' => 'outdoor',    'color' => '#2d7a4c'],
    ['title' => "Chef's Kitchen",     'img' => "chef's-kitchen.jpg",    'category' => 'dining',     'color' => '#b88a5f'],
    // ['title' => 'Resident Suite',     'img' => 'saginaw/privatesuites.jpg',     'category' => 'rooms',      'color' => '#76a89f'],
    ['title' => 'Memory Care Wing',   'img' => 'memory care.jpg',       'category' => 'care',       'color' => '#d4a373'],
    ['title' => 'Therapy Room',       'img' => 'saginaw/therapy-room.jpg',      'category' => 'care',       'color' => '#4a8aa8'],
    // ['title' => 'Outdoor Gardens',    'img' => 'saginaw/outdoor-gardens.jpg',   'category' => 'outdoor',    'color' => '#76a89f'],
];

// =============================================
// GALLERY PHOTO LIST — BAY CITY
// To add/change photos:
// 1. Upload your image to /images/gallery/baycity/
// 2. Add a new entry in the $gallery_baycity array below
// =============================================
$gallery_baycity = [
    ['title' => 'Private Suites',     'img' => 'private-suites.jpg',    'category' => 'rooms',      'color' => '#4a8aa8'],
    ['title' => 'Dining Room',        'img' => 'baycity-living.jpg',            'category' => 'dining',     'color' => '#d4a373'],
    ['title' => 'Activity Center',    'img' => 'activity-center.jpg',   'category' => 'activities', 'color' => '#1a4d2e'],
    // ['title' => 'Fitness Room',       'img' => 'baycity/fitness-center.jpg',    'category' => 'activities', 'color' => '#2d7a4c'],
    ['title' => 'Library',            'img' => 'baycity/library.jpg',           'category' => 'common',     'color' => '#b88a5f'],
    ['title' => 'Community Lounge',   'img' => 'closetohome-baycity-frontlook.jpg',  'category' => 'common',     'color' => '#5a8a82'],
    ['title' => 'Walking Path',       'img' => 'baycity/walking-path.jpg',      'category' => 'outdoor',    'color' => '#2d7a4c'],
    ['title' => "Chef's Kitchen",     'img' => "baycity-chef.jpg",    'category' => 'dining',     'color' => '#b88a5f'],
    // ['title' => 'Resident Suite',     'img' => 'baycity/privatesuites.jpg',     'category' => 'rooms',      'color' => '#76a89f'],
    // ['title' => 'Memory Care Wing',   'img' => 'baycity/memory-care.jpg',       'category' => 'care',       'color' => '#d4a373'],
    ['title' => 'Therapy Room',       'img' => 'baycity/therapy-room.jpg',      'category' => 'care',       'color' => '#4a8aa8'],
    // ['title' => 'Outdoor Gardens',    'img' => 'baycity/outdoor-gardens.jpg',   'category' => 'outdoor',    'color' => '#76a89f'],
    // ['title' => 'Waterfront View',    'img' => 'baycity/waterfront.jpg',        'category' => 'outdoor',    'color' => '#3a7a9c'],
    ['title' => 'Common Room',        'img' => 'talk.jpg',       'category' => 'common',     'color' => '#8a6a4f'],
];

// Select active gallery based on location
$gallery_items = ($location === 'baycity') ? $gallery_baycity : $gallery_saginaw;

// Location display info
$location_info = [
    'saginaw' => [
        'name'    => 'Saginaw',
        'address' => '2160 N Center Rd, Saginaw, MI 48603',
        'phone'   => '(989) 401-3581',
        'hero_bg' => 'images/gallery/Close-to-home.jpg',
        'subtitle'=> 'A warm, home-like community in the heart of Saginaw',
    ],
    'baycity' => [
        'name'    => 'Bay City',
        'address' => ' 1805 Raymond St, Bay City, MI 48706',  // Update with real address
        'phone'   => '(989) 778-2575',                        // Update with real phone
        'hero_bg' => 'images/gallery/closetohome-baycity-frontlook.jpg',
        'subtitle'=> 'Beautiful living along the Saginaw River in Bay City',
    ],
];

$loc     = $location_info[$location];
$other   = ($location === 'saginaw') ? 'baycity' : 'saginaw';
$otherLoc= $location_info[$other];
?>

<!-- Page Hero -->
<section class="hero-section" style="min-height: 50vh; background: linear-gradient(135deg, rgba(26, 77, 46, 0.3) 0%, rgba(76, 139, 99, 0.25) 100%), url('<?php echo $loc['hero_bg']; ?>') center/cover no-repeat; display: flex; align-items: center; position: relative; filter: contrast(1.2) brightness(1.05);">
    <div class="hero-content" style="position: relative; z-index: 2; text-align: center; color: rgba(255, 255, 255, 0.95); max-width: 1200px; margin: 0 auto; padding: 3rem 2rem; background: rgba(0, 0, 0, 0.2); backdrop-filter: blur(3px); border-radius: 15px;">
        <h1 style="font-size: 3.5rem; margin-bottom: 1rem; text-shadow: 2px 2px 8px rgba(0,0,0,0.6); font-weight: 300; letter-spacing: 1px;">
            <i class="fas fa-images" style="opacity: 0.9;"></i> 
            <?php echo $loc['name']; ?> Photo Gallery
        </h1>
        <p class="subtitle" style="font-size: 1.5rem; color: rgba(212, 163, 115, 0.9); font-weight: 400; text-shadow: 1px 1px 4px rgba(0,0,0,0.5);">
            <?php echo $loc['subtitle']; ?>
        </p>
        <div style="margin-top: 1.5rem;">
            <span style="background: rgba(255,255,255,0.2); padding: 0.5rem 1.5rem; border-radius: 50px; backdrop-filter: blur(10px); display: inline-block;">
                <i class="fas fa-map-marker-alt"></i> <?php echo $loc['address']; ?>
            </span>
        </div>
    </div>
</section>

<!-- Location Switcher -->
<section class="section" style="background: #f8f9fa; padding: 1.5rem 0;">
    <div class="container" style="text-align: center;">
        <div style="display: inline-flex; gap: 1rem; background: #fff; padding: 0.5rem; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
            <a href="gallery.php?location=saginaw" 
               class="btn-location <?php echo $location === 'saginaw' ? 'active' : ''; ?>"
               style="padding: 0.8rem 2rem; border-radius: 8px; text-decoration: none; font-weight: 600; transition: all 0.2s;
                      background: <?php echo $location === 'saginaw' ? 'var(--primary-color)' : 'transparent'; ?>;
                      color: <?php echo $location === 'saginaw' ? 'white' : 'var(--primary-color)'; ?>;
                      border: 2px solid var(--primary-color);">
                <i class="fas fa-map-marker-alt"></i> Saginaw Location
            </a>
            <a href="gallery.php?location=baycity" 
               class="btn-location <?php echo $location === 'baycity' ? 'active' : ''; ?>"
               style="padding: 0.8rem 2rem; border-radius: 8px; text-decoration: none; font-weight: 600; transition: all 0.2s;
                      background: <?php echo $location === 'baycity' ? 'var(--primary-color)' : 'transparent'; ?>;
                      color: <?php echo $location === 'baycity' ? 'white' : 'var(--primary-color)'; ?>;
                      border: 2px solid var(--primary-color);">
                <i class="fas fa-map-marker-alt"></i> Bay City Location
            </a>
        </div>
        <p style="margin-top: 1rem; color: #666; font-size: 0.95rem;">
            Currently viewing: <strong><?php echo $loc['name']; ?></strong> &mdash; 
            <a href="gallery.php?location=<?php echo $other; ?>" style="color: var(--primary-color); text-decoration: underline;">
                Switch to <?php echo $otherLoc['name']; ?>
            </a>
        </p>
    </div>
</section>

<!-- Gallery -->
<section class="section" style="background: #fff;">
    <div class="container">
        <div class="section-header">
            <h2>Explore Our <?php echo $loc['name']; ?> Community</h2>
            <p>See our comfortable living spaces, amenities, and vibrant community life at our <?php echo $loc['name']; ?> location</p>
        </div>

        <!-- Category Filter Buttons -->
        <div style="display: flex; flex-wrap: wrap; gap: 0.75rem; justify-content: center; margin-bottom: 3rem;">
            <button class="filter-btn active" data-filter="all">
                <i class="fas fa-th"></i> All Photos
            </button>
            <button class="filter-btn" data-filter="rooms">
                <i class="fas fa-bed"></i> Rooms &amp; Suites
            </button>
            <button class="filter-btn" data-filter="dining">
                <i class="fas fa-utensils"></i> Dining
            </button>
            <button class="filter-btn" data-filter="activities">
                <i class="fas fa-dumbbell"></i> Activities
            </button>
            <button class="filter-btn" data-filter="outdoor">
                <i class="fas fa-tree"></i> Outdoor
            </button>
            <button class="filter-btn" data-filter="common">
                <i class="fas fa-couch"></i> Common Areas
            </button>
            <button class="filter-btn" data-filter="care">
                <i class="fas fa-heart"></i> Care Areas
            </button>
        </div>

        <!-- Photo Grid -->
        <div class="gallery-grid" id="galleryGrid">
            <?php foreach ($gallery_items as $index => $item): 
                $img_path = 'images/gallery/' . $item['img'];
            ?>
            <div class="gallery-item" data-category="<?php echo $item['category']; ?>" data-index="<?php echo $index; ?>">
                <div class="gallery-thumb" style="background-color: <?php echo $item['color']; ?>;">
                    <!-- Location badge -->
                    <div class="location-badge">
                        <i class="fas fa-map-marker-alt"></i> <?php echo $loc['name']; ?>
                    </div>
                    <!-- Real image — falls back to colored placeholder if file not found -->
                    <img 
                        src="<?php echo $img_path; ?>" 
                        alt="<?php echo htmlspecialchars($item['title']); ?>"
                        onerror="this.style.display='none'; this.parentElement.classList.add('no-image');"
                        loading="lazy"
                    >
                    <!-- Placeholder icon shown when no image -->
                    <div class="placeholder-icon">
                        <i class="fas fa-camera"></i>
                        <span>Photo Coming Soon</span>
                    </div>
                    <!-- Hover overlay -->
                    <div class="gallery-overlay">
                        <i class="fas fa-expand-alt"></i>
                        <span>View Photo</span>
                    </div>
                </div>
                <div class="gallery-caption">
                    <h3><?php echo htmlspecialchars($item['title']); ?></h3>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

        <!-- No results message -->
        <div id="noResults" style="display:none; text-align:center; padding: 3rem; color: #666;">
            <i class="fas fa-images" style="font-size: 3rem; color: #ddd; margin-bottom: 1rem; display:block;"></i>
            No photos in this category yet.
        </div>

        <!-- Switch Location Prompt -->
        <div style="text-align: center; margin-top: 3rem; padding: 2rem; background: #f8f9fa; border-radius: 12px; border: 2px dashed #d0e0d8;">
            <i class="fas fa-map-marker-alt" style="font-size: 2rem; color: #1a4d2e; margin-bottom: 0.75rem; display:block;"></i>
            <h3 style="color: #1a4d2e; margin-bottom: 0.5rem;">Also Check Out Our <?php echo $otherLoc['name']; ?> Location</h3>
            <p style="color: #666; margin-bottom: 1rem;"><?php echo $otherLoc['address']; ?></p>
            <a href="gallery.php?location=<?php echo $other; ?>" class="btn-primary" style="display: inline-block;">
                <i class="fas fa-images"></i> View <?php echo $otherLoc['name']; ?> Gallery
            </a>
        </div>

        <!-- CTA -->
        <div style="text-align: center; margin-top: 5rem; padding-top: 3rem; border-top: 1px solid #eee;">
            <h2 style="color: #1a4d2e; margin-bottom: 1rem;">Want to See It in Person?</h2>
            <p style="font-size: 1.3rem; margin-bottom: 2rem; color: #666;">Photos don't do it justice — come visit our <?php echo $loc['name']; ?> location!</p>
            <div style="display: flex; gap: 1.5rem; justify-content: center; flex-wrap: wrap;">
                <a href="contact.php?location=<?php echo $location; ?>#tour-section" class="btn-primary">
                    <i class="fas fa-calendar-alt"></i> Schedule a Tour
                </a>
                <a href="tel:<?php echo preg_replace('/[^0-9]/', '', $loc['phone']); ?>" class="btn-secondary" style="border: 2px solid #1a4d2e; color: #1a4d2e;">
                    <i class="fas fa-phone"></i> <?php echo $loc['phone']; ?>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Lightbox Overlay -->
<div id="lightbox" style="display:none;">
    <div id="lightboxBackdrop"></div>
    <div id="lightboxContent">
        <button id="lightboxClose" title="Close"><i class="fas fa-times"></i></button>
        <button id="lightboxPrev" title="Previous"><i class="fas fa-chevron-left"></i></button>
        <button id="lightboxNext" title="Next"><i class="fas fa-chevron-right"></i></button>
        <div id="lightboxImageWrap">
            <img id="lightboxImg" src="" alt="">
            <div id="lightboxPlaceholder">
                <i class="fas fa-camera"></i>
                <p>Photo Coming Soon</p>
            </div>
        </div>
        <div id="lightboxCaption"></div>
        <div id="lightboxCounter"></div>
    </div>
</div>

<style>
/* Filter buttons */
.filter-btn {
    background: #f8f9fa;
    border: 2px solid #e0e0e0;
    color: #333;
    padding: 0.7rem 1.4rem;
    border-radius: 30px;
    font-size: 0.95rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.25s;
    font-family: 'Lato', sans-serif;
}
.filter-btn:hover {
    border-color: #1a4d2e;
    color: #1a4d2e;
}
.filter-btn.active {
    background: #1a4d2e;
    border-color: #1a4d2e;
    color: #fff;
}
.filter-btn i { margin-right: 0.4rem; }

/* Gallery grid */
.gallery-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    gap: 1.5rem;
}

/* Each item */
.gallery-item {
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    cursor: pointer;
    transition: transform 0.3s, box-shadow 0.3s;
}
.gallery-item:hover {
    transform: translateY(-6px);
    box-shadow: 0 12px 30px rgba(0,0,0,0.18);
}
.gallery-item.hidden { display: none; }

/* Thumbnail box */
.gallery-thumb {
    position: relative;
    height: 260px;
    overflow: hidden;
}
.gallery-thumb img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
    transition: transform 0.4s;
}
.gallery-item:hover .gallery-thumb img {
    transform: scale(1.07);
}

/* Location badge */
.location-badge {
    position: absolute;
    top: 0.75rem;
    left: 0.75rem;
    z-index: 3;
    background: #1a4d2e;
    color: white;
    padding: 0.3rem 0.8rem;
    border-radius: 5px;
    font-size: 0.8rem;
    font-weight: 600;
    font-family: 'Lato', sans-serif;
}

/* Placeholder when no image */
.placeholder-icon {
    display: none;
    position: absolute;
    inset: 0;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    color: rgba(255,255,255,0.8);
    gap: 0.5rem;
}
.placeholder-icon i { font-size: 2.5rem; }
.placeholder-icon span { font-size: 0.95rem; font-family: 'Lato', sans-serif; }
.gallery-thumb.no-image .placeholder-icon { display: flex; }

/* Hover overlay */
.gallery-overlay {
    position: absolute;
    inset: 0;
    background: rgba(26, 77, 46, 0.7);
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    color: #fff;
    gap: 0.5rem;
    opacity: 0;
    transition: opacity 0.3s;
}
.gallery-item:hover .gallery-overlay { opacity: 1; }
.gallery-overlay i { font-size: 2rem; }
.gallery-overlay span { font-size: 1rem; font-weight: 600; font-family: 'Lato', sans-serif; }

/* Caption */
.gallery-caption {
    background: #fff;
    padding: 1rem 1.25rem;
    display: flex;
    align-items: center;
    justify-content: space-between;
}
.gallery-caption h3 {
    font-size: 1.1rem;
    color: #1a4d2e;
    margin: 0;
}

/* ---- Lightbox ---- */
#lightbox {
    position: fixed;
    inset: 0;
    z-index: 9999;
}
#lightboxBackdrop {
    position: absolute;
    inset: 0;
    background: rgba(0,0,0,0.92);
}
#lightboxContent {
    position: absolute;
    inset: 0;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    padding: 2rem;
}
#lightboxImageWrap {
    max-width: 900px;
    max-height: 70vh;
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
}
#lightboxImg {
    max-width: 100%;
    max-height: 70vh;
    border-radius: 8px;
    box-shadow: 0 10px 50px rgba(0,0,0,0.5);
    display: block;
}
#lightboxPlaceholder {
    display: none;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    color: rgba(255,255,255,0.5);
    gap: 1rem;
    height: 300px;
    width: 100%;
    border: 2px dashed rgba(255,255,255,0.2);
    border-radius: 8px;
}
#lightboxPlaceholder i { font-size: 4rem; }
#lightboxPlaceholder p { font-size: 1.1rem; font-family: 'Lato', sans-serif; }
#lightboxCaption {
    margin-top: 1.25rem;
    color: #fff;
    font-size: 1.2rem;
    font-family: 'Merriweather', serif;
    text-align: center;
}
#lightboxCounter {
    color: rgba(255,255,255,0.5);
    font-size: 0.9rem;
    font-family: 'Lato', sans-serif;
    margin-top: 0.4rem;
}
/* Lightbox buttons */
#lightboxClose, #lightboxPrev, #lightboxNext {
    position: absolute;
    background: rgba(255,255,255,0.15);
    border: none;
    color: #fff;
    cursor: pointer;
    transition: background 0.2s;
    line-height: 1;
}
#lightboxClose:hover, #lightboxPrev:hover, #lightboxNext:hover {
    background: rgba(255,255,255,0.3);
}
#lightboxClose {
    top: 1.5rem;
    right: 1.5rem;
    width: 44px;
    height: 44px;
    border-radius: 50%;
    font-size: 1.2rem;
    display: flex; align-items: center; justify-content: center;
}
#lightboxPrev, #lightboxNext {
    top: 50%;
    transform: translateY(-50%);
    width: 50px;
    height: 50px;
    border-radius: 50%;
    font-size: 1.3rem;
    display: flex; align-items: center; justify-content: center;
}
#lightboxPrev { left: 1.5rem; }
#lightboxNext { right: 1.5rem; }

@media (max-width: 600px) {
    .gallery-grid { grid-template-columns: 1fr; }
    #lightboxPrev { left: 0.5rem; }
    #lightboxNext { right: 0.5rem; }
}
</style>

<script>
(function() {

    // ---- FILTER LOGIC ----
    const filterBtns = document.querySelectorAll('.filter-btn');
    const items      = document.querySelectorAll('.gallery-item');
    const noResults  = document.getElementById('noResults');

    filterBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            filterBtns.forEach(b => b.classList.remove('active'));
            btn.classList.add('active');

            const filter = btn.dataset.filter;
            let visible  = 0;

            items.forEach(item => {
                const match = filter === 'all' || item.dataset.category === filter;
                item.classList.toggle('hidden', !match);
                if (match) visible++;
            });

            noResults.style.display = visible === 0 ? 'block' : 'none';
        });
    });

    // ---- LIGHTBOX LOGIC ----
    const lightbox      = document.getElementById('lightbox');
    const lbImg         = document.getElementById('lightboxImg');
    const lbPlaceholder = document.getElementById('lightboxPlaceholder');
    const lbCaption     = document.getElementById('lightboxCaption');
    const lbCounter     = document.getElementById('lightboxCounter');
    const lbBackdrop    = document.getElementById('lightboxBackdrop');
    const lbClose       = document.getElementById('lightboxClose');
    const lbPrev        = document.getElementById('lightboxPrev');
    const lbNext        = document.getElementById('lightboxNext');

    // Gallery data from PHP
    const galleryData = <?php echo json_encode(array_map(function($item) {
        return [
            'src'   => 'images/gallery/' . $item['img'],
            'title' => $item['title'],
        ];
    }, $gallery_items)); ?>;

    let currentVisible = [];
    let currentIndex   = 0;

    function getVisibleItems() {
        return [...items].filter(i => !i.classList.contains('hidden'));
    }

    function openLightbox(index) {
        currentVisible = getVisibleItems();
        currentIndex   = index;
        lightbox.style.display = 'block';
        document.body.style.overflow = 'hidden';
        showSlide(currentIndex);
    }

    function showSlide(idx) {
        const item      = currentVisible[idx];
        const dataIndex = parseInt(item.dataset.index);
        const data      = galleryData[dataIndex];

        lbImg.style.display         = 'none';
        lbPlaceholder.style.display = 'none';

        const testImg = new Image();
        testImg.onload = function() {
            lbImg.src            = data.src;
            lbImg.alt            = data.title;
            lbImg.style.display  = 'block';
        };
        testImg.onerror = function() {
            lbPlaceholder.style.display = 'flex';
        };
        testImg.src = data.src;

        lbCaption.textContent = data.title;
        lbCounter.textContent = (idx + 1) + ' / ' + currentVisible.length;
    }

    function closeLightbox() {
        lightbox.style.display    = 'none';
        document.body.style.overflow = '';
        lbImg.src = '';
    }

    items.forEach((item) => {
        item.addEventListener('click', () => {
            const visibleList   = getVisibleItems();
            const posInVisible  = visibleList.indexOf(item);
            openLightbox(posInVisible);
        });
    });

    lbNext.addEventListener('click', () => {
        currentIndex = (currentIndex + 1) % currentVisible.length;
        showSlide(currentIndex);
    });
    lbPrev.addEventListener('click', () => {
        currentIndex = (currentIndex - 1 + currentVisible.length) % currentVisible.length;
        showSlide(currentIndex);
    });

    lbClose.addEventListener('click', closeLightbox);
    lbBackdrop.addEventListener('click', closeLightbox);

    document.addEventListener('keydown', e => {
        if (lightbox.style.display === 'none') return;
        if (e.key === 'Escape')     closeLightbox();
        if (e.key === 'ArrowRight') { currentIndex = (currentIndex + 1) % currentVisible.length; showSlide(currentIndex); }
        if (e.key === 'ArrowLeft')  { currentIndex = (currentIndex - 1 + currentVisible.length) % currentVisible.length; showSlide(currentIndex); }
    });

})();
</script>

<?php include 'includes/footer.php'; ?>