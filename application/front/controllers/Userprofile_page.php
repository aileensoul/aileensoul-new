<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Userprofile_page extends MY_Controller {

    public $data;

    public function __construct() {
        parent::__construct();
        $this->load->library('S3');
        $this->load->library('form_validation');
        
        $this->load->model('user_model');
    }

    public function profile() {
        $this->load->view('userprofile/profiles', $this->data);
    }
     public function dashboard() {
        $this->load->view('userprofile/dashboard', $this->data);
    }
     public function details() {
        
        $this->load->view('userprofile/details', $this->data);
    }
     public function contacts() {
        $this->load->view('userprofile/contacts', $this->data);
    }
     public function followers() {
        $this->load->view('userprofile/followers', $this->data);
    }
     public function following() {
        $this->load->view('userprofile/following', $this->data);
    }
    
    
    public function detail_data() { 
      $userid = $this->session->userdata('aileenuser');
        $is_basicInfo = $this->data['is_basicInfo'] = $this->user_model->is_userBasicInfo($userid);
      if($is_basicInfo == 0){
        $detailsData = $this->data['detailsData'] = $this->user_model->getUserStudentData($userid,$data="d.degree_name,u.university_name,c.city_name");
      } else { 
        $detailsData = $this->data['detailsData'] = $this->user_model->getUserProfessionData($userid,$data="up.designation,up.field,c.city_name");
      } 
      
      echo json_encode($detailsData);
    }

}
