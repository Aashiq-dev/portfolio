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

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <link href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css' rel='stylesheet'>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">


  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="plugins/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="plugins/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="plugins/summernote-bs4.min.css">
  <style>
    .red {
      border-color: #FF0000;
      box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(255, 0, 0, 0.6);
    }

    .green {
      border-color: #28a745;
      box-shadow: 0 0 0 0.2rem rgba(40, 167, 69, 0.25);
    }
  </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
      </ul>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="index.php" class="brand-link">
        <span class="brand-text font-weight-light">Portfolio | Admin</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <!-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img src="../Images/main_image/Aashiq.png" class="" alt="User Image" width="100px">
          </div>
          <div class="info">
            <a href="#" class="d-block">Aashiq</a>
          </div>
        </div> -->

        <!-- Sidebar Menu -->
        <nav class="mt-2">
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
            <li class="nav-item mb-5 pb-5">
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
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>
    </nav>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2 bg-dark rounded p-3">
            <div class="col-6">
              <h1 class="m-0"><?= $title ?></h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="home.php" style="color: white;">Admin</a></li>
                <li class="breadcrumb-item active" style="color: white;"><?= $title ?></li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div><!-- /.content-header -->

      <!-- Your content goes here -->

