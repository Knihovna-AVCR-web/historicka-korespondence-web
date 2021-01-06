const defaultTheme = require('tailwindcss/defaultTheme')

module.exports = {
    important: true,
    purge: {
        content: ['./**/*.php'],
        options: {
            safelist: [
                'cursor-not-allowed',
                'flex',
                'flex-col',
                'font-merriweather',
                'hidden',
                'hover:text-gray-400',
                'text-gray-400',
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
            typography: (theme) => ({
                DEFAULT: {
                    css: {
                        color: '#524640',
                        a: {
                            color: theme('colors.red.700'),
                            '&:hover': {
                                color: theme('colors.red.800'),
                            },
                        },
                    },
                },
            }),
        },
    },
    variants: {},
    plugins: [require('@tailwindcss/typography')],
}
