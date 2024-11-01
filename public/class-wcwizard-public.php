<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://www.ibidemgroup.com
 * @since      1.0.0
 *
 * @package    wcwizard
 * @subpackage wcwizard/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    wcwizard
 * @subpackage wcwizard/public
 * @author     Link Software LLC <support@linksoftwarellc.com>
 */
class wcwizard_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Display word count stats with shortcode.
	 *
	 * @since 	1.0.0
	 * @param	array	$atts	Shortcode attributes.
	 */
	 
	 public function wcwizard_register_shortcodes() {
		 
		function shortcode($atts) {
			
			global $wpdb;
			global $post;
			
			if ($post) {
				
				extract(shortcode_atts(array(
					'before' => '',
					'after' => 'Words',
				), $atts));
		
				$table_name = $wpdb->prefix.'wcwizard_posts';
				
				$sql_wcwizard_words = $wpdb->prepare("SELECT post_word_count FROM $table_name WHERE post_id = %d", $post->ID);
				$wcwizard_words = $wpdb->get_row($sql_wcwizard_words);
				
				$words = 0 + $wcwizard_words->post_word_count;
				
				return esc_attr($before).' '.number_format($words).' '.esc_attr($after);
				
			}
			
		}
			
		add_shortcode('wcwizard', 'shortcode');
	}

}
