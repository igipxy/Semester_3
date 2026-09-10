# Jobsheet 2 Basic CSS3 Styling Complete Guide

This folder contains the finished SIMPUS-Mini project for Jobsheet 2. The result has five connected HTML pages and one shared stylesheet. The main lesson is separation of concerns: HTML provides the structure and meaning, while CSS controls the appearance.

## Scope and instruction boundary

### Required by Jobsheet 2

- Keep the five-page HTML structure from Jobsheet 1.
- Add one external stylesheet at `assets/css/style.css`.
- Link `index.html` with `assets/css/style.css`.
- Link every HTML file inside `buku` and `anggota` with `../assets/css/style.css`.
- Implement the documented reset, base styles, Flexbox navbar, centered content cards, CSS Grid statistics, table styling, form styling, and footer styling.
- Open the project in a browser, inspect elements with DevTools, and try temporary CSS changes.

### Optional ideas in Jobsheet 2

The green color scheme, fourth statistics card, third table button, and narrow-screen experiment are explicitly optional practice. They are not applied to the main submission because they would change the required blue, three-column reference result. Instructions for trying them are included near the end of this guide.

### Completed to satisfy your request

- Built the complete project instead of only summarizing the document.
- Supplied all five HTML files and the complete stylesheet.
- Completed the referenced HTML foundation, including connected navigation, seven books, two members, a Join Date column, an Email field, and synchronized homepage totals.
- Added this start-to-finish explanation and verification checklist.

## Finished folder structure

```text
jobsheet-02/
|-- index.html
|-- README.md
|-- assets/
|   `-- css/
|       `-- style.css
|-- buku/
|   |-- list.html
|   `-- tambah.html
`-- anggota/
    |-- list.html
    `-- tambah.html
