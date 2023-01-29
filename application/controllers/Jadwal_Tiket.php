<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jadwal_Tiket extends CI_Controller {

  public function __construct(){
    parent::__construct();

    // if(!$this->session->userdata('id_user'))
    //   redirect('login', 'refresh');
  }

  public function index(){
    $this->load->view('template/header');
    $this->load->view('template/sidebar');
    $this->load->view('pages/jadwal_tiket');
    $this->load->view('template/footer');
  }

  public function getAllData(){
        
    // $data['data'] = $this->db->query("")->result(); 

  	// echo json_encode($data);

    $dataList = $this->db->query('SELECT C.id_tiket_bus, A.nm_jenis_bus, B.id_bus, B.no_pol, C.lokasi_kumpul, 
    C.tujuan, C.tgl_keberangkatan, c.jumlah_max, C.harga, C.tipe_tiket
    FROM tb_jenis_bus A
    INNER JOIN tb_bus B ON A.id_jenis_bus = B.id_jenis_bus
    INNER JOIN tb_tiket_bus C ON C.id_bus = B.id_bus')->result();
    $no = 0;
    $data['data'] = [];
    foreach ($dataList as $list) {
      $row = array();
      $data['data'][$no]['id_tiket_bus'] = $list->id_tiket_bus;
      $data['data'][$no]['nm_jenis_bus'] = $list->nm_jenis_bus;
      $data['data'][$no]['id_bus'] = $list->id_bus;
      $data['data'][$no]['no_pol'] = $list->no_pol;
      $data['data'][$no]['lokasi_kumpul'] = $list->lokasi_kumpul;
      $data['data'][$no]['tujuan'] = $list->tujuan;
      $data['data'][$no]['jumlah_max'] = $list->jumlah_max;
      $data['data'][$no]['tgl_keberangkatan'] = date('d-M-Y H:i', strtotime($list->tgl_keberangkatan));
      $data['data'][$no]['harga'] = number_format($list->harga,0,',','.');
      $data['data'][$no]['tipe_tiket'] = $list->tipe_tiket;
      $no++;
    }

  	echo json_encode($data);
  }

  public function getIdBus(){
    $data['data'] = $this->db->query("SELECT id_bus, no_pol, jumlah_kursi from tb_bus WHERE id_jenis_bus = '".$this->input->post('id_jenis_bus')."'")->result(); 

  	echo json_encode($data);
  }

  public function getKursiBus(){
    $data['data'] = $this->db->query("SELECT id_bus, no_pol, jumlah_kursi from tb_bus WHERE id_bus = '".$this->input->post('id_bus')."'")->result(); 

  	echo json_encode($data);
  }

  public function generateId(){
    $unik = date('Ym');
    $kode = $this->db->query("SELECT MAX(id_tiket_bus) LAST_NO FROM tb_tiket_bus WHERE id_tiket_bus LIKE '".$unik."%'")->row()->LAST_NO;
    // mengambil angka dari kode barang terbesar, menggunakan fungsi substr
    // dan diubah ke integer dengan (int)
    $urutan = (int) substr($kode, 6, 5);
    
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
    $this->form_validation->set_rules('id_bus', 'Pilih Bus', 'required');
    $this->form_validation->set_rules('lokasi_kumpul', 'Titik Kumpul', 'required');
    $this->form_validation->set_rules('tujuan', 'tujuan', 'required');
    $this->form_validation->set_rules('tgl_keberangkatan', 'Waktu Keberangkatan', 'required');
    $this->form_validation->set_rules('jumlah_max', 'Maximal Penumpang', 'required');
    $this->form_validation->set_rules('harga', 'Harga Tiket', 'required');
    $this->form_validation->set_rules('tipe_tiket', 'Tipe Tiket', 'required');


    if($this->form_validation->run() == FALSE){
      // echo validation_errors();
      $output = array("status" => "error", "message" => validation_errors());
      echo json_encode($output);
      return false;
    }

    $id = $this->generateId();
    
    $data = array(
              "id_tiket_bus" => $id,
              "id_bus" => $this->input->post('id_bus'),
              "lokasi_kumpul" => $this->input->post('lokasi_kumpul'),
              "tujuan" => $this->input->post('tujuan'),
              "tgl_keberangkatan" => $this->input->post('tgl_keberangkatan'),
              "jumlah_max" => $this->input->post('jumlah_max'),
              "harga" => $this->input->post('harga'),
              "tipe_tiket" => $this->input->post('tipe_tiket'),
            );


    $this->db->insert('tb_tiket_bus', $data);
    $output = array("status" => "success", "message" => "Data Berhasil Disimpan, ID: ".$id);
    echo json_encode($output);

  }

  public function updateData(){
    
    
    // $this->load->library('form_validation');
    // $this->form_validation->set_rules('id_jenis_bus', 'ID Jenis', 'required');
    // $this->form_validation->set_rules('nm_jenis_bus', 'Jenis Bus', 'required');

    // if($this->form_validation->run() == FALSE){
    //   // echo validation_errors();
    //   $output = array("status" => "error", "message" => validation_errors());
    //   echo json_encode($output);
    //   return false;
    // }

    // $data = array(
    //   "nm_jenis_bus" => $this->input->post('nm_jenis_bus'),
    // );


    // $this->db->where('id_jenis_bus', $this->input->post('id_jenis_bus'));
    // $this->db->update('tb_jenis_bus', $data);
    // if($this->db->error()['message'] != ""){
    //   $output = array("status" => "error", "message" => $this->db->error()['message']);
    //   echo json_encode($output);
    //   return false;
    // }
    // $output = array("status" => "success", "message" => "Data Berhasil di Update");
    // echo json_encode($output);

  }

  public function deleteData(){

    $this->db->where('id_tiket_bus', $this->input->post('id_tiket_bus'));
    $this->db->delete('tb_tiket_bus');

    $output = array("status" => "success", "message" => "Data Berhasil di Hapus");
    echo json_encode($output);
  }

}