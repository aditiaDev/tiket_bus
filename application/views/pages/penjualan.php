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
              <h3 class="card-title">Data Penjualan</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              
              <!-- <a href="<?php echo base_url("penjualan/addData/")?>" class="btn btn-sm btn-info" style="margin-bottom: 10px;"><i class="fas fa-plus-circle"></i> Tambah</a> -->
              <table id="tb_data" class="table table-bordered table-hover" style="font-size: 12px">
                <thead>
                <tr>
                  <th>ID Penjualan</th>
                  <th>Tanggal</th>
                  <th>No nota</th>
                  <th>Tgl nota</th>
                  <th>Pelanggan</th>
                  <th>Total Pembayaran</th>
                  <th>Status</th>
                  <th>Detail</th>
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
                      <label>Supplier</label>
                      <input type="text" class="form-control" name="nm_supplier">
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Telp/No. HP</label>
                      <input type="text" class="form-control" name="no_tlp">
                    </div>
                  </div>
                </div>

                <div class="form-group">
                  <label>Alamat</label>
                  <textarea class="form-control" name="alamat" rows="3"></textarea>
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
  var tb_data;
  $(function () {
    

    REFRESH_DATA()
    
 

    $("#BTN_SAVE").click(function(){
      event.preventDefault();
      var formData = $("#FRM_DATA").serialize();

      
      if(save_method == 'save') {
          urlPost = "<?php echo site_url('supplier/saveData') ?>";
      }else{
          urlPost = "<?php echo site_url('supplier/updateData') ?>";
          formData+="&id_supplier="+id_edit
      }
      // console.log(formData)
      ACTION(urlPost, formData)
      $("#modal_add").modal('hide')
    })


  });

  function REFRESH_DATA(){
    $('#tb_data').DataTable().destroy();
    tb_data = $("#tb_data").DataTable({
      "order": [[ 1, "asc" ]],
      "orderCellsTop": true,
      "ordering": false,
      "autoWidth": false,
      "responsive": true,
      "pageLength": 25,
      "ajax": {
          "url": "<?php echo site_url('penjualan/getAllData') ?>",
          "type": "GET"
      },
      "columns": [
          { "data": "id_penjualan" },
          { "data": "tgl_jual" },{ "data": "no_nota" },
          { "data": "tgl_nota" },
          { "data": null,
            "render": function(data){
              return "ID: "+data.id_pelanggan+"</br> Nama: "+data.nm_pelanggan
            }
          },
          { "data": "tot_penjualan" },{ "data": "status" },
          { "data": "id_penjualan", 
            "render" : function(data){
              return "<a class='btn btn-xs btn-default detail_data' href='<?php echo base_url('penjualan/dtlData/"+data+"') ?>'><i class='fas fa-edit'></i> Detail</a>"
            },
            className: "text-center"
          },
          { "data": null, 
            "render" : function(data){
              if(data.status == "proses")
                return "<button class='btn btn-sm btn-danger' onclick='deleteData(\""+data.id_penjualan+"\");'><i class='fas fa-trash'></i> Delete</button>"
              else
                return ""
            },
            className: "text-center"
          },
      ]
    })

    
  }

  $('#tb_data thead tr').clone(true).appendTo( '#tb_data thead' );
  $('#tb_data thead tr:eq(1) th').each( function (i) {
    
      var title = $(this).text();
      if(i==6)
          $(this).html("<select class='column_search'>"+
                          "<option value=''>All</option>"+
                          "<option value='proses'>Proses</option>"+
                          "<option value='kirim'>Kirim</option>"+
                          "<option value='selesai'>Selesai</option>"+
                      "</select>");
      else
      $(this).html('');
  } );

  $( '#tb_data thead'  ).on( 'change', ".column_search",function () {
   
    tb_data
        .column( $(this).parent().index() )
        .search( this.value )
        .draw();
  } );

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
    id_edit = data.id_supplier;
    $("#modal_add .modal-title").text('Edit Data')
    $("[name='nm_supplier']").val(data.nm_supplier)
    $("[name='no_tlp']").val(data.no_tlp)
    $("[name='alamat']").val(data.alamat)
    $("#modal_add").modal('show')
  }

  function deleteData(id){
    if(!confirm('Delete this data?')) return

    urlPost = "<?php echo site_url('penjualan/deleteData') ?>";
    formData = "id_penjualan="+id
    ACTION(urlPost, formData)
  }
</script>