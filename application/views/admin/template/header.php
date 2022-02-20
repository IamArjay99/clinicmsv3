<?php if (!$this->session->has_userdata('sessionID')) redirect('login','refresh'); ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?> | Clinic Management System</title>
    <!-- base:css -->
    <link rel="stylesheet" href="<?= base_url('assets/vendors/mdi/css/materialdesignicons.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/vendors/css/vendor.bundle.base.css') ?>">
    <!-- endinject -->

    <!-- plugin css for this page -->
    <link rel="stylesheet" href="<?= base_url('assets/vendors/jqvmap/jqvmap.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/vendors/flag-icon-css/css/flag-icon.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/vendors/font-awesome/css/font-awesome.min.css') ?>"/>
    <link rel="stylesheet" href="<?= base_url('assets/vendors/jquery-toast-plugin/jquery.toast.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/daterangepicker.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/vendors/fullcalendar/fullcalendar.min.css') ?>">
    <!-- End plugin css for this page -->

    <!-- inject:css -->
    <link rel="stylesheet" href="<?= base_url('assets/css/vertical-layout-light/style.css') ?>">
    <!-- endinject -->
    <!-- <link rel="shortcut icon" href="<?= base_url('assets/images/favicon.png') ?>" /> -->
    <link rel="shortcut icon" href="<?= base_url('assets/images/modules/clinic-logo.png') ?>" />

    <!-- Font Awesome -->
    <link href="<?= base_url('assets/css/fontawesome.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/css/brands.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/css/solid.css') ?>" rel="stylesheet">

    <!-- jQuery -->
    <link rel="stylesheet" href="<?= base_url('assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css') ?>">
    <script src="<?= base_url('assets/js/jquery-3.2.1.min.js') ?>"></script>
    <!-- End jQuery -->

    <!-- Sweet Alert -->
    <link rel="stylesheet" href="<?=base_url('assets/css/sweetalert2.css')?>">
    <link rel="stylesheet" href="<?=base_url('assets/css/sweetalert2.min.css')?>">

    <script src="<?=base_url('assets/js/sweetalert2.all.min.js')?>"></script>
    <script src="<?=base_url('assets/js/sweetalert2.min.js')?>"></script>
    <!-- End Sweet Alert -->

    <link rel="stylesheet" href="<?= base_url('assets/css/custom-general.css') ?>">
