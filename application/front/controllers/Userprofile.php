<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Userprofile extends MY_Controller {

    public $data;

    public function __construct() {
        parent::__construct();
        $this->load->model('email_model');
        $this->load->model('user_model');
        $this->load->model('userprofile_model');
        $this->load->model('user_post_model');
        $this->load->model('data_model');
        $this->load->library('S3');
        $this->load->library('form_validation');
        //  include('userprofile_include.php');
        $this->data['no_user_post_html'] = '<div class="user_no_post_avl"><h3>Feed</h3><div class="user-img-nn"><div class="user_no_post_img"><img src=' . base_url('assets/img/bui-no.png?ver=' . time()) . ' alt="bui-no.png"></div><div class="art_no_post_text">No Feed Available.</div></div></div>';
        $this->data['no_user_contact_html'] = '<div class="art-img-nn"><div class="art_no_post_img"><img src="' . base_url('assets/img/No_Contact_Request.png?ver=' . time()) . '"></div><div class="art_no_post_text">No Contacts Available.</div></div>';
    }

    public function index() {
      $this->data['slug'] =  $slug = $this->session->userdata('aileenuser_slug');
        $userid = $this->session->userdata('aileenuser');
        $seg_slug = $this->uri->segment(2);
        
        if($seg_slug == $slug){
            $userslug = $slug;
        }else{
            $userslug = $seg_slug;
        }
        $userdata = $this->data['userdata'] = $this->user_model->getUserDataByslug($userslug, $datat = "u.user_id,u.first_name,u.last_name,u.user_dob,u.user_gender,u.user_agree,u.created_date,u.verify_date,u.user_verify,u.user_slider,u.user_slug,ui.user_image,ui.modify_date,ui.edit_ip,ui.profile_background,ui.profile_background_main,ul.email,ul.password,ul.is_delete,ul.status,ul.password_code");
        $this->data['is_userBasicInfo'] = $this->user_model->getUserProfessionDataBySlug($userslug, $data = "jt.name as Designation,it.industry_name as Industry,c.city_name as City");
        $this->data['is_userStudentInfo'] = $this->user_model->getUserStudentDataBySlug($userslug, $data = "d.degree_name as Degree,u.university_name as University,c.city_name as City");
        $this->data['is_userPostCount'] = $this->user_post_model->userPostCountBySlug($userslug);
        
       $is_userContactInfo = $this->userprofile_model->userContactStatus($userid, $userdata['user_id']);
        $is_userFollowInfo = $this->userprofile_model->userFollowStatus($userid, $userdata['user_id']);
            $this->data['to_id'] = $userdata['user_id'];
       
       if (count($is_userContactInfo) != 0) { 
            $this->data['contact_status'] = 1;
          $this->data['contact_value'] = $is_userContactInfo['status'];
            $this->data['contact_id'] = $is_userContactInfo['id'];
        } else {
          $this->data['contact_value'] = 'new';
            $this->data['contact_status'] = 0;
            $this->data['contact_id'] = $is_userContactInfo['id'];
        }

        if (count($is_userFollowInfo) != 0) {
            $this->data['follow_status'] = 1;
            $this->data['follow_id'] = $is_userFollowInfo['id'];
            $this->data['follow_value'] = $is_userFollowInfo['status'];
        } else {
            $this->data['follow_value'] = 'new';
            $this->data['follow_id'] = $is_userFollowInfo['id'];
            $this->data['follow_status'] = 0;
        }

        $this->data['header'] = $this->load->view('userprofile/header', $this->data, TRUE);
        $this->data['footer'] = $this->load->view('userprofile/footer', $this->data, TRUE);
        $this->data['title'] = "Basic Information | Aileensoul";
        if (count($userdata) > 0) {
            $this->load->view('userprofile/index', $this->data);
        } else {
            $this->load->view('userprofile/notavalible');
        }
    }

}
