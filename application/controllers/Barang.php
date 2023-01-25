<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Barang extends CI_Controller {

  public function __construct(){
    parent::__construct();
    if(!$this->session->userdata('id_user'))
      redirect('login', 'refresh');
  }

  public function index(){
    $this->load->view('template/header');
    $this->load->view('template/sidebar');
    $this->load->view('pages/barang');
    $this->load->view('template/footer');
  }

  public function getAllData(){

    // 
    if ($this->input->post('jenis') <> "") {
      $dataList = $this->db->query("select * from tb_barang where jenis like '%".$this->input->post('jenis')."%'")->result();
    }else{
      $dataList = $this->db->get('tb_barang')->result();
    }
    

    $no = 0;
    $data['data'] = [];
    foreach ($dataList as $list) {
      $row = array();
      $data['data'][$no]['id_barang'] = $list->id_barang;
      $data['data'][$no]['kategori_barang'] = $list->kategori_barang;
      $data['data'][$no]['nm_barang'] = $list->nm_barang;
      $data['data'][$no]['jenis'] = $list->jenis;
      $data['data'][$no]['ket_barang'] = $list->ket_barang;
      $data['data'][$no]['harga_beli'] = number_format($list->harga_beli,0,',','.');
      $data['data'][$no]['harga_jual'] = number_format($list->harga_jual,0,',','.');
      $data['data'][$no]['stok'] = number_format($list->stok,0,',','.');
      $data['data'][$no]['foto'] = $list->foto;
      $no++;
    }
  	echo json_encode($data);
  } 

  public function generateIdBarang(){
    $unik = substr(strtoupper($this->input->post('kategori_barang')),0,3);
    $kodeBarang = $this->db->query("SELECT MAX(id_barang) LAST_NO FROM tb_barang WHERE id_barang LIKE '".$unik."%'")->row()->LAST_NO;
    // mengambil angka dari kode barang terbesar, menggunakan fungsi substr
    // dan diubah ke integer dengan (int)
    $urutan = (int) substr($kodeBarang, 3, 6);
    
    // bilangan yang diambil ini ditambah 1 untuk menentukan nomor urut berikutnya
    $urutan++;
    
    // membentuk kode barang baru
    // perintah sprintf("%03s", $urutan); berguna untuk membuat string menjadi 3 karakter
    // misalnya perintah sprintf("%03s", 15); maka akan menghasilkan '015'
    // angka yang diambil tadi digabungkan dengan kode huruf yang kita inginkan, misalnya BRG 
    $huruf = $unik;
    $kodeBarang = $huruf . sprintf("%06s", $urutan);
    echo $kodeBarang;
  }

  private function _do_upload(){
		$config['upload_path']          = 'assets/images/barang/';
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

  public function saveData(){
    
    
    $this->load->library('form_validation');
    $this->form_validation->set_rules('id_barang', 'Kode Barang', 'required|is_unique[tb_barang.id_barang]');
    $this->form_validation->set_rules('kategori_barang', 'Kategori Barang', 'required');
    $this->form_validation->set_rules('nm_barang', 'Nama Barang', 'required');
    $this->form_validation->set_rules('ket_barang', 'Keterangan Barang', 'required');
    $this->form_validation->set_rules('harga_beli', 'Harga Beli', 'required|numeric');
    $this->form_validation->set_rules('harga_jual', 'Harga Jual', 'required|numeric');
    $this->form_validation->set_rules('stok', 'Stok', 'required|numeric');

    if($this->form_validation->run() == FALSE){
      // echo validation_errors();
      $output = array("status" => "error", "message" => validation_errors());
      echo json_encode($output);
      return false;
    }
    
    $data = array(
              "id_barang" => $this->input->post('id_barang'),
              "kategori_barang" => $this->input->post('kategori_barang'),
              "nm_barang" => $this->input->post('nm_barang'),
              "ket_barang" => $this->input->post('ket_barang'),
              "harga_beli" => $this->input->post('harga_beli'),
              "harga_jual" => $this->input->post('harga_jual'),
              "stok" => $this->input->post('stok'),
              "jenis" => $this->input->post('jenis'),
            );

    if(!empty($_FILES['foto']['name'])){
      $upload = $this->_do_upload();
      $data['foto'] = $upload;
    }

    $this->db->insert('tb_barang', $data);
    $output = array("status" => "success", "message" => "Data Berhasil Disimpan");
    echo json_encode($output);

  }

  public function deleteData(){

    $this->db->select('foto');
    $this->db->from('tb_barang');
		$this->db->where('id_barang', $this->input->post('id_barang'));
		$files = $this->db->get()->row();

		if(file_exists('assets/images/barang/'.$files->foto) && $files->foto)
			unlink('assets/images/barang/'.$files->foto);

    $this->db->where('id_barang', $this->input->post('id_barang'));
    $this->db->delete('tb_barang');

    $output = array("status" => "success", "message" => "Data Berhasil di Hapus");
    echo json_encode($output);
  }

  public function updateData($id_barang){
    
    
    $this->load->library('form_validation');
    $this->form_validation->set_rules('id_barang', 'Kode Barang', 'required');
    $this->form_validation->set_rules('kategori_barang', 'Kategori Barang', 'required');
    $this->form_validation->set_rules('nm_barang', 'Nama Barang', 'required');
    $this->form_validation->set_rules('ket_barang', 'Keterangan Barang', 'required');
    $this->form_validation->set_rules('harga_beli', 'Harga Beli', 'required|numeric');
    $this->form_validation->set_rules('harga_jual', 'Harga Jual', 'required|numeric');
    $this->form_validation->set_rules('stok', 'Stok', 'required|numeric');

    if($this->form_validation->run() == FALSE){
      // echo validation_errors();
      $output = array("status" => "error", "message" => validation_errors());
      echo json_encode($output);
      return false;
    }

    $data = array(
      "id_barang" => $this->input->post('id_barang'),
      "kategori_barang" => $this->input->post('kategori_barang'),
      "nm_barang" => $this->input->post('nm_barang'),
      "ket_barang" => $this->input->post('ket_barang'),
      "harga_beli" => $this->input->post('harga_beli'),
      "harga_jual" => $this->input->post('harga_jual'),
      "stok" => $this->input->post('stok'),
      "jenis" => $this->input->post('jenis'),
    );

    if(!empty($_FILES['foto']['name'])){
      $this->db->select('foto');
      $this->db->from('tb_barang');
      $this->db->where('id_barang', $id_barang);
      $files = $this->db->get()->row();

      if($files->foto){
        if(file_exists('assets/images/barang/'.$files->foto) && $files->foto)
          unlink('assets/images/barang/'.$files->foto);
      }
			$upload = $this->_do_upload();
			$data['foto'] = $upload;
		}
    
    

    $this->db->where('id_barang', $id_barang);
    $this->db->update('tb_barang', $data);
    if($this->db->error()['message'] != ""){
      $output = array("status" => "error", "message" => $this->db->error()['message']);
      echo json_encode($output);
      return false;
    }
    $output = array("status" => "success", "message" => "Data Berhasil di Update");
    echo json_encode($output);

  }

  public function getById(){
    $id_barang = $this->input->post('id_barang');
    $this->db->select('*');
    $this->db->from('tb_barang');
    $this->db->where('id_barang', $id_barang);
    $dataList = $this->db->get()->result();

    $no = 0;
    $data = [];
    foreach ($dataList as $list) {
      $row = array();
      $data[$no]['id_barang'] = $list->id_barang;
      $data[$no]['kategori_barang'] = $list->kategori_barang;
      $data[$no]['nm_barang'] = $list->nm_barang;
      $data[$no]['ket_barang'] = $list->ket_barang;
      $data[$no]['harga_beli'] = number_format($list->harga_beli,0,',','.');
      $data[$no]['harga_jual'] = number_format($list->harga_jual,0,',','.');
      $data[$no]['stok'] = number_format($list->stok,0,',','.');
      $data[$no]['foto'] = $list->foto;
      $no++;
    }
  	echo json_encode($data);
  }

}