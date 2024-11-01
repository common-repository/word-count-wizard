<?php

/**
 * The file that defines the core plugin functions
 *
 * Includes functions used across both the public-facing side of the site and the admin area.
 *
 * @link       https://www.word-count-wizard.com/
 * @since      1.0.0
 *
 * @package    wcwizard
 * @subpackage wcwizard/includes
 */

/**
 * The core plugin functions.
 *
 * This is used to define functions for database issues on the admin and public side.
 *
 * @since      1.0.0
 * @package    wcwizard
 * @subpackage wcwizard/includes
 * @author     Wizzard Software <support@word-count-wizard.com>
 */

/**
* Store all posts data to the plugin table
*
* @since    1.0.0
*/
function wcwizard_populate_plugin_tables() {

	$post_types = get_option('wcwizard_post_types');

	global $wpdb;

	$table_name = $wpdb->prefix.'wcwizard_posts';
	$wpdb->query("DELETE FROM $table_name");

	$post_types = get_post_types('', 'names');

	$args = array(

		'post_type' => $post_types,
		'post_status' => array('publish', 'draft'),
		'orderby'   => 'ID',
		'order'     => 'ASC',
		'posts_per_page' => -1

	);

	$query = new WP_Query($args);

	foreach ($query->posts as $post) {

		if ($post->post_author != 0 && $post->post_type != 'attachment' && $post->post_type != 'nav_menu_item') {

			wcwizard_save_post_data($post);

		}

	}
}

/**
 * Maintain our plugin table with post-related information
 *
 * @since   1.0.0
 * @param	int		$post_id	The post ID.
 * @param	post	$post		The post object.
 */
function wcwizard_save_post_data($post) {

	global $wpdb;

	if ($post && $post->post_author != 0) {

		$post_word_count = wcwizard_word_count($post->post_content);
		$table_name = $wpdb->prefix.'wcwizard_posts';

		$sql_post_data = "
			INSERT INTO $table_name (post_id, post_author, post_date, post_status, post_modified, post_parent, post_type, post_category, post_word_count)
			VALUES (%d, %d, %s, %s, %s, %s, %s, %d, %d)
			ON DUPLICATE KEY UPDATE
			post_date = %s,
			post_status = %s,
			post_modified = %s,
			post_parent = %d,
			post_type = %s,
            post_category = %d,
			post_word_count = %d";
		$cats = get_the_category($post->ID);
		$cat = $cats[0]->term_taxonomy_id;
		$post_data = $wpdb->prepare($sql_post_data, $post->ID, $post->post_author, $post->post_date, $post->post_status, $post->post_modified, $post->post_parent, $post->post_type, $cat, $post_word_count, $post->post_date, $post->post_status, $post->post_modified, $post->post_parent, $post->post_type,$cat, $post_word_count);
		$wpdb->query($post_data);

	}

}

/**
 * Calculate word count in a given set of text.
 *
 * @since 	1.0.0
 * @param	string	$content	The post content
 */
function wcwizard_word_count($content) {

	$content = strip_tags( nl2br( $content ) );

	if ( preg_match( "/[\x{4e00}-\x{9fa5}]+/u", $content ) ) {

		$content = preg_replace( '/[\x80-\xff]{1,3}/', ' ', $content, -1, $n );
		$n += str_word_count($content);

		return $n;

	} else {

		return count( preg_split( '/\s+/', $content ) );

	}

}

/**
* Store the plugin version as an option.
*
* @since 	1.0.0
* @param	string	$WCWIZARD_V	The latest plugin version.
*/
function wcwizard_set_plugin_version($WCWIZARD_V) {

	update_option('WCWIZARD_V', $WCWIZARD_V);

}

/**
* Create the necessary table(s) for our plugin data.
*
* @since    1.0.0
*/
function wcwizard_create_plugin_tables() {

	require_once(ABSPATH.'wp-admin/includes/upgrade.php');

	global $wpdb;

	// Create database table
	$charset_collate = $wpdb->get_charset_collate();
	$table_name = $wpdb->prefix.'wcwizard_posts';

	$sql = "CREATE TABLE $table_name (
		post_id bigint(20) NOT NULL,
		post_author bigint(20) NOT NULL,
		post_date datetime NOT NULL,
		post_status varchar(20) NOT NULL,
		post_modified datetime NOT NULL,
		post_parent bigint(20) NOT NULL,
		post_type varchar(20) NOT NULL,
        post_category bigint(20) NOT NULL,
		post_word_count bigint(20) NOT NULL,
		UNIQUE KEY post_id (post_id)
	) $charset_collate;";
	dbDelta($sql);
}


