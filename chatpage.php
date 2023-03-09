<?php

session_start();
require_once 'vendor/db.php';
if(!isset($_SESSION['user'])) {
    header('Location: /index.php');
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Signin ChatLoc</title>
    <link href="/assets/css/chatpage.css" rel="stylesheet">
    <script src="/assets/js/jquery3.6.3.min.js"></script>
</head>
<body>

<h1 align="center">ChatLoc Page</h1>
<div class="wrap" id="wrap">

</div>
<br>
    <form method="post" id="sendmess" onsubmit="return false">
        <textarea class="enter_mess" type="text" name="message" id="message" placeholder="Enter your message..." rows="1"></textarea>
        <button type="submit">Send</button>
        <br><br>
    </form>

    <?php
        if (key_exists('is_edit', $_SESSION['user'])) {
    ?>
    <form method="post" action="vendor/messageedit.php">
        <textarea class="enter_mess" name="new_message" rows="1"><?= $_SESSION['user']['mess_for_edit'] ?></textarea>
        <button type="edit">Edit</button>
        <button type="cancel">Cancel</button>
    </form>
    <?php
        unset($_SESSION['user']['is_edit']);
        } ?>

    <a class="mes_right" href="profile.php">Go to your&nbsp;<b>Profile</b></a>
    <br><br>
    <a class="mes_right" href="vendor/logout.php"><b>Logout</b></a>

<script>
    $("document").ready(function(){
        $("#sendmess").on("submit", function (){
            let dataForm = $(this).serialize()
            /*var dataForm = $("#message").val();*/
            $.ajax({
                url: 'vendor/messageadd.php',
                method: 'post',
                dataType: 'html',
                data: dataForm,
                success: function (data){
                    /*console.log(data);*/
                    load_mess();
                    $("#message").val('');
                    /*return false;*/
                }
            });
        })
    })

    function load_mess()
    {
        $.ajax({
            method: 'POST',
            url: 'vendor/messageload.php',
            data: "req=ok",
            success: function(html)
            {
                $("#wrap").empty();
                $("#wrap").html(html);
                $("#wrap").scrollTop(90000);
            }
        });
    }
</script>

<script src="assets/js/index.js"></script>
<script>
    load_mess();
    setInterval(load_mess,5000);
</script>

</body>
</html>