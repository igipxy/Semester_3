public class TestLingkaran {
    public static void main(String[] args) {
        Lingkaran lingkaran1 = new Lingkaran();
        lingkaran1.r = 7;

        System.out.println("Jari-jari          : " + lingkaran1.r);
        System.out.println("Luas lingkaran     : " + lingkaran1.hitungLuas());
        System.out.println("Keliling lingkaran : " + lingkaran1.hitungKeliling());
    }
}
