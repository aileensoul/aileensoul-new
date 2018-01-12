<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class User_opportunities extends MY_Controller {

    public $data;

    public function __construct() {

        parent::__construct();
        $this->load->library('form_validation');
        $this->load->library('user_agent');
        $this->load->model('email_model');
        $this->load->model('user_model');
        $this->load->model('user_opportunity');
        $this->load->model('data_model');
        $this->load->library('S3');
    }

    public function index() {
        $userid = $this->session->userdata('aileenuser');
        $this->data['userdata'] = $this->user_model->getUserSelectedData($userid, $select_data = "u.first_name,u.last_name,ui.user_image");
        $this->data['leftbox_data'] = $this->user_model->getLeftboxData($userid);
        $this->data['is_userBasicInfo'] = $this->user_model->is_userBasicInfo($userid);
        $this->data['is_userStudentInfo'] = $this->user_model->is_userStudentInfo($userid);
        $this->data['header_profile'] = $this->load->view('header_profile', $this->data, TRUE);
        $this->data['n_leftbar'] = $this->load->view('n_leftbar', $this->data, TRUE);
        $this->data['login_footer'] = $this->load->view('login_footer', $this->data, TRUE);
        $this->data['footer'] = $this->load->view('footer', $this->data, TRUE);
        $this->data['title'] = "Opportunities | Aileensoul";
        $this->load->view('user_opportunities/index', $this->data);
    }

    public function getContactSuggetion() {
        $userid = $this->session->userdata('aileenuser');
        $user_data = $this->user_opportunity->getContactSuggetion($userid);
        echo json_encode($user_data);
    }

    public function addToContact() {
        $userid = $this->session->userdata('aileenuser');
        $to_user_id = $_POST['user_id'];
        $return_data = array();
        $checkContactData = $this->user_opportunity->checkContact($userid, $to_user_id);
        if ($checkContactData['total'] == '0') {
            $data = array();
            $data['from_id'] = $userid;
            $data['to_id'] = $to_user_id;
            $data['created_date'] = date('Y-m-d H:i:s', time());
            $data['modify_date'] = date('Y-m-d H:i:s', time());
            $data['status'] = 'pending';
            $data['not_read'] = '2';
            $user_contact = $this->common->insert_data_getid($data, 'user_contact');
            if ($user_contact) {
                $return_data['status'] = 'pending';
                $return_data['message'] = '1';
            } else {
                $return_data['status'] = '';
                $return_data['message'] = '0';
            }
        } else {
            if ($checkContactData['status'] == 'reject' || $checkContactData['status'] == 'cancel') {
                $data = array();
                $data['modify_date'] = date('Y-m-d H:i:s', time());
                $data['status'] = 'pending';
                $data['not_read'] = '2';
                $user_contact = $this->common->update_data($data, 'user_contact', 'id', $checkContactData['id']);
                $return_data['status'] = 'pending';
                $return_data['message'] = '1';
            } elseif ($checkContactData['status'] == 'block') {
                $return_data['status'] = 'block';
                $return_data['message'] = '0';
            } else {
                $return_data['status'] = '';
                $return_data['message'] = '0';
            }
        }
        echo json_encode($return_data);
    }
    
    public function get_jobtitle(){
        $job_title = $this->user_opportunity->get_jobtitle();
        echo json_encode($job_title);
    }
    
    public function post_opportunity() {
        $s3 = new S3(awsAccessKey, awsSecretKey);
        $userid = $this->session->userdata('aileenuser');
        
        $this->config->item('user_post_main_upload_path');
        $config = array(
            'image_library' => 'gd',
            'upload_path' => $this->config->item('user_post_main_upload_path'),
            'allowed_types' => $this->config->item('user_post_main_allowed_types'),
            'overwrite' => true,
            'remove_spaces' => true);
        $images = array();
        $this->load->library('upload');

        $files = $_FILES;
        $count = count($_FILES['postfiles']['name']);
        $title = time();

        $insert_data = array();
        $insert_data['user_id'] = $userid;
        $insert_data['post_for'] = 'opportunity';
        $insert_data['post_id'] = '';
        $insert_data['created_date'] = date('Y-m-d H:i:s', time());
        $insert_data['status'] = 'publish';
        $insert_data['is_delete'] = '0';

        $user_post_id = $this->common->insert_data_getid($insert_data, 'user_post');

        $insert_data = array();
        $insert_data['post_id'] = $user_post_id;
        $insert_data['opportunity_for'] = $_POST['job_title'];
        $insert_data['location'] = $_POST['location'];
        $insert_data['opportunity'] = $_POST['description'];
        $insert_data['field'] = $_POST['field'];
        $insert_data['modify_date'] = date('Y-m-d H:i:s', time());

        $user_opportunity_id = $this->common->insert_data_getid($insert_data, 'user_opportunity');
        
        $update_data = array();
        $update_data['post_id'] = $user_opportunity_id;
        $update_post = $this->common->update_data($update_data, 'user_post', 'id', $user_post_id);

        $s3 = new S3(awsAccessKey, awsSecretKey);
        $s3->putBucket(bucket, S3::ACL_PUBLIC_READ);

        if ($_FILES['postfiles']['name'][0] != '') {

            for ($i = 0; $i < $count; $i++) {

                $_FILES['postfiles']['name'] = $files['postfiles']['name'][$i];
                $_FILES['postfiles']['type'] = $files['postfiles']['type'][$i];
                $_FILES['postfiles']['tmp_name'] = $files['postfiles']['tmp_name'][$i];
                $_FILES['postfiles']['error'] = $files['postfiles']['error'][$i];
                $_FILES['postfiles']['size'] = $files['postfiles']['size'][$i];

                $file_type = $_FILES['postfiles']['type'];
                $file_type = explode('/', $file_type);
                $file_type = $file_type[0];
                if ($file_type == 'image') {
                    $file_type = 'image';
                } elseif ($file_type == 'audio') {
                    $file_type = 'audio';
                } elseif ($file_type == 'video') {
                    $file_type = 'video';
                } else {
                    $file_type = 'pdf';
                }

                if ($_FILES['postfiles']['error'] == 0) {
                    $store = $_FILES['postfiles']['name'];
                    $store_ext = explode('.', $store);
                    $store_ext = end($store_ext);
                    $fileName = 'file_' . $title . '_' . $this->random_string() . '.' . $store_ext;
                    $images[] = $fileName;
                    $config['file_name'] = $fileName;
                    $this->upload->initialize($config);
                    $imgdata = $this->upload->data();

                    if ($this->upload->do_upload('postfiles')) {
                        $upload_data = $response['result'][] = $this->upload->data();

                        if ($file_type == 'video') {
                            $uploaded_url = base_url() . $this->config->item('user_post_main_upload_path') . $response['result'][$i]['file_name'];
                            exec("ffmpeg -i " . $uploaded_url . " -vcodec h264 -acodec aac -strict -2 " . $upload_data['file_path'] . $upload_data['raw_name'] . "1" . $upload_data['file_ext'] . "");
                            exec("ffmpeg -ss 00:00:05 -i " . $upload_data['full_path'] . " " . $upload_data['file_path'] . $upload_data['raw_name'] . "1" . ".png");
                            $fileName = $response['result'][$i]['file_name'] = $upload_data['raw_name'] . "1" . $upload_data['file_ext'];
                            unlink($this->config->item('user_post_main_upload_path') . $upload_data['raw_name'] . "" . $upload_data['file_ext']);
                        }

                        $main_image_size = $_FILES['postfiles']['size'];

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

                        $user_post_main[$i]['image_library'] = 'gd2';
                        $user_post_main[$i]['source_image'] = $this->config->item('user_post_main_upload_path') . $response['result'][$i]['file_name'];
                        $user_post_main[$i]['new_image'] = $this->config->item('user_post_main_upload_path') . $response['result'][$i]['file_name'];
                        $user_post_main[$i]['quality'] = $quality;
                        $instanse10 = "image10_$i";
                        $this->load->library('image_lib', $user_post_main[$i], $instanse10);
                        $this->$instanse10->watermark();

                        /* RESIZE */

                        $main_image = $this->config->item('user_post_main_upload_path') . $response['result'][$i]['file_name'];
                        $abc = $s3->putObjectFile($main_image, bucket, $main_image, S3::ACL_PUBLIC_READ);

                        $post_poster = $response['result'][$i]['file_name'];
                        $post_poster1 = explode('.', $post_poster);
                        $post_poster2 = end($post_poster1);
                        $post_poster = str_replace($post_poster2, 'png', $post_poster);

                        $main_image1 = $this->config->item('user_post_main_upload_path') . $post_poster;
                        $abc = $s3->putObjectFile($main_image1, bucket, $main_image1, S3::ACL_PUBLIC_READ);

                        $image_width = $response['result'][$i]['image_width'];
                        $image_height = $response['result'][$i]['image_height'];


                        if ($count == '3') {
                            /* RESIZE 4 */

                            $resize4_image_width = $this->config->item('user_post_resize4_width');
                            $resize4_image_height = $this->config->item('user_post_resize4_height');


                            if ($image_width > $image_height) {
                                $n_h1 = $resize4_image_height;
                                $image_ratio = $image_height / $n_h1;
                                $n_w1 = round($image_width / $image_ratio);
                            } else if ($image_width < $image_height) {
                                $n_w1 = $resize4_image_width;
                                $image_ratio = $image_width / $n_w1;
                                $n_h1 = round($image_height / $image_ratio);
                            } else {
                                $n_w1 = $resize4_image_width;
                                $n_h1 = $resize4_image_height;
                            }

                            $left = ($n_w1 / 2) - ($resize4_image_width / 2);
                            $top = ($n_h1 / 2) - ($resize4_image_height / 2);

                            $user_post_resize4[$i]['image_library'] = 'gd2';
                            $user_post_resize4[$i]['source_image'] = $this->config->item('user_post_main_upload_path') . $response['result'][$i]['file_name'];
                            $user_post_resize4[$i]['new_image'] = $this->config->item('user_post_resize4_upload_path') . $response['result'][$i]['file_name'];
                            $user_post_resize4[$i]['create_thumb'] = TRUE;
                            $user_post_resize4[$i]['maintain_ratio'] = TRUE;
                            $user_post_resize4[$i]['thumb_marker'] = '';
                            $user_post_resize4[$i]['width'] = $n_w1;
                            $user_post_resize4[$i]['height'] = $n_h1;
                            $user_post_resize4[$i]['quality'] = "100%";
                            $instanse4 = "image4_$i";
                            //Loading Image Library
                            $this->load->library('image_lib', $user_post_resize4[$i], $instanse4);
                            //Creating Thumbnail
                            $this->$instanse4->resize();
                            $this->$instanse4->clear();

                            $resize_image4 = $this->config->item('user_post_resize4_upload_path') . $response['result'][$i]['file_name'];
                            $abc = $s3->putObjectFile($resize_image4, bucket, $resize_image4, S3::ACL_PUBLIC_READ);
                            /* RESIZE 4 */
                        }

                        $thumb_image_width = $this->config->item('user_post_thumb_width');
                        $thumb_image_height = $this->config->item('user_post_thumb_height');


                        if ($image_width > $image_height) {
                            $n_h = $thumb_image_height;
                            $image_ratio = $image_height / $n_h;
                            $n_w = round($image_width / $image_ratio);
                        } else if ($image_width < $image_height) {
                            $n_w = $thumb_image_width;
                            $image_ratio = $image_width / $n_w;
                            $n_h = round($image_height / $image_ratio);
                        } else {
                            $n_w = $thumb_image_width;
                            $n_h = $thumb_image_height;
                        }

                        $user_post_thumb[$i]['image_library'] = 'gd2';
                        $user_post_thumb[$i]['source_image'] = $this->config->item('user_post_main_upload_path') . $response['result'][$i]['file_name'];
                        $user_post_thumb[$i]['new_image'] = $this->config->item('user_post_thumb_upload_path') . $response['result'][$i]['file_name'];
                        $user_post_thumb[$i]['create_thumb'] = TRUE;
                        $user_post_thumb[$i]['maintain_ratio'] = FALSE;
                        $user_post_thumb[$i]['thumb_marker'] = '';
                        $user_post_thumb[$i]['width'] = $n_w;
                        $user_post_thumb[$i]['height'] = $n_h;
                        $user_post_thumb[$i]['quality'] = "100%";
                        $user_post_thumb[$i]['x_axis'] = '0';
                        $user_post_thumb[$i]['y_axis'] = '0';
                        $instanse = "image_$i";
                        //Loading Image Library
                        $this->load->library('image_lib', $user_post_thumb[$i], $instanse);
                        $dataimage = $response['result'][$i]['file_name'];
                        //Creating Thumbnail
                        $this->$instanse->resize();

                        $thumb_image = $this->config->item('user_post_thumb_upload_path') . $response['result'][$i]['file_name'];

                        $abc = $s3->putObjectFile($thumb_image, bucket, $thumb_image, S3::ACL_PUBLIC_READ);

                        if ($count == '2' || $count == '3') {
                            /* CROP 335 X 320 */
                            // reconfigure the image lib for cropping

                            $resized_image_width = $this->config->item('user_post_resize1_width');
                            $resized_image_height = $this->config->item('user_post_resize1_height');
                            if ($thumb_image_width < $resized_image_width) {
                                $resized_image_width = $thumb_image_width;
                            }
                            if ($thumb_image_height < $resized_image_height) {
                                $resized_image_height = $thumb_image_height;
                            }

                            $conf_new[$i] = array(
                                'image_library' => 'gd2',
                                'source_image' => $user_post_thumb[$i]['new_image'],
                                'create_thumb' => FALSE,
                                'maintain_ratio' => FALSE,
                                'width' => $resized_image_width,
                                'height' => $resized_image_height
                            );

                            $conf_new[$i]['new_image'] = $this->config->item('user_post_resize1_upload_path') . $response['result'][$i]['file_name'];

                            $left = ($n_w / 2) - ($resized_image_width / 2);
                            $top = ($n_h / 2) - ($resized_image_height / 2);

                            $conf_new[$i]['x_axis'] = $left;
                            $conf_new[$i]['y_axis'] = $top;

                            $instanse1 = "image1_$i";
                            //Loading Image Library
                            $this->load->library('image_lib', $conf_new[$i], $instanse1);
                            $dataimage = $response['result'][$i]['file_name'];
                            //Creating Thumbnail
                            $this->$instanse1->crop();

                            $resize_image = $this->config->item('user_post_resize1_upload_path') . $response['result'][$i]['file_name'];

                            $abc = $s3->putObjectFile($resize_image, bucket, $resize_image, S3::ACL_PUBLIC_READ);
                            /* CROP 335 X 320 */
                        }
                        if ($count == '4' || $count > '4') {
                            /* CROP 335 X 245 */
                            // reconfigure the image lib for cropping

                            $resized_image_width = $this->config->item('user_post_resize2_width');
                            $resized_image_height = $this->config->item('user_post_resize2_height');
                            if ($thumb_image_width < $resized_image_width) {
                                $resized_image_width = $thumb_image_width;
                            }
                            if ($thumb_image_height < $resized_image_height) {
                                $resized_image_height = $thumb_image_height;
                            }


                            $conf_new1[$i] = array(
                                'image_library' => 'gd2',
                                'source_image' => $user_post_thumb[$i]['new_image'],
                                'create_thumb' => FALSE,
                                'maintain_ratio' => FALSE,
                                'width' => $resized_image_width,
                                'height' => $resized_image_height
                            );

                            $conf_new1[$i]['new_image'] = $this->config->item('user_post_resize2_upload_path') . $response['result'][$i]['file_name'];

                            $left = ($n_w / 2) - ($resized_image_width / 2);
                            $top = ($n_h / 2) - ($resized_image_height / 2);

                            $conf_new1[$i]['x_axis'] = $left;
                            $conf_new1[$i]['y_axis'] = $top;

                            $instanse2 = "image2_$i";
                            //Loading Image Library
                            $this->load->library('image_lib', $conf_new1[$i], $instanse2);
                            $dataimage = $response['result'][$i]['file_name'];
                            //Creating Thumbnail
                            $this->$instanse2->crop();

                            $resize_image1 = $this->config->item('user_post_resize2_upload_path') . $response['result'][$i]['file_name'];

                            $abc = $s3->putObjectFile($resize_image1, bucket, $resize_image1, S3::ACL_PUBLIC_READ);

                            /* CROP 335 X 245 */
                        }
                        /* CROP 210 X 210 */
                        // reconfigure the image lib for cropping

                        $resized_image_width = $this->config->item('user_post_resize3_width');
                        $resized_image_height = $this->config->item('user_post_resize3_height');
                        if ($thumb_image_width < $resized_image_width) {
                            $resized_image_width = $thumb_image_width;
                        }
                        if ($thumb_image_height < $resized_image_height) {
                            $resized_image_height = $thumb_image_height;
                        }

                        $conf_new2[$i] = array(
                            'image_library' => 'gd2',
                            'source_image' => $user_post_thumb[$i]['new_image'],
                            'create_thumb' => FALSE,
                            'maintain_ratio' => FALSE,
                            'width' => $resized_image_width,
                            'height' => $resized_image_height
                        );

                        $conf_new2[$i]['new_image'] = $this->config->item('user_post_resize3_upload_path') . $response['result'][$i]['file_name'];

                        $left = ($n_w / 2) - ($resized_image_width / 2);
                        $top = ($n_h / 2) - ($resized_image_height / 2);

                        $conf_new2[$i]['x_axis'] = $left;
                        $conf_new2[$i]['y_axis'] = $top;

                        $instanse3 = "image3_$i";
                        //Loading Image Library
                        $this->load->library('image_lib', $conf_new2[$i], $instanse3);
                        $dataimage = $response['result'][$i]['file_name'];
                        //Creating Thumbnail
                        $this->$instanse3->crop();
                        $resize_image2 = $this->config->item('user_post_resize3_upload_path') . $response['result'][$i]['file_name'];
                        $abc = $s3->putObjectFile($resize_image2, bucket, $resize_image2, S3::ACL_PUBLIC_READ);

                        /* CROP 210 X 210 */
                        $response['error'][] = $thumberror = $this->$instanse->display_errors();
                        $return['data'][] = $imgdata;
                        $return['status'] = "success";
                        $return['msg'] = sprintf($this->lang->line('success_item_added'), "Image", "uploaded");
                        
                        $insert_data = array();
                        $insert_data['post_id']  = $user_post_id;
                        $insert_data['file_type']  = $file_type;
                        $insert_data['filename']  = $fileName;
                        $insert_data['modify_date']  = date('Y-m-d H:i:s',time());
                        
                        $insert_post_id = $this->common->insert_data_getid($insert_data, 'user_post_file');
                        /* THIS CODE UNCOMMENTED AFTER SUCCESSFULLY WORKING : REMOVE IMAGE FROM UPLOAD FOLDER */

                        if ($_SERVER['HTTP_HOST'] != "localhost") {
                            if (isset($main_image)) {
                                unlink($main_image);
                            }
                            if (isset($thumb_image)) {
                                unlink($thumb_image);
                            }
                            if (isset($resize_image)) {
                                unlink($resize_image);
                            }
                            if (isset($resize_image1)) {
                                unlink($resize_image1);
                            }
                            if (isset($resize_image2)) {
                                unlink($resize_image2);
                            }
                            if (isset($resize_image4)) {
                                unlink($resize_image4);
                            }
                        }
                        /* THIS CODE UNCOMMENTED AFTER SUCCESSFULLY WORKING : REMOVE IMAGE FROM UPLOAD FOLDER */
                    } else {
                        echo $this->upload->display_errors();
                        exit;
                    }
                } else {
                    $this->session->set_flashdata('error', '<div class="col-md-7 col-sm-7 alert alert-danger1">Something went to wrong in uploded file.</div>');
                    exit;
                }
            }
        }
        $userid = $this->session->userdata('aileenuser');
        $user_name = $this->session->userdata('user_name');
        $business_profile_id = $this->data['business_common_data'][0]['business_profile_id'];
        $city = $this->data['business_common_data'][0]['city'];
        $user_id = $this->data['business_common_data'][0]['user_id'];
        $business_user_image = $this->data['business_common_data'][0]['business_user_image'];
        $business_slug = $this->data['business_common_data'][0]['business_slug'];
        $company_name = $this->data['business_common_data'][0]['company_name'];
        $profile_background = $this->data['business_common_data'][0]['profile_background'];
        $state = $this->data['business_common_data'][0]['state'];
        $industriyal = $this->data['business_common_data'][0]['industriyal'];
        $other_industrial = $this->data['business_common_data'][0]['other_industrial'];

        /* SELF USER LIST START */
        $self_list = array($userid);
        /* SELF USER LIST END */

        /* FOLLOWER USER LIST START */
        $condition_array = array('follow_from' => $business_profile_id, 'follow_status' => '1', 'follow_type' => '2');
        $join_str[0]['table'] = 'business_profile';
        $join_str[0]['join_table_id'] = 'business_profile.business_profile_id';
        $join_str[0]['from_table_id'] = 'follow.follow_to';
        $join_str[0]['join_type'] = '';
        $followerdata = $this->data['followerdata'] = $this->common->select_data_by_condition('follow', $condition_array, $data = 'GROUP_CONCAT(user_id) as follow_list', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str, $groupby = '');
        $follower_list = $followerdata[0]['follow_list'];
        $follower_list = explode(',', $follower_list);
        /* FOLLOWER USER LIST END */

        /* INDUSTRIAL AND CITY WISE DATA START */
        $condition_array = array('business_profile.is_deleted' => '0', 'business_profile.status' => '1', 'business_profile.business_step' => '4');
        $search_condition = "(business_profile.industriyal = '$industriyal' AND business_profile.industriyal != 0) AND (business_profile.other_industrial = '$other_industrial' AND business_profile.other_industrial != '') OR (business_profile.city = '$city')";
        $data = "GROUP_CONCAT(user_id) as industry_city_user_list";
        $industrial_city_data = $this->common->select_data_by_search('business_profile', $search_condition, $condition_array, $data, $sortby = '', $orderby = 'DESC', $limit = '', $offset = '', $join_str_contact = array(), $groupby = '');
        $industrial_city_list = $industrial_city_data[0]['industry_city_user_list'];
        $industrial_city_list = explode(',', $industrial_city_list);
        /* INDUSTRIAL AND CITY WISE DATA END */

        $total_user_list = array_merge($self_list, $follower_list, $industrial_city_list);
        $total_user_list = array_unique($total_user_list, SORT_REGULAR);
        $total_user_list = implode(',', $total_user_list);
        $total_user_list = str_replace(",", "','", $total_user_list);

        $condition_array = array('business_profile_post.is_delete' => '0', 'business_profile_post.status' => '1', 'FIND_IN_SET ("' . $user_id . '", delete_post) !=' => '0');
        $delete_postdata = $this->common->select_data_by_condition('business_profile_post', $condition_array, $data = 'GROUP_CONCAT(business_profile_post_id) as delete_post_id', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        $delete_post_id = $delete_postdata[0]['delete_post_id'];
        $delete_post_id = str_replace(",", "','", $delete_post_id);

        $condition_array = array('business_profile_post.is_delete' => '0', 'business_profile_post.status' => '1');
        $search_condition = "(`business_profile_post_id` NOT IN ('$delete_post_id') AND (business_profile_post.user_id IN ('$total_user_list'))) OR (posted_user_id ='$user_id')";
        $join_str[0]['table'] = 'business_profile';
        $join_str[0]['join_table_id'] = 'business_profile.user_id';
        $join_str[0]['from_table_id'] = 'business_profile_post.user_id';
        $join_str[0]['join_type'] = '';
        $data = "business_profile.business_user_image,business_profile.company_name,business_profile.industriyal,business_profile.business_slug,business_profile.other_industrial,business_profile.business_slug,business_profile_post.business_profile_post_id,business_profile_post.product_name,business_profile_post.product_description,business_profile_post.business_likes_count,business_profile_post.business_like_user,business_profile_post.created_date,business_profile_post.posted_user_id,business_profile.user_id";
        $business_profile_post = $this->common->select_data_by_search('business_profile_post', $search_condition, $condition_array, $data, $sortby = 'business_profile_post_id', $orderby = 'DESC', $limit = '1', $offset = '0', $join_str, $groupby = '');

        $return_html = '';
        $row = $business_profile_post[0];
        $post_business_user_image = $row['business_user_image'];
        $post_company_name = $row['company_name'];
        $post_business_profile_post_id = $row['business_profile_post_id'];
        $post_product_name = $row['product_name'];
        $post_product_description = $row['product_description'];
        $post_business_likes_count = $row['business_likes_count'];
        $post_business_like_user = $row['business_like_user'];
        $post_created_date = $row['created_date'];
        $post_posted_user_id = $row['posted_user_id'];
        $post_business_slug = $row['business_slug'];
        $post_industriyal = $row['industriyal'];
        $post_category = $this->db->get_where('industry_type', array('industry_id' => $post_industriyal, 'status' => '1'))->row()->industry_name;
        $post_other_industrial = $row['other_industrial'];
        $post_user_id = $row['user_id'];
        if ($post_posted_user_id) {
            $posted_company_name = $this->db->get_where('business_profile', array('user_id' => $post_posted_user_id))->row()->company_name;
            $posted_business_slug = $this->db->get_where('business_profile', array('user_id' => $post_posted_user_id, 'status' => '1'))->row()->business_slug;
            $posted_category = $this->db->get_where('industry_type', array('industry_id' => $post_industriyal, 'status' => '1'))->row()->industry_name;
            $posted_business_user_image = $this->db->get_where('business_profile', array('user_id' => $post_posted_user_id))->row()->business_user_image;
        }

        $return_html .= '<div id = "removepost' . $post_business_profile_post_id . '">
                        <div class = "col-md-12 col-sm-12 post-design-box">
                            <div class = "post_radius_box">
                                <div class = "post-design-top col-md-12" >
                            <div class = "post-design-pro-img">
                                <div id = "popup1" class = "overlay">
                                    <div class = "popup">
                                        <div class = "pop_content">
                                            Your Post is Successfully Saved.
                                            <p class = "okk">
                                                <a class = "okbtn" href = "#">Ok</a>
                                            </p>
                                        </div>
                                    </div>
                                </div>';


        if ($post_posted_user_id) {

            if ($posted_business_user_image) {
                $return_html .= '<a href = "' . base_url('business-profile/dashboard/' . $posted_business_slug) . '">';
                if (IMAGEPATHFROM == 'upload') {
                    if (!file_exists($this->config->item('bus_profile_thumb_upload_path') . $posted_business_user_image)) {
                        $return_html .= '<img src = "' . base_url(NOBUSIMAGE) . '" alt = "NOBUSIMAGE">';
                    } else {
                        $return_html .= '<img src = "' . BUS_PROFILE_THUMB_UPLOAD_URL . $posted_business_user_image . '?ver=' . time() . '" name = "image_src" id = "image_src" alt="' . $posted_business_user_image . '"/>';
                    }
                } else {
                    $filename = $this->config->item('bus_profile_thumb_upload_path') . $posted_business_user_image . '?ver=' . time();
                    $this->data['info'] = $info = $s3->getObjectInfo(bucket, $filename);
                    if (!$info) {
                        $return_html .= '<img src = "' . base_url(NOBUSIMAGE) . '" alt = "NOBUSIMAGE">';
                    } else {
                        $return_html .= '<img src = "' . BUS_PROFILE_THUMB_UPLOAD_URL . $posted_business_user_image . '?ver=' . time() . '" name = "image_src" id = "image_src" alt="' . $posted_business_user_image . '"/>';
                    }
                }

                $return_html .= '</a>';
            } else {
                $return_html .= '<a href = "' . base_url('business-profile/dashboard/' . $posted_business_slug) . '">';
                $return_html .= '<img src = "' . base_url(NOBUSIMAGE) . '" alt = "NOBUSIMAGE">';
                $return_html .= '</a>';
            }
        } else {
            if ($post_business_user_image) {
                $return_html .= '<a href = "' . base_url('business-profile/dashboard/' . $post_business_slug) . '">';
                if (IMAGEPATHFROM == 'upload') {
                    if (!file_exists($this->config->item('bus_profile_thumb_upload_path') . $post_business_user_image)) {
                        $return_html .= '<img src = "' . base_url(NOBUSIMAGE) . '" alt = "NOBUSIMAGE">';
                    } else {
                        $return_html .= '<img src = "' . BUS_PROFILE_THUMB_UPLOAD_URL . $post_business_user_image . '?ver=' . time() . '" alt = "' . $post_business_user_image . '">';
                    }
                } else {
                    $filename = $this->config->item('bus_profile_thumb_upload_path') . $post_business_user_image;
                    $this->data['info'] = $info = $s3->getObjectInfo(bucket, $filename);
                    if (!$info) {
                        $return_html .= '<img src = "' . base_url(NOBUSIMAGE) . '" alt = "NOBUSIMAGE">';
                    } else {
                        $return_html .= '<img src = "' . BUS_PROFILE_THUMB_UPLOAD_URL . $post_business_user_image . '?ver=' . time() . '" alt = "' . $post_business_user_image . '">';
                    }
                }
                $return_html .= '</a>';
            } else {
                $return_html .= '<a href = "' . base_url('business-profile/dashboard/' . $post_business_slug) . '">';
                $return_html .= '<img src = "' . base_url(NOBUSIMAGE) . '" alt = "NOBUSIMAGE">';
                $return_html .= '</a>';
            }
        }
        $return_html .= '</div>
                        <div class = "post-design-name fl col-xs-8 col-md-10">
                    <ul>';

        $return_html .= '<li></li>';

        if ($post_posted_user_id) {
            $return_html .= '<li>
                            <div class = "else_post_d">
                                <div class = "post-design-product">
                                    <a class = "post_dot" href = "' . base_url('business-profile/dashboard/' . $posted_business_slug) . '">' . ucfirst(strtolower($posted_company_name)) . '</a>
<p class = "posted_with" > Posted With</p> <a class = "other_name name_business post_dot" href = "' . base_url('business-profile/dashboard/' . $post_business_slug) . '">' . ucfirst(strtolower($post_company_name)) . '</a>
<span role = "presentation" aria-hidden = "true"> · </span> <span class = "ctre_date">
' . $this->common->time_elapsed_string(date('Y-m-d H:i:s', strtotime($post_created_date))) . '
</span> </div></div>
</li>';
        } else {
            $return_html .= '<li>
                            <div class = "post-design-product">
                                <a class = "post_dot" href = "' . base_url('business-profile/dashboard/' . $post_business_slug) . '" title = "' . ucfirst(strtolower($post_company_name)) . '">
' . ucfirst(strtolower($post_company_name)) . '</a>
                    <span role = "presentation" aria-hidden = "true"> · </span>
<div class = "datespan"> <span class = "ctre_date" >
' . $this->common->time_elapsed_string(date('Y-m-d H:i:s', strtotime($post_created_date))) . '

</span></div>

</div>
</li>';
        }

        $return_html .= '<li>
<div class = "post-design-product">
<a class = "buuis_desc_a" href = "javascript:void(0);" title = "Category">';
        if ($post_industriyal) {
            $return_html .= ucfirst(strtolower($post_category));
        } else {
            $return_html .= ucfirst(strtolower($post_other_industrial));
        }

        $return_html .= '</a>
</div>
</li>

<li>
</li>
</ul>
</div>
<div class = "dropdown1">';
        if ($id == 'manage') {
            $return_html .= '<a onClick = "myFunction1(' . $post_business_profile_post_id . ')" class = "dropbtn_common  dropbtn1 fa fa-ellipsis-v"></a>';
        } else {
            $return_html .= '<a onClick = "myFunction(' . $post_business_profile_post_id . ')" class = "dropbtn_common  dropbtn1 fa fa-ellipsis-v"></a>';
        }
        $return_html .= '<div id = "myDropdown' . $post_business_profile_post_id . '" class = "dropdown-content1 dropdown2_content">';

        if ($post_posted_user_id != 0) {

            if ($userid == $post_posted_user_id) {

                $return_html .= '<a onclick = "user_postdelete(' . $post_business_profile_post_id . ')">
<i class = "fa fa-trash-o" aria-hidden = "true">
</i> Delete Post
</a>
<a id = "' . $post_business_profile_post_id . '" onClick = "editpost(this.id)">
<i class = "fa fa-pencil-square-o" aria-hidden = "true">
</i>Edit
</a>';
            } else {

                $return_html .= '<a onclick = "user_postdelete(' . $post_business_profile_post_id . ')">
<i class = "fa fa-trash-o" aria-hidden = "true">
</i> Delete Post
</a>';
            }
        } else {
            if ($userid == $post_user_id) {
                $return_html .= '<a onclick = "user_postdelete(' . $post_business_profile_post_id . ')">
<i class = "fa fa-trash-o" aria-hidden = "true">
</i> Delete Post
</a>
<a id = "' . $post_business_profile_post_id . '" onClick = "editpost(this.id)">
<i class = "fa fa-pencil-square-o" aria-hidden = "true">
</i>Edit
</a>';
            } else {

                $return_html .= '<a onclick = "user_postdeleteparticular(' . $post_business_profile_post_id . ')">
<i class = "fa fa-trash-o" aria-hidden = "true">
</i> Delete Post
</a>';
            }
        }

        $return_html .= '</div>
</div>
<div class = "post-design-desc">
<div class = "ft-15 t_artd">
<div id = "editpostdata' . $post_business_profile_post_id . '" style = "display:block;">
<a>' . $this->common->make_links($post_product_name) . '</a>
</div>
<div id = "editpostbox' . $post_business_profile_post_id . '" style = "display:none;">


<input type = "text" class="productpostname" id = "editpostname' . $post_business_profile_post_id . '" name = "editpostname" placeholder = "Product Name" value = "' . $post_product_name . '" tabindex="' . $post_business_profile_post_id . '" onKeyDown = check_lengthedit(' . $post_business_profile_post_id . ');
onKeyup = check_lengthedit(' . $post_business_profile_post_id . ');
onblur = check_lengthedit(' . $post_business_profile_post_id . ');
>';

        if ($post_product_name) {
            $counter = $post_product_name;
            $a = strlen($counter);

            $return_html .= '<input size = 1 id = "text_num_' . $post_business_profile_post_id . '" class = "text_num" value = "' . (50 - $a) . '" name = text_num disabled>';
        } else {
            $return_html .= '<input size = 1 id = "text_num_' . $post_business_profile_post_id . '" class = "text_num" value = 50 name = text_num disabled>';
        }
        $return_html .= '</div>

</div>
<div id = "khyati' . $post_business_profile_post_id . '" style = "display:block;">';

        $small = substr($post_product_description, 0, 180);
        $return_html .= nl2br($this->common->make_links($small));
        if (strlen($post_product_description) > 180) {
            $return_html .= '... <span id = "kkkk" onClick = "khdiv(' . $post_business_profile_post_id . ')">View More</span>';
        }

        $return_html .= '</div>
<div id = "khyatii' . $post_business_profile_post_id . '" style = "display:none;">
' . $post_product_description . '</div>
<div id = "editpostdetailbox' . $post_business_profile_post_id . '" style = "display:none;">
<div contenteditable = "true" id = "editpostdesc' . $post_business_profile_post_id . '" class = "textbuis editable_text margin_btm" name = "editpostdesc" placeholder = "Description" tabindex="' . ($post_business_profile_post_id + 1) . '" onpaste = "OnPaste_StripFormatting(this, event);" onfocus="cursorpointer(' . $post_business_profile_post_id . ')">' . $post_product_description . '</div>
</div>
<div id = "editpostdetailbox' . $post_business_profile_post_id . '" style = "display:none;">
<div contenteditable = "true" id = "editpostdesc' . $post_business_profile_post_id . '" placeholder = "Product Description" class = "textbuis  editable_text" name = "editpostdesc" onpaste = "OnPaste_StripFormatting(this, event);">' . $post_product_description . '</div>
</div>
<button class = "fr" id = "editpostsubmit' . $post_business_profile_post_id . '" style = "display:none;margin: 5px 0; border-radius: 3px;" onClick = "edit_postinsert(' . $post_business_profile_post_id . ')">Save
</button>
</div>
</div>
<div class = "post-design-mid col-md-12 padding_adust" >
<div>';

        $contition_array = array('post_id' => $post_business_profile_post_id, 'is_deleted' => '1', 'insert_profile' => '2');
        $businessmultiimage = $this->common->select_data_by_condition('post_files', $contition_array, $data = 'file_name,post_files_id', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        if (count($businessmultiimage) == 1) {

            $allowed = array('jpg', 'JPG', 'jpeg', 'JPEG', 'PNG', 'png', 'gif', 'GIF', 'psd', 'PSD', 'bmp', 'BMP', 'tiff', 'TIFF', 'iff', 'IFF', 'xbm', 'XBM', 'webp', 'WebP', 'HEIF', 'heif', 'BAT', 'bat', 'BPG', 'bpg', 'SVG', 'svg');
//            $allowed = VALID_IMAGE;
            $allowespdf = array('pdf');
            $allowesvideo = array('mp4', 'webm', 'qt', 'mov', 'MP4');
            $allowesaudio = array('mp3');
            $filename = $businessmultiimage[0]['file_name'];
            $ext = pathinfo($filename, PATHINFO_EXTENSION);
            if (in_array($ext, $allowed)) {

                $return_html .= '<div class = "one-image">';

                $return_html .= '<a href = "' . base_url('business-profile/post-detail/' . $business_login_slug . '/' . $post_business_profile_post_id) . '">
<img src = "' . BUS_POST_MAIN_UPLOAD_URL . $businessmultiimage[0]['file_name'] . '?ver=' . time() . '" alt="' . $businessmultiimage[0]['file_name'] . '">
</a>
</div>';
            } elseif (in_array($ext, $allowespdf)) {

                $return_html .= '<div>
<a title = "click to open" href = "' . BUS_POST_MAIN_UPLOAD_URL . $businessmultiimage[0]['file_name'] . '" target="_blank"><div class = "pdf_img">
    <img src="' . base_url('assets/images/PDF.jpg?ver=' . time()) . '" alt="PDF.jpg">
</div>
</a>
</div>';
            } elseif (in_array($ext, $allowesvideo)) {
                $post_poster = $businessmultiimage[0]['file_name'];
                $post_poster1 = explode('.', $post_poster);
                $post_poster2 = end($post_poster1);
                $post_poster = str_replace($post_poster2, 'png', $post_poster);

                if (IMAGEPATHFROM == 'upload') {
                    $return_html .= '<div>';
                    if (file_exists($this->config->item('user_post_main_upload_path') . $post_poster)) {
                        $return_html .= '<video width = "100%" height = "350" id="show_video' . $businessmultiimage[0]['post_files_id'] . '" onplay="playtime(' . $businessmultiimage[0]['post_files_id'] . ',' . $post_business_profile_post_id . ')" onClick="count_videouser(' . $businessmultiimage[0]['post_files_id'] . ',' . $post_business_profile_post_id . ');" controls poster="' . BUS_POST_MAIN_UPLOAD_URL . $post_poster . '">';
                    } else {
                        $return_html .= '<video width = "100%" height = "350" id="show_video' . $businessmultiimage[0]['post_files_id'] . '" onplay="playtime(' . $businessmultiimage[0]['post_files_id'] . ',' . $post_business_profile_post_id . ')" onClick="count_videouser(' . $businessmultiimage[0]['post_files_id'] . ',' . $post_business_profile_post_id . ');" controls>';
                    }
                    $return_html .= '<source src = "' . BUS_POST_MAIN_UPLOAD_URL . $businessmultiimage[0]['file_name'] . '" type = "video/mp4">';
                    $return_html .= 'Your browser does not support the video tag.';
                    $return_html .= '</video>';
                    $return_html .= '</div>';
                } else {
                    $filename = $this->config->item('user_post_main_upload_path') . $post_poster;
                    $this->data['info'] = $info = $s3->getObjectInfo(bucket, $filename);
                    $return_html .= '<div>';
                    if ($info) {
                        $return_html .= '<video width = "100%" height = "350" id="show_video' . $businessmultiimage[0]['post_files_id'] . '" onplay="playtime(' . $businessmultiimage[0]['post_files_id'] . ',' . $post_business_profile_post_id . ')" onClick="count_videouser(' . $businessmultiimage[0]['post_files_id'] . ',' . $post_business_profile_post_id . ');" controls poster="' . BUS_POST_MAIN_UPLOAD_URL . $post_poster . '">';
                    } else {
                        $return_html .= '<video width = "100%" height = "350" id="show_video' . $businessmultiimage[0]['post_files_id'] . '" onplay="playtime(' . $businessmultiimage[0]['post_files_id'] . ',' . $post_business_profile_post_id . ')" onClick="count_videouser(' . $businessmultiimage[0]['post_files_id'] . ',' . $post_business_profile_post_id . ');" controls>';
                    }
                    $return_html .= '<source src = "' . BUS_POST_MAIN_UPLOAD_URL . $businessmultiimage[0]['file_name'] . '" type = "video/mp4">';
                    $return_html .= 'Your browser does not support the video tag.';
                    $return_html .= '</video>';
                    $return_html .= '</div>';
                }
            } elseif (in_array($ext, $allowesaudio)) {

                $return_html .= '<div class = "audio_main_div">
<div class = "audio_img">
<img src = "' . base_url('assets/images/music-icon.png?ver=' . time()) . '" alt="music-icon.png">
</div>
<div class = "audio_source">
<audio id = "audio_player" width = "100%" height = "100" controls>
<source src = "' . BUS_POST_MAIN_UPLOAD_URL . $businessmultiimage[0]['file_name'] . '?ver=' . time() . '" type = "audio/mp3">
Your browser does not support the audio tag.
</audio>
</div>
<div class = "audio_mp3" id = "' . "postname" . $post_business_profile_post_id . '">
<p title = "' . $post_product_name . '">' . $post_product_name . '</p>
</div>
</div>';
            }
        } elseif (count($businessmultiimage) == 2) {

            foreach ($businessmultiimage as $multiimage) {

                $return_html .= '<div class = "two-images">
<a href = "' . base_url('business-profile/post-detail/' . $business_login_slug . '/' . $post_business_profile_post_id) . '">
<img class = "two-columns" src = "' . BUS_POST_RESIZE1_UPLOAD_URL . $multiimage['file_name'] . '" alt="' . $multiimage['file_name'] . '">
</a>
</div>';
            }
        } elseif (count($businessmultiimage) == 3) {

            $return_html .= '<div class = "three-image-top" >
<a href = "' . base_url('business-profile/post-detail/' . $business_login_slug . '/' . $post_business_profile_post_id) . '">
<img class = "three-columns" src = "' . BUS_POST_RESIZE4_UPLOAD_URL . $businessmultiimage[0]['file_name'] . '" alt="' . $businessmultiimage[0]['file_name'] . '">
</a>
</div>
<div class = "three-image" >

<a href = "' . base_url('business-profile/post-detail/' . $business_login_slug . '/' . $post_business_profile_post_id) . '">
<img class = "three-columns" src = "' . BUS_POST_RESIZE1_UPLOAD_URL . $businessmultiimage[1]['file_name'] . '" alt="' . $businessmultiimage[1]['file_name'] . '">
</a>
</div>
<div class = "three-image" >
<a href = "' . base_url('business-profile/post-detail/' . $business_login_slug . '/' . $post_business_profile_post_id) . '">
<img class = "three-columns" src = "' . BUS_POST_RESIZE1_UPLOAD_URL . $businessmultiimage[2]['file_name'] . '" alt="' . $businessmultiimage[2]['file_name'] . '">
</a>
</div>';
        } elseif (count($businessmultiimage) == 4) {

            foreach ($businessmultiimage as $multiimage) {

                $return_html .= '<div class = "four-image">
<a href = "' . base_url('business-profile/post-detail/' . $business_login_slug . '/' . $post_business_profile_post_id) . '">
<img class = "breakpoint" src = "' . BUS_POST_RESIZE2_UPLOAD_URL . $multiimage['file_name'] . '" alt="' . $multiimage['file_name'] . '">
</a>
</div>';
            }
        } elseif (count($businessmultiimage) > 4) {

            $i = 0;
            foreach ($businessmultiimage as $multiimage) {

                $return_html .= '<div class = "four-image">
<a href = "' . base_url('business-profile/post-detail/' . $business_login_slug . '/' . $post_business_profile_post_id) . '">
<img src = "' . BUS_POST_RESIZE2_UPLOAD_URL . $multiimage['file_name'] . '?ver=' . time() . '" alt="' . $multiimage['file_name'] . '">
</a>
</div>';

                $i++;
                if ($i == 3)
                    break;
            }

            $return_html .= '<div class = "four-image">
<a href = "' . base_url('business-profile/post-detail/' . $business_login_slug . '/' . $post_business_profile_post_id) . '">
<img src = "' . BUS_POST_RESIZE2_UPLOAD_URL . $businessmultiimage[3]['file_name'] . '?ver=' . time() . '" alt="' . $businessmultiimage[3]['file_name'] . '">
</a>
<a class = "text-center" href = "' . base_url('business-profile/post-detail/' . $business_login_slug . '/' . $post_business_profile_post_id) . '">
<div class = "more-image" >
<span>View All (+
' . (count($businessmultiimage) - 4) . ')</span>

</div>

</a>
</div>';
        }
        $return_html .= '<div>
</div>
</div>
</div>
<div class = "post-design-like-box col-md-12">
<div class = "post-design-menu">
<ul class = "col-md-6 col-sm-6 col-xs-6">
<li class = "likepost' . $post_business_profile_post_id . '">
<a id = "' . $post_business_profile_post_id . '" class = "ripple like_h_w" onClick = "post_like(this.id)">';

        $likeuser = $post_business_like_user;
        $likeuserarray = explode(',', $post_business_like_user);
        if (!in_array($userid, $likeuserarray)) {
            $return_html .= '<i class = "fa fa-thumbs-up fa-1x" aria-hidden = "true"></i>';
        } else {
            $return_html .= '<i class = "fa fa-thumbs-up fa-1x main_color" aria-hidden = "true"></i>';
        }
        $return_html .= '<span class = "like_As_count">';
        if ($post_business_likes_count > 0) {
            $return_html .= $post_business_likes_count;
        }
        $return_html .= '</span>
</a>
</li>
<li id = "insertcount' . $post_business_profile_post_id . '" style = "visibility:show">';
        $commnetcount = $this->business_model->getBusinessPostComment($post_business_profile_post_id);

        $return_html .= '<a onClick = "commentall(this.id)" id = "' . $post_business_profile_post_id . '" class = "ripple like_h_w">
<i class = "fa fa-comment-o" aria-hidden = "true">
</i>
</a>
</li>
</ul>
<ul class = "col-md-6 col-sm-6 col-xs-6 like_cmnt_count">';

        $contition_array = array('post_id' => $row['business_profile_post_id'], 'insert_profile' => '2');
        $postformat = $this->common->select_data_by_condition('post_files', $contition_array, $data = 'post_format', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
        if ($postformat[0]['post_format'] == 'video') {
            $return_html .= '<li id="viewvideouser' . $row['business_profile_post_id'] . '">';

            $contition_array = array('post_id' => $row['business_profile_post_id']);
            $userdata = $this->common->select_data_by_condition('showvideo', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
            $user_data = count($userdata);

            if ($user_data > 0) {

                $return_html .= '<div class="comnt_count_ext_a  comnt_count_ext2"><span>';

                $return_html .= $user_data . ' ' . 'Views';

                $return_html .= '</span></div></li>';
            }
        }

        $return_html .= '<li>
<div class = "like_count_ext">
<span class = "comment_count' . $post_business_profile_post_id . '" >';

        if (count($commnetcount) > 0) {
            $return_html .= count($commnetcount);
            $return_html .= '<span> Comment</span>';
        }
        $return_html .= '</span>

</div>
</li>

<li>
<div class = "comnt_count_ext">
<span class = "comment_like_count' . $post_business_profile_post_id . '">';
        if ($post_business_likes_count > 0) {
            $return_html .= $post_business_likes_count;

            $return_html .= '<span> Like</span>';
        }
        $return_html .= '</span>

</div></li>
</ul>
</div>
</div>';

        if ($post_business_likes_count > 0) {

            $return_html .= '<div class = "likeduserlist' . $post_business_profile_post_id . '">';

            $likeuser = $post_business_like_user;
            $countlike = $post_business_likes_count - 1;
            $likelistarray = explode(',', $likeuser);

            $likeuser = $post_business_like_user;
            $countlike = $post_business_likes_count - 1;
            $likelistarray = explode(',', $likeuser);

            $business_fname1 = $this->db->get_where('business_profile', array('user_id' => $likelistarray[0], 'status' => '1'))->row()->company_name;
            $return_html .= '<div class = "like_one_other">';
            $return_html .= '<a href = "javascript:void(0);" onclick = "likeuserlist(' . $post_business_profile_post_id . ')">';
            if (in_array($userid, $likelistarray)) {
                $return_html .= "You";
                $return_html .= "&nbsp;";
            } else {
                $return_html .= ucfirst($business_fname1);
                $return_html .= "&nbsp;";
            }

            if (count($likelistarray) > 1) {
                $return_html .= " and";

                $return_html .= $countlike;
                $return_html .= "&nbsp;";
                $return_html .= "others";
            }
            $return_html .= '</a></div>
</div>';
        }

        $return_html .= '<div class = "likeusername' . $post_business_profile_post_id . '" id = "likeusername' . $post_business_profile_post_id . '" style = "display:none">';
        $likeuser = $post_business_like_user;
        $countlike = $post_business_likes_count - 1;
        $likelistarray = explode(',', $likeuser);

        $contition_array = array('business_profile_post_id' => $post_business_profile_post_id, 'status' => '1', 'is_delete' => '0');
        $commnetcount = $this->common->select_data_by_condition('business_profile_post', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        $likeuser = $post_business_like_user;
        $countlike = $post_business_likes_count - 1;
        $likelistarray = explode(',', $likeuser);

        $business_fname1 = $this->db->get_where('business_profile', array('user_id' => $value, 'status' => '1'))->row()->company_name;

        $return_html .= '<div class = "like_one_other">';
        $return_html .= '<a href = "javascript:void(0);" onclick = "likeuserlist(' . $post_business_profile_post_id . ')">';
        $return_html .= ucfirst($business_fname1);
        $return_html .= "&nbsp;";

        if (count($likelistarray) > 1) {

            $return_html .= "and";

            $return_html .= $countlike;
            $return_html .= "&nbsp;";
            $return_html .= "others";
        }
        $return_html .= '</a></div>
</div>

<div class = "art-all-comment col-md-12">
<div id = "fourcomment' . $post_business_profile_post_id . '" style = "display:none;">
</div>
<div id = "threecomment' . $post_business_profile_post_id . '" style = "display:block">
<div class = "hidebottomborder insertcomment' . $post_business_profile_post_id . '">';

        $businessprofiledata = $this->data['businessprofiledata'] = $this->business_model->getBusinessPostComment($post_business_profile_post_id, $sortby = 'business_profile_post_comment_id', $orderby = 'DESC', $limit = '1');

        if ($businessprofiledata) {
            foreach ($businessprofiledata as $rowdata) {
                $companyname = $this->db->get_where('business_profile', array('user_id' => $rowdata['user_id']))->row()->company_name;
                $slugname1 = $this->db->get_where('business_profile', array('user_id' => $rowdata['user_id'], 'status' => '1'))->row()->business_slug;

                $return_html .= '<div class = "all-comment-comment-box">
<div class = "post-design-pro-comment-img">';
                $business_userimage = $this->db->get_where('business_profile', array('user_id' => $rowdata['user_id'], 'status' => '1'))->row()->business_user_image;

                if ($business_userimage) {
                    $return_html .= '<a href = "' . base_url('business-profile/dashboard/' . $slugname1) . '">';
                    if (IMAGEPATHFROM == 'upload') {
                        if (!file_exists($this->config->item('bus_profile_thumb_upload_path') . $business_userimage)) {
                            $return_html .= '<img src = "' . base_url(NOBUSIMAGE) . '" alt = "NOBUSIMAGE">';
                        } else {
                            $return_html .= '<img src = "' . BUS_PROFILE_THUMB_UPLOAD_URL . $business_userimage . '?ver=' . time() . '" alt = "' . $business_userimage . '">';
                        }
                    } else {
                        $filename = $this->config->item('bus_profile_thumb_upload_path') . $business_userimage;
                        $this->data['info'] = $info = $s3->getObjectInfo(bucket, $filename);
                        if (!$info) {
                            $return_html .= '<img src = "' . base_url(NOBUSIMAGE) . '" alt = "NOBUSIMAGE">';
                        } else {
                            $return_html .= '<img src = "' . BUS_PROFILE_THUMB_UPLOAD_URL . $business_userimage . '?ver=' . time() . '" alt = "' . $business_userimage . '">';
                        }
                    }
                    $return_html .= '</a>';
                } else {
                    $return_html .= '<a href = "' . base_url('business-profile/dashboard/' . $slugname1) . '">';

                    $return_html .= '<img src = "' . base_url(NOBUSIMAGE) . '" alt = "NOBUSIMAGE"></a>';
                }
                $return_html .= '</div>
<div class = "comment-name"><a href="' . base_url() . 'business-profile/dashboard/' . $slugname1 . '">
<b title = "' . $companyname . '">';
                $return_html .= $companyname;
                $return_html .= '</br>';

                $return_html .= '</b></a>
</div>
<div class = "comment-details" id = "showcomment' . $rowdata['business_profile_post_comment_id'] . '">';

                $return_html .= '<div id = "lessmore' . $rowdata['business_profile_post_comment_id'] . '" style = "display:block;">';
                $small = substr($rowdata['comments'], 0, 180);
                $return_html .= nl2br($this->common->make_links($small));

                if (strlen($rowdata['comments']) > 180) {
                    $return_html .= '... <span id = "kkkk" onClick = "seemorediv(' . $rowdata['business_profile_post_comment_id'] . ')">See More</span>';
                }
                $return_html .= '</div>';
                $return_html .= '<div id = "seemore' . $rowdata['business_profile_post_comment_id'] . '" style = "display:none;">';
                $new_product_comment = $this->common->make_links($rowdata['comments']);
                $return_html .= nl2br(htmlspecialchars_decode(htmlentities($new_product_comment, ENT_QUOTES, 'UTF-8')));
                $return_html .= '</div>';
                $return_html .= '</div>
<div class = "edit-comment-box">
<div class = "inputtype-edit-comment">
<div contenteditable = "true" class = "editable_text editav_2" name = "' . $rowdata['business_profile_post_comment_id'] . '" id = "editcomment' . $rowdata['business_profile_post_comment_id'] . '" placeholder = "Enter Your Comment " value = "" onkeyup = "commentedit(' . $rowdata['business_profile_post_comment_id'] . ')" onpaste = "OnPaste_StripFormatting(this, event);">' . $rowdata['comments'] . '</div>
<span class = "comment-edit-button"><button id = "editsubmit' . $rowdata['business_profile_post_comment_id'] . '" style = "display:none" onClick = "edit_comment(' . $rowdata['business_profile_post_comment_id'] . ')">Save</button></span>
</div>
</div>
<div class = "art-comment-menu-design">
<div class = "comment-details-menu" id = "likecomment1' . $rowdata['business_profile_post_comment_id'] . '">
<a id = "' . $rowdata['business_profile_post_comment_id'] . '" onClick = "comment_like1(this.id)">';

                $businesscommentlike = $this->data['businesscommentlike'] = $commnetcount = $this->business_model->getBusinessPostComment($rowdata['business_profile_post_comment_id']);
                $likeuserarray = explode(',', $businesscommentlike[0]['business_comment_like_user']);
                if (!in_array($userid, $likeuserarray)) {

                    $return_html .= '<i class = "fa fa-thumbs-up" style = "color: #999;" aria-hidden = "true"></i>';
                } else {
                    $return_html .= '<i class = "fa fa-thumbs-up main_color" aria-hidden = "true">
</i>';
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

                    $return_html .= '<span role = "presentation" aria-hidden = "true"> ·
</span>
<div class = "comment-details-menu">
<div id = "editcommentbox' . $rowdata['business_profile_post_comment_id'] . '" style = "display:block;">
<a id = "' . $rowdata['business_profile_post_comment_id'] . '" onClick = "comment_editbox(this.id)" class = "editbox">Edit
</a>
</div>
<div id = "editcancle' . $rowdata['business_profile_post_comment_id'] . '" style = "display:none;">
<a id = "' . $rowdata['business_profile_post_comment_id'] . '" onClick = "comment_editcancle(this.id)">Cancel
</a>
</div>
</div>';
                }
                $userid = $this->session->userdata('aileenuser');
                $business_userid = $this->db->get_where('business_profile_post', array('business_profile_post_id' => $rowdata['business_profile_post_id'], 'status' => '1'))->row()->user_id;
                if ($rowdata['user_id'] == $userid || $business_userid == $userid) {

                    $return_html .= '<span role = "presentation" aria-hidden = "true"> ·
</span>
<div class = "comment-details-menu">
<input type = "hidden" name = "post_delete" id = "post_delete' . $rowdata['business_profile_post_comment_id'] . '" value = "' . $rowdata['business_profile_post_id'] . '">
<a id = "' . $rowdata['business_profile_post_comment_id'] . '" onClick = "comment_delete(this.id)"> Delete
<span class = "insertcomment' . $rowdata['business_profile_post_comment_id'] . '">
</span>
</a>
</div>';
                }
                $return_html .= '<span role = "presentation" aria-hidden = "true"> ·
</span>
<div class = "comment-details-menu">
<p>';

                $return_html .= $this->common->time_elapsed_string(date('Y-m-d H:i:s', strtotime($rowdata['created_date'])));
                $return_html .= '</br>';

                $return_html .= '</p>
</div>
</div>
</div>';
            }
        }
        $return_html .= '</div>
</div>
</div>
<div class = "post-design-commnet-box col-md-12">
<div class = "post-design-proo-img hidden-mob">';

        $userid = $this->session->userdata('aileenuser');
        $business_userimage = $this->db->get_where('business_profile', array('user_id' => $userid, 'status' => '1'))->row()->business_user_image;
        if ($business_userimage) {
            if (IMAGEPATHFROM == 'upload') {
                if (!file_exists($this->config->item('bus_profile_thumb_upload_path') . $business_userimage)) {
                    $return_html .= '<img src = "' . base_url(NOBUSIMAGE) . '" alt = "NOBUSIMAGE">';
                } else {
                    $return_html .= '<img src = "' . BUS_PROFILE_THUMB_UPLOAD_URL . $business_userimage . '?ver=' . time() . '" alt = "' . $business_userimage . '">';
                }
            } else {
                $filename = $this->config->item('bus_profile_thumb_upload_path') . $business_userimage;
                $this->data['info'] = $info = $s3->getObjectInfo(bucket, $filename);
                if (!$info) {
                    $return_html .= '<img src = "' . base_url(NOBUSIMAGE) . '" alt = "NOBUSIMAGE">';
                } else {
                    $return_html .= '<img src = "' . BUS_PROFILE_THUMB_UPLOAD_URL . $business_userimage . '?ver=' . time() . '" alt = "' . $business_userimage . '">';
                }
            }
        } else {
            $return_html .= '<img src = "' . base_url(NOBUSIMAGE) . '" alt = "NOBUSIMAGE">';
        }
        $return_html .= '</div>

<div id = "content" class = "col-md-12  inputtype-comment cmy_2" >
<div contenteditable = "true" class = "edt_2 editable_text" name = "' . $post_business_profile_post_id . '" id = "post_comment' . $post_business_profile_post_id . '" placeholder = "Add a Comment ..." onClick = "entercomment(' . $post_business_profile_post_id . ')" onpaste = "OnPaste_StripFormatting(this, event);"></div>
<div class="mob-comment">       
                            <button id="' . $post_business_profile_post_id . '" onClick="insert_comment(this.id)"><img src="' . base_url('assets/img/send.png') . '?ver=' . time() . '" alt="send.png">
                            </button>
                        </div>
</div>
' . form_error('post_comment') . '
<div class = "comment-edit-butn hidden-mob">
<button id = "' . $post_business_profile_post_id . '" onClick = "insert_comment(this.id)">Comment
</button>
</div>

</div>
</div>
</div></div>';

        echo $return_html;
    }

}
