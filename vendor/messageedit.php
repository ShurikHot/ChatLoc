<?php
session_start();
require_once 'db.php';

if (isset($_POST['cancel'])) {
    header('Location: /chatpage.php');
}

if (isset($_POST['new_message'])) {
    $new_message = $_POST['new_message'];
    $id_for_edit =  $_SESSION['id_for_edit'];
    $query2 = mysqli_query($connect,"UPDATE `messages` SET `message`= '$new_message' WHERE `id` = $id_for_edit");
    header('Location: /chatpage.php');
}

if (isset($_GET['id']) & is_numeric($_GET['id'])) {
    $id = $_GET['id'];
    $query = mysqli_query($connect,"SELECT * FROM `messages` WHERE `id` = $id");
    $message = mysqli_fetch_assoc($query);
    if ($query) {
        $_SESSION['is_edit'] = true;
        $_SESSION['id_for_edit'] = $id;
        $_SESSION['mess_for_edit'] = $message['message'];
        header('Location: /chatpage.php');
    }
} else {
    header('Location: /chatpage.php');
}
