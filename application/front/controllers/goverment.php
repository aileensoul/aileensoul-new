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

    public function postdetails() { 
        $userid = $this->session->userdata('aileenuser');
        $this->load->view('goverment/gov_post_details', $this->data);     
    }

    public function allpost() { 
        $userid = $this->session->userdata('aileenuser');

        $contition_array = array('status' => '1', 'is_delete' => '0');
         $this->data['govjob_category'] = $govjob_category = $this->common->select_data_by_condition('gov_category', $contition_array, $data = 'id,name,image', $sortby = '', $orderby = 'desc', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        $this->load->view('goverment/gov_all_post', $this->data);     
    }

    public function allpostdetail() { 
        $userid = $this->session->userdata('aileenuser');
        $this->load->view('goverment/gov_all_post_detail', $this->data);     
    }
}