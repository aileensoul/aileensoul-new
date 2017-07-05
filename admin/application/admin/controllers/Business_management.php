<?php



if (!defined('BASEPATH'))

    exit('No direct script access allowed');



class Business_management extends CI_Controller {



    public $data;



    public function __construct() {

        parent::__construct();





        // Get Site Information

        $site_settings = $this->common->select_data_by_id('site_settings', 'site_id', 1, $data = '*', $join_str = array());





        $main_site_name = $this->data['main_site_name'] = $site_settings[0]['site_name'];

        $main_site_email = $this->data['main_site_email'] = $site_settings[0]['site_email'];

        $main_site_url = $this->data['main_site_url'] = $site_settings[0]['site_url'];



        $this->data['title'] = "Business  management | $main_site_name ";

        $this->data['module_name'] = "Business management";

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

             // echo "hello"; die();


        $this->data['section_title'] = "Bussiness Management List";





        $limit = $this->paging['per_page'];



        if ($this->uri->segment(3) != '' && $this->uri->segment(4) != '') {

            $offset = ($this->uri->segment(5) != '') ? $this->uri->segment(5) : 0;

            $short_by = $this->uri->segment(3);

            $order_by = $this->uri->segment(4);

        } else {

            $offset = ($this->uri->segment(3) != '') ? $this->uri->segment(3) : 0;

            $short_by = 'business_profile_id';

            $order_by = 'asc';

        }



        $this->data['offset'] = $offset;



        $condition_array = array('is_deleted =' => '0');



        $this->data['business_list'] = $get_users = $this->common->select_data_by_condition('business_profile', $condition_array, $data = '*', $short_by, $order_by, $limit, $offset, $join_str = array());


           // echo "$get_users";

            // print_r( $this->data['business_list']); die();


        if ($this->uri->segment(3) != '' && $this->uri->segment(4) != '') {

            $this->paging['base_url'] = site_url("business_management/index/" . $short_by . "/" . $order_by);

        } else {

            $this->paging['base_url'] = site_url("business_management/index/");

        }

        if ($this->uri->segment(3) != '' && $this->uri->segment(4) != '') {

            $this->paging['uri_segment'] = 5;

        } else {

            $this->paging['uri_segment'] = 3;

        }



        $contition_array1 = array('is_deleted =' => '0');



        $this->paging['total_rows'] = count($this->common->select_data_by_condition('business_profile', $contition_array1, 'business_profile_id'));

        $this->data['total_rows'] = $this->paging['total_rows'];

        $this->data['limit'] = $limit;



        //$this->paging['per_page'] = 2;



        $this->pagination->initialize($this->paging);

        $this->data['search_keyword'] = '';

        $this->load->view('business_management/index', $this->data);

    }

