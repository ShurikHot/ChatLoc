<?php


namespace app\controllers\admin;

use app\controllers\Controller;
use app\controllers\View;

require_once 'app/controllers/Controller.php';
require_once 'app/controllers/View.php';


class AdminMainController extends Controller
{
    public function adminMain()
    {
        $view = new View();
        $view->render('admin/admin.php');
    }

    public function adminContent($content)
    {
        if (isset($content) && $content != "") {
            $content_path = "app/views/admin/pages/$content.php";
            $content_data = file_get_contents($content_path);
            if (file_exists($content_path)) {
                file_put_contents("app/views/admin/content.php", $content_data);
            }
            $_SESSION['user']['admin_category'] = $content;
        }
        header('Location: /admin/main');
    }

    public function membersContent()
    {
        $records_per_page = 10;
        $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
        $_SESSION['user']['page_get'] = $current_page;
        $start = ($current_page - 1) * $records_per_page;

        $users = mysqli_query($connect, "SELECT `id`, `name`, `nickname`, `email`, `avatar`, `blocked` FROM `members` LIMIT $start, $records_per_page");
    }
}