<?php if (!defined('BASEPATH'))    exit('No direct script access allowed');

class Contact_us extends CI_Controller {

   

    public function __construct() 
    {
        parent::__construct();

        //  $this->load->library('form_validation');
        //   $this->load->model('email_model');
        // if (!$this->session->userdata('aileenuser')) {
        //   redirect('login', 'refresh');
        // }
       
        include ('include.php'); 
    }
        
    public function index()
    { 
        $contition_array = array( 'site_id' => 1);
          $this->data['cnt'] = $this->common->select_data_by_condition('site_settings', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
           
        
          $this->load->view('contact/contact_us', $this->data);
     
    }



    public function contact_us_insert() 
     { 
   
          $name = $_POST['contact_name'];
          $contactlast_name = $_POST['contactlast_name'];
          $email = $_POST['contact_email'];
          $subject = $_POST['contact_subject'];
          $message = $_POST['contact_message'];

        $this->form_validation->set_rules('contact_name', 'contact name', 'required');
        $this->form_validation->set_rules('contactlast_name', 'contact name', 'required');

        $this->form_validation->set_rules('contact_email', 'contact email', 'required|valid_email');
        $this->form_validation->set_rules('contact_subject','contact subject', 'required');
        $this->form_validation->set_rules('contact_message','contact message', 'required');
        

            $data = array(

                'contact_name' =>  $name,
                'contact_lastname' => $contactlast_name,
                'contact_email' => $email,
                'contact_subject' => $subject,
                'contact_message' => $message,
                ); 
                //echo"<pre>";print_r($data);die();
              $insert_id =   $this->common->insert_data_getid($data,'contact_us'); 
                if($insert_id)
                { 
                      echo "ok";
                }
               // else
               //  {
               //          $this->session->flashdata('error','Sorry!! Your data not inserted');
               //         redirect('contact_us', 'refresh');
               //     }
     
}
    
  }