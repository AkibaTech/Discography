<section class="title">
	<h4>Pistes</h4>
</section>

<section class="item">
	
	<?php if ($tracks['total'] > 0): ?>
	
		<table>
			<thead>
				<tr>
					<th>Album</th>
					<th>Numéro</th>
					<th>Piste</th>
					<th>Actions</th>
				</tr>
			</thead>
			<tfoot>
				<tr>
					<td colspan="6">
						<div class="inner"><?php echo $tracks['pagination']; ?></div>
					</td>
				</tr>
			</tfoot>
			<tbody>
				<?php foreach ($tracks['entries'] as $item): ?>
				<tr>
					<td><?php echo $item['album']['name']; ?></td>
					<td><?php echo $item['number']; ?></td>
					<td><?php echo $item['title']; ?></td>
					<td class="actions">
						<?php echo
						anchor('admin/discography/tracks/edit/'.$item['id'], 'Modifier', 'class="button"').' '.
						anchor('admin/discography/tracks/delete/'.$item['id'], 'Supprimer', array('class'=>'button')); ?>
					</td>
				</tr>
				<?php endforeach; ?>
			</tbody>
		</table>

	<?php else: ?>
		<div class="no_data">Pas de piste</div>
	<?php endif;?>
	
</section>