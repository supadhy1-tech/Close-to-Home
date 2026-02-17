<?php 
$page_title = "Contact Us";
include 'includes/header.php';
?>

<!-- Page Header -->
<section class="hero-section" style="min-height: 50vh; background: linear-gradient(135deg, rgba(26, 77, 46, 0.3) 0%, rgba(76, 139, 99, 0.25) 100%), url('/images/gallery/close.jpg') center/cover no-repeat; display: flex; align-items: center; position: relative; filter: contrast(1.2) brightness(1.05);">
    <div class="hero-content" style="position: relative; z-index: 2; text-align: center; color: rgba(255, 255, 255, 0.95); max-width: 1200px; margin: 0 auto; padding: 3rem 2rem; background: rgba(0, 0, 0, 0.2); backdrop-filter: blur(3px); border-radius: 15px;">
        <h1 style="font-size: 3.5rem; margin-bottom: 1rem; text-shadow: 2px 2px 8px rgba(0,0,0,0.6); font-weight: 300; letter-spacing: 1px;">Let's Start the Conversation</h1>
        <p class="subtitle" style="font-size: 1.5rem; color: rgba(212, 163, 115, 0.9); font-weight: 400; text-shadow: 1px 1px 4px rgba(0,0,0,0.5);">We're here to answer your questions and welcome you home</p>
    </div>
</section>
<!-- Contact Information Section -->
<section class="section" style="background: #fff;">
    <div class="container">
        <div class="section-header">
            <h2>Contact Our Locations</h2>
            <p>We have two convenient locations to serve you</p>
        </div>
        
        <!-- Saginaw Location -->
        <div style="margin-bottom: 3rem;">
            <h3 style="color: #1a4d2e; text-align: center; margin-bottom: 2rem; font-size: 2rem;">
                <i class="fas fa-map-marker-alt" style="color: #d4a373;"></i> Close to Saginaw
            </h3>
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 2rem; max-width: 1200px; margin: 0 auto;">
                <div class="card" style="text-align: center;">
                    <i class="fas fa-phone" style="font-size: 3rem; color: #d4a373; margin-bottom: 1rem;"></i>
                    <h4>Call Us</h4>
                    <p style="font-size: 1.5rem; font-weight: 700; color: #1a4d2e; margin: 1rem 0;">
                        <a href="tel:9894013581" style="color: #1a4d2e;">(989) 401-3581</a>
                    </p>
                    <p>Open 24 Hours</p>
                </div>
                <div class="card" style="text-align: center;">
                    <i class="fas fa-envelope" style="font-size: 3rem; color: #d4a373; margin-bottom: 1rem;"></i>
                    <h4>Email Us</h4>
                    <p style="font-size: 1.2rem; font-weight: 700; color: #1a4d2e; margin: 1rem 0;">
                        <a href="mailto:saginaw2160@gmail.com" style="color: #1a4d2e;">saginaw2160@gmail.com</a>
                    </p>
                    <p>We typically respond within 2 hours during business hours</p>
                </div>
                <div class="card" style="text-align: center;">
                    <i class="fas fa-map-marker-alt" style="font-size: 3rem; color: #d4a373; margin-bottom: 1rem;"></i>
                    <h4>Visit Us</h4>
                    <p style="font-weight: 700; color: #1a4d2e; margin: 1rem 0;">
                        2160 N Center Rd<br>
                        Saginaw, MI 48603
                    </p>
                    <p>Open 24 Hours</p>
                </div>
            </div>
        </div>

        <!-- Bay City Location -->
        <div>
            <h3 style="color: #1a4d2e; text-align: center; margin-bottom: 2rem; font-size: 2rem;">
                <i class="fas fa-map-marker-alt" style="color: #d4a373;"></i> Close to Bay City
            </h3>
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 2rem; max-width: 1200px; margin: 0 auto;">
                <div class="card" style="text-align: center;">
                    <i class="fas fa-phone" style="font-size: 3rem; color: #d4a373; margin-bottom: 1rem;"></i>
                    <h4>Call Us</h4>
                    <p style="font-size: 1.5rem; font-weight: 700; color: #1a4d2e; margin: 1rem 0;">
                        <a href="tel:9893162697" style="color: #1a4d2e;">(989) 316-2697</a>
                    </p>
                    <p>Open 24 Hours</p>
                </div>
                <div class="card" style="text-align: center;">
                    <i class="fas fa-envelope" style="font-size: 3rem; color: #d4a373; margin-bottom: 1rem;"></i>
                    <h4>Email Us</h4>
                    <p style="font-size: 1.2rem; font-weight: 700; color: #1a4d2e; margin: 1rem 0;">
                        <a href="mailto:saginaw2160@gmail.com" style="color: #1a4d2e;">saginaw2160@gmail.com</a>
                    </p>
                    <p>We typically respond within 2 hours during business hours</p>
                </div>
                <div class="card" style="text-align: center;">
                    <i class="fas fa-map-marker-alt" style="font-size: 3rem; color: #d4a373; margin-bottom: 1rem;"></i>
                    <h4>Visit Us</h4>
                    <p style="font-weight: 700; color: #1a4d2e; margin: 1rem 0;">
                        805 E South Union St<br>
                        Bay City, MI 48706
                    </p>
                    <p>Open 24 Hours</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Tour Scheduling Section -->
