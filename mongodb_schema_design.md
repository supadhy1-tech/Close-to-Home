# MongoDB Schema Design for Close to Saginaw

## Overview
This document describes how the MySQL database tables are converted to MongoDB collections while maintaining all relationships and data integrity.

## Collections Structure

### 1. admin_users Collection
```javascript
{
  _id: ObjectId(),
  username: String (unique, indexed),
  password: String,
  full_name: String,
  email: String,
  role: String, // 'super_admin', 'admin', 'staff'
  is_active: Boolean,
  last_login: Date,
  created_at: Date,
  updated_at: Date
}
```

### 2. residents Collection
```javascript
{
  _id: ObjectId(),
  first_name: String,
  last_name: String,
  date_of_birth: Date,
  gender: String, // 'male', 'female', 'other'
  room_number: String,
  care_level: String, // 'independent', 'assisted', 'memory_care', 'respite'
  admission_date: Date,
  status: String, // 'active', 'discharged', 'deceased', 'transferred'
  medical_notes: String,
  dietary_restrictions: String,
  emergency_contact: {
    name: String,
    phone: String,
    relationship: String
  },
  photo_url: String,
  created_at: Date,
  updated_at: Date
}
```

### 3. staff_members Collection
```javascript
{
  _id: ObjectId(),
  first_name: String,
  last_name: String,
  email: String,
  phone: String,
  position: String,
  department: String, // 'nursing', 'activities', 'dining', 'housekeeping', 'maintenance', 'administration'
  hire_date: Date,
  status: String, // 'active', 'on_leave', 'terminated'
  certifications: String,
  notes: String,
  created_at: Date,
  updated_at: Date
}
```

### 4. contact_inquiries Collection
```javascript
{
  _id: ObjectId(),
  name: String,
  email: String,
  phone: String,
  care_type: String,
  message: String,
  created_at: Date,
  status: String, // 'new', 'contacted', 'scheduled', 'completed', 'closed'
  assigned_to: ObjectId, // Reference to admin_users._id
  notes: String
}
```

### 5. testimonials Collection
```javascript
{
  _id: ObjectId(),
  author_name: String,
  relationship: String,
  rating: Number,
  testimonial_text: String,
  is_featured: Boolean,
  created_at: Date,
  approved: Boolean,
  approved_by: ObjectId, // Reference to admin_users._id
  approved_at: Date
}
```

### 6. tour_requests Collection
```javascript
{
  _id: ObjectId(),
  name: String,
  email: String,
  phone: String,
  preferred_date: Date,
  preferred_time: String,
  number_of_guests: Number,
  message: String,
  created_at: Date,
  status: String, // 'pending', 'confirmed', 'completed', 'cancelled'
  confirmed_date: Date,
  confirmed_time: String,
  assigned_to: ObjectId, // Reference to admin_users._id
  notes: String
}
```

### 7. activity_log Collection
```javascript
{
  _id: ObjectId(),
  user_id: ObjectId, // Reference to admin_users._id
  action: String,
  table_name: String,
  record_id: ObjectId,
  description: String,
  ip_address: String,
  created_at: Date
}
```

### 8. medications Collection
```javascript
{
  _id: ObjectId(),
  resident_id: ObjectId, // Reference to residents._id
  medication_name: String,
  dosage: String,
  frequency: String,
  prescribing_doctor: String,
  start_date: Date,
  end_date: Date,
  instructions: String,
  is_active: Boolean,
  created_at: Date,
  updated_at: Date
}
```

### 9. care_plans Collection
```javascript
{
  _id: ObjectId(),
  resident_id: ObjectId, // Reference to residents._id
  plan_type: String,
  description: String,
  goals: String,
  created_by: ObjectId, // Reference to admin_users._id
  created_at: Date,
  updated_at: Date,
  review_date: Date
}
```

## Indexes to Create

For optimal performance, create these indexes:

```javascript
// admin_users
db.admin_users.createIndex({ "username": 1 }, { unique: true })
db.admin_users.createIndex({ "email": 1 })

// residents
db.residents.createIndex({ "status": 1 })
db.residents.createIndex({ "care_level": 1 })
db.residents.createIndex({ "room_number": 1 })

// contact_inquiries
db.contact_inquiries.createIndex({ "status": 1 })
db.contact_inquiries.createIndex({ "created_at": -1 })

// testimonials
db.testimonials.createIndex({ "approved": 1 })
db.testimonials.createIndex({ "is_featured": 1 })

// tour_requests
db.tour_requests.createIndex({ "status": 1 })
db.tour_requests.createIndex({ "preferred_date": 1 })

// medications
db.medications.createIndex({ "resident_id": 1 })
db.medications.createIndex({ "is_active": 1 })

// care_plans
db.care_plans.createIndex({ "resident_id": 1 })
```

## Key Differences from MySQL

1. **Auto-increment IDs**: MongoDB uses ObjectId instead of auto-incrementing integers
2. **Foreign Keys**: Referenced as ObjectId values instead of INT
3. **ENUM types**: Stored as regular strings with application-level validation
4. **Nested Objects**: Emergency contact info is embedded in residents document
5. **Timestamps**: Managed by application code or MongoDB's timestamps option

## Relationship Handling

- **One-to-Many**: Use ObjectId references (e.g., contact_inquiries.assigned_to → admin_users._id)
- **Embedding vs Referencing**: We use referencing for all relationships to maintain flexibility
- **Lookups**: Use `$lookup` aggregation for joins when needed in queries
