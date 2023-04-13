<?php
/*require_once '../app/config/db.php';
require_once 'app/config/params.php';

ini_set('session.gc_maxlifetime', $session_lifetime);
ini_set('session.gc_probability', 1);
ini_set('session.gc_divisor', 1);
session_start();*/

/*edit*/
/*if (isset($_GET['id']) & is_numeric($_GET['id'])) {
    $id = $_GET['id'];
    $query = mysqli_query($connect,"SELECT * FROM `members` WHERE `id` = $id");
    if (mysqli_num_rows($query) > 0) {
        $user = mysqli_fetch_assoc($query);
        $_SESSION['user']['admin_member_edit'] = [
            "id" => $user['id'],
            "blocked" => $user['blocked'],
            "email" => $user['email'],
            "name" => $user['name'],
            "nickname" => $user['nickname'],
            "phone_num" => $user['phone_num'],
            "avatar" => $user['avatar'],
            "gender" => $user['gender'],
            "country" => $user['country'],
            "language" => $user['language'],
            "specialization" => $user['specialization'],
        ];
    }
    $content_path = "../../admin/views/members_edit.php";
    $content_data = file_get_contents($content_path);
    file_put_contents("../../admin/content.php", $content_data);
}*/

/*block*/
if (isset($_GET['lockid']) & is_numeric($_GET['lockid'])) {
    $lockid = $_GET['lockid'];
    $query = mysqli_query($connect,"SELECT `id`, `blocked` FROM `members` WHERE `id` = $lockid");
    if (mysqli_num_rows($query) > 0) {
        $user = mysqli_fetch_assoc($query);
        if ($user['blocked']) {
            mysqli_query($connect, "UPDATE `members` SET `blocked` = 0 WHERE `id` = $lockid");
        } else {
            mysqli_query($connect, "UPDATE `members` SET `blocked` = 1 WHERE `id` = $lockid");
        }
        $content_path = "../../admin/views/members.php";
        $content_data = file_get_contents($content_path);
        file_put_contents("../../admin/content.php", $content_data);
    }
}

/*delete*/
if (isset($_GET['delid']) & is_numeric($_GET['delid'])) {
    $delid = $_GET['delid'];
    mysqli_query($connect,"DELETE FROM `members` WHERE `id` = $delid");
    mysqli_query($connect,"DELETE FROM `messages` WHERE `id` = $delid");
    $content_path = "../../admin/views/members.php";
    $content_data = file_get_contents($content_path);
    file_put_contents("../../admin/content.php", $content_data);
}

/*update*/
if(isset($_POST['submit'])) {
    $userid = $_POST['userid'];
    $blocked = $_POST['blocked'];
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $name = filter_var(trim($_POST['name']),FILTER_SANITIZE_STRING);
    $nickname = filter_var(trim($_POST['nickname']),FILTER_SANITIZE_STRING);
    $phone_num = filter_var(trim($_POST['phone_num']), FILTER_SANITIZE_NUMBER_INT);
    $avatar = filter_var(trim($_POST['avatar']), FILTER_SANITIZE_STRING);
    $gender = $_POST['gender'];
    $country = filter_var(trim($_POST['country']),FILTER_SANITIZE_STRING);
    $language = $_POST['language'];
    $specialization = filter_var(trim($_POST['specialization']),FILTER_SANITIZE_STRING);

    if ($name != "" && $email != "" && $nickname != "") {
        mysqli_query($connect, "UPDATE `members` SET  `blocked` = '$blocked',
                                                            `email` = '$email',
                                                            `name` = '$name',
                                                            `nickname` = '$nickname',
                                                            `phone_num` = '$phone_num',
                                                            `avatar` = '$avatar',
                                                            `gender` = '$gender',
                                                            `country` = '$country', 
                                                            `language` = '$language', 
                                                            `specialization` = '$specialization' WHERE `id` = $userid");
        $content_path = "../../admin/views/members.php";
        $content_data = file_get_contents($content_path);
        file_put_contents("../../admin/content.php", $content_data);
    }
}
header('Location: ../../admin/index.php?page=' . $_SESSION['user']['page_get']);
