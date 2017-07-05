<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Registration extends CI_Controller {

    public $data;

    public function __construct() {
        parent::__construct();
         $this->load->library('form_validation');
         $this->load->model('email_model');

         include('include.php');
    }

     //Show main registratin page insert Start
    public function index($id= " ")
    { //  echo $this->data['userid']  = $this->session->userdata('aileenuser'); die();
       if($this->session->userdata('fbuser')){
      
      $fbid  = $this->session->userdata('fbuser');
      $fbuser = $this->common->select_data_by_id('user', 'user_id', $fbid, '*', '');
      
      if($fbuser){
 //echo '<pre>'; print_r($fbuser); die();
          $this->data['fsname'] = $fbuser[0]['first_name'];
          $this->data['lname'] = $fbuser[0]['last_name'];
          $this->data['gender'] = $fbuser[0]['user_gender'];
          $this->data['email'] = $fbuser[0]['user_email'];
       }
      }
       

      $user = $this->common->select_data_by_id('user', 'user_id', $id, '*', '');
       if($user){
      $this->data['fsname'] = $user[0]['first_name'];
      $this->data['lname']  =  $user[0]['last_name'];
      $this->data['gender'] = $user[0]['user_gender'];
     }
     $this->load->view('registration/registration',$this->data); 
    }


     public function verify($id= " ")
    {   //echo $id;die();
              $data = array(
                  'user_verify' => '1',
                  'modified_date' => date('Y-m-d h:i:s',time())
                    ); 
     //echo "<pre>"; print_r($data); die();
           
      $updatedata =  $this->common->update_data($data,'user','user_id',$id);
      if($updatedata){
         $this->session->set_userdata('aileenuser', $id);
                    redirect('dashboard', 'refresh');
        // echo "hi";die();
      }
    }

   
    public function reg_insert()
    {  
//        $bod = $this->input->post('datepicker');
//                $bod = str_replace('/', '-', $bod);

      $date = $this->input->post('selday');
      $month = $this->input->post('selmonth');
      $year = $this->input->post('selyear');
      $email_reg = $this->input->post('email_reg');
      
      $dob = $year . '-' . $month . '-' . $date;
     
       if ($this->session->userdata('fbuser')) {
          $this->session->unset_userdata('fbuser');
       }
        //echo "<pre>";print_r($_POST);die();
        //form validation rule for registration

        $ip = $this->input->ip_address();
        // $this->form_validation->set_rules('uname', 'Username', 'required');
      
        $this->form_validation->set_rules('first_name', 'Firstname', 'required');
        $this->form_validation->set_rules('last_name', 'Lastname', 'required');
        $this->form_validation->set_rules('email_reg', 'Store  email', 'required|valid_email');
        $this->form_validation->set_rules('password_reg', 'Password', 'trim|required');
        // $this->form_validation->set_rules('password2', 'Confirm Password', 'trim|required|matches[password]');
        $this->form_validation->set_rules('selday','date','required'); 
        $this->form_validation->set_rules('selmonth','month','required'); 
        $this->form_validation->set_rules('selyear','year','required'); 
        $this->form_validation->set_rules('selgen', 'Gender', 'required');
     
         
       //  $username=$this->input->post('user');
       
       // if($username != "Available" || $username == " ")
       // {
       //    redirect('registration');  
       //  }

       
        //echo ($this->input->valid_ip($ip)?'Valid':'Not Valid');


         $contition_array = array('user_email' => $email_reg, 'is_delete' => '0' , 'status' => '1');
         $userdata = $this->common->select_data_by_condition('user', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
         if($userdata){

         }else{


        if ($this->form_validation->run() == FALSE) 
        { 
        
         $this->load->view('registration/registration'); 
         } 

         else
         { 
            $data = array(
               //  'user_name' => $this->input->post('uname'),
                 'first_name' => trim($this->input->post('first_name')),
                 'last_name' => trim($this->input->post('last_name')),
                 'user_email' => $this->input->post('email_reg'),
                 'user_password' => md5($this->input->post('password_reg')),
                 'user_dob' => $dob,
                 'user_gender' => $this->input->post('selgen'),
                 'user_agree' => '1',
                 'is_delete' => '0',
                 'status' => '1',
                 'created_date' => date('Y-m-d h:i:s',time()),
                 'edit_ip'=> $ip,
                 'user_last_login'=> date('Y-m-d h:i:s',time()),
                 'user_verify'=> '0'
        ); 
            
            $insert_id = $this->common->insert_data_getid($data,'user'); 
         
        //for getting last insrert id
            $user_id = $this->db->insert_id();
           
           if($user_id){ 


            $email= $this->input->post('email');
            
            $toemail= $this->input->post('email'); 
            $userdata = $this->common->select_data_by_id('user','user_id', $userid, $data = '*', $join_str = array());
               
            $msg = 'Hey !' . " " . $toemail ."<br/>"; 

            $msg .=  $this->input->post('fname') .$this->input->post('lname'). ',';

            $msg .= 'Click hear to verify your account';

            $msg .= "<br>";

            $msg .= "<b><u><a href=" .  base_url('registration/verify/' . $user_id) . ">click here</a></b></u>";

            $msg .= $this->input->post('msg');
            //print_r($msg) ;die();
           
            $subject = "contact message";
          
          
            $mail = $this->email_model->do_email($msg, $subject,$toemail,$from);
           
           
           }
           

           if($insert_id)
        {
             $this->session->set_userdata('aileenuser', $insert_id);
                      // $this->session->set_userdata('aileenusername', $user_check[0]['user_name']);
                    // redirect('dashboard', 'refresh');
             echo "ok";

        }
       else
        {
                $this->session->flashdata('error','Sorry!! Your data not inserted');
               redirect('registration', 'refresh');
        }
      

      }
     }

    }
    //Show main registratin page insert End

//Registrtaion email already exist checking controller start

public function check_email() { //echo "hello"; die();
        // if ($this->input->is_ajax_request() && $this->input->post('email')) {

        $email_reg = $this->input->post('email_reg');

        // $userid = $this->session->userdata('aileenuser');

            $contition_array = array( 'is_delete' => '0' , 'status' => '1');
           $userdata = $this->common->select_data_by_condition('user', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

           //$email1=$userdata[0]['email'];
      
        // if ($this->input->post('business_profile_id')) {
        //   //alert("hi1");
        // $id = $this->input->post('business_profile_id');
        // $check_result = $this->common->check_unique_avalibility('business_profile', 'contact_email', $email, 'business_profile_id', $id, $condition_array);
        // } else {
          //alert("hi");
          //  if($email1)
          //  {
          //      $condition_array = array('is_delete' => '0', 'user_id !=' => $userid);
        
          //     $check_result = $this->common->check_unique_avalibility('job_reg', 'email', $email, '', '', $condition_array);
          //  }
          // else
          // {
       
          $condition_array = array('is_delete' => '0' , 'status' => '1');
        
        $check_result = $this->common->check_unique_avalibility('user', 'user_email', $email_reg, '', '', $condition_array);
     
       // }

        if ($check_result) {
        echo 'true';
        die();
        } else {
        echo 'false';
      
        }
        }
        //}
//Registrtaion email already exist checking controller End


// login check and email validation start
public function check_login() {
        $email_login = $this->input->post('email_login');
        $password_login = $this->input->post('password_login');



        $contition_array = array('user_email' => $email_login);
        $result = $this->common->select_data_by_condition('user', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
            


        $userinfo = $this->common->check_login($email_login, $password_login);

        if (count($userinfo) > 0) {
            if ($userinfo[0]['status'] == "2") {
                echo 'Sorry, user is Inactive.';
            } else {
               // $userinfo[0]['user_id'] = $this->input->post('user_id');
                $this->session->set_userdata('aileenuser', $userinfo[0]['user_id']);
                echo 'ok';
                
            }
        } else if($email_login == $result[0]['user_email']) {
            echo 'password';
        }else{

            echo 'Please enter valid email address';


        }

    }
//login validation end


    // main registratin image insert page Start
    public function registration_image($user_id)
    {
      //echo $user_id;die();
      $data['user_id']=$user_id;
      //echo $data['data']; die();
        $this->load->view('registration/registration_image',$data); 
    }
    public function reg_image_insert()
    {
        //echo "<pre>";print_r($_POST);die();
        //form validation rule for registration
       $user_id= $this->input->post('user_id');
       //echo $user_id;
        //$userid = $this->session->userdata('aileenuser');
        //echo $userid; 
        //die();
        $this->form_validation->set_rules('checkbox','checkbox', 'required');
          //echo "<pre>"; print_r($_POST); die();
       // echo $userid; die();

         $config['upload_path'] = 'uploads/user_image/';
                $config['allowed_types'] = 'jpg|jpeg|png|gif';
               // $config['file_name'] = $_FILES['picture']['name'];
                $config['file_name'] = $_FILES['photo']['name'];
                
                //Load upload library and initialize configuration
                $this->load->library('upload',$config);
                $this->upload->initialize($config);
                //echo $this->upload->do_upload('photo'); die();
                if($this->upload->do_upload('photo'))
                {
                      //echo "hi";die();
                    $uploadData = $this->upload->data();
                    //$picture = $uploadData['file_name']."-".date("Y_m_d H:i:s");
                    $image = $uploadData['file_name'];
                    // echo $certificate;die();
                }
                else
                {
                   //  echo "welcome";die();
                    $image = '';
                }

        if ($this->form_validation->run() == FALSE) 
        { 
           // echo "hi";die();
         $this->load->view('registration/registration_image'); 
         } 

         else
         { 
        
            $data = array(
                  'user_image' => $image,
                  'modified_date' => date('Y-m-d h:i:s',time())
                  
        ); 
      // echo "<pre>"; print_r($data); die();
           
      $updatedata =   $this->common->update_data($data,'user','user_id',$user_id);
      //echo $updatedata;die();

      if($updatedata){ 
         //$this->load->view('job/job_apply_for');
           //$this->session->set_flashdata('success', 'Skill updated successfully'); 
          //redirect('/');
            $this->session->set_userdata('aileenuser', $user_id);
            redirect('dashboard', 'refresh');
      }else{
         $this->session->flashdata('error','Your data not inserted');
               redirect('registration/registration_image', 'refresh');
      }
    }
    
}
    //main registratin image insert page End


    //User Name Checking with ajax Start
    function filename_exists()
        {
         $uname = $this->input->post('uname');
            //$exists = $this->common->filename_exists($uname);
            $contition_array = array('user_name' => $uname);
            $result = $this->common->select_data_by_condition('user', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
            
         //echo '<pre>'; print_r($result); 
           $count = count($result); 

            if ($count>0) {
                
                  echo "<span style='color:brown;'>Sorry username already taken !!!</span>";
                  
            } else {
                 
                echo "<span style='color:green;'>Available</span>";
                //echo "Sorry username already taken !!!";
            }

        }
        //User Name Checking with ajax End

//Change Password Controller Start
        public function changepassword()
        {   //$userid = $this->session->userdata('user_id'); echo $userid; die();
            $this->load->view('registration/changepassword');
        }
        public function changepassword_insert() 
        {    // echo '<pre>'; print_r($_POST); die();
             //$userid = $this->session->userdata('user_id');
              $userid = $this->session->userdata('aileenuser'); //echo $userid; die();
        //$this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
        $this->form_validation->set_rules('oldpassword', 'Old Password', 'required');
        $this->form_validation->set_rules('password1', 'Password', 'trim|required');
        $this->form_validation->set_rules('password2', 'Confirm Password', 'trim|required|matches[password1]');

        $oldpassword = $this->input->post('oldpassword');
        $newpassword = $this->input->post('password1');

        if ($this->form_validation->run() == FALSE) 
        {
                
                $this->load->view('registration/changepassword');
                
        } 
        else 
        {
                $contition_array = array(
                           'user_id' => $userid,
                           'user_password' => md5($oldpassword)
                              ); 
              $result =   $this->data['result'] = $this->common->select_data_by_condition('user', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
                

 if ($result){

                      if($result[0]['user_password'] == md5($newpassword)){ 
                          $data = array(
                                'error_message1' => 'Your old password and new password are same'
                                );
                                $this->load->view('registration/changepassword', $data); 
                     

}else{
                    $data = array(
               'user_password' => md5($newpassword)
                   ); 
                 
                    $updatdata =   $this->common->update_data($data,'user','user_id',$userid);
                    if($updatdata){ 

                        redirect('dashboard', 'refresh');
                        $this->session->flashdata('success','Update Successfully!!');
                    }else{
                        $this->session->flashdata('error','Your Password not Edited');
                        redirect('registration/changepassword', 'refresh');
                        }

                    }
                  
                 
    }else{         $data = array(
                       'error_message1' => 'Your old password does not match'
                         );
                                $this->load->view('registration/changepassword', $data);
                    }


                    
             }
     }
//Change Password Controller End


     // khyati strat

  public function res_mail()
    {
       
          $userid = $this->session->userdata('aileenuser');
          $userdata = $this->common->select_data_by_id('user','user_id', $userid, $data = '*', $join_str = array());

         $email= $userdata[0]['user_email'];
         $username= $userdata[0]['user_name'];
         $firstname= $userdata[0]['first_name'];
         $lastname= $userdata[0]['last_name'];
            
            $toemail= $email; 
            
           $msg = "Hey !" . $username ."<br/>"; 
            $msg .=  " " . $firstname . " " . $lastname . ",";
            $msg .= "Click hear to verify your account";
            $msg .= "<br>"; 
           $msg .= "<a href='".base_url()."/registration/verify/" . $userid . "'>click here</a>"; 
           
          // echo $msg; die();
            $subject = "Aileensoul account verification link";
          
            $mail = $this->email_model->do_email($msg, $subject,$toemail,$from);

           $allowedgmail = 'gmail.com';
           $allowedyahoo = 'yahoo.com';
           $hotmail = 'hotmail.com';
           $outlook = 'outlook.com';
           $rediff = 'rediffmail.com';
           $zoho = 'zoho.com';
           $mail = 'mail.com';
           $gmx = 'gmx.com';
           $gmx1 = 'gmx.us';
           $mailchimp = 'mailchimp.com';
          


          // $comapremaill[] = $email; 
         //foreach($comapremaill as $key => $value) { 
             if (strpos($email, $allowedgmail) !== false) {   
        
                $usermail = 'https://accounts.google.com/';    
               }elseif(strpos($email, $allowedyahoo) !== false){
                 $usermail = 'https://login.yahoo.com/';
               }elseif(strpos($email,$hotmail) !== false){
                 $usermail = 'https://outlook.live.com/';
               } elseif(strpos($email,$outlook) !== false){
                 $usermail = 'https://outlook.live.com/';
               } elseif(strpos($email,$rediff) !== false){
                 $usermail = 'https://mypage.rediff.com/login/';
               } elseif(strpos($email,$zoho) !== false){
                 $usermail = 'https://www.zoho.com/mail/login.html';
               } elseif(strpos($email,$mail) !== false){
                 $usermail = 'https://www.mail.com/int/';
               } elseif(strpos($email,$gmx) !== false || strpos($value,$gmx1) !== false){
                 $usermail = 'https://www.gmx.com/';
               } elseif(strpos($email,$mailchimp) !== false){
                 $usermail = 'https://login.mailchimp.com/';
               }
               
             // }
              echo $usermail; 

          
        }
     
   

     // khjyati end

    // public function mailredirect()
    // { 
    //     redirect('artistic/art_post', 'refresh'); die();

    //   $user_email =  $_POST["user_email"];

    //    $allowedgmail = 'gmail.com';
    //    $allowedyahoo = 'yahoo.com';
    //    $hotmail = 'hotmail.com';
    //    $outlook = 'outlook.com';

    //      $comapremaill[] = $user_email; 
    //      foreach($comapremaill as $key => $value) { 
    //         if (strpos($value, $allowedgmail) !== false) {   
        
    //               $usermail = $allowedgmail;    
    //            } 
               
    //          }
    //          echo $usermail; 

    // }

          public function flogin()
  { 
     //echo '<pre>'; print_r($_POST); die();
  
       if($this->input->post('id')){
         
         $fbid = $this->input->post('id');

$fbdata = $this->common->select_data_by_id('user', 'fb_id', $fbid, $data = '*', $join_str = array());

    if($this->input->post('gender') == "female"){
       $gender = "F";
    }else{
    $gender = "M";
     }

if($fbdata){
                $data = array(
                         
                          'fb_id' => $this->input->post('id'),
                          'user_email' => $this->input->post('email'),
                          'first_name' => $this->input->post('first_name'),
                          'last_name' => $this->input->post('last_name'),
                          'user_gender' => $gender,
                          'modified_date' => date('Y-m-d',time())
                    ); 

                 $updatdata =   $this->common->update_data($data,'user','fb_id',$fbid);

          $this->session->set_userdata('fbuser', $fbdata[0]['user_id']);

}else{

               $data = array(
                         
                          'fb_id' => $this->input->post('id'),
                          'user_email' => $this->input->post('email'),
                          'first_name' => $this->input->post('first_name'),
                          'last_name' => $this->input->post('last_name'),
                          'user_gender' => $gender,
                          'modified_date' => date('Y-m-d',time())
                    );  

           
               $insert_id = $this->common->insert_data_getid($data,'user');
             
             $this->session->set_userdata('fbuser', $insert_id);
              }
        }

        echo "yes";
    }  



}