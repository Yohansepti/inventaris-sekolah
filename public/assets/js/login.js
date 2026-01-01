document.getElementById("loginForm").addEventListener("submit", function(e) {
    e.preventDefault();

    const username = document.getElementById("username").value.trim();
    const password = document.getElementById("password").value.trim();

    const errUser = document.getElementById("errorUser");
    const errPass = document.getElementById("errorPass");
    const errMsg = document.getElementById("errorMsg");

    errUser.style.display = "none";
    errPass.style.display = "none";
    errMsg.style.display = "none";

    let adaError = false;

    if (username === "") {
        errUser.textContent = "Nama Pengguna harus diisi!";
        errUser.style.display = "block";
        adaError = true;
    }

    if (password === "") {
        errPass.textContent = "Kata Sandi harus diisi!";
        errPass.style.display = "block";
        adaError = true;
    }

    if (adaError) return;

    
});
