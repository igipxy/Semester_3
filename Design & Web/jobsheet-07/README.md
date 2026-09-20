# Jobsheet 7 PHP Basics and Form Handling

This is the PHP version of SIMPUS-Mini. It continues Jobsheet 6 by moving form processing and table rendering from browser-side JavaScript to the PHP server.

## Required implementation

1. Every page uses `.php` instead of `.html`.
2. `includes/header.php` and `includes/footer.php` provide one reusable page shell and navigation.
3. The Book and Member forms use `method="post"` and submit to `proses_tambah.php`.
4. The process pages validate input on the server and store valid records in `$_SESSION`.
5. The list pages use PHP `foreach` to render rows from `$_SESSION`.
6. Flash messages appear once after a successful or failed redirect.
7. Jobsheet 6 JSON data files and asynchronous list scripts are removed because PHP now renders the rows before sending HTML to the browser.

## Run the project

Run this from the `jobsheet-07` directory:

```text
php -S localhost:8000
```

Then open `http://localhost:8000/index.php`.

## Test checklist

1. Open Book List and Member List: each should show an empty-state row initially.
2. Submit an empty Book form: a red server-side error message must appear after redirect.
3. Add a valid book: Book List must show the new row and one green flash message.
4. Refresh Book List: the flash message must disappear but the book must remain during the same browser session.
5. Add a valid member and confirm the same behavior in Member List.
6. Disable JavaScript and submit an invalid form: PHP validation must still reject it.
7. Close the browser session or clear site data: session records disappear because Jobsheet 7 does not yet use a database.

## Important boundary

`$_SESSION` is temporary per-browser-session storage. It allows data to move from form processing to the list page, but it is not a permanent database. Persistent data belongs in the later PostgreSQL jobsheet.
