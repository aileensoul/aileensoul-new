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


   public function edit_gov_post_insert($id ='') 
 {
        
        $date = $this->input->post('selday');
        $month = $this->input->post('selmonth');
        $year = $this->input->post('selyear');
        $last_date = $year . '-' . $month . '-' . $date;
        
        
        $data = array(
                'title' => $this->input->post('post_title'),
                'category_id' => $this->input->post('category'),
                'post_name' => $this->input->post('postname'),
                'no_vacancies' => $this->input->post('novacan'),
                'pay_scale' => $this->input->post('payscale'),
                'job_location' => $this->input->post('jobloc'),
                'req_exp' => $this->input->post('reqexp'),
                'sector' => $this->input->post('gov_sector'),
                'eligibility' => $this->input->post('gov_elg'),
                'last_date' => $last_date,
                'description' => $this->input->post('gov_des'),
                'apply_link' => $this->input->post('gov_link'),
                'status' => $this->input->post('status'),
                'created_date' => date('Y-m-d H:i:s', time()),
                'is_delete' => '0',
                'modified_date'=> date('Y-m-d H:i:s', time())
            );
        
        
      //  echo "<pre>"; print_r($this->input->post()); die();
         

            $updatdata = $this->common->update_data($data, 'gov_post', 'id', $id);

            if ($updatdata) {
                $this->session->set_flashdata('success', 'Category updated successfully');
                 redirect('goverment/view_gov_post');
            } else {
                $this->session->flashdata('error', 'Sorry!! Your data not inserted');
                redirect('goverment/edit_gov_category/'.$id);
            }
           
}





}

?>