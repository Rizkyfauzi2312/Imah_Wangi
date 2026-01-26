# Valoria Parfume
### Luxury Custom Perfume E-Commerce Platform

Valoria Parfume adalah platform e-commerce luxury yang memungkinkan pengguna untuk membeli parfum ready stock atau meracik parfum custom mereka sendiri. Dibangun dengan **Laravel 11**, platform ini menawarkan pengalaman belanja premium dengan desain yang elegan dan modern.

---

##  Fitur Utama

###  Experience Belanja
- **Luxury Homepage**: Banner promo dinamis dan produk unggulan.
- **Custom Perfume Builder**: Racik parfum sendiri dengan kategori Top, Middle, dan Base Notes.
- **Real-time Pricing**: Harga otomatis update saat memilih aroma dan ukuran botol.
- **Seamless Checkout**: Proses pemesanan mudah dengan fitur upload bukti pembayaran.
- **Order Tracking**: Pantau status pesanan (Pending, Processing, Completed).

###  Admin Central
- **Dashboard Analytics**: Visualisasi pendapatan dan transaksi menggunakan Chart.js.
- **Product & Banner Management**: Kelola produk dan banner promosi dengan mudah.
- **Fragrance & Bottle Management**: Atur koleksi aroma dan variasi ukuran botol.
- **Order Management**: Kelola alur pesanan pelanggan dari satu tempat.
- **Professional Reports**: Export laporan penjualan ke format **PDF (Luxury Template)** atau **Excel**.

---

##  Tech Stack

- **Framework**: Laravel 11 (PHP 8.2)
- **Database**: MySQL 8.0
- **Frontend**: Bootstrap 5, jQuery
- **Analytics**: Chart.js
- **Exporting**: Barryvdh DomPDF & Maatwebsite Excel
- **Assets**: Font Awesome 6, Google Fonts (Poppins)

---

## � Struktur Project

```
valoria-parfume/
├── app/
│   ├── Exports/            # Excel Export Classes (NEW)
│   ├── Http/Controllers/   # Logic Controller (Dashboard, Reports, dsb)
│   └── Models/             # Eloquent Models (User, Order, Product, dsb)
├── database/
│   ├── migrations/         # Skema Database
│   └── seeders/            # Sample Data
├── resources/
│   └── views/
│       ├── layouts/        # Layout Template (Main & Admin)
│       └── admin/          # Tampilan Panel Admin (Reports, dsb)
├── public/
│   ├── exports/            # Temporary export files
│   └── assets/             # CSS, JS, & Images
└── routes/
    └── web.php             # Definisi Route Aplikasi
```

---

## � Instalasi Cepat

1. **Clone & Install**
   ```bash
   git clone https://github.com/dwihardi11/valoria-parfume-ecommerce
   composer install
   ```

2. **Environment Setup**
   - Copy `.env.example` ke `.env`
   - Sesuaikan konfigurasi database di `.env`
   ```bash
   php artisan key:generate
   ```

3. **Database Migration**
   ```bash
   php artisan migrate --seed
   php artisan storage:link
   ```

4. **Run App**
   ```bash
   php artisan serve
   ```
   Akses di: `http://127.0.0.1:8000`

---

##  Akun Admin
- **Email**: `admin@valoria.com`
- **Password**: `admin123`

---

##  Progress Feature
- [x] **Banner Slider**: Admin CRUD & Homepage display.
- [x] **Product system**: Upload gambar & auto-handling files.
- [x] **Custom Perfume**: Real-time calculator & dynamic aroma pricing.
- [x] **Auth Redesign**: Modern glassmorphism login & register.
- [x] **Reports Export**: Professional PDF & Excel export features.

---

 **Valoria Parfume** - *Dwi Hardiansyah*
