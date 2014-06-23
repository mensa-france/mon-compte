define [
	'lodash'
	'jquery'
	'marionette'
	'hbs!templates/profile'
	'hbs!templates/messages/error'
	'hbs!templates/messages/info'
	'hbs!templates/messages/success'
	'moment'
	'datepicker'
	'views/profile/genericList'
],(_, $, Marionette, hbsTemplate, errorTemplate, infoTemplate, successTemplate, Moment, _datepicker_, GenericListView)->

	TIMEOUT = 1000*5 # ms
	UI_INPUT_REGEXP = /Input$/

	LIST_NAMES = [
		'langues'
		'competences'
		'passions'
	]

	CIVILITE_MAPPING =
		mister: 'M.'
		mrs: 'Mme.'
		ms: 'Mlle.'

	class ProfileView extends Marionette.Layout
		template: hbsTemplate

		regions:
			languesRegion: '#languesRegion'
			competencesRegion: '#competencesRegion'
			passionsRegion: '#passionsRegion'

		ui:
			fullname: '#fullname'
			form: 'form'
			dateNaissance: '#dateNaissance'

			messageZone: '#messageZone'
			numeroMembre: '#numeroMembre'
			region: '#region'
			dateInscription: '#dateInscription'
			nomInput: '#nomInput'
			prenomInput: '#prenomInput'
			deviseInput: '#deviseInput'
			civiliteInput: '#civiliteInput'
			enfantsInput: '#enfantsInput'
			statutInput: '#statutInput'
			dateNaissanceInputPicker: '#dateNaissanceInputPicker'
			emailInput: '#emailInput'
			emailPriveInput: '#emailPriveInput'
			telephoneInput: '#telephoneInput'
			telephonePriveInput: '#telephonePriveInput'
			adressePriveeInput: '#adressePriveeInput'
			adresse1Input: '#adresse1Input'
			adresse2Input: '#adresse2Input'
			codePostalInput: '#codePostalInput'
			villeInput: '#villeInput'
			paysInput: '#paysInput'

		events:
			'submit form': 'handleFormSubmit'
			'click .btn.cancel': 'handleCancel'

		initialize: ->
			console.group 'Initializing ProfileView:',@options

			@lists = {}

			for name in LIST_NAMES
				@lists[name] = new GenericListView

			console.groupEnd()

		resetForm: ->
			console.debug 'Resetting form...'

			for key, input of @ui
				if key.match UI_INPUT_REGEXP
					if input.is(':checkbox')
						input.prop 'checked', false;
					else
						input.val null

			for list in @lists
				list.empty()

			@ui.numeroMembre.text ''
			@ui.region.text ''
			@ui.dateInscription.text ''
			@ui.dateNaissanceInputPicker.datepicker 'update' # update datepicker value.

		handleCancel: ->
			@clearMessage()
			@refreshData()
			@showInfo 'Réinitialisation du formulaire', 'Vos informations ont été rechargée depuis la base de donnée.'
			@scrollTop()

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

			fullname = "#{data.prenom} #{data.nom}"
			fullname = "#{CIVILITE_MAPPING[data.civilite]} #{fullname}" if CIVILITE_MAPPING[data.civilite]?

			@ui.fullname.text fullname
			@ui.dateNaissance.text Moment(data.dateInscription).format('LL')

			for key, value of data
				if _.contains LIST_NAMES, key
					# the treat as list
					@lists[key].setItemData value
				else
					input = @ui["#{key}Input"]
					if input?.is(':checkbox') && value
						input.prop 'checked', true;
					else
						input?.val(value)

			@ui.numeroMembre.text data.numero
			@ui.region.text data.region
			@ui.dateInscription.text Moment(data.dateInscription).format('LL')
			@ui.dateNaissanceInputPicker.datepicker 'update' # update datepicker value.

			console.groupEnd()

		handleError: (jqXHR, textStatus, errorThrown)=>
			@showError 'Erreurs pendant la lecture du profil', "#{textStatus}\n#{errorThrown}"

		onRender: ->
			@ui.dateNaissanceInputPicker.datepicker(language:'fr')

			for name, view of @lists
				@["#{name}Region"].show view

			@refreshData()

		readFormData: ->
			data = {}

			for key, input of @ui
				if key.match UI_INPUT_REGEXP
					dataKey = key.replace UI_INPUT_REGEXP,''
					if input.is(':checkbox')
						data[dataKey] = (input.is(':checked') ? 1 : 0)
					else
						data[dataKey] = input.val()

			for name, view of @lists
				data[name] = view.getData()

			data

		handleFormSubmit: (event)->
			console.group 'Handling form submit.'
			event.preventDefault()

			if @ui.form.validate()
				@clearMessage()
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

		handleSaveSuccess: (data)=>
			if data.errors?
				console.warn 'Save generated errors:',data.errors
				@showError 'Erreurs pendant la sauvegarde', data.errors.join '\n'
			else
				console.log 'Save completed successfully.'
				@showSuccess 'Sauvegarde du profil effectuée', 'Votre profil a été mis à jour.'
				@refreshData()

		handleSaveError: (jqXHR, textStatus, errorThrown)=>
			@showError 'Erreurs pendant la sauvegarde', "#{textStatus}\n#{errorThrown}"

		clearMessage: ->
			console.debug 'Clearing existing messages.'
			@ui.messageZone.empty()

		showError: (title, message)=>
			@showMessage title,message,errorTemplate

		showInfo: (title, message)=>
			@showMessage title,message,infoTemplate

		showSuccess: (title, message)=>
			@showMessage title,message,successTemplate

		showMessage: (title, message, template)=>
			$message = $(template
				title: title
				message: message
			)

			$message.appendTo(@ui.messageZone)
			@scrollTop()

		scrollTop: ->
			window.scrollTo 0,0
