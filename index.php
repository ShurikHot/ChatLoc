<?php
require_once 'app/controllers/ProfileController.php';
require_once 'app/controllers/ContactController.php';
require_once 'app/controllers/ChatController.php';

$url = isset($_GET['url']) ? $_GET['url'] : '';
$parts = explode('/', $url);

if (isset(array_keys($_GET)[1])) {
    $get_param_key = array_keys($_GET)[1];
    $get_param_value = $_GET[$get_param_key];
} else {
    $get_param_key = "";
    $get_param_value = "";
}
/*var_dump($get_param_key, $get_param_value);
die();*/

if ($parts[0] == "") $parts[0] = 'profile';
$controller = $parts[0] ?? 'profile';
$action = $parts[1] ?? 'login';
//var_dump($controller, $action);

switch ($controller) {
    case 'profile':
        $controller = new \app\controllers\ProfileController();
        break;
    case 'contact':
        //var_dump($controller);
        $controller = new \app\controllers\ContactController();
        break;
    case 'chat':
        $controller = new \app\controllers\ChatController();
        break;
    default:
        header('HTTP/1.1 404 Not Found');
        die('Page not found!!!!!!!!!!!!!!!');
}
switch ($action) {
    /*ProfileController*/
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
    case 'contacts':
        $controller->getContacts();
        break;
    case 'logout':
        $controller->logout();
        break;

    /*ContactController*/
    case 'profile':
        $controller->contactProfile($get_param_value);
        break;
    case 'action':
        $controller->contactActions($get_param_key, $get_param_value);
        break;

    /*ChatController*/
    case 'messpers':
        $controller->messageAdd();
        break;
    case 'messpersload':
        $controller->messagePersonalLoad();
        break;
    case 'chatlist':
        $controller->chatList($get_param_key);
        break;
    case 'page':
        $controller->chatPage($get_param_key, $get_param_value);
        break;


    default:
        header('HTTP/1.1 404 Not Found');
        die('Page not found!!!!!!!!!!!!!!!');
}