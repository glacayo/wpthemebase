const { src, dest, watch, series } = require('gulp');
const sass         = require('gulp-sass')(require('sass'));
const postcss      = require('gulp-postcss');
const cssnano      = require('cssnano');
const autoprefixer = require('autoprefixer');
const rename       = require('gulp-rename');
const terser       = require('gulp-terser');
const imagemin     = require('gulp-imagemin');
const browsersync  = require('browser-sync').create();

//Browsersync Task
function browsersyncServe(cb) {
    browsersync.init({
        proxy: 'http://themebase.local/'
    });
    cb();
}

function browsersyncReload(cb) {
    browsersync.reload();
    cb();
}

//SCSS Task
function scssTask() {
    var plugins = [
        autoprefixer(),
        cssnano()
    ];
    return src('app/scss/*.scss', { sourcemaps: true })
        .pipe(sass().on("error", sass.logError))
        .pipe(postcss(plugins))
        .pipe(rename({
            extname: '.min.css'
        }))
        .pipe(dest('assets/css/', { sourcemaps: '.' }))
        .pipe(browsersync.reload({stream: true}));
}

//Fonts Task
function fontsTask(){
    return src('app/fonts/**/*')
    .pipe(dest('assets/fonts'))
    .pipe(browsersync.reload({stream: true}));
}

//Javascript Task
function jsTask() {
    return src('app/js/*.js', { sourcemaps: true })
        .pipe(terser())
        .pipe(rename({
            extname: '.min.js'
        }))
        .pipe(dest('assets/js/', { sourcemaps: '.' }))
        .pipe(browsersync.reload({stream: true}));
}

//Optimise images Task
function imgOptTask() {
    return src('app/img/*')
        .pipe(imagemin([
            imagemin.gifsicle({ interlaced: true }),
            imagemin.mozjpeg({ quality: 75, progressive: true }),
            imagemin.optipng({ optimizationLevel: 5 }),
            imagemin.svgo({
                plugins: [
                    { removeViewBox: true },
                    { cleanupIDs: false }
                ]
            })
        ]))
        .pipe(imagemin())
        .pipe(dest('assets/img'))
        .pipe(browsersync.reload({stream: true}));
}

//Watch Task
function watchTask() {
    watch('app/scss/**/*.scss', scssTask);    
    watch('app/fonts/**/*', fontsTask);
    watch('app/js/**/*.js', jsTask);
    watch('app/img/*', imgOptTask);
    watch(['*.html', '*.php'], browsersyncReload);
}

//Default Gulp Task
exports.default = series(
    scssTask,
    fontsTask,
    jsTask,
    imgOptTask,
    browsersyncServe,
    watchTask
)