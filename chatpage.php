<?php
require_once 'vendor/db.php';
require_once 'vendor/admin/params.php';

ini_set('session.gc_maxlifetime', $session_lifetime);
ini_set('session.gc_probability', 1);
ini_set('session.gc_divisor', 1);
session_start();

$id = $_SESSION['user']['id'];
$query_visit = mysqli_query($connect, "UPDATE `members` SET `last_visit` = NOW() WHERE `id` = $id");

if (!isset($_GET['chat_id']) || !is_numeric($_GET['chat_id'])) header('Location: /chatlist.php');

$chat_id_get = isset($_GET['chat_id']) ? $_GET['chat_id'] : "";
$query_chat = mysqli_query($connect, "SELECT * FROM `chats` WHERE `id` = $chat_id_get");
if (mysqli_num_rows($query_chat) > 0) {
    $chat = mysqli_fetch_assoc($query_chat);
    $chat_name = $chat['chat_name'];
}

if(!isset($_SESSION['user'])) {
    header('Location: /index.php');
}
if (isset($_SESSION['user']['blocked']) && $_SESSION['user']['blocked']){
    header('Location: /profile.php');
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ChatLoc</title>

    <link href="/assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="/assets/css/chatpage.css" rel="stylesheet">
    <script src="/assets/js/jquery3.6.3.min.js"></script>
    <script src="/assets/js/emojionearea.js"></script>
    <link rel="stylesheet" href="/assets/css/emojionearea.css" />
    <style>
        #wrap {
            background-color: <?= $chat_background_color ?>
        }
    </style>
</head>
<body>

<ul class="nav justify-content-center">
    <li class="nav-item">
        <?php if (isset($_SESSION['user']['blocked']) && !$_SESSION['user']['blocked']): ?>
            <a class="btn btn-info" aria-current="page" href="chatlist.php">Go to <b>Chat List</b></a>
        <?php elseif (isset($_SESSION['user']['blocked']) && $_SESSION['user']['blocked']): ?>
            <a class="btn btn-warning" aria-current="page"href=""><b>!!Your account is blocked!!</b></a>
        <?php endif; ?>
    </li>
    <li class="nav-item">
        <a class="btn btn-primary" href="profile.php">Go to your&nbsp;<b>Profile</b></a>
    </li>
    <?php if (isset($_SESSION['user']['email']) && $_SESSION['user']['email'] === 'admin@admin.com'): ?>
        <li class="nav-item">
            <a class="btn btn-success" href="admin/index.php">Admin Area</a>
        </li>
    <?php endif; ?>
    <li class="nav-item">
        <a class="btn btn-danger" href="vendor/logout.php">Logout</a>
    </li>
</ul>


<h1 align="center">ChatLoc Page</h1>
<h2 align="center"><?= $chat_name ?></h2>
<div>
    <div class="wrap" id="wrap" style="display: inline-block;">
        <!-- CHAT -->
    </div>
    <div class="members_online" id="members_online" style="display: inline-block; vertical-align: top;">
        <!-- MEMBERS ONLINE -->
    </div>
</div>
<br>
<form method="post" id="sendmess" onsubmit="return false">
    <textarea class="enter_mess" type="text" name="message" id="message" placeholder="Enter your message..." rows="1"></textarea>
    <button type="submit" class="btn btn-primary">Send</button>
    <br><br>
</form>
<?php
if (key_exists('is_edit', $_SESSION['user'])) :
    ?>
    <form method="post" action="vendor/messageedit.php?chat_id=<?= $chat_id_get ?>">
        <textarea class="enter_mess" name="new_message" rows="1"><?= $_SESSION['user']['mess_for_edit'] ?></textarea>
        <button type="edit" class="btn btn-success">Edit</button>
        <button type="cancel" class="btn btn-secondary">Cancel</button>
    </form>
    <?php
    unset($_SESSION['user']['is_edit']);
endif; ?>

<script>
    $("document").ready(function(){
        $("#sendmess").on("submit", function (){
            let dataFormArray = $(this).serializeArray();
            dataFormArray.push({name: "chat_id", value: "<?= $chat_id_get ?>"});
            let dataForm = $.param(dataFormArray);
            $.ajax({
                url: 'vendor/messageadd.php',
                method: 'post',
                dataType: 'html',
                data: dataForm,
                success: function (data){
                    load_mess();
                    $('.emojionearea-editor').html('');
                }
            });
        })
    })

    $('#message').emojioneArea({
        pickerPosition: 'bottom'
    });

    function load_mess()
    {
        $.ajax({
            method: 'POST',
            url: 'vendor/messageload.php',
            data: "req=ok&chat_id=<?= $chat_id_get ?>",
            success: function(html)
            {
                $("#wrap").empty();
                $("#wrap").html(html);
                $("#wrap").scrollTop(90000);
            }
        });
    }
    function load_online_members()
    {
        $.ajax({
            method: 'POST',
            url: 'vendor/members_online.php',
            data: "req=ok&chat_id=<?= $chat_id_get ?>",
            success: function(html)
            {
                $("#members_online").empty();
                $("#members_online").html(html);
                $("#members_online").scrollTop(90000);
            }
        });
    }

</script>

<script src="assets/js/index.js"></script>
<script>
    load_mess();
    load_online_members();
    setInterval(load_mess,5000);
    setInterval(load_online_members,30000);
</script>

</body>
</html>