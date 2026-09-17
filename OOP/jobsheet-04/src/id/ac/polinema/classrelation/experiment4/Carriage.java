package id.ac.polinema.classrelation.experiment4;

public class Carriage {
    private String code;
    private Seat[] seatArray;

    public Carriage(String code, int count) {
        this.code = code;
        this.seatArray = new Seat[count];
        initSeats();
    }

    private void initSeats() {
        for (int i = 0; i < seatArray.length; i++) {
            seatArray[i] = new Seat(String.valueOf(i + 1));
        }
    }

    public boolean setPassenger(Passenger passenger, int number) {
        if (number < 1 || number > seatArray.length) {
            System.out.println("Seat " + number + " does not exist.");
            return false;
        }

        Seat selectedSeat = seatArray[number - 1];
        if (selectedSeat.getPassenger() != null) {
            System.out.println("Seat " + number + " is already occupied.");
            return false;
        }

        selectedSeat.setPassenger(passenger);
        return true;
    }

    public String info() {
        String info = "";
        info += "Code: " + code + "\n";
        for (Seat seat : seatArray) {
            info += seat.info();
        }
        return info;
    }
}
