<?php if (!defined('BASEPATH'))    exit('No direct script access allowed');

class Home extends MY_Controller {

    public $data;

    public function __construct() {
        parent::__construct();
         $this->load->library('form_validation');
// if ($this->session->userdata('aileensoul_front') == '') {
//             redirect('login', 'refresh');
//         }
        
        
        include ('include.php');
    }

    

    public function index() {
      
      
        $this->load->view('home/basic_information', $this->data);
    }
    public function basic_information(){

        $userid = ($this->session->userdata['logged_in']['aileenuser']);
        //echo $userid;die();

        $this->form_validation->set_rules('firstname', 'Please Enter Your first Name', 'required');
        $this->form_validation->set_rules('lastname', 'Please Enter Your Last Name', 'required');
        $this->form_validation->set_rules('email', 'Please Enter Your EmailId', 'required|valid_email');
        $this->form_validation->set_rules('phoneno', 'Please Enter Your Phonenumber', 'required|numeric|min_length[10]|max_length[11]');
        //$this->form_validation->set_rules('website', 'Please Enter Your website', 'required');
        

        if (empty($_FILES['image']['name']))
        {
            $this->form_validation->set_rules('image', 'Image', 'required');
        }


        // $config_image=array();
        // $config_image['upload_path'] = './image';
        // $config_image['allowed_types'] = 'jpg/png/gif';
        // $config_image['max_size'] = '1024'; 


        if ($this->form_validation->run() == FALSE) { 
         $this->load->view('home/basic_information'); 
         } 
         else{ 
            $data = array(
                 'user_name' => $this->input->post('firstname'),
                 'last_name' => $this->input->post('lastname'),
                'emailid' => $this->input->post('email'),
                'phone_no' => $this->input->post('phoneno'),
                'website' => $this->input->post('website'),
                'image'=> $this->input->post('image'),
                'user_id'=> $userid 

        ); 
           //echo "<pre>"; print_r($data); die(); 
        $insert_id =   $this->common->insert_data_getid($data,'resume'); 
       if($insert_id){ 
           
                //$this->session->flashdata('success','inserted');
              
             redirect('home/address', refresh);
       }else{
                $this->session->flashdata('error','Sorry!! Your data not inserted');
               redirect('home', refresh);
       }
       //echo $insert_id; die(); $this->load->view('home/basic_information');
         }
    }

     public function address(){ 

        $contition_array = array('status' => 1);
        $this->data['countries'] =  $this->common->select_data_by_condition('countries', $contition_array, $data = '*', $sortby = 'country_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');
         $this->load->view('home/address', $this->data);
    }

     public function ajax_data() { 
      
       if(isset($_POST["country_id"]) && !empty($_POST["country_id"])){ 
    //Get all state data
         $contition_array = array('country_id' => $_POST["country_id"] , 'status' => 1);
     $state =  $this->data['states'] =  $this->common->select_data_by_condition('states', $contition_array, $data = '*', $sortby = 'state_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');
   
    //Count total number of rows
   
    
    //Display states list
    if(count($state) > 0){
        echo '<option value="">Select state</option>';
     foreach($state as $st){
            echo '<option value="'.$st['state_id'].'">'.$st['state_name'].'</option>';
     
        }
    }else{
        echo '<option value="">State not available</option>';
    }
}

if(isset($_POST["state_id"]) && !empty($_POST["state_id"])){
    //Get all city data
     $contition_array = array('state_id' => $_POST["state_id"] , 'status' => 1);
     $city =  $this->data['city'] =  $this->common->select_data_by_condition('cities', $contition_array, $data = '*', $sortby = 'city_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');
    
    
    //Display cities list
    if(count($city) > 0){
        echo '<option value="">Select city</option>';
        foreach($city as $cit){
            echo '<option value="'.$cit['city_id'].'">'.$cit['city_name'].'</option>';
        }
    }else{
        echo '<option value="">City not available</option>';
    }
    }


}

