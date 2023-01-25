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
              <h3 class="card-title">Data Barang </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
            <div class="row">
              <div class="col-1">
                <button class="btn btn-sm btn-info" style="margin-bottom: 10px;" id="add_data"><i class="fas fa-plus-circle"></i> Tambah</button>
            
              </div>
              <div class="col-3">
                <select class="form-control" name="src_jenis">
                  <option value="">All</option>
                  <option value="BARANG JADI">BARANG JADI</option>
                  <option value="BAHAN BAKU">BAHAN BAKU</option>
                </select>
              </div>
            </div>
            <table id="tb_data" class="table table-bordered table-hover" style="font-size: 12px">
                <thead>
                <tr>
                  <th>Kode</th>
                  <th>Kategori</th>
                  <th>Barang</th>
                  <th>Jenis</th>
                  <th>Keterangan</th>
                  <th>Harga Beli</th>
                  <th>Harga Jual</th>
                  <th>Stok</th>
                  <th>Foto</th>
                  <th style="width:140px;">Action</th>
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
                    <label>Kode Barang</label>
                    <input type="text" class="form-control" name="id_barang" readonly>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>Kategori</label>
                    <select class="form-control" name="kategori_barang">
                    <option value="" disabled selected>Select your option</option>
                      <option value="lemari">Lemari</option>
                      <option value="kursi">Kursi</option>
                      <option value="meja">Meja</option>
                      <option value="lain-lain">Lain-lain</option>
                    </select>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>Nama Barang</label>
                    <input type="text" class="form-control" name="nm_barang">
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>Jenis Barang</label>
                    <select class="form-control" name="jenis">
                      <option value="" disabled selected>Select your option</option>
                      <option value="BARANG JADI">BARANG JADI</option>
                      <option value="BAHAN BAKU">BAHAN BAKU</option>
                    </select>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-sm-12">
                  <div class="form-group">
                    <label>Keterangan Barang</label>
                    <textarea name="ket_barang" class="form-control" rows="3"></textarea>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>Harga Beli</label>
                    <input type="text" class="form-control" name="harga_beli">
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>Harga Jual</label>
                    <input type="text" class="form-control" name="harga_jual">
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>Stok</label>
                    <input type="text" class="form-control" name="stok">
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label id="lbl_foto">Foto</label>
                    <div class="custom-file">
                      <input type="file"  name="foto">
                    </div>
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
<script>
  var save_method;
  var id_edit;
  $(function () {
    $(".datepicker").datepicker({
      autoclose: true,
      format: 'dd-M-yyyy'
    });

    $('.summernote').summernote({height: 300})
    
    REFRESH_DATA()

    $("[name='src_jenis']").change(function(){
      REFRESH_DATA()
    })

    $("#add_data").click(function(){
      $("#FRM_DATA")[0].reset()
      $("[name='foto_lowongan']").val('')
      $("[name='ket_lowongan']").summernote("code", "")
      save_method = "save"
      $("#lbl_foto").text("Tambahkan Foto")
      $("#modal_add .modal-title").text('Add Data')
      $("#modal_add").modal('show')
    }) 

    $("[name='kategori_barang']").change(function(){
      if(save_method != "edit")
      $.ajax({
        url: "<?php echo site_url('barang/generateIdBarang') ?>",
        type: "POST",
        data:{
          kategori_barang: $(this).val()
        },
        success: function(data){
          // console.log(data)
          $("[name='id_barang']").val(data)
        }
      })
    })


    $("#FRM_DATA").on('submit', function(event){
      event.preventDefault();
      let formData = new FormData(this);

      
      if(save_method == 'save') {
          urlPost = "<?php echo site_url('barang/saveData') ?>";
      }else{
          urlPost = "<?php echo site_url('barang/updateData/') ?>"+id_edit;
      }
      // console.log(formData)
      ACTION(urlPost, formData)
      $("#modal_add").modal('hide')
    })

  });

  function REFRESH_DATA(){
    $('#tb_data').DataTable().destroy();
    var tb_data = $("#tb_data").DataTable({
      "order": [[ 0, "desc" ]],
      "pageLength": 25,
      "autoWidth": false,
      "responsive": true,
      "ajax": {
          "url": "<?php echo site_url('barang/getAllData') ?>",
          "type": "POST",
          "data": {
            "jenis" : $("[name='src_jenis']").val()
          }
      },
      "columns": [
          { "data": "id_barang" },
          { "data": "kategori_barang"},
          { "data": "nm_barang"},
          { "data": "jenis"},
          { "data": "ket_barang"},
          { "data": "harga_beli"},
          { "data": "harga_jual"},
          { "data": "stok"},
          { "data": "foto",
            render: function (data, type, row, meta) {
                if(data){
                  return "<a target='_blank' href='<?php echo base_url() ?>assets/images/barang/"+data+"'><img  style='max-width: 120px;' class='img-fluid' src='<?php echo base_url() ?>assets/images/barang/"+data+"' ></a>";
                }else{
                  return "No File"
                }
            }
          },
          { "data": null, 
            "render" : function(data){
              return "<button class='btn btn-sm btn-warning' onclick='editData("+JSON.stringify(data)+");'><i class='fas fa-edit'></i> Edit</button> "+
                "<button class='btn btn-sm btn-danger' onclick='deleteData(\""+data.id_barang+"\");'><i class='fas fa-trash'></i> Delete</button>"
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
    id_edit = data.id_barang;
    console.log(id_edit)
    $("[name='foto']").val('')
    $("#lbl_foto").text("Ganti Foto")
    $("#modal_add .modal-title").text('Edit Data')
    $("[name='id_barang']").val(data.id_barang)
    $("[name='kategori_barang']").val(data.kategori_barang)
    $("[name='ket_barang']").val(data.ket_barang)
    $("[name='nm_barang']").val(data.nm_barang)
    $("[name='stok']").val(data.stok)
    $("[name='jenis']").val(data.jenis)
    $("[name='harga_beli']").val(data.harga_beli.replaceAll(".",""))
    $("[name='harga_jual']").val(data.harga_jual.replaceAll(".",""))
    $("#modal_add").modal('show')
  }

  function deleteData(id){
    if(!confirm('Delete this data?')) return

    urlPost = "<?php echo site_url('barang/deleteData') ?>";
    formData = "id_barang="+id
    
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
</script>