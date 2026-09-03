public class TestBarang {
    public static void main(String[] args) {
        Barang barang1 = new Barang();
        barang1.kode = "BRG001";
        barang1.namaBarang = "Keyboard";
        barang1.hargaDasar = 100000;
        barang1.diskon = 15;

        barang1.tampilData();
    }
}
