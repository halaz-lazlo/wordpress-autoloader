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
        // 'clean',
        // 'copy',
        // 'eslint',
        // 'browserify',
        // 'uglify',
        'scsslint',
        'imagemin',
        // 'svgstore',
        'sass',
        'postcss',
        'cmq',
        // 'px_to_rem',
        // 'chmod',
        // 'po2mo'
        // 'imageEmbed'
    ]);
}
