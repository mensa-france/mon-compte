define [
	'marionette'
	'templates'
	'views/profile'
],(Marionette, templates, ProfileView)->

	class LayoutView extends Marionette.LayoutView
		template: templates.layout

		regions:
			mainRegion: '#mainRegion'

		onRender: ->
			@mainRegion.show new ProfileView
