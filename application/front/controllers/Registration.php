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
    public function index($id = " ") { 
        if ($this->session->userdata('fbuser')) {

            $fbid = $this->session->userdata('fbuser');
            $fbuser = $this->common->select_data_by_id('user', 'user_id', $fbid, '*', '');

            if ($fbuser) {
                //echo '<pre>'; print_r($fbuser); die();
                $this->data['fsname'] = $fbuser[0]['first_name'];
                $this->data['lname'] = $fbuser[0]['last_name'];
                $this->data['gender'] = $fbuser[0]['user_gender'];
                $this->data['email'] = $fbuser[0]['user_email'];
            }
        }


        $user = $this->common->select_data_by_id('user', 'user_id', $id, '*', '');
        if ($user) {
            $this->data['fsname'] = $user[0]['first_name'];
            $this->data['lname'] = $user[0]['last_name'];
            $this->data['gender'] = $user[0]['user_gender'];
        }
        $this->load->view('registration/registration', $this->data);
    }

    public function verify($id = " ") {   //echo $id;die();
        $data = array(
            'user_verify' => '1',
            'modified_date' => date('Y-m-d h:i:s', time())
        );
        //echo "<pre>"; print_r($data); die();

        $updatedata = $this->common->update_data($data, 'user', 'user_id', $id);
        if ($updatedata) {
            $this->session->set_userdata('aileenuser', $id);
            redirect('dashboard', 'refresh');
            // echo "hi";die();
        }
    }

    public function reg_insert() {
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
        $this->form_validation->set_rules('selday', 'date', 'required');
        $this->form_validation->set_rules('selmonth', 'month', 'required');
        $this->form_validation->set_rules('selyear', 'year', 'required');
        $this->form_validation->set_rules('selgen', 'Gender', 'required');

        $contition_array = array('user_email' => $email_reg, 'is_delete' => '0', 'status' => '1');
        $userdata = $this->common->select_data_by_condition('user', $contition_array, $data = 'user_id', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
        if ($userdata) {           
        } else {
            if ($this->form_validation->run() == FALSE) {
                $this->load->view('registration/registration');
            } else {
                $userdata = $this->db->get_where('user', array('user_email' => $email_reg))->row()->user_id;
                if ($userdata) {    
                } else {
                    $data = array(
                        'first_name' => $this->input->post('first_name'),
                        'last_name' => $this->input->post('last_name'),
                        'user_email' => $this->input->post('email_reg'),
                        'user_password' => md5($this->input->post('password_reg')),
                        'user_dob' => $dob,
                        'user_gender' => $this->input->post('selgen'),
                        'user_agree' => '1',
                        'is_delete' => '0',
                        'status' => '1',
                        'created_date' => date('Y-m-d h:i:s', time()),
                        'edit_ip' => $ip,
                        'verify_date' => date('Y-m-d h:i:s', time()),
                        'user_verify' => '0',
                        'user_slider' => '1',
                    );

                    $insert_id = $this->common->insert_data_getid($data, 'user');
                }
                //for getting last insrert id

                if ($insert_id) {
                    $this->session->set_userdata('aileenuser', $insert_id);
                    $datavl = "ok";
                        echo json_encode(
                            array(
                                "okmsg" => $datavl,
                                "userid" => $insert_id,
                               
                    ));

                } else {
                    $this->session->flashdata('error', 'Sorry!! Your data not inserted');
                    redirect('registration', 'refresh');
                }

            }
        }
    }


public function sendmail(){

     $user_id = $_POST['userid'];
                if ($user_id) {
        $contition_array = array('user_id' => $user_id);
        $userdata = $this->common->select_data_by_condition('user', $contition_array, $data = 'user_email,first_name,last_name,user_id,user_gender,user_image', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

                    $gender = $userdata[0]['user_gender'];
                    $toemail = $userdata[0]['user_email'];
                    $fname = $userdata[0]['first_name'];
                    $lname =$userdata[0]['last_name'];
                   
                   $msg = '<tr>
                             <td style="text-align:center; padding-top:15px;">';
                             if ($userdata[0]['user_image']) {
                             $msg .= '<img src="' . base_url($this->config->item('user_thumb_upload_path') . $userdata[0]['user_image']) . '">';
                     } else {

                           if($gender == 'F'){
                                 $msg .= '<img src="' . base_url(FNOIMAGE) . '">';
                            }else{
                                 $msg .= '<img src="' . base_url(MNOIMAGE) . '">';
                            }
                        }
                     $msg .= '</td>
                              </tr>
                            <tr>
                               <td style="text-align:center; padding:10px 0 30px; font-size:15px;">';
                    $msg .= '<p style="margin:0;">Hi,' . ucwords($fname) .' '.ucwords($lname) . '</p>
                            <p style="padding:25px 0 ; margin:0;">Verify your email address.</p>
                             <p><a class="btn" href="' . base_url() . 'registration/verify/' . $user_id . '">Verify</a></p>
                              </td>
                              </tr>';
                              echo "<pre>"; print_r($msg); die();

                    $subject = "Welcome to aileensoul";

                    $mail = $this->email_model->sendEmail($app_name = '', $app_email = '', $toemail, $subject, $msg);

                    //$mail = $this->email_model->do_email($msg, $subject, $toemail, $from);
                }

   
}
 //Show main registratin page insert End
//Registrtaion email already exist checking controller start

    public function check_email() { //echo "hello"; die();
        // if ($this->input->is_ajax_request() && $this->input->post('email')) {
        $email_reg = $this->input->post('email_reg');

        // $userid = $this->session->userdata('aileenuser');

        $contition_array = array('is_delete' => '0', 'status' => '1');
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

        $condition_array = array('is_delete' => '0', 'status' => '1');

        $check_result = $this->common->check_unique_avalibility('user', 'user_email', $email_reg, '', '', $condition_array);

        // }

        if ($check_result) {
            echo 'true';
            die();
        } else {
            echo 'false';
            die();
        }
    }

    //}
//Registrtaion email already exist checking controller End
    // main registratin image insert page Start
    public function registration_image($user_id) {
        //echo $user_id;die();
        $data['user_id'] = $user_id;
        //echo $data['data']; die();
        $this->load->view('registration/registration_image', $data);
    }

    public function reg_image_insert() {
        //echo "<pre>";print_r($_POST);die();
        //form validation rule for registration
        $user_id = $this->input->post('user_id');
        //echo $user_id;
        //$userid = $this->session->userdata('aileenuser');
        //echo $userid; 
        //die();
        $this->form_validation->set_rules('checkbox', 'checkbox', 'required');
        //echo "<pre>"; print_r($_POST); die();
        // echo $userid; die();

        $config['upload_path'] = 'uploads/user_image/';
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        // $config['file_name'] = $_FILES['picture']['name'];
        $config['file_name'] = $_FILES['photo']['name'];

        //Load upload library and initialize configuration
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        //echo $this->upload->do_upload('photo'); die();
        if ($this->upload->do_upload('photo')) {
            //echo "hi";die();
            $uploadData = $this->upload->data();
            //$picture = $uploadData['file_name']."-".date("Y_m_d H:i:s");
            $image = $uploadData['file_name'];
            // echo $certificate;die();
        } else {
            //  echo "welcome";die();
            $image = '';
        }

        if ($this->form_validation->run() == FALSE) {
            // echo "hi";die();
            $this->load->view('registration/registration_image');
        } else {

            $data = array(
                'user_image' => $image,
                'modified_date' => date('Y-m-d h:i:s', time())
            );
            // echo "<pre>"; print_r($data); die();

            $updatedata = $this->common->update_data($data, 'user', 'user_id', $user_id);
            //echo $updatedata;die();

            if ($updatedata) {
                //$this->load->view('job/job_apply_for');
                //$this->session->set_flashdata('success', 'Skill updated successfully'); 
                //redirect('/');
                $this->session->set_userdata('aileenuser', $user_id);
                redirect('dashboard', 'refresh');
            } else {
                $this->session->flashdata('error', 'Your data not inserted');
                redirect('registration/registration_image', 'refresh');
            }
        }
    }

    //main registratin image insert page End
    //User Name Checking with ajax Start
    function filename_exists() {
        $uname = $this->input->post('uname');
        //$exists = $this->common->filename_exists($uname);
        $contition_array = array('user_name' => $uname);
        $result = $this->common->select_data_by_condition('user', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        //echo '<pre>'; print_r($result); 
        $count = count($result);

        if ($count > 0) {

            echo "<span style='color:brown;'>Sorry username already taken !!!</span>";
        } else {

            echo "<span style='color:green;'>Available</span>";
            //echo "Sorry username already taken !!!";
        }
    }

    //User Name Checking with ajax End
//Change Password Controller Start
    public function changepassword() {   
        $this->load->view('registration/changepassword');
    }

    public function changepassword_insert() {    // echo '<pre>'; print_r($_POST); die();
        //$userid = $this->session->userdata('user_id');
        $userid = $this->session->userdata('aileenuser'); //echo $userid; die();
        //$this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
        $this->form_validation->set_rules('oldpassword', 'Old Password', 'required');
        $this->form_validation->set_rules('password1', 'Password', 'trim|required');
        $this->form_validation->set_rules('password2', 'Confirm Password', 'trim|required|matches[password1]');

        $oldpassword = $this->input->post('oldpassword');
        $newpassword = $this->input->post('password1');

        if ($this->form_validation->run() == FALSE) {

            $this->load->view('registration/changepassword');
        } else {
            $contition_array = array(
                'user_id' => $userid,
                'user_password' => md5($oldpassword)
            );
            $result = $this->data['result'] = $this->common->select_data_by_condition('user', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');


            if ($result) {

                if ($result[0]['user_password'] == md5($newpassword)) {
                    $data = array(
                        'error_message1' => 'Your old password and new password are same'
                    );
                    $this->load->view('registration/changepassword', $data);
                } else {
                    $data = array(
                        'user_password' => md5($newpassword)
                    );

                    $updatdata = $this->common->update_data($data, 'user', 'user_id', $userid);
                    if ($updatdata) {

                        redirect('dashboard', 'refresh');
                        $this->session->flashdata('success', 'Update Successfully!!');
                    } else {
                        $this->session->flashdata('error', 'Your Password not Edited');
                        redirect('registration/changepassword', 'refresh');
                    }
                }
            } else {
                $data = array(
                    'error_message1' => 'Your old password does not match'
                );
                $this->load->view('registration/changepassword', $data);
            }
        }
    }

//Change Password Controller End
    // khyati strat

    public function res_mail() {

        $userid = $this->session->userdata('aileenuser');
        $userdata = $this->common->select_data_by_id('user', 'user_id', $userid, $data = '*', $join_str = array());

        $email = $userdata[0]['user_email'];
        $username = $userdata[0]['user_name'];
        $firstname = $userdata[0]['first_name'];
        $lastname = $userdata[0]['last_name'];
         $gender = $userdata[0]['user_gender'];

         $data = array(
                        'user_verify' => '2',
                        'verify_date' => date('Y-m-d', time())
                    );

                    $updatdata = $this->common->update_data($data, 'user', 'user_id', $userid);


        $to_email = $email;
        //echo $toemail; die();


        $msg = '<tr>
              <td style="text-align:center; padding-top:15px;">';
        if ($userdata[0]['user_image']) {
            $msg .= '<img src="' . base_url($this->config->item('user_thumb_upload_path') . $userdata[0]['user_image']) . '">';
        } else {

            if($gender == 'F'){
                                 $msg .= '<img src="' . base_url(FNOIMAGE) . '">';
                            }else{
                                 $msg .= '<img src="' . base_url(MNOIMAGE) . '">';
                            }
        }
        $msg .= '</td>
            </tr>
            <tr>
              <td style="text-align:center; padding:10px 0 30px; font-size:15px;">';
        $msg .= '<p style="margin:0;">Hi,' . ucwords($firstname) . ucwords($lastname) . '</p>
                <p style="padding:25px 0 ; margin:0;">Aileensoul has send you verification mail for verify your account successfully.</p>
                <p><a class="btn" href="' . base_url() . 'registration/verify/' . $userid . '">verify account</a></p>
              </td>
            </tr>';

        // $msg = "Hey !" . $username ."<br/>"; 
        // $msg .=  " " . $firstname . " " . $lastname . ",";
        // $msg .= "Click hear to verify your account";
        // $msg .= "<br>"; 
        // $msg .= "<a href='".base_url()."/registration/verify/" . $userid . "'>click here</a>"; 
        // echo $msg; die();
        $subject = "Aileensoul account verification link";

        $mail = $this->email_model->sendEmail($app_name = '', $app_email = '', $to_email, $subject, $msg);

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



        //  $comapremaill[] = $email; 
        // foreach($comapremaill as $key => $value) { 
        if (strpos($to_email, $allowedgmail) !== false) {

            $usermail = 'https://accounts.google.com/';
        } elseif (strpos($toemail, $allowedyahoo) !== false) {
            $usermail = 'https://login.yahoo.com/';
        } elseif (strpos($toemail, $hotmail) !== false) {
            $usermail = 'https://outlook.live.com/';
        } elseif (strpos($toemail, $outlook) !== false) {
            $usermail = 'https://outlook.live.com/';
        } elseif (strpos($toemail, $rediff) !== false) {
            $usermail = 'https://mypage.rediff.com/login/';
        } elseif (strpos($toemail, $zoho) !== false) {
            $usermail = 'https://www.zoho.com/mail/login.html';
        } elseif (strpos($toemail, $mail) !== false) {
            $usermail = 'https://www.mail.com/int/';
        } elseif (strpos($toemail, $gmx) !== false || strpos($value, $gmx1) !== false) {
            $usermail = 'https://www.gmx.com/';
        } elseif (strpos($toemail, $mailchimp) !== false) {
            $usermail = 'https://login.mailchimp.com/';
        }

        //    }
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

    public function flogin() {
        //echo '<pre>'; print_r($_POST); die();

        if ($this->input->post('id')) {

            $fbid = $this->input->post('id');

            $fbdata = $this->common->select_data_by_id('user', 'fb_id', $fbid, $data = '*', $join_str = array());

            if ($this->input->post('gender') == "female") {
                $gender = "F";
            } else {
                $gender = "M";
            }

            if ($fbdata) {
                $data = array(
                    'fb_id' => $this->input->post('id'),
                    'user_email' => $this->input->post('email'),
                    'first_name' => $this->input->post('first_name'),
                    'last_name' => $this->input->post('last_name'),
                    'user_gender' => $gender,
                    'modified_date' => date('Y-m-d', time())
                );

                $updatdata = $this->common->update_data($data, 'user', 'fb_id', $fbid);

                $this->session->set_userdata('fbuser', $fbdata[0]['user_id']);
            } else {

                $data = array(
                    'fb_id' => $this->input->post('id'),
                    'user_email' => $this->input->post('email'),
                    'first_name' => $this->input->post('first_name'),
                    'last_name' => $this->input->post('last_name'),
                    'user_gender' => $gender,
                    'modified_date' => date('Y-m-d', time())
                );


                $insert_id = $this->common->insert_data_getid($data, 'user');

                $this->session->set_userdata('fbuser', $insert_id);
            }
        }

        echo "yes";
    }

    // login check and email validation start
    public function check_login() {
        $email_login = $this->input->post('email_login');
        $password_login = $this->input->post('password_login');

        $contition_array = array('user_email' => $email_login, 'is_delete' => '0');
        $result = $this->common->select_data_by_condition('user', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        $userinfo = $this->common->check_login($email_login, $password_login);

        //For live link need this code start
        $contition_array = array('user_id' => $userinfo[0]['user_id'], 'is_delete' => 0, 'status' => 1);
        $jobdata = $this->data['jobdata'] = $this->common->select_data_by_condition('job_reg', $contition_array, $data = 'count(*) as total', $sortby = '', $orderby = 'desc', $limit = '', $offset = '', $join_str = array(), $groupby = '');
        $jobuser=$jobdata[0]['total'];
        //For live link need this code End

        if (count($userinfo) > 0) {
            if ($userinfo[0]['status'] == "2") {
                echo 'Sorry, user is Inactive.';
            } else {
                $this->session->set_userdata('aileenuser', $userinfo[0]['user_id']);
                $data = 'ok';
            }
        } else if ($email_login == $result[0]['user_email']) {
            $data = 'password';
            $id = $result[0]['user_id'];
        } else {
            $data = 'email';
        }
        
        echo json_encode(
                array(
                    "data" => $data,
                    "id" => $id,
                    "jobuser"=> $jobuser,
        ));

    }

//login validation end
    
    // login check and email validation start for live link
    public function user_check_login() {
        $email_login = $this->input->post('email_login');
        $password_login = $this->input->post('password_login');

        $contition_array = array('user_email' => $email_login, 'is_delete' => '0');
        $result = $this->common->select_data_by_condition('user', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        $userinfo = $this->common->check_login($email_login, $password_login);
      
        if (count($userinfo) > 0) {
            if ($userinfo[0]['status'] == "2") {
                echo 'Sorry, user is Inactive.';
            } else {
                $this->session->set_userdata('aileenuser', $userinfo[0]['user_id']);
                $is_data = 'ok';
            }
        } else if ($email_login == $result[0]['user_email']) {
            $is_data = 'password';
            $id = $result[0]['user_id'];
        } else {
            $is_data = 'email';
        }
        
        $contition_array = array('user_id' => $userinfo[0]['user_id'], 'is_deleted' => '0', 'status' => 1, 'business_step' => 4);
        $business_result = $this->common->select_data_by_condition('business_profile', $contition_array, $data = 'count(*) as total', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
        
        $business = 0;
        if($business_result[0]['total'] > 0){
            $business = 1;
        }
        
        $contition_array = array('user_id' => $userinfo[0]['user_id'], 'is_delete' => '0', 'status' => 1, 'free_post_step' => 7);
        $free_work_result = $this->common->select_data_by_condition('freelancer_post_reg', $contition_array, $data = 'count(*) as total', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
        
        $free_work = 0;
        if($free_work_result[0]['total'] > 0){
            $free_work = 1;
        }
        
        $contition_array = array('user_id' => $userinfo[0]['user_id'], 'is_delete' => '0', 'status' => 1, 'free_hire_step' => 3);
        $free_hire_result = $this->common->select_data_by_condition('freelancer_hire_reg', $contition_array, $data = 'count(*) as total', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
        
        $free_hire = 0;
        if($free_hire_result[0]['total'] > 0){
            $free_hire = 1;
        }

        $contition_array = array('user_id' => $userinfo[0]['user_id'], 'is_delete' => '0', 'status' => 1, 'art_step' => 4);
        $artistic_result = $this->common->select_data_by_condition('art_reg', $contition_array, $data = 'count(*) as total', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
        
        $artistic = 0;
        if($artistic_result[0]['total'] > 0){
            $artistic = 1;
        }
        
        echo json_encode(
                array(
                    "data" => $is_data,
                    "id" => $id,
                    "is_bussiness" => $business,
                    "is_freelancer_work"=>$free_work,
                    "is_freelancer_hire"=>$free_hire,
                    "is_artistic"=>$artistic
        ));
    }

//login validation end

    // for old password match start

     public function check_password() { 

        $oldpassword = md5($this->input->post('oldpassword'));

        $userid = $this->session->userdata('aileenuser');

        $contition_array = array('is_delete' => '0', 'status' => '1', 'user_id' => $userid);
        $userdata = $this->common->select_data_by_condition('user', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
        //echo "<pre>"; print_r($userdata); die();

        if ($userdata[0]['user_password'] == $oldpassword) {
            echo 'true';
            die();
        } else {
            echo 'false';
            die();
        }
    }

}
