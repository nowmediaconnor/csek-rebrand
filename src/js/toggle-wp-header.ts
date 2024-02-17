/*
 * Created on Sat Feb 17 2024
 * Author: Connor Doman
 */

export async function addToggleHeaderButton() {
    const searchParams = new URLSearchParams(window.location.search);
    const preview = searchParams.get("preview");

    if (!preview || preview === "") return;

    const button = document.createElement("input");
    button.setAttribute("type", "checkbox");
    button.setAttribute("id", "toggle-header");
    button.setAttribute("class", "toggle-header");
    button.setAttribute("title", "Toggle Wordpress Header");

    button.addEventListener("change", (e: Event) => {
        const toggleHeaderCheckbox = e.target as HTMLInputElement;
        const header = document.querySelector("#wpadminbar");

        if (!toggleHeaderCheckbox || !header) return;

        const checked = toggleHeaderCheckbox.checked;
        if (checked) {
            header.classList.add("hide-header");
        } else {
            header.classList.remove("hide-header");
        }
    });

    document.body.appendChild(button);
}
