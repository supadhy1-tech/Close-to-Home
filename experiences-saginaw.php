<?php 
$page_title = "Saginaw Testimonials & Experiences";
include 'includes/header.php';
include 'includes/config.php';
// require_once 'includes/db.php';

// Force location to Saginaw
$location = 'saginaw';
$location_name = 'Close to Saginaw';
$location_phone = '(989) 401-3581';
$location_address = '2160 N Center Rd, Saginaw, MI 48603';
?>

<!-- Page Header -->
<section class="hero-section" style="min-height: 50vh; background: linear-gradient(135deg, rgba(26, 77, 46, 0.3) 0%, rgba(76, 139, 99, 0.25) 100%), url('/images/gallery/happy.jpg') center/cover no-repeat; display: flex; align-items: center; position: relative; filter: contrast(1.2) brightness(1.05);">
    <div class="hero-content" style="position: relative; z-index: 2; text-align: center; color: rgba(255, 255, 255, 0.95); max-width: 1200px; margin: 0 auto; padding: 3rem 2rem; background: rgba(0, 0, 0, 0.2); backdrop-filter: blur(3px); border-radius: 15px;">
        <h1 style="font-size: 3.5rem; margin-bottom: 1rem; text-shadow: 2px 2px 8px rgba(0,0,0,0.6); font-weight: 300; letter-spacing: 1px;">Close to Home- Saginaw Stories</h1>
        <p class="subtitle" style="font-size: 1.5rem; color: rgba(212, 163, 115, 0.9); font-weight: 400; text-shadow: 1px 1px 4px rgba(0,0,0,0.5);">Real families, real experiences from our Saginaw location</p>
        <div style="margin-top: 1.5rem;">
            <span style="background: rgba(255,255,255,0.2); padding: 0.5rem 1.5rem; border-radius: 50px; backdrop-filter: blur(10px); display: inline-block;">
                <i class="fas fa-map-marker-alt"></i> 2160 N Center Rd, Saginaw, MI 48603
            </span>
        </div>
    </div>
</section>

<!-- Location Switcher -->
<section class="section" style="background: #f8f9fa; padding: 1.5rem 0;">
    <div class="container" style="text-align: center;">
        <div style="display: inline-flex; gap: 1rem; background: #fff; padding: 0.5rem; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
            <a href="experiences-saginaw.php" class="btn-secondary" style="padding: 0.8rem 2rem; background: var(--primary-color); color: white;">
                <i class="fas fa-map-marker-alt"></i> Saginaw Location
            </a>
            <a href="experiences-baycity.php" class="btn-secondary" style="padding: 0.8rem 2rem; background: transparent; color: var(--primary-color); border: 2px solid var(--primary-color);">
                <i class="fas fa-map-marker-alt"></i> Bay City Location
            </a>
        </div>
    </div>
</section>

<!-- Location Highlight Section -->
<section class="section" style="background: linear-gradient(135deg, #1a4d2e 0%, #2d7a4c 100%); color: white; padding: 3rem 0;">
    <div class="container">
        <div style="max-width: 900px; margin: 0 auto; text-align: center;">
            <h2 style="font-size: 2.5rem; margin-bottom: 1.5rem; color: white;">Welcome to Close to Saginaw</h2>
            <p style="font-size: 1.2rem; line-height: 1.8; color: rgba(255,255,255,0.9); margin-bottom: 2rem;">
                Located in the heart of Saginaw, our community has been providing exceptional care and creating meaningful experiences for families since our opening. Our Saginaw location offers a warm, home-like environment where residents thrive with personalized care and engaging activities.
            </p>
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1.5rem; margin-top: 2rem;">
                <div style="background: rgba(255,255,255,0.1); padding: 1.5rem; border-radius: 10px; backdrop-filter: blur(10px);">
                    <i class="fas fa-users" style="font-size: 2.5rem; color: #d4a373; margin-bottom: 0.5rem;"></i>
                    <h3 style="font-size: 1.3rem; margin-bottom: 0.5rem;">50+ Residents</h3>
                    <p style="font-size: 0.95rem; opacity: 0.9;">Happy families served</p>
                </div>
                <div style="background: rgba(255,255,255,0.1); padding: 1.5rem; border-radius: 10px; backdrop-filter: blur(10px);">
                    <i class="fas fa-heart" style="font-size: 2.5rem; color: #d4a373; margin-bottom: 0.5rem;"></i>
                    <h3 style="font-size: 1.3rem; margin-bottom: 0.5rem;">Compassionate Care</h3>
                    <p style="font-size: 0.95rem; opacity: 0.9;">24/7 professional staff</p>
                </div>
                <div style="background: rgba(255,255,255,0.1); padding: 1.5rem; border-radius: 10px; backdrop-filter: blur(10px);">
                    <i class="fas fa-home" style="font-size: 2.5rem; color: #d4a373; margin-bottom: 0.5rem;"></i>
                    <h3 style="font-size: 1.3rem; margin-bottom: 0.5rem;">Home-Like</h3>
                    <p style="font-size: 0.95rem; opacity: 0.9;">Comfortable living spaces</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Testimonials Section -->
