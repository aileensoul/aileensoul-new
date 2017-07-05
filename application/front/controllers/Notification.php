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
        $contition_array = array('notification.not_type' => 3, 'notification.not_from' => 4, 'notification.not_to_id' => $userid, 'created_date BETWEEN DATE_SUB(NOW(), INTERVAL 2 MONTH) AND NOW()');

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
                'table' => 'user',
                'join_table_id' => 'notification.not_from_id',
                'from_table_id' => 'user.user_id')
        );
        $data = array('notification.*', ' user_invite.*', ' user.user_id', 'user.first_name', 'user.user_image', 'user.last_name');

        $work_post = $this->data['work_post'] = $work_post = $this->common->select_data_by_condition('notification', $contition_array, $data, $sortby = 'invite_id', $orderby = 'desc', $limit = '', $offset = '', $join_str, $groupby = '');


     //   echo '<pre>'; print_r($this->data['hire_noth']); 
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
        $contition_array = array('notification.not_type' => 5, 'notification.not_from' => 3,'not_img' => 2, 'notification.not_to_id' => $userid, 'created_date BETWEEN DATE_SUB(NOW(), INTERVAL 2 MONTH) AND NOW()');
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
        
        $contition_array = array('notification.not_type' => 5, 'not_img' => 5,'notification.not_from' => 3, 'notification.not_to_id' => $userid, 'created_date BETWEEN DATE_SUB(NOW(), INTERVAL 2 MONTH) AND NOW()');
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
        

        $contition_array = array('notification.not_type' => 5, 'not_img' => 3 ,'notification.not_from' => 3, 'notification.not_to_id' => $userid, 'created_date BETWEEN DATE_SUB(NOW(), INTERVAL 2 MONTH) AND NOW()');
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

        $contition_array = array('notification.not_type' => 6, 'not_img' => 4,'notification.not_from' => 3, 'notification.not_to_id' => $userid, 'created_date BETWEEN DATE_SUB(NOW(), INTERVAL 2 MONTH) AND NOW()');
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
        $contition_array = array('notification.not_type' => 5, 'not_img' => 2 , 'notification.not_from' => 6, 'notification.not_to_id' => $userid, 'created_date BETWEEN DATE_SUB(NOW(), INTERVAL 2 MONTH) AND NOW()');
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

        $this->data['totalnotifi'] = $totalnotifi = array_merge($rec_not, $job_not, $hire_not, $work_post,$artcommnet, $artlike, $artcmtlike, $artimglike, $artimgcommnet,$artfollow, $artimgcmtlike, $busimgcommnet, $busifollow, $buscommnet, $buslike, $buscmtlike, $busimgcmtlike, $busimglike);
       $this->data['totalnotification'] = $totalnotification = $this->aasort($totalnotifi, "not_id");
       
     // echo '<pre>'; print_r($totalnotification); die();
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

          $contition_array = array('status' => '1', 'is_deleted' => '0');


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
        $result = $this->common->select_data_by_condition('notification', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        //echo '<pre>'; print_r($result); 
        $count = count($result);
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
    public function select_msg_noti() { //echo "hello"; die();
        $userid = $this->session->userdata('aileenuser');
        $contition_array = array('not_read' => 2, 'not_to_id' => $userid, 'not_type' => 2);
        $result = $this->common->select_data_by_condition('notification', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = 'not_from_id');

        //      echo '<pre>'; print_r($result); 
        $count = count($result);
        echo $count;
    }

    public function update_msg_noti() {
        $userid = $this->session->userdata('aileenuser');

        //echo "<pre>"; print_r($data); die();

        $contition_array = array('not_read' => 2, 'not_to_id' => $userid, 'not_type' => 2);
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

//Notification count select & update for Message End

    public function freelancer_hire_post($id) {

        $userid = $this->session->userdata('aileenuser');

        $contition_array = array('is_delete' => '0', 'post_id' => $id, 'status' => '1');

        $postdata = $this->data['freelancerpostdata'] = $this->common->select_data_by_condition('freelancer_post', $contition_array, $data, $sortby = 'freelancer_post.created_date', $orderby = 'desc', $limit = '', $offset = '', $join_str, $groupby = '');
        //  echo "<pre>"; print_r($postdata); die();
        $this->load->view('Notification/freelancer_hire_post', $this->data);
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
        $contition_array = array('notification.not_type' => 3, 'notification.not_from' => 4, 'notification.not_to_id' => $userid, 'created_date BETWEEN DATE_SUB(NOW(), INTERVAL 2 MONTH) AND NOW()');

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


        $contition_array = array('notification.not_type' => 4, 'notification.not_from' => 5, 'notification.not_to_id' => $userid, 'created_date BETWEEN DATE_SUB(NOW(), INTERVAL 2 MONTH) AND NOW()');
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
        $contition_array = array('notification.not_type' => 5, 'notification.not_from' => 3,'not_img' => 2, 'notification.not_to_id' => $userid, 'created_date BETWEEN DATE_SUB(NOW(), INTERVAL 2 MONTH) AND NOW()');
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
        
        $contition_array = array('notification.not_type' => 5, 'not_img' => 5,'notification.not_from' => 3, 'notification.not_to_id' => $userid, 'created_date BETWEEN DATE_SUB(NOW(), INTERVAL 2 MONTH) AND NOW()');
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
        

        $contition_array = array('notification.not_type' => 5, 'not_img' => 3 ,'notification.not_from' => 3, 'notification.not_to_id' => $userid, 'created_date BETWEEN DATE_SUB(NOW(), INTERVAL 2 MONTH) AND NOW()');
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

        $contition_array = array('notification.not_type' => 6, 'not_img' => 4,'notification.not_from' => 3, 'notification.not_to_id' => $userid, 'created_date BETWEEN DATE_SUB(NOW(), INTERVAL 2 MONTH) AND NOW()');
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
        $contition_array = array('notification.not_type' => 5, 'not_img' => 2 , 'notification.not_from' => 6, 'notification.not_to_id' => $userid, 'created_date BETWEEN DATE_SUB(NOW(), INTERVAL 2 MONTH) AND NOW()');
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

        $this->data['totalnotifi'] = $totalnotifi = array_merge($rec_not, $job_not, $hire_not, $work_post,$artcommnet, $artlike, $artcmtlike, $artimglike, $artimgcommnet,$artfollow, $artimgcmtlike, $busimgcommnet, $busifollow, $buscommnet, $buslike, $buscmtlike, $busimgcmtlike, $busimglike);
       $this->data['totalnotification'] = $totalnotification = $this->aasort($totalnotifi, "not_id");
       
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
       //echo count($totalnotification); die();
       $i = 0;
        foreach ($totalnotification as $total) {  
            if ($total['not_from'] == 1) {
 $companyname = $this->db->get_where('recruiter', array('user_id' => $total['user_id']))->row()->re_comp_name; 
                $notification .= '<li><a href="' . base_url('notification/recruiter_post/' . $total['post_id']) . '"><div class="notification-database">';
                $notification .= '<div class="notification-pic">';


                if($total['user_image']){
                $notification .= '<img src="' . base_url($this->config->item('user_thumb_upload_path') . $total['user_image']) . '" >';
                 }else{
                  $notification .= '<img src="' . base_url(NOIMAGE) . '" >';  
                 }


                $notification .= '</div><div class="notification-data-inside">';
                $notification .= '<h6><font color="black"><b><i> Recruiter</i></font></b><b>' . '  ' . ucwords($total['first_name']) . ' ' . ucwords($total['last_name']) . '</b>  From ' . ucwords($companyname) . ' Invited You For An Interview.</h6>';
                $notification .= '<div ><i class="fa fa-comment" aria-hidden="true" style="margin-right:8px;"></i>';
                $notification .= '' . $this->common->time_elapsed_string($total['not_created_date'], $full = false) . '';
                $notification .= '</div></div></div></a></li>';
            }
      //  }

       // foreach ($artfollow as $art) {
            if ($total['not_from'] == 3 && $total['not_img'] == 0) {

                $notification .= '<li><a href="' . base_url('artistic/artistic_profile/' . $total['user_id']) . '"><div class="notification-database">';
                $notification .= '<div class="notification-pic">';


                 if($total['user_image']){
                $notification .= '<img src="' . base_url($this->config->item('user_thumb_upload_path') . $total['user_image']) . '" >';
                 }else{
                  $notification .= '<img src="' . base_url(NOIMAGE) . '" >';  
                 }


                $notification .= '</div><div class="notification-data-inside">';
                $notification .= '<h6><b>' . '  ' . ucwords($total['first_name']) . ' ' . ucwords($total['last_name']) . '</b> Started Following You In Artistic.</h6>';
                $notification .= '<div ><i class="fa fa-comment" aria-hidden="true" style="margin-right:8px;"></i>';
                $notification .= '' . $this->common->time_elapsed_string($total['not_created_date'], $full = false) . '';
                $notification .= '</div></div></div></a></li>';
            }
     //   }

    //    foreach ($artcommnet as $art) {
            $art_not_from = $total['not_from'];
            $art_not_img = $total['not_img'];
            if ($art_not_from == '3' && $art_not_img == '1') {

                $notification .= '<li><a href="' . base_url('notification/art_post/' . $total['art_post_id']) . '"><div class="notification-database">';
                $notification .= '<div class="notification-pic">';

                 if($total['user_image']){
                $notification .= '<img src="' . base_url($this->config->item('user_thumb_upload_path') . $total['user_image']) . '" >';
                 }else{
                  $notification .= '<img src="' . base_url(NOIMAGE) . '" >';  
                 }


                $notification .= '</div><div class="notification-data-inside">';
                //$notification .= '';
                $notification .= '<h6>';
                $notification .= '<b>' . ' ' . ucwords($total['first_name']) . ' ' . ucwords($total['last_name']) . '</b> Commneted On Your Post In Artistic.';
                $notification .= '</h6><div><i class="fa fa-comment" aria-hidden="true" style="margin-right:8px;"></i>';
                $notification .= '' . $this->common->time_elapsed_string($total['not_created_date'], $full = false) . '';
                $notification .= '</div></div></div></a></li>';
            }
     //   }
       // foreach ($artlike as $art) {
            $art_not_from = $total['not_from'];
            $art_not_img = $total['not_img'];
            if ($art_not_from == '3' && $art_not_img == '2') {

                $notification .= '<li><a href="' . base_url('notification/art_post/' . $total['art_post_id']) . '"><div class="notification-database">';
                $notification .= '<div class="notification-pic">';


                if($total['user_image']){
                $notification .= '<img src="' . base_url($this->config->item('user_thumb_upload_path') . $total['user_image']) . '" >';
                 }else{
                  $notification .= '<img src="' . base_url(NOIMAGE) . '" >';  
                 }

                $notification .= '</div><div class="notification-data-inside">';
                $notification .= '<h6><b>' . '  ' . ucwords($total['first_name']) . ' ' . ucwords($total['last_name']) . '</b> Likes Your Post In Artistic.</h6>';
                $notification .= '<div ><i class="fa fa-comment" aria-hidden="true" style="margin-right:8px;"></i>';
                $notification .= '' . $this->common->time_elapsed_string($total['not_created_date'], $full = false) . '';
                $notification .= '</div></div> </div></a> </li>';
            } 
//            elseif ($art_not_from == '3' && $art_not_img == '5') {
//                $notification .= '<li>' . $art_not_img . '<div class="notification-database">';
//                $notification .= '<div class="notification-pic">';
//                $notification .= '<img src="' . base_url($this->config->item('user_thumb_upload_path') . $total['user_image']) . '" >';
//                $notification .= '</div><div class="notification-data-inside">';
//                $notification .= '<a href="' . base_url('artistic/postnewpage/' . $total['art_post_id']) . '"><h6><font color="#4e6db1"><b><i> Artistic</i></font></b><b>' . '  ' . $total['first_name'] . ' ' . $total['last_name'] . '</b> liked on your image</h6></a>';
//                $notification .= '<div ><i class="fa fa-comment" aria-hidden="true" style="margin-right:8px;"></i>';
//                $notification .= '' . $this->common->time_elapsed_string($total['not_created_date'], $full = false) . '';
//                $notification .= '</div></div> </div> </li>';
//            }
      //  }


      //  foreach ($artcmtlike as $art) {
            if ($total['not_from'] == 3) {
                if ($total['not_img'] == 3) {

                    $notification .= '<li>';
                    $notification .= '<a href="' . base_url('notification/art_post/' . $total['art_post_id']) . '"><div class="notification-database"><div class="notification-pic" >';


                     if($total['user_image']){
                $notification .= '<img src="' . base_url($this->config->item('user_thumb_upload_path') . $total['user_image']) . '" >';
                 }else{
                  $notification .= '<img src="' . base_url(NOIMAGE) . '" >';  
                 }


                    $notification .= '</div>';
                    $notification .= '<div class="notification-data-inside">';
                    $notification .= '<h6><b>' . ucwords($total['first_name']) . ' ' . ucwords($total['last_name']) . "</b> Likes Your Post's Comment In Artistic.</h6>";
                    $notification .= '<div ><i class="fa fa-comment" aria-hidden="true" style="margin-right:8px;"></i>';
                    $notification .= '' . $this->common->time_elapsed_string($total['not_created_date'], $full = false) . '';
                    $notification .= '</div>';
                    $notification .= '</div></div></a>';
                    $notification .= '</li>';
                }
            }
     //   }


      //  foreach ($artimglike as $bus) {
            if ($total['not_from'] == 3) {
                if ($total['not_img'] == 5) {
                    $notification .= '<li>';
                    $notification .= '<a href="' . base_url('notification/art_post_img/' . $total['post_id'] . '/' . $total['image_id']) . '"><div class="notification-database"><div class="notification-pic">';


                     if($total['user_image']){
                $notification .= '<img src="' . base_url($this->config->item('user_thumb_upload_path') . $total['user_image']) . '" >';
                 }else{
                  $notification .= '<img src="' . base_url(NOIMAGE) . '" >';  
                 }


                    $notification .= '</div>';
                    $notification .= '<div class="notification-data-inside">';
                    $notification .= '<h6><b>' . ucwords($total['first_name']) . ' ' . ucwords($total['last_name']) . '</b> Likes Your Photo In Artistic.</h6>';
                    $notification .= '<div ><i class="fa fa-comment" aria-hidden="true" style="margin-right:8px;"></i>';
                    $notification .= '' . $this->common->time_elapsed_string($total['not_created_date'], $full = false) . '';
                    $notification .= '</div></div>';
                    $notification .= '</div></a>';
                    $notification .= '</li>';
                }
            }
      //  }


    //    foreach ($artimgcommnet as $bus) {
            if ($total['not_from'] == 3) {
                if ($total['not_img'] == 4) {
                    $postid = $this->db->get_where('post_image', array('image_id' => $total['post_image_id']))->row()->post_id;
                    $notification .= '<li>';
                    $notification .= '<a href="' . base_url('notification/art_post_img/' . $postid . '/' . $total['post_image_id']) . '"><div class="notification-database"><div class="notification-pic">';
                    

                     if($total['user_image']){
                $notification .= '<img src="' . base_url($this->config->item('user_thumb_upload_path') . $total['user_image']) . '" >';
                 }else{
                  $notification .= '<img src="' . base_url(NOIMAGE) . '" >';  
                 }
                   

                    $notification .= '</div>';
                    $notification .= '<div class="notification-data-inside">';
                    $notification .= '<h6><b>' . ucwords($total['first_name']) . ' ' . ucwords($total['last_name']) . '</b> Commented On Your Photo In Artistic.</h6>';
                    $notification .= '<div ><i class="fa fa-comment" aria-hidden="true" style="margin-right:8px;"></i>';
                    $notification .= '' . $this->common->time_elapsed_string($total['not_created_date'], $full = false) . '';
                    $notification .= '</div> </div>';
                    $notification .= '</div></a>';
                    $notification .= '</li>';
                }
            }
     //   }


      //  foreach ($artimgcmtlike as $bus) {
            if ($total['not_from'] == 3) {
                if ($total['not_img'] == 6) {
                    $postid = $this->db->get_where('post_image', array('image_id' => $total['post_image_id']))->row()->post_id;
                    $notification .= '<li>';
                    $notification .= '<a href="' . base_url('notification/art_post_img/' . $postid . '/' . $total['post_image_id']) . '"><div class="notification-database"><div class="notification-pic" >';
                    

                     if($total['user_image']){
                $notification .= '<img src="' . base_url($this->config->item('user_thumb_upload_path') . $total['user_image']) . '" >';
                 }else{
                  $notification .= '<img src="' . base_url(NOIMAGE) . '" >';  
                 }
                    

                    $notification .= '</div>';
                    $notification .= '<div class="notification-data-inside">';
                    $notification .= '<h6><b>' . ucwords($total['first_name']) . ' ' . ucwords($total['last_name']) . "</b> Likes Your Photo's Comment In Artistic.</h6>";
                    $notification .= '<div ><i class="fa fa-comment" aria-hidden="true" style="margin-right:8px;"></i>';
                    $notification .= '' . $this->common->time_elapsed_string($total['not_created_date'], $full = false) . '';
                    $notification .= '</div></div>';
                    $notification .= '</div></a>';
                    $notification .= '</li>';
                }
            }
   //     }



       // foreach ($buscommnet as $bus) {
            $bus_not_from = $total['not_from'];
            $bus_not_img = $total['not_img'];
           $companyname = $this->db->get_where('business_profile', array('user_id' => $total['not_from_id']))->row()->company_name;
            if ($bus_not_from == '6' && $bus_not_img == '1') {
                $notification .= '<li>';
                $notification .= '<a href="' . base_url('notification/business_post/' . $total['business_profile_post_id']) . '"><div class="notification-database">';
                $notification .= '<div class="notification-pic">';
                

                if($total['user_image']){
                $notification .= '<img src="' . base_url($this->config->item('user_thumb_upload_path') . $total['user_image']) . '" >';
                 }else{
                  $notification .= '<img src="' . base_url(NOIMAGE) . '" >';  
                 }
               

                $notification .= '</div><div class="notification-data-inside">';
                $notification .= '<h6><b>' . '  ' . ucwords($companyname) . '</b> Commented On Your Post In Business Profile.</h6>';
                $notification .= '<div ><i class="fa fa-comment" aria-hidden="true" style="margin-right:8px;"></i>';
                $notification .= '' . $this->common->time_elapsed_string($total['not_created_date'], $full = false) . '';
                $notification .= '</div></div> </div></a> </li>';
            } 

     //   }



      //  foreach ($busifollow as $bus) {
            if ($total['not_from'] == 6 && $total['not_img'] == 0) {
                $busslug = $this->db->get_where('business_profile', array('user_id' => $total['user_id']))->row()->business_slug;
               $companyname = $this->db->get_where('business_profile', array('user_id' => $total['not_from_id']))->row()->company_name;
                $notification .= '<li><a href="' . base_url('business_profile/business_resume/' . $busslug) . '"><div class="notification-database">';
                $notification .= '<div class="notification-pic">';

                if($total['user_image']){
                $notification .= '<img src="' . base_url($this->config->item('user_thumb_upload_path') . $total['user_image']) . '" >';
                 }else{
                  $notification .= '<img src="' . base_url(NOIMAGE) . '" >';  
                 }

                $notification .= '</div><div class="notification-data-inside">';
                $notification .= '<h6><b>' . '  ' . ucwords($companyname) . '</b> Started Following You In Business Profile.</h6>';
                $notification .= '<div ><i class="fa fa-comment" aria-hidden="true" style="margin-right:8px;"></i>';
                $notification .= '' . $this->common->time_elapsed_string($total['not_created_date'], $full = false) . '';
                $notification .= '</div></div> </div></a> </li>';
            }
      //  }



   //     foreach ($buslike as $bus) {
            $bus_not_from = $total['not_from'];
            $bus_not_img = $total['not_img'];
    $companyname = $this->db->get_where('business_profile', array('user_id' => $total['not_from_id']))->row()->company_name;
            if ($bus_not_from == '6' && $bus_not_img == '2') {
                $notification .= '<li><a href="' . base_url('notification/business_post/' . $total['business_profile_post_id']) . '"><div class="notification-database">';
                $notification .= '<div class="notification-pic">';
               

                if($total['user_image']){
                $notification .= '<img src="' . base_url($this->config->item('user_thumb_upload_path') . $total['user_image']) . '" >';
                 }else{
                  $notification .= '<img src="' . base_url(NOIMAGE) . '" >';  
                 }
               

                $notification .= '</div><div class="notification-data-inside">';
                $notification .= '<h6><b>' . '  ' . ucwords($companyname) . '</b> Likes Your Post In Business Profile.</h6>';
                $notification .= '<div ><i class="fa fa-comment" aria-hidden="true" style="margin-right:8px;"></i>';
                $notification .= '' . $this->common->time_elapsed_string($total['not_created_date'], $full = false) . '';
                $notification .= '</div></div> </div> </a></li>';
            }
//             elseif ($bus_not_from == '6' && $bus_not_img == '5') {
//                $notification .= '<li><div class="notification-database">';
//                $notification .= '<div class="notification-pic">';
//                $notification .= '<img src="' . base_url($this->config->item('user_thumb_upload_path') . $total['user_image']) . '" >';
//                $notification .= '</div><div class="notification-data-inside">';
//                $notification .= '<a href="' . base_url('notification/art_post/' . $total['business_profile_post_id']) . '"><h6><b>' . '  ' . ucwords($companyname) . '</b> Likes Your Photo In Business Profile.</h6></a>';
//                $notification .= '<div ><i class="fa fa-comment" aria-hidden="true" style="margin-right:8px;"></i>';
//                $notification .= '' . $this->common->time_elapsed_string($total['not_created_date'], $full = false) . '';
//                $notification .= '</div></div> </div> </li>';
//            }
     //   }


       // foreach ($buscmtlike as $bus) {
            if ($total['not_from'] == 6) {
                if ($total['not_img'] == 3) {
              $companyname = $this->db->get_where('business_profile', array('user_id' => $total['not_from_id']))->row()->company_name;      
                    $notification .= '<li>';
                    $notification .= '<a href="' . base_url('notification/business_post/' . $total['business_profile_post_id']) . '">
                    <div class="notification-database"> <div class="notification-pic" >';
                    

                    if($total['user_image']){
                $notification .= '<img src="' . base_url($this->config->item('user_thumb_upload_path') . $total['user_image']) . '" >';
                 }else{
                  $notification .= '<img src="' . base_url(NOIMAGE) . '" >';  
                 }
                    

                    $notification .= '</div>';
                    $notification .= '<div class="notification-data-inside">';
                    $notification .= '<h6><b>' . ucwords($companyname) . "</b> Likes Your Post's Comment In Business Profile.</h6>";
                    $notification .= '<div ><i class="fa fa-comment" aria-hidden="true" style="margin-right:8px;"></i>';
                    $notification .= '' . $this->common->time_elapsed_string($total['not_created_date'], $full = false) . '';
                    $notification .= '</div> </div>';
                    $notification .= '</div></a>';
                    $notification .= '</li>';
                }
            }
       // }


       // foreach ($busimglike as $bus) {
            if ($total['not_from'] == 6) {
                if ($total['not_img'] == 5) {
     $companyname = $this->db->get_where('business_profile', array('user_id' => $total['not_from_id']))->row()->company_name;                      
                    $notification .= '<li>';
                    $notification .= '<a href="' . base_url('notification/bus_post_img/' . $total['post_id'] . '/' . $total['image_id']) . '"><div class="notification-database"><div class="notification-pic" >';
                    

                     if($total['user_image']){
                $notification .= '<img src="' . base_url($this->config->item('user_thumb_upload_path') . $total['user_image']) . '" >';
                 }else{
                  $notification .= '<img src="' . base_url(NOIMAGE) . '" >';  
                 }
                    

                    $notification .= '</div>';
                    $notification .= '<div class="notification-data-inside">';
                    $notification .= '<h6><b>' . ucwords($companyname) . '</b> Likes Your Photo In Business Profile. </h6>';
                    $notification .= '<div ><i class="fa fa-comment" aria-hidden="true" style="margin-right:8px;"></i>';
                    $notification .= '' . $this->common->time_elapsed_string($total['not_created_date'], $full = false) . '';
                    $notification .= '</div></div';
                    $notification .= '</div></a>';
                    $notification .= '</li>';
                }
            }
       // }

     //   foreach ($busimgcommnet as $bus) {
            if ($total['not_from'] == 6) {
                if ($total['not_img'] == 4) {
                    $companyname = $this->db->get_where('business_profile', array('user_id' => $total['not_from_id']))->row()->company_name;      
                    $postid = $this->db->get_where('post_image', array('image_id' => $total['post_image_id']))->row()->post_id;
                    $notification .= '<li>';
                    $notification .= '<a href="' . base_url('notification/bus_post_img/' . $postid . '/' . $total['post_image_id']) . '"><div class="notification-database"><div class="notification-pic" >';
                   

                     if($total['user_image']){
                $notification .= '<img src="' . base_url($this->config->item('user_thumb_upload_path') . $total['user_image']) . '" >';
                 }else{
                  $notification .= '<img src="' . base_url(NOIMAGE) . '" >';  
                 }
                    

                    $notification .= '</div>';
                    $notification .= '<div class="notification-data-inside">';
                    $notification .= '<h6><b>' . ucwords($companyname) . '</b> Commented On Your Photo In Business Profile.</h6>';
                    $notification .= '<div ><i class="fa fa-comment" aria-hidden="true" style="margin-right:8px;"></i>';
                    $notification .= '' . $this->common->time_elapsed_string($total['not_created_date'], $full = false) . '';
                    $notification .= '</div></div';
                    $notification .= '</div></a>';
                    $notification .= '</li>';
                }
            }
     //   }


    //    foreach ($busimgcmtlike as $bus) {
            if ($total['not_from'] == 6) {
                if ($total['not_img'] == 6) {
                    $companyname = $this->db->get_where('business_profile', array('user_id' => $total['not_from_id']))->row()->company_name;      
                    $postid = $this->db->get_where('post_image', array('image_id' => $total['post_image_id']))->row()->post_id;
                    $notification .= '<li>';
                    $notification .= '<a href="' . base_url('notification/bus_post_img/' . $postid . '/' . $total['post_image_id']) . '"><div class="notification-database"><div class="notification-pic" >';
                    

                     if($total['user_image']){
                $notification .= '<img src="' . base_url($this->config->item('user_thumb_upload_path') . $total['user_image']) . '" >';
                 }else{
                  $notification .= '<img src="' . base_url(NOIMAGE) . '" >';  
                 }
                    

                    $notification .= '</div>';
                    $notification .= '<div class="notification-data-inside">';
                    $notification .= '<h6><b>' . ucwords($companyname) . "</b> Likes Your Photo's Comment In Business Profile.</h6>";
                    $notification .= '<div ><i class="fa fa-comment" aria-hidden="true" style="margin-right:8px;"></i>';
                    $notification .= '' . $this->common->time_elapsed_string($total['not_created_date'], $full = false) . '';
                    $notification .= '</div> </div>';
                    $notification .= '</div></a>';
                    $notification .= '</li>';
                }
            }
      //  }



       // foreach ($rec_not as $art) {
            if ($total['not_from'] == 2) {

                $notification .= '<li><a href="' . base_url('job/job_printpreview/' . $total['not_from_id'].'?page=recruiter') . '"><div class="notification-database">';
                $notification .= '<div class="notification-pic">';
               

                 if($total['user_image']){
                $notification .= '<img src="' . base_url($this->config->item('user_thumb_upload_path') . $total['user_image']) . '" >';
                 }else{
                  $notification .= '<img src="' . base_url(NOIMAGE) . '" >';  
                 }
                

                $notification .= '</div><div class="notification-data-inside">';
                $notification .= '<h6><font color="black"><b><i> Job seeker</i></font></b><b>' . '  ' . ucwords($total['first_name']) . ' ' . ucwords($total['last_name']) . '</b> Applied on your jobpost.</h6>';
                $notification .= '<div ><i class="fa fa-comment" aria-hidden="true" style="margin-right:8px;"></i>';
                $notification .= '' . $this->common->time_elapsed_string($total['not_created_date'], $full = false) . '';
                $notification .= '</div></div> </div></a> </li>';
            }
     //   }

     //   foreach ($hire_not as $art) {
            if ($total['not_from'] == 4) {

                $notification .= '<li><a href="' . base_url('freelancer/freelancer_post_profile/' . $total['not_from_id'].'?page=freelancer_hire') . '"><div class="notification-database">';
                $notification .= '<div class="notification-pic">';
                

                 if($total['user_image']){
                $notification .= '<img src="' . base_url($this->config->item('user_thumb_upload_path') . $total['user_image']) . '" >';
                 }else{
                  $notification .= '<img src="' . base_url(NOIMAGE) . '" >';  
                 }
                

                $notification .= '</div><div class="notification-data-inside">';
                $notification .= '<h6><font color="black"><b><i>Freelancer</i></font></b><b>' . '  ' . ucwords($total['first_name']) . ' ' . ucwords($total['last_name']) . '</b> Applied on your post.</h6>';
                $notification .= '<div ><i class="fa fa-comment" aria-hidden="true" style="margin-right:8px;"></i>';
                $notification .= '' . $this->common->time_elapsed_string($total['not_created_date'], $full = false) . '';
                $notification .= '</div></div> </div></a> </li>';
            }
     //   }


        //foreach ($work_not as $art) {
            if ($total['not_from'] == 5) {

                $notification .= '<li><a href="' . base_url('notification/freelancer_hire_post/' . $total['post_id'].'?page=freelancer_post') . '"><div class="notification-database">';
                $notification .= '<div class="notification-pic">';
               

                 if($total['user_image']){
                $notification .= '<img src="' . base_url($this->config->item('user_thumb_upload_path') . $total['user_image']) . '" >';
                 }else{
                  $notification .= '<img src="' . base_url(NOIMAGE) . '" >';  
                 }
               

                $notification .= '</div><div class="notification-data-inside">';
                $notification .= '<h6><font color="black"><b><i>Employer</i></font></b><b>' . '  ' . ucwords($total['first_name']) . ' ' . ucwords($total['last_name']) . '</b> Selected You For Project.</h6>';
                $notification .= '<div ><i class="fa fa-comment" aria-hidden="true" style="margin-right:8px;"></i>';
                $notification .= '' . $this->common->time_elapsed_string($total['not_created_date'], $full = false) . '';
                $notification .= '</div></div> </div> </a></li>';
            }
     //   }


   //     foreach ($work_post as $work) {

//            if ($total['not_from'] == 4) {
//
//                $notification .= '<li><div class="notification-database">';
//                $notification .= '<div class="notification-pic">';
//                $notification .= '<img src="' . base_url($this->config->item('user_thumb_upload_path') . $total['user_image']) . '" >';
//                $notification .= '</div><div class="notification-data-inside">';
//                $notification .= '<a href="' . base_url('notification/freelancer_hire_post/' . $total['post_id']) . '"><h6><font color="#4e6db1"><b><i> Employer </i></font></b><b>' . '  ' . ucwords($total['first_name']) . ' ' . ucwords($total['last_name']) . '</b> Selected You For Project.</h6></a>';
//                $notification .= '<div><i class="fa fa-comment" aria-hidden="true" style="margin-right:8px;"></i>';
//                $notification .= '' . $this->common->time_elapsed_string($total['not_created_date'], $full = false) . '';
//                $notification .= '</div></div> </div> </li>';
//            }
            
          $i++;
          if($i == 10){
           break;
            }
        }
        $notification .= '</div>';

        $notification .= '<div id="notificationFooter">';
        $notification .= '<a href="' . base_url('notification') . '">See All</a></div>';

        echo $notification;
    }

    public function msg_header($id = "") {


        // khyati 22-5 chnages start
            if($id == " "){  
        $this->data['userid'] = $userid = $this->session->userdata('aileenuser');

        $loginuser = $this->common->select_data_by_id('user', 'user_id', $userid, $data = 'first_name,last_name');

        $this->data['logfname'] = $loginuser[0]['first_name'];
        $this->data['loglname'] = $loginuser[0]['last_name'];

        // last message user fetch

        $contition_array = array('id !=' => '');

        $search_condition = "(message_from = '$userid' OR message_to = '$userid')";

        $lastuser = $this->common->select_data_by_search('messages', $search_condition, $contition_array, $data = 'messages.message_from,message_to,id', $sortby = 'id', $orderby = 'DESC', $limit = '1', $offset = '', $join_str = '', $groupby = '');

        if ($lastuser[0]['message_from'] == $userid) {

            $lstusr = $this->data['lstusr'] = $lastuser[0]['message_to'];
        } else {

            $lstusr = $this->data['lstusr'] = $lastuser[0]['message_from'];
        }


        if ($lstusr) {
            $lastuser = $this->common->select_data_by_id('user', 'user_id', $lstusr, $data = 'first_name,last_name');

            $this->data['lstfname'] = $lastuser[0]['first_name'];
            $this->data['lstlname'] = $lastuser[0]['last_name'];
        }

        $contition_array = array('is_delete' => '0', 'status' => '1');

        $join_str1[0]['table'] = 'messages';
        $join_str1[0]['join_table_id'] = 'messages.message_to';
        $join_str1[0]['from_table_id'] = 'user.user_id';
        $join_str1[0]['join_type'] = '';

        $search_condition = "((message_from = '$lstusr' OR message_to = '$lstusr') && (message_to != '$userid'))";

        $seltousr = $this->common->select_data_by_search('user', $search_condition, $contition_array, $data = 'messages.id,message_to,first_name,user_image,message', $sortby = 'messages.id', $orderby = 'DESC', $limit = '', $offset = '', $join_str1, $groupby = '');


        // slected user chat from


        $contition_array = array('is_delete' => '0', 'status' => '1');

        $join_str2[0]['table'] = 'messages';
        $join_str2[0]['join_table_id'] = 'messages.message_from';
        $join_str2[0]['from_table_id'] = 'user.user_id';
        $join_str2[0]['join_type'] = '';



        $search_condition = "((message_from = '$lstusr' OR message_to = '$lstusr') && (message_from != '$userid'))";

        $selfromusr = $this->common->select_data_by_search('user', $search_condition, $contition_array, $data = 'messages.id,message_from,first_name,user_image,message', $sortby = 'messages.id', $orderby = 'DESC', $limit = '', $offset = '', $join_str2, $groupby = '');


        $selectuser = array_merge($seltousr, $selfromusr);
        $selectuser = $this->aasort($selectuser, "id");


// replace name of message_to in user_id in select user


        $return_arraysel = array();
        $i = 0;
        foreach ($selectuser as $k => $sel_list) {
            $return = array();
            $return = $sel_list;

            if ($sel_list['message_to']) {

                $return['user_id'] = $sel_list['message_to'];
                $return['first_name'] = $sel_list['first_name'];
                $return['user_image'] = $sel_list['user_image'];
                $return['message'] = $sel_list['message'];

                unset($return['message_to']);
            } else {

                $return['user_id'] = $sel_list['message_from'];
                $return['first_name'] = $sel_list['first_name'];
                $return['user_image'] = $sel_list['user_image'];
                $return['message'] = $sel_list['message'];


                unset($return['message_from']);
            }
            array_push($return_arraysel, $return);
            $i++;
            if ($i == 1)
                break;
        }


        // khyati 24-4 end 
        // message to user

        $contition_array = array('is_delete' => '0', 'status' => '1', 'message_to !=' => $userid);

        $join_str3[0]['table'] = 'messages';
        $join_str3[0]['join_table_id'] = 'messages.message_to';
        $join_str3[0]['from_table_id'] = 'user.user_id';
        $join_str3[0]['join_type'] = '';

        $search_condition = "((message_from = '$userid') && (message_to != '$lstusr'))";

        $tolist = $this->common->select_data_by_search('user', $search_condition, $contition_array, $data = 'messages.id,message_to,first_name,user_image,message', $sortby = 'messages.id', $orderby = 'DESC', $limit = '', $offset = '', $join_str3, $groupby = '');



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
            if ($to_list['message_to'] != $lstusr) {
                $return = array();
                $return = $to_list;

                $return['user_id'] = $to_list['message_to'];
                $return['first_name'] = $to_list['first_name'];
                $return['user_image'] = $to_list['user_image'];
                $return['message'] = $to_list['message'];

                unset($return['message_to']);
                array_push($return_arrayto, $return);
            }
        }

        // message from user
        $contition_array = array('is_delete' => '0', 'status' => '1', 'message_from !=' => $userid);

        $join_str4[0]['table'] = 'messages';
        $join_str4[0]['join_table_id'] = 'messages.message_from';
        $join_str4[0]['from_table_id'] = 'user.user_id';
        $join_str4[0]['join_type'] = '';

        $search_condition = "((message_to = '$userid') && (message_from != '$lstusr'))";


        $fromlist = $this->common->select_data_by_search('user', $search_condition, $contition_array, $data = 'messages.id,messages.message_from,first_name,user_image,message', $sortby = 'messages.id', $orderby = 'DESC', $limit = '', $offset = '', $join_str4, $groupby = '');


        // uniq array of fromlist  
        foreach ($fromlist as $k => $v) {
            foreach ($fromlist as $key => $value) {
                if ($k != $key && $v['message_from'] == $value['message_from']) {
                    unset($fromlist[$k]);
                }
            }
        }

// replace name of message_to in user_id

        $return_arrayfrom = array();

        foreach ($fromlist as $from_list) {
            if ($to_list['message_from'] != $lstusr) {
                $return = array();
                $return = $from_list;

                $return['user_id'] = $from_list['message_from'];
                $return['first_name'] = $from_list['first_name'];
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
                    unset($userlist[$k]);
                }
            }
        }

        $userlist = $this->aasort($userlist, "id");

        $user_message = array_merge($return_arraysel, $userlist);

}else{
    // 30-6 chnages start
      
      // khyati 25-4 changes start
$this->data['userid'] = $userid = $this->session->userdata('aileenuser');
   
   // last user if $id is null

    $contition_array = array('id !=' => '');

    $search_condition = "(message_from = '$userid' OR message_to = '$userid')";

    $lastchat = $this->common->select_data_by_search('messages', $search_condition,$contition_array, $data = 'messages.message_from,message_to,id', $sortby = 'id', $orderby = 'DESC', $limit = '1', $offset = '', $join_str = '', $groupby = '');
      
  if($id){     
  
  $toid =  $this->data['toid'] = $id;
  
  }elseif($lastchat[0]['message_from'] == $userid){
     
  $toid =    $this->data['toid'] = $lastchat[0]['message_to'];
  }else{
    
  $toid =  $this->data['toid'] = $lastchat[0]['message_from'];
    }

   // khyati 22-4 changes end

    $loginuser = $this->common->select_data_by_id('user', 'user_id', $userid, $data = 'first_name,last_name');
    
    $this->data['logfname'] = $loginuser[0]['first_name'];
    $this->data['loglname'] = $loginuser[0]['last_name'];
   
    // last message user fetch
    
    $contition_array = array('id !=' => '');

    $search_condition = "(message_from = '$id' OR message_to = '$id')";

    $lastuser = $this->common->select_data_by_search('messages', $search_condition,$contition_array, $data = 'messages.message_from,message_to,id', $sortby = 'id', $orderby = 'DESC', $limit = '1', $offset = '', $join_str = '', $groupby = '');
    
    if($lastuser[0]['message_from'] == $userid){
     
  $lstusr =    $this->data['lstusr'] = $lastuser[0]['message_to'];
    }else{
    
  $lstusr =  $this->data['lstusr'] = $lastuser[0]['message_from'];
    }

// last user first name last name
    if($lstusr){
    $lastuser = $this->common->select_data_by_id('user', 'user_id', $lstusr, $data = 'first_name,last_name');
    
    $this->data['lstfname'] = $lastuser[0]['first_name'];
    $this->data['lstlname'] = $lastuser[0]['last_name'];
    }
    //khyati changes starrt 20-4
    
    // slected user chat to

    
     $contition_array = array('is_delete' => '0' , 'status' => '1');

     $join_str1[0]['table'] = 'messages';
     $join_str1[0]['join_table_id'] = 'messages.message_to';
     $join_str1[0]['from_table_id'] = 'user.user_id';
     $join_str1[0]['join_type'] = '';

     
     
    $search_condition = "((message_from = '$id' OR message_to = '$id') && (message_to != '$userid'))";

     $seltousr = $this->common->select_data_by_search('user', $search_condition,$contition_array, $data = 'messages.id,message_to,first_name,user_image,message', $sortby = 'messages.id', $orderby = 'DESC', $limit = '', $offset = '', $join_str1, $groupby = '');


     // slected user chat from

    
     $contition_array = array('is_delete' => '0' , 'status' => '1');

     $join_str2[0]['table'] = 'messages';
     $join_str2[0]['join_table_id'] = 'messages.message_from';
     $join_str2[0]['from_table_id'] = 'user.user_id';
     $join_str2[0]['join_type'] = '';

     
     
    $search_condition = "((message_from = '$id' OR message_to = '$id') && (message_from != '$userid'))";

     $selfromusr = $this->common->select_data_by_search('user', $search_condition,$contition_array, $data = 'messages.id,message_from,first_name,user_image,message', $sortby = 'messages.id', $orderby = 'DESC', $limit = '', $offset = '', $join_str2, $groupby = '');


$selectuser = array_merge($seltousr,$selfromusr);
$selectuser =  $this->aasort($selectuser,"id");


// replace name of message_to in user_id in select user

   $return_arraysel = array();
$i=0;
    foreach($selectuser as $k => $sel_list){
        $return = array();
       $return = $sel_list;

if($sel_list['message_to']){ 
     
       $return['user_id'] = $sel_list['message_to'];
       $return['first_name'] = $sel_list['first_name'];
       $return['user_image'] = $sel_list['user_image'];
       $return['message'] = $sel_list['message'];
      
       unset($return['message_to']);
      
}else{ 

       $return['user_id'] = $sel_list['message_from'];
       $return['first_name'] = $sel_list['first_name'];
       $return['user_image'] = $sel_list['user_image'];
       $return['message'] = $sel_list['message'];

      
       unset($return['message_from']);
      }
array_push($return_arraysel, $return);
$i++;
if($i==1) break;
    } 

     // message to user
     $contition_array = array('is_delete' => '0' , 'status' => '1','message_to !=' => $userid);

     $join_str3[0]['table'] = 'messages';
     $join_str3[0]['join_table_id'] = 'messages.message_to';
     $join_str3[0]['from_table_id'] = 'user.user_id';
     $join_str3[0]['join_type'] = '';
     
$search_condition = "((message_from = '$userid') && (message_to != '$id'))";

     $tolist = $this->common->select_data_by_search('user',$search_condition,$contition_array, $data = 'messages.id,message_to,first_name,user_image,message', $sortby = 'messages.id', $orderby = 'DESC', $limit = '', $offset = '', $join_str3, $groupby = '');

     // uniq array of tolist  
      foreach($tolist as $k => $v) 
{ 
    foreach($tolist as $key => $value) 
    { 
      
        if($k != $key && $v['message_to'] == $value['message_to'])
        {
             unset($tolist[$k]);
        }
    }
}

 // replace name of message_to in user_id

   $return_arrayto = array();

    foreach($tolist as $to_list){
if($to_list['message_to'] != $id){
      $return = array();
      $return = $to_list;

      $return['user_id'] = $to_list['message_to'];
      $return['first_name'] = $to_list['first_name'];
      $return['user_image'] = $to_list['user_image'];
       $return['message'] = $to_list['message'];

      
      unset($return['message_to']);
     array_push($return_arrayto, $return);
}
    } 

    // message from user
    $contition_array = array('is_delete' => '0' , 'status' => '1','message_from !=' => $userid);

    $join_str4[0]['table'] = 'messages';
    $join_str4[0]['join_table_id'] = 'messages.message_from';
    $join_str4[0]['from_table_id'] = 'user.user_id';
    $join_str4[0]['join_type'] = '';
     
   $search_condition = "((message_to = '$userid') && (message_from != '$id'))";

    $fromlist = $this->common->select_data_by_search('user',$search_condition,$contition_array, $data = 'messages.id,messages.message_from,first_name,user_image,message', $sortby = 'messages.id', $orderby = 'DESC', $limit = '', $offset = '', $join_str4, $groupby = '');
    

  // uniq array of fromlist  
      foreach($fromlist as $k => $v) 
{  
    foreach($fromlist as $key => $value) 
   { 
         if($k != $key && $v['message_from'] == $value['message_from'] )
         { 
              unset($fromlist[$k]);
         }

       }
}

// replace name of message_to in user_id

   $return_arrayfrom = array();

    foreach($fromlist as $from_list){
if($from_list['message_from'] != $id){
      $return = array();
      $return = $from_list;

      $return['user_id'] = $from_list['message_from'];
      $return['first_name'] = $from_list['first_name'];
      $return['user_image'] = $from_list['user_image'];
       $return['message'] = $from_list['message'];

      
      unset($return['message_from']);
     array_push($return_arrayfrom, $return);
}
    } 

   

 $userlist = array_merge($return_arrayto,$return_arrayfrom);
 

   // uniq array of fromlist  
foreach($userlist as $k => $v) 
{
    foreach($userlist as $key => $value) 
    {
        if($k != $key && $v['user_id'] == $value['user_id'])
        {
             unset($userlist[$k]);
        }
    }
}


$userlist =  $this->aasort($userlist,"id");

$user_message = array_merge($return_arraysel,$userlist);

    // 30-6 chnages end

}
        // khyati 22-5 chnages end

           $notmsg = '<div id="notificationTitle">Messages</div>';
        foreach ($user_message as $msg) {
        
      $contition_array = array('not_product_id' => $msg['id']);
            $data = array(' notification.*');
            $not = $this->common->select_data_by_condition('notification', $contition_array, $data, $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = "", $groupby = '');
//            echo '<pre>';
//            print_r($not);
//            exit;
            $notmsg .= '<a href="' . base_url('chat/abc/' . $msg['user_id']) . '" class="clearfix msg_dot">';
            $notmsg .= '<li class="';
            if($not[0]['not_active'] == 1){
            $notmsg .= 'active2';
            }
           $notmsg .= '"><div class="notification-database">';
            $notmsg .= '<div class="notification-pic">';

            if($msg['user_image']){
            $notmsg .= '<img src="' . base_url($this->config->item('user_thumb_upload_path') . $msg['user_image']) . '">';
              }else{
                $notmsg .= '<img src="' . base_url(NOIMAGE) . '" >'; 
              }

            $notmsg .= '</div><div class="notification-data-inside">';
            $notmsg .= '<h6>' . ucwords($msg['first_name']) . ' ' . ucwords($msg['last_name']) . '</h6>';
            $notmsg .= '<div class="msg_desc_a">';

           
            $notmsg .= '' . $msg['message'] . '';

            //$notmsg .= '</div><div class="data_noti_msg">' . $this->common->time_elapsed_string($not[0]['not_created_date'], $full = false) . '</div>';
            echo $not[0]['not_created_date'];
            
            $notmsg .= '</div><div class="data_noti_msg">' . $this->common->time_elapsed_string(date('Y-m-d H:i:s', strtotime($not[0]['not_created_date']))) . '</div>';
            $notmsg .= '</div></div></li></a>';
        }
        $notmsg .= '</ul></div>';
        if($user_message){
        $notmsg .= '<div id="InboxFooter"><a href="' . base_url('chat') . '">See All</a></div>';
        }else{
        $notmsg .= '<div id="InboxFooter"><a>No Messages</a></div>';
            
        }
        echo $notmsg;
    }

    // khyati changes start 7-4
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
        $contition_array = array('notification.not_type' => 5, 'notification.not_from' => 3,'not_img' => 2, 'notification.not_to_id' => $userid, 'created_date BETWEEN DATE_SUB(NOW(), INTERVAL 2 MONTH) AND NOW()');
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
        
        $contition_array = array('notification.not_type' => 5, 'not_img' => 5,'notification.not_from' => 3, 'notification.not_to_id' => $userid, 'created_date BETWEEN DATE_SUB(NOW(), INTERVAL 2 MONTH) AND NOW()');
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
        

        $contition_array = array('notification.not_type' => 5, 'not_img' => 3 ,'notification.not_from' => 3, 'notification.not_to_id' => $userid, 'created_date BETWEEN DATE_SUB(NOW(), INTERVAL 2 MONTH) AND NOW()');
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

        $contition_array = array('notification.not_type' => 6, 'not_img' => 4,'notification.not_from' => 3, 'notification.not_to_id' => $userid, 'created_date BETWEEN DATE_SUB(NOW(), INTERVAL 2 MONTH) AND NOW()');
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
        $contition_array = array('notification.not_type' => 5, 'not_img' => 2 , 'notification.not_from' => 6, 'notification.not_to_id' => $userid, 'created_date BETWEEN DATE_SUB(NOW(), INTERVAL 2 MONTH) AND NOW()');
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

        $this->data['totalnotifi'] = $totalnotifi = array_merge($rec_not, $job_not, $hire_not, $work_post,$artcommnet, $artlike, $artcmtlike, $artimglike, $artimgcommnet,$artfollow, $artimgcmtlike, $busimgcommnet, $busifollow, $buscommnet, $buslike, $buscmtlike, $busimgcmtlike, $busimglike);
       $this->data['totalnotification'] = $totalnotification = $this->aasort($totalnotifi, "not_id");
       
     
    }
    
    
}
