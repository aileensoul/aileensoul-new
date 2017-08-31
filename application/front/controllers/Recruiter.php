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
// FETCH RECRUITER DATA    
        $contition_array = array('user_id' => $userid, 're_status' => '1', 'is_delete' => '0');
        $recdata = $this->data['recdata'] = $this->common->select_data_by_condition('recruiter', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

// FETCH COUNTRY DATA    
        $contition_array = array('status' => 1);
        $this->data['countries'] = $this->common->select_data_by_condition('countries', $contition_array, $data = 'country_id,country_name', $sortby = 'country_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');

// FETCH STATE DATA  
        $contition_array = array('status' => 1, 'country_id' => $recdata[0]['re_comp_country']);
        $this->data['states'] = $this->common->select_data_by_condition('states', $contition_array, $data = '*', $sortby = 'state_id,state_name,country_id', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');

// FETCH CITY DATA
        $contition_array = array('status' => '1', 'state_id' => $recdata[0]['re_comp_state']);
        $this->data['cities'] = $this->common->select_data_by_condition('cities', $contition_array, $data = '*', $sortby = 'city_name,city_id,state_id', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');


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

                $insert_id = $this->common->update_data($data, 'recruiter', 'rec_id', $recdata[0]['rec_id']);

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
// FETCH RECRUITER POST    

        $contition_array = array('user_id' => $userid, 'is_delete' => 0, 'status' => 1);
        $recpostdata = $this->data['recpostdata'] = $this->common->select_data_by_condition('rec_post', $contition_array, $data = '*', $sortby = '', $orderby = 'DESC', $limit = '', $offset = '', $join_str = array(), $groupby = '');

//FETCH RECRUITER DATA

        $contition_array = array('user_id' => $userid, 'is_delete' => 0, 're_status' => 1);
        $this->data['recdata'] = $this->common->select_data_by_condition('recruiter', $contition_array, $data = '*', $sortby = '', $orderby = 'DESC', $limit = '', $offset = '', $join_str = array(), $groupby = '');

//FETCH SKILL DATA

        $contition_array = array('user_id' => $userid, 'type' => '4', 'status' => 1);
        $skillotherdata = $this->data['skillotherdata'] = $this->common->select_data_by_condition('skill', $contition_array, $data = '*', $sortby = '', $orderby = 'DESC', $limit = '', $offset = '', $join_str = array(), $groupby = '');

//FETCH JOB DATA

        $contition_array = array('job_reg.user_id !=' => $userid, 'job_step' => 10);
        $candidate = $this->data['candidate'] = $this->common->select_data_by_condition('job_reg', $contition_array, $data = 'keyskill,job_id,user_id', $sortby = '', $orderby = 'desc', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        foreach ($skillotherdata as $othrd) {
            if ($othrd['skill'] != '') {
                $contition_array1 = array('type' => '3', 'FIND_IN_SET("' . $othrd['skill'] . '",skill)!=' => '0');
                $candidate1[] = $this->data['candidate1'] = $this->common->select_data_by_condition('skill', $contition_array1, $data = '*', $sortby = '', $orderby = 'desc', $limit = '', $offset = '', $join_str = array(), $groupby = '');
            }
        }

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

                $contition_array = array('job_reg.user_id' => $ke['user_id'], 'job_reg.is_delete' => 0, 'job_reg.status' => 1, 'job_reg.job_step' => 10);
                $jobr11[] = $this->data['jobrec'] = $this->common->select_data_by_condition('job_reg', $contition_array, $data = 'job_reg.*,job_reg.user_id as iduser,job_add_edu.*,job_graduation.*', $sortby = 'job_id', $orderby = 'desc', $limit = '', $offset = '', $join_str1, $groupby = '');
            }
        }

        foreach ($recpostdata as $postdata) {

            $recskill = explode(',', $postdata['post_skill']);

            $recskill = array_filter(array_map('trim', $recskill));

            foreach ($candidate as $candi) {

                $candiskill = explode(',', $candi['keyskill']);
                $candiskill = array_filter(array_map('trim', $candiskill));

                $result1 = array_intersect($recskill, $candiskill);


                if (count($result1) > 0) {

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
        if (count($jobr11) == 0) {
            $unique = $jobr;
        } elseif (count($jobr) == 0) {
            $unique = $jobr11;
        } else {
            $unique = array_merge($jobr11, $jobr);
        }
        foreach ($unique as $ke => $arr) {
            foreach ($arr as $va) {
                $skildataa[] = $va;
            }
        }

        $new = array();
        foreach ($skildataa as $value) {
            $new[$value['user_id']] = $value;
        }
        $this->data['candidatejob'] = $new;


        $this->load->view('recruiter/recommen_candidate', $this->data);
    }

// RECRUITER RECOMMANDED FUNCTION END
// RECRUITER ADD POST START
    public function add_post() {
        $this->recruiter_apply_check();

        $userid = $this->session->userdata('aileenuser');

//IF USER DEACTIVATE PROFILE THEN REDIRECT TO RECRUITER/INDEX UNTILL ACTIVE PROFILE START
        $contition_array = array('user_id' => $userid, 're_status' => '0', 'is_delete' => '0');
        $recruiter_deactive = $this->data['recruiter_deactive'] = $this->common->select_data_by_condition('recruiter', $contition_array, $data = 'rec_id', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);
        if ($recruiter_deactive) {
            redirect('recruiter/');
        }
//IF USER DEACTIVATE PROFILE THEN REDIRECT TO RECRUITER/INDEX UNTILL ACTIVE PROFILE END


        $contition_array = array('status' => 1);
        $this->data['currency'] = $this->common->select_data_by_condition('currency', $contition_array, $data = '*', $sortby = 'currency_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        $contition_array = array('is_delete' => '0', 'industry_name !=' => "Other");
        $search_condition = "((status = '2' AND user_id = $userid) OR (status = '1'))";
        $university_data = $this->data['industry'] = $this->common->select_data_by_search('job_industry', $search_condition, $contition_array, $data = '*', $sortby = 'industry_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        $contition_array = array('is_delete' => '0', 'status' => 1, 'industry_name' => "Other");
        $this->data['industry_otherdata'] = $this->common->select_data_by_condition('job_industry', $contition_array, $data = '*', $sortby = 'industry_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');



        $contition_array = array('is_delete' => '0', 'degree_name !=' => "Other");
        $search_condition = "((status = '2' AND user_id = $userid) OR (status = '1'))";
        $degree = $this->data['degree'] = $this->common->select_data_by_search('degree', $search_condition, $contition_array, $data = '*', $sortby = 'degree_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        $contition_array = array('is_delete' => '0', 'status' => 1, 'degree_name' => "Other");
        $this->data['degree_otherdata'] = $this->common->select_data_by_condition('degree', $contition_array, $data = '*', $sortby = 'degree_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        $contition_array = array('status' => '1');
        $this->data['countries'] = $this->common->select_data_by_condition('countries', $contition_array, $data = '*', $sortby = 'country_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        $contition_array = array('status' => '1', 'type' => '1');
        $this->data['skill'] = $this->common->select_data_by_condition('skill', $contition_array, $data = '*', $sortby = 'skill', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        $this->data['recdata'] = $this->common->select_data_by_id('recruiter', 'user_id', $userid, $data = '*', $join_str = array());

//jobtitle data fetch
        $contition_array = array('status' => 'publish');
        $jobtitle = $this->common->select_data_by_condition('job_title', $contition_array, $data = 'name', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

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

        $this->load->view('recruiter/add_post', $this->data);
    }

// RECRUITER ADD POST END
// RECRUITER ADD POST INSERT START

    public function add_post_store() {

        $this->recruiter_apply_check();

        $userid = $this->session->userdata('aileenuser');

//IF USER DEACTIVATE PROFILE THEN REDIRECT TO RECRUITER/INDEX UNTILL ACTIVE PROFILE START
        $contition_array = array('user_id' => $userid, 're_status' => '0', 'is_delete' => '0');
        $recruiter_deactive = $this->data['recruiter_deactive'] = $this->common->select_data_by_condition('recruiter', $contition_array, $data = 'rec_id', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);
        if ($recruiter_deactive) {
            redirect('recruiter/');
        }
//IF USER DEACTIVATE PROFILE THEN REDIRECT TO RECRUITER/INDEX UNTILL ACTIVE PROFILE END


        $position = $this->input->post('position_no');
        $min_year = $this->input->post('minyear');
        $max_year = $this->input->post('maxyear');
        $fresher = $this->input->post('fresher');
        $industry = $this->input->post('industry');
        $emp_type = $this->input->post('emp_type');
        $post_Desc = $this->input->post('post_desc');
        $interview = $this->input->post('interview');
        $country = $this->input->post('country');
        $state = $this->input->post('state');
        $city = $this->input->post('city');
        $salary_type = $this->input->post('salary_type');
        $min_sal = $this->input->post('minsal');
        $max_sal = $this->input->post('maxsal');
        $currency = $this->input->post('currency');
        $bod = $this->input->post('last_date');
        $bod = str_replace('/', '-', $bod);


// job title start  

        $jobtitle = $this->input->post('post_name');
        if ($jobtitle != " ") {
            $contition_array = array('name' => $jobtitle);
            $jobdata = $this->common->select_data_by_condition('job_title', $contition_array, $data = 'title_id,name', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str5 = '', $groupby = '');
            if ($jobdata) {
                $jobtitle = $jobdata[0]['title_id'];
            } else {
                $data = array(
                    'name' => ucfirst($this->input->post('post_name')),
                    'status' => 'publish',
                );
                $jobtitle = $this->common->insert_data_getid($data, 'job_title');
            }
        }

// skills  start   
        $skills = $this->input->post('skills');
        $skills = explode(',', $skills);
        if (count($skills) > 0) {

            foreach ($skills as $ski) {
                $contition_array = array('skill' => trim($ski), 'type' => 1);
                $skilldata = $this->common->select_data_by_condition('skill', $contition_array, $data = 'skill_id,skill', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str5 = '', $groupby = '');

                if (count($skilldata) < 0) {
                    $contition_array = array('skill' => trim($ski), 'type' => 4);

                    $skilldata = $this->common->select_data_by_condition('skill', $contition_array, $data = 'skill_id,skill', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str5 = '', $groupby = '');
                }
                if ($skilldata) {
                    $skill1[] = $skilldata[0]['skill_id'];
                } else {
                    $data = array(
                        'skill' => trim($ski),
                        'status' => '1',
                        'type' => 4,
                        'user_id' => $userid,
                    );
                    $skill1[] = $this->common->insert_data_getid($data, 'skill');
                }
            }
        }
        $skills = implode(',', $skill1);

// education data start

        $education = $this->input->post('education');
        $education = explode(',', $education);
        if (count($education) > 0) {

            foreach ($education as $educat) {
                if ($educat != " ") {
                    $contition_array = array('degree_name' => trim($educat), 'status' => 1, 'is_other' => '0');
                    $edudata = $this->common->select_data_by_condition('degree', $contition_array, $data = 'degree_id,degree_name', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str5 = '', $groupby = '');

                    if (count($edudata) < 0) {
                        $contition_array = array('degree_name' => trim($educat), 'status' => 2, 'is_other' => 1, 'user_id' => $userid);
                        $edudata = $this->common->select_data_by_condition('degree', $contition_array, $data = 'degree_id,degree_name', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str5 = '', $groupby = '');
                    }
                    if ($edudata) {
                        $edudata1[] = $edudata[0]['degree_id'];
                    } else {
                        $data = array(
                            'degree_name' => trim($educat),
                            'status' => '2',
                            'is_other' => 1,
                            'user_id' => $userid,
                            'created_date' => date('y-m-d h:i:s'),
                        );
                        $edudata1[] = $this->common->insert_data_getid($data, 'degree');
                    }
                }
            }
        }
        $edudata = implode(',', $edudata1);
// education data end
// } else {

        $data = array(
            'post_name' => $jobtitle,
            'post_description' => trim($post_Desc),
            'post_skill' => $skills,
            'post_position' => $position,
            'post_last_date' => date('Y-m-d', strtotime($bod)),
            'country' => $country,
            'state' => $state,
            'city' => $city,
            'min_year' => $min_year,
            'max_year' => $max_year,
            'interview_process' => trim($interview),
            'industry_type' => $industry,
            'degree_name' => $edudata,
            'emp_type' => $emp_type,
            'fresher' => $fresher,
            'min_sal' => $min_sal,
            'max_sal' => $max_sal,
            'post_currency' => $currency,
            'salary_type' => $salary_type,
            'is_delete' => 0,
            'created_date' => date('y-m-d h:i:s'),
            'user_id' => $userid,
            'status' => 1,
        );

        $insert_id = $this->common->insert_data_getid($data, 'rec_post');


        if ($insert_id) {
            $this->session->set_flashdata('success', 'your post inserted successfully');
            redirect('recruiter/rec_post', 'refresh');
        } else {
            $this->session->flashdata('error', 'Sorry!! Your data not inserted');
            redirect('recruiter', 'refresh');
        }
//}
    }

// RECRUITER ADD POST INSERT END
// RECRUITER POST START
    public function rec_post() {
        $this->data['userid'] = $userid = $this->session->userdata('aileenuser');


//IF USER DEACTIVATE PROFILE THEN REDIRECT TO RECRUITER/INDEX UNTILL ACTIVE PROFILE START
        $contition_array = array('user_id' => $userid, 're_status' => '0', 'is_delete' => '0');
        $recruiter_deactive = $this->data['recruiter_deactive'] = $this->common->select_data_by_condition('recruiter', $contition_array, $data = 'rec_id', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);
        if ($recruiter_deactive) {
            redirect('recruiter/');
        }
//IF USER DEACTIVATE PROFILE THEN REDIRECT TO RECRUITER/INDEX UNTILL ACTIVE PROFILE END



        if ($id == $userid || $id == '') {
            $this->recruiter_apply_check();

            $contition_array = array('user_id' => $userid, 'is_delete' => 0);
            $this->data['postdataone'] = $this->common->select_data_by_condition('recruiter', $contition_array, $data = 'rec_id,rec_firstname,rec_lastname,recruiter_user_image,profile_background,designation', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str, $groupby = '');


            $join_str[0]['table'] = 'recruiter';
            $join_str[0]['join_table_id'] = 'recruiter.user_id';
            $join_str[0]['from_table_id'] = 'rec_post.user_id';
            $join_str[0]['join_type'] = '';


            $contition_array = array('rec_post.user_id' => $userid, 'rec_post.is_delete' => 0);
            $this->data['postdata'] = $this->common->select_data_by_condition('rec_post', $contition_array, $data = 'rec_post.*,recruiter.rec_firstname,recruiter.re_comp_name,recruiter.rec_lastname,recruiter.recruiter_user_image,recruiter.profile_background,recruiter.re_comp_profile', $sortby = 'post_id', $orderby = 'desc', $limit = '', $offset = '', $join_str, $groupby = '');
        } else {
            $this->rec_avail_check($id);

            $contition_array = array('user_id' => $id, 'is_delete' => 0, 're_step' => 3);
            $this->data['postdataone'] = $this->common->select_data_by_condition('recruiter', $contition_array, $data = 'rec_id,rec_firstname,rec_lastname,recruiter_user_image,profile_background,designation', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str, $groupby = '');

            $join_str[0]['table'] = 'recruiter';
            $join_str[0]['join_table_id'] = 'recruiter.user_id';
            $join_str[0]['from_table_id'] = 'rec_post.user_id';
            $join_str[0]['join_type'] = '';

            $contition_array = array('rec_post.user_id' => $id, 'rec_post.is_delete' => 0, 'recruiter.re_step' => 3);
            $this->data['postdata'] = $this->common->select_data_by_condition('rec_post', $contition_array, $data = 'rec_post.*,recruiter.rec_firstname,recruiter.re_comp_name,recruiter.rec_lastname,recruiter.recruiter_user_image,recruiter.profile_background,recruiter.re_comp_profile', $sortby = 'post_id', $orderby = 'desc', $limit = '', $offset = '', $join_str, $groupby = '');
        }

        $this->load->view('recruiter/rec_post', $this->data);
    }

// RECRUITER POST END
// RECRUITER EDIT POST START
    public function edit_post($id = "") {

        $this->recruiter_apply_check();

        $userid = $this->session->userdata('aileenuser');

//IF USER DEACTIVATE PROFILE THEN REDIRECT TO RECRUITER/INDEX UNTILL ACTIVE PROFILE START
        $contition_array = array('user_id' => $userid, 're_status' => '0', 'is_delete' => '0');
        $recruiter_deactive = $this->data['recruiter_deactive'] = $this->common->select_data_by_condition('recruiter', $contition_array, $data = 'rec_id', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);
        if ($recruiter_deactive) {
            redirect('recruiter/');
        }
//IF USER DEACTIVATE PROFILE THEN REDIRECT TO RECRUITER/INDEX UNTILL ACTIVE PROFILE END


        $contition_array = array('status' => '1', 'type' => '1');
        $this->data['skill'] = $this->common->select_data_by_condition('skill', $contition_array, $data = '*', $sortby = 'skill', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        $contition_array = array('status' => '1');
        $this->data['countries'] = $this->common->select_data_by_condition('countries', $contition_array, $data = '*', $sortby = 'country_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        $contition_array = array('status' => 1);
        $this->data['currency'] = $this->common->select_data_by_condition('currency', $contition_array, $data = '*', $sortby = 'currency_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        $contition_array = array('is_delete' => '0', 'industry_name !=' => "Other");
        $search_condition = "((status = '2' AND user_id = $userid) OR (status = '1'))";
        $university_data = $this->data['industry'] = $this->common->select_data_by_search('job_industry', $search_condition, $contition_array, $data = '*', $sortby = 'industry_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        $contition_array = array('is_delete' => '0', 'status' => 1, 'industry_name' => "Other");
        $this->data['industry_otherdata'] = $this->common->select_data_by_condition('job_industry', $contition_array, $data = '*', $sortby = 'industry_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        $contition_array = array('is_delete' => '0', 'degree_name !=' => "Other");
        $search_condition = "((status = '2' AND user_id = $userid) OR (status = '1'))";
        $degree = $this->data['degree'] = $this->common->select_data_by_search('degree', $search_condition, $contition_array, $data = '*', $sortby = 'degree_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        $postdatas = $this->data['postdata'] = $this->common->select_data_by_id('rec_post', 'post_id', $id, $data = '*', $join_str = array());
//echo '<pre>'; print_r($postdatas); die();
//Selected Job titlre fetch
        $contition_array = array('status' => 'publish', 'title_id' => $postdatas[0]['post_name']);
        $jobtitle = $this->common->select_data_by_condition('job_title', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        $this->data['work_title'] = $jobtitle[0]['name'];

//Selected skill fetch
        $work_skill = explode(',', $postdatas[0]['post_skill']);

        foreach ($work_skill as $skill) {
            $contition_array = array('skill_id' => $skill);
            $skilldata = $this->common->select_data_by_condition('skill', $contition_array, $data = 'skill_id,skill', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str5 = '', $groupby = '');
            $detailes[] = $skilldata[0]['skill'];
        }

        $this->data['work_skill'] = implode(',', $detailes);

//Selected degree fetch

        $work_degree = explode(',', $postdatas[0]['degree_name']);


        foreach ($work_degree as $degree) {
            $contition_array = array('degree_id' => $degree);
            $degreedata = $this->common->select_data_by_condition('degree', $contition_array, $data = 'degree_id,degree_name', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str5 = '', $groupby = '');
            $degreedetails[] = $degreedata[0]['degree_name'];
        }

        $this->data['degree_data'] = implode(',', $degreedetails);

//for getting state data
        $contition_array = array('status' => 1, 'country_id' => $postdatas[0]['country']);
        $this->data['states'] = $this->common->select_data_by_condition('states', $contition_array, $data = '*', $sortby = 'state_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');

//for getting city data
        $contition_array = array('status' => 1, 'state_id' => $postdatas[0]['state']);
        $this->data['cities'] = $this->common->select_data_by_condition('cities', $contition_array, $data = '*', $sortby = 'city_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');
        $skildata = explode(',', $this->data['postdata'][0]['post_skill']);

        $skildata = array_filter(array_map('trim', $skildata));

        $this->data['selectdata'] = $skildata;

        $skildata1 = explode(',', $this->data['postdata'][0]['degree_name']);
        $skildata1 = array_filter(array_map('trim', $skildata1));

        $this->data['selectdata1'] = $skildata1;

        $this->data['country1'] = $this->data['postdata'][0]['country'];
        $this->data['city1'] = $this->data['postdata'][0]['city'];

//jobtitle data fetch
        $contition_array = array('status' => 'publish');
        $jobtitle = $this->common->select_data_by_condition('job_title', $contition_array, $data = 'name', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

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

        $this->load->view('recruiter/edit_post', $this->data);
    }

// RECRUITER EDIT POST END
// RECRUITER EDIT POST INSERT START
    public function update_post($id = "") {
//         echo '<pre>'; print_r($_POST); die();
        $this->recruiter_apply_check();

        $skill = $this->input->post('skills');

        $bod = $this->input->post('last_date');
        $bod = str_replace('/', '-', $bod);

        $education = $this->input->post('degree');
        $userid = $this->session->userdata('aileenuser');

//if user deactive profile then redirect to recruiter/index untill active profile start
        $contition_array = array('user_id' => $userid, 're_status' => '0', 'is_delete' => '0');
        $recruiter_deactive = $this->data['recruiter_deactive'] = $this->common->select_data_by_condition('recruiter', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);

        if ($recruiter_deactive) {
            redirect('recruiter/');
        }
//if user deactive profile then redirect to recruiter/index untill active profile End
        $this->form_validation->set_rules('post_name', 'Post Name', 'required');
        $this->form_validation->set_rules('post_desc', ' Description', 'required');
        $this->form_validation->set_rules('country', 'Country', 'required');
        $this->form_validation->set_rules('state', 'State', 'required');
        $this->form_validation->set_rules('city', 'City', 'required');
        $this->form_validation->set_rules('currency', 'Currency', 'required');

// job title start  
        $jobtitle = $this->input->post('post_name');

        if ($jobtitle != " ") {
            $contition_array = array('name' => $jobtitle);
            $jobdata = $this->common->select_data_by_condition('job_title', $contition_array, $data = 'title_id,name', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str5 = '', $groupby = '');
            if ($jobdata) {
                $jobtitle = $jobdata[0]['title_id'];
            } else {
                $data = array(
                    'name' => ucfirst($this->input->post('post_name')),
                    'status' => 'publish',
                );
                $jobtitle = $this->common->insert_data_getid($data, 'job_title');
            }
        }
// job title ENd
// skills  start   
        $skills = $this->input->post('skills');
        $skills = explode(',', $skills);
        if (count($skills) > 0) {

            foreach ($skills as $ski) {
                $contition_array = array('skill' => $ski, 'type' => 4);
                $skilldata = $this->common->select_data_by_condition('skill', $contition_array, $data = 'skill_id,skill', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str5 = '', $groupby = '');
                if ($skilldata) {
                    $skill1[] = $skilldata[0]['skill_id'];
                } else {
                    $data = array(
                        'skill' => $ski,
                        'status' => '1',
                        'type' => 4,
                        'user_id' => $userid,
                    );
                    $skill1[] = $this->common->insert_data_getid($data, 'skill');
                }
            }
        }
        $skills = implode(',', $skill1);
// skills  End   
// education data start

        $education = $this->input->post('education');
        $education = explode(',', $education);
        if (count($education) > 0) {

            foreach ($education as $educat) {
                if ($educat != " ") {
                    $contition_array = array('degree_name' => trim($educat), 'status' => 1, 'is_other' => '0');
                    $edudata = $this->common->select_data_by_condition('degree', $contition_array, $data = 'degree_id,degree_name', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str5 = '', $groupby = '');

                    if (count($edudata) < 0) {
                        $contition_array = array('degree_name' => trim($educat), 'status' => 2, 'is_other' => 1, 'user_id' => $userid);
                        $edudata = $this->common->select_data_by_condition('degree', $contition_array, $data = 'degree_id,degree_name', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str5 = '', $groupby = '');
                    }
                    if ($edudata) {
                        $edudata1[] = $edudata[0]['degree_id'];
                    } else {
                        $data = array(
                            'degree_name' => trim($educat),
                            'status' => '2',
                            'is_other' => 1,
                            'user_id' => $userid,
                            'created_date' => date('y-m-d h:i:s'),
                        );
                        $edudata1[] = $this->common->insert_data_getid($data, 'degree');
                    }
                }
            }
        }
        $edudata = implode(',', $edudata1);
// education data end

        $data = array(
            'post_name' => $jobtitle,
            'post_description' => trim($this->input->post('post_desc')),
            'post_skill' => $skills,
            'post_position' => trim($this->input->post('position')),
            'post_last_date' => date('Y-m-d', strtotime($bod)),
            'country' => $this->input->post('country'),
            'state' => $this->input->post('state'),
            'city' => $this->input->post('city'),
            'min_year' => $this->input->post('minyear'),
            'max_year' => $this->input->post('maxyear'),
            'interview_process' => trim($this->input->post('interview')),
            'industry_type' => trim($this->input->post('industry')),
            'emp_type' => $this->input->post('emp_type'),
            'degree_name' => $edudata,
            'fresher' => $this->input->post('fresher'),
            'min_sal' => trim($this->input->post('minsal')),
            'max_sal' => trim($this->input->post('maxsal')),
            'post_currency' => $this->input->post('currency'),
            'salary_type' => $this->input->post('salary_type'),
            'modify_date' => date('y-m-d h:i:s')
        );
        $update = $this->common->update_data($data, 'rec_post', 'post_id', $id);

        if ($update) {
            $this->session->set_flashdata('success', 'your post updated successfully');
            redirect('recruiter/rec_post', 'refresh');
        } else {
            $this->session->flashdata('error', 'Sorry!! Your data not inserted');
            redirect('recruiter', 'refresh');
        }
        $this->data['postdata'] = $this->common->select_data_by_id('rec_post', 'post_id', $id, $data = '*', $join_str = array());
        $this->load->view('recruiter/edit_post', $this->data);
    }

// RECRUITER EDIT POST INSERT END
// RECRUITER POST CITY AJAX START
    public function ajax_data() {

        if (isset($_POST["country_id"]) && !empty($_POST["country_id"])) {
//Get all state data
            $contition_array = array('country_id' => $_POST["country_id"], 'status' => '1');
            $state = $this->data['states'] = $this->common->select_data_by_condition('states', $contition_array, $data = 'state_id,state_name', $sortby = 'state_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');

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
            $city = $this->data['city'] = $this->common->select_data_by_condition('cities', $contition_array, $data = 'city_id,city_name', $sortby = 'city_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');

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

// RECRUITER POST CITY AJAX END
// RECRUITER SAVED CANDIDATE LIST START
    public function save_candidate() {
        $this->recruiter_apply_check();

        $userid = $this->session->userdata('aileenuser');

//if user deactive profile then redirect to recruiter/index untill active profile start
        $contition_array = array('user_id' => $userid, 're_status' => '0', 'is_delete' => '0');
        $recruiter_deactive = $this->data['recruiter_deactive'] = $this->common->select_data_by_condition('recruiter', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);

        if ($recruiter_deactive) {
            redirect('recruiter/');
        }
//if user deactive profile then redirect to recruiter/index untill active profile End

        $this->data['recruiterdata'] = $this->common->select_data_by_id('recruiter', 'user_id', $userid, $data = 'user_id,designation,rec_lastname,rec_firstname', $join_str = array());

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

        $data = "job_reg.user_id as userid,job_reg.fname,job_reg.lname,job_reg.email,job_reg.phnno,job_reg.keyskill,job_reg.work_job_title,job_reg.work_job_industry,job_reg.work_job_city,job_reg.job_user_image,job_add_edu.*,job_graduation.*,save.status,save.save_id";
        $contition_array1 = array('save.from_id' => $userid, 'save.status' => 0, 'save.save_type' => 1);
        $recdata1 = $this->data['recdata1'] = $this->common->select_data_by_condition('save', $contition_array1, $data, $sortby = 'save_id', $orderby = 'desc', $limit = '', $offset = '', $join_str1, $groupby = '');

        foreach ($recdata1 as $ke => $arr) {
            $recdata2[] = $arr;
        }
        $new = array();
        foreach ($recdata2 as $value) {
            $new[$value['user_id']] = $value;
        }
        $this->data['savedata'] = $new;
        $this->load->view('recruiter/saved_candidate', $this->data);
    }

// RECRUITER SAVED CANDIDATE LIST END
// RECRUITER PROFILE START
    public function rec_profile($id = "") {

        $this->data['userid'] = $userid = $this->session->userdata('aileenuser');

//if user deactive profile then redirect to recruiter/index untill active profile start
        $contition_array = array('user_id' => $userid, 're_status' => '0', 'is_delete' => '0');

        $recruiter_deactive = $this->data['recruiter_deactive'] = $this->common->select_data_by_condition('recruiter', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);

        if ($recruiter_deactive) {
            redirect('recruiter/');
        }
//if user deactive profile then redirect to recruiter/index untill active profile End
        $data = "rec_id,user_id,rec_firstname,rec_lastname,rec_email,rec_phone,re_comp_name,re_comp_email,re_comp_phone,re_comp_site,re_comp_country,re_comp_state,re_comp_city,re_comp_profile,re_comp_sector,re_comp_activities,comp_logo,recruiter_user_image,profile_background";
        if ($id == $userid || $id == '') {
            $this->recruiter_apply_check();
            $this->data['recdata'] = $this->common->select_data_by_id('recruiter', 'user_id', $userid, $data, $join_str = array());
        } else {
            $this->rec_avail_check($id);
            $this->data['recdata'] = $this->common->select_data_by_id('recruiter', 'user_id', $id, $data, $join_str = array());
        }

        $this->load->view('recruiter/rec_profile', $this->data);
    }

// RECRUITER PROFILE END
// REMOVE POST START
    public function remove_post() {

        $this->recruiter_apply_check();

        $postid = $_POST['post_id'];
        $data = array(
            'is_delete' => 1,
            'modify_date' => date('y-m-d h:i:s')
        );

        $updatedata = $this->common->update_data($data, 'rec_post', 'post_id', $postid);
    }

// REMOVE POST END
// REMOVE CANDIDATE START
//Remove Save candidate by search controller start
    public function remove_candidate() {
        $this->recruiter_apply_check();

        $saveid = $_POST['save_id'];

        $userid = $this->session->userdata('aileenuser');

//if user deactive profile then redirect to recruiter/index untill active profile start
        $contition_array = array('user_id' => $userid, 're_status' => '0', 'is_delete' => '0');
        $recruiter_deactive = $this->data['recruiter_deactive'] = $this->common->select_data_by_condition('recruiter', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);

        if ($recruiter_deactive) {
            redirect('recruiter/');
        }
//if user deactive profile then redirect to recruiter/index untill active profile End

        $data = array(
            'status' => 1
        );

        $updatedata = $this->common->update_data($data, 'save', 'save_id', $saveid);
    }

// REMOVE CANDIDATE END
// VIEW APPLIED LIST START
    public function view_apply_list($id = "") {

        $this->recruiter_apply_check();

        $userid = $this->session->userdata('aileenuser');

        $this->data['postid'] = $id;

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
        $contition_array = array('job_apply.post_id' => $id, 'job_apply.job_delete' => '0', 'job_reg.job_step' => 10);

        $data = "job_reg.job_id,job_reg.user_id as userid,job_reg.fname,job_reg.lname,job_reg.email,job_reg.phnno,job_reg.keyskill,job_reg.experience,job_add_edu.*";
        $userdata = $this->data['user_data'] = $this->common->select_data_by_condition('job_reg', $contition_array, $data, $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str, $groupby = 'job_id');

        $this->load->view('recruiter/view_apply_list', $this->data);
    }

// VIEW APPLIED LIST END
// RECOMMANDED CANDIDATE AJAX LAZZY LOADER DATA START
    public function recommen_candidate_post($id = "") {
        
        $perpage = 5;
        $page = 1;
        if (!empty($_GET["page"]) && $_GET["page"] != 'undefined') {
            $page = $_GET["page"];
        }

        $start = ($page - 1) * $perpage;
        if ($start < 0)
            $start = 0;

         $this->recruiter_apply_check();

        $userid = $this->session->userdata('aileenuser');

//IF USER DEACTIVATE PROFILE THEN REDIRECT TO RECRUITER/INDEX UNTILL ACTIVE PROFILE START
        $contition_array = array('user_id' => $userid, 're_status' => '0', 'is_delete' => '0');
        $recruiter_deactive = $this->data['recruiter_deactive'] = $this->common->select_data_by_condition('recruiter', $contition_array, $data = 'rec_id', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);
        if ($recruiter_deactive) {
            redirect('recruiter/');
        }
//IF USER DEACTIVATE PROFILE THEN REDIRECT TO RECRUITER/INDEX UNTILL ACTIVE PROFILE END
// FETCH RECRUITER POST    

        $contition_array = array('user_id' => $userid, 'is_delete' => 0, 'status' => 1);
        $recpostdata = $this->data['recpostdata'] = $this->common->select_data_by_condition('rec_post', $contition_array, $data = '*', $sortby = '', $orderby = 'DESC', $limit = '', $offset = '', $join_str = array(), $groupby = '');

//FETCH RECRUITER DATA

        $contition_array = array('user_id' => $userid, 'is_delete' => 0, 're_status' => 1);
        $this->data['recdata'] = $this->common->select_data_by_condition('recruiter', $contition_array, $data = '*', $sortby = '', $orderby = 'DESC', $limit = '', $offset = '', $join_str = array(), $groupby = '');

//FETCH SKILL DATA

        $contition_array = array('user_id' => $userid, 'type' => '4', 'status' => 1);
        $skillotherdata = $this->data['skillotherdata'] = $this->common->select_data_by_condition('skill', $contition_array, $data = '*', $sortby = '', $orderby = 'DESC', $limit = '', $offset = '', $join_str = array(), $groupby = '');

//FETCH JOB DATA

        $contition_array = array('job_reg.user_id !=' => $userid, 'job_step' => 10);
        $candidate = $this->data['candidate'] = $this->common->select_data_by_condition('job_reg', $contition_array, $data = 'keyskill,job_id,user_id', $sortby = '', $orderby = 'desc', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        foreach ($skillotherdata as $othrd) {
            if ($othrd['skill'] != '') {
                $contition_array1 = array('type' => '3', 'FIND_IN_SET("' . $othrd['skill'] . '",skill)!=' => '0');
                $candidate1[] = $this->data['candidate1'] = $this->common->select_data_by_condition('skill', $contition_array1, $data = '*', $sortby = '', $orderby = 'desc', $limit = '', $offset = '', $join_str = array(), $groupby = '');
            }
        }

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

                $contition_array = array('job_reg.user_id' => $ke['user_id'], 'job_reg.is_delete' => 0, 'job_reg.status' => 1, 'job_reg.job_step' => 10);
                $jobr11[] = $this->data['jobrec'] = $this->common->select_data_by_condition('job_reg', $contition_array, $data = 'job_reg.*,job_reg.user_id as iduser,job_add_edu.*,job_graduation.*', $sortby = 'job_id', $orderby = 'desc', $limit = '', $offset = '', $join_str1, $groupby = '');
            }
        }

        foreach ($recpostdata as $postdata) {

            $recskill = explode(',', $postdata['post_skill']);

            $recskill = array_filter(array_map('trim', $recskill));

            foreach ($candidate as $candi) {

                $candiskill = explode(',', $candi['keyskill']);
                $candiskill = array_filter(array_map('trim', $candiskill));

                $result1 = array_intersect($recskill, $candiskill);


                if (count($result1) > 0) {

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
        if (count($jobr11) == 0) {
            $unique = $jobr;
        } elseif (count($jobr) == 0) {
            $unique = $jobr11;
        } else {
            $unique = array_merge($jobr11, $jobr);
        }
        foreach ($unique as $ke => $arr) {
            foreach ($arr as $va) {
                $skildataa[] = $va;
            }
        }

        $new = array();
        foreach ($skildataa as $value) {
            $new[$value['user_id']] = $value;
        }
     $candidatejob =   $this->data['candidatejob'] = $new;
       
        $postdata = '';

        $candidatejob1 = array_slice($candidatejob, $start, $perpage);
       //echo count($candidatejob);
       //echo count($candidatejob1); die();
        if (empty($_GET["total_record"])) {
            $_GET["total_record"] = count($candidatejob);
        }

        $postdata .= '<input type = "hidden" class = "page_number" value = "' . $page . '" />';
        $postdata .= '<input type = "hidden" class = "total_record" value = "' . $_GET["total_record"] . '" />';
        $postdata .= '<input type = "hidden" class = "perpage_record" value = "' . $perpage . '" />';
        

        $postdata .= '<div class = "job-contact-frnd ">';
        if ($candidatejob) {
            foreach ($candidatejob1 as $row) {

                $postdata .= '<div class="profile-job-post-detail clearfix">';
                $postdata .= '<div class = "profile-job-post-title-inside clearfix">';
                $postdata .= '<div class = "profile-job-profile-button clearfix">';
                $postdata .= '<div id = "popup1" class = "overlay">';
                $postdata .= '<div class = "popup">';
                $postdata .= '<div class = "pop_content">';
                $postdata .= 'Your User is Successfully Saved.';
                $postdata .= '<p class = "okk"><a class = "okbtn" href = "#">Ok</a></p>';
                $postdata .= '</div>';
                $postdata .= '</div>';
                $postdata .= '</div>';
                $postdata .= '<div class = "profile-job-post-location-name-rec">';
                $postdata .= '<div style = "display: inline-block; float: left;">';
                $postdata .= '<div class = "buisness-profile-pic-candidate">';

                $imagee = $this->config->item('job_profile_thumb_upload_path') . $row['job_user_image'];

                if (file_exists($imagee) && $row['job_user_image'] != '') {

                    $postdata .= '<a href="' . base_url() . 'job/job_printpreview/' . $row['iduser'] . '?page=recruiter" title="' . $row['fname'] . ' ' . $row['lname'] . '">';
                    $postdata .= '<img src="' . base_url($this->config->item('job_profile_thumb_upload_path')) . $row['job_user_image'] . '" alt="' . $row[0]['fname'] . ' ' . $row[0]['lname'] . '">';
                    $postdata .= '</a>';
                } else {


                    $a = $row['fname'];
                    $acr = substr($a, 0, 1);

                    $b = $row['lname'];
                    $acr1 = substr($b, 0, 1);

                    $postdata .= '<div class="post-img-profile">';
                    $postdata .= '' . ucfirst(strtolower($acr)) . ucfirst(strtolower($acr1)) . '';

                    $postdata .= '</div>';
                }

                $postdata .= '</div>';
                $postdata .= '</div>';

                $postdata .= '<div class="designation_rec fl">';
                $postdata .= '<ul>';
                $postdata .= '<li>';
                $postdata .= '<a  class="post_name" href="' . base_url() . 'job/job_printpreview/' . $row['iduser'] . '?page=recruiter" title="' . $row['fname'] . ' ' . $row['lname'] . '">';
                $postdata .= '' . ucfirst(strtolower($row['fname'])) . ' ' . ucfirst(strtolower($row['lname'])) . '</a>';
                $postdata .= '</li>';

                $postdata .= '<li style="display: block;">';
                $postdata .= '<a  class="post_designation" href="javascript:void(0)" title="' . $row['designation'] . '">';
                if ($row['designation']) {
                    $postdata .= '' . $row['designation'] . '';
                } else {
                    $postdata .= "Current Work";
                }
                $postdata .= '</a>';
                $postdata .= '</li>';
                $postdata .= '</ul>';
                $postdata .= '</div>';
                $postdata .= '</div>';
                $postdata .= '</div>';
                $postdata .= '</div>';

                $contition_array = array('user_id' => $row['iduser'], 'type' => 3, 'status' => 1);
                unset($other_skill);

                $other_skill = $this->common->select_data_by_condition('skill', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
                $postdata .= '<div class="profile-job-post-title clearfix">';
                $postdata .= '<div class="prof`ile-job-profile-menu">';
                $postdata .= '<ul class="clearfix">';

                if ($row['work_job_title']) {
                    $contition_array = array('status' => 'publish', 'title_id' => $row['work_job_title']);
                    $jobtitle = $this->common->select_data_by_condition('job_title', $contition_array, $data = 'name', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
                    $postdata .= '<li> <b> Job Title</b> <span>';
                    $postdata .= '' . $jobtitle[0]['name'] . '';
                    $postdata .= '</span>';
                    $postdata .= '</li>';
                }
                if ($row['keyskill']) {
                    $detailes = array();
                    $work_skill = explode(',', $row['keyskill']);
                    foreach ($work_skill as $skill) {
                        $contition_array = array('skill_id' => $skill);
                        $skilldata = $this->common->select_data_by_condition('skill', $contition_array, $data = 'skill_id,skill', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str5 = '', $groupby = '');
                        $detailes[] = $skilldata[0]['skill'];
                    }
                    $postdata .= '<li> <b> Skills</b> <span>';
                    $postdata .= '' . implode(',', $detailes) . '';
                    $postdata .= '</span>';
                    $postdata .= '</li>';
                }
                if ($row['work_job_industry']) {
                    $contition_array = array('industry_id' => $row['work_job_industry']);
                    $industry = $this->common->select_data_by_condition('job_industry', $contition_array, $data = 'industry_name', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
                    $postdata .= '<li> <b> Industry</b> <span>';
                    $postdata .= '' . $industry[0]['industry_name'] . '';
                    $postdata .= '</span>';
                    $postdata .= '</li>';
                }

                if ($row['work_job_city']) {
                    $cities = array();
                    $work_city = explode(',', $row['work_job_city']);
                    foreach ($work_city as $city) {
                        $contition_array = array('city_id' => $city);
                        $citydata = $this->common->select_data_by_condition('cities', $contition_array, $data = 'city_id,city_name', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str5 = '', $groupby = '');
                        if ($citydata) {
                            $cities[] = $citydata[0]['city_name'];
                        }
                    }
                    $postdata .= '<li> <b> Preferred Cites</b> <span>';
                    $postdata .= '' . implode(',', $cities) . '';
                    $postdata .= '</span>';
                    $postdata .= '</li>';
                }
                $contition_array = array('user_id' => $row['iduser'], 'experience' => 'Experience', 'status' => '1');
                $experiance = $this->common->select_data_by_condition('job_add_workexp', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
                if ($experiance[0]['experience_year'] != '') {
                    $total_work_year = 0;
                    $total_work_month = 0;
                    foreach ($experiance as $work1) {
                        $total_work_year += $work1['experience_year'];
                        $total_work_month += $work1['experience_month'];
                    }
                    $postdata .= '<li> <b> Total Experience</b>';
                    $postdata .= '<span>';
                    if ($total_work_month == '12 month' && $total_work_year == '0 year') {
                        $postdata .= '1 year';
                    } else {
                        $month = explode(' ', $total_work_year);
                        $year = $month[0];
                        $y = 0;
                        for ($i = 0; $i <= $y; $i++) {
                            if ($total_work_month >= 12) {
                                $year = $year + 1;
                                $total_work_month = $total_work_month - 12;
                                $y++;
                            } else {
                                $y = 0;
                            }
                        }
                        $postdata .= '' . $year . '';
                        $postdata .= '"&nbsp"';
                        $postdata .= '"Year"';
                        $postdata .= '"&nbsp"';
                        if ($total_work_month != 0) {
                            $postdata .= '' . $total_work_month . '';
                            $postdata .= '"&nbsp"';
                            $postdata .= '"Month"';
                        }
                    }
                    $postdata .= '</li>';
                } else {
                    if ($row['experience'] == 'Fresher') {
                        $postdata .= '<li> <b> Total Experience</b>';
                        $postdata .= '<span>' . $row['experience'] . '</span>';
                        $postdata .= '</li>';
                    } //if complete
                }//else complete

                if ($row['board_primary'] && $row['board_secondary'] && $row['board_higher_secondary'] && $row['degree']) {
                    $postdata .= '<li>';
                    $postdata .= '<b>Degree</b><span>';
                    $cache_time = $this->db->get_where('degree', array('degree_id' => $row['degree']))->row()->degree_name;
                    if ($cache_time) {
                        $postdata .= '' . $cache_time . '';
                    } else {
                        $postdata .= '' . PROFILENA . '';
                    }
                    $postdata .= '</span>';
                    $postdata .= '</li>';
                    $postdata .= '<li><b>Stream</b>';
                    $postdata .= '<span>';
                    $cache_time = $this->db->get_where('stream', array('stream_id' => $row['stream']))->row()->stream_name;
                    if ($cache_time) {
                        $postdata .= '' . $cache_time . '';
                    } else {
                        $postdata .= '' . PROFILENA . '';
                    }
                    $postdata .= '</span>';
                    $postdata .= '</li>';
                } elseif ($row['board_secondary'] && $row['board_higher_secondary'] && $row['degree']) {
                    $postdata .= '<li>';
                    $postdata .= '<b>Degree</b><span>';
                    $cache_time = $this->db->get_where('degree', array('degree_id' => $row['degree']))->row()->degree_name;
                    if ($cache_time) {
                        $postdata .= '' . $cache_time . '';
                    } else {
                        $postdata .= '' . PROFILENA . '';
                    }

                    $postdata .= '</span>';
                    $postdata .= '</li>';
                    $postdata .= '<li><b>Stream</b>';
                    $postdata .= '<span>';

                    $cache_time = $this->db->get_where('stream', array('stream_id' => $row['stream']))->row()->stream_name;
                    if ($cache_time) {
                        $postdata .= '' . $cache_time . '';
                    } else {
                        $postdata .= '' . PROFILENA . '';
                    }
                    $postdata .= '</span>';
                    $postdata .= '</li>';
                } elseif ($row['board_higher_secondary'] && $row['degree']) {

                    $postdata .= '<li>';
                    $postdata .= '<b>Degree</b><span>';
                    $cache_time = $this->db->get_where('degree', array('degree_id' => $row['degree']))->row()->degree_name;
                    if ($cache_time) {
                        $postdata .= '' . $cache_time . '';
                    } else {
                        $postdata .= '' . PROFILENA . '';
                    }
                    $postdata .= '</span>';
                    $postdata .= '</li>';
                    $postdata .= '<li><b>Stream</b>';
                    $postdata .= '<span>';
                    $cache_time = $this->db->get_where('stream', array('stream_id' => $row['stream']))->row()->stream_name;
                    if ($cache_time) {
                        $postdata .= '' . $cache_time . '';
                    } else {
                        $postdata .= '' . PROFILENA . '';
                    }
                    $postdata .= '</span>';
                    $postdata .= '</li>';
                } else if ($row['board_secondary'] && $row['degree']) {
                    $postdata .= '<li>';
                    $postdata .= '<b>Degree</b><span>';
                    $cache_time = $this->db->get_where('degree', array('degree_id' => $row['degree']))->row()->degree_name;
                    if ($cache_time) {
                        $postdata .= '' . $cache_time . '';
                    } else {
                        $postdata .= '' . PROFILENA . '';
                    }

                    $postdata .= '</span>';
                    $postdata .= '</li>';
                    $postdata .= '<li><b>Stream</b>';
                    $postdata .= '<span>';
                    $cache_time = $this->db->get_where('stream', array('stream_id' => $row['stream']))->row()->stream_name;
                    if ($cache_time) {
                        $postdata .= '' . $cache_time . '';
                    } else {
                        $postdata .= '' . PROFILENA . '';
                    }
                    $postdata .= '</span>';
                    $postdata .= '</li>';
                } elseif ($row['board_primary'] && $row['degree']) {
                    $postdata .= '<li>';
                    $postdata .= '<b>Degree</b><span>';
                    $cache_time = $this->db->get_where('degree', array('degree_id' => $row['degree']))->row()->degree_name;
                    if ($cache_time) {
                        $postdata .= '' . $cache_time . '';
                    } else {
                        $postdata .= '' . PROFILENA . '';
                    }
                    $postdata .= '</span>';
                    $postdata .= '</li>';
                    $postdata .= '<li><b>Stream</b>';
                    $postdata .= '<span>';
                    $cache_time = $this->db->get_where('stream', array('stream_id' => $row['stream']))->row()->stream_name;
                    if ($cache_time) {
                        $postdata .= '' . $cache_time . '';
                    } else {
                        $postdata .= '' . PROFILENA . '';
                    }
                    $postdata .= '</span>';
                    $postdata .= '</li>';
                } elseif ($row['board_primary'] && $row['board_secondary'] && $row['board_higher_secondary']) {
                    $postdata .= '<li><b>Board of Higher Secondary</b>';
                    $postdata .= '<span>';
                    $postdata .= '' . $row['board_higher_secondary'] . '';
                    $postdata .= '</span>';
                    $postdata .= '</li>';
                    $postdata .= '<li><b>Percentage of Higher Secondary</b>';
                    $postdata .= '<span>';
                    $postdata .= '' . $row['percentage_higher_secondary'] . '';
                    $postdata .= '</span>';
                    $postdata .= '</li>';
                } elseif ($row['board_secondary'] && $row['board_higher_secondary']) {
                    $postdata .= '<li><b>Board of Higher Secondary</b>';
                    $postdata .= '<span>';
                    $postdata .= '' . $row['board_higher_secondary'] . '';
                    $postdata .= '</span>';
                    $postdata .= '</li>';
                    $postdata .= '<li><b>Percentage of Higher Secondary</b>';
                    $postdata .= '<span>';
                    $postdata .= '' . $row['percentage_higher_secondary'] . '';
                    $postdata .= '</span>';
                    $postdata .= '</li>';
                } elseif ($row['board_primary'] && $row['board_higher_secondary']) {


                    $postdata .= '<li><b>Board of Higher Secondary</b>';
                    $postdata .= '<span>';
                    $postdata .= '' . $row['board_higher_secondary'] . '';
                    $postdata .= '</span>';
                    $postdata .= '</li>';
                    $postdata .= '<li><b>Percentage of Higher Secondary</b>';
                    $postdata .= '<span>';
                    $postdata .= '' . $row['percentage_higher_secondary'] . '';
                    $postdata .= '</span>';
                    $postdata .= '</li>';
                } elseif ($row['board_primary'] && $row['board_secondary']) {

                    $postdata .= '<li><b>Board of Secondary</b>';
                    $postdata .= '<span>';
                    $postdata .= '' . $row['board_secondary'] . '';
                    $postdata .= '</span>';
                    $postdata .= '</li>';
                    $postdata .= '<li><b>Percentage of Secondary</b>';
                    $postdata .= '<span>';
                    $postdata .= '' . $row['percentage_secondary'] . '';
                    $postdata .= '</span>';
                    $postdata .= '</li>';
                } elseif ($row['degree']) {
                    $postdata .= '<li>';
                    $postdata .= '<b>Degree</b><span>';
                    $cache_time = $this->db->get_where('degree', array('degree_id' => $row['degree']))->row()->degree_name;
                    if ($cache_time) {
                        $postdata .= '' . $cache_time . '';
                    } else {
                        $postdata .= '' . PROFILENA . '';
                    }

                    $postdata .= '</span>';
                    $postdata .= '</li>';
                    $postdata .= '<li><b>Stream</b>';
                    $postdata .= '<span>';
                    $cache_time = $this->db->get_where('stream', array('stream_id' => $row['stream']))->row()->stream_name;
                    if ($cache_time) {
                        $postdata .= '' . $cache_time . '';
                    } else {
                        $postdata .= '' . PROFILENA . '';
                    }
                    $postdata .= '</span>';
                    $postdata .= '</li>';
                } elseif ($row['board_higher_secondary']) {

                    $postdata .= '<li><b>Board of Higher Secondary</b>';
                    $postdata .= '<span>';
                    $postdata .= '' . $row['board_higher_secondary'] . '';
                    $postdata .= '</span>';
                    $postdata .= '</li>';
                    $postdata .= '<li><b>Percentage of Higher Secondary</b>';
                    $postdata .= '<span>';
                    $postdata .= '' . $row['percentage_higher_secondary'] . '';
                    $postdata .= '</span>';
                    $postdata .= '</li>';
                } elseif ($row['board_secondary']) {

                    $postdata .= '<li><b>Board of Secondary</b>';
                    $postdata .= '<span>';
                    $postdata .= '' . $row['board_secondary'] . '';
                    $postdata .= '</span>';
                    $postdata .= '</li>';
                    $postdata .= '<li><b>Percentage of Secondary</b>';
                    $postdata .= '<span>';
                    $postdata .= '' . $row['percentage_secondary'] . '';
                    $postdata .= '</span>';
                    $postdata .= '</li>';
                } elseif ($row['board_primary']) {

                    $postdata .= '<li><b>Board of Primary</b>';
                    $postdata .= '<span>';
                    $postdata .= '' . $row['board_primary'] . '';
                    $postdata .= '</span>';
                    $postdata .= '</li>';
                    $postdata .= '<li><b>Percentage of Primary</b>';
                    $postdata .= '<span>';
                    $postdata .= '' . $row['percentage_primary'] . '';
                    $postdata .= '</span>';
                    $postdata .= '</li>';
                }
                $postdata .= '<li><b>E-mail</b><span>';
                if ($row['email']) {
                    $postdata .= '' . $row['email'] . '';
                } else {
                    $postdata .= '' . PROFILENA . '';
                }
                $postdata .= '</span>';
                $postdata .= '</li>';

                if ($row['phnno']) {
                    $postdata .= '<li><b>Mobile Number</b><span>';
                    $postdata .= '' . $row['phnno'] . '';
                    $postdata .= '</span>';
                    $postdata .= '</li>';
                }
                $postdata .= '</ul>';
                $postdata .= '</div>';
                $postdata .= '<div class="profile-job-profile-button clearfix">';
                $postdata .= '<div class="apply-btn fr">';
                $userid = $this->session->userdata('aileenuser');
                $contition_array = array('from_id' => $userid, 'to_id' => $row['iduser'], 'save_type' => 1, 'status' => '0');
                $data = $this->common->select_data_by_condition('save', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

                if ($userid != $row['iduser']) {
                    if (!$data) {

                        $postdata .= '<a href="' . base_url() . 'chat/abc/2/1/' . $row['iduser'] . '">Message</a>';


                        $postdata .= '<input type="hidden" id="hideenuser' . $row['iduser'] . '" value= "' . $data[0]['save_id'] . '">';

                        $postdata .= '<a id="' . $row['iduser'] . '" onClick="savepopup(' . $row['iduser'] . ')" href="javascript:void(0);" class="saveduser' . $row['iduser'] . '">Save</a>';
                    } else {
                        $postdata .= '<a href="' . base_url() . 'chat/abc/2/1/' . $row['iduser'] . '">Message</a>';
                        $postdata .= '<a class="saved">Saved</a>';
                    }
                }

                $postdata .= '</div> </div>';

                $postdata .= '</div>';
                $postdata .= '</div>';
            }
        } elseif ($recruiterdata == NULL) {
            $postdata .= '<div class="text-center rio" style="border: none;">';
            $postdata .= '<div class="no-post-title">';
            $postdata .= '<h4 class="page-heading  product-listing" style="border:0px;">Lets create your job post.</h4>';
            $postdata .= '<h4 class="page-heading  product-listing" style="border:0px;"> It will takes only few minutes.</h4>';
            $postdata .= '</div>';
            $postdata .= '<div  class="add-post-button add-post-custom">';
            $postdata .= '<a class="btn btn-3 btn-3b"  href="' . base_url() . 'recruiter/add_post"><i class="fa fa-plus" aria-hidden="true"></i>  Post a Job</a>';
            $postdata .= '</div>';
            $postdata .= '</div>';
        } else {
            $postdata .= '<div class="art-img-nn">';
            $postdata .= '    <div class="art_no_post_img">';
            $postdata .= '<img src="' . base_url() . 'img/job-no1.png">';

            $postdata .= '</div>';
            $postdata .= '<div class="art_no_post_text">';
            $postdata .= 'No Recommended  Candidate  Available.';
            $postdata .= '</div>';
            $postdata .= '</div>';
        }
        $postdata .= '<div class="col-md-1">';
        $postdata .= '</div>';
        $postdata .= '</div>';
        echo $postdata;
    }

// RECOMMANDED CANDIDATE AJAX LAZZY LOADER DATA START
}
