<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends CI_Controller {

  public function __construct(){
    parent::__construct();
    // if(!$this->session->userdata('id_user'))
    //   redirect('login', 'refresh');
  }

  // https://mfikri.com/artikel/cara-mudah-membuat-qr-code-atau-kode-qr-dengan-codeigniter.html
  public function cetakTiket(){
    $this->load->library('ciqrcode');

    $config['cacheable']    = true; //boolean, the default is true
    $config['cachedir']     = './assets/'; //string, the default is application/cache/
    $config['errorlog']     = './assets/'; //string, the default is application/logs/
    $config['imagedir']     = './assets/images/qrcode'; //direktori penyimpanan qr code
    $config['quality']      = true; //boolean, the default is true
    $config['size']         = '1024'; //interger, the default is 1024
    $config['black']        = array(224,255,255); // array, default is array(255,255,255)
    $config['white']        = array(70,130,180); // array, default is array(0,0,0)
    $this->ciqrcode->initialize($config);

    $data['data'] = $this->db->query("SELECT A.id_penjualan_tiket, A.nm_pelanggan, A.tgl_keberangkatan,  
    A.jumlah_pembelian, B.tgl_bayar, B.status_validasi
    FROM `tb_penjualan_tiket` A
    LEFT JOIN tb_pembayaran_tiket B ON A.id_penjualan_tiket = B.id_penjualan_tiket
    WHERE A.id_penjualan_tiket='".$this->input->post('id_tiket')."'")->result_array();

    $data['data'][0]['qrcode'] = $this->input->post('id_tiket').".png";

    echo "<pre>";
    print_r($data);
    echo "</pre>";

    // $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => [70, 120], 'margin_left' => '1', 'margin_right' => '1']);
    // $html = $this->load->view('print/ctkTiket',$data, true);
    // $mpdf->WriteHTML($html);
    // $mpdf->Output();
  }
}