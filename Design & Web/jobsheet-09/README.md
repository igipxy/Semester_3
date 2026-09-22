# Jobsheet 8 PostgreSQL Connection

Jobsheet 8 moves SIMPUS-Mini from temporary PHP session storage to permanent PostgreSQL storage. The page layout, client-side usability features, and flash-message pattern from Jobsheet 7 remain in place.

## What changed from Jobsheet 7

1. `sql/01_buku_anggota.sql` creates the `buku` and `anggota` tables.
2. `includes/koneksi.php` connects PHP to PostgreSQL through PDO.
3. The Book and Member process pages use prepared `INSERT` statements with `RETURNING id`.
4. The list pages run `SELECT * ... ORDER BY id DESC`.
5. The Home statistics use `SELECT COUNT(*)`.
6. `$_SESSION` is now used only for one-time flash messages; books and members are stored in PostgreSQL.

## Database preparation

1. Start PostgreSQL and ensure PHP has the `pdo_pgsql` extension enabled.
2. Create the database:

   ```text
   createdb simpus_mini
   ```

3. From the `jobsheet-08` folder, run the schema:

   ```text
   psql -d simpus_mini -f sql/01_buku_anggota.sql
   ```

4. Open `includes/koneksi.php` and set `$user` and `$pass` to your local PostgreSQL credentials. The provided `postgres` / `postgres` values are only common local-development defaults.

## Run

```text
php -S localhost:8000
```

Open `http://localhost:8000/index.php`.

## Test checklist

1. Home should show 0 Books and 0 Members in a new database.
2. Add a valid book. It should appear at the top of Book List, and Home should show 1 Book.
3. Refresh the list: the flash message disappears, but the record remains.
4. Close the browser, reopen it, and confirm the data still exists.
5. Add two members with the same member number. The second attempt must show a friendly error message because the database enforces `UNIQUE`.
6. Submit invalid form data with JavaScript disabled. PHP validation must still reject it.

## Important boundaries

- PostgreSQL persists Book and Member records; it is the new source of truth.
- Delete and Edit buttons are still display-only in this jobsheet. Persistent edit/delete belongs to Jobsheet 9.
- Prepared statements are used whenever submitted data goes into SQL, preventing submitted text from changing the query structure.
