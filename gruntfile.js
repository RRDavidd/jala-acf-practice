module.exports = function(grunt) {
    require('load-grunt-tasks')(grunt);

    // Project configuration.
    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),
        'dart-sass': { // Compiles sass files
            target: {
                options: {
                    sourceMap: true,
                },
                files: {
                    'stylesheets/css/style.css' : 'stylesheets/sass/style.scss',
                },
            },
        },
        postcss: { // Autoprefixes css file based on caniuse database
            options: {
                map: true,
                processors: [
                    require('autoprefixer')({overrideBrowserslist: 'last 3 versions'})
                ],
            },
            dev: {
                src: 'stylesheets/css/style.css',
            },
        },
        watch: { // watches files and runs tasks when files change
            css: {
                files: ['stylesheets/sass/**/*.scss', 'js/modules/*.js' ],
                tasks: ['dart-sass:target', 'postcss:dev',  'concat'],
                options: {
                    livereload: true,
                },
            },
        },
        concat: {
            options: {
                banner: '/* Custom General jQuery \n' +
                '-------------------------------------------------------------------*/\n'+
                '//For JSHint\n' +
                '/*global jQuery,Modernizr */\n' +
                '/*jslint latedef:false*/\n'+
                '/*jslint node:true */\n' +
                '/*jslint browser:true */\n' +
                '(function($) {\n' +
                '"use strict";\n',
                footer: '\n\n}(jQuery));',
                separator: ';\n\n',
            },
            dist: {
                src: ['js/modules/general.js','js/modules/external-funcs.js', 'js/modules/resize-funcs.js', 'js/modules/*.js'],
                dest: 'js/general-built.js',
            },
        },
    });

    // Load the plugins
    grunt.loadNpmTasks('grunt-dart-sass');
    grunt.loadNpmTasks('grunt-postcss');
    grunt.loadNpmTasks('grunt-ssh');
    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.loadNpmTasks('grunt-contrib-concat');

    // Register task(s)
    grunt.registerTask('default', ['dart-sass:target', 'postcss:dev','concat']);
    grunt.registerTask('autoprefix', ['postcss:dev']);
    grunt.registerTask('compile', ['dart-sass:target']);
    grunt.registerTask('concatTask',['concat']);
};
