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

  public function getDataById(){
    $id = $this->input->post('id_penjualan');
    $this->db->select('a.*, b.id_barang, b.id_det_penjualan, b.jumlah, b.harga, ifnull(b.finishing,0) finishing, b.status_barang, d.nm_barang, c.nm_pelanggan, c.id_pelanggan');
    $this->db->from('tb_penjualan a'); 
    $this->db->join('tb_det_penjualan b', 'a.id_penjualan=b.id_penjualan');
    $this->db->join('tb_pelanggan c', 'a.id_pelanggan=c.id_pelanggan');
    $this->db->join('tb_barang d', 'b.id_barang=d.id_barang');
    $this->db->where('a.id_penjualan', $id);
    $this->db->order_by('b.id_det_penjualan','asc');         
    $dataList = $this->db->get()->result(); 

    $no = 0;
    $data = [];
    foreach ($dataList as $list) {
      
      $data[$no]['id_penjualan'] = $list->id_penjualan;
      $data[$no]['tgl_jual'] = date('d-M-Y', strtotime($list->tgl_jual));
      $data[$no]['no_nota'] = $list->no_nota;
      $data[$no]['tgl_nota'] =  ($list->tgl_nota == "") ? "" : date('d-M-Y', strtotime($list->tgl_nota));
      $data[$no]['ket_penjualan'] = $list->ket_penjualan;
      $data[$no]['alamat_pengiriman'] = $list->alamat_pengiriman;
      $data[$no]['status'] = $list->status;
      $data[$no]['tot_penjualan'] = number_format($list->tot_penjualan,0,',','.');
      
      $data[$no]['id_det_penjualan'] = $list->id_det_penjualan;
      $data[$no]['id_barang'] = $list->id_barang;
      $data[$no]['nm_barang'] = $list->nm_barang;
      $data[$no]['jumlah'] = $list->jumlah;
      $data[$no]['harga'] = $list->harga;
      $data[$no]['finishing'] = $list->finishing;
      $data[$no]['status_barang'] = $list->status_barang;

      $data[$no]['nm_pelanggan'] = $list->nm_pelanggan;
      $data[$no]['id_pelanggan'] = $list->id_pelanggan;
      $no++;
    }

  	echo json_encode($data);
  }

  public function updateData(){
    
    
    $this->load->library('form_validation');
    $this->form_validation->set_rules('id_penjualan', 'ID Penjualan', 'required');
    $this->form_validation->set_rules('id_barang[]', 'Barang', 'required');
    $this->form_validation->set_rules('finishing[]', 'Biaya Finishing', 'required');
    $this->form_validation->set_rules('status_barang[]', 'Status Barang', 'required');
    $this->form_validation->set_rules('subtotal[]', 'Sub Total', 'required');
    $this->form_validation->set_rules('tot_penjualan', 'Total Harga', 'required');

    if($this->form_validation->run() == FALSE){
      // echo validation_errors();
      $output = array("status" => "error", "message" => validation_errors());
      echo json_encode($output);
      return false;
    }
    
    $data = array(
        "no_nota" => $this->input->post('no_nota'),
        "tgl_nota" => ($this->input->post('tgl_nota') == "") ? null : date('Y-m-d', strtotime($this->input->post('tgl_nota'))),
        "status" => $this->input->post('status'),
        "tot_penjualan" => str_replace(".", "", $this->input->post('tot_penjualan')),
      );

    $this->db->where('id_penjualan', $this->input->post('id_penjualan'));
    $this->db->update('tb_penjualan', $data);

    foreach($this->input->post('id_barang') as $key => $each){
      $dataDtl = array(
        "status_barang" => $this->input->post('status_barang')[$key],
        "finishing" => $this->input->post('finishing')[$key],
      );

      $this->db->where('id_penjualan', $this->input->post('id_penjualan'));
      $this->db->where('id_barang', $this->input->post('id_barang')[$key]);
      $this->db->update('tb_det_penjualan', $dataDtl);
    }

    if($this->input->post('status') == "selesai"){

      // Insert table pemasukan
      $unik = 'M'.date('dmY');
      $kode = $this->db->query("select MAX(id_pemasukan) LAST_NO from tb_pemasukan
                                WHERE id_pemasukan LIKE '".$unik."%'")->row()->LAST_NO;
      
      $urutan = (int) substr($kode, 9, 4);
      $urutan++;
      $huruf = $unik;
      $kode = $huruf . sprintf("%04s", $urutan);

      $tot_penjualan = $this->db->query("SELECT tot_penjualan FROM tb_penjualan 
                                WHERE id_penjualan='".$this->input->post('id_penjualan')."'")->row()->tot_penjualan;
      $dataPemasukan = array(
        "id_pemasukan" => $kode,
        "id_pelanggan" => $this->input->post('id_pelanggan'),
        "id_relasi" => $this->input->post('id_penjualan'),
        "tgl_input" => date("Y-m-d").' '.date("H:i:s"),
        "tipe_pemasukan" => "penjualan",
        "nominal_masuk" => $tot_penjualan,
      );
      $this->db->insert('tb_pemasukan', $dataPemasukan);
      // Insert table pemasukan

      // update table barang field stok

      $jmlPenjualan = $this->db->query("SELECT id_barang, jumlah FROM tb_det_penjualan 
                                        WHERE id_penjualan='".$this->input->post('id_penjualan')."'
                                        AND status_barang='sudah jadi'")->result();
      foreach ($jmlPenjualan as $list) {

        $this->db->query("UPDATE tb_barang SET stok=stok-".$list->jumlah." WHERE 
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
        "masuk" => $tot_penjualan,
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

      $tot_stok_keluar = $this->db->query("SELECT SUM(jumlah) tot_stok_keluar FROM tb_det_penjualan 
                                  WHERE id_penjualan='".$this->input->post('id_penjualan')."'")->row()->tot_stok_keluar;
      
      $dataStok = array(
        "id_jurnal_stok" => $kodeStok,
        "tgl_input" => date("Y-m-d").' '.date("H:i:s"),
        "id_relasi" => $kode,
        "keluar" => $tot_stok_keluar,
      );
      $this->db->insert('tb_jurnal_stok', $dataStok);
      // Insert table jurnal stok

    }
    
    $output = array("status" => "success", "message" => "Data Berhasil di Update");
    echo json_encode($output);

  }



}