    public function address_insert(){

        $userid = ($this->session->userdata['logged_in']['aileenuser']);
       $this->form_validation->set_rules('address', 'Please Enter Your address', 'required');
        $this->form_validation->set_rules('pincode', 'Please Enter Your pincode', 'required|numeric');

        if ($this->form_validation->run() == FALSE) { 
         $this->load->view('home/address'); 
         } 
         else{
            $data = array(
                'country_id'=> $this->input->post('country'),
                'state_id'=> $this->input->post('state'),
                'city_id'=> $this->input->post('city'),
                'area_id'=> $this->input->post('area'),
                'address'=> $this->input->post('address'),
                'pincode'=> $this->input->post('pincode')
        ); 
          
      $updatdata =   $this->common->update_data($data,'resume','user_id',$userid);
      
      if($updatdata){ 
        redirect('home/keyskills', refresh);
      }else{
         $this->session->flashdata('error','Your data not inserted');
               redirect('home/address', refresh);
      }
    }
}

 public function keyskills(){
        $this->load->view('home/keyskills');
        }

     public function keyskills_insert(){
             $userid = ($this->session->userdata['logged_in']['aileenuser']);
             $this->form_validation->set_rules('keyskills', 'key skills', 'required');
             if ($this->form_validation->run() == FALSE) { 
                 $this->load->view('home/keyskills'); 
                } 
            else{
                    $data = array(
                    'keyskills' => $this->input->post('keyskills')
            ); 
       
      $updatdata =   $this->common->update_data($data,'resume','user_id',$userid);

          if($updatdata){ 
            redirect('home/applyfor', refresh);
          }else{
             $this->session->flashdata('error','Your data not inserted');
                   redirect('home/keyskills', refresh);
          }
        }
    }
     public function applyfor(){
        $this->load->view('home/applyfor');
        }

     public function applyfor_insert(){
             $userid = ($this->session->userdata['logged_in']['aileenuser']);
             $this->form_validation->set_rules('applyfor', 'apply for', 'required');
             if ($this->form_validation->run() == FALSE) { 
                 $this->load->view('home/applyfor'); 
                } 
            else{
                    $data = array(
                    'applyfor' => $this->input->post('applyfor')
            ); 
       
      $updatdata =  $this->common->update_data($data,'resume','user_id',$userid);

          if($updatdata){ 
            redirect('home/work_experince', refresh);
          }else{
             $this->session->flashdata('error','Your data not inserted');
                   redirect('home/applyfor', refresh);
          }
        }
    }


    public function work_experince(){ 
       
         $this->load->view('home/work_experince');
    }

    public function work_insert(){

        $userid = ($this->session->userdata['logged_in']['aileenuser']);
        $this->form_validation->set_rules('jobtitle1', 'Your name', 'required');
        $this->form_validation->set_rules('companyname1', 'Your Company name', 'required');
        $this->form_validation->set_rules('companyemail1', 'Your Company Email', 'required|valid_email');
        $this->form_validation->set_rules('companyphone1', 'Your Company Phone number', 'required');
        $this->form_validation->set_rules('startdate1', 'Your joining date', 'required');
        $this->form_validation->set_rules('enddate1', 'Your leaving date', 'required');
        $this->form_validation->set_rules('ctc', 'Your CTC', 'required|numeric');
        $this->form_validation->set_rules('expectedsal', 'Your Expected Salary', 'required'|'numeric');

        if ($this->form_validation->run() == FALSE) { 
         $this->load->view('home/work_experince'); 
         } 
         else{
            $data = array(
                'jobtitle1' => $this->input->post('jobtitle1'),
                'companyname1' => $this->input->post('companyname1'),
                'companyemail' => $this->input->post('companyemail1'),
                'companyphone' => $this->input->post('companyphone1'),
                'startdate1' => $this->input->post('startdate1'),
                'enddate1'=> $this->input->post('enddate1'),
                'ctc'=> $this->input->post('ctc'),
                'expectedsal'=> $this->input->post('expectedsal'),
                'certificate_work'=> $this->input->post('certificate')
        ); 
       //echo "<pre>"; print_r($data); die();
           
      $updatdata =   $this->common->update_data($data,'resume','user_id',$userid);
      //echo $updatedata;die();

      if($updatdata){ 
        redirect('home/qualification', refresh);
      }else{
         $this->session->flashdata('error','Your data not inserted');
               redirect('home/work_experince', refresh);
      }
    }
}
     public function qualification(){
        $this->load->view('home/qualification');
        }

