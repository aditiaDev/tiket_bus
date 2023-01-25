<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pemasukan extends CI_Controller {

  public function __construct(){
    parent::__construct();

    if(!$this->session->userdata('id_user'))
      redirect('login', 'refresh');
  }

  public function index(){
    $this->load->view('template/header');
    $this->load->view('template/sidebar');
    $this->load->view('pages/pemasukan');
    $this->load->view('template/footer');
  }

  public function getAllData(){
  	$dataList = $this->db->get('tb_pemasukan')->result();
    $no = 0;
    $data['data'] = [];
    foreach ($dataList as $list) {
      $row = array();
      $data['data'][$no]['id_pemasukan'] = $list->id_pemasukan;
      $data['data'][$no]['keterangan'] = $list->keterangan;
      $data['data'][$no]['tipe_pemasukan'] = $list->tipe_pemasukan;
      $data['data'][$no]['nominal_masuk'] = number_format($list->nominal_masuk,0,',','.');
      $data['data'][$no]['tgl_input'] = date('d-M-Y', strtotime($list->tgl_input));
      $no++;
    }

  	echo json_encode($data);
  }

  public function saveData(){

    $this->load->library('form_validation');
    $this->form_validation->set_rules('tgl_input', 'Tanggal', 'required');
    $this->form_validation->set_rules('tipe_pemasukan', 'Tipe Pemasukan', 'required');
    $this->form_validation->set_rules('nominal_masuk', 'Nominal Masuk', 'required|numeric');
    $this->form_validation->set_rules('keterangan', 'keterangan', 'required');

    if($this->form_validation->run() == FALSE){
      // echo validation_errors();
      $output = array("status" => "error", "message" => validation_errors());
      echo json_encode($output);
      return false;
    }
      // Insert table pemasukan
      $unik = 'M'.date('dmY');
      $kode = $this->db->query("select MAX(id_pemasukan) LAST_NO from tb_pemasukan
                                WHERE id_pemasukan LIKE '".$unik."%'")->row()->LAST_NO;
      
      $urutan = (int) substr($kode, 9, 4);
      $urutan++;
      $huruf = $unik;
      $kode = $huruf . sprintf("%04s", $urutan);

      $dataPemasukan = array(
        "id_pemasukan" => $kode,
        "tgl_input" => date("Y-m-d", strtotime($this->input->post('tgl_input'))).' '.date("H:i:s"),
        "tipe_pemasukan" => "non penjualan",
        "nominal_masuk" => $this->input->post('nominal_masuk'),
        "keterangan" => $this->input->post('keterangan'),
      );
      $this->db->insert('tb_pemasukan', $dataPemasukan);
      // Insert table pemasukan

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
        "masuk" => $this->input->post('nominal_masuk'),
      );
      $this->db->insert('tb_jurnal_keuangan', $dataKeuangan);
      // Insert table jurnal keuangan

      $output = array("status" => "success", "message" => "Data Berhasil di Simpan");
      echo json_encode($output);

  }

  public function updateData(){
    $this->load->library('form_validation');
    $this->form_validation->set_rules('id_pemasukan', 'id Pemasukan', 'required');
    $this->form_validation->set_rules('tgl_input', 'Tanggal', 'required');
    $this->form_validation->set_rules('tipe_pemasukan', 'Tipe Pemasukan', 'required');
    $this->form_validation->set_rules('nominal_masuk', 'Nominal Masuk', 'required|numeric');
    $this->form_validation->set_rules('keterangan', 'keterangan', 'required');

    if($this->form_validation->run() == FALSE){
      // echo validation_errors();
      $output = array("status" => "error", "message" => validation_errors());
      echo json_encode($output);
      return false;
    }
      // Update table pemasukan

      $dataPemasukan = array(
        "tgl_input" => date("Y-m-d", strtotime($this->input->post('tgl_input'))).' '.date("H:i:s"),
        "tipe_pemasukan" => "non penjualan",
        "nominal_masuk" => $this->input->post('nominal_masuk'),
        "keterangan" => $this->input->post('keterangan'),
      );
      
      $this->db->where('id_pemasukan', $this->input->post('id_pemasukan'));
      $this->db->update('tb_pemasukan', $dataPemasukan);
      // Update table pemasukan

      // Update table jurnal keuangan
      
      $dataKeuangan = array(
        "tgl_input" => date("Y-m-d", strtotime($this->input->post('tgl_input'))).' '.date("H:i:s"),
        "masuk" => $this->input->post('nominal_masuk'),
      );
      
      $this->db->where('id_relasi', $this->input->post('id_pemasukan'));
      $this->db->update('tb_jurnal_keuangan', $dataKeuangan);
      // Update table jurnal keuangan

      $output = array("status" => "success", "message" => "Data Berhasil di Update");
      echo json_encode($output);
  }

  public function deleteData(){
    $this->db->where('id_relasi', $this->input->post('id_pemasukan'));
    $this->db->delete('tb_jurnal_keuangan');

    $this->db->where('id_pemasukan', $this->input->post('id_pemasukan'));
    $this->db->delete('tb_pemasukan');

    $output = array("status" => "success", "message" => "Data Berhasil di Hapus");
    echo json_encode($output);
  }

}

?>