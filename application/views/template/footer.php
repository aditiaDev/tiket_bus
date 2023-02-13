<footer class="main-footer">
    <strong>Copyright &copy; 2021 <a href="<?php echo base_url("/")?>">Berlian Jaya</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.1.0
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="<?php echo base_url('/assets/adminlte/plugins/jquery/jquery.min.js'); ?>"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?php echo base_url('/assets/adminlte/plugins/jquery-ui/jquery-ui.min.js'); ?>"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="<?php echo base_url('/assets/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>
<script src="<?php echo base_url('/assets/adminlte/plugins/toastr/toastr.min.js'); ?>"></script>
<!-- ChartJS -->
<script src="<?php echo base_url('/assets/adminlte/plugins/chart.js/Chart.min.js'); ?>"></script>
<!-- Sparkline -->
<script src="<?php echo base_url('/assets/adminlte/plugins/sparklines/sparkline.js'); ?>"></script>
<!-- JQVMap -->
<script src="<?php echo base_url('/assets/adminlte/plugins/jqvmap/jquery.vmap.min.js'); ?>"></script>
<script src="<?php echo base_url('/assets/adminlte/plugins/jqvmap/maps/jquery.vmap.usa.js'); ?>"></script>
<!-- jQuery Knob Chart -->
<script src="<?php echo base_url('/assets/adminlte/plugins/jquery-knob/jquery.knob.min.js'); ?>"></script>
<!-- daterangepicker -->
<script src="<?php echo base_url('/assets/adminlte/plugins/moment/moment.min.js'); ?>"></script>
<script src="<?php echo base_url('/assets/adminlte/plugins/datepicker/bootstrap-datepicker.js'); ?>"></script>
<script src="<?php echo base_url('/assets/adminlte/plugins/select2/js/select2.full.min.js'); ?>"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="<?php echo base_url('/assets/adminlte/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js'); ?>"></script>
<!-- Summernote -->
<script src="<?php echo base_url('/assets/adminlte/plugins/summernote/summernote-bs4.min.js'); ?>"></script>
<!-- overlayScrollbars -->
<script src="<?php echo base_url('/assets/adminlte/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js'); ?>"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url('/assets/adminlte/dist/js/adminlte.js'); ?>"></script>


<!-- DataTables  & Plugins -->
<script src="<?php echo base_url('/assets/adminlte/plugins/datatables/jquery.dataTables.min.js');?>"></script>
<script src="<?php echo base_url('/assets/adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js');?>"></script>
<script src="<?php echo base_url('/assets/adminlte/plugins/datatables-responsive/js/dataTables.responsive.min.js');?>"></script>
<script src="<?php echo base_url('/assets/adminlte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js');?>"></script>

<script>
  var timer = null
  timer = setInterval(function() {
    zenziva_api()
  }, 5000);

  function zenziva_api(){
    $.ajax({
      url: "<?php echo site_url('front/zenziva_api') ?>",
      type: "POST",
      dataType: "JSON",
      success: function(data){
        console.log(data)
        if(data.status == "selesai"){
          clearInterval(timer);
          timer = null
        }
      }
    })
  }
</script>

</body>
</html>