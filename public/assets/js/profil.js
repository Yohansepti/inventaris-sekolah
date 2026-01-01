// TAMPILKAN username & password dari localStorage
document.getElementById("showUsername").value = localStorage.getItem("username") || "";
document.getElementById("passwordField").value = localStorage.getItem("password") || "";

// SHOW / HIDE password (seperti login, tanpa icon gambar)
const passField = document.getElementById("passwordField");
const toggle = document.getElementById("togglePass");

// Saat load, isi password dari localStorage
passField.value = localStorage.getItem("password") || "xxxxx";

toggle.addEventListener("click", function () {
    if (passField.type === "password") {
        passField.type = "text";

        // icon eye-off
        toggle.innerHTML = `
            <path fill="black"
              d="M2 5.27L3.28 4 20 20.72 18.73 22l-2.3-2.3C15.08 
                 20.22 13.57 20.5 12 20.5c-5 0-9.27-3.11-11-7.5 
                 1-2.53 2.86-4.68 5.17-6.03L2 5.27zm9.73 9.73L9 
                 12.27V12c0-1.66 1.34-3 3-3 .27 0 .53.03.78.1L14.1 
                 9.5c.06.25.1.51.1.78 0 1.66-1.34 3-3 3-.27 0-.54-.04-.78-.1z"/>
        `;
    } else {
        passField.type = "password";

        // icon eye normal
        toggle.innerHTML = `
            <path fill="black"
              d="M12 4.5C7 4.5 2.73 7.61 1 12c1.73 
                 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5zm0 
                 12.5c-2.76 0-5-2.24-5-5s2.24-5 
                 5-5 5 2.24 5 5-2.24 5-5 5z"/>
        `;
    }
});


// LOGOUT → kembali ke index.html
document.getElementById("btnLogout").addEventListener("click", function () {
    localStorage.clear(); // Hapus data login
    window.location.href = "index.html";
});
