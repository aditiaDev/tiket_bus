<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pelanggan extends CI_Controller {

  public function __construct(){
    parent::__construct();

    if(!$this->session->userdata('id_user'))
      redirect('login', 'refresh');
  }

  public function index(){
    $this->load->view('template/header');
    $this->load->view('template/sidebar');
    $this->load->view('pages/pelanggan');
    $this->load->view('template/footer');
  }

  public function getAllData(){
  	// $data['data'] = $this->db->get('tb_pelamar')->result();

    $this->db->select('a.*, b.username, b.password');
    $this->db->from('tb_pelanggan a'); 
    $this->db->join('tb_user b', 'a.id_user=b.id_user');
    $this->db->order_by('a.nm_pelanggan','asc');         
    $data['data'] = $this->db->get()->result(); 

  	echo json_encode($data);
  }


  public function saveData(){
    
    
    $this->load->library('form_validation');
    $this->form_validation->set_rules('nm_pelanggan', 'Nama', 'required');
    $this->form_validation->set_rules('no_tlp', 'Telphone', 'required|numeric');
    $this->form_validation->set_rules('alamat', 'Alamat', 'required');

    $this->form_validation->set_rules('username', 'Username', 'required|is_unique[tb_user.username]');
    $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');

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
              "id_user" => $id_user,
            );
    $this->db->insert('tb_pelanggan', $data);
    $output = array("status" => "success", "message" => "Data Berhasil Disimpan");
    echo json_encode($output);

  }

  public function updateData(){
    
    
    $this->load->library('form_validation');
    $this->form_validation->set_rules('nm_pelanggan', 'Nama', 'required');
    $this->form_validation->set_rules('no_tlp', 'Telphone', 'required|numeric');
    $this->form_validation->set_rules('alamat', 'Alamat', 'required');

    $this->form_validation->set_rules('username', 'Username', 'required');
    $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');

    if($this->form_validation->run() == FALSE){
      // echo validation_errors();
      $output = array("status" => "error", "message" => validation_errors());
      echo json_encode($output);
      return false;
    }

    $dataUser = array(
      "username" => $this->input->post('username'),
      "password" => $this->input->post('password'),
    );

    $this->db->where('id_user', $this->input->post('id_user'));
    $this->db->update('tb_user', $dataUser);
    
    $data = array(
        "nm_pelanggan" => $this->input->post('nm_pelanggan'),
        "no_tlp" => $this->input->post('no_tlp'),
        "alamat" => $this->input->post('alamat'),
      );

    $this->db->where('id_pelanggan', $this->input->post('id_pelanggan'));
    $this->db->update('tb_pelanggan', $data);
    if($this->db->error()['message'] != ""){
      $output = array("status" => "error", "message" => $this->db->error()['message']);
      echo json_encode($output);
      return false;
    }
    $output = array("status" => "success", "message" => "Data Berhasil di Update");
    echo json_encode($output);

  }

  public function deleteData(){

    $id_user = $this->db->query("SELECT id_user FROM tb_pelanggan 
                            WHERE id_pelanggan='".$this->input->post('id_pelanggan')."' 
                            LIMIT 1")->row()->id_user;

    $this->db->where('id_pelanggan', $this->input->post('id_pelanggan'));
    $this->db->delete('tb_pelanggan');

    $this->db->where('id_user', $id_user);
    $this->db->delete('tb_user');

    $output = array("status" => "success", "message" => "Data Berhasil di Hapus");
    echo json_encode($output);
  }

}