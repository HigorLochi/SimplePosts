<div id="main">
	<section>
		<ul class="actions stacked">
			<li><a href="index.php?<?= http_build_query(['controller' => 'post', 'action' => 'insert']) ?>" class="button large next">Publish</a></li>
		</ul>
	</section>
	<?php foreach($rows as $row): ?>
		<article class="post">
			<header>
				<div class="title">
					<h2><a href="single.html"><?= protectedVariableText($row->getTitle()) ?></a></h2>
				</div>
				<div class="meta">
					<time class="published" datetime="2015-11-01"><?= protectedVariableText($row->getCreatedAt()) ?></time>
					<a href="#" class="author"><span class="name">Jane Doe</span><img src="../storage/userphotos/test.png" alt="" /></a>
				</div>
			</header>
			<a class="image featured"><img src="../storage/postimages/test.jpg" alt="" /></a>
			<p><?= protectedVariableText($row->getText()) ?></p>
			<footer>
				<ul class="actions">
					<li><a href="single.html" class="button large">Continue Reading</a></li>
				</ul>
			</footer>
		</article>
	<?php endforeach; ?>

	<?php require __DIR__ . '../../pagination.php'; ?>
</div>
		