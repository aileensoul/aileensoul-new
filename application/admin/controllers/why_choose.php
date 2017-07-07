<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Why_choose extends MY_Controller {
    
    public $data;

    public function __construct() {

        parent::__construct();
        
        //$GLOBALS['record_per_page']=10;
        //site setting details
        $site_name_values = $this->common->select_data_by_id('settings', 'setting_id', '1', '*');
        $this->data['site_name'] = $site_name = $site_name_values[0]['setting_value'];
        //set header, footer and leftmenu
        $this->data['title'] = 'Why Choose the Dollarbid? | ' . $site_name;
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

    //display why_choose list
    public function index() {

        $this->data['module_name'] = 'Why Choose the Dollarbid?';
        $this->data['section_title'] = 'Why Choose the Dollarbid?';

        $contition_array = array('status !=' => '3');
        $this->data['why_choose_list'] = $this->common->select_data_by_condition('why_choose', $contition_array, '*', $short_by = '', $order_by = '', $limit = '', $offset = '');

        $this->load->view('why_choose/index', $this->data);
    }

    //add new why_choose
    public function add() {
        //check post and save data
        if ($this->input->post('btn_save')) {
            $name = $this->input->post('name');
            
            $error = '';
            if ($name == '') {
                $error = 1;
                $this->session->set_flashdata('error', 'Please enter name');
                redirect('why_choose/add', 'refresh');
            }
            if ($_FILES['image']['name'][0] == '') {
                $error = 1;
                $this->session->set_flashdata('error', 'Please select image');
                redirect('why_choose/add', 'refresh');
            }
            if ($error == 1) {
                $this->session->set_flashdata('error', 'Error Occurred. Try Again!');
                $redirect_url = site_url('why_choose/add');
                redirect($redirect_url, 'refresh');
            } else {

                $why_choose_image = '';

                $why_choose['upload_path'] = $this->config->item('why_main_upload_path');
                $why_choose['allowed_types'] = $this->config->item('why_allowed_types');
                $why_choose['max_size'] = $this->config->item('why_main_max_size');
                $why_choose['max_width'] = $this->config->item('why_main_max_width');
                $why_choose['max_height'] = $this->config->item('why_main_max_height');


                $this->load->library('upload');
                $this->upload->initialize($why_choose);
                //Uploading Image
                $this->upload->do_upload('image');
                //Getting Uploaded Image File Data
                $imgdata = $this->upload->data();
                $imgerror = $this->upload->display_errors();
                if ($imgerror == '') {
                    //Configuring Thumbnail 
                    $why_choose_thumb['image_library'] = 'gd2';
                    $why_choose_thumb['source_image'] = $why_choose['upload_path'] . $imgdata['file_name'];
                    $why_choose_thumb['new_image'] = $this->config->item('why_thumb_upload_path') . $imgdata['file_name'];
                    $why_choose_thumb['create_thumb'] = TRUE;
                    $why_choose_thumb['maintain_ratio'] = FALSE;
                    $why_choose_thumb['thumb_marker'] = '';
                    $why_choose_thumb['width'] = $this->config->item('why_thumb_width');
                    $why_choose_thumb['height'] = $this->config->item('why_thumb_height');

                    //Loading Image Library
                    $this->load->library('image_lib', $why_choose_thumb);
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
                    $redirect_url = site_url('why_choose');
                    redirect($redirect_url, 'refresh');
                } else {
                    $why_choose = $imgdata['file_name'];
                }

                $insert_array = array(
                    'name' => $name,
                    'image' => $why_choose,
                    'create_date' => date('Y-m-d h:i:s'),
                    'modify_date' => date('Y-m-d h:i:s'),
                    'status' => 1,
                );

                $insert_id = $this->common->insert_data_getid($insert_array, 'why_choose');

                if ($insert_id > 0) {
                    $this->session->set_flashdata('success', 'Why CHoose Icon successfully inserted');
                    $redirect_url = site_url('why_choose');
                    redirect($redirect_url, 'refresh');
                } else {
                    $this->session->set_flashdata('error', 'Error Occurred. Try Again!');
                    $redirect_url = site_url('why_choose/add');
                    redirect($redirect_url, 'refresh');
                }
            }
        }


        // define module name and section title
        $this->data['module_name'] = 'Why Choose the Dollarbid?';
        $this->data['section_title'] = 'Add Why Choose the Dollarbid?';

        $this->load->view('why_choose/add', $this->data);
    }

    //update the user detail
    public function edit($id = '') {
        if ($this->input->post('why_id')) {

            $why_id = $this->input->post('why_id');
            $name = $this->input->post('name');
            
            $error = '';
            if ($name == '') {
                $error = 1;
                $this->session->set_flashdata('error', 'Please enter name');
                redirect('why_choose/edit/'.$why_id, 'refresh');
            }
            if ($error == 1) {
                $this->session->set_flashdata('error', 'Error Occurred. Try Again!');
                $redirect_url = site_url('why_choose/edit/'.$why_id);
                redirect($redirect_url, 'refresh');
            } else {

                if ($_FILES['image']['name'] != '') {

                    $why_choose['upload_path'] = $this->config->item('why_main_upload_path');
                    $why_choose['allowed_types'] = $this->config->item('why_allowed_types');
                    $why_choose['max_size'] = $this->config->item('why_main_max_size');
                    $why_choose['max_width'] = $this->config->item('why_main_max_width');
                    $why_choose['max_height'] = $this->config->item('why_main_max_height');

                    //    $this->load->library('upload', $event);

                    $this->load->library('upload');
                    $this->upload->initialize($why_choose);
                    //Uploading Image
                    $this->upload->do_upload('image');
                    //Getting Uploaded Image File Data
                    $imgdata = $this->upload->data();
                    $imgerror = $this->upload->display_errors();
                    if ($imgerror == '') {
                        //Configuring Thumbnail 
                        $why_choose_thumb['image_library'] = 'gd2';
                        $why_choose_thumb['source_image'] = $why_choose['upload_path'] . $imgdata['file_name'];
                        $why_choose_thumb['new_image'] = $this->config->item('why_thumb_upload_path') . $imgdata['file_name'];
                        $why_choose_thumb['create_thumb'] = TRUE;
                        $why_choose_thumb['maintain_ratio'] = FALSE;
                        $why_choose_thumb['thumb_marker'] = '';
                        $why_choose_thumb['width'] = $this->config->item('why_thumb_width');
                        $why_choose_thumb['height'] = $this->config->item('why_thumb_height');

                        //Loading Image Library
                        $this->load->library('image_lib', $why_choose_thumb);
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
                        $redirect_url = site_url('why_choose');
                        redirect($redirect_url, 'refresh');
                    } else {
                        $why_choose = $imgdata['file_name'];
                    }

                    $old_image = $this->input->post('old_image');
                    $old_image_path = $this->config->item('why_main_upload_path') . $old_image;
                    $old_image_thumb_path = $this->config->item('why_thumb_upload_path') . $old_image;

                    if (file_exists($old_image_path)) {
                        unlink($old_image_path);
                    }
                    if (file_exists($old_image_thumb_path)) {
                        unlink($old_image_thumb_path);
                    }
                } else {
                    $why_choose = $this->input->post('old_image');
                }

                $update_array = array(
                    'name' => $name,
                    'modify_date' => date('Y-m-d h:i:s'),
                    'image' => $why_choose
                );

                $update_result = $this->common->update_data($update_array, 'why_choose', 'id', $why_id);

                if ($update_result) {
                    $this->session->set_flashdata('success', 'Why Choose icon successfully updated');
                    redirect('why_choose', 'refresh');
                } else {
                    $this->session->set_flashdata('error', 'Errorin Occurred. Try Again!');
                    redirect('why_choose/edit/' . $why_id, 'refresh');
                }
            }
        }

        $why_choose_detail = $this->common->select_data_by_id('why_choose', 'id', $id, '*');
        if (!empty($why_choose_detail)) {
            $this->data['module_name'] = 'Why Choose the Dollarbid?';
            $this->data['section_title'] = 'Edit Why Choose the Dollarbid?';
            $this->data['why_choose_detail'] = $why_choose_detail;

            $this->load->view('why_choose/edit', $this->data);
        } else {
            $this->session->set_flashdata('error', 'Errorout Occurred. Try Again.');
            redirect('why_choose', 'refresh');
        }
    }

    // why_choose status change
    public function change_status($why_id = '', $status = '') {
        if ($why_id == '' || $status == '') {
            $this->session->set_flashdata('error', 'Error Occurred. Try Agaim!');
            redirect('why_choose', 'refresh');
        }
        if ($status == 1) {
            $status = 2;
        } else {
            $status = 1;
        }
        $update_data = array('status' => $status);

        $update_result = $this->common->update_data($update_data, 'why_choose', 'id', $why_id);
        if ($update_result) {
            $this->session->set_flashdata('success', 'Deals promotions status successfully changed');
            redirect('why_choose', 'refresh');
        } else {
            $this->session->set_flashdata('error', 'Error Occurred. Try Again!');
            redirect('why_choose', 'refresh');
        }
    }

    // why_choose delete
    public function delete($id = '') {
        $update_array = array('status' => 3);
        $delete_result = $this->common->update_data($update_array, 'why_choose', 'id', $id);

        if ($delete_result) {
            $this->session->set_flashdata('success', 'Deals promotions successfully deleted');
            redirect('why_choose', 'refresh');
        } else {
            $this->session->set_flashdata('error', 'Error Occurred. Try Again!');
            redirect('why_choose', 'refresh');
        }
    }

    public function delete_image($id = '', $why_chooseimage_id = '') {
        if ($why_chooseimage_id != '' && $id != '') {

            $get_image = $this->common->select_data_by_id('why_choose_image', 'id', $why_chooseimage_id, $data = 'image', $join_str = array());
            $image_name = $get_image[0]['image'];

            $main_image = $this->config->item('why_choose_main_upload_path') . $image_name;
            $thumb_image = $this->config->item('why_choose_thumb_upload_path') . $image_name;

            if (file_exists($main_image)) {
                unlink($main_image);
            }
            if (file_exists($thumb_image)) {
                unlink($thumb_image);
            }
            $this->common->delete_data('why_choose_image', 'id', $why_chooseimage_id);
            redirect('why_choose/edit/' . $id, 'refresh');
        }
    }

}

?>