# Jobsheet 11 Basic Web Security

Jobsheet 11 audits the Jobsheet 10 application for SQL injection, XSS, CSRF, input validation, and session fixation. It keeps the same PostgreSQL database `web` and the Indonesian `buku`/`anggota` paths. Jobsheet 10 had already added prepared statements, most output escaping, CSRF tokens, and session ID renewal. This version centralizes the two helpers, checks missing/invalid tokens with HTTP 403, and documents the audit.

## Jobsheet 11 changes

- `includes/helpers.php` defines `e()`, which escapes text before it reaches HTML, and `input_string()`, which rejects array-shaped values where a text field is expected.
- `includes/csrf.php` defines `csrf_token()`, `csrf_field()`, and `csrf_verify()`. Every POST form prints the hidden field; every POST handler verifies it before a database change.
- Successful login retains `session_regenerate_id(true)` from Jobsheet 10. This was checked, not introduced by this jobsheet.
- Edit pages validate the requested ID and fetch the record before printing HTML, so missing/invalid IDs can still redirect. Hidden record IDs are printed as integers.
- `docs/security-checklist.md` records each finding, code location, and what was actually verified.

The token is stable for one session and can be reused by forms in that session. It is **not** a single-use token. A missing or invalid token produces HTTP 403.

## What's included

- `sql/02_users.sql` creates the `users` table in the existing `web` database.
- `auth/register.php` and `auth/proses_register.php` validate registration and store passwords with `password_hash()`.
- `auth/login.php` and `auth/proses_login.php` look up an account, check its password with `password_verify()`, and store its identity in `$_SESSION`.
- `auth/logout.php` clears the session and expires its browser cookie.
- `includes/session.php` starts a session once and configures strict session IDs plus HttpOnly, SameSite, and HTTPS-aware cookies.
- `includes/csrf.php` creates per-session form tokens and checks them on registration, login, logout, and book/member create, edit, and delete POST requests.
- `includes/helpers.php` escapes output from the database, search query, flash messages, and the signed-in user's name.
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
3. From this `jobsheet-11` folder, import both schemas into `web`:

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
2. Upload the contents of `jobsheet-11` to a site directory. Set the site's document root to this folder, or open the app from its deployed subfolder.
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

## How to check the security work

Use a disposable local database. Start the app, register a demo officer, and sign in. Then:

1. Send a POST to `buku/proses_tambah.php` without `csrf_token` while signed in. It must return HTTP 403 and must not add a book. A request without the browser session is redirected to login first because the auth guard runs before the CSRF check.
2. Add a book titled `<script>alert(1)</script>`. On the book list, those characters should appear as text; no alert box should run.
3. Log out, then open `buku/tambah.php` or `anggota/list.php`. The page should redirect to login. The public book list should remain accessible.
4. Try the username `' OR '1'='1` on the login form with any password. It should not sign in. The query uses a bound `:username` value.
5. On a successful login, compare the PHP session cookie value before and after. It should change because `session_regenerate_id(true)` runs after `password_verify()`.

The local PHP checks already confirmed syntax, token generation, HTTP 403 for a missing login token, and redirect of an unauthenticated private page. The database flows remain manual checks until PostgreSQL is connected. See `docs/security-checklist.md` for exact evidence and `PANDUAN_BELAJAR.md` for the code walkthrough.
