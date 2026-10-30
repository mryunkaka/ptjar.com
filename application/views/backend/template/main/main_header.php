<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title><?= $tabtitle ?></title>
    <meta content="" name="description">
    <meta content="" name="keywords">


  <!-- Favicons -->
  <!--<link href="<?= base_url('assets/NiceAdmin/'); ?>assets/img/favicon.png" rel="icon">-->
    <link href="<?= base_url() ?>assets/file/frontend/image/template/iconjar.png" rel="icon">
  <!--<link href="<?= base_url('assets/NiceAdmin/'); ?>assets/img/apple-touch-icon.png" rel="apple-touch-icon">-->
    <link href="<?= base_url() ?>assets/file/frontend/image/template/iconjar.png" rel="apple-touch-icon">


    <!-- Vendor CSS Files -->
    <link href="<?= base_url('assets/NiceAdmin/'); ?>assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url('assets/NiceAdmin/'); ?>assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="<?= base_url('assets/NiceAdmin/'); ?>assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="<?= base_url('assets/NiceAdmin/'); ?>assets/vendor/remixicon/remixicon.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="<?= base_url('assets/NiceAdmin/'); ?>assets/css/style.css" rel="stylesheet">
    <link href="<?= base_url('assets/Backend/css/admin-ui.css'); ?>" rel="stylesheet">

    <!-- =======================================================
  * Template Name: NiceAdmin - v2.2.2
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

    <script src="<?= base_url('assets/NiceAdmin/'); ?>assets/vendor/jquery/jquery.min.js"></script>

    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center">

        <div class="d-flex align-items-center justify-content-between">
            <a href="<?= base_url(''); ?>dashboard" class="logo d-flex align-items-center">
                <img src="<?= base_url('assets/NiceAdmin/assets/img/logo.png'); ?>" alt="">
                <span class="d-none d-lg-block">Jhonlin Agro Raya</span>
            </a>
            <i class="bi bi-list toggle-sidebar-btn"></i>
        </div><!-- End Logo -->


        <nav class="header-nav ms-auto">
            <ul class="d-flex align-items-center">



                <li class="nav-item dropdown pe-3">

                    <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                        <!-- <img src="assets/img/profile-img.jpg" alt="Profile" class="rounded-circle"> -->
                        <span class="d-none d-md-block dropdown-toggle ps-2"><?= html_escape($this->session->userdata('name')); ?></span>
                    </a><!-- End Profile Iamge Icon -->

                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                        <li class="dropdown-header">
                            <h6><?= html_escape($this->session->userdata('name')); ?></h6>
                            <!-- <span>Web Designer</span> -->
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <!-- 
                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
                                <i class="bi bi-person"></i>
                                <span>My Profile</span>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li> -->
                        <!-- 
                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
                                <i class="bi bi-gear"></i>
                                <span>Account Settings</span>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li> -->

                        <!-- <li>
                            <a class="dropdown-item d-flex align-items-center" href="pages-faq.html">
                                <i class="bi bi-question-circle"></i>
                                <span>Need Help?</span>
                            </a>
                        </li> -->
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <form method="post" action="<?= html_escape(base_url('auth/logout')); ?>">
                                <button class="dropdown-item d-flex align-items-center" type="submit">
                                    <i class="bi bi-box-arrow-right"></i>
                                    <span>Sign Out</span>
                                </button>
                            </form>
                        </li>

                    </ul><!-- End Profile Dropdown Items -->
                </li><!-- End Profile Nav -->

            </ul>
        </nav><!-- End Icons Navigation -->

    </header><!-- End Header -->
