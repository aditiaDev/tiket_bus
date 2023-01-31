<div class="content-wrapper">  
  <section class="content">
    <div class="container-fluid">
        <form action="<?php echo base_url('report/ctkPelanggan') ?>" method="POST" target="_blank">
            <div class="row">
                <div class="col-12">
                <div class="card" style="margin-top: 1rem">
                    <div class="card-header">
                    <h3 class="card-title">Laporan Pelanggan</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-3" style="margin-bottom: 10px;">
                                <button class="btn btn-default" id="proses"><i class="fas fa-print"></i> Cetak</button>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
        </form>
    </div>
  </section>
</div>

<script src="<?php echo base_url('/assets/adminlte/plugins/jquery/jquery.min.js'); ?>"></script>
<script>
  var save_method;
  var id_edit;
  var tb_data;
  $(function () {
    
    $(".datepicker").datepicker({
      autoclose: true,
      format: 'yyyy-mm-dd'
    });

  });
</script>