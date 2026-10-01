package id.ac.polinema.inheritance.exercise;

public class Tiket {
    protected String kodeTiket;
    protected String namaPenumpang;
    protected String asal;
    protected String tujuan;
    protected int hargaDasar;

    public Tiket() {
    }

    public Tiket(String kodeTiket, String namaPenumpang, String asal, String tujuan, int hargaDasar) {
        this.kodeTiket = kodeTiket;
        this.namaPenumpang = namaPenumpang;
        this.asal = asal;
        this.tujuan = tujuan;
        this.hargaDasar = hargaDasar;
    }

    public void tampilTiket() {
        System.out.println("Kode Tiket     = " + kodeTiket);
        System.out.println("Nama Penumpang = " + namaPenumpang);
        System.out.println("Rute           = " + asal + " - " + tujuan);
        System.out.println("Harga Dasar    = " + hargaDasar);
    }
}
