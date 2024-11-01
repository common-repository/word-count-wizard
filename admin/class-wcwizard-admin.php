<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://www.word-count-wizard.com
 * @since      1.0.0
 *
 * @package    wcwizard
 * @subpackage wcwizard/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    wcwizard
 * @subpackage wcwizard/admin
 * @author     Wizzard Software <support@word-count-wizard.com>
 */
class wcwizard_Admin {

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
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Check plugin version and run updates if necessary.
	 *
	 * @since    1.0.0
	 */

	public function plugin_check() {

		$wcwizard_installed_version = get_option('WCWIZARD_V');

		if ($wcwizard_installed_version != WCWIZARD_V) {

			wcwizard_set_plugin_version( WCWIZARD_V );
			wcwizard_create_plugin_tables();
			wcwizard_populate_plugin_tables();

		}

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/wcwizard-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/wcwizard-admin.js', array( 'jquery', 'jquery-ui-tabs' ), $this->version, false );

	}

	/**
	 * Register the administration menu.
	 *
	 * @since    1.0.0
	 */

	public function menu() {

		$icon_svg = 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAwAAAAQCAYAAAAiYZ4HAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAyBpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuMC1jMDYwIDYxLjEzNDc3NywgMjAxMC8wMi8xMi0xNzozMjowMCAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RSZWY9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZVJlZiMiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENTNSBXaW5kb3dzIiB4bXBNTTpJbnN0YW5jZUlEPSJ4bXAuaWlkOjBCMTZFRDY0ODY1QjExRTc5RDI1QUY2QzYzMkRGQ0JFIiB4bXBNTTpEb2N1bWVudElEPSJ4bXAuZGlkOjBCMTZFRDY1ODY1QjExRTc5RDI1QUY2QzYzMkRGQ0JFIj4gPHhtcE1NOkRlcml2ZWRGcm9tIHN0UmVmOmluc3RhbmNlSUQ9InhtcC5paWQ6MEIxNkVENjI4NjVCMTFFNzlEMjVBRjZDNjMyREZDQkUiIHN0UmVmOmRvY3VtZW50SUQ9InhtcC5kaWQ6MEIxNkVENjM4NjVCMTFFNzlEMjVBRjZDNjMyREZDQkUiLz4gPC9yZGY6RGVzY3JpcHRpb24+IDwvcmRmOlJERj4gPC94OnhtcG1ldGE+IDw/eHBhY2tldCBlbmQ9InIiPz7cn5slAAAAUUlEQVR42mKcs3DZfwYSAAuISI6LZCRG8dxFy/+zIHPwKYYZysRAIiBZAwu6lUTbAPIDzB+42GQ5iQEUD0DAQAwGqR11EjFOYiEm4SEDgAADAEAkrhB6DFthAAAAAElFTkSuQmCC';

		add_menu_page( 'WP Word Count', 'Word Count', 'delete_posts', $this->plugin_name, array( $this, 'admin_display' ), $icon_svg, 99 );

	}

	/**
	 * Add upgrade action link to the plugins page.
	 *
	 * @since    2.0.1
	 */

	public function upgrade_link($links, $file ) {

		if (strpos($file, 'wcwizard.php') !== false) {

			$new_links = array(
				'donate' => '<a href="" target="_blank"><strong>'.__('', $this->plugin_name).'</strong></a>'
			);

			$links = array_merge( $links, $new_links );
		}

	return $links;
	}

	/**
	 * Render the admin display.
	 *
	 * @since    1.0.0
	 */

