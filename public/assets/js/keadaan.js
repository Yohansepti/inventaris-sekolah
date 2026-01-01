/* =========================================================
   KIB B – Script Halaman
   Mengelola:
   - Modal Edit Kondisi Barang
   - Tombol Aksi Edit
   - Search / Pencarian Tabel
   ========================================================= */

/* -----------------------------
   1. Elemen DOM
------------------------------ */
const modalEdit = document.getElementById("modalEditKeadaan");
const closeEditBtn = document.querySelector(".close-edit");
const formEdit = document.getElementById("formEditKeadaan");

// Elemen tabel
const searchInput = document.getElementById("searchInput");
const table = document.getElementById("kibBArea");
const rows = table ? table.getElementsByTagName("tr") : [];

/* -----------------------------
   2. Buka Modal Edit
------------------------------ */
function openEditModal(row) {
    const id = row.getAttribute("data-id");
    const kondisi = row.getAttribute("data-kondisi");

    // Masukkan ke form
    document.getElementById("editId").value = id;
    document.getElementById("editKondisi").value = kondisi;

    modalEdit.style.display = "flex";
}

/* -----------------------------
   3. Tutup Modal
------------------------------ */
function closeEditModal() {
    modalEdit.style.display = "none";
}

/* -----------------------------
   4. Event Listener Tombol Edit
------------------------------ */
function activateEditButtons() {
    const editButtons = document.querySelectorAll(".btn-edit");

    editButtons.forEach(btn => {
        btn.addEventListener("click", function () {
            const row = this.closest("tr");
            openEditModal(row);
        });
    });
}

/* -----------------------------
   5. Proses Submit Form Edit
------------------------------ */
if (formEdit) {
    formEdit.addEventListener("submit", function (e) {
        e.preventDefault();

        const id = document.getElementById("editId").value;
        const kondisi = document.getElementById("editKondisi").value;

        // Kirim ke backend menggunakan fetch
        fetch("../proses/proses_update_keadaan_kib_b.php", {
            method: "POST",
            body: new URLSearchParams({ id, kondisi })
        })
        .then(res => res.text())
        .then(() => {
            alert("Kondisi berhasil diperbarui");

            // Reload halaman untuk update tabel
            location.reload();
        })
        .catch(err => {
            console.error(err);
            alert("Gagal memperbarui kondisi");
        });
    });
}

/* -----------------------------
   6. Tutup Modal saat klik X
------------------------------ */
if (closeEditBtn) {
    closeEditBtn.addEventListener("click", closeEditModal);
}

/* -----------------------------
   7. Tutup Modal saat klik luar
------------------------------ */
window.addEventListener("click", function (e) {
    if (e.target === modalEdit) {
        closeEditModal();
    }
});

/* -----------------------------
   8. Search / Pencarian Tabel
------------------------------ */
if (searchInput) {
    searchInput.addEventListener("keyup", function () {
        const filter = this.value.toLowerCase();

        for (let i = 1; i < rows.length; i++) {
            let cells = rows[i].getElementsByTagName("td");
            let found = false;

            for (let j = 0; j < cells.length; j++) {
                let text = cells[j].textContent.toLowerCase();
                if (text.indexOf(filter) > -1) {
                    found = true;
                    break;
                }
            }

            rows[i].style.display = found ? "" : "none";
        }
    });
}

/* -----------------------------
   9. Jalankan saat halaman siap
------------------------------ */
document.addEventListener("DOMContentLoaded", () => {
    activateEditButtons();
});
