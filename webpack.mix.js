const mix = require('laravel-mix')
const config = require('./.config.js')
const wpPot = require('wp-pot')

mix.setPublicPath('public')

mix.webpackConfig({ devtool: 'source-map' })

mix.options({
    processCssUrls: false,
})

mix.postCss('resources/styles/app.css', '', [
    require('postcss-import'),
    require('tailwindcss'),
    require('autoprefixer'),
])

mix.js('resources/scripts/app.js', '')

mix.copyDirectory('resources/images', 'public/images')

mix.browserSync({
    proxy: config.projectURL,
    files: [
        './resources/views/**/*.php',
        './resources/css/**/*.css',
        './resources/js/**/*.js',
        './tailwind.config.js',
    ],
})

mix.override((config) => {
    config.watchOptions = {
        ignored: /node_modules/,
    }
})

if (mix.inProduction()) {
    wpPot({
        bugReport: 'pachlova@lib.cas.cz',
        destFile: './languages/hiko.pot',
        domain: 'hiko',
        package: 'hiko',
        src: './**/*.php',
        team: 'Jarka Pachlová <pachlova@lib.cas.cz>',
    })
    mix.version()
}
