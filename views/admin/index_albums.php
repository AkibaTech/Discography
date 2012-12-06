<section class="title">
	<h4>Albums</h4>
</section>

<section class="item">
	
	<?php if ($albums['total'] > 0): ?>
	
		<table>
			<thead>
				<tr>
					<th>Album</th>
					<th>Publication</th>
					<th>Actions</th>
				</tr>
			</thead>
			<tfoot>
				<tr>
					<td colspan="5">
						<div class="inner"><?php echo $albums['pagination']; ?></div>
					</td>
				</tr>
			</tfoot>
			<tbody>
				<?php foreach ($albums['entries'] as $item): ?>
				<tr>
					<td><?php echo $item['name']; ?></td>
					<td><?php echo date('d\/m\/Y', $item['publication']); ?></td>
					<td class="actions">
						<?php echo
						anchor('admin/discography/albums/edit/'.$item['id'], 'Modifier', 'class="button"').' '.
						anchor('admin/discography/albums/delete/'.$item['id'], 'Supprimer', array('class'=>'button')); ?>
					</td>
				</tr>
				<?php endforeach; ?>
			</tbody>
		</table>

	<?php else: ?>
		<div class="no_data">Pas d'album</div>
	<?php endif;?>
	
</section>