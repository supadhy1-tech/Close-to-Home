<?php 
$page_title = "Bay City Location";
include '../includes/header.php'; 
?>

<!-- Page Header -->
<section class="hero-section" style="min-height: 50vh; background: linear-gradient(135deg, rgba(26, 77, 46, 0.3) 0%, rgba(76, 139, 99, 0.25) 100%), url('/images/gallery/close-to-baycity-front.jpg') center/cover no-repeat; display: flex; align-items: center; position: relative; filter: contrast(1.2) brightness(1.05);">
    <div class="hero-content" style="position: relative; z-index: 2; text-align: center; color: rgba(255, 255, 255, 0.95); max-width: 1200px; margin: 0 auto; padding: 3rem 2rem; background: rgba(0, 0, 0, 0.2); backdrop-filter: blur(3px); border-radius: 15px;">
        <h1 style="font-size: 3.5rem; margin-bottom: 1rem; text-shadow: 2px 2px 8px rgba(0,0,0,0.6); font-weight: 300; letter-spacing: 1px;">
            <i class="fas fa-map-marker-alt" style="color: #d4a373;"></i> Close to Home-Bay City
        </h1>
        <p class="subtitle" style="font-size: 1.5rem; color: rgba(212, 163, 115, 0.9); font-weight: 400; text-shadow: 1px 1px 4px rgba(0,0,0,0.5);">1805 Raymond St, Bay City, MI 48706</p>
    </div>
</section>

<!-- Contact Information -->
<section class="section" style="background: #fff;">
    <div class="container">
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 2rem; max-width: 1000px; margin: 0 auto;">
            <div class="card" style="text-align: center;">
                <i class="fas fa-phone" style="font-size: 3rem; color: #d4a373; margin-bottom: 1rem;"></i>
                <h3>Call Us</h3>
                <p style="font-size: 1.5rem; font-weight: 700; color: #1a4d2e; margin: 1rem 0;">
                    <a href="tel:9897782575" style="color: #1a4d2e;">(989) 778-2575</a>
                </p>
                <p>Open 24 Hours</p>
            </div>
            <div class="card" style="text-align: center;">
                <i class="fas fa-envelope" style="font-size: 3rem; color: #d4a373; margin-bottom: 1rem;"></i>
                <h3>Email Us</h3>
                <p style="font-size: 1.2rem; font-weight: 700; color: #1a4d2e; margin: 1rem 0;">
                    <a href="mailto:saginaw2160@gmail.com" style="color: #1a4d2e;">saginaw2160@gmail.com</a>
                </p>
                <p>We typically respond within 2 hours during business hours</p>
            </div>
            <div class="card" style="text-align: center;">
                <i class="fas fa-map-marker-alt" style="font-size: 3rem; color: #d4a373; margin-bottom: 1rem;"></i>
                <h3>Visit Us</h3>
                <p style="font-weight: 700; color: #1a4d2e; margin: 1rem 0;">
                    1805 Raymond St<br>
                    Bay City, MI 48706
                </p>
                <p>Open 24 Hours</p>
            </div>
        </div>
    </div>
</section>

<!-- About This Location -->
<section class="section" style="background: #f8f9fa;">
    <div class="container">
        <div class="section-header">
            <h2>About Our Bay City Community</h2>
            <p>Bringing exceptional senior care to the Bay City area</p>
        </div>
        
        <div style="max-width: 900px; margin: 0 auto;">
            <div class="card">
                <p style="font-size: 1.1rem; line-height: 1.8; margin-bottom: 1.5rem;">
                    Our Bay City location extends the Close to Home tradition of excellence to families throughout the Bay City area. We're proud to bring our compassionate care philosophy and comprehensive services to this vibrant community along the beautiful Saginaw Bay.
                </p>
                <p style="font-size: 1.1rem; line-height: 1.8; margin-bottom: 1.5rem;">
                    Designed with the same commitment to quality and comfort as our Saginaw facility, our Bay City location features modern amenities, welcoming common spaces, and a dedicated team focused on making every resident feel valued and at home. We're easily accessible from Bay City, Essexville, Auburn, and surrounding communities.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Services Offered -->
