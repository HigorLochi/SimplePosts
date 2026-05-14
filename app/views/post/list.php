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
					<h2><a href="index.php?<?= http_build_query(['controller' => 'post', 'action' => 'single', 'id' => $row->getId()]) ?>"><?= protectedVariableText($row->getTitle()) ?></a></h2>
				</div>
				<div class="meta">
					<time class="published" datetime="2015-11-01"><?= protectedVariableText($row->getCreatedAt()) ?></time>
					<a href="#" class="author"><span class="name"><?= protectedVariableText(limitText($row->get('name'), 10)) ?></span><img src="<?= $photoPath . $row->get('userphoto'); ?>" alt="" /></a>
				</div>
			</header>
			<a class="image featured"><img src="<?= $imagePath . $row->get('postimage'); ?>" alt="" /></a>
			<p><?= protectedVariableText(limitText($row->getText(), 550)) ?></p>
			<footer>
				<ul class="actions">
					<li><a href="index.php?<?= http_build_query(['controller' => 'post', 'action' => 'single', 'id' => $row->getId()]) ?>" class="button large">Continue Reading</a></li>
				</ul>
				<?php if($sessionInfo['user_admin']): ?>
					<ul class="stats">
						<li><a onclick="deletePost(<?= protectedVariableText($row->getId()); ?>)" class="icon solid fa-trash">Delete post</a></li>
					</ul>
				<?php endif; ?>
			</footer>
		</article>
	<?php endforeach; ?>

	<?php require __DIR__ . '../../pagination.php'; ?>
</div>
<script src="../app/views/js/post/delete.js"></script>