<?php
require_once 'app/config/db.php';
require_once 'app/config/params.php';

ini_set('session.gc_maxlifetime', $session_lifetime);
ini_set('session.gc_probability', 1);
ini_set('session.gc_divisor', 1);
session_start();
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $_SESSION['user']['lang_text']['chat_list'] ?></title>
    <link href="/public/assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="text-center">
<ul class="nav justify-content-center">
    <li class="nav-item">
        <?php if (isset($_SESSION['user']['blocked']) && $_SESSION['user']['blocked']): ?>
            <a class="btn btn-warning" aria-current="page"href=""><b><?= $_SESSION['user']['lang_text']['your_account_blocked'] ?></b></a>
        <?php endif; ?>
    </li>
    <li class="nav-item">
        <a class="btn btn-primary" href="profile.php"><?= $_SESSION['user']['lang_text']['go_to_profile'] ?></a>
    </li>

    <?php if (isset($_SESSION['user']['email']) && $_SESSION['user']['email'] === 'admin@admin.com'): ?>
        <li class="nav-item">
            <a class="btn btn-success" href="admin/index.php"><?= $_SESSION['user']['lang_text']['admin_area'] ?></a>
        </li>
    <?php endif; ?>
    <li class="nav-item">
        <a class="btn btn-danger" href="vendor/logout.php"><?= $_SESSION['user']['lang_text']['logout'] ?></a>
    </li>
</ul>

</body>

    <br>
    <h4>
        <b><?= $_SESSION['user']['lang_text']['chat_list'] ?></b>
    </h4>
    <ul class="list-group" style="list-style-type: none;">
        <div style="border: #0a0e14 solid 1px; width: 1000px; max-height: 700px; margin: auto">
<?php

if (isset($_SESSION['user']['blocked']) && !$_SESSION['user']['blocked']) {
    $chats = mysqli_query($connect, "SELECT * FROM `chats` WHERE `approved` = 1");
    if (mysqli_num_rows($chats) > 0) {
        while ($chat = mysqli_fetch_assoc($chats)) {
            $author_id = $chat['author'];
            $query_author = mysqli_query($connect, "SELECT `nickname` FROM `members` WHERE `id` = $author_id");
            $author = mysqli_fetch_assoc($query_author);
            echo("<a href='chatpage.php?chat_id=" . $chat['id'] . "'>
                     <li class='justify-content-between align-items-center'>" . $chat['chat_name'] .
                 "</a> (<i>" . $_SESSION['user']['lang_text']['author'] . "</i> <b>" . $author['nickname'] . "</b>)
                     </li>"
            );
        }
    }
}
?>
        </div>
    </ul>
<br>
<h6><a href="chatlist.php?create"><?= $_SESSION['user']['lang_text']['create_chat'] ?></a></h6>
<form action="chatlist.php" method="post" <?php if(!isset($_GET['create'])) echo "hidden";?> >
    <input type="text" name="create_chat" style="width: 400px" placeholder="<?= $_SESSION['user']['lang_text']['enter_chat_name'] ?>">
    <button type="submit" class="btn btn-primary"><?= $_SESSION['user']['lang_text']['create'] ?></button>
</form>

<p align="center">
    <?php
    if (isset($_SESSION['message'])) {
        echo $_SESSION['message'];
        unset($_SESSION['message']);
    }
    ?>
</p>

<?php
    if(isset($_POST['create_chat'])) {
        $chat_name = filter_var(trim($_POST['create_chat']),FILTER_SANITIZE_STRING);
        $user_id = $_SESSION['user']['id'];
        mysqli_query($connect, "INSERT INTO `chats`(`chat_name`, `author`) VALUES ('$chat_name', $user_id)");
        $_SESSION['message'] = $_SESSION['user']['lang_text']['create_chat_mess'];
        unset($_POST['create_chat']);
        header('Location: /chatlist.php');
    }
?>