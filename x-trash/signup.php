<?php

/*require_once 'app/config/db.php';
require_once 'app/config/params.php';

ini_set('session.gc_maxlifetime', $session_lifetime);
ini_set('session.gc_probability', 1);
ini_set('session.gc_divisor', 1);
session_start();*/

use PHPMailer\PHPMailer\PHPMailer;
//use PHPMailer\PHPMailer\Exception;
require_once '../vendor/PHPMailer/src/Exception.php';
require_once '../vendor/PHPMailer/src/PHPMailer.php';
require_once '../vendor/PHPMailer/src/SMTP.php';



$email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
$name = filter_var(trim($_POST['name']),FILTER_SANITIZE_STRING);
$nickname = filter_var(trim($_POST['nickname']),FILTER_SANITIZE_STRING);
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];
$phone_num = filter_var(trim($_POST['phone_num']), FILTER_SANITIZE_NUMBER_INT);
$gender = $_POST['gender'];
$country = filter_var(trim($_POST['country']),FILTER_SANITIZE_STRING);
$language = $_POST['language'];
if (isset($_POST['specialization'])) {
    $specialization = implode(',', $_POST['specialization']);
} else {
    $specialization = "";
}
$comment = htmlspecialchars($_POST['comment']);

$query_email = mysqli_query($connect, "SELECT `id` FROM `members` WHERE `email` = '$email'");
if (mysqli_num_rows($query_email) > 1) {
    $_SESSION['message'] = '<h6 align="center">This email is in use by another user</h6>';
    header('Location: /index.php');
} elseif ($password === $confirm_password && $name != "" && $email != "" && $nickname != "" && $password != "") {
    $password = md5($password);
    $date = date('Y-m-d H:i:s');
    $query = mysqli_query($connect,
                "INSERT INTO `members` (`email`, `name`, `nickname`, `password`, `phone_num`, `gender`, `country`, `language`, `specialization`, `comment`, `created_at`) 
                       VALUES ('$email', '$name', '$nickname', '$password', '$phone_num', '$gender', '$country', '$language', '$specialization', '$comment', '$date')");
    if($query) {
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'youremail@gmail.com';
        $mail->Password = 'yourpassword';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;
        $mail->setFrom('youremail@gmail.com', 'Your Name');
        $mail->addAddress("$email");
        $mail->Subject = '<b>Your registration data: </b><br>';
        $mail->Body = 'Your Nickname: ' . $nickname . '<br> Your Password: '. $password;
    } else {
        echo 'Message could not be sent. Mailer Error: ' . $mail->ErrorInfo;
    }
    $_SESSION['message'] = '<h6 align="center">Registration completed successfully</h6> <br> Please Check your email!';
    header('Location: /index.php');
} else {
    $_SESSION['message'] = '<h6 align="center">Some fields do not fill, </br>or the password and confirm password fields do not match</h6>';
    header('Location: /index.php');
}
