# 🔧 WordPress API & CRUD Logic Explanation

## 📋 Overview: WordPress vs Laravel

Coming from Laravel, you'll find WordPress API structure quite different. Here's how it works:

### **Laravel vs WordPress Comparison**

| **Aspect** | **Laravel** | **WordPress** |
|------------|-------------|---------------|
| **API Routes** | `routes/api.php` | `register_rest_route()` in PHP files |
| **Controllers** | `app/Http/Controllers/` | Functions in service files |
| **Models** | Eloquent Models | Direct `$wpdb` queries |
| **Validation** | Form Requests | Manual validation in functions |
| **Middleware** | Middleware classes | `permission_callback` functions |
| **Database** | Eloquent ORM | Raw SQL with `$wpdb` |

---

## 🏗️ **WordPress API Architecture**

### **1. API Registration Pattern**

```php
// In any PHP file (usually includes/api-*.php)
add_action('rest_api_init', function () {
    register_rest_route('namespace/v1', '/endpoint', [
        'methods' => 'GET|POST|PUT|DELETE',
        'callback' => 'function_name',
        'permission_callback' => function() {
            return is_user_logged_in();
        },
        'args' => [
            'param' => ['required' => true, 'type' => 'string']
        ]
    ]);
});
```

#### **🤔 WHAT & WHY: API Registration Pattern Explained**

**What is this?**
This is how WordPress creates API endpoints (URLs that your frontend can call to get/send data). Think of it like creating a "phone number" that your JavaScript can call to talk to your database.

**Why does WordPress work this way?**
- **WordPress is a Plugin System**: Unlike Laravel where you have one main application, WordPress has a core + many plugins
- **Hooks are Everything**: WordPress uses "hooks" - special moments when plugins can add their own code
- **No Central Route File**: Instead of one `routes/api.php` file, each plugin registers its own routes

**Let's break it down line by line:**

```php
add_action('rest_api_init', function () {
```
**What this does:**
- `add_action()` = "Hey WordPress, when this happens, run my code"
- `'rest_api_init'` = "When WordPress is setting up its REST API system"
- `function () { ... }` = "Run this code"

**Why this timing?**
- WordPress loads in phases: core → themes → plugins
- `rest_api_init` happens AFTER all plugins are loaded
- This ensures your routes are registered at the right time

```php
register_rest_route('namespace/v1', '/endpoint', [
```
**What this does:**
- Creates a new API endpoint
- `'namespace/v1'` = The "area" your API lives in (like a folder)
- `'/endpoint'` = The specific URL path

**Why use namespaces?**
- **Organization**: Keeps your API separate from other plugins
- **Versioning**: You can have `/v1/` and `/v2/` for different versions
- **No Conflicts**: Multiple plugins can have `/users` endpoint without fighting

**Real example:**
```php
register_rest_route('plateforme-recherche/v1', '/contact', [
```
This creates: `https://yoursite.com/wp-json/plateforme-recherche/v1/contact`

```php
'methods' => 'GET|POST|PUT|DELETE',
```
**What this does:**
- Tells WordPress which HTTP methods this endpoint accepts
- `GET` = Read data
- `POST` = Create new data
- `PUT` = Update existing data
- `DELETE` = Remove data

**Why specify methods?**
- **Security**: Only allow the operations you want
- **Clarity**: Makes it clear what each endpoint does
- **REST Standards**: Follows web API best practices

```php
'callback' => 'function_name',
```
**What this does:**
- Tells WordPress which function to run when someone calls this endpoint
- When someone visits `/contact`, WordPress runs `function_name()`

**Why use function names?**
- **Separation**: Keep route registration separate from business logic
- **Reusability**: Same function can be used by multiple routes
- **Testing**: Easy to test functions independently

```php
'permission_callback' => function() {
    return is_user_logged_in();
},
```
**What this does:**
- Runs a security check before allowing access
- `is_user_logged_in()` = "Is the user logged in?"
- If `true`, allow access. If `false`, block access.

**Why check permissions?**
- **Security**: Prevent unauthorized access to your data
- **WordPress Standard**: All WordPress functions check permissions
- **Flexibility**: You can write custom permission logic

**Example of custom permissions:**
```php
'permission_callback' => function() {
    return current_user_can('edit_posts'); // Only editors can access
},
```

```php
'args' => [
    'param' => ['required' => true, 'type' => 'string']
]
```
**What this does:**
- Validates incoming data
- `'param'` = The parameter name
- `'required' => true` = This parameter must be provided
- `'type' => 'string'` = This parameter must be text

**Why validate arguments?**
- **Data Safety**: Ensure data is in the right format
- **Error Prevention**: Catch problems before they reach your function
- **Documentation**: Makes it clear what the endpoint expects

**Real example:**
```php
'args' => [
    'search' => ['required' => false, 'type' => 'string'],
    'page' => ['required' => false, 'type' => 'integer', 'minimum' => 1]
]
```

**Complete Real Example:**
```php
add_action('rest_api_init', function () {
    register_rest_route('plateforme-recherche/v1', '/contact', [
        'methods' => 'GET',
        'callback' => 'svc_contact_list',
        'permission_callback' => function() {
            return is_user_logged_in();
        },
        'args' => [
            'search' => ['required' => false, 'type' => 'string'],
            'page' => ['required' => false, 'type' => 'integer', 'minimum' => 1],
            'per_page' => ['required' => false, 'type' => 'integer', 'minimum' => 1, 'maximum' => 100]
        ]
    ]);
});
```

**What this creates:**
- URL: `GET /wp-json/plateforme-recherche/v1/contact`
- Function: `svc_contact_list()`
- Security: Must be logged in
- Parameters: Optional search, page, per_page

**How to call it from JavaScript:**
```javascript
fetch('/wp-json/plateforme-recherche/v1/contact?search=university&page=1&per_page=25')
```

### **2. Service Layer Pattern**

```php
// services/services-contact.php
function svc_contact_create(WP_REST_Request $req) {
    global $wpdb;
    
    // 1. Get data from request
    $data = $req->get_json_params();
    
    // 2. Validate & sanitize
    $allowed = svc_contact_allowed_fields();
    $sanitized = [];
    foreach($allowed as $key => $type) {
        $sanitized[$key] = svc_contact_sanitize($key, $data[$key], $type);
    }
    
    // 3. Database operation
    $result = $wpdb->insert($table, $sanitized, $formats);
    
    // 4. Return response
    return $result ? $wpdb->get_row(...) : new WP_Error(...);
}
```

#### **🤔 WHAT & WHY: Service Layer Pattern Explained**

**What is this?**
This is the "business logic" layer - the functions that actually do the work when someone calls your API. Think of it like the "kitchen" in a restaurant: the API route is the "waiter" who takes the order, and the service function is the "chef" who actually makes the food.

**Why does WordPress use this pattern?**
- **Separation of Concerns**: Routes handle HTTP stuff, services handle business logic
- **Reusability**: Same service function can be used by multiple routes
- **Testing**: Easy to test business logic without HTTP complications
- **Maintainability**: All your database logic is in one place

**Let's break it down line by line:**

```php
function svc_contact_create(WP_REST_Request $req) {
```
**What this does:**
- Creates a function that handles creating new contacts
- `svc_` = "service" (naming convention)
- `WP_REST_Request $req` = The request object containing all the data

**Why this naming?**
- **Convention**: `svc_` tells you this is a service function
- **Clarity**: `contact_create` clearly shows what it does
- **Organization**: Easy to find all contact-related functions

**What is `WP_REST_Request`?**
- It's a WordPress class that wraps the HTTP request
- Contains all the data sent from the frontend
- Has methods to get parameters, headers, body, etc.

```php
global $wpdb;
```
**What this does:**
- Gives you access to WordPress's database object
- `$wpdb` = WordPress Database (the "WPDB" class)

**Why use `global`?**
- **WordPress Pattern**: This is how WordPress works
- **Database Access**: `$wpdb` is the only way to access the database
- **Prepared Statements**: `$wpdb` handles SQL injection protection

**What can you do with `$wpdb`?**
```php
$wpdb->get_results($sql);     // Get multiple rows
$wpdb->get_row($sql);         // Get one row
$wpdb->get_var($sql);         // Get one value
$wpdb->insert($table, $data); // Insert new record
$wpdb->update($table, $data, $where); // Update record
$wpdb->delete($table, $where); // Delete record
```

```php
// 1. Get data from request
$data = $req->get_json_params();
```
**What this does:**
- Gets the JSON data sent from the frontend
- `get_json_params()` = "Give me the JSON body of the request"

**Why get JSON data?**
- **Modern API**: Most APIs use JSON for data exchange
- **Structured Data**: JSON can handle complex data structures
- **Frontend Friendly**: JavaScript easily creates JSON

**What does the data look like?**
```javascript
// From JavaScript:
fetch('/api/contact', {
    method: 'POST',
    body: JSON.stringify({
        institution: 'University of Tunis',
        contact_nom: 'Dr. Ahmed',
        contact_email: 'ahmed@university.tn'
    })
});

// In PHP, $data becomes:
[
    'institution' => 'University of Tunis',
    'contact_nom' => 'Dr. Ahmed',
    'contact_email' => 'ahmed@university.tn'
]
```

```php
// 2. Validate & sanitize
$allowed = svc_contact_allowed_fields();
$sanitized = [];
foreach($allowed as $key => $type) {
    $sanitized[$key] = svc_contact_sanitize($key, $data[$key], $type);
}
```
**What this does:**
- **Security Check**: Only allow certain fields to be saved
- **Data Cleaning**: Remove dangerous characters and validate data types
- **Prevent Attacks**: Stop SQL injection and XSS attacks

**Why validate and sanitize?**
- **Security**: Prevent malicious code from being saved
- **Data Integrity**: Ensure data is in the correct format
- **WordPress Standard**: All WordPress functions sanitize input

**What does `svc_contact_allowed_fields()` return?**
```php
function svc_contact_allowed_fields() {
    return [
        'institution' => 'text',
        'contact_nom' => 'text',
        'contact_email' => 'email',
        'contact_tel' => 'text',
        'laboratoire_id' => 'int'
    ];
}
```

**What does `svc_contact_sanitize()` do?**
```php
function svc_contact_sanitize($key, $value, $type) {
    switch ($type) {
        case 'int':
            return is_numeric($value) ? intval($value) : null;
        case 'email':
            return is_email($value) ? sanitize_email($value) : null;
        case 'text':
        default:
            return sanitize_text_field($value);
    }
}
```

**Real example:**
```php
// Input data (potentially dangerous):
$data = [
    'institution' => 'University<script>alert("hack")</script>',
    'contact_email' => 'ahmed@university.tn',
    'malicious_field' => 'DROP TABLE users;'
];

// After sanitization:
$sanitized = [
    'institution' => 'University',  // Script tags removed
    'contact_email' => 'ahmed@university.tn',  // Valid email
    // 'malicious_field' is not in $allowed, so it's ignored
];
```

```php
// 3. Database operation
$result = $wpdb->insert($table, $sanitized, $formats);
```
**What this does:**
- Saves the sanitized data to the database
- `$table` = The table name (e.g., 'utm_contacts')
- `$sanitized` = The clean data to insert
- `$formats` = Data types for each field

**Why use `$wpdb->insert()`?**
- **SQL Injection Protection**: Automatically escapes data
- **WordPress Standard**: This is how WordPress does database operations
- **Error Handling**: Returns false if something goes wrong

**What are `$formats`?**
```php
$formats = ['%s', '%s', '%s', '%d'];  // string, string, string, integer
// This tells WordPress: "treat field 1 as string, field 2 as string, etc."
```

