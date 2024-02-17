/*
 * Created on Sat Feb 17 2024
 * Author: Connor Doman
 */

export function setupScrollToTop(id: string = "scroll-to-top") {
    console.log("Setting up scroll to top button...");
    const scrollToTop = document.getElementById(id);
    if (!scrollToTop) return;

    addClickListener(scrollToTop);
}

function addClickListener(elmt: HTMLElement) {
    elmt.addEventListener("click", () => {
        // smoothly scroll to top of page
        window.scrollTo({ top: 0, behavior: "smooth" });
    });
}
