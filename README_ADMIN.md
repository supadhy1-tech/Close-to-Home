# Close to Saginaw - Complete Admin System
## Assisted Living Facility Management Platform

This is a complete admin system for managing an assisted living facility with resident management, staff tracking, inquiries, tours, and more.

---

## 🚀 NEW FEATURES ADDED

### 1. **Secure Admin Login System**
- Password hashing with bcrypt
- Role-based access control (Super Admin, Admin, Staff)
- Session management
- Activity logging

### 2. **Resident Management**
- Add, edit, and view residents
- Track care levels (Independent, Assisted, Memory Care, Respite)
- Medical notes and dietary restrictions
- Emergency contact information
- Room assignments
- Status tracking (Active, Discharged, Transferred, Deceased)

### 3. **Staff Management**
- Employee records
- Department assignments (Nursing, Activities, Dining, Housekeeping, Maintenance, Administration)
- Certifications tracking
- Employment status

### 4. **Inquiry Management**
- View and respond to contact form submissions
- Assign inquiries to staff members
- Track inquiry status (New, Contacted, Scheduled, Completed, Closed)
- Add notes and follow-ups

### 5. **Tour Request Management**
- Schedule facility tours
- Track tour status
- Confirm dates and times
- Assign tour guides

### 6. **Testimonial Management**
- Approve/reject testimonials
- Feature testimonials on website
- Track submission dates

### 7. **Medication Management**
- Track resident medications
- Dosage and frequency
- Prescribing doctors
- Start and end dates

### 8. **Care Plans**
- Create individualized care plans
- Set goals and review dates
- Track plan updates

### 9. **Reports & Analytics**
- Dashboard statistics
- Activity logs
- User activity tracking

### 10. **User Management**
- Add/remove admin users
- Role assignment
- Access control

---

## 📋 INSTALLATION INSTRUCTIONS

### Step 1: Database Setup

1. **Create the database:**
   ```sql
   mysql -u root -p
   ```

2. **Import the complete database:**
   ```sql
   SOURCE /path/to/database_setup_complete.sql;
   ```

   This will create:
   - Database: `close_to_saginaw`
   - Tables: admin_users, residents, staff_members, contact_inquiries, tour_requests, testimonials, medications, care_plans, activity_log
   - Default admin user (see below)

### Step 2: Configure Database Connection

Edit `/includes/config.php`:

```php
define('DB_HOST', 'localhost');     // Your database host
define('DB_USER', 'root');          // Your database username
define('DB_PASS', 'your_password'); // Your database password
define('DB_NAME', 'close_to_saginaw');
```

### Step 3: Set Permissions

Make sure the web server has read/write permissions:

```bash
chmod 755 admin/
chmod 644 admin/*.php
```

### Step 4: Access Admin Panel

Navigate to: `http://yoursite.com/admin/login.php`

**Default Login Credentials:**
- Username: `admin`
- Password: `admin123`

**⚠️ IMPORTANT: Change this password immediately after first login!**

---

## 🗂️ FILE STRUCTURE

```
close-to-saginaw-pro/
│
├── admin/                          # Admin Panel (NEW)
│   ├── auth.php                   # Authentication functions
│   ├── login.php                  # Login page
│   ├── logout.php                 # Logout functionality
│   ├── dashboard.php              # Main dashboard
│   ├── residents.php              # Resident management
│   ├── staff.php                  # Staff management (to be created)
│   ├── inquiries.php              # Inquiry management
│   ├── tours.php                  # Tour management (to be created)
│   ├── testimonials.php           # Testimonial management (to be created)
│   ├── medications.php            # Medication tracking (to be created)
│   ├── care_plans.php             # Care plan management (to be created)
│   ├── users.php                  # User management (to be created)
│   ├── reports.php                # Reports & analytics (to be created)
│   ├── activity_log.php           # Activity log (to be created)
│   │
│   ├── includes/
│   │   ├── header.php             # Admin header
│   │   └── sidebar.php            # Admin sidebar navigation
│   │
│   └── css/
│       └── admin.css              # Admin panel styles
│
├── includes/                       # Shared includes
│   ├── config.php                 # Database configuration
│   ├── header.php                 # Public site header
│   └── footer.php                 # Public site footer
│
├── css/                           # Public site styles
│   └── style.css
│
├── js/                            # Public site scripts
│   └── main.js
│
├── services/                      # Service pages
│   ├── assisted-living.php
│   ├── independent-living.php
│   ├── memory-care.php
│   ├── rehabilitation.php
│   ├── respite-care.php
│   └── life-enrichment.php
│
├── index.php                      # Homepage
├── about.php                      # About page
├── services.php                   # Services overview
├── experiences.php                # Experiences page
├── gallery.php                    # Photo gallery
├── contact.php                    # Contact form
│
├── database_setup_complete.sql   # Complete database setup (NEW)
└── README_ADMIN.md               # This file
```

