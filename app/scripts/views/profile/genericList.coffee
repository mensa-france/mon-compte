define [
	'backbone'
	'marionette'
	'hbs!templates/profile/genericList'
	'hbs!templates/profile/genericListItem'
],(Backbone, Marionette, hbsTemplate, hbsItemTemplate)->

	RATING_OPTIONS =
		size: 'xs'
		min: 0
		max: 5
		step: 1
		showClear: false
		showCaption: false

	ui:
		name: 'input.name'
		rating: 'input.rating'

	class GenericListItemView extends Marionette.ItemView
		className: 'genericItem'
		template: hbsItemTemplate

		triggers:
			'click .close': 'click:close'

		ui:
			name: 'input.name'
			rating: 'input.rating'

		initialize: ->
			console.group 'Initializing GenericListItemView:',@options
			console.groupEnd()

		onRender: ->
			@ui.rating.rating RATING_OPTIONS

		getData: ->
			nom: @ui.name.val()
			niveau: @ui.rating.val()

	class GenericListView extends Marionette.CompositeView
		className: 'genericList'
		template: hbsTemplate

		itemView: GenericListItemView
		itemViewEventPrefix: 'item'
		itemViewContainer: '.itemContainer'

		itemEvents:
			'click:close': 'handleItemClose'

		events:
			'click .add-button': 'handleAdd'

		initialize: ->
			console.group 'Initializing GenericListView:',@options
			@collection ?= new Backbone.Collection
			console.groupEnd()

		empty: ->
			@collection.reset()

		setItemData: (data)->
			@collection.reset data

		handleAdd: ->
			@collection.add {}

		handleItemClose: (eventName, item)->
			@collection.remove item.model

		getData: ->
			result = []

			@children.each (child)->
				result.push child.getData()

			result
