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
        $this->query("UPDATE `members` SET `last_visit` = NOW() WHERE `id` = '$id'");
    }

    public function changeAvatar($file, $userid)
    {
        $file_db = '/' . $file;

        $old_avatar = $this->query("SELECT `avatar` FROM `members` WHERE `id` = '$userid'");
        $del_old_avatar = mysqli_fetch_assoc($old_avatar);
        unlink(ltrim($del_old_avatar['avatar'], '/'));

        $this->query("UPDATE `members` SET `avatar`= '$file_db' WHERE `id` = '$userid'");
    }

    public function editProfile($new_nickname, $userid)
    {
        $this->query("UPDATE `members` SET `nickname`= '$new_nickname' WHERE `id` = '$userid'");
    }

    public function langList()
    {
        $result = $this->query("SELECT DISTINCT `language` FROM `members`");
        return $result;
    }

    public function editLang($new_lang, $userid)
    {
        $this->query("UPDATE `members` SET `language`= '$new_lang' WHERE `id` = '$userid'");
    }

    public function blackList($id)
    {
        $result = $this->query("SELECT `contact_id` FROM `contacts` WHERE `user_id` = $id AND `blocked` = 1");
        return $result;
    }

    public function contactNick($contact_id)
    {
        $result = $this->query("SELECT `nickname` FROM `members` WHERE `id` = $contact_id");
        return $result;
    }

    public function deblockId($user_id, $id)
    {
        $result = $this->query("SELECT `id` FROM `contacts` WHERE `user_id` = $user_id AND `contact_id` = $id");
        if (mysqli_num_rows($result) > 0) {
            $this->query("UPDATE `contacts` SET `blocked` = 0 WHERE `user_id` = $user_id AND `contact_id` = $id");
        }
    }

    public function searchMember($search_query, $id)
    {
        $result = $this->query("SELECT `id` FROM `members` WHERE (`nickname` LIKE '%$search_query%') OR (`email` LIKE '%$search_query%') AND `id` <> $id");
        return $result;
    }


}