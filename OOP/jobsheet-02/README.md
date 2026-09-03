# Jobsheet 02 - Class and Object

This folder is organized in the same order as the jobsheet so each requirement can be graded quickly.

## Grading Index

| Section | Deliverable | Files |
|---|---|---|
| Experiment 1 | Employee class diagram and implementation | [Karyawan.java](experiments/experiment-01-class-diagram/Karyawan.java), [class diagram DOCX](experiments/experiment-01-class-diagram/Jobsheet-02-4.1-Class-Diagram.docx) |
| Experiment 2 | Create and access class members | [Mahasiswa.java](experiments/experiment-02-class-members/Mahasiswa.java), [TestMahasiswa.java](experiments/experiment-02-class-members/TestMahasiswa.java) |
| Experiment 3 | Method with an argument and return value | [Barang.java](experiments/experiment-03-return-value/Barang.java), [TestBarang.java](experiments/experiment-03-return-value/TestBarang.java) |
| Assignments 1-2 | Video-game rental diagram and program | [PeminjamanGame.java](assignments/assignment-01-02-game-rental/PeminjamanGame.java), [TestPeminjamanGame.java](assignments/assignment-01-02-game-rental/TestPeminjamanGame.java) |
| Assignment 3 | Circle calculations | [Lingkaran.java](assignments/assignment-03-circle/Lingkaran.java), [TestLingkaran.java](assignments/assignment-03-circle/TestLingkaran.java) |
| Assignment 4 | Product discount calculation | [Barang.java](assignments/assignment-04-discounted-product/Barang.java), [TestBarang.java](assignments/assignment-04-discounted-product/TestBarang.java) |
| Submission document | Code screenshots and verified outputs | [Download DOCX](assignments/submission/Jobsheet-02-4.2-Assignments-Code-Screenshots.docx) |

## Detailed Notes

- [Experiment notes and expected behavior](experiments/README.md)
- [Assignment diagrams, formulas, and outputs](assignments/README.md)

## Folder Structure

```text
jobsheet-02/
|-- experiments/
|   |-- experiment-01-class-diagram/
|   |-- experiment-02-class-members/
|   `-- experiment-03-return-value/
`-- assignments/
    |-- assignment-01-02-game-rental/
    |-- assignment-03-circle/
    |-- assignment-04-discounted-product/
    `-- submission/
```

Each runnable exercise keeps its class and test class together. This also prevents the two different `Barang` classes from conflicting with each other.
