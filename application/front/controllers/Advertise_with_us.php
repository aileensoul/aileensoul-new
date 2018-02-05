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
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $message = $_POST['message'];
        
        $data = array(
            'firstname' => $firstname,
            'lastname' => $lastname,
            'email' => $email,
            'message' => $message,
            'created_date' => date('Y-m-d H:i:s', time()),
            'status' => '1'
        );
        $insert_id = $this->common->insert_data_getid($data, 'advertise_with_us');
        if ($insert_id) {
            echo 'ok';
        }
    }

}
