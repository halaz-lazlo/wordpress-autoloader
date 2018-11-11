const sass = require('node-sass');

module.exports = {
  dev: {
    options: {
      implementation: sass,
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
      implementation: sass,
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