    public function add(){

        $this->data['section_title'] = "ADD Business";
       

        $contition_array = array('status' => 1);
          $this->data['countries'] =  $this->common->select_data_by_condition('countries', $contition_array, $data = '*', $sortby = 'country_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = ''); 
             //$this->load->view('business_profile/business_info', $this->data);
        //echo "<pre>"; print_r($this->data['countries']);die();


        $condition_array1 = array('status =' => '1', 'is_delete =' => '0');


        $this->data['user_list'] = $get_users = $this->common->select_data_by_condition('user', $condition_array1, $data = '*', $short_by, $order_by, $limit, $offset, $join_str = array());


      // echo "<pre>";  print_r($this->data['user_list']);die();

        $this->load->view('business_management/add',$this->data);
        
    }

public function ajax_data() { 
      
       if(isset($_POST["country_id"]) && !empty($_POST["country_id"])){ 
        //Get all state data
         $contition_array = array('country_id' => $_POST["country_id"] , 'status' => 1);
        $state =  $this->data['states'] =  $this->common->select_data_by_condition('states', $contition_array, $data = '*', $sortby = 'state_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');
   
    //Count total number of rows
   
    
    //Display states list
    if(count($state) > 0){
        echo '<option value="">Select state</option>';
     foreach($state as $st){
            echo '<option value="'.$st['state_id'].'">'.$st['state_name'].'</option>';
     
        }
    }else{
        echo '<option value="">State not available</option>';
    }
}

if(isset($_POST["state_id"]) && !empty($_POST["state_id"])){
    //Get all city data
     $contition_array = array('state_id' => $_POST["state_id"] , 'status' => 1);
     $city =  $this->data['city'] =  $this->common->select_data_by_condition('cities', $contition_array, $data = '*', $sortby = 'city_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');
    
    
    //Display cities list
        if(count($city) > 0){
            echo '<option value="">Select city</option>';
            foreach($city as $cit){
                echo '<option value="'.$cit['city_id'].'">'.$cit['city_name'].'</option>';
            }
        }else{
            echo '<option value="">City not available</option>';
        }
        }
    }
    

    public function add_business()
    {
        // echo "hello"; die();

        $this->form_validation->set_rules('company_name', 'Company Name is required', 'required');
        $this->form_validation->set_rules('country', 'Select country', 'required');
        $this->form_validation->set_rules('pincode', 'Pincode is required', 'required');
        $this->form_validation->set_rules('company_address', ' Company Address', 'required');
        $this->form_validation->set_rules('contact_person', ' conatct Person', 'required');
        $this->form_validation->set_rules('contact_mobile', 'Contact Mobile', 'required');
        $this->form_validation->set_rules('contact_email', 'Contact Email', 'required');
        $this->form_validation->set_rules('business_type', 'Business Type', 'required');
        $this->form_validation->set_rules('Industriyal', 'Industrial', 'required');
        $this->form_validation->set_rules('sub_industrial', 'sub_industrial', 'required');
        $this->form_validation->set_rules('business_detail', 'business_detail', 'required');
        $this->form_validation->set_rules('add_more', 'ADD aditional detail', 'required');
        $this->form_validation->set_rules('business_image', 'Image is required', 'required');
        
        $condition_array = array('user_id' =>$this->input->post('user_name') );

             // print_r($condition_array);die();

        $this->data['user'] = $get_users = $this->common->select_data_by_condition('business_profile', $condition_array, $data = '*', $short_by, $order_by, $limit, $offset, $join_str = array());

           // echo "<pre>"; print_r($this->data['user']);die();

        if($get_users){

            echo "User already Exists as Business"; 
        }
        else{

             if (empty($_FILES['business_image']['name']))
             {
                 $this->form_validation->set_rules('business_image', 'Upload Image', 'required');
                 $business_image = '';
             }

              else {

                    // echo "hello"; die();
                 $config['upload_path'] = '../images/business_image';
                 $config['allowed_types'] = 'jpg|jpeg|png|gif';
                 $config['file_name'] = $_FILES['business_image']['name'];
                //echo  $config['upload_path']; $die();
                
                //Load upload library and initialize configuration
                $this->load->library('upload',$config);
                $this->upload->initialize($config);
                
                if($this->upload->do_upload('business_image'))
                {
                    // echo "hello"; die();
                    $uploadData = $this->upload->data();
                    //$picture = $uploadData['file_name']."-".date("Y_m_d H:i:s");
                    $business_image = $uploadData['file_name'];
                }
                else
                {
                     // echo "welcome"; die();
                    $business_image = '';
                }
                // echo $user_image;die();

}

$insert_business = array(
            'company_name' => $this->input->post('company_name'),
            'country' => $this->input->post('country'),
            'state' => $this->input->post('state'),
            'city' => $this->input->post('city'),
            'pincode' => $this->input->post('pincode'),
            'address' => $this->input->post('company_address'),
            'contact_person' => $this->input->post('contact_person'),
            'contact_mobile' => $this->input->post('contact_mobile'),
            'contact_email' => $this->input->post('contact_email'),
            'contact_website' => $this->input->post('contact_website'),
            'business_type' => $this->input->post('business_type'),
            'industriyal' => $this->input->post('Industriyal'),
            'subindustriyal' => $this->input->post('sub_industrial'),
            'details' => $this->input->post('business_detail'),
            'business_profile_image' => $business_image,
            'addmore'=>$this->input->post('add_more'),
            'status'=>'1',
            'is_deleted'=>'0',
            'created_date'=>date('Y-m-d H:i:s'),
            'modified_date'=>date('Y-m-d H:i:s'),
            // 're_step' =>'3',
            'user_id' =>$this->input->post('user_name')
            );

        // print_r($insert_business);die();

        $insert_id = $this->common->insert_data_getid($insert_business ,'business_profile');
         redirect('business_management', 'refresh');
     }
    }

    public function edit($id='')
    {
        // echo "hello"; die();
         $this->data['section_title'] = "Edit Business Management";

         $contition_array = array('status' => 1);
         
        $this->data['countries'] =  $this->common->select_data_by_condition('countries', $contition_array, $data = '*', $sortby = 'country_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        $contition_array = array('status' => 1);
        $this->data['states'] =  $this->common->select_data_by_condition('states', $contition_array, $data = '*', $sortby = 'state_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        $contition_array = array('status' => 1);
     $city =  $this->data['city'] =  $this->common->select_data_by_condition('cities', $contition_array, $data = '*', $sortby = 'city_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');
   

        // echo $id;die();
        $id = base64_decode($id);


        $condition_array = array('business_profile_id = '=> $id);

        $this->data['business'] = $get_users = $this->common->select_data_by_condition('business_profile', $condition_array, $data = '*', $short_by, $order_by, $limit, $offset, $join_str = array());

          // print_r($this->data['business']); die();

        $this->load->view('business_management/edit',$this->data);

    }

    public function edit_business()
    {
         // echo "hello";die();

         $id=$this->input->post('business_profile_id');

         // echo $id;die();
         if (empty($_FILES['business_image']['name']))
             {
                 // $this->form_validation->set_rules('page_image', 'Upload Image', 'required');
                 $business_image = $this->input->post('old_image');
             }

              else {

                    // echo "hello"; die();
                 $config['upload_path'] = '../images/userimage';
                 $config['allowed_types'] = 'jpg|jpeg|png|gif';
                 $config['file_name'] = $_FILES['business_image']['name'];
                //echo  $config['upload_path']; $die();
                
                //Load upload library and initialize configuration
                $this->load->library('upload',$config);
                $this->upload->initialize($config);
                
                if($this->upload->do_upload('business_image'))
                {
                    // echo "hello"; die();
                    $uploadData = $this->upload->data();
                    //$picture = $uploadData['file_name']."-".date("Y_m_d H:i:s");
                    $business_image = $uploadData['file_name'];
                }
                else
                
                {
                     // echo "welcome"; die();
                    $business_image = '';
                }

                }

        $update_data= array(

           'company_name' => $this->input->post('company_name'),
            'country' => $this->input->post('country'),
            'state' => $this->input->post('state'),
            'city' => $this->input->post('city'),
            'pincode' => $this->input->post('pincode'),
            'address' => $this->input->post('company_address'),
            'contact_person' => $this->input->post('contact_person'),
            'contact_mobile' => $this->input->post('contact_mobile'),
            'contact_email' => $this->input->post('contact_email'),
            'contact_website' => $this->input->post('contact_website'),
            'business_type' => $this->input->post('business_type'),
            'industriyal' => $this->input->post('Industriyal'),
            'subindustriyal' => $this->input->post('sub_industrial'),
            'details' => $this->input->post('business_detail'),
            'business_profile_image' => $business_image,
            'addmore'=>$this->input->post('add_more'),
            'status'=>'1',
            'is_deleted'=>'0',
            'created_date'=>date('Y-m-d H:i:s'),
            'modified_date'=>date('Y-m-d H:i:s'),
            // 're_step' =>'3',
            'user_id' =>$this->input->post('user_name')

            );
        $update_result = $this->common->update_data($update_data,'business_profile', 'business_profile_id', $this->input->post('business_profile_id'));
        redirect('business_management', 'refresh');

    }    


    
public function show()
{
     //echo "hellcfo"; die();
     $this->data['section_title'] = "Business Detail";


      $id = base64_decode($id);

        // echo $id;die();

        $condition_array = array('business_profile_id = '=> $id);

        $this->data['business'] = $get_users = $this->common->select_data_by_condition('business_profile', $condition_array, $data = '*', $short_by, $order_by, $limit, $offset, $join_str = array());


         // print_r($this->data['recruiter']); die();

        // $this->load->view('recruiter_management/edit',$this->data);

    $this->load->view('business_management/show',$this->data);

}  




    //search the user

    public function search() {

        $this->data['section_title'] = "User Management List";

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

                $short_by = 'business_profile_id';

                $order_by = 'asc';

            }

            $this->data['offset'] = $offset;

            //prepare search condition

            $search_condition = "(company_name LIKE '%$search_keyword%')";



            $contition_array = array('status =' => '1', 'is_deleted =' => '0');

            $this->data['business_list'] = $this->common->select_data_by_search('business_profile', $search_condition, $contition_array, '*', $short_by, $order_by, $limit, $offset);



            if ($this->uri->segment(3) != '' && $this->uri->segment(4) != '') {

                $this->paging['base_url'] = site_url("business_management/search/" . $short_by . "/" . $order_by);

            } else {

                $this->paging['base_url'] = site_url("business_management/search/");

            }



            if ($this->uri->segment(3) != '' && $this->uri->segment(4) != '') {

                $this->paging['uri_segment'] = 5;

            } else {

                $this->paging['uri_segment'] = 3;

            }

            $this->paging['total_rows'] = count($this->common->select_data_by_search('business_profile', $search_condition, $contition_array, 'business_profile_id'));



            //for record display

            $this->data['total_rows'] = $this->paging['total_rows'];

            $this->data['limit'] = $limit;





            $this->pagination->initialize($this->paging);

        } else if ($this->session->userdata('admin_search_keyword')) {

            $this->data['search_keyword'] = $search_keyword = $this->session->userdata('admin_search_keyword');



            $limit = $this->paging['per_page'];

            if ($this->uri->segment(3) != '' && $this->uri->segment(4) != '') {

                $offset = ($this->uri->segment(5) != '') ? $this->uri->segment(5) : 0;

                $short_by = $this->uri->segment(3);

                $order_by = $this->uri->segment(4);

            } else {

                $offset = ($this->uri->segment(3) != '') ? $this->uri->segment(3) : 0;

                $short_by = 'business_profile_id';

                $order_by = 'asc';

            }

            $this->data['offset'] = $offset;

            //prepare search condition

            $search_condition = "(company_name LIKE '%$search_keyword%')";



            $contition_array = array();

            $this->data['business_list'] = $this->common->select_data_by_search('business_profile', $search_condition, $contition_array, '*', $short_by, $order_by, $limit, $offset);



            if ($this->uri->segment(3) != '' && $this->uri->segment(4) != '') {

                $this->paging['base_url'] = site_url("business_management/search/" . $short_by . "/" . $order_by);

            } else {

                $this->paging['base_url'] = site_url("business_management/search/");

            }



            if ($this->uri->segment(3) != '' && $this->uri->segment(4) != '') {

                $this->paging['uri_segment'] = 5;

            } else {

                $this->paging['uri_segment'] = 3;

            }

            $this->paging['total_rows'] = count($this->common->select_data_by_search('business_profile', $search_condition, $contition_array, 'business_profile_id'));



            $this->data['total_rows'] = $this->paging['total_rows'];

            $this->data['limit'] = $limit;



            $this->pagination->initialize($this->paging);

        }

        $this->load->view('business_management/index', $this->data);

    }



    //add new user

//     public function add($id = '') {



//         $this->data['section_title'] = "Add User";

//         //check post and save data

//         if ($this->input->post('admin_name')) {



//             $admin['upload_path'] = $this->config->item('admin_main_upload_path');

//             $admin['allowed_types'] = $this->config->item('admin_allowed_types');

//             $admin['max_size'] = $this->config->item('admin_main_max_size');

//             $admin['max_width'] = $this->config->item('admin_main_max_width');

//             $admin['max_height'] = $this->config->item('admin_main_max_height');



//             $this->load->library('upload');

//             $this->upload->initialize($admin);

//             //Uploading Image

//             $this->upload->do_upload('admin_image');

//             //Getting Uploaded Image File Data

//             $imgdata = $this->upload->data();

//             $imgerror = $this->upload->display_errors();

//             if ($imgerror == '') {

//                 //Configuring Thumbnail 

//                 $admin_thumb['image_library'] = 'gd2';

//                 $admin_thumb['source_image'] = $admin['upload_path'] . $imgdata['file_name'];

//                 $admin_thumb['new_image'] = $this->config->item('admin_thumb_upload_path') . $imgdata['file_name'];

//                 $admin_thumb['create_thumb'] = TRUE;

//                 $admin_thumb['maintain_ratio'] = FALSE;

//                 $admin_thumb['thumb_marker'] = '';

//                 $admin_thumb['width'] = $this->config->item('admin_thumb_width');

//                 $admin_thumb['height'] = $this->config->item('admin_thumb_height');



//                 //Loading Image Library

//                 $this->load->library('image_lib', $admin_thumb);

//                 $dataimage = $imgdata['file_name'];

//                 //Creating Thumbnail

//                 $this->image_lib->resize();

//                 $thumberror = $this->image_lib->display_errors();

//             } else {

//                 $thumberror = '';

//             }



//             if ($imgerror != '' || $thumberror != '') {

//                 $error[0] = $imgerror;

//                 $error[1] = $thumberror;

//             } else {

//                 $error = array();

//             }

//             if ($error) {

//                 $this->session->set_flashdata('error', $error[0]);

//                 $redirect_url = site_url('user_management');

//                 redirect($redirect_url, 'refresh');

//             } else {

//                 // $admin1 = $this->upload->data('file_name');

// //                    $admin = $admin1['file_name'];

//                 $admin = $imgdata['file_name'];

//             }

//             $rand_password = $this->random_password(8);



//             $insert_array = array(

//                 'admin_name' => trim($this->input->post('admin_name')),

//                 'admin_role' => 2,

//                 'admin_username' => trim($this->input->post('admin_username')),

//                 'admin_email' => trim($this->input->post('admin_email')),

//                 'admin_image' => $admin,

//                 'admin_password' => md5($rand_password),

//                 'admin_pwd' => base64_encode($rand_password),

//                 'admin_modified_date' => date('Y-m-d H:i:s'),

//                 'admin_ip' => getHostByName(getHostName()),

//                 'admin_status' => 1

//             );



//             $insert_result = $this->common->insert_data($insert_array, 'admin');



//             if ($insert_result) {

//                 $admin_url = site_url('../admin');

//                 $email_formate = $this->common->select_data_by_id('emails', 'emailid', '8', 'varsubject,varmailformat');

//                 $mail_body = str_replace("%name%", $this->input->post('admin_name'), str_replace("%admin_email%", $this->input->post('admin_email'), str_replace("%password%", $rand_password, str_replace("%link%", $admin_url, stripslashes($email_formate[0]['varmailformat'])))));

//                 $send_mail = $this->sendEmail($this->data['main_site_name'], $this->data['main_site_email'], $this->input->post('admin_email'), $email_formate[0]['varsubject'], $mail_body);

//             }



//             if ($this->input->post('redirect_url')) {

//                 $redirect_url = $this->input->post('redirect_url');

//             } else {

//                 $redirect_url = site_url('user_management');

//             }



//             if ($insert_result == 1 && $send_mail == 1) {



//                 $this->session->set_flashdata('success', 'User successfully inserted.');

//                 redirect($redirect_url, 'refresh');

//             } else {

//                 $this->session->set_flashdata('error', 'Error Occurred. Try Again!');

//                 redirect($redirect_url, 'refresh');

//             }

//         }





//         $this->load->view('user_management/add', $this->data);

//     }



    // public function edit($id = "") {

    //     $this->data['section_title'] = "Edit User Management";

    //     if ($this->input->post('admin_id')) {



    //         if ($_FILES['admin_image']['name'] != '') {



    //             $admin['upload_path'] = $this->config->item('admin_main_upload_path');

    //             $admin['allowed_types'] = $this->config->item('admin_allowed_types');

    //             $admin['max_size'] = $this->config->item('admin_main_max_size');

    //             $admin['max_width'] = $this->config->item('admin_main_max_width');

    //             $admin['max_height'] = $this->config->item('admin_main_max_height');



    //             //    $this->load->library('upload', $admin);



    //             $this->load->library('upload');

    //             $this->upload->initialize($admin);

    //             //Uploading Image

    //             $this->upload->do_upload('admin_image');

    //             //Getting Uploaded Image File Data

    //             $imgdata = $this->upload->data();

    //             $imgerror = $this->upload->display_errors();

    //             if ($imgerror == '') {

    //                 //Configuring Thumbnail 

    //                 $admin_thumb['image_library'] = 'gd2';

    //                 $admin_thumb['source_image'] = $admin['upload_path'] . $imgdata['file_name'];

    //                 $admin_thumb['new_image'] = $this->config->item('admin_thumb_upload_path') . $imgdata['file_name'];

    //                 $admin_thumb['create_thumb'] = TRUE;

    //                 $admin_thumb['maintain_ratio'] = FALSE;

    //                 $admin_thumb['thumb_marker'] = '';

    //                 $admin_thumb['width'] = $this->config->item('admin_thumb_width');

    //                 $admin_thumb['height'] = $this->config->item('admin_thumb_height');



    //                 //Loading Image Library

    //                 $this->load->library('image_lib', $admin_thumb);

    //                 $dataimage = $imgdata['file_name'];

    //                 //Creating Thumbnail

    //                 $this->image_lib->resize();

    //                 $thumberror = $this->image_lib->display_errors();

    //             } else {

    //                 $thumberror = '';

    //             }



    //             if ($imgerror != '' || $thumberror != '') {

    //                 $error[0] = $imgerror;

    //                 $error[1] = $thumberror;

    //             } else {

    //                 $error = array();

    //             }



    //             if ($error) {

    //                 $this->session->set_flashdata('error', $error[0]);

    //                 $redirect_url = site_url('admin_management');

    //                 redirect($redirect_url, 'refresh');

    //             } else {

    //                 $admin = $imgdata['file_name'];

    //             }



    //             $old_image = $this->input->post('old_image');

    //             $old_image_path = $this->config->item('admin_main_upload_path') . $old_image;

    //             $old_image_thumb_path = $this->config->item('admin_thumb_upload_path') . $old_image;



    //             if (file_exists($old_image_path)) {

    //                 unlink($old_image_path);

    //             }

    //             if (file_exists($old_image_thumb_path)) {

    //                 unlink($old_image_thumb_path);

    //             }

    //         } else {

    //             $admin = $this->input->post('old_image');

    //         }

    //         $admin_details = $this->common->select_data_by_id('admin', 'admin_id', $this->input->post('admin_id'), '*', $join_str = array());



    //         $this->data['admin_email'] = $admin_details[0]['admin_email'];



    //         if ($this->data['admin_email'] != $this->input->post('admin_email')) {



    //             $rand_password = $this->random_password(8);

    //             $update_array = array(

    //                 'admin_name' => trim($this->input->post('admin_name')),

    //                 'admin_email' => trim($this->input->post('admin_email')),

    //                 'admin_username' => $this->input->post('admin_username'),

    //                 'admin_password' => md5($rand_password),

    //                 'admin_pwd' => base64_encode($rand_password),

    //                 'admin_image' => $admin,

    //                 'admin_modified_date' => date('Y-m-d H:i:s'),

    //                 'admin_ip' => getHostByName(getHostName()),

    //             );





    //             $send_mail = 0;

    //         } else {

    //             $update_array = array(

    //                 'admin_name' => trim($this->input->post('admin_name')),

    //                 'admin_email' => trim($this->input->post('admin_email')),

    //                 'admin_username' => $this->input->post('admin_username'),

    //                 'admin_image' => $admin,

    //                 'admin_modified_date' => date('Y-m-d H:i:s'),

    //                 'admin_ip' => getHostByName(getHostName()),

    //             );

    //             $send_mail = 1;

    //         }

    //         $update_result = $this->common->update_data($update_array, 'admin', 'admin_id', $this->input->post('admin_id'));



    //         if ($update_result == 1 && $send_mail == 0) {

    //             $admin_url = site_url('../admin');

    //             $email_formate = $this->common->select_data_by_id('emails', 'emailid', '8', 'varsubject,varmailformat');

    //             $mail_body = str_replace("%name%", $this->input->post('admin_name'), str_replace("%link%", $admin_url, str_replace("%admin_email%", $this->input->post('admin_email'), str_replace("%password%", $rand_password, stripslashes($email_formate[0]['varmailformat'])))));

    //             $send_mail = $this->sendEmail($this->data['main_site_name'], $this->data['main_site_email'], $this->input->post('admin_email'), $email_formate[0]['varsubject'], $mail_body);

    //         }



    //         $redirect_url = site_url('user_management');

    //         if ($update_result == 1 && $send_mail == 1) {

    //             $this->session->set_flashdata('success', 'User successfully updated.');

    //             redirect($redirect_url, 'refresh');

    //         } else {

    //             $this->session->set_flashdata('error', 'Errorin Occurred. Try Again!');

    //             redirect($redirect_url, 'refresh');

    //         }

    //     }

        

    //     $id = base64_decode($id);

        

    //     $this->data['section_title'] = "Edit User Management";

    //     $admin_detail = $this->common->select_data_by_id('admin', 'admin_id', $id, '*', $join_str = array());

        

    //     $this->data['admin_id'] = $admin_detail[0]['admin_id'];

    //     $this->data['admin_name'] = $admin_detail[0]['admin_name'];

    //     $this->data['admin_username'] = $admin_detail[0]['admin_username'];

    //     $this->data['admin_email'] = $admin_detail[0]['admin_email'];

    //     $this->data['admin_image'] = $admin_detail[0]['admin_image'];



    //     $this->load->view('user_management/edit', $this->data);

    // }



    public function change_status($business_profile_id = '', $status = '') {

        // echo "Hello";die();
        // echo $business_profile_id;die();

        if ($business_profile_id != '' && $status != '') {

            $data = array('status' => $status);

            $update_status = $this->common->update_data($data, 'business_profile', 'business_profile_id', $business_profile_id);



            if ($update_status) {

                $this->session->set_flashdata('success', 'User Status Successfully Changed.');

                redirect('business_management', 'refresh');

            }

        }

    }



    public function delete($business_profile_id = '') {

       // echo "Hello";

       // echo $rec_id; die();

        if ($business_profile_id != '') {

            $business_profile_id = base64_decode($business_profile_id);

           // echo $rec_id; die();

            $data = array('is_deleted' => 1);

            $update_status = $this->common->update_data($data, 'business_profile', 'business_profile_id', $business_profile_id);



            if ($update_status) {

                $this->session->set_flashdata('success', 'User Successfully Delete.');

                redirect('business_management', 'refresh');

            }

        }

    }



    public function check_email() {

        if ($this->input->is_ajax_request() && $this->input->post('admin_email')) {



            $email = $this->input->post('admin_email');

            $condition_array = array('admin_status !=' => '3');

            if ($this->input->post('admin_id')) {

                $id = $this->input->post('admin_id');

                $check_result = $this->common->check_unique_avalibility('admin', 'admin_email', $email, 'admin_id', $id, $condition_array);

            } else {

                $check_result = $this->common->check_unique_avalibility('admin', 'admin_email', $email, '', '', $condition_array);

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

        redirect('business_management', 'refresh');

    }



}



/* End of file welcome.php */

/* Location: ./application/controllers/welcome.php */