<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Global_community extends MY_Controller {

    public $data;

    public function __construct() {

        parent::__construct();

        //site setting details
        $site_name_values = $this->common->select_data_by_id('settings', 'setting_id', '1', '*');
        $this->data['site_name'] = $site_name = $site_name_values[0]['setting_value'];
        //set header, footer and leftmenu
        $this->data['title'] = 'Global Community : ' . $site_name;
        $this->data['header'] = $this->load->view('header', $this->data);
        $this->data['leftmenu'] = $this->load->view('leftmenu', $this->data);
        $this->data['footer'] = $this->load->view('footer', $this->data, true);

        // load common model
        $this->load->model('common');

        //remove catch so after logout cannot view last visited page if that page is this
        $this->output->set_header('Last-Modified:' . gmdate('D, d M Y H:i:s') . 'GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
        $this->output->set_header('Cache-Control: post-check=0, pre-check=0', false);
        $this->output->set_header('Pragma: no-cache');
    }

    //display global list
    public function index() {

        $this->data['module_name'] = 'Global Community Management';
        $this->data['section_title'] = 'Global Community';

        $contition_array = array('status !=' => '3');
        $this->data['global_community'] = $this->common->select_data_by_condition('global_community', $contition_array, '*', $short_by = '', $order_by = '', $limit = '', $offset = '');
        //load global community data
        $this->load->view('global_community/index', $this->data);
    }

    //update the global detail
    public function edit($id = '') {

        if ($this->input->post('global_id')) {

            $global_id = $this->input->post('global_id');
            if ($this->input->post('name') == '') {
                $this->session->set_flashdata('error', 'Global Community name is required');
                redirect('global_community', 'refresh');
            } else {
                $global_image = '';
                if ($_FILES['image']['name'] != '') {
                    $global['upload_path'] = $this->config->item('global_main_upload_path');
                    $global['allowed_types'] = $this->config->item('global_allowed_types');
                    $global['max_size'] = $this->config->item('global_main_max_size');
                    $global['max_width'] = $this->config->item('global_main_max_width');
                    $global['max_height'] = $this->config->item('global_main_max_height');


                    $this->load->library('upload');
                    $this->upload->initialize($global);
                    //Uploading Image
                    $this->upload->do_upload('image');
                    //Getting Uploaded Image File Data
                    $imgdata = $this->upload->data();
                    $imgerror = $this->upload->display_errors();
                    if ($imgerror == '') {
                        //Configuring Thumbnail 
                        $global_thumb['image_library'] = 'gd2';
                        $global_thumb['source_image'] = $global['upload_path'] . $imgdata['file_name'];
                        $global_thumb['new_image'] = $this->config->item('global_thumb_upload_path') . $imgdata['file_name'];
                        $global_thumb['create_thumb'] = TRUE;
                        $global_thumb['maintain_ratio'] = TRUE;
                        $global_thumb['thumb_marker'] = '';
                        $global_thumb['width'] = $this->config->item('global_thumb_width');
                        //$global_thumb['height'] = $this->config->item('global_thumb_height');
                        $global_thumb['height'] = 2;
                        $global_thumb['master_dim'] = 'width';
                        $global_thumb['quality'] = "100%";
                        $global_thumb['x_axis'] = '0';
                        $global_thumb['y_axis'] = '0';
                        //Loading Image Library
                        $this->load->library('image_lib', $global_thumb);
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
                        $redirect_url = site_url('global_community');
                        redirect($redirect_url, 'refresh');
                    } else {
                        $global = $imgdata['file_name'];
                    }
                } else {
                    if ($this->input->post('old_image')) {
                        $global = $this->input->post('old_image');
                    } else {
                        $global = '';
                    }
                }

                $global_image1 = '';
                if ($_FILES['hover_image']['name'] != '') {
                    $global2['upload_path'] = $this->config->item('global_main_upload_path');
                    $global2['allowed_types'] = $this->config->item('global_allowed_types');
                    $global2['max_size'] = $this->config->item('global_main_max_size');
                    $global2['max_width'] = $this->config->item('global_main_max_width');
                    $global2['max_height'] = $this->config->item('global_main_max_height');


                    $this->load->library('upload');
                    $this->upload->initialize($global2);
                    //Uploading Image
                    $this->upload->do_upload('hover_image');
                    //Getting Uploaded Image File Data
                    $imgdata1 = $this->upload->data();
                    $imgerror = $this->upload->display_errors();
                    if ($imgerror == '') {
                        //Configuring Thumbnail 
                        $global_thumb2['image_library'] = 'gd2';
                        $global_thumb2['source_image'] = $global2['upload_path'] . $imgdata1['file_name'];
                        $global_thumb2['new_image'] = $this->config->item('global_thumb_upload_path') . $imgdata1['file_name'];
                        $global_thumb2['create_thumb'] = TRUE;
                        $global_thumb2['maintain_ratio'] = TRUE;
                        $global_thumb2['thumb_marker'] = '';
                        $global_thumb2['width'] = $this->config->item('global_thumb_width');
                        //$global_thumb['height'] = $this->config->item('global_thumb_height');
                        $global_thumb2['height'] = 2;
                        $global_thumb2['master_dim'] = 'width';
                        $global_thumb2['quality'] = "100%";
                        $global_thumb2['x_axis'] = '0';
                        $global_thumb2['y_axis'] = '0';
                        //Loading Image Library
                        $this->load->library('image_lib', $global_thumb2);
                        $dataimage = $imgdata1['file_name'];
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
                        $redirect_url = site_url('global_community');
                        redirect($redirect_url, 'refresh');
                    } else {
                        $global1 = $imgdata1['file_name'];
                    }
                } else {
                    if ($this->input->post('old_hover_image') != '') {
                        $global1 = $this->input->post('old_hover_image');
                    } else {
                        $global1 = '';
                    }
                }


                $update_array = array(
                    'name' => trim($this->input->post('name')),
                    'link' => trim($this->input->post('link')),
                    'image' => $global,
                    'hover_image' => $global1,
                    'modify_date' => date('Y-m-d H:i:s')
                );
                $update_result = $this->common->update_data($update_array, 'global_community', 'id', $this->input->post('global_id'));

                if ($update_result) {
                    $this->session->set_flashdata('success', 'Category successfully updated.');
                    redirect('global_community', 'refresh');
                } else {
                    $this->session->set_flashdata('error', 'Error Occurred. Try Again!');
                    redirect('global_community', 'refresh');
                }
            }
        }
        $global_community_detail = $this->common->select_data_by_id('global_community', 'id', $id, '*');

        if (!empty($global_community_detail)) {
            $this->data['module_name'] = 'Global Community';
            $this->data['section_title'] = 'Edit Global Community';
            $this->data['global_community_detail'] = $global_community_detail;
            $this->load->view('global_community/edit', $this->data);
        } else {
            $this->session->set_flashdata('error', 'Errorout Occurred. Try Again.');
            redirect('global_community', 'refresh');
        }
    }

    // get name by id

    function getCatName() {
        if ($this->input->post('global_id')) {
            $global_id = $this->input->post('global_id');
            $contition_array = array('id' => $global_id);
            $data = 'name';
            $global_name = $this->common->select_data_by_condition('global', $contition_array, $data, $short_by = '', $order_by = '', $limit = '', $offset = '');

            $return_data = array();
            $return_data['global_name'] = $global_name[0]['name'];
            header('Content-Type: application/json');
            echo json_encode($return_data);
            exit;
        }
    }

    public function delete_image($id = '', $globalimage_id = '') {
        if ($globalimage_id != '' && $id != '') {

            $get_image = $this->common->select_data_by_id('global_banner', 'id', $globalimage_id, $data = 'image', $join_str = array());
            $image_name = $get_image[0]['image'];

            $main_image = $this->config->item('global_main_upload_path') . $image_name;
            $thumb_image = $this->config->item('global_thumb_upload_path') . $image_name;

            if (file_exists($main_image)) {
                unlink($main_image);
            }
            if (file_exists($thumb_image)) {
                unlink($thumb_image);
            }
            $this->common->delete_data('global_banner', 'id', $globalimage_id);
            redirect('global_community/edit/' . $id, 'refresh');
        }
    }

}

?>