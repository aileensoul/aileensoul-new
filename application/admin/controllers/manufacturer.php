<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Manufacturer extends MY_Controller {

    public $data;

    public function __construct() {

        parent::__construct();

        //site setting details
        $site_name_values = $this->common->select_data_by_id('settings', 'setting_id', '1', '*');
        $this->data['site_name'] = $site_name = $site_name_values[0]['setting_value'];
        //set header, footer and leftmenu
        $this->data['title'] = 'Manufacturer : ' . $site_name;
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

        $this->data['module_name'] = 'Manufacturer Management';
        $this->data['section_title'] = 'Manufacturer Management';

        $contition_array = array('status != ' => '3');
        $data = '*';
        $this->data['manufacturer_list'] = $this->common->select_data_by_condition('manufacturers', $contition_array, $data, $short_by = '', $order_by = '', $limit = '', $offset = '');
        //load category data
        $this->load->view('manufacturer/index', $this->data);
    }

    //add manufacturer detail
    public function add() {

        if ($this->input->post('submit') == 'send') {

            $manufacturer_name = $this->input->post('manufacturer_name');
            if ($this->input->post('manufacturer_name') == '') {
                $this->session->set_flashdata('error', 'Manufacturer name is required');
                redirect('manufacturer', 'refresh');
            } else {
                $insert_array = array(
                    'name' => trim($this->input->post('manufacturer_name')),
                    'create_date' => gmdate('Y-m-d H:i:s'),
                    'modify_date' => gmdate('Y-m-d H:i:s'),
                    'status' => 1
                );
                $insert_id = $this->common->insert_data_getid($insert_array, 'manufacturers');

                if ($insert_id) {
                    $this->session->set_flashdata('success', 'Manufacturer successfully inserted.');
                    redirect('manufacturer', 'refresh');
                } else {
                    $this->session->set_flashdata('error', 'Error Occurred. Try Again!');
                    redirect('manufacturer', 'refresh');
                }
            }
        }
    }

    //update the manufacturer detail
    public function edit($id = '') {

        if ($this->input->post('manufacturer_id')) {

            $manufacturer_id = $this->input->post('manufacturer_id');
            if ($this->input->post('manufacturer_name') == '') {
                $this->session->set_flashdata('error', 'Manufacturer name is required');
                redirect('manufacturer', 'refresh');
            } else {
                $update_array = array(
                    'name' => trim($this->input->post('manufacturer_name')),
                    'modify_date' => date('Y-m-d H:i:s')
                );
                $update_result = $this->common->update_data($update_array, 'manufacturers', 'id', $this->input->post('manufacturer_id'));

                if ($update_result) {
                    $this->session->set_flashdata('success', 'Manufacturer successfully updated.');
                    redirect('manufacturer', 'refresh');
                } else {
                    $this->session->set_flashdata('error', 'Error Occurred. Try Again!');
                    redirect('manufacturer', 'refresh');
                }
            }
        }
    }

    // get name by id

    function getManufacturerName() {
        if ($this->input->post('manufacturer_id')) {
            $manufacturer_id = $this->input->post('manufacturer_id');
            $contition_array = array('id' => $manufacturer_id);
            $data = 'name';
            $manufacturer_name = $this->common->select_data_by_condition('manufacturers', $contition_array, $data, $short_by = '', $order_by = '', $limit = '', $offset = '');

            $return_data = array();
            $return_data['manufacturer_name'] = $manufacturer_name[0]['name'];
            header('Content-Type: application/json');
            echo json_encode($return_data);
            exit;
        }
    }

    function change_status($id,$status) {
        if ($status == 1) {
            $update_status = 2;
        } else {
            $update_status = 1;
        }
        $update_array = array(
            'status' => $update_status,
            'modify_date' => date('Y-m-d H:i:s')
        );
        $update_result = $this->common->update_data($update_array, 'manufacturers', 'id', $id);

        if ($update_result) {
            $this->session->set_flashdata('success', 'Manufacturer status updated');
            redirect('manufacturer', 'refresh');
        } else {
            $this->session->set_flashdata('error', 'Error Occurred. Try Again!');
            redirect('manufacturer', 'refresh');
        }
    }
    function delete($id) {
        
        $update_array = array(
            'status' => 3
        );
        $update_result = $this->common->update_data($update_array, 'manufacturers', 'id', $id);

        if ($update_result) {
            $this->session->set_flashdata('success', 'Manufacturer sucessfully deleted');
            redirect('manufacturer', 'refresh');
        } else {
            $this->session->set_flashdata('error', 'Error Occurred. Try Again!');
            redirect('manufacturer', 'refresh');
        }
    }

}

?>