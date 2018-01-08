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
        $userid = $this->session->userdata('aileenuser');
        $userdata = $this->data['userdata'] = $this->user_model->getUserSelectedData($userid, $select_data = "u.first_name,u.last_name,ui.user_image");
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

}
