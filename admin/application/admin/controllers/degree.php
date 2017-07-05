<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Degree extends CI_Controller {

    public $data;

    public function __construct() {
        parent::__construct();

         

        // Get Site Information
        $site_settings = $this->common->select_data_by_id('site_settings', 'site_id', 1, $data = '*', $join_str = array());
         $main_site_name = $this->data['main_site_name'] = $site_settings[0]['site_name'];
         $main_site_url = $this->data['main_site_url'] = $site_settings[0]['site_url'];

        $this->data['title'] = "Degree Management | $main_site_name ";
         $this->data['module_name'] = "Degree Management";
         $this->load->model('settings');

        include('include.php');
        //remove catch so after logout cannot view last visited page if that page is this
         $this->output->set_header('Last-Modified:' . gmdate('D, d M Y H:i:s') . 'GMT');
         $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
         $this->output->set_header('Cache-Control: post-check=0, pre-check=0', false);
         $this->output->set_header('Pragma: no-cache');
    }

    public function index() {

            // echo "hello";die();
            

         $this->data['section_title'] = "Degree Management";

         $limit = $this->paging['per_page'];



        if ($this->uri->segment(3) != '' && $this->uri->segment(4) != '') {

            $offset = ($this->uri->segment(5) != '') ? $this->uri->segment(5) : 0;

            $short_by = $this->uri->segment(3);

            $order_by = $this->uri->segment(4);

        } else {

            $offset = ($this->uri->segment(3) != '') ? $this->uri->segment(3) : 0;

            $short_by = 'degree_id';

            $order_by = 'asc';

        }



        $this->data['offset'] = $offset;



        $condition_array = array('is_delete =' => '0');



        $this->data['degree'] = $get_users = $this->common->select_data_by_condition('degree', $condition_array, $data = '*', $short_by, $order_by, $limit, $offset, $join_str = array());

        // echo "<pre>"; print_r($this->data['freelance_post']); die();


           // echo "$get_users";

            // print_r( $this->data['business_list']); die();


        if ($this->uri->segment(3) != '' && $this->uri->segment(4) != '') {

            $this->paging['base_url'] = site_url("degree/index/" . $short_by . "/" . $order_by);

        } else {

            $this->paging['base_url'] = site_url("degree/index/");

        }

        if ($this->uri->segment(3) != '' && $this->uri->segment(4) != '') {

            $this->paging['uri_segment'] = 5;

        } else {

            $this->paging['uri_segment'] = 3;

        }



        $contition_array1 = array('is_delete =' => '0');



        $this->paging['total_rows'] = count($this->common->select_data_by_condition('degree', $contition_array1, 'degree_id'));

        $this->data['total_rows'] = $this->paging['total_rows'];

        $this->data['limit'] = $limit;



        //$this->paging['per_page'] = 2;



        $this->pagination->initialize($this->paging);

        $this->data['search_keyword'] = '';

        $this->load->view('degree/index', $this->data);
    }

    public function edit() {
        if ($this->input->post())
         {
            $degree_id = $this->input->post('degree_id');
            $degree_name = $this->input->post('degree_name');

            $data = array('degree_name' => $degree_name, 'modify_date' => date('Y-m-d h:i:s'));

            $update = $this->common->update_data($data, 'degree', 'degree_id', $degree_id);
            if ($update){
                $this->session->set_flashdata('success', ' data successfully updated');
                redirect('degree', 'refresh');
            }
        } else {
            $this->session->set_flashdata('error', 'Sorry something not right');
            redirect('sem', 'refresh');
        }
    }
    public function add()
    {
        // echo "hello"; die();
        $insert_degree= array('degree_name' =>$this->input->post('degree_name') ,
        'created_date' => date('Y-m-d h:i:s'),
        'status' =>'1',
        'is_delete' =>'0',);
        $insert_id = $this->common->insert_data_getid($insert_degree ,'degree');
         redirect('degree', 'refresh');
    }
     public function change_status($id = '', $status = '') {

        // echo "Hello";die();
        // echo $business_profile_id;die();

        if ($id != '' && $status != '') {

            $data = array('status' => $status);

            $update_status = $this->common->update_data($data, 'degree', 'degree_id', $id);



            if ($update_status) {

                $this->session->set_flashdata('success', 'User Status Successfully Changed.');

                redirect('degree', 'refresh');

            }

        }

    }
     public function delete($id = '') {

       // echo "Hello";

       // echo $rec_id; die();

        if ($id != '') {

            $id = base64_decode($id);

           // echo $rec_id; die();

            $data = array('is_delete' => 1);

            $update_status = $this->common->update_data($data, 'degree', 'degree_id', $id);



            if ($update_status) {

                $this->session->set_flashdata('success', 'User Successfully Delete.');

                redirect('degree', 'refresh');

            }

        }

    }
   
}
