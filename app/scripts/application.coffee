define [
	'underscore'
	'marionette'
	'views/layout'
],(_, Marionette, LayoutView)->

	app = new Marionette.Application

	console.group 'Initializing application.'

	app.setMainRegion = (selector)->
		app.addRegions
			container:
				selector: selector

	app.addInitializer ->
		app.container.show new LayoutView

	console.groupEnd()

	app #return the app instance.
