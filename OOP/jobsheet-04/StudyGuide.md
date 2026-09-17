# Jobsheet 04 - Class Relationships

This submission implements all six experiments and the independent assignment from the worksheet. It uses Java packages under `id.ac.polinema.classrelation` and has been compiled and run with JDK 25 (the worksheet requires JDK 17 or newer).

## What this jobsheet teaches

The main idea is that an object can relate to another object in different ways. The important question is not only whether one class uses another, but how long it keeps the other object and who is responsible for creating it.

| Relationship | Is the related object stored as an attribute? | Who creates it? | Meaning |
|---|---:|---|---|
| Aggregation | Yes | Code outside the whole object | The part can exist independently and is injected into the whole. |
| Composition | Yes | The whole object itself | The part is owned by the whole and follows its lifecycle. |
| Dependency | No | Code outside the user object | The object is borrowed temporarily through a method parameter. |

A useful reading rule is:

- `private Processor proc;` plus a constructor/setter receiving `Processor` means aggregation.
- `this.engine = new Engine();` inside `Car` means composition.
- `printDocument(Printer printer, ...)` without a `Printer` attribute means dependency.

Multiplicity describes how many related objects exist. Fixed semantic roles such as `trainDriver` and `assistant` use separate attributes; a variable group of similar objects such as seats uses an array.

## Submission index

- `src/.../experiment1`: one-to-one aggregation (`Laptop` - `Processor`)
- `src/.../experiment2`: multiple aggregation (`Customer` - `Car` and `Driver`)
- `src/.../experiment3`: two named roles using the same class (`Train` - `Employee`)
- `src/.../experiment4`: multiplicity, composition, aggregation, and an occupied-seat guard
- `src/.../experiment5`: composition (`Car` creates its own `Engine`)
- `src/.../experiment6`: dependency (`Laptop` temporarily uses `Printer`)
- `src/.../assignment`: independent store case study with all three relationship types
- `docs/ANSWERS.md`: answers to every experiment question and the final reflection
- `docs/ASSIGNMENT.md`: class diagram and explanation for the independent assignment
- `docs/output`: verified text output and PNG output evidence

## How to compile and run

From `OOP/jobsheet-04` in PowerShell:

```powershell
.\run-all.ps1
```

The script compiles every `.java` file, runs Experiments 1-6 and the independent assignment, and refreshes the text files under `docs/output`.

To run one class manually after compiling:

```powershell
java -cp .build id.ac.polinema.classrelation.experiment4.MainExperiment4
```

## Verified output evidence

- [Experiment 1 output](docs/output/experiment-01.png)
- [Experiment 2 output](docs/output/experiment-02.png)
- [Experiment 3 output](docs/output/experiment-03.png)
- [Experiment 3 guard-clause output](docs/output/experiment-03-no-assistant.png)
- [Experiment 4 output](docs/output/experiment-04.png)
- [Experiment 5 output](docs/output/experiment-05.png)
- [Experiment 6 output](docs/output/experiment-06.png)
- [Independent assignment output](docs/output/independent-assignment.png)

## Recommended learning order

1. Compare Experiment 1 with Experiment 5. Both contain an object attribute, but only Experiment 5 creates the part internally.
2. Read Experiment 2 to see one class aggregate two different object types.
3. Read Experiment 3 to understand `null`, `NullPointerException`, and guard clauses.
4. Read Experiment 4 to see why one-to-many multiplicity needs an array and why ownership is independent of using an array.
5. Read Experiment 6 last: the absence of a `Printer` attribute is what makes the relationship a dependency.

The final code is intentionally safe: Experiment 3 includes the worksheet's guard clause, and Experiment 4 includes the assignment's occupied-seat check so Budi cannot silently replace Mr. Krab.
