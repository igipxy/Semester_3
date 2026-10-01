package id.ac.polinema.inheritance.exercise;

public class TiketPesawat extends Tiket {
    protected String maskapai;
    protected int beratBagasi;

    public TiketPesawat() {
    }

    public TiketPesawat(String kodeTiket, String namaPenumpang, String asal, String tujuan,
            int hargaDasar, String maskapai, int beratBagasi) {
        super(kodeTiket, namaPenumpang, asal, tujuan, hargaDasar);
        this.maskapai = maskapai;
        this.beratBagasi = beratBagasi;
    }

    public int hitungBiayaBagasi() {
        int kelebihanBagasi = Math.max(0, beratBagasi - 20);
        return kelebihanBagasi * 50_000;
    }

    public void tampilPesawat() {
        super.tampilTiket();
        System.out.println("Maskapai       = " + maskapai);
        System.out.println("Berat Bagasi   = " + beratBagasi + " kg");
        System.out.println("Biaya Bagasi   = " + hitungBiayaBagasi());
    }
}
