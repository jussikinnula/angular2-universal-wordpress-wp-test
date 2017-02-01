module.exports = function ( grunt ) {

	'use strict';

/**
 * Tasks and configuration
 *
 * @link https://github.com/firstandthird/load-grunt-config
 */

	require('load-grunt-config')(grunt, {

		configPath: require('path').join( process.cwd(), 'grunt-tasks' ),

		init: true,

		data: {

			config: {

				"theme" : {

					"name"             : "_frc",
					"description"      : "Theme for <code>_frc</code>",
					"theme_uri"        : "",
					"author"           : "Frantic",
					"author_uri"       : "http://www.frantic.com/",
					"text_domain"      : "_frc",
					"version"          : "1.0.0",

					"location"         : "../../.",

					"browser_support"  : "last 3 versions",

					"assets" : {

						"css" : {
							"location"     : "../css",
							"admin"        : "admin.css",
							"editor"       : "editor-style.css",
							"login"        : "login.css",
							"main"         : "main.min.css",
							"print"        : "print.css"
						},

						"js" : {
							"location"     : "../js",
							"main"         : "main.min.js"
						}

					},

					"source" : {

						"js"               : {
							"location"     : "js",
							"main"         : "main.js"
						},

						"lang_files"       : "../../languages",
						"php_files"        : "../../.",

						"sass" : {
							"location"     : "sass",
							"admin"        : "admin.scss",
							"editor"       : "editor-style.scss",
							"login"        : "login.scss",
							"main"         : "main.scss",
							"print"        : "print.scss"
						}

					}
				}
			},

		},

		// Can optionally pass options to load-grunt-tasks.
		// If you set to false, it will disable auto loading tasks.
		loadGruntTasks: {
			pattern: 'grunt-*',
			config: require('./package.json'),
			scope: 'devDependencies'
		},

		// Can post process config object before it gets passed to grunt
		postProcess: function( config ) {},

		// Allows to manipulate the config object before it gets merged with the data object
		preMerge: function( config, data ) {}
	});

	require('time-grunt')( grunt );

};