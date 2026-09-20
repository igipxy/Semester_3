# Panduan Belajar Jobsheet 7 PHP Basics dan Form Handling

## Gambaran besar

Pada Jobsheet 6, browser mengambil JSON lalu JavaScript membuat baris tabel. Pada Jobsheet 7, browser mengirim form ke server. PHP memeriksa data, menyimpannya sementara dalam session, lalu mengirim browser ke halaman list. PHP sudah selesai bekerja sebelum browser menerima halaman.

```text
Browser form -> POST -> proses_tambah.php -> validate -> $_SESSION
                                      -> redirect -> list.php -> HTML table
```

## 1. PHP berjalan di server

Kode di antara `<?php` dan `?>` diproses oleh PHP. Browser hanya menerima hasil akhirnya, misalnya HTML yang sudah berisi sebuah baris tabel. Karena itu, PHP harus dibuka melalui server such as `php -S localhost:8000`, not by double-clicking a file.

```php
<p><?php echo $total_buku; ?></p>
```

`$total_buku` is a PHP variable. `echo` inserts its value into the HTML response. PHP variables always start with `$` and PHP statements end with `;`.

## 2. `include` prevents repeated page code

Each page sets a title, includes the shared header, writes its unique content, then includes the shared footer.

```php
$page_title = 'Book List';
include __DIR__ . '/../includes/header.php';
// page-specific HTML and PHP
include __DIR__ . '/../includes/footer.php';
```

`__DIR__` means the folder containing the current PHP file. It makes the include path reliable from both the project root and a nested folder such as `buku/`. `header.php` also calculates `$base`, so navigation, CSS, and JavaScript links work from either depth.

## 3. Form data arrives in `$_POST`

The form in `buku/tambah.php` contains:

```html
<form method="post" action="proses_tambah.php">
```

When Save is pressed, `proses_tambah.php` receives each value using the input's `name` attribute.

```php
$title = trim($_POST['title'] ?? '');
```

`trim()` removes outer spaces. `?? ''` means use an empty string if the field was not sent, avoiding an undefined-key warning.

## 4. Server-side validation is the real gate

JavaScript validation improves the user experience, but users can disable it. PHP checks the same essential rules on the server.

```php
if ($title === '') $errors[] = 'Title is required.';
if (filter_var($stock, FILTER_VALIDATE_INT) === false || (int) $stock < 0) {
    $errors[] = 'Stock must be zero or greater.';
}
```

If errors exist, PHP saves one error flash message, redirects to the form, and uses `exit` so invalid data cannot continue into the save code.

## 5. Session connects separate page requests

HTTP does not remember a previous request by itself. `session_start()` lets PHP identify the same browser session and use `$_SESSION` as temporary server-side storage.

```php
$_SESSION['buku'][] = [
    'title' => $title,
    'author' => $author,
    'year' => (int) $year,
    'stock' => (int) $stock,
];
```

The `[]` adds one record to the end of the books array. `(int)` converts form text into integers. Session data stays only while the browser session remains active; it is not a database.

## 6. Redirect and flash messages

After processing POST, PHP redirects instead of rendering the list immediately.

```php
$_SESSION['flash'] = ['type' => 'success', 'message' => 'Book added successfully.'];
header('Location: list.php');
exit;
```

`list.php` reads the flash message and immediately removes it with `unset($_SESSION['flash'])`. That is why the green or red message appears once, while the session record remains.

## 7. PHP renders the table with `foreach`

```php
foreach ($daftar_buku as $buku):
    echo $buku['title'];
endforeach;
```

This is the PHP equivalent of JavaScript `array.forEach()`, but the loop runs before the browser receives HTML. `e(...)` safely escapes displayed text so submitted markup cannot become executable HTML.

## Important boundary

Jobsheet 7 has real server-side form processing and validation, but it still has no permanent database. Jobsheet 8 should replace `$_SESSION` storage with PostgreSQL.