add_action('admin_menu', 'test_button_menu');
function test_button_menu(){
  add_menu_page('Test Button Page', 'Test Button', 'manage_options', 'test-button-slug', 'test_button_admin_page');

}

function test_button_admin_page() {

  // This function creates the output for the admin page.
  // It also checks the value of the $_POST variable to see whether
  // there has been a form submission.

  // The check_admin_referer is a WordPress function that does some security
  // checking and is recommended good practice.

  // General check for user permissions.
  if (!current_user_can('manage_options'))  {
    wp_die( __('You do not have sufficient pilchards to access this page.')    );
  }

  // Start building the page

  echo '<div class="wrap">';

  echo '<h2>Test Button Demo</h2>';

  // Check whether the button has been pressed AND also check the nonce
  if (isset($_POST['test_button']) && check_admin_referer('test_button_clicked')) {
    // the button has been pressed AND we've passed the security check
    test_button_action();
  }

  echo '<form action="options-general.php?page=test-button-slug" method="post">';

  // this is a WordPress security feature - see: https://codex.wordpress.org/WordPress_Nonces
  wp_nonce_field('test_button_clicked');
  echo '<input type="hidden" value="true" name="test_button" />';
  submit_button('Call Function');
  echo '</form>';

  echo '</div>';

}

function formatData($table,$data){
    $formattedData = array();

    switch($table) {
        case "tc": case "ac":
        $wcwizard_counter_top_content = 0;
        foreach ($data as $index => $post) :
            //var_dump($post);
            if (!strpos($post['permalink'],'wpcf7_contact_form')) {
                $row = array(
                    'titulo' => $post['post_title'],
                    'tipo' => $post['post_type'],
                    'estado' => $post['post_status']=="Publish"?__('Published'):__('Draft'),
                    'autor' => $post['post_author'],
                    'categoria' => $post['post_category'],
                    'fecha' => $post['post_date_full'],
                    'numero_palabras' => $post['post_word_count'],
                    'enlace' => $post['permalink'],
                    );
                array_push($formattedData,$row);
                if ($table == "tc" && $wcwizard_counter_top_content == 19) break;
                $wcwizard_counter_top_content++;
            }
        endforeach;
        break;
        case "post":
        $wcwizard_counter_post_content = 0;
        foreach ($data as $index => $post) :
            if (!strpos($post['permalink'],'wpcf7_contact_form') && $post['post_type'] == __('Post')) {
                $row = array(
                    'titulo' => $post['post_title'],
                    'tipo' => $post['post_type'],
                    'estado' => $post['post_status']=="Publish"?__('Published'):__('Draft'),
                    'autor' => $post['post_author'],
                    'categoria' => $post['post_category'],
                    'fecha' => $post['post_date_full'],
                    'numero_palabras' => $post['post_word_count'],
                    'enlace' => $post['permalink'],
                    );
                array_push($formattedData,$row);
                $wcwizard_counter_post_content++;
            }
        endforeach;
        break;
        case "page":
        $wcwizard_counter_page_content = 0;
        foreach ($data as $index => $post) :
            if (!strpos($post['permalink'],'wpcf7_contact_form') && $post['post_type'] == __('Page')) {
                $row = array(
                    'titulo' => $post['post_title'],
                    'tipo' => $post['post_type'],
                    'estado' => $post['post_status']=="Publish"?__('Published'):__('Draft'),
                    'autor' => $post['post_author'],
                    'categoria' => $post['post_category'],
                    'fecha' => $post['post_date_full'],
                    'numero_palabras' => $post['post_word_count'],
                    'enlace' => $post['permalink'],
                    );
                array_push($formattedData,$row);
                $wcwizard_counter_page_content++;
            }
        endforeach;
        break;
    }
    return $formattedData;
}
