module.exports = {
  options: {
    map: false,
    processors: [
      require('autoprefixer')( { browsers: 'last 2 versions'} ),
    ]
  },
  dist: {
    src: '<%= config.dist %>/css/**/*.css'
  }
}
