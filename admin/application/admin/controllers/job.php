<?php



if (!defined('BASEPATH'))

    exit('No direct script access allowed');



class Job extends CI_Controller {



    public $data;



    public function __construct() {

        parent::__construct();





        // Get Site Information

       

        $this->data['title'] = "Job Management | $main_site_name ";

        $this->data['module_name'] = "Job Management";

        include('include.php');



//         //Loadin Pagination Custome Config File

//         $this->config->load('paging', TRUE);

//         $this->paging = $this->config->item('paging');

// //        print_r($this->paging);

// //        die();

//         //remove catch so after logout cannot view last visited page if that page is this

//         $this->output->set_header('Last-Modified:' . gmdate('D, d M Y H:i:s') . 'GMT');

//         $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');

//         $this->output->set_header('Cache-Control: post-check=0, pre-check=0', false);

//         $this->output->set_header('Pragma: no-cache');

    }



  public function index() {

        $this->data['section_title'] = "job Management List";





        $limit = $this->paging['per_page'];



        if ($this->uri->segment(3) != '' && $this->uri->segment(4) != '') {

            $offset = ($this->uri->segment(5) != '') ? $this->uri->segment(5) : 0;

            $short_by = $this->uri->segment(3);

            $order_by = $this->uri->segment(4);

        } else {

            $offset = ($this->uri->segment(3) != '') ? $this->uri->segment(3) : 0;

            $short_by = 'job_id';

            $order_by = 'asc';

        }



        $this->data['offset'] = $offset;



        $condition_array = array( 'is_delete =' => '0');



        $this->data['job_list'] = $get_users = $this->common->select_data_by_condition('job_reg', $condition_array, $data = '*', $short_by, $order_by, $limit, $offset, $join_str = array());


           // echo "$get_users";

            //print_r('rec_list'); die();


        if ($this->uri->segment(3) != '' && $this->uri->segment(4) != '') {

            $this->paging['base_url'] = site_url("job/index/" . $short_by . "/" . $order_by);

        } else {

            $this->paging['base_url'] = site_url("job/index/");

        }

        if ($this->uri->segment(3) != '' && $this->uri->segment(4) != '') {

            $this->paging['uri_segment'] = 5;

        } else {

            $this->paging['uri_segment'] = 3;

        }


        $contition_array1 = array( 'is_delete =' => '0');



        $this->paging['total_rows'] = count($this->common->select_data_by_condition('job_reg', $contition_array1, 'job_id'));

        $this->data['total_rows'] = $this->paging['total_rows'];

        $this->data['limit'] = $limit;

        //$this->paging['per_page'] = 2;


        $this->pagination->initialize($this->paging);

        $this->data['search_keyword'] = '';

        $this->load->view('job/index', $this->data);

    }

public function search() {

        $this->data['section_title'] = "Job Management List";

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

                $short_by = 'job_id';

                $order_by = 'asc';

            }

            $this->data['offset'] = $offset;

            //prepare search condition

            $search_condition = "(fname LIKE '%$search_keyword%' OR email LIKE '%$search_keyword%' )";



            $contition_array = array('status' => 1);

            $this->data['job_list'] = $this->common->select_data_by_search('job_reg', $search_condition, $contition_array, '*', $short_by, $order_by, $limit, $offset);



            if ($this->uri->segment(3) != '' && $this->uri->segment(4) != '') {

                $this->paging['base_url'] = site_url("job/search/" . $short_by . "/" . $order_by);

            } else {

                $this->paging['base_url'] = site_url("job/search/");

            }



            if ($this->uri->segment(3) != '' && $this->uri->segment(4) != '') {

                $this->paging['uri_segment'] = 5;

            } else {

                $this->paging['uri_segment'] = 3;

            }

            $this->paging['total_rows'] = count($this->common->select_data_by_search('job_reg', $search_condition, $contition_array, 'job_id'));



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

                $short_by = 'job_id';

