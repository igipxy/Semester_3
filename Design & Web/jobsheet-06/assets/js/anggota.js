"use strict";

// Retrieve and display the Member List asynchronously from data/anggota.json.
async function muatDaftarAnggota() {
    const tbody = document.querySelector(".table-responsive table tbody");
    const loading = document.getElementById("loading-indicator");

    if (!tbody || !loading) return;

    loading.style.display = "block";
    tbody.innerHTML = "";

    try {
        await new Promise(function (resolve) {
            setTimeout(resolve, 600);
        });

        const response = await fetch("../data/anggota.json");
        if (!response.ok) {
            throw new Error(`Failed to retrieve data (status ${response.status})`);
        }

        const daftarAnggota = await response.json();

        daftarAnggota.forEach(function (anggota) {
            const tr = document.createElement("tr");
            tr.innerHTML =
                "<td>" + anggota.no_anggota + "</td>" +
                "<td>" + anggota.name + "</td>" +
                "<td>" + anggota.address + "</td>" +
                "<td>" + anggota.no_hp + "</td>" +
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

document.addEventListener("DOMContentLoaded", muatDaftarAnggota);
