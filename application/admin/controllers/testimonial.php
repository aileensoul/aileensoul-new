<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Testimonial extends MY_Controller {

    public $data;

    public function __construct() {

        parent::__construct();
     
        //$GLOBALS['record_per_page']=10;
        //site setting details
        $site_name_values = $this->common->select_data_by_id('settings', 'setting_id', '1', '*');
        $this->data['site_name'] = $site_name = $site_name_values[0]['setting_value'];
        //set header, footer and leftmenu
        $this->data['title'] = 'Testimonial : ' . $site_name;
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

        $this->data['module_name'] = 'Testimonial';
        $this->data['section_title'] = 'Testimonial';

        $limit = $this->paging['per_page'];

        if ($this->uri->segment(3) != '' && $this->uri->segment(4) != '') {
            $offset = ($this->uri->segment(5) != '') ? $this->uri->segment(5) : 0;
            $short_by = $this->uri->segment(3);
            $order_by = $this->uri->segment(4);
        } else {
            $offset = ($this->uri->segment(3) != '') ? $this->uri->segment(3) : 0;
            $short_by = 'clientname';
            $order_by = 'asc';
        }

        $this->data['offset'] = $offset;
        $contition_array = array('is_delete' => '0');
        //$contition_array = array('username != ' => 'client');
        $this->data['testimonial_list'] = $this->common->select_data_by_condition('testimonial', $contition_array, '*', $short_by, $order_by, $limit, $offset);
       
        if ($this->uri->segment(3) != '' && $this->uri->segment(4) != '') {
            $this->paging['base_url'] = site_url("testimonial/index/" . $short_by . "/" . $order_by);
        } else {
            $this->paging['base_url'] = site_url("testimonial/index/");
        }
        if ($this->uri->segment(3) != '' && $this->uri->segment(4) != '') {
            $this->paging['uri_segment'] = 5;
        } else {
            $this->paging['uri_segment'] = 3;
        }
        //for my use
        //$this->data['offset']=$offset;


        $this->paging['total_rows'] = count($this->common->select_data_by_condition('testimonial', $contition_array, 'testimonialid'));
        $this->data['total_rows'] = $this->paging['total_rows'];
        $this->data['limit'] = $limit;
        //$this->paging['per_page'] = 2;

        $this->pagination->initialize($this->paging);
        $this->data['search_keyword'] = '';
        $this->load->view('testimonial/index', $this->data);
    }

    //search the user
    public function search() {
        $this->data['module_name'] = 'Testimonial';
        $this->data['section_title'] = 'Testimonial Search';

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
                $short_by = 'clientname';
                $order_by = 'asc';
            }
            $this->data['offset'] = $offset;
            //prepare search condition
            
            $contition_array = array('is_delete' => '0');
            $search_condition = "(clientname LIKE '%$search_keyword%' OR testimonialtext LIKE '%$search_keyword%' OR clientprofession LIKE '%$search_keyword%')";

            $this->data['testimonial_list'] = $this->common->select_data_by_search('testimonial', $search_condition, $contition_array, '*', $short_by, $order_by, $limit, $offset);
            
            if ($this->uri->segment(3) != '' && $this->uri->segment(4) != '') {
                $this->paging['base_url'] = site_url("testimonial/search/" . $short_by . "/" . $order_by);
            } else {
                $this->paging['base_url'] = site_url("testimonial/search/");
            }


            if ($this->uri->segment(3) != '' && $this->uri->segment(4) != '') {
                $this->paging['uri_segment'] = 5;
            } else {
                $this->paging['uri_segment'] = 3;
            }
            $this->paging['total_rows'] = count($this->common->select_data_by_search('testimonial', $search_condition, $contition_array, 'testimonialid'));

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
                $short_by = 'clientname';
                $order_by = 'asc';
            }
            $this->data['offset'] = $offset;
            //prepare search condition
            $contition_array = array('is_delete' => '0');
            $search_condition = "(clientname LIKE '%$search_keyword%' OR testimonialtext LIKE '%$search_keyword%' OR clientprofession LIKE '%$search_keyword%')";

            $this->data['testimonial_list'] = $this->common->select_data_by_search('testimonial', $search_condition, $contition_array, '*', $short_by, $order_by, $limit, $offset);

            


            if ($this->uri->segment(3) != '' && $this->uri->segment(4) != '') {
                $this->paging['base_url'] = site_url("testimonial/search/" . $short_by . "/" . $order_by);
            } else {
                $this->paging['base_url'] = site_url("testimonial/search/");
            }


            if ($this->uri->segment(3) != '' && $this->uri->segment(4) != '') {
                $this->paging['uri_segment'] = 5;
            } else {
                $this->paging['uri_segment'] = 3;
            }
            $this->paging['total_rows'] = count($this->common->select_data_by_search('testimonial', $search_condition, $contition_array, 'testimonialid'));

            $this->data['total_rows'] = $this->paging['total_rows'];
            $this->data['limit'] = $limit;

            $this->pagination->initialize($this->paging);
        }
        $this->load->view('testimonial/index', $this->data);
    }

    //add new user
    public function add() {

        //check post and save data
        if ($this->input->post('btn_save')) {

            $testimonial['upload_path'] = $this->config->item('testimonial_main_upload_path');
            $testimonial['allowed_types'] = $this->config->item('testimonial_allowed_types');
            $testimonial['max_size'] = $this->config->item('testimonial_main_max_size');
//            $testimonial['max_width'] = $this->config->item('testimonial_main_max_width'); add this line for image demension 
//            $testimonial['max_height'] = $this->config->item('testimonial_main_max_height');

          

            $this->load->library('upload');
            $this->upload->initialize($testimonial);
            //Uploading Image
            $this->upload->do_upload('clientimage');
            //Getting Uploaded Image File Data
            $imgdata = $this->upload->data();
            $imgerror = $this->upload->display_errors();
           
            if ($imgerror == '') {
                //Configuring Thumbnail 
                $testimonial_thumb['image_library'] = 'gd2';
                $testimonial_thumb['source_image'] = $testimonial['upload_path'] . $imgdata['file_name'];
                $testimonial_thumb['new_image'] = $this->config->item('testimonial_thumb_upload_path') . $imgdata['file_name'];
                $testimonial_thumb['create_thumb'] = TRUE;
                $testimonial_thumb['maintain_ratio'] = FALSE;
                $testimonial_thumb['thumb_marker'] = '';
                $testimonial_thumb['width'] = $this->config->item('testimonial_thumb_width');
                $testimonial_thumb['height'] = $this->config->item('testimonial_thumb_height');

                //Loading Image Library
                $this->load->library('image_lib', $testimonial_thumb);
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
                $redirect_url = site_url('testimonial');
                redirect($redirect_url, 'refresh');
            } else {
                $testimonial_image = $imgdata['file_name'];
            }

            $insert_array = array(
                'clientname' =>trim($this->input->post('clientname')),
                'clientimage' => $testimonial_image,
                'clientprofession' => trim($this->input->post('clientprofession')),       
                'testimonialtext' => trim($this->input->post('text')),
                'insertip' => $_SERVER['REMOTE_ADDR'],
                'insertdatetime' => date('Y-m-d h:i:s'),
                'editip' => getHostByName(getHostName()),
                'editdatetime' => date('Y-m-d H:i:s'),
            );

            $insert_result = $this->common->insert_data($insert_array, 'testimonial');

            if ($this->input->post('redirect_url')) {
                $redirect_url = $this->input->post('redirect_url');
            } else {
                $redirect_url = site_url('testimonial');
            }

            if ($insert_result) {

                $this->session->set_flashdata('success', 'Testimonial successfully inserted.');
                if ($this->input->post('btn_save_add')) {
                    $redirect_url = site_url('testimonial/add');
                    redirect($redirect_url, 'refresh');
                } else {
                    $redirect_url = site_url('testimonial');
                    redirect($redirect_url, 'refresh');
                }
            } else {
                $this->session->set_flashdata('error', 'Error Occurred. Try Again!');
                redirect($redirect_url, 'refresh');
            }
        }



        $this->data['module_name'] = 'Testimonial';
        $this->data['section_title'] = 'Add New';

        $this->load->view('testimonial/add', $this->data);
    }

    //update the user detail
    public function edit($id = '') {

        if ($this->input->post('testimonialid')) {

            if ($_FILES['clientimage']['name'] != '') {
            
                $testimonial['upload_path'] = $this->config->item('testimonial_main_upload_path');
                $testimonial['allowed_types'] = $this->config->item('testimonial_allowed_types');
                $testimonial['max_size'] = $this->config->item('testimonial_main_max_size');
    //            $testimonial['max_width'] = $this->config->item('testimonial_main_max_width'); add this line for image demension 
    //            $testimonial['max_height'] = $this->config->item('testimonial_main_max_height');



                $this->load->library('upload');
                $this->upload->initialize($testimonial);
                //Uploading Image
                $this->upload->do_upload('clientimage');
                //Getting Uploaded Image File Data
                $imgdata = $this->upload->data();
                $imgerror = $this->upload->display_errors();

                if ($imgerror == '') {
                    //Configuring Thumbnail 
                    $testimonial_thumb['image_library'] = 'gd2';
                    $testimonial_thumb['source_image'] = $testimonial['upload_path'] . $imgdata['file_name'];
                    $testimonial_thumb['new_image'] = $this->config->item('testimonial_thumb_upload_path') . $imgdata['file_name'];
                    $testimonial_thumb['create_thumb'] = TRUE;
                    $testimonial_thumb['maintain_ratio'] = FALSE;
                    $testimonial_thumb['thumb_marker'] = '';
                    $testimonial_thumb['width'] = $this->config->item('testimonial_thumb_width');
                    $testimonial_thumb['height'] = $this->config->item('testimonial_thumb_height');

                    //Loading Image Library
                    $this->load->library('image_lib', $testimonial_thumb);
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
                    $redirect_url = site_url('testimonial');
                    redirect($redirect_url, 'refresh');
                } else {
                    $testimonial_image = $imgdata['file_name'];
                    
                    $main_path=$this->config->item('testimonial_main_upload_path').$this->input->post('oldclientimage');
                    $thumb_path=$this->config->item('testimonial_thumb_upload_path').$this->input->post('oldclientimage');

                  
                    if(file_exists($main_path) && $this->input->post('oldclientimage') != '' ){
                        unlink($main_path);
                    }
                    if(file_exists($thumb_path) && $this->input->post('oldclientimage') != '' ){
                        unlink($thumb_path);
                    }
                }
            } else {
                $testimonial_image = $this->input->post('oldclientimage');
            }



            $update_array = array(
                'clientname' =>trim($this->input->post('clientname')),
                'clientimage' => $testimonial_image,
                'clientprofession' => trim($this->input->post('clientprofession')),       
                'testimonialtext' => trim($this->input->post('text')),
                'editip' => getHostByName(getHostName()),
                'editdatetime' => date('Y-m-d H:i:s'),
            );

            $update_result = $this->common->update_data($update_array, 'testimonial', 'testimonialid', $this->input->post('testimonialid'));





            if ($this->input->post('redirect_url')) {
                $redirect_url = $this->input->post('redirect_url');
            } else {
                $redirect_url = site_url('testimonial');
            }

            if ($update_result) {

                $this->session->set_flashdata('success', 'Testimonial successfully updated.');
                redirect($redirect_url, 'refresh');
            } else {
                $this->session->set_flashdata('error', 'Errorin Occurred. Try Again!');
                redirect($redirect_url, 'refresh');
            }
        }

        $testimonial_detail = $this->common->select_data_by_id('testimonial', 'testimonialid', $id, '*');
        if (!empty($testimonial_detail)) {
            $this->data['module_name'] = 'Testimonial';
            $this->data['section_title'] = 'Edit';
            $this->data['testimonial_detail'] = $testimonial_detail;
            $this->load->view('testimonial/edit', $this->data);
        } else {
            $this->session->set_flashdata('error', 'Errorout Occurred. Try Again.');
            redirect('testimonial', 'refresh');
        }
    }

    public function change_status($user_id = '', $status = '') {
        if ($user_id == '' || $status == '') {
            $this->session->set_flashdata('error', 'Error Occurred. Try Agaim!');
            redirect('testimonial', 'refresh');
        }
        if ($status == 'Enable') {
            $status = "Disable";
        } else {
            $status = 'Enable';
        }


        $update_data = array('status' => $status);
        
        $update_result = $this->common->update_data($update_data, 'testimonial', 'testimonialid', $user_id);
        if (isset($_SERVER['HTTP_REFERER'])) {
            $redirect_url = $_SERVER['HTTP_REFERER'];
        } else {
            $redirect_url = site_url() . 'testimonial';
        }
        if ($update_result) {
            $this->session->set_flashdata('success', 'Testimonial status successfully changed');
            redirect($redirect_url, 'refresh');
        } else {
            $this->session->set_flashdata('error', 'Error Occurred. Try Again!');
            redirect($redirect_url, 'refresh');
        }
    }

    public function delete($id = '') {
        $update_array = array('is_delete' => '1', 'editdatetime' => date('Y-m-d H:i:s'), 'editip' => getHostByName(getHostName()));
        $delete_result = $this->common->update_data($update_array, 'testimonial', 'testimonialid', $id);
        //$delete_result = $this->common->delete_data( 'testimonial', 'id', $id);

        if (isset($_SERVER['HTTP_REFERER'])) {
            $redirect_url = $_SERVER['HTTP_REFERER'];
        } else {
            $redirect_url = site_url('testimonial');
        }

        if ($delete_result) {

            $this->session->set_flashdata('success', 'Testimonial successfully deleted.');
            redirect($redirect_url, 'refresh');
        } else {
            $this->session->set_flashdata('error', 'Error Occurred. Try Again!');
            redirect($redirect_url, 'refresh');
        }
    }

    public function mdelete($id = '') {
        foreach ($this->input->post('deletes') as $delete) {
            $update_array = array('is_delete' => '1', 'editdatetime' => date('Y-m-d H:i:s'), 'editip' => getHostByName(getHostName()));
            $delete_result = $this->common->update_data($update_array, 'testimonial', 'testimonialid', $delete);
        }

        if (isset($_SERVER['HTTP_REFERER'])) {
            $redirect_url = site_url('testimonial');
//            $redirect_url = $_SERVER['HTTP_REFERER'];
//            echo $redirect_url;
//            die();
        } else {
            $redirect_url = site_url('testimonial');
        }

        if ($delete_result) {

            $this->session->set_flashdata('success', 'testimonials successfully deleted.');
            redirect($redirect_url, 'refresh');
        } else {
            $this->session->set_flashdata('error', 'Error Occurred. Try Again!');
            redirect($redirect_url, 'refresh');
        }
    }

    //change status






    public function clear_search() {
        $this->session->unset_userdata('user_search_keyword');
        redirect('testimonial', 'refresh');
    }

    public function sub_cat() {
        $str = '';
        if ($this->input->is_ajax_request() && $this->input->post('id')) {
            $id = $this->input->post('id');
            $cat_id = $this->input->post('sel_id');
            $contition_array = array('is_deleted != ' => '1', 'parent_id' => $id);
            $arrays = $this->common->select_data_by_condition('testimonial', $contition_array, '*', 'testimonial_title', 'asc');

            if (count($arrays)) {
                $str.="<option value='0'>select sub </option>";
                foreach ($arrays as $cat) {
                    //$str='';
                    $str.= "<option value='" . $cat['testimonialid'] . "'";
                    if ($cat_id == $cat['testimonialid']) {
                        $str.="selected='selected'";
                    }

                    $str.=">" . $cat['testimonial_title'] . "</option>";
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