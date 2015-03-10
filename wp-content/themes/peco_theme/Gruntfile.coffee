'use strict'

module.exports = (grunt) ->

  # ****************************************************************************
  #  Variables
  # ****************************************************************************

  ROOT_PATH              = '.'
  PROJECT_PATH           = ROOT_PATH + '/'
  ASSET_STYLE_PATH       = ROOT_PATH + '/assets/scss'
  ASSET_JAVASCRIPT_PATH  = ROOT_PATH + '/assets/scripts'
  ASSET_TEMP_PATH        = ROOT_PATH + '/assets/tmp'
  OUTPUT_STYLE_PATH      = PROJECT_PATH + '/resource/css'
  OUTPUT_JAVASCRIPT_PATH = PROJECT_PATH + '/resource/scripts'

  # 開発モード
  #
  # grunt -p[--production] で実行すると本番モードへ移行
  #
  # @constant
  # @type {Boolean}
  DEVELOPMENT = !(grunt.option('p') || grunt.option('production'))

  # ****************************************************************************
  #  Require
  # ****************************************************************************

  # defaultSetVal = require './variables/meta.coffee'


  # ****************************************************************************
  #  Options
  # ****************************************************************************

  options =

    pkg: grunt.file.readJSON('package.json')

    # --------------------------------------------------------------------------
    # JS: concat する
    concat:
      all:
        src: [
          ASSET_JAVASCRIPT_PATH + '/library/jquery.min.js'
          # ASSET_JAVASCRIPT_PATH + '/modules/browser.js'
          ASSET_JAVASCRIPT_PATH + '/plugins/jquery.smoothScroll.js'
          ASSET_JAVASCRIPT_PATH + '/common.js'
        ]
        dest: if DEVELOPMENT then OUTPUT_JAVASCRIPT_PATH + '/all.min.js' else ASSET_TEMP_PATH + '/all.min.js'
      ie:
        src: [
          ASSET_JAVASCRIPT_PATH + '/jquery.backgroundSize.js'
          ASSET_JAVASCRIPT_PATH + '/ie.js'
        ]
        dest: if DEVELOPMENT then OUTPUT_JAVASCRIPT_PATH + '/ie.min.js' else ASSET_TEMP_PATH + '/ie.min.js'

    # --------------------------------------------------------------------------
    # JS: ugllify する（※開発モードでは使用しない）
    uglify:
      options:
        mangle: false
        sourceMap: false
        sourceMapIncludeSources: true
      build:
        expand: true
        cwd: ASSET_TEMP_PATH
        src: ['*.js']
        # ext: '.min.js'
        dest: OUTPUT_JAVASCRIPT_PATH

    # --------------------------------------------------------------------------
    # CSS: compass
    compass:
      prod:
        options:
          config: ROOT_PATH + '/config.rb'
          environment: 'production'
      dev:
        options:
          config: ROOT_PATH + '/config.rb'
          environment: 'development'

    # --------------------------------------------------------------------------
    # CSS: メディアクエリをまとめる
    cmq:
      clean:
        src: [
          OUTPUT_STYLE_PATH + '/*.css'
        ]
        dest: ASSET_TEMP_PATH

    # --------------------------------------------------------------------------
    # CSS: minfy する
    csso:
      minify:
        expand: true
        cwd: ASSET_TEMP_PATH
        src: ['*.css', '!*.min.css']
        dest: OUTPUT_STYLE_PATH
        ext: '.css'

    # --------------------------------------------------------------------------
    # 開発モードの時の watch タスク
    watch:
      script:
        files: [
          ASSET_JAVASCRIPT_PATH + '/*.js'
          ASSET_JAVASCRIPT_PATH + '/**/*.js'
        ]
        tasks:[
          'concat'
        ]
      style:
        files: [
          ASSET_STYLE_PATH + '/**/*.scss'
        ]
        tasks:[
          'compass'
        ]

  # 製品モードの watch タスク
  if !DEVELOPMENT
    options.watch.script.tasks.push('uglify')
    options.watch.style.tasks.push('cmq', 'csso')


  # ****************************************************************************
  #  initConfig
  # ****************************************************************************

  # console.log(options.watch);
  # return;
  grunt.initConfig(options)


  # ****************************************************************************
  #  Plugins
  # ****************************************************************************

  grunt.loadNpmTasks 'grunt-contrib-concat'
  grunt.loadNpmTasks 'grunt-contrib-uglify'
  grunt.loadNpmTasks 'grunt-contrib-watch'
  grunt.loadNpmTasks 'grunt-contrib-compass'
  grunt.loadNpmTasks 'grunt-csso'
  grunt.loadNpmTasks 'grunt-combine-media-queries'


  # ****************************************************************************
  #  Default task
  # ****************************************************************************

  grunt.registerTask 'default', 'watch'
