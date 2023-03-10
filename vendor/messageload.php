<?php
session_start();
require_once 'db.php';

$query = mysqli_query($connect,"SELECT * FROM `messages`"); /* ORDER BY `id` DESC LIMIT 20 */

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
<!--<div class="container darker">
    <img src="/w3images/avatar_g2.jpg" alt="Avatar" class="right">
    <p>Hey! I'm fine. Thanks for asking!</p>
    <span class="time-left">11:01</span>
</div>
-->