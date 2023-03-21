<?php
require_once 'vendor/db.php';
require_once 'vendor/admin/params.php';

ini_set('session.gc_maxlifetime', $session_lifetime);
ini_set('session.gc_probability', 1);
ini_set('session.gc_divisor', 1);
session_start();
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Chat List</title>
    <link href="/assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="text-center">
<ul class="nav justify-content-center">
    <li class="nav-item">
        <?php if (isset($_SESSION['user']['blocked']) && $_SESSION['user']['blocked']): ?>
            <a class="btn btn-warning" aria-current="page"href=""><b>!!Your account is blocked!!</b></a>
        <?php endif; ?>
    </li>
    <li class="nav-item">
        <a class="btn btn-primary" href="profile.php">Go to your&nbsp;<b>Profile</b></a>
    </li>

    <?php if (isset($_SESSION['user']['email']) && $_SESSION['user']['email'] === 'admin@admin.com'): ?>
        <li class="nav-item">
            <a class="btn btn-success" href="admin/index.php">Admin Area</a>
        </li>
    <?php endif; ?>
    <li class="nav-item">
        <a class="btn btn-danger" href="vendor/logout.php">Logout</a>
    </li>
</ul>

</body>

<?php

if (isset($_SESSION['user']['blocked']) && !$_SESSION['user']['blocked']) {
    $chats = mysqli_query($connect, "SELECT * FROM `chats`");
    if (mysqli_num_rows($chats) > 0) {
        while ($chat = mysqli_fetch_assoc($chats)) {
            echo("<a href='chatpage.php?chat_id=" . $chat['id'] . "'>
                     <li class='justify-content-between align-items-center'>" . $chat['chat_name'] .
                 "</a>
                     </li>"
            );
        }
    }
}
?>