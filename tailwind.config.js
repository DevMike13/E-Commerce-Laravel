/** @type {import('tailwindcss').Config} */
export default {
  presets: [
    require('./vendor/wireui/wireui/tailwind.config.js')
  ],
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
    './vendor/wireui/wireui/resources/**/*.blade.php',
    './vendor/wireui/wireui/ts/**/*.ts',
    './vendor/wireui/wireui/src/View/**/*.php',
    'node_modules/preline/dist/*.js',
  ],
  theme: {
    extend: {
      transitionDuration: {
        '1500': '1500ms',
      }
    },
  },
  plugins: [
    require('@tailwindcss/forms'),
    require('preline/plugin'),
  ],
}

