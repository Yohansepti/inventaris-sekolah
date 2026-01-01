/* =========================
   JS UNTUK TABEL PEMINJAMAN
   ========================= */
if (document.getElementById("tablePinjam")) {

    // Hitung total
    function updateTotal() {
        const rows = document.querySelectorAll("#tablePinjam tbody tr");
        let count = 0;
        rows.forEach(row => {
            if (!row.innerText.includes("Data peminjaman tidak tersedia")) {
                count++;
            }
        });
        document.getElementById("totalPinjam").textContent = count;
    }
    updateTotal();

    // Tombol Cetak
    document.getElementById("btnCetak").addEventListener("click", () => {

        // isi tahun otomatis
        document.getElementById("tahunCetak").textContent =
            document.getElementById("filterTahun").value;

        // tampilkan bagian cetak
        document.querySelector(".print-header-peminjaman").style.display = "block";
        document.querySelector(".print-footer-peminjaman").style.display = "flex";

        window.print();

        // sembunyikan lagi setelah print selesai
        setTimeout(() => {
            document.querySelector(".print-header-peminjaman").style.display = "none";
            document.querySelector(".print-footer-peminjaman").style.display = "none";
        }, 300);
    });


    // Filter Tahun
    document.getElementById("filterTahun").addEventListener("change", function () {
        window.location.href = "/peminjaman?tahun=" + this.value;
    });

    // Button Tambah
    document.getElementById("btnTambah").addEventListener("click", function () {
        window.location.href = "peminjaman-input.html";
    });
}


/* =========================
   JS UNTUK INPUT PEMINJAMAN
   ========================= */
if (document.getElementById("btnSimpan")) {

    document.getElementById("btnSimpan").addEventListener("click", () => {

        const data = {
            tglPinjam: document.getElementById("tglPinjam").value,
            tglPesan: document.getElementById("tglPesan").value,
            tglKembali: document.getElementById("tglKembali").value,
            guru: document.getElementById("guru").value,
            barang: document.getElementById("barang").value,
            jam: document.getElementById("jam").value,
            ruang: document.getElementById("ruang").value
        };

        // validasi sederhana
        if (!data.tglPinjam || !data.guru || !data.barang) {
            alert("Harap isi semua data penting!");
            return;
        }

        alert("Data peminjaman berhasil disimpan!");

        // kembali ke halaman peminjaman
        window.location.href = "peminjaman.html";
    });
}

let currentIndex = null;

document.querySelectorAll(".btn-edit").forEach((btn, index) => {
    btn.addEventListener("click", function () {
        currentIndex = index;

        // Ambil status dari tabel row yang diklik
        let row = document.querySelectorAll("#tablePinjam tbody tr")[index];
        let currentStatus = row.children[7].innerText;

        document.getElementById("editStatus").value =
            currentStatus === "Dikembalikan" ? "Dikembalikan" : "Dipinjam";

        document.getElementById("editModal").style.display = "flex";
    });
});

// tombol batal
document.getElementById("modalCancel").onclick = function () {
    document.getElementById("editModal").style.display = "none";
};

// tombol simpan
document.getElementById("modalSave").onclick = function () {
    if (currentIndex !== null) {
        let newStatus = document.getElementById("editStatus").value;
        let row = document.querySelectorAll("#tablePinjam tbody tr")[currentIndex];

        row.children[7].innerText =
            newStatus === "Dikembalikan" ? "Dikembalikan" : "Dipinjam";

        document.getElementById("editModal").style.display = "none";
    }
};


