# 🌸 Valoria Parfume - E-Commerce Custom Parfum

![Laravel](https://img.shields.io/badge/Laravel-11.x-FF2D20?style=flat&logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-8.2-777BB4?style=flat&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-8.0-4479A1?style=flat&logo=mysql&logoColor=white)
![Bootstrap](https://img.shields.io/badge/Bootstrap-5.3-7952B3?style=flat&logo=bootstrap&logoColor=white)

Platform e-commerce luxury untuk membeli parfum ready stock atau membuat custom parfum dengan memilih aroma sendiri. Dibangun dengan Laravel 11, MySQL, dan Bootstrap 5 dengan desain modern, elegant, dan user-friendly.

## ✨ Fitur Utama

### 🛍️ Fitur Customer
- **Home Page** 
  - Banner slider carousel untuk promosi
  - Hero section dengan tagline "Your Signature, Your Scent"
  - Featured products dengan gambar produk
  - Why Choose Us section
  
- **Katalog Produk** 
  - Grid view produk ready stock dengan gambar
  - Informasi lengkap (nama, harga, stok)
  - Placeholder elegant untuk produk tanpa gambar
  
- **Detail Produk** 
  - Gambar produk besar
  - Informasi detail dengan add to cart
  - Stock availability indicator
  
- **Custom Perfume Builder** 
  - Desain elegant dengan light theme
  - Pilih aroma dengan harga real-time:
    - Top Notes (Bergamot, Lemon, Orange, dll) - Rp 15.000/aroma
    - Middle Notes (Lavender, Rose, Jasmine, dll) - Rp 15.000/aroma
    - Base Notes (Vanilla, Sandalwood, Musk, dll) - Rp 15.000/aroma
  - Pilih ukuran botol (10ml, 30ml, 50ml, 100ml)
  - **Real-time Price Calculator** dengan breakdown detail
  - Visual feedback saat memilih aroma (check icon, highlight)
  - Sticky sidebar dengan price summary
  
- **Shopping Cart** - Keranjang belanja berbasis session
- **Checkout** - Form checkout dengan upload bukti pembayaran
- **Order History** - Riwayat pesanan dengan status tracking

- **Authentication**
  - Login page dengan desain luxury glassmorphism
  - Register page dengan password toggle
  - User-friendly dengan icons dan visual feedback

### 👨‍💼 Fitur Admin Panel
- **Dashboard** - Statistics cards dan monthly revenue chart (Chart.js)

- **Banner Management** 
  - CRUD operations untuk banner slider homepage
  - Upload gambar banner (max 2MB)
  - Set title, subtitle, link, order, dan status active/inactive
  - Toggle active/inactive dengan satu klik
  - Preview gambar di list
  
- **Product Management** 
  - CRUD operations untuk produk ready stock
  - Upload gambar produk (max 2MB, JPG/JPEG/PNG)
  - Preview gambar sebelum upload
  - Auto-delete gambar saat update/delete produk
  - Thumbnail preview di list produk
  
- **Aroma Management** 
  - CRUD operations untuk fragrance notes (Top, Middle, Base)
  - Set harga per aroma (default Rp 15.000)
  
- **Bottle Size Management** - CRUD operations untuk ukuran botol dan pricing

- **Order Management** 
  - View orders dan update status
  - Status: pending, processing, completed, cancelled
  
- **Sales Reports** 
  - Filter: Daily, Monthly, Yearly, Custom Range
  - Statistics: Total transaksi, revenue, produk terjual
  - Chart.js visualization
  - Export: PDF, Excel, Print

## 🎨 Desain UI/UX

### Customer Pages
- **Tema**: Modern, Luxury, Clean
- **Warna**: Light background dengan Gold accent (#D4AF37)
- **Custom Perfume**: Light theme untuk readability
- **Auth Pages**: Glassmorphism dengan dark gradient
- **Typography**: Poppins (Google Fonts)
- **Efek**: 
  - Smooth hover animations
  - Card shadows dan borders
  - Visual feedback (check icons, highlights)
  - Sticky sidebar
- **Responsive**: Mobile-first design dengan Bootstrap 5

### Admin Panel
- **Tema**: Dark elegant
- **Warna**: Dark background dengan Gold accent
- **Cards**: Glassmorphism effect
- **Tables**: Clean dengan hover effects

## 🗄️ Database Schema

### Tables
- **users** - User accounts dengan is_admin flag
- **aromas** - Fragrance notes (name, category, description, **price**)
- **bottle_sizes** - Bottle sizes dengan base pricing
- **products** - Ready stock products dengan **image** (soft deletes)
- **banners** - Homepage banner slider (title, subtitle, image, link, order, is_active)
- **orders** - Customer orders dengan payment proof
- **order_items** - Order line items (support custom & ready stock)

## 🚀 Instalasi

### Prerequisites
- PHP >= 8.2
- Composer
- MySQL >= 8.0
- Apache/Nginx (XAMPP/Laragon untuk Windows)

### Langkah Instalasi

1. **Clone Repository**
```bash
git clone https://github.com/username/valoria-parfume.git
cd valoria-parfume
```

2. **Install Dependencies**
```bash
composer install
```

3. **Copy Environment File**
```bash
cp .env.example .env
```

4. **Generate Application Key**
```bash
php artisan key:generate
```

5. **Konfigurasi Database**

Edit file `.env` dan sesuaikan dengan konfigurasi database Anda:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=valoria_parfume
DB_USERNAME=root
DB_PASSWORD=
```

6. **Buat Database**
```sql
CREATE DATABASE valoria_parfume;
```

7. **Jalankan Migration & Seeder**
```bash
php artisan migrate --seed
```

8. **Create Storage Link**
```bash
php artisan storage:link
```

9. **Buat Folder Upload**
```bash
mkdir -p public/uploads/payment_proofs
mkdir -p public/uploads/banners
mkdir -p public/uploads/products
```

10. **Jalankan Development Server**
```bash
php artisan serve
```

Aplikasi akan berjalan di `http://127.0.0.1:8000`

## 🔐 Default Credentials

### Admin Account
- **Email**: admin@valoria.com
- **Password**: admin123

### Sample Data
Seeder akan otomatis membuat:
- 1 Admin user
- 15 Aromas dengan harga (5 Top Notes, 5 Middle Notes, 5 Base Notes)
- 4 Bottle Sizes (10ml, 30ml, 50ml, 100ml)
- 6 Sample Products

## 📁 Struktur Project

```
valoria-parfume/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── HomeController.php
│   │   │   ├── ShopController.php
│   │   │   ├── CustomPerfumeController.php
│   │   │   ├── CartController.php
│   │   │   ├── CheckoutController.php
│   │   │   ├── OrderController.php
│   │   │   └── Admin/
│   │   │       ├── DashboardController.php
│   │   │       ├── ProductController.php (with image upload)
│   │   │       ├── AromaController.php
│   │   │       ├── BottleSizeController.php
│   │   │       ├── BannerController.php (NEW)
│   │   │       ├── OrderController.php
│   │   │       └── ReportController.php
│   │   └── Middleware/
│   │       └── AdminMiddleware.php
│   └── Models/
│       ├── User.php
│       ├── Product.php (with image field)
│       ├── Order.php
│       ├── OrderItem.php
│       ├── Aroma.php (with price field)
│       ├── BottleSize.php
│       └── Banner.php (NEW)
├── database/
│   ├── migrations/
│   │   ├── create_banners_table.php (NEW)
│   │   └── add_price_to_aromas_table.php (NEW)
│   └── seeders/
├── resources/
│   └── views/
│       ├── layouts/
│       │   ├── main.blade.php
│       │   └── admin.blade.php
│       ├── auth/
│       │   ├── login.blade.php (REDESIGNED)
│       │   └── register.blade.php (REDESIGNED)
│       ├── home.blade.php (with banner carousel)
│       ├── shop/
│       │   ├── index.blade.php (with product images)
│       │   └── show.blade.php (with product image)
│       ├── custom/
│       │   └── index.blade.php (REDESIGNED)
│       ├── cart/
│       ├── checkout/
│       ├── orders/
│       └── admin/
│           ├── banners/ (NEW)
│           │   ├── index.blade.php
│           │   ├── create.blade.php
│           │   └── edit.blade.php
│           └── products/ (with image upload)
└── public/
    ├── uploads/
    │   ├── banners/ (NEW)
    │   ├── products/ (NEW)
    │   └── payment_proofs/
    └── assets/
        ├── css/
        │   └── style.css
        └── js/
            └── custom-perfume.js (UPDATED)
```

## 🛠️ Tech Stack

- **Backend**: Laravel 11 (PHP 8.2)
- **Database**: MySQL 8.0
- **Frontend**: Bootstrap 5, jQuery
- **Charts**: Chart.js
- **Icons**: Font Awesome 6
- **Fonts**: Google Fonts (Poppins)
- **Authentication**: Laravel UI with Bootstrap
- **Export**: DomPDF, Laravel Excel
- **Image Upload**: Native PHP file handling

## 🎯 Fitur Terbaru (Latest Updates)

### ✅ Banner Slider Homepage
- Carousel otomatis dengan Bootstrap 5
- Admin panel untuk manajemen banner
- Upload gambar, set title/subtitle, link
- Toggle active/inactive
- Order management

### ✅ Product Image Upload
- Upload gambar di admin panel
- Preview sebelum upload
- Auto-delete saat update/delete
- Display di homepage, shop, dan detail

### ✅ Custom Perfume Enhancement
- Aroma pricing (Rp 15.000/aroma)
- Real-time price calculation
- Visual feedback (check icons, highlights)
- Light theme untuk better readability
- Sticky sidebar dengan price summary
- Breakdown harga yang jelas

### ✅ Auth Pages Redesign
- Login page dengan glassmorphism
- Register page dengan password toggle
- User-friendly icons dan visual feedback
- Luxury dark theme

## 📝 API Routes

### Public Routes
- `GET /` - Home page (with banner carousel)
- `GET /shop` - Product catalog (with images)
- `GET /shop/{id}` - Product detail (with image)
- `GET /custom-perfume` - Custom perfume builder (redesigned)
- `GET /cart` - Shopping cart
- `POST /cart/add` - Add to cart
- `POST /cart/update` - Update cart
- `POST /cart/remove` - Remove from cart

### Authenticated Routes
- `GET /checkout` - Checkout page
- `POST /checkout` - Process order
- `GET /orders` - Order history
- `GET /orders/{id}` - Order detail

### Admin Routes (Protected)
- `GET /admin` - Dashboard
- `GET /admin/banners` - Banner management (NEW)
- `GET /admin/products` - Product management (with image upload)
- `GET /admin/aromas` - Aroma management (with pricing)
- `GET /admin/bottle-sizes` - Bottle size management
- `GET /admin/orders` - Order management
- `GET /admin/reports` - Sales reports

## 🔒 Security Features

- CSRF Protection pada semua forms
- Admin Middleware untuk proteksi routes admin
- Form Request Validation
- Password Hashing (bcrypt)
- SQL Injection Prevention (Eloquent ORM)
- XSS Protection
- File Upload Validation (type, size)
- Image auto-deletion untuk prevent orphaned files

## ✅ Completed Features

- [x] Banner slider homepage dengan admin CRUD
- [x] Product image upload dengan auto-delete
- [x] Custom perfume dengan aroma pricing
- [x] Real-time price calculator
- [x] Auth pages redesign (login/register)
- [x] User-friendly custom perfume UI
- [x] Visual feedback dan animations
- [x] Responsive design
- [x] Image validation dan handling

## 🎯 Future Improvements

- [ ] Implement full PDF export dengan template
- [ ] Implement Excel export dengan Laravel Excel
- [ ] Add email notifications (order confirmation, status updates)
- [ ] Add payment gateway integration (Midtrans, etc.)
- [ ] Add product reviews and ratings
- [ ] Add wishlist functionality
- [ ] Add advanced search and filters
- [ ] Add inventory management alerts
- [ ] Add customer analytics dashboard
- [ ] Multiple product images (gallery)
- [ ] Image cropping/resizing functionality

## 🤝 Contributing

Contributions are welcome! Please feel free to submit a Pull Request.

1. Fork the project
2. Create your feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

## 📄 License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## 👨‍💻 Author

**Dwi Hardianto**
- Email: dwihardd@gmail.com

## 🙏 Acknowledgments

- Laravel Framework
- Bootstrap Team
- Font Awesome
- Chart.js
- Google Fonts

---

⭐ **Jika project ini membantu Anda, jangan lupa berikan star!** ⭐
