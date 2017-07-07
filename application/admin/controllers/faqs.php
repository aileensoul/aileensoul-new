<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Faqs extends MY_Controller {

    public $data;

    public function __construct() {

        parent::__construct();

        //$GLOBALS['record_per_page']=10;
        //site setting details
        $site_name_values = $this->common->select_data_by_id('settings', 'setting_id', '1', '*');
        $this->data['site_name'] = $site_name = $site_name_values[0]['setting_value'];
        //set header, footer and leftmenu
        $this->data['title'] = 'Faqs | ' . $site_name;
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

    //display faqs list
    public function index() {

        $this->data['module_name'] = 'Faqs';
        $this->data['section_title'] = 'Faqs';

        $contition_array = array('status !=' => '3');
        $this->data['faqs_list'] = $this->common->select_data_by_condition('faqs', $contition_array, '*', $short_by = '', $order_by = '', $limit = '', $offset = '');

        $this->load->view('faqs/index', $this->data);
    }

    //add new faqs
    public function add() {
        //check post and save data
        if ($this->input->post('btn_save')) {
            $question = $this->input->post('question');
            $answer = $this->input->post('answer');
            
            $error = '';
            if ($question == '') {
                $error = 1;
                $this->session->set_flashdata('error', 'Please enter question');
                redirect('faqs/add', 'refresh');
            }
            if ($answer == '') {
                $error = 1;
                $this->session->set_flashdata('error', 'Please enter answer');
                redirect('faqs/add', 'refresh');
            }
            if ($error == 1) {
                $this->session->set_flashdata('error', 'Error Occurred. Try Again!');
                $redirect_url = site_url('faqs/add');
                redirect($redirect_url, 'refresh');
            } else {
                $insert_array = array(
                    'question' => $question,
                    'answer' => $answer,
                    'create_date' => date('Y-m-d h:i:s'),
                    'modify_date' => date('Y-m-d h:i:s'),
                    'status' => 1,
                );

                $insert_id = $this->common->insert_data_getid($insert_array, 'faqs');

                if ($insert_id > 0) {
                    $this->session->set_flashdata('success', 'Faqs successfully inserted');
                    $redirect_url = site_url('faqs');
                    redirect($redirect_url, 'refresh');
                } else {
                    $this->session->set_flashdata('error', 'Error Occurred. Try Again!');
                    $redirect_url = site_url('faqs/add');
                    redirect($redirect_url, 'refresh');
                }
            }
        }
        // define module name and section title
        $this->data['module_name'] = 'Faqs';
        $this->data['section_title'] = 'Add Faqs';

        $this->load->view('faqs/add', $this->data);
    }

    //update the user detail
    public function edit($id = '') {
        if ($this->input->post('faqs_id')) {

            $faqs_id = $this->input->post('faqs_id');
            $question = $this->input->post('question');
            $answer = $this->input->post('answer');
            
            $error = '';
            if ($question == '') {
                $error = 1;
                $this->session->set_flashdata('error', 'Please enter question');
                redirect('faqs/edit/' . $faqs_id, 'refresh');
            }
            if ($answer == '') {
                $error = 1;
                $this->session->set_flashdata('error', 'Please enter answer');
                redirect('faqs/edit/' . $faqs_id, 'refresh');
            }
            if ($error == 1) {

                $this->session->set_flashdata('error', 'Error Occurred. Try Again!');
                $redirect_url = site_url('faqs/edit/' . $faqs_id);
                redirect($redirect_url, 'refresh');
            } else {

                $update_array = array(
                    'question' => $question,
                    'answer' => $answer,
                    'modify_date' => date('Y-m-d h:i:s')
                );
                
                $update_result = $this->common->update_data($update_array, 'faqs', 'id', $faqs_id);

                if ($update_result) {
                    $this->session->set_flashdata('success', 'Faqs successfully updated');
                    redirect('faqs', 'refresh');
                } else {
                    $this->session->set_flashdata('error', 'Errorin Occurred. Try Again!');
                    redirect('faqs/edit/' . $faqs_id, 'refresh');
                }
            }
        }

        $faqs_detail = $this->common->select_data_by_id('faqs', 'id', $id, '*');
        if (!empty($faqs_detail)) {
            $this->data['module_name'] = 'Faqs';
            $this->data['section_title'] = 'Edit Faqs';
            $this->data['faqs_detail'] = $faqs_detail;

            $this->load->view('faqs/edit', $this->data);
        } else {
            $this->session->set_flashdata('error', 'Errorout Occurred. Try Again.');
            redirect('faqs', 'refresh');
        }
    }

    // faqs status change
    public function change_status($faqs_id = '', $status = '') {
        if ($faqs_id == '' || $status == '') {
            $this->session->set_flashdata('error', 'Error Occurred. Try Agaim!');
            redirect('faqs', 'refresh');
        }
        if ($status == 1) {
            $status = 2;
        } else {
            $status = 1;
        }
        $update_data = array('status' => $status);

        $update_result = $this->common->update_data($update_data, 'faqs', 'id', $faqs_id);
        if ($update_result) {
            $this->session->set_flashdata('success', 'Faqs status successfully changed');
            redirect('faqs', 'refresh');
        } else {
            $this->session->set_flashdata('error', 'Error Occurred. Try Again!');
            redirect('faqs', 'refresh');
        }
    }

    // faqs delete
    public function delete($id = '') {
        $update_array = array('status' => 3);
        $delete_result = $this->common->update_data($update_array, 'faqs', 'id', $id);

        if ($delete_result) {
            $this->session->set_flashdata('success', 'Faqs successfully deleted');
            redirect('faqs', 'refresh');
        } else {
            $this->session->set_flashdata('error', 'Error Occurred. Try Again!');
            redirect('faqs', 'refresh');
        }
    }

    public function delete_image($id = '', $faqsimage_id = '') {
        if ($faqsimage_id != '' && $id != '') {

            $get_image = $this->common->select_data_by_id('faqs_image', 'id', $faqsimage_id, $data = 'image', $join_str = array());
            $image_name = $get_image[0]['image'];

            $main_image = $this->config->item('faqs_main_upload_path') . $image_name;
            $thumb_image = $this->config->item('faqs_thumb_upload_path') . $image_name;

            if (file_exists($main_image)) {
                unlink($main_image);
            }
            if (file_exists($thumb_image)) {
                unlink($thumb_image);
            }
            $this->common->delete_data('faqs_image', 'id', $faqsimage_id);
            redirect('faqs/edit/' . $id, 'refresh');
        }
    }

}

?>