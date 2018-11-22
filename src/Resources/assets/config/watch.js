module.exports = {
	ts: {
			files: [
				'<%= config.src %>/ts/**/*',
			],
			tasks: [
				'ts',
				'browserify',
				'concat',
				'clean:caches'
			],
			options: {
				spawn: false
			}
	},
	css: {
		files: [
			'<%= config.src %>/scss/**/*'
		],
		tasks: [
			'sass',
			'postcss'
		],
		options: {
			spawn: false
		}
	},
	jpg: {
		files: ['<%= config.src %>/img/**/*.jpg'],
		tasks: ['imagemin:jpg'],
		options: {
			spawn: false
		}
	},
	png: {
		files: ['<%= config.src %>/img/**/*.png'],
		tasks: ['imagemin:png'],
		options: {
			spawn: false
		}
	},
	svgs: {
		files: ['<%= config.src %>/svg/**/*'],
		tasks: ['imagemin:svgs', 'svgstore'],
		options: {
			spawn: false
		}
	},
	fonts: {
		files: ['<%= config.src %>/fonts/**/*'],
		tasks: ['copy:custom_fonts'],
		options: {
			spawn: false
		}
	},
	languages: {
		files: ['../inc/languages/*.po'],
		tasks: ['po2mo'],
		options: {
			spawn: false
		}
	}
};