<section class="section" style="background: #fff;">
    <div class="container">
        <div class="section-header">
            <h2>What Families Are Saying About <?php echo $location_name; ?></h2>
            <p>These heartfelt testimonials from our Saginaw families speak to the quality of care and community we provide</p>
        </div>

        <?php
        // Get only Saginaw testimonials
        $testimonialsCollection = getCollection('testimonials');

        $filter = [
            'approved' => true,
            'location' => 'saginaw'
        ];

        $options = [
            'sort' => [
                'is_featured' => -1,
                'created_at' => -1
            ]
        ];

        $testimonials = $testimonialsCollection->find($filter, $options);

        if ($testimonialsCollection->countDocuments($filter) === 0) {
            echo '<div style="text-align: center; padding: 3rem 0; color: #666;">';
            echo '<p style="font-size: 1.2rem;">No testimonials available for Saginaw yet.</p>';
            echo '<p style="margin-top: 1rem;">Be the first to share your experience!</p>';
            echo '</div>';
        }
        ?>

        <div class="testimonials-grid">
            <?php foreach ($testimonials as $row): ?>
            <div class="testimonial-card">
                <div style="display: inline-block; background: #1a4d2e; color: white; padding: 0.3rem 0.8rem; border-radius: 5px; font-size: 0.85rem; margin-bottom: 1rem;">
                    <i class="fas fa-map-marker-alt"></i> Saginaw
                </div>
                <div class="testimonial-rating">
                    <?php for($i = 0; $i < $row['rating']; $i++): ?>★<?php endfor; ?>
                </div>
                <div class="testimonial-text">
                    <?php echo htmlspecialchars($row['testimonial_text']); ?>
                </div>
                <div class="testimonial-author">
                    — <?php echo htmlspecialchars($row['author_name']); ?>
                    <?php if(isset($row['relationship']) && $row['relationship']): ?>
                        , <?php echo htmlspecialchars($row['relationship']); ?>
                    <?php endif; ?>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Saginaw Photo Gallery Section -->
