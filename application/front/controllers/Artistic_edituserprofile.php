<?php if (!defined('BASEPATH'))    exit('No direct script access allowed');


class Artistic_edituserprofile extends MY_Controller {

    public function __construct() 
    {
        parent::__construct();
        $this->load->library('form_validation');
          $this->load->model('email_model'); 

// if ($this->session->userdata('aileensoul_front') == '') {
//             redirect('login', 'refresh');
//         }
        include ('include.php');
    }

    // edit basic information
   		public function index()
    	{
   			 $userid = $this->session->userdata('user_id');
         $contition_array = array( 'user_id' => $userid, 'is_delete' => 0 );
           $this->data['artdata'] = $this->common->select_data_by_condition('art_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
     		$this->load->view('artistic/artistic_edit_basicinfo', $this->data); 
 		  }  
 		

 		public function art_edit_basicinfo_insert()
 		{
 			 $userid = $this->session->userdata('user_id');

       $this->form_validation->set_rules('firstname', 'Please Enter Your Name', 'required');
        $this->form_validation->set_rules('email', 'Please Enter Your EmailId', 'required|valid_email');
        $this->form_validation->set_rules('phoneno', 'Please Enter Your Phonenumber', 'required|numeric|min_length[10]|max_length[11]');

        if ($this->form_validation->run() == FALSE) { 
         $this->load->view('artistic/artistic_edit_basicinfo'); 
         } 
         
           else{ 
                    $data = array(
                  'art_name' => $this->input->post('firstname'),
                	'art_email' => $this->input->post('email'),
                	'art_phnno' => $this->input->post('phoneno'),
                	'modified_date' => date('Y-m-d',time())
            ); 
       
      $updatdata =   $this->common->update_data($data,'art_reg','user_id',$userid);

          if($updatdata){ 
            redirect('artistic_edituserprofile/artistic_edit_address', refresh);
          }else{
             $this->session->flashdata('error','Your data not inserted');
                   redirect('artistic_edituserprofile/artistic_edit_basicinfo', refresh);
          }
        }
 		}
    //end edit basic information

    //start edit address
 		public function artistic_edit_address()
    	{
   			  $userid = $this->session->userdata('user_id');

           $contition_array = array('status' => 1);
        $this->data['countries'] =  $this->common->select_data_by_condition('countries', $contition_array, $data = '*', $sortby = 'country_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');


         $contition_array = array( 'user_id' => $userid, 'is_delete' => 0 );
           $this->data['artdata'] = $this->common->select_data_by_condition('art_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

           //echo "<pre>";print_r($this->data['artdata']);die();
        $this->load->view('artistic/artistic_edit_address',$this->data);
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

 		public function art_edit_address_insert()
 		{
 			 $userid = $this->session->userdata('user_id');

       $this->form_validation->set_rules('country', 'Country', 'required');
            $this->form_validation->set_rules('state', 'State', 'required');
            $this->form_validation->set_rules('city', 'City', 'required');
            $this->form_validation->set_rules('address', 'Address', 'required');
            $this->form_validation->set_rules('pincode', 'Pincode', 'required|numeric');

        if ($this->form_validation->run() == FALSE) { 
         $this->load->view('artistic/artistic_edit_address'); 
         } 
          else{
                    $data = array(
                    'art_country'=> $this->input->post('country'),
                	  'art_state'=> $this->input->post('state'),
               	    'art_city'=> $this->input->post('city'),
                	  'art_address'=> $this->input->post('address'),
                	  'art_pincode'=> $this->input->post('pincode'),
                	  'modified_date' => date('Y-m-d',time())
            ); 
       
      $updatdata =   $this->common->update_data($data,'art_reg','user_id',$userid);

          if($updatdata){ 
            redirect('artistic_edituserprofile/artistic_edit_information', refresh);
          }else{
             $this->session->flashdata('error','Your data not inserted');
                   redirect('artistic_edituserprofile/artistic_edit_address', refresh);
          }
        }
 		}
    //end edit address
    //start edit information

    public function artistic_edit_information(){

        $userid = $this->session->userdata('user_id');
         $contition_array = array( 'user_id' => $userid, 'is_delete' => 0 );
           $this->data['artdata'] = $this->common->select_data_by_condition('art_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

           //echo "<pre>"; print_r($this->data['artdata']);die();
        $this->load->view('artistic/artistic_edit_information',$this->data);
        }

     public function art_edit_information_insert(){
      //echo "hii";die();
             $userid = $this->session->userdata('user_id');
            $this->form_validation->set_rules('artname', 'Art', 'required');
             $this->form_validation->set_rules('Speciality', 'Speciality', 'required');
             $this->form_validation->set_rules('inspire', 'inspiration', 'required');

             if ($this->form_validation->run() == FALSE) { 
                 $this->load->view('artistic/artistic_edit_information'); 
                } 

                else{
                    $data = array(
                    'art_yourart' => $this->input->post('artname'),
                    'art_speciality' => $this->input->post('Speciality'),
                    'art_inspire' => $this->input->post('inspire'),
                    'modified_date' => date('Y-m-d',time())
            ); 
       //echo $data;die();
      $updatdata =   $this->common->update_data($data,'art_reg','user_id',$userid);

          if($updatdata){ 
            redirect('artistic_edituserprofile/artistic_edit_portfolio', refresh);
          }else{
             $this->session->flashdata('error','Your data not inserted');
                   redirect('artistic_edituserprofile/artistic_edit_information', refresh);
          }
        }
    }
//end edit information
    //start edit portfolio
    public function artistic_edit_portfolio(){

        $userid = $this->session->userdata('user_id');
         $contition_array = array( 'user_id' => $userid, 'is_delete' => 0 );
           $artdata = array('result' => $this->common->select_data_by_condition('art_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = ''));
        $this->load->view('artistic/artistic_edit_portfolio',$artdata);
        }

     public function art_edit_portfolio_insert(){
      //echo "hii";die();
             $userid = $this->session->userdata('user_id');
            
                    $data = array(
                    'art_portfolio' => $this->input->post('artportfolio'),
                    'modified_date' => date('Y-m-d',time())
            ); 
       //echo $data;die();
      $updatdata =   $this->common->update_data($data,'art_reg','user_id',$userid);

          if($updatdata){ 
            redirect('artistic_edituserprofile/artistic_edit_skills', refresh);
          }else{
             $this->session->flashdata('error','Your data not inserted');
                   redirect('artistic_edituserprofile/artistic_edit_portfolio', refresh);
          }
    }
//end edit portfolio
    //start edit skills
    public function artistic_edit_skills(){

        $userid = $this->session->userdata('user_id');
         $contition_array = array( 'user_id' => $userid, 'is_delete' => 0 );
           $this->artdata['artdata'] = $userdata=$this->common->select_data_by_condition('art_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        $this->load->view('artistic/artistic_edit_skills', $this->artdata);
        }

     public function art_edit_skills_insert(){
      //echo "hii";die();
             $userid = $this->session->userdata('user_id');
            
              if (empty($_FILES['bestofmine']['name']))
             {
                 $this->form_validation->set_rules('bestofmine', 'Upload bestofmine', 'required');
            //$picture = '';
            }
            else
            {
                $config['upload_path'] = 'uploads/art_images/';
                $config['allowed_types'] = 'jpg|jpeg|png|gif|mp4|3gp|mpeg|mpg|mpe|qt|mov|avi|pdf';
               // $config['file_name'] = $_FILES['picture']['name'];
                $config['file_name'] = $_FILES['bestofmine']['name'];
                $config['max_size'] = '5000000000000000';
                
                //Load upload library and initialize configuration
                $this->load->library('upload',$config);
                $this->upload->initialize($config);
                
                if($this->upload->do_upload('bestofmine'))
                {
                    $uploadData = $this->upload->data();
                    //$picture = $uploadData['file_name']."-".date("Y_m_d H:i:s");
                    $picture = $uploadData['file_name'];

                }
                else
                {
                    $picture = '';
                }
        }

        // if (empty($_FILES['achievmeant']['name']))
        //      {
        //          $this->form_validation->set_rules('achievmeant', 'Upload achievmeant', 'required');
        //     //$picture = '';
        //     }
        //     else
        //     {
        //         $config['upload_path'] = 'uploads/art_images/';
        //         $config['allowed_types'] = 'jpg|jpeg|png|gif|pdf';
        //        // $config['file_name'] = $_FILES['picture']['name'];
        //         $config['file_name'] = $_FILES['achievmeant']['name'];
        //         print_r($config) ;die();
        //         //Load upload library and initialize configuration
        //         $this->load->library('upload',$config);
        //         $this->upload->initialize($config);
                
        //         if($this->upload->do_upload('achievmeant'))
        //         {
        //             $uploadData = $this->upload->data();
        //             //$picture = $uploadData['file_name']."-".date("Y_m_d H:i:s");
        //             $picture_achiev = $uploadData['file_name'];
        //         }
        //         else
        //         {
        //             $picture_achiev = '';
        //         }
        // }


         $achivement_image = "";   
 if(isset($_FILES['achievmeant']['name']) && $_FILES['achievmeant']['name'] != ""){ 
 $tmp_name = $_FILES['achievmeant']['tmp_name'];     
 $path_parts = pathinfo($_FILES["achievmeant"]["name"]);// get file path  
 $achivement_image = basename('abc-'.time().'.'.$path_parts['extension']);  
 $uploads_dir = ARTISTICUPLOAD.$achivement_image; 
 //echo $uploads_dir; die();
 move_uploaded_file($tmp_name, $uploads_dir); 
 } 

                    $data = array(
                    'art_skill' => $this->input->post('skills'),
                    'art_achievement' =>$picture_achiev,
                    'art_bestofmine' =>$picture,
                    'modified_date' => date('Y-m-d',time())
            ); 
          
                    
      $updatdata =   $this->common->update_data($data,'art_reg','user_id',$userid);

          if($data){ 
            redirect('artistic/art_post', refresh);
          }else{
             $this->session->flashdata('error','Your data not inserted');
                   redirect('artistic_edituserprofile/artistic_edit_skills', refresh);
          }
    }
//end edit skills

}