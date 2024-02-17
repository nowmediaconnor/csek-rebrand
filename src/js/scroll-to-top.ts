/*
 * Created on Sat Feb 17 2024
 * Author: Connor Doman
 */

export function setupScrollToTop(id: string = "scroll-to-top") {
    const scrollToTop = document.getElementById(id);
    if (!scrollToTop) return;

    const scrollViewport = addInitialViewport();
    const pageFooter = getPageFooter();

    addClickListener(scrollToTop);
    addFooterIntersectionObserver(scrollToTop, pageFooter);
    addViewportIntersectionObserver(scrollToTop, scrollViewport);
    setTimeout(() => hideScrollToTopButton(scrollToTop), 250);
}

function addInitialViewport(id: string = "scroll-to-top-intial-viewport"): HTMLElement {
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

function getPageFooter(id: string = "colophon"): HTMLElement {
    const footer = document.getElementById(id);
    if (!footer) {
        const backupFooter = document.querySelector("body > footer");
        if (!backupFooter) {
            throw new Error("No footer found");
        }
        return backupFooter as HTMLElement;
    }
    return footer;
}

function addIntersectionObserver(
    scrollToTop: HTMLElement,
    target: HTMLElement,
    customOptions?: IntersectionObserverInit
) {
    const observer = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    hideScrollToTopButton(scrollToTop);
                } else {
                    showScrollToTopButton(scrollToTop);
                }
            });
        },
        { root: null, threshold: 0.75, ...customOptions }
    );
    observer.observe(target);
}

function addViewportIntersectionObserver(scrollToTop: HTMLElement, scrollViewport: HTMLElement) {
    addIntersectionObserver(scrollToTop, scrollViewport);
}

function addFooterIntersectionObserver(scrollToTop: HTMLElement, pageFooter: HTMLElement) {
    addIntersectionObserver(scrollToTop, pageFooter, { threshold: 0.1 });
}

function showScrollToTopButton(scrollToTop: HTMLElement) {
    scrollToTop.classList.remove("disable-and-hide");
}

function hideScrollToTopButton(scrollToTop: HTMLElement) {
    scrollToTop.classList.add("disable-and-hide");
}

function addClickListener(elmt: HTMLElement) {
    elmt.addEventListener("click", () => {
        // smoothly scroll to top of page
        window.scrollTo({ top: 0, behavior: "smooth" });
    });
}
