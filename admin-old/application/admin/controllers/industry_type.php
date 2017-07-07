<?php



if (!defined('BASEPATH'))

    exit('No direct script access allowed');



class industry_type extends CI_Controller {



    public $data;



    public function __construct() {

        parent::__construct();





        // Get Site Information

       

        $this->data['title'] = "Industry Type Management | $main_site_name ";

        $this->data['module_name'] = "Industry Type Management";

        include('include.php');



//         //Loadin Pagination Custome Config File

//         $this->config->load('paging', TRUE);

//         $this->paging = $this->config->item('paging');

// //        print_r($this->paging);

// //        die();

//         //remove catch so after logout cannot view last visited page if that page is this

//         $this->output->set_header('Last-Modified:' . gmdate('D, d M Y H:i:s') . 'GMT');

//         $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');

//         $this->output->set_header('Cache-Control: post-check=0, pre-check=0', false);

//         $this->output->set_header('Pragma: no-cache');

    }



  public function index() {

        $this->data['section_title'] = "Industry Management List";





        $limit = $this->paging['per_page'];



        if ($this->uri->segment(3) != '' && $this->uri->segment(4) != '') {

            $offset = ($this->uri->segment(5) != '') ? $this->uri->segment(5) : 0;

            $short_by = $this->uri->segment(3);

            $order_by = $this->uri->segment(4);

        } else {

            $offset = ($this->uri->segment(3) != '') ? $this->uri->segment(3) : 0;

            $short_by = 'industry_id';

            $order_by = 'asc';

        }



        $this->data['offset'] = $offset;



        $condition_array = array( 'is_delete =' => '0');



        $this->data['industry_type_list'] = $get_users = $this->common->select_data_by_condition('industry_type', $condition_array, $data = '*', $short_by, $order_by, $limit, $offset, $join_str = array());


           // echo "$get_users";

            //print_r('rec_list'); die();


        if ($this->uri->segment(3) != '' && $this->uri->segment(4) != '') {

            $this->paging['base_url'] = site_url("industry_type/index/" . $short_by . "/" . $order_by);

        } else {

            $this->paging['base_url'] = site_url("industry_type/index/");

        }

        if ($this->uri->segment(3) != '' && $this->uri->segment(4) != '') {

            $this->paging['uri_segment'] = 5;

        } else {

            $this->paging['uri_segment'] = 3;

        }


        $contition_array1 = array( 'is_delete =' => '0');



        $this->paging['total_rows'] = count($this->common->select_data_by_condition('industry_type', $contition_array1, 'industry_id'));

        $this->data['total_rows'] = $this->paging['total_rows'];

        $this->data['limit'] = $limit;

        //$this->paging['per_page'] = 2;


        $this->pagination->initialize($this->paging);

        $this->data['search_keyword'] = '';

        $this->load->view('industry_type/index', $this->data);

    }


public function search() {

        $this->data['section_title'] = "industry_type Management List";

        //query for difficulty 



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

                $short_by = 'industry_id';

                $order_by = 'asc';

            }

            $this->data['offset'] = $offset;

            //prepare search condition

            $search_condition = "(industry_type_name LIKE '%$search_keyword%' OR degree_id LIKE '%$search_keyword%' )";



            $contition_array = array('status' => 1);

            $this->data['industry_type_list'] = $this->common->select_data_by_search('industry_type', $search_condition, $contition_array, '*', $short_by, $order_by, $limit, $offset);



            if ($this->uri->segment(3) != '' && $this->uri->segment(4) != '') {

                $this->paging['base_url'] = site_url("industry_type/search/" . $short_by . "/" . $order_by);

            } else {

                $this->paging['base_url'] = site_url("industry_type/search/");

            }



            if ($this->uri->segment(3) != '' && $this->uri->segment(4) != '') {

                $this->paging['uri_segment'] = 5;

            } else {

                $this->paging['uri_segment'] = 3;

            }

            $this->paging['total_rows'] = count($this->common->select_data_by_search('industry_type', $search_condition, $contition_array, 'industry_id'));



            //for record display

            $this->data['total_rows'] = $this->paging['total_rows'];

            $this->data['limit'] = $limit;





