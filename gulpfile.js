var gulp = require('gulp');
var sass = require('gulp-sass');
var sourcemaps = require('gulp-sourcemaps');
var autoprefixer = require('gulp-autoprefixer');
var browserSync = require('browser-sync');

// ... variables

gulp.task('dev', ['sass'], function() {

    browserSync.init({
        proxy: 'http://rebeccabeyond.loc'
    });

    gulp.watch('**/*.scss', ['sass']);
    gulp.watch('**/*.php').on('change', browserSync.reload);
});

gulp.task('sass', function () {
  return gulp
    .src('./style.scss')
    .pipe(sourcemaps.init())
    .pipe(sass({
      outputStyle: 'compressed',
      includePaths: require( 'node-bourbon' ).includePaths
    }).on('error', sass.logError))
    .pipe(autoprefixer())
    .pipe(sourcemaps.write('./'))
    .pipe(gulp.dest('./'))
    .pipe(browserSync.stream({match: '**/*.css'}));
});
