# Location Separation Update - Complete Documentation

## Overview
Your website now fully supports two separate locations (Saginaw and Bay City) with separate data for testimonials, tour requests, and contact inquiries. Each location maintains its own records while sharing the same admin system.

---

## 🎯 What's New

### 1. Database Changes
A `location` column has been added to three tables:
- `tour_requests` - tracks which location the tour is for
- `contact_inquiries` - tracks which location the inquiry is about
- `testimonials` - tracks which location the testimonial is for

### 2. Frontend Changes

#### Home Page (`index.php`)
- **New Location Selection Section** prominently displays both locations
- Large, interactive cards for Saginaw and Bay City
- Direct navigation to each location's page
- Contact information visible on cards

#### Contact Page (`contact.php`)
- Location dropdown added to tour request form
- Location dropdown added to general contact form
- Auto-selects location when coming from location-specific pages

#### Experiences Page (`experiences.php`)
- **Location Filter Buttons**: All Locations, Saginaw, Bay City
- Location badges on each testimonial card
- Filter testimonials by location
- Location dropdown in "Share Your Experience" form
- Empty state message when no testimonials for selected location

#### Location Pages
- `locations/saginaw.php` - Dedicated Saginaw page with contact info
- `locations/baycity.php` - Dedicated Bay City page with contact info

### 3. Backend Changes

#### Processing Scripts
**`process_tour.php`** - Updated to capture location
- Saves location to database
- Uses location-specific email and phone in confirmations

**`process_contact.php`** - Updated to capture location  
- Saves location to database
- Uses location-specific branding in emails

**`submit_testimonial.php`** - Updated to capture location
- Saves location to database
- Redirects with location parameter

#### Admin Panel Updates

**Tours Page (`admin/tours.php`)**
- Location filter dropdown (All, Saginaw, Bay City)
- Location badge column in tours table
- Filter tours by status AND location

**Inquiries Page (`admin/inquiries.php`)**
- Location filter dropdown (All, Saginaw, Bay City)
- Location badge column in inquiries table  
- Filter inquiries by status AND location
- Search works across all locations

**Testimonials Page (`admin/testimonials.php`)**
- Location filter dropdown (All, Saginaw, Bay City)
- Location badges on testimonial cards
- Filter by approval status AND location
- Manage testimonials per location

---

## 📋 Migration Instructions

### Step 1: Run Database Migration
Execute this SQL script on your database:

```sql
-- File: database_migration_add_locations.sql

USE close_to_saginaw;

-- Add location column to tour_requests table
ALTER TABLE tour_requests 
ADD COLUMN location VARCHAR(50) DEFAULT 'saginaw' AFTER id;

-- Add location column to contact_inquiries table
ALTER TABLE contact_inquiries 
ADD COLUMN location VARCHAR(50) DEFAULT 'saginaw' AFTER id;

-- Add location column to testimonials table
ALTER TABLE testimonials 
ADD COLUMN location VARCHAR(50) DEFAULT 'saginaw' AFTER id;

-- Update existing data to have default location
UPDATE tour_requests SET location = 'saginaw' WHERE location IS NULL;
UPDATE contact_inquiries SET location = 'saginaw' WHERE location IS NULL;
UPDATE testimonials SET location = 'saginaw' WHERE location IS NULL;

-- Add index for better performance
ALTER TABLE tour_requests ADD INDEX idx_location (location);
ALTER TABLE contact_inquiries ADD INDEX idx_location (location);
ALTER TABLE testimonials ADD INDEX idx_location (location);

-- Insert sample testimonials for Bay City
INSERT INTO testimonials (location, author_name, relationship, rating, testimonial_text, is_featured, approved) VALUES
('baycity', 'Linda K.', 'Daughter', 5, 'Close to Bay City has exceeded all our expectations. The facility is beautiful, the staff is caring, and my father is thriving. We made the right choice bringing him here.', TRUE, TRUE),
('baycity', 'Thomas R.', 'Family Member', 5, 'The Bay City location offers exceptional memory care. My wife receives personalized attention and the staff treats her with such dignity and respect. Highly recommend.', TRUE, TRUE),
('baycity', 'Patricia H.', 'Wife', 5, 'My husband has been at the Bay City facility for six months now. The quality of care, activities, and meals are all top-notch. He tells me every day how happy he is there.', TRUE, TRUE);
```

### Step 2: Upload Updated Files
Replace these files on your server:
- `/index.php` - Updated home page with location selection
- `/contact.php` - Updated with location dropdowns
- `/experiences.php` - Updated with location filtering
- `/process_tour.php` - Updated to save location
- `/process_contact.php` - Updated to save location
- `/submit_testimonial.php` - Updated to save location
- `/admin/tours.php` - Updated with location filtering
- `/admin/inquiries.php` - Updated with location filtering
- `/admin/testimonials.php` - Updated with location filtering
- `/css/style.css` - Updated with new location card styles

---

## 🎨 Visual Features

### Location Badges
Throughout the admin panel and public site, location badges appear:
- **Saginaw**: Blue badge
- **Bay City**: Green badge

### Location Cards on Home Page
- Large, prominent display
- Hover effects (cards lift and borders highlight)
- Clickable entire card area
- Contact info prominently displayed
- Icons differentiate locations (map marker vs city icon)

### Filter Buttons
- Clean, modern button groups
- Active state clearly visible
- Maintains filter state when switching between filters

---

## 📞 Contact Information by Location

### Saginaw
- **Phone**: (989) 555-2273
- **Email**: saginaw@closetohome.com
- **Location**: Near Saginaw, Michigan (Zilwaukee Area)
- **Page**: `/locations/saginaw.php`

