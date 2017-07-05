<?php



if (!defined('BASEPATH'))

    exit('No direct script access allowed');



class User_management extends CI_Controller {



    public $data;



    public function __construct() {

        parent::__construct();





        // Get Site Information

        $site_settings = $this->common->select_data_by_id('site_settings', 'site_id', 1, $data = '*', $join_str = array());





        $main_site_name = $this->data['main_site_name'] = $site_settings[0]['site_name'];

        $main_site_email = $this->data['main_site_email'] = $site_settings[0]['site_email'];

        $main_site_url = $this->data['main_site_url'] = $site_settings[0]['site_url'];



        $this->data['title'] = "User Management | $main_site_name ";

        $this->data['module_name'] = "User Management";

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

        $this->data['section_title'] = "User Management List";





        $limit = $this->paging['per_page'];



        if ($this->uri->segment(3) != '' && $this->uri->segment(4) != '') {

            $offset = ($this->uri->segment(5) != '') ? $this->uri->segment(5) : 0;

            $short_by = $this->uri->segment(3);

            $order_by = $this->uri->segment(4);

        } else {

            $offset = ($this->uri->segment(3) != '') ? $this->uri->segment(3) : 0;

            $short_by = 'user_id';

            $order_by = 'asc';

        }



        $this->data['offset'] = $offset;



        $condition_array = array('is_delete' => '0');

        

        $this->data['user_list'] = $get_users = $this->common->select_data_by_condition('user', $condition_array, $data = '*', $short_by, $order_by, $limit, $offset, $join_str = array());



        if ($this->uri->segment(3) != '' && $this->uri->segment(4) != '') {

            $this->paging['base_url'] = site_url("user_management/index/" . $short_by . "/" . $order_by);

        } else {

            $this->paging['base_url'] = site_url("user_management/index/");

        }

        if ($this->uri->segment(3) != '' && $this->uri->segment(4) != '') {

            $this->paging['uri_segment'] = 5;

        } else {

            $this->paging['uri_segment'] = 3;

        }



        $contition_array1 = array('user.status !=' => '0');



        $this->paging['total_rows'] = count($this->common->select_data_by_condition('user', $contition_array1, 'user_id'));

        $this->data['total_rows'] = $this->paging['total_rows'];

        $this->data['limit'] = $limit;



        //$this->paging['per_page'] = 2;



        $this->pagination->initialize($this->paging);

        $this->data['search_keyword'] = '';

        $this->load->view('user_management/index', $this->data);

    }




    // search the user

    public function search() {

        $this->data['section_title'] = "User Management List";

        //query for difficulty 



        if ($this->input->post('search_keyword')) {



         $this->data['search_keyword'] = $search_keyword = $this->input->post('search_keyword');

            echo "$search_keyword";

            $this->session->set_userdata('user_search_keyword', $search_keyword);

            $limit = $this->paging['per_page'];

            if ($this->uri->segment(3) != '' && $this->uri->segment(4) != '') {

                $offset = ($this->uri->segment(5) != '') ? $this->uri->segment(5) : 0;

                $short_by = $this->uri->segment(3);

                $order_by = $this->uri->segment(4);

            } else {

                $offset = ($this->uri->segment(3) != '') ? $this->uri->segment(3) : 0;

                $short_by = 'user_id';

                $order_by = 'asc';

            }

            $this->data['offset'] = $offset;

            //prepare search condition

            $search_condition = "(first_name LIKE '%$search_keyword%' OR last_name LIKE '%$search_keyword%' )";

            echo $search_condition;



            $contition_array = array('user.status !=' => '0');

            $this->data['user_list'] = $this->common->select_data_by_search('user', $search_condition, $contition_array, '*', $short_by, $order_by, $limit, $offset);
            print_r('user_list');



            if ($this->uri->segment(3) != '' && $this->uri->segment(4) != '') {

                $this->paging['base_url'] = site_url("user_management/search/" . $short_by . "/" . $order_by);

            } else {

                $this->paging['base_url'] = site_url("user_management/search/");

            }



            if ($this->uri->segment(3) != '' && $this->uri->segment(4) != '') {

                $this->paging['uri_segment'] = 5;

            } else {

                $this->paging['uri_segment'] = 3;

            }

            $this->paging['total_rows'] = count($this->common->select_data_by_search('user', $search_condition, $contition_array, 'user_id'));



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

                $short_by = 'user_id';

                $order_by = 'asc';

            }

            $this->data['offset'] = $offset;

            //prepare search condition

            $search_condition = "(user_name LIKE '%$search_keyword%' OR last_name LIKE '%$search_keyword%')";



            $contition_array = array();

            $this->data['user_list'] = $this->common->select_data_by_search('user', $search_condition, $contition_array, '*', $short_by, $order_by, $limit, $offset);



            if ($this->uri->segment(3) != '' && $this->uri->segment(4) != '') {

                $this->paging['base_url'] = site_url("user_management/search/" . $short_by . "/" . $order_by);

            } else {

                $this->paging['base_url'] = site_url("user_management/search/");

            }



            if ($this->uri->segment(3) != '' && $this->uri->segment(4) != '') {

                $this->paging['uri_segment'] = 5;

            } else {

                $this->paging['uri_segment'] = 3;

            }

            $this->paging['total_rows'] = count($this->common->select_data_by_search('user', $search_condition, $contition_array, 'user_id'));



            $this->data['total_rows'] = $this->paging['total_rows'];

            $this->data['limit'] = $limit;



            $this->pagination->initialize($this->paging);

        }

