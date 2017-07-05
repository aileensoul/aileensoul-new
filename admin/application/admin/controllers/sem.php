<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Sem extends CI_Controller {

    public $data;

    public function __construct() {
        parent::__construct();

         

        // Get Site Information
        $site_settings = $this->common->select_data_by_id('site_settings', 'site_id', 1, $data = '*', $join_str = array());
         $main_site_name = $this->data['main_site_name'] = $site_settings[0]['site_name'];
         $main_site_url = $this->data['main_site_url'] = $site_settings[0]['site_url'];

        $this->data['title'] = "Search Engine Marketing | $main_site_name ";
         $this->data['module_name'] = "Search Engine Marketing";
         $this->load->model('settings');

        include('include.php');
        //remove catch so after logout cannot view last visited page if that page is this
         $this->output->set_header('Last-Modified:' . gmdate('D, d M Y H:i:s') . 'GMT');
         $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
         $this->output->set_header('Cache-Control: post-check=0, pre-check=0', false);
         $this->output->set_header('Pragma: no-cache');
    }

    public function index() {
            

         $this->data['section_title'] = "View Search Engine Marketing";

         $this->data['sem_list'] = $this->settings->getSemDetails();

        $this->data['limit'] = $this->data['total_rows'] = count($this->settings->getSemDetails());
         $this->data['offset'] = 0;
        $this->load->view('sem/index', $this->data);
    }

    public function edit() {
        if ($this->input->post()) {
            $semid = $this->input->post('semid');
            $semfieldvalue = $this->input->post('semfieldvalue');

            $data = array('semfieldvalue' => $semfieldvalue, 'timestamp' => date('Y-m-d h:i:s'));

            $update = $this->common->update_data($data, 'sem', 'semid', $semid);
            if ($update) {
                $this->session->set_flashdata('success', 'SEM data successfully updated');
                redirect('sem', 'refresh');
            }
        } else {
            $this->session->set_flashdata('error', 'Sorry something not right');
            redirect('sem', 'refresh');
        }
    }
   
}
