<section id="new-arrivals" class="new-arrivals">
    <div class="container">
        <!-- <div class="section-header">
            <h2>new arrivals</h2>
        </div> -->
        <form  id="FRM_DATA" method="post">
            <div class="new-arrivals-content">
                <div class="row">
                    <div class="col-xs-12 col-lg-12">
                        <table class="table tb_no_top">
                            <tr>
                                <td style="text-align:right;">ID Penjualan</td>
                                <td><input type="text" class="form-control" name="id_penjualan" style="width:200px;" readonly></td>
                                <td style="text-align:right;">Tanggal</td>
                                <td><input type="text" class="form-control" name="tgl_jual" style="width:150px;" readonly value="<?php echo date('d-M-Y'); ?>"></td>
                            </tr>
                            <!-- <tr>
                                <td style="text-align:right;">No Nota</td>
                                <td><input type="text" class="form-control" name="no_nota"></td>
                                <td style="text-align:right;">Tanggal Nota</td>
                                <td><input type="text" class="form-control datepicker" name="tgl_nota" style="width:150px;" value="<?php echo date('d-M-Y'); ?>"></td>
                            </tr> -->
                            <tr>
                                <td style="text-align:right;vertical-align: top;">Alamat Pengiriman</td>
                                <td colspan="2"><textarea name="alamat_pengiriman" class="form-control"></textarea></td>
                            </tr>
                            <tr>
                                <td style="text-align:right;vertical-align: top;">Keterangan</td>
                                <td colspan="2"><textarea name="ket_penjualan" class="form-control"></textarea></td>
                            </tr>
                            <tr>
                                <td colspan="2"></td>
                                <td style="text-align:right;">Total</td>
                                <td style="width:250px;"><input type="text" class="form-control" name="tot_penjualan" style="text-align:right;" readonly></td>
                                <td><button type="submit" class="btn btn-warning">Checkout <span class="lnr lnr-cart"></span></button></td>
                            </tr>
                        </table>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12 col-lg-12">
                            <table class="table table-bordered" id="tb_data" style="font-size:14px" >
                                <thead>
                                    <th style="width: 60px;text-align:center;">
                                        #
                                    </th>
                                    <th style="width: 350px;">Items</th>
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
        </form>
    </div>

</section>

<script src="<?php echo base_url('/assets/furn/assets/js/jquery.js');?>"></script>
<script>
    $(function(){
        $(".datepicker").datepicker({
            autoclose: true,
            format: 'dd-M-yyyy'
        });
        LIST_CHART()


        $("#FRM_DATA").on('submit', function(event){
            event.preventDefault();
            if(!confirm('Checkout Pembelian?')) return
            let formData = new FormData(this);

            $.ajax({
                url: "<?php echo site_url('chart/saveData') ?>",
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
                        toastr.info(data.message+data.DOC_NO)
                        $("[name='id_penjualan']").val(data.DOC_NO)
                        LIST_CHART()
                        REFRESH_KERANJANG()
                    }else{
                        toastr.error(data.message)
                    }
                },
                error: function (err) {
                    console.log(err);
                }
            })
        })
        
    })

    function LIST_CHART(){
        var row="";var total=0;
        $.ajax({
            url: "<?php echo site_url('home/listKeranjang') ?>",
            type: "POST",
            dataType: "JSON",
            success: function(data){
                
                $("#jmlKeranjang").text(data.length)

                if(data.length == 0) toastr.info("Oops! Keranjangmu kosong")

                $.each(data, function(index, item){
                    total = parseInt(item.harga_jual * item.jumlah)
                    row += '<tr id="col_'+index+'">'+
                                '<td style="text-align:center;">'+
                                    '<input type="checkbox" class="selectedItem" name="id_barang[]" onclick="hitungSubTotal('+index+')" value="'+item.id_barang+'" >'+
                                '</td>'+
                                '<td>'+
                                    '<div class="single-cart-list">'+
                                        '<a href="#" class="photo"><img style="max-height: 100px;max-width: 100px;" src="<?php echo base_url("/assets/images/barang/'+item.foto+'");?>" class="cart-thumb" alt="image"></a>'+
                                        '<div class="cart-list-txt" style="width: 100%;">'+
                                            '<h6><span style="color: #43465d;font-size: 12px;line-height: 1.3;">'+item.nm_barang+'</span></h6>'+
                                        '</div>'+
                                        '<div class="cart-list-txt">'+
                                            '<button type="button" onclick="deleteRow('+index+')" class="btn btn-sm btn-danger" style="border-radius: 50%;"><i class="fas fa-trash"></i></button>'+
                                        '</div>'+
                                    '</div>'+
                                '</td>'+
                                '<td style="text-align:right;" class="harga">'+item.harga_jual+'<input type="hidden" value="'+item.harga_jual+'" name="harga[]" ></td>'+
                                '<td style="width:200px"><input type="text" style="text-align:right;" name="jumlah[]" id="jumlah_'+index+'" oninput="hitungSubTotal('+index+')" class="form-control" value="'+item.jumlah+'" ></td>'+
                                '<td style="text-align:right;" class="subtotal">'+total+'</td>'+
                            '</tr>'	
                })
                
                $("#tb_data tbody").html(row)
            }
        })
    }

    function hitungSubTotal(id){
        // console.log(id)
        var hasil = parseFloat($("#jumlah_"+id).val()*$(".harga:eq("+id+")").text())
        $(".subtotal:eq("+id+")").text(hasil)

        var jml = $(".subtotal")
        var total=0
        $.each(jml, function(index, item) {
            if($(".selectedItem:eq("+index+")").prop('checked') == true){
                SubTotal = $(".subtotal:eq("+index+")").html()
                if(SubTotal == "")
                SubTotal = 0
                total += parseFloat(SubTotal)
            }
        });
        // console.log(total)
        $("[name='tot_penjualan']").val(total)
    }

    function deleteRow(id){
        if(!confirm('Delete this data?')) return
        
        $.ajax({
            url: "<?php echo site_url('chart/deleteData') ?>",
            type: "POST",
            data: {
                id_barang: $(".selectedItem:eq("+id+")").val()
            },
            dataType: "JSON",
            success: function(data){
                // console.log(data)
                if (data.status == "success") {
                    toastr.success(data.message)
                    $('#col_'+id).remove();
                    REFRESH_KERANJANG()
                }else{
                    toastr.error(data.message)
                }
            }
        })
        
    }
</script>