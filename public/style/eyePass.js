const pass = document.getElementById("pass");
const icon = document.getElementById("toggleIcon");

icon.addEventListener("click", () => {
    const type = pass.getAttribute("type") === "password" ? "text" : "password";
    pass.setAttribute("type", type);

    icon.classList.toggle("bi-eye");
    icon.classList.toggle("bi-eye-slash");
});