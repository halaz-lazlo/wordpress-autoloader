module.exports = {
    dist: {
        options: {
           transform: [
              ["babelify", { "presets": ["es2015"] }]
           ]
        },
        files: {
          '<%= config.dist %>/js/main.js': ['<%= config.src %>/js/main.js'],
          '<%= config.dist %>/js/admin.js': ['<%= config.src %>/js/admin.js']
        }
    }
}
