/**
 * Lints your SCSS
 * @link https://github.com/ahmednuaman/grunt-scss-lint
 */

	module.exports = {

		scsslint: {

			src: [
				'<%= config.theme.source.sass.location %>/<%= config.theme.source.sass.admin %>',
				'<%= config.theme.source.sass.location %>/<%= config.theme.source.sass.editor %>',
				'<%= config.theme.source.sass.location %>/<%= config.theme.source.sass.login %>',
				'<%= config.theme.source.sass.location %>/<%= config.theme.source.sass.main %>',
				'<%= config.theme.source.sass.location %>/<%= config.theme.source.sass.print %>'
			],

			options: {
				bundleExec: false,
				config: '.scss-lint.yml',
				compact: true,
				colorizeOutput: true
			}

		}

	};
