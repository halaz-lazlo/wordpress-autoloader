module.exports = function (grunt) {
    require('load-grunt-tasks')(grunt)

    var configs = require('load-grunt-configs')(grunt);
    configs.config = {
      src: 'src',
      dist: 'dist',
      vendors: {
        js: [
          // sortable
          'node_modules/sortablejs/Sortable.min.js',

          // lightgallery
          // 'node_modules/lightgallery/dist/js/lightgallery.min.js',
          // 'node_modules/lg-thumbnail/dist/lg-thumbnail.min.js',

          // maps
          // 'node_modules/google-maps/lib/Google.min.js',
        ]
      }
    };

    grunt.initConfig(configs);

    grunt.registerTask('default', [
        'build',
        'watch'
    ]);

    grunt.registerTask('build', [
        'clean',

        // ts
        'ts',
        'browserify',
        'concat',
        'clean:caches',

        'po2mo',

        'sass',
        'postcss'
    ]);
}
