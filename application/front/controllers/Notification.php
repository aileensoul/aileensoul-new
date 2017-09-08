<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Notification extends MY_Controller {

    public $data;

    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('email_model');

        // if ($this->session->userdata('aileensoul_front') == '') {
        //           redirect('login', 'refresh');
        //       }
        include ('include.php');
    }

    // public function index() {
    //     $this->load->view('Notification/index', $this->data);
    // }
    public function index() {
        $userid = $this->session->userdata('aileenuser');
// 1-5 notification start
// recruiter notfication start 

        $contition_array = array('notification.not_type' => 3, 'notification.not_to_id' => $userid, 'notification.not_from' => 2, 'created_date BETWEEN DATE_SUB(NOW(), INTERVAL 2 MONTH) AND NOW()');
        $join_str = array(array(
                'join_type' => '',
                'table' => 'job_apply',
                'join_table_id' => 'notification.not_product_id',
                'from_table_id' => 'job_apply.app_id'),
            array(
                'join_type' => '',
                'table' => 'job_reg',
                'join_table_id' => 'notification.not_from_id',
                'from_table_id' => 'job_reg.user_id')
        );
        $data = array('notification.*', 'job_apply.*', 'job_reg.user_id as user_id', 'job_reg.fname as first_name', 'job_reg.job_user_image as user_image', 'job_reg.lname as last_name');
        $rec_not = $this->data['rec_not'] = $this->common->select_data_by_condition('notification', $contition_array, $data, $sortby = 'app_id', $orderby = 'desc', $limit = '', $offset = '', $join_str, $groupby = '');
// recruiter notification end
// job notfication start 

        $contition_array = array('notification.not_type' => 4, 'notification.not_to_id' => $userid, 'created_date BETWEEN DATE_SUB(NOW(), INTERVAL 2 MONTH) AND NOW()');
        $join_str = array(array(
                'join_type' => '',
                'table' => 'job_apply',
                'join_table_id' => 'notification.not_product_id',
                'from_table_id' => 'job_apply.app_id'),
            array(
                'join_type' => '',
                'table' => 'recruiter',
                'join_table_id' => 'notification.not_from_id',
                'from_table_id' => 'recruiter.user_id')
        );
        $data = array('notification.*', ' job_apply.*', ' recruiter.user_id as user_id', 'recruiter.rec_firstname as first_name', 'recruiter.recruiter_user_image as user_image', 'recruiter.rec_lastname as last_name');

        $job_not = $this->data['job_not'] = $this->common->select_data_by_condition('notification', $contition_array, $data, $sortby = 'app_id', $orderby = 'desc', $limit = '', $offset = '', $join_str, $groupby = '');

// job notification end
// freelancer hire  notification start
        $contition_array = array('notification.not_type' => 3, 'notification.not_from' => 4, 'notification.not_to_id' => $userid, 'created_date BETWEEN DATE_SUB(NOW(), INTERVAL 2 MONTH) AND NOW()');

        $join_str = array(
            array(
                'join_type' => '',
                'table' => 'freelancer_apply',
                'join_table_id' => 'notification.not_product_id',
                'from_table_id' => 'freelancer_apply.app_id'),
            array(
                'join_type' => '',
                'table' => 'freelancer_post_reg',
                'join_table_id' => 'notification.not_from_id',
                'from_table_id' => 'freelancer_post_reg.user_id')
        );
        $data = array('notification.*', 'freelancer_apply.*', ' freelancer_post_reg.user_id as user_id', 'freelancer_post_reg.freelancer_post_fullname as first_name', 'freelancer_post_reg.freelancer_post_user_image as user_image', 'freelancer_post_reg.freelancer_post_username as last_name');

        $hire_not = $this->data['hire_noth'] = $this->common->select_data_by_condition('notification', $contition_array, $data, $sortby = 'app_id', $orderby = 'desc', $limit = '', $offset = '', $join_str, $groupby = '');
        // freelancer hire notification end
// freelancer post notification start
        // $this->data['work_post'] = $this->common->select_data_by_condition('notification', $contition_array, $data, $sortby = 'app_id', $orderby = 'desc', $limit = '', $offset = '', $join_str, $groupby = '');
//echo '<pre>'; print_r($hire_not); die();
        $contition_array = array('notification.not_type' => 4, 'notification.not_from' => 5, 'notification.not_to_id' => $userid, 'created_date BETWEEN DATE_SUB(NOW(), INTERVAL 2 MONTH) AND NOW()');
        $join_str = array(array(
                'join_type' => '',
                'table' => 'user_invite',
                'join_table_id' => 'notification.not_product_id',
                'from_table_id' => 'user_invite.invite_id'),
            array(
                'join_type' => '',
                'table' => 'freelancer_hire_reg',
                'join_table_id' => 'notification.not_from_id',
                'from_table_id' => 'freelancer_hire_reg.user_id')
        );
        $data = array('notification.*', ' user_invite.*', 'freelancer_hire_reg.user_id as user_id', 'freelancer_hire_reg.fullname as first_name', 'freelancer_hire_reg.freelancer_hire_user_image as user_image', 'freelancer_hire_reg.username as last_name');

        $work_post = $this->data['work_post'] = $work_post = $this->common->select_data_by_condition('notification', $contition_array, $data, $sortby = 'invite_id', $orderby = 'desc', $limit = '', $offset = '', $join_str, $groupby = '');


// freelancer post notification end
//artistic notification start
// follow notification start

        $contition_array = array('notification.not_type' => 8, 'notification.not_from' => 3, 'notification.not_to_id' => $userid, 'created_date BETWEEN DATE_SUB(NOW(), INTERVAL 2 MONTH) AND NOW()');
        $join_str = array(array(
                'join_type' => '',
                'table' => 'follow',
                'join_table_id' => 'notification.not_product_id',
                'from_table_id' => 'follow.follow_id'),
            array(
                'join_type' => '',
                'table' => 'art_reg',
                'join_table_id' => 'notification.not_from_id',
                'from_table_id' => 'art_reg.user_id')
        );
        $data = array('notification.*', ' follow.*', ' art_reg.user_id as user_id', 'art_reg.art_name as first_name', 'art_reg.art_user_image as user_image', 'art_reg.art_lastname as last_name');

        $artfollow = $this->data['artfollow'] = $this->common->select_data_by_condition('notification', $contition_array, $data, $sortby = 'follow_id', $orderby = 'desc', $limit = '', $offset = '', $join_str, $groupby = '');
//echo '<pre>'; print_r($this->data['artfollow']); die();
// follow notification end
//post comment notification start

        $contition_array = array('notification.not_type' => 6, 'not_img' => 1, 'notification.not_from' => 3, 'notification.not_to_id' => $userid, 'created_date BETWEEN DATE_SUB(NOW(), INTERVAL 2 MONTH) AND NOW()');
        $join_str = array(array(
                'join_type' => '',
                'table' => 'artistic_post_comment',
                'join_table_id' => 'notification.not_product_id',
                'from_table_id' => 'artistic_post_comment.artistic_post_comment_id'),
            array(
                'join_type' => '',
                'table' => 'art_reg',
                'join_table_id' => 'notification.not_from_id',
                'from_table_id' => 'art_reg.user_id')
        );
        $data = array('notification.*', ' artistic_post_comment.*', 'art_reg.user_id as user_id', 'art_reg.art_name as first_name', 'art_reg.art_user_image as user_image', 'art_reg.art_lastname as last_name');
        $artcommnet = $this->data['artcommnet'] = $this->common->select_data_by_condition('notification', $contition_array, $data, $sortby = 'artistic_post_comment_id', $orderby = 'desc', $limit = '', $offset = '', $join_str, $groupby = '');
// comment notification end
//post like notification start
        $contition_array = array('notification.not_type' => 5, 'notification.not_from' => 3, 'not_img' => 2, 'notification.not_to_id' => $userid, 'created_date BETWEEN DATE_SUB(NOW(), INTERVAL 2 MONTH) AND NOW()');
        $join_str = array(array(
                'join_type' => '',
                'table' => 'art_post',
                'join_table_id' => 'notification.not_product_id',
                'from_table_id' => 'art_post.art_post_id'),
            array(
                'join_type' => '',
                'table' => 'art_reg',
                'join_table_id' => 'notification.not_from_id',
                'from_table_id' => 'art_reg.user_id')
        );
        $data = array('notification.*', 'art_post.*', 'art_reg.user_id as user_id', 'art_reg.art_name as first_name', 'art_reg.art_user_image as user_image', 'art_reg.art_lastname as last_name');
        $artlike = $this->data['artlike'] = $this->common->select_data_by_condition('notification', $contition_array, $data, $sortby = 'art_post_id', $orderby = 'desc', $limit = '', $offset = '', $join_str, $groupby = '');

        $contition_array = array('notification.not_type' => 5, 'not_img' => 5, 'notification.not_from' => 3, 'notification.not_to_id' => $userid, 'created_date BETWEEN DATE_SUB(NOW(), INTERVAL 2 MONTH) AND NOW()');
        $join_str = array(array(
                'join_type' => '',
                'table' => 'post_image',
                'join_table_id' => 'notification.not_product_id',
                'from_table_id' => 'post_image.image_id'),
            array(
                'join_type' => '',
                'table' => 'art_reg',
                'join_table_id' => 'notification.not_from_id',
                'from_table_id' => 'art_reg.user_id')
        );
        $data = array('notification.*', 'post_image.*', 'art_reg.user_id as user_id', 'art_reg.art_name as first_name', 'art_reg.art_user_image as user_image', 'art_reg.art_lastname as last_name');
        $artimglike = $this->data['artimglike'] = $this->common->select_data_by_condition('notification', $contition_array, $data, $sortby = 'image_id', $orderby = 'desc', $limit = '', $offset = '', $join_str, $groupby = '');


        $contition_array = array('notification.not_type' => 5, 'not_img' => 3, 'notification.not_from' => 3, 'notification.not_to_id' => $userid, 'created_date BETWEEN DATE_SUB(NOW(), INTERVAL 2 MONTH) AND NOW()');
        $join_str = array(array(
                'join_type' => '',
                'table' => 'artistic_post_comment',
                'join_table_id' => 'notification.not_product_id',
                'from_table_id' => 'artistic_post_comment.artistic_post_comment_id'),
            array(
                'join_type' => '',
                'table' => 'art_reg',
                'join_table_id' => 'notification.not_from_id',
                'from_table_id' => 'art_reg.user_id')
        );
        $data = array('notification.*', 'artistic_post_comment.*', 'art_reg.user_id as user_id', 'art_reg.art_name as first_name', 'art_reg.art_user_image as user_image', 'art_reg.art_lastname as last_name');
        $artcmtlike = $this->data['artcmtlike'] = $this->common->select_data_by_condition('notification', $contition_array, $data, $sortby = 'artistic_post_comment_id', $orderby = 'desc', $limit = '', $offset = '', $join_str, $groupby = '');

        $contition_array = array('notification.not_type' => 6, 'not_img' => 4, 'notification.not_from' => 3, 'notification.not_to_id' => $userid, 'created_date BETWEEN DATE_SUB(NOW(), INTERVAL 2 MONTH) AND NOW()');
        $join_str = array(array(
                'join_type' => '',
                'table' => 'art_post_image_comment',
                'join_table_id' => 'notification.not_product_id',
                'from_table_id' => 'art_post_image_comment.post_image_comment_id'),
            array(
                'join_type' => '',
                'table' => 'art_reg',
                'join_table_id' => 'notification.not_from_id',
                'from_table_id' => 'art_reg.user_id')
        );
        $data = array('notification.*', ' art_post_image_comment.*', 'art_reg.user_id as user_id', 'art_reg.art_name as first_name', 'art_reg.art_user_image as user_image', 'art_reg.art_lastname as last_name');
        $artimgcommnet = $this->data['artimgcommnet'] = $this->common->select_data_by_condition('notification', $contition_array, $data, $sortby = 'post_image_comment_id', $orderby = 'desc', $limit = '', $offset = '', $join_str, $groupby = '');

        $contition_array = array('notification.not_type' => 5, 'not_img' => 6, 'notification.not_from' => 3, 'notification.not_to_id' => $userid, 'created_date BETWEEN DATE_SUB(NOW(), INTERVAL 2 MONTH) AND NOW()');
        $join_str = array(array(
                'join_type' => '',
                'table' => 'art_post_image_comment',
                'join_table_id' => 'notification.not_product_id',
                'from_table_id' => 'art_post_image_comment.post_image_comment_id'),
            array(
                'join_type' => '',
                'table' => 'art_reg',
                'join_table_id' => 'notification.not_from_id',
                'from_table_id' => 'art_reg.user_id')
        );
        $data = array('notification.*', ' art_post_image_comment.*', 'art_reg.user_id as user_id', 'art_reg.art_name as first_name', 'art_reg.art_user_image as user_image', 'art_reg.art_lastname as last_name');
        $this->data['artimgcmtlike'] = $artimgcmtlike = $this->common->select_data_by_condition('notification', $contition_array, $data, $sortby = 'post_image_comment_id', $orderby = 'desc', $limit = '', $offset = '', $join_str, $groupby = '');

// like notification end
// artistic notification end
// business profile notification start
// follow notification start

        $contition_array = array('notification.not_type' => 8, 'notification.not_from' => 6, 'notification.not_to_id' => $userid, 'created_date BETWEEN DATE_SUB(NOW(), INTERVAL 2 MONTH) AND NOW()');
        $join_str = array(array(
                'join_type' => '',
                'table' => 'follow',
                'join_table_id' => 'notification.not_product_id',
                'from_table_id' => 'follow.follow_id'),
            array(
                'join_type' => '',
                'table' => 'business_profile',
                'join_table_id' => 'notification.not_from_id',
                'from_table_id' => 'business_profile.user_id')
        );
        $data = array('notification.*', 'follow.*', 'business_profile.user_id as user_id', 'business_profile.company_name as first_name', 'business_profile.business_user_image as user_image');
        $busifollow = $this->data['busifollow'] = $this->common->select_data_by_condition('notification', $contition_array, $data, $sortby = 'follow_id', $orderby = 'desc', $limit = '', $offset = '', $join_str, $groupby = '');

// follow notification end
// comment notification start

        $contition_array = array('notification.not_type' => 6, 'not_img' => 1, 'notification.not_from' => 6, 'notification.not_to_id' => $userid, 'created_date BETWEEN DATE_SUB(NOW(), INTERVAL 2 MONTH) AND NOW()');
        $join_str = array(array(
                'join_type' => '',
                'table' => 'business_profile_post_comment',
                'join_table_id' => 'notification.not_product_id',
                'from_table_id' => 'business_profile_post_comment.business_profile_post_comment_id'),
            array(
                'join_type' => '',
                'table' => 'business_profile',
                'join_table_id' => 'notification.not_from_id',
                'from_table_id' => 'business_profile.user_id')
        );
        $data = array('notification.*', 'business_profile_post_comment.*', 'business_profile.user_id as user_id', 'business_profile.company_name as first_name', 'business_profile.business_user_image as user_image');

        $buscommnet = $this->data['buscommnet'] = $this->common->select_data_by_condition('notification', $contition_array, $data, $sortby = 'business_profile_post_comment_id', $orderby = 'desc', $limit = '', $offset = '', $join_str, $groupby = '');
//echo '<pre>'; print_r($this->data['buscommnet']);
        $contition_array = array('notification.not_type' => 6, 'not_img' => 4, 'notification.not_from' => 6, 'notification.not_to_id' => $userid, 'created_date BETWEEN DATE_SUB(NOW(), INTERVAL 2 MONTH) AND NOW()');
        $join_str = array(array(
                'join_type' => '',
                'table' => 'bus_post_image_comment',
                'join_table_id' => 'notification.not_product_id',
                'from_table_id' => 'bus_post_image_comment.post_image_comment_id'),
            array(
                'join_type' => '',
                'table' => 'business_profile',
                'join_table_id' => 'notification.not_from_id',
                'from_table_id' => 'business_profile.user_id')
        );
        $data = array('notification.*', 'bus_post_image_comment.*', 'business_profile.user_id as user_id', 'business_profile.company_name as first_name', 'business_profile.business_user_image as user_image');

        $this->data['busimgcommnet'] = $busimgcommnet = $this->common->select_data_by_condition('notification', $contition_array, $data, $sortby = 'post_image_comment_id', $orderby = 'desc', $limit = '', $offset = '', $join_str, $groupby = '');

//echo '<pre>'; print_r($this->data['busimgcommnet']); die(); 
// comment notification end
// like notification start
        $contition_array = array('notification.not_type' => 5, 'not_img' => 2, 'notification.not_from' => 6, 'notification.not_to_id' => $userid, 'created_date BETWEEN DATE_SUB(NOW(), INTERVAL 2 MONTH) AND NOW()');
        $join_str = array(array(
                'join_type' => '',
                'table' => 'business_profile_post',
                'join_table_id' => 'notification.not_product_id',
                'from_table_id' => 'business_profile_post.business_profile_post_id'),
            array(
                'join_type' => '',
                'table' => 'business_profile',
                'join_table_id' => 'notification.not_from_id',
                'from_table_id' => 'business_profile.user_id')
        );
        $data = array('notification.*', ' business_profile_post.*', 'business_profile.user_id as user_id', 'business_profile.company_name as first_name', 'business_profile.business_user_image as user_image');

        $buslike = $this->data['buslike'] = $this->common->select_data_by_condition('notification', $contition_array, $data, $sortby = 'business_profile_post_id', $orderby = 'desc', $limit = '', $offset = '', $join_str, $groupby = '');

        $contition_array = array('notification.not_type' => 5, 'not_img' => 3, 'notification.not_from' => 6, 'notification.not_to_id' => $userid, 'created_date BETWEEN DATE_SUB(NOW(), INTERVAL 2 MONTH) AND NOW()');
        $join_str = array(array(
                'join_type' => '',
                'table' => 'business_profile_post_comment',
                'join_table_id' => 'notification.not_product_id',
                'from_table_id' => 'business_profile_post_comment.business_profile_post_comment_id'),
            array(
                'join_type' => '',
                'table' => 'business_profile',
                'join_table_id' => 'notification.not_from_id',
                'from_table_id' => 'business_profile.user_id')
        );
        $data = array('notification.*', 'business_profile_post_comment.*', 'business_profile.user_id as user_id', 'business_profile.company_name as first_name', 'business_profile.business_user_image as user_image');

        $buscmtlike = $this->data['buscmtlike'] = $this->common->select_data_by_condition('notification', $contition_array, $data, $sortby = 'business_profile_post_comment_id', $orderby = 'desc', $limit = '', $offset = '', $join_str, $groupby = '');

        $contition_array = array('notification.not_type' => 5, 'not_img' => 5, 'notification.not_from' => 6, 'notification.not_to_id' => $userid, 'created_date BETWEEN DATE_SUB(NOW(), INTERVAL 2 MONTH) AND NOW()');
        $join_str = array(array(
                'join_type' => '',
                'table' => 'post_image',
                'join_table_id' => 'notification.not_product_id',
                'from_table_id' => 'post_image.image_id'),
            array(
                'join_type' => '',
                'table' => 'business_profile',
                'join_table_id' => 'notification.not_from_id',
                'from_table_id' => 'business_profile.user_id')
        );
        $data = array('notification.*', 'post_image.*', 'business_profile.user_id as user_id', 'business_profile.company_name as first_name', 'business_profile.business_user_image as user_image');

        $busimglike = $this->data['busimglike'] = $this->common->select_data_by_condition('notification', $contition_array, $data, $sortby = 'image_id', $orderby = 'desc', $limit = '', $offset = '', $join_str, $groupby = '');

        $contition_array = array('notification.not_type' => 5, 'not_img' => 6, 'notification.not_from' => 6, 'notification.not_to_id' => $userid, 'created_date BETWEEN DATE_SUB(NOW(), INTERVAL 2 MONTH) AND NOW()');
        $join_str = array(array(
                'join_type' => '',
                'table' => 'bus_post_image_comment',
                'join_table_id' => 'notification.not_product_id',
                'from_table_id' => 'bus_post_image_comment.post_image_comment_id'),
            array(
                'join_type' => '',
                'table' => 'business_profile',
                'join_table_id' => 'notification.not_from_id',
                'from_table_id' => 'business_profile.user_id')
        );
        $data = array('notification.*', 'bus_post_image_comment.*', 'business_profile.user_id as user_id', 'business_profile.company_name as first_name', 'business_profile.business_user_image as user_image');

        $busimgcmtlike = $this->data['busimgcmtlike'] = $this->common->select_data_by_condition('notification', $contition_array, $data, $sortby = 'post_image_comment_id', $orderby = 'desc', $limit = '', $offset = '', $join_str, $groupby = '');

        $this->data['totalnotifi'] = $totalnotifi = array_merge($rec_not, $job_not, $hire_not, $work_post, $artcommnet, $artlike, $artcmtlike, $artimglike, $artimgcommnet, $artfollow, $artimgcmtlike, $busimgcommnet, $busifollow, $buscommnet, $buslike, $buscmtlike, $busimgcmtlike, $busimglike);
        $this->data['totalnotification'] = $totalnotification = $this->aasort($totalnotifi, "not_id");


        $this->load->view('notification/index', $this->data);
    }

//recruiter post for notification start

    public function recruiter_post($id) {
        // echo "falguni"; 
        // echo $id; die();
        $this->data['userid'] = $userid = $this->session->userdata('aileenuser');


        $join_str[0]['table'] = 'recruiter';
        $join_str[0]['join_table_id'] = 'recruiter.user_id';
        $join_str[0]['from_table_id'] = 'rec_post.user_id';
        $join_str[0]['join_type'] = '';


        $contition_array = array('rec_post.is_delete' => 0, 'rec_post.post_id' => $id);
        $this->data['postdata'] = $this->common->select_data_by_condition('rec_post', $contition_array, $data = 'rec_post.*,recruiter.rec_firstname,recruiter.re_comp_name,recruiter.rec_lastname', $sortby = 'post_id', $orderby = 'desc', $limit = '', $offset = '', $join_str, $groupby = '');

        //echo "<pre>"; print_r($this->data['postdata']); die();

        $this->load->view('notification/rec_post1', $this->data);
    }

// recruiter post for notifiaction end 


    public function rec_profile($id = "") {

        $this->data['userid'] = $userid = $this->session->userdata('aileenuser');

        if ($id == $userid || $id == '') {
            $this->data['recdata'] = $this->common->select_data_by_id('recruiter', 'user_id', $userid, $data = '*', $join_str = array());
        } else {
            $this->data['recdata'] = $this->common->select_data_by_id('recruiter', 'user_id', $id, $data = '*', $join_str = array());
        }
//echo '<pre>'; print_r( $this->data['recdata']); die();

        $this->load->view('notification/rec_profile', $this->data);
    }

    public function rec_post($id) {
        //echo "falguni"; die();
        $this->data['userid'] = $userid = $this->session->userdata('aileenuser');

        if ($id == $userid || $id == '') {
            //echo "hii"; die();
            $join_str[0]['table'] = 'recruiter';
            $join_str[0]['join_table_id'] = 'recruiter.user_id';
            $join_str[0]['from_table_id'] = 'rec_post.user_id';
            $join_str[0]['join_type'] = '';


            $contition_array = array('rec_post.user_id' => $userid, 'rec_post.is_delete' => 0);
            $this->data['postdata'] = $this->common->select_data_by_condition('rec_post', $contition_array, $data = 'rec_post.*,recruiter.rec_firstname,recruiter.re_comp_name,recruiter.rec_lastname', $sortby = 'post_id', $orderby = 'desc', $limit = '', $offset = '', $join_str, $groupby = '');
            // echo "<pre>"; print_r($this->data['postdata']); die();
        } else {
            //echo "hello"; die();

            $join_str[0]['table'] = 'recruiter';
            $join_str[0]['join_table_id'] = 'recruiter.user_id';
            $join_str[0]['from_table_id'] = 'rec_post.user_id';
            $join_str[0]['join_type'] = '';

            $contition_array = array('rec_post.user_id' => $id, 'rec_post.is_delete' => 0);
            $this->data['postdata'] = $this->common->select_data_by_condition('rec_post', $contition_array, $data = 'rec_post.*,recruiter.rec_firstname,recruiter.re_comp_name,recruiter.rec_lastname', $sortby = 'post_id', $orderby = 'desc', $limit = '', $offset = '', $join_str, $groupby = '');
            // echo "<pre>"; print_r($this->data['postdata']); die();
        }


        $this->load->view('notification/rec_post', $this->data);
    }

