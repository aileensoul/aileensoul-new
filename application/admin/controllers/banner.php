<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Banner extends MY_Controller {

    public $data;

    public function __construct() {

        parent::__construct();

        //$GLOBALS['record_per_page']=10;
        //site setting details
        $site_name_values = $this->common->select_data_by_id('settings', 'setting_id', '1', '*');
        $this->data['site_name'] = $site_name = $site_name_values[0]['setting_value'];
        //set header, footer and leftmenu
        $this->data['title'] = 'Banner | ' . $site_name;
        $this->data['header'] = $this->load->view('header', $this->data);
        $this->data['leftmenu'] = $this->load->view('leftmenu', $this->data);
        $this->data['footer'] = $this->load->view('footer', $this->data, true);


        $this->load->model('common');

        //remove catch so after logout cannot view last visited page if that page is this
        $this->output->set_header('Last-Modified:' . gmdate('D, d M Y H:i:s') . 'GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
        $this->output->set_header('Cache-Control: post-check=0, pre-check=0', false);
        $this->output->set_header('Pragma: no-cache');
    }

    //display banner list
    public function index() {

        $this->data['module_name'] = 'Banner';
        $this->data['section_title'] = 'Banner';

        $contition_array = array('status !=' => '3');
        $this->data['banner_list'] = $this->common->select_data_by_condition('banner', $contition_array, '*', $short_by = '', $order_by = '', $limit = '', $offset = '');

        $this->load->view('banner/index', $this->data);
    }

    //add new banner
    public function add() {
        //check post and save data
        if ($this->input->post('btn_save')) {
            $name = $this->input->post('name');
            $link = $this->input->post('link');
            $description = $this->input->post('description');

            $error = '';
            if ($name == '') {
                $error = 1;
                $this->session->set_flashdata('error', 'Please enter banner name');
                redirect('banner/add', 'refresh');
            }
            if ($link == '') {
                $error = 1;
                $this->session->set_flashdata('error', 'Please enter link');
                redirect('banner/add', 'refresh');
            }
            if ($_FILES['image']['name'][0] == '') {
                $error = 1;
                $this->session->set_flashdata('error', 'Please select image');
                redirect('banner/add', 'refresh');
            }
            if ($error == 1) {
                $this->session->set_flashdata('error', 'Error Occurred. Try Again!');
                $redirect_url = site_url('banner/add');
                redirect($redirect_url, 'refresh');
            } else {

                $banner_image = '';

                $banner['upload_path'] = $this->config->item('banner_main_upload_path');
                $banner['allowed_types'] = $this->config->item('banner_allowed_types');
                $banner['max_size'] = $this->config->item('banner_main_max_size');
                $banner['max_width'] = $this->config->item('banner_main_max_width');
                $banner['max_height'] = $this->config->item('banner_main_max_height');


                $this->load->library('upload');
                $this->upload->initialize($banner);
                //Uploading Image
                $this->upload->do_upload('image');
                //Getting Uploaded Image File Data
                $imgdata = $this->upload->data();
                $imgerror = $this->upload->display_errors();
                if ($imgerror == '') {
                    //Configuring Thumbnail 
                    $banner_thumb['image_library'] = 'gd2';
                    $banner_thumb['source_image'] = $banner['upload_path'] . $imgdata['file_name'];
                    $banner_thumb['new_image'] = $this->config->item('banner_thumb_upload_path') . $imgdata['file_name'];
                    $banner_thumb['create_thumb'] = TRUE;
                    $banner_thumb['maintain_ratio'] = TRUE;
                    $banner_thumb['thumb_marker'] = '';
                    $banner_thumb['width'] = $this->config->item('banner_thumb_width');
                    //$banner_thumb['height'] = $this->config->item('banner_thumb_height');
                    $banner_thumb['height'] = 2;
                    $banner_thumb['master_dim'] = 'width';
                    $banner_thumb['quality'] = "100%";
                    $banner_thumb['x_axis'] = '0';
                    $banner_thumb['y_axis'] = '0';
                    //Loading Image Library
                    $this->load->library('image_lib', $banner_thumb);
                    $dataimage = $imgdata['file_name'];
                    //Creating Thumbnail
                    $this->image_lib->resize();
                    $thumberror = $this->image_lib->display_errors();
                } else {
                    $thumberror = '';
                }

                if ($imgerror != '' || $thumberror != '') {
                    $error[0] = $imgerror;
                    $error[1] = $thumberror;
                } else {
                    $error = array();
                }
                if ($error) {
                    $this->session->set_flashdata('error', $error[0]);
                    $redirect_url = site_url('banner');
                    redirect($redirect_url, 'refresh');
                } else {
                    $banner = $imgdata['file_name'];
                }

                $insert_array = array(
                    'name' => $name,
                    'link' => $link,
                    'description' => $description,
                    'create_date' => date('Y-m-d H:i:s'),
                    'modify_date' => date('Y-m-d H:i:s'),
                    'status' => 1,
                    'image' => $banner
                );
                $insert_id = $this->common->insert_data_getid($insert_array, 'banner');

                if ($insert_id > 0) {
                    
                    $this->session->set_flashdata('success', 'Banner successfully inserted');
                    $redirect_url = site_url('banner');
                    redirect($redirect_url, 'refresh');
                } else {
                    $this->session->set_flashdata('error', 'Error Occurred. Try Again!');
                    $redirect_url = site_url('banner/add');
                    redirect($redirect_url, 'refresh');
                }
            }
        }


        // define module name and section title
        $this->data['module_name'] = 'Banner';
        $this->data['section_title'] = 'Add Banner';

        
        $this->load->view('banner/add', $this->data);
    }

    //update the user detail
    public function edit($id = '') {

        if ($this->input->post('banner_id')) {

            $banner_id = $this->input->post('banner_id');
            $name = $this->input->post('name');
            $link = $this->input->post('link');
            $description = $this->input->post('description');
            
            $error = '';
            if ($name == '') {
                $error = 1;
                $this->session->set_flashdata('error', 'Please enter banner name');
                redirect('banner/edit/' . $banner_id, 'refresh');
            }
            if ($link == '') {
                $error = 1;
                $this->session->set_flashdata('error', 'Please enter link');
                redirect('banner/edit/' . $banner_id, 'refresh');
            }
            if ($error == 1) {
                $this->session->set_flashdata('error', 'Error Occurred. Try Again!');
                $redirect_url = site_url('banner/edit/' . $banner_id);
                redirect($redirect_url, 'refresh');
            } else {

                if ($_FILES['image']['name'] != '') {

                    $banner['upload_path'] = $this->config->item('banner_main_upload_path');
                    $banner['allowed_types'] = $this->config->item('banner_allowed_types');
                    $banner['max_size'] = $this->config->item('banner_main_max_size');
                    $banner['max_width'] = $this->config->item('banner_main_max_width');
                    $banner['max_height'] = $this->config->item('banner_main_max_height');

                    //    $this->load->library('upload', $event);

                    $this->load->library('upload');
                    $this->upload->initialize($banner);
                    //Uploading Image
                    $this->upload->do_upload('image');
                    //Getting Uploaded Image File Data
                    $imgdata = $this->upload->data();
                    $imgerror = $this->upload->display_errors();
                    if ($imgerror == '') {
                        //Configuring Thumbnail 
                        $banner_thumb['image_library'] = 'gd2';
                        $banner_thumb['source_image'] = $banner['upload_path'] . $imgdata['file_name'];
                        $banner_thumb['new_image'] = $this->config->item('banner_thumb_upload_path') . $imgdata['file_name'];
                        $banner_thumb['create_thumb'] = TRUE;
                        $banner_thumb['maintain_ratio'] = TRUE;
                        $banner_thumb['thumb_marker'] = '';
                        $banner_thumb['width'] = $this->config->item('banner_thumb_width');
                        //$banner_thumb['height'] = $this->config->item('banner_thumb_height');
                        $banner_thumb['height'] = 2;
                        $banner_thumb['master_dim'] = 'width';
                        $banner_thumb['quality'] = "100%";
                        $banner_thumb['x_axis'] = '0';
                        $banner_thumb['y_axis'] = '0';

                        //Loading Image Library
                        $this->load->library('image_lib', $banner_thumb);
                        $dataimage = $imgdata['file_name'];
                        //Creating Thumbnail
                        $this->image_lib->resize();
                        $thumberror = $this->image_lib->display_errors();
                    } else {
                        $thumberror = '';
                    }

                    if ($imgerror != '' || $thumberror != '') {
                        $error[0] = $imgerror;
                        $error[1] = $thumberror;
                        $error = $error[0] . $error[1];
                    } else {
                        $error = '';
                    }

                    if ($error) {
                        $this->session->set_flashdata('error', $error);
                        $redirect_url = site_url('banner');
                        redirect($redirect_url, 'refresh');
                    } else {
                        $banner = $imgdata['file_name'];
                    }

                    $old_image = $this->input->post('old_image');
                    $old_image_path = $this->config->item('banner_main_upload_path') . $old_image;
                    $old_image_thumb_path = $this->config->item('banner_thumb_upload_path') . $old_image;

                    if (file_exists($old_image_path)) {
                        unlink($old_image_path);
                    }
                    if (file_exists($old_image_thumb_path)) {
                        unlink($old_image_thumb_path);
                    }
                } else {
                    $banner = $this->input->post('old_image');
                }

                $update_array = array(
                    'name' => $name,
                    'link' => $link,
                    'description' => $description,
                    'modify_date' => date('Y-m-d H:i:s'),
                    'image' => $banner
                );

                $update_result = $this->common->update_data($update_array, 'banner', 'id', $banner_id);

                if ($update_result) {
                    $this->session->set_flashdata('success', 'Banner successfully updated');
                    redirect('banner', 'refresh');
                } else {
                    $this->session->set_flashdata('error', 'Errorin Occurred. Try Again!');
                    redirect('banner/edit/' . $banner_id, 'refresh');
                }
            }
        }

        $banner_detail = $this->common->select_data_by_id('banner', 'id', $id, '*');
        if (!empty($banner_detail)) {
            $this->data['module_name'] = 'Banner';
            $this->data['section_title'] = 'Edit Banner';
            $this->data['banner_detail'] = $banner_detail;

            $this->load->view('banner/edit', $this->data);
        } else {
            $this->session->set_flashdata('error', 'Errorout Occurred. Try Again.');
            redirect('banner', 'refresh');
        }
    }

    // banner status change
    public function change_status($banner_id = '', $status = '') {
        if ($banner_id == '' || $status == '') {
            $this->session->set_flashdata('error', 'Error Occurred. Try Agaim!');
            redirect('banner', 'refresh');
        }
        if ($status == 1) {
            $status = 2;
        } else {
            $status = 1;
        }
        $update_data = array('status' => $status);

        $update_result = $this->common->update_data($update_data, 'banner', 'id', $banner_id);
        if ($update_result) {
            $this->session->set_flashdata('success', 'Banner status successfully changed');
            redirect('banner', 'refresh');
        } else {
            $this->session->set_flashdata('error', 'Error Occurred. Try Again!');
            redirect('banner', 'refresh');
        }
    }

    // banner delete
    public function delete($id = '') {
        $update_array = array('status' => 3);
        $delete_result = $this->common->update_data($update_array, 'banner', 'id', $id);

        if ($delete_result) {
            $this->session->set_flashdata('success', 'Banner successfully deleted');
            redirect('banner', 'refresh');
        } else {
            $this->session->set_flashdata('error', 'Error Occurred. Try Again!');
            redirect('banner', 'refresh');
        }
    }

    public function do_upload_multiple_files($fieldName, $options) {

        $response = array();
        $files = $_FILES;
        $cpt = count($_FILES[$fieldName]['name']);
        for ($i = 0; $i < $cpt; $i++) {
            $_FILES[$fieldName]['name'] = $files[$fieldName]['name'][$i];
            $_FILES[$fieldName]['type'] = $files[$fieldName]['type'][$i];
            $_FILES[$fieldName]['tmp_name'] = $files[$fieldName]['tmp_name'][$i];
            $_FILES[$fieldName]['error'] = $files[$fieldName]['error'][$i];
            $_FILES[$fieldName]['size'] = $files[$fieldName]['size'][$i];

            $this->load->library('upload');
            $this->upload->initialize($options);

            //upload the image
            if (!$this->upload->do_upload($fieldName)) {
                $response['error'][] = $this->upload->display_errors();
            } else {
                $response['result'][] = $this->upload->data();
                $banner_thumb[$i]['image_library'] = 'gd2';
                $banner_thumb[$i]['source_image'] = $this->config->item('banner_main_upload_path') . $response['result'][$i]['file_name'];
                $banner_thumb[$i]['new_image'] = $this->config->item('banner_thumb_upload_path') . $response['result'][$i]['file_name'];
                $banner_thumb[$i]['create_thumb'] = TRUE;
                $banner_thumb[$i]['maintain_ratio'] = TRUE;
                $banner_thumb[$i]['thumb_marker'] = '';
                $banner_thumb[$i]['width'] = $this->config->item('banner_thumb_width');
                //$banner_thumb[$i]['height'] = $this->config->item('banner_thumb_height');
                $banner_thumb[$i]['height'] = 2;
                $banner_thumb[$i]['master_dim'] = 'width';
                $banner_thumb[$i]['quality'] = "100%";
                $banner_thumb[$i]['x_axis'] = '0';
                $banner_thumb[$i]['y_axis'] = '0';
                $instanse = "image_$i";

                //Loading Image Library
                $this->load->library('image_lib', $banner_thumb[$i], $instanse);
                $dataimage = $response['result'][$i]['file_name'];

                //Creating Thumbnail
                $this->$instanse->resize();
                $response['error'][] = $thumberror = $this->$instanse->display_errors();
            }
        }
//        echo "<pre>";
//        print_r($response);
//        die();
        return $response;
    }

    public function delete_image($id = '', $bannerimage_id = '') {
        if ($bannerimage_id != '' && $id != '') {

            $get_image = $this->common->select_data_by_id('banner_image', 'id', $bannerimage_id, $data = 'image', $join_str = array());
            $image_name = $get_image[0]['image'];

            $main_image = $this->config->item('banner_main_upload_path') . $image_name;
            $thumb_image = $this->config->item('banner_thumb_upload_path') . $image_name;

            if (file_exists($main_image)) {
                unlink($main_image);
            }
            if (file_exists($thumb_image)) {
                unlink($thumb_image);
            }
            $this->common->delete_data('banner_image', 'id', $bannerimage_id);
            redirect('banner/edit/' . $id, 'refresh');
        }
    }

    

}

?>