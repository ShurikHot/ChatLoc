<?php if (isset ($data['chats'])): ?>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>ID</th>
            <th>Chat name</th>
            <th>Author</th>
            <th width="50"><i class="fas fa-times"></i></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($data['chats'] as $key => $value) : ?>
            ?>
            <tr>
                <td><?= $key ?></td>
                <td><?= $value['chat_name'] ?></td>
                <td>
                    <a class="" href="../../vendor/admin/admin_member_edit.php?id=<?= $value['author_id'] ?>"> <?= $value['nickname'] ?></a>
                </td>
                <td>
                    <a class="btn btn-sm" href="../vendor/admin/admin_chats.php?delid=<?= $key ?>">
                        <i class="fas fa-times"></i></a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php
    require_once 'app/views/admin/pages/pagination.php'
?>

<?php else: ?>
    <p>No chats yet...</p>
<?php endif; ?>