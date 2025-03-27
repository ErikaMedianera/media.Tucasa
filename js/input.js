document.addEventListener("DOMContentLoaded", function() {
    const searchContainer = document.querySelector(".search-container");
    const searchInput = document.querySelector(".search-input");
    const searchIcon = document.querySelector(".search-icon");
    searchIcon.addEventListener("click", function() {
        searchContainer.classList.toggle("active");
        if (searchContainer.classList.contains("active")) {
            searchInput.focus();
        }
    });
});