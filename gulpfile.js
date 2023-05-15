const gulp = require('gulp');
const sass = require('gulp-sass')(require('sass'));
const concat = require('gulp-concat-util');
const sourcemaps = require('gulp-sourcemaps');
const browserSync = require('browser-sync').create();
const sftp = require('gulp-sftp');

function styles(done) {
	// Specify path of source SASS / SCSS file
	return gulp.src('stylesheets/sass/**/*.scss')

	// Get ready Sourcemaps
	.pipe(sourcemaps.init())

	// Compile it, and catch errors
	.pipe(sass().on('error',sass.logError))

	// To add prefixes
	// .pipe(postcss([autoprefixer()]))

	// Save styles.css.map
	.pipe(sourcemaps.write('./'))

	// Save the CSS output file in this path
	.pipe(gulp.dest('./stylesheets/css'))

	// Auto-inject into browsers
	// .pipe(browserSync.stream());

	done();
}

function styles_upload(done) {
	const secret = require('./.vscode/sftp.json');

	// Specify path of source SASS / SCSS file
	return gulp.src('stylesheets/sass/**/*.scss')

	// Get ready Sourcemaps
	.pipe(sourcemaps.init())

	// Compile it, and catch errors
	.pipe(sass().on('error',sass.logError))

	// To add prefixes
	// .pipe(postcss([autoprefixer()]))

	// Save styles.css.map
	.pipe(sourcemaps.write('./'))

	// Save the CSS output file in this path
	.pipe(gulp.dest('./stylesheets/css'))

	.pipe(sftp({
		host: secret.host,
		username: secret.username,
		password: secret.password,
		remotePath: secret.remotePath + "/stylesheets/css",
		port: secret.port
	}))

	// Auto-inject into browsers
	// .pipe(browserSync.stream());

	done();
}

function upload_all_scss(done) {

	const secret = require('./.vscode/sftp.json');

	// Specify path of source SASS / SCSS file
	return gulp.src('stylesheets/sass/**/*.scss')

	// Save the CSS output file in this path
	// .pipe(gulp.dest('./stylesheets/sass')) // No Need - Also Infinite loop

	.pipe(sftp({
		host: secret.host,
		username: secret.username,
		password: secret.password,
		remotePath: secret.remotePath + "/stylesheets/sass/",
		port: secret.port
	}))

	done();
}

function js(done) {
	// Specify path of source SASS / SCSS file
	// return gulp.src('./js/modules/{,*/}*.js')
	return gulp.src(['./js/modules/general.js','./js/modules/external-funcs.js', './js/modules/resize-funcs.js', './js/modules/*.js'])

    .pipe(concat('general-built.js'))

    .pipe(concat.header('/* Custom General jQuery \n' +
	'-------------------------------------------------------------------*/\n'+
	'//For JSHint\n' +
	'/*global jQuery,Modernizr */\n' +
	'/*jslint latedef:false*/\n'+
	'/*jslint node:true */\n' +
	'/*jslint browser:true */\n' +
	'(function($) {\n' +
	'"use strict";\n'))

    .pipe(concat.footer('\n\n}(jQuery));'))

    .pipe(gulp.dest('./js'))

	done();
}

function js_upload(done) {
	const secret = require('./.vscode/sftp.json');

	// Specify path of source file
	// return gulp.src('./js/modules/{,*/}*.js')
	return gulp.src(['./js/modules/general.js','./js/modules/external-funcs.js', './js/modules/resize-funcs.js', './js/modules/*.js'])

    .pipe(concat('general-built.js'))

    .pipe(concat.header('/* Custom General jQuery \n' +
	'-------------------------------------------------------------------*/\n'+
	'//For JSHint\n' +
	'/*global jQuery,Modernizr */\n' +
	'/*jslint latedef:false*/\n'+
	'/*jslint node:true */\n' +
	'/*jslint browser:true */\n' +
	'(function($) {\n' +
	'"use strict";\n'))

    .pipe(concat.footer('\n\n}(jQuery));'))

    .pipe(gulp.dest('./js/'))

	.pipe(sftp({
		host: secret.host,
		username: secret.username,
		password: secret.password,
		remotePath: secret.remotePath + "/js",
		port: secret.port
	}))

	done();
}

function upload_all_js(done) {

	const secret = require('./.vscode/sftp.json');

	// Specify path of source file
	// return gulp.src('./js/modules/{,*/}*.js')
	return gulp.src(["js/modules/**.js"])

	.pipe(sftp({
		host: secret.host,
		username: secret.username,
		password: secret.password,
		remotePath: secret.remotePath + "/js/modules",
		port: secret.port
	}))

	done();
}

function basic(done) {

	styles_upload();
	upload_all_scss();
	js_upload();
	upload_all_js();

    // Watch for changes in the source SASS / SCSS files
    gulp.watch('stylesheets/sass/**/*.scss', gulp.series('styles_upload', 'upload_all_scss'));

    // Watch for changes in the source JS files
	gulp.watch('js/modules/*.js', gulp.series('js_upload', 'upload_all_js'));

    // gulp.watch('./**/*.css').on('change',browserSync.reload);
    // gulp.watch('js/*.js').on('change',browserSync.reload);
    // gulp.watch('./**/*.php').on('change',browserSync.reload);

    done();
}

function watch(done) {

    // Watch for changes in the source SASS / SCSS file
    gulp.watch('stylesheets/sass/**/*.scss', styles_upload);

    // Watch for changes in the source js file
    gulp.watch('js/modules/*.js', js_upload);

    // gulp.watch('./**/*.css').on('change',browserSync.reload);
    // gulp.watch('js/*.js').on('change',browserSync.reload);
    // gulp.watch('./**/*.php').on('change',browserSync.reload);

    done();
}

function local(done) {

    // Watch for changes in the source SASS / SCSS file
    gulp.watch('stylesheets/sass/**/*.scss', styles);

    // Watch for changes in the source js file
    gulp.watch('js/modules/*.js', js);

    gulp.watch('./**/*.css').on('change',browserSync.reload);
    gulp.watch('js/*.js').on('change',browserSync.reload);
    gulp.watch('./**/*.php').on('change',browserSync.reload);

    done();
}

// Defining Gulp Tasks
exports.default = basic;
exports.watch = watch;
exports.local = local;
exports.js_upload = js_upload;
exports.upload_all_js = upload_all_js;
exports.styles_upload = styles_upload;
exports.upload_all_scss = upload_all_scss;