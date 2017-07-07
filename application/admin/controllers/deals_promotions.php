<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Deals_promotions extends MY_Controller {

    public $data;

    public function __construct() {

        parent::__construct();

        //$GLOBALS['record_per_page']=10;
        //site setting details
        $site_name_values = $this->common->select_data_by_id('settings', 'setting_id', '1', '*');
        $this->data['site_name'] = $site_name = $site_name_values[0]['setting_value'];
        //set header, footer and leftmenu
        $this->data['title'] = 'Deals Promotions | ' . $site_name;
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

    //display deals_promotions list
    public function index() {

        $this->data['module_name'] = 'Deals Promotions';
        $this->data['section_title'] = 'Deals Promotions';

        $contition_array = array('status !=' => '3');
        $this->data['deals_promotions_list'] = $this->common->select_data_by_condition('deals_promotions', $contition_array, '*', $short_by = '', $order_by = '', $limit = '', $offset = '');

        $this->load->view('deals_promotions/index', $this->data);
    }

    //add new deals_promotions
    public function add() {
        //check post and save data
        if ($this->input->post('btn_save')) {
            $name = $this->input->post('name');
            $link = $this->input->post('link');
            
            $error = '';
            if ($name == '') {
                $error = 1;
                $this->session->set_flashdata('error', 'Please enter name');
                redirect('deals_promotions/add', 'refresh');
            }
            if ($link == '') {
                $error = 1;
                $this->session->set_flashdata('error', 'Please enter link');
                redirect('deals_promotions/add', 'refresh');
            }
            if ($_FILES['image']['name'][0] == '') {
                $error = 1;
                $this->session->set_flashdata('error', 'Please select image');
                redirect('deals_promotions/add', 'refresh');
            }
            if ($error == 1) {
                $this->session->set_flashdata('error', 'Error Occurred. Try Again!');
                $redirect_url = site_url('deals_promotions/add');
                redirect($redirect_url, 'refresh');
            } else {

                $deals_promotions_image = '';

                $deals_promotions['upload_path'] = $this->config->item('deals_main_upload_path');
                $deals_promotions['allowed_types'] = $this->config->item('deals_allowed_types');
                $deals_promotions['max_size'] = $this->config->item('deals_main_max_size');
                $deals_promotions['max_width'] = $this->config->item('deals_main_max_width');
                $deals_promotions['max_height'] = $this->config->item('deals_main_max_height');


                $this->load->library('upload');
                $this->upload->initialize($deals_promotions);
                //Uploading Image
                $this->upload->do_upload('image');
                //Getting Uploaded Image File Data
                $imgdata = $this->upload->data();
                $imgerror = $this->upload->display_errors();
                if ($imgerror == '') {
                    //Configuring Thumbnail 
                    $deals_promotions_thumb['image_library'] = 'gd2';
                    $deals_promotions_thumb['source_image'] = $deals_promotions['upload_path'] . $imgdata['file_name'];
                    $deals_promotions_thumb['new_image'] = $this->config->item('deals_thumb_upload_path') . $imgdata['file_name'];
                    $deals_promotions_thumb['create_thumb'] = TRUE;
                    $deals_promotions_thumb['maintain_ratio'] = FALSE;
                    $deals_promotions_thumb['thumb_marker'] = '';
                    $deals_promotions_thumb['width'] = $this->config->item('deals_thumb_width');
                    $deals_promotions_thumb['height'] = $this->config->item('deals_thumb_height');

                    //Loading Image Library
                    $this->load->library('image_lib', $deals_promotions_thumb);
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
                    $redirect_url = site_url('deals_promotions');
                    redirect($redirect_url, 'refresh');
                } else {
                    $deals_promotions = $imgdata['file_name'];
                }

                $insert_array = array(
                    'name' => $name,
                    'link' => $link,
                    'image' => $deals_promotions,
                    'create_date' => date('Y-m-d h:i:s'),
                    'modify_date' => date('Y-m-d h:i:s'),
                    'status' => 1,
                );

                $insert_id = $this->common->insert_data_getid($insert_array, 'deals_promotions');

                if ($insert_id > 0) {
                    $this->session->set_flashdata('success', 'Deals Promotions successfully inserted');
                    $redirect_url = site_url('deals_promotions');
                    redirect($redirect_url, 'refresh');
                } else {
                    $this->session->set_flashdata('error', 'Error Occurred. Try Again!');
                    $redirect_url = site_url('deals_promotions/add');
                    redirect($redirect_url, 'refresh');
                }
            }
        }


        // define module name and section title
        $this->data['module_name'] = 'Deals Promotions';
        $this->data['section_title'] = 'Add Deals Promotions';

        $this->load->view('deals_promotions/add', $this->data);
    }

    //update the user detail
    public function edit($id = '') {
        if ($this->input->post('deals_id')) {

            $deal_id = $this->input->post('deals_id');
            $name = $this->input->post('name');
            $link = $this->input->post('link');
            
            $error = '';
            if ($name == '') {
                $error = 1;
                $this->session->set_flashdata('error', 'Please enter name');
                redirect('deals_promotions/edit/'.$deal_id, 'refresh');
            }
            if ($link == '') {
                $error = 1;
                $this->session->set_flashdata('error', 'Please enter link');
                redirect('deals_promotions/edit/'.$deal_id, 'refresh');
            }
            if ($error == 1) {
                $this->session->set_flashdata('error', 'Error Occurred. Try Again!');
                $redirect_url = site_url('deals_promotions/edit/'.$deal_id);
                redirect($redirect_url, 'refresh');
            } else {

                if ($_FILES['image']['name'] != '') {

                    $deals_promotions['upload_path'] = $this->config->item('deals_main_upload_path');
                    $deals_promotions['allowed_types'] = $this->config->item('deals_allowed_types');
                    $deals_promotions['max_size'] = $this->config->item('deals_main_max_size');
                    $deals_promotions['max_width'] = $this->config->item('deals_main_max_width');
                    $deals_promotions['max_height'] = $this->config->item('deals_main_max_height');

                    //    $this->load->library('upload', $event);

                    $this->load->library('upload');
                    $this->upload->initialize($deals_promotions);
                    //Uploading Image
                    $this->upload->do_upload('image');
                    //Getting Uploaded Image File Data
                    $imgdata = $this->upload->data();
                    $imgerror = $this->upload->display_errors();
                    if ($imgerror == '') {
                        //Configuring Thumbnail 
                        $deals_promotions_thumb['image_library'] = 'gd2';
                        $deals_promotions_thumb['source_image'] = $deals_promotions['upload_path'] . $imgdata['file_name'];
                        $deals_promotions_thumb['new_image'] = $this->config->item('deals_thumb_upload_path') . $imgdata['file_name'];
                        $deals_promotions_thumb['create_thumb'] = TRUE;
                        $deals_promotions_thumb['maintain_ratio'] = FALSE;
                        $deals_promotions_thumb['thumb_marker'] = '';
                        $deals_promotions_thumb['width'] = $this->config->item('deals_thumb_width');
                        $deals_promotions_thumb['height'] = $this->config->item('deals_thumb_height');

                        //Loading Image Library
                        $this->load->library('image_lib', $deals_promotions_thumb);
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
                        $redirect_url = site_url('deals_promotions');
                        redirect($redirect_url, 'refresh');
                    } else {
                        $deals_promotions = $imgdata['file_name'];
                    }

                    $old_image = $this->input->post('old_image');
                    $old_image_path = $this->config->item('deals_main_upload_path') . $old_image;
                    $old_image_thumb_path = $this->config->item('deals_thumb_upload_path') . $old_image;

                    if (file_exists($old_image_path)) {
                        unlink($old_image_path);
                    }
                    if (file_exists($old_image_thumb_path)) {
                        unlink($old_image_thumb_path);
                    }
                } else {
                    $deals_promotions = $this->input->post('old_image');
                }

                $update_array = array(
                    'name' => $name,
                    'link' => $link,
                    'modify_date' => date('Y-m-d h:i:s'),
                    'image' => $deals_promotions
                );

                $update_result = $this->common->update_data($update_array, 'deals_promotions', 'id', $deal_id);

                if ($update_result) {
                    $this->session->set_flashdata('success', 'Deals promotions successfully updated');
                    redirect('deals_promotions', 'refresh');
                } else {
                    $this->session->set_flashdata('error', 'Errorin Occurred. Try Again!');
                    redirect('deals_promotions/edit/' . $deal_id, 'refresh');
                }
            }
        }

        $deals_promotions_detail = $this->common->select_data_by_id('deals_promotions', 'id', $id, '*');
        if (!empty($deals_promotions_detail)) {
            $this->data['module_name'] = 'Deals Promotions';
            $this->data['section_title'] = 'Edit Deals Promotions';
            $this->data['deals_promotions_detail'] = $deals_promotions_detail;

            $this->load->view('deals_promotions/edit', $this->data);
        } else {
            $this->session->set_flashdata('error', 'Errorout Occurred. Try Again.');
            redirect('deals_promotions', 'refresh');
        }
    }

    // deals_promotions status change
    public function change_status($deal_id = '', $status = '') {
        if ($deal_id == '' || $status == '') {
            $this->session->set_flashdata('error', 'Error Occurred. Try Agaim!');
            redirect('deals_promotions', 'refresh');
        }
        if ($status == 1) {
            $status = 2;
        } else {
            $status = 1;
        }
        $update_data = array('status' => $status);

        $update_result = $this->common->update_data($update_data, 'deals_promotions', 'id', $deal_id);
        if ($update_result) {
            $this->session->set_flashdata('success', 'Deals promotions status successfully changed');
            redirect('deals_promotions', 'refresh');
        } else {
            $this->session->set_flashdata('error', 'Error Occurred. Try Again!');
            redirect('deals_promotions', 'refresh');
        }
    }

    // deals_promotions delete
    public function delete($id = '') {
        $update_array = array('status' => 3);
        $delete_result = $this->common->update_data($update_array, 'deals_promotions', 'id', $id);

        if ($delete_result) {
            $this->session->set_flashdata('success', 'Deals promotions successfully deleted');
            redirect('deals_promotions', 'refresh');
        } else {
            $this->session->set_flashdata('error', 'Error Occurred. Try Again!');
            redirect('deals_promotions', 'refresh');
        }
    }

    public function delete_image($id = '', $deals_promotionsimage_id = '') {
        if ($deals_promotionsimage_id != '' && $id != '') {

            $get_image = $this->common->select_data_by_id('deals_promotions_image', 'id', $deals_promotionsimage_id, $data = 'image', $join_str = array());
            $image_name = $get_image[0]['image'];

            $main_image = $this->config->item('deals_promotions_main_upload_path') . $image_name;
            $thumb_image = $this->config->item('deals_promotions_thumb_upload_path') . $image_name;

            if (file_exists($main_image)) {
                unlink($main_image);
            }
            if (file_exists($thumb_image)) {
                unlink($thumb_image);
            }
            $this->common->delete_data('deals_promotions_image', 'id', $deals_promotionsimage_id);
            redirect('deals_promotions/edit/' . $id, 'refresh');
        }
    }

}

?>