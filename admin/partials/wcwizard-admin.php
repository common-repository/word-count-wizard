<?php

/**
 * Provide an admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://www.word-count-wizard.com
 * @since      1.0.0
 *
 * @package    wcwizard
 * @subpackage wcwizard/admin/partials
 */
?>
<div id="wcwizard" class="wrap">
	<?php include_once('wcwizard-menu.php'); ?>
    
	
	<?php
	//crear la cabecera de las tablas
	$cabecera = array(

		__('Title', $this->plugin_name),
		__('Type', $this->plugin_name),
		__('Status', $this->plugin_name),
		__('Author', $this->plugin_name),
		__('Category', $this->plugin_name),
		__('Date', $this->plugin_name),
		__('Words', $this->plugin_name),
		//__('Link', $this->plugin_name),
	);
	//crear el array que contendrá el resultado
	$arrayContenido = array(
		"cabecera" => $cabecera,
		"cuerpo" => array());
		?>
	<div id="wcwizard-tabs">
		<ul>
			<!-- <li><a href="#wcwizard-top-content" class="nav-tab nav-tab-active"><?php _e('Top Content', $this->plugin_name); ?></a></li> -->
			<li><a href="#wcwizard-all-content" class="nav-tab nav-tab-active"><?php _e('All Content', $this->plugin_name); ?></a></li>
			<li><a href="#wcwizard-post-content" class="nav-tab"><?php _e('Posts', $this->plugin_name); ?></a></li>
			<li><a href="#wcwizard-page-content" class="nav-tab"><?php _e('Pages', $this->plugin_name); ?></a></li>
			<li><a href="#wcwizard-monthly-statistics" class="nav-tab"><?php _e('Monthly Statistics', $this->plugin_name); ?></a></li>
			<li><a href="#wcwizard-author-statistics" class="nav-tab"><?php _e('Author Statistics', $this->plugin_name); ?></a></li>
			<li><a href="#wcwizard-category-statistics" class="nav-tab"><?php _e('Category Statistics', $this->plugin_name); ?></a></li>
		</ul>

		<!-- <div id="wcwizard-top-content">
			<?php include_once('wcwizard-admin-tc.php'); ?>
		</div> -->

		<div id="wcwizard-all-content">
			<?php include_once('wcwizard-admin-ac.php'); ?>
		</div>

		<div id="wcwizard-post-content">
			<?php include_once('wcwizard-admin-post.php'); ?>
		</div>

		<div id="wcwizard-page-content">
			<?php include_once('wcwizard-admin-page.php'); ?>
		</div>

		<div id="wcwizard-monthly-statistics">
			<?php include_once('wcwizard-admin-ms.php'); ?>
		</div>

		<div id="wcwizard-author-statistics">
			<?php include_once('wcwizard-admin-as.php'); ?>
		</div>

		<div id="wcwizard-category-statistics">
			<?php include_once('wcwizard-admin-cs.php'); ?>
		</div>
	</div>
	
</div>
<div class="copyright">
	Copyright 2017. <a href="https://www.word-count-wizard.com">www.word-count-wizard.com</a>
	</div>
