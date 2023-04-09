<?php


namespace app\controllers;

require_once 'Controller.php';
require_once 'View.php';
require_once 'app/models/ContactModel.php';

use app\models\ContactModel;
use app\models\Model;


class ContactController extends Controller
{
    public function contactProfile($id)
    {
        $model = new ContactModel();
        if (isset($_SESSION['user'])) {
            $model->lastVisit($_SESSION['user']['id']);
        } else {
            header('Location: /');
        }

        if (is_numeric($id)) {
            $contact_info = $model->contactInfo($id);
            if (mysqli_num_rows($contact_info) > 0) {
                $contact = mysqli_fetch_assoc($contact_info);

                $contact_bl = $model->contactIsBlock($_SESSION['user']['id'], $id);

                if (mysqli_num_rows($contact_bl) > 0) {
                    $contact_is_bl = mysqli_fetch_assoc($contact_bl);
                } else {
                    $contact_is_bl['blocked'] = "";
                }

                $contact['last_visit'] >= (date('Y-m-d H:i:s', strtotime(date('Y-m-d H:i:s') . ' -5 minutes'))) ? $status = 'ONLINE' : $status = 'offline';
                $contact_arr[$id] = [
                    'email' => $contact['email'],
                    'nickname' => $contact['nickname'],
                    'avatar' => $contact['avatar'],
                    'status' => $status,
                    'blocked' => $contact_is_bl['blocked'],
                ];
            }

            $view = new View();
            $view->render('contact/contactprofile.php', ['contact_arr' => $contact_arr]);
        }
    }

    public function contactActions($key, $value)
    {
        $contact_q = new ContactModel();
        if ($key == 'delid' & is_numeric($value)) {
            $contact_q->contactDel($_SESSION['user']['id'], $value);
        }
        if ($key == 'id' & is_numeric($value)) {
            $contact = $contact_q->contactIs($_SESSION['user']['id'], $value);
            if (mysqli_num_rows($contact) == 0) {
                $mess = $_SESSION['user']['lang_text']['user'] . $_SESSION['user']['nickname'] . $_SESSION['user']['lang_text']['added_you'];
                $contact_q->contactAdd($_SESSION['user']['id'], $value, $mess);
            }
        }
        if ($key == 'blockid' & is_numeric($value)) {
            $contact_q->contactBlock($_SESSION['user']['id'], $value);
        }
        if ($key == 'deblockid' & is_numeric($value)) {
            $contact_q->contactDeblock($_SESSION['user']['id'], $value);
        }
        header('Location: /contact/profile?id=' . $value);
    }
}