     public function qualification_insert(){
             $userid = ($this->session->userdata['logged_in']['aileenuser']);
             $this->form_validation->set_rules('qualification', 'Your Qualification', 'required');
             if ($this->form_validation->run() == FALSE) { 
                 $this->load->view('home/qualification'); 
                } 
            else{
                    $data = array(
                    'qualification' => $this->input->post('qualification')
            ); 
       
      $updatdata =   $this->common->update_data($data,'resume','user_id',$userid);

          if($updatdata){ 
            redirect('home/education', refresh);
          }else{
             $this->session->flashdata('error','Your data not inserted');
                   redirect('home/qualification', refresh);
          }
        }
    }

    public function education(){
        $this->load->view('home/education');
        }
    public function education_insert(){ 

         $userid = ($this->session->userdata['logged_in']['aileenuser']);
        // $this->form_validation->set_rules('degree', 'Your Degree', 'required');
         //$this->form_validation->set_rules('stream', 'Your Stream', 'required');
        $this->form_validation->set_rules('univercityname', 'Your Univercity Name', 'required');
        $this->form_validation->set_rules('institutename', 'Your institutename', 'required');
        $this->form_validation->set_rules('yearpassing', 'Your passing year', 'required');
         $this->form_validation->set_rules('grade', 'Your grade', 'required');
        $this->form_validation->set_rules('percentage', 'Your percentage', 'required|numeric');

        if (empty($_FILES['certi_edu']['name']))
        {
            $this->form_validation->set_rules('certi_edu', 'Certificate', 'required');
        }

        if ($this->form_validation->run() == FALSE) { 
         $this->load->view('home/education'); 
         } 
         else{
            $data = array(
                'degree' => $this->input->post('degree'),
                 'stream' => $this->input->post('stream'),
                'univercityname' => $this->input->post('univercityname'),
                'institutename' => $this->input->post('institutename'),
                'yearpassing'=> $this->input->post('yearpassing'),
                'percentage'=> $this->input->post('percentage'),
                 'grade'=> $this->input->post('grade'),
                'certificate_edu'=> $this->input->post('certi_edu')         
        ); 
       //echo "<pre>"; print_r($data); die();
      $updatdata =$this->common->update_data($data,'resume','user_id',$userid);
    
      if($updatdata){ 
            redirect('home/interests', refresh);
      }else{
         $this->session->flashdata('error','Your data not inserted');
               redirect('home/education', refresh);
         }
     }
  }
    public function interests(){
        $this->load->view('home/interests');
        }
    public function interests_insert(){
         $userid = ($this->session->userdata['logged_in']['aileenuser']);
         $this->form_validation->set_rules('interests', 'Your Interests', 'required');
             if ($this->form_validation->run() == FALSE) { 
                 $this->load->view('home/interests'); 
                } 
            else{
                    $data = array(
                    'interests' => $this->input->post('interests')
            ); 
       
      $updatdata =   $this->common->update_data($data,'resume','user_id',$userid);

          if($updatdata){ 
            redirect('home/references', refresh);
          }else{
             $this->session->flashdata('error','Your data not inserted');
                   redirect('home/interests', refresh);
          }
        }
    }

    public function references(){
        $this->load->view('home/references');
        }
    public function references_insert(){
         $userid = ($this->session->userdata['logged_in']['aileenuser']);
         $this->form_validation->set_rules('references', 'References', 'required');
             if ($this->form_validation->run() == FALSE) { 
                 $this->load->view('home/references'); 
                } 
            else{
                    $data = array(
                    'references' => $this->input->post('references'),
                    //'created_date' => $this->input->post('NOW()'),
                    //'status' => $this->input->post(1)
            ); 
       
      $updatdata =   $this->common->update_data($data,'resume','user_id',$userid);

          if($updatdata){ 
            redirect('home/printpreview', refresh);
          }else{
             $this->session->flashdata('error','Your data not inserted');
                   redirect('home/references', refresh);
          }
        }
    }

    public function printpreview(){
         $userid = ($this->session->userdata['logged_in']['aileenuser']);
         $data  = array();
        $this->load->model('common');
        $data['result'] = $this->common->select_resume();
        $this->load->view('home/printpreview', $data);
        }

}