```php
// 4. Return response
return $result ? $wpdb->get_row(...) : new WP_Error(...);
```
**What this does:**
- **Success**: If insert worked, return the new record
- **Error**: If insert failed, return an error message

**Why return different things?**
- **Success Response**: Frontend gets the new data to display
- **Error Response**: Frontend knows something went wrong and can show an error message

**What does `WP_Error` look like?**
```php
new WP_Error('db_error', 'Failed to create contact', ['status' => 500]);
// This becomes an HTTP 500 error with the message "Failed to create contact"
```

**Complete Real Example:**
```php
function svc_contact_create(WP_REST_Request $req) {
    global $wpdb;
    $table = $wpdb->prefix . 'contacts'; // 'utm_contacts'
    
    // 1. Get data
    $data = $req->get_json_params();
    
    // 2. Define allowed fields
    $allowed = [
        'institution' => 'text',
        'contact_nom' => 'text',
        'contact_email' => 'email',
        'laboratoire_id' => 'int'
    ];
    
    // 3. Sanitize data
    $sanitized = [];
    $formats = [];
    foreach($allowed as $key => $type) {
        if (!isset($data[$key])) continue;
        
        $value = svc_contact_sanitize($key, $data[$key], $type);
        if ($value !== null) {
            $sanitized[$key] = $value;
            $formats[] = ($type === 'int') ? '%d' : '%s';
        }
    }
    
    // 4. Add required fields
    $sanitized['created_at'] = current_time('mysql');
    $sanitized['created_by'] = get_current_user_id();
    $formats[] = '%s';
    $formats[] = '%d';
    
    // 5. Insert to database
    $result = $wpdb->insert($table, $sanitized, $formats);
    
    // 6. Return response
    if ($result) {
        $id = $wpdb->insert_id;
        return $wpdb->get_row($wpdb->prepare("SELECT * FROM {$table} WHERE id=%d", $id), ARRAY_A);
    } else {
        return new WP_Error('db_error', 'Insert failed: ' . $wpdb->last_error, ['status' => 500]);
    }
}
```

**What this function does step by step:**
1. **Gets the request data** from the frontend
2. **Defines what fields are allowed** to be saved
3. **Cleans and validates** each field
4. **Adds system fields** like creation date and user
5. **Saves to database** using WordPress's safe method
6. **Returns success or error** to the frontend

**How the frontend calls it:**
```javascript
// Frontend JavaScript
const response = await fetch('/wp-json/plateforme-recherche/v1/contact', {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify({
        institution: 'University of Tunis',
        contact_nom: 'Dr. Ahmed',
        contact_email: 'ahmed@university.tn',
        laboratoire_id: 1
    })
});

const result = await response.json();
// result = the new contact data or an error message
```

---

## 🔄 **CRUD Operations Breakdown**

#### **🤔 WHAT & WHY: CRUD Operations Explained**

**What is CRUD?**
CRUD stands for **C**reate, **R**ead, **U**pdate, **D**elete - the four basic operations you can do with data. Every web application needs these operations to manage data.

**Why do we need CRUD?**
- **Complete Data Management**: You need to create, view, edit, and delete records
- **User Interface**: Each operation corresponds to what users want to do
- **Database Operations**: These map directly to SQL operations (INSERT, SELECT, UPDATE, DELETE)
- **API Standards**: Most web APIs follow CRUD patterns

**How CRUD maps to HTTP methods:**
- **CREATE** = `POST` (create new record)
- **READ** = `GET` (get existing records)
- **UPDATE** = `PUT` or `PATCH` (modify existing record)
- **DELETE** = `DELETE` (remove record)

### **📖 READ (GET) Operations**

#### **🤔 WHAT & WHY: READ Operations Explained**

**What are READ operations?**
These are functions that retrieve data from the database and send it to the frontend. Think of it like "asking the database for information."

**Why do we need different types of READ operations?**
- **List All Records**: Show a table with many records (with pagination)
- **Get Single Record**: Show details of one specific record
- **Search Records**: Find records that match certain criteria

#### **1. List All Records**
```php
// API Route: GET /wp-json/plateforme-recherche/v1/contact
function svc_contact_list(WP_REST_Request $req) {
    global $wpdb;
    
    // Pagination
    $page = max(1, intval($req->get_param('page') ?: 1));
    $per_page = max(1, min(200, intval($req->get_param('per_page') ?: 50)));
    $offset = ($page - 1) * $per_page;
    
    // Search
    $where = ["laboratoire_id IN (1,2,3)"]; // User's labs
    if ($search = $req->get_param('search')) {
        $where[] = "(institution LIKE %s OR contact_nom LIKE %s)";
        $params[] = '%' . $wpdb->esc_like($search) . '%';
    }
    
    // Query
    $sql = "SELECT * FROM {$table} WHERE " . implode(' AND ', $where) . 
           " ORDER BY id DESC LIMIT %d OFFSET %d";
    $params[] = $per_page;
    $params[] = $offset;
    
    return $wpdb->get_results($wpdb->prepare($sql, ...$params), ARRAY_A);
}
```

**What this function does:**
- **Gets a list of contacts** from the database
- **Handles pagination** (showing 50 records per page, for example)
- **Handles search** (find contacts by name or institution)
- **Filters by user's laboratories** (security - only show user's data)

**Why do we need pagination?**
- **Performance**: Loading 10,000 records at once would be slow
- **User Experience**: Users can't see 10,000 records on one page
- **Memory**: Prevents the server from running out of memory
- **Network**: Smaller responses load faster

**How pagination works:**
```php
$page = 1;        // User wants page 1
$per_page = 50;   // Show 50 records per page
$offset = 0;      // Start from record 0

// Page 2 would be:
$page = 2;        // User wants page 2
$per_page = 50;   // Show 50 records per page
$offset = 50;     // Start from record 50 (skip first 50)
```

**Why do we need search?**
- **User Experience**: Users need to find specific records quickly
- **Data Discovery**: With thousands of records, search is essential
- **Efficiency**: Better than scrolling through pages

**How search works:**
```php
// User searches for "university"
$search = "university";

// We search in multiple fields
$where[] = "(institution LIKE %s OR contact_nom LIKE %s)";
$params[] = '%university%';  // institution LIKE '%university%'
$params[] = '%university%';  // contact_nom LIKE '%university%'
```

**Why filter by laboratories?**
- **Security**: Users should only see their own data
- **Multi-tenant**: Each laboratory is like a separate organization
- **Data Isolation**: Prevents data leakage between different groups

#### **2. Get Single Record**
```php
// API Route: GET /wp-json/plateforme-recherche/v1/contact/{id}
function svc_contact_get(WP_REST_Request $req) {
    global $wpdb;
    $id = intval($req['id']);
    
    // Check permissions
    $lab_ids = svc_contact_current_user_lab_ids();
    if (empty($lab_ids)) return new WP_Error('forbidden', 'Access denied', ['status' => 403]);
    
    // Get record
    $row = $wpdb->get_row($wpdb->prepare("SELECT * FROM {$table} WHERE id=%d", $id), ARRAY_A);
    
    // Verify ownership
    if (!in_array($row['laboratoire_id'], $lab_ids)) {
        return new WP_Error('forbidden', 'Not your lab', ['status' => 403]);
    }
    
    return $row;
}
```

### **➕ CREATE (POST) Operations**

```php
// API Route: POST /wp-json/plateforme-recherche/v1/contact
function svc_contact_create(WP_REST_Request $req) {
    global $wpdb;
    
    // 1. Get data
    $data = $req->get_json_params() ?: $req->get_params();
    
    // 2. Handle file uploads (base64 images)
    if (!empty($data['logo_url']) && strpos($data['logo_url'], 'data:image') === 0) {
        $data['logo_url'] = svc_contact_store_dataurl_local($data['logo_url'], 'org-logo');
    }
    
    // 3. Sanitize data
    $allowed = svc_contact_allowed_fields();
    $insert_data = [];
    $formats = [];
    
    foreach($allowed as $key => $type) {
        if (!isset($data[$key])) continue;
        
        $value = svc_contact_sanitize($key, $data[$key], $type);
        if ($value !== null && $value !== '') {
            $insert_data[$key] = $value;
            $formats[] = ($type === 'int') ? '%d' : '%s';
        }
    }
    
    // 4. Add audit fields
    $insert_data['created_by'] = get_current_user_id();
    $insert_data['created_at'] = current_time('mysql');
    $formats[] = '%d';
    $formats[] = '%s';
    
    // 5. Insert
    $result = $wpdb->insert($table, $insert_data, $formats);
    
    if (!$result) {
        return new WP_Error('db_error', 'Insert failed: ' . $wpdb->last_error, ['status' => 500]);
    }
    
    // 6. Return created record
    $id = $wpdb->insert_id;
    return $wpdb->get_row($wpdb->prepare("SELECT * FROM {$table} WHERE id=%d", $id), ARRAY_A);
}
```

### **✏️ UPDATE (PUT/PATCH) Operations**

```php
// API Route: PUT /wp-json/plateforme-recherche/v1/contact/{id}
function svc_contact_update(WP_REST_Request $req) {
    global $wpdb;
    $id = intval($req['id']);
    
    // 1. Check if record exists and user has permission
    $current = $wpdb->get_row($wpdb->prepare("SELECT * FROM {$table} WHERE id=%d", $id), ARRAY_A);
    if (!$current) return new WP_Error('not_found', 'Record not found', ['status' => 404]);
    
    $lab_ids = svc_contact_current_user_lab_ids();
    if (!in_array($current['laboratoire_id'], $lab_ids)) {
        return new WP_Error('forbidden', 'Not your lab', ['status' => 403]);
    }
    
    // 2. Get and sanitize update data
    $data = $req->get_json_params() ?: $req->get_params();
    $allowed = svc_contact_allowed_fields();
    $update_data = [];
    $formats = [];
    
    foreach($allowed as $key => $type) {
        if (!isset($data[$key])) continue;
        
        $value = svc_contact_sanitize($key, $data[$key], $type);
        if ($value !== null) {
            $update_data[$key] = $value;
            $formats[] = ($type === 'int') ? '%d' : '%s';
        }
    }
    
    // 3. Add audit fields
    $update_data['updated_by'] = get_current_user_id();
    $update_data['updated_at'] = current_time('mysql');
    $formats[] = '%d';
    $formats[] = '%s';
    
    // 4. Update
    $result = $wpdb->update($table, $update_data, ['id' => $id], $formats, ['%d']);
    
    if ($result === false) {
        return new WP_Error('db_error', 'Update failed: ' . $wpdb->last_error, ['status' => 500]);
    }
    
    // 5. Return updated record
    return $wpdb->get_row($wpdb->prepare("SELECT * FROM {$table} WHERE id=%d", $id), ARRAY_A);
}
```

### **🗑️ DELETE Operations**

```php
// API Route: DELETE /wp-json/plateforme-recherche/v1/contact/{id}
function svc_contact_delete(WP_REST_Request $req) {
    global $wpdb;
    $id = intval($req['id']);
    
    // 1. Check if record exists and user has permission
    $current = $wpdb->get_row($wpdb->prepare("SELECT * FROM {$table} WHERE id=%d", $id), ARRAY_A);
    if (!$current) return new WP_Error('not_found', 'Record not found', ['status' => 404]);
    
    $lab_ids = svc_contact_current_user_lab_ids();
    if (!in_array($current['laboratoire_id'], $lab_ids)) {
        return new WP_Error('forbidden', 'Not your lab', ['status' => 403]);
    }
    
    // 2. Delete
    $result = $wpdb->delete($table, ['id' => $id], ['%d']);
    
    if ($result === false) {
        return new WP_Error('db_error', 'Delete failed: ' . $wpdb->last_error, ['status' => 500]);
    }
    
    // 3. Return success (WordPress REST API expects 204 for DELETE)
    return new WP_REST_Response(null, 204);
}
```

