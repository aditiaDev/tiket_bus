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
            <form id="FRM_DATA" method="post">
              <div class="card-header">
                <h3 class="card-title">Tambah Pembelian </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="row">
                  <div class="col-xs-12 col-lg-12">
                    <table class="table tb_no_top">
                      <tr>
                          <td>ID Pembelian</td>
                          <td colspan="2"><input type="text" class="form-control" name="id_pembelian" readonly></td>
                          <td>Tanggal Beli</td>
                          <td><input type="text" class="form-control datepicker" name="tgl_pembelian" value="<?php echo date('d-M-Y'); ?>"></td>
                      </tr>
                      <tr>
                          <td>Supplier</td>
                          <td><input type="text" class="form-control" name="id_supplier" readonly></td>
                          <td><button class="btn btn-default" type="button" id="btn_supl"><i class="fas fa-list"></i></button></td>
                          <td colspan="2"><input type="text" class="form-control" name="nm_supplier" readonly></td>
                          <td>Status</td>
                          <td><input type="text" class="form-control" style="text-transform: uppercase;" name="status_pembelian" value="pengajuan" readonly></td>
                      </tr>
                      <tr>
                          <td colspan="5"></td>
                          <td>Total</td>
                          <td><input type="text" class="form-control" name="tot_pembelian" readonly></td>
                      </tr>
                    </table>
                  </div>
                </div>

                <div class="row">
                  <div class="col-12">
                    <!-- <div class="card card-primary card-outline card-tabs"> -->
                      <div class="card-header p-0 pt-1 border-bottom-0">
                        <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                          <li class="nav-item">
                            <a class="nav-link active" id="custom-tabs-three-home-tab" data-toggle="pill" href="#custom-tabs-three-home" role="tab" aria-controls="custom-tabs-three-home" aria-selected="true">Items</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" id="custom-tabs-three-profile-tab" data-toggle="pill" href="#custom-tabs-three-profile" role="tab" aria-controls="custom-tabs-three-profile" aria-selected="false">Keterangan</a>
                          </li>
                        </ul>
                      </div>
                      <div style="padding-top: 10px;">
                        <div class="tab-content" id="custom-tabs-three-tabContent">
                          <div class="tab-pane fade show active" id="custom-tabs-three-home" role="tabpanel" aria-labelledby="custom-tabs-three-home-tab">
                            <div class="row">
                              <div class="col-12">
                                <div style="position: relative;height: 400px;overflow: auto;display: block;">
                                  <table class="table table-bordered" id="tb_data" style="font-size:14px" >
                                    <thead>
                                      <th style="width: 60px;text-align:center;"><button type="button" class="btn btn-sm btn-info" id="ADD_DATA"><i class="fas fa-plus"></i></button></th>
                                      <th style="width: 170px;">Kode Barang</th>
                                      <th style="width: 60px;"></th>
                                      <th style="width: 350px;">Deskripsi</th>
                                      <th >Harga</th>
                                      <th >Qty</th>
                                      <th>Sub Total</th>
                                    </thead>
                                    <tbody >
                                        
                                    </tbody>
                                  </table>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="tab-pane fade" id="custom-tabs-three-profile" role="tabpanel" aria-labelledby="custom-tabs-three-profile-tab">
                            <div class="row">
                              <div class="col-12">
                                <table class="table tb_no_top" id="tb_ket">
                                  <thead>
                                    <th><button type="button" class="btn btn-sm btn-info" id="ADD_KET" style="border-radius: 50%;"><i class="fas fa-plus"></i></button></th>
                                  </thead>
                                  <tbody></tbody>
                                </table>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- /.card -->
                    <!-- </div> -->
                  </div>
                </div>

                
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <div class="d-flex justify-content-center">
                  <button type="button" disabled name="btn_baru" class="btn btn-default" style="margin-left:10px;"><i class="fas fa-plus"></i> New</button>
                  <a href="<?php echo base_url('pembelian'); ?>" onclick="return confirm('Are you sure?')"  style="margin-left:10px;" name="btn_cancel" class="btn btn-warning"><i class="fas fa-backspace"></i> Kembali</a>
                  <button type="submit" name="btn_simpan" class="btn btn-info" style="margin-left:10px;"><i class="fas fa-save"></i> Simpan</button>
                  <button type="button" disabled name="btn_cetak" class="btn btn-danger" style="margin-left:10px;"><i class="fas fa-print"></i> Cetak</button>
                </div>
              </div>
            </form>
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
    </div>

    <div class="modal fade" id="modal_supl">
      <div class="modal-dialog">
        <div class="modal-content">
          
            <div class="modal-header">
              <h4 class="modal-title">Pilih Supplier</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              *)Double clik untuk memilih item
              <div class="row">
                <div class="col-12">
                  <table class="table table-bordered table-hover" id="tb_supl" style="width:100%;">
                    <thead>
                      <th style="width:90px">ID Supplier</th>
                      <th>Supplier</th>
                    </thead>
                  </table>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
          
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

    <div class="modal fade" id="modal_add">
      <div class="modal-dialog" style="max-width: 1000px;">
        <div class="modal-content">
          
            <div class="modal-header">
              <h4 class="modal-title">Pilih Barang</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              *)Double clik untuk memilih item
              <div class="row">
                <div class="col-12">
                  <table class="table table-bordered table-hover" id="tb_barang" style="width:100%;">
                    <thead>
                      <th>Kode Barang</th>
                      <th>Deskripsi</th>
                      <th>Harga Beli Terakhir</th>
                      <th>Foto</th>
                      <th>Stok</th>
                    </thead>
                  </table>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
          
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
  var no_id=0;
  var no_ket=0
  var noList=0;

  $(function(){

    $(".datepicker").datepicker({
      autoclose: true,
      format: 'dd-M-yyyy'
    });

    $("#btn_supl").click(function(){
      tb_supl = $('#tb_supl').DataTable( {
            "order": [[ 0, "asc" ]],
            "pageLength": 10,
            "bInfo" : false,
            "bDestroy": true,
            "select": true,
            "ajax": {
                "url": "<?php echo site_url('supplier/getAllData') ?>",
                "type": "GET",
            },
            "columns": [
              { "data": "id_supplier" },
              { "data": "nm_supplier"},
            ]
        });

      $("#modal_supl").modal('show')
    })

    $('body').on( 'dblclick', '#tb_supl tbody tr', function (e) {
        var Rowdata = tb_supl.row( this ).data();

        $("[name='id_supplier']").val(Rowdata.id_supplier)
        $("[name='nm_supplier']").val(Rowdata.nm_supplier)
        $('#modal_supl').modal('hide');

    });

    $("#ADD_KET").click(function(event){
      event.preventDefault();

      no_ket = no_ket+1;
      var row = '<tr id="col_'+no_ket+'">'+
                    '<td style="width:70px;"><button type="button" onclick="deleteRow(\'tb_ket\','+no_ket+')" class="btn btn-sm btn-danger" style="border-radius:50%;"><i class="fas fa-minus"></i></button></td>'+
                    '<td><textarea class="form-control" name="penjelasan[]" required></textarea></td>'+
                  '</tr>';

      $("#tb_ket tbody").append(row);

    })

    $("#ADD_DATA").click(function(event){
      event.preventDefault();
      if($("[name='id_supplier']").val() == ""){
        toastr.error('Pilih Supplier dahulu')
        return
      }

      no_id = no_id+1;
      var row = '<tr id="col_'+no_id+'">'+
                    '<td><button type="button" onclick="deleteRow(\'tb_data\','+no_id+')" class="btn btn-sm btn-danger"><i class="fas fa-minus"></i></button></td>'+
                    '<td><input type="text" class="form-control" style="font-size: 14px;" required name="id_barang[]" id="id_barang_'+no_id+'" readonly></td>'+
                    '<td><button type="button" class="btn btn-default" name="BTN_ITEM_NO[]" onclick="SHOW_ITEMS('+no_id+')"><i class="fas fa-list"></i></button></td>'+
                    '<td id="ket_barang_'+no_id+'"></td>'+
                    '<td><input type="text" class="form-control harga" name="harga[]" required oninput="hitungSubTotal('+no_id+')" id="harga_'+no_id+'" style="text-align: right;"></td>'+
                    '<td><input type="text" class="form-control qty" name="qty_beli[]" required oninput="hitungSubTotal('+no_id+')" style="text-align: right;" id="qty_beli_'+no_id+'"></td>'+
                    '<td><input type="text" class="form-control subtotal" name="subtotal[]" required id="subtotal_'+no_id+'" style="text-align: right;" readonly></td>'+
                  '</tr>';

      $("#tb_data tbody").append(row);

    })

    $('body').on( 'dblclick', '#tb_barang tbody tr', function (e) {
        var Rowdata = tb_barang.row( this ).data();
        console.log(Rowdata);

        $("#id_barang_"+noList).val(Rowdata.id_barang)
        $("#ket_barang_"+noList).html(Rowdata.ket_barang)
        $('#modal_add').modal('hide');

    });

    $("#FRM_DATA").on('submit', function(event){
      event.preventDefault();
      let formData = new FormData(this);

      
          urlPost = "<?php echo site_url('Pembelian/saveData') ?>";
      // console.log(formData)
      ACTION(urlPost, formData)
    })

    $("[name='btn_baru']").click(function(){
      DisabledForm()
      $("[name='id_pembelian']").val('')
      $("[name='id_supplier']").val('')
      $("[name='nm_supplier']").val('')
      $("[name='tot_pembelian']").val('')

      $("#tb_data tbody tr").remove()
      $("#tb_ket tbody tr").remove()

      $("[name='btn_baru']").attr('disabled',true)
      $("[name='btn_cetak']").attr('disabled',true)
      $("[name='btn_cancel']").attr('disabled',false)
      $("[name='btn_simpan']").attr('disabled',false)
    })

    // $("#btn_print").click(function(){
    //   var form = document.createElement("form");
    //   $(form).attr("action", "http://intranet/mm/mod_laporan/rpt/Print_pr_rpt.php")
    //          .attr("method", "post")
    //          .attr("target", "_blank");
    //   $(form).html('<input type="hidden" name="prno" value="'+$("[name='PR_NO']").val()+'" />');
    //   document.body.appendChild(form);
    //   $(form).submit();
    //   document.body.removeChild(form);
    // });

  })

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
          $("[name='id_pembelian']").val(data.DOC_NO)
          DisabledForm()
          $("[name='btn_baru']").attr('disabled',false)
          $("[name='btn_cetak']").attr('disabled',false)
          $("[name='btn_cancel']").attr('disabled',false)
        }else{
          toastr.error(data.message)
        }
      },
      error: function (err) {
        console.log(err);
      }
    })
     
  }

  function DisabledForm(){
    var form = $("#FRM_DATA")[0];
    [].slice.call( form.elements ).forEach(function(item){
      item.disabled = !item.disabled;
    });
  }

  function SHOW_ITEMS(id){
    noList = id;
    tb_barang = $('#tb_barang').DataTable( {
            "order": [[ 0, "asc" ]],
            "pageLength": 10,
            "bInfo" : false,
            "bDestroy": true,
            "select": true,
            "ajax": {
                "url": "<?php echo site_url('barang/getAllData') ?>",
                "type": "GET",
            },
            "columns": [
              { "data": "id_barang" },
              { "data": "ket_barang"},
              { "data": "harga_beli"},
              { "data": "foto",
                render: function (data, type, row, meta) {
                    if(data){
                      return "<a target='_blank' href='<?php echo base_url() ?>assets/images/barang/"+data+"'><img  style='max-width: 120px;' class='img-fluid' src='<?php echo base_url() ?>assets/images/barang/"+data+"' ></a>";
                    }else{
                      return "No File"
                    }
                },
                className: "text-center"
              },
              { "data": "stok"},
            ]
        });

    
    $("#tb_select_item_filter input[type=search]").val("").change();
    $("#modal_add").modal('show')
    $("#tb_select_item tbody tr td").css("cursor","pointer");
  }

  function hitungSubTotal(id){
    var hasil = parseFloat($("#harga_"+id).val()*$("#qty_beli_"+id).val())
    $("#subtotal_"+id).val(hasil)

    var jml = $(".subtotal")
    var total=0
    $.each(jml, function(index, item) {

        SubTotal = $("[name='subtotal[]']")[index].value
        if(SubTotal == "")
          SubTotal = 0
        total += parseFloat(SubTotal)
    });
    // console.log(total)
    $("[name='tot_pembelian']").val(total)
  }

  function deleteRow(table, id){
    $('#'+table+' #col_'+id).remove();
  }
</script>