<section id="tour-section" class="section" style="background: #f8f9fa;">
    <div class="container">
        <div class="section-header">
            <h2>Schedule Your Personal Tour</h2>
            <p>Experience our community firsthand and see why families choose Close to Saginaw</p>
        </div>
        
        <div class="contact-grid">
            <div class="contact-form">
                <h3 style="color: #1a4d2e; font-family: 'Merriweather', serif; margin-bottom: 1.5rem; font-size: 1.8rem;">Request a Tour</h3>
                <form method="POST" action="process_tour.php" id="tourForm">
                    <div class="form-group">
                        <label for="location">Location *</label>
                        <select id="location" name="location" required>
                            <option value="">Select a location...</option>
                            <option value="saginaw" <?php echo (isset($_GET['location']) && $_GET['location'] == 'saginaw') ? 'selected' : ''; ?>>Close to Saginaw</option>
                            <option value="baycity" <?php echo (isset($_GET['location']) && $_GET['location'] == 'baycity') ? 'selected' : ''; ?>>Close to Bay City</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="name">Your Name *</label>
                        <input type="text" id="name" name="name" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="email">Email Address *</label>
                        <input type="email" id="email" name="email" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="phone">Phone Number *</label>
                        <input type="tel" id="phone" name="phone" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="preferred_date">Preferred Date</label>
                        <input type="date" id="preferred_date" name="preferred_date" min="<?php echo date('Y-m-d'); ?>">
                    </div>
                    
                    <div class="form-group">
                        <label for="preferred_time">Preferred Time</label>
                        <select id="preferred_time" name="preferred_time">
                            <option value="">Select a time...</option>
                            <option value="9:00 AM">9:00 AM</option>
                            <option value="10:00 AM">10:00 AM</option>
                            <option value="11:00 AM">11:00 AM</option>
                            <option value="12:00 Noon">12:00 Noon</option>
                            <option value="1:00 PM">1:00 PM</option>
                            <option value="2:00 PM">2:00 PM</option>
                            <option value="3:00 PM">3:00 PM</option>
                            <option value="4:00 PM">4:00 PM</option>
                            <option value="5:00 PM">5:00 PM</option>
                        </select>
                        <div id="time-availability-message" style="margin-top: 0.5rem; font-size: 0.9rem;"></div>
                    </div>
                    
                    <div class="form-group">
                        <label for="number_of_guests">Number of Guests</label>
                        <input type="number" id="number_of_guests" name="number_of_guests" value="1" min="1" max="10">
                    </div>
                    
                    <div class="form-group">
                        <label for="message">Additional Information</label>
                        <textarea id="message" name="message" placeholder="Tell us about your loved one's needs or any specific questions you have..."></textarea>
                    </div>
                    
                    <button type="submit" class="btn-primary" style="width: 100%;">Schedule My Tour</button>
                </form>
            </div>
            
            <div style="display: flex; flex-direction: column; gap: 2rem;">
                <div class="card">
                    <h3>What to Expect</h3>
                    <ul style="list-style: none; padding: 0;">
                        <li style="padding: 0.8rem 0; padding-left: 2rem; position: relative;"><span style="position: absolute; left: 0; color: #d4a373; font-size: 1.3rem;">✓</span> Personalized tour of our community</li>
                        <li style="padding: 0.8rem 0; padding-left: 2rem; position: relative;"><span style="position: absolute; left: 0; color: #d4a373; font-size: 1.3rem;">✓</span> Meet our caring staff</li>
                        <li style="padding: 0.8rem 0; padding-left: 2rem; position: relative;"><span style="position: absolute; left: 0; color: #d4a373; font-size: 1.3rem;">✓</span> See our living spaces and amenities</li>
                        <li style="padding: 0.8rem 0; padding-left: 2rem; position: relative;"><span style="position: absolute; left: 0; color: #d4a373; font-size: 1.3rem;">✓</span> Discussion of care needs and services</li>
                        <li style="padding: 0.8rem 0; padding-left: 2rem; position: relative;"><span style="position: absolute; left: 0; color: #d4a373; font-size: 1.3rem;">✓</span> Sample a meal (if available)</li>
                        <li style="padding: 0.8rem 0; padding-left: 2rem; position: relative;"><span style="position: absolute; left: 0; color: #d4a373; font-size: 1.3rem;">✓</span> Q&A session with Family Advocate</li>
                    </ul>
                </div>
                
                <div class="card" style="background: linear-gradient(135deg, #1a4d2e 0%, #2d7a4c 100%); color: #fff;">
                    <h3 style="color: #d4a373;">Have Questions?</h3>
                    <p style="color: rgba(255,255,255,0.9); margin-bottom: 1.5rem;">Don't wait for the tour! Call us now to speak with a Family Advocate who can answer your questions immediately.</p>
                    <a href="tel:9894013581" class="btn-primary" style="display: inline-block;">
                        <i class="fas fa-phone"></i> Call Saginaw: (989) 401-3581
                    </a>
                    <br>
                    <a href="tel:9897782575" class="btn-primary" style="display: inline-block;">
                        <i class="fas fa-phone"></i> Call Baycity: (989) 778-2575
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- General Contact Form -->
<section class="section" style="background: #fff;">
    <div class="container">
        <div class="section-header">
            <h2>Send Us a Message</h2>
            <p>Have a general question? Fill out the form below and we'll get back to you promptly</p>
        </div>
        
        <div style="max-width: 800px; margin: 0 auto;">
            <div class="contact-form">
                <form method="POST" action="process_contact.php" id="contactForm">
                    <div class="form-group">
                        <label for="contact_location">Location *</label>
                        <select id="contact_location" name="location" required>
                            <option value="">Select a location...</option>
                            <option value="saginaw" <?php echo (isset($_GET['location']) && $_GET['location'] == 'saginaw') ? 'selected' : ''; ?>>Close to Saginaw</option>
                            <option value="baycity" <?php echo (isset($_GET['location']) && $_GET['location'] == 'baycity') ? 'selected' : ''; ?>>Close to Bay City</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="contact_name">Your Name *</label>
                        <input type="text" id="contact_name" name="name" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="contact_email">Email Address *</label>
                        <input type="email" id="contact_email" name="email" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="contact_phone">Phone Number *</label>
                        <input type="tel" id="contact_phone" name="phone" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="care_type">I'm Interested In</label>
                        <select id="care_type" name="care_type">
                            <option value="">Select...</option>
                            <option value="Assisted Living">Assisted Living</option>
                            <option value="Memory Care">Memory Care</option>
                            <option value="Independent Living">Independent Living</option>
                            <option value="Rehabilitation">Rehabilitation Services</option>
                            <option value="Respite Care">Respite Care</option>
                            <option value="General Inquiry">General Inquiry</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="contact_message">Message *</label>
                        <textarea id="contact_message" name="message" required placeholder="Tell us how we can help..."></textarea>
                    </div>
                    
                    <button type="submit" class="btn-primary" style="width: 100%;">Send Message</button>
                </form>
            </div>
        </div>
    </div>
