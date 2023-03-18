<?php
    require_once 'vendor/admin/params.php';
    require_once 'vendor/db.php';

    ini_set('session.gc_maxlifetime', $session_lifetime);
    ini_set('session.gc_probability', 1);
    ini_set('session.gc_divisor', 1);
    session_start();

    if(!isset($_SESSION['user'])) {
        header('Location: /index.php');
    }

    $id = $_SESSION['user']['id'];
    $query_visit = mysqli_query($connect, "UPDATE `members` SET `last_visit` = NOW() WHERE `id` = $id");

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Your ChatLoc Profile</title>
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
    <link href="/assets/css/cropper.min.css" rel="stylesheet">
    <script src="/assets/js/cropper.min.js"></script>
</head>
<body class="text-center">
    <ul class="nav justify-content-center">
        <li class="nav-item">
            <?php if (isset($_SESSION['user']['blocked']) && !$_SESSION['user']['blocked']): ?>
                <a class="btn btn-info" aria-current="page" href="chatpage.php">Go to <b>Chat.Loc</b></a>
            <?php elseif (isset($_SESSION['user']['blocked']) && $_SESSION['user']['blocked']): ?>
                <a class="btn btn-warning" aria-current="page"href=""><b>!!Your account is blocked!!</b></a>
            <?php endif; ?>
        </li>
        <?php if (isset($_SESSION['user']['email']) && $_SESSION['user']['email'] === 'admin@admin.com'): ?>
        <li class="nav-item">
            <a class="btn btn-success" href="admin/index.php">Admin Area</a>
        </li>
        <?php endif; ?>
        <li class="nav-item">
            <a class="btn btn-danger" href="vendor/logout.php">Logout</a>
        </li>
    </ul>

    <h1 align="center" class="">Your ChatLoc Profile</h1>
    <?php
        if(isset($_SESSION['user']['avatar'])) :
    ?>
            <img src="<?= $_SESSION['user']['avatar'] ?>" alt="" style="display: inline">
    <?php
        else :
    ?>
        <img src="uploads/avatar-uni.png" alt="" style="width: 150px; height: 150px; display: inline">
    <?php
        endif;
    ?>
    <br><br>
            <div class="container">
                <h6><?= isset($_SESSION['user']['avatar']) ? "Change Avatar: " : "Add Avatar: " ?></h6>
                <form method="post">
                    <input type="file" name="image" class="image">
                </form>
            </div>

            <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalLabel">Crop Avatar</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="img-container">
                                <div class="row">
                                    <div class="col-md-8">
                                        <img id="image">
                                    </div>
                                    <div class="col-md-4">
                                        <div class="preview"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <button type="button" class="btn btn-primary" id="crop">Crop</button>
                        </div>
                    </div>
                </div>
            </div>

            <script src="/assets/js/bootstrap.min.js"></script>
            <script>
                var bs_modal = $('#modal');
                var image = document.getElementById('image');
                var cropper,reader,file;

                $("body").on("change", ".image", function(e) {
                    var files = e.target.files;
                    var done = function(url) {
                        image.src = url;
                        bs_modal.modal('show');
                    };

                    if (files && files.length > 0) {
                        file = files[0];

                        if (URL) {
                            done(URL.createObjectURL(file));
                        } else if (FileReader) {
                            reader = new FileReader();
                            reader.onload = function(e) {
                                done(reader.result);
                            };
                            reader.readAsDataURL(file);
                        }
                    }
                });

                bs_modal.on('shown.bs.modal', function() {
                    cropper = new Cropper(image, {
                        aspectRatio: 1,
                        viewMode: 3,
                        preview: '.preview'
                    });
                }).on('hidden.bs.modal', function() {
                    cropper.destroy();
                    cropper = null;
                });

                $("#crop").click(function() {
                    canvas = cropper.getCroppedCanvas({
                        width: 150,
                        height: 150,
                    });

                    canvas.toBlob(function(blob) {
                        url = URL.createObjectURL(blob);
                        var reader = new FileReader();
                        reader.readAsDataURL(blob);
                        reader.onloadend = function() {
                            var base64data = reader.result;
                            $.ajax({
                                type: "POST",
                                dataType: "json",
                                url: "vendor/uploadavatar.php",
                                data: {image: base64data},
                                success: function(data) {
                                    bs_modal.modal('hide');
                                    alert("Success upload Avatar");
                                    window.location.reload();
                                }
                            });
                        };
                    });
                });
            </script>
    <br>

    <form action="vendor/profileedit.php" method="post">
        <h6>Your Nickname: <b>

            <?php
                if (isset($_SESSION['user']['edit_nickname'])) : ?>
                    <input type="text" name="actual_nickname" value="
                    <?= isset($_SESSION['user']['actual_nickname']) ? $_SESSION['user']['actual_nickname'] : $_SESSION['user']['nickname'] ?>  ">
            <?php
                else :
                    if (isset($_SESSION['user']['actual_nickname'])) {
                        echo($_SESSION['user']['actual_nickname']);
                    } else {
                        echo($_SESSION['user']['nickname']); }
            endif; ?>

            </b>&nbsp;<input type="submit" name="edit_nickname" value="Click to Change"></h6>
    </form>

    <h6>Your E-mail adress: <?= $_SESSION['user']['email'] ?></h6>

    <?php
        require_once ('vendor/contacts.php')
    ?>

    <br>
    <form method="post" id="find" action="#"> <!--vendor/find_member.php-->
        <textarea class="" style="width: 448px;" type="text" name="find_member" id="find_member" placeholder="Do you want find somebody? Enter part of nickname or email" rows="1"></textarea>
        <button type="submit" class="btn btn-primary">Find</button>
    </form>

    <ul class="list-group" style="list-style-type: none;">
        <div style="border: #0a0e14 solid 1px; width: 500px; margin: auto">
            <?php
            if (isset($_POST['find_member'])) {
                $search_query = $_POST['find_member'];
                $query = mysqli_query($connect, "SELECT * FROM `members` WHERE (`nickname` LIKE '%$search_query%') OR (`email` LIKE '%$search_query%')");
                if (mysqli_num_rows($query) == 0) echo("No match found");
                while ($find_user = mysqli_fetch_assoc($query)) {
                    $find_id = $find_user['id'];
                    $query2 = mysqli_query($connect, "SELECT * FROM `members` WHERE `id` = $find_id");
                    if (mysqli_num_rows($query2) > 0) {
                        $user = mysqli_fetch_assoc($query2);
                        $user['last_visit'] >= (date('Y-m-d H:i:s', strtotime(date('Y-m-d H:i:s') . ' -5 minutes'))) ? $status = 'ONLINE' : $status = 'offline';
                        echo("<a href='vendor/contactprofile.php?id=" . $find_id . "'>
                                    <li class='justify-content-between align-items-center'>" . $user['nickname'] . " - " . $user['email'] .
                            "</a>&nbsp;
                                    <span class='badge bg-primary rounded-pill'>" . $status . "</span>
                                    </li>"
                        );
                    }
                }
            }
            ?>
        </div>
    </ul>

</body>
</html>