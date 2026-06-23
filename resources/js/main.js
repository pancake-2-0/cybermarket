document.addEventListener("DOMContentLoaded", function () {
    const searchOverlay = document.getElementById("search-overlay");
    const openBtn = document.getElementById("open-search"); // L'id della lente d'ingrandimento
    const closeBtn = document.getElementById("close-search");

    // Apre la barra
    openBtn.addEventListener("click", function (e) {
        e.preventDefault();
        searchOverlay.classList.add("active");
    });

    // Chiude la barra
    closeBtn.addEventListener("click", function () {
        searchOverlay.classList.remove("active");
    });
});
