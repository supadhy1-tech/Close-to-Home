# Close to Saginaw - Professional Assisted Living Website

## 🏆 Professional Multi-Page Website ($2000 Value)

A complete, production-ready website for Close to Saginaw Assisted Living facility with backend database integration, multiple service pages, and professional design.

---

## 📋 Features

### ✅ Multi-Page Architecture
- **Home Page** - Hero section, services preview, testimonials, CTAs
- **Services Overview** - All services with descriptions
- **Individual Service Pages** (6 pages):
  - Assisted Living
  - Memory Care
  - Independent Living
  - Rehabilitation Services
  - Respite Care
  - Life Enrichment
- **About Us** - Company story and values
- **Experiences/Testimonials** - Database-driven reviews with submission form
- **Gallery** - Photo showcase
- **Contact** - Tour scheduling and general inquiry forms

### ✅ Backend Functionality
- **MySQL Database Integration**
- **Contact Form Processing**
- **Tour Request System**
- **Testimonial Management**
- **Email Notifications** (ready for configuration)

### ✅ Professional Design
- **Responsive Design** - Works on all devices
- **Dropdown Navigation** - Services submenu
- **Professional Color Scheme** - Green/Gold theme
- **Font Awesome Icons**
- **Smooth Animations**
- **Mobile-Friendly Menu**

---

## 🚀 Installation Instructions

### Step 1: Setup Database

1. Open AMPPS and make sure MySQL is running
2. Open phpMyAdmin: `http://localhost/phpmyadmin`
3. Create a new database:
   - Click "New" in the left sidebar
   - Database name: `close_to_saginaw`
   - Click "Create"
4. Import the database structure:
   - Select the `close_to_saginaw` database
   - Click "Import" tab
   - Click "Choose File"
   - Select `database_setup.sql`
   - Click "Go"

### Step 2: Install Website Files

1. Copy the entire `close-to-saginaw-pro` folder to your AMPPS www directory:
   ```
   C:\Program Files\Ampps\www\close-to-saginaw-pro\
   ```

2. Verify the folder structure:
   ```
   close-to-saginaw-pro/
   ├── index.php
   ├── services.php
   ├── about.php
   ├── experiences.php
   ├── gallery.php
   ├── contact.php
   ├── database_setup.sql
   ├── css/
   │   └── style.css
   ├── js/
   │   └── main.js
   ├── includes/
   │   ├── header.php
   │   ├── footer.php
   │   └── config.php
   └── services/
       ├── assisted-living.php
       ├── memory-care.php
       ├── independent-living.php
       ├── rehabilitation.php
       ├── respite-care.php
       └── life-enrichment.php
   ```

### Step 3: Configure Database Connection

1. Open `includes/config.php`
2. Verify these settings match your AMPPS setup:
   ```php
   define('DB_HOST', 'localhost');
   define('DB_USER', 'root');
   define('DB_PASS', 'mysql');
   define('DB_NAME', 'close_to_saginaw');
   ```

### Step 4: Access the Website

1. Open your browser
2. Go to: `http://localhost/close-to-saginaw-pro/`
3. You should see the homepage!

---

## 📱 Page Structure

### Homepage (`index.php`)
- Hero section with CTA buttons
- Stats display
- Services preview (3 cards)
- Care Promise section
- Featured testimonials (from database)
- Final CTA section

### Services Pages
- **Main Services Page** (`services.php`) - Overview of all 6 services
- **Individual Service Pages** - Detailed information for each service

### Experiences (`experiences.php`)
- Displays all approved testimonials from database
- Testimonial submission form
- Stats section
- CTA to schedule tour

### Contact (`contact.php`)
- Contact information cards
- Tour scheduling form (saves to database)
- General inquiry form (saves to database)
- What to Expect section

### About (`about.php`)
- Company story
- Core values
- Why choose us section

### Gallery (`gallery.php`)
- Photo grid (placeholder colors - ready for real images)
- CTA to schedule tour

---

