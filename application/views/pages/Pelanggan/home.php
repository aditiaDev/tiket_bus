
<!--new-arrivals start -->
<section id="new-arrivals" class="new-arrivals">
    <div class="container">
        <div class="section-header">
            <h2>new arrivals</h2>
        </div><!--/.section-header-->
        <div class="new-arrivals-content">
            <div class="row">
                <span id="postsList"></span>
                <!-- <div class="col-md-3 col-sm-4">
                    <div class="single-new-arrival">
                        <div class="single-new-arrival-bg">
                            <img src="<?php echo base_url('/assets/furn/assets/images/collection/arrivals1.png');?>" alt="new-arrivals images">
                            <div class="single-new-arrival-bg-overlay"></div>
                            <div class="sale bg-1">
                                <p>sale</p>
                            </div>
                            <div class="new-arrival-cart">
                                <p>
                                    <span class="lnr lnr-cart"></span>
                                    <a href="#">add <span>to </span> cart</a>
                                </p>
                                <p class="arrival-review pull-right">
                                    <span class="lnr lnr-heart"></span>
                                    <span class="lnr lnr-frame-expand"></span>
                                </p>
                            </div>
                        </div>
                        <h4><a href="#">wooden chair</a></h4>
                        <p class="arrival-product-price">$65.00</p>
                    </div>
                </div> -->
                
            </div>

            <div class="row">
                <div id='pagination'></div>
            </div>
        </div>
    </div><!--/.container-->

</section><!--/.new-arrivals-->
<!--new-arrivals end -->



<!-- jQuery -->
<script src="<?php echo base_url('/assets/adminlte/plugins/jquery/jquery.min.js'); ?>"></script>
<script type='text/javascript'>
  $(document).ready(function(){

    $('#pagination').on('click','a',function(e){
      e.preventDefault(); 
      var pageno = $(this).attr('data-ci-pagination-page');
      loadPagination(pageno);

        $('html, body').animate({
            scrollTop: $("#postsList").offset().top
        }, 2000)
    });

    loadPagination(0);

    function loadPagination(pagno){
      $.ajax({
        url: "<?php echo site_url('/home/loadRecord/') ?>"+pagno,
        type: 'get',
        dataType: 'json',
        success: function(response){
          $('#pagination').html(response.pagination);
          createTable(response.result,response.row);
        }
      });
    }

    function createTable(result,sno){
      sno = Number(sno);var row="";
      for(index in result){
        var content = result[index].ket_barang.replace(/<\/?[^>]+(>|$)/g, "");
        if(content.length > 200)
        content = content.substr(0, 200) + " ...";
        sno+=1;

        row += "<div class='col-md-3 col-sm-4'>"+
                    "<div class='single-new-arrival'>"+
                        "<div class='single-new-arrival-bg'>"+
                            "<img style='max-height: 300px;' src='<?php echo base_url('/assets/images/barang/"+result[index].foto+"');?>' >"+
                            "<div class='single-new-arrival-bg-overlay'></div>"+
                            "<div class='sale bg-2'>"+
                                "<p>Stok "+result[index].stok+"</p>"+
                            "</div>"+
                            "<div class='new-arrival-cart'>"+
                                "<p>"+
                                    "<span class='lnr lnr-cart'></span>"+
                                    "<a href='#' onclick='addCart(\""+result[index].id_barang+"\")'>add <span>to </span> cart</a>"+
                                "</p>"+
                                "<p class='arrival-review pull-right'>"+
                                    "<span class='lnr lnr-heart'></span>"+
                                    "<span class='lnr lnr-frame-expand'></span>"+
                                "</p>"+
                            "</div>"+
                        "</div>"+
                        "<h4><a href='<?php echo base_url('chart/dtlbarang/"+result[index].id_barang+"') ?>'>"+result[index].nm_barang+"</a></h4>"+
                        "<p class='arrival-product-price'>Rp. "+result[index].harga_jual+"</p>"+
                    "</div>"+
               "</div>";

      }
      $('#postsList').html(row)
    }
      
  });

  function addCart(id){
    event.preventDefault(); 
    $.ajax({
        url: "<?php echo site_url('home/addCart') ?>",
        type: "POST",
        data: {
            id_barang: id
        },
        dataType: "JSON",
        success: function(data){
            console.log(data)
            if (data.status == "success") {
                toastr.info(data.message)
                REFRESH_KERANJANG()

            }else{
                toastr.error(data.message)
            }
        }
    })
  }


//   function deleteKeranjang(id){
//     event.preventDefault(); 
//     alert('asd')
//   }
</script>