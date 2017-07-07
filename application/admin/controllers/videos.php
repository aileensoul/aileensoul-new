<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Videos extends MY_Controller {

    public $data;

    public function __construct() {

        parent::__construct();

        //site setting details
        $site_name_values = $this->common->select_data_by_id('settings', 'setting_id', '1', '*');
        $this->data['site_name'] = $site_name = $site_name_values[0]['setting_value'];
        //set header, footer and leftmenu
        $this->data['title'] = 'Videos : ' . $site_name;
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

        $this->data['module_name'] = 'Videos Management';
        $this->data['section_title'] = 'Videos Management';

        $contition_array = array('status != ' => '3');
        $data = '*';
        $this->data['video_list'] = $this->common->select_data_by_condition('videos', $contition_array, $data, $short_by = '', $order_by = '', $limit = '', $offset = '');
        //load category data
        $this->load->view('videos/index', $this->data);
    }

    //add videos detail
    public function add() {

        if ($this->input->post('submit') == 'send') {

            $title = $this->input->post('title');
            $error = '';
            if ($this->input->post('title') == '') {
                $error = 1;
                $this->session->set_flashdata('error', 'Video title is required');
                redirect('videos', 'refresh');
            }
            if ($this->input->post('link') == '') {
                $error = 1;
                $this->session->set_flashdata('error', 'Video code is required');
                redirect('videos', 'refresh');
            }
            if ($error == 1) {
                $this->session->set_flashdata('error', 'Something error!');
                redirect('videos', 'refresh');
            }  else {
                $insert_array = array(
                    'title' => trim($this->input->post('title')),
                    'link' => trim($this->input->post('link')),
                    'create_date' => date('Y-m-d H:i:s'),
                    'modify_date' => date('Y-m-d H:i:s'),
                    'status' => 1
                );
                $insert_id = $this->common->insert_data_getid($insert_array, 'videos');

                if ($insert_id) {
                    $this->session->set_flashdata('success', 'video successfully inserted.');
                    redirect('videos', 'refresh');
                } else {
                    $this->session->set_flashdata('error', 'Error Occurred. Try Again!');
                    redirect('videos', 'refresh');
                }
            }
        }
    }

    //update the videos detail
    public function edit() {

        if ($this->input->post('id')) {

            $videos_id = $this->input->post('id');
            $error = '';
            if ($this->input->post('title') == '') {
                $error = 1;
                $this->session->set_flashdata('error', 'Video title is required');
                redirect('videos', 'refresh');
            }
            if ($this->input->post('link') == '') {
                $error = 1;
                $this->session->set_flashdata('error', 'Video code is required');
                redirect('videos', 'refresh');
            }
            if ($error == 1) {
                $this->session->set_flashdata('error', 'Something error!');
                redirect('videos', 'refresh');
            } else {
                $update_array = array(
                    'title' => trim($this->input->post('title')),
                    'link' => trim($this->input->post('link')),
                    'modify_date' => date('Y-m-d H:i:s')
                );
                
                $update_result = $this->common->update_data($update_array, 'videos', 'id', $this->input->post('id'));

                if ($update_result) {
                    $this->session->set_flashdata('success', 'video successfully updated.');
                    redirect('videos', 'refresh');
                } else {
                    $this->session->set_flashdata('error', 'Error Occurred. Try Again!');
                    redirect('videos', 'refresh');
                }
            }
        }
    }

    // get name by id

    function getVideoData() {
        if ($this->input->post('id')) {
            $videos_id = $this->input->post('id');
            $contition_array = array('id' => $videos_id);
            $data = 'title,link';
            $video_data = $this->common->select_data_by_condition('videos', $contition_array, $data, $short_by = '', $order_by = '', $limit = '', $offset = '');

            $return_data = array();
            $return_data['title'] = $video_data[0]['title'];
            $return_data['link'] = $video_data[0]['link'];
            header('Content-Type: application/json');
            echo json_encode($return_data);
            exit;
        }
    }

    function change_status($id, $status) {
        if ($status == 1) {
            $update_status = 2;
        } else {
            $update_status = 1;
        }
        $update_array = array(
            'status' => $update_status,
            'modify_date' => date('Y-m-d H:i:s')
        );
        $update_result = $this->common->update_data($update_array, 'videos', 'id', $id);

        if ($update_result) {
            $this->session->set_flashdata('success', 'Video status updated');
            redirect('videos', 'refresh');
        } else {
            $this->session->set_flashdata('error', 'Error Occurred. Try Again!');
            redirect('videos', 'refresh');
        }
    }

    function delete($id) {

        $update_array = array(
            'status' => 3
        );
        $update_result = $this->common->update_data($update_array, 'videos', 'id', $id);

        if ($update_result) {
            $this->session->set_flashdata('success', 'Video sucessfully deleted');
            redirect('videos', 'refresh');
        } else {
            $this->session->set_flashdata('error', 'Error Occurred. Try Again!');
            redirect('videos', 'refresh');
        }
    }

}

?>