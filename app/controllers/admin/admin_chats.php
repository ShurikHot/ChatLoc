<?php
require_once '../app/config/db.php';
require_once 'app/config/params.php';

ini_set('session.gc_maxlifetime', $session_lifetime);
ini_set('session.gc_probability', 1);
ini_set('session.gc_divisor', 1);
session_start();

if (isset($_GET['approved_id']) && is_numeric($_GET['approved_id'])) {
    $chat_id = $_GET['approved_id'];
    mysqli_query($connect, "UPDATE `chats` SET `approved`='1' WHERE `id` = $chat_id");
}
if (isset($_GET['delid']) && is_numeric($_GET['delid'])) {
    $chat_id = $_GET['delid'];
    mysqli_query($connect, "DELETE FROM `chats` WHERE `id` = $chat_id");
    mysqli_query($connect, "DELETE FROM `messages` WHERE `chat_id` = $chat_id");
}

header('Location: ../../admin/index.php?page=' . $_SESSION['user']['page_get']);