<section class="section" style="background: #f8f9fa;">
    <div class="container">
        <div class="section-header">
            <h2>See Our Saginaw Community</h2>
            <p>Take a visual tour of our beautiful Saginaw facility</p>
        </div>
        
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 1.5rem; margin-top: 2rem;">
            <div style="position: relative; overflow: hidden; border-radius: 10px; height: 250px; background: #e0e0e0;">
                <img src="images/gallery/living-room.jpg" alt="Saginaw Living Room" style="width: 100%; height: 100%; object-fit: cover;">
                <div style="position: absolute; bottom: 0; left: 0; right: 0; background: linear-gradient(to top, rgba(0,0,0,0.7), transparent); padding: 1.5rem; color: white;">
                    <h3 style="font-size: 1.2rem; margin-bottom: 0.3rem;">Welcoming Common Areas</h3>
                    <p style="font-size: 0.9rem; opacity: 0.9;">Comfortable spaces for socializing</p>
                </div>
            </div>
            
            <div style="position: relative; overflow: hidden; border-radius: 10px; height: 250px; background: #e0e0e0;">
                <img src="images/gallery/dining.jpg" alt="Saginaw Dining Room" style="width: 100%; height: 100%; object-fit: cover;">
                <div style="position: absolute; bottom: 0; left: 0; right: 0; background: linear-gradient(to top, rgba(0,0,0,0.7), transparent); padding: 1.5rem; color: white;">
                    <h3 style="font-size: 1.2rem; margin-bottom: 0.3rem;">Restaurant-Style Dining</h3>
                    <p style="font-size: 0.9rem; opacity: 0.9;">Delicious meals daily</p>
                </div>
            </div>
            
            <div style="position: relative; overflow: hidden; border-radius: 10px; height: 250px; background: #e0e0e0;">
                <img src="images/gallery/activity-singing-sagiaw.jpg" alt="Saginaw Activities" style="width: 100%; height: 100%; object-fit: cover;">
                <div style="position: absolute; bottom: 0; left: 0; right: 0; background: linear-gradient(to top, rgba(0,0,0,0.7), transparent); padding: 1.5rem; color: white;">
                    <h3 style="font-size: 1.2rem; margin-bottom: 0.3rem;">Activity Center</h3>
                    <p style="font-size: 0.9rem; opacity: 0.9;">Engaging programs daily</p>
                </div>
            </div>
            
            <div style="position: relative; overflow: hidden; border-radius: 10px; height: 250px; background: #e0e0e0;">
                <img src="images/gallery/private-suites.jpg" alt="Saginaw Private Suites" style="width: 100%; height: 100%; object-fit: cover;">
                <div style="position: absolute; bottom: 0; left: 0; right: 0; background: linear-gradient(to top, rgba(0,0,0,0.7), transparent); padding: 1.5rem; color: white;">
                    <h3 style="font-size: 1.2rem; margin-bottom: 0.3rem;">Private Suites</h3>
                    <p style="font-size: 0.9rem; opacity: 0.9;">Comfortable & spacious</p>
                </div>
            </div>
            
            <div style="position: relative; overflow: hidden; border-radius: 10px; height: 250px; background: #e0e0e0;">
                <img src="images/gallery/memory care.jpg" alt="Saginaw Memory Care" style="width: 100%; height: 100%; object-fit: cover;">
                <div style="position: absolute; bottom: 0; left: 0; right: 0; background: linear-gradient(to top, rgba(0,0,0,0.7), transparent); padding: 1.5rem; color: white;">
                    <h3 style="font-size: 1.2rem; margin-bottom: 0.3rem;">Memory Care</h3>
                    <p style="font-size: 0.9rem; opacity: 0.9;">Specialized care wing</p>
                </div>
            </div>
            
            <div style="position: relative; overflow: hidden; border-radius: 10px; height: 250px; background: #e0e0e0;">
                <img src="images/gallery/saginaw-living.jpg" alt="Saginaw Fitness" style="width: 100%; height: 100%; object-fit: cover;">
                <div style="position: absolute; bottom: 0; left: 0; right: 0; background: linear-gradient(to top, rgba(0,0,0,0.7), transparent); padding: 1.5rem; color: white;">
                    <h3 style="font-size: 1.2rem; margin-bottom: 0.3rem;">Living Arena</h3>
                    <p style="font-size: 0.9rem; opacity: 0.9;">Fresh and cozy place</p>
                </div>
            </div>
        </div>
        
        <div style="text-align: center; margin-top: 2rem;">
            <a href="gallery.php?location=saginaw" class="btn-primary">View Full Saginaw Gallery</a>
        </div>
    </div>
</section>

