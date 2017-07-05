<?php



if (!defined('BASEPATH'))

    exit('No direct script access allowed');



class Freelancer_post_registration extends CI_Controller {



    public $data;



    public function __construct() {

        parent::__construct();





        // Get Site Information

        $site_settings = $this->common->select_data_by_id('site_settings', 'site_id', 1, $data = '*', $join_str = array());





        $main_site_name = $this->data['main_site_name'] = $site_settings[0]['site_name'];

        $main_site_email = $this->data['main_site_email'] = $site_settings[0]['site_email'];

        $main_site_url = $this->data['main_site_url'] = $site_settings[0]['site_url'];



        $this->data['title'] = "Freelancer post registration  management | $main_site_name ";

        $this->data['module_name'] = "Freelancer post registration management";

        include('include.php');



        //Loadin Pagination Custome Config File

        $this->config->load('paging', TRUE);

        $this->paging = $this->config->item('paging');

//        print_r($this->paging);

//        die();

        //remove catch so after logout cannot view last visited page if that page is this

        $this->output->set_header('Last-Modified:' . gmdate('D, d M Y H:i:s') . 'GMT');

        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');

        $this->output->set_header('Cache-Control: post-check=0, pre-check=0', false);

        $this->output->set_header('Pragma: no-cache');

    }



    public function index() {

            // echo "hello"; die();


        $this->data['section_title'] = "Freelancer Post  Management ";





        $limit = $this->paging['per_page'];



        if ($this->uri->segment(3) != '' && $this->uri->segment(4) != '') {

            $offset = ($this->uri->segment(5) != '') ? $this->uri->segment(5) : 0;

            $short_by = $this->uri->segment(3);

            $order_by = $this->uri->segment(4);

        } else {

            $offset = ($this->uri->segment(3) != '') ? $this->uri->segment(3) : 0;

            $short_by = 'freelancer_post_reg_id';

            $order_by = 'asc';

        }



        $this->data['offset'] = $offset;



        $condition_array = array('is_delete =' => '0');



        $this->data['freelance_post'] = $get_users = $this->common->select_data_by_condition('freelancer_post_reg', $condition_array, $data = '*', $short_by, $order_by, $limit, $offset, $join_str = array());

        // echo "<pre>"; print_r($this->data['freelance_post']); die();


           // echo "$get_users";

            // print_r( $this->data['business_list']); die();


        if ($this->uri->segment(3) != '' && $this->uri->segment(4) != '') {

            $this->paging['base_url'] = site_url("freelancer_post_registration/index/" . $short_by . "/" . $order_by);

        } else {

            $this->paging['base_url'] = site_url("freelancer_post_registration/index/");

        }

        if ($this->uri->segment(3) != '' && $this->uri->segment(4) != '') {

            $this->paging['uri_segment'] = 5;

        } else {

            $this->paging['uri_segment'] = 3;

        }



        $contition_array1 = array('is_delete =' => '0');



        $this->paging['total_rows'] = count($this->common->select_data_by_condition('freelancer_post_reg', $contition_array1, 'freelancer_post_reg_id'));

        $this->data['total_rows'] = $this->paging['total_rows'];

        $this->data['limit'] = $limit;



        //$this->paging['per_page'] = 2;



        $this->pagination->initialize($this->paging);

        $this->data['search_keyword'] = '';

        $this->load->view('Freelancer_post_registration/index', $this->data);

    }

