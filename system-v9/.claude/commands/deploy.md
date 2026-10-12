# /deploy — Deploy Cerdas dengan Checklist Spesifik

> Jalankan setelah /siap-client selesai.
> Command ini tanya hosting kamu dulu, baru kasih panduan yang relevan.
> Urutan benar: /siap-client → /deploy → serah terima client

---

## LANGKAH 1 — Identifikasi Hosting

Tanya user:
```
Kamu deploy ke mana?
1. Hostinger Shared Hosting
2. Hostinger VPS
3. Platform lain (sebutkan)
```

Lanjut ke checklist yang sesuai di bawah.

---

## CHECKLIST A — HOSTINGER SHARED HOSTING

### Persiapan Lokal (sebelum upload)
```
[ ] npm run build → cek folder public/build sudah ada
[ ] composer install --optimize-autoloader --no-dev
[ ] Copy .env.example → .env (jangan upload .env asli via Git)
[ ] Pastikan .gitignore sudah include: .env, /vendor, /node_modules
[ ] git add . && git commit -m "release: [versi/tanggal]"
```

### Setup di Hostinger hPanel
```
[ ] Buat database MySQL baru di hPanel
[ ] Catat: DB_HOST, DB_DATABASE, DB_USERNAME, DB_PASSWORD
[ ] Set PHP version ke 8.2 (Manage → PHP Configuration)
[ ] Aktifkan ekstensi: pdo_mysql, mbstring, openssl, tokenizer, xml, ctype, json
[ ] Set document root ke /public_html/[folder]/public
```

### Upload & Konfigurasi
```
[ ] Upload semua file via Git atau File Manager
[ ] Buat file .env di server (isi manual dari .env.example)
[ ] Set nilai penting di .env server:
      APP_ENV=production
      APP_DEBUG=false
      APP_URL=https://[domain-kamu]
      DB_HOST=[dari hPanel]
      DB_DATABASE=[dari hPanel]
      DB_USERNAME=[dari hPanel]
      DB_PASSWORD=[dari hPanel]
```

### Jalankan via SSH atau hPanel Terminal
```bash
composer install --optimize-autoloader --no-dev
php artisan key:generate
php artisan migrate --force
php artisan storage:link
php artisan optimize
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### ⚠️ Jebakan Khusus Shared Hosting
```
[ ] Queue worker tidak bisa jalan permanen
    → Ganti QUEUE_CONNECTION=sync di .env (tidak pakai queue)
[ ] Scheduler tidak otomatis
    → Setup cron job di hPanel: * * * * * php /path/to/artisan schedule:run
[ ] Storage permission
    → chmod -R 775 storage bootstrap/cache
[ ] Symlink storage tidak jalan
    → Buat manual: ln -s ../storage/app/public public/storage
```

### Post-Deploy Verification
```
[ ] Buka URL → tidak muncul error 500
[ ] Login berhasil
[ ] Satu transaksi/aksi utama dicoba → jalan
[ ] Upload file dicoba (jika ada fitur upload)
[ ] Cek storage/logs/laravel.log → tidak ada error merah
[ ] Cek semua halaman utama → tidak ada yang 404
```

---

## CHECKLIST B — HOSTINGER VPS

### Persiapan Server (sekali saja)
```bash
# Update server
sudo apt update && sudo apt upgrade -y

# Install dependencies
sudo apt install -y nginx mysql-server php8.2-fpm php8.2-cli \
  php8.2-mysql php8.2-mbstring php8.2-xml php8.2-curl \
  php8.2-zip php8.2-bcmath php8.2-gd unzip git

# Install Composer
curl -sS https://getcomposer.org/installer | php
sudo mv composer.phar /usr/local/bin/composer

# Install Node.js
curl -fsSL https://deb.nodesource.com/setup_20.x | sudo -E bash -
sudo apt install -y nodejs
```

### Nginx Config untuk Laravel
```nginx
server {
    listen 80;
    server_name [domain-kamu];
    root /var/www/[project]/public;
    index index.php;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.2-fpm.sock;
        fastcgi_index index.php;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }
}
```

### Deploy & Konfigurasi
```bash
cd /var/www/[project]
git pull origin main
composer install --optimize-autoloader --no-dev
npm run build
php artisan migrate --force
php artisan optimize
sudo chown -R www-data:www-data storage bootstrap/cache
sudo chmod -R 775 storage bootstrap/cache
```

### Queue Worker (VPS bisa pakai ini)
```bash
# Install Supervisor
sudo apt install supervisor

# Config /etc/supervisor/conf.d/laravel-worker.conf
[program:laravel-worker]
process_name=%(program_name)s_%(process_num)02d
command=php /var/www/[project]/artisan queue:work --sleep=3 --tries=3
autostart=true
autorestart=true
numprocs=1
redirect_stderr=true
stdout_logfile=/var/www/[project]/storage/logs/worker.log
```

### Post-Deploy Verification
```
[ ] sudo nginx -t → tidak ada error syntax
[ ] sudo systemctl restart nginx php8.2-fpm
[ ] Buka URL → tidak ada error
[ ] Cek laravel.log → bersih
[ ] Test semua fitur utama
[ ] Cek SSL certificate aktif (Let's Encrypt)
```

---

## CATATAN HOSTINGER SPECIFIC

```
💡 Fitur Git Deployment Hostinger:
   hPanel → Git → Create Repository
   Ini lebih mudah dari manual upload — setup sekali, deploy cukup git push

💡 Subdomain untuk staging:
   Buat subdomain staging.[domain].com dulu
   Test di staging sebelum push ke production

⚠️ Shared hosting tidak cocok untuk:
   - Queue worker permanen
   - WebSocket
   - Proses yang butuh cron setiap detik
   Kalau butuh ini → upgrade ke VPS
```
