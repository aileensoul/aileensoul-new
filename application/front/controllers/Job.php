
<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Job extends MY_Controller {

    public $data;
    
    public function __construct() {
        parent::__construct();

        $this->load->library('form_validation');
        $this->load->model('email_model');
        if (!$this->session->userdata('aileenuser')) {
            redirect('login', 'refresh');
        }

        include ('include.php');
        $this->data['aileenuser_id'] = $this->session->userdata('aileenuser');
    }

    //job seeker basic info controller start

   public function index() {

       $this->job_apply_check(); 

        $userid = $this->session->userdata('aileenuser');

        $contition_array = array('user_id' => $userid, 'status' => '0');
        $jobdata = $this->common->select_data_by_condition('job_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
        if ($jobdata) {

            $this->load->view('job/reactivate', $this->data);
        } else {

         $contition_array = array('user_id' => $userid, 'status' => '1', 'is_delete' => '0');
          $job= $this->common->select_data_by_condition('job_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

            if ($job[0]['job_step'] == 10) {
                 redirect('job/home', refresh);
               }
            else {
                redirect('job/profile', refresh);
            }
        }
    }

    public function job_basicinfo_update() {

       $this->job_apply_check(); 
       $this->job_deactive_profile(); 

        $userid = $this->session->userdata('aileenuser');

    //Retrieve Data from main user registartion table start
    $contition_array = array('user_id' => $userid, 'is_delete' => '0', 'status' => '1');           
    $this->data['job'] = $this->common->select_data_by_condition('user', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
    
      //Retrieve Data from main user registartion table end

        $contition_array = array('user_id' => $userid, 'is_delete' => '0', 'status' => '1');
        $userdata= $this->data['userdata'] = $this->common->select_data_by_condition('job_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
        //echo "<pre>"; print_r($userdata);die();
        $contition_array = array('status' => '1');
        $this->data['nation'] = $this->common->select_data_by_condition('nation', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        $contition_array = array('status' => 1);
        $this->data['language1'] = $this->common->select_data_by_condition('language', $contition_array, $data = '*', $sortby = 'language_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        if ($userdata) {
            $step = $userdata[0]['job_step'];

            if ($step == 1 || $step > 1) {
                $this->data['fname1'] = $userdata[0]['fname'];
                $this->data['lname1'] = $userdata[0]['lname'];
                $this->data['email1'] = $userdata[0]['email'];
                $this->data['phnno1'] = $userdata[0]['phnno'];
                $this->data['pincode1'] = $userdata[0]['pincode'];
                $this->data['address1'] = $userdata[0]['address'];
                $this->data['dob1'] = $userdata[0]['dob'];
                $this->data['gender1'] = $userdata[0]['gender'];
            }
        }

 //Retrieve City data Start   
 $contition_array = array('status' => '1','city_id' => $userdata[0]['city_id']);
        $citytitle = $this->common->select_data_by_condition('cities', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
    
        $this->data['city_title'] = $citytitle[0]['city_name'];
 //Retrieve City data End
     
    
    //Retrieve Language data Start 
        $language_know = explode(',', $userdata[0]['language']); 
        foreach($language_know as $lan){
     $contition_array = array('language_id' => $lan,'status' => 1);
     $languagedata = $this->common->select_data_by_condition('language',$contition_array, $data = 'language_id,language_name', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str5 = '', $groupby = '');
     $detailes[] = $languagedata[0]['language_name'];
  } 

   $this->data['language2'] = implode(',', $detailes); 
 //Retrieve Language data End

        $skildata = explode(',', $userdata[0]['language']);
        $this->data['selectdata'] = $skildata;

         $this->data['title'] = 'Job Profile'.TITLEPOSTFIX;

        $this->load->view('job/index', $this->data);
    }

    public function job_basicinfo_insert() {

         $this->job_deactive_profile(); 
        $userid = $this->session->userdata('aileenuser');

        $this->form_validation->set_rules('fname', 'Firstname', 'required');
        $this->form_validation->set_rules('lname', 'Lastname', 'required');
        $this->form_validation->set_rules('email', 'Store  email', 'required|valid_email');
        $this->form_validation->set_rules('language', 'Language', 'required');
        $this->form_validation->set_rules('dob', 'Date of Birth', 'required');
        $this->form_validation->set_rules('gender', 'Gender', 'required');
        $this->form_validation->set_rules('city', 'City', 'required');
        $this->form_validation->set_rules('pincode', 'Pincode', 'required');
        $this->form_validation->set_rules('address', 'Address', 'required');

         // Language  start   
        $language = $this->input->post('language');
        $language = explode(',',$language); 
       
      
      if(count($language) > 0){ 
          foreach($language as $lan){

     $contition_array = array('language_name' => trim($lan),'status' => 1);
     $languagedata = $this->common->select_data_by_condition('language',$contition_array, $data = 'language_id,language_name', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str5 = '', $groupby = '');
     if($languagedata)
     {
         $language_know[] = $languagedata[0]['language_id'];
     }
       
          }
          $language1 = implode(',',$language_know); 
      }
       // Language  End   

 // City  start   
        $city = $this->input->post('city'); 
       if($city != " "){ 
     $contition_array = array('city_name' => $city, 'status' => '1');
     $citydata = $this->common->select_data_by_condition('cities',$contition_array, $data = 'city_id,city_name', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str5 = '', $groupby = '');
     if($citydata){
         $citytitle = $citydata[0]['city_id'];
           }
      }
 // City  End   

          $bod = $this->input->post('dob');
        $bod = str_replace('/', '-', $bod);

        if ($this->form_validation->run() == FALSE) {

                $this->load->view('job/index', $this->data);
        
        } else {
          
            //get data by id only

            $contition_array = array('user_id' => $userid, 'is_delete' => '0', 'status' => '1');
            $userdata = $this->common->select_data_by_condition('job_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
            if ($userdata) {
               
                $data = array(
                    'fname' => ucfirst($this->input->post('fname')),
                    'lname' => ucfirst($this->input->post('lname')),
                    'email' => $this->input->post('email'),
                    'phnno' => $this->input->post('phnno'),
                    'language' => $language1,
                    'dob' => date('Y-m-d', strtotime($bod)),
                    'gender' => $this->input->post('gender'),
                    'city_id' =>  $citytitle,
                    'pincode' =>  $this->input->post('pincode'),
                    'address' =>   $this->input->post('address'),
                    'user_id' => $userid,
                    'modified_date' => date('Y-m-d h:i:s', time())
                );
                  
          
                $updatedata = $this->common->update_data($data, 'job_reg', 'user_id', $userid);
                if ($updatedata) {
                    $this->session->set_flashdata('success', 'Basic information updated successfully');
                    redirect('job/qualification', refresh);
                } else {
                    $this->session->flashdata('error', 'Your data not inserted');
                    redirect('job/basic-information', refresh);
                }
            } else {

                $data = array(
                    'fname' => ucfirst($this->input->post('fname')),
                    'lname' => ucfirst($this->input->post('lname')),
                    'email' => $this->input->post('email'),
                    'phnno' => $this->input->post('phnno'),
                    'language' => $language1,
                    'dob' => date('Y-m-d', strtotime($bod)),
                    'gender' => $this->input->post('gender'),
                    'city_id' =>  $citytitle,
                    'pincode' => $this->input->post('pincode'),
                    'address' =>  $this->input->post('address'),
                    'status' => 1,
                    'is_delete' => 0,
                    'created_date' => date('Y-m-d h:i:s', time()),
                    'user_id' => $userid,
                );

                $insert_id = $this->common->insert_data_getid($data, 'job_reg');
                if ($insert_id) {
                    $this->session->set_flashdata('success', 'Basic information updated successfully');
                    redirect('job/qualification');
                } else {
                    $this->session->flashdata('error', 'Sorry!! Your data not inserted');
                    redirect('job/basic-information', 'refresh');
                }
            }
        }
    }

//job seeker basic info controller end
//job seeker email already exist checking controller start

    public function check_email() {

         $email = $_POST['email'];

        $userid = $this->session->userdata('aileenuser');

        $contition_array = array('user_id' => $userid, 'is_delete' => '0', 'status' => '1');
        $userdata = $this->common->select_data_by_condition('job_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        $email1 = $userdata[0]['email'];


        if ($email1) {
            $condition_array = array('is_delete' => '0', 'user_id !=' => $userid, 'status' => '1','job_step' => 10);

            $check_result = $this->common->check_unique_avalibility('job_reg', 'email', $email, '', '', $condition_array);
        } else {

            $condition_array = array('is_delete' => '0', 'status' => '1');

            $check_result = $this->common->check_unique_avalibility('job_reg', 'email', $email, '', '', $condition_array);
        }

        if ($check_result) {
            echo 'true';
            die();
        } else {
            echo 'false';
            die();
        }
    }

//job seeker email already exist checking controller End

    //job seeker EDUCATION controller start
    public function job_education_update($postid=" ") {

       $this->job_apply_check(); 
       $this->job_deactive_profile(); 

        $this->data['postid'] = $postid;
      
        $userid = $this->session->userdata('aileenuser');

        $contition_array = array('user_id' => $userid, 'is_delete' => 0, 'status' => 1);

        //for getting degree data Strat
         $contition_array = array('is_delete' => '0','degree_name !=' => "Other");
          $search_condition = "((status = '2' AND user_id = $userid) OR (status = '1'))";
           $degree_data = $this->data['degree_data'] = $this->common->select_data_by_search('degree', $search_condition, $contition_array, $data = '*', $sortby = 'degree_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');
        
         $contition_array = array('status' => 1 , 'is_delete' => '0' ,'degree_name' => "Other");
        $this->data['degree_otherdata'] = $this->common->select_data_by_condition('degree', $contition_array, $data = '*', $sortby = 'degree_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');
        //for getting degree data End

        //for getting univesity data Start
          $contition_array = array('is_delete' => '0','university_name !=' => "Other");
          $search_condition = "((status = '2' AND user_id = $userid) OR (status = '1'))";
           $university_data = $this->data['university_data'] = $this->common->select_data_by_search('university', $search_condition, $contition_array, $data = '*', $sortby = 'university_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');

         $contition_array = array('is_delete' => '0' , 'status' => 1,'university_name' => "Other");
        $this->data['university_otherdata'] = $this->common->select_data_by_condition('university', $contition_array, $data = '*', $sortby = 'university_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');
         
        //for getting univesity data End

        //For getting all Stream Strat
         $contition_array = array('is_delete' => '0','stream_name !=' => "Other");
          $search_condition = "((status = '2' AND user_id = $userid) OR (status = '1'))";
           $stream_alldata = $this->data['stream_alldata'] = $this->common->select_data_by_search('stream', $search_condition, $contition_array, $data = '*', $sortby = 'stream_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = 'stream_name');
           
          $contition_array = array('status' => 1,'is_delete' => 0,'stream_name' => "Other");                                         
        $stream_otherdata = $this->data['stream_otherdata'] = $this->common->select_data_by_condition('stream', $contition_array, $data = '*', $sortby = 'stream_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = 'stream_name');
        //For getting all Stream End

        $contition_array = array('user_id' => $userid, 'is_delete' => 0, 'status' => 1);
        $userdata = $this->common->select_data_by_condition('job_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        if ($userdata) {
            $step = $userdata[0]['job_step'];

            if ($step == 3 || ($step >= 1 && $step <= 3) || $step > 3) {

                $userid = $this->session->userdata('aileenuser');

                $contition_array = array('user_id' => $userid, 'grad_step' => 1, 'status' => 1);
                $jobdata1 = $this->data['jobdata1'] = $this->common->select_data_by_condition('job_add_edu', $contition_array, $data = '*', $sortby = '', $orderby = 'desc', $limit = '', $offset = '', $join_str = array(), $groupby = '');
                
                 $contition_array = array('user_id' => $userid);
                $jobgrad = $this->data['jobgrad'] = $this->common->select_data_by_condition('job_graduation', $contition_array, $data = '*', $sortby = '', $orderby = 'desc', $limit = '', $offset = '', $join_str = array(), $groupby = '');
               
            }
        }

       
        $this->data['title'] = 'Job Profile'.TITLEPOSTFIX;
        $this->load->view('job/job_education', $this->data);
    }


//Insert Primary Education Data End


     public function job_education_primary_insert() {

         $this->job_deactive_profile(); 

        $userid = $this->session->userdata('aileenuser');

        $contition_array = array('user_id' => $userid, 'is_delete' => '0', 'status' => '1');
        $jobdata = $this->common->select_data_by_condition('job_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        $error = '';
        if($_FILES['edu_certificate_primary']['name'] != '' ){
          

        $job_certificate = '';
            $job['upload_path'] = $this->config->item('job_edu_main_upload_path');
            $job['allowed_types'] = $this->config->item('job_edu_main_allowed_types');
            $job['max_size'] = $this->config->item('job_edu_main_max_size');
            $job['max_width'] = $this->config->item('job_edu_main_max_width');
            $job['max_height'] = $this->config->item('job_edu_main_max_height');
            $this->load->library('upload');
            $this->upload->initialize($job);
            //Uploading Image
            $this->upload->do_upload('edu_certificate_primary');
            //Getting Uploaded Image File Data
            $imgdata = $this->upload->data();
            $imgerror = $this->upload->display_errors();
          

                //Configuring Thumbnail 
                $job_thumb['image_library'] = 'gd2';
                $job_thumb['source_image'] = $job['upload_path'] . $imgdata['file_name'];
                $job_thumb['new_image'] = $this->config->item('job_edu_thumb_upload_path') . $imgdata['file_name'];
                $job_thumb['create_thumb'] = TRUE;
                $job_thumb['maintain_ratio'] = TRUE;
                $job_thumb['thumb_marker'] = '';
                $job_thumb['width'] = $this->config->item('job_edu_thumb_width');
                $job_thumb['height'] = 2;
                $job_thumb['master_dim'] = 'width';
                $job_thumb['quality'] = "100%";
                $job_thumb['x_axis'] = '0';
                $job_thumb['y_axis'] = '0';
                //Loading Image Library
                $this->load->library('image_lib', $job_thumb);
                $dataimage = $imgdata['file_name'];
                //Creating Thumbnail
                $this->image_lib->resize();
                $thumberror = $this->image_lib->display_errors();
           
            
        }
            
             

        $contition_array = array('user_id' => $userid);
        $job_reg_data = $this->common->select_data_by_condition('job_add_edu', $contition_array, $data = 'edu_certificate_primary', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        $job_reg_prev_image = $job_reg_data[0]['edu_certificate_primary'];
        $edu_certificate_primary = $_FILES['edu_certificate_primary']['name'];
       

        $image_hidden_primary= $this->input->post('image_hidden_primary');

            if ($job_reg_prev_image != '') {
            $job_image_main_path = $this->config->item('job_edu_main_upload_path');
            $job_bg_full_image = $job_image_main_path . $job_reg_prev_image;
            if (isset($job_bg_full_image)) {
                //delete image from folder when user change image start
                if($image_hidden_primary==$job_reg_prev_image && $edu_certificate_primary != "")
                {
                   
                    unlink($job_bg_full_image);
                }
                //delete image from folder when user change image End
            }
            
            $job_image_thumb_path = $this->config->item('job_edu_thumb_upload_path');
            $job_bg_thumb_image = $job_image_thumb_path . $job_reg_prev_image;
            if (isset($job_bg_thumb_image)) {
                  //delete image from folder when user change image Start
                if($image_hidden_primary==$job_reg_prev_image && $edu_certificate_primary!="")
                {
                    unlink($job_bg_thumb_image);
                }
              //delete image from folder when user change image End
            }


        }

                $job_certificate = $imgdata['file_name'];
            


        $contition_array = array('user_id' => $userid);
        $userdata = $this->common->select_data_by_condition('job_add_edu', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');


        if ($userdata) {
            $edu_certificate_primary = $_FILES['edu_certificate_primary']['name'];

            if ($edu_certificate_primary == "") {
                $data = array(
                    'edu_certificate_primary' => $this->input->post('image_hidden_primary')
                );
            } else {
                $data = array(
                    'edu_certificate_primary' => $job_certificate
                );
            }
            $updatedata = $this->common->update_data($data, 'job_add_edu', 'user_id', $userid);

            $data = array(
                'user_id' => $userid,
                'board_primary' => $this->input->post('board_primary'),
                'school_primary' => $this->input->post('school_primary'),
                'percentage_primary' => $this->input->post('percentage_primary'),
                'pass_year_primary' => $this->input->post('pass_year_primary')
            );

            $updatedata = $this->common->update_data($data, 'job_add_edu', 'user_id', $userid);

           
            //Update only one field into database End 

            if ($updatedata) {
                $this->session->set_flashdata('success', 'Primary Education updated successfully');
                redirect('job/qualification/secondary');
            } else {
                $this->session->flashdata('error', 'Your data not inserted');
                redirect('job/qualification', refresh);
            }
        } 


        else {
            $data = array(
                'user_id' => $userid,
                'board_primary' => $this->input->post('board_primary'),
                'school_primary' => $this->input->post('school_primary'),
                'percentage_primary' => $this->input->post('percentage_primary'),
                'pass_year_primary' => $this->input->post('pass_year_primary'),
                'edu_certificate_primary' => $job_certificate,
                'status' => 1
            );
            $insert_id = $this->common->insert_data_getid($data, 'job_add_edu');

            if ($insert_id) {
                $this->session->set_flashdata('success', 'Primary Education updated successfully');
                redirect('job/qualification/secondary');
            } else {
                $this->session->flashdata('error', 'Your data not inserted');
                redirect('job/qualification', refresh);
            }
        }
    }


//Insert Secondary Education Data start
    public function job_education_secondary_insert() {
         $this->job_deactive_profile(); 

        $userid = $this->session->userdata('aileenuser');
        $contition_array = array('user_id' => $userid, 'is_delete' => '0', 'status' => '1');
        $jobdata = $this->common->select_data_by_condition('job_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

         $error = '';
        if($_FILES['edu_certificate_secondary']['name'] != '' ){


          $job_certificate = '';
            $job['upload_path'] = $this->config->item('job_edu_main_upload_path');
            $job['allowed_types'] = $this->config->item('job_edu_main_allowed_types');
            $job['max_size'] = $this->config->item('job_edu_main_max_size');
            $job['max_width'] = $this->config->item('job_edu_main_max_width');
            $job['max_height'] = $this->config->item('job_edu_main_max_height');
            $this->load->library('upload');
            $this->upload->initialize($job);
            //Uploading Image
            $this->upload->do_upload('edu_certificate_secondary');
            //Getting Uploaded Image File Data
            $imgdata = $this->upload->data();
            $imgerror = $this->upload->display_errors();
           
               
                //Configuring Thumbnail 
                $job_thumb['image_library'] = 'gd2';
                $job_thumb['source_image'] = $job['upload_path'] . $imgdata['file_name'];
                $job_thumb['new_image'] = $this->config->item('job_edu_thumb_upload_path') . $imgdata['file_name'];
                $job_thumb['create_thumb'] = TRUE;
                $job_thumb['maintain_ratio'] = TRUE;
                $job_thumb['thumb_marker'] = '';
                $job_thumb['width'] = $this->config->item('job_edu_thumb_width');
                $job_thumb['height'] = 2;
                $job_thumb['master_dim'] = 'width';
                $job_thumb['quality'] = "100%";
                $job_thumb['x_axis'] = '0';
                $job_thumb['y_axis'] = '0';
                //Loading Image Library
                $this->load->library('image_lib', $job_thumb);
                $dataimage = $imgdata['file_name'];
                //Creating Thumbnail
                $this->image_lib->resize();
                $thumberror = $this->image_lib->display_errors();
                $thumberror = '';
        }


                $contition_array = array('user_id' => $userid);
        $job_reg_data = $this->common->select_data_by_condition('job_add_edu', $contition_array, $data = 'edu_certificate_secondary', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        $job_reg_prev_image = $job_reg_data[0]['edu_certificate_secondary'];

        $image_hidden_secondary= $this->input->post('image_hidden_secondary');
       
        $edu_certificate_secondary = $_FILES['edu_certificate_secondary']['name'];

            if ($job_reg_prev_image != '') {
            $job_image_main_path = $this->config->item('job_edu_main_upload_path');
            $job_bg_full_image = $job_image_main_path . $job_reg_prev_image;
            if (isset($job_bg_full_image)) {

            //delete image from folder when user change image start
                if($image_hidden_secondary==$job_reg_prev_image && $edu_certificate_secondary != "")
                {
                   
                    unlink($job_bg_full_image);
                }
                //delete image from folder when user change image End
              
            }
            
            $job_image_thumb_path = $this->config->item('job_edu_thumb_upload_path');
            $job_bg_thumb_image = $job_image_thumb_path . $job_reg_prev_image;
            if (isset($job_bg_thumb_image)) {

                  //delete image from folder when user change image Start
                if($image_hidden_secondary==$job_reg_prev_image && $edu_certificate_secondary!="")
                {
                    unlink($job_bg_thumb_image);
                }
              //delete image from folder when user change image End
                
            }


        }

        $job_certificate = $imgdata['file_name'];
        
        $contition_array = array('user_id' => $userid);
        $userdata = $this->common->select_data_by_condition('job_add_edu', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        if ($userdata) {
            $edu_certificate_secondary = $_FILES['edu_certificate_secondary']['name'];

            if ($edu_certificate_secondary == "") {
                $data = array(
                    'edu_certificate_secondary' => $this->input->post('image_hidden_secondary')
                );
            } else {
                $data = array(
                    'edu_certificate_secondary' => $job_certificate
                );
            }
            $updatedata = $this->common->update_data($data, 'job_add_edu', 'user_id', $userid);

            $data = array(
                'user_id' => $userid,
                'board_secondary' => $this->input->post('board_secondary'),
                'school_secondary' => $this->input->post('school_secondary'),
                'percentage_secondary' => $this->input->post('percentage_secondary'),
                'pass_year_secondary' => $this->input->post('pass_year_secondary')
            );

            $updatedata = $this->common->update_data($data, 'job_add_edu', 'user_id', $userid);

          
            //Update only one field into database End 

            if ($updatedata) {
                $this->session->set_flashdata('success', 'Secondary Education updated successfully');
                redirect('job/qualification/higher-secondary');
            } else {
                $this->session->flashdata('error', 'Your data not inserted');
                redirect('job/qualification', refresh);
            }
        } else {
            $data = array(
                'user_id' => $userid,
                'board_secondary' => $this->input->post('board_secondary'),
                'school_secondary' => $this->input->post('school_secondary'),
                'percentage_secondary' => $this->input->post('percentage_secondary'),
                'pass_year_secondary' => $this->input->post('pass_year_secondary'),
                'edu_certificate_secondary' => $job_certificate,
                'status' => 1
            );
            $insert_id = $this->common->insert_data_getid($data, 'job_add_edu');

            if ($insert_id) {
                $this->session->set_flashdata('success', 'Secondary Education updated successfully');
                redirect('job/qualification/higher-secondary');
            } else {
                $this->session->flashdata('error', 'Your data not inserted');
                redirect('job/qualification', refresh);
            }
        }
    }

//Insert Secondary Education Data End
//Insert Higher Secondary Education Data start
    public function job_education_higher_secondary_insert() {

         $this->job_deactive_profile(); 
        $userid = $this->session->userdata('aileenuser');

        $contition_array = array('user_id' => $userid, 'is_delete' => '0', 'status' => '1');
        $jobdata = $this->common->select_data_by_condition('job_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

       
          $error = '';
        if($_FILES['edu_certificate_higher_secondary']['name'] != '' ){

  $job_certificate = '';
            $job['upload_path'] = $this->config->item('job_edu_main_upload_path');
            $job['allowed_types'] = $this->config->item('job_edu_main_allowed_types');
            $job['max_size'] = $this->config->item('job_edu_main_max_size');
            $job['max_width'] = $this->config->item('job_edu_main_max_width');
            $job['max_height'] = $this->config->item('job_edu_main_max_height');
            $this->load->library('upload');
            $this->upload->initialize($job);
            //Uploading Image
            $this->upload->do_upload('edu_certificate_higher_secondary');
            //Getting Uploaded Image File Data
            $imgdata = $this->upload->data();
            $imgerror = $this->upload->display_errors();
         
               
                //Configuring Thumbnail 
                $job_thumb['image_library'] = 'gd2';
                $job_thumb['source_image'] = $job['upload_path'] . $imgdata['file_name'];
                $job_thumb['new_image'] = $this->config->item('job_edu_thumb_upload_path') . $imgdata['file_name'];
                $job_thumb['create_thumb'] = TRUE;
                $job_thumb['maintain_ratio'] = TRUE;
                $job_thumb['thumb_marker'] = '';
                $job_thumb['width'] = $this->config->item('job_edu_thumb_width');
                $job_thumb['height'] = 2;
                $job_thumb['master_dim'] = 'width';
                $job_thumb['quality'] = "100%";
                $job_thumb['x_axis'] = '0';
                $job_thumb['y_axis'] = '0';
                //Loading Image Library
                $this->load->library('image_lib', $job_thumb);
                $dataimage = $imgdata['file_name'];
                //Creating Thumbnail
                $this->image_lib->resize();
                $thumberror = $this->image_lib->display_errors();
          
        }
            
             $contition_array = array('user_id' => $userid);
        $job_reg_data = $this->common->select_data_by_condition('job_add_edu', $contition_array, $data = 'edu_certificate_higher_secondary', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        $job_reg_prev_image = $job_reg_data[0]['edu_certificate_higher_secondary'];

    $image_hidden_higher_secondary=$this->input->post('image_hidden_higher_secondary');
    $edu_certificate_higher_secondary = $_FILES['edu_certificate_higher_secondary']['name'];


            if ($job_reg_prev_image != '') {
            $job_image_main_path = $this->config->item('job_edu_main_upload_path');
            $job_bg_full_image = $job_image_main_path . $job_reg_prev_image;
            if (isset($job_bg_full_image)) {
                  //delete image from folder when user change image start
                if($image_hidden_higher_secondary==$job_reg_prev_image && $edu_certificate_higher_secondary!= "")
                {
                   
                    unlink($job_bg_full_image);
                }
                //delete image from folder when user change image End
               
            }
            

            $job_image_thumb_path = $this->config->item('job_edu_thumb_upload_path');
            $job_bg_thumb_image = $job_image_thumb_path . $job_reg_prev_image;
            if (isset($job_bg_thumb_image)) {
                   //delete image from folder when user change image Start
                if($image_hidden_higher_secondary==$job_reg_prev_image && $edu_certificate_higher_secondary!="")
                {
                    unlink($job_bg_thumb_image);
                }
              //delete image from folder when user change image End
             
            }


        }
 
                $job_certificate = $imgdata['file_name'];
        $contition_array = array('user_id' => $userid);
        $userdata = $this->common->select_data_by_condition('job_add_edu', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        if ($userdata) {
         
            $edu_certificate_higher_secondary = $_FILES['edu_certificate_higher_secondary']['name'];

            if ($edu_certificate_higher_secondary == "") {
                $data = array(
                    'edu_certificate_higher_secondary' => $this->input->post('image_hidden_higher_secondary')
                );
            } 
            else {
                $data = array(
                    'edu_certificate_higher_secondary' =>  $job_certificate
                );
            }
         
            $updatedata = $this->common->update_data($data, 'job_add_edu', 'user_id', $userid);

            $data = array(
                'user_id' => $userid,
                'board_higher_secondary' => $this->input->post('board_higher_secondary'),
                'stream_higher_secondary' => $this->input->post('stream_higher_secondary'),
                'school_higher_secondary' => $this->input->post('school_higher_secondary'),
                'percentage_higher_secondary' => $this->input->post('percentage_higher_secondary'),
                'pass_year_higher_secondary' => $this->input->post('pass_year_higher_secondary')
            );

          
            $updatedata = $this->common->update_data($data, 'job_add_edu', 'user_id', $userid);


            if ($updatedata) {
                $this->session->set_flashdata('success', 'Higher Secondary Education updated successfully');
                redirect('job/qualification/graduation');
            } else {
                $this->session->flashdata('error', 'Your data not inserted');
                redirect('job/qualification', refresh);
            }
        } else {
            $data = array(
                'user_id' => $userid,
                'board_higher_secondary' => $this->input->post('board_higher_secondary'),
                'stream_higher_secondary' => $this->input->post('stream_higher_secondary'),
                'school_higher_secondary' => $this->input->post('school_higher_secondary'),
                'percentage_higher_secondary' => $this->input->post('percentage_higher_secondary'),
                'pass_year_higher_secondary' => $this->input->post('pass_year_higher_secondary'),
                'edu_certificate_higher_secondary' => $job_certificate,
                'status' => 1
            );
            
            $insert_id = $this->common->insert_data_getid($data, 'job_add_edu');

            if ($insert_id) {
                $this->session->set_flashdata('success', 'Higher Secondary Education updated successfully');
                redirect('job/qualification/graduation');
            } else {
                $this->session->flashdata('error', 'Your data not inserted');
                redirect('job/qualification', refresh);
            }
        }
    }

//Insert Higher Secondary Education Data End

//Insert Degree Education Data start
   public function job_education_insert() {

     $this->job_deactive_profile(); 

        $userid = $this->session->userdata('aileenuser');

        if ($this->input->post('previous')) {
            redirect('job/job_address_update', refresh);
        }

//Click on Add_More_Education Process start
        if ($this->input->post('add_edu')) {


            $contition_array = array('user_id' => $userid);
            $jobdata = $this->data['jobdata'] = $this->common->select_data_by_condition('job_graduation', $contition_array, $data = '*', $sortby = '', $orderby = 'desc', $limit = '', $offset = '', $join_str = array(), $groupby = '');

            $count = count($jobdata);

            if ($count != 5) {

                redirect('job/job_add_education', refresh);
            } else {
                echo "<script>alert('You Can only add 5 Education field');</script>";
                redirect('job/qualification', refresh);
            }
        }
//Click on Add_More_Education Process End
        //Add Multiple field into database start   
        $userdata[] = $_POST;
        $count1 = count($userdata[0]['degree']);
        // Multiple Image insert code start

        $config = array(
            'upload_path' => $this->config->item('job_edu_main_upload_path'),
            'allowed_types' => $this->config->item('job_edu_main_allowed_types'),
            'max_size' => $this->config->item('job_edu_main_max_size')
        );
        $images = array();
        $this->load->library('upload');

        $files = $_FILES;
        $count = count($_FILES['certificate']['name']);


        for ($i = 0; $i < $count; $i++) {

            $_FILES['certificate']['name'] = $files['certificate']['name'][$i];
            $_FILES['certificate']['type'] = $files['certificate']['type'][$i];
            $_FILES['certificate']['tmp_name'] = $files['certificate']['tmp_name'][$i];
            $_FILES['certificate']['error'] = $files['certificate']['error'][$i];
            $_FILES['certificate']['size'] = $files['certificate']['size'][$i];

            $fileName = $_FILES['certificate']['name'];
            $images[] = $fileName;
            $config['file_name'] = $fileName;
           
            $this->upload->initialize($config);
            $this->upload->do_upload();
        

             if ($this->upload->do_upload('certificate')) {
                $response['result'][] = $this->upload->data();
                $job_profile_post_thumb[$i]['image_library'] = 'gd2';
                $job_profile_post_thumb[$i]['source_image'] = $this->config->item('job_edu_main_upload_path') . $response['result'][$i]['file_name'];
                $job_profile_post_thumb[$i]['new_image'] = $this->config->item('job_edu_thumb_upload_path') . $response['result'][$i]['file_name'];
                $job_profile_post_thumb[$i]['create_thumb'] = TRUE;
                $job_profile_post_thumb[$i]['maintain_ratio'] = TRUE;
                $job_profile_post_thumb[$i]['thumb_marker'] = '';
                $job_profile_post_thumb[$i]['width'] = $this->config->item('job_edu_thumb_width');
                $job_profile_post_thumb[$i]['height'] = 2;
                $job_profile_post_thumb[$i]['master_dim'] = 'width';
                $job_profile_post_thumb[$i]['quality'] = "100%";
                $job_profile_post_thumb[$i]['x_axis'] = '0';
                $job_profile_post_thumb[$i]['y_axis'] = '0';
                $instanse = "image_$i";
                //Loading Image Library
                $this->load->library('image_lib', $job_profile_post_thumb[$i], $instanse);
                $dataimage = $response['result'][$i]['file_name'];
                //Creating Thumbnail
                $this->$instanse->resize();
                $response['error'][] = $thumberror = $this->$instanse->display_errors();
                $return['data'][] = $imgdata;
                $return['status'] = "success";
                $return['msg'] = sprintf($this->lang->line('success_item_added'), "Image", "uploaded");



         $contition_array = array('user_id' => $userid);
        $job_reg_data = $this->common->select_data_by_condition('job_graduation', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
        $count_data=count($job_reg_data);

 for ($x = 0; $x < $count_data; $x++) {
        $job_reg_prev_image = $job_reg_data[$x]['edu_certificate'];
    

    $image_hidden_degree = $this->input->post('image_hidden_degree' . $job_reg_data[$x]['job_graduation_id']);
       $edu_certificate = $files['certificate']['name'][$x];

            if ($job_reg_prev_image != '') {
            $job_image_main_path = $this->config->item('job_edu_main_upload_path');
            $job_bg_full_image = $job_image_main_path . $job_reg_prev_image;
            if (isset($job_bg_full_image)) {
               //delete image from folder when user change image start
                if($image_hidden_degree==$job_reg_prev_image && $edu_certificate!= "")
                {
                   
                   unlink($job_bg_full_image);
                }
                //delete image from folder when user change image End
            }
            
            $job_image_thumb_path = $this->config->item('job_edu_thumb_upload_path');
            $job_bg_thumb_image = $job_image_thumb_path . $job_reg_prev_image;
            if (isset($job_bg_thumb_image)) {
                //delete image from folder when user change image Start
                if( $image_hidden_degree==$job_reg_prev_image && $edu_certificate!="")
                {
                   unlink($job_bg_thumb_image);
                }
              //delete image from folder when user change image End
             
            }

}
        }

            } else {

                $dataimage= '';
            }

        }
       
        // Multiple Image insert code End
          
        $contition_array = array('user_id' => $userid);
        $jobdata = $this->data['jobdata'] = $this->common->select_data_by_condition('job_graduation', $contition_array, $data = '*', $sortby = '', $orderby = 'desc', $limit = '', $offset = '', $join_str = array(), $groupby = '');
     
        if ($jobdata) {

           
            //Edit Multiple field into database Start 
            for ($x = 0; $x < $count1; $x++) {

                $files[] = $_FILES;
                $edu_certificate = $files['certificate']['name'][$x];
         
                if ($edu_certificate == "") {
                 
                       $edu_certificate1 = $this->input->post('image_hidden_degree' . $jobdata[$x]['job_graduation_id']);
                    
                } else { 
                    
                    
                        $edu_certificate1 =   $edu_certificate;
                    
                }
              
              $i = $x + 1;
              if($userdata[0]['education_data'][$x] == 'old'){
                $data = array(
                    'user_id' => $userid,
                    'degree' => $userdata[0]['degree'][$x],
                    'stream' => $userdata[0]['stream'][$x],
                    'university' => $userdata[0]['university'][$x],
                    'college' => $userdata[0]['college'][$x],
                    'grade' => $userdata[0]['grade'][$x],
                    'percentage' => $userdata[0]['percentage'][$x],
                    'pass_year' => $userdata[0]['pass_year'][$x],
                 'edu_certificate'=> $edu_certificate1,
                    'degree_count' => $i
                );
               
                $updatedata1 = $this->common->update_data($data, 'job_graduation', 'job_graduation_id', $jobdata[$x]['job_graduation_id']);
              }else{
                  $data = array(
                    'user_id' => $userid,
                    'degree' => $userdata[0]['degree'][$x],
                    'stream' => $userdata[0]['stream'][$x],
                    'university' => $userdata[0]['university'][$x],
                    'college' => $userdata[0]['college'][$x],
                    'grade' => $userdata[0]['grade'][$x],
                    'percentage' => $userdata[0]['percentage'][$x],
                    'pass_year' => $userdata[0]['pass_year'][$x],
                    'edu_certificate'=> $edu_certificate,
                    'degree_count' => $i
                );
                $insert_id = $this->common->insert_data_getid($data, 'job_graduation');
              }
               
            } 
            //Edit Multiple field into database End 
        } else {
            
            //Add Multiple field into database Start 
            for ($x = 0; $x < $count1; $x++) {

                $i = $x + 1;
                 $edu_certificate = $files['certificate']['name'][$x];
               
                $data = array(
                    'user_id' => $userid,
                    'degree' => $userdata[0]['degree'][$x],
                    'stream' => $userdata[0]['stream'][$x],
                    'university' => $userdata[0]['university'][$x],
                    'college' => $userdata[0]['college'][$x],
                    'grade' => $userdata[0]['grade'][$x],
                    'percentage' => $userdata[0]['percentage'][$x],
                    'pass_year' => $userdata[0]['pass_year'][$x],
                    'edu_certificate' => $edu_certificate,
                    'degree_count' => $i
                );
                $insert_id = $this->common->insert_data_getid($data, 'job_graduation');
                $i++;
            }

            //Add Multiple field into database End 
        }

        if ($insert_id || $updatedata1) {

            $this->session->set_flashdata('success', 'Education updated successfully');
            redirect('job/project');
        } else {
            //echo "welome";die();
            $this->session->flashdata('error', 'Your data not inserted');
            redirect('job/qualification', 'refresh');
        }
    }

//End first time insert and update
//Insert Degree Education Data End

//job seeker EDUCATION controller end
//job seeker Project And Training / Internship controller start
    public function job_project_update() {

         $this->job_apply_check(); 
         $this->job_deactive_profile(); 

        $userid = $this->session->userdata('aileenuser');

        $contition_array = array('user_id' => $userid, 'is_delete' => 0, 'status' => 1);


        $userdata = $this->common->select_data_by_condition('job_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');


        if ($userdata) {
            $step = $userdata[0]['job_step'];

            if ($step == 4 || ($step >= 1 && $step <= 4) || $step > 4) {
                $this->data['project_name1'] = $userdata[0]['project_name'];
                $this->data['project_duration1'] = $userdata[0]['project_duration'];
                $this->data['project_description1'] = $userdata[0]['project_description'];
                $this->data['training_as1'] = $userdata[0]['training_as'];
                $this->data['training_duration1'] = $userdata[0]['training_duration'];
                $this->data['training_organization1'] = $userdata[0]['training_organization'];
            }
        }

        $this->data['title'] = 'Job Profile'.TITLEPOSTFIX;

        $this->load->view('job/job_project', $this->data);
    }

    public function job_project_insert() {

        $this->job_deactive_profile(); 

        $userid = $this->session->userdata('aileenuser');

        if ($this->input->post('previous')) {
            redirect('job/qualification', refresh);
        }
        if ($this->input->post('next')) {

            $data = array(
                'project_name' => $this->input->post('project_name'),
                'project_duration' => $this->input->post('project_duration'),
                'project_description' => $this->input->post('project_description'),
                'training_as' => $this->input->post('training_as'),
                'training_duration' => $this->input->post('training_duration'),
                'training_organization' => $this->input->post('training_organization'),
                'modified_date' => date('Y-m-d h:i:s', time())
            );


            $updatedata = $this->common->update_data($data, 'job_reg', 'user_id', $userid);


            if ($updatedata) {

                $this->session->set_flashdata('success', 'Project And Training / Internship updated successfully');
                redirect('job/work-area');
            } else {
                $this->session->flashdata('error', 'Your data not inserted');
                redirect('job/project', 'refresh');
            }
        }
    }

//job seeker Project And Training / Internship controller end 
//job seeker skill controller start
    public function job_skill_update() {

       $this->job_apply_check(); 
       $this->job_deactive_profile(); 

        $userid = $this->session->userdata('aileenuser');
        
         $contition_array = array('is_delete' => '0','industry_name !=' => "Other");
          $search_condition = "((status = '1'))";
           $university_data = $this->data['industry'] = $this->common->select_data_by_search('job_industry', $search_condition, $contition_array, $data = 'industry_id,industry_name', $sortby = 'industry_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');
           
        $contition_array = array('status' => '1', 'type' => '1');
        $this->data['skill'] = $this->common->select_data_by_condition('skill', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        $contition_array = array('user_id' => $userid, 'status' => '1', 'type' => '3');
        $this->data['skill_other'] = $this->common->select_data_by_condition('skill', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');


        $contition_array = array('user_id' => $userid, 'is_delete' => 0, 'status' => 1);

        $userdata = $this->data['jobskill']=$this->common->select_data_by_condition('job_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        if ($userdata) {
            $step = $userdata[0]['job_step'];

            if ($step == 5 || ($step >= 1 && $step <= 5) || $step > 5) {
                $this->data['keyskill1'] = $userdata[0]['keyskill'];
            }
        }

        $contition_array = array('status' => '1', 'is_delete' => 0, 'user_id' => $userid);
       $post = $this->data['postdata'] = $this->common->select_data_by_condition('job_reg', $contition_array, $data = 'job_id,work_job_title,work_job_industry,work_job_city,keyskill', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        $contition_array = array('status' => 'publish','title_id' => $post[0]['work_job_title']);
        $jobtitle = $this->common->select_data_by_condition('job_title', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
       
        $this->data['work_title'] = $jobtitle[0]['name'];
     
           //Job title data fetch start
        $contition_array = array('status' => 'publish');
        $jobtitle= $this->common->select_data_by_condition('job_title', $contition_array, $data = 'name', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = 'name');
        
        foreach ($jobtitle as $key1 => $value1) {
              foreach ($value1 as $ke1 => $val1) {
                 $title[] = $val1;
              }
          }
        foreach ($title as $key => $value) {
            $result1[$key]['label'] = $value;
            $result1[$key]['value'] = $value;
        }
      $this->data['jobtitle'] = array_values($result1);
          //Job title data fetch ENd

       $this->data['work_industry'] = $post[0]['work_job_industry'];
        $work_skill = explode(',', $post[0]['keyskill']); 
        $work_city = explode(',', $post[0]['work_job_city']); 
    
        foreach($work_skill as $skill){
     $contition_array = array('skill_id' => $skill);
     $skilldata = $this->common->select_data_by_condition('skill',$contition_array, $data = 'skill_id,skill', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str5 = '', $groupby = '');
     $detailes[] = $skilldata[0]['skill'];
  } 

   $this->data['work_skill'] = implode(',', $detailes); 
   
    foreach($work_city as $city){
      $contition_array = array('city_id' => $city);
     $citydata = $this->common->select_data_by_condition('cities',$contition_array, $data = 'city_id,city_name', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str5 = '', $groupby = '');
 if($citydata){
       $cities[] = $citydata[0]['city_name'];
 }
        }

   $this->data['work_skill'] = implode(',', $detailes); 
   $this->data['work_city'] = implode(',', $cities); 
  
   $this->data['title'] = 'Job Profile'.TITLEPOSTFIX;

   $this->load->view('job/job_skill', $this->data);
    }

    public function job_skill_insert() {  

         $this->job_deactive_profile(); 

        $userid = $this->session->userdata('aileenuser');

      $industry = $this->input->post('industry');
     
      $jobtitle = $this->input->post('job_title'); 
      
      $skills = $this->input->post('skills');
      $skills = explode(',',$skills); 
   
      $cities = $this->input->post('cities');
      $cities = explode(',',$cities); 
       
        if ($this->input->post('previous')) {
            redirect('job/project', refresh);
        }
        if ($this->input->post('next')) {
            
             // job title start   
        if($jobtitle != " "){ 
     $contition_array = array('name' => $jobtitle);
     $jobdata = $this->common->select_data_by_condition('job_title',$contition_array, $data = 'title_id,name', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str5 = '', $groupby = '');
     if($jobdata){
         $jobtitle = $jobdata[0]['title_id'];
           }else{
                 $data = array(
                    'name' => ucfirst($this->input->post('job_title')),
                    'status' => 'publish',
                 );
      $jobtitle = $this->common->insert_data_getid($data, 'job_title');
           }
      }
      
      // skills  start   
      if(count($skills) > 0){ 
          
          foreach($skills as $ski){
     $contition_array = array('skill' => trim($ski),'type' => 1);
     $skilldata = $this->common->select_data_by_condition('skill',$contition_array, $data = 'skill_id,skill', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str5 = '', $groupby = '');
   
     if(count($skilldata) < 0){ 
           $contition_array = array('skill' => trim($ski),'type' => 3);
     $skilldata = $this->common->select_data_by_condition('skill',$contition_array, $data = 'skill_id,skill', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str5 = '', $groupby = '');
      } 
     if($skilldata){
         $skill[] = $skilldata[0]['skill_id'];
           }else{
                 $data = array(
                    'skill' => $ski,
                    'status' => '1',
                    'type' => 3,
                    'user_id' => $userid,
                 );
      $skill[] = $this->common->insert_data_getid($data, 'skill');
           }
          }
         
          $skills = implode(',',$skill); 
      }
      
      // city  start   
      
      if(count($cities) > 0){ 
          
          foreach($cities as $cit){
     $contition_array = array('city_name' => $cit);
     //$search_condition = "(skill LIKE '" . trim($searchTerm) . "%')";
     $citydata = $this->common->select_data_by_condition('cities',$contition_array, $data = 'city_id,city_name', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str5 = '', $groupby = '');
     if($citydata){
       $city[] = $citydata[0]['city_id'];
           }else{
                 $data = array(
                    'city_name' => $cit,
                    'status' => '1',
                 );
      $city[] = $this->common->insert_data_getid($data, 'cities');
           }
          }
          
          $city = implode(',',$city); 
      }
      
      //update data in table start
      
      $contition_array = array('user_id' => $userid, 'is_delete' => 0, 'status' => 1);
      $userstepdata = $this->common->select_data_by_condition('job_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
            
      $data = array(
                    
                    'keyskill' => $skills,
                    'work_job_title' => $jobtitle,
                    'work_job_industry' => $this->input->post('industry'),
                    'work_job_city' => $city,
                    
                );
         
                $updatedata = $this->common->update_data($data, 'job_reg', 'user_id', $userid);
      
            if ($updatedata) {
                $this->session->set_flashdata('success', 'Skill updated successfully');
                redirect('job/work-experience');
            } else {
                $this->session->flashdata('error', 'Your data not inserted');
                redirect('job/work-area', 'refresh');
            }
        }
    }

//job seeker skill controller end

//job seeker WORK EXPERIENCE controller start
    public function job_work_exp_update() {

       $this->job_apply_check(); 
       $this->job_deactive_profile(); 

        $userid = $this->session->userdata('aileenuser');

        $contition_array = array('user_id' => $userid, 'is_delete' => 0, 'status' => 1);


        $userdata = $this->data['userdata']= $this->common->select_data_by_condition('job_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        if ($userdata) {
            $step = $userdata[0]['job_step'];

            if ($step == 7 || ($step >= 1 && $step <= 7) || $step > 7) {

                $contition_array = array('user_id' => $userid, 'experience !=' => 'Fresher', 'status' => 1);
                $workdata = $this->data['workdata'] = $this->common->select_data_by_condition('job_add_workexp', $contition_array, $data = '*', $sortby = '', $orderby = 'desc', $limit = '', $offset = '', $join_str = array(), $groupby = '');
            }
        }
      
        $this->data['title'] = 'Job Profile'.TITLEPOSTFIX;

        $this->load->view('job/job_work_exp', $this->data);
    }

    public function job_work_exp_insert() {

         $this->job_deactive_profile(); 

        $userid = $this->session->userdata('aileenuser');

        $userdata[] = $_POST;
        $count1 = count($userdata[0]['jobtitle']);
       
        if ($this->input->post('previous')) { 
            redirect('job/work-area', refresh);
        }
        $post_data = $this->input->post();
        

//Click on Add_More_WorkExp Process End

        if ($this->input->post('next')) {

            $exp = $this->input->post('radio');


            if ($exp == "Fresher") {

                $exp = $this->input->post('radio');
                $exp_year = '';
                $exp_month = '';
                $job_title = '';
                $companyname = '';
                $companyemail = '';
                $companyphn = '';
                $certificate1 = '';

                //upload work certificate process end

               
  $contition_array = array('user_id' => $userid, 'status' => 1);
  $jobdata = $this->data['jobdata'] = $this->common->select_data_by_condition('job_add_workexp', $contition_array, $data = '*', $sortby = '', $orderby = 'desc', $limit = '', $offset = '', $join_str = array(), $groupby = '');
               
               //update data at job_add_workexp for fresher table start
               if ($jobdata)
               {
    
                 $data1 = array(
                    'experience' => $exp,
                    'experience_year' => '',
                    'experience_month' => '',
                    'jobtitle' => '',
                    'companyname' => '',
                    'companyemail' => '',
                    'companyphn' => '',
                    'work_certificate' => '',
                    'status' => 1
                );


                $updatedata1 = $this->common->update_data($data1, 'job_add_workexp', 'user_id', $userid);

                $data = array(
                    'experience' => $exp,
                    'modified_date' => date('Y-m-d h:i:s', time())
                );

                $updatedata = $this->common->update_data($data, 'job_reg', 'user_id', $userid);

               }
         //update data at job_add_workexp for fresher table end

 //Insert data at first time job_add_workexp for fresher table start        
         else
               {

                    $data1 = array(
                    'experience' => $exp,
                    'user_id' => $userid,
                    'status' => 1
                );

                $insertid = $this->common->insert_data_getid($data1,'job_add_workexp');

                $data = array(
                    'experience' => $exp,
                    'modified_date' => date('Y-m-d h:i:s', time())
                );


                $updatedata = $this->common->update_data($data, 'job_reg', 'user_id', $userid);
               
            }
          //Insert data at first time job_add_workexp for fresher table end
                         

                if ($updatedata && $updatedata1 || $updatedata && $insertid) {
                    $this->session->set_flashdata('success', 'Work Experience updated successfully');
                    redirect('job/home');
                } else {
                    $this->session->flashdata('error', 'Your data not inserted');
                    redirect('job/work-experience', 'refresh');
                }
            } else {

                $exp = 'Experience';


// Multiple Image insert code start
            $config = array(
            'upload_path' => $this->config->item('job_work_main_upload_path'),
            'allowed_types' => $this->config->item('job_work_main_allowed_types'),
            'max_size' => $this->config->item('job_work_main_max_size')
                );

                $images = array();
                $this->load->library('upload');

                $files = $_FILES;
                $count = count($_FILES['certificate']['name']);


                for ($i = 0; $i < $count; $i++) {

                    $_FILES['certificate']['name'] = $files['certificate']['name'][$i];
                    $_FILES['certificate']['type'] = $files['certificate']['type'][$i];
                    $_FILES['certificate']['tmp_name'] = $files['certificate']['tmp_name'][$i];
                    $_FILES['certificate']['error'] = $files['certificate']['error'][$i];
                    $_FILES['certificate']['size'] = $files['certificate']['size'][$i];

                    $fileName = $_FILES['certificate']['name'];
                    $images[] = $fileName;
                    $config['file_name'] = $fileName;
              
                    $this->upload->initialize($config);
                    $this->upload->do_upload();


                   if ($this->upload->do_upload('certificate')) {
                $response['result'][] = $this->upload->data();
                $job_profile_post_thumb[$i]['image_library'] = 'gd2';
                $job_profile_post_thumb[$i]['source_image'] = $this->config->item('job_work_main_upload_path') . $response['result'][$i]['file_name'];
                $job_profile_post_thumb[$i]['new_image'] = $this->config->item('job_work_thumb_upload_path') . $response['result'][$i]['file_name'];
                $job_profile_post_thumb[$i]['create_thumb'] = TRUE;
                $job_profile_post_thumb[$i]['maintain_ratio'] = TRUE;
                $job_profile_post_thumb[$i]['thumb_marker'] = '';
                $job_profile_post_thumb[$i]['width'] = $this->config->item('job_work_thumb_width');
                $job_profile_post_thumb[$i]['height'] = 2;
                $job_profile_post_thumb[$i]['master_dim'] = 'width';
                $job_profile_post_thumb[$i]['quality'] = "100%";
                $job_profile_post_thumb[$i]['x_axis'] = '0';
                $job_profile_post_thumb[$i]['y_axis'] = '0';
                $instanse = "image_$i";
                //Loading Image Library
                $this->load->library('image_lib', $job_profile_post_thumb[$i], $instanse);
                $dataimage = $response['result'][$i]['file_name'];
                //Creating Thumbnail
                $this->$instanse->resize();
                $response['error'][] = $thumberror = $this->$instanse->display_errors();
                $return['data'][] = $imgdata;
                $return['status'] = "success";
                $return['msg'] = sprintf($this->lang->line('success_item_added'), "Image", "uploaded");


         $contition_array = array('user_id' => $userid);
        $job_reg_data = $this->common->select_data_by_condition('job_add_workexp', $contition_array, $data = 'work_certificate', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        $count_data=count($job_reg_data);

for ($x = 0; $x < $count_data; $x++) {

     $job_reg_prev_image = $job_reg_data[$x]['work_certificate'];
    

    $image_hidden_certificate = $userdata[0]['image_hidden_certificate'][$x];
       $work_certificate = $files['certificate']['name'][$x];


            if ($job_reg_prev_image != '') 
        {
          
            $job_image_main_path = $this->config->item('job_work_main_upload_path');
            $job_bg_full_image = $job_image_main_path . $job_reg_prev_image;
            if (isset($job_bg_full_image)) {
                 if($image_hidden_certificate==$job_reg_prev_image && $work_certificate!= "")
                 {
                        unlink($job_bg_full_image);
                 }
            }
            
            $job_image_thumb_path = $this->config->item('job_work_thumb_upload_path');
            $job_bg_thumb_image = $job_image_thumb_path . $job_reg_prev_image;
            if (isset($job_bg_thumb_image)) {
                if( $image_hidden_certificate==$job_reg_prev_image && $work_certificate!="")
                {
                    unlink($job_bg_thumb_image);
                }
            }


        }
}//for loop end
             }else {

                $dataimage= '';
            }
                }
                // Multiple Image insert code End

                $contition_array = array('user_id' => $userid, 'status' => 1);
                $jobdata = $this->data['jobdata'] = $this->common->select_data_by_condition('job_add_workexp', $contition_array, $data = '*', $sortby = '', $orderby = 'desc', $limit = '', $offset = '', $join_str = array(), $groupby = '');

 //update data at job_add_workexp for Experience table start
                if ($jobdata) {

                    //Edit Multiple field into database Start 
                    for ($x = 0; $x < $count1; $x++) {
                        
                        $exp_data = $userdata[0]['exp_data'][$x];
                        if($exp_data == 'old'){
                       
                        $files[] = $_FILES;
                     
                         $work_certificate = $files['certificate']['name'][$x];

                   
                        if ($work_certificate == "") {
                        
                                 $work_certificate1 = $userdata[0]['image_hidden_certificate'][$x];
                        
                        } else {
                          
                                 $work_certificate1 =  $work_certificate;
                         
                          
                        }
                  

                        $data = array(
                            'user_id' => $userid,
                            'experience' => $exp,
                            'experience_year' => $userdata[0]['experience_year'][$x],
                            'experience_month' => $userdata[0]['experience_month'][$x],
                            'jobtitle' => $userdata[0]['jobtitle'][$x],
                            'companyname' => $userdata[0]['companyname'][$x],
                            'companyemail' => $userdata[0]['companyemail'][$x],
                            'companyphn' => $userdata[0]['companyphn'][$x],
                            'work_certificate'=>  $work_certificate1
                          
                        );

                        $updatedata1 = $this->common->update_data($data, 'job_add_workexp', 'work_id', $jobdata[$x]['work_id']);

                        }


 //update data at job_add_workexp for Experience table End

 //Insert data at job_add_workexp for Experience table start


                        else{
                     
$files[] = $_FILES;
                      
                       $work_certificate = $files['certificate']['name'][$x];

                            $data = array(
                            'user_id' => $userid,
                            'experience' => $exp,
                            'experience_year' => $userdata[0]['experience_year'][$x],
                            'experience_month' => $userdata[0]['experience_month'][$x],
                            'jobtitle' => $userdata[0]['jobtitle'][$x],
                            'companyname' => $userdata[0]['companyname'][$x],
                            'companyemail' => $userdata[0]['companyemail'][$x],
                            'companyphn' => $userdata[0]['companyphn'][$x],
                            'work_certificate' =>  $work_certificate,
                            'status' => 1
                        );

                        $insert_id = $this->common->insert_data_getid($data, 'job_add_workexp');
                        }

                    }
                    //Edit Multiple field into database End 
                  
                        // for deleete fresher data when candidate is experience start
                $contition_array = array('user_id' => $userid, 'experience' => 'Fresher', 'status' => '1');
                $jobdata = $this->common->select_data_by_condition('job_add_workexp', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
               
                $countdata=count($jobdata);
             
                     for ($x = 0; $x < $countdata; $x++) 
                    { 
                      

                        $delete_data = $this->common->delete_data('job_add_workexp', 'work_id', $jobdata[$x]['work_id']);
                    }
                   // for deleete fresher data when candidate is experience ENd
                 } 
                   
//Insert data at job_add_workexp for Experience table End

//when insert and update data both same time Insert data at job_add_workexp for Experience table start

     else {

                    //Add Multiple field into database Start 
                    for ($x = 0; $x < $count1; $x++) {

                        $files[] = $_FILES;
                       $work_certificate = $files['certificate']['name'][$x];
                       
                        $data = array(
                            'user_id' => $userid,
                            'experience' => $exp,
                            'experience_year' => $userdata[0]['experience_year'][$x],
                            'experience_month' => $userdata[0]['experience_month'][$x],
                            'jobtitle' => $userdata[0]['jobtitle'][$x],
                            'companyname' => $userdata[0]['companyname'][$x],
                            'companyemail' => $userdata[0]['companyemail'][$x],
                            'companyphn' => $userdata[0]['companyphn'][$x],
                            'work_certificate' =>   $work_certificate,
                            'status' => 1
                        );

                        $insert_id = $this->common->insert_data_getid($data, 'job_add_workexp');
                        $i++;
                    }

                    //Add Multiple field into database End 

                    // for deleete fresher data when candidate is experience start
                $contition_array = array('user_id' => $userid, 'experience' => 'Fresher', 'status' => '1');
                $jobdata = $this->common->select_data_by_condition('job_add_workexp', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
               
                $countdata=count($jobdata);
                    
                     for ($x = 0; $x < $countdata; $x++) 
                    { 
                      

                        $delete_data = $this->common->delete_data('job_add_workexp', 'work_id', $jobdata[$x]['work_id']);
                    }
                   // for deleete fresher data when candidate is experience ENd
                }
//when insert and update data both same time Insert data at job_add_workexp for Experience table End

                //Update only one field into database start
                $data = array(
                    'experience' => $exp,
                    'modified_date' => date('Y-m-d h:i:s', time())
                );

                $updatedata = $this->common->update_data($data, 'job_reg', 'user_id', $userid);
                //Update only one field into database End



                if ($insert_id && $updatedata || $updatedata1 && $updatedata) {
                    $this->session->set_flashdata('success', 'Work Experience updated successfully');
                    redirect('job/home');
                } else {
                    $this->session->flashdata('error', 'Your data not inserted');
                    redirect('job/work-experience', 'refresh');
                }
            }
        }
    }

    //End first time insert and update

//job seeker WORK EXPERIENCE controller end

    //job seeker PRINTDATA controller Start
    public function job_printpreview($id="") {

        $this->job_deactive_profile(); 

        $userid = $this->session->userdata('aileenuser');

        if ($id == $userid || $id == '') {
           $this->job_apply_check(); 
          
            //for getting data job_reg table
            $contition_array = array('job_reg.user_id' => $userid, 'job_reg.is_delete' => 0, 'job_reg.status' => 1);

            $data = '*';

            $this->data['job'] = $this->common->select_data_by_condition('job_reg', $contition_array, $data, $sortby, $orderby, $limit, $offset, $join_str, $groupby);
         
            //for getting data job_add_edu table
            $contition_array = array('user_id' => $userid, 'status' => '1');

            $data = '*';

            $this->data['job_edu'] = $this->common->select_data_by_condition('job_add_edu', $contition_array, $data, $sortby, $orderby, $limit, $offset, $join_str, $groupby);
            
            //for getting data of graduation table
              $contition_array = array('user_id' => $userid);

            $data = '*';

            $this->data['job_graduation'] = $this->common->select_data_by_condition('job_graduation', $contition_array, $data, $sortby, $orderby, $limit, $offset, $join_str, $groupby);

            //for getting data job_add_workexp table
            $contition_array = array('user_id' => $userid, 'status' => '1');

            $data = '*';

            $this->data['job_work'] = $this->common->select_data_by_condition('job_add_workexp', $contition_array, $data, $sortby, $orderby, $limit, $offset, $join_str, $groupby);
            
            //for getting other skill data
            $contition_array = array('user_id' => $userid, 'type' => 3, 'status' => 1);

            $this->data['other_skill'] = $this->common->select_data_by_condition('skill', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
     
        } else {
             $this->job_avail_check($id);

            //for getting data job_reg table
            $contition_array = array('job_reg.user_id' => $id, 'job_reg.is_delete' => 0, 'job_reg.status' => 1);

            $data = '*';

            $this->data['job'] = $this->common->select_data_by_condition('job_reg', $contition_array, $data, $sortby, $orderby, $limit, $offset, $join_str, $groupby);


        $contition_array = array('user_id' => $id, 'status' => 1);
         $this->data['job_edu'] = $this->common->select_data_by_condition('job_add_edu', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

 $contition_array = array('user_id' => $id);

            $data = '*';

            $this->data['job_graduation'] = $this->common->select_data_by_condition('job_graduation', $contition_array, $data, $sortby, $orderby, $limit, $offset, $join_str, $groupby);
           
            //for getting data job_add_workexp table
            $contition_array = array('user_id' => $id, 'experience' => 'Experience', 'status' => '1');

            $data = '*';

            $this->data['job_work'] = $this->common->select_data_by_condition('job_add_workexp', $contition_array, $data, $sortby, $orderby, $limit, $offset, $join_str, $groupby);
            
             //for getting other skill data
            $contition_array = array('user_id' => $id, 'type' => 3, 'status' => 1);

            $this->data['other_skill'] = $this->common->select_data_by_condition('skill', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
        }

//For Counting Profile data start
    $contition_array = array('user_id'=> $userid,'status' => '1','is_delete'=> '0');

    $job_reg   = $this->common->select_data_by_condition('job_reg', $contition_array, $data = 'fname,lname,email,experience,keyskill,work_job_title,work_job_industry,work_job_city,phnno,language,dob,gender,city_id,pincode,address,project_name,project_duration,project_description,training_as,training_duration,training_organization', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby=array());

    $count = 0;

    if($job_reg[0]['fname'] != ''){
        $count++;
    }
    if($job_reg[0]['lname'] != ''){
        $count++;
    }
    if($job_reg[0]['email'] != ''){
        $count++;
    }
    if($job_reg[0]['keyskill'] != ''){
        $count++;
    }
  
    if($job_reg[0]['work_job_title'] != ''){
        $count++;
    }
    if($job_reg[0]['work_job_industry'] != ''){
        $count++;
    }
    if($job_reg[0]['work_job_city'] != ''){
        $count++;
    }
    if($job_reg[0]['phnno'] != ''){
        $count++;
    }
    if($job_reg[0]['language'] != ''){
        $count++;
    }
    if($job_reg[0]['dob'] != '0000-00-00'){
        $count++;
    }
    if($job_reg[0]['gender'] != ''){
        $count++;
    }
    if($job_reg[0]['city_id'] != '0'){
        $count++;
    }
    if($job_reg[0]['pincode'] != ''){
        $count++;
    }
    if($job_reg[0]['address'] != ''){
        $count++;
    }
    if($job_reg[0]['project_name'] != ''){
        $count++;
    }
    if($job_reg[0]['project_duration'] != ''){
        $count++;
    }
    if($job_reg[0]['project_description'] != ''){
        $count++;
    }
    if($job_reg[0]['training_as'] != ''){
        $count++;
    }
    if($job_reg[0]['training_duration'] != ''){
        $count++;
    }
    if($job_reg[0]['training_organization'] != ''){
        $count++;
    }

     $contition_array = array('user_id' => $userid, 'status' => '1','is_delete' => '0');
    $job_add_edu = $this->common->select_data_by_condition('job_add_edu', $contition_array, $data = '*', $sortby = '', $orderby = 'desc', $limit = '', $offset = '', $join_str = array(), $groupby = '');

    $contition_array = array('user_id' => $userid);
$jobgrad  = $this->common->select_data_by_condition('job_graduation', $contition_array, $data = '*', $sortby = '', $orderby = 'desc', $limit = '', $offset = '', $join_str = array(), $groupby = '');
  

     if($job_add_edu[0]['board_primary'] != '' || $job_add_edu[0]['board_secondary'] != ''  || $job_add_edu[0]['board_higher_secondary'] != '' || $jobgrad[0]['degree'] != '' ){
        $count++;
    }
     if(($job_add_edu[0]['board_primary'] != '' && $job_add_edu[0]['edu_certificate_primary'] != '') || ($job_add_edu[0]['board_secondary'] != '' && $job_add_edu[0]['edu_certificate_secondary'] != '')  || ($job_add_edu[0]['board_higher_secondary'] != '' && $job_add_edu[0]['edu_certificate_higher_secondary'] != '') || ($jobgrad[0]['degree'] != ''  && $jobgrad[0]['grade'] != '' && $jobgrad[0]['edu_certificate'] != '')){
        $count++;
    }
   

  $contition_array = array('user_id' => $userid, 'experience !=' => 'Fresher', 'status' => 1);
  $workdata = $this->common->select_data_by_condition('job_add_workexp', $contition_array, $data = '*', $sortby = '', $orderby = 'desc', $limit = '', $offset = '', $join_str = array(), $groupby = '');
  
   if(($job_reg[0]['experience'] != '' && $job_reg[0]['experience'] != 'Experience') || ($workdata[0]['experience_year'] != '' && $workdata[0]['companyemail'] != '' && $workdata[0]['companyphn'] != '' && $workdata[0]['work_certificate'] != '')){
        $count++;
    }

     $count_profile=($count*100)/23;
     $this->data['count_profile']=  $count_profile;
     $this->data['count_profile_value']= ($count_profile/100);

      $jobseeker_name = $this->get_jobseeker_name($id);
      $this->data['title'] = $jobseeker_name.TITLEPOSTFIX;

        $this->load->view('job/job_printpreview', $this->data);
       
    }

    //job seeker PRINTDATA controller end
   
     //job seeker Job All Post Start
    public function job_all_post() {

        $this->job_apply_check(); 
        $this->job_deactive_profile(); 

        $this->data['userid'] = $userid = $this->session->userdata('aileenuser');

     //For Counting Profile data start
    $contition_array = array('user_id'=> $userid,'status' => '1','is_delete'=> '0');

    $job_reg   = $this->common->select_data_by_condition('job_reg', $contition_array, $data = 'fname,lname,email,experience,keyskill,work_job_title,work_job_industry,work_job_city,phnno,language,dob,gender,city_id,pincode,address,project_name,project_duration,project_description,training_as,training_duration,training_organization', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby=array());

    $count = 0;

    if($job_reg[0]['fname'] != ''){
        $count++;
    }
    if($job_reg[0]['lname'] != ''){
        $count++;
    }
    if($job_reg[0]['email'] != ''){
        $count++;
    }
    if($job_reg[0]['keyskill'] != ''){
        $count++;
    }
   
    if($job_reg[0]['work_job_title'] != ''){
        $count++;
    }
    if($job_reg[0]['work_job_industry'] != ''){
        $count++;
    }
    if($job_reg[0]['work_job_city'] != ''){
        $count++;
    }
    if($job_reg[0]['phnno'] != ''){
        $count++;
    }
    if($job_reg[0]['language'] != ''){
        $count++;
    }
    if($job_reg[0]['dob'] != '0000-00-00'){
        $count++;
    }
    if($job_reg[0]['gender'] != ''){
        $count++;
    }
    if($job_reg[0]['city_id'] != '0'){
        $count++;
    }
    if($job_reg[0]['pincode'] != ''){
        $count++;
    }
    if($job_reg[0]['address'] != ''){
        $count++;
    }
    if($job_reg[0]['project_name'] != ''){
        $count++;
    }
    if($job_reg[0]['project_duration'] != ''){
        $count++;
    }
    if($job_reg[0]['project_description'] != ''){
        $count++;
    }
    if($job_reg[0]['training_as'] != ''){
        $count++;
    }
    if($job_reg[0]['training_duration'] != ''){
        $count++;
    }
    if($job_reg[0]['training_organization'] != ''){
        $count++;
    }

     $contition_array = array('user_id' => $userid, 'status' => '1','is_delete' => '0');
    $job_add_edu = $this->common->select_data_by_condition('job_add_edu', $contition_array, $data = '*', $sortby = '', $orderby = 'desc', $limit = '', $offset = '', $join_str = array(), $groupby = '');

    $contition_array = array('user_id' => $userid);
$jobgrad  = $this->common->select_data_by_condition('job_graduation', $contition_array, $data = '*', $sortby = '', $orderby = 'desc', $limit = '', $offset = '', $join_str = array(), $groupby = '');
  

     if($job_add_edu[0]['board_primary'] != '' || $job_add_edu[0]['board_secondary'] != ''  || $job_add_edu[0]['board_higher_secondary'] != '' || $jobgrad[0]['degree'] != '' ){
        $count++;
    }
     if(($job_add_edu[0]['board_primary'] != '' && $job_add_edu[0]['edu_certificate_primary'] != '') || ($job_add_edu[0]['board_secondary'] != '' && $job_add_edu[0]['edu_certificate_secondary'] != '')  || ($job_add_edu[0]['board_higher_secondary'] != '' && $job_add_edu[0]['edu_certificate_higher_secondary'] != '') || ($jobgrad[0]['degree'] != ''  && $jobgrad[0]['grade'] != '' && $jobgrad[0]['edu_certificate'] != '')){
        $count++;
    }
   

  $contition_array = array('user_id' => $userid, 'experience !=' => 'Fresher', 'status' => 1);
  $workdata = $this->common->select_data_by_condition('job_add_workexp', $contition_array, $data = '*', $sortby = '', $orderby = 'desc', $limit = '', $offset = '', $join_str = array(), $groupby = '');
 

   if(($job_reg[0]['experience'] != '' && $job_reg[0]['experience'] != 'Experience') || ($workdata[0]['experience_year'] != '' && $workdata[0]['companyemail'] != '' && $workdata[0]['companyphn'] != '' && $workdata[0]['work_certificate'] != '')){
        $count++;
    }

     $count_profile=($count*100)/23;
     $this->data['count_profile']=  $count_profile;
     $this->data['count_profile_value']= ($count_profile/100);

      $this->data['title'] = 'Job Profile'.TITLEPOSTFIX;

        $this->load->view('job/job_all_post', $this->data);
    }

    //job seeker Job All Post controller end
    //job seeker Apply post at all post page & save post page controller Start
    public function job_apply_post() {  
       $this->job_apply_check(); 
       $this->job_deactive_profile(); 

        $id = $_POST['post_id'];
        $para = $_POST['allpost'];
        $notid = $_POST['userid'];

        $userid = $this->session->userdata('aileenuser');

        $contition_array = array('post_id' => $id, 'user_id' => $userid, 'is_delete' => 0);
        $userdata = $this->common->select_data_by_condition('job_apply', $contition_array, $data = '*', $sortby = '', $orderby = 'desc', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        $app_id = $userdata[0]['app_id'];

        if ($userdata) {

            $contition_array = array('job_delete' => 1);
            $jobdata = $this->common->select_data_by_condition('job_apply', $contition_array, $data = 'app_id', $sortby = '', $orderby = 'desc', $limit = '', $offset = '', $join_str = array(), $groupby = '');

            $data = array(
                'job_delete' => 0,
                'modify_date'=> date('Y-m-d h:i:s', time()),
                
            );


            $updatedata = $this->common->update_data($data, 'job_apply', 'app_id', $app_id);


            // insert notification

            $data = array(
                'not_type' => 3,
                'not_from_id' => $userid,
                'not_to_id' => $notid,
                'not_read' => 2,
                'not_from' => 2,
                'not_product_id' => $app_id,
                'not_active' => 1


            );

            $updatedata = $this->common->insert_data_getid($data, 'notification');
            // end notoification

            if ($updatedata) {

                if ($para == 'all') {
                    $applypost = 'Applied';
                }
            }
            echo $applypost;
        } else {

            $data = array(
                'post_id' => $id,
                'user_id' => $userid,
                'status' => 1,
                'created_date' => date('Y-m-d h:i:s', time()),
                'modify_date'=> date('Y-m-d h:i:s', time()),
                'is_delete' => 0,
                'job_delete' => 0
            );


            $insert_id = $this->common->insert_data_getid($data, 'job_apply');


            // insert notification

            $data = array(
                'not_type' => 3,
                'not_from_id' => $userid,
                'not_to_id' => $notid,
                'not_read' => 2,
                'not_from' => 2,
                'not_product_id' => $insert_id,
                'not_active' => 1,
                'not_created_date' => date('Y-m-d H:i:s')
            );

            $updatedata = $this->common->insert_data_getid($data, 'notification');
            // end notoification


            if ($insert_id) {

                $applypost = 'Applied';
            }
            echo $applypost;
        }
    }

   

public function job_applied_post() {

   $this->job_apply_check(); 
   $this->job_deactive_profile(); 

        $this->data['userid'] = $userid = $this->session->userdata('aileenuser');
  
 //For Counting Profile data start
    $contition_array = array('user_id'=> $userid,'status' => '1','is_delete'=> '0');

    $job_reg   = $this->common->select_data_by_condition('job_reg', $contition_array, $data = 'fname,lname,email,experience,keyskill,work_job_title,work_job_industry,work_job_city,phnno,language,dob,gender,city_id,pincode,address,project_name,project_duration,project_description,training_as,training_duration,training_organization', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby=array());


    $count = 0;

    if($job_reg[0]['fname'] != ''){
        $count++;
    }
    if($job_reg[0]['lname'] != ''){
        $count++;
    }
    if($job_reg[0]['email'] != ''){
        $count++;
    }
    if($job_reg[0]['keyskill'] != ''){
        $count++;
    }
   
    if($job_reg[0]['work_job_title'] != ''){
        $count++;
    }
    if($job_reg[0]['work_job_industry'] != ''){
        $count++;
    }
    if($job_reg[0]['work_job_city'] != ''){
        $count++;
    }
    if($job_reg[0]['phnno'] != ''){
        $count++;
    }
    if($job_reg[0]['language'] != ''){
        $count++;
    }
    if($job_reg[0]['dob'] != '0000-00-00'){
        $count++;
    }
    if($job_reg[0]['gender'] != ''){
        $count++;
    }
    if($job_reg[0]['city_id'] != '0'){
        $count++;
    }
    if($job_reg[0]['pincode'] != ''){
        $count++;
    }
    if($job_reg[0]['address'] != ''){
        $count++;
    }
    if($job_reg[0]['project_name'] != ''){
        $count++;
    }
    if($job_reg[0]['project_duration'] != ''){
        $count++;
    }
    if($job_reg[0]['project_description'] != ''){
        $count++;
    }
    if($job_reg[0]['training_as'] != ''){
        $count++;
    }
    if($job_reg[0]['training_duration'] != ''){
        $count++;
    }
    if($job_reg[0]['training_organization'] != ''){
        $count++;
    }

     $contition_array = array('user_id' => $userid, 'status' => '1','is_delete' => '0');
    $job_add_edu = $this->common->select_data_by_condition('job_add_edu', $contition_array, $data = '*', $sortby = '', $orderby = 'desc', $limit = '', $offset = '', $join_str = array(), $groupby = '');

    $contition_array = array('user_id' => $userid);
$jobgrad  = $this->common->select_data_by_condition('job_graduation', $contition_array, $data = '*', $sortby = '', $orderby = 'desc', $limit = '', $offset = '', $join_str = array(), $groupby = '');
  

     if($job_add_edu[0]['board_primary'] != '' || $job_add_edu[0]['board_secondary'] != ''  || $job_add_edu[0]['board_higher_secondary'] != '' || $jobgrad[0]['degree'] != '' ){
        $count++;
    }
     if(($job_add_edu[0]['board_primary'] != '' && $job_add_edu[0]['edu_certificate_primary'] != '') || ($job_add_edu[0]['board_secondary'] != '' && $job_add_edu[0]['edu_certificate_secondary'] != '')  || ($job_add_edu[0]['board_higher_secondary'] != '' && $job_add_edu[0]['edu_certificate_higher_secondary'] != '') || ($jobgrad[0]['degree'] != ''  && $jobgrad[0]['grade'] != '' && $jobgrad[0]['edu_certificate'] != '')){
        $count++;
    }
   

  $contition_array = array('user_id' => $userid, 'experience !=' => 'Fresher', 'status' => 1);
  $workdata = $this->common->select_data_by_condition('job_add_workexp', $contition_array, $data = '*', $sortby = '', $orderby = 'desc', $limit = '', $offset = '', $join_str = array(), $groupby = '');
 
   if(($job_reg[0]['experience'] != '' && $job_reg[0]['experience'] != 'Experience') || ($workdata[0]['experience_year'] != '' && $workdata[0]['companyemail'] != '' && $workdata[0]['companyphn'] != '' && $workdata[0]['work_certificate'] != '')){
        $count++;
    }

     $count_profile=($count*100)/23;
     $this->data['count_profile']=  $count_profile;
     $this->data['count_profile_value']= ($count_profile/100);

//For Counting Profile data End
     $jobseeker_name = $this->get_jobseeker_name($id);
     $this->data['title'] = $jobseeker_name.TITLEPOSTFIX;

        $this->load->view('job/job_applied_post', $this->data);
    }


    //job seeker view all applied post controller End
//job seeker Delete all Applied & Save post controller Start
    public function job_delete_apply() {

        $this->job_deactive_profile(); 

        $id = $_POST['app_id'];
        $para = $_POST['para'];
        $userid = $this->session->userdata('aileenuser');

        $data = array(
            'job_delete' => 1,
            'job_save' => 3,
            'modify_date' => date('Y-m-d h:i:s', time())
        );

        $updatedata = $this->common->update_data($data, 'job_apply', 'app_id', $id);
    }

    //job seeker Delete all Applied & Save post controller End
//job seeker Save post controller Start

    public function job_save() {

        $this->job_deactive_profile(); 

        $id = $_POST['post_id'];


        $userid = $this->session->userdata('aileenuser');

        $contition_array = array('post_id' => $id, 'user_id' => $userid, 'is_delete' => 0);
        $userdata = $this->common->select_data_by_condition('job_apply', $contition_array, $data = '*', $sortby = 'post_id', $orderby = 'asc', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        $app_id = $userdata[0]['app_id'];

        if ($userdata) {

            $contition_array = array('job_delete' => 0);
            $jobdata = $this->common->select_data_by_condition('job_apply', $contition_array = array(), $data = '*', $sortby = 'post_id', $orderby = 'asc', $limit = '', $offset = '', $join_str = array(), $groupby = '');

            $data = array(
                'job_delete' => 1,
                'job_save' => 2
            );

            $updatedata = $this->common->update_data($data, 'job_apply', 'app_id', $app_id);


            if ($updatedata) {

                $savepost = 'Saved';
            }
            echo $savepost;
        } else {

            $data = array(
                'post_id' => $id,
                'user_id' => $userid,
                'status' => 1,
                'created_date' => date('Y-m-d h:i:s', time()),
                'modify_date' => date('Y-m-d h:i:s', time()),
                'is_delete' => 0,
                'job_delete' => 1,
                'job_save' => 2
            );

            $insert_id = $this->common->insert_data_getid($data, 'job_apply');
            if ($insert_id) {

                $savepost = 'Saved';
            } echo $savepost;
        }
    }

//job seeker Save post controller End

//job seeker view all Saved post controller Start
    public function job_save_post() {
       $this->job_apply_check(); 
       $this->job_deactive_profile(); 

        $this->data['userid'] = $userid = $this->session->userdata('aileenuser');

//For Counting Profile data start
    $contition_array = array('user_id'=> $userid,'status' => '1','is_delete'=> '0');

    $job_reg   = $this->common->select_data_by_condition('job_reg', $contition_array, $data = 'fname,lname,email,experience,keyskill,work_job_title,work_job_industry,work_job_city,phnno,language,dob,gender,city_id,pincode,address,project_name,project_duration,project_description,training_as,training_duration,training_organization', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby=array());

    $count = 0;

    if($job_reg[0]['fname'] != ''){
        $count++;
    }
    if($job_reg[0]['lname'] != ''){
        $count++;
    }
    if($job_reg[0]['email'] != ''){
        $count++;
    }
    if($job_reg[0]['keyskill'] != ''){
        $count++;
    }
    
    if($job_reg[0]['work_job_title'] != ''){
        $count++;
    }
    if($job_reg[0]['work_job_industry'] != ''){
        $count++;
    }
    if($job_reg[0]['work_job_city'] != ''){
        $count++;
    }
    if($job_reg[0]['phnno'] != ''){
        $count++;
    }
    if($job_reg[0]['language'] != ''){
        $count++;
    }
    if($job_reg[0]['dob'] != '0000-00-00'){
        $count++;
    }
    if($job_reg[0]['gender'] != ''){
        $count++;
    }
    if($job_reg[0]['city_id'] != '0'){
        $count++;
    }
    if($job_reg[0]['pincode'] != ''){
        $count++;
    }
    if($job_reg[0]['address'] != ''){
        $count++;
    }
    if($job_reg[0]['project_name'] != ''){
        $count++;
    }
    if($job_reg[0]['project_duration'] != ''){
        $count++;
    }
    if($job_reg[0]['project_description'] != ''){
        $count++;
    }
    if($job_reg[0]['training_as'] != ''){
        $count++;
    }
    if($job_reg[0]['training_duration'] != ''){
        $count++;
    }
    if($job_reg[0]['training_organization'] != ''){
        $count++;
    }

     $contition_array = array('user_id' => $userid, 'status' => '1','is_delete' => '0');
    $job_add_edu = $this->common->select_data_by_condition('job_add_edu', $contition_array, $data = '*', $sortby = '', $orderby = 'desc', $limit = '', $offset = '', $join_str = array(), $groupby = '');

    $contition_array = array('user_id' => $userid);
$jobgrad  = $this->common->select_data_by_condition('job_graduation', $contition_array, $data = '*', $sortby = '', $orderby = 'desc', $limit = '', $offset = '', $join_str = array(), $groupby = '');
  

     if($job_add_edu[0]['board_primary'] != '' || $job_add_edu[0]['board_secondary'] != ''  || $job_add_edu[0]['board_higher_secondary'] != '' || $jobgrad[0]['degree'] != '' ){
        $count++;
    }
     if(($job_add_edu[0]['board_primary'] != '' && $job_add_edu[0]['edu_certificate_primary'] != '') || ($job_add_edu[0]['board_secondary'] != '' && $job_add_edu[0]['edu_certificate_secondary'] != '')  || ($job_add_edu[0]['board_higher_secondary'] != '' && $job_add_edu[0]['edu_certificate_higher_secondary'] != '') || ($jobgrad[0]['degree'] != ''  && $jobgrad[0]['grade'] != '' && $jobgrad[0]['edu_certificate'] != '')){
        $count++;
    }
   

  $contition_array = array('user_id' => $userid, 'experience !=' => 'Fresher', 'status' => 1);
  $workdata = $this->common->select_data_by_condition('job_add_workexp', $contition_array, $data = '*', $sortby = '', $orderby = 'desc', $limit = '', $offset = '', $join_str = array(), $groupby = '');
 

   if(($job_reg[0]['experience'] != '' && $job_reg[0]['experience'] != 'Experience') || ($workdata[0]['experience_year'] != '' && $workdata[0]['companyemail'] != '' && $workdata[0]['companyphn'] != '' && $workdata[0]['work_certificate'] != '')){
        $count++;
    }

     $count_profile=($count*100)/23;
     $this->data['count_profile']=  $count_profile;
     $this->data['count_profile_value']= ($count_profile/100);
//For Counting Profile data End


     $jobseeker_name = $this->get_jobseeker_name($id);
     $this->data['title'] = $jobseeker_name.TITLEPOSTFIX;

        $this->load->view('job/job_save_post', $this->data);
    }

    //job seeker view all Saved post controller End

//for pop up image

    public function user_image_insert() {

       $this->job_deactive_profile(); 
        
        $userid = $this->session->userdata('aileenuser');
 

        if ($this->input->post('cancel1')) {
            redirect('job/home', refresh);
        } elseif ($this->input->post('cancel2')) {
            redirect('job/resume', refresh);
        } elseif ($this->input->post('cancel3')) {
            redirect('job/applied-job', refresh);
        } elseif ($this->input->post('cancel4')) {
            redirect('job/saved-job', refresh);
        }

        if (empty($_FILES['profilepic']['name'])) {
            $this->form_validation->set_rules('profilepic', 'Upload profilepic', 'required');
        } else {
          
           
             $job_image = '';
            $job['upload_path'] = $this->config->item('job_profile_main_upload_path');
            $job['allowed_types'] = $this->config->item('job_profile_main_allowed_types');
            $job['max_size'] = $this->config->item('job_profile_main_max_size');
            $job['max_width'] = $this->config->item('job_profile_main_max_width');
            $job['max_height'] = $this->config->item('job_profile_main_max_height');
            $this->load->library('upload');
            $this->upload->initialize($job);
            //Uploading Image
            $this->upload->do_upload('profilepic');
            //Getting Uploaded Image File Data
            $imgdata = $this->upload->data();
            $imgerror = $this->upload->display_errors();
            if ($imgerror == '') {
                //Configuring Thumbnail 
                $job_thumb['image_library'] = 'gd2';
                $job_thumb['source_image'] = $job['upload_path'] . $imgdata['file_name'];
                $job_thumb['new_image'] = $this->config->item('job_profile_thumb_upload_path') . $imgdata['file_name'];
                $job_thumb['create_thumb'] = TRUE;
                $job_thumb['maintain_ratio'] = TRUE;
                $job_thumb['thumb_marker'] = '';
                $job_thumb['width'] = $this->config->item('job_profile_thumb_width');
                $job_thumb['height'] = 2;
                $job_thumb['master_dim'] = 'width';
                $job_thumb['quality'] = "100%";
                $job_thumb['x_axis'] = '0';
                $job_thumb['y_axis'] = '0';
                //Loading Image Library
                $this->load->library('image_lib', $job_thumb);
                $dataimage = $imgdata['file_name'];
                //Creating Thumbnail
                $this->image_lib->resize();
                $thumberror = $this->image_lib->display_errors();
            } else {

                $thumberror = '';
            }
            if ($imgerror != '' || $thumberror != '') {
                 

                $error[0] = $imgerror;
                $error[1] = $thumberror;
            } else {
                 

                $error = array();
            }
            if ($error) {
               
                $this->session->set_flashdata('error', $error[0]);
                $redirect_url = site_url('job');
                redirect($redirect_url, 'refresh');
            } else {
               $contition_array = array('user_id' => $userid);
        $job_reg_data = $this->common->select_data_by_condition('job_reg', $contition_array, $data = 'job_user_image', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        $job_reg_prev_image = $job_reg_data[0]['job_user_image'];
        

            if ($job_reg_prev_image != '') {
            $job_image_main_path = $this->config->item('job_profile_main_upload_path');
            $job_bg_full_image = $job_image_main_path . $job_reg_prev_image;
            if (isset($job_bg_full_image)) {
                unlink($job_bg_full_image);
            }
            
            $job_image_thumb_path = $this->config->item('job_profile_thumb_upload_path');
            $job_bg_thumb_image = $job_image_thumb_path . $job_reg_prev_image;
            if (isset($job_bg_thumb_image)) {
                unlink($job_bg_thumb_image);
            }


        }

                $job_image = $imgdata['file_name'];
            }



            $data = array(
                'job_user_image' => $job_image,
                'modified_date' => date('Y-m-d', time())
            );

            $updatdata = $this->common->update_data($data, 'job_reg', 'user_id', $userid);

            if ($updatdata) {
                if ($this->input->post('hitext') == 1) {
                    redirect('job/home', refresh);
                } elseif ($this->input->post('hitext') == 2) {
                    redirect('job/resume', refresh);
                } elseif ($this->input->post('hitext') == 3) {
                    redirect('job/applied-job', refresh);
                } elseif ($this->input->post('hitext') == 4) {
                    redirect('job/saved-job', refresh);
                }
            } else {
                $this->session->flashdata('error', 'Your data not inserted');
                redirect('job/home', refresh);
            }
        }
    }

// pop image end

//job serach user for recruiter start 

    public function job_user($id) {

         $this->job_deactive_profile(); 

        $userid = $this->session->userdata('aileenuser');

        $contition_array = array('job_reg.user_id' => $id, 'job_reg.is_delete' => 0);

        $data = '*';

        $this->jobdata['job'] = $this->common->select_data_by_condition('job_reg', $contition_array, $data, $sortby, $orderby, $limit, $offset, $join_str, $groupby);



        $this->load->view('job/job_printpreview', $this->jobdata);
    }

//job user end

    //deactivate user start
    public function deactivate() {

        $id = $_POST['id'];

        $data = array(
            'status' => 0
        );

        $update = $this->common->update_data($data, 'job_reg', 'user_id', $id);
       
    }

// deactivate user end
   
// cover pic controller

    public function ajaxpro() {

       $this->job_deactive_profile(); 

        $userid = $this->session->userdata('aileenuser');

        $contition_array = array('user_id' => $userid);
        $job_reg_data = $this->common->select_data_by_condition('job_reg', $contition_array, $data = 'profile_background', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

          $job_reg_prev_image = $job_reg_data[0]['profile_background'];
        $job_reg_prev_main_image = $job_reg_data[0]['profile_background_main'];

        if ($job_reg_prev_image != '') {
            $job_image_main_path = $this->config->item('job_bg_main_upload_path');
            $job_bg_full_image = $job_image_main_path . $job_reg_prev_image;
            if (isset($job_bg_full_image)) {
                unlink($job_bg_full_image);
            }
            
            $job_image_thumb_path = $this->config->item('job_bg_thumb_upload_path');
            $job_bg_thumb_image = $job_image_thumb_path . $job_reg_prev_image;
            if (isset($job_bg_thumb_image)) {
                unlink($job_bg_thumb_image);
            }
        }
        if ($job_reg_prev_main_image != '') {
            $job_image_original_path = $this->config->item('job_bg_original_upload_path');
            $job_bg_origin_image = $job_image_original_path . $user_reg_prev_main_image;
            if (isset($job_bg_origin_image)) {
                unlink($job_bg_origin_image);
            }
        }
        
        $data = $_POST['image'];


        $job_bg_path = $this->config->item('job_bg_main_upload_path');
        $imageName = time() . '.png';
        $base64string = $data;
        file_put_contents($job_bg_path . $imageName, base64_decode(explode(',', $base64string)[1]));

        $job_thumb_path = $this->config->item('job_bg_thumb_upload_path');
        $job_thumb_width = $this->config->item('job_bg_thumb_width');
        $job_thumb_height = $this->config->item('job_bg_thumb_height');

        $upload_image = $job_bg_path . $imageName;

        $thumb_image_uplode = $this->thumb_img_uplode($upload_image, $imageName, $job_thumb_path, $job_thumb_width, $job_thumb_height);
        $data = array(
            'profile_background' => $imageName
        );

        $update = $this->common->update_data($data, 'job_reg', 'user_id', $userid);

        $this->data['jobdata'] = $this->common->select_data_by_id('job_reg', 'user_id', $userid, $data = '*', $join_str = array());

        echo '<img src="' . $this->data['jobdata'][0]['profile_background'] . '" />';
    }

    public function image() {

         $this->job_deactive_profile(); 

        $userid = $this->session->userdata('aileenuser');

        $config['upload_path'] = $this->config->item('job_bg_original_upload_path');
        $config['allowed_types'] = $this->config->item('job_bg_allowed_types');
        $config['file_name'] = $_FILES['image']['name'];

        //Load upload library and initialize configuration
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        if ($this->upload->do_upload('image')) {

            $uploadData = $this->upload->data();
            $image = $uploadData['file_name'];
        } else {
            $image = '';
        }


        $data = array(
            'profile_background_main' => $image,
            'modified_date' => date('Y-m-d h:i:s', time())
        );


        $updatedata = $this->common->update_data($data, 'job_reg', 'user_id', $userid);

        if ($updatedata) {
            echo $userid;
        } else {
            echo "welcome";
        }
    }

    public function ajax_designation() {

        $this->job_deactive_profile(); 

        $userid = $this->session->userdata('aileenuser');

        $data = array(
            'designation' => $_POST['designation']
        );
        $updatedata = $this->common->update_data($data, 'job_reg', 'user_id', $userid);
       
    }

// cover pic end


//reactivate account start

    public function reactivate() {

        $userid = $this->session->userdata('aileenuser');
        $data = array(
            'status' => 1,
            'modified_date' => date('y-m-d h:i:s')
        );

        $updatdata = $this->common->update_data($data, 'job_reg', 'user_id', $userid);
        if ($updatdata) {

            redirect('job/home', refresh);
        } else {

            redirect('job/reactivate', refresh);
        }
    }

    public function job_work_delete(){
        $work_id = $_POST['work_id'];
         $certificate= $_POST['certificate'];

        $delete_data = $this->common->delete_data('job_add_workexp', 'work_id', $work_id);

        //FOR DELETE IMAGE AND PDF IN FOLDER START
            $path='uploads/job_work/main/'.$certificate;
            $path1='uploads/job_work/thumbs/'.$certificate;
          
            echo 1;
        
    } 
    public function job_edu_delete(){
        $grade_id = $_POST['grade_id'];
        $certificate= $_POST['certificate'];
        $delete_data = $this->common->delete_data('job_graduation', 'job_graduation_id', $grade_id);

        $path='uploads/job_education/main/'.$certificate;
        $path1='uploads/job_education/thumbs/'.$certificate;
           
        unlink($path); 
        unlink($path1); 

        if($delete_data){
            echo 1;
        }
    }
//reactivate accont end 

//add other_university into database start 
 public function job_other_university(){
        $other_university = $_POST['other_university'];
         $this->data['userid'] = $userid = $this->session->userdata('aileenuser');
 
          $contition_array = array('is_delete' => '0','university_name' => $other_university);
         $search_condition = "((status = '2' AND user_id = $userid) OR (status = '1'))";
              $userdata = $this->data['userdata'] = $this->common->select_data_by_search('university', $search_condition, $contition_array, $data = '*', $sortby = 'university_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');
              $count=count($userdata);
           
     if($other_university != NULL)
     {
        if($count==0)
        {
                  $data = array(
                    'university_name' => $other_university,
                     'created_date' => date('Y-m-d h:i:s', time()),
                     'status' => 2,
                    'is_delete' => 0,
                    'is_other' => '1',
                    'user_id' => $userid
                    );
        $insert_id = $this->common->insert_data_getid($data, 'university');
                if($insert_id) 
                {
        
             $contition_array = array('is_delete' => '0','university_name !=' => "Other");
             $search_condition = "((status = '2' AND user_id = $userid) OR (status = '1'))";
               $university = $this->data['university'] = $this->common->select_data_by_search('university', $search_condition, $contition_array, $data = '*', $sortby = 'university_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');
           
                if (count($university) > 0) {
                $select = '<option value="" selected option disabled>Select your University</option>';
                
                foreach ($university as $st) {
                $select .= '<option value="' . $st['university_id'] . '"';
                 if($st['university_name'] == $other_university){
                            $select .= 'selected'; 
                       }
                       $select .=    '>' . $st['university_name'] . '</option>';
                 
                    }      
                }  
//For Getting Other at end
$contition_array = array('is_delete' => '0' , 'status' => 1,'university_name' => "Other");
$university_otherdata = $this->common->select_data_by_condition('university', $contition_array, $data = '*', $sortby = 'university_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');  
     
 $select .= '<option value="' . $university_otherdata[0]['university_id'] . '">' . $university_otherdata[0]['university_name'] . '</option>';   
        
 //for getting university data in clone start
$select1 = '<option value="" selected option disabled>Select your University</option>';
 foreach ($university as $st) {
    
     $select1 .= '<option value="' . $st['university_id'] . '">'. $st['university_name'] .'</option>';
     
 }
 $select1 .= '<option value="' . $university_otherdata[0]['university_id'] . '">' . $university_otherdata[0]['university_name'] . '</option>';   
 //for getting university data in clone End
 
                 }
    }
    
  
    else{
            $select .= 0;
            }
    }
    else
    {
        $select .= 1;
    }
     echo json_encode(array(
                            "select" => $select,
                            "select1" => $select1,
                   ));
}
//add other_university into database End 

//add other_degree into database start 
 public function job_other_degree(){
        $other_degree = $_POST['other_degree'];
        $other_stream = $_POST['other_stream'];
        
         $this->data['userid'] = $userid = $this->session->userdata('aileenuser');

           $contition_array = array('is_delete' => '0','degree_name' => $other_degree);
         $search_condition = "((status = '2' AND user_id = $userid) OR (status = '1'))";
         $userdata = $this->data['userdata'] = $this->common->select_data_by_search('degree', $search_condition, $contition_array, $data = '*', $sortby = 'degree_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');
          $count=count($userdata);
              
         
    if($other_degree != NULL)
     {
        if($count==0)
        {
                  $data = array(
                    'degree_name' => $other_degree,
                     'created_date' => date('Y-m-d h:i:s', time()),
                     'status' => 2,
                    'is_delete' => 0,
                    'is_other' => '1',
                    'user_id' => $userid
                    );
        $insert_id = $this->common->insert_data_getid($data, 'degree');
        $degree_id=$insert_id;
        
        $contition_array = array('is_delete' => '0' , 'status' => 2,'stream_name' => $other_stream,'user_id' => $userid);
        $stream_data = $this->common->select_data_by_condition('stream', $contition_array, $data = '*', $sortby = 'stream_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');  
        $count1=count($stream_data);
        
        if($count1 == 0)
        {
            $data = array(
                    'stream_name' => $other_stream,
                    'degree_id'  => $degree_id,
                     'created_date' => date('Y-m-d h:i:s', time()),
                     'status' => 2,
                    'is_delete' => 0,
                     'is_other' => '1',
                     'user_id' => $userid
                    );
        $insert_id = $this->common->insert_data_getid($data, 'stream');
        }
        else
        {
             $data = array(
                    'stream_name' => $other_stream,
                    'degree_id'  => $degree_id,
                     'created_date' => date('Y-m-d h:i:s', time()),
                     'status' => 2,
                    'is_delete' => 0,
                     'is_other' => '1',
                     'user_id' => $userid
                    );
          $updatedata = $this->common->update_data($data, 'stream', 'stream_id', $stream_data[0]['stream_id']);
        }
         if ($insert_id || $updatedata) 
          {
          
              $contition_array = array('is_delete' => '0','degree_name !=' => "Other");
             $search_condition = "((status = '2' AND user_id = $userid) OR (status = '1'))";
               $degree = $this->data['degree'] = $this->common->select_data_by_search('degree', $search_condition, $contition_array, $data = '*', $sortby = 'degree_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');
            
               if (count($degree) > 0) {
                   
                   $select = '<option value="" Selected option disabled="">Select your Degree</option>';
                
                    foreach ($degree as $st) {
                        
                 $select .= '<option value="' . $st['degree_id'] . '"';
                     if($st['degree_name'] == $other_degree){
                   $select .= 'selected'; 
                       }
                       $select .=    '>' . $st['degree_name'] . '</option>';
                            } 
                }  
//For Getting Other at end
$contition_array = array('is_delete' => '0' , 'status' => 1,'degree_name' => "Other");
$degree_otherdata = $this->common->select_data_by_condition('degree', $contition_array, $data = '*', $sortby = 'degree_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');  
     
$select .= '<option value="' . $degree_otherdata[0]['degree_id'] . '">' . $degree_otherdata[0]['degree_name'] . '</option>';   

 //for getting degree data in clone start
$select1 = '<option value="" Selected option disabled="">Select your Degree</option>';
 foreach ($degree as $st) {
    
     $select1 .= '<option value="' . $st['degree_id'] . '">'. $st['degree_name'] .'</option>';
     
 }
 $select1 .= '<option value="' . $degree_otherdata[0]['degree_id'] . '">' . $degree_otherdata[0]['degree_name'] . '</option>';   
 //for getting degree data in clone End
 
 //for getting selected stream data start
  $contition_array = array('is_delete' => '0','degree_id' => $degree_id);
  $search_condition = "((status = '2' AND user_id = $userid) OR (status = '1'))";
  $stream = $this->data['stream'] = $this->common->select_data_by_search('stream', $search_condition, $contition_array, $data = '*', $sortby = 'stream_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');

 $select2 = '<option value="" Selected option disabled="">Select your Stream</option>';
 $select2 .= '<option value="' . $stream[0]['stream_id'] . '"';
                     if($stream[0]['stream_name'] == $other_stream){
  $select2 .= 'selected'; 
                       }
  $select2 .=    '>' . $stream[0]['stream_name'] . '</option>';
      //for getting selected stream data End         
           }
    }else{
           $select .= 0;
          
            }
    }
    else
    {
        $select .= 1;
       
    }
   
      echo json_encode(array(
                            "select" => $select,
                            "select1" => $select1,
                            "select2" => $select2,
                   ));
}
//add other_degree into database End  

//add other_stream into database start 
 public function job_other_stream(){
        $other_stream = $_POST['other_stream'];
         $this->data['userid'] = $userid = $this->session->userdata('aileenuser');
      
         $contition_array = array('is_delete' => '0','stream_name' => $other_stream);
         $search_condition = "((status = '2' AND user_id = $userid) OR (status = '1'))";
         $userdata = $this->data['userdata'] = $this->common->select_data_by_search('stream', $search_condition, $contition_array, $data = '*', $sortby = 'stream_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');
          $count=count($userdata);
                   
    if($other_stream != NULL)
     {
        if($count==0)
        {
                  $data = array(
                    'stream_name' => $other_stream,
                     'created_date' => date('Y-m-d h:i:s', time()),
                     'status' => 2,
                    'is_delete' => 0,
                     'is_other' => '1',
                     'user_id' => $userid
                    );
        $insert_id = $this->common->insert_data_getid($data, 'stream');
        
        
                if ($insert_id) 
                {
   
               $contition_array = array('is_delete' => '0','stream_name !=' => "Other");
             $search_condition = "((status = '2' AND user_id = $userid) OR (status = '1'))";
               $stream = $this->data['stream'] = $this->common->select_data_by_search('stream', $search_condition, $contition_array, $data = '*', $sortby = 'stream_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');
               
            if (count($stream) > 0) {
               $select = '<option value="" selected option disabled="">Select your Stream</option>';
                
                    foreach ($stream as $st) {
                        
                 $select .= '<option value="' . $st['stream_id'] . '"';
                     if($st['stream_name'] == $other_stream){
                   $select .= 'selected'; 
                       }
                       $select .=    '>' . $st['stream_name'] . '</option>';
                            }      
                }  
//For Getting Other at end
$contition_array = array('is_delete' => '0' , 'status' => 1,'stream_name' => "Other");
$stream_otherdata = $this->common->select_data_by_condition('stream', $contition_array, $data = '*', $sortby = 'stream_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');  
     
$select .= '<option value="' . $stream_otherdata[0]['stream_id'] . '">' . $stream_otherdata[0]['stream_name'] . '</option>';   
        }
    }else{
            $select .= 0;
            }
    }
    else
    {
        $select .= 1;
    }
    
    echo $select;
}
//add other_degree into database End 

// create pdf start

public function creat_pdf_primary($id,$seg) {

        $contition_array = array('edu_id' => $id, 'status' => '1');
        $pdf=$this->data['pdf'] = $this->common->select_data_by_condition('job_add_edu', $contition_array, $data='edu_certificate_primary', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        if($pdf[0]['edu_certificate_primary'])
        { 
            if($seg == 'primary')
            {
                 $select = '<title>'.$pdf[0]['edu_certificate'].'</title>';
                $select .= '<link rel="icon" href="'.base_url('images/favicon.png').'">';
                $select .= '<form action="'.base_url().'/job/qualification/primary" method="post">';
                $select .= '<button type="submit">Back</button>';
                $select .= '</form>';
                echo $select;
                
            }
            else
            {
                $select = '<title>'.$pdf[0]['edu_certificate'].'</title>';
                $select .= '<link rel="icon" href="'.base_url('images/favicon.png').'">';
                $select .='<input action="action" type="button" value="Back" onclick="history.back();" /> <br/><br/>';
                 echo $select;
                
            }
           
            echo '<embed src="' .base_url().$this->config->item('job_edu_main_upload_path').$pdf[0]['edu_certificate_primary'].'"width="100%" height="100%">';

        }
}

public function creat_pdf_secondary($id,$seg) {

        $contition_array = array('edu_id' => $id, 'status' => '1');
        $pdf=$this->data['pdf'] = $this->common->select_data_by_condition('job_add_edu', $contition_array, $data='edu_certificate_secondary', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        if($pdf[0]['edu_certificate_secondary'])
        { 
             if($seg == 'secondary')
            {
                $select = '<title>'.$pdf[0]['edu_certificate'].'</title>';
                $select .= '<link rel="icon" href="'.base_url('images/favicon.png').'">';
                $select .= '<form action="'.base_url().'/job/qualification/secondary" method="post">';
                $select .= '<button type="submit">Back</button>';
                $select .= '</form>';
                echo $select;
                
            }
            else
            {
                $select = '<title>'.$pdf[0]['edu_certificate'].'</title>';
                $select .= '<link rel="icon" href="'.base_url('images/favicon.png').'">';
                 $select .= '<input action="action" type="button" value="Back" onclick="history.back();" /> <br/><br/>';
                 echo $select;
                
            }
           
            echo '<embed src="' .base_url().$this->config->item('job_edu_main_upload_path').$pdf[0]['edu_certificate_secondary'].'"width="100%" height="100%">';
        }
}

public function creat_pdf_higher_secondary($id,$seg) {
    
        $contition_array = array('edu_id' => $id, 'status' => '1');
        $pdf=$this->data['pdf'] = $this->common->select_data_by_condition('job_add_edu', $contition_array, $data='  edu_certificate_higher_secondary', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        if($pdf[0]['edu_certificate_higher_secondary'])
        { 
            if($seg == 'higher-secondary')
            {
                $select = '<title>'.$pdf[0]['edu_certificate'].'</title>';
                $select .= '<link rel="icon" href="'.base_url('images/favicon.png').'">';
                $select .= '<form action="'.base_url().'/job/qualification/higher-secondary" method="post">';
                $select .= '<button type="submit">Back</button>';
                $select .= '</form>';
                echo $select;
               
            }
            else
            {
                $select = '<title>'.$pdf[0]['edu_certificate'].'</title>';
                $select .= '<link rel="icon" href="'.base_url('images/favicon.png').'">';
                $select .= '<input action="action" type="button" value="Back" onclick="history.back();" /> <br/><br/>';
                echo $select;
                
            }
           
            echo '<embed src="' .base_url().$this->config->item('job_edu_main_upload_path').$pdf[0]['edu_certificate_higher_secondary'].'"width="100%" height="100%">';
        }
}

public function creat_pdf_graduation($id,$seg) {
    
        $contition_array = array('job_graduation_id' => $id);
        $pdf=$this->data['pdf'] = $this->common->select_data_by_condition('job_graduation', $contition_array, $data='edu_certificate', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        if($pdf[0]['edu_certificate'])
        { 
            if($seg == 'graduation')
            {
                $select = '<title>'.$pdf[0]['edu_certificate'].'</title>';
                $select .= '<link rel="icon" href="'.base_url('images/favicon.png').'">';
                echo $select;
                
            }
            else
            {
                $select = '<title>'.$pdf[0]['edu_certificate'].'</title>';
                $select .= '<link rel="icon" href="'.base_url('images/favicon.png').'">';
                 echo $select;
                
            }
           
            echo '<embed src="' .base_url().$this->config->item('job_edu_main_upload_path').$pdf[0]['edu_certificate'].'"width="100%" height="100%">';
        }
}

public function creat_pdf_workexp($id) {
    
        $contition_array = array('work_id' => $id);
        $pdf=$this->data['pdf'] = $this->common->select_data_by_condition('job_add_workexp', $contition_array, $data='work_certificate', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

            $select = '<title>'.$pdf[0]['work_certificate'].'</title>';
            $select .= '<link rel="icon" href="'.base_url('images/favicon.png').'">';
            $select .= '<input action="action" type="button" value="Back" onclick="history.back();" /> <br/><br/>';
           
             $select .= '<embed src="' .base_url().$this->config->item('job_work_main_upload_path').$pdf[0]['work_certificate'].'"width="100%" height="100%">';
               echo $select;
       
}
//create pdf end 

//DELETE PRIMARY CERIFICATE & PDF START
public function delete_primary()
{
        $id=$_POST['edu_id'];
        $certificate= $_POST['certificate'];
        
           $data = array(
                'edu_certificate_primary' => ''
                
            );

           $updatedata = $this->common->update_data($data, 'job_add_edu', 'edu_id',$id);
    
        //FOR DELETE IMAGE AND PDF IN FOLDER START
            $path='uploads/job_education/main/'.$certificate;
            $path1='uploads/job_education/thumbs/'.$certificate;
           
            unlink($path); 
            unlink($path1); 
        //FOR DELETE IMAGE AND PDF IN FOLDER END
            echo 1;             
            die();
}
//DELETE PRIMARY CERIFICATE & PDF END

//DELETE SECONDARY CERIFICATE & PDF START
public function delete_secondary()
{
        $id=$_POST['edu_id'];
        $certificate= $_POST['certificate'];
       
           $data = array(
                'edu_certificate_secondary' => ''
                
            );

           $updatedata = $this->common->update_data($data, 'job_add_edu', 'edu_id',$id);
    
        //FOR DELETE IMAGE AND PDF IN FOLDER START
            $path='uploads/job_education/main/'.$certificate;
            $path1='uploads/job_education/thumbs/'.$certificate;
           
            unlink($path); 
            unlink($path1); 
        //FOR DELETE IMAGE AND PDF IN FOLDER END
            echo 1;             
            die();
}

//DELETE SECONDARY CERIFICATE & PDF END

//DELETE HIGHER SECONDARY CERIFICATE & PDF START
public function delete_higher_secondary()
{
        $id=$_POST['edu_id'];
        $certificate= $_POST['certificate'];
       
           $data = array(
                'edu_certificate_higher_secondary' => ''
                
            );

           $updatedata = $this->common->update_data($data, 'job_add_edu', 'edu_id',$id);
    
        //FOR DELETE IMAGE AND PDF IN FOLDER START
            $path='uploads/job_education/main/'.$certificate;
            $path1='uploads/job_education/thumbs/'.$certificate;
           
            unlink($path); 
            unlink($path1); 
        //FOR DELETE IMAGE AND PDF IN FOLDER END
            echo 1;             
            die();
}

//DELETE HIGHER SECONDARY CERIFICATE & PDF END

//DELETE GRADUATION CERIFICATE & PDF START
public function delete_graduation()
{
        $id=$_POST['edu_id'];
        $certificate= $_POST['certificate'];

       
           $data = array(
                'edu_certificate' => ''
                
            );

           $updatedata = $this->common->update_data($data, 'job_graduation', 'job_graduation_id',$id);
    
        //FOR DELETE IMAGE AND PDF IN FOLDER START
            $path='uploads/job_education/main/'.$certificate;
            $path1='uploads/job_education/thumbs/'.$certificate;
           
            unlink($path); 
            unlink($path1); 
        //FOR DELETE IMAGE AND PDF IN FOLDER END
            echo 1;             
            die();
}

//DELETE GRADUATION CERIFICATE & PDF END

//DELETE WORK EXPERIENCE CERIFICATE & PDF START
public function delete_workexp()
{
        $id=$_POST['work_id'];
        $certificate= $_POST['certificate'];

       $data = array(
                'work_certificate' => ''
                
            );

           $updatedata = $this->common->update_data($data, 'job_add_workexp', 'work_id',$id);
    
        //FOR DELETE IMAGE AND PDF IN FOLDER START
            $path='uploads/job_work/main/'.$certificate;
            $path1='uploads/job_work/thumbs/'.$certificate;
           
            unlink($path); 
            unlink($path1); 
        //FOR DELETE IMAGE AND PDF IN FOLDER END
            echo 1;             
            die();
}

//DELETE WORK EXPERIENCE CERIFICATE & PDF END


//THIS JOB REGISTRATION IS USED FOR FIRST TIME REGISTARTION VIEW START

    public function job_reg(){

    $this->data['userid'] = $userid = $this->session->userdata('aileenuser');
    //Retrieve Data from main user registartion table start
    $contition_array = array('user_id' => $userid, 'is_delete' => '0', 'status' => '1');           
    $this->data['job'] = $this->common->select_data_by_condition('user', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
    
      //Retrieve Data from main user registartion table end


         //skill data fetch
        $contition_array = array('status' => 'publish');
        $jobtitle= $this->common->select_data_by_condition('job_title', $contition_array, $data = 'name', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = 'name');
        
        foreach ($jobtitle as $key1 => $value1) {
              foreach ($value1 as $ke1 => $val1) {
                 $title[] = $val1;
              }
          }
        foreach ($title as $key => $value) {
            $result1[$key]['label'] = $value;
            $result1[$key]['value'] = $value;
        }
      $this->data['jobtitle'] = array_values($result1);

         $contition_array = array('is_delete' => '0','industry_name !=' => "Other");
          $search_condition = "((status = '1'))";
           $university_data = $this->data['industry'] = $this->common->select_data_by_search('job_industry', $search_condition, $contition_array, $data = 'industry_id,industry_name', $sortby = 'industry_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');

    $this->load->view('job/job_reg',$this->data);
    }
    
    public function job_insert(){
   
        $this->data['userid'] = $userid = $this->session->userdata('aileenuser');
        
        $firstname = $this->input->post('first_name');
        $lastname = $this->input->post('last_name');
        $email = $this->input->post('email');
        $fresher = $this->input->post('fresher');
        $industry = $this->input->post('industry');
     
        $jobtitle = $this->input->post('job_title'); 
      
      $skills = $this->input->post('skills');
      $skills = explode(',',$skills); 
   
      $cities = $this->input->post('cities');
      $cities = explode(',',$cities); 
    
        // job title start   
        if($jobtitle != " "){ 
     $contition_array = array('name' => $jobtitle);
     $jobdata = $this->common->select_data_by_condition('job_title',$contition_array, $data = 'title_id,name', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str5 = '', $groupby = '');
     if($jobdata){
         $jobtitle = $jobdata[0]['title_id'];
           }else{
                 $data = array(
                    'name' => ucfirst($this->input->post('job_title')),
                    'status' => 'publish',
                 );
      $jobtitle = $this->common->insert_data_getid($data, 'job_title');
           }
      }
      
      // skills  start   
    
      if(count($skills) > 0){ 
          
          foreach($skills as $ski){
     $contition_array = array('skill' => trim($ski),'type' => 1);
     $skilldata = $this->common->select_data_by_condition('skill',$contition_array, $data = 'skill_id,skill', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str5 = '', $groupby = '');
      if(count($skilldata) < 0){ 
           $contition_array = array('skill' => trim($ski),'type' => 3);
     $skilldata = $this->common->select_data_by_condition('skill',$contition_array, $data = 'skill_id,skill', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str5 = '', $groupby = '');
      }
  
     if($skilldata){
         $skill[] = $skilldata[0]['skill_id'];
           }else{
                 $data = array(
                    'skill' => trim($ski),
                    'status' => '1',
                    'type' => 3,
                    'user_id' => $userid,
                 );
      $skill[] = $this->common->insert_data_getid($data, 'skill');
           }
          }
          $skills = implode(',',$skill); 
      }
      
      // city  start   
      
      if(count($cities) > 0){ 
          
          foreach($cities as $cit){
     $contition_array = array('city_name' => $cit);
     $citydata = $this->common->select_data_by_condition('cities',$contition_array, $data = 'city_id,city_name', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str5 = '', $groupby = '');
     if($citydata){
       $city[] = $citydata[0]['city_id'];
           }else{
                 $data = array(
                    'city_name' => $cit,
                    'status' => '1',
                 );
      $city[] = $this->common->insert_data_getid($data, 'cities');
           }
          }
          
          $city = implode(',',$city); 
      }
      
         $data = array(
                    'fname' => ucfirst($this->input->post('first_name')),
                    'lname' => ucfirst($this->input->post('last_name')),
                    'email' => $this->input->post('email'),
                    'keyskill' => $skills,
                    'work_job_title' => $jobtitle,
                    'work_job_industry' => $this->input->post('industry'),
                    'work_job_city' => $city,
                    'experience' => $this->input->post('fresher'),
                    'status' => 1,
                    'is_delete' => 0,
                    'created_date' => date('Y-m-d h:i:s', time()),
                    'user_id' => $userid,
                    'job_step' => 10
                );
      
                $insert_id = $this->common->insert_data_getid($data, 'job_reg');
                if ($insert_id) {
                    $this->session->set_flashdata('success', 'Basic information updated successfully');
                    redirect('job/home');
                } else {
                    $this->session->flashdata('error', 'Sorry!! Your data not inserted');
                    redirect('job/profile', 'refresh');
                }
       
    }
    
//THIS JOB REGISTRATION IS USED FOR FIRST TIME REGISTARTION VIEW END

//THIS FUNCTION IS USED TO CHECK IF USER NOT REGISTER AND OPEN DIRECT URL THEN GO TO REGISTRATION PAGE START
 public function job_apply_check() 
 {


        $userid = $this->session->userdata('aileenuser');

         $contition_array = array('user_id' => $userid, 'is_delete' => '0');
         $apply_step  = $this->common->select_data_by_condition('job_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

     
            if ($apply_step[0]['job_step'] == "" || $apply_step[0]['job_step'] == "0") 
            {
               
                  redirect('job/profile');
                
            } 
            
    }
//THIS FUNCTION IS USED TO CHECK IF USER NOT REGISTER AND OPEN DIRECT URL THEN GO TO REGISTRATION PAGE END

    // recruiter available chek
public function job_avail_check($userid = " ") 
 {
   $contition_array = array('user_id' => $userid, 'is_delete' => '1');
   $availuser = $this->common->select_data_by_condition('job_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
    
        if (count($availuser) > 0) 
        {
       redirect('job/noavailable');
         } 
    }
// recruiter available chek
   
     public function noavailable() {
         
        $this->load->view('job/notavalible', $this->data);  
     }


//Retrive all data of dergree,stream and university start
      public function ajax_data() {

         $userid = $this->session->userdata('aileenuser');
        // ajax for degree start

        if (isset($_POST["degree_id"]) && !empty($_POST["degree_id"])) {
            //Get all stream data
             $contition_array = array('is_delete' => '0','degree_id' => $_POST["degree_id"]);
          $search_condition = "((status = '2' AND user_id = $userid) OR (status = '1'))";
            $stream = $this->data['stream'] = $this->common->select_data_by_search('stream', $search_condition, $contition_array, $data = '*', $sortby = 'stream_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');

            //Count total number of rows
            //Display stram list
            if (count($stream) > 0) {
                echo '<option value="">Select stream</option>';
                foreach ($stream as $st) {
                    echo '<option value="' . $st['stream_id'] . '">' . $st['stream_name'] . '</option>';
                   die();
                }
            } else {
                echo '<option value="">Stream not available</option>';
               die();
            }
        }

        // ajax for degree end

    }
     //Retrive all data of dergree,stream and university start

//if user deactive profile then redirect to job/index untill active profile start
 public function job_deactive_profile() {

        $userid = $this->session->userdata('aileenuser');
        $contition_array = array('user_id'=> $userid,'status' => '0','is_delete'=> '0');

        $job_deactive = $this->data['job_deactive'] = $this->common->select_data_by_condition('job_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);

        if($job_deactive)
        {
             redirect('job/');
        }
  }
//if user deactive profile then redirect to job/index untill active profile End

//Get Job Seeker Name for title Start
public function get_jobseeker_name($id=''){

        $userid = $this->session->userdata('aileenuser');
       
        $contition_array = array('user_id' => $userid, 'status' => '1', 'is_delete' => '0');
        $jobdata = $this->common->select_data_by_condition('job_reg', $contition_array, $data = 'fname,lname', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
       
        return $jobseeker_name = $jobdata[0]['fname'].' '.$jobdata[0]['lname'];    
    }
//Get Job Seeker Name for title End

//GET JOB ALL POST DATA WITH AJAX START
public function ajax_recommen_job() {

$perpage = 5;
$page = 1;

if (!empty($_GET["page"]) && $_GET["page"] != 'undefined')
  {
  $page = $_GET["page"];
  }

$start = ($page - 1) * $perpage;

if ($start < 0) $start = 0;
$this->data['userid'] = $userid = $this->session->userdata('aileenuser');

// job seeker detail

$contition_array = array(
  'user_id' => $userid,
  'is_delete' => 0,
  'status' => 1
);
$jobdata = $this->data['jobdata'] = $this->common->select_data_by_condition('job_reg', $contition_array, $data = '*', $sortby = '', $orderby = 'desc', $limit = '', $offset = '', $join_str = array() , $groupby = '');
$job_skill = $this->data['jobdata'][0]['keyskill'];
$postuserarray = explode(',', $job_skill);

// post detail

$contition_array = array(
  'is_delete' => 0,
  'status' => 1
);
$postdata = $this->data['postdata'] = $this->common->select_data_by_condition('rec_post', $contition_array, $data = '*', $sortby = 'post_id', $orderby = 'desc', $limit = '', $offset = '', $join_str = array() , $groupby = '');
$contition_array = array(
  'status' => 1,
  'user_id' => $userid,
  'type' => 3
);
$skill_data = $this->common->select_data_by_condition('skill', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array() , $groupby = '');
$date = date('Y-m-d', time());

// for getting data from rec_post table for keyskill

foreach($postdata as $post)
  {
  $skill_id = explode(',', $post['post_skill']);
  $skill_id = array_filter(array_map('trim', $skill_id));
  $postuserarray = array_filter(array_map('trim', $postuserarray));
  $result = array_intersect($postuserarray, $skill_id);
  if (count($result) > 0)
    {
    $contition_array = array(
      'post_id' => $post['post_id'],
      'post_last_date >=' => $date,
      'is_delete' => 0,
      'status' => 1
    );
    $data = $this->data['data'] = $this->common->select_data_by_condition('rec_post', $contition_array, $data = '*', $sortby = 'post_id', $orderby = 'desc', $limit = '', $offset = '', $join_str = array() , $groupby = '');
    if ($data[0]['user_id'] != $userid)
      {
      $recommendata[] = $data;
      }
    }
  }

// for getting data from skill table for other skill

foreach($skill_data as $skill)
  {
  $contition_array = array(
    'FIND_IN_SET("' . $skill['skill'] . '",other_skill)!=' => '0',
    'post_last_date >=' => $date,
    'is_delete' => 0,
    'status' => 1
  );
  $data1 = $this->data['data'] = $this->common->select_data_by_condition('rec_post', $contition_array, $data = '*', $sortby = 'post_id', $orderby = 'desc', $limit = '', $offset = '', $join_str = array() , $groupby = '');
  $recommendata1[] = $data1;
  }

//    echo "<pre>";print_r($recommendata1);die();
// Retrieve data according to city match start

$work_job_city = $jobdata[0]['work_job_city'];
$work_city = explode(',', $work_job_city);

foreach($work_city as $city)
  {
  $data = '*';
  $contition_array = array(
    'FIND_IN_SET("' . $city . '",city)!=' => '0',
    'post_last_date >=' => $date,
    'is_delete' => 0,
    'status' => 1
  );
  $data1 = $this->data['data'] = $this->common->select_data_by_condition('rec_post', $contition_array, $data, $sortby = 'post_id', $orderby = 'desc', $limit = '', $offset = '', $join_str = array() , $groupby = '');
  $recommendata_city[] = $data1;
  }

// Retrieve data according to city match End
// Retrieve data according to industry match start

$work_job_industry = $jobdata[0]['work_job_industry'];

foreach($postdata as $post)
  {
  $data = '*';
  $contition_array = array(
    'industry_type' => $work_job_industry,
    'post_last_date >=' => $date,
    'is_delete' => 0,
    'status' => 1
  );
  $data1 = $this->data['data'] = $this->common->select_data_by_condition('rec_post', $contition_array, $data, $sortby = 'post_id', $orderby = 'desc', $limit = '', $offset = '', $join_str = array() , $groupby = '');
  $recommendata_industry[] = $data1;
  }

// Retrieve data according to industry match End
// Retrieve data according to Job Title match start

$work_job_title = $jobdata[0]['work_job_title'];

foreach($postdata as $post)
  {
  $data = '*';
  $contition_array = array(
    'post_name' => $work_job_title,
    'post_last_date >=' => $date,
    'is_delete' => 0,
    'status' => 1
  );
  $data1 = $this->data['data'] = $this->common->select_data_by_condition('rec_post', $contition_array, $data, $sortby = 'post_id', $orderby = 'desc', $limit = '', $offset = '', $join_str = array() , $groupby = '');
  $recommendata_title[] = $data1;
  }

// Retrieve data according to  Job Title match End

if (count($recommendata) == 0)
  {
  $unique = $recommendata1;
  $qbc = array_unique($unique, SORT_REGULAR);
  $qbc = array_filter($qbc);
  }
elseif (count($recommendata1) == 0)
  {
  $unique = $recommendata;
  $qbc = array_unique($unique, SORT_REGULAR);
  $qbc = array_filter($qbc);
  }
elseif (count($recommendata_city) == 0)
  {
  $unique = $recommendata_city;
  $qbc = array_unique($unique, SORT_REGULAR);
  $qbc = array_filter($qbc);
  }
elseif (count($recommendata_industry) == 0)
  {
  $unique = $recommendata_industry;
  $qbc = array_unique($unique, SORT_REGULAR);
  $qbc = array_filter($qbc);
  }
elseif (count($recommendata_industry) == 0)
  {
  $unique = $recommendata_title;
  $qbc = array_unique($unique, SORT_REGULAR);
  $qbc = array_filter($qbc);
  }
  else
  {
  $unique = array_merge($recommendata1, $recommendata, $recommendata_city, $recommendata_industry, $recommendata_title);
  $newArray = array();
  foreach($unique as $key => $innerArr1)
    {
    foreach($innerArr1 as $key1 => $innerArr)
      {
      $newArray[][] = $innerArr;
      }
    }

  $qbc = array_unique($newArray, SORT_REGULAR);
  $qbc = array_filter($qbc);
  }

$postdetail = $this->data['postdetail'] = $qbc;

// echo "<pre>";print_r( $postdetail);die();

$postdetail1 = array_slice($postdetail, $start, $perpage);

if (empty($_GET["total_record"]))
  {
  $_GET["total_record"] = count($postdetail);
  }

$return_html = '';
$return_html.= '<input type = "hidden" class = "page_number" value = "' . $page . '" />';
$return_html.= '<input type = "hidden" class = "total_record" value = "' . $_GET["total_record"] . '" />';
$return_html.= '<input type = "hidden" class = "perpage_record" value = "' . $perpage . '" />';

if (count($postdetail) > 0)
  {
  foreach($postdetail1 as $postdetaildata)
    {
    foreach($postdetaildata as $post)
      {
      $return_html.= '
                <div class="profile-job-post-detail clearfix" id="applypost' . $post['app_id'] . '">
                <div class = "profile-job-post-title clearfix">
                <div class = "profile-job-profile-button clearfix">
                <div class = "profile-job-details col-md-12 col-xs-12  padding_job_rs">
                <ul>
                        <li class="fr date_re">
                              Created Date :' . date('d-M-Y', strtotime($post['created_date'])) . '
                        </li>

                        <li>';
      $cache_time = $this->db->get_where('job_title', array(
        'title_id' => $post['post_name']
      ))->row()->name;
      $return_html.= '<a href="javascript:void(0);" title="' . $cache_time . '" class=" post_title">';
      if ($cache_time)
        {
        $return_html.= $cache_time;
        }
        else
        {
        $return_html.= $post['post_name'];
        }

      $return_html.= '</a></li><li>';
      $cityname = $this->db->get_where('cities', array(
        'city_id' => $post['city']
      ))->row()->city_name;
      $countryname = $this->db->get_where('countries', array(
        'country_id' => $post['country']
      ))->row()->country_name;
      if ($countryname || $cityname)
        {
        $return_html.= '<div class="fr lction">
                                 <p title="Location"><i class="fa fa-map-marker" aria-hidden="true"></i>';
        if ($cityname)
          {
          $return_html.= $cityname . ', ';
          }

        $return_html.= $countryname . '</p></div>';
        }

      $cache_time1 = $this->db->get_where('recruiter', array(
        'user_id' => $post['user_id']
      ))->row()->re_comp_name;
      $return_html.= '<a class="job_companyname "  href="' . base_url('recruiter/rec_profile/' . $post['user_id'] . '?page=job') . '" title="' . $cache_time1 . '">';
      $out = strlen($cache_time1) > 40 ? substr($cache_time1, 0, 40) . "..." : $cache_time1;
      $return_html.= $out . '</a></li>';
      $return_html.= '<li><a class="display_inline" title="Recruiter Name" href="' . base_url('recruiter/rec_profile/' . $post['user_id'] . '?page=job') . '">';
      $cache_time = $this->db->get_where('recruiter', array(
        'user_id' => $post['user_id']
      ))->row()->rec_firstname;
      $cache_time1 = $this->db->get_where('recruiter', array(
        'user_id' => $post['user_id']
      ))->row()->rec_lastname;
      $return_html.= ucwords($cache_time) . "  " . ucwords($cache_time1) . '</a></li>';
      $return_html.= '</ul></div></div>';
      $return_html.= '<div class="profile-job-profile-menu">
                                       <ul class="clearfix">
                                          <li> <b> Skills</b> <span>';
      $comma = ",";
      $k = 0;
      $aud = $post['post_skill'];
      $aud_res = explode(',', $aud);
      if (!$post['post_skill'])
        {
        $return_html.= $post['other_skill'];
        }
        else
      if (!$post['other_skill'])
        {
        foreach($aud_res as $skill)
          {
          if ($k != 0)
            {
            $return_html.= $comma;
            }

          $cache_time = $this->db->get_where('skill', array(
            'skill_id' => $skill
          ))->row()->skill;
          $return_html.= $cache_time;
          $k++;
          }
        }
        else
      if ($post['post_skill'] && $post['other_skill'])
        {
        foreach($aud_res as $skill)
          {
          if ($k != 0)
            {
            $return_html.= $comma;
            }

          $cache_time = $this->db->get_where('skill', array(
            'skill_id' => $skill
          ))->row()->skill;
          $return_html.= $cache_time;
          $k++;
          }

        $return_html.= ',' . $post['other_skill'];
        }

      $return_html.= '</span></li><li>
                                  <b>Job Description</b>
                              <span><p>';
      if ($post['post_description'])
        {
        $return_html.= '<pre>' . $this->common->make_links($post['post_description']) . '</pre>';
        }
        else
        {
        $return_html.= PROFILENA;
        }

      $return_html.= '</p></span></li>';
      $return_html.= '<li><b>Interview Process</b>
                                  <span><pre>';
      if ($post['interview_process'])
        {
        $return_html.= $this->common->make_links($post['interview_process']);
        }
        else
        {
        $return_html.= PROFILENA;
        }

      $return_html.= '</pre></span></li>';
      $return_html.= '<li><b>Required Experience</b><span><p title="Min - Max">';
      if (($post['min_year'] != '0' || $post['max_year'] != '0') && ($post['fresher'] == 1))
        {
        $return_html.= $post['min_year'] . ' Year - ' . $post['max_year'] . ' Year' . " , " . "Fresher can also apply.";
        }
        else
      if (($post['min_year'] != '0' || $post['max_year'] != '0'))
        {
        $return_html.= $post['min_year'] . ' Year - ' . $post['max_year'] . ' Year';
        }
        else
        {
        $return_html.= "Fresher";
        }

      $return_html.= '</p></span></li>';
      $return_html.= '<li><b>Salary</b><span title="Min - Max">';
      $currency = $this->db->get_where('currency', array(
        'currency_id' => $post['post_currency']
      ))->row()->currency_name;
      if ($post['min_sal'] || $post['max_sal'])
        {
        $return_html.= $post['min_sal'] . " - " . $post['max_sal'] . ' ' . $currency . ' ' . $post['salary_type'];
        }
        else
        {
        $return_html.= PROFILENA;
        }

      $return_html.= '</span></li>';
      $return_html.= '<li><b>No of Position</b><span>' . $post['post_position'] . ' ' . 'Position</span></li>';
      $return_html.= '<li><b>Industry Type</b> <span>';
      $cache_time = $this->db->get_where('job_industry', array(
        'industry_id' => $post['industry_type']
      ))->row()->industry_name;
      $return_html.= $cache_time . '</span></li>';
      if ($post['degree_name'] != '' || $post['other_education'] != '')
        {
        $return_html.= '<li> <b>Education Required</b> <span> ';
        $comma = ", ";
        $k = 0;
        $edu = $post['degree_name'];
        $edu_nm = explode(',', $edu);
        if (!$post['degree_name'])
          {
          $return_html.= $post['other_education'];
          }
          else
        if (!$post['other_education'])
          {
          foreach($edu_nm as $edun)
            {
            if ($k != 0)
              {
              $return_html.= $comma;
              }

            $cache_time = $this->db->get_where('degree', array(
              'degree_id' => $edun
            ))->row()->degree_name;
            $return_html.= $cache_time;
            $k++;
            }
          }
          else
        if ($post['degree_name'] && $post['other_education'])
          {
          foreach($edu_nm as $edun)
            {
            if ($k != 0)
              {
              $return_html.= $comma;
              }

            $cache_time = $this->db->get_where('degree', array(
              'degree_id' => $edun
            ))->row()->degree_name;
            $return_html.= $cache_time;
            $k++;
            }

          $return_html.= "," . $post['other_education'];
          }

        $return_html.= '</span> </li>';
        }
        else
        {
        $return_html.= '<li><b>Education Required</b><span>' . PROFILENA . '</span></li>';
        }

      $return_html.= '<li><b>Employment Type</b><span>';
      if ($post['emp_type'] != '')
        {
        $return_html.= '<pre>' . $this->common->make_links($post['emp_type']) . '  Job</pre>';
        }
        else
        {
        $return_html.= PROFILENA;
        }

      $return_html.= '</span></li>';
      $return_html.= '<li><b>Company Profile</b><span>';
      $currency = $this->db->get_where('recruiter', array(
        'user_id' => $post['user_id']
      ))->row()->re_comp_profile;
      if ($currency != '')
        {
        $return_html.= '<pre>' . $this->common->make_links($currency) . '</pre>';
        }
        else
        {
        $return_html.= PROFILENA;
        }

      $return_html.= '</span></li>';
      $return_html.= '</ul></div>';
      $return_html.= '<div class="profile-job-profile-button clearfix">
                                       <div class="profile-job-details col-md-12 col-xs-12">
                                          <ul>';
      $return_html.= '<li class="job_all_post last_date">Last Date :';
      if ($post['post_last_date'] != "0000-00-00")
        {
        $return_html.= date('d-M-Y', strtotime($post['post_last_date']));
        }
        else
        {
        $return_html.= PROFILENA;
        }

      $return_html.= '</li>';
      $this->data['userid'] = $userid = $this->session->userdata('aileenuser');
      $contition_array = array(
        'post_id' => $post['post_id'],
        'job_delete' => 0,
        'user_id' => $userid
      );
      $jobsave = $this->data['jobsave'] = $this->common->select_data_by_condition('job_apply', $contition_array, $data = '*', $sortby = '', $orderby = 'desc', $limit = '', $offset = '', $join_str = array() , $groupby = '');
      if ($jobsave)
        {
        $return_html.= '<a href="javascript:void(0);" class="button applied">Applied</a>';
        }
        else
        {
        $return_html.= '<li class="fr"><a href="javascript:void(0);"  class= "applypost' . $post['post_id'] . '  button" onclick="applypopup(' . $post['post_id'] . ',' . $post['user_id'] . ')">Apply</a></li>';
        $return_html.= '<li class="fr">';
        $userid = $this->session->userdata('aileenuser');
        $contition_array = array(
          'user_id' => $userid,
          'job_save' => '2',
          'post_id ' => $post['post_id'],
          'job_delete' => '1'
        );
        $jobsave = $this->data['jobsave'] = $this->common->select_data_by_condition('job_apply', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array() , $groupby = '');
        if ($jobsave)
          {
          $return_html.= '<a class="button saved save_saved_btn">Saved</a>';
          }
          else
          {
          $return_html.= '<a id="' . $post['post_id'] . '" onClick="savepopup(' . $post['post_id'] . ')" href="javascript:void(0);" class="savedpost' . $post['post_id'] . ' button save_saved_btn">Save</a>';
          }

        $return_html.= '</li>';
        }
          $return_html.= '</ul></div></div>';
          $return_html.= '</div></div>';
      }//foreach ($postdetail1 as $post) end
    }//foreach ($postdetail as $post_key => $postdetail1) end
  }//if (count($postdetail) > 0) end
        else {   
                                  
              $return_html.= '<div class="art-img-nn">
                                <div class="art_no_post_img">
                                 <img src="'.base_url('img/job-no.png').'">
                              </div>
                              <div class="art_no_post_text">
                                 No  Recommended Post Available.
                              </div>
                           </div>';
                           
                }//else end
    
echo $return_html;

    }
//GET JOB ALL POST DATA WITH AJAX END

//GET JOB SAVE DATA WITH AJAX START
public function ajax_save_job() {

$perpage = 5;
$page = 1;

if (!empty($_GET["page"]) && $_GET["page"] != 'undefined')
  {
  $page = $_GET["page"];
  }

$start = ($page - 1) * $perpage;

if ($start < 0) $start = 0;


$this->data['userid'] = $userid = $this->session->userdata('aileenuser');

// job seeker detail
        $contition_array = array('user_id' => $userid, 'is_delete' => 0, 'status' => 1);
        $jobdata = $this->data['jobdata'] = $this->common->select_data_by_condition('job_reg', $contition_array, $data = '*', $sortby = '', $orderby = 'desc', $limit = '', $offset = '', $join_str = array(), $groupby = '');

// post detail
        $join_str[0]['table'] = 'job_apply';
        $join_str[0]['join_table_id'] = 'job_apply.post_id';
        $join_str[0]['from_table_id'] = 'rec_post.post_id';
        $join_str[0]['join_type'] = '';

        $contition_array = array('job_apply.job_delete' => 1, 'job_apply.user_id' => $userid, 'job_apply.job_save' => 2);
        $postdetail = $this->data['postdetail'] = $this->common->select_data_by_condition('rec_post', $contition_array, $data = 'rec_post.*,job_apply.app_id,job_apply.user_id as userid', $sortby = 'job_apply.modify_date', $orderby = 'desc', $limit = '', $offset = '', $join_str, $groupby = '');

$postdetail1 = array_slice($postdetail, $start, $perpage);
if (empty($_GET["total_record"]))
  {
  $_GET["total_record"] = count($postdetail);
  }

$return_html = '';
$return_html.= '<input type = "hidden" class = "page_number" value = "' . $page . '" />';
$return_html.= '<input type = "hidden" class = "total_record" value = "' . $_GET["total_record"] . '" />';
$return_html.= '<input type = "hidden" class = "perpage_record" value = "' . $perpage . '" />';
 
 if ($postdetail) {
                                                        
          foreach ($postdetail1 as $post) {

          $return_html.= ' <div class="profile-job-post-detail clearfix" id="postdata'.$post['app_id'].'">
                                 <div class="profile-job-post-title clearfix">
                                    <div class="profile-job-profile-button clearfix">
                                       <div class="profile-job-details col-md-12 col-xs-12">
                                          <ul>';
            $return_html.= '<li class="fr date_re">
                                Created Date : '.date('d-M-Y',strtotime($post['created_date'])).'
                            </li>';
            $return_html.='<li><a  class=" post_title" href="#" title="Post Title" >';

                $cache_time = $this->db->get_where('job_title', array('title_id' => $post['post_name']))->row()->name;
                  if($cache_time)
                  {
                        $return_html.=  $cache_time;
                  }
                  else
                  {
                        $return_html.= $post['post_name'];
                  }
                   $return_html.='</a></li>';                                
                  
            $return_html.='<li>';                                  
                         
            $cityname = $this->db->get_where('cities', array('city_id' => $post['city']))->row()->city_name;
            $countryname = $this->db->get_where('countries', array('country_id' => $post['country']))->row()->country_name; 

            if($cityname || $countryname)
            { 
                $return_html.='<div class="fr lction">
                                    <p title="Location"><i class="fa fa-map-marker" aria-hidden="true"> </i>';                    
                if($cityname)
                {                          
                             $return_html.= $cityname.",";   
                }          
                 $return_html.= $countryname.'</p></div>';       
            }  

            $cache_time1= $this->db->get_where('recruiter', array('user_id' => $post['user_id']))->row()->re_comp_name; 

             $return_html.='<a class="job_companyname" href="'.base_url('recruiter/rec_profile/' . $post['user_id'].'?page=job').'"  title="'.$cache_time1.'">';

              $out = strlen($cache_time1) > 40 ? substr($cache_time1,0,40)."..." : $cache_time1;                             
              
              $return_html.= $out.'</a></li>';                                 
                   
              $return_html.= '<li><a  class=" display_inline" title="Recruiter Name" href="'.base_url('recruiter/rec_profile/' . $post['user_id'].'?page=job').'">';

              $cache_time = $this->db->get_where('recruiter', array('user_id' => $post['user_id']))->row()->rec_firstname; 

               $cache_time1 = $this->db->get_where('recruiter', array('user_id' => $post['user_id']))->row()->rec_lastname; 

                $return_html.= ucwords($cache_time)."  ".ucwords($cache_time1);     

                $return_html.='</a></li>';

                $return_html.='</ul></div></div>';   

                $return_html.='<div class="profile-job-profile-menu">
                                       <ul class="clearfix">';

                $return_html.='<li> <b> Skills</b> <span> ';

                        $comma = ", ";
                        $k = 0;
                        $aud = $post['post_skill'];
                        $aud_res = explode(',', $aud);
                                                
                        if(!$post['post_skill'])
                        {
                                                
                             $return_html.= $post['other_skill'];
                                                
                         }
                         else if(!$post['other_skill'])
                         {

                            foreach ($aud_res as $skill) 
                            {
                                if ($k != 0) 
                                {
                                    $return_html.= $comma;
                                }

                              $cache_time = $this->db->get_where('skill', array('skill_id' => $skill))->row()->skill;
                                                
                                  $return_html.=$cache_time;
                                  $k++;
                            }
                                                
                          }
                          else if($post['post_skill'] && $post['other_skill'])
                          {
                              foreach ($aud_res as $skill) 
                              {
                                  if ($k != 0) 
                                  {
                                           $return_html.=$comma;
                                  }

                                $cache_time = $this->db->get_where('skill', array('skill_id' => $skill))->row()->skill;
                                                
                                $return_html.=$cache_time;
                                $k++;
                            }
                            $return_html.= ',' . $post['other_skill'];
                          }
                       
                $return_html.='</span></li>';

                $return_html.='<li><b>Job Description</b><span><p>';
                if ($post['post_description']) 
                {
                      $return_html.='<pre>'.$this->common->make_links($post['post_description']).' </pre>'; 
                }   
                else
                {
                  $return_html.=PROFILENA;
                }                    
                $return_html.='</p></span></li>'; 

                $return_html.='<li><b>Interview Process</b><span>';                         
                if($post['interview_process'])
                {
                          $return_html.='<pre>'.$this->common->make_links($post['interview_process']).'</pre>';
                }
                else
                {
                          $return_html.=PROFILENA;
                }  
                $return_html.='</span></li>';           
                                             
                $return_html.='<li><b>Required Experience</b><span><p title="Min - Max">';

                if(($post['min_year'] !='0' || $post['max_year'] !='0') && ($post['fresher'] == 1))
                {                             
                        $return_html.=$post['min_year'].' Year - '.$post['max_year'] .' Year'." , ".   "Fresher can also apply.";
                }
                else if(($post['min_year'] !='0' || $post['max_year'] !='0'))
                {
                      $return_html.=$post['min_year'].' Year - '.$post['max_year'] . ' Year';
                }
                else
                {
                  $return_html.="Fresher";
                }
                                             
              $return_html.='</p></span></li>'; 

              $return_html.='<li><b>Salary</b><span title="Min - Max" >';
              
              $currency = $this->db->get_where('currency', array('currency_id' => $post['post_currency']))->row()->currency_name;

              if($post['min_sal'] || $post['max_sal']) 
              {

                  $return_html.=$post['min_sal']." - ".$post['max_sal'].' '. $currency . ' '. $post['salary_type'];
              }
              else
              {
                  $return_html.=PROFILENA;
              }

               $return_html.='</span></li>';

                $return_html.='<li><b>No of Position</b><span>'.$post['post_position'].' Position</span></li>';

                $return_html.='<li><b>Industry Type</b> <span>';

                $cache_time = $this->db->get_where('job_industry', array('industry_id' => $post['industry_type']))->row()->industry_name;
                $return_html.=$cache_time.'</span></li>';
                                             
                if ($post['degree_name'] != '' || $post['other_education'] != '') 
                { 
                    $return_html.='<li> <b>Education Required</b> <span>';
                                           
                          $comma = ", ";                  
                          $k = 0;                    
                          $edu = $post['degree_name'];                      
                          $edu_nm = explode(',', $edu);                      
                                                
                          if(!$post['degree_name'])
                          {  
                              $return_html.= $post['other_education'];
                          }  
                          else if(!$post['other_education'])
                          {
                            foreach ($edu_nm as $edun) 
                            {
                              if ($k != 0) 
                              {
                                $return_html.=$comma;
                              }
                              $cache_time = $this->db->get_where('degree', array('degree_id' => $edun))->row()->degree_name;

                              $return_html.=$cache_time;
                               $k++;
                            }
                          }   
                          else if($post['degree_name'] && $post['other_education'])
                          {     
                             foreach ($edu_nm as $edun) 
                             {
                                if ($k != 0) 
                                {
                                  $return_html.=$comma;
                                }
                                 $cache_time = $this->db->get_where('degree', array('degree_id' => $edun))->row()->degree_name;
                                 $return_html.=$cache_time;
                                 $k++;
                             }
                             $return_html.= ",". $post['other_education'];
                          } 
                          $return_html.='</span></li>';
                  }   
                  else
                  {
                          $return_html.='<li><b>Education Required</b><span>'.PROFILENA.'</span></li>';
                  }     
                                                
                  $return_html.='<li><b>Employment Type</b><span>';                            
                  if($post['emp_type'] != '')
                  {
                    $return_html.='<pre>'.$this->common->make_links($post['emp_type']).'  Job</pre>';
                  }
                  else
                  {
                    $return_html.= PROFILENA;
                  }
                  $return_html.='</span></li>';

                   $return_html.='<li><b>Company Profile</b><span>';
                    $currency = $this->db->get_where('recruiter', array('user_id' => $post['user_id']))->row()->re_comp_profile;                     
                    if($currency != '')
                    {
                      $return_html.='<pre>'.$this->common->make_links($currency).'</pre>';
                    }                   
                    else
                    {
                       $return_html.=PROFILENA;
                    }                      
                     $return_html.='</span></li>';                       
                                            
                 $return_html.='</ul></div>';

                  $return_html.='<div class="profile-job-profile-button clearfix">
                                       <div class="profile-job-details col-md-12 col-xs-12">
                                          <ul>';
                  $return_html.='<li class="job_all_post last_date">Last Date :';                   
                  if($post['post_last_date'] != "0000-00-00")
                  {
                    $return_html.=date('d-M-Y',strtotime($post['post_last_date']));
                  }
                  else
                  {
                    $return_html.=PROFILENA;
                  }                  
                  $return_html.='</li>';                          
                
                $this->data['userid'] = $userid = $this->session->userdata('aileenuser');
                                             
                $contition_array = array('post_id' => $post['post_id'], 'job_delete' => 0, 'user_id' => $userid);
                $jobsave = $this->data['jobsave'] = $this->common->select_data_by_condition('job_apply', $contition_array, $data = '*', $sortby = '', $orderby = 'desc', $limit = '', $offset = '', $join_str = array(), $groupby = '');
                                             
                if ($jobsave[0]['job_save'] == 1) 
                {     
                   $return_html.='<button  class="button" disabled>Applied</button>';
                }
                else
                {
                  $return_html.='<li class="fr"> <a href="javascript:void(0);" class="button" onclick="applypopup('.$post['post_id'].','.$post['app_id'].')">Apply</a> </li>';
                  $return_html.='<li class="fr"><a href="javascript:void(0);" class="button" onclick="removepopup('.$post['app_id'].')">Remove</a></li>';                       
                }      

                $return_html.='</ul></div></div>';                             
            $return_html.='</div></div>';
              }//foreach ($postdetail as $post) end
            }//if ($postdetail) end
            else
            {
              $return_html.='<div class="art-img-nn">
                                <div class="art_no_post_img">
                                     <img src="'.base_url('img/job-no.png').'">
                                </div>
                                <div class="art_no_post_text">
                                    No  Saved Post Available.
                                </div>
                              </div>';
              
                          
            }//else end

echo $return_html;

    }
//GET JOB SAVE DATA WITH AJAX END

//GET JOB APPLY DATA WITH AJAX START
public function ajax_apply_job() {

$perpage = 5;
$page = 1;

if (!empty($_GET["page"]) && $_GET["page"] != 'undefined')
  {
  $page = $_GET["page"];
  }

$start = ($page - 1) * $perpage;

if ($start < 0) $start = 0;


$this->data['userid'] = $userid = $this->session->userdata('aileenuser');

$join_str[0]['table'] = 'job_apply';
$join_str[0]['join_table_id'] = 'job_apply.post_id';
$join_str[0]['from_table_id'] = 'rec_post.post_id';
$join_str[0]['join_type'] = '';
$contition_array = array('job_apply.job_delete' => 0,'rec_post.is_delete' => 0,'job_apply.user_id' => $userid);
                
$postdetail=$this->data['postdetail'] = $this->common->select_data_by_condition('rec_post', $contition_array, $data='rec_post.*,job_apply.app_id,job_apply.user_id as userid,job_apply.modify_date', $sortby = 'job_apply.modify_date', $orderby = 'desc', $limit = '', $offset = '', $join_str, $groupby = '');


$postdetail1 = array_slice($postdetail, $start, $perpage);
if (empty($_GET["total_record"]))
  {
  $_GET["total_record"] = count($postdetail);
  }

$return_html = '';
$return_html.= '<input type = "hidden" class = "page_number" value = "' . $page . '" />';
$return_html.= '<input type = "hidden" class = "total_record" value = "' . $_GET["total_record"] . '" />';
$return_html.= '<input type = "hidden" class = "perpage_record" value = "' . $perpage . '" />';

if (count($postdetail) != '0') 
{
    foreach ($postdetail1 as $post) 
    {
      $return_html.='<div class="profile-job-post-detail clearfix" id="removeapply'.$post['app_id'].'">
                              <div class="profile-job-post-title clearfix">
                                 <div class="profile-job-profile-button clearfix">
                                    <div class="profile-job-details col-md-12 col-xs-12">
                                       <ul>';

      $return_html.='<li class="fr date_re"> Created Date :'.date('d-M-Y',strtotime($post['created_date'])).'</li>';

      $return_html.='<li><a title="Post Title" class=" post_title" href="#">';
      $cache_time = $this->db->get_where('job_title', array('title_id' => $post['post_name']))->row()->name;                               
      if($cache_time)
      {
          $return_html.= $cache_time;
      }
      else
      {
          $return_html.= $post['post_name'];
      }
      $return_html.='</a></li>';

      $return_html.='<li>';
      $cityname = $this->db->get_where('cities', array('city_id' => $post['city']))->row()->city_name;
      $countryname = $this->db->get_where('countries', array('country_id' => $post['country']))->row()->country_name;                                      
      if($cityname || $countryname)
      {
          $return_html.='<div class="fr lction"> 
                            <p title="location"><i class="fa fa-map-marker" aria-hidden="true"></i>';
          if($cityname)
          {
            $return_html.=$cityname .', ';
          }
           $return_html.=$countryname.'</p></div>';
      }

      $cache_time1 = $this->db->get_where('recruiter', array('user_id' => $post['user_id']))->row()->re_comp_name;
      $return_html.='<a class="job_companyname" href="'.base_url('recruiter/rec_profile/' . $post['user_id'].'?page=job').'"  title="'.$cache_time1.'">';

      $out = strlen($cache_time1) > 40 ? substr($cache_time1,0,40)."..." : $cache_time1; 
      $return_html.= $out.'</a></li>';    

      $return_html.='<li><a title="Recruiter Name" class="display_inline" href="'.base_url('recruiter/rec_profile/' . $post['user_id'].'?page=job').'">';  

       $cache_time = $this->db->get_where('recruiter', array('user_id' => $post['user_id']))->row()->rec_firstname;
       $cache_time1 = $this->db->get_where('recruiter', array('user_id' => $post['user_id']))->row()->rec_lastname;

       $return_html.=ucwords($cache_time)."  ".ucwords($cache_time1);
       $return_html.='</a></li>';
                                                       
      $return_html.='</ul></div></div>';

      $return_html.='<div class="profile-job-profile-menu">
                        <ul class="clearfix">';

      $return_html.='<li> <b> Skills</b> <span> ';

        $comma = ", "; 
        $k = 0;
        $aud = $post['post_skill'];
        $aud_res = explode(',', $aud);
        if(!$post['post_skill'])
        {
            $return_html.=$post['other_skill'];
        }
        else if(!$post['other_skill'])
        {
          foreach ($aud_res as $skill) 
          {
             if ($k != 0) 
             {
                $return_html.=$comma;
             }
              $cache_time = $this->db->get_where('skill', array('skill_id' => $skill))->row()->skill;
              $return_html.=$cache_time;
               $k++;
          }
        }
        else if($post['post_skill'] && $post['other_skill'])
        {
          foreach ($aud_res as $skill) 
          {
            if ($k != 0) 
            {
              $return_html.=$comma;
            }
             $cache_time = $this->db->get_where('skill', array('skill_id' => $skill))->row()->skill;
             $return_html.=$cache_time;
             $k++;
          }
          $return_html.=',' . $post['other_skill'];
        }
        $return_html.='</span></li>';

        $return_html.='<li><b>Job Description</b><span><p>';

        if ($post['post_description']) 
        {         
          $return_html.='<pre>'.$this->common->make_links($post['post_description']).'</pre>';
        }
        else
        {
          $return_html.=PROFILENA;
        }             
        $return_html.='</p></span></li>';

        $return_html.='<li><b>Interview Process</b><span>';
        if($post['interview_process'])
        {
          $return_html.='<pre>'.$this->common->make_links($post['interview_process']).'</pre>';
        }
        else
        {
          $return_html.=PROFILENA;
        }
         $return_html.='</span></li>';                                
                                          
         $return_html.='<li><b>Required Experience</b><span><p title="Min - Max">';

         if(($post['min_year'] !='0' || $post['max_year'] !='0') && ($post['fresher'] == 1))
         { 
            $return_html.=$post['min_year'].' Year - '.$post['max_year'] .' Year'." , ".   "Fresher can also apply.";
         }
         else if(($post['min_year'] !='0' || $post['max_year'] !='0'))
         {
            $return_html.=$post['min_year'].' Year - '.$post['max_year'] . ' Year';
         }
         else
         {
            $return_html.="Fresher";
         }
         $return_html.='</p></span></li>';

         $return_html.=' <li><b>Salary</b><span title="Min - Max" >';                              
          $currency = $this->db->get_where('currency', array('currency_id' => $post['post_currency']))->row()->currency_name; 
         if($post['min_sal'] || $post['max_sal']) 
         {
            $return_html.=$post['min_sal']." - ".$post['max_sal'].' '. $currency . ' '. $post['salary_type'];
         }
         else
         {
            $return_html.=PROFILENA;
         }
         $return_html.='</span></li>';

         $return_html.='<li><b>No of Position</b><span>'.$post['post_position'].' Position</span></li>';

         $return_html.='<li><b>Industry Type</b> <span>';
         $cache_time = $this->db->get_where('job_industry', array('industry_id' => $post['industry_type']))->row()->industry_name;
         $return_html.=$cache_time.'</span></li>';

         if ($post['degree_name'] != '' || $post['other_education'] != '') 
         {
            $return_html.='<li> <b>Education Required</b> <span>';
            $comma = ", ";
            $k = 0;
            $edu = $post['degree_name'];
            $edu_nm = explode(',', $edu);

            if(!$post['degree_name'])
            {
              $return_html.=$post['other_education'];
            }
            else if(!$post['other_education'])
            {
               foreach ($edu_nm as $edun) 
               {
                  if ($k != 0) 
                  {
                    $return_html.=$comma;
                  }

                  $cache_time = $this->db->get_where('degree', array('degree_id' => $edun))->row()->degree_name;
                   $return_html.=$cache_time;
                   $k++;
               }
            }
            else if($post['degree_name'] && $post['other_education'])
            {
              foreach ($edu_nm as $edun) 
              {
                 if ($k != 0) 
                 {
                     $return_html.=$comma;
                 }
                 $cache_time = $this->db->get_where('degree', array('degree_id' => $edun))->row()->degree_name;
                 $return_html.=$cache_time;
                 $k++;
              }
              $return_html.=",". $post['other_education'];
            }
            $return_html.='</span></li>';
         }    
         else
         {
            $return_html.='<li><b>Education Required</b><span>'.PROFILENA.'</span></li>';
         } 
              
            $return_html.='<li> <b>Employment Type</b><span>';
            if($post['emp_type'] != '')
            {
               $return_html.='<pre>'.$this->common->make_links($post['emp_type']).'  Job</pre>';
            }
            else
            {
              $return_html.=PROFILENA;
            }
            $return_html.='</span></li>';                           
                                                               
            $return_html.='<li><b>Company Profile</b><span>';                                              
            $currency = $this->db->get_where('recruiter', array('user_id' => $post['user_id']))->row()->re_comp_profile;                  
            if($currency != '')
            {
              $return_html.='<pre>'.$this->common->make_links($currency).'</pre>';
            }    
            else
            {
              $return_html.=PROFILENA;
            }
                                          
            $return_html.='</span></li>';                        
                                                                                                            
      $return_html.='</ul></div>';      
      //have ahi niche thi add karvu                
      $return_html.='</div></div>';
    }
}
else
{

}
echo $return_html;

    }
//GET JOB APPLY DATA WITH AJAX END

}
