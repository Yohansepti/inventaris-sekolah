const tableBody = document.getElementById("ruangTableBody");
const totalRuang = document.getElementById("jumlahRuang");

async function loadRuang() {
    try {
        const response = await fetch("http://localhost/KP3/api/ruangan/get.php");
        const data = await response.json();

        tableBody.innerHTML = "";

        data.forEach(r => {
            const row = `
                <tr>
                    <td>${r.kode_ruangan}</td>
                    <td>${r.nama_ruangan}</td>
                </tr>
            `;
            tableBody.innerHTML += row;
        });

        totalRuang.textContent = data.length;
    } catch (err) {
        console.error("Gagal load data ruang:", err);
    }
}

loadRuang();

// Dropdown sidebar
const dropdowns = document.getElementsByClassName("dropdown-btn");
for (let i = 0; i < dropdowns.length; i++) {
    dropdowns[i].addEventListener("click", function () {
        let content = this.nextElementSibling;
        content.style.display = content.style.display === "block" ? "none" : "block";
    });
}
