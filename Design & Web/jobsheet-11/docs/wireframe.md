# SIMPUS-Mini UI UX Design

This document plans the next SIMPUS-Mini features before implementation. It defines the users, page layouts, task flows, business rules, and links to the existing design system. The drawings are low-fidelity wireframes: they show structure and behavior, not final colors, fonts, or pixel measurements.

## 1 Actors and access

### Guest

A Guest can open the public Home and Book List pages without logging in. A Guest cannot create, update, or delete records and cannot access borrowing or return transactions.

### Officer

An Officer logs in before accessing the protected Dashboard, book and member management, borrowing, returns, and transaction history. The system must redirect an unauthenticated user who attempts to open a protected page to Login.

## 2 Page wireframes

### 2.1 Officer Login

```text
+--------------------------------------------------+
| SIMPUS-Mini                                     |
|--------------------------------------------------|
|                                                  |
|                 Officer Login                    |
|                                                  |
| Username   [____________________________]         |
| Password   [____________________________]         |
|                                                  |
|                    [ Login ]                     |
|                                                  |
| Do not have an account? Contact an administrator |
+--------------------------------------------------+
```

Behavior:

- Username and password are required.
- Password characters must be hidden.
- Successful login opens the Officer Dashboard.
- Invalid credentials display a clear error without revealing which credential was wrong.
- The Login button must not create multiple sessions if clicked repeatedly.

### 2.2 Officer Dashboard

```text
+-----------------------------------------------------------------------+
| SIMPUS-Mini  Home | Books | Members | Borrowing | History             |
|                                             Officer Name | Logout      |
|-----------------------------------------------------------------------|
|                                                                       |
| [ Total Books ]    [ Total Members ]    [ Currently Borrowed ]        |
|                                                                       |
| Quick Actions                                                         |
| [ + New Loan ]     [ + Return ]                                      |
|                                                                       |
| Recent Transactions                                                   |
| +----------------+----------------+------------+--------------------+ |
| | Member         | Book           | Date       | Status             | |
| +----------------+----------------+------------+--------------------+ |
| | ...            | ...            | ...        | Borrowed/Returned  | |
| +----------------+----------------+------------+--------------------+ |
+-----------------------------------------------------------------------+
```

Behavior:

- Navigation reuses the existing Flexbox and responsive menu pattern.
- The statistic cards reuse the existing CSS Grid card pattern.
- Recent Transactions uses the existing table style and remains horizontally scrollable on narrow screens.
- Logout ends the Officer session and returns to the public page or Login.

### 2.3 New Loan

```text
+--------------------------------------------------------------+
| SIMPUS-Mini  Home | Books | Members | Borrowing | History     |
|                                      Officer Name | Logout     |
|--------------------------------------------------------------|
| New Book Loan                                                |
|                                                              |
| Member       [ Select a member                         v ]    |
| Book         [ Select an available book, stock > 0     v ]    |
| Borrow date  [ yyyy-mm-dd                              ]      |
| Due date     [ yyyy-mm-dd                              ]      |
|                                                              |
| [ Save Loan ]                         [ Cancel ]               |
+--------------------------------------------------------------+
```

Behavior and business rules:

- Only authenticated Officers can open the form.
- Member and book are required.
- Only books with stock greater than zero can be selected.
- One book is recorded per transaction in this design.
- The due date cannot be earlier than the borrow date.
- Saving creates an active loan, reduces book stock by one, and returns to the Dashboard.
- If the save fails, stock must not change and the Officer must see an actionable error.

### 2.4 Book Return

```text
+--------------------------------------------------------------+
| SIMPUS-Mini  Home | Books | Members | Borrowing | History     |
|                                      Officer Name | Logout     |
|--------------------------------------------------------------|
| Return a Book                                                |
|                                                              |
| Search active loan  [ Member name or book title       ]      |
|                     [ Search ]                               |
|                                                              |
| Active loan                                                 |
| Member       : [selected member]                             |
| Book         : [selected book]                               |
| Borrow date  : [date]       Due date: [date]                 |
| Return date  : [ yyyy-mm-dd ]                                |
|                                                              |
| [ Mark as Returned ]                  [ Cancel ]              |
+--------------------------------------------------------------+
```

