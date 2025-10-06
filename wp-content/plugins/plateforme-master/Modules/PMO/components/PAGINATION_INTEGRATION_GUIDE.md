# 🔧 Pagination Integration Guide for PMO Components

## ✅ Pagination System Fixed!

The pagination buttons were disappearing because of DataTables integration issues. This has been fixed with a robust, reusable pagination system.

## 📁 Files Created/Modified

### ✅ Created:
- `pagination.php` - Reusable pagination component
- `PAGINATION_INTEGRATION_GUIDE.md` - This guide

### ✅ Modified:
- `contact-pmo.php` - Now uses reusable pagination

## 🚀 How to Apply This Pagination to Other PMO Pages

### Step 1: Include the Pagination Component

Add this line after your table HTML but before closing the content block:

```html
<!-- Include Reusable Pagination Component -->
<?php include 'pagination.php'; ?>
```

### Step 2: Initialize DataTables with Pagination

Replace your DataTables initialization with this pattern:

```javascript
// Initialize DataTable
const dataTable = $('#yourTableId').DataTable({
    paging: true,
    pagingType: 'simple',
    ordering: false, // or true if you want sorting
    info: false,
    pageLength: 5, // Adjust as needed
    language: {
        emptyTable: "Aucune donnée disponible",
        zeroRecords: "Aucun enregistrement correspondant trouvé"
    }
});

// Initialize reusable pagination component
PMOPagination.init(dataTable);
```

### Step 3: Hide Default DataTables Pagination (Optional)

The component automatically hides default pagination, but you can also add this CSS:

```css
.dataTables_paginate {
    display: none !important;
}
```

## 📋 Integration Checklist for Each PMO Page

- [ ] **Include pagination.php** after table
- [ ] **Update DataTables init** to remove custom pagination code
- [ ] **Add PMOPagination.init(dataTable)** after DataTables
- [ ] **Remove old pagination CSS/JS** if any exists
- [ ] **Test navigation** works correctly

## 🎨 Customization Options

### CSS Variables (in pagination.php):
```css
--pagination-border-color: #b60303;    /* Red borders */
--pagination-text-color: #b60303;      /* Red text */
--pagination-border-radius: 12px;       /* Rounded corners */
--pagination-button-size: 40px;        /* Button size */
--pagination-spacing: 8px;             /* Spacing between buttons */
```

### JavaScript Customization:
```javascript
// Customize colors and sizes
PMOPagination.customize({
    colors: {
        border: '#3498db',     // Blue theme
        text: '#3498db',
        activeBg: '#2980b9',
        activeText: '#ffffff'
    },
    sizes: {
        button: 45,           // Larger buttons
        borderRadius: 8,      // Less rounded
        spacing: 12           // More spacing
    }
});
```

## 🔧 Troubleshooting

### If Pagination Disappears:
1. **Check browser console** for errors
2. **Ensure DataTables is initialized** before PMOPagination.init()
3. **Verify table has multiple pages** of data
4. **Check PMOPagination object** exists

### If Buttons Don't Work:
1. **Check PMOPagination.currentDataTable** is set
2. **Verify pagination HTML** is present
3. **Ensure no conflicting CSS** hiding buttons

## 📊 Features Included

✅ **Red-bordered buttons** matching your design  
✅ **Rounded corners** (12px border-radius)  
✅ **Hover effects** with subtle animations  
✅ **Disabled state** styling  
✅ **Responsive design** for mobile  
✅ **Font Awesome icons** (<< << >> >>)  
✅ **Auto-hide** when only one page  
✅ **Easy customization** via CSS variables  
✅ **DataTables integration** that won't break  

## 🎯 Quick Implementation Example

For any PMO table page:

1. **Add to HTML:**
```html
<table id="myTable">
    <!-- table content -->
</table>
<?php include 'pagination.php'; ?>
```

2. **Add to JavaScript:**
```javascript
const dt = $('#myTable').DataTable({
    paging: true,
    pageLength: 5
});
PMOPagination.init(dt);
```

That's it! The pagination will work perfectly with your existing DataTables implementation.

## 🔄 Status

- ✅ Contact Management - **IMPLEMENTED & FIXED**
- ⏳ Other PMO Pages - **Ready to implement using this guide**
- ✅ Disappearing buttons issue - **RESOLVED**
- ✅ Reusable component - **CREATED & WORKING**
