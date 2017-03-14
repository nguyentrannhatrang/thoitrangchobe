/*global module:false*/
'use strict';
module.exports = function (grunt) {

    // Project configuration.
    grunt.initConfig({
        // Metadata.
        pkg: grunt.file.readJSON('package.json'),
        banner: '/*! <%= pkg.title || pkg.name %> - v<%= pkg.version %> - ' +
            '<%= grunt.template.today("yyyy-mm-dd") %>\n' +
            '<%= pkg.homepage ? "* " + pkg.homepage + "\\n" : "" %>' +
            '* Copyright (c) <%= grunt.template.today("yyyy") %> <%= pkg.author.name %>;' +
            ' Licensed <%= _.pluck(pkg.licenses, "type").join(", ") %> */\n',
        // Before generating any new files, remove any previously-created files.
        clean: {
            tests: ['tmp']
        },
        // Task configuration.
        ngmin: {
            appsite: {
                src: [
                    'sites/js/registry.js',
                    'sites/js/app.js',
                    'sites/js/details.js',
                    'js/template-widget.js',
                    'sites/js/checkout.js'
                ],
                dest: 'tmp/appsite.js'
            }
        },
        uglify: {
            widget: {
                files: {
                	'sites/min/appsite.min.js': ['tmp/appsite.js']
                }
            }
        },
        concat: {
            widget: {
                files: {
                	'sites/js/appsite.all.js': [
                        'sites/js/jquery-3.1.1.min.js',
                        'sites/js/bootstrap.min.js',
                        'sites/js/owl.carousel.min.js',
                        'sites/js/wow.min.js',
                        'sites/js/accounting.min.js',
                        'sites/min/appsite.min.js']
                }
            }
        }
    });

    // These plugins provide necessary tasks.
    grunt.loadNpmTasks('grunt-ngmin');
    grunt.loadNpmTasks('grunt-contrib-concat');
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-htmlmin');
    grunt.loadNpmTasks('grunt-angular-templates');
    
    // Default task.
    grunt.registerTask('default', [ 'ngmin', 'uglify', 'concat']);
};
