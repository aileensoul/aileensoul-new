<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Business_profile extends MY_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->library('form_validation');
        $this->load->model('email_model');
        $this->lang->load('message', 'english');
        $this->load->helper('smiley');
        include ('include.php');
    }

    public function index() {

        $userid = $this->session->userdata('aileenuser');

        $contition_array = array('user_id' => $userid, 'status' => '0');
        $businessdata = $this->common->select_data_by_condition('business_profile', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
        if ($businessdata) {

            $this->load->view('business_profile/reactivate', $this->data);
        } else {
            $userid = $this->session->userdata('aileenuser');

            $contition_array = array('user_id' => $userid, 'is_deleted' => '0', 'status' => '1');
            $userdata = $this->common->select_data_by_condition('business_profile', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

            $contition_array = array('status' => 1);
            $this->data['countries'] = $this->common->select_data_by_condition('countries', $contition_array, $data = '*', $sortby = 'country_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');

            //for gxetting state data
            $contition_array = array('status' => 1);
            $this->data['states'] = $this->common->select_data_by_condition('states', $contition_array, $data = '*', $sortby = 'state_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');


            //for getting city data
            $contition_array = array('status' => 1);
            $this->data['cities'] = $this->common->select_data_by_condition('cities', $contition_array, $data = '*', $sortby = 'city_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');

            if (count($userdata) > 0) {

                if ($userdata[0]['business_step'] == 1) {
                    redirect('business_profile/contact_information', refresh);
                } else if ($userdata[0]['business_step'] == 2) {
                    redirect('business_profile/description', refresh);
                } else if ($userdata[0]['business_step'] == 3) {
                    redirect('business_profile/image', refresh);
                } else if ($userdata[0]['business_step'] == 4) {
                    //redirect('business_profile/addmore', refresh);
                    redirect('business_profile/business_profile_post', refresh);
                } else if ($userdata[0]['business_step'] == 5) {
                    redirect('business_profile/business_profile_post', refresh);
                }
            } else {
                $this->load->view('business_profile/business_info', $this->data);
            }
        }
    }

    public function ajax_data() {

        //dependentacy industrial and sub industriyal start


        if (isset($_POST["industry_id"]) && !empty($_POST["industry_id"])) {
            //Get all state data
            $contition_array = array('industry_id' => $_POST["industry_id"], 'status' => 1);
            $subindustriyaldata = $this->data['subindustriyaldata'] = $this->common->select_data_by_condition('sub_industry_type', $contition_array, $data = '*', $sortby = 'sub_industry_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');


            //Count total number of rows
            //Display sub industiyal list
            if (count($subindustriyaldata) > 0) {
                echo '<option value="">Select Sub Industrial</option>';
                foreach ($subindustriyaldata as $st) {
                    echo '<option value="' . $st['sub_industry_id'] . '">' . $st['sub_industry_name'] . '</option>';
                }
            } else {
                echo '<option value="">Subindustriyal not available</option>';
            }
        }

        // dependentacy industrial and sub industriyal end  


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
    }

    public function business_information_update() {
        $userid = $this->session->userdata('aileenuser');

        //if user deactive profile then redirect to business_profile/index untill active profile start
        $contition_array = array('user_id' => $userid, 'status' => '0', 'is_deleted' => '0');

        $business_deactive = $this->data['business_deactive'] = $this->common->select_data_by_condition('business_profile', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);

        if ($business_deactive) {
            redirect('business_profile/');
        }
        //if user deactive profile then redirect to business_profile/index untill active profile End

        $contition_array = array('status' => 1);
        $this->data['countries'] = $this->common->select_data_by_condition('countries', $contition_array, $data = '*', $sortby = 'country_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');


        $contition_array = array('user_id' => $userid, 'is_deleted' => '0', 'status' => '1');
        $userdata = $this->common->select_data_by_condition('business_profile', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        //for getting state data
        $contition_array = array('status' => '1', 'country_id' => $userdata[0]['country']);
        $this->data['states'] = $this->common->select_data_by_condition('states', $contition_array, $data = '*', $sortby = 'state_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');
        // echo "<pre>";print_r($this->data['states']);echo "</pre>";die();
        //for getting city data
        $contition_array = array('status' => '1', 'state_id' => $userdata[0]['state']);
        $this->data['cities'] = $this->common->select_data_by_condition('cities', $contition_array, $data = '*', $sortby = 'city_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');


        if ($userdata) {
            $step = $userdata[0]['business_step'];

            if ($step == 1 || $step > 1) {

                $this->data['country1'] = $userdata[0]['country'];
                $this->data['state1'] = $userdata[0]['state'];
                $this->data['city1'] = $userdata[0]['city'];
                $this->data['companyname1'] = $userdata[0]['company_name'];
                $this->data['pincode1'] = $userdata[0]['pincode'];
                $this->data['address1'] = $userdata[0]['address'];
            }
        }


        $this->load->view('business_profile/business_info', $this->data);
    }

//business automatic retrieve controller start
    public function business() {
        $json = [];


        if (!empty($this->input->get("q"))) {
            $this->db->like('skill', $this->input->get("q"));
            $query = $this->db->select('skill_id as id,skill as text')
                    ->limit(10)
                    ->get("skill");
            $json = $query->result();
        }


        echo json_encode($json);
    }

//business automatic retrieve controller End
    // business prodile slug start

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

    // business slug end

    public function business_information_insert() {


        $userid = $this->session->userdata('aileenuser');

        //if user deactive profile then redirect to business_profile/index untill active profile start
        $contition_array = array('user_id' => $userid, 'status' => '0', 'is_deleted' => '0');

        $business_deactive = $this->data['business_deactive'] = $this->common->select_data_by_condition('business_profile', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);

        if ($business_deactive) {
            redirect('business_profile/');
        }
        //if user deactive profile then redirect to business_profile/index untill active profile End

        if ($this->input->post('next')) {

            $this->form_validation->set_rules('companyname', 'Company Name', 'required');

            $this->form_validation->set_rules('country', 'Country', 'required');
            $this->form_validation->set_rules('state', 'state', 'required');

            $this->form_validation->set_rules('business_address', 'Address', 'required');

            if ($this->form_validation->run() == FALSE) {
                $this->load->view('business_profile/business_info');
            }

            //get data by id only

            $contition_array = array('user_id' => $userid, 'is_deleted' => '0', 'status' => '1');
            $userdata = $this->common->select_data_by_condition('business_profile', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');



            $companyname = $this->input->post('companyname');

            if ($userdata) {
                $data = array(
                    'company_name' => $this->input->post('companyname'),
                    'country' => $this->input->post('country'),
                    'state' => $this->input->post('state'),
                    'city' => $this->input->post('city'),
                    'pincode' => $this->input->post('pincode'),
                    'address' => $this->input->post('business_address'),
                    'user_id' => $userid,
                    'business_slug' => $this->setcategory_slug($companyname, 'business_slug', 'business_profile'),
                    'modified_date' => date('Y-m-d', time()),
                    'status' => 1,
                    'is_deleted' => 0
                );

                $updatdata = $this->common->update_data($data, 'business_profile', 'user_id', $userid);
                if ($updatdata) {

                    $this->session->set_flashdata('success', 'Business information updated successfully');
                    redirect('business_profile/contact_information', refresh);
                } else {
                    $this->session->flashdata('error', 'Sorry!! Your data not inserted');
                    redirect('business_profile', refresh);
                }
            } else {

                $data = array(
                    'company_name' => $this->input->post('companyname'),
                    'country' => $this->input->post('country'),
                    'state' => $this->input->post('state'),
                    'city' => $this->input->post('city'),
                    'pincode' => $this->input->post('pincode'),
                    'address' => $this->input->post('business_address'),
                    'user_id' => $userid,
                    'business_slug' => $this->setcategory_slug($companyname, 'business_slug', 'business_profile'),
                    'created_date' => date('Y-m-d H:i:s', time()),
                    'status' => 1,
                    'is_deleted' => 0,
                    'business_step' => 1
                );



                $insert_id = $this->common->insert_data_getid($data, 'business_profile');
                if ($insert_id) {


                    $this->session->set_flashdata('success', 'Business information updated successfully');
                    redirect('business_profile/contact_information', refresh);
                } else {
                    $this->session->flashdata('error', 'Sorry!! Your data not inserted');
                    redirect('business_profile', refresh);
                }
            }
        }
    }

    public function contact_information() {

        $userid = $this->session->userdata('aileenuser');

        //if user deactive profile then redirect to business_profile/index untill active profile start
        $contition_array = array('user_id' => $userid, 'status' => '0', 'is_deleted' => '0');

        $business_deactive = $this->data['business_deactive'] = $this->common->select_data_by_condition('business_profile', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);

        if ($business_deactive) {
            redirect('business_profile/');
        }
        //if user deactive profile then redirect to business_profile/index untill active profile End

        $contition_array = array('user_id' => $userid, 'is_deleted' => '0', 'status' => '1');
        $userdata = $this->common->select_data_by_condition('business_profile', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        if ($userdata) {
            $step = $userdata[0]['business_step'];

            if ($step == 2 || $step > 2 || ($step >= 1 && $step <= 2)) {
                $this->data['contactname1'] = $userdata[0]['contact_person'];
                $this->data['contactmobile1'] = $userdata[0]['contact_mobile'];
                $this->data['contactemail1'] = $userdata[0]['contact_email'];
                $this->data['contactwebsite1'] = $userdata[0]['contact_website'];
            }
        }



        $this->load->view('business_profile/contact_info', $this->data);
    }

    public function contact_information_insert() {
        $userid = $this->session->userdata('aileenuser');

        //if user deactive profile then redirect to business_profile/index untill active profile start
        $contition_array = array('user_id' => $userid, 'status' => '0', 'is_deleted' => '0');

        $business_deactive = $this->data['business_deactive'] = $this->common->select_data_by_condition('business_profile', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);

        if ($business_deactive) {
            redirect('business_profile/');
        }
        //if user deactive profile then redirect to business_profile/index untill active profile End


        if ($this->input->post('previous')) {
            redirect('business_profile', refresh);
        }


        $this->form_validation->set_rules('contactname', 'Contact person', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');


        if ($this->form_validation->run() == FALSE) {
            $this->load->view('business_profile/contact_info');
        } else {


            $contition_array = array('user_id' => $userid, 'status' => '1');
            $userdata = $this->common->select_data_by_condition('business_profile', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

            if ($userdata[0]['business_step'] == 4) {
                $data = array(
                    'contact_person' => $this->input->post('contactname'),
                    'contact_mobile' => $this->input->post('contactmobile'),
                    'contact_email' => $this->input->post('email'),
                    'contact_website' => $this->input->post('contactwebsite'),
                    'modified_date' => date('Y-m-d', time()),
                        //'business_step' => 2
                );
            } else {

                $data = array(
                    'contact_person' => $this->input->post('contactname'),
                    'contact_mobile' => $this->input->post('contactmobile'),
                    'contact_email' => $this->input->post('email'),
                    'contact_website' => $this->input->post('contactwebsite'),
                    'modified_date' => date('Y-m-d', time()),
                    'business_step' => 2
                );
            }
            $updatdata = $this->common->update_data($data, 'business_profile', 'user_id', $userid);


            if ($updatdata) {
                $this->session->set_flashdata('success', 'Contact information updated successfully');
                redirect('business_profile/description', refresh);
            } else {
                $this->session->flashdata('error', 'Your data not inserted');
                redirect('business_profile/contact_information', refresh);
            }
        }
    }

    public function check_email() {


        $email = $this->input->post('email');

        $userid = $this->session->userdata('aileenuser');

        $contition_array = array('user_id' => $userid, 'is_deleted' => '0', 'status' => '1');
        $userdata = $this->common->select_data_by_condition('business_profile', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        $email1 = $userdata[0]['contact_email'];

        if ($email1) {
            $condition_array = array('is_deleted' => '0', 'user_id !=' => $userid, 'status' => '1', 'business_step' => 4);

            $check_result = $this->common->check_unique_avalibility('business_profile', 'contact_email', $email, '', '', $condition_array);
        } else {

            $condition_array = array('is_deleted' => '0', 'status' => '1', 'business_step' => 4);

            $check_result = $this->common->check_unique_avalibility('business_profile', 'contact_email', $email, '', '', $condition_array);
        }

        if ($check_result) {
            echo 'true';
            die();
        } else {
            echo 'false';
            die();
        }
    }

    public function description() {

        $userid = $this->session->userdata('aileenuser');

        //if user deactive profile then redirect to business_profile/index untill active profile start
        $contition_array = array('user_id' => $userid, 'status' => '0', 'is_deleted' => '0');

        $business_deactive = $this->data['business_deactive'] = $this->common->select_data_by_condition('business_profile', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);

        if ($business_deactive) {
            redirect('business_profile/');
        }
        //if user deactive profile then redirect to business_profile/index untill active profile End

        $contition_array = array('user_id' => $userid, 'is_deleted' => '0', 'status' => '1');
        $userdata = $this->common->select_data_by_condition('business_profile', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');


        $contition_array = array('status' => 1);
        $this->data['industriyaldata'] = $this->common->select_data_by_condition('industry_type', $contition_array, $data = '*', $sortby = 'industry_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');


        $this->data['businesstypedata'] = $this->common->select_data_by_condition('business_type', $contition_array, $data = '*', $sortby = 'business_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');



        if ($userdata) {
            $step = $userdata[0]['business_step'];

            if ($step == 3 || ($step >= 1 && $step <= 3) || $step > 3) {
                $this->data['business_type1'] = $userdata[0]['business_type'];
                $this->data['industriyal1'] = $userdata[0]['industriyal'];
                $this->data['subindustriyal1'] = $userdata[0]['subindustriyal'];
                $this->data['business_details1'] = $userdata[0]['details'];
                $this->data['other_business'] = $userdata[0]['other_business_type'];
                $this->data['other_industry'] = $userdata[0]['other_industrial'];
            }
        }
        //cho "<pre>"; print_r($this->data['industriyal1']); die();

        $this->load->view('business_profile/description', $this->data);
    }

    public function description_insert() {

        $userid = $this->session->userdata('aileenuser');

//if user deactive profile then redirect to business_profile/index untill active profile start
        $contition_array = array('user_id' => $userid, 'status' => '0', 'is_deleted' => '0');

        $business_deactive = $this->data['business_deactive'] = $this->common->select_data_by_condition('business_profile', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);

        if ($business_deactive) {
            redirect('business_profile/');
        }
        //if user deactive profile then redirect to business_profile/index untill active profile End

        if ($this->input->post('next')) {

            $this->form_validation->set_rules('business_type', 'Business Type', 'required');
            $this->form_validation->set_rules('industriyal', 'Industriyal', 'required');

            $this->form_validation->set_rules('business_details', 'Details', 'required');

            if ($this->form_validation->run() == FALSE) {
                $this->load->view('business_profile/description');
            } else {


                $contition_array = array('user_id' => $userid, 'status' => '1');
                $userdata = $this->common->select_data_by_condition('business_profile', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

                if ($userdata[0]['business_step'] == 4) {
                    $data = array(
                        'business_type' => $this->input->post('business_type'),
                        'industriyal' => $this->input->post('industriyal'),
                        'subindustriyal' => $this->input->post('subindustriyal'),
                        'other_business_type' => $this->input->post('bustype'),
                        'other_industrial' => $this->input->post('indtype'),
                        'details' => $this->input->post('business_details'),
                        'modified_date' => date('Y-m-d', time()),
                            //'business_step' => 3
                    );
                } else {
                    $data = array(
                        'business_type' => $this->input->post('business_type'),
                        'industriyal' => $this->input->post('industriyal'),
                        'subindustriyal' => $this->input->post('subindustriyal'),
                        'other_business_type' => $this->input->post('bustype'),
                        'other_industrial' => $this->input->post('indtype'),
                        'details' => $this->input->post('business_details'),
                        'modified_date' => date('Y-m-d', time()),
                        'business_step' => 3
                    );
                }
                $updatdata = $this->common->update_data($data, 'business_profile', 'user_id', $userid);

                if ($updatdata) {
                    $this->session->set_flashdata('success', 'Description updated successfully');
                    redirect('business_profile/image', refresh);
                } else {
                    $this->session->flashdata('error', 'Your data not inserted');
                    redirect('business_profile/description', refresh);
                }
            }
        }
    }

    public function image() {

        $userid = $this->session->userdata('aileenuser');

        //if user deactive profile then redirect to business_profile/index untill active profile start
        $contition_array = array('user_id' => $userid, 'status' => '0', 'is_deleted' => '0');

        $business_deactive = $this->data['business_deactive'] = $this->common->select_data_by_condition('business_profile', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);

        if ($business_deactive) {
            redirect('business_profile/');
        }
        //if user deactive profile then redirect to business_profile/index untill active profile End

        $contition_array = array('user_id' => $userid, 'is_deleted' => '0', 'status' => '1');
        $userdata = $this->common->select_data_by_condition('business_profile', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        if ($userdata) {
            $step = $userdata[0]['business_step'];

            if ($step == 4 || ($step >= 1 && $step <= 4) || $step > 4) {
                $contition_array = array('user_id' => $userid, 'is_delete' => '0');
                $this->data['busimage'] = $this->common->select_data_by_condition('bus_image', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
            }
        }


        $this->load->view('business_profile/image', $this->data);
    }

    public function image_insert() {

        $userdata = $this->session->userdata();
        $userid = $this->session->userdata('aileenuser');

        $contition_array = array('user_id' => $userid, 'status' => '1', 'is_deleted' => '0');

        $busin_step_redirect = $this->common->select_data_by_condition('business_profile', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);

        //if user deactive profile then redirect to business_profile/index untill active profile start
        $contition_array = array('user_id' => $userid, 'status' => '0', 'is_deleted' => '0');

        $business_deactive = $this->data['business_deactive'] = $this->common->select_data_by_condition('business_profile', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);

        if ($business_deactive) {
            redirect('business_profile/');
        }
        //if user deactive profile then redirect to business_profile/index untill active profile End

        $contition_array = array('user_id' => $userid, 'is_deleted' => '0');
        $business_slug = $this->common->select_data_by_condition('business_profile', $contition_array, $data = 'business_slug', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
        $business_slug = $business_slug[0]['business_slug'];

        $count1 = count($this->input->post('filedata'));

        for ($x = 0; $x < $count1; $x++) {
            if ($_POST['filedata'][$x] == 'old') {


                $data = array(
                    'image_name' => $_POST['filename'][$x],
                );
                $updatdata = $this->common->update_data($data, 'bus_image', 'image_id', $_POST['imageid'][$x]);
            }

            if ($_POST['filedata'][$x]) {
                $data = array(
                    'modified_date' => date('Y-m-d', time()),
                    'business_step' => 4
                );

                $updatdata = $this->common->update_data($data, 'business_profile', 'user_id', $userid);
            } else {
                $data = array(
                    'modified_date' => date('Y-m-d', time()),
                    'business_step' => 4
                );

                $updatdata = $this->common->update_data($data, 'business_profile', 'user_id', $userid);
            }
        }


        $contition_array = array('user_id' => $userid, 'is_delete' => '0');
        $userdatacon = $this->common->select_data_by_condition('bus_image', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');



        if ($this->input->post('next') || $this->input->post('submit')) {


            // changes start 17-5 

            $config = array(
                'upload_path' => $this->config->item('bus_profile_main_upload_path'),
                'max_size' => 1024 * 100,
                'allowed_types' => 'gif|jpeg|jpg|png'
            );
            $images = array();
            $this->load->library('upload');

            $files = $_FILES;
            $count = count($_FILES['image1']['name']);

            for ($i = 0; $i < $count; $i++) {

                $_FILES['image1']['name'] = $files['image1']['name'][$i];
                $_FILES['image1']['type'] = $files['image1']['type'][$i];
                $_FILES['image1']['tmp_name'] = $files['image1']['tmp_name'][$i];
                $_FILES['image1']['error'] = $files['image1']['error'][$i];
                $_FILES['image1']['size'] = $files['image1']['size'][$i];

                $fileName = $_FILES['image1']['name'];
                $images[] = $fileName;
                $config['file_name'] = $fileName;
                // echo $config['file_name'];die();

                $this->upload->initialize($config);
                $this->upload->do_upload();

                if ($this->upload->do_upload('image1')) {

                    // $fileData = $this->upload->data();
                    // $uploadData[$i]['file_name'] = $fileData['file_name'];
                    $response['result'][] = $this->upload->data();

                    $image_width = $response['result'][$i]['image_width'];
                    $image_height = $response['result'][$i]['image_height'];

                    $thumb_image_width = $this->config->item('bus_detail_thumb_width');
                    $thumb_image_height = $this->config->item('bus_detail_thumb_height');

                    if ($image_width > $image_height) {
                        $n_h = $thumb_image_height;
                        $image_ratio = $image_height / $n_h;
                        $n_w = round($image_width / $image_ratio);
                    } else if ($image_width < $image_height) {
                        $n_w = $thumb_image_width;
                        $image_ratio = $image_width / $n_w;
                        $n_h = round($image_height / $image_ratio);
                    } else {
                        $n_w = $thumb_image_width;
                        $n_h = $thumb_image_height;
                    }

                    $business_profile_post_thumb[$i]['image_library'] = 'gd2';
                    $business_profile_post_thumb[$i]['source_image'] = $this->config->item('bus_profile_main_upload_path') . $response['result'][$i]['file_name'];
                    $business_profile_post_thumb[$i]['new_image'] = $this->config->item('bus_profile_thumb_upload_path') . $response['result'][$i]['file_name'];
                    $business_profile_post_thumb[$i]['create_thumb'] = TRUE;
                    $business_profile_post_thumb[$i]['maintain_ratio'] = FALSE;
                    $business_profile_post_thumb[$i]['thumb_marker'] = '';
                    $business_profile_post_thumb[$i]['width'] = $n_w;
                    $business_profile_post_thumb[$i]['height'] = $n_h;
                    $business_profile_post_thumb[$i]['quality'] = "100%";
                    $business_profile_post_thumb[$i]['x_axis'] = '0';
                    $business_profile_post_thumb[$i]['y_axis'] = '0';
                    $instanse = "image_$i";
                    //Loading Image Library
                    $this->load->library('image_lib', $business_profile_post_thumb[$i], $instanse);
                    $dataimage = $response['result'][$i]['file_name'];
                    //Creating Thumbnail
                    $this->$instanse->resize();
                    /* CROP */
                    // reconfigure the image lib for cropping
                    $conf_new[$i] = array(
                        'image_library' => 'gd2',
                        'source_image' => $business_profile_post_thumb[$i]['new_image'],
                        'create_thumb' => FALSE,
                        'maintain_ratio' => FALSE,
                        'width' => $thumb_image_width,
                        'height' => $thumb_image_height
                    );

                    $conf_new[$i]['new_image'] = $this->config->item('bus_profile_thumb_upload_path') . $response['result'][$i]['file_name'];

                    $left = ($n_w / 2) - ($thumb_image_width / 2);
                    $top = ($n_h / 2) - ($thumb_image_height / 2);

                    $conf_new[$i]['x_axis'] = $left;
                    $conf_new[$i]['y_axis'] = $top;

                    $instanse1 = "image1_$i";
                    //Loading Image Library
                    $this->load->library('image_lib', $conf_new[$i], $instanse1);
                    $dataimage = $response['result'][$i]['file_name'];
                    //Creating Thumbnail
                    $this->$instanse1->crop();

                    /* CROP */


                    $response['error'][] = $thumberror = $this->$instanse->display_errors();

                    $return['data'][] = $imgdata;
                    $return['status'] = "success";
                    $return['msg'] = sprintf($this->lang->line('success_item_added'), "Image", "uploaded");
                } else {
                    $dataimage = '';
                }



                if ($dataimage) {
//echo $uploadData[$i]['file_name'];
                    $data = array(
                        'image_name' => $dataimage,
                        'user_id' => $userid,
                        'created_date' => date('Y-m-d H:i:s'),
                        'is_delete' => 0
                    );

                    $insert_id = $this->common->insert_data_getid($data, 'bus_image');
                }


                if ($dataimage) {
                    $data = array(
                        'modified_date' => date('Y-m-d', time()),
                        'business_step' => 4
                    );

                    $updatdata = $this->common->update_data($data, 'business_profile', 'user_id', $userid);
                } else {
                    $data = array(
                        'modified_date' => date('Y-m-d', time()),
                        'business_step' => 4
                    );

                    $updatdata = $this->common->update_data($data, 'business_profile', 'user_id', $userid);
                }
            }
            // Multiple Image insert code End
            // changes end 17-5    

            if ($updatdata) {
                $this->session->set_flashdata('success', 'Image updated successfully');

                if ($busin_step_redirect[0]['business_step'] == 4) {
                    if ($business_slug != '') {
                        redirect('business_profile/business_resume/' . $business_slug, refresh);
                    } else {
                        redirect('business_profile/business_resume', refresh);
                    }
                } else {
                    redirect('business_profile/business_profile_post', refresh);
                }
            } else {
                $this->session->flashdata('error', 'Your data not inserted');
                redirect('business_profile/image', refresh);
            }
        }
    }

//end edit skills


    public function addmore() {
        $userid = $this->session->userdata('aileenuser');

        //if user deactive profile then redirect to business_profile/index untill active profile start
        $contition_array = array('user_id' => $userid, 'status' => '0', 'is_deleted' => '0');

        $business_deactive = $this->data['business_deactive'] = $this->common->select_data_by_condition('business_profile', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);

        if ($business_deactive) {
            redirect('business_profile/');
        }
        //if user deactive profile then redirect to business_profile/index untill active profile End

        $contition_array = array('user_id' => $userid, 'is_deleted' => '0', 'status' => '1');
        $userdata = $this->common->select_data_by_condition('business_profile', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        if ($userdata) {
            $step = $userdata[0]['business_step'];

            if ($step == 5 || ($step >= 1 && $step <= 5) || $step > 5) {
                $this->data['addmore1'] = $userdata[0]['addmore'];
            }
        }


        $this->load->view('business_profile/addmore', $this->data);
    }

    public function addmore_insert() {
        $userid = $this->session->userdata('aileenuser');

        //if user deactive profile then redirect to business_profile/index untill active profile start
        $contition_array = array('user_id' => $userid, 'status' => '0', 'is_deleted' => '0');

        $business_deactive = $this->data['business_deactive'] = $this->common->select_data_by_condition('business_profile', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);

        if ($business_deactive) {
            redirect('business_profile/');
        }
        //if user deactive profile then redirect to business_profile/index untill active profile End

        $data = array(
            'addmore' => $this->input->post('addmore'),
            'modified_date' => date('Y-m-d', time()),
            'business_step' => 5
        );

        $updatdata = $this->common->update_data($data, 'business_profile', 'user_id', $userid);

        if ($updatdata) {

            redirect('business_profile/business_profile_post', refresh);
        } else {
            $this->session->flashdata('error', 'Your data not inserted');
            redirect('business_profile/addmore', refresh);
        }
    }

//business_profile_post start

    public function business_profile_post() {

        $userid = $this->session->userdata('aileenuser');

        $user_name = $this->session->userdata('user_name');

        //if user deactive profile then redirect to business_profile/index untill active profile start
        $contition_array = array('user_id' => $userid, 'status' => '0', 'is_deleted' => '0');

        $business_deactive = $this->data['business_deactive'] = $this->common->select_data_by_condition('business_profile', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);

        if ($business_deactive) {
            redirect('business_profile/');
        }
        //if user deactive profile then redirect to business_profile/index untill active profile End


        $contition_array = array('user_id' => $userid, 'status' => '1', 'business_step' => '4');
        $this->data['businessdata'] = $this->common->select_data_by_condition('business_profile', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        //echo "<pre>"; print_r($this->data['businessdata']); die(); 

        $business_profile_id = $this->data['businessdata'][0]['business_profile_id'];

        $contition_array = array('is_deleted' => 0, 'status' => 1, 'user_id !=' => $userid, 'business_step' => 4);
        $userlist = $this->data['userlist'] = $this->common->select_data_by_condition('business_profile', $contition_array, $data = '*', $sortby = 'business_profile_id', $orderby = 'DESC', $limit = '', $offset = '', $join_str = array(), $groupby = '');
//echo '<pre>';
//print_r($userlist);
//exit;
        //echo $business_profile_id; die();
//userlist for followdata strat
        // using category             
        $industriyal = $this->data['businessdata'][0]['industriyal'];
        foreach ($userlist as $rowcategory) {

            if ($industriyal == $rowcategory['industriyal']) {
                $userlistcategory[] = $rowcategory;
            }
        }

        $this->data['userlistview1'] = $userlistcategory;

//using city 


        $businessregcity = $this->data['businessdata'][0]['city'];

        $contition_array = array('is_deleted' => 0, 'status' => 1, 'user_id !=' => $userid, 'industriyal !=' => $industriyal, 'business_step' => 4);
        $userlist2 = $this->data['userlist2'] = $this->common->select_data_by_condition('business_profile', $contition_array, $data = '*', $sortby = 'business_profile_id', $orderby = 'DESC', $limit = '', $offset = '', $join_str = array(), $groupby = '');


        foreach ($userlist2 as $rowcity) {



            if ($businessregcity == $rowcity['city']) {
                $userlistcity[] = $rowcity;
            }
        }

        $this->data['userlistview2'] = $userlistcity;

// using state

        $businessregstate = $this->data['businessdata'][0]['state'];

        $contition_array = array('is_deleted' => 0, 'status' => 1, 'user_id !=' => $userid, 'industriyal !=' => $industriyal, 'city !=' => $businessregcity, 'business_step' => 4);
        $userlist3 = $this->data['userlist3'] = $this->common->select_data_by_condition('business_profile', $contition_array, $data = '*', $sortby = 'business_profile_id', $orderby = 'DESC', $limit = '', $offset = '', $join_str = array(), $groupby = '');



        foreach ($userlist3 as $rowstate) {



            if ($businessregstate == $rowstate['state']) {
                $userliststate[] = $rowstate;
            }
        }


        $this->data['userlistview3'] = $userliststate;

// using 3 user 

        $contition_array = array('is_deleted' => 0, 'status' => 1, 'user_id !=' => $userid, 'industriyal !=' => $industriyal, 'city !=' => $businessregcity, 'state !=' => $businessregstate, 'business_step' => 4);
        $userlastview = $this->data['userlastview'] = $this->common->select_data_by_condition('business_profile', $contition_array, $data = '*', $sortby = 'business_profile_id', $orderby = 'DESC', $limit = '', $offset = '', $join_str = array(), $groupby = '');


        $this->data['userlistview4'] = $userlastview;


//userlist for followdata end
//data fatch using follower start

        $contition_array = array('follow_from' => $business_profile_id, 'follow_status' => '1', 'follow_type' => '2');

        $followerdata = $this->data['followerdata'] = $this->common->select_data_by_condition('follow', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        //echo "<pre>" ; print_r($this->data['followerdata']); die();

        foreach ($followerdata as $fdata) {

            $contition_array = array('business_profile_id' => $fdata['follow_to'], 'business_step' => 4, 'business_profile.status' => 1);

            $this->data['business_data'] = $this->common->select_data_by_condition('business_profile', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

            // echo "<pre>" ; print_r($this->data['business_data']); die();

            $business_userid = $this->data['business_data'][0]['user_id'];
            //echo $business_userid; die();
            $contition_array = array('user_id' => $business_userid, 'status' => '1', 'is_delete' => '0');

            $this->data['business_profile_data'] = $this->common->select_data_by_condition('business_profile_post', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

            //echo "<pre>"; print_r($this->data['business_profile_data']) ; die();

            $followerabc[] = $this->data['business_profile_data'];
        }
        //echo "<pre>" ; print_r($followerabc); die();
//data fatch using follower end
//data fatch using industriyal start

        $userselectindustriyal = $this->data['businessdata'][0]['industriyal'];

        $contition_array = array('industriyal' => $userselectindustriyal, 'status' => '1', 'business_step' => 4);
        $businessprofiledata = $this->data['businessprofiledata'] = $this->common->select_data_by_condition('business_profile', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
        // echo "<pre>"; print_r( $businessprofiledata); die();



        foreach ($businessprofiledata as $fdata) {


            $contition_array = array('business_profile_post.user_id' => $fdata['user_id'], 'business_profile_post.status' => '1', 'business_profile_post.user_id !=' => $userid, 'is_delete' => '0');

            $this->data['business_data'] = $this->common->select_data_by_condition('business_profile_post', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
            $industriyalabc[] = $this->data['business_data'];
        }
//data fatch using industriyal end
//data fatch using login user last post start

        $condition_array = array('user_id' => $userid, 'status' => '1', 'is_delete' => '0');

        $business_datauser = $this->data['business_datauser'] = $this->common->select_data_by_condition('business_profile_post', $condition_array, $data = '*', $sortby = 'business_profile_post_id', $orderby = 'DESC', $limit = '', $offset = '', $join_str = array(), $groupby = '');
        $userabc[][] = $this->data['business_datauser'][0];



//data fatch using login user last post end
//array merge and get unique value  


        if (count($industriyalabc) == 0 && count($business_datauser) != 0) {

            $unique = $userabc;
        } elseif (count($business_datauser) == 0 && count($industriyalabc) != 0) {
            $unique = $industriyalabc;
        } elseif (count($business_datauser) != 0 && count($industriyalabc) != 0) {
            $unique = array_merge($industriyalabc, $userabc);
        }

        //echo "<pre>"; print_r($unique); die();

        if (count($followerabc) == 0 && count($unique) != 0) {
            $unique_user = $unique;
        } elseif (count($unique) == 0 && count($followerabc) != 0) {
            $unique_user = $followerabc;
        } else {
            $unique_user = array_merge($unique, $followerabc);
        }



        foreach ($unique_user as $ke => $arr) {
            foreach ($arr as $k => $v) {

                $postdata[] = $v;
            }
        }

        $postdata = array_unique($postdata, SORT_REGULAR);


        $new = array();
        foreach ($postdata as $value) {
            $new[$value['business_profile_post_id']] = $value;
        }

        $post = array();

        foreach ($new as $key => $row) {
            $post[$key] = $row['business_profile_post_id'];
        }
        array_multisort($post, SORT_DESC, $new);

        $this->data['businessprofiledatapost'] = $new;


        if ($this->data['businessdata']) {

            $this->load->view('business_profile/business_profile_post', $this->data);
        } else {
            redirect('business_profile/');
        }
    }

    public function business_profile_manage_post($id = "") {

        // manage post start
        $userid = $this->session->userdata('aileenuser');
        $user_name = $this->session->userdata('user_name');

        //if user deactive profile then redirect to business_profile/index untill active profile start
        $contition_array = array('user_id' => $userid, 'status' => '0', 'is_deleted' => '0');

        $business_deactive = $this->data['business_deactive'] = $this->common->select_data_by_condition('business_profile', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);

        if ($business_deactive) {
            redirect('business_profile/');
        }
        //if user deactive profile then redirect to business_profile/index untill active profile End

        $contition_array = array('user_id' => $userid, 'status' => '1');
        $this->data['slug_data'] = $this->common->select_data_by_condition('business_profile', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        $slug_id = $this->data['slug_data'][0]['business_slug'];
        if ($id == $slug_id || $id == '') {

            $contition_array = array('business_slug' => $slug_id, 'status' => '1', 'business_step' => '4');
            $businessdata1 = $this->data['businessdata1'] = $this->common->select_data_by_condition('business_profile', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

            $contition_array = array('user_id' => $businessdata1[0]['user_id'], 'status' => 1, 'is_delete' => '0');
            $this->data['business_profile_data'] = $this->common->select_data_by_condition('business_profile_post', $contition_array, $data, $sortby = 'business_profile_post_id', $orderby = 'DESC', $limit = '', $offset = '', $join_str = array(), $groupby = '');

            //echo "<pre>"; print_r($this->data['business_profile_data']); die();
        } else {

            $this->bus_avail_check($id);

            $contition_array = array('business_slug' => $id, 'status' => '1', 'business_step' => 4);
            $businessdata1 = $this->data['businessdata1'] = $this->common->select_data_by_condition('business_profile', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

            $contition_array = array('user_id' => $businessdata1[0]['user_id'], 'status' => 1, 'is_delete' => '0');


            $this->data['business_profile_data'] = $this->common->select_data_by_condition('business_profile_post', $contition_array, $data, $sortby = 'business_profile_post_id', $orderby = 'DESC', $limit = '', $offset = '', $join_str = array(), $groupby = '');

            //echo "<pre>"; print_r($this->data['business_profile_data']); die();
        }

        //manage post end

        if (!$this->data['businessdata1'] && !$this->data['business_profile_data']) { //echo "22222222"; die();
            $this->load->view('business_profile/notavalible');
        } else if ($this->data['businessdata1'][0]['business_step'] != 4) {   //echo "hii"; die();
            redirect('business_profile/');
        } else {
            $this->load->view('business_profile/business_profile_manage_post', $this->data);
        }

        // save post end       
    }

    public function business_profile_deletepost() {

        $id = $_POST["business_profile_post_id"];
        //echo $id; die();
        $data = array(
            'is_delete' => 1,
            'modify_date' => date('Y-m-d', time())
        );


        $updatdata = $this->common->update_data($data, 'business_profile_post', 'business_profile_post_id', $id);

        $dataimage = array(
            'is_deleted' => 0,
            'modify_date' => date('Y-m-d', time())
        );

        //echo "<pre>"; print_r($dataimage); die();
        $updatdata = $this->common->update_data($dataimage, 'post_image', 'post_id', $id);

        $this->data['userid'] = $userid = $this->session->userdata('aileenuser');


        $contition_array = array('user_id' => $userid, 'status' => 1, 'is_delete' => '0');
        $otherdata = $this->common->select_data_by_condition('business_profile_post', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        $datacount = count($otherdata);



        if (count($otherdata) == 0) {
            $notfound = '<div class="art_no_post_avl" id="art_no_post_avl">
                                        <h3>Business Post</h3>
                                        <div class="art-img-nn">
                                            <div class="art_no_post_img">

                                                <img src="' . base_url('img/bui-no.png') . '">

                                            </div>
                                            <div class="art_no_post_text">
                                                No Post Available.
                                            </div>
                                        </div>
                                    </div>';

            $notvideo = 'Video Not Available';
            $notaudio = 'Audio Not Available';
            $notpdf = 'Pdf Not Available';
            $notphoto = 'Photo Not Available';
        }

        echo json_encode(
                array(
                    "notfound" => $notfound,
                    "notcount" => $datacount,
                    "notvideo" => $notvideo,
                    "notaudio" => $notaudio,
                    "notpdf" => $notpdf,
                    "notphoto" => $notphoto,
        ));
    }

    public function business_profile_deleteforpost() {



        $this->data['userid'] = $userid = $this->session->userdata('aileenuser');

        $id = $_POST["business_profile_post_id"];
        //echo $id; die();
        $data = array(
            'is_delete' => 1,
            'modify_date' => date('Y-m-d', time())
        );

//echo "<pre>"; print_r($data); die();
        $updatdata = $this->common->update_data($data, 'business_profile_post', 'business_profile_post_id', $id);

        $dataimage = array(
            'is_deleted' => 0,
            'modify_date' => date('Y-m-d', time())
        );

        //echo "<pre>"; print_r($dataimage); die();
        $updatdata = $this->common->update_data($dataimage, 'post_image', 'post_id', $id);

// for post count start



        $contition_array = array('user_id' => $userid, 'status' => '1');
        $this->data['businessdata'] = $this->common->select_data_by_condition('business_profile', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        //echo "<pre>"; print_r($this->data['businessdata']); die(); 

        $business_profile_id = $this->data['businessdata'][0]['business_profile_id'];




        $contition_array = array('follow_from' => $business_profile_id, 'follow_status' => '1', 'follow_type' => '2');

        $followerdata = $this->data['followerdata'] = $this->common->select_data_by_condition('follow', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        //echo "<pre>" ; print_r($this->data['followerdata']); die();

        foreach ($followerdata as $fdata) {

            $contition_array = array('business_profile_id' => $fdata['follow_to'], 'business_step' => 4);

            $this->data['business_data'] = $this->common->select_data_by_condition('business_profile', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

            // echo "<pre>" ; print_r($this->data['business_data']); die();

            $business_userid = $this->data['business_data'][0]['user_id'];
            //echo $business_userid; die();
            $contition_array = array('user_id' => $business_userid, 'status' => '1', 'is_delete' => '0');

            $this->data['business_profile_data'] = $this->common->select_data_by_condition('business_profile_post', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

            //echo "<pre>"; print_r($this->data['business_profile_data']) ; die();

            $followerabc[] = $this->data['business_profile_data'];
        }
        //echo "<pre>" ; print_r($followerabc); die();
//data fatch using follower end
//data fatch using industriyal start

        $userselectindustriyal = $this->data['businessdata'][0]['industriyal'];

        $contition_array = array('industriyal' => $userselectindustriyal, 'status' => '1', 'business_step' => 4);
        $businessprofiledata = $this->data['businessprofiledata'] = $this->common->select_data_by_condition('business_profile', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
        // echo "<pre>"; print_r( $businessprofiledata); die();



        foreach ($businessprofiledata as $fdata) {


            $contition_array = array('business_profile_post.user_id' => $fdata['user_id'], 'business_profile_post.status' => '1', 'business_profile_post.user_id !=' => $userid, 'is_delete' => '0');

            $this->data['business_data'] = $this->common->select_data_by_condition('business_profile_post', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
            $industriyalabc[] = $this->data['business_data'];
        }
//data fatch using industriyal end
//data fatch using login user last post start

        $condition_array = array('user_id' => $userid, 'status' => '1', 'is_delete' => '0');

        $business_datauser = $this->data['business_datauser'] = $this->common->select_data_by_condition('business_profile_post', $condition_array, $data = '*', $sortby = 'business_profile_post_id', $orderby = 'DESC', $limit = '', $offset = '', $join_str = array(), $groupby = '');
        $userabc[][] = $this->data['business_datauser'][0];



//data fatch using login user last post end
//array merge and get unique value  


        if (count($industriyalabc) == 0 && count($business_datauser) != 0) {

            $unique = $userabc;
        } elseif (count($business_datauser) == 0 && count($industriyalabc) != 0) {
            $unique = $industriyalabc;
        } elseif (count($business_datauser) != 0 && count($industriyalabc) != 0) {
            $unique = array_merge($industriyalabc, $userabc);
        }

        //echo "<pre>"; print_r($unique); die();

        if (count($followerabc) == 0 && count($unique) != 0) {
            $unique_user = $unique;
        } elseif (count($unique) == 0 && count($followerabc) != 0) {
            $unique_user = $followerabc;
        } else {
            $unique_user = array_merge($unique, $followerabc);
        }



        foreach ($unique_user as $ke => $arr) {
            foreach ($arr as $k => $v) {

                $postdata[] = $v;
            }
        }

        $postdata = array_unique($postdata, SORT_REGULAR);


        $new = array();
        foreach ($postdata as $value) {
            $new[$value['business_profile_post_id']] = $value;
        }

        $post = array();

        foreach ($new as $key => $row) {

            $post[$key] = $row['business_profile_post_id'];
        }
        array_multisort($post, SORT_DESC, $new);

        $otherdata = $new;


// for count end


        if (count($otherdata) > 0) {

            foreach ($otherdata as $row) {
                $userid = $this->session->userdata('aileenuser');
                $contition_array = array('business_profile_post_id' => $row['business_profile_post_id'], 'status' => '1');
                $businessdelete = $this->data['businessdelete'] = $this->common->select_data_by_condition('business_profile_post', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

                $contition_array = array('user_id' => $row['user_id'], 'status' => '1');
                $businessdata = $this->common->select_data_by_condition('business_profile', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

                $likeuserarray = explode(',', $businessdelete[0]['delete_post']);
                if (!in_array($userid, $likeuserarray)) {
                    
                } else {
                    $count[] = "abc";
                }
            }
        }

        if (count($otherdata) > 0) {
            if (count($count) == count($otherdata)) {

                $datacount = "count";


                $notfound = '<div class="art_no_post_avl" id="art_no_post_avl">
                                        <h3>Business Post</h3>
                                        <div class="art-img-nn">
                                            <div class="art_no_post_img">

                                                <img src="' . base_url('img/bui-no.png') . '">

                                            </div>
                                            <div class="art_no_post_text">
                                                No Post Available.
                                            </div>
                                        </div>
                                    </div>';
            }
        } else {

            $datacount = "count";

            $notfound = '<div class="art_no_post_avl" id="art_no_post_avl">
                                        <h3>Business Post</h3>
                                        <div class="art-img-nn">
                                            <div class="art_no_post_img">

                                                <img src="' . base_url('img/bui-no.png') . '">

                                            </div>
                                            <div class="art_no_post_text">
                                                No Post Available.
                                            </div>
                                        </div>
                                    </div>';
        }

        echo json_encode(
                array(
                    "notfound" => $notfound,
                    "notcount" => $datacount,
        ));
    }

    public function business_profile_addpost() 