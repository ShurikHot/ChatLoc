<?php
require_once 'db.php';
require_once 'admin/params.php';

ini_set('session.gc_maxlifetime', $session_lifetime);
ini_set('session.gc_probability', 1);
ini_set('session.gc_divisor', 1);
session_start();

if (isset($_POST['message']) && $_POST['message'] != '') {
    $message = trim(htmlspecialchars($_POST['message']));
    $userid = $_SESSION['user']['id'];
    $query = mysqli_query($connect,"INSERT INTO `messages`(`user_id`, `message`) VALUES ('$userid','$message')");
}

if (isset($_POST['personal_message']) && $_POST['personal_message'] != '') {
    $message = trim(htmlspecialchars($_POST['personal_message']));
    $user_id = $_SESSION['user']['id'];
    $contact_id = $_POST['contact_id'];
    $query = mysqli_query($connect,"INSERT INTO `personal_messages`(`from_id`, `to_id`, `message`) VALUES ('$user_id','$contact_id','$message')");
}
