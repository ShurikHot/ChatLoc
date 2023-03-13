<?php
require_once 'db.php';
require_once 'admin/params.php';
session_set_cookie_params($session_lifetime, '/');
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