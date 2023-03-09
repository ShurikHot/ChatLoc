<?php
session_start();
require_once 'db.php';

if (isset($_POST['message'])) {
    $message = trim(htmlspecialchars($_POST['message']));
    $userid = $_SESSION['user']['id'];

    $query = mysqli_query($connect,"INSERT INTO `messages`(`user_id`, `message`) VALUES ('$userid','$message')");
}