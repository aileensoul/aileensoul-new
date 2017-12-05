<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Message extends MY_Controller {

    public $data;

    public function __construct() {
        parent::__construct();

        $this->load->helper('smiley');

        //AWS access info start
        $this->load->library('S3');
        //AWS access info end
        $this->load->model('business_model');
        $this->load->model('message_model');
        include('business_include.php');
    }

    public function index() {
        $this->load->view('message/index');
    }

    public function business_profile($business_slug = '') {
        $business_profile_id = $this->data['business_login_profile_id'];
        $user_data = $this->business_model->getBusinessDataBySlug($business_slug, $select_data = "business_profile_id,company_name,business_user_image,other_business_type,other_industrial,business_type,industriyal,business_slug");
        $this->data['user_data'] = $user_data;
        if ($user_data['business_type'] != '' || $user_data['business_type'] != 'null') {
            $this->data['user_data']['business_type'] = $this->business_model->getBusinessTypeName($user_data['business_type']);
        }
        if ($user_data['industriyal'] != '' || $user_data['industriyal'] != 'null') {
            $this->data['user_data']['industriyal'] = $this->business_model->getIndustriyalName($user_data['industriyal']);
        }
        $this->data['user_data']['chat'] = $this->message_model->getBusinessChat($business_profile_id, $user_data['business_profile_id']);
        $this->load->view('message/business_profile', $this->data);
    }

    public function getBusinessUserChatList() {
        $business_profile_id = $this->data['business_login_profile_id'];
        $user_data = $this->message_model->getBusinessUserChatList($business_profile_id);
        echo json_encode($user_data);
    }

    public function getBusinessUserChatSearchList() {
        $search_key = $_POST['search_key'];
        $business_profile_id = $this->data['business_login_profile_id'];
        if ($search_key) {
            $user_data = $this->message_model->getBusinessUserChatSearchList($business_profile_id, $search_key);
        } else {
            $user_data = $this->message_model->getBusinessUserChatList($business_profile_id);
        }
        echo json_encode($user_data);
    }

    public function getBusinessUserChat() {
        $business_profile_id = $this->data['business_login_profile_id'];

        $business_slug = $_POST['business_slug'];
        $user_data = $this->business_model->getBusinessDataBySlug($business_slug, $select_data = "business_profile_id,company_name,business_user_image,other_business_type,other_industrial,business_type,industriyal,business_slug");
        if ($user_data['business_type'] != '' || $user_data['business_type'] != 'null') {
            $user_data['business_type'] = $this->business_model->getBusinessTypeName($user_data['business_type']);
        }
        if ($user_data['industriyal'] != '' || $user_data['industriyal'] != 'null') {
            $user_data['industriyal'] = $this->business_model->getIndustriyalName($user_data['industriyal']);
        }
        $user_data['chat'] = $this->message_model->getBusinessChat($business_profile_id, $user_data['business_profile_id']);
        echo json_encode($user_data);
    }

    public function businessSingleMessageInsert() {
        $userid = $this->session->userdata('aileenuser');

        $message = $_POST['message'];
        $message_from = $userid;
        $message_to = $_POST['user_id'];
        $message_from_profile = '5';
        $message_from_profile_id = $this->data['business_login_profile_id'];
        $message_to_profile = '5';
        $message_to_profile_id = $_POST['business_profile_id'];

        $insert_message = $this->message_model->add_message($message, $message_from, $message_to, $message_from_profile, $message_from_profile_id, $message_to_profile, $message_to_profile_id);
        if ($insert_message) {
            echo json_encode(array('result' => 'success'));
        } else {
            echo json_encode(array('result' => 'fail'));
        }
    }

    public function businessMessageInsert() {
        $userid = $this->session->userdata('aileenuser');
        
        $business_slug = $_POST['business_slug'];
        $user_data = $this->business_model->getBusinessDataBySlug($business_slug, $select_data = "business_profile_id,user_id");
        
        $message = $_POST['message'];
        $message_from = $userid;
        $message_to = $user_data['user_id'];
        $message_from_profile = '5';
        $message_from_profile_id = $this->data['business_login_profile_id'];
        $message_to_profile = '5';
        $message_to_profile_id = $user_data['business_profile_id'];
        
        $insert_message = $this->message_model->add_message($message, $message_from, $message_to, $message_from_profile, $message_from_profile_id, $message_to_profile, $message_to_profile_id);
        
        $last_chat = $this->message_model->getBusinessLastMessage($message_from_profile_id, $user_data['business_profile_id']);
        
        if ($insert_message) {
            echo json_encode($last_chat);
        } else {
            echo json_encode(array('result' => 'fail'));
        }
    }

    public function recruiter_profile() {
        $this->load->view('message/recruiter_profile');
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
            //redirect('business-profile/business-information-update', refresh);
            redirect('business-profile/business-information', refresh);
        }

// IF USER DEACTIVE PROFILE THEN REDIRECT TO BUSINESS-PROFILE/INDEX UNTILL ACTIVE PROFILE END
// DEACTIVATE PROFILE END
    }

    // BUSIENSS PROFILE USER FOLLOWING COUNT START

    public function business_user_following_count($business_profile_id = '') {
        $s3 = new S3(awsAccessKey, awsSecretKey);
        $userid = $this->session->userdata('aileenuser');
        if ($business_profile_id == '') {
            $business_profile_id = $this->db->get_where('business_profile', array('user_id' => $userid, 'status' => '1'))->row()->business_profile_id;
        }

        $contition_array = array('follow_from' => $business_profile_id, 'follow_status' => '1', 'follow_type' => '2', 'business_profile.status' => '1', 'business_profile.is_deleted' => '0');

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
            $business_profile_id = $this->db->get_where('business_profile', array('user_id' => $userid, 'status' => '1'))->row()->business_profile_id;
        }

        $contition_array = array('follow_to' => $business_profile_id, 'follow_status' => '1', 'follow_type' => '2', 'business_profile.status' => '1', 'business_profile.is_deleted' => '0');

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
            $userid = $this->db->get_where('business_profile', array('business_profile_id' => $business_profile_id, 'status' => '1'))->row()->user_id;
        }

        $contition_array = array('contact_type' => '2', 'contact_person.status' => 'confirm', 'business_profile.status' => '1', 'business_profile.is_deleted' => '0');
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

    public function business_notification_count($to_id = '') {
        $contition_array = array('not_read' => '2', 'not_to_id' => $to_id, 'not_type !=' => '1', 'not_type !=' => '2');
        $result = $this->common->select_data_by_condition('notification', $contition_array, $data = 'count(*) as total', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        $count = $result[0]['total'];
        return $count;
    }

    public function business_contact_notification_count($to_id = '') {
        $contition_array = array('not_read' => '2');
        $search_condition = "((contact_to_id = '$to_id' AND status = 'pending') OR (contact_from_id = '$to_id' AND status = 'confirm'))";
        $contactperson = $this->common->select_data_by_search('contact_person', $search_condition, $contition_array, $data = 'count(*) as total', $sortby = 'contact_id', $orderby = '', $limit = '', $offset = '', $join_str = '', $groupby = '');

        $contactcount = $contactperson[0]['total'];
        return $contactcount;
    }

}
