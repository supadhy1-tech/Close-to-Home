#!/bin/bash

# MongoDB Conversion Installation Script
# Run this in your project root directory

echo "========================================"
echo "MongoDB Conversion Setup"
echo "Close to Saginaw Assisted Living"
echo "========================================"
echo ""

# Check if we're in the right directory
if [ ! -f "includes/config.php" ]; then
    echo "❌ Error: Run this script from your project root directory"
    echo "   Example: cd /path/to/close-to-saginaw-pro-with-baycity"
    exit 1
fi

echo "✓ Found project directory"
echo ""

# Backup existing config
echo "Creating backup of current config..."
if [ -f "includes/config.php" ]; then
    cp includes/config.php includes/config_mysql_backup.php
    echo "✓ Backed up to includes/config_mysql_backup.php"
fi

# Copy new files
echo ""
echo "Installing new files..."

# Config
cp config_mongodb.php includes/config.php
echo "✓ Installed MongoDB config"

# Process files
cp process_contact_mongodb.php process_contact.php
echo "✓ Updated contact form processor"

cp process_tour_mongodb.php process_tour.php
echo "✓ Updated tour request processor"

# Admin files
cp admin_testimonials_mongodb.php admin/testimonials.php
echo "✓ Updated admin testimonials"

echo ""
echo "========================================"
echo "Setup Complete!"
echo "========================================"
echo ""
echo "Next Steps:"
echo "1. Edit includes/config.php and add your MongoDB Atlas connection string"
echo "2. Run: composer install"
echo "3. Run: php setup_mongodb.php"
echo "4. Test your website!"
echo ""
echo "See QUICK_START_MONGODB.md for detailed instructions"
echo ""
