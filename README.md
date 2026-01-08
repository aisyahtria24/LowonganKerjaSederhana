# Lowongan Kerja Sederhana - Job Application System

Sistem aplikasi lowongan kerja berbasis web yang dibangun dengan Laravel 11, menyediakan platform untuk mengelola lowongan kerja, aplikasi pelamar, dan manajemen pengguna dengan role-based access control.

## 🚀 Fitur Utama

- **Role-based Access Control**: Admin, Staff, dan Guest dengan hak akses berbeda
- **Job Management**: CRUD lowongan kerja dengan kategori dan status
- **Applicant Management**: Sistem aplikasi dan review pelamar
- **Public Job Listings**: Halaman publik untuk mencari dan melamar pekerjaan
- **File Upload**: Upload CV dalam format PDF
- **Search & Filter**: Pencarian dan filter berdasarkan kategori
- **Responsive Design**: UI modern dengan Bootstrap 5

## 📋 Persyaratan Sistem

- PHP 8.1 atau lebih tinggi
- Composer
- Node.js & NPM
- MySQL atau database lainnya yang didukung Laravel
- Web server (Apache/Nginx) atau Laravel development server

## 🛠️ Instalasi dan Setup

### 1. Clone Repository
```bash
git clone <repository-url>
cd LowonganKerjaSederhana
```

### 2. Install Dependencies
```bash
composer install
npm install
```

### 3. Environment Configuration
```bash
cp .env.example .env
```

Edit file `.env` dan konfigurasikan database connection:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=lowongan_kerja
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

### 4. Generate Application Key
```bash
php artisan key:generate
```

### 5. Database Setup
```bash
php artisan migrate
php artisan db:seed
```

### 6. Build Assets
```bash
npm run build
# atau untuk development
npm run dev
```

### 7. Storage Link (untuk file upload)
```bash
php artisan storage:link
```

### 8. Jalankan Aplikasi
```bash
php artisan serve
```

Aplikasi akan berjalan di `http://localhost:8000`

## 👥 User Roles dan Login Credentials

Setelah menjalankan `php artisan db:seed`, sistem akan membuat user default untuk setiap role:

### 🔐 Admin User
- **Email**: admin@example.com
- **Password**: password
- **Role**: Admin (Full access)
- **Dashboard**: `/admin/*` routes
- **Capabilities**:
  - Manage jobs (CRUD)
  - Manage categories (CRUD)
  - Manage applicants (CRUD)
  - View all system data

### 👨‍💼 Staff User
- **Email**: staff@example.com
- **Password**: password
- **Role**: Staff
- **Dashboard**: `/staff/dashboard`
- **Capabilities**:
  - View job listings
  - Review and update applicant status
  - View applicant details

### 👤 Guest User
- **Email**: guest@example.com
- **Password**: password
- **Role**: Guest
- **Dashboard**: `/guest/jobs`
- **Capabilities**:
  - View public job listings
  - Search and filter jobs
  - Apply for jobs (with CV upload)
  - Register new account

## 📊 Database Seeding

Seeder akan membuat:
- 3 user default (Admin, Staff, Guest)
- 10 kategori pekerjaan
- 20 lowongan kerja sample
- 15 data pelamar sample

```bash
php artisan db:seed
```

Untuk seed specific seeder:
```bash
php artisan db:seed --class=JobSeeder
php artisan db:seed --class=PelamarSeeder
```

## 🗂️ Struktur Routes

### Public Routes
- `/` - Landing page
- `/login` - Login page
- `/register` - Registration page
- `/guest/jobs` - Public job listings

### Guest Routes (Authenticated)
- `/guest/jobs` - Job listings with search/filter
- `/guest/apply` - Job application form

### Staff Routes
- `/staff/dashboard` - Job listings dashboard
- `/staff/pelamar/{id}` - Applicant details

### Admin Routes
- `/admin/jobs` - Job management (CRUD)
- `/admin/categories` - Category management (CRUD)
- `/admin/pelamar` - Applicant management (CRUD)

## 🎨 UI/UX Features

- **Responsive Design**: Mobile-friendly dengan Bootstrap 5
- **Modern Cards**: Job listings dalam format card dengan hover effects
- **Search & Filter**: Real-time search dan filter berdasarkan kategori
- **Modal Forms**: Application forms dalam modal dialog
- **Status Badges**: Visual status indicators
- **File Upload**: Drag & drop CV upload dengan validation

## 🔧 Development Commands

```bash
# Jalankan server development
php artisan serve

# Jalankan queue worker (jika ada)
php artisan queue:work

# Clear cache
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Generate IDE helper
php artisan ide-helper:generate

# Run tests
php artisan test
```

## 📁 File Structure

```
├── app/
│   ├── Http/Controllers/
│   │   ├── Admin/
│   │   │   └── AdminJobController.php
│   │   ├── Auth/
│   │   ├── DashboardController.php
│   │   ├── JobController.php
│   │   └── PelamarController.php
│   ├── Models/
│   │   ├── Job.php
│   │   ├── Category.php
│   │   ├── Pelamar.php
│   │   └── User.php
│   └── Middleware/
│       └── RoleMiddleware.php
├── database/
│   ├── migrations/
│   ├── seeders/
│   │   ├── DatabaseSeeder.php
│   │   ├── JobSeeder.php
│   │   └── PelamarSeeder.php
├── resources/views/
│   ├── admin/
│   ├── staff/
│   ├── guest/
│   ├── auth/
│   └── layouts/
├── routes/
│   └── web.php
└── storage/app/public/cv_files/
```

## 🐛 Troubleshooting

### Common Issues:

1. **File Upload Not Working**
   ```bash
   php artisan storage:link
   chmod -R 755 storage/
   ```

2. **Permission Issues**
   ```bash
   chown -R www-data:www-data storage/
   chown -R www-data:www-data bootstrap/cache/
   ```

3. **Database Connection Error**
   - Pastikan database credentials di `.env` benar
   - Jalankan `php artisan migrate` jika belum

4. **Assets Not Loading**
   ```bash
   npm run build
   php artisan cache:clear
   ```

## 📞 Support

Untuk pertanyaan atau issues, silakan buat issue di repository atau hubungi tim development.

## 📄 License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
