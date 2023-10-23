(() => {
  // resources/js/app.js
  window.addEventListener("load", () => {
    const main_navigation = document.querySelector(".csek-nav-menu");
    document.querySelector("#primary-menu-toggle").addEventListener("click", (e) => {
      e.preventDefault();
      main_navigation.classList.toggle("hidden-nav");
    });
  });
})();
