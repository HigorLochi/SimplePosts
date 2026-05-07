<div id="main">
    <section>
        <h3>Users</h3>
        <section>
            <ul class="actions stacked">
                <li><a href="index.php?<?= http_build_query(['controller' => 'user', 'action' => 'insert']) ?>" class="button large next">Add user</a></li>
            </ul>
        </section>
        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>E-mail</th>
                        <th>Role</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($rows as $row): ?>
                        <tr>
                            <td><?= protectedVariableText($row->getId()) ?></td>
                            <td><?= protectedVariableText($row->getName()) ?></td>
                            <td><?= protectedVariableText($row->getEmail()) ?></td>
                            <td><?= protectedVariableText($row->isAdmin()) ?></td>
                            <td>
                                <a class="icon solid fa-edit" href="index.php?<?= http_build_query(['controller' => 'user', 'action' => 'update', 'id' => protectedVariableText($row->getId())]) ?>">
                                    <span class="label">Edit</span>
                                </a>
                            </td>
                            <td>
                                <a class="icon solid fa-trash" onclick="deleteUser(<?= protectedVariableText($row->getId()); ?>)">
                                    <span class="label">Delete</span>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
            </table>
        </div>
    </section>
    <?php require __DIR__ . '../../pagination.php'; ?>
</div>
<script src="../app/views/js/user/deleteuser.js"></script>