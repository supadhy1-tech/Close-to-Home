<?php 
$page_title = "Home";
include 'includes/header.php'; 
include 'includes/config.php';

?>

<!-- Hero Section with Background Image -->
<section class="hero-section" style="background: linear-gradient(rgba(26, 77, 46, 0.3), rgba(45, 122, 76, 0.25)), url('images/gallery/community-center.jpg') center/cover no-repeat; min-height: 600px; display: flex; align-items: center; padding: 4rem 2rem; filter: contrast(1.2) brightness(1.05);">
    <div class="hero-content" style="max-width: 1200px; margin: 0 auto; text-align: center; color: rgba(255, 255, 255, 0.95); background: rgba(0, 0, 0, 0.2); backdrop-filter: blur(3px); padding: 3rem 2rem; border-radius: 15px;">
        <h1 style="font-size: 3.5rem; margin-bottom: 1.5rem; text-shadow: 2px 2px 8px rgba(0,0,0,0.6); font-weight: 300; letter-spacing: 1px;">Living Your Best Life Starts Here</h1>
        <p class="subtitle" style="font-size: 1.8rem; margin-bottom: 1.5rem; color: rgba(212, 163, 115, 0.9); font-weight: 400; text-shadow: 1px 1px 4px rgba(0,0,0,0.5);">Compassionate Care • Vibrant Community • Peace of Mind</p>
        <p style="font-size: 1.2rem; max-width: 800px; margin: 0 auto 2.5rem; line-height: 1.8; text-shadow: 1px 1px 3px rgba(0,0,0,0.5); opacity: 0.9; font-weight: 300;">If you think there's not much going on in a senior living community, you've never been to Close to Saginaw. Imagine enjoying delicious, scratch-made meals, having a friendly caregiver always nearby, and a calendar full of social activities.</p>
        <div class="hero-buttons" style="display: flex; gap: 1.5rem; justify-content: center; flex-wrap: wrap;">
            <a href="contact.php#tour-section" class="btn-primary" style="padding: 1.2rem 2.5rem; font-size: 1.1rem; box-shadow: 0 4px 15px rgba(0,0,0,0.4);">Schedule Your Tour</a>
            <a href="about.php" class="btn-secondary" style="background: rgba(255,255,255,0.9); color: var(--primary-color); padding: 1.2rem 2.5rem; font-size: 1.1rem; box-shadow: 0 4px 15px rgba(0,0,0,0.4); backdrop-filter: blur(5px);">Learn About Our Care</a>
        </div>
    </div>
</section>

<!-- Location Selection Section -->
<section class="section" style="background: linear-gradient(135deg, #1a4d2e 0%, #2d7a4c 100%); color: #fff; padding: 4rem 2rem;">
    <div class="container">
        <div class="section-header" style="margin-bottom: 3rem;">
            <h2 style="color: #fff; font-size: 2.5rem;">Choose Your Location</h2>
            <p style="color: rgba(255,255,255,0.9); font-size: 1.3rem;">We have two convenient locations serving the greater Saginaw area</p>
        </div>
        
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 2.5rem; max-width: 1000px; margin: 0 auto;">
            <!-- Saginaw Location Card -->
            <a href="locations/saginaw.php" class="location-card-link" style="text-decoration: none;">
                <div class="card" style="background: rgba(255,255,255,0.95); backdrop-filter: blur(10px); border: 2px solid rgba(212, 163, 115, 0.5); color: #1a4d2e; transition: all 0.3s ease; cursor: pointer; height: 100%;">
                    <div style="text-align: center; padding: 1rem 0;">
                        <i class="fas fa-map-marker-alt" style="font-size: 4rem; color: #d4a373; margin-bottom: 1.5rem;"></i>
                        <h3 style="color: #1a4d2e; font-size: 2rem; margin-bottom: 1rem; font-family: 'Merriweather', serif;">Close to Saginaw</h3>
                        <p style="color: #2d7a4c; font-size: 1.1rem; margin-bottom: 1.5rem; font-weight: 500;">2160 N Center Rd, Saginaw, MI 48603</p>
                        
                        <div style="background: #f8f9fa; padding: 1.5rem; border-radius: 10px; margin: 1.5rem 0;">
                            <p style="margin-bottom: 0.8rem; color: #1a4d2e;"><i class="fas fa-phone" style="color: #d4a373;"></i> <strong>(989) 401-3581</strong></p>
                            <p style="margin-bottom: 0; color: #1a4d2e;"><i class="fas fa-envelope" style="color: #d4a373;"></i> saginaw2160@gmail.com</p>
                        </div>
                        
                        <div style="margin-top: 1.5rem;">
                            <span class="btn-primary" style="display: inline-block; padding: 1rem 2rem;">
                                View Saginaw Location <i class="fas fa-arrow-right"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </a>
            
            <!-- Bay City Location Card -->
            <a href="locations/baycity.php" class="location-card-link" style="text-decoration: none;">
                <div class="card" style="background: rgba(255,255,255,0.95); backdrop-filter: blur(10px); border: 2px solid rgba(212, 163, 115, 0.5); color: #1a4d2e; transition: all 0.3s ease; cursor: pointer; height: 100%;">
                    <div style="text-align: center; padding: 1rem 0;">
                        <i class="fas fa-city" style="font-size: 4rem; color: #d4a373; margin-bottom: 1.5rem;"></i>
                        <h3 style="color: #1a4d2e; font-size: 2rem; margin-bottom: 1rem; font-family: 'Merriweather', serif;">Close to Bay City</h3>
                        <p style="color: #2d7a4c; font-size: 1.1rem; margin-bottom: 1.5rem; font-weight: 500;">1805 Raymond St, Bay City, MI 48706</p>
                        
                        <div style="background: #f8f9fa; padding: 1.5rem; border-radius: 10px; margin: 1.5rem 0;">
                            <p style="margin-bottom: 0.8rem; color: #1a4d2e;"><i class="fas fa-phone" style="color: #d4a373;"></i> <strong>(989) 778-2575</strong></p>
                            <p style="margin-bottom: 0; color: #1a4d2e;"><i class="fas fa-envelope" style="color: #d4a373;"></i> saginaw2160@gmail.com</p>
                        </div>
                        
                        <div style="margin-top: 1.5rem;">
                            <span class="btn-primary" style="display: inline-block; padding: 1rem 2rem;">
                                View Bay City Location <i class="fas fa-arrow-right"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>
