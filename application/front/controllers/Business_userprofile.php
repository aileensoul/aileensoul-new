<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Business_userprofile extends CI_Controller {

    public $data;

    public function __construct() {
        parent::__construct();
        
        $this->load->library('form_validation');
        $this->load->model('email_model');
        $this->lang->load('message', 'english');
        include ('include.php');

// DEACTIVATE PROFILE START

        $userid = $this->session->userdata('aileenuser');

// IF USER DEACTIVE PROFILE THEN REDIRECT TO BUSINESS-PROFILE/INDEX UNTILL ACTIVE PROFILE START

        $contition_array = array('user_id' => $userid, 'status' => '0', 'is_deleted' => '0');
        $business_deactive = $this->data['business_deactive'] = $this->common->select_data_by_condition('business_profile', $contition_array, $data = '	business_profile_id', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);

        if ($business_deactive) {
            redirect('business-profile/');
        }
// IF USER DEACTIVE PROFILE THEN REDIRECT TO BUSINESS-PROFILE/INDEX UNTILL ACTIVE PROFILE END
// DEACTIVATE PROFILE END
// CODE FOR SECOND HEADER SEARCH START

        $contition_array = array('status' => '1', 'is_deleted' => '0', 'business_step' => 4);
        $businessdata = $this->data['results'] = $this->common->select_data_by_condition('business_profile', $contition_array, $data = 'company_name,other_industrial,other_business_type', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);

// GET BUSINESS TYPE
        $contition_array = array('status' => '1', 'is_delete' => '0');
        $businesstype = $this->data['results'] = $this->common->select_data_by_condition('business_type', $contition_array, $data = 'business_name', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);

// GET INDUSTRIAL TYPE
        $contition_array = array('status' => '1', 'is_delete' => '0');
        $industrytype = $this->data['results'] = $this->common->select_data_by_condition('industry_type', $contition_array, $data = 'industry_name', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);

        $unique = array_merge($businessdata, $businesstype, $industrytype);
        foreach ($unique as $key => $value) {
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

// GET LOCATION DATA
        $contition_array = array('status' => '1');
        $location_list = $this->common->select_data_by_condition('cities', $contition_array, $data = 'city_name', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);

        foreach ($location_list as $key1 => $value1) {
            foreach ($value1 as $ke1 => $val1) {
                $location[] = $val1;
            }
        }

        foreach ($location as $key => $value) {
            $loc[$key]['label'] = $value;
            $loc[$key]['value'] = $value;
        }

        $this->data['city_data'] = array_values($loc);

        $this->data['demo'] = array_values($result1);

// CODE FOR SECOND HEADER SEARCH END
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
        $businessdata1 = $this->data['businessdata1'] = $this->common->select_data_by_condition('business_profile', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
     
        $contition_array = array('user_id' => $businessdata1[0]['user_id']);
        $businessimage = $this->data['businessimage'] = $this->common->select_data_by_condition('business_profile_post', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        foreach ($businessimage as $val) {
            $contition_array = array('post_id' => $val['business_profile_post_id'], 'is_deleted' => '1', 'image_type' => '2');
            $busmultiimage = $this->data['busmultiimage'] = $this->common->select_data_by_condition('post_image', $contition_array, $data = '*', $sortby = 'post_id', $orderby = 'DESC', $limit = '', $offset = '', $join_str = array(), $groupby = '');

            $multipleimage[] = $busmultiimage;
        }
        $allowed = array('jpg', 'jpeg', 'PNG', 'gif', 'png', 'psd', 'bmp', 'tiff', 'iff', 'xbm', 'webp');

        foreach ($multipleimage as $mke => $mval) {

            foreach ($mval as $mke1 => $mval1) {
                $ext = pathinfo($mval1['image_name'], PATHINFO_EXTENSION);

                if (in_array($ext, $allowed)) {
                    $singlearray[] = $mval1;
                }
            }
        }
        if ($singlearray) {
            $i = 0;
            foreach ($singlearray as $mi) {
                $fetch_result .= '<div class="image_profile">';
                $fetch_result .= '<img src="' . base_url($this->config->item('bus_post_thumb_upload_path') . $mi['image_name']) . '" alt="img1">';
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

        $id = $_POST['bus_slug'];
// manage post start
        $userid = $this->session->userdata('aileenuser');
        $user_name = $this->session->userdata('user_name');

//if user deactive profile then redirect to business_profile/index untill active profile start
        $contition_array = array('user_id' => $userid, 'status' => '0', 'is_deleted' => '0');

        $business_deactive = $this->data['business_deactive'] = $this->common->select_data_by_condition('business_profile', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);

        if ($business_deactive) {
            redirect('business_profile/');
        }
//if user deactive profile then redirect to business_profile/index untill active profile End

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
        $busvideo = $this->data['busvideo'] = $this->common->select_data_by_condition('business_profile_post', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');


        foreach ($busvideo as $val) {



            $contition_array = array('post_id' => $val['business_profile_post_id'], 'is_deleted' => '1', 'image_type' => '2');
            $busmultivideo = $this->data['busmultivideo'] = $this->common->select_data_by_condition('post_image', $contition_array, $data = '*', $sortby = 'post_id', $orderby = 'DESC', $limit = '', $offset = '', $join_str = array(), $groupby = '');

            $multiplevideo[] = $busmultivideo;
        }

        $allowesvideo = array('mp4', 'webm');

        foreach ($multiplevideo as $mke => $mval) {

            foreach ($mval as $mke1 => $mval1) {
                $ext = pathinfo($mval1['image_name'], PATHINFO_EXTENSION);

                if (in_array($ext, $allowesvideo)) {
                    $singlearray1[] = $mval1;
                }
            }
        }
        if ($singlearray1) {
            $fetch_video .= '<tr>';

            if ($singlearray1[0]['image_name']) {
                $fetch_video .= '<td class="image_profile">';
                $fetch_video .= '<video controls>';

                $fetch_video .= '<source src="' . base_url($this->config->item('bus_post_main_upload_path') . $singlearray1[0]['image_name']) . '" type="video/mp4">';
                $fetch_video .= '<source src="movie.ogg" type="video/ogg">';
                $fetch_video .= 'Your browser does not support the video tag.';
                $fetch_video .= '</video>';
                $fetch_video .= '</td>';
            }

            if ($singlearray1[1]['image_name']) {
                $fetch_video .= '<td class="image_profile">';
                $fetch_video .= '<video  controls>';
                $fetch_video .= '<source src="' . base_url($this->config->item('bus_post_main_upload_path') . $singlearray1[1]['image_name']) . '" type="video/mp4">';
                $fetch_video .= '<source src="movie.ogg" type="video/ogg">';
                $fetch_video .= 'Your browser does not support the video tag.';
                $fetch_video .= '</video>';
                $fetch_video .= '</td>';
            }
            if ($singlearray1[2]['image_name']) {
                $fetch_video .= '<td class="image_profile">';
                $fetch_video .= '<video  controls>';
                $fetch_video .= '<source src="' . base_url($this->config->item('bus_post_main_upload_path') . $singlearray1[2]['image_name']) . '" type="video/mp4">';
                $fetch_video .= '<source src="movie.ogg" type="video/ogg">';
                $fetch_video .= 'Your browser does not support the video tag.';
                $fetch_video .= '</video>';
                $fetch_video .= '</td>';
            }
            $fetch_video .= '</tr>';
            $fetch_video .= '<tr>';

            if ($singlearray1[3]['image_name']) {
                $fetch_video .= '<td class="image_profile">';
                $fetch_video .= '<video  controls>';
                $fetch_video .= '<source src="' . base_url($this->config->item('bus_post_main_upload_path') . $singlearray1[3]['image_name']) . '" type="video/mp4">';
                $fetch_video .= '<source src="movie.ogg" type="video/ogg">';
                $fetch_video .= 'Your browser does not support the video tag.';
                $fetch_video .= '</video>';
                $fetch_video .= '</td>';
            }
            if ($singlearray1[4]['image_name']) {
                $fetch_video .= '<td class="image_profile">';
                $fetch_video .= '<video  controls>';
                $fetch_video .= '<source src="' . base_url($this->config->item('bus_post_main_upload_path') . $singlearray1[4]['image_name']) . '" type="video/mp4">';
                $fetch_video .= '<source src="movie.ogg" type="video/ogg">';
                $fetch_video .= 'Your browser does not support the video tag.';
                $fetch_video .= '</video>';
                $fetch_video .= '</td>';
            }
            if ($singlearray1[5]['image_name']) {
                $fetch_video .= '<td class="image_profile">';
                $fetch_video .= '<video  controls>';
                $fetch_video .= '<source src="' . base_url($this->config->item('bus_post_main_upload_path') . $singlearray1[5]['image_name']) . '" type="video/mp4">';
                $fetch_video .= '<source src="movie.ogg" type="video/ogg">';
                $fetch_video .= 'Your browser does not support the video tag.';
                $fetch_video .= '</video>';
                $fetch_video .= '</td>';
            }
            $fetch_video .= '</tr>';
        } else {


            $fetch_video .= '<div class="not_available">  <p>     Video Not Available </p></div>';
        }

        $fetch_video .= '<div class="dataconvideo"></div>';


        echo $fetch_video;
    }

    public function bus_user_audio() {

        $id = $_POST['bus_slug'];
// manage post start
        $userid = $this->session->userdata('aileenuser');
        $user_name = $this->session->userdata('user_name');

//if user deactive profile then redirect to business_profile/index untill active profile start
        $contition_array = array('user_id' => $userid, 'status' => '0', 'is_deleted' => '0');

        $business_deactive = $this->data['business_deactive'] = $this->common->select_data_by_condition('business_profile', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);

        if ($business_deactive) {
            redirect('business_profile/');
        }
//if user deactive profile then redirect to business_profile/index untill active profile End

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



            $contition_array = array('post_id' => $val['business_profile_post_id'], 'is_deleted' => '1', 'image_type' => '2');
            $busmultiaudio = $this->data['busmultiaudio'] = $this->common->select_data_by_condition('post_image', $contition_array, $data = '*', $sortby = 'post_id', $orderby = 'DESC', $limit = '', $offset = '', $join_str = array(), $groupby = '');

            $multipleaudio[] = $busmultiaudio;
        }

        $allowesaudio = array('mp3');

        foreach ($multipleaudio as $mke => $mval) {

            foreach ($mval as $mke1 => $mval1) {
                $ext = pathinfo($mval1['image_name'], PATHINFO_EXTENSION);

                if (in_array($ext, $allowesaudio)) {
                    $singlearray2[] = $mval1;
                }
            }
        }
        if ($singlearray2) {
            $fetchaudio .= '<tr>';

            if ($singlearray2[0]['image_name']) {
                $fetchaudio .= '<td class="image_profile">';
                $fetchaudio .= '<video  controls>';

                $fetchaudio .= '<source src="' . base_url($this->config->item('bus_post_main_upload_path') . $singlearray2[0]['image_name']) . '" type="audio/mp3">';
                $fetchaudio .= '<source src="movie.ogg" type="audio/mp3">';
                $fetchaudio .= 'Your browser does not support the audio tag.';
                $fetchaudio .= '</video>';
                $fetchaudio .= '</td>';
            }

            if ($singlearray2[1]['image_name']) {
                $fetchaudio .= '<td class="image_profile">';
                $fetchaudio .= '<video  controls>';
                $fetchaudio .= '<source src="' . base_url($this->config->item('bus_post_main_upload_path') . $singlearray2[1]['image_name']) . '" type="audio/mp3">';
                $fetchaudio .= '<source src="movie.ogg" type="audio/mp3">';
                $fetchaudio .= 'Your browser does not support the audio tag.';
                $fetchaudio .= '</video>';
                $fetchaudio .= '</td>';
            }
            if ($singlearray2[2]['image_name']) {
                $fetchaudio .= '<td class="image_profile">';
                $fetchaudio .= '<video  controls>';
                $fetchaudio .= '<source src="' . base_url($this->config->item('bus_post_main_upload_path') . $singlearray2[2]['image_name']) . '" type="audio/mp3">';
                $fetchaudio .= '<source src="movie.ogg" type="audio/mp3">';
                $fetchaudio .= 'Your browser does not support the audio tag.';
                $fetchaudio .= '</video>';
                $fetchaudio .= '</td>';
            }
            $fetchaudio .= '</tr>';
            $fetchaudio .= '<tr>';

            if ($singlearray2[3]['image_name']) {
                $fetchaudio .= '<td class="image_profile">';
                $fetchaudio .= '<video  controls>';
                $fetchaudio .= '<source src="' . base_url($this->config->item('bus_post_main_upload_path') . $singlearray2[3]['image_name']) . '" type="audio/mp3">';
                $fetchaudio .= '<source src="movie.ogg" type="audio/mp3">';
                $fetchaudio .= 'Your browser does not support the audio tag.';
                $fetchaudio .= '</video>';
                $fetchaudio .= '</td>';
            }
            if ($singlearray2[4]['image_name']) {
                $fetchaudio .= '<td class="image_profile">';
                $fetchaudio .= '<video  controls>';
                $fetchaudio .= '<source src="' . base_url($this->config->item('bus_post_main_upload_path') . $singlearray2[4]['image_name']) . '" type="audio/mp3">';
                $fetchaudio .= '<source src="movie.ogg" type="audio/mp3">';
                $fetchaudio .= 'Your browser does not support the audio tag.';
                $fetchaudio .= '</video>';
                $fetchaudio .= '</td>';
            }
            if ($singlearray2[5]['image_name']) {
                $fetchaudio .= '<td class="image_profile">';
                $fetchaudio .= '<video  controls>';
                $fetchaudio .= '<source src="' . base_url($this->config->item('bus_post_main_upload_path') . $singlearray2[5]['image_name']) . '" type="audio/mp3">';
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
        $contition_array = array('user_id' => $businessdata1[0]['user_id']);
        $businessimage = $this->data['businessimage'] = $this->common->select_data_by_condition('business_profile_post', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
        foreach ($businessimage as $val) {
            $contition_array = array('post_id' => $val['business_profile_post_id'], 'is_deleted' => '1', 'image_type' => '2');
            $busmultipdf = $this->data['busmultipdf'] = $this->common->select_data_by_condition('post_image', $contition_array, $data = '*', $sortby = 'post_id', $orderby = 'DESC', $limit = '', $offset = '', $join_str = array(), $groupby = '');
            $multiplepdf[] = $busmultipdf;
        }
        $allowed = array('pdf');
        foreach ($multiplepdf as $mke => $mval) {

            foreach ($mval as $mke1 => $mval1) {
                $ext = pathinfo($mval1['image_name'], PATHINFO_EXTENSION);

                if (in_array($ext, $allowed)) {
                    $singlearray3[] = $mval1;
                }
            }
        }

        if ($singlearray3) {

            $i = 0;
            foreach ($singlearray3 as $mi) {

                $fetch_pdf .= '<div class="image_profile">';
                $fetch_pdf .= '<a href="javascript:void(0);" onclick="login_profile();"><div class="pdf_img">';
                $fetch_pdf .= '<img src="' . base_url('images/PDF.jpg') . '" style="height: 100%; width: 100%;">';
                $fetch_pdf .= '</div></a>';
                $fetch_pdf .= '</div>';

                $i++;
                if ($i == 6)
                    break;
            }
        } else {
            $fetch_pdf .= '<div class="not_available">  <p> Pdf Not Available </p></div>';
        }
        $fetch_pdf .= '<div class="dataconpdf"></div>';
        echo $fetch_pdf;
    }

    public function business_user_dashboard_post($id = '') {
// manage post start
        $userid = $this->session->userdata('aileenuser');
        $user_name = $this->session->userdata('user_name');

        $contition_array = array('user_id' => $userid, 'status' => '1');
        $slug_data = $this->common->select_data_by_condition('business_profile', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        $slug_id = $slug_data[0]['business_slug'];
        if ($id == $slug_id || $id == '') {
            $contition_array = array('business_slug' => $slug_id, 'status' => '1');
            $businessdata1 = $this->common->select_data_by_condition('business_profile', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

            $contition_array = array('user_id' => $businessdata1[0]['user_id'], 'status' => 1, 'is_delete' => '0');
            $business_profile_data = $this->common->select_data_by_condition('business_profile_post', $contition_array, $data, $sortby = 'business_profile_post_id', $orderby = 'DESC', $limit = '', $offset = '', $join_str = array(), $groupby = '');
        } else {
            $contition_array = array('business_slug' => $id, 'status' => '1', 'business_step' => 4);
            $businessdata1 = $this->common->select_data_by_condition('business_profile', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

            $contition_array = array('user_id' => $businessdata1[0]['user_id'], 'status' => 1, 'is_delete' => '0');
            $business_profile_data = $this->common->select_data_by_condition('business_profile_post', $contition_array, $data, $sortby = 'business_profile_post_id', $orderby = 'DESC', $limit = '', $offset = '', $join_str = array(), $groupby = '');
        }

        $return_html = '';

        if (count($business_profile_data) > 0) {
            foreach ($business_profile_data as $row) {
                $contition_array = array('user_id' => $row['user_id'], 'status' => '1');
                $businessdata = $this->common->select_data_by_condition('business_profile', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

                $return_html .= '<div id="removepost' . $row['business_profile_post_id'] . '">
                    <div class="">
                        <div class="post-design-box">
                            <div class="post-design-top col-md-12" >  
                                <div class="post-design-pro-img">';
                $userid = $this->session->userdata('aileenuser');
                $userimage = $this->db->get_where('business_profile', array('user_id' => $row['user_id']))->row()->business_user_image;

                $userimageposted = $this->db->get_where('business_profile', array('user_id' => $row['posted_user_id']))->row()->business_user_image;

                $username = $this->db->get_where('business_profile', array('user_id' => $row['user_id']))->row()->company_name;

                $userimageposted = $this->db->get_where('business_profile', array('user_id' => $row['posted_user_id']))->row()->business_user_image;
                if ($row['posted_user_id']) {
                    if ($userimageposted) {
                        $return_html .= '<img src="' . base_url($this->config->item('bus_profile_thumb_upload_path') . $userimageposted) . '" name="image_src" id="image_src" />';
                    } else {
                        $a = $userimageposted;
                        $acr = substr($a, 0, 1);

                        $return_html .= '<div class="post-img-div">';
                        $return_html .= ucwords($acr);
                        $return_html .= '</div>';
                    }
                } else {
                    if ($userimage) {
                        $return_html .= '<img src="' . base_url($this->config->item('bus_profile_thumb_upload_path') . $userimage) . '" name="image_src" id="image_src" />';
                    } else {
                        $a = $userimage;
                        $acr = substr($a, 0, 1);

                        $return_html .= '<div class="post-img-div">';
                        $return_html .= ucwords($acr);
                        $return_html .= '</div>';
                    }
                }
                $return_html .= '</div>
                                <div class="post-design-name fl col-xs-8 col-md-10">
                                    <ul>';
                $companyname = $this->db->get_where('business_profile', array('user_id' => $row['user_id']))->row()->company_name;
                $slugname = $this->db->get_where('business_profile', array('user_id' => $row['user_id'], 'status' => 1))->row()->business_slug;
                $categoryid = $this->db->get_where('business_profile', array('user_id' => $row['user_id'], 'status' => 1))->row()->industriyal;
                $category = $this->db->get_where('industry_type', array('industry_id' => $categoryid, 'status' => 1))->row()->industry_name;
                $companynameposted = $this->db->get_where('business_profile', array('user_id' => $row['posted_user_id']))->row()->company_name;
                $slugnameposted = $this->db->get_where('business_profile', array('user_id' => $row['posted_user_id'], 'status' => 1))->row()->business_slug;
                if ($row['posted_user_id']) {
                    $return_html .= '<li>
                                                <div class="else_post_d">
                                                    <div class="post-design-product">
                                                        <a onclick="login_profile();" style="max-width: 40%;" class="post_dot" title="' . ucwords($companynameposted) . '" href="javascript:void(0);">' . ucwords($companynameposted) . '</a>
                                                        <p class="posted_with" > Posted With</p>
                                                        <a onclick="login_profile();" class="other_name post_dot" href="javascript:void(0);">' . ucwords($companyname) . '</a>
                                                        <span role="presentation" aria-hidden="true"> · </span> <span class="ctre_date">' . $this->common->time_elapsed_string(date('Y-m-d H:i:s', strtotime($row['created_date']))) . '</span> 
                                                    </div></div>
                                            </li>';
                } else {
                    $return_html .= '<li><div class="post-design-product"><a onclick="login_profile();" class="post_dot" title="' . ucwords($companyname) . '" href="javascript:void(0);">' . ucwords($companyname) . '</a>
                                                    <span role="presentation" aria-hidden="true"> · </span>
                                                    <div class="datespan"> 
                                                        <span class="ctre_date">' . $this->common->time_elapsed_string(date('Y-m-d H:i:s', strtotime($row['created_date']))) . '</span> 
                                                    </div>
                                                </div>
                                            </li>';
                }
                $category = $this->db->get_where('industry_type', array('industry_id' => $businessdata[0]['industriyal'], 'status' => 1))->row()->industry_name;
                $return_html .= '<li><div class="post-design-product">   <a onclick="login_profile();" class="buuis_desc_a"  title="Category">';

                if ($category) {
                    $return_html .= ucwords($category);
                } else {
                    $return_html .= ucwords($businessdata[0]['other_industrial']);
                }

                $return_html .= '</a> </div>
</li>
<li>
</li>
</ul>
</div>
<div class = "dropdown1">
<a onClick = "myFunction1(' . $row['business_profile_post_id'] . ')" class = "dropbtn1 dropbtn1 fa fa-ellipsis-v"></a>
<div id = "myDropdown' . $row['business_profile_post_id'] . '" class = "dropdown-content2">';
                if ($row['posted_user_id'] != 0) {
                    if ($this->session->userdata('aileenuser') == $row['posted_user_id']) {
                        $return_html .= '<a onclick="login_profile();">
    <i class="fa fa-trash-o" aria-hidden="true">
    </i> Delete Post
</a>
<a id="' . $row['business_profile_post_id'] . '" onclick="login_profile();">
    <i class="fa fa-pencil-square-o" aria-hidden="true">
    </i>Edit
</a>';
                    } else {
                        $return_html .= '<a onclick="login_profile();">
    <i class="fa fa-trash-o" aria-hidden="true">
    </i> Delete Post
</a>
<a onclick="login_profile();" href="javascript:void(0);">
    <i class="fa fa-user" aria-hidden="true">
    </i> Contact Person
</a>';
                    }
                } else {
                    if ($this->session->userdata('aileenuser') == $row['user_id']) {
                        $return_html .= '<a onclick="login_profile();"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete Post</a>
<a id="' . $row['business_profile_post_id'] . '" onclick="login_profile();"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Edit</a>';
                    } else {
                        $return_html .= '<a onclick="login_profile();" href="javascript:void(0);"><i class="fa fa-user" aria-hidden="true"></i> Contact Person</a>';
                    }
                }
                $return_html .= '</div>
</div>';
                if ($row['product_name'] || $row['product_description']) {
                    $return_html .= '<div class="post-design-desc ">';
                }
                $return_html .= '<div class="ft-15 t_artd">
        <div id="editpostdata' . $row['business_profile_post_id'] . '" style="display:block;">
            <a onclick="login_profile();">' . $this->common->make_links($row['product_name']) . '</a>
        </div>
        <div id="editpostbox' . $row['business_profile_post_id'] . '" style="display:none;">
            <input type="text" id="editpostname' . $row['business_profile_post_id'] . '" name="editpostname" placeholder="Product Name" value="' . $row['product_name'] . '" onKeyDown=check_lengthedit(' . $row['business_profile_post_id'] . ') onKeyup=check_lengthedit(' . $row['business_profile_post_id'] . '); onblur=check_lengthedit(' . $row['business_profile_post_id'] . ')>';
                if ($row['product_name']) {
                    $counter = $row['product_name'];
                    $a = strlen($counter);
                    $return_html .= '<input size=1 id="text_num" class="text_num" value="' . (50 - $a) . '" name=text_num readonly>';
                } else {
                    $return_html .= '<input size=1 id="text_num" class="text_num" value=50 name=text_num readonly>';
                }
                $return_html .= '</div>
    </div>
    <div id="khyati' . $row['business_profile_post_id'] . '" style="display:block;">';
                $small = substr($row['product_description'], 0, 180);
                $return_html .= $this->common->make_links($small);
                if (strlen($row['product_description']) > 180) {
                    $return_html .= '... <span id="kkkk" onClick="khdiv(' . $row['business_profile_post_id'] . ')">View More</span>';
                }
                $return_html .= '</div>
    <div id="khyatii' . $row['business_profile_post_id'] . '" style="display:none;">';
                $return_html .= $row['product_description'];
                $return_html .= '</div>
    <div id="editpostdetailbox' . $row['business_profile_post_id'] . '" style="display:none;">
        <div contenteditable="true" id="editpostdesc' . $row['business_profile_post_id'] . '" placeholder="Product Description" class="textbuis editable_text" placeholder="Description of Your Product"  name="editpostdesc" onpaste="OnPaste_StripFormatting(this, event);">' . $row['product_description'] . '</div>
    </div>
    <button class="fr" id="editpostsubmit"' . $row['business_profile_post_id'] . '" style="display:none;margin: 5px 0;" onClick="edit_postinsert(' . $row['business_profile_post_id'] . ')">Save</button>
</div> ';
                if ($row['product_name'] || $row['product_description']) {
                    $return_html .= '</div>';
                }
                $return_html .= '<div class="post-design-mid col-md-12" >  
    <div class="mange_post_image">';

                $contition_array = array('post_id' => $row['business_profile_post_id'], 'is_deleted' => '1', 'image_type' => '2');
                $businessmultiimage = $this->data['businessmultiimage'] = $this->common->select_data_by_condition('post_image', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
                if (count($businessmultiimage) == 1) {

                    $allowed = array('jpg', 'jpeg', 'PNG', 'gif', 'png', 'psd', 'bmp', 'tiff', 'iff', 'xbm', 'webp');
                    $allowespdf = array('pdf');
                    $allowesvideo = array('mp4', 'webm');
                    $allowesaudio = array('mp3');
                    $filename = $businessmultiimage[0]['image_name'];
                    $ext = pathinfo($filename, PATHINFO_EXTENSION);
                    if (in_array($ext, $allowed)) {
                        $return_html .= '<div class="one-image">
            <a onclick="login_profile();" href="javascript:void(0);"><img src="' . base_url($this->config->item('bus_post_main_upload_path') . $businessmultiimage[0]['image_name']) . '"> </a>
        </div>';
                    } elseif (in_array($ext, $allowespdf)) {

                        $return_html .= '<div>
            <a onclick="login_profile();" href="javascript:void(0);"><div class="pdf_img">
                    <img src="' . base_url('images/PDF.jpg') . '" style="height: 100%; width: 100%;">
                </div></a>
        </div>';
                    } elseif (in_array($ext, $allowesvideo)) {
                        $return_html .= '<div>
            <video class="video" width="100%" height="350" controls>
                <source src="' . base_url($this->config->item('bus_post_main_upload_path') . $businessmultiimage[0]['image_name']) . '" type="video/mp4">
                <source src="movie.ogg" type="video/ogg">
                Your browser does not support the video tag.
            </video>
        </div>';
                    } elseif (in_array($ext, $allowesaudio)) {
                        $return_html .= '<div class="audio_main_div">
            <div class="audio_img">
                <img src="' . base_url('images/music-icon.png') . '">  
            </div>
            <div class="audio_source">
                <audio  controls>
                    <source src="' . base_url($this->config->item('bus_post_main_upload_path') . $businessmultiimage[0]['image_name']) . '" type="audio/mp3">
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
            <a onclick="login_profile();" href="' . base_url('business-profile/post-detail/' . $row['business_profile_post_id']) . '"><img class="two-columns" src="' . base_url($this->config->item('bus_post_thumb_upload_path') . $multiimage['image_name']) . '" style="width: 100%; height: 100%;"> </a>
        </div>';
                    }
                } elseif (count($businessmultiimage) == 3) {
                    $return_html .= '<div class="three-imag-top" >
            <a onclick="login_profile();" href="' . base_url('business-profile/post-detail/' . $row['business_profile_post_id']) . '"><img class="three-columns" src="' . base_url($this->config->item('bus_post_main_upload_path') . $businessmultiimage[0]['image_name']) . '" style="width: 100%; height:100%; "> </a>
        </div>
        <div class="three-image" >
            <a onclick="login_profile();" href="' . base_url('business-profile/post-detail/' . $row['business_profile_post_id']) . '"><img class="three-columns" src="' . base_url($this->config->item('bus_post_thumb_upload_path') . $businessmultiimage[1]['image_name']) . '" style="width: 100%; height:100%; "> </a>
        </div>
        <div class="three-image" >
            <a onclick="login_profile();" href="' . base_url('business-profile/post-detail/' . $row['business_profile_post_id']) . '"><img class="three-columns" src="' . base_url($this->config->item('bus_post_thumb_upload_path') . $businessmultiimage[2]['image_name']) . '" style="width: 100%; height:100%; "> </a>
        </div>';
                } elseif (count($businessmultiimage) == 4) {

                    foreach ($businessmultiimage as $multiimage) {
                        $return_html .= '<div class="four-image">
            <a onclick="login_profile();" href="' . base_url('business-profile/post-detail/' . $row['business_profile_post_id']) . '"><img class="breakpoint" src="' . base_url($this->config->item('bus_post_thumb_upload_path') . $multiimage['image_name']) . '" style="width: 100%; height: 100%;"> </a>
        </div>';
                    }
                } elseif (count($businessmultiimage) > 4) {

                    $i = 0;
                    foreach ($businessmultiimage as $multiimage) {
                        $return_html .= '<div class="four-image">
            <a onclick="login_profile();" href="' . base_url('business-profile/post-detail/' . $row['business_profile_post_id']) . '"><img src="' . base_url($this->config->item('bus_post_thumb_upload_path') . $multiimage['image_name']) . '" > </a>
        </div>';
                        $i++;
                        if ($i == 3)
                            break;
                    }
                    $return_html .= '<div class="four-image">
            <a onclick="login_profile();" href="' . base_url('business-profile/post-detail/' . $row['business_profile_post_id']) . '"><img src="' . base_url($this->config->item('bus_post_thumb_upload_path') . $businessmultiimage[3]['image_name']) . '" style=" width: 100%; height: 100%;"> </a>
            <a onclick="login_profile();" href="' . base_url('business-profile/post-detail/' . $row['business_profile_post_id']) . '">
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
                <a class="ripple like_h_w" id="' . $row['business_profile_post_id'] . '"   onclick="login_profile();">';
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

                $return_html .= '<a class="ripple like_h_w" onclick="login_profile();" id="' . $row['business_profile_post_id'] . '"><i class="fa fa-comment-o" aria-hidden="true">';
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
                    $return_html .= '<a href="javascript:void(0);"  onclick="login_profile();">';
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
                        $return_html .= ucwords($business_fname1);
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
                $return_html .= '<a href="javascript:void(0);"  onclick="login_profile();">';
                $contition_array = array('business_profile_post_id' => $row['business_profile_post_id'], 'status' => '1', 'is_delete' => '0');
                $commnetcount = $this->common->select_data_by_condition('business_profile_post', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

                $likeuser = $commnetcount[0]['business_like_user'];
                $countlike = $commnetcount[0]['business_likes_count'] - 1;
                $likelistarray = explode(',', $likeuser);

                $business_fname1 = $this->db->get_where('business_profile', array('user_id' => $value, 'status' => 1))->row()->company_name;
                $return_html .= '<div class="like_one_other">';
                $return_html .= ucwords($business_fname1);
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
                        $return_html .= '<div class="all-comment-comment-box">
                <div class="post-design-pro-comment-img">';
                        $business_userimage = $this->db->get_where('business_profile', array('user_id' => $rowdata['user_id'], 'status' => 1))->row()->business_user_image;
                        if ($business_userimage) {
                            $return_html .= '<img  src="' . base_url($this->config->item('bus_profile_thumb_upload_path') . $business_userimage) . '"  alt="">';
                        } else {
                            $a = $companyname;
                            $acr = substr($a, 0, 1);

                            $return_html .= '<div class="post-img-div">';
                            $return_html .= ucwords($acr);
                            $return_html .= '</div>';
                        }
                        $return_html .= '</div>
                <div class="comment-name">
                    <b>';
                        $return_html .= ucwords($companyname);
                        $return_html .= '</br>';

                        $return_html .= '</b>
                </div>
                <div class="comment-details" id= "showcomment' . $rowdata['business_profile_post_comment_id'] . '">
                    <div id="lessmore' . $rowdata['business_profile_post_comment_id'] . '" style="display:block;">';
                        $small = substr($rowdata['comments'], 0, 180);
                        $return_html .= $this->common->make_links($small);

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
                        <a id="' . $rowdata['business_profile_post_comment_id'] . '" onclick="login_profile();">';
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
                            <a id="' . $rowdata['business_profile_post_comment_id'] . '"   onclick="login_profile();" class="editbox">Edit
                            </a>
                        </div>
                        <div id="editcancle' . $rowdata['business_profile_post_comment_id'] . '" style="display:none;">
                            <a id="' . $rowdata['business_profile_post_comment_id'] . '" onclick="login_profile();">Cancel
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
                        <a id="' . $rowdata['business_profile_post_comment_id'] . '"   onclick="login_profile();"> Delete<span class="insertcomment' . $rowdata['business_profile_post_comment_id'] . '">
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
</div>
</div> </div>';
            }
        } else {
            $return_html .= '<div class="art_no_post_avl">
                                <h3> Post</h3>
                                <div class="art-img-nn">
                                    <div class="art_no_post_img">

                                        <img src="' . base_url('img/bui-no.png') . '">

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

}
