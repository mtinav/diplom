var gulp = require('gulp');
var bs = require('browser-sync');
var sass = require('gulp-sass');
var gutil = require( 'gulp-util' );
var ftp = require( 'vinyl-ftp' );
var autoprefixer = require( 'gulp-autoprefixer');


// Запускаем сервер, предварительно скомпилировав SASS
gulp.task('serve', ['sass'], function() {

    bs.init({
        server: "./src"
    });

    gulp.watch("src/sass/*.sass", ['sass']);
    gulp.watch("src/*.html").on('change', bs.reload);
});

// Делает Компеляцию SASS в CSS
gulp.task('sass', function() {
 return gulp.src("src/sass/*.sass")
	  .pipe(sass())
	  .pipe(gulp.dest("src/css"))
	  .pipe(bs.stream());
});

gulp.task('default', ['serve']);

gulp.task( 'deploy', function () {

	var conn = ftp.create( {
		host:     'valentina.karpov.today',
		user:     'valentina',
		password: 'NTkyNTFl',
		log:      gutil.log
	} );
 
	var globs = [
		'src/**'
	];

	// using base = '.' will transfer everything to /public_html correctly
	// turn off buffering in gulp.src for best performance

	return gulp.src( globs, { base: '.', buffer: false } )
		.pipe( conn.newer( '///home/Projects/valentina/source/project/public/example' ) ) // only upload newer files
		.pipe( conn.dest( '///home/Projects/valentina/source/project/public/example' ) );

} );