</section>

<!-- Stats Section -->
<section class="stats-section">
    <div class="stats-container">
        <div class="stat-item">
            <h3>2x</h3>
            <p>Resident Happiness vs. Industry Average</p>
        </div>
        <div class="stat-item">
            <h3>24/7</h3>
            <p>Professional Care & Support</p>
        </div>
        <div class="stat-item">
            <h3>100%</h3>
            <p>Family-Centered Approach</p>
        </div>
        <div class="stat-item">
            <h3>30+</h3>
            <p>Years Combined Staff Experience</p>
        </div>
    </div>
</section>

<!-- Services Preview Section -->
<section class="section" style="background: #fff;">
    <div class="container">
        <div class="section-header">
            <h2>Comprehensive Services for Every Need</h2>
            <p>From independent living to specialized memory care, we're here for every stage</p>
        </div>
        <div class="services-grid">
            <div class="service-card">
                <h3><i class="fas fa-hands-helping"></i> Assisted Living</h3>
                <p>Personalized assistance with daily activities while maintaining independence and dignity.</p>
                <ul>
                    <li>24-hour professional care</li>
                    <li>Medication management</li>
                    <li>Three meals daily</li>
                    <li>Housekeeping services</li>
                </ul>
                <a href="services/assisted-living.php" class="btn-primary" style="margin-top: 1.5rem; display: inline-block; padding: 0.8rem 2rem; font-size: 1rem;">Learn More</a>
            </div>
            <div class="service-card">
                <h3><i class="fas fa-brain"></i> Memory Care</h3>
                <p>Specialized care for residents with Alzheimer's and other forms of dementia.</p>
                <ul>
                    <li>Secure environment</li>
                    <li>Trained specialists</li>
                    <li>Memory programs</li>
                    <li>Family support</li>
                </ul>
                <a href="services/memory-care.php" class="btn-primary" style="margin-top: 1.5rem; display: inline-block; padding: 0.8rem 2rem; font-size: 1rem;">Learn More</a>
            </div>
            <div class="service-card">
                <h3><i class="fas fa-house-user"></i> Independent Living</h3>
                <p>Maintenance-free living with access to amenities and care when you need it.</p>
                <ul>
                    <li>Private apartments</li>
                    <li>Social activities</li>
                    <li>Fitness programs</li>
                    <li>Community dining</li>
                </ul>
                <a href="services/independent-living.php" class="btn-primary" style="margin-top: 1.5rem; display: inline-block; padding: 0.8rem 2rem; font-size: 1rem;">Learn More</a>
            </div>
        </div>
        <div style="text-align: center; margin-top: 3rem;">
            <a href="services.php" class="btn-secondary" style="border: 2px solid var(--primary-color); color: var(--primary-color);">View All Services</a>
        </div>
    </div>
</section>

