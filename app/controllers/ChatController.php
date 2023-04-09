<?php


namespace app\controllers;

require_once 'Controller.php';
require_once 'View.php';
require_once 'app/models/ChatModel.php';

use app\models\ChatModel;
use app\models\Model;
use app\models\ProfileModel;


class ChatController extends Controller
{
    public function messageAdd()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $model = new ChatModel();
            if (isset($_POST['chat_id']) && isset($_POST['message']) && $_POST['message'] != '') {
                $message = trim(htmlspecialchars($_POST['message']));
                $model->messageAdd($_SESSION['user']['id'], $message, $_POST['chat_id']);
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

                $_SESSION['message'] = $_SESSION['user']['lang_text']['create_chat_mess'];
                unset($_POST['create_chat']);
            }
        }

        $view = new View();
        $view->render('chats/chatlist.php', ['chat_arr' => $chat_arr]);
    }

    public function chatPage($get_key, $get_value)
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

        if (isset($get_key) && $get_key == 'chat_id' && is_numeric($get_value)) {
            $model = new ChatModel();
            $chat_q = $model->chatName($get_value);

            if (mysqli_num_rows($chat_q) > 0) {
                $chat = mysqli_fetch_assoc($chat_q);
                $chat_name = $chat['chat_name'];
            }
        } elseif () {

        } else {
            header('Location: /chat/chatlist');
        }

        $view = new View();
        $view->render('chats/chatpage.php', ['chat_name' => $chat_name, 'chat_id' => $get_value]); /*'chat_name' => $chat_name*/
    }
}

