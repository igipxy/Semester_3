public class Remote {
    private String language;
    private int batteryNumber;

    
    public Remote(String language, int batteryNumber) {
        this.language = language;
        this.batteryNumber = batteryNumber;
    }

    public String getLanguage() {
        return language;
    }

    public void setLanguage(String language) {
        this.language = language;
    }
    
    public int getBatteryNumber() {
        return batteryNumber;
    }

    public void setBatteryNumber(int batteryNumber) {
        this.batteryNumber = batteryNumber;
    }
}