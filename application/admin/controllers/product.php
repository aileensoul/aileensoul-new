<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Product extends MY_Controller {

    public $data;

    public function __construct() {

        parent::__construct();

        //$GLOBALS['record_per_page']=10;
        //site setting details
        $site_name_values = $this->common->select_data_by_id('settings', 'setting_id', '1', '*');
        $this->data['site_name'] = $site_name = $site_name_values[0]['setting_value'];
        //set header, footer and leftmenu
        $this->data['title'] = 'Product | ' . $site_name;
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

    //display product list
    public function index() {

        $this->data['module_name'] = 'Product';
        $this->data['section_title'] = 'Product';

        $contition_array = array('status !=' => '3');
        $this->data['product_list'] = $this->common->select_data_by_condition('products', $contition_array, '*', $short_by = '', $order_by = '', $limit = '', $offset = '');

        $this->load->view('product/index', $this->data);
    }

    //add new product
    public function add() {
        //check post and save data
        if ($this->input->post('btn_save')) {
            $name = $this->input->post('name');
            $category_id = $this->input->post('category_id');
            $manufacture_id = $this->input->post('manufacture_id');
            $cost_price = $this->input->post('cost_price');
            $sell_price = $this->input->post('sell_price');
            $stock = $this->input->post('stock');
            $available_for = $this->input->post('available_for');
            $delivery_day = $this->input->post('delivery_day');
            $condition = $this->input->post('condition');
            $bid_time = $this->input->post('bid_time');
            $short_description = $this->input->post('short_description');
            $description = $this->input->post('description');
            $available_date = $this->input->post('available_date');

            $error = '';
            if ($name == '') {
                $error = 1;
                $this->session->set_flashdata('error', 'Please enter product name');
                redirect('product/add', 'refresh');
            }
            if ($category_id == '') {
                $error = 1;
                $this->session->set_flashdata('error', 'Please enter category');
                redirect('product/add', 'refresh');
            }
            if ($manufacture_id == '') {
                $error = 1;
                $this->session->set_flashdata('error', 'Please enter manufacturers');
                redirect('product/add', 'refresh');
            }
            if ($cost_price == '') {
                $error = 1;
                $this->session->set_flashdata('error', 'Please enter product price');
                redirect('product/add', 'refresh');
            }
            if ($sell_price == '') {
                $error = 1;
                $this->session->set_flashdata('error', 'Please enter product selling price');
                redirect('product/add', 'refresh');
            }
            if (!is_numeric($sell_price)) {
                $error = 1;
                $this->session->set_flashdata('error', 'Product selling price should be numeric');
                redirect('product/add', 'refresh');
            }
            if (!is_numeric($cost_price)) {
                $error = 1;
                $this->session->set_flashdata('error', 'Product cost price should be numeric');
                redirect('product/add', 'refresh');
            }
            if ($sell_price > $cost_price) {
                $error = 1;
                $this->session->set_flashdata('error', 'Product price should be larger than selling price');
                redirect('product/add', 'refresh');
            }
            if ($available_for == '') {
                $error = 1;
                $this->session->set_flashdata('error', 'Please enter product available for');
                redirect('product/add', 'refresh');
            }
            if ($available_for == 'bid') {
                /* if ($bid_time == '') {
                  $error = 1;
                  $this->session->set_flashdata('error', 'Please enter product bidding time');
                  redirect('product/add', 'refresh');
                  } */
            }
            if ($available_for == 'buy') {
                if ($stock == '') {
                    $error = 1;
                    $this->session->set_flashdata('error', 'Please enter product stock');
                    redirect('product/add', 'refresh');
                }
                if ($stock < 1) {
                    $error = 1;
                    $this->session->set_flashdata('error', 'Please enter valid product stock');
                    redirect('product/add', 'refresh');
                }
            }
            if ($available_date == '') {
                $error = 1;
                $this->session->set_flashdata('error', 'Please enter product available date');
                redirect('product/add', 'refresh');
            }
            if ($short_description == '') {
                $error = 1;
                $this->session->set_flashdata('error', 'Please enter product short description');
                redirect('product/add', 'refresh');
            }
            if ($description == '') {
                $error = 1;
                $this->session->set_flashdata('error', 'Please enter product description');
                redirect('product/add', 'refresh');
            }
            if ($_FILES['image']['name'][0] == '') {
                $error = 1;
                $this->session->set_flashdata('error', 'Please select image');
                redirect('product/add', 'refresh');
            }
            if ($error == 1) {
                $this->session->set_flashdata('error', 'Error Occurred. Try Again!');
                $redirect_url = site_url('product/add');
                redirect($redirect_url, 'refresh');
            } else {

                $product_image = '';

                $product['upload_path'] = $this->config->item('product_main_upload_path');
                $product['allowed_types'] = $this->config->item('product_allowed_types');
                $product['max_size'] = $this->config->item('product_main_max_size');
                $product['max_width'] = $this->config->item('product_main_max_width');
                $product['max_height'] = $this->config->item('product_main_max_height');


                $this->load->library('upload');
                $this->upload->initialize($product);
                //Uploading Image
                $this->upload->do_upload('image');
                //Getting Uploaded Image File Data
                $imgdata = $this->upload->data();
                $imgerror = $this->upload->display_errors();
                if ($imgerror == '') {
                    //Configuring Thumbnail 
                    $product_thumb['image_library'] = 'gd2';
                    $product_thumb['source_image'] = $product['upload_path'] . $imgdata['file_name'];
                    $product_thumb['new_image'] = $this->config->item('product_thumb_upload_path') . $imgdata['file_name'];
                    $product_thumb['create_thumb'] = TRUE;
                    $product_thumb['maintain_ratio'] = TRUE;
                    $product_thumb['thumb_marker'] = '';
                    $product_thumb['width'] = $this->config->item('product_thumb_width');
                    //$product_thumb['height'] = $this->config->item('product_thumb_height');
                    $product_thumb['height'] = 2;
                    $product_thumb['master_dim'] = 'width';
                    $product_thumb['quality'] = "100%";
                    $product_thumb['x_axis'] = '0';
                    $product_thumb['y_axis'] = '0';
                    //Loading Image Library
                    $this->load->library('image_lib', $product_thumb);
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
                    $redirect_url = site_url('product');
                    redirect($redirect_url, 'refresh');
                } else {
                    $product = $imgdata['file_name'];
                }



                if ($_FILES['sub_image']['name'][0] != '') {
                    $product1['upload_path'] = $this->config->item('product_main_upload_path');
                    $product1['allowed_types'] = $this->config->item('product_allowed_types');
                    $product1['max_size'] = $this->config->item('product_main_max_size');
                    $product1['max_width'] = $this->config->item('product_main_max_width');
                    $product1['max_height'] = $this->config->item('product_main_max_height');

                    $this->load->library('upload');
                    $this->upload->initialize($product1);

                    //Uploading Image

                    $fileUploadResponse = $this->do_upload_multiple_files('sub_image', $product1);

                    $file_name = '';
                    foreach ($fileUploadResponse['result'] as $upload) {
                        $file_name .= $upload['file_name'] . ',';
                    }

                    $product_sub_image = trim($file_name, ',');
                } else {
                    $product_sub_image = '';
                }

                if ($available_for == 'bid') {
                    $bid_status = 'active';

                    //    $bid_time = explode(':', $bid_time);
                    $hour = 24 * 3600;
                    //    $minute = $bid_time[1] * 60;
                    //    $bid_time = $hour + $minute;
                    $bid_time = $hour;

                    $duration = $bid_time;
                    $bid_end_time = date("Y-m-d H:i:s", (strtotime($available_date) + $duration));
                    $stock = 1;
                } else {
                    $bid_status = '';
                    $bid_end_time = '';
                }

                $insert_array = array(
                    'name' => $name,
                    'category_id' => $category_id,
                    'manufacture_id' => $manufacture_id,
                    'cost_price' => $cost_price,
                    'sell_price' => $sell_price,
                    'stock' => $stock,
                    'available_for' => $available_for,
                    'bid_time' => $bid_time,
                    'bid_end_time' => $bid_end_time,
                    'delivery_day' => $delivery_day,
                    'condition' => $condition,
                    'bid_status' => $bid_status,
                    'short_description' => trim($short_description),
                    'description' => trim($description),
                    'available_date' => $available_date,
                    'create_date' => date('Y-m-d H:i:s'),
                    'modify_date' => date('Y-m-d H:i:s'),
                    'status' => 1,
                    'image' => $product
                );
                
                

                $insert_id = $this->common->insert_data_getid($insert_array, 'products');

                if ($insert_id > 0) {
                    
                    $product_uniq_id = sprintf('%04d',$insert_id);
                    $update_array = array(
                        'product_code' => 'BD'.$product_uniq_id
                       );

                    $update_result = $this->common->update_data($update_array, 'products', 'id', $insert_id);

                    if ($product_sub_image) {
                        $product_sub_image = explode(',', $product_sub_image);
                        foreach ($product_sub_image as $key => $value) {
                            $insert_image['product_id'] = $insert_id;
                            $insert_image['image'] = $value;
                            $insert_image['status'] = 1;

                            $insert_data = $this->common->insert_data_getid($insert_image, 'product_image');
                        }
                    }
                    $this->session->set_flashdata('success', 'Product successfully inserted');
                    $redirect_url = site_url('product');
                    redirect($redirect_url, 'refresh');
                } else {
                    $this->session->set_flashdata('error', 'Error Occurred. Try Again!');
                    $redirect_url = site_url('product/add');
                    redirect($redirect_url, 'refresh');
                }
            }
        }


        // define module name and section title
        $this->data['module_name'] = 'Product';
        $this->data['section_title'] = 'Add Product';

        $contition_array = array('status' => '1');
        $this->data['category_list'] = $this->common->select_data_by_condition('category', $contition_array, 'id,name', $short_by = '', $order_by = '', $limit = '', $offset = '');

        $contition_array = array('status' => '1');
        $this->data['manufacturer_list'] = $this->common->select_data_by_condition('manufacturers', $contition_array, 'id,name', $short_by = '', $order_by = '', $limit = '', $offset = '');

        $this->load->view('product/add', $this->data);
    }

    //update the user detail
    public function edit($id = '') {

        if ($this->input->post('product_id')) {

            $product_id = $this->input->post('product_id');
            $name = $this->input->post('name');
            $category_id = $this->input->post('category_id');
            $manufacture_id = $this->input->post('manufacture_id');
            $cost_price = $this->input->post('cost_price');
            $sell_price = $this->input->post('sell_price');
            $stock = $this->input->post('stock');
            $available_for = $this->input->post('available_for');
            $bid_time = $this->input->post('bid_time');
            $delivery_day = $this->input->post('delivery_day');
            $condition = $this->input->post('condition');
            $short_description = $this->input->post('short_description');
            $description = $this->input->post('description');
            $available_date = $this->input->post('available_date');

            $error = '';
            if ($name == '') {
                $error = 1;
                $this->session->set_flashdata('error', 'Please enter product name');
                redirect('product/edit/' . $product_id, 'refresh');
            }
            if ($category_id == '') {
                $error = 1;
                $this->session->set_flashdata('error', 'Please enter category');
                redirect('product/edit/' . $product_id, 'refresh');
            }
            if ($manufacture_id == '') {
                $error = 1;
                $this->session->set_flashdata('error', 'Please enter manufacturers');
                redirect('product/edit/' . $product_id, 'refresh');
            }
            if ($cost_price == '') {
                $error = 1;
                $this->session->set_flashdata('error', 'Please enter product price');
                redirect('product/edit/' . $product_id, 'refresh');
            }
            if ($sell_price == '') {
                $error = 1;
                $this->session->set_flashdata('error', 'Please enter product selling price');
                redirect('product/edit/' . $product_id, 'refresh');
            }
            if (!is_numeric($sell_price)) {
                $error = 1;
                $this->session->set_flashdata('error', 'Product selling price should be numeric');
                redirect('product/edit/' . $product_id, 'refresh');
            }
            if (!is_numeric($cost_price)) {
                $error = 1;
                $this->session->set_flashdata('error', 'Product cost price should be numeric');
                redirect('product/edit/' . $product_id, 'refresh');
            }
            if ($sell_price > $cost_price) {
                $error = 1;
                $this->session->set_flashdata('error', 'Product price should be larger than selling price');
                redirect('product/edit/' . $product_id, 'refresh');
            }
            if ($available_for == '') {
                $error = 1;
                $this->session->set_flashdata('error', 'Please enter product available for');
                redirect('product/edit/' . $product_id, 'refresh');
            }
            if ($available_for == 'bid') {
                /*   if ($bid_time == '') {
                  $error = 1;
                  $this->session->set_flashdata('error', 'Please enter product bidding time');
                  redirect('product/edit/' . $product_id, 'refresh');
                  } */
            }
            if ($available_for == 'buy') {
                if ($stock == '') {
                    $error = 1;
                    $this->session->set_flashdata('error', 'Please enter product stock');
                    redirect('product/edit/' . $product_id, 'refresh');
                }
                if ($stock < 1) {
                    $error = 1;
                    $this->session->set_flashdata('error', 'Please enter valid product stock');
                    redirect('product/edit/' . $product_id, 'refresh');
                }
            }
            if ($available_date == '') {
                $error = 1;
                $this->session->set_flashdata('error', 'Please enter product available date');
                redirect('product/add', 'refresh');
            }
            if ($short_description == '') {
                $error = 1;
                $this->session->set_flashdata('error', 'Please enter product short description');
                redirect('product/edit/' . $product_id, 'refresh');
            }
            if ($description == '') {
                $error = 1;
                $this->session->set_flashdata('error', 'Please enter product description');
                redirect('product/edit/' . $product_id, 'refresh');
            }
            if ($error == 1) {
                $this->session->set_flashdata('error', 'Error Occurred. Try Again!');
                $redirect_url = site_url('product/edit/' . $product_id);
                redirect($redirect_url, 'refresh');
            } else {

                if ($_FILES['image']['name'] != '') {

                    $product['upload_path'] = $this->config->item('product_main_upload_path');
                    $product['allowed_types'] = $this->config->item('product_allowed_types');
                    $product['max_size'] = $this->config->item('product_main_max_size');
                    $product['max_width'] = $this->config->item('product_main_max_width');
                    $product['max_height'] = $this->config->item('product_main_max_height');

                    //    $this->load->library('upload', $event);

                    $this->load->library('upload');
                    $this->upload->initialize($product);
                    //Uploading Image
                    $this->upload->do_upload('image');
                    //Getting Uploaded Image File Data
                    $imgdata = $this->upload->data();
                    $imgerror = $this->upload->display_errors();
                    if ($imgerror == '') {
                        //Configuring Thumbnail 
                        $product_thumb['image_library'] = 'gd2';
                        $product_thumb['source_image'] = $product['upload_path'] . $imgdata['file_name'];
                        $product_thumb['new_image'] = $this->config->item('product_thumb_upload_path') . $imgdata['file_name'];
                        $product_thumb['create_thumb'] = TRUE;
                        $product_thumb['maintain_ratio'] = TRUE;
                        $product_thumb['thumb_marker'] = '';
                        $product_thumb['width'] = $this->config->item('product_thumb_width');
                        //$product_thumb['height'] = $this->config->item('product_thumb_height');
                        $product_thumb['height'] = 2;
                        $product_thumb['master_dim'] = 'width';
                        $product_thumb['quality'] = "100%";
                        $product_thumb['x_axis'] = '0';
                        $product_thumb['y_axis'] = '0';

                        //Loading Image Library
                        $this->load->library('image_lib', $product_thumb);
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
                        $redirect_url = site_url('product');
                        redirect($redirect_url, 'refresh');
                    } else {
                        $product = $imgdata['file_name'];
                    }

                    $old_image = $this->input->post('old_image');
                    $old_image_path = $this->config->item('product_main_upload_path') . $old_image;
                    $old_image_thumb_path = $this->config->item('product_thumb_upload_path') . $old_image;

                    if (file_exists($old_image_path)) {
                        unlink($old_image_path);
                    }
                    if (file_exists($old_image_thumb_path)) {
                        unlink($old_image_thumb_path);
                    }
                } else {
                    $product = $this->input->post('old_image');
                }

                if ($_FILES['sub_image']['name'][0] != '') {

                    $product1['upload_path'] = $this->config->item('product_main_upload_path');
                    $product1['allowed_types'] = $this->config->item('product_allowed_types');
                    $product1['max_size'] = $this->config->item('product_main_max_size');
                    $product1['max_width'] = $this->config->item('product_main_max_width');
                    $product1['max_height'] = $this->config->item('product_main_max_height');

                    $this->load->library('upload');
                    $this->upload->initialize($product1);

                    //Uploading Image

                    $fileUploadResponse = $this->do_upload_multiple_files('sub_image', $product1);

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

                        $product_image1 = trim($file_name, ',');

                        $product_image1 = explode(',', $product_image1);
                        foreach ($product_image1 as $key => $value) {
                            $insert_image['product_id'] = $this->input->post('product_id');
                            $insert_image['image'] = $value;
                            $insert_image['status'] = 1;

                            $insert_data = $this->common->insert_data_getid($insert_image, 'product_image');
                        }
                    } else {

                        $this->session->set_flashdata('error', $error);
                        redirect('product', 'refresh');
//                    die();
                    }
                } else {
                    $product1 = $this->input->post('old_sub_image');
                    if ($product1) {
                        $product1 = implode(',', $product1);
                    }
                }


                if ($available_for == 'buy') {
                    $bid_time = '';
                }

                if ($available_for == 'bid') {
                    $bid_status = 'active';

                    //    $bid_time = explode(':', $bid_time);
                    $hour = 24 * 3600;
                    //    $minute = $bid_time[1] * 60;
                    //    $bid_time = $hour + $minute;
                    $bid_time = $hour;

                    $duration = $bid_time;
                    $bid_end_time = date("Y-m-d H:i:s", (strtotime($available_date) + $duration));
                    $stock = 1;
                } else {
                    $bid_end_time = '';
                }
                $product_uniq_id = sprintf('%04d',$product_id);
                $update_array = array(
                    'name' => $name,
                    'product_code' => 'BD'.$product_uniq_id,
                    'category_id' => $category_id,
                    'manufacture_id' => $manufacture_id,
                    'cost_price' => $cost_price,
                    'sell_price' => $sell_price,
                    'stock' => $stock,
                    'available_for' => $available_for,
                    'bid_time' => $bid_time,
                    'bid_end_time' => $bid_end_time,
                    'delivery_day' => $delivery_day,
                    'condition' => $condition,
                    'short_description' => trim($short_description),
                    'description' => trim($description),
                    'available_date' => $available_date,
                    'modify_date' => date('Y-m-d H:i:s'),
                    'image' => $product
                );

                $update_result = $this->common->update_data($update_array, 'products', 'id', $product_id);

                if ($update_result) {
                    $this->session->set_flashdata('success', 'Product successfully updated');
                    redirect('product', 'refresh');
                } else {
                    $this->session->set_flashdata('error', 'Errorin Occurred. Try Again!');
                    redirect('product/edit/' . $product_id, 'refresh');
                }
            }
        }

        $product_detail = $this->common->select_data_by_id('products', 'id', $id, '*');
        /*   $bid_time = $product_detail[0]['bid_time'];
          $hours = $bid_time / 3600;
          $minute = ($bid_time % 3600) / 60;
          $product_detail[0]['bid_time'] = (int) $hours . ':' . $minute;
         */
        if (!empty($product_detail)) {
            $this->data['module_name'] = 'Product';
            $this->data['section_title'] = 'Edit Product';
            $this->data['product_detail'] = $product_detail;

            $contition_array = array('status' => '1');
            $this->data['category_list'] = $this->common->select_data_by_condition('category', $contition_array, 'id,name', $short_by = '', $order_by = '', $limit = '', $offset = '');

            $contition_array = array('status' => '1');
            $this->data['manufacturer_list'] = $this->common->select_data_by_condition('manufacturers', $contition_array, 'id,name', $short_by = '', $order_by = '', $limit = '', $offset = '');

            $this->data['image_list'] = $this->common->select_data_by_condition('product_image', $contition_array = array('product_id' => $id, 'status' => '1'), $data = 'id,image', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array());
            $this->load->view('product/edit', $this->data);
        } else {
            $this->session->set_flashdata('error', 'Errorout Occurred. Try Again.');
            redirect('product', 'refresh');
        }
    }

    // product status change
    public function change_status($product_id = '', $status = '') {
        if ($product_id == '' || $status == '') {
            $this->session->set_flashdata('error', 'Error Occurred. Try Agaim!');
            redirect('product', 'refresh');
        }
        if ($status == 1) {
            $status = 2;
        } else {
            $status = 1;
        }
        $update_data = array('status' => $status);

        $update_result = $this->common->update_data($update_data, 'products', 'id', $product_id);
        if ($update_result) {
            $this->session->set_flashdata('success', 'Product status successfully changed');
            redirect('product', 'refresh');
        } else {
            $this->session->set_flashdata('error', 'Error Occurred. Try Again!');
            redirect('product', 'refresh');
        }
    }

    // product delete
    public function delete($id = '') {
        $update_array = array('status' => 3);
        $delete_result = $this->common->update_data($update_array, 'products', 'id', $id);

        if ($delete_result) {
            $this->session->set_flashdata('success', 'Product successfully deleted');
            redirect('product', 'refresh');
        } else {
            $this->session->set_flashdata('error', 'Error Occurred. Try Again!');
            redirect('product', 'refresh');
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
                $product_thumb[$i]['image_library'] = 'gd2';
                $product_thumb[$i]['source_image'] = $this->config->item('product_main_upload_path') . $response['result'][$i]['file_name'];
                $product_thumb[$i]['new_image'] = $this->config->item('product_thumb_upload_path') . $response['result'][$i]['file_name'];
                $product_thumb[$i]['create_thumb'] = TRUE;
                $product_thumb[$i]['maintain_ratio'] = TRUE;
                $product_thumb[$i]['thumb_marker'] = '';
                $product_thumb[$i]['width'] = $this->config->item('product_thumb_width');
                //$product_thumb[$i]['height'] = $this->config->item('product_thumb_height');
                $product_thumb[$i]['height'] = 2;
                $product_thumb[$i]['master_dim'] = 'width';
                $product_thumb[$i]['quality'] = "100%";
                $product_thumb[$i]['x_axis'] = '0';
                $product_thumb[$i]['y_axis'] = '0';
                $instanse = "image_$i";

                //Loading Image Library
                $this->load->library('image_lib', $product_thumb[$i], $instanse);
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

    public function delete_image($id = '', $productimage_id = '') {
        if ($productimage_id != '' && $id != '') {

            $get_image = $this->common->select_data_by_id('product_image', 'id', $productimage_id, $data = 'image', $join_str = array());
            $image_name = $get_image[0]['image'];

            $main_image = $this->config->item('product_main_upload_path') . $image_name;
            $thumb_image = $this->config->item('product_thumb_upload_path') . $image_name;

            if (file_exists($main_image)) {
                unlink($main_image);
            }
            if (file_exists($thumb_image)) {
                unlink($thumb_image);
            }
            $this->common->delete_data('product_image', 'id', $productimage_id);
            redirect('product/edit/' . $id, 'refresh');
        }
    }

    function product_bid($id) {

        $this->data['module_name'] = 'Product Bid';
        $this->data['section_title'] = 'Product Bid';

        $join_str = array(
            array(
                'table' => 'users',
                'join_table_id' => 'users.id',
                'from_table_id' => 'user_bids.user_id',
                'join_type' => 'left'
            )
        );

        $condition_array = array('user_bids.product_id' => $id);
        $this->data['product_bid_detail'] = $this->common->select_data_by_condition('user_bids', $condition_array, $data = 'user_bids.bid_coins, user_bids.bid_datetime, user_bids.bid_status, users.full_name', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str, $group_by = '');

        $this->load->view('product/product_bid', $this->data);
    }

}

?>