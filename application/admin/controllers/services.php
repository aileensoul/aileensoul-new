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

        //Loadin Pagination Custome Config File
        $this->config->load('paging', TRUE);
        $this->paging = $this->config->item('paging');
        //print_r($this->paging);
        //die();
        //remove catch so after logout cannot view last visited page if that page is this
        $this->output->set_header('Last-Modified:' . gmdate('D, d M Y H:i:s') . 'GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
        $this->output->set_header('Cache-Control: post-check=0, pre-check=0', false);
        $this->output->set_header('Pragma: no-cache');
        // checkrole(); //for checking permission
    }

    //display user list
    public function index() {

        if ($this->session->userdata('user_search_keyword')) {
            $this->session->unset_userdata('user_search_keyword');
        }

        $this->data['module_name'] = 'Service';
        $this->data['section_title'] = 'Service';

        $limit = $this->paging['per_page'];

        if ($this->uri->segment(3) != '' && $this->uri->segment(4) != '') {
            $offset = ($this->uri->segment(5) != '') ? $this->uri->segment(5) : 0;
            $short_by = $this->uri->segment(3);
            $order_by = $this->uri->segment(4);
        } else {
            $offset = ($this->uri->segment(3) != '') ? $this->uri->segment(3) : 0;
            $short_by = 'service_title';
            $order_by = 'asc';
        }

        $this->data['offset'] = $offset;
        $contition_array = array('service.is_delete' => '0');
        //$contition_array = array('username != ' => 'client');
        
        
        
        $this->data['service_list'] = $this->common->select_data_by_condition('service', $contition_array, '*', $short_by, $order_by, $limit, $offset);
        if ($this->uri->segment(3) != '' && $this->uri->segment(4) != '') {
            $this->paging['base_url'] = site_url("service/index/" . $short_by . "/" . $order_by);
        } else {
            $this->paging['base_url'] = site_url("service/index/");
        }
        if ($this->uri->segment(3) != '' && $this->uri->segment(4) != '') {
            $this->paging['uri_segment'] = 5;
        } else {
            $this->paging['uri_segment'] = 3;
        }
        //for my use
        //$this->data['offset']=$offset;


        $this->paging['total_rows'] = count($this->common->select_data_by_condition('service', $contition_array, 'serviceid'));
        $this->data['total_rows'] = $this->paging['total_rows'];
        $this->data['limit'] = $limit;
        //$this->paging['per_page'] = 2;

        $this->pagination->initialize($this->paging);
        $this->data['search_keyword'] = '';
        $this->load->view('service/index', $this->data);
    }

    //search the user
    public function search() {
        $this->data['module_name'] = 'Service';
        $this->data['section_title'] = 'Service Search';

        //query for difficulty 

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
                $short_by = 'service_title';
                $order_by = 'asc';
            }
            $this->data['offset'] = $offset;
            //prepare search condition
            $contition_array = array('service.is_delete' => '0');
            $search_condition = "(service_title LIKE '%$search_keyword%' OR service_description LIKE '%$search_keyword%')";

           

            $this->data['service_list'] = $this->common->select_data_by_search('service', $search_condition, $contition_array, '*', $short_by, $order_by, $limit, $offset);
            

            if ($this->uri->segment(3) != '' && $this->uri->segment(4) != '') {
                $this->paging['base_url'] = site_url("service/search/" . $short_by . "/" . $order_by);
            } else {
                $this->paging['base_url'] = site_url("service/search/");
            }


            if ($this->uri->segment(3) != '' && $this->uri->segment(4) != '') {
                $this->paging['uri_segment'] = 5;
            } else {
                $this->paging['uri_segment'] = 3;
            }
            $this->paging['total_rows'] = count($this->common->select_data_by_search('service', $search_condition, $contition_array, 'serviceid'));

            //for record display
            $this->data['total_rows'] = $this->paging['total_rows'];
            $this->data['limit'] = $limit;


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
                $short_by = 'service_title';
                $order_by = 'asc';
            }
            $this->data['offset'] = $offset;
            //prepare search condition
           //prepare search condition
            $contition_array = array('service.is_delete' => '0');
            $search_condition = "(service_title LIKE '%$search_keyword%' OR service_description LIKE '%$search_keyword%')";

           

            $this->data['service_list'] = $this->common->select_data_by_search('service', $search_condition, $contition_array, '*', $short_by, $order_by, $limit, $offset);

            if ($this->uri->segment(3) != '' && $this->uri->segment(4) != '') {
                $this->paging['base_url'] = site_url("service/search/" . $short_by . "/" . $order_by);
            } else {
                $this->paging['base_url'] = site_url("service/search/");
            }


            if ($this->uri->segment(3) != '' && $this->uri->segment(4) != '') {
                $this->paging['uri_segment'] = 5;
            } else {
                $this->paging['uri_segment'] = 3;
            }
            $this->paging['total_rows'] = count($this->common->select_data_by_search('service', $search_condition, $contition_array, 'serviceid'));

            $this->data['total_rows'] = $this->paging['total_rows'];
            $this->data['limit'] = $limit;

            $this->pagination->initialize($this->paging);
        }
        $this->load->view('service/index', $this->data);
    }

    //add new user
    public function add() {

        //check post and save data
        if ($this->input->post('btn_save')) {

          $service['upload_path'] = $this->config->item('service_main_upload_path');
            $service['allowed_types'] = $this->config->item('service_allowed_types');
            $service['max_size'] = $this->config->item('service_main_max_size');
//            $service['max_width'] = $this->config->item('service_main_max_width');
//            $service['max_height'] = $this->config->item('service_main_max_height');
            
            $this->load->library('upload');
                $this->upload->initialize($service);
                //Uploading Image
                $this->upload->do_upload('service_image');
                //Getting Uploaded Image File Data
                $imgdata = $this->upload->data();
                $imgerror = $this->upload->display_errors();
              
                if ($imgerror == '') {
                    //Configuring Thumbnail 
                    $service_thumb['image_library'] = 'gd2';
                    $service_thumb['source_image'] = $service['upload_path'] . $imgdata['file_name'];
                    $service_thumb['new_image'] = $this->config->item('service_thumb_upload_path') . $imgdata['file_name'];
                    $service_thumb['create_thumb'] = TRUE;
                    $service_thumb['maintain_ratio'] = FALSE;
                    $service_thumb['thumb_marker'] = '';
//                    $service_thumb['width'] = $this->config->item('service_thumb_width');
//                    $service_thumb['height'] = $this->config->item('service_thumb_height');

                    //Loading Image Library
                    $this->load->library('image_lib', $service_thumb);
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
                    $redirect_url = site_url('service');
                    redirect($redirect_url, 'refresh');
                } else {
                 
                    $service = $imgdata['file_name'];
                }

                
            $url=$this->common->create_unique_url(trim($this->input->post('service_title')),'service','unique_url',$key=NULL,$value=NULL);
                
            $insert_array = array(
                'unique_url' =>$url,
                'service_title' => trim($this->input->post('service_title')),
                'sort_description' => trim($this->input->post('sort_description')),
                'serviceimage'=>$service,
                'service_description' => trim($this->input->post('service_description')),
                'insertdatetime' => date('Y-m-d H:i:s'),
                'editdatetime' => date('Y-m-d H:i:s'),
                'insertip' => getHostByName(getHostName()),
                'editip' => getHostByName(getHostName())
            );

            $insert_result = $this->common->insert_data($insert_array, 'service');

            if ($this->input->post('redirect_url')) {
                $redirect_url = $this->input->post('redirect_url');
            } else {
                $redirect_url = site_url('service');
            }

            if ($insert_result) {

                $this->session->set_flashdata('success', 'Service successfully inserted.');
                if ($this->input->post('btn_save_add')) {
                    $redirect_url = site_url('service/add');
                    redirect($redirect_url, 'refresh');
                } else {
                    $redirect_url = site_url('service');
                    redirect($redirect_url, 'refresh');
                }
            } else {
                $this->session->set_flashdata('error', 'Error Occurred. Try Again!');
                redirect($redirect_url, 'refresh');
            }
        }



        $this->data['module_name'] = 'Service';
        $this->data['section_title'] = 'Add New';

        $this->load->view('service/add', $this->data);
    }

    //update the user detail
    public function edit($id = '') {

        if ($this->input->post('serviceid')) {

            if($_FILES['service_image']['name']!=''){
              
                 
                 
                $service['upload_path'] = $this->config->item('service_main_upload_path');
                $service['allowed_types'] = $this->config->item('service_allowed_types');
                $service['max_size'] = $this->config->item('service_main_max_size');
                $service['max_width'] = $this->config->item('service_main_max_width');
                $service['max_height'] = $this->config->item('service_main_max_height');

                //    $this->load->library('upload', $service);

                $this->load->library('upload');
                $this->upload->initialize($service);
                //Uploading Image
                $this->upload->do_upload('service_image');
                //Getting Uploaded Image File Data
                $imgdata = $this->upload->data();
                $imgerror = $this->upload->display_errors();
              
                if ($imgerror == '') {
                    //Configuring Thumbnail 
                    $service_thumb['image_library'] = 'gd2';
                    $service_thumb['source_image'] = $service['upload_path'] . $imgdata['file_name'];
                    $service_thumb['new_image'] = $this->config->item('service_thumb_upload_path') . $imgdata['file_name'];
                    $service_thumb['create_thumb'] = TRUE;
                    $service_thumb['maintain_ratio'] = FALSE;
                    $service_thumb['thumb_marker'] = '';
                    $service_thumb['width'] = $this->config->item('service_thumb_width');
                    $service_thumb['height'] = $this->config->item('service_thumb_height');

                    //Loading Image Library
                    $this->load->library('image_lib', $service_thumb);
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
                    $redirect_url = site_url('service');
                    redirect($redirect_url, 'refresh');
                } else {
               
                    $service = $imgdata['file_name'];
                    
                    $main_path=$this->config->item('service_main_upload_path').$this->input->post('oldservice');
                    $thumb_path=$this->config->item('service_thumb_upload_path').$this->input->post('oldservice');

                  
                    if(file_exists($main_path) && $this->input->post('oldservice') != '' ){
                        unlink($main_path);
                    }
                    if(file_exists($thumb_path) && $this->input->post('oldservice') != '' ){
                        unlink($thumb_path);
                    }
                }
            } else {
                $service = $this->input->post('oldservice');
            }

            $update_array = array(
                'service_title' => trim($this->input->post('service_title')),
                'sort_description' => trim($this->input->post('sort_description')),
                'serviceimage'=>$service,
                'service_description' => trim($this->input->post('service_description')),
                'editdatetime' => date('Y-m-d H:i:s'),
                'editip' => getHostByName(getHostName())
            );

            $update_result = $this->common->update_data($update_array, 'service', 'serviceid', $this->input->post('serviceid'));





            if ($this->input->post('redirect_url')) {
                $redirect_url = $this->input->post('redirect_url');
            } else {
                $redirect_url = site_url('service');
            }

            if ($update_result) {

                $this->session->set_flashdata('success', 'Service successfully updated.');
                redirect($redirect_url, 'refresh');
            } else {
                $this->session->set_flashdata('error', 'Errorin Occurred. Try Again!');
                redirect($redirect_url, 'refresh');
            }
        }

        $service_detail = $this->common->select_data_by_id('service', 'serviceid', $id, '*');
        if (!empty($service_detail)) {
            $this->data['module_name'] = 'Service';
            $this->data['section_title'] = 'Edit';
            $this->data['service_detail'] = $service_detail;
            $this->load->view('service/edit', $this->data);
        } else {
            $this->session->set_flashdata('error', 'Errorout Occurred. Try Again.');
            redirect('service', 'refresh');
        }
    }

    public function change_status($user_id = '', $status = '') {
        if ($user_id == '' || $status == '') {
            $this->session->set_flashdata('error', 'Error Occurred. Try Agaim!');
            redirect('service', 'refresh');
        }
        if ($status == 'Enable') {
            $status = "Disable";
        } else {
            $status = 'Enable';
        }


        $update_data = array('status' => $status);
        
        $update_result = $this->common->update_data($update_data, 'service', 'serviceid', $user_id);
        if (isset($_SERVER['HTTP_REFERER'])) {
            $redirect_url = $_SERVER['HTTP_REFERER'];
        } else {
            $redirect_url = site_url() . 'service';
        }
        if ($update_result) {
            $this->session->set_flashdata('success', 'Service status successfully changed');
            redirect($redirect_url, 'refresh');
        } else {
            $this->session->set_flashdata('error', 'Error Occurred. Try Again!');
            redirect($redirect_url, 'refresh');
        }
    }

    public function delete($id = '') {
        $update_array = array('is_delete' => '1', 'editdatetime' => date('Y-m-d H:i:s'), 'editip' => getHostByName(getHostName()));
        $delete_result = $this->common->update_data($update_array, 'service', 'serviceid', $id);
        //$delete_result = $this->common->delete_data( 'service', 'id', $id);

        if (isset($_SERVER['HTTP_REFERER'])) {
            $redirect_url = $_SERVER['HTTP_REFERER'];
        } else {
            $redirect_url = site_url('service');
        }

        if ($delete_result) {

            $this->session->set_flashdata('success', 'Service successfully deleted.');
            redirect($redirect_url, 'refresh');
        } else {
            $this->session->set_flashdata('error', 'Error Occurred. Try Again!');
            redirect($redirect_url, 'refresh');
        }
    }

    public function mdelete($id = '') {
        foreach ($this->input->post('deletes') as $delete) {
            $update_array = array('is_delete' => '1', 'editdatetime' => date('Y-m-d H:i:s'), 'editip' => getHostByName(getHostName()));
            $delete_result = $this->common->update_data($update_array, 'service', 'serviceid', $delete);
        }

        if (isset($_SERVER['HTTP_REFERER'])) {
            $redirect_url = site_url('service');
        } else {
            $redirect_url = site_url('service');
        }

        if ($delete_result) {

            $this->session->set_flashdata('success', 'services successfully deleted.');
            redirect($redirect_url, 'refresh');
        } else {
            $this->session->set_flashdata('error', 'Error Occurred. Try Again!');
            redirect($redirect_url, 'refresh');
        }
    }

    //change status






    public function clear_search() {
        $this->session->unset_userdata('user_search_keyword');
        redirect('service', 'refresh');
    }

    public function sub_cat() {
        $str = '';
        if ($this->input->is_ajax_request() && $this->input->post('id')) {
            $id = $this->input->post('id');
            $cat_id = $this->input->post('sel_id');
            $contition_array = array('is_deleted != ' => '1', 'parent_id' => $id);
            $arrays = $this->common->select_data_by_condition('category', $contition_array, '*', 'category_title', 'asc');

            if (count($arrays)) {
                $str.="<option value='0'>select sub </option>";
                foreach ($arrays as $cat) {
                    //$str='';
                    $str.= "<option value='" . $cat['categoryid'] . "'";
                    if ($cat_id == $cat['categoryid']) {
                        $str.="selected='selected'";
                    }

                    $str.=">" . $cat['category_title'] . "</option>";
                }
            } else {
                $str = "<option value='0'>select sub </option>";
            }
        } else {
            $str = "<option value='0'>select sub </option>";
        }
        echo $str;
        die();
    }

}

?>