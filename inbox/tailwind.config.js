/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
      "./resources/**/*.blade.php",
      "./resources/**/*.js",
      "./resources/**/*.vue",
    ],
    theme: {
      extend: {
        fontFamily: {
            inter: ['Inter']
        },
        colors: {
            'back': '#F9FAFB',
        },
        width: {
            '343': '21rem'
        }
      },
    },
    plugins: [],
  }
