public class Karyawan {
    String id;
    String nama;
    String jenisKelamin;
    String jabatan;
    double gaji;

    void tampilkanDataDiri() {
        System.out.println("ID: " + id);
        System.out.println("Nama: " + nama);
        System.out.println("Jenis Kelamin: " + jenisKelamin);
        System.out.println("Jabatan: " + jabatan);
    }

    double lihatGaji() {
        return gaji;
    }
}
