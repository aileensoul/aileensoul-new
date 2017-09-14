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

        include ('include.php');
        $this->data['aileenuser_id'] = $this->session->userdata('aileenuser');
    }

    public function index() {  //echo "falguni"; die();
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
                redirect('freelancer/freelancer_post_basic_information', refresh);
                // $this->load->view('freelancer/freelancer_post/freelancer_post_basic_information',$this->data);
            }
        }
    }

    //freelancer workexp first  info page controller start

    public function freelancer_post_basic_information() {
        $userid = $this->session->userdata('aileenuser');
        //if user deactive profile then redirect to freelancer/freelancer_post/freelancer_post_basic_information  start
        $contition_array = array('user_id' => $userid, 'status' => '0', 'is_delete' => '0');

        $freelancerpost_deactive = $this->data['freelancerpost_deactive'] = $this->common->select_data_by_condition('freelancer_post_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);

        if ($freelancerpost_deactive) {
            redirect('freelancer/freelancer_post/freelancer_post_basic_information');
        }
        //if user deactive profile then redirect to freelancer/freelancer_post/freelancer_post_basic_information  End

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

    public function hire_designation() {

        $userid = $this->session->userdata('aileenuser');


        $data = array(
            'designation' => trim($this->input->post('designation')),
            'modified_date' => date('Y-m-d', time())
        );
        //   echo "<pre>"; print_r($data);die();
        $updatdata = $this->common->update_data($data, 'freelancer_hire_reg', 'user_id', $userid);

        if ($updatdata) {

            if ($this->input->post('hitext') == 1) {
                redirect('freelancer-hire/employer-details', refresh);
            } elseif ($this->input->post('hitext') == 2) {
                redirect('freelancer-hire/projects', refresh);
            } elseif ($this->input->post('hitext') == 3) {
                redirect('freelancer-hire/freelancer-save', refresh);
            }
        } else {

            $this->session->flashdata('error', 'Your data not inserted');
            redirect('freelancer-hire/home', refresh);
        }
    }

//designation end


    public function freelancer_post_basic_information_insert() {
        $userid = $this->session->userdata('aileenuser');


        $this->form_validation->set_rules('firstname', 'Full Name', 'required');
        $this->form_validation->set_rules('lastname', 'Last Name', 'required');
        //echo "123";die();

        $this->form_validation->set_rules('email', 'EmailId', 'required|valid_email');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('freelancer/freelancer_post/freelancer_post_basic_information');
        } else {

            $contition_array = array('user_id' => $userid, 'is_delete' => '0', 'status' => '1');
            $userdata = $this->common->select_data_by_condition('freelancer_post_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
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

                //  echo "<pre>";print_r($data);die();

                $updatedata = $this->common->update_data($data, 'freelancer_post_reg', 'user_id', $userid);

                if ($updatedata) {

                    $this->session->set_flashdata('success', 'Basic information updated successfully');
                    redirect('freelancer-work/address-information', refresh);
                } else {

                    $this->session->flashdata('error', 'Your data not inserted');
                    redirect('freelancer-work/basic-information', refresh);
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
                    redirect('freelancer-work/address-information', refresh);
                } else {
                    $this->session->flashdata('error', 'Sorry!! Your data not inserted');
                    redirect('freelancer-work/basic-information', refresh);
                }
            }
        }
    }

    //freelancer workexp first  info page controller End
    // freelancer_hire profile slug start

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

    // freelancer_hire profile slug end

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

//check email avilibity start
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

// check email end
//freelancer address page controller Start
    public function freelancer_post_address_information() {
        $userid = $this->session->userdata('aileenuser');
        //IF USER DEACTIVATE PROFILE THEN REDIRECT TO freelancer/freelancer_post/freelancer_post_basic_information START
        $contition_array = array('user_id' => $userid, 'status' => '0', 'is_delete' => '0');
        $freelancerpost_deactive = $this->data['freelancerpost_deactive'] = $this->common->select_data_by_condition('freelancer_post_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);
        if ($freelancerpost_deactive) {
            redirect('freelancer/freelancer_post/freelancer_post_basic_information');
        }
        //IF USER DEACTIVATE PROFILE THEN REDIRECT TO freelancer/freelancer_post/freelancer_post_basic_information END
        // code for display page start
        $this->freelancer_apply_check();
        // code for display page end
        $contition_array = array('status' => 1);
        $this->data['countries'] = $this->common->select_data_by_condition('countries', $contition_array, $data = '*', $sortby = 'country_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');
        //USER DATA FETCH
        $contition_array = array('user_id' => $userid, 'is_delete' => '0', 'status' => '1');
        $userdata = $this->common->select_data_by_condition('freelancer_post_reg', $contition_array, $data = 'freelancer_post_country,freelancer_post_state,freelancer_post_city,freelancer_post_pincode,freelancer_post_address,free_post_step', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
        //FOR GETTING STATE DATA
        $contition_array = array('status' => 1, 'country_id' => $userdata[0]['freelancer_post_country']);
        $this->data['states'] = $this->common->select_data_by_condition('states', $contition_array, $data = '*', $sortby = 'state_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        //FOR GETTING CITY DATA 
        $contition_array = array('status' => 1, 'state_id' => $userdata[0]['freelancer_post_state']);
        $this->data['cities'] = $this->common->select_data_by_condition('cities', $contition_array, $data = '*', $sortby = 'city_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');
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

    public function freelancer_post_address_information_insert() {

        $userid = $this->session->userdata('aileenuser');

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
                    redirect('freelancer-work/professional-information', refresh);
                } else {
                    $this->session->flashdata('error', 'Your data not inserted');
                    redirect('freelancer-work/address-information', refresh);
                }
            }
        }
    }

//freelancer address page controller End
//freelancer professional page controller Start
    public function freelancer_post_professional_information() {
        $userid = $this->session->userdata('aileenuser');
//if user deactive profile then redirect to freelancer/freelancer_post/freelancer_post_basic_information  start
        $contition_array = array('user_id' => $userid, 'status' => '0', 'is_delete' => '0');
        $freelancerpost_deactive = $this->data['freelancerpost_deactive'] = $this->common->select_data_by_condition('freelancer_post_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);

        if ($freelancerpost_deactive) {
            redirect('freelancer/freelancer_post/freelancer_post_basic_information');
        }
        //if user deactive profile then redirect to freelancer/freelancer_post/freelancer_post_basic_information  End
// code for display page start
        $this->freelancer_apply_check();
        // code for display page end

        $contition_array = array('user_id' => $userid, 'is_delete' => '0', 'status' => '1');
        $userdata = $this->data['postdata'] = $this->common->select_data_by_condition('freelancer_post_reg', $contition_array, $data = 'freelancer_post_field,freelancer_post_area,freelancer_post_otherskill,freelancer_post_skill_description,freelancer_post_exp_year,freelancer_post_exp_month,free_post_step,user_id', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');


//        $skildata = explode(',', $this->data['postdata'][0]['freelancer_post_area']);
//        $this->data['selectdata'] = $skildata;
        //Retrieve skill data Start

        $skill_know = explode(',', $userdata[0]['freelancer_post_area']);
        // echo $language_know;die();
        foreach ($skill_know as $sk) {
            $contition_array = array('skill_id' => $sk, 'status' => 1);
            $skilldata = $this->common->select_data_by_condition('skill', $contition_array, $data = 'skill_id,skill', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str5 = '', $groupby = '');
            //echo "<pre>";print_r(  $languagedata);
            $detailes[] = $skilldata[0]['skill'];
        }

        $this->data['skill_2'] = implode(',', $detailes);
        // echo "<pre>"; print_r($this->data['skill_2']);die();
        //Retrieve skill data End

        $contition_array = array('status' => 1);
        $this->data['category'] = $this->common->select_data_by_condition('category', $contition_array, $data = '*', $sortby = 'category_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');


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

    public function freelancer_post_professional_information_insert() {

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
                    //  die();
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
                    redirect('freelancer-work/rate', refresh);
                } else {
                    $this->session->flashdata('error', 'Your data not inserted');
                    redirect('freelancer-work/professional-information', refresh);
                }
            }
        }
    }

//freelancer professional page controller End
//freelancer rate page controller Start 
    public function freelancer_post_rate() {
        $userid = $this->session->userdata('aileenuser');
//if user deactive profile then redirect to freelancer/freelancer_post/freelancer_post_basic_information  start
        $contition_array = array('user_id' => $userid, 'status' => '0', 'is_delete' => '0');

        $freelancerpost_deactive = $this->data['freelancerpost_deactive'] = $this->common->select_data_by_condition('freelancer_post_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);

        if ($freelancerpost_deactive) {
            redirect('freelancer/freelancer_post/freelancer_post_basic_information');
        }
        //if user deactive profile then redirect to freelancer/freelancer_post/freelancer_post_basic_information  End
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

    public function freelancer_post_rate_insert() {

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

            //echo "<pre>";print_r( $data);die();
            $updatdata = $this->common->update_data($data, 'freelancer_post_reg', 'user_id', $userid);

            if ($updatdata) {
                $this->session->set_flashdata('success', 'Rate information updated successfully');
                redirect('freelancer-work/avability', refresh);
            } else {
                $this->session->flashdata('error', 'Your data not inserted');
                redirect('freelancer-work/rate', refresh);
            }
            //}
        }
    }

//freelancer rate page controller End
//freelancer avability page controller Start
    public function freelancer_post_avability() {
        $userid = $this->session->userdata('aileenuser');
//if user deactive profile then redirect to freelancer/freelancer_post/freelancer_post_basic_information  start
        $contition_array = array('user_id' => $userid, 'status' => '0', 'is_delete' => '0');
        $freelancerpost_deactive = $this->data['freelancerpost_deactive'] = $this->common->select_data_by_condition('freelancer_post_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);

        if ($freelancerpost_deactive) {
            redirect('freelancer/freelancer_post/freelancer_post_basic_information');
        }
        //if user deactive profile then redirect to freelancer/freelancer_post/freelancer_post_basic_information  End
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

    public function freelancer_post_avability_insert() {

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
                redirect('freelancer-work/education', refresh);
            } else {
                $this->session->flashdata('error', 'Your data not inserted');
                redirect('freelancer-work/avability', refresh);
            }
            //}
        }
    }

//freelancer avability page controller End
//freelancer education page controller Start
    public function freelancer_post_education() {
        $userid = $this->session->userdata('aileenuser');

//if user deactive profile then redirect to freelancer/freelancer_post/freelancer_post_basic_information  start
        $contition_array = array('user_id' => $userid, 'status' => '0', 'is_delete' => '0');
        $freelancerpost_deactive = $this->data['freelancerpost_deactive'] = $this->common->select_data_by_condition('freelancer_post_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);
        if ($freelancerpost_deactive) {
            redirect('freelancer/freelancer_post/freelancer_post_basic_information');
        }
        //if user deactive profile then redirect to freelancer/freelancer_post/freelancer_post_basic_information  End
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
//        $contition_array = array('status' => 1);
//        $this->data['degree_data'] = $this->common->select_data_by_condition('degree', $contition_array, $data = '*', $sortby = 'degree_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');
        //for getting stream data
        //For getting all Stream Strat
        $contition_array = array('is_delete' => '0', 'stream_name !=' => "Other");
        $search_condition = "((status = '2' AND user_id = $userid) OR (status = '1'))";
        $stream_alldata = $this->data['stream_alldata'] = $this->common->select_data_by_search('stream', $search_condition, $contition_array, $data = '*', $sortby = 'stream_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = 'stream_name');

        $contition_array = array('status' => 1, 'is_delete' => 0, 'stream_name' => "Other");
        $stream_otherdata = $this->data['stream_otherdata'] = $this->common->select_data_by_condition('stream', $contition_array, $data = '*', $sortby = 'stream_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = 'stream_name');
        //For getting all Stream End
//        $contition_array = array('status' => 1);
//        $this->data['stream_data'] = $this->common->select_data_by_condition('stream', $contition_array, $data = '*', $sortby = 'stream_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');
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

    //add other_university into database start 
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

    public function freelancer_post_education_insert() {

        $userid = $this->session->userdata('aileenuser');




        // if ($this->input->post('next')) {
        //     $this->form_validation->set_rules('degree', 'Degree', 'required');
        //     $this->form_validation->set_rules('stream', 'Stream', 'required');
        //     $this->form_validation->set_rules('university', 'University', 'required');
        //     $this->form_validation->set_rules('college', 'Collage', 'required');
        //     $this->form_validation->set_rules('percentage', 'Percentage', 'required');
        //     $this->form_validation->set_rules('passingyear', 'Passing Year', 'required');
        //     if ($this->form_validation->run() == FALSE) {
        //         $this->load->view('freelancer/freelancer_post/freelancer_post_education');
        //     } else {

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
            redirect('freelancer-work/portfolio', refresh);
        } else {
            $this->session->flashdata('error', 'Your data not inserted');
            redirect('freelancer-work/education', refresh);
        }
    }

//freelancer education page controller End
//freelancer Portfolio page controller Start
    public function freelancer_post_portfolio() {
        $userid = $this->session->userdata('aileenuser');

//if user deactive profile then redirect to freelancer/freelancer_post/freelancer_post_basic_information  start
        $contition_array = array('user_id' => $userid, 'status' => '0', 'is_delete' => '0');

        $freelancerpost_deactive = $this->data['freelancerpost_deactive'] = $this->common->select_data_by_condition('freelancer_post_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);

        if ($freelancerpost_deactive) {
            redirect('freelancer/freelancer_post/freelancer_post_basic_information');
        }
        //if user deactive profile then redirect to freelancer/freelancer_post/freelancer_post_basic_information  End
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

    public function freelancer_post_portfolio_insert() {
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

        // echo "<pre>"; print_r($config); die();
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
            // echo "hi"; die();
            // $uploadData = $this->upload->data();
            // $picture = $uploadData['file_name'];

            $response['result'] = $this->upload->data();
            // echo "<pre>"; print_r($response['result']); die();
            $art_post_thumb['image_library'] = 'gd2';
            $art_post_thumb['source_image'] = $this->config->item('free_portfolio_main_upload_path') . $response['result']['file_name'];
            $art_post_thumb['new_image'] = $this->config->item('free_portfolio_thumb_upload_path') . $response['result']['file_name'];
            $art_post_thumb['create_thumb'] = TRUE;
            $art_post_thumb['maintain_ratio'] = TRUE;
            $art_post_thumb['thumb_marker'] = '';
            $art_post_thumb['width'] = $this->config->item('art_portfolio_thumb_width');
            //$product_thumb[$i]['height'] = $this->config->item('product_thumb_height');
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

        //echo "<pre>"; print_r($dataimage); die();
        //if ($dataimage) {
        $data = array(
            'freelancer_post_portfolio_attachment' => $dataimage,
            'freelancer_post_portfolio' => $portfolio,
            'modify_date' => date('Y-m-d', time()),
            'free_post_step' => 7
        );


        $updatdata = $this->common->update_data($data, 'freelancer_post_reg', 'user_id', $userid);
        // } 
        //    if ($portfolio || $portfolio == '') {
        //     $data = array(
        //         //'art_bestofmine' => $picture,
        //         'freelancer_post_portfolio' => $portfolio,
        //         'modify_date' => date('Y-m-d', time()),
        //         'free_post_step' => 7
        //     );
        //     $updatdata = $this->common->update_data($data, 'freelancer_post_reg', 'user_id', $userid);
        // }
//echo "<pre>"; print_r($updatdata); die();
    }

//freelancer Portfolio page controller End

    public function freelancer_hire_post($id = "") {
        $id = $category = $this->db->get_where('freelancer_hire_reg', array('freelancer_hire_slug' => $id, 'status' => 1))->row()->user_id;
        $userid = $this->session->userdata('aileenuser');
//if user deactive profile then redirect to freelancer_hire/freelancer_hire/freelancer_hire_basic_info  start
        $contition_array = array('user_id' => $userid, 'status' => '0', 'is_delete' => '0');
        $freelancerhire_deactive = $this->data['freelancerhire_deactive'] = $this->common->select_data_by_condition('freelancer_hire_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);
        if ($freelancerhire_deactive) {
            redirect('freelancer_hire/freelancer_hire/freelancer_hire_basic_info');
        }
//if user deactive profile then redirect to freelancer_hire/freelancer_hire/freelancer_hire_basic_info  End
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

    public function ajax_freelancer_hire_post($id = "", $retur = "") {

        //   echo $retur;die();
        $userid = $this->session->userdata('aileenuser');
        // echo $userid; die();
        $perpage = 5;
        $page = 1;
        if (!empty($_GET["page"]) && $_GET["page"] != 'undefined') {
            $page = $_GET["page"];
        }

        $start = ($page - 1) * $perpage;
        if ($start < 0)
            $start = 0;

        if ($id == 'null') {

            // echo $userid; die();
            $join_str[0]['table'] = 'freelancer_hire_reg';
            $join_str[0]['join_table_id'] = 'freelancer_hire_reg.user_id';
            $join_str[0]['from_table_id'] = 'freelancer_post.user_id';
            $join_str[0]['join_type'] = '';

            $limit = $perpage;
            $offset = $start;

            $contition_array = array('freelancer_post.is_delete' => '0', 'freelancer_hire_reg.user_id' => $userid, 'freelancer_hire_reg.status' => '1', 'freelancer_hire_reg.free_hire_step' => 3);
            $data = 'freelancer_post.post_id,freelancer_post.post_name,freelancer_post.post_field_req,freelancer_post.post_est_time,freelancer_post.post_skill,freelancer_post.post_other_skill,freelancer_post.post_rate,freelancer_post.post_last_date,freelancer_post.post_description,freelancer_post.user_id,freelancer_post.created_date,freelancer_post.post_currency,freelancer_post.post_rating_type,freelancer_post.country,freelancer_post.city,freelancer_post.post_exp_month,freelancer_post.post_exp_year,freelancer_hire_reg.username,freelancer_hire_reg.fullname,freelancer_hire_reg.designation,freelancer_hire_reg.freelancer_hire_user_image';
            $postdata = $this->common->select_data_by_condition('freelancer_post', $contition_array, $data, $sortby = 'freelancer_post.post_id', $orderby = 'desc', $limit = '', $offset = '', $join_str, $groupby = '');
            $postdata1 = $this->common->select_data_by_condition('freelancer_post', $contition_array, $data, $sortby = 'freelancer_post.post_id', $orderby = 'desc', $limit, $offset = '', $join_str, $groupby = '');
            //echo "<pre>"; print_r($postdata1);die();
        } else {
            $id = $category = $this->db->get_where('freelancer_hire_reg', array('freelancer_hire_slug' => $id, 'status' => 1))->row()->user_id;
            // echo "3333";
            $userid = $id;
            // echo $userid; die();
            $join_str[0]['table'] = 'freelancer_hire_reg';
            $join_str[0]['join_table_id'] = 'freelancer_hire_reg.user_id';
            $join_str[0]['from_table_id'] = 'freelancer_post.user_id';
            $join_str[0]['join_type'] = '';

            $limit = $perpage;
            $offset = $start;

            $contition_array = array('freelancer_post.is_delete' => '0', 'freelancer_hire_reg.user_id' => $userid, 'freelancer_hire_reg.status' => '1', 'freelancer_hire_reg.free_hire_step' => 3);
            $data = 'freelancer_post.post_id,freelancer_post.post_name,freelancer_post.post_field_req,freelancer_post.post_est_time,freelancer_post.post_skill,freelancer_post.post_other_skill,freelancer_post.post_rate,freelancer_post.post_last_date,freelancer_post.post_description,freelancer_post.user_id,freelancer_post.created_date,freelancer_post.post_currency,freelancer_post.post_rating_type,freelancer_post.country,freelancer_post.city,freelancer_post.post_exp_month,freelancer_post.post_exp_year,freelancer_hire_reg.username,freelancer_hire_reg.fullname,freelancer_hire_reg.designation,freelancer_hire_reg.freelancer_hire_user_image';
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

                $return_html .= $this->lang->line("created_date");
                $return_html .= ':';
                $return_html .= trim(date('d-M-Y', strtotime($post['created_date'])));
                $return_html .= '</li>';

                $return_html .= '<li>';
                $return_html .= '<a href="#" title="' . ucwords($this->text2link($post['post_name'])) . '" class="post_title ">
                                                    ' . ucwords($this->text2link($post['post_name'])) . '</a> </li>';

                $firstname = $this->db->get_where('freelancer_hire_reg', array('user_id' => $post['user_id']))->row()->fullname;
                $lastname = $this->db->get_where('freelancer_hire_reg', array('user_id' => $post['user_id']))->row()->username;
                $cityname = $this->db->get_where('cities', array('city_id' => $post['city']))->row()->city_name;
                $countryname = $this->db->get_where('countries', array('country_id' => $post['country']))->row()->country_name;
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
                        $return_html .= '
                                                 </p>
                                                        </div>';
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
                $return_html .= $this->db->get_where('category', array('category_id' => $post['post_field_req']))->row()->category_name;
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
                        $cache_time = $this->db->get_where('skill', array('skill_id' => $skill))->row()->skill;
                        $return_html .= $cache_time;
                        $k++;
                    }
                } else if ($post['post_skill'] && $post['post_other_skill']) {

                    foreach ($aud_res as $skill) {
                        if ($k != 0) {
                            $return_html .= $comma;
                        }
                        $cache_time = $this->db->get_where('skill', array('skill_id' => $skill))->row()->skill;
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
                    $return_html .= $this->db->get_where('currency', array('currency_id' => $post['post_currency']))->row()->currency_name;
                    $return_html .= "&nbsp";
                    if ($post['post_rating_type'] == 0) {
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
                        if ($post['post_exp_year'] == '' || $post['post_exp_year'] == '0') {
                            $return_html .= 0;
                        }
                        $return_html .= ".";
                        $return_html .= $post['post_exp_month'];
                    }
                    $return_html .= " Year";
                    // echo $post['post_exp_year'].".".$post['post_exp_month'];
                } else {
                    $return_html .= PROFILENA;
                }

                $return_html .= '</span>
                                                             </li>
                                                           <li><b>';
                $return_html .= $this->lang->line("estimated_time");
                $return_html .= '</b>
                                                                  <span>';

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

                    $return_html .= '<a href="javascript:void(0);" class="button" onclick="removepopup(' . $post['post_id'] . ')">';
                    $return_html .= $this->lang->line("remove");
                    $return_html .= '</a>
                                                          <li>';
                    $return_html .= '<a class="button" href="' . base_url('freelancer-hire/edit-projects/' . $post['post_id']) . '" >';
                    $return_html .= $this->lang->line("edit");
                    $return_html .= '</a>
                                                          </li> 
                                                       <li class=fr>';
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
                        $return_html .= '<input type="hidden" id="allpost' . $post['post_id'] . '" value="all">';
                        $return_html .= '<input type="hidden" id="userid' . $post['post_id'] . '" value="' . $post['user_id'] . '">';
                        $return_html .= '<a href="javascript:void(0);"  class= "applypost' . $post['post_id'] . '  button" onclick="applypopup(' . $post['post_id'] . ',' . $this->uri->segment(3) . ')">';
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
                            $return_html .= '<a id="' . $post['post_id'] . '" onClick="savepopup(' . $post['post_id'] . ')" href="javascript:void(0);" class="savedpost' . $post['post_id'] . '> applypost button">';
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

                                                    <img src="../img/free-no1.png">

                                                </div>
                                                <div class="art_no_post_text">';
            $return_html .= $this->lang->line("no_post");
            $return_html .= ' </div>
                                            </div>';
        }

        echo $return_html;
    }

    public function text2link($text) {
        $text = preg_replace('/(((f|ht){1}t(p|ps){1}:\/\/)[-a-zA-Z0-9@:%_\+.~#?&\/\/=]+)/i', '<a href="\\1" target="_blank" rel="nofollow">\\1</a>', $text);
        $text = preg_replace('/([[:space:]()[{}])(www.[-a-zA-Z0-9@:%_\+.~#?&\/\/=]+)/i', '\\1<a href="http://\\2" target="_blank" rel="nofollow">\\2</a>', $text);
        $text = preg_replace('/([_\.0-9a-z-]+@([0-9a-z][0-9a-z-]+\.)+[a-z]{2,3})/i', '<a href="mailto:\\1" rel="nofollow" target="_blank">\\1</a>', $text);
        return $text;
    }

    public function freelancer_add_post() {
        $userid = $this->session->userdata('aileenuser');
//if user deactive profile then redirect to freelancer_hire/freelancer_hire/freelancer_hire_basic_info  start
        $contition_array = array('user_id' => $userid, 'status' => '0', 'is_delete' => '0');
        $freelancerhire_deactive = $this->data['freelancerhire_deactive'] = $this->common->select_data_by_condition('freelancer_hire_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);
        if ($freelancerhire_deactive) {
            redirect('freelancer_hire/freelancer_hire/freelancer_hire_basic_info');
        }
//if user deactive profile then redirect to freelancer_hire/freelancer_hire/freelancer_hire_basic_info  End
// code for display page start
        $this->freelancer_hire_check();
// code for display page end
        $contition_array = array('status' => 1);
        $this->data['countries'] = $this->common->select_data_by_condition('countries', $contition_array, $data = '*', $sortby = 'country_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');


        $contition_array = array('status' => 1);
        $this->data['category'] = $this->common->select_data_by_condition('category', $contition_array, $data = '*', $sortby = 'category_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        $contition_array = array('status' => 1);
        $this->data['currency'] = $this->common->select_data_by_condition('currency', $contition_array, $data = '*', $sortby = 'currency_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        $contition_array = array('is_delete' => '0', 'user_id' => $userid, 'status' => '1', 'free_hire_step' => 3);
        $data = 'username,fullname';
        $hire_data = $this->data['freelancr_user_data'] = $this->common->select_data_by_condition('freelancer_hire_reg', $contition_array, $data, $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str, $groupby = '');


        $this->data['title'] = $hire_data[0]['fullname'] . " " . $hire_data[0]['username'] . TITLEPOSTFIX;

        $this->load->view('freelancer/freelancer_hire/freelancer_add_post', $this->data);
    }

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
//echo "hello"; 
//echo "falguni"; die();
// $_POST["country_id"] = ;
//        if(isset($_POST["country_id"]) && !empty($_POST["country_id"])){ 
//     //Get all state data
//          $contition_array = array('country_id' => $_POST["country_id"] , 'status' => 1);
//      $state =  $this->data['states'] =  $this->common->select_data_by_condition('states', $contition_array, $data = '*', $sortby = 'state_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');
//      foreach ($state as $st) { 
//       $contition_array = array('state_id' => $st["state_id"] , 'status' => 1);
//       $this->data['finalcitylist'] =  $this->common->select_data_by_condition('cities', $contition_array, $data = '*', $sortby = 'city_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');
//       $city[] = $this->data['finalcitylist'];
//      }
//      $this->data['city'] = $city;
//      //echo "<pre>"; print_r($this->data['city']);die();
//     //Count total number of rows
// $new = array();
//      foreach($city as $key => $val){
//      foreach($val as $key1 => $val1){
//       $return = array();
//      // $return = $val1;
//        $return['city_id'] = $val1['city_id'];
//        $return['city_name'] = $val1['city_name'];
//        array_push($new,$return);
//      }
//      }
//    $citdata =  $this->aasort($new,"city_name");
//     //Display states list
//     if(count($citdata) > 0){ 
//         echo '<option value = "">Select City</option>';
//      foreach($citdata as $ct){
//         echo '<option value = "'.$ct['city_id'].'">'.$ct['city_name'].'</option>';
//        }
//     }else{  
//         echo '<option value = "">City not available</option>';
//     }
// }
//ajax data for country and state and city
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

// khyati changes end 7-4

    public function freelancer_add_post_insert() {
        $userid = $this->session->userdata('aileenuser');
        $skills = $this->input->post('skills');
        $skills = explode(',', $skills);

        $this->form_validation->set_rules('post_name', 'Post Name', 'required');
        $this->form_validation->set_rules('post_desc', 'Post description', 'required');
        $this->form_validation->set_rules('fields_req', 'Field required', 'required');

        $this->form_validation->set_rules('rate', 'Rate', 'required');
        $this->form_validation->set_rules('currency', 'Currency', 'required');

        $this->form_validation->set_rules('country', 'Country', 'required');
        $this->form_validation->set_rules('state', 'state', 'required');


        if ($this->form_validation->run() == FALSE) {
            $contition_array = array('status' => 1);
            $this->data['countries'] = $this->common->select_data_by_condition('countries', $contition_array, $data = '*', $sortby = 'country_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');


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

                    $contition_array = array('skill' => trim($ski), 'type' => 1);
                    //$search_condition = "(skill LIKE '" . trim($searchTerm) . "%')";
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
                //  die();
                $skill = array_unique($skill, SORT_REGULAR);
                $skills = implode(',', $skill);
            }
            //skill code end
            //echo "<pre>";print_r($skills);die();
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
                'country' => trim($this->input->post('country')),
                'state' => trim($this->input->post('state')),
                'city' => trim($this->input->post('city')),
                'user_id' => $userid,
                'created_date' => date('Y-m-d', time()),
                'status' => 1,
                'is_delete' => 0
            );

            //echo "<pre>"; print_r($data); die();  

            $insert_id = $this->common->insert_data_getid($data, 'freelancer_post');
            if ($insert_id) {



                redirect('freelancer-hire/projects', refresh);
            } else {
                $this->session->flashdata('error', 'Sorry!!Your data not inserted');
                redirect('freelancer/freelancer_post', refresh);
            }
        }
    }

    public function recommen_candidate() {
        $userid = $this->session->userdata('aileenuser');

        //if user deactive profile then redirect to freelancer_hire/freelancer_hire/freelancer_hire_basic_info  start
        $contition_array = array('user_id' => $userid, 'status' => '0', 'is_delete' => '0');
        $freelancerhire_deactive = $this->data['freelancerhire_deactive'] = $this->common->select_data_by_condition('freelancer_hire_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);
        if ($freelancerhire_deactive) {
            redirect('freelancer_hire/freelancer_hire/freelancer_hire_basic_info');
        }
//if user deactive profile then redirect to freelancer_hire/freelancer_hire/freelancer_hire_basic_info  end
        // code for display page start
        $this->freelancer_hire_check();
        // code for display page end
        $this->data['title'] = 'Freelancer Hire' . TITLEPOSTFIX;
        $this->load->view('freelancer/freelancer_hire/recommen_candidate', $this->data);
    }

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
        //echo "</pre>";print_r($freelancerhiredata);die();
        foreach ($freelancerhiredata as $frdata) {
            $post_skill_data = $frdata['post_skill'];
            $postuserarray = explode(',', $frdata['post_skill']);

            foreach ($postuserarray as $key => $value) {

                $contition_array = array('status' => '1', 'is_delete' => '0', 'free_post_step' => 7, 'user_id != ' => $userid, 'FIND_IN_SET("' . $value . '", freelancer_post_area) != ' => '0');
                $candidate = $this->common->select_data_by_condition('freelancer_post_reg', $contition_array, $data = 'freelancer_post_fullname, freelancer_post_username, freelancer_post_city, freelancer_post_area, freelancer_post_skill_description, freelancer_post_hourly, freelancer_post_ratestate, freelancer_post_fixed_rate, freelancer_post_work_hour, user_id, freelancer_post_user_image, designation, freelancer_post_otherskill, freelancer_post_exp_month, freelancer_post_exp_year,freelancer_apply_slug', $sortby = '', $orderby = 'desc', $limit = '', $offset = '', $join_str = array(), $groupby = '');
                $all_candidate[] = $candidate;
            }
        }
        $contition_array = array('status' => '1', 'is_delete' => '0', 'free_post_step' => 7, 'user_id != ' => $userid, 'freelancer_post_field' => $frdata['post_field_req']);
        $freelancerpostfield = $this->common->select_data_by_condition('freelancer_post_reg', $contition_array, $data = '*', $sortby = '', $orderby = 'DESC', $limit = '', $offset = '', $join_str = array(), $groupby = '');
//        TO CHANGE ARRAY OF ARRAY TO ARRAY START
        $final_candidate = array_reduce($all_candidate, 'array_merge', array());
//        TO CHANGE ARRAY OF ARRAY TO ARRAY END
        $applyuser_merge = array_merge($final_candidate, $freelancerpostfield);
        foreach ($applyuser_merge as $value) {
            $unique[$value['freelancer_post_reg_id']] = $value;
        }
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
                if ($row['freelancer_post_user_image']) {
                    $return_html .= '<a href = "' . base_url('freelancer-work/freelancer-details/' . $row['freelancer_apply_slug'] . '?page=freelancer_hire') . '" title = "' . ucwords($row['freelancer_post_fullname']) . ' ' . ucwords($row['freelancer_post_username']) . '">
                <img src = "' . FREE_POST_PROFILE_THUMB_UPLOAD_URL . $row['freelancer_post_user_image'] . '" alt = " ' . ucwords($row['freelancer_post_fullname']) . ' ' . ucwords($row['freelancer_post_username']) . '">
                </a>';
                } else {
                    $return_html .= '<a href = "' . base_url('freelancer-work/freelancer-details/' . $row['freelancer_apply_slug'] . '?page=freelancer_hire') . '" title = "' . ucwords($row['freelancer_post_fullname']) . ' ' . ucwords($row['freelancer_post_username']) . '">';
                    $post_fname = $row['freelancer_post_fullname'];
                    $post_lname = $row['freelancer_post_username'];
                    $sub_post_fname = substr($post_fname, 0, 1);
                    $sub_post_lname = substr($post_lname, 0, 1);
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
                $return_html .= $this->lang->line("skill");
                $return_html .= '</b><span>';
                $aud = $row['freelancer_post_area'];
                $aud_res = explode(', ', $aud);
                if (!$row['freelancer_post_area']) {
                    $return_html .= $row['freelancer_post_otherskill'];
                } elseif (!$row['freelancer_post_otherskill']) {
                    foreach ($aud_res as $skill) {
                        $cache_time = $this->db->get_where('skill', array('skill_id' => $skill))->row()->skill;
                        $skillsss[] = $cache_time;
                    }
                    $listskill = implode(', ', $skillsss);
                    $return_html .= $listskill;
                    unset($skillsss);
                } elseif ($row['freelancer_post_area'] && $row['freelancer_post_otherskill']) {
                    foreach ($aud_res as $skillboth) {
                        $cache_time = $this->db->get_where('skill', array('skill_id' => $skillboth))->row()->skill;
                        $skilldddd[] = $cache_time;
                    }
                    $listFinal = implode(', ', $skilldddd);
                    $return_html .= $listFinal . "," . $row['freelancer_post_otherskill'];
                    unset($skilldddd);
                }

                $return_html .= '</span>
                </li>';
                $cityname = $this->db->get_where('cities', array('city_id' => $row['freelancer_post_city']))->row()->city_name;
                $return_html .= '<li><b>';
                $return_html .= $this->lang->line("location");
                $return_html .= '</b><span>';
                if ($cityname) {
                    $return_html .= $cityname;
                } else {
                    $return_html .= PROFILENA;
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
                    $currency = $this->db->get_where('currency', array('currency_id' => $row['freelancer_post_ratestate']))->row()->currency_name;
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

                                                    <img src="../img/free-no1.png">

                                                </div>
                                                <div class="art_no_post_text">';
            $return_html .= $this->lang->line("no_freelancer_found");
            $return_html .= ' </div>
                                            </div>';
        }

        echo $return_html;
    }

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

    public function freelancer_edit_post($id) {
        // echo $id; die();
        $userid = $this->session->userdata('aileenuser');

//if user deactive profile then redirect to freelancer_hire/freelancer_hire/freelancer_hire_basic_info  start

        $contition_array = array('user_id' => $userid, 'status' => '0', 'is_delete' => '0');

        $freelancerhire_deactive = $this->data['freelancerhire_deactive'] = $this->common->select_data_by_condition('freelancer_hire_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);

        if ($freelancerhire_deactive) {
            redirect('freelancer_hire/freelancer_hire/freelancer_hire_basic_info');
        }
//if user deactive profile then redirect to freelancer_hire/freelancer_hire/freelancer_hire_basic_info  end
        // code for display page start
        $this->freelancer_hire_check();
        // code for display page end

        $contition_array = array('status' => 1);
        $this->data['countries'] = $this->common->select_data_by_condition('countries', $contition_array, $data = '*', $sortby = 'country_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        $contition_array = array('post_id' => $id, 'is_delete' => 0);
        $userdata = $this->data['freelancerpostdata'] = $this->common->select_data_by_condition('freelancer_post', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
        //echo $statedata[0]['country'];die();

        $contition_array = array('status' => 1, 'country_id' => $userdata[0]['country']);
        $state = $this->data['states'] = $this->common->select_data_by_condition('states', $contition_array, $data = '*', $sortby = 'state_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        //for getting city data
        $contition_array = array('status' => 1, 'state_id' => $userdata[0]['state']);
        $this->data['cities'] = $this->common->select_data_by_condition('cities', $contition_array, $data = '*', $sortby = 'city_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');


        $contition_array = array('status' => 1);
        $this->data['category'] = $this->common->select_data_by_condition('category', $contition_array, $data = '*', $sortby = 'category_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');


        $contition_array = array('status' => 1, 'type' => 1);
        $this->data['skill1'] = $this->common->select_data_by_condition('skill', $contition_array, $data = '*', $sortby = 'skill', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');




        $contition_array = array('status' => 1);
        $this->data['currency'] = $this->common->select_data_by_condition('currency', $contition_array, $data = '*', $sortby = 'currency_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');


//Retrieve skill data Start

        $skill_know = explode(',', $userdata[0]['post_skill']);
        // echo $language_know;die();
        foreach ($skill_know as $lan) {
            $contition_array = array('skill_id' => $lan, 'status' => 1);
            $languagedata = $this->common->select_data_by_condition('skill', $contition_array, $data = 'skill_id,skill', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str5 = '', $groupby = '');
            //echo "<pre>";print_r(  $languagedata);
            $detailes[] = $languagedata[0]['skill'];
        }

        $this->data['skill_2'] = implode(',', $detailes);
        // echo "<pre>"; print_r($this->data['skill_2']);die();
        //Retrieve skill data End

        $this->data['country1'] = $this->data['freelancerpostdata'][0]['country'];
        $this->data['city1'] = $this->data['freelancerpostdata'][0]['city'];
        $this->data['state1'] = $this->data['freelancerpostdata'][0]['state'];

//        $skildata = explode(', ', $this->data['freelancerpostdata'][0]['post_skill']);
//        $this->data['selectdata'] = $skildata;
        $contition_array = array('is_delete' => '0', 'user_id' => $userid, 'status' => '1', 'free_hire_step' => 3);
        $data = 'username,fullname';
        $hire_data = $this->data['freelancr_user_data'] = $this->common->select_data_by_condition('freelancer_hire_reg', $contition_array, $data, $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str, $groupby = '');

        $this->data['title'] = $hire_data[0]['fullname'] . " " . $hire_data[0]['username'] . TITLEPOSTFIX;
//code for search 


        $this->load->view('freelancer/freelancer_hire/freelancer_edit_post', $this->data);
    }

    public function freelancer_edit_post_insert($id) {

        $userid = $this->session->userdata('aileenuser');
        $skills = $this->input->post('skills');
        $skills = explode(',', $skills);
        $this->form_validation->set_rules('post_name', 'Post Name', 'required');
        $this->form_validation->set_rules('post_desc', 'Post description', 'required');
        //  $this->form_validation->set_rules('fields_req', 'Field required', 'required');


        $this->form_validation->set_rules('est_time', 'Estimated time', 'required');
        $this->form_validation->set_rules('rate', 'Rate', 'required');
        $this->form_validation->set_rules('currency', 'Currency', 'required');
        $this->form_validation->set_rules('rating', 'Rating', 'required');


        $this->form_validation->set_rules('country', 'Country', 'required');


        $this->form_validation->set_rules('last_date', 'Last date', 'required');

        // if ($this->form_validation->run() == FALSE) {
        //     $this->load->view('freelancer/freelancer_hire/freelancer_edit_post');
        // } else {
        //     echo "hello";die();
        $datereplace = $this->input->post('last_date');
        $lastdate = str_replace('/', '-', $datereplace);

        // skills  start   

        if (count($skills) > 0) {

            foreach ($skills as $ski) {
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
            //  die();
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
            'country' => trim($this->input->post('country')),
            'city' => trim($this->input->post('city')),
            'modify_date' => date('Y-m-d', time()),
        );

        // echo "<pre>"; print_r($data);die();
        $updatdata = $this->common->update_data($data, 'freelancer_post', 'post_id', $id);

        if ($updatdata) {



            redirect('freelancer-hire/projects', refresh);
        } else {
            $this->session->flashdata('error', 'Sorry!!Your data not inserted');
            redirect('freelancer/freelancer_edit_post', refresh);
        }
        //}
    }

    //Freelancer Job All Post Start
    public function freelancer_apply_post($id = "") {

        $this->data['userid'] = $userid = $this->session->userdata('aileenuser');

//if user deactive profile then redirect to freelancer/freelancer_post/freelancer_post_basic_information  start
        $contition_array = array('user_id' => $userid, 'status' => '0', 'is_delete' => '0');
        $freelancerpost_deactive = $this->data['freelancerpost_deactive'] = $this->common->select_data_by_condition('freelancer_post_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);

        if ($freelancerpost_deactive) {
            redirect('freelancer/freelancer_post/freelancer_post_basic_information');
        }
        //if user deactive profile then redirect to freelancer/freelancer_post/freelancer_post_basic_information  End
        // code for display page start
        $this->freelancer_apply_check();
        // code for display page end

        $contition_array = array('user_id' => $userid, 'is_delete' => 0, 'status' => 1, 'free_post_step' => 7);
        $freelancerdata = $this->data['freelancerdata'] = $this->common->select_data_by_condition('freelancer_post_reg', $contition_array, $data = '*', $sortby = '', $orderby = 'desc', $limit = '', $offset = '', $join_str = array(), $groupby = '');
        // echo "<pre>";print_r($freelancerdata);die();
        $this->data['title'] = 'Freelancer Apply' . TITLEPOSTFIX;
        $this->load->view('freelancer/freelancer_post/post_apply', $this->data);
    }

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
        // $date = date('Y-m-d', time());
        // 'post_last_date >=' => $date,
        foreach ($post_reg_skill as $key => $value) {
            $contition_array = array('is_delete' => 0, 'status' => '1', 'user_id !=' => $userid, 'FIND_IN_SET("' . $value . '",post_skill)!=' => '0');
            $freelancer_post_data = $this->common->select_data_by_condition('freelancer_post', $contition_array, $data = '*', $sortby = '', $orderby = 'desc', $limit = '', $offset = '', $join_str = array(), $groupby = '');
            if ($freelancer_post_data) {
                $freedata[] = $freelancer_post_data;
            }
        }
        foreach ($freedata as $key1 => $value) {
            foreach ($value as $ke => $val) {
                $free_post[] = $val;
            }
        }

        $unique = array_unique($free_post, SORT_ASC);
        $unique = $this->aasort($unique, "post_id");
        //echo "</pre>"; print_r($unique);die();


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
                $return_html .= '<a href="' . base_url('freelancer-hire/employer-details/' . $post['user_id'] . '?page=freelancer_post') . ' " title="' . ucwords($post['post_name']) . '" class="display_inline post_title">';
                $return_html .= ucwords($post['post_name']);
                $return_html .= '</a> </li>';
                $cityname = $this->db->get_where('cities', array('city_id' => $post['city']))->row()->city_name;
                $countryname = $this->db->get_where('countries', array('country_id' => $post['country']))->row()->country_name;
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

                $firstname = $this->db->get_where('freelancer_hire_reg', array('user_id' => $post['user_id']))->row()->fullname;
                $lastname = $this->db->get_where('freelancer_hire_reg', array('user_id' => $post['user_id']))->row()->username;
                $hireslug = $this->db->get_where('freelancer_hire_reg', array('user_id' => $post['user_id']))->row()->freelancer_hire_slug;
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
                        $cache_time = $this->db->get_where('skill', array('skill_id' => $skill))->row()->skill;
                        $return_html .= $cache_time;
                        $k++;
                    }
                } else if ($post['post_skill'] && $post['post_other_skill']) {
                    foreach ($aud_res as $skill) {
                        if ($k != 0) {
                            $return_html .= $comma;
                        }
                        $cache_time = $this->db->get_where('skill', array('skill_id' => $skill))->row()->skill;
                        $return_html .= $cache_time;
                        $k++;
                    } $return_html .= "," . $post['post_other_skill'];
                }
                $return_html .= '</span>
                                                                                </li>
                                                                                <li><b>';
                $return_html .= $this->lang->line("project_description");
                $return_html .= '</b><span><p>';

                if ($post['post_description']) {
                    $return_html .= $post['post_description'];
                } else {
                    $return_html .= PROFILENA;
                }

                $return_html .= '</p></span>
                                                                                </li>
                                                                                <li><b>';
                $return_html .= $this->lang->line("rate");
                $return_html .= '</b><span>';
                if ($post['post_rate']) {
                    $return_html .= $post['post_rate'];
                    $return_html .= "&nbsp";
                    $return_html .= $this->db->get_where('currency', array('currency_id' => $post['post_currency']))->row()->currency_name;
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
                $return_html .= $this->lang->line("last_date");
                $return_html .= ':';

                if ($post['post_last_date']) {
                    $return_html .= date('d-M-Y', strtotime($post['post_last_date']));
                } else {
                    $return_html .= PROFILENA;
                }
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

                                                    <img src="../img/free-no1.png">

                                                </div>
                                                <div class="art_no_post_text">';
            $return_html .= $this->lang->line("no_recommen_project");
            $return_html .= ' </div>
                                            </div>';
        }
        echo $return_html;
    }

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

    public function save_user1($id, $save_id) {
        //echo $id; echo $save_id; die();
        $id = $_POST['user_id'];

        // echo $id; die();
        $save_id = $_POST['save_id'];

        $userid = $this->session->userdata('aileenuser');
        //echo $id;die();
        $contition_array = array('from_id' => $userid, 'to_id' => $id, 'save_id' => $save_id);
        $userdata = $this->common->select_data_by_condition('save', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
        //echo "<pre>";print_r($userdata);die();

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

    //Freelancer Job All Post controller end
//Freelancer Apply post at all post page & save post page controller Start
    public function apply_insert() {

        $id = $_POST['post_id'];
        $para = $_POST['allpost'];
        $notid = $_POST['userid'];
        // echo $id;
        // echo $para;
        // echo $notid;

        $userid = $this->session->userdata('aileenuser');

        $contition_array = array('post_id' => $id, 'user_id' => $userid, 'is_delete' => 0);
        $userdata = $this->common->select_data_by_condition('freelancer_apply', $contition_array, $data = '*', $sortby = '', $orderby = 'desc', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        //echo "<pre>";print_r($userdata);die();

        $app_id = $userdata[0]['app_id'];

        if ($userdata) {
            //echo "hello";

            $contition_array = array('job_delete' => 1);
            $jobdata = $this->common->select_data_by_condition('freelancer_apply', $contition_array, $data = 'app_id', $sortby = '', $orderby = 'desc', $limit = '', $offset = '', $join_str = array(), $groupby = '');

            $data = array(
                'job_delete' => 0,
                'job_save' => 3,
                'modify_date' => date('Y-m-d h:i:s', time())
            );
            //echo "hhhh";


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

                if ($para == 'all') {
                    $applypost = 'Applied';
                }
            }
            echo $applypost;
        } else {
            //echo "sssss";die();
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
            //echo "<pre>"; print_r($data);die();

            $insert_id = $this->common->insert_data_getid($data, 'notification');

            // end notoification

            if ($insert_id) {

                $applypost = 'Applied';

                //echo "hello";die();
            }
            echo $applypost;
        }
    }

    //Freelancer Apply post at all post page & save post page controller End
//Freelancer view all applied post controller Start
    public function freelancer_applied_post() {
        $this->data['userid'] = $userid = $this->session->userdata('aileenuser');
//if user deactive profile then redirect to freelancer/freelancer_post/freelancer_post_basic_information  start
        $contition_array = array('user_id' => $userid, 'status' => '0', 'is_delete' => '0');

        $freelancerpost_deactive = $this->data['freelancerpost_deactive'] = $this->common->select_data_by_condition('freelancer_post_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);
        if ($freelancerpost_deactive) {
            redirect('freelancer/freelancer_post/freelancer_post_basic_information');
        }
        //if user deactive profile then redirect to freelancer/freelancer_post/freelancer_post_basic_information  End
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

    //Freelancer view all applied post controller End
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
                $return_html .= '<a href="#" title="' . ucwords($this->common->make_links($post['post_name'])) . '" class="post_title">';
                $return_html .= ucwords($this->common->make_links($post['post_name']));
                $return_html .= '</a>   
                                                                        </li>';

                $firstname = $this->db->get_where('freelancer_hire_reg', array('user_id' => $post['user_id']))->row()->fullname;
                $lastname = $this->db->get_where('freelancer_hire_reg', array('user_id' => $post['user_id']))->row()->username;

                $return_html .= '<li>
                                                                            <a class="display_inline" title="' . ucwords($firstname) . '&nbsp; ' . ucwords($lastname) . '" href="' . base_url('freelancer-hire/employer-details/' . $post['user_id'] . '?page=freelancer_post') . '">';
                $return_html .= ucwords($firstname) . " " . ucwords($lastname);
                $return_html .= '</a>';
                $cityname = $this->db->get_where('cities', array('city_id' => $post['city']))->row()->city_name;
                $countryname = $this->db->get_where('countries', array('country_id' => $post['country']))->row()->country_name;
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
                $return_html .= $this->db->get_where('category', array('category_id' => $post['post_field_req']))->row()->category_name;
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
                        $cache_time = $this->db->get_where('skill', array('skill_id' => $skill))->row()->skill;
                        $return_html .= $cache_time;
                        $k++;
                    }
                } else if ($post['post_skill'] && $post['post_other_skill']) {
                    foreach ($aud_res as $skill) {
                        if ($k != 0) {
                            $return_html .= $comma;
                        }
                        $cache_time = $this->db->get_where('skill', array('skill_id' => $skill))->row()->skill;
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
                                                                            <p>';

                if ($post['post_description']) {
                    $return_html .= $this->common->make_links($post['post_description']);
                } else {
                    $return_html .= PROFILENA;
                }

                $return_html .= '</p>
                                                                        </span>
                                                                    </li>
                                                                    <li><b>';
                $return_html .= $this->lang->line("rate");
                $return_html .= '</b><span>';

                if ($post['post_rate']) {
                    $return_html .= $post['post_rate'];
                    $return_html .= "&nbsp";
                    $return_html .= $this->db->get_where('currency', array('currency_id' => $post['post_currency']))->row()->currency_name;
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
                $return_html .= $this->lang->line("last_date");
                $return_html .= ':';

                if ($post['post_last_date']) {
                    $return_html .= date('d-M-Y', strtotime($post['post_last_date']));
                } else {
                    $return_html .= PROFILENA;
                }
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

                                                    <img src="../img/free-no1.png">

                                                </div>
                                                <div class="art_no_post_text">';
            $return_html .= $this->lang->line("no_applied_projects");
            $return_html .= '</div>
                                            </div>';
        }
        echo $return_html;
    }

    //Freelancer Delete all Applied & Save post controller Start
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

    //Freelancer Delete all Applied & Save post controller End
//Freelancer Save post controller Start

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

//Freelancer Save post controller End

    public function freelancer_apply_list($id) {
        $userid = $this->session->userdata('aileenuser');
//if user deactive profile then redirect to freelancer_hire/freelancer_hire/freelancer_hire_basic_info  start

        $contition_array = array('user_id' => $userid, 'status' => '0', 'is_delete' => '0');

        $freelancerhire_deactive = $this->data['freelancerhire_deactive'] = $this->common->select_data_by_condition('freelancer_hire_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);

        if ($freelancerhire_deactive) {
            redirect('freelancer_hire/freelancer_hire/freelancer_hire_basic_info');
        }
//if user deactive profile then redirect to freelancer_hire/freelancer_hire/freelancer_hire_basic_info  end
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

//save freelancer list controller start
    public function freelancer_save() {
        $userid = $this->session->userdata('aileenuser');
        //if user deactive profile then redirect to freelancer_hire/freelancer_hire/freelancer_hire_basic_info  start
        $contition_array = array('user_id' => $userid, 'status' => '0', 'is_delete' => '0');
        $freelancerhire_deactive = $this->data['freelancerhire_deactive'] = $this->common->select_data_by_condition('freelancer_hire_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);
        if ($freelancerhire_deactive) {
            redirect('freelancer_hire/freelancer_hire/freelancer_hire_basic_info');
        }
        //if user deactive profile then redirect to freelancer_hire/freelancer_hire/freelancer_hire_basic_info  End
        // code for display page start
        $this->freelancer_hire_check();
        // code for display page end

        $contition_array = array('is_delete' => '0', 'user_id' => $userid, 'status' => '1', 'free_hire_step' => 3);
        $data = 'username,fullname,designation,freelancer_hire_user_image,user_id';
        $hire_data = $this->data['freelancr_user_data'] = $this->common->select_data_by_condition('freelancer_hire_reg', $contition_array, $data, $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str, $groupby = '');
        $this->data['title'] = $hire_data[0]['fullname'] . " " . $hire_data[0]['username'] . TITLEPOSTFIX;
        $this->load->view('freelancer/freelancer_hire/freelancer_save', $this->data);
    }

//save freelancer list controller End
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
        $postdata = $this->common->select_data_by_condition('save', $contition_array, $data = 'freelancer_post_reg.freelancer_post_user_image, freelancer_post_reg.user_id, freelancer_post_reg.freelancer_post_fullname, freelancer_post_reg.freelancer_post_username, freelancer_post_reg.designation, freelancer_post_reg.freelancer_post_area, freelancer_post_reg.freelancer_post_otherskill, freelancer_post_reg.freelancer_post_city, freelancer_post_reg.freelancer_post_skill_description, freelancer_post_reg.freelancer_post_work_hour, freelancer_post_reg.freelancer_post_hourly, freelancer_post_reg.freelancer_post_ratestate, freelancer_post_reg.freelancer_post_fixed_rate, freelancer_post_reg.freelancer_post_exp_year, freelancer_post_reg.freelancer_post_exp_month, save.save_id', $sortby = 'save_id', $orderby = 'desc', $limit = '', $offset = '', $join_str, $groupby = '');
        $postdata1 = $this->common->select_data_by_condition('save', $contition_array, $data = 'freelancer_post_reg.freelancer_post_user_image, freelancer_post_reg.user_id, freelancer_post_reg.freelancer_post_fullname, freelancer_post_reg.freelancer_post_username, freelancer_post_reg.designation, freelancer_post_reg.freelancer_post_area, freelancer_post_reg.freelancer_post_otherskill, freelancer_post_reg.freelancer_post_city, freelancer_post_reg.freelancer_post_skill_description, freelancer_post_reg.freelancer_post_work_hour, freelancer_post_reg.freelancer_post_hourly, freelancer_post_reg.freelancer_post_ratestate, freelancer_post_reg.freelancer_post_fixed_rate, freelancer_post_reg.freelancer_post_exp_year, freelancer_post_reg.freelancer_post_exp_month, save.save_id', $sortby = 'save_id', $orderby = 'desc', $limit, $offset = '', $join_str, $groupby = '');
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
                        $cache_time = $this->db->get_where('skill', array('skill_id' => $skill))->row()->skill;
                        $return_html .= $cache_time;
                        $k++;
                    }
                } else if ($rec['freelancer_post_area'] && $rec['freelancer_post_otherskill']) {
                    foreach ($aud_res as $skill) {
                        if ($k != 0) {
                            $return_html .= $comma;
                        }
                        $cache_time = $this->db->get_where('skill', array('skill_id' => $skill))->row()->skill;
                        $return_html .= $cache_time;
                        $k++;
                    }
                    $return_html .= "," . $rec['freelancer_post_otherskill'];
                }
                $return_html .= ' </span>
                                        </li>';
                $cityname = $this->db->get_where('cities', array('city_id' => $rec['freelancer_post_city']))->row()->city_name;
                $return_html .= '<li><b>';
                $return_html .= $this->lang->line("location");
                $return_html .= '</b><span>';

                if ($cityname) {
                    $return_html .= $cityname;
                } else {
                    $return_html .= PROFILENA;
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
                    $currency = $this->db->get_where('currency', array('currency_id' => $rec['freelancer_post_ratestate']))->row()->currency_name;
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
                                                    <img src="../img/free-no1.png">
                                                </div>
                                                <div class="art_no_post_text">';
            $return_html .= $this->lang->line("no_saved_freelancer");
            $return_html .= ' </div>
                                            </div>';
        }
        echo $return_html;
    }

//Freelancer Save Post Controller Start         
    public function freelancer_save_post() {
        $this->data['userid'] = $userid = $this->session->userdata('aileenuser');
//if user deactive profile then redirect to freelancer/freelancer_post/freelancer_post_basic_information  start
        $contition_array = array('user_id' => $userid, 'status' => '0', 'is_delete' => '0');
        $freelancerpost_deactive = $this->data['freelancerpost_deactive'] = $this->common->select_data_by_condition('freelancer_post_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);
        if ($freelancerpost_deactive) {
            redirect('freelancer/freelancer_post/freelancer_post_basic_information');
        }
//if user deactive profile then redirect to freelancer/freelancer_post/freelancer_post_basic_information  End
// code for display page start
        $this->freelancer_apply_check();
// code for display page end
// job seeker detail
        $contition_array = array('user_id' => $userid, 'is_delete' => 0, 'status' => 1, 'free_post_step' => 7);
        $jobdata = $this->data['jobdata'] = $this->common->select_data_by_condition('freelancer_post_reg', $contition_array, $data = '*', $sortby = '', $orderby = 'desc', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        $this->data['title'] = $jobdata[0]['freelancer_post_fullname'] . " " . $jobdata[0]['freelancer_post_username'] . TITLEPOSTFIX;

        $this->load->view('freelancer/freelancer_post/freelancer_save_post', $this->data);
    }

//Freelancer Save Post Controller End

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
                    $return_html .= '<a href="#" title="' . ucwords($this->text2link($post['post_name'])) . '" class="post_title">';
                    $return_html .= ucwords($this->text2link($post['post_name']));
                    $return_html .= '</a> </li>';
                    $firstname = $this->db->get_where('freelancer_hire_reg', array('user_id' => $post['user_id']))->row()->fullname;
                    $lastname = $this->db->get_where('freelancer_hire_reg', array('user_id' => $post['user_id']))->row()->username;

                    $return_html .= '<li><a class="display_inline" title="' . ucwords($firstname) . ' ." ".' . ucwords($lastname) . '" href="' . base_url('freelancer/freelancer_hire_profile/' . $post['user_id'] . '?page=freelancer_post') . '">';
                    $return_html .= ucwords($firstname) . "  " . ucwords($lastname);
                    $return_html .= '</a>';
                    $cityname = $this->db->get_where('cities', array('city_id' => $post['city']))->row()->city_name;
                    $countryname = $this->db->get_where('countries', array('country_id' => $post['country']))->row()->country_name;
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
                            $cache_time = $this->db->get_where('skill', array('skill_id' => $skill))->row()->skill;

                            $return_html .= $cache_time;
                            $k++;
                        }
                    } else if ($post['post_skill'] && $post['post_other_skill']) {
                        foreach ($aud_res as $skill) {
                            if ($k != 0) {
                                $return_html .= $comma;
                            }
                            $cache_time = $this->db->get_where('skill', array('skill_id' => $skill))->row()->skill;
                            $return_html .= $cache_time;
                            $k++;
                        } $return_html .= "," . $post['post_other_skill'];
                    }
                    $return_html .= '</span>
                                                </li>
                                                <li><b>';
                    $return_html .= $this->lang->line("project_description");
                    $return_html .= '</b><span><p>';

                    if ($post['post_description']) {
                        $return_html .= $this->text2link($post['post_description']);
                    } else {
                        $return_html .= PROFILENA;
                    }
                    $return_html .= ' </p></span>
                                                </li>
                                                <li><b>';
                    $return_html .= $this->lang->line("rate");
                    $return_html .= '</b><span>';

                    if ($post['post_rate']) {
                        $return_html .= $post['post_rate'];
                        $return_html .= "&nbsp";
                        $return_html .= $this->db->get_where('currency', array('currency_id' => $post['post_currency']))->row()->currency_name;
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
                    $return_html .= $this->lang->line("last_date");
                    $return_html .= ':';

                    if ($post['post_last_date']) {
                        $return_html .= date('d-M-Y', strtotime($post['post_last_date']));
                    } else {
                        $return_html .= PROFILENA;
                    }
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

                                                    <img src="../img/free-no1.png">

                                                </div>
                                                <div class="art_no_post_text">';
            $return_html .= $this->lang->line("no_saved_project");
            $return_html .= '</div>
                                            </div>';
        }
        echo $return_html;
    }

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
        list($type, $data) = explode(';', $data);
        list(, $data) = explode(',', $data);
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

        $thumb_image_uplode = $this->thumb_img_uplode($upload_image, $imageName, $user_thumb_path, $user_thumb_width, $user_thumb_height);

        $thumb_image = $user_thumb_path . $imageName;
        $abc = $s3->putObjectFile($thumb_image, bucket, $thumb_image, S3::ACL_PUBLIC_READ);

        $data = array(
            'freelancer_hire_user_image' => $imageName
        );

        $update = $this->common->update_data($data, 'freelancer_hire_reg', 'user_id', $userid);
        //  echo "11111";die();

        if ($update) {

            $contition_array = array('user_id' => $userid, 'status' => '1', 'is_delete' => '0');
            $freelancerpostdata = $this->common->select_data_by_condition('freelancer_hire_reg', $contition_array, $data = 'freelancer_hire_user_image', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);
            $userimage .= '<img src="' . FREE_HIRE_PROFILE_THUMB_UPLOAD_URL . $freelancerpostdata[0]['freelancer_hire_user_image'] . '" alt="" >';
            $userimage .= '<a href="javascript:void(0);" onclick="updateprofilepopup();"><i class="fa fa-camera" aria-hidden="true"></i>';
            $userimage .= $this->lang->line("update_profile_picture");
            $userimage .= '</a>';

            echo $userimage;
        } else {

            $this->session->flashdata('error', 'Your data not inserted');
            redirect('freelancer-hire/projects', refresh);
        }
    }

    public function user_image_insert() {
        //work is left file name is not get 

        $userid = $this->session->userdata('aileenuser');
// $config['upload_path'] = 'uploads/user_image/';
// $config['allowed_types'] = 'jpg|jpeg|png|gif|mp4|3gp|mpeg|mpg|mpe|qt|mov|avi|pdf';
// $config['file_name'] = $_FILES['profilepic']['name'];
// //Load upload library and initialize configuration
// $this->load->library('upload', $config);
// $this->upload->initialize($config);
// if ($this->upload->do_upload('profilepic')) {
//     $uploadData = $this->upload->data();
//     $picture = $uploadData['file_name'];
// } else {
//     $picture = '';
// }
        //echo "<pre>"; print_r($_FILES);die();
//        $config = array(
//            'upload_path' => $this->config->item('free_hire_profile_main_upload_path'),
//            'max_size' => $this->config->item('free_hire_profile_main_max_size'),
//            'allowed_types' => $this->config->item('free_hire_profile_main_allowed_types'),
//            'file_name' => $_FILES['profilepic']['name']
//               
//        );



        $freelancer_hire_userimage = '';
        $user['upload_path'] = $this->config->item('free_hire_profile_main_upload_path');
        $user['allowed_types'] = $this->config->item('free_hire_profile_main_allowed_types');
        $user['max_size'] = $this->config->item('free_hire_profile_main_max_size');
        $user['max_width'] = $this->config->item('free_hire_profile_main_max_width');
        $user['max_height'] = $this->config->item('free_hire_profile_main_max_height');
        $this->load->library('upload');
        $this->upload->initialize($user);
//Uploading Image
        $this->upload->do_upload('profilepic');
//Getting Uploaded Image File Data
        $imgdata = $this->upload->data();
        // echo "<pre>";print_r($imgdata);die();
        $imgerror = $this->upload->display_errors();
//echo "$imgerror";die();
        if ($imgerror == '') {
//Configuring Thumbnail 
            $user_thumb['image_library'] = 'gd2';
            $user_thumb['source_image'] = $user['upload_path'] . $imgdata['file_name'];
            $user_thumb['new_image'] = $this->config->item('free_hire_profile_thumb_upload_path') . $imgdata['file_name'];
            $user_thumb['create_thumb'] = TRUE;
            $user_thumb['maintain_ratio'] = TRUE;
            $user_thumb['thumb_marker'] = '';
            $user_thumb['width'] = $this->config->item('free_hire_profile_thumb_width');
//$user_thumb['height'] = $this->config->item('user_thumb_height');
            $user_thumb['height'] = 2;
            $user_thumb['master_dim'] = 'width';
            $user_thumb['quality'] = "100%";
            $user_thumb['x_axis'] = '0';
            $user_thumb['y_axis'] = '0';
//Loading Image Library
            $this->load->library('image_lib', $user_thumb);
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
            if ($this->input->post('hitext') == 1) {
                redirect('freelancer-hire/add-projects', refresh);
            } elseif ($this->input->post('hitext') == 2) {
                redirect('freelancer-hire/projects', refresh);
            } elseif ($this->input->post('hitext') == 3) {
                redirect('freelancer-hire/freelancer-save', refresh);
            } elseif ($this->input->post('hitext') == 4) {
                redirect('freelancer-hire/employer-details', refresh);
            }
// $redirect_url = site_url('dashboard');
// redirect($redirect_url, 'refresh');
        } else {

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

            $freelancer_hire_userimage = $imgdata['file_name'];
        }

        $data = array(
            'freelancer_hire_user_image' => $freelancer_hire_userimage,
            'modified_date' => date('Y-m-d', time())
        );

        $updatdata = $this->common->update_data($data, 'freelancer_hire_reg', 'user_id', $userid);




        if ($updatdata) {

            $contition_array = array('user_id' => $userid, 'status' => '1', 'is_delete' => '0');
            $freelancerpostdata = $this->common->select_data_by_condition('freelancer_hire_reg', $contition_array, $data = 'freelancer_hire_user_image', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);

            $userimage .= '<img src="' . base_url($this->config->item('free_hire_profile_thumb_upload_path') . $freelancerpostdata[0]['freelancer_hire_user_image']) . '" alt="" >';
            $userimage .= '<a href="javascript:void(0);" onclick="updateprofilepopup();"><i class="fa fa-camera" aria-hidden="true"></i>';
            $userimage .= $this->lang->line("update_profile_picture");
            $userimage .= '</a>';


            echo $userimage;
        } else {
            $this->session->flashdata('error', 'Your data not inserted');
            redirect('freelancer-hire/projects', refresh);
        }
    }

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

        $upload_image = $user_bg_path . $imageName;

        $thumb_image_uplode = $this->thumb_img_uplode($upload_image, $imageName, $user_thumb_path, $user_thumb_width, $user_thumb_height);

        $thumb_image = $user_thumb_path . $imageName;
        $abc = $s3->putObjectFile($thumb_image, bucket, $thumb_image, S3::ACL_PUBLIC_READ);

        $data = array(
            'freelancer_post_user_image' => $imageName
        );

        $update = $this->common->update_data($data, 'freelancer_post_reg', 'user_id', $userid);
        //  echo "11111";die();

        if ($update) {

            $contition_array = array('user_id' => $userid, 'status' => '1', 'is_delete' => '0');
            $freelancerpostdata = $this->common->select_data_by_condition('freelancer_post_reg', $contition_array, $data = 'freelancer_post_user_image', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);
            $userimage .= '<img src="' . FREE_POST_PROFILE_THUMB_UPLOAD_URL . $freelancerpostdata[0]['freelancer_post_user_image'] . '" alt="" >';
            $userimage .= '<a href="javascript:void(0);" onclick="updateprofilepopup();"><i class="fa fa-camera" aria-hidden="true"></i>';
            $userimage .= $this->lang->line("update_profile_picture");
            $userimage .= '</a>';

            echo $userimage;
        } else {

            $this->session->flashdata('error', 'Your data not inserted');
            redirect('freelancer-work/home', refresh);
        }
    }

//CODE FOR UPLOAD PROFILE PIC OF FREELANCER_WORK WITHOUT CROP START
    public function user_image_add() {

        $userid = $this->session->userdata('aileenuser');

        $freelancer_post_userimage = '';
        $user['upload_path'] = $this->config->item('free_post_profile_main_upload_path');
        $user['allowed_types'] = $this->config->item('free_post_profile_main_allowed_types');
        $user['max_size'] = $this->config->item('free_post_profile_main_max_size');
        $user['max_width'] = $this->config->item('free_post_profile_main_max_width');
        $user['max_height'] = $this->config->item('free_post_profile_main_max_height');
        $this->load->library('upload');
        $this->upload->initialize($user);
        //Uploading Image
        $this->upload->do_upload('profilepic');
        //Getting Uploaded Image File Data
        $imgdata = $this->upload->data();
        $imgerror = $this->upload->display_errors();
        if ($imgerror == '') {
            //Configuring Thumbnail 
            $user_thumb['image_library'] = 'gd2';
            $user_thumb['source_image'] = $user['upload_path'] . $imgdata['file_name'];
            $user_thumb['new_image'] = $this->config->item('free_post_profile_thumb_upload_path') . $imgdata['file_name'];
            $user_thumb['create_thumb'] = TRUE;
            $user_thumb['maintain_ratio'] = TRUE;
            $user_thumb['thumb_marker'] = '';
            $user_thumb['width'] = $this->config->item('free_post_profile_thumb_width');
            //$user_thumb['height'] = $this->config->item('user_thumb_height');
            $user_thumb['height'] = 2;
            $user_thumb['master_dim'] = 'width';
            $user_thumb['quality'] = "100%";
            $user_thumb['x_axis'] = '0';
            $user_thumb['y_axis'] = '0';
            //Loading Image Library
            $this->load->library('image_lib', $user_thumb);
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
            if ($this->input->post('hitext') == 1) {
                redirect('freelancer-work/freelancer_applied_post', refresh);
            } elseif ($this->input->post('hitext') == 2) {
                redirect('freelancer-work/saved-projects', refresh);
            } elseif ($this->input->post('hitext') == 3) {
                redirect('freelancer-work/freelancer-details', refresh);
            }
            // $redirect_url = site_url('dashboard');
            // redirect($redirect_url, 'refresh');
        } else {


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

            $freelancer_post_userimage = $imgdata['file_name'];
        }


        $data = array(
            'freelancer_post_user_image' => $freelancer_post_userimage,
            'modify_date' => date('Y-m-d', time())
        );

        $updatdata = $this->common->update_data($data, 'freelancer_post_reg', 'user_id', $userid);

        if ($updatdata) {

            $contition_array = array('user_id' => $userid, 'status' => '1', 'is_delete' => '0');
            $freelancerpostdata = $this->common->select_data_by_condition('freelancer_post_reg', $contition_array, $data = 'freelancer_post_user_image', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);

            $userimage .= '<img src="' . FREE_POST_PROFILE_THUMB_UPLOAD_URL . $freelancerpostdata[0]['freelancer_post_user_image'] . '" alt="" >';
            $userimage .= '<a href="javascript:void(0);" onclick="updateprofilepopup();"><i class="fa fa-camera" aria-hidden="true"></i>';
            $userimage .= $this->lang->line("update_profile_picture");
            $userimage .= '</a>';

            echo $userimage;
        } else {
            $this->session->flashdata('error', 'Your data not inserted');
            redirect('freelancer/freelancer_apply_post', refresh);
        }
    }

//CODE FOR PROFILE PIC UPLOAD OF FREELANCER_WORK WITHOUT CROP END
    public function freelancer_hire_profile($id = "") {
        $id = $this->db->get_where('freelancer_hire_reg', array('freelancer_hire_slug' => $id, 'status' => 1))->row()->user_id;
        $userid = $this->session->userdata('aileenuser');
//if user deactive profile then redirect to freelancer_hire/freelancer_hire/freelancer_hire_basic_info  start
        $contition_array = array('user_id' => $userid, 'status' => '0', 'is_delete' => '0');
        $freelancerhire_deactive = $this->data['freelancerhire_deactive'] = $this->common->select_data_by_condition('freelancer_hire_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);
        if ($freelancerhire_deactive) {
            redirect('freelancer_hire/freelancer_hire/freelancer_hire_basic_info');
        }
//if user deactive profile then redirect to freelancer_hire/freelancer_hire/freelancer_hire_basic_info  End

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

    public function pdf($id) {

        $contition_array = array('user_id' => $id, 'status' => '1');
        $this->data['freelancerdata'] = $freelancerdata = $this->common->select_data_by_condition('freelancer_post_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
        // echo "<pre>"; print_r($this->data['freelancerdata']);die();
        $this->load->view('freelancer/freelancer_post/freelancer_pdf', $this->data);
    }

//Remove save candidate controller Start
    public function remove_save() {

        $saveid = $_POST['save_id'];
        $userid = $this->session->userdata('aileenuser');

        $data = array(
            'status' => 1
        );

        $updatedata = $this->common->update_data($data, 'save', 'save_id', $saveid);
    }

//Remove save candidate controller End

    public function freelancer_post_profile($id) {
        // echo $id;die();
        $id = $this->db->get_where('freelancer_post_reg', array('freelancer_apply_slug' => $id, 'status' => 1))->row()->user_id;
        $userid = $this->session->userdata('aileenuser');
//if user deactive profile then redirect to freelancer/freelancer_post/freelancer_post_basic_information  start
        $contition_array = array('user_id' => $userid, 'status' => '0', 'is_delete' => '0');
        $freelancerpost_deactive = $this->data['freelancerpost_deactive'] = $this->common->select_data_by_condition('freelancer_post_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);
        if ($freelancerpost_deactive) {
            redirect('freelancer/freelancer_post/freelancer_post_basic_information');
        }
        //if user deactive profile then redirect to freelancer/freelancer_post/freelancer_post_basic_information  End

        if ($id == $userid || $id == '') {
            // code for display page start
            $this->freelancer_apply_check();
            // code for display page end
            $contition_array = array('user_id' => $userid);
            $apply_data = $this->data['freelancerpostdata'] = $this->common->select_data_by_condition('freelancer_post_reg', $contition_array, $data = 'freelancer_post_fullname, freelancer_post_username, freelancer_post_skypeid, freelancer_post_email, freelancer_post_phoneno, freelancer_post_country, freelancer_post_state, freelancer_post_city, freelancer_post_address, freelancer_post_pincode, freelancer_post_field, freelancer_post_area, freelancer_post_skill_description, freelancer_post_hourly, freelancer_post_ratestate, freelancer_post_fixed_rate, freelancer_post_job_type, freelancer_post_work_hour, freelancer_post_degree, freelancer_post_stream, freelancer_post_univercity, freelancer_post_collage, freelancer_post_percentage, freelancer_post_passingyear, freelancer_post_portfolio_attachment, freelancer_post_portfolio, user_id, freelancer_post_user_image, profile_background, designation, freelancer_post_otherskill, freelancer_post_exp_month, freelancer_post_exp_year', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
        } else {
            $contition_array = array('user_id' => $id, 'free_post_step' => 7);
            $apply_data = $this->data['freelancerpostdata'] = $this->common->select_data_by_condition('freelancer_post_reg', $contition_array, $data = 'freelancer_post_fullname, freelancer_post_username, freelancer_post_skypeid, freelancer_post_email, freelancer_post_phoneno, freelancer_post_country, freelancer_post_state, freelancer_post_city, freelancer_post_address, freelancer_post_pincode, freelancer_post_field, freelancer_post_area, freelancer_post_skill_description, freelancer_post_hourly, freelancer_post_ratestate, freelancer_post_fixed_rate, freelancer_post_job_type, freelancer_post_work_hour, freelancer_post_degree, freelancer_post_stream, freelancer_post_univercity, freelancer_post_collage, freelancer_post_percentage, freelancer_post_passingyear, freelancer_post_portfolio_attachment, freelancer_post_portfolio, user_id, freelancer_post_user_image, profile_background, designation, freelancer_post_otherskill, freelancer_post_exp_month, freelancer_post_exp_year', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
        }
        $this->data['title'] = $apply_data[0]['freelancer_post_fullname'] . " " . $apply_data[0]['freelancer_post_username'] . TITLEPOSTFIX;
        $this->load->view('freelancer/freelancer_post/freelancer_post_profile', $this->data);
    }

//keyskill automatic retrieve cobtroller start
    public function keyskill() {
        $json = [];
        $where = "type='1' AND status='1'";

        if (!empty($this->input->get("q"))) {
            $this->db->like('skill', $this->input->get("q"));
            $query = $this->db->select('skill_id as id, skill as text')
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

        $this->load->database('aileensoul');


        // if (!empty($this->input->get("q"))) {
        //     $this->db->like('city_name', $this->input->get("q"));
        //     $query = $this->db->select('city_id as id, city_name as text')
        //             ->order_by("city_name", "asc")
        //             ->limit(10)
        //             ->get("cities");
        //     $json = $query->result();
        // }
        // echo json_encode($json);


        if (!empty($this->input->get("q"))) {
            $search_condition = "(city_name LIKE '" . trim($this->input->get("q")) . "%')";

            $tolist = $this->common->select_data_by_search('cities', $search_condition, $contition_array = array(), $data = 'city_id as id, city_name as text', $sortby = 'city_name', $orderby = 'asc', $limit = '', $offset = '', $join_str5 = '', $groupby = '');
        }
        //  echo json_encode($tolist);
        echo json_encode($tolist);
    }

//location automatic retrieve cobtroller End
//freelancer post user search start

    public function freelancerpost_user($id) {

        $userid = $this->session->userdata('aileenuser');

        $contition_array = array('freelancer_post_reg.user_id' => $id, 'freelancer_post_reg.is_delete' => 0);

        $data = '*';

        $this->data['freelancerpostdata'] = $this->common->select_data_by_condition('freelancer_post_reg', $contition_array, $data, $sortby, $orderby, $limit, $offset, $join_str, $groupby);

        $this->load->view('freelancer/freelancer_post/freelancer_post_profile', $this->data);
    }

//freelancer post search end
    //freelancer hire user search start
    public function freelancerhire_user($id) {

        $userid = $this->session->userdata('aileenuser');
        //echo $userid;
        $contition_array = array('freelancer_hire_reg.user_id' => $id, 'freelancer_hire_reg.is_delete' => 0);

        $data = '*';

        $this->data['freelancerdata'] = $this->common->select_data_by_condition('freelancer_hire_reg', $contition_array, $data, $sortby, $orderby, $limit, $offset, $join_str, $groupby);

        $contition_array = array('user_id' => $id, 'is_delete' => 0);
        $this->data['freelancerpostdata'] = $this->common->select_data_by_condition('freelancer_post', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        $this->load->view('freelancer/freelancer_hire/freelancer_hire_post', $this->data);
    }

    //freelancer hire user search end 
//remove post at home page controoler start
    public function remove_post() {

        $postid = $_POST['post_id'];

        $data = array(
            'is_delete' => 1,
            'modify_date' => date('y-m-d h:i:s')
        );

        $updatedata = $this->common->update_data($data, 'freelancer_post', 'post_id', $postid);
    }

//remove post at home page controoler End
//invite user  at home page click on applied person controller Start
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

//invite user  at home page click on applied person controller End
//deactivate user start for work
    public function deactivate() {

        $id = $_POST['id'];

        $data = array(
            'status' => 0
        );

        $update = $this->common->update_data($data, 'freelancer_post_reg', 'user_id', $id);

        // if ($update) {
        //     $this->session->set_flashdata('success', 'You are deactivate successfully.');
        //     redirect('dashboard', 'refresh');
        // } else {
        //     $this->session->flashdata('error', 'Sorry!!Your are not deactivate!!');
        //     redirect('freelancer/freelancer_post', 'refresh');
        // }
    }

// deactivate user end
//deactivate user start for hire
    public function deactivate_hire() {
        $id = $_POST['id'];
        $data = array(
            'status' => 0
        );
        $update = $this->common->update_data($data, 'freelancer_hire_reg', 'user_id', $id);
        $update = $this->common->update_data($data, 'freelancer_post', 'user_id', $id);
    }

// deactivate user end

    public function image_upload_ajax() {

        include 'db.php';

        session_start();
        $session_uid = $this->session->userdata('aileenuser');
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
                        $bgSave = '<div id = "uX' . $session_uid . '" class = "bgSave wallbutton blackButton">Save Cover</div>';


                        $config['upload_path'] = $this->config->item('free_hire_bg_main_upload_path');
                        $config['allowed_types'] = $this->config->item('free_hire_bg_main_allowed_types');
                        // $config['file_name'] = $_FILES['picture']['name'];
                        $config['file_name'] = $_FILES['photoimg']['name'];
                        //$config['max_size'] = '1000000000000000';
                        //Load upload library and initialize configuration
                        $this->load->library('upload', $config);
                        $this->upload->initialize($config);

                        if ($this->upload->do_upload('photoimg')) {
                            $uploadData = $this->upload->data();

                            $picture = $uploadData['file_name'];
                        } else {
                            $picture = '';
                        }

                        $data = array(
                            'profile_background' => $picture
                        );

                        $update = $this->common->update_data($data, 'freelancer_hire_reg', 'user_id', $session_uid);
                        if ($update) {
                            $path = base_url($this->config->item('free_hire_bg_main_upload_path'));
                            echo $bgSave . '<img src = "' . $path . $picture . '" id = "timelineBGload" class = "headerimage ui-corner-all" style = "top:0px"/>';
                        } else {
                            echo "Fail upload folder with read access.";
                        }
                    } else
                        echo "Image file size max 1 MB";
                } else
                    echo "Invalid file format.";
            } else
                echo "Please select image..!";

            exit;
        }
    }

    public function image_saveBG_ajax() {

        session_start();

        $session_uid = $this->session->userdata('aileenuser');

        if (isset($_POST['position']) && isset($session_uid)) {

            $position = $_POST['position'];

            $data = array(
                'profile_background_position' => $position
            );

            $update = $this->common->update_data($data, 'freelancer_hire_reg', 'user_id', $session_uid);
            if ($update) {

                echo $position;
            }
        }
    }

// cover pic controller

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

    // cover pic end
    // cover pic controller

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

    // cover pic end


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

    //reactivate account start

    public function reactivate() {

        $userid = $this->session->userdata('aileenuser');
        $data = array(
            'status' => 1,
            'modify_date' => date('y-m-d h:i:s')
        );

        $updatdata = $this->common->update_data($data, 'freelancer_post_reg', 'user_id', $userid);
        if ($updatdata) {

            redirect('freelancer/freelancer_apply_post', refresh);
        } else {

            redirect('freelancer/reactivate', refresh);
        }
    }

    public function free_invite_user() {
        //echo "hiiiii";
        $postid = $_POST['post_id'];
        $invite_user = $_POST['invited_user'];
        // echo $postid;
        //echo $invite_user;
        $userid = $this->session->userdata('aileenuser');
        $data = array(
            'user_id' => $userid,
            'post_id' => $postid,
            'invite_user_id' => $invite_user,
            'profile' => "freelancer"
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
                'not_from' => 5,
                "not_active" => 1,
                'not_created_date' => date('Y-m-d H:i:s')
            );
            $insert_id = $this->common->insert_data_getid($data, 'notification');
            echo 'Selected';
        } else {
            echo 'error';
        }
    }

//reactivate accont end
// delete portfilio pdf strat

    public function deletepdf() {

        $userid = $this->session->userdata('aileenuser');

        //if user deactive profile then redirect to artistic/index untill active profile start
        $contition_array = array('user_id' => $userid, 'status' => '0', 'is_delete' => '0');

        $free_deactive = $this->data['free_deactive'] = $this->common->select_data_by_condition('freelancer_post_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);

        if ($free_deactive) {
            redirect('freelancer/');
        }
        //if user deactive profile then redirect to artistic/index untill active profile End

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

//pdf delete end
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
        $unique = array_merge($field, $skill, $freelancer_postdata);
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
        $uni = array_merge($skill, $freelancer_postdata, $field, $results_post);
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

}
