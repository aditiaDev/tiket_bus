<!-- <section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url(<?php echo base_url('/assets/front/images/') ?>busberlian.jpg);" data-stellar-background-ratio="0.5">
  <div class="overlay"></div>
  <div class="container">
    <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-start">
      <div class="col-md-9 ftco-animate pb-5">
        <p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home <i class="ion-ios-arrow-forward"></i></a></span> <span>Blog <i class="ion-ios-arrow-forward"></i></span></p>
        <h1 class="mb-3 bread">Read our blog</h1>
      </div>
    </div>
  </div>
</section> -->
<style>
  .table tbody tr td {
    padding: 10px!important;
  }
</style>
<div class="hero-wrap" style="background-image: url('<?php echo base_url('/assets/front/images/') ?>busberlian.jpg ');" data-stellar-background-ratio="0.5">
    <div class="overlay">
    </div>
    <div class="container">
      <div class="row no-gutters  justify-content-start align-items-center" style="padding-top: 100px;">

        <div class="col-lg-12 col-md-12">
          <div class="row">
            <div class="col-md-3" style="background-color: #0C2F91;padding: 20px;">
              <div class="d-flex flex-md-column list-group" id="list-tab" role="tablist">
                <a class="list-group-item active" id="list-ticket-list" data-toggle="list" href="#list-ticket" role="tab" aria-controls="ticket" aria-selected="false">
                  <i class="fas fa-ticket-alt"></i>
                  <span style="font-size:14px;">Feedback</span>
                </a>
              </div>
            </div>
            <div class="col-md-9" style="background-color: #fff;padding: 20px;">
              <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade bordered show active" id="list-ticket" role="tabpanel" aria-labelledby="list-ticket-list">
                  <form >
                    <div class="d-md-flex mt-2">
                      <div class="form-group col-12 col-md-12">
                        <label for="" class="label">Masukkan Nomor Tiket Anda</label>
                        <input type="text" class="form-control" name="id_penjualan_tiket" placeholder="Masukkan Nomor Tiket Anda">
                      </div>
                    </div>
                    <div class="d-md-flex">
                      <div class="form-group col-12 col-md-12" style="text-align: right;">
                        <button type="button" id="btnFeedback" class="btn btn-primary py-3 px-4"><i class="fas fa-search"></i> Isi Feedback</button>
                      </div>
                    </div>
                  </form>
                </div>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

<section class="ftco-section" id="colFeedback">
  <div class="container" style="max-width:1200px;">
    <div class="row d-flex justify-content-center">
      <div class="col-md-12 text-center d-flex ftco-animate">
        <form id="FRM_DATA" action="">
          <div class="blog-entry justify-content-end" style="display:none;" id="showRow">
            <table class="table table-bordered" style="font-size:14px;" id="tbFeedback">

            </table>
            <textarea name="saran" style="font-size:12px;" class="form-control" rows="3" placeholder="Saran dan masukan untuk kami"></textarea>
            <div class="d-md-flex" style="margin-top: 10px;">
              <div class="form-group col-12 col-md-12">
                <button type="button" id="BTN_SAVE" class="btn btn-info"><i class="fas fa-save"></i> SUBMIT</button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>

<script src="<?php echo base_url('/assets/front/js/jquery.min.js'); ?>"></script>
<script>
  function ISI_TABLE(){
    $.ajax({
      url: "<?php echo site_url('/front/getParameter') ?>",
      type: "POST",
      dataType: "HTML",
      data:{
        id_penjualan_tiket: $("#id_penjualan_tiket").val()
      },
      success: function(data){
        $("#tbFeedback").html(data)
      }
    })
  }


  $(document).ready(function (){
      $("#btnFeedback").click(function (){
          $('html, body').animate({
              scrollTop: $("#colFeedback").offset().top
          }, 1500);
          ISI_TABLE()
          $("#showRow").css("display","")
      });
  });

  $("#BTN_SAVE").click(function(){
    event.preventDefault();
    var formData = $("#FRM_DATA").serialize();
    formData+="&id_penjualan_tiket="+$("[name='id_penjualan_tiket']").val()
    urlPost = "<?php echo site_url('front/saveData') ?>";
    console.log(formData)
    ACTION(urlPost, formData)
  })

  function ACTION(urlPost, formData){
      $.ajax({
          url: urlPost,
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
            alert(data.message)
            window.location="<?php echo base_url('front/');?>"
            // if (data.status == "success") {
            //   // toastr.info(data.message)
              

            // }else{
            //   // toastr.error(data.message)
            // }
          }
      })
  }
</script>