# Jawaban Pertanyaan Pemahaman

1. **Apa fungsi `<!DOCTYPE html>`?**  
   Memberi tahu browser bahwa dokumen menggunakan standar HTML5, sehingga browser merender halaman dalam standard mode.

2. **Apa perbedaan `<header>`, `<main>`, dan `<footer>`?**  
   `<header>` berisi bagian pembuka seperti judul dan navigasi. `<main>` berisi konten utama yang unik pada halaman. `<footer>` berisi bagian penutup seperti informasi hak cipta.

3. **Mengapa halaman di folder `buku` menggunakan `../index.html` untuk kembali ke beranda?**  
   Karena `..` berarti naik satu tingkat dari folder `buku` ke folder utama `jobsheet-01`, tempat `index.html` berada.

4. **Apa perbedaan `<th>` dan `<td>`?**  
   `<th>` membuat sel judul atau header tabel, sedangkan `<td>` membuat sel data biasa.

5. **Mengapa tombol Edit/Hapus menggunakan `type="button"`?**  
   Agar tombol tidak mengirim form secara otomatis. Pada jobsheet ini tombol hanya menjadi tampilan dan belum memiliki fungsi JavaScript atau backend.

6. **Apa fungsi atribut `required`?**  
   Menandai input yang wajib diisi. Browser akan mencegah pengiriman form dan menampilkan peringatan jika input tersebut kosong.

7. **Apa perbedaan `id` dan `name` pada input?**  
   `id` adalah identitas unik elemen di halaman dan dapat dihubungkan dengan atribut `for` pada `<label>`. `name` adalah nama kunci data yang digunakan ketika nilai form dikirim.

8. **Mengapa No. Anggota menggunakan `type="text"`, bukan `type="number"`?**  
   Karena nomor anggota dapat mengandung huruf dan angka, misalnya `A001`. Input bertipe `number` tidak menerima huruf.

9. **Apa yang terjadi ketika tombol Simpan ditekan walaupun form belum memiliki `action`?**  
   Setelah validasi berhasil, browser mengirim form ke URL halaman yang sama. Karena tidak ada backend yang memproses data, data tidak tersimpan dan halaman biasanya dimuat ulang. Jika field wajib belum valid, pengiriman dibatalkan dan browser menampilkan pesan validasi.
