<?php

/**
 * Fired during plugin activation
 *
 * @link       https://www.word-count-wizard.com/
 * @since      1.0.0
 *
 * @package    wcwizard
 * @subpackage wcwizard/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    wcwizard
 * @subpackage wcwizard/includes
 * @author     Wizzard Software <support@word-count-wizard.com>
 */
class wcwizard_Activator {
	/**
	 * @since    1.0.0
	 */
	public static function activate() {
		
		wcwizard_set_plugin_version(WCWIZARD_V);
		wcwizard_create_plugin_tables();
		wcwizard_populate_plugin_tables();
		
	}
	
}
