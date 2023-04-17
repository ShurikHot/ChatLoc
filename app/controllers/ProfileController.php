<?php

namespace app\controllers;

require_once 'Controller.php';
require_once 'View.php';
require_once 'app/models/ProfileModel.php';
require_once 'vendor/PHPMailer/src/Exception.php';
require_once 'vendor/PHPMailer/src/PHPMailer.php';
require_once 'vendor/PHPMailer/src/SMTP.php';

use app\models\Model;
use app\models\ProfileModel;
use PHPMailer\PHPMailer\PHPMailer;


class ProfileController extends Controller
{
    public function login()
    {
        $view = new View();
        $view->render('profile/registration.php', []);
    }

    public function signUp()
    {
        $model = new ProfileModel();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
            $name = filter_var(trim($_POST['name']),FILTER_SANITIZE_STRING);
            $nickname = filter_var(trim($_POST['nickname']),FILTER_SANITIZE_STRING);
            $password = $_POST['password'];
            $confirm_password = $_POST['confirm_password'];
            $phone_num = filter_var(trim($_POST['phone_num']), FILTER_SANITIZE_NUMBER_INT);
            $gender = $_POST['gender'];
            $country = filter_var(trim($_POST['country']),FILTER_SANITIZE_STRING);
            $language = $_POST['language'];
            if (isset($_POST['specialization'])) {
                $specialization = implode(',', $_POST['specialization']);
            } else {
                $specialization = "";
            }
            $comment = htmlspecialchars($_POST['comment']);

            $email_uniq = $model->checkEmail($email);

            if (mysqli_num_rows($email_uniq) > 1) {
                $_SESSION['message'] = '<h6 align="center">This email is in use by another user</h6>';
                header('Location: /');
            } elseif ($password === $confirm_password && $name != "" && $email != "" && $nickname != "" && $password != "") {
                $password = md5($password);
                $date = date('Y-m-d H:i:s');

                $member_singup = $model->memberSignup($email, $name, $nickname, $password, $phone_num, $gender, $country, $language, $specialization, $comment, $date);

                if($member_singup) {
                    $mail = new PHPMailer();
                    $mail->isSMTP();
                    $mail->Host = 'smtp.gmail.com';
                    $mail->SMTPAuth = true;
                    $mail->Username = 'youremail@gmail.com';
                    $mail->Password = 'yourpassword';
                    $mail->SMTPSecure = 'tls';
                    $mail->Port = 587;
                    $mail->setFrom('youremail@gmail.com', 'Your Name');
                    $mail->addAddress("$email");
                    $mail->Subject = '<b>Your registration data: </b><br>';
                    $mail->Body = 'Your Nickname: ' . $nickname . '<br> Your Password: '. $password;
                } else {
                    echo 'Message could not be sent. Mailer Error: ' . $mail->ErrorInfo;
                }
                $_SESSION['message'] = '<h6 align="center">Registration completed successfully <br> Please Check your email!</h6>';
                header('Location: /');
            } else {
                $_SESSION['message'] = '<h6 align="center">Some fields do not fill, </br>or the password and confirm password fields do not match</h6>';
                header('Location: /');
            }
        }
    }

    public function signIn()
    {
        $model = new ProfileModel();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $password = md5($_POST['password']);
            $check = $model->signInUser($email, $password);
            $_SESSION['user'] = [
                "id" => $check['id'],
                "nickname" => $check['nickname'],
                "email" => $check['email'],
                "language" => $check['language'],
                "avatar" => $check['avatar'],
                "blocked" => $check['blocked'],
                "change_language" => false,
                "black_list" => false,
                "chat_create" => false,
                "invite" => false,
                "is_edit" => false,
            ];
            $lang_page = $_SESSION['user']['language'];
            $lang_path = "app/views/languages/$lang_page.php";
            if (file_exists($lang_path)) {
                $_SESSION['user']['lang_text'] = include($lang_path);
            }
        }

        if (isset($_SESSION['user'])) {
            $model->lastVisit($_SESSION['user']['id']);

            $contacts = self::getContacts();
            $view = new View();
            //if ($_SESSION['user']['id'] == '1') {
            //    header('Location: /admin/content?members');
            //} else {
                $view->render('profile/profile.php', ['contacts' => $contacts]);
            //}
        } else {
            header('Location: /');
        }
    }

    public function uploadAvatar()
    {
        $model = new ProfileModel();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $folderPath = 'public/uploads/';
            $image_parts = explode(";base64,", $_POST['image']);
            $image_type_aux = explode("image/", $image_parts[0]);
            //$image_type = $image_type_aux[1]; ???
            $image_base64 = base64_decode($image_parts[1]);
            $file = $folderPath . uniqid() . '.png';
            file_put_contents($file, $image_base64);

            $_SESSION['user']['avatar'] = $file;
            $model->changeAvatar($file, $_SESSION['user']['id']);
        }
        echo json_encode(["image uploaded successfully."]);
    }

    public function editProfile($get_param)
    {
        $model = new ProfileModel();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['edit_nickname'])) {
                $_POST['edit_nickname'] = htmlspecialchars($_POST['edit_nickname']);
                $_SESSION['user']['edit_nickname'] = true;
                header('Location: /');
            }
            if (isset($_POST['actual_nickname'])) {
                $new_nickname = $_POST['actual_nickname'];

                $model->editProfile($new_nickname, $_SESSION['user']['id']);

                $_SESSION['user']['actual_nickname'] = $_POST['actual_nickname'];
                unset($_SESSION['user']['edit_nickname']);
            }
        }

        if ($get_param == 'lang') {
            $_SESSION['user']['change_language'] = true;

            $languages = $model->langList();
            while ($lang = mysqli_fetch_assoc($languages)) {
                $lang_list[] = $lang['language'];
            }

            $view = new View();
            $view->render('profile/profile.php', ['lang_list' => $lang_list]);
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['lang'])) {
            $new_lang = $_POST['lang'];

            $model->editLang($new_lang, $_SESSION['user']['id']);

            $_SESSION['user']['language'] = $_POST['lang'];
            $_SESSION['message'] = '<h6 align="center">' . $_SESSION['user']['lang_text']['change_language'] . '</h6>';
            $_SESSION['user']['change_language'] = false;
            header('Location: /');
        }
    }

    public function blackList($get_param)
    {
        $model = new ProfileModel();
        if ($get_param == 'black') {
            $_SESSION['user']['black_list'] = true;

            $contacts_blk = $model->blackList($_SESSION['user']['id']);

            if (mysqli_num_rows($contacts_blk) > 0) {
                while($user = mysqli_fetch_assoc($contacts_blk)) {
                    $contact_id = $user['contact_id'];

                    $contacts_info = $model->contactNick($contact_id);

                    if (mysqli_num_rows($contacts_info) > 0) {
                        $contact = mysqli_fetch_assoc($contacts_info);
                        $contact_black[$contact_id] = $contact['nickname'];
                    }
                }
            } else {
                $contact_black = [];
            }

            $contacts = self::getContacts();
            $view = new View();
            $view->render('profile/profile.php', ['contact_black' => $contact_black, 'contacts' => $contacts]);
        }

        if ($get_param == 'closeblack') {
            $_SESSION['user']['black_list'] = false;
            header('Location: /');
        }
    }

    public function deblockId($id)
    {
        $model = new ProfileModel();
        if (is_numeric($id)) {
            $model->deblockId($_SESSION['user']['id'], $id);
            header('Location: /profile/blacklist?black');
        }
    }

    public function searchMember()
    {
        $model = new ProfileModel();
        $_SESSION['user']['black_list'] = false;
        $_SESSION['user']['change_language'] = false;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $search_query = $_POST['find_member'];

            $search_res = $model->searchMember($search_query, $_SESSION['user']['id']);

            if (mysqli_num_rows($search_res) == 0) {
                echo("No match found");
            } else {
                while ($find_user = mysqli_fetch_assoc($search_res)) {
                    $find_id = $find_user['id'];
                    $find_info = $model->searchInfo($find_id);
                    if (mysqli_num_rows($find_info) > 0) {
                        $user = mysqli_fetch_assoc($find_info);
                        $user['last_visit'] >= (date('Y-m-d H:i:s', strtotime(date('Y-m-d H:i:s') . ' -5 minutes'))) ? $status = 'ONLINE' : $status = 'offline';
                        if ($find_id != $_SESSION['user']['id']) {
                            $find_arr[] = [
                                'id' => $find_id,
                                'nickname' => $user['nickname'],
                                'email' => $user['email'],
                                'last_visit' => $status,
                            ];
                        }
                    }
                }
            }
        } else {
            $find_arr = [];
        }
        $contacts = self::getContacts();
        $view = new View();
        $view->render('profile/profile.php', ['find_arr' => $find_arr, 'contacts' => $contacts]);
    }

    public function getContacts()
    {
        $model = new ProfileModel();
        $contact_q = $model->contactList($_SESSION['user']['id']);

        if (mysqli_num_rows($contact_q) > 0) {
            while ($user = mysqli_fetch_assoc($contact_q)) {
                $contact_id = $user['contact_id'];

                $message_arr = $model->persMessage($contact_id, $_SESSION['user']['id']);

                $count_unread = mysqli_num_rows($message_arr) > 0 ? "<span class='badge rounded-pill text-bg-success'>" . mysqli_num_rows($message_arr) . " </span>" : '';

                $contact_info = $model->searchInfo($contact_id);

                if (mysqli_num_rows($contact_info) > 0) {
                    $contact = mysqli_fetch_assoc($contact_info);
                    $contact['last_visit'] >= (date('Y-m-d H:i:s', strtotime(date('Y-m-d H:i:s') . ' -5 minutes'))) ? $status = 'ONLINE' : $status = 'offline';
                    $contact_arr[$contact_id] = [
                        'nickname' => $contact['nickname'],
                        'count_unread' => $count_unread,
                        'status' => $status,
                    ];
                }
            }
        } else {
            $contact_arr = [];
        }

        $contacts_appr_q = $model->contactApprList($_SESSION['user']['id']);

        if (mysqli_num_rows($contacts_appr_q) > 0) {
            while ($contact_appr = mysqli_fetch_assoc($contacts_appr_q)) {
                $contact_appr_id = $contact_appr['from_id'];

                $contact_appr_q = $model->contactNick($contact_appr_id);

                $contact_appr_assoc = mysqli_fetch_assoc($contact_appr_q);
                $contact_appr_arr[$contact_appr_id] = [
                    'nickname' => $contact_appr_assoc['nickname'],
                ];
            }
        } else {
            $contact_appr_arr = [];
        }
        return ['contact_arr' => $contact_arr, 'contact_appr_arr' => $contact_appr_arr];
    }

    public function logout()
    {
        unset($_SESSION['user']);
        header('Location: /');
    }
}