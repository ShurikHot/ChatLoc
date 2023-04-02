<?php
require_once 'app/config/db.php';
require_once 'app/config/params.php';

ini_set('session.gc_maxlifetime', $session_lifetime);
ini_set('session.gc_probability', 1);
ini_set('session.gc_divisor', 1);
session_start();

if (isset($_GET['invite_id']) & is_numeric($_GET['invite_id'])) {
    $invite_id = $_GET['invite_id'];
    $user_id = $_SESSION['user']['id'];
    $chat_id = $_GET['chat_id'];
    $query_chat = mysqli_query($connect, "SELECT `chat_name` FROM `chats` WHERE `id` = $chat_id");
    $chat_name = mysqli_fetch_assoc($query_chat);
    $invite_mess = $_SESSION['user']['lang_text']['join_chat'] . " <a href=\'/chatpage.php?chat_id=" . $chat_id . "\'>" . $chat_name['chat_name'] ."</a>";
    mysqli_query($connect,"INSERT INTO `personal_messages` (`from_id`, `to_id`, `message`) VALUES ('$user_id', '$invite_id', '$invite_mess')");
    header('Location: /chatpage.php?chat_id=' . $chat_id);
}