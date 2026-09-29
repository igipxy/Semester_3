# Panduan Belajar Jobsheet 10 — Autentikasi dan Manajemen Sesi

Jobsheet 10 menambahkan akun petugas ke SIMPUS-Mini. Inti alurnya: password di-hash sebelum disimpan, diverifikasi saat login, identitas pengguna disimpan di session, lalu `includes/auth.php` memeriksa session sebelum halaman tertentu ditampilkan.

## 1. Struktur dan hak akses

- `index.php` dan `buku/list.php` tetap bisa dibuka tanpa login sebagai katalog publik.
- Halaman tambah, edit, proses, dan hapus buku memanggil `includes/auth.php`.
- Semua file PHP di `anggota/` juga memanggil guard yang sama.
- Folder `auth/` berisi formulir daftar/login dan pemrosesannya.
- `sql/02_users.sql` menambah tabel akun tanpa mengubah tabel `buku` dan `anggota`.

Guard mengamankan akses sebenarnya. Navbar hanya menyembunyikan tautan untuk kenyamanan; pengguna tetap bisa mengetik URL sendiri, sehingga setiap halaman privat wajib memanggil guard.

## 2. Registrasi dan hash password

`auth/register.php` mengirim nama, username, dan password dengan POST ke `auth/proses_register.php`. Pemroses memeriksa request, memangkas spasi nama/username, memvalidasi isian di server, lalu mengecek username yang sama di database.

Sebelum `INSERT`, `password_hash($password, PASSWORD_DEFAULT)` mengubah password menjadi hash. Database tidak menerima password asli. Username juga punya batasan `UNIQUE`, jadi PostgreSQL tetap mencegah duplikat jika dua pendaftaran bersamaan melewati pemeriksaan awal. Semua kolom yang berasal dari form dikirim lewat prepared statement.

Semua pendaftaran mendapat role `petugas` yang ditentukan di kode/SQL, bukan diambil dari form. Kolom role disiapkan untuk pembelajaran berikutnya; Jobsheet 10 belum memeriksa role untuk membedakan hak akses.

## 3. Login, session, dan logout

`auth/proses_login.php` mengambil satu akun berdasarkan username. Jika akun ditemukan, `password_verify()` membandingkan password yang baru diketik dengan hash tersimpan. Kode tidak mencoba mengembalikan hash menjadi password asli.

Jika cocok, `session_regenerate_id(true)` mengganti ID session setelah login. Lalu `user_id`, `name`, dan `role` disimpan di `$_SESSION`. Browser menerima cookie session, sedangkan data identitas disimpan sementara oleh PHP di server. Pada request berikutnya browser mengirim cookie itu lagi sehingga PHP dapat melanjutkan session. `includes/session.php` memulai session satu kali, mengaktifkan strict mode, dan memberi cookie atribut HttpOnly, SameSite=Lax, serta Secure saat request memakai HTTPS.

Jika login gagal, pesan yang sama digunakan untuk username yang salah maupun password yang salah. Ini menghindari aplikasi mengungkap username mana yang terdaftar. `includes/csrf.php` membuat token acak per session dan memvalidasinya pada form login, registrasi, logout, serta aksi tambah/edit/hapus buku dan anggota. `auth/logout.php` hanya menerima POST dengan token yang sesuai; setelah lolos, file ini menghapus session dan cookie lalu mengarahkan pengguna ke login.

## 4. Guard halaman

`includes/auth.php` memulai session hanya bila belum aktif, lalu memeriksa `isset($_SESSION['user_id'])`. Jika kunci itu tidak ada, browser diarahkan ke halaman login dan `exit` menghentikan kode halaman privat.

Guard harus dipanggil paling awal, sebelum header atau HTML apa pun. `header('Location: ...')` hanya dapat mengirim redirect sebelum output dikirim ke browser. Guard juga tidak membuka koneksi database; jadi redirect akses tanpa login tetap dapat berjalan meski PostgreSQL sedang tidak aktif.

## 5. Navbar dan katalog publik

`includes/header.php` menghitung `$sudahLogin` sekali. Semua orang melihat Beranda dan daftar buku. Hanya pengguna yang login yang melihat tautan CRUD buku dan daftar/CRUD anggota. Nama akun dicetak lewat helper `e()` agar karakter khusus tidak dianggap sebagai HTML.

Pada `buku/list.php`, kolom aksi hanya muncul saat pengguna login. Namun perlindungan tetap berada di tiap halaman aksi melalui guard, bukan pada tampilan navbar.

## 6. Siapkan environment di Windows dengan Laragon

1. Buka Laragon lalu jalankan PostgreSQL dan Apache.
2. Pastikan PHP yang dipakai Laragon memuat `pdo_pgsql`. Jika belum, aktifkan extension tersebut pada konfigurasi PHP Laragon, lalu restart Apache.
3. Pastikan database `web` sudah ada. Jika belum, buka terminal PostgreSQL dan buat database itu.
4. Buka terminal pada folder `jobsheet-10`. Jalankan dua file schema:

   ```text
   psql -U postgres -d web -f sql/01_buku_anggota.sql
   psql -U postgres -d web -f sql/02_users.sql
   ```

5. Periksa `includes/koneksi.php`. Default lokal menggunakan host `localhost`, port `5432`, database `web`, username `postgres`, dan password contoh `postgres`. Ubah sesuai instalasi sendiri atau set environment variables `DB_HOST`, `DB_PORT`, `DB_NAME`, `DB_USER`, dan `DB_PASS`.
6. Di terminal yang berada pada folder proyek, jalankan `php -S localhost:8000`, lalu buka `http://localhost:8000/index.php`.

Jika `psql` tidak ditemukan, gunakan terminal Laragon/PostgreSQL atau jalankan `psql.exe` dengan path penuh. Pastikan perintah dijalankan dari folder `jobsheet-10`, karena lokasi file `sql/02_users.sql` relatif terhadap folder tersebut.

## 7. Deploy ke hosting

Untuk deployment, pilih hosting yang mendukung PHP 8+, Apache atau aturan akses yang setara, extension `pdo_pgsql`, dan koneksi ke PostgreSQL. PHP dan PostgreSQL harus berada di jaringan yang bisa saling menjangkau.

1. Buat database dan user database khusus di panel hosting. Berikan hak minimum yang dibutuhkan aplikasi.
2. Import `sql/01_buku_anggota.sql` lalu `sql/02_users.sql` ke database hosting.
3. Upload isi folder `jobsheet-10` ke folder website dan arahkan document root atau URL subfolder ke sana.
4. Atur lima environment variables database di hosting. Jangan unggah atau commit password database produksi.
5. Aktifkan HTTPS, buka halaman beranda, buat akun demo, login, dan cek redirect halaman privat setelah logout.

PHP built-in server (`php -S`) hanya untuk belajar lokal. Jangan pakai sebagai server website publik. File `.htaccess` yang disertakan melindungi folder `includes/` dan `sql/` pada Apache. Server Nginx memerlukan aturan akses sendiri.

## 8. Batasan penting sebelum dipakai sungguhan

Form registrasi publik berarti siapa pun yang menemukan website dapat membuat akun petugas dan mengakses CRUD. Role `petugas` belum dipakai untuk otorisasi berbeda. Sebelum deployment publik, nonaktifkan pendaftaran terbuka atau buat akun hanya melalui administrator, lalu tambahkan role checks, pembatasan percobaan login, dan alur pemulihan akun.
