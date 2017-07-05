<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Business_profile extends MY_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->library('form_validation');
        $this->load->model('email_model');

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

            //for getting state data
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

        $contition_array = array('status' => 1);
        $this->data['countries'] = $this->common->select_data_by_condition('countries', $contition_array, $data = '*', $sortby = 'country_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        //for getting state data
        $contition_array = array('status' => 1);
        $this->data['states'] = $this->common->select_data_by_condition('states', $contition_array, $data = '*', $sortby = 'state_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');
        // echo "<pre>";print_r($this->data['states']);echo "</pre>";die();
        //for getting city data
        $contition_array = array('status' => 1);
        $this->data['cities'] = $this->common->select_data_by_condition('cities', $contition_array, $data = '*', $sortby = 'city_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');


        $contition_array = array('user_id' => $userid, 'is_deleted' => '0', 'status' => '1');
        $userdata = $this->common->select_data_by_condition('business_profile', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');


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


// code for search
        $contition_array = array('status' => '1', 'is_deleted' => '0');


        $businessdata = $this->data['results'] = $this->common->select_data_by_condition('business_profile', $contition_array, $data = 'company_name,other_industrial,other_business_type', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);
        // echo "<pre>";print_r($businessdata);die();


        $contition_array = array('status' => '1', 'is_delete' => '0');


        $businesstype = $this->data['results'] = $this->common->select_data_by_condition('business_type', $contition_array, $data = 'business_name', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);
        // echo "<pre>";print_r($businesstype);

        $contition_array = array('status' => '1', 'is_delete' => '0');


        $industrytype = $this->data['results'] = $this->common->select_data_by_condition('industry_type', $contition_array, $data = 'industry_name', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);
        // echo "<pre>";print_r($industrytype);die();
        $unique = array_merge($businessdata, $businesstype, $industrytype);
        foreach ($unique as $key => $value) {
            foreach ($value as $ke => $val) {
                if ($val != "") {


                    $result[] = $val;
                }
            }
        }

        $results = array_unique($result);
        foreach ($results as $key => $value) {
            $result1[$key]['label'] = $value;
            $result1[$key]['value'] = $value;
        }

        $this->data['demo'] = array_values($result1);







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
                    'created_date' => date('Y-m-d', time()),
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


        // code for search
        $contition_array = array('status' => '1', 'is_deleted' => '0');


        $businessdata = $this->data['results'] = $this->common->select_data_by_condition('business_profile', $contition_array, $data = 'company_name,other_industrial,other_business_type', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);
        // echo "<pre>";print_r($businessdata);die();


        $contition_array = array('status' => '1', 'is_delete' => '0');


        $businesstype = $this->data['results'] = $this->common->select_data_by_condition('business_type', $contition_array, $data = 'business_name', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);
        // echo "<pre>";print_r($businesstype);

        $contition_array = array('status' => '1', 'is_delete' => '0');


        $industrytype = $this->data['results'] = $this->common->select_data_by_condition('industry_type', $contition_array, $data = 'industry_name', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);
        // echo "<pre>";print_r($industrytype);die();
        $unique = array_merge($businessdata, $businesstype, $industrytype);
        foreach ($unique as $key => $value) {
            foreach ($value as $ke => $val) {
                if ($val != "") {


                    $result[] = $val;
                }
            }
        }

        $results = array_unique($result);
        foreach ($results as $key => $value) {
            $result1[$key]['label'] = $value;
            $result1[$key]['value'] = $value;
        }

        $this->data['demo'] = array_values($result1);






        $this->load->view('business_profile/contact_info', $this->data);
    }

    public function contact_information_insert() {
        $userid = $this->session->userdata('aileenuser');


        if ($this->input->post('previous')) {
            redirect('business_profile', refresh);
        }


        $this->form_validation->set_rules('contactname', 'Contact person', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');


        if ($this->form_validation->run() == FALSE) {
            $this->load->view('business_profile/contact_info');
        } else {
            $data = array(
                'contact_person' => $this->input->post('contactname'),
                'contact_mobile' => $this->input->post('contactmobile'),
                'contact_email' => $this->input->post('email'),
                'contact_website' => $this->input->post('contactwebsite'),
                'modified_date' => date('Y-m-d', time()),
                'business_step' => 2
            );


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
            $condition_array = array('is_deleted' => '0', 'user_id !=' => $userid, 'status' => '1');

            $check_result = $this->common->check_unique_avalibility('business_profile', 'contact_email', $email, '', '', $condition_array);
        } else {

            $condition_array = array('is_deleted' => '0', 'status' => '1');

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
        // code for search
        $contition_array = array('status' => '1', 'is_deleted' => '0');


        $businessdata = $this->data['results'] = $this->common->select_data_by_condition('business_profile', $contition_array, $data = 'company_name,other_industrial,other_business_type', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);
        // echo "<pre>";print_r($businessdata);die();


        $contition_array = array('status' => '1', 'is_delete' => '0');


        $businesstype = $this->data['results'] = $this->common->select_data_by_condition('business_type', $contition_array, $data = 'business_name', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);
        // echo "<pre>";print_r($businesstype);

        $contition_array = array('status' => '1', 'is_delete' => '0');


        $industrytype = $this->data['results'] = $this->common->select_data_by_condition('industry_type', $contition_array, $data = 'industry_name', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);
        // echo "<pre>";print_r($industrytype);die();
        $unique = array_merge($businessdata, $businesstype, $industrytype);
        foreach ($unique as $key => $value) {
            foreach ($value as $ke => $val) {
                if ($val != "") {


                    $result[] = $val;
                }
            }
        }

        $results = array_unique($result);
        foreach ($results as $key => $value) {
            $result1[$key]['label'] = $value;
            $result1[$key]['value'] = $value;
        }

        $this->data['demo'] = array_values($result1);


        $this->load->view('business_profile/description', $this->data);
    }

    public function description_insert() {

        $userid = $this->session->userdata('aileenuser');



        if ($this->input->post('next')) {

            $this->form_validation->set_rules('business_type', 'Business Type', 'required');
            $this->form_validation->set_rules('industriyal', 'Industriyal', 'required');

            $this->form_validation->set_rules('business_details', 'Details', 'required');

            if ($this->form_validation->run() == FALSE) {
                $this->load->view('business_profile/description');
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

        $contition_array = array('user_id' => $userid, 'is_deleted' => '0', 'status' => '1');
        $userdata = $this->common->select_data_by_condition('business_profile', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        if ($userdata) {
            $step = $userdata[0]['business_step'];

            if ($step == 4 || ($step >= 1 && $step <= 4) || $step > 4) {
                $this->data['image1'] = $userdata[0]['business_profile_image'];
            }
        }


// code for search
        $contition_array = array('status' => '1', 'is_deleted' => '0');


        $businessdata = $this->data['results'] = $this->common->select_data_by_condition('business_profile', $contition_array, $data = 'company_name,other_industrial,other_business_type', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);
        // echo "<pre>";print_r($businessdata);die();


        $contition_array = array('status' => '1', 'is_delete' => '0');


        $businesstype = $this->data['results'] = $this->common->select_data_by_condition('business_type', $contition_array, $data = 'business_name', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);
        // echo "<pre>";print_r($businesstype);

        $contition_array = array('status' => '1', 'is_delete' => '0');


        $industrytype = $this->data['results'] = $this->common->select_data_by_condition('industry_type', $contition_array, $data = 'industry_name', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);
        // echo "<pre>";print_r($industrytype);die();
        $unique = array_merge($businessdata, $businesstype, $industrytype);
        foreach ($unique as $key => $value) {
            foreach ($value as $ke => $val) {
                if ($val != "") {


                    $result[] = $val;
                }
            }
        }

        $results = array_unique($result);
        foreach ($results as $key => $value) {
            $result1[$key]['label'] = $value;
            $result1[$key]['value'] = $value;
        }

        $this->data['demo'] = array_values($result1);



        $this->load->view('business_profile/image', $this->data);
    }

    public function image_insert() {

        $userid = $this->session->userdata('aileenuser');
//        echo '<pre>';
//        print_r($_POST);
//        print_r($_FILES);
//        exit;
        if ($this->input->post('next') || $this->input->post('submit')) {

            /* if (empty($_FILES['image1']['name'])) {

              } else { */
            if (count($_FILES) > 0) {
                $config['upload_path'] = 'uploads/business_profile_images/';
                $config['allowed_types'] = 'jpg|jpeg|png|gif';

                $config['file_name'] = $_FILES['image1']['name'];


                //Load upload library and initialize configuration
                $this->load->library('upload', $config);
                $this->upload->initialize($config);

                if ($this->upload->do_upload('image1')) {
                    $uploadData = $this->upload->data();

                    $picture = $uploadData['file_name'];
                } else {
                    $picture = '';
                }
            }

            if ($picture) {

                $data = array(
                    'business_profile_image' => $picture,
                    'modified_date' => date('Y-m-d', time()),
                    'business_step' => 4
                );
            } else {

                $data = array(
                    'business_profile_image' => $this->input->post('filename'),
                    'modified_date' => date('Y-m-d', time()),
                    'business_step' => 4
                );
            }
            $updatdata = $this->common->update_data($data, 'business_profile', 'user_id', $userid);

            if ($updatdata) {
                $this->session->set_flashdata('success', 'Image updated successfully');
                // redirect('business_profile/addmore', refresh);
                redirect('business_profile/business_profile_post', refresh);
            } else {
                $this->session->flashdata('error', 'Your data not inserted');
                redirect('business_profile/image', refresh);
            }
        }
    }

//end edit skills


    public function addmore() {
        $userid = $this->session->userdata('aileenuser');

        $contition_array = array('user_id' => $userid, 'is_deleted' => '0', 'status' => '1');
        $userdata = $this->common->select_data_by_condition('business_profile', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        if ($userdata) {
            $step = $userdata[0]['business_step'];

            if ($step == 5 || ($step >= 1 && $step <= 5) || $step > 5) {
                $this->data['addmore1'] = $userdata[0]['addmore'];
            }
        }

        // code for search
        $contition_array = array('status' => '1', 'is_deleted' => '0');


        $businessdata = $this->data['results'] = $this->common->select_data_by_condition('business_profile', $contition_array, $data = 'company_name,other_industrial,other_business_type', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);
        // echo "<pre>";print_r($businessdata);die();


        $contition_array = array('status' => '1', 'is_delete' => '0');


        $businesstype = $this->data['results'] = $this->common->select_data_by_condition('business_type', $contition_array, $data = 'business_name', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);
        // echo "<pre>";print_r($businesstype);

        $contition_array = array('status' => '1', 'is_delete' => '0');


        $industrytype = $this->data['results'] = $this->common->select_data_by_condition('industry_type', $contition_array, $data = 'industry_name', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);
        // echo "<pre>";print_r($industrytype);die();
        $unique = array_merge($businessdata, $businesstype, $industrytype);
        foreach ($unique as $key => $value) {
            foreach ($value as $ke => $val) {
                if ($val != "") {


                    $result[] = $val;
                }
            }
        }

        $results = array_unique($result);
        foreach ($results as $key => $value) {
            $result1[$key]['label'] = $value;
            $result1[$key]['value'] = $value;
        }

        $this->data['demo'] = array_values($result1);






        $this->load->view('business_profile/addmore', $this->data);
    }

    public function addmore_insert() {
        $userid = $this->session->userdata('aileenuser');

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


        $contition_array = array('user_id' => $userid, 'status' => '1');
        $this->data['businessdata'] = $this->common->select_data_by_condition('business_profile', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        //echo "<pre>"; print_r($this->data['businessdata']); die(); 

        $business_profile_id = $this->data['businessdata'][0]['business_profile_id'];

        $contition_array = array('is_deleted' => 0, 'status' => 1, 'user_id !=' => $userid);
        $userlist = $this->data['userlist'] = $this->common->select_data_by_condition('business_profile', $contition_array, $data = '*', $sortby = 'business_profile_id', $orderby = 'DESC', $limit = '', $offset = '', $join_str = array(), $groupby = '');

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

        $contition_array = array('is_deleted' => 0, 'status' => 1, 'user_id !=' => $userid, 'industriyal !=' => $industriyal);
        $userlist2 = $this->data['userlist2'] = $this->common->select_data_by_condition('business_profile', $contition_array, $data = '*', $sortby = 'business_profile_id', $orderby = 'DESC', $limit = '', $offset = '', $join_str = array(), $groupby = '');


        foreach ($userlist2 as $rowcity) {



            if ($businessregcity == $rowcity['city']) {
                $userlistcity[] = $rowcity;
            }
        }

        $this->data['userlistview2'] = $userlistcity;

// using state

        $businessregstate = $this->data['businessdata'][0]['state'];

        $contition_array = array('is_deleted' => 0, 'status' => 1, 'user_id !=' => $userid, 'industriyal !=' => $industriyal, 'city' => $businessregcity);
        $userlist3 = $this->data['userlist3'] = $this->common->select_data_by_condition('business_profile', $contition_array, $data = '*', $sortby = 'business_profile_id', $orderby = 'DESC', $limit = '', $offset = '', $join_str = array(), $groupby = '');



        foreach ($userlist3 as $rowstate) {



            if ($businessregstate == $rowstate['state']) {
                $userliststate[] = $rowstate;
            }
        }


        $this->data['userlistview3'] = $userliststate;

// using 3 user 

        $contition_array = array('is_deleted' => 0, 'status' => 1, 'user_id !=' => $userid, 'industriyal !=' => $industriyal, 'city !=' => $businessregcity, 'state !=' => $businessregstate);
        $userlastview = $this->data['userlastview'] = $this->common->select_data_by_condition('business_profile', $contition_array, $data = '*', $sortby = 'business_profile_id', $orderby = 'DESC', $limit = '', $offset = '', $join_str = array(), $groupby = '');


        $this->data['userlistview4'] = $userlastview;


//userlist for followdata end
//data fatch using follower start

        $contition_array = array('follow_from' => $business_profile_id, 'follow_status' => '1', 'follow_type' => '2');

        $followerdata = $this->data['followerdata'] = $this->common->select_data_by_condition('follow', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        //echo "<pre>" ; print_r($this->data['followerdata']); die();

        foreach ($followerdata as $fdata) {

            $contition_array = array('business_profile_id' => $fdata['follow_to']);

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

        $contition_array = array('industriyal' => $userselectindustriyal, 'status' => '1');
        $businessprofiledata = $this->data['businessprofiledata'] = $this->common->select_data_by_condition('business_profile', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');



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

        $new = array();
        foreach ($postdata as $value) {
            $new[$value['business_profile_post_id']] = $value;
        }

        $post = array();

        foreach ($new as $key => $row) {

            $post[$key] = $row['business_profile_post_id'];
        }
        array_multisort($post, SORT_DESC, $new);

        $this->data['businessprofiledata'] = $new;

        //echo "<pre>"; print_r($this->data['businessprofiledata']) ; die();
// code for search

        $contition_array = array('status' => '1', 'is_deleted' => '0');


        $businessdata = $this->data['results'] = $this->common->select_data_by_condition('business_profile', $contition_array, $data = 'company_name,other_industrial,other_business_type', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);
        // echo "<pre>";print_r($businessdata);die();


        $contition_array = array('status' => '1', 'is_delete' => '0');


        $businesstype = $this->data['results'] = $this->common->select_data_by_condition('business_type', $contition_array, $data = 'business_name', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);
        // echo "<pre>";print_r($businesstype);

        $contition_array = array('status' => '1', 'is_delete' => '0');


        $industrytype = $this->data['results'] = $this->common->select_data_by_condition('industry_type', $contition_array, $data = 'industry_name', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);
        // echo "<pre>";print_r($industrytype);die();
        $unique = array_merge($businessdata, $businesstype, $industrytype);
        foreach ($unique as $key => $value) {
            foreach ($value as $ke => $val) {
                if ($val != "") {


                    $result[] = $val;
                }
            }
        }

        $results = array_unique($result);
        foreach ($results as $key => $value) {
            $result1[$key]['label'] = $value;
            $result1[$key]['value'] = $value;
        }

        $this->data['demo'] = array_values($result1);
        // echo '<pre>'; print_r($result); die();






        $this->load->view('business_profile/business_profile_post', $this->data);
    }

    public function business_profile_manage_post($id = "") {

        // manage post start
        $userid = $this->session->userdata('aileenuser');
        $user_name = $this->session->userdata('user_name');



        $contition_array = array('user_id' => $userid, 'status' => '1');

        $this->data['slug_data'] = $this->common->select_data_by_condition('business_profile', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
        //echo "<pre>"; print_r($this->data['slug_data']); die();
        $slug_id = $this->data['slug_data'][0]['business_slug'];
        //echo  $slug_id ; die();
        if ($id == $slug_id || $id == '') {

            $contition_array = array('business_slug' => $slug_id, 'status' => '1');
            $businessdata1 = $this->data['businessdata1'] = $this->common->select_data_by_condition('business_profile', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

            $contition_array = array('user_id' => $businessdata1[0]['user_id'], 'status' => 1, 'is_delete' => '0');

            $this->data['business_profile_data'] = $this->common->select_data_by_condition('business_profile_post', $contition_array, $data, $sortby = 'business_profile_post_id', $orderby = 'DESC', $limit = '', $offset = '', $join_str = array(), $groupby = '');

            //echo "<pre>"; print_r($this->data['business_profile_data']); die();
        } else {

            $contition_array = array('business_slug' => $id, 'status' => '1');
            $businessdata1 = $this->data['businessdata1'] = $this->common->select_data_by_condition('business_profile', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

            $contition_array = array('user_id' => $businessdata1[0]['user_id'], 'status' => 1, 'is_delete' => '0');


            $this->data['business_profile_data'] = $this->common->select_data_by_condition('business_profile_post', $contition_array, $data, $sortby = 'business_profile_post_id', $orderby = 'DESC', $limit = '', $offset = '', $join_str = array(), $groupby = '');

            //echo "<pre>"; print_r($this->data['business_profile_data']); die();
        }

        //manage post end
// code for search

        $contition_array = array('status' => '1', 'is_deleted' => '0');


        $businessdata = $this->data['results'] = $this->common->select_data_by_condition('business_profile', $contition_array, $data = 'company_name,other_industrial,other_business_type', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);
        // echo "<pre>";print_r($businessdata);die();


        $contition_array = array('status' => '1', 'is_delete' => '0');


        $businesstype = $this->data['results'] = $this->common->select_data_by_condition('business_type', $contition_array, $data = 'business_name', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);
        // echo "<pre>";print_r($businesstype);

        $contition_array = array('status' => '1', 'is_delete' => '0');


        $industrytype = $this->data['results'] = $this->common->select_data_by_condition('industry_type', $contition_array, $data = 'industry_name', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);
        // echo "<pre>";print_r($industrytype);die();
        $unique = array_merge($businessdata, $businesstype, $industrytype);
        foreach ($unique as $key => $value) {
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

        $this->data['demo'] = $result1;
        // echo '<pre>'; print_r($result1); die();
        //echo "<pre>"; print_r($this->data['business_profile_data']); die();
        $this->load->view('business_profile/business_profile_manage_post', $this->data);

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
    }

    public function business_profile_addpost() {
        $userid = $this->session->userdata('aileenuser');
        $contition_array = array('user_id' => $userid, 'status' => '1');
        $this->data['businessdata'] = $this->common->select_data_by_condition('business_profile', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        $this->load->view('business_profile/business_profile_addpost', $this->data);
    }

    public function business_profile_addpost_insert($id = "", $para = "") {


        $userid = $this->session->userdata('aileenuser');

        $contition_array = array('user_id' => $para, 'status' => '1');
        $this->data['businessdataposted'] = $this->common->select_data_by_condition('business_profile', $contition_array, $data = 'business_slug', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        if ($para == $userid || $para == '') {

            $data = array(
                'product_name' => $this->input->post('my_text'),
                'product_description' => $this->input->post('product_desc'),
                'created_date' => date('Y-m-d', time()),
                'status' => 1,
                'is_delete' => 0,
                'user_id' => $userid
            );
        } else {
            $data = array(
                'product_name' => $this->input->post('my_text'),
                'product_description' => $this->input->post('product_desc'),
                'created_date' => date('Y-m-d', time()),
                'status' => 1,
                'is_delete' => 0,
                'user_id' => $para,
                'posted_user_id' => $userid
            );
        }
        //echo "<pre>"; print_r($data); die();
        $insert_id = $this->common->insert_data_getid($data, 'business_profile_post');
        //echo $insert_id; die(); 
        $config = array(
            'upload_path' => 'uploads/bus_post_image/',
            'max_size' => 2500000000000,
            'allowed_types' => 'gif|jpeg|jpg|png|pdf|mp4|mp3',
            'overwrite' => true,
            'remove_spaces' => true);
        $images = array();
        $this->load->library('upload');

        $files = $_FILES;
        $count = count($_FILES['postattach']['name']);

        for ($i = 0; $i < $count; $i++) {

            $_FILES['postattach']['name'] = $files['postattach']['name'][$i];
            $_FILES['postattach']['type'] = $files['postattach']['type'][$i];
            $_FILES['postattach']['tmp_name'] = $files['postattach']['tmp_name'][$i];
            $_FILES['postattach']['error'] = $files['postattach']['error'][$i];
            $_FILES['postattach']['size'] = $files['postattach']['size'][$i];

            $fileName = $title . '_' . $_FILES['postattach']['name'];
            $images[] = $fileName;
            $config['file_name'] = $fileName;

            $this->upload->initialize($config);
            $this->upload->do_upload();
            if ($this->upload->do_upload('postattach')) {//echo "hello"; die();
                $return['data'][] = $this->upload->data();
                $return['status'] = "success";
                $return['msg'] = sprintf($this->lang->line('success_item_added'), "Image", "uploaded");

                $data1 = array(
                    'image_name' => $fileName,
                    'image_type' => 2,
                    'post_id' => $insert_id,
                    'is_deleted' => 1
                );

                //echo "<pre>"; print_r($data1);
                $insert_id1 = $this->common->insert_data_getid($data1, 'post_image');
            }
        } //die();

        if ($id == manage) {

            if ($para == $userid || $para == '') {
                redirect('business_profile/business_profile_manage_post', refresh);
            } else {
                redirect('business_profile/business_profile_manage_post/' . $this->data['businessdataposted'][0]['business_slug'], refresh);
            }
        } else {
            redirect('business_profile/business_profile_post', refresh);
        }
        // new code end
    }

    public function business_profile_editpost($id) {
        $contition_array = array('business_profile_post_id' => $id);
        $this->data['business_profile_data'] = $this->common->select_data_by_condition('business_profile_post', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        $this->load->view('business_profile/business_profile_editpost', $this->data);
    }

    public function business_profile_editpost_insert($id) {


        $editimage = $this->input->post('hiddenimg');

        $this->form_validation->set_rules('productname', 'Product name', 'required');
        $this->form_validation->set_rules('description', 'Description', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('business_profile/business_profile_editpost');
        } else {


            $config['upload_path'] = 'uploads/business_profile_images/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif|mp4|3gp|pdf';

            $config['file_name'] = $_FILES['image']['name'];
            $config['upload_max_filesize'] = '40M';

            //Load upload library and initialize configuration
            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if ($this->upload->do_upload('image')) {
                $uploadData = $this->upload->data();

                $picture = $uploadData['file_name'];
            } else {
                $picture = '';
            }


            if ($picture) {

                $data = array(
                    'product_name' => $this->input->post('productname'),
                    'product_image' => $picture,
                    'product_description' => $this->input->post('description'),
                    'modify_date' => date('Y-m-d', time())
                );
            } else {
                $data = array(
                    'product_name' => $this->input->post('productname'),
                    'product_image' => $this->input->post('hiddenimg'),
                    'product_description' => $this->input->post('description'),
                    'modify_date' => date('Y-m-d', time())
                );
            }

            $updatdata = $this->common->update_data($data, 'business_profile_post', 'business_profile_post_id', $id);

            if ($updatdata) {
                redirect('business_profile/business_profile_manage_post', refresh);
            } else {
                $this->session->flashdata('error', 'Your data not inserted');
                redirect('business_profile/business_profile_editpost', refresh);
            }
        }
    }

//business_profile_contactperson start


    public function business_profile_contactperson($id) {

        $userid = $this->session->userdata('aileenuser');
        $contition_array = array('user_id' => $id, 'status' => '1');
        $this->data['contactperson'] = $this->common->select_data_by_condition('business_profile', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        $this->load->view('business_profile/business_profile_contactperson', $this->data);
    }

//business_profile_contactperson _query

    public function business_profile_contactperson_query($id) {
        $userid = $this->session->userdata('aileenuser');

        $contition_array = array('user_id' => $id);
        $this->data['contactperson'] = $this->common->select_data_by_condition('business_profile', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        $email = $this->input->post('email');

        $toemail = $this->input->post('toemail');

        $userdata = $this->common->select_data_by_id('user', 'user_id', $userid, $data = '*', $join_str = array());


        $msg = 'Hey !' . " " . $this->data['contactperson'][0]['contact_person'] . "<br/>" .
                $msg .= $userdata[0]['first_name'] . $userdata[0]['last_name'] . '(' . $userdata[0]['user_email'] . ')' . ',';
        $msg .= 'this person wants to contact with you!!';
        $msg .= "<br>";
        $msg .= $this->input->post('msg');
        $from = 'raval.khyati13@gmail.com';



        $subject = "contact message";


        $mail = $this->email_model->do_email($msg, $subject, $toemail, $from);


        //insert contact start


        $data = array(
            'contact_from_id' => $userid,
            'contact_to_id' => $id,
            'contact_type' => 2,
            'created_date' => date('Y-m-d', time()),
            'status' => 1,
            'is_delete' => $userid,
            'contact_desc' => $this->input->post('msg')
        );


        $insertdata = $this->common->insert_data_getid($data, 'contact_person');


//insert contact person end 
//insert contact person notification start


        $data = array(
            'not_type' => 7,
            'not_from_id' => $userid,
            'not_to_id' => $id,
            'not_read' => 2,
            'not_product_id' => $insertdata,
            'not_from' => 3
        );

        $insert_id = $this->common->insert_data_getid($data, 'notification');

        if ($insertdata) {

            $this->session->set_flashdata('success', 'contacted successfully');
            redirect('business_profile/business_profile_post', 'refresh');
        } else {
            $this->session->flashdata('error', 'Your data not inserted');
            redirect('business_profile/business_profile_contactperson/' . $id, refresh);
        }
//insert contact person notifiaction end   
    }

    public function business_profile_save_post() {
        $userid = $this->session->userdata('aileenuser');
        $user_name = $this->session->userdata('user_name');

        $contition_array = array('user_id' => $userid);
        $this->data['businessdata'] = $this->common->select_data_by_condition('business_profile', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        $contition_array = array('user_id' => $userid);
        $savedata = $this->data['savedata'] = $this->common->select_data_by_condition('business_profile_save', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        //echo "<pre>"; print_r($this->data['savedata']); die();

        foreach ($savedata as $savepost) {

            $savepostid = $savepost['post_id'];

            $contition_array = array('business_profile_post_id' => $savepostid, 'status' => '1');
            $this->data['business_post_data'] = $this->common->select_data_by_condition('business_profile_post', $contition_array, $data, $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

            $businesssavepost[] = $this->data['business_post_data'];
        }

        $this->data['business_profile_data'] = $businesssavepost;

        //echo "<pre>"; print_r($this->data['business_profile_data']); die();
        $this->load->view('business_profile/business_profile_save_post', $this->data);
    }

    public function user_image_insert() {


        $userid = $this->session->userdata('aileenuser');


        if ($this->input->post('cancel2')) {
            redirect('business_profile/business_profile_post', refresh);
        } elseif ($this->input->post('cancel1')) {
            redirect('business_profile/business_profile_save_post', refresh);
        } elseif ($this->input->post('cancel3')) {
            redirect('business_profile/business_profile_addpost', refresh);
        } elseif ($this->input->post('cancel4')) {
            redirect('business_profile/business_resume', refresh);
        } elseif ($this->input->post('cancel5')) {
            redirect('business_profile/business_profile_manage_post', refresh);
        } elseif ($this->input->post('cancel6')) {
            redirect('business_profile/userlist', refresh);
        } elseif ($this->input->post('cancel7')) {
            redirect('business_profile/followers', refresh);
        } elseif ($this->input->post('cancel8')) {
            redirect('business_profile/following', refresh);
        }

        if (empty($_FILES['profilepic']['name'])) {
            $this->form_validation->set_rules('profilepic', 'Upload profilepic', 'required');
        } else {
            $config['upload_path'] = 'uploads/user_image/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif|mp4|3gp|mpeg|mpg|mpe|qt|mov|avi|pdf';

            $config['file_name'] = $_FILES['profilepic']['name'];

            //Load upload library and initialize configuration
            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if ($this->upload->do_upload('profilepic')) {
                $uploadData = $this->upload->data();
                $picture = $uploadData['file_name'];
            } else {
                $picture = '';
            }

            $data = array(
                'business_user_image' => $picture,
                'modified_date' => date('Y-m-d', time())
            );


            $updatdata = $this->common->update_data($data, 'business_profile', 'user_id', $userid);

            if ($updatdata) {
                if ($this->input->post('hitext') == 1) {
                    redirect('business_profile/business_profile_save_post', refresh);
                } elseif ($this->input->post('hitext') == 2) {
                    redirect('business_profile/business_profile_post', refresh);
                } elseif ($this->input->post('hitext') == 3) {
                    redirect('business_profile/business_profile_addpost', refresh);
                } elseif ($this->input->post('hitext') == 4) {
                    redirect('business_profile/business_resume', refresh);
                } elseif ($this->input->post('hitext') == 5) {
                    redirect('business_profile/business_profile_manage_post', refresh);
                } elseif ($this->input->post('hitext') == 6) {
                    redirect('business_profile/userlist', refresh);
                } elseif ($this->input->post('hitext') == 7) {
                    redirect('business_profile/followers', refresh);
                } elseif ($this->input->post('hitext') == 8) {
                    redirect('business_profile/following', refresh);
                }
            } else {
                $this->session->flashdata('error', 'Your data not inserted');
                redirect('business_profile/business_profile_post', refresh);
            }
        }
    }

    public function business_resume($id) {

        $userid = $this->session->userdata('aileenuser');


        $contition_array = array('user_id' => $userid, 'status' => '1');
        $this->data['slug_data'] = $this->common->select_data_by_condition('business_profile', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        $slug_id = $this->data['slug_data'][0]['business_slug'];

        if ($id == $this->data['slug_data'][0]['business_slug'] || $id == '') {
            $contition_array = array('business_slug' => $slug_id, 'status' => '1');
            $this->data['businessdata1'] = $this->common->select_data_by_condition('business_profile', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
        } else {

            $contition_array = array('business_slug' => $id, 'status' => '1');
            $this->data['businessdata1'] = $this->common->select_data_by_condition('business_profile', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
        }


        $contition_array = array('status' => '1', 'is_deleted' => '0');


        $businessdata = $this->data['results'] = $this->common->select_data_by_condition('business_profile', $contition_array, $data = 'company_name,other_industrial,other_business_type', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);
        // echo "<pre>";print_r($businessdata);die();


        $contition_array = array('status' => '1', 'is_delete' => '0');


        $businesstype = $this->data['results'] = $this->common->select_data_by_condition('business_type', $contition_array, $data = 'business_name', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);
        // echo "<pre>";print_r($businesstype);

        $contition_array = array('status' => '1', 'is_delete' => '0');


        $industrytype = $this->data['results'] = $this->common->select_data_by_condition('industry_type', $contition_array, $data = 'industry_name', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);
        // echo "<pre>";print_r($industrytype);die();
        $unique = array_merge($businessdata, $businesstype, $industrytype);
        foreach ($unique as $key => $value) {
            foreach ($value as $ke => $val) {
                if ($val != "") {


                    $result[] = $val;
                }
            }
        }

        $results = array_unique($result);
        foreach ($results as $key => $value) {
            $result1[$key]['label'] = $value;
            $result1[$key]['value'] = $value;
        }

        $this->data['demo'] = array_values($result1);


        $this->load->view('business_profile/business_resume', $this->data);
    }

    public function business_user_post($id) {

        $this->data['userid'] = $id;
        $userid = $this->session->userdata('aileenuser');
        $user_name = $this->session->userdata('user_name');

        $contition_array = array('user_id' => $userid, 'status' => '1');
        $this->data['businessdata'] = $this->common->select_data_by_condition('business_profile', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');



        $this->data['usdata'] = $this->common->select_data_by_id('user', 'user_id', $id, $data = '*', $join_str = array());


        $contition_array = array('user_id' => $id);
        $this->data['business_profile_data'] = $this->common->select_data_by_condition('business_profile_post', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        $this->load->view('business_profile/business_profile_manage_post', $this->data);
    }

    //Business Profile Save Post Start
    public function business_profile_save() {

        $id = $_POST['business_profile_post_id'];

        $userid = $this->session->userdata('aileenuser');

        $contition_array = array('post_id' => $id, 'user_id' => $userid, 'is_delete' => 0);
        $userdata = $this->common->select_data_by_condition('business_profile_save', $contition_array, $data = '*', $sortby = '', $orderby = 'desc', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        $save_id = $userdata[0]['save_id'];

        if ($userdata) {

            $contition_array = array('business_delete' => 1);
            $jobdata = $this->common->select_data_by_condition('business_profile_save', $contition_array, $data = 'save_id', $sortby = '', $orderby = 'desc', $limit = '', $offset = '', $join_str = array(), $groupby = '');

            $data = array(
                'business_delete' => 0,
                'business_save' => 1
            );


            $updatedata = $this->common->update_data($data, 'business_profile_save', 'save_id', $save_id);


            if ($updatedata) {

                //$savepost = '<div> Saved Post </div>';
                $savepost .= '<i class="fa fa-bookmark" aria-hidden="true"></i>';
                $savepost .= 'Saved Post';
                //$savepost .= '</a>';      
                echo $savepost;
            }
        } else {

            $data = array(
                'post_id' => $id,
                'user_id' => $userid,
                'created_date' => date('Y-m-d h:i:s', time()),
                'is_delete' => 0,
                'business_save' => 1,
                'business_delete' => 0
            );


            $insert_id = $this->common->insert_data_getid($data, 'business_profile_save');
            if ($insert_id) {
                //$savepost = '<div> Saved Post </div>';
                $savepost .= '<i class="fa fa-bookmark" aria-hidden="true"></i>';
                $savepost .= 'Saved Post';
                echo $savepost;
            }
        }
    }

    //Business Profile Save Post End
    //Business Profile Remove Save Post Start
    public function business_profile_delete($id) {

        $id = $_POST['save_id'];
        $userid = $this->session->userdata('aileenuser');

        $data = array(
            'business_save' => 0,
            'business_delete' => 1,
            'modify_date' => date('Y-m-d h:i:s', time())
        );

        $updatedata = $this->common->update_data($data, 'business_profile_save', 'save_id', $id);
    }

    //Business Profile Remove Save Post Start
//location automatic retrieve controller start
    public function location() {
        $json = [];



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

//location automatic retrieve controller End
    // user list of artistic users

    public function userlist() {
        $this->data['userid'] = $userid = $this->session->userdata('aileenuser');
        $artdata = $this->data['artdata'] = $this->common->select_data_by_id('business_profile', 'user_id', $userid, $data = '*');

        $contition_array = array('user_id' => $userid);
        $this->data['artisticdata'] = $this->common->select_data_by_condition('business_profile', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');


        $contition_array = array('business_step' => 4, 'is_deleted' => 0, 'status' => 1, 'user_id !=' => $userid);
        $this->data['userlist'] = $this->common->select_data_by_condition('business_profile', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        // followers count
        $join_str[0]['table'] = 'follow';
        $join_str[0]['join_table_id'] = 'follow.follow_to';
        $join_str[0]['from_table_id'] = 'business_profile.business_profile_id';
        $join_str[0]['join_type'] = '';
        $contition_array = array('follow_to' => $artdata[0]['business_profile_id'], 'follow_status' => 1, 'follow_type' => 1);

        $this->data['followers'] = count($this->common->select_data_by_condition('business_profile', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str, $groupby = ''));

        // follow count end
        // fllowing count
        $join_str[0]['table'] = 'follow';
        $join_str[0]['join_table_id'] = 'follow.follow_from';
        $join_str[0]['from_table_id'] = 'business_profile.business_profile_id';
        $join_str[0]['join_type'] = '';

        $contition_array = array('follow_from' => $artdata[0]['business_profile_id'], 'follow_status' => 1, 'follow_type' => 1);

        $this->data['following'] = count($this->common->select_data_by_condition('business_profile', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str, $groupby = ''));

        //following end

        $contition_array = array('status' => '1', 'is_deleted' => '0');
        $businessdata = $this->data['results'] = $this->common->select_data_by_condition('business_profile', $contition_array, $data = 'company_name,other_industrial,other_business_type', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);
        // echo "<pre>";print_r($businessdata);die();

        $contition_array = array('status' => '1', 'is_delete' => '0');
        $businesstype = $this->data['results'] = $this->common->select_data_by_condition('business_type', $contition_array, $data = 'business_name', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);
        // echo "<pre>";print_r($businesstype);

        $contition_array = array('status' => '1', 'is_delete' => '0');


        $industrytype = $this->data['results'] = $this->common->select_data_by_condition('industry_type', $contition_array, $data = 'industry_name', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);
        // echo "<pre>";print_r($industrytype);die();
        $unique = array_merge($businessdata, $businesstype, $industrytype);
        foreach ($unique as $key => $value) {
            foreach ($value as $ke => $val) {
                if ($val != "") {


                    $result[] = $val;
                }
            }
        }

        $results = array_unique($result);
        foreach ($results as $key => $value) {
            $result1[$key]['label'] = $value;
            $result1[$key]['value'] = $value;
        }

        $this->data['demo'] = array_values($result1);









        $this->load->view('business_profile/business_userlist', $this->data);
    }

    public function follow() {
        $userid = $this->session->userdata('aileenuser');

        $business_id = $_POST["follow_to"];

        $contition_array = array('user_id' => $userid, 'is_deleted' => 0, 'status' => 1);

        $artdata = $this->common->select_data_by_condition('business_profile', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        $contition_array = array('follow_type' => 2, 'follow_from' => $artdata[0]['business_profile_id'], 'follow_to' => $business_id);
        $follow = $this->common->select_data_by_condition('follow', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');


        if ($follow) {
            $data = array(
                'follow_type' => 2,
                'follow_from' => $artdata[0]['business_profile_id'],
                'follow_to' => $business_id,
                'follow_status' => 1,
            );
            $update = $this->common->update_data($data, 'follow', 'follow_id', $follow[0]['follow_id']);

            // insert notification

            $data = array(
                'not_type' => 8,
                'not_from_id' => $userid,
                'not_to_id' => $business_id,
                'not_read' => 2,
                'not_product_id' => $follow[0]['follow_id'],
                'not_from' => 6
            );

            $insert_id = $this->common->insert_data_getid($data, 'notification');
            // end notoification

            if ($update) {

                $follow = '<div id="unfollowdiv" class="user_btn">';
                $follow .= '<button id="unfollow' . $business_id . '" onClick="unfollowuser(' . $business_id . ')">
                              Following
                      </button>';
                $follow .= '</div>';
                echo $follow;
            }
        } else {
            $data = array(
                'follow_type' => 2,
                'follow_from' => $artdata[0]['business_profile_id'],
                'follow_to' => $business_id,
                'follow_status' => 1,
            );
            $insert = $this->common->insert_data($data, 'follow');

            // insert notification

            $data = array(
                'not_type' => 8,
                'not_from_id' => $userid,
                'not_to_id' => $business_id,
                'not_read' => 2,
                'not_product_id' => $insert,
                'not_from' => 6
            );

            $insert_id = $this->common->insert_data_getid($data, 'notification');
            // end notoification
            if ($insert) {
                $follow = '<div id="unfollowdiv" class="user_btn">';
                $follow .= '<button id="unfollow' . $business_id . '" onClick="unfollowuser(' . $business_id . ')">
                               Following
                      </button>';
                $follow .= '</div>';
                echo $follow;
            }
        }
    }

    public function unfollow() {
        $userid = $this->session->userdata('aileenuser');

        $business_id = $_POST["follow_to"];

        $contition_array = array('user_id' => $userid, 'is_deleted' => 0, 'status' => 1);

        $artdata = $this->common->select_data_by_condition('business_profile', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        $contition_array = array('follow_type' => 2, 'follow_from' => $artdata[0]['business_profile_id'], 'follow_to' => $business_id);

        $follow = $this->common->select_data_by_condition('follow', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');


        if ($follow) {
            $data = array(
                'follow_type' => 2,
                'follow_from' => $artdata[0]['business_profile_id'],
                'follow_to' => $business_id,
                'follow_status' => 0,
            );
            $update = $this->common->update_data($data, 'follow', 'follow_id', $follow[0]['follow_id']);
            if ($update) {

                $unfollow = '<div id="followdiv " class="user_btn">';
                $unfollow .= '<button id="follow' . $business_id . '" onClick="followuser(' . $business_id . ')">
                               Follow 
                      </button>';
                $unfollow .= '</div>';
                echo $unfollow;
            }
        }
    }

    public function follow_two() {
        $userid = $this->session->userdata('aileenuser');

        $business_id = $_POST["follow_to"];

        $contition_array = array('user_id' => $userid, 'is_deleted' => 0, 'status' => 1);

        $artdata = $this->common->select_data_by_condition('business_profile', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        $contition_array = array('follow_type' => 2, 'follow_from' => $artdata[0]['business_profile_id'], 'follow_to' => $business_id);
        $follow = $this->common->select_data_by_condition('follow', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');


        if ($follow) {
            $data = array(
                'follow_type' => 2,
                'follow_from' => $artdata[0]['business_profile_id'],
                'follow_to' => $business_id,
                'follow_status' => 1,
            );
            $update = $this->common->update_data($data, 'follow', 'follow_id', $follow[0]['follow_id']);

            // insert notification

            $data = array(
                'not_type' => 8,
                'not_from_id' => $userid,
                'not_to_id' => $business_id,
                'not_read' => 2,
                'not_product_id' => $follow[0]['follow_id'],
                'not_from' => 6
            );

            $insert_id = $this->common->insert_data_getid($data, 'notification');
            // end notoification

            if ($update) {

                $follow = '<div>';
                $follow = '<button id="unfollow' . $business_id . '" onClick="unfollowuser_two(' . $business_id . ')">
                              Following
                      </button>';
                $follow .= '</div>';
                echo $follow;
            }
        } else {
            $data = array(
                'follow_type' => 2,
                'follow_from' => $artdata[0]['business_profile_id'],
                'follow_to' => $business_id,
                'follow_status' => 1,
            );
            $insert = $this->common->insert_data($data, 'follow');

            // insert notification

            $data = array(
                'not_type' => 8,
                'not_from_id' => $userid,
                'not_to_id' => $business_id,
                'not_read' => 2,
                'not_product_id' => $insert,
                'not_from' => 6
            );

            $insert_id = $this->common->insert_data_getid($data, 'notification');
            // end notoification
            if ($insert) {
                $follow = '<div>';
                // $follow = '<button id="unfollow' . $business_id . '" onClick="unfollowuser(' . $business_id . ')">
                //                Following
                //       </button>';
                $follow = '<button id="unfollow' . $business_id . '" onClick="unfollowuser_two(' . $business_id . ')"><span>Following</span></button>';
                $follow .= '</div>';
                echo $follow;
            }
        }
    }

    public function unfollow_two() {
        $userid = $this->session->userdata('aileenuser');

        $business_id = $_POST["follow_to"];

        $contition_array = array('user_id' => $userid, 'is_deleted' => 0, 'status' => 1);

        $artdata = $this->common->select_data_by_condition('business_profile', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        $contition_array = array('follow_type' => 2, 'follow_from' => $artdata[0]['business_profile_id'], 'follow_to' => $business_id);

        $follow = $this->common->select_data_by_condition('follow', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');


        if ($follow) {
            $data = array(
                'follow_type' => 2,
                'follow_from' => $artdata[0]['business_profile_id'],
                'follow_to' => $business_id,
                'follow_status' => 0,
            );
            $update = $this->common->update_data($data, 'follow', 'follow_id', $follow[0]['follow_id']);
            if ($update) {

                // $unfollow = '<div>';
                // $unfollow = '<button id="follow' . $business_id . '" onClick="followuser(' . $business_id . ')">
                //                Follow 
                //       </button>';
                // $unfollow .= '</div>';
                $unfollow = '<button id="unfollowdiv" onClick="followuser_two(' . $business_id . ')">
                               Follow 
                      </button>';
                echo $unfollow;
            }
        }
    }

    public function unfollow_following() {
        $userid = $this->session->userdata('aileenuser');

        $business_id = $_POST["follow_to"];

        $contition_array = array('user_id' => $userid, 'is_deleted' => 0, 'status' => 1);

        $artdata = $this->common->select_data_by_condition('business_profile', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        $contition_array = array('follow_type' => 2, 'follow_from' => $artdata[0]['business_profile_id'], 'follow_to' => $business_id);

        $follow = $this->common->select_data_by_condition('follow', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');


        if ($follow) {
            $data = array(
                'follow_type' => 2,
                'follow_from' => $artdata[0]['business_profile_id'],
                'follow_to' => $business_id,
                'follow_status' => 0,
            );
            $update = $this->common->update_data($data, 'follow', 'follow_id', $follow[0]['follow_id']);
            if ($update) {

                $contition_array = array('follow_from' => $artdata[0]['business_profile_id'], 'follow_status' => '1', 'follow_type' => '2');
                $followingotherdata = $this->data['followingotherdata'] = $this->common->select_data_by_condition('follow', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

                $followingdatacount = count($followingotherdata);


                $unfollow = '<div>(';
                $unfollow .= '' . $followingdatacount . '';
                $unfollow .= ')</div>';
                echo $unfollow;
            }
        }
    }

    public function followers($id = "") {
        $this->data['userid'] = $userid = $this->session->userdata('aileenuser');

        $contition_array = array('user_id' => $userid, 'is_deleted' => 0, 'status' => 1);

        $artdata = $this->data['artisticdata'] = $this->common->select_data_by_condition('business_profile', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
        $slugid = $artdata[0]['business_slug'];

        if ($id == $slug_id || $id == '') {



            $contition_array = array('user_id' => $userid, 'is_deleted' => 0, 'status' => 1);

            $businessdata1 = $this->data['businessdata1'] = $this->common->select_data_by_condition('business_profile', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');


            $join_str[0]['table'] = 'follow';
            $join_str[0]['join_table_id'] = 'follow.follow_to';
            $join_str[0]['from_table_id'] = 'business_profile.business_profile_id';
            $join_str[0]['join_type'] = '';

            $contition_array = array('follow_to' => $businessdata1[0]['business_profile_id'], 'follow_status' => 1, 'follow_type' => 2);

            $this->data['userlist'] = $this->common->select_data_by_condition('business_profile', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str, $groupby = '');
        } else {

            $contition_array = array('business_slug' => $id, 'is_deleted' => 0, 'status' => 1);

            $businessdata1 = $this->data['businessdata1'] = $this->common->select_data_by_condition('business_profile', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

            $join_str[0]['table'] = 'follow';
            $join_str[0]['join_table_id'] = 'follow.follow_to';
            $join_str[0]['from_table_id'] = 'business_profile.business_profile_id';
            $join_str[0]['join_type'] = '';

            $contition_array = array('follow_to' => $businessdata1[0]['business_profile_id'], 'follow_status' => 1, 'follow_type' => 2);

            $this->data['userlist'] = $this->common->select_data_by_condition('business_profile', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str, $groupby = '');
        }



        $contition_array = array('status' => '1', 'is_deleted' => '0');


        $businessdata = $this->data['results'] = $this->common->select_data_by_condition('business_profile', $contition_array, $data = 'company_name,other_industrial,other_business_type', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);
        // echo "<pre>";print_r($businessdata);die();


        $contition_array = array('status' => '1', 'is_delete' => '0');


        $businesstype = $this->data['results'] = $this->common->select_data_by_condition('business_type', $contition_array, $data = 'business_name', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);
        // echo "<pre>";print_r($businesstype);

        $contition_array = array('status' => '1', 'is_delete' => '0');


        $industrytype = $this->data['results'] = $this->common->select_data_by_condition('industry_type', $contition_array, $data = 'industry_name', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);
        // echo "<pre>";print_r($industrytype);die();
        $unique = array_merge($businessdata, $businesstype, $industrytype);
        foreach ($unique as $key => $value) {
            foreach ($value as $ke => $val) {
                if ($val != "") {


                    $result[] = $val;
                }
            }
        }

        $results = array_unique($result);
        foreach ($results as $key => $value) {
            $result1[$key]['label'] = $value;
            $result1[$key]['value'] = $value;
        }

        $this->data['demo'] = array_values($result1);

        //echo "<pre>"; print_r($this->data['userlist']); die();
        $this->load->view('business_profile/business_followers', $this->data);
    }

    public function following($id) {
        $this->data['userid'] = $userid = $this->session->userdata('aileenuser');

        $contition_array = array('user_id' => $userid, 'is_deleted' => 0, 'status' => 1);

        $artdata = $this->data['artisticdata'] = $this->common->select_data_by_condition('business_profile', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        $slugid = $artdata[0]['business_slug'];


        if ($id == $slug_id || $id == '') {

            $contition_array = array('user_id' => $userid);
            $businessdata1 = $this->data['businessdata1'] = $this->common->select_data_by_condition('business_profile', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');


            $join_str[0]['table'] = 'follow';
            $join_str[0]['join_table_id'] = 'follow.follow_from';
            $join_str[0]['from_table_id'] = 'business_profile.business_profile_id';
            $join_str[0]['join_type'] = '';

            $contition_array = array('follow_from' => $businessdata1[0]['business_profile_id'], 'follow_status' => 1, 'follow_type' => 2);

            $this->data['userlist'] = $this->common->select_data_by_condition('business_profile', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str, $groupby = '');
        } else {

            $contition_array = array('business_slug' => $id);
            $businessdata1 = $this->data['businessdata1'] = $this->common->select_data_by_condition('business_profile', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');


            $join_str[0]['table'] = 'follow';
            $join_str[0]['join_table_id'] = 'follow.follow_from';
            $join_str[0]['from_table_id'] = 'business_profile.business_profile_id';
            $join_str[0]['join_type'] = '';

            $contition_array = array('follow_from' => $businessdata1[0]['business_profile_id'], 'follow_status' => 1, 'follow_type' => 2);

            $this->data['userlist'] = $this->common->select_data_by_condition('business_profile', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str, $groupby = '');
        }



// code for search
        $contition_array = array('status' => '1', 'is_deleted' => '0');


        $businessdata = $this->data['results'] = $this->common->select_data_by_condition('business_profile', $contition_array, $data = 'company_name,other_industrial,other_business_type', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);
        // echo "<pre>";print_r($businessdata);die();


        $contition_array = array('status' => '1', 'is_delete' => '0');


        $businesstype = $this->data['results'] = $this->common->select_data_by_condition('business_type', $contition_array, $data = 'business_name', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);
        // echo "<pre>";print_r($businesstype);

        $contition_array = array('status' => '1', 'is_delete' => '0');


        $industrytype = $this->data['results'] = $this->common->select_data_by_condition('industry_type', $contition_array, $data = 'industry_name', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);
        // echo "<pre>";print_r($industrytype);die();
        $unique = array_merge($businessdata, $businesstype, $industrytype);
        foreach ($unique as $key => $value) {
            foreach ($value as $ke => $val) {
                if ($val != "") {


                    $result[] = $val;
                }
            }
        }

        $results = array_unique($result);
        foreach ($results as $key => $value) {
            $result1[$key]['label'] = $value;
            $result1[$key]['value'] = $value;
        }

        $this->data['demo'] = array_values($result1);








        $this->load->view('business_profile/business_following', $this->data);
    }

// end of user list
    //deactivate user start
    public function deactivate($id) {


        $data = array(
            'status' => 0
        );

        $update = $this->common->update_data($data, 'business_profile', 'user_id', $id);

        if ($update) {


            $this->session->set_flashdata('success', 'You are deactivate successfully.');
            redirect('dashboard', 'refresh');
        } else {
            $this->session->flashdata('error', 'Sorry!! Your are not deactivate!!');
            redirect('business_profile', 'refresh');
        }
    }

// deactivate user end

    public function image_upload_ajax() {



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
                        $bgSave = '<div id="uX' . $session_uid . '" class="bgSave wallbutton blackButton">Save Cover</div>';


// khyati start


                        $config['upload_path'] = 'uploads/user_image/';
                        $config['allowed_types'] = 'jpg|jpeg|png|gif|mp4|3gp|mpeg|mpg|mpe|qt|mov|avi|pdf';

                        $config['file_name'] = $_FILES['photoimg']['name'];

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

                        $update = $this->common->update_data($data, 'business_profile', 'user_id', $session_uid);
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

            $update = $this->common->update_data($data, 'business_profile', 'user_id', $session_uid);
            if ($update) {

                echo $position;
            }
        }
    }

    // khyati change end 15 2 


    function slug_script() {

        $this->db->select('business_profile_id,company_name');
        $res = $this->db->get('business_profile')->result();
        foreach ($res as $k => $v) {
            $data = array('business_slug' => $this->setcategory_slug($v->company_name, 'business_slug', 'business_profile'));
            $this->db->where('business_profile_id', $v->business_profile_id);
            $this->db->update('business_profile', $data);
        }
        echo "yes";
    }

// create pdf start

    public function creat_pdf($id) {

        $contition_array = array('business_profile_post_id' => $id, 'status' => '1');
        $this->data['businessdata'] = $this->common->select_data_by_condition('business_profile_post', $contition_array, $data, $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
        $this->load->view('business_profile/business_pdfdispaly', $this->data);
    }

//create pdf end
    // cover pic controller

    public function ajaxpro() {
        $userid = $this->session->userdata('aileenuser');

        $data = $_POST['image'];


        $imageName = time() . '.png';
        $base64string = $data;
        file_put_contents('uploads/bus_bg/' . $imageName, base64_decode(explode(',', $base64string)[1]));

        $data = array(
            'profile_background' => $imageName
        );

        $update = $this->common->update_data($data, 'business_profile', 'user_id', $userid);

        $this->data['busdata'] = $this->common->select_data_by_id('business_profile', 'user_id', $userid, $data = '*', $join_str = array());

        echo '<img src="' . $this->data['busdata'][0]['profile_background'] . '" />';
    }

    public function imagedata() {
        $userid = $this->session->userdata('aileenuser');

        $config['upload_path'] = 'uploads/bus_bg';
        $config['allowed_types'] = 'jpg|jpeg|png|gif';

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


        $updatedata = $this->common->update_data($data, 'business_profile', 'user_id', $userid);

        if ($updatedata) {
            echo $userid;
        } else {
            echo "welcome";
        }
    }

    // cover pic end
// busienss_profile like comment ajax start

    public function like_comment() {

        $userid = $this->session->userdata('aileenuser');
        $post_id = $_POST["post_id"];


        $contition_array = array('business_profile_post_comment_id' => $_POST["post_id"], 'status' => '1');
        $businessprofiledata = $this->data['businessprofiledata'] = $this->common->select_data_by_condition('business_profile_post_comment', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');


        $business_comment_likes_count = $businessprofiledata[0]['business_comment_likes_count'];
        $likeuserarray = explode(',', $businessprofiledata[0]['business_comment_like_user']);

        if (!in_array($userid, $likeuserarray)) { //echo "falguni"; die();
            $user_array = array_push($likeuserarray, $userid);

            if ($businessprofiledata[0]['business_comment_likes_count'] == 0) {
                $userid = implode('', $likeuserarray);
            } else {
                $userid = implode(',', $likeuserarray);
            }

            $data = array(
                'business_comment_likes_count' => $business_comment_likes_count + 1,
                'business_comment_like_user' => $userid,
                'modify_date' => date('y-m-d h:i:s')
            );



            $updatdata = $this->common->update_data($data, 'business_profile_post_comment', 'business_profile_post_comment_id', $post_id);
            $contition_array = array('business_profile_post_comment_id' => $_POST["post_id"], 'status' => '1');
            $businessprofiledata1 = $this->data['businessprofiledata1'] = $this->common->select_data_by_condition('business_profile_post_comment', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

            if ($updatdata) {


                $cmtlike1 = '<a id="' . $businessprofiledata1[0]['business_profile_post_comment_id'] . '" onClick="comment_like(this.id)">';
                $cmtlike1 .= ' <i class="fa fa-thumbs-up" aria-hidden="true">';
                $cmtlike1 .= '</i>';
                $cmtlike1 .= '<span>';
                if ($businessprofiledata1[0]['business_comment_likes_count'] > 0) {
                    $cmtlike1 .= $businessprofiledata1[0]['business_comment_likes_count'] . '';
                }
                $cmtlike1 .= '</span>';
                $cmtlike1 .= '</a>';
                echo $cmtlike1;
            } else {
                
            }
        } else {

            foreach ($likeuserarray as $key => $val) {
                if ($val == $userid) {
                    $user_array = array_splice($likeuserarray, $key, 1);
                }
            }

            $data = array(
                'business_comment_likes_count' => $business_comment_likes_count - 1,
                'business_comment_like_user' => implode(',', $likeuserarray),
                'modify_date' => date('y-m-d h:i:s')
            );


            $updatdata = $this->common->update_data($data, 'business_profile_post_comment', 'business_profile_post_comment_id', $post_id);
            $contition_array = array('business_profile_post_comment_id' => $_POST["post_id"], 'status' => '1');
            $businessprofiledata2 = $this->data['businessprofiledata2'] = $this->common->select_data_by_condition('business_profile_post_comment', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

            if ($updatdata) {

                $cmtlike1 = '<a id="' . $businessprofiledata2[0]['business_profile_post_comment_id'] . '" onClick="comment_like(this.id)">';
                $cmtlike1 .= '<i class="fa fa-thumbs-o-up fa-1x" aria-hidden="true">';
                $cmtlike1 .= '</i>';
                $cmtlike1 .= '<span>';
                if ($businessprofiledata2[0]['business_comment_likes_count'] > 0) {
                    $cmtlike1 .= $businessprofiledata2[0]['business_comment_likes_count'] . '';
                }
                $cmtlike1 .= '</span>';
                $cmtlike1 .= '</a>';
                echo $cmtlike1;
            } else {
                
            }
        }
    }

    public function like_comment1() {

        $userid = $this->session->userdata('aileenuser');
        $post_id = $_POST["post_id"];


        $contition_array = array('business_profile_post_comment_id' => $_POST["post_id"], 'status' => '1');
        $businessprofiledata = $this->data['businessprofiledata'] = $this->common->select_data_by_condition('business_profile_post_comment', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');


        $business_comment_likes_count = $businessprofiledata[0]['business_comment_likes_count'];
        $likeuserarray = explode(',', $businessprofiledata[0]['business_comment_like_user']);

        if (!in_array($userid, $likeuserarray)) { //echo "falguni"; die();
            $user_array = array_push($likeuserarray, $userid);

            if ($businessprofiledata[0]['business_comment_likes_count'] == 0) {
                $userid = implode('', $likeuserarray);
            } else {
                $userid = implode(',', $likeuserarray);
            }

            $data = array(
                'business_comment_likes_count' => $business_comment_likes_count + 1,
                'business_comment_like_user' => $userid,
                'modify_date' => date('y-m-d h:i:s')
            );



            $updatdata = $this->common->update_data($data, 'business_profile_post_comment', 'business_profile_post_comment_id', $post_id);
            $contition_array = array('business_profile_post_comment_id' => $_POST["post_id"], 'status' => '1');
            $businessprofiledata1 = $this->data['businessprofiledata1'] = $this->common->select_data_by_condition('business_profile_post_comment', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

            if ($updatdata) {


                $cmtlike1 = '<a id="' . $businessprofiledata1[0]['business_profile_post_comment_id'] . '" onClick="comment_like1(this.id)">';
                $cmtlike1 .= ' <i class="fa fa-thumbs-up" aria-hidden="true">';
                $cmtlike1 .= '</i>';
                $cmtlike1 .= '<span>';
                if ($businessprofiledata1[0]['business_comment_likes_count'] > 0) {
                    $cmtlike1 .= $businessprofiledata1[0]['business_comment_likes_count'] . '';
                }
                $cmtlike1 .= '</span>';
                $cmtlike1 .= '</a>';
                echo $cmtlike1;
            } else {
                
            }
        } else {

            foreach ($likeuserarray as $key => $val) {
                if ($val == $userid) {
                    $user_array = array_splice($likeuserarray, $key, 1);
                }
            }

            $data = array(
                'business_comment_likes_count' => $business_comment_likes_count - 1,
                'business_comment_like_user' => implode(',', $likeuserarray),
                'modify_date' => date('y-m-d h:i:s')
            );


            $updatdata = $this->common->update_data($data, 'business_profile_post_comment', 'business_profile_post_comment_id', $post_id);
            $contition_array = array('business_profile_post_comment_id' => $_POST["post_id"], 'status' => '1');
            $businessprofiledata2 = $this->data['businessprofiledata2'] = $this->common->select_data_by_condition('business_profile_post_comment', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

            if ($updatdata) {

                $cmtlike1 = '<a id="' . $businessprofiledata2[0]['business_profile_post_comment_id'] . '" onClick="comment_like1(this.id)">';
                $cmtlike1 .= '<i class="fa fa-thumbs-o-up fa-1x" aria-hidden="true">';
                $cmtlike1 .= '</i>';
                $cmtlike1 .= '<span>';
                if ($businessprofiledata2[0]['business_comment_likes_count'] > 0) {
                    $cmtlike1 .= $businessprofiledata2[0]['business_comment_likes_count'] . '';
                }
                $cmtlike1 .= '</span>';
                $cmtlike1 .= '</a>';
                echo $cmtlike1;
            } else {
                
            }
        }
    }

// Business_profile comment like end 
//Business_profile comment delete start
    public function delete_comment() {
        $userid = $this->session->userdata('aileenuser');
        $post_id = $_POST["post_id"];
        $post_delete = $_POST["post_delete"];

        $data = array(
            'status' => 0,
        );


        $updatdata = $this->common->update_data($data, 'business_profile_post_comment', 'business_profile_post_comment_id', $post_id);


        $contition_array = array('business_profile_post_id' => $post_delete, 'status' => '1');
        $businessprofiledata = $this->data['businessprofiledata'] = $this->common->select_data_by_condition('business_profile_post_comment', $contition_array, $data = '*', $sortby = 'business_profile_post_comment_id', $orderby = 'DESC', $limit = '1', $offset = '', $join_str = array(), $groupby = '');

        $contition_array = array('business_profile_post_id' => $post_delete, 'status' => '1');
        $buscmtcnt = $this->common->select_data_by_condition('business_profile_post_comment', $contition_array, $data = '*', $sortby = 'business_profile_post_comment_id', $orderby = 'DESC', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        //echo '<pre>'; print_r($businessprofiledata); die();
// khyati changes start
        if (count($businessprofiledata) > 0) {
            foreach ($businessprofiledata as $business_profile) {

                $companyname = $this->db->get_where('business_profile', array('user_id' => $business_profile['user_id']))->row()->company_name;

                $business_userimage = $this->db->get_where('business_profile', array('user_id' => $business_profile['user_id'], 'status' => 1))->row()->business_user_image;

                $cmtinsert .= '<div class="all-comment-comment-box">';
                $cmtinsert .= '<div class="post-design-pro-comment-img">';


                $cmtinsert .= '<img  src="' . base_url(USERIMAGE . $business_userimage) . '" alt="">  </div>';

                $cmtinsert .= '<div class="comment-name"><b>' . $companyname . '</b>';
                $cmtinsert .= '</div>';
                $cmtinsert .= '<div class="comment-details" id= "showcomment' . $business_profile['business_profile_post_comment_id'] . '"" >';
                $cmtinsert .= $business_profile['comments'];
                $cmtinsert .= '</div>';
                $cmtinsert .= '<div class="edit-comment-box"><div class="inputtype-edit-comment">';
                $cmtinsert .= '<textarea type="text" class="textarea" name="' . $business_profile['business_profile_post_comment_id'] . '" id="editcomment' . $business_profile['business_profile_post_comment_id'] . '" style="display:none;resize: none;" onClick="commentedit(this.name)">' . $business_profile['comments'] . '</textarea>';
                $cmtinsert .= '<span class="comment-edit-button"><button id="editsubmit' . $business_profile['business_profile_post_comment_id'] . '" style="display:none" onClick="edit_comment(' . $business_profile['business_profile_post_comment_id'] . ')">Comment</button></span>';
                $cmtinsert .= '</div></div>';
//                $cmtinsert .= '<input type="text" name="' . $business_profile['business_profile_post_comment_id'] . '" id="editcomment' . $business_profile['business_profile_post_comment_id'] . '"style="display:none;" value="' . $business_profile['comments'] . ' " onClick="commentedit(this.name)">';
//                $cmtinsert .= '<button id="editsubmit' . $business_profile['business_profile_post_comment_id'] . '" style="display:none;" onClick="edit_comment(' . $business_profile['business_profile_post_comment_id'] . ')">Comment</button><div class="art-comment-menu-design"> <div class="comment-details-menu" id="likecomment1' . $business_profile['business_profile_post_comment_id'] . '">';
                $cmtinsert .= '<div class="art-comment-menu-design"><div class="comment-details-menu" id="likecomment1' . $business_profile['business_profile_post_comment_id'] . '">';
                $cmtinsert .= '<a id="' . $business_profile['business_profile_post_comment_id'] . '"';
                $cmtinsert .= 'onClick="comment_like1(this.id)">';

                $userid = $this->session->userdata('aileenuser');
                $contition_array = array('business_profile_post_comment_id' => $business_profile['business_profile_post_comment_id'], 'status' => '1');
                $businesscommentlike = $this->data['businesscommentlike'] = $this->common->select_data_by_condition('business_profile_post_comment', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
                $likeuserarray = explode(',', $businesscommentlike[0]['business_comment_like_user']);

                if (!in_array($userid, $likeuserarray)) {


                    $cmtinsert .= '<i class="fa fa-thumbs-o-up fa-1x" aria-hidden="true"></i>';
                } else {
                    $cmtinsert .= '<i class="fa fa-thumbs-up" aria-hidden="true"></i>';
                }


                $cmtinsert .= '<span>';
                if ($business_profile['business_comment_likes_count'] > 0) {
                    $cmtinsert .= '' . $business_profile['business_comment_likes_count'];
                }
                $cmtinsert .= '</span>';
                $cmtinsert .= '</a></div>';


                $userid = $this->session->userdata('aileenuser');
                if ($business_profile['user_id'] == $userid) {

                    $cmtinsert .= '<span role="presentation" aria-hidden="true"> · </span>';
                    $cmtinsert .= '<div class="comment-details-menu">';


                    $cmtinsert .= '<div id="editcommentbox' . $business_profile['business_profile_post_comment_id'] . '"style="display:block;">';

                    $cmtinsert .= '<a id="' . $business_profile['business_profile_post_comment_id'] . '"';
                    $cmtinsert .= 'onClick="comment_editbox(this.id)">';
                    $cmtinsert .= 'Edit';
                    $cmtinsert .= '</a></div>';

                    $cmtinsert .= '<div id="editcancle' . $business_profile['business_profile_post_comment_id'] . '"style="display:none;">';

                    $cmtinsert .= '<a id="' . $business_profile['business_profile_post_comment_id'] . '"';
                    $cmtinsert .= 'onClick="comment_editcancle(this.id)">';
                    $cmtinsert .= 'Cancel';
                    $cmtinsert .= '</a></div>';

                    $cmtinsert .= '</div>';
                }




                $userid = $this->session->userdata('aileenuser');

                $business_userid = $this->db->get_where('business_profile_post', array('business_profile_post_id' => $business_profile['business_profile_post_id'], 'status' => 1))->row()->user_id;


                if ($business_profile['user_id'] == $userid || $business_userid == $userid) {

                    $cmtinsert .= '<span role="presentation" aria-hidden="true"> · </span>';
                    $cmtinsert .= '<div class="comment-details-menu">';


                    $cmtinsert .= '<input type="hidden" name="post_delete"';
                    $cmtinsert .= 'id="post_delete"';
                    $cmtinsert .= 'value= "' . $business_profile['business_profile_post_id'] . '">';
                    $cmtinsert .= '<a id="' . $business_profile['business_profile_post_comment_id'] . '"';
                    $cmtinsert .= 'onClick="comment_delete(this.id)">';
                    $cmtinsert .= 'Delete';
                    $cmtinsert .= '</a></div>';
                }

                $cmtinsert .= '<span role="presentation" aria-hidden="true"> · </span>';
                $cmtinsert .= '<div class="comment-details-menu">';
                $cmtinsert .= '<p>' . $business_profile['created_date'] . '</p></div></div></div>';


                // comment aount variable start
                $idpost = $business_profile['business_profile_post_id'];
                $cmtcount = '<a onClick="commentall(this.id)" id="' . $idpost . '">';
                $cmtcount .= '<i class="fa fa-comment-o" aria-hidden="true">';
                $cmtcount .= ' ' . count($buscmtcnt) . '';
                $cmtcount .= '</i></a>';

                // comment count variable end 
            }
        } else {
            $idpost = $business_profile['business_profile_post_id'];
            $cmtcount = '<a onClick="commentall(this.id)" id="' . $idpost . '">';
            $cmtcount .= '<i class="fa fa-comment-o" aria-hidden="true">';
            $cmtcount .= '</i></a>';
        }
        echo json_encode(
                array("comment" => $cmtinsert,
                    "count" => $cmtcount));
    }

//second page manage in manage post for function start

    public function delete_commenttwo() {
        $userid = $this->session->userdata('aileenuser');
        $post_id = $_POST["post_id"];
        $post_delete = $_POST["post_delete"];

        $data = array(
            'status' => 0,
        );
        $updatdata = $this->common->update_data($data, 'business_profile_post_comment', 'business_profile_post_comment_id', $post_id);


        $contition_array = array('business_profile_post_id' => $post_delete, 'status' => '1');
        $businessprofiledata = $this->data['businessprofiledata'] = $this->common->select_data_by_condition('business_profile_post_comment', $contition_array, $data = '*', $sortby = 'business_profile_post_comment_id', $orderby = 'DESC', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        // echo '<pre>'; print_r($businessprofiledata); die();
// khyati changes start
        if (count($businessprofiledata) > 0) {
            foreach ($businessprofiledata as $business_profile) {

                $companyname = $this->db->get_where('business_profile', array('user_id' => $business_profile['user_id']))->row()->company_name;

                $business_userimage = $this->db->get_where('business_profile', array('user_id' => $business_profile['user_id'], 'status' => 1))->row()->business_user_image;

                $cmtinsert .= '<div class="all-comment-comment-box">';
                $cmtinsert .= '<div class="post-design-pro-comment-img">';
                $cmtinsert .= '<img  src="' . base_url(USERIMAGE . $business_userimage) . '" alt="">  </div>';
                $cmtinsert .= '<div class="comment-name"><b>' . $companyname . '</b>';
                $cmtinsert .= '</div>';
                $cmtinsert .= '<div class="comment-details" id="showcommenttwo' . $business_profile['business_profile_post_comment_id'] . '">';
                $cmtinsert .= $business_profile['comments'];
                $cmtinsert .= '</div>';
                $cmtinsert .= '<div class="edit-comment-box"><div class="inputtype-edit-comment">';
                $cmtinsert .= '<textarea type="text" class="textarea" name="' . $business_profile['business_profile_post_comment_id'] . '" id="editcommenttwo' . $business_profile['business_profile_post_comment_id'] . '" style="display:none;resize: none;" onClick="commentedittwo(this.name)">' . $business_profile['comments'] . '</textarea>';
                $cmtinsert .= '<span class="comment-edit-button"><button id="editsubmittwo' . $business_profile['business_profile_post_comment_id'] . '" style="display:none" onClick="edit_commenttwo(' . $business_profile['business_profile_post_comment_id'] . ')">Comment</button></span>';
                $cmtinsert .= '</div></div>';
//                $cmtinsert .= '<input type="text" name="' . $business_profile['business_profile_post_comment_id'] . '" id="editcommenttwo' . $business_profile['business_profile_post_comment_id'] . '"style="display:none;" value="' . $business_profile['comments'] . ' " onClick="commentedittwo(this.name)">';
//                $cmtinsert .= '<button id="editsubmittwo' . $business_profile['business_profile_post_comment_id'] . '" style="display:none;" onClick="edit_commenttwo(' . $business_profile['business_profile_post_comment_id'] . ')">Comment</button><div class="art-comment-menu-design"> <div class="comment-details-menu" id="likecomment1' . $business_profile['business_profile_post_comment_id'] . '">';

                $cmtinsert .= '<div class="art-comment-menu-design"><div class="comment-details-menu" id="likecomment1' . $business_profile['business_profile_post_comment_id'] . '">';
                $cmtinsert .= '<a id="' . $business_profile['business_profile_post_comment_id'] . '"';
                $cmtinsert .= 'onClick="comment_like1(this.id)">';

                $userid = $this->session->userdata('aileenuser');
                $contition_array = array('business_profile_post_comment_id' => $business_profile['business_profile_post_comment_id'], 'status' => '1');
                $businesscommentlike = $this->data['businesscommentlike'] = $this->common->select_data_by_condition('business_profile_post_comment', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
                $likeuserarray = explode(',', $businesscommentlike[0]['business_comment_like_user']);

                if (!in_array($userid, $likeuserarray)) {


                    $cmtinsert .= '<i class="fa fa-thumbs-o-up fa-1x" aria-hidden="true"></i>';
                } else {
                    $cmtinsert .= '<i class="fa fa-thumbs-up" aria-hidden="true"></i>';
                }


                $cmtinsert .= '<span>';
                if ($business_profile['business_comment_likes_count'] > 0) {
                    $cmtinsert .= '' . $business_profile['business_comment_likes_count'];
                }
                $cmtinsert .= '</span>';
                $cmtinsert .= '</a></div>';


                $userid = $this->session->userdata('aileenuser');
                if ($business_profile['user_id'] == $userid) {

                    $cmtinsert .= '<span role="presentation" aria-hidden="true"> · </span>';
                    $cmtinsert .= '<div class="comment-details-menu">';


                    $cmtinsert .= '<div id="editcommentboxtwo' . $business_profile['business_profile_post_comment_id'] . '"style="display:block;">';

                    $cmtinsert .= '<a id="' . $business_profile['business_profile_post_comment_id'] . '"';
                    $cmtinsert .= 'onClick="comment_editboxtwo(this.id)">';
                    $cmtinsert .= 'Edit';
                    $cmtinsert .= '</a></div>';

                    $cmtinsert .= '<div id="editcancletwo' . $business_profile['business_profile_post_comment_id'] . '"style="display:none;">';

                    $cmtinsert .= '<a id="' . $business_profile['business_profile_post_comment_id'] . '"';
                    $cmtinsert .= 'onClick="comment_editcancletwo(this.id)">';
                    $cmtinsert .= 'Cancel';
                    $cmtinsert .= '</a></div>';

                    $cmtinsert .= '</div>';
                }




                $userid = $this->session->userdata('aileenuser');

                $business_userid = $this->db->get_where('business_profile_post', array('business_profile_post_id' => $business_profile['business_profile_post_id'], 'status' => 1))->row()->user_id;


                if ($business_profile['user_id'] == $userid || $business_userid == $userid) {

                    $cmtinsert .= '<span role="presentation" aria-hidden="true"> · </span>';
                    $cmtinsert .= '<div class="comment-details-menu">';


                    $cmtinsert .= '<input type="hidden" name="post_deletetwo"';
                    $cmtinsert .= 'id="post_deletetwo"';
                    $cmtinsert .= 'value= "' . $business_profile['business_profile_post_id'] . '">';
                    $cmtinsert .= '<a id="' . $business_profile['business_profile_post_comment_id'] . '"';
                    $cmtinsert .= 'onClick="comment_deletetwo(this.id)">';
                    $cmtinsert .= 'Delete';
                    $cmtinsert .= '</a></div>';
                }

                $cmtinsert .= '<span role="presentation" aria-hidden="true"> · </span>';
                $cmtinsert .= '<div class="comment-details-menu">';
                $cmtinsert .= '<p>' . $business_profile['created_date'] . '</p></div></div></div>';
                // comment aount variable start
                $idpost = $business_profile['business_profile_post_id'];
                $cmtcount = '<a onClick="commentall1(this.id)" id="' . $idpost . '">';
                $cmtcount .= '<i class="fa fa-comment-o" aria-hidden="true">';
                $cmtcount .= ' ' . count($businessprofiledata) . '';
                $cmtcount .= '</i></a>';

                // comment count variable end 
            }
        } else {
            $idpost = $business_profile['business_profile_post_id'];
            $cmtcount = '<a onClick="commentall1(this.id)" id="' . $idpost . '">';
            $cmtcount .= '<i class="fa fa-comment-o" aria-hidden="true">';
            $cmtcount .= '</i></a>';
        }
        echo json_encode(
                array("comment" => $cmtinsert,
                    "count" => $cmtcount));
    }

//Business_profile comment delete end     
// Business_profile post like start

    public function like_post() {

        $userid = $this->session->userdata('aileenuser');
        $post_id = $_POST["post_id"];

        $contition_array = array('business_profile_post_id' => $_POST["post_id"], 'status' => '1');
        $businessprofiledata = $this->data['businessprofiledata'] = $this->common->select_data_by_condition('business_profile_post', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');


        $business_likes_count = $businessprofiledata[0]['business_likes_count'];
        $likeuserarray = explode(',', $businessprofiledata[0]['business_like_user']);

        if (!in_array($userid, $likeuserarray)) {

            $user_array = array_push($likeuserarray, $userid);

            if ($businessprofiledata[0]['business_likes_count'] == 0) {
                $userid = implode('', $likeuserarray);
            } else {
                $userid = implode(',', $likeuserarray);
            }

            $data = array(
                'business_likes_count' => $business_likes_count + 1,
                'business_like_user' => $userid,
                'modify_date' => date('y-m-d h:i:s')
            );


            $updatdata = $this->common->update_data($data, 'business_profile_post', 'business_profile_post_id', $post_id);
            $contition_array = array('business_profile_post_id' => $_POST["post_id"], 'status' => '1');
            $businessprofiledata1 = $this->data['businessprofiledata1'] = $this->common->select_data_by_condition('business_profile_post', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

            if ($updatdata) {
                //echo"add";

                $cmtlike = '<li>';
                $cmtlike .= '<a id="' . $businessprofiledata1[0]['business_profile_post_id'] . '" onClick="post_like(this.id)">';
                $cmtlike .= ' <i class="fa fa-thumbs-up" aria-hidden="true">';
                $cmtlike .= '</i>';
                $cmtlike .= '<span>';
                if ($businessprofiledata1[0]['business_likes_count'] > 0) {
                    $cmtlike .= $businessprofiledata1[0]['business_likes_count'] . '';
                }
                $cmtlike .= '</span>';
                $cmtlike .= '</a>';
                $cmtlike .= '</li>';
                //echo $cmtlike;
                //popup box start like user name
                $cmtlikeuser .= '<div id=popuplike' . $businessprofiledata1[0]['business_profile_post_id'] . ' class="overlay">';
                $cmtlikeuser .= '<div class="popup">';
                $cmtlikeuser .= '<div class="pop_content">';

                $contition_array = array('business_profile_post_id' => $businessprofiledata1['business_profile_post_id'], 'status' => '1', 'is_delete' => '0');
                $commnetcount = $this->common->select_data_by_condition('business_profile_post', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

                $likeuser = $commnetcount[0]['business_like_user'];
                $countlike = $commnetcount[0]['business_likes_count'] - 1;

                $likelistarray = explode(',', $likeuser);

                foreach ($likelistarray as $key => $value) {
                    $business_fname1 = $this->db->get_where('business_profile', array('user_id' => $value, 'status' => 1))->row()->company_name;
                    $cmtlikeuser .= '<a href="' . base_url('business_profile/business_resume/' . $value) . '">';
                    $cmtlikeuser .= '' . ucwords($business_fname1) . '&nbsp;';
                    $cmtlikeuser .= '</a>';
                }

                $cmtlikeuser .= '<p class="okk"><a class="cnclbtn" href="#">Cancel</a></p>';
                $cmtlikeuser .= '</div>';
                $cmtlikeuser .= '</div>';
                $cmtlikeuser .= '</div>';
//popup box end like user name

                $cmtlikeuser .= '<a href=#popuplike' . $businessprofiledata1[0]['business_profile_post_id'] . '>';


                $contition_array = array('business_profile_post_id' => $businessprofiledata1[0]['business_profile_post_id'], 'status' => '1', 'is_delete' => '0');
                $commnetcount = $this->common->select_data_by_condition('business_profile_post', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

                $likeuser = $commnetcount[0]['business_like_user'];
                $countlike = $commnetcount[0]['business_likes_count'] - 1;

                $likelistarray = explode(',', $likeuser);
                
                $business_fname1 = $this->db->get_where('business_profile', array('user_id' => $likelistarray[0], 'status' => 1))->row()->company_name;

                $cmtlikeuser .= '<div class="fl" style=" padding-left: 22px;" >';

                $cmtlikeuser .= '' . ucwords($business_fname1) . '&nbsp;';

                $cmtlikeuser .= '</div>';


                if (count($likelistarray) > 1) {

                    $cmtlikeuser .= '<div class="fl" style="padding-right: 5px;">';
                    $cmtlikeuser .= 'and';
                    $cmtlikeuser .= '</div>';

                    $cmtlikeuser .= '<div style="padding-left: 5px;">';
                    $cmtlikeuser .= '' . $countlike . ' others';
                    $cmtlikeuser .= '</div>';
                }

                $cmtlikeuser .= '</a>';

                echo json_encode(
                        array("like" => $cmtlike,
                            "likeuser" => $cmtlikeuser));
            } else {
                
            }
        } else {

            foreach ($likeuserarray as $key => $val) {
                if ($val == $userid) { //echo $key;
                    $user_array = array_splice($likeuserarray, $key, 1);
                }
            }

            $data = array(
                'business_likes_count' => $business_likes_count - 1,
                'business_like_user' => implode(',', $likeuserarray),
                'modify_date' => date('y-m-d h:i:s')
            );


            $updatdata = $this->common->update_data($data, 'business_profile_post', 'business_profile_post_id', $post_id);
            $contition_array = array('business_profile_post_id' => $_POST["post_id"], 'status' => '1');
            $businessprofiledata2 = $this->data['businessprofiledata2'] = $this->common->select_data_by_condition('business_profile_post', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

            if ($updatdata) {

                $cmtlike = '<li>';
                $cmtlike .= '<a id="' . $businessprofiledata2[0]['business_profile_post_id'] . '" onClick="post_like(this.id)">';
                $cmtlike .= '<i class="fa fa-thumbs-o-up fa-1x" aria-hidden="true">';
                $cmtlike .= '</i>';
                $cmtlike .= '<span>';
                if ($businessprofiledata2[0]['business_likes_count'] > 0) {
                    $cmtlike .= $businessprofiledata2[0]['business_likes_count'] . '';
                }
                $cmtlike .= '</span>';
                $cmtlike .= '</a>';
                $cmtlike .= '</li>';
//echo $cmtlike;
//popup box start like user name
                //popup box start like user name
                $cmtlikeuser .= '<div id=popuplike' . $businessprofiledata2[0]['business_profile_post_id'] . ' class="overlay">';
                $cmtlikeuser .= '<div class="popup">';
                $cmtlikeuser .= '<div class="pop_content">';

                $contition_array = array('business_profile_post_id' => $businessprofiledata2['business_profile_post_id'], 'status' => '1', 'is_delete' => '0');
                $commnetcount = $this->common->select_data_by_condition('business_profile_post', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

                $likeuser = $commnetcount[0]['business_like_user'];
                $countlike = $commnetcount[0]['business_likes_count'] - 1;

                $likelistarray = explode(',', $likeuser);

                foreach ($likelistarray as $key => $value) {
                    $business_fname1 = $this->db->get_where('business_profile', array('user_id' => $value, 'status' => 1))->row()->company_name;
                    $cmtlikeuser .= '<a href="' . base_url('business_profile/business_resume/' . $value) . '">';
                    $cmtlikeuser .= '' . ucwords($business_fname1) . '&nbsp;';
                    $cmtlikeuser .= '</a>';
                }

                $cmtlikeuser .= '<p class="okk"><a class="cnclbtn" href="#">Cancel</a></p>';
                $cmtlikeuser .= '</div>';
                $cmtlikeuser .= '</div>';
                $cmtlikeuser .= '</div>';
//popup box end like user name

                $cmtlikeuser .= '<a href=#popuplike' . $businessprofiledata2[0]['business_profile_post_id'] . '>';


                $contition_array = array('business_profile_post_id' => $businessprofiledata2[0]['business_profile_post_id'], 'status' => '1', 'is_delete' => '0');
                $commnetcount = $this->common->select_data_by_condition('business_profile_post', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
                
                
                $likeuser = $commnetcount[0]['business_like_user'];
                $countlike = $commnetcount[0]['business_likes_count'] - 1;

                $likelistarray = explode(',', $likeuser);
                
                $business_fname1 = $this->db->get_where('business_profile', array('user_id' => $likelistarray[0], 'status' => 1))->row()->company_name;

                $cmtlikeuser .= '<div class="fl" style=" padding-left: 22px;" >';

                $cmtlikeuser .= '' . ucwords($business_fname1) . '&nbsp;';

                $cmtlikeuser .= '</div>';


                if (count($likelistarray) > 1) {

                    $cmtlikeuser .= '<div class="fl" style="padding-right: 5px;">';
                    $cmtlikeuser .= 'and';
                    $cmtlikeuser .= '</div>';

                    $cmtlikeuser .= '<div style="padding-left: 5px;">';
                    $cmtlikeuser .= '' . $countlike . ' others';
                    $cmtlikeuser .= '</div>';
                }

                $cmtlikeuser .= '</a>';

                echo json_encode(
                        array("like" => $cmtlike,
                            "likeuser" => $cmtlikeuser));
            } else {
                
            }
        }

//jsondata
    }

// business_profile post  like end
//business_profile comment insert start

    public function insert_commentthree() {

        $userid = $this->session->userdata('aileenuser');

        $post_id = $_POST["post_id"];
        $post_comment = $_POST["comment"];

        $data = array(
            'user_id' => $userid,
            'business_profile_post_id' => $post_id,
            'comments' => $post_comment,
            'created_date' => date('Y-m-d', time()),
            'status' => 1,
            'is_delete' => 0
        );



        $insert_id = $this->common->insert_data_getid($data, 'business_profile_post_comment');

        $contition_array = array('business_profile_post_id' => $_POST["post_id"], 'status' => '1');
        $businessprofiledata = $this->data['businessprofiledata'] = $this->common->select_data_by_condition('business_profile_post_comment', $contition_array, $data = '*', $sortby = 'business_profile_post_comment_id', $orderby = 'DESC', $limit = '1', $offset = '', $join_str = array(), $groupby = '');
//echo "<pre>"; print_r($businessprofiledata); die();

        $contition_array = array('business_profile_post_id' => $_POST["post_id"], 'status' => '1');
        $buscmtcnt = $this->common->select_data_by_condition('business_profile_post_comment', $contition_array, $data = '*', $sortby = 'business_profile_post_comment_id', $orderby = 'DESC', $limit = '', $offset = '', $join_str = array(), $groupby = '');
// khyati changes start

        foreach ($businessprofiledata as $business_profile) {

            $company_name = $this->db->get_where('business_profile', array('user_id' => $business_profile['user_id']))->row()->company_name;

            $business_userimage = $this->db->get_where('business_profile', array('user_id' => $business_profile['user_id'], 'status' => 1))->row()->business_user_image;

            // $cmtinsert = '<div class="all-comment-comment-box">';

            $cmtinsert .= '<div class="all-comment-comment-box">';
            $cmtinsert .= '<div class="post-design-pro-comment-img">';
            $cmtinsert .= '<img  src="' . base_url(USERIMAGE . $business_userimage) . '" alt="">  </div>';
            $cmtinsert .= '<div class="comment-name"><b>' . ucwords($company_name) . '</b>';
            $cmtinsert .= '</div>';
            $cmtinsert .= '<div class="comment-details" id="showcomment' . $business_profile['business_profile_post_comment_id'] . '">';
            $cmtinsert .= $business_profile['comments'];
            $cmtinsert .= '</div>';

            $cmtinsert .= '<div class="edit-comment-box"><div class="inputtype-edit-comment">';
            $cmtinsert .= '<textarea type="text" class="textarea" name="' . $business_profile['business_profile_post_comment_id'] . '" id="editcomment' . $business_profile['business_profile_post_comment_id'] . '" style="display:none;resize: none;" onClick="commentedit(this.name)">' . $business_profile['comments'] . '</textarea>';
            $cmtinsert .= '<span class="comment-edit-button"><button id="editsubmit' . $business_profile['business_profile_post_comment_id'] . '" style="display:none" onClick="edit_comment(' . $business_profile['business_profile_post_comment_id'] . ')">Comment</button></span>';
            $cmtinsert .= '</div></div>';
            //$cmtinsert .= '<input type="text" name="' . $business_profile['business_profile_post_comment_id'] . '" id="editcomment' . $business_profile['business_profile_post_comment_id'] . '"style="display:none;" value="' . $business_profile['comments'] . ' " onClick="commentedit(this.name)">';
            //$cmtinsert .= '<button id="editsubmit' . $business_profile['business_profile_post_comment_id'] . '" style="display:none;" onClick="edit_comment(' . $business_profile['business_profile_post_comment_id'] . ')">Comment</button><div class="art-comment-menu-design"> <div class="comment-details-menu" id="likecomment1' . $business_profile['business_profile_post_comment_id'] . '">';

            $cmtinsert .= '<div class="art-comment-menu-design"><div class="comment-details-menu" id="likecomment1' . $business_profile['business_profile_post_comment_id'] . '">';
            $cmtinsert .= '<a id="' . $business_profile['business_profile_post_comment_id'] . '"';
            $cmtinsert .= 'onClick="comment_like1(this.id)">';

            $userid = $this->session->userdata('aileenuser');
            $contition_array = array('business_profile_post_comment_id' => $business_profile['business_profile_post_comment_id'], 'status' => '1');
            $businesscommentlike = $this->data['businesscommentlike'] = $this->common->select_data_by_condition('business_profile_post_comment', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
            $likeuserarray = explode(',', $businesscommentlike[0]['business_comment_like_user']);

            if (!in_array($userid, $likeuserarray)) {


                $cmtinsert .= '<i class="fa fa-thumbs-o-up fa-1x" aria-hidden="true"></i>';
            } else {
                $cmtinsert .= '<i class="fa fa-thumbs-up" aria-hidden="true"></i>';
            }


            $cmtinsert .= '<span>';
            if ($business_profile['business_comment_likes_count'] > 0) {
                $cmtinsert .= '' . $business_profile['business_comment_likes_count'];
            }
            $cmtinsert .= '</span>';
            $cmtinsert .= '</a></div>';


            $userid = $this->session->userdata('aileenuser');
            if ($business_profile['user_id'] == $userid) {

                $cmtinsert .= '<span role="presentation" aria-hidden="true"> · </span>';
                $cmtinsert .= '<div class="comment-details-menu">';


                $cmtinsert .= '<div id="editcommentbox' . $business_profile['business_profile_post_comment_id'] . '"style="display:block;">';

                $cmtinsert .= '<a id="' . $business_profile['business_profile_post_comment_id'] . '"';
                $cmtinsert .= 'onClick="comment_editbox(this.id)" class="editbox">';
                $cmtinsert .= 'Edit';
                $cmtinsert .= '</a></div>';

                $cmtinsert .= '<div id="editcancle' . $business_profile['business_profile_post_comment_id'] . '"style="display:none;">';

                $cmtinsert .= '<a id="' . $business_profile['business_profile_post_comment_id'] . '"';
                $cmtinsert .= 'onClick="comment_editcancle(this.id)">';
                $cmtinsert .= 'Cancel';
                $cmtinsert .= '</a></div>';

                $cmtinsert .= '</div>';
            }




            $userid = $this->session->userdata('aileenuser');

            $business_userid = $this->db->get_where('business_profile_post', array('business_profile_post_id' => $business_profile['business_profile_post_id'], 'status' => 1))->row()->user_id;


            if ($business_profile['user_id'] == $userid || $business_userid == $userid) {

                $cmtinsert .= '<span role="presentation" aria-hidden="true"> · </span>';
                $cmtinsert .= '<div class="comment-details-menu">';


                $cmtinsert .= '<input type="hidden" name="post_delete"';
                $cmtinsert .= 'id="post_delete"';
                $cmtinsert .= 'value= "' . $business_profile['business_profile_post_id'] . '">';
                $cmtinsert .= '<a id="' . $business_profile['business_profile_post_comment_id'] . '"';
                $cmtinsert .= 'onClick="comment_delete(this.id)">';
                $cmtinsert .= 'Delete <span class="insertcomment' . $business_profile['business_profile_post_comment_id'] . '"></span>';
                $cmtinsert .= '</a></div>';
            }

            $cmtinsert .= '<span role="presentation" aria-hidden="true"> · </span>';
            $cmtinsert .= '<div class="comment-details-menu">';
            $cmtinsert .= '<p>' . $business_profile['created_date'] . '</p></div></div></div>';


            // comment aount variable start
            $idpost = $business_profile['business_profile_post_id'];
            $cmtcount = '<a onClick="commentall(this.id)" id="' . $idpost . '">';
            $cmtcount .= '<i class="fa fa-comment-o" aria-hidden="true">';
            $cmtcount .= ' ' . count($buscmtcnt) . '';
            $cmtcount .= '</i></a>';

            // comment count variable end 
        }
        echo json_encode(
                array("comment" => $cmtinsert,
                    "count" => $cmtcount));
        // khyati chande 
    }

    public function insert_comment() {

        $userid = $this->session->userdata('aileenuser');

        $post_id = $_POST["post_id"];
        $post_comment = $_POST["comment"];

        $data = array(
            'user_id' => $userid,
            'business_profile_post_id' => $post_id,
            'comments' => $post_comment,
            'created_date' => date('Y-m-d', time()),
            'status' => 1,
            'is_delete' => 0
        );



        $insert_id = $this->common->insert_data_getid($data, 'business_profile_post_comment');

        $contition_array = array('business_profile_post_id' => $_POST["post_id"], 'status' => '1');
        $businessprofiledata = $this->data['businessprofiledata'] = $this->common->select_data_by_condition('business_profile_post_comment', $contition_array, $data = '*', $sortby = 'business_profile_post_comment_id', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');
        //echo "<pre>"; print_r($businessprofiledata); die();
        // khyati changes start
        $cmtinsert = '<div class="insertcommenttwo' . $post_id . '">';
        foreach ($businessprofiledata as $business_profile) {
            $company_name = $this->db->get_where('business_profile', array('user_id' => $business_profile['user_id']))->row()->company_name;
            $business_userimage = $this->db->get_where('business_profile', array('user_id' => $business_profile['user_id'], 'status' => 1))->row()->business_user_image;

            $cmtinsert .= '<div class="all-comment-comment-box">';
            $cmtinsert .= '<div class="post-design-pro-comment-img">';
            $cmtinsert .= '<img  src="' . base_url(USERIMAGE . $business_userimage) . '" alt="">  </div>';
            $cmtinsert .= '<div class="comment-name"><b>' . ucwords($company_name) . '</b>';
            $cmtinsert .= '</div>';
            $cmtinsert .= '<div class="comment-details" id= "showcommenttwo' . $business_profile['business_profile_post_comment_id'] . '" >';
            $cmtinsert .= $business_profile['comments'];
            $cmtinsert .= '</div>';
            $cmtinsert .= '<div class="edit-comment-box"><div class="inputtype-edit-comment">';
            $cmtinsert .= '<textarea type="text" class="textarea" name="' . $business_profile['business_profile_post_comment_id'] . '" id="editcommenttwo' . $business_profile['business_profile_post_comment_id'] . '" style="display:none;resize: none;" onclick="commentedittwo(this.name)">' . $business_profile['comments'] . '</textarea>';
            $cmtinsert .= '<span class="comment-edit-button"><button id="editsubmittwo' . $business_profile['business_profile_post_comment_id'] . '" style="display:none" onclick="edit_commenttwo(' . $business_profile['business_profile_post_comment_id'] . ')">Comment</button></span>';
            $cmtinsert .= '</div></div>';

//            $cmtinsert .= '<input type="text" name="' . $business_profile['business_profile_post_comment_id'] . '" id="editcommenttwo' . $business_profile['business_profile_post_comment_id'] . '"style="display:none;" value="' . $business_profile['comments'] . ' " onClick="commentedittwo(this.name)">';
//            $cmtinsert .= '<button id="editsubmittwo' . $business_profile['business_profile_post_comment_id'] . '" style="display:none;" onClick="edit_commenttwo(' . $business_profile['business_profile_post_comment_id'] . ')">Comment</button><div class="art-comment-menu-design"> <div class="comment-details-menu" id="likecomment1' . $business_profile['business_profile_post_comment_id'] . '">';

            $cmtinsert .= '<div class="art-comment-menu-design"><div class="comment-details-menu" id="likecomment1' . $business_profile['business_profile_post_comment_id'] . '">';
            $cmtinsert .= '<a id="' . $business_profile['business_profile_post_comment_id'] . '"';
            $cmtinsert .= 'onClick="comment_like1(this.id)">';

            $userid = $this->session->userdata('aileenuser');
            $contition_array = array('business_profile_post_comment_id' => $business_profile['business_profile_post_comment_id'], 'status' => '1');
            $businesscommentlike = $this->data['businesscommentlike'] = $this->common->select_data_by_condition('business_profile_post_comment', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
            $likeuserarray = explode(',', $businesscommentlike[0]['business_comment_like_user']);

            if (!in_array($userid, $likeuserarray)) {
                $cmtinsert .= '<i class="fa fa-thumbs-o-up fa-1x" aria-hidden="true"></i>';
            } else {
                $cmtinsert .= '<i class="fa fa-thumbs-up" aria-hidden="true"></i>';
            }

            $cmtinsert .= '<span>';
            if ($business_profile['business_comment_likes_count'] > 0) {
                $cmtinsert .= '' . $business_profile['business_comment_likes_count'];
            }
            $cmtinsert .= '</span>';
            $cmtinsert .= '</a></div>';


            $userid = $this->session->userdata('aileenuser');
            if ($business_profile['user_id'] == $userid) {

                $cmtinsert .= '<span role="presentation" aria-hidden="true"> · </span>';
                $cmtinsert .= '<div class="comment-details-menu">';


                $cmtinsert .= '<div id="editcommentboxtwo' . $business_profile['business_profile_post_comment_id'] . '"style="display:block;">';

                $cmtinsert .= '<a id="' . $business_profile['business_profile_post_comment_id'] . '"';
                $cmtinsert .= 'onClick="comment_editboxtwo(this.id)">';
                $cmtinsert .= 'Edit';
                $cmtinsert .= '</a></div>';

                $cmtinsert .= '<div id="editcancletwo' . $business_profile['business_profile_post_comment_id'] . '"style="display:none;">';

                $cmtinsert .= '<a id="' . $business_profile['business_profile_post_comment_id'] . '"';
                $cmtinsert .= 'onClick="comment_editcancletwo(this.id)">';
                $cmtinsert .= 'Cancel';
                $cmtinsert .= '</a></div>';

                $cmtinsert .= '</div>';
            }




            $userid = $this->session->userdata('aileenuser');

            $business_userid = $this->db->get_where('business_profile_post', array('business_profile_post_id' => $business_profile['business_profile_post_id'], 'status' => 1))->row()->user_id;


            if ($business_profile['user_id'] == $userid || $business_userid == $userid) {

                $cmtinsert .= '<span role="presentation" aria-hidden="true"> · </span>';
                $cmtinsert .= '<div class="comment-details-menu">';


                $cmtinsert .= '<input type="hidden" name="post_deletetwo"';
                $cmtinsert .= 'id="post_deletetwo"';
                $cmtinsert .= 'value= "' . $business_profile['business_profile_post_id'] . '">';
                $cmtinsert .= '<a id="' . $business_profile['business_profile_post_comment_id'] . '"';
                $cmtinsert .= 'onClick="comment_deletetwo(this.id)">';
                $cmtinsert .= 'Delete';
                $cmtinsert .= '</a></div>';
            }

            $cmtinsert .= '<span role="presentation" aria-hidden="true"> · </span>';
            $cmtinsert .= '<div class="comment-details-menu">';
            $cmtinsert .= '<p>' . $business_profile['created_date'] . '</p></div></div></div>';


            // comment aount variable start
            $idpost = $business_profile['business_profile_post_id'];
            $cmtcount = '<a onClick="commentall(this.id)" id="' . $idpost . '">';
            $cmtcount .= '<i class="fa fa-comment-o" aria-hidden="true">';
            $cmtcount .= ' ' . count($businessprofiledata) . '';
            $cmtcount .= '</i></a>';

            // comment count variable end 
        }

//        echo $cmtinsert;
        echo json_encode(
                array("comment" => $cmtinsert,
                    "count" => $cmtcount));

        // khyati chande 
    }

//business_profile comment insert end  
//business_profile comment edit start
    public function edit_comment_insert() {

        $userid = $this->session->userdata('aileenuser');

        $post_id = $_POST["post_id"];
        $post_comment = $_POST["comment"];

        $data = array(
            'comments' => $post_comment,
            'modify_date' => date('y-m-d h:i:s')
        );


        $updatdata = $this->common->update_data($data, 'business_profile_post_comment', 'business_profile_post_comment_id', $post_id);
        if ($updatdata) {

            $contition_array = array('business_profile_post_comment_id' => $_POST["post_id"], 'status' => '1');
            $businessprofiledata = $this->data['businessprofiledata'] = $this->common->select_data_by_condition('business_profile_post_comment', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

            $cmtlike = '<div>';
            $cmtlike .= $businessprofiledata[0]['comments'] . "<br>";
            $cmtlike .= '</div>';
            echo $cmtlike;
        }
    }

//business_profile like commnet ajax end 
// click on post after post open on new page start


    public function postnewpage($id) {

        $userid = $this->session->userdata('aileenuser');
        $contition_array = array('user_id' => $userid, 'status' => '1');
        $this->data['businessdata'] = $this->common->select_data_by_condition('business_profile', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        $contition_array = array('business_profile_post_id' => $id, 'status' => '1');

        $this->data['busienss_data'] = $this->common->select_data_by_condition('business_profile_post', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        //echo "<pre>"; print_r($this->data['art_data']);die();
        $this->load->view('business_profile/postnewpage', $this->data);
    }

// click on post after post open on new page end 
//edit post start

    public function edit_post_insert() {

        $userid = $this->session->userdata('aileenuser');

        $post_id = $_POST["business_profile_post_id"];
        $business_post = $_POST["product_name"];
        $business_description = $_POST["product_description"];

        $data = array(
            'product_name' => $business_post,
            'product_description' => $business_description,
            'modify_date' => date('y-m-d h:i:s')
        );

        $updatdata = $this->common->update_data($data, 'business_profile_post', 'business_profile_post_id', $post_id);
        if ($updatdata) {

            $contition_array = array('business_profile_post_id' => $_POST["business_profile_post_id"], 'status' => '1');
            $businessdata = $this->data['businessdata'] = $this->common->select_data_by_condition('business_profile_post', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

            //echo "<pre>"; print_r($artdata); die();
            if ($this->data['businessdata'][0]['product_name']) {
                $editpost = '<div>';
                $editpost .= $businessdata[0]['product_name'] . "<br>";
                $editpost .= '</div>';
            }
            if ($this->data['businessdata'][0]['product_description']) {

                $editpostdes = '<div>';
                $editpostdes .= $businessdata[0]['product_description'] . "<br>";
                $editpostdes .= '</div>';
            }
            //echo $editpost;   echo $editpostdes;
            echo json_encode(
                    array("title" => $editpost,
                        "description" => $editpostdes));
        }
    }

//edit post end
//reactivate account start

    public function reactivate() {

        $userid = $this->session->userdata('aileenuser');
        $data = array(
            'status' => 1,
            'modified_date' => date('y-m-d h:i:s')
        );

        $updatdata = $this->common->update_data($data, 'business_profile', 'user_id', $userid);
        if ($updatdata) {

            redirect('business_profile/business_profile_post', refresh);
        } else {

            $this->load->view('business_profile/reactivate', $this->data);
        }
    }

//reactivate accont end    
//delete post particular user start
    public function del_particular_userpost() {

        $userid = $this->session->userdata('aileenuser');

        $post_id = $_POST['business_profile_post_id'];

        $contition_array = array('business_profile_post_id' => $post_id, 'status' => '1');
        $businessdata = $this->data['businessdata'] = $this->common->select_data_by_condition('business_profile_post', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        $likeuserarray = explode(',', $businessdata[0]['delete_post']);

        $user_array = array_push($likeuserarray, $userid);

        if ($businessdata[0]['delete_post'] == 0) {
            $userid = implode('', $likeuserarray);
        } else {
            $userid = implode(',', $likeuserarray);
        }

        $data = array(
            'delete_post' => $userid,
            'modify_date' => date('y-m-d h:i:s')
        );

        $updatdata = $this->common->update_data($data, 'business_profile_post', 'business_profile_post_id', $post_id);
    }

//delete post particular user end  
//multiple image for manage user start


    public function business_photos($id) {

        $userid = $this->session->userdata('aileenuser');
        $contition_array = array('user_id' => $userid, 'status' => '1');

        $this->data['slug_data'] = $this->common->select_data_by_condition('business_profile', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
        //echo "<pre>"; print_r($this->data['slug_data']); die();
        $slug_id = $this->data['slug_data'][0]['business_slug'];
        //echo  $slug_id ; die();
        if ($id == $slug_id || $id == '') {

            $contition_array = array('business_slug' => $slug_id, 'status' => '1');
            $businessdata1 = $this->data['businessdata1'] = $this->common->select_data_by_condition('business_profile', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');


            $join_str[0]['table'] = 'post_image';
            $join_str[0]['join_table_id'] = 'post_image.post_id';
            $join_str[0]['from_table_id'] = 'business_profile_post.business_profile_post_id';
            $join_str[0]['join_type'] = '';


            $contition_array = array('user_id' => $businessdata1[0]['user_id'], 'image_type' => 2, 'status' => 1, 'is_delete' => '0');
            $data = 'business_profile_post_id, image_id, image_name';

            $this->data['business_profile_data'] = $this->common->select_data_by_condition('business_profile_post', $contition_array, $data, $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str, $groupby = '');
        } else {

            $contition_array = array('business_slug' => $id, 'status' => '1');
            $businessdata1 = $this->data['businessdata1'] = $this->common->select_data_by_condition('business_profile', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');


            $join_str[0]['table'] = 'post_image';
            $join_str[0]['join_table_id'] = 'post_image.post_id';
            $join_str[0]['from_table_id'] = 'business_profile_post.business_profile_post_id';
            $join_str[0]['join_type'] = '';


            $contition_array = array('user_id' => $businessdata1[0]['user_id'], 'image_type' => 2, 'status' => 1, 'is_delete' => '0');

            $data = 'business_profile_post_id, image_id, image_name';

            $this->data['business_profile_data'] = $this->common->select_data_by_condition('business_profile_post', $contition_array, $data, $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str, $groupby = '');
        }

        $this->load->view('business_profile/business_photos', $this->data);
    }

//multiple iamge for manage user end   
    //multiple video for manage user start


    public function business_videos($id) {


        $userid = $this->session->userdata('aileenuser');
        $contition_array = array('user_id' => $userid, 'status' => '1');

        $this->data['slug_data'] = $this->common->select_data_by_condition('business_profile', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
        //echo "<pre>"; print_r($this->data['slug_data']); die();
        $slug_id = $this->data['slug_data'][0]['business_slug'];
        //echo  $slug_id ; die();
        if ($id == $slug_id || $id == '') {

            $contition_array = array('business_slug' => $slug_id, 'status' => '1');
            $businessdata1 = $this->data['businessdata1'] = $this->common->select_data_by_condition('business_profile', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

            $contition_array = array('user_id' => $businessdata1[0]['user_id'], 'status' => 1, 'is_delete' => '0');

            $this->data['business_profile_data'] = $this->common->select_data_by_condition('business_profile_post', $contition_array, $data, $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
        } else {

            $contition_array = array('business_slug' => $id, 'status' => '1');
            $businessdata1 = $this->data['businessdata1'] = $this->common->select_data_by_condition('business_profile', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

            $contition_array = array('user_id' => $businessdata1[0]['user_id'], 'status' => 1, 'is_delete' => '0');

            $this->data['business_profile_data'] = $this->common->select_data_by_condition('business_profile_post', $contition_array, $data, $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
        }

        $this->load->view('business_profile/business_videos', $this->data);
    }

//multiple video for manage user end 
//multiple audio for manage user start


    public function business_audios($id) {


        $userid = $this->session->userdata('aileenuser');
        $contition_array = array('user_id' => $userid, 'status' => '1');

        $this->data['slug_data'] = $this->common->select_data_by_condition('business_profile', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
        //echo "<pre>"; print_r($this->data['slug_data']); die();
        $slug_id = $this->data['slug_data'][0]['business_slug'];
        //echo  $slug_id ; die();
        if ($id == $slug_id || $id == '') {

            $contition_array = array('business_slug' => $slug_id, 'status' => '1');
            $businessdata1 = $this->data['businessdata1'] = $this->common->select_data_by_condition('business_profile', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

            $contition_array = array('user_id' => $businessdata1[0]['user_id'], 'status' => 1, 'is_delete' => '0');

            $this->data['business_profile_data'] = $this->common->select_data_by_condition('business_profile_post', $contition_array, $data, $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
        } else {

            $contition_array = array('business_slug' => $id, 'status' => '1');
            $businessdata1 = $this->data['businessdata1'] = $this->common->select_data_by_condition('business_profile', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

            $contition_array = array('user_id' => $businessdata1[0]['user_id'], 'status' => 1, 'is_delete' => '0');

            $this->data['business_profile_data'] = $this->common->select_data_by_condition('business_profile_post', $contition_array, $data, $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
        }
        $this->load->view('business_profile/business_audios', $this->data);
    }

//multiple audio for manage user end   
//multiple pdf for manage user start


    public function business_pdf($id) {



        $userid = $this->session->userdata('aileenuser');
        $contition_array = array('user_id' => $userid, 'status' => '1');

        $this->data['slug_data'] = $this->common->select_data_by_condition('business_profile', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
        //echo "<pre>"; print_r($this->data['slug_data']); die();
        $slug_id = $this->data['slug_data'][0]['business_slug'];
        //echo  $slug_id ; die();
        if ($id == $slug_id || $id == '') {

            $contition_array = array('business_slug' => $slug_id, 'status' => '1');
            $businessdata1 = $this->data['businessdata1'] = $this->common->select_data_by_condition('business_profile', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

            $contition_array = array('user_id' => $businessdata1[0]['user_id'], 'status' => 1, 'is_delete' => '0');

            $this->data['business_profile_data'] = $this->common->select_data_by_condition('business_profile_post', $contition_array, $data, $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
        } else {

            $contition_array = array('business_slug' => $id, 'status' => '1');
            $businessdata1 = $this->data['businessdata1'] = $this->common->select_data_by_condition('business_profile', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

            $contition_array = array('user_id' => $businessdata1[0]['user_id'], 'status' => 1, 'is_delete' => '0');

            $this->data['business_profile_data'] = $this->common->select_data_by_condition('business_profile_post', $contition_array, $data, $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
        }
        $this->load->view('business_profile/business_pdf', $this->data);
    }

//multiple pdf for manage user end 
//multiple images like start
    public function mulimg_like() {
        //$id = $_POST['save_id'];
        $post_image = $_POST['post_image_id'];
        $userid = $this->session->userdata('aileenuser');


        $contition_array = array('post_image_id' => $post_image, 'user_id' => $userid);

        $likeuser = $this->data['likeuser'] = $this->common->select_data_by_condition('bus_post_image_like', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        if (!$likeuser) {

            $data = array(
                'post_image_id' => $post_image,
                'user_id' => $userid,
                'created_date' => date('Y-m-d', time()),
                'is_unlike' => 0
            );
//echo "<pre>"; print_r($data); die();

            $insertdata = $this->common->insert_data_getid($data, 'bus_post_image_like');

            $contition_array = array('post_image_id' => $_POST["post_image_id"], 'is_unlike' => '0');
            $bdata1 = $this->data['bdata1'] = $this->common->select_data_by_condition('bus_post_image_like', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

            if ($insertdata) {

                $imglike = '<li>';
                $imglike .= '<a id="' . $post_image . '" onClick="mulimg_like(this.id)">';
                $imglike .= ' <i class="fa fa-thumbs-up" aria-hidden="true">';
                $imglike .= '</i>';
                $imglike .= '<span>';
                if (count($bdata1) > 0) {
                    $imglike .= count($bdata1) . '';
                }
                $imglike .= '</span>';
                $imglike .= '</a>';
                $imglike .= '</li>';

                echo $imglike;
            }
        } else {

            if ($likeuser[0]['is_unlike'] == 0) {

                $data = array(
                    'modify_date' => date('Y-m-d', time()),
                    'is_unlike' => 1
                );


                $updatdata = $this->common->update_data($data, 'bus_post_image_like', 'post_image_id', $post_image);

                $contition_array = array('post_image_id' => $_POST["post_image_id"], 'is_unlike' => '0');
                $bdata2 = $this->data['bdata2'] = $this->common->select_data_by_condition('bus_post_image_like', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');



                if ($updatdata) {

                    $imglike1 = '<li>';
                    $imglike1 .= '<a id="' . $post_image . '" onClick="mulimg_like(this.id)">';
                    $imglike1 .= '<i class="fa fa-thumbs-o-up fa-1x" aria-hidden="true">';
                    $imglike1 .= '</i>';
                    $imglike1 .= '<span>';
                    if (count($bdata2) > 0) {
                        $imglike1 .= count($bdata2) . '';
                    }
                    $imglike1 .= '</span>';
                    $imglike1 .= '</a>';
                    $imglike1 .= '</li>';

                    echo $imglike1;
                }
            } else {

                $data = array(
                    'modify_date' => date('Y-m-d', time()),
                    'is_unlike' => 0
                );


                $updatdata = $this->common->update_data($data, 'bus_post_image_like', 'post_image_id', $post_image);

                $contition_array = array('post_image_id' => $_POST["post_image_id"], 'is_unlike' => '0');
                $bdata2 = $this->data['bdata2'] = $this->common->select_data_by_condition('bus_post_image_like', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');



                if ($updatdata) {

                    $imglike1 = '<li>';
                    $imglike1 .= '<a id="' . $post_image . '" onClick="mulimg_like(this.id)">';
                    $imglike1 .= '<i class="fa fa-thumbs-up" aria-hidden="true">';
                    $imglike1 .= '</i>';
                    $imglike1 .= '<span>';
                    if (count($bdata2) > 0) {
                        $imglike1 .= count($bdata2) . '';
                    }
                    $imglike1 .= '</span>';
                    $imglike1 .= '</a>';
                    $imglike1 .= '</li>';

                    echo $imglike1;
                }
            }
        }
    }

//multiple iamges like end 
//multiple images comment strat

    public function mulimg_commentthree() {

        $userid = $this->session->userdata('aileenuser');

        $post_image_id = $_POST["post_image_id"];
        $post_comment = $_POST["comment"];

        $data = array(
            'user_id' => $userid,
            'post_image_id' => $post_image_id,
            'comment' => $post_comment,
            'created_date' => date('Y-m-d', time()),
            'is_delete' => 0
        );
        $insert_id = $this->common->insert_data_getid($data, 'bus_post_image_comment');


        $contition_array = array('post_image_id' => $post_image_id, 'is_delete' => '0');
        $businesscomment = $this->common->select_data_by_condition('bus_post_image_comment', $contition_array, $data = '*', $sortby = 'post_image_comment_id', $orderby = 'DESC', $limit = '1', $offset = '', $join_str = array(), $groupby = '');
// count for comment
        $contition_array = array('post_image_id' => $post_image_id, 'is_delete' => '0');
        $buscmtcnt = $this->common->select_data_by_condition('bus_post_image_comment', $contition_array, $data = '*', $sortby = 'post_image_comment_id', $orderby = 'DESC', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        //echo "<pre>"; print_r($businesscomment); die();
        foreach ($businesscomment as $bus_comment) {


            $company_name = $this->db->get_where('business_profile', array('user_id' => $bus_comment['user_id']))->row()->company_name;

            $business_userimage = $this->db->get_where('business_profile', array('user_id' => $bus_comment['user_id'], 'status' => 1))->row()->business_user_image;

            //$cmtinsert = '<div class="all-comment-comment-box">';
            $cmtinsert .= '<div class="post-design-pro-comment-img">';
            $cmtinsert .= '<img  src="' . base_url(USERIMAGE . $business_userimage) . '" alt="">  </div>';

            $cmtinsert .= '<div class="comment-name"><b>' . $company_name . '</b>';
            $cmtinsert .= '</div>';

            $cmtinsert .= '<div class="comment-details" id= "showcomment' . $bus_comment['post_image_comment_id'] . '"" >';
            $cmtinsert .= $bus_comment['comment'];
            $cmtinsert .= '</div>';
            $cmtinsert .= '<input type="text" name="' . $bus_comment['post_image_comment_id'] . '" id="editcomment' . $bus_comment['post_image_comment_id'] . '"style="display:none;" value="' . $bus_comment['comment'] . ' " onClick="commentedit(this.name)">';

            $cmtinsert .= '<button id="editsubmit' . $bus_comment['post_image_comment_id'] . '" style="display:none;" onClick="edit_comment(' . $bus_comment['post_image_comment_id'] . ')">Comment</button><div class="art-comment-menu-design"> <div class="comment-details-menu" id="likecomment' . $bus_comment['post_image_comment_id'] . '">';

            $cmtinsert .= '<a id="' . $bus_comment['post_image_comment_id'] . '"';
            $cmtinsert .= 'onClick="comment_like(this.id)">';

            $contition_array = array('post_image_comment_id' => $bus_comment['post_image_comment_id'], 'user_id' => $userid, 'is_unlike' => 0);

            $businesscommentlike1 = $this->common->select_data_by_condition('bus_comment_image_like', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

            if (count($businesscommentlike1) == 0) {
                $cmtinsert .= '<i class="fa fa-thumbs-o-up fa-1x" aria-hidden="true"></i>';
            } else {

                $cmtinsert .= '<i class="fa fa-thumbs-up" aria-hidden="true"></i>';
            }

            $cmtinsert .= '<span>';

            $contition_array = array('post_image_comment_id' => $bus_comment['post_image_comment_id'], 'is_unlike' => '0');
            $mulcountlike = $this->data['mulcountlike'] = $this->common->select_data_by_condition('bus_comment_image_like', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');


            if (count($mulcountlike) > 0) {
                //echo count($mulcountlike); 
            }
            $cmtinsert .= '</span>';
            $cmtinsert .= '</a></div>';

            $userid = $this->session->userdata('aileenuser');
            if ($bus_comment['user_id'] == $userid) {

                $cmtinsert .= '<span role="presentation" aria-hidden="true"> · </span>';
                $cmtinsert .= '<div class="comment-details-menu">';


                $cmtinsert .= '<div id="editcommentbox' . $bus_comment['post_image_comment_id'] . '"style="display:block;">';

                $cmtinsert .= '<a id="' . $bus_comment['post_image_comment_id'] . '"';
                $cmtinsert .= 'onClick="comment_editbox(this.id)">';
                $cmtinsert .= 'Edit';
                $cmtinsert .= '</a></div>';

                $cmtinsert .= '<div id="editcancle' . $bus_comment['post_image_comment_id'] . '"style="display:none;">';

                $cmtinsert .= '<a id="' . $bus_comment['post_image_comment_id'] . '"';
                $cmtinsert .= 'onClick="comment_editcancle(this.id)">';
                $cmtinsert .= 'Cancel';
                $cmtinsert .= '</a></div>';

                $cmtinsert .= '</div>';
            }
            $userid = $this->session->userdata('aileenuser');


            $userid = $this->session->userdata('aileenuser');

            $business_userid = $this->db->get_where('business_profile_post', array('business_profile_post_id' => $bus_comment['post_image_id'], 'status' => 1))->row()->user_id;


            if ($bus_comment['user_id'] == $userid || $business_userid == $userid) {


                $cmtinsert .= '<span role="presentation" aria-hidden="true"> · </span>';
                $cmtinsert .= '<div class="comment-details-menu">';


                $cmtinsert .= '<input type="hidden" name="post_delete"';
                $cmtinsert .= 'id="post_delete"';
                $cmtinsert .= 'value= "' . $bus_comment['post_image_id'] . '">';
                $cmtinsert .= '<a id="' . $bus_comment['post_image_comment_id'] . '"';
                $cmtinsert .= 'onClick="comment_delete(this.id)">';
                $cmtinsert .= 'Delete';
                $cmtinsert .= '</a></div>';
            }

            $cmtinsert .= '<span role="presentation" aria-hidden="true"> · </span>';
            $cmtinsert .= '<div class="comment-details-menu">';
            $cmtinsert .= '<p>' . $bus_comment['created_date'] . '</p></div></div>';


            // comment aount variable start
            // $idpost = $business_profile['business_profile_post_id'];
            $cmtcount = '<a onClick="commentall(this.id)" id="' . $post_image_id . '">';
            $cmtcount .= '<i class="fa fa-comment-o" aria-hidden="true">';
            $cmtcount .= ' ' . count($buscmtcnt) . '';
            $cmtcount .= '</i></a>';

            // comment count variable end 
        }
        echo json_encode(
                array("comment" => $cmtinsert,
                    "count" => $cmtcount));
    }

    public function mulimg_comment() {

        $userid = $this->session->userdata('aileenuser');

        $post_image_id = $_POST["post_image_id"];
        $post_comment = $_POST["comment"];

        $data = array(
            'user_id' => $userid,
            'post_image_id' => $post_image_id,
            'comment' => $post_comment,
            'created_date' => date('Y-m-d', time()),
            'is_delete' => 0
        );
        $insert_id = $this->common->insert_data_getid($data, 'bus_post_image_comment');


        $contition_array = array('post_image_id' => $post_image_id, 'is_delete' => '0');
        $businesscomment = $this->common->select_data_by_condition('bus_post_image_comment', $contition_array, $data = '*', $sortby = 'post_image_comment_id', $orderby = 'DESC', $limit = '', $offset = '', $join_str = array(), $groupby = '');
// count for comment
        $contition_array = array('post_image_id' => $post_image_id, 'is_delete' => '0');
        $buscmtcnt = $this->common->select_data_by_condition('bus_post_image_comment', $contition_array, $data = '*', $sortby = 'post_image_comment_id', $orderby = 'DESC', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        //echo "<pre>"; print_r($businesscomment); die();
        foreach ($businesscomment as $bus_comment) {


            $company_name = $this->db->get_where('business_profile', array('user_id' => $bus_comment['user_id']))->row()->company_name;

            $business_userimage = $this->db->get_where('business_profile', array('user_id' => $bus_comment['user_id'], 'status' => 1))->row()->business_user_image;

            //$cmtinsert = '<div class="all-comment-comment-box">';
            $cmtinsert .= '<div class="post-design-pro-comment-img">';
            $cmtinsert .= '<img  src="' . base_url(USERIMAGE . $business_userimage) . '" alt="">  </div>';

            $cmtinsert .= '<div class="comment-name"><b>' . $company_name . '</b>';
            $cmtinsert .= '</div>';

            $cmtinsert .= '<div class="comment-details" id= "showcomment' . $bus_comment['post_image_comment_id'] . '"" >';
            $cmtinsert .= $bus_comment['comment'];
            $cmtinsert .= '</div>';
            $cmtinsert .= '<input type="text" name="' . $bus_comment['post_image_comment_id'] . '" id="editcomment' . $bus_comment['post_image_comment_id'] . '"style="display:none;" value="' . $bus_comment['comment'] . ' " onClick="commentedit(this.name)">';

            $cmtinsert .= '<button id="editsubmit' . $bus_comment['post_image_comment_id'] . '" style="display:none;" onClick="edit_comment(' . $bus_comment['post_image_comment_id'] . ')">Comment</button><div class="art-comment-menu-design"> <div class="comment-details-menu" id="likecomment' . $bus_comment['post_image_comment_id'] . '">';

            $cmtinsert .= '<a id="' . $bus_comment['post_image_comment_id'] . '"';
            $cmtinsert .= 'onClick="comment_like(this.id)">';

            $contition_array = array('post_image_comment_id' => $bus_comment['post_image_comment_id'], 'user_id' => $userid, 'is_unlike' => 0);

            $businesscommentlike1 = $this->common->select_data_by_condition('bus_comment_image_like', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

            if (count($businesscommentlike1) == 0) {
                $cmtinsert .= '<i class="fa fa-thumbs-o-up fa-1x" aria-hidden="true"></i>';
            } else {

                $cmtinsert .= '<i class="fa fa-thumbs-up" aria-hidden="true"></i>';
            }

            $cmtinsert .= '<span>';

            $contition_array = array('post_image_comment_id' => $bus_comment['post_image_comment_id'], 'is_unlike' => '0');
            $mulcountlike = $this->data['mulcountlike'] = $this->common->select_data_by_condition('bus_comment_image_like', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');


            if (count($mulcountlike) > 0) {
                //echo count($mulcountlike); 
            }
            $cmtinsert .= '</span>';
            $cmtinsert .= '</a></div>';

            $userid = $this->session->userdata('aileenuser');
            if ($bus_comment['user_id'] == $userid) {

                $cmtinsert .= '<span role="presentation" aria-hidden="true"> · </span>';
                $cmtinsert .= '<div class="comment-details-menu">';


                $cmtinsert .= '<div id="editcommentbox' . $bus_comment['post_image_comment_id'] . '"style="display:block;">';

                $cmtinsert .= '<a id="' . $bus_comment['post_image_comment_id'] . '"';
                $cmtinsert .= 'onClick="comment_editbox(this.id)">';
                $cmtinsert .= 'Edit';
                $cmtinsert .= '</a></div>';

                $cmtinsert .= '<div id="editcancle' . $bus_comment['post_image_comment_id'] . '"style="display:none;">';

                $cmtinsert .= '<a id="' . $bus_comment['post_image_comment_id'] . '"';
                $cmtinsert .= 'onClick="comment_editcancle(this.id)">';
                $cmtinsert .= 'Cancel';
                $cmtinsert .= '</a></div>';

                $cmtinsert .= '</div>';
            }
            $userid = $this->session->userdata('aileenuser');


            $userid = $this->session->userdata('aileenuser');

            $business_userid = $this->db->get_where('business_profile_post', array('business_profile_post_id' => $bus_comment['post_image_id'], 'status' => 1))->row()->user_id;


            if ($bus_comment['user_id'] == $userid || $business_userid == $userid) {


                $cmtinsert .= '<span role="presentation" aria-hidden="true"> · </span>';
                $cmtinsert .= '<div class="comment-details-menu">';


                $cmtinsert .= '<input type="hidden" name="post_delete"';
                $cmtinsert .= 'id="post_delete"';
                $cmtinsert .= 'value= "' . $bus_comment['post_image_id'] . '">';
                $cmtinsert .= '<a id="' . $bus_comment['post_image_comment_id'] . '"';
                $cmtinsert .= 'onClick="comment_delete(this.id)">';
                $cmtinsert .= 'Delete';
                $cmtinsert .= '</a></div>';
            }

            $cmtinsert .= '<span role="presentation" aria-hidden="true"> · </span>';
            $cmtinsert .= '<div class="comment-details-menu">';
            $cmtinsert .= '<p>' . $bus_comment['created_date'] . '</p></div></div>';


            // comment aount variable start
            // $idpost = $business_profile['business_profile_post_id'];
            $cmtcount = '<a onClick="commentall(this.id)" id="' . $post_image_id . '">';
            $cmtcount .= '<i class="fa fa-comment-o" aria-hidden="true">';
            $cmtcount .= ' ' . count($buscmtcnt) . '';
            $cmtcount .= '</i></a>';

            // comment count variable end 
        }
        echo json_encode(
                array("comment" => $cmtinsert,
                    "count" => $cmtcount));
    }

    public function pnmulimg_comment() {

        $userid = $this->session->userdata('aileenuser');

        $post_image_id = $_POST["post_image_id"];
        $post_comment = $_POST["comment"];

        $data = array(
            'user_id' => $userid,
            'post_image_id' => $post_image_id,
            'comment' => $post_comment,
            'created_date' => date('Y-m-d', time()),
            'is_delete' => 0
        );
        $insert_id = $this->common->insert_data_getid($data, 'bus_post_image_comment');


        $contition_array = array('post_image_id' => $post_image_id, 'is_delete' => '0');
        $businesscomment = $this->common->select_data_by_condition('bus_post_image_comment', $contition_array, $data = '*', $sortby = 'post_image_comment_id', $orderby = 'DESC', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        $contition_array = array('post_image_id' => $post_image_id, 'is_delete' => '0');
        $buscmtcnt = $this->common->select_data_by_condition('bus_post_image_comment', $contition_array, $data = '*', $sortby = 'post_image_comment_id', $orderby = 'DESC', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        //echo "<pre>"; print_r($businesscomment); die();
        foreach ($businesscomment as $bus_comment) {


            $company_name = $this->db->get_where('business_profile', array('user_id' => $bus_comment['user_id']))->row()->company_name;

            $business_userimage = $this->db->get_where('business_profile', array('user_id' => $bus_comment['user_id'], 'status' => 1))->row()->business_user_image;

            //$cmtinsert = '<div class="all-comment-comment-box">';
            $cmtinsert .= '<div class="post-design-pro-comment-img">';
            $cmtinsert .= '<img  src="' . base_url(USERIMAGE . $business_userimage) . '" alt="">  </div>';

            $cmtinsert .= '<div class="comment-name"><b>' . $company_name . '</b>';
            $cmtinsert .= '</div>';

            $cmtinsert .= '<div class="comment-details" id= "imgshowcomment' . $bus_comment['post_image_comment_id'] . '"" >';
            $cmtinsert .= $bus_comment['comment'];
            $cmtinsert .= '</div>';
            $cmtinsert .= '<input type="text" name="' . $bus_comment['post_image_comment_id'] . '" id="imgeditcomment' . $bus_comment['post_image_comment_id'] . '"style="display:none;" value="' . $bus_comment['comment'] . ' " onClick="imgcommentedit(this.name)">';

            $cmtinsert .= '<button id="imgeditsubmit' . $bus_comment['post_image_comment_id'] . '" style="display:none;" onClick="imgedit_comment(' . $bus_comment['post_image_comment_id'] . ')">Comment</button><div class="art-comment-menu-design"> <div class="comment-details-menu" id="imglikecomment' . $bus_comment['post_image_comment_id'] . '">';

            $cmtinsert .= '<a id="' . $bus_comment['post_image_comment_id'] . '"';
            $cmtinsert .= 'onClick="imgcomment_like(this.id)">';

            $contition_array = array('post_image_comment_id' => $bus_comment['post_image_comment_id'], 'user_id' => $userid, 'is_unlike' => 0);

            $businesscommentlike1 = $this->common->select_data_by_condition('bus_comment_image_like', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

            if (count($businesscommentlike1) == 0) {
                $cmtinsert .= '<i class="fa fa-thumbs-o-up fa-1x" aria-hidden="true"></i>';
            } else {

                $cmtinsert .= '<i class="fa fa-thumbs-up" aria-hidden="true"></i>';
            }

            $cmtinsert .= '<span>';

            $contition_array = array('post_image_comment_id' => $bus_comment['post_image_comment_id'], 'is_unlike' => '0');
            $mulcountlike = $this->data['mulcountlike'] = $this->common->select_data_by_condition('bus_comment_image_like', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');


            if (count($mulcountlike) > 0) {
                //echo count($mulcountlike); 
            }
            $cmtinsert .= '</span>';
            $cmtinsert .= '</a></div>';

            $userid = $this->session->userdata('aileenuser');
            if ($bus_comment['user_id'] == $userid) {

                $cmtinsert .= '<span role="presentation" aria-hidden="true"> · </span>';
                $cmtinsert .= '<div class="comment-details-menu">';


                $cmtinsert .= '<div id="imgeditcommentbox' . $bus_comment['post_image_comment_id'] . '"style="display:block;">';

                $cmtinsert .= '<a id="' . $bus_comment['post_image_comment_id'] . '"';
                $cmtinsert .= 'onClick="imgcomment_editbox(this.id)">';
                $cmtinsert .= 'Edit';
                $cmtinsert .= '</a></div>';

                $cmtinsert .= '<div id="imgeditcancle' . $bus_comment['post_image_comment_id'] . '"style="display:none;">';

                $cmtinsert .= '<a id="' . $bus_comment['post_image_comment_id'] . '"';
                $cmtinsert .= 'onClick="imgcomment_editcancle(this.id)">';
                $cmtinsert .= 'Cancel';
                $cmtinsert .= '</a></div>';

                $cmtinsert .= '</div>';
            }
            $userid = $this->session->userdata('aileenuser');


            $userid = $this->session->userdata('aileenuser');

            $business_userid = $this->db->get_where('business_profile_post', array('business_profile_post_id' => $bus_comment['post_image_id'], 'status' => 1))->row()->user_id;


            if ($bus_comment['user_id'] == $userid || $business_userid == $userid) {


                $cmtinsert .= '<span role="presentation" aria-hidden="true"> · </span>';
                $cmtinsert .= '<div class="comment-details-menu">';
                $cmtinsert .= '<input type="hidden" name="imgpost_delete"';
                $cmtinsert .= 'id="imgpost_delete"';
                $cmtinsert .= 'value= "' . $bus_comment['post_image_id'] . '">';
                $cmtinsert .= '<a id="' . $bus_comment['post_image_comment_id'] . '"';
                $cmtinsert .= 'onClick="imgcomment_delete(this.id)">';
                $cmtinsert .= 'Delete';
                $cmtinsert .= '</a></div>';
            }

            $cmtinsert .= '<span role="presentation" aria-hidden="true"> · </span>';
            $cmtinsert .= '<div class="comment-details-menu">';
            $cmtinsert .= '<p>' . $bus_comment['created_date'] . '</p></div></div>';

            $cmtcount = '<a onClick="imgcommentall(this.id)" id="' . $post_image_id . '">';
            $cmtcount .= '<i class="fa fa-comment-o" aria-hidden="true">';
            $cmtcount .= ' ' . count($buscmtcnt) . '';
            $cmtcount .= '</i></a>';

            // comment count variable end 
        }
        echo json_encode(
                array("comment" => $cmtinsert,
                    "count" => $cmtcount));
    }

    public function pnmulimgcommentthree() {

        $userid = $this->session->userdata('aileenuser');

        $post_image_id = $_POST["post_image_id"];
        $post_comment = $_POST["comment"];

        $data = array(
            'user_id' => $userid,
            'post_image_id' => $post_image_id,
            'comment' => $post_comment,
            'created_date' => date('Y-m-d', time()),
            'is_delete' => 0
        );
        $insert_id = $this->common->insert_data_getid($data, 'bus_post_image_comment');


        $contition_array = array('post_image_id' => $post_image_id, 'is_delete' => '0');
        $businesscomment = $this->common->select_data_by_condition('bus_post_image_comment', $contition_array, $data = '*', $sortby = 'post_image_comment_id', $orderby = 'DESC', $limit = '1', $offset = '', $join_str = array(), $groupby = '');

        $contition_array = array('post_image_id' => $post_image_id, 'is_delete' => '0');
        $buscmtcnt = $this->common->select_data_by_condition('bus_post_image_comment', $contition_array, $data = '*', $sortby = 'post_image_comment_id', $orderby = 'DESC', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        //echo "<pre>"; print_r($businesscomment); die();
        foreach ($businesscomment as $bus_comment) {


            $company_name = $this->db->get_where('business_profile', array('user_id' => $bus_comment['user_id']))->row()->company_name;

            $business_userimage = $this->db->get_where('business_profile', array('user_id' => $bus_comment['user_id'], 'status' => 1))->row()->business_user_image;

            //$cmtinsert = '<div class="all-comment-comment-box">';
            $cmtinsert .= '<div class="post-design-pro-comment-img">';
            $cmtinsert .= '<img  src="' . base_url(USERIMAGE . $business_userimage) . '" alt="">  </div>';

            $cmtinsert .= '<div class="comment-name"><b>' . $company_name . '</b>';
            $cmtinsert .= '</div>';

            $cmtinsert .= '<div class="comment-details" id= "imgshowcomment' . $bus_comment['post_image_comment_id'] . '"" >';
            $cmtinsert .= $bus_comment['comment'];
            $cmtinsert .= '</div>';
            $cmtinsert .= '<input type="text" name="' . $bus_comment['post_image_comment_id'] . '" id="imgeditcomment' . $bus_comment['post_image_comment_id'] . '"style="display:none;" value="' . $bus_comment['comment'] . ' " onClick="imgcommentedit(this.name)">';

            $cmtinsert .= '<button id="imgeditsubmit' . $bus_comment['post_image_comment_id'] . '" style="display:none;" onClick="imgedit_comment(' . $bus_comment['post_image_comment_id'] . ')">Comment</button><div class="art-comment-menu-design"> <div class="comment-details-menu" id="imglikecomment' . $bus_comment['post_image_comment_id'] . '">';

            $cmtinsert .= '<a id="' . $bus_comment['post_image_comment_id'] . '"';
            $cmtinsert .= 'onClick="imgcomment_like(this.id)">';

            $contition_array = array('post_image_comment_id' => $bus_comment['post_image_comment_id'], 'user_id' => $userid, 'is_unlike' => 0);

            $businesscommentlike1 = $this->common->select_data_by_condition('bus_comment_image_like', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

            if (count($businesscommentlike1) == 0) {
                $cmtinsert .= '<i class="fa fa-thumbs-o-up fa-1x" aria-hidden="true"></i>';
            } else {

                $cmtinsert .= '<i class="fa fa-thumbs-up" aria-hidden="true"></i>';
            }

            $cmtinsert .= '<span>';

            $contition_array = array('post_image_comment_id' => $bus_comment['post_image_comment_id'], 'is_unlike' => '0');
            $mulcountlike = $this->data['mulcountlike'] = $this->common->select_data_by_condition('bus_comment_image_like', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');


            if (count($mulcountlike) > 0) {
                //echo count($mulcountlike); 
            }
            $cmtinsert .= '</span>';
            $cmtinsert .= '</a></div>';

            $userid = $this->session->userdata('aileenuser');
            if ($bus_comment['user_id'] == $userid) {

                $cmtinsert .= '<span role="presentation" aria-hidden="true"> · </span>';
                $cmtinsert .= '<div class="comment-details-menu">';


                $cmtinsert .= '<div id="imgeditcommentbox' . $bus_comment['post_image_comment_id'] . '"style="display:block;">';

                $cmtinsert .= '<a id="' . $bus_comment['post_image_comment_id'] . '"';
                $cmtinsert .= 'onClick="imgcomment_editbox(this.id)">';
                $cmtinsert .= 'Edit';
                $cmtinsert .= '</a></div>';

                $cmtinsert .= '<div id="imgeditcancle' . $bus_comment['post_image_comment_id'] . '"style="display:none;">';

                $cmtinsert .= '<a id="' . $bus_comment['post_image_comment_id'] . '"';
                $cmtinsert .= 'onClick="imgcomment_editcancle(this.id)">';
                $cmtinsert .= 'Cancel';
                $cmtinsert .= '</a></div>';

                $cmtinsert .= '</div>';
            }
            $userid = $this->session->userdata('aileenuser');


            $userid = $this->session->userdata('aileenuser');

            $business_userid = $this->db->get_where('business_profile_post', array('business_profile_post_id' => $bus_comment['post_image_id'], 'status' => 1))->row()->user_id;


            if ($bus_comment['user_id'] == $userid || $business_userid == $userid) {


                $cmtinsert .= '<span role="presentation" aria-hidden="true"> · </span>';
                $cmtinsert .= '<div class="comment-details-menu">';
                $cmtinsert .= '<input type="hidden" name="imgpost_delete"';
                $cmtinsert .= 'id="imgpost_delete"';
                $cmtinsert .= 'value= "' . $bus_comment['post_image_id'] . '">';
                $cmtinsert .= '<a id="' . $bus_comment['post_image_comment_id'] . '"';
                $cmtinsert .= 'onClick="imgcomment_delete(this.id)">';
                $cmtinsert .= 'Delete';
                $cmtinsert .= '</a></div>';
            }

            $cmtinsert .= '<span role="presentation" aria-hidden="true"> · </span>';
            $cmtinsert .= '<div class="comment-details-menu">';
            $cmtinsert .= '<p>' . $bus_comment['created_date'] . '</p></div></div>';

            $cmtcount = '<a onClick="imgcommentall(this.id)" id="' . $post_image_id . '">';
            $cmtcount .= '<i class="fa fa-comment-o" aria-hidden="true">';
            $cmtcount .= ' ' . count($buscmtcnt) . '';
            $cmtcount .= '</i></a>';

            // comment count variable end 
        }
        echo json_encode(
                array("comment" => $cmtinsert,
                    "count" => $cmtcount));
    }

//multiple images comment end 
//multiple images comment like start
    public function mulimg_comment_like() {

        $userid = $this->session->userdata('aileenuser');
        $post_image_comment_id = $_POST["post_image_comment_id"];

        $contition_array = array('post_image_comment_id' => $post_image_comment_id, 'user_id' => $userid);

        $likecommentuser = $this->data['likecommentuser'] = $this->common->select_data_by_condition('bus_comment_image_like', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        if (!$likecommentuser) {

            $data = array(
                'post_image_comment_id' => $post_image_comment_id,
                'user_id' => $userid,
                'created_date' => date('Y-m-d', time()),
                'is_unlike' => 0
            );
//echo "<pre>"; print_r($data); die();

            $insertdata = $this->common->insert_data_getid($data, 'bus_comment_image_like');

            $contition_array = array('post_image_comment_id' => $_POST["post_image_comment_id"], 'is_unlike' => '0');
            $bdatacm = $this->data['bdatacm'] = $this->common->select_data_by_condition('bus_comment_image_like', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

            if ($insertdata) {


                $imglike .= '<a id="' . $post_image_comment_id . '" onClick="imgcomment_like(this.id)">';
                $imglike .= ' <i class="fa fa-thumbs-up" aria-hidden="true">';
                $imglike .= '</i>';
                $imglike .= '<span>';
                if (count($bdatacm) > 0) {
                    $imglike .= count($bdatacm) . '';
                }
                $imglike .= '</span>';
                $imglike .= '</a>';


                echo $imglike;
            }
        } else {

            if ($likecommentuser[0]['is_unlike'] == 0) {

                $data = array(
                    'modify_date' => date('Y-m-d', time()),
                    'is_unlike' => 1
                );


                $updatdata = $this->common->update_data($data, 'bus_comment_image_like', 'post_image_comment_id', $post_image_comment_id);

                $contition_array = array('post_image_comment_id' => $post_image_comment_id, 'is_unlike' => '0');
                $bdata2 = $this->data['bdata2'] = $this->common->select_data_by_condition('bus_comment_image_like', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');



                if ($updatdata) {


                    $imglike1 .= '<a id="' . $post_image_comment_id . '" onClick="imgcomment_like(this.id)">';
                    $imglike1 .= '<i class="fa fa-thumbs-o-up fa-1x" aria-hidden="true">';
                    $imglike1 .= '</i>';
                    $imglike1 .= '<span>';
                    if (count($bdata2) > 0) {
                        $imglike1 .= count($bdata2) . '';
                    }
                    $imglike1 .= '</span>';
                    $imglike1 .= '</a>';


                    echo $imglike1;
                }
            } else {

                $data = array(
                    'modify_date' => date('Y-m-d', time()),
                    'is_unlike' => 0
                );


                $updatdata = $this->common->update_data($data, 'bus_comment_image_like', 'post_image_comment_id', $post_image_comment_id);

                $contition_array = array('post_image_comment_id' => $_POST["post_image_comment_id"], 'is_unlike' => '0');
                $bdata2 = $this->data['bdata2'] = $this->common->select_data_by_condition('bus_comment_image_like', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');



                if ($updatdata) {


                    $imglike1 .= '<a id="' . $post_image_comment_id . '" onClick="imgcomment_like(this.id)">';
                    $imglike1 .= '<i class="fa fa-thumbs-up" aria-hidden="true">';
                    $imglike1 .= '</i>';
                    $imglike1 .= '<span>';
                    if (count($bdata2) > 0) {
                        $imglike1 .= count($bdata2) . '';
                    }
                    $imglike1 .= '</span>';
                    $imglike1 .= '</a>';


                    echo $imglike1;
                }
            }
        }
    }

    public function mulimg_comment_liketwo() {

        $userid = $this->session->userdata('aileenuser');
        $post_image_comment_id = $_POST["post_image_comment_id"];

        $contition_array = array('post_image_comment_id' => $post_image_comment_id, 'user_id' => $userid);

        $likecommentuser = $this->data['likecommentuser'] = $this->common->select_data_by_condition('bus_comment_image_like', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        if (!$likecommentuser) {

            $data = array(
                'post_image_comment_id' => $post_image_comment_id,
                'user_id' => $userid,
                'created_date' => date('Y-m-d', time()),
                'is_unlike' => 0
            );
//echo "<pre>"; print_r($data); die();

            $insertdata = $this->common->insert_data_getid($data, 'bus_comment_image_like');

            $contition_array = array('post_image_comment_id' => $_POST["post_image_comment_id"], 'is_unlike' => '0');
            $bdatacm = $this->data['bdatacm'] = $this->common->select_data_by_condition('bus_comment_image_like', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

            if ($insertdata) {


                $imglike .= '<a id="' . $post_image_comment_id . '" onClick="imgcomment_liketwo(this.id)">';
                $imglike .= ' <i class="fa fa-thumbs-up" aria-hidden="true">';
                $imglike .= '</i>';
                $imglike .= '<span>';
                if (count($bdatacm) > 0) {
                    $imglike .= count($bdatacm) . '';
                }
                $imglike .= '</span>';
                $imglike .= '</a>';


                echo $imglike;
            }
        } else {

            if ($likecommentuser[0]['is_unlike'] == 0) {

                $data = array(
                    'modify_date' => date('Y-m-d', time()),
                    'is_unlike' => 1
                );


                $updatdata = $this->common->update_data($data, 'bus_comment_image_like', 'post_image_comment_id', $post_image_comment_id);

                $contition_array = array('post_image_comment_id' => $post_image_comment_id, 'is_unlike' => '0');
                $bdata2 = $this->data['bdata2'] = $this->common->select_data_by_condition('bus_comment_image_like', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');



                if ($updatdata) {


                    $imglike1 .= '<a id="' . $post_image_comment_id . '" onClick="imgcomment_liketwo(this.id)">';
                    $imglike1 .= '<i class="fa fa-thumbs-o-up fa-1x" aria-hidden="true">';
                    $imglike1 .= '</i>';
                    $imglike1 .= '<span>';
                    if (count($bdata2) > 0) {
                        $imglike1 .= count($bdata2) . '';
                    }
                    $imglike1 .= '</span>';
                    $imglike1 .= '</a>';


                    echo $imglike1;
                }
            } else {

                $data = array(
                    'modify_date' => date('Y-m-d', time()),
                    'is_unlike' => 0
                );


                $updatdata = $this->common->update_data($data, 'bus_comment_image_like', 'post_image_comment_id', $post_image_comment_id);

                $contition_array = array('post_image_comment_id' => $_POST["post_image_comment_id"], 'is_unlike' => '0');
                $bdata2 = $this->data['bdata2'] = $this->common->select_data_by_condition('bus_comment_image_like', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');



                if ($updatdata) {


                    $imglike1 .= '<a id="' . $post_image_comment_id . '" onClick="imgcomment_liketwo(this.id)">';
                    $imglike1 .= '<i class="fa fa-thumbs-up" aria-hidden="true">';
                    $imglike1 .= '</i>';
                    $imglike1 .= '<span>';
                    if (count($bdata2) > 0) {
                        $imglike1 .= count($bdata2) . '';
                    }
                    $imglike1 .= '</span>';
                    $imglike1 .= '</a>';


                    echo $imglike1;
                }
            }
        }
    }

//multiple images comemnt like end
//multiple images comment edit start
    public function mul_edit_com_insert() {

        $userid = $this->session->userdata('aileenuser');

        $post_image_comment_id = $_POST["post_image_comment_id"];
        $post_comment = $_POST["comment"];

        $data = array(
            'comment' => $post_comment,
            'modify_date' => date('y-m-d h:i:s')
        );


        $updatdata = $this->common->update_data($data, 'bus_post_image_comment', 'post_image_comment_id', $post_image_comment_id);
        if ($updatdata) {

            $contition_array = array('post_image_comment_id' => $_POST["post_image_comment_id"], 'is_delete' => '0');
            $buseditdata = $this->data['buseditdata'] = $this->common->select_data_by_condition('bus_post_image_comment', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

            $cmtlike = '<div>';
            $cmtlike .= $buseditdata[0]['comment'] . "<br>";
            $cmtlike .= '</div>';
            echo $cmtlike;
        }
    }

//multiple images comment edit end
//multiple images commnet delete start
    public function mul_delete_comment() {
        $userid = $this->session->userdata('aileenuser');
        $post_image_comment_id = $_POST["post_image_comment_id"];
        $post_delete = $_POST["post_delete"];
        $data = array(
            'is_delete' => 1,
            'modify_date' => date('y-m-d h:i:s')
        );


        $updatdata = $this->common->update_data($data, 'bus_post_image_comment', 'post_image_comment_id', $post_image_comment_id);


        $contition_array = array('post_image_id' => $post_delete, 'is_delete' => '0');
        $businesscomment = $this->common->select_data_by_condition('bus_post_image_comment', $contition_array, $data = '*', $sortby = 'post_image_comment_id', $orderby = 'DESC', $limit = '1', $offset = '', $join_str = array(), $groupby = '');

        // count for comment
        $contition_array = array('post_image_id' => $post_delete, 'is_delete' => '0');
        $buscmtcnt = $this->common->select_data_by_condition('bus_post_image_comment', $contition_array, $data = '*', $sortby = 'post_image_comment_id', $orderby = 'DESC', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        //echo "<pre>"; print_r($businesscomment); die();
        foreach ($businesscomment as $bus_comment) {


            $company_name = $this->db->get_where('business_profile', array('user_id' => $bus_comment['user_id']))->row()->company_name;

            $business_userimage = $this->db->get_where('business_profile', array('user_id' => $bus_comment['user_id'], 'status' => 1))->row()->business_user_image;

            //$cmtinsert = '<div class="all-comment-comment-box">';
            $cmtinsert .= '<div class="post-design-pro-comment-img">';
            $cmtinsert .= '<img  src="' . base_url(USERIMAGE . $business_userimage) . '" alt="">  </div>';

            $cmtinsert .= '<div class="comment-name"><b>' . $company_name . '</b>';
            $cmtinsert .= '</div>';

            $cmtinsert .= '<div class="comment-details" id= "showcomment' . $bus_comment['post_image_comment_id'] . '"" >';
            $cmtinsert .= $bus_comment['comment'];
            $cmtinsert .= '</div>';
            $cmtinsert .= '<input type="text" name="' . $bus_comment['post_image_comment_id'] . '" id="editcomment' . $bus_comment['post_image_comment_id'] . '"style="display:none;" value="' . $bus_comment['comment'] . ' " onClick="commentedit(this.name)">';

            $cmtinsert .= '<button id="editsubmit' . $bus_comment['post_image_comment_id'] . '" style="display:none;" onClick="edit_comment(' . $bus_comment['post_image_comment_id'] . ')">Comment</button><div class="art-comment-menu-design"> <div class="comment-details-menu" id="likecomment' . $bus_comment['post_image_comment_id'] . '">';

            $cmtinsert .= '<a id="' . $bus_comment['post_image_comment_id'] . '"';
            $cmtinsert .= 'onClick="comment_like(this.id)">';

            $contition_array = array('post_image_comment_id' => $bus_comment['post_image_comment_id'], 'user_id' => $userid, 'is_unlike' => 0);

            $businesscommentlike1 = $this->common->select_data_by_condition('bus_comment_image_like', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

            if (count($businesscommentlike1) == 0) {
                $cmtinsert .= '<i class="fa fa-thumbs-o-up fa-1x" aria-hidden="true"></i>';
            } else {

                $cmtinsert .= '<i class="fa fa-thumbs-up" aria-hidden="true"></i>';
            }

            $cmtinsert .= '<span>';

            $contition_array = array('post_image_comment_id' => $bus_comment['post_image_comment_id'], 'is_unlike' => '0');
            $mulcountlike = $this->data['mulcountlike'] = $this->common->select_data_by_condition('bus_comment_image_like', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');


            if (count($mulcountlike) > 0) {
                echo count($mulcountlike);
            }
            $cmtinsert .= '</span>';
            $cmtinsert .= '</a></div>';

            $userid = $this->session->userdata('aileenuser');
            if ($bus_comment['user_id'] == $userid) {

                $cmtinsert .= '<span role="presentation" aria-hidden="true"> · </span>';
                $cmtinsert .= '<div class="comment-details-menu">';


                $cmtinsert .= '<div id="editcommentbox' . $bus_comment['post_image_comment_id'] . '"style="display:block;">';

                $cmtinsert .= '<a id="' . $bus_comment['post_image_comment_id'] . '"';
                $cmtinsert .= 'onClick="comment_editbox(this.id)">';
                $cmtinsert .= 'Edit';
                $cmtinsert .= '</a></div>';

                $cmtinsert .= '<div id="editcancle' . $bus_comment['post_image_comment_id'] . '"style="display:none;">';

                $cmtinsert .= '<a id="' . $bus_comment['post_image_comment_id'] . '"';
                $cmtinsert .= 'onClick="comment_editcancle(this.id)">';
                $cmtinsert .= 'Cancel';
                $cmtinsert .= '</a></div>';

                $cmtinsert .= '</div>';
            }
            $userid = $this->session->userdata('aileenuser');


            $userid = $this->session->userdata('aileenuser');

            $business_userid = $this->db->get_where('business_profile_post', array('business_profile_post_id' => $bus_comment['post_image_id'], 'status' => 1))->row()->user_id;


            if ($bus_comment['user_id'] == $userid || $business_userid == $userid) {


                $cmtinsert .= '<span role="presentation" aria-hidden="true"> · </span>';
                $cmtinsert .= '<div class="comment-details-menu">';


                $cmtinsert .= '<input type="hidden" name="imgpost_delete"';
                $cmtinsert .= 'id="imgpost_delete"';
                $cmtinsert .= 'value= "' . $bus_comment['post_image_id'] . '">';
                $cmtinsert .= '<a id="' . $bus_comment['post_image_comment_id'] . '"';
                $cmtinsert .= 'onClick="imgcomment_delete(this.id)">';
                $cmtinsert .= 'Delete';
                $cmtinsert .= '</a></div>';
            }

            $cmtinsert .= '<span role="presentation" aria-hidden="true"> · </span>';
            $cmtinsert .= '<div class="comment-details-menu">';
            $cmtinsert .= '<p>' . $bus_comment['created_date'] . '</p></div></div>';

            $cmtcount = '<a onClick="imgcommentall(this.id)" id="' . $post_delete . '">';
            $cmtcount .= '<i class="fa fa-comment-o" aria-hidden="true">';
            $cmtcount .= ' ' . count($buscmtcnt) . '';
            $cmtcount .= '</i></a>';

            // comment count variable end 
        }
        echo json_encode(
                array("comment" => $cmtinsert,
                    "count" => $cmtcount));
    }

    public function mul_delete_commenttwo() {
        $userid = $this->session->userdata('aileenuser');
        $post_image_comment_id = $_POST["post_image_comment_id"];
        $post_delete = $_POST["post_delete"];

        $data = array(
            'is_delete' => 1,
            'modify_date' => date('y-m-d h:i:s')
        );


        $updatdata = $this->common->update_data($data, 'bus_post_image_comment', 'post_image_comment_id', $post_image_comment_id);


        $contition_array = array('post_image_id' => $post_delete, 'is_delete' => '0');
        $businesscomment = $this->common->select_data_by_condition('bus_post_image_comment', $contition_array, $data = '*', $sortby = 'post_image_comment_id', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        //echo "<pre>"; print_r($businesscomment); die();
        foreach ($businesscomment as $bus_comment) {


            $company_name = $this->db->get_where('business_profile', array('user_id' => $bus_comment['user_id']))->row()->company_name;

            $business_userimage = $this->db->get_where('business_profile', array('user_id' => $bus_comment['user_id'], 'status' => 1))->row()->business_user_image;

            //$cmtinsert = '<div class="all-comment-comment-box">';
            $cmtinsert .= '<div class="post-design-pro-comment-img">';
            $cmtinsert .= '<img  src="' . base_url(USERIMAGE . $business_userimage) . '" alt="">  </div>';

            $cmtinsert .= '<div class="comment-name"><b>' . $company_name . '</b>';
            $cmtinsert .= '</div>';

            $cmtinsert .= '<div class="comment-details" id= "imgshowcommenttwo' . $bus_comment['post_image_comment_id'] . '"" >';
            $cmtinsert .= $bus_comment['comment'];
            $cmtinsert .= '</div>';

            $cmtinsert .= '<div class="edit-comment-box"><div class="inputtype-edit-comment">';
            $cmtinsert .= '<textarea type="text" class="textarea" name="' . $business_profile['business_profile_post_comment_id'] . '" id="editcomment' . $business_profile['business_profile_post_comment_id'] . '" style="display:none;resize: none;" onClick="commentedit(this.name)">' . $business_profile['comments'] . '</textarea>';
            $cmtinsert .= '<span class="comment-edit-button"><button id="editsubmit' . $business_profile['business_profile_post_comment_id'] . '" style="display:none" onClick="edit_comment(' . $business_profile['business_profile_post_comment_id'] . ')">Comment</button></span>';
            $cmtinsert .= '</div></div>';

//            $cmtinsert .= '<input type="text" name="' . $bus_comment['post_image_comment_id'] . '" id="imgeditcommenttwo' . $bus_comment['post_image_comment_id'] . '"style="display:none;" value="' . $bus_comment['comment'] . ' " onClick="imgcommentedittwo(this.name)">';
//            $cmtinsert .= '<button id="imgeditsubmittwo' . $bus_comment['post_image_comment_id'] . '" style="display:none;" onClick="imgedit_commenttwo(' . $bus_comment['post_image_comment_id'] . ')">Comment</button><div class="art-comment-menu-design"> <div class="comment-details-menu" id="imglikecomment1' . $bus_comment['post_image_comment_id'] . '">';

            $cmtinsert .= '<div class="art-comment-menu-design"><div class="comment-details-menu" id="likecomment1' . $business_profile['business_profile_post_comment_id'] . '">';
            $cmtinsert .= '<a id="' . $bus_comment['post_image_comment_id'] . '"';
            $cmtinsert .= 'onClick="imgcomment_liketwo(this.id)">';

            $contition_array = array('post_image_comment_id' => $bus_comment['post_image_comment_id'], 'user_id' => $userid, 'is_unlike' => 0);

            $businesscommentlike1 = $this->common->select_data_by_condition('bus_comment_image_like', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

            if (count($businesscommentlike1) == 0) {
                $cmtinsert .= '<i class="fa fa-thumbs-o-up fa-1x" aria-hidden="true"></i>';
            } else {

                $cmtinsert .= '<i class="fa fa-thumbs-up" aria-hidden="true"></i>';
            }

            $cmtinsert .= '<span>';

            $contition_array = array('post_image_comment_id' => $bus_comment['post_image_comment_id'], 'is_unlike' => '0');
            $mulcountlike = $this->data['mulcountlike'] = $this->common->select_data_by_condition('bus_comment_image_like', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');


            if (count($mulcountlike) > 0) {
                echo count($mulcountlike);
            }
            $cmtinsert .= '</span>';
            $cmtinsert .= '</a></div>';

            $userid = $this->session->userdata('aileenuser');
            if ($bus_comment['user_id'] == $userid) {

                $cmtinsert .= '<span role="presentation" aria-hidden="true"> · </span>';
                $cmtinsert .= '<div class="comment-details-menu">';


                $cmtinsert .= '<div id="imgeditcommentboxtwo' . $bus_comment['post_image_comment_id'] . '"style="display:block;">';

                $cmtinsert .= '<a id="' . $bus_comment['post_image_comment_id'] . '"';
                $cmtinsert .= 'onClick="imgcomment_editboxtwo(this.id)">';
                $cmtinsert .= 'Edit';
                $cmtinsert .= '</a></div>';

                $cmtinsert .= '<div id="imgeditcancletwo' . $bus_comment['post_image_comment_id'] . '"style="display:none;">';

                $cmtinsert .= '<a id="' . $bus_comment['post_image_comment_id'] . '"';
                $cmtinsert .= 'onClick="imgcomment_editcancletwo(this.id)">';
                $cmtinsert .= 'Cancel';
                $cmtinsert .= '</a></div>';

                $cmtinsert .= '</div>';
            }
            $userid = $this->session->userdata('aileenuser');


            $userid = $this->session->userdata('aileenuser');

            $business_userid = $this->db->get_where('business_profile_post', array('business_profile_post_id' => $bus_comment['post_image_id'], 'status' => 1))->row()->user_id;


            if ($bus_comment['user_id'] == $userid || $business_userid == $userid) {


                $cmtinsert .= '<span role="presentation" aria-hidden="true"> · </span>';
                $cmtinsert .= '<div class="comment-details-menu">';


                $cmtinsert .= '<input type="hidden" name="imgpost_delete1"';
                $cmtinsert .= 'id="imgpost_delete1"';
                $cmtinsert .= 'value= "' . $bus_comment['post_image_id'] . '">';
                $cmtinsert .= '<a id="' . $bus_comment['post_image_comment_id'] . '"';
                $cmtinsert .= 'onClick="imgcomment_deletetwo(this.id)">';
                $cmtinsert .= 'Delete';
                $cmtinsert .= '</a></div>';
            }

            $cmtinsert .= '<span role="presentation" aria-hidden="true"> · </span>';
            $cmtinsert .= '<div class="comment-details-menu">';
            $cmtinsert .= '<p>' . $bus_comment['created_date'] . '</p></div></div>';
        }
        echo $cmtinsert;
    }

    //mulitple images commnet delete end  

    public function fourcomment($postid) {

        $userid = $this->session->userdata('aileenuser');
        //$post_id =  $postid; 
        $post_id = $_POST['bus_post_id'];

        // html start

        $fourdata = '<div class="insertcommenttwo' . $post_id . '">';

        $contition_array = array('business_profile_post_id' => $post_id, 'status' => '1');
        $busienssdata = $this->data['busienssdata'] = $this->common->select_data_by_condition('business_profile_post_comment', $contition_array, $data = '*', $sortby = 'business_profile_post_comment_id', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        if ($busienssdata) {
            foreach ($busienssdata as $rowdata) {

                $companyname = $this->db->get_where('business_profile', array('user_id' => $rowdata['user_id']))->row()->company_name;

                $fourdata .= '<div class="all-comment-comment-box">';
                $fourdata .= '<div class="post-design-pro-comment-img">';

                $busienss_userimage = $this->db->get_where('business_profile', array('user_id' => $rowdata['user_id'], 'status' => 1))->row()->business_user_image;

                if ($busienss_userimage) {
                    $fourdata .= '<img  src="' . base_url(USERIMAGE . $busienss_userimage) . '"  alt="">';
                } else {
                    $fourdata .= '<img src="' . base_url(NOIMAGE) . '" alt="">';
                }
                $fourdata .= '</div><div class="comment-name"><b>';
                $fourdata .= '' . ucwords($companyname) . '</br></b></div>';
                $fourdata .= '<div class="comment-details" id= "showcommenttwo' . $rowdata['business_profile_post_comment_id'] . '">';
                $fourdata .= '' . $rowdata['comments'] . '</br> </div>';
                $fourdata .= '<div class="edit-comment-box"><div class="inputtype-edit-comment">';
                $fourdata .= '<textarea type="text" class="textarea" name="' . $rowdata['business_profile_post_comment_id'] . '" id="editcommenttwo' . $rowdata['business_profile_post_comment_id'] . '" style="display:none; resize:none;" onClick="commentedittwo(this.name)">' . $rowdata['comments'] . '</textarea>';
                $fourdata .= '<span class="comment-edit-button"><button id="editsubmittwo' . $rowdata['business_profile_post_comment_id'] . '" style="display:none" onClick="edit_commenttwo(' . $rowdata['business_profile_post_comment_id'] . ')">Comment</button></span>';

//$fourdata .= '<input type="text" name="' . $rowdata['business_profile_post_comment_id'] . '" id="editcommenttwo' . $rowdata['business_profile_post_comment_id'] . '" style="display:none" value="' . $rowdata['comments'] . '" onClick="commentedittwo(this.name)"></div>';
//
//$fourdata .= '<div class="col-md-2 comment-edit-button">';
//$fourdata .= '<button id="editsubmittwo' . $rowdata['business_profile_post_comment_id'] . '" style="display:none" onClick="edit_commenttwo(' . $rowdata['business_profile_post_comment_id'] . ')">Comment</button></div>';

                $fourdata .= '</div></div><div class="art-comment-menu-design">';
                $fourdata .= '<div class="comment-details-menu" id="likecomment' . $rowdata['business_profile_post_comment_id'] . '">';
                $fourdata .= '<a id="' . $rowdata['business_profile_post_comment_id'] . '"   onClick="comment_like(this.id)">';

                $userid = $this->session->userdata('aileenuser');
                $contition_array = array('business_profile_post_comment_id' => $rowdata['business_profile_post_comment_id'], 'status' => '1');
                $businesscommentlike = $this->data['businesscommentlike'] = $this->common->select_data_by_condition('business_profile_post_comment', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
                $likeuserarray = explode(',', $businesscommentlike[0]['business_comment_like_user']);

                if (!in_array($userid, $likeuserarray)) {

                    $fourdata .= '<i class="fa fa-thumbs-o-up fa-1x" aria-hidden="true"></i>';
                } else {

                    $fourdata .= '<i class="fa fa-thumbs-up" aria-hidden="true"></i>';
                }
                $fourdata .= '<span>';

                if ($rowdata['business_comment_likes_count'] > 0) {
                    $fourdata .= '' . $rowdata['business_comment_likes_count'] . '';
                }

                $fourdata .= '</span></a></div>';
                $userid = $this->session->userdata('aileenuser');
                if ($rowdata['user_id'] == $userid) {

                    $fourdata .= '<span role="presentation" aria-hidden="true"> · </span>';
                    $fourdata .= '<div class="comment-details-menu">';

                    $fourdata .= '<div id="editcommentboxtwo' . $rowdata['business_profile_post_comment_id'] . '" style="display:block;">';
                    $fourdata .= '<a id="' . $rowdata['business_profile_post_comment_id'] . '"   onClick="comment_editboxtwo(this.id)" class="editbox">Edit
                                     </a>
                                     </div>';

                    $fourdata .= '<div id="editcancletwo' . $rowdata['business_profile_post_comment_id'] . '" style="display:none;">';
                    $fourdata .= '<a id="' . $rowdata['business_profile_post_comment_id'] . '" onClick="comment_editcancletwo(this.id)">Cancel</a></div></div>';
                }

                $userid = $this->session->userdata('aileenuser');
                $business_userid = $this->db->get_where('business_profile_post', array('business_profile_post_id' => $rowdata['business_profile_post_id'], 'status' => 1))->row()->user_id;
                if ($rowdata['user_id'] == $userid || $business_userid == $userid) {


                    $fourdata .= '<span role="presentation" aria-hidden="true"> · </span>';
                    $fourdata .= '<div class="comment-details-menu">';
                    $fourdata .= '<input type="hidden" name="post_delete"';
                    $fourdata .= 'id="post_deletetwo"; value= "' . $rowdata['business_profile_post_id'] . '">';
                    $fourdata .= '<a id="' . $rowdata['business_profile_post_comment_id'] . '"onClick="comment_deletetwo(this.id)"> Delete<span class="insertcommenttwo' . $rowdata['business_profile_post_comment_id'] . '"></span></a></div>';
                }
                $fourdata .= '<span role="presentation" aria-hidden="true"> · </span>';
                $fourdata .= '<div class="comment-details-menu">';
                $fourdata .= '<p>' . date('d-M-Y', strtotime($rowdata['created_date'])) . '</br>';

                $fourdata .= '</p></div></div></div>';
            }
        }
        $fourdata .= '</div>';

        echo $fourdata;
    }

    public function mulfourcomment($postid) {

        $userid = $this->session->userdata('aileenuser');
        //$post_id =  $postid; 
        $post_id = $_POST['bus_post_id'];

        $fourdata .= '<div class="insertcommenttwo' . $post_id . '">';

        $contition_array = array('post_image_id' => $post_id, 'is_delete' => '0');

        $busmulimage1 = $this->common->select_data_by_condition('bus_post_image_comment', $contition_array, $data = '*', $sortby = 'post_image_comment_id', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        if ($busmulimage1) {
            foreach ($busmulimage1 as $rowdata) {

                $companyname = $this->db->get_where('business_profile', array('user_id' => $rowdata['user_id']))->row()->company_name;


                $fourdata .= '<div class="all-comment-comment-box">';

                $fourdata .= '<div class="post-design-pro-comment-img">';

                $business_userimage = $this->db->get_where('business_profile', array('user_id' => $rowdata['user_id'], 'status' => 1))->row()->business_user_image;


                $fourdata .= '<img  src="' . base_url(USERIMAGE . $business_userimage) . '"  alt=""> </div>';

                $fourdata .= '<div class="comment-name"><b>';
                $fourdata .= '' . ucwords($companyname) . '</br>';
                $fourdata .= '</b></div>';
                $fourdata .= '<div class="comment-details" id= "showcommenttwo' . $rowdata['post_image_comment_id'] . '" style="display: block;">';
                $fourdata .= '' . $rowdata['comment'] . '</br> </div>';

                $fourdata .= '<div class="col-md-12"><div class="col-md-10">';
                $fourdata .= '<input type="text" name="' . $rowdata['post_image_comment_id'] . '" id="editcommenttwo' . $rowdata['post_image_comment_id'] . '" style="display: none;" value="' . $rowdata['comment'] . '" onClick="commentedittwo(this.name)">';

                $fourdata .= '</div>  <div class="col-md-2 comment-edit-button">';
                $fourdata .= '<button id="editsubmittwo' . $rowdata['post_image_comment_id'] . '" style="display:none" onClick="edit_commenttwo(' . $rowdata['post_image_comment_id'] . ')">Comment</button></div> </div>';

                $fourdata .= '<div class="comment-details-menu" id="likecomment1' . $rowdata['post_image_comment_id'] . '">';

                $fourdata .= '<a id="' . $rowdata['post_image_comment_id'] . '"   onClick="comment_like1(this.id)">';

                $userid = $this->session->userdata('aileenuser');
                $contition_array = array('post_image_comment_id' => $rowdata['post_image_comment_id'], 'user_id' => $userid, 'is_unlike' => 0);

                $businesscommentlike2 = $this->common->select_data_by_condition('bus_comment_image_like', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

                if (count($businesscommentlike2) == 0) {
                    $fourdata .= '<i class="fa fa-thumbs-o-up fa-1x" aria-hidden="true"></i>';
                } else {
                    $fourdata .= '<i class="fa fa-thumbs-up" aria-hidden="true"></i>';
                }
                $fourdata .= '<span>';

                $contition_array = array('post_image_comment_id' => $rowdata['post_image_comment_id'], 'is_unlike' => '0');
                $mulcountlike1 = $this->data['mulcountlike'] = $this->common->select_data_by_condition('bus_comment_image_like', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

                if (count($mulcountlike1) > 0) {
                    echo count($mulcountlike1);
                }


                $fourdata .= '</span></a></div>';
                $userid = $this->session->userdata('aileenuser');
                if ($rowdata['user_id'] == $userid) {

                    $fourdata .= '<div class="comment-details-menu">';
                    $fourdata .= '<div id="editcommentboxtwo' . $rowdata['post_image_comment_id'] . '" style="display:block;">';
                    $fourdata .= '<a id="' . $rowdata['post_image_comment_id'] . '"   onClick="comment_editboxtwo(this.id)" class="editbox">Edit
                                      </a>
                                      </div>';

                    $fourdata .= '<div id="editcancletwo' . $rowdata['post_image_comment_id'] . '" style="display:none;">';
                    $fourdata .= '<a id="' . $rowdata['post_image_comment_id'] . '" onClick="comment_editcancletwo(this.id)">Cancel </a></div>';

                    $fourdata .= '</div>';
                }

                $userid = $this->session->userdata('aileenuser');

                $business_userid = $this->db->get_where('business_profile_post', array('business_profile_post_id' => $rowdata['post_image_id'], 'status' => 1))->row()->user_id;


                if ($rowdata['user_id'] == $userid || $business_userid == $userid) {

                    $fourdata .= '<span role="presentation" aria-hidden="true"> · </span>';
                    $fourdata .= '<div class="comment-details-menu">';



                    $fourdata .= '<input type="hidden" name="post_deletetwo"';
                    $fourdata .= 'id="post_deletetwo" value= "' . $rowdata['post_image_id'] . '">';
                    $fourdata .= '<a id="' . $rowdata['post_image_comment_id'] . '"   onClick="comment_deletetwo(this.id)"> Delete<span class="insertcomment1' . $rowdata['post_image_comment_id'] . '">';
                    $fourdata .= '</span></a></div>';
                }

                $fourdata .= '<span role="presentation" aria-hidden="true"> · </span>';
                $fourdata .= '<div class="comment-details-menu">';
                $fourdata .= '<p>' . date('d-M-Y', strtotime($rowdata['created_date'])) . '</br></p></div>';

                $fourdata .= '</div>';
            }
        }
        $fourdata .= '</div></div>';

        echo $fourdata;
    }

    //postnews page controller start

    public function pnfourcomment($postid) {

        $post_id = $_POST['bus_post_id'];
        // $post_id = "29";

        $contition_array = array('business_profile_post_id' => $post_id, 'status' => '1');
        $busienssdata = $this->data['busienssdata'] = $this->common->select_data_by_condition('business_profile_post_comment', $contition_array, $data = '*', $sortby = 'business_profile_post_comment_id', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        if ($busienssdata) {
            foreach ($busienssdata as $rowdata) {


                $companyname = $this->db->get_where('business_profile', array('user_id' => $rowdata['user_id']))->row()->company_name;

                $pnfour .= '<div class="all-comment-comment-box">';
                $pnfour .= '<div class="post-design-pro-comment-img">';
                //  echo $pnfour;  

                $business_userimage = $this->db->get_where('business_profile', array('user_id' => $rowdata['user_id'], 'status' => 1))->row()->business_user_image;


                $pnfour .= '<img  src="' . base_url(USERIMAGE . $business_userimage) . '"  alt=""></div>';

                $pnfour .= '<div class="comment-name">';
                $pnfour .= '<b>' . $companyname . '</br></b> </div>';

                $pnfour .= '<div class="comment-details" id="showcommenttwo' . $rowdata['business_profile_post_comment_id'] . '">';
                $pnfour .= '' . $rowdata['comments'] . '</br></div>';

                $pnfour .= '<div class="col-md-12"><div class="col-md-10">';
                $pnfour .= '<input type="text" name="' . $rowdata['business_profile_post_comment_id'] . '" id="editcommenttwo' . $rowdata['business_profile_post_comment_id'] . '" style="display:none" value="' . $rowdata['comments'] . '" onClick="commentedittwo(this.name)">';
                $pnfour .= '</div>  <div class="col-md-2 comment-edit-button">';
                $pnfour .= '<button id="editsubmittwo' . $rowdata['business_profile_post_comment_id'] . '" style="display:none" onClick="edit_commenttwo(' . $rowdata['business_profile_post_comment_id'] . ')">Comment</button>
 </div>';

                $pnfour .= '</div><div class="art-comment-menu-design">';

                $pnfour .= '<div class="comment-details-menu" id="likecomment' . $rowdata['business_profile_post_comment_id'] . '">';

                $pnfour .= '<a id="' . $rowdata['business_profile_post_comment_id'] . '" onClick="comment_like(this.id)">';


                $userid = $this->session->userdata('aileenuser');
                $contition_array = array('business_profile_post_comment_id' => $rowdata['business_profile_post_comment_id'], 'status' => '1');
                $businesscommentlike = $this->data['businesscommentlike'] = $this->common->select_data_by_condition('business_profile_post_comment', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
                $likeuserarray = explode(',', $businesscommentlike[0]['business_comment_like_user']);

                if (!in_array($userid, $likeuserarray)) {

                    $pnfour .= '<i class="fa fa-thumbs-o-up fa-1x" aria-hidden="true"></i>';
                } else {
                    $pnfour .= '<i class="fa fa-thumbs-up" aria-hidden="true"></i>';
                }
                $pnfour .= '<span>';

                if ($rowdata['business_comment_likes_count'] > 0) {
                    $pnfour .= '' . $rowdata['business_comment_likes_count'] . '';
                }

                $pnfour .= '</span></a></div>';

                $userid = $this->session->userdata('aileenuser');
                if ($rowdata['user_id'] == $userid) {

                    $pnfour .= '<span role="presentation" aria-hidden="true"> · </span>';
                    $pnfour .= '<div class="comment-details-menu">';

                    $pnfour .= '<div id="editcommentboxtwo' . $rowdata['business_profile_post_comment_id'] . '" style="display:block;">';
                    $pnfour .= '<a id="' . $rowdata['business_profile_post_comment_id'] . '"onClick="comment_editboxtwo(this.id)" class="editbox">Edit</a></div>';

                    $pnfour .= '<div id="editcancletwo' . $rowdata['business_profile_post_comment_id'] . '" style="display:none;">';
                    $pnfour .= '<a id="' . $rowdata['business_profile_post_comment_id'] . '" onClick="comment_editcancletwo(this.id)">Cancel</a>';
                    $pnfour .= '</div></div>';
                }
                $userid = $this->session->userdata('aileenuser');
                $business_userid = $this->db->get_where('business_profile_post', array('business_profile_post_id' => $rowdata['business_profile_post_id'], 'status' => 1))->row()->user_id;
                if ($rowdata['user_id'] == $userid || $business_userid == $userid) {


                    $pnfour .= '<span role="presentation" aria-hidden="true"> · </span>';
                    $pnfour .= '<div class="comment-details-menu">';

                    $pnfour .= '<input type="hidden" name="post_delete"  id="post_delete"';
                    $pnfour .= 'value= "' . $rowdata['business_profile_post_id'] . '">';
                    $pnfour .= '<a id="' . $rowdata['business_profile_post_comment_id'] . '"   onClick="comment_deletetwo(this.id)"> Delete<span class="insertcomment' . $rowdata['business_profile_post_comment_id'] . '"></span></a></div>';
                }
                $pnfour .= '<span role="presentation" aria-hidden="true"> · </span>';
                $pnfour .= '<div class="comment-details-menu">';
                $pnfour .= '<p>' . date('d-M-Y', strtotime($rowdata['created_date'])) . '</br>';
                $pnfour .= '</p></div></div></div>';
            }
        }

        echo $pnfour;
    }

    public function pninsert_comment() {

        $userid = $this->session->userdata('aileenuser');

        $post_id = $_POST["post_id"];
        $post_comment = $_POST["comment"];

        $data = array(
            'user_id' => $userid,
            'business_profile_post_id' => $post_id,
            'comments' => $post_comment,
            'created_date' => date('Y-m-d', time()),
            'status' => 1,
            'is_delete' => 0
        );



        $insert_id = $this->common->insert_data_getid($data, 'business_profile_post_comment');

        $contition_array = array('business_profile_post_id' => $_POST["post_id"], 'status' => '1');
        $businessprofiledata = $this->data['businessprofiledata'] = $this->common->select_data_by_condition('business_profile_post_comment', $contition_array, $data = '*', $sortby = 'business_profile_post_comment_id', $orderby = 'DESC', $limit = '1', $offset = '', $join_str = array(), $groupby = '');
        //echo "<pre>"; print_r($businessprofiledata); die();
// khyati changes start
        $cmtinsert = '<div class="insertcomment' . $post_id . '">';
        foreach ($businessprofiledata as $business_profile) {

            $company_name = $this->db->get_where('business_profile', array('user_id' => $business_profile['user_id']))->row()->company_name;

            $business_userimage = $this->db->get_where('business_profile', array('user_id' => $business_profile['user_id'], 'status' => 1))->row()->business_user_image;

            // $cmtinsert = '<div class="all-comment-comment-box">';
            $cmtinsert .= '<div class="post-design-pro-comment-img">';


            $cmtinsert .= '<img  src="' . base_url(USERIMAGE . $business_userimage) . '" alt="">  </div>';

            $cmtinsert .= '<div class="comment-name"><b>' . $company_name . '</b>';
            $cmtinsert .= '</div>';
            $cmtinsert .= '<div class="comment-details" id= "showcomment' . $business_profile['business_profile_post_comment_id'] . '"" >';
            $cmtinsert .= $business_profile['comments'];
            $cmtinsert .= '</div>';
            $cmtinsert .= '<input type="text" name="' . $business_profile['business_profile_post_comment_id'] . '" id="editcomment' . $business_profile['business_profile_post_comment_id'] . '"style="display:none;" value="' . $business_profile['comments'] . ' " onClick="commentedit(this.name)">';
            $cmtinsert .= '<button id="editsubmit' . $business_profile['business_profile_post_comment_id'] . '" style="display:none;" onClick="edit_comment(' . $business_profile['business_profile_post_comment_id'] . ')">Comment</button><div class="art-comment-menu-design"> <div class="comment-details-menu" id="likecomment1' . $business_profile['business_profile_post_comment_id'] . '">';

            $cmtinsert .= '<a id="' . $business_profile['business_profile_post_comment_id'] . '"';
            $cmtinsert .= 'onClick="comment_like1(this.id)">';

            $userid = $this->session->userdata('aileenuser');
            $contition_array = array('business_profile_post_comment_id' => $business_profile['business_profile_post_comment_id'], 'status' => '1');
            $businesscommentlike = $this->data['businesscommentlike'] = $this->common->select_data_by_condition('business_profile_post_comment', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
            $likeuserarray = explode(',', $businesscommentlike[0]['business_comment_like_user']);

            if (!in_array($userid, $likeuserarray)) {


                $cmtinsert .= '<i class="fa fa-thumbs-o-up fa-1x" aria-hidden="true"></i>';
            } else {
                $cmtinsert .= '<i class="fa fa-thumbs-up" aria-hidden="true"></i>';
            }


            $cmtinsert .= '<span>';
            if ($business_profile['business_comment_likes_count'] > 0) {
                $cmtinsert .= '' . $business_profile['business_comment_likes_count'];
            }
            $cmtinsert .= '</span>';
            $cmtinsert .= '</a></div>';


            $userid = $this->session->userdata('aileenuser');
            if ($business_profile['user_id'] == $userid) {

                $cmtinsert .= '<span role="presentation" aria-hidden="true"> · </span>';
                $cmtinsert .= '<div class="comment-details-menu">';


                $cmtinsert .= '<div id="editcommentbox' . $business_profile['business_profile_post_comment_id'] . '"style="display:block;">';

                $cmtinsert .= '<a id="' . $business_profile['business_profile_post_comment_id'] . '"';
                $cmtinsert .= 'onClick="comment_editbox(this.id)">';
                $cmtinsert .= 'Edit';
                $cmtinsert .= '</a></div>';

                $cmtinsert .= '<div id="editcancle' . $business_profile['business_profile_post_comment_id'] . '"style="display:none;">';

                $cmtinsert .= '<a id="' . $business_profile['business_profile_post_comment_id'] . '"';
                $cmtinsert .= 'onClick="comment_editcancle(this.id)">';
                $cmtinsert .= 'Cancel';
                $cmtinsert .= '</a></div>';

                $cmtinsert .= '</div>';
            }




            $userid = $this->session->userdata('aileenuser');

            $business_userid = $this->db->get_where('business_profile_post', array('business_profile_post_id' => $business_profile['business_profile_post_id'], 'status' => 1))->row()->user_id;


            if ($business_profile['user_id'] == $userid || $business_userid == $userid) {

                $cmtinsert .= '<span role="presentation" aria-hidden="true"> · </span>';
                $cmtinsert .= '<div class="comment-details-menu">';
                $cmtinsert .= '<input type="hidden" name="post_delete"';
                $cmtinsert .= 'id="post_delete"';
                $cmtinsert .= 'value= "' . $business_profile['business_profile_post_id'] . '">';
                $cmtinsert .= '<a id="' . $business_profile['business_profile_post_comment_id'] . '"';
                $cmtinsert .= 'onClick="comment_delete(this.id)">';
                $cmtinsert .= 'Delete';
                $cmtinsert .= '</a></div>';
            }

            $cmtinsert .= '<span role="presentation" aria-hidden="true"> · </span>';
            $cmtinsert .= '<div class="comment-details-menu">';
            $cmtinsert .= '<p>' . $business_profile['created_date'] . '</p></div></div>';


            // comment aount variable start
            $idpost = $business_profile['business_profile_post_id'];
            $cmtcount = '<a onClick="commentall(this.id)" id="' . $idpost . '">';
            $cmtcount .= '<i class="fa fa-comment-o" aria-hidden="true">';
            $cmtcount .= ' ' . count($businessprofiledata) . '';
            $cmtcount .= '</i></a>';

            // comment count variable end 
        }

        echo $cmtinsert;

        // khyati chande 
    }

    public function pndelete_commenttwo() {
        $userid = $this->session->userdata('aileenuser');
        $post_id = $_POST["post_id"];
        $post_delete = $_POST["post_delete"];

        $data = array(
            'status' => 0,
        );
        $updatdata = $this->common->update_data($data, 'business_profile_post_comment', 'business_profile_post_comment_id', $post_id);


        $contition_array = array('business_profile_post_id' => $post_delete, 'status' => '1');
        $businessprofiledata = $this->data['businessprofiledata'] = $this->common->select_data_by_condition('business_profile_post_comment', $contition_array, $data = '*', $sortby = 'business_profile_post_comment_id', $orderby = 'DESC', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        // echo '<pre>'; print_r($businessprofiledata); die();
// khyati changes start

        foreach ($businessprofiledata as $business_profile) {

            $companyname = $this->db->get_where('business_profile', array('user_id' => $business_profile['user_id']))->row()->company_name;

            $business_userimage = $this->db->get_where('business_profile', array('user_id' => $business_profile['user_id'], 'status' => 1))->row()->business_user_image;

            $cmtinsert .= '<div class="post-design-pro-comment-img">';
            $cmtinsert .= '<img  src="' . base_url(USERIMAGE . $business_userimage) . '" alt="">  </div>';
            $cmtinsert .= '<div class="comment-name"><b>' . $companyname . '</b>';
            $cmtinsert .= '</div>';
            $cmtinsert .= '<div class="comment-details" id= "showcommenttwo' . $business_profile['business_profile_post_comment_id'] . '">';
            $cmtinsert .= $business_profile['comments'];
            $cmtinsert .= '</div>';
            $cmtinsert .= '<input type="text" name="' . $business_profile['business_profile_post_comment_id'] . '" id="editcommenttwo' . $business_profile['business_profile_post_comment_id'] . '"style="display:none;" value="' . $business_profile['comments'] . ' " onClick="commentedittwo(this.name)">';
            $cmtinsert .= '<button id="editsubmittwo' . $business_profile['business_profile_post_comment_id'] . '" style="display:none;" onClick="edit_commenttwo(' . $business_profile['business_profile_post_comment_id'] . ')">Comment</button><div class="art-comment-menu-design"> <div class="comment-details-menu" id="likecomment1' . $business_profile['business_profile_post_comment_id'] . '">';

            $cmtinsert .= '<a id="' . $business_profile['business_profile_post_comment_id'] . '"';
            $cmtinsert .= 'onClick="comment_like1(this.id)">';

            $userid = $this->session->userdata('aileenuser');
            $contition_array = array('business_profile_post_comment_id' => $business_profile['business_profile_post_comment_id'], 'status' => '1');
            $businesscommentlike = $this->data['businesscommentlike'] = $this->common->select_data_by_condition('business_profile_post_comment', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
            $likeuserarray = explode(',', $businesscommentlike[0]['business_comment_like_user']);

            if (!in_array($userid, $likeuserarray)) {


                $cmtinsert .= '<i class="fa fa-thumbs-o-up fa-1x" aria-hidden="true"></i>';
            } else {
                $cmtinsert .= '<i class="fa fa-thumbs-up" aria-hidden="true"></i>';
            }


            $cmtinsert .= '<span>';
            if ($business_profile['business_comment_likes_count'] > 0) {
                $cmtinsert .= '' . $business_profile['business_comment_likes_count'];
            }
            $cmtinsert .= '</span>';
            $cmtinsert .= '</a></div>';


            $userid = $this->session->userdata('aileenuser');
            if ($business_profile['user_id'] == $userid) {

                $cmtinsert .= '<span role="presentation" aria-hidden="true"> · </span>';
                $cmtinsert .= '<div class="comment-details-menu">';


                $cmtinsert .= '<div id="editcommentboxtwo' . $business_profile['business_profile_post_comment_id'] . '"style="display:block;">';

                $cmtinsert .= '<a id="' . $business_profile['business_profile_post_comment_id'] . '"';
                $cmtinsert .= 'onClick="comment_editboxtwo(this.id)">';
                $cmtinsert .= 'Edit';
                $cmtinsert .= '</a></div>';

                $cmtinsert .= '<div id="editcancletwo' . $business_profile['business_profile_post_comment_id'] . '"style="display:none;">';

                $cmtinsert .= '<a id="' . $business_profile['business_profile_post_comment_id'] . '"';
                $cmtinsert .= 'onClick="comment_editcancletwo(this.id)">';
                $cmtinsert .= 'Cancel';
                $cmtinsert .= '</a></div>';

                $cmtinsert .= '</div>';
            }




            $userid = $this->session->userdata('aileenuser');

            $business_userid = $this->db->get_where('business_profile_post', array('business_profile_post_id' => $business_profile['business_profile_post_id'], 'status' => 1))->row()->user_id;


            if ($business_profile['user_id'] == $userid || $business_userid == $userid) {

                $cmtinsert .= '<span role="presentation" aria-hidden="true"> · </span>';
                $cmtinsert .= '<div class="comment-details-menu">';


                $cmtinsert .= '<input type="hidden" name="post_deletetwo"';
                $cmtinsert .= 'id="post_deletetwo"';
                $cmtinsert .= 'value= "' . $business_profile['business_profile_post_id'] . '">';
                $cmtinsert .= '<a id="' . $business_profile['business_profile_post_comment_id'] . '"';
                $cmtinsert .= 'onClick="comment_deletetwo(this.id)">';
                $cmtinsert .= 'Delete';
                $cmtinsert .= '</a></div>';
            }

            $cmtinsert .= '<span role="presentation" aria-hidden="true"> · </span>';
            $cmtinsert .= '<div class="comment-details-menu">';
            $cmtinsert .= '<p>' . $business_profile['created_date'] . '</p></div></div>';
            // comment aount variable start
            $idpost = $business_profile['business_profile_post_id'];
            $cmtcount = '<a onClick="commentall1(this.id)" id="' . $idpost . '">';
            $cmtcount .= '<i class="fa fa-comment-o" aria-hidden="true">';
            $cmtcount .= ' ' . count($businessprofiledata) . '';
            $cmtcount .= '</i></a>';

            // comment count variable end 
        }
        echo json_encode(
                array("comment" => $cmtinsert,
                    "count" => $cmtcount));
    }

    public function pnmulimagefourcomment() {

        $postid = $_POST['bus_img_id'];

        $mulimgfour .= '<div class="insertcommenttwo' . $postid . '">';

        $contition_array = array('post_image_id' => $postid, 'is_delete' => '0');
        $busmulimage1 = $this->common->select_data_by_condition('bus_post_image_comment', $contition_array, $data = '*', $sortby = 'post_image_comment_id', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');



        if ($busmulimage1) {
            foreach ($busmulimage1 as $rowdata) {
                $companyname = $this->db->get_where('business_profile', array('user_id' => $rowdata['user_id']))->row()->company_name;


                $mulimgfour .= '<div class="all-comment-comment-box">';

                $mulimgfour .= '<div class="post-design-pro-comment-img">';

                $business_userimage = $this->db->get_where('business_profile', array('user_id' => $rowdata['user_id'], 'status' => 1))->row()->business_user_image;


                $mulimgfour .= '<img  src="' . base_url(USERIMAGE . $business_userimage) . '"  alt=""></div>';
                $mulimgfour .= '<div class="comment-name"><b>';
                $mulimgfour .= '' . ucwords($companyname) . '</br></b></div>';
                $mulimgfour .= '<div class="comment-details" id="imgshowcommenttwo' . $rowdata['post_image_comment_id'] . '" style="display: block;">';


                $mulimgfour .= '' . $rowdata['comment'] . '</br></div>';

                $mulimgfour .= '<div class="col-md-12"><div class="col-md-10">';
                $mulimgfour .= '<input type="text" name="' . $rowdata['post_image_comment_id'] . '" id="imgeditcommenttwo' . $rowdata['post_image_comment_id'] . '" style="display: none;" value="' . $rowdata['comment'] . '" onClick="imgcommentedittwo(this.name)">';

                $mulimgfour .= '</div><div class="col-md-2 comment-edit-button">';
                $mulimgfour .= '<button id="imgeditsubmittwo' . $rowdata['post_image_comment_id'] . '" style="display:none" onClick="imgedit_commenttwo(' . $rowdata['post_image_comment_id'] . ')">Comment</button></div>';

                $mulimgfour .= '</div>';
                $mulimgfour .= '<div class="comment-details-menu" id="imglikecomment1' . $rowdata['post_image_comment_id'] . '">';

                $mulimgfour .= '<a id="' . $rowdata['post_image_comment_id'] . '"   onClick="imgcomment_liketwo(this.id)">';

                $userid = $this->session->userdata('aileenuser');
                $contition_array = array('post_image_comment_id' => $rowdata['post_image_comment_id'], 'user_id' => $userid, 'is_unlike' => 0);

                $businesscommentlike2 = $this->common->select_data_by_condition('bus_comment_image_like', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
                //echo "<pre>"; print_r($businesscommentlike); 
                //echo count($businesscommentlike); 
                if (count($businesscommentlike2) == 0) {
                    $mulimgfour .= '<i class="fa fa-thumbs-o-up fa-1x" aria-hidden="true"></i>';
                } else {
                    $mulimgfour .= '<i class="fa fa-thumbs-up" aria-hidden="true"></i>';
                }
                $mulimgfour .= '<span>';

                $contition_array = array('post_image_comment_id' => $rowdata['post_image_comment_id'], 'is_unlike' => '0');
                $mulcountlike1 = $this->data['mulcountlike'] = $this->common->select_data_by_condition('bus_comment_image_like', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

                if (count($mulcountlike1) > 0) {
                    echo count($mulcountlike1);
                }


                $mulimgfour .= '</span></a></div>';


                $userid = $this->session->userdata('aileenuser');
                if ($rowdata['user_id'] == $userid) {

                    $mulimgfour .= '<div class="comment-details-menu">';

                    $mulimgfour .= '<div id="imgeditcommentboxtwo' . $rowdata['post_image_comment_id'] . '" style="display:block;">';
                    $mulimgfour .= '<a id="' . $rowdata['post_image_comment_id'] . '"   onClick="imgcomment_editboxtwo(this.id)" class="editbox">Edit</a></div>';

                    $mulimgfour .= '<div id="imgeditcancletwo' . $rowdata['post_image_comment_id'] . '" style="display:none;">';
                    $mulimgfour .= '<a id="' . $rowdata['post_image_comment_id'] . '" onClick="imgcomment_editcancletwo(this.id)">Cancel</a></div>';

                    $mulimgfour .= '</div>';
                }


                $userid = $this->session->userdata('aileenuser');

                $business_userid = $this->db->get_where('business_profile_post', array('business_profile_post_id' => $rowdata['post_image_id'], 'status' => 1))->row()->user_id;

                if ($rowdata['user_id'] == $userid || $business_userid == $userid) {

                    $mulimgfour .= '<span role="presentation" aria-hidden="true"> · </span>
                                    <div class="comment-details-menu">';
                    $mulimgfour .= '<input type="hidden" name="imgpost_delete1"  id="imgpost_delete1" value= "' . $rowdata['post_image_id'] . '">';
                    $mulimgfour .= '<a id="' . $rowdata['post_image_comment_id'] . '"   onClick="imgcomment_deletetwo(this.id)"> Delete<span class="imginsertcomment1' . $rowdata['post_image_comment_id'] . '"></span></a></div>';
                }


                $mulimgfour .= '<span role="presentation" aria-hidden="true"> · </span>
 <div class="comment-details-menu">';
                $mulimgfour .= '<p>' . date('d-M-Y', strtotime($rowdata['created_date'])) . '</br></p></div></div>';
            }
        }
        $mulimgfour .= '</div>';

        echo $mulimgfour;
    }

    //postnews page controller end
}
