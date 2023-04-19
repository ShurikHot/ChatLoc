<?php

if(!isset($_SESSION['user']['id'])) {
    header('Location: /');
}

require_once('vendor/stripe/stripe-php/init.php');

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Refill Page</title>
    <link href="/public/assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script src="/public/assets/js/jquery3.6.3.min.js"></script>
    <script src="/public/assets/js/bootstrap.min.js"></script>

    <script src="https://js.stripe.com/v3/"></script>

    <meta charset="UTF-8">
    <title>Оплата картой</title>
    <style>
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        input[type=text], input[type=number], select {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            margin-bottom: 10px;
        }
        input[type=submit] {
            background-color: #4CAF50;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        form {
            max-width: 500px;
            margin: 0 auto;
        }
    </style>

</head>
<body class="text-center">
<ul class="nav justify-content-center">
    <li class="nav-item">
        <a class="btn btn-primary" href="/profile/info"><?= $_SESSION['user']['lang_text']['go_to_profile'] ?></a>
    </li>
    <li class="nav-item">
        <?php if (isset($_SESSION['user']['blocked']) && !$_SESSION['user']['blocked']): ?>
            <a class="btn btn-info" aria-current="page" href="/chat/chatlist"><?= $_SESSION['user']['lang_text']['go_to_chatlist'] ?></a>
        <?php elseif (isset($_SESSION['user']['blocked']) && $_SESSION['user']['blocked']): ?>
            <a class="btn btn-warning" aria-current="page"href=""><b><?= $_SESSION['user']['lang_text']['your_account_blocked'] ?></b></a>
        <?php endif; ?>
    </li>
    <?php if (isset($_SESSION['user']['email']) && $_SESSION['user']['email'] === 'admin@admin.com'): ?>
        <li class="nav-item">
            <a class="btn btn-success" href="/admin/content?members"><?= $_SESSION['user']['lang_text']['admin_area']?></a>
        </li>
    <?php endif; ?>
    <li class="nav-item">
        <a class="btn btn-danger" href="/profile/logout"><?= $_SESSION['user']['lang_text']['logout']?></a>
    </li>
</ul>
<br>
<h4>Умови</h4>
Ціна одного повідомлення - 1 монета, ціна 1 монети - 1 у.о.<br>
Місячна підписка доступна для користувачів, які мають повідомлення мінімум у 10 чатах.<br>
Ціна місячної підписки - 100 у.о. Кількість повідомлень - необмежена.<br><br>

Ваша поточна підписка - <?= (isset($acc_info) && $acc_info['top'] == 1 && $acc_info['start_monthly_subscr'] != "0000-00-00") ? "<b>місячна</b>" : "<b>звичайна</b>"?>
<br>

<?= (isset($acc_info) && $acc_info['top'] == 1 && $acc_info['start_monthly_subscr'] == "0000-00-00") ? "Вам доступна <b>МІСЯЧНА</b> підписка" : ""?>

<p align="center">
    <?php
    if (isset($_SESSION['message'])) {
        echo $_SESSION['message'];
        unset($_SESSION['message']);
    }
    ?>
</p>
<br>

<div>
    <form action="/profile/changesubscr" method="POST">
        <label for="card-holder-name">Види підписок (звичайна чи місячна)</label>
        <select name="subscription" id="subscription">
            <option value="simple">Звичайна (для більшості користувачів)</option>
            <option value="top" <?= !(isset($acc_info) && $acc_info['top'] == 1) ? "disabled" : "selected"?> >Місячна (для тoпових користувачів)</option>
        </select>
        <input type="submit" value="Змінити">
    </form>
</div>


<br>
<h3>Оплата картою</h3>
<div>
    <form action="/profile/stripe" method="POST">

        <label for="card-holder-name">Ім'я власника карти</label>
        <input type="text" id="card-holder-name" name="card-holder-name" required>

        <label for="card-number">Номер карти</label>
        <input type="text" id="card-number" name="card-number" maxlength="16" required>

        <label for="expiry-month">Місяць закінчення терміну дії</label>
        <select id="expiry-month" name="expiry-month" required>
            <option value=""></option>
            <option value="01">01</option>
            <option value="02">02</option>
            <option value="03">03</option>
            <option value="04">04</option>
            <option value="05">05</option>
            <option value="06">06</option>
            <option value="07">07</option>
            <option value="08">08</option>
            <option value="09">09</option>
            <option value="10">10</option>
            <option value="11">11</option>
            <option value="12">12</option>
        </select>

        <label for="expiry-year">Рік закінчення терміну дії</label>
        <select id="expiry-year" name="expiry-year" required>
            <option value=""></option>
            <option value="22">2022</option>
            <option value="23">2023</option>
            <option value="24">2024</option>
            <option value="25">2025</option>
            <option value="26">2026</option>
            <option value="27">2027</option>
            <option value="28">2028</option>
            <option value="29">2029</option>
            <option value="30">2030</option>
        </select>

        <label for="cvv">CVV</label>
        <input type="number" id="cvv" name="cvv" maxlength="3" required>

        <label for="card-holder-name">Сума</label>
        <input type="number" id="amount" name="amount" required>

        <input type="submit" value="Оплатити">
    </form>
</div>
</body>
</html>
