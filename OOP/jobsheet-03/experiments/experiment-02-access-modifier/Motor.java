public class Motor {
    private int kecepatan = 0;
    private boolean kontakOn = false;

    public void nyalakanMesin() {
        kontakOn = true;
    }

    public void matikanMesin() {
        kontakOn = false;
        kecepatan = 0;
    }

    public void tambahKecepatan() {
        if (!kontakOn) {
            System.out.println("Kecepatan tidak bisa bertambah karena Mesin Off!\n");
        } else if (kecepatan < 100) {
            kecepatan = Math.min(kecepatan + 5, 100);
        } else {
            System.out.println("Kecepatan sudah mencapai batas maksimal 100.\n");
        }
    }

    public void kurangiKecepatan() {
        if (!kontakOn) {
            System.out.println("Kecepatan tidak bisa berkurang karena Mesin Off!\n");
        } else {
            kecepatan = Math.max(kecepatan - 5, 0);
        }
    }

    public void printStatus() {
        System.out.println(kontakOn ? "Kontak On" : "Kontak Off");
        System.out.println("Kecepatan " + kecepatan + "\n");
    }
}
