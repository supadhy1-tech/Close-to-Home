# Close to Saginaw - MongoDB Atlas Conversion Package

Complete package to convert your Close to Saginaw Assisted Living website from MySQL to MongoDB Atlas.

## 📦 Package Contents

### Documentation Files
1. **QUICK_START_MONGODB.md** - 15-minute setup guide (START HERE!)
2. **MONGODB_MIGRATION_GUIDE.md** - Comprehensive migration guide with troubleshooting
3. **MYSQL_TO_MONGODB_CONVERSION.md** - Query conversion reference
4. **mongodb_schema_design.md** - Database schema and collection structure

### Configuration Files
5. **composer.json** - PHP dependencies (MongoDB library)
6. **config_mongodb.php** - MongoDB connection configuration

### Setup Scripts
7. **setup_mongodb.php** - Initialize MongoDB database with sample data
8. **migrate_mysql_to_mongodb.php** - Migrate existing MySQL data to MongoDB

### Updated Application Files
9. **process_contact_mongodb.php** - Contact form handler (MongoDB version)
10. **process_tour_mongodb.php** - Tour request handler (MongoDB version)
11. **admin_testimonials_mongodb.php** - Admin testimonials management (example)

## 🚀 Quick Start (3 Steps)

### 1. Set Up MongoDB Atlas (5 minutes)
- Create free account at https://www.mongodb.com/cloud/atlas/register
- Create M0 FREE cluster
- Set up database user and network access
- Get your connection string

### 2. Install Dependencies (5 minutes)
```bash
# Install MongoDB PHP extension
sudo pecl install mongodb

# Install Composer packages
composer install
```

### 3. Configure & Initialize (5 minutes)
```bash
# Update config with your connection string
# Edit config_mongodb.php line 7

# Run setup
php setup_mongodb.php

# You're done!
```

**Full guide**: See `QUICK_START_MONGODB.md`

## 📋 What You Need

### Requirements
- PHP 7.4 or higher
- Composer
- MongoDB Atlas account (free)
- Your existing Close to Saginaw website

### What Changes
- ✅ Database: MySQL → MongoDB Atlas
- ✅ All data preserved with same relationships
- ✅ Same functionality, better scalability
- ✅ Automatic backups included (Atlas)
- ✅ Easy to scale as you grow

### What Stays the Same
- ✅ All website features work identically
- ✅ Admin panel looks and works the same
- ✅ No changes to HTML/CSS/JavaScript
- ✅ Same user experience

## 🎯 Migration Paths

### Option A: Fresh Start (Recommended for new sites)
```bash
1. Set up MongoDB Atlas
2. Install dependencies
3. Run setup_mongodb.php
4. Replace old config with config_mongodb.php
5. Done!
```

### Option B: Migrate Existing Data
```bash
1. Set up MongoDB Atlas
2. Install dependencies  
3. Run migrate_mysql_to_mongodb.php
4. Replace old config with config_mongodb.php
5. Test everything
6. Keep MySQL as backup or remove
```

## 📖 Documentation Guide

**Start here for different needs:**

| If you want to... | Read this file |
|-------------------|----------------|
| Get up and running fast | QUICK_START_MONGODB.md |
| Detailed setup instructions | MONGODB_MIGRATION_GUIDE.md |
| Convert specific queries | MYSQL_TO_MONGODB_CONVERSION.md |
| Understand the new schema | mongodb_schema_design.md |

## 🔄 File Replacement Map

After setup, replace these files:

| Old File | New File | Location |
|----------|----------|----------|
| includes/config.php | config_mongodb.php | includes/ |
| process_contact.php | process_contact_mongodb.php | root |
| process_tour.php | process_tour_mongodb.php | root |
| admin/testimonials.php | admin_testimonials_mongodb.php | admin/ |

**Note**: Similar updates needed for other admin files (inquiries, tours, dashboard)

## 💾 Database Schema Comparison

### MySQL Structure
```
Tables:
- admin_users (INT id, AUTO_INCREMENT)
- testimonials (INT id, FOREIGN KEY)
- tour_requests (INT id, FOREIGN KEY)
- contact_inquiries (INT id, FOREIGN KEY)
... etc
```

### MongoDB Structure
```
Collections:
- admin_users (ObjectId _id)
- testimonials (ObjectId _id, ObjectId refs)
- tour_requests (ObjectId _id, ObjectId refs)
- contact_inquiries (ObjectId _id, ObjectId refs)
... etc
```

**Key difference**: ObjectId instead of auto-increment integers

## 🔑 Key Concepts

### 1. ObjectId
MongoDB's unique identifier (replaces MySQL AUTO_INCREMENT)
```php
// MySQL
$id = 5;

// MongoDB  
$id = new ObjectId('507f1f77bcf86cd799439011');
```

### 2. Collections vs Tables
Same concept, different name
```php
// MySQL
mysqli_query($conn, "SELECT * FROM testimonials");

// MongoDB
$collection = getCollection('testimonials');
$cursor = $collection->find();
```

