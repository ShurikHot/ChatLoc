<?php
/*require_once 'app/config/db.php';
require_once 'app/config/params.php';

ini_set('session.gc_maxlifetime', $session_lifetime);
ini_set('session.gc_probability', 1);
ini_set('session.gc_divisor', 1);
session_start();*/

if (isset($_GET['id']) & is_numeric($_GET['id'])) {
    $id = $_GET['id'];
    $query = mysqli_query($connect,"DELETE FROM `messages` WHERE `id` = $id");
}
header('Location: /chatpage.php?chat_id=' . $_GET['chat_id']);
