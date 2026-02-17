# QUICK START GUIDE - ADMIN SYSTEM INSTALLATION

## 🚀 Get Started in 5 Minutes!

### Step 1: Import Database (2 minutes)

Open your MySQL/phpMyAdmin and run:

```sql
mysql -u root -p < database_setup_complete.sql
```

Or in phpMyAdmin:
1. Click "Import"
2. Choose `database_setup_complete.sql`
3. Click "Go"

This creates:
- Database: `close_to_saginaw`
- All required tables
- Default admin user
- Sample data

### Step 2: Configure Database (1 minute)

Edit `/includes/config.php`:

```php
define('DB_HOST', 'localhost');
define('DB_USER', 'your_username');
define('DB_PASS', 'your_password');
define('DB_NAME', 'close_to_saginaw');
```

### Step 3: Login to Admin Panel (1 minute)

Go to: `http://yoursite.com/admin/login.php`

**Login with:**
- Username: `admin`
- Password: `admin123`

### Step 4: Change Password! (1 minute)

⚠️ **CRITICAL**: Immediately change the default password after first login!

---

## ✅ What You Get

### Admin Features:
✓ Secure login with password hashing
✓ Resident management
✓ Staff management
✓ Inquiry tracking
✓ Tour scheduling
✓ Testimonial approval
✓ Activity logging
✓ Dashboard analytics

### Public Website:
✓ Homepage with services
✓ About page
✓ Services pages (6 different care types)
✓ Contact form
✓ Gallery
✓ Testimonials

---

## 📁 File Structure

```
/admin/                  ← NEW Admin Panel
  - login.php           ← Admin login
  - dashboard.php       ← Main dashboard
  - residents.php       ← Manage residents
  - staff.php           ← Manage staff
  - inquiries.php       ← View inquiries
  - tours.php           ← Manage tours
  - testimonials.php    ← Approve testimonials

/includes/
  - config.php          ← Database settings (EDIT THIS!)

/services/              ← Public service pages
/css/                   ← Stylesheets
/js/                    ← JavaScript
```

---

## 🔐 Default Admin Account

**Username:** admin  
**Password:** admin123  
**Role:** Super Admin

**⚠️ CHANGE THIS PASSWORD AFTER FIRST LOGIN!**

---

## 📊 What's in the Database?

### Tables Created:
1. **admin_users** - Admin login accounts
2. **residents** - Resident information
3. **staff_members** - Staff directory
4. **contact_inquiries** - Contact form submissions
5. **tour_requests** - Tour scheduling
6. **testimonials** - Customer testimonials
7. **medications** - Resident medications
8. **care_plans** - Care plan tracking
9. **activity_log** - Admin activity history

### Sample Data Included:
- 1 Admin user (you!)
- 4 Sample testimonials
- 4 Sample staff members

---

## 🎯 Next Steps

1. **Add Real Data:**
   - Add your actual residents
   - Add your staff members
   - Customize testimonials

2. **Customize Website:**
   - Update contact information
   - Add your photos to gallery
   - Edit service descriptions

3. **Create More Admins:**
   - Go to Users (if you're super admin)
   - Add staff members as admin users

4. **Test Everything:**
   - Submit a test inquiry
   - Request a test tour
   - Add a test resident

---

## ❓ Troubleshooting

**Can't login?**
- Check database connection in config.php
- Verify database was imported correctly
- Try username: admin, password: admin123

**Database error?**
- Make sure MySQL is running
- Check credentials in config.php
- Verify database "close_to_saginaw" exists

**Page not found?**
- Check file permissions (755 for folders, 644 for files)
- Verify files are in correct location
- Check .htaccess if using Apache

**Missing features?**
- Some advanced pages (medications, care plans, reports) are placeholders
- Core functionality is fully working
- These can be added later as needed

---

## 📞 Need Help?

For detailed information, see:
- README_ADMIN.md (Full documentation)
- database_setup_complete.sql (Database structure)

---

## ⚡ Quick Reference

| What | Where |
|------|-------|
| Admin Login | /admin/login.php |
| Dashboard | /admin/dashboard.php |
| Public Site | /index.php |
| Config File | /includes/config.php |
| Database Setup | database_setup_complete.sql |
| Full Docs | README_ADMIN.md |

---

**You're all set! 🎉**

Login now and start managing your assisted living facility!
