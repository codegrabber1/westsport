"use strict";
const gulp          = require('gulp');
const sass          = require('gulp-sass');
const autopref      = require('gulp-autoprefixer');
const concat        = require('gulp-concat');
const multipipe     = require('multipipe');
const notify        = require('gulp-notify');
const remember      = require('gulp-remember');
const sourcemaps    = require('gulp-sourcemaps');
const imagemin      = require('gulp-imagemin');
const bs            = require('browser-sync').create();
const del           = require('del');
const php           = require('gulp-connect-php7');
const paths         = { php: './*.php' };

/*==== server ====*/
gulp.task('server', function() {
    var files = [
            '**/*.php',
            '**/*.{png,jpg,gif}'
        ];
    return php.server({}, function(){
        bs.init(files,{
               proxy: 'http://localhost/westsport.wp',
               keepalive: true,
               open: true
            });
    });
    // Serve files from the root of this project

    bs.watch('./*.php').on('change', bs.reload);
});

/*=== sass ===*/
gulp.task('sass', function(){
    return multipipe(
        gulp.src('sass/style.sass', {since: gulp.lastRun('sass')}),
        // sourcemaps.init(),
        autopref({
            browsers: ['last 2 versions'],
            cascade: false
        }),
        remember('sass'),
        sass().on('error', sass.logError),
        concat('style.css'),
        // sourcemaps.write('.'),
        gulp.dest('./'),
        bs.stream()
    ).on('error', notify.onError())
});

/*== js ==*/
gulp.task('js', function(){
    return multipipe(
        gulp.src([
                'js/vendor/**/*.js',
                //'js/theme/**/*.js',
            ]),
        concat('all.js'),
        gulp.dest('js/'),
        bs.stream()
    ).on('error', notify.onError())
});

/*==== delete ====*/
gulp.task('del', function(){
    return del('style.css');
});
/*==== watch ====*/
gulp.task('watch', function(){
    gulp.watch('sass/**/*.sass', gulp.series('sass'));
    // gulp.watch('js/**/*.js', gulp.series('js'));
    gulp.watch(paths.php).on('change', bs.reload);

});


/*==== build ====*/
gulp.task('build', gulp.series('del', gulp.parallel('sass', 'js')));

/*==== DEV ====*/
gulp.task('default', gulp.series('build', gulp.parallel('watch', 'server')));
