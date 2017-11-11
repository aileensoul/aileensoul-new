<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Freelancer extends MY_Controller {

    public $data;

    public function __construct() {
        parent::__construct();

        $this->load->library('form_validation');
        $this->load->model('email_model');
        $this->lang->load('message', 'english');
        $this->load->library('S3');

        include ('freelancer_include.php');
        $this->data['aileenuser_id'] = $this->session->userdata('aileenuser');
    }

    public function index() {  //echo "falguni"; die();
        //  echo "<pre>"; print_r($this->data);die();
        $userid = $this->session->userdata('aileenuser');
        $this->load->view('freelancer/freelancer_main', $this->data);
    }

    public function freelancer_post() {

        $userid = $this->session->userdata('aileenuser');

        $contition_array = array('user_id' => $userid, 'status' => '0');
        $freelancerpostdata = $this->common->select_data_by_condition('freelancer_post_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
        if ($freelancerpostdata) {

            $this->load->view('freelancer/freelancer_post/reactivate', $this->data);
        } else {

            $userid = $this->session->userdata('aileenuser');
            $contition_array = array('user_id' => $userid, 'status' => '1', 'is_delete' => '0');
            $jobdata = $this->common->select_data_by_condition('freelancer_post_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');


            if ($jobdata[0]['free_post_step'] == 1) {
                redirect('freelancer-work/address-information', refresh);
            } else if ($jobdata[0]['free_post_step'] == 2) {
                redirect('freelancer-work/professional-information', refresh);
            } else if ($jobdata[0]['free_post_step'] == 3) {
                redirect('freelancer-work/rate', refresh);
            } else if ($jobdata[0]['free_post_step'] == 4) {
                redirect('freelancer-work/avability', refresh);
            } else if ($jobdata[0]['free_post_step'] == 5) {
                redirect('freelancer-work/education', refresh);
            } else if ($jobdata[0]['free_post_step'] == 6) {
                redirect('freelancer-work/portfolio', refresh);
            } else if ($jobdata[0]['free_post_step'] == 7) {
                redirect('freelancer-work/home', refresh);
            } else {
                redirect('freelancer-work/basic-information', refresh);
                // $this->load->view('freelancer/freelancer_post/freelancer_post_basic_information',$this->data);
            }
        }
    }

    //freelancer workexp first  info page controller start

    public function freelancer_post_basic_information($postid = '') {
        if ($postid != '') {
            $this->data['livepostid'] = $postid;
        }
        $userid = $this->session->userdata('aileenuser');
        //code for check user deactivate start
        $this->freelancer_apply_deactivate_check();
        //code for check user deactivate end
        $contition_array = array('user_id' => $userid, 'is_delete' => '0', 'status' => '1');
        $userdata = $this->common->select_data_by_condition('freelancer_post_reg', $contition_array, $data = 'freelancer_post_fullname,freelancer_post_username,freelancer_post_email,freelancer_post_skypeid,freelancer_post_phoneno', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        if ($userdata) {
            $step = $userdata[0]['free_post_step'];

            if ($step == 1 || $step > 1) {
                $this->data['firstname1'] = $userdata[0]['freelancer_post_fullname'];
                $this->data['lastname1'] = $userdata[0]['freelancer_post_username'];
                $this->data['email1'] = $userdata[0]['freelancer_post_email'];
                $this->data['skypeid1'] = $userdata[0]['freelancer_post_skypeid'];
                $this->data['phoneno1'] = $userdata[0]['freelancer_post_phoneno'];
            }
        }


        $this->load->view('freelancer/freelancer_post/freelancer_post_basic_information', $this->data);
    }

//FREELANCER_HIRE DESIGNATION START
    public function hire_designation() {

        $userid = $this->session->userdata('aileenuser');


        $data = array(
            'designation' => trim($this->input->post('designation')),
            'modified_date' => date('Y-m-d', time())
        );
        //   echo "<pre>"; print_r($data);die();
        $updatdata = $this->common->update_data($data, 'freelancer_hire_reg', 'user_id', $userid);
    }

//FREELANCER_HIRE DESIGNATION END
//FREELANCER_APPLY POST_BASIC_INFORMATION PAGE DATA INSERT START
    public function freelancer_post_basic_information_insert() {


        if ($this->input->post('livepostid')) {
            $postid = trim($this->input->post('livepostid'));
        }

        $userid = $this->session->userdata('aileenuser');


        $this->form_validation->set_rules('firstname', 'Full Name', 'required');
        $this->form_validation->set_rules('lastname', 'Last Name', 'required');
        $this->form_validation->set_rules('email', 'EmailId', 'required|valid_email');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('freelancer/freelancer_post/freelancer_post_basic_information');
        } else {

            $contition_array = array('user_id' => $userid, 'is_delete' => '0', 'status' => '1');
            $userdata = $this->common->select_data_by_condition('freelancer_post_reg', $contition_array, $data = 'free_post_step,freelancer_post_fullname,freelancer_post_username,user_id', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
            $first_lastname = trim($this->input->post('firstname')) . " " . trim($this->input->post('lastname'));

            if ($userdata) {
                if ($userdata[0]['free_post_step'] == 7) {
                    $data = array(
                        'free_post_step' => 7
                    );
                    $updatedata = $this->common->update_data($data, 'freelancer_post_reg', 'user_id', $userid);
                } else if ($userdata[0]['free_post_step'] > 1) {
                    $data = array(
                        'free_post_step' => $userdata[0]['free_post_step']
                    );
                    $updatedata = $this->common->update_data($data, 'freelancer_post_reg', 'user_id', $userid);
                } else {
                    $data = array(
                        'free_post_step' => 1
                    );
                    $updatedata = $this->common->update_data($data, 'freelancer_post_reg', 'user_id', $userid);
                }

                $data = array(
                    'freelancer_post_fullname' => trim($this->input->post('firstname')),
                    'freelancer_post_username' => trim($this->input->post('lastname')),
                    'freelancer_post_skypeid' => trim($this->input->post('skypeid')),
                    'freelancer_post_email' => trim($this->input->post('email')),
                    'freelancer_post_phoneno' => trim($this->input->post('phoneno')),
                    'freelancer_apply_slug' => $this->setcategory_slug($first_lastname, 'freelancer_apply_slug', 'freelancer_post_reg'),
                    'user_id' => $userid,
                    'modify_date' => date('Y-m-d', time())
                );

                $updatedata = $this->common->update_data($data, 'freelancer_post_reg', 'user_id', $userid);
                if ($updatedata) {
                    $this->session->set_flashdata('success', 'Basic information updated successfully');
                    if ($postid) {
                        redirect('freelancer-work/address-information/' . $postid, refresh);
                    } else {
                        redirect('freelancer-work/address-information', refresh);
                    }
                } else {
                    $this->session->flashdata('error', 'Your data not inserted');
                    if ($postid) {
                        redirect('freelancer-work/basic-information/' . $postid, refresh);
                    } else {
                        redirect('freelancer-work/basic-information', refresh);
                    }
                }
            } else {

                $data = array(
                    'freelancer_post_fullname' => trim($this->input->post('firstname')),
                    'freelancer_post_username' => trim($this->input->post('lastname')),
                    'freelancer_post_skypeid' => trim($this->input->post('skypeid')),
                    'freelancer_post_email' => trim($this->input->post('email')),
                    'freelancer_post_phoneno' => trim($this->input->post('phoneno')),
                    'freelancer_apply_slug' => $this->setcategory_slug($first_lastname, 'freelancer_apply_slug', 'freelancer_post_reg'),
                    'user_id' => $userid,
                    'created_date' => date('Y-m-d', time()),
                    'status' => 1,
                    'is_delete' => 0,
                    'free_post_step' => 1
                );

                $insert_id = $this->common->insert_data_getid($data, 'freelancer_post_reg');
                if ($insert_id) {
                    $this->session->set_flashdata('success', 'Basic information updated successfully');

                    if ($postid) {
                        redirect('freelancer-work/address-information/' . $postid, refresh);
                    } else {
                        redirect('freelancer-work/address-information', refresh);
                    }
                } else {

                    $this->session->flashdata('error', 'Sorry!! Your data not inserted');
                    if ($postid) {
                        redirect('freelancer-work/basic-information/' . $postid, refresh);
                    } else {
                        redirect('freelancer-work/basic-information', refresh);
                    }
                }
            }
        }
    }

//FREELANCER_APPLY POST_BASIC_INFORMATION PAGE DATA INSERT END
    // FREELANCER_HIRE SLUG START
    public function setcategory_slug($slugname, $filedname, $tablename, $notin_id = array()) {
        $slugname = $oldslugname = $this->create_slug($slugname);
        $i = 1;
        while ($this->comparecategory_slug($slugname, $filedname, $tablename, $notin_id) > 0) {
            $slugname = $oldslugname . '-' . $i;
            $i++;
        }return $slugname;
    }

    public function comparecategory_slug($slugname, $filedname, $tablename, $notin_id = array()) {
        $this->db->where($filedname, $slugname);
        if (isset($notin_id) && $notin_id != "" && count($notin_id) > 0 && !empty($notin_id)) {
            $this->db->where($notin_id);
        }
        $num_rows = $this->db->count_all_results($tablename);
        return $num_rows;
    }

    public function create_slug($string) {
        $slug = preg_replace('/[^A-Za-z0-9-]+/', '-', strtolower(stripslashes($string)));
        $slug = preg_replace('/[-]+/', '-', $slug);
        $slug = trim($slug, '-');
        return $slug;
    }

// FREELANCER HIRE SLUG END

    function slug_script() {

        $this->db->select('freelancer_post_reg_id,freelancer_post_fullname,freelancer_post_username');
        $res = $this->db->get('freelancer_post_reg')->result();
        foreach ($res as $k => $v) {
            $data = array('freelancer_apply_slug' => $this->setcategory_slug($v->freelancer_post_fullname . " " . $v->freelancer_post_username, 'freelancer_apply_slug', 'freelancer_post_reg'));
            $this->db->where('freelancer_post_reg_id', $v->freelancer_post_reg_id);
            $this->db->update('freelancer_post_reg', $data);
        }
        echo "yes";
    }

//CHECK EMAIL AVAIBILITY OF FREELANCER_APPLY START 
    public function check_email() {

        $email = trim($this->input->post('email'));
        $userid = $this->session->userdata('aileenuser');

        $contition_array = array('user_id' => $userid, 'is_delete' => '0', 'status' => '1');
        $userdata = $this->common->select_data_by_condition('freelancer_post_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        $email1 = $userdata[0]['freelancer_post_email'];
        if ($email1) {
            $condition_array = array('is_delete' => '0', 'user_id !=' => $userid, 'status' => '1');
            $check_result = $this->common->check_unique_avalibility('freelancer_post_reg', 'freelancer_post_email', $email, '', '', $condition_array);
        } else {
            $condition_array = array('is_delete' => '0');
            $check_result = $this->common->check_unique_avalibility('freelancer_post_reg', 'freelancer_post_email', $email, '', '', $condition_array);
        }

        if ($check_result) {
            echo 'true';
            die();
        } else {
            echo 'false';
            die();
        }
    }

//CHECK EMAIL AVAIBILITY OF FREELANCER_APPLY END
//FREELANCER_APPLY USER DEACTIAVTE CHECK START
    public function freelancer_apply_deactivate_check() {
        $userid = $this->session->userdata('aileenuser');
        //IF USER DEACTIVATE PROFILE THEN REDIRECT TO freelancer/freelancer_post/freelancer_post_basic_information START
        $contition_array = array('user_id' => $userid, 'status' => '0', 'is_delete' => '0');
        $freelancerpost_deactive = $this->data['freelancerpost_deactive'] = $this->common->select_data_by_condition('freelancer_post_reg', $contition_array, $data = 'user_id', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);
        if ($freelancerpost_deactive) {
            redirect('freelancer/freelancer_post/freelancer_post_basic_information');
        }
        //IF USER DEACTIVATE PROFILE THEN REDIRECT TO freelancer/freelancer_post/freelancer_post_basic_information END  
    }

//FREELANCER_APPLY USER DEACTIAVTE CHECK START
//FREELANCER_APPLY ADDRESS PAGE START
    public function freelancer_post_address_information($postid = '') {

        if ($postid != '') {
            $this->data['livepostid'] = $postid;
        }

        $userid = $this->session->userdata('aileenuser');
        //code for check user deactivate start
        $this->freelancer_apply_deactivate_check();
        //code for check user deactivate end
        // code for display page start
        $this->freelancer_apply_check();
        // code for display page end
        $contition_array = array('status' => 1);
        $this->data['countries'] = $this->common->select_data_by_condition('countries', $contition_array, $data = 'country_id,country_name', $sortby = 'country_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');
        //USER DATA FETCH
        $contition_array = array('user_id' => $userid, 'is_delete' => '0', 'status' => '1');
        $userdata = $this->common->select_data_by_condition('freelancer_post_reg', $contition_array, $data = 'freelancer_post_country,freelancer_post_state,freelancer_post_city,freelancer_post_pincode,freelancer_post_address,free_post_step', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        //FOR GETTING STATE DATA
        $contition_array = array('status' => 1, 'country_id' => $userdata[0]['freelancer_post_country']);
        $this->data['states'] = $this->common->select_data_by_condition('states', $contition_array, $data = 'state_id,state_name', $sortby = 'state_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        //FOR GETTING CITY DATA 
        $contition_array = array('status' => 1, 'state_id' => $userdata[0]['freelancer_post_state']);
        $this->data['cities'] = $this->common->select_data_by_condition('cities', $contition_array, $data = 'city_id,city_name', $sortby = 'city_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');
        if ($userdata) {
            $step = $userdata[0]['free_post_step'];
            if ($step == 2 || $step > 2 || ($step >= 1 && $step <= 2)) {
                $this->data['country1'] = $userdata[0]['freelancer_post_country'];
                $this->data['state1'] = $userdata[0]['freelancer_post_state'];
                $this->data['city1'] = $userdata[0]['freelancer_post_city'];
                $this->data['pincode1'] = $userdata[0]['freelancer_post_pincode'];
            }
        }
        $this->load->view('freelancer/freelancer_post/freelancer_post_address_information', $this->data);
    }

//FREELANCER_APPLY ADDRESS PAGE END
//FUNCTION FOR GET DATA OF STATE AND CITY START
    public function ajax_data() {
        // ajax for degree start
        if (isset($_POST["degree_id"]) && !empty($_POST["degree_id"])) {
            //Get all state data
            $contition_array = array('degree_id' => $_POST["degree_id"], 'status' => 1);
            $stream = $this->data['stream'] = $this->common->select_data_by_condition('stream', $contition_array, $data = '*', $sortby = 'stream_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');
            //Count total number of rows
            //Display states list
            if (count($stream) > 0) {
                echo '<option value="">Select stream</option>';
                foreach ($stream as $st) {
                    echo '<option value="' . $st['stream_id'] . '">' . $st['stream_name'] . '</option>';
                }
            } else {
                echo '<option value="">Stream not available</option>';
            }
        }

        // ajax for degree end
        // ajax for country start
        if (isset($_POST["country_id"]) && !empty($_POST["country_id"])) {
            //Get all state data
            $contition_array = array('country_id' => $_POST["country_id"], 'status' => 1);
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
        // ajax for country end
        // ajax for state start
        if (isset($_POST["state_id"]) && !empty($_POST["state_id"])) {
            //Get all city data
            $contition_array = array('state_id' => $_POST["state_id"], 'status' => 1);
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
        // ajax for state end
    }

//FUNCTION FOR GET DATA OF STATE AND CITY END
//FREELANCER_APPLY ADDRESS INFORMATION INSERT CODE START
    public function freelancer_post_address_information_insert() {
        $userid = $this->session->userdata('aileenuser');

        if ($this->input->post('livepostid')) {
            $postid = trim($this->input->post('livepostid'));
        }

        if ($this->input->post('next')) {
            $this->form_validation->set_rules('country', 'Country', 'required');
            $this->form_validation->set_rules('state', 'State', 'required');

            if ($this->form_validation->run() == FALSE) {
                $this->load->view('freelancer/freelancer_post/freelancer_post_address_information');
            } else {
                $contition_array = array('user_id' => $userid, 'is_delete' => '0', 'status' => '1');
                $userdata = $this->common->select_data_by_condition('freelancer_post_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
                if ($userdata[0]['free_post_step'] == 7) {
                    $data = array(
                        'free_post_step' => 7
                    );
                    $updatedata = $this->common->update_data($data, 'freelancer_post_reg', 'user_id', $userid);
                } else if ($userdata[0]['free_post_step'] > 2) {
                    $data = array(
                        'free_post_step' => $userdata[0]['free_post_step']
                    );
                    $updatedata = $this->common->update_data($data, 'freelancer_post_reg', 'user_id', $userid);
                } else {
                    $data = array(
                        'free_post_step' => 2
                    );
                    $updatedata = $this->common->update_data($data, 'freelancer_post_reg', 'user_id', $userid);
                }
                $data = array(
                    'freelancer_post_country' => trim($this->input->post('country')),
                    'freelancer_post_state' => trim($this->input->post('state')),
                    'freelancer_post_city' => trim($this->input->post('city')),
                    'freelancer_post_pincode' => trim($this->input->post('pincode')),
                    'modify_date' => date('Y-m-d', time())
                );
                $updatdata = $this->common->update_data($data, 'freelancer_post_reg', 'user_id', $userid);
                if ($updatdata) {
                    $this->session->set_flashdata('success', 'Address information updated successfully');
                    if ($postid) {
                        redirect('freelancer-work/professional-information/' . $postid, refresh);
                    } else {
                        redirect('freelancer-work/professional-information', refresh);
                    }
                } else {
                    $this->session->flashdata('error', 'Your data not inserted');
                    if ($postid) {
                        redirect('freelancer-work/address-information/' . $postid, refresh);
                    } else {
                        redirect('freelancer-work/address-information', refresh);
                    }
                }
            }
        }
    }

//FREELANCER_APPLY ADDRESS INFORMATION INSERT CODE END
//FREELANCER_APPLY POST_PROFESSIONAL_INFORMATION PAGE START
//freelancer professional page controller Start
    public function freelancer_post_professional_information($postid = '') {

        if ($postid != '') {
            $this->data['livepostid'] = $postid;
        }

        $userid = $this->session->userdata('aileenuser');
        //code for check user deactivate start
        $this->freelancer_apply_deactivate_check();
        //code for check user deactivate end
// code for display page start
        $this->freelancer_apply_check();
        // code for display page end

        $contition_array = array('user_id' => $userid, 'is_delete' => '0', 'status' => '1');
        $userdata = $this->data['postdata'] = $this->common->select_data_by_condition('freelancer_post_reg', $contition_array, $data = 'freelancer_post_field,freelancer_post_area,freelancer_post_otherskill,freelancer_post_skill_description,freelancer_post_exp_year,freelancer_post_exp_month,free_post_step,user_id', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
        //Retrieve skill data Start
        $skill_know = explode(',', $userdata[0]['freelancer_post_area']);
        foreach ($skill_know as $sk) {
            $contition_array = array('skill_id' => $sk, 'status' => 1);
            $skilldata = $this->common->select_data_by_condition('skill', $contition_array, $data = 'skill_id,skill', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str5 = '', $groupby = '');
            //echo "<pre>";print_r(  $languagedata);
            $detailes[] = $skilldata[0]['skill'];
        }
        $this->data['skill_2'] = implode(',', $detailes);
        //Retrieve skill data End

        $contition_array = array('status' => 1, 'is_other' => '0');
        $this->data['category'] = $this->common->select_data_by_condition('category', $contition_array, $data = '*', $sortby = 'category_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        //for getting univesity data Start
        $contition_array = array('is_delete' => '0', 'category_name !=' => "Other");
        $search_condition = "((status = '2' AND user_id = $userid) OR (status = '1'))";
        $this->data['category_data'] = $this->common->select_data_by_search('category', $search_condition, $contition_array, $data = '*', $sortby = 'category_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        $contition_array = array('is_delete' => '0', 'status' => 1, 'category_name' => "Other");
        $this->data['category_otherdata'] = $this->common->select_data_by_condition('category', $contition_array, $data = '*', $sortby = 'category_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');
        //for getting univesity data End
        $contition_array = array('status' => 1, 'type' => 1);
        $this->data['skill1'] = $this->common->select_data_by_condition('skill', $contition_array, $data = '*', $sortby = 'skill', $orderby = 'DESC', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        if ($userdata) {
            $step = $userdata[0]['free_post_step'];
            if ($step == 3 || ($step >= 1 && $step <= 3) || $step > 3) {
                $this->data['fields_req1'] = $userdata[0]['freelancer_post_field'];
                $this->data['area1'] = $userdata[0]['freelancer_post_area'];
                $this->data['otherskill1'] = $userdata[0]['freelancer_post_otherskill'];
                $this->data['skill_description1'] = $userdata[0]['freelancer_post_skill_description'];
                $this->data['experience_year1'] = $userdata[0]['freelancer_post_exp_year'];
                $this->data['experience_month1'] = $userdata[0]['freelancer_post_exp_month'];
            }
        }

        $this->load->view('freelancer/freelancer_post/freelancer_post_professional_information', $this->data);
    }

//FREELANCER_APPLY POST_PROFESSIONAL_INFORMATION PAGE START
//FREELANCER_APPLY POST_PROFESSIONAL_INFORMATION INSERT DATA START
    public function freelancer_post_professional_information_insert() {
        if ($this->input->post('livepostid')) {
            $postid = trim($this->input->post('livepostid'));
        }

        $userid = $this->session->userdata('aileenuser');
        $skill1 = $this->input->post('skills');
        $skills = explode(',', $skill1);

        if ($this->input->post('next')) {
            $this->form_validation->set_rules('field', 'Field', 'required');
            $this->form_validation->set_rules('skill_description', 'Skill Description', 'required');

            if ($this->form_validation->run() == FALSE) {
                $this->load->view('freelancer/freelancer_post/freelancer_post_professional_information');
            } else {

                $contition_array = array('user_id' => $userid, 'is_delete' => '0', 'status' => '1');
                $userdata = $this->common->select_data_by_condition('freelancer_post_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

                if ($userdata[0]['free_post_step'] == 7) {
                    $data = array(
                        'free_post_step' => 7
                    );
                    $updatedata = $this->common->update_data($data, 'freelancer_post_reg', 'user_id', $userid);
                } else if ($userdata[0]['free_post_step'] > 3) {
                    $data = array(
                        'free_post_step' => $userdata[0]['free_post_step']
                    );

                    $updatedata = $this->common->update_data($data, 'freelancer_post_reg', 'user_id', $userid);
                } else {
                    $data = array(
                        'free_post_step' => 3
                    );
                    $updatedata = $this->common->update_data($data, 'freelancer_post_reg', 'user_id', $userid);
                }
                if (count($skills) > 0) {
                    foreach ($skills as $ski) {
                        if ($ski != " ") {
                            $contition_array = array('skill' => trim($ski), 'type' => 1);
                            $skilldata = $this->common->select_data_by_condition('skill', $contition_array, $data = 'skill_id,skill', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str5 = '', $groupby = '');
                            if (count($skilldata) < 0) {
                                $contition_array = array('skill' => trim($ski), 'type' => 5);
                                $skilldata = $this->common->select_data_by_condition('skill', $contition_array, $data = 'skill_id,skill', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str5 = '', $groupby = '');
                            }
                            if ($skilldata) {
                                $skill[] = $skilldata[0]['skill_id'];
                            } else {
                                $data = array(
                                    'skill' => trim($ski),
                                    'status' => '1',
                                    'type' => 5,
                                    'user_id' => $userid,
                                );
                                $skill[] = $this->common->insert_data_getid($data, 'skill');
                            }
                        }
                    }
                    $skill = array_unique($skill, SORT_REGULAR);
                    $skills = implode(',', $skill);
                }
                $data = array(
                    'freelancer_post_field' => trim($this->input->post('field')),
                    'freelancer_post_area' => $skills,
                    'freelancer_post_otherskill' => trim($this->input->post('otherskill')),
                    'freelancer_post_skill_description' => trim($this->input->post('skill_description')),
                    'freelancer_post_exp_month' => trim($this->input->post('experience_month')),
                    'freelancer_post_exp_year' => trim($this->input->post('experience_year')),
                    'modify_date' => date('Y-m-d', time())
                );
                $updatdata = $this->common->update_data($data, 'freelancer_post_reg', 'user_id', $userid);
                if ($updatdata) {
                    $this->session->set_flashdata('success', 'professional information updated successfully');
                    if ($postid) {
                        redirect('freelancer-work/rate/' . $postid, refresh);
                    } else {
                        redirect('freelancer-work/rate', refresh);
                    }
                } else {
                    $this->session->flashdata('error', 'Your data not inserted');
                    if ($postid) {
                        redirect('freelancer-work/rate/' . $postid, refresh);
                    } else {
                        redirect('freelancer-work/rate', refresh);
                    }
                }
            }
        }
    }

//FREELANCER_APPLY POST_PROFESSIONAL_INFORMATION INSERT DATA END
//FREELANCER_APPLY RATE PAGE START
//freelancer rate page controller Start 
    public function freelancer_post_rate($postid = '') {

        if ($postid != '') {
            $this->data['livepostid'] = $postid;
        }
        $userid = $this->session->userdata('aileenuser');
//code for check user deactivate start
        $this->freelancer_apply_deactivate_check();
        //code for check user deactivate end
// code for display page start
        $this->freelancer_apply_check();
        // code for display page end
        $contition_array = array('status' => 1, 'is_delete' => 0);
        $this->data['currency'] = $this->common->select_data_by_condition('currency', $contition_array, $data = '*', $sortby = 'currency_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        $contition_array = array('user_id' => $userid, 'is_delete' => '0', 'status' => '1');
        $userdata = $this->common->select_data_by_condition('freelancer_post_reg', $contition_array, $data = 'freelancer_post_hourly,freelancer_post_ratestate,freelancer_post_fixed_rate,free_post_step,user_id', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        if ($userdata) {
            $step = $userdata[0]['free_post_step'];
            if ($step == 4 || ($step >= 1 && $step <= 4) || $step > 4) {
                $this->data['hourly1'] = $userdata[0]['freelancer_post_hourly'];
                $this->data['currency1'] = $userdata[0]['freelancer_post_ratestate'];
                $this->data['fixed_rate1'] = $userdata[0]['freelancer_post_fixed_rate'];
            }
        }
        $this->load->view('freelancer/freelancer_post/freelancer_post_rate', $this->data);
    }

//FREELANCER_APPLY RATE PAGE END
//FREELANCER_APPLY RATE PAGE DATA INSERT START
    public function freelancer_post_rate_insert() {
        if ($this->input->post('livepostid')) {
            $postid = trim($this->input->post('livepostid'));
        }
        $userid = $this->session->userdata('aileenuser');

        if ($this->input->post('next')) {
            if ($this->input->post('fixed_rate') == 1) {
                $data = array(
                    'freelancer_post_fixed_rate' => trim($this->input->post('fixed_rate')),
                );
            } else {
                $data = array(
                    'freelancer_post_fixed_rate' => 0,
                );
            }
            $updatdata = $this->common->update_data($data, 'freelancer_post_reg', 'user_id', $userid);

            $contition_array = array('user_id' => $userid, 'is_delete' => '0', 'status' => '1');
            $userdata = $this->common->select_data_by_condition('freelancer_post_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
            if ($userdata[0]['free_post_step'] == 7) {
                $data = array(
                    'free_post_step' => 7
                );
                $updatedata = $this->common->update_data($data, 'freelancer_post_reg', 'user_id', $userid);
            } else if ($userdata[0]['free_post_step'] > 4) {
                $data = array(
                    'free_post_step' => $userdata[0]['free_post_step']
                );
                $updatedata = $this->common->update_data($data, 'freelancer_post_reg', 'user_id', $userid);
            } else {
                $data = array(
                    'free_post_step' => 4
                );
                $updatedata = $this->common->update_data($data, 'freelancer_post_reg', 'user_id', $userid);
            }
            $data = array(
                'freelancer_post_hourly' => trim($this->input->post('hourly')),
                'freelancer_post_ratestate' => trim($this->input->post('state')),
                'modify_date' => date('Y-m-d', time())
            );
            $updatdata = $this->common->update_data($data, 'freelancer_post_reg', 'user_id', $userid);
            if ($updatdata) {
                $this->session->set_flashdata('success', 'Rate information updated successfully');
                if ($postid) {
                    redirect('freelancer-work/avability/' . $postid, refresh);
                } else {
                    redirect('freelancer-work/avability', refresh);
                }
            } else {
                $this->session->flashdata('error', 'Your data not inserted');
                if ($postid) {
                    redirect('freelancer-work/rate/' . $postid, refresh);
                } else {
                    redirect('freelancer-work/rate', refresh);
                }
            }
        }
    }

//FREELANCER_APPLY RATE PAGE DATA INSERT END
//FREELANCER_APPLY AVABILITY PAGE START
//freelancer avability page controller Start
    public function freelancer_post_avability($postid = '') {
        if ($postid != '') {
            $this->data['livepostid'] = $postid;
        }
        $userid = $this->session->userdata('aileenuser');
//code for check user deactivate start
        $this->freelancer_apply_deactivate_check();
        //code for check user deactivate end
        // code for display page start
        $this->freelancer_apply_check();
        // code for display page end
        $contition_array = array('user_id' => $userid, 'is_delete' => '0', 'status' => '1');
        $userdata = $this->common->select_data_by_condition('freelancer_post_reg', $contition_array, $data = 'freelancer_post_job_type,freelancer_post_work_hour,free_post_step,user_id', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
        if ($userdata) {
            $step = $userdata[0]['free_post_step'];

            if ($step == 5 || ($step >= 1 && $step <= 5) || $step > 5) {

                $this->data['job_type1'] = $userdata[0]['freelancer_post_job_type'];
                $this->data['work_hour1'] = $userdata[0]['freelancer_post_work_hour'];
            }
        }

        $this->load->view('freelancer/freelancer_post/freelancer_post_avability', $this->data);
    }

//FREELANCER_APPLY AVABILITY PAGE END
//FREELANCER_APPLY AVABILITY PAGE DATA INSERT START
    public function freelancer_post_avability_insert() {
        if ($this->input->post('livepostid')) {
            $postid = trim($this->input->post('livepostid'));
        }
        $userid = $this->session->userdata('aileenuser');
        if ($this->input->post('previous')) {
            redirect('freelancer/freelancer_post_rate', refresh);
        }

        if ($this->input->post('next')) {
            $contition_array = array('user_id' => $userid, 'is_delete' => '0', 'status' => '1');
            $userdata = $this->common->select_data_by_condition('freelancer_post_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
            if ($userdata[0]['free_post_step'] == 7) {
                $data = array(
                    'free_post_step' => 7
                );
                $updatedata = $this->common->update_data($data, 'freelancer_post_reg', 'user_id', $userid);
            } else if ($userdata[0]['free_post_step'] > 5) {
                $data = array(
                    'free_post_step' => $userdata[0]['free_post_step']
                );
                $updatedata = $this->common->update_data($data, 'freelancer_post_reg', 'user_id', $userid);
            } else {
                $data = array(
                    'free_post_step' => 5
                );
                $updatedata = $this->common->update_data($data, 'freelancer_post_reg', 'user_id', $userid);
            }
            $data = array(
                'freelancer_post_job_type' => trim($this->input->post('job_type')),
                'freelancer_post_work_hour' => trim($this->input->post('work_hour')),
                'modify_date' => date('Y-m-d', time())
            );

            $updatdata = $this->common->update_data($data, 'freelancer_post_reg', 'user_id', $userid);
            if ($updatdata) {
                $this->session->set_flashdata('success', 'Avability information updated successfully');
                if ($postid) {
                    redirect('freelancer-work/education/' . $postid, refresh);
                } else {
                    redirect('freelancer-work/education', refresh);
                }
            } else {
                $this->session->flashdata('error', 'Your data not inserted');
                if ($postid) {
                    redirect('freelancer-work/avability/' . $postid, refresh);
                } else {
                    redirect('freelancer-work/avability', refresh);
                }
            }
        }
    }

//FREELANCER_APPLY AVABILITY PAGE DATA INSERT END
//FREELANCER_APPLY EDUCATION PAGE START
    public function freelancer_post_education($postid = '') {

        if ($postid != '') {
            $this->data['livepostid'] = $postid;
        }

        $userid = $this->session->userdata('aileenuser');
//code for check user deactivate start
        $this->freelancer_apply_deactivate_check();
        //code for check user deactivate end
// code for display page start
        $this->freelancer_apply_check();
        // code for display page end
        //for getting degree data Strat
        $contition_array = array('is_delete' => '0', 'degree_name !=' => "Other");
        $search_condition = "((status = '2' AND user_id = $userid) OR (status = '1'))";
        $degree_data = $this->data['degree_data'] = $this->common->select_data_by_search('degree', $search_condition, $contition_array, $data = '*', $sortby = 'degree_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        $contition_array = array('status' => 1, 'is_delete' => '0', 'degree_name' => "Other");
        $this->data['degree_otherdata'] = $this->common->select_data_by_condition('degree', $contition_array, $data = '*', $sortby = 'degree_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');
        //for getting degree data End
        //For getting all Stream Strat
        $contition_array = array('is_delete' => '0', 'stream_name !=' => "Other");
        $search_condition = "((status = '2' AND user_id = $userid) OR (status = '1')) AND stream_name != 'Others'";
        $stream_alldata = $this->data['stream_alldata'] = $this->common->select_data_by_search('stream', $search_condition, $contition_array, $data = '*', $sortby = 'stream_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = 'stream_name');


        $contition_array = array('status' => 1, 'is_delete' => 0, 'stream_name' => "Other");
        $stream_otherdata = $this->data['stream_otherdata'] = $this->common->select_data_by_condition('stream', $contition_array, $data = '*', $sortby = 'stream_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = 'stream_name');
        //For getting all Stream End
        //for getting univesity data Start
        $contition_array = array('is_delete' => '0', 'university_name !=' => "Other");
        $search_condition = "((status = '2' AND user_id = $userid) OR (status = '1'))";
        $university_data = $this->data['university_data'] = $this->common->select_data_by_search('university', $search_condition, $contition_array, $data = '*', $sortby = 'university_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        $contition_array = array('is_delete' => '0', 'status' => 1, 'university_name' => "Other");
        $this->data['university_otherdata'] = $this->common->select_data_by_condition('university', $contition_array, $data = '*', $sortby = 'university_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');
        //for getting univesity data End
        $contition_array = array('user_id' => $userid, 'is_delete' => '0', 'status' => '1');
        $userdata = $this->common->select_data_by_condition('freelancer_post_reg', $contition_array, $data = 'freelancer_post_degree,freelancer_post_stream,freelancer_post_univercity,freelancer_post_collage,freelancer_post_percentage,freelancer_post_passingyear,free_post_step,user_id', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        if ($userdata) {
            $step = $userdata[0]['free_post_step'];
            if ($step == 6 || ($step >= 1 && $step <= 6) || $step > 6) {
                $this->data['degree1'] = $userdata[0]['freelancer_post_degree'];
                $this->data['stream1'] = $userdata[0]['freelancer_post_stream'];
                $this->data['university1'] = $userdata[0]['freelancer_post_univercity'];
                $this->data['college1'] = $userdata[0]['freelancer_post_collage'];
                $this->data['percentage1'] = $userdata[0]['freelancer_post_percentage'];
                $this->data['pass_year1'] = $userdata[0]['freelancer_post_passingyear'];
            }
        }

        $this->load->view('freelancer/freelancer_post/freelancer_post_education', $this->data);
    }

//FREELANCER_APPLY EDUCATION PAGE END
//ADD OTHER UNIVERSITY INTO DATABASE START
    public function freelancer_other_university() {
        $other_university = $_POST['other_university'];
        $this->data['userid'] = $userid = $this->session->userdata('aileenuser');

        $contition_array = array('is_delete' => '0', 'university_name' => $other_university);
        $search_condition = "((status = '2' AND user_id = $userid) OR (status = '1'))";
        $userdata = $this->data['userdata'] = $this->common->select_data_by_search('university', $search_condition, $contition_array, $data = '*', $sortby = 'university_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');
        $count = count($userdata);

        if ($other_university != NULL) {
            if ($count == 0) {
                $data = array(
                    'university_name' => $other_university,
                    'created_date' => date('Y-m-d h:i:s', time()),
                    'status' => 2,
                    'is_delete' => 0,
                    'is_other' => '1',
                    'user_id' => $userid
                );
                $insert_id = $this->common->insert_data_getid($data, 'university');
                if ($insert_id) {

                    $contition_array = array('is_delete' => '0', 'university_name !=' => "Other");
                    $search_condition = "((status = '2' AND user_id = $userid) OR (status = '1'))";
                    $university = $this->data['university'] = $this->common->select_data_by_search('university', $search_condition, $contition_array, $data = '*', $sortby = 'university_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');
                    if (count($university) > 0) {
                        $select = '<option value="" selected option disabled>Select your University</option>';
                        foreach ($university as $st) {
                            $select .= '<option value="' . $st['university_id'] . '"';
                            if ($st['university_name'] == $other_university) {
                                $select .= 'selected';
                            }
                            $select .= '>' . $st['university_name'] . '</option>';
                        }
                    }
//For Getting Other at end
                    $contition_array = array('is_delete' => '0', 'status' => 1, 'university_name' => "Other");
                    $university_otherdata = $this->common->select_data_by_condition('university', $contition_array, $data = '*', $sortby = 'university_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');
                    $select .= '<option value="' . $university_otherdata[0]['university_id'] . '">' . $university_otherdata[0]['university_name'] . '</option>';
                }
            } else {
                $select .= 0;
            }
        } else {
            $select .= 1;
        }
        echo json_encode(array(
            "select" => $select,
        ));
    }

//ADD OTHER UNIVERSITY INTO DATABASE END
//FREELANCER_APPLY EDUCATION PAGE DATA INSERT START
    public function freelancer_post_education_insert() {

        if ($this->input->post('livepostid')) {
            $postid = trim($this->input->post('livepostid'));
        }

        $userid = $this->session->userdata('aileenuser');

        $contition_array = array('user_id' => $userid, 'is_delete' => '0', 'status' => '1');
        $userdata = $this->common->select_data_by_condition('freelancer_post_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
        if ($userdata[0]['free_post_step'] == 7) {
            $data = array(
                'free_post_step' => 7
            );
            $updatedata = $this->common->update_data($data, 'freelancer_post_reg', 'user_id', $userid);
        } else if ($userdata[0]['free_post_step'] > 6) {
            $data = array(
                'free_post_step' => $userdata[0]['free_post_step']
            );
            $updatedata = $this->common->update_data($data, 'freelancer_post_reg', 'user_id', $userid);
        } else {
            $data = array(
                'free_post_step' => 6
            );
            $updatedata = $this->common->update_data($data, 'freelancer_post_reg', 'user_id', $userid);
        }
        $data = array(
            'freelancer_post_degree' => trim($this->input->post('degree')),
            'freelancer_post_stream' => trim($this->input->post('stream')),
            'freelancer_post_univercity' => trim($this->input->post('university')),
            'freelancer_post_collage' => trim($this->input->post('college')),
            'freelancer_post_percentage' => trim($this->input->post('percentage')),
            'freelancer_post_passingyear' => trim($this->input->post('passingyear')),
            'modify_date' => date('Y-m-d', time())
        );
        $updatdata = $this->common->update_data($data, 'freelancer_post_reg', 'user_id', $userid);
        if ($updatdata) {
            $this->session->set_flashdata('success', 'Education information updated successfully');
            if ($postid) {
                redirect('freelancer-work/portfolio/' . $postid, refresh);
            } else {
                redirect('freelancer-work/portfolio', refresh);
            }
        } else {
            $this->session->flashdata('error', 'Your data not inserted');
            if ($postid) {
                redirect('freelancer-work/education/' . $postid, refresh);
            } else {
                redirect('freelancer-work/education', refresh);
            }
        }
    }

//FREELANCER_APPLY EDUCATION PAGE DATA INSERT END
//FREELANCER_APPLY PORTFOLIO PAGE START
    public function freelancer_post_portfolio($postid = '') {
        if ($postid != '') {
            $this->data['livepostid'] = $postid;
        }

        $userid = $this->session->userdata('aileenuser');
//code for check user deactivate start
        $this->freelancer_apply_deactivate_check();
        //code for check user deactivate end
// code for display page start
        $this->freelancer_apply_check();
// code for display page end
        $contition_array = array('user_id' => $userid, 'is_delete' => '0', 'status' => '1');
        $userdata = $this->common->select_data_by_condition('freelancer_post_reg', $contition_array, $data = 'freelancer_post_portfolio,freelancer_post_portfolio_attachment,free_post_step,user_id', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
        $this->data['free_post_step'] = $userdata[0]['free_post_step'];
        if ($userdata) {
            $step = $userdata[0]['free_post_step'];
            if ($step == 7 || ($step >= 1 && $step <= 7) || $step > 7) {
                $this->data['portfolio1'] = $userdata[0]['freelancer_post_portfolio'];
                $this->data['portfolio_attachment1'] = $userdata[0]['freelancer_post_portfolio_attachment'];
            }
        }
        $this->load->view('freelancer/freelancer_post/freelancer_post_portfolio', $this->data);
    }

//FREELANCER_APPLY PORTFOLIO PAGE END
//FREELANCER_APPLY PORTFOLIO PAGE DATA INSERT START
    public function freelancer_post_portfolio_insert($postliveid = '') {
        // echo 123; die();
        if ($postliveid) {

            $id = trim($postliveid);
            $userid = $this->session->userdata('aileenuser');
            $notid = $this->db->select('user_id')->get_where('freelancer_post', array('post_id' => $id))->row()->user_id;

            $contition_array = array('post_id' => $id, 'user_id' => $userid, 'is_delete' => 0);
            $userdata = $this->common->select_data_by_condition('freelancer_apply', $contition_array, $data = '*', $sortby = '', $orderby = 'desc', $limit = '', $offset = '', $join_str = array(), $groupby = '');

            if ($userdata) {
                
            } else {
                $data = array(
                    'post_id' => $id,
                    'user_id' => $userid,
                    'status' => 1,
                    'created_date' => date('Y-m-d h:i:s', time()),
                    'modify_date' => date('Y-m-d h:i:s', time()),
                    'is_delete' => 0,
                    'job_delete' => 0,
                    'job_save' => 3
                );
                $insert_id = $this->common->insert_data_getid($data, 'freelancer_apply');
                // insert notification
                $data = array(
                    'not_type' => 3,
                    'not_from_id' => $userid,
                    'not_to_id' => $notid,
                    'not_read' => 2,
                    'not_from' => 4,
                    'not_product_id' => $insert_id,
                    "not_active" => 1,
                    'not_created_date' => date('Y-m-d H:i:s')
                );

                $insert_id = $this->common->insert_data_getid($data, 'notification');
                // end notoification
                if ($insert_id) {

                    $this->apply_email($notid);
                    $applypost = 'Applied';
                }
                echo $applypost;
            }
        }

        $portfolio = $_POST['portfolio'];
        $userid = $this->session->userdata('aileenuser');
        $contition_array = array('user_id' => $userid, 'is_delete' => '0', 'status' => '1');

        $userdatacon = $this->common->select_data_by_condition('freelancer_post_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
        $portfolio = trim($_POST['portfolio']);
        $image_hidden_portfolio = $_POST['image_hidden_portfolio'];
        $config = array(
            'upload_path' => $this->config->item('free_portfolio_main_upload_path'),
            'max_size' => 2500000000000,
            'allowed_types' => $this->config->item('free_portfolio_main_allowed_types'),
            'file_name' => $_FILES['freelancer_post_portfolio_attachment']['name']
        );
        //Load upload library and initialize configuration
        $images = array();
        $files = $_FILES;

        $this->load->library('upload');

        $fileName = $_FILES['image']['name'];
        $images[] = $fileName;
        $config['file_name'] = $fileName;

        $this->upload->initialize($config);
        $this->upload->do_upload();
        if ($this->upload->do_upload('image')) {

            $response['result'] = $this->upload->data();
            $art_post_thumb['image_library'] = 'gd2';
            $art_post_thumb['source_image'] = $this->config->item('free_portfolio_main_upload_path') . $response['result']['file_name'];
            $art_post_thumb['new_image'] = $this->config->item('free_portfolio_thumb_upload_path') . $response['result']['file_name'];
            $art_post_thumb['create_thumb'] = TRUE;
            $art_post_thumb['maintain_ratio'] = TRUE;
            $art_post_thumb['thumb_marker'] = '';
            $art_post_thumb['width'] = $this->config->item('art_portfolio_thumb_width');
            $art_post_thumb['height'] = 2;
            $art_post_thumb['master_dim'] = 'width';
            $art_post_thumb['quality'] = "100%";
            $art_post_thumb['x_axis'] = '0';
            $art_post_thumb['y_axis'] = '0';
            $instanse = "image_$i";
            //Loading Image Library
            $this->load->library('image_lib', $art_post_thumb, $instanse);
            $dataimage = $response['result']['file_name'];

            //Creating Thumbnail
            $this->$instanse->resize();
            $response['error'][] = $thumberror = $this->$instanse->display_errors();
            $return['data'][] = $this->upload->data();
            $return['status'] = "success";
            $return['msg'] = sprintf($this->lang->line('success_item_added'), "Image", "uploaded");
        } else {
            $dataimage = $image_hidden_portfolio;
        }
        $data = array(
            'freelancer_post_portfolio_attachment' => $dataimage,
            'freelancer_post_portfolio' => $portfolio,
            'modify_date' => date('Y-m-d', time()),
            'free_post_step' => 7
        );
        $updatdata = $this->common->update_data($data, 'freelancer_post_reg', 'user_id', $userid);
    }

//FREELANCER_APPLY PORTFOLIO PAGE DATA INSERT END
//FREELANCER_HIRE DEACTIVATE CHECK START
    public function freelancer_hire_deactivate_check() {
        $userid = $this->session->userdata('aileenuser');
//if user deactive profile then redirect to freelancer_hire/freelancer_hire/freelancer_hire_basic_info  start
        $contition_array = array('user_id' => $userid, 'status' => '0', 'is_delete' => '0');
        $freelancerhire_deactive = $this->data['freelancerhire_deactive'] = $this->common->select_data_by_condition('freelancer_hire_reg', $contition_array, $data = 'user_id', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);
        if ($freelancerhire_deactive) {
            redirect('freelancer_hire/freelancer_hire/freelancer_hire_basic_info');
        }
//if user deactive profile then redirect to freelancer_hire/freelancer_hire/freelancer_hire_basic_info  End
    }

//FREELANCER_HIRE DEACTIVATE CHECK END
//FREELANCER_HIRE POST(PROJECT) PAGE START
    public function freelancer_hire_post($id = "") {
        if (is_numeric($id)) {
            
        } else {
            $id = $this->db->select('')->select('user_id')->get_where('freelancer_hire_reg', array('freelancer_hire_slug' => $id, 'status' => 1))->row()->user_id;
        }
        $userid = $this->session->userdata('aileenuser');
        //check user deactivate start
        $this->freelancer_hire_deactivate_check();
        //check user deactivate end
        if ($id == '') {
            // code for display page start
            $this->freelancer_hire_check();
            // code for display page end
            $contition_array = array('is_delete' => '0', 'user_id' => $userid, 'status' => '1', 'free_hire_step' => 3);
            $data = 'username,fullname,designation,freelancer_hire_user_image,user_id';
            $hire_data = $this->data['freelancr_user_data'] = $this->common->select_data_by_condition('freelancer_hire_reg', $contition_array, $data, $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str, $groupby = '');
        } else {
            $userid = $id;
            $contition_array = array('is_delete' => '0', 'user_id' => $userid, 'status' => '1', 'free_hire_step' => 3);
            $data = 'username,fullname,designation,freelancer_hire_user_image,user_id';
            $hire_data = $this->data['freelancr_user_data'] = $this->common->select_data_by_condition('freelancer_hire_reg', $contition_array, $data, $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str, $groupby = '');
        }
        $this->data['title'] = $hire_data[0]['fullname'] . " " . $hire_data[0]['username'] . TITLEPOSTFIX;
        $this->load->view('freelancer/freelancer_hire/freelancer_hire_post', $this->data);
    }

//FREELANCER_HIRE POST(PROJECT) PAGE END
//AJAX DATA FOR FREELANCER_HIRE POST(PROJECT) PAGE START
    public function ajax_freelancer_hire_post($id = "", $retur = "") {

        $userid = $this->session->userdata('aileenuser');
        $perpage = 5;
        $page = 1;
        if (!empty($_GET["page"]) && $_GET["page"] != 'undefined') {
            $page = $_GET["page"];
        }
        $start = ($page - 1) * $perpage;
        if ($start < 0)
            $start = 0;
        if ($id == 'null') {

            $join_str[0]['table'] = 'freelancer_hire_reg';
            $join_str[0]['join_table_id'] = 'freelancer_hire_reg.user_id';
            $join_str[0]['from_table_id'] = 'freelancer_post.user_id';
            $join_str[0]['join_type'] = '';

            $limit = $perpage;
            $offset = $start;

            $contition_array = array('freelancer_post.is_delete' => '0', 'freelancer_hire_reg.user_id' => $userid, 'freelancer_hire_reg.status' => '1', 'freelancer_hire_reg.free_hire_step' => 3);
            $data = 'freelancer_post.post_id,freelancer_post.post_name,freelancer_post.post_field_req,freelancer_post.post_est_time,freelancer_post.post_skill,freelancer_post.post_other_skill,freelancer_post.post_rate,freelancer_post.post_last_date,freelancer_post.post_description,freelancer_post.user_id,freelancer_post.created_date,freelancer_post.post_currency,freelancer_post.post_rating_type,freelancer_post.post_exp_month,freelancer_post.post_exp_year,freelancer_hire_reg.username,freelancer_hire_reg.fullname,freelancer_hire_reg.designation,freelancer_hire_reg.freelancer_hire_user_image,freelancer_hire_reg.country,freelancer_hire_reg.city';
            $postdata = $this->common->select_data_by_condition('freelancer_post', $contition_array, $data, $sortby = 'freelancer_post.post_id', $orderby = 'desc', $limit = '', $offset = '', $join_str, $groupby = '');
            $postdata1 = $this->common->select_data_by_condition('freelancer_post', $contition_array, $data, $sortby = 'freelancer_post.post_id', $orderby = 'desc', $limit, $offset = '', $join_str, $groupby = '');
        } else {
            if (is_numeric($id)) {
                
            } else {
                $id = $category = $this->db->select('user_id')->get_where('freelancer_hire_reg', array('freelancer_hire_slug' => $id, 'status' => 1))->row()->user_id;
            }

            $userid = $id;
            $join_str[0]['table'] = 'freelancer_hire_reg';
            $join_str[0]['join_table_id'] = 'freelancer_hire_reg.user_id';
            $join_str[0]['from_table_id'] = 'freelancer_post.user_id';
            $join_str[0]['join_type'] = '';

            $limit = $perpage;
            $offset = $start;

            $contition_array = array('freelancer_post.is_delete' => '0', 'freelancer_hire_reg.user_id' => $userid, 'freelancer_hire_reg.status' => '1', 'freelancer_hire_reg.free_hire_step' => 3);
            $data = 'freelancer_post.post_id,freelancer_post.post_name,freelancer_post.post_field_req,freelancer_post.post_est_time,freelancer_post.post_skill,freelancer_post.post_other_skill,freelancer_post.post_rate,freelancer_post.post_last_date,freelancer_post.post_description,freelancer_post.user_id,freelancer_post.created_date,freelancer_post.post_currency,freelancer_post.post_rating_type,freelancer_post.post_exp_month,freelancer_post.post_exp_year,freelancer_hire_reg.username,freelancer_hire_reg.fullname,freelancer_hire_reg.designation,freelancer_hire_reg.freelancer_hire_user_image,freelancer_hire_reg.country,freelancer_hire_reg.city';
            $postdata = $this->common->select_data_by_condition('freelancer_post', $contition_array, $data, $sortby = 'freelancer_post.post_id', $orderby = 'desc', $limit = '', $offset = '', $join_str, $groupby = '');
            $postdata1 = $this->common->select_data_by_condition('freelancer_post', $contition_array, $data, $sortby = 'freelancer_post.post_id', $orderby = 'desc', $limit, $offset = '', $join_str, $groupby = '');
        }

        $return_html = '';
        $return_html .= '<input type="hidden" class="page_number" value="' . $page . '" />';
        $return_html .= '<input type="hidden" class="total_record" value="' . $_GET["total_record"] . '" />';

        if (count($postdata) > 0) {
            foreach ($postdata1 as $post) {
                $userid = $this->session->userdata('aileenuser');
                $return_html .= '<div class="job-contact-frnd ">
                    <div class="profile-job-post-detail clearfix" id="removeapply' . $post['post_id'] . '">';
                $return_html .= ' <div class="profile-job-post-title-inside clearfix">
                            <div class="profile-job-post-title clearfix margin_btm" >
                                <div class="profile-job-profile-button clearfix">
                                    <div class="profile-job-details col-md-12">
                                        <ul>
                                            <li class="fr">';
                $cache_time1 = $post['post_name'];
                $text = str_replace(" ", "-", $cache_time1);
                $text = preg_replace("/[!$#%()]+/i", "", $text);
                $text = strtolower($text);

                $cityname = $this->db->select('city_name')->get_where('cities', array('city_id' => $post['city']))->row()->city_name;

                $cityname1 = str_replace(" ", "-", $cityname);
                $cityname1 = preg_replace("/[!$#%()]+/i", "", $cityname1);
                $cityname1 = strtolower($cityname1);

                $return_html .= $this->lang->line("created_date");
                $return_html .= ':';
                $return_html .= trim(date('d-M-Y', strtotime($post['created_date'])));
                $return_html .= '</li>';
                $return_html .= '<li>';
                $return_html .= '<a href="' . base_url('freelancer-hire/project/' . $text . '-vacancy-in-' . $cityname1 . '-' . $post['user_id'] . '-' . $post['post_id']) . '" title="' . ucwords($this->text2link($post['post_name'])) . '" class="post_title ">
                                                    ' . ucwords($this->text2link($post['post_name'])) . '</a> </li>';

                $firstname = $this->db->select('fullname')->get_where('freelancer_hire_reg', array('user_id' => $post['user_id']))->row()->fullname;
                $lastname = $this->db->select('username')->get_where('freelancer_hire_reg', array('user_id' => $post['user_id']))->row()->username;

                $countryname = $this->db->select('country_name')->get_where('countries', array('country_id' => $post['country']))->row()->country_name;
                $return_html .= '<li>';
                if ($retur == 'freelancer_post') {
                    $return_html .= '<a class="display_inline" title="' . ucwords($firstname) . '&nbsp;' . ucwords($lastname) . '" href="' . base_url('freelancer-hire/employer-details/' . $post['user_id'] . '?page=freelancer_post') . '"> ' . ucwords($firstname) . '&nbsp;' . ucwords($lastname) . '</a>';
                    if ($cityname || $countryname) {
                        $return_html .= ' <div class="fr lction display_inline">
                                          <p title="Location"><i class="fa fa-map-marker" aria-hidden="true"></i>';
                        if ($cityname) {
                            $return_html .= $cityname . ",";
                        }
                        $return_html .= $countryname;
                        $return_html .= '</p>
                                         </div>';
                    }
                } else {

                    $return_html .= ' <a class="display_inline" title="' . ucwords($firstname) . '&nbsp; ' . ucwords($lastname) . '" href="' . base_url('freelancer-hire/employer-details/' . $post['user_id']) . '"> ' . ucwords($firstname) . '&nbsp; ' . ucwords($lastname) . '</a>';
                    if ($cityname || $countryname) {
                        $return_html .= '<div class="fr lction display_inline">
                                                            <p title="Location">
                                                                <i class="fa fa-map-marker" aria-hidden="true"></i>';
                        if ($cityname) {
                            $return_html .= $cityname . ",";
                        }
                        $return_html .= $countryname;
                        $return_html .= '</p></div>';
                    }
                }
                $return_html .= '</li>
                                     </ul>
                                    </div>
                                </div>
                                <div class="profile-job-profile-menu">
                                    <ul class="clearfix">
                                        <li> <b>';
                $return_html .= $this->lang->line("field");
                $return_html .= '</b> 
                                        <span>';
                $return_html .= $this->db->select('category_name')->get_where('category', array('category_id' => $post['post_field_req']))->row()->category_name;
                $return_html .= ' </span>
                                        </li>
                                        <li> <b>';
                $return_html .= $this->lang->line("skill");
                $return_html .= '</b> <span> ';
                $comma = " , ";
                $k = 0;
                $aud = $post['post_skill'];
                $aud_res = explode(',', $aud);
                if (!$post['post_skill']) {
                    $return_html .= $post['post_other_skill'];
                } else if (!$post['post_other_skill']) {
                    foreach ($aud_res as $skill) {
                        if ($k != 0) {
                            $return_html .= $comma;
                        }
                        $cache_time = $this->db->select('skill')->get_where('skill', array('skill_id' => $skill))->row()->skill;
                        $return_html .= $cache_time;
                        $k++;
                    }
                } else if ($post['post_skill'] && $post['post_other_skill']) {
                    foreach ($aud_res as $skill) {
                        if ($k != 0) {
                            $return_html .= $comma;
                        }
                        $cache_time = $this->db->select('skill')->get_where('skill', array('skill_id' => $skill))->row()->skill;
                        $return_html .= $cache_time;
                        $k++;
                    }
                    $return_html .= "," . $post['post_other_skill'];
                }
                $return_html .= '</span>
                                        </li>
                                        <li><b>';
                $return_html .= $this->lang->line("project_description");
                $return_html .= '</b><span><pre>';

                if ($post['post_description']) {
                    $return_html .= $this->common->make_links($post['post_description']);
                } else {
                    $return_html .= PROFILENA;
                }
                $return_html .= '</pre></span>
                                         </li>
                                        <li>
                                        <b>';
                $return_html .= $this->lang->line("rate");
                $return_html .= '</b><span>';

                if ($post['post_rate']) {
                    $return_html .= $post['post_rate'];
                    $return_html .= "&nbsp";
                    $return_html .= $this->db->select('currency_name')->get_where('currency', array('currency_id' => $post['post_currency']))->row()->currency_name;
                    $return_html .= "&nbsp";
                    if ($post['post_rating_type'] == 0) {
                        $return_html .= "Hourly";
                    } else {
                        $return_html .= "Fixed";
                    }
                } else {
                    $return_html .= PROFILENA;
                }
                $return_html .= '</span> </li> <li> <b>';
                $return_html .= $this->lang->line("required_experiance");
                $return_html .= '</b> <span>';

                if ($post['post_exp_month'] || $post['post_exp_year']) {
                    if ($post['post_exp_year']) {
                        $return_html .= $post['post_exp_year'];
                    }
                    if ($post['post_exp_month']) {
                        if ($post['post_exp_year'] == '' || $post['post_exp_year'] == '0') {
                            $return_html .= 0;
                        }
                        $return_html .= ".";
                        $return_html .= $post['post_exp_month'];
                    }
                    $return_html .= " Year";
                } else {
                    $return_html .= PROFILENA;
                }

                $return_html .= '</span>  </li> <li> <b>';
                $return_html .= $this->lang->line("estimated_time");
                $return_html .= '</b>  <span>';

                if ($post['post_est_time']) {
                    $return_html .= $post['post_est_time'];
                } else {
                    $return_html .= PROFILENA;
                }
                $return_html .= '</span>
                                                      </li>
                                                                </ul>
                                                                    </div>
                                                                       <div class="profile-job-profile-button clearfix">
                                                                         <div class="profile-job-details col-md-12">
                                                                             <ul>
                                                                    <li class="job_all_post last_date">';
                $return_html .= $this->lang->line("last_date");
                $return_html .= ':';

                if ($post['post_last_date']) {
                    $return_html .= date('d-M-Y', strtotime($post['post_last_date']));
                } else {
                    $return_html .= PROFILENA;
                }
                $return_html .= '</li>';


                if ($retur == '' && $id == 'null') {

                    $return_html .= '<li class=fr><a href="javascript:void(0);" class="button" onclick="removepopup(' . $post['post_id'] . ')">';
                    $return_html .= $this->lang->line("remove");
                    $return_html .= '</a>
                                                          ';
                    $return_html .= '<a class="button" href="' . base_url('freelancer-hire/edit-projects/' . $post['post_id']) . '" >';
                    $return_html .= $this->lang->line("edit");
                    $return_html .= '</a>
                                                          
                                                       ';
                    $return_html .= '<a class="button" href="' . base_url('freelancer-hire/freelancer-applied/' . $post['post_id']) . '" >';
                    $return_html .= $this->lang->line("applied_person");
                    $return_html .= ':';
                    $return_html .= count($this->common->select_data_by_id('freelancer_apply', 'post_id', $post['post_id'], $data = '*', $join_str = array()));
                    $return_html .= '</a>';
                } else {

                    $this->data['userid'] = $userid = $this->session->userdata('aileenuser');
                    $contition_array = array('post_id' => $post['post_id'], 'job_delete' => 0, 'user_id' => $userid);
                    $freelancerapply1 = $this->data['freelancerapply'] = $this->common->select_data_by_condition('freelancer_apply', $contition_array, $data = '*', $sortby = '', $orderby = 'desc', $limit = '', $offset = '', $join_str = array(), $groupby = '');
                    if ($freelancerapply1) {
                        $return_html .= '<a href="javascript:void(0);" class="button applied">';
                        $return_html .= $this->lang->line("applied");
                        $return_html .= '</a>';
                    } else {
                        if (is_numeric($this->uri->segment(3))) {
                            $id = $this->uri->segment(3);
                        } else {
                            $id = $this->db->select('user_id')->get_where('freelancer_hire_reg', array('freelancer_hire_slug' => $this->uri->segment(3), 'status' => 1))->row()->user_id;
                        }
                        $return_html .= '<input type="hidden" id="allpost' . $post['post_id'] . '" value="all">';
                        $return_html .= '<input type="hidden" id="userid' . $post['post_id'] . '" value="' . $post['user_id'] . '">';
                        $return_html .= '<a href="javascript:void(0);"  class= "applypost' . $post['post_id'] . '  button" onclick="applypopup(' . $post['post_id'] . ',' . $id . ')">';
                        $return_html .= $this->lang->line("apply");
                        $return_html .= '</a>
                                                              </li>
                                                               <li>';

                        $userid = $this->session->userdata('aileenuser');
                        $contition_array = array('user_id' => $userid, 'job_save' => '2', 'post_id ' => $post['post_id'], 'job_delete' => '1');
                        $data = $this->data['jobsave'] = $this->common->select_data_by_condition('freelancer_apply', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
                        if ($data) {
                            $return_html .= '<a class="saved  button savedpost' . $post['post_id'] . '">';
                            $return_html .= $this->lang->line("saved");
                            $return_html .= '</a>';
                        } else {
                            $return_html .= '<input type="hidden" name="saveuser"  id="saveuser" value= "' . $data[0]['save_id'] . '">';
                            $return_html .= '<a id="' . $post['post_id'] . '" onClick="savepopup(' . $post['post_id'] . ')" href="javascript:void(0);" class="savedpost' . $post['post_id'] . ' applypost button">';
                            $return_html .= $this->lang->line("save");
                            $return_html .= '</a>';
                        }
                    }
                    $return_html .= '</li>';
                }
                $return_html .= '</ul>
                                                          </div>
                                                              </div>
                                                                 </div>
                                                                    </div>
                                                                      </div>
                                                                           </div>';
            }
        } else {
            $return_html .= '<div class="art-img-nn">
                                                <div class="art_no_post_img">

                                                    <img src="../assets/img/free-no1.png">

                                                </div>
                                                <div class="art_no_post_text">';
            $return_html .= $this->lang->line("no_post");
            $return_html .= ' </div>
                                            </div>';
        }

        echo $return_html;
    }

//AJAX DATA FOR FREELANCER_HIRE POST(PROJECT) PAGE START
    public function text2link($text) {
        $text = preg_replace('/(((f|ht){1}t(p|ps){1}:\/\/)[-a-zA-Z0-9@:%_\+.~#?&\/\/=]+)/i', '<a href="\\1" target="_blank" rel="nofollow">\\1</a>', $text);
        $text = preg_replace('/([[:space:]()[{}])(www.[-a-zA-Z0-9@:%_\+.~#?&\/\/=]+)/i', '\\1<a href="http://\\2" target="_blank" rel="nofollow">\\2</a>', $text);
        $text = preg_replace('/([_\.0-9a-z-]+@([0-9a-z][0-9a-z-]+\.)+[a-z]{2,3})/i', '<a href="mailto:\\1" rel="nofollow" target="_blank">\\1</a>', $text);
        return $text;
    }

//FREELANCER_HIRE ADD POST(PROJECT) START
    public function freelancer_add_post() {
        $userid = $this->session->userdata('aileenuser');
        //check user deactivate start
        $this->freelancer_hire_deactivate_check();
        //check user deactivate end
// code for display page start
        $this->freelancer_hire_check();
// code for display page end
        $contition_array = array('status' => 1);
        $this->data['countries'] = $this->common->select_data_by_condition('countries', $contition_array, $data = '*', $sortby = 'country_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        //for getting univesity data Start
        $contition_array = array('is_delete' => '0', 'category_name !=' => "Other");
        $search_condition = "((is_other = '2' AND user_id = $userid) OR (status = '1'))";
        $this->data['category_data'] = $this->common->select_data_by_search('category', $search_condition, $contition_array, $data = '*', $sortby = 'category_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        $contition_array = array('is_delete' => '0', 'status' => 1, 'category_name' => "Other");
        $this->data['category_otherdata'] = $this->common->select_data_by_condition('category', $contition_array, $data = '*', $sortby = 'category_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        //for getting univesity data End
        $contition_array = array('status' => 1);
        $this->data['currency'] = $this->common->select_data_by_condition('currency', $contition_array, $data = '*', $sortby = 'currency_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        $contition_array = array('is_delete' => '0', 'user_id' => $userid, 'status' => '1', 'free_hire_step' => 3);
        $data = 'username,fullname';
        $hire_data = $this->data['freelancr_user_data'] = $this->common->select_data_by_condition('freelancer_hire_reg', $contition_array, $data, $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str, $groupby = '');

        $this->data['title'] = $hire_data[0]['fullname'] . " " . $hire_data[0]['username'] . TITLEPOSTFIX;
        $this->load->view('freelancer/freelancer_hire/freelancer_add_post', $this->data);
    }

//FREELANCER_HIRE ADD POST(PROJECT) END
    public function aasort(&$array, $key) {
        $sorter = array();
        $ret = array();
        reset($array);

        foreach ($array as $ii => $va) {
            $sorter[$ii] = $va[$key];
        }

        arsort($sorter);

        foreach ($sorter as $ii => $va) {

            $ret[$ii] = $array[$ii];
        }

        return $array = $ret;
    }

    public function ajax_dataforcity() {

        if (isset($_POST["country_id"]) && !empty($_POST["country_id"])) {
            //Get all state data
            $contition_array = array('country_id' => $_POST["country_id"], 'status' => 1);
            $state = $this->data['states'] = $this->common->select_data_by_condition('states', $contition_array, $data = '*', $sortby = 'state_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');

            //Count total number of rows
            //Display states list
            if (count($state) > 0) {
                echo '<option value = "">Select state</option>';
                foreach ($state as $st) {
                    echo '<option value = "' . $st['state_id'] . '">' . $st['state_name'] . '</option>';
                }
            } else {
                echo '<option value = "">State not available</option>';
            }
        }

        if (isset($_POST["state_id"]) && !empty($_POST["state_id"])) {
            //Get all city data
            $contition_array = array('state_id' => $_POST["state_id"], 'status' => 1);
            $city = $this->data['city'] = $this->common->select_data_by_condition('cities', $contition_array, $data = '*', $sortby = 'city_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');

            //Display cities list
            if (count($city) > 0) {
                echo '<option value = "">Select city</option>';
                foreach ($city as $cit) {
                    echo '<option value = "' . $cit['city_id'] . '">' . $cit['city_name'] . '</option>';
                }
            } else {
                echo '<option value = "">City not available</option>';
            }
        }
    }

//FREELANCER_HIRE ADD POST(PROJECT) DATA INSERT START
    public function freelancer_add_post_insert() {
        $userid = $this->session->userdata('aileenuser');
        $skills = $this->input->post('skills');
        $skills = explode(',', $skills);

        $this->form_validation->set_rules('post_name', 'Post Name', 'required');
        $this->form_validation->set_rules('post_desc', 'Post description', 'required');
        $this->form_validation->set_rules('fields_req', 'Field required', 'required');
//        $this->form_validation->set_rules('country', 'Country', 'required');
//        $this->form_validation->set_rules('state', 'state', 'required');


        if ($this->form_validation->run() == FALSE) {
//            $contition_array = array('status' => 1);
//            $this->data['countries'] = $this->common->select_data_by_condition('countries', $contition_array, $data = '*', $sortby = 'country_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');

            $contition_array = array('status' => 1);
            $this->data['category'] = $this->common->select_data_by_condition('category', $contition_array, $data = '*', $sortby = 'category_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');

            $contition_array = array('status' => 1);
            $this->data['currency'] = $this->common->select_data_by_condition('currency', $contition_array, $data = '*', $sortby = 'currency_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');

            $contition_array = array('user_id' => $userid, 'status' => '1');
            $this->data['freelancerdata'] = $this->common->select_data_by_condition('freelancer_hire_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

            $this->load->view('freelancer/freelancer_hire/freelancer_add_post', $this->data);
        } else {
            $datereplace = $this->input->post('last_date');
            $lastdate = str_replace('/', '-', $datereplace);

            //skill code start
            if (count($skills) > 0) {
                foreach ($skills as $ski) {
                    if ($ski != " ") {
                        $contition_array = array('skill' => trim($ski), 'type' => 1);
                        $skilldata = $this->common->select_data_by_condition('skill', $contition_array, $data = 'skill_id,skill', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str5 = '', $groupby = '');

                        if (count($skilldata) < 0) {
                            $contition_array = array('skill' => trim($ski), 'type' => 5);
                            $skilldata = $this->common->select_data_by_condition('skill', $contition_array, $data = 'skill_id,skill', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str5 = '', $groupby = '');
                        }
                        if ($skilldata) {
                            $skill[] = $skilldata[0]['skill_id'];
                        } else {
                            $data = array(
                                'skill' => trim($ski),
                                'status' => '1',
                                'type' => 5,
                                'user_id' => $userid,
                            );
                            $skill[] = $this->common->insert_data_getid($data, 'skill');
                        }
                    }
                }
                $skill = array_unique($skill, SORT_REGULAR);
                $skills = implode(',', $skill);
            }
            //skill code end
            $data = array(
                'post_name' => trim($this->input->post('post_name')),
                'post_description' => trim($this->input->post('post_desc')),
                'post_field_req' => trim($this->input->post('fields_req')),
                'post_skill' => $skills,
                'post_other_skill' => trim($this->input->post('other_skill')),
                'post_est_time' => trim($this->input->post('est_time')),
                'post_rate' => trim($this->input->post('rate')),
                'post_currency' => trim($this->input->post('currency')),
                'post_rating_type' => trim($this->input->post('rating')),
                'post_exp_month' => trim($this->input->post('month')),
                'post_exp_year' => trim($this->input->post('year')),
                'post_last_date' => $lastdate,
                //'post_location' => $this->input->post('location'),
//                'country' => trim($this->input->post('country')),
//                'state' => trim($this->input->post('state')),
//                'city' => trim($this->input->post('city')),
                'user_id' => $userid,
                'created_date' => date('Y-m-d', time()),
                'status' => 1,
                'is_delete' => 0
            );

            $insert_id = $this->common->insert_data_getid($data, 'freelancer_post');
            if ($insert_id) {
                redirect('freelancer-hire/home', refresh);
            } else {
                $this->session->flashdata('error', 'Sorry!!Your data not inserted');
                redirect('freelancer/freelancer_post', refresh);
            }
        }
    }

//FREELANCER_HIRE ADD POST(PROJECT) DATA INSERT END
//FREELANCER_HIRE HOME PAGE START
    public function recommen_candidate() {
        $userid = $this->session->userdata('aileenuser');

        //check user deactivate start
        $this->freelancer_hire_deactivate_check();
        //check user deactivate end
        // code for display page start
        $this->freelancer_hire_check();
        // code for display page end
        $this->data['title'] = 'Freelancer Hire' . TITLEPOSTFIX;
        $this->load->view('freelancer/freelancer_hire/recommen_candidate', $this->data);
    }

//FREELANCER_HIRE HOME PAGE END
//AJAX FREELANCER_HIRE HOME PAGE START
    public function ajax_recommen_candidate() {

        $perpage = 5;
        $page = 1;
        if (!empty($_GET["page"]) && $_GET["page"] != 'undefined') {
            $page = $_GET["page"];
        }

        $start = ($page - 1) * $perpage;
        if ($start < 0)
            $start = 0;
        $userid = $this->session->userdata('aileenuser');

        $contition_array = array('user_id' => $userid, 'is_delete' => 0, 'status' => 1);
        $freelancerhiredata = $this->common->select_data_by_condition('freelancer_post', $contition_array, $data = '*', $sortby = 'post_id', $orderby = 'DESC', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        if (count($freelancerhiredata) <= 0) {
            $return_html .= '<div class="text-center rio" style="border: none;">';
            $return_html .= '<div class="no-post-title">';
            $return_html .= '<h4 class="page-heading  product-listing" style="border:0px;">Lets create your project.</h4>';
            $return_html .= '<h4 class="page-heading  product-listing" style="border:0px;"> It will takes only few minutes.</h4>';
            $return_html .= '</div>';
            $return_html .= '<div  class="add-post-button add-post-custom">';
            $return_html .= '<a class="btn btn-3 btn-3b"  href="' . base_url() . 'freelancer-hire/add-projects"><i class="fa fa-plus" aria-hidden="true"></i>  Post Project</a>';
            $return_html .= '</div>';
            $return_html .= '</div>';
            echo $return_html;
        } else {
            foreach ($freelancerhiredata as $frdata) {

                $post_skill_data = $frdata['post_skill'];
                $postuserarray = explode(',', $frdata['post_skill']);

                $all_candidate = array();
                foreach ($postuserarray as $skill_find) {

                    $contition_array = array('status' => '1', 'is_delete' => '0', 'free_post_step' => 7, 'user_id != ' => $userid, 'FIND_IN_SET("' . $skill_find . '", freelancer_post_area) != ' => '0');
                    $all_candidate[] = $this->common->select_data_by_condition('freelancer_post_reg', $contition_array, $data = 'freelancer_post_reg_id,freelancer_post_fullname, freelancer_post_username,freelancer_post_field, freelancer_post_city, freelancer_post_area, freelancer_post_skill_description, freelancer_post_hourly, freelancer_post_ratestate, freelancer_post_fixed_rate, freelancer_post_work_hour, user_id, freelancer_post_user_image, designation, freelancer_post_otherskill, freelancer_post_exp_month, freelancer_post_exp_year,freelancer_apply_slug,freelancer_post_country', $sortby = '', $orderby = 'desc', $limit = '', $offset = '', $join_str = array(), $groupby = '');
                }
                //        TO CHANGE ARRAY OF ARRAY TO ARRAY START
                $final_candidate = array_reduce($all_candidate, 'array_merge', array());
                //        TO CHANGE ARRAY OF ARRAY TO ARRAY END
                // change the order to decending           
                rsort($final_candidate);
                $pqr[] = $final_candidate;

                $contition_array = array('status' => '1', 'is_delete' => '0', 'free_post_step' => 7, 'user_id != ' => $userid, 'freelancer_post_field' => $frdata['post_field_req']);
                $freelancerpostfield[] = $this->common->select_data_by_condition('freelancer_post_reg', $contition_array, $data = 'freelancer_post_reg_id,freelancer_post_fullname, freelancer_post_username,freelancer_post_field, freelancer_post_city, freelancer_post_area, freelancer_post_skill_description, freelancer_post_hourly, freelancer_post_ratestate, freelancer_post_fixed_rate, freelancer_post_work_hour, user_id, freelancer_post_user_image, designation, freelancer_post_otherskill, freelancer_post_exp_month, freelancer_post_exp_year,freelancer_apply_slug,freelancer_post_country', $sortby = '', $orderby = 'asc', $limit = '', $offset = '', $join_str = array(), $groupby = '');
            }
            // die();
//        TO CHANGE ARRAY OF ARRAY TO ARRAY START
            $final_candidate = array_reduce($pqr, 'array_merge', array());
            $final_field = array_reduce($freelancerpostfield, 'array_merge', array());
//        TO CHANGE ARRAY OF ARRAY TO ARRAY END

            $applyuser_merge = array_merge((array) $final_candidate, (array) $final_field);
            $unique = array_unique($applyuser_merge, SORT_REGULAR);

            $candidatefreelancer = $unique;
            $candidatefreelancer1 = array_slice($candidatefreelancer, $start, $perpage);

            if (empty($_GET["total_record"])) {
                $_GET["total_record"] = count($candidatefreelancer);
            }

            $return_html = '';

            $return_html .= '<input type = "hidden" class = "page_number" value = "' . $page . '" />';
            $return_html .= '<input type = "hidden" class = "total_record" value = "' . $_GET["total_record"] . '" />';
            $return_html .= '<input type = "hidden" class = "perpage_record" value = "' . $perpage . '" />';

            if (count($candidatefreelancer) > 0) {
                foreach ($candidatefreelancer1 as $row) {
                    $return_html .= '<div class = "profile-job-post-detail clearfix">
                <div class = "profile-job-post-title-inside clearfix">
                <div class = "profile-job-profile-button clearfix">
                <div class = "profile-job-post-location-name-rec">
                <div class = "fl" style = "display: inline-block;">
                <div class = "buisness-profile-pic-candidate">';
                    $post_fname = $row['freelancer_post_fullname'];
                    $post_lname = $row['freelancer_post_username'];
                    $sub_post_fname = substr($post_fname, 0, 1);
                    $sub_post_lname = substr($post_lname, 0, 1);
                    if ($row['freelancer_post_user_image']) {
                        if (IMAGEPATHFROM == 'upload') {
                            if (!file_exists($this->config->item('free_post_profile_main_upload_path') . $row['freelancer_post_user_image'])) {
                                $return_html .= '<a href = "' . base_url('freelancer-work/freelancer-details/' . $row['freelancer_apply_slug'] . '?page=freelancer_hire') . '" title = "' . ucwords($row['freelancer_post_fullname']) . ' ' . ucwords($row['freelancer_post_username']) . '">';
                                $return_html .= '<div class = "post-img-div">';
                                $return_html .= ucfirst(strtolower($sub_post_fname)) . ucfirst(strtolower($sub_post_lname));
                                $return_html .= '</div>
                                 </a>';
                            } else {
                                $return_html .= '<a href = "' . base_url('freelancer-work/freelancer-details/' . $row['freelancer_apply_slug'] . '?page=freelancer_hire') . '" title = "' . ucwords($row['freelancer_post_fullname']) . ' ' . ucwords($row['freelancer_post_username']) . '">
                <img src = "' . FREE_POST_PROFILE_THUMB_UPLOAD_URL . $row['freelancer_post_user_image'] . '" alt = " ' . ucwords($row['freelancer_post_fullname']) . ' ' . ucwords($row['freelancer_post_username']) . '">
                </a>';
                            }
                        } else {
                            $filename = $this->config->item('free_post_profile_main_upload_path') . $row['freelancer_post_user_image'];
                            $s3 = new S3(awsAccessKey, awsSecretKey);
                            $this->data['info'] = $info = $s3->getObjectInfo(bucket, $filename);
                            if ($info) {
                                $return_html .= '<a href = "' . base_url('freelancer-work/freelancer-details/' . $row['freelancer_apply_slug'] . '?page=freelancer_hire') . '" title = "' . ucwords($row['freelancer_post_fullname']) . ' ' . ucwords($row['freelancer_post_username']) . '">
                <img src = "' . FREE_POST_PROFILE_THUMB_UPLOAD_URL . $row['freelancer_post_user_image'] . '" alt = " ' . ucwords($row['freelancer_post_fullname']) . ' ' . ucwords($row['freelancer_post_username']) . '">
                </a>';
                            } else {
                                $return_html .= '<a href = "' . base_url('freelancer-work/freelancer-details/' . $row['freelancer_apply_slug'] . '?page=freelancer_hire') . '" title = "' . ucwords($row['freelancer_post_fullname']) . ' ' . ucwords($row['freelancer_post_username']) . '">';
                                $return_html .= '<div class = "post-img-div">';
                                $return_html .= ucfirst(strtolower($sub_post_fname)) . ucfirst(strtolower($sub_post_lname));
                                $return_html .= '</div>
                </a>';
                            }
                        }
                    } else {
                        $return_html .= '<a href = "' . base_url('freelancer-work/freelancer-details/' . $row['freelancer_apply_slug'] . '?page=freelancer_hire') . '" title = "' . ucwords($row['freelancer_post_fullname']) . ' ' . ucwords($row['freelancer_post_username']) . '">';
                        $return_html .= '<div class = "post-img-div">';
                        $return_html .= ucfirst(strtolower($sub_post_fname)) . ucfirst(strtolower($sub_post_lname));
                        $return_html .= '</div>
                </a>';
                    }
                    $return_html .= '</div>
                </div>
                <div class = "designation_rec fl">
                <ul>
                <li>
                <a href = " ' . base_url('freelancer-work/freelancer-details/' . $row['freelancer_apply_slug'] . '?page=freelancer_hire') . '" title = "' . ucwords($row['freelancer_post_fullname']) . ' ' . ucwords($row['freelancer_post_username']) . '">
                <h6>';
                    $return_html .= ucwords($row['freelancer_post_fullname']) . ' ' . ucwords($row['freelancer_post_username']);
                    $return_html .= '</h6>
                </a>
                </li>
                <li style = "display: block;" >';
                    $return_html .= '<a href = "JavaScript:Void(0);" title = "' . ucwords($row['designation']) . '">';
                    if ($row['designation']) {
                        $return_html .= $row['designation'];
                    } else {
                        $return_html .= $this->lang->line("designation");
                    }
                    $return_html .= '</a></li>
                </ul>
                </div>
                </div>
                </div>
                </div> <div class = "profile-job-post-title clearfix">
                <div class = "profile-job-profile-menu">
                <ul class = "clearfix">
                <li><b>';
                    $return_html .= $this->lang->line("field");
                    $return_html .= '</b><span>';
                    if ($row['freelancer_post_field']) {
                        $field_name = $this->db->select('category_name')->get_where('category', array('category_id' => $row['freelancer_post_field']))->row()->category_name;
                        $return_html .= $field_name;
                    } else {
                        $return_html .= PROFILENA;
                    }

                    $return_html .= '</li></span><li><b>';
                    $return_html .= $this->lang->line("skill");
                    $return_html .= '</b><span>';
                    $aud = $row['freelancer_post_area'];
                    // echo $aud;
                    $aud_res = explode(',', $aud);
                    //echo "<pre>";print_r($aud_res);die();
                    if (!$row['freelancer_post_area']) {
                        $return_html .= $row['freelancer_post_otherskill'];
                    } elseif (!$row['freelancer_post_otherskill']) {
                        foreach ($aud_res as $skill) {
                            $cache_time = $this->db->select('skill')->get_where('skill', array('skill_id' => $skill))->row()->skill;
                            $skillsss[] = $cache_time;
                        }
                        $listskill = implode(', ', $skillsss);
                        $return_html .= $listskill;
                        unset($skillsss);
                    } elseif ($row['freelancer_post_area'] && $row['freelancer_post_otherskill']) {
                        foreach ($aud_res as $skillboth) {
                            $cache_time = $this->db->select('skill')->get_where('skill', array('skill_id' => $skillboth))->row()->skill;
                            $skilldddd[] = $cache_time;
                        }
                        $listFinal = implode(', ', $skilldddd);
                        $return_html .= $listFinal . "," . $row['freelancer_post_otherskill'];
                        unset($skilldddd);
                    }

                    $return_html .= '</span>
                </li>';
                    $cityname = $this->db->select('city_name')->get_where('cities', array('city_id' => $row['freelancer_post_city']))->row()->city_name;
                    $countryname = $this->db->select('country_name')->get_where('countries', array('country_id' => $row['freelancer_post_country']))->row()->country_name;
                    $return_html .= '<li><b>';
                    $return_html .= $this->lang->line("location");
                    $return_html .= '</b><span>';
                    if ($cityname || $countryname) {
                        if ($cityname) {
                            $return_html .= $cityname . ",";
                        }
                        if ($countryname) {
                            $return_html .= $countryname;
                        }
                    }
                    $return_html .= '</span></li>
                <li><b>';
                    $return_html .= $this->lang->line("skill_description");
                    $return_html .= '</b><span><p>';
                    if ($row['freelancer_post_skill_description']) {
                        $return_html .= $row['freelancer_post_skill_description'];
                    } else {
                        $return_html .= PROFILENA;
                    }
                    $return_html .= '</p></span>
                </li>
                <li><b>';
                    $return_html .= $this->lang->line("avaiability");
                    $return_html .= '</b><span>';
                    if ($row['freelancer_post_work_hour']) {
                        $return_html .= $row['freelancer_post_work_hour'] . "  " . $this->lang->line("hours_per_week");
                        ;
                    } else {
                        $return_html .= PROFILENA;
                    }
                    $return_html .= '</span>
                </li>
                <li><b>';
                    $return_html .= $this->lang->line("rate_hourly");
                    $return_html .= '</b> <span>';
                    if ($row['freelancer_post_hourly']) {
                        $currency = $this->db->select('currency_name')->get_where('currency', array('currency_id' => $row['freelancer_post_ratestate']))->row()->currency_name;
                        if ($row['freelancer_post_fixed_rate'] == '1') {
                            $return_html .= $row['freelancer_post_hourly'] . "   " . $currency . "  (Also work on fixed Rate) ";
                        } else {
                            $return_html .= $row['freelancer_post_hourly'] . "   " . $currency . "  " . $rate_type;
                        }
                    } else {
                        $return_html .= PROFILENA;
                    }

                    $return_html .= '</span>
                </li>
                <li><b>';
                    $return_html .= $this->lang->line("total_experiance");
                    $return_html .= '</b>
                <span>';
                    if ($row['freelancer_post_exp_year'] || $row['freelancer_post_exp_month']) {
                        if ($row['freelancer_post_exp_month'] == '12 month' && $row['freelancer_post_exp_year'] == '') {
                            $return_html .= "1 year";
                        } elseif ($row['freelancer_post_exp_month'] == '12 month' && $row['freelancer_post_exp_year'] == '0 year') {
                            $return_html .= "1 year";
                        } elseif ($row['freelancer_post_exp_month'] == '12 month' && $row['freelancer_post_exp_year'] != '') {
                            $year = explode(' ', $row['freelancer_post_exp_year']);
                            // echo $year;
                            $totalyear = $year[0] + 1;
                            $return_html .= $totalyear . $this->lang->line("year");
                        } elseif ($row['freelancer_post_exp_year'] != '' && $row['freelancer_post_exp_month'] == '') {
                            $return_html .= $row['freelancer_post_exp_year'];
                        } elseif ($row['freelancer_post_exp_year'] != '' && $row['freelancer_post_exp_month'] == '0 month') {

                            $return_html .= $row['freelancer_post_exp_year'];
                        } else {

                            $return_html .= $row['freelancer_post_exp_year'] . ' ' . $row['freelancer_post_exp_month'];
                        }
                    } else {
                        $return_html .= PROFILENA;
                    }
                    $return_html .= '</span>
                </li>
                </ul>
                </div>
                <div class = "profile-job-profile-button clearfix">
                <div class = "apply-btn fr">';
                    $userid = $this->session->userdata('aileenuser');
                    $contition_array = array('from_id' => $userid, 'to_id' => $row['user_id'], 'save_type' => 2, 'status' => '0');
                    $data = $this->common->select_data_by_condition('save', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
                    if ($userid != $row['user_id']) {
                        $return_html .= '<a href = " ' . base_url('chat/abc/3/4/' . $row['user_id']) . '">';
                        $return_html .= $this->lang->line("message");
                        $return_html .= '</a>';
                        if (!$data) {
                            $return_html .= '<input type = "hidden" id = "hideenuser' . $row['user_id'] . '" value = "' . $data[0]['save_id'] . '">';
                            $return_html .= '<a id = "' . $row['user_id'] . '" onClick = "savepopup(' . $row['user_id'] . ')" href = "javascript:void(0);" class = "saveduser' . $row['user_id'] . '">';

                            $return_html .= $this->lang->line("save");
                            $return_html .= '</a>';
                        } else {

                            $return_html .= '<a class = "saved">';
                            $return_html .= $this->lang->line("saved");
                            $return_html .= '</a>';
                        }
                    }

                    $return_html .= ' </div>
                </div>
                </div>
                </div>';
                }
            } else {
                $return_html .= '<div class="art-img-nn">
                                                <div class="art_no_post_img">

                                                    <img src="../assets/img/free-no1.png">

                                                </div>
                                                <div class="art_no_post_text">';
                $return_html .= $this->lang->line("no_freelancer_found");
                $return_html .= ' </div>
                                            </div>';
            }
            echo $return_html;
        }
    }

//AJAX FREELANCER_HIRE HOME PAGE END
//FREELANCER_HIRE CHECK USER IS REGISTERD START
    public function freelancer_hire_check() {
        $userid = $this->session->userdata('aileenuser');
        $contition_array = array('user_id' => $userid, 'status' => '1', 'is_delete' => '0');
        $hire_step = $this->data['hire_step'] = $this->common->select_data_by_condition('freelancer_hire_reg', $contition_array, $data = 'free_hire_step', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);
        if (count($hire_step) > 0) {
            if ($hire_step[0]['free_hire_step'] == '1') {
                if ($this->uri->segment(2) == 'address-information') {
                    
                } else {
                    redirect('freelancer_hire/freelancer_hire/freelancer_hire_address_info');
                }
            } elseif ($hire_step[0]['free_hire_step'] == '2') {
                if ($this->uri->segment(2) == 'professional-information') {
                    
                } elseif ($this->uri->segment(2) == 'address-information') {
                    
                } else {
                    redirect('freelancer_hire/freelancer_hire/freelancer_hire_professional_info');
                }
            }
        } else {
            redirect('freelancer_hire/freelancer_hire/freelancer_hire_basic_info');
        }
    }

//FREELANCER_HIRE CHECK USER IS REGISTERD END
//FREELANCER_HIRE EDIT POST(PROJECT) PAGE START
    public function freelancer_edit_post($id) {
        $userid = $this->session->userdata('aileenuser');
        //check user deactivate start
        $this->freelancer_hire_deactivate_check();
        //check user deactivate end
        // code for display page start
        $this->freelancer_hire_check();
        // code for display page end
//        $contition_array = array('status' => 1);
//        $this->data['countries'] = $this->common->select_data_by_condition('countries', $contition_array, $data = '*', $sortby = 'country_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        $contition_array = array('post_id' => $id, 'is_delete' => 0);
        $userdata = $this->data['freelancerpostdata'] = $this->common->select_data_by_condition('freelancer_post', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

//        $contition_array = array('status' => 1, 'country_id' => $userdata[0]['country']);
//        $state = $this->data['states'] = $this->common->select_data_by_condition('states', $contition_array, $data = '*', $sortby = 'state_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');
//        //for getting city data
//        $contition_array = array('status' => 1, 'state_id' => $userdata[0]['state']);
//        $this->data['cities'] = $this->common->select_data_by_condition('cities', $contition_array, $data = '*', $sortby = 'city_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');
        //for getting univesity data Start
        $contition_array = array('is_delete' => '0', 'category_name !=' => "Other");
        $search_condition = "((is_other = '2' AND user_id = $userid) OR (status = '1'))";
        $this->data['category_data'] = $this->common->select_data_by_search('category', $search_condition, $contition_array, $data = '*', $sortby = 'category_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        $contition_array = array('is_delete' => '0', 'status' => 1, 'category_name' => "Other");
        $this->data['category_otherdata'] = $this->common->select_data_by_condition('category', $contition_array, $data = '*', $sortby = 'category_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        //for getting univesity data End

        $contition_array = array('status' => 1, 'type' => 1);
        $this->data['skill1'] = $this->common->select_data_by_condition('skill', $contition_array, $data = '*', $sortby = 'skill', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        $contition_array = array('status' => 1);
        $this->data['currency'] = $this->common->select_data_by_condition('currency', $contition_array, $data = '*', $sortby = 'currency_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');

//Retrieve skill data Start

        $skill_know = explode(',', $userdata[0]['post_skill']);
        foreach ($skill_know as $lan) {
            $contition_array = array('skill_id' => $lan, 'status' => 1);
            $languagedata = $this->common->select_data_by_condition('skill', $contition_array, $data = 'skill_id,skill', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str5 = '', $groupby = '');
            $detailes[] = $languagedata[0]['skill'];
        }

        $this->data['skill_2'] = implode(',', $detailes);
        //Retrieve skill data End
//        $this->data['country1'] = $this->data['freelancerpostdata'][0]['country'];
//        $this->data['city1'] = $this->data['freelancerpostdata'][0]['city'];
//        $this->data['state1'] = $this->data['freelancerpostdata'][0]['state'];

        $contition_array = array('is_delete' => '0', 'user_id' => $userid, 'status' => '1', 'free_hire_step' => 3);
        $data = 'username,fullname';
        $hire_data = $this->data['freelancr_user_data'] = $this->common->select_data_by_condition('freelancer_hire_reg', $contition_array, $data, $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str, $groupby = '');
        $this->data['title'] = $hire_data[0]['fullname'] . " " . $hire_data[0]['username'] . TITLEPOSTFIX;

        $this->load->view('freelancer/freelancer_hire/freelancer_edit_post', $this->data);
    }

//FREELANCER_HIRE EDIT POST(PROJECT) PAGE END
//FREELANCER_HIRE EDIT POST(PROJECT) PAGE DATA INSERT START
    public function freelancer_edit_post_insert($id) {

        $userid = $this->session->userdata('aileenuser');
        $skills = $this->input->post('skills');
        $skills = explode(',', $skills);
        $this->form_validation->set_rules('post_name', 'Post Name', 'required');
        $this->form_validation->set_rules('post_desc', 'Post description', 'required');
        //  $this->form_validation->set_rules('fields_req', 'Field required', 'required');
        // $this->form_validation->set_rules('est_time', 'Estimated time', 'required');
        $this->form_validation->set_rules('rating', 'Rating', 'required');

//        $this->form_validation->set_rules('country', 'Country', 'required');

        $this->form_validation->set_rules('last_date', 'Last date', 'required');

        if ($this->form_validation->run() == FALSE) {

            $this->load->view('freelancer/freelancer_hire/freelancer_edit_post');
        } else {

            $datereplace = $this->input->post('last_date');
            $lastdate = str_replace('/', '-', $datereplace);
            // skills  start   
            if (count($skills) > 0) {

                foreach ($skills as $ski) {
                    if ($ski != " ") {
                        $contition_array = array('skill' => trim($ski), 'type' => 1);
                        $skilldata = $this->common->select_data_by_condition('skill', $contition_array, $data = 'skill_id,skill', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str5 = '', $groupby = '');
                        if (count($skilldata) < 0) {
                            $contition_array = array('skill' => trim($ski), 'type' => 5);
                            $skilldata = $this->common->select_data_by_condition('skill', $contition_array, $data = 'skill_id,skill', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str5 = '', $groupby = '');
                        }
                        if ($skilldata) {
                            $skill[] = $skilldata[0]['skill_id'];
                        } else {
                            $data = array(
                                'skill' => trim($ski),
                                'status' => '1',
                                'type' => 5,
                                'user_id' => $userid,
                            );
                            $skill[] = $this->common->insert_data_getid($data, 'skill');
                        }
                    }
                }
                $skill = array_unique($skill, SORT_REGULAR);
                $skills = implode(',', $skill);
            }

            $data = array(
                'post_name' => trim($this->input->post('post_name')),
                'post_description' => trim($this->input->post('post_desc')),
                'post_field_req' => trim($this->input->post('fields_req')),
                'post_skill' => $skills,
                'post_other_skill' => trim($this->input->post('other_skill')),
                'post_est_time' => trim($this->input->post('est_time')),
                'post_rate' => trim($this->input->post('rate')),
                'post_currency' => trim($this->input->post('currency')),
                'post_rating_type' => trim($this->input->post('rating')),
                'post_exp_month' => trim($this->input->post('month')),
                'post_exp_year' => trim($this->input->post('year')),
                'post_last_date' => $lastdate,
//                'country' => trim($this->input->post('country')),
//                'city' => trim($this->input->post('city')),
                'modify_date' => date('Y-m-d', time()),
            );

            $updatdata = $this->common->update_data($data, 'freelancer_post', 'post_id', $id);
            if ($updatdata) {
                redirect('freelancer-hire/projects', refresh);
            } else {
                $this->session->flashdata('error', 'Sorry!!Your data not inserted');
                redirect('freelancer/freelancer_edit_post', refresh);
            }
        }
    }

//FREELANCER_HIRE EDIT POST(PROJECT) PAGE DATA INSERT END
//FREELANCER_APPLY HOME PAGE START
    public function freelancer_apply_post($id = "") {
        $this->data['userid'] = $userid = $this->session->userdata('aileenuser');
//code for check user deactivate start
        $this->freelancer_apply_deactivate_check();
        //code for check user deactivate end
        // code for display page start
        $this->freelancer_apply_check();
        // code for display page end

        $contition_array = array('user_id' => $userid, 'is_delete' => 0, 'status' => 1, 'free_post_step' => 7);
        $freelancerdata = $this->data['freelancerdata'] = $this->common->select_data_by_condition('freelancer_post_reg', $contition_array, $data = '*', $sortby = '', $orderby = 'desc', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        $this->data['title'] = 'Freelancer Apply' . TITLEPOSTFIX;
        $this->load->view('freelancer/freelancer_post/post_apply', $this->data);
    }

//FREELANCER_APPLY HOME PAGE END
//AJAX FREELANCER_APPLY HOME PAGE START
    public function ajax_freelancer_apply_post() {
        $userid = $this->session->userdata('aileenuser');
        $perpage = 5;
        $page = 1;
        if (!empty($_GET["page"]) && $_GET["page"] != 'undefined') {
            $page = $_GET["page"];
        }

        $start = ($page - 1) * $perpage;
        if ($start < 0)
            $start = 0;

        $contition_array = array('user_id' => $userid, 'is_delete' => 0, 'status' => 1);
        $freelancerdata = $this->data['freelancerdata'] = $this->common->select_data_by_condition('freelancer_post_reg', $contition_array, $data = '*', $sortby = '', $orderby = 'desc', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        $freelancer_post_area = $freelancerdata[0]['freelancer_post_area'];
        $post_reg_skill = explode(',', $freelancer_post_area);
        // echo "<pre>";print_r($post_reg_skill);die();
        // $date = date('Y-m-d', time());
        // 'post_last_date >=' => $date,
        foreach ($post_reg_skill as $key => $value) {
            //echo $value;

            $contition_array = array('is_delete' => 0, 'status' => '1', 'user_id !=' => $userid, 'FIND_IN_SET("' . $value . '",post_skill)!=' => '0');
            $freelancer_post_data = $this->common->select_data_by_condition('freelancer_post', $contition_array, $data = '*', $sortby = 'post_id', $orderby = 'desc', $limit = '', $offset = '', $join_str = array(), $groupby = '');
            if ($freelancer_post_data) {
                $freedata[] = $freelancer_post_data;
            }
            // echo "<pre>";print_r($freedata);
        }
        //        TO CHANGE ARRAY OF ARRAY TO ARRAY START
        $final_post = array_reduce($freedata, 'array_merge', array());
        //  echo "<pre>"; print_r($final_post); die();
        //        TO CHANGE ARRAY OF ARRAY TO ARRAY END
        // change the order to decending           
        rsort($final_post);
        //RECOMMEN PROJECT BY FIELD START
        $contition_array = array('status' => '1', 'is_delete' => '0', 'user_id != ' => $userid, 'post_field_req' => $freelancerdata[0]['freelancer_post_field']);
        $freelancer_post_field = $this->common->select_data_by_condition('freelancer_post', $contition_array, $data = '*', $sortby = 'post_id', $orderby = 'desc', $limit = '', $offset = '', $join_str = array(), $groupby = '');
        // echo "<pre>"; print_r($freelancer_post_field);die();

        $all_post = array_merge((array) $final_post, (array) $freelancer_post_field);
        //echo "<pre>"; print_r($all_post);die();
        $unique = array_unique($all_post, SORT_ASC);
        //   echo "<pre>"; print_r($unique);die();

        $postdetail = array_slice($unique, $start, $perpage);

        if (empty($_GET["total_record"])) {
            $_GET["total_record"] = count($unique);
        }
        $return_html = '';
        $return_html .= '<input type = "hidden" class = "page_number" value = "' . $page . '" />';
        $return_html .= '<input type = "hidden" class = "total_record" value = "' . $_GET["total_record"] . '" />';
        $return_html .= '<input type = "hidden" class = "perpage_record" value = "' . $perpage . '" />';


        // $this->data['postdetail'] = $unique;
        if (count($unique) > 0) {
            foreach ($postdetail as $post) {
                $cache_time1 = $post['post_name'];

                if ($cache_time1 != '') {
                    $text = strtolower($this->common->clean($cache_time1));
                } else {
                    $text = '';
                }

//                $text = str_replace(" ", "-", $cache_time1);
//                $text = preg_replace("/[!$#%()]+/i", "", $text);
//                $text = strtolower($text);
                $city = $this->db->select('city')->get_where('freelancer_hire_reg', array('user_id' => $post['user_id']))->row()->city;
                $cityname = $this->db->select('city_name')->get_where('cities', array('city_id' => $post['city']))->row()->city_name;

                if ($cityname != '') {
                    $cityname1 = '-vacancy-in-' . strtolower($this->common->clean($cityname));
                } else {
                    $cityname1 = '';
                }

//                $cityname1 = str_replace(" ", "-", $cityname);
//                $cityname1 = preg_replace("/[!$#%()]+/i", "", $cityname1);
//                $cityname1 = strtolower($cityname1);

                $return_html .= '<div class="job-post-detail clearfix">
                                                        <div class="job-contact-frnd ">';
                $return_html .= '<div class="profile-job-post-detail clearfix margin_btm"  id="removeapply' . $post['post_id'] . '">';
                $return_html .= '<div class="profile-job-post-title-inside clearfix">
                                                                    <div class="profile-job-post-title clearfix margin_btm" >
                                                                        <div class="profile-job-profile-button clearfix">
                                                                            <div class="profile-job-details col-md-12">
                                                                                <ul>
                                                                                    <li class="fr">';
                $return_html .= $this->lang->line("created_date");
                $return_html .= ':';
                $return_html .= trim(date('d-M-Y', strtotime($post['created_date'])));
                $return_html .= '</li>
                                                                                    <li>';
                $return_html .= '<a href="' . base_url('freelancer-hire/project/' . $text . $cityname1 . '-' . $post['user_id'] . '-' . $post['post_id']) . ' " title="' . ucwords($post['post_name']) . '" class="post_title">';
                $return_html .= ucwords($post['post_name']);
                $return_html .= '</a> </li>';

                $country = $this->db->select('country')->get_where('freelancer_hire_reg', array('user_id' => $post['user_id']))->row()->country;
                // $cityname = $this->db->select('city_name')->get_where('cities', array('city_id' => $city))->row()->city_name;
                $countryname = $this->db->select('country_name')->get_where('countries', array('country_id' => $country))->row()->country_name;
                $return_html .= '<li>';
                if ($cityname || $countryname) {
                    $return_html .= '<div class="fr lction">
                                                                                                <a href="" title="Location"><i class="fa fa-map-marker" aria-hidden="true" ></i>';

                    if ($cityname) {
                        $return_html .= $cityname . ",";
                    }

                    if ($countryname) {
                        $return_html .= $countryname;
                    }
                    $return_html .= '</a>
                                                                                            </div>';
                }

                $firstname = $this->db->select('fullname')->get_where('freelancer_hire_reg', array('user_id' => $post['user_id']))->row()->fullname;
                $lastname = $this->db->select('username')->get_where('freelancer_hire_reg', array('user_id' => $post['user_id']))->row()->username;
                $hireslug = $this->db->select('freelancer_hire_slug')->get_where('freelancer_hire_reg', array('user_id' => $post['user_id']))->row()->freelancer_hire_slug;
                $return_html .= '</li>';
                $return_html .= '<li><a class="display_inline" title="ucwords($firstname); &nbsp; ucwords($lastname);" href="' . base_url('freelancer-hire/employer-details/' . $hireslug . '?page=freelancer_post') . '">';
                $return_html .= ucwords($firstname) . " " . ucwords($lastname);
                $return_html .= '</a>
                                                                                    </li>
                                                                                </ul>
                                                                            </div>
                                                                        </div> 
                                                                        <div class="profile-job-profile-menu">
                                                                            <ul class="clearfix">
                                                                                <li> <b>';
                $return_html .= $this->lang->line("field");
                $return_html .= '</b> 
                                                                                    <span>';
                $return_html .= $this->db->get_where('category', array('category_id' => $post['post_field_req']))->row()->category_name;
                $return_html .= '</span>
                                                                                </li>
                                                                                <li> <b>';
                $return_html .= $this->lang->line("skill");
                $return_html .= '</b> <span>';

                $comma = ", ";
                $k = 0;
                $aud = $post['post_skill'];
                $aud_res = explode(',', $aud);
                if (!$post['post_skill']) {

                    $return_html .= $post['post_other_skill'];
                } else if (!$post['post_other_skill']) {

                    foreach ($aud_res as $skill) {
                        if ($k != 0) {
                            $return_html .= $comma;
                        }
                        $cache_time = $this->db->select('skill')->get_where('skill', array('skill_id' => $skill))->row()->skill;
                        $return_html .= $cache_time;
                        $k++;
                    }
                } else if ($post['post_skill'] && $post['post_other_skill']) {
                    foreach ($aud_res as $skill) {
                        if ($k != 0) {
                            $return_html .= $comma;
                        }
                        $cache_time = $this->db->select('skill')->get_where('skill', array('skill_id' => $skill))->row()->skill;
                        $return_html .= $cache_time;
                        $k++;
                    } $return_html .= "," . $post['post_other_skill'];
                }
                $return_html .= '</span>
                                                                                </li>
                                                                                <li><b>';
                $return_html .= $this->lang->line("project_description");
                $return_html .= '</b><span><pre>';

                if ($post['post_description']) {
                    $return_html .= $this->common->make_links($post['post_description']);
                } else {
                    $return_html .= PROFILENA;
                }

                $return_html .= '</pre></span>
                                                                                </li>
                                                                                <li><b>';
                $return_html .= $this->lang->line("rate");
                $return_html .= '</b><span>';
                if ($post['post_rate']) {
                    $return_html .= $post['post_rate'];
                    $return_html .= "&nbsp";
                    $return_html .= $this->db->select('currency_name')->get_where('currency', array('currency_id' => $post['post_currency']))->row()->currency_name;
                    $return_html .= "&nbsp";
                    if ($post['post_rating_type'] == 1) {
                        $return_html .= "Hourly";
                    } else {
                        $return_html .= "Fixed";
                    }
                } else {
                    $return_html .= PROFILENA;
                }

                $return_html .= '</span>
                                                                                </li>
                                                                                <li>
                                                                                    <b>';
                $return_html .= $this->lang->line("required_experiance");
                $return_html .= '</b>
                                                                                    <span>
                                                                                        <p>';
                if ($post['post_exp_month'] || $post['post_exp_year']) {
                    if ($post['post_exp_year']) {
                        $return_html .= $post['post_exp_year'];
                    }
                    if ($post['post_exp_month']) {

                        if ($post['post_exp_year'] == '0' || $post['post_exp_year'] == '') {
                            $return_html .= 0;
                        }
                        $return_html .= ".";

                        $return_html .= $post['post_exp_month'];
                    } else {
                        $return_html .= "." . "0";
                    }
                    $return_html .= " Year";
                } else {
                    $return_html .= PROFILENA;
                }

                $return_html .= '</p>  
                                                                                    </span>
                                                                                </li>
                                                                                <li><b>';
                $return_html .= $this->lang->line("estimated_time");
                $return_html .= '</b><span>';

                if ($post['post_est_time']) {
                    $return_html .= $post['post_est_time'];
                } else {
                    $return_html .= PROFILENA;
                }

                $return_html .= '</span>
                                                                                </li>
                                                                            </ul>
                                                                        </div>
                                                                        <div class="profile-job-profile-button clearfix">
                                                                            <div class="profile-job-details col-md-12">
                                                                                <ul><li class="job_all_post last_date">';
//                $return_html .= $this->lang->line("last_date");
//                $return_html .= ':';
//
//                if ($post['post_last_date']) {
//                    $return_html .= date('d-M-Y', strtotime($post['post_last_date']));
//                } else {
//                    $return_html .= PROFILENA;
//                }
                $return_html .= '</li>
                                                                                    <li class=fr>';

                $this->data['userid'] = $userid = $this->session->userdata('aileenuser');
                $contition_array = array('post_id' => $post['post_id'], 'job_delete' => 0, 'user_id' => $userid);
                $freelancerapply1 = $this->data['freelancerapply'] = $this->common->select_data_by_condition('freelancer_apply', $contition_array, $data = '*', $sortby = '', $orderby = 'desc', $limit = '', $offset = '', $join_str = array(), $groupby = '');
                if ($freelancerapply1) {
                    $return_html .= '<a href="javascript:void(0);" class="button applied">';
                    $return_html .= $this->lang->line("applied");
                    $return_html .= '</a>';
                } else {
                    $return_html .= '<a href="javascript:void(0);"  class= "applypost' . $post['post_id'] . ' button" onclick="applypopup(' . $post['post_id'] . ' , ' . $post['user_id'] . ')">';
                    $return_html .= $this->lang->line("apply");
                    $return_html .= '</a>
                                                                                        </li> 
                                                                                        <li>';

                    $userid = $this->session->userdata('aileenuser');
                    $contition_array = array('user_id' => $userid, 'job_save' => '2', 'post_id ' => $post['post_id'], 'job_delete' => '1');
                    $data = $this->data['jobsave'] = $this->common->select_data_by_condition('freelancer_apply', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
                    if ($data) {

                        $return_html .= '<a class="saved  button  savedpost' . $post['post_id'] . '">';
                        $return_html .= $this->lang->line("saved");
                        $return_html .= '</a>';
                    } else {

                        $return_html .= '<a id="' . $post['post_id'] . '" onClick="savepopup(' . $post['post_id'] . ')" href="javascript:void(0);" class="savedpost' . $post['post_id'] . ' button">';
                        $return_html .= $this->lang->line("save");
                        $return_html .= '</a>';
                    }
                }
                $return_html .= '</li>                        
                                                                                </ul>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>                                        
                                                        </div>
                                                    </div>';
            }
        } else {
            $return_html .= '<div class="art-img-nn">
                                                <div class="art_no_post_img">

                                                    <img src="../assets/img/free-no1.png">

                                                </div>
                                                <div class="art_no_post_text">';
            $return_html .= $this->lang->line("no_recommen_project");
            $return_html .= ' </div>
                                            </div>';
        }
        echo $return_html;
    }

//AJAX FREELANCER_APPLY HOME PAGE END
//FREELANCER_APPLY CHECK USER IS REGISTERD START
    public function freelancer_apply_check() {
        $userid = $this->session->userdata('aileenuser');
        //   echo $userid; die();
        $contition_array = array('user_id' => $userid, 'status' => '1', 'is_delete' => '0');

        $apply_step = $this->data['apply_step'] = $this->common->select_data_by_condition('freelancer_post_reg', $contition_array, $data = 'free_post_step', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);
        // echo "<pre>"; print_r($apply_step);die();
        if (count($apply_step) > 0) {
            if ($apply_step[0]['free_post_step'] == 1) {
                // echo "1111";die();
                if ($this->uri->segment(2) == 'address-information') {
                    
                } else {
                    redirect('freelancer/freelancer_post/freelancer_post_address_information');
                }
            } elseif ($apply_step[0]['free_post_step'] == 2) {
                // echo "222";die();
                if ($this->uri->segment(2) == 'professional-information') {
                    
                } elseif ($this->uri->segment(2) == 'address-information') {
                    
                } else {
                    redirect('freelancer/freelancer_post/freelancer_post_professional_information');
                }
            } elseif ($apply_step[0]['free_post_step'] == 3) {
                if ($this->uri->segment(2) == 'rate') {
                    
                } elseif ($this->uri->segment(2) == 'professional-information') {
                    
                } elseif ($this->uri->segment(2) == 'address-information') {
                    
                } else {
                    redirect('freelancer/freelancer_post/freelancer_post_rate');
                }
            } elseif ($apply_step[0]['free_post_step'] == 4) {
                if ($this->uri->segment(2) == 'avability') {
                    
                } elseif ($this->uri->segment(2) == 'rate') {
                    
                } elseif ($this->uri->segment(2) == 'professional-information') {
                    
                } elseif ($this->uri->segment(2) == 'address-information') {
                    
                } else {
                    redirect('freelancer/freelancer_post/freelancer_post_avability');
                }
            } elseif ($apply_step[0]['free_post_step'] == 5) {
                if ($this->uri->segment(2) == 'education') {
                    
                } elseif ($this->uri->segment(2) == 'avability') {
                    
                } elseif ($this->uri->segment(2) == 'rate') {
                    
                } elseif ($this->uri->segment(2) == 'professional-information') {
                    
                } elseif ($this->uri->segment(2) == 'address-information') {
                    
                } else {
                    redirect('freelancer/freelancer_post/freelancer_post_education');
                }
            } elseif ($apply_step[0]['free_post_step'] == 6) {
                if ($this->uri->segment(2) == 'portfolio') {
                    
                } elseif ($this->uri->segment(2) == 'education') {
                    
                } elseif ($this->uri->segment(2) == 'avability') {
                    
                } elseif ($this->uri->segment(2) == 'rate') {
                    
                } elseif ($this->uri->segment(2) == 'professional-information') {
                    
                } elseif ($this->uri->segment(2) == 'address-information') {
                    
                } else {
                    redirect('freelancer/freelancer_post/freelancer_post_portfolio');
                }
            } else {
                
            }
        } else {
            redirect('freelancer/freelancer_post/freelancer_post_basic_information');
        }
    }

//FREELANCER_APPLY CHECK USER IS REGISTERD END
    public function save_user1($id, $save_id) {
        $id = $_POST['user_id'];
        $save_id = $_POST['save_id'];

        $userid = $this->session->userdata('aileenuser');

        //this condition for prevent dublicate entry of save
        $contition_array = array('from_id' => $userid, 'to_id' => $id, 'status' => 0, 'save_type' => 2);
        $usersearchdata = $this->common->select_data_by_condition('save', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
        if ($usersearchdata) {
            $saveuser = 'Saved';
            echo $saveuser;
        } else {
            $contition_array = array('from_id' => $userid, 'to_id' => $id, 'save_id' => $save_id);
            $userdata = $this->common->select_data_by_condition('save', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

            if ($userdata) {
                $data = array(
                    'status' => 0
                );

                $updatedata = $this->common->update_data($data, 'save', 'save_id', $save_id);
                if ($updatedata) {
                    $saveuser = 'Saved';
                    echo $saveuser;
                }
            } else {
                $data = array(
                    'from_id' => $userid,
                    'to_id' => $id,
                    'status' => 0,
                    'save_type' => 2
                );

                $insert_id = $this->common->insert_data($data, 'save');
                if ($insert_id) {
                    $saveuser = 'Saved';
                    echo $saveuser;
                }
            }
        }
    }

//Freelancer Job All Post controller end
//FREELANCER_APPLY APPLY TO PROJECT START
    public function apply_insert() {
        $id = $_POST['post_id'];
        $para = $_POST['allpost'];
        $notid = $_POST['userid'];

        $userid = $this->session->userdata('aileenuser');
        $contition_array = array('post_id' => $id, 'user_id' => $userid, 'is_delete' => 0);
        $userdata = $this->common->select_data_by_condition('freelancer_apply', $contition_array, $data = '*', $sortby = '', $orderby = 'desc', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        $contition_array = array('user_id' => $userid);
        $hiredata = $this->common->select_data_by_condition('freelancer_hire_reg', $contition_array, $data = 'email', $sortby = '', $orderby = 'desc', $limit = '', $offset = '', $join_str = array(), $groupby = '');
        $app_id = $userdata[0]['app_id'];

        if ($userdata) {
            $contition_array = array('job_delete' => 1);
            $jobdata = $this->common->select_data_by_condition('freelancer_apply', $contition_array, $data = 'app_id', $sortby = '', $orderby = 'desc', $limit = '', $offset = '', $join_str = array(), $groupby = '');

            $data = array(
                'job_delete' => 0,
                'job_save' => 3,
                'modify_date' => date('Y-m-d h:i:s', time())
            );

            $updatedata = $this->common->update_data($data, 'freelancer_apply', 'app_id', $app_id);
            $data = array(
                'not_type' => 3,
                'not_from_id' => $userid,
                'not_to_id' => $notid,
                'not_read' => 2,
                'not_from' => 4,
                'not_product_id' => $app_id,
                "not_active" => 1,
                'not_created_date' => date('Y-m-d H:i:s')
            );
            $updatedata = $this->common->insert_data_getid($data, 'notification');
            // end notoification
            if ($updatedata) {
                //   echo "123"; die();
                if ($para == 'all') {
                    // apply mail start
                    $this->apply_email($notid);
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
                'modify_date' => date('Y-m-d h:i:s', time()),
                'is_delete' => 0,
                'job_delete' => 0,
                'job_save' => 3
            );
            $insert_id = $this->common->insert_data_getid($data, 'freelancer_apply');
            // insert notification
            $data = array(
                'not_type' => 3,
                'not_from_id' => $userid,
                'not_to_id' => $notid,
                'not_read' => 2,
                'not_from' => 4,
                'not_product_id' => $insert_id,
                "not_active" => 1,
                'not_created_date' => date('Y-m-d H:i:s')
            );

            $insert_id = $this->common->insert_data_getid($data, 'notification');
            // end notoification
            if ($insert_id) {
                $this->apply_email($notid);
                $applypost = 'Applied';
            }
            echo $applypost;
        }
    }

//FREELANCER_APPLY APPLY TO PROJECT START
//FREELANCER_APPLY APPLIED ON POST(PROJECTS) START
    public function freelancer_applied_post() {
        $this->data['userid'] = $userid = $this->session->userdata('aileenuser');
//code for check user deactivate start
        $this->freelancer_apply_deactivate_check();
        //code for check user deactivate end
        // code for display page start
        $this->freelancer_apply_check();
        // code for display page end
// job seeker detail
        $contition_array = array('user_id' => $userid, 'is_delete' => 0, 'status' => 1);
        $jobdata = $this->data['jobdata'] = $this->common->select_data_by_condition('freelancer_post_reg', $contition_array, $data = '*', $sortby = '', $orderby = 'desc', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        $join_str[0]['table'] = 'freelancer_apply';
        $join_str[0]['join_table_id'] = 'freelancer_apply.post_id';
        $join_str[0]['from_table_id'] = 'freelancer_post.post_id';
        $join_str[0]['join_type'] = '';

        $contition_array = array('freelancer_apply.job_delete' => 0, 'freelancer_apply.user_id' => $userid);
        $postdata = $this->data['postdata'] = $this->common->select_data_by_condition('freelancer_post', $contition_array, $data = 'freelancer_post.*, freelancer_apply.app_id, freelancer_apply.user_id as userid, freelancer_apply.modify_date, freelancer_apply.created_date ', $sortby = 'freelancer_apply.modify_date', $orderby = 'desc', $limit = '', $offset = '', $join_str, $groupby = '');

        $this->data['title'] = $jobdata[0]['freelancer_post_fullname'] . " " . $jobdata[0]['freelancer_post_username'] . TITLEPOSTFIX;
        $this->load->view('freelancer/freelancer_post/freelancer_applied_post', $this->data);
    }

//FREELANCER_APPLY APPLIED ON POST(PROJECTS) START
// AJAX FREELANCER_APPLY APLLIED ON POST(PROJECT) START
    public function ajax_freelancer_applied_post() {
        $this->data['userid'] = $userid = $this->session->userdata('aileenuser');

        $perpage = 5;
        $page = 1;
        if (!empty($_GET["page"]) && $_GET["page"] != 'undefined') {
            $page = $_GET["page"];
        }

        $start = ($page - 1) * $perpage;
        if ($start < 0)
            $start = 0;


        $contition_array = array('user_id' => $userid, 'is_delete' => 0, 'status' => 1);
        $jobdata = $this->data['jobdata'] = $this->common->select_data_by_condition('freelancer_post_reg', $contition_array, $data = '*', $sortby = '', $orderby = 'desc', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        $join_str[0]['table'] = 'freelancer_apply';
        $join_str[0]['join_table_id'] = 'freelancer_apply.post_id';
        $join_str[0]['from_table_id'] = 'freelancer_post.post_id';
        $join_str[0]['join_type'] = '';
        $limit = $perpage;
        $offset = $start;
        $contition_array = array('freelancer_apply.job_delete' => 0, 'freelancer_apply.user_id' => $userid);
        $postdata = $this->data['postdata'] = $this->common->select_data_by_condition('freelancer_post', $contition_array, $data = 'freelancer_post.*, freelancer_apply.app_id, freelancer_apply.user_id as userid, freelancer_apply.modify_date, freelancer_apply.created_date ', $sortby = 'freelancer_apply.modify_date', $orderby = 'desc', $limit = '', $offset = '', $join_str, $groupby = '');
        $postdata1 = $this->common->select_data_by_condition('freelancer_post', $contition_array, $data = 'freelancer_post.*, freelancer_apply.app_id, freelancer_apply.user_id as userid, freelancer_apply.modify_date, freelancer_apply.created_date ', $sortby = 'freelancer_apply.modify_date', $orderby = 'desc', $limit, $offset = '', $join_str, $groupby = '');

        if (empty($_GET["total_record"])) {
            $_GET["total_record"] = count($postdata);
        }
        $return_html = '';
        $return_html .= '<input type="hidden" class="page_number" value="' . $page . '" />';
        $return_html .= '<input type="hidden" class="total_record" value="' . $_GET["total_record"] . '" />';
        if (count($postdata) > 0) {
            foreach ($postdata1 as $post) {

                $return_html .= '<div class="job-detail clearfix" id="removeapply' . $post['app_id'] . '">';
                $return_html .= '<div class="job-contact-frnd">';
                $return_html .= '<div class="profile-job-post-detail clearfix" id="removeapplyq ' . $post['post_id'] . '">';
                $return_html .= '<div class="profile-job-post-title-inside clearfix">
                                                        <div class="profile-job-post-title clearfix margin_btm">
                                                            <div class="profile-job-profile-button clearfix">
                                                                <div class="profile-job-details col-md-12">
                                                                    <ul>
                                                                        <li class="fr">';
                $return_html .= $this->lang->line("applied_date");
                $return_html .= ':';
                if ($post['modify_date'] != 0000 - 00 - 00) {
                    $return_html .= date('d-M-Y', strtotime($post['modify_date']));
                } else {
                    $return_html .= date('d-M-Y', strtotime($post['created_date']));
                }

                $return_html .= '</li>
                                                                        <li>';

                $cache_time1 = $post['post_name'];
                if ($cache_time1 != '') {
                    $text = strtolower($this->common->clean($cache_time1));
                } else {
                    $text = '';
                }
                $city = $this->db->select('city')->get_where('freelancer_hire_reg', array('user_id' => $post['user_id']))->row()->city;
                $cityname = $this->db->select('city_name')->get_where('cities', array('city_id' => $city))->row()->city_name;
                if ($cityname != '') {
                    $cityname1 = '-vacancy-in-' . strtolower($this->common->clean($cityname));
                } else {
                    $cityname1 = '';
                }

                $return_html .= '<a href="' . base_url('freelancer-hire/project/' . $text . $cityname1 . '-' . $post['user_id'] . '-' . $post['post_id']) . ' " title="' . ucwords($post['post_name']) . '" title="' . ucwords($this->common->make_links($post['post_name'])) . '" class="post_title">';
                $return_html .= ucwords($this->common->make_links($post['post_name']));
                $return_html .= '</a>   
                                                                        </li>';

                $firstname = $this->db->select('fullname')->get_where('freelancer_hire_reg', array('user_id' => $post['user_id']))->row()->fullname;
                $lastname = $this->db->select('username')->get_where('freelancer_hire_reg', array('user_id' => $post['user_id']))->row()->username;

                $return_html .= '<li>
                                                                            <a class="display_inline" title="' . ucwords($firstname) . '&nbsp; ' . ucwords($lastname) . '" href="' . base_url('freelancer-hire/employer-details/' . $post['user_id'] . '?page=freelancer_post') . '">';
                $return_html .= ucwords($firstname) . " " . ucwords($lastname);
                $return_html .= '</a>';

                $country = $this->db->select('country')->get_where('freelancer_hire_reg', array('user_id' => $post['user_id']))->row()->country;

                $countryname = $this->db->select('country_name')->get_where('countries', array('country_id' => $country))->row()->country_name;

                if ($cityname || $countryname) {
                    $return_html .= ' <div class="fr lction">
                                                                                    <p title="Location"><i class="fa fa-map-marker" aria-hidden="true"> </i>';

                    if ($cityname) {
                        $return_html .= $cityname . ",";
                    }

                    if ($countryname) {
                        $return_html .= $countryname;
                    }
                    $return_html .= '</p>
                                                                                </div>';
                }
                $return_html .= '</li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                            <div class="profile-job-profile-menu">
                                                                <ul class="clearfix">
                                                                    <li> <b>';
                $return_html .= $this->lang->line("field");
                $return_html .= ' </b> <span>';
                $return_html .= $this->db->select('category_name')->get_where('category', array('category_id' => $post['post_field_req']))->row()->category_name;
                $return_html .= ' </span>
                                                                    </li>
                                                                    <li> <b>';
                $return_html .= $this->lang->line("skill");
                $return_html .= ' </b> <span> ';

                $comma = ", ";
                $k = 0;
                $aud = $post['post_skill'];
                $aud_res = explode(',', $aud);

                if (!$post['post_skill']) {

                    $return_html .= $post['post_other_skill'];
                } else if (!$post['post_other_skill']) {

                    foreach ($aud_res as $skill) {
                        if ($k != 0) {
                            $return_html .= $comma;
                        }
                        $cache_time = $this->db->select('skill')->get_where('skill', array('skill_id' => $skill))->row()->skill;
                        $return_html .= $cache_time;
                        $k++;
                    }
                } else if ($post['post_skill'] && $post['post_other_skill']) {
                    foreach ($aud_res as $skill) {
                        if ($k != 0) {
                            $return_html .= $comma;
                        }
                        $cache_time = $this->db->select('skill')->get_where('skill', array('skill_id' => $skill))->row()->skill;
                        $return_html .= $cache_time;
                        $k++;
                    } $return_html .= "," . $post['post_other_skill'];
                }

                $return_html .= '</span>
                                                                    </li>
                                                                    <li>
                                                                        <b>';
                $return_html .= $this->lang->line("project_description");
                $return_html .= '</b>
                                                                        <span>
                                                                            <pre>';

                if ($post['post_description']) {
                    $return_html .= $this->common->make_links($post['post_description']);
                } else {
                    $return_html .= PROFILENA;
                }

                $return_html .= '</pre>
                                                                        </span>
                                                                    </li>
                                                                    <li><b>';
                $return_html .= $this->lang->line("rate");
                $return_html .= '</b><span>';

                if ($post['post_rate']) {
                    $return_html .= $post['post_rate'];
                    $return_html .= "&nbsp";
                    $return_html .= $this->db->select('currency_name')->get_where('currency', array('currency_id' => $post['post_currency']))->row()->currency_name;
                    $return_html .= "&nbsp";
                    if ($post['post_rating_type'] == 1) {
                        $return_html .= "Hourly";
                    } else {
                        $return_html .= "Fixed";
                    }
                } else {
                    $return_html .= PROFILENA;
                }
                $return_html .= '</span>
                                                                    </li>
                                                                    <li>
                                                                        <b>';
                $return_html .= $this->lang->line("required_experiance");
                $return_html .= '</b>
                                                                        <span>';

                if ($post['post_exp_month'] || $post['post_exp_year']) {
                    if ($post['post_exp_year']) {
                        $return_html .= $post['post_exp_year'];
                    }
                    if ($post['post_exp_month']) {

                        if ($post['post_exp_year'] == '0' || $post['post_exp_year'] == '') {
                            $return_html .= 0;
                        }
                        $return_html .= ".";
                        $return_html .= $post['post_exp_month'];
                    } else {
                        $return_html .= "." . "0";
                    }
                    $return_html .= " Year";
                } else {
                    $return_html .= PROFILENA;
                }

                $return_html .= '</span>
                                                                    </li>
                                                                    <li><b>';
                $return_html .= $this->lang->line("estimated_time");
                $return_html .= '</b><span>';
                if ($post['post_est_time']) {
                    $return_html .= $post['post_est_time'];
                } else {
                    $return_html .= PROFILENA;
                }
                $return_html .= '</span>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                            <div class="profile-job-profile-button clearfix">
                                                                <div class="profile-job-details col-md-12">
                                                                    <ul>
                                                                        <li class="job_all_post last_date">';
//                $return_html .= $this->lang->line("last_date");
//                $return_html .= ':';
//
//                if ($post['post_last_date']) {
//                    $return_html .= date('d-M-Y', strtotime($post['post_last_date']));
//                } else {
//                    $return_html .= PROFILENA;
//                }
                $return_html .= '</li>
                                                                        <li class=fr>';
                $return_html .= '<a href="javascript:void(0);" class="button fr" onclick="removepopup(' . $post['app_id'] . ')">' . $this->lang->line("remove") . '</a>';
                $return_html .= '</li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>';
            }
        } else {
            $return_html .= '<div class="art-img-nn">
                                                <div class="art_no_post_img">

                                                    <img src="../assets/img/free-no1.png">

                                                </div>
                                                <div class="art_no_post_text">';
            $return_html .= $this->lang->line("no_applied_projects");
            $return_html .= '</div>
                                            </div>';
        }
        echo $return_html;
    }

// AJAX FREELANCER_APPLY APLLIED ON POST(PROJECT) END
    //FREELANCER_APPLY REMOVE FROM APPLIED AND SAVE LIST START
    public function freelancer_delete_apply() {
        //echo "hi"; die();

        $id = $_POST['app_id'];
        $para = $_POST['para'];

        $userid = $this->session->userdata('aileenuser');

        $data = array(
            'job_delete' => 1,
            'job_save' => 3,
            'modify_date' => date('Y-m-d h:i:s', time())
        );

        $updatedata = $this->common->update_data($data, 'freelancer_apply', 'app_id', $id);
    }

//FREELANCER_APPLY REMOVE FROM APPLIED AND SAVE LIST END
    public function save_insert() {
        $id = $_POST['post_id'];
        $userid = $this->session->userdata('aileenuser');
        $contition_array = array('post_id' => $id, 'user_id' => $userid, 'is_delete' => 0);
        $userdata = $this->common->select_data_by_condition('freelancer_apply', $contition_array, $data = '*', $sortby = '', $orderby = 'desc', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        $app_id = $userdata[0]['app_id'];
        if ($userdata) {
            $contition_array = array('job_delete' => 1);
            $jobdata = $this->common->select_data_by_condition('freelancer_apply', $contition_array = array(), $data = '*', $sortby = '', $orderby = 'desc', $limit = '', $offset = '', $join_str = array(), $groupby = '');
            $data = array(
                'job_delete' => 0,
                'job_save' => 1
            );

            $updatedata = $this->common->update_data($data, 'freelancer_apply', 'app_id', $app_id);
            if ($updatedata) {
                $savepost = 'Applied post';
                echo $savepost;
            }
        } else {
            $data = array(
                'post_id' => $id,
                'user_id' => $userid,
                'status' => 1,
                'created_date' => date('Y-m-d h:i:s', time()),
                'is_delete' => 0,
                'job_delete' => 0,
                'job_save' => 1
            );

            $insert_id = $this->common->insert_data_getid($data, 'freelancer_apply');
            if ($insert_id) {
                $savepost = 'Applied Post';
                echo $savepost;
            }
        }
    }

//FREELANCER_HIRE APPLIED POERSON LIST START
    public function freelancer_apply_list($id) {
        $userid = $this->session->userdata('aileenuser');
//check user deactivate start
        $this->freelancer_hire_deactivate_check();
        //check user deactivate end
// code for display page start
        $this->freelancer_hire_check();
        // code for display page end

        $contition_array = array('is_delete' => '0', 'user_id' => $userid, 'status' => '1', 'free_hire_step' => 3);
        $data = 'username,fullname';
        $hire_data = $this->data['freelancr_user_data'] = $this->common->select_data_by_condition('freelancer_hire_reg', $contition_array, $data, $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str, $groupby = '');
        $this->data['title'] = $hire_data[0]['fullname'] . " " . $hire_data[0]['username'] . TITLEPOSTFIX;

        $this->data['postid'] = $id;
        //echo "<pre>"; print_r($this->data['postid']);die();
        $join_str[0]['table'] = 'freelancer_apply';
        $join_str[0]['join_table_id'] = 'freelancer_apply.user_id';
        $join_str[0]['from_table_id'] = 'freelancer_post_reg.user_id';
        $join_str[0]['join_type'] = '';
        $contition_array = array('freelancer_apply.post_id' => $id, 'freelancer_apply.is_delete' => 0);
        $data = 'freelancer_post_reg.user_id, freelancer_post_reg.freelancer_apply_slug, freelancer_post_reg.freelancer_post_fullname, freelancer_post_reg.freelancer_post_username, freelancer_post_reg.designation, freelancer_post_reg.freelancer_post_area, freelancer_post_reg.freelancer_post_otherskill, freelancer_post_reg.freelancer_post_city, freelancer_post_reg.freelancer_post_skill_description, freelancer_post_reg.freelancer_post_work_hour, freelancer_post_reg.freelancer_post_hourly, freelancer_post_reg.freelancer_post_ratestate, freelancer_post_reg.freelancer_post_fixed_rate, freelancer_post_reg.freelancer_post_exp_year, freelancer_post_reg.freelancer_post_exp_month, freelancer_post_reg.freelancer_post_user_image';
        $postdata = $this->data['postdata'] = $this->common->select_data_by_condition('freelancer_post_reg', $contition_array, $data, $sortby = '', $orderby = 'desc', $limit = '', $offset = '', $join_str, $groupby = '');

        //echo '<pre>'; print_r($postdata); die();

        $this->load->view('freelancer/freelancer_hire/freelancer_apply_list', $this->data);
    }

//FREELANCER_HIRE APPLIED POERSON LIST END
    public function save_user() {
        $id = $_POST['post_id'];
        $userid = $this->session->userdata('aileenuser');

        $contition_array = array('post_id' => $id, 'user_id' => $userid, 'is_delete' => 0);
        $userdata = $this->common->select_data_by_condition('freelancer_apply', $contition_array, $data = '*', $sortby = 'post_id', $orderby = 'asc', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        $app_id = $userdata[0]['app_id'];
        if ($userdata) {
            $contition_array = array('job_delete' => 0);
            $jobdata = $this->common->select_data_by_condition('freelancer_apply', $contition_array = array(), $data = '*', $sortby = 'post_id', $orderby = 'asc', $limit = '', $offset = '', $join_str = array(), $groupby = '');
            $data = array(
                'job_delete' => 1,
                'job_save' => 2,
                'modify_date' => date('Y-m-d h:i:s', time())
            );

            $updatedata = $this->common->update_data($data, 'freelancer_apply', 'app_id', $app_id);
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

            $insert_id = $this->common->insert_data_getid($data, 'freelancer_apply');
            if ($insert_id) {

                $savepost = 'Saved';
            } echo $savepost;
        }
    }

//FREELANCER_HIRE SAVE USER(FREELACER) START
    public function freelancer_save() {
        $userid = $this->session->userdata('aileenuser');
        //check user deactivate start
        $this->freelancer_hire_deactivate_check();
        //check user deactivate end
        // code for display page start
        $this->freelancer_hire_check();
        // code for display page end
        $contition_array = array('is_delete' => '0', 'user_id' => $userid, 'status' => '1', 'free_hire_step' => 3);
        $data = 'username,fullname,designation,freelancer_hire_user_image,user_id';
        $hire_data = $this->data['freelancr_user_data'] = $this->common->select_data_by_condition('freelancer_hire_reg', $contition_array, $data, $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str, $groupby = '');

        $this->data['title'] = $hire_data[0]['fullname'] . " " . $hire_data[0]['username'] . TITLEPOSTFIX;
        $this->load->view('freelancer/freelancer_hire/freelancer_save', $this->data);
    }

//FREELANCER_HIRE SAVE USER(FREELACER) END
//AJAX FREELANCER_HIRE SAVE USER(FREELACER) START
    public function ajax_freelancer_save() {
        $userid = $this->session->userdata('aileenuser');

        $perpage = 5;
        $page = 1;
        if (!empty($_GET["page"]) && $_GET["page"] != 'undefined') {
            $page = $_GET["page"];
        }

        $start = ($page - 1) * $perpage;
        if ($start < 0)
            $start = 0;


        $join_str[0]['table'] = 'freelancer_post_reg';
        $join_str[0]['join_table_id'] = 'freelancer_post_reg.user_id';
        $join_str[0]['from_table_id'] = 'save.to_id';
        $join_str[0]['join_type'] = '';

        $limit = $perpage;
        $offset = $start;

        $contition_array = array('save.status' => '0', 'freelancer_post_reg.is_delete' => 0, 'freelancer_post_reg.status' => 1, 'save.from_id' => $userid, 'save.save_type' => 2);
        $postdata = $this->common->select_data_by_condition('save', $contition_array, $data = 'freelancer_post_reg.freelancer_post_user_image, freelancer_post_reg.user_id, freelancer_post_reg.freelancer_post_fullname, freelancer_post_reg.freelancer_post_username, freelancer_post_reg.designation, freelancer_post_reg.freelancer_post_area, freelancer_post_reg.freelancer_post_otherskill,freelancer_post_reg.freelancer_post_country, freelancer_post_reg.freelancer_post_city, freelancer_post_reg.freelancer_post_skill_description, freelancer_post_reg.freelancer_post_work_hour, freelancer_post_reg.freelancer_post_hourly, freelancer_post_reg.freelancer_post_ratestate, freelancer_post_reg.freelancer_post_fixed_rate, freelancer_post_reg.freelancer_post_exp_year, freelancer_post_reg.freelancer_post_exp_month,freelancer_post_reg.freelancer_post_field, save.save_id', $sortby = 'save_id', $orderby = 'desc', $limit = '', $offset = '', $join_str, $groupby = '');
        $postdata1 = $this->common->select_data_by_condition('save', $contition_array, $data = 'freelancer_post_reg.freelancer_post_user_image, freelancer_post_reg.user_id, freelancer_post_reg.freelancer_post_fullname, freelancer_post_reg.freelancer_post_username, freelancer_post_reg.designation, freelancer_post_reg.freelancer_post_area, freelancer_post_reg.freelancer_post_otherskill,freelancer_post_reg.freelancer_post_country, freelancer_post_reg.freelancer_post_city, freelancer_post_reg.freelancer_post_skill_description, freelancer_post_reg.freelancer_post_work_hour, freelancer_post_reg.freelancer_post_hourly, freelancer_post_reg.freelancer_post_ratestate, freelancer_post_reg.freelancer_post_fixed_rate, freelancer_post_reg.freelancer_post_exp_year, freelancer_post_reg.freelancer_post_exp_month,freelancer_post_reg.freelancer_post_field, save.save_id', $sortby = 'save_id', $orderby = 'desc', $limit, $offset = '', $join_str, $groupby = '');
        if (empty($_GET["total_record"])) {
            $_GET["total_record"] = count($userlist);
        }
        $return_html = '';
        $return_html .= '<input type="hidden" class="page_number" value="' . $page . '" />';
        $return_html .= '<input type="hidden" class="total_record" value="' . $_GET["total_record"] . '" />';
        if (count($postdata) > 0) {
            foreach ($postdata1 as $rec) {
                $return_html .= '<div class="job-contact-frnd">';
                $return_html .= '<div id="removeapply' . $rec['save_id'] . '">';
                $return_html .= '<div class="profile-job-post-detail clearfix">
                            <div class="profile-job-post-title-inside clearfix">
                                <div class="profile-job-profile-button clearfix">
                                    <div class="profile-job-post-location-name-rec">
                                        <div style="display: inline-block; float: left;">
                                            <div  class="buisness-profile-pic-candidate">';
                if ($rec['freelancer_post_user_image']) {
                    $return_html .= '<a href="' . base_url('freelancer/freelancer_post_profile/' . $rec['user_id'] . '?page=freelancer_hire') . '" title="' . ucwords($rec['freelancer_post_fullname']) . ' ' . ucwords($rec['freelancer_post_username']) . '">
                                                        <img src="' . FREE_POST_PROFILE_THUMB_UPLOAD_URL . $rec['freelancer_post_user_image'] . '" alt="' . ucwords($rec['freelancer_post_fullname']) . ' ' . ucwords($row['freelancer_post_username']) . '"></a>';
                } else {
                    $return_html .= '<a href="' . base_url('freelancer-work/freelancer-details/' . $rec['user_id'] . '?page=freelancer_hire') . '" title="' . ucwords($rec['freelancer_post_fullname']) . ' ' . ucwords($rec['freelancer_post_username']) . '">';
                    $post_fname = $rec['freelancer_post_fullname'];
                    $post_lname = $rec['freelancer_post_username'];
                    $sub_post_fname = substr($post_fname, 0, 1);
                    $sub_post_lname = substr($post_lname, 0, 1);
                    $return_html .= '<div class = "post-img-div">';
                    $return_html .= ucfirst(strtolower($sub_post_fname)) . ucfirst(strtolower($sub_post_lname));
                    $return_html .= '</div> </a>';
                }
                $return_html .= '</div>
                                        </div>

                                        <div class="designation_rec" style="float: left;">
                                            <ul>
                                                <li>
                                                    <a  class="post_name" href="' . base_url('freelancer-work/freelancer-details/' . $rec['user_id'] . '?page=freelancer_hire') . '" title="' . ucwords($rec['freelancer_post_fullname']) . ' ' . ucwords($rec['freelancer_post_username']) . '">
                                                        ' . ucwords($rec['freelancer_post_fullname']) . ' ' . ucwords($rec['freelancer_post_username']) . '</a></li>
                                                <li style="display: block;"> <a href="#">';
                if ($rec['designation']) {
                    $return_html .= $rec['designation'];
                } else {
                    $return_html .= "Designation";
                }
                $return_html .= '</a> </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>  
                            <div class="profile-job-post-title clearfix">
                                <div class="profile-job-profile-menu">
                                    <ul class="clearfix">
                                    <li><b>';
                $return_html .= $this->lang->line("field");
                $return_html .= '</b><span>';
                if ($rec['freelancer_post_field']) {
                    $field_name = $this->db->select('category_name')->get_where('category', array('category_id' => $rec['freelancer_post_field']))->row()->category_name;
                    $return_html .= $field_name;
                } else {
                    $return_html .= PROFILENA;
                }

                $return_html .= '</li></span><li><b>';

                $return_html .= $this->lang->line("skill");
                $return_html .= '</b><span>';
                $comma = " , ";
                $k = 0;
                $aud = $rec['freelancer_post_area'];
                $aud_res = explode(',', $aud);
                if (!$rec['freelancer_post_area']) {
                    $return_html .= $rec['freelancer_post_otherskill'];
                } else if (!$rec['freelancer_post_otherskill']) {
                    foreach ($aud_res as $skill) {
                        if ($k != 0) {
                            $return_html .= $comma;
                        }
                        $cache_time = $this->db->select('skill')->get_where('skill', array('skill_id' => $skill))->row()->skill;
                        $return_html .= $cache_time;
                        $k++;
                    }
                } else if ($rec['freelancer_post_area'] && $rec['freelancer_post_otherskill']) {
                    foreach ($aud_res as $skill) {
                        if ($k != 0) {
                            $return_html .= $comma;
                        }
                        $cache_time = $this->db->select('skill')->get_where('skill', array('skill_id' => $skill))->row()->skill;
                        $return_html .= $cache_time;
                        $k++;
                    }
                    $return_html .= "," . $rec['freelancer_post_otherskill'];
                }
                $return_html .= ' </span>
                                        </li>';
                $cityname = $this->db->select('city_name')->get_where('cities', array('city_id' => $rec['freelancer_post_city']))->row()->city_name;
                $countryname = $this->db->select('country_name')->get_where('countries', array('country_id' => $rec['freelancer_post_country']))->row()->country_name;
                $return_html .= '<li><b>';
                $return_html .= $this->lang->line("location");
                $return_html .= '</b><span>';

                if ($cityname || $countryname) {
                    if ($cityname) {
                        $return_html .= $cityname . ",";
                    }
                    if ($countryname) {
                        $return_html .= $countryname;
                    }
                }
                $return_html .= '</span></li>
                                        <li><b>';
                $return_html .= $this->lang->line("skill_description");
                $return_html .= '</b><span><p>';
                if ($rec['freelancer_post_skill_description']) {
                    $return_html .= $rec['freelancer_post_skill_description'];
                } else {
                    $return_html .= PROFILENA;
                }
                $return_html .= '</p></span>
                                        </li>
                                        <li><b>';
                $return_html .= $this->lang->line("avaiability");
                $return_html .= '</b><span>';

                if ($rec['freelancer_post_work_hour']) {
                    $return_html .= $rec['freelancer_post_work_hour'] . "  " . "Hours per week ";
                } else {
                    $return_html .= PROFILENA;
                }
                $return_html .= '</span>
                                        </li>
                                        <li><b>';
                $return_html .= $this->lang->line("rate");
                $return_html .= '</b><span>';
                if ($rec['freelancer_post_hourly']) {
                    $currency = $this->db->select('currency_name')->get_where('currency', array('currency_id' => $rec['freelancer_post_ratestate']))->row()->currency_name;
                    if ($rec['freelancer_post_fixed_rate'] == '1') {
                        $rate_type = 'Fixed';
                    } else {
                        $rate_type = 'Hourly';
                    }
                    $return_html .= $rec['freelancer_post_hourly'] . "   " . $currency . "  " . $rate_type;
                } else {
                    $return_html .= PROFILENA;
                }
                $return_html .= '</span>
                                        </li>
                                        <li><b>';
                $return_html .= $this->lang->line("total_experiance");
                $return_html .= '</b><span>';
                if ($rec['freelancer_post_exp_year'] || $rec['freelancer_post_exp_month']) {
                    if ($rec['freelancer_post_exp_month'] == '12 month' && $rec['freelancer_post_exp_year'] == '') {
                        $return_html .= "1 year";
                    } elseif ($rec['freelancer_post_exp_month'] == '12 month' && $rec['freelancer_post_exp_year'] == '0 year') {
                        $return_html .= "1 year";
                    } elseif ($rec['freelancer_post_exp_month'] == '12 month' && $rec['freelancer_post_exp_year'] != '') {
                        $year = explode(' ', $rec['freelancer_post_exp_year']);
                        $totalyear = $year[0] + 1;
                        $return_html .= $totalyear . " year";
                    } elseif ($rec['freelancer_post_exp_year'] != '' && $rec['freelancer_post_exp_month'] == '') {
                        $return_html .= $rec['freelancer_post_exp_year'];
                    } elseif ($rec['freelancer_post_exp_year'] != '' && $rec['freelancer_post_exp_month'] == '0 month') {

                        $return_html .= $rec['freelancer_post_exp_year'];
                    } else {

                        $return_html .= $rec['freelancer_post_exp_year'] . ' ' . $rec['freelancer_post_exp_month'];
                    }
                } else {
                    $return_html .= PROFILENA;
                }
                $return_html .= '</span>
                                        </li>
                                    </ul>
                                </div>
                                <div class="profile-job-profile-button clearfix">
                                    <div class="apply-btn fr">';
                $userid = $this->session->userdata('aileenuser');
                if ($userid != $rec['user_id']) {
                    $return_html .= '<a href="' . base_url('chat/abc/3/4/' . $rec['user_id']) . '">';
                    $return_html .= $this->lang->line("message");
                    $return_html .= '</a>';
                    $return_html .= '<a href="javascript:void(0);" class="button" onclick="removepopup(' . $rec['save_id'] . ')">';
                    $return_html .= $this->lang->line("remove");
                    $return_html .= '</a>';
                }
                $return_html .= '</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>';
            }
        } else {
            $return_html .= '<div class="art-img-nn">
                                                <div class="art_no_post_img">
                                                    <img src="../assets/img/free-no1.png">
                                                </div>
                                                <div class="art_no_post_text">';
            $return_html .= $this->lang->line("no_saved_freelancer");
            $return_html .= ' </div>
                                            </div>';
        }
        echo $return_html;
    }

//AJAX FREELANCER_HIRE SAVE USER(FREELACER) END
//FREELANCER_APPLY SAVE POST(PROJECT) START
    public function freelancer_save_post() {
        $this->data['userid'] = $userid = $this->session->userdata('aileenuser');
//code for check user deactivate start
        $this->freelancer_apply_deactivate_check();
        //code for check user deactivate end
// code for display page start
        $this->freelancer_apply_check();
// code for display page end
// job seeker detail
        $contition_array = array('user_id' => $userid, 'is_delete' => 0, 'status' => 1, 'free_post_step' => 7);
        $jobdata = $this->data['jobdata'] = $this->common->select_data_by_condition('freelancer_post_reg', $contition_array, $data = 'freelancer_post_fullname,freelancer_post_username', $sortby = '', $orderby = 'desc', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        $this->data['title'] = $jobdata[0]['freelancer_post_fullname'] . " " . $jobdata[0]['freelancer_post_username'] . TITLEPOSTFIX;
        $this->load->view('freelancer/freelancer_post/freelancer_save_post', $this->data);
    }

//FREELANCER_APPLY SAVE POST(PROJECT) END
//Freelancer Save Post Controller End
//AJAX_FREELANCER_APPLY SAVE POST(PROJECT) START
    public function ajax_freelancer_save_post() {
        $this->data['userid'] = $userid = $this->session->userdata('aileenuser');
        $perpage = 5;
        $page = 1;
        if (!empty($_GET["page"]) && $_GET["page"] != 'undefined') {
            $page = $_GET["page"];
        }

        $start = ($page - 1) * $perpage;
        if ($start < 0)
            $start = 0;

// job seeker detail
        $contition_array = array('user_id' => $userid, 'is_delete' => 0, 'status' => 1);
        $jobdata = $this->data['jobdata'] = $this->common->select_data_by_condition('freelancer_post_reg', $contition_array, $data = '*', $sortby = '', $orderby = 'desc', $limit = '', $offset = '', $join_str = array(), $groupby = '');

// post detail
        $join_str[0]['table'] = 'freelancer_post';
        $join_str[0]['join_table_id'] = 'freelancer_post.post_id';
        $join_str[0]['from_table_id'] = 'freelancer_apply.post_id';
        $join_str[0]['join_type'] = '';

        $limit = $perpage;
        $offset = $start;

        $contition_array = array('freelancer_apply.job_delete' => 1, 'freelancer_apply.user_id' => $userid, 'freelancer_apply.job_save' => 2);
        $postdetail = $this->data['postdetail'] = $this->common->select_data_by_condition('freelancer_apply', $contition_array, $data = 'freelancer_apply.app_id, freelancer_post.post_id, freelancer_post.user_id, freelancer_post.created_date, freelancer_post.post_name, freelancer_post.post_field_req, freelancer_post.post_est_time, freelancer_post.post_skill, freelancer_post.post_exp_month, freelancer_post.post_exp_year, freelancer_post.post_other_skill, freelancer_post.post_description, freelancer_post.post_rate, freelancer_post.post_last_date, freelancer_post.post_currency, freelancer_post.post_rating_type, freelancer_post.country, freelancer_post.city', $sortby = 'freelancer_apply.modify_date', $orderby = 'desc', $limit = '', $offset = '', $join_str, $groupby = '');
        $postdetail1 = $this->data['postdetail'] = $this->common->select_data_by_condition('freelancer_apply', $contition_array, $data = 'freelancer_apply.app_id, freelancer_post.post_id, freelancer_post.user_id, freelancer_post.created_date, freelancer_post.post_name, freelancer_post.post_field_req, freelancer_post.post_est_time, freelancer_post.post_skill, freelancer_post.post_exp_month, freelancer_post.post_exp_year, freelancer_post.post_other_skill, freelancer_post.post_description, freelancer_post.post_rate, freelancer_post.post_last_date, freelancer_post.post_currency, freelancer_post.post_rating_type, freelancer_post.country, freelancer_post.city', $sortby = 'freelancer_apply.modify_date', $orderby = 'desc', $limit, $offset = '', $join_str, $groupby = '');
//echo "<pre>";print_r($this->data['postdetail']);die();  
        if (empty($_GET["total_record"])) {
            $_GET["total_record"] = count($postdetail);
        }
        $return_html = '';
        $return_html .= '<input type="hidden" class="page_number" value="' . $page . '" />';
        $return_html .= '<input type="hidden" class="total_record" value="' . $_GET["total_record"] . '" />';

        if (count($postdetail) > 0) {
            foreach ($postdetail1 as $post) {
                $this->data['userid'] = $userid = $this->session->userdata('aileenuser');
                $contition_array = array('post_id' => $post['post_id'], 'job_delete' => 0, 'user_id' => $userid);
                $freelancerapply1 = $this->data['freelancerapply'] = $this->common->select_data_by_condition('freelancer_apply', $contition_array, $data = '*', $sortby = '', $orderby = 'desc', $limit = '', $offset = '', $join_str = array(), $groupby = '');
                if ($freelancerapply1) {
                    
                } else {
                    $return_html .= '<div class="job-contact-frnd ">
                        <div class="profile-job-post-detail clearfix" id="postdata' . $post['app_id'] . '">';
                    $return_html .= ' <div class="profile-job-post-title-inside clearfix">
                                <div class="profile-job-post-title-inside clearfix">
                                    <div class="profile-job-post-title clearfix margin_btm">
                                        <div class="profile-job-profile-button clearfix">
                                            <div class="profile-job-details col-md-12">
                                                <ul>
                                                    <li class="fr">';
                    $return_html .= $this->lang->line("created_date");
                    $return_html .= ':';
                    $return_html .= trim(date('d-M-Y', strtotime($post['created_date'])));
                    $return_html .= '</li>
                                                    <li>';
                    $cache_time1 = $post['post_name'];
                    if ($cache_time1 != '') {
                        $text = strtolower($this->common->clean($cache_time1));
                    } else {
                        $text = '';
                    }
                    $city = $this->db->select('city')->get_where('freelancer_hire_reg', array('user_id' => $post['user_id']))->row()->city;
                    $cityname = $this->db->select('city_name')->get_where('cities', array('city_id' => $city))->row()->city_name;

                    if ($cityname != '') {
                        $cityname1 = '-vacancy-in-' . strtolower($this->common->clean($cityname));
                    } else {
                        $cityname1 = '';
                    }
                    $return_html .= '<a href="' . base_url('freelancer-hire/project/' . $text . $cityname1 . '-' . $post['user_id'] . '-' . $post['post_id']) . ' " title="' . ucwords($post['post_name']) . '" title="' . ucwords($this->text2link($post['post_name'])) . '" class="post_title">';
                    $return_html .= ucwords($this->text2link($post['post_name']));
                    $return_html .= '</a> </li>';
                    $firstname = $this->db->select('fullname')->get_where('freelancer_hire_reg', array('user_id' => $post['user_id']))->row()->fullname;
                    $lastname = $this->db->select('username')->get_where('freelancer_hire_reg', array('user_id' => $post['user_id']))->row()->username;

                    $return_html .= '<li><a class="display_inline" title="' . ucwords($firstname) . ' ." ".' . ucwords($lastname) . '" href="' . base_url('freelancer/freelancer_hire_profile/' . $post['user_id'] . '?page=freelancer_post') . '">';
                    $return_html .= ucwords($firstname) . "  " . ucwords($lastname);
                    $return_html .= '</a>';

                    $country = $this->db->select('country')->get_where('freelancer_hire_reg', array('user_id' => $post['user_id']))->row()->country;
                    $cityname = $this->db->select('city_name')->get_where('cities', array('city_id' => $city))->row()->city_name;
                    $countryname = $this->db->select('country_name')->get_where('countries', array('country_id' => $country))->row()->country_name;
                    if ($cityname || $countryname) {
                        $return_html .= ' <div class="fr lction">
                                                                <p title="Location">
                                                                    <i class="fa fa-map-marker" aria-hidden="true"></i>';
                        if ($cityname) {
                            $return_html .= $cityname . ",";
                        }
                        if ($countryname) {
                            $return_html .= $countryname;
                        }
                        $return_html .= '</p>
                                                            </div>';
                    }
                    $return_html .= '</li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="profile-job-profile-menu">
                                            <ul class="clearfix">
                                                <li> <b>';
                    $return_html .= $this->lang->line("field");
                    $return_html .= '</b> <span>';
                    $return_html .= $this->db->select('category_name')->get_where('category', array('category_id' => $post['post_field_req']))->row()->category_name;

                    $return_html .= '</span>
                                                </li>
                                                <li> <b>';
                    $return_html .= $this->lang->line("skill");
                    $return_html .= '</b> <span>';

                    $comma = ", ";
                    $k = 0;
                    $aud = $post['post_skill'];
                    $aud_res = explode(',', $aud);
                    if (!$post['post_skill']) {
                        $return_html .= $post['post_other_skill'];
                    } else if (!$post['post_other_skill']) {
                        foreach ($aud_res as $skill) {
                            if ($k != 0) {
                                $return_html .= $comma;
                            }
                            $cache_time = $this->db->select('skill')->get_where('skill', array('skill_id' => $skill))->row()->skill;

                            $return_html .= $cache_time;
                            $k++;
                        }
                    } else if ($post['post_skill'] && $post['post_other_skill']) {
                        foreach ($aud_res as $skill) {
                            if ($k != 0) {
                                $return_html .= $comma;
                            }
                            $cache_time = $this->db->select('skill')->get_where('skill', array('skill_id' => $skill))->row()->skill;
                            $return_html .= $cache_time;
                            $k++;
                        } $return_html .= "," . $post['post_other_skill'];
                    }
                    $return_html .= '</span>
                                                </li>
                                                <li><b>';
                    $return_html .= $this->lang->line("project_description");
                    $return_html .= '</b><span><pre>';

                    if ($post['post_description']) {
                        $return_html .= $this->common->make_links($post['post_description']);
                    } else {
                        $return_html .= PROFILENA;
                    }
                    $return_html .= ' </pre></span>
                                                </li>
                                                <li><b>';
                    $return_html .= $this->lang->line("rate");
                    $return_html .= '</b><span>';

                    if ($post['post_rate']) {
                        $return_html .= $post['post_rate'];
                        $return_html .= "&nbsp";
                        $return_html .= $this->db->select('currency_name')->get_where('currency', array('currency_id' => $post['post_currency']))->row()->currency_name;
                        $return_html .= "&nbsp";
                        if ($post['post_rating_type'] == 1) {
                            $return_html .= "Hourly";
                        } else {
                            $return_html .= "Fixed";
                        }
                    } else {
                        $return_html .= PROFILENA;
                    }
                    $return_html .= '</span>
                                                </li>
                                                <li>
                                                    <b>';
                    $return_html .= $this->lang->line("required_experiance");
                    $return_html .= '</b>
                                                    <span>';

                    if ($post['post_exp_month'] || $post['post_exp_year']) {
                        if ($post['post_exp_year']) {
                            $return_html .= $post['post_exp_year'];
                        }
                        if ($post['post_exp_month']) {

                            if ($post['post_exp_year'] == '0' || $post['post_exp_year'] == '') {
                                $return_html .= 0;
                            }
                            $return_html .= ".";
                            $return_html .= $post['post_exp_month'];
                        } else {
                            $return_html .= "." . "0";
                        }

                        $return_html .= " Year";
                    } else {
                        $return_html .= PROFILENA;
                    }

                    $return_html .= '</span>
                                                </li>
                                                <li><b>';
                    $return_html .= $this->lang->line("estimated_time");
                    $return_html .= '</b><span>';

                    if ($post['post_est_time']) {
                        $return_html .= $post['post_est_time'];
                    } else {
                        $return_html .= PROFILENA;
                    }
                    $return_html .= '</span>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="profile-job-profile-button clearfix">
                                            <div class="profile-job-details col-md-12">
                                                <ul>
                                          <li class="job_all_post last_date">';
//                    $return_html .= $this->lang->line("last_date");
//                    $return_html .= ':';
//
//                    if ($post['post_last_date']) {
//                        $return_html .= date('d-M-Y', strtotime($post['post_last_date']));
//                    } else {
//                        $return_html .= PROFILENA;
//                    }
                    $return_html .= '</li>
                                       <li class=fr>
                                      <a href="javascript:void(0);" class="button" onclick="removepopup(' . $post['app_id'] . ')">';
                    $return_html .= $this->lang->line("remove");
                    $return_html .= '</a>';

                    $this->data['userid'] = $userid = $this->session->userdata('aileenuser');
                    $contition_array = array('post_id' => $post['post_id'], 'job_delete' => 0, 'user_id' => $userid);
                    $freelancerapply1 = $this->data['freelancerapply'] = $this->common->select_data_by_condition('freelancer_apply', $contition_array, $data = '*', $sortby = '', $orderby = 'desc', $limit = '', $offset = '', $join_str = array(), $groupby = '');
                    if ($freelancerapply1) {
                        
                    } else {
                        $return_html .= ' <a href="javascript:void(0);" class="button" onclick="applypopup(' . $post['post_id'] . ',' . $post['app_id'] . ')">';
                        $return_html .= $this->lang->line("apply");
                        $return_html .= '</a>
                                                        </li>';
                    }
                    $return_html .= ' </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>';
                }
            }
        } else {
            $return_html .= '<div class="art-img-nn">
                                                <div class="art_no_post_img">

                                                    <img src="../assets/img/free-no1.png">

                                                </div>
                                                <div class="art_no_post_text">';
            $return_html .= $this->lang->line("no_saved_project");
            $return_html .= '</div>
                                            </div>';
        }
        echo $return_html;
    }

//AJAX_FREELANCER_APPLY SAVE POST(PROJECT) END
//FREELANCER_HIRE PROFILE PIC INSERT START
    public function user_image_insert1() {
        $userid = $this->session->userdata('aileenuser');

        $contition_array = array('user_id' => $userid);
        $user_reg_data = $this->common->select_data_by_condition('freelancer_hire_reg', $contition_array, $data = 'freelancer_hire_user_image', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        $user_reg_prev_image = $user_reg_data[0]['freelancer_hire_user_image'];

        if ($user_reg_prev_image != '') {
            $user_image_main_path = $this->config->item('free_hire_profile_main_upload_path');
            $user_bg_full_image = $user_image_main_path . $user_reg_prev_image;
            if (isset($user_bg_full_image)) {
                unlink($user_bg_full_image);
            }

            $user_image_thumb_path = $this->config->item('free_hire_profile_thumb_upload_path');
            $user_bg_thumb_image = $user_image_thumb_path . $user_reg_prev_image;
            if (isset($user_bg_thumb_image)) {
                unlink($user_bg_thumb_image);
            }
        }


        $data = $_POST['image'];
        // echo $data;exit;
        $data = str_replace('data:image/png;base64,', '', $data);
        $data = str_replace(' ', '+', $data);
        // echo $data;exit;
//        list($type, $data) = explode(';', $data);
//        list(, $data) = explode(',', $data);
        $user_bg_path = $this->config->item('free_hire_profile_main_upload_path');
        $imageName = time() . '.png';
        $data = base64_decode($data);
        $main_image = $user_bg_path . $imageName;
        //  $file = $user_bg_path . $imageName;
        //file_put_contents($user_bg_path . $imageName, $data);
        $success = file_put_contents($main_image, $data);
        // $main_image = $user_bg_path . $imageName;
        $main_image_size = filesize($main_image);

//        if ($main_image_size > '1000000') {
//            $quality = "50%";
//        } elseif ($main_image_size > '50000' && $main_image_size < '1000000') {
//            $quality = "55%";
//        } elseif ($main_image_size > '5000' && $main_image_size < '50000') {
//            $quality = "60%";
//        } elseif ($main_image_size > '100' && $main_image_size < '5000') {
//            $quality = "65%";
//        } elseif ($main_image_size > '1' && $main_image_size < '100') {
//            $quality = "70%";
//        } else {
//            $quality = "100%";
//        }
//        /* RESIZE */
//        $freelancer_hire_profile['image_library'] = 'gd2';
//        $freelancer_hire_profile['source_image'] = $main_image;
//        $freelancer_hire_profile['new_image'] = $main_image;
//        $freelancer_hire_profile['quality'] = $quality;
//        $instanse10 = "image10";
//        $this->load->library('image_lib', $freelancer_hire_profile, $instanse10);
//        $this->$instanse10->crop();
//        /* RESIZE */

        $s3 = new S3(awsAccessKey, awsSecretKey);
        $s3->putBucket(bucket, S3::ACL_PUBLIC_READ);
        $abc = $s3->putObjectFile($main_image, bucket, $main_image, S3::ACL_PUBLIC_READ);

        $user_thumb_path = $this->config->item('free_hire_profile_thumb_upload_path');
        $user_thumb_width = $this->config->item('free_hire_profile_thumb_width');
        $user_thumb_height = $this->config->item('free_hire_profile_thumb_height');

        $upload_image = $user_bg_path . $imageName;

        // $thumb_image_uplode = $this->thumb_img_uplode($upload_image, $imageName, $user_thumb_path, $user_thumb_width, $user_thumb_height);

        $thumb_image = $user_thumb_path . $imageName;
        copy($main_image, $thumb_image);
        $abc = $s3->putObjectFile($thumb_image, bucket, $thumb_image, S3::ACL_PUBLIC_READ);

        $data = array(
            'freelancer_hire_user_image' => $imageName
        );

        $update = $this->common->update_data($data, 'freelancer_hire_reg', 'user_id', $userid);
        //  echo "11111";die();

        if ($update) {

            $contition_array = array('user_id' => $userid, 'status' => '1', 'is_delete' => '0');
            $freelancerpostdata = $this->common->select_data_by_condition('freelancer_hire_reg', $contition_array, $data = 'freelancer_hire_user_image', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);
            $userimage .= '<img src="' . FREE_HIRE_PROFILE_MAIN_UPLOAD_URL . $freelancerpostdata[0]['freelancer_hire_user_image'] . '" alt="" >';
            $userimage .= '<a href="javascript:void(0);" onclick="updateprofilepopup();" class="cusome_upload"><img  src="' . base_url('../assets/img/cam.png') . '">';
            $userimage .= $this->lang->line("update_profile_picture");
            $userimage .= '</a>';

            echo $userimage;
        } else {

            $this->session->flashdata('error', 'Your data not inserted');
            redirect('freelancer-hire/projects', refresh);
        }
    }

//FREELANCER_HIRE PROFILE PIC INSERT END
    //FREELANCER_APPLY PROFILE PIC INSERT START
    public function user_image_add1() {
        $userid = $this->session->userdata('aileenuser');

        $contition_array = array('user_id' => $userid);
        $user_reg_data = $this->common->select_data_by_condition('freelancer_post_reg', $contition_array, $data = 'freelancer_post_user_image', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        $user_reg_prev_image = $user_reg_data[0]['freelancer_post_user_image'];

        if ($user_reg_prev_image != '') {
            $user_image_main_path = $this->config->item('free_post_profile_main_upload_path');
            $user_bg_full_image = $user_image_main_path . $user_reg_prev_image;
            if (isset($user_bg_full_image)) {
                unlink($user_bg_full_image);
            }

            $user_image_thumb_path = $this->config->item('free_post_profile_thumb_upload_path');
            $user_bg_thumb_image = $user_image_thumb_path . $user_reg_prev_image;
            if (isset($user_bg_thumb_image)) {
                unlink($user_bg_thumb_image);
            }
        }


        $data = $_POST['image'];
        list($type, $data) = explode(';', $data);
        list(, $data) = explode(',', $data);
        $user_bg_path = $this->config->item('free_post_profile_main_upload_path');
        $data = base64_decode($data);
        $imageName = time() . '.png';
        $file = $user_bg_path . $imageName;
        file_put_contents($user_bg_path . $imageName, $data);
        $success = file_put_contents($file, $data);
        $main_image = $user_bg_path . $imageName;
        $main_image_size = filesize($main_image);

//        if ($main_image_size > '1000000') {
//            $quality = "50%";
//        } elseif ($main_image_size > '50000' && $main_image_size < '1000000') {
//            $quality = "55%";
//        } elseif ($main_image_size > '5000' && $main_image_size < '50000') {
//            $quality = "60%";
//        } elseif ($main_image_size > '100' && $main_image_size < '5000') {
//            $quality = "65%";
//        } elseif ($main_image_size > '1' && $main_image_size < '100') {
//            $quality = "70%";
//        } else {
//            $quality = "100%";
//        }
//        /* RESIZE */
//        $freelancer_post_profile['image_library'] = 'gd2';
//        $freelancer_post_profile['source_image'] = $main_image;
//        $freelancer_post_profile['new_image'] = $main_image;
//        $freelancer_post_profile['quality'] = $quality;
//        $instanse10 = "image10";
//        $this->load->library('image_lib', $freelancer_post_profile, $instanse10);
//        $this->$instanse10->watermark();
//        /* RESIZE */

        $s3 = new S3(awsAccessKey, awsSecretKey);
        $s3->putBucket(bucket, S3::ACL_PUBLIC_READ);
        $abc = $s3->putObjectFile($main_image, bucket, $main_image, S3::ACL_PUBLIC_READ);

        $user_thumb_path = $this->config->item('free_post_profile_thumb_upload_path');
        $user_thumb_width = $this->config->item('free_post_profile_thumb_width');
        $user_thumb_height = $this->config->item('free_post_profile_thumb_height');

        // $upload_image = $user_bg_path . $imageName;
        //  $thumb_image_uplode = $this->thumb_img_uplode($upload_image, $imageName, $user_thumb_path, $user_thumb_width, $user_thumb_height);

        $thumb_image = $user_thumb_path . $imageName;
        copy($main_image, $thumb_image);
        $abc = $s3->putObjectFile($thumb_image, bucket, $thumb_image, S3::ACL_PUBLIC_READ);

        $data = array(
            'freelancer_post_user_image' => $imageName
        );

        $update = $this->common->update_data($data, 'freelancer_post_reg', 'user_id', $userid);
        //  echo "11111";die();

        if ($update) {

            $contition_array = array('user_id' => $userid, 'status' => '1', 'is_delete' => '0');
            $freelancerpostdata = $this->common->select_data_by_condition('freelancer_post_reg', $contition_array, $data = 'freelancer_post_user_image', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);
            $userimage .= '<img src="' . FREE_POST_PROFILE_MAIN_UPLOAD_URL . $freelancerpostdata[0]['freelancer_post_user_image'] . '" alt="" >';
            $userimage .= '<a href="javascript:void(0);" onclick="updateprofilepopup();" class="cusome_upload"><img  src="' . base_url('../assets/img/cam.png') . '">';
            $userimage .= $this->lang->line("update_profile_picture");
            $userimage .= '</a>';

            echo $userimage;
        } else {

            $this->session->flashdata('error', 'Your data not inserted');
            redirect('freelancer-work/home', refresh);
        }
    }

//FREELANCER_APPLY PROFILE PIC INSERT END
    //FREELANCER_HIRE_PROFILE PAGE START
    public function freelancer_hire_profile($id = "") {
        if (is_numeric($id)) {
            
        } else {
            $id = $this->db->select('user_id')->get_where('freelancer_hire_reg', array('freelancer_hire_slug' => $id, 'status' => 1))->row()->user_id;
        }
        $userid = $this->session->userdata('aileenuser');
        //check user deactivate start
        $this->freelancer_hire_deactivate_check();
        //check user deactivate end
        if ($id == $userid || $id == '') {
            // code for display page start
            $this->freelancer_hire_check();
            // code for display page end
            $contition_array = array('user_id' => $userid, 'status' => '1');
            $hire_data = $this->data['freelancerhiredata'] = $this->common->select_data_by_condition('freelancer_hire_reg', $contition_array, $data = 'username, fullname, email, skyupid, phone, country, state, city, pincode, address, professional_info, freelancer_hire_user_image, profile_background, user_id,designation', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
        } else {
            $contition_array = array('user_id' => $id, 'status' => '1', 'free_hire_step' => 3);
            $hire_data = $this->data['freelancerhiredata'] = $this->common->select_data_by_condition('freelancer_hire_reg', $contition_array, $data = 'username, fullname, email, skyupid, phone, country, state, city, pincode, address, professional_info, freelancer_hire_user_image, profile_background, user_id,designation', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
        }
        $this->data['title'] = $hire_data[0]['fullname'] . " " . $hire_data[0]['username'] . TITLEPOSTFIX;
        $this->load->view('freelancer/freelancer_hire/freelancer_hire_profile', $this->data);
    }

//FREELANCER_HIRE_PROFILE PAGE END
    //FREELANCER_APPLY PORTFOLIO UPLOAD PDF START
    public function pdf($id) {
        $contition_array = array('user_id' => $id, 'status' => '1');
        $this->data['freelancerdata'] = $freelancerdata = $this->common->select_data_by_condition('freelancer_post_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
        // echo "<pre>"; print_r($this->data['freelancerdata']);die();
        $this->load->view('freelancer/freelancer_post/freelancer_pdf', $this->data);
    }

//FREELANCER_APPLY PORTFOLIO UPLOAD PDF END
//FREELANCER_HIRE REMOVE SAVED FREELANCER START
    public function remove_save() {
        $saveid = $_POST['save_id'];
        $userid = $this->session->userdata('aileenuser');
        $data = array(
            'status' => 1
        );
        $updatedata = $this->common->update_data($data, 'save', 'save_id', $saveid);
    }

//FREELANCER_HIRE REMOVE SAVED FREELANCER END
//FREELANCER_APPLY PROFILE PAGE START
    public function freelancer_post_profile($id) {
        if (is_numeric($id)) {
            
        } else {
            $id = $this->db->select('user_id')->get_where('freelancer_post_reg', array('freelancer_apply_slug' => $id, 'status' => 1))->row()->user_id;
        }
        $userid = $this->session->userdata('aileenuser');
//code for check user deactivate start
        $this->freelancer_apply_deactivate_check();
        //code for check user deactivate end
        if ($id == $userid || $id == '') {

            // code for display page start
            $this->freelancer_apply_check();
            // code for display page end
            $contition_array = array('user_id' => $userid);
            $apply_data = $this->data['freelancerpostdata'] = $this->common->select_data_by_condition('freelancer_post_reg', $contition_array, $data = 'freelancer_post_fullname, freelancer_post_username, freelancer_post_skypeid, freelancer_post_email, freelancer_post_phoneno, freelancer_post_country, freelancer_post_state, freelancer_post_city, freelancer_post_address, freelancer_post_pincode, freelancer_post_field, freelancer_post_area, freelancer_post_skill_description, freelancer_post_hourly, freelancer_post_ratestate, freelancer_post_fixed_rate, freelancer_post_job_type, freelancer_post_work_hour, freelancer_post_degree, freelancer_post_stream, freelancer_post_univercity, freelancer_post_collage, freelancer_post_percentage, freelancer_post_passingyear, freelancer_post_portfolio_attachment, freelancer_post_portfolio, user_id, freelancer_post_user_image, profile_background, designation, freelancer_post_otherskill, freelancer_post_exp_month, freelancer_post_exp_year', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
        } else {
            // echo "222";die();
            $contition_array = array('user_id' => $id, 'free_post_step' => 7);
            $apply_data = $this->data['freelancerpostdata'] = $this->common->select_data_by_condition('freelancer_post_reg', $contition_array, $data = 'freelancer_post_fullname, freelancer_post_username, freelancer_post_skypeid, freelancer_post_email, freelancer_post_phoneno, freelancer_post_country, freelancer_post_state, freelancer_post_city, freelancer_post_address, freelancer_post_pincode, freelancer_post_field, freelancer_post_area, freelancer_post_skill_description, freelancer_post_hourly, freelancer_post_ratestate, freelancer_post_fixed_rate, freelancer_post_job_type, freelancer_post_work_hour, freelancer_post_degree, freelancer_post_stream, freelancer_post_univercity, freelancer_post_collage, freelancer_post_percentage, freelancer_post_passingyear, freelancer_post_portfolio_attachment, freelancer_post_portfolio, user_id, freelancer_post_user_image, profile_background, designation, freelancer_post_otherskill, freelancer_post_exp_month, freelancer_post_exp_year', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
        }
        //   echo "<pre>"; print_r($apply_data);die();
        $this->data['title'] = $apply_data[0]['freelancer_post_fullname'] . " " . $apply_data[0]['freelancer_post_username'] . TITLEPOSTFIX;
        $this->load->view('freelancer/freelancer_post/freelancer_post_profile', $this->data);
    }

//FREELANCER_APPLY PROFILE PAGE END
//FREELANCER_HIRE REMOVE POST(PROJECT) STRAT
    public function remove_post() {
        $postid = $_POST['post_id'];
        $data = array(
            'is_delete' => 1,
            'modify_date' => date('y-m-d h:i:s')
        );
        $updatedata = $this->common->update_data($data, 'freelancer_post', 'post_id', $postid);
    }

//FREELANCER_HIRE REMOVE POST(PROJECT) END
//FREELANCER_HIRE INVITE APPLIED START
    public function invite_user($appid, $status, $postid, $personid) {
        $userid = $this->session->userdata('aileenuser');

        $data = array(
            'status' => $status,
            'modify_date' => date('y-m-d h:i:s')
        );


        $updatedata = $this->common->update_data($data, 'freelancer_apply', 'app_id', $appid);

        // insert notification

        $data = array(
            'not_type' => 4,
            'not_from_id' => $userid,
            'not_to_id' => $personid,
            'not_read' => 2,
            'not_from' => 5,
            'not_product_id' => $appid,
            "not_active" => 1,
            'not_created_date' => date('Y-m-d H:i:s')
        );

        $insert_id = $this->common->insert_data_getid($data, 'notification');
        // end notoification

        redirect('freelancer/freelancer_apply_list/' . $postid, 'refresh');
    }

//FREELANCER_HIRE INVITE APPLIED END
//FREELANCER_APPLY DEACTIVATE START
    public function deactivate() {

        $id = $_POST['id'];
        $data = array(
            'status' => 0
        );
        $update = $this->common->update_data($data, 'freelancer_post_reg', 'user_id', $id);
    }

//FREELANCER_APPLY DEACTIVATE END
//FREELANCER_HIRE DEACTIVATE START
    public function deactivate_hire() {
        $id = $_POST['id'];
        $data = array(
            'status' => 0
        );
        $update = $this->common->update_data($data, 'freelancer_hire_reg', 'user_id', $id);
        $update = $this->common->update_data($data, 'freelancer_post', 'user_id', $id);
    }

//FREELANCER_HIRE DEACTIVATE END
//FREELANCER_HIRE COVER PIC STRAT
    public function ajaxpro_hire() {

        // echo "<pre>";print_r($_POST['image']);die();
        $userid = $this->session->userdata('aileenuser');



        $contition_array = array('user_id' => $userid);
        $user_reg_data = $this->common->select_data_by_condition('freelancer_hire_reg', $contition_array, $data = 'profile_background,profile_background_main', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        $user_reg_prev_image = $user_reg_data[0]['profile_background'];
        $user_reg_prev_main_image = $user_reg_data[0]['profile_background_main'];

        if ($user_reg_prev_image != '') {
            $user_image_main_path = $this->config->item('free_hire_bg_main_upload_path');
            $user_bg_full_image = $user_image_main_path . $user_reg_prev_image;
            if (isset($user_bg_full_image)) {
                unlink($user_bg_full_image);
            }

            $user_image_thumb_path = $this->config->item('free_hire_bg_thumb_upload_path');
            $user_bg_thumb_image = $user_image_thumb_path . $user_reg_prev_image;
            if (isset($user_bg_thumb_image)) {
                unlink($user_bg_thumb_image);
            }
        }
        if ($user_reg_prev_main_image != '') {
            $user_image_original_path = $this->config->item('free_hire_bg_original_upload_path');
            $user_bg_origin_image = $user_image_original_path . $user_reg_prev_main_image;
            if (isset($user_bg_origin_image)) {
                unlink($user_bg_origin_image);
            }
        }


        $data = $_POST['image'];
        $data = str_replace('data:image/png;base64,', '', $data);
        $data = str_replace(' ', '+', $data);


        // $imageName = time() . '.png';
        // $base64string = $data;
        // file_put_contents('uploads/free_hire_bg/' . $imageName, base64_decode(explode(',', $base64string)[1]));


        $user_bg_path = $this->config->item('free_hire_bg_main_upload_path');
        $imageName = time() . '.png';
        $data = base64_decode($data);
        $file = $user_bg_path . $imageName;
        $success = file_put_contents($file, $data);
        // file_put_contents($user_bg_path . $imageName, base64_decode(explode(',', $base64string)[1]));

        $main_image = $user_bg_path . $imageName;
        $main_image_size = filesize($main_image);

//        if ($main_image_size > '1000000') {
//            $quality = "10%";
//        } elseif ($main_image_size > '50000' && $main_image_size < '1000000') {
//            $quality = "15%";
//        } elseif ($main_image_size > '5000' && $main_image_size < '50000') {
//            $quality = "20%";
//        } elseif ($main_image_size > '100' && $main_image_size < '5000') {
//            $quality = "25%";
//        } elseif ($main_image_size > '1' && $main_image_size < '100') {
//            $quality = "30%";
//        } else {
//            $quality = "40%";
//        }
//        /* RESIZE */
//        $freelancer_hire_bg['image_library'] = 'gd2';
//        $freelancer_hire_bg['source_image'] = $main_image;
//        $freelancer_hire_bg['new_image'] = $main_image;
//        $freelancer_hire_bg['quality'] = $quality;
//        $instanse_aa = "image1";
//        $this->load->library('image_lib', $freelancer_hire_bg, $instanse_aa);
//        $this->$instanse_aa->crop();
//        /* RESIZE */

        $s3 = new S3(awsAccessKey, awsSecretKey);
        $s3->putBucket(bucket, S3::ACL_PUBLIC_READ);
        $abc = $s3->putObjectFile($main_image, bucket, $main_image, S3::ACL_PUBLIC_READ);



        $user_thumb_path = $this->config->item('free_hire_bg_thumb_upload_path');
        $user_thumb_width = $this->config->item('free_hire_bg_thumb_width');
        $user_thumb_height = $this->config->item('free_hire_bg_thumb_height');

        $upload_image = $user_bg_path . $imageName;

        $thumb_image_uplode = $this->thumb_img_uplode($upload_image, $imageName, $user_thumb_path, $user_thumb_width, $user_thumb_height);

        $thumb_image = $user_thumb_path . $imageName;
        $abc = $s3->putObjectFile($thumb_image, bucket, $thumb_image, S3::ACL_PUBLIC_READ);

        $data = array(
            'profile_background' => $imageName
        );

        $update = $this->common->update_data($data, 'freelancer_hire_reg', 'user_id', $userid);
        $this->data['jobdata'] = $this->common->select_data_by_id('freelancer_hire_reg', 'user_id', $userid, $data = 'profile_background', $join_str = array());
        // $coverpic = '<img  src="' . base_url($this->config->item('free_hire_bg_main_upload_path') . $this->data['jobdata'][0]['profile_background']) . '" name="image_src" id="image_src" />';
        $coverpic = '<img id="image_src" name="image_src" src = "' . FREE_HIRE_BG_MAIN_UPLOAD_URL . $this->data['jobdata'][0]['profile_background'] . '" />';

        echo $coverpic;
    }

    public function image_hire() {


        //echo "hhhhhhhhh";die();
        $userid = $this->session->userdata('aileenuser');

        $config['upload_path'] = $this->config->item('free_hire_bg_original_upload_path');
        $config['allowed_types'] = $this->config->item('free_hire_bg_main_allowed_types');

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


        $updatedata = $this->common->update_data($data, 'freelancer_hire_reg', 'user_id', $userid);

        if ($updatedata) {
            echo $userid;
        } else {
            echo "welcome";
        }
    }

//FREELANCER_HIRE COVER PIC END
//FREELANCER_APPLY COVER PIC START
    public function ajaxpro_work() {
        $userid = $this->session->userdata('aileenuser');


        $contition_array = array('user_id' => $userid);
        $user_reg_data = $this->common->select_data_by_condition('freelancer_post_reg', $contition_array, $data = 'profile_background,profile_background_main', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        $user_reg_prev_image = $user_reg_data[0]['profile_background'];
        $user_reg_prev_main_image = $user_reg_data[0]['profile_background_main'];

        if ($user_reg_prev_image != '') {
            $user_image_main_path = $this->config->item('free_post_bg_main_upload_path');
            $user_bg_full_image = $user_image_main_path . $user_reg_prev_image;
            if (isset($user_bg_full_image)) {
                unlink($user_bg_full_image);
            }

            $user_image_thumb_path = $this->config->item('free_post_bg_thumb_upload_path');
            $user_bg_thumb_image = $user_image_thumb_path . $user_reg_prev_image;
            if (isset($user_bg_thumb_image)) {
                unlink($user_bg_thumb_image);
            }
        }
        if ($user_reg_prev_main_image != '') {
            $user_image_original_path = $this->config->item('free_post_bg_original_upload_path');
            $user_bg_origin_image = $user_image_original_path . $user_reg_prev_main_image;
            if (isset($user_bg_origin_image)) {
                unlink($user_bg_origin_image);
            }
        }




        $data = $_POST['image'];
        $data = str_replace('data:image/png;base64,', '', $data);
        $data = str_replace(' ', '+', $data);
        $user_bg_path = $this->config->item('free_post_bg_main_upload_path');
        $imageName = time() . '.png';
        $data = base64_decode($data);
        $file = $user_bg_path . $imageName;
        $success = file_put_contents($file, $data);

        $main_image = $user_bg_path . $imageName;

        $main_image_size = filesize($main_image);

//        if ($main_image_size > '1000000') {
//            $quality = "50%";
//        } elseif ($main_image_size > '50000' && $main_image_size < '1000000') {
//            $quality = "55%";
//        } elseif ($main_image_size > '5000' && $main_image_size < '50000') {
//            $quality = "60%";
//        } elseif ($main_image_size > '100' && $main_image_size < '5000') {
//            $quality = "65%";
//        } elseif ($main_image_size > '1' && $main_image_size < '100') {
//            $quality = "70%";
//        } else {
//            $quality = "100%";
//        }
//        /* RESIZE */
//        $freelancer_work_bg['image_library'] = 'gd2';
//        $freelancer_work_bg['source_image'] = $main_image;
//        $freelancer_work_bg['new_image'] = $main_image;
//        $freelancer_work_bg['quality'] = $quality;
//        $instanse10 = "image10";
//        $this->load->library('image_lib', $freelancer_work_bg, $instanse10);
//        $this->$instanse10->watermark();
//        /* RESIZE */

        $s3 = new S3(awsAccessKey, awsSecretKey);
        $s3->putBucket(bucket, S3::ACL_PUBLIC_READ);
        $abc = $s3->putObjectFile($main_image, bucket, $main_image, S3::ACL_PUBLIC_READ);

        $user_thumb_path = $this->config->item('free_post_bg_thumb_upload_path');
        $user_thumb_width = $this->config->item('free_post_bg_thumb_width');
        $user_thumb_height = $this->config->item('free_post_bg_thumb_height');

        $upload_image = $user_bg_path . $imageName;

        $thumb_image_uplode = $this->thumb_img_uplode($upload_image, $imageName, $user_thumb_path, $user_thumb_width, $user_thumb_height);

        $thumb_image = $user_thumb_path . $imageName;
        $abc = $s3->putObjectFile($thumb_image, bucket, $thumb_image, S3::ACL_PUBLIC_READ);

        $data = array(
            'profile_background' => $imageName
        );
        //echo "<pre>";print_r($data);die();

        $update = $this->common->update_data($data, 'freelancer_post_reg', 'user_id', $userid);

        $this->data['jobdata'] = $this->common->select_data_by_id('freelancer_post_reg', 'user_id', $userid, $data = 'profile_background', $join_str = array());
        $coverpic = '<img  src="' . FREE_POST_BG_MAIN_UPLOAD_URL . $this->data['jobdata'][0]['profile_background'] . '" name="image_src" id="image_src" />';
        echo $coverpic;
        // echo '<img src="' . $this->data['jobdata'][0]['profile_background'] . '" />';
    }

    public function image_work() {
        //echo "hiiii"; die();
        $userid = $this->session->userdata('aileenuser');

        $config['upload_path'] = $this->config->item('free_post_bg_original_upload_path');
        $config['allowed_types'] = $this->config->item('free_post_bg_main_allowed_types');

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
            'modify_date ' => date('Y-m-d h:i:s', time())
        );

        $updatedata = $this->common->update_data($data, 'freelancer_post_reg', 'user_id', $userid);

        if ($updatedata) {
            echo $userid;
        } else {
            echo "welcome";
        }
    }

//FREELANCER_APPLY COVER PIC START
//FREELANCER_APPLY DESIGNATION START
    public function designation() {
        $userid = $this->session->userdata('aileenuser');

        $data = array(
            'designation' => trim($this->input->post('designation')),
            'modify_date' => date('Y-m-d', time())
        );

        $updatdata = $this->common->update_data($data, 'freelancer_post_reg', 'user_id', $userid);

        if ($updatdata) {

            if ($this->input->post('hitext') == 1) {
                redirect('freelancer/freelancer_post_profile', refresh);
            } elseif ($this->input->post('hitext') == 2) {
                redirect('freelancer/freelancer_save_post', refresh);
            } elseif ($this->input->post('hitext') == 3) {
                redirect('freelancer/freelancer_applied_post', refresh);
            }
        } else {
            $this->session->flashdata('error', 'Your data not inserted');
            redirect('freelancer/post_apply', refresh);
        }
    }

//FREELANCER_APPLY DESIGNATION END
    //FREELANCER_APPLY REACTIVATE PROFILE STRAT
    public function reactivate() {

        $userid = $this->session->userdata('aileenuser');
        $data = array(
            'status' => 1,
            'modify_date' => date('y-m-d h:i:s')
        );

        $updatdata = $this->common->update_data($data, 'freelancer_post_reg', 'user_id', $userid);
        if ($updatdata) {

            redirect('freelancer-work/home', refresh);
        } else {

            redirect('freelancer/reactivate', refresh);
        }
    }

//FREELANCER_APPLY REACTIVATE PROFILE END
//FREELANCER_HIRE INVITE FREELANCER OF APLLIED START
    public function free_invite_user() {
        $postid = $_POST['post_id'];
        $invite_user = $_POST['invited_user'];
        //echo $invite_user;die();
        $userid = $this->session->userdata('aileenuser');
        $data = array(
            'user_id' => $userid,
            'post_id' => $postid,
            'invite_user_id' => $invite_user,
            'profile' => "freelancer"
        );
        $insert_id = $this->common->insert_data_getid($data, 'user_invite');
        $applydata = $this->common->select_data_by_id('freelancer_post_reg', 'user_id', $invite_user, $data = 'freelancer_post_email');
        $projectdata = $this->common->select_data_by_id('freelancer_post', 'post_id', $postid, $data = 'post_name');

        if ($insert_id) {
            $data = array(
                'not_type' => 4,
                'not_from_id' => $userid,
                'not_to_id' => $invite_user,
                'not_read' => 2,
                'not_status' => 0,
                'not_product_id' => $insert_id,
                'not_from' => 5,
                "not_active" => 1,
                'not_created_date' => date('Y-m-d H:i:s')
            );
            $insert_id = $this->common->insert_data_getid($data, 'notification');
            echo 'Selected';
            if ($insert_id) {
                $email_html = '';
                $email_html .= '<table width="100%" cellpadding="0" cellspacing="0">
					<tr>
                                            <td style="padding:5px;">';
                if ($this->data['freehiredata'][0]['freelancer_hire_user_image']) {
                    $email_html .= '<img src="' . FREE_HIRE_PROFILE_THUMB_UPLOAD_URL . $this->data['freehiredata'][0]['freelancer_hire_user_image'] . '" width="60" height="60"></td>';
                } else {
                    $fname = $this->data['freehiredata'][0]['fullname'];
                    $lname = $this->data['freehiredata'][0]['username'];
                    $sub_fname = substr($fname, 0, 1);
                    $sub_lname = substr($lname, 0, 1);
                    $email_html .= '<div class="post-img-div">
                          ' . ucfirst(strtolower($sub_fname)) . ucfirst(strtolower($sub_lname)) . '</div> </td>';
                }
                $email_html .= '<td style="padding:5px;">
						<p>Employer <b>' . $this->data['freehiredata'][0]['fullname'] . " " . $this->data['freehiredata'][0]['username'] . '</b> Selected you for ' . $projectdata[0]["post_name"] . ' project in freelancer profile.</p>
						<span style="display:block; font-size:11px; padding-top: 1px; color: #646464;">' . date('j F') . ' at ' . date('H:i') . '</span>
                                            </td>
                                            <td style="padding:5px;">
                                                <p><a class="btn" href="' . BASEURL . 'notification/freelancer-hire/' . $postid . '">view</a></p>
                                            </td>
					</tr>
                                    </table>';
                $subject = $this->data['freehiredata'][0]['fullname'] . " " . $this->data['freehiredata'][0]['username'] . ' Selected you for ' . $projectdata[0]["post_name"] . ' project in Aileensoul.';

                $send_email = $this->email_model->send_email($subject = $subject, $templ = $email_html, $to_email = $applydata[0]['freelancer_post_email']);
            }
        } else {
            echo 'error';
        }
    }

//FREELANCER_HIRE INVITE FREELANCER OF APLLIED END
//FREELANCER_APPLY DELETE PDF OF PORTFOLIO START
    public function deletepdf() {
        $userid = $this->session->userdata('aileenuser');
        //code for check user deactivate start
        $this->freelancer_apply_deactivate_check();
        //code for check user deactivate end

        $contition_array = array('user_id' => $userid);
        $free_reg_data = $this->common->select_data_by_condition('freelancer_post_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
        $freeportfolio = $free_reg_data[0]['freelancer_post_portfolio_attachment'];

        if ($freeportfolio != '') {
            $free_pdf_path = 'uploads/freelancer_post_portfolio/main';
            $free_pdf = $free_pdf_path . $freeportfolio;
            if (isset($free_pdf)) {
                unlink($free_pdf);
            }
        }

        $data = array(
            'freelancer_post_portfolio_attachment' => ''
        );

        $update = $this->common->update_data($data, 'freelancer_post_reg', 'user_id', $userid);
        echo 'ok';
    }

//FREELANCER_APPLY DELETE PDF OF PORTFOLIO END
//FREELANCER_HIRE SEARCH KEYWORD FOR AUTO COMPLETE START
    public function freelancer_hire_search_keyword($id = "") {

        $searchTerm = $_GET['term'];
        if (!empty($searchTerm)) {
            $contition_array = array('status' => 1, 'is_delete' => 0);
            $search_condition = "(category_name LIKE '" . trim($searchTerm) . "%')";
            $field = $this->common->select_data_by_search('category', $search_condition, $contition_array, $data = 'category_name', $sortby = 'category_name', $orderby = 'desc', $limit = '', $offset = '', $join_str5 = '', $groupby = 'category_name');

            $contition_array = array('status' => '1', 'is_delete' => '0', 'free_post_step' => 7);
            $search_condition = "(designation LIKE '" . trim($searchTerm) . "%')";
            $freelancer_postdata = $this->common->select_data_by_search('freelancer_post_reg', $search_condition, $contition_array, $data = 'designation', $sortby = 'designation', $orderby = 'desc', $limit = '', $offset = '', $join_str5 = '', $groupby = 'designation');

            $contition_array = array('status' => '1', 'type' => '1');
            $search_condition = "(skill LIKE '" . trim($searchTerm) . "%')";
            $skill = $this->common->select_data_by_search('skill', $search_condition, $contition_array, $data = 'skill', $sortby = 'skill', $orderby = 'desc', $limit = '', $offset = '', $join_str5 = '', $groupby = 'skill');
        }
        $unique = array_merge((array) $field, (array) $skill, (array) $freelancer_postdata);
        foreach ($unique as $key => $value) {
            foreach ($value as $ke => $val) {
                if ($val != "") {
                    $result[] = $val;
                }
            }
        }
        foreach ($result as $key => $value) {
            $result1[$key]['value'] = $value;
        }
        $result1 = array_values($result);
        echo json_encode($result1);
    }

//FREELANCER_HIRE SEARCH KEYWORD FOR AUTO COMPLETE END
//FREELANCER_HIRE SEARCH CITY FOR AUTO COMPLETE START
    public function freelancer_search_city($id = "") {
        $searchTerm = $_GET['term'];
        if (!empty($searchTerm)) {
            $contition_array = array('status' => '1', 'state_id !=' => '0');
            $search_condition = "(city_name LIKE '" . trim($searchTerm) . "%')";
            $location_list = $this->common->select_data_by_search('cities', $search_condition, $contition_array, $data = 'city_name', $sortby = 'city_name', $orderby = 'desc', $limit = '', $offset = '', $join_str5 = '', $groupby = 'city_name');
            foreach ($location_list as $key1 => $value) {
                foreach ($value as $ke1 => $val1) {
                    $location[] = $val1;
                }
            }
            foreach ($location as $key => $value) {
                $city_data[$key]['value'] = $value;
            }
            echo json_encode($city_data);
        }
    }

//FREELANCER_HIRE SEARCH CITY FOR AUTO COMPLETE END
//FREELANCER_APPLY SEARCH KEYWORD FOR AUTO COMPLETE START
    public function freelancer_apply_search_keyword($id = "") {
        $searchTerm = $_GET['term'];
        if (!empty($searchTerm)) {
            $contition_array = array('status' => '1', 'is_delete' => '0', 'free_post_step' => 7);
            $search_condition = "(designation LIKE '" . trim($searchTerm) . "%')";
            $freelancer_postdata = $this->common->select_data_by_search('freelancer_post_reg', $search_condition, $contition_array, $data = 'designation', $sortby = 'designation', $orderby = 'desc', $limit = '', $offset = '', $join_str5 = '', $groupby = 'designation');

            $contition_array = array('status' => '1', 'type' => '1');
            $search_condition = "(skill LIKE '" . trim($searchTerm) . "%')";
            $skill = $this->common->select_data_by_search('skill', $search_condition, $contition_array, $data = 'skill', $sortby = 'skill', $orderby = 'desc', $limit = '', $offset = '', $join_str5 = '', $groupby = 'skill');

            $contition_array = array('status' => '1');
            $search_condition = "(post_name LIKE '" . trim($searchTerm) . "%')";
            $results_post = $this->common->select_data_by_search('freelancer_post', $search_condition, $contition_array, $data = 'post_name', $sortby = 'post_name', $orderby = 'desc', $limit = '', $offset = '', $join_str5 = '', $groupby = 'post_name');
            //$this->data['results'] = $this->common->select_data_by_condition('freelancer_post', $contition_array, $data = 'post_name', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);

            $contition_array = array('status' => '1', 'is_delete' => '0');
            $search_condition = "(category_name LIKE '" . trim($searchTerm) . "%')";
            $field = $this->common->select_data_by_search('category', $search_condition, $contition_array, $data = 'category_name', $sortby = 'category_name', $orderby = 'desc', $limit = '', $offset = '', $join_str5 = '', $groupby = 'category_name');
        }
        $uni = array_merge((array) $skill, (array) $freelancer_postdata, (array) $field, (array) $results_post);
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
        $result1 = array_values($result);
        echo json_encode($result1);
//        $contition_array = array('status' => '1');
//        $location_list = $this->common->select_data_by_condition('cities', $contition_array, $data = 'city_name', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);
//        foreach ($location_list as $key1 => $value1) {
//            foreach ($value1 as $ke1 => $val1) {
//                $location[] = $val1;
//            }
//        }
//        foreach ($location as $key => $value) {
//            $loc[$key]['label'] = $value;
//            $loc[$key]['value'] = $value;
//        }
//        $this->data['city_data'] = array_values($loc);
//        $this->data['demo'] = array_values($result1);
    }

//FREELANCER_APPLY SEARCH KEYWORD FOR AUTO COMPLETE END
    public function get_skill($id = "") {

        //get search term
        $searchTerm = $_GET['term'];
        if (!empty($searchTerm)) {
            $contition_array = array('status' => 1, 'type' => 1);
            $search_condition = "(skill LIKE '" . trim($searchTerm) . "%')";
            $citylist = $this->common->select_data_by_search('skill', $search_condition, $contition_array, $data = 'skill as text', $sortby = 'skill', $orderby = 'desc', $limit = '', $offset = '', $join_str5 = '', $groupby = 'skill');
        }
        foreach ($citylist as $key => $value) {
            //   $citydata[$key]['id'] = $value['id'];
            $citydata[$key]['value'] = $value['text'];
        }

        $cdata = array_values($citydata);
        echo json_encode($cdata);
    }

//FREELANCER_APPLY OTHER DEGREE ADD START
    public function freelancer_other_degree() {
        $other_degree = $_POST['other_degree'];
        $other_stream = $_POST['other_stream'];

        $this->data['userid'] = $userid = $this->session->userdata('aileenuser');
        $contition_array = array('is_delete' => '0', 'degree_name' => $other_degree);
        $search_condition = "((status = '2' AND user_id = $userid) OR (status = '1'))";
        $userdata = $this->data['userdata'] = $this->common->select_data_by_search('degree', $search_condition, $contition_array, $data = '*', $sortby = 'degree_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');
        $count = count($userdata);

        if ($other_degree != NULL) {
            if ($count == 0) {
                $data = array(
                    'degree_name' => $other_degree,
                    'created_date' => date('Y-m-d h:i:s', time()),
                    'status' => 2,
                    'is_delete' => 0,
                    'is_other' => '1',
                    'user_id' => $userid
                );
                $insert_id = $this->common->insert_data_getid($data, 'degree');
                $degree_id = $insert_id;

                $contition_array = array('is_delete' => '0', 'status' => 2, 'stream_name' => $other_stream, 'user_id' => $userid);
                $stream_data = $this->common->select_data_by_condition('stream', $contition_array, $data = '*', $sortby = 'stream_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');
                $count1 = count($stream_data);

                if ($count1 == 0) {
                    $data = array(
                        'stream_name' => $other_stream,
                        'degree_id' => $degree_id,
                        'created_date' => date('Y-m-d h:i:s', time()),
                        'status' => 2,
                        'is_delete' => 0,
                        'is_other' => '1',
                        'user_id' => $userid
                    );
                    $insert_id = $this->common->insert_data_getid($data, 'stream');
                } else {
                    $data = array(
                        'stream_name' => $other_stream,
                        'degree_id' => $degree_id,
                        'created_date' => date('Y-m-d h:i:s', time()),
                        'status' => 2,
                        'is_delete' => 0,
                        'is_other' => '1',
                        'user_id' => $userid
                    );
                    $updatedata = $this->common->update_data($data, 'stream', 'stream_id', $stream_data[0]['stream_id']);
                }
                if ($insert_id || $updatedata) {

                    $contition_array = array('is_delete' => '0', 'degree_name !=' => "Other");
                    $search_condition = "((status = '2' AND user_id = $userid) OR (status = '1'))";
                    $degree = $this->data['degree'] = $this->common->select_data_by_search('degree', $search_condition, $contition_array, $data = '*', $sortby = 'degree_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');

                    if (count($degree) > 0) {

                        $select = '<option value="" Selected option disabled="">Select your Degree</option>';

                        foreach ($degree as $st) {

                            $select .= '<option value="' . $st['degree_id'] . '"';
                            if ($st['degree_name'] == $other_degree) {
                                $select .= 'selected';
                            }
                            $select .= '>' . $st['degree_name'] . '</option>';
                        }
                    }
//For Getting Other at end
                    $contition_array = array('is_delete' => '0', 'status' => 1, 'degree_name' => "Other");
                    $degree_otherdata = $this->common->select_data_by_condition('degree', $contition_array, $data = '*', $sortby = 'degree_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');

                    $select .= '<option value="' . $degree_otherdata[0]['degree_id'] . '">' . $degree_otherdata[0]['degree_name'] . '</option>';

                    //for getting selected stream data start
                    $contition_array = array('is_delete' => '0', 'degree_id' => $degree_id);
                    $search_condition = "((status = '2' AND user_id = $userid) OR (status = '1'))";
                    $stream = $this->data['stream'] = $this->common->select_data_by_search('stream', $search_condition, $contition_array, $data = '*', $sortby = 'stream_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');

                    $select2 = '<option value="" Selected option disabled="">Select your Stream</option>';
                    $select2 .= '<option value="' . $stream[0]['stream_id'] . '"';
                    if ($stream[0]['stream_name'] == $other_stream) {
                        $select2 .= 'selected';
                    }
                    $select2 .= '>' . $stream[0]['stream_name'] . '</option>';
                    //for getting selected stream data End         
                }
            } else {
                $select .= 0;
            }
        } else {
            $select .= 1;
        }

        echo json_encode(array(
            "select" => $select,
            // "select1" => $select1,
            "select2" => $select2,
        ));
    }

//FREELANCER_APPLY OTHER DEGREE ADD START
//FREELANCER_APPLY OTHER STREAM START
    public function freelancer_other_stream() {
        $other_stream = $_POST['other_stream'];
        $this->data['userid'] = $userid = $this->session->userdata('aileenuser');

        $contition_array = array('is_delete' => '0', 'stream_name' => $other_stream);
        $search_condition = "((status = '2' AND user_id = $userid) OR (status = '1'))";
        $userdata = $this->data['userdata'] = $this->common->select_data_by_search('stream', $search_condition, $contition_array, $data = '*', $sortby = 'stream_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');
        $count = count($userdata);

        if ($other_stream != NULL) {
            if ($count == 0) {
                $data = array(
                    'stream_name' => $other_stream,
                    'created_date' => date('Y-m-d h:i:s', time()),
                    'status' => 2,
                    'is_delete' => 0,
                    'is_other' => '1',
                    'user_id' => $userid
                );
                $insert_id = $this->common->insert_data_getid($data, 'stream');


                if ($insert_id) {

                    $contition_array = array('is_delete' => '0', 'stream_name !=' => "Other");
                    $search_condition = "((status = '2' AND user_id = $userid) OR (status = '1'))";
                    $stream = $this->data['stream'] = $this->common->select_data_by_search('stream', $search_condition, $contition_array, $data = '*', $sortby = 'stream_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');

                    if (count($stream) > 0) {
                        $select = '<option value="" selected option disabled="">Select your Stream</option>';

                        foreach ($stream as $st) {

                            $select .= '<option value="' . $st['stream_id'] . '"';
                            if ($st['stream_name'] == $other_stream) {
                                $select .= 'selected';
                            }
                            $select .= '>' . $st['stream_name'] . '</option>';
                        }
                    }
//For Getting Other at end
                    $contition_array = array('is_delete' => '0', 'status' => 1, 'stream_name' => "Other");
                    $stream_otherdata = $this->common->select_data_by_condition('stream', $contition_array, $data = '*', $sortby = 'stream_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');

                    $select .= '<option value="' . $stream_otherdata[0]['stream_id'] . '">' . $stream_otherdata[0]['stream_name'] . '</option>';
                }
            } else {
                $select .= 0;
            }
        } else {
            $select .= 1;
        }

        echo $select;
    }

//FREELANCER_APPLY OTHER STREAM END
//FREELANCER_APPLY  OTHER FIELD START
    public function freelancer_other_field() {

        $other_field = $_POST['other_field'];

        $this->data['userid'] = $userid = $this->session->userdata('aileenuser');
        $contition_array = array('is_delete' => '0', 'category_name' => $other_field);
        $search_condition = "((status = '2' AND user_id = $userid) OR (status = '1'))";
        $userdata = $this->data['userdata'] = $this->common->select_data_by_search('category', $search_condition, $contition_array, $data = '*', $sortby = 'category_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');
        $count = count($userdata);
//        echo $count;die();

        if ($other_field != NULL) {
            if ($count == 0) {
                $data = array(
                    'category_name' => $other_field,
                    'created_date' => date('Y-m-d h:i:s', time()),
                    'status' => 2,
                    'is_delete' => 0,
                    'is_other' => '1',
                    'user_id' => $userid
                );
                $insert_id = $this->common->insert_data_getid($data, 'category');
                if ($insert_id) {
                    $contition_array = array('is_delete' => '0', 'category_name !=' => "Other");
                    $search_condition = "((status = '2' AND user_id = $userid) OR (status = '1'))";
                    $category = $this->data['category'] = $this->common->select_data_by_search('category', $search_condition, $contition_array, $data = '*', $sortby = 'category_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');

                    if (count($category) > 0) {
                        $select = '<option value="" selected option disabled>Select your field</option>';
                        foreach ($category as $st) {
                            $select .= '<option value="' . $st['category_id'] . '"';
                            if ($st['category_name'] == $other_field) {
                                $select .= 'selected';
                            }
                            $select .= '>' . $st['category_name'] . '</option>';
                        }
                    }
//For Getting Other at end
                    $contition_array = array('is_delete' => '0', 'status' => 1, 'category_name' => "Other");
                    $category_otherdata = $this->common->select_data_by_condition('category', $contition_array, $data = '*', $sortby = 'category_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');
                    $select .= '<option value="' . $category_otherdata[0]['category_id'] . '">' . $category_otherdata[0]['category_name'] . '</option>';
                }
            } else {
                $select .= 0;
            }
        } else {
            $select .= 1;
        }


        echo json_encode(array(
            "select" => $select,
        ));
    }

//FREELANCER_APPLY BOTH OTHER FIELD END
//FREELANCER_HIRE  OTHER FIELD START
    public function freelancer_hire_other_field() {

        $other_field = $_POST['other_field'];

        $this->data['userid'] = $userid = $this->session->userdata('aileenuser');
        $contition_array = array('is_delete' => '0', 'category_name' => $other_field);
        $search_condition = "((is_other = '2' AND user_id = $userid) OR (status = '1'))";
        $userdata = $this->data['userdata'] = $this->common->select_data_by_search('category', $search_condition, $contition_array, $data = '*', $sortby = 'category_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');
        $count = count($userdata);
//        echo $count;die();

        if ($other_field != NULL) {
            if ($count == 0) {
                $data = array(
                    'category_name' => $other_field,
                    'created_date' => date('Y-m-d h:i:s', time()),
                    'status' => 2,
                    'is_delete' => 0,
                    'is_other' => '2',
                    'user_id' => $userid
                );
                $insert_id = $this->common->insert_data_getid($data, 'category');
                if ($insert_id) {
                    $contition_array = array('is_delete' => '0', 'category_name !=' => "Other");
                    $search_condition = "((is_other = '2' AND user_id = $userid) OR (status = '1'))";
                    $category = $this->data['category'] = $this->common->select_data_by_search('category', $search_condition, $contition_array, $data = '*', $sortby = 'category_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');

                    if (count($category) > 0) {
                        $select = '<option value="" selected option disabled>Select your field</option>';
                        foreach ($category as $st) {
                            $select .= '<option value="' . $st['category_id'] . '"';
                            if ($st['category_name'] == $other_field) {
                                $select .= 'selected';
                            }
                            $select .= '>' . $st['category_name'] . '</option>';
                        }
                    }
//For Getting Other at end
                    $contition_array = array('is_delete' => '0', 'status' => 1, 'category_name' => "Other");
                    $category_otherdata = $this->common->select_data_by_condition('category', $contition_array, $data = '*', $sortby = 'category_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');
                    $select .= '<option value="' . $category_otherdata[0]['category_id'] . '">' . $category_otherdata[0]['category_name'] . '</option>';
                }
            } else {
                $select .= 0;
            }
        } else {
            $select .= 1;
        }


        echo json_encode(array(
            "select" => $select,
        ));
    }

//FREELANCER_APPLY BOTH OTHER END
    public function live_post($userid = '', $postid = '', $posttitle = '') {
        $segment3 = explode('-', $this->uri->segment(3));
        $slugdata = array_reverse($segment3);
        $postid = $slugdata[0];
        $this->data['recliveid'] = $userid = $slugdata[1];
        echo $userid;

        $contition_array = array('is_delete' => '0', 'user_id' => $userid, 'status' => '1', 'free_hire_step' => 3);
        $data = 'username,fullname,designation,freelancer_hire_user_image,user_id,profile_background';
        $hire_data = $this->data['freelancr_user_data'] = $this->common->select_data_by_condition('freelancer_hire_reg', $contition_array, $data, $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str, $groupby = '');

        $join_str[0]['table'] = 'freelancer_hire_reg';
        $join_str[0]['join_table_id'] = 'freelancer_hire_reg.user_id';
        $join_str[0]['from_table_id'] = 'freelancer_post.user_id';
        $join_str[0]['join_type'] = '';

        $contition_array = array('post_id' => $postid, 'freelancer_post.is_delete' => '0', 'freelancer_hire_reg.user_id' => $userid, 'freelancer_hire_reg.status' => '1', 'freelancer_hire_reg.free_hire_step' => 3);
        $data = 'freelancer_post.post_id,freelancer_post.post_name,freelancer_post.post_field_req,freelancer_post.post_est_time,freelancer_post.post_skill,freelancer_post.post_other_skill,freelancer_post.post_rate,freelancer_post.post_last_date,freelancer_post.post_description,freelancer_post.user_id,freelancer_post.created_date,freelancer_post.post_currency,freelancer_post.post_rating_type,freelancer_post.post_exp_month,freelancer_post.post_exp_year,freelancer_hire_reg.username,freelancer_hire_reg.fullname,freelancer_hire_reg.designation,freelancer_hire_reg.freelancer_hire_user_image,freelancer_hire_reg.country,freelancer_hire_reg.city';
        $this->data['postdata'] = $this->common->select_data_by_condition('freelancer_post', $contition_array, $data, $sortby = 'freelancer_post.post_id', $orderby = 'desc', $limit = '', $offset = '', $join_str, $groupby = '');

        //  echo "<pre>"; print_r($this->data['postdata']);die();
        // $contition_array = array('post_id !=' => $postid, 'status' => 1, 'rec_post.is_delete' => '0', 'post_name' => $this->data['postdata'][0]['post_name']);
        $contition_array = array('post_id !=' => $postid, 'freelancer_post.is_delete' => '0', 'freelancer_hire_reg.user_id' => $userid, 'freelancer_hire_reg.status' => '1', 'freelancer_hire_reg.free_hire_step' => 3, 'freelancer_post.post_name' => $this->data['postdata'][0]['post_name']);
        $this->data['recommandedpost'] = $this->common->select_data_by_condition('freelancer_post', $contition_array, $data, $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str, $groupby = '');

      //   echo "<pre>"; print_r($this->data['recommandedpost']);die();
        $join_str = array(array(
                    'join_type' => '',
                    'table' => 'freelancer_apply',
                    'join_table_id' => 'freelancer_post_reg.user_id',
                    'from_table_id' => 'freelancer_apply.user_id'),
                array(
                    'join_type' => '',
                    'table' => 'save',
                    'join_table_id' => 'freelancer_post_reg.user_id',
                    'from_table_id' => 'save.to_id')
            );

            $contition_array = array('freelancer_apply.post_id' => $postid, 'freelancer_apply.is_delete' => 0,'save.from_id' => $userid,  'save.save_type' => '2', 'save.status' => '0');
            $data = 'freelancer_post_reg.user_id, freelancer_post_reg.freelancer_apply_slug, freelancer_post_reg.freelancer_post_fullname, freelancer_post_reg.freelancer_post_username, freelancer_post_reg.designation, freelancer_post_reg.freelancer_post_area, freelancer_post_reg.freelancer_post_otherskill, freelancer_post_reg.freelancer_post_city, freelancer_post_reg.freelancer_post_skill_description, freelancer_post_reg.freelancer_post_work_hour, freelancer_post_reg.freelancer_post_hourly, freelancer_post_reg.freelancer_post_ratestate, freelancer_post_reg.freelancer_post_fixed_rate, freelancer_post_reg.freelancer_post_exp_year, freelancer_post_reg.freelancer_post_exp_month, freelancer_post_reg.freelancer_post_user_image';
            $shortlist = $this->data['shortlist'] = $this->common->select_data_by_condition('freelancer_post_reg', $contition_array, $data, $sortby = '', $orderby = 'desc', $limit = '', $offset = '', $join_str, $groupby = '');

          //  echo "<pre>"; print_r($shortlist);die();
                
//        $join_str[0]['table'] = 'freelancer_apply';
//        $join_str[0]['join_table_id'] = 'freelancer_apply.user_id';
//        $join_str[0]['from_table_id'] = 'freelancer_post_reg.user_id';
//        $join_str[0]['join_type'] = '';
//
//
//        $contition_array = array('freelancer_apply.post_id' => $postid, 'freelancer_apply.is_delete' => 0);
//        $data = 'freelancer_post_reg.user_id';
//        $applydata = $this->data['applydata'] = $this->common->select_data_by_condition('freelancer_post_reg', $contition_array, $data, $sortby = '', $orderby = 'desc', $limit = '', $offset = '', $join_str, $groupby = '');
//       
//        foreach ($applydata as $applyid) {
//            $join_str[0]['table'] = 'save';
//            $join_str[0]['join_table_id'] = 'save.to_id';
//            $join_str[0]['from_table_id'] = 'freelancer_post_reg.user_id';
//            $join_str[0]['join_type'] = '';
//
//
//            $contition_array = array('save.from_id' => $userid, 'save.to_id' => $applyid['user_id'], 'save.save_type' => '2', 'save.status' => '0');
//            $data = 'freelancer_post_reg.user_id, freelancer_post_reg.freelancer_apply_slug, freelancer_post_reg.freelancer_post_fullname, freelancer_post_reg.freelancer_post_username, freelancer_post_reg.designation, freelancer_post_reg.freelancer_post_area, freelancer_post_reg.freelancer_post_otherskill, freelancer_post_reg.freelancer_post_city, freelancer_post_reg.freelancer_post_skill_description, freelancer_post_reg.freelancer_post_work_hour, freelancer_post_reg.freelancer_post_hourly, freelancer_post_reg.freelancer_post_ratestate, freelancer_post_reg.freelancer_post_fixed_rate, freelancer_post_reg.freelancer_post_exp_year, freelancer_post_reg.freelancer_post_exp_month, freelancer_post_reg.freelancer_post_user_image';
//            $shortlist[] = $this->data['shortlist'] = $this->common->select_data_by_condition('freelancer_post_reg', $contition_array, $data, $sortby = '', $orderby = 'desc', $limit = '', $offset = '', $join_str, $groupby = '');
//        }
//$shortlist = array_reduce($shortlist, 'array_merge', array());



        if ($this->session->userdata('aileenuser')) {
            $this->load->view('freelancer/freelancer_hire/project_live', $this->data);
        } else {
            $this->load->view('freelancer/freelancer_hire/project_live_login', $this->data);
        }
    }

    public function apply_email($notid) {

        $userid = $this->session->userdata('aileenuser');
        $applydata = $this->common->select_data_by_id('freelancer_post_reg', 'user_id', $userid, $data = 'freelancer_post_fullname,freelancer_post_username,freelancer_post_user_image', $join_str = array());
        $hiremail = $this->common->select_data_by_id('freelancer_hire_reg', 'user_id', $notid, $data = 'email', $join_str = array());

        $email_html = '';
        $email_html .= '<table width="100%" cellpadding="0" cellspacing="0">
					<tr>
                                            <td style="padding:5px;">';
        if ($applydata[0]['freelancer_post_user_image'] == '') {
            $fname = $applydata[0]['freelancer_post_fullname'];
            $lname = $applydata[0]['freelancer_post_username'];
            $sub_fname = substr($fname, 0, 1);
            $sub_lname = substr($lname, 0, 1);
            $email_html .= '<div class="post-img-div">' . ucfirst(strtolower($sub_fname)) . ucfirst(strtolower($sub_lname)) . '</div></td>';
        } else {
            $email_html .= '<img src="' . FREE_POST_PROFILE_THUMB_UPLOAD_URL . $applydata[0]['freelancer_post_user_image'] . '" width="60" height="60"></td>';
        }
        $email_html .= '<td style="padding:5px;">
						<p>Freelancer <b>' . $applydata[0]['freelancer_post_fullname'] . " " . $applydata[0]['freelancer_post_username'] . '</b> Applied on your Project.</p>
						<span style="display:block; font-size:11px; padding-top: 1px; color: #646464;">' . date('j F') . ' at ' . date('H:i') . '</span>
                                            </td>
                                            <td style="padding:5px;">
                                                <p><a class="btn" href="' . BASEURL . 'freelancer-work/freelancer-details/' . $userid . '?page=freelancer_hire">view</a></p>
                                            </td>
					</tr>
                                    </table>';
        $subject = $applydata[0]['freelancer_post_fullname'] . " " . $applydata[0]['freelancer_post_username'] . ' Applied on your Project.';

        $send_email = $this->email_model->send_email($subject = $subject, $templ = $email_html, $to_email = $hiremail[0]['email']);
        // mail end  
    }

    public function email_view() {
        $userid = 140;
        $notid = 103;
        $postuser = $this->common->select_data_by_id('freelancer_post_reg', 'user_id', $userid, $data = 'freelancer_post_fullname,freelancer_post_username,freelancer_post_user_image', $join_str = array());

        $hireuser = $this->common->select_data_by_id('freelancer_hire_reg', 'user_id', $notid, $data = 'email', $join_str = array());

        // apply mail start
        $email_html = '';
        $email_html .= '<table width="100%" cellpadding="0" cellspacing="0">
					<tr>
                                            <td style="padding:5px;">';
        if ($postuser[0]['freelancer_post_user_image'] == '') {
            $fname = $postuser[0]['freelancer_post_fullname'];
            $lname = $postuser[0]['freelancer_post_username'];
            $sub_fname = substr($fname, 0, 1);
            $sub_lname = substr($lname, 0, 1);
            $email_html .= '<div class="post-img-div">' . ucfirst(strtolower($sub_fname)) . ucfirst(strtolower($sub_lname)) . '</div></td>';
        } else {
            $email_html .= '<img src="' . FREE_POST_PROFILE_THUMB_UPLOAD_URL . $postuser[0]['freelancer_post_user_image'] . '" width="60" height="60"></td>';
        }
        $email_html .= '<td style="padding:5px;">
						<p>Freelancer <b>' . $postuser[0]['freelancer_post_fullname'] . " " . $postuser[0]['freelancer_post_username'] . '</b> Applied on your Project.</p>
						<span style="display:block; font-size:11px; padding-top: 1px; color: #646464;">' . date('j F') . ' at ' . date('H:i') . '</span>
                                            </td>
                                            <td style="padding:5px;">
                                                <p><a class="btn" href="' . BASEURL . 'freelancer-work/freelancer-details/' . $userid . '?page=freelancer_hire">view</a></p>
                                            </td>
					</tr>
                                    </table>';

        $this->data['templ'] = $email_html;
        // $subject = $postuser[0]['freelancer_post_fullname'] . " " . $postuser[0]['freelancer_post_username'] . ' Applied on your Project.';
        //$send_email = $this->email_model->send_email($subject = $subject, $templ = $email_html, $to_email = $hireuser[0]['email']);
        // mail end
        //  $applypost = 'Applied';
        $this->load->view('email_view', $this->data);
    }

}