Behavior and business rules:

- The Officer searches existing active loans instead of creating a new record.
- Only loans that have not been returned can be selected.
- Marking a loan as returned changes its status and increases book stock by one.
- A repeated return action must not increase stock more than once.
- After success, the system returns to the Dashboard and shows the updated transaction.

### 2.5 Transaction History

```text
+-----------------------------------------------------------------------+
| SIMPUS-Mini  Home | Books | Members | Borrowing | History             |
|                                             Officer Name | Logout      |
|-----------------------------------------------------------------------|
| Transaction History                                                   |
|                                                                       |
| Search [________________]  Status [ All v ]  Date [____] to [____]    |
|                                                                       |
| +----------+----------+------------+----------+----------+----------+ |
| | Member   | Book     | Borrowed   | Due      | Returned | Status   | |
| +----------+----------+------------+----------+----------+----------+ |
| | ...      | ...      | ...        | ...      | ...      | ...      | |
| +----------+----------+------------+----------+----------+----------+ |
+-----------------------------------------------------------------------+
```

Behavior:

- Officers can search by member or book.
- Officers can filter by transaction status and date range.
- Statuses clearly distinguish active, returned, and overdue transactions.
- The table follows the current table style and scrolls horizontally on mobile.

## 3 User flows

### 3.1 Borrowing flow

```text
[Officer Login]
      -> [Dashboard]
      -> [Choose New Loan]
      -> [Select Member]
      -> [Select Book with stock > 0]
      -> [Enter dates]
      -> [Validate data]
           -> invalid: [Show error and keep entered data]
           -> valid:   [Save active loan]
                     -> [Reduce stock by 1]
                     -> [Return to Dashboard]
```

The transaction and stock update must succeed together. If one fails, neither change should be saved.

### 3.2 Return flow

```text
[Dashboard]
      -> [Choose Return]
      -> [Search active transaction]
      -> [Select matching loan]
      -> [Enter return date]
      -> [Validate transaction is still active]
           -> invalid: [Show error; do not change stock]
           -> valid:   [Mark Returned]
                     -> [Increase stock by 1]
                     -> [Return to Dashboard]
```

The return flow updates an existing loan. It does not create a second borrowing transaction.

## 4 Business rules and edge cases

### Required rules recorded by the jobsheet

- A book with zero stock cannot be selected for borrowing.
- Borrowing reduces stock by one.
- Returning increases stock by one.
- Transaction pages are restricted to authenticated Officers.
- A member with overdue obligations must be validated in a later implementation jobsheet.

### Additional design checks

- Prevent the same active loan from being returned twice.
- Prevent stock from becoming negative.
- Preserve entered form values when validation fails.
- Handle empty searches with a useful message rather than a blank table.
- Confirm destructive or state-changing actions clearly.
- Make keyboard focus, labels, errors, and buttons understandable without relying only on color.

## 5 Consistency with the existing design

- Reuse the existing `#1d5b8a` accent color, typography, spacing, and button treatment from `assets/css/style.css` when implementation begins.
- Extend the current navigation with Borrowing and History rather than building a second navigation system.
- Reuse the existing card, table, form-label, input, and select patterns.
- Keep the Jobsheet 3 responsive behavior: cards rearrange at tablet and mobile widths, navigation becomes toggleable on small screens, form controls fit the available width, and wide tables scroll inside their container.
- Keep public catalog pages accessible to Guests while protecting Officer pages with authorization checks in a later jobsheet.

## 6 Implementation boundary

This file is a design specification, not an implementation. Jobsheet 4 makes no HTML or CSS changes. Authentication, sessions, authorization, database writes, transaction validation, stock updates, and overdue-member rules must be implemented and tested in later jobsheets.
