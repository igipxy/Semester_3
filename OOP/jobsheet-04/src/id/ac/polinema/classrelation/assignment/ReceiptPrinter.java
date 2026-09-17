package id.ac.polinema.classrelation.assignment;

public class ReceiptPrinter {
    public void printReceipt(String storeName, int quantity, int remainingStock) {
        System.out.println("=== SALES RECEIPT ===");
        System.out.println("Store: " + storeName);
        System.out.println("Quantity sold: " + quantity);
        System.out.println("Remaining stock: " + remainingStock);
    }
}
