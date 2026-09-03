public class TestMahasiswa {
    public static void main(String[] args) {
        Mahasiswa mhs1 = new Mahasiswa();
        mhs1.nim = 101;
        mhs1.nama = "Testari";
        mhs1.alamat = "Jl. Winolia No. 1A";
        mhs1.kelas = "1A";
        mhs1.tampilBiodata();

        System.out.println();

        Mahasiswa mhs2 = new Mahasiswa();
        mhs2.nim = 102;
        mhs2.nama = "Siti Aminah";
        mhs2.alamat = "Jl. Melati No. 2";
        mhs2.kelas = "1B";
        mhs2.tampilBiodata();

        System.out.println();

        Mahasiswa mhs3 = new Mahasiswa();
        mhs3.nim = 103;
        mhs3.nama = "Budi Santoso";
        mhs3.alamat = "Jl. Mawar No. 3";
        mhs3.kelas = "1C";
        mhs3.tampilBiodata();
    }
}
