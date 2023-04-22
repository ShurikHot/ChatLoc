<?php
    require_once('app/helpers/functions.php');
    lastVisit($_SESSION['user']['id']);
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="/public/assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script src="/public/assets/js/jquery3.6.3.min.js"></script>
    <script src="/public/assets/js/bootstrap.min.js"></script>
</head>

<body>
    <ul class="nav justify-content-center">
        <li class="nav-item">
            <a class="btn btn-primary" href="/profile/info"><?php __('go_to_profile') ?></a>
        </li>

        <li class="nav-item">
            <?php if (isset($_SESSION['user']['blocked']) && !$_SESSION['user']['blocked']): ?>
                <a class="btn btn-info" aria-current="page" href="/chat/chatlist"><?php __('go_to_chatlist') ?></a>
            <?php elseif (isset($_SESSION['user']['blocked']) && $_SESSION['user']['blocked']): ?>
                <a class="btn btn-warning" aria-current="page"href=""><b><?php __('your_account_blocked') ?></b></a>
            <?php endif; ?>
        </li>

        <?php if (isset($_SESSION['user']) && $_SESSION['user']['id'] == '1'): ?>
            <li class="nav-item">
                <a class="btn btn-success" href="/admin/content?members"><?php __('admin_area') ?></a>
            </li>
        <?php endif; ?>

        <li class="nav-item">
            <a class="btn btn-danger" href="/profile/logout"><?php __('logout') ?></a>
        </li>
    </ul>
</body>