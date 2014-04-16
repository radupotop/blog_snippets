/**
 * Gulp build file
 */
var gulp = require('gulp');

var concat = require('gulp-concat');
var uglify = require('gulp-uglify');
var less = require('gulp-less');

var paths = {
  scripts: [
    'js/*.js', 
  ],
  less: [
    'css/*.less',
  ]
};

gulp.task('scripts', function() {
  return gulp.src(paths.scripts)
    .pipe(uglify())
    .pipe(concat('build.min.js'))
    .pipe(gulp.dest('build'));
});

gulp.task('less', function() {
    return gulp.src(paths.less)
        .pipe(concat('style.min.css'))
        .pipe(less({
            compress: true
        }))
        .pipe(gulp.dest('build'));
});

gulp.task('watch-less', function () {
  gulp.watch(paths.less, ['less']);
});

// run development tasks
gulp.task('default', ['less', 'watch-less']);

// build production
gulp.task('build', ['scripts', 'less']);
