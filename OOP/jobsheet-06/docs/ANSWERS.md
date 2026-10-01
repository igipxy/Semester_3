# Jobsheet 06 - Answers

## Experiment 1 - `extends`

1. Add `extends ClassA` to the declaration: `public class ClassB extends ClassA`. The corrected submitted class compiles and runs.
2. The original `ClassB` was an unrelated class, so it had no `x`, `y`, or `getNilai()` members. Calls and expressions using those members therefore produced "cannot find symbol" compile errors.

## Experiment 2 - Access modifiers

1. The submitted solution keeps `x` and `y` private and adds protected `getX()` and `getY()` methods in `ClassA`. `ClassB.getJumlah()` uses those methods instead of accessing the fields directly.
2. The error occurs because `private` members are directly accessible only inside the class that declares them. Inheritance does not override that access rule. The worksheet's second question says "Experiment 1," but its surrounding section and code clearly refer to Experiment 2.

## Experiment 3 - `super`

1. `super.phi = phi` and `super.r = r` assign values to the inherited fields declared by the parent `Bangun` class.
2. In the volume formula, `super.phi` and `super.r` explicitly select fields originating from the parent, while `this.t` selects the height field declared in the current `Tabung` class.
3. `Tabung extends Bangun`, and `phi` and `r` are `protected`. Protected members are inherited and directly accessible to subclasses, so `Tabung` does not need to redeclare them.

## Experiment 4 - Parent constructors

1. `ClassA` is the superclass of `ClassB`; `ClassB` is both a subclass of `ClassA` and the superclass of `ClassC`; `ClassC` is a subclass of `ClassB` and an indirect subclass of `ClassA`.
2. Adding an explicit `super()` to the first line of `ClassC()` does not change the output because Java inserts that call automatically when it is omitted and the parent has a no-argument constructor.
3. Creating `new ClassC()` first invokes `ClassA()`, then returns to `ClassB()`, and finally returns to `ClassC()`. That is why the output order is A, B, C. Putting `super()` after another statement fails because a parent constructor call must be the first constructor statement.
4. `super()` invokes the no-argument constructor of the direct parent, `ClassB`, which then invokes `ClassA` before continuing its own body.

## Experiment 5 - Karyawan hierarchy

1. `Karyawan` is the superclass. `Manager` and `Staff` are subclasses.
2. Java uses the `extends` keyword to derive a child class from a parent class.
3. A `Manager` object has `nama`, `alamat`, `jk`, `umur`, and `gaji` inherited from `Karyawan`, plus its own `tunjangan` field.
4. `super.tampilDataKaryawan()` reuses the parent display method. `super.gaji` explicitly refers to the inherited salary when calculating salary plus allowance.
5. This is hierarchical inheritance because two child classes, `Manager` and `Staff`, share the same parent, `Karyawan`.

## Experiment 6 - Staff hierarchy

1. Each direct pair, such as `Manager extends Karyawan` or `StaffTetap extends Staff`, is single inheritance. `Karyawan -> Staff -> StaffTetap` and `Karyawan -> Staff -> StaffHarian` are multilevel inheritance. The complete structure is hybrid because it combines hierarchical branches and multiple levels.
2. Both staff subtypes inherit `nama`, `alamat`, `jk`, `umur`, and `gaji` from `Karyawan`, and `lembur` and `potongan` from `Staff`. `StaffTetap` adds `golongan` and `asuransi`; `StaffHarian` adds `jmlJamKerja`.
3. `super(nama, alamat, jk, umur, gaji, lembur, potongan)` calls the `Staff` parameterized constructor so inherited employee and payroll state is initialized before `StaffHarian` initializes its own field.
4. `super.tampilDataStaff()` reuses the parent display method before the child prints its additional details.
5. Those fields exist in a `StaffTetap` object because the class inherits through `Staff` and `Karyawan`. In the worksheet code they are public, so they can be referenced directly; with private fields, getters or protected calculation methods would be required.

## Exercise questions

### a. Inheritance types

The hierarchy is hybrid. `TiketKereta` and `TiketPesawat` form hierarchical inheritance under `Tiket`, while `TiketDomestik` and `TiketInternasional` form another hierarchical branch under `TiketPesawat`. The paths `Tiket -> TiketPesawat -> TiketDomestik` and `Tiket -> TiketPesawat -> TiketInternasional` are multilevel inheritance.

### b. Attributes of `TiketInternasional`

- From `Tiket`: `kodeTiket`, `namaPenumpang`, `asal`, `tujuan`, and `hargaDasar`.
- From `TiketPesawat`: `maskapai` and `beratBagasi`.
- From `TiketInternasional`: `nomorPaspor` and `asuransi`.

### c. Why `TiketDomestik` can call `hitungBiayaBagasi()`

`TiketDomestik extends TiketPesawat`, so it inherits the accessible `hitungBiayaBagasi()` method. The child can call the inherited method as if it were one of its own methods.

### d. Changing `hargaDasar` to private

Compilation fails wherever a subclass directly reads `hargaDasar`, because private fields are visible only inside `Tiket`. One fix is to add a protected or public `getHargaDasar()` method to `Tiket` and replace direct child-class reads with that method, while leaving the field private.
