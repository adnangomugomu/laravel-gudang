# Projek Belajar Laravel
<img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo">
Ini merupakan projek laravel pertama saya untuk belajar

## Installation

Penting ! (karena defaultnya nanti akan menjadi mode production)
```bash
Duplicate file .env.example menjadi .env
```

Jalankan projek dengan perintah docker-compose, pastikan port 80 dan 3306 tidak digunakan oleh aplikasi lainnya.

```bash
cd laravel-gudang
docker-compose up --build -d
```

Tunggu sampai proses pembuatan container selesai dengan mengakses

```bash
http://localhost
```

Jika sudah berjalan maka lakukan perintah seeding database (saat pertama kali saja)

```bash
docker exec -it my_php8 php artisan db:seed
```

Akun yang digunakan untuk login
```bash
username : adnan
password : password
```

Aplikasi sudah berjalan dan dapat digunakan