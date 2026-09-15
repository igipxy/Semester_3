"use strict";

// Retrieve and display the Book List asynchronously from data/buku.json.
async function muatDaftarBuku() {
    const tbody = document.querySelector(".table-responsive table tbody");
    const loading = document.getElementById("loading-indicator");

    if (!tbody || !loading) return;

    loading.style.display = "block";
    tbody.innerHTML = "";

    try {
        // Simulate a short network delay so the loading state can be observed.
        await new Promise(function (resolve) {
            setTimeout(resolve, 600);
        });

        const response = await fetch("../data/buku.json");
        if (!response.ok) {
            throw new Error(`Failed to retrieve data (status ${response.status})`);
        }

        const daftarBuku = await response.json();

        daftarBuku.forEach(function (buku) {
            const tr = document.createElement("tr");
            tr.innerHTML =
                "<td>" + buku.title + "</td>" +
                "<td>" + buku.author + "</td>" +
                "<td>" + buku.year + "</td>" +
                "<td>" + buku.stock + "</td>" +
                "<td>" +
                "<button type=\"button\">Edit</button> " +
                "<button type=\"button\" class=\"btn-delete\">Delete</button>" +
                "</td>";
            tbody.appendChild(tr);
        });
    } catch (error) {
        tbody.innerHTML =
            '<tr><td colspan="5">Failed to load data: ' + error.message + "</td></tr>";
    } finally {
        loading.style.display = "none";
    }
}

document.addEventListener("DOMContentLoaded", muatDaftarBuku);
