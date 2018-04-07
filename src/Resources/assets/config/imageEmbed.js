module.exports = {
  dist: {
    options: {
        regexInclude: '/\.(jpg|png|gif|jpeg)/gi'
    },
    src: ['<%= config.dist %>/css/main.min.css'],
    dest: '<%= config.dist %>/css/main.min.css'
  }
}
