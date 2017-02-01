/**
 * Parses CSS and adds vendor-prefixed CSS properties using the Can I Use database
 * @link https://github.com/nDmitry/grunt-postcss
 */

	module.exports = {

		admin: {
			options: {
				browsers: ['<%= config.theme.browser_support %>'],
				cascade: true,
				safe: true
			},
			src: '<%= config.theme.assets.css.location %>/<%= config.theme.assets.css.admin %>'
		},

		editor: {
			options: {
				browsers: ['<%= config.theme.browser_support %>'],
				cascade: true,
				safe: true
			},
			src: '<%= config.theme.assets.css.location %>/<%= config.theme.assets.css.editor %>'
		},

		login: {
			options: {
				browsers: ['<%= config.theme.browser_support %>'],
				cascade: true,
				safe: true
			},
			src: '<%= config.theme.assets.css.location %>/<%= config.theme.assets.css.login %>'
		},

		main: {
			options: {
				browsers: ['<%= config.theme.browser_support %>'],
				cascade: true
			},
			src: '<%= config.theme.assets.css.location %>/<%= config.theme.assets.css.main %>'
		},

		print: {
			options: {
				browsers: ['<%= config.theme.browser_support %>'],
				cascade: true
			},
			src: '<%= config.theme.assets.css.location %>/<%= config.theme.assets.css.print %>'
		}

	};
