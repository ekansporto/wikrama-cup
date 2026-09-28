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
        wik: {
          navy: '#0B132B',
          'navy-dark': '#070D1E',
          'navy-card': '#111C38',
          'navy-border': '#1E2D5A',
          'navy-surface': '#162244',
          orange: '#FF5722',
          'orange-hover': '#F4511E',
          'orange-light': '#FFF3E0',
          cyan: '#06B6D4',
          'cyan-dark': '#0891B2',
          'cyan-light': '#ECFEFF',
          teal: '#14B8A6',
          amber: '#F59E0B',
          gold: '#D97706',
          accent: '#FFEDD5',
        }
      },
      boxShadow: {
        'card': '0 2px 12px -2px rgba(11, 19, 43, 0.05), 0 1px 3px 0 rgba(11, 19, 43, 0.03)',
        'card-hover': '0 12px 28px -4px rgba(11, 19, 43, 0.09), 0 4px 12px -2px rgba(11, 19, 43, 0.04)',
        'glow-orange': '0 4px 20px -2px rgba(255, 87, 34, 0.35)',
        'glow-cyan': '0 4px 20px -2px rgba(6, 182, 212, 0.35)',
      },
      fontFamily: {
        sans: ['"Plus Jakarta Sans"', 'Inter', 'system-ui', 'sans-serif'],
      }
    },
  },
  plugins: [],
}

