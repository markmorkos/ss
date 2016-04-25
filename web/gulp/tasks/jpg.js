module.exports = function (gulp, plugins, config, displayError, cms, generatePath) {
	var jpegRecompress = require('imagemin-jpeg-recompress');

	return function(){
		gulp.src(generatePath('images') + 'temp/**/*.jpg')
			.pipe(jpegRecompress({
				min: 65,
				max: 75
			})())
			.on('error', function(err){
				displayError(err);
			})
			.pipe(gulp.dest(generatePath('images')));
	}
};