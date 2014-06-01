define [
	'marionette'
	'hbs!templates/profile'
],(Marionette, hbsTemplate)->

	class ProfileView extends Marionette.ItemView
		template: hbsTemplate

