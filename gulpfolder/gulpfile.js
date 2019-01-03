const gulp = require('gulp');
var uglify = require('gulp-uglify');
var sass = require('gulp-sass');


gulp.task('minify',function(){
	gulp.src('src/js/*.js')
		.pipe(uglify())
		.pipe(gulp.dest('E:/interview-master/interview-master'));
});

gulp.task('sass',function(){
	gulp.src('src/sass/*.scss')
		.pipe(sass().on('error',sass.logError))
		.pipe(gulp.dest('E:/interview-master/interview-master'));
});