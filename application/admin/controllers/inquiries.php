<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Inquiries extends MY_Controller {

    public $data;
   

    public function __construct() {

        parent::__construct();
        
        //$GLOBALS['record_per_page']=10;
        //site setting details
        $site_name_values = $this->common->select_data_by_id('settings', 'setting_id', '1', '*');
        $this->data['site_name'] = $site_name = $site_name_values[0]['setting_value'];
        //set header, footer and leftmenu
        $this->data['title'] = 'Inquiries : ' . $site_name;
        $this->data['header'] = $this->load->view('header', $this->data);
        $this->data['leftmenu'] = $this->load->view('leftmenu', $this->data);
        $this->data['footer'] = $this->load->view('footer', $this->data,true);


        $this->load->model('common');

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

    //display user list
   public function index() {

        if ($this->session->userdata('user_search_keyword')) {
            $this->session->unset_userdata('user_search_keyword');
        }

        $this->data['module_name'] = 'Inquiries';
        $this->data['section_title'] = 'Inquiries';
        
        $limit =$this->paging['per_page'];
        if ($this->uri->segment(3) != '' && $this->uri->segment(4) != '') {
            $offset = ($this->uri->segment(5) != '') ? $this->uri->segment(5) : 0;
            $short_by = $this->uri->segment(3);
            $order_by = $this->uri->segment(4);
        } else {
            $offset = ($this->uri->segment(3) != '') ? $this->uri->segment(3) : 0;
            $short_by = 'inquieryid';
            $order_by = 'desc';
        }

        $this->data['offset'] = $offset;
        $contition_array=array();
        //$contition_array = array('username != ' => 'client');
        
        
        $this->data['inquiries_list'] = $this->common->select_data_by_condition('inquiries', $contition_array, '*', $short_by, $order_by, $limit, $offset);
        if ($this->uri->segment(3) != '' && $this->uri->segment(4) != '') {
            $this->paging['base_url'] = site_url("inquiries/index/" . $short_by . "/" . $order_by);
        } else {
            $this->paging['base_url'] = site_url("inquiries/index/");
        }
        if ($this->uri->segment(3) != '' && $this->uri->segment(4) != '') {
            $this->paging['uri_segment'] = 5;
        } else {
            $this->paging['uri_segment'] = 3;
        }
      
        
        $this->paging['total_rows'] = count($this->common->select_data_by_condition('inquiries', $contition_array, 'inquieryid'));
        $this->data['total_rows']=$this->paging['total_rows'];
        $this->data['limit']=$limit;
        //$this->paging['per_page'] = 2;

        $this->pagination->initialize($this->paging);
        $this->data['search_keyword'] = '';
        $this->load->view('inquiries/index', $this->data);
    }

    //search the user
  
   public function search() {
        $this->data['module_name'] = 'Inquiries';
        $this->data['section_title'] = 'Inquiries Search';

       

        if ($this->input->post('search_keyword')) {

            $this->data['search_keyword'] = $search_keyword = $this->input->post('search_keyword');

            $this->session->set_userdata('user_search_keyword', $search_keyword);
            $limit = $this->paging['per_page'];
            if ($this->uri->segment(3) != '' && $this->uri->segment(4) != '') {
                $offset = ($this->uri->segment(5) != '') ? $this->uri->segment(5) : 0;
                $short_by = $this->uri->segment(3);
                $order_by = $this->uri->segment(4);
            } else {
                $offset = ($this->uri->segment(3) != '') ? $this->uri->segment(3) : 0;
                $short_by = 'inquieryid';
                $order_by = 'asc';
            }
            $this->data['offset'] = $offset;
            //prepare search condition
            $search_condition = "(name LIKE '%$search_keyword%' OR subject LIKE '%$search_keyword%' OR email LIKE '%$search_keyword%')";



            $contition_array = array();
            $this->data['inquiries_list'] = $this->common->select_data_by_search('inquiries', $search_condition, $contition_array, '*', $short_by, $order_by, $limit, $offset);

            if ($this->uri->segment(3) != '' && $this->uri->segment(4) != '') {
                $this->paging['base_url'] = site_url("inquiries/search/" . $short_by . "/" . $order_by);
            } else {
                $this->paging['base_url'] = site_url("inquiries/search/");
            }


            if ($this->uri->segment(3) != '' && $this->uri->segment(4) != '') {
                $this->paging['uri_segment'] = 5;
            } else {
                $this->paging['uri_segment'] = 3;
            }
            $this->paging['total_rows'] = count($this->common->select_data_by_search('inquiries', $search_condition, $contition_array, 'inquieryid'));

            //for record display
            $this->data['total_rows'] = $this->paging['total_rows'];
            $this->data['limit'] = $limit;


            $this->pagination->initialize($this->paging);
        } else if ($this->session->userdata('user_search_keyword')) {
            $this->data['search_keyword'] = $search_keyword = $this->session->userdata('user_search_keyword');

            $limit = $this->paging['per_page'];
            if ($this->uri->segment(3) != '' && $this->uri->segment(4) != '') {
                $offset = ($this->uri->segment(5) != '') ? $this->uri->segment(5) : 0;
                $short_by = $this->uri->segment(3);
                $order_by = $this->uri->segment(4);
            } else {
                $offset = ($this->uri->segment(3) != '') ? $this->uri->segment(3) : 0;
                $short_by = 'inquieryid';
                $order_by = 'asc';
            }
            $this->data['offset'] = $offset;
            //prepare search condition
            $search_condition = "(name LIKE '%$search_keyword%' OR subject LIKE '%$search_keyword%' OR email LIKE '%$search_keyword%')";

            $contition_array = array();
            $this->data['inquiries_list'] = $this->common->select_data_by_search('inquiries', $search_condition, $contition_array, '*', $short_by, $order_by, $limit, $offset);

            if ($this->uri->segment(3) != '' && $this->uri->segment(4) != '') {
                $this->paging['base_url'] = site_url("inquiries/search/" . $short_by . "/" . $order_by);
            } else {
                $this->paging['base_url'] = site_url("inquiries/search/");
            }


            if ($this->uri->segment(3) != '' && $this->uri->segment(4) != '') {
                $this->paging['uri_segment'] = 5;
            } else {
                $this->paging['uri_segment'] = 3;
            }
            $this->paging['total_rows'] = count($this->common->select_data_by_search('inquiries', $search_condition, $contition_array, 'inquieryid'));

            $this->data['total_rows'] = $this->paging['total_rows'];
            $this->data['limit'] = $limit;

            $this->pagination->initialize($this->paging);
        }
        $this->load->view('inquiries/index', $this->data);
    }
    
    public function get_detail() {
        if ($this->input->is_ajax_request() && $this->input->post('id')) {
            $id = $this->input->post('id');
            $contition_array = array('inquieryid' => $id);
            

            $inquiries_detail = $this->common->select_data_by_condition('inquiries', $contition_array);


            $detail_html = '';
            $detail_html.='<div class="widget box">
                        
                        <div class="widget-content no-padding">
                                <table class="table table-hover table-responsive table-striped table-bordered table-highlight-head">

                                        <tbody>';
            if (count($inquiries_detail) > 0) {
                foreach ($inquiries_detail as $inquiries) {
                    
                    $detail_html.= '  
                        <tr>
                                <td><b>Name</b></td>
                                <td>' . $inquiries['name']. '</td>
                        </tr>
                        <tr>
                                <td><b>Email</b></td>
                                <td>' . $inquiries['email']. '</td>
                        </tr>
                        <tr>
                                <td><b>Subject</b></td>
                                <td>' . $inquiries['subject']. '</td>
                        </tr>
                        <tr>
                                <td><b>Message</b></td>
                                <td>' . $inquiries['discription']. '</td>
                        </tr>
                        
                        
                       ';
                }
            } else {
                $detail_html.= '<tr><td><b>No Detail Available</b></td></tr>';
            }
            $detail_html.= '   </tbody>
                           </table>             
                        </div>
                </div>';
            echo $detail_html;
            die();
        }
    }

    
     public function clear_search() {
        $this->session->unset_userdata('user_search_keyword');
        redirect('inquiries', 'refresh');
    }
    
    public function change_status() {
        
        $inquieryid=$this->input->post('inquieryid');
        $status=$this->input->post('status');
        
        if ($inquieryid == '' || $inquieryid <= 0 || $status == '') {
            $this->session->set_flashdata('error', 'Error Occurred. Try Agaim!');
            redirect('inquiries', 'refresh');
        }
        


        $update_data = array('status' => $status);

        $update_result = $this->common->update_data($update_data, 'inquiries', 'inquieryid', $inquieryid);
        if (isset($_SERVER['HTTP_REFERER'])) {
            $redirect_url = $_SERVER['HTTP_REFERER'];
        } else {
            $redirect_url = site_url('inquiries');
        }
        if ($update_result) {
            $this->session->set_flashdata('success', 'status successfully changed');
            redirect($redirect_url, 'refresh');
        } else {
            $this->session->set_flashdata('error', 'Error Occurred. Try Again!');
            redirect($redirect_url, 'refresh');
        }
    }
}

?>