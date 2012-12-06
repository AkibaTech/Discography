<h1>{{template:title}}</h1>

<?php if (!empty($album)) : ?>

	<?php if ($tracks['entries'] > 0):  ?>

		<?php foreach ($tracks['entries'] as $item) : ?>

			<div>
				<h2><?php echo $item['title']; ?><h2>
					<p><?php echo $item['lyrics']; ?></p>
					<?php if (!empty($item['clip'])) : ?>
					<small><a href="<?php echo $item['clip']; ?>" title="Retrouvez le clip sur Youtube" alt="<?php echo $item['title']; ?>">Retrouvez le clip sur Youtube</a></small>
					<?php endif; ?>
			</div>

		<?php endforeach; ?>

	<?php else : ?>

		<p class="alert info">Cet album n'a aucune piste</p>

	<?php endif; ?>

<?php else : ?>

	<p class="alert info">Cet album n'existe pas</p>

<?php endif; ?>