    public function add(){

        $this->data['section_title'] = "ADD Freelancer Post";
       
        // fetch countries
        $contition_array = array('status' => 1);
        $this->data['countries'] =  $this->common->select_data_by_condition('countries', $contition_array, $data = '*', $sortby = 'country_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        //echo "<pre>"; print_r($this->data['countries']);die();


            // fetch userlist
        $condition_array1 = array('status =' => '1', 'is_delete =' => '0');


        $this->data['user_list'] = $get_users = $this->common->select_data_by_condition('user', $condition_array1, $data = '*', $short_by, $order_by, $limit, $offset, $join_str = array());

        // fetch degree
        $condition_array2=array('status ='=> '1','is_delete =' => '0');
        $this->data['degree'] = $this->common->select_data_by_condition('degree', $condition_array2, $data = '*', $short_by, $order_by, $limit, $offset, $join_str = array());

        // fetch university
        $condition_array = array('status = '=> '1');

        $this->data['university'] = $get_users = $this->common->select_data_by_condition('university', $condition_array, $data = '*', $short_by, $order_by, $limit, $offset, $join_str = array());


      // echo "<pre>";  print_r($this->data['user_list']);die();

        $this->load->view('Freelancer_post_registration/add',$this->data);
        
    }
    public function add_freelancer()
    {
         // echo "hello"; die();

        $this->form_validation->set_rules('full_name', 'Full Name is required', 'required');
        $this->form_validation->set_rules('user_name', 'User Name', 'required');
        $this->form_validation->set_rules('freelancer_post_skypeid', 'Skype is required', 'required');
        $this->form_validation->set_rules('frelancer_post_email', 'Email Address', 'required');
        $this->form_validation->set_rules('freelancer_post_number', 'Contact Number', 'required');
        $this->form_validation->set_rules('country', 'COUNTRY ', 'required');
        $this->form_validation->set_rules('postal_address', 'POSTAL  ADDRESS', 'required');
        $this->form_validation->set_rules('pincode', 'PINCODE is required', 'required');
        $this->form_validation->set_rules('field', 'FIELD', 'required');
        $this->form_validation->set_rules('area', 'AREA', 'required');
        $this->form_validation->set_rules('skill', 'SKILL is required', 'required');
        $this->form_validation->set_rules('hourly', 'HOURLY', 'required');
        $this->form_validation->set_rules('in_week', 'IN WEEK', 'required');
        $this->form_validation->set_rules('in_day', 'IN Day', 'required');

$this->form_validation->set_rules('degree', 'DEGREE required', 'required');

$this->form_validation->set_rules('stream', 'stream is required', 'required');

$this->form_validation->set_rules('university', 'University is required', 'required');

$this->form_validation->set_rules('college', 'College is required', 'required');

$this->form_validation->set_rules('percentage', 'Percentage is required', 'required');

$this->form_validation->set_rules('passing_year', 'Passing year is required', 'required');

$this->form_validation->set_rules('postal_address', 'Postal address is required', 'required');

$this->form_validation->set_rules('Portfolio', 'Portfolio is required', 'required');






        $condition_array = array('user_id' =>$this->input->post('user_name') );

             // print_r($condition_array);die();

        $this->data['freelancer'] = $get_users = $this->common->select_data_by_condition('user', $condition_array, $data = '*', $short_by, $order_by, $limit, $offset, $join_str = array());

           // echo "<pre>"; print_r($this->data['user']);die();

        if($get_users){

            echo "User already Exists as Freelancer Post"; die();
        }
        else{

$insert_freelancerpost = array(

            'freelancer_post_fullname' => $this->input->post('full_name'),
            'freelancer_post_username' => $this->input->post('user_name'),
            'freelancer_post_skypeid' => $this->input->post('freelancer_post_skypeid'),
            'freelancer_post_email' => $this->input->post('frelancer_post_email'),
            'freelancer_post_phoneno' => $this->input->post('freelancer_post_number'),
            'freelancer_post_country' => $this->input->post('country'),
            'freelancer_post_state' => $this->input->post('state'),
            'freelancer_post_city' => $this->input->post('city'),
            'freelancer_post_address' => $this->input->post('postal_address'),
            'freelancer_post_pincode' => $this->input->post('pincode'),
            'freelancer_post_field' => $this->input->post('field'),
            'freelancer_post_area' => $this->input->post('area'),
            'freelancer_post_skill_description' => $this->input->post('skill'),
            'freelancer_post_hourly' => $this->input->post('hourly'),
            // 'business_profile_image' => $business_image,
            'freelancer_post_ratestate'=>$this->input->post('hourly_state'),
            'freelancer_post_inweek'=>$this->input->post('in_week'),
            'freelancer_post_inday' =>$this->input->post('in_day'),
            'freelancer_post_degree'=>$this->input->post('degree'),
            'freelancer_post_stream'=>$this->input->post('stream'),
            'freelancer_post_univercity'=>$this->input->post('university'),
            'freelancer_post_collage'=>$this->input->post('college'),
            'freelancer_post_percentage'=>$this->input->post('percentage'),
            'freelancer_post_passingyear'=>$this->input->post('passing_year'),
            'freelancer_post_eduaddress'=>$this->input->post('postal_address'),
            'freelancer_post_portfolio'=>$this->input->post('Portfolio'),
            'status'=>'1',
            'is_delete'=>'0',
            'created_date'=>date('Y-m-d H:i:s'),
            'modify_date'=>date('Y-m-d H:i:s'),
            // 're_step' =>'3',
            'user_id' =>$this->input->post('user_name')
            );

         // print_r($insert_freelancerpost);die();

        $insert_id = $this->common->insert_data_getid($insert_freelancerpost ,'freelancer_post_reg');
         redirect('freelancer_post_registration', 'refresh');
     }
    }

    public function edit($id='')
    {
         // echo "hello"; die();
         $this->data['section_title'] = "Edit Freelancer Post  Management";

         // fetch country
         $contition_array = array('status' => 1);
         
        $this->data['countries'] =  $this->common->select_data_by_condition('countries', $contition_array, $data = '*', $sortby = 'country_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        // echo $id;die();
        // fetch state
         $contition_array = array('status' => 1);
        $this->data['states'] =  $this->common->select_data_by_condition('states', $contition_array, $data = '*', $sortby = 'state_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');
        // fetch city
        $contition_array = array('status' => 1);
     $city =  $this->data['city'] =  $this->common->select_data_by_condition('cities', $contition_array, $data = '*', $sortby = 'city_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');
        $id = base64_decode($id);

        // fetch degree
        $condition_array2=array('status ='=> '1','is_delete =' => '0');
        $this->data['degree'] = $this->common->select_data_by_condition('degree', $condition_array2, $data = '*', $short_by, $order_by, $limit, $offset, $join_str = array());

        // fetch stream

        $contition_array = array('status' => 1);
     $stream =  $this->data['stream'] =  $this->common->select_data_by_condition('stream', $contition_array, $data = '*', $sortby = 'stream_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');


        $condition_array = array('freelancer_post_reg_id = '=> $id);

        $this->data['freelancer_post'] = $get_users = $this->common->select_data_by_condition('freelancer_post_reg', $condition_array, $data = '*', $short_by, $order_by, $limit, $offset, $join_str = array());

        // fetch university
         $condition_array = array('status = '=> '1');

        $this->data['university'] = $get_users = $this->common->select_data_by_condition('university', $condition_array, $data = '*', $short_by, $order_by, $limit, $offset, $join_str = array());

        


          // print_r($this->data['business']); die();

        $this->load->view('freelancer_post_registration/edit',$this->data);

    }

    public function edit_freelancer_post()
    {
         // echo "hello";die();

         $id=$this->input->post('freelancer_post_reg_id');

         // echo $id;die();

        $update_data= array(

           
            'freelancer_post_fullname' => $this->input->post('full_name'),
            'freelancer_post_username' => $this->input->post('user_name'),
            'freelancer_post_skypeid' => $this->input->post('freelancer_post_skypeid'),
            'freelancer_post_email' => $this->input->post('frelancer_post_email'),
            'freelancer_post_phoneno' => $this->input->post('freelancer_post_number'),
            'freelancer_post_country' => $this->input->post('country'),
            'freelancer_post_state' => $this->input->post('state'),
            'freelancer_post_city' => $this->input->post('city'),
            'freelancer_post_address' => $this->input->post('postal_address'),
            'freelancer_post_pincode' => $this->input->post('pincode'),
            'freelancer_post_field' => $this->input->post('field'),
            'freelancer_post_area' => $this->input->post('area'),
            'freelancer_post_skill_description' => $this->input->post('skill'),
            'freelancer_post_hourly' => $this->input->post('hourly'),
            // 'business_profile_image' => $business_image,
            'freelancer_post_ratestate'=>$this->input->post('hourly_state'),
            'freelancer_post_inweek'=>$this->input->post('in_week'),
            'freelancer_post_inday' =>$this->input->post('in_day'),
            'freelancer_post_degree'=>$this->input->post('degree'),
            'freelancer_post_stream'=>$this->input->post('stream'),
            'freelancer_post_univercity'=>$this->input->post('university'),
            'freelancer_post_collage'=>$this->input->post('college'),
            'freelancer_post_percentage'=>$this->input->post('percentage'),
            'freelancer_post_passingyear'=>$this->input->post('passing_year'),
            'freelancer_post_eduaddress'=>$this->input->post('freelancer_post_eduaddress'),
            'freelancer_post_portfolio'=>$this->input->post('Portfolio'),
            // 'status'=>'1',
            // 'is_delete'=>'0',
            // 'created_date'=>date('Y-m-d H:i:s'),
            'modify_date'=>date('Y-m-d H:i:s'),
            // 're_step' =>'3',
            'user_id' =>$this->input->post('user_name')

            );

         echo "<pre>";print_r($update_data);die();
        $update_result = $this->common->update_data($update_data,'freelancer_post_reg', 'freelancer_post_reg_id', $this->input->post('freelancer_post_reg_id'));
        redirect('freelancer_post_registration', 'refresh');

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


    if(isset($_POST["degree_id"])&& !empty($_POST["degree_id"])){

        $contition_array = array('degree_id' => $_POST["degree_id"] , 'status' => 1);
     $stream =  $this->data['stream'] =  $this->common->select_data_by_condition('stream', $contition_array, $data = '*', $sortby = 'stream_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');

     //display stream list
     if(count($stream) > 0){
        echo '<option value="">Select Stream</option>';
        foreach($stream as $str){
            echo '<option value="'.$str['stream_id'].'">'.$str['stream_name'].'</option>';
        }
    }else{
        echo '<option value="">City not available</option>';
    }

    }
}   

    

public function show($id='')
{
    // echo "hello";die();
     $this->data['section_title'] = "Business Detail";


      $id = base64_decode($id);

        // echo $id;die();

        $condition_array = array('freelancer_post_reg_id = '=> $id);

        $this->data['post'] = $get_users = $this->common->select_data_by_condition('freelancer_post_reg', $condition_array, $data = '*', $short_by, $order_by, $limit, $offset, $join_str = array());


         // print_r($this->data['recruiter']); die();

        // $this->load->view('recruiter_management/edit',$this->data);

    $this->load->view('Freelancer_post_registration/show',$this->data);

}  




    //search the user

    public function search() {

        $this->data['section_title'] = "User Management List";

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

                $short_by = 'freelancer_post_reg_id';

                $order_by = 'asc';

            }

            $this->data['offset'] = $offset;

            //prepare search condition

            $search_condition = "(freelancer_post_fullname LIKE '%$search_keyword%')";



            $contition_array = array('status =' => '1', 'is_delete =' => '0');

            $this->data['freelance_post'] = $this->common->select_data_by_search('freelancer_post_reg', $search_condition, $contition_array, '*', $short_by, $order_by, $limit, $offset);



            if ($this->uri->segment(3) != '' && $this->uri->segment(4) != '') {

                $this->paging['base_url'] = site_url("admin/freelancer_post_registration/search/" . $short_by . "/" . $order_by);

            } else {

                $this->paging['base_url'] = site_url("admin/freelancer_post_registration/search/");

            }



            if ($this->uri->segment(3) != '' && $this->uri->segment(4) != '') {

                $this->paging['uri_segment'] = 5;

            } else {

                $this->paging['uri_segment'] = 3;

            }

            $this->paging['total_rows'] = count($this->common->select_data_by_search('freelancer_post_reg', $search_condition, $contition_array, 'freelancer_post_reg_id'));



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

                $short_by = 'freelancer_post_reg_id';

                $order_by = 'asc';

            }

            $this->data['offset'] = $offset;

            //prepare search condition

            $search_condition = "(freelancer_post_fullname LIKE '%$search_keyword%')";



            $contition_array = array();

            $this->data['freelance_post'] = $this->common->select_data_by_search('freelancer_post_reg', $search_condition, $contition_array, '*', $short_by, $order_by, $limit, $offset);



            if ($this->uri->segment(3) != '' && $this->uri->segment(4) != '') {

                $this->paging['base_url'] = site_url("admin/freelancer_post_registration/search/" . $short_by . "/" . $order_by);

            } else {

                $this->paging['base_url'] = site_url("admin/freelancer_post_registration/search/");

            }



            if ($this->uri->segment(3) != '' && $this->uri->segment(4) != '') {

                $this->paging['uri_segment'] = 5;

            } else {

                $this->paging['uri_segment'] = 3;

            }

            $this->paging['total_rows'] = count($this->common->select_data_by_search('freelancer_post_reg', $search_condition, $contition_array, 'freelancer_post_reg_id'));



            $this->data['total_rows'] = $this->paging['total_rows'];

            $this->data['limit'] = $limit;



            $this->pagination->initialize($this->paging);

        }

