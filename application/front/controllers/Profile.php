<?php if (!defined('BASEPATH'))    exit('No direct script access allowed');

class Profile extends CI_Controller {

    public $data;

    public function __construct() {
        parent::__construct();
         $this->load->library('form_validation');
//        if (!$this->session->userdata('user_id')) {
//            redirect('login', 'refresh');
//        }
         $this->load->model('email_model');
        
        include ('include.php');
    }

    public function index() { 

      $userid =  $this->session->userdata('aileenuser');
      $this->data['userdata'] =  $this->common->select_data_by_id('user', 'user_id', $userid, $data = '*', $join_str = array());

      
        $this->load->view('profile/profile', $this->data);
    }

    public function edit_profile() { //echo"tank"; die();
        //echo '<pre>'; echo $id; print_r($_POST); 

       // echo $_FILES['profileimg']['name']; die();
    $id = $this->session->userdata('aileenuser');
      
         
         $contition_array = array( 'user_id' => $id);
      $this->data['userdata'] = $this->common->select_data_by_condition('recruiter', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
    
      

      $this->form_validation->set_rules('first_name', 'first Name', 'required');
        $this->form_validation->set_rules('last_name', 'last Name', 'required');
        $this->form_validation->set_rules('email', ' EmailId', 'required|valid_email');
         $this->form_validation->set_rules('datepicker', ' datepicker', 'required');
     
      $this->form_validation->set_rules('gender', ' gender', 'required');
     


       // if (empty($_FILES['profileimg']['name']))
       //       { //echo"hello"; die();
       //           //echo "falgunifgf"; die();
       //           $this->form_validation->set_rules('profileimg', 'Upload profilepic', 'required');
       //      //$picture = '';
       //      }
            // else
            // { //echo "hii";die();
            //     $config['upload_path'] = 'uploads/user_image/';
            //     $config['allowed_types'] = 'jpg|jpeg|png|gif|mp4|3gp|mpeg|mpg|mpe|qt|mov|avi|pdf';
            //    // $config['file_name'] = $_FILES['picture']['name'];
            //     $config['file_name'] = $_FILES['profilepic']['name'];
            //     //$config['max_size'] = '1000000000000000';
            //     //Load upload library and initialize configuration
            //     $this->load->library('upload',$config);
            //     $this->upload->initialize($config);
                
            //     if($this->upload->do_upload('profileimg'))
            //     {
            //         $uploadData = $this->upload->data();
            //         //$picture = $uploadData['file_name']."-".date("Y_m_d H:i:s");
            //         $picture = $uploadData['file_name'];
            //     }
            //     else
            //     {
            //         $picture = '';
            //     }

            $post_data = $this->input->post();
           // echo "<pre>"; print_r($post_data);
            $dob = str_replace('/', '-', $post_data['datepicker']);
           // echo $dob;die();
            
            $data = array(
                'first_name' => $this->input->post('first_name'),
                'last_name' => $this->input->post('last_name'),
                'user_dob' => date('Y-m-d',strtotime($dob)),
                'user_email' => $this->input->post('email'),
                'user_gender' => $this->input->post('gender')
                //'user_image' => $picture
             );

            
    $updatdata =   $this->common->update_data($data,'user','user_id',$id);

   if($updatdata ){ //echo"falguni"; die();
           
              $this->session->set_flashdata('success', 'Profile information updated successfully');
             redirect('dashboard', 'refresh');
       }else{
                
                $this->session->flashdata('error','Sorry!! Your data not updated');
               redirect('profile', 'refresh');
       }
       
     }

//User email already exist checking controller start

    public function check_email() {

        $email = $this->input->post('email');

        $userid = $this->session->userdata('aileenuser');

        $contition_array = array('user_id' => $userid, 'is_delete' => '0', 'status' => '1');
        $userdata = $this->common->select_data_by_condition('user', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        $email1 = $userdata[0]['user_email'];


        if ($email1) {
            $condition_array = array('is_delete' => '0', 'user_id !=' => $userid, 'status' => '1');

            $check_result = $this->common->check_unique_avalibility('user', 'user_email', $email, '', '', $condition_array);
        } else {

            $condition_array = array('is_delete' => '0', 'status' => '1');

            $check_result = $this->common->check_unique_avalibility('user', 'user_email', $email, '', '', $condition_array);
        }

        if ($check_result) {
            echo 'true';
            die();
        } else {
            echo 'false';
            die();
        }
    }

//User email already exist checking controller End
    

     public function forgot_password() { 
      $forgot_email = $this->input->post('forgot_email'); 


        if ($forgot_email != '') {

            $forgot_email_check = $this->common->select_data_by_id('user', 'user_email', $forgot_email, '*', '');

          //echo '<pre>'; print_r($forgot_email_check); die();
            if (count($forgot_email_check) > 0) {
                
           $rand_password = rand(100000, 999999);
           
         $email= $forgot_email_check[0]['user_email'];
         $username= $forgot_email_check[0]['user_name'];
         $firstname= $forgot_email_check[0]['first_name'];
         $lastname= $forgot_email_check[0]['last_name'];
            
            $toemail= $forgot_email; 
            
           $msg = "Hey !" . $username ."<br/>"; 
           $msg .=  " " . $firstname . " " . $lastname . ",";
           $msg .= "this is your new password..";
           $msg .= "<br>"; 
           $msg .= " " . $rand_password . " "; 
           
          // echo $msg; die();
            $subject = "Forgot password";


   $mail = $this->email_model->do_email($msg, $subject,$toemail,'');
//die();
   $data = array(
                'user_password' => md5($rand_password)
                 );

     
    $updatdata =   $this->common->update_data($data,'user','user_id',$forgot_email_check[0]['user_id']);
             
   
                $this->session->set_flashdata('success', '<div class="alert alert-success">Password successfully send in your email id.</div>');
                redirect('login', 'refresh');
            } else {
             //  echo "2222"; die();
                $this->session->set_flashdata('error', '<div class="alert alert-danger">Please enter register email id.</div>');
                redirect('login', 'refresh');
            }
        } else {
            $this->session->set_flashdata('error', '<div class="alert alert-danger">Please enter email id.</div>');
            redirect('login', 'refresh');
        }
    }



     public function sendEmail($app_name = '', $app_email = '', $to_email = '', $subject = '', $mail_body = '') {
//echo $to_email; die(); 
     //echo "hii"; die();
        //Loading E-mail Class
        $this->load->library('email');

        $emailsetting = $this->common->select_data_by_condition('email_settings', array(), '*');

        $mail_html = '<table width="100%" cellspacing="10" cellpadding="10" style="background:#f1f1f1;" style="border:2px solid #ccc;" >
    <tr>
     <td valign="center"><img src="' . base_url('assets/img/logo.png') . '" alt="' . $this->data['main_site_name'] . '" style="margin:0px auto;display:block;width:150px;"/></td> 
  </tr> 
<tr>
  <td>
     
    <table border="0" cellpadding="0" cellspacing="0" width="100%">
      <p>
                            "' . $mail_body . '"
                        </p>
    </table>
  </td>
</tr>
<table border="0" cellpadding="0" cellspacing="0" width="100%">
     
      <tr>
      <td style="font-family:Ubuntu, sans-serif;font-size:11px; padding-bottom:15px; padding-top:15px; border-top:1px solid #ccc;text-align:center;background:#eee;"> &copy; ' . date("Y") . ' <a href="' . $this->data['main_site_url'] . '" style="color:#268bb9;text-decoration:none;"> ' . $this->data['main_site_name'] . '</a></td>
      </tr>
</table> 
</table>';

        //Loading E-mail Class
        $config['protocol'] = "smtp";
        $config['smtp_host'] = $emailsetting[0]['host_name'];
        $config['smtp_port'] = $emailsetting[0]['out_going_port'];
        $config['smtp_user'] = $emailsetting[0]['user_name'];
        $config['smtp_pass'] = $emailsetting[0]['password'];
        $config['smtp_rec_email'] = $emailsetting[0]['receiver_email'];
        $config['charset'] = "utf-8";
        $config['mailtype'] = "html";
        $config['newline'] = "\r\n";
// echo '<pre>'; print_r($config); die();
        $this->email->initialize($config);
        $this->email->from($config['smtp_user'], $app_name);
        $this->email->to($to_email);

        //    $this->email->cc($cc);

        $this->email->subject($subject);
        $this->email->message(html_entity_decode($mail_body));

        if ($this->email->send()) {
            return true; 
        } else {
            return FALSE; 
        }
    }


     public function login() {
      

        $this->load->view('profile/rec_forgott_password', $this->data);
    }






}