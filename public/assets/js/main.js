const dropdowns = document.getElementsByClassName("dropdown-btn");

for (let i = 0; i < dropdowns.length; i++) {
    dropdowns[i].addEventListener("click", function () {
        this.classList.toggle("active-dropdown");
        let content = this.nextElementSibling;
        content.style.display = content.style.display === "block" ? "none" : "block";
    });
}


/* ======================================
   KIB A 
   ====================================== */

const searchInputA = document.getElementById("searchInput");
const btnSearchA = document.getElementById("btnSearch");
const tableBodyA = document.getElementById("kibTable")?.getElementsByTagName("tbody")[0];
const totalA = document.getElementById("totalBarang");

function updateTotalA() {
    if (!tableBodyA) return;
    
    let visible = 0;
    const rows = tableBodyA.getElementsByTagName("tr");

    for (let i = 0; i < rows.length; i++) {
        if (rows[i].style.display !== "none") visible++;
    }

    totalA.textContent = visible;
}

btnSearchA?.addEventListener("click", function () {
    const filter = searchInputA.value.toLowerCase();
    const rows = tableBodyA.getElementsByTagName("tr");

    for (let i = 0; i < rows.length; i++) {
        const nama = rows[i].getElementsByTagName("td")[1].textContent.toLowerCase();
        rows[i].style.display = (nama.includes(filter) || filter === "") ? "" : "none";
    }

    updateTotalA();
});

updateTotalA();

/* ======================================
   KIB B 
   ====================================== */

const tableBodyB = document.getElementById("kibBTableBody");    // langsung tbody
const searchInputB = document.getElementById("searchB");
const btnSearchB = document.getElementById("btnSearchB");
const totalB = document.getElementById("totalB");

function updateTotalB() {
    let visible = 0;
    const rows = tableBodyB.querySelectorAll("tr");
    rows.forEach(row => {
        if (row.style.display !== "none") visible++;
    });
    totalB.textContent = visible;
}

btnSearchB?.addEventListener("click", () => {
    const filter = searchInputB.value.toLowerCase();
    const rows = tableBodyB.querySelectorAll("tr");

    rows.forEach(row => {
        const nama = row.children[1].textContent.toLowerCase();
        row.style.display = (nama.includes(filter) || filter === "") ? "" : "none";
    });

    updateTotalB();
});

updateTotalB();

/* ======================================
   KIB C 
   ====================================== */

const searchInputC = document.getElementById("searchInputC");
const btnSearchC = document.getElementById("btnSearchC");
const tableBodyC = document.getElementById("kibCTable")?.getElementsByTagName("tbody")[0];
const totalC = document.getElementById("totalIDC");

function updateTotalC() {
    if (!tableBodyC) return;
    
    let visible = 0;
    const rows = tableBodyC.getElementsByTagName("tr");

    for (let i = 0; i < rows.length; i++) {
        if (rows[i].style.display !== "none") visible++;
    }

    totalC.textContent = visible;
}

btnSearchC?.addEventListener("click", function () {
    const filter = searchInputC.value.toLowerCase();
    const rows = tableBodyC.getElementsByTagName("tr");

    for (let i = 0; i < rows.length; i++) {
        const nama = rows[i].getElementsByTagName("td")[1].textContent.toLowerCase();
        rows[i].style.display = (nama.includes(filter) || filter === "") ? "" : "none";
    }

    updateTotalC();
});

updateTotalC();

const searchInputD = document.getElementById("searchD");
const btnSearchD = document.getElementById("btnSearchD");
const tableBodyD = document.getElementById("kibDTableBody")?.getElementsByTagName("tbody")[0];
const totalD = document.getElementById("totalD");

function updateTotalD() {
    if (!tableBodyD) return;
    
    let visible = 0;
    const rows = tableBodyD.getElementsByTagName("tr");

    for (let i = 0; i < rows.length; i++) {
        if (rows[i].style.display !== "none") visible++;
    }

    totalD.textContent = visible;
}

btnSearchD?.addEventListener("click", function () {
    const filter = searchInputD.value.toLowerCase();
    const rows = tableBodyD.getElementsByTagName("tr");

    for (let i = 0; i < rows.length; i++) {
        const nama = rows[i].getElementsByTagName("td")[1].textContent.toLowerCase();
        rows[i].style.display = (nama.includes(filter) || filter === "") ? "" : "none";
    }

    updateTotalD();
});

updateTotalD();

const searchInputE = document.getElementById("searchE");
const btnSearchE = document.getElementById("btnSearchE");
const tableBodyE = document.getElementById("kibETableBody")?.getElementsByTagName("tbody")[0];
const totalE = document.getElementById("totalE");

function updateTotalE() {
    if (!tableBodyE) return;
    
    let visible = 0;
    const rows = tableBodyE.getElementsByTagName("tr");

    for (let i = 0; i < rows.length; i++) {
        if (rows[i].style.display !== "none") visible++;
    }

    totalE.textContent = visible;
}

