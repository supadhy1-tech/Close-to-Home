# Quick Start: MySQL to MongoDB Conversion

Get your Close to Saginaw website running with MongoDB Atlas in 15 minutes!

## 🚀 Quick Setup (Step by Step)

### Step 1: MongoDB Atlas Account (2 minutes)
1. Go to https://www.mongodb.com/cloud/atlas/register
2. Sign up (free)
3. Click "Build a Database"
4. Choose **M0 FREE** tier
5. Choose AWS/Google Cloud + region near you
6. Click "Create"
7. Wait 2-3 minutes for cluster creation

### Step 2: Database User (1 minute)
1. Click **Database Access** → **Add New Database User**
2. Username: `closeToSaginaw`
3. Password: Generate or create strong password
4. **⚠️ SAVE THESE CREDENTIALS!**
5. Database User Privileges: **Atlas admin**
6. Click **Add User**

### Step 3: Network Access (1 minute)
1. Click **Network Access** → **Add IP Address**
2. Click **Allow Access from Anywhere** (for testing)
3. Click **Confirm**

⚠️ **Note**: In production, use specific IP addresses

### Step 4: Get Connection String (1 minute)
1. Click **Database** → **Connect**
2. Choose **Connect your application**
3. Driver: **PHP**, Version: **1.13 or later**
4. Copy connection string:
   ```
   mongodb+srv://closeToSaginaw:<password>@cluster0.xxxxx.mongodb.net/?retryWrites=true&w=majority
   ```
5. Replace `<password>` with your actual password
6. **⚠️ SAVE THIS STRING!**

### Step 5: Install MongoDB PHP Extension (5 minutes)

#### Windows (XAMPP/WAMP):
```bash
# Download the DLL
php -r "copy('https://pecl.php.net/get/mongodb', 'mongodb.zip');"

# Extract php_mongodb.dll to your PHP ext folder
# Example: C:\xampp\php\ext\

# Edit php.ini and add:
extension=mongodb

# Restart Apache
```

#### Linux/Mac:
```bash
sudo pecl install mongodb

# Add to php.ini:
echo "extension=mongodb.so" | sudo tee -a /etc/php/8.1/apache2/php.ini

# Restart Apache
sudo service apache2 restart
```

#### Verify:
```bash
php -m | grep mongodb
```
You should see: `mongodb`

### Step 6: Install Composer Dependencies (2 minutes)
```bash
cd /path/to/close-to-saginaw-pro-with-baycity
composer install
```

If you don't have Composer:
- Windows: Download from https://getcomposer.org/Composer-Setup.exe
- Mac: `brew install composer`
- Linux: `curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer`

### Step 7: Update Configuration (2 minutes)

1. Copy the new config file:
```bash
cp config_mongodb.php includes/config.php
```

2. Edit `includes/config.php` and update line 7:
```php
define('MONGODB_URI', 'mongodb+srv://closeToSaginaw:YOUR_PASSWORD@cluster0.xxxxx.mongodb.net/?retryWrites=true&w=majority');
```

Replace `YOUR_PASSWORD` with your actual password!

### Step 8: Initialize Database (1 minute)
```bash
# Update setup_mongodb.php line 11 with your connection string
php setup_mongodb.php
```

You should see:
```
✓ Connected to MongoDB Atlas
✓ Admin user created (username: admin, password: admin123)
✓ Setup Complete!
```

### Step 9: Test It! (1 minute)

1. Start your web server
2. Visit: `http://localhost/close-to-saginaw-pro-with-baycity`
3. Click around - everything should work!
4. Go to: `http://localhost/close-to-saginaw-pro-with-baycity/admin`
5. Login: `admin` / `admin123`

### Step 10: Security (1 minute)

1. Log into admin panel
2. Change password from `admin123`
3. In production: Update Network Access to use specific IPs

## ✅ Verification Checklist

- [ ] MongoDB extension installed (`php -m | grep mongodb`)
- [ ] Composer dependencies installed (`vendor` folder exists)
- [ ] Connection string updated in `config.php`
- [ ] Setup script run successfully
- [ ] Website loads without errors
- [ ] Admin panel login works
- [ ] Contact form submission works
- [ ] Tour request works

## 🎯 If You Have Existing MySQL Data

Run the migration script:

```bash
# Edit migrate_mysql_to_mongodb.php line 16 with your MongoDB URI
# Edit lines 8-11 with your MySQL credentials
php migrate_mysql_to_mongodb.php
```

This will copy all your existing data from MySQL to MongoDB!

## 📁 Files You Need

### Core Files (included):
- `composer.json` - Dependencies
- `config_mongodb.php` - MongoDB connection
- `setup_mongodb.php` - Database initialization
- `migrate_mysql_to_mongodb.php` - Data migration (if needed)

### Updated Files (need to replace originals):
- `process_contact.php` → `process_contact_mongodb.php`
- `process_tour.php` → `process_tour_mongodb.php`
- All admin panel files (provided separately)

## 🔧 Common Issues & Fixes

### "Class 'MongoDB\Client' not found"
```bash
composer install
```

### "No suitable servers found"
- Check connection string
- Verify password is correct (no special characters unencoded)
- Check IP whitelist in MongoDB Atlas

### Extension not found
```bash
# Check if installed
php -m | grep mongodb

# If not found, reinstall:
sudo pecl install mongodb

# Add to php.ini
extension=mongodb

# Restart Apache
```

### Connection timeout
- Verify cluster is running in Atlas
- Check firewall isn't blocking MongoDB ports
- Try whitelisting 0.0.0.0/0 temporarily

## 📚 What Changed?

### From MySQL:
```php
$conn = mysqli_connect('localhost', 'root', 'password', 'database');
$result = mysqli_query($conn, "SELECT * FROM testimonials");
while($row = mysqli_fetch_assoc($result)) {
    echo $row['author_name'];
}
```

### To MongoDB:
```php
$collection = getCollection('testimonials');
$cursor = $collection->find();
foreach($cursor as $doc) {
    echo $doc['author_name'];
}
```

## 🎓 Learning Resources

- Full conversion guide: `MYSQL_TO_MONGODB_CONVERSION.md`
- Schema design: `mongodb_schema_design.md`
- Detailed migration: `MONGODB_MIGRATION_GUIDE.md`

## 💡 Pro Tips

1. **Use MongoDB Compass** - Free GUI for MongoDB (https://www.mongodb.com/products/compass)
2. **Enable Monitoring** - Check Atlas dashboard for performance insights
3. **Set up Alerts** - Get notified of issues
4. **Backups are automatic** - Free tier includes daily backups
5. **Use indexes** - Speed up queries on frequently accessed fields

## 🆘 Need Help?

1. Check `MONGODB_MIGRATION_GUIDE.md` for detailed instructions
2. MongoDB Docs: https://docs.mongodb.com/
3. PHP MongoDB Library: https://docs.mongodb.com/php-library/current/

## 🎉 Success!

Once everything is working:
1. Test all features thoroughly
2. Update admin password
3. Configure production network access (specific IPs)
4. Set up monitoring and alerts in Atlas
5. Consider upgrading to M2/M5 cluster for production

Your website is now running on MongoDB Atlas! 🚀
