<header id="header">
    <h1><a href="index.html">Future Imperfect</a></h1>
    <nav class="links">
        <ul>
            <li>
                <a href="index.php?<?= http_build_query(['controller' => 'post', 'action' => 'list']) ?>">Posts</a>
            </li>
            <li>
                <a href="index.php?<?= http_build_query(['controller' => 'user', 'action' => 'list']) ?>">Users</a>
            </li>
            <li>
                <a href="index.php?<?= http_build_query(['controller' => 'user', 'action' => 'update', 'id' => $session->get('id_user')]) ?>">Profile</a>
            </li>
            <li>
                <a href="index.php?<?= http_build_query(['logout' => 1]) ?>">Log out</a>
            </li>
        </ul>
    </nav>
</header>