<?php



if (!defined('BASEPATH'))

    exit('No direct script access allowed');



class Stream extends CI_Controller {



    public $data;



    public function __construct() {

        parent::__construct();





        // Get Site Information

       

        $this->data['title'] = "Degree Stream Management | $main_site_name ";

        $this->data['module_name'] = "Degree Stream Management";

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

        $this->data['section_title'] = "stream Management List";





        $limit = $this->paging['per_page'];



        if ($this->uri->segment(3) != '' && $this->uri->segment(4) != '') {

            $offset = ($this->uri->segment(5) != '') ? $this->uri->segment(5) : 0;

            $short_by = $this->uri->segment(3);

            $order_by = $this->uri->segment(4);

        } else {

            $offset = ($this->uri->segment(3) != '') ? $this->uri->segment(3) : 0;

            $short_by = 'stream_id';

            $order_by = 'asc';

        }



        $this->data['offset'] = $offset;



        $condition_array = array( 'is_delete =' => '0');



        $this->data['stream_list'] = $get_users = $this->common->select_data_by_condition('stream', $condition_array, $data = '*', $short_by, $order_by, $limit, $offset, $join_str = array());


           // echo "$get_users";

            //print_r('rec_list'); die();


        if ($this->uri->segment(3) != '' && $this->uri->segment(4) != '') {

            $this->paging['base_url'] = site_url("stream/index/" . $short_by . "/" . $order_by);

        } else {

            $this->paging['base_url'] = site_url("stream/index/");

        }

        if ($this->uri->segment(3) != '' && $this->uri->segment(4) != '') {

            $this->paging['uri_segment'] = 5;

        } else {

            $this->paging['uri_segment'] = 3;

        }


        $contition_array1 = array( 'is_delete =' => '0');



        $this->paging['total_rows'] = count($this->common->select_data_by_condition('stream', $contition_array1, 'stream_id'));

        $this->data['total_rows'] = $this->paging['total_rows'];

        $this->data['limit'] = $limit;

        //$this->paging['per_page'] = 2;


        $this->pagination->initialize($this->paging);

        $this->data['search_keyword'] = '';

        $this->load->view('stream/index', $this->data);

    }


public function search() {

        $this->data['section_title'] = "Stream Management List";

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

                $short_by = 'stream_id';

                $order_by = 'asc';

            }

            $this->data['offset'] = $offset;

            //prepare search condition

            $search_condition = "(stream_name LIKE '%$search_keyword%' OR degree_id LIKE '%$search_keyword%' )";



            $contition_array = array('status' => 1);

            $this->data['stream_list'] = $this->common->select_data_by_search('stream', $search_condition, $contition_array, '*', $short_by, $order_by, $limit, $offset);



            if ($this->uri->segment(3) != '' && $this->uri->segment(4) != '') {

                $this->paging['base_url'] = site_url("stream/search/" . $short_by . "/" . $order_by);

            } else {

                $this->paging['base_url'] = site_url("stream/search/");

            }



            if ($this->uri->segment(3) != '' && $this->uri->segment(4) != '') {

                $this->paging['uri_segment'] = 5;

            } else {

                $this->paging['uri_segment'] = 3;

            }

            $this->paging['total_rows'] = count($this->common->select_data_by_search('stream', $search_condition, $contition_array, 'stream_id'));



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

                $short_by = 'stream_id';

