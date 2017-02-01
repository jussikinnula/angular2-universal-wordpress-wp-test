/**
 * Compiles Sass to CSS
 * @link https://github.com/gruntjs/grunt-contrib-sass/
 */

	module.exports = {

		admin: {
			options: {
				sourcemap: 'none',
				style: 'compact',
				precision: 15
			},
			files: {
				'<%= config.theme.assets.css.location %>/<%= config.theme.assets.css.admin %>': '<%= config.theme.source.sass.location %>/<%= config.theme.source.sass.admin %>',
				'<%= config.theme.assets.css.location %>/<%= config.theme.assets.css.login %>': '<%= config.theme.source.sass.location %>/<%= config.theme.source.sass.login %>'
			}
		},

		editor: {
			options: {
				sourcemap: 'none',
				style: 'compact',
				precision: 15
			},
			files: {
				'<%= config.theme.assets.css.location %>/<%= config.theme.assets.css.editor %>': '<%= config.theme.source.sass.location %>/<%= config.theme.source.sass.editor %>'
			}
		},

		main: {
			options: {
				style: 'compressed',
				precision: 15
			},
			files: {
				'<%= config.theme.assets.css.location %>/<%= config.theme.assets.css.main %>': '<%= config.theme.source.sass.location %>/<%= config.theme.source.sass.main %>'
			}
		},

		print: {
			options: {
				sourcemap: 'none',
				style: 'compact',
				precision: 15
			},
			files: {
				'<%= config.theme.assets.css.location %>/<%= config.theme.assets.css.print %>': '<%= config.theme.source.sass.location %>/<%= config.theme.source.sass.print %>'
			}
		}

	};
