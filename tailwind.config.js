const defaultTheme = require('tailwindcss/defaultTheme');

/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    './*.php',
    './template-parts/**/*.php',
    './src/**/*.{js,jsx,ts,tsx}',
    './resources/**/*.{js,jsx,ts,tsx,php}',
  ],
  theme: {
    screens: {
      sm: '600px',
      md: '782px',
      lg: '960px',
      xl: '1280px',
    },
    container: {
      center: true,
      padding: {
        DEFAULT: '1rem',
        lg: '2rem',
      },
    },
    extend: {
      colors: {
        primary: '#2C7FFF',
        secondary: '#FD9A00',
        dark: '#18181C',
        light: '#F4F4F5',
        border: '#E4E4E7',
        text: '#111827',
        'muted-text': '#6B7280',
      },
      fontFamily: {
        sans: ['Inter', ...defaultTheme.fontFamily.sans],
      },
      fontWeight: {
        normal: '400',
        medium: '500',
        semibold: '600',
        bold: '700',
      },
      spacing: {
        4: '0.25rem',
        8: '0.5rem',
        16: '1rem',
        24: '1.5rem',
        32: '2rem',
        48: '3rem',
        64: '4rem',
      },
      boxShadow: {
        subtle: '0 12px 30px rgba(24, 24, 28, 0.08)',
        elevated: '0 20px 45px rgba(24, 24, 28, 0.12)',
      },
      borderRadius: {
        DEFAULT: '0.5rem',
        lg: '0.75rem',
        xl: '1rem',
      },
      transitionTimingFunction: {
        DEFAULT: 'ease-in-out',
      },
      transitionDuration: {
        DEFAULT: '200ms',
      },
    },
  },
  plugins: [],
};
