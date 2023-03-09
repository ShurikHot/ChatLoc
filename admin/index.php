<?php
session_start();
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
    <link rel="stylesheet" href="../adminlte/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../adminlte/dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="../adminlte/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Ionicons -->
    <!--<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">-->
    <!-- Tempusdominus Bootstrap 4 -->
    <!--<link rel="stylesheet" href="../adminlte/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">-->
    <!-- iCheck -->
    <!--<link rel="stylesheet" href="../adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css">-->
    <!-- JQVMap -->
    <!--<link rel="stylesheet" href="../adminlte/plugins/jqvmap/jqvmap.min.css">-->
    <!-- Daterange picker -->
    <!--<link rel="stylesheet" href="../adminlte/plugins/daterangepicker/daterangepicker.css">-->
    <!-- summernote -->
    <!--<link rel="stylesheet" href="../adminlte/plugins/summernote/summernote-bs4.min.css">-->
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="../assets/logo.png" alt="ChatLocLogo" height="60" width="60">
  </div>

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="index3.html" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      <li class="nav-item">
        <a class="nav-link" data-widget="navbar-search" href="#" role="button">
          <i class="fas fa-search"></i>
        </a>
        <div class="navbar-search-block">
          <form class="form-inline">
            <div class="input-group input-group-sm">
              <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                  <i class="fas fa-search"></i>
                </button>
                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
          </form>
        </div>
      </li>

      <!-- Messages Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-comments"></i>
          <span class="badge badge-danger navbar-badge">3</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="../adminlte/dist/img/user1-128x128.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Brad Diesel
                  <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">Call me whenever you can...</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="../adminlte/dist/img/user8-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  John Pierce
                  <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">I got your message bro</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="../adminlte/dist/img/user3-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Nora Silvester
                  <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">The subject goes here</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
        </div>
      </li>
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge">15</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">15 Notifications</span>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> 4 new messages
            <span class="float-right text-muted text-sm">3 mins</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-users mr-2"></i> 8 friend requests
            <span class="float-right text-muted text-sm">12 hours</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-file mr-2"></i> 3 new reports
            <span class="float-right text-muted text-sm">2 days</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-controlsidebar-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="../assets/logo.png" alt="ChatLocLogo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Chat Loc</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="../assets/admin_logo.png" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="../profile.php" class="d-block">MegaAdmin</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <!--<div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>-->

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
                <a href="../vendor/admin/admin_content.php?content=members" class="nav-link <?php if ($_SESSION['user']['admin_category'] == "members") echo "active"?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Members Manage</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../vendor/admin/admin_content.php?content=statistics" class="nav-link <?php if ($_SESSION['user']['admin_category'] == "statistics") echo "active"?>">
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
                <a href="../vendor/admin/admin_content.php?content=messages" class="nav-link <?php if ($_SESSION['user']['admin_category'] == "messages") echo "active"?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Messages</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../vendor/admin/admin_content.php?content=blocked" class="nav-link <?php if ($_SESSION['user']['admin_category'] == "blocked") echo "active"?>">
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
                <a href="../vendor/admin/admin_content.php?content=settings" class="nav-link <?php if ($_SESSION['user']['admin_category'] == "settings") echo "active"?>">
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
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard v1</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <?php
        //key_exists('admin_member_edit', $_SESSION['user']) ? require_once('views/members_edit.php') :
        require_once('content.php');
      ?>
      <!--<div class="container-fluid">
        &lt;!&ndash; Small boxes (Stat box) &ndash;&gt;
        <div class="row">
          <div class="col-lg-3 col-6">
            &lt;!&ndash; small box &ndash;&gt;
            <div class="small-box bg-info">
              <div class="inner">
                <h3>150</h3>

                <p>New Orders</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          &lt;!&ndash; ./col &ndash;&gt;
          <div class="col-lg-3 col-6">
            &lt;!&ndash; small box &ndash;&gt;
            <div class="small-box bg-success">
              <div class="inner">
                <h3>53<sup style="font-size: 20px">%</sup></h3>

                <p>Bounce Rate</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          &lt;!&ndash; ./col &ndash;&gt;
          <div class="col-lg-3 col-6">
            &lt;!&ndash; small box &ndash;&gt;
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>44</h3>

                <p>User Registrations</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          &lt;!&ndash; ./col &ndash;&gt;
          <div class="col-lg-3 col-6">
            &lt;!&ndash; small box &ndash;&gt;
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>65</h3>

                <p>Unique Visitors</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          &lt;!&ndash; ./col &ndash;&gt;
        </div>
        &lt;!&ndash; /.row &ndash;&gt;
        &lt;!&ndash; Main row &ndash;&gt;
        <div class="row">
          &lt;!&ndash; Left col &ndash;&gt;
          <section class="col-lg-7 connectedSortable">
            &lt;!&ndash; Custom tabs (Charts with tabs)&ndash;&gt;
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="fas fa-chart-pie mr-1"></i>
                  Sales
                </h3>
                <div class="card-tools">
                  <ul class="nav nav-pills ml-auto">
                    <li class="nav-item">
                      <a class="nav-link active" href="#revenue-chart" data-toggle="tab">Area</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="#sales-chart" data-toggle="tab">Donut</a>
                    </li>
                  </ul>
                </div>
              </div>&lt;!&ndash; /.card-header &ndash;&gt;
              <div class="card-body">
                <div class="tab-content p-0">
                  &lt;!&ndash; Morris chart - Sales &ndash;&gt;
                  <div class="chart tab-pane active" id="revenue-chart"
                       style="position: relative; height: 300px;">
                      <canvas id="revenue-chart-canvas" height="300" style="height: 300px;"></canvas>
                   </div>
                  <div class="chart tab-pane" id="sales-chart" style="position: relative; height: 300px;">
                    <canvas id="sales-chart-canvas" height="300" style="height: 300px;"></canvas>
                  </div>
                </div>
              </div>&lt;!&ndash; /.card-body &ndash;&gt;
            </div>
            &lt;!&ndash; /.card &ndash;&gt;

            &lt;!&ndash; DIRECT CHAT &ndash;&gt;
            <div class="card direct-chat direct-chat-primary">
              <div class="card-header">
                <h3 class="card-title">Direct Chat</h3>

                <div class="card-tools">
                  <span title="3 New Messages" class="badge badge-primary">3</span>
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" title="Contacts" data-widget="chat-pane-toggle">
                    <i class="fas fa-comments"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              &lt;!&ndash; /.card-header &ndash;&gt;
              <div class="card-body">
                &lt;!&ndash; Conversations are loaded here &ndash;&gt;
                <div class="direct-chat-messages">
                  &lt;!&ndash; Message. Default to the left &ndash;&gt;
                  <div class="direct-chat-msg">
                    <div class="direct-chat-infos clearfix">
                      <span class="direct-chat-name float-left">Alexander Pierce</span>
                      <span class="direct-chat-timestamp float-right">23 Jan 2:00 pm</span>
                    </div>
                    &lt;!&ndash; /.direct-chat-infos &ndash;&gt;
                    <img class="direct-chat-img" src="../adminlte/dist/img/user1-128x128.jpg" alt="message user image">
                    &lt;!&ndash; /.direct-chat-img &ndash;&gt;
                    <div class="direct-chat-text">
                      Is this template really for free? That's unbelievable!
                    </div>
                    &lt;!&ndash; /.direct-chat-text &ndash;&gt;
                  </div>
                  &lt;!&ndash; /.direct-chat-msg &ndash;&gt;

                  &lt;!&ndash; Message to the right &ndash;&gt;
                  <div class="direct-chat-msg right">
                    <div class="direct-chat-infos clearfix">
                      <span class="direct-chat-name float-right">Sarah Bullock</span>
                      <span class="direct-chat-timestamp float-left">23 Jan 2:05 pm</span>
                    </div>
                    &lt;!&ndash; /.direct-chat-infos &ndash;&gt;
                    <img class="direct-chat-img" src="../adminlte/dist/img/user3-128x128.jpg" alt="message user image">
                    &lt;!&ndash; /.direct-chat-img &ndash;&gt;
                    <div class="direct-chat-text">
                      You better believe it!
                    </div>
                    &lt;!&ndash; /.direct-chat-text &ndash;&gt;
                  </div>
                  &lt;!&ndash; /.direct-chat-msg &ndash;&gt;

                  &lt;!&ndash; Message. Default to the left &ndash;&gt;
                  <div class="direct-chat-msg">
                    <div class="direct-chat-infos clearfix">
                      <span class="direct-chat-name float-left">Alexander Pierce</span>
                      <span class="direct-chat-timestamp float-right">23 Jan 5:37 pm</span>
                    </div>
                    &lt;!&ndash; /.direct-chat-infos &ndash;&gt;
                    <img class="direct-chat-img" src="../adminlte/dist/img/user1-128x128.jpg" alt="message user image">
                    &lt;!&ndash; /.direct-chat-img &ndash;&gt;
                    <div class="direct-chat-text">
                      Working with AdminLTE on a great new app! Wanna join?
                    </div>
                    &lt;!&ndash; /.direct-chat-text &ndash;&gt;
                  </div>
                  &lt;!&ndash; /.direct-chat-msg &ndash;&gt;

                  &lt;!&ndash; Message to the right &ndash;&gt;
                  <div class="direct-chat-msg right">
                    <div class="direct-chat-infos clearfix">
                      <span class="direct-chat-name float-right">Sarah Bullock</span>
                      <span class="direct-chat-timestamp float-left">23 Jan 6:10 pm</span>
                    </div>
                    &lt;!&ndash; /.direct-chat-infos &ndash;&gt;
                    <img class="direct-chat-img" src="../adminlte/dist/img/user3-128x128.jpg" alt="message user image">
                    &lt;!&ndash; /.direct-chat-img &ndash;&gt;
                    <div class="direct-chat-text">
                      I would love to.
                    </div>
                    &lt;!&ndash; /.direct-chat-text &ndash;&gt;
                  </div>
                  &lt;!&ndash; /.direct-chat-msg &ndash;&gt;

                </div>
                &lt;!&ndash;/.direct-chat-messages&ndash;&gt;

                &lt;!&ndash; Contacts are loaded here &ndash;&gt;
                <div class="direct-chat-contacts">
                  <ul class="contacts-list">
                    <li>
                      <a href="#">
                        <img class="contacts-list-img" src="../adminlte/dist/img/user1-128x128.jpg" alt="User Avatar">

                        <div class="contacts-list-info">
                          <span class="contacts-list-name">
                            Count Dracula
                            <small class="contacts-list-date float-right">2/28/2015</small>
                          </span>
                          <span class="contacts-list-msg">How have you been? I was...</span>
                        </div>
                        &lt;!&ndash; /.contacts-list-info &ndash;&gt;
                      </a>
                    </li>
                    &lt;!&ndash; End Contact Item &ndash;&gt;
                    <li>
                      <a href="#">
                        <img class="contacts-list-img" src="../adminlte/dist/img/user7-128x128.jpg" alt="User Avatar">

                        <div class="contacts-list-info">
                          <span class="contacts-list-name">
                            Sarah Doe
                            <small class="contacts-list-date float-right">2/23/2015</small>
                          </span>
                          <span class="contacts-list-msg">I will be waiting for...</span>
                        </div>
                        &lt;!&ndash; /.contacts-list-info &ndash;&gt;
                      </a>
                    </li>
                    &lt;!&ndash; End Contact Item &ndash;&gt;
                    <li>
                      <a href="#">
                        <img class="contacts-list-img" src="../adminlte/dist/img/user3-128x128.jpg" alt="User Avatar">

                        <div class="contacts-list-info">
                          <span class="contacts-list-name">
                            Nadia Jolie
                            <small class="contacts-list-date float-right">2/20/2015</small>
                          </span>
                          <span class="contacts-list-msg">I'll call you back at...</span>
                        </div>
                        &lt;!&ndash; /.contacts-list-info &ndash;&gt;
                      </a>
                    </li>
                    &lt;!&ndash; End Contact Item &ndash;&gt;
                    <li>
                      <a href="#">
                        <img class="contacts-list-img" src="../adminlte/dist/img/user5-128x128.jpg" alt="User Avatar">

                        <div class="contacts-list-info">
                          <span class="contacts-list-name">
                            Nora S. Vans
                            <small class="contacts-list-date float-right">2/10/2015</small>
                          </span>
                          <span class="contacts-list-msg">Where is your new...</span>
                        </div>
                        &lt;!&ndash; /.contacts-list-info &ndash;&gt;
                      </a>
                    </li>
                    &lt;!&ndash; End Contact Item &ndash;&gt;
                    <li>
                      <a href="#">
                        <img class="contacts-list-img" src="../adminlte/dist/img/user6-128x128.jpg" alt="User Avatar">

                        <div class="contacts-list-info">
                          <span class="contacts-list-name">
                            John K.
                            <small class="contacts-list-date float-right">1/27/2015</small>
                          </span>
                          <span class="contacts-list-msg">Can I take a look at...</span>
                        </div>
                        &lt;!&ndash; /.contacts-list-info &ndash;&gt;
                      </a>
                    </li>
                    &lt;!&ndash; End Contact Item &ndash;&gt;
                    <li>
                      <a href="#">
                        <img class="contacts-list-img" src="../adminlte/dist/img/user8-128x128.jpg" alt="User Avatar">

                        <div class="contacts-list-info">
                          <span class="contacts-list-name">
                            Kenneth M.
                            <small class="contacts-list-date float-right">1/4/2015</small>
                          </span>
                          <span class="contacts-list-msg">Never mind I found...</span>
                        </div>
                        &lt;!&ndash; /.contacts-list-info &ndash;&gt;
                      </a>
                    </li>
                    &lt;!&ndash; End Contact Item &ndash;&gt;
                  </ul>
                  &lt;!&ndash; /.contacts-list &ndash;&gt;
                </div>
                &lt;!&ndash; /.direct-chat-pane &ndash;&gt;
              </div>
              &lt;!&ndash; /.card-body &ndash;&gt;
              <div class="card-footer">
                <form action="#" method="post">
                  <div class="input-group">
                    <input type="text" name="message" placeholder="Type Message ..." class="form-control">
                    <span class="input-group-append">
                      <button type="button" class="btn btn-primary">Send</button>
                    </span>
                  </div>
                </form>
              </div>
              &lt;!&ndash; /.card-footer&ndash;&gt;
            </div>
            &lt;!&ndash;/.direct-chat &ndash;&gt;

            &lt;!&ndash; TO DO List &ndash;&gt;
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="ion ion-clipboard mr-1"></i>
                  To Do List
                </h3>

                <div class="card-tools">
                  <ul class="pagination pagination-sm">
                    <li class="page-item"><a href="#" class="page-link">&laquo;</a></li>
                    <li class="page-item"><a href="#" class="page-link">1</a></li>
                    <li class="page-item"><a href="#" class="page-link">2</a></li>
                    <li class="page-item"><a href="#" class="page-link">3</a></li>
                    <li class="page-item"><a href="#" class="page-link">&raquo;</a></li>
                  </ul>
                </div>
              </div>
              &lt;!&ndash; /.card-header &ndash;&gt;
              <div class="card-body">
                <ul class="todo-list" data-widget="todo-list">
                  <li>
                    &lt;!&ndash; drag handle &ndash;&gt;
                    <span class="handle">
                      <i class="fas fa-ellipsis-v"></i>
                      <i class="fas fa-ellipsis-v"></i>
                    </span>
                    &lt;!&ndash; checkbox &ndash;&gt;
                    <div  class="icheck-primary d-inline ml-2">
                      <input type="checkbox" value="" name="todo1" id="todoCheck1">
                      <label for="todoCheck1"></label>
                    </div>
                    &lt;!&ndash; todo text &ndash;&gt;
                    <span class="text">Design a nice theme</span>
                    &lt;!&ndash; Emphasis label &ndash;&gt;
                    <small class="badge badge-danger"><i class="far fa-clock"></i> 2 mins</small>
                    &lt;!&ndash; General tools such as edit or delete&ndash;&gt;
                    <div class="tools">
                      <i class="fas fa-edit"></i>
                      <i class="fas fa-trash-o"></i>
                    </div>
                  </li>
                  <li>
                    <span class="handle">
                      <i class="fas fa-ellipsis-v"></i>
                      <i class="fas fa-ellipsis-v"></i>
                    </span>
                    <div  class="icheck-primary d-inline ml-2">
                      <input type="checkbox" value="" name="todo2" id="todoCheck2" checked>
                      <label for="todoCheck2"></label>
                    </div>
                    <span class="text">Make the theme responsive</span>
                    <small class="badge badge-info"><i class="far fa-clock"></i> 4 hours</small>
                    <div class="tools">
                      <i class="fas fa-edit"></i>
                      <i class="fas fa-trash-o"></i>
                    </div>
                  </li>
                  <li>
                    <span class="handle">
                      <i class="fas fa-ellipsis-v"></i>
                      <i class="fas fa-ellipsis-v"></i>
                    </span>
                    <div  class="icheck-primary d-inline ml-2">
                      <input type="checkbox" value="" name="todo3" id="todoCheck3">
                      <label for="todoCheck3"></label>
                    </div>
                    <span class="text">Let theme shine like a star</span>
                    <small class="badge badge-warning"><i class="far fa-clock"></i> 1 day</small>
                    <div class="tools">
                      <i class="fas fa-edit"></i>
                      <i class="fas fa-trash-o"></i>
                    </div>
                  </li>
                  <li>
                    <span class="handle">
                      <i class="fas fa-ellipsis-v"></i>
                      <i class="fas fa-ellipsis-v"></i>
                    </span>
                    <div  class="icheck-primary d-inline ml-2">
                      <input type="checkbox" value="" name="todo4" id="todoCheck4">
                      <label for="todoCheck4"></label>
                    </div>
                    <span class="text">Let theme shine like a star</span>
                    <small class="badge badge-success"><i class="far fa-clock"></i> 3 days</small>
                    <div class="tools">
                      <i class="fas fa-edit"></i>
                      <i class="fas fa-trash-o"></i>
                    </div>
                  </li>
                  <li>
                    <span class="handle">
                      <i class="fas fa-ellipsis-v"></i>
                      <i class="fas fa-ellipsis-v"></i>
                    </span>
                    <div  class="icheck-primary d-inline ml-2">
                      <input type="checkbox" value="" name="todo5" id="todoCheck5">
                      <label for="todoCheck5"></label>
                    </div>
                    <span class="text">Check your messages and notifications</span>
                    <small class="badge badge-primary"><i class="far fa-clock"></i> 1 week</small>
                    <div class="tools">
                      <i class="fas fa-edit"></i>
                      <i class="fas fa-trash-o"></i>
                    </div>
                  </li>
                  <li>
                    <span class="handle">
                      <i class="fas fa-ellipsis-v"></i>
                      <i class="fas fa-ellipsis-v"></i>
                    </span>
                    <div  class="icheck-primary d-inline ml-2">
                      <input type="checkbox" value="" name="todo6" id="todoCheck6">
                      <label for="todoCheck6"></label>
                    </div>
                    <span class="text">Let theme shine like a star</span>
                    <small class="badge badge-secondary"><i class="far fa-clock"></i> 1 month</small>
                    <div class="tools">
                      <i class="fas fa-edit"></i>
                      <i class="fas fa-trash-o"></i>
                    </div>
                  </li>
                </ul>
              </div>
              &lt;!&ndash; /.card-body &ndash;&gt;
              <div class="card-footer clearfix">
                <button type="button" class="btn btn-primary float-right"><i class="fas fa-plus"></i> Add item</button>
              </div>
            </div>
            &lt;!&ndash; /.card &ndash;&gt;
          </section>
          &lt;!&ndash; /.Left col &ndash;&gt;
          &lt;!&ndash; right col (We are only adding the ID to make the widgets sortable)&ndash;&gt;
          <section class="col-lg-5 connectedSortable">

            &lt;!&ndash; Map card &ndash;&gt;
            <div class="card bg-gradient-primary">
              <div class="card-header border-0">
                <h3 class="card-title">
                  <i class="fas fa-map-marker-alt mr-1"></i>
                  Visitors
                </h3>
                &lt;!&ndash; card tools &ndash;&gt;
                <div class="card-tools">
                  <button type="button" class="btn btn-primary btn-sm daterange" title="Date range">
                    <i class="far fa-calendar-alt"></i>
                  </button>
                  <button type="button" class="btn btn-primary btn-sm" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
                &lt;!&ndash; /.card-tools &ndash;&gt;
              </div>
              <div class="card-body">
                <div id="world-map" style="height: 250px; width: 100%;"></div>
              </div>
              &lt;!&ndash; /.card-body&ndash;&gt;
              <div class="card-footer bg-transparent">
                <div class="row">
                  <div class="col-4 text-center">
                    <div id="sparkline-1"></div>
                    <div class="text-white">Visitors</div>
                  </div>
                  &lt;!&ndash; ./col &ndash;&gt;
                  <div class="col-4 text-center">
                    <div id="sparkline-2"></div>
                    <div class="text-white">Online</div>
                  </div>
                  &lt;!&ndash; ./col &ndash;&gt;
                  <div class="col-4 text-center">
                    <div id="sparkline-3"></div>
                    <div class="text-white">Sales</div>
                  </div>
                  &lt;!&ndash; ./col &ndash;&gt;
                </div>
                &lt;!&ndash; /.row &ndash;&gt;
              </div>
            </div>
            &lt;!&ndash; /.card &ndash;&gt;

            &lt;!&ndash; solid sales graph &ndash;&gt;
            <div class="card bg-gradient-info">
              <div class="card-header border-0">
                <h3 class="card-title">
                  <i class="fas fa-th mr-1"></i>
                  Sales Graph
                </h3>

                <div class="card-tools">
                  <button type="button" class="btn bg-info btn-sm" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn bg-info btn-sm" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <canvas class="chart" id="line-chart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
              </div>
              &lt;!&ndash; /.card-body &ndash;&gt;
              <div class="card-footer bg-transparent">
                <div class="row">
                  <div class="col-4 text-center">
                    <input type="text" class="knob" data-readonly="true" value="20" data-width="60" data-height="60"
                           data-fgColor="#39CCCC">

                    <div class="text-white">Mail-Orders</div>
                  </div>
                  &lt;!&ndash; ./col &ndash;&gt;
                  <div class="col-4 text-center">
                    <input type="text" class="knob" data-readonly="true" value="50" data-width="60" data-height="60"
                           data-fgColor="#39CCCC">

                    <div class="text-white">Online</div>
                  </div>
                  &lt;!&ndash; ./col &ndash;&gt;
                  <div class="col-4 text-center">
                    <input type="text" class="knob" data-readonly="true" value="30" data-width="60" data-height="60"
                           data-fgColor="#39CCCC">

                    <div class="text-white">In-Store</div>
                  </div>
                  &lt;!&ndash; ./col &ndash;&gt;
                </div>
                &lt;!&ndash; /.row &ndash;&gt;
              </div>
              &lt;!&ndash; /.card-footer &ndash;&gt;
            </div>
            &lt;!&ndash; /.card &ndash;&gt;

            &lt;!&ndash; Calendar &ndash;&gt;
            <div class="card bg-gradient-success">
              <div class="card-header border-0">

                <h3 class="card-title">
                  <i class="far fa-calendar-alt"></i>
                  Calendar
                </h3>
                &lt;!&ndash; tools card &ndash;&gt;
                <div class="card-tools">
                  &lt;!&ndash; button with a dropdown &ndash;&gt;
                  <div class="btn-group">
                    <button type="button" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown" data-offset="-52">
                      <i class="fas fa-bars"></i>
                    </button>
                    <div class="dropdown-menu" role="menu">
                      <a href="#" class="dropdown-item">Add new event</a>
                      <a href="#" class="dropdown-item">Clear events</a>
                      <div class="dropdown-divider"></div>
                      <a href="#" class="dropdown-item">View calendar</a>
                    </div>
                  </div>
                  <button type="button" class="btn btn-success btn-sm" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-success btn-sm" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
                &lt;!&ndash; /. tools &ndash;&gt;
              </div>
              &lt;!&ndash; /.card-header &ndash;&gt;
              <div class="card-body pt-0">
                &lt;!&ndash;The calendar &ndash;&gt;
                <div id="calendar" style="width: 100%"></div>
              </div>
              &lt;!&ndash; /.card-body &ndash;&gt;
            </div>
            &lt;!&ndash; /.card &ndash;&gt;
          </section>
          &lt;!&ndash; right col &ndash;&gt;
        </div>
        &lt;!&ndash; /.row (main row) &ndash;&gt;
      </div>&lt;!&ndash; /.container-fluid &ndash;&gt;-->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.2.0
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
<script src="../adminlte/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="../adminlte/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="../adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="../adminlte/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="../adminlte/dist/js/adminlte.js"></script>
<!-- ChartJS -->
<!--<script src="../adminlte/plugins/chart.js/Chart.min.js"></script>-->
<!-- Sparkline -->
<!--<script src="../adminlte/plugins/sparklines/sparkline.js"></script>-->
<!-- JQVMap -->
<!--<script src="../adminlte/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="../adminlte/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>-->
<!-- jQuery Knob Chart -->
<!--<script src="../adminlte/plugins/jquery-knob/jquery.knob.min.js"></script>-->
<!-- daterangepicker -->
<!--<script src="../adminlte/plugins/moment/moment.min.js"></script>
<script src="../adminlte/plugins/daterangepicker/daterangepicker.js"></script>-->
<!-- Tempusdominus Bootstrap 4 -->
<!--<script src="../adminlte/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>-->
<!-- Summernote -->
<!--<script src="../adminlte/plugins/summernote/summernote-bs4.min.js"></script>-->
<!-- AdminLTE for demo purposes -->
<!--<script src="../adminlte/dist/js/demo.js"></script>-->
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<!--<script src="../adminlte/dist/js/pages/dashboard.js"></script>-->
</body>
</html>
