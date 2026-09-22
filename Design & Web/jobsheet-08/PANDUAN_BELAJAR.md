# Panduan Belajar Jobsheet 8 Koneksi PostgreSQL

## Gambaran besar

Jobsheet 7 could add records, but it stored them in `$_SESSION`. Closing the browser cleared them. Jobsheet 8 changes the source of truth to PostgreSQL, a database program that stores data separately from the PHP application.

```text
Add Book form -> POST -> proses_tambah.php
                         -> validate input
                         -> PDO prepared INSERT -> PostgreSQL
                         -> redirect -> list.php SELECT -> HTML table
```

## 1. Database, table, row, and column

PostgreSQL is a relational database. The `buku` and `anggota` tables are permanent versions of the rows previously held in a PHP session.

- A table stores one type of record, such as books.
- A row is one record, such as one book.
- A column is one property, such as `title` or `stock`.
- `id SERIAL PRIMARY KEY` lets PostgreSQL assign every record a unique ID automatically.
- `NOT NULL`, `UNIQUE`, and `CHECK` are database rules that protect data quality even if a future PHP page has a bug.

The SQL schema is in `sql/01_buku_anggota.sql`. Run it once after creating the `simpus_mini` database.

## 2. PDO is PHP's database bridge

`includes/koneksi.php` creates `$pdo`, a PHP object representing a connection to PostgreSQL.

```php
$pdo = new PDO(
    "pgsql:host=$host;port=$port;dbname=$db",
    $user,
    $pass
);
```

The first string is the DSN: it says which database driver (`pgsql`), host, port, and database to use. `try` and `catch` make connection failure understandable instead of allowing later pages to fail mysteriously.

## 3. PHP still validates before SQL

PHP validates the form before it sends anything to the database. That matters because HTML and JavaScript validation can be bypassed in the browser.

```php
if ($title === '') $errors[] = 'Title is required.';
if (filter_var($stock, FILTER_VALIDATE_INT) === false || (int) $stock < 0) {
    $errors[] = 'Stock must be zero or greater.';
}
```

The database repeats critical rules using `NOT NULL`, `CHECK`, and `UNIQUE`. This is defense in depth: PHP gives the user a helpful message, while PostgreSQL protects the permanent data.

## 4. Prepared statements safely insert form data

Never build an SQL query by joining user input into a string. Use placeholders with `prepare()` and pass the values separately through `execute()`.

```php
$statement = $pdo->prepare(
    'INSERT INTO buku (title, author, year, isbn, stock, category)
     VALUES (:title, :author, :year, :isbn, :stock, :category)
     RETURNING id'
);
$statement->execute(['title' => $title, 'author' => $author]);
```

The database receives the SQL structure first and the values second. A title containing quotes stays text, not SQL code. `RETURNING id` retrieves PostgreSQL's generated ID, which prepares the project for persistent Edit and Delete in Jobsheet 9.

## 5. Reading permanent data with SELECT

The list page asks PostgreSQL for records instead of reading a session array.

```php
$daftar_buku = $pdo->query('SELECT * FROM buku ORDER BY id DESC')->fetchAll();
```

`SELECT` reads the rows, `ORDER BY id DESC` puts the newest record first, and `fetchAll()` returns PHP associative arrays. The existing `foreach` table loop can therefore stay almost unchanged.

The home page needs only a number, so it uses the more efficient `COUNT(*)` and `fetchColumn()`.

```php
$total_buku = (int) $pdo->query('SELECT COUNT(*) FROM buku')->fetchColumn();
```

## 6. What still uses session?

`$_SESSION` is still useful for a flash message because the message needs to survive exactly one redirect. Book and Member records no longer use session storage, so they remain after the browser is closed.

## Important boundary

Jobsheet 8 provides permanent Create and Read operations. The Edit/Delete buttons remain front-end-only placeholders until Jobsheet 9 adds persistent update and delete queries.
