<?php

if(!isset($_SESSION['user']['id'])) {
    header('Location: /');
}

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $_SESSION['user']['lang_text']['refill_page'] ?></title>
    <link href="/public/assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script src="/public/assets/js/jquery3.6.3.min.js"></script>
    <script src="/public/assets/js/bootstrap.min.js"></script>

    <script src="https://js.stripe.com/v3/"></script>

    <meta charset="UTF-8">
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
            <a class="btn btn-warning" aria-current="page" href=""><b><?= $_SESSION['user']['lang_text']['your_account_blocked'] ?></b></a>
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

<?= $_SESSION['user']['lang_text']['terms_subscr']?><br><br>

<?= $_SESSION['user']['lang_text']['your_subscr']?>
<?= ($acc_info != 0 && $acc_info['top'] == 1 && $acc_info['start_monthly_subscr'] != "0000-00-00") ? $_SESSION['user']['lang_text']['monthly'] : $_SESSION['user']['lang_text']['regular']?>
<br>

<?= ($acc_info != 0 && $acc_info['top'] == 1 && $acc_info['start_monthly_subscr'] == "0000-00-00") ? $_SESSION['user']['lang_text']['monthly_avail'] : ""?>

<p align="center">
    <?php
    if (isset($_SESSION['message'])) {
        echo $_SESSION['message'];
        unset($_SESSION['message']);
    }
    ?>
</p>

<div>
    <form action="/profile/changesubscr" method="POST">
        <label for="card-holder-name"><?= $_SESSION['user']['lang_text']['type_subscr']?></label>
        <select name="subscription" id="subscription">
            <option value="simple"><?= $_SESSION['user']['lang_text']['regular_select']?></option>
            <option value="top" <?= !($acc_info != 0 && $acc_info['top'] == 1) ? "disabled" : "selected"?> ><?= $_SESSION['user']['lang_text']['monthly_select']?></option>
        </select>
        <input type="submit" value="<?= $_SESSION['user']['lang_text']['change']?>">
    </form>
</div>


<br>
<h3><?= $_SESSION['user']['lang_text']['card_pay']?></h3>
<div>
    <form action="/profile/stripe" method="POST">

        <label for="card-holder-name"><?= $_SESSION['user']['lang_text']['card_holder']?></label>
        <input type="text" id="card-holder-name" name="card-holder-name" required>

        <label for="card-number"><?= $_SESSION['user']['lang_text']['card_number']?></label>
        <input type="text" id="card-number" name="card-number" maxlength="16" required>

        <label for="expiry-month"><?= $_SESSION['user']['lang_text']['expiry_month']?></label>
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

        <label for="expiry-year"><?= $_SESSION['user']['lang_text']['expiry_year']?></label>
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
        <input type="text" id="cvv" name="cvv" maxlength="3" required>

        <label for="card-holder-name"><?= $_SESSION['user']['lang_text']['amount']?></label>
        <input type="number" id="amount" name="amount" required>

        <input type="submit" value="<?= $_SESSION['user']['lang_text']['pay']?>">
    </form>
</div>
</body>
</html>
