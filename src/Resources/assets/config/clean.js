module.exports = {
    dist: {
        src: [
            "<%= config.dist %>/.tmp",
            "dist"
        ]
    },
    caches: {
      src: [
        '.tscache',
        '<%= config.dist %>/ts-compiled',
      ]
    }
};
