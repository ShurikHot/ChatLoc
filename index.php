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
    <title>Signin ChatLoc</title>
    <link href="/assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="/assets/sign-in.css" rel="stylesheet">
</head>
<body class="text-center">

<main class="form-signin w-100 m-auto">
    <form method="post" action="vendor/signin.php">
        <h1 class="h3 mb-3 fw-normal">Please sign in</h1>

        <div class="form-floating">
            <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com" required>
            <label for="floatingInput">Email address</label>
        </div>
        <div class="form-floating">
            <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
            <label for="floatingPassword">Password</label>
        </div>
        <button class="w-100 btn btn-lg btn-primary" type="submit">Sign in</button>

    </form>
    <p></p>
    <!--<form action="registration.php">-->
    <a href="/registration.php" class="w-100 btn btn-sm btn-outline-primary">Registration</a>
    <br>
    <p align="center">
        <?php
        if (isset($_SESSION['message'])) {
            echo '!!! ' . $_SESSION['message'] . ' !!!';
            unset($_SESSION['message']);
        }
        ?>
    </p>
    <!--</form>-->

</main>


</body>
</html>
