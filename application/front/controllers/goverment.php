<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Goverment extends MY_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->library('form_validation');
        $this->load->model('email_model');
        $this->data['title'] = "Aileensoul";
        $this->load->helper('smiley');
        $this->data['login_header'] = $this->load->view('login_header', $this->data,TRUE);
        $this->load->library('S3');

        include ('include.php');
    }

    public function post_details() { 
        $userid = $this->session->userdata('aileenuser');
        $this->load->view('goverment/gov_post_details', $this->data);     
    }
}