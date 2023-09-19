# Projek Belajar Laravel
<img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo">
Ini merupakan projek laravel pertama saya untuk belajar

## Installation

jalankan projek dengan perintah docker-compose, pastikan port 80 dan 3306 tidak digunakan oleh aplikasi lainnya.

```bash
  docker-compose up --build -d
```

Tunggu sampai proses pembuatan container selesai dengan mengakses

```bash
    http://localhost
```

Jika sudah berjalan maka lakukan perintah seeding database (saat pertama kali saja) *opsional jika diperlukan

```bash
    docker exec -it my_php8 php artisan db:seed
```

Aplikasi sudah berjalan dan dapat digunakan