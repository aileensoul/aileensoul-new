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
            redirect('profiles/' . $this->session->userdata('aileenuser_slug'), 'refresh');
        }

        $this->load->library('form_validation');
        $this->load->model('logins');
        $this->load->model('email_model');
        $this->load->model('user_model');
    }

    public function index() {

        if ($_SERVER['HTTP_REFERER'] == base_url()) {
            $this->data['error_msg'] = $error_msg = $_GET['error_msg'];
        } else {
            $this->data['error_msg'] = $error_msg = 0;
        }
        if ($_GET['redirect_url'] != '') {
            $this->data['redirect_url'] = base64_decode($_GET['redirect_url']);
        }
        if ($this->input->get()) {
            if ($_GET['lwc'] != " ") {
                $emaildata = $this->common->select_data_by_id('user_login', 'user_id', $_GET['lwc'], $data = 'email', $join_str = array());
                $this->data['email'] = $emaildata[0]['email'];
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
        $email_login = $this->input->post('email_login');
        $password_login = $this->input->post('password_login');

        $userinfo = $this->logins->check_login($email_login, $password_login);
        $user_slug = '';
        if ($userinfo['user_id'] != '') {
            if ($userinfo['status'] == "2") {
                echo 'Sorry, user is Inactive.';
            } else {
                $this->session->set_userdata('aileenuser', $userinfo['user_id']);
                $user_slug = $this->user_model->getUserSlugById($userinfo['user_id']);
                $this->session->set_userdata('aileenuser_slug', $user_slug['user_slug']);
                $data = 'ok';
            }
        } else if ($email_login == $userinfo['email']) {
            $data = 'password';
            $id = $userinfo['user_id'];
        } else {
            $data = 'email';
        }
        echo json_encode(
                array(
                    "data" => $data,
                    "user_slug" => $user_slug['user_slug']
        ));
    }

    // login check and email validation start
    public function freelancer_hire_login(){
        $email_login = $this->input->post('email_login');
        $password_login = $this->input->post('password_login');

        $userinfo = $this->logins->check_login($email_login, $password_login);
        $user_slug = '';
        
        if ($userinfo['user_id'] != '') {
            if ($userinfo['status'] == "2") {
                echo 'Sorry, user is Inactive.';
            } else {
                $this->session->set_userdata('aileenuser', $userinfo['user_id']);
                $user_slug = $this->user_model->getUserSlugById($userinfo['user_id']);
                $this->session->set_userdata('aileenuser_slug', $user_slug['user_slug']);
                $data = 'ok';
            }
        } else if ($email_login == $userinfo['email']) {
            $data = 'password';
            $id = $userinfo['user_id'];
        } else {
            $data = 'email';
        }
        
        $select_data = 'freelancer_hire_slug';
        $this->data['freehiredata'] = $this->freelancer_hire_model->getfreelancerhiredata($userinfo['user_id'], $select_data);
        $freelancer_hire_user = count($this->data['freehiredata']);
        
        echo json_encode(
                array(
                    "data" => $data,
                    "user_slug" => $user_slug['user_slug'],
                    "freelancerhire" => $freelancer_hire_user
        ));
    }
    public function freelancer_apply_login(){
        
        $email_login = $this->input->post('email_login');
        $password_login = $this->input->post('password_login');

        $userinfo = $this->logins->check_login($email_login, $password_login);
        $user_slug = '';
        
        if ($userinfo['user_id'] != '') {
            if ($userinfo['status'] == "2") {
                echo 'Sorry, user is Inactive.';
            } else {
                $this->session->set_userdata('aileenuser', $userinfo['user_id']);
                $user_slug = $this->user_model->getUserSlugById($userinfo['user_id']);
                $this->session->set_userdata('aileenuser_slug', $user_slug['user_slug']);
                $data = 'ok';
            }
        } else if ($email_login == $userinfo['email']) {
            $data = 'password';
            $id = $userinfo['user_id'];
        } else {
            $data = 'email';
        }
        
        $select_data = 'freelancer_apply_slug';
        $this->data['freepostdata'] = $this->freelancer_apply_model->getfreelancerapplydata($userinfo['user_id'], $select_data);
        $freelancer_apply_user = count($this->data['freepostdata']);
        
        echo json_encode(
                array(
                    "data" => $data,
                    "user_slug" => $user_slug['user_slug'],
                    "freelancerapply" => $freelancer_apply_user
        ));
    }
    public function main_check_login() {
        $email_login = $this->input->post('email_login');
        $password_login = $this->input->post('password_login');

        $contition_array = array('email' => $email_login, 'is_delete' => '0');
        $result = $this->common->select_data_by_condition('user_login', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        $userinfo = $this->common->check_login($email_login, $password_login);

        //For live link need this code start
        $contition_array = array('user_id' => $userinfo[0]['user_id'], 'is_delete' => '0', 'status' => '1');
        $jobdata = $this->data['jobdata'] = $this->common->select_data_by_condition('job_reg', $contition_array, $data = 'count(*) as total', $sortby = '', $orderby = 'desc', $limit = '', $offset = '', $join_str = array(), $groupby = '');
        $jobuser = $jobdata[0]['total'];
        //For live link need this code End
        //For live link of freelancer aplly user code start
        $contition_array = array('user_id' => $userinfo[0]['user_id'], 'is_delete' => '0', 'status' => '1', 'free_post_step' => '7');
        $free_work_result = $this->common->select_data_by_condition('freelancer_post_reg', $contition_array, $data = 'count(*) as total', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
        $freelancer_apply_user = $free_work_result[0]['total'];

        //For live link of freelancer aplly user code end
        //CHECK USER HAVE RECRUITER PROFILE
        $contition_array = array('user_id' => $userinfo[0]['user_id'], 'is_delete' => '0', 're_status' => '1');
        $recdata = $this->data['recdata'] = $this->common->select_data_by_condition('recruiter', $contition_array, $data = 'count(*) as total', $sortby = '', $orderby = 'desc', $limit = '', $offset = '', $join_str = array(), $groupby = '');
        $recdata = $recdata[0]['total'];
        //CHECK USER HAVE RECRUITER PROFILE END
        //For live link of freelancer aplly user code start
        $contition_array = array('user_id' => $userinfo[0]['user_id'], 'is_delete' => '0', 'status' => '1', 'free_hire_step' => '3');
        $free_hire_result = $this->common->select_data_by_condition('freelancer_hire_reg', $contition_array, $data = 'count(*) as total', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
        $freelancer_hire_user = $free_hire_result[0]['total'];

        //For live link of freelancer aplly user code end

        if ($this->session->userdata('searchkeyword')) {
            $this->session->unset_userdata('searchkeyword');
        }
        if ($this->session->userdata('searchplace')) {
            $this->session->unset_userdata('searchplace');
        }

        if (count($userinfo) > 0) {
            if ($userinfo[0]['status'] == "2") {
                echo 'Sorry, user is Inactive.';
            } else {
                $this->session->set_userdata('aileenuser', $userinfo[0]['user_id']);
                $this->session->set_userdata('aileenuser_slug', $userinfo[0]['user_slug']);
                $data = 'ok';
            }
        } else if ($email_login == $result[0]['user_email']) {
            $data = 'password';
            $id = $result[0]['user_id'];
        } else {
            $data = 'email';
        }
//        echo $result[0]['user_id'];die();
        echo json_encode(
                array(
                    "data" => $data,
                    "id" => $id,
                    "jobuser" => $jobuser,
                    "freelancerapply" => $freelancer_apply_user,
                    "recuser" => $recdata,
                    "freelancerhire" => $freelancer_hire_user,
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
                $this->session->set_userdata('aileenuser_slug', $userinfo[0]['user_slug']);
                $is_data = 'ok';
            }
        } else if ($email_login == $result[0]['user_email']) {
            $is_data = 'password';
            $id = $result[0]['user_id'];
        } else {
            $is_data = 'email';
        }

        $contition_array = array('user_id' => $userinfo[0]['user_id'], 'is_deleted' => '0', 'status' => '1', 'business_step' => '4');
        $business_result = $this->common->select_data_by_condition('business_profile', $contition_array, $data = 'count(*) as total', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        $business = 0;
        if ($business_result[0]['total'] > 0) {
            $business = 1;
        }

        $contition_array = array('user_id' => $userinfo[0]['user_id'], 'is_delete' => '0', 'status' => '1', 'free_post_step' => '7');
        $free_work_result = $this->common->select_data_by_condition('freelancer_post_reg', $contition_array, $data = 'count(*) as total', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        $free_work = 0;
        if ($free_work_result[0]['total'] > 0) {
            $free_work = 1;
        }

        $contition_array = array('user_id' => $userinfo[0]['user_id'], 'is_delete' => '0', 'status' => '1', 'free_hire_step' => '3');
        $free_hire_result = $this->common->select_data_by_condition('freelancer_hire_reg', $contition_array, $data = 'count(*) as total', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        $free_hire = 0;
        if ($free_hire_result[0]['total'] > 0) {
            $free_hire = 1;
        }

        $contition_array = array('user_id' => $userinfo[0]['user_id'], 'is_delete' => '0', 'status' => '1', 'art_step' => '4');
        $artistic_result = $this->common->select_data_by_condition('art_reg', $contition_array, $data = 'count(*) as total', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        $artistic = 0;
        if ($artistic_result[0]['total'] > 0) {
            $artistic = 1;
        }


        $contition_array = array('user_id' => $userinfo[0]['user_id'], 'is_delete' => '0', 'status' => '1', 'job_step' => '10');
        $job_result = $this->common->select_data_by_condition('job_reg', $contition_array, $data = 'count(*) as total', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
        $job = 0;
        if ($job_result[0]['total'] > 0) {
            $job = 1;
        }

        echo json_encode(
                array(
                    "data" => $is_data,
                    "id" => $id,
                    "is_bussiness" => $business,
                    "is_freelancer_work" => $free_work,
                    "is_freelancer_hire" => $free_hire,
                    "is_artistic" => $artistic,
                    "is_job" => $job
        ));
    }

//login validation end

//artistic check login start


    public function artistic_check_login() {

        $email_login = $this->input->post('email_login');
        $password_login = $this->input->post('password_login');

        $result = $this->logins->getLoginData($email_login);
        $userinfo = $this->logins->artistic_check_login($email_login, $password_login);

        if (count($userinfo) > 0) {
            if ($userinfo[0]['status'] == "2") {
                echo 'Sorry, user is Inactive.';
            } else {
                $this->session->set_userdata('aileenuser', $userinfo[0]['user_id']);
                $this->session->set_userdata('aileenuser_slug', $userinfo[0]['user_slug']);
                $is_data = 'ok';
            }
        } else if ($email_login == $result[0]['email']) {
            $is_data = 'password';
            $id = $result[0]['user_id'];
        } else {
            $is_data = 'email';
        }

        $contition_array = array('user_id' => $userinfo[0]['user_id'], 'is_delete' => '0', 'status' => '1', 'art_step' => '4');
        $artistic_result = $this->common->select_data_by_condition('art_reg', $contition_array, $data = 'count(*) as total', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        $artistic = 0;
        if ($artistic_result[0]['total'] > 0) {
            $artistic = 1;
        }

        echo json_encode(
                array(
                    "data" => $is_data,
                    "id" => $id,
                    "is_artistic" => $artistic
        ));
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
                    'is_delete' => '0',
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