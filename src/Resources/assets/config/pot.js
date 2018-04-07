module.exports = {
  options: {
    text_domain: 'wpa',
    dest: '../languages/',
    keywords: ['gettext', '__'],
    language: 'php',
    msgmerge: true,
    encoding: 'UTF-8'
  },
  files: {
    src: ['../*.php', '../src/**/*.php'],
    expand: true
  }
};
