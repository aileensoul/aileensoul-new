<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public $data;

    public function __construct() {
        parent::__construct();

        // if ($this->session->userdata('aileensoul_front') == '') {
        //     redirect('login', 'refresh');
        // }

//          die();

        $this->load->library('form_validation');

        // Get Site Information
        $site_settings = $this->common->select_data_by_id('site_settings', 'site_id', 1, $data = '*', $join_str = array());
        $main_site_name = $this->data['main_site_name'] = $site_settings[0]['site_name'];
        $main_site_url = $this->data['main_site_url'] = $site_settings[0]['site_url'];
        $main_site_email = $this->data['main_site_email'] = $site_settings[0]['site_email'];

        $this->data['title'] = "Dashboard | $main_site_name ";
        $this->data['keywords'] = "Dashboard";
        $this->data['description'] = "this is my dashboard page";

        // Load Login Model
        $this->load->model('logins');

        include ('include.php');
    }

    public function index() {
        //$userid = $this->session->userdata('aileensoul_front');
        $userid = $this->session->userdata('user_id');
        // echo $userid; die();
        $this->data['userdata'] = $this->common->select_data_by_id('user', 'user_id', $userid, $data = '*', $join_str = array());
        //echo '<pre>'; print_r($this->data['userdata']); die();
        $this->load->view('Dashboard/index1', $this->data);
    }


    public function user_image_insert() { //echo "hii";die();

        $userid = $this->session->userdata('user_id');
        
             if (empty($_FILES['profilepic']['name']))
             { //echo"hello";
                 $this->form_validation->set_rules('profilepic', 'Upload profilepic', 'required');
            //$picture = '';
            }
            else
            { //echo "hii";die();
                $config['upload_path'] = 'uploads/user_image/';
                $config['allowed_types'] = 'jpg|jpeg|png|gif|mp4|3gp|mpeg|mpg|mpe|qt|mov|avi|pdf';
               // $config['file_name'] = $_FILES['picture']['name'];
                $config['file_name'] = $_FILES['profilepic']['name'];
                //$config['max_size'] = '1000000000000000';
                //Load upload library and initialize configuration
                $this->load->library('upload',$config);
                $this->upload->initialize($config);
                
                if($this->upload->do_upload('profilepic'))
                {
                    $uploadData = $this->upload->data();
                    //$picture = $uploadData['file_name']."-".date("Y_m_d H:i:s");
                    $picture = $uploadData['file_name'];
                }
                else
                {
                    $picture = '';
                }

                $data = array(
                    
                    'user_image' =>$picture,
                    'modified_date' => date('Y-m-d',time())
            ); 
                //echo "<pre>"; print_r($data);die();
       
      $updatdata =   $this->common->update_data($data,'user','user_id',$userid);

          if($updatdata){ 
            redirect('dashboard', refresh);
          }else{
             $this->session->flashdata('error','Your data not inserted');
                   redirect('dashboard', refresh);
          }
        }
    }
    public function signout() {
        if ($this->session->userdata('user_id') != '') {
           // $this->session->unset_userdata('aileensoul_front');
           // $this->session->userdata('aileensoul_front');
            $this->session->sess_destroy();
            redirect('/login/', 'refresh');
        }
    }

}
