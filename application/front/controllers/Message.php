<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Message extends MY_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->helper('smiley');

        //AWS access info start
        $this->load->library('S3');
        //AWS access info end

        //include('business_include.php');
    }

    public function index($message_from_profile = '', $message_to_profile = '') {
        $this->load->view('message/index');
    }
    
}
