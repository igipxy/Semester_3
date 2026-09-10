# Assignments

## Tasks 1-3 - Age Validation

The setter enforces a valid age range of 18 through 30. Inputs below 18 become 18, inputs above 30 become 30, and values inside the range are stored unchanged.

## Tasks 4-6 - Cargo Logistics

The `Kontainer` class keeps all data private, rejects cargo that exceeds capacity, and limits one unloading operation to 50% of the current load. `TestLogistikScanner` accepts dynamic terminal input.

The positive-weight checks are defensive validation added beyond the minimum jobsheet wording. They prevent negative or zero input from corrupting the container state.

## Task 7 - Movie Ticket

The constructor replaces a negative base price with Rp35,000. Payment begins as `false` and can only change through `lakukanPembayaran()`. There is no direct payment-status setter.

