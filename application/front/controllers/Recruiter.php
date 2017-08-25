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
        // DEACTIVATE PROFILE START  
        $userid = $this->session->userdata('aileenuser');

        // IF USER DEACTIVE PROFILE THEN REDIRECT TO BUSINESS-PROFILE/INDEX UNTILL ACTIVE PROFILE START    
        $contition_array = array('user_id' => $userid, 're_status' => '0', 'is_delete' => '0');
        $recruiter_deactive = $this->data['recruiter_deactive'] = $this->common->select_data_by_condition('recruiter', $contition_array, $data = 'rec_id', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);

        if ($recruiter_deactive) {
            redirect('recruiter/');
        }
        // IF USER DEACTIVE PROFILE THEN REDIRECT TO BUSINESS-PROFILE/INDEX UNTILL ACTIVE PROFILE END    
        // DEACTIVATE PROFILE END
        // CODE FOR SECOND HEADER SEARCH START
        // JOB EDUCATION DATA START
        $contition_array = array('status' => '1', 'user_id' => $userid);
        $edudata = $this->data['edudata'] = $this->common->select_data_by_condition('job_add_edu', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str, $groupby = '');
        // JOB EDUCATION DATA END
        // JOB REGISTRATION DATA START
        $contition_array = array('status' => '1', 'is_delete' => '0');
        $recdata = $this->data['results'] = $this->common->select_data_by_condition('job_reg', $contition_array, $data = 'other_skill,designation', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);
        // JOB REGISTRATION DATA END
        // JOB WORK EXPERIENCE DATA START
        $contition_array = array('status' => '1');
        $jobdata = $this->data['results'] = $this->common->select_data_by_condition('job_add_workexp', $contition_array, $data = 'jobtitle', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);
        // JOB WORK EXPERIENCE DATA END
        // DEGREE DATA START
        $contition_array = array('status' => '1');
        $degreedata = $this->data['results'] = $this->common->select_data_by_condition('degree', $contition_array, $data = 'degree_name', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);
        // DEGREE DATA END
        // STREAM DATA START
        $contition_array = array('status' => '1');
        $streamdata = $this->data['results'] = $this->common->select_data_by_condition('stream', $contition_array, $data = 'stream_name', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);
        // STREAM DATA END
        // SKILL DATA START
        $contition_array = array('status' => '1', 'type' => '1');
        $skill = $this->data['results'] = $this->common->select_data_by_condition('skill', $contition_array, $data = 'skill', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);
        // SKILL DATA END
        //MERGE DATA START
        $uni = array_merge($recdata, $jobdata, $degreedata, $streamdata, $skill, $edudata);
        //MERGE DATA END

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
        // CITY SEARCH DATA START

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
        // CITY SEARCH DATA END
        // CODE FOR SECOND HEADER SEARCH END    
    }

    public function index() {
        $userid = $this->session->userdata('aileenuser');
        //  CHECK HOW MUCH STEP FILL UP BY USE IN RECRUITER PROFILE START  
        $this->recruiter_apply_check();
        //  CHECK HOW MUCH STEP FILL UP BY USE IN RECRUITER PROFILE END  
        // IF USER IS RELOGIN AFTER DEACTIVATE PROFILE IN RECRUITER THEN REACTIVATE PROFIEL CODE START    
        $contition_array = array('user_id' => $userid, 're_status' => '0');
        $recdata = $this->common->select_data_by_condition('recruiter', $contition_array, $data = 'rec_id', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
        // IF USER IS RELOGIN AFTER DEACTIVATE PROFILE IN RECRUITER THEN REACTIVATE PROFIEL CODE END    

        if ($recdata) {
            $this->load->view('recruiter/reactivate', $this->data);
        } else {
            // RECRUITER USER STEP DETAIL FETCH CODE START
            $contition_array = array('user_id' => $userid, 're_status' => '1');
            $recrdata = $this->common->select_data_by_condition('recruiter', $contition_array, $data = 're_step', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
            // RECRUITER USER STEP DETAIL FETCH CODE END

            if ($recrdata[0]['re_step'] == 1) {
                redirect('recruiter/company_info_form', refresh);
            } else if ($recrdata[0]['re_step'] == 3) {
                redirect('recruiter/recommen_candidate', refresh);
            } else if ($recrdata[0]['re_step'] == 0) {
                redirect('recruiter/rec_basic_information', refresh);
            } else {
                redirect('recruiter/rec_basic_information', refresh);
            }
        }
    }

// recruiter apply check 
    public function recruiter_apply_check() {

        $userid = $this->session->userdata('aileenuser');

// REDIRECT USER TO REMAIN PROFILE START
        $contition_array = array('user_id' => $userid, 're_status' => '1', 'is_delete' => '0');
        $apply_step = $this->common->select_data_by_condition('recruiter', $contition_array, $data = 're_step', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
// REDIRECT USER TO REMAIN PROFILE END

        if (count($apply_step) >= 0) {
            if ($apply_step[0]['re_step'] == 1) {
                redirect('recruiter/company_info_form');
            }
            if ($apply_step[0]['re_step'] == 0) {
                redirect('recruiter/rec_basic_information');
            }
        } else {
            redirect('recruiter/rec_basic_information');
        }
    }

    // RECRUITER BASIC INFORMATION STEP START
    public function rec_basic_information() {
        $userid = $this->session->userdata('aileenuser');

//IF USER DEACTIVATE PROFILE THEN REDIRECT TO RECRUITER/INDEX UNTILL ACTIVE PROFILE START
        $contition_array = array('user_id' => $userid, 're_status' => '0', 'is_delete' => '0');
        $recruiter_deactive = $this->data['recruiter_deactive'] = $this->common->select_data_by_condition('recruiter', $contition_array, $data = 'rec_id', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);
        if ($recruiter_deactive) {
            redirect('recruiter/');
        }
        //IF USER DEACTIVATE PROFILE THEN REDIRECT TO RECRUITER/INDEX UNTILL ACTIVE PROFILE END


        $contition_array = array('user_id' => $userid, 're_status' => '1');
        $recdata = $this->data['recdata'] = $this->common->select_data_by_condition('recruiter', $contition_array, $data = 're_step,rec_firstname,rec_lastname,rec_email,rec_phone', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        if ($recdata) {
            $step = $recdata[0]['re_step'];
            if ($step == 1 || $step > 1) {
                $this->data['firstname'] = $recdata[0]['rec_firstname'];
                $this->data['lastname'] = $recdata[0]['rec_lastname'];
                $this->data['email'] = $recdata[0]['rec_email'];
                $this->data['phone'] = $recdata[0]['rec_phone'];
            }
        }

        $this->load->view('recruiter/rec_basic_information', $this->data);
    }

    // RECRUITER BASIC INFORMATION STEP END  
    // RECRUITER BASIC INFORMATION INSERT STEP START  
    public function basic_information() {

        $userid = $this->session->userdata('aileenuser');

        //IF USER DEACTIVATE PROFILE THEN REDIRECT TO RECRUITER/INDEX UNTILL ACTIVE PROFILE START
        $contition_array = array('user_id' => $userid, 're_status' => '0', 'is_delete' => '0');
        $recruiter_deactive = $this->data['recruiter_deactive'] = $this->common->select_data_by_condition('recruiter', $contition_array, $data = 'rec_id', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);
        if ($recruiter_deactive) {
            redirect('recruiter/');
        }
        //IF USER DEACTIVATE PROFILE THEN REDIRECT TO RECRUITER/INDEX UNTILL ACTIVE PROFILE END

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
            $recdata = $this->common->select_data_by_condition('recruiter', $contition_array, $data = 'rec_firstname,rec_lastname,rec_email,rec_phone', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

            if ($recdata) {
                $step = $recdata[0]['re_step'];

                if ($step == 1 || $step > 1) {
                    $this->data['firstname'] = $recdata[0]['rec_firstname'];
                    $this->data['lastname'] = $recdata[0]['rec_lastname'];
                    $this->data['email'] = $recdata[0]['rec_email'];
                    $this->data['phone'] = $recdata[0]['rec_phone'];
                }
            }
            $this->load->view('recruiter/rec_basic_information', $this->data);
        } else {
            $contition_array = array('user_id' => $userid, 're_status' => '1');
            $recdata = $this->common->select_data_by_condition('recruiter', $contition_array, $data = 'rec_id', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

// IF USER AVAILABLE THEN UPDATE DATA START
            if ($recdata) {

                $data = array(
                    'rec_firstname' => $this->input->post('first_name'),
                    'rec_lastname' => $this->input->post('last_name'),
                    'rec_email' => $this->input->post('email'),
                    'rec_phone' => $this->input->post('phoneno'),
                    're_status' => 1,
                    'is_delete' => 0,
                    'modify_date' => date('y-m-d h:i:s'),
                    'user_id' => $userid,
                    're_step' => 1
                );

                $insert_id = $this->common->update_data($data, 'recruiter', 'rec_id', $recdata[0]['rec_id']);

                if ($insert_id) {
                    $this->session->set_flashdata('success', 'Basic information updated successfully');
                    redirect('recruiter/company_info_form', refresh);
                } else {
                    $this->session->flashdata('error', 'Sorry!! Your data not inserted');
                    redirect('recruiter', refresh);
                }
            } else {
                // IF USER NOT AVAILABLE THEN INSERT DATA START               
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

                $insert_id = $this->common->insert_data_getid($data, 'recruiter');
                if ($insert_id) {

                    $this->session->set_flashdata('success', 'Basic information inserted successfully');
                    redirect('recruiter/company_info_form', refresh);
                } else {
                    $this->session->flashdata('error', 'Sorry!! Your data not inserted');
                    redirect('recruiter', refresh);
                }
            }
        }
    }

    // RECRUITER BASIC INFORMATION INSERT STEP END  
// RECRUITER CHECK EMAIL FUCNTION IN BSIC INFORMATION START
    public function check_email() {
        $email = $this->input->post('email');

        $userid = $this->session->userdata('aileenuser');

        //if user deactive profile then redirect to recruiter/index untill active profile start
        $contition_array = array('user_id' => $userid, 're_status' => '0', 'is_delete' => '0');

        $recruiter_deactive = $this->data['recruiter_deactive'] = $this->common->select_data_by_condition('recruiter', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);

        if ($recruiter_deactive) {
            redirect('recruiter/');
        }
        //if user deactive profile then redirect to recruiter/index untill active profile End


        $contition_array = array('user_id' => $userid, 'is_delete' => '0', 're_status' => '1');
        $userdata = $this->common->select_data_by_condition('recruiter', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        $email1 = $userdata[0]['rec_email'];

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

    // RECRUITER CHECK EMAIL FUCNTION IN BSIC INFORMATION END  
    // RECRUITER CHECK EMAIL FUCNTION IN COMPANY INFORMATION START  
    public function company_info_form() {

        $userid = $this->session->userdata('aileenuser');

        //IF USER DEACTIVATE PROFILE THEN REDIRECT TO RECRUITER/INDEX UNTILL ACTIVE PROFILE START
        $contition_array = array('user_id' => $userid, 're_status' => '0', 'is_delete' => '0');
        $recruiter_deactive = $this->data['recruiter_deactive'] = $this->common->select_data_by_condition('recruiter', $contition_array, $data = 'rec_id', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);
        if ($recruiter_deactive) {
            redirect('recruiter/');
        }
        //IF USER DEACTIVATE PROFILE THEN REDIRECT TO RECRUITER/INDEX UNTILL ACTIVE PROFILE END
        // FETCH COUNTRY DATA    
        $contition_array = array('status' => 1);
        $this->data['countries'] = $this->common->select_data_by_condition('countries', $contition_array, $data = 'country_id,country_name', $sortby = 'country_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        // FETCH STATE DATA  
        $contition_array = array('status' => 1, 'country_id' => $state_citydata[0]['re_comp_country']);
        $this->data['states'] = $this->common->select_data_by_condition('states', $contition_array, $data = '*', $sortby = 'state_id,state_name,country_id', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        // FETCH CITY DATA
        $contition_array = array('status' => '1', 'state_id' => $state_citydata[0]['re_comp_state']);
        $this->data['cities'] = $this->common->select_data_by_condition('cities', $contition_array, $data = '*', $sortby = 'city_name,city_id,state_id', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        // FETCH RECRUITER DATA    
        $contition_array = array('user_id' => $userid, 're_status' => '1', 'is_delete' => '0');
        $recdata = $this->data['recdata'] = $this->common->select_data_by_condition('recruiter', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');


        if ($recdata) {
            $step = $recdata[0]['re_step'];

            if ($step == 3 || $step > 3 || ($step >= 1 && $step <= 3)) {

                $this->data['rec_id'] = $recdata[0]['rec_id'];
                $this->data['compname'] = $recdata[0]['re_comp_name'];
                $this->data['compemail'] = $recdata[0]['re_comp_email'];
                $this->data['compnum'] = $recdata[0]['re_comp_phone'];
                $this->data['compweb'] = $recdata[0]['re_comp_site'];
                $this->data['country1'] = $recdata[0]['re_comp_country'];
                $this->data['state1'] = $recdata[0]['re_comp_state'];
                $this->data['city1'] = $recdata[0]['re_comp_city'];
                $this->data['compsector'] = $recdata[0]['re_comp_sector'];
                $this->data['comp_profile1'] = $recdata[0]['re_comp_profile'];
                $this->data['other_activities1'] = $recdata[0]['re_comp_activities'];
                $this->data['complogo1'] = $recdata[0]['comp_logo'];
            }
        }

        $this->load->view('recruiter/company_information', $this->data);
    }

    // RECRUITER CHECK EMAIL FUCNTION IN COMPANY INFORMATION END  
    // RECRUITER CHECK EMAIL FUCNTION IN COMPANY INFORMATION INSERT CODE START
    public function company_info_store() {

        $userid = $this->session->userdata('aileenuser');

        //IF USER DEACTIVATE PROFILE THEN REDIRECT TO RECRUITER/INDEX UNTILL ACTIVE PROFILE START
        $contition_array = array('user_id' => $userid, 're_status' => '0', 'is_delete' => '0');
        $recruiter_deactive = $this->data['recruiter_deactive'] = $this->common->select_data_by_condition('recruiter', $contition_array, $data = 'rec_id', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);
        if ($recruiter_deactive) {
            redirect('recruiter/');
        }
        //IF USER DEACTIVATE PROFILE THEN REDIRECT TO RECRUITER/INDEX UNTILL ACTIVE PROFILE END


        $this->form_validation->set_rules('country', 'Country', 'required');
        $this->form_validation->set_rules('state', 'State', 'required');
        $this->form_validation->set_rules('comp_name', 'company Name', 'required');
        $this->form_validation->set_rules('comp_email', 'company email', 'required|valid_email');

        if ($this->form_validation->run() == FALSE) {
            $contition_array = array('user_id' => $userid, 're_status' => '1', 'is_delete' => '0');
        $recdata = $this->data['recdata'] = $this->common->select_data_by_condition('recruiter', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
              if ($recdata) {
                $step = $recdata[0]['re_step'];

                if ($step == 3 || $step > 3 || ($step >= 1 && $step <= 3)) {
                    $this->data['compname'] = $recdata[0]['re_comp_name'];
                    $this->data['compemail'] = $recdata[0]['re_comp_email'];
                    $this->data['compnum'] = $recdata[0]['re_comp_phone'];
                    $this->data['compweb'] = $recdata[0]['re_comp_site'];
                    $this->data['compsector'] = $recdata[0]['re_comp_sector'];
                    $this->data['comp_profile1'] = $recdata[0]['re_comp_profile'];
                    $this->data['country1'] = $recdata[0]['re_comp_country'];
                    $this->data['state1'] = $recdata[0]['re_comp_state'];
                    $this->data['city1'] = $recdata[0]['re_comp_city'];
                    $this->data['other_activities1'] = $recdata[0]['re_comp_activities'];
                    $this->data['complogo1'] = $recdata[0]['comp_logo'];
                }
            }
            $this->load->view('recruiter/company_information', $this->data);
        } else {

            $error = '';
            if ($_FILES['comp_logo']['name'] != '') {
                $logo = '';
                $job['upload_path'] = $this->config->item('rec_profile_main_upload_path');
                $job['allowed_types'] = $this->config->item('rec_profile_main_allowed_types');
                $job['max_size'] = $this->config->item('rec_profile_main_max_size');
                $job['max_width'] = $this->config->item('rec_profile_main_max_width');
                $job['max_height'] = $this->config->item('rec_profile_main_max_height');
                $this->load->library('upload');
                $this->upload->initialize($job);
                //Uploading Image
                $this->upload->do_upload('comp_logo');
                //Getting Uploaded Image File Data
                $imgdata = $this->upload->data();
                $imgerror = $this->upload->display_errors();
                //print_r($imgerror);die();

                if ($imgerror == '') {

                    //Configuring Thumbnail 
                    $job_thumb['image_library'] = 'gd2';
                    $job_thumb['source_image'] = $job['upload_path'] . $imgdata['file_name'];
                    $job_thumb['new_image'] = $this->config->item('rec_profile_thumb_upload_path') . $imgdata['file_name'];
                    $job_thumb['create_thumb'] = TRUE;
                    $job_thumb['maintain_ratio'] = TRUE;
                    $job_thumb['thumb_marker'] = '';
                    $job_thumb['width'] = $this->config->item('rec_profile_thumb_width');
                    //$user_thumb['height'] = $this->config->item('user_thumb_height');
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
            }
            if ($error) {

                $this->session->set_flashdata('error', $error[0]);
                $redirect_url = site_url('job');
                redirect($redirect_url, 'refresh');
            } else {


                $contition_array = array('user_id' => $userid);
                $recdata = $this->common->select_data_by_condition('recruiter', $contition_array, $data = 'comp_logo', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

                $rec_reg_prev_image = $recdata[0]['comp_logo'];
                $logoimage = $_FILES['comp_logo']['name'];


                $image_hidden_primary = $this->input->post('image_hidden_logo');

                if ($rec_reg_prev_image != '') {
                    $rec_image_main_path = $this->config->item('rec_profile_main_upload_path');
                    $rec_bg_full_image = $rec_image_main_path . $rec_reg_prev_image;
                    if (isset($rec_bg_full_image)) {
                        //delete image from folder when user change image start
                        if ($image_hidden_primary == $rec_reg_prev_image && $logoimage != "") {

                            unlink($rec_bg_full_image);
                        }
                        //delete image from folder when user change image End
                    }

                    $rec_image_thumb_path = $this->config->item('rec_profile_thumb_upload_path');
                    $rec_bg_thumb_image = $rec_image_thumb_path . $rec_reg_prev_image;
                    if (isset($job_bg_thumb_image)) {
                        //delete image from folder when user change image Start
                        if ($image_hidden_primary == $rec_reg_prev_image && $logoimage != "") {
                            unlink($rec_bg_thumb_image);
                        }
                        //delete image from folder when user change image End
                    }
                }
                $logo = $imgdata['file_name'];
            }
            $contition_array = array('user_id' => $userid, 're_status' => '1');
            $recdata = $this->common->select_data_by_condition('recruiter', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
            if ($recdata) {
                $logoimage = $_FILES['comp_logo']['name'];
                if ($logoimage == "") {
                    $data = array(
                        'comp_logo' => $this->input->post('image_hidden_logo')
                    );
                } else {
                    $data = array(
                        'comp_logo' => $logo
                    );
                }
                $insert_id = $this->common->update_data($data, 'recruiter', 'user_id', $userid);
                $data = array(
                    're_comp_name' => $this->input->post('comp_name'),
                    're_comp_email' => $this->input->post('comp_email'),
                    're_comp_site' => $this->input->post('comp_site'),
                    're_comp_phone' => $this->input->post('comp_num'),
                    're_comp_sector' => trim($this->input->post('comp_sector')),
                    're_comp_profile' => trim($this->input->post('comp_profile')),
                    're_comp_activities' => trim($this->input->post('other_activities')),
                    're_comp_country' => $this->input->post('country'),
                    're_comp_state' => $this->input->post('state'),
                    're_comp_city' => $this->input->post('city'),
                    're_step' => 3
                );

                $insert_id = $this->common->update_data($data, 'recruiter', 'rec_id', $userdata[0]['rec_id']);

                if ($insert_id) {

                    $this->session->set_flashdata('success', 'company information updated successfully');
                    redirect('recruiter/recommen_candidate', refresh);
                } else {
                    $this->session->flashdata('error', 'Sorry!! Your data not inserted');
                    redirect('recruiter', refresh);
                }
            } else {
                $data = array(
                    're_comp_name' => $this->input->post('comp_name'), 're_comp_email' => $this->input->post('comp_email'),
                    're_comp_site' => $this->input->post('comp_site'),
                    're_comp_phone' => $this->input->post('comp_num'),
                    're_comp_sector' => trim($this->input->post('comp_sector')),
                    're_comp_profile' => trim($this->input->post('comp_profile')),
                    're_comp_activities' => trim($this->input->post('other_activities')),
                    're_comp_country' => $this->input->post('country'),
                    're_comp_state' => $this->input->post('state'),
                    're_comp_city' => $this->input->post('city'),
                    'comp_logo' => $logo,
                    'is_delete' => 0,
                    're_status' => 1,
                    'created_date' => date('y-m-d h:i:s'),
                    're_step' => 3
                );
                $insert_id = $this->common->update_data($data, 'recruiter', 'user_id', $userid);
                if ($insert_id) {
                    $this->session->set_flashdata('success', 'company information inserted successfully');
                    if ($userdata[0]['re_step'] == 3) {
                        redirect('recruiter/recommen_candidate', refresh);
                    } else {
                        redirect('recruiter/company_info_form', refresh);
                    }
                } else {
                    $this->session->flashdata('error', 'Sorry!! Your data not inserted');
                    redirect('recruiter', refresh);
                }
            }
        }
    }
    // RECRUITER CHECK EMAIL FUCNTION IN COMPANY INFORMATION INSERT CODE END   
    // RECRUITER CHECK EMAIL COMAPNY FUNCTION START   
       public function check_email_com() { //echo "hello"; die();
        $email = $this->input->post('comp_email');

        $userid = $this->session->userdata('aileenuser');

      
        //IF USER DEACTIVATE PROFILE THEN REDIRECT TO RECRUITER/INDEX UNTILL ACTIVE PROFILE START
        $contition_array = array('user_id' => $userid, 're_status' => '0', 'is_delete' => '0');
        $recruiter_deactive = $this->data['recruiter_deactive'] = $this->common->select_data_by_condition('recruiter', $contition_array, $data = 'rec_id', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);
        if ($recruiter_deactive) {
            redirect('recruiter/');
        }
        //IF USER DEACTIVATE PROFILE THEN REDIRECT TO RECRUITER/INDEX UNTILL ACTIVE PROFILE END

        $contition_array = array('user_id' => $userid, 'is_delete' => '0', 're_status' => '1');
        $userdata = $this->common->select_data_by_condition('recruiter', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        $email1 = $userdata[0]['rec_email'];

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
    // RECRUITER CHECK EMAIL COMAPNY FUNCTION END   
    // RECRUITER RECOMMANDED FUNCTION START
        public function recommen_candidate() {

         $this->recruiter_apply_check(); 

        $userid = $this->session->userdata('aileenuser');

         //IF USER DEACTIVATE PROFILE THEN REDIRECT TO RECRUITER/INDEX UNTILL ACTIVE PROFILE START
        $contition_array = array('user_id' => $userid, 're_status' => '0', 'is_delete' => '0');
        $recruiter_deactive = $this->data['recruiter_deactive'] = $this->common->select_data_by_condition('recruiter', $contition_array, $data = 'rec_id', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);
        if ($recruiter_deactive) {
            redirect('recruiter/');
        }
        //IF USER DEACTIVATE PROFILE THEN REDIRECT TO RECRUITER/INDEX UNTILL ACTIVE PROFILE END


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

              foreach ($unique as $ke => $arr) {
               foreach ($arr as $va) {
        
    
                    $skildataa[] = $va;
                }
            }
//echo "<pre>";print_r($postdata);
                $new = array();
                foreach ($skildataa as $value) {
                    $new[$value['user_id']] = $value;
                }

           //  $new = array_unique($unique, SORT_REGULAR);
                 

    //echo "<pre>"; print_r($new); 

       // die();
      
        $this->data['candidatejob'] = $new;
      

        $this->load->view('recruiter/recommen_candidate', $this->data);

    }
    // RECRUITER RECOMMANDED FUNCTION END

}