        $this->load->view('freelancer_post_registration/index', $this->data);

    }



    //add new user

//     public function add($id = '') {



//         $this->data['section_title'] = "Add User";

//         //check post and save data

//         if ($this->input->post('admin_name')) {



//             $admin['upload_path'] = $this->config->item('admin_main_upload_path');

//             $admin['allowed_types'] = $this->config->item('admin_allowed_types');

//             $admin['max_size'] = $this->config->item('admin_main_max_size');

//             $admin['max_width'] = $this->config->item('admin_main_max_width');

//             $admin['max_height'] = $this->config->item('admin_main_max_height');



//             $this->load->library('upload');

//             $this->upload->initialize($admin);

//             //Uploading Image

//             $this->upload->do_upload('admin_image');

//             //Getting Uploaded Image File Data

//             $imgdata = $this->upload->data();

//             $imgerror = $this->upload->display_errors();

//             if ($imgerror == '') {

//                 //Configuring Thumbnail 

//                 $admin_thumb['image_library'] = 'gd2';

//                 $admin_thumb['source_image'] = $admin['upload_path'] . $imgdata['file_name'];

//                 $admin_thumb['new_image'] = $this->config->item('admin_thumb_upload_path') . $imgdata['file_name'];

//                 $admin_thumb['create_thumb'] = TRUE;

