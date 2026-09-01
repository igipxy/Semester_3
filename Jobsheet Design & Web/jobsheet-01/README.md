# SIMPUS-Mini - Jobsheet 01

Proyek ini menyelesaikan Jobsheet Praktikum 01 menggunakan HTML5 murni, tanpa CSS, JavaScript, backend, atau database.

## Struktur folder

```text
jobsheet-01/
|-- index.html
|-- buku/
|   |-- list.html
|   `-- tambah.html
|-- anggota/
|   |-- list.html
|   `-- tambah.html
|-- README.md
`-- jawaban-pertanyaan.md
```

## Langkah menjalankan

1. Buka folder `jobsheet-01` di Visual Studio Code.
2. Buka `index.html` menggunakan browser atau ekstensi Live Server.
3. Klik kelima menu untuk memastikan seluruh halaman saling terhubung.
4. Periksa bahwa tabel buku berisi tujuh buku dan tabel anggota berisi dua anggota.
5. Pada halaman Tambah Buku, klik Simpan tanpa mengisi data. Browser harus menampilkan validasi untuk Judul, Pengarang, Tahun Terbit, dan Stok.
6. Pada halaman Tambah Anggota, klik Simpan tanpa mengisi data. Browser harus menampilkan validasi untuk Nama dan No. Anggota.
7. Isi Email dengan format yang salah untuk memeriksa validasi `type="email"`.

## Checklist hasil

- [x] `index.html` dapat dibuka.
- [x] Menu navigasi menghubungkan seluruh halaman.
- [x] Daftar buku menampilkan tabel dan tujuh data contoh.
- [x] Form tambah buku memiliki validasi `required`, `min`, dan `max`.
- [x] Daftar anggota menampilkan tabel, dua data contoh, dan kolom Tanggal Bergabung.
- [x] Form tambah anggota memiliki field Email bertipe `email`.
- [x] Seluruh path tautan mengarah ke file yang tersedia.
- [x] Struktur folder sesuai jobsheet.
- [x] Statistik beranda sesuai jumlah data dummy: 7 buku dan 2 anggota.

## Catatan

Tombol Edit dan Hapus memang belum berfungsi karena Jobsheet 01 hanya membahas HTML. Tombol Simpan juga belum menyimpan data karena form belum memiliki backend.
