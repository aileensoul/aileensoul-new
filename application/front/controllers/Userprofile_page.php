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
        $this->load->model('userprofile_model');
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
        $detailsData = $this->data['detailsData'] = $this->user_model->getUserStudentData($userid,$data="d.degree_name as Degree,u.university_name as University,c.city_name as City,usr.first_name as First name,usr.last_name as Last name,usr.user_dob as DOB");
      } else { 
        $detailsData = $this->data['detailsData'] = $this->user_model->getUserProfessionData($userid,$data="jt.name as Designation,it.industry_name as Industry,c.city_name as City,usr.first_name as First name,usr.last_name as Last name,usr.user_dob as DOB");
      } 
      
      echo json_encode($detailsData);
    }
    
     public function profiles_data() { 
      $userid = $this->session->userdata('aileenuser');
        $profilesData = $this->data['profilesData'] = $this->userprofile_model->getDashboardData($userid,$data="a.status as ap_status,a.art_step as ap_step,a.is_delete as ap_delete,r.re_status as rp_status,r.is_delete as rp_delete,r.re_step as rp_step,jr.is_delete as jp_delete,jr.status as jp_status,jr.job_step as jp_step,bp.status as bp_status,bp.is_deleted as bp_delete,bp.business_step as bp_step,fh.status as fh_status,fh.is_delete as fh_delete,fh.free_hire_step as fh_step,fp.status as fp_status,fp.is_delete as fp_delete,fp.free_post_step as fp_step");
      echo json_encode($profilesData); 
    }
    
    public function vsrepeat() { 
      $this->load->view('vsrepeat');
    }
    
    public function vsrepeat_data() { 
      $this->db->select('*');
      $this->db->from('user');
        $query = $this->db->get();
     $data =  $query->result_array();
      echo json_encode($data); 
    }

}
