<?php
require_once 'app/controllers/ProfileController.php';

$url = isset($_GET['url']) ? $_GET['url'] : '';
$parts = explode('/', $url);

if (isset(array_keys($_GET)[1])) {
    $get_param_key = array_keys($_GET)[1];
    $get_param_value = $_GET[$get_param_key];
    /*var_dump($get_param_key, $get_param_value);
    die();*/
} else {
    $get_param_key = "";
    $get_param_value = "";
}

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

switch ($action) {
    case 'login':
        $controller->login();
        break;
    case 'info':
        $controller->signIn();
        break;
    case 'uploadavatar':
        $controller->uploadAvatar();
        break;
    case 'profileedit':
        $controller->editProfile($get_param_key);
        break;
    case 'blacklist':
        $controller->blackList($get_param_key);
        break;
    case 'deblockid':
        $controller->deblockId($get_param_value);
        break;
    case 'searchmember':
        $controller->searchMember();
        break;

    case 'logout':
        $controller->logout();
        break;
    default:
        header('HTTP/1.1 404 Not Found');
        die('Page not found!!!!!!!!!!!!!!!');
}