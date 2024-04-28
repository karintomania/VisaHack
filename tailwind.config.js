/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      colors: {
        "base": {
          DEFAULT: "#0F1C2C",
          light: "#222a3d",
        },
        "main": {
          DEFAULT: "#00AEAE",
          dark: "#05B5B5"
        },
        "secondary": {
          DEFAULT: "#07A6FF",
          dark: "#05B5B5"
        },
        "onbase": "#334164",
      },
      fontFamily: {
        sans: ['Helvetica', 'Arial', 'sans-serif'],
      },
    },
  },
  plugins: [],
}
