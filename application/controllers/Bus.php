<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bus extends CI_Controller {

  public function __construct(){
    parent::__construct();

    // if(!$this->session->userdata('id_user'))
    //   redirect('login', 'refresh');
  }

  public function index(){
    $this->load->view('template/header');
    $this->load->view('template/sidebar');
    $this->load->view('pages/bus');
    $this->load->view('template/footer');
  }

  public function getAllData(){
        
    $data['data'] = $this->db->query("SELECT b.id_bus, a.id_jenis_bus, a.nm_jenis_bus, b.no_pol, 
    b.jumlah_kursi, b.foto, b.deskripsi, b.id_kategori FROM tb_jenis_bus a
    inner JOIN tb_bus b ON a.id_jenis_bus = b.id_jenis_bus")->result(); 

  	echo json_encode($data);
  }

  public function getJenisBus(){
    $data['data'] = $this->db->query("SELECT * from tb_jenis_bus")->result(); 

  	echo json_encode($data);
  }

  public function getKategoriBus(){
    $data['data'] = $this->db->query("SELECT * from tb_kategori_bus ORDER BY nm_kategori")->result(); 

    echo json_encode($data);
  }

  private function _do_upload(){
		$config['upload_path']          = 'assets/images/';
    $config['allowed_types']        = 'gif|jpg|jpeg|png';
    $config['max_size']             = 5000; //set max size allowed in Kilobyte
    $config['max_width']            = 4000; // set max width image allowed
    $config['max_height']           = 4000; // set max height allowed
    $config['file_name']            = round(microtime(true) * 1000); //just milisecond timestamp fot unique name

    $this->load->library('upload', $config);

    if(!$this->upload->do_upload('foto')) //upload and validate
    {
      $data['inputerror'] = 'foto';
			$data['message'] = 'Upload error: '.$this->upload->display_errors('',''); //show ajax error
			$data['status'] = FALSE;
			echo json_encode($data);
			exit();
		}
		return $this->upload->data('file_name');
	}

  public function generateId(){
    $unik = 'BS';
    $kode = $this->db->query("SELECT MAX(id_bus) LAST_NO FROM tb_bus WHERE id_bus LIKE '".$unik."%'")->row()->LAST_NO;
    // mengambil angka dari kode barang terbesar, menggunakan fungsi substr
    // dan diubah ke integer dengan (int)
    $urutan = (int) substr($kode, 3, 6);
    
    // bilangan yang diambil ini ditambah 1 untuk menentukan nomor urut berikutnya
    $urutan++;
    
    // membentuk kode barang baru
    // perintah sprintf("%03s", $urutan); berguna untuk membuat string menjadi 3 karakter
    // misalnya perintah sprintf("%03s", 15); maka akan menghasilkan '015'
    // angka yang diambil tadi digabungkan dengan kode huruf yang kita inginkan, misalnya BRG 
    $huruf = $unik;
    $kode = $huruf . sprintf("%06s", $urutan);
    return $kode;
  }

  public function saveData(){
    
    
    $this->load->library('form_validation');
    $this->form_validation->set_rules('id_jenis_bus', 'Jenis Bus', 'required');
    $this->form_validation->set_rules('id_kategori', 'Kategori Bus', 'required');
    $this->form_validation->set_rules('no_pol', 'No. Polisi', 'required|is_unique[tb_bus.no_pol]');
    $this->form_validation->set_rules('jumlah_kursi', 'Jumlah Kursi', 'required');
    $this->form_validation->set_rules('deskripsi', 'Deskripsii', 'required');

    if($this->form_validation->run() == FALSE){
      // echo validation_errors();
      $output = array("status" => "error", "message" => validation_errors());
      echo json_encode($output);
      return false;
    }

    $id = $this->generateId();
    
    $data = array(
              "id_bus" => $id,
              "id_jenis_bus" => $this->input->post('id_jenis_bus'),
              "no_pol" => $this->input->post('no_pol'),
              "jumlah_kursi" => $this->input->post('jumlah_kursi'),
              "deskripsi" => $this->input->post('deskripsi'),
              "id_kategori" => $this->input->post('id_kategori'),
            );

    if(!empty($_FILES['foto']['name'])){
      $upload = $this->_do_upload();
      $data['foto'] = $upload;
    }


    $this->db->insert('tb_bus', $data);
    $output = array("status" => "success", "message" => "Data Berhasil Disimpan, ID: ".$id);
    echo json_encode($output);

  }

  public function updateData($id){
    
    
    $this->load->library('form_validation');
    $this->form_validation->set_rules('id_jenis_bus', 'Jenis Bus', 'required');
    $this->form_validation->set_rules('id_kategori', 'Kategori Bus', 'required');
    $this->form_validation->set_rules('no_pol', 'No. Polisi', 'required');
    $this->form_validation->set_rules('jumlah_kursi', 'Jumlah Kursi', 'required');
    $this->form_validation->set_rules('deskripsi', 'Deskripsii', 'required');

    if($this->form_validation->run() == FALSE){
      // echo validation_errors();
      $output = array("status" => "error", "message" => validation_errors());
      echo json_encode($output);
      return false;
    }

    $data = array(
      "id_jenis_bus" => $this->input->post('id_jenis_bus'),
      "no_pol" => $this->input->post('no_pol'),
      "jumlah_kursi" => $this->input->post('jumlah_kursi'),
      "deskripsi" => $this->input->post('deskripsi'),
      "id_kategori" => $this->input->post('id_kategori'),
    );

    if(!empty($_FILES['foto']['name'])){
      $upload = $this->_do_upload();
      $data['foto'] = $upload;
    }

    $this->db->where('id_bus', $id);
    $this->db->update('tb_bus', $data);
    if($this->db->error()['message'] != ""){
      $output = array("status" => "error", "message" => $this->db->error()['message']);
      echo json_encode($output);
      return false;
    }
    $output = array("status" => "success", "message" => "Data Berhasil di Update");
    echo json_encode($output);

  }

  public function deleteData(){

    $this->db->where('id_bus', $this->input->post('id_bus'));
    $this->db->delete('tb_bus');

    $output = array("status" => "success", "message" => "Data Berhasil di Hapus");
    echo json_encode($output);
  }

}