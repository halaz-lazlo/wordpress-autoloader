module.exports = function (grunt) {
    require('load-grunt-tasks')(grunt)

    var configs = require('load-grunt-configs')(grunt);
    configs.config = {
        src: 'src',
        dist: 'dist'
    };
    grunt.initConfig(configs);

    grunt.registerTask('default', [
        'build',
        'watch'
    ]);

    grunt.registerTask('build', [
        'clean',

        'browserify',

        'sass',
        'postcss'
    ]);
}
