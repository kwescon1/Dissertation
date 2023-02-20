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
                'primary': '#2D87FF',
                'secondary': '#207FB3',
                'tertiary': '#049CA3',
            }
        },
    },
    plugins: [],
};
