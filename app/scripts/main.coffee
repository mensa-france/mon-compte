require.config
	paths:
		jquery: '../bower_components/jquery/dist/jquery'
		'jquery.transit': '../bower_components/jquery.transit/jquery.transit'

		underscore: '../bower_components/underscore/underscore'

		backbone: '../bower_components/backbone/backbone'
		marionette: '../bower_components/backbone.marionette/lib/backbone.marionette'

		handlebars: '../bower_components/handlebars/handlebars.runtime'

		lodash: '../bower_components/lodash/dist/lodash'

		moment: '../bower_components/momentjs/moment'
		momentFr: '../bower_components/momentjs/lang/fr'

		consolePolyfill: '../bower_components/console-polyfill/index'

		startRating: '../bower_components/bootstrap-star-rating/js/star-rating'

	shim:
		bootstrap:
			deps: ['jquery']
			exports: 'jquery'

		backbone:
			deps: ['jquery','underscore']
			exports: 'Backbone'

		'jquery.transit':
			deps: ['jquery']

		startRating:
			deps: ['jquery']

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

