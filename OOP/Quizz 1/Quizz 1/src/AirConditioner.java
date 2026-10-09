public class AirConditioner {
    private String brand;
    private int productionYear;
    private Compressor mainCompressor;
    private Remote remoteAc;

    
    public AirConditioner(
            String brand,
            int productionYear,
            Compressor mainCompressor,
            Remote remoteAc) {

        this.brand = brand;
        this.productionYear = productionYear;
        this.mainCompressor = mainCompressor;
        this.remoteAc = remoteAc;
    }

    
    public String getBrand() {
        return brand;
    }

    public void setBrand(String brand) {
        this.brand = brand;
    }

    
    public int getProductionYear() {
        return productionYear;
    }

    public void setProductionYear(int productionYear) {
        this.productionYear = productionYear;
    }

    
    public Compressor getMainCompressor() {
        return mainCompressor;
    }

    public void setMainCompressor(Compressor mainCompressor) {
        this.mainCompressor = mainCompressor;
    }

    
    public Remote getRemoteAc() {
        return remoteAc;
    }

    public void setRemoteAc(Remote remoteAc) {
        this.remoteAc = remoteAc;
    }
}