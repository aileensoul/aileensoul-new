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
        $this->recruiter_apply_check();

        $contition_array = array('user_id' => $userid, 're_status' => '0');
        $recdata = $this->common->select_data_by_condition('recruiter', $contition_array, $data = 'rec_id', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        if ($recdata) {
            $this->load->view('recruiter/reactivate', $this->data);
        } else {

            $contition_array = array('user_id' => $userid, 're_status' => '1');
            $recrdata = $this->common->select_data_by_condition('recruiter', $contition_array, $data = 're_step', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

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

        $contition_array = array('user_id' => $userid, 're_status' => '1', 'is_delete' => '0');
        $apply_step = $this->common->select_data_by_condition('recruiter', $contition_array, $data = 're_step', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

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
    
    // recommanded function start
    
     public function recommen_candidate() {

       $this->recruiter_apply_check(); 
       $userid = $this->session->userdata('aileenuser');

         //if user deactive profile then redirect to recruiter/index untill active profile start
  $contition_array = array('user_id'=> $userid,'re_status' => '0','is_delete'=> '0');
  $recruiter_deactive = $this->data['recruiter_deactive'] = $this->common->select_data_by_condition('recruiter', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);

        if($recruiter_deactive)
        {
             redirect('recruiter/');
        }
     //if user deactive profile then redirect to recruiter/index untill active profile End
       // echo $userid;

        $contition_array = array('user_id' => $userid, 'is_delete' => 0, 'status' => 1);
        $recruiterdata = $this->data['recruiterdata'] = $this->common->select_data_by_condition('rec_post', $contition_array, $data = '*', $sortby = '', $orderby = 'DESC', $limit = '', $offset = '', $join_str = array(), $groupby = '');
    
        $contition_array = array('user_id' => $userid, 'is_delete' => 0, 're_status' => 1);
         $this->data['recruiterdata1'] = $this->common->select_data_by_condition('recruiter', $contition_array, $data = '*', $sortby = '', $orderby = 'DESC', $limit = '', $offset = '', $join_str = array(), $groupby = '');


           $contition_array = array('user_id' => $userid,'type' => '4','status' => 1);

      $skillotherdata =  $this->data['skillotherdata'] = $this->common->select_data_by_condition('skill', $contition_array, $data = '*', $sortby = '', $orderby = 'DESC', $limit = '', $offset = '', $join_str = array(), $groupby = '');
// echo "<pre>";
// print_r($skillotherdata); die();       
         $contition_array = array('job_reg.user_id !=' => $userid,'job_step' => 10);

    
        $candidate = $this->data['candidate'] = $this->common->select_data_by_condition('job_reg', $contition_array, $data = 'keyskill,job_id,user_id', $sortby = '', $orderby = 'desc', $limit = '', $offset = '', $join_str = array(), $groupby = '');

         foreach($skillotherdata as $othrd){


    //echo "<pre>"; print_r($othrd['skill']);
        if ($othrd['skill'] != '') {
            
        $contition_array1 = array('type'=>'3','FIND_IN_SET("'.$othrd['skill'].'",skill)!='=>'0'); 
 // echo "<pre>"; print_r($contition_array1); 


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

            $contition_array = array('job_reg.user_id' => $ke['user_id'], 'job_reg.is_delete' => 0, 'job_reg.status' => 1,'job_reg.job_step' => 10);
            $jobr11[] = $this->data['jobrec'] = $this->common->select_data_by_condition('job_reg', $contition_array, $data = 'job_reg.*,job_reg.user_id as iduser,job_add_edu.*,job_graduation.*', $sortby = 'job_id', $orderby = 'desc', $limit = '', $offset = '', $join_str1, $groupby = '');
    }       
          
}

          foreach($recruiterdata as $recruiter){

             $recskill = explode(',', $recruiter['post_skill']);

             $recskill = array_filter(array_map('trim', $recskill));

          foreach($candidate as $candi){

            $candiskill = explode(',', $candi['keyskill']);
             $candiskill = array_filter(array_map('trim', $candiskill));
  
             $result1 = array_intersect($recskill, $candiskill);

          if(count($result1) > 0){

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
                
            } 
            elseif (count($jobr) == 0) {
                $unique = $jobr11;
                
            }
            else {
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
    
    // recommanded function end

}
