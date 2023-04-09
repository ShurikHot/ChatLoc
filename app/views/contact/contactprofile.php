<?php

if (isset($contact_arr)) :
    foreach ($contact_arr as $key => $value) :

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $value['nickname'] ?> | <?= $_SESSION['user']['lang_text']['contact_profile'] ?></title>
    <link href="/public/assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="/public/assets/css/chatpage.css" rel="stylesheet">
    <script src="/public/assets/js/jquery3.6.3.min.js"></script>
    <script src="/public/assets/js/emojionearea.js"></script>
    <link rel="stylesheet" href="/public/assets/css/emojionearea.css" />
</head>
<body class="text-center">

<ul class="nav justify-content-center">
    <li class="nav-item">
        <?php if (isset($_SESSION['user']['blocked']) && !$_SESSION['user']['blocked']): ?>
            <a class="btn btn-info" aria-current="page" href="/chat/chatlist"><?= $_SESSION['user']['lang_text']['go_to_chatlist'] ?></a>
        <?php elseif (isset($_SESSION['user']['blocked']) && $_SESSION['user']['blocked']): ?>
            <a class="btn btn-warning" aria-current="page" href=""><b><?= $_SESSION['user']['lang_text']['your_account_blocked'] ?></b></a>
        <?php endif; ?>
    </li>
    <li class="nav-item">
        <a class="btn btn-primary" href="/profile/info"><?= $_SESSION['user']['lang_text']['go_to_profile'] ?></a>
    </li>
        <?php if (isset($_SESSION['user']['email']) && $_SESSION['user']['email'] === 'admin@admin.com'): ?>
            <li class="nav-item">
                <a class="btn btn-success" href="../admin/index.php"><?= $_SESSION['user']['lang_text']['admin_area'] ?></a>
            </li>
        <?php endif; ?>
    <li class="nav-item">
        <a class="btn btn-danger" href="/profile/logout"><?= $_SESSION['user']['lang_text']['logout'] ?></a>
    </li>
</ul>

<h1 align="center" class=""><?= $value['nickname'] ?> | <?= $_SESSION['user']['lang_text']['contact_profile'] ?></h1>
<?php
    if(isset($value['avatar'])) :
?>
        <img src="<?= $value['avatar'] ?>" alt="" style="display: inline">
<?php
    else :
?>
        <img src="/public/uploads/avatar-uni.png" alt="" style="width: 150px; height: 150px; display: inline">
<?php
    endif;
?>
<br>

<script src="/public/assets/js/bootstrap.min.js"></script>

<h6><?= $_SESSION['user']['lang_text']['nickname'] ?><b> <?= $value['nickname']?> </b> <span class='badge bg-primary rounded-pill'> <?= $value['status'] ?></span> </h6>
<h6><?= $_SESSION['user']['lang_text']['email'] ?><?= $value['email'] ?></h6>

<?php
    if (key_exists('blocked', $value) && $value['blocked'] == 0) :
?>
        <?= $_SESSION['user']['lang_text']['user_already'] ?> <a href="/contact/action?delid=<?= $key ?>"><?= $_SESSION['user']['lang_text']['delete_it'] ?></a>
        <a href="/contact/action?blockid=<?= $key ?>" style="color: red">Or Block?</a>
        <br><br>
        <form method="post" id="sendmess" onsubmit="return false">
            <textarea class="enter_mess" type="text" name="personal_message" id="personal_message" placeholder="<?= $_SESSION['user']['lang_text']['enter_message'] ?>" rows="1"></textarea>
            <button type="submit" class="btn btn-primary"><?= $_SESSION['user']['lang_text']['send'] ?></button>
        </form>

        <div class="wrap" id="wrap" style="height: 300px; width: 600px; display: inline-block">
            <!-- CHAT -->
        </div>
<?php
    elseif (key_exists('blocked', $value) && $value['blocked'] == 1) :
?>
        <?= $_SESSION['user']['lang_text']['contact_is_bl'] ?> <a href="/contact/action?deblockid=<?= $key ?>" style="color: red">Deblock?</a>
<?php
    else :
?>
        <a href="/contact/action?id=<?= $key ?>"><?= $_SESSION['user']['lang_text']['add_contact'] ?></a>
        <br><br>
        <form method="post">
            <textarea class="enter_mess" type="text" name="" id="" placeholder="<?= $_SESSION['user']['lang_text']['enter_message_must'] ?>" rows="1" disabled></textarea>
            <button type="submit" disabled><?= $_SESSION['user']['lang_text']['send'] ?></button>
        </form>
<?php
    endif;
?>

<?php
    endforeach;
    endif;
?>

<script>
    $("document").ready(function(){
        $("#sendmess").on("submit", function (){
            let dataFormArray = $(this).serializeArray();
            dataFormArray.push({name: "contact_id", value: "<?= $key ?>"});
            let dataForm = $.param(dataFormArray);
            $.ajax({
                url: '/chat/messpers',
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
            url: '/chat/messpersload',
            data: "req=ok&contact_id=<?= $key ?>",
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