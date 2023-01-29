<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Front extends CI_Controller {

  public function __construct(){
    parent::__construct();

    // if(!$this->session->userdata('id_user'))
    //   redirect('login', 'refresh');
  }

  public function index(){
    
    $this->load->view('pelanggan/header');
    if($this->session->userdata('level') == "PELANGGAN"){
      $this->load->view('pelanggan/home1');
    }else{
      $this->load->view('pelanggan/home');
    }
    $this->load->view('pelanggan/footer');
  }

  public function feedback(){
    
    $this->load->view('pelanggan/header');
    $this->load->view('pelanggan/feedback');
    $this->load->view('pelanggan/footer');
  }

  public function login(){
    $this->load->view('login');
  }

  public function getParameter(){

    $dataIndikator = $this->db->query("
      SELECT id_indikator_kepuasan ,indikator_kepuasan, nilai FROM `tb_indikator_kepuasan` ORDER BY nilai DESC
    ")->result();

    $thIndikator="";
    
    foreach ($dataIndikator as $list) {
      $thIndikator .= "<th>".$list->indikator_kepuasan."</th>";
    }

    $dataParameter = $this->db->query("
      SELECT id_parameter, parameter FROM `tb_parameter` ORDER BY id_parameter
    ")->result(); 

    $no=1;
    $trIndikator="";$i=0;
    foreach ($dataParameter as $row) {
      $td = "";
      
      foreach ($dataIndikator as $list) {
        $td .= "<td><input type='radio' name='".$row->id_parameter."' value='".$list->id_indikator_kepuasan."' ></td>";
        
      }
      $i++;
      $trIndikator .= "<tr>
                          <td>".$no++."</td>
                          <td style='text-align:left;'>".$row->parameter."</td>
                          ".$td."
                      </tr>";
    }

    $html = "<thead>
              <th>No</th>
              <th>Pertanyaan</th>
              ".$thIndikator."
            </thead>
            <tbody>
              ".$trIndikator."
            </tbody>";
    echo $html;
  }

  public function generateId(){
    $unik = date('Ym');
    $kode = $this->db->query("SELECT MAX(id_item_penilaian) LAST_NO FROM tb_item_penilaian WHERE id_item_penilaian LIKE '".$unik."%'")->row()->LAST_NO;
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
    
    // print_r($this->input->post());

    foreach($this->input->post() as $key => $val)
    {
      // echo "<p>Key: ".$key. " Value:" . $val . "</p>\n";
      if($key != "id_penjualan_tiket" and $key != "saran"){
        $id = $this->generateId();
      
        $data = array(
                  "id_item_penilaian" => $id,
                  "id_penjualan_tiket" => $this->input->post('id_penjualan_tiket'),
                  "id_parameter" => $key,
                  "id_indikator" => $val,
                );


        $this->db->insert('tb_item_penilaian', $data);

      }
    }

    $data = array(
      "id_penjualan_tiket" => $this->input->post('id_penjualan_tiket'),
      "saran" => $this->input->post('saran'),
    );


    $this->db->insert('tb_saran', $data);
    
    $output = array("status" => "success", "message" => "Data Berhasil Disimpan, Terima Kasih telah meluangkan waktu ");
    echo json_encode($output);

  }

}