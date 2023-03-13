<?php
require_once 'db.php';
require_once 'admin/params.php';
session_set_cookie_params($session_lifetime, '/');
session_start();

$result = mysqli_query($connect, "SELECT COUNT(*) as total FROM `messages`");
$row = mysqli_fetch_assoc($result);
$total_records = $row['total'];
$start = $total_records - 50;
$query = mysqli_query($connect,"SELECT * FROM `messages` LIMIT $start, $total_records");

if (mysqli_num_rows($query)>0) {
    while ($messagearr = mysqli_fetch_assoc($query)) {
        $mes_userid = $messagearr['user_id'];
        $query_user = mysqli_query($connect, "SELECT * FROM `members` WHERE `id` = $mes_userid");
        $name = mysqli_fetch_assoc($query_user);
        if (isset($name)) {
            ?>
            <div class="container">
                <img src="<?= $name['avatar'] ?>" alt="" class="avatar">
                <div class="mes_left">
                    <!--<p> <?/*= "User " . $name['nickname'] . " says: " . $messagearr['message'] */?> </p>-->
                    <p> <?php
                        echo "User ";
                        if ($_SESSION['user']['id']== '1') {
                            echo("<a href='vendor/admin/admin_member_edit.php?id=" . $name['id'] . "'>" . $name['nickname'] . "</a>" . " says: " . $messagearr['message']);
                        } else {
                            echo ($name['nickname'] . " says: " . $messagearr['message']);
                        }?> </p>
                </div>
                <?php
                if($_SESSION['user']['id']==$mes_userid || $_SESSION['user']['id']== '1') {
                    ?>
                    <div class="mes_right">
                        <a href="../vendor/messagedelete.php?id=<?= $messagearr['id'] ?>">
                            <img src="../assets/delete_icon.png" alt="" class="mess_icon">
                        </a>
                        <a href="../vendor/messageedit.php?id=<?= $messagearr['id'] ?>">
                            <img src="../assets/edit_icon.png" alt="" class="mess_icon">
                        </a>
                    </div>
                    <?php
                }
                ?>
                <!--<span class="time-right">11:00</span> date("g:i A") -->
            </div>

            <?php
        }
    }
}
?>