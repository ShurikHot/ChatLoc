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
        if (is_numeric($id)) {
            $contact_q = new ContactModel();
            $contact_info = $contact_q->contactInfo($id);

            if (mysqli_num_rows($contact_info) > 0) {
                $contact = mysqli_fetch_assoc($contact_info);

                $contact_bl_q = new ContactModel();
                $contact_bl = $contact_bl_q->contactIsBlock($_SESSION['user']['id'], $id);

                if (mysqli_num_rows($contact_bl) > 0) {
                    $contact_is_bl = mysqli_fetch_assoc($contact_bl);
                } else {
                    $contact_is_bl = "";
                }

                $contact['last_visit'] >= (date('Y-m-d H:i:s', strtotime(date('Y-m-d H:i:s') . ' -5 minutes'))) ? $status = 'ONLINE' : $status = 'offline';
                $contact_arr[$id] = [
                    'email' => $contact['email'],
                    'nickname' => $contact['nickname'],
                    'avatar' => $contact['avatar'],
                    'status' => $status,
                    'block' => $contact_is_bl['blocked'],
                ];
            }



        }

        if (isset($_SESSION['user'])) {
            $setvisit = new ContactModel();
            $setvisit->lastVisit($_SESSION['user']['id']);

            $view = new View();
            $view->render('/contact/contactprofile.php', ['contact_arr' => $contact_arr]);

        } else {
            header('Location: /');
        }
    }


}
