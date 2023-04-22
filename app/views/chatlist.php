<?php
    require_once ('app/views/parts/header.php')
?>

<head>
    <title><?php __('chat_list') ?></title>
</head>

<body class="text-center">
    <br>
    <?php
        if (isset($_SESSION['user']['blocked']) && !$_SESSION['user']['blocked']) :
    ?>
    <h4>
        <b><?php __('chat_list') ?></b>
    </h4>
    <ul class="list-group" style="list-style-type: none;">
        <div style="border: #0a0e14 solid 1px; width: 1000px; max-height: 700px; margin: auto">
            <?php
            if (isset($chat_arr)) :
                foreach ($chat_arr as $key => $value) :
            ?>
            <a href='/chat/page?chat_id=<?= $key ?>'>
            <li class='justify-content-between align-items-center'> <?= $value['chat_name'] ?>
                </a> (<i> <?php __('author') ?> </i> <b> <?= $value['author_name'] ?> </b>)
            </li>
            <?php
                endforeach;
            endif;
            ?>
        </div>
    </ul>
    <br>
    <h6><a href="/chat/chatlist?create"><?php __('create_chat') ?></a></h6>
    <form action="/chat/chatlist" method="post" <?php if(isset($_SESSION['user']['chat_create']) && !$_SESSION['user']['chat_create']) echo "hidden";?> >
        <input type="text" name="create_chat" style="width: 400px" placeholder="<?php __('enter_chat_name') ?>">
        <button type="submit" class="btn btn-primary"><?php __('create') ?></button>
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
            else :
                echo __('your_account_blocked');
            endif;
        ?>
</body>