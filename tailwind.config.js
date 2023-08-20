import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
const colors = require('tailwindcss/colors')

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        "./node_modules/flowbite/**/*.js",
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Outfit', ...defaultTheme.fontFamily.sans],
            },

            colors: {
                primary: colors.blue,
                secondary: colors.amber,
                highlight: colors.purple,
                button: colors.blue,
            },
        },
    },

    plugins: [
        forms,
        require('flowbite/plugin'),
        require('@tailwindcss/typography'),
    ],
};
