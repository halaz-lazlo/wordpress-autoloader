module.exports = {
  dev: {
    options: {
      sourceMap: false,
      includePaths: [
        'node_modules'
      ]
    },
    files: [{
      expand: true,
      cwd: '<%= config.src %>/scss',
      src: ['**/*.scss'],
      dest: '<%= config.dist %>/css/',
      ext: '.css'
    }]
  },
  dist: {
    options: {
      sourceMap: false,
      outputStyle: 'compressed',
      includePaths: [
        'node_modules'
      ]
    },
    files: [{
      expand: true,
      cwd: '<%= config.src %>/scss',
      src: ['**/*.scss'],
      dest: '<%= config.dist %>/css/',
      ext: '.min.css'
    }]
  }
};
