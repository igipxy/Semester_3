# Jobsheet 5 JavaScript DOM and Event

This folder contains the completed Jobsheet 5 version of SIMPUS-Mini. It continues the existing Jobsheet 4 project and adds browser-side interactivity without changing the design plan in `docs/wireframe.md`.

## Required implementation

1. Replace the CSS checkbox hamburger with a real button controlled by JavaScript.
2. Add live search fields to the Book List and Member List pages.
3. Add functional Delete buttons that ask for confirmation and remove the selected row from the current page.
4. Add custom client-side validation to the Add Book and Add Member forms.
5. Load the same `assets/js/app.js` file at the end of every HTML body.
6. Add CSS for the JavaScript menu state, search fields, and validation messages.
7. Keep `docs/wireframe.md` unchanged from Jobsheet 4.

## Folder structure

```text
jobsheet-05/
|-- index.html
|-- README.md
|-- PANDUAN_BELAJAR.md
|-- assets/
|   |-- css/
|   |   `-- style.css
|   `-- js/
|       `-- app.js
|-- buku/
|   |-- list.html
|   `-- tambah.html
|-- anggota/
|   |-- list.html
|   `-- tambah.html
`-- docs/
    `-- wireframe.md
```

## How to run

Open `index.html` in a modern browser. No server or package installation is required.

## How to test

1. Resize the page to 480 pixels or narrower. Click the hamburger button twice and confirm the navigation opens and closes.
2. Open `buku/list.html`. Type `laskar` in the search field and confirm only the matching row remains visible. Clear the field and confirm every row returns.
3. Click Delete, choose Cancel, and confirm the row remains. Click Delete again, choose OK, and confirm the row disappears.
4. Refresh the page and confirm the deleted row returns. This proves the operation affects only the DOM, not stored data.
5. Open `buku/tambah.html`, submit an empty form, and confirm custom error messages appear. Test a year outside 1900-2026 and negative stock.
6. Open `anggota/tambah.html`, submit an empty form, and confirm Name and Member No. errors appear.
7. Keep the browser console open while testing and confirm there are no JavaScript errors.

## Important boundary

The validation and deletion in this jobsheet run only in the browser. They improve interaction but do not provide server-side security or permanent data storage. Refreshing a list restores a deleted row, and a valid form still has no database destination. Server-side validation and persistent deletion belong to later jobsheets.

## Translation corrections

The English jobsheet translates some identifiers inconsistently. This implementation keeps the original Indonesian hooks from the complete code examples (`.btn-hapus`, `#form-tambah`, `initHapusConfirm`, and `initValidasiForm`) while also retaining the English `.btn-delete` class on Delete buttons. Mismatched variables in the document were corrected so the code runs.

## Optional exercises

The optional advanced exercises from section 8.4 are intentionally not part of the required implementation. They are listed separately in `PANDUAN_BELAJAR.md`.
