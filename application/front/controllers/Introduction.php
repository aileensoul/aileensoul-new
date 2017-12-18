<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Introduction extends CI_Controller {

    public function __construct() {
        parent::__construct();
        //AWS access info start
        $this->load->library('S3');
        //AWS access info end
        include ('include.php');
    }

    public function index() {
        $this->data['login_header'] = $this->load->view('login_header', $this->data,TRUE);
        $this->data['login_footer'] = $this->load->view('login_footer', $this->data,TRUE);
        $this->load->view('introduction/business_profile', $this->data);
    }
    
    public function job_profile() {
        $this->data['login_header'] = $this->load->view('login_header', $this->data,TRUE);
        $this->data['login_footer'] = $this->load->view('login_footer', $this->data,TRUE);
        $this->load->view('introduction/job_profile', $this->data);
    }
    public function recruiter_profile() {
        $this->data['login_header'] = $this->load->view('login_header', $this->data,TRUE);
        $this->data['login_footer'] = $this->load->view('login_footer', $this->data,TRUE);
        $this->load->view('introduction/recruiter_profile', $this->data);
    }
    public function freelance_profile() {
        $this->data['login_header'] = $this->load->view('login_header', $this->data,TRUE);
        $this->data['login_footer'] = $this->load->view('login_footer', $this->data,TRUE);
        $this->load->view('introduction/freelance_profile', $this->data);
    }
    public function business_profile() {
        $this->data['login_header'] = $this->load->view('login_header', $this->data,TRUE);
        $this->data['login_footer'] = $this->load->view('login_footer', $this->data,TRUE);
        $this->load->view('introduction/business_profile', $this->data);
    }
    public function artistic_profile() {
        $this->data['login_header'] = $this->load->view('login_header', $this->data,TRUE);
        $this->data['login_footer'] = $this->load->view('login_footer', $this->data,TRUE);
        $this->load->view('introduction/artistic_profile', $this->data);
    }

}
