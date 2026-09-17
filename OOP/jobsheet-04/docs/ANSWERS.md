# Jobsheet 04 - Comprehension Answers

## Experiment 1 - Laptop and Processor

1. Setters change private attributes through public methods, while getters return their current values. They preserve encapsulation because outside code does not access the fields directly.
2. A default constructor creates an object without initial values, so setters are used afterward. A parameterized constructor receives the required values immediately when `new` is called.
3. `proc` has the object type `Processor`. The relationship is declared by `private Processor proc;` in `Laptop`.
4. `proc.info()` delegates the work: the `Laptop` asks its stored `Processor` object to display the processor details.
5. They produce the same output because both approaches create a `Processor` with the same state and give its reference to a `Laptop`. A named local variable changes how the reference is written, not the resulting object data.
6. It is aggregation. `Laptop(String brand, Processor proc)` receives the processor from outside, while `MainExperiment1` calls `new Processor(...)` and passes the reference in.
7. The changed constructor would make it composition because `Laptop` itself would execute `new Processor(...)` and own the created part instead of receiving an independent object.

## Experiment 2 - Customer, Car, and Driver

1. `private Car car;` and `private Driver driver;` show the two relationships in `Customer`.
2. `days` belongs to the rental transaction represented by `Customer`, not to a reusable `Car` or `Driver`. Passing it as an argument gives each object the temporary information needed to calculate its own cost.
3. The two calls delegate each part of the calculation to the object that knows its own daily rate.
4. `p.setCar(m)` and `p.setDriver(s)` store the existing `Car` and `Driver` references inside the `Customer` object.
5. `p.calculateTotalCost()` calculates the car cost and driver cost for the chosen number of days, then adds them. The checkpoint result is `1100000`.
6. `p.getCar()` runs first and returns the `Car` referenced by `p`. Then `getBrand()` runs on that returned `Car`, producing `Avanza`.
7. A `NullPointerException` appears because `car` remains `null`, and `calculateTotalCost()` attempts to call `calculateCarCost(days)` on that missing reference.

## Experiment 3 - Train and Employee Roles

1. `trainDriver.info()` and `assistant.info()` delegate formatting of employee details to the corresponding `Employee` objects.
2. Before the fix, `MainQuestion` prints the train and driver details and then stops with a `NullPointerException` at `assistant.info()`. The three-parameter constructor never assigns an assistant.
3. The `assistant` field contains the special reference value `null`, meaning it refers to no `Employee` object.
4. Both constructors require a `trainDriver` argument, so the normal worksheet flow cannot omit it as it can omit the assistant. Strictly, Java still allows a caller to pass `null`, so production code should validate it with `Objects.requireNonNull` or guard it as well.
5. Step 6 creates two different objects because it executes `new Employee(...)` twice and stores the two references in different variables. Using the same class type does not mean using the same object.

## Experiment 4 - Carriage, Seat, and Passenger

1. `new Carriage("A", 10)` creates 10 seats.
2. `if (passenger != null)` means passenger details are appended only when the seat actually refers to a passenger; an empty seat is a valid state.
3. User-facing seat numbers start at 1, while Java array indexes start at 0. Subtracting 1 maps seat 1 to index 0, seat 2 to index 1, and so on.
4. Before the requested check is added, assigning Budi to seat 1 silently replaces the reference to Mr. Krab; Java gives no warning or error. In the submitted final version, the second assignment is rejected and the original passenger remains.
5. `Carriage.setPassenger()` now checks bounds and then checks `selectedSeat.getPassenger() != null` before assigning. It returns `false` and prints `Seat 1 is already occupied.` when replacement is attempted.
6. Use an array when there can be many similar objects addressed by position and the count can vary. Use individually named attributes when the number is fixed and each relationship has a different meaning, such as `trainDriver` and `assistant`.
7. `Carriage` - `Seat` is composition because `Carriage.initSeats()` executes `new Seat(...)` internally. `Seat` - `Passenger` is aggregation because `MainExperiment4` creates the `Passenger` externally and passes it to `setPassenger()`.

## Experiment 5 - Car and Engine

1. `this.engine = new Engine();` inside the `Car` constructor proves that the car creates and owns its engine.
2. Adding `setEngine(Engine engine)` would allow outside code to replace the internally owned part. That weakens the exclusive ownership rule and makes the design behave like aggregation rather than strict composition.
3. `Laptop` receives a `Processor` parameter created outside, while `Car` receives no `Engine` parameter and calls `new Engine()` itself.
4. Once the `Car` is unreachable, its private engine is also unreachable and both become eligible for garbage collection. In Experiment 1, the `Processor` can remain reachable through the separate variable `p` even if the `Laptop` reference is removed.
5. When a second constructor accepts an externally created `Engine`, objects created through that constructor use aggregation. Supporting both creation rules in one class makes ownership ambiguous, so a real design should choose and document one lifecycle policy.

## Experiment 6 - Laptop and Printer

1. No. This `Laptop` stores only `brand`; unlike Experiment 1, it has no field of type `Printer`.
2. No. The printer reference exists only as the `printDocument()` parameter and is not copied into an attribute.
3. It is dependency because the laptop borrows a printer for one method call instead of retaining it as part of its state.
4. Yes. If `Laptop` stores an externally created `Printer` in a field through a constructor or setter, the printer becomes a retained, independently created part, which is aggregation.
5. Summary:

   | Relationship | Stored as attribute? | Who calls `new` for the related object? |
   |---|---:|---|
   | Aggregation | Yes | Outside code creates it and injects the reference. |
   | Composition | Yes | The owning class creates it internally. |
   | Dependency | No | Outside code creates it and passes it only to a method. |

## Independent Assignment Reflection

First ask whether the class must remember the other object after one method finishes; if not, use a dependency. If it must be stored, ask whether the part has an independent lifecycle and may be shared or replaced; if yes, use aggregation. If the whole must create and exclusively own the part, and the part should not meaningfully outlive it, use composition. The decision should follow lifecycle and ownership rules rather than merely the fact that one object calls another.
