<?php

/**
 * Display all content stats in plugin's admin area.
 *
 * @link       https://www.word-count-wizard.com
 * @since      1.0.0
 *
 * @package    wcwizard
 * @subpackage wcwizard/admin/partials
 */


$listaPosts = formatData('post',$arr_wcwizard_posts);
$arrayContenido['contenido'] = $listaPosts;
global $current_user;
get_currentuserinfo();
?>
<table class="widefat">
	<thead>
		<?php foreach($arrayContenido['cabecera'] as $v) {
			?>
			<th class="wcwizard-words"><?php echo $v ?></th>
			<?php
		}
		?>
	</thead>

	<tbody>
		<?php $wcwizard_counter_top_content = 0; ?>
		<?php $nwords = 0; ?>
		<?php foreach ($arrayContenido['contenido'] as $k => $post) : ?>

		<?php echo '<tr'.($index % 2 == 1 ? "" : " class='alternate'").'>'; ?>

			<td><a href="<?php echo $post['enlace']; ?>"><?php echo $post['titulo']; ?></a></td>
			<td><?php echo $post['tipo']; ?></td>
			<td><?php echo $post['estado']; ?></td>
			<td><?php echo $post['autor']; ?></td>
			<td><?php echo $post['categoria']; ?></td>
        			<td><?php echo $post['fecha']; ?></td>
			<td><?php echo number_format($post['numero_palabras']); ?></td>
		</tr>
		<?php $nwords+=$post['numero_palabras'];?>
		<?php endforeach; ?>
		<tr class="<?php echo ($index % 2 == 1 ? "" : " alternate")." total"; ?>">
			<td colspan="5"></td>
			<td><?php _e('TOTAL', $this->plugin_name) ?></td>
			<td><?php echo number_format($nwords); ?></td>
		</tr>
	</tbody>
</table>

