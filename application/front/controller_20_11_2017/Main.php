<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Main extends CI_Controller {

    public $data;

    public function __construct() {
        parent::__construct();

        $this->load->library('form_validation');
        $this->load->model('email_model');
        $this->load->helper('cookie');
        $this->load->model('logins');
        //AWS access info start
        $this->load->library('S3');
        //AWS access info end

        // if ($this->session->userdata('aileenuser')) {
        //     redirect('dashboard', 'refresh');
        // }
        include ('include.php');
    }

    //job seeker basic info controller start
    public function index() {
        $this->data['login_footer'] = $this->load->view('login_footer', $this->data, TRUE);
        
        /*$contition_array = array();
        $site_visit = $this->common->select_data_by_condition('site_settings', $contition_array, $data = 'site_visit', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
        $site_visit = $site_visit[0]['site_visit'];
        $update_site_visit = $site_visit + 1;
        */
        
        /* visitor counter */

//         $counter_name = "counter.txt";
// // Check if a text file exists. If not create one and initialize it to zero.
//         if (!file_exists($counter_name)) {
//             $f = fopen($counter_name, "w");
//             fwrite($f, "0");
//             fclose($f);
//         }
// // Read the current value of our counter file
//         $f = fopen($counter_name, "r");
//         $counterVal = fread($f, filesize($counter_name));
//         fclose($f);
// // Has visitor been counted in this session?
// // If not, increase counter value by one
//         if (!isset($_SESSION['hasVisited'])) {
//             $_SESSION['hasVisited'] = "yes";
//             $counterVal++;
//             $f = fopen($counter_name, "w");
//             fwrite($f, $counterVal);
//             fclose($f);
//         }

        /* visitor counter */

        
        // $data = array(
        //     'site_visit' => $counterVal
        // );
        // $updatdata = $this->common->update_data($data, 'site_settings', 'site_id', '1');

        $ipaddress = trim($this->input->ip_address()); 
    //echo $ipaddress; die();

      $date = date('Y-m-d');
      
    $contition_array = array('ip' => $ipaddress, 'insert_date' => $date);
    $uservisit = $this->common->select_data_by_condition('user_visit', $contition_array, $data = 'id', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = ''); 
//echo  $this->db->last_query(); die();
    //echo "<pre>"; print_r($uservisit); die();
   
       if($uservisit){}else{
          $data = array(
                'ip' => $ipaddress,
                //'mac' => 1,
                'insert_date' => date('Y-m-d', time()),

            );
       $insertid = $this->common->insert_data_getid($data, 'user_visit');
    }
        
        $this->load->view('main', $this->data);

        if ($this->session->userdata('aileenuser')) {
            redirect('dashboard', 'refresh');
        }
    }

    //job user end
    public function abc() {
        $this->load->view('show');
    }

    //job user end
    public function terms_condition() {
        $this->load->view('termcondition');
    }

    //job user end
    public function privacy_policy() {
        $this->load->view('privacypolicy');
    }

}
