module.exports = function (gulp, plugins, config, displayError, cms, generatePath) {
	return function(){
		gulp.src(generatePath(cms) + 'less')
			.pipe(plugins.cached('less'))
			.pipe(plugins.progeny({
				regexp: /^\s*@import\s*(?:\(\w+\)\s*)?['"]([^'"]+)['"]/
			}))
			.pipe(plugins.filter(['**/*.less', '!**/_*.less', '!modules/**/*.less']))
			.pipe(plugins.sourcemaps.init())
			.pipe(plugins.less())
			.on('error', function(err){
				displayError(err);
			})
			.pipe(plugins.gulpif(config.autoprefixer == true, plugins.autoprefixer(config.browsers)))
			.pipe(plugins.gulpif(config.production == true, plugins.cmq({log: true}), plugins.sourcemaps.write()))
			.pipe(plugins.gulpif(config.production == true, plugins.minifyCss()))
			.pipe(gulp.dest(generatePath(cms, true)))
	};
}