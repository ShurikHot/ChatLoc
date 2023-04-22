<?php

namespace controllers;

use models\ChatModel;
use models\Model;
use models\ProfileModel;

class ChatController extends Controller
{
    public function messageAdd()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $model = new ChatModel();
            if (isset($_POST['chat_id']) && isset($_POST['message']) && $_POST['message'] != '') {
                $model_acc = new ProfileModel();
                $account_info = $model_acc->accountInfo($_SESSION['user']['id']);
                if (mysqli_num_rows($account_info) > 0) {
                    $account = mysqli_fetch_assoc($account_info);
                        if ($account['top'] == 1 && $account['start_monthly_subscr'] != '0000-00-00') {
                            $message = trim(htmlspecialchars($_POST['message']));
                            $model->messageAdd($_SESSION['user']['id'], $message, $_POST['chat_id']);
                        } elseif ($account['amount'] > 0) {
                            $model_acc->minusCoin($_SESSION['user']['id'], 1);
                            $message = trim(htmlspecialchars($_POST['message']));
                            $model->messageAdd($_SESSION['user']['id'], $message, $_POST['chat_id']);
                        }
                    }
            } elseif (isset($_POST['personal_message']) && $_POST['personal_message'] != '') {
                $message = trim(htmlspecialchars($_POST['personal_message']));
                $model->messagePersonalAdd($_SESSION['user']['id'], $_POST['contact_id'], $message);
            }
        }
    }

    public function messagePersonalLoad()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $model = new ChatModel();
            $result = $model->messageCount($_SESSION['user']['id'], $_POST['contact_id']);
            $row = mysqli_fetch_assoc($result);
            $total_records = $row['total'];
            $total_records > 50 ? $start = $total_records - 50 : $start = 0;

            $messages = $model->messagesPersonal($_SESSION['user']['id'], $_POST['contact_id'], $start, $total_records);
            if (mysqli_num_rows($messages) > 0) {
                while ($messagearr = mysqli_fetch_assoc($messages)) {
                    $mes_from_id = $messagearr['from_id'];
                    $contact_info = $model->contactInfo($mes_from_id);
                    $nickname = mysqli_fetch_assoc($contact_info);
                    echo("<div class='container'>
                              <div style='margin-right: 5px; text-align: left;'>
                                  <p>" . $nickname['nickname'] . ": " . $messagearr['message'] . "                    
                                  </p>
                              </div>
                          </div>");
                    $mess_id = $messagearr['id'];
                    if ($_SESSION['user']['id'] != $mes_from_id) {
                        $model->unread($mess_id);
                    }
                }
            }
        }
    }

    public function chatList($get_param)
    {
        $model_visit = new ProfileModel();
        if (isset($_SESSION['user'])) {
            $model_visit->lastVisit($_SESSION['user']['id']);
        } else {
            header('Location: /');
        }

        if (isset($_SESSION['user']['blocked']) && $_SESSION['user']['blocked']) {
            header('Location: /profile/info');
        }

        $_SESSION['user']['chat_create'] = false;
        if (isset($_SESSION['user']['blocked']) && !$_SESSION['user']['blocked']) {
            $model = new ChatModel();
            $chats = $model->chatList();

            if (mysqli_num_rows($chats) > 0) {
                while ($chat = mysqli_fetch_assoc($chats)) {
                    $author_q = $model->contactInfo($chat['author']);
                    $author = mysqli_fetch_assoc($author_q);
                    $chat_arr[$chat['id']] = [
                        'chat_name' => $chat['chat_name'],
                        'author_name' => $author['nickname'],
                    ];
                }
            }

            if ($get_param == 'create') {
                $_SESSION['user']['chat_create'] = true;
            }

            if(isset($_POST['create_chat'])) {
                $chat_name = filter_var(trim($_POST['create_chat']),FILTER_SANITIZE_STRING);
                $model->createChat($chat_name, $_SESSION['user']['id']);

                $_SESSION['message'] = __('create_chat_mess');
                unset($_POST['create_chat']);
            }
        }

        $view = new View();
        $view->render('chatlist.php', ['chat_arr' => $chat_arr]);
    }

    public function chatPage($get_key, $get_value)
    {
        $model_profile = new ProfileModel();
        $_SESSION['user']['invite'] = false;
        if (isset($_SESSION['user'])) {
            $model_profile->lastVisit($_SESSION['user']['id']);
        } else {
            header('Location: /');
        }

        if (isset($_SESSION['user']['blocked']) && $_SESSION['user']['blocked']) {
            header('Location: /profile/info');
        }
        $model = new ChatModel();
        if (isset($get_key) && is_numeric($get_value)) {
            $chat_q = $model->chatName($get_value);
            $contacts_arr = [];

            if (mysqli_num_rows($chat_q) > 0) {
                $chat = mysqli_fetch_assoc($chat_q);
                $chat_name = $chat['chat_name'];
            }

            if ($get_key == 'invite') {
                $_SESSION['user']['invite'] = true;
                $contacts = $model_profile->contactList($_SESSION['user']['id']);
                while ($user = mysqli_fetch_assoc($contacts)) {
                    $contact_info = $model->contactInfo($user['contact_id']);
                    if (mysqli_num_rows($contact_info) > 0) {
                        $contact = mysqli_fetch_assoc($contact_info);
                        $contact['last_visit'] >= (date('Y-m-d H:i:s', strtotime(date('Y-m-d H:i:s') . ' -5 minutes'))) ? $status = 'ONLINE' : $status = 'offline';
                        $contacts_arr[$user['contact_id']] = [
                            'nickname' => $contact['nickname'],
                            'status' => $status,
                        ];
                    }
                }
            }

            if (is_numeric($get_key) && is_numeric($get_value)) {
                $invite_mess = __('join_chat') . " <a href=\'/chat/page?chat_id=" . $get_value . "\'>" . $chat_name ."</a>";
                $model->inviteToChat($_SESSION['user']['id'], $get_key, $invite_mess);

                header('Location: /chat/page?chat_id=' . $get_value);
            }
        } else {
            header('Location: /chat/chatlist');
        }

        $account_info = $model_profile->accountInfo($_SESSION['user']['id']);
        if (mysqli_num_rows($account_info) > 0) {
            $account = mysqli_fetch_assoc($account_info);
        }

        $view = new View();
        $view->render('chatpage.php', ['chat_name' => $chat_name, 'chat_id' => $get_value, 'contacts_arr' => $contacts_arr, 'account' => $account]);
    }

    public function messageLoad()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $model = new ChatModel();
            $result = $model->messageChatCount($_POST['chat_id']);
            $row = mysqli_fetch_assoc($result);
            $total_records = $row['total'];
            if ($total_records > 50) {
                $start = $total_records - 50;
                $messages = $model->selectMessages($_POST['chat_id'], $start, $total_records);
            } else {
                $messages = $model->selectMessages($_POST['chat_id'], 0, $total_records);
            }
            if (mysqli_num_rows($messages) > 0) {
                while ($messagearr = mysqli_fetch_assoc($messages)) {
                    $user_info = $model->contactInfo($messagearr['user_id']);
                    $name = mysqli_fetch_assoc($user_info);
                    if (isset($name)) {
                        echo ("<div class='container'>
                                    <img src=" . $name['avatar'] . " alt='' class='avatar'>
                                    <div class='mes_left'>
                                       <p>" . __('user'));
                        if ($messagearr['user_id'] == $_SESSION['user']['id']) {
                            echo ("<a href='/profile/info' target='_blank'>");
                        } elseif ($_SESSION['user']['id'] == '1') {
                            echo("<a href='/admin/content?memberedit=" . $name['id'] . "' target='_blank'>");
                        } else {
                            echo("<a href='/contact/profile?id=" . $name['id'] . "' target='_blank'>");
                        }
                        echo($name['nickname'] . "</a>" . __('says') . $messagearr['message'] .
                                       "</p>
                                    </div>");

                                    if($_SESSION['user']['id'] == $messagearr['user_id'] || $_SESSION['user']['id'] == '1') {
                                        echo ("
                                            <div class='mes_right'>
                                                <a href='/chat/messagedel?" . $messagearr['id'] . "=" . $_POST['chat_id'] . "'>
                                                    <img src='/public/assets/img/delete_icon.png' alt='' class='mess_icon'>
                                                </a>
                                                <a href='/chat/messageedit?" . $messagearr['id'] . "=" . $_POST['chat_id'] . "'>
                                                    <img src='/public/assets/img/edit_icon.png' alt='' class='mess_icon'>
                                                </a>
                                            </div>");
                                    }
                                    echo "</div>";
                    }
                }
            }
        }
    }

    public function membersOnline()
    {
        $model = new ChatModel();
        echo ("<div align='center'><b>" . __('online_users') . "</b></div>");
        echo ("<ul class='' style='list-style-type: none;'>");
        $member_list = $model->memberOnline($_POST['chat_id']);
        if (mysqli_num_rows($member_list) > 0) {
            while ($member_id = mysqli_fetch_assoc($member_list)) {
                $member_info = $model->contactInfo($member_id['user_id']);
                if (mysqli_num_rows($member_info) > 0) {
                    $member = mysqli_fetch_assoc($member_info);
                    if ($member['last_visit'] >= (date('Y-m-d H:i:s', strtotime(date('Y-m-d H:i:s') . ' -5 minutes'))) && $member['id'] != $_SESSION['user']['id']) {
                        echo("<a href='/contact/profile?id=" . $member['id'] . "' target='_blank'>
                                        <li class='justify-content-between align-items-center'>" . $member['nickname'] .
                            "</a>&nbsp;
                                        <span class='badge bg-primary rounded-pill'>ONLINE</span>
                                        </li>"
                        );
                    }
                }
            }
        }
        echo "</ul>";
    }

    public function messageDelete($get_key, $get_value)
    {
        $model = new ChatModel();
        $model->messageDelete($get_key);

        header('Location: /chat/page?chat_id=' . $get_value);
    }

    public function messageEdit($get_key, $get_value)
    {
        $model = new ChatModel();

        if (isset($_POST['new_message'])) {
            $model->messageEdit($_POST['new_message'], $_SESSION['user']['id_for_edit']);
        }

        if (isset($get_key) & is_numeric($get_key)) {
            $message_edit = $model->selectMessage($get_key);
            $message = mysqli_fetch_assoc($message_edit);
            if ($message_edit) {
                $_SESSION['user']['is_edit'] = true;
                $_SESSION['user']['id_for_edit'] = $get_key;
                $_SESSION['user']['mess_for_edit'] = $message['message'];
            }
        }
        header('Location: /chat/page?chat_id=' . $get_value);
    }
}
