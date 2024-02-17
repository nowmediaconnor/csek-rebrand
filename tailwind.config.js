const theme = require("./theme.json");
const tailpress = require("@jeffreyvr/tailwindcss-tailpress");
const plugin = require("tailwindcss/plugin");

const customWidths = {
    "csek-max": "75rem",
    "csek-1/2": "37.5rem",
    "csek-2/3": "50rem",
    serif: "12rem",
    "csek-margin": "max(calc((100vw - 75rem + 3rem) / 2), 0px)",
};

const customTimings = {
    0: "0ms",
    100: "100ms",
    200: "200ms",
    300: "300ms",
    400: "400ms",
    500: "500ms",
    600: "600ms",
    700: "700ms",
    800: "800ms",
    900: "900ms",
    1000: "1000ms",
    2000: "2000ms",
    3000: "3000ms",
    4000: "4000ms",
    5000: "5000ms",
};

/** @type {import('tailwindcss').Config} */
module.exports = {
    // important: true,
    content: ["./*.php", "./**/*.php", "./src/css/*.css", "./src/js/*.{js,ts}", "./safelist.txt"],
    theme: {
        container: {
            padding: {
                DEFAULT: "1rem",
                sm: "2rem",
                lg: "0rem",
            },
        },
        extend: {
            colors: {
                ...tailpress.colorMapper(tailpress.theme("settings.color.palette", theme)),
            },
            fontSize: tailpress.fontSizeMapper(tailpress.theme("settings.typography.fontSizes", theme)),
            fontFamily: {
                syne: ["Syne", "sans-serif"],
                montserrat: ["Montserrat", "sans-serif"],
            },
            keyframes: {
                spin: {
                    from: { transform: "rotate(0deg)" },
                    to: { transform: "rotate(-360deg)" },
                },
            },
            animation: {
                "spin-slow": "spin 3s linear infinite",
            },
            transitionDuration: {
                ...customTimings,
            },
            transitionDelay: {
                ...customTimings,
            },
            spacing: {
                ...customWidths,
                header: "5rem",
            },
            width: {
                ...customWidths,
            },
            maxWidth: {
                ...customWidths,
            },
            minHeight: {
                header: "5rem",
            },
            gridTemplateRows: {
                footer: "2fr 1fr 1fr",
                "footer-mobile": "2fr 1fr 1fr 3rem",
            },
            aspectRatio: {
                "4/3": "4 / 3",
            },
            listStyleType: {
                hyphen: '"\u2013 "',
            },
        },
        screens: {
            xs: "480px",
            sm: "600px",
            md: "782px",
            lg: tailpress.theme("settings.layout.contentSize", theme),
            xl: tailpress.theme("settings.layout.wideSize", theme),
            "2xl": "1440px",
        },
    },
    plugins: [
        tailpress.tailwind,
        plugin(function ({ addUtilities }) {
            addUtilities({
                ".disable-and-hide": {
                    pointerEvents: "none",
                    opacity: "0",
                },
            });
        }),
    ],
};
