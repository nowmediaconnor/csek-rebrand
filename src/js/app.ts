/*
 * Created on Sat Feb 17 2024
 * Author: Connor Doman
 */

import { addToggleHeaderButton } from "./toggle-wp-header";
import { prepareNavController, computeSubmenuHeights } from "./nav-controller";
import { setupScrollToTop } from "./scroll-to-top";

// Navigation toggle and submenu height
window.addEventListener("load", () => {
    prepareNavController();
    addToggleHeaderButton();
    computeSubmenuHeights();
    setupScrollToTop();
});

window.addEventListener("resize", () => {
    computeSubmenuHeights();
});
