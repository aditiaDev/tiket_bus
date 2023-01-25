<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

  public function __construct(){
    parent::__construct();
    
  }

  public function index(){
    if($this->session->userdata('id_user'))
      redirect('home', 'refresh');

    $this->load->view('login');
  }

  public function login(){
    $this->db->where('username', $this->input->post('username'));  
    $this->db->where('password', $this->input->post('password'));  
    $query = $this->db->get('tb_user');   
    if($query->num_rows() > 0){  
      foreach ($query->result() as $row)
      {   
        $arrdata = array(
          'id_user'=>$row->id_user,
          'level'=>$row->level,
          'username'=>$row->username,
        );  
          $this->session->set_userdata($arrdata);
      }

      $output = array("status" => "success", "message" => "Login Berhasil");
    }else{  
      $output = array("status" => "error", "message" => "Login Gagal");  
    }

    echo json_encode($output);
  }

  function logout(){
    $this->session->unset_userdata('id_user');
    $this->session->sess_destroy();
    redirect('/', 'refresh');
  }

  public function register(){
    $this->load->view('register');
  }

  public function signUp(){
    $this->load->library('form_validation');
    $this->form_validation->set_rules('nm_pelanggan', 'Nama', 'required');
    $this->form_validation->set_rules('alamat', 'Alamat', 'required');
    $this->form_validation->set_rules('no_tlp', 'No Telphone', 'required|numeric');
    $this->form_validation->set_rules('no_tlp', 'No Telphone', 'required|numeric');

    $this->form_validation->set_rules('username', 'Username', 'required|is_unique[tb_user.username]');
    $this->form_validation->set_rules('username_telegram', 'username Telegram', 'required');

    if($this->form_validation->run() == FALSE){
      // echo validation_errors();
      $output = array("status" => "error", "message" => validation_errors());
      echo json_encode($output);
      return false;
    }

    $dataUser = array(
              "username" => $this->input->post('username'),
              "password" => $this->input->post('password'),
              "level" => "pelanggan",
            );
    $this->db->insert('tb_user', $dataUser);

    $id_user = $this->db->query("SELECT id_user FROM tb_user 
                                WHERE username='".$this->input->post('username')."' 
                                AND `password`='".$this->input->post('password')."' 
                                LIMIT 1")->row()->id_user;

    
    $data = array(
              "nm_pelanggan" => $this->input->post('nm_pelanggan'),
              "no_tlp" => $this->input->post('no_tlp'),
              "alamat" => $this->input->post('alamat'),
              "username_telegram" => $this->input->post('username_telegram'),
              "id_user" => $id_user,
            );
    $this->db->insert('tb_pelanggan', $data);
    $output = array("status" => "success", "message" => "Data Berhasil Disimpan");
    echo json_encode($output);
  }

}