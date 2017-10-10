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
        //AWS access info start
        $this->load->library('S3');
        //AWS access info end

        // if ($this->session->userdata('aileenuser')) {
        //     redirect('dashboard', 'refresh');
        // }
        include ('include.php');
    }

    //job seeker basic info controller start
    public function index() {
        $this->data['login_footer'] = $this->load->view('login_footer', $this->data, TRUE);
        
        $contition_array = array();
        $site_visit = $this->common->select_data_by_condition('site_settings', $contition_array, $data = 'site_visit', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
        $site_visit = $site_visit[0]['site_visit'];
        $update_site_visit = $site_visit + 1;
        
        $data = array(
            'site_visit' => $update_site_visit
        );
        $updatdata = $this->common->update_data($data, 'site_settings', 'site_id', '1');
        
        $this->load->view('main', $this->data);

        if ($this->session->userdata('aileenuser')) {
            redirect('dashboard', 'refresh');
        }
    }

    //job user end
    public function abc() {
        $this->load->view('show');
    }

    //job user end
    public function terms_condition() {
        $this->load->view('termcondition');
    }

    //job user end
    public function privacy_policy() {
        $this->load->view('privacypolicy');
    }

}
