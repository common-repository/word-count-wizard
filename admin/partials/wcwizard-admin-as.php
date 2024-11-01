<?php

/**
 * Display author stats in plugin's admin area.
 *
 * @link       https://www.word-count-wizard.com
 * @since      1.0.0
 *
 * @package    wcwizard
 * @subpackage wcwizard/admin/partials
 */
?>
<table class="widefat">
	<thead>
		<tr>
			<th rowspan="2"><?php _e('Author', $this->plugin_name); ?></th>
			<th rowspan="2"><?php _e('Words', $this->plugin_name); ?></th>
			<?php foreach ($arr_wcwizard_post_types as $index => $post_type) : ?>
			<th colspan="2" class="wcwizard-post-type"><?php echo $post_type['plural_name']; ?></th>
			<?php endforeach; ?>
		</tr>
		
		<tr>
			<?php foreach ($arr_wcwizard_post_types as $index => $post_type) : ?>
			<th><?php _e('Published', $this->plugin_name); ?></th>
			<th><?php _e('Draft', $this->plugin_name); ?></th>
			<?php endforeach; ?>
		</tr>
	</thead>
	
	<tbody>
		<?php $wcwizard_counter_author_statistics = 0; ?>
		<?php foreach ($arr_wcwizard_authors as $index => $author) : ?>
		
		<?php echo '<tr'.($wcwizard_counter_author_statistics % 2 == 1 ? "" : " class='alternate'").'>'; ?>
			<td><?php echo $author['display_name']; ?></td>
			<td><?php echo number_format($author['total']); ?></td>
			<?php foreach ($arr_wcwizard_post_types as $index => $post_type) : ?>
			<td>
				<?php if (isset($author[$index]['posts']['publish'])) { echo number_format(0 + $author[$index]['posts']['publish']); } else { echo '0'; } ?> Total<br />
				<?php if (isset($author[$index]['word_counts']['publish'])) { echo number_format(0 + $author[$index]['word_counts']['publish']); } else { echo '0'; } ?> <?php _e('Words', $this->plugin_name); ?><br />
				<?php if (isset($author[$index]['posts']['publish']) && $author[$index]['posts']['publish'] != 0) : ?>
				<?php echo number_format(round(0 + ($author[$index]['word_counts']['publish'] / $author[$index]['posts']['publish']))); ?> <?php _e('Avg.', $this->plugin_name); ?>
				<?php endif; ?>
			</td>
			<td>
				<?php if (isset($author[$index]['posts']['draft'])) { echo number_format(0 + $author[$index]['posts']['draft']); } else { echo '0'; } ?> Total<br />
				<?php if (isset($author[$index]['word_counts']['draft'])) { echo number_format(0 + $author[$index]['word_counts']['draft']); } else { echo '0'; } ?> <?php _e('Words', $this->plugin_name); ?><br />
				<?php if (isset($author[$index]['posts']['draft']) && $author[$index]['posts']['draft'] != 0) : ?>
				<?php echo number_format(round(0 + ($author[$index]['word_counts']['draft'] / $author[$index]['posts']['draft']))); ?> <?php _e('Avg.', $this->plugin_name); ?>
				<?php endif; ?>
			</td>
			<?php endforeach; ?>
		</tr>
		
		<?php $wcwizard_counter_author_statistics++; ?>
		<?php endforeach; ?>
	</tbody>
</table>