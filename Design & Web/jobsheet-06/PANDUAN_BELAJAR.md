# Panduan Memahami Jobsheet 6

## Gambaran besar

Pada Jobsheet 5, data tabel sudah tertulis langsung di HTML. Pada Jobsheet 6, HTML hanya menyediakan tabel kosong. JavaScript meminta data dari file JSON, menunggu hasilnya, mengubah JSON menjadi object JavaScript, lalu membuat baris tabel secara dinamis.

Alur lengkapnya adalah:

```text
halaman dimuat
-> tampilkan indikator loading
-> fetch file JSON
-> periksa status response
-> parse response menjadi object JavaScript
-> buat dan masukkan baris tabel
-> tangani error jika gagal
-> sembunyikan indikator loading
```

## Konsep dasar

### AJAX

AJAX adalah teknik meminta atau mengirim data di belakang layar tanpa memuat ulang seluruh halaman. Nama historisnya menyebut XML, tetapi aplikasi modern sangat sering memakai JSON.

### JSON

JSON adalah format teks untuk pertukaran data. Sebuah file dapat berisi array `[]` yang di dalamnya memiliki beberapa object `{}`. Nama properti dan string harus memakai tanda kutip ganda. JSON tidak mengizinkan komentar.

```json
{
    "title": "Laskar Pelangi",
    "author": "Andrea Hirata",
    "year": 2005,
    "stock": 4
}
```

`title` dan `author` bertipe string. `year` dan `stock` bertipe number karena nilainya tidak memakai tanda kutip.

### Fetch dan Promise

`fetch(url)` langsung mengembalikan Promise, bukan langsung mengembalikan isi JSON. Promise menggambarkan hasil yang akan tersedia setelah proses asynchronous selesai.

```javascript
const response = await fetch("../data/buku.json");
```

`await` menunggu Promise selesai sebelum kode di baris berikutnya dilanjutkan. `await` hanya dapat digunakan di dalam fungsi `async`.

### Response dan parsing JSON

`fetch()` tidak otomatis melempar error hanya karena server menjawab 404. Karena itu, status harus diperiksa sendiri:

```javascript
if (!response.ok) {
    throw new Error(`Failed to retrieve data (status ${response.status})`);
}
```

Setelah response berhasil, `await response.json()` membaca body response dan mengubah teks JSON menjadi array/object JavaScript yang dapat diakses dengan `buku.title`, `buku.stock`, dan properti lain.

### Try catch finally

- `try` berisi proses yang mungkin gagal.
- `catch` dijalankan ketika fetch, pemeriksaan status, atau parsing gagal. Pengguna mendapat pesan error di dalam tabel.
- `finally` selalu dijalankan, baik proses berhasil maupun gagal. Karena itu, indikator loading disembunyikan di bagian ini agar tidak tersangkut selamanya.

## Cara buku.js dan anggota.js bekerja

Kedua file memakai pola yang sama. Perbedaannya hanya URL JSON dan property yang ditampilkan.

`buku.js` mengambil `data/buku.json`, lalu menampilkan `title`, `author`, `year`, dan `stock`. `anggota.js` mengambil `data/anggota.json`, lalu menampilkan `no_anggota`, `name`, `address`, dan `no_hp`.

File dipisahkan dari `app.js` karena `app.js` berisi perilaku umum yang dipakai banyak halaman. `buku.js` dan `anggota.js` hanya diperlukan oleh halaman list masing-masing.

## Mengapa event delegation diperlukan

Pada Jobsheet 5, tombol Delete sudah ada ketika `DOMContentLoaded` terjadi, sehingga JavaScript dapat langsung memasang listener pada setiap tombol. Pada Jobsheet 6, tombol baru dibuat setelah fetch selesai. Jika cara lama dipakai, tombol belum ada ketika listener dicari.

Solusinya adalah memasang satu listener pada `document`, yaitu parent yang selalu ada:

```javascript
document.addEventListener("click", function (event) {
    const button = event.target.closest(".btn-delete");
    if (!button) return;
    // proses baris yang memiliki tombol tersebut
});
```

Event dari tombol naik melalui DOM menuju `document`. Listener kemudian memeriksa apakah sumber klik berada di dalam `.btn-delete`. Karena listener berada pada elemen stabil, tombol yang baru dibuat setelah fetch tetap dapat bekerja.

## Hubungan dengan fitur Jobsheet 5

- Filter tetap bekerja karena listener dipasang pada search input yang sudah ada. Saat pengguna mengetik setelah data selesai dimuat, fungsi membaca semua baris yang baru dibuat.
- Delete tetap meminta konfirmasi, tetapi sekarang menggunakan event delegation.
- Menu hamburger dan validasi form tetap berada di `app.js` dan tidak berubah.

## Mengapa harus memakai local server

Alamat `file://` bukan lingkungan yang sama dengan aplikasi web melalui HTTP. Browser dapat melarang `fetch()` membaca file lokal lain karena aturan keamanan. Jalankan PHP server, Live Server, Laragon, atau server pengembangan setara, lalu buka halaman melalui `http://localhost:...`.

Ini bukan tanda bahwa kode fetch rusak. Ini adalah perbedaan antara membaca file lokal langsung dan melakukan HTTP request seperti aplikasi web sebenarnya.

## Kesalahan pada dokumen English yang diperbaiki

- Path `.. /data/buku.json` dan `.. /data/anggota.json` mengandung spasi hasil format/terjemahan; path validnya adalah `../data/...`.
- Contoh membuat `listBook` tetapi kemudian mencampur object `book` dan `buku`; kode memakai `daftarBuku` dan `buku` secara konsisten.
- Contoh anggota mencampur `listMember`, `member`, dan `anggota`; kode memakai `daftarAnggota` dan `anggota` secara konsisten.
- Event delegation membuat `const sure` tetapi memeriksa `yakin`; kode memakai satu variabel `yakin`.
- Pemanggilan fungsi hasil terjemahan tidak cocok dengan nama deklarasinya; listener sekarang memanggil fungsi yang benar.

## Batas tugas

Yang wajib sudah diimplementasikan: JSON, fetch, async/await, status check, parsing, loading state, error state, dynamic rendering, dan event delegation.

Latihan berikut berasal dari bagian opsional dan tidak dimasukkan ke submission:

1. Tombol Reload untuk memanggil ulang fungsi load.
2. Menggabungkan `buku.js` dan `anggota.js` menjadi fungsi generik.
3. Menambahkan kolom category ke JSON dan tabel.
4. Menambahkan logging event delegation.
5. Mengubah delay simulasi menjadi tiga detik.
