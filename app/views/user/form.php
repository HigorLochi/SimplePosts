<div id="main">
    <?php if(isset($message)): ?>
        <article class="post">
            <p><?= $message ?></p>
        </article>
    <?php endif; ?>
    <section class="post">
        <h3>User form</h3>
        <form enctype="multipart/form-data" method="post" action="#">
            <div class="row gtr-uniform">
                <div class="col-2 col-12-xsmall">
                    <input onchange="showPhoto(this)" type="file" name="photo" id="photo" value="" placeholder="Title" />
                </div>
                <div class="col-10 col-12-xsmall">
                    <span class="author"><img style="display:none" id="user-photo" alt="" /></span>
                </div>
                <div class="col-12 col-12-xsmall">
                    <input required type="text" name="name" id="name" value="<?= $user->getName() ?>" placeholder="Name" />
                </div>
                <div class="col-6 col-12-xsmall">
                    <input required type="text" name="email" id="email" value="<?= $user->getEmail() ?>" placeholder="E-mail" />
                </div>
                <?php if($sessionInfo['user_admin'] && !$user->getId()): ?>
                    <div class="col-6 col-12-xsmall">
                        <input required type="password" name="password" id="password" value="" placeholder="Password" />
                    </div>
                <?php endif; ?>
                <?php if($sessionInfo['user_admin']): ?>
                    <div class="col-12 col-12-small">
                        <input type="checkbox" <?= ($user->isAdmin()) ? "checked" : "" ?> id="isadmin" name="isadmin">
                        <label for="isadmin">Admin</label>
                    </div>
                <?php endif; ?>
                <div class="col-12">
                    <ul class="actions">
                        <li><input type="submit" / value="Save"></li>
                        <li><a href="index.php?<?= http_build_query(['controller' => 'user', 'action' => 'list']) ?>" class="button next">Cancel</a></li>
                    </ul>
                </div>
            </div>
        </form>
    </section>
</div>
<script src="../app/views/js/user/showPhoto.js"></script>