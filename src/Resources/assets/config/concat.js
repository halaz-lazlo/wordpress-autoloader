module.exports = {
  dist: {
    files: {
      '<%= config.dist %>/js/vendor.js': [
        'node_modules/masonry-layout/dist/masonry.pkgd.js',
        'node_modules/jquery/dist/jquery.js'
      ],
      '<%= config.dist %>/js/main.js': [
        '<%= config.src %>/js/main.js'
      ],
      '<%= config.dist %>/js/admin.js': [
        'node_modules/@claviska/jquery-minicolors/jquery.minicolors.min.js',
        '<%= config.src %>/js/minicolors.js',
        '<%= config.src %>/js/admin.js'
      ]
    }
  }
};
