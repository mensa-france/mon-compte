define [
    'hbs/handlebars'
    'version'
],(Handlebars, version)->
 
    Handlebars.registerHelper 'appVersion', ->
        version