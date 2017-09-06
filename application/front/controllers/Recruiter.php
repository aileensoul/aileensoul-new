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
// CITY SEARCH DATA START
//        $contition_array = array('status' => '1');
//        $cty = $this->data['cty'] = $this->common->select_data_by_condition('cities', $contition_array, $data = 'city_name', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);
//
//                                                                        foreach ($cty as $key => $value) {
//            foreach ($value as $ke => $val) {
//                if ($val != "") {
//                    $resu[] = $val;
//                }
//            }
//        }
//        $resul = array_unique($resu);
//        foreach ($resul as $key => $value) {
//            $res[$key]['label'] = $value;
//            $res[$key]['value'] = $value;
//        }
//
//        $this->data['de'] = array_values($res);
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
        $recpostdata = $this->data['recpostdata'] = $this->common->select_data_by_condition('rec_post', $contition_array, $data = 'post_skill', $sortby = '', $orderby = 'DESC', $limit = '', $offset = '', $join_str = array(), $groupby = '');

//FETCH RECRUITER DATA

        $contition_array = array('user_id' => $userid, 'is_delete' => 0, 're_status' => 1);
        $this->data['recdata'] = $this->common->select_data_by_condition('recruiter', $contition_array, $data = 'rec_id,rec_firstname,rec_lastname,designation,recruiter_user_image,profile_background,re_step', $sortby = '', $orderby = 'DESC', $limit = '', $offset = '', $join_str = array(), $groupby = '');

//FETCH SKILL DATA

        $contition_array = array('user_id' => $userid, 'type' => '4', 'status' => 1);
        $skillotherdata = $this->data['skillotherdata'] = $this->common->select_data_by_condition('skill', $contition_array, $data = 'skill', $sortby = '', $orderby = 'DESC', $limit = '', $offset = '', $join_str = array(), $groupby = '');

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

//
//            $join_str[0]['table'] = 'recruiter';
//            $join_str[0]['join_table_id'] = 'recruiter.user_id';
//            $join_str[0]['from_table_id'] = 'rec_post.user_id';
//            $join_str[0]['join_type'] = '';
//
//
//            $contition_array = array('rec_post.user_id' => $userid, 'rec_post.is_delete' => 0);
//            $this->data['postdata'] = $this->common->select_data_by_condition('rec_post', $contition_array, $data = 'rec_post.*,recruiter.rec_firstname,recruiter.re_comp_name,recruiter.rec_lastname,recruiter.recruiter_user_image,recruiter.profile_background,recruiter.re_comp_profile', $sortby = 'post_id', $orderby = 'desc', $limit = '', $offset = '', $join_str, $groupby = '');
        } else {
            $this->rec_avail_check($id);

            $contition_array = array('user_id' => $id, 'is_delete' => 0, 're_step' => 3);
            $this->data['postdataone'] = $this->common->select_data_by_condition('recruiter', $contition_array, $data = 'rec_id,rec_firstname,rec_lastname,recruiter_user_image,profile_background,designation', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str, $groupby = '');

//            $join_str[0]['table'] = 'recruiter';
//            $join_str[0]['join_table_id'] = 'recruiter.user_id';
//            $join_str[0]['from_table_id'] = 'rec_post.user_id';
//            $join_str[0]['join_type'] = '';
//
//            $contition_array = array('rec_post.user_id' => $id, 'rec_post.is_delete' => 0, 'recruiter.re_step' => 3);
//            $this->data['postdata'] = $this->common->select_data_by_condition('rec_post', $contition_array, $data = 'rec_post.*,recruiter.rec_firstname,recruiter.re_comp_name,recruiter.rec_lastname,recruiter.recruiter_user_image,recruiter.profile_background,recruiter.re_comp_profile', $sortby = 'post_id', $orderby = 'desc', $limit = '', $offset = '', $join_str, $groupby = '');
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
        $data = "rec_id,user_id,rec_firstname,rec_lastname,rec_email,rec_phone,re_comp_name,re_comp_email,re_comp_phone,re_comp_site,re_comp_country,re_comp_state,re_comp_city,re_comp_profile,re_comp_sector,re_comp_activities,comp_logo,recruiter_user_image,profile_background,re_step";
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
        $candidatejob = $this->data['candidatejob'] = $new;

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
                $postdata .= '<div class="profile-job-profile-menu">';
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
        //      $postdata .= '</div>';
        echo $postdata;
    }

