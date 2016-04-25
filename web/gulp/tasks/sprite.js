module.exports = function (gulp, plugins, config, displayError, cms, generatePath, extension) {
	var pngquant = require('imagemin-pngquant');

	return function(){
		var spriteData = gulp.src(generatePath('images') + 'sprite/*.*').pipe(plugins.spritesmith({
			imgName: 'sprite.png',
			imgPath: '.' + generatePath('images') + 'sprite.png',
			cssName: '_sprite.' + extension,
			padding: 2
		}));
		spriteData.img
			.pipe(plugins.imagemin({
				use: [
					pngquant()
				]
			}))
			.pipe(gulp.dest(generatePath('images')))
		spriteData.css
			.pipe(gulp.dest(generatePath('styles') + 'imports/'))
	}
};