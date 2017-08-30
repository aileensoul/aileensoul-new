<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Welcome extends CI_Controller { 

	public function __construct()
	{
		parent::__construct();
    $this->load->library('facebook');
		$this->load->model('common');
	}

	public function index()
	{ //echo site_url('welcome/flogin'); die();
		
			$this->load->view('login');
	}

	public function flogin()
	{ 
	   

       if($this->input->post('id')){
         
         $fbid = $this->input->post('id');

$fbdata = $this->common->select_data_by_id('user', 'fb_id', $fbid, $data = '*', $join_str = array());

if($fbdata){
                $data = array(
                         
                          'fb_id' => $this->input->post('id'),
                          'first_name' => $this->input->post('first_name'),
                          'last_name' => $this->input->post('last_name'),
                          'user_gender' => $this->input->post('gender'),
                          'modified_date' => date('Y-m-d',time())
                    ); 

                 $updatdata =   $this->common->update_data($data,'user','fb_id',$fbid);

          $this->session->set_userdata('aileenuser', $fbdata[0]['user_id']);

}else{

               $data = array(
                         
                          'fb_id' => $this->input->post('id'),
                          'first_name' => $this->input->post('first_name'),
                          'last_name' => $this->input->post('last_name'),
                          'user_gender' => $this->input->post('gender'),
                          'modified_date' => date('Y-m-d',time())
                    );  

           
               $insert_id = $this->common->insert_data_getid($data,'user');
             
             $this->session->set_userdata('aileenuser', $insert_id);
              }
        }

        echo "yes";
    }    
}
