# Practicum Jobsheet 11: SOLID Principle and Collections (RTI253008)

- **Name**: Gesangrah Swandaru Pratama
- **NIM**: 254107020178
- **Class**: TI-2I

## Folder Structure

1. `bank-mini-package/`: Standard NetBeans / CLI package structure (`src/id/ac/polinema/*.java` with `package id.ac.polinema;`).
   ```bash
   cd bank-mini-package
   javac -d out src/id/ac/polinema/*.java
   java -cp out id.ac.polinema.Main
   ```
2. `bank-mini-vscode-flat/`: Flat single-folder structure (without `package` declarations) for one-click execution in VS Code:
   ```bash
   cd bank-mini-vscode-flat
   javac *.java
   java Main
   ```

## Expected Console Output (Step 3 + Independent Assignment)

```text
Withdrawal failed: A003: Insufficient balance for a withdrawal of 70000.0
Withdrawal succeeded, new balance: 70000.0
A001 interest applied, new balance: 505000.0
A001 monthly fee: 5000.0
A002 monthly fee: 10000.0
A003 interest applied, new balance: 71400.0
A003 monthly fee: 5000.0
A003 WITHDRAW 30000.0
A003 DEPOSIT 1400.0
Total assets: 776400.0
```
