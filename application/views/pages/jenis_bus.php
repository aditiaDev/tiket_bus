<!-- DataTables -->
<link rel="stylesheet" href="<?php echo base_url('/assets/adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css'); ?>">
<link rel="stylesheet" href="<?php echo base_url('/assets/adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css'); ?>">
<link rel="stylesheet" href="<?php echo base_url('/assets/adminlte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css'); ?>">
<div class="content-wrapper">  
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-6">
          <div class="card" style="margin-top: 1rem">
            <div class="card-header">
              <h3 class="card-title">Data Jenis Bus</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <button class="btn btn-sm btn-info" style="margin-bottom: 10px;" id="add_data"><i class="fas fa-plus-circle"></i> Tambah</button>
              <table id="tb_data" class="table table-bordered table-hover" style="font-size: 12px">
                <thead>
                <tr>
                  <th style="width: 25px;">No.</th>
                  <th>ID Jenis</th>
                  <th>Jenis Bus</th>
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
          <form id="FRM_DATA">
            <div class="modal-header">
              <h4 class="modal-title">Data</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              
                <!-- <div class="row">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>ID Jenis</label>
                      <input type="text" class="form-control" name="id_jenis_bus" readonly>
                    </div>
                  </div>
                </div> -->

                <div class="form-group">
                  <label>Jenis Bus</label>
                  <textarea class="form-control" name="nm_jenis_bus" rows="2"></textarea>
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
<script>
  var save_method;
  var id_edit;
  var id_user;
  $(function () {
    

    REFRESH_DATA()
    


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
          urlPost = "<?php echo site_url('jenis_bus/saveData') ?>";
      }else{
          urlPost = "<?php echo site_url('jenis_bus/updateData') ?>";
          formData+="&id_jenis_bus="+id_edit
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
          "url": "<?php echo site_url('jenis_bus/getAllData') ?>",
          "type": "GET"
      },
      "columns": [
          {
              "data": null,
              render: function (data, type, row, meta) {
                  return meta.row + meta.settings._iDisplayStart + 1;
              }
          },
          { "data": "id_jenis_bus" },
          { "data": "nm_jenis_bus" },
          { "data": null, 
            "render" : function(data){
              return "<button class='btn btn-sm btn-warning' onclick='editData("+JSON.stringify(data)+");'><i class='fas fa-edit'></i> Edit</button> "+
                "<button class='btn btn-sm btn-danger' onclick='deleteData(\""+data.id_jenis_bus+"\");'><i class='fas fa-trash'></i> Delete</button>"
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
    id_edit = data.id_jenis_bus;


    $("#modal_add .modal-title").text('Edit Data')
    $("[name='id_jenis_bus']").val(data.id_jenis_bus)
    $("[name='nm_jenis_bus']").val(data.nm_jenis_bus)
    $("#modal_add").modal('show')
  }

  function deleteData(id){
    if(!confirm('Delete this data?')) return

    urlPost = "<?php echo site_url('jenis_bus/deleteData') ?>";
    formData = "id_jenis_bus="+id
    ACTION(urlPost, formData)
  }
</script>