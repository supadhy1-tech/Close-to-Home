<?php 
$page_title = "Our Locations";
include 'includes/header.php'; 
?>

<!-- Page Header -->
<section class="hero-section" style="min-height: 50vh; background: linear-gradient(135deg, rgba(26, 77, 46, 0.3) 0%, rgba(76, 139, 99, 0.25) 100%), url('/images/gallery/community-center.jpg') center/cover no-repeat; display: flex; align-items: center; position: relative; filter: contrast(1.2) brightness(1.05);">
    <div class="hero-content" style="position: relative; z-index: 2; text-align: center; color: rgba(255, 255, 255, 0.95); max-width: 1200px; margin: 0 auto; padding: 3rem 2rem; background: rgba(0, 0, 0, 0.2); backdrop-filter: blur(3px); border-radius: 15px;">
        <h1 style="font-size: 3.5rem; margin-bottom: 1rem; text-shadow: 2px 2px 8px rgba(0,0,0,0.6); font-weight: 300; letter-spacing: 1px;">Our Locations</h1>
        <p class="subtitle" style="font-size: 1.5rem; color: rgba(212, 163, 115, 0.9); font-weight: 400; text-shadow: 1px 1px 4px rgba(0,0,0,0.5);">Serving families across the Greater Saginaw Bay Area</p>
    </div>
</section>

