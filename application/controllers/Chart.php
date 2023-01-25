<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Chart extends CI_Controller {

  public function __construct(){
    parent::__construct();
    
  }

  public function index(){
    if(!$this->session->userdata('id_user'))
      redirect('login', 'refresh');
    $this->load->view('template_pelanggan/header');
    $this->load->view('pages/pelanggan/chart');
    $this->load->view('template_pelanggan/footer');
  }

  public function deleteData(){
    $this->db->where('id_barang', $this->input->post('id_barang'));
    $this->db->where('id', $this->session->userdata('id_user'));
    $this->db->delete('tb_tmp_penjualan');

    $output = array("status" => "success", "message" => "Data Berhasil di Hapus");
    echo json_encode($output);
  }

  public function saveData(){
    
    
    $this->load->library('form_validation');
    $this->form_validation->set_rules('tgl_jual', 'Tanggal', 'required');
    $this->form_validation->set_rules('tot_penjualan', 'Total Bayar', 'required|numeric');
    $this->form_validation->set_rules('id_barang[]', 'Barang', 'required');
    $this->form_validation->set_rules('harga[]', 'Harga', 'required');
    $this->form_validation->set_rules('alamat_pengiriman', 'Alamat Pengiriman', 'required');

    if($this->form_validation->run() == FALSE){
      // echo validation_errors();
      $output = array("status" => "error", "message" => validation_errors());
      echo json_encode($output);
      return false;
    }

    $unik = 'J'.date('dmY', strtotime($this->input->post('tgl_jual')));
    $kode = $this->db->query("select MAX(id_penjualan) LAST_NO from tb_penjualan WHERE id_penjualan LIKE '".$unik."%'")->row()->LAST_NO;
    
    $urutan = (int) substr($kode, 9, 4);
    $urutan++;
    $huruf = $unik;
    $kode = $huruf . sprintf("%04s", $urutan);
    // echo $kode;

    $id_pelanggan = $this->db->query("SELECT id_pelanggan FROM tb_pelanggan 
                                  WHERE id_user='".$this->session->userdata('id_user')."'")->row()->id_pelanggan;
    
    $dataHeader = array(
              "id_penjualan" => $kode,
              "tgl_jual" => date("Y-m-d", strtotime($this->input->post('tgl_jual'))).' '.date("H:i:s"),
              "ket_penjualan" => $this->input->post('ket_penjualan'),
              "alamat_pengiriman" => $this->input->post('alamat_pengiriman'),
              "status" => "proses",
              "tot_penjualan" => $this->input->post('tot_penjualan'),
              "id_pelanggan" => $id_pelanggan,
            );
    $this->db->insert('tb_penjualan', $dataHeader);


    foreach($this->input->post('id_barang') as $key => $each){

      $dataDtl[] = array(
        "id_penjualan" => $kode,
        "id_barang" => $this->input->post('id_barang')[$key],
        "jumlah" => $this->input->post('jumlah')[$key],
        "harga" => $this->input->post('harga')[$key],
        "status_barang" => "masih proses",
      );

      // Delete data di tabel temporary penjualan
      $this->db->where('id_barang', $this->input->post('id_barang')[$key]);
      $this->db->where('id', $this->session->userdata('id_user'));
      $this->db->delete('tb_tmp_penjualan');
      // Delete data di tabel temporary penjualan

      $this->TelegramNotif($kode);

    }

    $this->db->insert_batch('tb_det_penjualan', $dataDtl);


    $output = array("status" => "success", "message" => "Pesanan sedang di proses dengan nomor Pemesanan ", "DOC_NO" => $kode);
    echo json_encode($output);

  }

  public function dtlBarang($id){
    $this->load->view('template_pelanggan/header');
    $this->load->view('pages/pelanggan/dtlBarang');
    $this->load->view('template_pelanggan/footer');
  }

  public function daftarTransaksi(){
    $this->load->view('template_pelanggan/header');
    $this->load->view('pages/pelanggan/daftarTransaksi');
    $this->load->view('template_pelanggan/footer');
  }

  public function listTransaksi(){
    $id_pelanggan = $this->db->query("SELECT id_pelanggan FROM tb_pelanggan 
                                  WHERE id_user='".$this->session->userdata('id_user')."'")->row()->id_pelanggan;

    $data['data']  = $this->db->query("SELECT a.id_penjualan, a.tgl_jual, a.no_nota, a.`status`, b.id_barang, c.nm_barang, 
        b.jumlah, b.harga, b.status_barang, (b.jumlah * b.harga) subtotal 
        FROM tb_penjualan a, tb_det_penjualan b, tb_barang c
        WHERE a.id_penjualan=b.id_penjualan
        AND b.id_barang=c.id_barang
        AND a.id_pelanggan='".$id_pelanggan."'")->result();

    echo json_encode($data);
  }

  public function botTelegram(){
    $token = "bot"."1859069479:AAFiaP2Ceot3tU6g9iM5n-kCfideseIxJhM";
    $updates = file_get_contents("php://input");
    

    $updates = json_decode($updates, true);
    $pesan = $updates['message']['text'];
    $chat_id = $updates['message']['chat']['id'];
    $username = $updates['message']['from']['username'];
    $file = $updates['message']['photo'][2]['file_id'];

    // var_dump($updates);
    // echo $username;

    $this->db->query("UPDATE tb_pelanggan set chat_id='".$chat_id."'  WHERE username_telegram like '%".$username."%'");

    $pesan = strtoupper($pesan);

    if($pesan == "/START"){
        $pesan_balik = urlencode("Selamat berbelanja di Mebel Buk Dhe Jepara \n1. /register untuk konfimrasi pendaftaran anda \n2. CEK%23[NOMOR_ID_PESANAN] untuk mengetahui status pesanan anda");
    }elseif($pesan == "/REGISTER"){
      $pesan_balik = "Pendaftaran Anda telah dikonfirmasi, Silahkan berbelanja di toko kami";
    }elseif(strpos($pesan, "EK#")>0){
        $datas = explode("#", $pesan);
        $idpesanan = $datas[1];

        $data = $this->db->query("SELECT status, alamat_pengiriman FROM tb_penjualan WHERE id_penjualan='".$idpesanan."'")->result_array();
        $status = $data[0]['status'];
        $alamat = $data[0]['alamat_pengiriman'];
        
        if($status == "kirim"){
          $stt = "sedang dalam pengiriman";
        }elseif($status == "selesai"){
          $stt = "telah selesai dan telah dikirim";
        }else{
          $stt = "sedang dalam proses dan akan dikirmkan";
        }

        $pesan_balik = "Status nomor pesanan anda ".$idpesanan." ".$stt." ke alamat ".$alamat;

        if($status == ""){
          $pesan_balik = "Nomor pesanan ".$idpesanan." tidak ditemukan";
        }
    }/*elseif(strpos($pesan, "AYAR#")>0){
      $datas = explode("#", $pesan);
      $idpesanan = $datas[1];

      $this->db->query("INSERT INTO tb_konfirm_pembayaran(id_penjualan, username_telegram, status) VALUES('".$idpesanan."','@".$username."','belum')");
      $pesan_balik = "Silahkan kirim foto pembayaran untuk ID Transaksi ".$idpesanan;
    }elseif($file){

      // $url = urlencode("https://api.telegram.org/bot1859069479:AAFiaP2Ceot3tU6g9iM5n-kCfideseIxJhM/getFile?file%5Fid=".$file);
      $url = urlencode("https://api.telegram.org/bot1859069479:AAFiaP2Ceot3tU6g9iM5n-kCfideseIxJhM/getFile?file%5Fid=AgACAgUAAxkBAAOzYTFLclFd2Tn3toOE5Kz1nYEcGR4AAp-sMRvrtohVreGGJpB5gn8BAAMCAAN5AAMgBA");

    $ch = curl_init();


      $optArray = array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_CAINFO => "C:\cacert.pem"	
      );
    
      
    curl_setopt_array($ch, $optArray);
    // $result = json_decode(curl_exec($ch), true);
    // $img=$result['result']['file_path'];
    $img = json_encode(curl_exec($ch));
    $err = curl_error($ch);
    curl_close($ch); 
	//print_r($result);


      // $this->db->query("UPDATE tb_konfirm_pembayaran SET gambar='".$gambar."' WHERE  username_telegram like '%".$username."%'");
      $pesan_balik = $img;
    }*/else{
        $pesan_balik = "Masukkan format CEK%23[NOMOR_ID_PESANAN]";
        
    }

    // echo $pesan_balik;

    $url = "https://api.telegram.org/$token/sendMessage?parse_mode=markdown&chat_id=$chat_id&text=$pesan_balik";

    $ch = curl_init();


      $optArray = array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_CAINFO => "C:\cacert.pem"	
      );
    
      
    curl_setopt_array($ch, $optArray);
    $result = curl_exec($ch);
      
    $err = curl_error($ch);
    curl_close($ch);	
      
    if($err<>"") echo "Error: $err";
    else echo "Pesan Terkirim";
  }

  private function TelegramNotif($id_transaksi){
    $token = "bot"."1859069479:AAFiaP2Ceot3tU6g9iM5n-kCfideseIxJhM";
    
    $chat_id = $this->db->query("SELECT chat_id FROM tb_pelanggan where id_user='".$this->session->userdata('id_user')."'")->row()->chat_id;


    $pesan_balik="Pesanan anda sedang diproses dengan no Transaksi ".$id_transaksi;

    $url = "https://api.telegram.org/$token/sendMessage?parse_mode=markdown&chat_id=$chat_id&text=$pesan_balik";

    $ch = curl_init();


      $optArray = array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_CAINFO => "C:\cacert.pem"	
      );
    
      
    curl_setopt_array($ch, $optArray);
    $result = curl_exec($ch);
      
    $err = curl_error($ch);
    curl_close($ch);	
      
    // if($err<>"") echo "Error: $err";
    // else echo "Pesan Terkirim";
  }
}
