<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Local_community extends MY_Controller {

    public $data;

    public function __construct() {

        parent::__construct();

        //$GLOBALS['record_per_page']=10;
        //site setting details
        $site_name_values = $this->common->select_data_by_id('settings', 'setting_id', '1', '*');
        $this->data['site_name'] = $site_name = $site_name_values[0]['setting_value'];
        //set header, footer and leftmenu
        $this->data['title'] = 'Local Community | ' . $site_name;
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

    //display local_community list
    public function index() {

        $this->data['module_name'] = 'Local Community';
        $this->data['section_title'] = 'Local Community';

        $contition_array = array('status !=' => '3');
        $this->data['local_community_list'] = $this->common->select_data_by_condition('local_community', $contition_array, '*', $short_by = '', $order_by = '', $limit = '', $offset = '');

        $this->load->view('local_community/index', $this->data);
    }

    //add new local_community
    public function add() {
        //check post and save data
        if ($this->input->post('btn_save')) {
            $description = $this->input->post('description');
            $name = $this->input->post('name');
            $designation = $this->input->post('designation');
            
            $error = '';
            if ($name == '') {
                $error = 1;
                $this->session->set_flashdata('error', 'Please enter description');
                redirect('local_community/add', 'refresh');
            }
            if ($designation == '') {
                $error = 1;
                $this->session->set_flashdata('error', 'Please enter description');
                redirect('local_community/add', 'refresh');
            }
            if ($description == '') {
                $error = 1;
                $this->session->set_flashdata('error', 'Please enter description');
                redirect('local_community/add', 'refresh');
            }
            if ($_FILES['image']['name'] == '') {
                $error = 1;
                $this->session->set_flashdata('error', 'Please select atleast one image');
                redirect('local_community/add', 'refresh');
            }
            if ($error == 1) {
                $this->session->set_flashdata('error', 'Error Occurred. Try Again!');
                $redirect_url = site_url('local_community/add');
                redirect($redirect_url, 'refresh');
            } else {

                $local_community_image = '';

                $local_community['upload_path'] = $this->config->item('local_main_upload_path');
                $local_community['allowed_types'] = $this->config->item('local_allowed_types');
                $local_community['max_size'] = $this->config->item('local_main_max_size');
                $local_community['max_width'] = $this->config->item('local_main_max_width');
                $local_community['max_height'] = $this->config->item('local_main_max_height');


                $this->load->library('upload');
                $this->upload->initialize($local_community);
                //Uploading Image
                $this->upload->do_upload('image');
                //Getting Uploaded Image File Data
                $imgdata = $this->upload->data();
                $imgerror = $this->upload->display_errors();
                if ($imgerror == '') {
                    //Configuring Thumbnail 
                    $local_community_thumb['image_library'] = 'gd2';
                    $local_community_thumb['source_image'] = $local_community['upload_path'] . $imgdata['file_name'];
                    $local_community_thumb['new_image'] = $this->config->item('local_thumb_upload_path') . $imgdata['file_name'];
                    $local_community_thumb['create_thumb'] = TRUE;
                    $local_community_thumb['maintain_ratio'] = FALSE;
                    $local_community_thumb['thumb_marker'] = '';
                    $local_community_thumb['width'] = $this->config->item('local_thumb_width');
                    $local_community_thumb['height'] = $this->config->item('local_thumb_height');

                    //Loading Image Library
                    $this->load->library('image_lib', $local_community_thumb);
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
                    $redirect_url = site_url('local_community');
                    redirect($redirect_url, 'refresh');
                } else {
                    $local_community = $imgdata['file_name'];
                }

                $insert_array = array(
                    'name' => $name,
                    'designation' => $designation,
                    'description' => $description,
                    'image' => $local_community,
                    'create_date' => date('Y-m-d h:i:s'),
                    'modify_date' => date('Y-m-d h:i:s'),
                    'status' => 1,
                );

                $insert_id = $this->common->insert_data_getid($insert_array, 'local_community');

                if ($insert_id > 0) {
                    $this->session->set_flashdata('success', 'Local Community successfully inserted');
                    $redirect_url = site_url('local_community');
                    redirect($redirect_url, 'refresh');
                } else {
                    $this->session->set_flashdata('error', 'Error Occurred. Try Again!');
                    $redirect_url = site_url('local_community/add');
                    redirect($redirect_url, 'refresh');
                }
            }
        }


        // define module name and section title
        $this->data['module_name'] = 'Local Community';
        $this->data['section_title'] = 'Add Local Community';

        $this->load->view('local_community/add', $this->data);
    }

    //update the user detail
    public function edit($id = '') {
        if ($this->input->post('local_id')) {

            $local_id = $this->input->post('local_id');
            $description = $this->input->post('description');
            $name = $this->input->post('name');
            $designation = $this->input->post('designation');
            
            $error = '';
            if ($description == '') {
                $error = 1;
                $this->session->set_flashdata('error', 'Please enter description');
                redirect('local_community/edit/'.$local_id, 'refresh');
            }
            if ($error == 1) {
                
                $this->session->set_flashdata('error', 'Error Occurred. Try Again!');
                $redirect_url = site_url('local_community/edit/'.$local_id);
                redirect($redirect_url, 'refresh');
            } else {
                
                if ($_FILES['image']['name'] != '') {

                    $local_community['upload_path'] = $this->config->item('local_main_upload_path');
                    $local_community['allowed_types'] = $this->config->item('local_allowed_types');
                    $local_community['max_size'] = $this->config->item('local_main_max_size');
                    $local_community['max_width'] = $this->config->item('local_main_max_width');
                    $local_community['max_height'] = $this->config->item('local_main_max_height');

                    //    $this->load->library('upload', $event);

                    $this->load->library('upload');
                    $this->upload->initialize($local_community);
                    //Uploading Image
                    $this->upload->do_upload('image');
                    //Getting Uploaded Image File Data
                    $imgdata = $this->upload->data();
                    $imgerror = $this->upload->display_errors();
                    if ($imgerror == '') {
                        //Configuring Thumbnail 
                        $local_community_thumb['image_library'] = 'gd2';
                        $local_community_thumb['source_image'] = $local_community['upload_path'] . $imgdata['file_name'];
                        $local_community_thumb['new_image'] = $this->config->item('local_thumb_upload_path') . $imgdata['file_name'];
                        $local_community_thumb['create_thumb'] = TRUE;
                        $local_community_thumb['maintain_ratio'] = FALSE;
                        $local_community_thumb['thumb_marker'] = '';
                        $local_community_thumb['width'] = $this->config->item('local_thumb_width');
                        $local_community_thumb['height'] = $this->config->item('local_thumb_height');

                        //Loading Image Library
                        $this->load->library('image_lib', $local_community_thumb);
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
                        $redirect_url = site_url('local_community');
                        redirect($redirect_url, 'refresh');
                    } else {
                        $local_community = $imgdata['file_name'];
                    }

                    $old_image = $this->input->post('old_image');
                    $old_image_path = $this->config->item('local_main_upload_path') . $old_image;
                    $old_image_thumb_path = $this->config->item('local_thumb_upload_path') . $old_image;

                    if (file_exists($old_image_path)) {
                        unlink($old_image_path);
                    }
                    if (file_exists($old_image_thumb_path)) {
                        unlink($old_image_thumb_path);
                    }
                } else {
                    $local_community = $this->input->post('old_image');
                }

                $update_array = array(
                    'name' => $name,
                    'designation' => $designation,
                    'description' => $description,
                    'modify_date' => date('Y-m-d h:i:s'),
                    'image' => $local_community
                );

                $update_result = $this->common->update_data($update_array, 'local_community', 'id', $local_id);

                if ($update_result) {
                    $this->session->set_flashdata('success', 'Local Community successfully updated');
                    redirect('local_community', 'refresh');
                } else {
                    $this->session->set_flashdata('error', 'Errorin Occurred. Try Again!');
                    redirect('local_community/edit/' . $local_id, 'refresh');
                }
            }
        }

        $local_community_detail = $this->common->select_data_by_id('local_community', 'id', $id, '*');
        if (!empty($local_community_detail)) {
            $this->data['module_name'] = 'Local Community';
            $this->data['section_title'] = 'Edit Local Community';
            $this->data['local_community_detail'] = $local_community_detail;

            $this->load->view('local_community/edit', $this->data);
        } else {
            $this->session->set_flashdata('error', 'Errorout Occurred. Try Again.');
            redirect('local_community', 'refresh');
        }
    }

    // local_community status change
    public function change_status($local_id = '', $status = '') {
        if ($local_id == '' || $status == '') {
            $this->session->set_flashdata('error', 'Error Occurred. Try Agaim!');
            redirect('local_community', 'refresh');
        }
        if ($status == 1) {
            $status = 2;
        } else {
            $status = 1;
        }
        $update_data = array('status' => $status);

        $update_result = $this->common->update_data($update_data, 'local_community', 'id', $local_id);
        if ($update_result) {
            $this->session->set_flashdata('success', 'Local Community status successfully changed');
            redirect('local_community', 'refresh');
        } else {
            $this->session->set_flashdata('error', 'Error Occurred. Try Again!');
            redirect('local_community', 'refresh');
        }
    }

    // local_community delete
    public function delete($id = '') {
        $update_array = array('status' => 3);
        $delete_result = $this->common->update_data($update_array, 'local_community', 'id', $id);

        if ($delete_result) {
            $this->session->set_flashdata('success', 'Local Community successfully deleted');
            redirect('local_community', 'refresh');
        } else {
            $this->session->set_flashdata('error', 'Error Occurred. Try Again!');
            redirect('local_community', 'refresh');
        }
    }

    public function delete_image($id = '', $local_communityimage_id = '') {
        if ($local_communityimage_id != '' && $id != '') {

            $get_image = $this->common->select_data_by_id('local_community_image', 'id', $local_communityimage_id, $data = 'image', $join_str = array());
            $image_name = $get_image[0]['image'];

            $main_image = $this->config->item('local_community_main_upload_path') . $image_name;
            $thumb_image = $this->config->item('local_community_thumb_upload_path') . $image_name;

            if (file_exists($main_image)) {
                unlink($main_image);
            }
            if (file_exists($thumb_image)) {
                unlink($thumb_image);
            }
            $this->common->delete_data('local_community_image', 'id', $local_communityimage_id);
            redirect('local_community/edit/' . $id, 'refresh');
        }
    }

}

?>