var gulp = require('gulp');
var browserSync = require('browser-sync').create();
var sass = require('gulp-sass');

gulp.task('sass', function() {
  return gulp.src('src/scss/**/*.scss')
    .pipe(sass())
    .pipe(gulp.dest('src/css'))
    .pipe(browserSync.reload({
      stream: true
  }))
});

gulp.task('browserSync', function() {
  browserSync.init({
    server: {
      base: 'http://portfolio-2017-theodoremoke611230.codeanyapp.com/src'
    },
  })
});

gulp.task('watch', ['browserSync', 'sass'], function() {
  gulp.watch('src/scss/**/*.scss', ['sass']);
});