<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Feedback extends CI_Controller {

    public $data;

    public function __construct() {
        parent::__construct();


        // Get Site Information
        $site_settings = $this->common->select_data_by_id('site_settings', 'site_id', 1, $data = '*', $join_str = array());
        $main_site_name = $this->data['main_site_name'] = $site_settings[0]['site_name'];
        $main_site_url = $this->data['main_site_url'] = $site_settings[0]['site_url'];

        $this->data['title'] = "Feedback | $main_site_name ";
        $this->data['module_name'] = "Feedback";

        include('include.php');
        
        //Loadin Pagination Custome Config File
        $this->config->load('paging', TRUE);
        $this->paging = $this->config->item('paging');
        
         // Load Relation Model

        $this->load->model('relation');
        
        $this->load->model('settings');
        
        //remove catch so after logout cannot view last visited page if that page is this
        $this->output->set_header('Last-Modified:' . gmdate('D, d M Y H:i:s') . 'GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
        $this->output->set_header('Cache-Control: post-check=0, pre-check=0', false);
        $this->output->set_header('Pragma: no-cache');
    }

    public function index() {

        $this->data['section_title'] = "View Feedback";
       $limit = $this->paging['per_page'];
      
        if ($this->uri->segment(3) != '' && $this->uri->segment(4) != '') {
            $offset = ($this->uri->segment(5) != '') ? $this->uri->segment(5) : 0;
            $short_by = $this->uri->segment(3);
            $order_by = $this->uri->segment(4);
        } else {
            $offset = ($this->uri->segment(3) != '') ? $this->uri->segment(3) : 0;
            $short_by = 'feedback_id';
            $order_by = 'desc';
        }
 $contition_array1=array('feedback_id !=' =>'', 'is_delete' => 0);
        $this->data['offset'] = $offset;
        $this->data['feedback_list'] = $feedback_list = $this->common->select_data_by_condition('feedback',$contition_array1,'*',$sortby = '', $orderby = '', $limit, $offset, $join_str = array());
//echo '<pre>'; print_r($feedback_list); die();
        
        if ($this->uri->segment(3) != '' && $this->uri->segment(4) != '') {
            $this->paging['base_url'] = site_url("feedback/index/" . $short_by . "/" . $order_by);
        } else {
            $this->paging['base_url'] = site_url("feedback/index/");
        }
        if ($this->uri->segment(3) != '' && $this->uri->segment(4) != '') {
            $this->paging['uri_segment'] = 5;
        } else {
            $this->paging['uri_segment'] = 3;
        }
        
        
        $contition_array1=array('feedback_id !=' =>'');
        $search_condition = "('driver_name' != '')";
        $this->paging['total_rows'] = count($this->common->select_data_by_search('feedback',$search_condition, $contition_array1, '*'));
        $this->data['total_rows'] = $this->paging['total_rows'];
        $this->data['limit'] = $limit;
     
        $this->pagination->initialize($this->paging);
        
        $this->load->view('feedback/index', $this->data);
    }

      public function delete($id) {
   

   if($id)
                 {
                         $data = array(
                          'is_delete' => 1,
                          ); 
               
              $updatdata =   $this->common->update_data($data,'feedback','feedback_id',$id);

                  if($updatdata){ 
                        $this->session->set_flashdata('success', ' Feedback deleted successfully');
                        redirect('feedback', refresh);
                  }else{
                            $this->session->flashdata('error','Sorry!! Feedback not deleted');
                            redirect('feedback', refresh);
                  }

      }

  }

}
