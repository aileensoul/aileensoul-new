<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Bus_khyati extends MY_Controller {

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
   
    
         public function business_profile_manage_post($id = "") {
             
         $this->data['slugid'] = $id;    

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

            $contition_array = array('user_id' => $businessdata1[0]['user_id'], 'status' => 1, 'is_delete' => '0');
            $this->data['business_profile_data'] = $this->common->select_data_by_condition('business_profile_post', $contition_array, $data, $sortby = 'business_profile_post_id', $orderby = 'DESC', $limit = '', $offset = '', $join_str = array(), $groupby = '');

            //echo "<pre>"; print_r($this->data['business_profile_data']); die();
        } else {

            $contition_array = array('business_slug' => $id, 'status' => '1', 'business_step' => 4);
            $businessdata1 = $this->data['businessdata1'] = $this->common->select_data_by_condition('business_profile', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

            $contition_array = array('user_id' => $businessdata1[0]['user_id'], 'status' => 1, 'is_delete' => '0');


            $this->data['business_profile_data'] = $this->common->select_data_by_condition('business_profile_post', $contition_array, $data, $sortby = 'business_profile_post_id', $orderby = 'DESC', $limit = '', $offset = '', $join_str = array(), $groupby = '');

            //echo "<pre>"; print_r($this->data['business_profile_data']); die();
        }

        //manage post end
// code for search

        $contition_array = array('status' => '1', 'is_deleted' => '0', 'business_step' => 4);


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


        $contition_array = array('status' => '1');
        $location_list = $this->common->select_data_by_condition('cities', $contition_array, $data = 'city_name', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);


        foreach ($location_list as $key1 => $value1) {
            foreach ($value1 as $ke1 => $val1) {
                $location[] = $val1;
            }
        }
        //echo "<pre>"; print_r($location);die();
        foreach ($location as $key => $value) {
            $loc[$key]['label'] = $value;
            $loc[$key]['value'] = $value;
        }

        //echo "<pre>"; print_r($loc);die();
        // echo "<pre>"; print_r($loc);
        // echo "<pre>"; print_r($result1);die();

        $this->data['city_data'] = array_values($loc);
        $this->data['demo'] = $result1;
        // echo '<pre>'; print_r($result1); die();
        //echo "<pre>"; print_r($this->data['business_profile_data']); die();
        $this->load->view('business_profile/bus_khyati_photo', $this->data);

        // save post end       
    }
    
    public function bus_photos(){
        
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
      $fetch_result .=    '<div class="image_profile">';
      $fetch_result .=   '<img src="' . base_url($this->config->item('bus_post_thumb_upload_path') . $mi['image_name']) . '" alt="img1">';
      $fetch_result .=  '</div>';
                                      
                                        $i++;
                                        if ($i == 6)
                                            break;
                                    }
                                     } else { 

      $fetch_result .=  '<div class="not_available">  <p>     Photos Not Available </p></div>';

                           } 

      $fetch_result .= '<div class="dataconphoto"></div>';

      echo $fetch_result;
    }
    
    public function bus_videos(){
          
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
                 $fetch_video .=  '<tr>';

                                            if ($singlearray1[0]['image_name']) { 
                    $fetch_video .=  '<td class="image_profile">'; 
                    $fetch_video .=   '<video controls>';

                     $fetch_video .=  '<source src="' .  base_url($this->config->item('bus_post_main_upload_path') . $singlearray1[0]['image_name']) . '" type="video/mp4">';
                     $fetch_video .=   '<source src="movie.ogg" type="video/ogg">';
                     $fetch_video .=   'Your browser does not support the video tag.';
                     $fetch_video .=    '</video>';
                     $fetch_video .=   '</td>';
                                            } 

                                             if ($singlearray1[1]['image_name']) { 
                     $fetch_video .=  '<td class="image_profile">';
                     $fetch_video .=  '<video  controls>';
                     $fetch_video .=  '<source src="' . base_url($this->config->item('bus_post_main_upload_path') . $singlearray1[1]['image_name']) . '" type="video/mp4">';
                     $fetch_video .=  '<source src="movie.ogg" type="video/ogg">';
                     $fetch_video .=  'Your browser does not support the video tag.';
                     $fetch_video .=  '</video>';
                     $fetch_video .=  '</td>';
                                            } 
                                           if ($singlearray1[2]['image_name']) { 
                      $fetch_video .=  '<td class="image_profile">';
                      $fetch_video .=  '<video  controls>';
                      $fetch_video .=  '<source src="' . base_url($this->config->item('bus_post_main_upload_path') . $singlearray1[2]['image_name']) . '" type="video/mp4">';
                      $fetch_video .=  '<source src="movie.ogg" type="video/ogg">';
                      $fetch_video .=  'Your browser does not support the video tag.';
                      $fetch_video .=  '</video>';
                      $fetch_video .=  '</td>';
                                            } 
                      $fetch_video .=   '</tr>';
                      $fetch_video .=  '<tr>';

                                        if ($singlearray1[3]['image_name']) { 
                       $fetch_video .=  '<td class="image_profile">'; 
                       $fetch_video .=  '<video  controls>';
                       $fetch_video .=  '<source src="' . base_url($this->config->item('bus_post_main_upload_path') . $singlearray1[3]['image_name']) . '" type="video/mp4">';
                       $fetch_video .=  '<source src="movie.ogg" type="video/ogg">';
                       $fetch_video .=  'Your browser does not support the video tag.';
                       $fetch_video .=  '</video>';
                       $fetch_video .=  '</td>';
                                          } 
                                      if ($singlearray1[4]['image_name']) { 
                         $fetch_video .=  '<td class="image_profile">';
                         $fetch_video .=  '<video  controls>';
                         $fetch_video .=  '<source src="' . base_url($this->config->item('bus_post_main_upload_path') . $singlearray1[4]['image_name']) . '" type="video/mp4">';
                         $fetch_video .=  '<source src="movie.ogg" type="video/ogg">';
                         $fetch_video .=  'Your browser does not support the video tag.';
                         $fetch_video .=  '</video>';
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
    
    public function bus_audio(){
        
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
               $fetchaudio .=   '<tr>';

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
                $fetchaudio .=  '<td class="image_profile">';
                $fetchaudio .=  '<video  controls>';
                $fetchaudio .=  '<source src="' . base_url($this->config->item('bus_post_main_upload_path') . $singlearray2[1]['image_name']) . '" type="audio/mp3">';
                $fetchaudio .=  '<source src="movie.ogg" type="audio/mp3">';
                $fetchaudio .=  'Your browser does not support the audio tag.';
                $fetchaudio .=  '</video>';
                $fetchaudio .= '</td>';
                                            } 
                                            if ($singlearray2[2]['image_name']) { 
                $fetchaudio .= '<td class="image_profile">';
                $fetchaudio .= '<video  controls>';
                $fetchaudio .= '<source src="' . base_url($this->config->item('bus_post_main_upload_path') . $singlearray2[2]['image_name']) . '" type="audio/mp3">';
                $fetchaudio .=  '<source src="movie.ogg" type="audio/mp3">';
                $fetchaudio .=  'Your browser does not support the audio tag.';
                $fetchaudio .=  '</video>';
                $fetchaudio .=  '</td>';
                                    } 
                $fetchaudio .=  '</tr>';
                $fetchaudio .=  '<tr>';

                                     if ($singlearray2[3]['image_name']) { 
                $fetchaudio .=  '<td class="image_profile">'; 
                $fetchaudio .=  '<video  controls>';
                $fetchaudio .=  '<source src="' . base_url($this->config->item('bus_post_main_upload_path') . $singlearray2[3]['image_name']) . '" type="audio/mp3">';
                $fetchaudio .=  '<source src="movie.ogg" type="audio/mp3">';
                $fetchaudio .=  'Your browser does not support the audio tag.';
                $fetchaudio .=  '</video>';
                $fetchaudio .=  '</td>';
                                            }
                                        if ($singlearray2[4]['image_name']) {
                $fetchaudio .=   '<td class="image_profile">';
                $fetchaudio .=   '<video  controls>';
                $fetchaudio .=   '<source src="' . base_url($this->config->item('bus_post_main_upload_path') . $singlearray2[4]['image_name']) . '" type="audio/mp3">';
                $fetchaudio .=   '<source src="movie.ogg" type="audio/mp3">';
                $fetchaudio .=   'Your browser does not support the audio tag.';
                $fetchaudio .=   '</video>';
                $fetchaudio .=   '</td>';
                                         } 
                                         if ($singlearray2[5]['image_name']) {
                $fetchaudio .=   '<td class="image_profile">';
                $fetchaudio .=   '<video  controls>';
                $fetchaudio .=   '<source src="' . base_url($this->config->item('bus_post_main_upload_path') . $singlearray2[5]['image_name']) . '" type="audio/mp3">';
                $fetchaudio .=   '<source src="movie.ogg" type="audio/mp3">';
                $fetchaudio .=   'Your browser does not support the audio tag.';
                $fetchaudio .=   '</video>';
                $fetchaudio .=   '</td>';
                                            } 
                $fetchaudio .= '</tr>';
                                } else { 

                $fetchaudio .=  '<div class="not_available">  <p>   Audio Not Available </p></div>';

                                     } 

                $fetchaudio .=   '<div class="dataconaudio"></div>';
        
                echo $fetchaudio;
    }
    
     public function bus_pdf(){
        
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


       $fetch_pdf .= '<a href="' . base_url('business_profile/creat_pdf/' . $singlearray3[0]['image_id']) . '"><div class="pdf_img">';
       $fetch_pdf .= '<img src="' . base_url('images/PDF.jpg') . '" style="height: 100%; width: 100%;">';
       $fetch_pdf .= '</div></a>';

       $fetch_pdf .=   '</div>';
                                      
                                        $i++;
                                        if ($i == 6)
                                            break;
                                    }
                                   


                                 } else {

        $fetch_pdf .=  '<div class="not_available">  <p> Pdf Not Available </p></div>';

                             } 

        $fetch_pdf .=   '<div class="dataconpdf"></div>';
   
       echo $fetch_pdf;
                                
    }
}
