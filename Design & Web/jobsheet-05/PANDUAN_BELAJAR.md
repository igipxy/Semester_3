# Panduan Memahami Jobsheet 5

## Gambaran besar

HTML membentuk isi halaman, CSS mengatur tampilannya, dan JavaScript mengatur perilakunya. JavaScript bekerja melalui DOM, yaitu representasi halaman HTML sebagai kumpulan objek. Ketika pengguna melakukan sesuatu, browser menghasilkan event. Event listener menunggu event tersebut lalu menjalankan fungsi.

Pola utama jobsheet ini adalah:

```text
pilih elemen DOM -> pasang event listener -> ubah DOM
```

Contoh: JavaScript memilih tombol hamburger, menunggu event `click`, lalu menambah atau menghapus class `nav-open` pada elemen navigasi.

## Istilah penting

- `document.getElementById()` memilih satu elemen berdasarkan `id`.
- `document.querySelector()` memilih elemen pertama yang cocok dengan selector CSS.
- `document.querySelectorAll()` memilih semua elemen yang cocok.
- `addEventListener()` memasang reaksi terhadap event seperti `click`, `keyup`, atau `submit`.
- `classList.toggle()` menambah class jika belum ada dan menghapusnya jika sudah ada.
- Guard clause seperti `if (!element) return;` menghentikan fungsi dengan aman jika elemen tidak tersedia pada suatu halaman.
- `textContent` membaca isi teks sebuah elemen.
- `style.display = "none"` menyembunyikan elemen tanpa menghapusnya dari DOM.
- `remove()` benar-benar menghapus elemen dari DOM halaman saat ini.
- `preventDefault()` membatalkan perilaku bawaan event, misalnya mencegah form dikirim ketika data tidak valid.

## Cara setiap fitur bekerja

### Menu hamburger

`initNavToggle()` mengambil tombol `#nav-toggle-btn` dan elemen `header nav`. Saat tombol diklik, class `nav-open` di-toggle. Pada layar maksimal 480 piksel, CSS hanya menampilkan navigasi jika class tersebut ada.

### Konfirmasi hapus

`initHapusConfirm()` memilih semua tombol `.btn-hapus`. Ketika salah satu diklik, `closest("tr")` mencari baris tabel yang menaungi tombol. `confirm()` meminta keputusan pengguna. Jika pengguna memilih OK, `row.remove()` menghapus baris dari DOM.

Penghapusan ini belum permanen. Data muncul lagi setelah refresh karena tidak ada database atau server yang diubah.

### Filter tabel real-time

`initTableFilter()` membaca nilai `#search-input` setiap event `keyup`. Nilai input dan teks setiap baris diubah menjadi huruf kecil agar pencarian tidak case-sensitive. Baris yang tidak mengandung kata kunci disembunyikan; ketika input dikosongkan, semua baris muncul kembali.

### Validasi form

`initValidasiForm()` menunggu event `submit`. Fungsi memeriksa field wajib, rentang tahun 1900-2026, dan stok minimal nol. Jika ada data salah, JavaScript membuat `<span class="error">` setelah input, menandainya dengan `aria-invalid`, memindahkan fokus ke error pertama, dan memanggil `preventDefault()`.

Kedua form memakai `id="form-tambah"` karena mereka berada di halaman berbeda; sebuah ID harus unik hanya di dalam satu halaman. Atribut `novalidate` digunakan agar browser tidak menghentikan proses lebih dulu dengan pesan validasi bawaan, sehingga pesan DOM buatan jobsheet dapat terlihat dan diuji.

## Mengapa satu app.js aman untuk semua halaman

Tidak semua halaman memiliki tabel, search field, atau form. Setiap fungsi inisialisasi memakai guard clause. Karena itu, fungsi khusus tabel berhenti dengan aman pada halaman Home, sedangkan fungsi validasi berhenti pada halaman list. Setelah event `DOMContentLoaded`, semua fungsi inisialisasi dipanggil dari satu tempat.

## Kesalahan pada dokumen English yang sudah diperbaiki

- Dokumen mencampur `.btn-delete` dan `.btn-hapus`; tombol pada proyek memiliki keduanya, sementara JavaScript memakai `.btn-hapus` dari contoh kode lengkap.
- Dokumen mencampur `form-plus`, `form-add`, dan `form-tambah`; proyek memakai `form-tambah` dari contoh kode lengkap.
- Contoh membuat `const sure` tetapi memeriksa `yakin`; proyek memakai satu variabel `yakin` secara konsisten.
- Contoh memeriksa `else if (judul)` setelah membuat variabel `title`; proyek menghapus ketidaksesuaian itu.
- Bagian validasi lengkap di dokumen masih menggunakan komentar singkat untuk author, year, dan stock; proyek mengimplementasikan pemeriksaan tersebut sepenuhnya.

## Batas keamanan

HTML validation dan JavaScript validation sama-sama berjalan di sisi client dan dapat dilewati. Keduanya membantu pengalaman pengguna, bukan menjadi perlindungan keamanan. Data penting tetap harus divalidasi lagi di server pada jobsheet backend berikutnya.

## Latihan tambahan opsional dari jobsheet

Bagian ini bukan tugas wajib dan tidak diimplementasikan pada versi submission:

1. Memvalidasi format ISBN.
2. Menambahkan animasi buka-tutup menu.
3. Membatasi pencarian hanya pada kolom tertentu.
4. Menampilkan penghitung jumlah baris setelah filter atau delete.
5. Melakukan refactor validasi menggunakan array dan perulangan.