---

## 🌐 **Frontend JavaScript API Calls**

#### **🤔 WHAT & WHY: Frontend JavaScript API Calls Explained**

**What are Frontend JavaScript API Calls?**
These are the JavaScript functions that communicate with your WordPress backend. Think of them as the "messenger" between your webpage and your database.

**Why do we need JavaScript for API calls?**
- **Dynamic Updates**: Update the page without refreshing (better user experience)
- **Real-time Data**: Get fresh data from the server
- **User Interactions**: Handle button clicks, form submissions, etc.
- **Modern Web**: Users expect responsive, interactive websites

**How does the flow work?**
1. **User clicks a button** (like "Add Contact")
2. **JavaScript collects the data** from the form
3. **JavaScript sends a request** to the WordPress API
4. **WordPress processes the request** and returns data
5. **JavaScript updates the page** with the new data

### **Configuration**
```javascript
// In contact-pmo.php
const REST_ROOT = window.wpApiSettings?.root || '/wp-json/';
const NONCE = window.wpApiSettings?.nonce || '';
const API = REST_ROOT.replace(/\/$/, '') + '/plateforme-recherche/v1';
```

**What this configuration does:**
- **Sets up the base URL** for all API calls
- **Gets security tokens** from WordPress
- **Creates a consistent API endpoint** for your plugin

**Why do we need this configuration?**
- **Consistency**: All API calls use the same base URL
- **Security**: WordPress provides nonce tokens for security
- **Flexibility**: Works on different WordPress installations
- **Maintainability**: Change the API URL in one place

**What is `window.wpApiSettings`?**
- **WordPress provides this**: Automatically available in WordPress pages
- **Contains API settings**: Base URL, nonce, user info, etc.
- **Security**: Includes the nonce needed for authenticated requests

**What is a nonce?**
- **Security token**: Prevents CSRF (Cross-Site Request Forgery) attacks
- **WordPress standard**: All WordPress forms and API calls use nonces
- **Time-limited**: Expires after a certain time for security

### **API Call Examples**

#### **1. GET (List)**
```javascript
async function loadContacts() {
    try {
        const response = await fetch(`${API}/contact?page=1&per_page=50&search=`, {
            method: 'GET',
            headers: {
                'X-WP-Nonce': NONCE
            },
            credentials: 'same-origin'
        });
        
        if (!response.ok) throw new Error('Failed to load contacts');
        
        const contacts = await response.json();
        renderContacts(contacts);
    } catch (error) {
        console.error('Error loading contacts:', error);
    }
}
```

#### **2. POST (Create)**
```javascript
async function createContact(contactData) {
    try {
        const response = await fetch(`${API}/contact`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-WP-Nonce': NONCE
            },
            credentials: 'same-origin',
            body: JSON.stringify(contactData)
        });
        
        if (!response.ok) {
            const error = await response.json();
            throw new Error(error.message || 'Failed to create contact');
        }
        
        const newContact = await response.json();
        addContactToTable(newContact);
    } catch (error) {
        console.error('Error creating contact:', error);
        alert('Error: ' + error.message);
    }
}
```

#### **3. PUT (Update)**
```javascript
async function updateContact(id, contactData) {
    try {
        const response = await fetch(`${API}/contact/${id}`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'X-WP-Nonce': NONCE
            },
            credentials: 'same-origin',
            body: JSON.stringify(contactData)
        });
        
        if (!response.ok) {
            const error = await response.json();
            throw new Error(error.message || 'Failed to update contact');
        }
        
        const updatedContact = await response.json();
        updateContactInTable(updatedContact);
    } catch (error) {
        console.error('Error updating contact:', error);
        alert('Error: ' + error.message);
    }
}
```

#### **4. DELETE**
```javascript
async function deleteContact(id) {
    if (!confirm('Are you sure you want to delete this contact?')) return;
    
    try {
        const response = await fetch(`${API}/contact/${id}`, {
            method: 'DELETE',
            headers: {
                'X-WP-Nonce': NONCE
            },
            credentials: 'same-origin'
        });
        
        if (!response.ok) {
            const error = await response.json();
            throw new Error(error.message || 'Failed to delete contact');
        }
        
        removeContactFromTable(id);
    } catch (error) {
        console.error('Error deleting contact:', error);
        alert('Error: ' + error.message);
    }
}
```

---

 

### **1. Nonce Verification**
```php
// In API route registration
'permission_callback' => function () {
    $nonce = $_SERVER['HTTP_X_WP_NONCE'] ?? '';
    return wp_verify_nonce($nonce, 'wp_rest');
}
```

### **2. User Role Checking**
```php
// Check if user is logged in
if (!is_user_logged_in()) {
    return new WP_Error('unauthorized', 'Must be logged in', ['status' => 401]);
}

// Check specific roles
$user = wp_get_current_user();
if (!in_array('um_pmo', $user->roles)) {
    return new WP_Error('forbidden', 'Insufficient permissions', ['status' => 403]);
}
```

### **3. Data Sanitization**
```php
function svc_contact_sanitize($key, $value, $type) {
    switch ($type) {
        case 'int':
            return is_numeric($value) ? intval($value) : null;
        case 'email':
            return is_email($value) ? sanitize_email($value) : null;
        case 'url':
            return esc_url_raw($value);
        case 'text':
        default:
            return is_scalar($value) ? sanitize_text_field($value) : null;
    }
}
```

---

## 📊 **Database Schema Pattern - Real Examples from Your Database**

#### **🤔 WHAT & WHY: Database Schema Explained**

**What is a database schema?**
A database schema is the "blueprint" of your database - it defines what tables exist, what columns each table has, and how they relate to each other. Think of it like the floor plan of a building.

**Why do we need a well-designed schema?**
- **Data Organization**: Keeps related data together
- **Performance**: Proper indexes make queries fast
- **Data Integrity**: Prevents invalid data from being saved
- **Relationships**: Shows how different pieces of data connect
- **Security**: Proper structure helps with access control

**What makes a good database design?**
- **Normalization**: Avoid duplicate data
- **Primary Keys**: Every table needs a unique identifier
- **Foreign Keys**: Connect related tables
- **Indexes**: Make searches fast
- **Data Types**: Use appropriate types for each field

### **1. Contacts Table (utm_contacts)**
```sql
CREATE TABLE IF NOT EXISTS `utm_contacts` (
  `id` int NOT NULL AUTO_INCREMENT,
  `laboratoire_id` int unsigned NOT NULL,
  `institution` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `domaine` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `contact_nom` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `contact_email` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `contact_tel` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `org_email` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `org_tel` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `website` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `logo_url` text COLLATE utf8mb4_general_ci,
  `contact_avatar_url` text COLLATE utf8mb4_general_ci,
  `created_by` bigint unsigned DEFAULT NULL,
  `updated_by` bigint unsigned DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
```

**What this table stores:**
- **Contact information** for research partners and collaborators
- **Organization details** like institution name and website
- **Personal details** like contact person's name and email
- **Images** like logos and avatars
- **Audit information** like who created/updated the record

**Why these specific fields?**

**Primary Key:**
```sql
`id` int NOT NULL AUTO_INCREMENT,
PRIMARY KEY (`id`)
```
- **What it does**: Creates a unique number for each contact (1, 2, 3, etc.)
- **Why we need it**: Every record needs a unique identifier
- **AUTO_INCREMENT**: Automatically assigns the next available number

**Laboratory Relationship:**
```sql
`laboratoire_id` int unsigned NOT NULL,
```
- **What it does**: Links each contact to a specific laboratory
- **Why we need it**: Security - users only see contacts from their lab
- **NOT NULL**: Every contact must belong to a laboratory

**Contact Information:**
```sql
`institution` varchar(255) NOT NULL,
`contact_nom` varchar(255) NOT NULL,
```
- **What it does**: Stores the organization name and contact person's name
- **Why NOT NULL**: These are required fields - every contact must have them
- **varchar(255)**: Text field that can hold up to 255 characters

**Optional Contact Details:**
```sql
`contact_email` varchar(255) DEFAULT NULL,
`contact_tel` varchar(100) DEFAULT NULL,
```
- **What it does**: Stores email and phone number
- **Why DEFAULT NULL**: These are optional - contacts might not have them
- **Different sizes**: Email can be longer than phone numbers

**Image Storage:**
```sql
`logo_url` text,
`contact_avatar_url` text,
```
- **What it does**: Stores URLs to image files
- **Why TEXT**: URLs can be very long, especially for base64 images
- **Why separate fields**: Organization logo vs personal avatar

**Audit Trail:**
```sql
`created_by` bigint unsigned DEFAULT NULL,
`updated_by` bigint unsigned DEFAULT NULL,
`created_at` datetime DEFAULT NULL,
`updated_at` datetime DEFAULT NULL,
```
- **What it does**: Tracks who created/updated the record and when
- **Why we need it**: Compliance, debugging, and accountability
- **bigint unsigned**: Can store large user IDs

### **2. Research Networks Table (utm_recherche_reseaux)**
```sql
CREATE TABLE IF NOT EXISTS `utm_recherche_reseaux` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `laboratoire_id` bigint unsigned NOT NULL,
  `institution` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `pays` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `type_collab` varchar(150) COLLATE utf8mb4_general_ci NOT NULL,
  `contact_nom` varchar(180) COLLATE utf8mb4_general_ci NOT NULL,
  `contact_email` varchar(180) COLLATE utf8mb4_general_ci NOT NULL,
  `contact_tel` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `date_debut` date NOT NULL,
  `date_fin` date DEFAULT NULL,
  `convention_signee` tinyint(1) NOT NULL DEFAULT '0',
  `statut` enum('Actif','Occasionnel','En cours','Clos') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'Actif',
  `piece_jointe_id` bigint unsigned DEFAULT NULL,
  `piece_jointe_path` varchar(512) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `projets_associes` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `created_by` bigint unsigned NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  `site_web` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `adresse_org` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `logo_url` text COLLATE utf8mb4_general_ci,
  `avatar_url` text COLLATE utf8mb4_general_ci DEFAULT (NULL),
  `contact_fonction` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `utm_recherche_reseaux_chk_1` CHECK (json_valid(`projets_associes`))
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
```

### **3. Research Laboratory Table (utm_recherche_laboratoire)**
```sql
CREATE TABLE IF NOT EXISTS `utm_recherche_laboratoire` (
  `id` bigint NOT NULL,
  `logo_id` bigint DEFAULT NULL,
  `logo_url` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `denomination` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `code_lr` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `etablissement_id` bigint DEFAULT NULL,
  `etablissement_label` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `date_creation` date DEFAULT NULL,
  `directeur_nom` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `directeur_email` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `directeur_user_id` bigint DEFAULT NULL,
  `statut` enum('Actif','Inactif','Suspendu') COLLATE utf8mb4_general_ci DEFAULT 'Actif',
  `objectif_general` mediumtext COLLATE utf8mb4_general_ci,
  `axes_recherche` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `site_web` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `telephone` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email_contact` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `domaine` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` bigint DEFAULT NULL,
  `updated_by` bigint DEFAULT NULL,
  `meta_json` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  CONSTRAINT `utm_recherche_laboratoire_chk_1` CHECK (json_valid(`axes_recherche`)),
  CONSTRAINT `utm_recherche_laboratoire_chk_2` CHECK (json_valid(`meta_json`))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
```

