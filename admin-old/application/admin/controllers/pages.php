<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pages extends CI_Controller {

    public $data;

    public function __construct() {
        parent::__construct();

       
        // Get Site Information
        $site_settings = $this->common->select_data_by_id('ailee_site_settings', 'site_id', 1, $data = '*', $join_str = array());


        $main_site_name = $this->data['main_site_name'] = $site_settings[0]['site_name'];
        $main_site_url = $this->data['main_site_url'] = $site_settings[0]['site_url'];

        $this->data['title'] = "pages | $main_site_name ";
        $this->data['module_name'] = "pages";
        include('include.php');

        //Loadin Pagination Custome Config File
        $this->config->load('paging', TRUE);
        $this->paging = $this->config->item('paging');
//        print_r($this->paging);
//        die();
        //remove catch so after logout cannot view last visited page if that page is this
        $this->output->set_header('Last-Modified:' . gmdate('D, d M Y H:i:s') . 'GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
        $this->output->set_header('Cache-Control: post-check=0, pre-check=0', false);
        $this->output->set_header('Pragma: no-cache');
    }

    public function index() {
        $this->data['section_title'] = "Pages List";


        $limit = $this->paging['per_page'];
        
        if ($this->uri->segment(3) != '' && $this->uri->segment(4) != '') {
            $offset = ($this->uri->segment(5) != '') ? $this->uri->segment(5) : 0;
            $short_by = $this->uri->segment(3);
            $order_by = $this->uri->segment(4);
        } else {
            $offset = ($this->uri->segment(3) != '') ? $this->uri->segment(3) : 0;
            $short_by = 'page_id';
            $order_by = 'asc';
        }

        $this->data['offset'] = $offset;
        
        $condition_array = array('page_status !=' => '3');
        $this->data['pages_list'] = $get_pages = $this->common->select_data_by_condition('pages', $condition_array, $data = '*', $short_by, $order_by, $limit, $offset, $join_str = array());

        if ($this->uri->segment(3) != '' && $this->uri->segment(4) != '') {
            $this->paging['base_url'] = site_url("admin/pages/index/" . $short_by . "/" . $order_by);
        } else {
            $this->paging['base_url'] = site_url("admin/pages/index/");
        }
        if ($this->uri->segment(3) != '' && $this->uri->segment(4) != '') {
            $this->paging['uri_segment'] = 5;
        } else {
            $this->paging['uri_segment'] = 3;
        }

        $contition_array1=array();

        $this->paging['total_rows'] = count($this->common->select_data_by_condition('pages', $contition_array1, 'page_id'));
        $this->data['total_rows'] = $this->paging['total_rows'];
        $this->data['limit'] = $limit;
     
        //$this->paging['per_page'] = 2;

        $this->pagination->initialize($this->paging);
        $this->data['search_keyword'] = '';
        $this->load->view('pages/index', $this->data);
    }
    
      //search the user
    public function search() {
        $this->data['section_title'] = "Pages List";
        //query for difficulty 

        if ($this->input->post('search_keyword')) {

            $this->data['search_keyword'] = $search_keyword = $this->input->post('search_keyword');

            $this->session->set_userdata('page_search_keyword', $search_keyword);
            $limit = $this->paging['per_page'];
            if ($this->uri->segment(3) != '' && $this->uri->segment(4) != '') {
                $offset = ($this->uri->segment(5) != '') ? $this->uri->segment(5) : 0;
                $short_by = $this->uri->segment(3);
                $order_by = $this->uri->segment(4);
            } else {
                $offset = ($this->uri->segment(3) != '') ? $this->uri->segment(3) : 0;
                $short_by = 'page_id';
                $order_by = 'asc';
            }
            $this->data['offset'] = $offset;
            //prepare search condition
            $search_condition = "(page_name LIKE '%$search_keyword%' OR page_title LIKE '%$search_keyword%' )";

            $contition_array = array();
            $this->data['pages_list'] = $this->common->select_data_by_search('pages', $search_condition, $contition_array, '*', $short_by, $order_by, $limit, $offset);

            if ($this->uri->segment(3) != '' && $this->uri->segment(4) != '') {
                $this->paging['base_url'] = site_url("admin/pages/search/" . $short_by . "/" . $order_by);
            } else {
                $this->paging['base_url'] = site_url("admin/pages/search/");
            }


            if ($this->uri->segment(3) != '' && $this->uri->segment(4) != '') {
                $this->paging['uri_segment'] = 5;
            } else {
                $this->paging['uri_segment'] = 3;
            }
            $this->paging['total_rows'] = count($this->common->select_data_by_search('pages', $search_condition, $contition_array, 'page_id'));

            //for record display
            $this->data['total_rows'] = $this->paging['total_rows'];
            $this->data['limit'] = $limit;


            $this->pagination->initialize($this->paging);
        } else if ($this->session->userdata('page_search_keyword')) {
            $this->data['search_keyword'] = $search_keyword = $this->session->userdata('page_search_keyword');

            $limit = $this->paging['per_page'];
            if ($this->uri->segment(3) != '' && $this->uri->segment(4) != '') {
                $offset = ($this->uri->segment(5) != '') ? $this->uri->segment(5) : 0;
                $short_by = $this->uri->segment(3);
                $order_by = $this->uri->segment(4);
            } else {
                $offset = ($this->uri->segment(3) != '') ? $this->uri->segment(3) : 0;
                $short_by = 'page_id';
                $order_by = 'asc';
            }
            $this->data['offset'] = $offset;
            //prepare search condition
            $search_condition = "(page_name LIKE '%$search_keyword%' OR page_title LIKE '%$search_keyword%')";

            $contition_array = array();
            $this->data['pages_list'] = $this->common->select_data_by_search('pages', $search_condition, $contition_array, '*', $short_by, $order_by, $limit, $offset);

            if ($this->uri->segment(3) != '' && $this->uri->segment(4) != '') {
                $this->paging['base_url'] = site_url("admin/pages/search/" . $short_by . "/" . $order_by);
            } else {
                $this->paging['base_url'] = site_url("admin/pages/search/");
            }


            if ($this->uri->segment(3) != '' && $this->uri->segment(4) != '') {
                $this->paging['uri_segment'] = 5;
            } else {
                $this->paging['uri_segment'] = 3;
            }
            $this->paging['total_rows'] = count($this->common->select_data_by_search('pages', $search_condition, $contition_array, 'page_id'));

            $this->data['total_rows'] = $this->paging['total_rows'];
            $this->data['limit'] = $limit;

            $this->pagination->initialize($this->paging);
        }
        $this->load->view('pages/index', $this->data);
    }

    
    public function edit($id = "") {


        $this->data['section_title'] = "Edit Page";
        $id = base64_decode($id);
        $page_detail = $this->common->select_data_by_id('pages', 'page_id', $id, '*', $join_str = array());

        $this->data['page_id'] = $page_detail[0]['page_id'];
        $this->data['page_name'] = $page_detail[0]['page_name'];
        $this->data['page_title'] = $page_detail[0]['page_title'];
        $this->data['short_description'] = $page_detail[0]['short_description'];
        $this->data['page_description'] = $page_detail[0]['page_description'];
        $this->data['image'] = $page_detail[0]['image'];
        $this->data['seo_title'] = $page_detail[0]['seo_title'];
        $this->data['seo_keywords'] = $page_detail[0]['seo_keywords'];
        $this->data['seo_description'] = $page_detail[0]['seo_description'];

        $this->load->view('pages/edit', $this->data);

            
        }

    public function edit_pages(){
            // echo  "hello"; die();

        if (empty($_FILES['page_image']['name']))
             {
                 // $this->form_validation->set_rules('page_image', 'Upload Image', 'required');
                 $page_image = $this->input->post('old_image');
             }

              else {

                    // echo "hello"; die();
                 $config['upload_path'] = '../uploads/pages';
                 $config['allowed_types'] = 'jpg|jpeg|png|gif';
                 $config['file_name'] = $_FILES['page_image']['name'];
                //echo  $config['upload_path']; $die();
                
                //Load upload library and initialize configuration
                $this->load->library('upload',$config);
                $this->upload->initialize($config);
                
                if($this->upload->do_upload('page_image'))
                {
                    // echo "hello"; die();
                    $uploadData = $this->upload->data();
                    //$picture = $uploadData['file_name']."-".date("Y_m_d H:i:s");
                    $page_image = $uploadData['file_name'];
                }
                else
                
                {
                     // echo "welcome"; die();
                    $page_image = '';
                }

                } 

            $update_array = array(
                'page_name' => trim($this->input->post('page_name')),
                'page_title' => trim($this->input->post('page_title')),
                'short_description' => trim($this->input->post('short_description')),
                'page_description' => trim($this->input->post('page_description')),
                'image' => $page_image,
                'seo_title' => trim($this->input->post('seo_title')),
                'seo_keywords' => trim($this->input->post('seo_keywords')),
                'seo_description' => trim($this->input->post('seo_description')),
                'timestamp' => date('Y-m-d H:i:s'),
                'page_status' => 1
            );

          //   echo $this->input->post('page_id');
          // echo '<pre>';
          //    print_r($update_array);
          //   die();

            $update_result = $this->common->update_data($update_array, 'pages', 'page_id', $this->input->post('page_id'));


            // $redirect_url = site_url('admin/pages');
             redirect('pages', 'refresh');
        
    }
    public function clear_search() {
        $this->session->unset_userdata('page_search_keyword');
        redirect('pages', 'refresh');
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */