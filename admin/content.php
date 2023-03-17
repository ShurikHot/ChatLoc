<?php
require_once '../vendor/db.php';

$records_per_page = 10;
$current_page = isset($_GET['page']) ? $_GET['page'] : 1;
$_SESSION['user']['page_get'] = $current_page;
$start = ($current_page - 1) * $records_per_page;
$users = mysqli_query($connect, "SELECT * FROM `members` LIMIT $start, $records_per_page");
?>

<?php if (mysqli_num_rows($users)>0): ?>
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
        <?php foreach ($users as $user): ?>
            <tr>
                <td><?= $user['id'] ?></td>
                <td><?= $user['email'] ?></td>
                <td><?= $user['name'] ?></td>
                <td><?= $user['nickname'] ?></td>
                <td><a href="<?= $user['avatar'] ?>"><?= $user['avatar'] ?></a></td>
                <td>
                    <a class="btn btn-warning btn-sm" href="../../vendor/admin/admin_member_edit.php?id=<?= $user['id'] ?>">
                        <i class="fas fa-pencil-alt"></i>
                    </a>
                </td>
                <td>
                    <?php if ($user['blocked']): ?>
                        <a class="btn btn-warning btn-sm" href="../../vendor/admin/admin_member_edit.php?lockid=<?= $user['id'] ?>">
                            <i class="fas fa-user-lock"></i></a>
                    <?php else: ?>
                        <a class="btn btn-sm" href="../../vendor/admin/admin_member_edit.php?lockid=<?= $user['id'] ?>">
                            <i class="fas fa-crosshairs"></i></a>
                    <?php endif; ?>
                </td>
                <td>
                    <a class="btn btn-sm" href="../../vendor/admin/admin_member_edit.php?delid=<?= $user['id'] ?>">
                        <i class="fas fa-times"></i></a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php
    $result = mysqli_query($connect, "SELECT COUNT(*) as total FROM `members`");
    $row = mysqli_fetch_assoc($result);
    $total_records = $row['total'];
    $total_pages = ceil($total_records / $records_per_page);

    $back = null;
    $forward = null;
    $startpage = null;
    $endpage = null;
    $page2left = null;
    $page1left = null;
    $page2right = null;
    $page1right = null;

    // $back
    if ($current_page > 1) {
        $back = "<li class='page-item'><a class='page-link' href='?page=" . $current_page - 1 . "'>&lt;</a></li>";
    }
    // $forward
    if ($current_page < $total_pages) {
        $forward = "<li class='page-item'><a class='page-link' href='?page=" . $current_page + 1 . "'>&gt;</a></li>";
    }
    // $startpage
    if ($current_page > 3) {
        $startpage = "<li class='page-item'><a class='page-link' href='?page=" . "1" . "'>&laquo;</a></li>";
    }
    // $endpage
    if ($current_page < ($total_pages - 2)) {
        $endpage = "<li class='page-item'><a class='page-link' href='?page=" . $total_pages . "'>&raquo;</a></li>";
    }
    // $page2left
    if ($current_page - 2 > 0) {
        $page2left = "<li class='page-item'><a class='page-link' href='?page=" . $current_page - 2 . "'>" . $current_page - 2 . "</a></li>";
    }
    // $page1left
    if ($current_page - 1 > 0) {
        $page1left = "<li class='page-item'><a class='page-link' href='?page=" . $current_page - 1 . "'>" . $current_page - 1 . "</a></li>";
    }
    // $page1right
    if ($current_page + 1 <= $total_pages) {
        $page1right = "<li class='page-item'><a class='page-link' href='?page=" . $current_page + 1 . "'>" . $current_page + 1 . "</a></li>";
    }
    // $page2right
    if ($current_page + 2 <= $total_pages) {
        $page2right = "<li class='page-item'><a class='page-link' href='?page=" . $current_page + 2 . "'>" . $current_page + 2 . "</a></li>";
    }
    if ($total_pages > 1) echo ('<nav aria-label="Page navigation"><ul class="pagination">' . $startpage . $back . $page2left . $page1left .
        '<li class="page-item active"><a class="page-link">' . $current_page . '</a></li>' . $page1right . $page2right . $forward . $endpage . '</ul></nav>');
?>

<?php else: ?>
    <p>Members not found...</p>
<?php endif; ?>