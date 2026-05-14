<div id="main">
    <?php if(isset($message)): ?>
        <article class="post">
            <p><?= $message ?></p>
        </article>
    <?php endif; ?>
    <section class="post">
        <h3>Post form</h3>
        <form enctype="multipart/form-data" method="post" action="#">
            <div class="row gtr-uniform">
                <div class="col-2 col-12-xsmall">
                    <input required onchange="showImage(this)" type="file" name="image" id="image" value="" placeholder="Title" />
                </div>
                <div class="col-10 col-12-xsmall">
                    <span class="image featured"><img style="display:none" id="post-image" alt="" /></span>
                </div>
                <div class="col-12 col-12-xsmall">
                    <input required type="text" name="title" id="title" value="" placeholder="Title" />
                </div>
                <div class="col-12">
                    <textarea required name="text" id="text" placeholder="Enter your text" maxlength="10000" rows="10"></textarea>
                </div>
                <div class="col-12">
                    <ul class="actions">
                        <li><input type="submit" value="Save"></li>
                        <li><a href="index.php?<?= http_build_query(['controller' => 'post', 'action' => 'list']) ?>" class="button next">Cancel</a></li>
                    </ul>
                </div>
            </div>
        </form>
    </section>
</div>
<script src="../app/views/js/post/showImage.js"></script>