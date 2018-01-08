<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Userprofile extends MY_Controller {

    public $data;

    public function __construct() {
        parent::__construct();
        $this->load->library('S3');
        $this->load->library('form_validation');
    }

    public function index() {
        $this->data['header'] = $this->load->view('userprofile/header', $this->data, TRUE);
        $this->data['footer'] = $this->load->view('userprofile/footer', $this->data, TRUE);
        $this->data['title'] = "Basic Information | Aileensoul";
        $this->load->view('userprofile/index', $this->data);
    }

}
