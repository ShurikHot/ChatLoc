<?php
require_once 'db.php';
require_once 'admin/params.php';

ini_set('session.gc_maxlifetime', $session_lifetime);
ini_set('session.gc_probability', 1);
ini_set('session.gc_divisor', 1);
session_start();

$chat_id = $_POST['chat_id'];

$result = mysqli_query($connect, "SELECT COUNT(`id`) as total FROM `messages` WHERE `chat_id` = $chat_id");
$row = mysqli_fetch_assoc($result);
$total_records = $row['total'];
if ($total_records > 50) {
    $start = $total_records - 50;
    $query = mysqli_query($connect,"SELECT * FROM `messages` WHERE `chat_id` = $chat_id LIMIT $start, $total_records");
} else {
    $query = mysqli_query($connect,"SELECT * FROM `messages` WHERE `chat_id` = $chat_id");
}

if (mysqli_num_rows($query)>0) {
    while ($messagearr = mysqli_fetch_assoc($query)) {
        $mes_userid = $messagearr['user_id'];
        $query_user = mysqli_query($connect, "SELECT `id`, `nickname`, `avatar` FROM `members` WHERE `id` = $mes_userid");
        $name = mysqli_fetch_assoc($query_user);
        if (isset($name)) :
            ?>
            <div class="container">
                <img src="<?= $name['avatar'] ?>" alt="" class="avatar">
                <div class="mes_left">
                    <p>
                        <?php
                            echo "User ";
                            if ($mes_userid == $_SESSION['user']['id']) {
                                echo ("<a href='../profile.php' target='_blank'>");
                            } elseif ($_SESSION['user']['id']== '1') {
                                echo("<a href='vendor/admin/admin_member_edit.php?id=" . $name['id'] . "' target='_blank'>");
                            } else {
                                echo("<a href='vendor/contactprofile.php?id=" . $name['id'] . "' target='_blank'>");
                            }
                            echo($name['nickname'] . "</a>" . " says: " . $messagearr['message']);
                        ?>
                    </p>
                </div>
                <?php
                    if($_SESSION['user']['id']==$mes_userid || $_SESSION['user']['id']== '1') :
                ?>
                    <div class="mes_right">
                        <a href="../vendor/messagedelete.php?id=<?= $messagearr['id'] ?>&chat_id=<?= $chat_id ?>">
                            <img src="../assets/delete_icon.png" alt="" class="mess_icon">
                        </a>
                        <a href="../vendor/messageedit.php?id=<?= $messagearr['id'] ?>&chat_id=<?= $chat_id ?>">
                            <img src="../assets/edit_icon.png" alt="" class="mess_icon">
                        </a>
                    </div>
                <?php
                    endif;
                ?>
            </div>
            <?php
        endif;
    }
}
?>