<?php


namespace app\controllers\admin;

use app\controllers\Controller;
use app\controllers\View;
use app\models\admin\AdminModel;
use app\models\Model;

require_once 'app/controllers/Controller.php';
require_once 'app/controllers/View.php';
require_once 'app/models/admin/AdminModel.php';


class AdminMainController extends Controller
{
    public function adminMain()
    {
        $view = new View();
        $view->render('admin/admin.php');
    }

    public function adminPutContent($content)
    {
        if (isset($content) && $content != "") {
            $content_path = "app/views/admin/pages/$content.php";
            $content_data = file_get_contents($content_path);
            if (file_exists($content_path)) {
                file_put_contents("app/views/admin/content.php", $content_data);
            }
            $_SESSION['user']['admin_category'] = $content;
        }
    }

    public function adminContent($get_content, $get_value)
    {
        self::adminPutContent($get_content);
        $action_name = $get_content . "Content";

        if ($get_content == 'memberedit') {
            $data = self::$action_name($get_value, $_SESSION['user']['admin_member_edit']['page']);
        } else {
            $_SESSION['user']['admin_member_edit']['page'] = null;
            $get_value = $get_value ?? 1;
            $_SESSION['user']['admin_member_edit']['page'] = $get_value;
            $data = self::$action_name($get_value);
        }
/*var_dump($data);
die();*/
        $view = new View();
        $view->render('admin/admin.php', ['data' => $data, 'content' => $get_content]);
    }
    
    
    public function membersContent($page)
    {
        $records_per_page = 10;
        $current_page = $page ?? 1;
        $_SESSION['user']['page_get'] = $current_page;
        $start = ($current_page - 1) * $records_per_page;

        $model = new AdminModel();
        $members_info = $model-> membersList($start, $records_per_page);

        if (mysqli_num_rows($members_info) > 0) {
            while ($member = mysqli_fetch_assoc($members_info)) {
                $members[$member['id']] = [
                    'email' => $member['email'],
                    'name' => $member['name'],
                    'nickname' => $member['nickname'],
                    'avatar' => $member['avatar'],
                    'blocked' => $member['blocked'],
                ];
            }
        }
        $count_total = $model->countMembers();        
        $row = mysqli_fetch_assoc($count_total);
        $total_records = $row['total'];
        $total_pages = ceil($total_records / $records_per_page);
        
        return ['members' => $members, 'current_page' => $current_page, 'total_pages' => $total_pages];
    }

    public function chatlistContent($page)
    {
        $records_per_page = 10;
        $current_page = $page ?? 1;
        $_SESSION['user']['page_get'] = $current_page;
        $start = ($current_page - 1) * $records_per_page;

        $model = new AdminModel();
        $chats_info = $model-> chatsList($start, $records_per_page);

        if (mysqli_num_rows($chats_info) > 0) {
            while ($chat = mysqli_fetch_assoc($chats_info)) {
                $author_info = $model->authorInfo($chat['author']);
                $author = mysqli_fetch_assoc($author_info);
                $chats[$chat['id']] = [
                    'chat_name' => $chat['chat_name'],
                    'author_id' => $chat['author'],
                    'nickname' => $author['nickname'],
                ];
            }
        }

        $count_total = $model->countChats();
        $row = mysqli_fetch_assoc($count_total);
        $total_records = $row['total'];
        $total_pages = ceil($total_records / $records_per_page);

        return ['chats' => $chats, 'current_page' => $current_page, 'total_pages' => $total_pages];
    }

    public function chatapproveContent($page)
    {
        $records_per_page = 10;
        $current_page = $page ?? 1;
        $_SESSION['user']['page_get'] = $current_page;
        $start = ($current_page - 1) * $records_per_page;

        $model = new AdminModel();
        $chats_info = $model-> chatsApproveList($start, $records_per_page);
        if (mysqli_num_rows($chats_info) > 0) {
            while ($chat = mysqli_fetch_assoc($chats_info)) {
                $author_info = $model->authorInfo($chat['author']);
                $author = mysqli_fetch_assoc($author_info);
                $chats[$chat['id']] = [
                    'chat_name' => $chat['chat_name'],
                    'author_id' => $chat['author'],
                    'nickname' => $author['nickname'],
                ];
            }
        }

        $count_total = $model->countApproveChats();
        $row = mysqli_fetch_assoc($count_total);
        $total_records = $row['total'];
        $total_pages = ceil($total_records / $records_per_page);

        return ['chats' => $chats, 'current_page' => $current_page, 'total_pages' => $total_pages];
    }

