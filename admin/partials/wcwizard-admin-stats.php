<?php

/**
 * Display main word stats at the top of the plugin's admin area.
 *
 * @link       https://www.word-count-wizard.com
 * @since      1.0.0
 *
 * @package    wcwizard
 * @subpackage wcwizard/admin/partials
 */
?>
<div class="wcwizard-main-stats">
	<div>
		<h3><?php _e('Published Texts', $this->plugin_name); ?></h3>
		<table class="widefat resumen">
			<tbody>
			<?php $wcwizard_counter_post_types = 0; ?>
			<?php foreach ($arr_wcwizard_post_types_default as $default) : ?>
			<?php 
			switch ($default):
				case "post": $content = __("%s words <br /><small>in %s published posts</small>", $this->plugin_name); break;
				case "page": $content = __("%s words <br /><small>in %s published pages</small>", $this->plugin_name); break;
			endswitch; 
			?>
				<tr>
					<td>
						<?php echo sprintf($content,@number_format(0 + $arr_wcwizard_post_types[$default]['word_counts']['publish']),@number_format(0 + $arr_wcwizard_post_types[$default]['posts']['publish'])); ?>
					</td>
				</tr>
			<?php endforeach; ?>
			</tbody>
		</table>
	</div>
	<div>
		<h3><?php _e('Draft Texts', $this->plugin_name); ?></h3>
		<table class="widefat resumen">
			<tbody>
			<?php $wcwizard_counter_post_types = 0; ?>
			<?php foreach ($arr_wcwizard_post_types_default as $default) : ?>
			<?php 
			switch ($default):
				case "post": $content = __("%s words <br /><small>in %s unpublished posts</small>", $this->plugin_name); break;
				case "page": $content = __("%s words <br /><small>in %s unpublished pages</small>", $this->plugin_name); break;
			endswitch; 
			?>
				<tr>
					<td>
						<?php echo sprintf($content,@number_format(0 + $arr_wcwizard_post_types[$default]['word_counts']['draft']),@number_format(0 + $arr_wcwizard_post_types[$default]['posts']['draft'])); ?>
					</td>
				</tr>
			<?php endforeach; ?>
			</tbody>
		</table>
	</div>
</div>