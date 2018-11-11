module.exports = {
    dist: {
        options: {
           transform: [
              ["babelify", { "presets": ["env"] }]
           ]
        },
        files: {
          '<%= config.dist %>/js/admin.js': ['<%= config.src %>/js/admin.js']
        }
    }
}
