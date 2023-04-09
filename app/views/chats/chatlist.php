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
            <a class="btn btn-warning" aria-current="page" href=""><b><?= $_SESSION['user']['lang_text']['your_account_blocked'] ?></b></a>
        <?php endif; ?>
    </li>
    <li class="nav-item">
        <a class="btn btn-primary" href="/profile/info"><?= $_SESSION['user']['lang_text']['go_to_profile'] ?></a>
    </li>

    <?php if (isset($_SESSION['user']['email']) && $_SESSION['user']['email'] === 'admin@admin.com'): ?>
        <li class="nav-item">
            <a class="btn btn-success" href="admin/index.php"><?= $_SESSION['user']['lang_text']['admin_area'] ?></a>
        </li>
    <?php endif; ?>
    <li class="nav-item">
        <a class="btn btn-danger" href="/profile/logout"><?= $_SESSION['user']['lang_text']['logout'] ?></a>
    </li>
</ul>

</body>
    <br>
    <?php
        if (isset($_SESSION['user']['blocked']) && !$_SESSION['user']['blocked']) :
    ?>
    <h4>
        <b><?= $_SESSION['user']['lang_text']['chat_list'] ?></b>
    </h4>
    <ul class="list-group" style="list-style-type: none;">
        <div style="border: #0a0e14 solid 1px; width: 1000px; max-height: 700px; margin: auto">
            <?php
            if (isset($chat_arr)) :
                foreach ($chat_arr as $key => $value) :
            ?>
            <a href='/chat/page?chat_id=<?= $key ?>'>
            <li class='justify-content-between align-items-center'> <?= $value['chat_name'] ?>
                </a> (<i> <?= $_SESSION['user']['lang_text']['author'] ?> </i> <b> <?= $value['author_name'] ?> </b>)
            </li>
            <?php
                endforeach;
            endif;
            ?>
        </div>
    </ul>
<br>
<h6><a href="/chat/chatlist?create"><?= $_SESSION['user']['lang_text']['create_chat'] ?></a></h6>
<form action="/chat/chatlist" method="post" <?php if(isset($_SESSION['user']['chat_create']) && !$_SESSION['user']['chat_create']) echo "hidden";?> >
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
        else :
            echo $_SESSION['user']['lang_text']['your_account_blocked'];
        endif;
    ?>