<!-- Share Your Story Section -->
<section class="section" style="background: #fff;">
    <div class="container">
        <div style="max-width: 800px; margin: 0 auto; text-align: center;">
            <h2 style="font-size: 2.5rem; color: #1a4d2e; margin-bottom: 1.5rem;">Share Your Saginaw Experience</h2>
            <p style="font-size: 1.2rem; margin-bottom: 2rem; color: #666;">Have a story to share about your experience at Close to Saginaw? We'd love to hear from you!</p>
            
            <form method="POST" action="submit_testimonial.php" style="background: #f8f9fa; padding: 3rem; border-radius: 10px; box-shadow: 0 5px 25px rgba(0,0,0,0.1); text-align: left;">
                <input type="hidden" name="location" value="saginaw">
                
                <div class="form-group">
                    <label for="author_name">Your Name *</label>
                    <input type="text" id="author_name" name="author_name" required>
                </div>
                
                <div class="form-group">
                    <label for="relationship">Your Relationship *</label>
                    <select id="relationship" name="relationship" required>
                        <option value="">Select...</option>
                        <option value="Family Member">Family Member</option>
                        <option value="Son">Son</option>
                        <option value="Daughter">Daughter</option>
                        <option value="Spouse">Spouse</option>
                        <option value="Friend">Friend</option>
                        <option value="Resident">Resident</option>
                        <option value="Other">Other</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="rating">Rating *</label>
                    <select id="rating" name="rating" required>
                        <option value="5">★★★★★ (5 stars)</option>
                        <option value="4">★★★★☆ (4 stars)</option>
                        <option value="3">★★★☆☆ (3 stars)</option>
                        <option value="2">★★☆☆☆ (2 stars)</option>
                        <option value="1">★☆☆☆☆ (1 star)</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="testimonial_text">Your Testimonial *</label>
                    <textarea id="testimonial_text" name="testimonial_text" required placeholder="Share your experience with Close to Saginaw..." style="min-height: 150px;"></textarea>
                </div>
                
                <button type="submit" class="btn-primary" style="width: 100%;">Submit Testimonial</button>
                <p style="margin-top: 1rem; font-size: 0.9rem; color: #666; text-align: center;">
                    <em>All testimonials are reviewed before being published.</em>
                </p>
            </form>
        </div>
    </div>
</section>

<!-- Saginaw Stats Section -->
<section class="stats-section">
    <div class="stats-container">
        <div class="stat-item">
            <h3>98%</h3>
            <p>Family Satisfaction</p>
        </div>
        <div class="stat-item">
            <h3>4.9/5</h3>
            <p>Average Rating</p>
        </div>
        <div class="stat-item">
            <h3>50+</h3>
            <p>Happy Families</p>
        </div>
        <div class="stat-item">
            <h3>5★</h3>
            <p>Most Common Rating</p>
        </div>
    </div>
</section>

<!-- Saginaw CTA Section -->
<section class="section" style="background: #fff;">
    <div class="container">
        <div style="max-width: 900px; margin: 0 auto; text-align: center; background: linear-gradient(135deg, #1a4d2e 0%, #2d7a4c 100%); padding: 4rem 3rem; border-radius: 15px; color: #fff;">
            <h2 style="font-size: 2.5rem; margin-bottom: 1.5rem; color: #fff;">Experience Close to Saginaw Yourself</h2>
            <p style="font-size: 1.3rem; margin-bottom: 2rem; color: rgba(255,255,255,0.9);">See why families choose our Saginaw location. Schedule your personal tour today.</p>
            
            <div style="background: rgba(255,255,255,0.1); padding: 2rem; border-radius: 10px; margin-bottom: 2rem; backdrop-filter: blur(10px);">
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1.5rem; text-align: left;">
                    <div>
                        <div style="font-size: 0.9rem; opacity: 0.8; margin-bottom: 0.5rem;">📍 Address</div>
                        <div style="font-size: 1.1rem; font-weight: 600;"><?php echo $location_address; ?></div>
                    </div>
                    <div>
                        <div style="font-size: 0.9rem; opacity: 0.8; margin-bottom: 0.5rem;">📞 Phone</div>
                        <div style="font-size: 1.1rem; font-weight: 600;"><?php echo $location_phone; ?></div>
                    </div>
                    <div>
                        <div style="font-size: 0.9rem; opacity: 0.8; margin-bottom: 0.5rem;">⏰ Tour Hours</div>
                        <div style="font-size: 1.1rem; font-weight: 600;">Mon-Sat, 9AM-5PM</div>
                    </div>
                </div>
            </div>
            
            <div style="display: flex; gap: 1.5rem; justify-content: center; flex-wrap: wrap;">
                <a href="contact.php?location=saginaw#tour-section" class="btn-primary" style="background: #d4a373; color: white; padding: 1rem 2.5rem;">
                    <i class="fas fa-calendar-alt"></i> Schedule a Tour
                </a>
                <a href="tel:<?php echo str_replace(['(', ')', ' ', '-'], '', $location_phone); ?>" class="btn-secondary" style="background: rgba(255,255,255,0.2); backdrop-filter: blur(10px); padding: 1rem 2.5rem;">
                    <i class="fas fa-phone"></i> Call Now
                </a>
            </div>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>