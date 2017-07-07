<?php



if (!defined('BASEPATH'))

    exit('No direct script access allowed');



class Artistic extends CI_Controller {



    public $data;



    public function __construct() {

        parent::__construct();





        // Get Site Information

        // $site_settings = $this->common->select_data_by_id('site_settings', 'site_id', 1, $data = '*', $join_str = array());





        // $main_site_name = $this->data['main_site_name'] = $site_settings[0]['site_name'];

        // $main_site_email = $this->data['main_site_email'] = $site_settings[0]['site_email'];

        // $main_site_url = $this->data['main_site_url'] = $site_settings[0]['site_url'];



        $this->data['title'] = "Artistic Management | $main_site_name ";

        $this->data['module_name'] = "Artistic Management";

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

        $this->data['section_title'] = "Artistic Management List";





        $limit = $this->paging['per_page'];



        if ($this->uri->segment(3) != '' && $this->uri->segment(4) != '') {

            $offset = ($this->uri->segment(5) != '') ? $this->uri->segment(5) : 0;

            $short_by = $this->uri->segment(3);

            $order_by = $this->uri->segment(4);

        } else {

            $offset = ($this->uri->segment(3) != '') ? $this->uri->segment(3) : 0;

            $short_by = 'art_id';

            $order_by = 'asc';

        }



        $this->data['offset'] = $offset;



        $condition_array = array('is_delete' => 0);



        $this->data['art_list'] = $get_users = $this->common->select_data_by_condition('art_reg', $condition_array, $data = '*', $short_by, $order_by, $limit, $offset, $join_str = array());





        if ($this->uri->segment(3) != '' && $this->uri->segment(4) != '') {

            $this->paging['base_url'] = site_url("artistic/index/" . $short_by . "/" . $order_by);

        } else {

            $this->paging['base_url'] = site_url("artistic/index/");

        }

        if ($this->uri->segment(3) != '' && $this->uri->segment(4) != '') {

            $this->paging['uri_segment'] = 5;

        } else {

            $this->paging['uri_segment'] = 3;

        }



        $contition_array1 = array('is_delete' => 0);



        $this->paging['total_rows'] = count($this->common->select_data_by_condition('art_reg', $contition_array1, 'art_id'));

        $this->data['total_rows'] = $this->paging['total_rows'];

        $this->data['limit'] = $limit;



        //$this->paging['per_page'] = 2;



        $this->pagination->initialize($this->paging);

        $this->data['search_keyword'] = '';

        $this->load->view('artistic/index',$this->data);

    }



    //search the user

    public function search() {

        $this->data['section_title'] = "artistic Management List";

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

                $short_by = 'art_id';

                $order_by = 'asc';

            }

            $this->data['offset'] = $offset;

            //prepare search condition

            $search_condition = "(art_name LIKE '%$search_keyword%' OR art_email LIKE '%$search_keyword%' )";



            $contition_array = array('status' => 1);

            $this->data['art_list'] = $this->common->select_data_by_search('art_reg', $search_condition, $contition_array, '*', $short_by, $order_by, $limit, $offset);



            if ($this->uri->segment(3) != '' && $this->uri->segment(4) != '') {

                $this->paging['base_url'] = site_url("artistic/search/" . $short_by . "/" . $order_by);

            } else {

                $this->paging['base_url'] = site_url("artistic/search/");

            }



            if ($this->uri->segment(3) != '' && $this->uri->segment(4) != '') {

                $this->paging['uri_segment'] = 5;

            } else {

                $this->paging['uri_segment'] = 3;

            }

            $this->paging['total_rows'] = count($this->common->select_data_by_search('art_reg', $search_condition, $contition_array, 'art_id'));



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

                $short_by = 'art_id';

