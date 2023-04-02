<?php
require_once 'app/controllers/ProfileController.php';

/*if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $url = $_SERVER['REQUEST_URI'];
}*/
/*ini_set('display_errors', 1);
error_reporting(E_ALL);*/

$url = isset($_GET['url']) ? $_GET['url'] : '';
//var_dump($_POST);
//die();
$parts = explode('/', $url);

if ($parts[0] == "") $parts[0] = 'profile';
$controller = $parts[0] ?? 'profile';
$action = $parts[1] ?? 'login';

switch ($controller) {
    case 'profile':
        $controller = new \app\controllers\ProfileController();

        break;
    case 'chat':
        $controller = new \app\controllers\ChatController();
        break;
    case 'contact':
        $controller = new \app\controllers\ContactController();
        break;
    default:
        header('HTTP/1.1 404 Not Found');
        die('Page not found!!!!!!!!!!!!!!!');
}
//
switch ($action) {
    case 'uploadavatar':
        $controller->uploadavatar();
        //var_dump($_POST);
        //die();
        break;
    case 'login':
        $controller->login();
        break;
    case 'info':
        $controller->signin();
        break;
    case 'logout':
        $controller->logout();
        break;
    default:
        header('HTTP/1.1 404 Not Found');
        die('Page not found!!!!!!!!!!!!!!!');
}