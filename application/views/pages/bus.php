<!-- DataTables -->
<link rel="stylesheet" href="<?php echo base_url('/assets/adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css'); ?>">
<link rel="stylesheet" href="<?php echo base_url('/assets/adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css'); ?>">
<link rel="stylesheet" href="<?php echo base_url('/assets/adminlte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css'); ?>">
<div class="content-wrapper">  
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card" style="margin-top: 1rem">
            <div class="card-header">
              <h3 class="card-title">Data Bus</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <button class="btn btn-sm btn-info" style="margin-bottom: 10px;" id="add_data"><i class="fas fa-plus-circle"></i> Tambah</button>
              <table id="tb_data" class="table table-bordered table-hover" style="font-size: 12px">
                <thead>
                <tr>
                  <th style="width: 25px;">No.</th>
                  <th>ID Bus</th>
                  <th>Jenis Bus</th>
                  <th>Nopol</th>
                  <th>Jumlah Kursi</th>
                  <th>Foto</th>
                  <th>Deskripsi</th>
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
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Jenis Bus</label>
                      <select name="id_jenis_bus" class="form-control"></select>
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Kategori Bus</label>
                      <select name="id_kategori" class="form-control"></select>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Jumlah Kursi</label>
                      <input type="text" class="form-control" name="jumlah_kursi" 
                        onkeypress="return onlyNumberKey(event)" maxlength="3"
                      >
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>No. Polisi</label>
                      <input type="text" class="form-control" name="no_pol" >
                    </div>
                  </div>
                </div>

                <div class="form-group">
                  <label>Foto Bus</label>
                  <input type="file" name="foto" class="form-control">
                </div>

                <div class="form-group">
                  <label>Deskripsi Bus</label>
                  <textarea name="deskripsi" class="form-control" rows="3"></textarea>
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
<script>
  var save_method;
  var id_edit;
  var id_user;
  $(function () {
    

    REFRESH_DATA()
    ISI_SELECT()


    $("#add_data").click(function(){
      $("#FRM_DATA")[0].reset()
      save_method = "save"
      $("#modal_add .modal-title").text('Add Data')
      $("#modal_add").modal('show')
    }) 

    

    


  });

  function ISI_SELECT(){
    $.ajax({
      url: "<?php echo site_url('bus/getJenisBus') ?>",
      type: "GET",
      dataType: "JSON",
      success: function(data){
        console.log(data)
        $.map( data['data'], function( val, i ) {
          $("[name='id_jenis_bus']").append("<option value='"+val.id_jenis_bus+"'>"+val.nm_jenis_bus+"</option>")
        });
      }
    })

    $.ajax({
      url: "<?php echo site_url('bus/getKategoriBus') ?>",
      type: "GET",
      dataType: "JSON",
      success: function(data){
        console.log(data)
        $.map( data['data'], function( val, i ) {
          $("[name='id_kategori']").append("<option value='"+val.id_kategori+"'>"+val.nm_kategori+"</option>")
        });
      }
    })
  }

  function REFRESH_DATA(){
    $('#tb_data').DataTable().destroy();
    var tb_data = $("#tb_data").DataTable({
      "order": [[ 0, "asc" ]],
      "autoWidth": false,
      "responsive": true,
      "pageLength": 25,
      "ajax": {
          "url": "<?php echo site_url('bus/getAllData') ?>",
          "type": "GET"
      },
      "columns": [
          {
              "data": null,
              render: function (data, type, row, meta) {
                  return meta.row + meta.settings._iDisplayStart + 1;
              }
          },
          { "data": "id_bus" },
          { "data": "nm_jenis_bus" },
          { "data": "no_pol" },{ "data": "jumlah_kursi", class : "text-right" },
          { "data": "foto", 
            "render" : function(data){
              if(data == ""){
                return "Tidak ada Foto"
              }else{
                return "<a target='_blank' href='<?php echo base_url() ?>assets/images/"+data+"'><img  style='max-width: 120px;' class='img-fluid' src='<?php echo base_url() ?>assets/images/"+data+"' ></a>"
              }
              
            },
            className: "text-center"
          },
          { "data": "deskripsi" },
          { "data": null, 
            "render" : function(data){
              return "<button class='btn btn-sm btn-warning' onclick='editData("+JSON.stringify(data)+");'><i class='fas fa-edit'></i> Edit</button> "+
                "<button class='btn btn-sm btn-danger' onclick='deleteData(\""+data.id_bus+"\");'><i class='fas fa-trash'></i> Delete</button>"
            },
            className: "text-center"
          },
      ]
    })
  }

    // $("#BTN_SAVE").click(function(){
    //   event.preventDefault();
    //   var formData = $("#FRM_DATA").serialize();

      
    //   if(save_method == 'save') {
    //       urlPost = "<?php echo site_url('bus/saveData') ?>";
    //   }else{
    //       urlPost = "<?php echo site_url('bus/updateData') ?>";
    //       formData+="&id_bus="+id_edit
    //   }
    //   // console.log(formData)
    //   ACTION(urlPost, formData)
    //   $("#modal_add").modal('hide')
    // })

  function ACTION(urlPost, formData){
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

  $("#FRM_DATA").on('submit', function(event){
    event.preventDefault();
    let formData = new FormData(this);

    if(save_method == 'save') {
        urlPost = "<?php echo site_url('bus/saveData') ?>";
    }else{
        urlPost = "<?php echo site_url('bus/updateData/') ?>"+id_edit;
    }

    $.ajax({
      url: urlPost,
      type: "POST",
      data: formData,
      processData : false,
      cache: false,
      contentType : false,
      success: function(data){
        data = JSON.parse(data)
        // console.log(data)
        if (data.status == "success") {
          toastr.info(data.message)
          REFRESH_DATA()
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

  function editData(data, index){
    console.log(data)
    save_method = "edit"
    id_edit = data.id_bus;


    $("#modal_add .modal-title").text('Edit Data')
    $("[name='id_jenis_bus']").val(data.id_jenis_bus)
    $("[name='id_kategori']").val(data.id_kategori)
    $("[name='jumlah_kursi']").val(data.jumlah_kursi)
    $("[name='no_pol']").val(data.no_pol)
    $("[name='deskripsi']").val(data.deskripsi)
    $("#modal_add").modal('show')
  }

  function deleteData(id){
    if(!confirm('Delete this data?')) return

    urlPost = "<?php echo site_url('bus/deleteData') ?>";
    formData = "id_bus="+id
    ACTION(urlPost, formData)
  }

  function onlyNumberKey(evt) {
              
      // Only ASCII character in that range allowed
      var ASCIICode = (evt.which) ? evt.which : evt.keyCode
      if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57))
          return false;
      return true;
  }
</script>