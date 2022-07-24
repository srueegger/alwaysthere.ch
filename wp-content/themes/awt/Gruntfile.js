module.exports = function( grunt ) {
    'use strict';

    // Load all grunt tasks
    require('matchdep').filterDev('grunt-*').forEach(grunt.loadNpmTasks);

    // Project configuration
    grunt.initConfig( {
        pkg:    grunt.file.readJSON( 'package.json' ),
        concat: {
            options: {
                stripBanners: true,
                banner: '/*! <%= pkg.title %> - v<%= pkg.version %>\n' +
                ' * <%= pkg.homepage %>\n' +
                ' * Copyright (c) <%= grunt.template.today("yyyy") %>;' +
                ' */\n'
            },
            basetheme: {
                src: [
                    'node_modules/bootstrap/dist/js/bootstrap.bundle.min.js',
                    'dev-assets/js/_vendor/*.js',
                    'dev-assets/js/src/main.js',
                ],
                dest: 'dev-assets/js/theme.js'
            }
        },
        jshint: {
            browser: {
                all: [
                    'dev-assets/js/**/*.js'
                ],
                options: {
                    jshintrc: '.jshintrc'
                }
            },
            grunt: {
                all: [
                    'Gruntfile.js'
                ],
                options: {
                    jshintrc: '.gruntjshintrc'
                }
            }
        },
        uglify: {
            all: {
                files: {
                    'dist-assets/js/theme.min.js': ['dev-assets/js/theme.js']
                },
                options: {
                    banner: '/*! <%= pkg.title %> - v<%= pkg.version %>\n' +
                    ' * <%= pkg.homepage %>\n' +
                    ' * Copyright (c) <%= grunt.template.today("yyyy") %>;' +
                    ' */\n',
                    mangle: {
                        reserved: ['jQuery']
                    }
                }
            }
        },

        sass:   {
            all: {
                files: {
                    'dev-assets/css/theme.css': 'dev-assets/css/src/theme.scss'
                }
            }
        },

        purgecss: {
            my_target: {
                options: {
                    safelist: ['h2', 'menu', 'menu-item', 'animation-left', 'animation-right', 'animation-up', 'animation-down'],
                    content: ['./**/*.php']
                },
                files: {
                    'dev-assets/css/theme-purge.css': ['dev-assets/css/theme.css']
                }
            }
        },

        cssmin: {
            options: {
                banner: '/*! <%= pkg.title %> - v<%= pkg.version %>\n' +
                ' * <%= pkg.homepage %>\n' +
                ' * Copyright (c) <%= grunt.template.today("yyyy") %>;' +
                ' */\n'
            },
            minify: {
                expand: true,

                cwd: 'dev-assets/css/',
                src: ['theme-purge.css'],

                dest: 'dist-assets/css/',
                ext: '.min.css'
            }
        },

        watch:  {

            sass: {
                files: ['dev-assets/css/_vendor/**/*.scss', 'dev-assets/css/src/**/*.scss'],
                tasks: ['sass', 'purgecss', 'cssmin'],
                options: {
                    debounceDelay: 500
                }
            },

            scripts: {
                files: ['dev-assets/js/src/**/*.js', 'dev-assets/js/_vendor/**/*.js'],
                tasks: ['jshint', 'concat', 'uglify'],
                options: {
                    debounceDelay: 500
                }
            }
        }
    } );

    // Default task.

    grunt.registerTask( 'default', ['jshint', 'concat', 'uglify', 'sass', 'purgecss', 'cssmin'] );


    grunt.util.linefeed = '\n';
};