---

## 🚀 **Key Differences from Laravel**

#### **🤔 WHAT & WHY: Key Differences from Laravel Explained**

**Why are there differences?**
- **Different Philosophies**: Laravel is a modern framework, WordPress is a CMS with a plugin system
- **Different Ages**: Laravel started in 2011, WordPress in 2003
- **Different Purposes**: Laravel is for building applications, WordPress is for websites with plugins
- **Different Communities**: Different developers with different preferences

**What does this mean for you?**
- **Learning Curve**: Coming from Laravel, you'll need to adapt to WordPress patterns
- **Trade-offs**: WordPress is simpler but less flexible than Laravel
- **Best Practices**: What works in Laravel might not work in WordPress

### **1. No Eloquent ORM**
- **Laravel**: `User::find(1)` or `User::where('email', $email)->first()`
- **WordPress**: `$wpdb->get_row($wpdb->prepare("SELECT * FROM users WHERE id=%d", 1))`

**What this means:**
- **Laravel**: Uses an Object-Relational Mapping (ORM) that makes database operations look like object methods
- **WordPress**: Uses direct SQL queries with prepared statements

**Why the difference?**
- **Laravel Philosophy**: "Make it easy for developers" - ORM is more intuitive
- **WordPress Philosophy**: "Keep it simple" - direct SQL is more transparent
- **Performance**: Direct SQL is faster than ORM
- **Flexibility**: Complex queries are easier in raw SQL

**Example comparison:**
```php
// Laravel (Easy but slower)
$user = User::where('email', $email)->where('active', true)->first();

// WordPress (More verbose but faster)
$user = $wpdb->get_row($wpdb->prepare(
    "SELECT * FROM users WHERE email = %s AND active = %d", 
    $email, 1
));
```

### **2. No Form Requests**
- **Laravel**: `class UserRequest extends FormRequest`
- **WordPress**: Manual validation in service functions

**What this means:**
- **Laravel**: Has dedicated classes for validating form data
- **WordPress**: You write validation code manually in your functions

**Why the difference?**
- **Laravel Philosophy**: "Convention over configuration" - built-in validation classes
- **WordPress Philosophy**: "Keep it simple" - just write the validation you need
- **Flexibility**: WordPress gives you more control over validation logic
- **Learning**: WordPress validation is more straightforward

**Example comparison:**
```php
// Laravel (Automatic validation)
class UserRequest extends FormRequest {
    public function rules() {
        return [
            'email' => 'required|email|unique:users',
            'name' => 'required|string|max:255'
        ];
    }
}

// WordPress (Manual validation)
function svc_user_create($req) {
    $data = $req->get_params();
    
    // Manual validation
    if (empty($data['email']) || !is_email($data['email'])) {
        return new WP_Error('invalid_email', 'Email is required and must be valid');
    }
    
    if (empty($data['name'])) {
        return new WP_Error('invalid_name', 'Name is required');
    }
}
```

### **3. No Middleware**
- **Laravel**: `Route::middleware(['auth', 'role:admin'])`
- **WordPress**: `permission_callback` functions

**What this means:**
- **Laravel**: Has a middleware system that runs code before your controller
- **WordPress**: Uses simple callback functions for permissions

**Why the difference?**
- **Laravel Philosophy**: "Separation of concerns" - middleware handles cross-cutting concerns
- **WordPress Philosophy**: "Keep it simple" - just check permissions in the callback
- **Performance**: WordPress callbacks are faster than middleware
- **Simplicity**: Easier to understand what's happening

**Example comparison:**
```php
// Laravel (Middleware system)
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/users', [UserController::class, 'index']);
});

// WordPress (Permission callbacks)
register_rest_route('api/v1', '/users', [
    'methods' => 'GET',
    'callback' => 'get_users',
    'permission_callback' => function() {
        return current_user_can('manage_options');
    }
]);
```

### **4. No Resource Controllers**
- **Laravel**: `Route::resource('users', UserController::class)`
- **WordPress**: Individual route registrations

**What this means:**
- **Laravel**: One line creates 7 routes (index, show, create, store, edit, update, destroy)
- **WordPress**: You register each route individually

**Why the difference?**
- **Laravel Philosophy**: "Convention over configuration" - standard REST routes
- **WordPress Philosophy**: "Explicit is better than implicit" - you see exactly what routes exist
- **Flexibility**: WordPress lets you customize each route exactly how you want
- **Clarity**: It's obvious what each route does

**Example comparison:**
```php
// Laravel (One line, 7 routes)
Route::resource('users', UserController::class);
// Creates: GET /users, GET /users/{id}, POST /users, PUT /users/{id}, DELETE /users/{id}

// WordPress (Explicit registration)
register_rest_route('api/v1', '/users', ['methods' => 'GET', 'callback' => 'get_users']);
register_rest_route('api/v1', '/users/(?P<id>\d+)', ['methods' => 'GET', 'callback' => 'get_user']);
register_rest_route('api/v1', '/users', ['methods' => 'POST', 'callback' => 'create_user']);
// ... and so on
```

### **5. No API Resources**
- **Laravel**: `UserResource` classes for response formatting
- **WordPress**: Direct array returns or `WP_REST_Response`

**What this means:**
- **Laravel**: Has classes to format API responses consistently
- **WordPress**: You return arrays or use `WP_REST_Response` for special cases

**Why the difference?**
- **Laravel Philosophy**: "Consistency" - all API responses look the same
- **WordPress Philosophy**: "Simplicity" - just return what you need
- **Performance**: Direct arrays are faster than resource classes
- **Flexibility**: You have complete control over the response format

**Example comparison:**
```php
// Laravel (Resource class)
class UserResource extends JsonResource {
    public function toArray($request) {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'created_at' => $this->created_at->format('Y-m-d H:i:s')
        ];
    }
}

// WordPress (Direct array)
function get_user($req) {
    $user = get_user_by('id', $req['id']);
    return [
        'id' => $user->ID,
        'name' => $user->display_name,
        'email' => $user->user_email,
        'created_at' => $user->user_registered
    ];
}
```

---

## 📁 **File Structure**

#### **🤔 WHAT & WHY: File Structure Explained**

**What is file structure?**
File structure is how you organize your code files in folders. It's like organizing a filing cabinet - you put related documents together so you can find them easily.

**Why is file structure important?**
- **Organization**: Easy to find the code you need
- **Maintainability**: Other developers can understand your project
- **Scalability**: Easy to add new features without chaos
- **Team Work**: Multiple developers can work without conflicts
- **Best Practices**: Follows WordPress and industry standards

**What makes a good file structure?**
- **Logical Grouping**: Related files are in the same folder
- **Clear Naming**: File names tell you what they contain
- **Consistent Patterns**: Similar files follow the same naming
- **Separation of Concerns**: Different types of code are separated

```
wp-content/plugins/plateforme-master/
├── includes/
│   ├── api.php                    # Main API routes
│   ├── api-contact.php           # Contact-specific routes
│   └── api-*.php                 # Other entity routes
├── services/
│   ├── services-contact.php      # Contact CRUD logic
│   └── services-*.php            # Other entity services
├── Modules/PMO/components/
│   ├── contact-pmo.php           # Frontend with JavaScript
│   └── *.php                     # Other frontend components
└── plateforme-master.php         # Main plugin file
```

**What each folder contains:**

**`includes/` folder:**
- **What it contains**: API route registrations
- **Why separate**: Keeps route definitions separate from business logic
- **Naming pattern**: `api-{entity}.php` (e.g., `api-contact.php`)
- **Purpose**: Define which URLs exist and what functions they call

**`services/` folder:**
- **What it contains**: Business logic and database operations
- **Why separate**: Keeps database code separate from route definitions
- **Naming pattern**: `services-{entity}.php` (e.g., `services-contact.php`)
- **Purpose**: Handle the actual work (create, read, update, delete)

**`Modules/PMO/components/` folder:**
- **What it contains**: Frontend pages with HTML, CSS, and JavaScript
- **Why separate**: Keeps user interface separate from backend logic
- **Naming pattern**: `{entity}-pmo.php` (e.g., `contact-pmo.php`)
- **Purpose**: What users see and interact with

**`plateforme-master.php`:**
- **What it contains**: Main plugin file that WordPress loads
- **Why separate**: WordPress needs one main file to start the plugin
- **Purpose**: Plugin header, includes other files, sets up hooks

**Why this specific structure?**

**Separation of Concerns:**
- **Routes** (includes/) - Define what URLs exist
- **Logic** (services/) - Handle the actual work
- **Interface** (components/) - What users see
- **Main** (plateforme-master.php) - Ties everything together

**WordPress Standards:**
- **Plugin Structure**: Follows WordPress plugin development standards
- **File Naming**: Uses WordPress naming conventions
- **Hook System**: Uses WordPress hooks to load files

**Scalability:**
- **Easy to Add**: New entities just need new files in each folder
- **Easy to Find**: Know exactly where to look for specific code
- **Easy to Maintain**: Changes to one part don't affect others

---

## 🎯 **Best Practices**

#### **🤔 WHAT & WHY: Best Practices Explained**

**What are best practices?**
Best practices are proven methods and techniques that experienced developers use to write better, more secure, and more maintainable code. They're like "rules of thumb" that help you avoid common mistakes.

**Why follow best practices?**
- **Security**: Prevents common security vulnerabilities
- **Maintainability**: Makes your code easier to understand and modify
- **Performance**: Helps your code run faster and more efficiently
- **Team Work**: Other developers can understand and work with your code
- **WordPress Standards**: Follows WordPress coding standards

**What makes a best practice?**
- **Proven**: Used by many developers and tested over time
- **Secure**: Helps prevent security issues
- **Readable**: Makes code easier to understand
- **Efficient**: Improves performance
- **Standard**: Follows industry or framework standards

### **1. Always Use Prepared Statements**
```php
// ✅ Good
$wpdb->get_row($wpdb->prepare("SELECT * FROM table WHERE id=%d", $id));

// ❌ Bad
$wpdb->get_row("SELECT * FROM table WHERE id=" . $id);
```

**What this does:**
- **Good version**: Uses prepared statements to safely insert user data
- **Bad version**: Directly concatenates user input into SQL

**Why prepared statements are important:**
- **SQL Injection Prevention**: Prevents malicious SQL code from being executed
- **Data Safety**: User input is properly escaped and sanitized
- **WordPress Standard**: All WordPress database operations use prepared statements
- **Performance**: Prepared statements can be faster for repeated queries

