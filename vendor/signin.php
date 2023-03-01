<?php
    session_start();
    require_once 'db.php';

    $email = $_POST['email'];
    $password = md5($_POST['password']);

    $checkUser = mysqli_query($connect, "SELECT * FROM `members` WHERE `email` = '$email' AND `password` = '$password'");
    if (mysqli_num_rows($checkUser) > 0) {
        $user = mysqli_fetch_assoc($checkUser);
        $_SESSION['user'] = [
            "id" => $user['id'],
            "nickname" => $user['nickname'],
            "email" => $user['email'],
            "language" => $user['language'],
        ];
        header('Location: ../profile.php');
    } else {
        $_SESSION['message'] = 'Incorrect username or password';
        header('Location: /index.php');
    }