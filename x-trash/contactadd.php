<?php
/*require_once 'app/config/db.php';
require_once 'app/config/params.php';

ini_set('session.gc_maxlifetime', $session_lifetime);
ini_set('session.gc_probability', 1);
ini_set('session.gc_divisor', 1);
session_start();*/

/*if (isset($_GET['id']) & is_numeric($_GET['id'])) {
    $id = $_GET['id'];
    $user_id = $_SESSION['user']['id'];
    $query = mysqli_query($connect,"SELECT `id` FROM `members` WHERE `id` = $id");
    $query2 = mysqli_query($connect,"SELECT `id` FROM `contacts` WHERE `user_id` = '$user_id' AND `contact_id` = '$id'");
    if (mysqli_num_rows($query) > 0 && mysqli_num_rows($query2) == 0) {
        $query_add = mysqli_query($connect,"INSERT INTO `contacts` (`user_id`, `contact_id`) VALUES ('$user_id', '$id')");
        $mess = $_SESSION['user']['lang_text']['your_nickname'] . $_SESSION['user']['nickname'] . $_SESSION['user']['lang_text']['added_you'];
        $approve_mess = mysqli_query($connect, "INSERT INTO `personal_messages` (`from_id`, `to_id`, `message`) VALUES ('$user_id', '$id', '$mess')");
    }
}*/

/*if (isset($_GET['delid']) & is_numeric($_GET['delid'])) {
    $id = $_GET['delid'];
    $user_id = $_SESSION['user']['id'];
    $query = mysqli_query($connect,"SELECT `id` FROM `members` WHERE `id` = $id");
    if (mysqli_num_rows($query) > 0) {
        $query_del = mysqli_query($connect,"DELETE FROM `contacts` WHERE `user_id` = $user_id AND `contact_id` = $id");
    }
}*/

/*if (isset($_GET['blockid']) & is_numeric($_GET['blockid'])) {
    $id = $_GET['blockid'];
    $user_id = $_SESSION['user']['id'];
    $query = mysqli_query($connect,"SELECT `id` FROM `contacts` WHERE `user_id` = '$user_id' AND `contact_id` = '$id'");
    if (mysqli_num_rows($query) > 0) {
        $query_upd = mysqli_query($connect,"UPDATE `contacts` SET `blocked` = 1 WHERE `user_id` = $user_id AND `contact_id` = $id");
    } else {
        $query_blk = mysqli_query($connect,"INSERT INTO `contacts` (`user_id`, `contact_id`, `blocked`) VALUES ('$user_id', '$id', 1)");
    }
}*/

/*if (isset($_GET['deblockid']) & is_numeric($_GET['deblockid'])) {
    $id = $_GET['deblockid'];
    $user_id = $_SESSION['user']['id'];
    $query = mysqli_query($connect,"SELECT `id` FROM `contacts` WHERE `user_id` = '$user_id' AND `contact_id` = '$id'");
    if (mysqli_num_rows($query) > 0) {
        $query_upd = mysqli_query($connect,"UPDATE `contacts` SET `blocked` = 0 WHERE `user_id` = $user_id AND `contact_id` = $id");
    }
}*/

if (isset($_GET['admin'])) {
    header('Location: ../../admin/index.php?page=' . $_SESSION['user']['page_get']);
} else {
    header('Location: ../profile.php');
}
