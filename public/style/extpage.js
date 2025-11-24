document.addEventListener("DOMContentLoaded", () => {
    const listButtons = document.querySelectorAll(".list-group-item");
    const sections = document.querySelectorAll("section");

    window.showPage = function (pageId, event) {
        listButtons.forEach(btn => btn.classList.remove("active"));
        if (event && event.currentTarget) {
            event.currentTarget.classList.add("active");
        } else {
            const btn = document.querySelector(`.list-group-item[data-page="${pageId}"]`);
            if (btn) btn.classList.add("active");
        }

        sections.forEach(sec => sec.classList.remove("active"));
        const target = document.getElementById(pageId);
        if (target) target.classList.add("active");

        localStorage.setItem("lastPage", pageId);
    };

    const lastPage = localStorage.getItem("lastPage") || "jadwalUjian";

    showPage(lastPage, null);
});
