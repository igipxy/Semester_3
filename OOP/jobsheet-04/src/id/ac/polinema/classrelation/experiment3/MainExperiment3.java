package id.ac.polinema.classrelation.experiment3;

public class MainExperiment3 {
    public static void main(String[] args) {
        Employee trainDriver = new Employee("1234", "Spongebob Squarepants");
        Employee assistant = new Employee("4567", "Patrick Star");
        Train train = new Train("Gaya Baru", "Business", trainDriver, assistant);
        System.out.println(train.info());
    }
}