<section class="section" style="background: #fff;">
    <div class="container">
        <div class="section-header">
            <h2>Services at Our Bay City Location</h2>
            <p>Comprehensive care tailored to your unique needs</p>
        </div>
        
        <div class="services-grid">
            <div class="service-card">
                <h3><i class="fas fa-hands-helping"></i> Assisted Living</h3>
                <p>Personalized assistance with daily activities while maintaining independence and dignity.</p>
                <ul>
                    <li>24-hour professional care</li>
                    <li>Medication management</li>
                    <li>Three chef-prepared meals daily</li>
                    <li>Housekeeping & laundry services</li>
                </ul>
                <a href="/services/assisted-living.php" class="btn-secondary" style="margin-top: 1.5rem; display: inline-block;">Learn More</a>
            </div>
            
            <div class="service-card">
                <h3><i class="fas fa-brain"></i> Memory Care</h3>
                <p>Specialized care for residents with Alzheimer's and other forms of dementia.</p>
                <ul>
                    <li>Secure, supportive environment</li>
                    <li>Specially trained staff</li>
                    <li>Memory-enhancing programs</li>
                    <li>Family education & support</li>
                </ul>
                <a href="/services/memory-care.php" class="btn-secondary" style="margin-top: 1.5rem; display: inline-block;">Learn More</a>
            </div>
            
            <div class="service-card">
                <h3><i class="fas fa-house-user"></i> Independent Living</h3>
                <p>Maintenance-free living with access to amenities and care when you need it.</p>
                <ul>
                    <li>Private apartments</li>
                    <li>Social activities & events</li>
                    <li>Fitness & wellness programs</li>
                    <li>Transportation services</li>
                </ul>
                <a href="/services/independent-living.php" class="btn-secondary" style="margin-top: 1.5rem; display: inline-block;">Learn More</a>
            </div>
            
            <div class="service-card">
                <h3><i class="fas fa-heartbeat"></i> Rehabilitation Services</h3>
                <p>Professional therapy services to help you recover and regain strength.</p>
                <ul>
                    <li>Physical therapy</li>
                    <li>Occupational therapy</li>
                    <li>Speech therapy</li>
                    <li>Post-surgical recovery</li>
                </ul>
                <a href="/services/rehabilitation.php" class="btn-secondary" style="margin-top: 1.5rem; display: inline-block;">Learn More</a>
            </div>
            
            <div class="service-card">
                <h3><i class="fas fa-clock"></i> Respite Care</h3>
                <p>Short-term care giving family caregivers a well-deserved break.</p>
                <ul>
                    <li>Flexible stay options</li>
                    <li>Full access to amenities</li>
                    <li>Professional 24/7 care</li>
                    <li>Peace of mind for families</li>
                </ul>
                <a href="/services/respite-care.php" class="btn-secondary" style="margin-top: 1.5rem; display: inline-block;">Learn More</a>
            </div>
            
            <div class="service-card">
                <h3><i class="fas fa-palette"></i> Life Enrichment</h3>
                <p>Engaging activities designed to promote wellness and joy.</p>
                <ul>
                    <li>Daily activities & events</li>
                    <li>Arts & crafts programs</li>
                    <li>Fitness classes</li>
                    <li>Outings & entertainment</li>
                </ul>
                <a href="/services/life-enrichment.php" class="btn-secondary" style="margin-top: 1.5rem; display: inline-block;">Learn More</a>
            </div>
        </div>
    </div>
</section>

