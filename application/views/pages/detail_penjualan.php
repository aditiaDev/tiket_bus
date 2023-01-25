<!-- DataTables -->
<link rel="stylesheet" href="<?php echo base_url('/assets/adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css'); ?>">
<link rel="stylesheet" href="<?php echo base_url('/assets/adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css'); ?>">
<link rel="stylesheet" href="<?php echo base_url('/assets/adminlte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css'); ?>">
<style>
  #tb_data>tbody>tr>td>.form-control{
    font-size: 12px;
    height: 30px;
  }
</style>
<div class="content-wrapper">  
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card" style="margin-top: 1rem">
            <form id="FRM_DATA" method="post">
              <div class="card-header">
                <h3 class="card-title">Detail Penjualan </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="row">
                  <div class="col-xs-12 col-lg-12">
                    <table class="table tb_no_top" >
                        <tr>
                            <td style="text-align:right;">ID Penjualan</td>
                            <td><input type="text" class="form-control" name="id_penjualan" style="width:200px;" value="<?php echo $this->uri->segment(3) ?>" readonly></td>
                            <td style="text-align:right;">Tanggal</td>
                            <td style="width:200px;"><input type="text" class="form-control" name="tgl_jual"  readonly ></td>
                            <td style="text-align:right;">Status</td>
                            <td>
                                <select name="status"  class="form-control">
                                    <option value="proses">Proses</option>
                                    <option value="kirim">Kirim</option>
                                    <option value="selesai">Selesai</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align:right;">No Nota</td>
                            <td><input type="text" class="form-control" name="no_nota"></td>
                            <td style="text-align:right;">Tanggal Nota</td>
                            <td><input type="text" class="form-control datepicker" name="tgl_nota" ></td>
                            <td style="text-align:right;">Pelanggan</td>
                            <td><input type="hidden" class="form-control" name="id_pelanggan"  readonly ><input type="text" class="form-control" name="nm_pelanggan"  readonly ></td>
                        </tr>
                        <tr>
                            <td style="text-align:right;vertical-align: top;">Alamat Pengiriman</td>
                            <td colspan="2"><textarea name="alamat_pengiriman" class="form-control"></textarea></td>
                            <td></td>
                            <td style="text-align:right;">Status</td>
                            
                        </tr>
                        <tr>
                            <td style="text-align:right;vertical-align: top;">Keterangan</td>
                            <td colspan="2"><textarea name="ket_penjualan" class="form-control"></textarea></td>
                        </tr>
                        <tr>
                            <td colspan="3"></td>
                            <td  style="text-align:right;">Total</td>
                            <td colspan="2"><input type="text" class="form-control" name="tot_penjualan" readonly></td>
                        </tr>
                    </table>
                  </div>
                </div>

                <div class="row">
                    <div class="col-12">
                      <div style="position: relative;height: 400px;overflow: auto;display: block;">
                        <table class="table table-bordered" id="tb_data" style="font-size:12px;width:1100px;" >
                            <thead>
                                <th style="width: 130px;">Kode Barang</th>
                                <th style="width: 310px;">Deskripsi</th>
                                <th style="width: 140px;">Harga</th>
                                <th style="width: 100px;">Qty</th>
                                <th style="width: 140px;">Finishing</th>
                                <th style="width: 170px;">Sub Total</th>
                                <th>Change Status</th>
                            </thead>
                            <tbody >
                                
                            </tbody>
                        </table>
                      </div>
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
        $("#btn_tambah").attr("disabled", true)
        
        REFRESH_DATA($("[name='id_penjualan']").val())
        // setTimeout(function(){
        //     DisabledForm()
        //     if($("[name='status']").val() == "proses"){
        //       $("[name='finishing[]']").attr('disabled', false)
        //     }
        // }, 100)

        $("#btn_edit").click(function(){
            $("#btn_tambah").attr("disabled", true)
            $("#btn_edit").attr("disabled", true)
            $("#btn_delete").attr("disabled", true)
            $("#btn_save").attr("disabled", false)
            $("#btn_cancel").attr("disabled", false)

            $("[name='id_penjualan']").attr("disabled", false)
            $("[name='no_nota']").attr("disabled", false)
            $("[name='tgl_nota']").attr("disabled", false)
            $("[name='status_barang[]']").attr("disabled", false)
            $("[name='id_barang[]']").attr("disabled", false)
            $("[name='finishing[]']").attr('disabled', false)
            $("[name='subtotal[]']").attr('disabled', false)
            $("[name='tot_penjualan']").attr('disabled', false)
            $("[name='status']").attr("disabled", false)
            $("[name='id_pelanggan']").attr("disabled", false)

        })

        $("#btn_save").click(function(){
            event.preventDefault();
            var formData = $("#FRM_DATA").serialize();
            $.ajax({
                url: "<?php echo site_url('penjualan/updateData') ?>",
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
                    console.log(data)
                    if (data.status == "success") {
                        toastr.info(data.message)
                        // REFRESH_DATA($("[name='id_penjualan']").val())

                        $("[name='id_penjualan']").attr("disabled", true)
                        $("[name='no_nota']").attr("disabled", true)
                        $("[name='tgl_nota']").attr("disabled", true)
                        $("[name='status']").attr("disabled", true)
                        $("[name='status_barang[]']").attr("disabled", true)
                        $("[name='id_barang[]']").attr("disabled", true)
                        $("[name='finishing[]']").attr('disabled', true)
                        $("[name='subtotal[]']").attr('disabled', true)
                        $("[name='tot_penjualan']").attr('disabled', true)

                        $("#btn_tambah").attr("disabled", true)
                        $("#btn_edit").attr("disabled", false)
                        $("#btn_delete").attr("disabled", false)
                        $("#btn_save").attr("disabled", true)
                        $("#btn_cancel").attr("disabled", true)

                    }else{
                        toastr.error(data.message)
                    }
                }
            })
        })
        
    })

    function REFRESH_DATA(id){
        var row=""
        var row_ket=""
        $("#tb_data tbody tr").remove()
        $.ajax({
            url: "<?php echo site_url('penjualan/getDataById') ?>",
            type: "POST",
            data: {
                id_penjualan: id
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
                console.log(data)
                $("[name='id_penjualan']").val(data[0].id_penjualan)
                $("[name='tgl_jual']").val(data[0].tgl_jual)
                $("[name='no_nota']").val(data[0].no_nota)
                $("[name='tgl_nota']").val(data[0].tgl_nota)
                $("[name='status']").val(data[0].status)
                $("[name='tot_penjualan']").val(data[0].tot_penjualan)
                $("[name='id_pelanggan']").val(data[0].id_pelanggan)
                $("[name='nm_pelanggan']").val(data[0].nm_pelanggan)
                $("[name='alamat_pengiriman']").val(data[0].alamat_pengiriman)
                $("[name='ket_penjualan']").val(data[0].ket_penjualan)
                $("[name='status']").val(data[0].status)

                $.each(data, function(index, item){
                    
                    subTotal = parseInt(item.jumlah*item.harga)+parseInt(item.finishing)
                    
                        var btn = '<select name="status_barang[]">'+
                                        '<option value="masih proses">Proses Pengerjaan</option>'+
                                        '<option value="sudah jadi">Sudah Jadi</option>'+
                                        '<option value="dibatalkan">Dibatalkan</option>'+
                                    '</select>'
                    
                    console.log(index)
                    row = '<tr id="col_'+index+'">'+
                                '<td><input type="text" value="'+item.id_barang+'" class="form-control" style="font-size: 14px;" required name="id_barang[]" id="id_barang_'+index+'" readonly></td>'+
                                '<td id="ket_barang_'+index+'">'+item.nm_barang+'</td>'+
                                '<td><input type="text" value="'+item.harga+'" class="form-control harga" name="harga[]" required oninput="hitungSubTotal('+index+')" id="harga_'+index+'" style="text-align: right;"></td>'+
                                '<td><input type="text" value="'+item.jumlah+'" class="form-control qty" name="jumlah[]" required oninput="hitungSubTotal('+index+')" style="text-align: right;" id="jumlah_'+index+'"></td>'+
                                '<td><input type="text" value="'+item.finishing+'" class="form-control finishing" name="finishing[]" required oninput="hitungSubTotal('+index+')" style="text-align: right;" id="finishing_'+index+'"></td>'+
                                '<td><input type="text" value="'+subTotal+'" class="form-control subtotal" name="subtotal[]" required id="subtotal_'+index+'" style="text-align: right;" readonly></td>'+
                                '<td>'+btn+'</td>'+
                            '</tr>';
                    $("#tb_data tbody").append(row);
                    $("[name='status_barang[]']:eq("+index+")").val(item.status_barang)
                })
                
                DisabledForm()
                // if(data[0].status == "proses"){
                //   $("[name='finishing[]']").attr('disabled', false)
                // }
                
                if(data[0].status == "selesai"){
                    $("#btn_edit").attr("disabled", true)
                    $("#btn_delete").attr("disabled", true)
                }
                
            }
        })

        
    }

    function DisabledForm(){
        var form = $("#FRM_DATA")[0];
        [].slice.call( form.elements ).forEach(function(item){
            item.disabled = !item.disabled;
        });
    }

    function hitungSubTotal(id){
        // console.log(id)
        var hasil = parseFloat($("#jumlah_"+id).val()*$("#harga_"+id).val())+parseFloat($("#finishing_"+id).val())
        $(".subtotal:eq("+id+")").val(hasil)

        var jml = $(".subtotal")
        var total=0
        $.each(jml, function(index, item) {
            // if($(".selectedItem:eq("+index+")").prop('checked') == true){
                SubTotal = $(".subtotal:eq("+index+")").val()
                if(SubTotal == "")
                SubTotal = 0
                total += parseFloat(SubTotal)
            // }
        });
        // console.log(total)
        $("[name='tot_penjualan']").val(total)
    }
</script>