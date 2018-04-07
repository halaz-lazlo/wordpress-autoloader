module.exports = {
	dist: {
		files: [{
      expand: true,
      cwd: '<%= config.dist %>/js',
      src: ['*.js'],
      dest: '<%= config.dist %>/js/',
      ext: '.min.js'
    }]
	}
};
