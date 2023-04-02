<?php
/*require_once '../app/config/db.php';
require_once '../app/config/params.php';

ini_set('session.gc_maxlifetime', $session_lifetime);
ini_set('session.gc_probability', 1);
ini_set('session.gc_divisor', 1);
session_start();

$id = $_SESSION['user']['id'];
$query_visit = mysqli_query($connect, "UPDATE `members` SET `last_visit` = NOW() WHERE `id` = $id");

if ($_SESSION['user']['id'] != "1" || !isset($_SESSION['user'])) {
    header('Location: ../index.php');
}*/
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>ChatLoc | Admin Area</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../../../public/adminlte/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../../../public/adminlte/dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="../../../public/adminlte/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">

    <script src="https://www.gstatic.com/charts/loader.js"></script>

</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="../public/assets/img/logo.png" alt="ChatLocLogo" height="60" width="60">
  </div>

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="../chatlist.php" class="nav-link">Go to <b>ChatList</b></a>
      </li>

      <li class="nav-item d-none d-sm-inline-block">
        <a href="../profile.php" class="nav-link">Your <b>Profile</b></a>
      </li>

      <li class="nav-item d-none d-sm-inline-block">
        <a href="../vendor/admin/admin_faker.php" class="nav-link">!!! FAKER !!!</a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <img src="../public/assets/img/logo.png" alt="ChatLocLogo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Chat Loc</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="../public/assets/img/admin_logo.png" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="../profile.php" class="d-block">MegaAdmin</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Members
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="../vendor/admin/admin_content.php?content=members" class="nav-link <?php if (isset($_SESSION['user']['admin_category']) &&
                    $_SESSION['user']['admin_category'] == "members") echo "active"?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Members Manage</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../vendor/admin/admin_content.php?content=statistics" class="nav-link <?php if (isset($_SESSION['user']['admin_category']) &&
                    $_SESSION['user']['admin_category'] == "statistics") echo "active"?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Statistics</p>
                </a>
              </li>
            </ul>
          </li>
        </ul>

        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item menu-open">
            <a href="#" class="nav-link active">
              <!--<i class="nav-icon fas fa-users"></i>-->
              <i class="nav-icon fas fa-comments"></i>
              <p>
                Chat
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="../vendor/admin/admin_content.php?content=chat_list" class="nav-link <?php if (isset($_SESSION['user']['admin_category']) &&
                        $_SESSION['user']['admin_category'] == "chat_list") echo "active"?>">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Chat List</p>
                    </a>
                </li>
            </ul>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="../vendor/admin/admin_content.php?content=chat_approve" class="nav-link <?php if (isset($_SESSION['user']['admin_category']) &&
                        $_SESSION['user']['admin_category'] == "chat_approve") echo "active"?>">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Chat for approve</p>
                    </a>
                </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="../vendor/admin/admin_content.php?content=blocked" class="nav-link <?php if (isset($_SESSION['user']['admin_category']) &&
                    $_SESSION['user']['admin_category'] == "blocked") echo "active"?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Blocked Members</p>
                </a>
              </li>
            </ul>
          </li>
        </ul>

        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item menu-open">
            <a href="#" class="nav-link active">
              <!--<i class="nav-icon fas fa-users"></i>-->
              <i class="nav-icon fas fa-sliders-h"></i>
              <p>
                Chat's Settings
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="../vendor/admin/admin_content.php?content=settings" class="nav-link <?php if (isset($_SESSION['user']['admin_category']) &&
                    $_SESSION['user']['admin_category'] == "settings") echo "active"?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Design Settings</p>
                </a>
              </li>
            </ul>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <!--<h1 class="m-0">Dashboard</h1>-->
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <!--<li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard v1</li>-->
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content" id="content">
      <?php
        require_once('content.php');
      ?>
    </section>

    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2023 <a href="#">ChatLoc</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 1.0.0
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

    <!-- jQuery -->
    <script src="../../../public/adminlte/plugins/jquery/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="../../../public/adminlte/plugins/jquery-ui/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
      $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="../../../public/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="../../../public/adminlte/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../../../public/adminlte/dist/js/adminlte.js"></script>

</body>
</html>