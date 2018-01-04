<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class User_basic_info extends MY_Controller {

    public $data;

    public function __construct() {

        parent::__construct();
        $this->load->model('email_model');
        $this->load->model('user_model');
        $this->load->library('S3');
    }

    public function index() {
        $userid = $this->session->userdata('aileenuser');
        $userdata = $this->data['userdata'] = $this->user_model->getUserSelectedData($userid, $select_data="u.first_name,u.last_name,ui.user_image");
        
        $this->data['header_profile'] = $this->load->view('header_profile', $this->data, TRUE);
        $this->data['login_footer'] = $this->load->view('login_footer', $this->data, TRUE);
        $this->data['footer'] = $this->load->view('footer', $this->data, TRUE);
        $this->data['title'] = "Basic Information | Aileensoul";
        $this->load->view('user_basic_info/index', $this->data);
    }

}
