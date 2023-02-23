<!-- DataTables -->
<link rel="stylesheet" href="<?php echo base_url('/assets/adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css'); ?>">
<link rel="stylesheet" href="<?php echo base_url('/assets/adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css'); ?>">
<link rel="stylesheet" href="<?php echo base_url('/assets/adminlte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css'); ?>">
<!-- Select2 -->
<link rel="stylesheet" href="<?php echo base_url('/assets/adminlte/plugins/select2/css/select2.min.css'); ?>">
<link rel="stylesheet" href="<?php echo base_url('/assets/adminlte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css'); ?>">

<div class="content-wrapper">  
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card" style="margin-top: 1rem">
            <div class="card-header">
              <h3 class="card-title">Data Pembayaran</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <button class="btn btn-sm btn-info" style="margin-bottom: 10px;" id="add_data"><i class="fas fa-plus-circle"></i> Tambah</button>
              <table id="tb_data" class="table table-bordered table-hover" style="font-size: 12px">
                <thead>
                <tr>
                  <th>ID Pembayaran</th>
                  <th>Tanggal Bayar</th>
                  <th>ID Tiket</th>
                  <th>Jumlah</th>
                  <th>Harga Tiket</th>
                  <th>Total Bayar</th>
                  <th>Bukti Pembayaran</th>
                  <th>Status</th>
                  <th style="min-width: 150px;">Action</th>
                </tr>
                </thead>
                <tbody>
                
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
    </div>

    <div class="modal fade" id="modal_add">
      <div class="modal-dialog ">
        <div class="modal-content">
          <form id="FRM_DATA" method="post" enctype="multipart/form-data">
            <div class="modal-header">
              <h4 class="modal-title">Data</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              
                <div class="row">
                  <div class="col-sm-12">
                    <div class="form-group">
                      <label>ID Penjualan Tiket</label>
                      <select class="form-control select2" name="id_penjualan_tiket" onChange="GET_DTL_PENJUALAN()"></select>
                    </div>
                  </div>

                  
                </div>

                <div class="row">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Jumlah Pembelian</label>
                      <input type="text" class="form-control" name="jumlah_pembelian" readonly>
                    </div>
                  </div>

                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Nominal Pembayaran</label>
                      <input type="text" class="form-control" name="nominal" readonly>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label id="lbl_foto">Upload Bukti Pembayaran</label>
                      <div class="custom-file">
                        <input type="file"  name="bukti_pembayaran">
                      </div>
                    </div>
                  </div>

                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Status Validasi</label>
                      <select class="form-control" name="status_validasi">
                        <option value="TERVALIDASI">TERVALIDASI</option>
                        <option value="TERUPLOAD">TERUPLOAD</option>
                      </select>
                    </div>
                  </div>
                </div>
                
              </div>
              
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary" id="BTN_SAVE">Save changes</button>
            </div>
          </form>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
  </section>
</div>

