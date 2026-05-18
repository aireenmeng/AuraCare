import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                // Playfair Display for elegant headings, Poppins for clean body text
                sans: ['Poppins', ...defaultTheme.fontFamily.sans],
                serif: ['"Playfair Display"', ...defaultTheme.fontFamily.serif],
            },
            colors: {
                // Our custom AuraCare Palette
                clinic: {
                    light: '#FDF3F4',   // Muted Peach/Nude for backgrounds
                    blush: '#F4B8CD',   // Soft Rose for UI accents
                    rose: '#E8A0BF',    // Primary Brand Color for buttons
                    dark: '#D07C9E',    // Darker rose for hover states
                    text: '#334155',    // Soft charcoal for readable text
                }
            }
        },
    },

    plugins: [forms],
};