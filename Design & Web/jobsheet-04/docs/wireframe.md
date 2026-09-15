### Wireframe

## Login

+--------------------------+
|       SIMPUS-Mini        |
|--------------------------|
|      Officer Login       |
| Username: [___________]  |
| Password: [___________]  |
|        [ Login ]         |
+--------------------------+

## Dashboard
+----------------------------------+
| Home | Books | Members | Logout |
|----------------------------------|
| [Total Books] [Total Members]   |
| [Books Borrowed]                |
| [New Loan] [Return]             |
| Recent Transactions              |
+----------------------------------+

## New Loan
+------------------------------+
|        New Book Loan         |
| Member: [Select Member]      |
| Book:   [Select Book]        |
| Date:   [___________]        |
|       [Save] [Cancel]        |
+------------------------------+

##Return Book
+------------------------------+
|        Return Book           |
| Search: [_____________]      |
| Member: [_____________]      |
| Book:   [_____________]      |
|       [Return] [Cancel]      |
+------------------------------+

## User Flow
Login -> Dashboard -> New Loan -> Select Member
      -> Select Book -> Save -> Stock -1 -> Dashboard

Dashboard -> Return -> Search Loan -> Return
          -> Stock +1 -> Dashboard

## Actors
Guest   -> Can view books
Officer -> Can log in, borrow, return, and view history