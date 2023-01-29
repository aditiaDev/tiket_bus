<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>PO. Berlian Jaya</title>
  <link rel="stylesheet" href="<?php echo base_url('/assets/login/style.css'); ?>">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="<?php echo base_url('/assets/adminlte/plugins/toastr/toastr.min.css'); ?>">
  <style>
    .hero-wrap {
        width: 100%;
        height: 850px;
        position: inherit;
        background-size: cover;
        background-repeat: no-repeat;
        background-position: top center;
    }
  </style>
</head>
<body class="hero-wrap" style="background-image: url('<?php echo base_url('/assets/front/images/') ?>bus.jpg ');">


    <div class="main">
      <div class="container a-container" id="a-container">
        <form class="form" id="FRM_DATA" method="" action="">
          <h2 class="form_title title">Sign in to Website</h2>
          
          <input class="form__input" type="text" name="username" placeholder="Username">
          <input class="form__input" type="password" name="password" placeholder="Password">
          <button class="form__button button" type="submit">SIGN IN</button>
        </form>
      </div>
      <div class="container b-container" id="b-container">
        

        <form class="form" id="a-form" method="" action="">
          <h2 class="form_title title">Create Account</h2>
          
          <input class="form__input" type="text" name="nm_pelanggan" placeholder="Nama">
          <input class="form__input" type="text" name="no_pelanggan" placeholder="No. Telpone">
          <textarea name="alamat_pelanggan" class="form__input" style="height:unset;padding-top: 10px;" rows="3" placeholder="Alamat"></textarea>
          <input class="form__input" type="text" name="usernm" placeholder="Email">
          <input class="form__input" type="password" name="pass" placeholder="Password">
          <button class="form__button button" type="submit">SIGN UP</button>
        </form>
      </div>
      <div class="switch" id="switch-cnt">
        <div class="switch__circle"></div>
        <div class="switch__circle switch__circle--t"></div>
        <div class="switch__container" id="switch-c1">
          <h2 class="switch__title title">Welcome Back !</h2>
          <p class="switch__description description">To keep connected with us please login with your personal info</p>
          <button class="switch__button button switch-btn">Daftar</button>
        </div>
        <div class="switch__container is-hidden" id="switch-c2">
          <h2 class="switch__title title">Hello Friend !</h2>
          <p class="switch__description description">Enter your personal details and start journey with us</p>
          <button class="switch__button button switch-btn">Login</button>
        </div>
      </div>
    </div>


<!-- partial -->
  <script  src="<?php echo base_url('/assets/login/script.js'); ?>"></script>
  <!-- jQuery -->
  <script src="<?php echo base_url('/assets/adminlte/plugins/jquery/jquery.min.js'); ?>"></script>
  <script src="<?php echo base_url('/assets/adminlte/plugins/toastr/toastr.min.js'); ?>"></script>
  <script>
    $(function(){
      $("#FRM_DATA").submit(function(event){

        event.preventDefault();
        var formData = $(this).serialize();
        $.ajax({
            url: "<?php echo site_url('login/login') ?>",
            type: "POST",
            data: formData,
            dataType: "JSON",
            // beforeSend: function () {
            //   $("#LOADER").show();
            // },
            // complete: function () {
            //   $("#LOADER").hide();
            // },
            success: function(data){
              // console.log(data)
              if (data.status == "success") {
                window.location="<?php echo base_url('home');?>"
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
