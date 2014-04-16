/**
 * Gulp build file
 */
var gulp = require('gulp');

/**
 * Load plugins
 */
var concat = require('gulp-concat');
var uglify = require('gulp-uglify');
var less = require('gulp-less');

/**
 * Define paths.
 * Files will be read in the order found here.
 * So for example, classes.js will be read before controllers.js because
 * the controllers depend on classes.
 */
var paths = {
  scripts: [
    'js/classes.js', 
    'js/controllers.js', 
  ],
  less: [
    'css/mixins.less',
    'css/style.less',
  ]
};

/**
 * Build scripts
 */
gulp.task('scripts', function() {
  return gulp.src(paths.scripts)
    .pipe(uglify())
    .pipe(concat('build.min.js'))
    .pipe(gulp.dest('build'));
});

/**
 * Build less.
 * The pipe order is significant since style.less depends on mixins.less
 * So we will first concat files, then build with less.
 */
gulp.task('less', function() {
    return gulp.src(paths.less)
        .pipe(concat('style.min.css'))
        .pipe(less({
            compress: true
        }))
        .pipe(gulp.dest('build'));
});

/**
 * Watch less files for changes
 */
gulp.task('watch-less', function () {
  gulp.watch(paths.less, ['less']);
});

/** 
 * Run development tasks
 */
gulp.task('default', ['less', 'watch-less']);

/** 
 * Build production app
 */
gulp.task('build', ['scripts', 'less']);
