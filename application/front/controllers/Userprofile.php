<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Userprofile extends MY_Controller {

    public $data;

    public function __construct() {
        parent::__construct();
        $this->load->model('email_model');
        $this->load->model('user_model');
        $this->load->model('data_model');
        $this->load->library('S3');
        $this->load->library('form_validation');
        //  include('userprofile_include.php');
    }

    public function index() {
        $slug = $this->session->userdata('aileenuser_slug');
        $userid = $this->session->userdata('aileenuser');
        $userslug = $this->uri->segment(2);
        $userdata = $this->data['userdata'] = $this->user_model->getUserDataByslug($userslug,$datat="u.user_id,u.first_name,u.last_name,u.user_dob,u.user_gender,u.user_agree,u.created_date,u.verify_date,u.user_verify,u.user_slider,u.user_slug,ui.user_image,ui.modify_date,ui.edit_ip,ui.profile_background,ui.profile_background_main,ul.email,ul.password,ul.is_delete,ul.status,ul.password_code");

        $this->data['is_userBasicInfo'] = $this->user_model->getUserProfessionDataBySlug($userslug,$data="jt.name as Designation,it.industry_name as Industry,c.city_name as City");
        $this->data['is_userStudentInfo'] = $this->user_model->getUserStudentDataBySlug($userslug,$data="d.degree_name as Degree,u.university_name as University,c.city_name as City");
     
        $this->data['header'] = $this->load->view('userprofile/header', $this->data, TRUE);
        $this->data['footer'] = $this->load->view('userprofile/footer', $this->data, TRUE);
        $this->data['title'] = "Basic Information | Aileensoul";
        if(count($userdata) > 0){
        $this->load->view('userprofile/index', $this->data);
        }else{
       $this->load->view('userprofile/notavalible');
        }
    }

}