<!-- Why Choose Us Section -->
<section class="section" style="background: linear-gradient(135deg, #1a4d2e 0%, #2d7a4c 100%); color: #fff;">
    <div class="container">
        <div class="section-header" style="margin-bottom: 3rem;">
            <h2 style="color: #fff;">The Close to Saginaw Care Promise</h2>
            <p style="color: rgba(255,255,255,0.9);">We're championing a higher standard of senior care</p>
        </div>
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 2rem; max-width: 1200px; margin: 0 auto;">
            <div class="card" style="background: rgba(255,255,255,0.1); backdrop-filter: blur(10px); border: 1px solid rgba(255,255,255,0.2); color: #fff;">
                <i class="fas fa-users" style="font-size: 3rem; color: #d4a373; margin-bottom: 1rem;"></i>
                <h3 style="color: #d4a373;">Interdisciplinary Care Team</h3>
                <p style="color: rgba(255,255,255,0.9);">Our team of professionals works together to ensure your loved one gets the proactive interventions they need to thrive every day.</p>
            </div>
            <div class="card" style="background: rgba(255,255,255,0.1); backdrop-filter: blur(10px); border: 1px solid rgba(255,255,255,0.2); color: #fff;">
                <i class="fas fa-clipboard-list" style="font-size: 3rem; color: #d4a373; margin-bottom: 1rem;"></i>
                <h3 style="color: #d4a373;">Personalized Care Plans</h3>
                <p style="color: rgba(255,255,255,0.9);">Every resident receives a customized care plan designed around their unique needs, preferences, and health goals.</p>
            </div>
            <div class="card" style="background: rgba(255,255,255,0.1); backdrop-filter: blur(10px); border: 1px solid rgba(255,255,255,0.2); color: #fff;">
                <i class="fas fa-heart" style="font-size: 3rem; color: #d4a373; margin-bottom: 1rem;"></i>
                <h3 style="color: #d4a373;">Family Partnership</h3>
                <p style="color: rgba(255,255,255,0.9);">We believe in open communication and partnership with families. You're always informed and involved in care decisions.</p>
            </div>
            <div class="card" style="background: rgba(255,255,255,0.1); backdrop-filter: blur(10px); border: 1px solid rgba(255,255,255,0.2); color: #fff;">
                <i class="fas fa-chart-line" style="font-size: 3rem; color: #d4a373; margin-bottom: 1rem;"></i>
                <h3 style="color: #d4a373;">Outcome-Focused Approach</h3>
                <p style="color: rgba(255,255,255,0.9);">We use proven methods and technology to track wellness outcomes and continuously improve quality of life.</p>
            </div>
        </div>
    </div>
</section>

<!-- Testimonials Preview -->
<section class="section" style="background: #f8f9fa;">
    <div class="container">
        <div class="section-header">
            <h2>What Families Are Saying</h2>
            <p>Don't just take our word for it — hear from the families we serve</p>
        </div>
        <?php
        // Get featured testimonials from MongoDB
        $testimonialsCollection = getCollection('testimonials');
        $cursor = $testimonialsCollection->find(
            [
                'is_featured' => true,
                'approved' => true
            ],
            [
                'sort' => ['created_at' => -1],
                'limit' => 3
            ]
        );
        $testimonials = iterator_to_array($cursor);
        ?>
        <div class="testimonials-grid">
            <?php foreach($testimonials as $row): ?>
            <div class="testimonial-card">
                <div class="testimonial-rating">
                    <?php for($i = 0; $i < $row['rating']; $i++): ?>★<?php endfor; ?>
                </div>
                <div class="testimonial-text">
                    <?php echo htmlspecialchars($row['testimonial_text']); ?>
                </div>
                <div class="testimonial-author">
                    — <?php echo htmlspecialchars($row['author_name']); ?>, <?php echo htmlspecialchars($row['relationship']); ?>
                </div>
            </div>
            <?php endforeach; ?>
            
            <?php if (count($testimonials) == 0): ?>
            <div class="testimonial-card">
                <div class="testimonial-text">
                    <em>No testimonials available yet. Check back soon!</em>
                </div>
            </div>
            <?php endif; ?>
        </div>
        <div style="text-align: center; margin-top: 3rem;">
            <a href="experiences.php" class="btn-primary">Read More Stories</a>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="section" style="background: #fff; padding: 4rem 2rem;">
    <div class="container">
        <div style="max-width: 800px; margin: 0 auto; text-align: center; background: linear-gradient(135deg, #1a4d2e 0%, #2d7a4c 100%); padding: 4rem 3rem; border-radius: 15px; color: #fff;">
            <h2 style="font-size: 2.5rem; margin-bottom: 1.5rem; color: #fff;">Ready to Learn More?</h2>
            <p style="font-size: 1.3rem; margin-bottom: 2rem; color: rgba(255,255,255,0.9);">Schedule a personal tour and experience the Close to Saginaw difference. We'd love to welcome you home.</p>
            <div style="display: flex; gap: 1.5rem; justify-content: center; flex-wrap: wrap;">
                <a href="contact.php#tour-section" class="btn-primary">Schedule a Tour</a>
                <a href="tel:9894013581" class="btn-secondary" style="background: rgba(255,255,255,0.2); backdrop-filter: blur(10px);"><i class="fas fa-phone"></i> Call Saginaw: (989) 401-3581</a>
            </div>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>