## 🗄️ Database Tables

### `contact_inquiries`
Stores general contact form submissions
- id, name, email, phone, care_type, message, created_at, status

### `tour_requests`
Stores tour scheduling requests
- id, name, email, phone, preferred_date, preferred_time, number_of_guests, message, created_at, status

### `testimonials`
Stores customer testimonials
- id, author_name, relationship, rating, testimonial_text, is_featured, created_at, approved

---

## 🎨 Customization Guide

### Change Colors
Edit `css/style.css` and modify these CSS variables:
```css
:root {
    --primary-color: #1a4d2e;  /* Main green */
    --secondary-color: #2d7a4c; /* Secondary green */
    --accent-color: #d4a373;    /* Gold/tan */
    --accent-dark: #b88a5f;     /* Dark gold */
}
```

### Change Contact Information
Edit these files:
- `includes/footer.php` - Footer contact info
- `contact.php` - Contact page details

### Add Real Photos
Replace placeholder colors in `gallery.php` with actual image URLs

### Modify Services
Edit individual service pages in the `services/` folder

---

## 📧 Email Configuration

To enable email notifications:

1. Open `process_tour.php` and `process_contact.php`
2. Uncomment the `mail()` function lines
3. Configure PHP mail settings in AMPPS

---

## 🔒 Admin Panel (Coming Soon)

Future enhancement: Admin dashboard to:
- View all tour requests
- Manage testimonials (approve/reject)
- View contact inquiries
- Update inquiry status

---

## 🌐 Going Live

### To put this website online:

1. **Purchase Domain & Hosting**
   - Recommended: Bluehost, SiteGround, HostGator
   - Cost: ~$5-10/month

2. **Upload Files**
   - Use FTP (FileZilla) to upload all files
   - Upload to `public_html/` folder

3. **Create Database**
   - Create MySQL database in cPanel
   - Import `database_setup.sql`
   - Update `includes/config.php` with new credentials

4. **Configure Email**
   - Set up email accounts
   - Update email addresses in PHP files

5. **Test Everything**
   - Test all forms
   - Test navigation
   - Test on mobile devices

---

## 📞 Support & Maintenance

### Common Issues:

**Database Connection Error:**
- Verify MySQL is running in AMPPS
- Check `includes/config.php` settings
- Ensure database `close_to_saginaw` exists

**Forms Not Working:**
- Check database connection
- Verify table structure matches `database_setup.sql`
- Check PHP error logs

**Page Not Found:**
- Verify file paths
- Check that all files were copied correctly
- Clear browser cache

---

## 💼 Professional Features

✅ **SEO Ready** - Proper meta tags and structure
✅ **Mobile Responsive** - Works on all devices
✅ **Fast Loading** - Optimized code
✅ **Secure Forms** - SQL injection prevention
✅ **Professional Design** - Modern, clean layout
✅ **Easy to Maintain** - Well-organized code
✅ **Scalable** - Easy to add new features

---

## 📊 Deliverables Checklist

✅ 11+ Complete Pages
✅ MySQL Database with 3 Tables
✅ Working Contact Forms
✅ Tour Scheduling System
✅ Testimonial Management
✅ Responsive Design
✅ Professional Navigation
✅ Custom CSS & JavaScript
✅ Email Notification System (ready)
✅ Complete Documentation

---

## 🎯 Next Steps for Client

1. ✅ Review all pages and content
2. ✅ Test all forms
3. ✅ Add real photos to gallery
4. ✅ Customize any text/content
5. ✅ Purchase domain and hosting
6. ✅ Deploy to live server
7. ✅ Configure email notifications
8. ✅ Start accepting tour requests!

---

## 📝 Notes

- All sample testimonials can be replaced via database
- Phone numbers and emails can be easily updated
- Color scheme is fully customizable
- Ready for Google Analytics integration
- Ready for social media integration

---

**Developed with care for Close to Saginaw Assisted Living**
**Professional Website Package - $2000 Value**

For questions or support, contact the development team.
