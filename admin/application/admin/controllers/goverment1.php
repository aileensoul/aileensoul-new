<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Goverment extends MY_Controller {

    public $data;
 

    public function __construct() {

      parent::__construct();

        if (!$this->session->userdata('aileen_admin')) 
        {
            redirect('login', 'refresh');
        }
   
    
         //Loadin Pagination Custome Config File
         $this->config->load('paging', TRUE);
         $this->paging = $this->config->item('paging');
         include('include.php');
         $adminid =  $this->session->userdata('aileen_admin');
   
       // echo $this->profile->thumb();
    }


    public function edit_gov_post_insert($id) 
 {
        //echo "<pre>"; print_r($this->input->post()); die();
         $data = array(
                'name' => $this->input->post('gov_name'),
                'status' => $this->input->post('status'),
                'modified_date' => date('Y-m-d H:i:s', time()),
            );

            $updatdata = $this->common->update_data($data, 'gov_category', 'id', $id);

            if ($updatdata) {
                $this->session->set_flashdata('success', 'Category updated successfully');
                 redirect('goverment/view_gov_category');
            } else {
                $this->session->flashdata('error', 'Sorry!! Your data not inserted');
                redirect('goverment/edit_gov_category/'.$id);
            }
           
}




}

?>