	public function admin_display() {

		global $wpdb;

		$table_name = $wpdb->prefix.'wcwizard_posts';

		$sql_wcwizard_posts = "
			SELECT post_id, post_author, MID(post_date, 1, 7) AS post_date, post_status, MID(post_modified, 1, 7) AS post_modified, post_parent, post_type, post_category, post_word_count
			FROM $table_name
			WHERE (post_status = 'publish' OR post_status = 'draft')
			ORDER BY post_date DESC";
		$wcwizard_posts = $wpdb->get_results($sql_wcwizard_posts);

		$arr_wcwizard_posts = array();
		$arr_wcwizard_post_types = array();
		$arr_wcwizard_post_types_default = array('post', 'page');
		$arr_wcwizard_totals = array();
		$arr_wcwizard_totals['published'] = 0;
		$arr_wcwizard_totals['draft'] = 0;
		$arr_wcwizard_months = array();
		$arr_wcwizard_authors = array();
		$arr_wcwizard_category = array();

		foreach ($wcwizard_posts as $wcwizard_post) {

			// Load post type array
			if (!isset($arr_wcwizard_post_types[$wcwizard_post->post_type])) {

				$post_type = get_post_type_object(get_post_type($wcwizard_post->post_id));
				$arr_wcwizard_post_types[$wcwizard_post->post_type]['plural_name'] = $post_type->labels->name;
				$arr_wcwizard_post_types[$wcwizard_post->post_type]['singular_name'] = $post_type->labels->singular_name;

				$arr_wcwizard_post_types[$wcwizard_post->post_type]['posts']['published'] = 0;
				$arr_wcwizard_post_types[$wcwizard_post->post_type]['posts']['draft'] = 0;

				$arr_wcwizard_post_types[$wcwizard_post->post_type]['word_counts']['published'] = 0;
				$arr_wcwizard_post_types[$wcwizard_post->post_type]['word_counts']['draft'] = 0;

			}

			$arr_wcwizard_post_types[$wcwizard_post->post_type]['posts'][$wcwizard_post->post_status] += 1;
			$arr_wcwizard_post_types[$wcwizard_post->post_type]['word_counts'][$wcwizard_post->post_status] += $wcwizard_post->post_word_count;

			asort($arr_wcwizard_post_types);

			// Load months array
			if (!isset($arr_wcwizard_months[$wcwizard_post->post_date])) {

				$arr_wcwizard_months[$wcwizard_post->post_date]['total'] = 0;

			}

			if (!isset($arr_wcwizard_months[$wcwizard_post->post_date][$wcwizard_post->post_type])) {

				$arr_wcwizard_months[$wcwizard_post->post_date][$wcwizard_post->post_type]['posts']['published'] = 0;
				$arr_wcwizard_months[$wcwizard_post->post_date][$wcwizard_post->post_type]['posts']['draft'] = 0;

				$arr_wcwizard_months[$wcwizard_post->post_date][$wcwizard_post->post_type]['word_counts']['published'] = 0;
				$arr_wcwizard_months[$wcwizard_post->post_date][$wcwizard_post->post_type]['word_counts']['draft'] = 0;

			}

			$arr_wcwizard_months[$wcwizard_post->post_date][$wcwizard_post->post_type]['posts'][$wcwizard_post->post_status] += 1;
			$arr_wcwizard_months[$wcwizard_post->post_date][$wcwizard_post->post_type]['word_counts'][$wcwizard_post->post_status] += $wcwizard_post->post_word_count;
			$arr_wcwizard_months[$wcwizard_post->post_date]['total'] += $wcwizard_post->post_word_count;

			krsort($arr_wcwizard_months);

			// Load authors array
			if (!isset($arr_wcwizard_authors[$wcwizard_post->post_author]['total'])) {

				$arr_wcwizard_authors[$wcwizard_post->post_author]['total'] = 0;
			}

			if (!isset($arr_wcwizard_authors[$wcwizard_post->post_author][$wcwizard_post->post_type])) {

				$arr_wcwizard_authors[$wcwizard_post->post_author][$wcwizard_post->post_type]['posts']['published'] = 0;
				$arr_wcwizard_authors[$wcwizard_post->post_author][$wcwizard_post->post_type]['posts']['draft'] = 0;

				$arr_wcwizard_authors[$wcwizard_post->post_author][$wcwizard_post->post_type]['word_counts']['published'] = 0;
				$arr_wcwizard_authors[$wcwizard_post->post_author][$wcwizard_post->post_type]['word_counts']['draft'] = 0;

				$arr_wcwizard_authors[$wcwizard_post->post_author]['display_name'] = get_the_author_meta('display_name', $wcwizard_post->post_author);

			}

			$arr_wcwizard_authors[$wcwizard_post->post_author][$wcwizard_post->post_type]['posts'][$wcwizard_post->post_status] += 1;
			$arr_wcwizard_authors[$wcwizard_post->post_author][$wcwizard_post->post_type]['word_counts'][$wcwizard_post->post_status] += $wcwizard_post->post_word_count;
			$arr_wcwizard_authors[$wcwizard_post->post_author]['total'] += $wcwizard_post->post_word_count;

			krsort($arr_wcwizard_months);

			// Load authors array
			if (!isset($arr_wcwizard_category[$wcwizard_post->post_category]['total'])) {

				$arr_wcwizard_category[$wcwizard_post->post_category]['total'] = 0;
			}

			if (!isset($arr_wcwizard_category[$wcwizard_post->post_category][$wcwizard_post->post_type])) {

				$arr_wcwizard_category[$wcwizard_post->post_category][$wcwizard_post->post_type]['posts']['published'] = 0;
				$arr_wcwizard_category[$wcwizard_post->post_category][$wcwizard_post->post_type]['posts']['draft'] = 0;

				$arr_wcwizard_category[$wcwizard_post->post_category][$wcwizard_post->post_type]['word_counts']['published'] = 0;
				$arr_wcwizard_category[$wcwizard_post->post_category][$wcwizard_post->post_type]['word_counts']['draft'] = 0;
				$nombre = (strlen(get_cat_name($wcwizard_post->post_category))==0)?__('Uncategorized'):get_cat_name($wcwizard_post->post_category);
				$arr_wcwizard_category[$wcwizard_post->post_category]['display_name'] = $nombre;

			}

			$arr_wcwizard_category[$wcwizard_post->post_category][$wcwizard_post->post_type]['posts'][$wcwizard_post->post_status] += 1;
			$arr_wcwizard_category[$wcwizard_post->post_category][$wcwizard_post->post_type]['word_counts'][$wcwizard_post->post_status] += $wcwizard_post->post_word_count;
			$arr_wcwizard_category[$wcwizard_post->post_category]['total'] += $wcwizard_post->post_word_count;

			krsort($arr_wcwizard_months);

			// Load totals array
			$arr_wcwizard_totals[$wcwizard_post->post_status] += $wcwizard_post->post_word_count;
			$nombre = (strlen(get_cat_name($wcwizard_post->post_category))==0)?__('Uncategorized'):get_cat_name($wcwizard_post->post_category);
			$arr_wcwizard_post = array(

				'post_id' => $wcwizard_post->post_id,
				'post_title' => get_the_title($wcwizard_post->post_id),
				'post_status' => ucwords($wcwizard_post->post_status),
				'post_type' => $arr_wcwizard_post_types[$wcwizard_post->post_type]['singular_name'],
				'post_author' => $arr_wcwizard_authors[$wcwizard_post->post_author]['display_name'],
				'post_category' => $nombre,
				'post_word_count' => $wcwizard_post->post_word_count,
				'permalink' => get_permalink($wcwizard_post->post_id),
				'post_date_full' => get_the_date('d/m/Y',$wcwizard_post->post_id),

			);

			$arr_wcwizard_posts[] = $arr_wcwizard_post;
		}
	    include_once('partials/wcwizard-admin.php');

	}

	/**
	 * Call public save post data function on post save.
	 *
	 * @since    1.0.0
	 */
	public function post_word_count($post_id, $post) {

		wcwizard_save_post_data($post);

	}

}
