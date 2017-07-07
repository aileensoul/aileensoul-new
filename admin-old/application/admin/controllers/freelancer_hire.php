<?php



if (!defined('BASEPATH'))

    exit('No direct script access allowed');



class Freelancer_hire extends CI_Controller {



    public $data;



    public function __construct() {

        parent::__construct();





        // Get Site Information

        // $site_settings = $this->common->select_data_by_id('site_settings', 'site_id', 1, $data = '*', $join_str = array());





        // $main_site_name = $this->data['main_site_name'] = $site_settings[0]['site_name'];

        // $main_site_email = $this->data['main_site_email'] = $site_settings[0]['site_email'];

        // $main_site_url = $this->data['main_site_url'] = $site_settings[0]['site_url'];



        $this->data['title'] = "Freelancer hire Management | $main_site_name ";

        $this->data['module_name'] = "Freelancer hire Management";

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

        // echo "hi"; die();

        $this->data['section_title'] = "Freelancer hire Management List";





        $limit = $this->paging['per_page'];



        if ($this->uri->segment(3) != '' && $this->uri->segment(4) != '') {

            $offset = ($this->uri->segment(5) != '') ? $this->uri->segment(5) : 0;

            $short_by = $this->uri->segment(3);

            $order_by = $this->uri->segment(4);

        } else {

            $offset = ($this->uri->segment(3) != '') ? $this->uri->segment(3) : 0;

            $short_by = 'reg_id';

            $order_by = 'asc';

        }



        $this->data['offset'] = $offset;



        $condition_array = array('is_delete' => 0);



        $this->data['freelancer_list'] = $get_users = $this->common->select_data_by_condition('freelancer_hire_reg', $condition_array, $data = '*', $short_by, $order_by, $limit, $offset, $join_str = array());





        if ($this->uri->segment(3) != '' && $this->uri->segment(4) != '') {

            $this->paging['base_url'] = site_url("freelancer_hire/index/" . $short_by . "/" . $order_by);

        } else {

            $this->paging['base_url'] = site_url("freelancer_hire/index/");

        }

        if ($this->uri->segment(3) != '' && $this->uri->segment(4) != '') {

            $this->paging['uri_segment'] = 5;

        } else {

            $this->paging['uri_segment'] = 3;

        }



        $contition_array1 = array('is_delete' => 0);



        $this->paging['total_rows'] = count($this->common->select_data_by_condition('freelancer_hire_reg', $contition_array1, 'reg_id'));

        $this->data['total_rows'] = $this->paging['total_rows'];

        $this->data['limit'] = $limit;



        //$this->paging['per_page'] = 2;



        $this->pagination->initialize($this->paging);

        $this->data['search_keyword'] = '';

        $this->load->view('freelancer_hire/index',$this->data);

    }



    //search the user

    public function search() {

        $this->data['section_title'] = "freelancer hire Management List";

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

                $short_by = 'reg_id';

                $order_by = 'asc';

            }

            $this->data['offset'] = $offset;

            //prepare search condition

            $search_condition = "(fullname LIKE '%$search_keyword%' OR username LIKE '%$search_keyword%' )";



             $contition_array1 = array('is_delete' => 0);

            $this->data['frelancer_list'] = $this->common->select_data_by_search('freelancer_hire_reg', $search_condition, $contition_array, '*', $short_by, $order_by, $limit, $offset);



            if ($this->uri->segment(3) != '' && $this->uri->segment(4) != '') {

                $this->paging['base_url'] = site_url("freelancer_hire/search/" . $short_by . "/" . $order_by);

            } else {

                $this->paging['base_url'] = site_url("freelancer_hire/search/");

            }



            if ($this->uri->segment(3) != '' && $this->uri->segment(4) != '') {

                $this->paging['uri_segment'] = 5;

            } else {

                $this->paging['uri_segment'] = 3;

            }

            $this->paging['total_rows'] = count($this->common->select_data_by_search('freelancer_hire_reg', $search_condition, $contition_array, 'reg_id'));



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

                $short_by = 'reg_id';

