<?php 
$page_title = "Our Services";
include 'includes/header.php'; 
?>

<!-- Page Header -->
<section class="hero-section" style="min-height: 50vh; background: linear-gradient(135deg, rgba(26, 77, 46, 0.3) 0%, rgba(76, 139, 99, 0.25) 100%), url('/images/gallery/assist.png') center/cover no-repeat; display: flex; align-items: center; position: relative; filter: contrast(1.2) brightness(1.05);">
    <div class="hero-content" style="position: relative; z-index: 2; text-align: center; color: rgba(255, 255, 255, 0.95); max-width: 1200px; margin: 0 auto; padding: 3rem 2rem; background: rgba(0, 0, 0, 0.2); backdrop-filter: blur(3px); border-radius: 15px;">
        <h1 style="font-size: 3.5rem; margin-bottom: 1rem; text-shadow: 2px 2px 8px rgba(0,0,0,0.6); font-weight: 300; letter-spacing: 1px;">Our Comprehensive Services</h1>
        <p class="subtitle" style="font-size: 1.5rem; color: rgba(212, 163, 115, 0.9); font-weight: 400; text-shadow: 1px 1px 4px rgba(0,0,0,0.5);">Personalized care for every stage of life</p>
    </div>
</section>

<!-- Services Overview -->
<section class="section" style="background: #fff;">
    <div class="container">
        <div class="section-header">
            <h2>Everything You Need Under One Roof</h2>
            <p>From independent living to specialized memory care, we provide comprehensive services tailored to your loved one's unique needs</p>
        </div>

        <div class="services-grid">
            <!-- Assisted Living -->
            <div class="service-card">
                <div style="text-align: center; margin-bottom: 1.5rem;">
                    <i class="fas fa-hands-helping" style="font-size: 4rem; color: #d4a373;"></i>
                </div>
                <h3>Assisted Living</h3>
                <p>Personalized assistance with daily activities while maintaining independence, dignity, and quality of life.</p>
                <ul>
                    <li>24-hour professional care and support</li>
                    <li>Assistance with bathing, dressing, grooming</li>
                    <li>Medication management and reminders</li>
                    <li>Three nutritious meals daily plus snacks</li>
                    <li>Housekeeping and laundry services</li>
                    <li>Transportation to appointments</li>
                </ul>
                <a href="services/assisted-living.php" class="btn-primary" style="margin-top: 1.5rem; display: inline-block; padding: 0.8rem 2rem; font-size: 1rem;">Learn More →</a>
            </div>

            <!-- Memory Care -->
            <div class="service-card">
                <div style="text-align: center; margin-bottom: 1.5rem;">
                    <i class="fas fa-brain" style="font-size: 4rem; color: #d4a373;"></i>
                </div>
                <h3>Memory Care</h3>
                <p>Specialized care for residents with Alzheimer's disease and other forms of dementia in a secure, supportive environment.</p>
                <ul>
                    <li>Secure, comfortable living spaces</li>
                    <li>Specially trained dementia care team</li>
                    <li>Memory enhancement programs</li>
                    <li>Cognitive stimulation activities</li>
                    <li>Family education and support groups</li>
                    <li>24-hour monitoring and care</li>
                </ul>
                <a href="services/memory-care.php" class="btn-primary" style="margin-top: 1.5rem; display: inline-block; padding: 0.8rem 2rem; font-size: 1rem;">Learn More →</a>
            </div>

            <!-- Independent Living -->
            <div class="service-card">
                <div style="text-align: center; margin-bottom: 1.5rem;">
                    <i class="fas fa-house-user" style="font-size: 4rem; color: #d4a373;"></i>
                </div>
                <h3>Independent Living</h3>
                <p>Maintenance-free lifestyle with access to amenities, social activities, and care services when needed.</p>
                <ul>
                    <li>Private apartment-style living</li>
                    <li>No home maintenance worries</li>
                    <li>Social activities and events</li>
                    <li>Fitness and wellness programs</li>
                    <li>Community dining options</li>
                    <li>Optional care services available</li>
                </ul>
                <a href="services/independent-living.php" class="btn-primary" style="margin-top: 1.5rem; display: inline-block; padding: 0.8rem 2rem; font-size: 1rem;">Learn More →</a>
            </div>

            <!-- Rehabilitation Services -->
            <div class="service-card">
                <div style="text-align: center; margin-bottom: 1.5rem;">
                    <i class="fas fa-heartbeat" style="font-size: 4rem; color: #d4a373;"></i>
                </div>
                <h3>Rehabilitation Services</h3>
                <p>Comprehensive therapy services to help residents recover, regain strength, and maintain independence.</p>
                <ul>
                    <li>Physical therapy programs</li>
                    <li>Occupational therapy</li>
                    <li>Speech and language therapy</li>
                    <li>Post-surgical recovery support</li>
                    <li>Strength and mobility training</li>
                    <li>Fall prevention programs</li>
                </ul>
                <a href="services/rehabilitation.php" class="btn-primary" style="margin-top: 1.5rem; display: inline-block; padding: 0.8rem 2rem; font-size: 1rem;">Learn More →</a>
            </div>

            <!-- Respite Care -->
            <div class="service-card">
                <div style="text-align: center; margin-bottom: 1.5rem;">
                    <i class="fas fa-clock" style="font-size: 4rem; color: #d4a373;"></i>
                </div>
                <h3>Respite Care</h3>
                <p>Short-term care services that give family caregivers a break while ensuring your loved one receives excellent care.</p>
                <ul>
                    <li>Flexible short-term stays</li>
                    <li>Relief for family caregivers</li>
                    <li>Trial living arrangements</li>
                    <li>Seasonal care options</li>
                    <li>Emergency placement available</li>
                    <li>Full access to amenities</li>
                </ul>
                <a href="services/respite-care.php" class="btn-primary" style="margin-top: 1.5rem; display: inline-block; padding: 0.8rem 2rem; font-size: 1rem;">Learn More →</a>
            </div>

            <!-- Life Enrichment -->
            <div class="service-card">
                <div style="text-align: center; margin-bottom: 1.5rem;">
                    <i class="fas fa-palette" style="font-size: 4rem; color: #d4a373;"></i>
                </div>
                <h3>Life Enrichment</h3>
                <p>Engaging activities and programs designed to stimulate mind, body, and spirit while building community connections.</p>
                <ul>
                    <li>Daily recreational programs</li>
                    <li>Arts, crafts, and music classes</li>
                    <li>Gardening and outdoor spaces</li>
                    <li>Educational seminars</li>
                    <li>Social outings and events</li>
                    <li>Spiritual and chaplain services</li>
                </ul>
                <a href="services/life-enrichment.php" class="btn-primary" style="margin-top: 1.5rem; display: inline-block; padding: 0.8rem 2rem; font-size: 1rem;">Learn More →</a>
            </div>
        </div>
    </div>
