module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.jsx",
        "./storage/framework/views/*.php",
        "./src/**/*.{html,js}",
        "./node_modules/tw-elements/dist/js/**/*.js",
    ],
    theme: {
        container: {
            center: true,
        },
        extend: {
            colors: {
                primary: {
                    5: "#EAEFF5",
                    10: "#E1EAF6",
                    20: "#F4F9FF",
                    25: "#CDDFF7",
                    50: "#90BDFA",
                    75: "#5EA2FC",
                    80: "#559DFD",
                    DEFAULT: "#4192FE",
                    100: "#2D87FF",
                    
                    
                },
                secondary: "#207FB3",
                tertiary: "#049CA3",
            },
        },
    },
    plugins: [require("@tailwindcss/forms")],
};