//                 $admin_thumb['maintain_ratio'] = FALSE;

//                 $admin_thumb['thumb_marker'] = '';

//                 $admin_thumb['width'] = $this->config->item('admin_thumb_width');

//                 $admin_thumb['height'] = $this->config->item('admin_thumb_height');



//                 //Loading Image Library

//                 $this->load->library('image_lib', $admin_thumb);

//                 $dataimage = $imgdata['file_name'];

//                 //Creating Thumbnail

//                 $this->image_lib->resize();

//                 $thumberror = $this->image_lib->display_errors();

//             } else {

//                 $thumberror = '';

//             }



//             if ($imgerror != '' || $thumberror != '') {

//                 $error[0] = $imgerror;

//                 $error[1] = $thumberror;

//             } else {

//                 $error = array();

//             }

//             if ($error) {

//                 $this->session->set_flashdata('error', $error[0]);

//                 $redirect_url = site_url('user_management');

//                 redirect($redirect_url, 'refresh');

//             } else {

//                 // $admin1 = $this->upload->data('file_name');

// //                    $admin = $admin1['file_name'];

//                 $admin = $imgdata['file_name'];

//             }

//             $rand_password = $this->random_password(8);



//             $insert_array = array(

//                 'admin_name' => trim($this->input->post('admin_name')),

