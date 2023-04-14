<?php if (isset ($data['members'])): ?>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>ID</th>
            <th>Email</th>
            <th>Name</th>
            <th>Nickname</th>
            <th>Avatar</th>
            <th width="50"><i class="fas fa-pencil-alt"></i></th>
            <th width="50"><i class="fas fa-user-lock"></i></th>
            <th width="50"><i class="fas fa-user-slash"></i></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($data['members'] as $key => $value) : ?>
            <tr>
                <td><?= $key ?></td>
                <td><?= $value['email'] ?></td>
                <td><?= $value['name'] ?></td>
                <td><?= $value['nickname'] ?></td>
                <td><a href="<?= $value['avatar'] ?>"><?= $value['avatar'] ?></a></td>
                <td>
                    <a class="btn btn-warning btn-sm" href="/admin/content?memberedit=<?= $key ?>">
                        <i class="fas fa-pencil-alt"></i>
                    </a>
                </td>
                <td>
                    <?php if ($value['blocked']): ?>
                        <a class="btn btn-warning btn-sm" href="/admin/memberblock?<?= $data['current_page'] ?>=<?= $key ?>">
                            <i class="fas fa-user-lock"></i></a>
                    <?php else: ?>
                        <a class="btn btn-sm" href="/admin/memberblock?<?= $data['current_page'] ?>=<?= $key ?>">
                            <i class="fas fa-crosshairs"></i></a>
                    <?php endif; ?>
                </td>
                <td>
                    <a class="btn btn-sm" href="/admin/memberdel?<?= $data['current_page'] ?>=<?= $key ?>">
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
    <p>Members not found...</p>
<?php endif; ?>