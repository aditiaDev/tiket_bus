<!-- DataTables -->
<link rel="stylesheet" href="<?php echo base_url('/assets/adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css'); ?>">
<link rel="stylesheet" href="<?php echo base_url('/assets/adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css'); ?>">
<link rel="stylesheet" href="<?php echo base_url('/assets/adminlte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css'); ?>">
<link rel="stylesheet" href="<?php echo base_url('/assets/adminlte/plugins/flatpickr/flatpickr.css'); ?>">
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
              <h3 class="card-title">Data Penjualan Tiket</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <button class="btn btn-sm btn-info" style="margin-bottom: 10px;" id="add_data"><i class="fas fa-plus-circle"></i> Tambah</button>
              <table id="tb_data" class="table table-bordered table-hover" style="font-size: 12px">
                <thead>
                <tr>
                  <th style="width: 25px;">No.</th>
                  <th>ID Penjualan</th>
                  <th>Tgl Pembelian</th>
                  <th>Tujuan</th>
                  <th>Nopol Bus</th>
                  <th>Tgl Keberangkatan</th>
                  <th>Jumlah</th>
                  <th>Jenis Pembelian</th>
                  <th style="min-width: 120px;">Action</th>
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
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <form id="FRM_DATA">
            <div class="modal-header">
              <h4 class="modal-title">Data</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              
                <div class="row">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Tanggal Keberangkatan Pelanggan</label>
                      <input type="text" class="form-control date" name="tgl_keberangkatan" 
                      onChange="ISI_TUJUAN()" >
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Tujuan</label>
                      <select class="form-control select2" name="tujuan" onChange="ISI_JENISBUS()"></select>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Jenis Bus</label>
                      <select class="form-control" name="id_jenis_bus" onChange="ISI_BUS()"></select>
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Pilih Bus</label>
                      <select class="form-control" name="id_tiket_bus" ></select>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Jumlah Tiket</label>
                      <input type="text" class="form-control" name="jumlah_pembelian">
                    </div>
                  </div>

                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>ID Pelanggan</label>
                      <select class="form-control select2" name="id_pelanggan" ></select>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Nama Pelanggan</label>
                      <input type="text" class="form-control" name="nm_pelanggan">
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>No. Telpon</label>
                      <input type="text" class="form-control" name="no_pelanggan">
                    </div>
                  </div>
                </div>
                
              </div>
              
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary" id="BTN_SAVE">Save changes</button>
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
<script src="<?php echo base_url('/assets/adminlte/plugins/flatpickr/flatpickr.js'); ?>"></script>
<!-- Select2 -->
<script src="<?php echo base_url('/assets/adminlte/plugins/select2/js/select2.full.min.js'); ?>"></script>
<script>
  var save_method;
  var id_edit;
  var id_user;

  $(".datetime").flatpickr({
      enableTime: true,
      time_24hr: true,
      dateFormat: "Y-m-d H:i:S",
  });
  
  $(".date").flatpickr({
      dateFormat: "Y-m-d",
  });

  $('.select2').select2()

  $(function () {
    

    REFRESH_DATA()
    ISI_PELANGGAN()


    $("#add_data").click(function(){
      $("#FRM_DATA")[0].reset()
      save_method = "save"
      $("#modal_add .modal-title").text('Add Data')
      $("#modal_add").modal('show')
    }) 

    

    $("#BTN_SAVE").click(function(){
      event.preventDefault();
      var formData = $("#FRM_DATA").serialize();

      
      if(save_method == 'save') {
          urlPost = "<?php echo site_url('penjualan/saveData') ?>";
      }else{
          urlPost = "<?php echo site_url('penjualan/updateData') ?>";
          formData+="&id_penjualan_tiket="+id_edit
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
          "url": "<?php echo site_url('penjualan/getAllData') ?>",
          "type": "GET"
      },
      "columns": [
          {
              "data": null,
              render: function (data, type, row, meta) {
                  return meta.row + meta.settings._iDisplayStart + 1;
              }
          },
          { "data": "id_penjualan_tiket" },
          { "data": "tgl_pembelian" },{ "data": "tujuan" },{ "data": "no_pol" },{ "data": "tgl_keberangkatan" },
          { "data": "jumlah_pembelian" },{ "data": "jenis_penjualan_tiket" },
          { "data": null, 
            "render" : function(data){
              return "<button class='btn btn-sm btn-warning' onclick='editData("+JSON.stringify(data)+");'><i class='fas fa-edit'></i> Edit</button> "+
                "<button class='btn btn-sm btn-danger' onclick='deleteData(\""+data.id_penjualan_tiket+"\");'><i class='fas fa-trash'></i> Delete</button>"
            },
            className: "text-center"
          },
      ]
    })
  }

  function ACTION(urlPost, formData){
      $.ajax({
          url: urlPost,
          type: "POST",
          data: formData,
          dataType: "JSON",
          beforeSend: function () {
            $("#LOADER").show();
          },
          complete: function () {
            $("#LOADER").hide();
          },
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

  function editData(data, index){
    console.log(data)
    save_method = "edit"
    id_edit = data.id_penjualan_tiket;


    $("#modal_add .modal-title").text('Edit Data')
    $("[name='id_penjualan_tiket']").val(data.id_penjualan_tiket)
    $("[name='nm_jenis_bus']").val(data.nm_jenis_bus)
    $("#modal_add").modal('show')
  }

  function deleteData(id){
    if(!confirm('Delete this data?')) return

    urlPost = "<?php echo site_url('penjualan/deleteData') ?>";
    formData = "id_penjualan_tiket="+id
    ACTION(urlPost, formData)
  }

  function ISI_TUJUAN(){
    $.ajax({
      url: "<?php echo site_url('penjualan/getTujuanBus') ?>",
      type: "POST",
      data: {
        tgl_berangkat: $("[name='tgl_keberangkatan']").val()
      },
      dataType: "JSON",
      success: function(data){
        // console.log(data)
        var row = "<option></option>"
        $.map( data['data'], function( val, i ) {
          row += "<option value='"+val.tujuan+"'>"+val.tujuan+"</option>"
          
        });
        $("[name='tujuan']").html(row)
      }
    })
    
  }

  function ISI_JENISBUS(){
    $.ajax({
      url: "<?php echo site_url('penjualan/getJenisBus') ?>",
      type: "POST",
      data: {
        tujuan: $("[name='tujuan']").val(),
        tgl_berangkat: $("[name='tgl_keberangkatan']").val()
      },
      dataType: "JSON",
      success: function(data){
        // console.log(data)
        var row = "<option></option>"
        $.map( data['data'], function( val, i ) {
          row += "<option value='"+val.id_jenis_bus+"'>"+val.nm_jenis_bus+"</option>"
          
        });
        $("[name='id_jenis_bus']").html(row)
      }
    })
  }

  function ISI_BUS(){
    $.ajax({
      url: "<?php echo site_url('penjualan/getBus') ?>",
      type: "POST",
      data: {
        tujuan: $("[name='tujuan']").val(),
        id_jenis_bus: $("[name='id_jenis_bus']").val(),
        tgl_berangkat: $("[name='tgl_keberangkatan']").val()
      },
      dataType: "JSON",
      success: function(data){
        // console.log(data)
        var row = "<option></option>"
        $.map( data['data'], function( val, i ) {
          row += "<option value='"+val.id_tiket_bus+"'>"+val.no_pol+" - "+val.waktu_berangkat+"</option>"
          
        });
        $("[name='id_tiket_bus']").html(row)
      }
    })
  }

  function ISI_PELANGGAN(){
    $.ajax({
      url: "<?php echo site_url('penjualan/getPelanggan') ?>",
      type: "POST",
      dataType: "JSON",
      success: function(data){
        // console.log(data)
        var row = "<option></option>"
        $.map( data['data'], function( val, i ) {
          row += "<option value='"+val.id_pelanggan+"'>"+val.id_pelanggan+" - "+val.nm_pelanggan+"</option>"
          
        });
        $("[name='id_pelanggan']").html(row)
      }
    })
  }
</script>