require.config
	paths:
		jquery: '../bower_components/jquery/dist/jquery'

		underscore: '../bower_components/underscore/underscore'

		backbone: '../bower_components/backbone/backbone'
		marionette: '../bower_components/backbone.marionette/lib/backbone.marionette'

		handlebars: '../bower_components/handlebars/handlebars.runtime'

		lodash: '../bower_components/lodash/dist/lodash'

		moment: '../bower_components/momentjs/moment'
		momentFr: '../bower_components/momentjs/lang/fr'

		consolePolyfill: '../bower_components/console-polyfill/index'

		startRating: '../bower_components/bootstrap-star-rating/js/star-rating'

		bootstrap: '../bower_components/bootstrap-sass-official/assets/javascripts/bootstrap'

	map:
		bootstrap:
			'jQuery': 'jquery'

	shim:
		startRating:
			deps: ['jquery']

	packages: [
		'templates/helpers'
	]

require [
	'consolePolyfill'
	'application'
	'version'
	'moment'
	'momentFr'
	'bootstrap'
	'startRating'
], (consolePolyfill, app, Version, Moment, MomentFr)->
	console.log 'Application version:',Version
	Moment.lang 'fr'

	app.setMainRegion '#container'

	app.start()