    public function blockedContent($page)
    {
        $records_per_page = 10;
        $current_page = $page ?? 1;
        $_SESSION['user']['page_get'] = $current_page;
        $start = ($current_page - 1) * $records_per_page;

        $model = new AdminModel();
        $members_info = $model-> blockedMemberList($start, $records_per_page);
        if (mysqli_num_rows($members_info) > 0) {
            while ($member = mysqli_fetch_assoc($members_info)) {
                $members[$member['id']] = [
                    'email' => $member['email'],
                    'name' => $member['name'],
                    'nickname' => $member['nickname'],
                    'avatar' => $member['avatar'],
                    'blocked' => $member['blocked'],
                ];
            }
        }
        $count_total = $model->countBlockedMembers();
        $row = mysqli_fetch_assoc($count_total);
        $total_records = $row['total'];
        $total_pages = ceil($total_records / $records_per_page);

        return ['members' => $members, 'current_page' => $current_page, 'total_pages' => $total_pages];
    }

    public function statisticsContent($page)
    {
        $model = new AdminModel();
        $statistic = $model->statisticMember();

        $data = array();
        while ($row = mysqli_fetch_assoc($statistic)) {
            $datetime = "new Date(" . date('Y, n-1, j, G, i, s', strtotime($row['hour'])) . ")";
            $data[] = array(
                $datetime,
                intval($row['count'])
            );
        }
        $data_json = json_encode($data);
        $data_json = str_replace('"','',$data_json);

        return $data_json;
    }

    public function membereditContent($user_id, $page)
    {
        if (is_numeric($user_id)) {
            $model = new AdminModel();
            $member_info = $model->memberInfo($user_id);

            if (mysqli_num_rows($member_info) > 0) {
                $user = mysqli_fetch_assoc($member_info);
                $_SESSION['user']['admin_member_edit'] = [
                    "id" => $user['id'],
                    "blocked" => $user['blocked'],
                    "email" => $user['email'],
                    "name" => $user['name'],
                    "nickname" => $user['nickname'],
                    "phone_num" => $user['phone_num'],
                    "avatar" => $user['avatar'],
                    "gender" => $user['gender'],
                    "country" => $user['country'],
                    "language" => $user['language'],
                    "specialization" => $user['specialization'],
                ];
            }
            $contact = $model->contactIs($_SESSION['user']['admin_member_edit']['id']);
            mysqli_num_rows($contact) > 0 ? $iscontact = true : $iscontact = false;
        }
        return ['iscontact' => $iscontact, 'page' => $page];
    }

    public function membersUpdate($page)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userid = $_POST['userid'];
            $blocked = $_POST['blocked'];
            $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
            $name = filter_var(trim($_POST['name']),FILTER_SANITIZE_STRING);
            $nickname = filter_var(trim($_POST['nickname']),FILTER_SANITIZE_STRING);
            $phone_num = filter_var(trim($_POST['phone_num']), FILTER_SANITIZE_NUMBER_INT);
            $avatar = filter_var(trim($_POST['avatar']), FILTER_SANITIZE_STRING);
            $gender = $_POST['gender'];
            $country = filter_var(trim($_POST['country']),FILTER_SANITIZE_STRING);
            $language = $_POST['language'];
            $specialization = filter_var(trim($_POST['specialization']),FILTER_SANITIZE_STRING);

            if ($name != "" && $email != "" && $nickname != "") {
                $model = new AdminModel();
                $model->updateMember($blocked, $email, $name, $nickname, $phone_num, $avatar, $gender, $country, $language, $specialization, $userid);
            }
        }
        header('Location: /admin/content?members=' . $page);
    }

    public function settingsContent($page)
    {
        return true;
    }
}