<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Sitemap extends CI_Controller {

    public function __construct() {
        parent::__construct();
        //AWS access info start
        $this->load->library('S3');
        //AWS access info end
        include ('include.php');
        $this->load->model('sitemap_model');
        $this->data['sitemap_header'] = $this->load->view('sitemap/sitemap_header', $this->data, true);
    }

    public function index() {
        $this->data['login_header'] = $this->load->view('login_header', $this->data,TRUE);
        $this->data['login_footer'] = $this->load->view('login_footer', $this->data,TRUE);
        
        $contition_array = array('');
        $this->data['business_profile'] = $userdata = $this->common->select_data_by_condition('business_profile', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        
        $this->load->view('sitemap/index', $this->data);
    }
    
    public function job_profile() {
        $this->data['login_header'] = $this->load->view('login_header', $this->data,TRUE);
        $this->data['login_footer'] = $this->load->view('login_footer', $this->data,TRUE);
        
        $contition_array = array('');
        $this->data['business_profile'] = $userdata = $this->common->select_data_by_condition('business_profile', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        
        $this->load->view('sitemap/job', $this->data);
    }
    
    public function recruiter_profile() {
        $this->data['login_header'] = $this->load->view('login_header', $this->data,TRUE);
        $this->data['login_footer'] = $this->load->view('login_footer', $this->data,TRUE);
        
        $contition_array = array('');
        $this->data['business_profile'] = $userdata = $this->common->select_data_by_condition('business_profile', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        
        $this->load->view('sitemap/recruiter', $this->data);
    }
    public function freelance_profile() {
        $this->data['login_header'] = $this->load->view('login_header', $this->data,TRUE);
        $this->data['login_footer'] = $this->load->view('login_footer', $this->data,TRUE);
        
        $contition_array = array('');
        $this->data['business_profile'] = $userdata = $this->common->select_data_by_condition('business_profile', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
        
        $this->load->view('sitemap/freelance', $this->data);
    }
    public function business_profile() {
        $this->data['login_header'] = $this->load->view('login_header', $this->data,TRUE);
        $this->data['login_footer'] = $this->load->view('login_footer', $this->data,TRUE);
        $this->data['getBusinessDataByCategory'] = $this->sitemap_model->getBusinessDataByCategory();
        $this->load->view('sitemap/business', $this->data);
    }
    public function artistic_profile() {
        $this->data['login_header'] = $this->load->view('login_header', $this->data,TRUE);
        $this->data['login_footer'] = $this->load->view('login_footer', $this->data,TRUE);
        $this->data['getArtistDataByCategory'] = $this->sitemap_model->getArtistDataByCategory();
        $this->load->view('sitemap/artistic', $this->data);
    }
}
