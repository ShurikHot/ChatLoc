<?php

namespace app\controllers;

require_once 'Controller.php';
require_once 'View.php';
require_once 'app/models/ProfileModel.php';

use app\models\Model;
use app\models\ProfileModel;


class ProfileController extends Controller
{
    public function login()
    {
        $view = new View();
        $view->render('profile/registration.php', []);
    }

    public function signIn()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $password = md5($_POST['password']);
            $checkUser = new ProfileModel();
            $check = $checkUser->signinUser($email, $password);
            $_SESSION['user'] = [
                "id" => $check['id'],
                "nickname" => $check['nickname'],
                "email" => $check['email'],
                "language" => $check['language'],
                "avatar" => $check['avatar'],
                "blocked" => $check['blocked'],
                "change_language" => false,
                "black_list" => false,
            ];
            $lang_page = $_SESSION['user']['language'];
            $lang_path = "app/views/languages/$lang_page.php";
            if (file_exists($lang_path)) {
                $_SESSION['user']['lang_text'] = include($lang_path);
            }
        }

        if (isset($_SESSION['user'])) {
            $setvisit = new ProfileModel();
            $setvisit->lastVisit($_SESSION['user']['id']);

            $view = new View();
            $view->render('profile/profile.php', $_SESSION['user']);
        } else {
            header('Location: /');
        }

    }

    public function uploadAvatar()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $folderPath = 'public/uploads/';
            $image_parts = explode(";base64,", $_POST['image']);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);
            $file = $folderPath . uniqid() . '.png';
            file_put_contents($file, $image_base64);

            $_SESSION['user']['avatar'] = $file;
            $change_avatar = new ProfileModel();
            $change_avatar->changeAvatar($file, $_SESSION['user']['id']);
        }
        echo json_encode(["image uploaded successfully."]);
    }

    public function editProfile($get_param)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['edit_nickname'])) {
                $_POST['edit_nickname'] = htmlspecialchars($_POST['edit_nickname']);
                $_SESSION['user']['edit_nickname'] = true;
                header('Location: /');
            }
            if (isset($_POST['actual_nickname'])) {
                $new_nickname = $_POST['actual_nickname'];


                $edit_profile = new ProfileModel();
                $edit_profile->editProfile($new_nickname, $_SESSION['user']['id']);

                $_SESSION['user']['actual_nickname'] = $_POST['actual_nickname'];
                unset($_SESSION['user']['edit_nickname']);
            }
        }

        if ($get_param == 'lang') {
            $_SESSION['user']['change_language'] = true;

            $lang_q = new ProfileModel();
            $languages = $lang_q->langList();
            while ($lang = mysqli_fetch_assoc($languages)) {
                $lang_list[] = $lang['language'];
            }

            $view = new View();
            $view->render('profile/profile.php', ['lang_list' => $lang_list]);
            header('Location: /');
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['lang'])) {
            $new_lang = $_POST['lang'];

            $edit_lang = new ProfileModel();
            $edit_lang->editLang($new_lang, $_SESSION['user']['id']);

            $_SESSION['user']['language'] = $_POST['lang'];
            $_SESSION['message'] = '<h6 align="center">' . $_SESSION['user']['lang_text']['change_language'] . '</h6>';
            $_SESSION['user']['change_language'] = false;
            header('Location: /');
        }
    }

    public function blackList($get_param)
    {
        if ($get_param == 'black') {
            $_SESSION['user']['black_list'] = true;

            $black_q = new ProfileModel();
            $contacts_blk = $black_q->blackList($_SESSION['user']['id']);

            if (mysqli_num_rows($contacts_blk) > 0) {
                while($user = mysqli_fetch_assoc($contacts_blk)) {
                    $contact_id = $user['contact_id'];

                    $contact_q = new ProfileModel();
                    $contacts_info = $contact_q->contactNick($contact_id);

                    if (mysqli_num_rows($contacts_info) > 0) {
                        $contact = mysqli_fetch_assoc($contacts_info);
                        $contact_black[$contact_id] = $contact['nickname'];
                    }
                }
            }
            $view = new View();
            $view->render('profile/profile.php', ['contact_black' => $contact_black]);
        }

        if ($get_param == 'closeblack') {
            $_SESSION['user']['black_list'] = false;
            header('Location: /');
        }
    }

    public function deblockId($id)
    {
        /*var_dump($id);
        die();*/
        if (is_numeric($id)) {
            $deblock_q = new ProfileModel();
            $deblock_q->deblockId($_SESSION['user']['id'], $id);
            header('Location: /profile/blacklist?black');
        }
    }

    public function searchMember()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $search_query = $_POST['find_member'];

            $search_q = new ProfileModel();
            $search_res = $search_q->searchMember($search_query, $_SESSION['user']['id']);

            if (mysqli_num_rows($search_res) == 0) {
                echo("No match found");
            } else {

            }
            /*if (isset($_POST['find_member'])) {

                $query = mysqli_query($connect, "SELECT `id` FROM `members` WHERE (`nickname` LIKE '%$search_query%') OR (`email` LIKE '%$search_query%') AND `id` <> $id");

                    while ($find_user = mysqli_fetch_assoc($query)) {
                        $find_id = $find_user['id'];
                        $query2 = mysqli_query($connect, "SELECT `nickname`, `email`, `last_visit` FROM `members` WHERE `id` = $find_id");
                        if (mysqli_num_rows($query2) > 0) {
                            $user = mysqli_fetch_assoc($query2);
                            $user['last_visit'] >= (date('Y-m-d H:i:s', strtotime(date('Y-m-d H:i:s') . ' -5 minutes'))) ? $status = 'ONLINE' : $status = 'offline';
                            if ($find_id != $_SESSION['user']['id']) {
                                echo("<a href='vendor/contactprofile.php?id=" . $find_id . "'>
                                            <li class='justify-content-between align-items-center'>" . $user['nickname'] . " - " . $user['email'] .
                                    "</a>&nbsp;
                                            <span class='badge bg-primary rounded-pill'>" . $status . "</span>
                                            </li>"
                                );
                            }
                        }
                    }
                }
            }*/
    }
    }

    public function logout()
    {
        unset($_SESSION['user']);
        header('Location: /');
    }


}