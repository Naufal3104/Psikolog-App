import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    darkMode: 'class',
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            // --- TAMBAHKAN BLOK INI ---
            colors: {
                'rsud-blue': '#044f86',
                'rsud-blue-light': '#346b9b',
            },
            // --- AKHIR BLOK TAMBAHAN ---
        },
    },

    plugins: [forms],
};