<!-- Amenities -->
<section class="section" style="background: #f8f9fa;">
    <div class="container">
        <div class="section-header">
            <h2>Amenities at Our Bay City Location</h2>
            <p>Everything you need for comfortable, enriching living</p>
        </div>
        
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 1.5rem; max-width: 1000px; margin: 0 auto;">
            <div class="card" style="text-align: center; padding: 2rem;">
                <i class="fas fa-utensils" style="font-size: 2.5rem; color: #d4a373; margin-bottom: 1rem;"></i>
                <h4>Restaurant-Style Dining</h4>
                <p>Chef-prepared meals in our elegant dining room</p>
            </div>
            <div class="card" style="text-align: center; padding: 2rem;">
                <i class="fas fa-dumbbell" style="font-size: 2.5rem; color: #d4a373; margin-bottom: 1rem;"></i>
                <h4>Fitness Center</h4>
                <p>State-of-the-art equipment and wellness classes</p>
            </div>
            <div class="card" style="text-align: center; padding: 2rem;">
                <i class="fas fa-book" style="font-size: 2.5rem; color: #d4a373; margin-bottom: 1rem;"></i>
                <h4>Library & Reading Room</h4>
                <p>Quiet spaces for reading and reflection</p>
            </div>
            <div class="card" style="text-align: center; padding: 2rem;">
                <i class="fas fa-tree" style="font-size: 2.5rem; color: #d4a373; margin-bottom: 1rem;"></i>
                <h4>Outdoor Spaces</h4>
                <p>Beautiful gardens and walking paths</p>
            </div>
            <div class="card" style="text-align: center; padding: 2rem;">
                <i class="fas fa-music" style="font-size: 2.5rem; color: #d4a373; margin-bottom: 1rem;"></i>
                <h4>Activity Center</h4>
                <p>Space for games, crafts, and entertainment</p>
            </div>
            <div class="card" style="text-align: center; padding: 2rem;">
                <i class="fas fa-spa" style="font-size: 2.5rem; color: #d4a373; margin-bottom: 1rem;"></i>
                <h4>Therapy Services</h4>
                <p>Professional massage and therapy services available daily</p>
            </div>
        </div>
    </div>
</section>

<!-- Why Choose Bay City Location -->
<section class="section" style="background: #fff;">
    <div class="container">
        <div class="section-header">
            <h2>Why Choose Our Bay City Location?</h2>
            <p>The perfect blend of local charm and exceptional care</p>
        </div>
        
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 2rem; max-width: 1000px; margin: 0 auto;">
            <div class="card">
                <i class="fas fa-heart" style="font-size: 2.5rem; color: #d4a373; margin-bottom: 1rem;"></i>
                <h3 style="color: #1a4d2e;">Community Connection</h3>
                <p>We're proud to be part of the Bay City community, with close connections to local organizations, churches, and events.</p>
            </div>
            <div class="card">
                <i class="fas fa-users" style="font-size: 2.5rem; color: #d4a373; margin-bottom: 1rem;"></i>
                <h3 style="color: #1a4d2e;">Local Team</h3>
                <p>Our staff members are your neighbors, bringing local knowledge and genuine care to everything we do.</p>
            </div>
            <div class="card">
                <i class="fas fa-map-marked-alt" style="font-size: 2.5rem; color: #d4a373; margin-bottom: 1rem;"></i>
                <h3 style="color: #1a4d2e;">Convenient Location</h3>
                <p>Easily accessible from throughout the Bay City area, making family visits simple and frequent.</p>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="section" style="background: #fff; padding: 4rem 2rem;">
    <div class="container">
        <div style="max-width: 800px; margin: 0 auto; text-align: center; background: linear-gradient(135deg, #1a4d2e 0%, #2d7a4c 100%); padding: 4rem 3rem; border-radius: 15px; color: #fff;">
            <h2 style="font-size: 2.5rem; margin-bottom: 1.5rem; color: #fff;">Visit Our Bay City Location</h2>
            <p style="font-size: 1.3rem; margin-bottom: 2rem; color: rgba(255,255,255,0.9);">Experience our community firsthand. Schedule a personal tour today and see why families choose Close to Home.</p>
            <div style="display: flex; gap: 1.5rem; justify-content: center; flex-wrap: wrap;">
                <a href="/contact.php?location=baycity#tour-section" class="btn-primary" style="background: #fff; color: #1a4d2e;">Schedule a Tour</a>
                <a href="tel:9897782575" class="btn-secondary" style="background: rgba(255,255,255,0.2); backdrop-filter: blur(10px);"><i class="fas fa-phone"></i> Call Us: (989) 778-2575</a>
            </div>
        </div>
    </div>
</section>

<?php include '../includes/footer.php'; ?>
