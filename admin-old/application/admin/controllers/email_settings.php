<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Email_settings extends CI_Controller {

    public $data;

    public function __construct() {
        parent::__construct();

        
        // Get Site Information
        $site_settings = $this->common->select_data_by_id('ailee_site_settings', 'site_id', 1, $data = '*', $join_str = array());
        $main_site_name = $this->data['main_site_name'] = $site_settings[0]['site_name'];
        $main_site_url = $this->data['main_site_url'] = $site_settings[0]['site_url'];

        $this->data['title'] = "Email Settings | $main_site_name ";

        $this->data['module_name'] = "Email Settings";

        include('include.php');
        //remove catch so after logout cannot view last visited page if that page is this
        $this->output->set_header('Last-Modified:' . gmdate('D, d M Y H:i:s') . 'GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
        $this->output->set_header('Cache-Control: post-check=0, pre-check=0', false);
        $this->output->set_header('Pragma: no-cache');
    }

    public function index() {

        $this->data['section_title'] = "Email Settings";
        
        
        $email_settings = $this->common->select_data_by_id('email_settings', 'esetting_id', 1, $data = '*', $join_str = array());

        $this->data['host_name'] = $email_settings[0]['host_name'];
        $this->data['out_going_port'] = $email_settings[0]['out_going_port'];
        $this->data['user_name'] = $email_settings[0]['user_name'];
        $this->data['password'] = $email_settings[0]['password'];
        $this->data['receiver_email'] = $email_settings[0]['receiver_email'];
        
        $this->load->view('email_settings/index', $this->data);
    }

    
    public function do_email_settings() {

        $host_name = $this->input->post('host_name');
        $out_going_port = $this->input->post('out_going_port');
        $user_name = $this->input->post('user_name');
        $password = $this->input->post('password');
        $receiver_email = $this->input->post('receiver_email');

        $data = array('host_name' => $host_name, 'out_going_port' => $out_going_port, 'user_name' => $user_name, 'password' => $password, 'receiver_email' => $receiver_email);

        $update_setting = $this->common->update_data($data, 'email_settings', 'esetting_id', 1);
        $this->session->set_flashdata('success', '<div class="alert alert-success"><b>Email Settings Successfully Change.</b></div>');
        redirect('email_settings', 'refresh');
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */