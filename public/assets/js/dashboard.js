const dropdowns = document.getElementsByClassName("dropdown-btn");

// Dropdown KIB
for (let i = 0; i < dropdowns.length; i++) {
    dropdowns[i].addEventListener("click", function () {
        this.classList.toggle("active-dropdown");
        let content = this.nextElementSibling;
        content.style.display = content.style.display === "block" ? "none" : "block";
    });
}

// User Profile Dropdown Toggle
const userMenuTrigger = document.getElementById('userMenuTrigger');
const userDropdown = document.getElementById('userDropdown');

if (userMenuTrigger && userDropdown) {
    userMenuTrigger.addEventListener('click', function (e) {
        e.stopPropagation();
        userDropdown.classList.toggle('show');
    });

    // Close dropdown when clicking outside
    document.addEventListener('click', function (e) {
        if (!userMenuTrigger.contains(e.target)) {
            userDropdown.classList.remove('show');
        }
    });
}


