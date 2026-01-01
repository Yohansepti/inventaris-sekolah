// Data dummy guru (nanti bisa diganti dari backend)
const guruData = [
    { nama: "Yohana", nip: "19850129 202001 2 001", jabatan: "Guru" },
    { nama: "Marlina", nip: "19870214 201001 2 003", jabatan: "Guru" }
];

const tableBody = document.getElementById("guruTableBody");
const totalGuru = document.getElementById("totalGuru");

// Render data ke tabel
function loadGuru() {
    tableBody.innerHTML = "";

    guruData.forEach(g => {
        const row = `
            <tr>
                <td>${g.nama}</td>
                <td>${g.nip}</td>
                <td>${g.jabatan}</td>
            </tr>
        `;
        tableBody.innerHTML += row;
    });

    totalGuru.textContent = guruData.length;
}

loadGuru();

// Dropdown sidebar
const dropdowns = document.getElementsByClassName("dropdown-btn");
for (let i = 0; i < dropdowns.length; i++) {
    dropdowns[i].addEventListener("click", function () {
        let content = this.nextElementSibling;
        content.style.display = content.style.display === "block" ? "none" : "block";
    });
}
// Navigasi 
document.getElementById("btnTambah").addEventListener("click", () => {
    window.location.href = "guru-input.html";
});
