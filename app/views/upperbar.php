<header id="header">
    <h1><a href="index.php">Simple Posts</a></h1>
    <nav class="links">
        <ul>
            <li>
                <a href="index.php?<?= http_build_query(['controller' => 'post', 'action' => 'list']) ?>">Posts</a>
            </li>
            <?php if($sessionInfo['user_admin']): ?>
                <li>
                    <a href="index.php?<?= http_build_query(['controller' => 'user', 'action' => 'list']) ?>">Users</a>
                </li>
            <?php endif; ?>
            <li>
                <a class="author" href="index.php?<?= http_build_query(['controller' => 'user', 'action' => 'update', 'id' => $sessionInfo['user_id']]) ?>">
                    <?= $sessionInfo['user_name'] ?>
                    <!-- <img src="app/views/images/avatar.jpg" alt="" /> -->
                </a>
            </li>
            <li>
                <a href="index.php?<?= http_build_query(['controller' => 'auth', 'action' => 'logout']) ?>">Log out</a>
            </li>
        </ul>
    </nav>
</header>