---

## 👥 USER ROLES

### Super Admin
- Full access to all features
- Can manage admin users
- Can delete records
- Access to all reports

### Admin
- Manage residents and staff
- View and respond to inquiries
- Approve testimonials
- Manage tours and care plans
- Cannot manage admin users

### Staff
- View resident information
- Update assigned inquiries
- View tour schedules
- Limited editing capabilities

---

## 🔐 SECURITY FEATURES

1. **Password Hashing**: All passwords are hashed using bcrypt (PHP password_hash)
2. **SQL Injection Protection**: All inputs are sanitized using mysqli_real_escape_string
3. **XSS Protection**: Outputs are escaped using htmlspecialchars
4. **Session Management**: Secure session handling with timeout
5. **Activity Logging**: All admin actions are logged with IP addresses
6. **Role-Based Access**: Different permission levels for different user types

---

## 📊 DASHBOARD STATISTICS

The admin dashboard displays:
- Total active residents
- New inquiries (last 7 days)
- Pending tour requests
- Pending testimonials
- Active staff members
- Recent activity log
- Quick access to all management areas

---

## 🔧 COMMON TASKS

### Adding a New Resident
1. Login to admin panel
2. Go to "Residents"
3. Click "Add New Resident"
4. Fill in resident information
5. Click "Add Resident"

### Managing Inquiries
1. Go to "Inquiries"
2. Click on an inquiry to view details
3. Update status and add notes
4. Click "Update"

### Approving Testimonials
1. Go to "Testimonials"
2. Review pending testimonials
3. Click "Approve" or "Reject"

### Scheduling Tours
1. Go to "Tour Requests"
2. View pending requests
3. Confirm date/time
4. Update status to "Confirmed"

---

## 🆘 TROUBLESHOOTING

### Can't Login?
- Verify database connection in config.php
- Ensure admin_users table exists
- Try resetting password in database directly

### Database Errors?
- Check database credentials in config.php
- Verify all tables were created (run database_setup_complete.sql)
- Check MySQL error logs

### Permission Denied?
- Check file permissions (755 for directories, 644 for files)
- Ensure web server user has access

### Missing Features?
Some pages are marked "to be created" - these will show in navigation but redirect to dashboard until created.

---

## 📝 NEXT STEPS TO COMPLETE

To finish the admin system, you still need to create:

1. **staff.php** - Full staff management with CRUD operations
2. **tours.php** - Tour scheduling and management
3. **testimonials.php** - Testimonial approval system
4. **medications.php** - Medication tracking for residents
5. **care_plans.php** - Care plan management
6. **users.php** - Admin user management (super admin only)
7. **reports.php** - Analytics and reporting
8. **activity_log.php** - Full activity history viewer
9. **resident_detail.php** - Detailed resident profile
10. **edit_resident.php** - Resident editing form
11. **profile.php** - Admin user profile
12. **settings.php** - System settings

---

## 💡 TIPS

1. **Change Default Password**: First thing after login!
2. **Backup Database**: Regularly backup your database
3. **Test Before Production**: Test all features on a staging server
4. **Monitor Activity Log**: Check for unusual activity
5. **Update Regularly**: Keep PHP and MySQL updated

---

## 🎨 CUSTOMIZATION

### Changing Colors
Edit `/admin/css/admin.css` - look for gradient colors:
```css
background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
```

### Adding Custom Fields
1. Add column to database table
2. Add input field in forms
3. Update INSERT/UPDATE queries

### Changing Logo
Replace logo reference in `/admin/includes/header.php`

---

## 📞 SUPPORT

For issues or questions:
1. Check this README
2. Review error logs
3. Check database connection
4. Verify file permissions

---

## 📄 LICENSE

This system is provided for use with the Close to Saginaw Assisted Living facility.

---

## ✅ CHECKLIST FOR GOING LIVE

- [ ] Import database_setup_complete.sql
- [ ] Update config.php with production database credentials
- [ ] Change default admin password
- [ ] Test all login functionality
- [ ] Verify resident management works
- [ ] Test inquiry system
- [ ] Check email notifications (if configured)
- [ ] Set proper file permissions
- [ ] Test on mobile devices
- [ ] Create backup strategy
- [ ] Document any custom changes

---

**Version:** 2.0  
**Last Updated:** February 2026  
**Created for:** Close to Saginaw Assisted Living
