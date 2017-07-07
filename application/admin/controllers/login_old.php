<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Login extends CI_Controller {

    public $data;

    public function __construct() {

        parent::__construct();
        if ($this->session->userdata('dollarbid_admin')) {
            redirect('dashboard', 'refresh');
        }

        //set header, footer and leftmenu
        $this->data['title'] = 'Login : Dollorbid';

        $this->load->model('logins');

        //site setting details
        $site_name_values = $this->common->select_data_by_id('settings', 'setting_id', '1', '*');
        $this->data['site_name'] = $site_name = $site_name_values[0]['setting_value'];

        $site_email_values = $this->common->select_data_by_id('settings', 'setting_id', '6', '*');
        $this->data['site_email'] = $site_email = $site_email_values[0]['setting_value'];

        //remove catch so after logout cannot view last visited page if that page is this
        $this->output->set_header('Last-Modified:' . gmdate('D, d M Y H:i:s') . 'GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
        $this->output->set_header('Cache-Control: post-check=0, pre-check=0', false);
        $this->output->set_header('Pragma: no-cache');
    }

    //display Login form
    public function index() {

        $this->load->view('login/index', $this->data);
    }

    //authenticate user
    

     public function authenticate() {

        if ($this->input->post('username')) {
            $user_name = $this->input->post('username');
            $password = $this->input->post('password');

            $auth_result = $this->logins->authenticate_user($user_name, $password);
                      
            if (!empty($auth_result) && $auth_result[0]['setting_id'] > 0) {
                $this->session->set_userdata('dollarbid_admin', $auth_result[0]['setting_id']);
                if ($_SERVER['HTTP_REFERER']) {
                    $this->session->set_flashdata('success', 'You are successfully logged in.');
                    redirect($_SERVER['HTTP_REFERER'], 'refresh');
                } else {
                    $this->session->set_flashdata('success', 'You are successfully logged in.');
                    redirect('dashboard', 'refresh');
                }
            } else {
                $this->session->set_flashdata('error', 'Username or password is wrong. Please try again!');
                redirect('login', 'refresh');
            }
        } else {
            redirect(site_url(), 'refresh');
        }
    }

    
    public function forgotpassword() {
        if ($this->input->post('email')) {
            $email = $this->input->post('email');
            $contition_array = array('email' => $email, 'level != ' => '4');
            $check_result = $this->common->select_data_by_condition('user', $contition_array, 'unique_user_id,user_name,name');
            if (!empty($check_result)) {

                $user_link_unique = base64_encode(str_replace(' ', '-', $check_result[0]['user_name']) . ',' . $check_result[0]['unique_user_id']);
                //send reset email
                $email_formate = $this->common->select_data_by_id('email_formate', 'id', '1', 'subject,emailformat');

                $site_name = "<a href='" . site_url() . "' title='" . $this->data['site_name'] . "' target='_blank'>" .$this->data['site_name']. "</a>";
                $reset_link = "<a href='" . site_url('login/resetpassword/' . $user_link_unique) . "' title='Reset Password' target='_blank'>" . "Click here" . "</a>";

                $mail_body = str_replace("%name%", $check_result[0]['name'], str_replace("%reset_link%", $reset_link, str_replace("%site_name%", $site_name, stripslashes($email_formate[0]['emailformat']))));
                
                $this->sendEmail($this->data['site_name'], $this->data['site_email'], $email, $email_formate[0]['subject'], $mail_body);

                $this->session->set_flashdata('success', 'Password reset link is successfully sent on your email id.');
                redirect('login', 'refresh');
            } else {
                $this->session->set_flashdata('error', 'Your email id not found.');
                redirect('login', 'refresh');
            }
        } else {
            redirect('login', 'refresh');
        }
    }

    public function resetpassword($user_unique='') {
        if($user_unique==''){
            redirect('login', 'refresh');
        }
        
        $user_unique=  base64_decode($user_unique);
        $user_unique=  explode(',', $user_unique);
        
        $user_name=  str_replace('-', ' ', $user_unique[0]);
        $user_unique_id=$user_unique[1];
        $contition_array=array('user_name'=>$user_name,'unique_user_id'=>$user_unique_id);
        $this->data['user_detail']=  $this->common->select_data_by_condition('user',$contition_array,'user_id');
        $this->load->view('login/resetpassword',  $this->data);
    }
    
    public function updatepassword(){
        if($this->input->post('user_id')){
            $user_id=  str_decrypt($this->input->post('user_id'));
            $update_data=array('password'=>md5($this->input->post('new_pass')));
            $update_result=  $this->common->update_data($update_data,'user','user_id',$user_id);
            if($update_result){
                $this->session->set_flashdata('success','New password successfully updated. Please login using new password.');
                redirect('login','refresh');
            }
            else{
                $this->session->set_flashdata('error','Error Occurred. Try Again!');
                redirect('login','refresh');
            }
        }
        else{
            redirect('login','refresh');
        }
    }

    public function sendEmail($app_name = '', $app_email = '', $to_email = '', $subject = '', $mail_body = '') {
        $this->config->load('email', TRUE);
        $this->cnfemail = $this->config->item('email');

        //Loading E-mail Class
        $this->load->library('email');
        $this->email->initialize($this->cnfemail);

        $this->email->from($app_email, $app_name);

        $this->email->to($to_email);

        $this->email->subject($subject);




        $this->email->message("<table border='0' cellpadding='0' cellspacing='0'><tr><td></td></tr><tr><td>" . $mail_body . "</td></tr></table>");
        $this->email->send();
        return;
    }

    //forgotpass added by asachin forgotpassword already exist
    
    public function forgotpass() {
        if ($this->input->post('email')) {
            
            $email = $this->input->post('email');
            $contition_array = array('email' => $email);
            $check_result = $this->common->select_data_by_condition('users', $contition_array, 'userid,username');
            $newpassword=time() . rand(10, 99);
            
            if (!empty($check_result)) {
                
                $newpassword=time() . rand(10, 99);
                $user_id=$check_result[0]['userid'];
                $user_name=$check_result[0]['username'];

                if ($user_id){
                    $this->load->library('email');
                    
                    //for email setting
                    $this->load->model('emailsettings');
                    $emailsetting = $this->emailsettings->getSettingDetails();
                    //for  setting
                    $this->load->model('settings');
                    $setting = $this->settings->getSettingDetails();
                    
                    
                    $config['protocol'] = "smtp";
                    $config['smtp_host'] = $emailsetting[0]['setting_value'];
                    $config['smtp_port'] = $emailsetting[1]['setting_value'];
                    $config['smtp_user'] = $emailsetting[2]['setting_value'];
                    $config['smtp_pass'] = $emailsetting[3]['setting_value'];
//                    $config['smtp_host'] = "mail.winspirewebsolution.com";
//                    $config['smtp_port'] = "587";
//                    $config['smtp_user'] = "noreply@wwsptech.com";
//                    $config['smtp_pass'] = "reply123";
                    $config['charset'] = "utf-8";
                    $config['mailtype'] = "html";
                    $config['newline'] = "\r\n";

                    $this->email->initialize($config);
                    
                    
                    //for email templating
                    $emailtemplate= $this->common->select_data_by_id('emailtemplate', 'templateid', '1', 'subject,emailformat');

                    $message= str_replace('%name%', $user_name, $emailtemplate[0]['emailformat']);
                    $message= str_replace('%new_password%', $newpassword, $message);
                    $message= str_replace('%site_name%', $setting[0]['setting_value'], $message);

                    $this->email->from($emailsetting[2]['setting_value']);
                    $this->email->to($email);
  
                    $this->email->subject($emailtemplate[0]['subject'].date('Y-m-d H:i:s'));
                    $this->email->message($message);


                    if($this->email->send()){
                        $update_array=array('password'=>  md5($newpassword));
                        $update_result=  $this->common->update_data($update_array,'users','userid',$user_id);
                        
                        $this->session->set_flashdata('success', 'New Password successfully sent on your email id.');
                        redirect('login', 'refresh');
                    }else{
                        $this->session->set_flashdata('error', 'Your email id not correct.');
                        redirect('login', 'refresh');
                    }

            }
           
               
            } else {
                $this->session->set_flashdata('error', 'Your email id not found.');
                redirect('login', 'refresh');
            }
           
            
        } else {
            redirect('login', 'refresh');
        }
    }
}

?>