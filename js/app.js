(()=>{function r(){let t=document.querySelector(".csek-nav-menu"),s=document.querySelectorAll("a[data-nav-open]"),e=document.querySelectorAll("a[data-nav-close]"),n=document.getElementById("page");e.forEach(o=>{o.addEventListener("click",a=>{a.preventDefault(),t.classList.add("hidden-nav"),n.classList.remove("nav-open")})}),s.forEach(o=>{o.addEventListener("click",a=>{a.preventDefault(),t.classList.toggle("hidden-nav"),n.classList.toggle("nav-open")})})}async function d(){let s=new URLSearchParams(window.location.search).get("preview");if(!s||s===!1)return;let e=document.createElement("input");e.setAttribute("type","checkbox"),e.setAttribute("id","toggle-header"),e.setAttribute("class","toggle-header"),e.setAttribute("title","Toggle Wordpress Header"),e.addEventListener("change",n=>{let o=n.target.checked,a=document.querySelector("#wpadminbar");o?a.classList.add("hide-header"):a.classList.remove("hide-header")}),document.body.appendChild(e)}function c(){let t=document.querySelector(".csek-nav-menu");if(!t)return;t.querySelectorAll(".sub-menu").forEach(e=>{e.classList.contains("submenu-ready")&&e.classList.remove("submenu-ready");let n=e.offsetHeight;e.style.setProperty("--submenu-height",`${n}px`),e.classList.add("submenu-ready")})}window.addEventListener("load",()=>{r(),d(),c()});window.addEventListener("resize",()=>{c()});})();