</section>

<script>
// Check availability when date or location changes
document.getElementById('preferred_date').addEventListener('change', checkTimeAvailability);
document.getElementById('location').addEventListener('change', checkTimeAvailability);

// Also check on page load if date is pre-selected
window.addEventListener('DOMContentLoaded', function() {
    checkTimeAvailability();
});

function checkTimeAvailability() {
    const date = document.getElementById('preferred_date').value;
    const location = document.getElementById('location').value;
    const timeSelect = document.getElementById('preferred_time');
    const messageDiv = document.getElementById('time-availability-message');
    
    // Reset all options first
    Array.from(timeSelect.options).forEach(option => {
        if (option.value) {
            option.disabled = false;
            option.style.color = '';
        }
    });
    
    // If date is selected, check for past times and booked slots
    if (date) {
        const selectedDate = new Date(date + 'T00:00:00');
        const today = new Date();
        today.setHours(0, 0, 0, 0);
        
        const isToday = selectedDate.getTime() === today.getTime();
        
        // If selected date is today, disable past times
        if (isToday) {
            disablePastTimes();
        }
        
        // If location is also selected, check for booked slots
        if (location) {
            fetch(`check_availability.php?date=${date}&location=${location}`)
                .then(response => response.json())
                .then(data => {
                    // Disable booked times
                    if (data.booked_slots && data.booked_slots.length > 0) {
                        data.booked_slots.forEach(bookedTime => {
                            Array.from(timeSelect.options).forEach(option => {
                                if (option.value === bookedTime) {
                                    option.disabled = true;
                                    option.style.color = '#999';
                                }
                            });
                        });
                        
                        messageDiv.innerHTML = '<span style="color: #d4a373;">⚠️ Some time slots are unavailable.</span>';
                    } else {
                        // Check if any times are available after disabling past times
                        const availableCount = Array.from(timeSelect.options).filter(o => o.value && !o.disabled).length;
                        if (availableCount > 0) {
                            messageDiv.innerHTML = '<span style="color: #1a4d2e;">✓ Time slots available!</span>';
                        } else {
                            messageDiv.innerHTML = '<span style="color: #d4a373;">⚠️ No time slots available for this date.</span>';
                        }
                    }
                })
                .catch(error => {
                    console.error('Error checking availability:', error);
                    messageDiv.innerHTML = '<span style="color: #999;">Unable to check availability. Please try again.</span>';
                });
        } else {
            // Just show message about past times if applicable
            if (isToday) {
                const availableCount = Array.from(timeSelect.options).filter(o => o.value && !o.disabled).length;
                if (availableCount > 0) {
                    messageDiv.innerHTML = '<span style="color: #1a4d2e;">✓ Time slots available!</span>';
                } else {
                    messageDiv.innerHTML = '<span style="color: #d4a373;">⚠️ No time slots available for today.</span>';
                }
            }
        }
    }
}

