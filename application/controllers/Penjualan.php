<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penjualan extends CI_Controller {

  public function __construct(){
    parent::__construct();

    // if(!$this->session->userdata('id_user'))
    //   redirect('login', 'refresh');
  }

  public function index(){
    $this->load->view('template/header');
    $this->load->view('template/sidebar');
    $this->load->view('pages/penjualan');
    $this->load->view('template/footer');
  }

  public function getAllData(){
      
    $dataList['data'] = $this->db->query("SELECT A.id_penjualan_tiket, A.tgl_pembelian, A.id_tiket_bus, B.tujuan, A.tgl_keberangkatan,
    A.jumlah_pembelian, A.jenis_penjualan_tiket, C.no_pol
    FROM tb_penjualan_tiket A
    INNER JOIN tb_tiket_bus B ON A.id_tiket_bus=B.id_tiket_bus
    INNER JOIN tb_bus C ON B.id_bus=C.id_bus
    ORDER BY tgl_pembelian DESC")->result(); 

    // $no = 0;
    // $data['data'] = [];
    // foreach ($dataList as $list) {
    //   $row = array();
    //   $data['data'][$no]['id_penjualan_tiket'] = $list->id_penjualan_tiket;
    //   $data['data'][$no]['tgl_pembelian'] = date('d-M-Y H:i', strtotime($list->tgl_pembelian));
    //   $data['data'][$no]['id_tiket_bus'] = $list->id_tiket_bus;
    //   $data['data'][$no]['tujuan'] = $list->tujuan;
    //   $data['data'][$no]['tgl_keberangkatan'] = date('d-M-Y H:i', strtotime($list->tgl_keberangkatan));
    //   $data['data'][$no]['jumlah_pembelian'] = $list->jumlah_pembelian;
    //   $data['data'][$no]['jenis_penjualan_tiket'] = $list->jenis_penjualan_tiket;
    //   $data['data'][$no]['no_pol'] = $list->no_pol;

    //   $no++;
    // }

  	echo json_encode($dataList);
  }

  public function addData(){
    $this->load->view('template/header');
    $this->load->view('template/sidebar');
    $this->load->view('pages/tambah_pembelian');
    $this->load->view('template/footer'); 
  }

  public function dtlData(){
    $this->load->view('template/header');
    $this->load->view('template/sidebar');
    $this->load->view('pages/detail_penjualan');
    $this->load->view('template/footer'); 
  }

  public function getTujuanBus(){
    $data['data'] = $this->db->query("SELECT DISTINCT tujuan from tb_tiket_bus 
    WHERE DATE(tgl_keberangkatan) = '".$this->input->post('tgl_berangkat')."'")->result(); 

  	echo json_encode($data);
  }

  public function getJenisBus(){
    $data['data'] = $this->db->query("
    select * from tb_jenis_bus tjb where id_jenis_bus in(
      select id_jenis_bus from tb_bus tb where id_bus IN(
        select id_bus from tb_tiket_bus where upper(tujuan) = upper('".$this->input->post('tujuan')."') AND DATE(tgl_keberangkatan) = '".$this->input->post('tgl_berangkat')."'
      )
    )
    ")->result(); 

  	echo json_encode($data);
  }

  public function getBus(){
    $data['data'] = $this->db->query("
      select A.id_tiket_bus, B.no_pol, DATE_FORMAT(A.tgl_keberangkatan, '%H:%i') as waktu_berangkat from tb_tiket_bus A
      inner join tb_bus B on A.id_bus = B.id_bus 
      inner join tb_jenis_bus C on B.id_jenis_bus = C.id_jenis_bus  
      where DATE(A.tgl_keberangkatan) = '".$this->input->post('tgl_berangkat')."'
      and upper(A.tujuan) = upper('".$this->input->post('tujuan')."')
      and C.id_jenis_bus = '".$this->input->post('id_jenis_bus')."'
      order by waktu_berangkat
    ")->result(); 

  	echo json_encode($data);
  }

  public function getPelanggan(){
    $data['data'] = $this->db->query("SELECT id_pelanggan, no_pelanggan, nm_pelanggan from tb_pelanggan ORDER BY id_pelanggan")->result(); 

  	echo json_encode($data);
  }

  public function getNamaPelanggan(){
    $data['data'] = $this->db->query("
      SELECT nm_pelanggan, no_pelanggan FROM `tb_pelanggan`
      WHERE id_pelanggan = '".$this->input->post('id_pelanggan')."'
    ")->result(); 

  	echo json_encode($data);
  }

  public function getHarga(){
    $data['data'] = $this->db->query("SELECT harga from tb_tiket_bus WHERE id_tiket_bus = '".$this->input->post('id_tiket_bus')."'")->result(); 

  	echo json_encode($data);
  }

  public function generateId(){
    $unik = "J".date('Ym');
    $kode = $this->db->query("SELECT MAX(id_penjualan_tiket) LAST_NO FROM tb_penjualan_tiket WHERE id_penjualan_tiket LIKE '".$unik."%'")->row()->LAST_NO;
    // mengambil angka dari kode barang terbesar, menggunakan fungsi substr
    // dan diubah ke integer dengan (int)
    $urutan = (int) substr($kode, 7, 5);
    
    // bilangan yang diambil ini ditambah 1 untuk menentukan nomor urut berikutnya
    $urutan++;
    
    // membentuk kode barang baru
    // perintah sprintf("%03s", $urutan); berguna untuk membuat string menjadi 3 karakter
    // misalnya perintah sprintf("%03s", 15); maka akan menghasilkan '015'
    // angka yang diambil tadi digabungkan dengan kode huruf yang kita inginkan, misalnya BRG 
    $huruf = $unik;
    $kode = $huruf . sprintf("%05s", $urutan);
    return $kode;
  }

  public function generatePembayaranId(){
    $unik = "B".date('Ym');
    $kode = $this->db->query("SELECT MAX(id_pembayaran) LAST_NO FROM tb_pembayaran_tiket WHERE id_pembayaran LIKE '".$unik."%'")->row()->LAST_NO;
    // mengambil angka dari kode barang terbesar, menggunakan fungsi substr
    // dan diubah ke integer dengan (int)
    $urutan = (int) substr($kode, 7, 5);
    
    // bilangan yang diambil ini ditambah 1 untuk menentukan nomor urut berikutnya
    $urutan++;
    
    // membentuk kode barang baru
    // perintah sprintf("%03s", $urutan); berguna untuk membuat string menjadi 3 karakter
    // misalnya perintah sprintf("%03s", 15); maka akan menghasilkan '015'
    // angka yang diambil tadi digabungkan dengan kode huruf yang kita inginkan, misalnya BRG 
    $huruf = $unik;
    $kode = $huruf . sprintf("%05s", $urutan);
    return $kode;
  }

  public function saveData(){
    
    
    $this->load->library('form_validation');
    $this->form_validation->set_rules('id_tiket_bus', 'Pilih Bus', 'required');
    $this->form_validation->set_rules('id_pelanggan', 'Pelanggan', 'required');
    $this->form_validation->set_rules('nm_pelanggan', 'Nama Pelanggan', 'required');
    $this->form_validation->set_rules('no_pelanggan', 'No Pelanggan', 'required');
    $this->form_validation->set_rules('jumlah_pembelian', 'Jumlah Pembelian', 'required');


    if($this->form_validation->run() == FALSE){
      // echo validation_errors();
      $output = array("status" => "error", "message" => validation_errors());
      echo json_encode($output);
      return false;
    }

    $id = $this->generateId();

    $TGL_BERANGKAT = $this->db->query("select tgl_keberangkatan as TGL_BERANGKAT from tb_tiket_bus 
    where id_tiket_bus = '".$this->input->post('id_tiket_bus')."'")->row()->TGL_BERANGKAT;
    
    $data = array(
              "id_penjualan_tiket" => $id,
              "id_tiket_bus" => $this->input->post('id_tiket_bus'),
              "id_pelanggan" => $this->input->post('id_pelanggan'),
              "nm_pelanggan" => $this->input->post('nm_pelanggan'),
              "no_pelanggan" => $this->input->post('no_pelanggan'),
              "tgl_pembelian" => date('Y-m-d H:i:s'),
              "tgl_keberangkatan" => $TGL_BERANGKAT,
              "jumlah_pembelian" => $this->input->post('jumlah_pembelian'),
              "jenis_penjualan_tiket" => 'OFFLINE',
              "status_tiket" => 'BELUM SCAN',
            );


    $this->db->insert('tb_penjualan_tiket', $data);

    if($this->input->post('bayar') == "true"){
      $id_pembayaran = $this->generatePembayaranId();
      
      $dataBayar = array(
                "id_pembayaran" => $id_pembayaran,
                "id_penjualan_tiket" => $id,
                "nominal" => $this->input->post('nominal'),
                "bukti_pembayaran" => "CASH",
                "status_validasi" => "TERVALIDASI",
                "tgl_bayar" => date('Y-m-d H:i:s'),
              );
      $this->db->insert('tb_pembayaran_tiket', $dataBayar);
    }

    $output = array("status" => "success", "message" => "Data Berhasil Disimpan, ID: ".$id);
    echo json_encode($output);

  }

  public function updateData(){
    
    
    $this->load->library('form_validation');
    $this->form_validation->set_rules('id_jenis_bus', 'ID Jenis', 'required');
    $this->form_validation->set_rules('nm_jenis_bus', 'Jenis Bus', 'required');

    if($this->form_validation->run() == FALSE){
      // echo validation_errors();
      $output = array("status" => "error", "message" => validation_errors());
      echo json_encode($output);
      return false;
    }

    $data = array(
      "nm_jenis_bus" => $this->input->post('nm_jenis_bus'),
    );


    $this->db->where('id_jenis_bus', $this->input->post('id_jenis_bus'));
    $this->db->update('tb_jenis_bus', $data);
    if($this->db->error()['message'] != ""){
      $output = array("status" => "error", "message" => $this->db->error()['message']);
      echo json_encode($output);
      return false;
    }
    $output = array("status" => "success", "message" => "Data Berhasil di Update");
    echo json_encode($output);

  }

  public function deleteData(){

    $this->db->where('id_penjualan_tiket', $this->input->post('id_penjualan_tiket'));
    $this->db->delete('tb_penjualan_tiket');

    $output = array("status" => "success", "message" => "Data Berhasil di Hapus");
    echo json_encode($output);
  }

  public function getTujuanBusAntarKota(){
    $data['data'] = $this->db->query("SELECT DISTINCT tujuan from tb_tiket_bus 
    WHERE DATE(tgl_keberangkatan) = '".$this->input->post('tgl_berangkat')."' 
    AND tipe_tiket='".$this->input->post('jenis_tiket')."'")->result(); 

  	echo json_encode($data);
  }

  public function saveDataFront(){
    
    
    $this->load->library('form_validation');
    $this->form_validation->set_rules('id_tiket_bus', 'Pilih Bus', 'required');

    $this->form_validation->set_rules('nm_pelanggan', 'Nama Pelanggan', 'required');
    $this->form_validation->set_rules('no_pelanggan', 'No Pelanggan', 'required');
    $this->form_validation->set_rules('jumlah_pembelian', 'Jumlah Pembelian', 'required');


    if($this->form_validation->run() == FALSE){
      // echo validation_errors();
      $output = array("status" => "error", "message" => validation_errors());
      echo json_encode($output);
      return false;
    }

    $id = $this->generateId();

    $TGL_BERANGKAT = $this->db->query("select tgl_keberangkatan as TGL_BERANGKAT from tb_tiket_bus 
    where id_tiket_bus = '".$this->input->post('id_tiket_bus')."'")->row()->TGL_BERANGKAT;

    $ID_PELANGGAN = $this->db->query("SELECT id_pelanggan as ID_PELANGGAN FROM `tb_pelanggan` 
    WHERE id_user = '".$this->session->userdata('id_user')."'")->row()->ID_PELANGGAN;
    
    $data = array(
              "id_penjualan_tiket" => $id,
              "id_tiket_bus" => $this->input->post('id_tiket_bus'),
              "id_pelanggan" => $ID_PELANGGAN,
              "nm_pelanggan" => $this->input->post('nm_pelanggan'),
              "no_pelanggan" => $this->input->post('no_pelanggan'),
              "tgl_pembelian" => date('Y-m-d H:i:s'),
              "tgl_keberangkatan" => $TGL_BERANGKAT,
              "jumlah_pembelian" => $this->input->post('jumlah_pembelian'),
              "jenis_penjualan_tiket" => 'ONLINE',
            );


    $this->db->insert('tb_penjualan_tiket', $data);

    $output = array("status" => "success", "message" => "Data Berhasil Disimpan, Nomor Ticket: ".$id);
    echo json_encode($output);

  }

  public function cekTicket(){
    $nominal = $this->db->query("SELECT (A.jumlah_pembelian * B.harga) as nominal FROM `tb_penjualan_tiket` A
    INNER JOIN tb_tiket_bus B ON A.id_tiket_bus = B.id_tiket_bus
    WHERE id_penjualan_tiket = '".$this->input->post('id_penjualan_tiket')."'")->result_array();

    // print_r($nominal);
    

    if(count($nominal) > 0){
      $output = array("status" => "success", "message" => $nominal[0]['nominal']);
    }else{
      $output = array("status" => "error", "message" => "Ticket tidak ditemukan");
    }

    echo json_encode($output);
  }

  public function cekPembayaran(){
    $data = $this->db->query("SELECT status_validasi from tb_pembayaran_tiket
    WHERE id_penjualan_tiket = '".$this->input->post('id_tiket')."'")->result_array();

    // print_r($nominal);
    

    if(count($data) > 0){
      if($data[0]['status_validasi'] == "TERUPLOAD"){
        $output = array("status" => "error", "message" => "Pembayaran Anda belum terverifikasi, silahkan hubungi Admin kami");
      }else{
        $output = array("status" => "success", "message" => "Data Oke");
      }
      
    }else{
      $output = array("status" => "error", "message" => "Anda belum mengunggah Bukti Pembayaran");
    }

    echo json_encode($output);
  }

}