"use strict";

function initNavToggle() {
    const toggleBtn = document.getElementById("nav-toggle-btn");
    const nav = document.querySelector("header nav");
    if (!toggleBtn || !nav) return;

    toggleBtn.addEventListener("click", function () {
        const isOpen = nav.classList.toggle("nav-open");
        toggleBtn.setAttribute("aria-expanded", String(isOpen));
    });
}

// Listen for form submission so Cancel prevents the request reaching hapus.php.
function initHapusConfirm() {
    document.addEventListener("submit", function (event) {
        const form = event.target;
        if (!(form instanceof HTMLFormElement) || !form.matches(".form-hapus")) return;

        const row = form.closest("tr");
        const name = row ? row.querySelector("td")?.textContent.trim() : "this data";
        if (!window.confirm(`Are you sure you want to delete "${name}"?`)) {
            event.preventDefault();
        }
    });
}

// This quick filter narrows the rows already loaded on this page.
function initTableFilter() {
    const input = document.getElementById("search-input");
    const table = document.querySelector(".table-responsive table");
    if (!input || !table) return;

    input.addEventListener("input", function () {
        const keyword = input.value.trim().toLowerCase();
        table.querySelectorAll("tbody tr[data-search-row]").forEach(function (row) {
            row.hidden = !row.textContent.toLowerCase().includes(keyword);
        });
    });
}

function tampilkanError(input, message) {
    hapusError(input);
    const span = document.createElement("span");
    span.className = "error";
    span.textContent = message;
    input.insertAdjacentElement("afterend", span);
    input.setAttribute("aria-invalid", "true");
}

function hapusError(input) {
    const next = input.nextElementSibling;
    if (next && next.classList.contains("error")) next.remove();
    input.removeAttribute("aria-invalid");
}

function validasiWajib(input, message) {
    if (!input) return true;
    if (input.value.trim() === "") {
        tampilkanError(input, message);
        return false;
    }
    hapusError(input);
    return true;
}

function initValidasiForm() {
    const form = document.getElementById("form-tambah");
    if (!form) return;

    form.addEventListener("submit", function (event) {
        let valid = true;
        const titleOrName = form.querySelector("[name='title'], [name='name']");
        const author = form.querySelector("[name='author']");
        const memberNumber = form.querySelector("[name='member_number']");
        const year = form.querySelector("[name='year']");
        const stock = form.querySelector("[name='stock']");

        valid = validasiWajib(titleOrName, "This field is required.") && valid;
        valid = validasiWajib(author, "Author is required.") && valid;
        valid = validasiWajib(memberNumber, "Member number is required.") && valid;
        if (year) {
            const value = Number(year.value);
            if (!Number.isInteger(value) || value < 1900 || value > 2026) {
                tampilkanError(year, "Year must be between 1900 and 2026.");
                valid = false;
            } else hapusError(year);
        }
        if (stock) {
            const value = Number(stock.value);
            if (!Number.isInteger(value) || value < 0) {
                tampilkanError(stock, "Stock must be zero or greater.");
                valid = false;
            } else hapusError(stock);
        }
        if (!valid) {
            event.preventDefault();
            form.querySelector("[aria-invalid='true']")?.focus();
        }
    });
}

document.addEventListener("DOMContentLoaded", function () {
    initNavToggle();
    initHapusConfirm();
    initTableFilter();
    initValidasiForm();
});
