<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class User extends MY_Controller {

    public $data;

    public function __construct() {

        parent::__construct();

        //site setting details
        $site_name_values = $this->common->select_data_by_id('settings', 'setting_id', '1', '*');
        $this->data['site_name'] = $site_name = $site_name_values[0]['setting_value'];
        //set header, footer and leftmenu
        $this->data['title'] = 'User : ' . $site_name;
        $this->data['header'] = $this->load->view('header', $this->data);
        $this->data['leftmenu'] = $this->load->view('leftmenu', $this->data);
        $this->data['footer'] = $this->load->view('footer', $this->data,true);


        $this->load->model('common');

        //Loadin Pagination Custome Config File
        $this->config->load('paging', TRUE);
        $this->paging = $this->config->item('paging');

        //remove catch so after logout cannot view last visited page if that page is this
        $this->output->set_header('Last-Modified:' . gmdate('D, d M Y H:i:s') . 'GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
        $this->output->set_header('Cache-Control: post-check=0, pre-check=0', false);
        $this->output->set_header('Pragma: no-cache');
    }

    //display user list
    public function index() {

        if ($this->session->userdata('user_search_keyword')) {
            $this->session->unset_userdata('user_search_keyword');
        }

        $this->data['module_name'] = 'User Management';
        $this->data['section_title'] = 'User Management';

        $this->data['limit']=$limit = $this->paging['per_page'];
        if ($this->uri->segment(3) != '' && $this->uri->segment(4) != '') {
            $offset = ($this->uri->segment(5) != '') ? $this->uri->segment(5) : 0;
            $short_by = $this->uri->segment(3);
            $order_by = $this->uri->segment(4);
        } else {
            $offset = ($this->uri->segment(3) != '') ? $this->uri->segment(3) : 0;
            $short_by = 'username';
            $order_by = 'asc';
        }

        $this->data['offset'] = $offset;
        $contition_array = array('is_deleted != ' => '1');
        $this->data['user_list'] = $this->common->select_data_by_condition('users', $contition_array, '*', $short_by, $order_by, $limit, $offset);
        
        if ($this->uri->segment(3) != '' && $this->uri->segment(4) != '') {
            $this->paging['base_url'] = site_url("user/index/" . $short_by . "/" . $order_by);
        } else {
            $this->paging['base_url'] = site_url("user/index/");
        }
        if ($this->uri->segment(3) != '' && $this->uri->segment(4) != '') {
            $this->paging['uri_segment'] = 5;
        } else {
            $this->paging['uri_segment'] = 3;
        }
        
        $this->data['total_rows']=$this->paging['total_rows'] = count($this->common->select_data_by_condition('users', $contition_array, 'userid'));

        
         
        
        $this->pagination->initialize($this->paging);
        $this->data['search_keyword'] = '';
        $this->load->view('user/index', $this->data);
    }

    //search the user
    public function search() {
        $this->data['module_name'] = 'User Management';
        $this->data['section_title'] = 'User Search';

        
        
        if ($this->input->post('search_keyword')) {
            $this->data['search_keyword'] = $search_keyword = $this->input->post('search_keyword');
            $this->session->set_userdata('user_search_keyword', $search_keyword);
           
           
            $limit = $this->paging['per_page'];
            if ($this->uri->segment(3) != '' && $this->uri->segment(4) != '') {
                $offset = ($this->uri->segment(5) != '') ? $this->uri->segment(5) : 0;
                $short_by = $this->uri->segment(3);
                $order_by = $this->uri->segment(4);
            } else {
                $offset = ($this->uri->segment(3) != '') ? $this->uri->segment(3) : 0;
                $short_by = 'username';
                $order_by = 'asc';
            }
            $this->data['offset'] = $offset;
            //prepare search condition
            $search_condition = "(username LIKE '%$search_keyword%' OR email LIKE '%$search_keyword%')";

            $contition_array = array('is_deleted != ' => '1');
            $this->data['user_list'] = $this->common->select_data_by_search('users', $search_condition, $contition_array, '*', $short_by, $order_by, $limit, $offset);

            if ($this->uri->segment(3) != '' && $this->uri->segment(4) != '') {
                $this->paging['base_url'] = site_url("user/search/" . $short_by . "/" . $order_by);
            } else {
                $this->paging['base_url'] = site_url("user/search/");
            }


            if ($this->uri->segment(3) != '' && $this->uri->segment(4) != '') {
                $this->paging['uri_segment'] = 5;
            } else {
                $this->paging['uri_segment'] = 3;
            }
            $this->paging['total_rows'] = count($this->common->select_data_by_search('users', $search_condition, $contition_array, 'userid'));
            
            //for record display
            $this->data['total_rows']=$this->paging['total_rows'];
            $this->data['limit']=$limit;
            
            
            $this->pagination->initialize($this->paging);
        } else if ($this->session->userdata('user_search_keyword')) {
            $this->data['search_keyword'] = $search_keyword = $this->session->userdata('user_search_keyword');

            $limit = $this->paging['per_page'];
            if ($this->uri->segment(3) != '' && $this->uri->segment(4) != '') {
                $offset = ($this->uri->segment(5) != '') ? $this->uri->segment(5) : 0;
                $short_by = $this->uri->segment(3);
                $order_by = $this->uri->segment(4);
            } else {
                $offset = ($this->uri->segment(3) != '') ? $this->uri->segment(3) : 0;
                $short_by = 'username';
                $order_by = 'asc';
            }
            $this->data['offset'] = $offset;
            //prepare search condition
            $search_condition = "(username LIKE '%$search_keyword%' OR email LIKE '%$search_keyword%')";

            $contition_array = array('is_deleted != ' => '1');
            $this->data['user_list'] = $this->common->select_data_by_search('users', $search_condition, $contition_array, '*', $short_by, $order_by, $limit, $offset);

            if ($this->uri->segment(3) != '' && $this->uri->segment(4) != '') {
                $this->paging['base_url'] = site_url("user/search/" . $short_by . "/" . $order_by);
            } else {
                $this->paging['base_url'] = site_url("user/search/");
            }


            if ($this->uri->segment(3) != '' && $this->uri->segment(4) != '') {
                $this->paging['uri_segment'] = 5;
            } else {
                $this->paging['uri_segment'] = 3;
            }
            $this->paging['total_rows'] = count($this->common->select_data_by_search('users', $search_condition, $contition_array, 'userid'));
            
            //for record display
            $this->data['total_rows']=$this->paging['total_rows'];
            $this->data['limit']=$limit;
            
            
            $this->pagination->initialize($this->paging);
        }

        $this->load->view('user/index', $this->data);
    }

    //add new user
    public function add() {

        //check post and save data
        if ($this->input->post('username')) {
           
//                    $upload_config = array(
//                         'upload_path'   =>  './uploads/',
//                         'allowed_types' =>  'jpg|jpeg|gif|png',
//
//                         );
//
//                         $this->load->library('upload', $upload_config);
//
//                         $this->upload->initialize($upload_config);
//
//                         $this->upload->do_upload('profile_pic');

            $insert_array = array(
                
//                'profile_pic' =>  $this->upload->data()['file_name'],
                'username' => trim($this->input->post('username')),
                'email' => trim($this->input->post('email')),
                'password' =>md5($this->input->post('password')),
                'address' => trim($this->input->post('address')),
                'contact_no' => trim($this->input->post('contact_no')),
                'insert_date' => date('Y-m-d H:i:s'),
                'insertip' => getHostByName(getHostName()),
                'edit_date' => date('Y-m-d H:i:s'),
                'editip' => getHostByName(getHostName())
                //'level' => ($this->input->post('level')),
                
            );
            
            $insert_result = $this->common->insert_data($insert_array, 'users');
            
            if ($this->input->post('redirect_url')) {
                $redirect_url = $this->input->post('redirect_url');
            } else {
                $redirect_url = site_url() . 'user';
            }

            if ($insert_result) {
                $this->session->set_flashdata('success', 'User successfully inserted.');
                redirect($redirect_url, 'refresh');
            } else {
                $this->session->set_flashdata('error', 'Error Occurred. Try Again!');
                redirect($redirect_url, 'refresh');
            }
        }

        $this->data['module_name'] = 'User Management';
        $this->data['section_title'] = 'Add User';

        $this->load->view('user/add', $this->data);
    }

    //update the user detail
    public function edit($id = '') {
      

        if ($this->input->post('userid')) {
          
            $update_array = array(
            
                'username' => trim($this->input->post('username')),
                'email' => trim($this->input->post('email')),
                'address' => trim($this->input->post('address')),
                'contact_no' => trim($this->input->post('contact_no')),
                'insert_date' => date('Y-m-d H:i:s'),
                'insertip' => getHostByName(getHostName()),
                'edit_date' => date('Y-m-d H:i:s'),
                'editip' => getHostByName(getHostName())
                
            );
            
                        
            $update_result = $this->common->update_data($update_array, 'users', 'userid', $this->input->post('userid'));
           
            if ($this->input->post('redirect_url')) {
                $redirect_url = $this->input->post('redirect_url');
            } else {
                $redirect_url = site_url() . 'user';
            }

            if ($update_result) {
                $this->session->set_flashdata('success', 'User successfully updated.');
                redirect($redirect_url, 'refresh');
            } else {
                $this->session->set_flashdata('error', 'Error Occurred. Try Again!');
                redirect($redirect_url, 'refresh');
            }
        }

        $user_detail = $this->common->select_data_by_id('users', 'userid', $id, '*');
        if (!empty($user_detail)) {
            $this->data['module_name'] = 'User Management';
            $this->data['section_title'] = 'Edit User';
            $this->data['user_detail'] = $user_detail;
            $this->load->view('user/edit', $this->data);
        } else {
            $this->session->set_flashdata('error', 'Error Occurred sachin. Try Again.');
            redirect('user', 'refresh');
        }
    }

    public function delete($id = '') {
        $update_array = array('is_deleted' => '1','edit_date'=>date('Y-m-d H:i:s'),'editip'=>getHostByName(getHostName()));
        $delete_result = $this->common->update_data($update_array, 'users', 'userid', $id);
        //$delete_data = array('is_delete' => '1');
        //$delete_result = $this->common->delete_data( 'user', 'id', $id);

        if (isset($_SERVER['HTTP_REFERER'])) {
            $redirect_url = $_SERVER['HTTP_REFERER'];
        } else {
            $redirect_url = site_url('user');
        }

        if ($delete_result) {
            $this->session->set_flashdata('success', 'User successfully deleted.');
            redirect($redirect_url, 'refresh');
        } else {
            $this->session->set_flashdata('error', 'Error Occurred. Try Again!');
            redirect($redirect_url, 'refresh');
        }
    }
    
    //change status
    public function change_status($user_id='',$status=''){
        if($user_id=='' || $status==''){
            $this->session->set_flashdata('error','Error Occurred. Try Agaim!');
            redirect('user','refresh');
        }
        if($status=='Enable'){
            $status="Disable";
        }else{
            $status='Enable';
        }
        
        
        $update_data=array('status'=>$status);
        
        $update_result=  $this->common->update_data($update_data,'users','userid',$user_id);
        if (isset($_SERVER['HTTP_REFERER'])) {
            $redirect_url = $_SERVER['HTTP_REFERER'];
        } else {
            $redirect_url = site_url() . 'user';
        }
        if($update_result){
            $this->session->set_flashdata('success', 'User status successfully changed');
            redirect($redirect_url, 'refresh');
        }
        else{
            $this->session->set_flashdata('error', 'Error Occurred. Try Again!');
            redirect($redirect_url, 'refresh');
        }
    }

    public function check_email() {
        if ($this->input->is_ajax_request() && $this->input->post('email')) {


            $email = $this->input->post('email');
            $condition_array = array('is_deleted' => '0');
            if ($this->input->post('userid')) {
                $id = $this->input->post('userid');

                $check_result = $this->common->check_unique_avalibility('users', 'email', $email, 'userid', $id);
            } else {
                $check_result = $this->common->check_unique_avalibility('users', 'email', $email, '', '');
            }
            
            if ($check_result) {
                echo 'true';
                die();
            } else {
                echo 'false';
                die();
            }
        }
    }

    public function check_username() {
        if ($this->input->is_ajax_request() && $this->input->post('username')) {

            $user_name = $this->input->post('username');
            $condition_array = array('');
            if ($this->input->post('userid')) {
                $id = $this->input->post('userid');
                $check_result = $this->common->check_unique_avalibility('users', 'username', $user_name, 'userid', $id);
            } else {
                $check_result = $this->common->check_unique_avalibility('users', 'username', $user_name, '', '');
            }

            if ($check_result) {
                echo 'true';
                die();
            } else {
                echo 'false';
                die();
            }
        }
    }

    public function clear_search() {
        $this->session->unset_userdata('user_search_keyword');
        redirect('user', 'refresh');
    }
    public function mdelete($id=''){
        foreach ($this->input->post('deletes') as $delete) {
             $update_array = array('is_deleted' => '1','edit_date'=>date('Y-m-d H:i:s'),'editip'=>getHostByName(getHostName()));
             $delete_result = $this->common->update_data($update_array, 'users', 'userid', $delete);
            }
            
        if (isset($_SERVER['HTTP_REFERER'])) {
            $redirect_url = $_SERVER['HTTP_REFERER'];
        } else {
            $redirect_url = site_url('user');
        }

        if ($delete_result) {
           
            $this->session->set_flashdata('success', 'Users successfully deleted.');
            redirect($redirect_url, 'refresh');
        } else {
            $this->session->set_flashdata('error', 'Error Occurred. Try Again!');
            redirect($redirect_url, 'refresh');
        }
       
    }

}

?>