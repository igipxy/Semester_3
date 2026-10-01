# Study Guide - Understanding Inheritance

## The big idea

Inheritance models an **is-a** relationship. A `Manager` is a `Karyawan`, and a `TiketDomestik` is a `TiketPesawat` and also a `Tiket`. The child class reuses accessible state and behavior from its parent while adding more specific features.

```java
public class Manager extends Karyawan {
    // Manager inherits accessible Karyawan members.
}
```

Do not use inheritance only to avoid duplicated code. The child must genuinely be a more specific form of the parent. A relationship such as "car has an engine" is composition, not inheritance.

## Important vocabulary

- **Superclass / parent / base class:** the general class being extended.
- **Subclass / child / derived class:** the more specific class after `extends`.
- **Inherited member:** a field or method made available to the child by the parent.
- **Constructor chaining:** running parent constructors before child constructors.
- **Method reuse:** calling a parent's implementation through `super.method()`.

## Types practiced in this jobsheet

| Type | Shape | Example |
|---|---|---|
| Single | One child has one direct parent | `Manager extends Karyawan` |
| Hierarchical | Several children share one parent | `Manager` and `Staff` extend `Karyawan` |
| Multilevel | A child becomes a parent of another class | `Karyawan -> Staff -> StaffTetap` |
| Hybrid | A combination of inheritance shapes | The Experiment 6 and ticket hierarchies combine hierarchical and multilevel inheritance |

Java classes cannot directly extend multiple classes. A class may implement multiple interfaces, but that is a different mechanism.

## Access modifiers and inheritance

| Modifier | Directly accessible in the child? | Practical meaning |
|---|---:|---|
| `private` | No | Only the declaring class can access it directly. Use a getter, setter, or protected method. |
| package-private | Only in the same package | No keyword is written. |
| `protected` | Yes | Available to subclasses and the same package. |
| `public` | Yes | Available everywhere. |

Experiment 2 is important: `extends` does not make a parent's private fields directly accessible. The submitted solution keeps `x` and `y` private and provides protected getters, preserving encapsulation.

## `super` versus `this`

- `this.member` refers to the current object's class-level view.
- `super.member` explicitly refers to an accessible parent member.
- `super.method()` calls the parent implementation.
- `super(...)` calls a parent constructor and must be the first constructor statement.

Constructors are not inherited. When `new ClassC()` runs in Experiment 4, Java initializes the object from the top of the hierarchy: `ClassA`, then `ClassB`, then `ClassC`.

## How the experiments connect

1. Experiment 1 proves that `ClassB` needs `extends ClassA` before it can use `x`, `y`, and `getNilai()`.
2. Experiment 2 adds encapsulation and proves that inherited code still cannot directly access `private` fields.
3. Experiment 3 distinguishes parent state (`super.phi`, `super.r`) from child state (`this.t`).
4. Experiment 4 shows automatic constructor chaining.
5. Experiment 5 shows hierarchical inheritance: two employee types share one parent.
6. Experiment 6 adds a second level, creating a hybrid of hierarchical and multilevel inheritance.
7. The ticket exercise applies the complete model with formulas, constructor chaining, and chained display methods.
