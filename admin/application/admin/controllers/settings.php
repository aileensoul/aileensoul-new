<?php



if (!defined('BASEPATH'))

    exit('No direct script access allowed');



class Settings extends CI_Controller {



    public $data;



    public function __construct() {

        parent::__construct();



        

        // Get Site Information

        $site_settings = $this->common->select_data_by_id('site_settings', 'site_id', 1, $data = '*', $join_str = array());

        $main_site_name = $this->data['main_site_name'] = $site_settings[0]['site_name'];

        $main_site_url = $this->data['main_site_url'] = $site_settings[0]['site_url'];



        $this->data['title'] = "Account settings | $main_site_name ";



        $this->data['module_name'] = "Account settings";



        include('include.php');

        //remove catch so after logout cannot view last visited page if that page is this

        $this->output->set_header('Last-Modified:' . gmdate('D, d M Y H:i:s') . 'GMT');

        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');

        $this->output->set_header('Cache-Control: post-check=0, pre-check=0', false);

        $this->output->set_header('Pragma: no-cache');

    }



    public function index() {

        //edit profile start

         $this->data['section_title'] = "Edit Profile";

        $site_settings = $this->common->select_data_by_id('admin', 'admin_id', 1, $data = '*', $join_str = array());

        //   $contition_array = array('admin_id' => 1);
        // $this->data['admin']=  $this->common->select_data_by_condition('admin', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');  

        $this->data['admin_name'] = $site_settings[0]['admin_name'];
        $this->data['admin_id'] = $site_settings[0]['admin_id'];


        $this->data['admin_email'] = $site_settings[0]['admin_email'];

        $this->data['admin_image'] = $site_settings[0]['admin_image'];
        $this->data['old_image'] = $site_settings[0]['admin_image'];


  // print_r( $this->data); die();

        //edit profile end
       
        // change password start
       $this->data['section_title'] = "Change Password";

       // change password end

        // site settimngs start


         $site_settings = $this->common->select_data_by_id('site_settings', 'site_id', 1, $data = '*', $join_str = array());


        $this->data['site_name'] = $site_settings[0]['site_name'];

        $this->data['site_url'] = $site_settings[0]['site_url'];

        $this->data['site_email'] = $site_settings[0]['site_email'];

        $this->data['site_mobile'] = $site_settings[0]['site_mobile'];

        $this->data['site_owner'] = $site_settings[0]['site_owner'];
       // $this->data['old_image'] = $site_settings[0]['old_image'];



        // sites settings end

        

        $this->load->view('settings/index', $this->data);

    }



    public function edit_profile()
     {

        //echo "<pre>"; print_r($_POST);  die();
         $id = $this->input->post('admin_id');
        

        $this->form_validation->set_rules('admin_name', 'Please Enter Your Admin Name', 'required'); 
        $this->form_validation->set_rules('admin_email', 'Please Enter Your Admin Email', 'required');

       
        // $image = $this->input->post('profile_old_image');
         //echo $image; die();
        
        if (empty($_FILES['admin_image']['name']))

             {
                   
                 //$this->form_validation->set_rules('admin_image', 'Upload Image', 'required');
                  
                  $picture = $this->input->post('old_image');
            }
         else
         {
            //echo"welcome";die();
            $config['upload_path'] = '../admin/assets/uploads/admin_image/';
                $config['allowed_types'] = 'jpg|jpeg|png|gif';
                $config['file_name'] = $_FILES['admin_image']['name'];
                
                //Load upload library and initialize configuration
                $this->load->library('upload',$config);
                $this->upload->initialize($config);
                
                if($this->upload->do_upload('admin_image'))
                {
                    $uploadData = $this->upload->data();
                    //$picture = $uploadData['file_name']."-".date("Y_m_d H:i:s");
                    $picture = $uploadData['file_name'];
                }
                else
                {
                    $picture = '';
                }
         }
        
                

        

        if ($this->form_validation->run() == FALSE)
         { 
         
            // echo "hello"; die();
           $this->load->view('settings/index');

         } 
         else
         { 

               // echo "hi"; die();
            $data = array(
                 'admin_name' => $this->input->post('admin_name'),
                  'admin_email' => $this->input->post('admin_email'),
                'admin_image'=> $picture,
                 'admin_modified_date' => date('Y-m-d h:i:s'),
                 

            ); 
                  

                 // echo "<pre>";print_r($data); die(); 
         $updatdata = $this->common->update_data($data,'admin','admin_id', $id);

          if($updatdata)
          { 
            redirect('dashboard', refresh);
          }
          else
          {
             $this->session->flashdata('error','Your data not inserted');
                   redirect('', refresh);
          }
        

          
          }
    

    }






    public function check_oldpassword() {

        // $this->data['admin_id'] = $site_settings[0]['admin_id'];
           $id = $this->input->post('admin_id');


        if ($this->input->is_ajax_request() && $this->input->post('old_password')) {



            $old_password = $this->input->post('old_password');

            $valid_old_password = $this->common->select_data_by_id('admin', 'admin_password', md5($old_password), 'admin_id',$id);

            

            if (count($valid_old_password) > 0)  {

                echo 'true';


                die();

            } else {

                echo 'false';

                die();

            }

        }

    }

    

    

    public function do_change_password() {

        $old_password = $this->input->post('old_password');

        $new_password = $this->input->post('new_password');

        $confirm_password = $this->input->post('confirm_password');

         $id = $this->input->post('admin_id');
  

        if ($old_password != '' && $new_password != '' && $confirm_password != '') {

            $valid_old_password = $this->common->select_data_by_id('admin', 'admin_password', md5($old_password), 'admin_id', $id);



            if ($valid_old_password[0]['admin_id'] != '' && $valid_old_password[0]['admin_id'] != 0) {

                if ($new_password != $confirm_password) {

                    $this->session->set_flashdata('change_password_error', '<div class="alert alert-danger">New Password And Confirm Password Not Match.</div>');

                    redirect('settings/change_password', 'refresh');

                } else {

                    $data = array('admin_password' => md5($new_password), 'admin_pwd' => base64_encode($new_password));

                    $update_data = $this->common->update_data($data, 'admin', 'admin_id', 1);

                    $this->session->set_flashdata('success', '<div class="alert alert-success"><b>Successfully Password Change</b></div>');

                    redirect('settings', 'refresh');

                }

            } else {

                $this->session->set_flashdata('error', '<div class="alert alert-danger"><b>Please Fill All Fields.</b></div>');

                redirect('settings', 'refresh');

            }

        } else {

            $this->session->set_flashdata('error', '<div class="alert alert-danger"><b>profile_old_image Password Not Correct.</b></div>');

            redirect('settings', 'refresh');

        }

    }


    public function do_site_settings()
     {

          
            

        $site_name = $this->input->post('site_name');

        $site_url = $this->input->post('site_url');

        $site_email = $this->input->post('site_email');

        $site_mobile = $this->input->post('site_mobile');

        $site_owner = $this->input->post('site_owner');



        $data = array('site_name' => $site_name, 'site_url' => $site_url, 'site_email' => $site_email, 'site_mobile' => $site_mobile, 'site_owner' => $site_owner);



        $update_setting = $this->common->update_data($data, 'site_settings', 'site_id', 1);

        $this->session->set_flashdata('success', '<div class="alert alert-success"><b>Site Settings Successfully Change.</b></div>');

        redirect('settings', 'refresh');

    }



    

}



/* End of file welcome.php */

/* Location: ./application/controllers/welcome.php */