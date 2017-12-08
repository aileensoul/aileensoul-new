<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Blog extends CI_Controller {

    public function __construct() {
        parent::__construct();
        //AWS access info start
        $this->load->library('S3');
        //AWS access info end
        include ('include.php');
        $this->config->load('paging', TRUE);
        $this->paging = $this->config->item('paging');
    }

    //MAIN INDEX PAGE START   
    public function index($slug = '') {
        $second_segment = $this->uri->segment('2');
        if ($slug != '' && $second_segment != 'page') {

            $this->blog_check($slug);

            //FOR GETTING ALL DATA
            $condition_array = array('status' => 'publish');
            $this->data['blog_all'] = $this->common->select_data_by_condition('blog', $condition_array, $data = '*', $short_by = 'id', $order_by = 'desc', $limit, $offset, $join_str = array());

            //FOR GETTING BLOG
            $condition_array = array('status' => 'publish', 'blog_slug' => $slug);
            $this->data['blog_detail'] = $this->common->select_data_by_condition('blog', $condition_array, $data = '*', $short_by = 'id', $order_by = 'desc', $limit, $offset, $join_str = array());

            //FOR GETTING 5 LAST DATA
            $condition_array = array('status' => 'publish');
            $this->data['blog_last'] = $this->common->select_data_by_condition('blog', $condition_array, $data = '*', $short_by = 'id', $order_by = 'desc', $limit = 5, $offset, $join_str = array());


            $this->load->view('blog/blogdetail', $this->data);
        } else {
            //THIS IF IS USED FOR WHILE SEARCH FOR RETRIEVE SAME PAGE START
            if ($this->input->get('q')) {

                $this->data['search_keyword'] = $search_keyword = trim($this->input->get('q'));


                $search_condition = "(title LIKE '%$search_keyword%' OR   description LIKE '%$search_keyword%')";
                $contition_array = array('status' => 'publish');
                $this->data['blog_detail'] = $this->common->select_data_by_search('blog', $search_condition, $contition_array, $data = '*', $sortby = 'id', $orderby = 'desc', $limit, $offset);
            }
            //THIS IF IS USED FOR WHILE SEARCH FOR RETRIEVE SAME PAGE END
            //FOR GETTING ALL DATA START
            else {

                $this->data['limit'] = $limit = $this->paging['per_page'];
                $this->paging["cur_page"] = $page;
                if ($this->uri->segment(3) != '' && $this->uri->segment(4) != '') {
                    $offset = ($this->uri->segment(5) != '') ? $this->uri->segment(5) : 0;
                    $sortby = $this->uri->segment(3);
                    $orderby = $this->uri->segment(4);
                } else {
                    $offset = ($this->uri->segment(3) != '') ? $this->uri->segment(3) : 0;
                    $sortby = 'id';
                    $orderby = 'desc';
                }
                $this->data['offset'] = $offset;

                $data = '*';
                $contition_array = array('status' => 'publish');
                $this->data['blog_detail'] = $this->common->select_data_by_condition('blog', $contition_array, $data, $sortby, $orderby, $limit, $offset, $join_str = array(), $groupby = '');


                if ($this->uri->segment(3) != '' && $this->uri->segment(4) != '') {

                    $this->paging['base_url'] = site_url("blog/page/" . $short_by . "/" . $order_by);
                } else {

                    $this->paging['base_url'] = site_url("blog/page/");
                }

                if ($this->uri->segment(3) != '' && $this->uri->segment(4) != '') {

                    $this->paging['uri_segment'] = 5;
                } else {

                    $this->paging['uri_segment'] = 3;
                }
                //This if and else use for asc and desc while click on any field End
                
                $data = 'count(*) as total';
                $contition_array = array('status' => 'publish');
                $blog_count = $this->common->select_data_by_condition('blog', $contition_array, $data, $sortby, $orderby, $limit='', $offset='', $join_str = array(), $groupby = '');
                $this->paging['total_rows'] = $this->data['total_rows'] = $blog_count[0]['total'];
                $this->pagination->initialize($this->paging);
            }
            //FOR GETTING ALL DATA START
            //FOR GETTING 5 LAST DATA
            $condition_array = array('status' => 'publish');
            $this->data['blog_last'] = $this->common->select_data_by_condition('blog', $condition_array, $data = '*', $short_by = 'id', $order_by = 'desc', $limit = 5, $offset, $join_str = array());

            $this->load->view('blog/index', $this->data);
        }
    }

    //MAIN INDEX PAGE END   
    //READ MORE CLICK START
    public function popular() {

        $join_str[0]['table'] = 'blog';
        $join_str[0]['join_table_id'] = 'blog.id';
        $join_str[0]['from_table_id'] = 'blog_visit.blog_id';
        $join_str[0]['join_type'] = '';

        $condition_array = array('blog.status' => 'publish');
        $data = "blog.* ,count(blog_id) as count";
        $this->data['blog_detail'] = $this->common->select_data_by_condition('blog_visit', $condition_array, $data, $short_by = 'count', $order_by = 'desc', $limit, $offset, $join_str, $groupby = 'blog_visit.blog_id');

        //FOR GETTING 5 LAST DATA
        $condition_array = array('status' => 'publish');
        $this->data['blog_last'] = $this->common->select_data_by_condition('blog', $condition_array, $data = '*', $short_by = 'id', $order_by = 'desc', $limit = 5, $offset, $join_str = array());

        $this->load->view('blog/index', $this->data);
    }

    //READ MORE CLICK START
    public function read_more() {

        $id = $_POST['blog_id'];

        //FOR INSERT READ MORE BLOG START
        $data = array(
            'blog_id' => $id,
            'visiter_date' => date('Y-m-d H:i:s')
        );
        $insert_id = $this->common->insert_data_getid($data, 'blog_visit');

        //FOR INSERT READ MORE BLOG END

        if ($insert_id) {
            echo 1;
        } else {
            echo 0;
        }
    }

    //READ MORE CLICK END
    //BLOGDETAIL FOR PERICULAR ONE POST START
    public function blogdetail($slug = '') {
        //FOR GETTING ALL DATA
        $condition_array = array('status' => 'publish');
        $this->data['blog_all'] = $this->common->select_data_by_condition('blog', $condition_array, $data = '*', $short_by = 'id', $order_by = 'desc', $limit, $offset, $join_str = array());

        //FOR GETTING BLOG
        $condition_array = array('status' => 'publish', 'blog_slug' => $slug);
        $this->data['blog_detail'] = $this->common->select_data_by_condition('blog', $condition_array, $data = '*', $short_by = 'id', $order_by = 'desc', $limit, $offset, $join_str = array());

        //FOR GETTING 5 LAST DATA
        $condition_array = array('status' => 'publish');
        $this->data['blog_last'] = $this->common->select_data_by_condition('blog', $condition_array, $data = '*', $short_by = 'id', $order_by = 'desc', $limit = 5, $offset, $join_str = array());


        $this->load->view('blog/blogdetail', $this->data);
    }

    //BLOGDETAIL FOR PERICULAR ONE POST END
    //COMMENT INSERT BY USER START
    public function comment_insert() {
        $id = $_POST['blog_id'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $message = $_POST['message'];

        //FOR INSERT READ MORE BLOG START
        $data = array(
            'blog_id' => $id,
            'name' => $name,
            'email' => $email,
            'message' => $message,
            'comment_date' => date('Y-m-d H:i:s'),
            'status' => 'pending'
        );

        $insert_id = $this->common->insert_data_getid($data, 'blog_comment');

        //FOR INSERT READ MORE BLOG END

        if ($insert_id) {
            echo 1;
        } else {
            echo 0;
        }
    }

    //COMMENT INSERT BY USER END
//SEARCH BY TAG START
//public function tagsearch($tag='')
//{
//        //FOR SEARCH DATA WITH TAG,DETAIL AND DESCRIPTION IN BLOG TABLE
//         $tag = str_replace("-"," ",$tag);
//      
//        $this->data['search_keyword']=$search_keyword = trim($tag);
//        $search_condition = "(title LIKE '%$search_keyword%' OR   description LIKE '%$search_keyword%' OR  tag LIKE '%$search_keyword%')";
//        $contition_array = array('status' => 'publish');
//        $this->data['blog_detail'] = $this->common->select_data_by_search('blog', $search_condition, $contition_array,$data='*', $sortby='id', $orderby='desc', $limit, $offset);
//
//         //FOR GETTING ALL DATA
//        $condition_array = array('status' => 'publish');
//        $this->data['blog_all']  = $this->common->select_data_by_condition('blog', $condition_array, $data='*', $short_by='id', $order_by='desc', $limit, $offset, $join_str = array());
//      
//          //FOR GETTING 5 LAST DATA
//          $condition_array = array('status' => 'publish');
//        $this->data['blog_last']  = $this->common->select_data_by_condition('blog', $condition_array, $data='*', $short_by='id', $order_by='desc', $limit=5, $offset, $join_str = array());
//
//          $this->load->view('blog/index',$this->data);
//}
//SEARCH BY TAG END
// blog available check start
    public function blog_check($slug = " ") {

        $condition_array = array('blog_slug' => $slug);
        $availblog = $this->common->select_data_by_condition('blog', $condition_array, $data = '*', $short_by = '', $order_by = '', $limit, $offset, $join_str = array(), $groupby = '');

        if (count($availblog) == NULL) {
            $this->load->view('blog/notavalible');
        }
    }

// blog available check start end
}