</head>
<body base_url="<?= base_url() ?>">

    <div class="container-scroller">

        <div style="display: none;" id="loader">
            <div class="h-100 d-flex flex-column justify-content-center align-items-center">
                <div class="circle-loader"></div>
                <p class="mt-2 text-white">Please wait...</p>
            </div>
        </div>

        <!-- ----- TOP MENU ----- -->
        <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
            <div class="text-center navbar-brand-wrapper d-flex align-items-center">
                <a class="navbar-brand brand-logo" href="<?= base_url('admin/dashboard') ?>">
                    <img src="<?= base_url('assets/images/modules/login-logo.jpg') ?>" style="height: 50px; width: auto; max-width: 100%;" alt="logo">
                </a>
                <a class="navbar-brand brand-logo-mini" href="<?= base_url('admin/dashboard') ?>">
                    <img src="<?= base_url('assets/images/modules/clinic-logo.png') ?>" class="rounded-circle" style="height: 50px; width: auto; max-width: 100%;" alt="logo">
                </a>
                <!-- <a class="navbar-brand brand-logo" href="../../index.html"><img src="http://www.urbanui.com/yoraui/template/images/logo.svg" alt="logo"/></a>
                <a class="navbar-brand brand-logo-mini" href="../../index.html"><img src="http://www.urbanui.com/yoraui/template/images/logo-mini.svg" alt="logo"/></a> -->
            </div>
            <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
                <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
                    <span class="mdi mdi-menu"></span>
                </button>
                <ul class="navbar-nav navbar-nav-right">
                    <!-- <li class="nav-item dropdown">
                        <a class="nav-link count-indicator dropdown-toggle d-flex align-items-center justify-content-center" id="notificationDropdown" href="#" data-toggle="dropdown">
                            <i class="mdi mdi-bell-outline mx-0"></i>
                            <span class="count"></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
                        <p class="mb-0 font-weight-normal float-left dropdown-header">Notifications</p>
                        <a class="dropdown-item preview-item">
                            <div class="preview-thumbnail">
                                <div class="preview-icon bg-success">
                                    <i class="mdi mdi-information mx-0"></i>
                                </div>
                            </div>
                            <div class="preview-item-content">
                                <h6 class="preview-subject font-weight-normal">Application Error</h6>
                                <p class="font-weight-light small-text mb-0 text-muted">
                                    Just now
                                </p>
                            </div>
                        </a>
                        <a class="dropdown-item preview-item">
                            <div class="preview-thumbnail">
                                <div class="preview-icon bg-warning">
                                    <i class="mdi mdi-settings mx-0"></i>
                                </div>
                            </div>
                            <div class="preview-item-content">
                                <h6 class="preview-subject font-weight-normal">Settings</h6>
                                <p class="font-weight-light small-text mb-0 text-muted">
                                    Private message
                                </p>
                            </div>
                        </a>
                        <a class="dropdown-item preview-item">
                            <div class="preview-thumbnail">
                                <div class="preview-icon bg-info">
                                    <i class="mdi mdi-account-box mx-0"></i>
                                </div>
                            </div>
                            <div class="preview-item-content">
                                <h6 class="preview-subject font-weight-normal">New user registration</h6>
                                <p class="font-weight-light small-text mb-0 text-muted">
                                    2 days ago
                                </p>
                            </div>
                        </a>
                        </div>
                    </li> -->
                    <li class="nav-item nav-profile dropdown">
                        <a class="nav-link" href="#" data-toggle="dropdown" id="profileDropdown">
                        <img src="<?= base_url('assets/uploads/profile/default.jpg') ?>" alt="profile"/>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
                        <a class="dropdown-item"
                            href="<?= base_url('login/logout') ?>">
                            <i class="mdi mdi-logout"></i>
                            Logout
                        </a>
                        </div>
                    </li>
                </ul>
                <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
                <span class="mdi mdi-menu"></span>
                </button>
            </div>
        </nav>
        <!-- ----- END TOP MENU ----- -->


        <!-- ----- CONTENT ----- -->
        <div class="container-fluid page-body-wrapper">

            <!-- ----- SIDE MENU ----- -->
            <nav class="sidebar sidebar-offcanvas" id="sidebar">
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('admin/dashboard') ?>">
                        <i class="fas fa-tachometer-alt"></i>
                        <span class="menu-title ml-3">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('admin/patient') ?>">
                        <i class="fas fa-users"></i>
                        <span class="menu-title ml-3"> Patient</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="collapse" href="#dental-menu" aria-expanded="false" aria-controls="dental-menu">
                            <i class="fas fa-book-open"></i>
                            <span class="menu-title ml-3"> Forms</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="collapse" id="dental-menu">
                        <ul class="nav flex-column sub-menu">
                            <li class="nav-item"> <a class="nav-link" href="<?= base_url('admin/checkup_form') ?>">Check-up Form</a></li>
                            <li class="nav-item"> <a class="nav-link" href="<?= base_url('admin/referral_form') ?>">Referral Form</a></li>
                            <!-- <li class="nav-item"> <a class="nav-link" href="<?= base_url('admin/dental_certificate') ?>">Dental Certificate</a></li> -->
                        </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="collapse" href="#equipment-menu" aria-expanded="false" aria-controls="equipment-menu">
                            <i class="fas fa-toolbox"></i>
                            <span class="menu-title ml-3"> Inventory</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="collapse" id="equipment-menu">
                        <ul class="nav flex-column sub-menu">
                            <!-- <li class="nav-item"> <a class="nav-link" href="<?= base_url('admin/first_aid_kit') ?>">First-aid Kit</a></li>
                            <li class="nav-item"> <a class="nav-link" href="<?= base_url('admin/care_equipment') ?>">Care Equipment</a></li> -->
                            <li class="nav-item"> <a class="nav-link" href="<?= base_url('admin/inventory_supply') ?>">Supply</a></li>
                            <li class="nav-item"> <a class="nav-link" href="<?= base_url('admin/purchase_request') ?>">Purchase Request</a></li>
                            <li class="nav-item"> <a class="nav-link" href="<?= base_url('admin/stock_in') ?>">Stock In</a></li>
                            <li class="nav-item"> <a class="nav-link" href="<?= base_url('admin/stock_out') ?>">Stock Out</a></li>
                        </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('admin/record') ?>">
                        <i class="fas fa-book-medical"></i>
                        <span class="menu-title ml-3"> Records</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('admin/appointment') ?>">
                        <i class="fas fa-calendar-check"></i>
                        <span class="menu-title ml-3"> Appointment</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('admin/calendar') ?>">
                        <i class="fas fa-calendar"></i>
                        <span class="menu-title ml-3"> Calendar</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('admin/announcement') ?>">
                        <i class="fas fa-bullhorn"></i>
                        <span class="menu-title ml-3"> Announcement</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('admin/survey') ?>">
                        <i class="fas fa-poll"></i>
                        <span class="menu-title ml-3"> Survey</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="collapse" href="#report-menu" aria-expanded="false" aria-controls="report-menu">
                            <i class="fas fa-folder-open"></i>
                            <span class="menu-title ml-3"> Report</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="collapse" id="report-menu">
                        <ul class="nav flex-column sub-menu">
                            <li class="nav-item"> <a class="nav-link" href="<?= base_url('admin/quarterly_report') ?>">Quarterly Report</a></li>
                            <li class="nav-item"> <a class="nav-link" href="<?= base_url('admin/survey_report') ?>">Survey Report</a></li>
                        </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="collapse" href="#masterlist-menu" aria-expanded="false" aria-controls="masterlist-menu">
                            <i class="fas fa-file"></i>
                            <span class="menu-title ml-3"> Master List</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="collapse" id="masterlist-menu">
                        <ul class="nav flex-column sub-menu">
                            <li class="nav-item"> <a class="nav-link" href="<?= base_url('admin/courses') ?>">Courses</a></li>
                            <li class="nav-item"> <a class="nav-link" href="<?= base_url('admin/year') ?>">Year</a></li>
                            <!-- <li class="nav-item"> <a class="nav-link" href="<?= base_url('admin/section') ?>">Section</a></li> -->
                            <li class="nav-item"> <a class="nav-link" href="<?= base_url('admin/unit') ?>">Unit</a></li>
                            <li class="nav-item"> <a class="nav-link" href="<?= base_url('admin/measurement') ?>">Measurement</a></li>
                            <li class="nav-item"> <a class="nav-link" href="<?= base_url('admin/category') ?>">Category</a></li>
                            <li class="nav-item"> <a class="nav-link" href="<?= base_url('admin/medicine') ?>">Medicine</a></li>
                            <li class="nav-item"> <a class="nav-link" href="<?= base_url('admin/care_equipment') ?>">Care Equipment</a></li>
                            <li class="nav-item"> <a class="nav-link" href="<?= base_url('admin/office_supply') ?>">Office Supply</a></li>
                        </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="collapse" href="#settings-menu" aria-expanded="false" aria-controls="settings-menu">
                            <i class="fas fa-cogs"></i>
                            <span class="menu-title ml-3"> Settings</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="collapse" id="settings-menu">
                        <ul class="nav flex-column sub-menu">
                            <li class="nav-item"> <a class="nav-link" href="<?= base_url('admin/system_setup') ?>">System Setup</a></li>
                        </ul>
                        </div>
                    </li>
                    <!-- <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('admin/settings') ?>">
                        <i class="fas fa-cogs"></i>
                        <span class="menu-title ml-3"> Settings</span>
                        </a>
                    </li> -->
                </ul>
            </nav>
            <!-- ----- END SIDE MENU ----- -->

            <!-- ----- MAIN CONTENT ----- -->
            <div class="main-panel">
                
                <div class="mt-3" id="notificationContent"></div>

                
        