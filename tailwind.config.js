/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    './app/Views/**/*.php', // Ruta a tus vistas de CodeIgniter
    './public/**/*.{html, php}', // Otros archivos HTML en public, si los hay
  ],
  theme: {
    extend: {},
  },
  plugins: [],
}

