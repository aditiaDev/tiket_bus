<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pembayaran extends CI_Controller {

  public function __construct(){
    parent::__construct();

    // if(!$this->session->userdata('id_user'))
    //   redirect('login', 'refresh');
  }

  public function index(){
    $this->load->view('template/header');
    $this->load->view('template/sidebar');
    $this->load->view('pages/pembayaran');
    $this->load->view('template/footer');
  }

  public function getAllData(){   
    $data['data'] = $this->db->query("SELECT B.id_pembayaran, B.tgl_bayar, A.id_penjualan_tiket, A.jumlah_pembelian, C.harga, 
    B.nominal, B.bukti_pembayaran, B.status_validasi
    FROM tb_penjualan_tiket A
    INNER JOIN tb_pembayaran_tiket B ON A.id_penjualan_tiket = B.id_penjualan_tiket
    INNER JOIN tb_tiket_bus C ON A.id_tiket_bus = C.id_tiket_bus
    ORDER BY B.tgl_bayar Desc")->result(); 

  	echo json_encode($data);
  }

  public function getPenjualan(){
    $data['data'] = $this->db->query("
      SELECT id_penjualan_tiket, nm_pelanggan FROM `tb_penjualan_tiket`
      WHERE id_penjualan_tiket NOT IN(
        SELECT id_penjualan_tiket FROM tb_pembayaran_tiket
      )
      ORDER BY id_penjualan_tiket
    ")->result(); 

  	echo json_encode($data);
  }

  public function getPenjualanById(){
    $data['data'] = $this->db->query("
      SELECT id_penjualan_tiket, nm_pelanggan FROM `tb_penjualan_tiket`
      WHERE id_penjualan_tiket IN(
        SELECT id_penjualan_tiket FROM tb_pembayaran_tiket WHERE id_pembayaran='".$this->input->post('id_pembayaran')."'
      )
      ORDER BY id_penjualan_tiket
    ")->result(); 

  	echo json_encode($data);
  }

  public function getDtlPenjualan(){
    $data['data'] = $this->db->query("
      SELECT A.jumlah_pembelian, (A.jumlah_pembelian * B.harga) as nominal FROM tb_penjualan_tiket A
      INNER JOIN tb_tiket_bus B ON A.id_tiket_bus=B.id_tiket_bus
      WHERE id_penjualan_tiket='".$this->input->post('id_penjualan_tiket')."'
    ")->result(); 

  	echo json_encode($data);
  }

  private function _do_upload(){
		$config['upload_path']          = 'assets/images/bukti/';
    $config['allowed_types']        = 'gif|jpg|jpeg|png';
    $config['max_size']             = 5000; //set max size allowed in Kilobyte
    $config['max_width']            = 4000; // set max width image allowed
    $config['max_height']           = 4000; // set max height allowed
    $config['file_name']            = round(microtime(true) * 1000); //just milisecond timestamp fot unique name

    $this->load->library('upload', $config);

    if(!$this->upload->do_upload('bukti_pembayaran')) //upload and validate
    {
      $data['inputerror'] = 'bukti_pembayaran';
			$data['message'] = 'Upload error: '.$this->upload->display_errors('',''); //show ajax error
			$data['status'] = FALSE;
			echo json_encode($data);
			exit();
		}
		return $this->upload->data('file_name');
	}

  public function generateId(){
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
    $this->form_validation->set_rules('id_penjualan_tiket', 'ID Penjualan tiket', 'required|is_unique[tb_pembayaran_tiket.id_penjualan_tiket]');
    $this->form_validation->set_rules('nominal', 'Nominal Bayar', 'required');

    if($this->form_validation->run() == FALSE){
      // echo validation_errors();
      $output = array("status" => "error", "message" => validation_errors());
      echo json_encode($output);
      return false;
    }

    $id = $this->generateId();
      
    $data = array(
              "id_pembayaran" => $id,
              "id_penjualan_tiket" => $this->input->post('id_penjualan_tiket'),
              "nominal" => $this->input->post('nominal'),
              "status_validasi" => "TERVALIDASI",
              "tgl_bayar" => date('Y-m-d H:i:s'),
            );
    

    if(!empty($_FILES['bukti_pembayaran']['name'])){
      $upload = $this->_do_upload();
      $data['bukti_pembayaran'] = $upload;
    }

    $this->db->insert('tb_pembayaran_tiket', $data);
    $output = array("status" => "success", "message" => "Data Berhasil Disimpan, ID: ".$id);
    echo json_encode($output);

  }

  public function saveDataFront(){
    
    
    $this->load->library('form_validation');
    $this->form_validation->set_rules('id_penjualan_tiket', 'ID Penjualan tiket', 'required|is_unique[tb_pembayaran_tiket.id_penjualan_tiket]');
    $this->form_validation->set_rules('nominal', 'Nominal Bayar', 'required');

    if($this->form_validation->run() == FALSE){
      // echo validation_errors();
      $output = array("status" => "error", "message" => validation_errors());
      echo json_encode($output);
      return false;
    }

    $id = $this->generateId();
      
    $data = array(
              "id_pembayaran" => $id,
              "id_penjualan_tiket" => $this->input->post('id_penjualan_tiket'),
              "nominal" => $this->input->post('nominal'),
              "status_validasi" => "TERUPLOAD",
              "tgl_bayar" => date('Y-m-d H:i:s'),
            );
    

    if(!empty($_FILES['bukti_pembayaran']['name'])){
      $upload = $this->_do_upload();
      $data['bukti_pembayaran'] = $upload;
    }

    $this->db->insert('tb_pembayaran_tiket', $data);
    $output = array("status" => "success", "message" => "Data Berhasil Disimpan, ID: ".$id);
    echo json_encode($output);

  }

  public function updateData($id_pembayaran){
    
    
    $this->load->library('form_validation');
    $this->form_validation->set_rules('id_penjualan_tiket', 'ID Penjualan tiket', 'required');
    $this->form_validation->set_rules('nominal', 'Nominal Bayar', 'required');

    if($this->form_validation->run() == FALSE){
      // echo validation_errors();
      $output = array("status" => "error", "message" => validation_errors());
      echo json_encode($output);
      return false;
    }

    $data = array(
      "id_penjualan_tiket" => $this->input->post('id_penjualan_tiket'),
      "nominal" => $this->input->post('nominal'),
      "status_validasi" => $this->input->post('status_validasi'),
      "tgl_bayar" => date('Y-m-d H:i:s'),
    );

    if(!empty($_FILES['bukti_pembayaran']['name'])){
      $this->db->select('bukti_pembayaran');
      $this->db->from('tb_pembayaran_tiket');
      $this->db->where('id_pembayaran', $id_pembayaran);
      $files = $this->db->get()->row();

      if($files->bukti_pembayaran){
        if(file_exists('assets/images/bukti/'.$files->foto) && $files->foto)
          unlink('assets/images/bukti/'.$files->foto);
      }
			$upload = $this->_do_upload();
			$data['bukti_pembayaran'] = $upload;
		}


    $this->db->where('id_pembayaran', $id_pembayaran);
    $this->db->update('tb_pembayaran_tiket', $data);
    if($this->db->error()['message'] != ""){
      $output = array("status" => "error", "message" => $this->db->error()['message']);
      echo json_encode($output);
      return false;
    }
    $output = array("status" => "success", "message" => "Data Berhasil di Update");
    echo json_encode($output);

  }

  public function deleteData(){

    $this->db->where('id_pembayaran', $this->input->post('id_pembayaran'));
    $this->db->delete('tb_pembayaran_tiket');

    $output = array("status" => "success", "message" => "Data Berhasil di Hapus");
    echo json_encode($output);
  }

  public function verifyData(){
    $id_pembayaran = $this->input->post('id_pembayaran');

    $data = array(
      "status_validasi" => "TERVALIDASI",
      "tgl_bayar" => date('Y-m-d H:i:s'),
    );

    $this->db->where('id_pembayaran', $id_pembayaran);
    $this->db->update('tb_pembayaran_tiket', $data);
    if($this->db->error()['message'] != ""){
      $output = array("status" => "error", "message" => $this->db->error()['message']);
      echo json_encode($output);
      return false;
    }
    $output = array("status" => "success", "message" => "Data Berhasil di Verifikasi");
    echo json_encode($output);
  }

}