public class PeminjamanGame {
    public int id;
    public String namaMember;
    public String namaGame;
    public int hargaPerHari;
    public int lamaSewa;
    public int totalBayar;

    public int hitungTotalBayar() {
        totalBayar = hargaPerHari * lamaSewa;
        return totalBayar;
    }

    public void tampilData() {
        System.out.println("ID             : " + id);
        System.out.println("Nama Member    : " + namaMember);
        System.out.println("Nama Game      : " + namaGame);
        System.out.println("Harga per Hari : Rp" + hargaPerHari);
        System.out.println("Lama Sewa      : " + lamaSewa + " hari");
        System.out.println("Total Bayar    : Rp" + hitungTotalBayar());
    }
}
