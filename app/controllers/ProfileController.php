<?php

namespace app\controllers;

require_once 'Controller.php';
require_once 'View.php';
require_once 'app/models/ProfileModel.php';

use app\models\Model;
use app\models\ProfileModel;


class ProfileController extends Controller
{
    public function login()
    {
        $view = new View();
        $view->render('profile/registration.php', []);
    }

    public function signin()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $password = md5($_POST['password']);
            $checkUser = new ProfileModel();
            $check = $checkUser->signinUser($email, $password);
            $_SESSION['user'] = [
                "id" => $check['id'],
                "nickname" => $check['nickname'],
                "email" => $check['email'],
                "language" => $check['language'],
                "avatar" => $check['avatar'],
                "blocked" => $check['blocked'],
            ];
            $lang_page = $_SESSION['user']['language'];
            $lang_path = "app/views/languages/$lang_page.php";
            if (file_exists($lang_path)) {
                $_SESSION['user']['lang_text'] = include($lang_path);
            }
        }

        $setvisit = new ProfileModel();
        $setvisit->lastVisit($_SESSION['user']['id']);

        $view = new View();
        $view->render('profile/profile.php', $_SESSION['user']);
    }

    public function uploadavatar()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $folderPath = 'public/uploads/';
            $image_parts = explode(";base64,", $_POST['image']);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);
            $file = $folderPath . uniqid() . '.png';
            $userid = $_SESSION['user']['id'];
            $_SESSION['user']['avatar'] = $file;
            //mysqli_query($connect,"UPDATE `members` SET `avatar`= '$file' WHERE `id` = $userid");
            file_put_contents($file, $image_base64);
        }
        echo json_encode(["image uploaded successfully."]);
    }

    public function logout()
    {
        unset($_SESSION['user']);
        header('Location: /');
    }


}