```

## Step 1 Understand the HTML and CSS relationship

HTML answers "what is this content?" A `<header>` is a page header, a `<nav>` contains navigation, a `<table>` holds tabular data, and a `<form>` collects input. CSS answers "how should it look?"

A CSS rule has this pattern:

```css
selector {
    property: value;
}
```

For example:

```css
header {
    background-color: #1d5b8a;
    color: #fff;
}
```

`header` is the selector, `background-color` and `color` are properties, and the hex codes are their values.

## Step 2 Connect the shared stylesheet

The root page and nested pages need different relative paths.

In `index.html`:

```html
<link rel="stylesheet" href="assets/css/style.css">
```

In every page inside `buku` or `anggota`:

```html
<link rel="stylesheet" href="../assets/css/style.css">
```

`..` means "go up one folder." If it is omitted on a nested page, the browser looks for a nonexistent `buku/assets` or `anggota/assets` folder and the page appears unstyled.

## Step 3 Reset browser defaults and style the body

```css
* {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
}
```

The universal selector `*` applies to every element. Removing default margins and padding gives a consistent starting point. `box-sizing: border-box` makes a declared width include its padding and border, so sizing is easier to predict.

The `body` rule sets the default font, text color, page background, and line spacing. These values are inherited by most child elements.

## Step 4 Build the header with Flexbox

```css
header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
}
```

`display: flex` places the heading and navigation in one row. `align-items: center` aligns them vertically. `justify-content: space-between` pushes the title left and the menu right. `flex-wrap: wrap` allows them to move to another line when there is not enough width.

The nested `header nav ul` rule uses Flexbox again to arrange the menu items horizontally. `header nav a` is more specific than the general `a` selector, so navbar links become white while ordinary links remain blue.

## Step 5 Center the content and create section cards

```css
main {
    max-width: 1000px;
    margin: 2rem auto;
    padding: 0 1.5rem;
}
```

`max-width` prevents overly long lines on wide monitors. The horizontal `auto` margins center the content. Each section receives a white background, rounded corners, internal spacing, separation below it, and a subtle `rgba` shadow.

## Step 6 Arrange statistics with CSS Grid

```css
main section:nth-of-type(2) {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 1rem;
}
```

`:nth-of-type(2)` selects the second `<section>` inside `<main>`, which is the Summary section on the homepage. `repeat(3, 1fr)` creates three equal columns. Each direct `<article>` becomes a statistics card.

The supplied jobsheet code does not tell the Summary `<h2>` to span the Grid. Without the following rule, the heading occupies column one and pushes the third card to a second row, contradicting the jobsheet's stated three-card result. The completed stylesheet includes this minimal correction:

```css
main section:nth-of-type(2) h2 {
    grid-column: 1 / -1;
}
```

This selector depends on the section order. If Summary is moved to another position, the Grid rule will target the wrong section. A class such as `.stat-grid` would be more maintainable in a larger project, but this jobsheet intentionally demonstrates a position-based pseudo-class.

## Step 7 Style the tables

`width: 100%` lets the table use the section width, and `border-collapse: collapse` merges neighboring cell borders. The header row uses the same blue as the page header. `tbody tr:nth-child(even)` creates zebra stripes, while `tbody tr:hover` highlights the row under the pointer.

The Edit and Delete colors use position-based selectors:

```css
td button:first-of-type { background-color: #f0ad4e; }
td button:last-of-type { background-color: #d9534f; }
```

This works because Edit is first and Delete is last. The buttons use `type="button"` so they do not accidentally submit a form.

## Step 8 Style and validate the forms

`form label { display: block; }` places each label on its own line. Inputs and selects use `width: 100%` but stop growing at `400px`. The attribute selector `form button[type="submit"]` styles only Save buttons, not the table buttons.

HTML performs basic validation:

- `required` prevents submission when mandatory fields are empty.
- `min="1900"` and `max="2026"` constrain the publication year.
- `min="0"` prevents negative stock.
- `type="email"` checks the basic email address format.
- Member numbers use `type="text"` because values such as `A001` contain letters and leading zeros.

The forms intentionally have no `action` or backend. Pressing Save after valid input reloads or submits to the current page, but nothing is permanently stored.

## Step 9 Open and test the project

1. Open the `jobsheet-02` folder in Visual Studio Code.
2. Open `index.html` in Chrome, Edge, or Firefox. You can double-click the file or use a local preview extension.
3. Click all five navigation items from every page.
4. Confirm the homepage has two white sections and three blue-tinted statistics cards.
5. Confirm both list pages have colored table headers, alternating rows, hover feedback, orange Edit buttons, and red Delete buttons.
6. Open both forms and press Save with required fields empty. The browser must show validation warnings.
7. Enter an invalid year or negative stock and confirm validation blocks submission.
8. Right-click an element and choose Inspect. In DevTools, temporarily change a CSS value and observe the result. Refreshing the page restores the saved stylesheet.

## Verification checklist

- [x] Five HTML pages exist.
- [x] Every page links to the shared stylesheet with the correct relative path.
- [x] Every navigation link points to an existing page.
- [x] The homepage statistics match seven books and two members.
- [x] The book table contains seven sample records.
- [x] The member table contains two records and a Join Date column.
- [x] Required, minimum, maximum, and email validation attributes are present.
- [x] Edit and Delete buttons use `type="button"`.
- [x] Save buttons use `type="submit"`.

## Answers to the referenced HTML understanding questions

1. `<!DOCTYPE html>` tells the browser to interpret the document using modern HTML5 standards.
2. `<header>` contains introductory content or navigation, `<main>` contains the page's unique primary content, and `<footer>` contains closing or supplementary information.
3. A page inside `buku` or `anggota` uses `../index.html` because `..` moves from the current subfolder to the project root before opening `index.html`.
4. `<th>` is a header cell that labels a row or column; `<td>` is a normal data cell.
5. Edit and Delete use `type="button"` to prevent unintended form submission.
6. `required` tells the browser that a field must contain a valid value before the form can submit.
7. `id` uniquely identifies an element and connects it to a `<label>`; `name` is the key used when the form value is submitted.
8. A member number uses `type="text"` because identifiers such as `A001` are not quantities and may include letters or leading zeros.
9. With no `action`, the browser submits to the current page by default. Because there is no backend, the entered data is not saved permanently.

## Optional Jobsheet 2 experiments

Make a backup before each experiment so the required result remains intact.

### Change the theme to dark green

Replace every `#1d5b8a` with a dark green such as `#1f6b45`, then choose a darker hover color to replace `#164869`.

### Add a fourth statistics card

Add another `<article>` inside the Summary section and change:

```css
grid-template-columns: repeat(3, 1fr);
```

to:

```css
grid-template-columns: repeat(4, 1fr);
```

### Add a Details button safely

Adding a middle button demonstrates the weakness of `:first-of-type` and `:last-of-type`. A more reliable solution uses semantic classes:

```html
<button type="button" class="btn-edit">Edit</button>
<button type="button" class="btn-details">Details</button>
<button type="button" class="btn-delete">Delete</button>
```

```css
.btn-edit { background-color: #f0ad4e; color: #fff; }
.btn-details { background-color: #5bc0de; color: #fff; }
.btn-delete { background-color: #d9534f; color: #fff; }
```

### Test narrow-screen behavior

Reduce the browser width slowly. The header can wrap because of `flex-wrap: wrap`. The three-column Grid remains three columns because Jobsheet 2 does not yet add a media query; responsive layout changes belong to the next lesson.
