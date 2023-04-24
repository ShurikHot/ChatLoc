<?php
    require_once ('app/views/parts/header.php')
?>

<head>
    <title><?php __('your_chatloc_profile') ?></title>
    <link href="/public/assets/css/cropper.min.css" rel="stylesheet">
    <script src="/public/assets/js/cropper.min.js"></script>

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

    <h1 align="center" class=""><?php __('your_chatloc_profile') ?></h1>
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
                <h6><?php isset($_SESSION['user']['avatar']) ? __('change_avatar') : __('add_avatar') ?></h6>
                <form method="post">
                    <input type="file" name="image" class="image">
                </form>
            </div>

            <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalLabel"><?php __('crop_avatar') ?></h5>
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
                            <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php __('cancel') ?></button>
                            <button type="button" class="btn btn-primary" id="crop"><?php __('crop') ?></button>
                        </div>
                    </div>
                </div>
            </div>

    <br>

    <form action="/profile/profileedit" method="post">
        <h6><?php __('your_nickname') ?><b>

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

            </b>&nbsp;<input type="submit" name="edit_nickname" value="<?php __('click_change') ?>"></h6>
    </form>

    <h6><?php __('your_email') ?><?= $_SESSION['user']['email'] ?></h6>
    <h6><?php __('your_language') ?><b><?= strtoupper($_SESSION['user']['language']) ?></b> <a href="/profile/profileedit?lang"><i>
                <?php __('change_q') ?></i></a></h6>

    <?php
        if (isset($_SESSION['message'])) :
    ?>
            <div class="alert alert-info" style="width: 400px; margin: 0 auto;">
            <?php
                echo $_SESSION['message'];
                unset($_SESSION['message']);
            ?>
            </div>
   <?php
        endif;
   ?>


    <form action="/profile/profileedit" method="post" <?php if($_SESSION['user']['change_language'] == false) echo "hidden";?> >
        <select name="lang" id="lang">
            <?php
            foreach ($lang_list as $lang) : ?>
                <option value="<?= $lang ?>" <?php if (($lang) == $_SESSION['user']['language']) echo "selected"?>> <?= $lang ?> </option>
            <?php endforeach; ?>
        </select>
        <button type="submit" class="btn btn-primary"><?php __('change') ?></button>
    </form>

    <a href="/profile/refill"><?php __('on_account') ?></a> <b><?= $account != 0 ? $account['amount'] : "0" ?></b>💎

    <span class="badge text-bg-danger"><?php $account == 0 ? "" : (($account['top'] == 1) ? __('top_user') : "") ?></span>

    <br>

    <?php
        require_once ('app/views/parts/contacts.php')
    ?>

    <?php if($_SESSION['user']['black_list'] == false) : ?>
        <a href="/profile/blacklist?black">&#9660; <?php __('bl_list') ?> &#9660;</a> <?php __('click_see') ?>
    <?php else: ?>
        <a href="/profile/blacklist?closeblack"> &#9650; <?php __('bl_list') ?> &#9650; </a> <?php __('click_hide') ?> <br>
        <?php __('click_unblock') ?>
    <?php endif; ?>

    <form action="#" method="post" <?php if($_SESSION['user']['black_list'] == false) echo "hidden";?> >
        <ul class="" style="list-style-type: none;">
            <?php
            if (isset($contact_black)) {
                foreach ($contact_black as $key => $user) {
                    echo ("<a href='/profile/deblockid?deblockid=" . $key . "'>
                                <li class='justify-content-between align-items-center'>" . $user . "</a>
                           <span class='badge bg-danger rounded-pill'>");
                    __('block');
                    echo ("</span>
                                </li>"
                    );
                }
            } else {
                echo __('blist_empty');
            }
            ?>
        </ul>
    </form>

    <form method="post" id="find" action="/profile/searchmember">
        <input type="text" style="width: 505px;" id="find_member" name="find_member" placeholder="<?php __('find_somebody') ?>">
        <button type="submit" class="btn btn-primary"><?php __('find') ?></button>
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