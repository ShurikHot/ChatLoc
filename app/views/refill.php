<?php
    require_once ('app/views/parts/header.php')
?>
<head>
    <title><?php __('refill_page') ?></title>
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

    <br>

    <?php __('terms_subscr') ?><br><br>

    <?php __('your_subscr') ?>
    <?= ($acc_info != 0 && $acc_info['top'] == 1 && $acc_info['start_monthly_subscr'] != "0000-00-00") ? __('monthly') : __('regular') ?>
    <br>

    <?= ($acc_info != 0 && $acc_info['top'] == 1 && $acc_info['start_monthly_subscr'] == "0000-00-00") ? __('monthly_avail') : ""?>

    <p align="center" >
        <?php
        if (isset($_SESSION['message'])) {
            echo $_SESSION['message'];
            unset($_SESSION['message']);
        }
        ?>
    </p>

    <div>
        <form action="/profile/changesubscr" method="POST">
            <label for="card-holder-name"><?php __('type_subscr') ?></label>
            <select name="subscription" id="subscription">
                <option value="simple"><?php __('regular_select') ?></option>
                <option value="top" <?= !($acc_info != 0 && $acc_info['top'] == 1) ? "disabled" : "selected"?> ><?php __('monthly_select') ?></option>
            </select>
            <input type="submit" value="<?php __('change') ?>">
        </form>
    </div>


    <br>
    <h3><?php __('card_pay') ?></h3>
    <div>
        <form action="/profile/stripe" method="POST">

            <label for="card-holder-name"><?php __('card_holder') ?></label>
            <input type="text" id="card-holder-name" name="card-holder-name" required>

            <label for="card-number"><?php __('card_number') ?></label>
            <input type="text" id="card-number" name="card-number" maxlength="16" required>

            <label for="expiry-month"><?php __('expiry_month') ?></label>
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

            <label for="expiry-year"><?php __('expiry_year') ?></label>
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

            <label for="card-holder-name"><?php __('amount') ?></label>
            <input type="number" id="amount" name="amount" required>

            <input type="submit" value="<?php __('pay') ?>">
        </form>
    </div>
</body>
</html>
