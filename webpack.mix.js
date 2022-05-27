const mix = require('laravel-mix')
const config = require('./.config.js')

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

mix.postCss('resources/styles/filter.css', '', [
    require('postcss-import'),
    require('autoprefixer'),
])

mix.js('resources/scripts/filter.js', '')

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
    mix.version()
}
