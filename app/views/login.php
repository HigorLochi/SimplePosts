<div id="main">
    <?php if(isset($error)): ?>
        <article class="post">
            <p><?= $error ?></p>
        </article>
    <?php endif; ?>
    <section class="post">
        <h3>Login</h3>
        <form method="post" action="#">
            <div class="row gtr-uniform">
                <div class="col-6 col-12-xsmall">
                    <input required type="email" name="email" id="email" value="" placeholder="Email" />
                </div>
                <div class="col-6 col-12-xsmall">
                    <input required type="password" name="password" id="password" placeholder="Password"  />
                </div>
                <div class="col-12">
                    <ul class="actions">
                        <li><input type="submit" value="Login" /></li>
                    </ul>
                </div>
            </div>
        </form>
    </section>
</div>