public class Robot {
    private String name;
    private int cpuSpeed;
    private int power;

    public Robot(String name, int cpuSpeed, int power) {
        this.name = name;
        this.cpuSpeed = cpuSpeed;
        this.power = power;
    }

    public void increasePower() {
        power += 10;
    }

    public void reducePower() {
        power -= 10;
    }

    public String getName() {
        return name;
    }

    public int getCpuSpeed() {
        return cpuSpeed;
    }

    public int getPower() {
        return power;
    }

    public void setPower(int power) {
        this.power = power;
    }
}