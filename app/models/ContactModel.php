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
}