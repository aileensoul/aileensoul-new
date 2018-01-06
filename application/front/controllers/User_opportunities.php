<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class User_opportunities extends MY_Controller {

    public $data;

    public function __construct() {

        parent::__construct();
        $this->load->model('email_model');
        $this->load->model('user_model');
        $this->load->model('data_model');
        $this->load->library('S3');
    }

    public function index() {
        $userid = $this->session->userdata('aileenuser');
        $this->data['userdata'] = $this->user_model->getUserSelectedData($userid, $select_data = "u.first_name,u.last_name,ui.user_image");
        $this->data['leftbox_data'] = $this->user_model->getLeftboxData($userid);
        $this->data['is_userBasicInfo'] = $this->user_model->is_userBasicInfo($userid);
        $this->data['is_userStudentInfo'] = $this->user_model->is_userStudentInfo($userid);
        $this->data['header_profile'] = $this->load->view('header_profile', $this->data, TRUE);
        $this->data['n_leftbar'] = $this->load->view('n_leftbar', $this->data, TRUE);
        $this->data['login_footer'] = $this->load->view('login_footer', $this->data, TRUE);
        $this->data['footer'] = $this->load->view('footer', $this->data, TRUE);
        $this->data['title'] = "Opportunities | Aileensoul";
        $this->load->view('user_opportunities/index', $this->data);
    }

}
