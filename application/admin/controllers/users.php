<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Users extends MY_Controller {

    public $data;

    public function __construct() {

        parent::__construct();

        //$GLOBALS['record_per_page']=10;
        //site setting details
        $site_name_values = $this->common->select_data_by_id('settings', 'setting_id', '1', '*');
        $this->data['site_name'] = $site_name = $site_name_values[0]['setting_value'];
        //set header, footer and leftmenu
        $this->data['title'] = 'Users | ' . $site_name;
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

    //display users list
    public function index() {

        $this->data['module_name'] = 'Users';
        $this->data['section_title'] = 'Users';

        $contition_array = array('status !=' => '3');
        $this->data['user_list'] = $this->common->select_data_by_condition('users', $contition_array, '*', $short_by = '', $order_by = '', $limit = '', $offset = '');

        $this->load->view('users/index', $this->data);
    }

    //update the user detail
    public function view($id = '') {

        $users_detail = $this->common->select_data_by_id('users', 'id', $id, '*');
        if ($users_detail[0]['id'] != '') {
            $this->data['module_name'] = 'Users';
            $this->data['section_title'] = 'View Users';
            $this->data['users_detail'] = $users_detail;

            $this->load->view('users/view', $this->data);
        } else {
            $this->session->set_flashdata('error', 'Errorout Occurred. Try Again.');
            redirect('users', 'refresh');
        }
    }
    
    //View User Transaction
    public function transaction($id = '') {

        $transactions_detail = $this->common->select_data_by_id('user_transactions', 'user_id', $id, '*');
        
        if (count($transactions_detail) > 0) {
            $this->data['module_name'] = 'View User Transaction';
            $this->data['section_title'] = 'View User Transaction';
            $this->data['transactions_detail'] = $transactions_detail;

            $this->load->view('users/transaction', $this->data);
        } else {
            $this->session->set_flashdata('error', 'No transaction found.');
            redirect('users', 'refresh');
        }
    }
    
    //View User Transaction
    public function bids($id = '') {

            $join_str = array(
            array(
                'table' => 'users',
                'join_table_id' => 'users.id',
                'from_table_id' => 'user_bids.user_id',
                'join_type' => 'left'
            ),
            array(
                'table' => 'products',
                'join_table_id' => 'products.id',
                'from_table_id' => 'user_bids.product_id',
                'join_type' => 'left'
            )
        );
        $condition_array = array('user_bids.user_id' => $id);
        $group_by = '';
        $bids_detail = $this->common->select_data_by_condition('user_bids', $condition_array, $data = 'user_bids.*,users.full_name,products.name,products.image', $short_by = '', $order_by = '', $limit='', $offset='', $join_str, $group_by);
        
        if (count($bids_detail) > 0) {
            $this->data['module_name'] = 'View User Bid';
            $this->data['section_title'] = 'View User Bid';
            $this->data['bids_detail'] = $bids_detail;

            $this->load->view('users/bid', $this->data);
        } else {
            $this->session->set_flashdata('error', 'No bid found.');
            redirect('users', 'refresh');
        }
    }
    // users status change
    public function change_status($users_id = '', $status = '') {
        if ($users_id == '' || $status == '') {
            $this->session->set_flashdata('error', 'Error Occurred. Try Agaim!');
            redirect('users', 'refresh');
        }
        if ($status == 1) {
            $status = 0;
        } else {
            $status = 1;
        }
        $update_data = array('status' => $status);

        $update_result = $this->common->update_data($update_data, 'users', 'id', $users_id);
        if ($update_result) {
            $this->session->set_flashdata('success', 'Users status successfully changed');
            redirect('users', 'refresh');
        } else {
            $this->session->set_flashdata('error', 'Error Occurred. Try Again!');
            redirect('users', 'refresh');
        }
    }

    // users delete
    public function delete($id = '') {
        $update_array = array('status' => 3);
        $delete_result = $this->common->update_data($update_array, 'users', 'id', $id);

        if ($delete_result) {
            $this->session->set_flashdata('success', 'Users successfully blocked');
            redirect('users', 'refresh');
        } else {
            $this->session->set_flashdata('error', 'Error Occurred. Try Again!');
            redirect('users', 'refresh');
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
                $users_thumb[$i]['image_library'] = 'gd2';
                $users_thumb[$i]['source_image'] = $this->config->item('users_main_upload_path') . $response['result'][$i]['file_name'];
                $users_thumb[$i]['new_image'] = $this->config->item('users_thumb_upload_path') . $response['result'][$i]['file_name'];
                $users_thumb[$i]['create_thumb'] = TRUE;
                $users_thumb[$i]['maintain_ratio'] = FALSE;
                $users_thumb[$i]['thumb_marker'] = '';
                $users_thumb[$i]['width'] = $this->config->item('users_thumb_width');
                $users_thumb[$i]['height'] = $this->config->item('users_thumb_height');
                $instanse = "image_$i";
                //Loading Image Library
                $this->load->library('image_lib', $users_thumb[$i], $instanse);
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

    public function delete_image($id = '', $usersimage_id = '') {
        if ($usersimage_id != '' && $id != '') {

            $get_image = $this->common->select_data_by_id('users_image', 'id', $usersimage_id, $data = 'image', $join_str = array());
            $image_name = $get_image[0]['image'];

            $main_image = $this->config->item('users_main_upload_path') . $image_name;
            $thumb_image = $this->config->item('users_thumb_upload_path') . $image_name;

            if (file_exists($main_image)) {
                unlink($main_image);
            }
            if (file_exists($thumb_image)) {
                unlink($thumb_image);
            }
            $this->common->delete_data('users_image', 'id', $usersimage_id);
            redirect('users/edit/' . $id, 'refresh');
        }
    }

}

?>