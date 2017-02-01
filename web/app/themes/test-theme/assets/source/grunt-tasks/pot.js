/**
 * Scan files and creates a .pot file using xgettext
 * @link https://github.com/stephenharris/grunt-pot
 */

	module.exports = {

		options: {
			text_domain: '<%= config.theme.text_domain %>',
			dest: '<%= config.theme.source.lang_files %>/',
			encoding: 'UTF-8',
			omit_header: false,
			keywords: [
				'__:1',
				'_e:1',
				'_x:1,2c',
				'esc_html__:1',
				'esc_html_e:1',
				'esc_html_x:1,2c',
				'esc_attr__:1',
				'esc_attr_e:1',
				'esc_attr_x:1,2c',
				'_ex:1,2c',
				'_n:1,2',
				'_nx:1,2,4c',
				'_n_noop:1,2',
				'_nx_noop:1,2,3c'
			],
			msgmerge: true
		},

		files: {
			src: [
				'<%= config.theme.source.php_files %>/*.php',
				'<%= config.theme.source.php_files %>/**/*.php'
		 ],
			expand: true
		}

	};