                $order_by = 'asc';

            }

            $this->data['offset'] = $offset;

            //prepare search condition

            $search_condition = "(fname LIKE '%$search_keyword%' OR email LIKE '%$search_keyword%')";



            $contition_array = array();

            $this->data['job_list'] = $this->common->select_data_by_search('job_reg', $search_condition, $contition_array, '*', $short_by, $order_by, $limit, $offset);



            if ($this->uri->segment(3) != '' && $this->uri->segment(4) != '') {

                $this->paging['base_url'] = site_url("job/search/" . $short_by . "/" . $order_by);

            } else {

                $this->paging['base_url'] = site_url("job/search/");

            }



            if ($this->uri->segment(3) != '' && $this->uri->segment(4) != '') {

                $this->paging['uri_segment'] = 5;

            } else {

                $this->paging['uri_segment'] = 3;

            }

            $this->paging['total_rows'] = count($this->common->select_data_by_search('job_reg', $search_condition, $contition_array, 'job_id'));



            $this->data['total_rows'] = $this->paging['total_rows'];

            $this->data['limit'] = $limit;



            $this->pagination->initialize($this->paging);

        }

        $this->load->view('job/index', $this->data);

    }



  
    //add new user

    public function add($id = '') 
    {

         

        $this->data['section_title'] = "Add";


        $contition_array = array('status' => '1', 'is_delete' => '0');
        $this->userdata['users'] = $this->common->select_data_by_condition('user', $contition_array, $data = '*', $sortby = 'user_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        $contition_array = array('status' => 1);
        $this->userdata['nationality'] = $this->common->select_data_by_condition('nation', $contition_array, $data = '*', $sortby = 'nation_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');

         $contition_array = array('status' => 1);
        $this->userdata['degree'] = $this->common->select_data_by_condition('degree', $contition_array, $data = '*', $sortby = 'degree_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');

         $contition_array = array('status' => 1);
        $this->userdata['university'] = $this->common->select_data_by_condition('university', $contition_array, $data = '*', $sortby = 'university_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');


        $contition_array = array('status' => 1);
        $this->data['countries'] =  $this->common->select_data_by_condition('countries', $contition_array, $data = '*', $sortby = 'country_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');


        // $this->data['country_name'] = $faq_detail[0]['country_name'];
        

        $this->load->view('job/add', array_merge($this->userdata,$this->data));

    }


     public function add_insert()
    {

         

         //echo "<pre>"; print_r($_POST);  print_r($_FILES);die();
        $userid = $this->input->post('user_name');

        $contition_array = array( 'user_id' => $userid);

        $result = $this->userdata['users'] = $this->common->select_data_by_condition('job_reg', $contition_array, $data = '*', $sortby = 'user_id', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');


         $language = $this->input->post('language');
         $exp_year = $this->input->post('experience_year');
         $exp_month = $this->input->post('experience_month');

        //upload education certificate process start
              $config['upload_path'] = '../uploads/job_edu_certificate/';
                $config['allowed_types'] = 'jpg|jpeg|png|gif|pdf';
               // $config['file_name'] = $_FILES['picture']['name'];
                $config['file_name'] = $_FILES['edu_certificate']['name'];
                
                //Load upload library and initialize configuration
                $this->load->library('upload',$config);
                $this->upload->initialize($config);
                
                if($this->upload->do_upload('edu_certificate'))
                {
                    $uploadData = $this->upload->data();
                    //$picture = $uploadData['file_name']."-".date("Y_m_d H:i:s");
                    $educertificate = $uploadData['file_name'];
                    // echo $educertificate;die();
                }
                else
                {
                    $educertificate = '';
                }
             //upload education certificate process start

                  $config['upload_path'] = '../uploads/job_work_certificate/';
                $config['allowed_types'] = 'jpg|jpeg|png|gif|pdf';
                $config['file_name'] = $_FILES['exp_certificate']['name'];
                
                //Load upload library and initialize configuration
                $this->load->library('upload',$config);
                $this->upload->initialize($config);
                
                if($this->upload->do_upload('exp_certificate'))
                {
                    //echo "hi"; die();
                    $uploadData = $this->upload->data();
                    
                    $expcertificate = $uploadData['file_name'];
                    
                }
                else
                {
                    //echo "hello"; die();
                    $expcertificate = '';
                }
             //upload education certificate process start




                $exp = $this->input->post('radio'); 
                //echo $exp ;
                if ($exp == "Fresher") {          

                    $exp = $this->input->post('radio');
                    $exp_year= '';
                    $exp_month= ''; 

                }
                else 
                {
                    $exp = $this->input->post('radio');
                    $exp_year= $this->input->post('experience_year');
                    $exp_month= $this->input->post('experience_month'); 
                    $this->form_validation->set_rules('experience_year','Experience Year', 'required');
                    $this->form_validation->set_rules('experience_month','Experience Month', 'required');
                    
                }     




         
        if($result)
        {
                echo "user job registration already exist";
        }

         else
         {   

            $data = array(
                 
                 'fname' => $this->input->post('fname'),
                 'lname' => $this->input->post('lname'),
                 'email' => $this->input->post('email'),
                 'phnno' => $this->input->post('phnno'),
                 'marital_status' => $this->input->post('marital_status'),
                 'nation_id' => $this->input->post('nationality'),

                 'language'=>implode(",", $language),
                 'dob' => $this->input->post('dob'),
                 'gender' => $this->input->post('gender'),
                 'country_id'=> $this->input->post('country'),
                'state_id'=> $this->input->post('state'),
                'city_id'=> $this->input->post('city'),
                'address'=> $this->input->post('address'),
                'pincode'=> $this->input->post('pincode'),
                'degree'=> $this->input->post('degree'),
                'stream'=> $this->input->post('stream'),
                'university'=> $this->input->post('university'),
                'college'=> $this->input->post('college'),
                'grade'=> $this->input->post('grade'),
                'percentage'=> $this->input->post('percentage'),
                'pass_year'=> $this->input->post('pass_year'),
                'edu_certificate'=> $educertificate,
                  'keyskill'=> $this->input->post('keyskill'),
                  'ApplyFor'=> $this->input->post('ApplyFor'),
                  'jobtitle'=> $this->input->post('jobtitle'),
                'companyname'=> $this->input->post('companyname'),
                'companyemail'=> $this->input->post('companyemail'),
                'companyphn'=> $this->input->post('companyphn'),
                 'experience'=> $exp,
                 'experience_year'=> $exp_year,
                 'experience_month'=> $exp_month,
                 'work_certificate' =>  $expcertificate,
                 'curricular'=> $this->input->post('curricular'),
                 'interest'=> $this->input->post('interest'),
                'reference'=> $this->input->post('reference'),
                'carrier'=> $this->input->post('carrier'),
                  'status' => 1,
                 'is_delete' => 0,
                 'created_date' => date('Y-m-d h:i:s',time()),
                'user_id'=> $userid,

        ); 

        // echo "<pre>";print_r($data); print_r($_FILES); die();
        $insert_id = $this->common->insert_data_getid($data,'job_reg'); 

        if($insert_id)
        { 
              redirect('job/index');
          
        }
       else
        {
                $this->session->flashdata('error','Sorry!! Your data not inserted');
               redirect('job/add', 'refresh');
        }
      }
       
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


public function ajax_data1() { 

     
       if(isset($_POST["degree_id"]) && !empty($_POST["degree_id"])){ 
    //Get all state data
    $contition_array = array('degree_id' => $_POST["degree_id"] , 'status' => 1);
     $stream =  $this->data['stream'] =  $this->common->select_data_by_condition('stream', $contition_array, $data = '*', $sortby = 'stream_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');
   
    //Count total number of rows
   
    
    //Display states list
    if(count($stream) > 0){
        echo '<option value="">Select stream</option>';
     foreach($stream as $st){
            echo '<option value="'.$st['stream_id'].'">'.$st['stream_name'].'</option>';
     
        }
    }

    else{
        echo '<option value="">Stream not available</option>';
    }
}



}


    public function edit($id = "") 
    {

        $this->data['section_title'] = "Edit Job Management";

        $id = base64_decode($id);


        // $contition_array = array('status' => '1', 'is_delete' => '0');
        // $this->userdata['users'] = $this->common->select_data_by_condition('user', $contition_array, $data = '*', $sortby = 'user_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');



         $contition_array = array('status' => 1);
        $this->data['degree_data'] = $this->common->select_data_by_condition('degree', $contition_array, $data = '*', $sortby = 'degree_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');
        // print_r($this->userdata['degree_data']);die();

         $contition_array = array('status' => 1);
        $this->data['stream_data'] = $this->common->select_data_by_condition('stream', $contition_array, $data = '*', $sortby = 'stream_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');

            $contition_array = array('status' => 1);
        $this->data['language'] = $this->common->select_data_by_condition('language', $contition_array, $data = '*', $sortby = 'language_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');

         $contition_array = array('status' => 1);
        $this->data['countries'] =  $this->common->select_data_by_condition('countries', $contition_array, $data = '*', $sortby = 'country_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');


        $contition_array = array('status' => 1);
        $this->data['states'] =  $this->common->select_data_by_condition('states', $contition_array, $data = '*', $sortby = 'state_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        $contition_array = array('status' => 1);
        $this->data['cities'] =  $this->common->select_data_by_condition('cities', $contition_array, $data = '*', $sortby = 'city_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');

             //for getting univesity data
       $contition_array = array('status' => 1);
      $this->data['uni'] =  $this->common->select_data_by_condition('university', $contition_array, $data = '*', $sortby = 'university_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = ''); 



        $contition_array = array('status' => 1);
        $this->data['nation'] = $this->common->select_data_by_condition('nation', $contition_array, $data = '*', $sortby = 'nation_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');

         $contition_array = array('job_id' => $id);

        $this->jobdata['job'] = $this->common->select_data_by_condition('job_reg',$contition_array, $data = '*', $sortby ='', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');


        
        $this->load->view('job/edit',array_merge($this->jobdata,$this->data));

    }

       public function edit_insert($id) 
    {

        $this->data['section_title'] = "Edit Job Management";

        $id = base64_decode($id);

        // print_r($id); die();

          $userid = $this->input->post('fname');

       

      
         $language = $this->input->post('language');
         $exp = $this->input->post('radio');

         $exp_year = $this->input->post('experience_year');
         $exp_month = $this->input->post('experience_month');
         

         $userid= $this->input->post('user_id'); 
        
        // echo "<pre>"; print_r($_POST); die();

        // // <basic info start>
        // $this->form_validation->set_rules('fname', 'Firstname', 'required');
        // $this->form_validation->set_rules('lname', 'Lastname', 'required');
        // $this->form_validation->set_rules('email', 'Store  email', 'required|valid_email');
        // $this->form_validation->set_rules('phnno', 'Mobile Number ', 'required|regex_match[/^[0-9]{10}$/]');
        // $this->form_validation->set_rules('marital_status','Marital Status', 'required');
        // $this->form_validation->set_rules('nationality','Nationality', 'required');
        // $this->form_validation->set_rules('language', 'Language', 'required');
        // $this->form_validation->set_rules('dob', 'Date of Birth', 'required');
        // $this->form_validation->set_rules('gender', 'Gender', 'required');
        // // <basic info end>
        // // <address start>
        //  $this->form_validation->set_rules('country', 'country', 'required');
        //  // $this->form_validation->set_rules('state', 'state', 'required');
        //  // $this->form_validation->set_rules('city', 'city', 'required');
        // $this->form_validation->set_rules('address', 'address', 'required');
        // $this->form_validation->set_rules('pincode', 'pincode', 'required|numeric');
        
        // // <address end>

        // // <education qualification start>
        //   $this->form_validation->set_rules('degree','Degree', 'required');
        //  $this->form_validation->set_rules('stream','Stream', 'required');
        //  $this->form_validation->set_rules('university','University', 'required');
        //  $this->form_validation->set_rules('college','College', 'required');
        //  $this->form_validation->set_rules('grade','Grade', 'required');
        //  $this->form_validation->set_rules('percentage','Percentage', 'required');
        // $this->form_validation->set_rules('pass_year','Pass_year', 'required');
   
        // // <education qualification end>
        // // <job skill start>

        //  $this->form_validation->set_rules('keyskill','Keyskill', 'required');
        //  // </job skill end>

        //  // <ApplyFor start>

        //    $this->form_validation->set_rules('ApplyFor','APPLY FOR', 'required');
        //    // </ApplyFor end>

        //    // <work exp start>

        //  $this->form_validation->set_rules('jobtitle','Job Title', 'required');
        //  $this->form_validation->set_rules('companyname','Company Name', 'required');
        //  $this->form_validation->set_rules('companyemail','Company Email', 'required|valid_email');
        //  $this->form_validation->set_rules('companyphn','Company Phone', 'required|regex_match[/^[0-9]{10}$/]');

        //  // <work exp end>

        //    $this->form_validation->set_rules('curricular','CURRICULAR', 'required');

        //  // $this->form_validation->set_rules('interest','Interest', 'required');
        //  // $this->form_validation->set_rules('reference','Reference', 'required');

        // $this->form_validation->set_rules('checkbox','Checkbox', 'required');
        //  $this->form_validation->set_rules('carrier','Carrier', 'required');


        //  if ($this->form_validation->run() == FALSE)
        // { 
            
        //  $this->load->view('job/add'); 
        // }  


             if (empty($_FILES['edu_certificate']['name']))

             {
                   //echo "hii"; die();
                 //$this->form_validation->set_rules('admin_image', 'Upload Image', 'required');
                  
                  $educertificate = $this->input->post('old_image');
            }

            else
            {


                 $config['upload_path'] = '../uploads/job_edu_certificate/';
                $config['allowed_types'] = 'jpg|jpeg|png|gif|pdf';
               // $config['file_name'] = $_FILES['picture']['name'];
                $config['file_name'] = $_FILES['edu_certificate']['name'];
                
                //Load upload library and initialize configuration
                $this->load->library('upload',$config);
                $this->upload->initialize($config);
                
                if($this->upload->do_upload('edu_certificate'))
                {
                    $uploadData = $this->upload->data();
                    //$picture = $uploadData['file_name']."-".date("Y_m_d H:i:s");
                    $educertificate = $uploadData['file_name'];
                    // echo $educertificate;die();
                }
                else
                {
                    $educertificate = '';
                }
            }
             //upload education certificate process start


                 if (empty($_FILES['exp_certificate']['name']))

             {
                   
                 //$this->form_validation->set_rules('admin_image', 'Upload Image', 'required');
                  
                  $expcertificate = $this->input->post('old_image1');
            }


            else
            {
                  $config['upload_path'] = '../uploads/job_work_certificate/';
                $config['allowed_types'] = 'jpg|jpeg|png|gif|pdf';
                $config['file_name'] = $_FILES['exp_certificate']['name'];
                
                //Load upload library and initialize configuration
                $this->load->library('upload',$config);
                $this->upload->initialize($config);
                
                if($this->upload->do_upload('exp_certificate'))
                {
                    //echo "hi"; die();
                    $uploadData = $this->upload->data();
                    
                    $expcertificate = $uploadData['file_name'];
                    
                }
                else
                {
                    //echo "hello"; die();
                    $expcertificate = '';
                }
            }
             //upload education certificate process start




                $exp = $this->input->post('radio'); 
                //echo $exp ;
                if ($exp == "Fresher") {          

                    $exp = $this->input->post('radio');
                    $exp_year= '';
                    $exp_month= ''; 

                }
                else 
                {
                    $exp = $this->input->post('radio');
                    $exp_year= $this->input->post('experience_year');
                    $exp_month= $this->input->post('experience_month'); 
                    $this->form_validation->set_rules('experience_year','Experience Year', 'required');
                    $this->form_validation->set_rules('experience_month','Experience Month', 'required');
                    
                }     

         
    
            $data = array(
                 
                 'fname' => $this->input->post('fname'),
                 'lname' => $this->input->post('lname'),
                 'email' => $this->input->post('email'),
                 'phnno' => $this->input->post('phnno'),
                 'marital_status' => $this->input->post('marital_status'),
                 'nation_id' => $this->input->post('nationality'),

                 'language'=>implode(",", $language),
                 'dob' => $this->input->post('dob'),
                 'gender' => $this->input->post('gender'),
                 'country_id'=> $this->input->post('country'),
                'state_id'=> $this->input->post('state'),
                'city_id'=> $this->input->post('city'),
                'address'=> $this->input->post('address'),
                'pincode'=> $this->input->post('pincode'),
                'degree'=> $this->input->post('degree'),
                'stream'=> $this->input->post('stream'),
                'university'=> $this->input->post('university'),
                'college'=> $this->input->post('college'),
                'grade'=> $this->input->post('grade'),
                'percentage'=> $this->input->post('percentage'),
                'pass_year'=> $this->input->post('pass_year'),
                'edu_certificate'=> $educertificate,
                  'keyskill'=> $this->input->post('keyskill'),
                  'ApplyFor'=> $this->input->post('ApplyFor'),
                  'jobtitle'=> $this->input->post('jobtitle'),
                'companyname'=> $this->input->post('companyname'),
                'companyemail'=> $this->input->post('companyemail'),
                'companyphn'=> $this->input->post('companyphn'),
                 'experience'=> $exp,
                 'experience_year'=> $exp_year,
                 'experience_month'=> $exp_month,
                 'work_certificate'=> $expcertificate,
                 'curricular'=> $this->input->post('curricular'),
                 'interest'=> $this->input->post('interest'),
                'reference'=> $this->input->post('reference'),
                'carrier'=> $this->input->post('carrier'),
                  'status' => 1,
                 'is_delete' => 0,
                 'modified_date' => date('Y-m-d h:i:s',time()),
                'user_id'=> $userid,
                'job_step' => 9
        ); 


        

        // echo "<pre>";print_r($data);die();

            $varid = $this->input->post('job_id');

            // print_r($varid);die();
              $update= $this->common->update_data($data, 'job_reg', 'job_id', $varid);
        

        if($update)
        { 
              redirect('job/index');
          
        }
       else
        {
                $this->session->flashdata('error','Sorry!! Your data not inserted');
               redirect('job/edit', 'refresh');
        }
      



        $this->load->view('job/edit');

    }



    public function change_status($job_id = '', $status = '') {



        if ($job_id != '' && $status != '') {

            $data = array('status' => $status);

            $update_status = $this->common->update_data($data, 'job_reg', 'job_id', $job_id);



            if ($update_status) {

                $this->session->set_flashdata('success', 'User Status Successfully Changed.');

                redirect('job', 'refresh');

            }


 redirect('job', 'refresh');

        }

    }



    public function delete($job_id = '') {

        if ($job_id != '')
         {

            $job_id = base64_decode($job_id);

            // $data = array('is_delete' => 0);

            $delete_status = $this->common->delete_data('job_reg','job_id',$job_id);



            if ($delete_status)
             {

                $this->session->set_flashdata('success', 'User Successfully Delete.');

                redirect('job', 'refresh');

            }

        }

    }

    public function view($id ='')
    {


        $this->data['section_title'] = "Job Management";

        $id = base64_decode($id);

        // echo $id;die();

        $contition_array = array('job_id' => $id);

        $this->data['job'] = $this->common->select_data_by_condition('job_reg',$contition_array, $data = '*', $sortby ='', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        // print_r($this->data['job']); die();
        $this->load->view('job/view',$this->data);
    }

}



/* End of file welcome.php 

/* Location: ./application/controllers/welcome.php */