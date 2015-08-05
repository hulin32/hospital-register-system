module.exports = (grunt)->

    stringify = require 'stringify'
    coffeeify = require 'coffeeify'

    grunt.initConfig

        concurrent:
            dev:
                tasks: ['nodemon', 'watch']
                options:
                    logConcurrentOutput: true

        copy:
            dev:
                files: [
                    { expand: true, flatten: true, src: ["src/js/*"], dest: 'dist/js/'}
                ]

        clean:
            dist: ['dist']

        watch:
            compile:
                options:
                    livereload: 1337
                files: ['src/**/*.less', 'src/**/*.js']
                tasks: ['less', 'copy']            

        less:
            components:
                files:
                    'dist/css/base.css': ['src/css/base.less']
                    'dist/css/common.css': ['src/css/common.less']
                    'dist/css/hospital/introduction.css': ['src/css/hospital/introduction.less']
                    'dist/css/hospital/traffic_guide.css': ['src/css/hospital/traffic_guide.less']
                    'dist/css/hospital/department/detail.css': ['src/css/hospital/department/detail.less']
                    'dist/css/hospital/department/overview.css': ['src/css/hospital/department/overview.less']
                    'dist/css/hospital/usage.css': ['src/css/hospital/usage.less']
                    'dist/css/register/select_department.css': ['src/css/register/select_department.less']
                    'dist/css/register/select_doctor.css': ['src/css/register/select_doctor.less']
                    'dist/css/register/select_schedule.css': ['src/css/register/select_schedule.less']
                    'dist/css/register/select_period.css': ['src/css/register/select_period.less']
                    'dist/css/register/success.css': ['src/css/register/success.less']
                    'dist/css/user/center.css': ['src/css/user/center.less']
                    'dist/css/user/feedback/index.css': ['src/css/user/feedback/index.less']
                    'dist/css/user/feedback/success.css': ['src/css/user/feedback/success.less']
                    'dist/css/user/login.css': ['src/css/user/login.less']
                    'dist/css/user/pay_record.css': ['src/css/user/pay_record.less']
                    'dist/css/user/record.css': ['src/css/user/record.less']
                    'dist/css/user/register/index.css': ['src/css/user/register/index.less']
                    'dist/css/user/register/success.css': ['src/css/user/register/success.less']

    grunt.loadNpmTasks 'grunt-contrib-copy'
    grunt.loadNpmTasks 'grunt-contrib-clean'
    grunt.loadNpmTasks 'grunt-contrib-less'
    grunt.loadNpmTasks 'grunt-contrib-watch'

    grunt.registerTask 'default', ->
        grunt.task.run [
            'clean'
            'copy'
            'less'
            'watch'
        ]

    grunt.registerTask 'prod', ->
        grunt.task.run [
            'clean'
            'copy'
            'less'
            'watch'
        ]