            $this->pagination->initialize($this->paging);

        } else if ($this->session->userdata('admin_search_keyword')) {

            $this->data['search_keyword'] = $search_keyword = $this->session->userdata('admin_search_keyword');



            $limit = $this->paging['per_page'];

            if ($this->uri->segment(3) != '' && $this->uri->segment(4) != '') {

                $offset = ($this->uri->segment(5) != '') ? $this->uri->segment(5) : 0;

                $short_by = $this->uri->segment(3);

                $order_by = $this->uri->segment(4);

            } else {

                $offset = ($this->uri->segment(3) != '') ? $this->uri->segment(3) : 0;

                $short_by = 'industry_id';

                $order_by = 'asc';

            }

            $this->data['offset'] = $offset;

            //prepare search condition

            $search_condition = "(industry_type_name LIKE '%$search_keyword%' OR degree_id LIKE '%$search_keyword%')";



            $contition_array = array();

            $this->data['industry_type_list'] = $this->common->select_data_by_search('industry_type', $search_condition, $contition_array, '*', $short_by, $order_by, $limit, $offset);



            if ($this->uri->segment(3) != '' && $this->uri->segment(4) != '') {

                $this->paging['base_url'] = site_url("industry_type/search/" . $short_by . "/" . $order_by);

            } else {

                $this->paging['base_url'] = site_url("industry_type/search/");

            }



            if ($this->uri->segment(3) != '' && $this->uri->segment(4) != '') {

                $this->paging['uri_segment'] = 5;

            } else {

                $this->paging['uri_segment'] = 3;

            }

            $this->paging['total_rows'] = count($this->common->select_data_by_search('industry_type', $search_condition, $contition_array, 'industry_id'));



            $this->data['total_rows'] = $this->paging['total_rows'];

            $this->data['limit'] = $limit;



            $this->pagination->initialize($this->paging);

        }

        $this->load->view('industry_type/index', $this->data);

    }



  
    //add new user

    public function add($id = '') 
    {

         

        $this->data['section_title'] = "Add";


        $contition_array = array('status' => '1', 'is_delete' => '0');
        $this->data['business'] = $this->common->select_data_by_condition('business_type', $contition_array, $data = '*', $sortby = 'business_type', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');



        $this->load->view('industry_type/add', $this->data);

    }


    public function add_insert()
    {

       
         // echo "<pre>"; print_r($_POST); die();
         //$type_id = $this->input->post('business_type');
   $business = $this->input->post('business');
         // echo $s; die();

      $contition_array = array('status' => '1', 'is_delete' => '0');
        $this->data['business'] = $this->common->select_data_by_condition('business_type', $contition_array, $data = '*', $sortby = 'business_type', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');



            $data = array(
                 
                 'industry_name' => $this->input->post('industry_name'),
                  'status' => 1,
                 'is_delete' => 0,
                 'created_date' => date('Y-m-d h:i:s',time()),
                 'type_id'=>implode(",", $business),

        ); 

        // echo "<pre>";print_r($data);die();
        $insert_id = $this->common->insert_data_getid($data,'industry_type'); 

        if($insert_id)
        { 
              redirect('industry_type/index');
          
        }
       else
        {
                $this->session->flashdata('error','Sorry!! Your data not inserted');
               redirect('industry_type/add', 'refresh');
        }
      
       
    }




    public function edit($id = "") 
    {

        $this->data['section_title'] = "Edit industry_type Management";

        $id = base64_decode($id);


        // $contition_array = array('status' => '1', 'is_delete' => '0');
        // $this->userdata['users'] = $this->common->select_data_by_condition('user', $contition_array, $data = '*', $sortby = 'user_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');

            


          $contition_array = array('industry_id' => $id);

        $this->industry_typedata['industry_type'] = $this->common->select_data_by_condition('industry_type',$contition_array, $data = '*', $sortby ='', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');


       

        $this->load->view('industry_type/edit',$this->industry_typedata);

    }



       public function edit_insert($id) 
    {

        $this->data['section_title'] = "Edit industry type Management";

        $id = base64_decode($id);

        // print_r($id); die();

           $business = $this->input->post('business');
         $contition_array = array('status' => '1', 'is_delete' => '0');
        $this->data['business'] = $this->common->select_data_by_condition('business_type', $contition_array, $data = '*', $sortby = 'business_type', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');



       

      

            $data = array(
                 
                 'industry_type_name' => $this->input->post('industry_type_name'),
              
                  'status' => 1,
                 'is_delete' => 0,
                 'modify_date' => date('Y-m-d h:i:s',time()),
                 'type_id'=>implode(",", $business),
              
        ); 


        

        // echo "<pre>";print_r($data);die();

            $varid = $this->input->post('industry_id');

            // print_r($varid);die();
              $update= $this->common->update_data($data, 'industry_type', 'industry_id', $varid);
        

        if($update)
        { 
              redirect('industry_type/index');
          
        }
       else
        {
                $this->session->flashdata('error','Sorry!! Your data not inserted');
               redirect('industry_type/edit', 'refresh');
        }
      



        $this->load->view('industry_type/edit');

    }



    public function change_status($industry_id = '', $status = '') {



        if ($industry_id != '' && $status != '') {

            $data = array('status' => $status);

            $update_status = $this->common->update_data($data, 'industry_type', 'industry_id', $industry_id);



            if ($update_status) {

                $this->session->set_flashdata('success', 'User Status Successfully Changed.');

                redirect('industry_type', 'refresh');

            }


 redirect('industry_type', 'refresh');

        }

    }



    public function delete($industry_id = '') {

        if ($industry_id != '')
         {

            $industry_id = base64_decode($industry_id);

            // $data = array('is_delete' => 0);

            $delete_status = $this->common->delete_data('industry_type','industry_id',$industry_id);



            if ($delete_status)
             {

                $this->session->set_flashdata('success', 'User Successfully Delete.');

                redirect('industry_type', 'refresh');

            }

        }

    }

   

}



/* End of file welcome.php 

/* Location: ./application/controllers/welcome.php */