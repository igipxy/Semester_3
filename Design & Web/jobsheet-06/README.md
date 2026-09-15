# Jobsheet 6 Fetch API and JSON

This folder contains the completed Jobsheet 6 version of SIMPUS-Mini. It continues the verified Jobsheet 5 project and changes the Book List and Member List from static HTML rows into data loaded asynchronously from JSON files.

## Required implementation

1. Add `data/buku.json` containing 10 book objects.
2. Add `data/anggota.json` containing 4 member objects.
3. Keep the `<tbody>` elements in both list pages empty in the source HTML.
4. Add a hidden `#loading-indicator` above each table.
5. Add `assets/js/buku.js` and `assets/js/anggota.js` to fetch, validate, parse, and render the JSON data.
6. Use `async`, `await`, `try`, `catch`, and `finally` for asynchronous control and error handling.
7. Change Delete handling in `assets/js/app.js` to event delegation so it works on dynamically rendered buttons.
8. Keep the Jobsheet 5 CSS and Jobsheet 4 wireframe unchanged.

## Folder structure

```text
jobsheet-06/
|-- index.html
|-- README.md
|-- PANDUAN_BELAJAR.md
|-- assets/
|   |-- css/
|   |   `-- style.css
|   `-- js/
|       |-- app.js
|       |-- buku.js
|       `-- anggota.js
|-- data/
|   |-- buku.json
|   `-- anggota.json
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

The project must be opened through `http://`, not by double-clicking an HTML file. A direct `file://` page can block `fetch()` because of browser security rules.

Open a terminal in the `jobsheet-06` folder and use one of the methods required by the jobsheet:

```text
php -S localhost:8000
```

Then open `http://localhost:8000/index.html`.

You may alternatively use the VS Code Live Server extension or place the project under Laragon's `www` directory and run Apache.

For environments without PHP, this equivalent development server is an assistant-added convenience, not a jobsheet requirement:

```text
python -m http.server 8000
```

## How to test

1. Open `http://localhost:8000/buku/list.html` and briefly observe `Loading data...` before 10 book rows appear.
2. Open the Network panel and confirm that `data/buku.json` returns successfully.
3. Search for `Andrea`; only matching rows should remain visible. Clear the search to restore all rows.
4. Click Delete, choose Cancel, and confirm the row remains. Repeat and choose OK; exactly one dynamically generated row should disappear.
5. Refresh the page and confirm the deleted row returns because no database has been changed.
6. Open `http://localhost:8000/anggota/list.html` and confirm 4 member rows appear.
7. Search for `Budi` and test Delete again.
8. Test error handling by temporarily changing `../data/buku.json` to `../data/bukuu.json` in `assets/js/buku.js`. Confirm an error row appears, then restore the correct filename before submission.
9. Confirm the browser console contains no JavaScript errors during normal use.

## Important boundaries

- The JSON files are temporary stand-ins for a future server API.
- Fetching data is asynchronous and does not block the rest of the page.
- Delete changes only the current DOM; it does not edit the JSON file.
- Client-side behavior is not server-side security or persistent storage.

## Translation corrections

The English document translates several identifiers inconsistently. The submission preserves the intended Indonesian function and object names (`muatDaftarBuku`, `muatDaftarAnggota`, `buku`, and `anggota`) while fixing invalid mixtures such as `listBook`/`buku`, `member`/`anggota`, `sure`/`yakin`, and translated function calls that did not match their declarations. Relative paths were also corrected from the document's spaced `.. /data/...` rendering to valid `../data/...` paths.

## Optional exercises

The advanced exercises in section 8.4 are not part of the required implementation. They remain listed separately in `PANDUAN_BELAJAR.md`.
