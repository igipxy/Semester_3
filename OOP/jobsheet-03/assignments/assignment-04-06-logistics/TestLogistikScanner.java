import java.util.Scanner;

public class TestLogistikScanner {
    public static void main(String[] args) {
        Scanner input = new Scanner(System.in);
        Kontainer kontainer = new Kontainer("REO-9988", "PT. Maju Bersama", 5000);

        System.out.print("Masukkan berat muatan yang akan ditambahkan (kg): ");
        double beratTambah = input.nextDouble();
        kontainer.tambahMuatan(beratTambah);
        System.out.println("Berat muatan saat ini: "
                + kontainer.getBeratMuatanSaatIni() + " kg");

        System.out.print("Masukkan berat muatan yang akan diturunkan (kg): ");
        double beratTurun = input.nextDouble();
        kontainer.turunkanMuatan(beratTurun);
        System.out.println("Berat muatan saat ini: "
                + kontainer.getBeratMuatanSaatIni() + " kg");

        input.close();
    }
}
