module.exports = function(grunt) {
    // Project configuration.
    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),
        resourcesPath: 'web',
        less: {
            app: {
                options: {
                    paths: ['<%= resourcesPath %>/less'],
                    compress: true,
                    banner: '/*! <%= pkg.name %> <%= grunt.template.today("yyyy-mm-dd") %> */\n'
                },
                files: {
                    // 'web/css/style.min.css': '<%= resourcesPath %>/less/style.less'
                    '<%= resourcesPath %>/css/<%= pkg.name %>.min.css': '<%= resourcesPath %>/less/*.less'
                }
            }
        },
        uglify: {
            options: {
                banner: '/*! <%= pkg.name %> <%= grunt.template.today("yyyy-mm-dd") %> */\n'
            },
            build: {
                src: '<%= resourcesPath %>/uglify/*.js',
                dest: '<%= resourcesPath %>/js/<%= pkg.name %>.min.js'
            }
        },
        watch: {
            styles: {
                files: ['web/less/*.less'], // which files to watch
                tasks: ['less'],
                options: {
                    nospawn: true
                }
            },
            scripts: {
                files: ['web/uglify/*.js'], // which files to watch
                tasks: ['uglify'],
                options: {
                    spawn: false
                }
            }
        }
    });

    grunt.loadNpmTasks('grunt-contrib-uglify');// Load the plugin that provides the "uglify" task.
    grunt.loadNpmTasks('grunt-contrib-less');// Load the plugin that provides the "less" task.
    grunt.loadNpmTasks('grunt-contrib-watch');// Load the plugin that provide the "watch" task.
    // Default task(s).
    // grunt.registerTask('default', ['less', 'watch']);// Default task(s).
    grunt.registerTask('default', ['less', 'uglify', 'watch']);// Default task(s).
};
