<?php
    //require_once 'app/config/db.php';
    //require_once 'app/config/params.php';

    //ini_set('session.gc_maxlifetime', $session_lifetime);
    //ini_set('session.gc_probability', 1);
    //ini_set('session.gc_divisor', 1);
    //session_start();
//
    //$email = $_POST['email'];
    //$password = md5($_POST['password']);
//
    //$checkUser = mysqli_query($connect, "SELECT `id`, `nickname`, `email`, `language`, `avatar`, `blocked` FROM `members` WHERE `email` = '$email' AND `password` = '$password'");
    /*if (mysqli_num_rows($checkUser) > 0) {
        $user = mysqli_fetch_assoc($checkUser);
        $_SESSION['user'] = [
            "id" => $user['id'],
            "nickname" => $user['nickname'],
            "email" => $user['email'],
            "language" => $user['language'],
            "avatar" => $user['avatar'],
            "blocked" => $user['blocked'],
        ];

        $lang_page = $_SESSION['user']['language'];
        $lang_path = "app/views/languages/$lang_page.php";
        if (file_exists($lang_path)) {
            $_SESSION['user']['lang_text'] = include($lang_path);
        }*/

        /*$user['email'] === 'admin@admin.com' ? header('Location: ../admin/index.php') : header('Location: ../profile.php');
    } else {
        $_SESSION['message'] = '<h6 align="center">Incorrect username or password</h6>';
        header('Location: /index.php');
    }*/