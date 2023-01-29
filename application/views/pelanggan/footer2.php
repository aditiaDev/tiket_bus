<!--newsletter strat -->
<section id="newsletter"  class="newsletter">
			<div class="container">
				<div class="hm-footer-details">
					<div class="row">
						<div class=" col-md-3 col-sm-6 col-xs-12">
							<div class="hm-footer-widget">
								<div class="hm-foot-title">
									<h4>information</h4>
								</div><!--/.hm-foot-title-->
								<div class="hm-foot-menu">
									<ul>
										<li><a href="#">about us</a></li><!--/li-->
										<li><a href="#">contact us</a></li><!--/li-->
										<li><a href="#">news</a></li><!--/li-->
										<li><a href="#">store</a></li><!--/li-->
									</ul><!--/ul-->
								</div><!--/.hm-foot-menu-->
							</div><!--/.hm-footer-widget-->
						</div><!--/.col-->
						<div class=" col-md-3 col-sm-6 col-xs-12">
							<div class="hm-footer-widget">
								<div class="hm-foot-title">
									<h4>collections</h4>
								</div><!--/.hm-foot-title-->
								<div class="hm-foot-menu">
									<ul>
										<li><a href="#">wooden chair</a></li><!--/li-->
										<li><a href="#">royal cloth sofa</a></li><!--/li-->
										<li><a href="#">accent chair</a></li><!--/li-->
										<li><a href="#">bed</a></li><!--/li-->
										<li><a href="#">hanging lamp</a></li><!--/li-->
									</ul><!--/ul-->
								</div><!--/.hm-foot-menu-->
							</div><!--/.hm-footer-widget-->
						</div><!--/.col-->
						<div class=" col-md-3 col-sm-6 col-xs-12">
							<div class="hm-footer-widget">
								<div class="hm-foot-title">
									<h4>my accounts</h4>
								</div><!--/.hm-foot-title-->
								<div class="hm-foot-menu">
									<ul>
										<li><a href="#">my account</a></li><!--/li-->
										<li><a href="#">wishlist</a></li><!--/li-->
										<li><a href="#">Community</a></li><!--/li-->
										<li><a href="#">order history</a></li><!--/li-->
										<li><a href="#">my cart</a></li><!--/li-->
									</ul><!--/ul-->
								</div><!--/.hm-foot-menu-->
							</div><!--/.hm-footer-widget-->
						</div><!--/.col-->
						<div class=" col-md-3 col-sm-6  col-xs-12">
							<div class="hm-footer-widget">
								<div class="hm-foot-title">
									<h4>newsletter</h4>
								</div><!--/.hm-foot-title-->
								<div class="hm-foot-para">
									<p>
										Subscribe  to get latest news,update and information.
									</p>
								</div><!--/.hm-foot-para-->
								<div class="hm-foot-email">
									<div class="foot-email-box">
										<input type="text" class="form-control" placeholder="Enter Email Here....">
									</div><!--/.foot-email-box-->
									<div class="foot-email-subscribe">
										<span><i class="fa fa-location-arrow"></i></span>
									</div><!--/.foot-email-icon-->
								</div><!--/.hm-foot-email-->
							</div><!--/.hm-footer-widget-->
						</div><!--/.col-->
					</div><!--/.row-->
				</div><!--/.hm-footer-details-->

			</div><!--/.container-->

		</section><!--/newsletter-->	
		<!--newsletter end -->

		<!--footer start-->
		<footer id="footer"  class="footer">
			<div class="container">
				<div class="hm-footer-copyright text-center">
					<div class="footer-social">
						<a href="#"><i class="fa fa-facebook"></i></a>	
						<a href="#"><i class="fa fa-instagram"></i></a>
						<a href="#"><i class="fa fa-linkedin"></i></a>
						<a href="#"><i class="fa fa-pinterest"></i></a>
						<a href="#"><i class="fa fa-behance"></i></a>	
					</div>
					<p>
						&copy;copyright. designed and developed by <a href="https://www.themesine.com/">themesine</a>
					</p><!--/p-->
				</div><!--/.text-center-->
			</div><!--/.container-->

			<div id="scroll-Top">
				<div class="return-to-top">
					<i class="fa fa-angle-up " id="scroll-top" data-toggle="tooltip" data-placement="top" title="" data-original-title="Back to Top" aria-hidden="true"></i>
				</div>
				
			</div><!--/.scroll-Top-->
			
        </footer><!--/.footer-->
		<!--footer end-->
		
		<!-- Include all js compiled plugins (below), or include individual files as needed -->

		<script src="<?php echo base_url('/assets/furn/assets/js/jquery.js');?>"></script>
        
        <!--modernizr.min.js-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>
		
		<!--bootstrap.min.js-->
        <script src="<?php echo base_url('/assets/furn/assets/js/bootstrap.min.js');?>"></script>
		<script src="<?php echo base_url('/assets/adminlte/plugins/toastr/toastr.min.js'); ?>"></script>
		<!-- bootsnav js -->
		<script src="<?php echo base_url('/assets/furn/assets/js/bootsnav.js');?>"></script>

		<!--owl.carousel.js-->
        <script src="<?php echo base_url('/assets/furn/assets/js/owl.carousel.min.js');?>"></script>
		<script src="<?php echo base_url('/assets/adminlte/plugins/datepicker/bootstrap-datepicker.js'); ?>"></script>

		<!-- DataTables  & Plugins -->
