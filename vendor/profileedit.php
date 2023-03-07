<?php
    session_start();
    require_once 'db.php';
    $userid = $_SESSION['user']['id'];
    if (isset($_POST['edit_nickname'])) {
        $_SESSION['user']['edit_nickname'] = true;
    }
    if (isset($_POST['actual_nickname'])) {
        $new_nickname = $_POST['actual_nickname'];
        mysqli_query($connect,"UPDATE `members` SET `nickname`= '$new_nickname' WHERE `id` = $userid");
        $_SESSION['user']['actual_nickname'] = $_POST['actual_nickname'];
        unset($_SESSION['user']['edit_nickname']);
    }
    header('Location: /profile.php');

