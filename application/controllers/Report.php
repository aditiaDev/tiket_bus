<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends CI_Controller {

  public function __construct(){
    parent::__construct();
    // if(!$this->session->userdata('id_user'))
    //   redirect('login', 'refresh');
  }

  public function kepuasan(){
    $this->load->view('template/header');
    $this->load->view('template/sidebar');
    $this->load->view('pages/report_kepuasan');
    $this->load->view('template/footer');
  }

  public function pelanggan(){
    $this->load->view('template/header');
    $this->load->view('template/sidebar');
    $this->load->view('pages/report_pelanggan');
    $this->load->view('template/footer');
  }

  public function pemesanan(){
    $this->load->view('template/header');
    $this->load->view('template/sidebar');
    $this->load->view('pages/report_pemesanan');
    $this->load->view('template/footer');
  }

  public function kepuasanPeriod(){
    $this->load->view('template/header');
    $this->load->view('template/sidebar');
    $this->load->view('pages/report_kepuasan_period');
    $this->load->view('template/footer');
  }

  public function getKepuasanPeriod(){
    if ($this->input->post('id_bus') == "ALL") {
      $id_bus = '';
    }else{
      $id_bus = $this->input->post('id_bus');
    }
    
    $data['data'] = $this->db->query("SELECT B.no_pol, B.id_kategori, DATE(A.tgl_keberangkatan) tgl_keberangkatan, A.kota_keberangkatan, A.tujuan, 
    (select sum(jumlah_pembelian)  from tb_penjualan_tiket where id_tiket_bus = A.id_tiket_bus) jumlah_pelanggan,
     c.nilai_kepuasan
    FROM tb_tiket_bus A
    INNER JOIN tb_bus B ON A.id_bus = B.id_bus
    INNER JOIN tb_penilaian_kepuasan C ON A.id_tiket_bus = C.id_tiket_bus
    WHERE B.id_bus LIKE '%".$id_bus."%'
    AND DATE(A.tgl_keberangkatan) BETWEEN '".$this->input->post('start_date')."' AND '".$this->input->post('end_date')."'")->result();

    echo json_encode($data);
  }

  public function getPenjualan(){
    $data['data'] = $this->db->query("
      select A.id_penjualan_tiket, A.id_tiket_bus, B.tujuan, B.tgl_keberangkatan,  
      C.nm_pelanggan, A.tgl_pembelian, B.harga, A.jumlah_pembelian, (B.harga * A.jumlah_pembelian) nominal,
      A.jenis_penjualan_tiket 
      from tb_penjualan_tiket A
      inner join tb_tiket_bus B on A.id_tiket_bus = B.id_tiket_bus 
      inner join tb_pelanggan C on A.id_pelanggan = C.id_pelanggan
      WHERE
      a.tgl_pembelian  >= '".$this->input->post('start_date')."'
      AND a.tgl_pembelian  < DATE(DATE_ADD('".$this->input->post('end_date')."', INTERVAL 1 DAY))
      order by A.tgl_keberangkatan, A.tgl_pembelian
    ")->result_array();

    echo json_encode($data);
  }

  public function cetakTiket(){
    $this->load->library('ciqrcode');

    $id_tiket = $this->input->post('id_tiket');

    $config['cacheable']    = true; //boolean, the default is true
    $config['cachedir']     = 'assets/'; //string, the default is application/cache/
    $config['errorlog']     = 'assets/'; //string, the default is application/logs/
    $config['imagedir']     = 'assets/images/qrcode/'; //direktori penyimpanan qr code
    $config['quality']      = true; //boolean, the default is true
    $config['size']         = '1024'; //interger, the default is 1024
    $config['black']        = array(224,255,255); // array, default is array(255,255,255)
    $config['white']        = array(70,130,180); // array, default is array(0,0,0)
    $this->ciqrcode->initialize($config);

    $image_name = $id_tiket.'.png'; //buat name dari qr code sesuai dengan nim

    $params['data'] = $id_tiket; //data yang akan di jadikan QR CODE
    $params['level'] = 'H'; //H=High
    $params['size'] = 10;
    $params['savename'] = FCPATH.$config['imagedir'].$image_name; //simpan image QR CODE ke folder assets/images/
    $this->ciqrcode->generate($params); // fungsi untuk generate QR CODE

    $data['data'] = $this->db->query("SELECT A.id_penjualan_tiket, A.nm_pelanggan, A.tgl_keberangkatan,  
    A.jumlah_pembelian, B.tgl_bayar, B.status_validasi, B.nominal,
    (
      SELECT GROUP_CONCAT(kursi SEPARATOR ', ') as kursi FROM tb_dtl_penjualan WHERE id_penjualan_tiket=A.id_penjualan_tiket
      GROUP BY id_penjualan_tiket
    ) kursi
    FROM `tb_penjualan_tiket` A
    LEFT JOIN tb_pembayaran_tiket B ON A.id_penjualan_tiket = B.id_penjualan_tiket
    WHERE A.id_penjualan_tiket='".$this->input->post('id_tiket')."'")->result_array();

    $data['data'][0]['qrcode'] = $image_name;

    // echo "<pre>";
    // print_r($data);
    // echo "</pre>";

    $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => [70, 120], 'margin_left' => '1', 'margin_right' => '1']);
    $html = $this->load->view('print/ctkTiket',$data, true);
    $mpdf->WriteHTML($html);
    $mpdf->Output();
  }

  public function ctkPelanggan(){
    $data['data'] = $this->db->query("SELECT * FROM tb_pelanggan ORDER BY nm_pelanggan")->result_array();

    $mpdf = new \Mpdf\Mpdf(['format' => 'A4-L', 'margin_left' => '5', 'margin_right' => '5']);
    $mpdf->setFooter('{PAGENO}');
    $html = $this->load->view('print/ctkPelanggan',$data, true);
    $mpdf->WriteHTML($html);
    $mpdf->Output();
  }

  public function ctkPemesanan(){
    $data['data'] = $this->db->query("
      select A.id_penjualan_tiket, A.id_tiket_bus, B.tujuan, B.tgl_keberangkatan,  
      C.nm_pelanggan, A.tgl_pembelian, B.harga, A.jumlah_pembelian, (B.harga * A.jumlah_pembelian) nominal,
      A.jenis_penjualan_tiket 
      from tb_penjualan_tiket A
      inner join tb_tiket_bus B on A.id_tiket_bus = B.id_tiket_bus 
      inner join tb_pelanggan C on A.id_pelanggan = C.id_pelanggan
      WHERE
      a.tgl_pembelian  >= '".$this->input->post('start_date')."'
      AND a.tgl_pembelian  <= DATE(DATE_ADD('".$this->input->post('end_date')."', INTERVAL 1 DAY))
      order by A.tgl_keberangkatan, A.tgl_pembelian
    ")->result_array();

    $data['period_start'] = $this->input->post('start_date');
    $data['period_end'] = $this->input->post('end_date');

    $mpdf = new \Mpdf\Mpdf(['format' => 'A4-L', 'margin_left' => '5', 'margin_right' => '5']);
    $mpdf->setFooter('{PAGENO}');
    $html = $this->load->view('print/ctkPemesanan',$data, true);
    $mpdf->WriteHTML($html);
    $mpdf->Output();
  }

  public function ctkKepuasanPeriod(){
    if ($this->input->post('id_bus') == "ALL") {
      $id_bus = '';
    }else{
      $id_bus = $this->input->post('id_bus');
    }
    
    $data['data'] = $this->db->query("SELECT B.no_pol, B.id_kategori, DATE(A.tgl_keberangkatan) tgl_keberangkatan, A.kota_keberangkatan, A.tujuan, 
    (select sum(jumlah_pembelian)  from tb_penjualan_tiket where id_tiket_bus = A.id_tiket_bus) jumlah_pelanggan,
     c.nilai_kepuasan
    FROM tb_tiket_bus A
    INNER JOIN tb_bus B ON A.id_bus = B.id_bus
    INNER JOIN tb_penilaian_kepuasan C ON A.id_tiket_bus = C.id_tiket_bus
    WHERE B.id_bus LIKE '%".$id_bus."%'
    AND DATE(A.tgl_keberangkatan) BETWEEN '".$this->input->post('start_date')."' AND '".$this->input->post('end_date')."'")->result_array();

    $mpdf = new \Mpdf\Mpdf(['format' => 'A4-L', 'margin_left' => '5', 'margin_right' => '5']);
    $mpdf->setFooter('{PAGENO}');
    $html = $this->load->view('print/ctkKepuasanPeriod',$data, true);
    $mpdf->WriteHTML($html);
    $mpdf->Output();
  }

}