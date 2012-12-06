<h1>{{template:title}}</h1>

<?php if ($albums['total'] > 0) : ?>

	<?php foreach ($albums['entries'] as $item) : ?>

		<div>
			<h2><?php echo $item['name']; ?></h2>
			<p><?php echo $item['description']; ?></p>
		</div>

	<?php endforeach; ?>

<?php else : ?>

	<p class="alert info">Aucun album</p>

<?php endif; ?>