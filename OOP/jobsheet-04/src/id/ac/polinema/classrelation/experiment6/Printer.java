package id.ac.polinema.classrelation.experiment6;

public class Printer {
    private String brand;

    public Printer(String brand) {
        this.brand = brand;
    }

    public void print(String fileName) {
        System.out.println("[" + brand + "] Printing " + fileName + "...");
        System.out.println("[" + brand + "] Done.");
    }
}