function disablePastTimes() {
    const now = new Date();
    const currentHour = now.getHours();
    const currentMinute = now.getMinutes();
    
    // Time slots mapping to 24-hour format
    const timeSlots = {
        '9:00 AM': 9,
        '10:00 AM': 10,
        '11:00 AM': 11,
        '12:00 Noon': 12,
        '1:00 PM': 13,
        '2:00 PM': 14,
        '3:00 PM': 15,
        '4:00 PM': 16,
        '5:00 PM': 17
    };
    
    const timeSelect = document.getElementById('preferred_time');
    
    Array.from(timeSelect.options).forEach(option => {
        if (option.value && timeSlots[option.value] !== undefined) {
            const slotHour = timeSlots[option.value];
            
            // Disable if the time slot has passed
            // Add 1 hour buffer (e.g., if it's 9:30 AM, disable 9:00 AM and 10:00 AM)
            if (slotHour <= currentHour) {
                option.disabled = true;
                option.style.color = '#999';
            }
        }
    });
}

// Form validation before submit
document.getElementById('tourForm').addEventListener('submit', function(e) {
    const selectedTime = document.getElementById('preferred_time').value;
    const selectedOption = document.querySelector(`#preferred_time option[value="${selectedTime}"]`);
    
    if (selectedOption && selectedOption.disabled) {
        e.preventDefault();
        alert('Sorry, this time slot is not available. Please select a different time.');
        return false;
    }
    
    // Also validate that a time is selected
    if (!selectedTime) {
        e.preventDefault();
        alert('Please select a preferred time for your tour.');
        return false;
    }
});
</script>

<?php include 'includes/footer.php'; ?>