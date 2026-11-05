# Changelog

All notable changes to this project will be documented in this file.

## [1.0.0] - 2026-01-23

### Added
- Initial release of Imah Wangi E-Commerce
- Customer features:
  - Home page with hero section and featured products
  - Product catalog with ready stock parfums
  - Custom perfume builder with real-time pricing
  - Shopping cart (session-based)
  - Checkout with payment proof upload
  - Order history and tracking
- Admin panel features:
  - Dashboard with statistics and Chart.js visualization
  - Product management (CRUD)
  - Aroma management (CRUD) - Top, Middle, Base notes
  - Bottle size management (CRUD)
  - Order management with status updates
  - Sales reports with filters (Daily, Monthly, Yearly, Custom Range)
  - Export functionality (PDF, Excel, Print)
- Security features:
  - CSRF protection
  - Admin middleware
  - Form validation
  - Password hashing
- Luxury UI/UX design:
  - Black, White, and Gold color scheme
  - Glossy buttons and hover effects
  - Responsive design with Bootstrap 5
  - Poppins font family

### Technical Stack
- Laravel 11 (PHP 8.2)
- MySQL 8.0
- Bootstrap 5
- Chart.js
- Font Awesome 6
- Google Fonts (Poppins)

### Database
- 6 main tables with proper relationships
- Eloquent ORM for all database operations
- Seeders for initial data (admin, aromas, bottle sizes, products)

### Known Limitations
- Excel export not fully implemented
- PDF export template not created
- Product image upload not implemented
- Email notifications not implemented
- Manual payment proof upload only (no payment gateway)
