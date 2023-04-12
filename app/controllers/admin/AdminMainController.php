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

    public function adminContent($get_content, $page)
    {
        self::adminPutContent($get_content);
        $action_name = $get_content . "Content";
        $page = $page ?? 1;
        $data = self::$action_name($page);
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
}