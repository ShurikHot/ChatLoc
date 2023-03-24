<?php
require_once 'db.php';
require_once 'admin/params.php';

ini_set('session.gc_maxlifetime', $session_lifetime);
ini_set('session.gc_probability', 1);
ini_set('session.gc_divisor', 1);
session_start();

$chat_id = $_POST['chat_id'];

echo ('<div align="center"><b>' . $_SESSION['user']['lang_text']['online_users'] . '</b></div>');
echo ('<ul class="" style="list-style-type: none;">');
$query_id = mysqli_query($connect, "SELECT DISTINCT `user_id` FROM `messages` WHERE `chat_id` = $chat_id");
if (mysqli_num_rows($query_id)>0) {
    while ($member_id = mysqli_fetch_assoc($query_id)) {
        $id = $member_id['user_id'];
        $query_online = mysqli_query($connect, "SELECT `id`, `nickname`, `last_visit` FROM `members` WHERE `id` = $id");
        if (mysqli_num_rows($query_online)>0) {
            $member = mysqli_fetch_assoc($query_online);
            if ($member['last_visit'] >= (date('Y-m-d H:i:s', strtotime(date('Y-m-d H:i:s') . ' -5 minutes')))) {
                echo("<a href='vendor/contactprofile.php?id=" . $id . "'>
                                        <li class='justify-content-between align-items-center'>" . $member['nickname'] .
                    "</a>&nbsp;
                                        <span class='badge bg-primary rounded-pill'>ONLINE</span>
                                        </li>"
                );
            }
        }
    }
}
echo "</ul>";