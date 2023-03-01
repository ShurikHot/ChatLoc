<?php
    session_start();

    if(!isset($_SESSION['user'])) {
        header('Location: /index.php');
    }
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Your ChatLoc Profile</title>
    <link href="/assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="/assets/sign-in.css" rel="stylesheet">
</head>
<body class="text-center">

    <h2><?= $_SESSION['user']['nickname'] ?></h2>
    <p></p>
    <p><?= $_SESSION['user']['email'] ?></p>
    <a href="vendor/logout.php">Logout</a>
</body>
</html>
