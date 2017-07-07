<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Stay_connect extends MY_Controller {

    public $data;

    public function __construct() {

        parent::__construct();
        
        //$GLOBALS['record_per_page']=10;
        //site setting details
        $site_name_values = $this->common->select_data_by_id('settings', 'setting_id', '1', '*');
        $this->data['site_name'] = $site_name = $site_name_values[0]['setting_value'];
        //set header, footer and leftmenu
        $this->data['title'] = 'Stay Connect | ' . $site_name;
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

        $this->data['module_name'] = 'Stay Connect';
        $this->data['section_title'] = 'Stay Connect';

        $contition_array = array('status !=' => '3');
        $this->data['stay_connect'] = $this->common->select_data_by_condition('stay_connect', $contition_array, '*', $short_by = '', $order_by = '', $limit = '', $offset = '');
        
        $this->load->view('stay_connect/index', $this->data);
    }

    
    //Edit global_community
    public function edit() {
        //check post and save data
        
        if ($this->input->post('btn_save')) {
                $update_name = $this->input->post('name');
                $update_description = $this->input->post('description');
                
                $update_data['name'] = $update_name[1];
                $update_data['description'] = $update_description[1];
                $update_data['modify_date'] = date('Y-m-d h:i:s');
                
                $update_result = $this->common->update_data($update_data, 'stay_connect', 'id', 1);
                
                $update_name1 = $this->input->post('name');
                $update_description1 = $this->input->post('description');
                $update_data1['name'] = $update_name1[2];
                $update_data1['description'] = $update_description1[2];
                $update_data1['modify_date'] = date('Y-m-d h:i:s');
                
                $update_result = $this->common->update_data($update_data1, 'stay_connect', 'id', 2);
            
                $this->session->set_flashdata('success', 'Stay Connect successfully updated');
                $redirect_url = site_url('stay_connect');
                redirect($redirect_url, 'refresh');
        } 
    }

    
   

}

?>