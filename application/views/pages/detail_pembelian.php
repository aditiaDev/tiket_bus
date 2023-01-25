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
                <h3 class="card-title">Detail Pembelian </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="row">
                  <div class="col-xs-12 col-lg-12">
                    <table class="table tb_no_top">
                      <tr>
                          <td>ID Pembelian</td>
                          <td colspan="2"><input type="text" class="form-control" name="id_pembelian" readonly value="<?php echo $this->uri->segment(3) ?>"></td>
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
    $(function(){

        $(".datepicker").datepicker({
            autoclose: true,
            format: 'dd-M-yyyy'
        });

        $("#menuHeader").show()
        
        REFRESH_DATA($("[name='id_pembelian']").val())
        setTimeout(function(){
            DisabledForm()
        }, 1000)


        $("#btn_edit").click(function(){
            $("#btn_tambah").attr("disabled", true)
            $("#btn_edit").attr("disabled", true)
            $("#btn_delete").attr("disabled", true)
            $("#btn_save").attr("disabled", false)
            $("#btn_cancel").attr("disabled", false)

            DisabledForm()

        })
    })

    function REFRESH_DATA(id){
        var row=""
        var row_ket=""
        $.ajax({
            url: "<?php echo site_url('pembelian/getDataById') ?>",
            type: "POST",
            data: {
                id_pembelian: id
            },
            dataType: "JSON",
            beforeSend: function () {
                $("#LOADER").show();
            },
            complete: function () {
                $("#LOADER").hide();
            },
            success: function(data){
                // data = data.data 
                // console.log(data)
                $("[name='id_pembelian']").val(data[0].id_pembelian)
                $("[name='tgl_pembelian']").val(data[0].tgl_pembelian)
                $("[name='id_supplier']").val(data[0].id_supplier)
                $("[name='nm_supplier']").val(data[0].nm_supplier)
                $("[name='status_pembelian']").val(data[0].status_pembelian)
                $("[name='tot_pembelian']").val(data[0].tot_pembelian)

                $.each(data, function(index, item){
                    console.log(item)
                    subTotal = parseInt(item.qty_beli*item.harga)
                    row += '<tr id="col_'+index+'">'+
                                '<td><button type="button" onclick="deleteRow(\'tb_data\','+index+')" class="btn btn-sm btn-danger"><i class="fas fa-minus"></i></button></td>'+
                                '<td><input type="text" value="'+item.id_barang+'" class="form-control" style="font-size: 14px;" required name="id_barang[]" id="id_barang_'+index+'" readonly></td>'+
                                '<td><button type="button" class="btn btn-default" name="BTN_ITEM_NO[]" onclick="SHOW_ITEMS('+index+')"><i class="fas fa-list"></i></button></td>'+
                                '<td id="ket_barang_'+index+'">'+item.nm_barang+'</td>'+
                                '<td><input type="text" value="'+item.harga+'" class="form-control harga" name="harga[]" required oninput="hitungSubTotal('+index+')" id="harga_'+index+'" style="text-align: right;"></td>'+
                                '<td><input type="text" value="'+item.qty_beli+'" class="form-control qty" name="qty_beli[]" required oninput="hitungSubTotal('+index+')" style="text-align: right;" id="qty_beli_'+index+'"></td>'+
                                '<td><input type="text" value="'+subTotal+'" class="form-control subtotal" name="subtotal[]" required id="subtotal_'+index+'" style="text-align: right;" readonly></td>'+
                            '</tr>';
                })
                $("#tb_data tbody").html(row);
                
                if(data[0].status_pembelian != "pengajuan"){
                    $("#btn_edit").attr("disabled", true)
                    $("#btn_delete").attr("disabled", true)
                }
            }
        })

        $.ajax({
            url: "<?php echo site_url('pembelian/getKeteranganById') ?>",
            type: "POST",
            data: {
                id_pembelian: id
            },
            dataType: "JSON",
            beforeSend: function () {
                $("#LOADER").show();
            },
            complete: function () {
                $("#LOADER").hide();
            },
            success: function(data){

                $.each(data, function(index, item){
                    row_ket = '<tr id="col_'+index+'">'+
                        '<td style="width:70px;vertical-align: top;"><button type="button" onclick="deleteRow(\'tb_ket\','+index+')" class="btn btn-sm btn-danger" style="border-radius:50%;"><i class="fas fa-minus"></i></button></td>'+
                        '<td style="width: 200px;vertical-align: top;"><input type="text" name="tgl_input[]" class="form-control datepicker" value="'+item.tgl_input+'" ></td>'+
                        '<td><textarea class="form-control" name="penjelasan[]" required>'+item.penjelasan+'</textarea></td>'+
                    '</tr>';

                    
                })
                $("#tb_ket tbody").html(row_ket)
                $(".datepicker").datepicker({
                    autoclose: true,
                    format: 'dd-M-yyyy'
                });
            }
        })
    }

    function DisabledForm(){
        var form = $("#FRM_DATA")[0];
        [].slice.call( form.elements ).forEach(function(item){
            item.disabled = !item.disabled;
        });
    }
</script>