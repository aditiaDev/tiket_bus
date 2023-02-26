<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kepuasan extends CI_Controller {

  public function __construct(){
    parent::__construct();

    // if(!$this->session->userdata('id_user'))
    //   redirect('login', 'refresh');
  }

  public function index(){
    $this->load->view('template/header');
    $this->load->view('template/sidebar');
    $this->load->view('pages/kepuasan');
    $this->load->view('template/footer');
  }

  public function addKepuasan(){
    $this->load->view('template/header');
    $this->load->view('template/sidebar');
    $this->load->view('pages/addkepuasan');
    $this->load->view('template/footer');
  }

  public function getAllData(){
  	// $data['data'] = $this->db->get('tb_pelamar')->result();

    $this->db->select('*');
    $this->db->from('tb_penilaian_kepuasan'); 
    $this->db->order_by('id_penilaian','desc');         
    $data['data'] = $this->db->get()->result(); 

  	echo json_encode($data);
  }

  

  public function getTiket(){
    $data['data'] = $this->db->query("
      SELECT id_tiket_bus, tujuan, no_pol, DATE(A.tgl_keberangkatan) tgl_keberangkatan FROM `tb_tiket_bus` A
      INNER JOIN tb_bus B ON A.id_bus = B.id_bus
      WHERE A.id_tiket_bus NOT IN(
        SELECT id_tiket_bus FROM tb_penilaian_kepuasan
      )
    ")->result(); 

  	echo json_encode($data);
  }

  public function getNilaiKepuasan(){
    $id_tiket_bus = $this->input->post('id_tiket_bus');
    
    $html="";
    $tot_sevqual=0;
    $parameter = $this->db->query("
      SELECT id_parameter FROM tb_parameter ORDER BY id_parameter
    ")->result_array();

    foreach($parameter as $param){
      
      $id_parameter = $param['id_parameter'];

      $indikator = $this->db->query("
        SELECT id_indikator_kepuasan, indikator_kepuasan, nilai FROM tb_indikator_kepuasan ORDER BY id_indikator_kepuasan DESC
      ")->result_array();

      $tr="";
      $total_persepsi=0;
      $tot_frekuensi=0;
      foreach($indikator as $ind){
        $id_indikator = $ind['id_indikator_kepuasan'];
        $indikator_kepuasan = $ind['indikator_kepuasan'];
        $nilai = $ind['nilai'];

        $frekuensi = $this->db->query("
          SELECT COUNT(*) frekuensi FROM tb_item_penilaian WHERE id_penjualan_tiket IN (
            SELECT id_penjualan_tiket FROM tb_penjualan_tiket WHERE id_tiket_bus='".$id_tiket_bus."'
          )
          AND id_parameter='".$id_parameter."' and id_indikator='".$id_indikator."'
        ")->row()->frekuensi;

        $nilai_persepsi = $nilai * $frekuensi;
        $tot_frekuensi = $tot_frekuensi + $frekuensi;
        
        $total_persepsi = $total_persepsi + $nilai_persepsi;

        $tr .= "<tr>
                    <td>".$indikator_kepuasan."</td>
                    <td>".$frekuensi."</td>
                    <td>".$nilai." X ".$frekuensi."</td>
                    <td>".$nilai_persepsi."</td>
                  </tr>
                ";

      }

      $nilai_max = $tot_frekuensi * 5;
      if($nilai_max == 0){
        $sevqual = 0;
      }else{
        $sevqual = ($total_persepsi / $nilai_max) * 100;
      }
      
      $tot_sevqual = $tot_sevqual + $sevqual;

      $html .= "<table border='1'>
                  <thead>
                    <tr>
                      <th>Respon</th>
                      <th>Frekuensi</th>
                      <th>Persepsi</th>
                      <th>Nilai Persepsi</th>
                    </tr>
                  </thead>
                  <tbody>
                  ".$tr."
                  </tbody>
                  <tfoot>
                    <tr>
                      <td>Total</td>
                      <td>".$tot_frekuensi."</td>
                      <td></td>
                      <td>".$total_persepsi."</td>
                    </tr>
                  </tfoot>
                </table><br>
                Nilai sevqual: ".$total_persepsi." / ".$nilai_max." x 100% = ".$sevqual."
                ";

      
    }

    $jml_pertanyaan = count($parameter);
    $nilai_sevqual = $tot_sevqual / $jml_pertanyaan;

    $dt = $this->db->query("
      SELECT B.no_pol, A.tujuan, Date(A.tgl_keberangkatan) tgl_keberangkatan, a.tujuan FROM tb_tiket_bus A
      INNER JOIN tb_bus B ON A.id_bus = B.id_bus
      WHERE A.id_tiket_bus='".$id_tiket_bus."'
    ")->result_array();

    $ket = "<br>Nilai Servqual = ".number_format($nilai_sevqual)."%<br>
            <b>Hasil Penilaian Kepuasan Pelanggan pada Bus ".$dt[0]['no_pol'].", Tujuan ".$dt[0]['tujuan'].", Tgl Keberangkatan".$dt[0]['tgl_keberangkatan']." mendapatkan hasil nilai: </b><h3>".number_format($nilai_sevqual)." % dari 100%</h3>";
    $input = "<input type='hidden' name='nilai_sevqual' value='".number_format($nilai_sevqual)."' >";
    echo $html.$ket.$input;

  }

  public function generateId(){
    $unik = "N".date('Ym');
    $kode = $this->db->query("SELECT MAX(id_penilaian) LAST_NO FROM tb_penilaian_kepuasan WHERE id_penilaian LIKE '".$unik."%'")->row()->LAST_NO;
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
    $this->form_validation->set_rules('id_tiket_bus', 'id tiket bus', 'required');
    $this->form_validation->set_rules('nilai_kepuasan', 'nilai kepuasan', 'required');

    if($this->form_validation->run() == FALSE){
      // echo validation_errors();
      $output = array("status" => "error", "message" => validation_errors());
      echo json_encode($output);
      return false;
    }

    $id = $this->generateId();
    
    $data = array(
              "id_penilaian" => $id,
              "id_tiket_bus" => $this->input->post('id_tiket_bus'),
              "nilai_kepuasan"  => $this->input->post('nilai_kepuasan'),
            );


    $this->db->insert('tb_penilaian_kepuasan', $data);
    $output = array("status" => "success", "message" => "Data Berhasil Disimpan, ID: ".$id);
    echo json_encode($output);

  }

}