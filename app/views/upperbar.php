<header id="header">
    <h1><a href="index.php">Simple Posts</a></h1>
    <nav class="links">
        <ul>
            <li>
                <a href="index.php?<?= http_build_query(['controller' => 'post', 'action' => 'list']) ?>">Posts</a>
            </li>
            <?php if($this->session->get('user_admin')): ?>
                <li>
                    <a href="index.php?<?= http_build_query(['controller' => 'user', 'action' => 'list']) ?>">Users</a>
                </li>
            <?php endif; ?>
            <li>
                <a class="author" href="index.php?<?= http_build_query(['controller' => 'user', 'action' => 'update', 'id' => $this->session->get('user_id')]) ?>">
                    <?= $this->session->get('user_name') ?>
                    <!-- <img src="app/views/images/avatar.jpg" alt="" /> -->
                </a>
            </li>
            <li>
                <a href="index.php?<?= http_build_query(['logout' => 1]) ?>">Log out</a>
            </li>
        </ul>
    </nav>
</header>