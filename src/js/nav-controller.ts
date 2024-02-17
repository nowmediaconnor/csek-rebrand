/*
 * Created on Sat Feb 17 2024
 * Author: Connor Doman
 */

export function prepareNavController() {
    const mainNavigation = document.querySelector(".csek-nav-menu");

    const navOpenButtons = document.querySelectorAll("a[data-nav-open]");
    const navCloseButtons = document.querySelectorAll("a[data-nav-close]");

    const page = document.getElementById("page");

    if (!mainNavigation || !navOpenButtons || !navCloseButtons || !page) return;

    navCloseButtons.forEach((button) => {
        button.addEventListener("click", (e) => {
            e.preventDefault();
            mainNavigation.classList.add("hidden-nav");
            page.classList.remove("nav-open");
        });
    });

    navOpenButtons.forEach((button) => {
        button.addEventListener("click", (e) => {
            e.preventDefault();
            mainNavigation.classList.toggle("hidden-nav");
            page.classList.toggle("nav-open");
        });
    });
}

export function computeSubmenuHeights() {
    const navMenu = document.querySelector(".csek-nav-menu");

    if (!navMenu) return;

    const submenus = navMenu.querySelectorAll(".sub-menu");

    submenus.forEach((submenu) => {
        const htmlSubmenu = submenu as HTMLElement;
        if (htmlSubmenu.classList.contains("submenu-ready")) htmlSubmenu.classList.remove("submenu-ready");

        const submenuHeight = htmlSubmenu.offsetHeight;
        htmlSubmenu.style.setProperty("--submenu-height", `${submenuHeight}px`);
        htmlSubmenu.classList.add("submenu-ready");
    });
}
