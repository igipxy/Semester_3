package id.ac.polinema.classrelation.experiment3;

public class MainQuestion {
    public static void main(String[] args) {
        Employee trainDriver = new Employee("1234", "Spongebob Squarepants");
        Train train = new Train("Gaya Baru", "Business", trainDriver);
        System.out.println(train.info());
    }
}
