<?php
session_start();
require_once 'db.php';

if (isset($_GET['id']) & is_numeric($_GET['id'])) {
    $id = $_GET['id'];
    $query = mysqli_query($connect,"DELETE FROM `messages` WHERE `id` = $id");
    if ($query) {
        header('Location: /chatpage.php');
    }
} else {
    header('Location: /chatpage.php');
}