<!-- jQuery -->
<script src="<?php echo base_url('/assets/adminlte/plugins/jquery/jquery.min.js'); ?>"></script>
<!-- Select2 -->
<script src="<?php echo base_url('/assets/adminlte/plugins/select2/js/select2.full.min.js'); ?>"></script>
<script>
  var save_method;
  var id_edit;
  var id_user;
  $(function () {
    
    $(".select2").select2()
    REFRESH_DATA()
    // ISI_ID_PENJUALAN()


    $("#add_data").click(function(){
      ISI_ID_PENJUALAN()
      
      $("#FRM_DATA")[0].reset()
      save_method = "save"
      $("#modal_add .modal-title").text('Add Data')
      $("#modal_add").modal('show')
    }) 

    $("#FRM_DATA").on('submit', function(event){
      event.preventDefault();
      let formData = new FormData(this);

      
      if(save_method == 'save') {
          urlPost = "<?php echo site_url('pembayaran/saveData') ?>";
      }else{
          urlPost = "<?php echo site_url('pembayaran/updateData/') ?>"+id_edit;
      }
      // console.log(formData)
      ACTION(urlPost, formData)
      $("#modal_add").modal('hide')
    })


  });

  function REFRESH_DATA(){
    $('#tb_data').DataTable().destroy();
    var tb_data = $("#tb_data").DataTable({
      "order": [[ 0, "asc" ]],
      "autoWidth": false,
      "responsive": true,
      "pageLength": 25,
      "ajax": {
          "url": "<?php echo site_url('pembayaran/getAllData') ?>",
          "type": "GET"
      },
      "columns": [
          
          { "data": "id_pembayaran" },
          { "data": "tgl_bayar" },{ "data": "id_penjualan_tiket" },{ "data": "jumlah_pembelian", className: "text-right" },{ "data": "harga", className: "text-right" },{ "data": "nominal", className: "text-right" },
          { "data": "bukti_pembayaran", 
            "render" : function(data){
              if(data == "CASH"){
                return "CASH on Site"
              }else{
                return "<a target='_blank' href='<?php echo base_url() ?>assets/images/bukti/"+data+"'><img  style='max-width: 120px;' class='img-fluid' src='<?php echo base_url() ?>assets/images/bukti/"+data+"' ></a>"
              }
              
            },
            className: "text-center"
          },
          { "data": "status_validasi" },
          { "data": null, 
            "render" : function(data){
              if(data.status_validasi == "TERVALIDASI"){
                return "<button class='btn btn-sm btn-danger' onclick='deleteData(\""+data.id_pembayaran+"\");'><i class='fas fa-trash'></i> Delete</button> "+
                "<button class='btn btn-sm btn-success' onclick='sendNotif(\""+data.id_pembayaran+"\");'><i class='fas fa-paper-plane'></i> Send WA</button>"
              }else{
                return "<button class='btn btn-sm btn-warning' onclick='verifyData(\""+data.id_pembayaran+"\");'><i class='fas fa-edit'></i> Verifikasi</button> "+
                "<button class='btn btn-sm btn-danger' onclick='deleteData(\""+data.id_pembayaran+"\");'><i class='fas fa-trash'></i> Delete</button>"
              }
              
            },
            className: "text-center"
          },
          // { "data": null, 
          //   "render" : function(data){
          //     return "<button class='btn btn-sm btn-warning' onclick='editData("+JSON.stringify(data)+");'><i class='fas fa-edit'></i> Edit</button> "+
          //       "<button class='btn btn-sm btn-danger' onclick='deleteData(\""+data.id_pembayaran+"\");'><i class='fas fa-trash'></i> Delete</button>"
          //   },
          //   className: "text-center"
          // },
      ]
    })
  }

  function ACTION(urlPost, formData){
    
    $.ajax({
      url: urlPost,
      type: "POST",
      data: formData,
      beforeSend: function(){
        $("#LOADER").show();
      },
      complete: function(){
        $("#LOADER").hide();
      },
      processData : false,
      cache: false,
      contentType : false,
      success: function(data){
        data = JSON.parse(data)
        console.log(data)
        if (data.status == "success") {
          toastr.info(data.message)
          REFRESH_DATA()

        }else{
          toastr.error(data.message)
        }
      },
      error: function (err) {
        console.log(err);
      }
    })
     
  }

  function editData(data, index){
    console.log(data)
    save_method = "edit"
    var id_penjualan_tiket
    id_edit = data.id_pembayaran;
    $("#lbl_foto").text("Ganti Foto Pembayaran")

    $.ajax({
      url: "<?php echo site_url('pembayaran/getPenjualanById') ?>",
      type: "POST",
      dataType: "JSON",
      data: {
        id_pembayaran: data.id_pembayaran
      },
      success: function(data){
        // console.log(data['data'])
        // var row = "<option></option>"
        // $.map( data['data'], function( val, i ) {
        //   row += "<option value='"+val.id_penjualan_tiket+"'>"+val.id_penjualan_tiket+" - "+val.nm_pelanggan+"</option>"
        //   id_penjualan_tiket = val.id_penjualan_tiket
        // });
        // $("[name='id_penjualan_tiket']").html(row)
        $("[name='id_penjualan_tiket']").append("<option value='"+data['data'][0]['id_penjualan_tiket']+"'>"+data['data'][0]['id_penjualan_tiket']+" - "+data['data'][0]['nm_pelanggan']+"</option>")
        $("[name='id_penjualan_tiket']").val(data['data'][0]['id_penjualan_tiket']).change()
      }
    })

    $("#modal_add .modal-title").text('Edit Data')
    

    $("#modal_add").modal('show')
  }

  function deleteData(id){
    if(!confirm('Delete this data?')) return

    urlPost = "<?php echo site_url('pembayaran/deleteData') ?>";
    formData = "id_pembayaran="+id
    $.ajax({
        url: urlPost,
        type: "POST",
        data: formData,
        dataType: "JSON",
        success: function(data){
          // console.log(data)
          if (data.status == "success") {
            toastr.info(data.message)
            

            REFRESH_DATA()

          }else{
            toastr.error(data.message)
          }
        }
    })
  }

  function sendNotif(id_data){
    if(!confirm('Send WA Notif?')) return

    urlPost = "<?php echo site_url('pembayaran/sendNotif') ?>";
    formData = "id_pembayaran="+id_data
    $.ajax({
        url: urlPost,
        type: "POST",
        data: formData,
        dataType: "JSON",
        success: function(data){
          // console.log(data)
          if (data.status == "success") {
            toastr.info(data.message)
            REFRESH_DATA()

          }else{
            toastr.error(data.message)
          }
        }
    })
  }

  function verifyData(id){
    console.log(id)
    if(!confirm('Verify this data?')) return

    urlPost = "<?php echo site_url('pembayaran/verifyData') ?>";
    formData = "id_pembayaran="+id
    $.ajax({
        url: urlPost,
        type: "POST",
        data: formData,
        dataType: "JSON",
        success: function(data){
          // console.log(data)
          if (data.status == "success") {
            toastr.info(data.message)
            

            REFRESH_DATA()

          }else{
            toastr.error(data.message)
          }
        }
    })
  }

  function ISI_ID_PENJUALAN(){
    $.ajax({
      url: "<?php echo site_url('pembayaran/getPenjualan') ?>",
      type: "POST",
      dataType: "JSON",
      success: function(data){
        // console.log(data['data'])
        var row = "<option></option>"
        $.map( data['data'], function( val, i ) {
          row += "<option value='"+val.id_penjualan_tiket+"'>"+val.id_penjualan_tiket+" - "+val.nm_pelanggan+"</option>"
          
        });
        $("[name='id_penjualan_tiket']").html(row)
      }
    })
  }

  function GET_DTL_PENJUALAN(){
    $.ajax({
      url: "<?php echo site_url('pembayaran/getDtlPenjualan') ?>",
      type: "POST",
      data:{
        id_penjualan_tiket: $("[name='id_penjualan_tiket']").val()
      },
      dataType: "JSON",
      success: function(data){
        // console.log(data['data'])
        
        $("[name='jumlah_pembelian']").val(data['data'][0]['jumlah_pembelian'])
        $("[name='nominal']").val(data['data'][0]['nominal'])
      }
    })
  }
</script>