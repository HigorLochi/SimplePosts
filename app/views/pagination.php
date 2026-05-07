<?php if(sizeof($rows) > 0): ?>
    <ul class="actions pagination">
        <?php if($page != 1): ?>
            <li>
                <a href="index.php?<?= http_build_query(array_merge($_GET, ['page' => $page - 1])) ?>" class="button large previous">Previous Page</a>
            </li>
        <?php endif; ?>
        <?php if($page != $pagesCount): ?>
            <li>
                <a href="index.php?<?= http_build_query(array_merge($_GET, ['page' => $page + 1])) ?>" class="button large next">Next Page</a>
            </li>
        <?php endif; ?>
    </ul>
<?php endif; ?>