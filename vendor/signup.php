<?php
    session_start();
    require_once 'db.php';


    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $name = filter_var(trim($_POST['name']),FILTER_SANITIZE_STRING);
    $nickname = filter_var(trim($_POST['nickname']),FILTER_SANITIZE_STRING);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $phone_num = filter_var(trim($_POST['phone_num']), FILTER_SANITIZE_NUMBER_INT);
    $gender = $_POST['gender'];
    $country = filter_var(trim($_POST['country']),FILTER_SANITIZE_STRING);
    $language = $_POST['language'];
    $specialization = implode(',', $_POST['specialization']);
    $comment = $_POST['comment'];

    if ($password === $confirm_password) {
        $password = md5($password);
        mysqli_query($connect, "INSERT INTO `members` (`email`, `name`, `nickname`, `password`, `phone_num`, `gender`, `country`, `language`, `specialization`, `comment`) 
                                      VALUES ('$email', '$name', '$nickname', '$password', '$phone_num', '$gender', '$country', '$language', '$specialization', '$comment')");
        $_SESSION['message'] = 'Registration completed successfully';
        header('Location: /index.php');
    } else {
        $_SESSION['message'] = 'The password and confirm password fields do not match';
        header('Location: /registration.php');
    }