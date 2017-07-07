<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Bid_package extends MY_Controller {

    public $data;

    public function __construct() {

        parent::__construct();

        //site setting details
        $site_name_values = $this->common->select_data_by_id('settings', 'setting_id', '1', '*');
        $this->data['site_name'] = $site_name = $site_name_values[0]['setting_value'];
        //set header, footer and leftmenu
        $this->data['title'] = 'Bid Package : ' . $site_name;
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

        $this->data['module_name'] = 'Bid Package Management';
        $this->data['section_title'] = 'Bid Package Management';

        $contition_array = array('status != ' => '3');
        $data = '*';
        $this->data['package_list'] = $this->common->select_data_by_condition('bid_package', $contition_array, $data, $short_by = '', $order_by = '', $limit = '', $offset = '');
        //load category data
        $this->load->view('bid_package/index', $this->data);
    }

    //add bid_package detail
    public function add() {

        if ($this->input->post('submit') == 'send') {

            $package = $this->input->post('package');
            $error = '';
            if ($this->input->post('package') == '') {
                $error = 1;
                $this->session->set_flashdata('error', 'Package coins is required');
                redirect('bid_package', 'refresh');
            }
            if ($this->input->post('price') == '') {
                $error = 1;
                $this->session->set_flashdata('error', 'Package price is required');
                redirect('bid_package', 'refresh');
            }
            if ($error == 1) {
                $this->session->set_flashdata('error', 'Something error!');
                redirect('bid_package', 'refresh');
            }  else {
                $insert_array = array(
                    'package' => trim($this->input->post('package')),
                    'price' => trim($this->input->post('price')),
                    'create_date' => date('Y-m-d H:i:s'),
                    'modify_date' => date('Y-m-d H:i:s'),
                    'status' => 1
                );
                $insert_id = $this->common->insert_data_getid($insert_array, 'bid_package');

                if ($insert_id) {
                    $this->session->set_flashdata('success', 'Bid package successfully inserted.');
                    redirect('bid_package', 'refresh');
                } else {
                    $this->session->set_flashdata('error', 'Error Occurred. Try Again!');
                    redirect('bid_package', 'refresh');
                }
            }
        }
    }

    //update the bid_package detail
    public function edit() {

        if ($this->input->post('package_id')) {

            $bid_package_id = $this->input->post('package_id');
            $error = '';
            if ($this->input->post('package') == '') {
                $error = 1;
                $this->session->set_flashdata('error', 'Package coins is required');
                redirect('bid_package', 'refresh');
            }
            if ($this->input->post('price') == '') {
                $error = 1;
                $this->session->set_flashdata('error', 'Package price is required');
                redirect('bid_package', 'refresh');
            }
            if ($error == 1) {
                $this->session->set_flashdata('error', 'Something error!');
                redirect('bid_package', 'refresh');
            } else {
                $update_array = array(
                    'package' => trim($this->input->post('package')),
                    'price' => trim($this->input->post('price')),
                    'modify_date' => date('Y-m-d H:i:s')
                );
                
                $update_result = $this->common->update_data($update_array, 'bid_package', 'package_id', $this->input->post('package_id'));

                if ($update_result) {
                    $this->session->set_flashdata('success', 'Bid package successfully updated.');
                    redirect('bid_package', 'refresh');
                } else {
                    $this->session->set_flashdata('error', 'Error Occurred. Try Again!');
                    redirect('bid_package', 'refresh');
                }
            }
        }
    }

    // get name by id

    function getPackageData() {
        if ($this->input->post('package_id')) {
            $bid_package_id = $this->input->post('package_id');
            $contition_array = array('package_id' => $bid_package_id);
            $data = 'package,price';
            $package_data = $this->common->select_data_by_condition('bid_package', $contition_array, $data, $short_by = '', $order_by = '', $limit = '', $offset = '');

            $return_data = array();
            $return_data['package'] = $package_data[0]['package'];
            $return_data['price'] = $package_data[0]['price'];
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
        $update_result = $this->common->update_data($update_array, 'bid_package', 'package_id', $id);

        if ($update_result) {
            $this->session->set_flashdata('success', 'Bid package status updated');
            redirect('bid_package', 'refresh');
        } else {
            $this->session->set_flashdata('error', 'Error Occurred. Try Again!');
            redirect('bid_package', 'refresh');
        }
    }

    function delete($id) {

        $update_array = array(
            'status' => 3
        );
        $update_result = $this->common->update_data($update_array, 'bid_package', 'package_id', $id);

        if ($update_result) {
            $this->session->set_flashdata('success', 'Bid package sucessfully deleted');
            redirect('bid_package', 'refresh');
        } else {
            $this->session->set_flashdata('error', 'Error Occurred. Try Again!');
            redirect('bid_package', 'refresh');
        }
    }

}

?>