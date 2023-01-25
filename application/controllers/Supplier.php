<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Supplier extends CI_Controller {

  public function __construct(){
    parent::__construct();

    if(!$this->session->userdata('id_user'))
      redirect('login', 'refresh');
  }

  public function index(){
    $this->load->view('template/header');
    $this->load->view('template/sidebar');
    $this->load->view('pages/supplier');
    $this->load->view('template/footer');
  }

  public function getAllData(){
  	$data['data'] = $this->db->get('tb_supplier')->result();
        
  	echo json_encode($data);
  }


  public function saveData(){
    
    
    $this->load->library('form_validation');
    $this->form_validation->set_rules('nm_supplier', 'Nama Supplier', 'required');
    $this->form_validation->set_rules('no_tlp', 'Telphone', 'required|numeric');
    $this->form_validation->set_rules('alamat', 'Alamat', 'required');


    if($this->form_validation->run() == FALSE){
      // echo validation_errors();
      $output = array("status" => "error", "message" => validation_errors());
      echo json_encode($output);
      return false;
    }
    
    $data = array(
              "nm_supplier" => $this->input->post('nm_supplier'),
              "no_tlp" => $this->input->post('no_tlp'),
              "alamat" => $this->input->post('alamat'),
            );
    $this->db->insert('tb_supplier', $data);
    $output = array("status" => "success", "message" => "Data Berhasil Disimpan");
    echo json_encode($output);

  }

  public function updateData(){
    
    
    $this->load->library('form_validation');
    $this->form_validation->set_rules('nm_supplier', 'Nama', 'required');
    $this->form_validation->set_rules('no_tlp', 'Telphone', 'required|numeric');
    $this->form_validation->set_rules('alamat', 'Alamat', 'required');


    if($this->form_validation->run() == FALSE){
      // echo validation_errors();
      $output = array("status" => "error", "message" => validation_errors());
      echo json_encode($output);
      return false;
    }
    
    $data = array(
        "nm_supplier" => $this->input->post('nm_supplier'),
        "no_tlp" => $this->input->post('no_tlp'),
        "alamat" => $this->input->post('alamat'),
      );

    $this->db->where('id_supplier', $this->input->post('id_supplier'));
    $this->db->update('tb_supplier', $data);
    if($this->db->error()['message'] != ""){
      $output = array("status" => "error", "message" => $this->db->error()['message']);
      echo json_encode($output);
      return false;
    }
    $output = array("status" => "success", "message" => "Data Berhasil di Update");
    echo json_encode($output);

  }

  public function deleteData(){

    $this->db->where('id_supplier', $this->input->post('id_supplier'));
    $this->db->delete('tb_supplier');

    $output = array("status" => "success", "message" => "Data Berhasil di Hapus");
    echo json_encode($output);
  }

}