                $order_by = 'asc';

            }

            $this->data['offset'] = $offset;

            //prepare search condition

            $search_condition = "(art_name LIKE '%$search_keyword%' OR art_email LIKE '%$search_keyword%')";



            $contition_array = array();

            $this->data['art_list'] = $this->common->select_data_by_search('art_reg', $search_condition, $contition_array, '*', $short_by, $order_by, $limit, $offset);



            if ($this->uri->segment(3) != '' && $this->uri->segment(4) != '') {

                $this->paging['base_url'] = site_url("artistic/search/" . $short_by . "/" . $order_by);

            } else {

                $this->paging['base_url'] = site_url("artistic/search/");

            }



            if ($this->uri->segment(3) != '' && $this->uri->segment(4) != '') {

                $this->paging['uri_segment'] = 5;

            } else {

                $this->paging['uri_segment'] = 3;

            }

            $this->paging['total_rows'] = count($this->common->select_data_by_search('art_reg', $search_condition, $contition_array, 'art_id'));



            $this->data['total_rows'] = $this->paging['total_rows'];

            $this->data['limit'] = $limit;



            $this->pagination->initialize($this->paging);

        }

        $this->load->view('artistic/index', $this->data);

    }



    //add new user

    public function add($id = '') {


        $this->data['section_title'] = "Add Artistic";



        $contition_array = array('status' => '1', 'is_delete' => '0');
        $this->userdata['users'] = $this->common->select_data_by_condition('user', $contition_array, $data = '*', $sortby = 'user_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');


    $contition_array = array('status' => 1);
        $this->data['countries'] =  $this->common->select_data_by_condition('countries', $contition_array, $data = '*', $sortby = 'country_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');



       
        $this->load->view('artistic/add',array_merge($this->userdata,$this->data));

    }


    public function add_insert($id = '') {


        $this->data['section_title'] = "Add Artistic";

         // echo "<pre>"; print_r($_POST);  print_r($_FILES); die();
         $userid = $this->input->post('user_name');

         // echo $s; die();

        $contition_array = array( 'user_id' => $userid);

        $result = $this->userdata['users'] = $this->common->select_data_by_condition('art_reg', $contition_array, $data = '*', $sortby = 'user_id', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');


         if (empty($_FILES['art_bestofmine']['name']))

             {


                 $this->form_validation->set_rules('art_bestofmine', 'Upload bestofmine', 'required');
            //$picture = '';
            }
            else
            {

                
                $config['upload_path'] = '../uploads/art_images/';
                $config['allowed_types'] = 'jpg|jpeg|png|gif|mp4|3gp|mpeg|mpg|mpe|qt|mov|avi|pdf';
               // $config['file_name'] = $_FILES['picture']['name'];
                $config['file_name'] = $_FILES['art_bestofmine']['name'];
                $config['max_size'] = '1000000000000000';
                //Load upload library and initialize configuration
                $this->load->library('upload',$config);
                $this->upload->initialize($config);
                
                if($this->upload->do_upload('art_bestofmine'))
                {
                  
                    $uploadData = $this->upload->data();
                    //$picture = $uploadData['file_name']."-".date("Y_m_d H:i:s");
                    $picture = $uploadData['file_name'];
                }
                else
                {
                    $picture = '';
                }


              
        }


          //echo $picture; die();

        if (empty($_FILES['art_achievement']['name']))

             {
                   
                 $this->form_validation->set_rules('art_achievement', 'Upload achievmeant', 'required');
            //$picture = '';
            }
            else
            {


                $config['upload_path'] = '../uploads/art_images/';
                $config['allowed_types'] = 'jpg|jpeg|png|gif|pdf';
               // $config['file_name'] = $_FILES['picture']['name'];
                $config['file_name'] = $_FILES['art_achievement']['name'];
                
                //Load upload library and initialize configuration
                $this->load->library('upload',$config);
                $this->upload->initialize($config);
                
                if($this->upload->do_upload('art_achievement'))
                {
                     //echo "hi"; die();
                    $uploadData = $this->upload->data();
                    //$picture = $uploadData['file_name']."-".date("Y_m_d H:i:s");
                    $picture_achiev = $uploadData['file_name'];
                }
                else
                {
                    $picture_achiev = '';
                }
        }


         if($result)
        {
                echo "artistic user registration already exist";
        }

         else
         {   

            $data = array(

                 'art_name' => $this->input->post('firstname'),
                'art_email' => $this->input->post('email'),
                'art_phnno' => $this->input->post('phoneno'),
                'art_country'=> $this->input->post('country'),
                'art_state'=> $this->input->post('state'),
                'art_city'=> $this->input->post('city'),
                //'area_id'=> $this->input->post('area'),
                'art_address'=> $this->input->post('address'),
                'art_pincode'=> $this->input->post('pincode'),
                'art_yourart' => $this->input->post('artname'),
                    'art_speciality' => $this->input->post('Speciality'),
                    'art_inspire' => $this->input->post('inspire'),
                     'art_portfolio' => $this->input->post('portfolio'),
                       'art_skill' => $this->input->post('skills'),
                    'art_achievement' =>$picture_achiev,
                    'art_bestofmine' =>$picture,
                  'status' => 1,
                 'is_delete' => 0,
                 'created_date' => date('Y-m-d h:i:s',time()),
                'user_id'=> $userid

        ); 

        //echo "<pre>";print_r($data);die();
        $insert_id = $this->common->insert_data_getid($data,'art_reg'); 

        if($insert_id)
        { 
              redirect('artistic/index');
          
        }
       else
        {
                $this->session->flashdata('error','Sorry!! Your data not inserted');
               redirect('artistic/add', 'refresh');
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

        $this->data['section_title'] = "Edit Artistic Management";

       
        $id = base64_decode($id);

        $contition_array = array('status' => 1);
        $this->data['countries'] =  $this->common->select_data_by_condition('countries', $contition_array, $data = '*', $sortby = 'country_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        $contition_array = array('status' => 1);
        $this->data['states'] =  $this->common->select_data_by_condition('states', $contition_array, $data = '*', $sortby = 'state_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        $contition_array = array('status' => 1);
        $this->data['cities'] =  $this->common->select_data_by_condition('cities', $contition_array, $data = '*', $sortby = 'city_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');



         $contition_array = array('art_id' => $id);

        $this->data['result'] = $this->common->select_data_by_condition('art_reg',$contition_array, $data = '*', $sortby ='', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');


       
        $this->load->view('artistic/edit',$this->data);

    }


      public function artistic_edit($id = '')
       {

        
        $id = base64_decode($id);

        

        $this->data['section_title'] = "Add Artistic";

         // echo "<pre>"; print_r($_POST);  print_r($_FILES);die();
         $userid = $this->input->post('art_name');

         
      

       
                $config['upload_path'] = '../uploads/art_images/';
                $config['allowed_types'] = 'jpg|jpeg|png|gif|mp4|3gp|mpeg|mpg|mpe|qt|mov|avi|pdf';
               // $config['file_name'] = $_FILES['picture']['name'];
                $config['file_name'] = $_FILES['art_bestofmine']['name'];
                $config['max_size'] = '1000000000000000';
                //Load upload library and initialize configuration
                $this->load->library('upload',$config);
                $this->upload->initialize($config);
                
                if($this->upload->do_upload('art_bestofmine'))
                {
                    
                    $uploadData = $this->upload->data();
                    //$picture = $uploadData['file_name']."-".date("Y_m_d H:i:s");
                    $picture = $uploadData['file_name'];
                }
                else
                {
                    
                    $picture = '';
                }

             
     

      
         
                $config['upload_path'] = '../uploads/art_images/';
                $config['allowed_types'] = 'jpg|jpeg|png|gif|pdf';
               // $config['file_name'] = $_FILES['picture']['name'];
                $config['file_name'] = $_FILES['art_achievmeant']['name'];
                
                //Load upload library and initialize configuration
                $this->load->library('upload',$config);
                $this->upload->initialize($config);
                
                if($this->upload->do_upload('art_achievmeant'))
                {
                    $uploadData = $this->upload->data();
                    //$picture = $uploadData['file_name']."-".date("Y_m_d H:i:s");
                    $picture_achiev = $uploadData['file_name'];
                }
                else
                {
                    $picture_achiev = '';
                }
        

  
       
            $data = array(

                 'art_name' => $this->input->post('firstname'),
                'art_email' => $this->input->post('email'),
                'art_phnno' => $this->input->post('phoneno'),
                'art_country'=> $this->input->post('country'),
                'art_state'=> $this->input->post('state'),
                'art_city'=> $this->input->post('city'),
                //'area_id'=> $this->input->post('area'),
                'art_address'=> $this->input->post('address'),
                'art_pincode'=> $this->input->post('pincode'),
                'art_yourart' => $this->input->post('artname'),
                    'art_speciality' => $this->input->post('Speciality'),
                    'art_inspire' => $this->input->post('inspire'),
                     'art_portfolio' => $this->input->post('portfolio'),
                       'art_skill' => $this->input->post('skills'),
                    'art_achievement' =>$picture_achiev,
                    'art_bestofmine' =>$picture,
                 'modified_date' => date('Y-m-d h:i:s',time()),
                 'status'=> 1,
                 'is_delete'=> 0,
                'user_id'=> $userid

        ); 

        //echo "<pre>";print_r($data);die();
        
            $varid = $this->input->post('art_id');

            // print_r($varid);die();
        $update= $this->common->update_data($data, 'art_reg', 'art_id', $varid);

        if($update)
        { 
              redirect('artistic/index');
          
        }
       else
        {
                $this->session->flashdata('error','Sorry!! Your data not inserted');
               redirect('artistic/edit', 'refresh');
        }


      }
       
    
       
  


 public function change_status($art_id = '', $status = '') {



        if ($art_id != '' && $status != '') {

            $data = array('status' => $status);

            $update_status = $this->common->update_data($data, 'art_reg', 'art_id', $art_id);



            if ($update_status) {

                $this->session->set_flashdata('success', 'User Status Successfully Changed.');

                redirect('artistic', 'refresh');

            }


             redirect('artistic', 'refresh');

        }

    }



    public function delete($art_id = '') {

        if ($art_id != '') {

            $art_id = base64_decode($art_id);

            // $data = array('status' => 1);

           $delete_status = $this->common->delete_data('art_reg','art_id',$art_id);





            if ($delete_status) {

                $this->session->set_flashdata('success', 'User Successfully Delete.');

                redirect('artistic', 'refresh');

            }

        }

    }



    public function check_email() {

        if ($this->input->is_ajax_request() && $this->input->post('admin_email')) {



            $email = $this->input->post('admin_email');

            $condition_array = array('admin_status !=' => '3');

            if ($this->input->post('admin_id')) {

                $id = $this->input->post('admin_id');

                $check_result = $this->common->check_unique_avalibility('admin', 'admin_email', $email, 'admin_id', $id, $condition_array);

            } else {

                $check_result = $this->common->check_unique_avalibility('admin', 'admin_email', $email, '', '', $condition_array);

            }



            if ($check_result) {

                echo 'true';

                die();

            } else {

                echo 'false';

                die();

            }

        }

    }


     public function view($id ='')
    {


        $this->data['section_title'] = "Artistic Management";

        $id = base64_decode($id);

        // echo $id;die();

        $contition_array = array('art_id' => $id);

        $this->data['result'] = $this->common->select_data_by_condition('art_reg',$contition_array, $data = '*', $sortby ='', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        // print_r($this->data['job']); die();
        $this->load->view('artistic/view',$this->data);
    }



    public function clear_search() {

        $this->session->unset_userdata('user_search_keyword');

        redirect('user_management', 'refresh');

    }



}



/* End of file welcome.php */

/* Location: ./application/controllers/welcome.php */