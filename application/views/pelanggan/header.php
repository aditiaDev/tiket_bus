<!DOCTYPE html>
<html lang="en">
  <head>
    <title>PO. Berlian Jaya</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url('/assets/adminlte/plugins/fontawesome-free/css/all.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('/assets/front/css/open-iconic-bootstrap.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('/assets/front/css/animate.css'); ?>">
    
    <link rel="stylesheet" href="<?php echo base_url('/assets/front/css/owl.carousel.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('/assets/front/css/owl.theme.default.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('/assets/front/css/magnific-popup.css'); ?>">

    <link rel="stylesheet" href="<?php echo base_url('/assets/front/css/aos.css'); ?>">

    <link rel="stylesheet" href="<?php echo base_url('/assets/front/css/ionicons.min.css'); ?>">

    <link rel="stylesheet" href="<?php echo base_url('/assets/front/css/bootstrap-datepicker.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('/assets/front/css/jquery.timepicker.css'); ?>">
    

    
    <link rel="stylesheet" href="<?php echo base_url('/assets/front/css/flaticon.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('/assets/front/css/icomoon.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('/assets/front/css/style.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('/assets/adminlte/plugins/toastr/toastr.min.css'); ?>">
  </head>
  <body>
    
	  <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
	    <div class="container">
	      <a class="navbar-brand" href="./">PO.<span> Berlian Jaya</span></a>
	      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
	        <span class="oi oi-menu"></span> Menu
	      </button>

	      <div class="collapse navbar-collapse" id="ftco-nav">
	        <ul class="navbar-nav ml-auto">
	          <li class="nav-item active"><a href="<?php echo base_url("front/")?>" class="nav-link">Home</a></li>
	          <li class="nav-item"><a href="<?php echo base_url("front/gallery")?>" class="nav-link">Gallery</a></li>
            <li class="nav-item"><a href="<?php echo base_url("front/feedback")?>" class="nav-link">Feedback</a></li>
	        </ul>
          <?php
            if(!$this->session->userdata('id_user')){
          ?>
            <a class="btn btn-info" style="margin-left: 10px;"  href="<?php echo base_url("front/login")?>"><i class="fas fa-user"></i> Masuk</a>
          <?php
            }else{
          ?>
            <a class="btn btn-warning" style="margin-left: 10px;"  href="<?php echo base_url("login/logout")?>"><i class="fas fa-user"></i> Logout</a>
          <?php
            }
          ?>
        </div>
	    </div>
	  </nav>
    <!-- END nav -->
    
    <!-- Contents  -->

    