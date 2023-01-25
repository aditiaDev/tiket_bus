<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pembelian extends CI_Controller {

  public function __construct(){
    parent::__construct();

    if(!$this->session->userdata('id_user'))
      redirect('login', 'refresh');
  }

  public function index(){
    $this->load->view('template/header');
    $this->load->view('template/sidebar');
    $this->load->view('pages/pembelian');
    $this->load->view('template/footer');
  }

  public function getAllData(){
    $this->db->select('a.*, b.nm_supplier');
    $this->db->from('tb_pembelian a'); 
    $this->db->join('tb_supplier b', 'a.id_supplier=b.id_supplier');
    $this->db->order_by('a.tgl_pembelian','desc');         
    $dataList = $this->db->get()->result(); 

    $no = 0;
    $data['data'] = [];
    foreach ($dataList as $list) {
      $row = array();
      $data['data'][$no]['id_pembelian'] = $list->id_pembelian;
      $data['data'][$no]['id_supplier'] = $list->id_supplier;
      $data['data'][$no]['nm_supplier'] = $list->nm_supplier;
      $data['data'][$no]['status_pembelian'] = $list->status_pembelian;
      $data['data'][$no]['tot_pembelian'] = number_format($list->tot_pembelian,0,',','.');
      $data['data'][$no]['tgl_pembelian'] = date('d-M-Y', strtotime($list->tgl_pembelian));

      $data['data'][$no]['level'] = $this->session->userdata('level');
      $no++;
    }

  	echo json_encode($data);
  }

  public function addData(){
    $this->load->view('template/header');
    $this->load->view('template/sidebar');
    $this->load->view('pages/tambah_pembelian');
    $this->load->view('template/footer'); 
  }
  
  public function saveData(){
    
    
    $this->load->library('form_validation');
    $this->form_validation->set_rules('tgl_pembelian', 'Tgl Pembelian', 'required');
    $this->form_validation->set_rules('id_supplier', 'Supplier', 'required');
    $this->form_validation->set_rules('tot_pembelian', 'Total Pembelian', 'required|numeric');
    $this->form_validation->set_rules('id_barang[]', 'Barang', 'required');

    if($this->form_validation->run() == FALSE){
      // echo validation_errors();
      $output = array("status" => "error", "message" => validation_errors());
      echo json_encode($output);
      return false;
    }

    $unik = 'B'.date('dmY', strtotime($this->input->post('tgl_pembelian')));
    $kode = $this->db->query("select MAX(id_pembelian) LAST_NO from tb_pembelian WHERE id_pembelian LIKE '".$unik."%'")->row()->LAST_NO;
    
    $urutan = (int) substr($kode, 9, 4);
    $urutan++;
    $huruf = $unik;
    $kode = $huruf . sprintf("%04s", $urutan);
    // echo $kode;
    
    $dataHeader = array(
              "id_pembelian" => $kode,
              "tgl_pembelian" => date("Y-m-d", strtotime($this->input->post('tgl_pembelian'))).' '.date("H:i:s"),
              "id_supplier" => $this->input->post('id_supplier'),
              "status_pembelian" => "pengajuan",
              "tot_pembelian" => $this->input->post('tot_pembelian'),
            );
    $this->db->insert('tb_pembelian', $dataHeader);


    foreach($this->input->post('id_barang') as $key => $each){
      $dataDtl[] = array(
        "id_pembelian" => $kode,
        "id_barang" => $this->input->post('id_barang')[$key],
        "qty_beli" => $this->input->post('qty_beli')[$key],
        "harga" => $this->input->post('harga')[$key],
      );
    }

    $this->db->insert_batch('tb_det_pembelian', $dataDtl);

    if(!empty($this->input->post('penjelasan'))){
      foreach($this->input->post('penjelasan') as $key => $each){
        $dataKet[] = array(
          "id_pembelian" => $kode,
          "tgl_input" => date("Y-m-d"),
          "penjelasan" => $this->input->post('penjelasan')[$key],
        );
      }

      $this->db->insert_batch('tb_keterangan_pembelian', $dataKet);
    }

    $output = array("status" => "success", "message" => "Data Berhasil Disimpan", "DOC_NO" => $kode);
    echo json_encode($output);

  }

  public function deleteData(){
    $this->db->where('id_pembelian', $this->input->post('id_pembelian'));
    $this->db->delete('tb_keterangan_pembelian');
    
    $this->db->where('id_pembelian', $this->input->post('id_pembelian'));
    $this->db->delete('tb_det_pembelian');

    $this->db->where('id_pembelian', $this->input->post('id_pembelian'));
    $this->db->delete('tb_pembelian');

    $output = array("status" => "success", "message" => "Data Berhasil di Hapus");
    echo json_encode($output);
  }

  public function dtlData(){
    $this->load->view('template/header');
    $this->load->view('template/sidebar');
    $this->load->view('pages/detail_pembelian');
    $this->load->view('template/footer'); 
  }

  public function getDataById(){
    $id = $this->input->post('id_pembelian');
    $this->db->select('a.*, b.id_det_pembelian, b.id_barang, b.qty_beli, c.nm_supplier, d.nm_barang, b.harga');
    $this->db->from('tb_pembelian a'); 
    $this->db->join('tb_det_pembelian b', 'a.id_pembelian=b.id_pembelian');
    $this->db->join('tb_supplier c', 'a.id_supplier=c.id_supplier');
    $this->db->join('tb_barang d', 'b.id_barang=d.id_barang');
    $this->db->where('a.id_pembelian', $id);
    $this->db->order_by('b.id_det_pembelian','asc');         
    $dataList = $this->db->get()->result(); 

    $no = 0;
    $data = [];
    foreach ($dataList as $list) {
      
      $data[$no]['id_pembelian'] = $list->id_pembelian;
      $data[$no]['id_supplier'] = $list->id_supplier;
      $data[$no]['nm_supplier'] = $list->nm_supplier;
      $data[$no]['status_pembelian'] = $list->status_pembelian;
      $data[$no]['tot_pembelian'] = number_format($list->tot_pembelian,0,',','.');
      $data[$no]['tgl_pembelian'] = date('d-M-Y', strtotime($list->tgl_pembelian));
      $data[$no]['id_det_pembelian'] = $list->id_det_pembelian;
      $data[$no]['id_barang'] = $list->id_barang;
      $data[$no]['nm_barang'] = $list->nm_barang;
      $data[$no]['harga'] = $list->harga;
      $data[$no]['qty_beli'] = $list->qty_beli;
      $no++;
    }

  	echo json_encode($data);
  }

  public function getKeteranganById(){
    $id = $this->input->post('id_pembelian');
    $this->db->select('b.*');
    $this->db->from('tb_pembelian a'); 
    $this->db->join('tb_keterangan_pembelian b', 'a.id_pembelian=b.id_pembelian');
    $this->db->where('a.id_pembelian', $id);
    $this->db->order_by('b.tgl_input','asc');         
    $dataList = $this->db->get()->result(); 

    $no = 0;
    $data = [];
    foreach ($dataList as $list) {
      
      $data[$no]['id_ket_pembelian'] = $list->id_ket_pembelian;
      $data[$no]['tgl_input'] = date('d-M-Y', strtotime($list->tgl_input));
      $data[$no]['penjelasan'] = $list->penjelasan;
      $no++;
    }

  	echo json_encode($data);
  }

  public function updateStatus(){
    
    
    $this->load->library('form_validation');
    $this->form_validation->set_rules('id_pembelian', 'ID Pembelian', 'required');
    $this->form_validation->set_rules('status_pembelian', 'Status', 'required');

    if($this->form_validation->run() == FALSE){
      // echo validation_errors();
      $output = array("status" => "error", "message" => validation_errors());
      echo json_encode($output);
      return false;
    }
    
    $data = array(
        "status_pembelian" => $this->input->post('status_pembelian'),
      );

    $this->db->where('id_pembelian', $this->input->post('id_pembelian'));
    $this->db->update('tb_pembelian', $data);


    if($this->input->post('status_pembelian') == "selesai"){
      // Insert table pengeluaran
      $unik = 'K'.date('dmY');
      $kode = $this->db->query("select MAX(id_pengeluaran) LAST_NO from tb_pengeluaran 
                                WHERE id_pengeluaran LIKE '".$unik."%'")->row()->LAST_NO;
      
      $urutan = (int) substr($kode, 9, 4);
      $urutan++;
      $huruf = $unik;
      $kode = $huruf . sprintf("%04s", $urutan);

      $tot_pembelian = $this->db->query("SELECT tot_pembelian FROM tb_pembelian 
                                WHERE id_pembelian='".$this->input->post('id_pembelian')."'")->row()->tot_pembelian;
      $dataPengeluaran = array(
        "id_pengeluaran" => $kode,
        "tgl_input" => date("Y-m-d").' '.date("H:i:s"),
        "tipe_pengeluaran" => "pembelian",
        "id_relasi" => $this->input->post('id_pembelian'),
        "nominal_keluar" => $tot_pembelian,
      );
      $this->db->insert('tb_pengeluaran', $dataPengeluaran);
      // Insert table pengeluaran

      // update table barang field stok

      $jmlPembelian = $this->db->query("SELECT id_barang, qty_beli FROM tb_det_pembelian 
                                        WHERE id_pembelian='".$this->input->post('id_pembelian')."'")->result();
      foreach ($jmlPembelian as $list) {

        $this->db->query("UPDATE tb_barang SET stok=stok+".$list->qty_beli." WHERE 
                          id_barang='".$list->id_barang."'");
      }
      // update table barang field stok

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
        "tgl_input" => date("Y-m-d").' '.date("H:i:s"),
        "id_relasi" => $kode,
        "keluar" => $tot_pembelian,
      );
      $this->db->insert('tb_jurnal_keuangan', $dataKeuangan);
      // Insert table jurnal keuangan

      // Insert table jurnal stok
      $unik = 'S'.date('dmY');
      $kodeStok = $this->db->query("select MAX(id_jurnal_stok) LAST_NO from tb_jurnal_stok 
                                WHERE id_jurnal_stok LIKE '".$unik."%'")->row()->LAST_NO;
      
      $urutan = (int) substr($kodeStok, 9, 4);
      $urutan++;
      $huruf = $unik;
      $kodeStok = $huruf . sprintf("%04s", $urutan);

      $tot_stok_masuk = $this->db->query("SELECT SUM(qty_beli) tot_stok_masuk FROM tb_det_pembelian 
                                  WHERE id_pembelian='".$this->input->post('id_pembelian')."'")->row()->tot_stok_masuk;
      
      $dataStok = array(
        "id_jurnal_stok" => $kodeStok,
        "tgl_input" => date("Y-m-d").' '.date("H:i:s"),
        "id_relasi" => $kode,
        "masuk" => $tot_stok_masuk,
      );
      $this->db->insert('tb_jurnal_stok', $dataStok);
      // Insert table jurnal stok
    }
    
    $output = array("status" => "success", "message" => "Data Berhasil di Update");
    echo json_encode($output);

  }

}