const mozjpeg = require('imagemin-mozjpeg');
const imageminPngquant = require('imagemin-pngquant');

module.exports = {
    jpg: {
        files: [{
            expand: true,
            cwd: '<%= config.src %>',
            src: ['img/**/*.jpg'],
            dest: '<%= config.dist %>'
        }],
        options: {
            progressive: true,
            use: [mozjpeg({
                quality: 85
            })]
        },
    },
    png: {
        files: [{
            expand: true,
            cwd: '<%= config.src %>',
            src: ['img/**/*.png'],
            dest: '<%= config.dist %>'
        }],
        options: {
            progressive: true,
            use: [imageminPngquant({
                quality: 85
            })]
        },
    },
    svg: {
        options: {
            optimizationLevel: 3,
            svgoPlugins: [{ removeViewBox: false }],
        },
        files: [{
            expand: true,
            cwd: '<%= config.src %>',
            src: ['svg/**/*'],
            dest: '<%= config.dist %>'
        }]
    }
}
