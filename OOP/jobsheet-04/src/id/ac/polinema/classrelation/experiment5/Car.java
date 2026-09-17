package id.ac.polinema.classrelation.experiment5;

public class Car {
    private String brand;
    private Engine engine;

    public Car(String brand) {
        this.brand = brand;
        this.engine = new Engine();
    }

    public void displayInfo() {
        System.out.println("Car: " + brand);
        System.out.println("Engine: " + engine.getType());
    }
}
