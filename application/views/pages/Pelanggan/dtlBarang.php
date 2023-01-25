<section id="new-arrivals" class="new-arrivals">
    <div class="container">
        <div class="new-arrivals-content">
            <div class="row">
                <div class="col-xs-12 col-lg-12">
                        <table class="table tb_no_top" id="tb_data" style="font-size:14px" >
                            <tr>
                                <td rowspan="3" style="width: 250px;"><img id="foto"></td>
                                <td  colspan="2"><h3 id="nm_barang"></h3></td>
                            </tr>
                            <tr>
                                <td style="text-align: justify;" colspan="2">
                                    <p>Deskripsi:</p>
                                    <span id="ket_barang" style="font-weight: unset;"></span>
                                </td>
                            </tr>
                            <tr>
                                <td>Stok : <span id="stok"></span></td>
                                <td>Harga : Rp. <span id="harga"></span></td>
                            </tr>
                        </table>
                </div>
            </div>
        </div>
    </div>

</section>

<script src="<?php echo base_url('/assets/furn/assets/js/jquery.js');?>"></script>
<script>
    $(function(){
        $.ajax({
            url: "<?php echo site_url('barang/getById') ?>",
            type: "POST",
            dataType: "JSON",
            data:{
                id_barang: "<?php echo $this->uri->segment(3) ?>"
            },
            success: function(data){
                console.log(data)
                $("#foto").attr("src", "<?php echo base_url('/assets/images/barang/"+data[0].foto+"');?>")
                $("#nm_barang").text(data[0].nm_barang)
                $("#ket_barang").text(data[0].ket_barang)
                $("#stok").text(data[0].stok)
                $("#harga").text(data[0].harga_jual)
            }
        })
    })
</script>