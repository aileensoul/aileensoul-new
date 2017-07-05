<?php



if (!defined('BASEPATH'))

    exit('No direct script access allowed');



class Faq extends CI_Controller {



    public $data;



    public function __construct() {

        parent::__construct();





        // Get Site Information

       


        $this->data['title'] = "FAQ Management | $main_site_name ";

        $this->data['module_name'] = "FAQ Management";

        include('include.php');



        //Loadin Pagination Custome Config File

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



    public function index()
     {

           
             $this->data['section_title'] = "FAQ Management List";

        

        $limit = $this->paging['per_page'];



        if ($this->uri->segment(3) != '' && $this->uri->segment(4) != '') {

            $offset = ($this->uri->segment(5) != '') ? $this->uri->segment(5) : 0;

            $short_by = $this->uri->segment(3);

            $order_by = $this->uri->segment(4);

        } else {

            $offset = ($this->uri->segment(3) != '') ? $this->uri->segment(3) : 0;

            $short_by = 'faq_id';

            $order_by = 'asc';

        }



        $this->data['offset'] = $offset;



        $condition_array = array();



        $this->data['faq_list'] = $this->common->select_data_by_condition('faq', $condition_array, $data = '*', $short_by, $order_by, $limit, $offset, $join_str = array());





        if ($this->uri->segment(3) != '' && $this->uri->segment(4) != '') {

            $this->paging['base_url'] = site_url("faq/index/" . $short_by . "/" . $order_by);

        } else {

            $this->paging['base_url'] = site_url("faq/index/");

        }

        if ($this->uri->segment(3) != '' && $this->uri->segment(4) != '') {

            $this->paging['uri_segment'] = 5;

        } else {

            $this->paging['uri_segment'] = 3;

        }



        $contition_array1 = array();



        $this->paging['total_rows'] = count($this->common->select_data_by_condition('faq', $contition_array1, 'faq_id'));

        $this->data['total_rows'] = $this->paging['total_rows'];

        $this->data['limit'] = $limit;



        //$this->paging['per_page'] = 2;



        $this->pagination->initialize($this->paging);

        $this->data['search_keyword'] = '';

        $this->load->view('faq/index', $this->data);




    }



    //search the user

    public function search() {

        $this->data['section_title'] = "FAQ Management List";

        //query for difficulty 



        if ($this->input->post('search_keyword')) {



            $this->data['search_keyword'] = $search_keyword = $this->input->post('search_keyword');



            $this->session->set_userdata('faq_search_keyword', $search_keyword);

            $limit = $this->paging['per_page'];

            if ($this->uri->segment(3) != '' && $this->uri->segment(4) != '') {

                $offset = ($this->uri->segment(5) != '') ? $this->uri->segment(5) : 0;

                $short_by = $this->uri->segment(3);

                $order_by = $this->uri->segment(4);

            } else {

                $offset = ($this->uri->segment(3) != '') ? $this->uri->segment(3) : 0;

                $short_by = 'faq_id';

                $order_by = 'asc';

            }

            $this->data['offset'] = $offset;

            //prepare search condition

            $search_condition = "(faq_que LIKE '%$search_keyword%' OR faq_ans LIKE '%$search_keyword%' )";



            $contition_array = array('faq_status !=' => '0');

            $this->data['faq_list'] = $this->common->select_data_by_search('faq', $search_condition, $contition_array, '*', $short_by, $order_by, $limit, $offset);



            if ($this->uri->segment(3) != '' && $this->uri->segment(4) != '') {

                $this->paging['base_url'] = site_url("faq/search/" . $short_by . "/" . $order_by);

            } else {

                $this->paging['base_url'] = site_url("faq/search/");

            }



            if ($this->uri->segment(3) != '' && $this->uri->segment(4) != '') {

                $this->paging['uri_segment'] = 5;

            } else {

                $this->paging['uri_segment'] = 3;

            }

            $this->paging['total_rows'] = count($this->common->select_data_by_search('faq', $search_condition, $contition_array, 'faq_id'));



            //for record display

            $this->data['total_rows'] = $this->paging['total_rows'];

            $this->data['limit'] = $limit;





            $this->pagination->initialize($this->paging);

        } else if ($this->session->userdata('faq_search_keyword')) {

            $this->data['search_keyword'] = $search_keyword = $this->session->userdata('faq_search_keyword');



            $limit = $this->paging['per_page'];

            if ($this->uri->segment(3) != '' && $this->uri->segment(4) != '') {

                $offset = ($this->uri->segment(5) != '') ? $this->uri->segment(5) : 0;

                $short_by = $this->uri->segment(3);

                $order_by = $this->uri->segment(4);

            } else {

                $offset = ($this->uri->segment(3) != '') ? $this->uri->segment(3) : 0;

                $short_by = 'faq_id';

                $order_by = 'asc';

            }

            $this->data['offset'] = $offset;

            //prepare search condition

            $search_condition = "(faq_que LIKE '%$search_keyword%' OR faq_ans LIKE '%$search_keyword%')";



            $contition_array = array();

            $this->data['faq_list'] = $this->common->select_data_by_search('faq', $search_condition, $contition_array, '*', $short_by, $order_by, $limit, $offset);



            if ($this->uri->segment(3) != '' && $this->uri->segment(4) != '') {

                $this->paging['base_url'] = site_url("faq/search/" . $short_by . "/" . $order_by);

            } else {

                $this->paging['base_url'] = site_url("faq/search/");

            }



            if ($this->uri->segment(3) != '' && $this->uri->segment(4) != '') {

                $this->paging['uri_segment'] = 5;

            } else {

                $this->paging['uri_segment'] = 3;

            }

            $this->paging['total_rows'] = count($this->common->select_data_by_search('faq', $search_condition, $contition_array, 'faq_id'));



            $this->data['total_rows'] = $this->paging['total_rows'];

            $this->data['limit'] = $limit;



            $this->pagination->initialize($this->paging);

        }

        $this->load->view('faq/index', $this->data);

    }



    

    public function add($id = '')


     {


        $this->data['section_title'] = "Add FAQ";

        //check post and save data

            $insert_array = array(

                'faq_que' => trim($this->input->post('faq_que')),

                'faq_ans' => trim($this->input->post('faq_ans')),

                'faq_status' => 1

            );



            $insert_result = $this->common->insert_data($insert_array, 'faq');


        $this->load->view('faq/add', $this->data);

    }



    public function edit($id =" ")
      {

       //  echo "<pre>"; print_r($_POST); echo $id; 
        $this->data['section_title'] = "FAQ User Management";

         $id = base64_decode($id);
   
       $contition_array = array('faq_id' => $id);

        $this->data['result'] = $this->common->select_data_by_condition('faq',$contition_array, $data = '*', $sortby ='', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');


       
        $this->load->view('faq/edit',$this->data);

    }

    public function faq_edit($id =" ")
      {
    
        
       //  echo "<pre>"; print_r($_POST); echo $id; 
        $this->data['section_title'] = "FAQ User Management";

         $id = base64_decode($id);
         
     

                $data = array(

                    'faq_que' => $this->input->post('faq_que'),

                    'faq_ans' => $this->input->post('faq_ans'),

                    'modified_date' => date('Y-m-d H:i:s')

                );

               //echo "<pre>";print_r($data);  echo $id; die();
              $varid = $this->input->post('faq_id');


              $update_result = $this->common->update_data($data, 'faq', 'faq_id', $varid);

               if ($update_result) 
               {

                redirect('faq', 'refresh');

                }

                 else
               {

                $this->session->set_flashdata('success', 'faq edit data not Changed.');

                redirect('faq/edit', 'refresh');

                }


            

    }






    public function change_status($faq_id = '', $status = '') 
    {
        // echo $faq_id; die();

        if ($faq_id != '' && $status != '') 
        {

            $data = array('faq_status' => $status);

            $update_status = $this->common->update_data($data, 'faq', 'faq_id', $faq_id);



            if ($update_status) 
            {

                $this->session->set_flashdata('success', 'faq Status Successfully Changed.');

                redirect('faq', 'refresh');

            }

        }

    }



    public function delete($faq_id = " ") {

        if ($faq_id != '') 
        {

            $faq_id = base64_decode($faq_id);

            // $data = array('faq_status' => 1);

            $delete_status = $this->common->delete_data('faq','faq_id',$faq_id);



            if ($delete_status)
             {

                $this->session->set_flashdata('success', 'User Successfully Delete.');

                redirect('faq', 'refresh');

            }

        }

    }




    public function clear_search()
     {

        $this->session->unset_userdata('faq_search_keyword');

        redirect('faq', 'refresh');

    }



}



/* End of file welcome.php */

/* Location: ./application/controllers/welcome.php */