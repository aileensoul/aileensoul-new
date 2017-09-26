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
    }
    
    public function index(){
        
          $contition_array = array('user_id' => $userid, 're_status' => '1');
        $recdata = $this->data['recdata'] = $this->common->select_data_by_condition('recruiter', $contition_array, $data = 're_step,rec_firstname,rec_lastname,rec_email,rec_phone', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        $this->load->view('test/index',$this->data);
    }

     public function basic_info(){
            $userid = $this->session->userdata('aileenuser');
   $contition_array = array('user_id' => $userid, 're_status' => '1');
        $recdata = $this->data['recdata'] = $this->common->select_data_by_condition('recruiter', $contition_array, $data = 're_step,rec_firstname,rec_lastname,rec_email,rec_phone', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
      
        $this->load->view('test/basic_info',$this->data);
         
     }
     
    // RECRUITER BASIC INFORMATION INSERT STEP START  
    public function basic_information() { 
//echo 1111; die();
        $userid = $this->session->userdata('aileenuser');

//IF USER DEACTIVATE PROFILE THEN REDIRECT TO RECRUITER/INDEX UNTILL ACTIVE PROFILE START
        $contition_array = array('user_id' => $userid, 're_status' => '0', 'is_delete' => '0');
        $recruiter_deactive = $this->data['recruiter_deactive'] = $this->common->select_data_by_condition('recruiter', $contition_array, $data = 'rec_id', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);
        if ($recruiter_deactive) {
            redirect('recruiter/');
        }
//IF USER DEACTIVATE PROFILE THEN REDIRECT TO RECRUITER/INDEX UNTILL ACTIVE PROFILE END

        $this->form_validation->set_rules('first_name', 'first Name', 'required');
        $this->form_validation->set_rules('last_name', 'last Name', 'required');
        $this->form_validation->set_rules('email', ' EmailId', 'required|valid_email');

        if ($_FILES['file1']['name']) {
            $image = base_url(RECIMAGE . $_FILES["file1"]['name']);
            if (move_uploaded_file($_FILES['file1']['tmp_name'], $image)) {
                $usre1 = $_FILES["file1"]['name'];
            }
        }

        if ($this->form_validation->run() == FALSE) {
            $contition_array = array('user_id' => $userid, 're_status' => '1');
            $recdata = $this->common->select_data_by_condition('recruiter', $contition_array, $data = 'rec_firstname,rec_lastname,rec_email,rec_phone', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

            if ($recdata) {
                $step = $recdata[0]['re_step'];

                if ($step == 1 || $step > 1) {
                    $this->data['firstname'] = $recdata[0]['rec_firstname'];
                    $this->data['lastname'] = $recdata[0]['rec_lastname'];
                    $this->data['email'] = $recdata[0]['rec_email'];
                    $this->data['phone'] = $recdata[0]['rec_phone'];
                }
            }
            $this->load->view('recruiter/rec_basic_information', $this->data);
        } else {
            $contition_array = array('user_id' => $userid, 're_status' => '1');
            $recdata = $this->common->select_data_by_condition('recruiter', $contition_array, $data = 'rec_id,re_step', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

// IF USER AVAILABLE THEN UPDATE DATA START
            
        
            if ($recdata) {  

                $data = array(
                    'rec_firstname' => $this->input->post('first_name'),
                    'rec_lastname' => $this->input->post('last_name'),
                    'rec_email' => $this->input->post('email'),
                    'rec_phone' => $this->input->post('phoneno'),
                    're_status' => 1,
                    'is_delete' => 0,
                    'modify_date' => date('y-m-d h:i:s'),
                    'user_id' => $userid,
                    're_step' => $recdata[0]['re_step']
                );

                $insert_id = $this->common->update_data($data, 'recruiter', 'rec_id', $recdata[0]['rec_id']);

                if ($insert_id) {
                   // $this->session->set_flashdata('success', 'Basic information updated successfully');
                   // redirect('recruiter/company-information', refresh);
                    
                    echo "success";
                } else {
//                    $this->session->flashdata('error', 'Sorry!! Your data not inserted');
//                    redirect('recruiter', refresh);
               echo "fail";
                    }
            } else {
// IF USER NOT AVAILABLE THEN INSERT DATA START               
                $data = array(
                    'rec_firstname' => $this->input->post('first_name'),
                    'rec_lastname' => $this->input->post('last_name'),
                    'rec_email' => $this->input->post('email'),
                    'rec_phone' => $this->input->post('phoneno'),
                    're_status' => 1,
                    'is_delete' => 0,
                    'created_date' => date('y-m-d h:i:s'),
                    'user_id' => $userid,
                    're_step' => 1
                );

                $insert_id = $this->common->insert_data_getid($data, 'recruiter');
                if ($insert_id) {
echo "success";
//                    $this->session->set_flashdata('success', 'Basic information inserted successfully');
//                    redirect('recruiter/company-information', refresh);
                } else {
                    echo "fail";
//                    $this->session->flashdata('error', 'Sorry!! Your data not inserted');
//                    redirect('recruiter', refresh);
                }
            }
        }
    }

// RECRUITER BASIC INFORMATION INSERT STEP END  
   public function recruiter_form() { 
         $this->load->view('test/recruiter_form', $this->data);
   }
   
   public function basic(){
           $userid = $this->session->userdata('aileenuser');
   $contition_array = array('user_id' => $userid, 're_status' => '1');
        $recdata = $this->data['recdata'] = $this->common->select_data_by_condition('recruiter', $contition_array, $data = 're_step,rec_firstname,rec_lastname,rec_email,rec_phone', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
      
        $this->load->view('test/basic_info',$this->data);
   }
}


