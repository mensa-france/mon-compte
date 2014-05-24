require.config
	paths:
		jquery: '../bower_components/jquery/dist/jquery'
		'jquery.transit': '../bower_components/jquery.transit/jquery.transit'

		underscore: '../bower_components/underscore/underscore'

		backbone: '../bower_components/backbone/backbone'
		'backbone.babysitter': '../bower_components/backbone.babysitter/lib/backbone.babysitter'
		'backbone.wreqr': '../bower_components/backbone.wreqr/lib/amd/backbone.wreqr'
		marionette: '../bower_components/backbone.marionette/lib/core/amd/backbone.marionette'

		handlebars: '../bower_components/handlebars/handlebars'
		
		hbs: '../bower_components/require-handlebars-plugin/hbs'
		json2: '../bower_components/require-handlebars-plugin/hbs/json2'
		i18nprecompile: '../bower_components/require-handlebars-plugin/hbs/i18nprecompile'

		lodash: '../bower_components/lodash/dist/lodash'

	shim:
		bootstrap:
			deps: ['jquery']
			exports: 'jquery'

		underscore:
			exports: '_'

		backbone:
			deps: ['jquery','underscore']
			exports: 'Backbone'

		handlebars:
			exports: 'Handlebars'

		json2:
			exports: 'JSON'

		'jquery.transit':
			deps: ['jquery']

	hbs:
		disableI18n: true

	packages: [
		'templates/helpers'
		'views/screens'
	]

require [
	'application'
	'underscore'
	'templates'
	'templates/helpers'
	'version'
], (app, _, templates, templateHelpers, Version)->
	console.log 'Application version:',Version

	app.setMainRegion '#container'

	app.start()
	