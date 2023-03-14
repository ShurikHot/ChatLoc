<?php
require_once 'db.php';
require_once 'admin/params.php';
ini_set('session.gc_maxlifetime', $session_lifetime);
ini_set('session.gc_probability', 1);
ini_set('session.gc_divisor', 1);
//session_set_cookie_params($session_lifetime, '/');
session_start();

if (isset($_GET['id']) & is_numeric($_GET['id'])) {
    $id = $_GET['id'];
    $user_id = $_SESSION['user']['id'];
    $query = mysqli_query($connect,"SELECT * FROM `members` WHERE `id` = $id");
    if (mysqli_num_rows($query) > 0) {
        $query_add = mysqli_query($connect,"INSERT INTO `contacts` (`user_id`, `contact_id`) VALUES ('$user_id', '$id')");
    }
    header('Location: ../profile.php');
}

if (isset($_GET['delid']) & is_numeric($_GET['delid'])) {
    $id = $_GET['delid'];
    $user_id = $_SESSION['user']['id'];
    $query = mysqli_query($connect,"SELECT * FROM `members` WHERE `id` = $id");
    if (mysqli_num_rows($query) > 0) {
        $query_del = mysqli_query($connect,"DELETE FROM `contacts` WHERE `user_id` = $user_id AND `contact_id` = $id");
    }
    header('Location: ../profile.php');
}