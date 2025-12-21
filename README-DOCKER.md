# Docker Setup untuk Backend Puskesmas

## Persyaratan

-   Docker Desktop (Windows/Mac) atau Docker Engine (Linux)
-   Docker Compose

## Cara Menjalankan

### 1. Setup Environment

```bash
# Copy file environment untuk Docker
cp .env.docker .env

# Atau edit .env yang sudah ada dan sesuaikan dengan konfigurasi Docker:
# DB_CONNECTION=pgsql
# DB_HOST=db
# DB_PORT=5432
# DB_DATABASE=puskesmas
# DB_USERNAME=postgres
# DB_PASSWORD=postgres
# REDIS_HOST=redis
```

### 2. Build dan Jalankan Container

```bash
# Build dan jalankan semua services
docker-compose up -d --build

# Atau jalankan tanpa build (jika sudah pernah build)
docker-compose up -d
```

### 3. Install Dependencies dan Setup Database

```bash
# Masuk ke container app
docker-compose exec app bash

# Install composer dependencies (jika belum)
composer install

# Generate application key (jika belum ada)
php artisan key:generate

# Jalankan migrasi database
php artisan migrate

# Jalankan seeder (opsional)
php artisan db:seed

# Keluar dari container
exit
```

### 4. Akses Aplikasi

-   **Backend API**: http://localhost:8000
-   **Filament Admin**: http://localhost:8000/admin
-   **PgAdmin**: http://localhost:8080 (email: admin@puskesmas.local, password: postgres)

## Services yang Tersedia

1. **app** - PHP 8.2 FPM (Laravel Application)
2. **nginx** - Web Server (Port 8000)
3. **db** - PostgreSQL 16 Alpine (Port 5432)
4. **redis** - Redis Cache (Port 6379)
5. **pgadmin** - Database Management (Port 8080)

## Command Docker Berguna

```bash
# Melihat status container
docker-compose ps

# Melihat logs
docker-compose logs -f

# Melihat logs service tertentu
docker-compose logs -f app
docker-compose logs -f nginx

# Stop semua container
docker-compose stop

# Start semua container
docker-compose start

# Restart service tertentu
docker-compose restart app

# Stop dan hapus semua container
docker-compose down

# Stop, hapus container dan hapus volumes
docker-compose down -v

# Rebuild container tertentu
docker-compose up -d --build app

# Masuk ke container
docker-compose exec app bash
docker-compose exec db bash

# Jalankan artisan command
docker-compose exec app php artisan migrate
docker-compose exec app php artisan cache:clear
docker-compose exec app php artisan config:clear
docker-compose exec app php artisan route:list
```

## Troubleshooting

### Permission Issues

```bash
# Set permission untuk storage dan cache
docker-compose exec app chmod -R 775 storage bootstrap/cache
docker-compose exec app chown -R www-data:www-data storage bootstrap/cache
```

### Database Connection Failed

```bash
# Pastikan service db sudah running
docker-compose ps

# Cek logs database
docker-compose logs db

# Pastikan konfigurasi di .env sudah benar
docker-compose exec app php artisan config:clear
```

### Clear All Cache

```bash
docker-compose exec app php artisan optimize:clear
```

### Reset Database

```bash
docker-compose exec app php artisan migrate:fresh --seed
```

## Struktur File Docker

```
backend/
├── Dockerfile                 # Konfigurasi image PHP-FPM
├── docker-compose.yml        # Orchestration semua services
├── .dockerignore            # File yang diabaikan saat build
├── .env.docker              # Environment variables untuk Docker
└── docker/
    └── nginx/
        └── nginx.conf       # Konfigurasi Nginx
```

## Catatan Penting

1. **Development Mode**: Konfigurasi ini untuk development. Untuk production, perlu adjustment keamanan.
2. **Data Persistence**: Data MySQL dan Redis disimpan di Docker volumes, tidak akan hilang saat container dihapus.
3. **Hot Reload**: Perubahan code langsung tereflect karena menggunakan volume mount.
4. **Port Conflicts**: Pastikan port 8000, 8080, 3306, dan 6379 tidak digunakan aplikasi lain.

## Production Considerations

Untuk production deployment, pertimbangkan:

-   Gunakan secrets management untuk credentials
-   Set `APP_DEBUG=false` dan `APP_ENV=production`
-   Tambahkan SSL/TLS certificate
-   Optimize Dockerfile (multi-stage build, remove dev dependencies)
-   Setup proper backup untuk database
-   Implementasi health checks
-   Setup load balancer jika diperlukan
