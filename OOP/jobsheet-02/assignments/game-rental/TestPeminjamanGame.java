public class TestPeminjamanGame {
    public static void main(String[] args) {
        PeminjamanGame rental1 = new PeminjamanGame();
        rental1.id = 1;
        rental1.namaMember = "Raka";
        rental1.namaGame = "Minecraft";
        rental1.hargaPerHari = 15000;
        rental1.lamaSewa = 3;

        rental1.tampilData();
    }
}
