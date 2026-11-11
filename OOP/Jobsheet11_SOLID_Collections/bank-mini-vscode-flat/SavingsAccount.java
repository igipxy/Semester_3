public class SavingsAccount extends Account implements InterestBearing {
    private static final double MINIMUM_BALANCE = 50000;
    private double interestRate;

    public SavingsAccount(String accountNumber, Customer owner, double balance, double interestRate) {
        super(accountNumber, owner, balance);
        this.interestRate = interestRate;
    }

    public double getInterestRate() {
        return interestRate;
    }

    @Override
    public boolean canWithdraw(double amount) {
        return amount > 0 && (balance - amount) >= MINIMUM_BALANCE;
    }

    @Override
    public void applyInterest() {
        deposit(balance * interestRate);
    }

    @Override
    public double monthlyFee() {
        return 5000;
    }
}
