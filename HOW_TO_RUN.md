# How to Run Your Close to Saginaw Website

This guide will walk you through setting up and running your website step-by-step.

## 🎯 What You Need

Before starting, you need:

1. **A web server** - Choose ONE of these options:
   - **XAMPP** (Easiest for Windows/Mac) - [Download here](https://www.apachefriends.org/)
   - **WAMP** (Windows only) - [Download here](https://www.wampserver.com/)
   - **MAMP** (Mac only) - [Download here](https://www.mamp.info/)
   - **LAMP** (Linux)
   - **Web hosting account** (GoDaddy, Bluehost, etc.)

2. **The zip file** - close-to-saginaw-unified.zip (you already have this!)

---

## 🚀 Method 1: Using XAMPP (Recommended for Beginners)

### Step 1: Install XAMPP

1. Download XAMPP from https://www.apachefriends.org/
2. Install it (default settings are fine)
3. Install location is usually:
   - Windows: `C:\xampp`
   - Mac: `/Applications/XAMPP`

### Step 2: Start the Services

1. Open **XAMPP Control Panel**
2. Click **Start** next to **Apache**
3. Click **Start** next to **MySQL**
4. Both should show green "Running" status

### Step 3: Extract Your Website Files

1. Locate the XAMPP `htdocs` folder:
   - Windows: `C:\xampp\htdocs`
   - Mac: `/Applications/XAMPP/htdocs`

2. Extract `close-to-saginaw-unified.zip` into the `htdocs` folder
3. You should now have: `htdocs/close-to-saginaw-pro/`

### Step 4: Create the Database

1. Open your web browser
2. Go to: `http://localhost/phpmyadmin`
3. Click on **"New"** in the left sidebar
4. Database name: `close_to_saginaw`
5. Collation: `utf8mb4_general_ci`
6. Click **"Create"**

### Step 5: Import the Database Tables

1. Still in phpMyAdmin, click on `close_to_saginaw` database (left sidebar)
2. Click the **"Import"** tab at the top
3. Click **"Choose File"**
4. Navigate to: `htdocs/close-to-saginaw-pro/database_setup_complete.sql`
5. Click **"Go"** at the bottom
6. You should see "Import has been successfully finished"

### Step 6: Configure Database Connection

1. Open file: `htdocs/close-to-saginaw-pro/includes/config.php`
2. You can use Notepad, TextEdit, or any text editor
3. Make sure it has these settings:

```php
<?php
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');  // Empty for XAMPP default
define('DB_NAME', 'close_to_saginaw');
?>
```

4. Save the file

### Step 7: Access Your Website!

**Public Website:**
- Open browser and go to: `http://localhost/close-to-saginaw-pro/`
- You should see your homepage!

**Admin Panel:**
- Go to: `http://localhost/close-to-saginaw-pro/admin/`
- Login with:
  - Username: `admin`
  - Password: `admin123`
- **IMPORTANT:** Change this password after first login!

---

## 🌐 Method 2: Using Web Hosting (Live Website)

### Step 1: Upload Files via FTP

1. Get FTP credentials from your hosting provider
2. Download an FTP client like FileZilla (free)
3. Connect to your server using the credentials
4. Upload the `close-to-saginaw-pro` folder to `public_html` or `www` folder

### Step 2: Create Database via cPanel

1. Login to your hosting cPanel
2. Find **"MySQL Databases"**
3. Create a new database: `close_to_saginaw`
4. Create a database user with a strong password
5. Add the user to the database with **ALL PRIVILEGES**
6. Write down:
   - Database name
   - Database username
   - Database password

### Step 3: Import Database

1. In cPanel, find **"phpMyAdmin"**
2. Select your `close_to_saginaw` database
3. Click **"Import"** tab
4. Upload `database_setup_complete.sql`
5. Click **"Go"**

### Step 4: Update Config File

1. Using FTP or cPanel File Manager, edit: `includes/config.php`
2. Update with your database details:

```php
<?php
define('DB_HOST', 'localhost'); // Usually localhost
define('DB_USER', 'your_db_username');
define('DB_PASS', 'your_db_password');
define('DB_NAME', 'your_db_name');
?>
```

3. Save the file

### Step 5: Access Your Live Website

- Public Site: `http://yourdomain.com/`
- Admin Panel: `http://yourdomain.com/admin/`
- Login: `admin` / `admin123`

---

## 🔧 Troubleshooting Common Issues

### "Connection failed" or "Database error"

**Problem:** Can't connect to database

**Solutions:**
1. Check `includes/config.php` has correct credentials
2. Make sure MySQL is running (in XAMPP Control Panel)
3. Verify database name is exactly: `close_to_saginaw`
4. For XAMPP, username is `root` and password is empty

### "Page not found" or "404 Error"

**Problem:** Can't access the website

**Solutions:**
1. Check Apache is running in XAMPP
2. Verify URL is correct: `http://localhost/close-to-saginaw-pro/`
3. Make sure files are in the `htdocs` folder
4. Check folder name is exactly `close-to-saginaw-pro`

### Admin Login Not Working

**Problem:** Can't login to admin panel

**Solutions:**
1. Verify you imported `database_setup_complete.sql`
2. Check the `admin_users` table exists in phpMyAdmin
3. Try resetting password directly in database:
   - Open phpMyAdmin
   - Click `close_to_saginaw` database
   - Click `admin_users` table
   - Click "Edit" on the admin row
   - Change password to: `$2y$10$YourNewHashHere` (or create new one)

### Blank White Page

**Problem:** Page loads but shows nothing

**Solutions:**
1. Enable error display - add to top of `index.php`:
```php
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>
```
2. Check PHP error logs
3. Verify all PHP files are present

---

## 📁 Important Files & Folders

```
close-to-saginaw-pro/
├── includes/config.php          ← Database settings (EDIT THIS!)
├── database_setup_complete.sql  ← Import this to database
├── admin/                       ← Admin panel folder
│   └── login.php               ← Admin login page
├── index.php                    ← Homepage
└── All other website files
```

---

## ✅ Quick Checklist

- [ ] XAMPP/WAMP/MAMP installed and running
- [ ] Files extracted to `htdocs` folder
- [ ] Database created: `close_to_saginaw`
- [ ] SQL file imported successfully
- [ ] `config.php` updated with correct credentials
- [ ] Can access: `http://localhost/close-to-saginaw-pro/`
- [ ] Can login to: `http://localhost/close-to-saginaw-pro/admin/`

---

## 🎨 Next Steps After Installation

### 1. Secure Your Admin Account
- Login to admin panel
- Change the default password immediately
- Use a strong password

### 2. Customize Your Content
- Edit pages through admin panel
- Update contact information
- Add your own images and content

### 3. Test All Features
- Submit a contact form
- Request a tour
- Submit a testimonial
- Test admin panel features

---

## 🆘 Still Having Problems?

1. **Check XAMPP logs:**
   - Windows: `C:\xampp\apache\logs\error.log`
   - Mac: `/Applications/XAMPP/logs/error_log`

2. **Check PHP version:**
   - Open browser: `http://localhost/dashboard`
   - Should be PHP 7.4 or higher

3. **Test database connection:**
   - Create a file: `htdocs/close-to-saginaw-pro/test.php`
   - Add this code:
```php
<?php
require_once 'includes/config.php';
$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if ($conn) {
    echo "Database connected successfully!";
} else {
    echo "Connection failed: " . mysqli_connect_error();
}
?>
```
   - Visit: `http://localhost/close-to-saginaw-pro/test.php`

---

## 📞 Quick Reference

| What | URL |
|------|-----|
| Public Website | `http://localhost/close-to-saginaw-pro/` |
| Admin Panel | `http://localhost/close-to-saginaw-pro/admin/` |
| phpMyAdmin | `http://localhost/phpmyadmin` |
| XAMPP Dashboard | `http://localhost/dashboard` |

**Default Admin Login:**
- Username: `admin`
- Password: `admin123`

---

**That's it! You should now have a fully working website.** 🎉

If you get stuck on any step, the error messages will usually tell you what's wrong. Read them carefully!
