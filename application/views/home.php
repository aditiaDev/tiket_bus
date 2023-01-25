<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>JobLook</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="<?php echo base_url('/assets/adminlte/plugins/fontawesome-free/css/all.min.css'); ?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url('/assets/adminlte/dist/css/adminlte.min.css'); ?>">
</head>
<body class="hold-transition layout-top-nav dark-mode">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand-md navbar-dark">
    <div class="container-fluid">
      <a href="<?php echo base_url('/assets/adminlte/index3.html'); ?>" class="navbar-brand">
        <img src="<?php echo base_url('/assets/adminlte/dist/img/AdminLTELogo.png'); ?>" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">JobLook</span>
      </a>

      <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse order-3" id="navbarCollapse">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
          <li class="nav-item">
            <a href="#" class="nav-link">Home</a>
          </li>
        </ul>

        <!-- SEARCH FORM -->
        <form class="form-inline ml-0 ml-md-3">
          <div class="input-group input-group-sm">
            <input class="form-control form-control-navbar" style="width: 250px;" type="text" placeholder="Search" aria-label="Search">
            <div class="input-group-append">
              <button class="btn btn-navbar" type="submit">
                <i class="fas fa-search"></i>
              </button>
            </div>
          </div>
        </form>
      </div>

      <!-- Right navbar links -->
      <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
        <!-- Messages Dropdown Menu -->
        <li class="nav-item dropdown">
          <a class="btn btn-primary" href="<?php echo base_url('login') ?>"><i class="fas fa-sign-in-alt"></i> Login</a>
        </li>
        
      </ul>
    </div>
  </nav>
  <!-- /.navbar -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"> <small>Dapatkan Pekerjaan Impianmu disini</small></h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-4">
            
            <div class="card card-primary card-outline">
              <div class="card-body">
                
                <span id="postsList"></span>
                
              </div>
              <div class="card-body">
                <!-- Paginate -->
                <div id='pagination'></div>
              </div>
            </div><!-- /.card -->
          </div>
          <div class="col-lg-8">
            
            <div class="card card-primary card-outline" id="dtlLowker" style="display: none;">
              <div class="card-body" style="background-color: #fff;">
                <a class="btn btn-info" id="btnLamar">Lamar Sekarang</a>
                <div class="user-block" style="margin-top: 20px;float:none;">
                  <img class="img-circle img-bordered-sm" src="<?php echo base_url('/assets/adminlte/dist/img/AdminLTELogo.png'); ?>" alt="user image">
                  <span class="username" style="color: #007bff;" id="dtlNmLoker">
                   
                  </span>
                  <span class="description" id="dtlDate"></span>
                </div>
                
                <p class="card-text" id="dtlKetLowker" style="color: #453636;">
                  
                </p>
              </div>
            </div><!-- /.card -->
          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
      Find Your job
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2021 <a href="#">JobLook</a>.</strong> All rights reserved.
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="<?php echo base_url('/assets/adminlte/plugins/jquery/jquery.min.js'); ?>"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo base_url('/assets/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url('/assets/adminlte/dist/js/adminlte.min.js'); ?>"></script>

<script type='text/javascript'>
  $(document).ready(function(){

    $('#pagination').on('click','a',function(e){
      e.preventDefault(); 
      var pageno = $(this).attr('data-ci-pagination-page');
      loadPagination(pageno);
    });

    loadPagination(0);

    function loadPagination(pagno){
      $.ajax({
        url: "<?php echo site_url('/welcome/loadRecord/') ?>"+pagno,
        type: 'get',
        dataType: 'json',
        success: function(response){
          $('#pagination').html(response.pagination);
          createTable(response.result,response.row);
        }
      });
    }

    function createTable(result,sno){
      sno = Number(sno);var row="";
      for(index in result){
        var content = result[index].ket_lowongan.replace(/<\/?[^>]+(>|$)/g, "");
        if(content.length > 200)
        content = content.substr(0, 200) + " ...";
        sno+=1;

        row += "<div class='post'>"+
                  "<div class='user-block'>"+
                    "<img class='img-circle img-bordered-sm' src='<?php echo base_url('/assets/adminlte/dist/img/AdminLTELogo.png'); ?>' >"+
                    "<span class='username'>"+
                      "<a href='#' onclick='readMore(\""+result[index].id_lowongan_kerja+"\")'>"+result[index].nm_lowongan_kerja+".</a>"+
                    "</span>"+
                    "<span class='description'>Shared publicly - 7:30 PM today</span>"+
                  "</div>"+
                  "<p>"+content+
                  "</p>"+
                  "<button class='btn btn-sm btn-info' onclick='readMore(\""+result[index].id_lowongan_kerja+"\")'>Read more</button>"+
                "</div>";

      }
      $('#postsList').html(row)
    }
      
  });

  function readMore(id){
    event.preventDefault();
    if($("#dtlLowker").css('display') == "none") $("#dtlLowker").show(1000)
    $('html, body').animate({
        scrollTop: $("#dtlLowker").offset().top
    }, 2000)
    $.ajax({
      url: "<?php echo site_url('welcome/getById') ?>",
      type: "POST",
      data: {
        id_lowongan_kerja: id
      },
      dataType: "JSON",
      success: function(data){
        console.log(data)
        $("#btnLamar").attr('href',"<?php echo base_url("login/register/") ?>"+id)
        $("#dtlNmLoker").html(data.nm_lowongan_kerja)
        $("#dtlKetLowker").html(data.ket_lowongan)
        $("#dtlDate").html("Dibuka sampai "+data.tgl_akhir)
      }
    })
  }

  </script>
</body>
</html>
