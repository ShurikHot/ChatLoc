<?php
require_once '../vendor/db.php';

$users = mysqli_query($connect, "SELECT * FROM `members`");
?>
<!--<div class="card-body">-->

<?php if (!empty($users)): ?>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>ID</th>
            <th>Email</th>
            <th>Name</th>
            <th>Nickname</th>
            <th>Avatar</th>
            <!--<th width="50"><i class="fas fa-eye"></i></th>-->
            <th width="50"><i class="fas fa-pencil-alt"></i></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($users as $user): ?>
            <tr>
                <td><?= $user['id'] ?></td>
                <td><?= $user['email'] ?></td>
                <td><?= $user['name'] ?></td>
                <td><?= $user['nickname'] ?></td>
                <td><a href="<?= $user['avatar'] ?>"><?= $user['avatar'] ?></a></td>
                <!--<td>
                    <a class="btn btn-info btn-sm" href="<?/*= ADMIN */?>/user/view?id=<?/*= $user['id'] */?>">
                    <i class="fas fa-eye"></i>
                    </a>
                </td>-->
                <td>
                    <a class="btn btn-warning btn-sm" href="../../vendor/admin/admin_member_edit.php?id=<?= $user['id'] ?>">
                    <i class="fas fa-pencil-alt"></i>
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

    <!--<div class="row">
            <div class="col-md-12">
                <p><?/*= count($users) */?> пользователь(я/ей) из: <?/*= $total; */?></p>
                <?php /*if ($pagination->countPages > 1): */?>
                    <?/*= $pagination; */?>
                <?php /*endif; */?>
            </div>
        </div>-->

<?php else: ?>
    <p>Пользователей не найдено...</p>
<?php endif; ?>

<!--</div>-->
