# Jobsheet 11 Security Checklist

This checklist separates source findings from tests that ran against the local PHP server. Database-backed flows still need a working PostgreSQL connection. The application is a coursework demo, not a production security certification.

| # | Issue | Code checked | Before Jobsheet 11 | Jobsheet 11 result | Evidence status |
| --- | --- | --- | --- | --- | --- |
| 1 | SQL injection | `auth/proses_login.php`, all `buku/` and `anggota/` query files | Jobsheet 10 already used PDO placeholders for user values. The member search joins only a fixed SQL fragment, not user text. | Kept bound parameters and native prepares; no user input is concatenated into SQL. | Source audit complete; database attack test pending. |
| 2 | XSS | `includes/helpers.php`, `includes/header.php`, list and edit pages | Most text output already called `e()`, but the helper lived inside `header.php`. | Moved `e()` to a reusable helper. Text from the database, search field, flash messages, and navbar name is escaped at HTML output. | Source audit complete. Direct PHP check rendered `<script>alert(1)</script>` as `&lt;script&gt;alert(1)&lt;/script&gt;`; database/browser test pending. |
| 3 | CSRF | `includes/csrf.php`, all POST forms and handlers | Jobsheet 10 already used session tokens, but each form wrote the field manually and each handler had its own redirect on failure. | Added `csrf_field()` and `csrf_verify()`; invalid/missing tokens receive HTTP 403 before a database change. Auth guard runs first on private handlers. | Source audit complete. Local HTTP login form returned a 64-character token; POST without it returned 403. Database mutation test pending. |
| 4 | Input validation | `includes/helpers.php`, form handlers, list and edit pages | Required text, integer year/stock/ID, and category were checked. Array-shaped text inputs could cause PHP type errors. Edit pages also printed HTML before an invalid-ID redirect. | Added `input_string()` for expected text fields, cast hidden IDs to integers, and moved edit-page lookup before HTML output. | Source audit complete. Malformed username POST reached the database connection step without a PHP type error. Edit redirects need a signed-in database test. |
| 5 | Session fixation | `auth/proses_login.php`, `includes/session.php` | Jobsheet 10 already called `session_regenerate_id(true)` after successful password verification. | Verified its placement before writing authenticated session identity; no code change needed. | Source audit complete; cookie-before/after browser test pending. |

## What to test locally

Run the app from the `jobsheet-11` folder with Laragon PHP and a disposable PostgreSQL `web` database. Use a demo officer account and records that can be deleted.

1. **CSRF:** While logged in, send a POST to `buku/proses_tambah.php` without `csrf_token` but with the browser's session cookie. Expect HTTP 403 and no inserted book. Without a session cookie, expect a redirect to login first. A plain `curl -X POST` without the browser cookie tests the login guard, not the CSRF branch.
2. **XSS:** Add a book title `<script>alert(1)</script>` through the normal form. Open `buku/list.php`. Expect literal text and no alert dialog. Try a title with double quotes in `buku/edit.php` as well.
3. **SQL injection:** Enter `' OR '1'='1` as a username and any password. Expect failed login. This demonstrates parameter binding for that query; it is not proof against every possible injection path.
4. **Access guard:** Log out, then open `buku/tambah.php` and `anggota/list.php`. Expect redirects to login. `index.php` and `buku/list.php` should still open.
5. **Session fixation:** Record the PHP session cookie before login and after successful login. Expect a different ID. Do not put real session cookies into screenshots or Git.
6. **Malformed input:** Submit `q[]=x` to either list and `username[]=x` to login. Expect a normal page or validation failure, not a PHP TypeError.
7. **Invalid edit ID:** Open `buku/edit.php?id=0` and `anggota/edit.php?id=0`. Expect redirects to their lists before HTML is printed.

## Limits

- Tokens are per-session and reusable during that session. They are not single-use.
- SameSite=Lax cookies and CSRF tokens reduce cross-site request risk, but HTTPS and correct deployment settings still matter.
- Public registration creates `petugas` accounts. Disable or restrict registration before exposing the app on a public network.
- There is no login rate limiting, account recovery, or role-based authorization. Those are outside this jobsheet and matter for production use.
- The database connection message hides PDO exception details from visitors, but server logging and monitoring still need deployment configuration.

## Local check notes

- All 25 PHP files passed `php -l` with Laragon PHP 8.3.33.
- The HTTP checks used PHP's built-in server with a writable temporary session directory. The normal Laragon session folder was not writable in this workspace, so the first attempt could not persist a token; that was an environment issue, not an application finding.
- A token-bearing login POST advanced to the database connection step. The local database connection was unavailable, so registration, successful login, book/member CRUD, and the browser XSS scenario have not been marked as passed.
