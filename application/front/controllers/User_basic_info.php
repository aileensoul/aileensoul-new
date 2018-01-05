<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class User_basic_info extends MY_Controller {

    public $data;

    public function __construct() {

        parent::__construct();
        $this->load->model('email_model');
        $this->load->model('user_model');
        $this->load->library('S3');
    }

    public function index() {
        $userid = $this->session->userdata('aileenuser');
        $userdata = $this->data['userdata'] = $this->user_model->getUserSelectedData($userid, $select_data = "u.first_name,u.last_name,ui.user_image");

        $this->data['header_profile'] = $this->load->view('header_profile', $this->data, TRUE);
        $this->data['login_footer'] = $this->load->view('login_footer', $this->data, TRUE);
        $this->data['footer'] = $this->load->view('footer', $this->data, TRUE);
        $this->data['title'] = "Basic Information | Aileensoul";
        $this->load->view('user_basic_info/index', $this->data);
    }

    public function ng_basic_info_insert() {
        $userid = $this->session->userdata('aileenuser');

        $errors = array();
        $data = array();

        $_POST = json_decode(file_get_contents('php://input'), true);

        if (empty($_POST['jobTitle']))
            $errors['jobTitle'] = 'Job title is required.';

        if (empty($_POST['cityList']))
            $errors['cityList'] = 'City is required.';

        if (empty($_POST['field']))
            $errors['field'] = 'Field is required.';
        
        if ($_POST['field'] == '0') {
            if (empty($_POST['otherField']))
                $errors['otherField'] = 'Other field is required.';
        }
        if (!empty($errors)) {
            $data['errors'] = $errors;
        } else {
            if ($_POST['busreg_step'] == '0' || $_POST['busreg_step'] == '') {
                $data['company_name'] = $_POST['companyname'];
                $data['country'] = $_POST['country_id'];
                $data['state'] = $_POST['state_id'];
                $data['city'] = $_POST['city_id'];
                $data['pincode'] = $_POST['pincode'];
                $data['address'] = $_POST['business_address'];
                $data['user_id'] = $userid;
                $data['business_slug'] = $this->setcategory_slug($data['company_name'], 'business_slug', 'business_profile');
                $data['created_date'] = date('Y-m-d H:i:s', time());
                $data['status'] = '1';
                $data['is_deleted'] = '0';
                $data['business_step'] = '1';

                $insert_id = $this->common->insert_data_getid($data, 'business_profile');
                if ($insert_id) {
                    $data['is_success'] = 1;
                } else {
                    $data['is_success'] = 0;
                }
            } else {
                $data['company_name'] = $_POST['companyname'];
                $data['country'] = $_POST['country_id'];
                $data['state'] = $_POST['state_id'];
                $data['city'] = $_POST['city_id'];
                $data['pincode'] = $_POST['pincode'];
                $data['address'] = $_POST['business_address'];
                $data['modified_date'] = date('Y-m-d H:i:s', time());
                $updatdata = $this->common->update_data($data, 'business_profile', 'user_id', $userid);
                if ($updatdata) {
                    $data['is_success'] = 1;
                } else {
                    $data['is_success'] = 0;
                }
            }
        }
// response back.
        echo json_encode($data);
    }

    public function autocomplete() {

        $this->load->view('autoselecteasy', $this->data);
    }

}
