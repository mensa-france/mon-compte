define [
	'jquery'
	'marionette'
	'hbs!templates/profile'
],($, Marionette, hbsTemplate)->

	TIMEOUT = 1000*5 # ms

	class ProfileView extends Marionette.ItemView
		template: hbsTemplate

		ui:
			nomInput: '#nomInput'
			prenomInput: '#prenomInput'
			deviseInput: '#deviseInput'

		initialize: ->
			console.group 'Initializing ProfileView:',@options
			console.groupEnd()

		refreshData: ->
			console.log 'Refreshing data...'
			$.ajax
				url: 'services/getProfile.php'
				timeout: TIMEOUT
				cache: false
				dataType: 'json'
				success: @handleData
				error: @handleError

		handleData: (data, textStatus, jqXHR)=>
			console.group 'Received data:',data

			for key, value of data
				if @ui["#{key}Input"]?
					@ui["#{key}Input"].val(value)

			console.groupEnd()

		handleError: (jqXHR, textStatus, errorThrown)=>
			throw "Error: #{textStatus} - #{errorThrown}"

		onRender: ->
			@refreshData()
