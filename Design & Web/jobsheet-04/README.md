# Jobsheet 4 UI UX Design

This folder is the completed Jobsheet 4 version of SIMPUS-Mini. The five HTML pages and the CSS file remain exactly the same as Jobsheet 3. Jobsheet 4 adds design planning in `docs/wireframe.md`; it does not implement Login, Dashboard, Borrowing, Returns, or History yet.

## Required scope

1. Keep the existing Jobsheet 3 HTML and CSS unchanged.
2. Add `docs/wireframe.md` as the design plan for future features.
3. Define the Guest and Officer actors.
4. Draw wireframes for Login, Officer Dashboard, New Loan, Return, and Transaction History.
5. Describe the borrowing and return user flows.
6. Record the business rules and edge cases that later jobsheets must implement.
7. Explain how the designs remain consistent with the existing navigation, cards, tables, forms, and responsive behavior.

## Folder structure

```text
jobsheet-04/
|-- index.html
|-- README.md
|-- assets/
|   `-- css/
|       `-- style.css
|-- buku/
|   |-- list.html
|   `-- tambah.html
|-- anggota/
|   |-- list.html
|   `-- tambah.html
`-- docs/
    `-- wireframe.md
```

## What changed from Jobsheet 3

Only these documentation files are new or updated:

- `docs/wireframe.md` contains the required UI/UX design.
- `README.md` explains the Jobsheet 4 scope.

The following implementation files are unchanged from Jobsheet 3:

- `index.html`
- `assets/css/style.css`
- `buku/list.html`
- `buku/tambah.html`
- `anggota/list.html`
- `anggota/tambah.html`

## How to review this jobsheet

1. Read the actors and access rules in `docs/wireframe.md`.
2. Read each wireframe as a rough page layout, not as final visual styling.
3. Follow the borrowing flow from Login to Dashboard and back to Dashboard.
4. Follow the return flow and compare its stock change with the borrowing flow.
5. Compare the planned Dashboard navigation, statistic cards, tables, and forms with the existing pages.
6. Confirm that every important edge case is written down before implementation begins.

## Important boundary

The Login, Dashboard, Borrowing, Returns, and History pages are designs only. Real authentication, authorization, sessions, database updates, stock changes, and late-payment validation require JavaScript or server-side code in later jobsheets.

The optional exercise of creating a static Login page is intentionally not included in this required project version.
