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
    <title><?= $_SESSION['user']['lang_text']['your_chatloc_profile'] ?></title>
    <link href="/public/assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script src="/public/assets/js/jquery3.6.3.min.js"></script>
    <link href="/public/assets/css/cropper.min.css" rel="stylesheet">
    <script src="/public/assets/js/cropper.min.js"></script>
    <script src="/public/assets/js/bootstrap.min.js"></script>
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

</head>
<body class="text-center">
    <ul class="nav justify-content-center">
        <li class="nav-item">
            <?php if (isset($_SESSION['user']['blocked']) && !$_SESSION['user']['blocked']): ?>
                <a class="btn btn-info" aria-current="page" href="/chat/chatlist"><?= $_SESSION['user']['lang_text']['go_to_chatlist'] ?></a>
            <?php elseif (isset($_SESSION['user']['blocked']) && $_SESSION['user']['blocked']): ?>
                <a class="btn btn-warning" aria-current="page"href=""><b><?= $_SESSION['user']['lang_text']['your_account_blocked'] ?></b></a>
            <?php endif; ?>
        </li>
        <?php if (isset($_SESSION['user']['email']) && $_SESSION['user']['email'] === 'admin@admin.com'): ?>
        <li class="nav-item">
            <a class="btn btn-success" href="/app/views/admin/admin.php"><?= $_SESSION['user']['lang_text']['admin_area']?></a>
        </li>
        <?php endif; ?>
        <li class="nav-item">
            <a class="btn btn-danger" href="/profile/logout"><?= $_SESSION['user']['lang_text']['logout']?></a>
        </li>
    </ul>

    <h1 align="center" class=""><?= $_SESSION['user']['lang_text']['your_chatloc_profile'] ?></h1>
    <?php
        if(isset($_SESSION['user']['avatar'])) :
    ?>
            <img src="<?= $_SESSION['user']['avatar'] ?>" alt="" style="display: inline">
    <?php
        else :
    ?>
        <img src="/public/uploads/avatar-uni.png" alt="" style="width: 150px; height: 150px; display: inline">
    <?php
        endif;
    ?>
    <br><br>
            <div class="container">
                <h6><?= isset($_SESSION['user']['avatar']) ? $_SESSION['user']['lang_text']['change_avatar'] : $_SESSION['user']['lang_text']['add_avatar']?></h6>
                <form method="post">
                    <input type="file" name="image" class="image">
                </form>
            </div>

            <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalLabel"><?= $_SESSION['user']['lang_text']['crop_avatar'] ?></h5>
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
                            <button type="button" class="btn btn-secondary" data-dismiss="modal"><?= $_SESSION['user']['lang_text']['cancel'] ?></button>
                            <button type="button" class="btn btn-primary" id="crop"><?= $_SESSION['user']['lang_text']['crop'] ?></button>
                        </div>
                    </div>
                </div>
            </div>

    <br>

    <form action="/profile/profileedit" method="post">
        <h6><?= $_SESSION['user']['lang_text']['your_nickname'] ?><b>

            <?php
                if (isset($_SESSION['user']['edit_nickname'])) : ?>
                    <input type="text" name="actual_nickname" value="<?= isset($_SESSION['user']['actual_nickname']) ? $_SESSION['user']['actual_nickname'] : $_SESSION['user']['nickname'] ?>">
            <?php
                else :
                    if (isset($_SESSION['user']['actual_nickname'])) {
                        echo($_SESSION['user']['actual_nickname']);
                    } else {
                        echo($_SESSION['user']['nickname']); }
            endif; ?>

            </b>&nbsp;<input type="submit" name="edit_nickname" value="<?= $_SESSION['user']['lang_text']['click_change'] ?>"></h6>
    </form>

    <h6><?= $_SESSION['user']['lang_text']['your_email'] ?><?= $_SESSION['user']['email'] ?></h6>
    <h6><?= $_SESSION['user']['lang_text']['your_language'] ?><b><?= strtoupper($_SESSION['user']['language']) ?></b> <a href="/profile/profileedit?lang"><i>
                <?= $_SESSION['user']['lang_text']['change_q'] ?></i></a></h6>

    <p align="center">
        <?php
        if (isset($_SESSION['message'])) {
            echo $_SESSION['message'];
            unset($_SESSION['message']);
        }
        ?>
    </p>

    <form action="/profile/profileedit" method="post" <?php if($_SESSION['user']['change_language'] == false) echo "hidden";?> >
        <select name="lang" id="lang">
            <?php
            foreach ($lang_list as $lang) : ?>
                <option value="<?= $lang ?>" <?php if (($lang) == $_SESSION['user']['language']) echo "selected"?>> <?= $lang ?> </option>
            <?php endforeach; ?>
        </select>
        <button type="submit" class="btn btn-primary"><?= $_SESSION['user']['lang_text']['change'] ?></button>
    </form>

    <?php
        require_once ('app/views/profile/contacts.php')
    ?>

    <?php if($_SESSION['user']['black_list'] == false) : ?>
        <a href="/profile/blacklist?black">&#9660; Black list &#9660;</a> (Click to see)
    <?php else: ?>
        <a href="/profile/blacklist?closeblack"> &#9650; Black list &#9650; </a> (Click to hide) <br>
        Click on user to unblock
    <?php endif; ?>

    <form action="#" method="post" <?php if($_SESSION['user']['black_list'] == false) echo "hidden";?> >
        <ul class="" style="list-style-type: none;">
            <?php
            if (isset($contact_black)) {
                foreach ($contact_black as $key => $user) {
                    echo ("<a href='/profile/deblockid?deblockid=" . $key . "'>
                                <li class='justify-content-between align-items-center'>" . $user .
                        "</a><span class='badge bg-danger rounded-pill'>" . $_SESSION['user']['lang_text']['block'] . "</span>   
                                </li>"
                    );
                }
            } else {
                echo ("No users in your blacklist");
            }
            ?>
        </ul>
    </form>

    <form method="post" id="find" action="/profile/searchmember">
        <input type="text" style="width: 505px;" id="find_member" name="find_member" placeholder="<?= $_SESSION['user']['lang_text']['find_somebody'] ?>">
        <button type="submit" class="btn btn-primary"><?= $_SESSION['user']['lang_text']['find'] ?></button>
    </form>

    <ul class="list-group" style="list-style-type: none;">
        <div style="border: #0a0e14 solid 1px; width: 500px; margin: auto">
            <?php
                if (isset($find_arr)) {
                    foreach ($find_arr as $value) {
                        echo("<a href='/contact/profile?id=" . $value['id'] . "'>
                                        <li class='justify-content-between align-items-center'>" . $value['nickname'] . " - " . $value['email'] .
                            "</a>&nbsp;
                                        <span class='badge bg-primary rounded-pill'>" . $value['last_visit'] . "</span>
                                        </li>"
                        );
                    }
                }
            ?>
        </div>
    </ul>

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
                        url: "/profile/uploadavatar",
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
</body>
</html>