const config = require('./wpgulp.config.js')

config.BROWSERS_LIST = [
    'last 2 version',
    '> 1%',
    'ie >= 11',
    'last 1 Android versions',
    'last 1 ChromeAndroid versions',
    'last 2 Chrome versions',
    'last 2 Firefox versions',
    'last 2 Safari versions',
    'last 2 iOS versions',
    'last 2 Edge versions',
    'last 2 Opera versions',
]

const gulp = require('gulp')

const sass = require('gulp-sass')
const autoprefixer = require('gulp-autoprefixer')

const concat = require('gulp-concat')
const uglify = require('gulp-uglify')
const babel = require('gulp-babel')

const imagemin = require('gulp-imagemin')

const rename = require('gulp-rename')
const lineec = require('gulp-line-ending-corrector')
const sourcemaps = require('gulp-sourcemaps')
const notify = require('gulp-notify')
const browserSync = require('browser-sync').create()
const wpPot = require('gulp-wp-pot')
const sort = require('gulp-sort')
const cache = require('gulp-cache')
const remember = require('gulp-remember')
const plumber = require('gulp-plumber')
const beep = require('beepbeep')

const errorHandler = r => {
    notify.onError('\n\n❌  ===> ERROR: <%= error.message %>\n')(r)
    beep()
}

const browsersync = done => {
    browserSync.init({
        proxy: config.projectURL,
        open: false,
        injectChanges: true,
        watchEvents: ['change', 'add', 'unlink', 'addDir', 'unlinkDir'],
    })
    done()
}

const reload = done => {
    browserSync.reload()
    done()
}

gulp.task('styles', () => {
    return gulp
        .src('./assets/css/main.scss', { allowEmpty: true })
        .pipe(plumber(errorHandler))
        .pipe(sourcemaps.init())
        .pipe(
            sass({
                errLogToConsole: true,
                outputStyle: 'compressed',
                precision: 10,
            })
        )
        .on('error', sass.logError)
        .pipe(autoprefixer(config.BROWSERS_LIST))
        .pipe(sourcemaps.write('./'))
        .pipe(gulp.dest('./assets/dist/'))
        .pipe(browserSync.stream())
        .pipe(
            notify({
                message: '\n\n✅  ===> STYLES — completed!\n',
                onLast: true,
            })
        )
})

gulp.task('customJS', () => {
    return gulp
        .src('./assets/js/custom/*.js', { since: gulp.lastRun('customJS') })
        .pipe(plumber(errorHandler))
        .pipe(sourcemaps.init())
        .pipe(
            babel({
                presets: [
                    [
                        '@babel/preset-env',
                        {
                            targets: { browsers: config.BROWSERS_LIST },
                        },
                    ],
                ],
            })
        )
        .pipe(remember('./assets/js/custom/*.js'))
        .pipe(concat('custom.js'))
        .pipe(lineec())
        .pipe(gulp.dest('./assets/dist/'))
        .pipe(
            rename({
                basename: 'custom',
                suffix: '.min',
            })
        )
        .pipe(uglify())
        .pipe(lineec())
        .pipe(sourcemaps.write('./'))
        .pipe(gulp.dest('./assets/dist/'))
        .pipe(
            notify({
                message: '\n\n✅  ===> CUSTOM JS — completed!\n',
                onLast: true,
            })
        )
})

gulp.task('images', () => {
    return gulp
        .src('./assets/img/raw/**/*')
        .pipe(
            cache(
                imagemin([
                    imagemin.gifsicle({ interlaced: true }),
                    imagemin.jpegtran({ progressive: true }),
                    imagemin.optipng({ optimizationLevel: 3 }), // 0-7 low-high.
                    imagemin.svgo({
                        plugins: [
                            { removeViewBox: true },
                            { cleanupIDs: false },
                        ],
                    }),
                ])
            )
        )
        .pipe(gulp.dest('./assets/img/'))
        .pipe(
            notify({
                message: '\n\n✅  ===> IMAGES — completed!\n',
                onLast: true,
            })
        )
})

gulp.task('clearCache', function(done) {
    return cache.clearAll(done)
})

gulp.task('translate', () => {
    return gulp
        .src('./**/*.php')
        .pipe(sort())
        .pipe(
            wpPot({
                domain: 'hiko',
                package: 'hiko',
                bugReport: 'pachlova@lib.cas.cz',
                lastTranslator: 'Jarka Pachlová <pachlova@lib.cas.cz>',
                team: 'Jarka Pachlová <pachlova@lib.cas.cz>',
            })
        )
        .pipe(gulp.dest('./languages' + '/' + 'hiko.pot'))
        .pipe(
            notify({
                message: '\n\n✅  ===> TRANSLATE — completed!\n',
                onLast: true,
            })
        )
})

gulp.task(
    'default',
    gulp.parallel('styles', 'customJS', 'images', browsersync, () => {
        gulp.watch('./**/*.php', reload)
        gulp.watch('./assets/css/**/*.scss', gulp.parallel('styles'))
        gulp.watch('./assets/js/custom/*.js', gulp.series('customJS', reload))
        gulp.watch('./assets/img/raw/**/*', gulp.series('images', reload))
    })
)
