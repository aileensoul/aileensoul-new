<?php if (!defined('BASEPATH'))    exit('No direct script access allowed');

class Userprofile extends MY_Controller {

    public $data;

    public function __construct() {
        parent::__construct();
        //AWS access info start
        $this->load->library('S3');
        //AWS access info end
         $this->load->library('form_validation');
		// if ($this->session->userdata('aileensoul_front') == '') {
  //           redirect('login', 'refresh');
  //       }
        
        
        include ('include.php');
    }

    public function index() { 
      
      
        $this->load->view('userprofile/index', $this->data);
    }

}