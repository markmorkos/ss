module.exports = function (gulp, plugins, config, displayError, cms, generatePath) {
	return function(){
		gulp.src(generatePath('styles') + '**/*.scss')
			.pipe(plugins.sourcemaps.init())
			.pipe(plugins.sass({
				includePaths: [
					generatePath('styles') + '/base'
				]
			}))
			.on('error', function(err){
				displayError(err);
			})
			.pipe(plugins.gulpif(config.autoprefixer == true, plugins.autoprefixer(config.browsers)))
			.pipe(plugins.gulpif(config.production == true, plugins.cmq({log: true}), plugins.sourcemaps.write()))
			.pipe(plugins.gulpif(config.production == true, plugins.minifyCss()))
			.pipe(gulp.dest(generatePath('styles', true)))
	};
};