// Navigation toggle
window.addEventListener("load", () => {
    const main_navigation = document.querySelector(".csek-nav-menu");
    const nav_button = document.querySelector("#primary-menu-toggle");

    document.addEventListener("click", (e) => {
        if (
            e.target !== main_navigation &&
            !main_navigation.contains(e.target) &&
            e.target !== nav_button &&
            !nav_button.contains(e.target)
        ) {
            main_navigation.classList.add("hidden-nav");
        }
    });

    nav_button.addEventListener("click", (e) => {
        e.preventDefault();
        main_navigation.classList.toggle("hidden-nav");
    });
});
