define [
	'jquery'
	'marionette'
	'hbs!templates/profile'
	'moment'
	'datepicker'
],($, Marionette, hbsTemplate, Moment, _datepicker_)->

	TIMEOUT = 1000*5 # ms
	UI_INPUT_REGEXP = /Input$/

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
			dateNaissanceInput: '#dateNaissanceInput'
			dateNaissanceInputPicker: '#dateNaissanceInputPicker'

		events:
			'submit form': 'handleFormSubmit'
			'click .btn.cancel': 'handleCancel'

		initialize: ->
			console.group 'Initializing ProfileView:',@options
			console.groupEnd()

		resetForm: ->
			console.debug 'Resetting form...'

			for key, input of @ui
				if key.match UI_INPUT_REGEXP
					input.val null

			@ui.numeroMembre.text ''
			@ui.region.text ''
			@ui.dateInscription.text ''
			@ui.dateNaissanceInputPicker.datepicker 'update' # update datepicker value.

		handleCancel: ->
			@refreshData()

		refreshData: ->
			console.log 'Refreshing data...'
			@resetForm();
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
				@ui["#{key}Input"]?.val(value)

			@ui.numeroMembre.text data.numero
			@ui.region.text data.region
			@ui.dateInscription.text Moment(data.dateInscription).format('LL')
			@ui.dateNaissanceInputPicker.datepicker 'update' # update datepicker value.

			console.groupEnd()

		handleError: (jqXHR, textStatus, errorThrown)=>
			throw "Error: #{textStatus} - #{errorThrown}"

		onRender: ->
			@ui.dateNaissanceInputPicker.datepicker(language:'fr')
			@refreshData()

		readFormData: ->
			data = {}

			for key, input of @ui
				if key.match UI_INPUT_REGEXP
					data[key.replace UI_INPUT_REGEXP,''] = input.val()

			data

		handleFormSubmit: (event)->
			console.group 'Handling form submit.'
			event.preventDefault()

			formData = @readFormData()

			console.debug 'Form data:',formData

			$.ajax
				url: 'services/saveProfile.php'
				type: 'POST'
				timeout: TIMEOUT
				cache: false
				dataType: 'json'
				data: formData
				success: @handleSaveSuccess
				error: @handleSaveError

			console.groupEnd()

		handleSaveSuccess: =>
			console.log 'Save completed successfully.'
			@refreshData()

		handleSaveError: (jqXHR, textStatus, errorThrown)=>
			throw "Error: #{textStatus} - #{errorThrown}"
