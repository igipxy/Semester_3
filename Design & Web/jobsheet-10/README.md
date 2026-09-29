# Jobsheet 10 Authentication and Session Management

Jobsheet 10 extends the Jobsheet 9 CRUD application with officer registration, login, logout, and page access checks. The public home page and book catalog remain available to visitors. Adding, editing, or deleting books and every member page require a signed-in session.

## What's included

- `sql/02_users.sql` creates the `users` table in the existing `web` database.
- `auth/register.php` and `auth/proses_register.php` validate registration and store passwords with `password_hash()`.
- `auth/login.php` and `auth/proses_login.php` look up an account, check its password with `password_verify()`, and store its identity in `$_SESSION`.
- `auth/logout.php` clears the session and expires its browser cookie.
- `includes/session.php` starts a session once and configures strict session IDs plus HttpOnly, SameSite, and HTTPS-aware cookies.
- `includes/csrf.php` creates per-session form tokens and checks them on registration, login, logout, and book/member create, edit, and delete POST requests.
- `includes/auth.php` redirects visitors without a `user_id` session to the login page. It does not connect to PostgreSQL.
- `includes/header.php` shows public links to everyone and CRUD/member links only to signed-in officers.
- `includes/koneksi.php` reads `DB_HOST`, `DB_PORT`, `DB_NAME`, `DB_USER`, and `DB_PASS` environment variables. The defaults support the existing local Jobsheet setup.

## Access rules

| Page | Access |
| --- | --- |
| `index.php`, `buku/list.php` | Public |
| Book add, edit, process, and delete pages | Login required |
| All `anggota/*.php` pages | Login required |
| `auth/register.php`, `auth/login.php` | Public until signed in |

The `role` column is set to `petugas` during public registration, but role-based permissions are not implemented in this lesson. Since registration is open, this is a coursework/demo setup: anyone who can reach the site can create an officer account. For a real public deployment, disable public registration or replace it with an administrator-controlled account creation process before exposing the application.

## Local setup with Laragon

1. Start PostgreSQL and Apache in Laragon. Confirm the PHP version used by Laragon has `pdo_pgsql` enabled.
2. Create database `web` if Jobsheet 8/9 has not already created it:

   ```sql
   CREATE DATABASE web;
   ```

   Run that statement while connected to the PostgreSQL maintenance database, such as `postgres`.
3. From this `jobsheet-10` folder, import both schemas into `web`:

   ```text
   psql -U postgres -d web -f sql/01_buku_anggota.sql
   psql -U postgres -d web -f sql/02_users.sql
   ```

   The first schema creates the Jobsheet 8/9 book and member tables; the second adds login accounts. `CREATE TABLE IF NOT EXISTS` preserves existing data.
4. If needed, set `DB_HOST`, `DB_PORT`, `DB_NAME`, `DB_USER`, and `DB_PASS` in `includes/koneksi.php`'s environment or adjust its local defaults to your PostgreSQL credentials. Do not assume the sample password is correct for your machine.
5. Run from this folder with Laragon's PHP:

   ```text
   php -S localhost:8000
   ```

   Open `http://localhost:8000/index.php`. Alternatively, place the folder under Laragon's `www` directory and use its local Apache URL.

## Deploying to a web host

Choose a host that provides PHP 8 or later, Apache (or equivalent access rules), the `pdo_pgsql` extension, and a PostgreSQL database reachable by the PHP application. Enable HTTPS before using real accounts.

1. Create a PostgreSQL database and a restricted database user in the hosting control panel. Import `sql/01_buku_anggota.sql`, then `sql/02_users.sql` into that database.
2. Upload the contents of `jobsheet-10` to a site directory. Set the site's document root to this folder, or open the app from its deployed subfolder.
3. Configure `DB_HOST`, `DB_PORT`, `DB_NAME`, `DB_USER`, and `DB_PASS` through the host's environment-variable settings. If the host does not provide them, use a private configuration file outside the public document root; never commit production credentials to GitHub.
4. Confirm the host enables `pdo_pgsql`, turn on HTTPS, and open `index.php` and `auth/login.php` in a browser.
5. Register a demo officer, sign in, and confirm a member page redirects to login after logout. Use a non-production database and disposable records while learning.

The included `.htaccess` files disable directory listings and deny direct web access to `includes/` and `sql/` on Apache hosts. For Nginx or another server, add equivalent deny rules in that server's configuration because `.htaccess` is Apache-specific.

Do not use PHP's built-in `php -S` server for a public production deployment; it is for local development. Public registration, missing role-based authorization, and the lack of production account recovery/rate limiting also mean this example needs more work before it is suitable for a real library.

## Request flow

```text
Visitor -> register form -> POST proses_register.php
                         -> validate -> password_hash -> INSERT users -> login page
Visitor -> login form -> POST proses_login.php
                      -> SELECT user -> password_verify -> regenerate session ID
                      -> save user_id/name/role in $_SESSION -> home
Protected page -> includes/auth.php -> user_id exists? -> render / redirect to login
Logout form -> POST auth/logout.php -> validate token -> clear session and cookie -> login page
```

See `PANDUAN_BELAJAR.md` for the step-by-step code walkthrough.
