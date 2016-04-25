var gulp = require('gulp'),
	config = require('./gulp/config.json'),
	styles = config.assets.styles;
	images = config.assets.images;
	gulpLoadPlugins = require('gulp-load-plugins'),
	plugins = gulpLoadPlugins({
		patterns: ['gulp-*', 'gulp.*', 'imagemin-*'],
		rename: {
			'gulp-combine-media-queries': 'cmq',
			'gulp-if': 'gulpif',
			'browser-sync': 'browserSync',
			'gulp-minify-css': 'minifyCss'
		}
	}),
	browserSync = require('browser-sync'),
	preprocessor = config.preprocessor,
	extension = (config.preprocessor == 'sass') ? 'scss' : config.preprocessor;

if (config.cms == "magento" || "wordpress" || "custom") {
	var cms = config.assets.cms_config[config.cms];
}
function generatePath(type, dest) {
	var result;
	// stream direction
	if (!dest) {
		streamDirection = config.assets[type].src;
	} else {
		streamDirection = config.assets[type].dest;
	}
	// cms or static (pure html)
	switch (config.cms) {
		case "magento":
			result = cms.skin + cms.package + '/' + cms.theme + '/' + streamDirection;
			break;
		case "wordpress":
			result = cms.skin + cms.theme + '/' + streamDirection;
			break;
		case "custom":
			result = cms.skin + streamDirection;
			break;
		default:
			result = './' + streamDirection;
			break;
	}
	return result;
}
function getTask(task) {
	return require('./gulp/tasks/' + task)(gulp, plugins, config, displayError, cms, generatePath);
}
var displayError = function(error) {
	var errorString = '[' + error.plugin + ']';
	errorString += ' ' + error.message.replace("\n",'');
	if(error.fileName)
		errorString += ' in ' + error.fileName;
	if(error.lineNumber)
		errorString += ' on line ' + error.lineNumber;
	console.error(errorString);
}

// preprocessor (sass/less)
gulp.task(preprocessor, getTask(preprocessor));

// png optimization
gulp.task('png', getTask('png'));

// jpg optimization (from TEMP folder)
gulp.task('jpg', getTask('jpg'));

// browser-sync task (magento/wordpress/static)
gulp.task('browser-sync', getTask('browser-sync'));

// sprite generation task (sass/less)
gulp.task('sprite', require('./gulp/tasks/sprite')(gulp, plugins, config, displayError, cms, generatePath, extension));

// images optimization
gulp.task('images', ['png', 'jpg']);

// svg sprite generation task (+ injection)
gulp.task('svgstore', getTask('svgstore'));

// generate list of tasks for default task
var tasks = [
	preprocessor
];
if (config.browserSync) {
	tasks.push('browser-sync')
}

var brSync = require('browser-sync');

// default task: runs preprocessor and browser-sync
gulp.task('default', tasks, function () {
	console.log(generatePath('styles') + '**/*.' + extension);
	gulp.watch(generatePath('styles') + '**/*.' + extension, [preprocessor])
	.on('change', function(evt) {
		console.log(
			'[watcher] File ' + evt.path + ' was ' + evt.type + ', compiling...'
		);
		brSync.reload();
	});
});