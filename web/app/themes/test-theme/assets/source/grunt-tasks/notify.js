/**
 * Generates notifications
 * @link https://github.com/dylang/grunt-notify
 */

	module.exports = {
		default: {
			options: {
				title: '<%= config.theme.name %>',
				message: 'Grunt is watching ...'
			}
		}
	};