**How SQL injection works (and why it's dangerous):**
```php
// If user enters: 1; DROP TABLE users;
// Bad code becomes:
$wpdb->get_row("SELECT * FROM table WHERE id=1; DROP TABLE users;");
// This would delete your entire users table!

// Good code with prepared statements:
$wpdb->get_row($wpdb->prepare("SELECT * FROM table WHERE id=%d", "1; DROP TABLE users;"));
// This safely treats the input as just the number 1
```

### **2. Handle Errors Properly**
```php
$result = $wpdb->insert($table, $data, $formats);
if (!$result) {
    return new WP_Error('db_error', 'Insert failed: ' . $wpdb->last_error, ['status' => 500]);
}
```

**What this does:**
- **Checks if database operation succeeded**
- **Returns proper error message if it failed**
- **Includes HTTP status code for API responses**

**Why error handling is important:**
- **User Experience**: Users get helpful error messages instead of blank pages
- **Debugging**: Developers can see what went wrong
- **Security**: Don't expose sensitive database information
- **Reliability**: Application doesn't crash when something goes wrong

**What happens without error handling:**
```php
// Bad - no error handling
$result = $wpdb->insert($table, $data, $formats);
return $result; // Returns false if failed, but user doesn't know why

// Good - proper error handling
$result = $wpdb->insert($table, $data, $formats);
if (!$result) {
    return new WP_Error('db_error', 'Insert failed: ' . $wpdb->last_error, ['status' => 500]);
}
return $result; // Only returns success
```

### **3. Use Proper HTTP Status Codes**
```php
return new WP_Error('not_found', 'Record not found', ['status' => 404]);
return new WP_Error('forbidden', 'Access denied', ['status' => 403]);
return new WP_REST_Response(null, 204); // For DELETE
```

**What HTTP status codes are:**
- **Standard numbers** that tell the client what happened with the request
- **200-299**: Success (200 = OK, 201 = Created)
- **400-499**: Client error (400 = Bad Request, 404 = Not Found, 403 = Forbidden)
- **500-599**: Server error (500 = Internal Server Error)

**Why proper status codes are important:**
- **API Standards**: Other developers expect standard status codes
- **Frontend Handling**: JavaScript can handle different errors differently
- **Debugging**: Easy to understand what went wrong
- **User Experience**: Proper error messages for users

**Common status codes and when to use them:**
```php
// Success
return $data; // 200 OK (default)

// Client errors (user's fault)
return new WP_Error('bad_request', 'Invalid data', ['status' => 400]);
return new WP_Error('unauthorized', 'Not logged in', ['status' => 401]);
return new WP_Error('forbidden', 'No permission', ['status' => 403]);
return new WP_Error('not_found', 'Record not found', ['status' => 404]);

// Server errors (your fault)
return new WP_Error('db_error', 'Database error', ['status' => 500]);
```

### **4. Validate Input Data**
```php
$allowed_fields = ['name', 'email', 'phone'];
$data = array_intersect_key($req->get_params(), array_flip($allowed_fields));
```

**What this does:**
- **Defines which fields are allowed** to be processed
- **Filters out any unwanted fields** from the request
- **Prevents unexpected data** from being processed

**Why input validation is important:**
- **Security**: Prevents malicious data from being processed
- **Data Integrity**: Ensures only valid data is saved
- **API Stability**: Prevents errors from unexpected data
- **Performance**: Don't waste time processing invalid data

**What happens without validation:**
```php
// User sends: {name: "John", email: "john@example.com", malicious_field: "hack"}
// Without validation, you might process malicious_field

// With validation:
$allowed_fields = ['name', 'email', 'phone'];
$data = array_intersect_key($req->get_params(), array_flip($allowed_fields));
// Result: {name: "John", email: "john@example.com"} - malicious_field is removed
```

**Additional validation best practices:**
```php
// 1. Check required fields
if (empty($data['name'])) {
    return new WP_Error('bad_request', 'Name is required', ['status' => 400]);
}

// 2. Validate data types
if (!is_email($data['email'])) {
    return new WP_Error('bad_request', 'Invalid email format', ['status' => 400]);
}

// 3. Sanitize data
$data['name'] = sanitize_text_field($data['name']);
$data['email'] = sanitize_email($data['email']);
```

---

## 🔍 **DEEP DIVE: Line-by-Line CRUD Explanation with Your Database**

#### **🤔 WHAT & WHY: Deep Dive CRUD Explanation**

**What is this section?**
This section takes the actual code from your project and explains every single line in detail. It's like having a code review with an expert developer who explains every decision.

**Why do we need line-by-line explanations?**
- **Learning**: Understand exactly how each piece works
- **Debugging**: Know what each line does when something goes wrong
- **Maintenance**: Easy to modify code when you understand every part
- **Best Practices**: See real examples of good WordPress coding

**What makes this different from other explanations?**
- **Real Code**: Uses your actual database and function names
- **Every Line**: Explains even the smallest details
- **Context**: Shows how each line fits into the bigger picture
- **Practical**: You can follow along with your own code

### **📖 READ Operations - Detailed Breakdown**

#### **🤔 WHAT & WHY: READ Operations Deep Dive**

**What are READ operations?**
READ operations retrieve data from the database and send it to the frontend. They're like "asking questions" to your database.

**Why do we need detailed READ explanations?**
- **Complex Logic**: READ operations often have pagination, search, and security
- **Performance**: Understanding how queries work helps optimize them
- **Security**: Every security check is important to understand
- **User Experience**: Search and pagination directly affect users

#### **1. List Contacts with Real Database Fields**
```php
function svc_contact_list(WP_REST_Request $req) {
    global $wpdb;
    $t = $wpdb->prefix . 'contacts'; // Results in: utm_contacts
    
    // Get user's laboratory IDs for security
    $lab_ids = svc_contact_current_user_lab_ids();
    if (empty($lab_ids)) return array(); // No labs = no data
    
    // Pagination parameters from URL: ?page=2&per_page=25
    $page = max(1, intval($req->get_param('page') ?: 1));     // Default: 1
    $per_page = max(1, min(200, intval($req->get_param('per_page') ?: 50))); // Max: 200
    $offset = ($page - 1) * $per_page; // For page 2 with 25 items: offset = 25
    
    // Build WHERE conditions
    $where = array("laboratoire_id IN (".implode(',', array_map('intval',$lab_ids)).")");
    $params = array();
    
    // Search functionality: ?search=university
    if ($q = trim((string)$req->get_param('search'))) {
        $like = '%'.$wpdb->esc_like($q).'%'; // Escapes special characters
        $where[] = "(institution LIKE %s OR domaine LIKE %s OR contact_nom LIKE %s OR contact_email LIKE %s OR contact_tel LIKE %s)";
        array_push($params, $like, $like, $like, $like, $like);
    }
    
    // Build the complete SQL query
    $sql = "SELECT id,laboratoire_id,institution,domaine,contact_nom,contact_email,contact_tel,
                   org_email,org_tel,website,logo_url,contact_avatar_url,matricule,org_address,created_at,updated_at,created_by,updated_by
            FROM {$t}
            WHERE ".implode(' AND ', $where)."
            ORDER BY id DESC
            LIMIT %d OFFSET %d";
    $params[] = $per_page; 
    $params[] = $offset;
    
    // Execute with prepared statement (prevents SQL injection)
    $rows = $wpdb->get_results($wpdb->prepare($sql, ...$params), ARRAY_A) ?: array();
    return $rows;
}
```

**Line-by-line breakdown:**

```php
function svc_contact_list(WP_REST_Request $req) {
```
**What this does:**
- Creates a function called `svc_contact_list`
- Takes a `WP_REST_Request` parameter (contains all the request data)
- This function will handle GET requests to list contacts

**Why this naming:**
- `svc_` = "service" (tells you this is business logic)
- `contact_list` = "list contacts" (clear what it does)
- `WP_REST_Request` = WordPress's request object (contains URL parameters, headers, etc.)

```php
global $wpdb;
```
**What this does:**
- Gives you access to WordPress's database object
- `$wpdb` is WordPress's way to talk to the database

**Why we need this:**
- **Database Access**: This is how you run SQL queries in WordPress
- **WordPress Standard**: All WordPress database operations use `$wpdb`
- **Security**: `$wpdb` handles SQL injection protection automatically

```php
$t = $wpdb->prefix . 'contacts'; // Results in: utm_contacts
```
**What this does:**
- Creates the full table name by combining WordPress prefix with 'contacts'
- If your WordPress uses 'utm_' prefix, this becomes 'utm_contacts'

**Why use the prefix:**
- **Multi-site**: WordPress can run multiple sites with different table prefixes
- **Security**: Prevents table name conflicts between plugins
- **WordPress Standard**: All WordPress tables use the prefix

```php
$lab_ids = svc_contact_current_user_lab_ids();
if (empty($lab_ids)) return array(); // No labs = no data
```
**What this does:**
- Gets the laboratory IDs that the current user has access to
- If user has no lab access, return empty array (no data)

**Why this security check:**
- **Data Isolation**: Users should only see their lab's data
- **Security**: Prevents unauthorized access to other labs' data
- **Multi-tenant**: Each lab is like a separate organization

**How `svc_contact_current_user_lab_ids()` works:**
```php
function svc_contact_current_user_lab_ids(): array {
    global $wpdb;
    $uid = get_current_user_id();
    if (!$uid) return [];
    
    // Get labs where user is a member
    $rows = $wpdb->get_col($wpdb->prepare("SELECT laboratoire_id FROM utm_recherche_membre WHERE user_id=%d", $uid));
    return array_map('intval', $rows);
}
```

```php
$page = max(1, intval($req->get_param('page') ?: 1));     // Default: 1
$per_page = max(1, min(200, intval($req->get_param('per_page') ?: 50))); // Max: 200
$offset = ($page - 1) * $per_page; // For page 2 with 25 items: offset = 25
```
**What this does:**
- Gets pagination parameters from the URL
- `page` = which page to show (default: 1)
- `per_page` = how many records per page (default: 50, max: 200)
- `offset` = how many records to skip

**Why pagination is needed:**
- **Performance**: Loading 10,000 records at once would be slow
- **User Experience**: Users can't see 10,000 records on one page
- **Memory**: Prevents server from running out of memory

**How pagination math works:**
```php
// Page 1, 50 per page: offset = (1-1) * 50 = 0 (show records 1-50)
// Page 2, 50 per page: offset = (2-1) * 50 = 50 (show records 51-100)
// Page 3, 25 per page: offset = (3-1) * 25 = 50 (show records 51-75)
```

```php
$where = array("laboratoire_id IN (".implode(',', array_map('intval',$lab_ids)).")");
$params = array();
```
**What this does:**
- Builds the WHERE clause for the SQL query
- Creates: `laboratoire_id IN (1,2,3)` (user's lab IDs)
- Starts the parameters array for prepared statements

**Why this approach:**
- **Security**: Only show records from user's laboratories
- **Performance**: Database can use indexes on laboratoire_id
- **Prepared Statements**: Parameters are safely escaped

```php
if ($q = trim((string)$req->get_param('search'))) {
    $like = '%'.$wpdb->esc_like($q).'%'; // Escapes special characters
    $where[] = "(institution LIKE %s OR domaine LIKE %s OR contact_nom LIKE %s OR contact_email LIKE %s OR contact_tel LIKE %s)";
    array_push($params, $like, $like, $like, $like, $like);
}
```
**What this does:**
- Checks if user provided a search term
- Escapes special characters in the search term
- Adds search conditions to the WHERE clause
- Searches in multiple fields: institution, domaine, contact_nom, contact_email, contact_tel

**Why search multiple fields:**
- **User Experience**: Users can search by any field
- **Flexibility**: Don't need to know which field to search
- **Real-world Usage**: Users often search by name or institution

**How `$wpdb->esc_like()` works:**
```php
// User searches for: "university%"
// $wpdb->esc_like() converts it to: "university\%"
// Final LIKE pattern: "%university\%%"
// This prevents the % from being treated as a wildcard
```

```php
$sql = "SELECT id,laboratoire_id,institution,domaine,contact_nom,contact_email,contact_tel,
               org_email,org_tel,website,logo_url,contact_avatar_url,matricule,org_address,created_at,updated_at,created_by,updated_by
        FROM {$t}
        WHERE ".implode(' AND ', $where)."
        ORDER BY id DESC
        LIMIT %d OFFSET %d";
```
**What this does:**
- Builds the complete SQL query
- SELECTs all the fields from your contacts table
- WHERE clause filters by lab and search
- ORDER BY shows newest records first (id DESC)
- LIMIT and OFFSET handle pagination

**Why these specific fields:**
- **Complete Data**: Frontend needs all contact information
- **Security**: Only fields that should be visible
- **Performance**: Only select what you need

**Why ORDER BY id DESC:**
- **User Experience**: Show newest contacts first
- **Performance**: id is indexed, so sorting is fast
- **Consistency**: Same order every time

```php
$params[] = $per_page; 
$params[] = $offset;
```
**What this does:**
- Adds the pagination parameters to the prepared statement
- These will replace the %d placeholders in the SQL

**Why add parameters at the end:**
- **Order Matters**: Parameters must match the placeholders in order
- **Prepared Statements**: WordPress will safely escape these values

```php
$rows = $wpdb->get_results($wpdb->prepare($sql, ...$params), ARRAY_A) ?: array();
return $rows;
```
**What this does:**
- Executes the prepared SQL query
- Returns results as an associative array
- If no results, returns empty array

**Why `ARRAY_A`:**
- **Frontend Friendly**: JavaScript can easily work with arrays
- **Consistent**: Same format every time
- **Readable**: Field names are preserved as keys

**Why `?: array()`:**
- **Safety**: If query fails, return empty array instead of false
- **Frontend**: JavaScript expects an array, not false
- **Error Handling**: Graceful fallback

**What each line does:**
- `global $wpdb` - Access WordPress database object
- `$t = $wpdb->prefix . 'contacts'` - Gets "utm_contacts" (your table name)
- `$lab_ids = svc_contact_current_user_lab_ids()` - Security: only show user's lab data
- `$page = max(1, intval($req->get_param('page') ?: 1))` - Get page number, minimum 1
- `$per_page = max(1, min(200, ...))` - Limit results per page (1-200)
- `$offset = ($page - 1) * $per_page` - Calculate database offset
- `$wpdb->esc_like($q)` - Escape special characters for LIKE queries
- `$wpdb->prepare($sql, ...$params)` - Create safe prepared statement
- `$wpdb->get_results(..., ARRAY_A)` - Execute query, return as associative array

#### **2. Get Single Contact with Permission Check**
```php
function svc_contact_get(WP_REST_Request $req) {
    global $wpdb; 
    $t = $wpdb->prefix . 'contacts'; // utm_contacts
    $id = intval($req['id']); // Convert URL parameter to integer
    
    // Security: Check if user has access to any laboratories
    $lab_ids = svc_contact_current_user_lab_ids();
    if (empty($lab_ids)) return new WP_Error('forbidden','Access denied',array('status'=>403));
    
    // Get the specific record
    $row = $wpdb->get_row($wpdb->prepare("SELECT * FROM {$t} WHERE id=%d", $id), ARRAY_A);
    if (!$row) return new WP_Error('not_found','Record not found',array('status'=>404));
    
    // Security: Verify the contact belongs to user's laboratory
    if (!in_array((int)$row['laboratoire_id'], $lab_ids, true))
        return new WP_Error('forbidden','Not your lab',array('status'=>403));
    
    return $row;
}
```

**What each line does:**
- `$id = intval($req['id'])` - Extract ID from URL `/contact/123` → 123
- `$lab_ids = svc_contact_current_user_lab_ids()` - Get user's lab permissions
- `if (empty($lab_ids))` - Security check: no labs = no access
- `$wpdb->get_row(..., ARRAY_A)` - Get single row as associative array
- `if (!$row)` - Check if record exists
- `in_array((int)$row['laboratoire_id'], $lab_ids, true)` - Verify ownership

### **➕ CREATE Operations - Detailed Breakdown**

```php
function svc_contact_create(WP_REST_Request $req) {
    global $wpdb; 
    $t = $wpdb->prefix . 'contacts'; // utm_contacts
    
    // Security: Check user has lab access
    $lab_ids = svc_contact_current_user_lab_ids();
    if (empty($lab_ids))
        return new WP_Error('forbidden','You are not attached to any laboratory', array('status'=>403));
    
    // Define allowed fields and their types (from your database schema)
    $allowed = array(
        'laboratoire_id'     => 'int',
        'institution'        => 'text',
        'domaine'            => 'text',
        'matricule'          => 'text',
        'org_address'        => 'text',
        'contact_nom'        => 'text',
        'contact_email'      => 'email',
        'contact_tel'        => 'text',
        'org_email'          => 'email',
        'org_tel'            => 'text',
        'website'            => 'text',
        'logo_url'           => 'text',
        'contact_avatar_url' => 'text',
    );
    
    // Get data from request (JSON or form data)
    $data = $req->get_json_params(); 
    if (!$data) $data = $req->get_params();
    
    // Handle base64 image uploads
    foreach (['logo_url','contact_avatar_url'] as $k) {
        if (!empty($data[$k]) && is_string($data[$k]) && stripos($data[$k], 'data:image')===0) {
            $url = svc_contact_store_dataurl_local($data[$k], $k==='logo_url'?'org-logo':'contact-avatar');
            if ($url) { 
                $data[$k] = $url; 
            } else { 
                unset($data[$k]); 
            }
        }
    }
    
    // Sanitize and prepare data for database
    $ins = array(); 
    $fmts = array();
    foreach($allowed as $k=>$type){
        if (!array_key_exists($k,$data)) continue; // Skip missing fields
        $v = svc_contact_sanitize($k,$data[$k],$type); // Clean the data
        if ($v === null || $v === '') continue; // Skip empty values
        $ins[$k] = $v; 
        $fmts[] = svc_contact_fmt($type); // Add format for prepared statement
    }
    
    // Auto-assign laboratory if not specified
    if (empty($ins['laboratoire_id'])) {
        $ins['laboratoire_id'] = (int)$lab_ids[0]; // Use first lab
        $fmts[] = '%d';
    } else {
        // Verify user can create in this lab
        if (!in_array((int)$ins['laboratoire_id'], $lab_ids, true))
            return new WP_Error('forbidden','You can only create in your labs', array('status'=>403));
    }
    
    // Validate required fields
    if (empty($ins['institution']) || empty($ins['contact_nom'])) {
        return new WP_Error('bad_request','Fields "institution" and "contact_nom" are required', array('status'=>400));
    }
    
    // Add audit fields (from your database schema)
    $now = current_time('mysql'); 
    $uid = get_current_user_id();
    if (svc_contact_col_exists($t,'created_by'))   { $ins['created_by'] = $uid; $fmts[]='%d'; }
    if (svc_contact_col_exists($t,'updated_by'))   { $ins['updated_by'] = $uid; $fmts[]='%d'; }
    if (svc_contact_col_exists($t,'created_at'))   { $ins['created_at'] = $now; $fmts[]='%s'; }
    if (svc_contact_col_exists($t,'updated_at'))   { $ins['updated_at'] = $now; $fmts[]='%s'; }
    
    // Insert into database
    $ok = $wpdb->insert($t, $ins, $fmts);
    if (!$ok) return new WP_Error('db_error','Insert failed: '.$wpdb->last_error, array('status'=>500));
    
    // Return the created record
    $id = (int)$wpdb->insert_id;
    $row = $wpdb->get_row($wpdb->prepare("SELECT * FROM {$t} WHERE id=%d", $id), ARRAY_A);
    return $row;
}
```

**What each section does:**
- **Security Check**: Verify user has laboratory access
- **Field Definition**: Map allowed fields to their data types
- **Data Extraction**: Get JSON or form data from request
- **Image Handling**: Convert base64 images to files
- **Data Sanitization**: Clean and validate each field
- **Permission Check**: Verify user can create in specified lab
- **Validation**: Check required fields
- **Audit Trail**: Add creation tracking
- **Database Insert**: Execute the insert with prepared statement
- **Response**: Return the created record

### **✏️ UPDATE Operations - Detailed Breakdown**

```php
function svc_contact_update(WP_REST_Request $req) {
    global $wpdb; 
    $t = $wpdb->prefix . 'contacts'; 
    $id = intval($req['id']); // Get ID from URL
    
    // Security: Check user has lab access
    $lab_ids = svc_contact_current_user_lab_ids();
    if (empty($lab_ids)) return new WP_Error('forbidden','Access denied',array('status'=>403));
    
    // Get current record to check ownership
    $cur = $wpdb->get_row($wpdb->prepare("SELECT * FROM {$t} WHERE id=%d", $id), ARRAY_A);
    if (!$cur) return new WP_Error('not_found','Record not found',array('status'=>404));
    
    // Security: Verify user owns this record
    if (!in_array((int)$cur['laboratoire_id'], $lab_ids, true))
        return new WP_Error('forbidden','Not your lab',array('status'=>403));
    
    // Get and sanitize update data (same as create)
    $allowed = svc_contact_allowed_fields();
    $data = $req->get_json_params(); 
    if (!$data) $data = $req->get_params();
    
    $upd = array(); 
    $fmts = array();
    foreach($allowed as $k=>$type){
        if (!array_key_exists($k,$data)) continue; // Skip unchanged fields
        $v = svc_contact_sanitize($k,$data[$k],$type);
        if ($v === null) continue; // Skip null values
        $upd[$k] = $v; 
        $fmts[] = svc_contact_fmt($type);
    }
    
    // Add update audit fields
    $now = current_time('mysql'); 
    $uid = get_current_user_id();
    if (svc_contact_col_exists($t,'updated_by')) { $upd['updated_by'] = $uid; $fmts[]='%d'; }
    if (svc_contact_col_exists($t,'updated_at')) { $upd['updated_at'] = $now; $fmts[]='%s'; }
    
    // Update database
    $ok = $wpdb->update($t, $upd, array('id'=>$id), $fmts, array('%d'));
    if ($ok === false) return new WP_Error('db_error','Update failed: '.$wpdb->last_error, array('status'=>500));
    
    // Return updated record
    $row = $wpdb->get_row($wpdb->prepare("SELECT * FROM {$t} WHERE id=%d", $id), ARRAY_A);
    return $row;
}
```

**Key differences from CREATE:**
- **Ownership Check**: Verify user owns the record before updating
- **Selective Update**: Only update fields that are provided
- **No Required Fields**: Don't validate required fields on update
- **Update Audit**: Only set `updated_by` and `updated_at`

### **🗑️ DELETE Operations - Detailed Breakdown**

```php
function svc_contact_delete(WP_REST_Request $req) {
    global $wpdb; 
    $t = $wpdb->prefix . 'contacts'; 
    $id = intval($req['id']);
    
    // Security: Check user has lab access
    $lab_ids = svc_contact_current_user_lab_ids();
    if (empty($lab_ids)) return new WP_Error('forbidden','Access denied',array('status'=>403));
    
    // Get current record to check ownership
    $cur = $wpdb->get_row($wpdb->prepare("SELECT * FROM {$t} WHERE id=%d", $id), ARRAY_A);
    if (!$cur) return new WP_Error('not_found','Record not found',array('status'=>404));
    
    // Security: Verify user owns this record
    if (!in_array((int)$cur['laboratoire_id'], $lab_ids, true))
        return new WP_Error('forbidden','Not your lab',array('status'=>403));
    
    // Delete the record
    $ok = $wpdb->delete($t, array('id'=>$id), array('%d'));
    if ($ok === false) return new WP_Error('db_error','Delete failed: '.$wpdb->last_error, array('status'=>500));
    
    // Return success (WordPress REST API expects 204 for DELETE)
    return new WP_REST_Response(null, 204);
}
```

**What each line does:**
- **Security Checks**: Same as update - verify access and ownership
- **$wpdb->delete()**: Delete record with prepared statement
- **WP_REST_Response(null, 204)**: Return HTTP 204 (No Content) for successful delete

---

## 🔧 **Helper Functions Explained**

#### **🤔 WHAT & WHY: Helper Functions Explained**

**What are helper functions?**
Helper functions are small, reusable functions that do specific tasks. They're like "tools" that your main functions use to get work done. Think of them as specialized workers in a factory.

**Why do we need helper functions?**
- **Reusability**: Use the same code in multiple places
- **Maintainability**: Fix bugs in one place, affects everywhere
- **Readability**: Main functions are easier to understand
- **Testing**: Can test each helper function separately
- **Organization**: Keeps related code together

**What makes a good helper function?**
- **Single Purpose**: Does one thing well
- **Pure Function**: Same input always gives same output
- **No Side Effects**: Doesn't change global state
- **Clear Naming**: Name tells you exactly what it does
- **Small**: Easy to understand and test

### **Data Sanitization Function**
```php
function svc_contact_sanitize($key, $val, $type) {
    switch ($type) {
        case 'int':
            return is_numeric($val) ? intval($val) : null;
        case 'email':
            return is_email($val) ? sanitize_email($val) : null;
        case 'url':
            return esc_url_raw($val);
        case 'text':
        default:
            return is_scalar($val) ? sanitize_text_field($val) : null;
    }
}
```

**What this function does:**
- **Cleans and validates** data based on its expected type
- **Prevents security issues** like XSS and SQL injection
- **Converts data** to the correct format for the database

**Why we need data sanitization:**
- **Security**: Prevents malicious code from being saved
- **Data Integrity**: Ensures data is in the correct format
- **User Experience**: Handles invalid input gracefully
- **Database Safety**: Prevents database errors from bad data

**Line-by-line breakdown:**

```php
function svc_contact_sanitize($key, $val, $type) {
```
**What this does:**
- Creates a function that takes 3 parameters
- `$key` = field name (for debugging)
- `$val` = the value to sanitize
- `$type` = what type of data this should be

**Why these parameters:**
- **Flexibility**: Can sanitize any field with any type
- **Debugging**: `$key` helps identify which field had problems
- **Type Safety**: `$type` tells us how to clean the data

```php
switch ($type) {
```
**What this does:**
- Checks what type of data we're dealing with
- Runs different cleaning code for each type

**Why use switch:**
- **Performance**: Faster than if/else chains
- **Readability**: Easy to see all the different types
- **Maintainability**: Easy to add new types

```php
case 'int':
    return is_numeric($val) ? intval($val) : null;
```
**What this does:**
- Checks if the value is a number
- If yes, converts it to an integer
- If no, returns null (invalid data)

**Why this approach:**
- **Validation**: `is_numeric()` checks if it's actually a number
- **Conversion**: `intval()` converts string "123" to integer 123
- **Error Handling**: Returns null for invalid data instead of crashing

**Examples:**
```php
svc_contact_sanitize('age', '25', 'int');     // Returns: 25
svc_contact_sanitize('age', 'abc', 'int');    // Returns: null
svc_contact_sanitize('age', '25.7', 'int');   // Returns: 25
```

```php
case 'email':
    return is_email($val) ? sanitize_email($val) : null;
```
**What this does:**
- Checks if the value is a valid email address
- If yes, sanitizes it (removes dangerous characters)
- If no, returns null

**Why this approach:**
- **WordPress Function**: `is_email()` is WordPress's built-in email validator
- **Security**: `sanitize_email()` removes dangerous characters
- **Validation**: Only accepts properly formatted emails

**Examples:**
```php
svc_contact_sanitize('email', 'user@example.com', 'email');     // Returns: 'user@example.com'
svc_contact_sanitize('email', 'invalid-email', 'email');        // Returns: null
svc_contact_sanitize('email', 'user@example.com<script>', 'email'); // Returns: 'user@example.com'
```

```php
case 'url':
    return esc_url_raw($val);
```
**What this does:**
- Sanitizes a URL by removing dangerous characters
- Always returns a string (never null)

**Why `esc_url_raw()`:**
- **WordPress Function**: Built-in URL sanitizer
- **Security**: Removes dangerous characters and protocols
- **Flexibility**: Handles various URL formats

**Examples:**
```php
svc_contact_sanitize('website', 'https://example.com', 'url');     // Returns: 'https://example.com'
svc_contact_sanitize('website', 'javascript:alert("hack")', 'url'); // Returns: ''
svc_contact_sanitize('website', 'ftp://files.com', 'url');         // Returns: 'ftp://files.com'
```

```php
case 'text':
default:
    return is_scalar($val) ? sanitize_text_field($val) : null;
```
**What this does:**
- Handles text fields (names, descriptions, etc.)
- Checks if it's a scalar value (string, number, boolean)
- Sanitizes text by removing dangerous characters

**Why `is_scalar()`:**
- **Type Check**: Ensures it's a simple value, not an array or object
- **Security**: Prevents complex data types that might be dangerous
- **Database Safety**: Only simple values can go in text fields

**Why `sanitize_text_field()`:**
- **WordPress Function**: Built-in text sanitizer
- **XSS Prevention**: Removes HTML tags and scripts
- **SQL Safety**: Escapes characters that could break SQL

**Examples:**
```php
svc_contact_sanitize('name', 'John Doe', 'text');                    // Returns: 'John Doe'
svc_contact_sanitize('name', '<script>alert("hack")</script>', 'text'); // Returns: 'alert("hack")'
svc_contact_sanitize('name', ['John', 'Doe'], 'text');              // Returns: null
```

### **Format Function for Prepared Statements**
```php
function svc_contact_fmt($type) {
    return $type === 'int' ? '%d' : '%s';
}
```

**What this function does:**
- **Converts data types** to prepared statement format codes
- **Tells WordPress** how to treat each parameter in SQL queries

**Why we need this:**
- **Prepared Statements**: WordPress needs to know the data type
- **SQL Safety**: Different types need different escaping
- **Performance**: Database can optimize based on type

**How it works:**
```php
svc_contact_fmt('int');    // Returns: '%d' (integer)
svc_contact_fmt('email');  // Returns: '%s' (string)
svc_contact_fmt('text');   // Returns: '%s' (string)
svc_contact_fmt('url');    // Returns: '%s' (string)
```

**Why only two types:**
- **WordPress Standard**: Only `%d` (integer) and `%s` (string) are needed
- **Database Types**: MySQL only needs to know integer vs everything else
- **Simplicity**: Keeps the function simple and fast

**How it's used:**
```php
$data = ['name' => 'John', 'age' => 25];
$formats = [];
foreach($data as $key => $value) {
    $formats[] = svc_contact_fmt($type);
}
// $formats = ['%s', '%d']
```

### **User Laboratory Access Function**
```php
function svc_contact_current_user_lab_ids(): array {
    global $wpdb;
    $uid = get_current_user_id();
    if (!$uid) return [];
    
    $mt = $wpdb->prefix . 'recherche_membre'; // utm_recherche_membre
    $lt = $wpdb->prefix . 'recherche_laboratoire'; // utm_recherche_laboratoire
    
    $labs = [];
    
    // Get labs where user is a member
    $rows = $wpdb->get_col($wpdb->prepare("SELECT laboratoire_id FROM {$mt} WHERE user_id=%d", $uid)) ?: [];
    $labs = array_merge($labs, array_map('intval',$rows));
    
    // Get labs where user is director
    $rows = $wpdb->get_col($wpdb->prepare("SELECT id FROM {$lt} WHERE directeur_user_id=%d", $uid)) ?: [];
    $labs = array_merge($labs, array_map('intval',$rows));
    
    return array_values(array_unique(array_filter($labs)));
}
```

**What this function does:**
- **Gets all laboratory IDs** that the current user has access to
- **Checks two sources**: labs where user is a member, labs where user is director
- **Returns a clean array** of unique lab IDs

**Why we need this function:**
- **Security**: Users should only see data from their labs
- **Multi-tenant**: Each lab is like a separate organization
- **Flexibility**: Users can be members of multiple labs
- **Performance**: Caches the result instead of checking every time

**Line-by-line breakdown:**

```php
function svc_contact_current_user_lab_ids(): array {
```
**What this does:**
- Creates a function that returns an array of lab IDs
- `: array` tells PHP this function always returns an array

**Why specify return type:**
- **Type Safety**: PHP knows what to expect
- **IDE Support**: Better autocomplete and error checking
- **Documentation**: Makes it clear what the function returns

```php
global $wpdb;
$uid = get_current_user_id();
if (!$uid) return [];
```
**What this does:**
- Gets access to the database
- Gets the current user's ID
- If no user is logged in, return empty array

**Why check for logged-in user:**
- **Security**: Only logged-in users can access data
- **Performance**: Don't waste time if no user
- **Error Prevention**: Avoid errors from trying to get data for no user

```php
$mt = $wpdb->prefix . 'recherche_membre'; // utm_recherche_membre
$lt = $wpdb->prefix . 'recherche_laboratoire'; // utm_recherche_laboratoire
```
**What this does:**
- Creates table names with WordPress prefix
- `$mt` = members table (who belongs to which lab)
- `$lt` = laboratories table (lab information)

**Why separate variables:**
- **Readability**: Clear what each table is for
- **Reusability**: Can use the same table names multiple times
- **Maintainability**: Easy to change table names if needed

```php
$labs = [];
```
**What this does:**
- Creates an empty array to store lab IDs
- Will collect IDs from both sources

**Why start with empty array:**
- **Clean Start**: No leftover data from previous calls
- **Array Operations**: Can use array_merge() safely
- **Consistency**: Always returns an array, even if empty

```php
// Get labs where user is a member
$rows = $wpdb->get_col($wpdb->prepare("SELECT laboratoire_id FROM {$mt} WHERE user_id=%d", $uid)) ?: [];
$labs = array_merge($labs, array_map('intval',$rows));
```
**What this does:**
- Queries the members table for labs where user is a member
- Converts results to integers and adds to $labs array

**Why `get_col()`:**
- **Performance**: Only gets the column we need, not full rows
- **Memory**: Uses less memory than `get_results()`
- **Simplicity**: Returns a simple array of values

**Why `array_map('intval', $rows)`:**
- **Type Safety**: Ensures all IDs are integers
- **Database Safety**: Prevents string IDs from causing problems
- **Consistency**: All IDs are the same type

```php
// Get labs where user is director
$rows = $wpdb->get_col($wpdb->prepare("SELECT id FROM {$lt} WHERE directeur_user_id=%d", $uid)) ?: [];
$labs = array_merge($labs, array_map('intval',$rows));
```
**What this does:**
- Queries the laboratories table for labs where user is director
- Adds these lab IDs to the existing array

**Why check both sources:**
- **Flexibility**: Users can access labs in two ways
- **Real-world**: Directors should have access to their labs
- **Completeness**: Don't miss any labs the user should see

```php
return array_values(array_unique(array_filter($labs)));
```
**What this does:**
- `array_filter()`: Removes any empty/false values
- `array_unique()`: Removes duplicate lab IDs
- `array_values()`: Re-indexes the array (0, 1, 2, 3...)

**Why this cleanup:**
- **No Duplicates**: User might be both member and director of same lab
- **No Empty Values**: Remove any null or false values
- **Clean Array**: Return a nice, clean array of unique lab IDs

**Example of what this returns:**
```php
// If user is member of labs 1, 3 and director of lab 2:
return [1, 2, 3];

// If user has no lab access:
return [];
```

---

## 🤔 **WHAT & WHY: Deep Explanation of Design Decisions**

### **🔍 Why WordPress Uses This Architecture**

#### **1. Why `global $wpdb` instead of Eloquent ORM?**

**What it is:**
```php
global $wpdb;
$wpdb->get_results($wpdb->prepare("SELECT * FROM table WHERE id=%d", $id));
```

**Why WordPress does this:**
- **Historical Reasons**: WordPress was built before modern ORMs existed (2003)
- **Performance**: Direct SQL is faster than ORM abstraction layers
- **Flexibility**: Complex queries are easier to write in raw SQL
- **WordPress Philosophy**: "Decisions, not options" - WordPress chooses simplicity over complexity
- **Database Compatibility**: Works with any database WordPress supports (MySQL, MariaDB, etc.)

**Laravel Comparison:**
```php
// Laravel (Modern ORM)
User::where('id', $id)->first();

// WordPress (Direct SQL)
$wpdb->get_row($wpdb->prepare("SELECT * FROM users WHERE id=%d", $id));
```

#### **2. Why `register_rest_route()` instead of Route Files?**

**What it is:**
```php
add_action('rest_api_init', function () {
    register_rest_route('namespace/v1', '/endpoint', [
        'methods' => 'GET',
        'callback' => 'function_name',
        'permission_callback' => function() { return is_user_logged_in(); }
    ]);
});
```

**Why WordPress does this:**
- **Hook System**: WordPress is built around hooks (`add_action`, `add_filter`)
- **Plugin Architecture**: Any plugin can add routes without modifying core files
- **Dynamic Loading**: Routes are registered when plugins are loaded
- **No File Conflicts**: Multiple plugins can't overwrite the same route file
- **WordPress Standards**: Follows WordPress coding standards and patterns

**Laravel Comparison:**
```php
// Laravel (File-based routes)
// routes/api.php
Route::get('/users', [UserController::class, 'index']);

// WordPress (Hook-based routes)
add_action('rest_api_init', function() {
    register_rest_route('api/v1', '/users', [
        'methods' => 'GET',
        'callback' => 'get_users'
    ]);
});
```

#### **3. Why Service Functions instead of Controllers?**

**What it is:**
```php
function svc_contact_create(WP_REST_Request $req) {
    // Business logic here
}
```

**Why WordPress does this:**
- **Simplicity**: Functions are easier to understand than classes for simple operations
- **WordPress Philosophy**: "Keep it simple" - avoid over-engineering
- **Plugin Development**: Easier for non-OOP developers to contribute
- **Performance**: Functions have less overhead than classes
- **WordPress Standards**: Most WordPress code uses procedural programming

**Laravel Comparison:**
```php
// Laravel (Class-based)
class ContactController extends Controller {
    public function store(Request $request) {
        // Logic here
    }
}

// WordPress (Function-based)
function svc_contact_create(WP_REST_Request $req) {
    // Logic here
}
```

### **🔐 Why This Security Model?**

#### **1. Why Laboratory-Based Access Control?**

**What it is:**
```php
$lab_ids = svc_contact_current_user_lab_ids();
if (!in_array($row['laboratoire_id'], $lab_ids)) {
    return new WP_Error('forbidden', 'Not your lab', ['status' => 403]);
}
```

**Why this approach:**
- **Multi-Tenant Architecture**: Each laboratory is like a separate organization
- **Data Isolation**: Users can only see/modify their lab's data
- **Scalability**: Easy to add new laboratories without code changes
- **Security**: Prevents data leakage between different research groups
- **Real-World Model**: Mirrors how research institutions actually work

**Database Design:**
```sql
-- Every record belongs to a laboratory
CREATE TABLE utm_contacts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    laboratoire_id INT NOT NULL,  -- This is the key!
    -- ... other fields
);

-- Users are members of laboratories
CREATE TABLE utm_recherche_membre (
    user_id BIGINT NOT NULL,
    laboratoire_id BIGINT NOT NULL,
    -- ... other fields
);
```

#### **2. Why Nonce Verification?**

**What it is:**
```php
'permission_callback' => function () {
    $nonce = $_SERVER['HTTP_X_WP_NONCE'] ?? '';
    return wp_verify_nonce($nonce, 'wp_rest');
}
```

**Why this is necessary:**
- **CSRF Protection**: Prevents Cross-Site Request Forgery attacks
- **WordPress Standard**: All WordPress forms use nonces
- **Security Layer**: Even if someone gets your session, they can't make requests
- **REST API Requirement**: WordPress REST API requires nonce for authenticated requests

**How it works:**
1. Frontend gets nonce from `wpApiSettings.nonce`
2. Sends nonce in `X-WP-Nonce` header
3. Backend verifies nonce matches user session
4. Request is allowed or denied

#### **3. Why Data Sanitization?**

**What it is:**
```php
function svc_contact_sanitize($key, $val, $type) {
    switch ($type) {
        case 'int': return is_numeric($val) ? intval($val) : null;
        case 'email': return is_email($val) ? sanitize_email($val) : null;
        case 'text': return sanitize_text_field($val);
    }
}
```

**Why this approach:**
- **SQL Injection Prevention**: Prepared statements + sanitization = double protection
- **XSS Prevention**: Sanitized text can't contain malicious scripts
- **Data Integrity**: Ensures data matches expected format
- **WordPress Functions**: Uses WordPress built-in sanitization functions
- **Type Safety**: Converts data to correct types before database storage

### **🏗️ Why This Database Design?**

#### **1. Why Audit Fields?**

**What it is:**
```sql
CREATE TABLE utm_contacts (
    -- ... data fields
    created_by BIGINT UNSIGNED DEFAULT NULL,
    updated_by BIGINT UNSIGNED DEFAULT NULL,
    created_at DATETIME DEFAULT NULL,
    updated_at DATETIME DEFAULT NULL
);
```

**Why these fields exist:**
- **Compliance**: Many organizations require audit trails
- **Debugging**: Know who changed what and when
- **Security**: Track suspicious activity
- **Data Recovery**: Understand data history
- **Accountability**: Users are responsible for their changes

**How it's used:**
```php
// On create
$ins['created_by'] = get_current_user_id();
$ins['created_at'] = current_time('mysql');

// On update
$upd['updated_by'] = get_current_user_id();
$upd['updated_at'] = current_time('mysql');
```

#### **2. Why JSON Fields?**

**What it is:**
```sql
CREATE TABLE utm_recherche_laboratoire (
    axes_recherche LONGTEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
    meta_json LONGTEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
    CONSTRAINT chk_1 CHECK (json_valid(`axes_recherche`))
);
```

**Why use JSON:**
- **Flexibility**: Store variable data structures
- **Performance**: No need for separate tables for simple key-value data
- **Modern MySQL**: JSON functions are fast and powerful
- **Schema Evolution**: Easy to add new fields without ALTER TABLE
- **WordPress Compatibility**: WordPress uses JSON for metadata

**Example usage:**
```php
// Store array as JSON
$data = ['field1' => 'value1', 'field2' => 'value2'];
$json = wp_json_encode($data);

// Retrieve and decode
$array = json_decode($json, true);
```

#### **3. Why ENUM Fields?**

**What it is:**
```sql
CREATE TABLE utm_recherche_reseaux (
    statut ENUM('Actif','Occasionnel','En cours','Clos') NOT NULL DEFAULT 'Actif'
);
```

**Why use ENUM:**
- **Data Integrity**: Only valid values allowed
- **Performance**: Faster than VARCHAR with CHECK constraints
- **Storage**: More efficient than VARCHAR
- **Validation**: Database-level validation
- **Documentation**: Self-documenting valid values

### **🌐 Why This Frontend Architecture?**

#### **1. Why Fetch API instead of jQuery AJAX?**

**What it is:**
```javascript
const response = await fetch(`${API}/contact`, {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify(data)
});
```

**Why this approach:**
- **Modern Standard**: Fetch is the modern way to make HTTP requests
- **Promise-based**: Better error handling than callbacks
- **Native**: No external dependencies
- **Flexible**: More control over requests
- **Future-proof**: jQuery is being phased out

**jQuery Comparison:**
```javascript
// Old jQuery way
$.ajax({
    url: '/api/contact',
    method: 'POST',
    data: JSON.stringify(data),
    success: function(response) { /* handle success */ },
    error: function(xhr) { /* handle error */ }
});

// Modern fetch way
try {
    const response = await fetch('/api/contact', {
        method: 'POST',
        body: JSON.stringify(data)
    });
    const result = await response.json();
} catch (error) {
    // handle error
}
```

#### **2. Why DataTables Integration?**

**What it is:**
```javascript
const table = $('#contactsTable').DataTable({
    dom: '<"top">rt<"clear">',
    pagingType: 'simple',
    // ... other options
});
```

**Why use DataTables:**
- **Feature-Rich**: Pagination, sorting, filtering, searching built-in
- **Performance**: Handles large datasets efficiently
- **Customization**: Highly customizable appearance and behavior
- **WordPress Compatibility**: Works well with WordPress admin styles
- **User Experience**: Familiar interface for users

### **🔄 Why This CRUD Pattern?**

#### **1. Why Separate Functions for Each Operation?**

**What it is:**
```php
function svc_contact_list() { /* GET */ }
function svc_contact_get() { /* GET by ID */ }
function svc_contact_create() { /* POST */ }
function svc_contact_update() { /* PUT/PATCH */ }
function svc_contact_delete() { /* DELETE */ }
```

**Why separate functions:**
- **Single Responsibility**: Each function has one job
- **Maintainability**: Easy to modify one operation without affecting others
- **Testing**: Can test each operation independently
- **Security**: Different permission checks for different operations
- **Performance**: Optimize each operation separately

#### **2. Why Prepared Statements?**

**What it is:**
```php
$wpdb->get_row($wpdb->prepare("SELECT * FROM table WHERE id=%d", $id));
```

**Why prepared statements:**
- **SQL Injection Prevention**: Parameters are escaped automatically
- **Performance**: Query is compiled once, executed many times
- **WordPress Standard**: All WordPress database operations use prepared statements
- **Security**: Even if user input contains SQL, it can't be executed

**Dangerous way (NEVER do this):**
```php
// ❌ VULNERABLE TO SQL INJECTION
$wpdb->get_row("SELECT * FROM table WHERE id = " . $id);
```

**Safe way:**
```php
// ✅ SAFE WITH PREPARED STATEMENTS
$wpdb->get_row($wpdb->prepare("SELECT * FROM table WHERE id = %d", $id));
```

### **📊 Why This Error Handling?**

#### **1. Why WP_Error instead of Exceptions?**

**What it is:**
```php
return new WP_Error('not_found', 'Record not found', ['status' => 404]);
```

**Why WP_Error:**
- **WordPress Standard**: All WordPress functions use WP_Error
- **HTTP Status Codes**: Easy to return proper HTTP status codes
- **Consistent**: Same error format across all WordPress functions
- **REST API Integration**: WordPress REST API handles WP_Error automatically
- **User-Friendly**: Can provide user-friendly error messages

**Laravel Comparison:**
```php
// Laravel (Exceptions)
throw new ModelNotFoundException('Record not found');

// WordPress (WP_Error)
return new WP_Error('not_found', 'Record not found', ['status' => 404]);
```

#### **2. Why HTTP Status Codes?**

**What it is:**
```php
return new WP_Error('forbidden', 'Access denied', ['status' => 403]);
```

**Why specific status codes:**
- **REST API Standard**: HTTP status codes are the standard way to communicate errors
- **Frontend Handling**: JavaScript can handle different status codes differently
- **Debugging**: Easy to understand what went wrong
- **API Documentation**: Self-documenting API responses

**Common Status Codes:**
- `200` - Success
- `201` - Created
- `400` - Bad Request (validation error)
- `401` - Unauthorized (not logged in)
- `403` - Forbidden (no permission)
- `404` - Not Found
- `500` - Internal Server Error

This comprehensive explanation shows the reasoning behind every design decision in the WordPress API architecture! 🚀
