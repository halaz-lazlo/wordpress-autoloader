module.exports = {
  options: {
    separator: ';',
  },

  dev: {
    src: '<%= config.vendors.js %>',
    dest: '<%= config.dist %>/js/vendors.js',
  },

  prod: {
    src: ['<%= config.dist %>/js/vendors.js', '<%= config.dist %>/js/bundle.js'],
    dest: '<%= config.dist %>/js/admin.js'
  }
}