// RECOMMANDED CANDIDATE AJAX LAZZY LOADER DATA START
// RECRUITER POST AJAX LAZZY LOADER DATA START
    public function ajax_rec_post() {

// LAZY LOADER CODE START
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

        if ($id == $userid || $id == '') {
            $this->recruiter_apply_check();

            $contition_array = array('user_id' => $userid, 'is_delete' => 0);
            $postdataone = $this->common->select_data_by_condition('recruiter', $contition_array, $data = 'rec_id,rec_firstname,rec_lastname,recruiter_user_image,profile_background,designation', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str, $groupby = '');

            $limit = $perpage;
            $offset = $start;

            $join_str[0]['table'] = 'recruiter';
            $join_str[0]['join_table_id'] = 'recruiter.user_id';
            $join_str[0]['from_table_id'] = 'rec_post.user_id';
            $join_str[0]['join_type'] = '';

            $data = 'post_id,post_name,post_description,post_skill,post_position,interview_process,min_sal,max_sal,max_month,max_year,fresher,degree_name,industry_type,emp_type,rec_post.created_date,rec_post.user_id,recruiter.rec_firstname,recruiter.re_comp_name,recruiter.rec_lastname,recruiter.recruiter_user_image,recruiter.profile_background,recruiter.re_comp_profile';

            $contition_array = array('rec_post.user_id' => $userid, 'rec_post.is_delete' => 0);
            $rec_postdata = $this->common->select_data_by_condition('rec_post', $contition_array, $data, $sortby = 'post_id', $orderby = 'desc', $limit, $offset, $join_str, $groupby = '');
            $rec_postdata1 = $this->common->select_data_by_condition('rec_post', $contition_array, $data, $sortby = 'post_id', $orderby = 'desc', $limit = '', $offset = '', $join_str, $groupby = '');
        } else {
            $this->rec_avail_check($id);

            $contition_array = array('user_id' => $id, 'is_delete' => 0, 're_step' => 3);
            $postdataone = $this->common->select_data_by_condition('recruiter', $contition_array, $data = 'rec_id,rec_firstname,rec_lastname,recruiter_user_image,profile_background,designation', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str, $groupby = '');

            $limit = $perpage;
            $offset = $start;

            $join_str[0]['table'] = 'recruiter';
            $join_str[0]['join_table_id'] = 'recruiter.user_id';
            $join_str[0]['from_table_id'] = 'rec_post.user_id';
            $join_str[0]['join_type'] = '';

            $data = 'post_id,post_name,post_description,post_skill,post_position,interview_process,min_sal,max_sal,max_month,max_year,fresher,degree_name,industry_type,emp_type,rec_post.created_date,rec_post.user_id,recruiter.rec_firstname,recruiter.re_comp_name,recruiter.rec_lastname,recruiter.recruiter_user_image,recruiter.profile_background,recruiter.re_comp_profile';
            $contition_array = array('rec_post.user_id' => $id, 'rec_post.is_delete' => 0, 'recruiter.re_step' => 3);
            $rec_postdata = $this->common->select_data_by_condition('rec_post', $contition_array, $data, $sortby = 'post_id', $orderby = 'desc', $limit, $offset, $join_str, $groupby = '');
            $rec_postdata1 = $this->common->select_data_by_condition('rec_post', $contition_array, $data, $sortby = 'post_id', $orderby = 'desc', $limit = '', $offset = '', $join_str, $groupby = '');
        }

        $rec_post = "";

        if (empty($_GET["total_record"])) {
            $_GET["total_record"] = count($rec_postdata1);
        }

        $rec_post .= '<input type = "hidden" class = "page_number" value = "' . $page . '" />';
        $rec_post .= '<input type = "hidden" class = "total_record" value = "' . $_GET["total_record"] . '" />';
        $rec_post .= '<input type = "hidden" class = "perpage_record" value = "' . $perpage . '" />';

// LAZY LOADER CODE END
        // code start
        $returnpage = $_GET['page'];
        if (count($rec_postdata1) > 0) {
            if ($returnpage == 'job') {
                if (count($rec_postdata) != '') {
                    foreach ($rec_postdata as $post) {
//                    $rec_post .= '<div class="job-contact-frnd ">';
                        $rec_post .= '<div class="profile-job-post-detail clearfix" id="removepost"' . $post['post_id'] . '">';
                        $rec_post .= '<div class="profile-job-post-title clearfix">';
                        $rec_post .= '<div class="profile-job-profile-button clearfix">';
                        $rec_post .= '<div class="profile-job-details col-md-12">';
                        $rec_post .= '<ul>';
                        $rec_post .= '<li class="fr date_re">';
                        $rec_post .= 'Created Date : ' . date('d-M-Y', strtotime($post['created_date'])) . '';
                        $rec_post .= '</li>
                             <li class="">
                             <a class="post_title" href="javascript:void(0)" title="Post Title">';
                        $cache_time = $this->db->get_where('job_title', array('title_id' => $post['post_name']))->row()->name;
                        if ($cache_time) {
                            $rec_post .= '' . $cache_time . '';
                        } else {
                            $rec_post .= '' . $post['post_name'] . '';
                        }
                        $rec_post .= '</a> </li><li>';
                        $cityname = $this->db->get_where('cities', array('city_id' => $post['city']))->row()->city_name;
                        $countryname = $this->db->get_where('countries', array('country_id' => $post['country']))->row()->country_name;
                        if ($cityname || $countryname) {
                            $rec_post .= '<div class="fr lction">';
                            $rec_post .= '<p title="Location"><i class="fa fa-map-marker" aria-hidden="true"></i>';

                            if ($cityname) {
                                $rec_post .= '' . $cityname . ', ';
                            }

                            $rec_post .= '' . $countryname . '';
                            $rec_post .= '</p>
                                                                            </div>';
                        }

                        $rec_post .= '<a class="display_inline" title="' . $post['re_comp_name'] . '" href="javascript:void(0)">';

                        $out = strlen($post['re_comp_name']) > 40 ? substr($post['re_comp_name'], 0, 40) . "..." : $post['re_comp_name'];
                        $rec_post .= '' . $out . '';
                        $rec_post .= '</a></li>';
                        $rec_post .= '<li class="fw"><a class="display_inline" title="Recruiter Name" href="javascript:void(0)">';
                        $rec_post .= '' . ucfirst(strtolower($post['rec_firstname'])) . '' . ucfirst(strtolower($post['rec_lastname'])) . '</a></li>';
                        $rec_post .= '</ul></div></div>';
                        $rec_post .= '<div class="profile-job-profile-menu">';
                        $rec_post .= '<ul class="clearfix"><li> <b> Skills</b> <span>';

                        $comma = ", ";
                        $k = 0;
                        $aud = $post['post_skill'];
                        $aud_res = explode(',', $aud);
                        if (!$post['post_skill']) {
                            $rec_post .= '' . $post['other_skill'] . '';
                        } else if (!$post['other_skill']) {
                            foreach ($aud_res as $skill) {
                                $cache_time = $this->db->get_where('skill', array('skill_id' => $skill))->row()->skill;
                                if ($cache_time != " ") {
                                    if ($k != 0) {
                                        $rec_post .= '' . $comma . '';
                                    }
                                    $rec_post .= '' . $cache_time . '';
                                    $k++;
                                }
                            }
                        } else if ($post['post_skill'] && $post['other_skill']) {
                            foreach ($aud_res as $skill) {
                                if ($k != 0) {
                                    $rec_post .= '' . $comma . '';
                                }
                                $cache_time = $this->db->get_where('skill', array('skill_id' => $skill))->row()->skill;
                                $rec_post .= '' . $cache_time . '';
                                $k++;
                            } $rec_post .= '","' . $post['other_skill'] . '';
                        }

                        $rec_post .= '</span>
                                                                </li>
                                                                <li><b>Job Description</b><span><pre>';
                        $rec_post .= '' . $this->common->make_links($post['post_description']) . '</pre></span>';
                        $rec_post .= '</li>
                                                                <li><b>Interview Process</b><span>';
                        if ($post['interview_process'] != '') {

                            $rec_post .= '' . $this->common->make_links($post['interview_process']) . '';
                        } else {
                            $rec_post .= '' . PROFILENA . '';
                        }

                        $rec_post .= '</span></li>';


                        $rec_post .= '<li>   <b>Required Experience</b></li>
               <li><b>Salary</b><span title="Min - Max" >';
                        $currency = $this->db->get_where('currency', array('currency_id' => $post['post_currency']))->row()->currency_name;
                        if ($post['min_sal'] || $post['max_sal']) {
                            $rec_post .= '' . $post['min_sal'] . " - " . $post['max_sal'] . ' ' . $currency . ' ' . $post['salary_type'] . '';
                        } else {
                            $rec_post .= '' . PROFILENA . '';
                        }

                        $rec_post .= '</span></li><li><b>No of Position</b><span>' . $post['post_position'] . ' ' . 'Position</span> </li>
                                                                <li><b>Industry Type</b> <span>';

                        $cache_time = $this->db->get_where('job_industry', array('industry_id' => $post['industry_type']))->row()->industry_name;
                        $rec_post .= '' . $cache_time . '';

                        $rec_post .= '</span> </li>';



                        if ($post['degree_name'] != '' || $post['other_education'] != '') {

                            $rec_post .= '<li> <b>Education Required</b> <span>';
                            $comma = ", ";
                            $k = 0;
                            $edu = $post['degree_name'];
                            $edu_nm = explode(',', $edu);

                            if (!$post['degree_name']) {

                                $rec_post .= '' . $post['other_education'] . '';
                            } else if (!$post['other_education']) {
                                foreach ($edu_nm as $edun) {
                                    if ($k != 0) {
                                        $rec_post .= '' . $comma . '';
                                    }
                                    $cache_time = $this->db->get_where('degree', array('degree_id' => $edun))->row()->degree_name;


                                    $rec_post .= '' . $cache_time . '';
                                    $k++;
                                }
                            } else if ($post['degree_name'] && $post['other_education']) {
                                foreach ($edu_nm as $edun) {
                                    if ($k != 0) {
                                        $rec_post .= '' . $comma . '';
                                    }
                                    $cache_time = $this->db->get_where('degree', array('degree_id' => $edun))->row()->degree_name;


                                    $rec_post .= '' . $cache_time . '';
                                    $k++;
                                } $rec_post .= '","' . $post['other_education'] . '';
                            }


                            $rec_post .= '</span>
                                                                 </li>';
                        } else {

                            $rec_post .= '<li><b>Education Required</b><span>';
                            $rec_post .= PROFILENA;
                            $rec_post .= '</span>
                                                                    </li>';
                        }
                        $rec_post .= '<li><b>Employment Type</b><span>';
                        if ($post['emp_type'] != '') {
                            $rec_post .= '<pre>';
                            $rec_post .= $this->common->make_links($post['emp_type']) . 'Job</pre>';
                        } else {
                            $rec_post .= PROFILENA;
                        }
                        $rec_post .= '</span></li><li><b>Company Profile</b><span>';
                        if ($post['re_comp_profile'] != '') {
                            $rec_post .= '<pre>';
                            $rec_post .= $this->common->make_links($post['re_comp_profile']) . '</pre>';
                        } else {
                            $rec_post .= PROFILENA;
                        }


                        $rec_post .= '</span></li></ul></div>
                             <div class="profile-job-profile-button clearfix">
                    <div class="profile-job-details col-md-12">';

                        $this->data['userid'] = $userid = $this->session->userdata('aileenuser');

                        $contition_array = array('post_id' => $post['post_id'], 'job_delete' => 0, 'user_id' => $userid);
                        $jobapply = $this->data['jobsave'] = $this->common->select_data_by_condition('job_apply', $contition_array, $data = '*', $sortby = '', $orderby = 'desc', $limit = '', $offset = '', $join_str = array(), $groupby = '');

                        if ($jobapply) {


                            $rec_post .= '<a href="javascript:void(0);" class="button applied">Applied</a>';
                        } else {
                            $rec_post .= '<li class="fr">';
                            $rec_post .= '<a href="javascript:void(0);"  class= "applypost' . $post['post_id'] . 'button" onclick="applypopup(' . $post['post_id'] . ',' . $post['user_id'] . ')">Apply</a>';
                            $rec_post .= '</li><li class="fr">';
                            $userid = $this->session->userdata('aileenuser');
                            $contition_array = array('user_id' => $userid, 'job_save' => '2', 'post_id ' => $post['post_id'], 'job_delete' => '1');
                            $jobsave = $this->data['jobsave'] = $this->common->select_data_by_condition('job_apply', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

                            if ($jobsave) {

                                $rec_post .= '<a class="button saved">Saved</a>';
                            } else {
                                $rec_post .= '<a id="' . $post['post_id'] . '" onClick="savepopup(' . $post['post_id'] . ')" href="javascript:void(0);" class="savedpost' . $post['post_id'] . 'button">Save</a>';
                            }
                            $rec_post .= '</li>';
                        }
                        $rec_post .= '</div>
                                                        </div>
                                                    </div>
                                                </div>';
                        //</div>';
                    }
                } else {


                    $rec_post .= '<div class="art-img-nn">
                                            <div class="art_no_post_img">

                                                <img src="' . base_url('img/job-no.png') . '">

                                            </div>
                                            <div class="art_no_post_text">
                                                No  Post Available.
                                            </div>
                                        </div>';
                }
            } else {

                if (count($rec_postdata) != '') {

                    foreach ($rec_postdata as $post) {


                        // $rec_post .= '<div class="job-contact-frnd ">
                        $rec_post .= '<div class="profile-job-post-detail clearfix" id="removepost' . $post['post_id'] . '">';
                        $rec_post .= '<div class="profile-job-post-title clearfix">
                                                        <div class="profile-job-profile-button clearfix">
                                                            <div class="profile-job-details col-md-12">
                                                                <ul>
                                                                    <li class="fr date_re">';
                        $rec_post .= 'Created Date :' . date('d-M-Y', strtotime($post['created_date']));
                        $rec_post .= '</li>
                                                                    <li class="">
                                                                        <a class="post_title" href="javascript:void(0)" title="Post Title">';

                        $cache_time = $this->db->get_where('job_title', array('title_id' => $post['post_name']))->row()->name;
                        if ($cache_time) {
                            $rec_post .= $cache_time;
                        } else {
                            $rec_post .= $post['post_name'];
                        }

                        $rec_post .= '</a> 
                                                                    </li>
                                                                    <li>';

                        $cityname = $this->db->get_where('cities', array('city_id' => $post['city']))->row()->city_name;
                        $countryname = $this->db->get_where('countries', array('country_id' => $post['country']))->row()->country_name;


                        if ($cityname || $countryname) {

                            $rec_post .= '<div class="fr lction">
                                                                                <p title="Location"><i class="fa fa-map-marker" aria-hidden="true"></i>';

                            if ($cityname) {
                                $rec_post .= $cityname . ', ';
                            } $rec_post .= $countryname;

                            $rec_post .= '</p>
                                                                            </div>';
                        }
                        $rec_post .= '<a class="display_inline" title="' . $post['re_comp_name'] . '" href="javascript:void(0)">';
                        $out = strlen($post['re_comp_name']) > 40 ? substr($post['re_comp_name'], 0, 40) . "..." : $post['re_comp_name'];
                        $rec_post .= $out;
                        $rec_post .= '</a>';
                        $rec_post .= '</li>
                                                                    <li ><a class="display_inline" title="Recruiter Name" href="javascript:void(0)">';
                        $rec_post .= ucfirst(strtolower($post['rec_firstname'])) . ' ' . ucfirst(strtolower($post['rec_lastname']));
                        $rec_post .= '</a></li></ul></div>
                                                        </div>
                                                        <div class="profile-job-profile-menu">
                                                            <ul class="clearfix">
                                                                <li> <b> Skills</b> <span>';

                        $comma = ", ";
                        $k = 0;
                        $aud = $post['post_skill'];
                        $aud_res = explode(',', $aud);
                        if (!$post['post_skill']) {

                            $rec_post .= $post['other_skill'];
                        } else if (!$post['other_skill']) {


                            foreach ($aud_res as $skill) {

                                $cache_time = $this->db->get_where('skill', array('skill_id' => $skill))->row()->skill;
                                if ($cache_time != " ") {
                                    if ($k != 0) {
                                        $rec_post .= $comma;
                                    }$rec_post .= $cache_time;
                                    $k++;
                                }
                            }
                        } else if ($post['post_skill'] && $post['other_skill']) {
                            foreach ($aud_res as $skill) {
                                if ($k != 0) {
                                    $rec_post .= $comma;
                                }
                                $cache_time = $this->db->get_where('skill', array('skill_id' => $skill))->row()->skill;


                                $rec_post .= $cache_time;
                                $k++;
                            } $rec_post .= '","' . $post['other_skill'];
                        }

                        $rec_post .= '</span>
                                                                </li>
                                                                <li><b>Job Description</b><span><pre>' . $this->common->make_links($post['post_description']) . '</pre></span>
                                                                </li>
                                                                <li><b>Interview Process</b><span>';
                        if ($post['interview_process'] != '') {
                            $rec_post .= '<pre>';
                            $rec_post .= '' . $this->common->make_links($post['interview_process']) . '</pre>';
                        } else {
                            $rec_post .= PROFILENA;
                        }

                        $rec_post .= '</span>
                                                                </li>
                                                                <li>
                                                                    <b>Required Experience</b>
                                                                    <span>
                                                                        <p title="Min - Max">';

                        if (($post['min_year'] != '0' || $post['max_year'] != '0') && ($post['fresher'] == 1)) {


                            $rec_post .= $post['min_year'] . ' Year - ' . $post['max_year'] . ' Year' . " , " . "Fresher can also apply.";
                        } else if (($post['min_year'] != '0' || $post['max_year'] != '0')) {
                            $rec_post .= $post['min_year'] . ' Year - ' . $post['max_year'] . ' Year';
                        } else {
                            $rec_post .= "Fresher";
                        }


                        $rec_post .= '</p>  
                                                                    </span>
                                                                </li>
                                                                <li><b>Salary</b><span title="Min - Max" >';

                        $currency = $this->db->get_where('currency', array('currency_id' => $post['post_currency']))->row()->currency_name;

                        if ($post['min_sal'] || $post['max_sal']) {
                            $rec_post .= $post['min_sal'] . " - " . $post['max_sal'] . ' ' . $currency . ' ' . $post['salary_type'];
                        } else {
                            $rec_post .= PROFILENA;
                        }
                        $rec_post .= '</span> </li> <li><b>No of Position</b><span>';
                        $rec_post .= $post['post_position'] . 'Position</span>
                                                                </li>
                                                                <li><b>Industry Type</b> <span>';

                        $cache_time = $this->db->get_where('job_industry', array('industry_id' => $post['industry_type']))->row()->industry_name;
                        $rec_post .= $cache_time;
                        $rec_post .= '</span> 
                                                                </li>';
                        if ($post['degree_name'] != '' || $post['other_education'] != '') {

                            $rec_post .= '<li> <b>Education Required</b> <span>';

                            $comma = ", ";
                            $k = 0;
                            $edu = $post['degree_name'];
                            $edu_nm = explode(',', $edu);
                            if (!$post['degree_name']) {
                                $rec_post .= '' . $post['other_education'] . '';
                            } else if (!$post['other_education']) {
                                foreach ($edu_nm as $edun) {
                                    if ($k != 0) {
                                        $rec_post .= $comma;
                                    }
                                    $cache_time = $this->db->get_where('degree', array('degree_id' => $edun))->row()->degree_name;
                                    $rec_post .= $cache_time;
                                    $k++;
                                }
                            } else if ($post['degree_name'] && $post['other_education']) {
                                foreach ($edu_nm as $edun) {
                                    if ($k != 0) {
                                        $rec_post .= $comma;
                                    }
                                    $cache_time = $this->db->get_where('degree', array('degree_id' => $edun))->row()->degree_name;
                                    $rec_post .= $cache_time;
                                    $k++;
                                } $rec_post .= "," . $post['other_education'];
                            }

                            $rec_post .= '</span>
                                                                    </li>';
                        } else {


                            $rec_post .= '<li><b>Education Required</b><span>';
                            $rec_post .= PROFILENA;
                            $rec_post .= '</span>
                                                                    </li>';
                        }
                        $rec_post .= '<li><b>Employment Type</b><span>';


                        if ($post['emp_type'] != '') {
                            $rec_post .= '<pre>';
                            $rec_post .= $this->common->make_links($post['emp_type']) . '  Job</pre>';
                        } else {
                            $rec_post .= PROFILENA;
                        }


                        $rec_post .= '</span></li><li><b>Company Profile</b><span>';


                        if ($post['re_comp_profile'] != '') {
                            $rec_post .= '<pre>';
                            $rec_post .= $this->common->make_links($post['re_comp_profile']) . '</pre>';
                        } else {
                            $rec_post .= PROFILENA;
                        }


                        $rec_post .= '</span>
                                                                </li>


                                                            </ul>
                                                        </div>
                                                        <div class="profile-job-profile-button  clearfix" >
                                                            <div class="profile-job-details col-md-12">
                                                                <ul><li class="job_all_post last_date">
                                                                        Last Date :';
                        if ($post['post_last_date'] != "0000-00-00") {
                            $rec_post .= date('d-M-Y', strtotime($post['post_last_date']));
                        } else {
                            $rec_post .= PROFILENA;
                        }
                        $rec_post .= '</li>
                                                                    <li class="fr">';


                        $rec_post .= '<a href="javascript:void(0);" class="button" onclick="removepopup(' . $post['post_id'] . ')">Remove</a>';
                        $rec_post .= '<a href="' . base_url() . 'recruiter/edit_post/' . $post['post_id'] . '" class="button">Edit</a>';
                        $join_str[0]['table'] = 'job_reg';
                        $join_str[0]['join_table_id'] = 'job_reg.user_id';
                        $join_str[0]['from_table_id'] = 'job_apply.user_id';
                        $join_str[0]['join_type'] = '';

                        $condition_array = array('post_id' => $post['post_id'], 'job_apply.job_delete' => '0', 'job_reg.status' => '1', 'job_reg.is_delete' => '0', 'job_reg.job_step' => 10);
                        $data = "job_apply.*,job_reg.job_id";
                        $apply_candida = $this->common->select_data_by_condition('job_apply', $condition_array, $data, $short_by = '', $order_by = '', $limit, $offset, $join_str, $groupby = '');
                        $countt = count($apply_candida);

                        $rec_post .= '<a href="' . base_url() . 'recruiter/view_apply_list/' . $post['post_id'] . '" class="button">Applied  Candidate :' . $countt . '</a>
                                                                    </li>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>';
                        //    </div>';
                    }
                } else {

                    $rec_post .= '<div class="art-img-nn">
                                            <div class="art_no_post_img">
                                                <img src="' . base_url() . 'img/job-no.png">

                                            </div>
                                            <div class="art_no_post_text">
                                                No  Post Available.
                                            </div>
                                        </div>';
                }
            }
        }


        echo $rec_post;
        // code end
    }

// RECRUITER POST AJAX LAZZY LOADER DATA END
// RECRUITER SEARCH START
    public function recruiter_search($searchkeyword = " ", $searchplace = " ") {

        if ($this->input->get('search_submit')) {
            $searchkeyword = $this->input->get('skills');
            $searchplace = $this->input->get('searchplace');
        } else {
            if ($this->uri->segment(3) == "0") {
                $searchplace = urldecode($searchplace);
                $searchkeyword = "";
            } else if ($this->uri->segment(4) == "0") {
                $searchkeyword = urldecode($searchkeyword);
                $searchplace = "";
            } else {
                $searchkeyword = urldecode($searchkeyword);
                $searchplace = urldecode($searchplace);
            }
        }
        $this->data['userid'] = $userid = $this->session->userdata('aileenuser');
        if ($searchkeyword == "" && $searchplace == "") {
            redirect('recruiter/recommen_candidate', refresh);
        }

        $rec_search = trim($searchkeyword, ' ');
        $this->data['keyword'] = $rec_search;
        $search_place = $searchplace;
        $this->data['key_place'] = $searchplace;
        $cache_time = $this->db->get_where('cities', array('city_name' => $search_place))->row()->city_id;
        $this->data['keyword1'] = $search_place;
        $contition_array = array('user_id' => $userid, 'is_delete' => '0', 're_status' => '1');
        $this->data['city'] = $city = $this->common->select_data_by_condition('recruiter', $contition_array, $data = 're_comp_city', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
        $data = array(
            'search_keyword' => $rec_search,
            'search_location' => $search_place,
            'user_location' => $city[0]['re_comp_city'],
            'user_id' => $userid,
            'created_date' => date('Y-m-d h:i:s', time()),
            'status' => 1,
            'module' => '2'
        );
        $insert_id = $this->common->insert_data_getid($data, 'search_info');
        //insert search keyword into database end
        //RECRUITER SEARCH START 1-9
        if ($searchkeyword == "" || $this->uri->segment(3) == "0") {
            //echo "skill search";die();
            $join_str = array(array(
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
            $contition_array = array('job_reg.city_id' => $cache_time, 'job_reg.status' => '1', 'job_reg.user_id !=' => $userid, 'job_reg.job_step' => 10);

            $unique = $this->data['results'] = $this->common->select_data_by_condition('job_reg', $contition_array, $data = 'job_reg.*,job_reg.user_id as iduser,job_add_edu.*,job_graduation.*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str, $groupby = '');
            // echo "<pre>"; print_r($unique);die();
        } elseif ($searchplace == "" || $this->uri->segment(4) == "0") {
            //SKILL DATA FETCH START
            $contition_array = array('is_delete' => '0', 'status' => '1');
            $search_condition = "(skill LIKE '%$rec_search%')";
            $skilldata = $artdata['data'] = $this->common->select_data_by_search('skill', $search_condition, $contition_array = array(), $data = 'skill_id', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');


            //$values = array_map('array_pop', $skillid);
            //$imploded = implode(',', $values);
            //echo $imploded;

            foreach ($skilldata as $key => $value) {
                
                $join_str = array(array(
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
                $contition_array = array('job_reg.status' => '1', 'job_reg.is_delete' => '0', 'job_step' => 10, 'job_reg.user_id != ' => $userid, 'FIND_IN_SET("' . $value['skill_id'] . '", keyskill) != ' => '0');
                $jobskilldata[] = $this->common->select_data_by_condition('job_reg', $contition_array, $data = '*', $sortby = '', $orderby = 'desc', $limit = '', $offset = '', $join_str, $groupby = '');
            }

            $rec_skill = $jobskilldata;
            
            $rec_skill = array_reduce($rec_skill, 'array_merge', array());
            $rec_skill = array_unique($rec_skill, SORT_REGULAR);
            
          
            //SKILL DATA FETCH END
            
            //DEGREE FETCH START
            $contition_array = array('is_delete' => '0', 'status' => '1');
            $search_condition = "(degree_name LIKE '%$rec_search%')";
            $degreedata = $this->common->select_data_by_search('degree', $search_condition, $contition_array = array(), $data = 'degree_id', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');


            //$values = array_map('array_pop', $skillid);
            //$imploded = implode(',', $values);
            //echo $imploded;

            foreach ($skilldata as $key => $value) {
                $value['degree_id'] = 6;
                $join_str = array(array(
                    'join_type' => '',
                    'table' => 'job_reg',
                    'join_table_id' => 'job_add_edu.user_id',
                    'from_table_id' => 'job_reg.user_id'),
                array(
                    'join_type' => 'left',
                    'table' => 'job_graduation',
                    'join_table_id' => 'job_add_edu.user_id',
                    'from_table_id' => 'job_graduation.user_id')
            );
                $contition_array = array('job_reg.status' => '1', 'job_reg.is_delete' => '0','job_reg.user_id != ' => $userid, 'FIND_IN_SET("' . $value['degree_id'] . '",ailee_job_add_edu.degree) != ' => '0');
                $jobdegreedata[] = $this->common->select_data_by_condition('job_add_edu', $contition_array, $data = '*', $sortby = '', $orderby = 'desc', $limit = '', $offset = '', $join_str, $groupby = '');
            }

            $rec_degree = $jobdegreedata;
            
            $rec_degree = array_reduce($rec_degree, 'array_merge', array());
            $rec_degree = array_unique($rec_degree, SORT_REGULAR);
            
          
            //DEGREE DATA FETCH END
            
             //STREAM FETCH START
            $contition_array = array('is_delete' => '0', 'status' => '1');
            $search_condition = "(stream_name LIKE '%$rec_search%')";
            $streamdata = $this->common->select_data_by_search('stream', $search_condition, $contition_array = array(), $data = 'stream_id', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str='', $groupby = '');


            //$values = array_map('array_pop', $skillid);
            //$imploded = implode(',', $values);
            //echo $imploded;

            foreach ($streamdata as $key => $value) {
              //  $contition_array = array('status' => '1', 'is_delete' => '0', 'job_step' => 10, 'user_id != ' => $userid, 'FIND_IN_SET("' . $value['skill_id'] . '", keyskill) != ' => '0');
                 
                $join_str = array(array(
                    'join_type' => 'left',
                    'table' => 'job_reg',
                    'join_table_id' => 'job_add_edu.user_id',
                    'from_table_id' => 'job_reg.user_id'),
                array(
                    'join_type' => 'left',
                    'table' => 'job_graduation',
                    'join_table_id' => 'job_add_edu.user_id',
                    'from_table_id' => 'job_graduation.user_id')
            );
                
                $contition_array = array('job_reg.status' => '1', 'job_reg.is_delete' => '0','job_reg.user_id != ' => $userid, 'FIND_IN_SET("' . $value['stream_id'] . '", ailee_job_add_edu.stream) != ' => '0');
                $jobstreamdata[] = $this->common->select_data_by_condition('job_add_edu', $contition_array, $data = '*', $sortby = '', $orderby = 'desc', $limit = '', $offset = '', $join_str, $groupby = '');
            }

            $rec_stream = $jobstreamdata;
            
            $rec_stream = array_reduce($rec_stream, 'array_merge', array());
            $rec_stream = array_unique($rec_stream, SORT_REGULAR);
            
          
            //STREAM DATA FETCH END
            
            //JOB TITLE FETCH START
            $contition_array = array('status' => 'publish');
            $search_condition = "(name LIKE '%$rec_search%')";
            $jobtitledata =  $this->common->select_data_by_search('job_title', $search_condition, $contition_array = array(), $data = 'title_id', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');


            //$values = array_map('array_pop', $skillid);
            //$imploded = implode(',', $values);
            //echo $imploded;

            foreach ($jobtitledata as $key => $value) {
                
                $join_str = array(array(
                    'join_type' => 'left',
                    'table' => 'job_reg',
                    'join_table_id' => 'job_reg.user_id',
                    'from_table_id' => 'job_add_edu.user_id'),
                array(
                    'join_type' => 'left',
                    'table' => 'job_graduation',
                    'join_table_id' => 'job_reg.user_id',
                    'from_table_id' => 'job_graduation.user_id')
            );
                
                $contition_array = array('status' => '1', 'is_delete' => '0','user_id != ' => $userid, 'FIND_IN_SET("' . $value['title_id'] . '", work_job_title) != ' => '0');
                $jobtiledata[] = $this->common->select_data_by_condition('job_reg', $contition_array, $data = '*', $sortby = '', $orderby = 'desc', $limit = '', $offset = '', $join_str = array(), $groupby = '');
            }

            $rec_title = $jobtiledata;
            
            $rec_title = array_reduce($rec_title, 'array_merge', array());
            $rec_title = array_unique($rec_title, SORT_REGULAR);
            //JOB TITLE FETCH END

                $unique = array_merge((array)$rec_skill,(array)$rec_degree,(array)$rec_title,(array)$rec_stream);
          
        } else {

            //echo "Skill & Place  Search";die();

            $contition_array = array('is_delete' => '0', 'status' => '1');


            $results = array_unique($result);
            foreach ($results as $key => $value) {
                $result1[$key]['label'] = $value;
                $result1[$key]['value'] = $value;
            }

            $search_condition = "(skill LIKE '%$rec_search%')";

            $skilldata = $artdata['data'] = $this->common->select_data_by_search('skill', $search_condition, $contition_array = array(), $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
            // echo "<pre>"; print_r($artdata['data']);


            $join_str = array(array(
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
            $contition_array = array('job_reg.status' => '1', 'job_reg.city_id' => $cache_time, 'job_reg.user_id !=' => $userid, 'job_reg.job_step' => 10);
            $jobdata = $userdata['data'] = $this->common->select_data_by_condition('job_reg', $contition_array, $data = 'job_reg.*,job_reg.user_id as iduser,job_add_edu.*,job_graduation.*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str, $groupby = '');
            //  echo "<pre>"; print_r($jobdata); die();



            $this->data['demo'] = array_values($result1);
            foreach ($skilldata as $key) {
                $id = $key['skill_id'];
                // echo $id; echo "<br>";
                foreach ($jobdata as $postskill) {
                    $skill = explode(',', $postskill['keyskill']);

                    if (in_array($id, $skill)) {
                        // echo "Match found"; echo "</br>";
                        // echo $postskill['post_id'];
                        $jobskillpost[] = $postskill;
                    }
                }
            }

            $this->data['rec_skill'] = $jobskillpost;

            $join_str = array(array(
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

            $contition_array1 = array('job_add_edu.pass_year' => $rec_search, 'job_reg.user_id !=' => $userid, 'job_reg.job_step' => 10);

            $adddata = $userdata['data'] = $this->common->select_data_by_condition('job_reg', $contition_array1, $data = 'job_reg.*,job_reg.user_id as iduser,job_add_edu.*,job_graduation.*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str, $groupby = '');

            // echo "<pre>"; print_r($yeardata); die();

            $join_str = array(array(
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
            $contition_array = array('job_reg.designation' => $rec_search, 'job_reg.user_id !=' => $userid, 'job_reg.job_step' => 10);

            $jobdata = $userdata['data'] = $this->common->select_data_by_condition('job_reg', $contition_array, $data = 'job_reg.*,job_reg.user_id as iduser,job_add_edu.*,job_graduation.*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str, $groupby = '');




            $join_str = array(array(
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
            $contition_array2 = array('job_reg.gender' => $rec_search, 'job_reg.city_id' => $cache_time, 'job_reg.user_id !=' => $userid, 'job_reg.job_step' => 10);

            $genderdata = $userdata['data'] = $this->common->select_data_by_condition('job_reg', $contition_array2, $data = 'job_reg.*,job_reg.user_id as iduser,job_add_edu.*,job_graduation.*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str, $groupby = '');

            //  echo "<pre>"; print_r($genderdata); die();


            $contition_array = array('status' => '1', 'user_id !=' => $userid);


            $recdata = $this->data['results'] = $this->common->select_data_by_condition('job_add_workexp', $contition_array, $data = 'sum(experience_year),user_id,sum(experience_month)', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby = 'user_id');


            foreach ($recdata as $rec) {

                $rec_search = str_replace(' ', '', $rec_search);



                $y = 0;
                for ($i = 0; $i <= $y; $i++) {
                    if ($rec['sum(experience_month)'] >= 12) {
                        $rec['sum(experience_year)'] = $rec['sum(experience_year)'] + 1;
                        $rec['sum(experience_month)'] = $rec['sum(experience_month)'] - 12;
                        $y++;
                    } else {
                        $y = 0;
                    }
                    $rec['sum(experience_year)'] = $rec['sum(experience_year)'] . 'year';
                    $rec['sum(experience_month)'] = $rec['sum(experience_month)'] . 'month';


                    if (($rec['sum(experience_year)'] == '0year') && (strcmp($rec['sum(experience_month)'], $rec_search) == 0)) {


//echo "string";
                        $join_str = array(array(
                                'join_type' => '',
                                'table' => 'job_add_edu',
                                'join_table_id' => 'job_reg.user_id',
                                'from_table_id' => 'job_add_edu.user_id'),
                            array(
                                'join_type' => '',
                                'table' => 'job_add_workexp',
                                'join_table_id' => 'job_reg.user_id',
                                'from_table_id' => 'job_add_workexp.user_id'),
                            array(
                                'join_type' => 'left',
                                'table' => 'job_graduation',
                                'join_table_id' => 'job_reg.user_id',
                                'from_table_id' => 'job_graduation.user_id')
                        );

                        $contition_array = array('job_reg.user_id' => $rec['user_id'], 'job_reg.job_step' => 10);

                        $resul[] = $jobprofiledata['data'] = $this->common->select_data_by_condition('job_reg', $contition_array, $data = 'job_reg.*,job_reg.user_id as iduser,job_add_edu.*,job_graduation.*,job_add_workexp.*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str, $groupby = '');
                    } elseif (strcmp($rec['sum(experience_year)'], $rec_search) == 0) {


//echo "string11";
                        $join_str = array(array(
                                'join_type' => '',
                                'table' => 'job_add_edu',
                                'join_table_id' => 'job_reg.user_id',
                                'from_table_id' => 'job_add_edu.user_id'),
                            array(
                                'join_type' => '',
                                'table' => 'job_add_workexp',
                                'join_table_id' => 'job_reg.user_id',
                                'from_table_id' => 'job_add_workexp.user_id'),
                            array(
                                'join_type' => 'left',
                                'table' => 'job_graduation',
                                'join_table_id' => 'job_reg.user_id',
                                'from_table_id' => 'job_graduation.user_id')
                        );

                        $contition_array = array('job_reg.user_id' => $rec['user_id'], 'job_reg.job_step' => 10);

                        $resul[] = $jobprofiledata['data'] = $this->common->select_data_by_condition('job_reg', $contition_array, $data = 'job_reg.*,job_reg.user_id as iduser,job_add_edu.*,job_graduation.*,job_add_workexp.*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str, $groupby = '');
                    } else {
                        $resul[] = array();
                    }
                }
            }

            foreach ($resul as $key => $value) {


                foreach ($value as $va) {


                    $result4[] = $va;
                }
            }
            $new3 = array();


            foreach ($result4 as $ke => $arr) {

                /// foreach ($arr as $valu) {




                $new3[$arr['user_id']] = $arr;

                //  }
            }


            $join_str = array(array(
                    'join_type' => '',
                    'table' => 'job_add_edu',
                    'join_table_id' => 'job_reg.user_id',
                    'from_table_id' => 'job_add_edu.user_id'),
                array(
                    'join_type' => '',
                    'table' => 'job_add_workexp',
                    'join_table_id' => 'job_reg.user_id',
                    'from_table_id' => 'job_add_workexp.user_id'),
                array(
                    'join_type' => 'left',
                    'table' => 'job_graduation',
                    'join_table_id' => 'job_reg.user_id',
                    'from_table_id' => 'job_graduation.user_id')
            );
            $search_condition = "(job_add_workexp.jobtitle LIKE '%$rec_search%')";
            $contition_array = array('job_reg.user_id !=' => $userid, 'job_reg.job_step' => 10);

            $results1 = $jobprofiledata['data'] = $this->common->select_data_by_search('job_reg', $search_condition, $contition_array, $data = 'job_reg.*,job_reg.user_id as iduser,job_add_edu.*,job_graduation.*,job_add_workexp.*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str, $groupby = '');


//echo "<pre>"; print_r($results1); die();



            $recsearch1 = $this->db->get_where('stream', array('stream_name' => $rec_search))->row()->stream_id;

            if ($recsearch1 != "") {
                // echo "pallavi";die();

                $join_str = array(array(
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

                $contition_array = array('job_add_edu.stream' => $recsearch1, 'job_reg.user_id !=' => $userid, 'job_reg.job_step' => 10);


                $adddata = $userdata['data'] = $this->common->select_data_by_condition('job_reg', $contition_array, $data = 'job_reg.*,job_reg.user_id as iduser,job_add_edu.*,job_graduation.*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str, $groupby = '');
            }


            //echo "<pre>"; print_r($adddata); die();

            $recsearch = $this->db->get_where('degree', array('degree_name' => $rec_search))->row()->degree_id;

            if ($recsearch != "") {

                $join_str = array(array(
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
                $contition_array = array('job_add_edu.degree' => $recsearch, 'job_reg.user_id !=' => $userid, 'job_reg.job_step' => 10);


                $adddata = $userdata['data'] = $this->common->select_data_by_condition('job_reg', $contition_array, $data = 'job_reg.*,job_reg.user_id as iduser,job_add_edu.*,job_graduation.*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str, $groupby = '');
            }
            // echo "<pre>"; print_r($adddata); die();


            foreach ($jobskillpost as $ke => $arr) {

                $postdata1[] = $arr;
            }

            $new1 = array();
            foreach ($postdata1 as $value) {
                //echo "hi";
                $new1[$value['job_id']] = $value;
            }

            // echo '<pre>'; print_r($new1); die();

            if (count($new1) == 0) {
                $unique = array_merge($adddata, $genderdata, $results1, $new3, $jobdata);
                // echo count($unique) . "<br>"; die();
                // echo "<pre>"; print_r($unique); die();
            } else {

                //echo "hi"; die();
                $unique = array_merge($new1, $adddata, $genderdata, $results1, $new3, $jobdata);
            }
            // echo "<pre>"; print_r($unique); die();
        }


        // echo "<pre>"; print_r($unique); die();

        foreach ($unique as $ke => $arr) {

            $skildataa[] = $arr;
        }
//echo "<pre>";print_r($postdata);
        $new11 = array();
        foreach ($skildataa as $value) {
            $new11[$value['user_id']] = $value;
        }

        $this->data['postdetail'] = $new11;

        //RECRUITER SEARCH END 1-9


        $title = '';
        if ($searchkeyword) {
            $title .= $searchkeyword;
        }
        if ($searchkeyword && $search_place) {
            $title .= ' Job Seeker in ';
        }
        if ($search_place) {
            $title .= $search_place;
        }
        $this->data['title'] = "$title | Aileensoul";
        $this->data['head'] = $this->load->view('head', $this->data, TRUE);

        $this->load->view('recruiter/recommen_candidate1', $this->data);
    }

//recrutier search end
// RECRUITER SEARCH END
// RECRUITER GET LOCATION START
    public function get_location($id = "") {

        //get search term
        $searchTerm = $_GET['term'];

        if (!empty($searchTerm)) {
            $search_condition = "(city_name LIKE '" . trim($searchTerm) . "%')";
            $citylist = $this->common->select_data_by_search('cities', $search_condition, $contition_array = array(), $data = 'city_id as id,city_name as text', $sortby = 'city_name', $orderby = 'desc', $limit = '', $offset = '', $join_str5 = '', $groupby = 'city_name');
        }
        foreach ($citylist as $key => $value) {

            $citydata[$key]['value'] = $value['text'];
        }

        $cdata = array_values($citydata);
        echo json_encode($cdata);
    }

// RECRUITER GET LOCATION END
    public function get_job_tile($id = "") {  //echo "hi"; die();
        $userid = $this->session->userdata('aileenuser');
        //get search term
        $searchTerm = $_GET['term'];

        if (!empty($searchTerm)) {

// JOB REGISTRATION DATA START (designation)
            $contition_array = array('status' => '1', 'is_delete' => 0);
            $search_condition = "(designation LIKE '" . trim($searchTerm) . "%')";
            $designation = $this->common->select_data_by_search('job_reg', $search_condition, $contition_array, $data = 'designation', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str5 = '', $groupby = 'designation');
// JOB REGISTRATION DATA END  (designation)
// DEGREE DATA START
            $contition_array = array('status' => '1');
            $search_condition = "(degree_name LIKE '" . trim($searchTerm) . "%')";
            $degreedata = $this->common->select_data_by_search('degree', $search_condition, $contition_array, $data = 'degree_name', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str5 = '', $groupby = 'degree_name');
// DEGREE DATA END
// STREAM DATA START
            $contition_array = array('status' => '1');
            $search_condition = "(stream_name LIKE '" . trim($searchTerm) . "%')";
            $streamdata = $this->common->select_data_by_search('stream', $search_condition, $contition_array, $data = 'stream_name', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str5 = '', $groupby = 'stream_name');
// STREAM DATA END
// SKILL DATA START
            $contition_array = array('status' => '1', 'type' => '1');
            $search_condition = "(skill LIKE '" . trim($searchTerm) . "%')";
            $skilldata = $this->common->select_data_by_search('skill', $search_condition, $contition_array, $data = 'skill', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str5 = '', $groupby = 'skill');
// SKILL DATA END
//MERGE DATA START
            $uni = array_merge($designation, $degreedata, $streamdata, $skilldata);
//MERGE DATA END
        }
        foreach ($uni as $key => $value) {
            foreach ($value as $ke => $val) {
                if ($val != "") {
                    $result[] = $val;
                }
            }
        }
        foreach ($result as $key => $value) {

            $result1[$key]['value'] = $value;
        }

        $all_data = array_values($result1);
        echo json_encode($all_data);
    }

    public function ajax_saved_candidate() {
        
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

//if user deactive profile then redirect to recruiter/index untill active profile start
        $contition_array = array('user_id' => $userid, 're_status' => '0', 'is_delete' => '0');
        $recruiter_deactive = $this->data['recruiter_deactive'] = $this->common->select_data_by_condition('recruiter', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);

        if ($recruiter_deactive) {
            redirect('recruiter/');
        }
//if user deactive profile then redirect to recruiter/index untill active profile End

        $recruiterdata = $this->common->select_data_by_id('recruiter', 'user_id', $userid, $data = 'user_id,designation,rec_lastname,rec_firstname', $join_str = array());

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
        $recdata1 =  $this->common->select_data_by_condition('save', $contition_array1, $data, $sortby = 'save_id', $orderby = 'desc', $limit = '', $offset = '', $join_str1, $groupby = '');
        
        foreach ($recdata1 as $ke => $arr) {
            $recdata2[] = $arr;
        }
        $new = array();
        foreach ($recdata2 as $value) {
            $new[$value['user_id']] = $value;
        }
        $savedata = $new;
        
        
        $return_html = " ";
       $savedata1 = array_slice($savedata, $start, $perpage);
        if (empty($_GET["total_record"])) {
            $_GET["total_record"] = count($savedata1);
        }
        
         
        $return_html .= '<input type = "hidden" class = "page_number" value = "' . $page . '" />';
        $return_html .= '<input type = "hidden" class = "total_record" value = "' . $_GET["total_record"] . '" />';
        $return_html .= '<input type = "hidden" class = "perpage_record" value = "' . $perpage . '" />';
        if (count($savedata) > 0) {
            foreach ($savedata1 as $rec) {

                $userid = $this->session->userdata('aileenuser');
                $contition_array = array('from_id' => $userid, 'save_id' => $rec['save_id']);
                $userdata = $this->common->select_data_by_condition('save', $contition_array, $data = 'status,save_id', $sortby = '', $orderby = 'desc', $limit = '', $offset = '', $join_str = array(), $groupby = '');

                if ($userdata[0]['status'] != 1) {
                    $return_html .= '<div class="profile-job-post-detail clearfix" id="removeuser' . $userdata[0]['save_id'] . '">';
                    $return_html .= '<div class="profile-job-post-title-inside clearfix">
                             <div class="profile-job-profile-button clearfix">
                                 <div class="profile-job-post-location-name-rec">
                                <div style="display: inline-block; float: left;">
                                 <div class="buisness-profile-pic-candidate" >';


                    $imageee = $this->config->item('job_profile_thumb_upload_path') . $rec['job_user_image'];
                    if (file_exists($imageee) && $rec['job_user_image'] != '') {

                        $return_html .= '<a href="' . base_url() . 'job/job_printpreview/' . $rec['userid'] . '?page=recruiter" title="' . $this->db->get_where('job_reg', array('user_id' => $rec['to_id']))->row()->fname . ' ' . $this->db->get_where('job_reg', array('user_id' => $rec['to_id']))->row()->lname . '">';
                        $return_html .= '<img src="' . base_url() . $this->config->item('job_profile_thumb_upload_path') . $rec['job_user_image'] . '" alt="' . $rec[0]['fname'] . ' ' . $rec[0]['lname'] . '"></a>';
                    } else {

                        $a = $rec['fname'];
                        $acr = substr($a, 0, 1);
                        $b = $rec['lname'];
                        $acr1 = substr($b, 0, 1);
                        $return_html .= '<div class="post-img-profile">';
                        $return_html .= ucfirst(strtolower($acr)) . ucfirst(strtolower($acr1));

                        $return_html .= '</div>';
                    }

                    $return_html .= '</div>
                                                                </div>
                                                                <div class="designation_rec_1 fl ">
                                                                    <ul>
                                                                        <li>';
                    $return_html .= '<a class="post_name"  href="' . base_url() . 'job/job_printpreview/' . $rec['userid'] . '?page=recruiter" title="' . $rec[0]['fname'] . ' ' . $rec[0]['lname'] . '>';
                    $return_html .= $this->db->get_where('job_reg', array('user_id' => $rec['to_id']))->row()->fname . ' ' . $this->db->get_where('job_reg', array('user_id' => $rec['to_id']))->row()->lname . '</a>';
                    $return_html .= '</li><li style="display: block;">
                                                                            <a class="post_designation"  href="javascript:void(0)" title="' . $rec['designation'] . '">';

                    if ($rec['designation']) {

                        $return_html .= $rec['designation'];
                    } else {

                        $return_html .= 'Designation';
                    }

                    $return_html .= '</a>
                                                                        </li>
                                                                    </ul>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="profile-job-post-title clearfix">

                                                        <div class="profile-job-profile-menu">
                                                            <ul class="clearfix">';


                    if ($rec['work_job_title']) {
                        $contition_array = array('status' => 'publish', 'title_id' => $rec['work_job_title']);
                        $jobtitle = $this->common->select_data_by_condition('job_title', $contition_array, $data = 'name', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

                        $return_html .= '<li> <b> Job Title</b> <span>';
                        $return_html .= $jobtitle[0]['name'];
                        $return_html .= '</span>
                                </li>';
                    }
                    if ($rec['keyskill']) {
                        $detailes = array();
                        $work_skill = explode(',', $rec['keyskill']);
                        foreach ($work_skill as $skill) {
                            $contition_array = array('skill_id' => $skill);
                            $skilldata = $this->common->select_data_by_condition('skill', $contition_array, $data = 'skill_id,skill', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str5 = '', $groupby = '');
                            $detailes[] = $skilldata[0]['skill'];
                        }

                        $return_html .= '<li> <b> Skills</b> <span>'
                                . implode(',', $detailes) .
                                '</span>
                                                                    </li>';
                    }
                    if ($rec['work_job_industry']) {
                        $contition_array = array('industry_id' => $rec['work_job_industry']);
                        $industry = $this->common->select_data_by_condition('job_industry', $contition_array, $data = 'industry_name', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

                        $return_html .= '<li> <b> Industry</b> <span>';
                        $return_html .= $industry[0]['industry_name'];
                        $return_html .= '</span>
                                                                    </li>';
                    }

                    if ($rec['work_job_city']) {
                        $cities = array();
                        $work_city = explode(',', $rec['work_job_city']);
                        foreach ($work_city as $city) {
                            $contition_array = array('city_id' => $city);
                            $citydata = $this->common->select_data_by_condition('cities', $contition_array, $data = 'city_id,city_name', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str5 = '', $groupby = '');
                            if ($citydata) {
                                $cities[] = $citydata[0]['city_name'];
                            }
                        }

                        $return_html .= '<li> <b> Preferred Cites</b> <span>';
                        $return_html .= implode(',', $cities);
                        $return_html .= '</span>
                                                                    </li>';
                    }

                    $contition_array = array('user_id' => $rec['userid'], 'experience' => 'Experience', 'status' => '1');
                    $experiance = $this->common->select_data_by_condition('job_add_workexp', $contition_array, $data = 'experience_year,experience_month', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');


                    if ($experiance[0]['experience_year'] != '') {

                        $total_work_year = 0;
                        $total_work_month = 0;
                        foreach ($experiance as $work1) {

                            $total_work_year += $work1['experience_year'];
                            $total_work_month += $work1['experience_month'];
                        }

                        $return_html .= '<li> <b> Total Experience</b>
                                                                        <span>';

                        if ($total_work_month == '12 month' && $total_work_year == '0 year') {
                            $return_html .= '"1 year"';
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
                            $return_html .= $year;
                            $return_html .= '"&nbsp"
                                                                        "Year"
                                                                      "&nbsp"';
                            if ($total_work_month != 0) {
                                $return_html .= $total_work_month;
                                '"&nbsp"
                                                                             "Month"';
                            }
                        }

                        $return_html .= '</span>
                                                                    </li>';
                    } else {
                        if ($rec['experience'] == 'Fresher') {

                            $return_html .= '<li> <b> Total Experience</b>
                                                                            <span>' . $rec['experience'] . '</span>
                                                                        </li>';
                        } //if complete
                    }//else complete

                    if ($rec['board_primary'] && $rec['board_secondary'] && $rec['board_higher_secondary'] && $rec['degree']) {
                        $return_html .= '<li>
                                                                        <b>Degree</b><span>';
                        $cache_time = $this->db->get_where('degree', array('degree_id' => $rec['degree']))->row()->degree_name;
                        if ($cache_time) {
                            $return_html .= $cache_time;
                        } else {
                            $return_html .= PROFILENA;
                        }


                        $return_html .= '</span>
                                                                    </li>
                                                                    <li><b>Stream</b>
                                                                        <span>';
                        $cache_time = $this->db->get_where('stream', array('stream_id' => $rec['stream']))->row()->stream_name;
                        if ($cache_time) {
                            $return_html .= $cache_time;
                        } else {
                            $return_html .= PROFILENA;
                        }
                        $return_html .= '</span>
                                                                    </li>';
                    } elseif ($rec['board_secondary'] && $rec['board_higher_secondary'] && $rec['degree']) {

                        $return_html .= '<li>
                                                                        <b>Degree</b><span>';
                        $cache_time = $this->db->get_where('degree', array('degree_id' => $rec['degree']))->row()->degree_name;
                        if ($cache_time) {
                            $return_html .= $cache_time;
                        } else {
                            $return_html .= PROFILENA;
                        }

                        $return_html .= '</span>
                                                                    </li>
                                                                    <li><b>Stream</b>
                                                                        <span>';

                        $cache_time = $this->db->get_where('stream', array('stream_id' => $rec['stream']))->row()->stream_name;
                        if ($cache_time) {
                            $return_html .= $cache_time;
                        } else {
                            $return_html .= PROFILENA;
                        }

                        $return_html .= '</span>
                                                                    </li>';
                    } elseif ($row['board_higher_secondary'] && $rec['degree']) {


                        $return_html .= '<li>
                                                                        <b>Degree</b><span>';

                        $cache_time = $this->db->get_where('degree', array('degree_id' => $rec['degree']))->row()->degree_name;
                        if ($cache_time) {
                            $return_html .= $cache_time;
                        } else {
                            $return_html .= PROFILENA;
                        }


                        $return_html .= '</span>
                                                                    </li>
                                                                    <li><b>Stream</b>
                                                                        <span>';

                        $cache_time = $this->db->get_where('stream', array('stream_id' => $rec['stream']))->row()->stream_name;
                        if ($cache_time) {
                            $return_html .= $cache_time;
                        } else {
                            $return_html .= PROFILENA;
                        }

                        $return_html .= '</span>
                                                                    </li>';
                    } else if ($rec['board_secondary'] && $rec['degree']) {

                        $return_html .= '<li>
                                                                        <b>Degree</b><span>';

                        $cache_time = $this->db->get_where('degree', array('degree_id' => $rec['degree']))->row()->degree_name;
                        if ($cache_time) {
                            $return_html .= $cache_time;
                        } else {
                            $return_html .= PROFILENA;
                        }


                        $return_html .= '</span>
                                                                    </li>
                                                                    <li><b>Stream</b>
                                                                        <span>';

                        $cache_time = $this->db->get_where('stream', array('stream_id' => $rec['stream']))->row()->stream_name;
                        if ($cache_time) {
                            $return_html .= $cache_time;
                        } else {
                            $return_html .= PROFILENA;
                        }

                        $return_html .= '</span>
                                                                    </li>';
                    } elseif ($rec['board_primary'] && $rec['degree']) {
                        $return_html .= '<li>
                                                                        <b>Degree</b><span>';

                        $cache_time = $this->db->get_where('degree', array('degree_id' => $rec['degree']))->row()->degree_name;
                        if ($cache_time) {
                            $return_html .= $cache_time;
                        } else {
                            $return_html .= PROFILENA;
                        }


                        $return_html .= '</span>
                                                                    </li>
                                                                    <li><b>Stream</b>
                                                                        <span>';

                        $cache_time = $this->db->get_where('stream', array('stream_id' => $rec['stream']))->row()->stream_name;
                        if ($cache_time) {
                            $return_html .= $cache_time;
                        } else {
                            $return_html .= PROFILENA;
                        }

                        $return_html .= '</span>
                                                                    </li>';
                    } elseif ($rec['board_primary'] && $rec['board_secondary'] && $rec['board_higher_secondary']) {
                        $return_html .= '<li><b>Board of Higher Secondary</b>
                                                                        <span>' .
                                $rec['board_higher_secondary'] .
                                '</span>
                                                                    </li>
                                                                    <li><b>Percentage of Higher Secondary</b>
                                                                        <span>';
                        $return_html .= $rec['percentage_higher_secondary'];
                        $return_html .= '</span>
                                     </li>';
                    } elseif ($rec['board_secondary'] && $rec['board_higher_secondary']) {
                        $return_html .= '<li><b>Board of Higher Secondary</b>
                                                                        <span>' .
                                $rec['board_higher_secondary'] .
                                '</span>
                                                                    </li>
                                                                    <li><b>Percentage of Higher Secondary</b>
                                                                        <span>' .
                                $rec['percentage_higher_secondary'] .
                                '</span>
                                                                    </li>';
                    } elseif ($rec['board_primary'] && $rec['board_higher_secondary']) {


                        $return_html .= '<li><b>Board of Higher Secondary</b>
                                                                        <span>' .
                                $rec['board_higher_secondary'] .
                                '</span>
                                                                    </li>
                                                                    <li><b>Percentage of Higher Secondary</b>
                                                                        <span>' .
                                $rec['percentage_higher_secondary'] .
                                '</span>
                                                                    </li>';
                    } elseif ($rec['board_primary'] && $rec['board_secondary']) {

                        $return_html .= '<li><b>Board of Secondary</b>
                                                                        <span>'
                                . $rec['board_secondary'] .
                                '</span>
                                                                    </li>
                                                                    <li><b>Percentage of Secondary</b>
                                                                        <span>' .
                                $rec['percentage_secondary'] .
                                '</span>
                                                                    </li>';
                    } elseif ($rec['degree']) {

                        $return_html .= '<li>
                                                                        <b>Degree</b><span>';



                        $cache_time = $this->db->get_where('degree', array('degree_id' => $rec['degree']))->row()->degree_name;
                        if ($cache_time) {
                            $return_html .= $cache_time;
                        } else {
                            $return_html .= PROFILENA;
                        }


                        $return_html .= '</span>
                                                                    </li>
                                                                    <li><b>Stream</b>
                                                                        <span>';

                        $cache_time = $this->db->get_where('stream', array('stream_id' => $rec['stream']))->row()->stream_name;
                        if ($cache_time) {
                            $return_html .= $cache_time;
                        } else {
                            $return_html .= PROFILENA;
                        }

                        $return_html .= '</span>
                                                                    </li>';
                    } elseif ($rec['board_higher_secondary']) {

                        $return_html .= '<li><b>Board of Higher Secondary</b>
                                                                        <span>' .
                                $rec['board_higher_secondary'] .
                                '</span>
                                                                    </li>
                                                                    <li><b>Percentage of Higher Secondary</b>
                                                                        <span>' .
                                $rec['percentage_higher_secondary'] .
                                '</span>
                                                                    </li>';
                    } elseif ($rec['board_secondary']) {

                        $return_html .= '<li><b>Board of Secondary</b>
                                                                        <span>'
                                . $rec['board_secondary'] . '
                                                                        </span>
                                                                    </li>
                                                                    <li><b>Percentage of Secondary</b>
                                                                        <span>' .
                                $rec['percentage_secondary'] .
                                '</span>
                                                                    </li>';
                    } elseif ($rec['board_primary']) {

                        $return_html .= '<li><b>Board of Primary</b>
                                                                        <span>' .
                                $rec['board_primary'] .
                                '</span>
                                                                    </li>
                                                                    <li><b>Percentage of Primary</b>
                                                                        <span>' .
                                $rec['percentage_primary'] .
                                '</span>
                                                                    </li>';
                    }

                    $return_html .= '<li><b>E-mail</b><span>';

                    if ($rec['email']) {
                        $return_html .= $rec['email'];
                    } else {
                        $return_html .= PROFILENA;
                    }
                    $return_html .= '</span>
                                                                </li>';


                    if ($rec['phnno']) {

                        $return_html .= '<li><b>Mobile Number</b><span>'
                                . $rec['phnno'] .
                                '</span>
                                                                    </li>';
                    }



                    $return_html .= '</ul>
                                                        </div>
                                                        <div class="profile-job-profile-button clearfix">
                                                            <div class="apply-btn fr" >';
                    $userid = $this->session->userdata('aileenuser');
                    if ($userid != $rec['userid']) {

                        $return_html .= '<a href="' . base_url() . 'chat/abc/2/1/' . $rec['userid'] . '">Message</a>';

                        $return_html .= '<a href="javascript:void(0);" class="button" onclick="removepopup(' . $rec['save_id'] . ')">Remove</a>';
                    }

                    $return_html .= '</div>

                                                        </div>
                                                    </div>
                                                </div>';
                }
            }
        } else {

            $return_html .= '<div class="art-img-nn">
                                        <div class="art_no_post_img">

                                            <img src="' . base_url() . 'img/job-no1.png">

                                        </div>
                                        <div class="art_no_post_text">
                                            No Saved Candidate  Available.
                                        </div>
                                    </div>';
        }
        echo $return_html;
    }
//COVAER PIC START

// cover pic controller

    public function ajaxpro() {

         $this->recruiter_apply_check(); 

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
//COVAER PIC END
}
