const plugin = require('tailwindcss/plugin')

module.exports = {
    purge: [
        './storage/framework/views/*.php',
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
        './src/**/*.{html,js}',
        './node_modules/tw-elements/dist/js/**/*.js',
    ],
    darkMode: false, // or 'media' or 'class'
    theme: {
        container: {
            center: true,
            padding: '2rem',
        },
        screens: {
            sm: { max: '639px' },
            md: { min: '640px', max: '1024px' },
            lg: { min: '1025px', max: '1599px' },
            xl: { min: '1600px' },
        },
        extend: {
            colors: {
                primary: {
                    50: '#F5F4FE',
                    100: '#efecfd',
                    light: '#b085f5',
                    DEFAULT: '#7e57c2',
                    dark: '#4d2c91',
                    darker: '#2e1a57',
                },
                secondary: {
                    light: '#48a999',
                    DEFAULT: '#00796b',
                    dark: '#004c40',
                },
                alt: {
                    light: '#BDBDBD',
                    DEFAULT: '#424242',
                    dark: '#212121',
                },
                background: '#FFFFFF',
                surface: '#eceff1',
                // base: '#F8F8F7',
                warning: '#FFAB00',
                error: '#B00020',
                success: '#2E7D32',
            },
        },
    },
    variants: {
        extend: {
            spacing: {
                '150': '20rem',
            },
        },
    },
    plugins: [
        // require('@tailwindcss/forms'),
        require('tailwindcss-pseudo-elements'),
        require('tw-elements/dist/plugin'),
    ],
}
