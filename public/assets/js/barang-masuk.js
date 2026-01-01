// Hitung jumlah baris
function updateTotal() {
    const rows = document.querySelectorAll("#tableMasuk tbody tr").length;
    document.getElementById("totalBarang").textContent = rows;
}

updateTotal();

// Tombol Cetak
document.getElementById("btnCetak").addEventListener("click", function () {

    // Set tahun ke header cetak
    document.getElementById("tahunCetak").textContent =
        document.getElementById("filterTahun").value;

    // Tampilkan elemen print-only
    document.querySelector(".print-header").style.display = "block";
    document.querySelector(".print-footer").style.display = "flex";

    window.print();

    // Sembunyikan kembali setelah selesai print
    setTimeout(() => {
        document.querySelector(".print-header").style.display = "none";
        document.querySelector(".print-footer").style.display = "none";
    }, 300);
});

// Filter Tahun
document.getElementById("filterTahun").addEventListener("change", function () {
    alert("Filter tahun: " + this.value);
});

function go(id, page) {
    const el = document.getElementById(id);
    if (el) {
        el.addEventListener("click", () => {
            window.location.href = page;
        });
    }
}

// Navigasi Tambah tiap KIB
go("btnTambah", "kib-a-add.html");
go("btnTambahB", "kib-b-add.html");
go("btnTambahC", "kib-c-add.html");
go("btnTambahD", "kib-d-add.html");
go("btnTambahE", "kib-e-add.html");
go("btnTambahF", "kib-f-add.html");



