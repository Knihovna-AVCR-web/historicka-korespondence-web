const mix = require('laravel-mix')
const config = require('./.config.js')
const wpPot = require('wp-pot')

mix.setPublicPath('./assets/dist/')

mix.browserSync(config.projectURL)

mix.webpackConfig({ devtool: 'source-map' })

mix.postCss('assets/css/app.css', '', [
    require('tailwindcss')('./tailwind.config.js'),
])

mix.js('assets/js/app.js', '')

if (mix.inProduction()) {
    wpPot({
        bugReport: 'pachlova@lib.cas.cz',
        destFile: './languages/hiko.pot',
        domain: 'hiko',
        package: 'hiko',
        src: './**/*.php',
        team: 'Jarka Pachlová <pachlova@lib.cas.cz>',
    })
}
