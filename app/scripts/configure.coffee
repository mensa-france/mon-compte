define [
	'jquery'
	'utils/filesystem'
	'leaflet'
	'fastclick'
	'leafletRotate'
	'utils/notification'
],($, FileSystem, L, FastClick, LeafletRotate, notification)->

	console.group 'Running generic configuration.'

	console.log 'Initializing filesystem.'
	#FileSystem.setQuota 4*1024*1024*1024 # 4GB quota

	FileSystem.setDefaultFailureHandler (error)->
		console.error 'FileSystem error: '+error.code+':'+FileSystem.getFileErrorKey(error)

	console.log 'Configuring leaflet.'
	L.Icon.Default.imagePath = 'images/leaflet'

	# disable page element dragging.
	console.log 'Disabling page element dragging.'
	$(document.body).on 'dragstart', (event)->
		event.preventDefault()

	# enable fastclick
	console.log 'Enabling fastclick.'
	FastClick.attach document.body

	console.log 'Initializing notification system.'
	notification.initialize()

	console.groupEnd()

	onDeviceReady: ->
		# called when devide is ready.
		console.group 'Running device ready configuration.'

		# Configure cordova keyboard plugin if it exists.
		if Keyboard?.hideFormAccessoryBar?
			console.log 'Configuring keyboard.'
			Keyboard.hideFormAccessoryBar true

		if SleepControl?.setEnabled?
			console.log 'Allow screen sleep.'
			SleepControl.setEnabled true # Enable sleep in case of application reload.

		console.groupEnd()