        $this->load->view('user_management/index', $this->data);

    }



    //add new user
 public function add() {
 

        $this->load->view('user_management/add');

    }



    public function add_insert()
    {
        // echo '<pre>'; print_r($_FILES); echo $_FILES['user_image']['name']; $die();

          
       $this->form_validation->set_rules('username', 'User Name is required', 'required');
        $this->form_validation->set_rules('first_name', 'First Name', 'required');
        $this->form_validation->set_rules('last_name', 'Last Name is required', 'required');
        $this->form_validation->set_rules('user_email', 'User Email', 'required');
        $this->form_validation->set_rules('user_password', 'Password', 'required');
        $this->form_validation->set_rules('dob', 'Date of Birth', 'required');
        $this->form_validation->set_rules('user_image', 'User Image', 'required');
        $this->form_validation->set_rules('user_gender', 'Select your gender', 'required');
        

         
       // echo"hello"; die();
      // echo "<pre>"; print_r($_POST); die();

            if (empty($_FILES['user_image']['name']))
             {
                 $this->form_validation->set_rules('user_image', 'Upload Image', 'required');
                 $user_image = '';
             }

              else {

                    // echo "hello"; die();
                 $config['upload_path'] = '../images/userimage';
                 $config['allowed_types'] = 'jpg|jpeg|png|gif';
                 $config['file_name'] = $_FILES['user_image']['name'];
                //echo  $config['upload_path']; $die();
                
                //Load upload library and initialize configuration
                $this->load->library('upload',$config);
                $this->upload->initialize($config);
                
                if($this->upload->do_upload('user_image'))
                {
                    // echo "hello"; die();
                    $uploadData = $this->upload->data();
                    //$picture = $uploadData['file_name']."-".date("Y_m_d H:i:s");
                    $user_image = $uploadData['file_name'];
                }
                else
                {
                     echo "welcome"; die();
                    $user_image = '';
                }
                // echo $user_image;die();

}

         
        // $rand_password = $this->random_password(8);

         $data1= array(

                 'user_name' => $this->input->post('username'),

                  'first_name' => $this->input->post('first_name'),

                 'last_name' => $this->input->post('last_name'),

                  'user_email' => $this->input->post('user_email'),
                
                 'user_password' => $this->input->post('user_password'),

                 'user_dob' => date("Y-m-d", strtotime($this->input->post('dob'))),

                'user_image' => $user_image,

                 'user_gender' => $this->input->post('user_gender'),

                 'user_agree' => '1',

                 'is_delete' => '0',

                 'status' => '1',

                 'created_date' =>  date('Y-m-d H:i:s'),

                 'modified_date' => date('Y-m-d H:i:s'),

                 'edit_ip' => getHostByName(getHostName()),

                 'user_last_login' => date('Y-m-d H:i:s'),

                 'user_verify' =>'0'
                );

         // print_r($data1);die();

        //  $insert_result = $this->common->insert_data($data1, 'user');
           $insert_id = $this->common->insert_data_getid($data1,'user');
          $this->load->view('user_management/edit', $this->data);
         redirect('user_management', 'refresh');

    }





    public function edit($id) {
 

      //  $this->load->view('user_management/edit');


        $id = base64_decode($id);
        echo $id;

        $this->userdata['user_details'] = $this->common->select_data_by_id('user', 'user_id', $id , '*', $join_str = array());

        print_r($this->userdata);

         $this->load->view('user_management/edit', $this->userdata);


    }


    public function edit_user() {

       // echo "hello"; die();
        $this->data['section_title'] = "Edit User Management";

        $id=$this->input->post('user_id');

        if (empty($_FILES['user_image']['name']))
             {
                 // $this->form_validation->set_rules('page_image', 'Upload Image', 'required');
                 $user_image = $this->input->post('old_image');
             }

              else {

                    // echo "hello"; die();
                 $config['upload_path'] = '../images/userimage';
                 $config['allowed_types'] = 'jpg|jpeg|png|gif';
                 $config['file_name'] = $_FILES['user_image']['name'];
                //echo  $config['upload_path']; $die();
                
                //Load upload library and initialize configuration
                $this->load->library('upload',$config);
                $this->upload->initialize($config);
                
                if($this->upload->do_upload('user_image'))
                {
                    // echo "hello"; die();
                    $uploadData = $this->upload->data();
                    //$picture = $uploadData['file_name']."-".date("Y_m_d H:i:s");
                    $user_image = $uploadData['file_name'];
                }
                else
                
                {
                     // echo "welcome"; die();
                    $user_image = '';
                }

                } 

       // echo $id; die();

 $update_data= array(

                 'user_name' => trim($this->input->post('username')),

                  'first_name' => $this->input->post('first_name'),

                 'last_name' => $this->input->post('last_name'),

                  'user_email' => $this->input->post('user_email'),
                
                 'user_password' => $this->input->post('user_password'),

                 'user_dob' => $this->input->post('dob'),

                 'user_image' => $user_image,

                 'user_gender' => $this->input->post('user_gender'),

                // 'user_agree' => '1',

                 //'is_delete' => '0',

                // 'status' => '1',

                // 'created_date' =>  date('Y-m-d H:i:s'),

                 'modified_date' => date('Y-m-d H:i:s'),

                 'edit_ip' => getHostByName(getHostName()),

                // 'user_last_login' => date('Y-m-d H:i:s'),

                // 'user_verify' =>'0'
                );

   // $id=$this->input->post('user_id');
   // echo $id;

   // print_r($update_data);die();
        
$update_result = $this->common->update_data($update_data, 'user', 'user_id', $this->input->post('user_id'));
// $redirect_url = site_url('admin/user_management');

redirect('user_management', 'refresh');




        // if ($this->input->post('user_id')) {


            // if ($_FILES['user_image']['name'] != '') {



            //     $admin['upload_path'] = $this->config->item('admin_main_upload_path');

            //     $admin['allowed_types'] = $this->config->item('admin_allowed_types');

            //     $admin['max_size'] = $this->config->item('admin_main_max_size');

            //     $admin['max_width'] = $this->config->item('admin_main_max_width');

            //     $admin['max_height'] = $this->config->item('admin_main_max_height');



            //     //    $this->load->library('upload', $admin);



            //     $this->load->library('upload');

            //     $this->upload->initialize($admin);

            //     //Uploading Image

            //     $this->upload->do_upload('user_image');

            //     //Getting Uploaded Image File Data

            //     $imgdata = $this->upload->data();

            //     $imgerror = $this->upload->display_errors();

            //     if ($imgerror == '') {

            //         //Configuring Thumbnail 

            //         $admin_thumb['image_library'] = 'gd2';

            //         $admin_thumb['source_image'] = $admin['upload_path'] . $imgdata['file_name'];

            //         $admin_thumb['new_image'] = $this->config->item('admin_thumb_upload_path') . $imgdata['file_name'];

            //         $admin_thumb['create_thumb'] = TRUE;

            //         $admin_thumb['maintain_ratio'] = FALSE;

            //         $admin_thumb['thumb_marker'] = '';

            //         $admin_thumb['width'] = $this->config->item('admin_thumb_width');

            //         $admin_thumb['height'] = $this->config->item('admin_thumb_height');



            //         //Loading Image Library

            //         $this->load->library('image_lib', $admin_thumb);

            //         $dataimage = $imgdata['file_name'];

            //         //Creating Thumbnail

            //         $this->image_lib->resize();

            //         $thumberror = $this->image_lib->display_errors();

            //     } else {

            //         $thumberror = '';

            //     }



            //     if ($imgerror != '' || $thumberror != '') {

            //         $error[0] = $imgerror;

            //         $error[1] = $thumberror;

            //     } else {

            //         $error = array();

            //     }



            //     if ($error) {

            //         $this->session->set_flashdata('error', $error[0]);

            //         $redirect_url = site_url('admin/user_management');

            //         redirect($redirect_url, 'refresh');

            //     } else {

            //         $admin = $imgdata['file_name'];

            //     }



            //     $old_image = $this->input->post('old_image');

            //     $old_image_path = $this->config->item('admin_main_upload_path') . $old_image;

            //     $old_image_thumb_path = $this->config->item('admin_thumb_upload_path') . $old_image;



            //     if (file_exists($old_image_path)) {

            //         unlink($old_image_path);

            //     }

            //     if (file_exists($old_image_thumb_path)) {

            //         unlink($old_image_thumb_path);

            //     }

            // } else {

            //     $admin = $this->input->post('old_image');

            // }

          //  $user_details = $this->common->select_data_by_id('user', 'user_id', $this->input->post('user_id'), '*', $join_str = array());



          //  $this->data['user_email'] = $user_details[0]['user_email'];


        // }

        

        // $id = base64_decode($id);

        

        // $this->data['section_title'] = "Edit User Management";

        // $user_detail = $this->common->select_data_by_id('user', 'user_id', $id, '*', $join_str = array());

        

        // $this->data['admin_id'] = $user_detail[0]['admin_id'];

        // $this->data['user_name'] = $user_detail[0]['user_name'];

        // $this->data['first_name'] = $user_detail[0]['first_name'];

        // $this->data['user_email'] = $user_detail[0]['user_email'];

        // $this->data['user_image'] = $user_detail[0]['user_image'];



        // $this->load->view('user_management/edit', $this->data);

    }




    public function change_status($user_id = '', $status = '') {

        echo "hello";

        if ($user_id != '' && $status != '') {

            $data = array('status' => $status);

            $update_status = $this->common->update_data($data, 'user', 'user_id', $user_id);



            if ($update_status) {

                $this->session->set_flashdata('success', 'User Status Successfully Changed.');

                redirect('user_management', 'refresh');

            }

        }

    }



    public function delete($user_id = '') {  
        // echo "hello"; die();

        if ($user_id != '') {

            $user_id = base64_decode($user_id);
           // echo $user_id;

            $data = array('is_delete' => '1');
            

            $update_status = $this->common->update_data($data, 'user', 'user_id', $user_id);
        
               // echo  $update_status; die();


            if ($update_status) {

                $this->session->set_flashdata('success', 'User Successfully Delete.');

              redirect('user_management', 'refresh');

            }

        }

    }



//     public function check_email() {

//         if ($this->input->is_ajax_request() && $this->input->post('admin_email')) {



//             $email = $this->input->post('admin_email');

//             $condition_array = array('admin_status !=' => '3');

//             if ($this->input->post('admin_id')) {

//                 $id = $this->input->post('admin_id');

//                 $check_result = $this->common->check_unique_avalibility('admin', 'admin_email', $email, 'admin_id', $id, $condition_array);

//             } else {

//                 $check_result = $this->common->check_unique_avalibility('admin', 'admin_email', $email, '', '', $condition_array);

//             }



//             if ($check_result) {

//                 echo 'true';

//                 die();

//             } else {

//                 echo 'false';

//                 die();

//             }

//         }

//     }



    public function clear_search() {

        $this->session->unset_userdata('user_search_keyword');

        redirect('user_management', 'refresh');

    }



}



/* End of file welcome.php */

/* Location: ./application/controllers/welcome.php */