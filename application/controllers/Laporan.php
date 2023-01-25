<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller {

  public function __construct(){
    parent::__construct();
    if(!$this->session->userdata('id_user'))
      redirect('login', 'refresh');
  }

  public function penjualan(){

    $this->load->view('template/header');
    $this->load->view('template/sidebar');
    $this->load->view('pages/laporan_penjualan');
    $this->load->view('template/footer');
  }

  public function cetakPenjualan(){
    $data['data'] = $this->db->query("SELECT a.id_penjualan, DATE_FORMAT(a.tgl_jual, '%d-%b-%Y') tgl_jual, a.no_nota, a.tot_penjualan, 
    b.id_barang, c.kategori_barang, c.nm_barang, b.harga, b.jumlah, (b.harga*b.jumlah) subtotal,
    c.harga_beli
    FROM tb_penjualan a, tb_det_penjualan b, tb_barang c
    WHERE a.id_penjualan=b.id_penjualan
    AND b.id_barang=c.id_barang
    AND a.tgl_jual  >= '".$this->input->post('start_date')."'
    AND a.tgl_jual  <= DATE(DATE_ADD('".$this->input->post('end_date')."', INTERVAL 1 DAY))
    ORDER BY a.tgl_jual")->result_array();

    $mpdf = new \Mpdf\Mpdf(['format' => 'A4-L', 'margin_left' => '5', 'margin_right' => '5']);
    $mpdf->setFooter('{PAGENO}');
    $html = $this->load->view('cetak/ctkPenjualan',$data, true);
    $mpdf->WriteHTML($html);
    $mpdf->Output();
  }

  public function pembelian(){

    $this->load->view('template/header');
    $this->load->view('template/sidebar');
    $this->load->view('pages/laporan_pembelian');
    $this->load->view('template/footer');
  }

  public function cetakPembelian(){
    $data['data'] = $this->db->query("SELECT a.id_pembelian, DATE_FORMAT(a.tgl_pembelian, '%d-%b-%Y') tgl_pembelian, a.tot_pembelian, 
    b.id_barang, c.kategori_barang, c.nm_barang, b.harga, b.qty_beli, (b.harga*b.qty_beli) subtotal 
    FROM tb_pembelian a, tb_det_pembelian b, tb_barang c
    WHERE a.id_pembelian=b.id_pembelian
    AND b.id_barang=c.id_barang
    AND a.tgl_pembelian  >= '".$this->input->post('start_date')."'
    AND a.tgl_pembelian  <= DATE(DATE_ADD('".$this->input->post('end_date')."', INTERVAL 1 DAY))
    ORDER BY a.tgl_pembelian")->result_array();

    $mpdf = new \Mpdf\Mpdf(['format' => 'A4-L', 'margin_left' => '5', 'margin_right' => '5']);
    $mpdf->setFooter('{PAGENO}');
    $html = $this->load->view('cetak/ctkPembelian',$data, true);
    $mpdf->WriteHTML($html);
    $mpdf->Output();
  }

  public function pengeluaran(){

    $this->load->view('template/header');
    $this->load->view('template/sidebar');
    $this->load->view('pages/laporan_pengeluaran');
    $this->load->view('template/footer');
  }

  public function cetakPengeluaran(){
    $data['data'] = $this->db->query("SELECT id_pengeluaran, DATE_FORMAT(tgl_input, '%d-%b-%Y') tgl_input, 
    tipe_pengeluaran, id_relasi, nominal_keluar, keperluan 
    FROM tb_pengeluaran
    WHERE tgl_input  >= '".$this->input->post('start_date')."'
    AND tgl_input  <= DATE(DATE_ADD('".$this->input->post('end_date')."', INTERVAL 1 DAY))
    ORDER BY tgl_input")->result_array();

    $mpdf = new \Mpdf\Mpdf(['format' => 'A4-L', 'margin_left' => '5', 'margin_right' => '5']);
    $mpdf->setFooter('{PAGENO}');
    $html = $this->load->view('cetak/ctkPengeluaran',$data, true);
    $mpdf->WriteHTML($html);
    $mpdf->Output();
  }

  public function pemasukan(){

    $this->load->view('template/header');
    $this->load->view('template/sidebar');
    $this->load->view('pages/laporan_pemasukan');
    $this->load->view('template/footer');
  }

  public function cetakPemasukan(){
    $data['data'] = $this->db->query("select a.id_pemasukan, a.id_relasi, a.tgl_input, a.tipe_pemasukan, a.nominal_masuk, 
    a.keterangan, b.nm_pelanggan 
    from tb_pemasukan a LEFT JOIN tb_pelanggan b ON a.id_pelanggan=b.id_pelanggan 
    where a.tgl_input  >= '".$this->input->post('start_date')."'
    AND a.tgl_input  <= DATE(DATE_ADD('".$this->input->post('end_date')."', INTERVAL 1 DAY))
    ORDER BY a.tgl_input")->result_array();

    $mpdf = new \Mpdf\Mpdf(['format' => 'A4-L', 'margin_left' => '5', 'margin_right' => '5']);
    $mpdf->setFooter('{PAGENO}');
    $html = $this->load->view('cetak/ctkPemasukan',$data, true);
    $mpdf->WriteHTML($html);
    $mpdf->Output();
  }

  public function keuangan(){

    $this->load->view('template/header');
    $this->load->view('template/sidebar');
    $this->load->view('pages/laporan_keuangan');
    $this->load->view('template/footer');
  }

  public function cetakKeuangan(){
    $data['data'] = $this->db->query("SELECT 
    id_jurnal_uang, A.tgl_input, A.id_relasi, CASE WHEN A.id_relasi LIKE 'K%' THEN -1 * keluar ELSE masuk END TRANSAKSI,
    CASE WHEN A.id_relasi LIKE 'K%' THEN B.tipe_pengeluaran ELSE C.tipe_pemasukan END TIPE_TRANSAKSI,
    CASE WHEN A.id_relasi LIKE 'K%' THEN B.keperluan ELSE C.keterangan END KETERANGAN
    FROM tb_jurnal_keuangan A left JOIN tb_pengeluaran B ON A.id_relasi=B.id_pengeluaran left JOIN tb_pemasukan C ON A.id_relasi=C.id_pemasukan
    WHERE A.tgl_input  >= '".$this->input->post('start_date')."'
    AND A.tgl_input  <= DATE(DATE_ADD('".$this->input->post('end_date')."', INTERVAL 1 DAY))
    ORDER BY tgl_input")->result_array();

    $mpdf = new \Mpdf\Mpdf(['format' => 'A4-L', 'margin_left' => '5', 'margin_right' => '5']);
    $mpdf->setFooter('{PAGENO}');
    $html = $this->load->view('cetak/ctkKeuangan',$data, true);
    $mpdf->WriteHTML($html);
    $mpdf->Output();
    // echo "<pre>";
    // print_r($data);
    // echo "</pre>";
  }

}