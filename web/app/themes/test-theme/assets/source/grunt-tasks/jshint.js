/**
 * Validates JavaScript files with JSHint
 * @link https://github.com/gruntjs/grunt-contrib-jshint
 */

	module.exports = {
		options: {
			jshintrc: true
		},
		files: [
			'Gruntfile.js',
			'<%= config.theme.source.js.location %>/<%= config.theme.source.js.main %>'
		]
	};
