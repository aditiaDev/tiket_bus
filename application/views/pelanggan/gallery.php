<!-- <div class="hero-wrap" style="background-image: url('<?php echo base_url('/assets/front/images/') ?>busberlian.jpg ');" data-stellar-background-ratio="0.5">
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
  </div> -->

<section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('<?php echo base_url('/assets/front/images/') ?>busberlian.jpg');" data-stellar-background-ratio="0.5">
  <div class="overlay"></div>
  <div class="container">
    <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-start">
      <div class="col-md-9 ftco-animate pb-5">
        <p class="breadcrumbs"><span class="mr-2"><a href="<?php echo base_url() ?>">Home <i class="ion-ios-arrow-forward"></i></a></span> <span>About us <i class="ion-ios-arrow-forward"></i></span></p>
        <h1 class="mb-3 bread">Pilih Bus keinginan Anda</h1>
      </div>
    </div>
  </div>
</section>
  
<section class="ftco-section">
  <div class="container">
    <div class="row">

      <?php
        $data = $this->db->query("SELECT b.id_bus, a.id_jenis_bus, a.nm_jenis_bus, b.no_pol, 
        b.jumlah_kursi, b.foto, b.deskripsi FROM tb_jenis_bus a
        inner JOIN tb_bus b ON a.id_jenis_bus = b.id_jenis_bus")->result();
        foreach($data as $row){
      ?>
        <div class="col-md-3">
          <div class="car-wrap ftco-animate">
            <div class="img d-flex align-items-end" style="background-image: url('<?php echo base_url('/assets/images/'.$row->foto) ?>');">
              
            </div>
            <div class="text p-4 text-center">
              <!-- <h2 class="mb-0"><a href="car-single.html">K 7245 GB</a></h2> -->
              <span><a href="<?php echo base_url("front/detail/".$row->id_bus)?>"><?php echo $row->nm_jenis_bus ?></a></span>
            </div>
          </div>
        </div>
      <?php
        }
      ?>
      
    </div>
    
  </div>
</section>