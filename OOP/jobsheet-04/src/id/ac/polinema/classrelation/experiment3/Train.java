package id.ac.polinema.classrelation.experiment3;

public class Train {
    private String name;
    private String trainClass;
    private Employee trainDriver;
    private Employee assistant;

    public Train(String name, String trainClass, Employee trainDriver) {
        this.name = name;
        this.trainClass = trainClass;
        this.trainDriver = trainDriver;
    }

    public Train(String name, String trainClass, Employee trainDriver, Employee assistant) {
        this.name = name;
        this.trainClass = trainClass;
        this.trainDriver = trainDriver;
        this.assistant = assistant;
    }

    public void setTrainDriver(Employee trainDriver) {
        this.trainDriver = trainDriver;
    }

    public Employee getTrainDriver() {
        return trainDriver;
    }

    public void setAssistant(Employee assistant) {
        this.assistant = assistant;
    }

    public Employee getAssistant() {
        return assistant;
    }

    public String info() {
        String info = "";
        info += "Name: " + name + "\n";
        info += "Class: " + trainClass + "\n";
        info += "Train Driver: " + trainDriver.info() + "\n";
        if (assistant != null) {
            info += "Assistant: " + assistant.info() + "\n";
        }
        return info;
    }
}