<script src="<?php echo base_url('/assets/adminlte/plugins/datatables/jquery.dataTables.min.js');?>"></script>
<script src="<?php echo base_url('/assets/adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js');?>"></script>
<script src="<?php echo base_url('/assets/adminlte/plugins/datatables-responsive/js/dataTables.responsive.min.js');?>"></script>
<script src="<?php echo base_url('/assets/adminlte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js');?>"></script>

		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
		
        
        <!--Custom JS-->
        <script src="<?php echo base_url('/assets/furn/assets/js/custom.js');?>"></script>
        <script>
			REFRESH_KERANJANG()
			function REFRESH_KERANJANG(){
				var row="";//var total=0;
				$.ajax({
					url: "<?php echo site_url('home/listKeranjang') ?>",
					type: "POST",
					dataType: "JSON",
					success: function(data){
						$("#jmlKeranjang").text(data.length)

						$.each(data, function(index, item){
							row += "<li class='single-cart-list'>"+
										"<a href='#' class='photo'><img style='max-width: unset;' src='<?php echo base_url('/assets/images/barang/"+item.foto+"');?>' class='cart-thumb' alt='image' /></a>"+
										"<div class='cart-list-txt'>"+
											"<h6><span style='color: #43465d;font-size: 12px;line-height: 1.3;'>"+item.nm_barang+"</span></h6>"+
											"<p>"+item.jumlah+" x - <span class='price'>Rp. "+item.harga_jual+"</span></p>"+
										"</div>"+
										"<div class='cart-close'>"+
											"<span class='lnr lnr-cross' onclick='deleteKeranjang(\""+item.id_barang+"\")'></span>"+
										"</div>"+
									"</li>"
							// total = total + (item.harga_jual*item.jumlah)		
						})
						// row += "<li class='total'>"+
						// 			"<span>Total: Rp. "+total+"</span>"+
						// 			"<button class='btn-cart pull-right' >view cart</button>"+
						// 		"</li>"

						row += '<li class="total">'+
									'<button class="btn-cart" onclick="document.location.href=\'<?php echo base_url('chart') ?>\'" >view cart</button>'+
								'</li>'

						$("#listKeranjang").html(row)
					}
				})
			}

			function deleteKeranjang(id){
				event.preventDefault(); 
				alert('asd')
			}
		</script>
    </body>
	
</html>