<!-- DataTables -->
<link rel="stylesheet" href="<?php echo base_url('/assets/adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css'); ?>">
<link rel="stylesheet" href="<?php echo base_url('/assets/adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css'); ?>">
<link rel="stylesheet" href="<?php echo base_url('/assets/adminlte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css'); ?>">
<style>
  .form-control{
    font-size: 12px;
    height: unset!important;
  }
</style>
<section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('<?php echo base_url('/assets/front/images/') ?>busberlian.jpg');" data-stellar-background-ratio="0.5">
  <div class="overlay"></div>
  <div class="container">
    <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-start">
      <div class="col-md-9 ftco-animate pb-5">
        <p class="breadcrumbs"><span class="mr-2"><a href="<?php echo base_url() ?>">Home <i class="ion-ios-arrow-forward"></i></a></span> <span>History <i class="ion-ios-arrow-forward"></i></span></p>
        <h1 class="mb-3 bread">History Pembelian</h1>
      </div>
    </div>
  </div>
</section>
  
<section class="ftco-section">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <table class="table table-bordered" id="tb_history" style="font-size:12px;min-width:800px!important;width:100%;">
          <thead>
            <tr>
              <th>No<br>Tiket</th>
              <th>Tgl<br>Pembelian</th>
              <th>Tgl<br>Berangkat</th>
              <th>Tujuan</th>
              <th>Bus</th>
              <th style="width:50px;">Nominal</th>
              <th>Status<br>Pembayaran</th>
            </tr>
          </thead>
          <tbody></tbody>
        </table>
      </div>
    </div>
  </div>

  <div class="modal fade" id="modal_add">
    <div class="modal-dialog ">
      <div class="modal-content">
        <form id="FRM_UPLOAD" method="POST" enctype="multipart/form-data">
          <div class="modal-header">
            <h4 class="modal-title">Data</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            
              <div class="d-md-flex mt-2">
                <div class="form-group col-6 col-md-6">
                  <label for="" class="label">Nomor Ticket</label>
                  <input type="text" class="form-control" name="id_penjualan_tiket" onChange="cekTicket()" placeholder="Masukkan Nomor Tiket Anda">
                </div>
                <div class="form-group col-6 col-md-6">
                  <label for="" class="label">Bukti Pembayaran</label>
                  <input type="file" class="form-control" name="bukti_pembayaran"  accept="image/png, image/gif, image/jpeg">
                </div>
                
              </div>
              <div class="d-md-flex mt-2">
                <div class="form-group col-6 col-md-6">
                  <label for="" class="label">Jumlah Pembayaran</label>
                  <input type="text" class="form-control" id="jmlBayar" name="nominal" readonly>
                </div>
              </div>
              
            </div>
            
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" id="BTN_SAVE">Save</button>
          </div>
        </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->

</section>
<script src="<?php echo base_url('/assets/front/js/jquery.min.js'); ?>"></script>
<!-- DataTables  & Plugins -->
<script src="<?php echo base_url('/assets/adminlte/plugins/datatables/jquery.dataTables.min.js');?>"></script>
<script src="<?php echo base_url('/assets/adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js');?>"></script>
<script src="<?php echo base_url('/assets/adminlte/plugins/datatables-responsive/js/dataTables.responsive.min.js');?>"></script>
<script src="<?php echo base_url('/assets/adminlte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js');?>"></script>


<script>

  REFRESH_DATA()

  function REFRESH_DATA(){
    $('#tb_history').DataTable().destroy();
    var tb_data = $("#tb_history").DataTable({
      "order": [[ 0, "desc" ]],
      "autoWidth": false,
      "responsive": true,
      "pageLength": 10,
      "ajax": {
          "url": "<?php echo site_url('penjualan/getHistoryTiket') ?>",
          "type": "GET"
      },
      "columns": [
          { "data": "id_penjualan_tiket", className: "text-center" },
          { "data": "tgl_pembelian", className: "text-center" },
          { "data": null,
            "render" : function(data){
              return data.tgl_keberangkatan+"<br>"+data.waktu_keberangkatan
            },
            className: "text-center" 
          },
          { "data": "tujuan", className: "text-center" },
          { "data": null,
            "render" : function(data){
              return data.no_pol+"<br>"+data.nm_jenis_bus
            },
            className: "text-center" 
          },
          { "data": "nominal", className: "text-right" },
          { "data": null, 
            "render": function(data){
              var row
              if(!data.status_validasi){
                row = "<button class='btn btn-sm btn-info' onclick='editData("+JSON.stringify(data)+");'><i class='fas fa-upload'></i> Bukti Bayar</button>"
              }else{
                row = data.status_validasi
              }
              return row
            },
            className: "text-center" 
          },
      ]
    })
  }

  function editData(data, index){
    console.log(data)
    save_method = "edit"
    id_edit = data.id_penjualan_tiket;

    $("#modal_add .modal-title").text('Upload Bukti Pembayaran')
    $("[name='id_penjualan_tiket']").val(data.id_penjualan_tiket)
    $("[name='nominal']").val(data.nominal)
    $("#modal_add").modal('show')
  }

  $("#FRM_UPLOAD").on('submit', function(event){
    event.preventDefault();
    let formData = new FormData(this);

    urlPost = "<?php echo site_url('pembayaran/saveDataFront') ?>";

    $.ajax({
      url: urlPost,
      type: "POST",
      data: formData,
      processData : false,
      cache: false,
      contentType : false,
      success: function(data){
        data = JSON.parse(data)
        console.log(data)
        if (data.status == "success") {
          toastr.info(data.message)
          $("#modal_add").modal('hide')
        }else{
          toastr.error(data.message)
        }
      },
      error: function (err) {
        console.log(err);
      }
    })
  })
</script>