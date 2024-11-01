<?php

/**
 * Fired during plugin deactivation
 *
 * @link       https://www.word-count-wizard.com/
 * @since      2.0.1
 *
 * @package    wcwizard
 * @subpackage wcwizard/includes
 */

/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @since      2.0.1
 * @package    wcwizard
 * @subpackage wcwizard/includes
 * @author     Wizzard Software <support@word-count-wizard.com>
 */
class wcwizard_Deactivator {

	/**
	 * Remove tables and options.
	 *
	 * Remove all data from the WordPress database that WP Word Count has generated.
	 *
	 * @since    2.0.1
	 */
	public static function deactivate() {
		
		global $wpdb;
		
		// Empty database tables the plugin has made
		$table_name_posts = $wpdb->prefix.'wcwizard_posts';
		
		$wpdb->query("DELETE FROM $table_name_posts");
		$wpdb->query("DROP TABLE $table_name_posts");
		
		// Delete options the plugin has made
		delete_option('WCWIZARD_V');
		delete_option('wcwizard_post_types');

	}

}
