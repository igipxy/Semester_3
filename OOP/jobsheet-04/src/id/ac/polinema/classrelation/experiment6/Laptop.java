package id.ac.polinema.classrelation.experiment6;

public class Laptop {
    private String brand;

    public Laptop(String brand) {
        this.brand = brand;
    }

    public void printDocument(Printer printer, String fileName) {
        System.out.println(brand + " is sending a document to the printer...");
        printer.print(fileName);
    }
}
