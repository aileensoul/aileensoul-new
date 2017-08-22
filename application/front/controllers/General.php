<?php if (!defined('BASEPATH'))    exit('No direct script access allowed');

class General extends MY_Controller {

    public $data;

    public function __construct() {
        parent::__construct();
         $this->load->library('form_validation');
// if ($this->session->userdata('aileensoul_front') == '') {
//             redirect('login', 'refresh');
//         }
        
        
        include ('include.php');
    }

    

    public function get_location($id="") {
      
     
              //get search term
   $searchTerm = $_GET['term']; 
      if (!empty($searchTerm)) {
     $search_condition = "(city_name LIKE '" . trim($searchTerm) . "%')";
     $citylist = $this->common->select_data_by_search('cities', $search_condition,$contition_array = array(), $data = 'city_id as id,city_name as text', $sortby = 'city_name', $orderby = 'desc', $limit = '', $offset = '', $join_str5 = '', $groupby = 'city_name');
     }
      foreach($citylist as $key => $value){
        //   $citydata[$key]['id'] = $value['id'];
           $citydata[$key]['value'] = $value['text'];
      }
      
      $cdata = array_values($citydata);
     echo json_encode($cdata);

    }
    
    
    public function get_skill($id="") {
  
    //get search term
   $searchTerm = $_GET['term']; 
      if (!empty($searchTerm)) {
           $contition_array = array('status' => 1,'type' => 1);
     $search_condition = "(skill LIKE '" . trim($searchTerm) . "%')";
     $citylist = $this->common->select_data_by_search('skill', $search_condition,$contition_array, $data = 'skill as text', $sortby = 'skill', $orderby = 'desc', $limit = '', $offset = '', $join_str5 = '', $groupby = 'skill');
     }
      foreach($citylist as $key => $value){
        //   $citydata[$key]['id'] = $value['id'];
           $citydata[$key]['value'] = $value['text'];
      }
      
      $cdata = array_values($citydata);
     echo json_encode($cdata);

    }


    public function get_artskill($id="") {
  
    //get search term
   $searchTerm = $_GET['term']; 
      if (!empty($searchTerm)) {
           $contition_array = array('status' => 1,'type' => 2);
     $search_condition = "(skill LIKE '" . trim($searchTerm) . "%')";
     $citylist = $this->common->select_data_by_search('skill', $search_condition,$contition_array, $data = 'skill as text', $sortby = 'skill', $orderby = 'desc', $limit = '', $offset = '', $join_str5 = '', $groupby = 'skill');
     }
      foreach($citylist as $key => $value){
        //   $citydata[$key]['id'] = $value['id'];
           $citydata[$key]['value'] = $value['text'];
      }
      
      $cdata = array_values($citydata);
     echo json_encode($cdata);

    }

     public function get_language($id="") {
  
    //get search term
   $searchTerm = $_GET['term']; 
      if (!empty($searchTerm)) {
           $contition_array = array('status' => 1);
     $search_condition = "(language_name LIKE '" . trim($searchTerm) . "%')";
     $languagelist = $this->common->select_data_by_search('language', $search_condition,$contition_array, $data = 'language_name as text', $sortby = 'language_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str5 = '', $groupby = 'language_name');
     }
      foreach($languagelist as $key => $value){
        //   $citydata[$key]['id'] = $value['id'];
           $languagedata[$key]['value'] = $value['text'];
      }
      
      $cdata = array_values($languagedata);
     echo json_encode($cdata);

    }
    
   
}


