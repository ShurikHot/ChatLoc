<?php
    session_start();

    if(isset($_SESSION['user'])) {
        header('Location: /profile.php');
    }
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ChatLoc Registration</title>
    <link href="/assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>
<script src="/assets/bootstrap/js/bootstrap.bundle.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>


<div class="container-fluid">
    <div class="bs-docs-section">
        <div class="form-signin m-auto row">
            <div class="col-sm-12">
                <div class="page-header">
                    <br>
                    <h2 id="forms" align="center">ChatLoc Registration</h2>
                </div>
            </div>
        </div>
        <form action="../vendor/signup.php" method="post">
            <div class="form-signin row">
                <div class="col-sm-4">
                    <div class="bs-component">
                        <div class="form-group">
                            <label class="col-form-label" for="name">Name</label>
                            <input type="text" class="form-control" placeholder="Name" id="name" name="name" required>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label" for="nickname">Nickname</label>
                            <input type="text" class="form-control" placeholder="Nickname (max 20 symbols)" id="nickname" name="nickname" maxlength="20" required>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label" for="phonenumber">Phone number</label>
                            <input type="tel" class="form-control" placeholder="Phone number (10 digits)" id="phonenumber" name="phone_num" maxlength="10">
                        </div>
                        <div class="form-group">
                            <label class="col-form-label" for="email">Email address</label>
                            <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="Enter email" required>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label" for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label" for="confirmpassword">Password Confirm</label>
                            <input type="password" class="form-control" id="confirmpassword" name="confirm_password" placeholder="Password Confirm" required>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4 offset-lg-1">
                    <div class="form-group">
                        <label class="col-form-label" for="language">Language</label>
                        <select class="form-control" id="language" name="language">
                            <option value="en">EN</option>
                            <option value="ua">UA</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="country">Country</label>
                        <input type="text" class="form-control" placeholder="Country" id="country" name="country">
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="language">Gender</label>
                        <div class="custom-control custom-radio">
                            <input type="radio" id="genderradio1" name="gender" class="custom-control-input" value="male">
                            <label class="custom-control-label" for="genderradio1">Male</label>

                            <input type="radio" id="genderradio2" name="gender" class="custom-control-input" value="female">
                            <label class="custom-control-label" for="genderradio2">Female</label>

                            <input type="radio" id="genderradio3" name="gender" class="custom-control-input" value="no_select" checked="">
                            <label class="custom-control-label" for="genderradio3">No selection</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="specialization">Specialization</label>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="speccheck1" name="specialization[]" value="c_science">
                            <label class="custom-control-label" for="speccheck1">Computer Science</label>
                            <input type="checkbox" class="custom-control-input" id="speccheck2" name="specialization[]" value="inf_technology">
                            <label class="custom-control-label" for="speccheck2">Information Technology</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="speccheck3" name="specialization[]" value="c_architecture">
                            <label class="custom-control-label" for="speccheck3">Computer Architecture</label>
                            <input type="checkbox" class="custom-control-input" id="speccheck4" name="specialization[]" value="t_communication">
                            <label class="custom-control-label" for="speccheck4">Tele Communication</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleTextarea">Comment</label>
                        <textarea class="form-control" id="exampleTextarea" name="comment" rows="5"></textarea>
                    </div>
                    <br>
                </div>
            </div>
            <button type="submit" class="w-auto btn btn-lg btn-primary">Submit</button>
            <br>
            <p align="center">
                <?php
                    if (isset($_SESSION['message'])) {
                        echo '!!! ' . $_SESSION['message'] . ' !!!';
                        unset($_SESSION['message']);
                    }
                ?>
            </p>
        </form>
    </div>
</div>
</body>
</html>