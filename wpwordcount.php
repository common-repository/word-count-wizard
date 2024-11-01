<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://www.wp-wordcount-wizard.com/
 * @since             1.0.0
 * @package           Word_Count_Wizard
 *
 * @wordpress-plugin
 * Plugin Name:       Word Count Wizard
 * Plugin URI:        http://www.wp-wordcount-wizard.com/
 * Description:       Word Count Statistics for your Posts, Pages and Custom Post Types.
 * Version:           1.0.4
 * Author:            Juan the Wizard
 * Author URI:        http://www.wp-wordcount-wizard.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       word-count-wizard
 */

// If this file is called directly, abort.
if (! defined('WPINC')) {
    die;
}

define('WCWIZARD_V', '1.0.4');

function activate_wcwizard()
{
    require_once plugin_dir_path(__FILE__) . 'includes/class-wcwizard-activator.php';
    wcwizard_Activator::activate();
}

function deactivate_wcwizard()
{
    require_once plugin_dir_path(__FILE__) . 'includes/class-wcwizard-deactivator.php';
    wcwizard_Deactivator::deactivate();
}

register_activation_hook(__FILE__, 'activate_wcwizard');
register_deactivation_hook(__FILE__, 'deactivate_wcwizard');

require plugin_dir_path(__FILE__) . 'includes/class-wcwizard.php';
require plugin_dir_path(__FILE__) . 'includes/functions-wcwizard.php';

/**
 * Begins execution of WP Word Count Wizzard.
 *
 * @since    1.0.0
 */
function run_wcwizard()
{
    $plugin = new wcwizard();
    $plugin->run();
}
run_wcwizard();
