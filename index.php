<?php
    require_once 'vendor/admin/params.php';

    ini_set('session.gc_maxlifetime', $session_lifetime);
    ini_set('session.gc_probability', 1);
    ini_set('session.gc_divisor', 1);
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
    <title>Signin ChatLoc</title>
    <!--<link href="/assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">-->
    <link href="assets/css/style.css" rel="stylesheet">
</head>

<body>
<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,700' rel='stylesheet' type='text/css'>

<div class="container">
    <div class="frame">
        <div class="nav">
            <ul class"links">
                <li class="signin-active"><a class="btn">Sign in</a></li>
                <li class="signup-inactive"><a class="btn">Sign up </a></li>
            </ul>
        </div>
        <div ng-app ng-init="checked = false">
            <form class="form-signin" action="vendor/signin.php" method="post" name="form">
                <label for="email">Email address</label>
                <input class="form-styling" type="email" name="email" placeholder="name@example.com"/>

                <label for="password">Password</label>
                <input class="form-styling" type="password" name="password" placeholder="Password"/>


                <!--<input type="checkbox" id="checkbox"/>
                <label for="checkbox" ><span class="ui"></span>Keep me signed in</label>-->
                <!--<div class="btn-animate">
                    <a class="btn-signin">Sign in</a>
                </div>-->
                <button class="btn-animate btn-signin" type="submit">Sign in</button>
                <p align="center">
                    <?php
                    if (isset($_SESSION['message'])) {
                        echo $_SESSION['message'];
                        unset($_SESSION['message']);
                    }
                    ?>
                </p>
            </form>

            <form class="form-signup" action="vendor/signup.php" method="post" name="form" enctype="multipart/form-data">
                <label for="fullname">Full name</label>
                <input class="form-styling" type="text" name="name" placeholder="Full name" />

                <label for="nickname">Nickname</label>
                <input class="form-styling" type="text" name="nickname" placeholder="Nickname (max 20 symbols)" maxlength="20" />

                <label for="email">Email address</label>
                <input class="form-styling" type="email" name="email" placeholder="Email address" />

                <label for="password">Password</label>
                <input class="form-styling" type="password" name="password" placeholder="Password" />

                <label for="confirmpassword">Confirm password</label>
                <input class="form-styling" type="password" name="confirm_password" placeholder="Password Confirm" />

                <label for="phone_num">Phone number</label>
                <input class="form-styling" type="tel" name="phone_num" placeholder="Phone number (10 digits)" maxlength="10"/>

                <!--<label for="avatar">Avatar</label>
                <input class="form-styling" type="file" name="avatar" accept="image/*" placeholder="Avatar"/>-->

                <label for="language">Language</label>
                <select class="form-styling" id="language" name="language">
                    <option value="en" selected>EN</option>
                    <option value="ua">UA</option>
                </select>

                <label for="country">Country</label>
                <input class="form-styling" type="text" name="country" placeholder="Country"/>

                <label for="gender">Gender</label>
                    <input type="radio" id="genderradio1" name="gender" class="custom-control-input" value="male">
                    <p class="custom-control-label" for="genderradio1">Male</p>
                    <input type="radio" id="genderradio2" name="gender" class="custom-control-input" value="female">
                    <p class="custom-control-label" for="genderradio2">Female</p>
                    <input type="radio" id="genderradio3" name="gender" class="custom-control-input" value="no_select" checked="">
                    <p class="custom-control-label" for="genderradio3">No selection</p>
                <label for=""></label>
                <label for=""></label>

                <label for="specialization">Specialization</label>
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="speccheck1" name="specialization[]" value="c_science">
                    <label class="custom-control-label" for="speccheck1">Computer Science</label>
                    <input type="checkbox" class="custom-control-input" id="speccheck2" name="specialization[]" value="inf_technology">
                    <label class="custom-control-label" for="speccheck2">Information Technology</label>
                    <input type="checkbox" class="custom-control-input" id="speccheck3" name="specialization[]" value="c_architecture">
                    <label class="custom-control-label" for="speccheck3">Computer Architecture</label>
                    <input type="checkbox" class="custom-control-input" id="speccheck4" name="specialization[]" value="t_communication">
                    <label class="custom-control-label" for="speccheck4">Tele Communication</label>
                </div>
                <label for=""></label>
                <label for=""></label>

                <label for="comment">Comment</label>
                <textarea class="form-styling" id="exampleTextarea" name="comment" rows="1"></textarea>

                <button class="btn-signup" type="submit">Sign up</button>

                    <?php
                    if (isset($_SESSION['message'])) {
                        echo $_SESSION['message'];
                        unset($_SESSION['message']);
                    }
                    ?>
            </form>

        </div>

            <!--<div  class="success">
                <svg width="270" height="270" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                     viewBox="0 0 60 60" id="check" ng-class="checked ? 'checked' : ''">
                    <path fill="#ffffff" d="M40.61,23.03L26.67,36.97L13.495,23.788c-1.146-1.147-1.359-2.936-0.504-4.314
                  c3.894-6.28,11.169-10.243,19.283-9.348c9.258,1.021,16.694,8.542,17.622,17.81c1.232,12.295-8.683,22.607-20.849,22.042
                  c-9.9-0.46-18.128-8.344-18.972-18.218c-0.292-3.416,0.276-6.673,1.51-9.578" />
                    <div class="successtext">
                        <p> Thanks for signing up! Check your email for confirmation.</p>
                    </div>
            </div>-->
    </div>

        <!--<div class="forgot">
            <a href="#">Forgot your password?</a>
        </div>-->

        <!--<div>
            <div class="cover-photo"></div>
            <div class="profile-photo"></div>
            <h1 class="welcome">Welcome, Chris</h1>
            <a class="btn-goback" value="Refresh" onClick="history.go()">Go back</a>
        </div>-->
    </div>

    <a id="refresh" value="Refresh" onClick="history.go()">
        <svg class="refreshicon"   version="1.1" id="Capa_1"  xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
             width="25px" height="25px" viewBox="0 0 322.447 322.447" style="enable-background:new 0 0 322.447 322.447;"
             xml:space="preserve">
         <path  d="M321.832,230.327c-2.133-6.565-9.184-10.154-15.75-8.025l-16.254,5.281C299.785,206.991,305,184.347,305,161.224
                c0-84.089-68.41-152.5-152.5-152.5C68.411,8.724,0,77.135,0,161.224s68.411,152.5,152.5,152.5c6.903,0,12.5-5.597,12.5-12.5
                c0-6.902-5.597-12.5-12.5-12.5c-70.304,0-127.5-57.195-127.5-127.5c0-70.304,57.196-127.5,127.5-127.5
                c70.305,0,127.5,57.196,127.5,127.5c0,19.372-4.371,38.337-12.723,55.568l-5.553-17.096c-2.133-6.564-9.186-10.156-15.75-8.025
                c-6.566,2.134-10.16,9.186-8.027,15.751l14.74,45.368c1.715,5.283,6.615,8.642,11.885,8.642c1.279,0,2.582-0.198,3.865-0.614
                l45.369-14.738C320.371,243.946,323.965,236.895,321.832,230.327z"/>
    </svg>
    </a>
</div>
<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src='http://cdnjs.cloudflare.com/ajax/libs/angular.js/1.3.14/angular.min.js'></script>

<script src="assets/js/index.js"></script>

</body>
</html>