btnSearchE?.addEventListener("click", function () {
    const filter = searchInputE.value.toLowerCase();
    const rows = tableBodyE.getElementsByTagName("tr");

    for (let i = 0; i < rows.length; i++) {
        const nama = rows[i].getElementsByTagName("td")[1].textContent.toLowerCase();
        rows[i].style.display = (nama.includes(filter) || filter === "") ? "" : "none";
    }

    updateTotalE();
});

updateTotalE();

const searchInputF = document.getElementById("searchF");
const btnSearchF = document.getElementById("btnSearchF");
const tableBodyF = document.getElementById("kibFTableBody")?.getElementsByTagName("tbody")[0];
const totalF = document.getElementById("totalF");

function updateTotalF() {
    if (!tableBodyF) return;
    
    let visible = 0;
    const rows = tableBodyF.getElementsByTagName("tr");

    for (let i = 0; i < rows.length; i++) {
        if (rows[i].style.display !== "none") visible++;
    }

    totalF.textContent = visible;
}

btnSearchF?.addEventListener("click", function () {
    const filter = searchInputF.value.toLowerCase();
    const rows = tableBodyF.getElementsByTagName("tr");

    for (let i = 0; i < rows.length; i++) {
        const nama = rows[i].getElementsByTagName("td")[1].textContent.toLowerCase();
        rows[i].style.display = (nama.includes(filter) || filter === "") ? "" : "none";
    }

    updateTotalF();
});

updateTotalF();

// main.js
const state = {
  2025: [],
  2024: [],
  2023: [],
  2022: []
};

const yearSelect = document.getElementById('yearSelect');
const tableBody = document.getElementById('tableBody');
const totalJumlahEl = document.getElementById('totalJumlah');

const btnTambah = document.getElementById('btnTambah');
const btnCetak = document.getElementById('btnCetak');
const printArea = document.getElementById('printArea');

const modalBackdrop = document.getElementById('modalBackdrop');
const btnCloseModal = document.getElementById('btnCloseModal');
const formTambah = document.getElementById('formTambah');

// Sidebar dropdown toggle
document.querySelectorAll('.menu-dropdown .dropdown-btn').forEach(btn => {
  btn.addEventListener('click', () => {
    const content = btn.nextElementSibling;
    const isOpen = content.style.display === 'block';
    content.style.display = isOpen ? 'none' : 'block';
  });
});

// Modal helpers
function openModal() {
  modalBackdrop.style.display = 'flex';
  modalBackdrop.setAttribute('aria-hidden', 'false');
  const today = new Date().toISOString().slice(0, 10);
  document.getElementById('inTanggal').value = today;
  document.getElementById('inJumlah').value = 1;
}
function closeModal() {
  modalBackdrop.style.display = 'none';
  modalBackdrop.setAttribute('aria-hidden', 'true');
}

btnTambah.addEventListener('click', openModal);
btnCloseModal.addEventListener('click', closeModal);
modalBackdrop.addEventListener('click', (e) => {
  if (e.target === modalBackdrop) closeModal();
});

// Render table for selected year
function renderTable(year) {
  const rows = state[year] || [];
  tableBody.innerHTML = '';

  if (rows.length === 0) {
    const tr = document.createElement('tr');
    tr.className = 'empty-row';
    const td = document.createElement('td');
    td.colSpan = 8;
    td.textContent = 'Belum ada data untuk tahun yang dipilih.';
    tr.appendChild(td);
    tableBody.appendChild(tr);
    totalJumlahEl.textContent = '0';
    return;
  }

  let total = 0;
  rows.forEach(item => {
    const tr = document.createElement('tr');
    tr.innerHTML = `
      <td>${item.kode}</td>
      <td>${item.nama}</td>
      <td>${item.ukuran || '-'}</td>
      <td>${item.tanggal}</td>
      <td>${item.jumlah}</td>
      <td>${item.guru || '-'}</td>
      <td>${item.jabatan || '-'}</td>
      <td>${item.ruang || '-'}</td>
    `;
    tableBody.appendChild(tr);
    total += Number(item.jumlah) || 0;
  });
  totalJumlahEl.textContent = String(total);
}

yearSelect.addEventListener('change', () => {
  renderTable(yearSelect.value);
});

formTambah.addEventListener('submit', (e) => {
  e.preventDefault();
  const year = yearSelect.value;

  const item = {
    kode: document.getElementById('inKode').value.trim(),
    nama: document.getElementById('inNama').value.trim(),
    ukuran: document.getElementById('inUkuran').value.trim(),
    tanggal: document.getElementById('inTanggal').value,
    jumlah: document.getElementById('inJumlah').value,
    guru: document.getElementById('inGuru').value.trim(),
    jabatan: document.getElementById('inJabatan').value.trim(),
    ruang: document.getElementById('inRuang').value
  };

  if (!item.kode || !item.nama || !item.tanggal || !item.jumlah) {
    alert('Mohon lengkapi minimal Kode, Nama, Tanggal, dan Jumlah.');
    return;
  }

  state[year] = state[year] || [];
  state[year].push(item);

  closeModal();
  formTambah.reset();
  renderTable(year);
});

btnCetak.addEventListener('click', () => {
  window.print();
});

renderTable(yearSelect.value);

