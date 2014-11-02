define [
    'handlebars'
    'version'
],(Handlebars, version)->

    Handlebars.registerHelper 'appVersion', ->
        version
