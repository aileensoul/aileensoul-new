<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Main extends CI_Controller {
    public $data;
    public function __construct() {
        parent::__construct();

        $this->load->library('form_validation');
        $this->load->model('email_model');
        $this->load->helper('cookie');
        $this->load->model('logins');

        if ($this->session->userdata('aileenuser')) {
            redirect('dashboard', 'refresh');
        }
        include ('include.php');
    }

    //job seeker basic info controller start

    public function index() {
        $this->data['login_footer'] = $this->load->view('login_footer', $this->data, true);
        $this->load->view('main', $this->data);
    }

//job user end
    public function abc() {
        $this->load->view('show');
    }

}
