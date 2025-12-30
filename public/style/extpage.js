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
        
    };

    const urlParams = new URLSearchParams(window.location.search);
    const type = urlParams.get('type');

    let tabYangDibuka = 'jadwalUjian';

    if (type === 'jadwalujian') {
        tabYangDibuka = 'jadwalUjian';
    } else if (type === 'beasiswa') {
        tabYangDibuka = 'beasiswa';
    } else if (type === 'perubahankelas') {
        tabYangDibuka = 'perubahanKelas';
    }

    showPage(tabYangDibuka, null);

});
