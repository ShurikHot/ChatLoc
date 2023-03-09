<?php
session_start();

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