//artistic display post from notifiacation  start 


    public function art_post($id) {
        $userid = $this->session->userdata('aileenuser');
        $contition_array = array('user_id' => $userid, 'status' => '1');
        $this->data['artisticdata'] = $this->common->select_data_by_condition('art_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
        $contition_array = array('art_post_id' => $id, 'status' => '1');
        $this->data['art_data'] = $this->common->select_data_by_condition('art_post', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
        //echo '<pre>'; print_r($this->data['art_data']); die();
        $this->load->view('notification/art_post', $this->data);
    }

    public function art_post_img($id, $imageid) {
        //  $imageid = 70;
        $userid = $this->session->userdata('aileenuser');
        $contition_array = array('user_id' => $userid, 'status' => '1');
        $this->data['artisticdata'] = $this->common->select_data_by_condition('art_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
        $contition_array = array('art_post_id' => $id, 'status' => '1');
        $this->data['art_data'] = $this->common->select_data_by_condition('art_post', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        $contition_array = array('post_id' => $id, 'is_deleted' => '1', 'image_type' => '1');
        $artmultiimage = $this->data['artmultiimage'] = $this->common->select_data_by_condition('post_image', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        $i = 1;
        foreach ($artmultiimage as $artimg) {
            if ($artimg['image_id'] == $imageid) {
                $count = $i;
            }
            $i++;
        }
        $this->data['count'] = $count;
        //code search
        $contition_array = array('status' => '1', 'is_delete' => '0');


        $artdata = $this->data['results'] = $this->common->select_data_by_condition('art_reg', $contition_array, $data = 'art_name,art_lastname,designation,other_skill', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);


        $return_array = array();
        //  //echo  $return_array;

        foreach ($artdata as $get) {
            $return = array();
            $return = $get;


            $return['firstname'] = $get['art_name'] . " " . $get['art_lastname'];
            unset($return['art_name']);
            unset($return['art_lastname']);

            array_push($return_array, $return);
            //echo $returnarray; 
        }

        $contition_array = array('status' => '1', 'type' => '2');

        $artpost = $this->data['results'] = $this->common->select_data_by_condition('skill', $contition_array, $data = 'skill', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);
        // echo "<pre>"; print_r($artpost);die();


        $uni = array_merge($return_array, $artpost);
        //   echo count($unique);


        foreach ($uni as $key => $value) {
            foreach ($value as $ke => $val) {
                if ($val != "") {


                    $result[] = $val;
                }
            }
        }
        $results = array_unique($result);
        foreach ($results as $key => $value) {
            $result1[$key]['label'] = $value;
            $result1[$key]['value'] = $value;
        }

        $this->data['demo'] = array_values($result1);


        $this->load->view('notification/art_image', $this->data);
    }

//artistics post end
    //business_profile notification post start


    public function business_post($id) {

        $userid = $this->session->userdata('aileenuser');
        $contition_array = array('user_id' => $userid, 'status' => '1');
        $this->data['businessdata'] = $this->common->select_data_by_condition('business_profile', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
        $contition_array = array('business_profile_post_id' => $id, 'status' => '1');
        $this->data['busienss_data'] = $this->common->select_data_by_condition('business_profile_post', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
        $this->load->view('notification/business_post', $this->data);
    }

    public function bus_post_img($id, $imageid) { //echo $id; die();
        $userid = $this->session->userdata('aileenuser');
        $contition_array = array('user_id' => $userid, 'status' => '1');
        $this->data['businessdata'] = $this->common->select_data_by_condition('business_profile', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
        $contition_array = array('business_profile_post_id' => $id, 'status' => '1');
        $this->data['busienss_data'] = $this->common->select_data_by_condition('business_profile_post', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        $contition_array = array('post_id' => $id, 'is_deleted' => '1', 'image_type' => '2');
        $busmultiimage = $this->data['busmultiimage'] = $this->common->select_data_by_condition('post_image', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        $i = 1;
        foreach ($busmultiimage as $artimg) {
            if ($artimg['image_id'] == $imageid) {
                $count = $i;
            }
            $i++;
        }
        $this->data['count'] = $count;

        $contition_array = array('status' => '1', 'business_profile.is_deleted' => '0');


        $businessdata = $this->data['results'] = $this->common->select_data_by_condition('business_profile', $contition_array, $data = 'company_name,other_industrial,other_business_type', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);
        // echo "<pre>";print_r($businessdata);die();


        $contition_array = array('status' => '1', 'is_delete' => '0');


        $businesstype = $this->data['results'] = $this->common->select_data_by_condition('business_type', $contition_array, $data = 'business_name', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);
        // echo "<pre>";print_r($businesstype);

        $contition_array = array('status' => '1', 'is_delete' => '0');


        $industrytype = $this->data['results'] = $this->common->select_data_by_condition('industry_type', $contition_array, $data = 'industry_name', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);
        // echo "<pre>";print_r($industrytype);die();
        $unique = array_merge($businessdata, $businesstype, $industrytype);
        foreach ($unique as $key => $value) {
            foreach ($value as $ke => $val) {
                if ($val != "") {


                    $result[] = $val;
                }
            }
        }

        foreach ($result as $key => $value) {
            $result1[$key]['label'] = $value;
            $result1[$key]['value'] = $value;
        }

        $this->data['demo'] = $result1;



        $this->load->view('notification/bus_image', $this->data);
    }

    //business _profile notification post end 

    public function select_req() {
        $userid = $this->session->userdata('aileenuser');

        $contition_array = array('not_read' => 2, 'not_to_id' => $userid);
        $result = $this->common->select_data_by_condition('notification', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        //echo '<pre>'; print_r($result); 
        $count = count($result);
        echo $count;
    }

    public function update_req() {
        $userid = $this->session->userdata('aileenuser');

        //echo "<pre>"; print_r($data); die();

        $contition_array = array('not_read' => 2, 'not_to_id' => $userid);
        $result = $this->common->select_data_by_condition('notification', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        $data = array(
            'not_read' => 1
        );
        // echo "<pre>"; print_r($result);die();

        foreach ($result as $cnt) {
            $updatedata = $this->common->update_data($data, 'notification', 'not_id', $cnt['not_id']);
        }

        //echo '<pre>'; print_r($result); 
        $count = count($updatedata);
        echo $count;
    }

    public function recnot($id = " ") {
        $userid = $this->session->userdata('aileenuser');

        //echo "<pre>"; print_r($data); die();

        $contition_array = array('not_read' => 2, 'not_to_id' => $userid);
        $result = $this->common->select_data_by_condition('notification', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        $data = array(
            'not_read' => 1
        );
        // echo "<pre>"; print_r($result);die();

        foreach ($result as $cnt) {
            $updatedata = $this->common->update_data($data, 'notification', 'not_id', $cnt['not_id']);
        }

        //echo '<pre>'; print_r($result); 
        $count = count($updatedata);
        echo $count;
    }

//artistic display post from notifiacation  start
//Notification count select & update for apply,save,like,comment,contact and follow start
    public function select_notification() { //echo "hello"; die();
        $userid = $this->session->userdata('aileenuser');
        $contition_array = array('not_read' => 2, 'not_to_id' => $userid, 'not_type !=' => 1, 'not_type !=' => 2);
        $result = $this->common->select_data_by_condition('notification', $contition_array, $data = 'count(*) as total', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        //echo '<pre>'; print_r($result); 
        $count = $result[0]['total'];
        echo $count;
    }

    public function update_notification() {
        $userid = $this->session->userdata('aileenuser');

        //echo "<pre>"; print_r($data); die();

        $contition_array = array('not_read' => 2, 'not_to_id' => $userid, 'not_type !=' => 1, 'not_type !=' => 2);
        $result = $this->common->select_data_by_condition('notification', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        $data = array(
            'not_read' => 1
        );
        // echo "<pre>"; print_r($result);die();

        foreach ($result as $cnt) {
            $updatedata = $this->common->update_data($data, 'notification', 'not_id', $cnt['not_id']);
        }

        //echo '<pre>'; print_r($result); 
        $count = count($updatedata);
        echo $count;
    }

//Notification count select & update for apply,save,like,comment,contact and follow End
//Notification count select & update for Message start
    public function select_msg_noti($not_from = '') { //echo "hello"; die();
        $userid = $this->session->userdata('aileenuser');
        $contition_array = array('not_read' => 2, 'not_to_id' => $userid, 'not_type' => 2, 'not_from' => $not_from);
        $result = $this->common->select_data_by_condition('notification', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = 'not_from_id');

        //   echo '<pre>'; print_r($result); die();
        $count = count($result);
        echo $count;
    }

    public function update_msg_noti($not_from = '') {
        $userid = $this->session->userdata('aileenuser');
        //echo "<pre>"; print_r($data); die();

        $contition_array = array('not_read' => 2, 'not_to_id' => $userid, 'not_type' => 2, 'not_from' => $not_from);
        $result = $this->common->select_data_by_condition('notification', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
        //  echo '<pre>'; print_r($result); die();
        $data = array(
            'not_read' => 1
        );
        foreach ($result as $cnt) {
            $updatedata = $this->common->update_data($data, 'notification', 'not_id', $cnt['not_id']);
        }

        //echo '<pre>'; print_r($result); 
        $count = count($updatedata);
        echo $count;
    }

//Notification count select & update for Message End

    public function freelancer_hire_post($id) {

        $userid = $this->session->userdata('aileenuser');

        $contition_array = array('is_delete' => '0', 'post_id' => $id, 'status' => '1');

        $postdata = $this->data['freelancerpostdata'] = $this->common->select_data_by_condition('freelancer_post', $contition_array, $data, $sortby = 'freelancer_post.created_date', $orderby = 'desc', $limit = '', $offset = '', $join_str, $groupby = '');
        //  echo "<pre>"; print_r($postdata); die();
        $this->load->view('notification/freelancer_hire_post', $this->data);
    }

        public function not_header($id = "") {

        $userid = $this->session->userdata('aileenuser');
        $contition_array = array('notification.not_type' => 3, 'notification.not_to_id' => $userid, 'notification.not_from' => 2, 'created_date BETWEEN DATE_SUB(NOW(), INTERVAL 2 MONTH) AND NOW()');
        $join_str = array(array(
                'join_type' => '',
                'table' => 'job_apply',
                'join_table_id' => 'notification.not_product_id',
                'from_table_id' => 'job_apply.app_id'),
            array(
                'join_type' => '',
                'table' => 'job_reg',
                'join_table_id' => 'notification.not_from_id',
                'from_table_id' => 'job_reg.user_id')
        );
        $data = array('notification.*', 'job_apply.*', 'job_reg.user_id as user_id', 'job_reg.fname as first_name', 'job_reg.job_user_image as user_image', 'job_reg.lname as last_name');
        $rec_not = $this->data['rec_not'] = $this->common->select_data_by_condition('notification', $contition_array, $data, $sortby = 'app_id', $orderby = 'desc', $limit = '', $offset = '', $join_str, $groupby = '');
// recruiter notification end
// job notfication start 

        $contition_array = array('notification.not_type' => 4, 'notification.not_to_id' => $userid, 'created_date BETWEEN DATE_SUB(NOW(), INTERVAL 2 MONTH) AND NOW()');
        $join_str = array(array(
                'join_type' => '',
                'table' => 'job_apply',
                'join_table_id' => 'notification.not_product_id',
                'from_table_id' => 'job_apply.app_id'),
            array(
                'join_type' => '',
                'table' => 'recruiter',
                'join_table_id' => 'notification.not_from_id',
                'from_table_id' => 'recruiter.user_id')
        );
        $data = array('notification.*', ' job_apply.*', ' recruiter.user_id as user_id', 'recruiter.rec_firstname as first_name', 'recruiter.recruiter_user_image as user_image', 'recruiter.rec_lastname as last_name');

        $job_not = $this->data['job_not'] = $this->common->select_data_by_condition('notification', $contition_array, $data, $sortby = 'app_id', $orderby = 'desc', $limit = '', $offset = '', $join_str, $groupby = '');

// job notification end
// freelancer hire  notification start
        $contition_array = array('notification.not_type' => 3, 'notification.not_from' => 4, 'notification.not_to_id' => $userid, 'created_date BETWEEN DATE_SUB(NOW(), INTERVAL 2 MONTH) AND NOW()');

        $join_str = array(
            array(
                'join_type' => '',
                'table' => 'freelancer_apply',
                'join_table_id' => 'notification.not_product_id',
                'from_table_id' => 'freelancer_apply.app_id'),
            array(
                'join_type' => '',
                'table' => 'freelancer_post_reg',
                'join_table_id' => 'notification.not_from_id',
                'from_table_id' => 'freelancer_post_reg.user_id')
        );
        $data = array('notification.*', 'freelancer_apply.*', ' freelancer_post_reg.user_id as user_id', 'freelancer_post_reg.freelancer_post_fullname as first_name', 'freelancer_post_reg.freelancer_post_user_image as user_image', 'freelancer_post_reg.freelancer_post_username as last_name');

        $hire_not = $this->data['hire_not'] = $this->common->select_data_by_condition('notification', $contition_array, $data, $sortby = 'app_id', $orderby = 'desc', $limit = '', $offset = '', $join_str, $groupby = '');
        // freelancer hire notification end
// freelancer post notification start
        // $this->data['work_post'] = $this->common->select_data_by_condition('notification', $contition_array, $data, $sortby = 'app_id', $orderby = 'desc', $limit = '', $offset = '', $join_str, $groupby = '');


        $contition_array = array('notification.not_type' => 4, 'notification.not_from' => 5, 'notification.not_to_id' => $userid, 'created_date BETWEEN DATE_SUB(NOW(), INTERVAL 2 MONTH) AND NOW()');
        $join_str = array(array(
                'join_type' => '',
                'table' => 'user_invite',
                'join_table_id' => 'notification.not_product_id',
                'from_table_id' => 'user_invite.invite_id'),
            array(
                'join_type' => '',
                'table' => 'freelancer_hire_reg',
                'join_table_id' => 'notification.not_from_id',
                'from_table_id' => 'freelancer_hire_reg.user_id')
        );
        $data = array('notification.*', ' user_invite.*', 'freelancer_hire_reg.user_id as user_id', 'freelancer_hire_reg.fullname as first_name', 'freelancer_hire_reg.freelancer_hire_user_image as user_image', 'freelancer_hire_reg.username as last_name');

        $work_post = $this->data['work_post'] = $work_post = $this->common->select_data_by_condition('notification', $contition_array, $data, $sortby = 'invite_id', $orderby = 'desc', $limit = '', $offset = '', $join_str, $groupby = '');

        // echo '<pre>'; print_r($this->data['hire_not']);
        //  echo '<pre>'; print_r($this->data['work_post']); die();
// freelancer post notification end
//artistic notification start
// follow notification start

        $contition_array = array('notification.not_type' => 8, 'notification.not_from' => 3, 'notification.not_to_id' => $userid, 'created_date BETWEEN DATE_SUB(NOW(), INTERVAL 2 MONTH) AND NOW()');
        $join_str = array(array(
                'join_type' => '',
                'table' => 'follow',
                'join_table_id' => 'notification.not_product_id',
                'from_table_id' => 'follow.follow_id'),
            array(
                'join_type' => '',
                'table' => 'art_reg',
                'join_table_id' => 'notification.not_from_id',
                'from_table_id' => 'art_reg.user_id')
        );
        $data = array('notification.*', ' follow.*', ' art_reg.user_id as user_id', 'art_reg.art_name as first_name', 'art_reg.art_user_image as user_image', 'art_reg.art_lastname as last_name');

        $artfollow = $this->data['artfollow'] = $this->common->select_data_by_condition('notification', $contition_array, $data, $sortby = 'follow_id', $orderby = 'desc', $limit = '', $offset = '', $join_str, $groupby = '');

// follow notification end
//post comment notification start

        $contition_array = array('notification.not_type' => 6, 'not_img' => 1, 'notification.not_from' => 3, 'notification.not_to_id' => $userid, 'created_date BETWEEN DATE_SUB(NOW(), INTERVAL 2 MONTH) AND NOW()');
        $join_str = array(array(
                'join_type' => '',
                'table' => 'artistic_post_comment',
                'join_table_id' => 'notification.not_product_id',
                'from_table_id' => 'artistic_post_comment.artistic_post_comment_id'),
            array(
                'join_type' => '',
                'table' => 'art_reg',
                'join_table_id' => 'notification.not_from_id',
                'from_table_id' => 'art_reg.user_id')
        );
        $data = array('notification.*', ' artistic_post_comment.*', ' art_reg.user_id as user_id', 'art_reg.art_name as first_name', 'art_reg.art_user_image as user_image', 'art_reg.art_lastname as last_name');
        $artcommnet = $this->data['artcommnet'] = $this->common->select_data_by_condition('notification', $contition_array, $data, $sortby = 'artistic_post_comment_id', $orderby = 'desc', $limit = '', $offset = '', $join_str, $groupby = '');
// comment notification end
//post like notification start
        $contition_array = array('notification.not_type' => 5, 'notification.not_from' => 3, 'not_img' => 2, 'notification.not_to_id' => $userid, 'created_date BETWEEN DATE_SUB(NOW(), INTERVAL 2 MONTH) AND NOW()');
        $join_str = array(array(
                'join_type' => '',
                'table' => 'art_post',
                'join_table_id' => 'notification.not_product_id',
                'from_table_id' => 'art_post.art_post_id'),
            array(
                'join_type' => '',
                'table' => 'art_reg',
                'join_table_id' => 'notification.not_from_id',
                'from_table_id' => 'art_reg.user_id')
        );
        $data = array('notification.*', ' art_post.*', ' art_reg.user_id as user_id', 'art_reg.art_name as first_name', 'art_reg.art_user_image as user_image', 'art_reg.art_lastname as last_name');
        $artlike = $this->data['artlike'] = $this->common->select_data_by_condition('notification', $contition_array, $data, $sortby = 'art_post_id', $orderby = 'desc', $limit = '', $offset = '', $join_str, $groupby = '');

        $contition_array = array('notification.not_type' => 5, 'not_img' => 5, 'notification.not_from' => 3, 'notification.not_to_id' => $userid, 'created_date BETWEEN DATE_SUB(NOW(), INTERVAL 2 MONTH) AND NOW()');
        $join_str = array(array(
                'join_type' => '',
                'table' => 'post_image',
                'join_table_id' => 'notification.not_product_id',
                'from_table_id' => 'post_image.image_id'),
            array(
                'join_type' => '',
                'table' => 'art_reg',
                'join_table_id' => 'notification.not_from_id',
                'from_table_id' => 'art_reg.user_id')
        );
        $data = array('notification.*', ' post_image.*', ' art_reg.user_id as user_id', 'art_reg.art_name as first_name', 'art_reg.art_user_image as user_image', 'art_reg.art_lastname as last_name');
        $artimglike = $this->data['artimglike'] = $this->common->select_data_by_condition('notification', $contition_array, $data, $sortby = 'image_id', $orderby = 'desc', $limit = '', $offset = '', $join_str, $groupby = '');


        $contition_array = array('notification.not_type' => 5, 'not_img' => 3, 'notification.not_from' => 3, 'notification.not_to_id' => $userid, 'created_date BETWEEN DATE_SUB(NOW(), INTERVAL 2 MONTH) AND NOW()');
        $join_str = array(array(
                'join_type' => '',
                'table' => 'artistic_post_comment',
                'join_table_id' => 'notification.not_product_id',
                'from_table_id' => 'artistic_post_comment.artistic_post_comment_id'),
            array(
                'join_type' => '',
                'table' => 'art_reg',
                'join_table_id' => 'notification.not_from_id',
                'from_table_id' => 'art_reg.user_id')
        );
        $data = array('notification.*', ' artistic_post_comment.*', ' art_reg.user_id as user_id', 'art_reg.art_name as first_name', 'art_reg.art_user_image as user_image', 'art_reg.art_lastname as last_name');
        $artcmtlike = $this->data['artcmtlike'] = $this->common->select_data_by_condition('notification', $contition_array, $data, $sortby = 'artistic_post_comment_id', $orderby = 'desc', $limit = '', $offset = '', $join_str, $groupby = '');

        $contition_array = array('notification.not_type' => 6, 'not_img' => 4, 'notification.not_from' => 3, 'notification.not_to_id' => $userid, 'created_date BETWEEN DATE_SUB(NOW(), INTERVAL 2 MONTH) AND NOW()');
        $join_str = array(array(
                'join_type' => '',
                'table' => 'art_post_image_comment',
                'join_table_id' => 'notification.not_product_id',
                'from_table_id' => 'art_post_image_comment.post_image_comment_id'),
            array(
                'join_type' => '',
                'table' => 'art_reg',
                'join_table_id' => 'notification.not_from_id',
                'from_table_id' => 'art_reg.user_id')
        );
        $data = array('notification.*', ' art_post_image_comment.*', ' art_reg.user_id as user_id', 'art_reg.art_name as first_name', 'art_reg.art_user_image as user_image', 'art_reg.art_lastname as last_name');
        $artimgcommnet = $this->data['artimgcommnet'] = $this->common->select_data_by_condition('notification', $contition_array, $data, $sortby = 'post_image_comment_id', $orderby = 'desc', $limit = '', $offset = '', $join_str, $groupby = '');

        $contition_array = array('notification.not_type' => 5, 'not_img' => 6, 'notification.not_from' => 3, 'notification.not_to_id' => $userid, 'created_date BETWEEN DATE_SUB(NOW(), INTERVAL 2 MONTH) AND NOW()');
        $join_str = array(array(
                'join_type' => '',
                'table' => 'art_post_image_comment',
                'join_table_id' => 'notification.not_product_id',
                'from_table_id' => 'art_post_image_comment.post_image_comment_id'),
            array(
                'join_type' => '',
                'table' => 'art_reg',
                'join_table_id' => 'notification.not_from_id',
                'from_table_id' => 'art_reg.user_id')
        );
        $data = array('notification.*', ' art_post_image_comment.*', ' art_reg.user_id as user_id', 'art_reg.art_name as first_name', 'art_reg.art_user_image as user_image', 'art_reg.art_lastname as last_name');
        $this->data['artimgcmtlike'] = $artimgcmtlike = $this->common->select_data_by_condition('notification', $contition_array, $data, $sortby = 'post_image_comment_id', $orderby = 'desc', $limit = '', $offset = '', $join_str, $groupby = '');

// like notification end
// artistic notification end
// business profile notification start
// follow notification start

        $contition_array = array('notification.not_type' => 8, 'notification.not_from' => 6, 'notification.not_to_id' => $userid, 'created_date BETWEEN DATE_SUB(NOW(), INTERVAL 2 MONTH) AND NOW()');
        $join_str = array(array(
                'join_type' => '',
                'table' => 'follow',
                'join_table_id' => 'notification.not_product_id',
                'from_table_id' => 'follow.follow_id'),
            array(
                'join_type' => '',
                'table' => 'business_profile',
                'join_table_id' => 'notification.not_from_id',
                'from_table_id' => 'business_profile.user_id')
        );
        $data = array('notification.*', 'follow.*', 'business_profile.user_id as user_id', 'business_profile.company_name as first_name', 'business_profile.business_user_image as user_image');

        $busifollow = $this->data['busifollow'] = $this->common->select_data_by_condition('notification', $contition_array, $data, $sortby = 'follow_id', $orderby = 'desc', $limit = '', $offset = '', $join_str, $groupby = '');

// follow notification end
// comment notification start

        $contition_array = array('notification.not_type' => 6, 'not_img' => 1, 'notification.not_from' => 6, 'notification.not_to_id' => $userid, 'created_date BETWEEN DATE_SUB(NOW(), INTERVAL 2 MONTH) AND NOW()');
        $join_str = array(array(
                'join_type' => '',
                'table' => 'business_profile_post_comment',
                'join_table_id' => 'notification.not_product_id',
                'from_table_id' => 'business_profile_post_comment.business_profile_post_comment_id'),
            array(
                'join_type' => '',
                'table' => 'business_profile',
                'join_table_id' => 'notification.not_from_id',
                'from_table_id' => 'business_profile.user_id')
        );
        $data = array('notification.*', 'business_profile_post_comment.*', 'business_profile.user_id as user_id', 'business_profile.company_name as first_name', 'business_profile.business_user_image as user_image');

        $buscommnet = $this->data['buscommnet'] = $this->common->select_data_by_condition('notification', $contition_array, $data, $sortby = 'business_profile_post_comment_id', $orderby = 'desc', $limit = '', $offset = '', $join_str, $groupby = '');
//echo '<pre>'; print_r($this->data['buscommnet']);
        $contition_array = array('notification.not_type' => 6, 'not_img' => 4, 'notification.not_from' => 6, 'notification.not_to_id' => $userid, 'created_date BETWEEN DATE_SUB(NOW(), INTERVAL 2 MONTH) AND NOW()');
        $join_str = array(array(
                'join_type' => '',
                'table' => 'bus_post_image_comment',
                'join_table_id' => 'notification.not_product_id',
                'from_table_id' => 'bus_post_image_comment.post_image_comment_id'),
            array(
                'join_type' => '',
                'table' => 'business_profile',
                'join_table_id' => 'notification.not_from_id',
                'from_table_id' => 'business_profile.user_id')
        );
        $data = array('notification.*', 'bus_post_image_comment.*', 'business_profile.user_id as user_id', 'business_profile.company_name as first_name', 'business_profile.business_user_image as user_image');

        $this->data['busimgcommnet'] = $busimgcommnet = $this->common->select_data_by_condition('notification', $contition_array, $data, $sortby = 'post_image_comment_id', $orderby = 'desc', $limit = '', $offset = '', $join_str, $groupby = '');

//echo '<pre>'; print_r($this->data['busimgcommnet']); die(); 
// comment notification end
// like notification start
        $contition_array = array('notification.not_type' => 5, 'not_img' => 2, 'notification.not_from' => 6, 'notification.not_to_id' => $userid, 'created_date BETWEEN DATE_SUB(NOW(), INTERVAL 2 MONTH) AND NOW()');
        $join_str = array(array(
                'join_type' => '',
                'table' => 'business_profile_post',
                'join_table_id' => 'notification.not_product_id',
                'from_table_id' => 'business_profile_post.business_profile_post_id'),
            array(
                'join_type' => '',
                'table' => 'business_profile',
                'join_table_id' => 'notification.not_from_id',
                'from_table_id' => 'business_profile.user_id')
        );
        $data = array('notification.*', 'business_profile_post.*', 'business_profile.user_id as user_id', 'business_profile.company_name as first_name', 'business_profile.business_user_image as user_image');

        $buslike = $this->data['buslike'] = $this->common->select_data_by_condition('notification', $contition_array, $data, $sortby = 'business_profile_post_id', $orderby = 'desc', $limit = '', $offset = '', $join_str, $groupby = '');

        $contition_array = array('notification.not_type' => 5, 'not_img' => 3, 'notification.not_from' => 6, 'notification.not_to_id' => $userid, 'created_date BETWEEN DATE_SUB(NOW(), INTERVAL 2 MONTH) AND NOW()');
        $join_str = array(array(
                'join_type' => '',
                'table' => 'business_profile_post_comment',
                'join_table_id' => 'notification.not_product_id',
                'from_table_id' => 'business_profile_post_comment.business_profile_post_comment_id'),
            array(
                'join_type' => '',
                'table' => 'business_profile',
                'join_table_id' => 'notification.not_from_id',
                'from_table_id' => 'business_profile.user_id')
        );
        $data = array('notification.*', 'business_profile_post_comment.*', 'business_profile.user_id as user_id', 'business_profile.company_name as first_name', 'business_profile.business_user_image as user_image');

        $buscmtlike = $this->data['buscmtlike'] = $this->common->select_data_by_condition('notification', $contition_array, $data, $sortby = 'business_profile_post_comment_id', $orderby = 'desc', $limit = '', $offset = '', $join_str, $groupby = '');

        $contition_array = array('notification.not_type' => 5, 'not_img' => 5, 'notification.not_from' => 6, 'notification.not_to_id' => $userid, 'created_date BETWEEN DATE_SUB(NOW(), INTERVAL 2 MONTH) AND NOW()');
        $join_str = array(array(
                'join_type' => '',
                'table' => 'post_image',
                'join_table_id' => 'notification.not_product_id',
                'from_table_id' => 'post_image.image_id'),
            array(
                'join_type' => '',
                'table' => 'business_profile',
                'join_table_id' => 'notification.not_from_id',
                'from_table_id' => 'business_profile.user_id')
        );
        $data = array('notification.*', 'post_image.*', 'business_profile.user_id as user_id', 'business_profile.company_name as first_name', 'business_profile.business_user_image as user_image');

        $busimglike = $this->data['busimglike'] = $this->common->select_data_by_condition('notification', $contition_array, $data, $sortby = 'image_id', $orderby = 'desc', $limit = '', $offset = '', $join_str, $groupby = '');

        $contition_array = array('notification.not_type' => 5, 'not_img' => 6, 'notification.not_from' => 6, 'notification.not_to_id' => $userid, 'created_date BETWEEN DATE_SUB(NOW(), INTERVAL 2 MONTH) AND NOW()');
        $join_str = array(array(
                'join_type' => '',
                'table' => 'bus_post_image_comment',
                'join_table_id' => 'notification.not_product_id',
                'from_table_id' => 'bus_post_image_comment.post_image_comment_id'),
            array(
                'join_type' => '',
                'table' => 'business_profile',
                'join_table_id' => 'notification.not_from_id',
                'from_table_id' => 'business_profile.user_id')
        );
        $data = array('notification.*', 'bus_post_image_comment.*', 'business_profile.user_id as user_id', 'business_profile.company_name as first_name', 'business_profile.business_user_image as user_image');

        $busimgcmtlike = $this->data['busimgcmtlike'] = $this->common->select_data_by_condition('notification', $contition_array, $data, $sortby = 'post_image_comment_id', $orderby = 'desc', $limit = '', $offset = '', $join_str, $groupby = '');

        $this->data['totalnotifi'] = $totalnotifi = array_merge($rec_not, $job_not, $hire_not, $work_post, $artcommnet, $artlike, $artcmtlike, $artimglike, $artimgcommnet, $artfollow, $artimgcmtlike, $busimgcommnet, $busifollow, $buscommnet, $buslike, $buscmtlike, $busimgcmtlike, $busimglike);
        $this->data['totalnotification'] = $totalnotification = $this->aasort($totalnotifi, "not_created_date");

        //  $notification .= '<div class="notification-data">';
        // $notification .= '<ul>';
        // $notification .= '<li>';
        //  $notification .= '<div class="notification-database">';
        //   $notification .= '<div class="notification-pic">';
        //    $notification .= '</div>';
        // $notification .= '<div class="notification-data-inside">';
        //  $notification .= '<h6> Notification updates</h6>';
        // $notification .= '</div>';
        //   $notification .= '</div></div></li>';
        //$notification = '<ul class="">';
        $i = 0;
        foreach ($totalnotification as $total) {
//1     


            if ($total['not_from'] == 1) {
                $companyname = $this->db->get_where('recruiter', array('user_id' => $total['user_id']))->row()->re_comp_name;

                $notification .= '<li class="';
                if ($total['not_active'] == 1) {
                    $notification .= 'active2';
                }
                $notification .= '"';
                $notification .= '><a href="' . base_url('notification/recruiter_post/' . $total['post_id']) . '" onClick="not_active(' . $total['not_id'] . ')"><div class="notification-database">';
                $notification .= '<div class="notification-pic">';


                $filepath = FCPATH . $this->config->item('rec_profile_thumb_upload_path') . $total['user_image'];
                if ($total['user_image'] && (file_exists($filepath)) == 1) {
                    $notification .= '<img src="' . base_url($this->config->item('rec_profile_thumb_upload_path') . $total['user_image']) . '" >';
                } else {
                    $a = $total['first_name'];
                    $b = $total['last_name'];
                    $acr = substr($a, 0, 1);
                    $bcr = substr($b, 0, 1);


                    $notification .= '<div class="post-img-div">';
                    $notification .= '' . ucwords($acr) . ucwords($bcr) . '';
                    $notification .= '</div>';
                }

                $notification .= '</div><div class="notification-data-inside">';
                $notification .= '<h6><font color="black"><b><i> Recruiter</i></font></b><b>' . '  ' . ucwords($total['first_name']) . ' ' . ucwords($total['last_name']) . '</b>  From ' . ucwords($companyname) . ' <span class="noti-msg-y"> Invited you for an interview. </span></h6>';
                $notification .= '<div ><i class="clockimg" ></i><span class="day-text">';
                $notification .= '' . $this->common->time_elapsed_string($total['not_created_date'], $full = false) . '';
                $notification .= '</span></div></div></div></a></li>';
            }
            //  }
            //  2
            // foreach ($artfollow as $art) {
            if ($total['not_from'] == 3 && $total['not_img'] == 0) {

                $notification .= '<li class="';
                if ($total['not_active'] == 1) {
                    $notification .= 'active2';
                }
                $notification .= '"';
                $notification .= '><a href="' . base_url('artistic/artistic_profile/' . $total['user_id']) . '" onClick="not_active(' . $total['not_id'] . ')"><div class="notification-database">';
                $notification .= '<div class="notification-pic">';


                $filepath = FCPATH . $this->config->item('art_profile_thumb_upload_path') . $total['user_image'];
                if ($total['user_image'] && (file_exists($filepath)) == 1) {
                    $notification .= '<img src="' . base_url($this->config->item('art_profile_thumb_upload_path') . $total['user_image']) . '" >';
                } else {
                    $a = $total['first_name'];
                    $b = $total['last_name'];
                    $acr = substr($a, 0, 1);
                    $bcr = substr($b, 0, 1);


                    $notification .= '<div class="post-img-div">';
                    $notification .= '' . ucwords($acr) . ucwords($bcr) . '';
                    $notification .= '</div>';
                }

                $notification .= '</div><div class="notification-data-inside">';
                $notification .= '<h6><b>' . '  ' . ucwords($total['first_name']) . ' ' . ucwords($total['last_name']) . '</b> <span class="noti-msg-y"> Started following you in artistic profile.</span></h6>';
                $notification .= '<div ><i class="clockimg" ></i><span class="day-text">';
                $notification .= '' . $this->common->time_elapsed_string($total['not_created_date'], $full = false) . '';
                $notification .= '</span></div></div></div></a></li>';
            }
            //   }
            //   3
            //    foreach ($artcommnet as $art) {
            $art_not_from = $total['not_from'];
            $art_not_img = $total['not_img'];
            if ($art_not_from == '3' && $art_not_img == '1') {

                $notification .= '<li class="';
                if ($total['not_active'] == 1) {
                    $notification .= 'active2';
                }
                $notification .= '"';
                $notification .= '><a href="' . base_url('notification/art_post/' . $total['art_post_id']) . '" onClick="not_active(' . $total['not_id'] . ')"><div class="notification-database">';
                $notification .= '<div class="notification-pic">';

                $filepath = FCPATH . $this->config->item('art_profile_thumb_upload_path') . $total['user_image'];
                if ($total['user_image'] && (file_exists($filepath)) == 1) {
                    $notification .= '<img src="' . base_url($this->config->item('art_profile_thumb_upload_path') . $total['user_image']) . '" >';
                } else {
                    $a = $total['first_name'];
                    $b = $total['last_name'];
                    $acr = substr($a, 0, 1);
                    $bcr = substr($b, 0, 1);


                    $notification .= '<div class="post-img-div">';
                    $notification .= '' . ucwords($acr) . ucwords($bcr) . '';
                    $notification .= '</div>';
                }
                $notification .= '</div><div class="notification-data-inside">';
                //$notification .= '';
                $notification .= '<h6>';
                $notification .= '<b>' . ' ' . ucwords($total['first_name']) . ' ' . ucwords($total['last_name']) . '</b><span class="noti-msg-y"> Commneted on your post in artistic profile.</span>';
                $notification .= '</h6><div><i class="clockimg" ></i><span class="day-text">';
                $notification .= '' . $this->common->time_elapsed_string($total['not_created_date'], $full = false) . '';
                $notification .= '</span></div></div></div></a></li>';
            }
            //   }
            //   4

            $art_not_from = $total['not_from'];
            $art_not_img = $total['not_img'];
            if ($art_not_from == '3' && $art_not_img == '2') {

                $notification .= '<li class="';
                if ($total['not_active'] == 1) {
                    $notification .= 'active2';
                }
                $notification .= '"';
                $notification .= '><a href="' . base_url('notification/art_post/' . $total['art_post_id']) . '" onClick="not_active(' . $total['not_id'] . ')"><div class="notification-database">';
                $notification .= '<div class="notification-pic">';


                $filepath = FCPATH . $this->config->item('art_profile_thumb_upload_path') . $total['user_image'];
                if ($total['user_image'] && (file_exists($filepath)) == 1) {
                    $notification .= '<img src="' . base_url($this->config->item('art_profile_thumb_upload_path') . $total['user_image']) . '" >';
                } else {
                    $a = $total['first_name'];
                    $b = $total['last_name'];
                    $acr = substr($a, 0, 1);
                    $bcr = substr($b, 0, 1);


                    $notification .= '<div class="post-img-div">';
                    $notification .= '' . ucwords($acr) . ucwords($bcr) . '';
                    $notification .= '</div>';
                }

                $notification .= '</div><div class="notification-data-inside">';
                $notification .= '<h6><b>' . '  ' . ucwords($total['first_name']) . ' ' . ucwords($total['last_name']) . '</b> <span class="noti-msg-y">Likes your post in artistic profile.</sapn></h6>';
                $notification .= '<div ><i class="clockimg" ></i><span class="day-text">';
                $notification .= '' . $this->common->time_elapsed_string($total['not_created_date'], $full = false) . '';
                $notification .= '</span></div></div> </div></a> </li>';
            }

            //5
            if ($total['not_from'] == 3) {
                if ($total['not_img'] == 3) {

                    $notification .= '<li class="';
                    if ($total['not_active'] == 1) {
                        $notification .= 'active2';
                    }
                    $notification .= '"';
                    $notification .= '><a href="' . base_url('notification/art_post/' . $total['art_post_id']) . '" onClick="not_active(' . $total['not_id'] . ')"><div class="notification-database"><div class="notification-pic" >';
                    $filepath = FCPATH . $this->config->item('art_profile_thumb_upload_path') . $total['user_image'];
                    if ($total['user_image'] && (file_exists($filepath)) == 1) {
                        $notification .= '<img src="' . base_url($this->config->item('art_profile_thumb_upload_path') . $total['user_image']) . '" >';
                    } else {
                        $a = $total['first_name'];
                        $b = $total['last_name'];
                        $acr = substr($a, 0, 1);
                        $bcr = substr($b, 0, 1);


                        $notification .= '<div class="post-img-div">';
                        $notification .= '' . ucwords($acr) . ucwords($bcr) . '';
                        $notification .= '</div>';
                    }
                    $notification .= '</div>';
                    $notification .= '<div class="notification-data-inside">';
                    $notification .= '<h6><b>' . ucwords($total['first_name']) . ' ' . ucwords($total['last_name']) . '</b> <span class="noti-msg-y"> Likes your post`s comment in artistic profile.</h6>';
                    $notification .= '<div ><i class="clockimg" ></i><span class="day-text">';
                    $notification .= '' . $this->common->time_elapsed_string($total['not_created_date'], $full = false) . '';
                    $notification .= '</span></div>';
                    $notification .= '</div></div></a>';
                    $notification .= '</li>';
                }
            }
            //6
            if ($total['not_from'] == 3) {
                if ($total['not_img'] == 5) {
                    $notification .= '<li class="';
                    if ($total['not_active'] == 1) {
                        $notification .= 'active2';
                    }
                    $notification .= '"';
                    $notification .= '><a href="' . base_url('notification/art_post_img/' . $total['post_id'] . '/' . $total['image_id']) . '"><div class="notification-database"><div class="notification-pic">';
                    $filepath = FCPATH . $this->config->item('art_profile_thumb_upload_path') . $total['user_image'];
                    if ($total['user_image'] && (file_exists($filepath)) == 1) {
                        $notification .= '<img src="' . base_url($this->config->item('art_profile_thumb_upload_path') . $total['user_image']) . '" >';
                    } else {
                        $a = $total['first_name'];
                        $b = $total['last_name'];
                        $acr = substr($a, 0, 1);
                        $bcr = substr($b, 0, 1);


                        $notification .= '<div class="post-img-div">';
                        $notification .= '' . ucwords($acr) . ucwords($bcr) . '';
                        $notification .= '</div>';
                    }
                    $notification .= '</div>';
                    $notification .= '<div class="notification-data-inside">';
                    $notification .= '<h6><b>' . ucwords($total['first_name']) . ' ' . ucwords($total['last_name']) . '</b> <span class="noti-msg-y"> Likes your photo in artistic profile. </sapn></h6>';
                    $notification .= '<div ><i class="clockimg" ></i><span class="day-text">';
                    $notification .= '' . $this->common->time_elapsed_string($total['not_created_date'], $full = false) . '';
                    $notification .= '</span></div></div>';
                    $notification .= '</div></a>';
                    $notification .= '</li>';
                }
            }
            //7
            if ($total['not_from'] == 3) {
                if ($total['not_img'] == 4) {
                    $postid = $this->db->get_where('post_image', array('image_id' => $total['post_image_id']))->row()->post_id;
                    $notification .= '<li class="';
                    if ($total['not_active'] == 1) {
                        $notification .= 'active2';
                    }
                    $notification .= '"';
                    $notification .= '><a href="' . base_url('notification/art_post_img/' . $postid . '/' . $total['post_image_id']) . '" onClick="not_active(' . $total['not_id'] . ')"><div class="notification-database"><div class="notification-pic">';
                    $filepath = FCPATH . $this->config->item('art_profile_thumb_upload_path') . $total['user_image'];
                    if ($total['user_image'] && (file_exists($filepath)) == 1) {
                        $notification .= '<img src="' . base_url($this->config->item('art_profile_thumb_upload_path') . $total['user_image']) . '" >';
                    } else {
                        $a = $total['first_name'];
                        $b = $total['last_name'];
                        $acr = substr($a, 0, 1);
                        $bcr = substr($b, 0, 1);


                        $notification .= '<div class="post-img-div">';
                        $notification .= '' . ucwords($acr) . ucwords($bcr) . '';
                        $notification .= '</div>';
                    }
                    $notification .= '</div>';
                    $notification .= '<div class="notification-data-inside">';
                    $notification .= '<h6><b>' . ucwords($total['first_name']) . ' ' . ucwords($total['last_name']) . '</b> <span class="noti-msg-y">Commented on your photo in artistic profile.</sapn></h6>';
                    $notification .= '<div ><i class="clockimg" ></i><span class="day-text">';
                    $notification .= '' . $this->common->time_elapsed_string($total['not_created_date'], $full = false) . '';
                    $notification .= '</span></div> </div>';
                    $notification .= '</div></a>';
                    $notification .= '</li>';
                }
            }
            //8
            if ($total['not_from'] == 3) {
                if ($total['not_img'] == 6) {
                    $postid = $this->db->get_where('post_image', array('image_id' => $total['post_image_id']))->row()->post_id;
                    $notification .= '<li class="';
                    if ($total['not_active'] == 1) {
                        $notification .= 'active2';
                    }
                    $notification .= '"';
                    $notification .= '><a href="' . base_url('notification/art_post_img/' . $postid . '/' . $total['post_image_id']) . '" onClick="not_active(' . $total['not_id'] . ')"><div class="notification-database"><div class="notification-pic" >';
                    $filepath = FCPATH . $this->config->item('art_profile_thumb_upload_path') . $total['user_image'];
                    if ($total['user_image'] && (file_exists($filepath)) == 1) {
                        $notification .= '<img src="' . base_url($this->config->item('art_profile_thumb_upload_path') . $total['user_image']) . '" >';
                    } else {
                        $a = $total['first_name'];
                        $b = $total['last_name'];
                        $acr = substr($a, 0, 1);
                        $bcr = substr($b, 0, 1);


                        $notification .= '<div class="post-img-div">';
                        $notification .= '' . ucwords($acr) . ucwords($bcr) . '';
                        $notification .= '</div>';
                    }
                    $notification .= '</div>';
                    $notification .= '<div class="notification-data-inside">';
                    $notification .= '<h6><b>' . ucwords($total['first_name']) . ' ' . ucwords($total['last_name']) . '</b> <span class="noti-msg-y">Likes your photo`s comment in artistic profile.</h6>';
                    $notification .= '<div ><i class="clockimg" ></i><span class="day-text">';
                    $notification .= '' . $this->common->time_elapsed_string($total['not_created_date'], $full = false) . '';
                    $notification .= '</span></div></div>';
                    $notification .= '</div></a>';
                    $notification .= '</li>';
                }
            }
            //9
            $bus_not_from = $total['not_from'];
            $bus_not_img = $total['not_img'];
            $companyname = $this->db->get_where('business_profile', array('user_id' => $total['not_from_id']))->row()->company_name;
            if ($bus_not_from == '6' && $bus_not_img == '1') {
                $notification .= '<li class="';
                if ($total['not_active'] == 1) {
                    $notification .= 'active2';
                }
                $notification .= '"';
                $notification .= '><a href="' . base_url('notification/business_post/' . $total['business_profile_post_id']) . '" onClick="not_active(' . $total['not_id'] . ')"><div class="notification-database">';
                $notification .= '<div class="notification-pic">';
                $filepath = FCPATH . $this->config->item('bus_profile_thumb_upload_path') . $total['user_image'];
                if ($total['user_image'] && (file_exists($filepath)) == 1) {
                    $notification .= '<img src="' . base_url($this->config->item('bus_profile_thumb_upload_path') . $total['user_image']) . '" >';
                } else {
                    $a = $companyname;
                    $acr = substr($a, 0, 1);


                    $notification .= '<div class="post-img-div">';
                    $notification .= '' . ucwords($acr) . '';
                    $notification .= '</div>';
                }
                $notification .= '</div><div class="notification-data-inside">';
                $notification .= '<h6><b>' . '  ' . ucwords($companyname) . '</b><span class="noti-msg-y"> Commented on your post in business profile. </span></h6>';
                $notification .= '<div ><i class="clockimg" ></i><span class="day-text">';
                $notification .= '' . $this->common->time_elapsed_string($total['not_created_date'], $full = false) . '';
                $notification .= '</span></div></div> </div></a> </li>';
            }
            //10
            if ($total['not_from'] == 6 && $total['not_img'] == 0) {
                $busslug = $this->db->get_where('business_profile', array('user_id' => $total['user_id']))->row()->business_slug;
                $companyname = $this->db->get_where('business_profile', array('user_id' => $total['not_from_id']))->row()->company_name;
                $notification .= '<li class="';
                if ($total['not_active'] == 1) {
                    $notification .= 'active2';
                }
                $notification .= '"';
                $notification .= '><a href="' . base_url('business_profile/business_resume/' . $busslug) . '" onClick="not_active(' . $total['not_id'] . ')"><div class="notification-database">';
                $notification .= '<div class="notification-pic">';

                $filepath = FCPATH . $this->config->item('bus_profile_thumb_upload_path') . $total['user_image'];
                if ($total['user_image'] && (file_exists($filepath)) == 1) {
                    $notification .= '<img src="' . base_url($this->config->item('bus_profile_thumb_upload_path') . $total['user_image']) . '" >';
                } else {
                    $a = $companyname;
                    $acr = substr($a, 0, 1);


                    $notification .= '<div class="post-img-div">';
                    $notification .= '' . ucwords($acr) . '';
                    $notification .= '</div>';
                }
                $notification .= '</div><div class="notification-data-inside">';
                $notification .= '<h6><b>' . '  ' . ucwords($companyname) . '</b> <span class="noti-msg-y">Started following you in business profile.</span></h6>';
                $notification .= '<div ><i class="clockimg" ></i><span class="day-text">';
                $notification .= '' . $this->common->time_elapsed_string($total['not_created_date'], $full = false) . '';
                $notification .= '</span></div></div> </div></a> </li>';
            }
            //11
            $bus_not_from = $total['not_from'];
            $bus_not_img = $total['not_img'];
            $companyname = $this->db->get_where('business_profile', array('user_id' => $total['not_from_id']))->row()->company_name;
            if ($bus_not_from == '6' && $bus_not_img == '2') {
                $notification .= '<li class="';
                if ($total['not_active'] == 1) {
                    $notification .= 'active2';
                }
                $notification .= '"';
                $notification .= '><a href="' . base_url('notification/business_post/' . $total['business_profile_post_id']) . '" onClick="not_active(' . $total['not_id'] . ')"><div class="notification-database">';
                $notification .= '<div class="notification-pic">';
                $filepath = FCPATH . $this->config->item('bus_profile_thumb_upload_path') . $total['user_image'];
                if ($total['user_image'] && (file_exists($filepath)) == 1) {
                    $notification .= '<img src="' . base_url($this->config->item('bus_profile_thumb_upload_path') . $total['user_image']) . '" >';
                } else {
                    $a = $companyname;
                    $acr = substr($a, 0, 1);


                    $notification .= '<div class="post-img-div">';
                    $notification .= '' . ucwords($acr) . '';
                    $notification .= '</div>';
                }
                $notification .= '</div><div class="notification-data-inside">';
                $notification .= '<h6><b>' . '  ' . ucwords($companyname) . '</b> <span class="noti-msg-y"> Likes your post in business profile. </span> </h6>';
                $notification .= '<div ><i class="clockimg" ></i><span class="day-text">';
                $notification .= '' . $this->common->time_elapsed_string($total['not_created_date'], $full = false) . '';
                $notification .= '</span></div></div> </div> </a></li>';
            }
            //12
            if ($total['not_from'] == 6) {
                if ($total['not_img'] == 3) {
                    $companyname = $this->db->get_where('business_profile', array('user_id' => $total['not_from_id']))->row()->company_name;
                    $notification .= '<li class="';
                    if ($total['not_active'] == 1) {
                        $notification .= 'active2';
                    }
                    $notification .= '"';
                    $notification .= '><a href="' . base_url('notification/business_post/' . $total['business_profile_post_id']) . '" onClick="not_active(' . $total['not_id'] . ')">
                    <div class="notification-database"> <div class="notification-pic" >';
                    $filepath = FCPATH . $this->config->item('bus_profile_thumb_upload_path') . $total['user_image'];
                    if ($total['user_image'] && (file_exists($filepath)) == 1) {
                        $notification .= '<img src="' . base_url($this->config->item('bus_profile_thumb_upload_path') . $total['user_image']) . '" >';
                    } else {
                        $a = $companyname;
                        $acr = substr($a, 0, 1);


                        $notification .= '<div class="post-img-div">';
                        $notification .= '' . ucwords($acr) . '';
                        $notification .= '</div>';
                    }
                    $notification .= '</div>';
                    $notification .= '<div class="notification-data-inside">';
                    $notification .= '<h6><b>' . ucwords($companyname) . '</b> <span class="noti-msg-y"> Likes your post`s comment in business profile.</h6>';
                    $notification .= '<div ><i class="clockimg" ></i><span class="day-text">';
                    $notification .= '' . $this->common->time_elapsed_string($total['not_created_date'], $full = false) . '';
                    $notification .= '</span></div> </div>';
                    $notification .= '</div></a>';
                    $notification .= '</li>';
                }
            }
            //13
            if ($total['not_from'] == 6) {
                if ($total['not_img'] == 5) {
                    $companyname = $this->db->get_where('business_profile', array('user_id' => $total['not_from_id']))->row()->company_name;
                    $notification .= '<li class="';
                    if ($total['not_active'] == 1) {
                        $notification .= 'active2';
                    }
                    $notification .= '"';
                    $notification .= '><a href="' . base_url('notification/bus_post_img/' . $total['post_id'] . '/' . $total['image_id']) . '" onClick="not_active(' . $total['not_id'] . ')"><div class="notification-database"><div class="notification-pic" >';
                    $filepath = FCPATH . $this->config->item('bus_profile_thumb_upload_path') . $total['user_image'];
                    if ($total['user_image'] && (file_exists($filepath)) == 1) {
                        $notification .= '<img src="' . base_url($this->config->item('bus_profile_thumb_upload_path') . $total['user_image']) . '" >';
                    } else {
                        $a = $companyname;
                        $acr = substr($a, 0, 1);


                        $notification .= '<div class="post-img-div">';
                        $notification .= '' . ucwords($acr) . '';
                        $notification .= '</div>';
                    }
                    $notification .= '</div>';
                    $notification .= '<div class="notification-data-inside">';
                    $notification .= '<h6><b>' . ucwords($companyname) . '</b> <span class="noti-msg-y"> Likes your photo in business profile. </span></h6>';
                    $notification .= '<div ><i class="clockimg" ></i><span class="day-text">';
                    $notification .= '' . $this->common->time_elapsed_string($total['not_created_date'], $full = false) . '';
                    $notification .= '</span></div></div';
                    $notification .= '</div></a>';
                    $notification .= '</li>';
                }
            }
            //14
            if ($total['not_from'] == 6) {
                if ($total['not_img'] == 4) {
                    $companyname = $this->db->get_where('business_profile', array('user_id' => $total['not_from_id']))->row()->company_name;
                    $postid = $this->db->get_where('post_image', array('image_id' => $total['post_image_id']))->row()->post_id;
                    $notification .= '<li class="';
                    if ($total['not_active'] == 1) {
                        $notification .= 'active2';
                    }
                    $notification .= '"';
                    $notification .= '><a href="' . base_url('notification/bus_post_img/' . $postid . '/' . $total['post_image_id']) . '" onClick="not_active(' . $total['not_id'] . ')"><div class="notification-database"><div class="notification-pic" >';
                    $filepath = FCPATH . $this->config->item('bus_profile_thumb_upload_path') . $total['user_image'];
                    if ($total['user_image'] && (file_exists($filepath)) == 1) {
                        $notification .= '<img src="' . base_url($this->config->item('bus_profile_thumb_upload_path') . $total['user_image']) . '" >';
                    } else {
                        $a = $companyname;
                        $acr = substr($a, 0, 1);


                        $notification .= '<div class="post-img-div">';
                        $notification .= '' . ucwords($acr) . '';
                        $notification .= '</div>';
                    }
                    $notification .= '</div>';
                    $notification .= '<div class="notification-data-inside">';
                    $notification .= '<h6><b>' . ucwords($companyname) . '</b> <span class="noti-msg-y"> Commented on your photo in business profile. </span></h6>';
                    $notification .= '<div ><i class="clockimg" ></i><span class="day-text">';
                    $notification .= '' . $this->common->time_elapsed_string($total['not_created_date'], $full = false) . '';
                    $notification .= '</span></div></div';
                    $notification .= '</div></a>';
                    $notification .= '</li>';
                }
            }
            //15
            if ($total['not_from'] == 6) {
                if ($total['not_img'] == 6) {
                    $companyname = $this->db->get_where('business_profile', array('user_id' => $total['not_from_id']))->row()->company_name;
                    $postid = $this->db->get_where('post_image', array('image_id' => $total['post_image_id']))->row()->post_id;
                    $notification .= '<li class="';
                    if ($total['not_active'] == 1) {
                        $notification .= 'active2';
                    }
                    $notification .= '"';
                    $notification .= '><a href="' . base_url('notification/bus_post_img/' . $postid . '/' . $total['post_image_id']) . '" onClick="not_active(' . $total['not_id'] . ')"><div class="notification-database"><div class="notification-pic" >';
                    $filepath = FCPATH . $this->config->item('bus_profile_thumb_upload_path') . $total['user_image'];
                    if ($total['user_image'] && (file_exists($filepath)) == 1) {
                        $notification .= '<img src="' . base_url($this->config->item('bus_profile_thumb_upload_path') . $total['user_image']) . '" >';
                    } else {
                        $a = $companyname;
                        $acr = substr($a, 0, 1);


                        $notification .= '<div class="post-img-div">';
                        $notification .= '' . ucwords($acr) . '';
                        $notification .= '</div>';
                    }
                    $notification .= '</div>';
                    $notification .= '<div class="notification-data-inside">';
                    $notification .= '<h6><b>' . ucwords($companyname) . '</b> <span class="noti-msg-y"> Likes your photos comment in business profile.</h6>';
                    $notification .= '<div ><i class="clockimg" ></i><span class="day-text">';
                    $notification .= '' . $this->common->time_elapsed_string($total['not_created_date'], $full = false) . '';
                    $notification .= '</span></div> </div>';
                    $notification .= '</div></a>';
                    $notification .= '</li>';
                }
            }
            //16
            if ($total['not_from'] == 2) {

                $notification .= '<li class="';
                if ($total['not_active'] == 1) {
                    $notification .= 'active2';
                }
                $notification .= '"';
                $notification .= '><a href="' . base_url('job/job_printpreview/' . $total['not_from_id'] . '?page=recruiter') . '" onClick="not_active(' . $total['not_id'] . ')"><div class="notification-database">';
                $notification .= '<div class="notification-pic">';
                $filepath = FCPATH . $this->config->item('job_profile_thumb_upload_path') . $total['user_image'];
                if ($total['user_image'] && (file_exists($filepath)) == 1) {
                    $notification .= '<img src="' . base_url($this->config->item('job_profile_thumb_upload_path') . $total['user_image']) . '" >';
                } else {
                    $a = $total['first_name'];
                    $b = $total['last_name'];
                    $acr = substr($a, 0, 1);
                    $bcr = substr($b, 0, 1);

                    $notification .= '<div class="post-img-div">';
                    $notification .= '' . ucwords($acr) . ucwords($bcr) . '';
                    $notification .= '</div>';
                }
                $notification .= '</div><div class="notification-data-inside">';
                $notification .= '<h6><font color="black"><b><span class="noti-msg-y"> Job seeker</span></font></b><b>' . '  ' . ucwords($total['first_name']) . ' ' . ucwords($total['last_name']) . '</b> <span class="noti-msg-y"> Applied on your jobpost. </sapn></h6>';
                $notification .= '<div ><i class="clockimg" ></i><span class="day-text">';
                $notification .= '' . $this->common->time_elapsed_string($total['not_created_date'], $full = false) . '';
                $notification .= '</sapn></div></div> </div></a> </li>';
            }
            //17
            if ($total['not_from'] == 4) {

                $notification .= '<li class="';
                if ($total['not_active'] == 1) {
                    $notification .= 'active2';
                }
                $notification .= '"';
                $notification .= '><a href="' . base_url('freelancer/freelancer_post_profile/' . $total['not_from_id'] . '?page=freelancer_hire') . '" onClick="not_active(' . $total['not_id'] . ')"><div class="notification-database">';
                $notification .= '<div class="notification-pic">';
                $filepath = FCPATH . $this->config->item('free_post_profile_thumb_upload_path') . $total['user_image'];
                if ($total['user_image'] && (file_exists($filepath)) == 1) {
                    $notification .= '<img src="' . base_url($this->config->item('free_post_profile_thumb_upload_path') . $total['user_image']) . '" >';
                } else {
                    $a = $total['first_name'];
                    $b = $total['last_name'];
                    $acr = substr($a, 0, 1);
                    $bcr = substr($b, 0, 1);

                    $notification .= '<div class="post-img-div">';
                    $notification .= '' . ucwords($acr) . ucwords($bcr) . '';
                    $notification .= '</div>';
                }
                $notification .= '</div><div class="notification-data-inside">';
                $notification .= '<h6><font color="black"><b><span class="noti-msg-y">Freelancer</span></font></b><b>' . '  ' . ucwords($total['first_name']) . ' ' . ucwords($total['last_name']) . '</b> <span class="noti-msg-y"> Applied on your post. </span></h6>';
                $notification .= '<div ><i class="clockimg" ></i><span class="day-text">';
                $notification .= '' . $this->common->time_elapsed_string($total['not_created_date'], $full = false) . '';
                $notification .= '</span></div></div> </div></a> </li>';
            }
            //18
            if ($total['not_from'] == 5) {

                $notification .= '<li class="';
                if ($total['not_active'] == 1) {
                    $notification .= 'active2';
                }
                $notification .= '"';
                $notification .= '><a href="' . base_url('notification/freelancer_hire_post/' . $total['post_id'] . '?page=freelancer_post') . '" onClick="not_active(' . $total['not_id'] . ')"><div class="notification-database">';
                $notification .= '<div class="notification-pic">';
                $filepath = FCPATH . $this->config->item('free_hire_profile_thumb_upload_path') . $total['user_image'];
                if ($total['user_image'] && (file_exists($filepath)) == 1) {
                    $notification .= '<img src="' . base_url($this->config->item('free_hire_profile_thumb_upload_path') . $total['user_image']) . '" >';
                } else {
                    $a = $total['first_name'];
                    $b = $total['last_name'];
                    $acr = substr($a, 0, 1);
                    $bcr = substr($b, 0, 1);

                    $notification .= '<div class="post-img-div">';
                    $notification .= '' . ucwords($acr) . ucwords($bcr) . '';
                    $notification .= '</div>';
                }
                $notification .= '</div><div class="notification-data-inside">';
                $notification .= '<h6><font color="black"><b><span class="noti-msg-y">Employer</span></font></b><b>' . '  ' . ucwords($total['first_name']) . ' ' . ucwords($total['last_name']) . '</b> <span class="noti-msg-y"> Selected you for project. </span> </h6>';
                $notification .= '<div ><i class="clockimg" ></i><span class="day-text">';
                $notification .= '' . $this->common->time_elapsed_string($total['not_created_date'], $full = false) . '';
                $notification .= '</span></div></div> </div> </a></li>';
            }

            $i++;
            if ($i == 10) {
                break;
            }
        }
        if($totalnotification){
      $seeall = '<a href="' . base_url() . 'notification">See All</a>';
    
        }else{
         $seeall = '<div class="fw">
  <div class="art-img-nn">
                                                <div class="art_no_post_img">
                                                    <img src="' . base_url() . 'img/icon_notification_big.png">
                                                </div>
                                                <div class="art_no_post_text_c">
                                                    No Notification Available.
                                                </div>
                             </div></div>';      
        }
        
       
       
      echo json_encode(
                        array(
                            "notification" => $notification,
                            "seeall" => $seeall,
                ));

      
    }

    public function msg_header($id = "") {
        $message_from_profile = $_POST['message_from_profile'];
        $message_to_profile = $_POST['message_to_profile'];

        $this->data['userid'] = $userid = $this->session->userdata('aileenuser');
        // khyati chnages 22-7 start
        // last message user fetch

        if ($id == "") {
            $contition_array = array('id !=' => '');

            $search_condition = "(message_from = '$userid' OR message_to = '$userid')";

            $lastuser = $this->common->select_data_by_search('messages', $search_condition, $contition_array, $data = 'messages.message_from,message_to,id', $sortby = 'id', $orderby = 'DESC', $limit = '1', $offset = '', $join_str = '', $groupby = '');

            if ($lastuser[0]['message_from'] == $userid) {

                $id = $this->data['lstusr'] = $lastuser[0]['message_to'];
            } else {

                $id = $this->data['lstusr'] = $lastuser[0]['message_from'];
            }
        }    // from job 22-7 end
        if ($message_from_profile == 1) {
            $contition_array = array('user_id' => $userid, 'is_delete' => '0', 'status' => '1');
            $message_from_profile_data = $this->common->select_data_by_condition('job_reg', $contition_array, $data = 'job_id,fname,lname,job_user_image,designation,user_id', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
            $message_from_profile_id = $this->data['message_from_profile_id'] = $message_from_profile_data[0]['job_id'];

            $this->data['message_from_profile'] = 1;
            $this->data['message_to_profile'] = 2;

            // last user etail start
            $contition_array = array('user_id' => $id, 'is_delete' => '0', 're_status' => '1');
            $last_user_data = $this->common->select_data_by_condition('recruiter', $contition_array, $data = 'rec_id,rec_firstname,rec_lastname,recruiter_user_image,designation,user_id', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

            $this->data['last_user_data']['user_profile_id'] = $last_user_data[0]['rec_id'];
            $this->data['last_user_data']['user_name'] = $last_user_data[0]['rec_firstname'] . ' ' . $last_user_data[0]['rec_lastname'];
            if ($last_user_data[0]['recruiter_user_image'] != '') {
                $this->data['last_user_data']['user_image'] = base_url() . 'uploads/recruiter_profile/thumbs/' . $last_user_data[0]['recruiter_user_image'];
            } else {
                $this->data['last_user_data']['user_image'] = base_url() . NOIMAGE;
            }
            $this->data['last_user_data']['user_designation'] = $last_user_data[0]['designation'] == '' ? 'Current Work' : $last_user_data[0]['designation'];

            // last user detail end
        }
        if ($message_to_profile == 1) {
            $contition_array = array('user_id' => $id, 'is_delete' => '0', 'status' => '1');
            $message_to_profile_data = $this->common->select_data_by_condition('job_reg', $contition_array, $data = 'job_id,fname,lname,job_user_image,designation,user_id', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
            $this->data['message_to_profile_id'] = $message_to_profile_data[0]['job_id'];
        }

        // from recruiter
        if ($message_from_profile == 2) {
            $contition_array = array('user_id' => $userid, 'is_delete' => '0', 're_status' => '1');
            $message_from_profile_data = $this->common->select_data_by_condition('recruiter', $contition_array, $data = 'rec_id,rec_firstname,rec_lastname,recruiter_user_image,designation,user_id', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
            $message_from_profile_id = $this->data['message_from_profile_id'] = $message_from_profile_data[0]['rec_id'];


            $this->data['message_from_profile'] = 2;
            $this->data['message_to_profile'] = 1;



            // last user detail start
            $contition_array = array('user_id' => $id, 'is_delete' => '0', 'status' => '1');
            $last_user_data = $this->common->select_data_by_condition('job_reg', $contition_array, $data = 'job_id,fname,lname,job_user_image,designation,user_id', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

            $this->data['last_user_data']['user_profile_id'] = $last_user_data[0]['rec_id'];
            $this->data['last_user_data']['user_name'] = $last_user_data[0]['fname'] . ' ' . $last_user_data[0]['lname'];
            if ($last_user_data[0]['job_user_image'] != '') {
                $this->data['last_user_data']['user_image'] = base_url() . 'uploads/job_profile/thumbs/' . $last_user_data[0]['job_user_image'];
            } else {
                $this->data['last_user_data']['user_image'] = base_url() . NOIMAGE;
            }
            $this->data['last_user_data']['user_designation'] = $last_user_data[0]['designation'] == '' ? 'Current Work' : $last_user_data[0]['designation'];

            // last user detail end
        }


        if ($message_to_profile == 2) {
            $contition_array = array('user_id' => $id, 'is_delete' => '0', 're_status' => '1');
            $message_to_profile_id = $this->common->select_data_by_condition('recruiter', $contition_array, $data = 'rec_id,rec_firstname,rec_lastname,recruiter_user_image,designation,user_id', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
            $this->data['message_to_profile_id'] = $message_to_profile_id[0]['rec_id'];
        }

        // from freelancer hire
        if ($message_from_profile == 3) {
            $contition_array = array('user_id' => $userid, 'is_delete' => '0', 'status' => '1');
            $message_from_profile_id = $this->common->select_data_by_condition('freelancer_hire_reg', $contition_array, $data = 'reg_id,user_id', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
            $message_from_profile_id = $this->data['message_from_profile_id'] = $message_from_profile_id[0]['reg_id'];


            $this->data['message_from_profile'] = 3;
            $this->data['message_to_profile'] = 4;

            // last user detail start
            $contition_array = array('user_id' => $id, 'is_delete' => '0', 'status' => '1');
            $last_user_data = $this->common->select_data_by_condition('freelancer_post_reg', $contition_array, $data = 'freelancer_post_reg_id,freelancer_post_username,freelancer_post_fullname,freelancer_post_user_image,user_id', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

            $this->data['last_user_data']['user_profile_id'] = $last_user_data[0]['freelancer_post_reg_id'];
            $this->data['last_user_data']['user_name'] = $last_user_data[0]['freelancer_post_fullname'] . ' ' . $last_user_data[0]['freelancer_post_username'];
            if ($last_user_data[0]['freelancer_post_user_image'] != '') {
                $this->data['last_user_data']['user_image'] = base_url() . 'uploads/freelancer_post_profile/thumbs/' . $last_user_data[0]['freelancer_post_user_image'];
            } else {
                $this->data['last_user_data']['user_image'] = base_url() . NOIMAGE;
            }
            $this->data['last_user_data']['user_designation'] = $last_user_data[0]['designation'] == '' ? 'Current Work' : $last_user_data[0]['designation'];

            // last user detail end
        }

        if ($message_to_profile == 3) {
            $contition_array = array('user_id' => $id, 'is_delete' => '0', 'status' => '1');
            $message_to_profile_id = $this->common->select_data_by_condition('freelancer_hire_reg', $contition_array, $data = 'reg_id,user_id', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
            $this->data['message_to_profile_id'] = $message_to_profile_id[0]['reg_id'];
        }
        // from freelancer post
        if ($message_from_profile == 4) {
            $contition_array = array('user_id' => $userid, 'is_delete' => '0', 'status' => '1');
            $message_from_profile_id = $this->common->select_data_by_condition('freelancer_post_reg', $contition_array, $data = 'freelancer_post_reg_id,user_id', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
            $message_from_profile_id = $this->data['message_from_profile_id'] = $message_from_profile_id[0]['freelancer_post_reg_id'];


            $this->data['message_from_profile'] = 4;
            $this->data['message_to_profile'] = 3;



            // last user detail start
            $contition_array = array('user_id' => $id, 'is_delete' => '0', 'status' => '1');
            $last_user_data = $this->common->select_data_by_condition('freelancer_hire_reg', $contition_array, $data = 'reg_id,username,fullname,freelancer_hire_user_image,user_id', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

            $this->data['last_user_data']['user_profile_id'] = $last_user_data[0]['rec_id'];
            $this->data['last_user_data']['user_name'] = $last_user_data[0]['fullname'] . ' ' . $last_user_data[0]['username'];
            if ($last_user_data[0]['freelancer_hire_user_image'] != '') {
                $this->data['last_user_data']['user_image'] = base_url() . 'uploads/freelancer_hire_profile/thumbs/' . $last_user_data[0]['freelancer_hire_user_image'];
            } else {
                $this->data['last_user_data']['user_image'] = base_url() . NOIMAGE;
            }
            $this->data['last_user_data']['user_designation'] = $last_user_data[0]['designation'] == '' ? 'Current Work' : $last_user_data[0]['designation'];

            // last user detail end
        }

        if ($message_to_profile == 4) {
            $contition_array = array('user_id' => $id, 'is_delete' => '0', 'status' => '1');
            $message_to_profile_id = $this->common->select_data_by_condition('freelancer_post_reg', $contition_array, $data = 'freelancer_post_reg_id,user_id', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
            $this->data['message_to_profile_id'] = $message_to_profile_id[0]['freelancer_post_reg_id'];
        }
        // from business
        if ($message_from_profile == 5) {
            $contition_array = array('user_id' => $userid, 'business_profile.is_deleted' => '0', 'status' => '1');
            $message_from_profile_id = $this->common->select_data_by_condition('business_profile', $contition_array, $data = 'business_profile_id,user_id', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
            $message_from_profile_id = $this->data['message_from_profile_id'] = $message_from_profile_id[0]['business_profile_id'];

            $this->data['message_from_profile'] = $this->data['message_to_profile'] = 5;
            // last user detail start
            $contition_array = array('user_id' => $userid, 'business_profile.is_deleted' => '0', 'status' => '1');
            $last_user_data = $this->common->select_data_by_condition('business_profile', $contition_array, $data = 'business_profile_id,company_name,business_user_image,user_id', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

            $this->data['last_user_data']['user_profile_id'] = $last_user_data[0]['business_profile_id'];
            $this->data['last_user_data']['user_name'] = $last_user_data[0]['company_name'];
            if ($last_user_data[0]['business_user_image'] != '') {
                $this->data['last_user_data']['user_image'] = base_url() . 'uploads/business_profile/thumbs/' . $last_user_data[0]['business_user_image'];
            } else {
                $this->data['last_user_data']['user_image'] = base_url() . NOIMAGE;
            }
            $this->data['last_user_data']['user_designation'] = $last_user_data[0]['designation'] == '' ? 'Current Work' : $last_user_data[0]['designation'];

            // last user detail end
        }

        if ($message_to_profile == 5) {
            $contition_array = array('user_id' => $id, 'business_profile.is_deleted' => '0', 'status' => '1');
            $message_to_profile_id = $this->common->select_data_by_condition('business_profile', $contition_array, $data = 'business_profile_id,user_id', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
            $this->data['message_to_profile_id'] = $message_to_profile_id[0]['business_profile_id'];
        }
        // from artistic
        if ($message_from_profile == 6) {
            $contition_array = array('user_id' => $userid, 'is_delete' => '0', 'status' => '1');
            $message_from_profile_id = $this->common->select_data_by_condition('art_reg', $contition_array, $data = 'art_id,user_id', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
            $message_from_profile_id = $this->data['message_from_profile_id'] = $message_from_profile_id[0]['art_id'];


            $this->data['message_from_profile'] = $this->data['message_to_profile'] = 6;

            // last user detail start
            $contition_array = array('user_id' => $userid, 'is_delete' => '0', 'status' => '1');
            $last_user_data = $this->common->select_data_by_condition('art_reg', $contition_array, $data = 'art_id,art_name,art_lastname,art_user_image,user_id', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

            $this->data['last_user_data']['user_profile_id'] = $last_user_data[0]['art_id'];
            $this->data['last_user_data']['user_name'] = $last_user_data[0]['art_name'] . ' ' . $last_user_data[0]['art_lastname'];
            if ($last_user_data[0]['art_user_image'] != '') {
                $this->data['last_user_data']['user_image'] = base_url() . 'uploads/business_profile/thumbs/' . $last_user_data[0]['art_user_image'];
            } else {
                $this->data['last_user_data']['user_image'] = base_url() . NOIMAGE;
            }
            $this->data['last_user_data']['user_designation'] = $last_user_data[0]['designation'] == '' ? 'Current Work' : $last_user_data[0]['designation'];

            // last user detail end
        }

        if ($message_to_profile == 6) {
            $contition_array = array('user_id' => $id, 'is_delete' => '0', 'status' => '1');
            $message_to_profile_id = $this->common->select_data_by_condition('art_reg', $contition_array, $data = 'art_id,user_id', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
            $this->data['message_to_profile_id'] = $message_to_profile_id[0]['art_id'];
        }

        // last user if $id is null
        $contition_array = array('id !=' => '');
        $search_condition = "(message_from = '$userid' OR message_to = '$userid') AND ((message_from_profile = $message_from_profile AND message_to_profile = $message_to_profile) OR (message_from_profile = $message_to_profile AND message_to_profile = $message_from_profile)) AND (message_from_profile_id = $message_from_profile_id OR message_to_profile_id = $message_from_profile_id)";
        $lastchat = $this->common->select_data_by_search('messages', $search_condition, $contition_array, $data = 'messages.message_from,message_to,id', $sortby = 'id', $orderby = 'DESC', $limit = '1', $offset = '', $join_str = '', $groupby = '');

        if ($id) {
            $toid = $this->data['toid'] = $id;
        } elseif ($lastchat[0]['message_from'] == $userid) {
            $toid = $this->data['toid'] = $lastchat[0]['message_to'];
        } else {
            $toid = $this->data['toid'] = $lastchat[0]['message_from'];
        }

        //20-7@nkit
        if ($message_from_profile == 1) {
            $loginuser = $this->common->select_data_by_id('job_reg', 'user_id', $userid, $data = 'fname as first_name,lname as last_name,user_id');
        }

        if ($message_from_profile == 2) {
            $loginuser = $this->common->select_data_by_id('recruiter', 'user_id', $userid, $data = 'rec_firstname as first_name,rec_lastname as last_name,user_id');
        }

        if ($message_from_profile == 3) {
            $loginuser = $this->common->select_data_by_id('freelancer_hire_reg', 'user_id', $userid, $data = 'username as last_name,fullname as first_name,user_id');
        }

        if ($message_from_profile == 4) {
            $loginuser = $this->common->select_data_by_id('freelancer_post_reg', 'user_id', $userid, $data = 'freelancer_post_fullname as first_name,freelancer_post_username as last_name,user_id');
        }

        if ($message_from_profile == 5) {
            $loginuser = $this->common->select_data_by_id('business_profile', 'user_id', $userid, $data = 'company_name as first_name,user_id');
        }

        if ($message_from_profile == 6) {
            $loginuser = $this->common->select_data_by_id('art_reg', 'user_id', $userid, $data = 'art_name as first_name,art_lastname as last_name,user_id');
        }


        $this->data['logfname'] = $loginuser[0]['first_name'];
        $this->data['loglname'] = $loginuser[0]['last_name'];

        // last message user fetch

        $contition_array = array('id !=' => '');
        $search_condition = "(message_from = '$id' OR message_to = '$id')  AND ((message_from_profile = $message_from_profile AND message_to_profile = $message_to_profile) OR (message_from_profile = $message_to_profile AND message_to_profile = $message_from_profile)) AND (message_from_profile_id = $message_from_profile_id OR message_to_profile_id = $message_from_profile_id)";
        $lastuser = $this->common->select_data_by_search('messages', $search_condition, $contition_array, $data = 'messages.message_from,message_to,id', $sortby = 'id', $orderby = 'DESC', $limit = '1', $offset = '', $join_str = '', $groupby = '');

        if ($lastuser[0]['message_from'] == $userid) {
            $lstusr = $this->data['lstusr'] = $lastuser[0]['message_to'];
        } else {
            $lstusr = $this->data['lstusr'] = $lastuser[0]['message_from'];
        }

        // last user first name last name
        if ($lstusr) {

            //20-7@nkit
            if ($message_from_profile == 1) {
                $lastuser = $this->common->select_data_by_id('job_reg', 'user_id', $lstusr, $data = 'fname as first_name,lname as last_name,user_id');
            }

            if ($message_from_profile == 2) {
                $lastuser = $this->common->select_data_by_id('recruiter', 'user_id', $lstusr, $data = 'rec_firstname as first_name,rec_lastname as last_name,user_id');
            }

            if ($message_from_profile == 3) {
                $lastuser = $this->common->select_data_by_id('freelancer_hire_reg', 'user_id', $lstusr, $data = 'username as last_name,fullname as first_name,user_id');
            }

            if ($message_from_profile == 4) {
                $lastuser = $this->common->select_data_by_id('freelancer_post_reg', 'user_id', $lstusr, $data = 'freelancer_post_fullname as first_name,freelancer_post_username as last_name,user_id');
            }

            if ($message_from_profile == 5) {
                $lastuser = $this->common->select_data_by_id('business_profile', 'user_id', $lstusr, $data = 'company_name as first_name,user_id');
            }

            if ($message_from_profile == 6) {
                $lastuser = $this->common->select_data_by_id('art_reg', 'user_id', $lstusr, $data = 'art_name as first_name,art_lastname as last_name,user_id');
            }

//            $lastuser = $this->common->select_data_by_id('user', 'user_id', $lstusr, $data = 'first_name,last_name');

            $this->data['lstfname'] = $lastuser[0]['first_name'];
            $this->data['lstlname'] = $lastuser[0]['last_name'];
        }
        // slected user chat to

        $contition_array = array('is_delete' => '0', 'status' => '1');
        $search_condition = "((message_from = '$id' OR message_to = '$id') && (message_to != '$userid'))  AND ((message_from_profile = $message_from_profile AND message_to_profile = $message_to_profile) OR (message_from_profile = $message_to_profile AND message_to_profile = $message_from_profile)) AND (message_from_profile_id = $message_from_profile_id OR message_to_profile_id = $message_from_profile_id) AND is_message_from_delete != $userid AND is_message_to_delete != $userid";

        //20-7-2017@nkit
        if ($message_from_profile == 2) {
            $join_str1[0]['table'] = 'messages';
            $join_str1[0]['join_table_id'] = 'messages.message_to';
            $join_str1[0]['from_table_id'] = 'job_reg.user_id';
            $join_str1[0]['join_type'] = '';

            $seltousr = $this->common->select_data_by_search('job_reg', $search_condition, $contition_array, $data = 'messages.id,message_to,fname as first_name,lname as last_name,job_user_image as user_image ,message,user_id', $sortby = 'messages.id', $orderby = 'DESC', $limit = '', $offset = '', $join_str1, $groupby = '');
        }
        if ($message_from_profile == 1) {
            $join_str1[0]['table'] = 'messages';
            $join_str1[0]['join_table_id'] = 'messages.message_to';
            $join_str1[0]['from_table_id'] = 'recruiter.user_id';
            $join_str1[0]['join_type'] = '';
            $contition_array = array('is_delete' => '0', 're_status' => '1');
            $seltousr = $this->common->select_data_by_search('recruiter', $search_condition, $contition_array, $data = 'messages.id,message_to,rec_firstname as first_name,rec_lastname as last_name,recruiter_user_image as user_image ,message,user_id', $sortby = 'messages.id', $orderby = 'DESC', $limit = '', $offset = '', $join_str1, $groupby = '');
        }
        if ($message_from_profile == 4) {
            $join_str1[0]['table'] = 'messages';
            $join_str1[0]['join_table_id'] = 'messages.message_to';
            $join_str1[0]['from_table_id'] = 'freelancer_hire_reg.user_id';
            $join_str1[0]['join_type'] = '';

            $seltousr = $this->common->select_data_by_search('freelancer_hire_reg', $search_condition, $contition_array, $data = 'messages.id,message_to,username as last_name,fullname as first_name,freelancer_hire_user_image as user_image ,message,user_id', $sortby = 'messages.id', $orderby = 'DESC', $limit = '', $offset = '', $join_str1, $groupby = '');
        }
        if ($message_from_profile == 3) {
            $join_str1[0]['table'] = 'messages';
            $join_str1[0]['join_table_id'] = 'messages.message_to';
            $join_str1[0]['from_table_id'] = 'freelancer_post_reg.user_id';
            $join_str1[0]['join_type'] = '';

            $seltousr = $this->common->select_data_by_search('freelancer_post_reg', $search_condition, $contition_array, $data = 'messages.id,message_to,freelancer_post_fullname as first_name,freelancer_post_username as last_name,freelancer_post_user_image as user_image ,message,user_id', $sortby = 'messages.id', $orderby = 'DESC', $limit = '', $offset = '', $join_str1, $groupby = '');
        }
        if ($message_from_profile == 5) {
            $join_str1[0]['table'] = 'messages';
            $join_str1[0]['join_table_id'] = 'messages.message_to';
            $join_str1[0]['from_table_id'] = 'business_profile.user_id';
            $join_str1[0]['join_type'] = '';
            $contition_array = array('business_profile.is_deleted' => '0', 'status' => '1');
            $seltousr = $this->common->select_data_by_search('business_profile', $search_condition, $contition_array, $data = 'messages.id,message_to,company_name as first_name,business_user_image as user_image ,message,user_id', $sortby = 'messages.id', $orderby = 'DESC', $limit = '', $offset = '', $join_str1, $groupby = '');
        }
        if ($message_from_profile == 6) {
            $join_str1[0]['table'] = 'messages';
            $join_str1[0]['join_table_id'] = 'messages.message_to';
            $join_str1[0]['from_table_id'] = 'art_reg.user_id';
            $join_str1[0]['join_type'] = '';

            $seltousr = $this->common->select_data_by_search('art_reg', $search_condition, $contition_array, $data = 'messages.id,message_to,art_name as first_name,art_lastname as last_name,art_user_image as user_image ,message,user_id', $sortby = 'messages.id', $orderby = 'DESC', $limit = '', $offset = '', $join_str1, $groupby = '');
        }

        // slected user chat from

        $contition_array = array('is_delete' => '0', 'status' => '1');
        $search_condition = "((message_from = '$id' OR message_to = '$id') && (message_from != '$userid')) AND ((message_from_profile = $message_from_profile AND message_to_profile = $message_to_profile) OR (message_from_profile = $message_to_profile AND message_to_profile = $message_from_profile)) AND (message_from_profile_id = $message_from_profile_id OR message_to_profile_id = $message_from_profile_id) AND is_message_from_delete != $userid AND is_message_to_delete != $userid";

        //20-7-2017@nkit
        if ($message_from_profile == 2) {
            $join_str2[0]['table'] = 'messages';
            $join_str2[0]['join_table_id'] = 'messages.message_from';
            $join_str2[0]['from_table_id'] = 'job_reg.user_id';
            $join_str2[0]['join_type'] = '';

            $selfromusr = $this->common->select_data_by_search('job_reg', $search_condition, $contition_array, $data = 'messages.id,message_from,fname as first_name,lname as last_name,job_user_image as user_image ,message,user_id', $sortby = 'messages.id', $orderby = 'DESC', $limit = '', $offset = '', $join_str2, $groupby = '');
        }
        if ($message_from_profile == 1) {
            $join_str2[0]['table'] = 'messages';
            $join_str2[0]['join_table_id'] = 'messages.message_from';
            $join_str2[0]['from_table_id'] = 'recruiter.user_id';
            $join_str2[0]['join_type'] = '';
            $contition_array = array('is_delete' => '0', 're_status' => '1');
            $selfromusr = $this->common->select_data_by_search('recruiter', $search_condition, $contition_array, $data = 'messages.id,message_from,rec_firstname as first_name,rec_lastname as last_name,recruiter_user_image as user_image ,message,user_id', $sortby = 'messages.id', $orderby = 'DESC', $limit = '', $offset = '', $join_str2, $groupby = '');
        }
        if ($message_from_profile == 4) {
            $join_str2[0]['table'] = 'messages';
            $join_str2[0]['join_table_id'] = 'messages.message_from';
            $join_str2[0]['from_table_id'] = 'freelancer_hire_reg.user_id';
            $join_str2[0]['join_type'] = '';

            $selfromusr = $this->common->select_data_by_search('freelancer_hire_reg', $search_condition, $contition_array, $data = 'messages.id,message_from,username as last_name,fullname as first_name,freelancer_hire_user_image as user_image ,message,user_id', $sortby = 'messages.id', $orderby = 'DESC', $limit = '', $offset = '', $join_str2, $groupby = '');
        }
        if ($message_from_profile == 3) {
            $join_str2[0]['table'] = 'messages';
            $join_str2[0]['join_table_id'] = 'messages.message_from';
            $join_str2[0]['from_table_id'] = 'freelancer_post_reg.user_id';
            $join_str2[0]['join_type'] = '';

            $selfromusr = $this->common->select_data_by_search('freelancer_post_reg', $search_condition, $contition_array, $data = 'messages.id,message_from,freelancer_post_fullname as first_name,freelancer_post_username as last_name,freelancer_post_user_image as user_image ,message,user_id', $sortby = 'messages.id', $orderby = 'DESC', $limit = '', $offset = '', $join_str2, $groupby = '');
        }
        if ($message_from_profile == 5) {
            $join_str2[0]['table'] = 'messages';
            $join_str2[0]['join_table_id'] = 'messages.message_from';
            $join_str2[0]['from_table_id'] = 'business_profile.user_id';
            $join_str2[0]['join_type'] = '';
            $contition_array = array('business_profile.is_deleted' => '0', 'status' => '1');
            $selfromusr = $this->common->select_data_by_search('business_profile', $search_condition, $contition_array, $data = 'messages.id,message_from,company_name as first_name,business_user_image as user_image ,message,user_id', $sortby = 'messages.id', $orderby = 'DESC', $limit = '', $offset = '', $join_str2, $groupby = '');
        }
        if ($message_from_profile == 6) {
            $join_str2[0]['table'] = 'messages';
            $join_str2[0]['join_table_id'] = 'messages.message_from';
            $join_str2[0]['from_table_id'] = 'art_reg.user_id';
            $join_str2[0]['join_type'] = '';

            $selfromusr = $this->common->select_data_by_search('art_reg', $search_condition, $contition_array, $data = 'messages.id,message_from,art_name as first_name,art_lastname as last_name,art_user_image as user_image ,message,user_id', $sortby = 'messages.id', $orderby = 'DESC', $limit = '', $offset = '', $join_str2, $groupby = '');
        }

        $selectuser = array_merge($seltousr, $selfromusr);
        $selectuser = $this->aasort($selectuser, "id");
        // replace name of message_to in user_id in select user

        $return_arraysel = array();
        $i = 0;
        foreach ($selectuser as $k => $sel_list) {
            $return = array();
            $return = $sel_list;

            if ($sel_list['message_to']) {
                if ($sel_list['message_to'] == $id) {
                    $return['user_id'] = $sel_list['message_to'];
                    $return['first_name'] = $sel_list['first_name'];
                    $return['last_name'] = $sel_list['last_name'];
                    $return['user_image'] = $sel_list['user_image'];
                    $return['message'] = $sel_list['message'];

                    unset($return['message_to']);

                    $i++;
                    if ($i == 1)
                        break;
                }
            }else {
                if ($sel_list['message_from'] == $id) {
                    $return['user_id'] = $sel_list['message_from'];
                    $return['first_name'] = $sel_list['first_name'];
                    $return['last_name'] = $sel_list['last_name'];
                    $return['user_image'] = $sel_list['user_image'];
                    $return['message'] = $sel_list['message'];

                    $i++;
                    if ($i == 1)
                        break;
                }

                unset($return['message_from']);
            }
        } array_push($return_arraysel, $return);

        // message to user
        $contition_array = array('is_delete' => '0', 'status' => '1', 'message_to !=' => $userid);
        $search_condition = "((message_from = '$userid') && (message_to != '$id')) AND ((message_from_profile = $message_from_profile AND message_to_profile = $message_to_profile) OR (message_from_profile = $message_to_profile AND message_to_profile = $message_from_profile)) AND (message_from_profile_id = $message_from_profile_id OR message_to_profile_id = $message_from_profile_id) AND is_message_from_delete != $userid AND is_message_to_delete != $userid";

        //20-7-2017@nkit
        if ($message_from_profile == 2) {
            $join_str3[0]['table'] = 'messages';
            $join_str3[0]['join_table_id'] = 'messages.message_to';
            $join_str3[0]['from_table_id'] = 'job_reg.user_id';
            $join_str3[0]['join_type'] = '';

            $tolist = $this->common->select_data_by_search('job_reg', $search_condition, $contition_array, $data = 'messages.id,message_to,fname as first_name,lname as last_name,job_user_image as user_image ,message,user_id', $sortby = 'messages.id', $orderby = 'ASC', $limit = '', $offset = '', $join_str3, $groupby = '');
        }
        if ($message_from_profile == 1) {
            $join_str3[0]['table'] = 'messages';
            $join_str3[0]['join_table_id'] = 'messages.message_to';
            $join_str3[0]['from_table_id'] = 'recruiter.user_id';
            $join_str3[0]['join_type'] = '';
            $contition_array = array('is_delete' => '0', 're_status' => '1');
            $tolist = $this->common->select_data_by_search('recruiter', $search_condition, $contition_array, $data = 'messages.id,message_to,rec_firstname as first_name,rec_lastname as last_name,recruiter_user_image as user_image ,message,user_id', $sortby = 'messages.id', $orderby = 'ASC', $limit = '', $offset = '', $join_str3, $groupby = '');
        }
        if ($message_from_profile == 4) {
            $join_str3[0]['table'] = 'messages';
            $join_str3[0]['join_table_id'] = 'messages.message_to';
            $join_str3[0]['from_table_id'] = 'freelancer_hire_reg.user_id';
            $join_str3[0]['join_type'] = '';

            $tolist = $this->common->select_data_by_search('freelancer_hire_reg', $search_condition, $contition_array, $data = 'messages.id,message_to,username as last_name,fullname as first_name,freelancer_hire_user_image as user_image ,message,user_id', $sortby = 'messages.id', $orderby = 'ASC', $limit = '', $offset = '', $join_str3, $groupby = '');
        }
        if ($message_from_profile == 3) {
            $join_str3[0]['table'] = 'messages';
            $join_str3[0]['join_table_id'] = 'messages.message_to';
            $join_str3[0]['from_table_id'] = 'freelancer_post_reg.user_id';
            $join_str3[0]['join_type'] = '';

            $tolist = $this->common->select_data_by_search('freelancer_post_reg', $search_condition, $contition_array, $data = 'messages.id,message_to,freelancer_post_fullname as first_name,freelancer_post_username as last_name,freelancer_post_user_image as user_image ,message,user_id', $sortby = 'messages.id', $orderby = 'ASC', $limit = '', $offset = '', $join_str3, $groupby = '');
        }
        if ($message_from_profile == 5) {
            $join_str3[0]['table'] = 'messages';
            $join_str3[0]['join_table_id'] = 'messages.message_to';
            $join_str3[0]['from_table_id'] = 'business_profile.user_id';
            $join_str3[0]['join_type'] = '';
            $contition_array = array('business_profile.is_deleted' => '0', 'status' => '1');
            $tolist = $this->common->select_data_by_search('business_profile', $search_condition, $contition_array, $data = 'messages.id,message_to,company_name as first_name,business_user_image as user_image ,message,user_id', $sortby = 'messages.id', $orderby = 'ASC', $limit = '', $offset = '', $join_str3, $groupby = '');
        }
        if ($message_from_profile == 6) {
            $join_str3[0]['table'] = 'messages';
            $join_str3[0]['join_table_id'] = 'messages.message_to';
            $join_str3[0]['from_table_id'] = 'art_reg.user_id';
            $join_str3[0]['join_type'] = '';

            $tolist = $this->common->select_data_by_search('art_reg', $search_condition, $contition_array, $data = 'messages.id,message_to,art_name as first_name,art_lastname as last_name,art_user_image as user_image ,message,user_id', $sortby = 'messages.id', $orderby = 'ASC', $limit = '', $offset = '', $join_str3, $groupby = '');
        }

        // uniq array of tolist  
        foreach ($tolist as $k => $v) {
            foreach ($tolist as $key => $value) {

                if ($k != $key && $v['message_to'] == $value['message_to']) {
                    unset($tolist[$k]);
                }
            }
        }

        // replace name of message_to in user_id
        $return_arrayto = array();

        foreach ($tolist as $to_list) {
            if ($to_list['message_to'] != $id) {
                $return = array();
                $return = $to_list;

                $return['user_id'] = $to_list['message_to'];
                $return['first_name'] = $to_list['first_name'];
                $return['last_name'] = $to_list['last_name'];
                $return['user_image'] = $to_list['user_image'];
                $return['message'] = $to_list['message'];


                unset($return['message_to']);
                array_push($return_arrayto, $return);
            }
        }

        // message from user
        $contition_array = array('is_delete' => '0', 'status' => '1', 'message_from !=' => $userid);
        $search_condition = "((message_to = '$userid') && (message_from != '$id')) AND ((message_from_profile = $message_from_profile AND message_to_profile = $message_to_profile) OR (message_from_profile = $message_to_profile AND message_to_profile = $message_from_profile)) AND (message_from_profile_id = $message_from_profile_id OR message_to_profile_id = $message_from_profile_id) AND is_message_from_delete != $userid AND is_message_to_delete != $userid";

        //20-7-2017@nkit
        if ($message_from_profile == 2) {
            $join_str4[0]['table'] = 'messages';
            $join_str4[0]['join_table_id'] = 'messages.message_from';
            $join_str4[0]['from_table_id'] = 'job_reg.user_id';
            $join_str4[0]['join_type'] = '';

            $fromlist = $this->common->select_data_by_search('job_reg', $search_condition, $contition_array, $data = 'messages.id,message_from,fname as first_name,lname as last_name,job_user_image as user_image ,message,user_id', $sortby = 'messages.id', $orderby = 'ASC', $limit = '', $offset = '', $join_str4, $groupby = '');
        }
        if ($message_from_profile == 1) {
            $join_str4[0]['table'] = 'messages';
            $join_str4[0]['join_table_id'] = 'messages.message_from';
            $join_str4[0]['from_table_id'] = 'recruiter.user_id';
            $join_str4[0]['join_type'] = '';
            $contition_array = array('is_delete' => '0', 're_status' => '1');
            $fromlist = $this->common->select_data_by_search('recruiter', $search_condition, $contition_array, $data = 'messages.id,message_from,rec_firstname as first_name,rec_lastname as last_name,recruiter_user_image as user_image ,message,user_id', $sortby = 'messages.id', $orderby = 'ASC', $limit = '', $offset = '', $join_str4, $groupby = '');
        }
        if ($message_from_profile == 4) {
            $join_str4[0]['table'] = 'messages';
            $join_str4[0]['join_table_id'] = 'messages.message_from';
            $join_str4[0]['from_table_id'] = 'freelancer_hire_reg.user_id';
            $join_str4[0]['join_type'] = '';

            $fromlist = $this->common->select_data_by_search('freelancer_hire_reg', $search_condition, $contition_array, $data = 'messages.id,message_from,username as last_name,fullname as first_name,freelancer_hire_user_image as user_image ,message,user_id', $sortby = 'messages.id', $orderby = 'ASC', $limit = '', $offset = '', $join_str4, $groupby = '');
        }
        if ($message_from_profile == 3) {
            $join_str4[0]['table'] = 'messages';
            $join_str4[0]['join_table_id'] = 'messages.message_from';
            $join_str4[0]['from_table_id'] = 'freelancer_post_reg.user_id';
            $join_str4[0]['join_type'] = '';

            $fromlist = $this->common->select_data_by_search('freelancer_post_reg', $search_condition, $contition_array, $data = 'messages.id,message_from,freelancer_post_fullname as first_name,freelancer_post_username as last_name,freelancer_post_user_image as user_image ,message,user_id', $sortby = 'messages.id', $orderby = 'ASC', $limit = '', $offset = '', $join_str4, $groupby = '');
        }
        if ($message_from_profile == 5) {
            $join_str4[0]['table'] = 'messages';
            $join_str4[0]['join_table_id'] = 'messages.message_from';
            $join_str4[0]['from_table_id'] = 'business_profile.user_id';
            $join_str4[0]['join_type'] = '';
            $contition_array = array('business_profile.is_deleted' => '0', 'status' => '1');
            $fromlist = $this->common->select_data_by_search('business_profile', $search_condition, $contition_array, $data = 'messages.id,message_from,company_name as first_name,business_user_image as user_image ,message,user_id', $sortby = 'messages.id', $orderby = 'ASC', $limit = '', $offset = '', $join_str4, $groupby = '');
        }
        if ($message_from_profile == 6) {
            $join_str4[0]['table'] = 'messages';
            $join_str4[0]['join_table_id'] = 'messages.message_from';
            $join_str4[0]['from_table_id'] = 'art_reg.user_id';
            $join_str4[0]['join_type'] = '';

            $fromlist = $this->common->select_data_by_search('art_reg', $search_condition, $contition_array, $data = 'messages.id,message_from,art_name as first_name,art_lastname as last_name,art_user_image as user_image ,message,user_id', $sortby = 'messages.id', $orderby = 'ASC', $limit = '', $offset = '', $join_str4, $groupby = '');
        }

        // uniq array of fromlist  
        foreach ($fromlist as $k => $v) {
            foreach ($fromlist as $key => $value) {
                if ($k != $key && $v['message_from'] == $value['message_from']) {
                    unset($fromlist[$k]);
                }
            }
        }

// replace name of message_to in user_id
// echo '<pre>'; print_r($fromlist); die();
        $return_arrayfrom = array();

        foreach ($fromlist as $from_list) {
            if ($from_list['message_from'] != $id) {
                $return = array();
                $return = $from_list;

                $return['user_id'] = $from_list['message_from'];
                $return['first_name'] = $from_list['first_name'];
                $return['last_name'] = $from_list['last_name'];
                $return['user_image'] = $from_list['user_image'];
                $return['message'] = $from_list['message'];

                unset($return['message_from']);
                array_push($return_arrayfrom, $return);
            }
        }

        $userlist = array_merge($return_arrayto, $return_arrayfrom);

        // uniq array of fromlist  
        foreach ($userlist as $k => $v) {
            foreach ($userlist as $key => $value) {
                if ($k != $key && $v['user_id'] == $value['user_id']) {
                    if ($v['id'] < $value['id']) {
                        unset($userlist[$k]);
                    }
                }
            }
        }
        $userlist = $this->aasort($userlist, "id");

        if ($return_arraysel[0] == '') {
            $return_arraysel = array();
        }


        $user_message = array_merge($return_arraysel, $userlist);
        // $user_message = array_merge($return_arraysel, $userlist);

        foreach ($user_message as $msg) {

            if ($message_from_profile == 2) {
                $image_path = FCPATH . 'uploads/job_profile/thumbs/' . $msg['user_image'];
                $user_image = base_url() . 'uploads/job_profile/thumbs/' . $msg['user_image'];
                $profile_url = base_url() . 'job/job_printpreview/' . $id . '?page=recruiter';
            }

            if ($message_from_profile == 1) {
                $image_path = FCPATH . 'uploads/recruiter_profile/thumbs/' . $msg['user_image'];
                $user_image = base_url() . 'uploads/recruiter_profile/thumbs/' . $msg['user_image'];
                $profile_url = base_url() . 'recruiter/rec_profile/' . $id . '?page=job';
            }
            if ($message_from_profile == 4) {
                $image_path = FCPATH . 'uploads/freelancer_hire_profile/thumbs/' . $msg['user_image'];
                $user_image = base_url() . 'uploads/freelancer_hire_profile/thumbs/' . $msg['user_image'];
                $profile_url = base_url() . 'freelancer/freelancer_post_profile/' . $id . '?page=freelancer_hire';
            }
            if ($message_from_profile == 3) {
                $image_path = FCPATH . 'uploads/freelancer_post_profile/thumbs/' . $msg['user_image'];
                $user_image = base_url() . 'uploads/freelancer_post_profile/thumbs/' . $msg['user_image'];
                $profile_url = base_url() . 'freelancer/freelancer_hire_profile/' . $id . '?page=freelancer_post';
            }
            if ($message_from_profile == 5) {
                $image_path = FCPATH . 'uploads/business_profile/thumbs/' . $msg['user_image'];
                $user_image = base_url() . 'uploads/business_profile/thumbs/' . $msg['user_image'];
                $busdata = $this->common->select_data_by_id('business_profile', 'user_id', $id, $data = 'business_slug');
                $profile_url = base_url() . 'business_profile/business_profile_manage_post/' . $busdata[0]['business_slug'];
            }
            if ($message_from_profile == 6) {
                $image_path = FCPATH . 'uploads/artistic_profile/thumbs/' . $msg['user_image'];
                $user_image = base_url() . 'uploads/artistic_profile/thumbs/' . $msg['user_image'];
                $profile_url = base_url() . 'artistic/art_manage_post/' . $id;
            }


            $contition_array = array('not_product_id' => $msg['id'], 'not_type' => "2");
            $data = array(' notification.*');
            $not = $this->common->select_data_by_condition('notification', $contition_array, $data, $sortby = 'not_id', $orderby = 'desc', $limit = '', $offset = '', $join_str = "", $groupby = '');
            $notmsg .= '<li class="';
            if ($not[0]['not_active'] == 1 && ($this->uri->segment(3) != $msg['user_id'])) {
                $notmsg .= 'active2';
            }
            $notmsg .= '">';
            $notmsg .= '<a href="' . base_url() . 'chat/abc/' . $msg['user_id'] . '/' . $message_from_profile . '/' . $message_to_profile . '/' . $not[0]['not_id'] . '" class="clearfix msg_dot" style="padding:0px!important;">';
            $notmsg .= '<div class="notification-database"><div class="notification-pic">';


            if ($msg['user_image'] && (file_exists($image_path)) == 1) {
                $notmsg .= '<img src="' . $user_image . '" >';
            } else {
                $a = $msg['first_name'];
                $b = $msg['last_name'];
                $acr = substr($a, 0, 1);
                $bcr = substr($b, 0, 1);

                $notmsg .= '<div class="post-img-div">';
                $notmsg .= '' . ucwords($acr) . ucwords($bcr) . '';
                $notmsg .= '</div>';
            }

            $notmsg .= '</div><div class="notification-data-inside">';
//            $notmsg .= '<h6>' . ucwords($msg['first_name']) . ' ' . ucwords($msg['last_name']) . '</h6>';
            $notmsg .= '<h6>' . ucwords($msg['first_name']) . '</h6>';
            $notmsg .= '<div class="msg_desc_a">';

            $message = str_replace('\\r', '', $msg['message']);
            $message = str_replace('\\t', '', $message);
            $message = str_replace('\\', '', $message);
            $message = str_replace('%26amp;', '&', $message);


            $notmsg .= '' . $message . '';
            $notmsg .= '</div><div class="data_noti_msg"><span class="day-text2">' . $this->common->time_elapsed_string(date('Y-m-d H:i:s', strtotime($not[0]['not_created_date']))) . '</span></div>';
//            $notmsg .= '</div><div class="data_noti_msg"><span class="day-text2">'. $not[0]['not_created_date'] . '</span></div>';
            $notmsg .= '</div></div></a></li>';
        }
        $notmsg .= '</div>';
        // if ($user_message) {
        //     $notmsg .= '<div id="InboxFooter"><a href="' . base_url('chat') . '/abc/' . $user_message[0]['user_id'] . '/' . $message_from_profile . '/' . $message_to_profile . '">See All</a></div>';
        // } else {
        //     $notmsg .= '<div class=""><div id="InboxFooter"><a class="no_msg_h">No Messages</a></div></div>';
        // }
        echo $notmsg;
    }

    public function aasort(&$array, $key) {
        $sorter = array();
        $ret = array();
        reset($array);

        foreach ($array as $ii => $va) {

            $sorter[$ii] = $va[$key];
        }

        arsort($sorter);

        foreach ($sorter as $ii => $va) {

            $ret[$ii] = $array[$ii];
        }

        return $array = $ret;
    }

    public function khhhhyy() {
        $userid = $this->session->userdata('aileenuser');
// 1-5 notification start
// recruiter notfication start 

        $contition_array = array('notification.not_type' => 3, 'notification.not_to_id' => $userid, 'notification.not_from' => 2, 'created_date BETWEEN DATE_SUB(NOW(), INTERVAL 2 MONTH) AND NOW()');
        $join_str = array(array(
                'join_type' => '',
                'table' => 'job_apply',
                'join_table_id' => 'notification.not_product_id',
                'from_table_id' => 'job_apply.app_id'),
            array(
                'join_type' => '',
                'table' => 'user',
                'join_table_id' => 'notification.not_from_id',
                'from_table_id' => 'user.user_id')
        );
        $data = array('notification.*', 'job_apply.*', 'user.user_id', 'user.first_name', 'user.user_image', 'user.last_name');
        $rec_not = $this->data['rec_not'] = $this->common->select_data_by_condition('notification', $contition_array, $data, $sortby = 'app_id', $orderby = 'desc', $limit = '', $offset = '', $join_str, $groupby = '');
// recruiter notification end
// job notfication start 

        $contition_array = array('notification.not_type' => 4, 'notification.not_to_id' => $userid, 'created_date BETWEEN DATE_SUB(NOW(), INTERVAL 2 MONTH) AND NOW()');
        $join_str = array(array(
                'join_type' => '',
                'table' => 'job_apply',
                'join_table_id' => 'notification.not_product_id',
                'from_table_id' => 'job_apply.app_id'),
            array(
                'join_type' => '',
                'table' => 'user',
                'join_table_id' => 'notification.not_from_id',
                'from_table_id' => 'user.user_id')
        );
        $data = array('notification.*', ' job_apply.*', ' user.user_id', 'user.first_name', 'user.user_image', 'user.last_name');

        $job_not = $this->data['job_not'] = $this->common->select_data_by_condition('notification', $contition_array, $data, $sortby = 'app_id', $orderby = 'desc', $limit = '', $offset = '', $join_str, $groupby = '');

// job notification end
// freelancer hire  notification start
        $contition_array = array('notification.not_type' => 3, 'notification.not_from' => 5, 'notification.not_to_id' => $userid, 'created_date BETWEEN DATE_SUB(NOW(), INTERVAL 2 MONTH) AND NOW()');

        $join_str = array(
            array(
                'join_type' => '',
                'table' => 'freelancer_apply',
                'join_table_id' => 'notification.not_product_id',
                'from_table_id' => 'freelancer_apply.app_id'),
            array(
                'join_type' => '',
                'table' => 'user',
                'join_table_id' => 'notification.not_from_id',
                'from_table_id' => 'user.user_id')
        );
        $data = array('notification.*', 'freelancer_apply.*', 'user.user_id', 'user.first_name', 'user.user_image', 'user.last_name');

        $hire_not = $this->data['hire_not'] = $this->common->select_data_by_condition('notification', $contition_array, $data, $sortby = 'app_id', $orderby = 'desc', $limit = '', $offset = '', $join_str, $groupby = '');
        // freelancer hire notification end
// freelancer post notification start
        // $this->data['work_post'] = $this->common->select_data_by_condition('notification', $contition_array, $data, $sortby = 'app_id', $orderby = 'desc', $limit = '', $offset = '', $join_str, $groupby = '');


        $contition_array = array('notification.not_type' => 4, 'notification.not_from' => 4, 'notification.not_to_id' => $userid, 'created_date BETWEEN DATE_SUB(NOW(), INTERVAL 2 MONTH) AND NOW()');
        $join_str = array(array(
                'join_type' => '',
                'table' => 'user_invite',
                'join_table_id' => 'notification.not_product_id',
                'from_table_id' => 'user_invite.invite_id'),
            array(
                'join_type' => '',
                'table' => 'user',
                'join_table_id' => 'notification.not_from_id',
                'from_table_id' => 'user.user_id')
        );
        $data = array('notification.*', ' user_invite.*', ' user.user_id', 'user.first_name', 'user.user_image', 'user.last_name');

        $work_post = $this->data['work_post'] = $work_post = $this->common->select_data_by_condition('notification', $contition_array, $data, $sortby = 'invite_id', $orderby = 'desc', $limit = '', $offset = '', $join_str, $groupby = '');


//         echo '<pre>'; print_r($this->data['work_post']); die();
// freelancer post notification end
//artistic notification start
// follow notification start

        $contition_array = array('notification.not_type' => 8, 'notification.not_from' => 3, 'notification.not_to_id' => $userid, 'created_date BETWEEN DATE_SUB(NOW(), INTERVAL 2 MONTH) AND NOW()');
        $join_str = array(array(
                'join_type' => '',
                'table' => 'follow',
                'join_table_id' => 'notification.not_product_id',
                'from_table_id' => 'follow.follow_id'),
            array(
                'join_type' => '',
                'table' => 'user',
                'join_table_id' => 'notification.not_from_id',
                'from_table_id' => 'user.user_id')
        );
        $data = array('notification.*', ' follow.*', ' user.user_id', 'user.first_name', 'user.user_image', 'user.last_name');

        $artfollow = $this->data['artfollow'] = $this->common->select_data_by_condition('notification', $contition_array, $data, $sortby = 'follow_id', $orderby = 'desc', $limit = '', $offset = '', $join_str, $groupby = '');
//echo '<pre>'; print_r($this->data['artfollow']); die();
// follow notification end
//post comment notification start

        $contition_array = array('notification.not_type' => 6, 'not_img' => 1, 'notification.not_from' => 3, 'notification.not_to_id' => $userid, 'created_date BETWEEN DATE_SUB(NOW(), INTERVAL 2 MONTH) AND NOW()');
        $join_str = array(array(
                'join_type' => '',
                'table' => 'artistic_post_comment',
                'join_table_id' => 'notification.not_product_id',
                'from_table_id' => 'artistic_post_comment.artistic_post_comment_id'),
            array(
                'join_type' => '',
                'table' => 'user',
                'join_table_id' => 'notification.not_from_id',
                'from_table_id' => 'user.user_id')
        );
        $data = array('notification.*', ' artistic_post_comment.*', ' user.user_id', 'user.first_name', 'user.user_image', 'user.last_name');
        $artcommnet = $this->data['artcommnet'] = $this->common->select_data_by_condition('notification', $contition_array, $data, $sortby = 'artistic_post_comment_id', $orderby = 'desc', $limit = '', $offset = '', $join_str, $groupby = '');
// comment notification end
//post like notification start
        $contition_array = array('notification.not_type' => 5, 'notification.not_from' => 3, 'not_img' => 2, 'notification.not_to_id' => $userid, 'created_date BETWEEN DATE_SUB(NOW(), INTERVAL 2 MONTH) AND NOW()');
        $join_str = array(array(
                'join_type' => '',
                'table' => 'art_post',
                'join_table_id' => 'notification.not_product_id',
                'from_table_id' => 'art_post.art_post_id'),
            array(
                'join_type' => '',
                'table' => 'user',
                'join_table_id' => 'notification.not_from_id',
                'from_table_id' => 'user.user_id')
        );
        $data = array('notification.*', 'art_post.*', ' user.user_id', 'user.first_name', 'user.user_image', 'user.last_name');
        $artlike = $this->data['artlike'] = $this->common->select_data_by_condition('notification', $contition_array, $data, $sortby = 'art_post_id', $orderby = 'desc', $limit = '', $offset = '', $join_str, $groupby = '');

        $contition_array = array('notification.not_type' => 5, 'not_img' => 5, 'notification.not_from' => 3, 'notification.not_to_id' => $userid, 'created_date BETWEEN DATE_SUB(NOW(), INTERVAL 2 MONTH) AND NOW()');
        $join_str = array(array(
                'join_type' => '',
                'table' => 'post_image',
                'join_table_id' => 'notification.not_product_id',
                'from_table_id' => 'post_image.image_id'),
            array(
                'join_type' => '',
                'table' => 'user',
                'join_table_id' => 'notification.not_from_id',
                'from_table_id' => 'user.user_id')
        );
        $data = array('notification.*', 'post_image.*', ' user.user_id', 'user.first_name', 'user.user_image', 'user.last_name');
        $artimglike = $this->data['artimglike'] = $this->common->select_data_by_condition('notification', $contition_array, $data, $sortby = 'image_id', $orderby = 'desc', $limit = '', $offset = '', $join_str, $groupby = '');


        $contition_array = array('notification.not_type' => 5, 'not_img' => 3, 'notification.not_from' => 3, 'notification.not_to_id' => $userid, 'created_date BETWEEN DATE_SUB(NOW(), INTERVAL 2 MONTH) AND NOW()');
        $join_str = array(array(
                'join_type' => '',
                'table' => 'artistic_post_comment',
                'join_table_id' => 'notification.not_product_id',
                'from_table_id' => 'artistic_post_comment.artistic_post_comment_id'),
            array(
                'join_type' => '',
                'table' => 'user',
                'join_table_id' => 'notification.not_from_id',
                'from_table_id' => 'user.user_id')
        );
        $data = array('notification.*', 'artistic_post_comment.*', ' user.user_id', 'user.first_name', 'user.user_image', 'user.last_name');
        $artcmtlike = $this->data['artcmtlike'] = $this->common->select_data_by_condition('notification', $contition_array, $data, $sortby = 'artistic_post_comment_id', $orderby = 'desc', $limit = '', $offset = '', $join_str, $groupby = '');

        $contition_array = array('notification.not_type' => 6, 'not_img' => 4, 'notification.not_from' => 3, 'notification.not_to_id' => $userid, 'created_date BETWEEN DATE_SUB(NOW(), INTERVAL 2 MONTH) AND NOW()');
        $join_str = array(array(
                'join_type' => '',
                'table' => 'art_post_image_comment',
                'join_table_id' => 'notification.not_product_id',
                'from_table_id' => 'art_post_image_comment.post_image_comment_id'),
            array(
                'join_type' => '',
                'table' => 'user',
                'join_table_id' => 'notification.not_from_id',
                'from_table_id' => 'user.user_id')
        );
        $data = array('notification.*', ' art_post_image_comment.*', ' user.user_id', 'user.first_name', 'user.user_image', 'user.last_name');
        $artimgcommnet = $this->data['artimgcommnet'] = $this->common->select_data_by_condition('notification', $contition_array, $data, $sortby = 'post_image_comment_id', $orderby = 'desc', $limit = '', $offset = '', $join_str, $groupby = '');

        $contition_array = array('notification.not_type' => 5, 'not_img' => 6, 'notification.not_from' => 3, 'notification.not_to_id' => $userid, 'created_date BETWEEN DATE_SUB(NOW(), INTERVAL 2 MONTH) AND NOW()');
        $join_str = array(array(
                'join_type' => '',
                'table' => 'art_post_image_comment',
                'join_table_id' => 'notification.not_product_id',
                'from_table_id' => 'art_post_image_comment.post_image_comment_id'),
            array(
                'join_type' => '',
                'table' => 'user',
                'join_table_id' => 'notification.not_from_id',
                'from_table_id' => 'user.user_id')
        );
        $data = array('notification.*', ' art_post_image_comment.*', ' user.user_id', 'user.first_name', 'user.user_image', 'user.last_name');
        $this->data['artimgcmtlike'] = $artimgcmtlike = $this->common->select_data_by_condition('notification', $contition_array, $data, $sortby = 'post_image_comment_id', $orderby = 'desc', $limit = '', $offset = '', $join_str, $groupby = '');

// like notification end
// artistic notification end
// business profile notification start
// follow notification start

        $contition_array = array('notification.not_type' => 8, 'notification.not_from' => 6, 'notification.not_to_id' => $userid, 'created_date BETWEEN DATE_SUB(NOW(), INTERVAL 2 MONTH) AND NOW()');
        $join_str = array(array(
                'join_type' => '',
                'table' => 'follow',
                'join_table_id' => 'notification.not_product_id',
                'from_table_id' => 'follow.follow_id'),
            array(
                'join_type' => '',
                'table' => 'user',
                'join_table_id' => 'notification.not_from_id',
                'from_table_id' => 'user.user_id')
        );
        $data = array('notification.*', 'follow.*', 'user.user_id', 'user.first_name', 'user.user_image', 'user.last_name');

        $busifollow = $this->data['busifollow'] = $this->common->select_data_by_condition('notification', $contition_array, $data, $sortby = 'follow_id', $orderby = 'desc', $limit = '', $offset = '', $join_str, $groupby = '');

// follow notification end
// comment notification start

        $contition_array = array('notification.not_type' => 6, 'not_img' => 1, 'notification.not_from' => 6, 'notification.not_to_id' => $userid, 'created_date BETWEEN DATE_SUB(NOW(), INTERVAL 2 MONTH) AND NOW()');
        $join_str = array(array(
                'join_type' => '',
                'table' => 'business_profile_post_comment',
                'join_table_id' => 'notification.not_product_id',
                'from_table_id' => 'business_profile_post_comment.business_profile_post_comment_id'),
            array(
                'join_type' => '',
                'table' => 'user',
                'join_table_id' => 'notification.not_from_id',
                'from_table_id' => 'user.user_id')
        );
        $data = array('notification.*', 'business_profile_post_comment.*', 'user.user_id', 'user.first_name', 'user.user_image', 'user.last_name');

        $buscommnet = $this->data['buscommnet'] = $this->common->select_data_by_condition('notification', $contition_array, $data, $sortby = 'business_profile_post_comment_id', $orderby = 'desc', $limit = '', $offset = '', $join_str, $groupby = '');
//echo '<pre>'; print_r($this->data['buscommnet']);
        $contition_array = array('notification.not_type' => 6, 'not_img' => 4, 'notification.not_from' => 6, 'notification.not_to_id' => $userid, 'created_date BETWEEN DATE_SUB(NOW(), INTERVAL 2 MONTH) AND NOW()');
        $join_str = array(array(
                'join_type' => '',
                'table' => 'bus_post_image_comment',
                'join_table_id' => 'notification.not_product_id',
                'from_table_id' => 'bus_post_image_comment.post_image_comment_id'),
            array(
                'join_type' => '',
                'table' => 'user',
                'join_table_id' => 'notification.not_from_id',
                'from_table_id' => 'user.user_id')
        );
        $data = array('notification.*', 'bus_post_image_comment.*', 'user.user_id', 'user.first_name', 'user.user_image', 'user.last_name');

        $this->data['busimgcommnet'] = $busimgcommnet = $this->common->select_data_by_condition('notification', $contition_array, $data, $sortby = 'post_image_comment_id', $orderby = 'desc', $limit = '', $offset = '', $join_str, $groupby = '');

//echo '<pre>'; print_r($this->data['busimgcommnet']); die(); 
// comment notification end
// like notification start
        $contition_array = array('notification.not_type' => 5, 'not_img' => 2, 'notification.not_from' => 6, 'notification.not_to_id' => $userid, 'created_date BETWEEN DATE_SUB(NOW(), INTERVAL 2 MONTH) AND NOW()');
        $join_str = array(array(
                'join_type' => '',
                'table' => 'business_profile_post',
                'join_table_id' => 'notification.not_product_id',
                'from_table_id' => 'business_profile_post.business_profile_post_id'),
            array(
                'join_type' => '',
                'table' => 'user',
                'join_table_id' => 'notification.not_from_id',
                'from_table_id' => 'user.user_id')
        );
        $data = array('notification.*', ' business_profile_post.*', ' user.user_id', 'user.first_name', 'user.user_image', 'user.last_name');

        $buslike = $this->data['buslike'] = $this->common->select_data_by_condition('notification', $contition_array, $data, $sortby = 'business_profile_post_id', $orderby = 'desc', $limit = '', $offset = '', $join_str, $groupby = '');

        $contition_array = array('notification.not_type' => 5, 'not_img' => 3, 'notification.not_from' => 6, 'notification.not_to_id' => $userid, 'created_date BETWEEN DATE_SUB(NOW(), INTERVAL 2 MONTH) AND NOW()');
        $join_str = array(array(
                'join_type' => '',
                'table' => 'business_profile_post_comment',
                'join_table_id' => 'notification.not_product_id',
                'from_table_id' => 'business_profile_post_comment.business_profile_post_comment_id'),
            array(
                'join_type' => '',
                'table' => 'user',
                'join_table_id' => 'notification.not_from_id',
                'from_table_id' => 'user.user_id')
        );
        $data = array('notification.*', 'business_profile_post_comment.*', 'user.user_id', 'user.first_name', 'user.user_image', 'user.last_name');

        $buscmtlike = $this->data['buscmtlike'] = $this->common->select_data_by_condition('notification', $contition_array, $data, $sortby = 'business_profile_post_comment_id', $orderby = 'desc', $limit = '', $offset = '', $join_str, $groupby = '');

        $contition_array = array('notification.not_type' => 5, 'not_img' => 5, 'notification.not_from' => 6, 'notification.not_to_id' => $userid, 'created_date BETWEEN DATE_SUB(NOW(), INTERVAL 2 MONTH) AND NOW()');
        $join_str = array(array(
                'join_type' => '',
                'table' => 'post_image',
                'join_table_id' => 'notification.not_product_id',
                'from_table_id' => 'post_image.image_id'),
            array(
                'join_type' => '',
                'table' => 'user',
                'join_table_id' => 'notification.not_from_id',
                'from_table_id' => 'user.user_id')
        );
        $data = array('notification.*', 'post_image.*', 'user.user_id', 'user.first_name', 'user.user_image', 'user.last_name');

        $busimglike = $this->data['busimglike'] = $this->common->select_data_by_condition('notification', $contition_array, $data, $sortby = 'image_id', $orderby = 'desc', $limit = '', $offset = '', $join_str, $groupby = '');

        $contition_array = array('notification.not_type' => 5, 'not_img' => 6, 'notification.not_from' => 6, 'notification.not_to_id' => $userid, 'created_date BETWEEN DATE_SUB(NOW(), INTERVAL 2 MONTH) AND NOW()');
        $join_str = array(array(
                'join_type' => '',
                'table' => 'bus_post_image_comment',
                'join_table_id' => 'notification.not_product_id',
                'from_table_id' => 'bus_post_image_comment.post_image_comment_id'),
            array(
                'join_type' => '',
                'table' => 'user',
                'join_table_id' => 'notification.not_from_id',
                'from_table_id' => 'user.user_id')
        );
        $data = array('notification.*', 'bus_post_image_comment.*', 'user.user_id', 'user.first_name', 'user.user_image', 'user.last_name');

        $busimgcmtlike = $this->data['busimgcmtlike'] = $this->common->select_data_by_condition('notification', $contition_array, $data, $sortby = 'post_image_comment_id', $orderby = 'desc', $limit = '', $offset = '', $join_str, $groupby = '');

        $this->data['totalnotifi'] = $totalnotifi = array_merge($rec_not, $job_not, $hire_not, $work_post, $artcommnet, $artlike, $artcmtlike, $artimglike, $artimgcommnet, $artfollow, $artimgcmtlike, $busimgcommnet, $busifollow, $buscommnet, $buslike, $buscmtlike, $busimgcmtlike, $busimglike);
        $this->data['totalnotification'] = $totalnotification = $this->aasort($totalnotifi, "not_id");
    }

    public function not_active() {

        $not_id = $this->input->post('not_id');
        $data = array(
            'not_active' => 2
        );
        $updatedata = $this->common->update_data($data, 'notification', 'not_id', $not_id);
    }

    public function not_view() {
        $data = '<ul class="">
        <li class=""><a href="http://localhost/aileensoul/chat/abc/93/6/6/184" class="clearfix msg_dot" style="padding:0px!important;"><div class="notification-database"><div class="notification-pic"><div class="post-img-div">ZP</div></div><div class="notification-data-inside"><h6>Zalak</h6><div class="msg_desc_a">z4</div><div class="data_noti_msg"><span class="day-text2">1 hour ago</span></div></div></div></a></li>
    <li class="active2">
        <a href="http://localhost/aileensoul/business_profile/business_resume/zalak-infotech-pvt-ltd" onclick="not_active(1422)">
            <div class="notification-database">
                <div class="notification-pic">
                    <div class="post-img-div">Z</div>
                </div>
                <div class="notification-data-inside">
                    <h6><b>  Zalak Infotech Pvt Ltd</b> <span class="noti-msg-y">Started following you in business profile.</span></h6>
                    <div><i class="clockimg"></i><span class="day-text">3 days ago</span>
                    </div>
                </div>
            </div>
        </a>
    </li>
    <li class="active2">
        <a href="http://localhost/aileensoul/business_profile/business_resume/zalak-infotech-pvt-ltd" onclick="not_active(1387)">
            <div class="notification-database">
                <div class="notification-pic">
                    <div class="post-img-div">Z</div>
                </div>
                <div class="notification-data-inside">
                    <h6><b>  Zalak Infotech Pvt Ltd</b> <span class="noti-msg-y">Started following you in business profile.</span></h6>
                    <div><i class="clockimg"></i><span class="day-text">1 week ago</span>
                    </div>
                </div>
            </div>
        </a>
    </li>
    <li class="active2">
        <a href="http://localhost/aileensoul/notification/business_post/60" onclick="not_active(1366)">
            <div class="notification-database">
                <div class="notification-pic"><img src="http://localhost/aileensoul/uploads/business_profile/thumbs/images.png">
                </div>
                <div class="notification-data-inside">
                    <h6><b>  Abhinandan Hosiery</b> <span class="noti-msg-y"> Likes your post in business profile. </span> </h6>
                    <div><i class="clockimg"></i><span class="day-text">2 weeks ago</span>
                    </div>
                </div>
            </div>
        </a>
    </li>
    <li class="active2">
        <a href="http://localhost/aileensoul/business_profile/business_resume/hemstechnosys-pvt-ltd" onclick="not_active(1270)">
            <div class="notification-database">
                <div class="notification-pic">
                    <div class="post-img-div">H</div>
                </div>
                <div class="notification-data-inside">
                    <h6><b>  HEMSTECHNOSYS PVT. LTD.</b> <span class="noti-msg-y">Started following you in business profile.</span></h6>
                    <div><i class="clockimg"></i><span class="day-text">3 weeks ago</span>
                    </div>
                </div>
            </div>
        </a>
    </li>
    <li class="active2">
        <a href="http://localhost/aileensoul/business_profile/business_resume/rout-digital-duniya" onclick="not_active(1195)">
            <div class="notification-database">
                <div class="notification-pic"><img src="http://localhost/aileensoul/uploads/business_profile/thumbs/index3.jpg">
                </div>
                <div class="notification-data-inside">
                    <h6><b>  ROUT DIGITAL DUNIYA</b> <span class="noti-msg-y">Started following you in business profile.</span></h6>
                    <div><i class="clockimg"></i><span class="day-text">3 weeks ago</span>
                    </div>
                </div>
            </div>
        </a>
    </li>
    <li class="active2">
        <a href="http://localhost/aileensoul/business_profile/business_resume/abhinandan-hosiery" onclick="not_active(1154)">
            <div class="notification-database">
                <div class="notification-pic"><img src="http://localhost/aileensoul/uploads/business_profile/thumbs/images.png">
                </div>
                <div class="notification-data-inside">
                    <h6><b>  Abhinandan Hosiery</b> <span class="noti-msg-y">Started following you in business profile.</span></h6>
                    <div><i class="clockimg"></i><span class="day-text">3 weeks ago</span>
                    </div>
                </div>
            </div>
        </a>
    </li>
    <li class="active2">
        <a href="http://localhost/aileensoul/notification/business_post/65" onclick="not_active(1151)">
            <div class="notification-database">
                <div class="notification-pic"><img src="http://localhost/aileensoul/uploads/business_profile/thumbs/images.png">
                </div>
                <div class="notification-data-inside">
                    <h6><b>  Abhinandan Hosiery</b> <span class="noti-msg-y"> Likes your post in business profile. </span> </h6>
                    <div><i class="clockimg"></i><span class="day-text">3 weeks ago</span>
                    </div>
                </div>
            </div>
        </a>
    </li>
    <li class="active2">
        <a href="http://localhost/aileensoul/notification/business_post/66" onclick="not_active(1150)">
            <div class="notification-database">
                <div class="notification-pic"><img src="http://localhost/aileensoul/uploads/business_profile/thumbs/images.png">
                </div>
                <div class="notification-data-inside">
                    <h6><b>  Abhinandan Hosiery</b> <span class="noti-msg-y"> Likes your post in business profile. </span> </h6>
                    <div><i class="clockimg"></i><span class="day-text">3 weeks ago</span>
                    </div>
                </div>
            </div>
        </a>
    </li>
    <li class="active2">
        <a href="http://localhost/aileensoul/notification/business_post/67" onclick="not_active(1149)">
            <div class="notification-database">
                <div class="notification-pic"><img src="http://localhost/aileensoul/uploads/business_profile/thumbs/images.png">
                </div>
                <div class="notification-data-inside">
                    <h6><b>  Abhinandan Hosiery</b> <span class="noti-msg-y"> Likes your post in business profile. </span> </h6>
                    <div><i class="clockimg"></i><span class="day-text">3 weeks ago</span>
                    </div>
                </div>
            </div>
        </a>
    </li>
    <li class="">
        <a href="http://localhost/aileensoul/artistic/artistic_profile/318" onclick="not_active(1126)">
            <div class="notification-database">
                <div class="notification-pic">
                    <div class="post-img-div">DP</div>
                </div>
                <div class="notification-data-inside">
                    <h6><b>  Dhruti Panchal</b> <span class="noti-msg-y"> Started following you in artistic profile.</span></h6>
                    <div><i class="clockimg"></i><span class="day-text">1 month ago</span>
                    </div>
                </div>
            </div>
        </a>
    </li>
</ul>';
        echo $data;
    }
    
    public function ajax_notification_data(){
        //NOTIFICATION CODE START
                
            $userid = $this->session->userdata('aileenuser');
// 1-5 notification start
// recruiter notfication start 

        $contition_array = array('notification.not_type' => 3, 'notification.not_to_id' => $userid, 'notification.not_from' => 2, 'created_date BETWEEN DATE_SUB(NOW(), INTERVAL 2 MONTH) AND NOW()');
        $join_str = array(array(
                'join_type' => '',
                'table' => 'job_apply',
                'join_table_id' => 'notification.not_product_id',
                'from_table_id' => 'job_apply.app_id'),
            array(
                'join_type' => '',
                'table' => 'job_reg',
                'join_table_id' => 'notification.not_from_id',
                'from_table_id' => 'job_reg.user_id')
        );
        $data = array('notification.*', 'job_apply.*', 'job_reg.user_id as user_id', 'job_reg.fname as first_name', 'job_reg.job_user_image as user_image', 'job_reg.lname as last_name');
        $rec_not = $this->data['rec_not'] = $this->common->select_data_by_condition('notification', $contition_array, $data, $sortby = 'app_id', $orderby = 'desc', $limit = '', $offset = '', $join_str, $groupby = '');
// recruiter notification end
// job notfication start 

        $contition_array = array('notification.not_type' => 4, 'notification.not_to_id' => $userid, 'created_date BETWEEN DATE_SUB(NOW(), INTERVAL 2 MONTH) AND NOW()');
        $join_str = array(array(
                'join_type' => '',
                'table' => 'job_apply',
                'join_table_id' => 'notification.not_product_id',
                'from_table_id' => 'job_apply.app_id'),
            array(
                'join_type' => '',
                'table' => 'recruiter',
                'join_table_id' => 'notification.not_from_id',
                'from_table_id' => 'recruiter.user_id')
        );
        $data = array('notification.*', ' job_apply.*', ' recruiter.user_id as user_id', 'recruiter.rec_firstname as first_name', 'recruiter.recruiter_user_image as user_image', 'recruiter.rec_lastname as last_name');

        $job_not = $this->data['job_not'] = $this->common->select_data_by_condition('notification', $contition_array, $data, $sortby = 'app_id', $orderby = 'desc', $limit = '', $offset = '', $join_str, $groupby = '');

// job notification end
// freelancer hire  notification start
        $contition_array = array('notification.not_type' => 3, 'notification.not_from' => 4, 'notification.not_to_id' => $userid, 'created_date BETWEEN DATE_SUB(NOW(), INTERVAL 2 MONTH) AND NOW()');

        $join_str = array(
            array(
                'join_type' => '',
                'table' => 'freelancer_apply',
                'join_table_id' => 'notification.not_product_id',
                'from_table_id' => 'freelancer_apply.app_id'),
            array(
                'join_type' => '',
                'table' => 'freelancer_post_reg',
                'join_table_id' => 'notification.not_from_id',
                'from_table_id' => 'freelancer_post_reg.user_id')
        );
        $data = array('notification.*', 'freelancer_apply.*', ' freelancer_post_reg.user_id as user_id', 'freelancer_post_reg.freelancer_post_fullname as first_name', 'freelancer_post_reg.freelancer_post_user_image as user_image', 'freelancer_post_reg.freelancer_post_username as last_name');

        $hire_not = $this->data['hire_noth'] = $this->common->select_data_by_condition('notification', $contition_array, $data, $sortby = 'app_id', $orderby = 'desc', $limit = '', $offset = '', $join_str, $groupby = '');
        // freelancer hire notification end
// freelancer post notification start
        // $this->data['work_post'] = $this->common->select_data_by_condition('notification', $contition_array, $data, $sortby = 'app_id', $orderby = 'desc', $limit = '', $offset = '', $join_str, $groupby = '');
//echo '<pre>'; print_r($hire_not); die();
        $contition_array = array('notification.not_type' => 4, 'notification.not_from' => 5, 'notification.not_to_id' => $userid, 'created_date BETWEEN DATE_SUB(NOW(), INTERVAL 2 MONTH) AND NOW()');
        $join_str = array(array(
                'join_type' => '',
                'table' => 'user_invite',
                'join_table_id' => 'notification.not_product_id',
                'from_table_id' => 'user_invite.invite_id'),
            array(
                'join_type' => '',
                'table' => 'freelancer_hire_reg',
                'join_table_id' => 'notification.not_from_id',
                'from_table_id' => 'freelancer_hire_reg.user_id')
        );
        $data = array('notification.*', ' user_invite.*', 'freelancer_hire_reg.user_id as user_id', 'freelancer_hire_reg.fullname as first_name', 'freelancer_hire_reg.freelancer_hire_user_image as user_image', 'freelancer_hire_reg.username as last_name');

        $work_post = $this->data['work_post'] = $work_post = $this->common->select_data_by_condition('notification', $contition_array, $data, $sortby = 'invite_id', $orderby = 'desc', $limit = '', $offset = '', $join_str, $groupby = '');


// freelancer post notification end
//artistic notification start
// follow notification start

        $contition_array = array('notification.not_type' => 8, 'notification.not_from' => 3, 'notification.not_to_id' => $userid, 'created_date BETWEEN DATE_SUB(NOW(), INTERVAL 2 MONTH) AND NOW()');
        $join_str = array(array(
                'join_type' => '',
                'table' => 'follow',
                'join_table_id' => 'notification.not_product_id',
                'from_table_id' => 'follow.follow_id'),
            array(
                'join_type' => '',
                'table' => 'art_reg',
                'join_table_id' => 'notification.not_from_id',
                'from_table_id' => 'art_reg.user_id')
        );
        $data = array('notification.*', ' follow.*', ' art_reg.user_id as user_id', 'art_reg.art_name as first_name', 'art_reg.art_user_image as user_image', 'art_reg.art_lastname as last_name');

        $artfollow = $this->data['artfollow'] = $this->common->select_data_by_condition('notification', $contition_array, $data, $sortby = 'follow_id', $orderby = 'desc', $limit = '', $offset = '', $join_str, $groupby = '');
//echo '<pre>'; print_r($this->data['artfollow']); die();
// follow notification end
//post comment notification start

        $contition_array = array('notification.not_type' => 6, 'not_img' => 1, 'notification.not_from' => 3, 'notification.not_to_id' => $userid, 'created_date BETWEEN DATE_SUB(NOW(), INTERVAL 2 MONTH) AND NOW()');
        $join_str = array(array(
                'join_type' => '',
                'table' => 'artistic_post_comment',
                'join_table_id' => 'notification.not_product_id',
                'from_table_id' => 'artistic_post_comment.artistic_post_comment_id'),
            array(
                'join_type' => '',
                'table' => 'art_reg',
                'join_table_id' => 'notification.not_from_id',
                'from_table_id' => 'art_reg.user_id')
        );
        $data = array('notification.*', ' artistic_post_comment.*', 'art_reg.user_id as user_id', 'art_reg.art_name as first_name', 'art_reg.art_user_image as user_image', 'art_reg.art_lastname as last_name');
        $artcommnet = $this->data['artcommnet'] = $this->common->select_data_by_condition('notification', $contition_array, $data, $sortby = 'artistic_post_comment_id', $orderby = 'desc', $limit = '', $offset = '', $join_str, $groupby = '');
// comment notification end
//post like notification start
        $contition_array = array('notification.not_type' => 5, 'notification.not_from' => 3, 'not_img' => 2, 'notification.not_to_id' => $userid, 'created_date BETWEEN DATE_SUB(NOW(), INTERVAL 2 MONTH) AND NOW()');
        $join_str = array(array(
                'join_type' => '',
                'table' => 'art_post',
                'join_table_id' => 'notification.not_product_id',
                'from_table_id' => 'art_post.art_post_id'),
            array(
                'join_type' => '',
                'table' => 'art_reg',
                'join_table_id' => 'notification.not_from_id',
                'from_table_id' => 'art_reg.user_id')
        );
        $data = array('notification.*', 'art_post.*', 'art_reg.user_id as user_id', 'art_reg.art_name as first_name', 'art_reg.art_user_image as user_image', 'art_reg.art_lastname as last_name');
        $artlike = $this->data['artlike'] = $this->common->select_data_by_condition('notification', $contition_array, $data, $sortby = 'art_post_id', $orderby = 'desc', $limit = '', $offset = '', $join_str, $groupby = '');

        $contition_array = array('notification.not_type' => 5, 'not_img' => 5, 'notification.not_from' => 3, 'notification.not_to_id' => $userid, 'created_date BETWEEN DATE_SUB(NOW(), INTERVAL 2 MONTH) AND NOW()');
        $join_str = array(array(
                'join_type' => '',
                'table' => 'post_image',
                'join_table_id' => 'notification.not_product_id',
                'from_table_id' => 'post_image.image_id'),
            array(
                'join_type' => '',
                'table' => 'art_reg',
                'join_table_id' => 'notification.not_from_id',
                'from_table_id' => 'art_reg.user_id')
        );
        $data = array('notification.*', 'post_image.*', 'art_reg.user_id as user_id', 'art_reg.art_name as first_name', 'art_reg.art_user_image as user_image', 'art_reg.art_lastname as last_name');
        $artimglike = $this->data['artimglike'] = $this->common->select_data_by_condition('notification', $contition_array, $data, $sortby = 'image_id', $orderby = 'desc', $limit = '', $offset = '', $join_str, $groupby = '');


        $contition_array = array('notification.not_type' => 5, 'not_img' => 3, 'notification.not_from' => 3, 'notification.not_to_id' => $userid, 'created_date BETWEEN DATE_SUB(NOW(), INTERVAL 2 MONTH) AND NOW()');
        $join_str = array(array(
                'join_type' => '',
                'table' => 'artistic_post_comment',
                'join_table_id' => 'notification.not_product_id',
                'from_table_id' => 'artistic_post_comment.artistic_post_comment_id'),
            array(
                'join_type' => '',
                'table' => 'art_reg',
                'join_table_id' => 'notification.not_from_id',
                'from_table_id' => 'art_reg.user_id')
        );
        $data = array('notification.*', 'artistic_post_comment.*', 'art_reg.user_id as user_id', 'art_reg.art_name as first_name', 'art_reg.art_user_image as user_image', 'art_reg.art_lastname as last_name');
        $artcmtlike = $this->data['artcmtlike'] = $this->common->select_data_by_condition('notification', $contition_array, $data, $sortby = 'artistic_post_comment_id', $orderby = 'desc', $limit = '', $offset = '', $join_str, $groupby = '');

        $contition_array = array('notification.not_type' => 6, 'not_img' => 4, 'notification.not_from' => 3, 'notification.not_to_id' => $userid, 'created_date BETWEEN DATE_SUB(NOW(), INTERVAL 2 MONTH) AND NOW()');
        $join_str = array(array(
                'join_type' => '',
                'table' => 'art_post_image_comment',
                'join_table_id' => 'notification.not_product_id',
                'from_table_id' => 'art_post_image_comment.post_image_comment_id'),
            array(
                'join_type' => '',
                'table' => 'art_reg',
                'join_table_id' => 'notification.not_from_id',
                'from_table_id' => 'art_reg.user_id')
        );
        $data = array('notification.*', ' art_post_image_comment.*', 'art_reg.user_id as user_id', 'art_reg.art_name as first_name', 'art_reg.art_user_image as user_image', 'art_reg.art_lastname as last_name');
        $artimgcommnet = $this->data['artimgcommnet'] = $this->common->select_data_by_condition('notification', $contition_array, $data, $sortby = 'post_image_comment_id', $orderby = 'desc', $limit = '', $offset = '', $join_str, $groupby = '');

        $contition_array = array('notification.not_type' => 5, 'not_img' => 6, 'notification.not_from' => 3, 'notification.not_to_id' => $userid, 'created_date BETWEEN DATE_SUB(NOW(), INTERVAL 2 MONTH) AND NOW()');
        $join_str = array(array(
                'join_type' => '',
                'table' => 'art_post_image_comment',
                'join_table_id' => 'notification.not_product_id',
                'from_table_id' => 'art_post_image_comment.post_image_comment_id'),
            array(
                'join_type' => '',
                'table' => 'art_reg',
                'join_table_id' => 'notification.not_from_id',
                'from_table_id' => 'art_reg.user_id')
        );
        $data = array('notification.*', ' art_post_image_comment.*', 'art_reg.user_id as user_id', 'art_reg.art_name as first_name', 'art_reg.art_user_image as user_image', 'art_reg.art_lastname as last_name');
        $this->data['artimgcmtlike'] = $artimgcmtlike = $this->common->select_data_by_condition('notification', $contition_array, $data, $sortby = 'post_image_comment_id', $orderby = 'desc', $limit = '', $offset = '', $join_str, $groupby = '');

// like notification end
// artistic notification end
// business profile notification start
// follow notification start

        $contition_array = array('notification.not_type' => 8, 'notification.not_from' => 6, 'notification.not_to_id' => $userid, 'created_date BETWEEN DATE_SUB(NOW(), INTERVAL 2 MONTH) AND NOW()');
        $join_str = array(array(
                'join_type' => '',
                'table' => 'follow',
                'join_table_id' => 'notification.not_product_id',
                'from_table_id' => 'follow.follow_id'),
            array(
                'join_type' => '',
                'table' => 'business_profile',
                'join_table_id' => 'notification.not_from_id',
                'from_table_id' => 'business_profile.user_id')
        );
        $data = array('notification.*', 'follow.*', 'business_profile.user_id as user_id', 'business_profile.company_name as first_name', 'business_profile.business_user_image as user_image');
        $busifollow = $this->data['busifollow'] = $this->common->select_data_by_condition('notification', $contition_array, $data, $sortby = 'follow_id', $orderby = 'desc', $limit = '', $offset = '', $join_str, $groupby = '');

// follow notification end
// comment notification start

        $contition_array = array('notification.not_type' => 6, 'not_img' => 1, 'notification.not_from' => 6, 'notification.not_to_id' => $userid, 'created_date BETWEEN DATE_SUB(NOW(), INTERVAL 2 MONTH) AND NOW()');
        $join_str = array(array(
                'join_type' => '',
                'table' => 'business_profile_post_comment',
                'join_table_id' => 'notification.not_product_id',
                'from_table_id' => 'business_profile_post_comment.business_profile_post_comment_id'),
            array(
                'join_type' => '',
                'table' => 'business_profile',
                'join_table_id' => 'notification.not_from_id',
                'from_table_id' => 'business_profile.user_id')
        );
        $data = array('notification.*', 'business_profile_post_comment.*', 'business_profile.user_id as user_id', 'business_profile.company_name as first_name', 'business_profile.business_user_image as user_image');

        $buscommnet = $this->data['buscommnet'] = $this->common->select_data_by_condition('notification', $contition_array, $data, $sortby = 'business_profile_post_comment_id', $orderby = 'desc', $limit = '', $offset = '', $join_str, $groupby = '');
//echo '<pre>'; print_r($this->data['buscommnet']);
        $contition_array = array('notification.not_type' => 6, 'not_img' => 4, 'notification.not_from' => 6, 'notification.not_to_id' => $userid, 'created_date BETWEEN DATE_SUB(NOW(), INTERVAL 2 MONTH) AND NOW()');
        $join_str = array(array(
                'join_type' => '',
                'table' => 'bus_post_image_comment',
                'join_table_id' => 'notification.not_product_id',
                'from_table_id' => 'bus_post_image_comment.post_image_comment_id'),
            array(
                'join_type' => '',
                'table' => 'business_profile',
                'join_table_id' => 'notification.not_from_id',
                'from_table_id' => 'business_profile.user_id')
        );
        $data = array('notification.*', 'bus_post_image_comment.*', 'business_profile.user_id as user_id', 'business_profile.company_name as first_name', 'business_profile.business_user_image as user_image');

        $this->data['busimgcommnet'] = $busimgcommnet = $this->common->select_data_by_condition('notification', $contition_array, $data, $sortby = 'post_image_comment_id', $orderby = 'desc', $limit = '', $offset = '', $join_str, $groupby = '');

//echo '<pre>'; print_r($this->data['busimgcommnet']); die(); 
// comment notification end
// like notification start
        $contition_array = array('notification.not_type' => 5, 'not_img' => 2, 'notification.not_from' => 6, 'notification.not_to_id' => $userid, 'created_date BETWEEN DATE_SUB(NOW(), INTERVAL 2 MONTH) AND NOW()');
        $join_str = array(array(
                'join_type' => '',
                'table' => 'business_profile_post',
                'join_table_id' => 'notification.not_product_id',
                'from_table_id' => 'business_profile_post.business_profile_post_id'),
            array(
                'join_type' => '',
                'table' => 'business_profile',
                'join_table_id' => 'notification.not_from_id',
                'from_table_id' => 'business_profile.user_id')
        );
        $data = array('notification.*', ' business_profile_post.*', 'business_profile.user_id as user_id', 'business_profile.company_name as first_name', 'business_profile.business_user_image as user_image');

        $buslike = $this->data['buslike'] = $this->common->select_data_by_condition('notification', $contition_array, $data, $sortby = 'business_profile_post_id', $orderby = 'desc', $limit = '', $offset = '', $join_str, $groupby = '');

        $contition_array = array('notification.not_type' => 5, 'not_img' => 3, 'notification.not_from' => 6, 'notification.not_to_id' => $userid, 'created_date BETWEEN DATE_SUB(NOW(), INTERVAL 2 MONTH) AND NOW()');
        $join_str = array(array(
                'join_type' => '',
                'table' => 'business_profile_post_comment',
                'join_table_id' => 'notification.not_product_id',
                'from_table_id' => 'business_profile_post_comment.business_profile_post_comment_id'),
            array(
                'join_type' => '',
                'table' => 'business_profile',
                'join_table_id' => 'notification.not_from_id',
                'from_table_id' => 'business_profile.user_id')
        );
        $data = array('notification.*', 'business_profile_post_comment.*', 'business_profile.user_id as user_id', 'business_profile.company_name as first_name', 'business_profile.business_user_image as user_image');

        $buscmtlike = $this->data['buscmtlike'] = $this->common->select_data_by_condition('notification', $contition_array, $data, $sortby = 'business_profile_post_comment_id', $orderby = 'desc', $limit = '', $offset = '', $join_str, $groupby = '');

        $contition_array = array('notification.not_type' => 5, 'not_img' => 5, 'notification.not_from' => 6, 'notification.not_to_id' => $userid, 'created_date BETWEEN DATE_SUB(NOW(), INTERVAL 2 MONTH) AND NOW()');
        $join_str = array(array(
                'join_type' => '',
                'table' => 'post_image',
                'join_table_id' => 'notification.not_product_id',
                'from_table_id' => 'post_image.image_id'),
            array(
                'join_type' => '',
                'table' => 'business_profile',
                'join_table_id' => 'notification.not_from_id',
                'from_table_id' => 'business_profile.user_id')
        );
        $data = array('notification.*', 'post_image.*', 'business_profile.user_id as user_id', 'business_profile.company_name as first_name', 'business_profile.business_user_image as user_image');

        $busimglike = $this->data['busimglike'] = $this->common->select_data_by_condition('notification', $contition_array, $data, $sortby = 'image_id', $orderby = 'desc', $limit = '', $offset = '', $join_str, $groupby = '');

        $contition_array = array('notification.not_type' => 5, 'not_img' => 6, 'notification.not_from' => 6, 'notification.not_to_id' => $userid, 'created_date BETWEEN DATE_SUB(NOW(), INTERVAL 2 MONTH) AND NOW()');
        $join_str = array(array(
                'join_type' => '',
                'table' => 'bus_post_image_comment',
                'join_table_id' => 'notification.not_product_id',
                'from_table_id' => 'bus_post_image_comment.post_image_comment_id'),
            array(
                'join_type' => '',
                'table' => 'business_profile',
                'join_table_id' => 'notification.not_from_id',
                'from_table_id' => 'business_profile.user_id')
        );
        $data = array('notification.*', 'bus_post_image_comment.*', 'business_profile.user_id as user_id', 'business_profile.company_name as first_name', 'business_profile.business_user_image as user_image');

        $busimgcmtlike = $this->data['busimgcmtlike'] = $this->common->select_data_by_condition('notification', $contition_array, $data, $sortby = 'post_image_comment_id', $orderby = 'desc', $limit = '', $offset = '', $join_str, $groupby = '');

        $totalnotifi = $totalnotifi = array_merge((array)$rec_not,(array)$job_not,(array)$hire_not,(array)$work_post,(array)$artcommnet,(array)$artlike,(array)$artcmtlike,(array)$artimglike,(array)$artimgcommnet,(array)$artfollow,(array)$artimgcmtlike,(array)$busimgcommnet,(array)$busifollow,(array)$buscommnet,(array)$buslike,(array)$buscmtlike,(array)$busimgcmtlike,(array)$busimglike);
        $totalnotification =  $this->aasort($totalnotifi, "not_id");

        //NOTIFICATION CODE END
        $return_html = '';

        $totalnotification1 = array_slice($totalnotification, $start, $perpage);
        //echo count($candidatejob);
        //echo count($candidatejob1); die();
        if (empty($_GET["total_record"])) {
            $_GET["total_record"] = count($totalnotification);
        }

        $return_html .= '<input type = "hidden" class = "page_number" value = "' . $page . '" />';
        $return_html .= '<input type = "hidden" class = "total_record" value = "' . $_GET["total_record"] . '" />';
        $return_html .= '<input type = "hidden" class = "perpage_record" value = "' . $perpage . '" />';

        //NOTIFICATION DATA START
        if($totalnotification){
                                foreach ($totalnotification1 as $total) { 
                                 $abc = $total['not_id'];
                               //1 
                                    if ($total['not_from'] == 1) { 
                                      $companyname = $this->db->get_where('recruiter', array('user_id' => $total['user_id']))->row()->re_comp_name; 
                                $return_html .= '<a href="' . base_url() . 'notification/recruiter_post/' . $total['post_id'] . '">';
                                $return_html .= '<li class="'; 
                                if ($total['not_active'] == 1){ $return_html .= 'active2'; } '">'; 
                                        
                                            $return_html .= '<div class="notification-pic" id="noti_pc" >';
                                                                                      
                                         $filepath = FCPATH . $this->config->item('rec_profile_thumb_upload_path') . $total['user_image'];
                                        
                                          
                                            if ($total['user_image'] && (file_exists($filepath)) == 1){
                                                $return_html .= '<img src="' . base_url() . $this->config->item('rec_profile_thumb_upload_path') . $total['user_image'] . '">';
                                                    } else { 
                                                                    $a = $total['first_name'];
                                                                    $b = $total['last_name'];
                                                                    $acr = substr($a, 0, 1);
                                                                    $bcr = substr($b, 0, 1);
                                                $return_html .= '<div class="post-img-div">' . 
                                                                         ucwords($acr) . ucwords($bcr) .  
                                                                    '</div>';
                                                   
                                                }    
                                            $return_html .= '</div>
                                            <div class="notification-data-inside" id="notification_inside">
                                                <h6><b><i> Recruiter</i></font></b><b>' . '  ' . ucwords($total['first_name']) . ' ' . ucwords($total['last_name']) . '</b>  From ' . ucwords($companyname) . '  Invited you for an interview.</h6>
                                              <div  class="hout_noti">' . 
                                                  $this->common->time_elapsed_string($total['not_created_date'], $full = false) . 
                                                '</div>
                                            </div>
                                            

                                        </li>
                                        </a>';
                                        
                                    }
                             
                               
                            //   2
                                    if ($total['not_from'] == 3 && $total['not_img'] == 0) {
                                       
                                        $return_html .= '<a href="' . base_url() . 'artistic/artistic_profile/' . $total['user_id'] . '">';
                                        $return_html .= '<li class="'; if ($total['not_active'] == 1){ $return_html .=  'active2'; } '">'; 
                                        
                                            $return_html .= '<div class="notification-pic" id="noti_pc">';
                                              $filepath = FCPATH . $this->config->item('art_profile_thumb_upload_path') . $total['user_image'];
                                        
                                            if ($total['user_image'] && (file_exists($filepath)) == 1){ 
                                               $return_html .=  '<img src="' . base_url() . $this->config->item('art_profile_thumb_upload_path') . $total['user_image'] .  '" >';
                                                 } else { 
                                                                    $a = $total['first_name'];
                                                                    $b = $total['last_name'];
                                                                    $acr = substr($a, 0, 1);
                                                                    $bcr = substr($b, 0, 1);
                                                              $return_html .=  '<div class="post-img-div">' . 
                                                                        ucwords($acr) . ucwords($bcr) . 
                                                                    '</div>';
                                                  
                                                   } 
                                               
                                            $return_html .= '</div>
                                            
                                            <div class="notification-data-inside" id="notification_inside">
                                                <h6><b>' . ucwords($total['first_name']) . ' ' . ucwords($total['last_name']) . '</b> Started following you in artistic profile.</h6>
                                             <div  class="hout_noti">' . 
                                                  $this->common->time_elapsed_string($total['not_created_date'], $full = false) . 
                                                '</div>
                                            </div>
                                            
                                        </li>
                                        </a>';
                                        
                                    }
                         
                               
                               // 3
                                    if ($total['not_from'] == 3) {
                                        if ($total['not_img'] == 1) {
                                          
                                          $return_html .=  '<a href="' . base_url() . 'notification/art_post/' . $total['art_post_id'] . '">';
                                            $return_html .= '<li class="';
                                            if ($total['not_active'] == 1){ $return_html .= 'active2'; } '">
                                             
                                                <div class="notification-pic" id="noti_pc">';
                                $filepath = FCPATH . $this->config->item('art_profile_thumb_upload_path') . $total['user_image'];
                                        
                                            if ($total['user_image'] && (file_exists($filepath)) == 1){ 
                                          $return_html .= '<img src="' . base_url() . $this->config->item('art_profile_thumb_upload_path') . $total['user_image'] . '" >';
                                                   } else { 
                                                                    $a = $total['first_name'];
                                                                    $b = $total['last_name'];
                                                                    $acr = substr($a, 0, 1);
                                                                    $bcr = substr($b, 0, 1);
                                                                  
                                                             $return_html .= '<div class="post-img-div">' . 
                                                                         ucwords($acr) . ucwords($bcr) .  
                                                                    '</div>';
                                                   
                                                     }                                
                                                $return_html .= '</div>
                                                
                                                <div class="notification-data-inside" id="notification_inside">
                                                    <h6><b>' . '  ' . ucwords($total['first_name']) . ' ' . ucwords($total['last_name']) . '</b> Commented on your post in artistic profile.</h6>
                                                    <div  class="hout_noti">' . 
                                                         $this->common->time_elapsed_string($total['not_created_date'], $full = false) . 
                                                    '</div>
                                                </div>
                                                
                                            </li>
                                            </a>';
                                        } 
                                            
                                       
                                    }
                              
                              
                               // 4
                                    if ($total['not_from'] == 3) {
                                        if ($total['not_img'] == 2) { 
                                            
                                            $return_html .= '<a href="' . base_url() . 'notification/art_post/' . $total['art_post_id'] . '">'; 
                                            $return_html .= '<li class="'; if ($total['not_active'] == 1){ $return_html .= 'active2'; } '">';
                                            
                                                $return_html .= '<div class="notification-pic" id="noti_pc" >';
                                                  $filepath = FCPATH . $this->config->item('art_profile_thumb_upload_path') . $total['user_image'];
                                        
                                            if ($total['user_image'] && (file_exists($filepath)) == 1){ 
                                                    $return_html .= '<img src="' . base_url() . $this->config->item('art_profile_thumb_upload_path') . $total['user_image'] . '" >';
                                                   } else { 
                                                                    $a = $total['first_name'];
                                                                    $b = $total['last_name'];
                                                                    $acr = substr($a, 0, 1);
                                                                    $bcr = substr($b, 0, 1);
                                                                   
                                                                    $return_html .= '<div class="post-img-div">' . 
                                                                       ucwords($acr) . ucwords($bcr) .
                                                                    '</div>';
                                                
                                                   } 
                                                $return_html .= '</div>
                                                
                                                <div class="notification-data-inside" id="notification_inside">
                                                    <h6><b>' . '  ' . ucwords($total['first_name']) . ' ' . ucwords($total['last_name']) . '</b> Likes your post in artistic profile.</h6>
                                                    <div  class="hout_noti">' . 
                                                      $this->common->time_elapsed_string($total['not_created_date'], $full = false) . 
                                                    '</div>
                                                </div>
                                                
                                            </li>
                                            </a>';
                                       
                                        
                                        }  
                                       }
                               
                               
                                            
                                           
                                //5
                                    if ($total['not_from'] == 3) {
                                        if ($total['not_img'] == 3) {
                                            
                                            $return_html .= '<a href="' .  base_url() . 'notification/art_post/' . $total['art_post_id'] . '">
                                            <li class="';  if ($total['not_active'] == 1){ $return_html .= 'active2'; } 
                                            $return_html .= '">
                                                <div class="notification-pic" id="noti_pc" >';
                                                
                                                    
                                                     $filepath = FCPATH . $this->config->item('art_profile_thumb_upload_path') . $total['user_image'];
                                        
                                            if ($total['user_image'] && (file_exists($filepath)) == 1){
                                                    $return_html .= '<img src="' . base_url() . $this->config->item('art_profile_thumb_upload_path') . $total['user_image'] . '" >';
                                                  } else { 
                                                                    $a = $total['first_name'];
                                                                    $b = $total['last_name'];
                                                                    $acr = substr($a, 0, 1);
                                                                    $bcr = substr($b, 0, 1);
                                                                   
                                                                    $return_html .= '<div class="post-img-div">' . 
                                                                       ucwords($acr) . ucwords($bcr); 
                                           } 
                                                $return_html .= '</div>
                                                
                                                <div class="notification-data-inside" id="notification_inside">
                                                    <h6><b>' . '  ' . ucwords($total['first_name']) . ' ' . ucwords($total['last_name']) . '</b> Likes your posts comment in artistic profile.</h6>
                                                  <div  class="hout_noti">' . 
                                                      $this->common->time_elapsed_string($total['not_created_date'], $full = false) . 
                                                    '</div>
                                                </div>
                                                
                                            </li>
                                            </a>';
                                        }
                                  
                                } 
                                            
                                         
                             //   6
                                    if ($total['not_from'] == 3) {
                                      if ($total['not_img'] == 5) {   
                                      $return_html .= '<a href="' . base_url() . 'notification/art_post_img/' . $total['post_id'] . '/' . $total['image_id'] . '">
                                            <li class="'; if ($total['not_active'] == 1){ $return_html .= 'active2'; } $return_html .= '">'; 
                                            
                                                $return_html .= '<div class="notification-pic"  id="noti_pc">';
                                          $filepath = FCPATH . $this->config->item('art_profile_thumb_upload_path') . $total['user_image'];
                                        
                                            if ($total['user_image'] && (file_exists($filepath)) == 1){ 
                                             $return_html .= '<img src="' . base_url() . $this->config->item('art_profile_thumb_upload_path') . $total['user_image'] . '" >';
                                                } else { 
                                                                    $a = $total['first_name'];
                                                                    $b = $total['last_name'];
                                                                    $acr = substr($a, 0, 1);
                                                                    $bcr = substr($b, 0, 1);
                                                                   
                                                           $return_html .= '<div class="post-img-div">' .
                                                                       ucwords($acr) . ucwords($bcr) .
                                                                    '</div>';
                                                   
                                                     }          
                                               $return_html .= '</div>
                                                
                                                <div class="notification-data-inside" id="notification_inside">
                                                    <h6><b>' . '  ' . ucwords($total['first_name']) . ' ' . ucwords($total['last_name']) . '</b> Likes your photo in artistic profile.</h6>
                                                    <div  class="hout_noti">' . 
                                                       $this->common->time_elapsed_string($total['not_created_date'], $full = false) . 
                                                    '</div>
                                                </div>
                                                
                                            </li>
                                            </a>';
                                            
                                      }

                                }
                                
//7
                                    if ($total['not_from'] == 3) {
                                        if ($total['not_img'] == 4) {
         $postid = $this->db->get_where('post_image', array('image_id' => $total['post_image_id']))->row()->post_id;
         $return_html .= '<a href="' . base_url() . 'notification/art_post_img/' . $postid . '/' . $total['post_image_id'] . '">
                                            <li class="'; if ($total['not_active'] == 1){ $return_html .= 'active2'; } $return_html .= '">
                                            <div class="notification-pic" id="noti_pc" >';
                                         $filepath = FCPATH . $this->config->item('art_profile_thumb_upload_path') . $total['user_image'];
                                        
                                            if ($total['user_image'] && (file_exists($filepath)) == 1){ 
                                                   $return_html .= '<img src="' . base_url() . $this->config->item('art_profile_thumb_upload_path') . $total['user_image'] . '" >';
                                                   } else { 
                                                                    $a = $total['first_name'];
                                                                    $b = $total['last_name'];
                                                                    $acr = substr($a, 0, 1);
                                                                    $bcr = substr($b, 0, 1);
                                                                   
                                                                    $return_html .= '<div class="post-img-div">' . 
                                                                       ucwords($acr) . ucwords($bcr) . 
                                                                    '</div>';
                                                  
                                                    }   
                                                
                                             $return_html .= '</div>
                                            
                                            <div class="notification-data-inside" id="notification_inside">
                                                <h6><b>' . '  ' . ucwords($total['first_name']) . ' ' . ucwords($total['last_name']) . '</b> Commneted on your photo in artistic profile.</h6>
                                                <div  class="hout_noti">'
                                                 . $this->common->time_elapsed_string($total['not_created_date'], $full = false) . 
                                                '</div>
                                            </div>
                                            
                                        </li>
                                        </a>';
                                        }  
                                            
                                        
                               
                                }
                            
                                        
                                        
                                     
                          //   8
                                    if ($total['not_from'] == 3) {
                                        if ($total['not_img'] == 6) {
       $postid = $this->db->get_where('post_image', array('image_id' => $total['post_image_id']))->row()->post_id; 
       $return_html .= '<a href="' . base_url() . 'notification/art_post_img/' . $postid . '/' . $total['post_image_id'] . '">
                                            <li class="' ; if ($total['not_active'] == 1){ $return_html .= 'active2'; } $return_html .= '">
                                            
                                            <div class="notification-pic" id="noti_pc">';
                                           $filepath = FCPATH . $this->config->item('art_profile_thumb_upload_path') . $total['user_image'];
                                        
                                            if ($total['user_image'] && (file_exists($filepath)) == 1){ 
                                                 $return_html .= '<img src="' . base_url() . $this->config->item('art_profile_thumb_upload_path') . $total['user_image'] . '" >';
                                                 } else { 
                                                                    $a = $total['first_name'];
                                                                    $b = $total['last_name'];
                                                                    $acr = substr($a, 0, 1);
                                                                    $bcr = substr($b, 0, 1);
                                                                   
                                                                   $return_html .= '<div class="post-img-div">' . 
                                                                       ucwords($acr) . ucwords($bcr) .
                                                                    '</div>';
                                                  
                                                     } 
                                             $return_html .= '</div>
                                            
                                            <div class="notification-data-inside" id="notification_inside">
                                                <h6><b>' . '  ' . ucwords($total['first_name']) . ' ' . ucwords($total['last_name']) . '</b> Likes your photos comment in artistic profile.</h6>
                                                <div  class="hout_noti">'
                                                   . $this->common->time_elapsed_string($total['not_created_date'], $full = false) . 
                                                '</div>
                                            </div>
                                            
                                        </li>
                                        </a>';
                                        }  
                                            
                                          
                       
                                }
                               
                                     $bus_from1 = $total['not_from'];
                                     $bus_img1 = $total['not_img'];

                                    if ($bus_from1 == '6' && $bus_img1 == '1') {
                                         $companyname = $this->db->get_where('business_profile', array('user_id' => $total['not_from_id']))->row()->company_name;
                                      
                                         $return_html .= '<a href="' . base_url() . 'notification/business_post/' . $total['business_profile_post_id'] . '"  onClick="not_active(' . $total['not_id'] . ')">
                                        <li class="'; if ($total['not_active'] == 1){ $return_html .= 'active2'; } '">';
                                        
                                         $return_html .= '<div class="notification-pic" id="noti_pc" >';
                                                
                                            $filepath = FCPATH . $this->config->item('bus_profile_thumb_upload_path') . $total['user_image'];
                                        
                                            if ($total['user_image'] && (file_exists($filepath)) == 1){ 
                                              $return_html .=  '<img src="' . base_url() . $this->config->item('bus_profile_thumb_upload_path') . $total['user_image'] . '" >';
                                                   } else { 
                                                                    $a = $companyname;
                                                                    $acr = substr($a, 0, 1);
                                                                    
                                                                 
                                                                   $return_html .=  '<div class="post-img-div">' . 
                                                                        ucwords($acr) . 
                                                                    '</div>';
                                                  
                                                   } 
                                                    
                                            $return_html .=  '</div>
                                            
                                            <div class="notification-data-inside" id="notification_inside">
                                                <h6><b>' . '  ' . ucwords($companyname) . '</b> Commented on your post in business profile.</h6>
                                              <div  class="hout_noti">'
                                                  . $this->common->time_elapsed_string($total['not_created_date'], $full = false) .
                                                '</div>
                                            </div>
                                            
                                        </li>
                                        </a>';
                                        
                                    } 
                                        //10
                                    if ($total['not_from'] == 6) {
                                        if ($total['not_img'] == 4) {
         $postid = $this->db->get_where('post_image', array('image_id' => $total['post_image_id']))->row()->post_id;
          $companyname = $this->db->get_where('business_profile', array('user_id' => $total['not_from_id']))->row()->company_name;
          $return_html .=  '<a href="' . base_url() . 'notification/bus_post_img/' . $postid . '/' . $total['post_image_id'] . '">
                                            <li class="'; if ($total['not_active'] == 1){ $return_html .=  'active2'; } '">';
                                            
                                            $return_html .=  '<div class="notification-pic" id="noti_pc" >';
                                    $filepath = FCPATH . $this->config->item('bus_profile_thumb_upload_path') . $total['user_image'];
                                        
                                            if ($total['user_image'] && (file_exists($filepath)) == 1){ 
                                                    $return_html .=  '<img src="' . base_url() . $this->config->item('bus_profile_thumb_upload_path') . $total['user_image'] . '" >';
                                                  } else { 
                                                                    $a = $companyname;
                                                                    $acr = substr($a, 0, 1);
                                                                    
                                                                    
                                                                    $return_html .=  '<div class="post-img-div">' . 
                                                                       ucwords($acr) .
                                                                    '</div>';
                                                   
                                                    }      
                                            $return_html .= '</div>
                                            
                                            <div class="notification-data-inside" id="notification_inside">';
                                                $return_html .= '<h6><b>' . '  ' . ucwords($companyname)  . '</b> Commented on your photo in business profile.</h6>
                                                <div  class="hout_noti">'
                                                   . $this->common->time_elapsed_string($total['not_created_date'], $full = false) .
                                                '</div>
                                            </div>
                                           
                                        </li>
                                         </a>';
                                        }  
                                            
                                        
                                    }

                              
                                 //11
                                    if ($total['not_from'] == 6) {
                                        if ($total['not_img'] == 6) {
         $postid = $this->db->get_where('post_image', array('image_id' => $total['post_image_id']))->row()->post_id;
         $companyname = $this->db->get_where('business_profile', array('user_id' => $total['not_from_id']))->row()->company_name;
         $return_html .= '<a href="' . base_url() . 'notification/bus_post_img/' . $postid . '/' . $total['post_image_id'] . '">';
                                            $return_html .= '<li class="'; if ($total['not_active'] == 1){ $return_html .= 'active2'; } $return_html .= '">';
                                            
                                            $return_html .= '<div class="notification-pic" id="noti_pc" >';
                                               $filepath = FCPATH . $this->config->item('bus_profile_thumb_upload_path') . $total['user_image'];
                                        
                                            if ($total['user_image'] && (file_exists($filepath)) == 1){ 
                                               $return_html .= '<img src="' . base_url() . $this->config->item('bus_profile_thumb_upload_path') . $total['user_image'] . '" >';
                                                   } else { 
                                                                    $a = $companyname;
                                                                    $acr = substr($a, 0, 1);
                                                                    
                                                                  
                                                                 $return_html .= '<div class="post-img-div">' .
                                                                       ucwords($acr) .
                                                                    '</div>';
                                                 
                                                   }  
                                            $return_html .= '</div>
                                            
                                            <div class="notification-data-inside" id="notification_inside">
                                                <h6><b>' . '  ' . ucwords($companyname) .  '</b> Likes your photos comment in business profile.</h6>
                                               <div  class="hout_noti">' . 
                                                   $this->common->time_elapsed_string($total['not_created_date'], $full = false) . '
                                                </div>
                                            </div>
                                            
                                        </li>
                                        </a>';
                                      }  
                                            
                                         
                                }
                                

                         
                         //12
                                    if ($total['not_from'] == 6 && $total['not_img'] == 0) {
                                        $id = $this->db->get_where('business_profile', array('user_id' => $total['not_from_id']))->row()->business_slug;
                                        $companyname = $this->db->get_where('business_profile', array('user_id' => $total['not_from_id']))->row()->company_name;
                                        if ($id) {
                                            
                                            $return_html .= '<a href="' . base_url() . 'business_profile/business_resume/' . $id . '">';
                                            $return_html .= '<li class="'; if ($total['not_active'] == 1){ $return_html .= 'active2'; } '">';
                                             
                                                $return_html .= '<div class="notification-pic" id="noti_pc" >';
   $filepath = FCPATH . $this->config->item('bus_profile_thumb_upload_path') . $total['user_image'];
                                        
                                            if ($total['user_image'] && (file_exists($filepath)) == 1){ 
                                                   $return_html .= '<img src="' . base_url() . $this->config->item('bus_profile_thumb_upload_path') . $total['user_image'] . '" >';
                                                   } else { 
                                                                    $a = $companyname;
                                                                    $acr = substr($a, 0, 1);
                                                                    
                                                                    
                                                                    $return_html .= '<div class="post-img-div">' .
                                                                       ucwords($acr) .  
                                                                    '</div>';
                                                   
                                                  } 
                                                   
                                                $return_html .= '</div>
                                               
                                                <div class="notification-data-inside" id="notification_inside">
                                                    <h6><b>' . '  ' . ucwords($companyname) .  '</b> Started following you in business profile.</h6>
                                                  <div  class="hout_noti">' . 
                                                    $this->common->time_elapsed_string($total['not_created_date'], $full = false) . 
                                                    '</div>
                                                </div>
                                                
                                           </li>
                                            </a>'; 
                                            
                                        }
                                    }

                            
                            //  13
                                    if ($total['not_from'] == 6) {
                                        if ($total['not_img'] == 2) {
                                    $companyname = $this->db->get_where('business_profile', array('user_id' => $total['not_from_id']))->row()->company_name;
                                           
                                            $return_html .= '<a href="' . base_url() . 'notification/business_post/' . $total['business_profile_post_id'] . '">';
                                            $return_html .= '<li class="'; if ($total['not_active'] == 1){ $return_html .= 'active2'; } $return_html .= '">';
                                               $return_html .= '<div class="notification-pic" id="noti_pc">';
                                           $filepath = FCPATH . $this->config->item('bus_profile_thumb_upload_path') . $total['user_image'];
                                        
                                            if ($total['user_image'] && (file_exists($filepath)) == 1){ 
                 $return_html .= '<img src="' . base_url() . $this->config->item('bus_profile_thumb_upload_path') . $total['user_image'] . '" >';
                } else { 
                                                                    $a = $companyname;
                                                                    $acr = substr($a, 0, 1);
                                                                    
                                                                   
                                                                     $return_html .= '<div class="post-img-div">' . 
                                                                       ucwords($acr) .
                                                                    '</div>';
                                                  
                                                    } 

                                                
                                                $return_html .= '</div>
                                            
                                                <div class="notification-data-inside" id="notification_inside">
                                                    <h6><b>' . '  ' . ucwords($companyname) .  '</b> Likes your post in business profile.</h6>
                                                   <div  class="hout_noti">' . 
                                                       $this->common->time_elapsed_string($total['not_created_date'], $full = false) . 
                                                    '</div>
                                                </div>
                                                
                                            </li>
                                            </a>';
                                         } 
                                            
                                          
                                    }
                             
                             // 14
                                    if ($total['not_from'] == 6) {
                                      if ($total['not_img'] == 3) { 
                        $companyname = $this->db->get_where('business_profile', array('user_id' => $total['not_from_id']))->row()->company_name;              
                                          
                                          $return_html .= '<a href="' . base_url() . 'notification/business_post/' . $total['business_profile_post_id'] . '">';
                                           $return_html .= '<li class="'; if ($total['not_active'] == 1){ $return_html .= 'active2'; } $return_html .= '">';
                                           $return_html .= '<div class="notification-pic" id="noti_pc">';
                                                 $filepath = FCPATH . $this->config->item('bus_profile_thumb_upload_path') . $total['user_image'];
                                        
                                            if ($total['user_image'] && (file_exists($filepath)) == 1){
                                           $return_html .= '<img src="' .base_url() . $this->config->item('bus_profile_thumb_upload_path') . $total['user_image'] . '">';
                                                  } else { 
                                                                    $a = $companyname;
                                                                    $acr = substr($a, 0, 1);
                                                                    
                                                                 
                                                                   $return_html .= '<div class="post-img-div">' . 
                                                                      ucwords($acr) . 
                                                                    '</div>';
                                                  
                                                    }    
                                                $return_html .= '</div>
                                                
                                                <div class="notification-data-inside" id="notification_inside">
                                                    <h6><b>' . '  ' . ucwords($companyname) .  '</b> Likes your post\'s comment in business profile.</h6>
                                               <div  class="hout_noti">'
                                                       . $this->common->time_elapsed_string($total['not_created_date'], $full = false) . 
                                                    '</div>
                                                </div>
                                                
                                            </li>
                                            </a>';
                                            
                                      }
                                    }
                             
                                
                                            
                                            
                             // 15
                                    if ($total['not_from'] == 6) {
                                      if ($total['not_img'] == 5) { 
                                         $companyname = $this->db->get_where('business_profile', array('user_id' => $total['not_from_id']))->row()->company_name;        
                                         
                                         $return_html .= '<a href="' . base_url('notification/bus_post_img/' . $total['post_id'] . '/' . $total['image_id']) . '">';
                                            $return_html .= '<li class="'; if ($total['not_active'] == 1){ $return_html .= 'active2'; } $return_html .= '">';
                                             
                                               $return_html .= '<div class="notification-pic" id="noti_pc" >';
                                                  $filepath = FCPATH . $this->config->item('bus_profile_thumb_upload_path') . $total['user_image'];
                                        
                                            if ($total['user_image'] && (file_exists($filepath)) == 1){
                                            $return_html .= '<img src="' . base_url() . $this->config->item('bus_profile_thumb_upload_path') . $total['user_image'] . '" >';
                                                      } else { 
                                                                    $a = $companyname;
                                                                    $acr = substr($a, 0, 1);
                                                                    
                                                                   
                                                                    $return_html .= '<div class="post-img-div">' . 
                                                                       ucwords($acr) .
                                                                    '</div>';
                                                     } 

                                                $return_html .= '</div>
                                               
                                                <div class="notification-data-inside" id="notification_inside">
                                                    <h6><b>' . '  ' . ucwords($companyname) .  '</b> Likes your photo in business profile.</h6>
                                                 <div  class="hout_noti">'
                                                       . $this->common->time_elapsed_string($total['not_created_date'], $full = false) .
                                                    '</div>
                                                </div>
                                                
                                            </li>
                                            </a>';
                                           
                                      }
                                    }

                                                              //  17
                                    if ($total['not_from'] == 2) {

                                        $id = $this->db->get_where('job_reg', array('user_id' => $total['not_to_id']))->row()->job_id;
                                        if ($id) {
                                            
                                            $return_html .= '<a href="' . base_url() . 'job/job_printpreview/' . $total['not_from_id'].'?page=recruiter">'; 
                                            $return_html .= '<li class="'; if ($total['not_active'] == 1){ $return_html .= 'active2'; } 
                                            $return_html .= '">
                                                <div class="notification-pic" id="noti_pc" >';
                                             $filepath = FCPATH . $this->config->item('job_profile_thumb_upload_path') . $total['user_image'];
                                        
                                            if ($total['user_image'] && (file_exists($filepath)) == 1){ 
                                                    $return_html .= '<img src="' . base_url() . $this->config->item('job_profile_thumb_upload_path') . $total['user_image'] . '" >';
                                        } else { 
                                                                    $a = $total['first_name'];
                                                                    $b = $total['last_name'];
                                                                    $acr = substr($a, 0, 1);
                                                                    $bcr = substr($b, 0, 1);
                                                                    
                                                                    
                                                                    $return_html .= '<div class="post-img-div">'
                                                                       . ucwords($acr) . ucwords($bcr) . 
                                                                    '</div>';
                                                  
                                                   } 
                                                   
                                                $return_html .= '</div>
                                                <div class="notification-data-inside" id="notification_inside">
                                                    <h6><b><i> Job Seeker</i></font></b><b>' . '  ' . ucwords($total['first_name']) . ' ' . ucwords($total['last_name']) . '</b> Aplied on your job post.</h6>
                                                <div  class="hout_noti">' .  
                                                     $this->common->time_elapsed_string($total['not_created_date'], $full = false) . 
                                                    '</div>
                                                </div>
                                                
                                            </li>
                                            </a>';
                                           
                                        }
                                    }
                              
                                
                             //   foreach ($work_not as $art) {
                                    if ($total['not_from'] == 5) {
                                  //    19
                                           
                                           $return_html .= '<a href="' . base_url() . 'freelancer/freelancer_post_profile/' . $total['user_id'].'?page=freelancer_post">'; 
                                           $return_html .= '<li class="'; if ($total['not_active'] == 1){ $return_html .= 'active2'; } $return_html .= '">';
                                            
                                                $return_html .= '<div class="notification-pic" id="noti_pc" >';
                                              $filepath = FCPATH . $this->config->item('free_hire_profile_thumb_upload_path') . $total['user_image'];
                                        
                                            if ($total['user_image'] && (file_exists($filepath)) == 1){ 
                                                    $return_html .= '<img src="' . base_url() . $this->config->item('free_hire_profile_thumb_upload_path') . $total['user_image'] . '" >';
                                                    } else { 
                                                                    $a = $total['first_name'];
                                                                    $b = $total['last_name'];
                                                                    $acr = substr($a, 0, 1);
                                                                    $bcr = substr($b, 0, 1);
                                                                    
                                                                   
                                                                   $return_html .= '<div class="post-img-div">' . 
                                                                       ucwords($acr) . ucwords($bcr) .
                                                                    '</div>';
       
                                                     }
                                                $return_html .= '</div>
                                                
                                                <div class="notification-data-inside" id="notification_inside">
                                                    <h6><font color="black"><b><i>Employer</i></font></b><b>' . '  ' . ucwords($total['first_name']) . ' ' . ucwords($total['last_name']) . '</b> Selected you for project.</h6>
                                                 <div  class="hout_noti">' .
                                                        $this->common->time_elapsed_string($total['not_created_date'], $full = false) .
                                                    '</div>
                                                </div>
                                                
                                            </li>
                                            </a>';
                                            
                                        }
                                                             //20
                                   if ($total['not_from'] == 4) {
                                        $return_html .= '<a href="' . base_url() . 'freelancer/freelancer_post_profile/' . $total['not_from_id'] . '">';
                                        $return_html .= '<li class="'; if ($total['not_active'] == 1){ $return_html .= 'active2'; } $return_html .= '">
                                            <div class="notification-pic" id="noti_pc" >';
                                             $filepath = FCPATH . $this->config->item('free_post_profile_thumb_upload_path') . $total['user_image'];
                                        
                                            if ($total['user_image'] && (file_exists($filepath)) == 1){ 
                                                    $return_html .= '<img src="' . base_url() . $this->config->item('free_post_profile_thumb_upload_path') . $total['user_image'] . '" >';
                                                   } else { 
                                                                    $a = $total['first_name'];
                                                                    $b = $total['last_name'];
                                                                    $acr = substr($a, 0, 1);
                                                                    $bcr = substr($b, 0, 1);
                                                                    
                                                                   
                                                                    $return_html .= '<div class="post-img-div">' . 
                                                                        ucwords($acr) . ucwords($bcr) . 
                                                                    '</div>';
                                                  
                                                    } 
                                             $return_html .= '</div>
                                            
                                            <div class="notification-data-inside" id="notification_inside">
                                                <h6><font color="black"><b><i>Freelancer</i></font></b><b>' . '  ' . ucwords($total['first_name']) . ' ' . ucwords($total['last_name']) . '</b> Applied on your post.</h6>
                                             <div  class="hout_noti">' . 
                                                 $this->common->time_elapsed_string($total['not_created_date'], $full = false) . 
                                                '</div>
                                            </div>
                                            
                                        </li>
                                        </a>';
                                        
                                        
                                   }
                               }
    }
                                
               echo   $return_html;
        //NOTIFICATION DATA END
    }
  

}
