define [
	'marionette'
	'hbs!templates/layout'
	'views/profile'
],(Marionette, hbsTemplate, ProfileView)->

	class LayoutView extends Marionette.Layout
		template: hbsTemplate

		regions:
			mainRegion: '#mainRegion'

		onRender: ->
			@mainRegion.show new ProfileView