                $order_by = 'asc';

            }

            $this->data['offset'] = $offset;

            //prepare search condition

            $search_condition = "(fullname LIKE '%$search_keyword%' OR username LIKE '%$search_keyword%')";



            $contition_array = array();

            $this->data['art_list'] = $this->common->select_data_by_search('freelancer_hire_reg', $search_condition, $contition_array, '*', $short_by, $order_by, $limit, $offset);



            if ($this->uri->segment(3) != '' && $this->uri->segment(4) != '') {

                $this->paging['base_url'] = site_url("freelancer_hire/search/" . $short_by . "/" . $order_by);

            } else {

                $this->paging['base_url'] = site_url("freelancer_hire/search/");

            }



            if ($this->uri->segment(3) != '' && $this->uri->segment(4) != '') {

                $this->paging['uri_segment'] = 5;

            } else {

                $this->paging['uri_segment'] = 3;

            }

            $this->paging['total_rows'] = count($this->common->select_data_by_search('freelancer_hire_reg', $search_condition, $contition_array, 'reg_id'));



            $this->data['total_rows'] = $this->paging['total_rows'];

            $this->data['limit'] = $limit;



            $this->pagination->initialize($this->paging);

        }

        $this->load->view('freelancer_hire/index', $this->data);

    }



    //add new user

    public function add($id = '') {



        $this->data['section_title'] = "Add freelancer hire";



        $contition_array = array('status' => '1', 'is_delete' => '0');
        $this->userdata['users'] = $this->common->select_data_by_condition('user', $contition_array, $data = '*', $sortby = 'user_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');


        $contition_array = array('status' => 1);
        $this->data['countries'] =  $this->common->select_data_by_condition('countries', $contition_array, $data = '*', $sortby = 'country_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');



        $this->load->view('freelancer_hire/add',array_merge($this->userdata,$this->data));

    }


    public function add_insert($id = '') {


        $this->data['section_title'] = "Add freelancer ";

         // echo "<pre>"; print_r($_POST); die();
         $userid = $this->input->post('user_name');

         // echo $s; die();

        $contition_array = array( 'user_id' => $userid);

        $result = $this->userdata['users'] = $this->common->select_data_by_condition('freelancer_hire_reg', $contition_array, $data = '*', $sortby = 'user_id', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');


         if($result)
        {
                echo "artistic user registration already exist"; die();
        }

         else
         {   

            $data = array(

                 'fullname' => $this->input->post('fname'),
                 'username' => $this->input->post('uname'),
                 'email' => $this->input->post('email'),
                 'skyupid' => $this->input->post('skyupid'),
                 'phone' => $this->input->post('phone'),
                 'country' => $this->input->post('country'),
                 'state' => $this->input->post('state'),
                 'city' => $this->input->post('city'),
                 'pincode' => $this->input->post('pincode'),
                 'address' => $this->input->post('address'),
                  'professional_info' => $this->input->post('professional_info'),
                  'pay_hourly' => $this->input->post('pay_hourly'),
                 'fixed_price' => $this->input->post('fixed_price'),
                 'fields_req' => $this->input->post('fields_req'),
                 'area_req' => $this->input->post('area_req'),
                 'req_skill' => $this->input->post('req_skill'),
                 'req_experience' => $this->input->post('req_experience'),
                 'req_person' => $this->input->post('req_person'),
                  'status' => 1,
                 'is_delete' => 0,
                 'created_date' => date('Y-m-d h:i:s',time()),
                'user_id'=> $userid

        ); 

        //echo "<pre>";print_r($data);die();
        $insert_id = $this->common->insert_data_getid($data,'freelancer_hire_reg'); 

        if($insert_id)
        { 
              redirect('freelancer_hire/index');
          
        }
       else
        {
                $this->session->flashdata('error','Sorry!! Your data not inserted');
               redirect('freelancer_hire/add', 'refresh');
        }
      }
       
    
       
        

    }

    public function ajax_data() { 
      
       if(isset($_POST["country_id"]) && !empty($_POST["country_id"])){ 
    //Get all state data
         $contition_array = array('country_id' => $_POST["country_id"] , 'status' => 1);
     $state =  $this->data['states'] =  $this->common->select_data_by_condition('states', $contition_array, $data = '*', $sortby = 'state_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');
   
    //Count total number of rows
   
    
    //Display states list
    if(count($state) > 0){
        echo '<option value="">Select state</option>';
     foreach($state as $st){
            echo '<option value="'.$st['state_id'].'">'.$st['state_name'].'</option>';
     
        }
    }else{
        echo '<option value="">State not available</option>';
    }
}

if(isset($_POST["state_id"]) && !empty($_POST["state_id"])){
    //Get all city data
     $contition_array = array('state_id' => $_POST["state_id"] , 'status' => 1);
     $city =  $this->data['city'] =  $this->common->select_data_by_condition('cities', $contition_array, $data = '*', $sortby = 'city_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');
    
    
    //Display cities list
    if(count($city) > 0){
        echo '<option value="">Select city</option>';
        foreach($city as $cit){
            echo '<option value="'.$cit['city_id'].'">'.$cit['city_name'].'</option>';
        }
    }else{
        echo '<option value="">City not available</option>';
    }
    }


}




    public function edit($id = '') {

        $this->data['section_title'] = "Edit freelancer hire Management";

        $id = base64_decode($id);
         $contition_array = array('status' => 1);
        $this->data['countries'] =  $this->common->select_data_by_condition('countries', $contition_array, $data = '*', $sortby = 'country_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        $contition_array = array('status' => 1);
        $this->data['states'] =  $this->common->select_data_by_condition('states', $contition_array, $data = '*', $sortby = 'state_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        $contition_array = array('status' => 1);
        $this->data['cities'] =  $this->common->select_data_by_condition('cities', $contition_array, $data = '*', $sortby = 'city_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');



         $contition_array = array('reg_id' => $id);

        $this->data['freelancer'] = $this->common->select_data_by_condition('freelancer_hire_reg',$contition_array, $data = '*', $sortby ='', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');


       
        $this->load->view('freelancer_hire/edit',$this->data);

    }


      public function freelancer_hire_edit($id = '')
       {

        
        $id = base64_decode($id);

        

        $this->data['section_title'] = "Add freelancer";

          // echo "<pre>"; print_r($_POST);  print_r($_FILES);die();
         $userid = $this->input->post('fullname');

         
       
            $data = array(



                 'fullname' => $this->input->post('fname'),
                 'username' => $this->input->post('uname'),
                 'email' => $this->input->post('email'),
                 'skyupid' => $this->input->post('skyupid'),
                 'phone' => $this->input->post('phone'),
                 'country' => $this->input->post('country'),
                 'state' => $this->input->post('state'),
                 'city' => $this->input->post('city'),
                 'pincode' => $this->input->post('pincode'),
                 'address' => $this->input->post('address'),
                  'professional_info' => $this->input->post('professional_info'),
                  'pay_hourly' => $this->input->post('pay_hourly'),
                 'fixed_price' => $this->input->post('fixed_price'),
                 'fields_req' => $this->input->post('fields_req'),
                 'area_req' => $this->input->post('area_req'),
                 'req_skill' => $this->input->post('req_skill'),
                 'req_experience' => $this->input->post('req_experience'),
                 'req_person' => $this->input->post('req_person'),
                  'status' => 1,
                 'is_delete' => 0,
                 'modified_date' => date('Y-m-d h:i:s',time()),
                'user_id'=> $userid
                 
        ); 
 
        //echo "<pre>";print_r($data);die();
       
            $varid = $this->input->post('reg_id');

           // print_r($varid);die();
        $update= $this->common->update_data($data, 'freelancer_hire_reg', 'reg_id', $varid);

        if($update)
        { 
              redirect('freelancer_hire/index');
          
        }
       else
        {
                $this->session->flashdata('error','Sorry!! Your data not inserted');
               redirect('freelancer_hire/edit', 'refresh');
        }


      }
       
    
       
  


 public function change_status($reg_id = '', $status = '') {



        if ($reg_id != '' && $status != '') {

            $data = array('status' => $status);

            $update_status = $this->common->update_data($data, 'freelancer_hire_reg', 'reg_id', $reg_id);



            if ($update_status) {

                $this->session->set_flashdata('success', 'User Status Successfully Changed.');

                redirect('freelancer_hire', 'refresh');

            }


             redirect('freelancer_hire', 'refresh');

        }

    }



    public function delete($reg_id = '') {

        if ($reg_id != '') {

            $reg_id = base64_decode($reg_id);

            // $data = array('status' => 1);

           $delete_status = $this->common->delete_data('freelancer_hire_reg','reg_id',$reg_id);





            if ($delete_status) {

                $this->session->set_flashdata('success', 'User Successfully Delete.');

                redirect('freelancer_hire', 'refresh');

            }

        }

    }



       public function view($id ='')
    {


        $this->data['section_title'] = "Freelancer Hire Information";

        $id = base64_decode($id);

        // echo $id;die();

        $contition_array = array('reg_id' => $id);

        $this->data['freelancer'] = $this->common->select_data_by_condition('freelancer_hire_reg',$contition_array, $data = '*', $sortby ='', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        // print_r($this->data['job']); die();
        $this->load->view('freelancer_hire/view',$this->data);
    }



    public function clear_search() {

        $this->session->unset_userdata('user_search_keyword');

        redirect('freelancer_hire', 'refresh');

    }



}



/* End of file welcome.php */

/* Location: ./application/controllers/welcome.php */