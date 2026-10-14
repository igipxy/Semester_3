public class PatrolRobot extends Robot {
    private Battery robotBattery;

    public PatrolRobot(String name, int cpuSpeed, int power, Battery robotBattery) {
        super(name, cpuSpeed, power);
        this.robotBattery = robotBattery;
    }

    public void increasePower() {
        setPower(getPower() + 20);
    }

    public Battery getRobotBattery() {
        return robotBattery;
    }
}