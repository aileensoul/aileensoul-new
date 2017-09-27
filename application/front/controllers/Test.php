<?php if (!defined('BASEPATH'))    exit('No direct script access allowed');

class Test extends MY_Controller {

    public $data;

    public function __construct() {
        parent::__construct();
         $this->load->library('form_validation');
// if ($this->session->userdata('aileensoul_front') == '') {
//             redirect('login', 'refresh');
//         }
        
        
        include ('include.php');
        include ('test_include.php');
    }
    
    public function index(){
        
          $contition_array = array('user_id' => $userid, 're_status' => '1');
        $recdata = $this->data['recdata'] = $this->common->select_data_by_condition('recruiter', $contition_array, $data = 're_step,rec_firstname,rec_lastname,rec_email,rec_phone', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        $this->load->view('test/index',$this->data);
    }
    
   public function recruiter_form() { 
         $this->load->view('test/recruiter_form', $this->data);
   }
   public function basic(){
           $userid = $this->session->userdata('aileenuser'); 

//IF USER DEACTIVATE PROFILE THEN REDIRECT TO RECRUITER/INDEX UNTILL ACTIVE PROFILE START
        $contition_array = array('user_id' => $userid, 're_status' => '0', 'is_delete' => '0');
        $recruiter_deactive = $this->data['recruiter_deactive'] = $this->common->select_data_by_condition('recruiter', $contition_array, $data = 'rec_id', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);
        if ($recruiter_deactive) {
            redirect('recruiter/');
        }
//IF USER DEACTIVATE PROFILE THEN REDIRECT TO RECRUITER/INDEX UNTILL ACTIVE PROFILE END


        $contition_array = array('user_id' => $userid, 're_status' => '1');
        $recdata = $this->data['recdata'] = $this->common->select_data_by_condition('recruiter', $contition_array, $data = 're_step,rec_firstname,rec_lastname,rec_email,rec_phone', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        if ($recdata) {
            $step = $recdata[0]['re_step'];
            if ($step == 1 || $step > 1) {
                $this->data['firstname'] = $recdata[0]['rec_firstname'];
                $this->data['lastname'] = $recdata[0]['rec_lastname'];
                $this->data['email'] = $recdata[0]['rec_email'];
                $this->data['phone'] = $recdata[0]['rec_phone'];
            }
        }

        $this->load->view('test/basic', $this->data);
      
   }
   
   public function contact(){  
            $userid = $this->session->userdata('aileenuser');

//IF USER DEACTIVATE PROFILE THEN REDIRECT TO RECRUITER/INDEX UNTILL ACTIVE PROFILE START
        $contition_array = array('user_id' => $userid, 're_status' => '0', 'is_delete' => '0');
        $recruiter_deactive = $this->data['recruiter_deactive'] = $this->common->select_data_by_condition('recruiter', $contition_array, $data = 'rec_id', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);
        if ($recruiter_deactive) {
            redirect('recruiter/');
        }
//IF USER DEACTIVATE PROFILE THEN REDIRECT TO RECRUITER/INDEX UNTILL ACTIVE PROFILE END
// FETCH RECRUITER DATA    
        $contition_array = array('user_id' => $userid, 're_status' => '1', 'is_delete' => '0');
        $recdata = $this->data['recdata'] = $this->common->select_data_by_condition('recruiter', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

// FETCH COUNTRY DATA    
        $contition_array = array('status' => 1);
        $this->data['countries'] = $this->common->select_data_by_condition('countries', $contition_array, $data = 'country_id,country_name', $sortby = 'country_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');

// FETCH STATE DATA  
        $contition_array = array('status' => 1, 'country_id' => $recdata[0]['re_comp_country']);
        $this->data['states'] = $this->common->select_data_by_condition('states', $contition_array, $data = '*', $sortby = 'state_id,state_name,country_id', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');

// FETCH CITY DATA
        $contition_array = array('status' => '1', 'state_id' => $recdata[0]['re_comp_state']);
        $this->data['cities'] = $this->common->select_data_by_condition('cities', $contition_array, $data = '*', $sortby = 'city_name,city_id,state_id', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');


        if ($recdata) {
            $step = $recdata[0]['re_step'];

            if ($step == 3 || $step > 3 || ($step >= 1 && $step <= 3)) {

                $this->data['rec_id'] = $recdata[0]['rec_id'];
                $this->data['compname'] = $recdata[0]['re_comp_name'];
                $this->data['compemail'] = $recdata[0]['re_comp_email'];
                $this->data['compnum'] = $recdata[0]['re_comp_phone'];
                $this->data['compweb'] = $recdata[0]['re_comp_site'];
                $this->data['country1'] = $recdata[0]['re_comp_country'];
                $this->data['state1'] = $recdata[0]['re_comp_state'];
                $this->data['city1'] = $recdata[0]['re_comp_city'];
                $this->data['compsector'] = $recdata[0]['re_comp_sector'];
                $this->data['comp_profile1'] = $recdata[0]['re_comp_profile'];
                $this->data['other_activities1'] = $recdata[0]['re_comp_activities'];
                $this->data['complogo1'] = $recdata[0]['comp_logo'];
            }
        }

        $this->load->view('test/contact', $this->data);
   }
   
   
  
}


