<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Login extends CI_Controller {

    public $data;

    public function __construct() {
        parent::__construct();

        //AWS access info start
        $this->load->library('S3');
        //AWS access info end
        if ($this->session->userdata('aileenuser')) {
            redirect('dashboard', 'refresh');
        }

        $this->load->library('form_validation');
        $this->load->model('logins');
        $this->load->model('email_model');
    }

    public function index() {

        if ($_SERVER['HTTP_REFERER'] == base_url()) {
            $this->data['error_msg'] = $error_msg = $_GET['error_msg'];
        } else {
            $this->data['error_msg'] = $error_msg = 0;
        }
        if($_GET['redirect_url'] != ''){
            $this->data['redirect_url'] = $_GET['redirect_url'];
        }
        if ($this->input->get()) {
            if ($_GET['lwc'] != " ") {
                $emaildata = $this->common->select_data_by_id('user', 'user_id', $_GET['lwc'], $data = 'user_email', $join_str = array());

                $this->data['email'] = $emaildata[0]['user_email'];
                if ($emaildata) {
                    $this->session->set_flashdata('errorpass', '<label for="email_login" class="error">Please enter a valid password.</label>');
                } else {

                    $this->session->set_flashdata('erroremail', '<label for="email_login" class="error">Please enter a valid email address.</label>');
                }
            }
        }


        $this->data['login_footer'] = $this->load->view('login_footer', $this->data, TRUE);
        $this->load->view('login/index', $this->data);
    }

    public function check_login() {

        $para = $_POST['hiddenf'];

        $this->form_validation->set_rules('user_name', 'User name', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        if ($this->form_validation->run() == TRUE) {
            $user_name = $this->input->post('user_name');
            $user_password = $this->input->post('password');
            if ($user_name != '' && $user_password != '') {
                $user_check = $this->logins->check_authentication($user_name, $user_password);

                if ($user_check != 0) {
                    // cookie start

                    if ($this->input->post('remember')) {


                        $this->load->helper('cookie');

                        setcookie('user_name', $_POST['user_name'], time() + (10 * 365 * 24 * 60 * 60), '/');
                        setcookie('password', $_POST['password'], time() + (10 * 365 * 24 * 60 * 60), '/');
                    }

                    $this->session->set_userdata('aileenuser', $user_check[0]['user_id']);
                    redirect('dashboard', 'refresh');
                } else {

                    if ($para == login) {

                        $this->session->set_flashdata('error', '<div class="alert alert-danger">Please Enter Valid Credential.</div>');

                        redirect('login', 'refresh');
                    } else {


                        $this->session->set_flashdata('error', '<div class="alert alert-danger">Please Enter Valid Credential.</div>');
                        redirect('login', 'refresh');
                    }
                }
            }
        } else {
            $this->load->view('Login/index', $this->data);
        }
    }

    public function forgot_password() {

        $forgot_email = $this->input->post('forgot_email');

        if ($forgot_email != '' && $forgot_email != '') {

            $forgot_email_check = $this->common->select_data_by_id('users', 'email', $forgot_email, '*', '');


            if (count($forgot_email_check) > 0) {

                $email_formate = $this->common->select_data_by_id('emails', 'emailid', '2', 'varsubject,varmailformat');
                $rand_passwod = mt_rand(100000, 999999);

                $mail_body = str_replace("%name%", $forgot_email_check[0]['name'], str_replace("%user_email%", $forgot_email_check[0]['email'], str_replace("%password%", $rand_passwod, stripslashes($email_formate[0]['varmailformat']))));

                $send_email = $this->email_model->sendEmail($this->data['main_site_name'], $this->data['main_site_email'], $forgot_email, $email_formate[0]['varsubject'], $mail_body);

                if ($send_email) {
                    $update_array = array(
                        'password' => md5($rand_passwod),
                        'updated_date' => date('Y-m-d H:i:s')
                    );

                    $update_result = $this->common->update_data($update_array, 'users', 'user_id', $forgot_email_check[0]['user_id']);
                }
                $this->session->set_flashdata('success', '<div class="alert alert-success">Password successfully send in your email id.</div>');
                redirect('login', 'refresh');
            } else {

                $this->session->set_flashdata('error', '<div class="alert alert-danger">Please enter register email id.</div>');
                redirect('login', 'refresh');
            }
        } else {
            $this->session->set_flashdata('error', '<div class="alert alert-danger">Please enter email id.</div>');
            redirect('login', 'refresh');
        }
    }

    public function fblogin() {// echo '<pre>'; print_r($_POST); 
        if ($_POST['id'] != " ") {
            $fbid = $_POST['id'];
            $fullname = $_POST['name'];
            $fname = $_POST['first_name'];
            $gender = $_POST['gender'];
            $lname = $_POST['last_name'];

            $user = $this->common->select_data_by_id('user', 'fb_id', $fbid, '*', '');

            if (count($user) > 0) {

                $this->session->set_userdata('aileenuser', $user[0]['user_id']);


                $status = true;
                $userid = $user[0]['user_id'];
            } else {

                if ($gender == 'female') {
                    $gen = F;
                } else {
                    $gen = M;
                }
                $data = array(
                    'first_name' => $fname,
                    'last_name' => $lname,
                    'user_gender' => $gen,
                    'fb_id' => $fbid,
                    'is_delete' => 0,
                    'created_date' => date('y-m-d h:i:s')
                );

                //echo '<pre>'; print_r($data); die();

                $insertid = $this->common->insert_data_getid($data, 'user');

                if ($insertid) {
                    $status = true;
                    $userid = $insertid;
                } else {
                    
                }
            }
        } else {
            
        }
        echo json_encode(array('status' => $status, 'userid' => $userid));
    }

}

/* End of file welcome.php *//* Location: ./application/controllers/welcome.php */