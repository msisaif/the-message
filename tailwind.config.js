const defaultTheme = require('tailwindcss/defaultTheme');
const colors = require('tailwindcss/colors');

module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],

    darkMode: 'class',

    theme: {
        extend: {
            fontFamily: {
                // brand: ['Poppins', 'Noto Sans Bengali', 'alqalam'],
                brand: ['Poppins', 'Noto Sans Bengali', 'indopak'],
            },
            colors: {
                brand: {
                    primary: '#1D71B8',
                    secondary: '#95C11F',
                    black: '#404F54',
                    dark: '#7C7C7C',
                    gray: '#ABABAB',
                    light: '#F5F5F5',
                },
            },
            maxWidth: {
                'content': '1220px',
            },
            minHeight: {
                'content': 'calc( 100vh - 440px )'
            },
        },
    },

    plugins: [require('@tailwindcss/forms')],
};
