<?php
require_once 'db.php';
require_once 'admin/params.php';
ini_set('session.gc_maxlifetime', $session_lifetime);
ini_set('session.gc_probability', 1);
ini_set('session.gc_divisor', 1);
//session_set_cookie_params($session_lifetime, '/');
session_start();

    if (isset($_GET['id']) & is_numeric($_GET['id'])) {
        $id = $_GET['id'];
        $query = mysqli_query($connect,"SELECT * FROM `members` WHERE `id` = $id");
        $user = mysqli_fetch_assoc($query);
    }
?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $user['nickname'] ?> | User Profile</title>
    <link href="/assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <style type="text/css">
        img {
            display: block;
            max-width: 100%;
        }
        .preview {
            overflow: hidden;
            width: 160px;
            height: 160px;
            margin: 10px;
            border: 1px solid red;
        }
    </style>
    <script src="/assets/js/jquery3.6.3.min.js"></script>
</head>
<body class="text-center">
<h1 align="center" class=""><?= $user['nickname'] ?> | User Profile</h1>
<?php
    if(isset($user['avatar'])) { ?>
    <img src="<?= $user['avatar'] ?>" alt="" style="display: inline">
<?php
    } else {
?>
    <img src="uploads/avatar-uni.png" alt="" style="width: 150px; height: 150px; display: inline">
<?php
    }
?>
<br><br>

<script src="/assets/js/bootstrap.min.js"></script>

<h6>Nickname: <b>
<?= $user['nickname']?>

<h6>E-mail adress: <?= $user['email'] ?></h6>

<?php
    $user_id = $_SESSION['user']['id'];
    $contact_id = $user['id'];
    $query = mysqli_query($connect,"SELECT * FROM `contacts` WHERE `user_id` = $user_id AND `contact_id` = $contact_id");
    if (mysqli_num_rows($query) > 0) {
?>
    This user is already in your <b>Contact List</b> <a href="contactadd.php?delid=<?= $user['id'] ?>">Delete it?</a>
<?php
    } else {
?>
    <a href="contactadd.php?id=<?= $user['id'] ?>">Add this user to your <b>Contact List</b></a>
<?php
    }
?>
<br><br>
<a href="logout.php">Logout</a>
<br>
<a href="../profile.php">My Profile</a>
<br>
<a href="../chatpage.php">Go to <b>Chat.Loc</b></a>

</body>
</html>