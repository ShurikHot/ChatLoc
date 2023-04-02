<?php
require_once 'app/config/db.php';
require_once 'app/config/params.php';

ini_set('session.gc_maxlifetime', $session_lifetime);
ini_set('session.gc_probability', 1);
ini_set('session.gc_divisor', 1);
session_start();

if(!isset($_SESSION['user']['id'])) {
    header('Location: ../index.php');
}

$id = $_SESSION['user']['id'];
$query_visit = mysqli_query($connect, "UPDATE `members` SET `last_visit` = NOW() WHERE `id` = $id");

if (isset($_GET['id']) & is_numeric($_GET['id'])) {
    $id = $_GET['id'];
    $query = mysqli_query($connect,"SELECT `id`, `email`, `nickname`, `avatar`, `last_visit` FROM `members` WHERE `id` = $id");
    $user = mysqli_fetch_assoc($query);
}
$user['last_visit'] >= (date('Y-m-d H:i:s', strtotime(date('Y-m-d H:i:s') . ' -5 minutes'))) ? $status = 'ONLINE' : $status = 'offline';
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $user['nickname'] ?> | <?= $_SESSION['user']['lang_text']['contact_profile'] ?></title>
    <link href="../public/assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../public/assets/css/chatpage.css" rel="stylesheet">
    <script src="../public/assets/js/jquery3.6.3.min.js"></script>
    <script src="../public/assets/js/emojionearea.js"></script>
    <link rel="stylesheet" href="../public/assets/css/emojionearea.css" />
</head>
<body class="text-center">


<ul class="nav justify-content-center">
    <li class="nav-item">
        <?php if (isset($_SESSION['user']['blocked']) && !$_SESSION['user']['blocked']): ?>
            <a class="btn btn-info" aria-current="page" href="../chatlist.php"><?= $_SESSION['user']['lang_text']['go_to_chatlist'] ?></a>
        <?php elseif (isset($_SESSION['user']['blocked']) && $_SESSION['user']['blocked']): ?>
            <a class="btn btn-warning" aria-current="page"href=""><b><?= $_SESSION['user']['lang_text']['your_account_blocked'] ?></b></a>
        <?php endif; ?>
    </li>
    <li class="nav-item">
        <a class="btn btn-primary" href="../profile.php"><?= $_SESSION['user']['lang_text']['go_to_profile'] ?></a>
    </li>
    <?php if (isset($_SESSION['user']['email']) && $_SESSION['user']['email'] === 'admin@admin.com'): ?>
        <li class="nav-item">
            <a class="btn btn-success" href="../admin/index.php"><?= $_SESSION['user']['lang_text']['admin_area'] ?></a>
        </li>
    <?php endif; ?>
    <li class="nav-item">
        <a class="btn btn-danger" href="../vendor/logout.php"><?= $_SESSION['user']['lang_text']['logout'] ?></a>
    </li>
</ul>

<h1 align="center" class=""><?= $user['nickname'] ?> | <?= $_SESSION['user']['lang_text']['contact_profile'] ?></h1>
<?php
    if(isset($user['avatar'])) : ?>
    <img src="<?= $user['avatar'] ?>" alt="" style="display: inline">
<?php
     else :
?>
    <img src="public/uploads/avatar-uni.png" alt="" style="width: 150px; height: 150px; display: inline">
<?php
    endif;
?>
<br>

<script src="../public/assets/js/bootstrap.min.js"></script>

<h6><?= $_SESSION['user']['lang_text']['nickname'] ?><b> <?= $user['nickname']?> </b> <span class='badge bg-primary rounded-pill'> <?= $status ?></span> </h6>


<h6><?= $_SESSION['user']['lang_text']['email'] ?><?= $user['email'] ?></h6>

<?php
    $user_id = $_SESSION['user']['id'];
    $contact_id = $user['id'];
    $query = mysqli_query($connect,"SELECT `id`, `blocked` FROM `contacts` WHERE `user_id` = $user_id AND `contact_id` = $contact_id");
    if (mysqli_num_rows($query) > 0) :
        $query_assoc = mysqli_fetch_assoc($query);
?>
        <?= $_SESSION['user']['lang_text']['user_already'] ?> <a href="contactadd.php?delid=<?= $user['id'] ?>"><?= $_SESSION['user']['lang_text']['delete_it'] ?></a>
        <?php if ($query_assoc['blocked'] == 0): ?>
            <a href="contactadd.php?blockid=<?= $user['id'] ?>" style="color: red">Or Block?</a>
        <?php else: ?>
            <a href="contactadd.php?deblockid=<?= $user['id'] ?>" style="color: red">Deblock?</a>
        <?php endif; ?>
    <br><br>
    <form method="post" id="sendmess" onsubmit="return false">
        <textarea class="" type="text" name="personal_message" id="personal_message" placeholder="<?= $_SESSION['user']['lang_text']['enter_message'] ?>" rows="1"></textarea>
        <button type="submit" class="btn btn-primary"><?= $_SESSION['user']['lang_text']['send'] ?></button>
    </form>

    <div class="wrap" id="wrap" style="height: 300px; width: 600px; display: inline-block">
        <!-- CHAT -->
    </div>
<?php
    else :
?>
    <a href="contactadd.php?id=<?= $user['id'] ?>"><?= $_SESSION['user']['lang_text']['add_contact'] ?></a>
    <br><br>
    <form method="post" id="sendmess">
        <textarea class="enter_mess" type="text" name="" id="" placeholder="<?= $_SESSION['user']['lang_text']['enter_message_must'] ?>" rows="1" disabled></textarea>
        <button type="submit" disabled><?= $_SESSION['user']['lang_text']['send'] ?></button>
    </form>
<?php
    endif;
?>

<script>
    $("document").ready(function(){
        $("#sendmess").on("submit", function (){
            let dataFormArray = $(this).serializeArray();
            dataFormArray.push({name: "contact_id", value: "<?= $user['id'] ?>"});
            let dataForm = $.param(dataFormArray);
            $.ajax({
                url: 'messageadd.php',
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

    $('#personal_message').emojioneArea({
        pickerPosition: 'bottom'
    });

    function load_mess()
    {
        $.ajax({
            method: 'POST',
            url: 'contact_message_load.php',
            data: "req=ok&contact_id=<?= $user['id'] ?>",
            success: function(html)
            {
                $("#wrap").empty();
                $("#wrap").html(html);
                $("#wrap").scrollTop(90000);
            }
        });
    }
</script>

<script>
    load_mess();
    setInterval(load_mess,10000);
</script>

</body>
</html>