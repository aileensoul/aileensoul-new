<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Testimonials extends MY_Controller {

    public $data;

    public function __construct() {

        parent::__construct();

        //$GLOBALS['record_per_page']=10;
        //site setting details
        $site_name_values = $this->common->select_data_by_id('settings', 'setting_id', '1', '*');
        $this->data['site_name'] = $site_name = $site_name_values[0]['setting_value'];
        //set header, footer and leftmenu
        $this->data['title'] = 'Testimonials | ' . $site_name;
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

    //display testimonials list
    public function index() {

        $this->data['module_name'] = 'Testimonials';
        $this->data['section_title'] = 'Testimonials';

        $contition_array = array('status !=' => '3');
        $this->data['testimonials_list'] = $this->common->select_data_by_condition('testimonials', $contition_array, '*', $short_by = '', $order_by = '', $limit = '', $offset = '');

        $this->load->view('testimonials/index', $this->data);
    }

    //add new testimonials
    public function add() {
        //check post and save data
        if ($this->input->post('btn_save')) {
            $name = $this->input->post('name');
            $position = $this->input->post('position');
            $description = $this->input->post('description');
            
            $error = '';
            if ($name == '') {
                $error = 1;
                $this->session->set_flashdata('error', 'Please enter name');
                redirect('testimonials/add', 'refresh');
            }
            if ($position == '') {
                $error = 1;
                $this->session->set_flashdata('error', 'Please enter position');
                redirect('testimonials/add', 'refresh');
            }
            if ($description == '') {
                $error = 1;
                $this->session->set_flashdata('error', 'Please enter description');
                redirect('testimonials/add', 'refresh');
            }
            if ($_FILES['image']['name'] == '') {
                $error = 1;
                $this->session->set_flashdata('error', 'Please select atleast one image');
                redirect('testimonials/add', 'refresh');
            }
            if ($error == 1) {
                $this->session->set_flashdata('error', 'Error Occurred. Try Again!');
                $redirect_url = site_url('testimonials/add');
                redirect($redirect_url, 'refresh');
            } else {

                $testimonials_image = '';

                $testimonials['upload_path'] = $this->config->item('testimonial_main_upload_path');
                $testimonials['allowed_types'] = $this->config->item('testimonial_allowed_types');
                $testimonials['max_size'] = $this->config->item('testimonial_main_max_size');
                $testimonials['max_width'] = $this->config->item('testimonial_main_max_width');
                $testimonials['max_height'] = $this->config->item('testimonial_main_max_height');


                $this->load->library('upload');
                $this->upload->initialize($testimonials);
                //Uploading Image
                $this->upload->do_upload('image');
                //Getting Uploaded Image File Data
                $imgdata = $this->upload->data();
                $imgerror = $this->upload->display_errors();
                if ($imgerror == '') {
                    //Configuring Thumbnail 
                    $testimonials_thumb['image_library'] = 'gd2';
                    $testimonials_thumb['source_image'] = $testimonials['upload_path'] . $imgdata['file_name'];
                    $testimonials_thumb['new_image'] = $this->config->item('testimonial_thumb_upload_path') . $imgdata['file_name'];
                    $testimonials_thumb['create_thumb'] = TRUE;
                    $testimonials_thumb['maintain_ratio'] = FALSE;
                    $testimonials_thumb['thumb_marker'] = '';
                    $testimonials_thumb['width'] = $this->config->item('testimonial_thumb_width');
                    $testimonials_thumb['height'] = $this->config->item('testimonial_thumb_height');

                    //Loading Image Library
                    $this->load->library('image_lib', $testimonials_thumb);
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
                    $redirect_url = site_url('testimonials');
                    redirect($redirect_url, 'refresh');
                } else {
                    $testimonials = $imgdata['file_name'];
                }

                $insert_array = array(
                    'name' => $name,
                    'position' => $position,
                    'description' => $description,
                    'image' => $testimonials,
                    'create_date' => date('Y-m-d h:i:s'),
                    'modify_date' => date('Y-m-d h:i:s'),
                    'status' => 1,
                );

                $insert_id = $this->common->insert_data_getid($insert_array, 'testimonials');

                if ($insert_id > 0) {
                    $this->session->set_flashdata('success', 'Testimonials successfully inserted');
                    $redirect_url = site_url('testimonials');
                    redirect($redirect_url, 'refresh');
                } else {
                    $this->session->set_flashdata('error', 'Error Occurred. Try Again!');
                    $redirect_url = site_url('testimonials/add');
                    redirect($redirect_url, 'refresh');
                }
            }
        }


        // define module name and section title
        $this->data['module_name'] = 'Testimonials';
        $this->data['section_title'] = 'Add Testimonials';

        $this->load->view('testimonials/add', $this->data);
    }

    //update the user detail
    public function edit($id = '') {
        if ($this->input->post('testimonial_id')) {

            $testimonial_id = $this->input->post('testimonial_id');
            $name = $this->input->post('name');
            $position = $this->input->post('position');
            $description = $this->input->post('description');
            
            $error = '';
            if ($name == '') {
                $error = 1;
                $this->session->set_flashdata('error', 'Please enter name');
                redirect('testimonials/edit/'.$testimonial_id, 'refresh');
            }
            if ($position == '') {
                $error = 1;
                $this->session->set_flashdata('error', 'Please enter position');
                redirect('testimonials/edit/'.$testimonial_id, 'refresh');
            }
            if ($description == '') {
                $error = 1;
                $this->session->set_flashdata('error', 'Please enter description');
                redirect('testimonials/edit/'.$testimonial_id, 'refresh');
            }
            if ($error == 1) {
                
                $this->session->set_flashdata('error', 'Error Occurred. Try Again!');
                $redirect_url = site_url('testimonials/edit/'.$testimonial_id);
                redirect($redirect_url, 'refresh');
            } else {
                
                if ($_FILES['image']['name'] != '') {

                    $testimonials['upload_path'] = $this->config->item('testimonial_main_upload_path');
                    $testimonials['allowed_types'] = $this->config->item('testimonial_allowed_types');
                    $testimonials['max_size'] = $this->config->item('testimonial_main_max_size');
                    $testimonials['max_width'] = $this->config->item('testimonial_main_max_width');
                    $testimonials['max_height'] = $this->config->item('testimonial_main_max_height');

                    //    $this->load->library('upload', $event);

                    $this->load->library('upload');
                    $this->upload->initialize($testimonials);
                    //Uploading Image
                    $this->upload->do_upload('image');
                    //Getting Uploaded Image File Data
                    $imgdata = $this->upload->data();
                    $imgerror = $this->upload->display_errors();
                    if ($imgerror == '') {
                        //Configuring Thumbnail 
                        $testimonials_thumb['image_library'] = 'gd2';
                        $testimonials_thumb['source_image'] = $testimonials['upload_path'] . $imgdata['file_name'];
                        $testimonials_thumb['new_image'] = $this->config->item('testimonial_thumb_upload_path') . $imgdata['file_name'];
                        $testimonials_thumb['create_thumb'] = TRUE;
                        $testimonials_thumb['maintain_ratio'] = FALSE;
                        $testimonials_thumb['thumb_marker'] = '';
                        $testimonials_thumb['width'] = $this->config->item('testimonial_thumb_width');
                        $testimonials_thumb['height'] = $this->config->item('testimonial_thumb_height');

                        //Loading Image Library
                        $this->load->library('image_lib', $testimonials_thumb);
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
                        $redirect_url = site_url('testimonials');
                        redirect($redirect_url, 'refresh');
                    } else {
                        $testimonials = $imgdata['file_name'];
                    }

                    $old_image = $this->input->post('old_image');
                    $old_image_path = $this->config->item('testimonial_main_upload_path') . $old_image;
                    $old_image_thumb_path = $this->config->item('testimonial_thumb_upload_path') . $old_image;

                    if (file_exists($old_image_path)) {
                        unlink($old_image_path);
                    }
                    if (file_exists($old_image_thumb_path)) {
                        unlink($old_image_thumb_path);
                    }
                } else {
                    $testimonials = $this->input->post('old_image');
                }

                $update_array = array(
                    'name' => $name,
                    'position' => $position,
                    'description' => $description,
                    'modify_date' => date('Y-m-d h:i:s'),
                    'image' => $testimonials
                );

                $update_result = $this->common->update_data($update_array, 'testimonials', 'id', $testimonial_id);

                if ($update_result) {
                    $this->session->set_flashdata('success', 'Testimonials successfully updated');
                    redirect('testimonials', 'refresh');
                } else {
                    $this->session->set_flashdata('error', 'Errorin Occurred. Try Again!');
                    redirect('testimonials/edit/' . $testimonial_id, 'refresh');
                }
            }
        }

        $testimonials_detail = $this->common->select_data_by_id('testimonials', 'id', $id, '*');
        if (!empty($testimonials_detail)) {
            $this->data['module_name'] = 'Testimonials';
            $this->data['section_title'] = 'Edit Testimonials';
            $this->data['testimonials_detail'] = $testimonials_detail;

            $this->load->view('testimonials/edit', $this->data);
        } else {
            $this->session->set_flashdata('error', 'Errorout Occurred. Try Again.');
            redirect('testimonials', 'refresh');
        }
    }

    // testimonials status change
    public function change_status($testimonial_id = '', $status = '') {
        if ($testimonial_id == '' || $status == '') {
            $this->session->set_flashdata('error', 'Error Occurred. Try Agaim!');
            redirect('testimonials', 'refresh');
        }
        if ($status == 1) {
            $status = 2;
        } else {
            $status = 1;
        }
        $update_data = array('status' => $status);

        $update_result = $this->common->update_data($update_data, 'testimonials', 'id', $testimonial_id);
        if ($update_result) {
            $this->session->set_flashdata('success', 'Testimonials status successfully changed');
            redirect('testimonials', 'refresh');
        } else {
            $this->session->set_flashdata('error', 'Error Occurred. Try Again!');
            redirect('testimonials', 'refresh');
        }
    }

    // testimonials delete
    public function delete($id = '') {
        $update_array = array('status' => 3);
        $delete_result = $this->common->update_data($update_array, 'testimonials', 'id', $id);

        if ($delete_result) {
            $this->session->set_flashdata('success', 'Testimonials successfully deleted');
            redirect('testimonials', 'refresh');
        } else {
            $this->session->set_flashdata('error', 'Error Occurred. Try Again!');
            redirect('testimonials', 'refresh');
        }
    }

    public function delete_image($id = '', $testimonialsimage_id = '') {
        if ($testimonialsimage_id != '' && $id != '') {

            $get_image = $this->common->select_data_by_id('testimonials_image', 'id', $testimonialsimage_id, $data = 'image', $join_str = array());
            $image_name = $get_image[0]['image'];

            $main_image = $this->config->item('testimonials_main_upload_path') . $image_name;
            $thumb_image = $this->config->item('testimonials_thumb_upload_path') . $image_name;

            if (file_exists($main_image)) {
                unlink($main_image);
            }
            if (file_exists($thumb_image)) {
                unlink($thumb_image);
            }
            $this->common->delete_data('testimonials_image', 'id', $testimonialsimage_id);
            redirect('testimonials/edit/' . $id, 'refresh');
        }
    }

}

?>