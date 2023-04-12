<?php


namespace app\models\admin;
require_once 'app/models/Model.php';

class AdminModel extends \app\models\Model
{
    public function membersList($start, $records_per_page)
    {
        $result = $this->query("SELECT `id`, `name`, `nickname`, `email`, `avatar`, `blocked` FROM `members` LIMIT $start, $records_per_page");
        return $result;
    }

    public function countMembers()
    {
        $result = $this->query("SELECT COUNT(`id`) as total FROM `members`");
        return $result;
    }

    public function chatsList($start, $records_per_page)
    {
        $result = $this->query("SELECT * FROM `chats` WHERE `approved` = 1 LIMIT $start, $records_per_page");
        return $result;
    }

    public function authorInfo($author)
    {
        $result = $this->query("SELECT `id`, `nickname` FROM `members` WHERE `id` = $author");
        return $result;
    }

    public function countChats()
    {
        $result = $this->query("SELECT COUNT(`id`) as total FROM `chats` WHERE `approved` = 1");
        return $result;
    }
}