(() => {
  // resources/js/app.js
  window.addEventListener("load", () => {
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
  });
})();
