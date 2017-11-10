<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Business_profile_registration extends MY_Controller {

    public $data;

    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->library('user_agent');
        $this->load->model('email_model');
        $this->lang->load('message', 'english');
        $this->load->helper('smiley');
        //AWS access info start
        $this->load->library('S3');
        //AWS access info end

        $userid = $this->session->userdata('aileenuser');
        include ('business_include.php');

        // FIX BUSINESS PROFILE NO POST DATA

        $this->data['no_business_post_html'] = '<div class="art_no_post_avl"><h3>Business Post</h3><div class="art-img-nn"><div class="art_no_post_img"><img src=' . base_url('assets/img/bui-no.png') . '></div><div class="art_no_post_text">No Post Available.</div></div></div>';
        $this->data['no_business_contact_html'] = '<div class="art-img-nn"><div class="art_no_post_img"><img src="' . base_url('assets/img/No_Contact_Request.png') . '"></div><div class="art_no_post_text">No Contacts Available.</div></div>';
    }

    public function index() {
        
    }

    public function business_information() {
        $s3 = new S3(awsAccessKey, awsSecretKey);
        $userid = $this->session->userdata('aileenuser');

        $contition_array = array('user_id' => $userid, 'status' => '0');
        $businessdata = $this->common->select_data_by_condition('business_profile', $contition_array, $data = 'business_profile_id', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
        if ($businessdata) {
            $this->load->view('business_profile/reactivate', $this->data);
        } else {
            $userid = $this->session->userdata('aileenuser');
// GET BUSINESS PROFILE DATA
            $contition_array = array('user_id' => $userid, 'is_deleted' => '0', 'status' => '1');
            $userdata = $this->common->select_data_by_condition('business_profile', $contition_array, $data = 'business_step', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
// GET COUNTRY DATA
            $contition_array = array('status' => 1);
            $this->data['countries'] = $this->common->select_data_by_condition('countries', $contition_array, $data = 'country_id,country_name', $sortby = 'country_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');
// GET STATE DATA
            $contition_array = array('status' => 1);
            $this->data['states'] = $this->common->select_data_by_condition('states', $contition_array, $data = 'state_id,state_name,country_id', $sortby = 'state_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');
// GET CITY DATA
            $contition_array = array('status' => 1);
            $this->data['cities'] = $this->common->select_data_by_condition('cities', $contition_array, $data = 'city_id,city_name,state_id', $sortby = 'city_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');

            if (count($userdata) > 0) {
                if ($userdata[0]['business_step'] == 1) {
                    redirect('business-profile/signup/contact-information', refresh);
                } else if ($userdata[0]['business_step'] == 2) {
                    redirect('business-profile/signup/description', refresh);
                } else if ($userdata[0]['business_step'] == 3) {
                    redirect('business-profile/signup/image', refresh);
                } else if ($userdata[0]['business_step'] == 4) {
                    redirect('business-profile/home', refresh);
                } else if ($userdata[0]['business_step'] == 5) {
                    redirect('business-profile/home', refresh);
                }
            } else {
                //$this->load->view('business_profile/business_info', $this->data);
                $this->load->view('business_profile/ng_business_info', $this->data);
            }
        }
    }

    public function getCountry() {
        $this->load->model('User_model');
        echo json_encode($this->User_model->getCountry());
    }

    public function getStateByCountryId() {

        $this->load->model('User_model');
        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata);
        if ($request->countryId != '') {
            $stateList = $this->User_model->getStateByCountryId($request->countryId->country_id);
            $statearray = array();
            for ($i = 0; $i < count($stateList); $i++) {
                $statearray[] = array('state_id' => $stateList[$i]->state_id, 'state_name' => $stateList[$i]->state_name, 'complete' => 'true');
            }
            echo json_encode($statearray);
        } else {
            echo json_encode(array('status' => 'failure'));
        }
    }

    public function getCityByStateId() {

        $this->load->model('User_model');
        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata);
        if ($request->stateId != '') {
            $cityList = $this->User_model->getCityByStateId($request->stateId->state_id);
            $array = array();
            for ($i = 0; $i < count($cityList); $i++) {
                $array[] = array('city_id' => $cityList[$i]->city_id, 'city_name' => $cityList[$i]->city_name, 'complete' => 'true');
            }
            echo json_encode($array);
        } else {
            echo json_encode(array('status' => 'failure'));
        }
    }

    public function ng_bus_info_insert() {

        $s3 = new S3(awsAccessKey, awsSecretKey);
        $userid = $this->session->userdata('aileenuser');

        $errors = array();
        $data = array();

        // Getting posted data and decodeing json
        $_POST = json_decode(file_get_contents('php://input'), true);

// checking for blank values.
        if (empty($_POST['companyname']))
            $errors['companyname'] = 'Companyname is required.';

        if (empty($_POST['country_id']['country_id']))
            $errors['country'] = 'Country is required.';

        if (empty($_POST['state_id']['state_id']))
            $errors['state'] = 'State is required.';

        if (empty($_POST['business_address']))
            $errors['business_address'] = 'Business address is required.';

        if (!empty($errors)) {
            $data['errors'] = $errors;
        } else {
            $data = array(
                'company_name' => $_POST['companyname'],
                'country' => $_POST['country_id']['country_id'],
                'state' => $_POST['state_id']['state_id'],
                'city' => $_POST['city_id']['city_id'],
                'pincode' => $_POST['pincode'],
                'address' => $_POST['business_address'],
                'user_id' => $userid,
                'business_slug' => $this->setcategory_slug($companyname, 'business_slug', 'business_profile'),
                'created_date' => date('Y-m-d H:i:s', time()),
                'status' => 1,
                'is_deleted' => 0,
                'business_step' => 1
            );
            $insert_id = $this->common->insert_data_getid($data, 'business_profile');
            if ($insert_id) {
                $data['is_success'] = 1;
            } else {
                $data['is_success'] = 0;
            }
        }
// response back.
        echo json_encode($data);
    }

    public function contact_information() {
        $s3 = new S3(awsAccessKey, awsSecretKey);
        $userid = $this->session->userdata('aileenuser');
        $this->business_profile_active_check();
// GET BUSINESS PROFILE DATA
        $contition_array = array('user_id' => $userid, 'is_deleted' => '0', 'status' => '1');
        $userdata = $this->common->select_data_by_condition('business_profile', $contition_array, $data = 'business_step,contact_person,contact_mobile,contact_email,contact_website', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
        if ($userdata) {
            $step = $userdata[0]['business_step'];

            if ($step == 2 || $step > 2 || ($step >= 1 && $step <= 2)) {
                $this->data['contactname1'] = $userdata[0]['contact_person'];
                $this->data['contactmobile1'] = $userdata[0]['contact_mobile'];
                $this->data['contactemail1'] = $userdata[0]['contact_email'];
                $this->data['contactwebsite1'] = $userdata[0]['contact_website'];
            }
        }
        $this->data['title'] = 'Business Profile' . TITLEPOSTFIX;
        $this->load->view('business_profile/ng_contact_info', $this->data);
    }

    public function ng_contact_info_insert() {

        $s3 = new S3(awsAccessKey, awsSecretKey);
        $userid = $this->session->userdata('aileenuser');

        $errors = array();
        $data = array();

        // Getting posted data and decodeing json
        $_POST = json_decode(file_get_contents('php://input'), true);
        
// checking for blank values.
        if (empty($_POST['contactname'])){
            $errors['contactname'] = 'Person name is required.';
        }
        if (empty($_POST['contactmobile'])){
            $errors['contactmobile'] = 'Mobile number is required.';
        }
        elseif(!is_numeric($_POST['contactmobile'])){
            $errors['contactmobile'] = 'Mobile number should be numeric.';
        }
        if (empty($_POST['email'])){
            $errors['email'] = 'Email id is required.';
        }
        
        if (!empty($errors)) {
            $data['errors'] = $errors;
        } else {
            $data = array(
                'contact_person' => $_POST['contactmobile'],
                'contact_mobile' => $_POST['contactmobile'],
                'contact_email' => $_POST['email'],
                'contact_website' => $_POST['contactwebsite'],
                'modified_date' => date('Y-m-d', time()),
                'business_step' => 2
            );
            $updatdata = $this->common->update_data($data, 'business_profile', 'user_id', $userid);
            if ($updatdata) {
                $data['is_success'] = 1;
            } else {
                $data['is_success'] = 0;
            }
        }
// response back.
        echo json_encode($data);
    }

    public function get_company_name($id = '') {
        $s3 = new S3(awsAccessKey, awsSecretKey);
        $contition_array = array('business_slug' => $id, 'is_deleted' => 0, 'status' => 1);
        $businessdata = $this->common->select_data_by_condition('business_profile', $contition_array, $data = 'company_name', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        return $company_name = $businessdata[0]['company_name'];
    }

    public function ajax_business_skill() {
        $s3 = new S3(awsAccessKey, awsSecretKey);
        $term = $_GET['term'];
        $contition_array = array('status' => '1', 'is_deleted' => '0', 'business_step' => 4);
        $search_condition = "(company_name LIKE '" . trim($term) . "%' OR other_industrial LIKE '" . trim($term) . "%' OR other_business_type LIKE '" . trim($term) . "%')";
        $businessdata = $this->data['results'] = $this->common->select_data_by_search('business_profile', $search_condition, $contition_array, $data = 'company_name,other_industrial,other_business_type', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
// GET BUSINESS TYPE
        $contition_array = array('status' => '1', 'is_delete' => '0');
        $search_condition = "(business_name LIKE '" . trim($term) . "%' )";
        $businesstype = $this->data['results'] = $this->common->select_data_by_search('business_type', $search_condition, $contition_array, $data = 'business_name', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
// GET INDUSTRIAL TYPE
        $contition_array = array('status' => '1', 'is_delete' => '0');
        $search_condition = "(industry_name LIKE '" . trim($term) . "%' )";
        $industrytype = $this->data['results'] = $this->common->select_data_by_search('industry_type', $search_condition, $contition_array, $data = 'industry_name', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
// GET PRODUCT
        $contition_array = array('status' => '1', 'is_delete' => '0');
        $search_condition = "(product_name LIKE '" . trim($term) . "%' OR product_description LIKE '" . trim($term) . "%')";
        $productdata = $this->data['results'] = $this->common->select_data_by_search('business_profile_post', $search_condition, $contition_array, $data = 'product_name', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        $unique = array_merge($businessdata, $businesstype, $industrytype, $productdata);
        foreach ($unique as $key => $value) {
            foreach ($value as $ke => $val) {
                if ($val != "") {
                    $result[] = $val;
                }
            }
        }

        $results = array_unique($result);
        foreach ($results as $key => $value) {
            $result1[$key]['value'] = $value;
        }

        echo json_encode($result1);
    }

    public function ajax_location_data() {
        $s3 = new S3(awsAccessKey, awsSecretKey);
        $term = $_GET['term'];
        if (!empty($term)) {
            $contition_array = array('status' => '1', 'state_id !=' => '0');
            $search_condition = "(city_name LIKE '" . trim($term) . "%')";
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

    public function business_home_follow_ignore() {
        $s3 = new S3(awsAccessKey, awsSecretKey);
        $userid = $this->session->userdata('aileenuser');
        $business_profile_id = $this->db->get_where('business_profile', array('user_id' => $userid, 'status' => 1))->row()->business_profile_id;
        $follow_to = $_POST['follow_to'];

        $insert_data['profile'] = '2';
        $insert_data['user_from'] = $business_profile_id;
        $insert_data['user_to'] = $follow_to;

        echo $insert_id = $this->common->insert_data_getid($insert_data, 'user_ignore');
    }

    public function business_profile_active_check() {
        $s3 = new S3(awsAccessKey, awsSecretKey);
        $userid = $this->session->userdata('aileenuser');
        if (!$userid) {
            redirect('login');
        }
        // IF USER DEACTIVE PROFILE THEN REDIRECT TO BUSINESS-PROFILE/INDEX UNTILL ACTIVE PROFILE START

        $contition_array = array('user_id' => $userid, 'status' => '0', 'is_deleted' => '0');
        $business_deactive = $this->data['business_deactive'] = $this->common->select_data_by_condition('business_profile', $contition_array, $data = ' business_profile_id', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby);

        if ($business_deactive) {
            redirect('business-profile');
        }


// IF USER DEACTIVE PROFILE THEN REDIRECT TO BUSINESS-PROFILE/INDEX UNTILL ACTIVE PROFILE END
// DEACTIVATE PROFILE END
    }

    public function is_business_profile_register() {
        $s3 = new S3(awsAccessKey, awsSecretKey);
        $userid = $this->session->userdata('aileenuser');
        $contition_array = array('user_id' => $userid, 'status' => '1', 'is_deleted' => '0');
        $business_check = $this->data['business_deactive'] = $this->common->select_data_by_condition('business_profile', $contition_array, $data = ' business_profile_id,business_step', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby);

        if ($business_check) {

            if ($business_check[0]['business_step'] == 1) {
                redirect('business-profile/contact-information', refresh);
            } else if ($business_check[0]['business_step'] == 2) {
                redirect('business-profile/description', refresh);
            } else if ($business_check[0]['business_step'] == 3) {
                redirect('business-profile/image', refresh);
            }
        } else {
            redirect('business-profile/business-information-update', refresh);
        }

// IF USER DEACTIVE PROFILE THEN REDIRECT TO BUSINESS-PROFILE/INDEX UNTILL ACTIVE PROFILE END
// DEACTIVATE PROFILE END
    }

    // BUSIENSS PROFILE USER FOLLOWING COUNT START

    public function business_user_following_count($business_profile_id = '') {
        $s3 = new S3(awsAccessKey, awsSecretKey);
        $userid = $this->session->userdata('aileenuser');
        if ($business_profile_id == '') {
            $business_profile_id = $this->db->get_where('business_profile', array('user_id' => $userid, 'status' => 1))->row()->business_profile_id;
        }

        $contition_array = array('follow_from' => $business_profile_id, 'follow_status' => '1', 'follow_type' => '2', 'business_profile.status' => 1);

        $join_str_following[0]['table'] = 'follow';
        $join_str_following[0]['join_table_id'] = 'follow.follow_to';
        $join_str_following[0]['from_table_id'] = 'business_profile.business_profile_id';
        $join_str_following[0]['join_type'] = '';

        $bus_user_f_ing_count = $this->common->select_data_by_condition('business_profile', $contition_array, $data = 'count(*) as following_count', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str_following, $groupby = '');

        $following_count = $bus_user_f_ing_count[0]['following_count'];

        return $following_count;
    }

    // BUSIENSS PROFILE USER FOLLOWING COUNT END
    // BUSIENSS PROFILE USER FOLLOWER COUNT START

    public function business_user_follower_count($business_profile_id = '') {
        $s3 = new S3(awsAccessKey, awsSecretKey);
        $userid = $this->session->userdata('aileenuser');
        if ($business_profile_id == '') {
            $business_profile_id = $this->db->get_where('business_profile', array('user_id' => $userid, 'status' => 1))->row()->business_profile_id;
        }

        $contition_array = array('follow_to' => $business_profile_id, 'follow_status' => '1', 'follow_type' => '2', 'business_profile.status' => 1);

        $join_str_following[0]['table'] = 'follow';
        $join_str_following[0]['join_table_id'] = 'follow.follow_from';
        $join_str_following[0]['from_table_id'] = 'business_profile.business_profile_id';
        $join_str_following[0]['join_type'] = '';

        $bus_user_f_er_count = $this->common->select_data_by_condition('business_profile', $contition_array, $data = 'count(*) as follower_count', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str_following, $groupby = '');

        $follower_count = $bus_user_f_er_count[0]['follower_count'];

        return $follower_count;
    }

    // BUSIENSS PROFILE USER FOLLOWER COUNT END
    // 
    public function business_user_contacts_count($business_profile_id = '') {
        $s3 = new S3(awsAccessKey, awsSecretKey);
        $userid = $this->session->userdata('aileenuser');
        if ($business_profile_id != '') {
            $userid = $this->db->get_where('business_profile', array('business_profile_id' => $business_profile_id, 'status' => 1))->row()->user_id;
        }

        $contition_array = array('contact_type' => 2, 'contact_person.status' => 'confirm', 'business_profile.status' => 1);
        $search_condition = "((contact_from_id = ' $userid') OR (contact_to_id = '$userid'))";

        $join_str_contact[0]['table'] = 'business_profile';
        $join_str_contact[0]['join_table_id'] = 'business_profile.user_id';
        $join_str_contact[0]['from_table_id'] = 'contact_person.contact_from_id';
        $join_str_contact[0]['join_type'] = '';

        $contacts_count = $this->common->select_data_by_search('contact_person', $search_condition, $contition_array, $data = 'count(*) as contact_count', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str_contact, $groupby = '');
        $contacts_count = $contacts_count[0]['contact_count'];

        return $contacts_count;
    }

    public function mail_test() {
        $send_email = $this->email_model->test_email($subject = 'This is a testing mail', $templ = '', $to_email = 'ankit.aileensoul@gmail.com');
        //    $send_email = $this->email_model->send_email($subject = 'This is a testing mail', $templ = '', $to_email = 'ankit.aileensoul@gmail.com');
    }

}
