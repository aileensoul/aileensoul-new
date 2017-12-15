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
        include('rec_include.php');
    }

    public function index() {
        $this->load->view('message/index');
    }
    
    public function recruiter_profile($job_slug = '') { 
        $recruiter_profile_id = $recdata[0]['rec_id'];
        $user_data = $this->recruiter_model->getRecruiterDataBySlug($recruiter_slug, $select_data = "rec_id,rec_firstname,rec_lastname,rec_email,re_status,rec_phone,re_comp_name,re_comp_email,re_comp_site,re_comp_country,re_comp_state,re_comp_city,user_id,re_comp_profile,re_comp_sector,	re_comp_activities,re_step,re_comp_phone,recruiter_user_image,profile_background,profile_background_main,designation,comp_logo");
        $this->data['user_data'] = $user_data;
       
//        if ($user_data['business_type'] != '' || $user_data['business_type'] != 'null') {
//            $this->data['user_data']['business_type'] = $this->business_model->getBusinessTypeName($user_data['business_type']);
//        }
//        if ($user_data['industriyal'] != '' || $user_data['industriyal'] != 'null') {
//            $this->data['user_data']['industriyal'] = $this->business_model->getIndustriyalName($user_data['industriyal']);
//        }
        $this->data['user_data']['chat'] = $this->message_model->getRecruiterChat($recruiter_profile_id, $user_data['rec_id']);
        echo '<pre>'; print_r($this->data['user_data']['chat']); die();
        $this->load->view('message/recruiter_profile', $this->data);
    }

}
