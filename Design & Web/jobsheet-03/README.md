# Jobsheet 3 Responsive Design Complete Guide

This folder contains the completed Jobsheet 3 version of SIMPUS-Mini. It keeps the five-page HTML and CSS styling from Jobsheet 2, then adds responsive behavior for desktop, tablet, and mobile screens without JavaScript.

## Scope and instruction boundary

### Required by the Jobsheet 3 PDF

1. Add `<meta name="viewport">` to all five HTML pages.
2. Add a checkbox and label inside every `<header>` to create a CSS-only hamburger menu.
3. Wrap the tables in `buku/list.html` and `anggota/list.html` with `<div class="table-responsive">`.
4. Add `.table-responsive { overflow-x: auto; }`.
5. Add a tablet breakpoint at `768px`, changing the statistics Grid from three columns to two.
6. Add a mobile breakpoint at `480px`, changing the Grid to one column, hiding and toggling the navigation, stacking menu items vertically, and allowing form controls to use the full width.
7. Test the result using the browser's responsive or device mode.

The PDF translates the folder names inconsistently as `books/members` in one overview while its code references `buku/anggota`. This project retains `buku` and `anggota` so it remains compatible with the completed Jobsheet 2 links.

### Optional material in the PDF

The new `1400px` breakpoint, changing `768px` to `900px`, applying overflow to a `<pre>` element, moving the hamburger label, and rewriting the project mobile-first are listed under **Additional Exercise Ideas Optional**. They are explained at the end but are not applied to the required submission.

### Completed for your request

- Built the complete Jobsheet 3 project rather than only summarizing the PDF.
- Preserved all five working pages, forms, tables, sample data, and navigation from Jobsheet 2.
- Added the mandatory responsive HTML and CSS to every relevant page.
- Retained the small Grid-heading correction from Jobsheet 2 so the stated `3 -> 2 -> 1` card layout works correctly.
- Added this start-to-finish explanation and a testing checklist.

## Final folder structure

```text
jobsheet-03/
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

## Step 1 Add the viewport metadata

All five pages contain this line directly inside `<head>`:

```html
<meta name="viewport" content="width=device-width, initial-scale=1.0">
```

`width=device-width` tells the browser to use the device's real screen width. `initial-scale=1.0` starts the page at normal zoom. Without this line, a mobile browser may assume a desktop-like layout viewport and shrink the entire page, preventing the breakpoints from behaving as intended.

## Step 2 Add the hamburger controls

Every header follows this order:

```html
<header>
    <h1>SIMPUS-Mini</h1>
    <input type="checkbox" id="nav-toggle" class="nav-toggle">
    <label for="nav-toggle" class="nav-toggle-label" aria-label="Open or close navigation menu">&#9776;</label>
    <nav>
        <!-- menu items -->
    </nav>
</header>
```

The checkbox stores the state: unchecked means closed and checked means open. The label is connected through `for="nav-toggle"`, so clicking the `☰` label toggles the hidden checkbox.

The basic CSS hides both controls on wide screens:

```css
.nav-toggle {
    display: none;
}

.nav-toggle-label {
    display: none;
    font-size: 1.6rem;
    color: #fff;
    cursor: pointer;
}
```

The checkbox and `<nav>` must remain siblings, with `<nav>` after the checkbox. That structure is required by the general sibling combinator used later.

## Step 3 Make both tables horizontally scrollable

The tables on the Book List and Member List pages are wrapped like this:

```html
<div class="table-responsive">
    <table>
        <!-- table content -->
    </table>
