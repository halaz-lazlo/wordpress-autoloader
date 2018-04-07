module.exports = {
  options: {
    prefix: 'shape-', // This will prefix each <g> ID
    cleanup: true,
    cleanupdefs: true,
    formatting: {
      indent_size: 2
    },
    svg: {
      viewBox: '0 0 100 100',
      xmlns: 'http://www.w3.org/2000/svg'
    },
    includeTitleElement: false
  },
  default: {
    files: {
      '<%= config.dist %>/svg/shapes/svg-defs.svg': ['<%= config.src %>/svg/shapes/*.svg']
    }
  }
};