### Bay City
- **Phone**: (989) 555-2274
- **Email**: baycity@closetohome.com
- **Location**: Bay City, Michigan
- **Page**: `/locations/baycity.php`

---

## 🔄 User Flow Examples

### Example 1: Scheduling a Tour from Home Page
1. User lands on home page
2. Sees location selection section
3. Clicks "View Bay City Location" card
4. Arrives at `/locations/baycity.php`
5. Scrolls to tour form (or clicks Schedule Tour button)
6. Location dropdown pre-selected to "Bay City"
7. Fills out form and submits
8. Tour request saved with `location = 'baycity'`

### Example 2: Admin Managing Location-Specific Tours
1. Admin logs into dashboard
2. Navigates to "Tour Requests"
3. Sees all pending tours from both locations
4. Selects "Bay City" from location dropdown
5. Views only Bay City tour requests
6. Can filter further by status (pending, confirmed, etc.)

### Example 3: Filtering Testimonials by Location
1. Visitor navigates to Experiences page
2. Sees filter buttons: All Locations | Saginaw | Bay City
3. Clicks "Saginaw"
4. Page shows only Saginaw testimonials
5. Each testimonial has location badge
6. Can submit new testimonial for specific location

---

## 💾 Database Schema

### tour_requests table
```sql
- id (primary key)
- location (VARCHAR 50) - 'saginaw' or 'baycity'
- name
- email  
- phone
- preferred_date
- preferred_time
- number_of_guests
- message
- status
- confirmed_date
- confirmed_time
- assigned_to
- notes
- created_at
```

### contact_inquiries table
```sql
- id (primary key)
- location (VARCHAR 50) - 'saginaw' or 'baycity'
- name
- email
- phone
- care_type
- message
- status
- assigned_to
- notes
- created_at
```

### testimonials table
```sql
- id (primary key)
- location (VARCHAR 50) - 'saginaw' or 'baycity'
- author_name
- relationship
- rating
- testimonial_text
- is_featured
- approved
- approved_by
- approved_at
- created_at
```

---

## 🔧 Admin Panel Features

### Dashboard Improvements
Admins can now:
- **Filter by location** on all three main management pages
- **See location badges** at a glance in tables
- **Combine filters**: Filter by both status AND location
- **Track metrics per location** (if desired for future reporting)

### Color Coding
- **Saginaw** = Primary blue (`bg-primary`)
- **Bay City** = Success green (`bg-success`)

---

## 🚀 Future Enhancement Ideas

1. **Location-Specific Analytics Dashboard**
   - Tours per location
   - Inquiries per location
   - Average ratings per location

2. **Location-Specific Staff Assignment**
   - Assign staff members to specific locations
   - Auto-route inquiries to location-specific staff

3. **Location-Specific Services**
   - Different services offered at each location
   - Custom pricing per location

4. **Multi-Location Calendar**
   - View tours for both locations side-by-side
   - Prevent double-booking staff

5. **Location-Specific Content**
   - Different gallery images per location
   - Location-specific blog posts or news

---

## ✅ Testing Checklist

Before going live, test:
- [ ] Home page location cards display correctly
- [ ] Clicking location cards navigates to correct pages
- [ ] Tour form pre-selects correct location from URL
- [ ] Tour submissions save with correct location
- [ ] Contact form pre-selects correct location from URL
- [ ] Contact submissions save with correct location
- [ ] Testimonial form pre-selects correct location from URL
- [ ] Testimonial submissions save with correct location
- [ ] Experiences page filters work (All, Saginaw, Bay City)
- [ ] Location badges display on testimonials
- [ ] Admin tours page filters by location
- [ ] Admin inquiries page filters by location
- [ ] Admin testimonials page filters by location
- [ ] Location badges display in admin tables
- [ ] Database migration completed without errors
- [ ] Sample Bay City testimonials display

---

## 🛠️ Troubleshooting

### Issue: Location column doesn't exist error
**Solution**: Run the database migration script

### Issue: All data showing as "Saginaw"
**Solution**: Existing data defaults to Saginaw. New submissions will have correct locations.

### Issue: Location filter not working in admin
**Solution**: Clear browser cache and refresh page

### Issue: Location badges not showing
**Solution**: Ensure the location column has values ('saginaw' or 'baycity')

### Issue: Testimonials not filtering
**Solution**: Check that testimonials table has location column with proper values

---

## 📝 Key Files Modified

### Public Site:
- `index.php` - Location selection section
- `contact.php` - Location dropdowns added
- `experiences.php` - Location filtering added
- `process_tour.php` - Location capture
- `process_contact.php` - Location capture
- `submit_testimonial.php` - Location capture
- `css/style.css` - Location card styles

### Admin Panel:
- `admin/tours.php` - Location filter and badges
- `admin/inquiries.php` - Location filter and badges
- `admin/testimonials.php` - Location filter and badges

### Database:
- `database_migration_add_locations.sql` - Migration script

---

## 📞 Support

If you need any modifications or have questions:
1. Check the troubleshooting section
2. Review the code comments in updated files
3. Test on a staging environment first
4. Keep backups of database and files before major changes

---

## Summary

Your website now fully supports two separate locations with:
✅ Separate testimonials per location  
✅ Separate tour requests per location  
✅ Separate contact inquiries per location  
✅ Location filtering throughout admin panel  
✅ Beautiful location selection on home page  
✅ Location-specific contact information  
✅ Professional location badges and indicators  
✅ Seamless user experience with pre-selected locations  

The system is designed to easily scale to additional locations in the future if needed!
