const defaultTheme = require('tailwindcss/defaultTheme')

module.exports = {
    important: true,
    content: ['./index.php', './app/**/*.php', './resources/**/*.{php,vue,js}'],
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
    theme: {
        extend: {
            theme: {
                colors: {
                    'brown-dark': '#524640',
                    brown: '#8f8279',
                },
                fontFamily: {
                    merriweather: [
                        'Merriweather',
                        ...defaultTheme.fontFamily.sans,
                    ],
                },
                screens: {
                    print: { raw: 'print' },
                },
            },
            typography: {
                DEFAULT: {
                    css: {
                        color: '#524640',
                        a: {
                            color: ({ theme }) => theme('colors.red.700'),
                            '&:hover': {
                                color: ({ theme }) => theme('colors.red.800'),
                            },
                        },
                        'li > br': { margin: '0 !important' },
                        'blockquote p:first-of-type::before': {
                            content: 'none',
                        },
                        'blockquote p:first-of-type::after': {
                            content: 'none',
                        },
                    },
                },
            },
        },
    },
    plugins: [require('@tailwindcss/typography')],
}
