<?php
    require_once 'db.php';
    require_once 'admin/params.php';
    ini_set('session.gc_maxlifetime', $session_lifetime);
    ini_set('session.gc_probability', 1);
    ini_set('session.gc_divisor', 1);
    //session_set_cookie_params($session_lifetime, '/');
    session_start();
    $userid = $_SESSION['user']['id'];
    if (isset($_POST['edit_nickname'])) {
        $_POST['edit_nickname'] = htmlspecialchars($_POST['edit_nickname']);
        $_SESSION['user']['edit_nickname'] = true;
    }
    if (isset($_POST['actual_nickname'])) {
        $new_nickname = $_POST['actual_nickname'];
        mysqli_query($connect,"UPDATE `members` SET `nickname`= '$new_nickname' WHERE `id` = $userid");
        $_SESSION['user']['actual_nickname'] = $_POST['actual_nickname'];
        unset($_SESSION['user']['edit_nickname']);
    }
    header('Location: /profile.php');

