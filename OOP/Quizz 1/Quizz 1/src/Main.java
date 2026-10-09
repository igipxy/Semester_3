public class Main {
    public static void main(String[] args) {

        Compressor comp = new Compressor("R32", 1000);
        Remote rmt = new Remote("English", 2);

        AirConditioner ac = new AirConditioner("Daikin", 2019, comp, rmt);

        System.out.println("AC Brand: " + ac.getBrand());

        System.out.println("Compressor Capacity: " + ac.getMainCompressor().getCapacity());

        System.out.println("Remote Language: " + ac.getRemoteAc().getLanguage());
    }
}