### 3. Documents vs Rows
Documents can have nested data
```php
// MongoDB document can embed related data
{
  _id: ObjectId(),
  name: "John Doe",
  emergency_contact: {
    name: "Jane Doe",
    phone: "555-0100",
    relationship: "Spouse"
  }
}
```

## 🛠️ Helper Functions Provided

The config file includes these helpers:

```php
getCollection($name)          // Get a collection
mongoToArray($document)       // Convert to PHP array
toObjectId($id)              // String to ObjectId
getIdString($document)       // ObjectId to string
paginate($collection, ...)   // Easy pagination
```

## 📊 Benefits of MongoDB Atlas

### Free Tier Includes:
- ✅ 512MB storage
- ✅ Automatic daily backups
- ✅ SSL/TLS encryption
- ✅ Performance monitoring
- ✅ Email alerts
- ✅ Global deployment options

### Scalability:
- Start free (M0)
- Upgrade to M2/M5 as you grow
- Easy vertical scaling
- Multi-region deployment
- No downtime upgrades

### Developer Experience:
- Beautiful web dashboard
- MongoDB Compass (free GUI)
- Excellent documentation
- Active community
- Great PHP library

## 🔒 Security Best Practices

### After Setup:
1. ✅ Change admin password from default
2. ✅ Use environment variables for credentials
3. ✅ Update network access (remove 0.0.0.0/0 in production)
4. ✅ Enable SSL/TLS (included in Atlas)
5. ✅ Regular backups (automatic in Atlas)
6. ✅ Monitor access logs

### Connection String Security:
```php
// Don't commit this to Git!
// Use environment variables:
$uri = getenv('MONGODB_URI');

// Or use .env file with PHP dotenv
```

## 🐛 Common Issues

### Issue: Class not found
**Solution**: Run `composer install`

### Issue: Connection timeout
**Solution**: Check IP whitelist in Atlas

### Issue: Extension not loaded
**Solution**: Add `extension=mongodb` to php.ini and restart server

### Issue: Authentication failed
**Solution**: Verify username/password in connection string

**Full troubleshooting**: See `MONGODB_MIGRATION_GUIDE.md`

## 📈 Performance Tips

### 1. Create Indexes
```php
// For frequently queried fields
$collection->createIndex(['status' => 1]);
$collection->createIndex(['created_at' => -1]);
```

### 2. Use Projections
```php
// Only fetch needed fields
$cursor = $collection->find(
    ['status' => 'active'],
    ['projection' => ['name' => 1, 'email' => 1]]
);
```

### 3. Batch Operations
```php
// Insert multiple at once
$collection->insertMany($documents);
```

### 4. Monitor in Atlas
- Check slow queries
- Review index usage
- Monitor connections

## 🎓 Learning Resources

### Official Docs:
- MongoDB Manual: https://docs.mongodb.com/manual/
- PHP Library: https://docs.mongodb.com/php-library/
- Atlas Docs: https://docs.atlas.mongodb.com/

### Tools:
- MongoDB Compass (GUI): https://www.mongodb.com/products/compass
- Atlas Dashboard: https://cloud.mongodb.com/
- MongoDB University (free courses): https://university.mongodb.com/

### Community:
- MongoDB Community Forums: https://community.mongodb.com/
- Stack Overflow: https://stackoverflow.com/questions/tagged/mongodb

## ✅ Post-Migration Checklist

After migration, verify:
- [ ] Website loads without errors
- [ ] Admin login works
- [ ] Contact form submits successfully
- [ ] Tour requests work
- [ ] Testimonials display correctly
- [ ] Admin panel CRUD operations work
- [ ] Data matches original (if migrated)
- [ ] All relationships intact
- [ ] Performance acceptable
- [ ] Backups configured in Atlas
- [ ] Monitoring/alerts set up
- [ ] Production network access configured
- [ ] Admin password changed
- [ ] Documentation reviewed by team

## 🆘 Support

### Documentation:
1. Quick Start: `QUICK_START_MONGODB.md`
2. Full Guide: `MONGODB_MIGRATION_GUIDE.md`
3. Query Reference: `MYSQL_TO_MONGODB_CONVERSION.md`

### External Resources:
- MongoDB Support: https://support.mongodb.com/
- Atlas Documentation: https://docs.atlas.mongodb.com/
- PHP MongoDB Library: https://docs.mongodb.com/php-library/

## 📝 Notes

### Important:
- ⚠️ Always backup before migration
- ⚠️ Test in development first
- ⚠️ Change default admin password
- ⚠️ Use environment variables for credentials
- ⚠️ Keep MySQL as backup initially

### MongoDB Atlas Free Tier Limits:
- Storage: 512MB
- RAM: Shared
- Connections: 100 simultaneous
- Backups: Daily (8 days retention)

Perfect for development and small-medium sites!

## 🎉 Success!

Once everything works:
1. ✅ Your site runs on MongoDB Atlas
2. ✅ Automatic backups protect your data
3. ✅ Easy to scale as you grow
4. ✅ Better performance with indexes
5. ✅ Free monitoring and alerts

Welcome to MongoDB! 🚀

---

**Package Version**: 1.0  
**Created**: February 2026  
**For**: Close to Saginaw Assisted Living  
**License**: Use freely for this project
