import apiFetch from "@wordpress/api-fetch";

function prepareNavController() {
    const main_navigation = document.querySelector(".csek-nav-menu");

    const nav_open_buttons = document.querySelectorAll("a[data-nav-open]");
    const nav_close_buttons = document.querySelectorAll("a[data-nav-close]");

    nav_close_buttons.forEach((button) => {
        button.addEventListener("click", (e) => {
            e.preventDefault();
            main_navigation.classList.add("hidden-nav");
        });
    });

    nav_open_buttons.forEach((button) => {
        button.addEventListener("click", (e) => {
            e.preventDefault();
            main_navigation.classList.toggle("hidden-nav");
        });
    });
}

async function addToggleHeaderButton() {
    const searchParams = new URLSearchParams(window.location.search);
    const preview = searchParams.get("preview");

    if (!preview || preview === false) return;

    const button = document.createElement("input");
    button.setAttribute("type", "checkbox");
    button.setAttribute("id", "toggle-header");
    button.setAttribute("class", "toggle-header");
    button.setAttribute("title", "Toggle Wordpress Header");

    button.addEventListener("change", (e) => {
        const checked = e.target.checked;
        const header = document.querySelector("#wpadminbar");
        if (checked) {
            header.classList.add("hide-header");
        } else {
            header.classList.remove("hide-header");
        }
    });

    document.body.appendChild(button);
}

// Navigation toggle
window.addEventListener("load", () => {
    prepareNavController();
    addToggleHeaderButton();
});
