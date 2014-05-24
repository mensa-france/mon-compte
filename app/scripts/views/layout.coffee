define [
	'marionette'
	'hbs!templates/layout'
],(Marionette, hbsTemplate)->

	class LayoutView extends Marionette.Layout
		template: hbsTemplate