                $order_by = 'asc';

            }

            $this->data['offset'] = $offset;

            //prepare search condition

            $search_condition = "(stream_name LIKE '%$search_keyword%' OR degree_id LIKE '%$search_keyword%')";



            $contition_array = array();

            $this->data['stream_list'] = $this->common->select_data_by_search('stream', $search_condition, $contition_array, '*', $short_by, $order_by, $limit, $offset);



            if ($this->uri->segment(3) != '' && $this->uri->segment(4) != '') {

                $this->paging['base_url'] = site_url("stream/search/" . $short_by . "/" . $order_by);

            } else {

                $this->paging['base_url'] = site_url("stream/search/");

            }



            if ($this->uri->segment(3) != '' && $this->uri->segment(4) != '') {

                $this->paging['uri_segment'] = 5;

            } else {

                $this->paging['uri_segment'] = 3;

            }

            $this->paging['total_rows'] = count($this->common->select_data_by_search('stream', $search_condition, $contition_array, 'stream_id'));



            $this->data['total_rows'] = $this->paging['total_rows'];

            $this->data['limit'] = $limit;



            $this->pagination->initialize($this->paging);

        }

        $this->load->view('stream/index', $this->data);

    }



  
    //add new user

    public function add($id = '') 
    {

         

        $this->data['section_title'] = "Add";


        $contition_array = array('status' => '1', 'is_delete' => '0');
        $this->degreedata['degrees'] = $this->common->select_data_by_condition('degree', $contition_array, $data = '*', $sortby = 'degree_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');



        $this->load->view('stream/add', $this->degreedata);

    }


    public function add_insert()
    {

       
         // echo "<pre>"; print_r($_POST); die();
         $degreeid = $this->input->post('degree_name');

         // echo $s; die();

      

            $data = array(
                 
                 'stream_name' => $this->input->post('stream_name'),
                  'status' => 1,
                 'is_delete' => 0,
                 'created_date' => date('Y-m-d h:i:s',time()),
                'degree_id'=> $degreeid

        ); 

        // echo "<pre>";print_r($data);die();
        $insert_id = $this->common->insert_data_getid($data,'stream'); 

        if($insert_id)
        { 
              redirect('stream/index');
          
        }
       else
        {
                $this->session->flashdata('error','Sorry!! Your data not inserted');
               redirect('stream/add', 'refresh');
        }
      
       
    }




    public function edit($id = "") 
    {

        $this->data['section_title'] = "Edit stream Management";

        $id = base64_decode($id);


        // $contition_array = array('status' => '1', 'is_delete' => '0');
        // $this->userdata['users'] = $this->common->select_data_by_condition('user', $contition_array, $data = '*', $sortby = 'user_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');

            


          $contition_array = array('stream_id' => $id);

        $this->streamdata['stream'] = $this->common->select_data_by_condition('stream',$contition_array, $data = '*', $sortby ='', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');


       

        $this->load->view('stream/edit',$this->streamdata);

    }



       public function edit_insert($id) 
    {

        $this->data['section_title'] = "Edit stream Management";

        $id = base64_decode($id);

        // print_r($id); die();

          $degreeid = $this->input->post('degree_id');

       

      

            $data = array(
                 
                 'stream_name' => $this->input->post('stream_name'),
              
                  'status' => 1,
                 'is_delete' => 0,
                 'modify_date' => date('Y-m-d h:i:s',time()),
                'degree_id'=> $degreeid,
              
        ); 


        

        // echo "<pre>";print_r($data);die();

            $varid = $this->input->post('stream_id');

            // print_r($varid);die();
              $update= $this->common->update_data($data, 'stream', 'stream_id', $varid);
        

        if($update)
        { 
              redirect('stream/index');
          
        }
       else
        {
                $this->session->flashdata('error','Sorry!! Your data not inserted');
               redirect('stream/edit', 'refresh');
        }
      



        $this->load->view('stream/edit');

    }



    public function change_status($stream_id = '', $status = '') {



        if ($stream_id != '' && $status != '') {

            $data = array('status' => $status);

            $update_status = $this->common->update_data($data, 'stream', 'stream_id', $stream_id);



            if ($update_status) {

                $this->session->set_flashdata('success', 'User Status Successfully Changed.');

                redirect('stream', 'refresh');

            }


 redirect('stream', 'refresh');

        }

    }



    public function delete($stream_id = '') {

        if ($stream_id != '')
         {

            $stream_id = base64_decode($stream_id);

            // $data = array('is_delete' => 0);

            $delete_status = $this->common->delete_data('stream','stream_id',$stream_id);



            if ($delete_status)
             {

                $this->session->set_flashdata('success', 'User Successfully Delete.');

                redirect('stream', 'refresh');

            }

        }

    }

   

}



/* End of file welcome.php 

/* Location: ./application/controllers/welcome.php */