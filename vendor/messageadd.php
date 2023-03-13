<?php
require_once 'db.php';
require_once 'admin/params.php';
session_set_cookie_params($session_lifetime, '/');
session_start();

if (isset($_POST['message'])) {
    $message = trim(htmlspecialchars($_POST['message']));
    $userid = $_SESSION['user']['id'];

    $query = mysqli_query($connect,"INSERT INTO `messages`(`user_id`, `message`) VALUES ('$userid','$message')");
}