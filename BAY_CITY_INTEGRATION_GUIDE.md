# Bay City Location Integration Guide

## Overview
This guide documents the changes made to add a second location (Bay City) to your Close to Home assisted living website. The site now supports multiple locations while maintaining a unified brand and user experience.

## What Was Added

### 1. New Pages Created

#### Main Locations Page (`locations.php`)
- Lists both Saginaw and Bay City locations
- Shows contact information for each location
- Displays services available at each location
- Includes links to detailed location pages
- Shows service area map

#### Location Detail Pages
- **`/locations/saginaw.php`** - Dedicated page for Saginaw location
- **`/locations/baycity.php`** - Dedicated page for Bay City location

Each location page includes:
- Specific contact information (phone, email, address)
- Full service listings
- Amenities available at that location
- "Schedule Tour" button that pre-selects the location
- Local community information

### 2. Navigation Menu Updates

**New "Locations" Dropdown Menu** added to the main navigation with:
- Link to main locations page
- Direct links to Saginaw location page
- Direct links to Bay City location page

The dropdown is located between "About Us" and "Experiences" in the navigation.

### 3. Contact Form Enhancement

**Tour Request Form** now includes:
- Location selector dropdown (required field)
- Pre-selection when arriving from location-specific pages
- Location information included in tour confirmation emails

### 4. Contact Information Updates

**Contact Page** now shows:
- Separate contact sections for each location
- Saginaw: (989) 555-2273 / saginaw@closetohome.com
- Bay City: (989) 555-2274 / baycity@closetohome.com

### 5. Database Changes

**New Database Migration File:** `database_migration_locations.sql`

This file includes SQL to:
- Add `location` column to `tour_requests` table
- Add `location` column to `contact_inquiries` table
- Create optional `locations` table for future expansion
- Insert initial data for both locations

## How to Implement

### Step 1: Upload Files
Upload all the new and modified files to your web server:

**New Files:**
- `/locations.php`
- `/locations/saginaw.php`
- `/locations/baycity.php`
- `/database_migration_locations.sql`

**Modified Files:**
- `/includes/header.php` (navigation menu)
- `/contact.php` (contact info and tour form)
- `/process_tour.php` (handles location field)

### Step 2: Update Database
Run the database migration:

```sql
-- Option 1: Using phpMyAdmin
1. Log into phpMyAdmin
2. Select your database
3. Click the "SQL" tab
4. Copy and paste the contents of database_migration_locations.sql
5. Click "Go"

-- Option 2: Using MySQL command line
mysql -u your_username -p your_database_name < database_migration_locations.sql
```

### Step 3: Update Admin Panel (Optional)
If you want to view location information in the admin panel:

1. Edit `/admin/tours.php`
2. Add location column to the tour requests display
3. Add location filter option

Example code to add to tours.php:
```php
// In the table header
<th>Location</th>

// In the data rows
<td><?php echo ucfirst($tour['location']); ?></td>
```

### Step 4: Test the Implementation

**Test Checklist:**
- [ ] Visit locations.php - both locations should display
- [ ] Click on Saginaw location page - should show Saginaw details
- [ ] Click on Bay City location page - should show Bay City details
- [ ] Test "Schedule Tour" buttons - should pre-select the correct location
- [ ] Submit a tour request for each location - should receive correct confirmation
- [ ] Check navigation menu - "Locations" dropdown should work on all pages
- [ ] Verify contact information displays correctly for both locations

## Location Information Reference

### Saginaw Location
- **Name:** Close to Saginaw
- **Address:** Near Saginaw, Michigan (Zilwaukee Area)
- **Phone:** (989) 555-2273
- **Email:** saginaw@closetohome.com
- **Access:** Highway 75

### Bay City Location
- **Name:** Close to Bay City
- **Address:** Bay City, Michigan
- **Phone:** (989) 555-2274
- **Email:** baycity@closetohome.com

## Customization Options

### Update Location Details
To change location information, edit:
- `/locations.php` - Main location cards
- `/locations/saginaw.php` - Saginaw specific content
- `/locations/baycity.php` - Bay City specific content
- `/contact.php` - Contact information sections

### Add More Locations in the Future
1. Create a new location detail page (e.g., `/locations/midland.php`)
2. Add the location to the dropdown in `/includes/header.php`
3. Add location card to `/locations.php`
4. Add location option to contact form in `/contact.php`
5. Add location to database

### Change Phone Numbers or Emails
Search and replace across these files:
- `/locations.php`
- `/locations/saginaw.php`
- `/locations/baycity.php`
- `/contact.php`
- `/process_tour.php`

## SEO Benefits

Having separate location pages helps with:
- Local SEO for both Saginaw and Bay City searches
- Google My Business integration (create separate listings)
- Location-specific content and keywords
- Better targeting for local advertising

## Google My Business Setup

**Create two separate Google My Business listings:**

1. **Close to Saginaw**
   - Link to: https://yourwebsite.com/locations/saginaw.php
   - Phone: (989) 555-2273
   - Service area: Saginaw, Zilwaukee, Frankenmuth, etc.

2. **Close to Bay City**
   - Link to: https://yourwebsite.com/locations/baycity.php
   - Phone: (989) 555-2274
   - Service area: Bay City, Essexville, Auburn, etc.

## Analytics Tracking

**Recommended Google Analytics Events:**
- Track which location pages get the most visits
- Monitor tour requests by location
- Compare conversion rates between locations

Add to your analytics:
```javascript
// Track location page views
gtag('event', 'page_view', {
  'page_title': 'Saginaw Location',
  'page_location': window.location.href
});

// Track tour requests by location
gtag('event', 'tour_request', {
  'location': 'saginaw' // or 'baycity'
});
```

## Troubleshooting

### Navigation Menu Not Showing
- Clear browser cache
- Check that header.php was updated correctly
- Verify file permissions on server

### Location Not Saving in Database
- Ensure database migration was run successfully
- Check that `location` column exists in `tour_requests` table
- Verify form field name matches database column

### Email Not Including Location
- Check process_tour.php has been updated
- Verify email configuration on server
- Test with mail() function uncommented

### Images Not Displaying on Location Pages
- Upload images to `/images/gallery/` directory
- Update image paths in location pages if needed
- Check file permissions

## Future Enhancements

Consider adding:
- Location-specific galleries
- Location-specific staff pages
- Location-specific events calendars
- Location-specific testimonials
- Interactive map showing both locations
- Comparison tool between locations

## Support

If you need help implementing these changes:
1. Review this documentation carefully
2. Check that all files were uploaded correctly
3. Verify database migration completed successfully
4. Test each component individually
5. Check browser console for JavaScript errors

## File Checklist

**Created Files:**
- ✓ locations.php
- ✓ locations/saginaw.php
- ✓ locations/baycity.php
- ✓ database_migration_locations.sql
- ✓ BAY_CITY_INTEGRATION_GUIDE.md (this file)

**Modified Files:**
- ✓ includes/header.php
- ✓ contact.php
- ✓ process_tour.php

**Database Tables Modified:**
- ✓ tour_requests (added location column)
- ✓ contact_inquiries (added location column)
- ✓ locations (new table created)

---

## Quick Start Summary

1. **Upload all files** to your web server
2. **Run the SQL migration** in your database
3. **Test the locations page** at yoursite.com/locations.php
4. **Submit test tour requests** for each location
5. **Update Google My Business** with both locations
6. **Customize content** as needed for your facilities

That's it! Your website now fully supports both locations with a professional, easy-to-navigate structure.
