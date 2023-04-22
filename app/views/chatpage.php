<?php
    require_once ('app/views/parts/header.php')
?>
<head>
    <title><?php __('chatloc') ?></title>
    <link href="/public/assets/css/chatpage.css" rel="stylesheet">
    <script src="/public/assets/js/emojionearea.js"></script>
    <link rel="stylesheet" href="/public/assets/css/emojionearea.css" />
    <style>
        #wrap {
            /*background-color:  $chat_background_color*/
        }
    </style>
</head>
<body>
    <h1 align="center"><?php __('chatloc_page') ?></h1>
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
        <textarea class="enter_mess" type="text" name="message" id="message" placeholder="
                <?php __('enter_message') ?>" rows="1" <?= $account['amount'] == 0 ? "disabled" : "" ?>></textarea>
        <button type="submit" class="btn btn-primary"><?php __('send') ?></button>
        <?php
            if($account['top'] == 1 && $account['start_monthly_subscr'] != '0000-00-00') {
                echo "<button class='btn btn-danger disabled'>" . __('top_user') . "</button>";
            } else {
                echo "<button class='btn btn-dark disabled'>" . $account['amount'] . "💎" . "</button>";
            }
        ?>
        <br>
    </form>

    <h6>
        <a href="/chat/page?invite=<?= $chat_id ?>">
            <?php
            if(isset($_SESSION['user']['invite']) && $_SESSION['user']['invite']) {
                echo __('invite_contact');
            } else {
                echo __('click_invite');
            }
            ?>
        </a>
    </h6>
    <form action="" method="post" <?php if(isset($_SESSION['user']['invite']) && !$_SESSION['user']['invite']) echo "hidden";?> >
        <ul class="" style="list-style-type: none;">
            <?php
                foreach ($contacts_arr as $key => $value) :
            ?>
            <a href='/chat/page?<?= $key ?>=<?= $chat_id ?>'>
                <li class='justify-content-between align-items-center'> <?= $value['nickname'] ?>
            </a>
                    <span class='badge bg-primary rounded-pill'><?= $value['status'] ?></span>
                </li>
            <?php
                endforeach;
            ?>
        </ul>
    </form>

    <?php
    if (key_exists('is_edit', $_SESSION['user']) && $_SESSION['user']['is_edit']) :
        ?>
        <form method="post" action="/chat/messageedit?chat_id=<?= $chat_id ?>">
            <textarea class="enter_mess" name="new_message" rows="1"><?= $_SESSION['user']['mess_for_edit'] ?></textarea>
            <button type="edit" class="btn btn-success"><?php __('edit') ?></button>
            <button type="cancel" class="btn btn-secondary"><?php __('cancel') ?></button>
        </form>
        <?php
        unset($_SESSION['user']['is_edit']);
    endif; ?>

    <script>
        $("document").ready(function(){
            $("#sendmess").on("submit", function (){
                let dataFormArray = $(this).serializeArray();
                dataFormArray.push({name: "chat_id", value: "<?= $chat_id ?>"});
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

        $('#message').emojioneArea({
            pickerPosition: 'bottom'
        });

        function load_mess()
        {
            $.ajax({
                method: 'POST',
                url: '/chat/messchatload',
                data: "req=ok&chat_id=<?= $chat_id ?>",
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
                url: '/chat/membersonline',
                data: "req=ok&chat_id=<?= $chat_id ?>",
                success: function(html)
                {
                    $("#members_online").empty();
                    $("#members_online").html(html);
                    $("#members_online").scrollTop(90000);
                }
            });
        }

    </script>

    <script src="/public/assets/js/index.js"></script>
    <script>
        load_mess();
        load_online_members();
        setInterval(load_mess,5000);
        setInterval(load_online_members,30000);
    </script>

</body>
</html>