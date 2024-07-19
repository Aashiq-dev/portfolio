<!DOCTYPE html>
<html lang="en">
<?php
require_once "user_auth.php";
$curentpage = basename($_SERVER['PHP_SELF'], ".php");
?>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo $title; ?></title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">
  <style>
    .red {
      border-color: #FF0000;
      box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(255, 0, 0, 0.6);
    }

    .green {
      border-color: #28a745;
      box-shadow: 0 0 0 0.2rem rgba(40, 167, 69, 0.25);
    }

    .preloader {
      display: flex;
      justify-content: center;
      align-items: center;
      background: linear-gradient(135deg, #000033, #000000);
      /* Dark blue to black gradient
    height: 100vh; /* Full viewport height */
      width: 100vw;
      /* Full viewport width */
      position: fixed;
      /* Position it over the entire page */
      top: 0;
      left: 0;
      z-index: 9999;
      /* High z-index to ensure it's on top of other elements */
    }
  </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">
    <!-- Preloader -->
    <!-- <div class="preloader d-flex justify-content-center align-items-center">
      <img class="animation__shake" src="../Images/Aashiq (2).jpg" alt="" height="400" width="400">
    </div> -->
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="index.php" class="nav-link">Home</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="../index.php#contact" target="_blank" class="nav-link">Contact</a>
        </li>
      </ul>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" data-widget="fullscreen" href="#" role="button">
            <i class="fas fa-expand-arrows-alt"></i>
          </a>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="index.php" class="brand-link">
        <span class="brand-text font-weight-light">Portfolio | Admin</span>
      </a>

      <div class="sidebar"><!-- Sidebar -->
        <nav class="mt-2"><!-- Sidebar Menu -->
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <li class="nav-item">
              <a href="index.php" class="nav-link <?php echo $curentpage == 'index' ? 'active' : ''; ?>">
                <i class="nav-icon fas fa-home"></i>
                <p>Home</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="skills.php" class="nav-link <?php if ($curentpage == 'skills') {
                                                      echo 'active';
                                                    } else if ($curentpage == 'skills_add') {
                                                      echo 'active';
                                                    } else if ($curentpage == 'skill_update') {
                                                      echo 'active';
                                                    } ?>">
                <i class=" nav-icon fas fa-th"></i>
                <p>Skills</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="education.php" class="nav-link <?php if ($curentpage == 'education') {
                                                        echo 'active';
                                                      } else if ($curentpage == 'education_add') {
                                                        echo 'active';
                                                      } else if ($curentpage == 'education_update') {
                                                        echo 'active';
                                                      } ?>">
                <i class=" nav-icon fas fa-book"></i>
                <p>Education</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="services.php" class="nav-link <?php if ($curentpage == 'services') {
                                                        echo 'active';
                                                      } else if ($curentpage == 'services_add') {
                                                        echo 'active';
                                                      } else if ($curentpage == 'service_update') {
                                                        echo 'active';
                                                      } ?>">
                <i class=" nav-icon fas fa-chart-pie"></i>
                <p>Services</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="projects.php" class="nav-link <?php if ($curentpage == 'projects') {
                                                        echo 'active';
                                                      } else if ($curentpage == 'project_add') {
                                                        echo 'active';
                                                      } else if ($curentpage == 'project_update') {
                                                        echo 'active';
                                                      } ?>">
                <i class=" nav-icon fas fa-briefcase"></i>
                <p>Projects</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="certificates.php" class="nav-link <?php if ($curentpage == 'certificates') {
                                                            echo 'active';
                                                          } else if ($curentpage == 'certificate_add') {
                                                            echo 'active';
                                                          } else if ($curentpage == 'certificate_update') {
                                                            echo 'active';
                                                          } ?>">
                <i class=" nav-icon fas fa-certificate"></i>
                <p>Certificates</p>
              </a>
            </li>
            <hr>
            <div class="mb-5 mt-5 pt-3">
            </div>
            <li class="nav-item bg-danger rounded rounded-pill">
              <a href="../login.php" class="nav-link text-center">
                <i class="fa-solid fa-right-from-bracket"></i>
                <p>Logout</p>
              </a>
            </li>
          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>

    <div class="content-wrapper"><!-- Content Wrapper. Contains page content -->
      <div class="content-header"><!-- Content Header (Page header) -->
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0"><?= $title ?></h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="index.php">Admin</a></li>
                <li class="breadcrumb-item active"><?= $title ?></li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div><!-- /.Content Header (Page header) -->

      <section class="content"><!-- Main content -->
        <div class="container-fluid">
          <div class="row"><!-- Main row -->