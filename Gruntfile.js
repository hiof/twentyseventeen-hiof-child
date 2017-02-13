module.exports = function(grunt) {
  // Loads each task referenced in the packages.json file
  require("matchdep").filterDev("grunt-*").forEach(grunt.loadNpmTasks);
  require('time-grunt')(grunt);


  var mySecret = false;
  if (grunt.file.exists('secret.json')) {
    mySecret = grunt.file.readJSON('secret.json');
  }


  // Initiate grunt tasks
  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),

    // Tasks
    sass: {
      options: {

      },
      dist: {
        files: {
          'tmp/css/style.css': 'app/assets/sass/style.scss',
        }
      }
    },
    autoprefixer: {
      options: {
        browsers: ['last 2 versions', 'ie 8', 'ie 9']
        //diff: 'build/config/*.diff'
      },
      prefix: {
        expand: true,
        //flatten: true,
        cwd: 'tmp/css/',
        src: '*.css',
        dest: 'build/twentyseventeen-hiof-child'
      }
    },
    cssmin: {
      main: {
        options: {
          keepSpecialComments: '*',
          banner: ''
        },
        expand: true,
        cwd: 'build/twentyseventeen-hiof-child',
        src: ['*.css', '!*.min.css'],
        dest: 'build/twentyseventeen-hiof-child',
        ext: '.css'
      }
    },
    copy: {
      php:{
        expand: true,
        cwd: 'app/php/',
        src: '**',
        dest: 'build/twentyseventeen-hiof-child/',
        filter: 'isFile'
      },
      wpFiles:{
        expand: true,
        cwd: 'app/wp-files/',
        src: '**',
        dest: 'build/twentyseventeen-hiof-child/',
        filter: 'isFile'
      },
      dist:{
        expand: true,
        cwd: 'build/',
        src: '**',
        dest: 'dist/',
        filter: 'isFile'
      },
      vw:{
        expand: true,
        cwd: 'dist/',
        src: '**',
        dest: '../vw/wordpress/wp-content/themes/',
        filter: 'isFile'
      }
    },

    clean: {
      dist: ['dist/**/*'],
      temp: ['tmp/**/*'],
      build: ['build/**/*']
    },
    watch: {
      scripts: {
        files: ['app/**/*'],
        tasks: ['vw'],
        options: {
          spawn: false,
        },
      },
    },




    secret: mySecret,
    sftp: {
      stage: {
        files: {
          "./": "deploy/assets/**"
        },
        options: {
          path: '<%= secret.prod.path %>',
          srcBasePath: "deploy/assets/",
          host: '<%= secret.stage.host %>',
          username: '<%= secret.stage.username %>',
          password: '<%= secret.stage.password %>',
          showProgress: true,
          createDirectories: true,
          directoryPermissions: parseInt(755, 8)
        }
      },
      prod: {
        files: {
          "./": "deploy/assets/**"
        },
        options: {
          path: '<%= secret.prod.path %>',
          srcBasePath: "deploy/assets/",
          host: '<%= secret.prod.host %>',
          username: '<%= secret.prod.username %>',
          password: '<%= secret.prod.password %>',
          showProgress: true,
          createDirectories: true,
          directoryPermissions: parseInt(755, 8)
        }
      }
    },

  });

  // ----------------------------------------------------------
  // Tasks

  // Register tasks
  grunt.registerTask('subtaskCss', ['sass', 'autoprefixer', 'cssmin']);
  grunt.registerTask('copyProject', ['copy:php', 'copy:wpFiles', 'copy:dist']);
  grunt.registerTask('build', ['clean', 'subtaskCss', 'copyProject']);


  grunt.registerTask('vw', ['build', 'copy:vw']);

  // grunt.registerTask('dist', ['clean:build', 'subtaskCss', 'subtaskJs', 'versioning:dist', 'subtaskCopy', 'subtaskViews', 'clean:dist', 'copy:dist']);



  // Deploy tasks
  //grunt.registerTask('deploy-stage', [
  //                                      'clean:build',
  //                                      'subtaskCss',
  //                                      'subtaskJs',
  //                                      'versioning:deploy',
  //                                      'subtaskCopyDeploy',
  //                                      'subtaskViews',
  //                                      'clean:deploy',
  //                                      'copy:deploy',
  //                                      'sftp:stage'
  //                                    ]);
  //
  //grunt.registerTask('deploy-prod', [
  //                                    'clean:build',
  //                                    'subtaskCss',
  //                                    'subtaskJs',
  //                                    'versioning:deploy',
  //                                    'subtaskCopyDeploy',
  //                                    'subtaskViews',
  //                                    'clean:deploy',
  //                                    'copy:deploy',
  //                                    'sftp:prod'
  //                                  ]);




};
