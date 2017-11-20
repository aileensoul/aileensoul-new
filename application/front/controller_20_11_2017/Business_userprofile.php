<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Business_userprofile extends CI_Controller {

    public $data;

    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->library('user_agent');
        $this->load->model('email_model');
        $this->lang->load('message', 'english');
        $this->load->helper('smiley');
        //AWS access info start
        $this->load->library('S3');
        //AWS access info end

        $userid = $this->session->userdata('aileenuser');
        include ('business_profile_include.php');

        // FIX BUSINESS PROFILE NO POST DATA

        $this->data['no_business_post_html'] = '<div class="art_no_post_avl"><h3>Business Post</h3><div class="art-img-nn"><div class="art_no_post_img"><img src=' . base_url('assets/img/bui-no.png') . '></div><div class="art_no_post_text">No Post Available.</div></div></div>';
        $this->data['no_business_contact_html'] = '<div class="art-img-nn"><div class="art_no_post_img"><img src="' . base_url('assets/img/No_Contact_Request.png') . '"></div><div class="art_no_post_text">No Contacts Available.</div></div>';
    }

    public function index() {

        $userid = $this->session->userdata('aileenuser');

        $contition_array = array('user_id' => $userid, 'status' => '0');
        $businessdata = $this->common->select_data_by_condition('business_profile', $contition_array, $data = 'business_profile_id', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
        if ($businessdata) {
            $this->load->view('business_profile/reactivate', $this->data);
        } else {
            $userid = $this->session->userdata('aileenuser');
// GET BUSINESS PROFILE DATA
            $contition_array = array('user_id' => $userid, 'is_deleted' => '0', 'status' => '1');
            $userdata = $this->common->select_data_by_condition('business_profile', $contition_array, $data = 'business_step', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

// GET COUNTRY DATA
            $contition_array = array('status' => 1);
            $this->data['countries'] = $this->common->select_data_by_condition('countries', $contition_array, $data = 'country_id,country_name', $sortby = 'country_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');

// GET STATE DATA
            $contition_array = array('status' => 1);
            $this->data['states'] = $this->common->select_data_by_condition('states', $contition_array, $data = 'state_id,state_name,country_id', $sortby = 'state_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');

// GET CITY DATA
            $contition_array = array('status' => 1);
            $this->data['cities'] = $this->common->select_data_by_condition('cities', $contition_array, $data = 'city_id,city_name,state_id', $sortby = 'city_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');

            if (count($userdata) > 0) {

                if ($userdata[0]['business_step'] == 1) {
                    redirect('business-profile/contact-information', refresh);
                } else if ($userdata[0]['business_step'] == 2) {
                    redirect('business-profile/description', refresh);
                } else if ($userdata[0]['business_step'] == 3) {
                    redirect('business-profile/image', refresh);
                } else if ($userdata[0]['business_step'] == 4) {
//redirect('business_profile/addmore', refresh);
                    redirect('business-profile/home', refresh);
                } else if ($userdata[0]['business_step'] == 5) {
                    redirect('business-profile/home', refresh);
                }
            } else {
                $this->load->view('business_profile/business_info', $this->data);
            }
        }
    }

    public function bus_user_photos() {

        $id = $_POST['bus_slug'];

        $contition_array = array('business_slug' => $id, 'status' => '1', 'business_step' => 4);
        $businessdata1 = $this->data['businessdata1'] = $this->common->select_data_by_condition('business_profile', $contition_array, $data = 'user_id', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        $join_str[0]['table'] = 'post_files';
        $join_str[0]['join_table_id'] = 'post_files.post_id';
        $join_str[0]['from_table_id'] = 'business_profile_post.business_profile_post_id';
        $join_str[0]['join_type'] = '';

        $contition_array = array('user_id' => $businessdata1[0]['user_id'], 'business_profile_post.is_delete' => 0, 'post_files.insert_profile' => '2', 'post_format' => 'image');
        $businessimage = $this->data['businessimage'] = $this->common->select_data_by_condition('business_profile_post', $contition_array, $data = 'file_name', $sortby = 'post_files.created_date', $orderby = 'desc', $limit = '6', $offset = '', $join_str, $groupby = '');

        if ($businessimage) {
            $i = 0;
            foreach ($businessimage as $mi) {
                $fetch_result .= '<div class="image_profile">';
                $fetch_result .= '<img src="' . BUS_POST_RESIZE3_UPLOAD_URL . $mi['file_name'] . '" alt="' . $mi['file_name'] . '">';
                $fetch_result .= '</div>';

                $i++;
                if ($i == 6)
                    break;
            }
        } else {

            $fetch_result .= '<div class="not_available">  <p>     Photos Not Available </p></div>';
        }

        $fetch_result .= '<div class="dataconphoto"></div>';

        echo $fetch_result;
    }

    public function bus_user_videos() {

        $s3 = new S3(awsAccessKey, awsSecretKey);
        $id = $_POST['bus_slug'];
// manage post start
        $userid = $this->session->userdata('aileenuser');
        $user_name = $this->session->userdata('user_name');

        $contition_array = array('user_id' => $userid, 'status' => '1');
        $slug_data = $this->common->select_data_by_condition('business_profile', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        $slug_id = $slug_data[0]['business_slug'];

        if ($id == $slug_id || $id == '') {

            $contition_array = array('business_slug' => $slug_id, 'status' => '1');
            $businessdata1 = $this->data['businessdata1'] = $this->common->select_data_by_condition('business_profile', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
        } else {

            $contition_array = array('business_slug' => $id, 'status' => '1', 'business_step' => 4);
            $businessdata1 = $this->data['businessdata1'] = $this->common->select_data_by_condition('business_profile', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
        }

        $join_str[0]['table'] = 'post_files';
        $join_str[0]['join_table_id'] = 'post_files.post_id';
        $join_str[0]['from_table_id'] = 'business_profile_post.business_profile_post_id';
        $join_str[0]['join_type'] = '';

        $contition_array = array('user_id' => $businessdata1[0]['user_id'], 'business_profile_post.is_delete' => 0, 'post_files.insert_profile' => '2', 'post_format' => 'video');
        $businessvideo = $this->data['businessvideo'] = $this->common->select_data_by_condition('business_profile_post', $contition_array, $data = 'file_name', $sortby = 'post_files.created_date', $orderby = 'desc', $limit = '6', $offset = '', $join_str, $groupby = '');

        if ($businessvideo) {
            $fetch_video .= '<tr>';

            if ($businessvideo[0]['file_name']) {

                $post_poster = $businessvideo[0]['file_name'];
                $post_poster1 = explode('.', $post_poster);
                $post_poster2 = end($post_poster1);
                $post_poster = str_replace($post_poster2, 'png', $post_poster);

                if (IMAGEPATHFROM == 'upload') {
                    $fetch_video .= '<td class = "image_profile">';
                    if (file_exists($this->config->item('bus_post_main_upload_path') . $post_poster)) {
                        $fetch_video .= '<video controls poster="' . BUS_POST_MAIN_UPLOAD_URL . $post_poster . '">';
                    } else {
                        $fetch_video .= '<video controls>';
                    }
                    $fetch_video .= '<source src = "' . BUS_POST_MAIN_UPLOAD_URL . $businessvideo[0]['file_name'] . '" type = "video/mp4">';
                    //$fetch_video .= '<source src = "movie.ogg" type = "video/ogg">';
                    $fetch_video .= 'Your browser does not support the video tag.';
                    $fetch_video .= '</video>';
                    $fetch_video .= '</td>';
                } else {
                    $fetch_video .= '<td class = "image_profile">';

                    $filename = $this->config->item('bus_profile_thumb_upload_path') . $posted_business_user_image;
                    $this->data['info'] = $info = $s3->getObjectInfo(bucket, $filename);
                    if ($info) {
                        $fetch_video .= '<video controls poster="' . BUS_POST_MAIN_UPLOAD_URL . $post_poster . '">';
                    } else {
                        $fetch_video .= '<video controls>';
                    }
                    $fetch_video .= '<source src = "' . BUS_POST_MAIN_UPLOAD_URL . $businessvideo[0]['file_name'] . '" type = "video/mp4">';
                    //$fetch_video .= '<source src = "movie.ogg" type = "video/ogg">';
                    $fetch_video .= 'Your browser does not support the video tag.';
                    $fetch_video .= '</video>';
                    $fetch_video .= '</td>';
                }
            }

            if ($businessvideo[1]['file_name']) {
                $post_poster = $businessvideo[1]['file_name'];
                $post_poster1 = explode('.', $post_poster);
                $post_poster2 = end($post_poster1);
                $post_poster = str_replace($post_poster2, 'png', $post_poster);

                if (IMAGEPATHFROM == 'upload') {
                    $fetch_video .= '<td class = "image_profile">';
                    if (file_exists($this->config->item('bus_profile_thumb_upload_path') . $post_poster)) {
                        $fetch_video .= '<video controls poster="' . BUS_POST_MAIN_UPLOAD_URL . $post_poster . '">';
                    } else {
                        $fetch_video .= '<video controls>';
                    }
                    $fetch_video .= '<source src = "' . BUS_POST_MAIN_UPLOAD_URL . $businessvideo[1]['file_name'] . '" type = "video/mp4">';
                    //$fetch_video .= '<source src = "movie.ogg" type = "video/ogg">';
                    $fetch_video .= 'Your browser does not support the video tag.';
                    $fetch_video .= '</video>';
                    $fetch_video .= '</td>';
                } else {
                    $fetch_video .= '<td class = "image_profile">';

                    $filename = $this->config->item('bus_profile_thumb_upload_path') . $posted_business_user_image;
                    $this->data['info'] = $info = $s3->getObjectInfo(bucket, $filename);
                    if ($info) {
                        $fetch_video .= '<video controls poster="' . BUS_POST_MAIN_UPLOAD_URL . $post_poster . '">';
                    } else {
                        $fetch_video .= '<video controls>';
                    }
                    $fetch_video .= '<source src = "' . BUS_POST_MAIN_UPLOAD_URL . $businessvideo[1]['file_name'] . '" type = "video/mp4">';
                    //$fetch_video .= '<source src = "movie.ogg" type = "video/ogg">';
                    $fetch_video .= 'Your browser does not support the video tag.';
                    $fetch_video .= '</video>';
                    $fetch_video .= '</td>';
                }
            }
            if ($businessvideo[2]['file_name']) {

                $post_poster = $businessvideo[2]['file_name'];
                $post_poster1 = explode('.', $post_poster);
                $post_poster2 = end($post_poster1);
                $post_poster = str_replace($post_poster2, 'png', $post_poster);

                if (IMAGEPATHFROM == 'upload') {
                    $fetch_video .= '<td class = "image_profile">';
                    if (file_exists($this->config->item('bus_profile_thumb_upload_path') . $post_poster)) {
                        $fetch_video .= '<video controls poster="' . BUS_POST_MAIN_UPLOAD_URL . $post_poster . '">';
                    } else {
                        $fetch_video .= '<video controls>';
                    }
                    $fetch_video .= '<source src = "' . BUS_POST_MAIN_UPLOAD_URL . $businessvideo[2]['file_name'] . '" type = "video/mp4">';
                    //$fetch_video .= '<source src = "movie.ogg" type = "video/ogg">';
                    $fetch_video .= 'Your browser does not support the video tag.';
                    $fetch_video .= '</video>';
                    $fetch_video .= '</td>';
                } else {
                    $fetch_video .= '<td class = "image_profile">';

                    $filename = $this->config->item('bus_profile_thumb_upload_path') . $posted_business_user_image;
                    $this->data['info'] = $info = $s3->getObjectInfo(bucket, $filename);
                    if ($info) {
                        $fetch_video .= '<video controls poster="' . BUS_POST_MAIN_UPLOAD_URL . $post_poster . '">';
                    } else {
                        $fetch_video .= '<video controls>';
                    }
                    $fetch_video .= '<source src = "' . BUS_POST_MAIN_UPLOAD_URL . $businessvideo[2]['file_name'] . '" type = "video/mp4">';
                    //$fetch_video .= '<source src = "movie.ogg" type = "video/ogg">';
                    $fetch_video .= 'Your browser does not support the video tag.';
                    $fetch_video .= '</video>';
                    $fetch_video .= '</td>';
                }
            }
            $fetch_video .= '</tr>';
            $fetch_video .= '<tr>';

            if ($businessvideo[3]['file_name']) {

                $post_poster = $businessvideo[3]['file_name'];
                $post_poster1 = explode('.', $post_poster);
                $post_poster2 = end($post_poster1);
                $post_poster = str_replace($post_poster2, 'png', $post_poster);

                if (IMAGEPATHFROM == 'upload') {
                    $fetch_video .= '<td class = "image_profile">';
                    if (file_exists($this->config->item('bus_profile_thumb_upload_path') . $post_poster)) {
                        $fetch_video .= '<video controls poster="' . BUS_POST_MAIN_UPLOAD_URL . $post_poster . '">';
                    } else {
                        $fetch_video .= '<video controls>';
                    }
                    $fetch_video .= '<source src = "' . BUS_POST_MAIN_UPLOAD_URL . $businessvideo[3]['file_name'] . '" type = "video/mp4">';
                    //$fetch_video .= '<source src = "movie.ogg" type = "video/ogg">';
                    $fetch_video .= 'Your browser does not support the video tag.';
                    $fetch_video .= '</video>';
                    $fetch_video .= '</td>';
                } else {
                    $fetch_video .= '<td class = "image_profile">';

                    $filename = $this->config->item('bus_profile_thumb_upload_path') . $posted_business_user_image;
                    $this->data['info'] = $info = $s3->getObjectInfo(bucket, $filename);
                    if ($info) {
                        $fetch_video .= '<video controls poster="' . BUS_POST_MAIN_UPLOAD_URL . $post_poster . '">';
                    } else {
                        $fetch_video .= '<video controls>';
                    }
                    $fetch_video .= '<source src = "' . BUS_POST_MAIN_UPLOAD_URL . $businessvideo[3]['file_name'] . '" type = "video/mp4">';
                    //$fetch_video .= '<source src = "movie.ogg" type = "video/ogg">';
                    $fetch_video .= 'Your browser does not support the video tag.';
                    $fetch_video .= '</video>';
                    $fetch_video .= '</td>';
                }
            }
            if ($businessvideo[4]['file_name']) {

                $post_poster = $businessvideo[4]['file_name'];
                $post_poster1 = explode('.', $post_poster);
                $post_poster2 = end($post_poster1);
                $post_poster = str_replace($post_poster2, 'png', $post_poster);

                if (IMAGEPATHFROM == 'upload') {
                    $fetch_video .= '<td class = "image_profile">';
                    if (file_exists($this->config->item('bus_profile_thumb_upload_path') . $post_poster)) {
                        $fetch_video .= '<video controls poster="' . BUS_POST_MAIN_UPLOAD_URL . $post_poster . '">';
                    } else {
                        $fetch_video .= '<video controls>';
                    }
                    $fetch_video .= '<source src = "' . BUS_POST_MAIN_UPLOAD_URL . $businessvideo[4]['file_name'] . '" type = "video/mp4">';
                    //$fetch_video .= '<source src = "movie.ogg" type = "video/ogg">';
                    $fetch_video .= 'Your browser does not support the video tag.';
                    $fetch_video .= '</video>';
                    $fetch_video .= '</td>';
                } else {
                    $fetch_video .= '<td class = "image_profile">';

                    $filename = $this->config->item('bus_profile_thumb_upload_path') . $posted_business_user_image;
                    $this->data['info'] = $info = $s3->getObjectInfo(bucket, $filename);
                    if ($info) {
                        $fetch_video .= '<video controls poster="' . BUS_POST_MAIN_UPLOAD_URL . $post_poster . '">';
                    } else {
                        $fetch_video .= '<video controls>';
                    }
                    $fetch_video .= '<source src = "' . BUS_POST_MAIN_UPLOAD_URL . $businessvideo[4]['file_name'] . '" type = "video/mp4">';
                    //$fetch_video .= '<source src = "movie.ogg" type = "video/ogg">';
                    $fetch_video .= 'Your browser does not support the video tag.';
                    $fetch_video .= '</video>';
                    $fetch_video .= '</td>';
                }
            }
            if ($businessvideo[5]['file_name']) {

                $post_poster = $businessvideo[5]['file_name'];
                $post_poster1 = explode('.', $post_poster);
                $post_poster2 = end($post_poster1);
                $post_poster = str_replace($post_poster2, 'png', $post_poster);

                if (IMAGEPATHFROM == 'upload') {
                    $fetch_video .= '<td class = "image_profile">';
                    if (file_exists($this->config->item('bus_profile_thumb_upload_path') . $post_poster)) {
                        $fetch_video .= '<video controls poster="' . BUS_POST_MAIN_UPLOAD_URL . $post_poster . '">';
                    } else {
                        $fetch_video .= '<video controls>';
                    }
                    $fetch_video .= '<source src = "' . BUS_POST_MAIN_UPLOAD_URL . $businessvideo[5]['file_name'] . '" type = "video/mp4">';
                    //$fetch_video .= '<source src = "movie.ogg" type = "video/ogg">';
                    $fetch_video .= 'Your browser does not support the video tag.';
                    $fetch_video .= '</video>';
                    $fetch_video .= '</td>';
                } else {
                    $fetch_video .= '<td class = "image_profile">';

                    $filename = $this->config->item('bus_profile_thumb_upload_path') . $posted_business_user_image;
                    $this->data['info'] = $info = $s3->getObjectInfo(bucket, $filename);
                    if ($info) {
                        $fetch_video .= '<video controls poster="' . BUS_POST_MAIN_UPLOAD_URL . $post_poster . '">';
                    } else {
                        $fetch_video .= '<video controls>';
                    }
                    $fetch_video .= '<source src = "' . BUS_POST_MAIN_UPLOAD_URL . $businessvideo[5]['file_name'] . '" type = "video/mp4">';
                    //$fetch_video .= '<source src = "movie.ogg" type = "video/ogg">';
                    $fetch_video .= 'Your browser does not support the video tag.';
                    $fetch_video .= '</video>';
                    $fetch_video .= '</td>';
                }
            }
            $fetch_video .= '</tr>';
        } else {
            //$fetch_video .= '<div class = "not_available"> <p> Video Not Available </p></div>';
        }

        $fetch_video .= '<div class = "dataconvideo"></div>';


        echo $fetch_video;
    }

    public function bus_user_audio() {

        $id = $_POST['bus_slug'];

        $contition_array = array('user_id' => $userid, 'status' => '1');
        $this->data['slug_data'] = $this->common->select_data_by_condition('business_profile', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        $slug_id = $this->data['slug_data'][0]['business_slug'];

        if ($id == $slug_id || $id == '') {

            $contition_array = array('business_slug' => $slug_id, 'status' => '1');
            $businessdata1 = $this->data['businessdata1'] = $this->common->select_data_by_condition('business_profile', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
        } else {

            $contition_array = array('business_slug' => $id, 'status' => '1', 'business_step' => 4);
            $businessdata1 = $this->data['businessdata1'] = $this->common->select_data_by_condition('business_profile', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
        }


        $contition_array = array('user_id' => $businessdata1[0]['user_id']);
        $busaudio = $this->data['busaudio'] = $this->common->select_data_by_condition('business_profile_post', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');


        foreach ($busaudio as $val) {

            $contition_array = array('post_id' => $val['business_profile_post_id'], 'is_deleted' => '1', 'insert_profile' => '2');
            $busmultiaudio = $this->data['busmultiaudio'] = $this->common->select_data_by_condition('post_files', $contition_array, $data = '*', $sortby = 'post_id', $orderby = 'DESC', $limit = '', $offset = '', $join_str = array(), $groupby = '');

            $multipleaudio[] = $busmultiaudio;
        }

        $allowesaudio = array('mp3');

        foreach ($multipleaudio as $mke => $mval) {

            foreach ($mval as $mke1 => $mval1) {
                $ext = pathinfo($mval1['file_name'], PATHINFO_EXTENSION);

                if (in_array($ext, $allowesaudio)) {
                    $singlearray2[] = $mval1;
                }
            }
        }
        if ($singlearray2) {
            $fetchaudio .= '<tr>';

            if ($singlearray2[0]['file_name']) {
                $fetchaudio .= '<td class="image_profile">';
                $fetchaudio .= '<audio  controls>';

                $fetchaudio .= '<source src="' . BUS_POST_MAIN_UPLOAD_URL . $singlearray2[0]['file_name'] . '" type="audio/mp3">';
                $fetchaudio .= '<source src="movie.ogg" type="audio/mp3">';
                $fetchaudio .= 'Your browser does not support the audio tag.';
                $fetchaudio .= '</audio>';
                $fetchaudio .= '</td>';
            }

            if ($singlearray2[1]['file_name']) {
                $fetchaudio .= '<td class="image_profile">';
                $fetchaudio .= '<audio  controls>';
                $fetchaudio .= '<source src="' . BUS_POST_MAIN_UPLOAD_URL . $singlearray2[1]['file_name'] . '" type="audio/mp3">';
                $fetchaudio .= '<source src="movie.ogg" type="audio/mp3">';
                $fetchaudio .= 'Your browser does not support the audio tag.';
                $fetchaudio .= '</audio>';
                $fetchaudio .= '</td>';
            }
            if ($singlearray2[2]['file_name']) {
                $fetchaudio .= '<td class="image_profile">';
                $fetchaudio .= '<audio controls>';
                $fetchaudio .= '<source src="' . BUS_POST_MAIN_UPLOAD_URL . $singlearray2[2]['file_name'] . '" type="audio/mp3">';
                $fetchaudio .= '<source src="movie.ogg" type="audio/mp3">';
                $fetchaudio .= 'Your browser does not support the audio tag.';
                $fetchaudio .= '</audio>';
                $fetchaudio .= '</td>';
            }
            $fetchaudio .= '</tr>';
            $fetchaudio .= '<tr>';

            if ($singlearray2[3]['file_name']) {
                $fetchaudio .= '<td class="image_profile">';
                $fetchaudio .= '<audio controls>';
                $fetchaudio .= '<source src="' . BUS_POST_MAIN_UPLOAD_URL . $singlearray2[3]['file_name'] . '" type="audio/mp3">';
                $fetchaudio .= '<source src="movie.ogg" type="audio/mp3">';
                $fetchaudio .= 'Your browser does not support the audio tag.';
                $fetchaudio .= '</audio>';
                $fetchaudio .= '</td>';
            }
            if ($singlearray2[4]['file_name']) {
                $fetchaudio .= '<td class="image_profile">';
                $fetchaudio .= '<video  controls>';
                $fetchaudio .= '<source src="' . BUS_POST_MAIN_UPLOAD_URL . $singlearray2[4]['file_name'] . '" type="audio/mp3">';
                $fetchaudio .= '<source src="movie.ogg" type="audio/mp3">';
                $fetchaudio .= 'Your browser does not support the audio tag.';
                $fetchaudio .= '</video>';
                $fetchaudio .= '</td>';
            }
            if ($singlearray2[5]['file_name']) {
                $fetchaudio .= '<td class="image_profile">';
                $fetchaudio .= '<video  controls>';
                $fetchaudio .= '<source src="' . BUS_POST_MAIN_UPLOAD_URL . $singlearray2[5]['file_name'] . '" type="audio/mp3">';
                $fetchaudio .= '<source src="movie.ogg" type="audio/mp3">';
                $fetchaudio .= 'Your browser does not support the audio tag.';
                $fetchaudio .= '</video>';
                $fetchaudio .= '</td>';
            }
            $fetchaudio .= '</tr>';
        } else {
            $fetchaudio .= '<div class="not_available">  <p>   Audio Not Available </p></div>';
        }
        $fetchaudio .= '<div class="dataconaudio"></div>';
        echo $fetchaudio;
    }

    public function bus_user_pdf() {
        $s3 = new S3(awsAccessKey, awsSecretKey);
        $id = $_POST['bus_slug'];
// manage post start
        $userid = $this->session->userdata('aileenuser');
        $user_name = $this->session->userdata('user_name');

        $contition_array = array('user_id' => $userid, 'status' => '1');
        $this->data['slug_data'] = $this->common->select_data_by_condition('business_profile', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        $slug_id = $this->data['slug_data'][0]['business_slug'];
        if ($id == $slug_id || $id == '') {
            $contition_array = array('business_slug' => $slug_id, 'status' => '1');
            $businessdata1 = $this->data['businessdata1'] = $this->common->select_data_by_condition('business_profile', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
        } else {
            $contition_array = array('business_slug' => $id, 'status' => '1', 'business_step' => 4);
            $businessdata1 = $this->data['businessdata1'] = $this->common->select_data_by_condition('business_profile', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
        }
        $join_str[0]['table'] = 'post_files';
        $join_str[0]['join_table_id'] = 'post_files.post_id';
        $join_str[0]['from_table_id'] = 'business_profile_post.business_profile_post_id';
        $join_str[0]['join_type'] = '';

        $contition_array = array('user_id' => $businessdata1[0]['user_id'], 'business_profile_post.is_delete' => 0, 'post_files.insert_profile' => '2', 'post_format' => 'pdf');
        $businesspdf = $this->data['businessaudio'] = $this->common->select_data_by_condition('business_profile_post', $contition_array, $data = 'file_name', $sortby = 'post_files.created_date', $orderby = 'desc', $limit = '6', $offset = '', $join_str, $groupby = '');

        if ($businesspdf) {
            $i = 0;
            foreach ($businesspdf as $mi) {
                $fetch_pdf .= '<div class = "image_profile">';
                $fetch_pdf .= '<a href = "javascript:void(0)" target="_blank" onclick="open_profile();"><div class = "pdf_img">';
                $fetch_pdf .= '<img src = "' . base_url('assets/images/PDF.jpg') . '" style = "height: 50%; width: 50%;">';
                $fetch_pdf .= '</div></a>';
                $fetch_pdf .= '</div>';

                $i++;
                if ($i == 6)
                    break;
            }
        } else {
            
        }
        $fetch_pdf .= '<div class = "dataconpdf"></div>';
        echo $fetch_pdf;
    }

    public function business_user_dashboard_post($id = '') {
// manage post start

        $perpage = 5;
        $page = 1;
        if (!empty($_GET["page"]) && $_GET["page"] != 'undefined') {
            $page = $_GET["page"];
        }

        $start = ($page - 1) * $perpage;
        if ($start < 0)
            $start = 0;

        $userid = $this->session->userdata('aileenuser');
        $user_name = $this->session->userdata('user_name');

        $contition_array = array('user_id' => $userid, 'status' => '1');
        $slug_data = $this->common->select_data_by_condition('business_profile', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        $slug_id = $slug_data[0]['business_slug'];
        if ($id == $slug_id || $id == '') {
            $contition_array = array('business_slug' => $slug_id, 'is_deleted' => 0, 'status' => '1','business_step' => 4);
            $businessdata1 = $this->common->select_data_by_condition('business_profile', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

            $limit = $perpage;
            $offset = $start;

            $contition_array = array('user_id' => $businessdata1[0]['user_id'], 'status' => 1, 'is_delete' => '0');
            $business_profile_data = $this->common->select_data_by_condition('business_profile_post', $contition_array, $data, $sortby = 'business_profile_post_id', $orderby = 'DESC', $limit, $offset, $join_str = array(), $groupby = '');
            $business_profile_data1 = $this->common->select_data_by_condition('business_profile_post', $contition_array, $data, $sortby = 'business_profile_post_id', $orderby = 'DESC', $limit = '', $offset = '', $join_str = array(), $groupby = '');
        } else {
            $contition_array = array('business_slug' => $id, 'is_deleted' => 0, 'status' => '1', 'business_step' => 4);
            $businessdata1 = $this->common->select_data_by_condition('business_profile', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

            $limit = $perpage;
            $offset = $start;

            $contition_array = array('user_id' => $businessdata1[0]['user_id'], 'status' => 1, 'is_delete' => '0');
            $business_profile_data = $this->common->select_data_by_condition('business_profile_post', $contition_array, $data, $sortby = 'business_profile_post_id', $orderby = 'DESC', $limit, $offset, $join_str = array(), $groupby = '');
            $business_profile_data1 = $this->common->select_data_by_condition('business_profile_post', $contition_array, $data, $sortby = 'business_profile_post_id', $orderby = 'DESC', $limit = '', $offset = '', $join_str = array(), $groupby = '');
        }

        $return_html = '';

        if (empty($_GET["total_record"])) {
            $_GET["total_record"] = count($business_profile_data1);
        }

        $return_html .= '<input type = "hidden" class = "page_number" value = "' . $page . '" />';
        $return_html .= '<input type = "hidden" class = "total_record" value = "' . $_GET["total_record"] . '" />';
        $return_html .= '<input type = "hidden" class = "perpage_record" value = "' . $perpage . '" />';
        if (count($business_profile_data1) > 0) {

            foreach ($business_profile_data as $row) {
                $contition_array = array('user_id' => $row['user_id'], 'status' => '1');
                $businessdata = $this->common->select_data_by_condition('business_profile', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

                $return_html .= '<div id = "removepost' . $row['business_profile_post_id'] . '">
<div class = "col-md-12 col-sm-12 post-design-box">
<div class = "post_radius_box">
<div class = "post-design-top col-md-12" >
<div class = "post-design-pro-img">';
                $userid = $this->session->userdata('aileenuser');
                $userimage = $this->db->get_where('business_profile', array('user_id' => $row['user_id']))->row()->business_user_image;
                $userimageposted = $this->db->get_where('business_profile', array('user_id' => $row['posted_user_id']))->row()->business_user_image;
                $usernameposted = $this->db->get_where('business_profile', array('user_id' => $row['posted_user_id']))->row()->company_name;
                $username = $this->db->get_where('business_profile', array('user_id' => $row['user_id']))->row()->company_name;
                $userimageposted = $this->db->get_where('business_profile', array('user_id' => $row['posted_user_id']))->row()->business_user_image;
                if ($row['posted_user_id']) {
                    if ($userimageposted) {

                        if (!file_exists($this->config->item('bus_profile_thumb_upload_path') . $userimageposted)) {

                            $return_html .= '<img src = "' . base_url(NOBUSIMAGE) . '" alt = "">';
                        } else {

                            $return_html .= '<img src = "' . BUS_PROFILE_THUMB_UPLOAD_URL . $userimageposted . '" name = "image_src" id = "image_src" />';
                        }
                    } else {


                        $return_html .= '<img src = "' . base_url(NOBUSIMAGE) . '" alt = "">';
                    }
                } else {
                    if ($userimage) {

                        if (!file_exists($this->config->item('bus_profile_thumb_upload_path') . $userimage)) {


                            $return_html .= '<img src = "' . base_url(NOBUSIMAGE) . '" alt = "">';
                        } else {

                            $return_html .= '<img src = "' . BUS_PROFILE_THUMB_UPLOAD_URL . $userimage . '" name = "image_src" id = "image_src" />';
                        }
                    } else {


                        $return_html .= '<img src = "' . base_url(NOBUSIMAGE) . '" alt = "">';
                    }
                }
                $return_html .= '</div>
<div class = "post-design-name fl col-xs-8 col-md-10">
<ul>';
                $companyname = $this->db->get_where('business_profile', array('user_id' => $row['user_id']))->row()->company_name;
                $slugname = $this->db->get_where('business_profile', array('user_id' => $row['user_id'], 'status' => 1))->row()->business_slug;
                $categoryid = $this->db->get_where('business_profile', array('user_id' => $row['user_id'], 'status' => 1))->row()->industriyal;
                $category = $this->db->get_where('industry_type', array('industry_id' => $categoryid, 'status' => 1))->row()->industry_name;
                $companynameposted = $this->db->get_where('business_profile', array('user_id' => $row['posted_user_id']))->row()->company_name;
                $slugnameposted = $this->db->get_where('business_profile', array('user_id' => $row['posted_user_id'], 'status' => 1))->row()->business_slug;
                if ($row['posted_user_id']) {
                    $return_html .= '<li>
<div class = "else_post_d">
<div class = "post-design-product">
<a style = "max-width: 40%;" class = "post_dot" title = "' . ucfirst(strtolower($companynameposted)) . '" href = "' . base_url('business-profile/dashboard/' . $slugnameposted) . '">' . ucfirst(strtolower($companynameposted)) . '</a>
<p class = "posted_with" > Posted With</p>
<a class = "other_name post_dot" href = "' . base_url('business-profile/details/' . $slugname) . '">' . ucfirst(strtolower($companyname)) . '</a>
<span role = "presentation" aria-hidden = "true"> · </span> <span class = "ctre_date">' . $this->common->time_elapsed_string(date('Y-m-d H:i:s', strtotime($row['created_date']))) . '</span>
</div></div>
</li>';
                } else {
                    $return_html .= '<li><div class = "post-design-product"><a class = "post_dot" title = "' . ucfirst(strtolower($companyname)) . '" href = "' . base_url('business-profile/dashboard/' . $slugname) . '">' . ucfirst(strtolower($companyname)) . '</a>
<span role = "presentation" aria-hidden = "true"> · </span>
<div class = "datespan">
<span class = "ctre_date">' . $this->common->time_elapsed_string(date('Y-m-d H:i:s', strtotime($row['created_date']))) . '</span>
</div>
</div>
</li>';
                }
                $category = $this->db->get_where('industry_type', array('industry_id' => $businessdata[0]['industriyal'], 'status' => 1))->row()->industry_name;
                $return_html .= '<li><div class = "post-design-product"> <a class = "buuis_desc_a" title = "Category">';

                if ($category) {
                    $return_html .= ucfirst(strtolower($category));
                } else {
                    $return_html .= ucfirst(strtolower($businessdata[0]['other_industrial']));
                }

                $return_html .= '</a> </div>
</li>
<li>
</li>
</ul>
</div>';
                if ($userid == $row['posted_user_id'] || $row['user_id'] == $userid) {
                    $return_html .= '<div class = "dropdown1">
<a onClick = "myFunction1(' . $row['business_profile_post_id'] . ')" class = "dropbtn1 dropbtn1 fa fa-ellipsis-v"></a>
<div id = "myDropdown' . $row['business_profile_post_id'] . '" class = "dropdown-content2">';
                    if ($row['posted_user_id'] != 0) {
                        if ($this->session->userdata('aileenuser') == $row['posted_user_id']) {
                            $return_html .= '<a onclick = "user_postdelete(' . $row['business_profile_post_id'] . ')">
<i class = "fa fa-trash-o" aria-hidden = "true">
</i> Delete Post
</a>
<a id = "' . $row['business_profile_post_id'] . '" onClick = "editpost(this.id)">
<i class = "fa fa-pencil-square-o" aria-hidden = "true">
</i>Edit
</a>';
                        } else {
                            $return_html .= '<a onclick = "user_postdelete(' . $row['business_profile_post_id'] . ')">
<i class = "fa fa-trash-o" aria-hidden = "true">
</i> Delete Post
</a>';
                        }
                    } else {
                        if ($this->session->userdata('aileenuser') == $row['user_id']) {
                            $return_html .= '<a onclick = "user_postdelete(' . $row['business_profile_post_id'] . ')"><i class = "fa fa-trash-o" aria-hidden = "true"></i> Delete Post</a>
<a id = "' . $row['business_profile_post_id'] . '" onClick = "editpost(this.id)"><i class = "fa fa-pencil-square-o" aria-hidden = "true"></i>Edit</a>';
                        } else {
                            
                        }
                    }
                    $return_html .= '</div>
</div>';
                }

                if ($row['product_name'] || $row['product_description']) {
                    $return_html .= '<div class = "post-design-desc ">';
                }
                $return_html .= '<div class = "ft-15 t_artd">
<div id = "editpostdata' . $row['business_profile_post_id'] . '" style = "display:block;">
<a>' . $this->common->make_links($row['product_name']) . '</a>
</div>
<div id = "editpostbox' . $row['business_profile_post_id'] . '" style = "display:none;">
<input type = "text" class="productpostname" id = "editpostname' . $row['business_profile_post_id'] . '" name = "editpostname" placeholder = "Product Name" value = "' . $row['product_name'] . '" onKeyDown = check_lengthedit(' . $row['business_profile_post_id'] . ') onKeyup = check_lengthedit(' . $row['business_profile_post_id'] . ');
onblur = check_lengthedit(' . $row['business_profile_post_id'] . ')>';
                if ($row['product_name']) {
                    $counter = $row['product_name'];
                    $a = strlen($counter);
                    $return_html .= '<input size = 1 id = "text_num_' . $row['business_profile_post_id'] . '" class = "text_num" value = "' . (50 - $a) . '" name = text_num disabled>';
                } else {
                    $return_html .= '<input size = 1 id = "text_num' . $row['business_profile_post_id'] . '" class = "text_num" value = 50 name = text_num disabled>';
                }
                $return_html .= '</div>
</div>
<div id = "khyati' . $row['business_profile_post_id'] . '" style = "display:block;">';
                $small = substr($row['product_description'], 0, 180);
                $return_html .= nl2br($this->common->make_links($small));
                if (strlen($row['product_description']) > 180) {
                    $return_html .= '... <span id = "kkkk" onClick = "khdiv(' . $row['business_profile_post_id'] . ')">View More</span>';
                }
                $return_html .= '</div>
<div id = "khyatii' . $row['business_profile_post_id'] . '" style = "display:none;">';
                $return_html .= $row['product_description'];
                $return_html .= '</div>
<div id = "editpostdetailbox' . $row['business_profile_post_id'] . '" style = "display:none;">
<div contenteditable = "true" id = "editpostdesc' . $row['business_profile_post_id'] . '" placeholder = "Product Description" class = "textbuis editable_text" placeholder = "Description of Your Product" name = "editpostdesc" onpaste = "OnPaste_StripFormatting(this, event);" onfocus="cursorpointer(' . $row['business_profile_post_id'] . ')">' . $row['product_description'] . '</div>
</div><button class = "fr" id = "editpostsubmit' . $row['business_profile_post_id'] . '" style="display:none; margin: 5px 0;" onClick="edit_postinsert(' . $row['business_profile_post_id'] . ')">Save</button>
</div> ';
                if ($row['product_name'] || $row['product_description']) {
                    $return_html .= '</div>';
                }
                $return_html .= '<div class="post-design-mid col-md-12" >  
    <div class="mange_post_image">';

                $contition_array = array('post_id' => $row['business_profile_post_id'], 'is_deleted' => '1', 'insert_profile' => '2');
                $businessmultiimage = $this->data['businessmultiimage'] = $this->common->select_data_by_condition('post_files', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
                if (count($businessmultiimage) == 1) {

                    $allowed = array('jpg', 'JPG', 'jpeg', 'JPEG', 'PNG', 'png', 'gif', 'GIF', 'psd', 'PSD', 'bmp', 'BMP', 'tiff', 'TIFF', 'iff', 'IFF', 'xbm', 'XBM', 'webp', 'WebP', 'HEIF', 'heif', 'BAT', 'bat', 'BPG', 'bpg', 'SVG', 'svg');
                    //$allowed = VALID_IMAGE;
                    $allowespdf = array('pdf');
                    $allowesvideo = array('mp4', 'webm', 'qt', 'mov', 'MP4');
                    $allowesaudio = array('mp3');
                    $filename = $businessmultiimage[0]['file_name'];
                    $ext = pathinfo($filename, PATHINFO_EXTENSION);
                    if (in_array($ext, $allowed)) {


                        $return_html .= '<a href="javascript:void(0);"  onclick="open_profile();">
<img src = "' . BUS_POST_MAIN_UPLOAD_URL . $businessmultiimage[0]['file_name'] . '">
</a>
</div>';
                    } elseif (in_array($ext, $allowespdf)) {
//                        $return_html .= '<div>
//<a title = "click to open" href = "' . BUS_POST_MAIN_UPLOAD_URL . $businessmultiimage[0]['file_name'] . '"><div class = "pdf_img">
//    <embed src="' . BUS_POST_MAIN_UPLOAD_URL . $businessmultiimage[0]['file_name'] . '" width="100%" height="450px" />
//</div>
//</a>
//</div>';
                        
                $return_html .= '<div>
<a title = "click to open" href = "javascript:void(0);" onclick="open_profile();"><div class = "pdf_img">
    <img src="' . base_url('assets/images/PDF.jpg') . '" alt="PDF">
</div>
</a>
</div>';
        
                    } elseif (in_array($ext, $allowesvideo)) {
                        $return_html .= '<div>
            <video class="video" width="100%" height="350" controls>
                <source src="' . BUS_POST_MAIN_UPLOAD_URL . $businessmultiimage[0]['file_name'] . '" type="video/mp4">
                <source src="movie.ogg" type="video/ogg">
                Your browser does not support the video tag.
            </video>
        </div>';
                    } elseif (in_array($ext, $allowesaudio)) {
                        $return_html .= '<div class="audio_main_div">
            <div class="audio_img">
                <img src="' . base_url('assets/images/music-icon.png') . '">  
            </div>
            <div class="audio_source">
                <audio  controls>
                    <source src="' . BUS_POST_MAIN_UPLOAD_URL . $businessmultiimage[0]['file_name'] . '" type="audio/mp3">
                    <source src="movie.ogg" type="audio/ogg">
                    Your browser does not support the audio tag.
                </audio>
            </div>
            <div class="audio_mp3" id="postname' . $row['business_profile_post_id'] . '">
                <p title="' . $row['product_name'] . '">' . $row['product_name'] . '</p>
            </div>
        </div>';
                    }
                } elseif (count($businessmultiimage) == 2) {
                    foreach ($businessmultiimage as $multiimage) {
                        $return_html .= '<div  class="two-images" >
            <a href="javascript:void(0);"  onclick="open_profile();"><img class="two-columns" src="' . BUS_POST_RESIZE1_UPLOAD_URL . $multiimage['file_name'] . '"> </a>
        </div>';
                    }
                } elseif (count($businessmultiimage) == 3) {
                    $return_html .= '<div class="three-image-top" >
            <a href="javascript:void(0);"  onclick="open_profile();"><img class="three-columns" src="' . BUS_POST_RESIZE4_UPLOAD_URL . $businessmultiimage[0]['file_name'] . '"> </a>
        </div>
        <div class="three-image" >
            <a href="javascript:void(0);"  onclick="open_profile();"><img class="three-columns" src="' . BUS_POST_RESIZE1_UPLOAD_URL . $businessmultiimage[1]['file_name'] . '"> </a>
        </div>
        <div class="three-image" >
            <a href="javascript:void(0);"  onclick="open_profile();"><img class="three-columns" src="' . BUS_POST_RESIZE1_UPLOAD_URL . $businessmultiimage[2]['file_name'] . '"> </a>
        </div>';
                } elseif (count($businessmultiimage) == 4) {

                    foreach ($businessmultiimage as $multiimage) {
                        $return_html .= '<div class="four-image">
            <a href="javascript:void(0);"  onclick="open_profile();"><img class="breakpoint" src="' . BUS_POST_RESIZE2_UPLOAD_URL . $multiimage['file_name'] . '"> </a>
        </div>';
                    }
                } elseif (count($businessmultiimage) > 4) {

                    $i = 0;
                    foreach ($businessmultiimage as $multiimage) {
                        $return_html .= '<div class="four-image">
            <a href="javascript:void(0);"  onclick="open_profile();"><img src="' . BUS_POST_RESIZE2_UPLOAD_URL . $multiimage['file_name'] . '" > </a>
        </div>';
                        $i++;
                        if ($i == 3)
                            break;
                    }
                    $return_html .= '<div class="four-image">
            <a href="javascript:void(0);"  onclick="open_profile();"><img src="' . BUS_POST_RESIZE2_UPLOAD_URL . $businessmultiimage[3]['file_name'] . '"> </a>
            <a href="javascript:void(0);"  onclick="open_profile();">
                <div class="more-image" >
                    <span> View All (+' . (count($businessmultiimage) - 4) . ')
                    </span></div>
            </a>
        </div>';
                }
                $return_html .= '<div>
        </div>
    </div>
    </div>
<div class="post-design-like-box col-md-12">
    <div class="post-design-menu">
        <ul class="col-md-6">
            <li class="likepost' . $row['business_profile_post_id'] . '">
                <a class="ripple like_h_w" id="' . $row['business_profile_post_id'] . '"   onClick="open_profile();">';
                $userid = $this->session->userdata('aileenuser');
                $contition_array = array('business_profile_post_id' => $row['business_profile_post_id'], 'status' => '1');
                $active = $this->data['active'] = $this->common->select_data_by_condition('business_profile_post', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

                $likeuser = $this->data['active'][0]['business_like_user'];
                $likeuserarray = explode(',', $active[0]['business_like_user']);

                if (!in_array($userid, $likeuserarray)) {
                    $return_html .= '<i class="fa fa-thumbs-up" style="color: #999;" aria-hidden="true"></i>';
                } else {
                    $return_html .= '<i class="fa fa-thumbs-up main_color fa-1x" aria-hidden="true"></i>';
                }

                $return_html .= '<span class="like_As_count">';
                if ($row['business_likes_count'] > 0) {
                    $return_html .= $row['business_likes_count'];
                }
                $return_html .= '</span>
                </a>
            </li>

            <li id="insertcount' . $row['business_profile_post_id'] . '" style="visibility:show">';
                $contition_array = array('business_profile_post_id' => $row['business_profile_post_id'], 'status' => '1', 'is_delete' => '0');
                $commnetcount = $this->common->select_data_by_condition('business_profile_post_comment', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

                $return_html .= '<a class="ripple like_h_w" onClick="open_profile();" id="' . $row['business_profile_post_id'] . '"><i class="fa fa-comment-o" aria-hidden="true">';
                $return_html .= '</i> 
                </a>
            </li> 
        </ul>
        <ul class="col-md-6 like_cmnt_count">
            <li>
                <div class="like_count_ext">
                    <span class="comment_count' . $row['business_profile_post_id'] . '">';
                if (count($commnetcount) > 0) {
                    $return_html .= count($commnetcount);
                    $return_html .= '<span> Comment</span>';
                }
                $return_html .= '</span> 

                </div>
            </li>

            <li>
                <div class="comnt_count_ext">
                    <span class="comment_like_count' . $row['business_profile_post_id'] . '"> ';
                if ($row['business_likes_count'] > 0) {
                    $return_html .= $row['business_likes_count'];
                    $return_html .= '<span> Like</span>';
                }
                $return_html .= '</span> 
                </div>
            </li>
        </ul>
    </div>
</div>';
                if ($row['business_likes_count'] > 0) {
                    $return_html .= '<div class="likeduserlist1 likeduserlist' . $row['business_profile_post_id'] . '">';
                    $contition_array = array('business_profile_post_id' => $row['business_profile_post_id'], 'status' => '1', 'is_delete' => '0');
                    $commnetcount = $this->common->select_data_by_condition('business_profile_post', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
                    $likeuser = $commnetcount[0]['business_like_user'];
                    $countlike = $commnetcount[0]['business_likes_count'] - 1;
                    $likelistarray = explode(',', $likeuser);
                    foreach ($likelistarray as $key => $value) {
                        $business_fname1 = $this->db->get_where('business_profile', array('user_id' => $value, 'status' => 1))->row()->company_name;
                    }
                    $return_html .= '<a href="javascript:void(0);"  onclick="open_profile();">';
                    $contition_array = array('business_profile_post_id' => $row['business_profile_post_id'], 'status' => '1', 'is_delete' => '0');
                    $commnetcount = $this->common->select_data_by_condition('business_profile_post', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

                    $likeuser = $commnetcount[0]['business_like_user'];
                    $countlike = $commnetcount[0]['business_likes_count'] - 1;
                    $likelistarray = explode(',', $likeuser);

                    $business_fname1 = $this->db->get_where('business_profile', array('user_id' => $value, 'status' => 1))->row()->company_name;
                    $return_html .= '<div class="like_one_other">';
                    if ($userid == $value) {
                        $return_html .= "You";
                        $return_html .= "&nbsp;";
                    } else {
                        $return_html .= ucfirst(strtolower($business_fname1));
                        $return_html .= "&nbsp;";
                    }
                    if (count($likelistarray) > 1) {
                        $return_html .= "and";
                        $return_html .= $countlike;
                        $return_html .= "&nbsp;";
                        $return_html .= "others";
                    }
                    $return_html .= '</div>
    </a>
</div>';
                }

                $return_html .= '<div  class="likeduserlist1  likeusername' . $row['business_profile_post_id'] . '" id="likeusername' . $row['business_profile_post_id'] . '" style="display:none">';
                $contition_array = array('business_profile_post_id' => $row['business_profile_post_id'], 'status' => '1', 'is_delete' => '0');
                $commnetcount = $this->common->select_data_by_condition('business_profile_post', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
                $likeuser = $commnetcount[0]['business_like_user'];
                $countlike = $commnetcount[0]['business_likes_count'] - 1;
                $likelistarray = explode(',', $likeuser);
                foreach ($likelistarray as $key => $value) {
                    $business_fname1 = $this->db->get_where('business_profile', array('user_id' => $value, 'status' => 1))->row()->company_name;
                }
                $return_html .= '<a href="javascript:void(0);"  onclick="open_profile();">';
                $contition_array = array('business_profile_post_id' => $row['business_profile_post_id'], 'status' => '1', 'is_delete' => '0');
                $commnetcount = $this->common->select_data_by_condition('business_profile_post', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

                $likeuser = $commnetcount[0]['business_like_user'];
                $countlike = $commnetcount[0]['business_likes_count'] - 1;
                $likelistarray = explode(',', $likeuser);

                $business_fname1 = $this->db->get_where('business_profile', array('user_id' => $value, 'status' => 1))->row()->company_name;
                $return_html .= '<div class="like_one_other">';
                $return_html .= ucfirst(strtolower($business_fname1));
                $return_html .= "&nbsp;";
                if (count($likelistarray) > 1) {
                    $return_html .= "and";
                    $return_html .= $countlike;
                    $return_html .= "&nbsp;";
                    $return_html .= "others";
                }
                $return_html .= '</div>
    </a>
</div>

<div class="art-all-comment col-md-12">
    <div id="fourcomment' . $row['business_profile_post_id'] . '" style="display:none;">
    </div>
    <div  id="threecomment' . $row['business_profile_post_id'] . '" style="display:block">
        <div class="insertcomment' . $row['business_profile_post_id'] . '">';
                $contition_array = array('business_profile_post_id' => $row['business_profile_post_id'], 'status' => '1');
                $businessprofiledata = $this->data['businessprofiledata'] = $this->common->select_data_by_condition('business_profile_post_comment', $contition_array, $data = '*', $sortby = 'business_profile_post_comment_id', $orderby = 'DESC', $limit = '1', $offset = '', $join_str = array(), $groupby = '');

                if ($businessprofiledata) {
                    foreach ($businessprofiledata as $rowdata) {
                        $companyname = $this->db->get_where('business_profile', array('user_id' => $rowdata['user_id']))->row()->company_name;
                        $companyslug = $this->db->get_where('business_profile', array('user_id' => $rowdata['user_id']))->row()->business_slug;
                        $return_html .= '<div class="all-comment-comment-box">
                <div class="post-design-pro-comment-img">';
                        $business_userimage = $this->db->get_where('business_profile', array('user_id' => $rowdata['user_id'], 'status' => 1))->row()->business_user_image;
                        if ($business_userimage) {

                            if (!file_exists($this->config->item('bus_profile_thumb_upload_path') . $business_userimage)) {


                                $return_html .= '<img  src="' . base_url(NOBUSIMAGE) . '"  alt="">';
                            } else {

                                $return_html .= '<img  src="' . BUS_PROFILE_THUMB_UPLOAD_URL . $business_userimage . '"  alt="">';
                            }
                        } else {


                            $return_html .= '<img  src="' . base_url(NOBUSIMAGE) . '"  alt="">';
                        }
                        $return_html .= '</div>
                <div class="comment-name">
                    <a href="javascript:void(0);"  onclick="open_profile();"><b>';
                        $return_html .= '' . ucfirst(strtolower($companyname)) . '';
                        $return_html .= '</br>';

                        $return_html .= '</b></a>
                </div>
                <div class="comment-details" id= "showcomment' . $rowdata['business_profile_post_comment_id'] . '">
                    <div id="lessmore' . $rowdata['business_profile_post_comment_id'] . '" style="display:block;">';
                        $small = substr($rowdata['comments'], 0, 180);
                        $return_html .= nl2br($this->common->make_links($small));

                        if (strlen($rowdata['comments']) > 180) {
                            $return_html .= '... <span id="kkkk" onClick="seemorediv(' . $rowdata['business_profile_post_comment_id'] . ')">See More</span>';
                        }
                        $return_html .= '</div>

                    <div id="seemore' . $rowdata['business_profile_post_comment_id'] . '" style="display:none;">';
                        $new_product_comment = $this->common->make_links($rowdata['comments']);
                        $return_html .= nl2br(htmlspecialchars_decode(htmlentities($new_product_comment, ENT_QUOTES, 'UTF-8')));
                        $return_html .= '</div>
                </div>
                <div class="edit-comment-box">
                    <div class="inputtype-edit-comment">
                        <div contenteditable="true"  class="editable_text editav_2" name="' . $rowdata['business_profile_post_comment_id'] . '"  id="editcomment"' . $rowdata['business_profile_post_comment_id'] . '" placeholder="Add a Commnet Comment" value= ""  onkeyup="commentedit(' . $rowdata['business_profile_post_comment_id'] . ')" onpaste="OnPaste_StripFormatting(this, event);">' . $rowdata['comments'] . '</div>
                        <span class="comment-edit-button"><button id="editsubmit' . $rowdata['business_profile_post_comment_id'] . '" style="display:none" onClick="edit_comment(' . $rowdata['business_profile_post_comment_id'] . ')">Save</button></span>
                    </div>
                </div>
                <div class="art-comment-menu-design"> 
                    <div class="comment-details-menu" id="likecomment1' . $rowdata['business_profile_post_comment_id'] . '">
                        <a id="' . $rowdata['business_profile_post_comment_id'] . '" onClick="open_profile();">';
                        $userid = $this->session->userdata('aileenuser');
                        $contition_array = array('business_profile_post_comment_id' => $rowdata['business_profile_post_comment_id'], 'status' => '1');
                        $businesscommentlike = $this->data['businesscommentlike'] = $this->common->select_data_by_condition('business_profile_post_comment', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
                        $likeuserarray = explode(',', $businesscommentlike[0]['business_comment_like_user']);
                        if (!in_array($userid, $likeuserarray)) {
                            $return_html .= '<i class="fa fa-thumbs-up fa-1x" aria-hidden="true"></i> ';
                        } else {
                            $return_html .= '<i class="fa fa-thumbs-up main_color" aria-hidden="true"></i>';
                        }
                        $return_html .= '<span>';
                        if ($rowdata['business_comment_likes_count']) {
                            $return_html .= $rowdata['business_comment_likes_count'];
                        }
                        $return_html .= '</span>
                        </a>
                    </div>';

                        $userid = $this->session->userdata('aileenuser');
                        if ($rowdata['user_id'] == $userid) {
                            $return_html .= '<span role="presentation" aria-hidden="true"> · </span>
                    <div class="comment-details-menu">
                        <div id="editcommentbox' . $rowdata['business_profile_post_comment_id'] . '" style="display:block;">
                            <a id="' . $rowdata['business_profile_post_comment_id'] . '"   onClick="comment_editbox(this.id)" class="editbox">Edit
                            </a>
                        </div>
                        <div id="editcancle' . $rowdata['business_profile_post_comment_id'] . '" style="display:none;">
                            <a id="' . $rowdata['business_profile_post_comment_id'] . '" onClick="comment_editcancle(this.id)">Cancel
                            </a>
                        </div>
                    </div>';
                        }
                        $userid = $this->session->userdata('aileenuser');
                        $business_userid = $this->db->get_where('business_profile_post', array('business_profile_post_id' => $rowdata['business_profile_post_id'], 'status' => 1))->row()->user_id;
                        if ($rowdata['user_id'] == $userid || $business_userid == $userid) {
                            $return_html .= '<span role="presentation" aria-hidden="true"> · </span>
                    <div class="comment-details-menu">
                        <input type="hidden" name="post_delete"  id="post_delete' . $rowdata['business_profile_post_comment_id'] . '" value= "' . $rowdata['business_profile_post_id'] . '">
                        <a id="' . $rowdata['business_profile_post_comment_id'] . '"   onClick="comment_delete(this.id)"> Delete<span class="insertcomment' . $rowdata['business_profile_post_comment_id'] . '">
                            </span>
                        </a>
                    </div>';
                        }
                        $return_html .= '<span role="presentation" aria-hidden="true"> · </span>
                    <div class="comment-details-menu">
                        <p>';

                        $return_html .= $this->common->time_elapsed_string(date('Y-m-d H:i:s', strtotime($rowdata['created_date'])));
                        $return_html .= '</br>';
                        $return_html .= '</p></div>
                </div></div>';
                    }
                }
                $return_html .= '</div>
    </div>
</div>
</div>
</div> </div></div>';
            }
        } else {
            $return_html .= '<div class="art_no_post_avl">
                                <h3>Business Post</h3>
                                <div class="art-img-nn">
                                    <div class="art_no_post_img">

                                        <img src="' . base_url('assets/img/bui-no.png') . '">

                                    </div>
                                    <div class="art_no_post_text">
                                        No Post Available.
                                    </div>
                                </div>
                            </div> ';
        }
        $return_html .= '<div class="nofoundpost">
</div>';
        echo $return_html;
    }
    public function business_profile_active_check() {
        $s3 = new S3(awsAccessKey, awsSecretKey);
        $userid = $this->session->userdata('aileenuser');
        if (!$userid) {
            redirect('login');
        }
        // IF USER DEACTIVE PROFILE THEN REDIRECT TO BUSINESS-PROFILE/INDEX UNTILL ACTIVE PROFILE START

        $contition_array = array('user_id' => $userid, 'status' => '0', 'is_deleted' => '0');
        $business_deactive = $this->data['business_deactive'] = $this->common->select_data_by_condition('business_profile', $contition_array, $data = ' business_profile_id', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby);

        if ($business_deactive) {
            redirect('business-profile');
        }


// IF USER DEACTIVE PROFILE THEN REDIRECT TO BUSINESS-PROFILE/INDEX UNTILL ACTIVE PROFILE END
// DEACTIVATE PROFILE END
    }

    public function is_business_profile_register() {
        $s3 = new S3(awsAccessKey, awsSecretKey);
        $userid = $this->session->userdata('aileenuser');
        $contition_array = array('user_id' => $userid, 'status' => '1', 'is_deleted' => '0');
        $business_check = $this->data['business_deactive'] = $this->common->select_data_by_condition('business_profile', $contition_array, $data = ' business_profile_id,business_step', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby);

        if ($business_check) {

            if ($business_check[0]['business_step'] == 1) {
                redirect('business-profile/contact-information', refresh);
            } else if ($business_check[0]['business_step'] == 2) {
                redirect('business-profile/description', refresh);
            } else if ($business_check[0]['business_step'] == 3) {
                redirect('business-profile/image', refresh);
            }
        } else {
            redirect('business-profile/business-information-update', refresh);
        }

// IF USER DEACTIVE PROFILE THEN REDIRECT TO BUSINESS-PROFILE/INDEX UNTILL ACTIVE PROFILE END
// DEACTIVATE PROFILE END
    }

    // BUSIENSS PROFILE USER FOLLOWING COUNT START

    public function business_user_following_count($business_profile_id = '') {
        $s3 = new S3(awsAccessKey, awsSecretKey);
        $userid = $this->session->userdata('aileenuser');
        if ($business_profile_id == '') {
            $business_profile_id = $this->db->get_where('business_profile', array('user_id' => $userid, 'status' => 1))->row()->business_profile_id;
        }

        $contition_array = array('follow_from' => $business_profile_id, 'follow_status' => '1', 'follow_type' => '2', 'business_profile.status' => 1);

        $join_str_following[0]['table'] = 'follow';
        $join_str_following[0]['join_table_id'] = 'follow.follow_to';
        $join_str_following[0]['from_table_id'] = 'business_profile.business_profile_id';
        $join_str_following[0]['join_type'] = '';

        $bus_user_f_ing_count = $this->common->select_data_by_condition('business_profile', $contition_array, $data = 'count(*) as following_count', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str_following, $groupby = '');

        $following_count = $bus_user_f_ing_count[0]['following_count'];

        return $following_count;
    }

    // BUSIENSS PROFILE USER FOLLOWING COUNT END
    // BUSIENSS PROFILE USER FOLLOWER COUNT START

    public function business_user_follower_count($business_profile_id = '') {
        $s3 = new S3(awsAccessKey, awsSecretKey);
        $userid = $this->session->userdata('aileenuser');
        if ($business_profile_id == '') {
            $business_profile_id = $this->db->get_where('business_profile', array('user_id' => $userid, 'status' => 1))->row()->business_profile_id;
        }

        $contition_array = array('follow_to' => $business_profile_id, 'follow_status' => '1', 'follow_type' => '2', 'business_profile.status' => 1);

        $join_str_following[0]['table'] = 'follow';
        $join_str_following[0]['join_table_id'] = 'follow.follow_from';
        $join_str_following[0]['from_table_id'] = 'business_profile.business_profile_id';
        $join_str_following[0]['join_type'] = '';

        $bus_user_f_er_count = $this->common->select_data_by_condition('business_profile', $contition_array, $data = 'count(*) as follower_count', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str_following, $groupby = '');

        $follower_count = $bus_user_f_er_count[0]['follower_count'];

        return $follower_count;
    }

    // BUSIENSS PROFILE USER FOLLOWER COUNT END
    // 
    public function business_user_contacts_count($business_profile_id = '') {
        $s3 = new S3(awsAccessKey, awsSecretKey);
        $userid = $this->session->userdata('aileenuser');
        if ($business_profile_id != '') {
            $userid = $this->db->get_where('business_profile', array('business_profile_id' => $business_profile_id, 'status' => 1))->row()->user_id;
        }

        $contition_array = array('contact_type' => 2, 'contact_person.status' => 'confirm', 'business_profile.status' => 1);
        $search_condition = "((contact_from_id = ' $userid') OR (contact_to_id = '$userid'))";

        $join_str_contact[0]['table'] = 'business_profile';
        $join_str_contact[0]['join_table_id'] = 'business_profile.user_id';
        $join_str_contact[0]['from_table_id'] = 'contact_person.contact_from_id';
        $join_str_contact[0]['join_type'] = '';

        $contacts_count = $this->common->select_data_by_search('contact_person', $search_condition, $contition_array, $data = 'count(*) as contact_count', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str_contact, $groupby = '');

        $contacts_count = $contacts_count[0]['contact_count'];

        return $contacts_count;
    }

}
