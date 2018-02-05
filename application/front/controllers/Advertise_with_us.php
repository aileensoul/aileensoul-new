<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Advertise_with_us extends CI_Controller {

    public function __construct() {
        parent::__construct();
        //AWS access info start
        $this->load->library('S3');
        //AWS access info end
        $this->load->library('form_validation');
        $this->load->model('email_model');

        include ('include.php');
    }

    public function index() { 
        $this->data['login_header'] = $this->load->view('login_header', $this->data, TRUE);
        $this->data['login_footer'] = $this->load->view('login_footer', $this->data, TRUE);
        $this->load->view('advertise_with_us/index', $this->data);
    }

    public function advertise_insert() {
        $feedback_firstname = $_POST['feedback_firstname'];
        $feedback_lastname = $_POST['feedback_lastname'];
        $feedback_email = $_POST['feedback_email'];
        $subject = $_POST['feedback_subject'];
        $message = $_POST['feedback_message'];
        $toemail = "dshah1341@gmail.com";
        $touser =  $_POST['feedback_email'];       

        $data = array(
            'first_name' => $feedback_firstname,
            'last_name' => $feedback_lastname,
            'user_email' => $feedback_email,
            'subject' => $subject,
            'description' => $message,
            'created_date' => date('Y-m-d H:i:s', time()),
            'is_delete' => '0'
        );
        $insert_id = $this->common->insert_data_getid($data, 'feedback');
        if ($insert_id) {

        }
    }

}