<!-- Locations Grid -->
<section class="section" style="background: #f8f9fa;">
    <div class="container">
        <div class="section-header">
            <h2>Choose Your Close to Home Community</h2>
            <p>Two exceptional locations, one commitment to excellence</p>
        </div>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(450px, 1fr)); gap: 3rem; max-width: 1200px; margin: 0 auto;">
            
            <!-- Saginaw Location -->
            <div class="card" style="background: #fff; border-radius: 15px; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.1); transition: transform 0.3s ease;">
                <div style="height: 250px; background: linear-gradient(rgba(26, 77, 46, 0.2), rgba(45, 122, 76, 0.2)), url('/images/gallery/close.jpg') center/cover no-repeat;"></div>
                <div style="padding: 2.5rem;">
                    <h3 style="color: #1a4d2e; font-size: 2rem; margin-bottom: 1rem; font-family: 'Merriweather', serif;">
                        <i class="fas fa-map-marker-alt" style="color: #d4a373;"></i> Close to Saginaw
                    </h3>
                    
                    <div style="margin: 1.5rem 0; padding: 1.5rem; background: #f8f9fa; border-radius: 10px;">
                        <p style="margin-bottom: 0.8rem; display: flex; align-items: center; gap: 0.5rem;">
                            <i class="fas fa-location-dot" style="color: #d4a373; width: 20px;"></i>
                            <strong>Near Saginaw, Michigan</strong>
                        </p>
                        <p style="margin-bottom: 0.8rem; display: flex; align-items: center; gap: 0.5rem;">
                            <i class="fas fa-phone" style="color: #d4a373; width: 20px;"></i>
                            <a href="tel:989401-3581" style="color: #1a4d2e;">(989) 401-3581</a>
                        </p>
                        <p style="margin-bottom: 0.8rem; display: flex; align-items: center; gap: 0.5rem;">
                            <i class="fas fa-envelope" style="color: #d4a373; width: 20px;"></i>
                            <a href="mailto:saginaw2160@gmail.com" style="color: #1a4d2e;">saginaw2160@gmail.com</a>
                        </p>
                        <p style="display: flex; align-items: center; gap: 0.5rem;">
                            <i class="fas fa-road" style="color: #d4a373; width: 20px;"></i>
                            Easy access from Highway 75
                        </p>
                    </div>

                    <div style="margin: 1.5rem 0;">
                        <h4 style="color: #1a4d2e; margin-bottom: 1rem;">Services Available:</h4>
                        <ul style="list-style: none; padding: 0;">
                            <li style="padding: 0.5rem 0; border-bottom: 1px solid #e0e0e0;">
                                <i class="fas fa-check" style="color: #2d7a4c; margin-right: 0.5rem;"></i> Assisted Living
                            </li>
                            <li style="padding: 0.5rem 0; border-bottom: 1px solid #e0e0e0;">
                                <i class="fas fa-check" style="color: #2d7a4c; margin-right: 0.5rem;"></i> Memory Care
                            </li>
                            <li style="padding: 0.5rem 0; border-bottom: 1px solid #e0e0e0;">
                                <i class="fas fa-check" style="color: #2d7a4c; margin-right: 0.5rem;"></i> Independent Living
                            </li>
                            <li style="padding: 0.5rem 0; border-bottom: 1px solid #e0e0e0;">
                                <i class="fas fa-check" style="color: #2d7a4c; margin-right: 0.5rem;"></i> Rehabilitation Services
                            </li>
                            <li style="padding: 0.5rem 0; border-bottom: 1px solid #e0e0e0;">
                                <i class="fas fa-check" style="color: #2d7a4c; margin-right: 0.5rem;"></i> Respite Care
                            </li>
                            <li style="padding: 0.5rem 0;">
                                <i class="fas fa-check" style="color: #2d7a4c; margin-right: 0.5rem;"></i> Life Enrichment Programs
                            </li>
                        </ul>
                    </div>

                    <div style="display: flex; gap: 1rem; margin-top: 2rem; flex-wrap: wrap;">
                        <a href="locations/saginaw.php" class="btn-primary" style="flex: 1; text-align: center;">View Location Details</a>
                        <a href="contact.php?location=saginaw#tour-section" class="btn-secondary" style="flex: 1; text-align: center; background: #fff; border: 2px solid #1a4d2e; color: #1a4d2e;">Schedule Tour</a>
                    </div>
                </div>
            </div>

            <!-- Bay City Location -->
            <div class="card" style="background: #fff; border-radius: 15px; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.1); transition: transform 0.3s ease;">
                <div style="height: 250px; background: linear-gradient(rgba(26, 77, 46, 0.2), rgba(45, 122, 76, 0.2)), url('/images/gallery/community-center.jpg') center/cover no-repeat;"></div>
                <div style="padding: 2.5rem;">
                    <h3 style="color: #1a4d2e; font-size: 2rem; margin-bottom: 1rem; font-family: 'Merriweather', serif;">
                        <i class="fas fa-map-marker-alt" style="color: #d4a373;"></i> Close to Bay City
                    </h3>
                    
                    <div style="margin: 1.5rem 0; padding: 1.5rem; background: #f8f9fa; border-radius: 10px;">
                        <p style="margin-bottom: 0.8rem; display: flex; align-items: center; gap: 0.5rem;">
                            <i class="fas fa-location-dot" style="color: #d4a373; width: 20px;"></i>
                            <strong>Bay City, Michigan</strong>
                        </p>
                        <p style="margin-bottom: 0.8rem; display: flex; align-items: center; gap: 0.5rem;">
                            <i class="fas fa-phone" style="color: #d4a373; width: 20px;"></i>
                            <a href="tel:989316-2697" style="color: #1a4d2e;">(989) 316-2697</a>
                        </p>
                        <p style="margin-bottom: 0.8rem; display: flex; align-items: center; gap: 0.5rem;">
                            <i class="fas fa-envelope" style="color: #d4a373; width: 20px;"></i>
                            <a href="mailto:saginaw2160@gmail.com" style="color: #1a4d2e;">saginaw2160@gmail.com</a>
                        </p>
                        <p style="display: flex; align-items: center; gap: 0.5rem;">
                            <i class="fas fa-road" style="color: #d4a373; width: 20px;"></i>
                            Convenient Bay City location
                        </p>
                    </div>

                    <div style="margin: 1.5rem 0;">
                        <h4 style="color: #1a4d2e; margin-bottom: 1rem;">Services Available:</h4>
                        <ul style="list-style: none; padding: 0;">
                            <li style="padding: 0.5rem 0; border-bottom: 1px solid #e0e0e0;">
                                <i class="fas fa-check" style="color: #2d7a4c; margin-right: 0.5rem;"></i> Assisted Living
                            </li>
                            <li style="padding: 0.5rem 0; border-bottom: 1px solid #e0e0e0;">
                                <i class="fas fa-check" style="color: #2d7a4c; margin-right: 0.5rem;"></i> Memory Care
                            </li>
                            <li style="padding: 0.5rem 0; border-bottom: 1px solid #e0e0e0;">
                                <i class="fas fa-check" style="color: #2d7a4c; margin-right: 0.5rem;"></i> Independent Living
                            </li>
                            <li style="padding: 0.5rem 0; border-bottom: 1px solid #e0e0e0;">
                                <i class="fas fa-check" style="color: #2d7a4c; margin-right: 0.5rem;"></i> Rehabilitation Services
                            </li>
                            <li style="padding: 0.5rem 0; border-bottom: 1px solid #e0e0e0;">
                                <i class="fas fa-check" style="color: #2d7a4c; margin-right: 0.5rem;"></i> Respite Care
                            </li>
                            <li style="padding: 0.5rem 0;">
                                <i class="fas fa-check" style="color: #2d7a4c; margin-right: 0.5rem;"></i> Life Enrichment Programs
                            </li>
                        </ul>
                    </div>

                    <div style="display: flex; gap: 1rem; margin-top: 2rem; flex-wrap: wrap;">
                        <a href="locations/baycity.php" class="btn-primary" style="flex: 1; text-align: center;">View Location Details</a>
                        <a href="contact.php?location=baycity#tour-section" class="btn-secondary" style="flex: 1; text-align: center; background: #fff; border: 2px solid #1a4d2e; color: #1a4d2e;">Schedule Tour</a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- Service Area Map -->
