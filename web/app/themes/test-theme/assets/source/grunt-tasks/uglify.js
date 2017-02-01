/**
 * Minifies JavaScript files with UglifyJS
 * @link https://github.com/gruntjs/grunt-contrib-uglify
 */

	module.exports = {

		dist: {
			options: {
				banner: '/* <%= config.theme.name %> - Main.js */' + "\n",
				compress: {
					global_defs: {
						'DEBUG': false
					},
					drop_debugger: true
				},
				preserveComments: false
			},
			files: {
				'<%= config.theme.assets.js.location %>/<%= config.theme.assets.js.main %>': '<%= config.theme.source.js.location %>/<%= config.theme.source.js.main %>'
			}
		}

	};
