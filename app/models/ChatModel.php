<?php


namespace app\models;
require_once 'app/models/Model.php';

class ChatModel extends Model
{
    public function messagePersonalAdd($user_id, $contact_id, $message)
    {
        $this->query("INSERT INTO `personal_messages`(`from_id`, `to_id`, `message`) VALUES ('$user_id','$contact_id','$message')");
    }

    public function messageAdd($user_id, $message, $chat_id)
    {
        $this->query("INSERT INTO `messages`(`user_id`, `message`, `chat_id`) VALUES ('$user_id','$message', '$chat_id')");
    }

    public function messageCount($user_id, $contact_id)
    {
        $result = $this->query("SELECT COUNT(`id`) as total FROM `personal_messages` WHERE (`from_id` = '$user_id' AND `to_id` = '$contact_id') 
                                    OR (`from_id` = '$contact_id' AND `to_id` = '$user_id')");
        return $result;
    }

    public function messagesPersonal($user_id, $contact_id, $start, $total_records)
    {
        $result = $this->query("SELECT `id`, `from_id`, `message` FROM `personal_messages` WHERE (`from_id` = '$user_id' AND `to_id` = '$contact_id') 
                                      OR (`from_id` = '$contact_id' AND `to_id` = '$user_id') LIMIT '$start', '$total_records'");
        return $result;
    }

    public function contactInfo($id)
    {
        $result = $this->query("SELECT `id`, `nickname`, `avatar`, `last_visit` FROM `members` WHERE `id` = '$id'");
        return $result;
    }

    public function unread($mess_id)
    {
        $this->query("UPDATE `personal_messages` SET `unread` = 0 WHERE `id` = '$mess_id'");
    }

    public function chatList()
    {
        $result = $this->query("SELECT * FROM `chats` WHERE `approved` = 1");
        return $result;
    }

    public function createChat($chat_name, $user_id)
    {
        $this->query("INSERT INTO `chats`(`chat_name`, `author`) VALUES ('$chat_name', '$user_id')");
    }

    public function chatName($chat_id)
    {
        $result = $this->query("SELECT * FROM `chats` WHERE `id` = '$chat_id'");
        return $result;
    }

    public function inviteToChat($user_id, $invite_id, $invite_mess)
    {
        $this->query("INSERT INTO `personal_messages` (`from_id`, `to_id`, `message`) VALUES ('$user_id', '$invite_id', '$invite_mess')");
    }

    public function messageChatCount($chat_id)
    {
        $result = $this->query("SELECT COUNT(`id`) as total FROM `messages` WHERE `chat_id` = '$chat_id'");
        return $result;
    }

    public function selectMessages($chat_id, $start, $total)
    {
        $result = $this->query("SELECT * FROM `messages` WHERE `chat_id` = '$chat_id' LIMIT '$start', '$total'");
        return $result;
    }

    public function memberOnline($chat_id)
    {
        $result = $this->query("SELECT DISTINCT `user_id` FROM `messages` WHERE `chat_id` = '$chat_id'");
        return $result;
    }

    public function messageDelete($mess_id)
    {
        $this->query("DELETE FROM `messages` WHERE `id` = '$mess_id'");
    }

    public function selectMessage($mess_id)
    {
        $result = $this->query("SELECT * FROM `messages` WHERE `id` = '$mess_id'");
        return $result;
    }

    public function messageEdit($new_message, $id_for_edit)
    {
        $this->query("UPDATE `messages` SET `message`= '$new_message' WHERE `id` = '$id_for_edit'");
    }
}
