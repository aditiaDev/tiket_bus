<!doctype html>
<html class="no-js" lang="en">

    <head>
        <!-- meta data -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

        <!--font-family-->
		<link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i" rel="stylesheet">
        
        <!-- title of site -->
        <title>Mebel Buk Dhe Jepara</title>

        <!-- For favicon png -->
		<link rel="shortcut icon" type="image/icon" href="<?php echo base_url('/assets/furn/assets/logo/favicon.png'); ?>"/>
       
        <!--font-awesome.min.css-->
        <!-- <link rel="stylesheet" href="<?php echo base_url('/assets/furn/assets/css/font-awesome.min.css'); ?>"> -->
        <link rel="stylesheet" href="<?php echo base_url('/assets/adminlte/plugins/fontawesome-free/css/all.min.css'); ?>">
        <!--linear icon css-->
		<link rel="stylesheet" href="<?php echo base_url('/assets/furn/assets/css/linearicons.css'); ?>">

		<!--animate.css-->
        <link rel="stylesheet" href="<?php echo base_url('/assets/furn/assets/css/animate.css'); ?>">

        <!--owl.carousel.css-->
        <link rel="stylesheet" href="<?php echo base_url('/assets/furn/assets/css/owl.carousel.min.css'); ?>">
		<link rel="stylesheet" href="<?php echo base_url('/assets/furn/assets/css/owl.theme.default.min.css'); ?>">
		
        <!--bootstrap.min.css-->
        <link rel="stylesheet" href="<?php echo base_url('/assets/furn/assets/css/bootstrap.min.css'); ?>">
		
		<!-- bootsnav -->
		<link rel="stylesheet" href="<?php echo base_url('/assets/furn/assets/css/bootsnav.css'); ?>" >	
        
        <!--style.css-->
        <link rel="stylesheet" href="<?php echo base_url('/assets/furn/assets/css/style.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url('/assets/adminlte/plugins/datepicker/datepicker3.css'); ?>">
        <!--responsive.css-->
        <link rel="stylesheet" href="<?php echo base_url('/assets/furn/assets/css/responsive.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url('/assets/adminlte/plugins/toastr/toastr.min.css'); ?>">
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		
        <!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
			<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <link rel="stylesheet" href="<?php echo base_url('/assets/css/loader.css'); ?>">
        <style>
            .tb_no_top>thead>tr>th{
                border: none;
                vertical-align: middle;
            }
            .tb_no_top>tbody>tr>td{
                border-top: none;
                vertical-align: middle;
            }

            .table>thead>tr>th{
                font-size: 14px;
                color: #6f6f6f;
                font-weight: bold;
                font-family: monospace;
            }

            .table>tbody>tr>td{
                font-size: 14px;
                color: #333;
                font-weight: bold;
                font-family: monospace;
            }
        </style>
    </head>
	
	<body style="background: unset;">
    <div class="before-loader" id="LOADER" style="display: none;">
        <div class="loader5" ></div>
    </div>
    <header id="home" class="welcome-hero">
        <?php if(in_array(strtoupper($this->uri->segment(1)), array("", "HOME"))){ ?>
        <div id="header-carousel" class="carousel slide carousel-fade" data-ride="carousel">
            <!--/.carousel-indicator -->
                <ol class="carousel-indicators">
                <li data-target="#header-carousel" data-slide-to="0" class="active"><span class="small-circle"></span></li>
                <li data-target="#header-carousel" data-slide-to="1"><span class="small-circle"></span></li>
                <li data-target="#header-carousel" data-slide-to="2"><span class="small-circle"></span></li>
            </ol><!-- /ol-->
            <!--/.carousel-indicator -->

            <!--/.carousel-inner -->
            <div class="carousel-inner" role="listbox">
                <!-- .item -->
                <div class="item active">
                    <div class="single-slide-item slide1">
                        <div class="container">
                            <div class="welcome-hero-content">
                                <div class="row">
                                    
                                    <div class="col-sm-12">
                                        <div class="single-welcome-hero" style="height:650px;">
                                            <div class="welcome-hero-img">
                                                <img src="<?php echo base_url('/assets/images/img_header.jpg');?>" alt="slider image">
                                            </div><!--/.welcome-hero-txt-->
                                        </div><!--/.single-welcome-hero-->
                                    </div><!--/.col-->
                                </div><!--/.row-->
                            </div><!--/.welcome-hero-content-->
                        </div><!-- /.container-->
                    </div><!-- /.single-slide-item-->

                </div><!-- /.item .active-->

                <div class="item">
                <div class="single-slide-item slide3">
                        <div class="container">
                            <div class="welcome-hero-content">
                                <div class="row">
                                    <div class="col-sm-7">
                                        <div class="single-welcome-hero">
                                            <div class="welcome-hero-txt">
                                                <h4>great design collection</h4>
                                                <h2>valvet accent arm chair</h2>
                                                <p>
                                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiuiana smod tempor  ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip. 
                                                </p>
                                                <div class="packages-price">
                                                    <p>
                                                        $ 299.00
                                                        <del>$ 399.00</del>
                                                    </p>
                                                </div>
                                                <button class="btn-cart welcome-add-cart" onclick="window.location.href='#'">
                                                    <span class="lnr lnr-plus-circle"></span>
                                                    add <span>to</span> cart
                                                </button>
                                                <button class="btn-cart welcome-add-cart welcome-more-info" onclick="window.location.href='#'">
                                                    more info
                                                </button>
                                            </div><!--/.welcome-hero-txt-->
                                        </div><!--/.single-welcome-hero-->
                                    </div><!--/.col-->
                                    <div class="col-sm-5">
                                        <div class="single-welcome-hero">
                                            <div class="welcome-hero-img">
                                                <img src="<?php echo base_url('/assets/images/img2.png');?>" alt="slider image">
                                            </div><!--/.welcome-hero-txt-->
                                        </div><!--/.single-welcome-hero-->
                                    </div><!--/.col-->
                                </div><!--/.row-->
                            </div><!--/.welcome-hero-content-->
                        </div><!-- /.container-->
                    </div><!-- /.single-slide-item-->

                </div><!-- /.item .active-->

                <div class="item">
                    <div class="single-slide-item slide3">
                        <div class="container">
                            <div class="welcome-hero-content">
                                <div class="row">
                                    <div class="col-sm-7">
                                        <div class="single-welcome-hero">
                                            <div class="welcome-hero-txt">
                                                <h4>great design collection</h4>
                                                <h2>valvet accent arm chair</h2>
                                                <p>
                                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiuiana smod tempor  ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip. 
                                                </p>
                                                <div class="packages-price">
                                                    <p>
                                                        $ 299.00
                                                        <del>$ 399.00</del>
                                                    </p>
                                                </div>
                                                <button class="btn-cart welcome-add-cart" onclick="window.location.href='#'">
                                                    <span class="lnr lnr-plus-circle"></span>
                                                    add <span>to</span> cart
                                                </button>
                                                <button class="btn-cart welcome-add-cart welcome-more-info" onclick="window.location.href='#'">
                                                    more info
                                                </button>
                                            </div><!--/.welcome-hero-txt-->
                                        </div><!--/.single-welcome-hero-->
                                    </div><!--/.col-->
                                    <div class="col-sm-5">
                                        <div class="single-welcome-hero">
                                            <div class="welcome-hero-img">
                                                <img src="<?php echo base_url('/assets/images/img3.png');?>" alt="slider image">
                                            </div><!--/.welcome-hero-txt-->
                                        </div><!--/.single-welcome-hero-->
                                    </div><!--/.col-->
                                </div><!--/.row-->
                            </div><!--/.welcome-hero-content-->
                        </div><!-- /.container-->
                    </div><!-- /.single-slide-item-->
                    
                </div><!-- /.item .active-->
            </div><!-- /.carousel-inner-->

        </div>
        <?php } ?>
        <!-- top-area Start -->
        <div class="top-area">
            <div class="header-area">
                <!-- Start Navigation -->
                <nav class="navbar navbar-default bootsnav  navbar-sticky navbar-scrollspy"  data-minus-value-desktop="70" data-minus-value-mobile="55" data-speed="1000">

                    <!-- Start Top Search -->
                    <div class="top-search">
                        <div class="container">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-search"></i></span>
                                <input type="text" class="form-control" placeholder="Search">
                                <span class="input-group-addon close-search"><i class="fa fa-times"></i></span>
                            </div>
                        </div>
                    </div>
                    <!-- End Top Search -->

                    <div class="container">            
                        <!-- Start Atribute Navigation -->
                        <div class="attr-nav">
                            <ul>
                                <li class="search">
                                    <a href="#"><span class="lnr lnr-magnifier"></span></a>
                                </li><!--/.search-->
                                <li class="nav-setting">
                                    <a href="#"><span class="lnr lnr-cog"></span></a>
                                </li><!--/.search-->
                                
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" >
                                        <span class="lnr lnr-cart"></span>
                                        <span class="badge badge-bg-1" id="jmlKeranjang">0</span>
                                    </a>
                                    <ul class="dropdown-menu cart-list s-cate" id="listKeranjang">
                                        
                                    </ul>
                                </li><!--/.dropdown-->
                                <li class="nav-setting">
                                    <a href="<?php echo base_url('login/logout') ?>" title="Sign Out"><span class="fas fa-sign-out-alt"></span></a>
                                </li>
                            </ul>
                        </div><!--/.attr-nav-->
                        <!-- End Atribute Navigation -->

                        <!-- Start Header Navigation -->
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-menu">
                                <i class="fa fa-bars"></i>
                            </button>
                            <a class="navbar-brand" href="index.html">Mebel Buk Dhe</a>

                        </div><!--/.navbar-header-->
                        <!-- End Header Navigation -->

                        <!-- Collect the nav links, forms, and other content for toggling -->
                        <div class="collapse navbar-collapse menu-ui-design" id="navbar-menu">
                            <ul class="nav navbar-nav navbar-center" data-in="fadeInDown" data-out="fadeOutUp">
                                <li class="active"><a href="<?php echo base_url('home') ?>">home</a></li>
                                <li class="scroll"><a href="#new-arrivals">new arrival</a></li>
                                <li class="scroll"><a href="#feature">features</a></li>
                                <li><a href="<?php echo base_url('chart/daftarTransaksi') ?>">Daftar Transaksi</a></li>
                                <li class="scroll"><a href="#newsletter">contact</a></li>
                            </ul><!--/.nav -->
                        </div><!-- /.navbar-collapse -->
                    </div><!--/.container-->
                </nav><!--/nav-->
                <!-- End Navigation -->
            </div><!--/.header-area-->
            <div class="clearfix"></div>

        </div><!-- /.top-area-->
        <!-- top-area End -->

    </header>