var gulp       = require('gulp');
var gutil      = require('gulp-util');
var notify     = require('gulp-notify');
var autoprefix = require('gulp-autoprefixer');
var minifyCSS  = require('gulp-minify-css');
var uglify     = require('gulp-uglify');
var less       = require('gulp-less');
var rename     = require("gulp-rename");
var concat     = require('gulp-concat');

// Where do you store your JS files?
var coreJsDir   = 'vendor/nukacode/coreOld/assets/js';
var localJsDir  = 'app/assets/js';
var targetJSDir = 'public/js';

// Extra JS
var jquery         = 'vendor/components/jquery/jquery.js';
var bootstrap      = 'vendor/twitter/bootstrap/dist/js/bootstrap.js';
var jasny          = 'vendor/jasny/bootstrap/dist/js/jasny-bootstrap.js';
var bootbox        = 'public/vendor/bootbox/bootbox.js';
var messenger      = 'public/vendor/messenger/build/js/messenger.js';
var messengerTheme = 'public/vendor/messenger/build/js/messenger-theme-future.js';

// Where do you store your css files?
var localLessDir = 'app/assets/less';
var themeLessDir = 'app/assets/less/themes/dark';
var coreLessDir  = 'vendor/nukacode/coreOld/assets/less';
var targetCSSDir = 'public/css';

gulp.task('js', function() {
	return gulp.src([jquery, coreJsDir + '/**/*.js', localJsDir + '/**/*.js', bootstrap, jasny, bootbox, messenger, messengerTheme])
		.pipe(uglify())
		.pipe(concat('all.js', {"newLine": "\r\n"}))
		.pipe(gulp.dest(targetJSDir))
		.pipe(notify('JS minified'))
});

gulp.task('css', function(theme) {
	return gulp.src(localLessDir + '/themes/' + theme + '/master.less')
		.pipe(less())
		.pipe(minifyCSS())
		.pipe(rename('master.css'))
		.pipe(gulp.dest(targetCSSDir))
		.pipe(notify('Master CSS minified'))
});

gulp.task('css-mini', function() {
	return gulp.src(targetCSSDir + '/master.css')
		.pipe(minifyCSS())
		.pipe(rename('master.css'))
		.pipe(gulp.dest(targetCSSDir))
		.pipe(notify('Master CSS minified'))
});

gulp.task('userCss', function() {
	return gulp.src(targetCSSDir + '/users/**/*.less')
		.pipe(less())
		.pipe(minifyCSS())
		.pipe(gulp.dest(targetCSSDir + '/users'))
		.pipe(notify('User CSS minified'))
});

gulp.task('watch', function () {
	gulp.watch(jsDir + '/**/*.js', ['js']);
	gulp.watch(targetCSSDir + '/colors.less', ['css']);
	gulp.watch(lessDir + '/master.less', ['css']);
	gulp.watch(lessDir + '/imports.less', ['css', 'userCss']);
	gulp.watch(lessDir + '/master_mixins.less', ['css', 'userCss']);
});

gulp.task('watchcss', function () {
    gulp.watch(localLessDir + '/**/*.less', ['css']);
    gulp.watch(coreLessDir + '/**/*.less', ['css']);
});

gulp.task('install', ['js', 'css']);

gulp.task('default', ['js', 'css', 'userCss', 'watch']);