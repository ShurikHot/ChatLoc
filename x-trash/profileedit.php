<?php
/*require_once 'app/config/db.php';
require_once 'app/config/params.php';

ini_set('session.gc_maxlifetime', $session_lifetime);
ini_set('session.gc_probability', 1);
ini_set('session.gc_divisor', 1);
session_start();*/

/*$userid = $_SESSION['user']['id'];*/
/*if (isset($_POST['edit_nickname'])) {
    $_POST['edit_nickname'] = htmlspecialchars($_POST['edit_nickname']);
    $_SESSION['user']['edit_nickname'] = true;
}
if (isset($_POST['actual_nickname'])) {
    $new_nickname = $_POST['actual_nickname'];
    mysqli_query($connect,"UPDATE `members` SET `nickname`= '$new_nickname' WHERE `id` = $userid");
    $_SESSION['user']['actual_nickname'] = $_POST['actual_nickname'];
    unset($_SESSION['user']['edit_nickname']);
}*/
/*if (isset($_POST['lang'])) {
    $new_lang = $_POST['lang'];
    mysqli_query($connect,"UPDATE `members` SET `language`= '$new_lang' WHERE `id` = $userid");
    $_SESSION['user']['language'] = $_POST['lang'];
    $_SESSION['message'] = '<h6 align="center">' . $_SESSION['user']['lang_text']['change_language'] . '</h6>';
}*/
//header('Location: /profile.php');
