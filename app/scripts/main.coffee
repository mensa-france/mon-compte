require.config
	paths:
		jquery: '../bower_components/jquery/dist/jquery'
		'jquery.transit': '../bower_components/jquery.transit/jquery.transit'

		underscore: '../bower_components/underscore/underscore'

		backbone: '../bower_components/backbone/backbone'
		marionette: '../bower_components/backbone.marionette/lib/backbone.marionette'

		handlebars: '../bower_components/handlebars/handlebars'

		hbs: '../bower_components/require-handlebars-plugin/hbs'
		json2: '../bower_components/require-handlebars-plugin/hbs/json2'
		i18nprecompile: '../bower_components/require-handlebars-plugin/hbs/i18nprecompile'

		lodash: '../bower_components/lodash/dist/lodash'

		moment: '../bower_components/momentjs/moment'
		momentFr: '../bower_components/momentjs/lang/fr'

		consolePolyfill: '../bower_components/console-polyfill/index'

		startRating: '../bower_components/bootstrap-star-rating/js/star-rating'

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

		startRating:
			deps: ['jquery']

	hbs:
		disableI18n: true

	packages: [
		'templates/helpers'
	]

require [
	'consolePolyfill'
	'application'
	'underscore'
	'templates'
	'templates/helpers'
	'version'
	'moment'
	'momentFr'
	'startRating'
], (consolePolyfill, app, _, templates, templateHelpers, Version, Moment, MomentFr)->
	console.log 'Application version:',Version
	Moment.lang 'fr'

	app.setMainRegion '#container'

	app.start()

