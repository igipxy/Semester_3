package id.ac.polinema.classrelation.assignment;

public class MainAssignment {
    public static void main(String[] args) {
        Supplier supplier = new Supplier("Nusantara Supplies");
        Store store = new Store("Campus Mart", supplier, 20);
        ReceiptPrinter printer = new ReceiptPrinter();

        store.showInfo();
        System.out.println();
        store.completeSale(3, printer);
    }
}
