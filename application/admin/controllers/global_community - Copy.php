<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Global_community extends MY_Controller {

    public $data;

    public function __construct() {

        parent::__construct();

        //$GLOBALS['record_per_page']=10;
        //site setting details
        $site_name_values = $this->common->select_data_by_id('settings', 'setting_id', '1', '*');
        $this->data['site_name'] = $site_name = $site_name_values[0]['setting_value'];
        //set header, footer and leftmenu
        $this->data['title'] = 'Global Community | ' . $site_name;
        $this->data['header'] = $this->load->view('header', $this->data);
        $this->data['leftmenu'] = $this->load->view('leftmenu', $this->data);
        $this->data['footer'] = $this->load->view('footer', $this->data, true);


        $this->load->model('common');

        //remove catch so after logout cannot view last visited page if that page is this
        $this->output->set_header('Last-Modified:' . gmdate('D, d M Y H:i:s') . 'GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
        $this->output->set_header('Cache-Control: post-check=0, pre-check=0', false);
        $this->output->set_header('Pragma: no-cache');
    }

    //display global_community list
    public function index() {

        $this->data['module_name'] = 'Global Community';
        $this->data['section_title'] = 'Global Community';

        $contition_array = array('status !=' => '3');
        $this->data['global_community'] = $this->common->select_data_by_condition('global_community', $contition_array, '*', $short_by = '', $order_by = '', $limit = '', $offset = '');
                
        $this->load->view('global_community/index', $this->data);
    }

    

    //Edit global_community
    public function edit() {
        
        //check post and save data
        if ($this->input->post('btn_save')) {
            foreach ($_POST['id'] as $key => $value) {
                $update_data = array();
                $update_data['id'] = $key;
                $update_name = $this->input->post('name');
                $update_link = $this->input->post('link');
                $update_data['name'] = $update_name[$key];
                $update_data['link'] = $update_link[$key];
                $update_data['modify_date'] = date('Y-m-d h:i:s');
                $update_data['status'] = 1;
                
                $update_result = $this->common->update_data($update_data, 'global_community', 'id', $key);
            }
                $this->session->set_flashdata('success', 'Global Community successfully updated');
                $redirect_url = site_url('global_community');
                redirect($redirect_url, 'refresh'); 
        } 
    }

    
}

?>