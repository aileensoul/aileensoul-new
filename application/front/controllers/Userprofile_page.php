<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Userprofile_page extends MY_Controller {

    public $data;

    public function __construct() {
        parent::__construct();
        $this->load->library('S3');
        $this->load->library('form_validation');

        $this->load->model('user_model');
        $this->load->model('userprofile_model');
    }

    public function profile() {
        $this->load->view('userprofile/profiles', $this->data);
    }

    public function dashboard() {
        $this->load->view('userprofile/dashboard', $this->data);
    }

    public function details() {

        $this->load->view('userprofile/details', $this->data);
    }

    public function contacts() {
        $this->load->view('userprofile/contacts', $this->data);
    }

    public function followers() {
        $this->load->view('userprofile/followers', $this->data);
    }

    public function following() {
        $this->load->view('userprofile/following', $this->data);
    }
    
    public function contact_request() {
        $userid = $this->session->userdata('aileenuser');
        $this->data['userdata'] = $this->user_model->getUserSelectedData($userid, $select_data = "u.first_name,u.last_name,ui.user_image");
        
        $this->data['is_userBasicInfo'] = $this->user_model->is_userBasicInfo($userid);
        $this->data['is_userStudentInfo'] = $this->user_model->is_userStudentInfo($userid);
        
        $this->data['header_profile'] = $this->load->view('header_profile', $this->data, TRUE);
        $this->load->view('userprofile/contact_request', $this->data);
    }
    public function pending_contact_request(){
        $userid = $this->session->userdata('aileenuser');
        $pendingContactRequest = $this->user_model->contact_request_pending($userid);
        echo json_encode($pendingContactRequest);
    }
    public function contactRequestNotification(){
        $userid = $this->session->userdata('aileenuser');
        $contactRequestNotification = $this->user_model->contact_request_accept($userid);
        echo json_encode($contactRequestNotification);
    }
    
    public function detail_data() {
        $userid = $this->session->userdata('aileenuser');
        $is_basicInfo = $this->data['is_basicInfo'] = $this->user_model->is_userBasicInfo($userid);
        if ($is_basicInfo == 0) {
            $detailsData = $this->data['detailsData'] = $this->user_model->getUserStudentData($userid, $data = "d.degree_name as Degree,u.university_name as University,c.city_name as City,usr.first_name as First name,usr.last_name as Last name,usr.user_dob as DOB");
        } else {
            $detailsData = $this->data['detailsData'] = $this->user_model->getUserProfessionData($userid, $data = "jt.name as Designation,it.industry_name as Industry,c.city_name as City,usr.first_name as First name,usr.last_name as Last name,usr.user_dob as DOB");
        }

        echo json_encode($detailsData);
    }

    public function profiles_data() {
        $userid = $this->session->userdata('aileenuser');
        $profilesData = $this->data['profilesData'] = $this->userprofile_model->getDashboardData($userid, $data = "a.status as ap_status,a.art_step as ap_step,a.is_delete as ap_delete,r.re_status as rp_status,r.is_delete as rp_delete,r.re_step as rp_step,jr.is_delete as jp_delete,jr.status as jp_status,jr.job_step as jp_step,bp.status as bp_status,bp.is_deleted as bp_delete,bp.business_step as bp_step,fh.status as fh_status,fh.is_delete as fh_delete,fh.free_hire_step as fh_step,fp.status as fp_status,fp.is_delete as fp_delete,fp.free_post_step as fp_step");
        echo json_encode($profilesData);
    }

    public function followers_data() {
        $userid = $this->session->userdata('aileenuser');
        $followersData = $this->data['followersData'] = $this->userprofile_model->getFollowersData($userid, $data = "");
        echo json_encode($followersData);
    }
    
    public function contacts_data() {
        $userid = $this->session->userdata('aileenuser');
        $contactsData = $this->data['contactsData'] = $this->userprofile_model->getContactData($userid, $data = "");
       if(count($contactsData) == 0){
           echo count($contactsData);
       }else{
        echo json_encode($contactsData);
       }
    }
    
    public function following_data() {
        $userid = $this->session->userdata('aileenuser');
        $followingData = $this->data['followingData'] = $this->userprofile_model->getFollowingData($userid, $data = "");
        if(count($followingData) == 0){
           echo count($followingData);
       }else{
        echo json_encode($followingData);
       }
    }

    public function vsrepeat() {
        $this->load->view('vsrepeat');
    }

    public function vsrepeat_data() {
        $this->db->select('first_name as name,user_id as id');
        $this->db->from('user');
        $this->db->limit('50');
        $query = $this->db->get();
        $data = $query->result_array();
        echo json_encode($data);
    }

    public function removeContacts() {
        $userid = $this->session->userdata('aileenuser');
        $id = $_POST['id'];
        $remove = $this->data['remove'] = $this->userprofile_model->userContactStatus($userid, $id);

        if (count($remove) != 0) {
            $data = array('status' => 'cancel');
            $insert_id = $this->common->update_data($data, 'user_contact', 'id', $remove['id']);
            $response = 1;
        } else {
            $response = 0;
        }
        $contactdata = $this->userprofile_model->getContactCount($userid);
      
        $removjson['response'] = $response;
        $removjson['contactcount'] = $contactdata[0]['total'];
        echo json_encode($removjson);
    }
    
    public function unfollowingContacts() {
        $userid = $this->session->userdata('aileenuser');
        $id = $_POST['to_id'];
        $follow = $this->userprofile_model->userFollowStatus($userid, $id);
        if (count($follow) != 0) {
            $data = array('status' => '0');
            $insert_id = $this->common->update_data($data, 'user_follow', 'id', $follow['id']);
           $response = 1; 
            } else {
            $response = 0;
        }
        $followingdata = $this->userprofile_model->getFollowingCount($userid);
      
        $unfollowingjson['response'] = $response;
        $unfollowingjson['unfollowingcount'] = $followingdata[0]['total'];

        echo json_encode($unfollowingjson);
    }
    
    public function addcontact() { 
        $userid = $this->session->userdata('aileenuser');
        $contact_id = $_POST['contact_id'];
        $status = $_POST['status'];
        $id = $_POST['to_id'];
        $contact =  $this->userprofile_model->userContactStatus($userid, $id);

        if (count($contact) != 0) {
            $data = array('status' => $status,'modify_date' => date('Y-m-d H:i:s',time()));
            $insert_id = $this->common->update_data($data, 'user_contact', 'id', $contact['id']);
            $response = $status;
        } else {
            $data = array(
                 'status' => $status,
                 'from_id' => $userid,
                 'to_id' => $id,
                 'not_read' => '2',
                 'created_date' => date('Y-m-d H:i:s',time()),
                 'modify_date' => date('Y-m-d H:i:s',time()),
                 );
            $insert_id = $this->common->insert_data($data, 'user_contact');
            $response = $status;
        }
        echo $response;
    }
    
    public function addfollow() { 
        $userid = $this->session->userdata('aileenuser');
        $follow_id = $_POST['follow_id'];
        $status = $_POST['status'];
        $id = $_POST['to_id'];
        $follow = $this->userprofile_model->userFollowStatus($userid, $id);

        if (count($follow) != 0) {
            $data = array('status' => $status);
            $insert_id = $this->common->update_data($data, 'user_follow', 'id', $follow['id']);
            $response = $status;
        }else{
             $data = array(
                 'status' => $status,
                 'follow_from' => $userid,
                 'follow_to' => $id,
                 'created_date' => $status,
                 );
            $insert_id = $this->common->insert_data($data, 'user_follow');
            $response = $status;
        }
        echo $response;
    }
    
    public function follow_user() { 
        $userid = $this->session->userdata('aileenuser');
        $follow_id = $_POST['follow_id'];
        $id = $_POST['to_id'];
        $follow = $this->userprofile_model->userFollowStatus($userid, $id);

        if (count($follow) != 0) {
            $data = array('status' => '1');
            $insert_id = $this->common->update_data($data, 'user_follow', 'id', $follow['id']);
         //   $response = $status;
            
            $html = '<a class="btn3"  ng-click="unfollow_user(' .$id.')">Following</a>';
            
            }else{
             $data = array(
                 'status' => '1',
                 'follow_from' => $userid,
                 'follow_to' => $id,
                 'created_date' => date("Y-m-d h:i:s"),
                 );
            $insert_id = $this->common->insert_data($data, 'user_follow');
           // $response = $status;
            $html = '<a class="btn3"  ng-click="unfollow_user(' .$id.')">Following</a>';
        }
        
       
        echo $html;
    }
    
    
    public function unfollow_user() { 
        $userid = $this->session->userdata('aileenuser');
        $follow_id = $_POST['follow_id'];
        $id = $_POST['to_id'];
        $follow = $this->userprofile_model->userFollowStatus($userid, $id);

        if (count($follow) != 0) {
            $data = array('status' => 0);
            $insert_id = $this->common->update_data($data, 'user_follow', 'id', $follow['id']);
         //   $response = $status;
            
            $html = '<a class="btn3"  ng-click="follow_user(' .$id.')">Follow</a>';
            
            }else{
             $data = array(
                 'status' => 0,
                 'follow_from' => $userid,
                 'follow_to' => $id,
                 'created_date' => $status,
                 );
            $insert_id = $this->common->insert_data($data, 'user_follow');
           // $response = $status;
            $html = '<a class="btn3"  ng-click="follow_user(' .$id.')">Follow</a>';
        }
        
       
        echo $html;
    }
    
    
    
      //PROFILE PIC INSERT END  

    public function user_image_insert1() {
        $userslug = $this->session->userdata('aileenuser_slug');
        $userdata  = $this->user_model->getUserDataByslug($userslug,$data='ui.user_image,u.user_slug,u.user_id');

        $user_prev_image = $userdata['user_image'];

        if ($user_prev_images != '') {
            $user_image_main_path = $this->config->item('user_main_upload_path');
            $user_img_full_image = $user_image_main_path . $user_prev_images;
            if (isset($user_img_full_image)) {
                unlink($user_img_full_image);
            }

            $user_image_thumb_path = $this->config->item('user_thumb_upload_path');
            $user_bg_thumb_image = $user_image_thumb_path . $user_prev_image;
            if (isset($user_bg_thumb_image)) {
                unlink($user_bg_thumb_image);
            }
        }


        $data = $_POST['image'];
        list($type, $data) = explode(';', $data);
        list(, $data) = explode(',', $data);
        $user_bg_path = $this->config->item('user_main_upload_path');
        $imageName = time() . '.png';
        $data = base64_decode($data);
        $file = $user_bg_path . $imageName;
        file_put_contents($user_bg_path . $imageName, $data);
        $success = file_put_contents($file, $data);
        $main_image = $user_bg_path . $imageName;
        $main_image_size = filesize($main_image);

        if ($main_image_size > '1000000') {
            $quality = "50%";
        } elseif ($main_image_size > '50000' && $main_image_size < '1000000') {
            $quality = "55%";
        } elseif ($main_image_size > '5000' && $main_image_size < '50000') {
            $quality = "60%";
        } elseif ($main_image_size > '100' && $main_image_size < '5000') {
            $quality = "65%";
        } elseif ($main_image_size > '1' && $main_image_size < '100') {
            $quality = "70%";
        } else {
            $quality = "100%";
        }


        /* RESIZE */
        $freelancer_hire_profile['image_library'] = 'gd2';
        $freelancer_hire_profile['source_image'] = $main_image;
        $freelancer_hire_profile['new_image'] = $main_image;
        $freelancer_hire_profile['quality'] = $quality;
        $instanse10 = "image10";
        $this->load->library('image_lib', $freelancer_hire_profile, $instanse10);
        /* RESIZE */

        $s3 = new S3(awsAccessKey, awsSecretKey);
        $s3->putBucket(bucket, S3::ACL_PUBLIC_READ);
        $abc = $s3->putObjectFile($main_image, bucket, $main_image, S3::ACL_PUBLIC_READ);

        $user_thumb_path = $this->config->item('user_thumb_upload_path');
        $user_thumb_width = $this->config->item('user_thumb_width');
        $user_thumb_height = $this->config->item('user_thumb_height');

        $upload_image = $user_bg_path . $imageName;

        $thumb_image_uplode = $this->thumb_img_uplode($upload_image, $imageName, $user_thumb_path, $user_thumb_width, $user_thumb_height);

        $thumb_image = $user_thumb_path . $imageName;
        $abc = $s3->putObjectFile($thumb_image, bucket, $thumb_image, S3::ACL_PUBLIC_READ);

        $data = array(
            'user_image' => $imageName
        );

        $update = $this->common->update_data($data, 'user_info', 'user_id', $userdata['user_id']);

        if ($update) {
             $userdata  = $this->user_model->getUserDataByslug($userslug,$data='ui.user_image');
 
               $userimage .= '<img src="' . USER_THUMB_UPLOAD_URL . $userdata['user_image'] . '">';
               $userimage .= '<a class="upload-profile cusome_upload" href="javascript:void(0);" onclick="updateprofilepopup();" title="Update profile picture">
                            <img src="' . base_url('assets/n-images/cam.png') . '"  alt="' . CAMERAIMAGE . '">Update Profile Picture
                        </a>';
            echo $userimage;
        } else {

            $this->session->flashdata('error', 'Your data not inserted');
            redirect('profiless/' . $userdata['user_slug'], refresh);
        }
    }
   
    // cover pic controller
    public function ajaxpro() {

        $userid = $this->session->userdata('aileenuser');
        $user_reg_data = $this->userprofile_model->getUserBackImage($userid);

        $user_reg_prev_image = $user_reg_data['profile_background'];
        $user_reg_prev_main_image = $user_reg_data['profile_background_main'];

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
        $data = str_replace('data:image/png;base64,', '', $data);
        $data = str_replace(' ', '+', $data);
        $user_bg_path = $this->config->item('user_bg_main_upload_path');
        $imageName = time() . '.png';
        $data = base64_decode($data);
        $file = $user_bg_path . $imageName;
        $success = file_put_contents($file, $data);

        $main_image = $user_bg_path . $imageName;
        $main_image_size = filesize($main_image);

        if ($main_image_size > '1000000') {
            $quality = "50%";
        } elseif ($main_image_size > '50000' && $main_image_size < '1000000') {
            $quality = "55%";
        } elseif ($main_image_size > '5000' && $main_image_size < '50000') {
            $quality = "60%";
        } elseif ($main_image_size > '100' && $main_image_size < '5000') {
            $quality = "65%";
        } elseif ($main_image_size > '1' && $main_image_size < '100') {
            $quality = "70%";
        } else {
            $quality = "100%";
        }

        $s3 = new S3(awsAccessKey, awsSecretKey);
        $s3->putBucket(bucket, S3::ACL_PUBLIC_READ);
        $abc = $s3->putObjectFile($main_image, bucket, $main_image, S3::ACL_PUBLIC_READ);

        $user_thumb_path = $this->config->item('user_bg_thumb_upload_path');
        $user_thumb_width = $this->config->item('user_bg_thumb_width');
        $user_thumb_height = $this->config->item('user_bg_thumb_height');

        $upload_image = $user_bg_path . $imageName;
        $thumb_image_uplode = $this->thumb_img_uplode($upload_image, $imageName, $user_thumb_path, $user_thumb_width, $user_thumb_height);

        $thumb_image = $user_thumb_path . $imageName;
        $abc = $s3->putObjectFile($thumb_image, bucket, $thumb_image, S3::ACL_PUBLIC_READ);

        $data = array(
            'profile_background' => $imageName
        );

        $update = $this->common->update_data($data, 'user_info', 'user_id', $userid);

        $user_reg_data = $this->userprofile_model->getUserBackImage($userid);
        $user_reg_back_image = $user_reg_data['profile_background'];

//        echo '<img src = "' . $this->data['busdata'][0]['profile_background'] . '" />';
        $coverpic = '  <div class="bg-images"><img id="image_src" name="image_src" src = "' . USER_BG_MAIN_UPLOAD_URL . $user_reg_back_image . '" /></div>';

        echo $coverpic;
    }

}
