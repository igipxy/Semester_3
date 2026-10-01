package id.ac.polinema.inheritance.exercise;

public class TestTiket {
    public static void main(String[] args) {
        // Required no-argument-constructor example; attributes are assigned one by one.
        TiketKereta kereta = new TiketKereta();
        kereta.kodeTiket = "KA-001";
        kereta.namaPenumpang = "Andi";
        kereta.asal = "Malang";
        kereta.tujuan = "Jakarta";
        kereta.hargaDasar = 350_000;
        kereta.nomorGerbong = 3;
        kereta.nomorKursi = "12A";
        kereta.tampilKereta();

        TiketDomestik domestik = new TiketDomestik(
                "GA-102", "Sinta", "Surabaya", "Denpasar", 900_000,
                "Garuda Indonesia", 25, 75_000);
        domestik.tampilDomestik();

        TiketInternasional internasional = new TiketInternasional(
                "SQ-205", "Budi", "Jakarta", "Singapura", 2_500_000,
                "Singapore Airlines", 20, "C1234567", 150_000);
        internasional.tampilInternasional();
    }
}
