<?php
/*require_once 'app/config/params.php';

ini_set('session.gc_maxlifetime', $session_lifetime);
ini_set('session.gc_probability', 1);
ini_set('session.gc_divisor', 1);
session_start();*/

if (isset($_GET['content'])) {
    $content_page = $_GET['content'];
    $content_path = "../../admin/views/$content_page.php";
    $content_data = file_get_contents($content_path);
    if (file_exists($content_path)) {
       file_put_contents("../../admin/content.php", $content_data);
    }
    $_SESSION['user']['admin_category'] = $content_page;
}
header('Location: ../../admin/index.php');