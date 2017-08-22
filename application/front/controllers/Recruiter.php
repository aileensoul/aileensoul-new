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
   echo    $userid = $this->session->userdata('aileenuser');

        

        $contition_array = array('user_id' => $userid, 're_status' => '0');
        $artdata = $this->common->select_data_by_condition('recruiter', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

       echo "<pre>"; print_r($artdata); die();
        
    
    }

}
