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

    public function chatsApproveList($start, $records_per_page)
    {
        $result = $this->query("SELECT * FROM `chats` WHERE `approved` = 0 LIMIT $start, $records_per_page");
        return $result;
    }

    public function countApproveChats()
    {
        $result = $this->query("SELECT COUNT(`id`) as total FROM `chats` WHERE `approved` = 0");
        return $result;
    }

    public function blockedMemberList($start, $records_per_page)
    {
        $result = $this->query("SELECT `id`, `name`, `nickname`, `email`, `avatar`, `blocked` FROM `members` WHERE `blocked` = 1 LIMIT $start, $records_per_page");
        return $result;
    }

    public function countBlockedMembers()
    {
        $result = $this->query("SELECT COUNT(`id`) as total FROM `members` WHERE `blocked` = 1");
        return $result;
    }

    public function statisticMember()
    {
        $result = $this->query("SELECT DATE_FORMAT(created_at, '%Y-%m-%d %H:00:00') as hour, COUNT(`id`) as count FROM members GROUP BY hour");
        return $result;
    }

    public function memberInfo($user_id)
    {
        $result = $this->query("SELECT * FROM `members` WHERE `id` = $user_id");
        return $result;
    }

    public function contactIs($id)
    {
        $result = $this->query("SELECT * FROM `contacts` WHERE `user_id` = 1 AND `contact_id` = $id");
        return $result;
    }

    public function updateMember($blocked, $email, $name, $nickname, $phone_num, $avatar, $gender, $country, $language, $specialization, $userid)
    {
        $this->query("UPDATE `members` SET  `blocked` = '$blocked',
                                                            `email` = '$email',
                                                            `name` = '$name',
                                                            `nickname` = '$nickname',
                                                            `phone_num` = '$phone_num',
                                                            `avatar` = '$avatar',
                                                            `gender` = '$gender',
                                                            `country` = '$country', 
                                                            `language` = '$language', 
                                                            `specialization` = '$specialization' WHERE `id` = $userid");
    }

    public function memberBlock($lockid)
    {
        $result = $this->query("SELECT `id`, `blocked` FROM `members` WHERE `id` = $lockid");
        if (mysqli_num_rows($result) > 0) {
            $user = mysqli_fetch_assoc($result);
            if ($user['blocked']) {
                $this->query("UPDATE `members` SET `blocked` = 0 WHERE `id` = $lockid");
            } else {
                $this->query("UPDATE `members` SET `blocked` = 1 WHERE `id` = $lockid");
            }
        }
    }

    public function memberDel($delid)
    {
        $this->query("DELETE FROM `members` WHERE `id` = $delid");
        $this->query("DELETE FROM `messages` WHERE `id` = $delid");
    }

    public function chatDel($delid)
    {
        $this->query("DELETE FROM `chats` WHERE `id` = $delid");
        $this->query("DELETE FROM `messages` WHERE `chat_id` = $delid");
    }

    public function chatApprove($appid)
    {
        $this->query("UPDATE `chats` SET `approved`='1' WHERE `id` = $appid");
    }


}