<?php
require_once 'app/controllers/ProfileController.php';
require_once 'app/controllers/ContactController.php';
require_once 'app/controllers/ChatController.php';
require_once 'app/controllers/admin/AdminMainController.php';

$url = isset($_GET['url']) ? $_GET['url'] : '';
$parts = explode('/', $url);

//var_dump($url);die();
if (isset(array_keys($_GET)[1])) {
    $get_param_key = array_keys($_GET)[1];
    $get_param_value = $_GET[$get_param_key];
    if ($get_param_value == "") $get_param_value = null;
} else {
    $get_param_key = "";
    $get_param_value = "";
}

if (isset(array_keys($_GET)[2])) {
    $get_second_param = array_keys($_GET)[2];
} else {
    $get_second_param = "";
}

if ((key_exists(0, $parts) && $parts[0] == "") || (key_exists(1, $parts) && $parts[1] == "")) {
    header('Location: /profile/login');
}
if ($parts[0] == "") $parts[0] = 'profile';
if (key_exists(1, $parts) && strlen($parts[1]) == 0) $parts[1] = 'info';

$controller = $parts[0] ?? 'profile';
$controller_if = $controller;
$action = $parts[1] ?? 'login';
$action_if = $action;

//var_dump($controller, $action);die();

switch ($controller) {
    case 'profile':
        $controller = new \app\controllers\ProfileController();
        break;
    case 'contact':
        $controller = new \app\controllers\ContactController();
        break;
    case 'chat':
        $controller = new \app\controllers\ChatController();
        break;
    case 'admin':
        $controller = new \app\controllers\admin\AdminMainController();
        break;
    default:
        header('Location: /public/404.html');
        die('Page not found!');
}

if ($controller_if == 'profile') {
    switch ($action) {
        /*ProfileController*/
        case 'registration':
            $controller->signUp();
            break;
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
        default:
            header('Location: /public/404.html');
            die('Page not found!');
    }
} elseif ($controller_if == 'contact') {
    switch ($action) {
        /*ContactController*/
        case 'profile':
            $controller->contactProfile($get_param_value);
            break;
        case 'action':
            $controller->contactActions($get_param_key, $get_param_value);
            break;
        default:
            header('Location: /public/404.html');
            die('Page not found!');
    }
} elseif ($controller_if == 'chat') {
    switch ($action) {
        /*ChatController*/
        case 'message':
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
        case 'messchatload':
            $controller->messageLoad();
            break;
        case 'membersonline':
            $controller->membersOnline();
            break;
        case 'messagedel':
            $controller->messageDelete($get_param_key, $get_param_value);
            break;
        case 'messageedit':
            $controller->messageEdit($get_param_key, $get_param_value);
            break;
        default:
            header('Location: /public/404.html');
            die('Page not found!');
    }
} elseif ($controller_if == 'admin') {
    switch ($action) {
        /*AdminMainController*/
        case 'main':
            $controller->adminMain();
            break;
        case 'content':
            //var_dump($get_param_key, $get_param_value);die();
            $controller->adminContent($get_param_key, $get_param_value, $get_second_param);
            break;
        case 'memberupdate':
            //var_dump($get_param_value, $get_second_param);die();
            $controller->membersUpdate($get_param_value, $get_second_param);
            break;
        case 'admincontact':
            $controller->contactAdminActions();
            break;
        case 'memberblock':
            $controller->memberBlock($get_param_key, $get_param_value, $get_second_param);
            break;
        case 'memberdel':
            $controller->memberDel($get_param_key, $get_param_value, $get_second_param);
            break;
        case 'chatdel':
            $controller->chatDel($get_param_key, $get_param_value);
            break;
        case 'chatapprove':
            $controller->chatApprove($get_param_key, $get_param_value);
            break;
        case 'faker':
            $controller->faker();
            break;
        default:
            header('Location: /public/404.html');
            die('Page not found!');
    }
} else {
    header('Location: /public/404.html');
    die('Page not found!');
}