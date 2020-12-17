const defaultTheme = require('tailwindcss/defaultTheme')

module.exports = {
    important: true,
    purge: {
        content: ['./**/*.php'],
        options: {
            safelist: ['flex', 'flex-col', 'font-merriweather', 'hidden'],
        },
    },
    theme: {
        extend: {
            fontFamily: {
                merriweather: ['Merriweather', ...defaultTheme.fontFamily.sans],
            },
        },
    },
    variants: {},
    plugins: [require('@tailwindcss/typography')],
}
