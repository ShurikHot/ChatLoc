<?php
    require_once ('app/views/parts/header.php');

    if (isset($contact_arr)) :
        foreach ($contact_arr as $key => $value) :
?>

<head>
    <title><?= $value['nickname'] ?> | <?php __('contact_profile') ?></title>
    <link href="/public/assets/css/chatpage.css" rel="stylesheet">
    <script src="/public/assets/js/emojionearea.js"></script>
    <link rel="stylesheet" href="/public/assets/css/emojionearea.css" />
</head>
<body class="text-center">

    <h1 align="center" class=""><?= $value['nickname'] ?> | <?php __('contact_profile') ?></h1>
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

    <h6><?php __('nickname') ?><b> <?= $value['nickname']?> </b> <span class='badge bg-primary rounded-pill'> <?= $value['status'] ?></span> </h6>
    <h6><?php __('email') ?><?= $value['email'] ?></h6>

    <?php
        if (key_exists('blocked', $value) && $value['blocked'] == 0) :
    ?>
            <?php __('user_already') ?> <a href="/contact/action?delid=<?= $key ?>"><?php __('delete_it') ?></a>
            <a href="/contact/action?blockid=<?= $key ?>" style="color: red"><?php __('block_it') ?></a>
            <br><br>
            <form method="post" id="sendmess" onsubmit="return false">
                <textarea class="enter_mess" type="text" name="personal_message" id="personal_message" placeholder="<?php __('enter_message') ?>" rows="1"></textarea>
                <button type="submit" class="btn btn-primary"><?php __('send') ?></button>
            </form>

            <div class="wrap" id="wrap" style="height: 300px; width: 600px; display: inline-block">
                <!-- CHAT -->
            </div>
    <?php
        elseif (key_exists('blocked', $value) && $value['blocked'] == 1) :
    ?>
            <?php __('contact_is_bl') ?> <a href="/contact/action?deblockid=<?= $key ?>" style="color: red"><?php __('delete_it') ?></a>
    <?php
        else :
    ?>
            <a href="/contact/action?id=<?= $key ?>"><?php __('add_contact') ?></a>
            <br><br>
            <form method="post">
                <textarea class="enter_mess" type="text" name="" id="" placeholder="<?php __('enter_message_must') ?>" rows="1" disabled></textarea>
                <button type="submit" disabled><?php __('send') ?></button>
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
                    url: '/chat/message',
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