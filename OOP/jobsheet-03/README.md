# Jobsheet 03 - Encapsulation

This folder follows the order of the jobsheet so every experiment, question, and assignment can be checked quickly.

## Grading Index

| Section | Deliverable | Files |
|---|---|---|
| Experiment 1 | Uncontrolled public attributes | [Motor.java](experiments/experiment-01-uncontrolled-access/Motor.java), [MotorDemo.java](experiments/experiment-01-uncontrolled-access/MotorDemo.java) |
| Experiment 2 | Private attributes and controlled motor methods | [Motor.java](experiments/experiment-02-access-modifier/Motor.java), [MotorDemo.java](experiments/experiment-02-access-modifier/MotorDemo.java) |
| Experiment 3 | Getter and setter | [Anggota.java](experiments/experiment-03-getter-setter/Anggota.java), [KoperasiDemo.java](experiments/experiment-03-getter-setter/KoperasiDemo.java) |
| Experiment 4 | Constructor and parameter passing | [Anggota.java](experiments/experiment-04-constructor/Anggota.java), [KoperasiDemo.java](experiments/experiment-04-constructor/KoperasiDemo.java) |
| Tasks 1-3 | Age output, explanation, and 18-30 validation | [EncapDemo.java](assignments/assignment-01-03-age-validation/EncapDemo.java), [EncapTest.java](assignments/assignment-01-03-age-validation/EncapTest.java) |
| Tasks 4-6 | Container capacity, 50% unloading rule, and Scanner input | [Kontainer.java](assignments/assignment-04-06-logistics/Kontainer.java), [TestLogistik.java](assignments/assignment-04-06-logistics/TestLogistik.java), [TestLogistikScanner.java](assignments/assignment-04-06-logistics/TestLogistikScanner.java) |
| Task 7 | Secure movie-ticket payment state | [Tiket.java](assignments/assignment-07-movie-ticket/Tiket.java), [TestBioskop.java](assignments/assignment-07-movie-ticket/TestBioskop.java) |
| Written answers | Experiment questions, task explanations, and verified outputs | [ANSWERS.md](docs/ANSWERS.md) |

## Folder Structure

```text
jobsheet-03/
|-- README.md
|-- docs/
|   `-- ANSWERS.md
|-- experiments/
|   |-- README.md
|   |-- experiment-01-uncontrolled-access/
|   |-- experiment-02-access-modifier/
|   |-- experiment-03-getter-setter/
|   `-- experiment-04-constructor/
`-- assignments/
    |-- README.md
    |-- assignment-01-03-age-validation/
    |-- assignment-04-06-logistics/
    `-- assignment-07-movie-ticket/
```

## Running the Programs

Open a terminal in one exercise folder, then compile and run its driver class. Example:

```bash
javac EncapDemo.java EncapTest.java
java EncapTest
```

Each exercise is isolated so classes with the same name, such as the two versions of `Motor` and `Anggota`, do not conflict.

The earlier `experiments/motorencapsulation/` upload is retained unchanged as the original NetBeans-style Experiment 1. The numbered folder is the submission-organized copy.

