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
    $query = mysqli_query($connect,"DELETE FROM `messages` WHERE `id` = $id");
    if ($query) {
        header('Location: /chatpage.php');
    }
} else {
    header('Location: /chatpage.php');
}