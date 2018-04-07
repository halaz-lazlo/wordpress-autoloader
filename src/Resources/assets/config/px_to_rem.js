module.exports = {
    dist: {
      options: {
        base: 16,
        fallback: true,
        fallback_existing_rem: true,
        ignore: [],
        map: false
      },
      files: {
        '<%= config.dist %>/css/main.css': ['<%= config.dist %>/css/main.css']
      }
    }
}