</section>

<!-- Process Section -->
<section class="section" style="background: #f8f9fa;">
    <div class="container">
        <div class="section-header">
            <h2>How We Help Your Loved One Thrive</h2>
            <p>Our proven 3-step approach to exceptional care</p>
        </div>
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 3rem; max-width: 1200px; margin: 0 auto;">
            <div class="card" style="text-align: center; position: relative; padding-top: 3rem;">
                <div style="position: absolute; top: -25px; left: 50%; transform: translateX(-50%); width: 50px; height: 50px; background: #d4a373; color: #fff; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; font-weight: 700; box-shadow: 0 3px 15px rgba(0,0,0,0.2);">1</div>
                <h3>Visit Us</h3>
                <p>Come in for a tour with one of our Family Advocates. We'll start by listening so we can understand your loved one's unique situation.</p>
            </div>
            <div class="card" style="text-align: center; position: relative; padding-top: 3rem;">
                <div style="position: absolute; top: -25px; left: 50%; transform: translateX(-50%); width: 50px; height: 50px; background: #d4a373; color: #fff; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; font-weight: 700; box-shadow: 0 3px 15px rgba(0,0,0,0.2);">2</div>
                <h3>Choose Your Care</h3>
                <p>With our personalized care approach, we help your loved one live happier, healthier — longer.</p>
            </div>
            <div class="card" style="text-align: center; position: relative; padding-top: 3rem;">
                <div style="position: absolute; top: -25px; left: 50%; transform: translateX(-50%); width: 50px; height: 50px; background: #d4a373; color: #fff; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; font-weight: 700; box-shadow: 0 3px 15px rgba(0,0,0,0.2);">3</div>
                <h3>Cherish Your Time Together</h3>
                <p>With your loved one living their best life possible, you can savor every moment. Meals, milestones, memories — enjoy them all.</p>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="section" style="background: #fff;">
    <div class="container">
        <div style="max-width: 800px; margin: 0 auto; text-align: center; background: linear-gradient(135deg, #1a4d2e 0%, #2d7a4c 100%); padding: 4rem 3rem; border-radius: 15px; color: #fff;">
            <h2 style="font-size: 2.5rem; margin-bottom: 1.5rem; color: #fff;">Ready to Explore Our Services?</h2>
            <p style="font-size: 1.3rem; margin-bottom: 2rem; color: rgba(255,255,255,0.9);">Let's discuss which services are right for your loved one. Schedule a tour today.</p>
            <div style="display: flex; gap: 1.5rem; justify-content: center; flex-wrap: wrap;">
                <a href="contact.php#tour-section" class="btn-primary">Schedule a Tour</a>
                <a href="tel:9895552273" class="btn-secondary" style="background: rgba(255,255,255,0.2); backdrop-filter: blur(10px);"><i class="fas fa-phone"></i> (989) 555-2273</a>
            </div>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
