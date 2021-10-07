<?php

/**
 * Fired during plugin activation
 *
 * @link       https://github.com/NHidayat/
 * @since      1.0.0
 *
 * @package    Jne_Tracing
 * @subpackage Jne_Tracing/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Jne_Tracing
 * @subpackage Jne_Tracing/includes
 * @author     Muhammad Nur Hidayat <dayaters22@gmail.com>
 */
class Jne_Tracing_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {

		$current_db_version = 1.0;
		$installed_db_version = get_option('db_jne_tracing_api_version', 0);

		if ($current_db_version > $installed_db_version) {
			self::app_create_jne_tracing_api_db();
			update_option('db_jne_tracing_api_version', $current_db_version);
		}


	}

	protected static function app_create_jne_tracing_api_db() {
		global $wpdb;

		$query = array(
			"CREATE TABLE {$wpdb->prefix}jne_tracing_api (
			api_id INT NOT NULL AUTO_INCREMENT,
			api_key VARCHAR(255) NOT NULL,
			username VARCHAR(100) NOT NULL,
			iat DATETIME NOT NULL,
			uat DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
			PRIMARY KEY (api_id)
			)"
		);

		// execute query
		require_once ABSPATH . 'wp-admin/includes/upgrade.php';
		dbDelta($query);

		}
}