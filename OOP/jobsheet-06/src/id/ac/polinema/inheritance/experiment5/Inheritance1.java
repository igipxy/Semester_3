package id.ac.polinema.inheritance.experiment5;

public class Inheritance1 {
    public static void main(String[] args) {
        Manager manager = new Manager();
        manager.nama = "Vivin";
        manager.alamat = "Jl. Vinolia";
        manager.umur = 25;
        manager.jk = "Perempuan";
        manager.gaji = 3_000_000;
        manager.tunjangan = 1_000_000;
        manager.tampilDataManager();

        Staff staff = new Staff();
        staff.nama = "Lestari";
        staff.alamat = "Malang";
        staff.umur = 25;
        staff.jk = "Perempuan";
        staff.gaji = 2_000_000;
        staff.lembur = 500_000;
        staff.potongan = 250_000;
        staff.tampilDataStaff();
    }
}
