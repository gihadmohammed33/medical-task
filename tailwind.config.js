const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Inter', ...defaultTheme.fontFamily.sans],
                poppins: ['Poppins', 'sans-serif'],
            },
            colors: {
                brand: {
                    light: '#F0F4F8',
                    DEFAULT: '#10B981', // emerald
                    dark: '#065F46',
                },
                surface: {
                    DEFAULT: '#F9FAFB',
                    muted: '#E5E7EB',
                    strong: '#1F2937',
                },
                accent: {
                    DEFAULT: '#6366F1', // indigo
                    hover: '#4F46E5',
                },
            },
        },
    },

    plugins: [require('@tailwindcss/forms')],
};
