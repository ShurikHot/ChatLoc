<?php


namespace app\models;
require_once 'app/models/Model.php';


class ContactModel extends Model
{
    public function lastVisit($id)
    {
        $this->query("UPDATE `members` SET `last_visit` = NOW() WHERE `id` = $id");
    }

    public function contactInfo($id)
    {
        $result = $this->query("SELECT `id`, `email`, `nickname`, `avatar`, `last_visit` FROM `members` WHERE `id` = $id");
        return $result;
    }

    public function contactIsBlock($user_id, $id)
    {
        $result = $this->query("SELECT `blocked` FROM `contacts` WHERE `user_id` = $user_id AND `contact_id` = $id");
        return $result;
    }

    public function contactDel($user_id, $id)
    {
        $this->query("DELETE FROM `contacts` WHERE `user_id` = $user_id AND `contact_id` = $id");
    }

    public function contactIs($user_id, $id)
    {
        $result = $this->query("SELECT `id` FROM `contacts` WHERE `user_id` = $user_id AND `contact_id` = $id");
        return $result;
    }

    public function contactAdd($user_id, $id, $mess)
    {
        $this->query("INSERT INTO `contacts` (`user_id`, `contact_id`) VALUES ($user_id, $id)");
        $this->query("INSERT INTO `personal_messages` (`from_id`, `to_id`, `message`) VALUES ($user_id, $id, '$mess')");
    }

    public function contactBlock($user_id, $id)
    {
        $contact = $this->query("SELECT `id` FROM `contacts` WHERE `user_id` = $user_id AND `contact_id` = $id");
        if (mysqli_num_rows($contact) > 0) {
            $this->query("UPDATE `contacts` SET `blocked` = 1 WHERE `user_id` = $user_id AND `contact_id` = $id");
        } else {
            $this->query("INSERT INTO `contacts` (`user_id`, `contact_id`, `blocked`) VALUES ('$user_id', '$id', 1)");
        }
    }
    public function contactDeblock($user_id, $id)
    {
        $result = $this->query("SELECT `id` FROM `contacts` WHERE `user_id` = $user_id AND `contact_id` = $id");
        if (mysqli_num_rows($result) > 0) {
            $this->query("UPDATE `contacts` SET `blocked` = 0 WHERE `user_id` = $user_id AND `contact_id` = $id");
        }
    }


}