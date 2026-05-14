<div id="main">
    <article class="post">
        <header>
            <div class="title">
                <h2><a><?= protectedVariableText($post->getTitle()) ?></a></h2>
            </div>
            <div class="meta">
                <time class="published"><?= protectedVariableText($post->getCreatedAt()) ?></time>
                <a class="author"><span class="name"><?= protectedVariableText(limitText($post->get('name'), 10)) ?></span><img src="<?= $photoPath . $post->get('userphoto'); ?>" alt="" /></a>
            </div>
        </header>
        <span class="image featured"><img src="<?= $imagePath . $post->get('postimage'); ?>" alt="" /></span>
        <p><?= protectedVariableText($post->getText()) ?></p>
    </article>
</div>