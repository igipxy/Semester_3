# Panduan Belajar Jobsheet 9 CRUD Penuh

Panduan ini menjelaskan penambahan Jobsheet 9 pada aplikasi SIMPUS-Mini. Kita mempertahankan tabel dan nama field dari Jobsheet 8: `buku` memakai `title`, `author`, `year`, `isbn`, `stock`, `category`; `anggota` memakai `name`, `member_number`, `address`, `mobile_number`, dan `email`.

## Gambaran alur

```text
Edit link -> edit.php?id=7 -> SELECT satu baris -> form berisi nilai lama
           -> POST proses_edit.php -> validasi -> UPDATE ... WHERE id=7
Delete button -> form POST -> JavaScript confirm -> hapus.php -> DELETE ... WHERE id=7
List -> GET pencarian q + page -> COUNT -> SELECT ... LIMIT 5 OFFSET ...
```

## Yang ditambahkan

Untuk setiap entitas, Jobsheet 9 menambahkan tiga file.

- `edit.php` mengambil ID dari URL, mengambil satu record lama dari PostgreSQL, lalu mengisi nilai awal pada form.
- `proses_edit.php` menerima form dengan POST, memeriksa ID dan field, lalu menjalankan prepared statement UPDATE yang dibatasi dengan WHERE id.
- `hapus.php` menolak request selain POST. ID berasal dari hidden input, lalu prepared DELETE menghapus satu baris dan redirect kembali dengan flash message.

### Mengapa ID diperlukan?

Create membuat record baru sehingga belum memiliki ID yang diketahui. Update dan Delete harus menunjuk ke satu record tertentu. Primary key `id` menjadi alamat record tersebut. Tanpa kondisi `WHERE id = :id`, UPDATE atau DELETE dapat mengenai semua record di tabel.

### Mengapa edit memiliki SELECT dan UPDATE?

Ketika pengguna membuka `edit.php?id=7`, halaman harus menampilkan nilai lama. Karena itu halaman menjalankan `SELECT * FROM buku WHERE id = :id` dan menggunakan `fetch()` untuk mengambil satu baris. Setelah tombol simpan ditekan, form mengirim nilai dan ID lewat POST. `proses_edit.php` kemudian menjalankan UPDATE dengan nilai yang sudah divalidasi.

### Mengapa hapus menggunakan POST?

GET dirancang untuk membaca halaman dan aman untuk diulang. Hapus mengubah database. Form dengan `method="post"` mengirim aksi perubahan melalui POST, sedangkan pemeriksaan `$_SERVER['REQUEST_METHOD']` menolak jika endpoint dibuka lewat URL biasa. Hidden input mengirim ID tanpa menampilkannya sebagai kontrol yang bisa diubah pengguna secara tidak sengaja.

## Perubahan file yang sudah ada

- `buku/list.php` dan `anggota/list.php` menampilkan tautan Edit ber-ID dan form Delete ber-POST. Query menghitung hasil pencarian lalu mengambil maksimum lima baris memakai `LIMIT` dan `OFFSET`.
- `assets/js/app.js` menangani event `submit` pada form Delete. Jika pengguna memilih Cancel, `preventDefault()` menghentikan request. Jika memilih OK, form tetap dikirim ke PHP agar database benar-benar menghapus data.
- `assets/css/style.css` menata tautan Edit seperti tombol, menjaga form Delete sejajar, menata pagination, dan menyusun form pencarian.
- `includes/header.php` dan `includes/footer.php` mengubah label versi menjadi Jobsheet 9; koneksi dan navigasi yang sudah ada tetap digunakan.
- `sql/01_buku_anggota.sql` memperjelas bahwa schema dijalankan terhadap database `web`; perintah tidak menghapus isi tabel karena menggunakan `IF NOT EXISTS`.
- `README.md` menjelaskan persiapan database dan cara menjalankan aplikasi.

## Pencarian dan pagination

