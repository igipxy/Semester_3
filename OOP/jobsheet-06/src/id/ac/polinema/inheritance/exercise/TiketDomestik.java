package id.ac.polinema.inheritance.exercise;

public class TiketDomestik extends TiketPesawat {
    protected int pajakBandara;

    public TiketDomestik() {
    }

    public TiketDomestik(String kodeTiket, String namaPenumpang, String asal, String tujuan,
            int hargaDasar, String maskapai, int beratBagasi, int pajakBandara) {
        super(kodeTiket, namaPenumpang, asal, tujuan, hargaDasar, maskapai, beratBagasi);
        this.pajakBandara = pajakBandara;
    }

    public void tampilDomestik() {
        System.out.println("====== Tiket Pesawat Domestik ======");
        super.tampilPesawat();
        System.out.println("Pajak Bandara  = " + pajakBandara);
        System.out.println("Total Bayar    = " + (hargaDasar + hitungBiayaBagasi() + pajakBandara));
    }
}
