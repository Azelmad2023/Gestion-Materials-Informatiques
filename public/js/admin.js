document.addEventListener("DOMContentLoaded", function () {
    document
        .getElementById("togglePassword")
        .addEventListener("click", function () {
            const passwordInput = document.getElementById("password");
            const icon = document.getElementById("togglePassword");

            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                icon.classList.remove("fa-eye");
                icon.classList.add("fa-eye-slash");
            } else {
                passwordInput.type = "password";
                icon.classList.remove("fa-eye-slash");
                icon.classList.add("fa-eye");
            }
        });
});
