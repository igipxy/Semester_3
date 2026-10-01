package id.ac.polinema.inheritance.experiment6;

public class Inheritance1 {
    public static void main(String[] args) {
        StaffTetap staffTetap = new StaffTetap(
                "Budi", "Malang", "Laki-laki", 20,
                2_000_000, 200_000, 250_000, "2A", 100_000);
        staffTetap.tampilStaffTetap();

        StaffHarian staffHarian = new StaffHarian(
                "Indah", "Malang", "Perempuan", 27,
                10_000, 100_000, 50_000, 100);
        staffHarian.tampilStaffHarian();
    }
}
