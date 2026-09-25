# Jobsheet 9 Full CRUD

Jobsheet 9 extends the existing PHP and PostgreSQL SIMPUS-Mini project with persistent Update and Delete operations. It also adds server-side search and five-row pagination to both data lists.

## Features

- Create and Read are retained from Jobsheet 8.
- Edit pages load one row using its ID and prefill the form.
- Update handlers validate POST data and use prepared UPDATE statements with WHERE id = :id.
- Delete handlers accept POST only and use prepared DELETE statements with WHERE id = :id.
- JavaScript asks for confirmation on form submit. Cancel prevents the POST; confirm allows PHP/PostgreSQL to do the deletion.
- Lists search across database records using PostgreSQL ILIKE and show five rows per page with LIMIT/OFFSET.
- Search and pagination work together. The optional instant filter narrows the current page.
- The helper e() escapes displayed user values in HTML.

## Use your existing database

This project expects the database named web, created in Jobsheet 8. Set the password in includes/koneksi.php to your own local PostgreSQL password. Do not use the example password unless it is the one configured on your computer.

If you have not created the tables yet, open a terminal in this jobsheet-09 folder and run:

    psql -U postgres -d web -f sql/01_buku_anggota.sql

The SQL uses CREATE TABLE IF NOT EXISTS, so running it again does not replace table data.

## Run with Laragon

1. Start Apache and PostgreSQL in Laragon.
2. Put the repository under Laragon's www folder, or use Laragon's configured web root.
3. Confirm PHP has pdo_pgsql enabled and update includes/koneksi.php credentials.
4. Open http://localhost/Semester_3/Design%20%26%20Web/jobsheet-09/ or start the PHP development server in this folder with php -S localhost:8000.
5. Open the corresponding local URL in your browser.

## CRUD routes

- Books: buku/list.php, tambah.php, edit.php?id=ID, proses_edit.php, hapus.php.
- Members: anggota/list.php, tambah.php, edit.php?id=ID, proses_edit.php, hapus.php.

## Learning and test guide

See PANDUAN_BELAJAR.md for file-by-file explanations and a safe test sequence. Test with disposable records first. Database writes require your working local PostgreSQL service and correct credentials.
