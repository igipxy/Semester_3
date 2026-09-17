package id.ac.polinema.classrelation.experiment4;

public class MainExperiment4 {
    public static void main(String[] args) {
        Passenger p = new Passenger("12345", "Mr. Krab");
        Passenger budi = new Passenger("67890", "Budi");
        Carriage carriage = new Carriage("A", 10);

        carriage.setPassenger(p, 1);
        carriage.setPassenger(budi, 1);
        System.out.println(carriage.info());
    }
}
