# Blog Resource - Filament Admin Panel

## 📝 Deskripsi

Resource CRUD lengkap untuk mengelola blog/artikel kesehatan di admin panel Filament dengan rich text editor.

## 🎯 Fitur Utama

### 1. **Rich Text Editor**

-   Editor WYSIWYG yang powerful untuk menulis konten
-   Support untuk:
    -   Heading (H2, H3)
    -   Bold, Italic, Underline, Strike
    -   Bullet & Numbered Lists
    -   Blockquotes
    -   Code Blocks
    -   Links
    -   File Attachments
    -   Undo/Redo

### 2. **Kategori Blog**

Terdapat 4 kategori blog:

-   🔵 **Berita Kesehatan** - Berita terkini seputar kesehatan
-   🟢 **Promosi Kesehatan** - Program dan kampanye kesehatan
-   🟡 **Artikel Kesehatan** - Artikel edukatif tentang kesehatan
-   🟣 **Kegiatan Puskesmas** - Kegiatan dan acara Puskesmas

### 3. **Fitur Image Upload**

-   Upload gambar utama (featured image)
-   Built-in image editor dengan crop/resize
-   Aspect ratio options: 16:9, 4:3, 1:1
-   Maksimal ukuran: 2MB
-   Auto storage ke folder `storage/app/public/blog-images`

### 4. **SEO & Metadata**

-   Auto-generate slug dari judul
-   Field excerpt untuk ringkasan
-   Estimasi waktu baca
-   Tracking jumlah views
-   Meta tags (JSON)

### 5. **Publikasi Management**

-   Toggle publish/unpublish
-   Scheduled publishing dengan datetime picker
-   Status draft untuk artikel yang belum dipublikasikan

## 🗂️ Struktur Database

```sql
CREATE TABLE blogs (
    id BIGINT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(255) NOT NULL,
    slug VARCHAR(255) UNIQUE NOT NULL,
    category ENUM('berita-kesehatan', 'promosi-kesehatan', 'artikel-kesehatan', 'kegiatan-puskesmas'),
    excerpt TEXT,
    content LONGTEXT NOT NULL,
    featured_image VARCHAR(255),
    author VARCHAR(255) DEFAULT 'Admin Puskesmas',
    read_time INT DEFAULT 5,
    is_published BOOLEAN DEFAULT FALSE,
    published_at TIMESTAMP,
    views_count INT DEFAULT 0,
    meta_tags JSON,
    created_at TIMESTAMP,
    updated_at TIMESTAMP
);
```

## 📁 File Structure

```
backend/
├── app/
│   ├── Models/
│   │   └── Blog.php                    # Model dengan fillable, casts, scopes
│   └── Filament/
│       └── Resources/
│           └── Blogs/
│               ├── BlogResource.php     # Main resource class
│               ├── Schemas/
│               │   └── BlogForm.php     # Form schema dengan sections
│               ├── Tables/
│               │   └── BlogsTable.php   # Table columns & filters
│               └── Pages/
│                   ├── ListBlogs.php    # List page
│                   ├── CreateBlog.php   # Create page
│                   └── EditBlog.php     # Edit page
└── database/
    ├── migrations/
    │   └── 2025_12_21_073943_create_blogs_table.php
    └── seeders/
        └── BlogSeeder.php               # Sample data seeder
```

## 🚀 Cara Menggunakan

### 1. Migration & Seeder

```bash
# Migration sudah dijalankan, tapi jika perlu:
php artisan migrate

# Jalankan seeder untuk data contoh:
php artisan db:seed --class=BlogSeeder
```

### 2. Akses Admin Panel

1. Login ke admin panel Filament
2. Klik menu **"Blog & Artikel"** di sidebar
3. Mulai membuat artikel baru atau edit yang sudah ada

### 3. Membuat Blog Post Baru

1. Klik tombol **"New Blog"** atau **"Create"**
2. Isi form:
    - **Judul**: Judul artikel (slug akan auto-generate)
    - **Kategori**: Pilih salah satu dari 4 kategori
    - **Gambar Utama**: Upload gambar (opsional)
    - **Ringkasan**: Ringkasan singkat max 500 karakter
    - **Konten Lengkap**: Tulis konten dengan rich text editor
    - **Penulis**: Nama penulis (default: Admin Puskesmas)
    - **Waktu Baca**: Estimasi waktu baca dalam menit
    - **Publikasikan**: Toggle untuk publish
    - **Tanggal Publikasi**: Tanggal & waktu publikasi
3. Klik **"Create"** atau **"Save"**

### 4. Filter & Search

-   **Search**: Cari berdasarkan judul, kategori, atau penulis
-   **Filter Kategori**: Filter berdasarkan kategori tertentu
-   **Filter Status**: Filter berdasarkan status publikasi (Published/Draft)
-   **Sort**: Klik header kolom untuk sorting

## 🎨 Tampilan Table Columns

