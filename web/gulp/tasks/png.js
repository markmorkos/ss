module.exports = function (gulp, plugins, config, displayError, cms, generatePath) {
	var pngquant = require('imagemin-pngquant');

	return function(){
		gulp.src(generatePath('images') + '**/*.png')
			.pipe(plugins.imagemin({
				progressive: true,
				use: [
					pngquant()
				]
			}))
			.on('error', function(err){
				displayError(err);
			})
			.pipe(gulp.dest(generatePath('images')));
	}
};