</div>
```

The wrapper receives:

```css
.table-responsive {
    overflow-x: auto;
}
```

When the table is wider than its section, only the wrapper scrolls horizontally. On a desktop, no unnecessary scrollbar appears because `auto` shows it only when needed.

## Step 4 Add the tablet breakpoint

The project uses the desktop-first strategy: desktop styles are the defaults, and narrower layouts override them at the bottom of the stylesheet.

```css
@media (max-width: 768px) {
    main section:nth-of-type(2) {
        grid-template-columns: repeat(2, 1fr);
    }
}
```

At widths above `768px`, the homepage uses three columns. At `768px` and below, it uses two columns and the third card moves to a new row automatically.

## Step 5 Add the mobile breakpoint

```css
@media (max-width: 480px) {
    header {
        position: relative;
    }

    .nav-toggle-label {
        display: block;
    }

    header nav {
        display: none;
        width: 100%;
        order: 3;
        margin-top: 1rem;
    }

    .nav-toggle:checked ~ nav {
        display: block;
    }

    header nav ul {
        flex-direction: column;
        gap: 0.75rem;
    }

    main section:nth-of-type(2) {
        grid-template-columns: 1fr;
    }

    form input,
    form select {
        max-width: 100%;
    }
}
```

At `480px` and below, the hamburger appears, the regular navigation starts hidden, its items stack vertically when opened, the statistics use one column, and form controls may use the full width. No JavaScript is involved: the native checkbox state and `:checked` pseudo-class provide the interaction.

## Step 6 Understand the responsive progression

| Screen width | Statistics Grid | Navigation |
|---|---|---|
| Above 768px | Three columns | Full horizontal menu |
| 481px to 768px | Two columns | Full horizontal menu, wrapping if needed |
| 480px and below | One column | Hamburger button and vertical toggle menu |

The breakpoints are design choices, not universal device definitions. They work here because those are the widths where this layout needs to rearrange.

## Step 7 Test the finished project

1. Open `index.html` in Chrome, Edge, or Firefox.
2. Open DevTools with `F12` and enable device mode with `Ctrl+Shift+M`.
3. Above `768px`, confirm that three cards share one row.
4. At `768px`, confirm that the Grid has two columns.
5. At `480px`, confirm that the Grid has one column and the normal menu starts hidden.
6. Click `☰`; the menu must open vertically without reloading. Click again to close it.
7. Open both list pages at mobile width and scroll horizontally inside the table area.
8. Open both forms and confirm that controls fill the available mobile content width.
9. Test every navigation link at desktop and mobile widths.

## Verification checklist

- [x] Five HTML pages are present.
- [x] All pages contain the viewport meta element.
- [x] All headers contain the checkbox, connected label, and following navigation.
- [x] The hamburger appears only at `480px` and below.
- [x] The menu opens through `.nav-toggle:checked ~ nav` without JavaScript.
- [x] Both tables are wrapped by `.table-responsive`.
- [x] The statistics layout changes from three to two to one column.
- [x] Mobile form controls use `max-width: 100%`.
- [x] Navigation and stylesheet paths still resolve from all folders.

## Important concepts

**Responsive Web Design:** One HTML and CSS codebase adapts to different screen sizes.

**Media query:** A conditional CSS block whose rules apply only while conditions such as `max-width` are true.

**Breakpoint:** A width where the layout changes because the current design no longer fits comfortably.

**Desktop-first:** Large-screen styles are defaults, followed by `max-width` overrides for smaller screens.

**Pseudo-class `:checked`:** Selects a checkbox while it is checked.

**General sibling combinator `~`:** Selects a later sibling. In `.nav-toggle:checked ~ nav`, it selects the `<nav>` following the checked checkbox.

**Horizontal overflow:** `overflow-x: auto` allows wide content to scroll sideways without forcing the entire page to widen.

## Optional exercises from the PDF

Keep a backup of the required version before experimenting.

### Very wide monitor breakpoint

```css
@media (min-width: 1400px) {
    main {
        max-width: 1200px;
    }
}
```

### Move the tablet breakpoint

Change `@media (max-width: 768px)` to `@media (max-width: 900px)` and observe that the two-column layout starts earlier.

### Apply horizontal overflow to code

```css
pre {
    overflow-x: auto;
}
```

### Experiment with hamburger element order

If `<nav>` is moved before the checkbox, `.nav-toggle:checked ~ nav` stops working because `~` can select only a sibling that appears after the source element.

### Compare with mobile-first CSS

A mobile-first version would use the one-column layout as its default and introduce wider layouts with `@media (min-width: 481px)` and `@media (min-width: 769px)`. Converting the whole stylesheet is a separate exercise rather than part of the required submission.
