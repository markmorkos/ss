module.exports = function (gulp, plugins, config, displayError, cms) {
	if (cms) {
		var host;
		if (config.host) {
			// get host from config.json if defined
			host = config.host;
		} else {
			// generate host address from theme/website name + .web
			switch (config.cms) {
				case "magento":
					if (cms.package == "rwd" || cms.package == "default") {
						host = cms.theme + '.web';
					} else {
						host = cms.package + '.web';
					}
					break;
				case "wordpress":
					host = cms.theme + '.web';
					break;
			}
		}
	}

	var syncArray = function(){
		var array = [],
			targetCms,
			tempArray,
			cmsAssets,
			options = config.browserSync.options,
			assets = ["css", "js", "images", "template"];

		config.cms ? targetCms = config.cms : targetCms = "static";
		switch(targetCms) {
			case "magento":
				cmsAssets = {
					"css": cms.skin + cms.package + '/' + cms.theme + '/' + config.assets.styles.dest + '**/*.css',
					"js": cms.skin + cms.package + '/' + cms.theme + '/js/**/*.js',
					"images": cms.skin + cms.package + '/' + cms.theme + '/' + config.assets.images.src + '**/*.{jpg,png,gif}',
					"template": [
						cms.template + cms.package + '/' + cms.theme + '/**/*.phtml',
						cms.template + 'base/defalut/**/*.phtml'
					]
				};
				break;
			case "wordpress":
				cmsAssets = {
					"css": cms.skin + cms.theme + '/' + config.assets.styles.dest + '**/*.css',
					"js": cms.skin + cms.theme + '/js/**/*.js',
					"images": cms.skin + cms.theme + '/' + config.assets.images.src + '**/*.{jpg,png,gif}',
					"template": cms.skin + cms.theme + '/**/*.php'
				};
				break;
			case "custom":
				cmsAssets = {
					"css": cms.skin + '/' + config.assets.styles.dest + '**/*.css',
					"js": cms.skin + '/js/**/*.js',
					"images": cms.skin + '/' + config.assets.images.src + '**/*.{jpg,png,gif}',
					"template": cms.template
				};
				break;
			case "static":
				cmsAssets = {
					"css": config.assets.styles.dest + '**/*.css',
					"js": './js/**/*.js',
					"images": './' + config.assets.images.src + '**/*.{jpg,png,gif}',
					"template": './**/*.html'
				};
				break;
		}
		function isArray(obj) {
			return Object.prototype.toString.call(obj) === '[object Array]';
		}
		for (var i = 0; i < assets.length; i++) {
			if (options[assets[i] + 'Reload']) {
				if (isArray(cmsAssets[assets[i]])) {
					tempArray = cmsAssets[assets[i]];
					for (var j = 0; j < tempArray.length; j++) {
						array.push(tempArray[j]);
					};
				} else if (typeof(cmsAssets[assets[i]]) === 'string') {
					array.push(cmsAssets[assets[i]]);
				}
			}
		};
		console.log(array);
		return array;
	}

	return function(){
		if (cms) {
			browserSync.init(syncArray(),{proxy: host});
		} else {
			browserSync.init(syncArray(),{
				server: {
					baseDir: './'
				}
			});
		}
	}

};