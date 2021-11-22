<?php

/**
 * Fired during plugin deactivation
 *
 * @link       https://github.com/NHidayat/
 * @since      1.0.0
 *
 * @package    Jne_Tracing
 * @subpackage Jne_Tracing/includes
 */

/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @since      1.0.0
 * @package    Jne_Tracing
 * @subpackage Jne_Tracing/includes
 * @author     Muhammad Nur Hidayat <dayaters22@gmail.com>
 */
class Jne_Tracing_Deactivator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function deactivate() {
		self::app_drop_jne_tracing_api_db();		
	}

	protected static function app_drop_jne_tracing_api_db() {
		global $wpdb;

		$wpdb->query("DROP TABLE IF EXISTS {$wpdb->prefix}jne_tracing_api");
		delete_option('db_jne_tracing_api_version');
	
	}
}