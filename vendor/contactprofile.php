<?php
require_once 'db.php';
require_once 'admin/params.php';

ini_set('session.gc_maxlifetime', $session_lifetime);
ini_set('session.gc_probability', 1);
ini_set('session.gc_divisor', 1);
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
    <link href="../assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/css/chatpage.css" rel="stylesheet">
    <script src="../assets/js/jquery3.6.3.min.js"></script>
</head>
<body class="text-center">
<h1 align="center" class=""><?= $user['nickname'] ?> | User Profile</h1>
<?php
    if(isset($user['avatar'])) : ?>
    <img src="<?= $user['avatar'] ?>" alt="" style="display: inline">
<?php
     else :
?>
    <img src="uploads/avatar-uni.png" alt="" style="width: 150px; height: 150px; display: inline">
<?php
    endif;
?>
<br><br>

<script src="../assets/js/bootstrap.min.js"></script>

<h6>Nickname: <b> <?= $user['nickname']?> </b>

<h6>E-mail adress: <?= $user['email'] ?></h6>

<?php
    $user_id = $_SESSION['user']['id'];
    $contact_id = $user['id'];
    $query = mysqli_query($connect,"SELECT * FROM `contacts` WHERE `user_id` = $user_id AND `contact_id` = $contact_id");
    if (mysqli_num_rows($query) > 0) :
?>
    This user is already in your <b>Contact List</b> <a href="contactadd.php?delid=<?= $user['id'] ?>">Delete it?</a>
    <br><br>
    <form method="post" id="sendmess" onsubmit="return false">
        <textarea class="enter_mess" type="text" name="personal_message" id="personal_message" placeholder="Enter your message..." rows="1"></textarea>
        <button type="submit">Send</button>
    </form>
    <div class="wrap" id="wrap" style="height: 300px; width: 400px; display: inline-block">
        <!-- CHAT -->
    </div>
<?php
    else :
?>
    <a href="contactadd.php?id=<?= $user['id'] ?>">Add this user to your <b>Contact List</b></a>
    <br><br>
    <form method="post" id="sendmess">
        <textarea class="enter_mess" type="text" name="" id="" placeholder="Enter your message... (User must be in your Contact List)" rows="1" disabled></textarea>
        <button type="submit" disabled>Send</button>
    </form>
<?php
    endif;
?>
<br>
<a href="logout.php">Logout</a>
<br>
<a href="../profile.php">My Profile</a>
<br>
<a href="../chatpage.php">Go to <b>Chat.Loc</b></a>

<script>
    $("document").ready(function(){
        $("#sendmess").on("submit", function (){
            let dataFormArray = $(this).serializeArray();
            dataFormArray.push({name: "contact_id", value: "<?= $user['id'] ?>"});
            let dataForm = $.param(dataFormArray);
            /*let dataForm = $(this).serialize()*/
            $.ajax({
                url: 'messageadd.php',
                method: 'post',
                dataType: 'html',
                data: dataForm,
                success: function (data){
                    /*console.log(data);*/
                    load_mess();
                    $("#personal_message").val('');
                    /*return false;*/
                }
            });
        })
    })

    function load_mess()
    {
        $.ajax({
            method: 'POST',
            url: 'contact_message_load.php',
            data: "req=ok&contact_id=<?= $user['id'] ?>",
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