<?php
require_once '../vendor/db.php';

if (!isset($_SESSION['user']['admin_member_edit'])) {
    header('Location: ../index.php');
}
?>

<div class="card">
    <div class="card-body">
        <form action="../vendor/admin/admin_member_edit.php" method="post" class="row">
            <div class="col-md-2">
                <div class="form-group">
                    <label for="userid">ID</label>
                    <input type="text" name="userid" class="form-control" id="userid" value="<?= $_SESSION['user']['admin_member_edit']['id'] ?>" readonly>
                </div>
            </div>

            <div class="col-md-2">
                <div class="form-group">
                    <label for="blocked">Blocked?</label>
                    <input type="text" name="blocked" class="form-control" id="blocked" value="<?= $_SESSION['user']['admin_member_edit']['blocked'] ?>" >
                </div>
            </div>

            <div class="col-md-2">
                <div class="form-group">
                    <label for="blocked">0 or 1</label>
                    <input type="text" class="form-control" value="0 - no, 1 - yes" readonly>
                </div>
            </div>

            <?php
                $contact_id = $_SESSION['user']['admin_member_edit']['id'];
                $query = mysqli_query($connect,"SELECT * FROM `contacts` WHERE `user_id` = 1 AND `contact_id` = $contact_id ");
                if (mysqli_num_rows($query) == 0) :
            ?>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="contact">Add to Contacts?</label>
                        <button type="button" name="button" class="btn btn-light form-control">
                            <a href="../../vendor/contactadd.php?id=<?= $_SESSION['user']['admin_member_edit']['id'] ?>&admin">Add</a>
                        </button>
                    </div>
                </div>
            <?php
                else:
            ?>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="contact">Del from Contacts?</label>
                        <button type="button" name="button" class="btn btn-light form-control">
                            <a href="../../vendor/contactadd.php?delid=<?= $_SESSION['user']['admin_member_edit']['id'] ?>&admin">Del</a>
                        </button>
                    </div>
                </div>
            <?php
                endif;
            ?>

            <div class="col-md-8">
                <div class="form-group">
                    <label for="email">Email<b>*</b></label>
                    <input type="email" name="email" class="form-control" id="email" value="<?= $_SESSION['user']['admin_member_edit']['email'] ?>">
                </div>
            </div>

            <div class="col-md-8">
                <div class="form-group">
                    <label for="name">Name<b>*</b></label>
                    <input type="text" name="name" class="form-control" id="name" value="<?= $_SESSION['user']['admin_member_edit']['name'] ?>">
                </div>
            </div>

            <div class="col-md-8">
                <div class="form-group">
                    <label for="nickname">Nickname<b>*</b></label>
                    <input type="text" name="nickname" class="form-control" id="nickname" value="<?= $_SESSION['user']['admin_member_edit']['nickname'] ?>" maxlength="20">
                </div>
            </div>

            <div class="col-md-8">
                <div class="form-group">
                    <label for="phone_num">Phone Number</label>
                    <input type="number" name="phone_num" class="form-control" id="phone_num" value="<?= $_SESSION['user']['admin_member_edit']['phone_num'] ?>" maxlength="10">
                </div>
            </div>

            <div class="col-md-8">
                <div class="form-group">
                    <label for="avatar">Avatar</label>
                    <input type="text" name="avatar" class="form-control" id="avatar" value="<?= $_SESSION['user']['admin_member_edit']['avatar'] ?>">
                    <img src="<?= $_SESSION['user']['admin_member_edit']['avatar'] ?>" alt="">
                </div>
            </div>

            <div class="col-md-8">
                <div class="form-group">
                    <label for="gender">Gender</label>
                    <select name="gender" id="gender" class="form-control">
                        <option value="male" <?php if ($_SESSION['user']['admin_member_edit']['gender'] == 'male') echo 'selected' ?>>Male</option>
                        <option value="female" <?php if ($_SESSION['user']['admin_member_edit']['gender'] == 'female') echo 'selected' ?>>Female</option>
                        <option value="no_select" <?php if ($_SESSION['user']['admin_member_edit']['gender'] == 'no_select') echo 'selected' ?>>No sselect</option>
                    </select>
                </div>
            </div>

            <div class="col-md-8">
                <div class="form-group">
                    <label for="country">Country</label>
                    <input type="text" name="country" class="form-control" id="country" value="<?= $_SESSION['user']['admin_member_edit']['country'] ?>">
                </div>
            </div>

            <div class="col-md-8">
                <div class="form-group">
                    <label for="language">Language</label>
                    <select name="language" id="language" class="form-control">
                        <option value="en" <?php if ($_SESSION['user']['admin_member_edit']['language'] == 'en') echo 'selected' ?>>EN</option>
                        <option value="ua" <?php if ($_SESSION['user']['admin_member_edit']['language'] == 'ua') echo 'selected' ?>>UA</option>
                    </select>
                </div>
            </div>

            <div class="col-md-8">
                <div class="form-group">
                    <label for="specialization">Specialization</label>
                    <input type="text" name="specialization" class="form-control" id="specialization" value="<?= $_SESSION['user']['admin_member_edit']['specialization'] ?>">
                </div>
            </div>

            <div class="col-md-8">
                <button type="submit" name="submit" class="btn btn-primary">Save changes</button>
            </div>
        </form>
    </div>
</div>