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
    <link href="/assets/chatpage.css" rel="stylesheet">
</head>
<body>

<h1 id="forms" align="center">ChatLoc Page</h1>

<div class="wrap">
    <?php
    $query = mysqli_query($connect,"SELECT * FROM `messages`");

    if (mysqli_num_rows($query)>0) {
        while ($messagearr = mysqli_fetch_assoc($query)) {
            $mes_userid = $messagearr['user_id'];
            $query_name = mysqli_query($connect, "SELECT `nickname` FROM `members` WHERE `id` = $mes_userid");
            $name = mysqli_fetch_assoc($query_name);
            if (isset($name)) {
    ?>

    <div class="container">
        <div class="mes_left"> 
            <p> <?= "User " . $name['nickname'] . " says: " . $messagearr['message'] . "" ?> </p>
        </div>
        <?php
            if($_SESSION['user']['id']==$mes_userid) {
        ?>
        <div class="mes_right">
            <a href="vendor/messagedelete.php?id=<?= $messagearr['id'] ?>">
                <img src="assets/delete_icon.png" alt="" class="delete_icon">
            </a>
        </div>
        <?php
            }
        ?>
         <!--<span class="time-right">11:00</span>-->
    </div>

    <?php
            }
        }
    }
    ?>




</div>
<br>
    <form action="/vendor/messageadd.php" method="post">
        <input type="text" name="message" id="message" placeholder="Enter your message..." size="100">
        <button type="submit" name="sendbutton">Send</button>
    </form>
</body>
</html>