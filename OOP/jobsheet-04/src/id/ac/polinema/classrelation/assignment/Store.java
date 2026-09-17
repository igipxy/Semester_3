package id.ac.polinema.classrelation.assignment;

public class Store {
    private final String name;
    private final Supplier supplier;
    private final Inventory inventory;

    public Store(String name, Supplier supplier, int initialStock) {
        this.name = name;
        this.supplier = supplier;
        this.inventory = new Inventory(initialStock);
    }

    public void showInfo() {
        System.out.println("Store: " + name);
        System.out.println("Supplier: " + supplier.getName());
        System.out.println("Stock: " + inventory.getStock());
    }

    public void completeSale(int quantity, ReceiptPrinter printer) {
        if (!inventory.removeStock(quantity)) {
            System.out.println("Sale rejected: invalid quantity or insufficient stock.");
            return;
        }
        printer.printReceipt(name, quantity, inventory.getStock());
    }
}
