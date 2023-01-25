<!-- DataTables -->
<link rel="stylesheet" href="<?php echo base_url('/assets/adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css'); ?>">
<link rel="stylesheet" href="<?php echo base_url('/assets/adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css'); ?>">
<link rel="stylesheet" href="<?php echo base_url('/assets/adminlte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css'); ?>">
<section id="new-arrivals" class="new-arrivals">
    <div class="container">
        <!-- <div class="section-header">
            <h2>new arrivals</h2>
        </div> -->
        <form  id="FRM_DATA" method="post">
            <div class="new-arrivals-content">
                <div class="row">
                    <div class="col-xs-12 col-lg-12">
                            <table class="table table-bordered" id="tb_data" style="font-size:14px" >
                                <thead>
                                    <th>ID Transaksi</th>
                                    <th >Tanggal Pemesanan</th>
                                    <th >No Nota</th>
                                    <th>Item</th>
                                    <th>Jumlah</th>
                                    <th>Harga</th>
                                    <th>Status Barang</th>
                                    <th>Total</th>
                                    <th>Status Transaksi</th>
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
        REFRESH_DATA()
    })

    function REFRESH_DATA(){
        $('#tb_data').DataTable().destroy();
        var tb_data = $("#tb_data").DataTable({
        "order": [[ 0, "asc" ]],
        "autoWidth": false,
        "responsive": true,
        "pageLength": 10,
        "ajax": {
            "url": "<?php echo site_url('chart/listTransaksi') ?>",
            "type": "GET"
        },
        "columns": [
            { "data": "id_penjualan" },
            { "data": "tgl_jual" },{ "data": "no_nota" },{ "data": "nm_barang" },{ "data": "jumlah" },
            { "data": "harga" },{ "data": "status_barang" },
            { "data": "subtotal" },{ "data": "status" },
        ]
        })
    }
</script>