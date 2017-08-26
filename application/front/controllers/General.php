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

    public function get_jobtitle($id="") {
      
     
      //get search term
   $searchTerm = $_GET['term']; 
      if (!empty($searchTerm)) {

    $contition_array = array('status' => 'publish');
      $search_condition = "(name LIKE '" . trim($searchTerm) . "%')";
     $jobtitlelist = $this->common->select_data_by_search('job_title', $search_condition,$contition_array, $data = 'title_id as id,name as text', $sortby = 'name', $orderby = 'desc', $limit = '', $offset = '', $join_str5 = '', $groupby = 'name');
     }
      foreach($jobtitlelist as $key => $value){
        //   $citydata[$key]['id'] = $value['id'];
           $jobtitledata[$key]['value'] = $value['text'];
      }
      
      $cdata = array_values($jobtitledata);
     echo json_encode($cdata);

    }
    public function get_alldata($id="") {
  
    //get search term
   $searchTerm = $_GET['term']; 
  if (!empty($searchTerm)) {

    $contition_array = array('re_status' => '1','re_step' => 3);
    $search_condition = "(re_comp_name LIKE '" . trim($searchTerm) . "%')";
    $results_recruiter = $this->common->select_data_by_search('recruiter', $search_condition,$contition_array, $data = 're_comp_name', $sortby = 're_comp_name', $orderby = '', $limit = '', $offset = '', $join_str5 = '', $groupby = 're_comp_name');

    $contition_array = array('status' => '1');
    $search_condition = "(other_skill LIKE '" . trim($searchTerm) . "%')";
    $results_post = $this->common->select_data_by_search('rec_post', $search_condition,$contition_array, $data = 'other_skill', $sortby = 'other_skill', $orderby = '', $limit = '', $offset = '', $join_str5 = '', $groupby = 'other_skill');
   
    $contition_array = array('status' => '1', 'type' => '1');
    $search_condition = "(skill LIKE '" . trim($searchTerm) . "%')";
    $skill = $this->common->select_data_by_search('skill', $search_condition,$contition_array, $data = 'skill', $sortby = 'skill', $orderby = '', $limit = '', $offset = '', $join_str5 = '', $groupby = 'skill');

    $contition_array = array('status' => 'publish');
    $search_condition = "(name LIKE '" . trim($searchTerm) . "%')";
    $jobtitle = $this->common->select_data_by_search('job_title', $search_condition,$contition_array, $data = 'name', $sortby = 'name', $orderby = '', $limit = '', $offset = '', $join_str5 = '', $groupby = 'name');

}

      $uni = array_merge($results_recruiter, $results_post, $skill,$jobtitle);

     foreach ($uni as $key => $value) {
            foreach ($value as $ke => $val) {
                if ($val != "") {
                    $result[] = $val;
                }
            }
        }
         foreach ($result as $key => $value) {
            $result1[$key]['value'] = $value;
        }
        $result1 = array_values($result);
        echo json_encode($result1);   

    }
    
    // DEGREE DATA START

    public function get_degree($id="") {
      
     $userid = $this->session->userdata('aileenuser');
      //get search term
   $searchTerm = $_GET['term']; 
      if (!empty($searchTerm)) {

    $contition_array = array('is_delete' => '0','degree_name !=' => "Other");
     $search_condition = "((status = '2' AND user_id = $userid) OR (status = '1')) AND (degree_name LIKE '" . trim($searchTerm) . "%')";
      $degree = $this->data['degree'] = $this->common->select_data_by_search('degree', $search_condition, $contition_array, $data = 'degree_name as text', $sortby = 'degree_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');
     }
      foreach($degree as $key => $value){
        //   $citydata[$key]['id'] = $value['id'];
           $degreedata[$key]['value'] = $value['text'];
      }
      
      $cdata = array_values($degreedata);
     echo json_encode($cdata);

    }

    // DEGREE DATA END
   
    
   
}


