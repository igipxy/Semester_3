public class Main {
    public static void main(String[] args) {

        Battery battery = new Battery(16000);

        PatrolRobot pr = new PatrolRobot(
            "ASIMO", 2048, 150, battery
        );

        pr.increasePower();

        System.out.println("Name : " + pr.getName());
        System.out.println("CPUSpeed : " + pr.getCpuSpeed());
        System.out.println("Power : " + pr.getPower());
        System.out.println("BatteryCapacity : " + pr.getRobotBattery().getBatteryCapacity());
    }
}

