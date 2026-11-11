package id.ac.polinema;

import java.util.ArrayList;
import java.util.List;

public abstract class Account {
    protected String accountNumber;
    protected Customer owner;
    protected double balance;
    private List<Transaction> history = new ArrayList<>();

    public Account(String accountNumber, Customer owner, double balance) {
        this.accountNumber = accountNumber;
        this.owner = owner;
        this.balance = balance;
    }

    public String getAccountNumber() {
        return accountNumber;
    }

    public Customer getOwner() {
        return owner;
    }

    public double getBalance() {
        return balance;
    }

    public List<Transaction> getHistory() {
        return history;
    }

    public boolean deposit(double amount) {
        if (amount <= 0) {
            return false;
        }
        balance += amount;
        history.add(new Transaction("DEPOSIT", amount));
        return true;
    }

    public void withdraw(double amount) throws InsufficientBalanceException {
        if (!canWithdraw(amount)) {
            throw new InsufficientBalanceException(
                    accountNumber + ": Insufficient balance for a withdrawal of " + amount);
        }
        balance -= amount;
        history.add(new Transaction("WITHDRAW", amount));
    }

    public abstract boolean canWithdraw(double amount);

    public abstract double monthlyFee();

    public void printInfo() {
        System.out.println(accountNumber + " - " + owner.getName() + " - Balance: " + balance);
    }
}
