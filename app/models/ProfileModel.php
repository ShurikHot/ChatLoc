<?php

namespace models;

class ProfileModel extends Model
{
    public function signInUser($email, $password)
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
        $result = $this->query("SELECT `contact_id` FROM `contacts` WHERE `user_id` = '$id' AND `blocked` = 1");
        return $result;
    }

    public function contactNick($contact_id)
    {
        $result = $this->query("SELECT `nickname` FROM `members` WHERE `id` = '$contact_id'");
        return $result;
    }

    public function deblockId($user_id, $id)
    {
        $result = $this->query("SELECT `id` FROM `contacts` WHERE `user_id` = '$user_id' AND `contact_id` = '$id'");
        if (mysqli_num_rows($result) > 0) {
            $this->query("UPDATE `contacts` SET `blocked` = 0 WHERE `user_id` = '$user_id' AND `contact_id` = '$id'");
        }
    }

    public function searchMember($search_query, $id)
    {
        $result = $this->query("SELECT `id` FROM `members` WHERE (`nickname` LIKE '%$search_query%') OR (`email` LIKE '%$search_query%') AND `id` <> '$id'");
        return $result;
    }

    public function searchInfo($find_id)
    {
        $result = $this->query("SELECT `nickname`, `email`, `last_visit` FROM `members` WHERE `id` = '$find_id'");
        return $result;
    }

    public function contactList($id)
    {
        $result = $this->query("SELECT `contact_id` FROM `contacts` WHERE `user_id` = '$id' AND `blocked` <> 1");
        return $result;
    }

    public function persMessage($contact_id, $id)
    {
        $result = $this->query("SELECT `id` FROM `personal_messages` WHERE `from_id` = '$contact_id' AND `to_id` = '$id' AND `unread` = 1");
        return $result;
    }

    public function contactApprList($id)
    {
        $result = $this->query("SELECT `from_id` FROM `personal_messages` WHERE `to_id` = '$id' AND `unread` = 1 AND `message` LIKE '%added you to contacts%'");
        return $result;
    }

    public function checkEmail($email)
    {
        $result = $this->query("SELECT `id` FROM `members` WHERE `email` = '$email'");
        return $result;
    }

    public function memberSignup($email, $name, $nickname, $password, $phone_num, $gender, $country, $language, $specialization, $comment, $date)
    {
        $this->query("INSERT INTO `members` (`email`, `name`, `nickname`, `password`, `phone_num`, `gender`, `country`, `language`, `specialization`, `comment`, `created_at`) 
                       VALUES ('$email', '$name', '$nickname', '$password', '$phone_num', '$gender', '$country', '$language', '$specialization', '$comment', '$date')");
        return true;
    }

    public function accountInfo($id)
    {
        $result = $this->query("SELECT * FROM `account` WHERE `user_id` = '$id'");
        return $result;
    }

    public function fillAccount($id, $amount)
    {
        $result = $this->query("SELECT * FROM `account` WHERE `user_id` = '$id'");
        if (mysqli_num_rows($result) > 0) {
            $this->query("UPDATE `account` SET `amount` = `amount` + '$amount' WHERE `user_id` = '$id'");
        } else {
            $this->query("INSERT INTO `account`(`user_id`, `amount`) VALUES ('$id', '$amount')");
        }
    }

    public function minusCoin($id, $coins)
    {
        $this->query("UPDATE `account` SET `amount` = `amount` - '$coins' WHERE `user_id` = '$id'");
    }

    public function setMonthly($id)
    {
        $this->query("UPDATE `account` SET `start_monthly_subscr` = NOW(),`end_monthly_subscr`= DATE_ADD(NOW(), INTERVAL 1 MONTH) WHERE `user_id` = '$id'");
    }

    public function unsetMonthly($id)
    {
        $this->query("UPDATE `account` SET `start_monthly_subscr` = '0000-00-00',`end_monthly_subscr`= '0000-00-00' WHERE `user_id` = '$id'");
    }

    public function makeTop($id)
    {
        $this->query("UPDATE `account` SET `top` = 1 WHERE `user_id` = '$id'");
    }
}