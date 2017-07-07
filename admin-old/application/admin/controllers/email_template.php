<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Email_template extends CI_Controller {

    public $data;

    public function __construct() {
        parent::__construct();

       
        // Get Site Information
        $site_settings = $this->common->select_data_by_id('site_settings', 'site_id', 1, $data = '*', $join_str = array());
        $main_site_name = $this->data['main_site_name'] = $site_settings[0]['site_name'];
        $main_site_url = $this->data['main_site_url'] = $site_settings[0]['site_url'];

        $this->data['title'] = "Email Template | $main_site_name ";

        $this->data['module_name'] = "Email Template";
        
        include('include.php');
        
        
        //Loadin Pagination Custome Config File
        $this->config->load('paging', TRUE);
        $this->paging = $this->config->item('paging');
        //print_r($this->paging);
        //die();

        
        //remove catch so after logout cannot view last visited page if that page is this
        $this->output->set_header('Last-Modified:' . gmdate('D, d M Y H:i:s') . 'GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
        $this->output->set_header('Cache-Control: post-check=0, pre-check=0', false);
        $this->output->set_header('Pragma: no-cache');
    }

    public function index() {

        $this->data['section_title'] = "View Email Template";
        
       $limit =$this->paging['per_page'];
        
        if ($this->uri->segment(3) != '' && $this->uri->segment(4) != '') {
            $offset = ($this->uri->segment(5) != '') ? $this->uri->segment(5) : 0;
            $short_by = $this->uri->segment(3);
            $order_by = $this->uri->segment(4);
        } else {
            $offset = ($this->uri->segment(3) != '') ? $this->uri->segment(3) : 0;
            $short_by = 'emailid';
            $order_by = 'asc';
        }

        $this->data['offset'] = $offset;
        $contition_array=array('email_status' => '1' );
        //$contition_array = array('username != ' => 'client');
        
        
        $this->data['emailformat_list'] = $this->common->select_data_by_condition('emails', $contition_array, '*', $short_by, $order_by, $limit, $offset);
        if ($this->uri->segment(3) != '' && $this->uri->segment(4) != '') {
            $this->paging['base_url'] = site_url("email_template/index/" . $short_by . "/" . $order_by);
        } else {
            $this->paging['base_url'] = site_url("email_template/index/");
        }
        if ($this->uri->segment(3) != '' && $this->uri->segment(4) != '') {
            $this->paging['uri_segment'] = 5;
        } else {
            $this->paging['uri_segment'] = 3;
        }
        //for my use
        
        //$this->data['offset']=$offset;
        
        $this->paging['total_rows'] = count($this->common->select_data_by_condition('emails', $contition_array, 'emailid'));
        $this->data['total_rows']=$this->paging['total_rows'];
        $this->data['limit']=$limit;
        //$this->paging['per_page'] = 2;
        
        $this->pagination->initialize($this->paging);
        $this->data['search_keyword'] = '';
        $this->load->view('email_template/index', $this->data);
    }

    //update the user detail
    public function edit($id = '') {
       
        if ($this->input->post()) {
            
            //$get_uniquename = $this->common->select_data_by_id('emails', 'uniquename', $this->input->post('uniquename'));                     
            
            $update_array = array(
                'vartitle'=>trim($this->input->post('vartitle')),
                'uniquename'=>trim($this->input->post('uniquename')),                
                'varsubject'=>trim($this->input->post('varsubject')),
                'varmailformat'=>  htmlentities($this->input->post('varmailformat')),                          
           
            );
//           echo $this->input->post('emailid');
//           exit;
            
            $update_result = $this->common->update_data($update_array, 'emails', 'emailid', $this->input->post('emailid'));
           
            if ($this->input->post('redirect_url')) {
                $redirect_url = $this->input->post('redirect_url');
            } else {
                $redirect_url = site_url('email_template') ;
            }

            if ($update_result) {
                
                $this->session->set_flashdata('success', 'Email Format successfully updated.');
                redirect($redirect_url, 'refresh');
            } else {
                $this->session->set_flashdata('error', 'Errorin Occurred. Try Again!');
                redirect($redirect_url, 'refresh');
            }
        }
    
        $id = base64_decode($id);
        $emailformat_detail = $this->common->select_data_by_id('emails', 'emailid', $id, '*');
        
        if ($emailformat_detail) {
            $this->data['section_title'] = 'Edit Email Format';
            
            $this->data['emailformat_detail'] = $emailformat_detail;
            $this->load->view('email_template/edit', $this->data);
        } else {
            $this->session->set_flashdata('error', 'Errorout Occurred. Try Again.');
            redirect('email_template', 'refresh');
        }
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */