<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengeluaran extends CI_Controller {

  public function __construct(){
    parent::__construct();

    if(!$this->session->userdata('id_user'))
      redirect('login', 'refresh');
  }

  public function index(){
    $this->load->view('template/header');
    $this->load->view('template/sidebar');
    $this->load->view('pages/pengeluaran');
    $this->load->view('template/footer');
  }

  public function getAllData(){
  	$dataList = $this->db->get('tb_pengeluaran')->result();
    $no = 0;
    $data['data'] = [];
    foreach ($dataList as $list) {
      $row = array();
      $data['data'][$no]['id_pengeluaran'] = $list->id_pengeluaran;
      $data['data'][$no]['keperluan'] = $list->keperluan;
      $data['data'][$no]['tipe_pengeluaran'] = $list->tipe_pengeluaran;
      $data['data'][$no]['nominal_keluar'] = number_format($list->nominal_keluar,0,',','.');
      $data['data'][$no]['tgl_input'] = date('d-M-Y', strtotime($list->tgl_input));
      $no++;
    }

  	echo json_encode($data);
  }

  public function saveData(){

    $this->load->library('form_validation');
    $this->form_validation->set_rules('tgl_input', 'Tanggal', 'required');
    $this->form_validation->set_rules('tipe_pengeluaran', 'Tipe Pengeluaran', 'required');
    $this->form_validation->set_rules('nominal_keluar', 'Nominal Keluar', 'required|numeric');
    $this->form_validation->set_rules('keperluan', 'keperluan', 'required');

    if($this->form_validation->run() == FALSE){
      // echo validation_errors();
      $output = array("status" => "error", "message" => validation_errors());
      echo json_encode($output);
      return false;
    }
      // Insert table Pengeluaran
      $unik = 'K'.date('dmY');
      $kode = $this->db->query("select MAX(id_pengeluaran) LAST_NO from tb_pengeluaran
                                WHERE id_pengeluaran LIKE '".$unik."%'")->row()->LAST_NO;
      
      $urutan = (int) substr($kode, 9, 4);
      $urutan++;
      $huruf = $unik;
      $kode = $huruf . sprintf("%04s", $urutan);

      $dataPengeluaran = array(
        "id_pengeluaran" => $kode,
        "tgl_input" => date("Y-m-d", strtotime($this->input->post('tgl_input'))).' '.date("H:i:s"),
        "tipe_pengeluaran" => "non pembelian",
        "nominal_keluar" => $this->input->post('nominal_keluar'),
        "keperluan" => $this->input->post('keperluan'),
      );
      $this->db->insert('tb_pengeluaran', $dataPengeluaran);
      // Insert table Pengeluaran

      // Insert table jurnal keuangan
      $unik = 'U'.date('dmY');
      $kodeUang = $this->db->query("select MAX(id_jurnal_uang) LAST_NO from tb_jurnal_keuangan 
                                WHERE id_jurnal_uang LIKE '".$unik."%'")->row()->LAST_NO;
      
      $urutan = (int) substr($kodeUang, 9, 4);
      $urutan++;
      $huruf = $unik;
      $kodeUang = $huruf . sprintf("%04s", $urutan);

      
      $dataKeuangan = array(
        "id_jurnal_uang" => $kodeUang,
        "tgl_input" => date("Y-m-d", strtotime($this->input->post('tgl_input'))).' '.date("H:i:s"),
        "id_relasi" => $kode,
        "keluar" => $this->input->post('nominal_keluar'),
      );
      $this->db->insert('tb_jurnal_keuangan', $dataKeuangan);
      // Insert table jurnal keuangan

      $output = array("status" => "success", "message" => "Data Berhasil di Simpan");
      echo json_encode($output);

  }

  public function updateData(){
    $this->load->library('form_validation');
    $this->form_validation->set_rules('id_pengeluaran', 'id Pengeluaran', 'required');
    $this->form_validation->set_rules('tgl_input', 'Tanggal', 'required');
    $this->form_validation->set_rules('tipe_pengeluaran', 'Tipe Pengeluaran', 'required');
    $this->form_validation->set_rules('nominal_keluar', 'Nominal Keluar', 'required|numeric');
    $this->form_validation->set_rules('keperluan', 'keperluan', 'required');

    if($this->form_validation->run() == FALSE){
      // echo validation_errors();
      $output = array("status" => "error", "message" => validation_errors());
      echo json_encode($output);
      return false;
    }
      // Update table Pengeluaran

      $dataPengeluaran = array(
        "tgl_input" => date("Y-m-d", strtotime($this->input->post('tgl_input'))).' '.date("H:i:s"),
        "tipe_pengeluaran" => "non pembelian",
        "nominal_keluar" => $this->input->post('nominal_keluar'),
        "keperluan" => $this->input->post('keperluan'),
      );
      
      $this->db->where('id_pengeluaran', $this->input->post('id_pengeluaran'));
      $this->db->update('tb_pengeluaran', $dataPengeluaran);
      // Update table Pengeluaran

      // Update table jurnal keuangan
      
      $dataKeuangan = array(
        "tgl_input" => date("Y-m-d", strtotime($this->input->post('tgl_input'))).' '.date("H:i:s"),
        "keluar" => $this->input->post('nominal_keluar'),
      );
      
      $this->db->where('id_relasi', $this->input->post('id_pengeluaran'));
      $this->db->update('tb_jurnal_keuangan', $dataKeuangan);
      // Update table jurnal keuangan

      $output = array("status" => "success", "message" => "Data Berhasil di Update");
      echo json_encode($output);
  }

  public function deleteData(){
    $this->db->where('id_relasi', $this->input->post('id_pengeluaran'));
    $this->db->delete('tb_jurnal_keuangan');

    $this->db->where('id_pengeluaran', $this->input->post('id_pengeluaran'));
    $this->db->delete('tb_pengeluaran');

    $output = array("status" => "success", "message" => "Data Berhasil di Hapus");
    echo json_encode($output);
  }

}

?>