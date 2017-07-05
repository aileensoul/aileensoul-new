<?php if (!defined('BASEPATH'))    exit('No direct script access allowed');

class About_us extends CI_Controller {

   

    public function __construct() 
    {
        parent::__construct();

        include ('include.php'); 
    }
        
    public function index()
    { 
          $this->load->view('about_us/index', $this->data);
     
    }

  }