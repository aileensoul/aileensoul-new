<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Rmessage extends MY_Controller {

    public $data;

    public function __construct() {
        parent::__construct();

        $this->load->helper('smiley');

        //AWS access info start
        $this->load->library('S3');
        //AWS access info end
        $this->load->model('recruiter_model');
        $this->load->model('message_model');
        $this->load->model('rmessage_model');
        include('rec_include.php');
    }

    public function index() {
        $this->load->view('message/index');
    }
    
    public function recruiter_profile($job_slug = '') { 
        $recruiter_profile_id = $this->data['recdata'][0]['rec_id'];  
        $user_data = $this->recruiter_model->getJobDataBySlug($job_slug, $select_data = "job_id,fname,lname,slug,designation");
        $this->data['user_data'] = $user_data;
       
      
//        if ($user_data['business_type'] != '' || $user_data['business_type'] != 'null') {
//            $this->data['user_data']['business_type'] = $this->business_model->getBusinessTypeName($user_data['business_type']);
//        }
//        if ($user_data['industriyal'] != '' || $user_data['industriyal'] != 'null') {
//            $this->data['user_data']['industriyal'] = $this->business_model->getIndustriyalName($user_data['industriyal']);
//        }
        $this->data['user_data']['chat'] = $this->rmessage_model->getJObChat($recruiter_profile_id, $user_data['job_id']);
        $this->load->view('message/recruiter_profile', $this->data);
    }
    
    public function recruiterMessageInsert() {
        $userid = $this->session->userdata('aileenuser');

        $job_slug = $_POST['job_slug'];
//        $user_data = $this->recruiter_model->getBusinessDataBySlug($business_slug, $select_data = "business_profile_id,user_id");
        $user_data = $this->recruiter_model->getJobDataBySlug($job_slug, $select_data = "job_id,user_id");

        $message = $_POST['message'];
        $message_file = '';
        $message_file_type = '';
        $message_file_size = '';
        $message_from = $userid;
        $message_to = $user_data['user_id'];
        $message_from_profile = '2';
        $message_from_profile_id = $this->data['recdata'][0]['rec_id'];
        $message_to_profile = '1';
        $message_to_profile_id = $user_data['job_id'];

        $insert_message = $this->message_model->add_message($message, $message_file, $message_file_type, $message_file_size, $message_from, $message_to, $message_from_profile, $message_from_profile_id, $message_to_profile, $message_to_profile_id);

      //  $last_chat = $this->message_model->getBusinessLastMessage($message_from_profile_id, $user_data['business_profile_id']);
        $last_chat = $this->rmessage_model->getRecruiterLastMessage($message_from_profile_id, $user_data['job_id']);
echo '<pre>'; print_r($last_chat); die();
        if ($insert_message) {
            echo json_encode($last_chat);
        } else {
            echo json_encode(array('result' => 'fail'));
        }
    }

}
