const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    purge: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './src/**/*.{html,js}', './node_modules/tw-elements/dist/js/**/*.js'
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
            backgroundImage: {
                'search-participante': "url('http://localhost/pfj/public/img/portada.jpg')",
            },
        },
    },

    variants: {
        extend: {
            opacity: ['disabled'],
        },
    },
    // content: ['./src/**/*.{html,js}', './node_modules/tw-elements/dist/js/**/*.js'],

    plugins: [require('@tailwindcss/forms'), require('@tailwindcss/typography'), require('tw-elements/dist/plugin')],
};
