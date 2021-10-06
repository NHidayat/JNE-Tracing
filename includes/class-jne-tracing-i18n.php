<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://github.com/NHidayat/
 * @since      1.0.0
 *
 * @package    Jne_Tracing
 * @subpackage Jne_Tracing/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Jne_Tracing
 * @subpackage Jne_Tracing/includes
 * @author     Muhammad Nur Hidayat <dayaters22@gmail.com>
 */
class Jne_Tracing_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'jne-tracing',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
