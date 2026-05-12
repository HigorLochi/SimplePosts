<div id="main">
    <article class="post">
        <header>
            <div class="title">
                <h2><a><?= protectedVariableText($post->getTitle()) ?></a></h2>
            </div>
            <div class="meta">
                <time class="published" datetime="2015-11-01"><?= protectedVariableText($post->getCreatedAt()) ?></time>
                <a class="author"><span class="name"><?= protectedVariableText(limitText($post->get('name'), 10)) ?></span><img src="../storage/userphotos/test.png" alt="" /></a>
            </div>
        </header>
        <span class="image featured"><img src="../storage/postimages/test.jpg" alt="" /></span>
        <p><?= protectedVariableText($post->getText()) ?></p>
    </article>
</div>