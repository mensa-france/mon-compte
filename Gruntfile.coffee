# Generated on 2013-08-07 using generator-webapp 0.2.7
LIVERELOAD_PORT = 35729
lrSnippet = require('connect-livereload')({port: LIVERELOAD_PORT})
gateway = require 'gateway'

mountFolder = (connect, dir)->
	return connect.static(require('path').resolve(dir))

corsMiddleware = (req, res, next)->
	res.setHeader 'Access-Control-Allow-Origin', '*'
	res.setHeader 'Access-Control-Allow-Methods', 'GET,PUT,POST,DELETE'
	res.setHeader 'Access-Control-Allow-Headers', 'Content-Type'
	next()

# # Globbing
# for performance reasons we're only matching one level down:
# 'test/spec/{,*/}*.js'
# use this if you want to recursively match all subfolders:
# 'test/spec/**/*.js'

module.exports = (grunt)->
	# show elapsed time at the end
	require('time-grunt')(grunt)
	# load all grunt tasks
	require('matchdep').filterDev('grunt-*').forEach(grunt.loadNpmTasks)

	# configurable paths
	yeomanConfig =
		app: 'app'
		dist: 'dist'
		public: 'dist/public'

	grunt.initConfig
		yeoman: yeomanConfig
		watch:
			coffee:
				files: ['<%= yeoman.app %>/scripts/**/*.coffee']
				tasks: ['newer:coffee:dist','version']

			coffeeTest:
				files: ['test/spec/**/*.coffee']
				tasks: ['newer:coffee:test']

			compass:
				files: ['<%= yeoman.app %>/styles/{,*/}*.{scss,sass}']
				tasks: ['compass:server']

			styles:
				files: ['<%= yeoman.app %>/styles/{,*/}*.css']
				tasks: ['newer:copy:styles']

			handlebars:
				files: ['<%= yeoman.app %>/scripts/templates/**/*.hbs']
				tasks: ['newer:handlebars:compile']

			livereload:
				options:
					livereload: LIVERELOAD_PORT
				files: [
					'<%= yeoman.app %>/*.html'
					'.tmp/styles/{,*/}*.css'
					'{.tmp,<%= yeoman.app %>}/scripts/{,*/}*.js'
					'<%= yeoman.app %>/images/{,*/}*.{png,jpg,jpeg,gif,webp,svg}'
					'<%= yeoman.app %>/**/*.php'
				]

		connect:
			options:
				port: 9000
				# change this to '0.0.0.0' to access the server from outside
				#hostname: 'localhost'
				hostname: '0.0.0.0'

			livereload:
				options:
					middleware: (connect)->
						[
							corsMiddleware
							lrSnippet
							gateway "#{__dirname}/app", {'.php': 'php-cgi'}
							mountFolder(connect, '.tmp')
							mountFolder(connect, yeomanConfig.app)
						]

			test:
				options:
					middleware: (connect)->
						[
							mountFolder(connect, '.tmp')
							mountFolder(connect, 'test')
						]

			dist:
				options:
					middleware: (connect)->
						[
							mountFolder(connect, yeomanConfig.dist)
						]

		open:
			server:
				path: 'http://localhost:<%= connect.options.port %>'

		clean:
			dist:
				files: [
					dot: true
					src: [
						'.tmp'
						'<%= yeoman.dist %>/*'
						'!<%= yeoman.dist %>/.git*'
					]
				]

			server: '.tmp'

		jshint:
			options:
				jshintrc: '.jshintrc'

			all: [
				'Gruntfile.js'
				'<%= yeoman.app %>/scripts/{,*/}*.js'
				'!<%= yeoman.app %>/scripts/vendor/*'
				'test/spec/{,*/}*.js'
			]

		mocha:
			all:
				options:
					run: true
					urls: ['http://localhost:<%= connect.options.port %>/index.html']

		coffee:
			options:
				sourceMap: true
			dist:
				files: [
					expand: true
					cwd: '<%= yeoman.app %>/scripts'
					src: '**/*.coffee'
					dest: '.tmp/scripts'
					ext: '.js'
				]

			test:
				files: [
					expand: true
					cwd: 'test/spec'
					src: '**/*.coffee'
					dest: '.tmp/spec'
					ext: '.js'
				]

		compass:
			options:
				sassDir: '<%= yeoman.app %>/styles'
				cssDir: '.tmp/styles'
				generatedImagesDir: '.tmp/images/generated'
				imagesDir: '<%= yeoman.app %>/images'
				javascriptsDir: '<%= yeoman.app %>/scripts'
				fontsDir: '<%= yeoman.app %>/styles/fonts'
				importPath: '<%= yeoman.app %>/bower_components'
				httpImagesPath: '/images'
				httpGeneratedImagesPath: '/images/generated'
				httpFontsPath: '/styles/fonts'
				relativeAssets: false

			dist:
				options:
					generatedImagesDir: '<%= yeoman.public %>/images/generated'
					environment: 'production'
					outputStyle: 'compressed'

			server:
				options:
					debugInfo: true

		# not used since Uglify task does concat
		# but still available if needed
		###
		concat:
			dist: {}
		###

		requirejs:
			dist:
				# Options: https:#github.com/jrburke/r.js/blob/master/build/example.build.js
				options:
					# `name` and `out` is set by grunt-usemin
					# baseUrl: yeomanConfig.app + '/scripts'
					baseUrl: '.tmp/scripts', # Used for coffee main script.
					optimize: 'none'
					# TODO: Figure out how to make sourcemaps work with grunt-usemin
					# https:#github.com/yeoman/grunt-usemin/issues/30
					#generateSourceMaps: true
					# required to support SourceMaps
					# http://requirejs.org/docs/errors.html#sourcemapcomments
					preserveLicenseComments: false
					useStrict: true
					wrap: true
					#uglify2: {} # https:#github.com/mishoo/UglifyJS2
					stubModule: ['handlebars']

		useminPrepare:
			options:
				dest: '<%= yeoman.public %>'
			html: '<%= yeoman.app %>/index.html'

		usemin:
			options:
				dirs: ['<%= yeoman.public %>']
			html: ['<%= yeoman.public %>/{,*/}*.html']
			css: ['<%= yeoman.public %>/styles/{,*/}*.css']

		imagemin:
			dist:
				files: [
					expand: true
					cwd: '<%= yeoman.app %>/images'
					src: '{,**/}*.{png,jpg,jpeg}'
					dest: '<%= yeoman.public %>/images'
				]

		svgmin:
			dist:
				files: [
					expand: true
					cwd: '<%= yeoman.app %>/images'
					src: '**/*.min.svg'
					dest: '<%= yeoman.public %>/images'
				]

		cssmin: {}
		# This task is pre-configured if you do not wish to use Usemin
		# blocks for your CSS. By default, the Usemin block from your
		# `index.html` will take care of minification, e.g.
		#
		#	 <!-- build:css({.tmp,app}) styles/main.css -->
		#
		# dist:
		#	 files:
		#		 '<%= yeoman.public %>/styles/main.css': [
		#			 '.tmp/styles/{,*/}*.css'
		#			 '<%= yeoman.app %>/styles/{,*/}*.css'
		#		 ]
		#	 }
		# }

		htmlmin:
			dist:
				###
				options:
					removeCommentsFromCDATA: true
					# https:#github.com/yeoman/grunt-usemin/issues/44
					#collapseWhitespace: true
					collapseBooleanAttributes: true
					removeAttributeQuotes: true
					removeRedundantAttributes: true
					useShortDoctype: true
					removeEmptyAttributes: true
					removeOptionalTags: true
				###

				files: [
					expand: true
					cwd: '<%= yeoman.app %>'
					src: '*.html'
					dest: '<%= yeoman.public %>'
				]

		# Put files not handled in other tasks here
		copy:
			dist:
				files: [
					expand: true
					dot: true
					cwd: '<%= yeoman.app %>'
					dest: '<%= yeoman.public %>'
					src: [
						'*.{ico,png,txt,xml}'
						'.htaccess'
						'images/{,**/}*.{webp,gif}'
						'styles/fonts/*'
						'favicon.png'
                        '/bower_components/requirejs/require.js'
					]
				,
					expand: true
					dot: true
					cwd: 'vendor'
					dest: '<%= yeoman.dist %>/vendor'
					src: '**/*'
				]

			styles:
				expand: true
				dot: true
				cwd: '<%= yeoman.app %>/styles'
				dest: '.tmp/styles/'
				src: '{,**/}*.css'

			js:
				files: [
					expand: true
					dot: true
					cwd: '<%= yeoman.app %>/scripts'
					dest: '.tmp/scripts'
					src: [
						'{,**/}*.js'
					]
				]

			tempTemplates:
				expand: true
				dot: true
				cwd: '<%= yeoman.app %>/scripts/templates'
				dest: '.tmp/scripts/templates'
				src: '{,**/}*.hbs'

			svg:
				expand: true
				dot: true
				cwd: '<%= yeoman.app %>/images'
				dest: '<%= yeoman.public %>/images'
				src: '**/*.svg'

		concurrent:
			server: [
				'compass:server'
				'coffee:dist'
				'copy:styles'
				'handlebars:compile'
			]
			test: [
				'coffee'
				'copy:styles'
			]
			dist: [
				'coffee'
				'compass:dist'
				'copy:styles'
				'imagemin'
				'svgmin'
				'htmlmin'
				'handlebars:compile'
			]

		bower:
			options:
				exclude: ['modernizr']
			all:
				rjsConfig: '<%= yeoman.app %>/scripts/main.js'

		symlink:
			js:
				dest: '.tmp/bower_components'
				relativeSrc: '../app/bower_components'
				options: {type: 'dir'}
			coffeesrc:
				dest: '.tmp/app'
				relativeSrc: '../app'
				options: {type: 'dir'}

		handlebars:
			compile:
				options:
					amd: true
					processName: (filename)->
						filename.replace('app/scripts/templates/', '').replace('.hbs', '')
				files:
					'.tmp/scripts/templates.js': ['<%= yeoman.app %>/scripts/templates/**/*.hbs']

		version:
			options:
				pkg: grunt.file.readJSON('package.json')
			js:
				options:
					prefix: 'appVersion\\s*=\\s*[\'"]'
				src: [
					'.tmp/scripts/version.js'
				]
			bower:
				options:
					prefix: '"version"\\s*:\\s*[\'"]'
				src: [
					'bower.json'
				]

	grunt.registerTask 'server', [
		'clean:server'
		'concurrent:server'
		'version:js'
		'symlink:coffeesrc'
		'connect:livereload'
		'open'
		'watch'
	]

	grunt.registerTask 'test', [
		'clean:server'
		'concurrent:test'
		'connect:test'
		'mocha'
	]

	grunt.registerTask 'build', [
		'clean:dist'
		'useminPrepare'
		'copy:svg'
		'concurrent:dist'
		'copy:js'
		'symlink:js'
		'copy:tempTemplates'
		'version'
		'requirejs'
		'concat'
		'cssmin'
		'uglify'
		'copy:dist'
		'usemin'
	]

	grunt.registerTask 'default', [
		'jshint'
		#'test'
		'build'
	]
