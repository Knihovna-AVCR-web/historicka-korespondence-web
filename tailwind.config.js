const defaultTheme = require('tailwindcss/defaultTheme')

module.exports = {
    important: true,
    purge: {
        content: ['./**/*.php'],
        options: {
            safelist: [
                'flex',
                'flex-col',
                'font-merriweather',
                'hidden',
                'text-yellow-900',
            ],
        },
    },
    theme: {
        extend: {
            colors: {
                'brown-dark': '#524640',
                brown: '#8f8279',
            },
            fontFamily: {
                merriweather: ['Merriweather', ...defaultTheme.fontFamily.sans],
            },
            screens: {
                print: { raw: 'print' },
            },
        },
    },
    variants: {},
    plugins: [require('@tailwindcss/typography')],
}
