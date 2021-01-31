const defaultTheme = require('tailwindcss/defaultTheme');
const colors = require('tailwindcss/colors')


module.exports = {
    purge: [
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            colors: {
                green: colors.emerald,
                primary: {
          100: "#d6dcf2",
          200: "#aeb9e6",
          300: "#8596d9",
          400: "#5d73cd",
          500: "#3450c0",
          600: "#2a409a",
          700: "#1f3073",
          800: "#15204d",
          900: "#0a1026"
},
        secondary: {
            100: "#cdefff",
            200: "#9adfff",
            300: "#68cfff",
            400: "#35bfff",
            500: "#03afff",
            600: "#028ccc",
            700: "#026999",
            800: "#014666",
            900: "#012333"
        },
                galleria: {
          100: "#cde2ff",
          200: "#9ac6ff",
          300: "#68a9ff",
          400: "#358dff",
          500: "#0370ff",
          600: "#025acc",
          700: "#024399",
          800: "#012d66",
          900: "#011633"
},
                dark: {
            100: "#d5d8dc",
            200: "#abb2b9",
            300: "#808b96",
            400: "#566573",
            500: "#2c3e50",
            600: "#233240",
            700: "#1a2530",
            800: "#121920",
            900: "#090c10"
        },
            },
            fontFamily: {
                'roboto': ['roboto', 'sans-serif'],
            },
        },
    },

    variants: {
        extend: {
            opacity: ['disabled'],
            padding: ['hover'],
        },
    },

    plugins: [require('@tailwindcss/forms'), require('@tailwindcss/typography')],
};
