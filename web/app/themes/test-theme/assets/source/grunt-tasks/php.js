/**
 * Starts PHP servers
 * @link https://github.com/sindresorhus/grunt-php
 */

	module.exports = {

		wordpress: {
			options: {
				base: '<%= config.wordpress.public %>',
				hostname: 'localhost',
				keepalive: true,
				open: true,
				port: 5000
			}
		}

	};
