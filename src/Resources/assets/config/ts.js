module.exports = {
  default : {
    options: {
      target: 'es2015',
      module: 'commonjs',
      sourceMap: false,
      rootDir: '<%= config.src %>/ts'
    },
    src: ["<%= config.src %>/ts/index.ts"],
    outDir: '<%= config.dist %>/ts-compiled'
  }
};
