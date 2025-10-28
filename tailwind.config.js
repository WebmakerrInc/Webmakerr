module.exports = {
    content: [
        './*.php',
        './template-parts/**/*.php',
        './src/**/*.php',
        './resources/js/**/*.js',
        './resources/css/**/*.css',
    ],
    theme: {
        container: {
            center: true,
            padding: {
                DEFAULT: '1.5rem',
                sm: '2rem',
                lg: '2.5rem',
                xl: '3rem',
            },
        },
        extend: {
            colors: {
                primary: 'var(--color-primary)',
                dark: 'var(--color-dark)',
                light: 'var(--color-light)',
            },
            fontFamily: {
                sans: ['Inter', 'ui-sans-serif', 'system-ui', '-apple-system', 'BlinkMacSystemFont', '"Segoe UI"', 'Roboto',
                    '"Helvetica Neue"', 'Arial', '"Noto Sans"', 'sans-serif', '"Apple Color Emoji"', '"Segoe UI Emoji"', '"Segoe UI Symbol"',
                    '"Noto Color Emoji"'],
                mono: ['Roboto Mono', 'ui-monospace', 'SFMono-Regular', 'Menlo', 'Monaco', 'Consolas', '"Liberation Mono"',
                    '"Courier New"', 'monospace'],
            },
        },
    },
    plugins: [],
};