Form pencarian menggunakan GET karena hanya membaca data. Nilai pencarian dikirim sebagai `q`, lalu PostgreSQL `ILIKE` mencari teks tanpa membedakan huruf besar atau kecil. Prepared statement tetap digunakan untuk nilai pencarian.

`$perPage = 5` membatasi jumlah baris per halaman. Rumus `$offset = ($page - 1) * $perPage` menghitung berapa baris awal dilewati. Misalnya halaman 2 melewati lima baris pertama. `PDO::PARAM_INT` memastikan LIMIT/OFFSET dikirim sebagai integer.

JavaScript filter cepat hanya mengatur tampilan baris yang sudah dikirim ke browser. Tombol Search menjalankan pencarian di server sehingga hasil pencarian mencakup seluruh halaman database. Pagination mempertahankan kata kunci agar pengguna dapat berpindah halaman hasil tanpa kehilangan pencarian.

## Validasi dan perlindungan data

Validasi browser memudahkan pengguna, tetapi dapat dilewati. Karena itu handler PHP memeriksa lagi data POST. Query memakai placeholder dan `execute()` agar teks pengguna tidak menjadi bagian dari perintah SQL. Saat nilai ditampilkan kembali dalam HTML, helper `e()` menerapkan `htmlspecialchars()`.

Untuk anggota, `member_number` memiliki constraint UNIQUE. Jika nomor tersebut sudah dipakai, PostgreSQL mengembalikan error duplicate key dan halaman memberi pesan yang bisa dimengerti. Field kosong opsional disimpan sebagai NULL.

## Urutan file saat request Edit

1. Browser membuka tautan `edit.php?id=7`.
2. PHP memeriksa ID, lalu melakukan SELECT dengan prepared statement.
3. `fetch()` mengambil satu baris; `e()` menampilkan nilainya dengan aman di form.
4. Form mengirim hidden ID dan field yang diedit lewat POST.
5. Handler memvalidasi semua nilai dan memastikan ID masih ada.
6. Prepared UPDATE dengan `WHERE id = :id` mengubah satu baris.
7. Flash message disimpan sementara pada session dan browser diarahkan ke daftar.

## Urutan Delete

1. Tombol Delete mengirim form POST yang membawa hidden ID.
2. JavaScript mendengar event submit dan meminta konfirmasi.
3. Cancel menjalankan `preventDefault()`; database tidak menerima request.
4. OK mengirim POST ke `hapus.php`.
5. PHP memeriksa method dan ID.
6. Prepared DELETE dengan `WHERE id = :id` menghapus satu baris.
7. Halaman kembali ke daftar dan menampilkan pesan hasil.

## Menjalankan dan mencoba

Gunakan database Jobsheet 8 bernama `web`. Pastikan PostgreSQL hidup, extension PHP `pdo_pgsql` aktif, dan username/password di `includes/koneksi.php` cocok dengan komputer Anda.

Dari folder jobsheet-09, schema hanya perlu dijalankan bila tabel belum ada:

```text
psql -U postgres -d web -f sql/01_buku_anggota.sql
```

Kemudian jalankan melalui Laragon atau dari folder proyek:

```text
php -S localhost:8000
```

Coba alur lengkap pada record uji: tambah buku/anggota, ubah satu field, cari dengan kata kunci yang berbeda kapitalisasi, tambahkan lebih dari lima baris untuk mencoba halaman 2, klik Delete lalu Cancel, lalu hapus record uji dengan OK. Pastikan URL langsung ke `hapus.php` tidak menghapus data karena request bukan POST.

## Status pemeriksaan

Pemeriksaan sintaks PHP dan JavaScript memeriksa struktur kode, tetapi tidak membuktikan bahwa koneksi database lokal berhasil. Uji CRUD sesungguhnya memerlukan PostgreSQL aktif, schema tersedia, dan password lokal yang benar. Gunakan data uji yang boleh diubah atau dihapus.
