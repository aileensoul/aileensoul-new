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


 public function add_gov_category() 
 {

        $this->data['title'] = 'Goverment Job Category| Aileensoul';
        $this->data['module_name'] = 'Goverment Job Category';
        $this->data['section_title'] = 'Goverment Job Category';

        $this->load->view('goverment/add_gov_category', $this->data);
}


public function add_gov_category_insert() 
 {
        //echo "<pre>"; print_r($this->input->post()); die();
         $data = array(
                'name' => $this->input->post('gov_name'),
                'status' => $this->input->post('status'),
                'created_date' => date('Y-m-d H:i:s', time()),
                'is_delete' => '0'
            );

            $insert_id = $this->common->insert_data_getid($data, 'gov_category');


            if ($insert_id) {
                $this->session->set_flashdata('success', 'Category inserted successfully');
                 redirect('goverment/add_gov_category');
            } else {
                $this->session->flashdata('error', 'Sorry!! Your data not inserted');
                redirect('goverment/add_gov_category');
            }

           
}

public function check_category()
{

        $category = $_POST['category'];
        $contition_array = array('name' => $category);
         $checkvalue = $this->common->select_data_by_condition('gov_category', $contition_array, $data = 'id', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
         if($checkvalue){
            echo 'true';
         }else{
            echo 'false';
         }

}

public function view_gov_category(){


        $this->data['title'] = 'Goverment Job Category List| Aileensoul';
        $this->data['module_name'] = 'Goverment Job Category List';
        $this->data['section_title'] = 'Goverment Job Category List';


         $limit = $this->paging['per_page'];
        if ($this->uri->segment(3) != '' && $this->uri->segment(4) != '') {

            $offset = ($this->uri->segment(5) != '') ? $this->uri->segment(5) : 0;

            $sortby = $this->uri->segment(3);

            $orderby = $this->uri->segment(4);

        } else {

            $offset = ($this->uri->segment(3) != '') ? $this->uri->segment(3) : 0;

            $sortby = 'id';

            $orderby = 'asc';

        }
  
        $this->data['offset'] = $offset;

       $data='id,name,created_date,modified_date,status,is_delete';
       $contition_array = array('is_delete' => '0');
        $this->data['category'] = $this->common->select_data_by_condition('gov_category', $contition_array, $data, $sortby, $orderby, $limit, $offset, $join_str = array(), $groupby = '');
// This is userd for pagination offset and limoi End

      //echo "<pre>";print_r($this->data['users'] );die();

        //This if and else use for asc and desc while click on any field start
        if ($this->uri->segment(3) != '' && $this->uri->segment(4) != '') {

            $this->paging['base_url'] = site_url("goverment/view_gov_category/" . $short_by . "/" . $order_by);

        } else {

            $this->paging['base_url'] = site_url("goverment/view_gov_category/");

        }

        if ($this->uri->segment(3) != '' && $this->uri->segment(4) != '') {

            $this->paging['uri_segment'] = 5;

        } else {

            $this->paging['uri_segment'] = 3;

        }
        //This if and else use for asc and desc while click on any field End


        $contition_array = array( 'is_delete =' => '0');
        $this->paging['total_rows'] = count($this->common->select_data_by_condition('gov_category', $contition_array, 'id'));

        $this->data['total_rows'] = $this->paging['total_rows'];

        $this->data['limit'] = $limit;

        $this->pagination->initialize($this->paging);

        $this->data['search_keyword'] = '';

 
        $this->load->view('goverment/view_gov_category', $this->data);

}


//Delete category with ajax Start
public function delete_category() 
{
     $id = $_POST['id'];
      $data = array(
            'is_delete' => '1'
        );

        $update = $this->common->update_data($data, 'gov_category', 'id', $id);
        die();
}
//Delete category with ajax End


 public function edit_gov_category($id) 
 {

        $this->data['title'] = 'Goverment Edit Job Category| Aileensoul';
        $this->data['module_name'] = 'Goverment Edit Job Category';
        $this->data['section_title'] = 'Goverment Edit Job Category';

       $data='id,name,created_date,modified_date,status,is_delete';
       $contition_array = array('id' => $id);
        $this->data['category'] = $this->common->select_data_by_condition('gov_category', $contition_array, $data, $sortby, $orderby, $limit, $offset, $join_str = array(), $groupby = '');

        $this->data['id'] = $id;

        //echo "<pre>"; print_r($this->data['category']); die();

        $this->load->view('goverment/edit_gov_category', $this->data);
}


    public function edit_gov_category_insert($id) 
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

public function add_gov_post() 
 {

        $this->data['title'] = 'Goverment Job Post| Aileensoul';
        $this->data['module_name'] = 'Goverment Job Post';
        $this->data['section_title'] = 'Goverment Job Post';

         $contition_array = array('status' => '1', 'is_delete' => '0');
         $this->data['job_category'] = $this->common->select_data_by_condition('gov_category', $contition_array, $data = 'id,name', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');  

        $this->load->view('goverment/add_gov_post', $this->data);
}



public function add_gov_post_insert() 
 {
        //echo "<pre>"; print_r($this->input->post()); die();

       $date = $this->input->post('selday');
        $month = $this->input->post('selmonth');
        $year = $this->input->post('selyear');
        $last_date = $year . '-' . $month . '-' . $date;



         $data = array(
                'title' => $this->input->post('post_title'),
                'category_id' => $this->input->post('category'),
                'sector' => $this->input->post('gov_sector'),
                'eligibility' => $this->input->post('gov_elg'),
                'last_date' => $last_date,
                'description' => $this->input->post('gov_des'),
                'apply_link' => $this->input->post('gov_link'),
                'status' => $this->input->post('status'),
                'created_date' => date('Y-m-d H:i:s', time()),
                'is_delete' => '0'
            );

            $insert_id = $this->common->insert_data_getid($data, 'gov_post');


            if ($insert_id) {
                $this->session->set_flashdata('success', 'Job Post inserted successfully');
                 redirect('goverment/add_gov_post');
            } else {
                $this->session->flashdata('error', 'Sorry!! Your data not inserted');
                redirect('goverment/add_gov_post');
            }

           
}


public function view_gov_post(){


        $this->data['title'] = 'Goverment Job Post List| Aileensoul';
        $this->data['module_name'] = 'Goverment Job Post List';
        $this->data['section_title'] = 'Goverment Job Post List';


         $limit = $this->paging['per_page'];
        if ($this->uri->segment(3) != '' && $this->uri->segment(4) != '') {

            $offset = ($this->uri->segment(5) != '') ? $this->uri->segment(5) : 0;

            $sortby = $this->uri->segment(3);

            $orderby = $this->uri->segment(4);

        } else {

            $offset = ($this->uri->segment(3) != '') ? $this->uri->segment(3) : 0;

            $sortby = 'id';

            $orderby = 'asc';

        }
  
        $this->data['offset'] = $offset;

       $data='id,title,category_id,sector,eligibility,last_date,description,apply_link,created_date,modified_date,status';
       $contition_array = array('is_delete' => '0');
        $this->data['post'] = $this->common->select_data_by_condition('gov_post', $contition_array, $data, $sortby, $orderby, $limit, $offset, $join_str = array(), $groupby = '');
// This is userd for pagination offset and limoi End

      //echo "<pre>";print_r($this->data['users'] );die();

        //This if and else use for asc and desc while click on any field start
        if ($this->uri->segment(3) != '' && $this->uri->segment(4) != '') {

            $this->paging['base_url'] = site_url("goverment/view_gov_post/" . $short_by . "/" . $order_by);

        } else {

            $this->paging['base_url'] = site_url("goverment/view_gov_post/");

        }

        if ($this->uri->segment(3) != '' && $this->uri->segment(4) != '') {

            $this->paging['uri_segment'] = 5;

        } else {

            $this->paging['uri_segment'] = 3;

        }
        //This if and else use for asc and desc while click on any field End


        $contition_array = array( 'is_delete =' => '0');
        $this->paging['total_rows'] = count($this->common->select_data_by_condition('gov_post', $contition_array, 'id'));

        $this->data['total_rows'] = $this->paging['total_rows'];

        $this->data['limit'] = $limit;

        $this->pagination->initialize($this->paging);

        $this->data['search_keyword'] = '';

 
        $this->load->view('goverment/view_gov_post', $this->data);

}

}

?>