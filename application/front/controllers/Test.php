<?php if (!defined('BASEPATH'))    exit('No direct script access allowed');

class Test extends MY_Controller {

    public $data;

    public function __construct() {
        parent::__construct();
         $this->load->library('form_validation');
// if ($this->session->userdata('aileensoul_front') == '') {
//             redirect('login', 'refresh');
//         }
        
        
        include ('include.php');
    }
    
    public function index(){
        
          $contition_array = array('user_id' => $userid, 're_status' => '1');
        $recdata = $this->data['recdata'] = $this->common->select_data_by_condition('recruiter', $contition_array, $data = 're_step,rec_firstname,rec_lastname,rec_email,rec_phone', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        $this->load->view('test/index',$this->data);
    }

    
  
   
}


