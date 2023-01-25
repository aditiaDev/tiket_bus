<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Penjualan Tiket Bus</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url('/assets/adminlte/plugins/fontawesome-free/css/all.min.css'); ?>">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?php echo base_url('/assets/adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css'); ?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url('/assets/adminlte/dist/css/adminlte.min.css'); ?>">
  <link rel="stylesheet" href="<?php echo base_url('/assets/adminlte/plugins/toastr/toastr.min.css'); ?>">
</head>
<body class="hold-transition login-page">
<div class="login-box" style="width: 540px;">
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <h3>Penjualan Tiket Bus</h3>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Register a new user</p>

      <form method="post" id="FRM_DATA">
        <div class="row">
          <div class="col-sm-6">
            <div class="form-group">
              <label>Nama</label>
              <input type="text" class="form-control" name="nm_pelanggan">
            </div>
          </div>
          <div class="col-sm-6">
            <div class="form-group">
              <label>No Telp.</label>
              <input type="text" class="form-control" name="no_tlp">
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-12">
            <div class="form-group">
              <label>Username Telegram</label>
              <input type="text" class="form-control" name="username_telegram" >
            </div>
          </div>
        </div>
        <div class="form-group">
          <label>Alamat</label>
          <textarea name="alamat" class="form-control"></textarea>
        </div>
        <div class="row">
          <div class="col-sm-6">
            <div class="form-group">
              <label>Username</label>
              <input type="text" class="form-control" name="username" >
            </div>
          </div>
          <div class="col-sm-6">
            <div class="form-group">
              <label>Password</label>
              <input type="password" class="form-control" name="password">
            </div>
          </div>
        </div>
        
        <div class="row">
          <div class="col-4">
            <a href="<?php echo base_url("login")?>" class="btn btn-warning btn-block"><i class="fas fa-arrow-left"></i> Login Page</a>
          </div>
          <div class="col-4"></div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-info btn-block">Register</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="<?php echo base_url('/assets/adminlte/plugins/jquery/jquery.min.js'); ?>"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo base_url('/assets/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url('/assets/adminlte/dist/js/adminlte.min.js'); ?>"></script>
<script src="<?php echo base_url('/assets/adminlte/plugins/toastr/toastr.min.js'); ?>"></script>
<script>
  $(function(){
    $("#FRM_DATA").submit(function(event){

      event.preventDefault();
      var formData = $(this).serialize();
      $.ajax({
          url: "<?php echo site_url('login/signUp') ?>",
          type: "POST",
          data: formData,
          dataType: "JSON",
          /*beforeSend: function () {
            $("#LOADER").show();
          },
          complete: function () {
            $("#LOADER").hide();
          },*/
          success: function(data){
            console.log(data)
            if (data.status == "success") {
              alert('Pendaftaran Berhasil')
              window.location="<?php echo base_url('login');?>"
            }else{
              toastr.error(data.message)
            }
          }
      })
    })
  })
</script>
</body>
</html>
