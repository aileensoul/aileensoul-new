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
        
//         /* visitor counter */

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

//         /* visitor counter */
       // echo $this->input->ip_address(); die();

       //echo $_SERVER['SERVER_ADDR']; die();

       //  $string=exec('getmac');
       // $mac=substr($string, 0, 17); 
       // echo $mac; die();
       // echo $this->GetMAC(); die();
        
     //   $data = array(
     //            'ip' => 1,
     //            'mac' => 1,
     //            'insert_date' => date('Y-m-d', time()),

     //        );
     // $insertid = $this->common->insert_data_getid($data, 'user_visit');

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

    

// public function GetMAC(){
//     ob_start();
//     system('getmac');
//     $Content = ob_get_contents();
//     ob_clean();
//     return substr($Content, strpos($Content,'\\')-20, 17);
// }


// public function getMAC()
// {
//  /*
//   * Getting MAC Address of the host using PHP
//   * Md. Nazmul Basher
//   * Modified by Junaid Qadir Baloch
//   * Now this function gets all the MAC addresses attached to the system
//   * on which this function is called in an array and returns.

//   */

//  ob_start(); // Turn on output buffering
//  system('ipconfig /all'); //Execute external program to display output
//  $mycom=ob_get_contents(); // Capture the output into a variable
//  ob_clean(); // Clean (erase) the output buffer
//  foreach(preg_split("/(\r?\n)/", $mycom) as $line){
//   if(strstr($line, 'Physical Address'))
//   {
//    $Mac[]= substr($line,39,18);
//   }
//  } echo "<pre>"; print_r($Mac); die();
//  return $Mac;
// }


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