//                 'admin_role' => 2,

//                 'admin_username' => trim($this->input->post('admin_username')),

//                 'admin_email' => trim($this->input->post('admin_email')),

//                 'admin_image' => $admin,

//                 'admin_password' => md5($rand_password),

//                 'admin_pwd' => base64_encode($rand_password),

//                 'admin_modified_date' => date('Y-m-d H:i:s'),

//                 'admin_ip' => getHostByName(getHostName()),

//                 'admin_status' => 1

//             );



//             $insert_result = $this->common->insert_data($insert_array, 'admin');



//             if ($insert_result) {

//                 $admin_url = site_url('../admin');

//                 $email_formate = $this->common->select_data_by_id('emails', 'emailid', '8', 'varsubject,varmailformat');

//                 $mail_body = str_replace("%name%", $this->input->post('admin_name'), str_replace("%admin_email%", $this->input->post('admin_email'), str_replace("%password%", $rand_password, str_replace("%link%", $admin_url, stripslashes($email_formate[0]['varmailformat'])))));

//                 $send_mail = $this->sendEmail($this->data['main_site_name'], $this->data['main_site_email'], $this->input->post('admin_email'), $email_formate[0]['varsubject'], $mail_body);

//             }



//             if ($this->input->post('redirect_url')) {

//                 $redirect_url = $this->input->post('redirect_url');

