define [
	'jquery'
	'marionette'
	'hbs!templates/profile'
	'moment'
],($, Marionette, hbsTemplate, Moment)->

	TIMEOUT = 1000*5 # ms

	class ProfileView extends Marionette.ItemView
		template: hbsTemplate

		ui:
			numeroMembre: '#numeroMembre'
			region: '#region'
			dateInscription: '#dateInscription'
			nomInput: '#nomInput'
			prenomInput: '#prenomInput'
			deviseInput: '#deviseInput'
			civiliteInput: '#civiliteInput'
			enfantsInput: '#enfantsInput'
			statutInput: '#statutInput'
			genreInput: '#genreInput'
			dateNaissanceInput: '#dateNaissanceInput'

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

			@ui.numeroMembre.text data.numero
			@ui.region.text data.region
			@ui.dateInscription.text Moment(data.dateInscription).format('LL')

			for key, value of data
				@ui["#{key}Input"]?.val(value)

			console.groupEnd()

		handleError: (jqXHR, textStatus, errorThrown)=>
			throw "Error: #{textStatus} - #{errorThrown}"

		onRender: ->
			@refreshData()
