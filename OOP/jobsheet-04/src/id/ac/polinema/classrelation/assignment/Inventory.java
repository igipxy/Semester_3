package id.ac.polinema.classrelation.assignment;

public class Inventory {
    private int stock;

    public Inventory(int initialStock) {
        if (initialStock < 0) {
            throw new IllegalArgumentException("Initial stock cannot be negative.");
        }
        this.stock = initialStock;
    }

    public int getStock() {
        return stock;
    }

    public boolean removeStock(int quantity) {
        if (quantity <= 0 || quantity > stock) {
            return false;
        }
        stock -= quantity;
        return true;
    }
}
