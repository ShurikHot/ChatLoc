<?php


namespace app\models;
require_once 'app/models/Model.php';


class ProfileModel extends Model
{
    public function signinUser($email, $password)
    {
        $result = $this->query("SELECT `id`, `nickname`, `email`, `language`, `avatar`, `blocked` FROM `members` WHERE `email` = '$email' AND `password` = '$password'");
        if (mysqli_num_rows($result) > 0) {
            $result = mysqli_fetch_assoc($result);
        } else {
            $_SESSION['message'] = '<h6 align="center">Incorrect username or password</h6>';
            header('Location: /');
        }
        return $result;
    }

    public function lastVisit($id)
    {
        $this->query("UPDATE `members` SET `last_visit` = NOW() WHERE `id` = $id");
    }
}