<section class="section" style="background: #fff;">
    <div class="container">
        <div class="section-header">
            <h2>Serving the Greater Saginaw Bay Area</h2>
            <p>Conveniently located to serve families throughout the region</p>
        </div>
        
      <div style="max-width: 900px; margin: 0 auto; text-align: center; align-items: center; display: flex; flex-direction: column; gap: 2rem;">
            <div style="background: #f8f9fa; padding: 3rem 2rem; border-radius: 15px;">
                <h3 style="color: #1a4d2e; margin-bottom: 1.5rem; font-size: 2rem;">Communities We Serve</h3>
                <div style="display: flex; gap: 3rem; justify-content: center; flex-wrap: wrap;">
                    <div style="text-align: center;">
                        <h4 style="color: #d4a373; margin-bottom: 0.5rem; font-size: 1.5rem;">Saginaw Area:</h4>
                        <ul style="list-style: none; padding: 0; font-size: 1.2rem;">
                            <li>✓ Saginaw</li>
                            <li>✓ Zilwaukee</li>
                            <li>✓ Frankenmuth</li>
                            <li>✓ Bridgeport</li>
                            <li>✓ Freeland</li>
                        </ul>
                    </div>
                    
                    <div style="text-align: center;">
                        <h4 style="color: #d4a373; margin-bottom: 0.5rem; font-size: 1.5rem;">Bay City Area:</h4>
                        <ul style="list-style: none; padding: 0; font-size: 1.2rem;">
                            <li>✓ Bay City</li>
                            <li>✓ Essexville</li>
                            <li>✓ Auburn</li>
                            <li>✓ Pinconning</li>
                            <li>✓ Kawkawlin</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="section" style="background: linear-gradient(135deg, #1a4d2e 0%, #2d7a4c 100%); color: #fff;">
    <div class="container">
        <div style="max-width: 800px; margin: 0 auto; text-align: center;">
            <h2 style="font-size: 2.5rem; margin-bottom: 1.5rem; color: #fff;">Ready to Visit?</h2>
            <p style="font-size: 1.3rem; margin-bottom: 2rem; color: rgba(255,255,255,0.9);">Contact either location to schedule your personal tour and experience our caring community firsthand.</p>
            <div style="display: flex; gap: 1.5rem; justify-content: center; flex-wrap: wrap;">
                <a href="contact.php#tour-section" class="btn-primary" style="background: #fff; color: #1a4d2e;">Schedule a Tour</a>
                <a href="tel:9895552273" class="btn-secondary" style="background: rgba(255,255,255,0.2); backdrop-filter: blur(10px);"><i class="fas fa-phone"></i> Call Saginaw</a>
                <a href="tel:9895552274" class="btn-secondary" style="background: rgba(255,255,255,0.2); backdrop-filter: blur(10px);"><i class="fas fa-phone"></i> Call Bay City</a>
            </div>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>