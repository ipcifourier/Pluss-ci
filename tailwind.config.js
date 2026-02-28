import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
    ],

    theme: {
        extend: {
            // === DÉBUT DE L'AJOUT ===
            animation: {
                // On définit le nom de l'animation, sa durée (25s) et le fait qu'elle est infinie
                marquee: 'marquee 25s linear infinite',
            },
            keyframes: {
                marquee: {
                    // On part de 0%
                    '0%': { transform: 'translateX(0%)' },
                    // On va jusqu'à -50% (car on a dupliqué le contenu en deux, donc quand on arrive à la moitié, la copie prend le relais sans coupure)
                    '100%': { transform: 'translateX(-50%)' },
                },
            },
            // === FIN DE L'AJOUT ===
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
                
            },
            colors: {
                // Vos couleurs existantes (brand-orange, etc.) doivent rester ici
                'brand-orange': '#FF6600', // Exemple, gardez les vôtres
                'brand-green': '#009900',  // Exemple, gardez les vôtres
            }
        },
    },

    plugins: [forms],
};
