<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Category extends MY_Controller {

    public $data;

    public function __construct() {

        parent::__construct();

        //site setting details
        $site_name_values = $this->common->select_data_by_id('settings', 'setting_id', '1', '*');
        $this->data['site_name'] = $site_name = $site_name_values[0]['setting_value'];
        //set header, footer and leftmenu
        $this->data['title'] = 'Category : ' . $site_name;
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

    //display category list
    public function index() {

        $this->data['module_name'] = 'Category Management';
        $this->data['section_title'] = 'Category Management';

        $contition_array = array('status != ' => '3');
        $data = '*';
        $this->data['category_list'] = $this->common->select_data_by_condition('category', $contition_array, $data, $short_by = '', $order_by = '', $limit = '', $offset = '');
        //load category data
        $this->load->view('category/index', $this->data);
    }

    //update the category detail
    public function edit($id = '') {

        if ($this->input->post('category_id')) {

            $category_id = $this->input->post('category_id');
            if ($this->input->post('category_name') == '') {
                $this->session->set_flashdata('error', 'Category name is required');
                redirect('category', 'refresh');
            } else {
                if ($_FILES['category_banner']['name'][0] != '') {
                    $category1['upload_path'] = $this->config->item('category_main_upload_path');
                    $category1['allowed_types'] = $this->config->item('category_allowed_types');
                    $category1['max_size'] = $this->config->item('category_main_max_size');
                    $category1['max_width'] = $this->config->item('category_main_max_width');
                    $category1['max_height'] = $this->config->item('category_main_max_height');

                    $this->load->library('upload');
                    $this->upload->initialize($category1);

                    //Uploading Image

                    $fileUploadResponse = $this->do_upload_multiple_files('category_banner', $category1);

                    foreach ($fileUploadResponse['error'] as $error) {
                        if ($error != '') {
                            $error .= $error . ',';
                        }
                    }
                    $error = trim($error, ',');
                    if ($error == '') {

                        $file_name = '';
                        foreach ($fileUploadResponse['result'] as $upload) {
                            $file_name .= $upload['file_name'] . ',';
                        }

                        $category_image1 = trim($file_name, ',');

                        $category_image1 = explode(',', $category_image1);
                        foreach ($category_image1 as $key => $value) {
                            $insert_image['category_id'] = $this->input->post('category_id');
                            $insert_image['image'] = $value;
                            $insert_image['status'] = 1;

                            $insert_data = $this->common->insert_data_getid($insert_image, 'category_banner');
                        }
                    } else {

                        $this->session->set_flashdata('error', $error);
                        redirect('category', 'refresh');
//                    die();
                    }
                } else {
                    $category1 = $this->input->post('old_category_banner');
                    if ($category1) {
                        $category1 = implode(',', $category1);
                    }
                }
                
                
                $update_array = array(
                    'name' => trim($this->input->post('category_name')),
                    'modify_date' => date('Y-m-d H:i:s')
                );
                $update_result = $this->common->update_data($update_array, 'category', 'id', $this->input->post('category_id'));

                if ($update_result) {
                    $this->session->set_flashdata('success', 'Category successfully updated.');
                    redirect('category', 'refresh');
                } else {
                    $this->session->set_flashdata('error', 'Error Occurred. Try Again!');
                    redirect('category', 'refresh');
                }
            }
        }
        $category_detail = $this->common->select_data_by_id('category', 'id', $id, '*');

        if (!empty($category_detail)) {
            $this->data['module_name'] = 'Category';
            $this->data['section_title'] = 'Edit Category';
            $this->data['category_detail'] = $category_detail;

            $this->data['image_list'] = $this->common->select_data_by_condition('category_banner', $contition_array = array('category_id' => $id, 'status' => '1'), $data = 'id,image', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array());
            $this->load->view('category/edit', $this->data);
        } else {
            $this->session->set_flashdata('error', 'Errorout Occurred. Try Again.');
            redirect('category', 'refresh');
        }
    }

    // get name by id

    function getCatName() {
        if ($this->input->post('category_id')) {
            $category_id = $this->input->post('category_id');
            $contition_array = array('id' => $category_id);
            $data = 'name';
            $category_name = $this->common->select_data_by_condition('category', $contition_array, $data, $short_by = '', $order_by = '', $limit = '', $offset = '');

            $return_data = array();
            $return_data['category_name'] = $category_name[0]['name'];
            header('Content-Type: application/json');
            echo json_encode($return_data);
            exit;
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
                $category_thumb[$i]['image_library'] = 'gd2';
                $category_thumb[$i]['source_image'] = $this->config->item('category_main_upload_path') . $response['result'][$i]['file_name'];
                $category_thumb[$i]['new_image'] = $this->config->item('category_thumb_upload_path') . $response['result'][$i]['file_name'];
                $category_thumb[$i]['create_thumb'] = TRUE;
                $category_thumb[$i]['maintain_ratio'] = TRUE;
                $category_thumb[$i]['thumb_marker'] = '';
                $category_thumb[$i]['width'] = $this->config->item('category_thumb_width');
                //$category_thumb[$i]['height'] = $this->config->item('category_thumb_height');
                $category_thumb[$i]['height'] = 2;
                $category_thumb[$i]['master_dim'] = 'width';
                $category_thumb[$i]['quality'] = "100%";
                $category_thumb[$i]['x_axis'] = '0';
                $category_thumb[$i]['y_axis'] = '0';
                $instanse = "image_$i";

                //Loading Image Library
                $this->load->library('image_lib', $category_thumb[$i], $instanse);
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

    public function delete_image($id = '', $categoryimage_id = '') {
        if ($categoryimage_id != '' && $id != '') {

            $get_image = $this->common->select_data_by_id('category_banner', 'id', $categoryimage_id, $data = 'image', $join_str = array());
            $image_name = $get_image[0]['image'];

            $main_image = $this->config->item('category_main_upload_path') . $image_name;
            $thumb_image = $this->config->item('category_thumb_upload_path') . $image_name;

            if (file_exists($main_image)) {
                unlink($main_image);
            }
            if (file_exists($thumb_image)) {
                unlink($thumb_image);
            }
            $this->common->delete_data('category_banner', 'id', $categoryimage_id);
            redirect('category/edit/' . $id, 'refresh');
        }
    }

}

?>