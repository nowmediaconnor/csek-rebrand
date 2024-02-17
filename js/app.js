"use strict";
(() => {
  // src/js/toggle-wp-header.ts
  async function addToggleHeaderButton() {
    const searchParams = new URLSearchParams(window.location.search);
    const preview = searchParams.get("preview");
    if (!preview || preview === "")
      return;
    const button = document.createElement("input");
    button.setAttribute("type", "checkbox");
    button.setAttribute("id", "toggle-header");
    button.setAttribute("class", "toggle-header");
    button.setAttribute("title", "Toggle Wordpress Header");
    button.addEventListener("change", (e) => {
      const toggleHeaderCheckbox = e.target;
      const header = document.querySelector("#wpadminbar");
      if (!toggleHeaderCheckbox || !header)
        return;
      const checked = toggleHeaderCheckbox.checked;
      if (checked) {
        header.classList.add("hide-header");
      } else {
        header.classList.remove("hide-header");
      }
    });
    document.body.appendChild(button);
  }

  // src/js/nav-controller.ts
  function prepareNavController() {
    const mainNavigation = document.querySelector(".csek-nav-menu");
    const navOpenButtons = document.querySelectorAll("a[data-nav-open]");
    const navCloseButtons = document.querySelectorAll("a[data-nav-close]");
    const page = document.getElementById("page");
    if (!mainNavigation || !navOpenButtons || !navCloseButtons || !page)
      return;
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
  function computeSubmenuHeights() {
    const navMenu = document.querySelector(".csek-nav-menu");
    if (!navMenu)
      return;
    const submenus = navMenu.querySelectorAll(".sub-menu");
    submenus.forEach((submenu) => {
      const htmlSubmenu = submenu;
      if (htmlSubmenu.classList.contains("submenu-ready"))
        htmlSubmenu.classList.remove("submenu-ready");
      const submenuHeight = htmlSubmenu.offsetHeight;
      htmlSubmenu.style.setProperty("--submenu-height", `${submenuHeight}px`);
      htmlSubmenu.classList.add("submenu-ready");
    });
  }

  // src/js/scroll-to-top.ts
  function setupScrollToTop(id = "scroll-to-top") {
    console.log("Setting up scroll to top button...");
    const scrollToTop = document.getElementById(id);
    if (!scrollToTop)
      return;
    const scrollViewport = addInitialViewport();
    const pageFooter = getPageFooter();
    addClickListener(scrollToTop);
    addViewportIntersectionObserver(scrollToTop, scrollViewport);
    addFooterIntersectionObserver(scrollToTop, pageFooter);
  }
  function addInitialViewport(id = "scroll-to-top-intial-viewport") {
    const scrollViewport = document.createElement("div");
    scrollViewport.id = id;
    scrollViewport.style.position = "absolute";
    scrollViewport.style.width = "100vw";
    scrollViewport.style.height = "100vh";
    scrollViewport.style.top = "0";
    scrollViewport.style.left = "0";
    scrollViewport.style.zIndex = "-1";
    scrollViewport.style.pointerEvents = "none";
    document.body.prepend(scrollViewport);
    return scrollViewport;
  }
  function getPageFooter(id = "colophon") {
    const footer = document.getElementById(id);
    if (!footer) {
      const backupFooter = document.querySelector("body > footer");
      if (!backupFooter) {
        throw new Error("No footer found");
      }
      return backupFooter;
    }
    return footer;
  }
  function addIntersectionObserver(scrollToTop, target, customOptions) {
    const observer = new IntersectionObserver(
      (entries) => {
        entries.forEach((entry) => {
          if (entry.isIntersecting) {
            hideScrollToTopButton(scrollToTop);
            console.log(`Scroll to top button hidden. (${target.id})`);
          } else {
            showScrollToTopButton(scrollToTop);
            console.log(`Scroll to top button shown. (${target.id})`);
          }
        });
      },
      { root: null, threshold: 0.75, ...customOptions }
    );
    observer.observe(target);
  }
  function addViewportIntersectionObserver(scrollToTop, scrollViewport) {
    addIntersectionObserver(scrollToTop, scrollViewport);
  }
  function addFooterIntersectionObserver(scrollToTop, pageFooter) {
    addIntersectionObserver(scrollToTop, pageFooter, { threshold: 0.1 });
  }
  function showScrollToTopButton(scrollToTop) {
    scrollToTop.classList.remove("disable-and-hide");
  }
  function hideScrollToTopButton(scrollToTop) {
    scrollToTop.classList.add("disable-and-hide");
  }
  function addClickListener(elmt) {
    elmt.addEventListener("click", () => {
      window.scrollTo({ top: 0, behavior: "smooth" });
    });
  }

  // src/js/app.ts
  window.addEventListener("load", () => {
    prepareNavController();
    addToggleHeaderButton();
    computeSubmenuHeights();
    setupScrollToTop();
  });
  window.addEventListener("resize", () => {
    computeSubmenuHeights();
  });
})();
