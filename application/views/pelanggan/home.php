  <div class="hero-wrap" style="background-image: url('<?php echo base_url('/assets/front/images/') ?>bus.jpg ');" data-stellar-background-ratio="0.5">
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
                  <span style="font-size:14px;">Cek Jadwal Antar kota</span>
                </a>
                <a class="list-group-item" id="list-ticket-wisata" data-toggle="list" href="#list-ticket-wisata" role="tab" aria-controls="ticket" aria-selected="false">
                  <i class="fas fa-ticket-alt"></i>
                  <span style="font-size:14px;">Cek Jadwal Tiket Wisata</span>
                </a>
                <a class="list-group-item" id="list-cektiket-list" data-toggle="list" href="#list-cektiket" role="tab" aria-controls="cektiket" aria-selected="true">
                  <i class="fas fa-receipt"></i>
                  <span style="font-size:14px;">Cek Tiket</span>
                </a>
              </div>
            </div>
            <div class="col-md-9" style="background-color: #fff;padding: 20px;">
              <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade bordered show active" id="list-ticket" role="tabpanel" aria-labelledby="list-ticket-list">
                  <form >
                    <div class="d-md-flex mt-2">
                      <div class="form-group col-12 col-md-4">
                        <label for="" class="label">Tanggal keberangkatan</label>
                        <input type="text" class="form-control" id="book_pick_date" placeholder="Tanggal keberangkatan">
                      </div>
                      <div class="form-group col-12 col-md-4">
                        <label for="" class="label">Tujuan</label>
                        <input type="text" class="form-control"  placeholder="kota Tujuan">
                      </div>
                      <div class="form-group col-12 col-md-4">
                        <label for="" class="label">Armada</label>
                        <select class="form-control"></select>
                      </div>
                    </div>

                    <div class="d-md-flex">
                      <div class="form-group col-12 col-md-6">
                        <label for="" class="label">Pilih Bus</label>
                        <select class="form-control"></select>
                      </div>
                      <div class="form-group col-12 col-md-6">
                        <label for="" class="label">Jumlah Penumpang</label>
                        <input type="text" class="form-control" placeholder="Jumlah Tiket">
                      </div>
                    </div>
                    
                    <div class="d-md-flex">
                      <div class="form-group col-12 col-md-12" style="text-align: right;">
                        <button type="button" class="btn btn-primary py-3 px-4"><i class="fas fa-search"></i> Cari Tiket</button>
                      </div>
                    </div>
                  </form>
                </div>
                
                <div class="tab-pane fade" id="list-cektiket" role="tabpanel" aria-labelledby="list-ticket-list">
                <form >
                    <div class="d-md-flex mt-2">
                      <div class="form-group col-12 col-md-12">
                        <label for="" class="label">Masukkan Nomor Tiket Anda</label>
                        <input type="text" class="form-control" name="" placeholder="Masukkan Nomor Tiket Anda">
                      </div>
                    </div>
                    <div class="d-md-flex">
                      <div class="form-group col-12 col-md-12" style="text-align: right;">
                        <button type="button" class="btn btn-primary py-3 px-4"><i class="fas fa-search"></i> Cek Tiket</button>
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

  <section class="ftco-section services-section ftco-no-pt ftco-no-pb">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-12 heading-section text-center ftco-animate mb-5">
          <span class="subheading">Our Services</span>
          <h2 class="mb-2">Our Services</h2>
        </div>
      </div>
      <div class="row d-flex">
        <div class="col-md-3 d-flex align-self-stretch ftco-animate">
          <div class="media block-6 services">
            <div class="media-body py-md-4">
              <div class="d-flex mb-3 align-items-center">
                <div class="icon"><span class="flaticon-customer-support"></span></div>
                <h3 class="heading mb-0 pl-3">24/7 Service</h3>
              </div>
            </div>
          </div>      
        </div>
        <div class="col-md-3 d-flex align-self-stretch ftco-animate">
          <div class="media block-6 services">
            <div class="media-body py-md-4">
              <div class="d-flex mb-3 align-items-center">
                <div class="icon"><span class="flaticon-route"></span></div>
                <h3 class="heading mb-0 pl-3">Banyak Tujuan</h3>
              </div>
            </div>
          </div>      
        </div>
        <div class="col-md-3 d-flex align-self-stretch ftco-animate">
          <div class="media block-6 services">
            <div class="media-body py-md-4">
              <div class="d-flex mb-3 align-items-center">
                <div class="icon"><span class="flaticon-online-booking"></span></div>
                <h3 class="heading mb-0 pl-3">Reservasi Tiket</h3>
              </div>
            </div>
          </div>      
        </div>
        <div class="col-md-3 d-flex align-self-stretch ftco-animate">
          <div class="media block-6 services">
            <div class="media-body py-md-4">
              <div class="d-flex mb-3 align-items-center">
                <div class="icon"><span class="flaticon-rent"></span></div>
                <h3 class="heading mb-0 pl-3">Rental Bus</h3>
              </div>
            </div>
          </div>      
        </div>
      </div>
    </div>
  </section>

  <section class="ftco-section">
    <div class="container-fluid px-4">
      <div class="row justify-content-center">
        <div class="col-md-12 heading-section text-center ftco-animate mb-5">
          <span class="subheading">What we offer</span>
          <h2 class="mb-2">Fasilitas Kami</h2>
        </div>
      </div>
      <div class="row">

        <div class="col-md-3">
          <div class="car-wrap ftco-animate" style="padding: 30px;">
            <div class="img d-flex align-items-end" style="background-image: url(<?php echo base_url('/assets/front/images/') ?>ac.png);">

            </div>
            <div class="text p-4 text-center">
              <h2 class="mb-0">Air Conditioner</h2>
            </div>
          </div>
        </div>

        <div class="col-md-3">
          <div class="car-wrap ftco-animate" style="padding: 30px;">
            <div class="img d-flex align-items-end" style="background-image: url(<?php echo base_url('/assets/front/images/') ?>24jam.png);">

            </div>
            <div class="text p-4 text-center">
              <h2 class="mb-0">24 Hours Service</h2>
            </div>
          </div>
        </div>

        <div class="col-md-3">
          <div class="car-wrap ftco-animate" style="padding: 30px;">
            <div class="img d-flex align-items-end" style="background-image: url(<?php echo base_url('/assets/front/images/') ?>lcd.png);">

            </div>
            <div class="text p-4 text-center">
              <h2 class="mb-0">LCD TV</h2>
            </div>
          </div>
        </div>

        <div class="col-md-3">
          <div class="car-wrap ftco-animate" style="padding: 30px;">
            <div class="img d-flex align-items-end" style="background-image: url(<?php echo base_url('/assets/front/images/') ?>kursi.png);">

            </div>
            <div class="text p-4 text-center">
              <h2 class="mb-0">Tempat Duduk Nyaman</h2>
            </div>
          </div>
        </div>
        
      </div>
    </div>
  </section>

  <section class="ftco-section services-section img" style="background-image: url(<?php echo base_url('/assets/front/images/') ?>busberlian.jpg);">
    <div class="overlay"></div>
    <div class="container">
      <div class="row justify-content-center mb-5">
        <div class="col-md-7 text-center heading-section heading-section-white ftco-animate">
          <span class="subheading">Alur Pemesanan</span>
          <h2 class="mb-3">Alur Pemesanan</h2>
        </div>
      </div>
      <div class="row">
        <div class="col-md-3 d-flex align-self-stretch ftco-animate">
          <div class="media block-6 services services-2">
            <div class="media-body py-md-4 text-center">
              <div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-route"></span></div>
              <h3>Pilih Tanggal Keberangkatan</h3>
            </div>
          </div>      
        </div>
        <div class="col-md-3 d-flex align-self-stretch ftco-animate">
          <div class="media block-6 services services-2">
            <div class="media-body py-md-4 text-center">
              <div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-select"></span></div>
              <h3>Pilih Kota Tujuan</h3>
            </div>
          </div>      
        </div>
        <div class="col-md-3 d-flex align-self-stretch ftco-animate">
          <div class="media block-6 services services-2">
            <div class="media-body py-md-4 text-center">
              <div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-rent"></span></div>
              <h3>>Pilih Armada / jenis Bus</h3>
            </div>
          </div>      
        </div>
        <div class="col-md-3 d-flex align-self-stretch ftco-animate">
          <div class="media block-6 services services-2">
            <div class="media-body py-md-4 text-center">
              <div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-review"></span></div>
              <h3>Masukkan Jumlah Penumpang</h3>
            </div>
          </div>      
        </div>
      </div>
    </div>
  </section>


  <section class="ftco-section ftco-no-pt ftco-no-pb">
    <div class="container">
      <div class="row no-gutters">
        <div class="col-md-6 p-md-5 img img-2 d-flex justify-content-center align-items-center" style="background-image: url(<?php echo base_url('/assets/front/images/') ?>busjaya.jpg);">
        </div>
        <div class="col-md-6 wrap-about py-md-5 ftco-animate">
          <div class="heading-section mb-5 pl-md-5">
            <span class="subheading">About us</span>
            <h2 class="mb-4">Banyak pilihan Bus Ternyaman</h2>

            <p>Rencana pergi ke Ibukota Jakarta? Anda wajib mencoba layanan bus AKAP Berlian Jaya.</p>
            <p>Bus Berlian Jaya adalah perusahaan otobus pendatang baru yang sebelumnya bernama PO. Pepeje yang berganti nama karena diakuisisi.
              Bermarkas di Kota Kudus, Jawa Tengah, bus Berlian Jaya tentunya menjadi kebangaan dan solusi transportasi warga Jawa Tengah yang ingin pergi ke Jakarta.</p>
          </div>
        </div>
      </div>
    </div>
  </section>