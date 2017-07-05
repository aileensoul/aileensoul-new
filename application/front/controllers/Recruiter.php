<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Recruiter extends MY_Controller {

    public $data;

    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('email_model');

        include ('include.php');
    }

    public function index() {



        $userid = $this->session->userdata('aileenuser');

        

        $contition_array = array('user_id' => $userid, 're_status' => '0');
        $artdata = $this->common->select_data_by_condition('recruiter', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

       // echo "<pre>"; print_r($artdata); die();
        if ($artdata) {


            $this->load->view('recruiter/reactivate', $this->data);
        } else {
            $userid = $this->session->userdata('aileenuser');
            $contition_array = array('user_id' => $userid, 're_status' => '1');
            $recrdata = $this->common->select_data_by_condition('recruiter', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');


            if ($recrdata[0]['re_step'] == 1) {
                redirect('recruiter/company_info_form', refresh);
            } else if ($recrdata[0]['re_step'] == 2) {
                redirect('recruiter/rec_comp_address', refresh);
            } else if ($recrdata[0]['re_step'] == 3) {
                redirect('recruiter/recommen_candidate', refresh);
            } else if ($recrdata[0]['re_step'] == 0) {
                redirect('recruiter/rec_basic_information', refresh);
            } else {
                redirect('recruiter/rec_basic_information', refresh);
            }
        }
    }

    public function rec_basic_information() {
        // echo "hello";Die();
        $userid = $this->session->userdata('aileenuser');



     //if user deactive profile then redirect to recruiter/index untill active profile start
         $contition_array = array('user_id'=> $userid,'re_status' => '0','is_delete'=> '0');

        $recruiter_deactive = $this->data['recruiter_deactive'] = $this->common->select_data_by_condition('recruiter', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);

//echo "<pre>"; print_r($recruiter_deactive); die();

        if( $recruiter_deactive)
        {
             redirect('recruiter/');
        }
     //if user deactive profile then redirect to recruiter/index untill active profile End

        $contition_array = array('user_id' => $userid, 're_status' => '1');
        $userdata = $this->common->select_data_by_condition('recruiter', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

       //  echo '<pre>'; print_r($userdata); die();

        if ($userdata) {
            $step = $userdata[0]['re_step'];

            if ($step == 1 || $step > 1) {
                $this->data['firstname'] = $userdata[0]['rec_firstname'];
                $this->data['lastname'] = $userdata[0]['rec_lastname'];
                $this->data['email'] = $userdata[0]['rec_email'];
                $this->data['phone'] = $userdata[0]['rec_phone'];
            }
        }

         $contition_array = array('status' => '1', 'is_delete' => '0' , 'job_step' => 10);
        $recdata = $this->data['results'] = $this->common->select_data_by_condition('job_reg', $contition_array, $data = 'other_skill,designation', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);
        $contition_array = array('status' => '1');
        $jobdata = $this->data['results'] = $this->common->select_data_by_condition('job_add_workexp', $contition_array, $data = 'jobtitle', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);
        $contition_array = array('status' => '1');
        $degreedata = $this->data['results'] = $this->common->select_data_by_condition('degree', $contition_array, $data = 'degree_name', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);
        $contition_array = array('status' => '1');
        $streamdata = $this->data['results'] = $this->common->select_data_by_condition('stream', $contition_array, $data = 'stream_name', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);
        $contition_array = array('status' => '1', 'type' => '1');
        $skill = $this->data['results'] = $this->common->select_data_by_condition('skill', $contition_array, $data = 'skill', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);
        // echo "<pre>"; print_r($artpost);die();


        $uni = array_merge($recdata, $jobdata, $degreedata, $streamdata, $skill);
        //   echo count($unique);


        foreach ($uni as $key => $value) {
            foreach ($value as $ke => $val) {
                if ($val != "") {


                    $result[] = $val;
                }
            }
        }
       foreach($result as $key =>$value){
            $result1[$key]['label']=$value;
            $result1[$key]['value']=$value;
          }
//echo '<pre>'; print_r($result1); die();
         
         $this->data['demo']= $result1;
            $contition_array = array('status' => '1');

       
        $cty = $this->data['cty'] = $this->common->select_data_by_condition('cities', $contition_array, $data = 'city_name', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);
           

            foreach ($cty as $key => $value) {
            foreach ($value as $ke => $val) {
                if ($val != "") {


                    $resu[] = $val;
                }
            }
        }
        $resul = array_unique($resu);
        foreach ($resul as $key => $value) {
            $res[$key]['label'] = $value;
            $res[$key]['value'] = $value;
        }
        
        $this->data['de'] = array_values($res);



        $this->load->view('recruiter/rec_basic_information', $this->data);
    }

    public function basic_information() {  //echo '<pre>'; print_r($_POST); die();
        $userid = $this->session->userdata('aileenuser');

        //if user deactive profile then redirect to recruiter/index untill active profile start
         $contition_array = array('user_id'=> $userid,'re_status' => '0','is_delete'=> '0');

        $recruiter_deactive = $this->data['recruiter_deactive'] = $this->common->select_data_by_condition('recruiter', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);

        if( $recruiter_deactive)
        {
             redirect('recruiter/');
        }
     //if user deactive profile then redirect to recruiter/index untill active profile End


        $this->form_validation->set_rules('first_name', 'first Name', 'required');
        $this->form_validation->set_rules('last_name', 'last Name', 'required');
        $this->form_validation->set_rules('email', ' EmailId', 'required|valid_email');
        
        if ($_FILES['file1']['name']) {
            $image = base_url(RECIMAGE . $_FILES["file1"]['name']);
            if (move_uploaded_file($_FILES['file1']['tmp_name'], $image)) {
                $usre1 = $_FILES["file1"]['name'];
            }
        }

        if ($this->form_validation->run() == FALSE) {

            $contition_array = array('user_id' => $userid, 're_status' => '1');
            $userdata = $this->common->select_data_by_condition('recruiter', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');


            if ($userdata) {
                $step = $userdata[0]['re_step'];

                if ($step == 1 || $step > 1) {
                    $this->data['firstname'] = $userdata[0]['rec_firstname'];
                    $this->data['lastname'] = $userdata[0]['rec_lastname'];
                    $this->data['email'] = $userdata[0]['rec_email'];
                    $this->data['phone'] = $userdata[0]['rec_phone'];
                }
            }

            $this->load->view('recruiter/rec_basic_information', $this->data);
        } else {

            $contition_array = array('user_id' => $userid, 're_status' => '1');
            $userdata = $this->common->select_data_by_condition('recruiter', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');


            if ($userdata) {
                $data = array(
                    'rec_firstname' => $this->input->post('first_name'),
                    'rec_lastname' => $this->input->post('last_name'),
                    'rec_email' => $this->input->post('email'),
                    'rec_phone' => $this->input->post('phoneno')
                );
                // echo "<pre>"; print_r($data); die(); 
                $insert_id = $this->common->update_data($data, 'recruiter', 'rec_id', $userdata[0]['rec_id']);
                // echo $insert_id; die();
                if ($insert_id) {
                    //  echo "hello";die();
                    $this->session->set_flashdata('success', 'Basic information updated successfully');
                    redirect('recruiter/company_info_form', refresh);
                } else {
                    $this->session->flashdata('error', 'Sorry!! Your data not inserted');
                    redirect('recruiter', refresh);
                }
            } else {
                $data = array(
                    'rec_firstname' => $this->input->post('first_name'),
                    'rec_lastname' => $this->input->post('last_name'),
                    'rec_email' => $this->input->post('email'),
                    'rec_phone' => $this->input->post('phoneno'),
                    're_status' => 1,
                    'is_delete' => 0,
                    'created_date' => date('y-m-d h:i:s'),
                    'user_id' => $userid,
                    're_step' => 1
                );
                // echo "<pre>"; print_r($data); die(); 
                $insert_id = $this->common->insert_data_getid($data, 'recruiter');

                if ($insert_id) {

                    $this->session->set_flashdata('success', 'Basic information inserted successfully');
                    redirect('recruiter/company_info_form', refresh);
                } else {
                    $this->session->flashdata('error', 'Sorry!! Your data not inserted');
                    redirect('recruiter', refresh);
                }
            }

            //}
        }
    }

//check email avilibity start


    public function check_email() { //echo "hello"; die();
        // if ($this->input->is_ajax_request() && $this->input->post('email')) {
        $email = $this->input->post('email');

        $userid = $this->session->userdata('aileenuser');

         //if user deactive profile then redirect to recruiter/index untill active profile start
         $contition_array = array('user_id'=> $userid,'re_status' => '0','is_delete'=> '0');

        $recruiter_deactive = $this->data['recruiter_deactive'] = $this->common->select_data_by_condition('recruiter', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);

        if( $recruiter_deactive)
        {
             redirect('recruiter/');
        }
     //if user deactive profile then redirect to recruiter/index untill active profile End


        $contition_array = array('user_id' => $userid, 'is_delete' => '0', 're_status' => '1');
        $userdata = $this->common->select_data_by_condition('recruiter', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        $email1 = $userdata[0]['rec_email'];

        // if ($this->input->post('business_profile_id')) {
        //   //alert("hi1");
        // $id = $this->input->post('business_profile_id');
        // $check_result = $this->common->check_unique_avalibility('business_profile', 'contact_email', $email, 'business_profile_id', $id, $condition_array);
        // } else {
        //alert("hi");
        if ($email1) {
            $condition_array = array('is_delete' => '0', 'user_id !=' => $userid, 're_status' => '1');

            $check_result = $this->common->check_unique_avalibility('recruiter', 'rec_email', $email, '', '', $condition_array);
        } else {

            $condition_array = array('is_delete' => '0', 're_status' => '1');

            $check_result = $this->common->check_unique_avalibility('recruiter', 'rec_email', $email, '', '', $condition_array);
        }

        if ($check_result) {
            echo 'true';
            die();
        } else {
            echo 'false';
            die();
        }
    }

    //}


    public function check_email_com() { //echo "hello"; die();
        // if ($this->input->is_ajax_request() && $this->input->post('email')) {
        $email = $this->input->post('comp_email');

        $userid = $this->session->userdata('aileenuser');

         //if user deactive profile then redirect to recruiter/index untill active profile start
         $contition_array = array('user_id'=> $userid,'re_status' => '0','is_delete'=> '0');

        $recruiter_deactive = $this->data['recruiter_deactive'] = $this->common->select_data_by_condition('recruiter', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);

        if( $recruiter_deactive)
        {
             redirect('recruiter/');
        }
     //if user deactive profile then redirect to recruiter/index untill active profile End


        $contition_array = array('user_id' => $userid, 'is_delete' => '0', 're_status' => '1');
        $userdata = $this->common->select_data_by_condition('recruiter', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        $email1 = $userdata[0]['rec_email'];

        // if ($this->input->post('business_profile_id')) {
        //   //alert("hi1");
        // $id = $this->input->post('business_profile_id');
        // $check_result = $this->common->check_unique_avalibility('business_profile', 'contact_email', $email, 'business_profile_id', $id, $condition_array);
        // } else {
        //alert("hi");
        if ($email1) {
            $condition_array = array('is_delete' => '0', 'user_id !=' => $userid);

            $check_result = $this->common->check_unique_avalibility('recruiter', 'rec_email', $email, '', '', $condition_array);
        } else {

            $condition_array = array('is_delete' => '0');

            $check_result = $this->common->check_unique_avalibility('recruiter', 'rec_email', $email, '', '', $condition_array);
        }

        if ($check_result) {
            echo 'true';
            die();
        } else {
            echo 'false';
            die();
        }
    }

    //}
// check email end




    public function company_info_form() {



        $userid = $this->session->userdata('aileenuser');

         //if user deactive profile then redirect to recruiter/index untill active profile start
         $contition_array = array('user_id'=> $userid,'re_status' => '0','is_delete'=> '0');

        $recruiter_deactive = $this->data['recruiter_deactive'] = $this->common->select_data_by_condition('recruiter', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);

        if( $recruiter_deactive)
        {
             redirect('recruiter/');
        }
     //if user deactive profile then redirect to recruiter/index untill active profile End


        $contition_array = array('user_id' => $userid, 're_status' => '1');
        $userdata = $this->common->select_data_by_condition('recruiter', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        // echo '<pre>'; print_r($userdata); die();

        if ($userdata) {
            $step = $userdata[0]['re_step'];

            if ($step == 2 || $step > 2 || ($step >= 1 && $step <= 2)) {
                $this->data['compname'] = $userdata[0]['re_comp_name'];
                $this->data['compemail'] = $userdata[0]['re_comp_email'];
                $this->data['compnum'] = $userdata[0]['re_comp_phone'];
                $this->data['compweb'] = $userdata[0]['re_comp_site'];
                $this->data['compservices'] = $userdata[0]['re_comp_interview'];
                $this->data['comp_project1'] = $userdata[0]['re_comp_project'];
                // $this->data['interview_process1'] = $userdata[0]['re_comp_interview'];
                $this->data['other_activities1'] = $userdata[0]['re_comp_activities'];
            }
        }
        $contition_array = array('status' => '1', 'is_delete' => '0' ,'job_step' => 10);
        $recdata = $this->data['results'] = $this->common->select_data_by_condition('job_reg', $contition_array, $data = 'other_skill,designation', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);
        $contition_array = array('status' => '1');
        $jobdata = $this->data['results'] = $this->common->select_data_by_condition('job_add_workexp', $contition_array, $data = 'jobtitle', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);
        $contition_array = array('status' => '1');
        $degreedata = $this->data['results'] = $this->common->select_data_by_condition('degree', $contition_array, $data = 'degree_name', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);
        $contition_array = array('status' => '1');
        $streamdata = $this->data['results'] = $this->common->select_data_by_condition('stream', $contition_array, $data = 'stream_name', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);
        $contition_array = array('status' => '1', 'type' => '1');
        $skill = $this->data['results'] = $this->common->select_data_by_condition('skill', $contition_array, $data = 'skill', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);
        // echo "<pre>"; print_r($artpost);die();


        $uni = array_merge($recdata, $jobdata, $degreedata, $streamdata, $skill);
        //   echo count($unique);


        foreach ($uni as $key => $value) {
            foreach ($value as $ke => $val) {
                if ($val != "") {


                    $result[] = $val;
                }
            }
        }
       foreach($result as $key =>$value){
            $result1[$key]['label']=$value;
            $result1[$key]['value']=$value;
          }
//echo '<pre>'; print_r($result1); die();
         
         $this->data['demo']= $result1;

   $contition_array = array('status' => '1');

       
        $cty = $this->data['cty'] = $this->common->select_data_by_condition('cities', $contition_array, $data = 'city_name', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);
           

            foreach ($cty as $key => $value) {
            foreach ($value as $ke => $val) {
                if ($val != "") {


                    $resu[] = $val;
                }
            }
        }
        $resul = array_unique($resu);
        foreach ($resul as $key => $value) {
            $res[$key]['label'] = $value;
            $res[$key]['value'] = $value;
        }
        
        $this->data['de'] = array_values($res);


        $this->load->view('recruiter/company_information', $this->data);
    }

    public function company_info_store() {


        $userid = $this->session->userdata('aileenuser');

         //if user deactive profile then redirect to recruiter/index untill active profile start
         $contition_array = array('user_id'=> $userid,'re_status' => '0','is_delete'=> '0');

        $recruiter_deactive = $this->data['recruiter_deactive'] = $this->common->select_data_by_condition('recruiter', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);

        if( $recruiter_deactive)
        {
             redirect('recruiter/');
        }
     //if user deactive profile then redirect to recruiter/index untill active profile End


        // if($this->input->post('previous')){  //echo "hii"; die();
        //       redirect('recruiter/rec_basic_information', refresh);
        //     }
        //if($this->input->post('next')){  //echo "hii"; die();


        $this->form_validation->set_rules('comp_name', 'company Name', 'required');
        $this->form_validation->set_rules('comp_email', 'company email', 'required|valid_email');
        // $this->form_validation->set_rules('comp_site', ' company site', 'required');
        // $this->form_validation->set_rules('comp_num', 'company url', 'required|valid_url');
        // $this->form_validation->set_rules('interview', 'company interview', 'required');
        //$this->form_validation->set_rules('comp_project', 'Company project', 'required');
        //$this->form_validation->set_rules('other_activities', 'company services', 'required');

        if ($this->form_validation->run() == FALSE) {

            $contition_array = array('user_id' => $userid);
            $userdata = $this->common->select_data_by_condition('recruiter', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

            // echo '<pre>'; print_r($userdata); die();

            if ($userdata) {
                $step = $userdata[0]['re_step'];

                if ($step == 2 || $step > 2 || ($step >= 1 && $step <= 2)) {
                    $this->data['compname'] = $userdata[0]['re_comp_name'];
                    $this->data['compemail'] = $userdata[0]['re_comp_email'];
                    $this->data['compnum'] = $userdata[0]['re_comp_phone'];
                    $this->data['compweb'] = $userdata[0]['re_comp_site'];
                    $this->data['compservices'] = $userdata[0]['re_comp_interview'];
                    $this->data['comp_project1'] = $userdata[0]['re_comp_project'];
                    // $this->data['interview_process1'] = $userdata[0]['re_comp_interview'];
                    $this->data['other_activities1'] = $userdata[0]['re_comp_activities'];
                }
            }
            $this->load->view('recruiter/company_information', $this->data);
        } else {

            $contition_array = array('user_id' => $userid, 're_status' => '1');
            $userdata = $this->common->select_data_by_condition('recruiter', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

// $userdata = $this->common-> select_data_by_id('recruiter', 'user_id', $userid, $data = '*', $join_str = array());

            if ($userdata) {

                if ($userdata[0]['re_step'] == 3) {
                    $data = array(
                        're_step' => 3
                    );

                    $insert_id = $this->common->update_data($data, 'recruiter', 'rec_id', $userdata[0]['rec_id']);
                } else if ($userdata[0]['re_step'] > 2) {
                    $data = array(
                        're_step' => $userdata[0]['re_step']
                    );

                    $insert_id = $this->common->update_data($data, 'recruiter', 'rec_id', $userdata[0]['rec_id']);
                } else {
                    $data = array(
                        're_step' => 2
                    );

                    $insert_id = $this->common->update_data($data, 'recruiter', 'rec_id', $userdata[0]['rec_id']);
                }

                $data = array(
                    're_comp_name' => $this->input->post('comp_name'),
                    're_comp_email' => $this->input->post('comp_email'),
                    're_comp_site' => $this->input->post('comp_site'),
                    're_comp_phone' => $this->input->post('comp_num'),
                    're_comp_interview' => $this->input->post('interview'),
                    're_comp_project' => $this->input->post('comp_project'),
                    're_comp_activities' => $this->input->post('other_activities')
                );
                // echo $userdata[0]['rec_id'];
                // echo "<pre>"; print_r($data); die(); 
                $insert_id = $this->common->update_data($data, 'recruiter', 'rec_id', $userdata[0]['rec_id']);

                if ($insert_id) {

                    $this->session->set_flashdata('success', 'company information updated successfully');
                    redirect('recruiter/rec_comp_address', refresh);
                } else {
                    $this->session->flashdata('error', 'Sorry!! Your data not inserted');
                    redirect('recruiter', refresh);
                }
            } else {

                if ($userdata[0]['re_step'] == 3) {
                    $data = array(
                        're_step' => 3
                    );

                    $insert_id = $this->common->update_data($data, 'recruiter', 'rec_id', $userdata[0]['rec_id']);
                } else if ($userdata[0]['re_step'] > 2) {
                    $data = array(
                        're_step' => $userdata[0]['re_step']
                    );

                    $insert_id = $this->common->update_data($data, 'recruiter', 'rec_id', $userdata[0]['rec_id']);
                } else {
                    $data = array(
                        're_step' => 2
                    );

                    $insert_id = $this->common->update_data($data, 'recruiter', 'rec_id', $userdata[0]['rec_id']);
                }

                $data = array(
                    're_comp_name' => $this->input->post('comp_name'),
                    're_comp_email' => $this->input->post('comp_email'),
                    're_comp_site' => $this->input->post('comp_site'),
                    're_comp_phone' => $this->input->post('comp_num'),
                    're_comp_interview' => $this->input->post('interview'),
                    're_comp_project' => $this->input->post('comp_project'),
                    're_comp_activities' => $this->input->post('other_activities'),
                    'is_delete' => 0,
                    're_status' => 1,
                    'created_date' => date('y-m-d h:i:s')
                );

                $insert_id = $this->common->update_data($data, 'recruiter', 'user_id', $userid);
                if ($insert_id) {
                    $this->session->set_flashdata('success', 'company information inserted successfully');
                    redirect('recruiter/rec_comp_address', refresh);
                } else {
                    $this->session->flashdata('error', 'Sorry!! Your data not inserted');
                    redirect('recruiter', refresh);
                }
            }
            // }
        }
    }

    public function rec_comp_address() {

        $userid = $this->session->userdata('aileenuser');

         //if user deactive profile then redirect to recruiter/index untill active profile start
         $contition_array = array('user_id'=> $userid,'re_status' => '0','is_delete'=> '0');

        $recruiter_deactive = $this->data['recruiter_deactive'] = $this->common->select_data_by_condition('recruiter', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);

        if( $recruiter_deactive)
        {
             redirect('recruiter/');
        }
     //if user deactive profile then redirect to recruiter/index untill active profile End

        $contition_array = array('status' => 1);
        $this->data['countries'] = $this->common->select_data_by_condition('countries', $contition_array, $data = '*', $sortby = 'country_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');



        //for getting state data


 $contition_array = array('user_id' => $userid, 're_status' => '1','is_delete'=> '0');
      $state_citydata = $this->common->select_data_by_condition('recruiter', $contition_array, $data = 're_comp_state,re_comp_country', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');




        $contition_array = array('status' => 1,'country_id' => $state_citydata[0]['re_comp_country']);
        $this->data['states'] = $this->common->select_data_by_condition('states', $contition_array, $data = '*', $sortby = 'state_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        //for getting city data
        $contition_array = array('status' => '1','state_id'=> $state_citydata[0]['re_comp_state']);
        $this->data['cities'] = $this->common->select_data_by_condition('cities', $contition_array, $data = '*', $sortby = 'city_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');
        //echo "<pre>";print_r($this->data['city']);echo "</pre>";die();





        $contition_array = array('user_id' => $userid, 're_status' => '1');
        $userdata = $this->common->select_data_by_condition('recruiter', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        // echo '<pre>'; print_r($userdata); die();

        if ($userdata) {
            $step = $userdata[0]['re_step'];

            if ($step == 3 || ($step >= 1 && $step <= 3)) {
                $this->data['country1'] = $userdata[0]['re_comp_country'];
                $this->data['state1'] = $userdata[0]['re_comp_state'];
                $this->data['city1'] = $userdata[0]['re_comp_city'];
                $this->data['postal_address1'] = $userdata[0]['re_comp_address'];
            }
        }

         $contition_array = array('status' => '1', 'is_delete' => '0' ,'job_step' => 10);
        $recdata = $this->data['results'] = $this->common->select_data_by_condition('job_reg', $contition_array, $data = 'other_skill,designation', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);
        $contition_array = array('status' => '1');
        $jobdata = $this->data['results'] = $this->common->select_data_by_condition('job_add_workexp', $contition_array, $data = 'jobtitle', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);
        $contition_array = array('status' => '1');
        $degreedata = $this->data['results'] = $this->common->select_data_by_condition('degree', $contition_array, $data = 'degree_name', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);
        $contition_array = array('status' => '1');
        $streamdata = $this->data['results'] = $this->common->select_data_by_condition('stream', $contition_array, $data = 'stream_name', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);
        $contition_array = array('status' => '1', 'type' => '1');
        $skill = $this->data['results'] = $this->common->select_data_by_condition('skill', $contition_array, $data = 'skill', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);
        // echo "<pre>"; print_r($artpost);die();


        $uni = array_merge($recdata, $jobdata, $degreedata, $streamdata, $skill);
        //   echo count($unique);


        foreach ($uni as $key => $value) {
            foreach ($value as $ke => $val) {
                if ($val != "") {


                    $result[] = $val;
                }
            }
        }
       foreach($result as $key =>$value){
            $result1[$key]['label']=$value;
            $result1[$key]['value']=$value;
          }
//echo '<pre>'; print_r($result1); die();
         
         $this->data['demo']= $result1;
             $contition_array = array('status' => '1');

          $citiesss = $this->common->select_data_by_condition('cities', $contition_array, $data = 'city_name', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);
foreach ($citiesss as $key1) {
              
                 $location[] = $key1['city_name'];
             
          }
       
        
           

        //     foreach ($cty as $key => $value) {
        //     foreach ($value as $ke => $val) {
        //         if ($val != "") {


        //             $resu[] = $val;
        //         }
        //     }
        // }
        // $resul = array_unique($resu);
      foreach ($location as $key => $value) {
              $loc[$key]['label'] =$value;
              $loc[$key]['value'] =$value;
          }
        
        $this->data['city_data']= $loc;


        //echo "<pre>"; print_r( $this->data['countrydata'] ); die();
        $this->load->view('recruiter/company_address', $this->data);
    }

    public function ajax_data() {

        if (isset($_POST["country_id"]) && !empty($_POST["country_id"])) {
            //Get all state data
            $contition_array = array('country_id' => $_POST["country_id"], 'status' => '1');
            $state = $this->data['states'] = $this->common->select_data_by_condition('states', $contition_array, $data = '*', $sortby = 'state_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');

            //Count total number of rows
            //Display states list
            if (count($state) > 0) {
                echo '<option value="">Select state</option>';
                foreach ($state as $st) {
                    echo '<option value="' . $st['state_id'] . '">' . $st['state_name'] . '</option>';
                }
            } else {
                echo '<option value="">State not available</option>';
            }
        }

        if (isset($_POST["state_id"]) && !empty($_POST["state_id"])) {
            //Get all city data
            $contition_array = array('state_id' => $_POST["state_id"], 'status' => '1');
            $city = $this->data['city'] = $this->common->select_data_by_condition('cities', $contition_array, $data = '*', $sortby = 'city_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');


            //Display cities list
            if (count($city) > 0) {
                echo '<option value="">Select city</option>';
                foreach ($city as $cit) {
                    echo '<option value="' . $cit['city_id'] . '">' . $cit['city_name'] . '</option>';
                }
            } else {
                echo '<option value="">City not available</option>';
            }
        }
    }

    public function comp_address_store() {

        $userid = $this->session->userdata('aileenuser');

         //if user deactive profile then redirect to recruiter/index untill active profile start
         $contition_array = array('user_id'=> $userid,'re_status' => '0','is_delete'=> '0');

        $recruiter_deactive = $this->data['recruiter_deactive'] = $this->common->select_data_by_condition('recruiter', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);

        if( $recruiter_deactive)
        {
             redirect('recruiter/');
        }
     //if user deactive profile then redirect to recruiter/index untill active profile End

        if ($this->input->post('previous')) {  //echo "hii"; die();
            redirect('recruiter/company_info_form', refresh);
        }

        if ($this->input->post('submit')) {
            $this->form_validation->set_rules('country', 'Country', 'required');
            $this->form_validation->set_rules('state', 'State', 'required');
            // $this->form_validation->set_rules('city', ' City', 'required');
            $this->form_validation->set_rules('postal_address', 'Postal address', 'required');


            if ($this->form_validation->run() == FALSE) {


                $contition_array = array('user_id' => $userid, 're_status' => '1');
                $userdata = $this->common->select_data_by_condition('recruiter', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

                //   $contition_array = array('user_id' => $userid);
                // $userdata =  $this->common->select_data_by_condition('recruiter', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
                //echo '<pre>'; print_r($userdata); die();

                if ($userdata) {
                    $step = $userdata[0]['re_step'];

                    if ($step == 3 || ($step >= 1 && $step <= 3)) {
                        $this->data['country1'] = $userdata[0]['re_comp_country'];
                        $this->data['state1'] = $userdata[0]['re_comp_state'];
                        $this->data['city1'] = $userdata[0]['re_comp_city'];
                        $this->data['postal_address1'] = $userdata[0]['re_comp_address'];
                    }
                }
                $this->load->view('recruiter/company_address', $this->data);
            } else {


                $contition_array = array('user_id' => $userid, 're_status' => '1');
                $userdata = $this->common->select_data_by_condition('recruiter', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
                
                $data = array(
                    're_comp_country' => $this->input->post('country'),
                    're_comp_state' => $this->input->post('state'),
                    're_comp_city' => $this->input->post('city'),
                    're_comp_address' => $this->input->post('postal_address'),
                    'modify_date' => date('y-m-d h:i:s'),
                    're_step' => 3
                );

                $insert_id = $this->common->update_data($data, 'recruiter', 'user_id', $userid);
                if ($insert_id) {
                    $this->session->set_flashdata('success', 'company address inserted successfully');

                    if($userdata[0]['re_step'] == 3){
                    redirect('recruiter/rec_profile', refresh);
                  }else{
                    redirect('recruiter/recommen_candidate', refresh);
                  }
                } else {
                    $this->session->flashdata('error', 'Sorry!! Your data not inserted');
                    redirect('recruiter/rec_comp_address', refresh);
                }
            }
        }
    }

    public function rec_post($id="") { 
        //echo "falguni"; die();
        $this->data['userid'] = $userid = $this->session->userdata('aileenuser');

         //if user deactive profile then redirect to recruiter/index untill active profile start
         $contition_array = array('user_id'=> $userid,'re_status' => '0','is_delete'=> '0');

        $recruiter_deactive = $this->data['recruiter_deactive'] = $this->common->select_data_by_condition('recruiter', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);

        if( $recruiter_deactive)
        {
             redirect('recruiter/');
        }
     //if user deactive profile then redirect to recruiter/index untill active profile End

        $contition_array = array('user_id' => $userid, 'is_delete' => 0);
           $this->data['postdataone'] = $this->common->select_data_by_condition('recruiter', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str, $groupby = '');
           //echo "<pre>"; print_r($this->data['postdata']); die();

        if ($id == $userid || $id == '') {
            //echo "hii"; die();
            $join_str[0]['table'] = 'recruiter';
            $join_str[0]['join_table_id'] = 'recruiter.user_id';
            $join_str[0]['from_table_id'] = 'rec_post.user_id';
            $join_str[0]['join_type'] = '';


            $contition_array = array('rec_post.user_id' => $userid, 'rec_post.is_delete' => 0);
           $this->data['postdata'] = $this->common->select_data_by_condition('rec_post', $contition_array, $data = 'rec_post.*,recruiter.rec_firstname,recruiter.re_comp_name,recruiter.rec_lastname,recruiter.recruiter_user_image,recruiter.profile_background', $sortby = 'post_id', $orderby = 'desc', $limit = '', $offset = '', $join_str, $groupby = '');
           //echo "<pre>"; print_r($this->data['postdata']); die();

        } else { 
            //echo "hello"; die()
            ;
      $contition_array = array('user_id' => $id, 'is_delete' => 0 ,'re_step' => 3);
           $this->data['postdataone'] = $this->common->select_data_by_condition('recruiter', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str, $groupby = '');
            
            $join_str[0]['table'] = 'recruiter';
            $join_str[0]['join_table_id'] = 'recruiter.user_id';
            $join_str[0]['from_table_id'] = 'rec_post.user_id';
            $join_str[0]['join_type'] = '';

            $contition_array = array('rec_post.user_id' => $id, 'rec_post.is_delete' => 0 ,'recruiter.re_step' => 3);
            $this->data['postdata'] = $this->common->select_data_by_condition('rec_post', $contition_array, $data = 'rec_post.*,recruiter.rec_firstname,recruiter.re_comp_name,recruiter.rec_lastname,recruiter.recruiter_user_image,recruiter.profile_background', $sortby = 'post_id', $orderby = 'desc', $limit = '', $offset = '', $join_str, $groupby = '');
          // echo "<pre>"; print_r($this->data['postdata']); die();
        }
        
       
        $contition_array = array('status' => '1', 'is_delete' => '0','job_step' => 10);
        $recdata = $this->data['results'] = $this->common->select_data_by_condition('job_reg', $contition_array, $data = 'other_skill,designation', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);
        $contition_array = array('status' => '1');
        $jobdata = $this->data['results'] = $this->common->select_data_by_condition('job_add_workexp', $contition_array, $data = 'jobtitle', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);
        $contition_array = array('status' => '1');
        $degreedata = $this->data['results'] = $this->common->select_data_by_condition('degree', $contition_array, $data = 'degree_name', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);
        $contition_array = array('status' => '1');
        $streamdata = $this->data['results'] = $this->common->select_data_by_condition('stream', $contition_array, $data = 'stream_name', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);
        $contition_array = array('status' => '1', 'type' => '1');
        $skill = $this->data['results'] = $this->common->select_data_by_condition('skill', $contition_array, $data = 'skill', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);
        // echo "<pre>"; print_r($artpost);die();


        $uni = array_merge($recdata, $jobdata, $degreedata, $streamdata, $skill);
        //   echo count($unique);


        foreach ($uni as $key => $value) {
            foreach ($value as $ke => $val) {
                if ($val != "") {


                    $result[] = $val;
                }
            }
        }
       foreach($result as $key =>$value){
            $result1[$key]['label']=$value;
            $result1[$key]['value']=$value;
          }
//echo '<pre>'; print_r($result1); die();
         
         $this->data['demo']= $result1;
            $contition_array = array('status' => '1');

       
        $cty = $this->data['cty'] = $this->common->select_data_by_condition('cities', $contition_array, $data = 'city_name', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);
           

            foreach ($cty as $key => $value) {
            foreach ($value as $ke => $val) {
                if ($val != "") {


                    $resu[] = $val;
                }
            }
        }
        $resul = array_unique($resu);
        foreach ($resul as $key => $value) {
            $res[$key]['label'] = $value;
            $res[$key]['value'] = $value;
        }
        
        $this->data['de'] = array_values($res);


        //     echo "<pre>";print_r($this->data['postdata']);die();
        $this->load->view('recruiter/rec_post', $this->data);
    }

    public function add_post() {

        $userid = $this->session->userdata('aileenuser');

         //if user deactive profile then redirect to recruiter/index untill active profile start
         $contition_array = array('user_id'=> $userid,'re_status' => '0','is_delete'=> '0');

        $recruiter_deactive = $this->data['recruiter_deactive'] = $this->common->select_data_by_condition('recruiter', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);

        if( $recruiter_deactive)
        {
             redirect('recruiter/');
        }
     //if user deactive profile then redirect to recruiter/index untill active profile End

         $contition_array = array('status' => 1);
        $this->data['currency'] = $this->common->select_data_by_condition('currency', $contition_array, $data = '*', $sortby = 'currency_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        $contition_array = array('status' => '1');
        $this->data['countries'] = $this->common->select_data_by_condition('countries', $contition_array, $data = '*', $sortby = 'country_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        $contition_array = array('status' => '1');
        $this->data['skill'] = $this->common->select_data_by_condition('skill', $contition_array, $data = '*', $sortby = 'skill', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');
      //  echo "<pre>"; print_r($this->data['skill']);die();

        $this->data['recdata'] = $this->common->select_data_by_id('recruiter', 'user_id', $userid, $data = '*', $join_str = array());


        $contition_array = array('status' => '1', 'user_id' => $userid);

        $edudata = $this->data['edudata'] = $this->common->select_data_by_condition('job_add_edu', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str, $groupby = '');


        $contition_array = array('status' => '1', 'is_delete' => '0' ,'job_step' => 10);


        $recdata = $this->data['results'] = $this->common->select_data_by_condition('job_reg', $contition_array, $data = 'other_skill,designation', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);

        $contition_array = array('status' => '1');

        $jobdata = $this->data['results'] = $this->common->select_data_by_condition('job_add_workexp', $contition_array, $data = 'jobtitle', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);


        $contition_array = array('status' => '1');

        $degreedata = $this->data['results'] = $this->common->select_data_by_condition('degree', $contition_array, $data = 'degree_name', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);


        $contition_array = array('status' => '1');

        $streamdata = $this->data['results'] = $this->common->select_data_by_condition('stream', $contition_array, $data = 'stream_name', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);


        $contition_array = array('status' => '1', 'type' => '1');

        $skill = $this->data['results'] = $this->common->select_data_by_condition('skill', $contition_array, $data = 'skill', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);
        // echo "<pre>"; print_r($artpost);die();


        $uni = array_merge($recdata, $jobdata, $degreedata, $streamdata, $skill, $edudata);
        //   echo count($unique);


        foreach ($uni as $key => $value) {
            foreach ($value as $ke => $val) {
                if ($val != "") {


                    $result[] = $val;
                }
            }
        }
        foreach ($result as $key => $value) {
            $result1[$key]['label'] = $value;
            $result1[$key]['value'] = $value;
        }


        $this->data['demo'] = array_values($result1);
           $contition_array = array('status' => '1');

       
        $cty = $this->data['cty'] = $this->common->select_data_by_condition('cities', $contition_array, $data = 'city_name', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);
           

            foreach ($cty as $key => $value) {
            foreach ($value as $ke => $val) {
                if ($val != "") {


                    $resu[] = $val;
                }
            }
        }
        $resul = array_unique($resu);
        foreach ($resul as $key => $value) {
            $res[$key]['label'] = $value;
            $res[$key]['value'] = $value;
        }
        
        $this->data['de'] = array_values($res);


        $this->load->view('recruiter/add_post', $this->data);
    }

    public function add_post_store() {

        //echo "string"; die();
//echo '<pre>'; print_r($_POST); die();
        $userid = $this->session->userdata('aileenuser');

         //if user deactive profile then redirect to recruiter/index untill active profile start
         $contition_array = array('user_id'=> $userid,'re_status' => '0','is_delete'=> '0');

        $recruiter_deactive = $this->data['recruiter_deactive'] = $this->common->select_data_by_condition('recruiter', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);

        if( $recruiter_deactive)
        {
             redirect('recruiter/');
        }
     //if user deactive profile then redirect to recruiter/index untill active profile End

        $skill = $this->input->post('skills');
           $bod = $this->input->post('last_date');
                $bod = str_replace('/', '-', $bod);
       
         // echo  date('Y-m-d h:i:s', strtotime($dob)); die();
        $this->form_validation->set_rules('post_name', 'Post Name', 'required');
        //$this->form_validation->set_rules('skills', 'Skils Name', 'required|regex_match[/^(?![0-9]*$)[a-zA-Z0-9]+$/]');
        //$this->form_validation->set_rules('month', 'Month', 'required');
        //$this->form_validation->set_rules('interview', ' Interview', 'required');
        //$this->form_validation->set_rules('position', ' Position', 'required');
        $this->form_validation->set_rules('post_desc', ' Description', 'required');
        //$this->form_validation->set_rules('other_skill', ' Other skill', 'required');
        $this->form_validation->set_rules('last_date', 'Last date', 'required');
        //$this->form_validation->set_rules('location', 'location', 'required|alpha');
        $this->form_validation->set_rules('country', 'Country', 'required');
        $this->form_validation->set_rules('state', 'State', 'required');
       

        //$this->form_validation->set_rules('city', 'City', 'required');
        // $this->form_validation->set_rules('minsal', 'location', 'regex_match[/^[0-9,]+$/]');
        // $this->form_validation->set_rules('maxsal', 'location', 'regex_match[/^[0-9,]+$/]');
        //  $this->form_validation->set_rules('maxmonth', 'Max month', 'required');
        // $this->form_validation->set_rules('minyear', ' Max year', 'required');
        //$this->form_validation->set_rules('minmonth', ' Min month', 'required');
        // $this->form_validation->set_rules('maxyear', ' Min year', 'required');


        if ($this->form_validation->run() == FALSE) {
            $contition_array = array('status' => '1');
        $this->data['countries'] = $this->common->select_data_by_condition('countries', $contition_array, $data = '*', $sortby = 'country_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        $contition_array = array('status' => '1', 'type' => '1');
        $this->data['skill'] = $this->common->select_data_by_condition('skill', $contition_array, $data = '*', $sortby = 'skill', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        $this->data['recdata'] = $this->common->select_data_by_id('recruiter', 'user_id', $userid, $data = '*', $join_str = array());
 $contition_array = array('status' => 1);
        $this->data['currency'] = $this->common->select_data_by_condition('currency', $contition_array, $data = '*', $sortby = 'currency_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');


        $contition_array = array('status' => '1', 'user_id' => $userid);

        $edudata = $this->data['edudata'] = $this->common->select_data_by_condition('job_add_edu', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str, $groupby = '');


        $contition_array = array('status' => '1', 'is_delete' => '0' ,'job_step' => 10);


        $recdata = $this->data['results'] = $this->common->select_data_by_condition('job_reg', $contition_array, $data = 'other_skill', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);

        $contition_array = array('status' => '1');

        $jobdata = $this->data['results'] = $this->common->select_data_by_condition('job_add_workexp', $contition_array, $data = 'jobtitle', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);


        $contition_array = array('status' => '1');

        $degreedata = $this->data['results'] = $this->common->select_data_by_condition('degree', $contition_array, $data = 'degree_name', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);


        $contition_array = array('status' => '1');

        $streamdata = $this->data['results'] = $this->common->select_data_by_condition('stream', $contition_array, $data = 'stream_name', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);


        $contition_array = array('status' => '1', 'type' => '1');

        $skill = $this->data['results'] = $this->common->select_data_by_condition('skill', $contition_array, $data = 'skill', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);
        // echo "<pre>"; print_r($artpost);die();


        $uni = array_merge($recdata, $jobdata, $degreedata, $streamdata, $skill, $edudata);
        //   echo count($unique);


        foreach ($uni as $key => $value) {
            foreach ($value as $ke => $val) {
                if ($val != "") {


                    $result[] = $val;
                }
            }
        }
        foreach ($result as $key => $value) {
            $result1[$key]['label'] = $value;
            $result1[$key]['value'] = $value;
        }


        $this->data['demo'] = array_values($result1);
           $contition_array = array('status' => '1');

       
        $cty = $this->data['cty'] = $this->common->select_data_by_condition('cities', $contition_array, $data = 'city_name', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);
           

            foreach ($cty as $key => $value) {
            foreach ($value as $ke => $val) {
                if ($val != "") {


                    $resu[] = $val;
                }
            }
        }
        $resul = array_unique($resu);
        foreach ($resul as $key => $value) {
            $res[$key]['label'] = $value;
            $res[$key]['value'] = $value;
        }
        
        $this->data['de'] = array_values($res);



             // echo "hi"; die();
            $this->load->view('recruiter/add_post',$this->data);
        } else {
            //echo "hello"; die();
            $data = array(
                'post_name' => $this->input->post('post_name'),
                'post_description' => $this->input->post('post_desc'),
                'post_skill' => implode(",", $skill),
                'post_position' => $this->input->post('position_no'),
                 
                 'post_last_date' => date('Y-m-d', strtotime($bod)),
                //'post_location ' => $this->input->post('location'),
                'country' => $this->input->post('country'),
                'state' => $this->input->post('state'),
                'city' => $this->input->post('city'),
                'min_month' => $this->input->post('minmonth'),
                'min_year' => $this->input->post('minyear'),
                'max_month' => $this->input->post('maxmonth'),
                'max_year' => $this->input->post('maxyear'),
                'interview_process' => $this->input->post('interview'),
                'fresher' => $this->input->post('fresher'),
                'min_sal' => $this->input->post('minsal'),
                'max_sal' => $this->input->post('maxsal'),
                'post_currency' => $this->input->post('currency'),
                'is_delete' => 0,
                'other_skill' => $this->input->post('other_skill'),
                'created_date' => date('y-m-d h:i:s'),
                'user_id' => $userid,
                'status' => 1,
            );
          //  echo "<pre>"; print_r($data); die(); 
            $insert_id = $this->common->insert_data_getid($data, 'rec_post');



        $otherskilldata = explode(',',$this->input->post('other_skill'));


            foreach ($otherskilldata as $dataskill) {
            $data1 = array(
                'skill' => $dataskill,
                'type' => 4,
                'user_id' => $userid
            );
            // echo '<pre>'; print_r($data1); die();
            $insertid = $this->common->insert_data_getid($data1, 'skill');
                }

            if ($insert_id) {
                $this->session->set_flashdata('success', 'your post inserted successfully');
                redirect('recruiter/rec_post', 'refresh');
            } else {
                $this->session->flashdata('error', 'Sorry!! Your data not inserted');
                redirect('recruiter', 'refresh');
            }
        }
    }

    public function view_apply_list($id = "") {

      
        $userid = $this->session->userdata('aileenuser');
      
     
       //  $contition_array = array('post_id' => $id, 'is_delete' => 0);
       //  $postdata = $this->data['postdata'] = $this->common->select_data_by_condition('job_apply', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
       // // echo '<pre>'; print_r($this->data['postdata']);
         $this->data['postid'] = $id;

        // foreach ($postdata as $ud) {

            //echo $ud['user_id']."hh";

 $join_str = array(
    array(
        'join_type' => 'left',
        'table' => 'job_add_edu',
        'join_table_id' => 'job_reg.user_id',
        'from_table_id' => 'job_add_edu.user_id'),
                 
    array(
        'join_type' => '',
        'table' => 'job_apply',
        'join_table_id' => 'job_reg.user_id',
        'from_table_id' => 'job_apply.user_id'),
   
); 
      $contition_array = array('job_apply.post_id' => $id, 'job_apply.is_delete' =>'0' ,'job_reg.job_step' => 10);

      
       $userdata = $this->data['user_data'] =  $this->common->select_data_by_condition('job_reg', $contition_array, $data = 'job_reg.*,job_add_edu.*,job_reg.user_id as userid', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str , $groupby = 'job_id');
      //echo "<pre>"; print_r($this->data['user_data']);die();

           


       // code for search
         $contition_array = array('status' => '1', 'is_delete' => '0' ,'job_step' => 10);


        $recdata = $this->data['results'] = $this->common->select_data_by_condition('job_reg', $contition_array, $data = 'other_skill,designation', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby='');

        $contition_array = array('status' => '1');

        $jobdata = $this->data['results'] = $this->common->select_data_by_condition('job_add_workexp', $contition_array, $data = 'jobtitle', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby='');


        $contition_array = array('status' => '1');

        $degreedata = $this->data['results'] = $this->common->select_data_by_condition('degree', $contition_array, $data = 'degree_name', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby='');


        $contition_array = array('status' => '1');

        $streamdata = $this->data['results'] = $this->common->select_data_by_condition('stream', $contition_array, $data = 'stream_name', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby='');


        $contition_array = array('status' => '1', 'type' => '1');

        $skill = $this->data['results'] = $this->common->select_data_by_condition('skill', $contition_array, $data = 'skill', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby='');
        // echo "<pre>"; print_r($artpost);die();


        $uni = array_merge($recdata, $jobdata, $degreedata, $streamdata, $skill);
        //   echo count($unique);


        foreach ($uni as $key => $value) {
            foreach ($value as $ke => $val) {
                if ($val != "") {


                    $result[] = $val;
                }
            }
        }
        foreach ($result as $key => $value) {
            $result1[$key]['label'] = $value;
            $result1[$key]['value'] = $value;
        }


        $this->data['demo'] = array_values($result1);

           $contition_array = array('status' => '1');

       
        $cty = $this->data['cty'] = $this->common->select_data_by_condition('cities', $contition_array, $data = 'city_name', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);
           

            foreach ($cty as $key => $value) {
            foreach ($value as $ke => $val) {
                if ($val != "") {


                    $resu[] = $val;
                }
            }
        }
        $resul = array_unique($resu);
        foreach ($resul as $key => $value) {
            $res[$key]['label'] = $value;
            $res[$key]['value'] = $value;
        }
        
        $this->data['de'] = array_values($res);




        $this->load->view('recruiter/view_apply_list', $this->data);
    }

//invite user  at home page click on applied person controller Start
    public function save_user($appid = " ", $status = "", $postid = ""){
        $userid = $this->session->userdata('aileenuser');

         //if user deactive profile then redirect to recruiter/index untill active profile start
         $contition_array = array('user_id'=> $userid,'re_status' => '0','is_delete'=> '0');

        $recruiter_deactive = $this->data['recruiter_deactive'] = $this->common->select_data_by_condition('recruiter', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);

        if( $recruiter_deactive)
        {
             redirect('recruiter/');
        }
     //if user deactive profile then redirect to recruiter/index untill active profile End

        $postdata = $this->common->select_data_by_id('rec_post', 'post_id', $id, $data = '*', $join_str = array());
        $userdata = $this->common->select_data_by_id('user', 'user_id', $userid, $data = '*', $join_str = array());
        $jobdata = $this->common->select_data_by_id('job_apply', 'app_id', $appid, $data = '*', $join_str = array());

        $data = array(
            'status' => $status,
            'modify_date' => date('y-m-d h:i:s')
        );
          
        $updatedata = $this->common->update_data($data, 'job_apply', 'app_id', $appid);

        // insert notification

        $data = array(
            'not_type' => 4,
            'not_from_id' => $userid,
            'not_to_id' => $status,
            'not_read' => 2,
            'not_from' => 1,
            'not_product_id' => $appid,
             "not_active" => 1,
            'not_created_date' => date('y-m-d h:i:s'),
        );

        $insert_id = $this->common->insert_data_getid($data, 'notification');
        // end notoification

        $msg = '<h1>Interview call from recruiter</h1><br/>';
        $msg .= 'Hey !' . $userdata[0]['first_name'] . $userdata[0]['last_name'] . ',';
        $msg .= "you are selected for the interview. please come for interview on dae as per mention in post";

        $msg .= "<br><b>key skill           :</b>" . $postdata[0]['post_skill'];
        if ($postdata[0]['month'] == 0 && $postdata[0]['year'] != 0) {
            $msg .= "<br><b>Experience|CTC      : minimum</b>" . $postdata[0]['year'] . "year";
        } elseif ($postdata[0]['year'] == 0 && $postdata[0]['month'] != 0) {
            $msg .= "<br><b>Experience|CTC      : minimum</b>" . $postdata[0]['month'] . "month";
        } else {
            $msg .= "<br><b>Experience|CTC      : minimum</b>" . $postdata[0]['month'] . "month " . $postdata[0]['year'] . "year ";
        }
        $msg .= "<br><b>Prefered location   :</b>" . $postdata[0]['post_location'];
        $subject = "call for an Interview";

        redirect('recruiter/view_apply_list/' . $postid, 'refresh');
    }

//invite user  at home page click on applied person controller Start

    public function edit_post($id = "") {

        $userid = $this->session->userdata('aileenuser');

         //if user deactive profile then redirect to recruiter/index untill active profile start
         $contition_array = array('user_id'=> $userid,'re_status' => '0','is_delete'=> '0');

        $recruiter_deactive = $this->data['recruiter_deactive'] = $this->common->select_data_by_condition('recruiter', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);

        if( $recruiter_deactive)
        {
             redirect('recruiter/');
        }
     //if user deactive profile then redirect to recruiter/index untill active profile End

        $contition_array = array('status' => '1', 'type' => '1');
        $this->data['skill'] = $this->common->select_data_by_condition('skill', $contition_array, $data = '*', $sortby = 'skill', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        $contition_array = array('status' => '1');
        $this->data['countries'] = $this->common->select_data_by_condition('countries', $contition_array, $data = '*', $sortby = 'country_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');
       // echo "<pre>"; print_r($this->data['countries']);die();
          $contition_array = array('status' => 1);
        $this->data['currency'] = $this->common->select_data_by_condition('currency', $contition_array, $data = '*', $sortby = 'currency_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');

 $postdatas=$this->data['postdata'] = $this->common->select_data_by_id('rec_post', 'post_id', $id, $data = '*', $join_str = array());
 //echo "<pre>"; print_r($postdata);die();

        //for getting state data
        $contition_array = array('status' => 1,'country_id' => $postdatas[0]['country']);
        $this->data['states'] = $this->common->select_data_by_condition('states', $contition_array, $data = '*', $sortby = 'state_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        //for getting city data
        $contition_array = array('status' => 1,'state_id'=> $postdatas[0]['state']);
         $this->data['cities'] = $this->common->select_data_by_condition('cities', $contition_array, $data = '*', $sortby = 'city_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');
        //echo "<pre>"; print_r($this->data['cities']); echo "</pre>";die();


   
       //  echo date('d/m/Y',strtotime($post[0]['post_last_date'])); 
//echo '<pre>'; print_r($this->data['postdata']); die();
        $skildata = explode(',', $this->data['postdata'][0]['post_skill']);
        $this->data['selectdata'] = $skildata;

 $this->data['country1'] = $this->data['postdata'][0]['country'];
        $this->data['city1'] = $this->data['postdata'][0]['city'];
        

        // code for search 
$contition_array = array('status' => '1', 'is_delete' => '0' ,'job_step' => 10);


        $recdata = $this->data['results'] = $this->common->select_data_by_condition('job_reg', $contition_array, $data = 'other_skill,designation', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby='');

        $contition_array = array('status' => '1');

        $jobdata = $this->data['results'] = $this->common->select_data_by_condition('job_add_workexp', $contition_array, $data = 'jobtitle', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby='');


        $contition_array = array('status' => '1');

        $degreedata = $this->data['results'] = $this->common->select_data_by_condition('degree', $contition_array, $data = 'degree_name', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby='');


        $contition_array = array('status' => '1');

        $streamdata = $this->data['results'] = $this->common->select_data_by_condition('stream', $contition_array, $data = 'stream_name', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby='');


        $contition_array = array('status' => '1', 'type' => '1');

        $skill = $this->data['results'] = $this->common->select_data_by_condition('skill', $contition_array, $data = 'skill', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby='');
        // echo "<pre>"; print_r($artpost);die();


        $uni = array_merge($recdata, $jobdata, $degreedata, $streamdata, $skill);
        //   echo count($unique);


        foreach ($uni as $key => $value) {
            foreach ($value as $ke => $val) {
                if ($val != "") {


                    $result[] = $val;
                }
            }
        }
        foreach ($result as $key => $value) {
            $result1[$key]['label'] = $value;
            $result1[$key]['value'] = $value;
        }


        $this->data['demo'] = array_values($result1);

           $contition_array = array('status' => '1');

       
        $citiesss = $this->data['cty'] = $this->common->select_data_by_condition('cities', $contition_array, $data = 'city_name', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);
           

          foreach($citiesss as $key){
    $location[]=$key['city_name'];
   }

 //          foreach ($location_list as $key1 => $value1) {
 //              foreach ($value1 as $ke1 => $val1) {
 //                 $location[] = $val1;
 //              }
 //          }
 //          //echo "<pre>"; print_r($location);die();
          foreach ($location as $key => $value) {
              $loc[$key]['label'] =$value;
              $loc[$key]['value'] =$value;
          }
         
 // //echo "<pre>"; print_r($loc);die();

        //$this->data['city_data']= array_values($loc);
        $this->data['de'] = $loc;


        

        $this->load->view('recruiter/edit_post', $this->data);
    }

    public function update_post($id = "") { //echo '<pre>'; print_r($_POST); die();
        $skill = $this->input->post('skills');
//echo $skill; die();
          $bod = $this->input->post('last_date');
                $bod = str_replace('/', '-', $bod);

        $userid = $this->session->userdata('aileenuser');

         //if user deactive profile then redirect to recruiter/index untill active profile start
         $contition_array = array('user_id'=> $userid,'re_status' => '0','is_delete'=> '0');

        $recruiter_deactive = $this->data['recruiter_deactive'] = $this->common->select_data_by_condition('recruiter', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);

        if( $recruiter_deactive)
        {
             redirect('recruiter/');
        }
     //if user deactive profile then redirect to recruiter/index untill active profile End
        //$skill=$this->input->post('skills');
        $this->form_validation->set_rules('post_name', 'Post Name', 'required');
        // $this->form_validation->set_rules('skills', 'Skils Name', 'required');
        //$this->form_validation->set_rules('month', 'Month', 'required');
        //$this->form_validation->set_rules('interview', ' Interview', 'required');
        //$this->form_validation->set_rules('position', ' Position', 'required');
        $this->form_validation->set_rules('post_desc', ' Description', 'required');
        //$this->form_validation->set_rules('last_date', 'Last date', 'required');
        $this->form_validation->set_rules('country', 'Country', 'required');
        $this->form_validation->set_rules('state', 'State', 'required');
        $this->form_validation->set_rules('city', 'City', 'required');
        $this->form_validation->set_rules('currency', 'Currency', 'required');

        // $this->form_validation->set_rules('minsal', 'location', 'regex_match[/^[0-9,]+$/]');
        // $this->form_validation->set_rules('maxsal', 'location', 'regex_match[/^[0-9,]+$/]');
        //  $this->form_validation->set_rules('maxmonth', 'Max month', 'required');
        // $this->form_validation->set_rules('minyear', ' Max year', 'required');
        //$this->form_validation->set_rules('minmonth', ' Min month', 'required');
        // $this->form_validation->set_rules('maxyear', ' Min year', 'required');
        // if ($this->form_validation->run() == FALSE) { 
        //        $this->data['postdata'] = $this->common->select_data_by_id('rec_post','post_id', $id, $data = '*', $join_str = array());
        //         //$this->load->view('recruiter/edit_post' , $this->data);
        //         } 
        //         else{ 
        $data = array(
            'post_name' => trim($this->input->post('post_name')),
            'post_description' => trim($this->input->post('post_desc')),
            'post_skill' => implode(",", $skill),
            'post_position' => trim($this->input->post('position')),
             'post_last_date' => date('Y-m-d', strtotime($bod)),
            'country' => $this->input->post('country'),
            'state' => $this->input->post('state'),
            'city' => $this->input->post('city'),
            'min_month' => $this->input->post('minmonth'),
            'min_year' => $this->input->post('minyear'),
            'max_month' => $this->input->post('maxmonth'),
            'max_year' => $this->input->post('maxyear'),
            'interview_process' => trim($this->input->post('interview')),
            'fresher' => $this->input->post('fresher'),
            'min_sal' => trim($this->input->post('minsal')),
            'max_sal' => trim($this->input->post('maxsal')),
                'other_skill' => $this->input->post('other_skill'),
            
                'post_currency' => $this->input->post('currency'),
            
            'modify_date' => date('y-m-d h:i:s')
        );

        //echo "<pre>"; print_r($data); die(); 
        $update = $this->common->update_data($data, 'rec_post', 'post_id', $id);

        if ($update) {
            $this->session->set_flashdata('success', 'your post updated successfully');
            redirect('recruiter/rec_post', 'refresh');
        } else {
            $this->session->flashdata('error', 'Sorry!! Your data not inserted');
            redirect('recruiter', 'refresh');
        }
        // }
        $this->data['postdata'] = $this->common->select_data_by_id('rec_post', 'post_id', $id, $data = '*', $join_str = array());
        $this->load->view('recruiter/edit_post', $this->data);
    }

    public function rec_profile($id="") {

        $this->data['userid'] = $userid = $this->session->userdata('aileenuser');

         //if user deactive profile then redirect to recruiter/index untill active profile start
         $contition_array = array('user_id'=> $userid,'re_status' => '0','is_delete'=> '0');

        $recruiter_deactive = $this->data['recruiter_deactive'] = $this->common->select_data_by_condition('recruiter', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);

        if( $recruiter_deactive)
        {
             redirect('recruiter/');
        }
     //if user deactive profile then redirect to recruiter/index untill active profile End

        if ($id == $userid || $id == '') {
            $this->data['recdata'] = $this->common->select_data_by_id('recruiter', 'user_id', $userid, $data = '*', $join_str = array());
        } else {
            $this->data['recdata'] = $this->common->select_data_by_id('recruiter', 'user_id', $id, $data = '*', $join_str = array());
        }
//echo '<pre>'; print_r( $this->data['recdata']); die();

        $contition_array = array('status' => '1', 'is_delete' => '0' ,'job_step' => 10);


        $recdata = $this->data['results'] = $this->common->select_data_by_condition('job_reg', $contition_array, $data = 'other_skill,designation', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);

        $contition_array = array('status' => '1');

        $jobdata = $this->data['results'] = $this->common->select_data_by_condition('job_add_workexp', $contition_array, $data = 'jobtitle', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);


        $contition_array = array('status' => '1');

        $degreedata = $this->data['results'] = $this->common->select_data_by_condition('degree', $contition_array, $data = 'degree_name', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);


        $contition_array = array('status' => '1');

        $streamdata = $this->data['results'] = $this->common->select_data_by_condition('stream', $contition_array, $data = 'stream_name', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);


        $contition_array = array('status' => '1', 'type' => '1');

        $skill = $this->data['results'] = $this->common->select_data_by_condition('skill', $contition_array, $data = 'skill', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);
        // echo "<pre>"; print_r($artpost);die();


        $uni = array_merge($recdata, $jobdata, $degreedata, $streamdata, $skill);
        //   echo count($unique);


        foreach ($uni as $key => $value) {
            foreach ($value as $ke => $val) {
                if ($val != "") {


                    $result[] = $val;
                }
            }
        }
        foreach ($result as $key => $value) {
            $result1[$key]['label'] = $value;
            $result1[$key]['value'] = $value;
        }


        $this->data['demo'] = array_values($result1);

           $contition_array = array('status' => '1');

       
        $cty = $this->data['cty'] = $this->common->select_data_by_condition('cities', $contition_array, $data = 'city_name', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);
           

            foreach ($cty as $key => $value) {
            foreach ($value as $ke => $val) {
                if ($val != "") {


                    $resu[] = $val;
                }
            }
        }
        $resul = array_unique($resu);
        foreach ($resul as $key => $value) {
            $res[$key]['label'] = $value;
            $res[$key]['value'] = $value;
        }
        
        $this->data['de'] = array_values($res);









        $this->load->view('recruiter/rec_profile', $this->data);
    }

//Save Candidate at seach save controller Start

    public function save_candidate() { //echo"hii";die();
        $userid = $this->session->userdata('aileenuser');

         //if user deactive profile then redirect to recruiter/index untill active profile start
         $contition_array = array('user_id'=> $userid,'re_status' => '0','is_delete'=> '0');

        $recruiter_deactive = $this->data['recruiter_deactive'] = $this->common->select_data_by_condition('recruiter', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);

        if( $recruiter_deactive)
        {
             redirect('recruiter/');
        }
     //if user deactive profile then redirect to recruiter/index untill active profile End
       // echo $userid;

        $this->data['recruiterdata'] = $this->common->select_data_by_id('recruiter', 'user_id', $userid, $data = '*', $join_str = array());
        //echo "<pre>";print_r($this->data['recruiterdata']);die();

       // <rash code 12-4 start>

        $join_str1 = array(array(
        'join_type' => 'left',
        'table' => 'job_add_edu',
        'join_table_id' => 'save.to_id',
        'from_table_id' => 'job_add_edu.user_id'),
    array(
        'join_type' => 'left',
        'table' => 'job_reg',
        'join_table_id' => 'save.to_id',
        'from_table_id' => 'job_reg.user_id'),
     array(
        'join_type' => 'left',
        'table' => 'job_graduation',
        'join_table_id' => 'save.to_id',
        'from_table_id' => 'job_graduation.user_id')

); 

  // <rash code 12-4 end>
        $contition_array1= array('save.from_id' => $userid, 'save.status' => 0, 'save.save_type' => 1);
        $this->data['recdata'] = $this->common->select_data_by_condition('save', $contition_array1, $data = 'job_reg.*,job_reg.user_id as userid,job_add_edu.*,job_graduation.*,save.*', $sortby = 'save_id', $orderby = 'desc', $limit = '', $offset = '', $join_str1, $groupby ='');

     //   echo"<pre>"; print_r($this->data['recdata']); die();


        $contition_array = array('status' => '1', 'is_delete' => '0','job_step' => 10);


        $recdata = $this->data['results'] = $this->common->select_data_by_condition('job_reg', $contition_array, $data = 'other_skill,designation', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby='');

        $contition_array = array('status' => '1');

        $jobdata = $this->data['results'] = $this->common->select_data_by_condition('job_add_workexp', $contition_array, $data = 'jobtitle', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);


        $contition_array = array('status' => '1');

        $degreedata = $this->data['results'] = $this->common->select_data_by_condition('degree', $contition_array, $data = 'degree_name', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);


        $contition_array = array('status' => '1');

        $streamdata = $this->data['results'] = $this->common->select_data_by_condition('stream', $contition_array, $data = 'stream_name', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);


        $contition_array = array('status' => '1', 'type' => '1');

        $skill = $this->data['results'] = $this->common->select_data_by_condition('skill', $contition_array, $data = 'skill', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);
        // echo "<pre>"; print_r($artpost);die();


        $uni = array_merge($recdata, $jobdata, $degreedata, $streamdata, $skill);
        //   echo count($unique);


        foreach ($uni as $key => $value) {
            foreach ($value as $ke => $val) {
                if ($val != "") {


                    $result[] = $val;
                }
            }
        }
        foreach ($result as $key => $value) {
            $result1[$key]['label'] = $value;
            $result1[$key]['value'] = $value;
        }


        $this->data['demo'] = array_values($result1);

           $contition_array = array('status' => '1');

       
        $cty = $this->data['cty'] = $this->common->select_data_by_condition('cities', $contition_array, $data = 'city_name', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);
           

            foreach ($cty as $key => $value) {
            foreach ($value as $ke => $val) {
                if ($val != "") {


                    $resu[] = $val;
                }
            }
        }
        $resul = array_unique($resu);
        foreach ($resul as $key => $value) {
            $res[$key]['label'] = $value;
            $res[$key]['value'] = $value;
        }
        
        $this->data['de'] = array_values($res);

        //echo "<pre>";print_r($this->data['recdata']);die();
        $this->load->view('recruiter/saved_candidate', $this->data);
    }

//Save Candidate at seach save controller End


    public function user_image_insert() {
     //echo "hii";die();
        $userid = $this->session->userdata('aileenuser');

         //if user deactive profile then redirect to recruiter/index untill active profile start
         $contition_array = array('user_id'=> $userid,'re_status' => '0','is_delete'=> '0');

        $recruiter_deactive = $this->data['recruiter_deactive'] = $this->common->select_data_by_condition('recruiter', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);

        if( $recruiter_deactive)
        {
             redirect('recruiter/');
        }
     //if user deactive profile then redirect to recruiter/index untill active profile End


        if ($this->input->post('cancel1')) {  //echo "hii"; die();
            redirect('recruiter/rec_post', refresh);
        } elseif ($this->input->post('cancel2')) {
            redirect('recruiter/rec_profile', refresh);
        } elseif ($this->input->post('cancel3')) {
            redirect('recruiter/save_candidate', refresh);
        } elseif ($this->input->post('cancel4')) {
            redirect('recruiter/add_post', refresh);
        }

        if (empty($_FILES['profilepic']['name'])) { 
            //echo"hello"; die();
            $this->form_validation->set_rules('profilepic', 'Upload profilepic', 'required');
            //$picture = '';
        } else {
       // // echo "hii";die();
       //      $config['upload_path'] = 'uploads/user_image/';
       //      $config['allowed_types'] = 'jpg|jpeg|png|gif|mp4|3gp|mpeg|mpg|mpe|qt|mov|avi|pdf';
       //      // $config['file_name'] = $_FILES['picture']['name'];
       //      $config['file_name'] = $_FILES['profilepic']['name'];
       //      //$config['max_size'] = '1000000000000000';
       //      //Load upload library and initialize configuration
       //      $this->load->library('upload', $config);
       //      $this->upload->initialize($config);

       //      if ($this->upload->do_upload('profilepic')) {
       //         // echo "h";die();

       //          $uploadData = $this->upload->data();
       //          //$picture = $uploadData['file_name']."-".date("Y_m_d H:i:s");
       //          $picture = $uploadData['file_name'];
       //      } else {
       //          //echo "hii";die();
       //          $picture = '';
       //      }

              $recruiter_image = '';
            $recruiter['upload_path'] = $this->config->item('rec_profile_main_upload_path');
            $recruiter['allowed_types'] = $this->config->item('rec_profile_main_allowed_types');
            $recruiter['max_size'] = $this->config->item('rec_profile_main_max_size');
            $recruiter['max_width'] = $this->config->item('rec_profile_main_max_width');
            $recruiter['max_height'] = $this->config->item('rec_profile_main_max_height');
            $this->load->library('upload');
            $this->upload->initialize($recruiter);
            //Uploading Image
            $this->upload->do_upload('profilepic');
            //Getting Uploaded Image File Data
            $imgdata = $this->upload->data();
            $imgerror = $this->upload->display_errors();
            if ($imgerror == '') {
                //Configuring Thumbnail 
                $recruiter_thumb['image_library'] = 'gd2';
                $recruiter_thumb['source_image'] = $recruiter['upload_path'] . $imgdata['file_name'];
                $recruiter_thumb['new_image'] = $this->config->item('rec_profile_thumb_upload_path') . $imgdata['file_name'];
                $recruiter_thumb['create_thumb'] = TRUE;
                $recruiter_thumb['maintain_ratio'] = TRUE;
                $recruiter_thumb['thumb_marker'] = '';
                $recruiter_thumb['width'] = $this->config->item('rec_profile_thumb_width');
                //$user_thumb['height'] = $this->config->item('user_thumb_height');
                $recruiter_thumb['height'] = 2;
                $recruiter_thumb['master_dim'] = 'width';
                $recruiter_thumb['quality'] = "100%";
                $recruiter_thumb['x_axis'] = '0';
                $recruiter_thumb['y_axis'] = '0';
                //Loading Image Library
                $this->load->library('image_lib', $recruiter_thumb);
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
        $recruiter_reg_data = $this->common->select_data_by_condition('recruiter', $contition_array, $data = 'recruiter_user_image', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        $recruiter_reg_prev_image = $recruiter_reg_data[0]['recruiter_user_image'];
        

            if ($recruiter_reg_prev_image != '') {
            $recruiter_image_main_path = $this->config->item('rec_profile_main_upload_path');
            $recruiter_bg_full_image = $recruiter_image_main_path . $recruiter_reg_prev_image;
            if (isset($recruiter_bg_full_image)) {
                unlink($recruiter_bg_full_image);
            }
            
            $recruiter_image_thumb_path = $this->config->item('rec_profile_thumb_upload_path');
            $recruiter_bg_thumb_image = $recruiter_image_thumb_path . $recruiter_reg_prev_image;
            if (isset($recruiter_bg_thumb_image)) {
                unlink($recruiter_bg_thumb_image);
            }


        }

                $recruiter_image = $imgdata['file_name'];
            }


            $data = array(
                'recruiter_user_image' => $recruiter_image,
                'modify_date' => date('Y-m-d', time())
            );
            //echo "<pre>"; print_r($data);die();

            $updatdata = $this->common->update_data($data, 'recruiter', 'user_id', $userid);

            if ($updatdata) {
                if ($this->input->post('hitext') == 1) {// echo "success";die();
                    redirect('recruiter/rec_post', refresh);
                } elseif ($this->input->post('hitext') == 2) {

                    redirect('recruiter/rec_profile', refresh);
                } elseif ($this->input->post('hitext') == 3) {
                    redirect('recruiter/save_candidate', refresh);
                } elseif ($this->input->post('hitext') == 4) {
                    redirect('recruiter/add_post', refresh);
                }
            } else {
                $this->session->flashdata('error', 'Your data not inserted');
                redirect('recruiter/rec_post', refresh);
            }
        }
    }

    public function remove_post() {

        $postid = $_POST['post_id'];
        $data = array(
            'is_delete' => 1,
            'modify_date' => date('y-m-d h:i:s')
        );

        $updatedata = $this->common->update_data($data, 'rec_post', 'post_id', $postid);
    }

//Remove Save candidate by search controller start
    public function remove_candidate($saveid) {
//echo $saveid;die();

        $saveid = $_POST['save_id'];

        $userid = $this->session->userdata('aileenuser');

         //if user deactive profile then redirect to recruiter/index untill active profile start
         $contition_array = array('user_id'=> $userid,'re_status' => '0','is_delete'=> '0');

        $recruiter_deactive = $this->data['recruiter_deactive'] = $this->common->select_data_by_condition('recruiter', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);

        if( $recruiter_deactive)
        {
             redirect('recruiter/');
        }
     //if user deactive profile then redirect to recruiter/index untill active profile End
        // echo $userid;echo $id;die();


        $data = array(
            'status' => 1
        );

        $updatedata = $this->common->update_data($data, 'save', 'save_id', $saveid);
    }

//Remove Save candidate by search controller End
//keyskill automatic retrieve cobtroller start
    public function keyskill() {
        $json = [];
        $where = "status='1'";

        //$this->load->database('aileensoul');

        if (!empty($this->input->get("q"))) {
            $this->db->like('skill', $this->input->get("q"));
            $query = $this->db->select('skill_id as id,skill as text')
                    ->where($where)
                    ->limit(10)
                    ->get("skill");
            $json = $query->result();
        }


        echo json_encode($json);
    }

//keyskill automatic retrieve cobtroller End
//location automatic retrieve cobtroller start
    public function location() {
        $json = [];

        //$this->load->database('aileensoul');

        if (!empty($this->input->get("q"))) {
            $this->db->like('city_name', $this->input->get("q"));
            $query = $this->db->select('city_id as id,city_name as text')
                    ->order_by("city_name", "asc")
                    ->limit(10)
                    ->get("cities");
            $json = $query->result();
        }


        echo json_encode($json);
    }

//location automatic retrieve cobtroller End
//deactivate user start
    public function deactivate() {
        //echo "hii";die();

        $id = $_POST['id'];
        $data = array(
            're_status' => 0
        );
        //echo "<pre>"; print_r($data); die(); 
        $update = $this->common->update_data($data, 'recruiter', 'user_id', $id);

        // if ($update) {

        //     // $this->session->unset_userdata('aileenuser');
        //     $this->session->set_flashdata('success', 'You are deactivate successfully.');
        //     redirect('dashboard', 'refresh');
        // } else {
        //     $this->session->flashdata('error', 'Sorry!! Your are not deactivate!!');
        //     redirect('recruiter', 'refresh');
        // }
    }

// deactivate user end



//save search user controller start
    public function save_search_user($id, $save_id) { //echo $id; echo $save_id; die();
        $id = $_POST['user_id'];

       // echo $id; die();
        $save_id = $_POST['save_id'];

        $userid = $this->session->userdata('aileenuser');

         //if user deactive profile then redirect to recruiter/index untill active profile start
         $contition_array = array('user_id'=> $userid,'re_status' => '0','is_delete'=> '0');

        $recruiter_deactive = $this->data['recruiter_deactive'] = $this->common->select_data_by_condition('recruiter', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);

        if( $recruiter_deactive)
        {
             redirect('recruiter/');
        }
     //if user deactive profile then redirect to recruiter/index untill active profile End
        //echo $id;die();
        $contition_array = array('from_id' => $userid, 'to_id' => $id, 'save_id' => $save_id);
        $userdata = $this->common->select_data_by_condition('save', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
        //echo "<pre>";print_r($userdata);die();

        if ($userdata) {
            $data = array(
                'status' => 0,
                'modify_date' =>date('Y-m-d H:i:s')
            );


            $updatedata = $this->common->update_data($data, 'save', 'save_id', $save_id);

            if ($updatedata) {

                $saveuser = 'Saved';
                echo $saveuser;
            }
        } else {


        $contition_array = array('from_id' => $userid, 'to_id' => $id, 'status' => 0, 'save_type' => 1);
        $user_data = $this->common->select_data_by_condition('save', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
        if($user_data){

            if ($user_data) {

                $saveuser = 'Saved';
                echo $saveuser;
            }
        }else{

            $data = array(
                'from_id' => $userid,
                'to_id' => $id,
                'status' => 0,
                'save_type' => 1,
                'created_date'=>date('Y-m-d H:i:s'),
                'modify_date' =>date('Y-m-d H:i:s')
            );

            $insert_id = $this->common->insert_data($data, 'save');


            if ($insert_id) {

                $saveuser = 'Saved';
                echo $saveuser;
            }
          }
        }
    }

    public function image_upload_ajax() {

        include 'db.php';

        session_start();
//$session_uid='1'; // $_SESSION['user_id'];

        $session_uid = $this->session->userdata('aileenuser');
//include 'userUpdates.php'; 
//$userUpdates = new userUpdates($db);

        include_once 'getExtension.php';

        $valid_formats = array("jpg", "png", "gif", "bmp", "jpeg", "PNG", "JPG", "JPEG", "GIF", "BMP");
        if (isset($_POST) && $_SERVER['REQUEST_METHOD'] == "POST" && isset($session_uid)) {
            $name = $_FILES['photoimg']['name'];
            $size = $_FILES['photoimg']['size'];

            if ($name) {
                $ext = $this->common->getExtension($name);
                if (in_array($ext, $valid_formats)) {
                    if ($size < (1024 * 1024)) {
                        $actual_image_name = time() . $session_uid . "." . $ext;
                        $tmp = $_FILES['photoimg']['tmp_name'];
                        $bgSave = '<div id="uX' . $session_uid . '" class="bgSave wallbutton blackButton">Save Cover</div>';

//alert($bgSave);
// khyati start
//echo "hii";die();
                        $config['upload_path'] = 'uploads/user_image/';
                        $config['allowed_types'] = 'jpg|jpeg|png|gif|mp4|3gp|mpeg|mpg|mpe|qt|mov|avi|pdf';
                        // $config['file_name'] = $_FILES['picture']['name'];
                        $config['file_name'] = $_FILES['photoimg']['name'];
                        //$config['max_size'] = '1000000000000000';
                        //Load upload library and initialize configuration
                        $this->load->library('upload', $config);
                        $this->upload->initialize($config);

                        if ($this->upload->do_upload('photoimg')) {//echo "shjd"; die();
                            $uploadData = $this->upload->data();
                            //$picture = $uploadData['file_name']."-".date("Y_m_d H:i:s");
                            $picture = $uploadData['file_name'];
                        } else {
                            $picture = '';
                        }


                        $data = array(
                            'profile_background' => $picture
                        );

                        $update = $this->common->update_data($data, 'recruiter', 'user_id', $session_uid);
                        if ($update) {
                            $path = base_url('uploads/user_image/');
                            echo $bgSave . '<img src="' . $path . $picture . '"  id="timelineBGload" class="headerimage ui-corner-all" style="top:0px"/>';
                        } else {
                            echo "Fail upload folder with read access.";
                        }
                    } else
                        echo "Image file size max 1 MB";
                } else
                    echo "Invalid file format.";
            } //echo "no"; die();
            else
                echo "Please select image..!";

            exit;
        }
    }

    public function image_saveBG_ajax() {

        // include 'db.php';

        session_start();
//$session_uid='1'; // $_SESSION['user_id'];
        $session_uid = $this->session->userdata('aileenuser');
//include 'userUpdates.php';
//$userUpdates = new userUpdates($db);
        if (isset($_POST['position']) && isset($session_uid)) {

            $position = $_POST['position'];
//$data=$userUpdates->userBackgroundPositionUpdate($session_uid,$position);

            $data = array(
                'profile_background_position' => $position
            );

            $update = $this->common->update_data($data, 'recruiter', 'user_id', $session_uid);
            if ($update) {

                echo $position;
            }
        }
    }

    // khyati change end 15 2 
// public function rec_recommended(){
//   $this->load->view('recruiter/rec_post' , $this->data);
// } 
//enter designation start

    public function recruiter_designation() {  //echo "hello"; die();
        $userid = $this->session->userdata('aileenuser');

         //if user deactive profile then redirect to recruiter/index untill active profile start
         $contition_array = array('user_id'=> $userid,'re_status' => '0','is_delete'=> '0');

        $recruiter_deactive = $this->data['recruiter_deactive'] = $this->common->select_data_by_condition('recruiter', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);

        if( $recruiter_deactive)
        {
             redirect('recruiter/');
        }
     //if user deactive profile then redirect to recruiter/index untill active profile End

        //echo  $this->input->post('designation'); die();

        $this->form_validation->set_rules('designation', 'Designation', 'required');


        if ($this->form_validation->run() == FALSE) {
            $this->load->view('recruiter/rec_post');
        } else { //echo "hello1"; die();
            $data = array(
                'designation' => $this->input->post('designation'),
                'modify_date' => date('Y-m-d', time())
            );
            //echo "<pre>"; print_r($data); die();

            $updatdata = $this->common->update_data($data, 'recruiter', 'user_id', $userid);
//       //echo $updatedata;die();

            if ($updatdata) {

                if ($this->input->post('hitext') == 1) { //echo "success";die();
                    redirect('recruiter/rec_post', refresh);
                } elseif ($this->input->post('hitext') == 2) {
                    redirect('recruiter/rec_profile', refresh);
                } elseif ($this->input->post('hitext') == 3) {
                    redirect('recruiter/add_post', refresh);
                } elseif ($this->input->post('hitext') == 4) {
                    redirect('recruiter/save_candidate', refresh);
                }
            } else {
                $this->session->flashdata('error', 'Your data not inserted');
                redirect('artistic/art_post', refresh);
            }
        }
    }

//designation end


    function abc() {
        $this->load->view('recruiter/abc');
    }




    public function recommen_candidate() {

        $userid = $this->session->userdata('aileenuser');

         //if user deactive profile then redirect to recruiter/index untill active profile start
         $contition_array = array('user_id'=> $userid,'re_status' => '0','is_delete'=> '0');

        $recruiter_deactive = $this->data['recruiter_deactive'] = $this->common->select_data_by_condition('recruiter', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);

        if( $recruiter_deactive)
        {
             redirect('recruiter/');
        }
     //if user deactive profile then redirect to recruiter/index untill active profile End
       // echo $userid;

        $contition_array = array('user_id' => $userid, 'is_delete' => 0, 'status' => 1);
        $recruiterdata = $this->data['recruiterdata'] = $this->common->select_data_by_condition('rec_post', $contition_array, $data = '*', $sortby = '', $orderby = 'DESC', $limit = '', $offset = '', $join_str = array(), $groupby = '');
    
        $contition_array = array('user_id' => $userid, 'is_delete' => 0, 're_status' => 1);
         $this->data['recruiterdata1'] = $this->common->select_data_by_condition('recruiter', $contition_array, $data = '*', $sortby = '', $orderby = 'DESC', $limit = '', $offset = '', $join_str = array(), $groupby = '');


           $contition_array = array('user_id' => $userid,'type' => '4','status' => 1);

      $skillotherdata =  $this->data['skillotherdata'] = $this->common->select_data_by_condition('skill', $contition_array, $data = '*', $sortby = '', $orderby = 'DESC', $limit = '', $offset = '', $join_str = array(), $groupby = '');
// echo "<pre>";
// print_r($skillotherdata); die();       
         $contition_array = array('job_reg.user_id !=' => $userid,'job_step' => 10);

    
        $candidate = $this->data['candidate'] = $this->common->select_data_by_condition('job_reg', $contition_array, $data = 'keyskill,job_id,user_id', $sortby = '', $orderby = 'desc', $limit = '', $offset = '', $join_str = array(), $groupby = '');

         foreach($skillotherdata as $othrd){


    //echo "<pre>"; print_r($othrd['skill']);
        if ($othrd['skill'] != '') {
            
        $contition_array1 = array('type'=>'3','FIND_IN_SET("'.$othrd['skill'].'",skill)!='=>'0'); 
 // echo "<pre>"; print_r($contition_array1); 


        $candidate1[] = $this->data['candidate1'] = $this->common->select_data_by_condition('skill', $contition_array1, $data = '*', $sortby = '', $orderby = 'desc', $limit = '', $offset = '', $join_str = array(), $groupby = '');
     
        }
 
      }

     //  echo "<pre>"; print_r($candidate1); 
     // die();


   foreach ($candidate1 as $key => $candi) {

    foreach ($candi as $ke) {
        
         $join_str1 = array(
            array(
                'join_type' => 'left',
                'table' => 'job_add_edu',
                'join_table_id' => 'job_reg.user_id',
                'from_table_id' => 'job_add_edu.user_id'),
           
             array(
                'join_type' => 'left',
                'table' => 'job_graduation',
                'join_table_id' => 'job_reg.user_id',
                'from_table_id' => 'job_graduation.user_id')
        );

            $contition_array = array('job_reg.user_id' => $ke['user_id'], 'job_reg.is_delete' => 0, 'job_reg.status' => 1,'job_reg.job_step' => 10);


            $jobr11[] = $this->data['jobrec'] = $this->common->select_data_by_condition('job_reg', $contition_array, $data = 'job_reg.*,job_reg.user_id as iduser,job_add_edu.*,job_graduation.*', $sortby = 'job_id', $orderby = 'desc', $limit = '', $offset = '', $join_str1, $groupby = '');
    }       
          
}

//echo "<pre>"; print_r($jobr11);
  

              
       

       
          
          foreach($recruiterdata as $recruiter){


             $recskill = explode(',', $recruiter['post_skill']);

             $recskill = array_filter(array_map('trim', $recskill));

          foreach($candidate as $candi){

            $candiskill = explode(',', $candi['keyskill']);
             $candiskill = array_filter(array_map('trim', $candiskill));
  
             $result1 = array_intersect($recskill, $candiskill);


          if(count($result1) > 0){

            $join_str1 = array(
            array(
                'join_type' => 'left',
                'table' => 'job_add_edu',
                'join_table_id' => 'job_reg.user_id',
                'from_table_id' => 'job_add_edu.user_id'),
           
             array(
                'join_type' => 'left',
                'table' => 'job_graduation',
                'join_table_id' => 'job_reg.user_id',
                'from_table_id' => 'job_graduation.user_id')
        );

            $contition_array = array('job_reg.user_id' => $candi['user_id'], 'job_reg.is_delete' => 0, 'job_reg.status' => 1);


            $jobr[] = $this->data['jobrec'] = $this->common->select_data_by_condition('job_reg', $contition_array, $data = 'job_reg.*,job_reg.user_id as iduser,job_add_edu.*,job_graduation.*', $sortby = 'job_id', $orderby = 'desc', $limit = '', $offset = '', $join_str1, $groupby = '');
           
         
            }
           
          }

          }

          //echo "<pre>"; print_r($jobr);  die();

      if (count($jobr11) == 0) {
                
                $unique = $jobr;
                
            } 
            elseif (count($jobr) == 0) {
                $unique = $jobr11;
                
            }
            else {
                $unique = array_merge($jobr11, $jobr);
            }

// echo "<pre>";print_r($jobr);
// echo "<pre>";print_r($jobr11);

//die();

//               foreach ($unique as $ke => $arr) {
//                foreach ($arr as $va) {
        
    
//                     $skildataa[] = $va;
//                 }
//             }
// //echo "<pre>";print_r($postdata);
//                 $new = array();
//                 foreach ($skildataa as $value) {
//                     $new[$value['user_id']] = $value;
//                 }

             $new = array_unique($unique, SORT_REGULAR);
                 

    //echo "<pre>"; print_r($new); 

       // die();
      
        $this->data['candidatejob'] = $new;
      
//code for search

        $contition_array = array('status' => '1', 'user_id' => $userid);

        $edudata = $this->data['edudata'] = $this->common->select_data_by_condition('job_add_edu', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str, $groupby = '');


        $contition_array = array('status' => '1', 'is_delete' => '0');


        $recdata = $this->data['results'] = $this->common->select_data_by_condition('job_reg', $contition_array, $data = 'other_skill,designation', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);

        $contition_array = array('status' => '1');

        $jobdata = $this->data['results'] = $this->common->select_data_by_condition('job_add_workexp', $contition_array, $data = 'jobtitle', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);


        $contition_array = array('status' => '1');

        $degreedata = $this->data['results'] = $this->common->select_data_by_condition('degree', $contition_array, $data = 'degree_name', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);


        $contition_array = array('status' => '1');

        $streamdata = $this->data['results'] = $this->common->select_data_by_condition('stream', $contition_array, $data = 'stream_name', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);


        $contition_array = array('status' => '1', 'type' => '1');

        $skill = $this->data['results'] = $this->common->select_data_by_condition('skill', $contition_array, $data = 'skill', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);
        // echo "<pre>"; print_r($artpost);die();


        $uni = array_merge($recdata, $jobdata, $degreedata, $streamdata, $skill, $edudata);
        //   echo count($unique);


        foreach ($uni as $key => $value) {
            foreach ($value as $ke => $val) {
                if ($val != "") {
                    $result[] = $val;
                }
            }
        }
        foreach ($result as $key => $value) {
            $result1[$key]['label'] = $value;
            $result1[$key]['value'] = $value;
        }


        $this->data['demo'] = array_values($result1);

           $contition_array = array('status' => '1');

       
        $cty = $this->data['cty'] = $this->common->select_data_by_condition('cities', $contition_array, $data = 'city_name', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);
           

            foreach ($cty as $key => $value) {
            foreach ($value as $ke => $val) {
                if ($val != "") {


                    $resu[] = $val;
                }
            }
        }
        $resul = array_unique($resu);
        foreach ($resul as $key => $value) {
            $res[$key]['label'] = $value;
            $res[$key]['value'] = $value;
        }
        
        $this->data['de'] = array_values($res);



        $this->load->view('recruiter/recommen_candidate', $this->data);


        


    }

// cover pic controller

    public function ajaxpro() {
        $userid = $this->session->userdata('aileenuser');

         //if user deactive profile then redirect to recruiter/index untill active profile start
         $contition_array = array('user_id'=> $userid,'re_status' => '0','is_delete'=> '0');

        $recruiter_deactive = $this->data['recruiter_deactive'] = $this->common->select_data_by_condition('recruiter', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);

        if( $recruiter_deactive)
        {
             redirect('recruiter/');
        }
     //if user deactive profile then redirect to recruiter/index untill active profile End

       
        $contition_array = array('user_id' => $userid);
        $rec_reg_data = $this->common->select_data_by_condition('recruiter', $contition_array, $data = 'profile_background', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
 $rec_reg_prev_image = $rec_reg_data[0]['profile_background'];
        $rec_reg_prev_main_image = $rec_reg_data[0]['profile_background_main'];

        if ($rec_reg_prev_image != '') {
            $rec_image_main_path = $this->config->item('rec_bg_main_upload_path');
            $rec_bg_full_image = $rec_image_main_path . $rec_reg_prev_image;
            if (isset($rec_bg_full_image)) {
                unlink($rec_bg_full_image);
            }
            
            $rec_image_thumb_path = $this->config->item('rec_bg_thumb_upload_path');
            $rec_bg_thumb_image = $rec_image_thumb_path . $rec_reg_prev_image;
            if (isset($rec_bg_thumb_image)) {
                unlink($rec_bg_thumb_image);
            }
        }
        if ($rec_reg_prev_main_image != '') {
            $rec_image_original_path = $this->config->item('rec_bg_original_upload_path');
            $rec_bg_origin_image = $rec_image_original_path . $rec_reg_prev_main_image;
            if (isset($rec_bg_origin_image)) {
                unlink($rec_bg_origin_image);
            }
        }
        
        $data = $_POST['image'];


        $rec_bg_path = $this->config->item('rec_bg_main_upload_path');
        $imageName = time() . '.png';
        $base64string = $data;
        file_put_contents($rec_bg_path . $imageName, base64_decode(explode(',', $base64string)[1]));

        $rec_thumb_path = $this->config->item('rec_bg_thumb_upload_path');
        $rec_thumb_width = $this->config->item('rec_bg_thumb_width');
        $rec_thumb_height = $this->config->item('rec_bg_thumb_height');

        $upload_image = $rec_bg_path . $imageName;

        $thumb_image_uplode = $this->thumb_img_uplode($upload_image, $imageName, $rec_thumb_path, $rec_thumb_width, $rec_thumb_height);

        $data = array(
            'profile_background' => $imageName
        );

        $update = $this->common->update_data($data, 'recruiter', 'user_id', $userid);

        $this->data['recdata'] = $this->common->select_data_by_id('recruiter', 'user_id', $userid, $data = '*', $join_str = array());

        echo '<img src="' . $this->data['recdata'][0]['profile_background'] . '" />';
    }

    public function image() {
        $userid = $this->session->userdata('aileenuser');

         //if user deactive profile then redirect to recruiter/index untill active profile start
         $contition_array = array('user_id'=> $userid,'re_status' => '0','is_delete'=> '0');

        $recruiter_deactive = $this->data['recruiter_deactive'] = $this->common->select_data_by_condition('recruiter', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);

        if( $recruiter_deactive)
        {
             redirect('recruiter/');
        }
     //if user deactive profile then redirect to recruiter/index untill active profile End

       
        $config['upload_path'] = $this->config->item('rec_bg_original_upload_path');
        $config['allowed_types'] = $this->config->item('rec_bg_allowed_types');
        $config['file_name'] = $_FILES['image']['name'];

        //Load upload library and initialize configuration
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        //echo $this->upload->do_upload('photo'); die();
        if ($this->upload->do_upload('image')) {

            $uploadData = $this->upload->data();
            //$picture = $uploadData['file_name']."-".date("Y_m_d H:i:s");
            $image = $uploadData['file_name'];
            //echo $certificate;die();
        } else {
            // echo "welcome";die();
            $image = '';
        }


        $data = array(
            'profile_background_main' => $image,
            'modified_date' => date('Y-m-d h:i:s', time())
        );

        $updatedata = $this->common->update_data($data, 'recruiter', 'user_id', $userid);

        if ($updatedata) {
            echo $userid;
        } else {
            echo "welcome";
        }
    }

    // cover pic end
    //reactivate account start

    public function reactivate() {

        $userid = $this->session->userdata('aileenuser');

       
        $data = array(
            're_status' => 1,
            'modify_date' => date('y-m-d h:i:s')
        );

        $updatdata = $this->common->update_data($data, 'recruiter', 'user_id', $userid);
        if ($updatdata) {

            redirect('recruiter/recommen_candidate', refresh);
        } else {

            redirect('recruiter/reactivate', refresh);
        }
    }


public function ajax_designation() {
        $userid = $this->session->userdata('aileenuser');
         //if user deactive profile then redirect to recruiter/index untill active profile start
         $contition_array = array('user_id'=> $userid,'re_status' => '0','is_delete'=> '0');

        $recruiter_deactive = $this->data['recruiter_deactive'] = $this->common->select_data_by_condition('recruiter', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);

        if( $recruiter_deactive)
        {
             redirect('recruiter/');
        }
     //if user deactive profile then redirect to recruiter/index untill active profile End
        $data = array(
            'designation' => $_POST['designation']
        );
        $updatedata = $this->common->update_data($data, 'recruiter', 'user_id', $userid);
        if ($updatedata) {
            echo 'ok';
        } else {
            echo 'error';
        }
    }

    public function invite_user() {
        
         $postid = $_POST['post_id'];
         $invite_user = $_POST['invited_user']; 
         
        $userid = $this->session->userdata('aileenuser');

         //if user deactive profile then redirect to recruiter/index untill active profile start
         $contition_array = array('user_id'=> $userid,'re_status' => '0','is_delete'=> '0');

        $recruiter_deactive = $this->data['recruiter_deactive'] = $this->common->select_data_by_condition('recruiter', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);

        if( $recruiter_deactive)
        {
             redirect('recruiter/');
        }
     //if user deactive profile then redirect to recruiter/index untill active profile End
      
        $data = array(
            'user_id' => $userid,
            'post_id' => $postid,
            'invite_user_id' => $invite_user,
            'profile' => "recruiter"
            );
        $insert_id = $this->common->insert_data_getid($data, 'user_invite');
       
        if ($insert_id) {
            $data = array(
            'not_type' => 4,
            'not_from_id' => $userid,
            'not_to_id' => $invite_user,
            'not_read' => 2,
            'not_status' => 0,
            'not_product_id' => $insert_id,
            'not_from' => 1,
             "not_active" => 1, 
            'not_created_date' => date('y-m-d h:i:s'),
            );
        $insert_id = $this->common->insert_data_getid($data, 'notification');


        echo'invited';
        } else {
            echo 'error';
        }
    }
//reactivate accont end    


   
}
