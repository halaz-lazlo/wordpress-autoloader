module.exports = {
    dist: {
        options: {
           transform: [
              ["babelify", { "presets": ["es2015"] }]
           ]
        },
        files: {
            '<%= config.dist %>/js/bundle.js': ['<%= config.dist %>/ts-compiled/index.js']
        }
    }
}
