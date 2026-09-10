# Experiments

## Experiment 1 - Encapsulation Problem

`Motor` exposes `kecepatan` and `kontakOn` as public attributes. `MotorDemo` can therefore set the speed to 50 while the ignition is off. This intentionally demonstrates the problem.

## Experiment 2 - Access Modifier

The attributes become private. State changes are controlled by `nyalakanMesin()`, `matikanMesin()`, `tambahKecepatan()`, and `kurangiKecepatan()`. The maximum-speed answer is incorporated as a 100 km/h limit.

## Experiment 3 - Getter and Setter

`nama` and `alamat` have getters and setters. `simpanan` has a getter but no direct setter because it must change through `setor()` and `pinjam()`.

## Experiment 4 - Constructor

The constructor requires the member's name and address when the object is created and initializes the balance to zero.

