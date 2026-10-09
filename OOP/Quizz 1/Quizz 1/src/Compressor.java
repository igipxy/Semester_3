public class Compressor {
    private String type;
    private int capacity;

    
    public Compressor(String type, int capacity) {
        this.type = type;
        this.capacity = capacity;
    }

    
    public String getType() {
        return type;
    }

    public void setType(String type) {
        this.type = type;
    }

    
    public int getCapacity() {
        return capacity;
    }

    public void setCapacity(int capacity) {
        this.capacity = capacity;
    }
}