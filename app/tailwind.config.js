/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "./vendor/tales-from-a-dev/flowbite-bundle/templates/**/*.html.twig",
        "./assets/**/*.js",
        "./templates/**/*.html.twig",
        "./src/Twig/Components/**/*.php",
        "./node_modules/flowbite/**/*.js" // set up the path to the flowbite package
    ],
    theme: {
        extend: {},
    },
    plugins: [
        require('flowbite/plugin') // add the flowbite plugin
    ],
}
