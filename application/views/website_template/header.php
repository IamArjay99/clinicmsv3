<?php 
    $sessionID = !$this->session->has_userdata('patientID') ? false : $this->session->userdata('patientID'); 
?>

<!doctype html>
<html class="no-js" lang="zxx">
<head>
<meta charset="utf-8">
<meta http-equiv="x-ua-compatible" content="ie=edge">
<title><?= $title ?></title>
<meta name="description" content="">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="shortcut icon" type="image/x-icon" href="<?=base_url()?>assets/images/favicon.png">

<link rel="stylesheet" href="<?=base_url()?>assets/website/assets/css/A.bootstrap.min.css owl.carousel.min.css slicknav.css animate.min.css magnific-popup.css fontawesome-all.min.css themify-icons.css slick.css nice-select.css,Mcc.IXltbKurtg.css.pagesp.css">
<link rel="stylesheet" href="<?=base_url()?>assets/website/assets/css/A.style.css.pagespeed.cf.gHAK23T-v8.css">
<!-- Sweet Alert -->
<link rel="stylesheet" href="<?=base_url('assets/css/sweetalert2.css')?>">
<link rel="stylesheet" href="<?=base_url('assets/css/sweetalert2.min.css')?>">

<script src="<?=base_url('assets/js/sweetalert2.all.min.js')?>"></script>
<script src="<?=base_url('assets/js/sweetalert2.min.js')?>"></script>

<!-- End Sweet Alert -->

<script src="<?=base_url()?>assets/website/assets/js/vendor/modernizr-3.5.0.min.js"></script>
<script src="<?=base_url()?>assets/website/assets/js/vendor/jquery-1.12.4.min.js"></script>
<script src="<?=base_url()?>assets/website/assets/js/popper.min.js bootstrap.min.js.pagespeed.jc.M2u69PhM2B.js"></script><script>eval(mod_pagespeed_yHSzYa$i1N);</script>
<script src="<?= base_url('assets/vendors/inputmask/jquery.inputmask.bundle.js') ?>"></script>
    <script src="<?= base_url('assets/js/inputmask.js') ?>"></script>

</head>
<body base_url="<?=base_url()?>" sessionid="<?=$sessionID?>" website="true">
<header>
<div class="header-area header-transparent">
<div class="main-header header-sticky">
<div class="container">
<div class="header-wrap d-flex align-items-center justify-content-between flex-wrap">
<div class="header-info-left d-flex align-items-center">

<div class="logo">
<a href="<?= base_url() ?>"><img src="<?=base_url()?>assets/website/assets/img/logo/xlogo.png.pagespeed.ic.RElERxDpcp.png" alt=""></a>
</div>
</div>
<div class="header-righ">

<div class="main-menu d-none d-lg-block">
<nav>
<ul id="navigation">
<li><a href="<?=base_url("welcome")?>">Home</a></li>
<li><a href="<?=base_url("about")?>">About</a></li>
<li><a href="<?=base_url("anouncement")?>">Announcement</a></li>
<!-- <li><a href="c<?=base_url("inquiry")?>">Inquiry</a></li> -->
<li><a href="<?=base_url("contact")?>">Contact</a></li>
<!-- <ul class="submenu">
<li><a href="blog.html">Anouncement</a></li>
<li><a href="blog_details.html">Blog Details</a></li>
<li><a href="elements.html">Elements</a></li>
</ul> -->
</li>

<?php if($sessionID ):?>
    <li><a href="<?= base_url("forms")?>">Forms</a></li>
    <li><a href="<?= base_url("login/logoutWebsite")?>">Logout</a></li>
    <li class="header-right-btn"><a href="#" class="header-btn make-appointment">Make Appointment</a> </li>
<?php else:?>
    <li><a href="#" class="login">Login</a></li>
    <li><a href="#" class="register">Register</a></li>
<?php endif;?>
</ul>
</nav>
</div>
</div>

<div class="col-12">
<div class="mobile_menu d-block d-lg-none"></div>
</div>
</div>
</div>
</div>
</div>
</header>