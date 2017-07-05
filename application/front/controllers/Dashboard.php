<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Dashboard extends MY_Controller {

    public $data;

    public function __construct() {

        parent::__construct();
        $this->load->model('email_model');
        $this->data['title'] = "Grow Business Network | Hiring | Search Jobs | Freelance Work | Artistic | It's Free";
        include('include.php');
    }

    public function index($id = " ") {
        
        //   echo '<pre>'; print_r($this->session->all_userdata()); die();
        $this->load->library('form_validation');
        //$userid = $this->session->userdata('aileensoul_front');
        $userid = $this->session->userdata('aileenuser');
        // echo $userid; die();
        $this->data['userdata'] = $this->common->select_data_by_id('user', 'user_id', $userid, $data = '*', $join_str = array());


        $contition_array = array('user_id' => $userid, 'status' => '1');
         $this->data['job'] = $this->common->select_data_by_condition('job_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');


          $contition_array = array('user_id' => $userid, 're_status' => '1');
            $recrdata = $this->data['recrdata'] = $this->common->select_data_by_condition('recruiter', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

            $contition_array = array('user_id' => $userid, 'is_deleted' => '0', 'status' => '1');
            $this->data['busdata'] = $this->common->select_data_by_condition('business_profile', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

//echo '<pre>'; print_r($this->data['busdata'][0]); die();
            $contition_array = array('user_id' => $userid, 'is_delete' => '0', 'status' => '1');
            $this->data['artdata'] = $this->common->select_data_by_condition('art_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        //echo '<pre>'; print_r($this->data['userdata']); die();
        $this->load->view('dashboard/cover', $this->data);
    }

    public function user_image_insert() {
        $userid = $this->session->userdata('aileenuser');


        if ($this->input->post('cancel')) {
            redirect('dashboard', refresh);
        }

        if (empty($_FILES['profilepic']['name'])) {
            $this->form_validation->set_rules('profilepic', 'Upload profilepic', 'required');
        } else {
            /* $config['upload_path'] = 'uploads/user_image/';
              $config['allowed_types'] = 'jpg|jpeg|png|gif|mp4|3gp|mpeg|mpg|mpe|qt|mov|avi|pdf';
              $config['file_name'] = $_FILES['profilepic']['name'];
              $this->load->library('upload', $config);
              $this->upload->initialize($config);

              if ($this->upload->do_upload('profilepic')) {
              $uploadData = $this->upload->data();
              $picture = $uploadData['file_name'];
              } else {
              $picture = '';
              }
             */
            
            $user_image = '';
            $user['upload_path'] = $this->config->item('user_main_upload_path');
            $user['allowed_types'] = $this->config->item('user_main_allowed_types');
            //$user['max_size'] = $this->config->item('user_main_max_size');
            //$user['max_width'] = $this->config->item('user_main_max_width');
            //$user['max_height'] = $this->config->item('user_main_max_height');
            //$user['remove_spaces'] = true;
            $user['quality'] = "50%";
            $user['maintain_ratio'] = TRUE;
            $user['encrypt_name'] = TRUE;
            $this->load->library('upload');
            $this->upload->initialize($user);
            //Uploading Image
            $this->upload->do_upload('profilepic');
            //Getting Uploaded Image File Data
            $imgdata = $this->upload->data();
            $imgerror = $this->upload->display_errors();
//            echo '<pre>';
//            print_r($imgerror);
//            exit();
            if ($imgerror == '') {
                //Configuring Thumbnail 
                $user_thumb['image_library'] = 'gd2';
                $user_thumb['source_image'] = $user['upload_path'] . $imgdata['file_name'];
                $user_thumb['new_image'] = $this->config->item('user_thumb_upload_path') . $imgdata['file_name'];
                $user_thumb['create_thumb'] = TRUE;
                $user_thumb['maintain_ratio'] = TRUE;
                $user_thumb['thumb_marker'] = '';
                $user_thumb['width'] = $this->config->item('user_thumb_width');
                //$user_thumb['height'] = $this->config->item('user_thumb_height');
                $user_thumb['height'] = 2;
                $user_thumb['master_dim'] = 'width';
                $user_thumb['quality'] = "100%";
                $user_thumb['x_axis'] = '0';
                $user_thumb['y_axis'] = '0';
                //Loading Image Library
                $this->load->library('image_lib', $user_thumb);
                $dataimage = $imgdata['file_name'];
                //Creating Thumbnail
                $this->image_lib->resize();
                $thumberror = $this->image_lib->display_errors();
            } else {
                $thumberror = '';
            }
            if ($imgerror != '' || $thumberror != '') {
                $error[0] = $imgerror;
                $error[1] = $thumberror;
            } else {
                $error = array();
            }
            if ($error) {
                $this->session->set_flashdata('error', $error[0]);
                $redirect_url = site_url('dashboard');
                redirect($redirect_url, 'refresh');
            } else {
                $user_image = $imgdata['file_name'];
            }


            $data = array(
                'user_image' => $user_image,
                'modified_date' => date('Y-m-d', time())
            );

            $updatdata = $this->common->update_data($data, 'user', 'user_id', $userid);

            if ($updatdata) {
                redirect('dashboard', refresh);
            } else {
                $this->session->flashdata('error', 'Your data not inserted');
                redirect('dashboard', refresh);
            }
        }
    }

    public function check_login() {

        $user_name = $this->input->post('user_name');

        $user_password = $this->input->post('user_password');

        if ($user_name != '' && $user_password != '') {

            $admin_check = $this->logins->check_authentication($user_name, $user_password);

            if ($admin_check != 0) {

                $this->session->set_userdata('topgraffiti_admin', $admin_check[0]['admin_id']);

                redirect('dashboard', 'refresh');
            } else {

                $this->session->set_flashdata('error', '<div class="alert alert-danger">Please Enter Valid Credential.</div>');

                redirect('login', 'refresh');
            }
        } else {

            $this->session->set_flashdata('error', '<div class="alert alert-danger">Please Enter Valid Login Detail.</div>');

            redirect('login', 'refresh');
        }
    }

    public function logout() {

        if ($this->session->userdata('aileenuser')) {

            $this->session->unset_userdata('aileenuser');

            redirect('main', 'refresh');
        }
    }

// cover pic controller

    public function ajaxpro() {
        $userid = $this->session->userdata('aileenuser');


        $contition_array = array('user_id' => $userid);
        $user_reg_data = $this->common->select_data_by_condition('user', $contition_array, $data = 'profile_background,profile_background_main', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        $user_reg_prev_image = $user_reg_data[0]['profile_background'];
        $user_reg_prev_main_image = $user_reg_data[0]['profile_background_main'];

        if ($user_reg_prev_image != '') {
            $user_image_main_path = $this->config->item('user_bg_main_upload_path');
            $user_bg_full_image = $user_image_main_path . $user_reg_prev_image;
            if (isset($user_bg_full_image)) {
                unlink($user_bg_full_image);
            }
            
            $user_image_thumb_path = $this->config->item('user_bg_thumb_upload_path');
            $user_bg_thumb_image = $user_image_thumb_path . $user_reg_prev_image;
            if (isset($user_bg_thumb_image)) {
                unlink($user_bg_thumb_image);
            }
        }
        if ($user_reg_prev_main_image != '') {
            $user_image_original_path = $this->config->item('user_bg_original_upload_path');
            $user_bg_origin_image = $user_image_original_path . $user_reg_prev_main_image;
            if (isset($user_bg_origin_image)) {
                unlink($user_bg_origin_image);
            }
        }
        
        $data = $_POST['image'];

// $img = str_replace('data:image/png;base64,', '', $img);
// $img = str_replace(' ', '+', $img);
// $data = base64_decode($img);
//echo  $data;
// $file = $upload_dir . mktime() . ".png";
// $success = file_put_contents($file, $data);
// print $success ? $file : 'Unable to save the file.';
// die();
//$data = base64_encode($data);
//$imageName = time().'.png';

        $user_bg_path = $this->config->item('user_bg_main_upload_path');
        $imageName = time() . '.png';
        $base64string = $data;
        file_put_contents($user_bg_path . $imageName, base64_decode(explode(',', $base64string)[1]));

        $user_thumb_path = $this->config->item('user_bg_thumb_upload_path');
        $user_thumb_width = $this->config->item('user_bg_thumb_width');
        $user_thumb_height = $this->config->item('user_bg_thumb_height');

        $upload_image = $user_bg_path . $imageName;

        $thumb_image_uplode = $this->thumb_img_uplode($upload_image, $imageName, $user_thumb_path, $user_thumb_width, $user_thumb_height);

        $data = array(
            'profile_background' => $imageName
        );

        $update = $this->common->update_data($data, 'user', 'user_id', $userid);
        $this->data['userdata'] = $this->common->select_data_by_id('user', 'user_id', $userid, $data = '*', $join_str = array());

        echo '<img src="' . $this->data['userdata'][0]['profile_background'] . '" />';
    }

    public function image() {
        $userid = $this->session->userdata('aileenuser');

        $config['upload_path'] = $this->config->item('user_bg_original_upload_path');
        $config['allowed_types'] = $this->config->item('user_bg_allowed_types');
        $config['file_name'] = $_FILES['image']['name'];

        //Load upload library and initialize configuration
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        //echo $this->upload->do_upload('photo'); die();
        if ($this->upload->do_upload('image')) {

            $uploadData = $this->upload->data();
            //$picture = $uploadData['file_name']."-".date("Y_m_d H:i:s");
            $image = $uploadData['file_name'];
            //echo $certificate;die();
        } else {
            // echo "welcome";die();
            $image = '';
        }


        $data = array(
            'profile_background_main' => $image,
            'modified_date' => date('Y-m-d h:i:s', time())
        );
        //  echo "<pre>"; print_r($data); die();

        $updatedata = $this->common->update_data($data, 'user', 'user_id', $userid);

        if ($updatedata) {
            echo $userid;
        } else {
            echo "welcome";
        }
    }

    // cover pic end
// resend email for account verify start

    public function resendverifyaccount() {  //echo "falguni"; die();
        $userid = $this->session->userdata('aileenuser');
        $userdata = $this->common->select_data_by_id('user', 'user_id', $userid, $data = '*', $join_str = array());

        $email = $userdata[0]['user_email'];
        //echo $email;die();
        // $to= $userdata[0]['user_email']; 
        $toemail = "raval.khyati13@gmail.com";


        $msg = "Hey !" . $userdata[0]['user_name'] . "<br/>";
        // $msg .=  $userdata[0]['first_name'] .$userdata[0]['last_name']. ',';
        // $msg .= 'Click hear to verify your account';
        // $msg .= "<br>"; 
        // $msg .= "<b><u><a href=" .  base_url('registration/verify/' . $userid) . ">click here</a></b></u>";

        $msg = "hi falgui";

        $subject = "Verify Your Account";


        $mail = $this->email_model->do_email($msg, $subject, $toemail, $from);

        if ($mail) {
            echo "hello";
            die();
        }

        //   if(!$mail) { 
        //  $allowedgmail =  array('gmail.com');
        //  $varifyemail = $userdata[0]['user_email'];
        //  $splitemail = split ("\@", $varifyemail);
        // if(in_array($splitemail[1],$allowedgmail)){ 
        //   redirect('https://accounts.google.com', refresh);
        //  }else{
        //    redirect('https://login.yahoo.com', refresh);
        //  }
        // } 
    }

// resend email for account verify end 
    public function template(){ // echo "hoi"; die();
        
    $mail = $this->email_model->sendEmail();

    if($mail){
      echo 1; die();
    }else{
       echo 2; die();
    }
                
        //$this->load->view('dashboard/template');
    }
}
 