//             } else {

//                 $redirect_url = site_url('user_management');

//             }



//             if ($insert_result == 1 && $send_mail == 1) {



//                 $this->session->set_flashdata('success', 'User successfully inserted.');

//                 redirect($redirect_url, 'refresh');

//             } else {

//                 $this->session->set_flashdata('error', 'Error Occurred. Try Again!');

//                 redirect($redirect_url, 'refresh');

//             }

//         }





//         $this->load->view('user_management/add', $this->data);

//     }



    // public function edit($id = "") {

    //     $this->data['section_title'] = "Edit User Management";

    //     if ($this->input->post('admin_id')) {



    //         if ($_FILES['admin_image']['name'] != '') {



    //             $admin['upload_path'] = $this->config->item('admin_main_upload_path');

    //             $admin['allowed_types'] = $this->config->item('admin_allowed_types');

    //             $admin['max_size'] = $this->config->item('admin_main_max_size');

    //             $admin['max_width'] = $this->config->item('admin_main_max_width');

    //             $admin['max_height'] = $this->config->item('admin_main_max_height');



    //             //    $this->load->library('upload', $admin);



    //             $this->load->library('upload');

    //             $this->upload->initialize($admin);

    //             //Uploading Image

    //             $this->upload->do_upload('admin_image');

    //             //Getting Uploaded Image File Data

    //             $imgdata = $this->upload->data();

    //             $imgerror = $this->upload->display_errors();

    //             if ($imgerror == '') {

    //                 //Configuring Thumbnail 

    //                 $admin_thumb['image_library'] = 'gd2';

    //                 $admin_thumb['source_image'] = $admin['upload_path'] . $imgdata['file_name'];

    //                 $admin_thumb['new_image'] = $this->config->item('admin_thumb_upload_path') . $imgdata['file_name'];

    //                 $admin_thumb['create_thumb'] = TRUE;

    //                 $admin_thumb['maintain_ratio'] = FALSE;

    //                 $admin_thumb['thumb_marker'] = '';

    //                 $admin_thumb['width'] = $this->config->item('admin_thumb_width');

    //                 $admin_thumb['height'] = $this->config->item('admin_thumb_height');



    //                 //Loading Image Library

    //                 $this->load->library('image_lib', $admin_thumb);

    //                 $dataimage = $imgdata['file_name'];

    //                 //Creating Thumbnail

    //                 $this->image_lib->resize();

    //                 $thumberror = $this->image_lib->display_errors();

    //             } else {

    //                 $thumberror = '';

    //             }



    //             if ($imgerror != '' || $thumberror != '') {

    //                 $error[0] = $imgerror;

    //                 $error[1] = $thumberror;

    //             } else {

    //                 $error = array();

    //             }



    //             if ($error) {

    //                 $this->session->set_flashdata('error', $error[0]);

    //                 $redirect_url = site_url('admin_management');

    //                 redirect($redirect_url, 'refresh');

    //             } else {

    //                 $admin = $imgdata['file_name'];

    //             }



    //             $old_image = $this->input->post('old_image');

    //             $old_image_path = $this->config->item('admin_main_upload_path') . $old_image;

    //             $old_image_thumb_path = $this->config->item('admin_thumb_upload_path') . $old_image;



    //             if (file_exists($old_image_path)) {

    //                 unlink($old_image_path);

    //             }

    //             if (file_exists($old_image_thumb_path)) {

    //                 unlink($old_image_thumb_path);

    //             }

    //         } else {

    //             $admin = $this->input->post('old_image');

    //         }

    //         $admin_details = $this->common->select_data_by_id('admin', 'admin_id', $this->input->post('admin_id'), '*', $join_str = array());



    //         $this->data['admin_email'] = $admin_details[0]['admin_email'];



    //         if ($this->data['admin_email'] != $this->input->post('admin_email')) {



    //             $rand_password = $this->random_password(8);

    //             $update_array = array(

    //                 'admin_name' => trim($this->input->post('admin_name')),

    //                 'admin_email' => trim($this->input->post('admin_email')),

    //                 'admin_username' => $this->input->post('admin_username'),

    //                 'admin_password' => md5($rand_password),

    //                 'admin_pwd' => base64_encode($rand_password),

    //                 'admin_image' => $admin,

    //                 'admin_modified_date' => date('Y-m-d H:i:s'),

    //                 'admin_ip' => getHostByName(getHostName()),

    //             );





    //             $send_mail = 0;

    //         } else {

    //             $update_array = array(

    //                 'admin_name' => trim($this->input->post('admin_name')),

    //                 'admin_email' => trim($this->input->post('admin_email')),

    //                 'admin_username' => $this->input->post('admin_username'),

    //                 'admin_image' => $admin,

    //                 'admin_modified_date' => date('Y-m-d H:i:s'),

    //                 'admin_ip' => getHostByName(getHostName()),

    //             );

    //             $send_mail = 1;

    //         }

    //         $update_result = $this->common->update_data($update_array, 'admin', 'admin_id', $this->input->post('admin_id'));



    //         if ($update_result == 1 && $send_mail == 0) {

    //             $admin_url = site_url('../admin');

    //             $email_formate = $this->common->select_data_by_id('emails', 'emailid', '8', 'varsubject,varmailformat');

    //             $mail_body = str_replace("%name%", $this->input->post('admin_name'), str_replace("%link%", $admin_url, str_replace("%admin_email%", $this->input->post('admin_email'), str_replace("%password%", $rand_password, stripslashes($email_formate[0]['varmailformat'])))));

    //             $send_mail = $this->sendEmail($this->data['main_site_name'], $this->data['main_site_email'], $this->input->post('admin_email'), $email_formate[0]['varsubject'], $mail_body);

    //         }



    //         $redirect_url = site_url('user_management');

    //         if ($update_result == 1 && $send_mail == 1) {

    //             $this->session->set_flashdata('success', 'User successfully updated.');

    //             redirect($redirect_url, 'refresh');

    //         } else {

    //             $this->session->set_flashdata('error', 'Errorin Occurred. Try Again!');

    //             redirect($redirect_url, 'refresh');

    //         }

    //     }

        

    //     $id = base64_decode($id);

        

    //     $this->data['section_title'] = "Edit User Management";

    //     $admin_detail = $this->common->select_data_by_id('admin', 'admin_id', $id, '*', $join_str = array());

        

    //     $this->data['admin_id'] = $admin_detail[0]['admin_id'];

    //     $this->data['admin_name'] = $admin_detail[0]['admin_name'];

    //     $this->data['admin_username'] = $admin_detail[0]['admin_username'];

    //     $this->data['admin_email'] = $admin_detail[0]['admin_email'];

    //     $this->data['admin_image'] = $admin_detail[0]['admin_image'];



    //     $this->load->view('user_management/edit', $this->data);

    // }



    public function change_status($freelancer_post_reg_id = '', $status = '') {

         // echo "Hello";die();
        // echo $freelancer_post_reg_id;
        // echo $status;die();

        if ($freelancer_post_reg_id != '' && $status != '') {

            $data = array('status' => $status);

            $update_status = $this->common->update_data($data, 'freelancer_post_reg', 'freelancer_post_reg_id', $freelancer_post_reg_id);



            if ($update_status) {

                $this->session->set_flashdata('success', 'User Status Successfully Changed.');

                redirect('freelancer_post_registration', 'refresh');

            }

        }

    }



    public function delete($freelancer_post_reg_id = '') {

        // echo "Hello";

        // echo $freelancer_post_reg_id; die();

        if ($freelancer_post_reg_id != '') {

            $freelancer_post_reg_id = base64_decode($freelancer_post_reg_id);

           // echo $rec_id; die();

            $data = array('is_delete' => 1);

            $update_status = $this->common->update_data($data, 'freelancer_post_reg', 'freelancer_post_reg_id', $freelancer_post_reg_id);



            if ($update_status) {

                $this->session->set_flashdata('success', 'User Successfully Delete.');

                redirect('freelancer_post_registration', 'refresh');

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



    public function clear_search() {

        $this->session->unset_userdata('user_search_keyword');

        redirect('freelancer_post_registration', 'refresh');

    }



}



/* End of file welcome.php */

/* Location: ./application/controllers/welcome.php */