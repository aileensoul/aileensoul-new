<?php


if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public $data;

    public function __construct() {
        parent::__construct();
        

        

        include('include.php');
       
    }

    public function index()
     {

        // $contition_array = array('status' => 1, 'is_delete' => 0);

        //     $this->data['art_list'] = $this->common->select_data_by_search('art_reg', $search_condition, $contition_array, '*', $short_by, $order_by, $limit, $offset);




        $condition_array = array('is_delete =' => '0');

        $this->data['art_list'] = $get_users = $this->common->select_data_by_condition('art_reg', $condition_array, $data = '*', $short_by, $order_by, $limit, $offset, $join_str = array());


        $condition_array = array('faq_status =' => 1);

        $this->data['faq_list'] = $get_users = $this->common->select_data_by_condition('faq', $condition_array, $data = '*', $short_by, $order_by, $limit, $offset, $join_str = array());

               

        $condition_array = array('status =' => 1);

        $this->data['job_list'] = $get_users = $this->common->select_data_by_condition('job_reg', $condition_array, $data = '*', $short_by, $order_by, $limit, $offset, $join_str = array());


         $condition_array = array('status =' => 1);

        $this->data['freelancer_list'] = $get_users = $this->common->select_data_by_condition('freelancer_hire_reg', $condition_array, $data = '*', $short_by, $order_by, $limit, $offset, $join_str = array());

         $condition_array = array('status =' => 1);

        $this->data['stream_list'] = $get_users = $this->common->select_data_by_condition('stream', $condition_array, $data = '*', $short_by, $order_by, $limit, $offset, $join_str = array());


         $condition_array1 = array('status =' => '1', 'is_delete =' => '0');


        $this->data['user_list'] = $get_users = $this->common->select_data_by_condition('user', $condition_array1, $data = '*', $short_by, $order_by, $limit, $offset, $join_str = array());

        $condition_array = array('is_deleted =' => '0');



        $this->data['business_list'] = $get_users = $this->common->select_data_by_condition('business_profile', $condition_array, $data = '*', $short_by, $order_by, $limit, $offset, $join_str = array());

        $condition_array = array('is_delete =' => '0');



        $this->data['freelance_post'] = $get_users = $this->common->select_data_by_condition('freelancer_post_reg', $condition_array, $data = '*', $short_by, $order_by, $limit, $offset, $join_str = array());

        $condition_array = array('is_delete =' => '0');


        $this->data['rec_list'] = $get_users = $this->common->select_data_by_condition('recruiter', $condition_array, $data = '*', $short_by, $order_by, $limit, $offset, $join_str = array());


        $condition_array = array('is_delete =' => '0');

        $this->data['degree'] = $get_users = $this->common->select_data_by_condition('degree', $condition_array, $data = '*', $short_by, $order_by, $limit, $offset, $join_str = array());

         $condition_array = array('is_delete =' => '0');

        $this->data['business_type'] = $get_users = $this->common->select_data_by_condition('business_type', $condition_array, $data = '*', $short_by, $order_by, $limit, $offset, $join_str = array());


        $condition_array = array('is_delete =' => '0');

        $this->data['industry_type'] = $get_users = $this->common->select_data_by_condition('industry_type', $condition_array, $data = '*', $short_by, $order_by, $limit, $offset, $join_str = array());




        $this->load->view('dashboard/index',$this->data);





        // print_r($this->data['art_list']);die();
    }

   

}
/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */