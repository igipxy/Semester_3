package id.ac.polinema;

public class CheckingAccount extends Account {
    private double overdraftLimit;

    public CheckingAccount(String accountNumber, Customer owner, double balance, double overdraftLimit) {
        super(accountNumber, owner, balance);
        this.overdraftLimit = overdraftLimit;
    }

    public double getOverdraftLimit() {
        return overdraftLimit;
    }

    @Override
    public boolean canWithdraw(double amount) {
        return amount > 0 && (balance + overdraftLimit) >= amount;
    }

    @Override
    public double monthlyFee() {
        return 10000;
    }
}
