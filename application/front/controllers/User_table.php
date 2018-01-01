<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class User_table extends MY_Controller {

    public $data;

    public function __construct() {

        parent::__construct();
        
        include('include.php');
    }

    public function index() {
        
    }
}
