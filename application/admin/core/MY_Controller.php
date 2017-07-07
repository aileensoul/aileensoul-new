<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

    function __construct() {
        parent::__construct();


        if (!$this->session->userdata('dollarbid_admin')) {

            redirect('login', 'refresh');
        } else if ($this->session->userdata('dollarbid_admin') == '0') {
            //unset the user session
            $this->session->unset_userdata('dollarbid_admin');
            $this->session->set_flashdata('error', 'Error Occurred. Try Again.');
            redirect('login', 'refresh');
        }

        $this->data['user_id'] = $admin_data = $this->session->userdata('dollarbid_admin');

        $this->data['loged_in_user']=$this->common->select_data_by_id('admin','admin_id',$admin_data[0]['admin_id'],'admin_username,admin_name,admin_email,admin_image');
        
        //date_default_timezone_get();
        date_default_timezone_set('Asia/Kolkata');
        
    }

    function last_query() {
        echo "<pre>";
        echo $this->db->last_query();
        echo "</pre>";
    }


    
    function sendEmail($app_name='',$app_email='',$to_email='',$subject='',$mail_body='')
    {
        $this->config->load('email', TRUE);
        $this->cnfemail = $this->config->item('email');

        //Loading E-mail Class
        $this->load->library('email');
        $this->email->initialize($this->cnfemail);
        
        $this->email->from($app_email,$app_name);
        
        $this->email->to($to_email);
        
        $this->email->subject($subject);
        
        

                    
        $this->email->message("<table border='0' cellpadding='0' cellspacing='0'><tr><td></td></tr><tr><td>" . $mail_body . "</td></tr></table>");
        $this->email->send();
        return;
    }

}