| Column         | Deskripsi            | Fitur                           |
| -------------- | -------------------- | ------------------------------- |
| Gambar         | Thumbnail circular   | Default placeholder jika kosong |
| Judul          | Judul artikel        | Searchable, Sortable, Tooltip   |
| Kategori       | Badge kategori       | Warna berbeda per kategori      |
| Status         | Icon published/draft | Toggle-able                     |
| Tgl. Publikasi | Tanggal publikasi    | Format: d M Y, H:i              |
| Views          | Jumlah pembaca       | Icon eye                        |
| Waktu Baca     | Estimasi menit       | Hidden by default               |
| Dibuat         | Timestamp created    | Hidden by default               |
| Diupdate       | Timestamp updated    | Hidden by default               |

## 💡 Tips & Best Practices

### Menulis Konten

1. **Gunakan Heading**: Struktur artikel dengan H2 dan H3
2. **Paragraph Pendek**: Max 3-4 kalimat per paragraph
3. **Lists**: Gunakan bullet/numbered list untuk poin-poin
4. **Links**: Tambahkan link ke sumber atau artikel terkait
5. **Images**: Upload gambar berkualitas tinggi (min 1200x630px)

### SEO Optimization

1. **Judul**: Maksimal 60 karakter, include keyword
2. **Excerpt**: 150-160 karakter, menarik dan informatif
3. **Slug**: Singkat, jelas, include keyword
4. **Content**: Minimal 300 kata untuk artikel berkualitas

### Scheduling

-   Set `is_published = true` dan `published_at` untuk scheduled post
-   Artikel akan otomatis publish sesuai jadwal yang ditentukan

## 🔧 Customization

### Menambah Kategori Baru

Edit file migration dan model:

**Migration:**

```php
$table->enum('category', [
    'berita-kesehatan',
    'promosi-kesehatan',
    'artikel-kesehatan',
    'kegiatan-puskesmas',
    'kategori-baru'  // tambahkan di sini
])->default('artikel-kesehatan');
```

**Model (Blog.php):**

```php
public function getCategoryLabelAttribute()
{
    return match($this->category) {
        'berita-kesehatan' => 'Berita Kesehatan',
        'promosi-kesehatan' => 'Promosi Kesehatan',
        'artikel-kesehatan' => 'Artikel Kesehatan',
        'kegiatan-puskesmas' => 'Kegiatan Puskesmas',
        'kategori-baru' => 'Kategori Baru',  // tambahkan di sini
        default => $this->category,
    };
}
```

**Form & Table:**
Update options di `BlogForm.php` dan `BlogsTable.php`

### Menambah Field Baru

1. Buat migration baru dengan `php artisan make:migration add_field_to_blogs_table`
2. Tambahkan field di migration
3. Update `$fillable` di model
4. Tambahkan field di `BlogForm.php`
5. Tambahkan column di `BlogsTable.php` (opsional)

## 🔌 API Endpoints (Untuk Frontend)

Buat API controller untuk mengambil data blog di frontend:

```php
// routes/api.php
Route::get('/blogs', [BlogController::class, 'index']);
Route::get('/blogs/{slug}', [BlogController::class, 'show']);
Route::get('/blogs/category/{category}', [BlogController::class, 'byCategory']);

// app/Http/Controllers/BlogController.php
public function index()
{
    return Blog::published()
        ->latest('published_at')
        ->paginate(10);
}

public function show($slug)
{
    $blog = Blog::published()
        ->where('slug', $slug)
        ->firstOrFail();

    // Increment views
    $blog->increment('views_count');

    return $blog;
}

public function byCategory($category)
{
    return Blog::published()
        ->category($category)
        ->latest('published_at')
        ->paginate(10);
}
```

## 📊 Model Scopes

Model Blog memiliki beberapa scope yang berguna:

```php
// Get published blogs only
$blogs = Blog::published()->get();

// Get blogs by category
$berita = Blog::category('berita-kesehatan')->get();

// Combine scopes
$publishedBerita = Blog::published()
    ->category('berita-kesehatan')
    ->latest('published_at')
    ->get();
```

## 🐛 Troubleshooting

### Gambar tidak muncul

```bash
# Pastikan storage link sudah dibuat
php artisan storage:link

# Set permission untuk storage folder
chmod -R 775 storage
```

### Rich Editor tidak tampil

```bash
# Clear cache
php artisan optimize:clear

# Rebuild assets
npm run build
```

### Slug duplicate error

Slug auto-generate, tapi jika ada duplikat:

-   Edit manual slug di form
-   Atau tambahkan suffix unik (tanggal, ID, dll)

## 📚 Resources

-   [Filament Documentation](https://filamentphp.com/docs)
-   [Laravel Documentation](https://laravel.com/docs)
-   [Rich Editor Component](https://filamentphp.com/docs/forms/fields/rich-editor)

## 🎉 Selesai!

Blog resource sudah siap digunakan. Selamat menulis artikel kesehatan! 💪

---

**Dibuat oleh:** GitHub Copilot
**Tanggal:** 21 Desember 2025
**Versi:** 1.0.0
