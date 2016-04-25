module.exports = function (gulp, plugins, config, displayError, reload) {
	return function(){
		var svgs = gulp
			.src(config.assets.images.src + 'svg/*.svg')
			.pipe(plugins.svgmin())
			.pipe(plugins.svgstore({
				inlineSvg: true,
				viewBox: '0 0 100 100',
				xmlns: 'http://www.w3.org/2000/svg'
			}))

		function fileContents(filePath, file){
			return file.contents.toString();
		}

		return gulp
			.src('index.html')
			.pipe(plugins.inject(svgs, { transform: fileContents }))
			// .pipe(gulp.dest(''));
	};
};