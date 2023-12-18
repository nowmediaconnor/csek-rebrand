(() => {
  // resources/js/app.js
  function prepareNavController() {
    const mainNavigation = document.querySelector(".csek-nav-menu");
    const navOpenButtons = document.querySelectorAll("a[data-nav-open]");
    const navCloseButtons = document.querySelectorAll("a[data-nav-close]");
    navCloseButtons.forEach((button) => {
      button.addEventListener("click", (e) => {
        e.preventDefault();
        mainNavigation.classList.add("hidden-nav");
        document.body.classList.remove("nav-open");
      });
    });
    navOpenButtons.forEach((button) => {
      button.addEventListener("click", (e) => {
        e.preventDefault();
        mainNavigation.classList.toggle("hidden-nav");
        document.body.classList.toggle("nav-open");
      });
    });
  }
  async function addToggleHeaderButton() {
    const searchParams = new URLSearchParams(window.location.search);
    const preview = searchParams.get("preview");
    if (!preview || preview === false)
      return;
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
  function computeSubmenuHeights() {
    const navMenu = document.querySelector(".csek-nav-menu");
    if (!navMenu)
      return;
    const submenus = navMenu.querySelectorAll(".sub-menu");
    submenus.forEach((submenu) => {
      const submenuHeight = submenu.offsetHeight;
      submenu.style.setProperty("--submenu-height", `${submenuHeight}px`);
      submenu.classList.add("submenu-ready");
    });
  }
  window.addEventListener("load", () => {
    prepareNavController();
    addToggleHeaderButton();
    computeSubmenuHeights();
  });
})();
