<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Freelancer extends MY_Controller {

    public $data;

    public function __construct() {
        parent::__construct();

        $this->load->library('form_validation');
        $this->load->model('email_model');

        include ('include.php');
          $this->data['aileenuser_id'] = $this->session->userdata('aileenuser');
    }

    public function index() {  //echo "falguni"; die();
        $userid = $this->session->userdata('aileenuser');


        $this->load->view('freelancer/freelancer_main', $this->data);
    }

    public function freelancer_post() {


        $userid = $this->session->userdata('aileenuser');

        $contition_array = array('user_id' => $userid, 'status' => '0');
        $freelancerpostdata = $this->common->select_data_by_condition('freelancer_post_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
        if ($freelancerpostdata) {

            $this->load->view('freelancer/freelancer_post/reactivate', $this->data);
        } else {

            $userid = $this->session->userdata('aileenuser');
            $contition_array = array('user_id' => $userid, 'status' => '1', 'is_delete' => '0');
            $jobdata = $this->common->select_data_by_condition('freelancer_post_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');


            if ($jobdata[0]['free_post_step'] == 1) {
                redirect('freelancer/freelancer_post_address_information', refresh);
            } else if ($jobdata[0]['free_post_step'] == 2) {
                redirect('freelancer/freelancer_post_professional_information', refresh);
            } else if ($jobdata[0]['free_post_step'] == 3) {
                redirect('freelancer/freelancer_post_rate', refresh);
            } else if ($jobdata[0]['free_post_step'] == 4) {
                redirect('freelancer/freelancer_post_avability', refresh);
            } else if ($jobdata[0]['free_post_step'] == 5) {
                redirect('freelancer/freelancer_post_education', refresh);
            } else if ($jobdata[0]['free_post_step'] == 6) {
                redirect('freelancer/freelancer_post_portfolio', refresh);
            } else if ($jobdata[0]['free_post_step'] == 7) {
                redirect('freelancer/freelancer_apply_post', refresh);
            } else {
                redirect('freelancer/freelancer_post_basic_information', refresh);
                // $this->load->view('freelancer/freelancer_post/freelancer_post_basic_information',$this->data);
            }
        }
    }

    //freelancer workexp first  info page controller start

    public function freelancer_post_basic_information() {
        $userid = $this->session->userdata('aileenuser');


//if user deactive profile then redirect to freelancer/freelancer_post/freelancer_post_basic_information  start
        $contition_array = array('user_id'=> $userid,'status' => '0','is_delete'=> '0');

        $freelancerpost_deactive = $this->data['freelancerpost_deactive'] = $this->common->select_data_by_condition('freelancer_post_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);

        if( $freelancerpost_deactive)
        {
            redirect('freelancer/freelancer_post/freelancer_post_basic_information');
        }
    //if user deactive profile then redirect to freelancer/freelancer_post/freelancer_post_basic_information  End



        $contition_array = array('user_id' => $userid, 'is_delete' => '0', 'status' => '1');
        $userdata = $this->common->select_data_by_condition('freelancer_post_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        if ($userdata) {
            $step = $userdata[0]['free_post_step'];

            if ($step == 1 || $step > 1) {
                $this->data['firstname1'] = $userdata[0]['freelancer_post_fullname'];
                $this->data['lastname1'] = $userdata[0]['freelancer_post_username'];
                $this->data['email1'] = $userdata[0]['freelancer_post_email'];
                $this->data['skypeid1'] = $userdata[0]['freelancer_post_skypeid'];
                $this->data['phoneno1'] = $userdata[0]['freelancer_post_phoneno'];
            }

//echo "<pre>";print_r( $this->data['phoneno1']);die();
        }

           $contition_array = array('status' => '1', 'is_delete' => '0' ,'free_post_step' => 7);

        $freelancer_postdata = $this->data['results'] = $this->common->select_data_by_condition('freelancer_post_reg', $contition_array, $data = 'designation,freelancer_post_otherskill', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);
        // echo "<pre>"; print_r($freelancer_postdata);die();

        $contition_array = array('status' => '1', 'type' => '1');

        $skill = $this->data['results'] = $this->common->select_data_by_condition('skill', $contition_array, $data = 'skill', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby);

         $contition_array = array('status' => '1');

        $results_post = $this->data['results'] = $this->common->select_data_by_condition('freelancer_post', $contition_array, $data = 'post_name', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);


        $contition_array = array('status' => '1', 'is_delete' => '0');

        $field = $this->data['results'] = $this->common->select_data_by_condition('category', $contition_array, $data = 'category_name', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby);

        $uni = array_merge($skill, $freelancer_postdata, $field,$results_post);
        // echo count($unique);
        // $this->data['demo']=$uni;

        foreach ($uni as $key => $value) {
            foreach ($value as $ke => $val) {
                if ($val != "") {


                    $result[] = $val;
                }
            }
        }
        $results = array_unique($result);
        foreach($results as $key =>$value){
            $result1[$key]['label']=$value;
            $result1[$key]['value']=$value;
          }

         
 $contition_array = array('status' => '1');
          $location_list = $this->common->select_data_by_condition('cities', $contition_array, $data = 'city_name', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);
   

          foreach ($location_list as $key1 => $value1) {
              foreach ($value1 as $ke1 => $val1) {
                 $location[] = $val1;
              }
          }
          //echo "<pre>"; print_r($location);die();
          foreach ($location as $key => $value) {
              $loc[$key]['label'] =$value;
              $loc[$key]['value'] =$value;
          }
         
 //echo "<pre>"; print_r($loc);die();

        $this->data['city_data']= array_values($loc);


         $this->data['demo']= array_values($result1);



        $this->load->view('freelancer/freelancer_post/freelancer_post_basic_information', $this->data);
    }

    public function hire_designation() {

        $userid = $this->session->userdata('aileenuser');


        $data = array(
            'designation' => trim($this->input->post('designation')),
            'modified_date' => date('Y-m-d', time())
        );

        $updatdata = $this->common->update_data($data, 'freelancer_hire_reg', 'user_id', $userid);

        if ($updatdata) {

            if ($this->input->post('hitext') == 1) {
                redirect('freelancer/freelancer_hire_profile', refresh);
            } elseif ($this->input->post('hitext') == 2) {
                redirect('freelancer/freelancer_hire_post', refresh);
            } elseif ($this->input->post('hitext') == 3) {
                redirect('freelancer/freelancer_save', refresh);
            }
        } else {
            $this->session->flashdata('error', 'Your data not inserted');
            redirect('freelancer/recommen_candidate', refresh);
        }
    }

//designation end


    public function freelancer_post_basic_information_insert() {
        $userid = $this->session->userdata('aileenuser');


        $this->form_validation->set_rules('firstname', 'Full Name', 'required');
        $this->form_validation->set_rules('lastname', 'Last Name', 'required');
        

        $this->form_validation->set_rules('email', 'EmailId', 'required|valid_email');
        
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('freelancer/freelancer_post/freelancer_post_basic_information');
        } else {

            $contition_array = array('user_id' => $userid, 'is_delete' => '0', 'status' => '1');
            $userdata = $this->common->select_data_by_condition('freelancer_post_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');



            if ($userdata) {
                if ($userdata[0]['free_post_step'] == 7) {
                    $data = array(
                        'free_post_step' => 7
                    );

                    $updatedata = $this->common->update_data($data, 'freelancer_post_reg', 'user_id', $userid);
                } else if ($userdata[0]['free_post_step'] > 1) {
                    $data = array(
                        'free_post_step' => $userdata[0]['free_post_step']
                    );

                    $updatedata = $this->common->update_data($data, 'freelancer_post_reg', 'user_id', $userid);
                } else {
                    $data = array(
                        'free_post_step' => 1
                    );

                    $updatedata = $this->common->update_data($data, 'freelancer_post_reg', 'user_id', $userid);
                }

                $data = array(
                    'freelancer_post_fullname' => trim($this->input->post('firstname')),
                    'freelancer_post_username' => trim($this->input->post('lastname')),
                    'freelancer_post_skypeid' => trim($this->input->post('skypeid')),
                    'freelancer_post_email' => trim($this->input->post('email')),
                    'freelancer_post_phoneno' => trim($this->input->post('phoneno')),
                    'user_id' => $userid,
                    'modify_date' => date('Y-m-d', time())
                );



                $updatedata = $this->common->update_data($data, 'freelancer_post_reg', 'user_id', $userid);

                if ($updatedata) {
                    $this->session->set_flashdata('success', 'Basic information updated successfully');
                    redirect('freelancer/freelancer_post_address_information', refresh);
                } else {
                    $this->session->flashdata('error', 'Your data not inserted');
                    redirect('freelancer/freelancer_post_basic_information', refresh);
                }
            } else {

                $data = array(
                    'freelancer_post_fullname' => trim($this->input->post('firstname')),
                    'freelancer_post_username' => trim($this->input->post('lastname')),
                    'freelancer_post_skypeid' => trim($this->input->post('skypeid')),
                    'freelancer_post_email' => trim($this->input->post('email')),
                    'freelancer_post_phoneno' => trim($this->input->post('phoneno')),
                    'user_id' => $userid,
                    'created_date' => date('Y-m-d', time()),
                    'status' => 1,
                    'is_delete' => 0,
                    'free_post_step' => 1
                );



                $insert_id = $this->common->insert_data_getid($data, 'freelancer_post_reg');
                if ($insert_id) {


                    $this->session->set_flashdata('success', 'Basic information updated successfully');
                    redirect('freelancer/freelancer_post_address_information', refresh);
                } else {
                    $this->session->flashdata('error', 'Sorry!! Your data not inserted');
                    redirect('freelancer/freelancer_post_basic_information', refresh);
                }
            }
        }
    }

    //freelancer workexp first  info page controller End
//check email avilibity start
    public function check_email() {

        $email = trim($this->input->post('email'));

        $userid = $this->session->userdata('aileenuser');

        $contition_array = array('user_id' => $userid, 'is_delete' => '0', 'status' => '1');
        $userdata = $this->common->select_data_by_condition('freelancer_post_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        $email1 = $userdata[0]['freelancer_post_email'];

        if ($email1) {

            $condition_array = array('is_delete' => '0', 'user_id !=' => $userid, 'status' => '1');

            $check_result = $this->common->check_unique_avalibility('freelancer_post_reg', 'freelancer_post_email', $email, '', '', $condition_array);
        } else {

            $condition_array = array('is_delete' => '0');

            $check_result = $this->common->check_unique_avalibility('freelancer_post_reg', 'freelancer_post_email', $email, '', '', $condition_array);
        }

        if ($check_result) {
            echo 'true';
            die();
        } else {
            echo 'false';
            die();
        }
    }

// check email end
//freelancer address page controller Start
    public function freelancer_post_address_information() {
        $userid = $this->session->userdata('aileenuser');


//if user deactive profile then redirect to freelancer/freelancer_post/freelancer_post_basic_information  start
        $contition_array = array('user_id'=> $userid,'status' => '0','is_delete'=> '0');

        $freelancerpost_deactive = $this->data['freelancerpost_deactive'] = $this->common->select_data_by_condition('freelancer_post_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);

        if( $freelancerpost_deactive)
        {
            redirect('freelancer/freelancer_post/freelancer_post_basic_information');
        }
    //if user deactive profile then redirect to freelancer/freelancer_post/freelancer_post_basic_information  End


        $contition_array = array('status' => 1);
        $this->data['countries'] = $this->common->select_data_by_condition('countries', $contition_array, $data = '*', $sortby = 'country_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        //user data fetch

         $contition_array = array('user_id' => $userid, 'is_delete' => '0', 'status' => '1');
        $userdata = $this->common->select_data_by_condition('freelancer_post_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');


        //for getting state data
        $contition_array = array('status' => 1,'country_id' => $userdata[0]['freelancer_post_country']);
        $this->data['states'] = $this->common->select_data_by_condition('states', $contition_array, $data = '*', $sortby = 'state_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        //for getting city data
        $contition_array = array('status' => 1,'state_id'=> $userdata[0]['freelancer_post_state']);
        $this->data['cities'] = $this->common->select_data_by_condition('cities', $contition_array, $data = '*', $sortby = 'city_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');



        //for getting job registration table data    
       


        if ($userdata) {
            $step = $userdata[0]['free_post_step'];

            if ($step == 2 || $step > 2 || ($step >= 1 && $step <= 2)) {
                $this->data['country1'] = $userdata[0]['freelancer_post_country'];
                $this->data['state1'] = $userdata[0]['freelancer_post_state'];
                $this->data['city1'] = $userdata[0]['freelancer_post_city'];
                $this->data['pincode1'] = $userdata[0]['freelancer_post_pincode'];
                $this->data['address1'] = $userdata[0]['freelancer_post_address'];
            }
        }

           $contition_array = array('status' => '1', 'is_delete' => '0','free_post_step' => 7);

        $freelancer_postdata = $this->data['results'] = $this->common->select_data_by_condition('freelancer_post_reg', $contition_array, $data = 'designation,freelancer_post_otherskill', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);
        // echo "<pre>"; print_r($freelancer_postdata);die();

        $contition_array = array('status' => '1', 'type' => '1');

        $skill = $this->data['results'] = $this->common->select_data_by_condition('skill', $contition_array, $data = 'skill', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);

         $contition_array = array('status' => '1');

        $results_post = $this->data['results'] = $this->common->select_data_by_condition('freelancer_post', $contition_array, $data = 'post_name', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);


        $contition_array = array('status' => '1', 'is_delete' => '0');

        $field = $this->data['results'] = $this->common->select_data_by_condition('category', $contition_array, $data = 'category_name', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);

        $uni = array_merge($skill, $freelancer_postdata, $field,$results_post);
        // echo count($unique);
        // $this->data['demo']=$uni;

        foreach ($uni as $key => $value) {
            foreach ($value as $ke => $val) {
                if ($val != "") {


                    $result[] = $val;
                }
            }
        }
        $results = array_unique($result);
        foreach($results as $key =>$value){
            $result1[$key]['label']=$value;
            $result1[$key]['value']=$value;
          }


            $contition_array = array('status' => '1');
          $citiess = $this->common->select_data_by_condition('cities', $contition_array, $data = 'city_name', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);
   

           foreach ($citiess as $key) {
              
                 $location_list[] = $key['city_name'];
              
          }
          //echo "<pre>"; print_r($location);die();
         foreach ($location_list as $key => $value) {
              $loc[$key]['label'] =$value;
              $loc[$key]['value'] =$value;
          }
         
 // //echo "<pre>"; print_r($loc);die();

        $this->data['city_data']= $loc;
         
         $this->data['demo']= array_values($result1);



        $this->load->view('freelancer/freelancer_post/freelancer_post_address_information', $this->data);
    }

    public function ajax_data() {

        // ajax for degree start

        if (isset($_POST["degree_id"]) && !empty($_POST["degree_id"])) {
            //Get all state data
            $contition_array = array('degree_id' => $_POST["degree_id"], 'status' => 1);
            $stream = $this->data['stream'] = $this->common->select_data_by_condition('stream', $contition_array, $data = '*', $sortby = 'stream_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');

            //Count total number of rows
            //Display states list
            if (count($stream) > 0) {
                echo '<option value="">Select stream</option>';
                foreach ($stream as $st) {
                    echo '<option value="' . $st['stream_id'] . '">' . $st['stream_name'] . '</option>';
                }
            } else {
                echo '<option value="">Stream not available</option>';
            }
        }

        // ajax for degree end
        // ajax for country start


        if (isset($_POST["country_id"]) && !empty($_POST["country_id"])) {
            //Get all state data
            $contition_array = array('country_id' => $_POST["country_id"], 'status' => 1);
            $state = $this->data['states'] = $this->common->select_data_by_condition('states', $contition_array, $data = '*', $sortby = 'state_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');

            //Count total number of rows
            //Display states list
            if (count($state) > 0) {
                echo '<option value="">Select state</option>';
                foreach ($state as $st) {
                    echo '<option value="' . $st['state_id'] . '">' . $st['state_name'] . '</option>';
                }
            } else {
                echo '<option value="">State not available</option>';
            }
        }

        // ajax for country end
        // ajax for state start

        if (isset($_POST["state_id"]) && !empty($_POST["state_id"])) {
            //Get all city data
            $contition_array = array('state_id' => $_POST["state_id"], 'status' => 1);
            $city = $this->data['city'] = $this->common->select_data_by_condition('cities', $contition_array, $data = '*', $sortby = 'city_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');


            //Display cities list
            if (count($city) > 0) {
                echo '<option value="">Select city</option>';
                foreach ($city as $cit) {
                    echo '<option value="' . $cit['city_id'] . '">' . $cit['city_name'] . '</option>';
                }
            } else {
                echo '<option value="">City not available</option>';
            }
        }

        // ajax for state end
    }

    public function freelancer_post_address_information_insert() {

        $userid = $this->session->userdata('aileenuser');

        if ($this->input->post('next')) {

            $this->form_validation->set_rules('country', 'Country', 'required');
            $this->form_validation->set_rules('state', 'State', 'required');

            $this->form_validation->set_rules('postaladdress', 'Address', 'required');


            if ($this->form_validation->run() == FALSE) {
                $this->load->view('freelancer/freelancer_post/freelancer_post_address_information');
            } else {


                $contition_array = array('user_id' => $userid, 'is_delete' => '0', 'status' => '1');

                $userdata = $this->common->select_data_by_condition('freelancer_post_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

                if ($userdata[0]['free_post_step'] == 7) {
                    $data = array(
                        'free_post_step' => 7
                    );

                    $updatedata = $this->common->update_data($data, 'freelancer_post_reg', 'user_id', $userid);
                } else if ($userdata[0]['free_post_step'] > 2) {
                    $data = array(
                        'free_post_step' => $userdata[0]['free_post_step']
                    );

                    $updatedata = $this->common->update_data($data, 'freelancer_post_reg', 'user_id', $userid);
                } else {
                    $data = array(
                        'free_post_step' => 2
                    );

                    $updatedata = $this->common->update_data($data, 'freelancer_post_reg', 'user_id', $userid);
                }

                $data = array(
                    'freelancer_post_country' => trim($this->input->post('country')),
                    'freelancer_post_state' => trim($this->input->post('state')),
                    'freelancer_post_city' => trim($this->input->post('city')),
                    'freelancer_post_address' => trim($this->input->post('postaladdress')),
                    'freelancer_post_pincode' => trim($this->input->post('pincode')),
                    'modify_date' => date('Y-m-d', time())
                );


                $updatdata = $this->common->update_data($data, 'freelancer_post_reg', 'user_id', $userid);


                if ($updatdata) {
                    $this->session->set_flashdata('success', 'Address information updated successfully');
                    redirect('freelancer/freelancer_post_professional_information', refresh);
                } else {
                    $this->session->flashdata('error', 'Your data not inserted');
                    redirect('freelancer/freelancer_post_address_information', refresh);
                }
            }
        }
    }

//freelancer address page controller End
//freelancer professional page controller Start
    public function freelancer_post_professional_information() {
        $userid = $this->session->userdata('aileenuser');


//if user deactive profile then redirect to freelancer/freelancer_post/freelancer_post_basic_information  start
        $contition_array = array('user_id'=> $userid,'status' => '0','is_delete'=> '0');

        $freelancerpost_deactive = $this->data['freelancerpost_deactive'] = $this->common->select_data_by_condition('freelancer_post_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);

        if( $freelancerpost_deactive)
        {
            redirect('freelancer/freelancer_post/freelancer_post_basic_information');
        }
    //if user deactive profile then redirect to freelancer/freelancer_post/freelancer_post_basic_information  End

        $contition_array = array('user_id' => $userid, 'is_delete' => '0', 'status' => '1');
        $userdata = $this->data['postdata'] = $this->common->select_data_by_condition('freelancer_post_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');


         $skildata = explode(',', $this->data['postdata'][0]['freelancer_post_area']);
         // echo "<pre>"; print_r($skildata); die();
        $this->data['selectdata'] = $skildata;

//           $json = [];

//         $this->load->database('aileensoul');

       
//         if (!empty($this->input->get("q"))) {
//      $search_condition = "(skill LIKE '" . trim($this->input->get("q")) . "%')";

//      $tolist = $this->common->select_data_by_search('skill', $search_condition,$contition_array = array(), $data = 'skill_id as id,skill as text', $sortby = 'skill', $orderby = 'desc', $limit = '', $offset = '', $join_str5 = '', $groupby = '');
   
// //echo '<pre>'; print_r($tolist); die();
//      }
//       //  echo json_encode($tolist);
//         echo json_encode($tolist);
    


        $contition_array = array('status' => 1);
        $this->data['category'] = $this->common->select_data_by_condition('category', $contition_array, $data = '*', $sortby = 'category_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');


        $contition_array = array('status' => 1, 'type' => 1);
        $this->data['skill1'] = $this->common->select_data_by_condition('skill', $contition_array, $data = '*', $sortby = 'skill', $orderby = 'DESC', $limit = '', $offset = '', $join_str = array(), $groupby = '');


        if ($userdata) {
            $step = $userdata[0]['free_post_step'];

            if ($step == 3 || ($step >= 1 && $step <= 3) || $step > 3) {

                $this->data['fields_req1'] = $userdata[0]['freelancer_post_field'];
                $this->data['area1'] = $userdata[0]['freelancer_post_area'];
                $this->data['otherskill1'] = $userdata[0]['freelancer_post_otherskill'];
                $this->data['skill_description1'] = $userdata[0]['freelancer_post_skill_description'];
                $this->data['experience_year1'] = $userdata[0]['freelancer_post_exp_year'];
                $this->data['experience_month1'] = $userdata[0]['freelancer_post_exp_month'];
            }
        }
        // $skildata = explode(',', $userdata[0]['freelancer_post_area']);
        // $this->data['selectdata'] = $skildata;



           $contition_array = array('status' => '1', 'is_delete' => '0','free_post_step' => 7);

        $freelancer_postdata = $this->data['results'] = $this->common->select_data_by_condition('freelancer_post_reg', $contition_array, $data = 'designation,freelancer_post_otherskill', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);
        // echo "<pre>"; print_r($freelancer_postdata);die();

        $contition_array = array('status' => '1', 'type' => '1');

        $skill = $this->data['results'] = $this->common->select_data_by_condition('skill', $contition_array, $data = 'skill', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);

 $contition_array = array('status' => '1');

        $results_post = $this->data['results'] = $this->common->select_data_by_condition('freelancer_post', $contition_array, $data = 'post_name', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);



        $contition_array = array('status' => '1', 'is_delete' => '0');

        $field = $this->data['results'] = $this->common->select_data_by_condition('category', $contition_array, $data = 'category_name', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);

        $uni = array_merge($skill, $freelancer_postdata, $field,$results_post);
        // echo count($unique);
        // $this->data['demo']=$uni;

        foreach ($uni as $key => $value) {
            foreach ($value as $ke => $val) {
                if ($val != "") {


                    $result[] = $val;
                }
            }
        }
        $results = array_unique($result);
        foreach($results as $key =>$value){
            $result1[$key]['label']=$value;
            $result1[$key]['value']=$value;
          }




 $contition_array = array('status' => '1');
          $location_list = $this->common->select_data_by_condition('cities', $contition_array, $data = 'city_name', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);
   

          foreach ($location_list as $key1 => $value1) {
              foreach ($value1 as $ke1 => $val1) {
                 $location[] = $val1;
              }
          }
          //echo "<pre>"; print_r($location);die();
          foreach ($location as $key => $value) {
              $loc[$key]['label'] =$value;
              $loc[$key]['value'] =$value;
          }
         
 //echo "<pre>"; print_r($loc);die();

        $this->data['city_data']= array_values($loc);
         
         $this->data['demo']= array_values($result1);


        $this->load->view('freelancer/freelancer_post/freelancer_post_professional_information', $this->data);
    }

    public function freelancer_post_professional_information_insert() {

        $userid = $this->session->userdata('aileenuser');
        $skill1 = $this->input->post('skills');


        if ($this->input->post('next')) {

            $this->form_validation->set_rules('field', 'Field', 'required');
            $this->form_validation->set_rules('skill_description', 'Skill Description', 'required');



            if ($this->form_validation->run() == FALSE) {
                $this->load->view('freelancer/freelancer_post/freelancer_post_professional_information');
            } else {

                $contition_array = array('user_id' => $userid, 'is_delete' => '0', 'status' => '1');

                $userdata = $this->common->select_data_by_condition('freelancer_post_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

                if ($userdata[0]['free_post_step'] == 7) {
                    $data = array(
                        'free_post_step' => 7
                    );

                    $updatedata = $this->common->update_data($data, 'freelancer_post_reg', 'user_id', $userid);
                } else if ($userdata[0]['free_post_step'] > 3) {
                    $data = array(
                        'free_post_step' => $userdata[0]['free_post_step']
                    );

                    $updatedata = $this->common->update_data($data, 'freelancer_post_reg', 'user_id', $userid);
                } else {
                    $data = array(
                        'free_post_step' => 3
                    );

                    $updatedata = $this->common->update_data($data, 'freelancer_post_reg', 'user_id', $userid);
                }

                $data = array(
                    'freelancer_post_field' => trim($this->input->post('field')),
                    'freelancer_post_area' => implode(',', $skill1),
                    'freelancer_post_otherskill' => trim($this->input->post('otherskill')),
                    'freelancer_post_skill_description' => trim($this->input->post('skill_description')),
                    'freelancer_post_exp_month' => trim($this->input->post('experience_month')),
                    'freelancer_post_exp_year' => trim($this->input->post('experience_year')),
                    'modify_date' => date('Y-m-d', time())
                );

                $updatdata = $this->common->update_data($data, 'freelancer_post_reg', 'user_id', $userid);


                if ($updatdata) {
                    $this->session->set_flashdata('success', 'professional information updated successfully');
                    redirect('freelancer/freelancer_post_rate', refresh);
                } else {
                    $this->session->flashdata('error', 'Your data not inserted');
                    redirect('freelancer/freelancer_post_professional_information', refresh);
                }
            }
        }
    }

//freelancer professional page controller End
//freelancer rate page controller Start 
    public function freelancer_post_rate() {
        $userid = $this->session->userdata('aileenuser');
        
//if user deactive profile then redirect to freelancer/freelancer_post/freelancer_post_basic_information  start
        $contition_array = array('user_id'=> $userid,'status' => '0','is_delete'=> '0');

        $freelancerpost_deactive = $this->data['freelancerpost_deactive'] = $this->common->select_data_by_condition('freelancer_post_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);

        if( $freelancerpost_deactive)
        {
            redirect('freelancer/freelancer_post/freelancer_post_basic_information');
        }
    //if user deactive profile then redirect to freelancer/freelancer_post/freelancer_post_basic_information  End

        $contition_array = array('status' => 1, 'is_delete' => 0);
        $this->data['currency'] = $this->common->select_data_by_condition('currency', $contition_array, $data = '*', $sortby = 'currency_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');



        $contition_array = array('user_id' => $userid, 'is_delete' => '0', 'status' => '1');
        $userdata = $this->common->select_data_by_condition('freelancer_post_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        if ($userdata) {
            $step = $userdata[0]['free_post_step'];

            if ($step == 4 || ($step >= 1 && $step <= 4) || $step > 4) {

                $this->data['hourly1'] = $userdata[0]['freelancer_post_hourly'];
                $this->data['currency1'] = $userdata[0]['freelancer_post_ratestate'];
                $this->data['fixed_rate1'] = $userdata[0]['freelancer_post_fixed_rate'];
            }
//echo "<pre>";print_r( $this->data['fixed_rate1']);die();
        }
           $contition_array = array('status' => '1', 'is_delete' => '0','free_post_step' => 7);

        $freelancer_postdata = $this->data['results'] = $this->common->select_data_by_condition('freelancer_post_reg', $contition_array, $data = 'designation,freelancer_post_otherskill', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);
        // echo "<pre>"; print_r($freelancer_postdata);die();

        $contition_array = array('status' => '1', 'type' => '1');

        $skill = $this->data['results'] = $this->common->select_data_by_condition('skill', $contition_array, $data = 'skill', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);

         $contition_array = array('status' => '1');

        $results_post = $this->data['results'] = $this->common->select_data_by_condition('freelancer_post', $contition_array, $data = 'post_name', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);


        $contition_array = array('status' => '1', 'is_delete' => '0');

        $field = $this->data['results'] = $this->common->select_data_by_condition('category', $contition_array, $data = 'category_name', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);

        $uni = array_merge($skill, $freelancer_postdata, $field,$results_post);
        // echo count($unique);
        // $this->data['demo']=$uni;

        foreach ($uni as $key => $value) {
            foreach ($value as $ke => $val) {
                if ($val != "") {


                    $result[] = $val;
                }
            }
        }
        $results = array_unique($result);
        foreach($results as $key =>$value){
            $result1[$key]['label']=$value;
            $result1[$key]['value']=$value;
          }

          $contition_array = array('status' => '1');
          $location_list = $this->common->select_data_by_condition('cities', $contition_array, $data = 'city_name', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);
   

          foreach ($location_list as $key1 => $value1) {
              foreach ($value1 as $ke1 => $val1) {
                 $location[] = $val1;
              }
          }
          //echo "<pre>"; print_r($location);die();
          foreach ($location as $key => $value) {
              $loc[$key]['label'] =$value;
              $loc[$key]['value'] =$value;
          }
         
 //echo "<pre>"; print_r($loc);die();

        $this->data['city_data']= array_values($loc);
         $this->data['demo']= array_values($result1);



        $this->load->view('freelancer/freelancer_post/freelancer_post_rate', $this->data);
    }

    public function freelancer_post_rate_insert() {

        $userid = $this->session->userdata('aileenuser');

        if ($this->input->post('next')) {

            if ($this->input->post('fixed_rate') == 1) {
                $data = array(
                    'freelancer_post_fixed_rate' => trim($this->input->post('fixed_rate')),
                );
            } else {
                $data = array(
                    'freelancer_post_fixed_rate' => 0,
                );
            }

            $updatdata = $this->common->update_data($data, 'freelancer_post_reg', 'user_id', $userid);


            $contition_array = array('user_id' => $userid, 'is_delete' => '0', 'status' => '1');

            $userdata = $this->common->select_data_by_condition('freelancer_post_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

            if ($userdata[0]['free_post_step'] == 7) {
                $data = array(
                    'free_post_step' => 7
                );

                $updatedata = $this->common->update_data($data, 'freelancer_post_reg', 'user_id', $userid);
            } else if ($userdata[0]['free_post_step'] > 4) {
                $data = array(
                    'free_post_step' => $userdata[0]['free_post_step']
                );

                $updatedata = $this->common->update_data($data, 'freelancer_post_reg', 'user_id', $userid);
            } else {
                $data = array(
                    'free_post_step' => 4
                );

                $updatedata = $this->common->update_data($data, 'freelancer_post_reg', 'user_id', $userid);
            }

            $data = array(
                'freelancer_post_hourly' => trim($this->input->post('hourly')),
                'freelancer_post_ratestate' => trim($this->input->post('state')),
                'modify_date' => date('Y-m-d', time())
            );

            //echo "<pre>";print_r( $data);die();
            $updatdata = $this->common->update_data($data, 'freelancer_post_reg', 'user_id', $userid);

            if ($updatdata) {
                $this->session->set_flashdata('success', 'Rate information updated successfully');
                redirect('freelancer/freelancer_post_avability', refresh);
            } else {
                $this->session->flashdata('error', 'Your data not inserted');
                redirect('freelancer/freelancer_post_rate', refresh);
            }
            //}
        }
    }

//freelancer rate page controller End
//freelancer avability page controller Start
    public function freelancer_post_avability() {
        $userid = $this->session->userdata('aileenuser');


//if user deactive profile then redirect to freelancer/freelancer_post/freelancer_post_basic_information  start
        $contition_array = array('user_id'=> $userid,'status' => '0','is_delete'=> '0');

        $freelancerpost_deactive = $this->data['freelancerpost_deactive'] = $this->common->select_data_by_condition('freelancer_post_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);

        if( $freelancerpost_deactive)
        {
            redirect('freelancer/freelancer_post/freelancer_post_basic_information');
        }
    //if user deactive profile then redirect to freelancer/freelancer_post/freelancer_post_basic_information  End


        $contition_array = array('user_id' => $userid, 'is_delete' => '0', 'status' => '1');
        $userdata = $this->common->select_data_by_condition('freelancer_post_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        if ($userdata) {
            $step = $userdata[0]['free_post_step'];

            if ($step == 5 || ($step >= 1 && $step <= 5) || $step > 5) {

                $this->data['job_type1'] = $userdata[0]['freelancer_post_job_type'];
                $this->data['work_hour1'] = $userdata[0]['freelancer_post_work_hour'];
            }
        }

           $contition_array = array('status' => '1', 'is_delete' => '0','free_post_step' => 7);

        $freelancer_postdata = $this->data['results'] = $this->common->select_data_by_condition('freelancer_post_reg', $contition_array, $data = 'designation,freelancer_post_otherskill', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);
        // echo "<pre>"; print_r($freelancer_postdata);die();

        $contition_array = array('status' => '1', 'type' => '1');

        $skill = $this->data['results'] = $this->common->select_data_by_condition('skill', $contition_array, $data = 'skill', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);

         $contition_array = array('status' => '1');

        $results_post = $this->data['results'] = $this->common->select_data_by_condition('freelancer_post', $contition_array, $data = 'post_name', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);


        $contition_array = array('status' => '1', 'is_delete' => '0');

        $field = $this->data['results'] = $this->common->select_data_by_condition('category', $contition_array, $data = 'category_name', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);

        $uni = array_merge($skill, $freelancer_postdata, $field,$results_post);
        // echo count($unique);
        // $this->data['demo']=$uni;

        foreach ($uni as $key => $value) {
            foreach ($value as $ke => $val) {
                if ($val != "") {


                    $result[] = $val;
                }
            }
        }
        $results = array_unique($result);
        foreach($results as $key =>$value){
            $result1[$key]['label']=$value;
            $result1[$key]['value']=$value;
          }


 $contition_array = array('status' => '1');
          $location_list = $this->common->select_data_by_condition('cities', $contition_array, $data = 'city_name', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);
   

          foreach ($location_list as $key1 => $value1) {
              foreach ($value1 as $ke1 => $val1) {
                 $location[] = $val1;
              }
          }
          //echo "<pre>"; print_r($location);die();
          foreach ($location as $key => $value) {
              $loc[$key]['label'] =$value;
              $loc[$key]['value'] =$value;
          }
         
 //echo "<pre>"; print_r($loc);die();

        $this->data['city_data']= array_values($loc);
         
         $this->data['demo']= array_values($result1);


        $this->load->view('freelancer/freelancer_post/freelancer_post_avability', $this->data);
    }

    public function freelancer_post_avability_insert() {

        $userid = $this->session->userdata('aileenuser');


        if ($this->input->post('previous')) {
            redirect('freelancer/freelancer_post_rate', refresh);
        }

        if ($this->input->post('next')) {

            $contition_array = array('user_id' => $userid, 'is_delete' => '0', 'status' => '1');

            $userdata = $this->common->select_data_by_condition('freelancer_post_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

            if ($userdata[0]['free_post_step'] == 7) {
                $data = array(
                    'free_post_step' => 7
                );

                $updatedata = $this->common->update_data($data, 'freelancer_post_reg', 'user_id', $userid);
            } else if ($userdata[0]['free_post_step'] > 5) {
                $data = array(
                    'free_post_step' => $userdata[0]['free_post_step']
                );

                $updatedata = $this->common->update_data($data, 'freelancer_post_reg', 'user_id', $userid);
            } else {
                $data = array(
                    'free_post_step' => 5
                );

                $updatedata = $this->common->update_data($data, 'freelancer_post_reg', 'user_id', $userid);
            }

            $data = array(
                'freelancer_post_job_type' => trim($this->input->post('job_type')),
                'freelancer_post_work_hour' => trim($this->input->post('work_hour')),
                'modify_date' => date('Y-m-d', time())
            );


            $updatdata = $this->common->update_data($data, 'freelancer_post_reg', 'user_id', $userid);


            if ($updatdata) {
                $this->session->set_flashdata('success', 'Avability information updated successfully');
                redirect('freelancer/freelancer_post_education', refresh);
            } else {
                $this->session->flashdata('error', 'Your data not inserted');
                redirect('freelancer/freelancer_post_avability', refresh);
            }
            //}
        }
    }

//freelancer avability page controller End
//freelancer education page controller Start
    public function freelancer_post_education() {
        $userid = $this->session->userdata('aileenuser');

//if user deactive profile then redirect to freelancer/freelancer_post/freelancer_post_basic_information  start
        $contition_array = array('user_id'=> $userid,'status' => '0','is_delete'=> '0');

        $freelancerpost_deactive = $this->data['freelancerpost_deactive'] = $this->common->select_data_by_condition('freelancer_post_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);

        if( $freelancerpost_deactive)
        {
            redirect('freelancer/freelancer_post/freelancer_post_basic_information');
        }
    //if user deactive profile then redirect to freelancer/freelancer_post/freelancer_post_basic_information  End

        $contition_array = array('status' => 1);
        $this->data['degree_data'] = $this->common->select_data_by_condition('degree', $contition_array, $data = '*', $sortby = 'degree_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        //for getting stream data
        $contition_array = array('status' => 1);
        $this->data['stream_data'] = $this->common->select_data_by_condition('stream', $contition_array, $data = '*', $sortby = 'stream_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');


         //for getting univesity data Start
          $contition_array = array('is_delete' => '0','university_name !=' => "Other");
          $search_condition = "((status = '2' AND user_id = $userid) OR (status = '1'))";
           $university_data = $this->data['university_data'] = $this->common->select_data_by_search('university', $search_condition, $contition_array, $data = '*', $sortby = 'university_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');

         $contition_array = array('is_delete' => '0' , 'status' => 1,'university_name' => "Other");
        $this->data['university_otherdata'] = $this->common->select_data_by_condition('university', $contition_array, $data = '*', $sortby = 'university_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');
         
        //for getting univesity data End


        $contition_array = array('user_id' => $userid, 'is_delete' => '0', 'status' => '1');
        $userdata = $this->common->select_data_by_condition('freelancer_post_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        if ($userdata) {
            $step = $userdata[0]['free_post_step'];

            if ($step == 6 || ($step >= 1 && $step <= 6) || $step > 6) {

                $this->data['degree1'] = $userdata[0]['freelancer_post_degree'];
                $this->data['stream1'] = $userdata[0]['freelancer_post_stream'];
                $this->data['university1'] = $userdata[0]['freelancer_post_univercity'];
                $this->data['college1'] = $userdata[0]['freelancer_post_collage'];
                $this->data['percentage1'] = $userdata[0]['freelancer_post_percentage'];
                $this->data['pass_year1'] = $userdata[0]['freelancer_post_passingyear'];
            }
        }

           $contition_array = array('status' => '1', 'is_delete' => '0','free_post_step' => 7);

        $freelancer_postdata = $this->data['results'] = $this->common->select_data_by_condition('freelancer_post_reg', $contition_array, $data = 'designation,freelancer_post_otherskill', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);
        // echo "<pre>"; print_r($freelancer_postdata);die();

        $contition_array = array('status' => '1', 'type' => '1');

        $skill = $this->data['results'] = $this->common->select_data_by_condition('skill', $contition_array, $data = 'skill', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);


         $contition_array = array('status' => '1');

        $results_post = $this->data['results'] = $this->common->select_data_by_condition('freelancer_post', $contition_array, $data = 'post_name', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);


        $contition_array = array('status' => '1', 'is_delete' => '0');

        $field = $this->data['results'] = $this->common->select_data_by_condition('category', $contition_array, $data = 'category_name', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);

        $uni = array_merge($skill, $freelancer_postdata, $field,$results_post);
        // echo count($unique);
        // $this->data['demo']=$uni;

        foreach ($uni as $key => $value) {
            foreach ($value as $ke => $val) {
                if ($val != "") {


                    $result[] = $val;
                }
            }
        }
        $results = array_unique($result);
        foreach($results as $key =>$value){
            $result1[$key]['label']=$value;
            $result1[$key]['value']=$value;
          }


 $contition_array = array('status' => '1');
          $location_list = $this->common->select_data_by_condition('cities', $contition_array, $data = 'city_name', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);
   

          foreach ($location_list as $key1 => $value1) {
              foreach ($value1 as $ke1 => $val1) {
                 $location[] = $val1;
              }
          }
          //echo "<pre>"; print_r($location);die();
          foreach ($location as $key => $value) {
              $loc[$key]['label'] =$value;
              $loc[$key]['value'] =$value;
          }
         
 //echo "<pre>"; print_r($loc);die();

        $this->data['city_data']= array_values($loc);
         
         $this->data['demo']= array_values($result1);



        $this->load->view('freelancer/freelancer_post/freelancer_post_education', $this->data);
    }

    //add other_university into database start 
    public function freelancer_other_university(){
         $other_university = $_POST['other_university'];
         $this->data['userid'] = $userid = $this->session->userdata('aileenuser');

         $contition_array = array('is_delete' => '0','university_name' => $other_university);
         $search_condition = "((status = '2' AND user_id = $userid) OR (status = '1'))";
              $userdata = $this->data['userdata'] = $this->common->select_data_by_search('university', $search_condition, $contition_array, $data = '*', $sortby = 'university_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');
              $count=count($userdata);



     if($other_university != NULL)
     {
        if($count==0)
        {
                  $data = array(
                    'university_name' => $other_university,
                     'created_date' => date('Y-m-d h:i:s', time()),
                     'status' => 2,
                    'is_delete' => 0,
                    'is_other' => '1',
                    'user_id' => $userid
                    );
        $insert_id = $this->common->insert_data_getid($data, 'university');
                if($insert_id) 
                {
        
             $contition_array = array('is_delete' => '0','university_name !=' => "Other");
             $search_condition = "((status = '2' AND user_id = $userid) OR (status = '1'))";
               $university = $this->data['university'] = $this->common->select_data_by_search('university', $search_condition, $contition_array, $data = '*', $sortby = 'university_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');
           
                if (count($university) > 0) {
                $select = '<option value="" selected option disabled>Select your University</option>';
                
                foreach ($university as $st) {
                $select .= '<option value="' . $st['university_id'] . '"';
                 if($st['university_name'] == $other_university){
                            $select .= 'selected'; 
                       }
                       $select .=    '>' . $st['university_name'] . '</option>';
                 
                    }      
                }  
//For Getting Other at end
$contition_array = array('is_delete' => '0' , 'status' => 1,'university_name' => "Other");
$university_otherdata = $this->common->select_data_by_condition('university', $contition_array, $data = '*', $sortby = 'university_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');  
     
 $select .= '<option value="' . $university_otherdata[0]['university_id'] . '">' . $university_otherdata[0]['university_name'] . '</option>';   
        
//  //for getting university data in clone start
// $select1 = '<option value="" selected option disabled>Select your University</option>';
//  foreach ($university as $st) {
    
//      $select1 .= '<option value="' . $st['university_id'] . '">'. $st['university_name'] .'</option>';
     
//  }
//  $select1 .= '<option value="' . $university_otherdata[0]['university_id'] . '">' . $university_otherdata[0]['university_name'] . '</option>';   
//  //for getting university data in clone End
 
                 }
    }
    
  
    else{
            $select .= 0;
            }
    }
     else
    {
        $select .= 1;
    }


  echo json_encode(array(
                            "select" => $select,
                   ));


    }
    public function freelancer_post_education_insert() {

        $userid = $this->session->userdata('aileenuser');




        // if ($this->input->post('next')) {

        //     $this->form_validation->set_rules('degree', 'Degree', 'required');
        //     $this->form_validation->set_rules('stream', 'Stream', 'required');
        //     $this->form_validation->set_rules('university', 'University', 'required');
        //     $this->form_validation->set_rules('college', 'Collage', 'required');
        //     $this->form_validation->set_rules('percentage', 'Percentage', 'required');
        //     $this->form_validation->set_rules('passingyear', 'Passing Year', 'required');




        //     if ($this->form_validation->run() == FALSE) {
        //         $this->load->view('freelancer/freelancer_post/freelancer_post_education');
        //     } else {

                $contition_array = array('user_id' => $userid, 'is_delete' => '0', 'status' => '1');

                $userdata = $this->common->select_data_by_condition('freelancer_post_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

                if ($userdata[0]['free_post_step'] == 7) {
                    $data = array(
                        'free_post_step' => 7
                    );

                    $updatedata = $this->common->update_data($data, 'freelancer_post_reg', 'user_id', $userid);
                } else if ($userdata[0]['free_post_step'] > 6) {
                    $data = array(
                        'free_post_step' => $userdata[0]['free_post_step']
                    );

                    $updatedata = $this->common->update_data($data, 'freelancer_post_reg', 'user_id', $userid);
                } else {
                    $data = array(
                        'free_post_step' => 6
                    );

                    $updatedata = $this->common->update_data($data, 'freelancer_post_reg', 'user_id', $userid);
                }

                $data = array(
                    'freelancer_post_degree' => trim($this->input->post('degree')),
                    'freelancer_post_stream' => trim($this->input->post('stream')),
                    'freelancer_post_univercity' => trim($this->input->post('university')),
                    'freelancer_post_collage' => trim($this->input->post('college')),
                    'freelancer_post_percentage' => trim($this->input->post('percentage')),
                    'freelancer_post_passingyear' => trim($this->input->post('passingyear')),
                    'modify_date' => date('Y-m-d', time())
                );


                $updatdata = $this->common->update_data($data, 'freelancer_post_reg', 'user_id', $userid);


                if ($updatdata) {
                    $this->session->set_flashdata('success', 'Education information updated successfully');
                    redirect('freelancer/freelancer_post_portfolio', refresh);
                } else {
                    $this->session->flashdata('error', 'Your data not inserted');
                    redirect('freelancer/freelancer_post_education', refresh);
                }
            
        
    }

//freelancer education page controller End
//freelancer Portfolio page controller Start
    public function freelancer_post_portfolio() {
        $userid = $this->session->userdata('aileenuser');

//if user deactive profile then redirect to freelancer/freelancer_post/freelancer_post_basic_information  start
        $contition_array = array('user_id'=> $userid,'status' => '0','is_delete'=> '0');

        $freelancerpost_deactive = $this->data['freelancerpost_deactive'] = $this->common->select_data_by_condition('freelancer_post_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);

        if( $freelancerpost_deactive)
        {
            redirect('freelancer/freelancer_post/freelancer_post_basic_information');
        }
    //if user deactive profile then redirect to freelancer/freelancer_post/freelancer_post_basic_information  End

        $contition_array = array('user_id' => $userid, 'is_delete' => '0', 'status' => '1');

        $userdata = $this->common->select_data_by_condition('freelancer_post_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        if ($userdata) {
            $step = $userdata[0]['free_post_step'];

            if ($step == 7 || ($step >= 1 && $step <= 7) || $step > 7) {

                $this->data['portfolio1'] = $userdata[0]['freelancer_post_portfolio'];
                $this->data['portfolio_attachment1'] = $userdata[0]['freelancer_post_portfolio_attachment'];
            }
        }
           $contition_array = array('status' => '1', 'is_delete' => '0','free_post_step' => 7);

        $freelancer_postdata = $this->data['results'] = $this->common->select_data_by_condition('freelancer_post_reg', $contition_array, $data = 'designation,freelancer_post_otherskill', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);
        // echo "<pre>"; print_r($freelancer_postdata);die();

        $contition_array = array('status' => '1', 'type' => '1');

        $skill = $this->data['results'] = $this->common->select_data_by_condition('skill', $contition_array, $data = 'skill', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);



         $contition_array = array('status' => '1');

        $results_post = $this->data['results'] = $this->common->select_data_by_condition('freelancer_post', $contition_array, $data = 'post_name', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);


        $contition_array = array('status' => '1', 'is_delete' => '0');

        $field = $this->data['results'] = $this->common->select_data_by_condition('category', $contition_array, $data = 'category_name', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);

        $uni = array_merge($skill, $freelancer_postdata, $field,$results_post);
        // echo count($unique);
        // $this->data['demo']=$uni;

        foreach ($uni as $key => $value) {
            foreach ($value as $ke => $val) {
                if ($val != "") {


                    $result[] = $val;
                }
            }
        }
        $results = array_unique($result);
        foreach($results as $key =>$value){
            $result1[$key]['label']=$value;
            $result1[$key]['value']=$value;
          }

         
 $contition_array = array('status' => '1');
          $location_list = $this->common->select_data_by_condition('cities', $contition_array, $data = 'city_name', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);
   

          foreach ($location_list as $key1 => $value1) {
              foreach ($value1 as $ke1 => $val1) {
                 $location[] = $val1;
              }
          }
          //echo "<pre>"; print_r($location);die();
          foreach ($location as $key => $value) {
              $loc[$key]['label'] =$value;
              $loc[$key]['value'] =$value;
          }
         
 //echo "<pre>"; print_r($loc);die();

        $this->data['city_data']= array_values($loc);


         $this->data['demo']= array_values($result1);



        $this->load->view('freelancer/freelancer_post/freelancer_post_portfolio', $this->data);
    }

    public function freelancer_post_portfolio_insert() {
        
        //echo '<pre>'; print_r($_POST); 
        //echo '<pre>'; print_r($_FILES); die();
       // echo "hii";die();

         $portfolio = $_POST['portfolio']; 
         //echo $portfolio;
         
         //die();

       
         
        

        $userid = $this->session->userdata('aileenuser');




        $contition_array = array('user_id' => $userid, 'is_delete' => '0', 'status' => '1');

        $userdatacon = $this->common->select_data_by_condition('freelancer_post_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');


         $portfolio = trim($_POST['portfolio']);
        
         $image_hidden_portfolio = $_POST['image_hidden_portfolio'];
         $config = array(
            'upload_path' => $this->config->item('free_portfolio_main_upload_path'),
            'max_size' => 2500000000000,
            'allowed_types' => $this->config->item('free_portfolio_main_allowed_types'),
            'file_name' => $_FILES['freelancer_post_portfolio_attachment']['name']
               
        );

        // echo "<pre>"; print_r($config); die();

        //Load upload library and initialize configuration
          $images = array();
        

        $files = $_FILES;
       
        $this->load->library('upload');

            $fileName = $_FILES['image']['name'];
            $images[] = $fileName;
            $config['file_name'] = $fileName;

         $this->upload->initialize($config);
        $this->upload->do_upload();

            
        if ($this->upload->do_upload('image')) {
           // echo "hi"; die();

            // $uploadData = $this->upload->data();

            // $picture = $uploadData['file_name'];

             $response['result']= $this->upload->data();
            // echo "<pre>"; print_r($response['result']); die();
                $art_post_thumb['image_library'] = 'gd2';
                $art_post_thumb['source_image'] = $this->config->item('free_portfolio_main_upload_path') . $response['result']['file_name'];
                $art_post_thumb['new_image'] = $this->config->item('free_portfolio_thumb_upload_path') . $response['result']['file_name'];
                $art_post_thumb['create_thumb'] = TRUE;
                $art_post_thumb['maintain_ratio'] = TRUE;
                $art_post_thumb['thumb_marker'] = '';
                $art_post_thumb['width'] = $this->config->item('art_portfolio_thumb_width');
                //$product_thumb[$i]['height'] = $this->config->item('product_thumb_height');
                $art_post_thumb['height'] = 2;
                $art_post_thumb['master_dim'] = 'width';
                $art_post_thumb['quality'] = "100%";
                $art_post_thumb['x_axis'] = '0';
                $art_post_thumb['y_axis'] = '0';
                $instanse = "image_$i";
                //Loading Image Library
                $this->load->library('image_lib', $art_post_thumb, $instanse);
                $dataimage = $response['result']['file_name'];

                                //Creating Thumbnail
                $this->$instanse->resize();
                $response['error'][] = $thumberror = $this->$instanse->display_errors();
                
                
                $return['data'][] = $this->upload->data();
                $return['status'] = "success";
                $return['msg'] = sprintf($this->lang->line('success_item_added'), "Image", "uploaded");

      
        } 

        else {

            $dataimage = $image_hidden_portfolio;
        }

       //echo "<pre>"; print_r($dataimage); die();

        //if ($dataimage) {
            $data = array(
                'freelancer_post_portfolio_attachment' => $dataimage,
                'freelancer_post_portfolio' => $portfolio,
                'modify_date' => date('Y-m-d', time()),
                'free_post_step' => 7
            );


            $updatdata = $this->common->update_data($data, 'freelancer_post_reg', 'user_id', $userid);
       // } 
        //    if ($portfolio || $portfolio == '') {


        //     $data = array(
        //         //'art_bestofmine' => $picture,
        //         'freelancer_post_portfolio' => $portfolio,
        //         'modify_date' => date('Y-m-d', time()),
        //         'free_post_step' => 7
        //     );


        //     $updatdata = $this->common->update_data($data, 'freelancer_post_reg', 'user_id', $userid);
        // }

//echo "<pre>"; print_r($updatdata); die();

        

    }

//freelancer Portfolio page controller End

    public function freelancer_hire_post($id) {
        $userid = $this->session->userdata('aileenuser');
//if user deactive profile then redirect to freelancer_hire/freelancer_hire/freelancer_hire_basic_info  start
 $contition_array = array('user_id'=> $userid,'status' => '0','is_delete'=> '0');
        $freelancerhire_deactive = $this->data['freelancerhire_deactive'] = $this->common->select_data_by_condition('freelancer_hire_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);
        if( $freelancerhire_deactive)
        {
            redirect('freelancer_hire/freelancer_hire/freelancer_hire_basic_info');
        }
//if user deactive profile then redirect to freelancer_hire/freelancer_hire/freelancer_hire_basic_info  start

        if($id == ''){
        $join_str[0]['table'] = 'freelancer_hire_reg';
        $join_str[0]['join_table_id'] = 'freelancer_hire_reg.user_id';
        $join_str[0]['from_table_id'] = 'freelancer_post.user_id';
        $join_str[0]['join_type'] = 'RIGHT';

        $contition_array = array('freelancer_post.is_delete'=> '0','freelancer_hire_reg.user_id' => $userid, 'freelancer_hire_reg.status' => '1' ,'freelancer_hire_reg.free_hire_step' => 3);

$data='freelancer_post.post_id,freelancer_post.post_name,freelancer_post.post_field_req,freelancer_post.post_est_time,freelancer_post.post_skill,freelancer_post.post_other_skill,freelancer_post.post_rate,freelancer_post.post_last_date,freelancer_post.post_description,freelancer_post.user_id,freelancer_post.created_date,freelancer_post.post_currency,freelancer_post.post_rating_type,freelancer_post.country,freelancer_post.city,freelancer_post.post_exp_month,freelancer_post.post_exp_year,freelancer_hire_reg.username,freelancer_hire_reg.fullname,freelancer_hire_reg.designation,freelancer_hire_reg.freelancer_hire_user_image';
        $postdata = $this->data['freelancerpostdata'] = $this->common->select_data_by_condition('freelancer_post', $contition_array, $data, $sortby = 'freelancer_post.post_id', $orderby = 'desc', $limit = '', $offset = '', $join_str, $groupby = '');

        }
        else{
            $userid=$id;
            //echo $userid; 
          $join_str[0]['table'] = 'freelancer_hire_reg';
          $join_str[0]['join_table_id'] = 'freelancer_hire_reg.user_id';
          $join_str[0]['from_table_id'] = 'freelancer_post.user_id';
          $join_str[0]['join_type'] = '';
            
      $contition_array = array('freelancer_post.is_delete'=> '0','freelancer_hire_reg.user_id' => $userid, 'freelancer_hire_reg.status' => '1','freelancer_hire_reg.free_hire_step' => 3);
     $data='freelancer_post.post_id,freelancer_post.post_name,freelancer_post.post_field_req,freelancer_post.post_est_time,freelancer_post.post_skill,freelancer_post.post_other_skill,freelancer_post.post_rate,freelancer_post.post_last_date,freelancer_post.post_description,freelancer_post.user_id,freelancer_post.created_date,freelancer_post.post_currency,freelancer_post.post_rating_type,freelancer_post.country,freelancer_post.city,freelancer_post.post_exp_month,freelancer_post.post_exp_year,freelancer_hire_reg.username,freelancer_hire_reg.fullname,freelancer_hire_reg.designation,freelancer_hire_reg.freelancer_hire_user_image';
        $postdata = $this->data['freelancerpostdata'] = $this->common->select_data_by_condition('freelancer_post', $contition_array, $data, $sortby = 'freelancer_post.post_id', $orderby = 'desc', $limit = '', $offset = '', $join_str, $groupby = '');
        }

// code for search
        $contition_array = array('status' => '1', 'is_delete' => '0');

        $field = $this->data['results'] = $this->common->select_data_by_condition('category', $contition_array, $data = 'category_name', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);

        $contition_array = array('status' => '1', 'is_delete' => '0','free_post_step' => 7);
        $freelancer_postdata = $this->data['results'] = $this->common->select_data_by_condition('freelancer_post_reg', $contition_array, $data = 'freelancer_post_otherskill,designation', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);

        $contition_array = array('status' => '1', 'type' => '1');
        $skill = $this->data['skill'] = $this->common->select_data_by_condition('skill', $contition_array, $data = 'skill', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);

        $unique = array_merge($field, $skill, $freelancer_postdata);
  
        foreach ($unique as $key => $value) {
            foreach ($value as $ke => $val) {
                if ($val != "") {
                    $result[] = $val;
                }
            }
        }
$results = array_unique($result);
        foreach($results as $key =>$value){
            $result1[$key]['label']=$value;
            $result1[$key]['value']=$value;
          }
 $contition_array = array('status' => '1');
          $location_list = $this->common->select_data_by_condition('cities', $contition_array, $data = 'city_name', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);
          foreach ($location_list as $key1 => $value1) {
              foreach ($value1 as $ke1 => $val1) {
                 $location[] = $val1;
              }
          }
          foreach ($location as $key => $value) {
              $loc[$key]['label'] =$value;
              $loc[$key]['value'] =$value;
          }
        $this->data['city_data']= array_values($loc);
        $this->data['demo']= array_values($result1);
        $this->load->view('freelancer/freelancer_hire/freelancer_hire_post', $this->data);
    }

    public function freelancer_add_post() {
        $userid = $this->session->userdata('aileenuser');

//if user deactive profile then redirect to freelancer_hire/freelancer_hire/freelancer_hire_basic_info  start
  
 $contition_array = array('user_id'=> $userid,'status' => '0','is_delete'=> '0');

        $freelancerhire_deactive = $this->data['freelancerhire_deactive'] = $this->common->select_data_by_condition('freelancer_hire_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);

        if( $freelancerhire_deactive)
        {
            redirect('freelancer_hire/freelancer_hire/freelancer_hire_basic_info');
        }
//if user deactive profile then redirect to freelancer_hire/freelancer_hire/freelancer_hire_basic_info  start

        $contition_array = array('status' => 1);
        $this->data['countries'] = $this->common->select_data_by_condition('countries', $contition_array, $data = '*', $sortby = 'country_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');


        $contition_array = array('status' => 1);
        $this->data['category'] = $this->common->select_data_by_condition('category', $contition_array, $data = '*', $sortby = 'category_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        $contition_array = array('status' => 1);
        $this->data['currency'] = $this->common->select_data_by_condition('currency', $contition_array, $data = '*', $sortby = 'currency_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        $contition_array = array('user_id' => $userid, 'status' => '1');
        $this->data['freelancerdata'] = $this->common->select_data_by_condition('freelancer_hire_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');


        //code for search 
        $contition_array = array('status' => '1', 'is_delete' => '0');

        $field = $this->data['results'] = $this->common->select_data_by_condition('category', $contition_array, $data = 'category_name', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);


        $contition_array = array('status' => '1', 'is_delete' => '0','free_post_step' => 7);

        $freelancer_postdata = $this->data['results'] = $this->common->select_data_by_condition('freelancer_post_reg', $contition_array, $data = 'freelancer_post_otherskill,designation', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);
        // echo "<pre>"; print_r($results_recruiter);die();

        $contition_array = array('status' => '1', 'type' => '1');

        $skill = $this->data['skill'] = $this->common->select_data_by_condition('skill', $contition_array, $data = 'skill', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);

        $unique = array_merge($field, $skill, $freelancer_postdata);
        // echo count($unique);
        // $this->data['demo']=$unique;


        foreach ($unique as $key => $value) {
            foreach ($value as $ke => $val) {
                if ($val != "") {


                    $result[] = $val;
                }
            }
        }
$results = array_unique($result);
        foreach($results as $key =>$value){
            $result1[$key]['label']=$value;
            $result1[$key]['value']=$value;
          }
 $contition_array = array('status' => '1');
          $location_list = $this->common->select_data_by_condition('cities', $contition_array, $data = 'city_name', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);
   

          foreach ($location_list as $key1 => $value1) {
              foreach ($value1 as $ke1 => $val1) {
                 $location[] = $val1;
              }
          }
          //echo "<pre>"; print_r($location);die();
          foreach ($location as $key => $value) {
              $loc[$key]['label'] =$value;
              $loc[$key]['value'] =$value;
          }
         
 //echo "<pre>"; print_r($loc);die();

        $this->data['city_data']= array_values($loc);

         
         $this->data['demo']= array_values($result1);


// code for search end

        $this->load->view('freelancer/freelancer_hire/freelancer_add_post', $this->data);
    }

   // khyati changes start 7-4
    public  function aasort (&$array, $key) {
      $sorter=array();    $ret=array();    reset($array); 

         foreach ($array as $ii => $va) {       

          $sorter[$ii]=$va[$key];    

        }   

         asort($sorter);  

           foreach ($sorter as $ii => $va) {    

               $ret[$ii]=$array[$ii];   

                }  

     return  $array=$ret;


  }

public function ajax_dataforcity() {
//echo "hello"; 
//echo "falguni"; die();
      
     // $_POST["country_id"] = ;

//        if(isset($_POST["country_id"]) && !empty($_POST["country_id"])){ 
//     //Get all state data
//          $contition_array = array('country_id' => $_POST["country_id"] , 'status' => 1);

//      $state =  $this->data['states'] =  $this->common->select_data_by_condition('states', $contition_array, $data = '*', $sortby = 'state_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');

//      foreach ($state as $st) { 

//       $contition_array = array('state_id' => $st["state_id"] , 'status' => 1);

//       $this->data['finalcitylist'] =  $this->common->select_data_by_condition('cities', $contition_array, $data = '*', $sortby = 'city_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');
      

//       $city[] = $this->data['finalcitylist'];
//      }
  
//      $this->data['city'] = $city;
//      //echo "<pre>"; print_r($this->data['city']);die();
    
//     //Count total number of rows

// $new = array();
//      foreach($city as $key => $val){
//      foreach($val as $key1 => $val1){

//       $return = array();
//      // $return = $val1;
//        $return['city_id'] = $val1['city_id'];
//        $return['city_name'] = $val1['city_name'];
       
//        array_push($new,$return);
//      }
      
//      }
    
  

//    $citdata =  $this->aasort($new,"city_name");

//     //Display states list
//     if(count($citdata) > 0){ 
//         echo '<option value="">Select City</option>';
//      foreach($citdata as $ct){
      

//         echo '<option value="'.$ct['city_id'].'">'.$ct['city_name'].'</option>';
     
//        }
//     }else{  
//         echo '<option value="">City not available</option>';
//     }
// }



//ajax data for country and state and city
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

// khyati changes end 7-4

    public function freelancer_add_post_insert() {
        $userid = $this->session->userdata('aileenuser');
        $skills = $this->input->post('skills');

        $this->form_validation->set_rules('post_name', 'Post Name', 'required');
        $this->form_validation->set_rules('post_desc', 'Post description', 'required');
        $this->form_validation->set_rules('fields_req', 'Field required', 'required');

       // $this->form_validation->set_rules('est_time', 'Estimated time', 'required');
        $this->form_validation->set_rules('rate', 'Rate', 'required');
        $this->form_validation->set_rules('currency', 'Currency', 'required');
       // $this->form_validation->set_rules('rating', 'Rating', 'required');
       // $this->form_validation->set_rules('month', 'Month', 'required');
       // $this->form_validation->set_rules('year', 'Year', 'required');
        //$this->form_validation->set_rules('location', 'Location', 'required');
        $this->form_validation->set_rules('country', 'Country', 'required');
      $this->form_validation->set_rules('state', 'state', 'required');
       // $this->form_validation->set_rules('last_date', 'Last date', 'required');


        if ($this->form_validation->run() == FALSE) {
             $contition_array = array('status' => 1);
        $this->data['countries'] = $this->common->select_data_by_condition('countries', $contition_array, $data = '*', $sortby = 'country_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');


        $contition_array = array('status' => 1);
        $this->data['category'] = $this->common->select_data_by_condition('category', $contition_array, $data = '*', $sortby = 'category_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        $contition_array = array('status' => 1);
        $this->data['currency'] = $this->common->select_data_by_condition('currency', $contition_array, $data = '*', $sortby = 'currency_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        $contition_array = array('user_id' => $userid, 'status' => '1');
        $this->data['freelancerdata'] = $this->common->select_data_by_condition('freelancer_hire_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');


            $this->load->view('freelancer/freelancer_hire/freelancer_add_post', $this->data);
        } else {
              $datereplace=$this->input->post('last_date');
             $lastdate=str_replace('/', '-',$datereplace);
             //echo $ratetype;die();
             // echo $lastdate;die();   
            $data = array(
                'post_name' => trim($this->input->post('post_name')),
                'post_description' => trim($this->input->post('post_desc')),
                'post_field_req' => trim($this->input->post('fields_req')),
                'post_skill' => implode(',', $skills),
                'post_other_skill' => trim($this->input->post('other_skill')),
                'post_est_time' => trim($this->input->post('est_time')),
                'post_rate' => trim($this->input->post('rate')),
                'post_currency' => trim($this->input->post('currency')),
                'post_rating_type' => trim($this->input->post('rating')),
                'post_exp_month' => trim($this->input->post('month')),
                'post_exp_year' => trim($this->input->post('year')),
                'post_last_date' => $lastdate,
                //'post_location' => $this->input->post('location'),
                'country' => trim($this->input->post('country')),
                'state' => trim($this->input->post('state')),
                'city' => trim($this->input->post('city')),
                'user_id' => $userid,
                'created_date' => date('Y-m-d', time()),
                'status' => 1,
                'is_delete' => 0
            );

              //echo "<pre>"; print_r($data); die();  

            $insert_id = $this->common->insert_data_getid($data, 'freelancer_post');
            if ($insert_id) {



                redirect('freelancer/freelancer_hire_post', refresh);
            } else {
                $this->session->flashdata('error', 'Sorry!! Your data not inserted');
                redirect('freelancer/freelancer_post', refresh);
            }
        }
    }

    public function recommen_candidate() {
        $userid = $this->session->userdata('aileenuser');


 //if user deactive profile then redirect to freelancer_hire/freelancer_hire/freelancer_hire_basic_info  start
  
 $contition_array = array('user_id'=> $userid,'status' => '0','is_delete'=> '0');

        $freelancerhire_deactive = $this->data['freelancerhire_deactive'] = $this->common->select_data_by_condition('freelancer_hire_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);

        if( $freelancerhire_deactive)
        {
            redirect('freelancer_hire/freelancer_hire/freelancer_hire_basic_info');
        }
//if user deactive profile then redirect to freelancer_hire/freelancer_hire/freelancer_hire_basic_info  start


        $contition_array = array('user_id' => $userid, 'is_delete' => 0, 'status' => 1);
        $freelancerhiredata = $this->data['freelancerhiredata'] = $this->common->select_data_by_condition('freelancer_post', $contition_array, $data = '*', $sortby = 'post_id', $orderby = 'DESC', $limit = '', $offset = '', $join_str = array(), $groupby = '');

      

        //echo "<pre>"; print_r($post_other_skill); die();
        $contition_array = array('is_delete' => 0, 'status' => 1,'free_post_step' => 7);

        $candidate = $this->data['candidate'] = $this->common->select_data_by_condition('freelancer_post_reg', $contition_array, $data = '*', $sortby = '', $orderby = 'desc', $limit = '', $offset = '', $join_str = array(), $groupby = '');
       //echo "<pre>"; print_r($candidate); die();


        foreach ($freelancerhiredata as $frdata ) {
            $post_skill_data=$frdata['post_skill'];
          // echo "<pre>";print_r($frdata['post_skill']);
           $postuserarray = explode(',', $frdata['post_skill']);

           foreach ($postuserarray as $key => $value) {
            //  echo "<pre>"; print_r($value);


$contition_array = array('status'=>'1','is_delete' =>'0','user_id !=' =>$userid,'FIND_IN_SET("'.$value.'",freelancer_post_area)!='=>'0'); 
 // echo "<pre>"; print_r($contition_array1); 


       $candidate = $this->data['candidatefreelancer'] = $this->common->select_data_by_condition('freelancer_post_reg', $contition_array, $data = '*', $sortby = '', $orderby = 'desc', $limit = '', $offset = '', $join_str = array(), $groupby = '');

           }

        }
      //  echo "<pre>"; print_r($this->data['candidatefreelancer']); die();

  

       //echo "<pre>"; print_r($this->data['candidatefreelancer']); die();
// code for search
        $contition_array = array('status' => '1', 'is_delete' => '0');

        $field = $this->data['results'] = $this->common->select_data_by_condition('category', $contition_array, $data = 'category_name', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);


        $contition_array = array('status' => '1', 'is_delete' => '0','free_post_step' => 7);

        $freelancer_postdata = $this->data['results'] = $this->common->select_data_by_condition('freelancer_post_reg', $contition_array, $data = 'freelancer_post_otherskill,designation', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);
        // echo "<pre>"; print_r($results_recruiter);die();

        $contition_array = array('status' => '1', 'type' => '1');

        $skill = $this->data['skill'] = $this->common->select_data_by_condition('skill', $contition_array, $data = 'skill', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);

        $unique = array_merge($field, $skill, $freelancer_postdata);
        // echo count($unique);
        // $this->data['demo']=$unique;


        foreach ($unique as $key => $value) {
            foreach ($value as $ke => $val) {
                if ($val != "") {


                    $result[] = $val;
                }
            }
        }
        $results = array_unique($result);
        //echo "<pre>";print_r($results);die();
       foreach($results as $key =>$value){
            $result1[$key]['label']=$value;
            $result1[$key]['value']=$value;
          }
            // echo "<pre>"; print_r($result1);die();
          //echo "<pre>"; print_r($this->data['skill']);die();
        $contition_array = array('status' => '1');
          $location_list = $this->common->select_data_by_condition('cities', $contition_array, $data = 'city_name', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);
   

          foreach ($location_list as $key1 => $value1) {
              foreach ($value1 as $ke1 => $val1) {
                 $location[] = $val1;
              }
          }
          //echo "<pre>"; print_r($location);die();
          foreach ($location as $key => $value) {
              $loc[$key]['label'] =$value;
              $loc[$key]['value'] =$value;
          }
         
 //echo "<pre>"; print_r($loc);die();

        $this->data['city_data']= array_values($loc);
        // echo "<pre>"; print_r($location);die();

         $this->data['demo']= array_values($result1);






//echo "<pre>"; print_r($this->data['candidatefreelancer']); die();
        $this->load->view('freelancer/freelancer_hire/recommen_candidate', $this->data);
    }
    public function freelancer_edit_post($id) {  
       // echo $id; die();
        $userid = $this->session->userdata('aileenuser');

//if user deactive profile then redirect to freelancer_hire/freelancer_hire/freelancer_hire_basic_info  start
  
 $contition_array = array('user_id'=> $userid,'status' => '0','is_delete'=> '0');

        $freelancerhire_deactive = $this->data['freelancerhire_deactive'] = $this->common->select_data_by_condition('freelancer_hire_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);

        if( $freelancerhire_deactive)
        {
            redirect('freelancer_hire/freelancer_hire/freelancer_hire_basic_info');
        }
//if user deactive profile then redirect to freelancer_hire/freelancer_hire/freelancer_hire_basic_info  start

        $contition_array = array('status' => 1);
        $this->data['countries'] = $this->common->select_data_by_condition('countries', $contition_array, $data = '*', $sortby = 'country_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        $contition_array = array('post_id' => $id, 'is_delete' => 0);
            $userdata=$this->data['freelancerpostdata'] = $this->common->select_data_by_condition('freelancer_post', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
            //echo $statedata[0]['country'];die();

$contition_array = array('status' => 1,'country_id' => $userdata[0]['country']);
        $state=$this->data['states'] = $this->common->select_data_by_condition('states', $contition_array, $data = '*', $sortby = 'state_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');

         //for getting city data
            $contition_array = array('status' => 1,'state_id'=> $userdata[0]['state']);
            $this->data['cities'] =  $this->common->select_data_by_condition('cities', $contition_array, $data = '*', $sortby = 'city_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');


        //echo "<pre>"; print_r($state);



      
        
         // echo "<pre>"; print_r($this->data['cities']);die();

        // $contition_array = array('status' => 1);
        // $citiess=$this->data['cities'] = $this->common->select_data_by_condition('cities', $contition_array, $data = '*', $sortby = 'city_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');


        $contition_array = array('status' => 1);
        $this->data['category'] = $this->common->select_data_by_condition('category', $contition_array, $data = '*', $sortby = 'category_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');


        $contition_array = array('status' => 1, 'type' => 1);
        $this->data['skill1'] = $this->common->select_data_by_condition('skill', $contition_array, $data = '*', $sortby = 'skill', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');




        $contition_array = array('status' => 1);
        $this->data['currency'] = $this->common->select_data_by_condition('currency', $contition_array, $data = '*', $sortby = 'currency_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        


        $this->data['country1'] = $this->data['freelancerpostdata'][0]['country'];
        $this->data['city1'] = $this->data['freelancerpostdata'][0]['city'];
        $this->data['state1'] = $this->data['freelancerpostdata'][0]['state'];

        $skildata = explode(',', $this->data['freelancerpostdata'][0]['post_skill']);
        $this->data['selectdata'] = $skildata;


//code for search 
        $contition_array = array('status' => '1', 'is_delete' => '0');

        $field = $this->data['results'] = $this->common->select_data_by_condition('category', $contition_array, $data = 'category_name', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);


        $contition_array = array('status' => '1', 'is_delete' => '0','free_post_step' => 7);

        $freelancer_postdata = $this->data['results'] = $this->common->select_data_by_condition('freelancer_post_reg', $contition_array, $data = 'freelancer_post_otherskill,designation', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);
        // echo "<pre>"; print_r($results_recruiter);die();

        $contition_array = array('status' => '1', 'type' => '1');

        $skill = $this->data['skill'] = $this->common->select_data_by_condition('skill', $contition_array, $data = 'skill', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);

        $unique = array_merge($field, $skill, $freelancer_postdata);
        // echo count($unique);
        // $this->data['demo']=$unique;


        foreach ($unique as $key => $value) {
            foreach ($value as $ke => $val) {
                if ($val != "") {


                    $result[] = $val;
                }
            }
        }
$results = array_unique($result);
        foreach($results as $key =>$value){
            $result1[$key]['label']=$value;
            $result1[$key]['value']=$value;
          }

          $contition_array = array('status' => '1');
          $citiess = $this->common->select_data_by_condition('cities', $contition_array, $data = 'city_name', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);
   

foreach($citiess as $key){
    $location[]=$key['city_name'];
   }


          // foreach ($location_list as $key1 => $value1) {
          //     foreach ($value1 as $ke1 => $val1) {
          //        $location[] = $val1;
          //     }
          // }
          //echo "<pre>"; print_r($location);die();
          foreach ($location as $key => $value) {
              $loc[$key]['label'] =$value;
              $loc[$key]['value'] =$value;
          }
         
 //echo "<pre>"; print_r($loc);die();

        $this->data['city_data']= $loc;

         $this->data['demo']= array_values($result1);





        $this->load->view('freelancer/freelancer_hire/freelancer_edit_post', $this->data);
    }

    public function freelancer_edit_post_insert($id) {

        $userid = $this->session->userdata('aileenuser');
        $skills = $this->input->post('skills');
        $this->form_validation->set_rules('post_name', 'Post Name', 'required');
        $this->form_validation->set_rules('post_desc', 'Post description', 'required');
      //  $this->form_validation->set_rules('fields_req', 'Field required', 'required');

       
        $this->form_validation->set_rules('est_time', 'Estimated time', 'required');
        $this->form_validation->set_rules('rate', 'Rate', 'required');
        $this->form_validation->set_rules('currency', 'Currency', 'required');
        $this->form_validation->set_rules('rating', 'Rating', 'required');
        

        $this->form_validation->set_rules('country', 'Country', 'required');
        

        $this->form_validation->set_rules('last_date', 'Last date', 'required');

        // if ($this->form_validation->run() == FALSE) {
          
        //     $this->load->view('freelancer/freelancer_hire/freelancer_edit_post');
        // } else {
        //     echo "hello";die();
                 $datereplace=$this->input->post('last_date');
                 $lastdate=str_replace('/', '-',$datereplace);
            
            $data = array(
                'post_name' =>trim( $this->input->post('post_name')),
                'post_description' => trim($this->input->post('post_desc')),
                'post_field_req' => trim($this->input->post('fields_req')),
                'post_skill' => implode(',', $skills),
                'post_other_skill' => trim($this->input->post('other_skill')),
                'post_est_time' => trim($this->input->post('est_time')),
                'post_rate' => trim($this->input->post('rate')),
                'post_currency' => trim($this->input->post('currency')),
                'post_rating_type' => trim($this->input->post('rating')),
                'post_exp_month' => trim($this->input->post('month')),
                'post_exp_year' => trim($this->input->post('year')),
                'post_last_date' => $lastdate,
                'country' => trim($this->input->post('country')),
                'city' => trim($this->input->post('city')),
                'modify_date' => date('Y-m-d', time()),
            );

            // echo "<pre>"; print_r($data);die();
            $updatdata = $this->common->update_data($data, 'freelancer_post', 'post_id', $id);

            if ($updatdata) {



                redirect('freelancer/freelancer_hire_post', refresh);
            } else {
                $this->session->flashdata('error', 'Sorry!! Your data not inserted');
                redirect('freelancer/freelancer_edit_post', refresh);
            }
        //}
    }

    //Freelancer Job All Post Start
    public function freelancer_apply_post($id="") {
        $this->data['userid'] = $userid = $this->session->userdata('aileenuser');


//if user deactive profile then redirect to freelancer/freelancer_post/freelancer_post_basic_information  start
        $contition_array = array('user_id'=> $userid,'status' => '0','is_delete'=> '0');

        $freelancerpost_deactive = $this->data['freelancerpost_deactive'] = $this->common->select_data_by_condition('freelancer_post_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);

        if( $freelancerpost_deactive)
        {
            redirect('freelancer/freelancer_post/freelancer_post_basic_information');
        }
    //if user deactive profile then redirect to freelancer/freelancer_post/freelancer_post_basic_information  End


        if ($id == $userid || $id == "") {

           // echo "hi"; die();

            $contition_array = array('user_id' => $userid, 'is_delete' => 0, 'status' => 1);
            $freelancerdata = $this->data['freelancerdata'] = $this->common->select_data_by_condition('freelancer_post_reg', $contition_array, $data = '*', $sortby = '', $orderby = 'desc', $limit = '', $offset = '', $join_str = array(), $groupby = '');

            //echo "<pre>"; print_r($freelancerdata);
            $freelancer_post_area = $this->data['freelancerdata'][0]['freelancer_post_area'];
   

 $post_reg_skill = explode(',', $freelancer_post_area);

 foreach ($post_reg_skill as $key => $value) {
   
    
     $contition_array = array('status'=>'1','user_id !=' =>$userid,'FIND_IN_SET("'.$value.'",post_skill)!='=>'0'); 
    
 // echo "<pre>"; print_r($contition_array1); 


        $freelancer_post_data = $this->data['freelancer_post_data'] = $this->common->select_data_by_condition('freelancer_post', $contition_array, $data = '*', $sortby = '', $orderby = 'desc', $limit = '', $offset = '', $join_str = array(), $groupby = '');
        
       
        if($freelancer_post_data){
            
        $freedata[] = $freelancer_post_data;
  
    }
 
 }

  // echo "<pre>"; print_r($freedata);
        } 
        else {
          //  echo "heloo"; die();
            $contition_array = array('user_id' => $id, 'is_delete' => 0, 'status' => 1,'free_post_step' => 7);
            $freelancerdata = $this->data['freelancerdata'] = $this->common->select_data_by_condition('freelancer_post_reg', $contition_array, $data = '*', $sortby = '', $orderby = 'desc', $limit = '', $offset = '', $join_str = array(), $groupby = '');

            $freelancer_post_area = $this->data['freelancerdata'][0]['freelancer_post_area'];

            $post_reg_skill = explode(',', $freelancer_post_area);

 foreach ($post_reg_skill as $key => $value) {
   
    
     $contition_array = array('status'=>'1','user_id !=' =>$userid,'FIND_IN_SET("'.$value.'",post_skill)!='=>'0'); 
    

        $freelancer_post_data = $this->data['freelancer_post_data'] = $this->common->select_data_by_condition('freelancer_post', $contition_array, $data = '*', $sortby = '', $orderby = 'desc', $limit = '', $offset = '', $join_str = array(), $groupby = '');
        

        if($freelancer_post_data){
        $freedata[] = $freelancer_post_data;
    }
 
 }
        }

        $this->data['postdetail'] = $freedata;

       // echo "<pre>"; print_r($freedata);die();
      //  echo "<pre>"; print_r($this->data['postdetail']); die();

//code for search
        $contition_array = array('status' => '1', 'is_delete' => '0','free_post_step' => 7);

        $freelancer_postdata = $this->data['results'] = $this->common->select_data_by_condition('freelancer_post_reg', $contition_array, $data = 'designation,freelancer_post_otherskill', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);
        // echo "<pre>"; print_r($freelancer_postdata);die();

        $contition_array = array('status' => '1', 'type' => '1');

        $skill = $this->data['results'] = $this->common->select_data_by_condition('skill', $contition_array, $data = 'skill', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);


        $contition_array = array('status' => '1');

        $results_post = $this->data['results'] = $this->common->select_data_by_condition('freelancer_post', $contition_array, $data = 'post_name', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);

        $contition_array = array('status' => '1', 'is_delete' => '0');

        $field = $this->data['results'] = $this->common->select_data_by_condition('category', $contition_array, $data = 'category_name', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);

        $uni = array_merge($skill, $freelancer_postdata, $field,$results_post);
        // echo count($unique);
        // $this->data['demo']=$uni;

        foreach ($uni as $key => $value) {
            foreach ($value as $ke => $val) {
                if ($val != "") {


                    $result[] = $val;
                }
            }
        }
        $results = array_unique($result);
        foreach($results as $key =>$value){
            $result1[$key]['label']=$value;
            $result1[$key]['value']=$value;
          }

         
 $contition_array = array('status' => '1');
          $location_list = $this->common->select_data_by_condition('cities', $contition_array, $data = 'city_name', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);
   

          foreach ($location_list as $key1 => $value1) {
              foreach ($value1 as $ke1 => $val1) {
                 $location[] = $val1;
              }
          }
          //echo "<pre>"; print_r($location);die();
          foreach ($location as $key => $value) {
              $loc[$key]['label'] =$value;
              $loc[$key]['value'] =$value;
          }
         
 //echo "<pre>"; print_r($loc);die();

        $this->data['city_data']= array_values($loc);


         $this->data['demo']= array_values($result1);




        $this->load->view('freelancer/freelancer_post/post_apply', $this->data);
    }

     public function save_user1($id, $save_id) { 
        //echo $id; echo $save_id; die();
        $id = $_POST['user_id'];

       // echo $id; die();
        $save_id = $_POST['save_id'];

        $userid = $this->session->userdata('aileenuser');
        //echo $id;die();
        $contition_array = array('from_id' => $userid, 'to_id' => $id, 'save_id' => $save_id);
        $userdata = $this->common->select_data_by_condition('save', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
        //echo "<pre>";print_r($userdata);die();

        if ($userdata) {
            $data = array(
                'status' => 0
            );


            $updatedata = $this->common->update_data($data, 'save', 'save_id', $save_id);

            if ($updatedata) {

                $saveuser = 'Saved';
                echo $saveuser;
            }
        } else {
            $data = array(
                'from_id' => $userid,
                'to_id' => $id,
                'status' => 0,
                'save_type' => 2
            );

            $insert_id = $this->common->insert_data($data, 'save');


            if ($insert_id) {

                $saveuser = 'Saved';
                echo $saveuser;
            }
        }
    }


    //Freelancer Job All Post controller end
//Freelancer Apply post at all post page & save post page controller Start
    public function apply_insert() {  
        
        $id = $_POST['post_id'];
        $para = $_POST['allpost'];
        $notid = $_POST['userid'];
        // echo $id;
        // echo $para;
        // echo $notid;

        $userid = $this->session->userdata('aileenuser');

        $contition_array = array('post_id' => $id, 'user_id' => $userid, 'is_delete' => 0);
        $userdata = $this->common->select_data_by_condition('freelancer_apply', $contition_array, $data = '*', $sortby = '', $orderby = 'desc', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        //echo "<pre>";print_r($userdata);die();

        $app_id = $userdata[0]['app_id'];

        if ($userdata) {
            //echo "hello";

            $contition_array = array('job_delete' => 1);
            $jobdata = $this->common->select_data_by_condition('freelancer_apply', $contition_array, $data = 'app_id', $sortby = '', $orderby = 'desc', $limit = '', $offset = '', $join_str = array(), $groupby = '');

            $data = array(
                'job_delete' => 0,
                'job_save'  => 3,
                'modify_date' => date('Y-m-d h:i:s', time())
                
            );
            //echo "hhhh";


            $updatedata = $this->common->update_data($data, 'freelancer_apply', 'app_id', $app_id);



            $data = array(
                'not_type' => 3,
                'not_from_id' => $userid,
                'not_to_id' => $notid,
                'not_read' => 2,
                'not_from' => 4,
                'not_product_id' => $app_id,
                "not_active" => 1,
                'not_created_date' => date('Y-m-d H:i:s')
               
            );

$updatedata = $this->common->insert_data_getid($data, 'notification');
            // end notoification

            if ($updatedata) {

                if ($para == 'all') {
                    $applypost = 'Applied';
                }
            }
            echo $applypost;
        } else {
            //echo "sssss";die();
            $data = array(
                'post_id' => $id,
                'user_id' => $userid,
                'status' => 1,
                'created_date' => date('Y-m-d h:i:s', time()),
                'modify_date' => date('Y-m-d h:i:s', time()),
                'is_delete' => 0,
                'job_delete' => 0,
                'job_save'  => 3
            );


            $insert_id = $this->common->insert_data_getid($data, 'freelancer_apply');

            // insert notification

            $data = array(
                'not_type' => 3,
                'not_from_id' => $userid,
                'not_to_id' => $notid,
                'not_read' => 2,
                'not_from' => 4,
                'not_product_id' => $insert_id,
                "not_active" => 1,
                'not_created_date' => date('Y-m-d H:i:s')
                
            );
            //echo "<pre>"; print_r($data);die();

            $insert_id = $this->common->insert_data_getid($data, 'notification');
          
            // end notoification

            if ($insert_id) {

                $applypost = 'Applied';

                //echo "hello";die();
            }
            echo $applypost;
        }
    }
    //Freelancer Apply post at all post page & save post page controller End
//Freelancer view all applied post controller Start
    public function freelancer_applied_post() {
       // echo "hi"; die();

        $this->data['userid'] = $userid = $this->session->userdata('aileenuser');

//if user deactive profile then redirect to freelancer/freelancer_post/freelancer_post_basic_information  start
        $contition_array = array('user_id'=> $userid,'status' => '0','is_delete'=> '0');

        $freelancerpost_deactive = $this->data['freelancerpost_deactive'] = $this->common->select_data_by_condition('freelancer_post_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);

        if( $freelancerpost_deactive)
        {
            redirect('freelancer/freelancer_post/freelancer_post_basic_information');
        }
    //if user deactive profile then redirect to freelancer/freelancer_post/freelancer_post_basic_information  End


// job seeker detail
        $contition_array = array('user_id' => $userid, 'is_delete' => 0, 'status' => 1);
        $jobdata = $this->data['jobdata'] = $this->common->select_data_by_condition('freelancer_post_reg', $contition_array, $data = '*', $sortby = '', $orderby = 'desc', $limit = '', $offset = '', $join_str = array(), $groupby = '');

// post detail

//         $join_str[0]['table'] = 'freelancer_apply';
//         $join_str[0]['join_table_id'] = 'freelancer_apply.post_id';
//         $join_str[0]['from_table_id'] = 'freelancer_post.post_id';
//         $join_str[0]['join_type'] = '';

//         $contition_array = array('freelancer_apply.job_delete' => 0, 'freelancer_apply.user_id' => $userid, 'freelancer_apply.job_save' => 1);

// $data='freelancer_post.post_id,freelancer_post.post_name,freelancer_post.post_field_req,freelancer_post.post_est_time,freelancer_post.post_skill,freelancer_post.post_other_skill,freelancer_post.post_rate,freelancer_post.post_last_date,freelancer_post.post_description,freelancer_post.user_id,freelancer_post.created_date,freelancer_post.post_currency,freelancer_post.post_rating_type,freelancer_post.country,freelancer_post.city,freelancer_post.post_exp_month,freelancer_post.post_exp_year,freelancer_apply.app_id,freelancer_apply.post_id,freelancer_apply.status,freelancer_apply.created_date,freelancer_apply.modify_date,freelancer_apply.job_delete,freelancer_apply.job_save,freelancer_apply.is_delete';
//         $postdata = $this->data['postdata'] = $this->common->select_data_by_condition('freelancer_post', $contition_array, $data, $sortby = 'freelancer_post.post_id', $orderby = 'desc', $limit = '', $offset = '', $join_str, $groupby = '');
        
        //echo "<pre>"; print_r($postdata); die();

          $join_str[0]['table'] = 'freelancer_apply';
                    $join_str[0]['join_table_id'] = 'freelancer_apply.post_id';
                    $join_str[0]['from_table_id'] = 'freelancer_post.post_id';
                    $join_str[0]['join_type'] = '';
                     $contition_array = array('freelancer_apply.job_delete' => 0, 'freelancer_apply.user_id' => $userid);
                
                $postdata = $this->data['postdata'] = $this->common->select_data_by_condition('freelancer_post', $contition_array, $data ='freelancer_post.*,freelancer_apply.app_id,freelancer_apply.user_id as userid,freelancer_apply.modify_date,freelancer_apply.created_date  ', $sortby = 'freelancer_apply.modify_date', $orderby = 'desc', $limit = '', $offset = '', $join_str, $groupby = '');
        

//echo "<pre>"; print_r($postdata); die();

        $contition_array = array('status' => '1', 'is_delete' => '0','free_post_step' => 7);

        $freelancer_postdata = $this->data['results'] = $this->common->select_data_by_condition('freelancer_post_reg', $contition_array, $data = 'designation,freelancer_post_otherskill', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);
        // echo "<pre>"; print_r($freelancer_postdata);die();

        $contition_array = array('status' => '1', 'type' => '1');

        $skill = $this->data['results'] = $this->common->select_data_by_condition('skill', $contition_array, $data = 'skill', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);

        $contition_array = array('status' => '1');

        $results_post = $this->data['results'] = $this->common->select_data_by_condition('freelancer_post', $contition_array, $data = 'post_name', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);

        $contition_array = array('status' => '1', 'is_delete' => '0');

        $field = $this->data['results'] = $this->common->select_data_by_condition('category', $contition_array, $data = 'category_name', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);

        $uni = array_merge($skill, $freelancer_postdata, $field,$results_post);
        // echo count($unique);
        // $this->data['demo']=$uni;

        foreach ($uni as $key => $value) {
            foreach ($value as $ke => $val) {
                if ($val != "") {


                    $result[] = $val;
                }
            }
        }
        $results = array_unique($result);
        foreach($results as $key =>$value){
           
            $result1[$key]['label']=$value;
            $result1[$key]['value']=$value;
         
          }

 $contition_array = array('status' => '1');
          $location_list = $this->common->select_data_by_condition('cities', $contition_array, $data = 'city_name', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);
   

          foreach ($location_list as $key1 => $value1) {
              foreach ($value1 as $ke1 => $val1) {
                 $location[] = $val1;
              }
          }
          //echo "<pre>"; print_r($location);die();
          foreach ($location as $key => $value) {
              $loc[$key]['label'] =$value;
              $loc[$key]['value'] =$value;
          }
         
 //echo "<pre>"; print_r($loc);die();

        $this->data['city_data']= array_values($loc);



         
         $this->data['demo']= array_values($result1);
        $this->load->view('freelancer/freelancer_post/freelancer_applied_post', $this->data);
    }

    //Freelancer view all applied post controller End
    //Freelancer Delete all Applied & Save post controller Start
    public function freelancer_delete_apply() {
        //echo "hi"; die();

        $id = $_POST['app_id'];
        $para = $_POST['para'];

        $userid = $this->session->userdata('aileenuser');

        $data = array(
            'job_delete' => 1,
            'job_save' => 3,
            'modify_date' => date('Y-m-d h:i:s', time())
        );

        $updatedata = $this->common->update_data($data, 'freelancer_apply', 'app_id', $id);
    }

    //Freelancer Delete all Applied & Save post controller End
//Freelancer Save post controller Start

    public function save_insert() {
      
       $id = $_POST['post_id'];
       $userid = $this->session->userdata('aileenuser');

        $contition_array = array('post_id' => $id, 'user_id' => $userid, 'is_delete' => 0);
        $userdata = $this->common->select_data_by_condition('freelancer_apply', $contition_array, $data = '*', $sortby = '', $orderby = 'desc', $limit = '', $offset = '', $join_str = array(), $groupby = '');


        $app_id = $userdata[0]['app_id'];

        if($userdata){

$contition_array = array('job_delete' => 1);
$jobdata = $this->common->select_data_by_condition('freelancer_apply', $contition_array = array(), $data = '*', $sortby = '',$orderby = 'desc', $limit = '', $offset = '', $join_str = array(), $groupby = '');

            $data = array(
                'job_delete' => 0,
                'job_save' => 1
            );

$updatedata = $this->common->update_data($data, 'freelancer_apply', 'app_id', $app_id);

 if ($updatedata) {

    $savepost = 'Applied post';
    echo $savepost;
           
            }
        } else {

            $data = array(
                'post_id' => $id,
                'user_id' => $userid,
                'status' => 1,
                'created_date' => date('Y-m-d h:i:s', time()),
                'is_delete' => 0,
                'job_delete' => 0,
                'job_save' => 1
            );

            $insert_id = $this->common->insert_data_getid($data, 'freelancer_apply');
            if ($insert_id) {
                $savepost = 'Applied Post';
                echo $savepost;
            }
        }
    }

//Freelancer Save post controller End

    public function freelancer_apply_list($id) {
        $userid = $this->session->userdata('aileenuser');

         
        $this->data['postid'] = $id;
        //echo "<pre>"; print_r($this->data['postid']);die();
// khyati chnages start
        $join_str[0]['table'] = 'freelancer_apply';
        $join_str[0]['join_table_id'] = 'freelancer_apply.user_id';
        $join_str[0]['from_table_id'] = 'freelancer_post_reg.user_id';
        $join_str[0]['join_type'] = '';


       $contition_array = array('freelancer_apply.post_id' => $id, 'freelancer_apply.is_delete' => 0);



        $postdata = $this->data['postdata'] = $this->common->select_data_by_condition('freelancer_post_reg', $contition_array, $data, $sortby = '', $orderby = 'desc', $limit = '', $offset = '', $join_str, $groupby = '');

        //echo '<pre>'; print_r($postdata); die();
// khyati chnages end

// code for search
        $contition_array = array('status' => '1', 'is_delete' => '0');
        $field = $this->data['results'] = $this->common->select_data_by_condition('category', $contition_array, $data = 'category_name', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);
        $contition_array = array('status' => '1', 'is_delete' => '0','free_post_step' => 7);

        $freelancer_postdata = $this->data['results'] = $this->common->select_data_by_condition('freelancer_post_reg', $contition_array, $data = 'freelancer_post_otherskill,designation', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);
        // echo "<pre>"; print_r($results_recruiter);die();

        $contition_array = array('status' => '1', 'type' => '1');

        $skill = $this->data['skill'] = $this->common->select_data_by_condition('skill', $contition_array, $data = 'skill', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);

        $unique = array_merge($field, $skill, $freelancer_postdata);
        // echo count($unique);
        // $this->data['demo']=$unique;
       
       foreach ($unique as $key => $value) {
            foreach ($value as $ke => $val) {
                if ($val != "") {
                    $result[] = $val;
                }
            }
        }
        $results = array_unique($result);
        foreach($results as $key =>$value){
            $result1[$key]['label']=$value;
            $result1[$key]['value']=$value;
          }

         
$this->data['demo']= array_values($result1);
$contition_array = array('status' => '1');
          $location_list = $this->common->select_data_by_condition('cities', $contition_array, $data = 'city_name', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);
   

          foreach ($location_list as $key1 => $value1) {
              foreach ($value1 as $ke1 => $val1) {
                 $location[] = $val1;
              }
          }
          //echo "<pre>"; print_r($location);die();
          foreach ($location as $key => $value) {
              $loc[$key]['label'] =$value;
              $loc[$key]['value'] =$value;
          }
         
 //echo "<pre>"; print_r($loc);die();

        $this->data['city_data']= array_values($loc);

        $this->load->view('freelancer/freelancer_hire/freelancer_apply_list', $this->data);
    }

    public function save_user() {
        //echo "hi";

         $id = $_POST['post_id'];
         //echo $id;

        $userid = $this->session->userdata('aileenuser');
      // echo $userid;

        $contition_array = array('post_id' => $id, 'user_id' => $userid, 'is_delete' => 0);
        $userdata = $this->common->select_data_by_condition('freelancer_apply', $contition_array, $data = '*', $sortby = 'post_id', $orderby = 'asc', $limit = '', $offset = '', $join_str = array(), $groupby = '');
//echo '<pre>'; print_r($userdata); die();

        $app_id = $userdata[0]['app_id'];

        if ($userdata) {

            $contition_array = array('job_delete' => 0);
            $jobdata = $this->common->select_data_by_condition('freelancer_apply', $contition_array = array(), $data = '*', $sortby = 'post_id', $orderby = 'asc', $limit = '', $offset = '', $join_str = array(), $groupby = '');



            $data = array(
                'job_delete' => 1,
                'job_save' => 2,
                'modify_date'=>date('Y-m-d h:i:s', time())
            );

            $updatedata = $this->common->update_data($data, 'freelancer_apply', 'app_id', $app_id);


            if ($updatedata) {

                $savepost = 'Saved';
            }
            echo $savepost;
        } else {

            $data = array(
                'post_id' => $id,
                'user_id' => $userid,
                'status' => 1,
                'created_date' => date('Y-m-d h:i:s', time()),
                'modify_date'=>date('Y-m-d h:i:s', time()),
                'is_delete' => 0,
                'job_delete' => 1,
                'job_save' => 2
            );

            $insert_id = $this->common->insert_data_getid($data, 'freelancer_apply');
            if ($insert_id) {

                $savepost = 'Saved';
            } echo $savepost;
        }
    }

//save freelancer list controller start
    public function freelancer_save() {
        $userid = $this->session->userdata('aileenuser');
        //if user deactive profile then redirect to freelancer_hire/freelancer_hire/freelancer_hire_basic_info  start
     $contition_array = array('user_id'=> $userid,'status' => '0','is_delete'=> '0');
        $freelancerhire_deactive = $this->data['freelancerhire_deactive'] = $this->common->select_data_by_condition('freelancer_hire_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);
        if( $freelancerhire_deactive)
        {
            redirect('freelancer_hire/freelancer_hire/freelancer_hire_basic_info');
        }
    //if user deactive profile then redirect to freelancer_hire/freelancer_hire/freelancer_hire_basic_info  start
        $join_str[0]['table'] = 'freelancer_post_reg';
        $join_str[0]['join_table_id'] = 'freelancer_post_reg.user_id';
        $join_str[0]['from_table_id'] = 'save.to_id';
        $join_str[0]['join_type'] = '';


   $contition_array = array('save.status'=> '0','freelancer_post_reg.is_delete' => 0, 'freelancer_post_reg.status' => 1, 'save.from_id' => $userid, 'save.save_type' => 2);
   $postdata = $this->data['postdata'] = $this->common->select_data_by_condition('save', $contition_array, $data='freelancer_post_reg.freelancer_post_user_image,freelancer_post_reg.user_id,freelancer_post_reg.freelancer_post_fullname,freelancer_post_reg.freelancer_post_username,freelancer_post_reg.designation,freelancer_post_reg.freelancer_post_area,freelancer_post_reg.freelancer_post_otherskill,freelancer_post_reg.freelancer_post_city,freelancer_post_reg.freelancer_post_skill_description,freelancer_post_reg.freelancer_post_work_hour,freelancer_post_reg.freelancer_post_hourly,freelancer_post_reg.freelancer_post_ratestate,freelancer_post_reg.freelancer_post_fixed_rate,freelancer_post_reg.freelancer_post_exp_year,freelancer_post_reg.freelancer_post_exp_month,save.save_id', $sortby = 'save_id', $orderby = 'desc', $limit = '', $offset = '', $join_str, $groupby = '');

// code for search
        $contition_array = array('status' => '1', 'is_delete' => '0');
        $field = $this->data['results'] = $this->common->select_data_by_condition('category', $contition_array, $data = 'category_name', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);
        $contition_array = array('status' => '1', 'is_delete' => '0','free_post_step' => 7);

        $freelancer_postdata = $this->data['results'] = $this->common->select_data_by_condition('freelancer_post_reg', $contition_array, $data = 'freelancer_post_otherskill,designation', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);
        $contition_array = array('status' => '1', 'type' => '1');
        $skill = $this->data['skill'] = $this->common->select_data_by_condition('skill', $contition_array, $data = 'skill', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);
        $unique = array_merge($field, $skill, $freelancer_postdata);
       foreach ($unique as $key => $value) {
            foreach ($value as $ke => $val) {
                if ($val != "") {
                    $result[] = $val;
                }
            }
        }
        $results = array_unique($result);
        foreach($results as $key =>$value){
            $result1[$key]['label']=$value;
            $result1[$key]['value']=$value;
          }
 $contition_array = array('status' => '1');
          $location_list = $this->common->select_data_by_condition('cities', $contition_array, $data = 'city_name', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);
          foreach ($location_list as $key1 => $value1) {
              foreach ($value1 as $ke1 => $val1) {
                 $location[] = $val1;
              }
          }
          foreach ($location as $key => $value) {
              $loc[$key]['label'] =$value;
              $loc[$key]['value'] =$value;
          }
        $this->data['city_data']= array_values($loc);
$this->data['demo']= array_values($result1);
$this->load->view('freelancer/freelancer_hire/freelancer_save', $this->data);
   
    }

//save freelancer list controller End
//Freelancer Save Post Controller Start         

    public function freelancer_save_post() {
        //echo "hi"; die();

        $this->data['userid'] = $userid = $this->session->userdata('aileenuser');

//if user deactive profile then redirect to freelancer/freelancer_post/freelancer_post_basic_information  start
        $contition_array = array('user_id'=> $userid,'status' => '0','is_delete'=> '0');

        $freelancerpost_deactive = $this->data['freelancerpost_deactive'] = $this->common->select_data_by_condition('freelancer_post_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);

        if( $freelancerpost_deactive)
        {
            redirect('freelancer/freelancer_post/freelancer_post_basic_information');
        }
    //if user deactive profile then redirect to freelancer/freelancer_post/freelancer_post_basic_information  End


// job seeker detail
        $contition_array = array('user_id' => $userid, 'is_delete' => 0, 'status' => 1);
        $jobdata = $this->data['jobdata'] = $this->common->select_data_by_condition('freelancer_post_reg', $contition_array, $data = '*', $sortby = '', $orderby = 'desc', $limit = '', $offset = '', $join_str = array(), $groupby = '');

// post detail
        $join_str[0]['table'] = 'freelancer_post';
        $join_str[0]['join_table_id'] = 'freelancer_post.post_id';
        $join_str[0]['from_table_id'] = 'freelancer_apply.post_id';
        $join_str[0]['join_type'] = '';

       $contition_array = array('freelancer_apply.job_delete' => 1, 'freelancer_apply.user_id' => $userid, 'freelancer_apply.job_save' => 2);
        $this->data['postdetail'] = $this->common->select_data_by_condition('freelancer_apply', $contition_array, $data = '*', $sortby = 'freelancer_apply.modify_date', $orderby = 'desc', $limit = '', $offset = '', $join_str, $groupby ='');


        // code for search

        $contition_array = array('status' => '1', 'is_delete' => '0','free_post_step' => 7);

        $freelancer_postdata = $this->data['results'] = $this->common->select_data_by_condition('freelancer_post_reg', $contition_array, $data = 'designation,freelancer_post_otherskill', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby = '');
        // echo "<pre>"; print_r($freelancer_postdata);die();

        $contition_array = array('status' => '1', 'type' => '1');

        $skill = $this->data['results'] = $this->common->select_data_by_condition('skill', $contition_array, $data = 'skill', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);

        $contition_array = array('status' => '1');

        $results_post = $this->data['results'] = $this->common->select_data_by_condition('freelancer_post', $contition_array, $data = 'post_name', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);

        $contition_array = array('status' => '1', 'is_delete' => '0');

        $field = $this->data['results'] = $this->common->select_data_by_condition('category', $contition_array, $data = 'category_name', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);

        $uni = array_merge($skill, $freelancer_postdata, $field,$results_post);
        // echo count($unique);
        // $this->data['demo']=$uni;

        foreach ($uni as $key => $value) {
            foreach ($value as $ke => $val) {
                if ($val != "") {


                    $result[] = $val;
                }
            }
        }
        $results = array_unique($result);
        foreach($results as $key =>$value){
            $result1[$key]['label']=$value;
            $result1[$key]['value']=$value;
          }


 $contition_array = array('status' => '1');
          $location_list = $this->common->select_data_by_condition('cities', $contition_array, $data = 'city_name', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);
   

          foreach ($location_list as $key1 => $value1) {
              foreach ($value1 as $ke1 => $val1) {
                 $location[] = $val1;
              }
          }
          //echo "<pre>"; print_r($location);die();
          foreach ($location as $key => $value) {
              $loc[$key]['label'] =$value;
              $loc[$key]['value'] =$value;
          }
         
 //echo "<pre>"; print_r($loc);die();

        $this->data['city_data']= array_values($loc);

    $this->data['demo']= array_values($result1);
    $this->load->view('freelancer/freelancer_post/freelancer_save_post', $this->data);
    }

//Freelancer Save Post Controller End

    public function user_image_insert() {


        $userid = $this->session->userdata('aileenuser');


        if ($this->input->post('cancel1')) {  //echo "hii"; die();
            redirect('freelancer/freelancer_add_post', refresh);
        } elseif ($this->input->post('cancel2')) {
            redirect('freelancer/freelancer_hire_post', refresh);
        } elseif ($this->input->post('cancel3')) {
            redirect('freelancer/freelancer_save', refresh);
        } elseif ($this->input->post('cancel4')) {
            redirect('freelancer/freelancer_hire_profile', refresh);
        }

        if (empty($_FILES['profilepic']['name'])) {
            $this->form_validation->set_rules('profilepic', 'Upload profilepic', 'required');
        } else {
            // $config['upload_path'] = 'uploads/user_image/';
            // $config['allowed_types'] = 'jpg|jpeg|png|gif|mp4|3gp|mpeg|mpg|mpe|qt|mov|avi|pdf';

            // $config['file_name'] = $_FILES['profilepic']['name'];

            // //Load upload library and initialize configuration
            // $this->load->library('upload', $config);
            // $this->upload->initialize($config);

            // if ($this->upload->do_upload('profilepic')) {
            //     $uploadData = $this->upload->data();

            //     $picture = $uploadData['file_name'];
            // } else {
            //     $picture = '';
            // }


        





            $freelancer_hire_userimage = '';
            $user['upload_path'] = $this->config->item('free_hire_profile_main_upload_path');
            $user['allowed_types'] = $this->config->item('free_hire_profile_main_allowed_types');
            $user['max_size'] = $this->config->item('free_hire_profile_main_max_size');
            $user['max_width'] = $this->config->item('free_hire_profile_main_max_width');
            $user['max_height'] = $this->config->item('free_hire_profile_main_max_height');
            $this->load->library('upload');
            $this->upload->initialize($user);
            //Uploading Image
            $this->upload->do_upload('profilepic');
            //Getting Uploaded Image File Data
            $imgdata = $this->upload->data();
            $imgerror = $this->upload->display_errors();
            //echo "$imgerror";die();
            if ($imgerror == '') {
                //Configuring Thumbnail 
                $user_thumb['image_library'] = 'gd2';
                $user_thumb['source_image'] = $user['upload_path'] . $imgdata['file_name'];
                $user_thumb['new_image'] = $this->config->item('free_hire_profile_thumb_upload_path') . $imgdata['file_name'];
                $user_thumb['create_thumb'] = TRUE;
                $user_thumb['maintain_ratio'] = TRUE;
                $user_thumb['thumb_marker'] = '';
                $user_thumb['width'] = $this->config->item('free_hire_profile_thumb_width');
                //$user_thumb['height'] = $this->config->item('user_thumb_height');
                $user_thumb['height'] = 2;
                $user_thumb['master_dim'] = 'width';
                $user_thumb['quality'] = "100%";
                $user_thumb['x_axis'] = '0';
                $user_thumb['y_axis'] = '0';
                //Loading Image Library
                $this->load->library('image_lib', $user_thumb);
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
                if ($this->input->post('hitext') == 1) {
                    redirect('freelancer/freelancer_add_post', refresh);
                } elseif ($this->input->post('hitext') == 2) {
                    redirect('freelancer/freelancer_hire_post', refresh);
                } elseif ($this->input->post('hitext') == 3) {
                    redirect('freelancer/freelancer_save', refresh);
                } elseif ($this->input->post('hitext') == 4) {
                    redirect('freelancer/freelancer_hire_profile', refresh);
                }
                // $redirect_url = site_url('dashboard');
                // redirect($redirect_url, 'refresh');
            } else {

                $contition_array = array('user_id' => $userid);
        $user_reg_data = $this->common->select_data_by_condition('freelancer_hire_reg', $contition_array, $data = 'freelancer_hire_user_image', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        $user_reg_prev_image = $user_reg_data[0]['freelancer_hire_user_image'];
        

        if ($user_reg_prev_image != '') {
            $user_image_main_path = $this->config->item('free_hire_profile_main_upload_path');
            $user_bg_full_image = $user_image_main_path . $user_reg_prev_image;
            if (isset($user_bg_full_image)) {
                unlink($user_bg_full_image);
            }
            
            $user_image_thumb_path = $this->config->item('free_hire_profile_thumb_upload_path');
            $user_bg_thumb_image = $user_image_thumb_path . $user_reg_prev_image;
            if (isset($user_bg_thumb_image)) {
                unlink($user_bg_thumb_image);
            }
        }





                $freelancer_hire_userimage = $imgdata['file_name'];
            }





            $data = array(
                'freelancer_hire_user_image' => $freelancer_hire_userimage,
                'modified_date' => date('Y-m-d', time())
            );

            $updatdata = $this->common->update_data($data, 'freelancer_hire_reg', 'user_id', $userid);
           // echo "<pre>"; print_r($updatdata);die();

            if ($updatdata) {
                if ($this->input->post('hitext') == 1) {
                    redirect('freelancer/freelancer_add_post', refresh);
                } elseif ($this->input->post('hitext') == 2) {
                    redirect('freelancer/freelancer_hire_post', refresh);
                } elseif ($this->input->post('hitext') == 3) {
                    redirect('freelancer/freelancer_save', refresh);
                } elseif ($this->input->post('hitext') == 4) {
                    redirect('freelancer/freelancer_hire_profile', refresh);
                }
            } else {
                $this->session->flashdata('error', 'Your data not inserted');
                redirect('freelancer/freelancer_hire_post', refresh);
            }
        }
    }

    public function user_image_add() {


        $userid = $this->session->userdata('aileenuser');


        if ($this->input->post('cancel1')) {  //echo "hii"; die();
            redirect('freelancer/freelancer_apply_post', refresh);
        } elseif ($this->input->post('cancel2')) {
            redirect('freelancer/freelancer_save_post', refresh);
        } elseif ($this->input->post('cancel3')) {
            redirect('freelancer/freelancer_post_profile', refresh);
        }


        if (empty($_FILES['profilepic']['name'])) {
            $this->form_validation->set_rules('profilepic', 'Upload profilepic', 'required');
        } else {
            // $config['upload_path'] = 'uploads/user_image/';
            // $config['allowed_types'] = 'jpg|jpeg|png|gif|mp4|3gp|mpeg|mpg|mpe|qt|mov|avi|pdf';

            // $config['file_name'] = $_FILES['profilepic']['name'];

            // //Load upload library and initialize configuration
            // $this->load->library('upload', $config);
            // $this->upload->initialize($config);

            // if ($this->upload->do_upload('profilepic')) {
            //     $uploadData = $this->upload->data();

            //     $picture = $uploadData['file_name'];
            // } else {
            //     $picture = '';
            // }


$freelancer_post_userimage = '';
            $user['upload_path'] = $this->config->item('free_post_profile_main_upload_path');
            $user['allowed_types'] = $this->config->item('free_post_profile_main_allowed_types');
            $user['max_size'] = $this->config->item('free_post_profile_main_max_size');
            $user['max_width'] = $this->config->item('free_post_profile_main_max_width');
            $user['max_height'] = $this->config->item('free_post_profile_main_max_height');
            $this->load->library('upload');
            $this->upload->initialize($user);
            //Uploading Image
            $this->upload->do_upload('profilepic');
            //Getting Uploaded Image File Data
            $imgdata = $this->upload->data();
            $imgerror = $this->upload->display_errors();
            if ($imgerror == '') {
                //Configuring Thumbnail 
                $user_thumb['image_library'] = 'gd2';
                $user_thumb['source_image'] = $user['upload_path'] . $imgdata['file_name'];
                $user_thumb['new_image'] = $this->config->item('free_post_profile_thumb_upload_path') . $imgdata['file_name'];
                $user_thumb['create_thumb'] = TRUE;
                $user_thumb['maintain_ratio'] = TRUE;
                $user_thumb['thumb_marker'] = '';
                $user_thumb['width'] = $this->config->item('free_post_profile_thumb_width');
                //$user_thumb['height'] = $this->config->item('user_thumb_height');
                $user_thumb['height'] = 2;
                $user_thumb['master_dim'] = 'width';
                $user_thumb['quality'] = "100%";
                $user_thumb['x_axis'] = '0';
                $user_thumb['y_axis'] = '0';
                //Loading Image Library
                $this->load->library('image_lib', $user_thumb);
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
                if ($this->input->post('hitext') == 1) {
                    redirect('freelancer/freelancer_applied_post', refresh);
                } elseif ($this->input->post('hitext') == 2) {
                    redirect('freelancer/freelancer_save_post', refresh);
                } elseif ($this->input->post('hitext') == 3) {
                    redirect('freelancer/freelancer_post_profile', refresh);
                }
                // $redirect_url = site_url('dashboard');
                // redirect($redirect_url, 'refresh');
            } else {


$contition_array = array('user_id' => $userid);
        $user_reg_data = $this->common->select_data_by_condition('freelancer_post_reg', $contition_array, $data = 'freelancer_post_user_image', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        $user_reg_prev_image = $user_reg_data[0]['freelancer_post_user_image'];
        

        if ($user_reg_prev_image != '') {
            $user_image_main_path = $this->config->item('free_post_profile_main_upload_path');
            $user_bg_full_image = $user_image_main_path . $user_reg_prev_image;
            if (isset($user_bg_full_image)) {
                unlink($user_bg_full_image);
            }
            
            $user_image_thumb_path = $this->config->item('free_post_profile_thumb_upload_path');
            $user_bg_thumb_image = $user_image_thumb_path . $user_reg_prev_image;
            if (isset($user_bg_thumb_image)) {
                unlink($user_bg_thumb_image);
            }
        }




                $freelancer_post_userimage = $imgdata['file_name'];
            }





            $data = array(
                'freelancer_post_user_image' => $freelancer_post_userimage,
                'modify_date' => date('Y-m-d', time())
            );


            $updatdata = $this->common->update_data($data, 'freelancer_post_reg', 'user_id', $userid);

            if ($updatdata) {
                if ($this->input->post('hitext') == 1) {
                    redirect('freelancer/freelancer_applied_post', refresh);
                } elseif ($this->input->post('hitext') == 2) {
                    redirect('freelancer/freelancer_save_post', refresh);
                } elseif ($this->input->post('hitext') == 3) {
                    redirect('freelancer/freelancer_post_profile', refresh);
                }
            } else {
                $this->session->flashdata('error', 'Your data not inserted');
                redirect('freelancer/freelancer_apply_post', refresh);
            }
        }
    }

    public function freelancer_hire_profile($id="") {
        //echo $id."userid is:";
        $userid = $this->session->userdata('aileenuser');
        //echo $userid;die();

//if user deactive profile then redirect to freelancer_hire/freelancer_hire/freelancer_hire_basic_info  start
  
 $contition_array = array('user_id'=> $userid,'status' => '0','is_delete'=> '0');

        $freelancerhire_deactive = $this->data['freelancerhire_deactive'] = $this->common->select_data_by_condition('freelancer_hire_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);

        if( $freelancerhire_deactive)
        {
            redirect('freelancer_hire/freelancer_hire/freelancer_hire_basic_info');
        }
//if user deactive profile then redirect to freelancer_hire/freelancer_hire/freelancer_hire_basic_info  start

        if ($id == $userid || $id == '') {

            $contition_array = array('user_id' => $userid, 'status' => '1');
            $this->data['freelancerhiredata'] = $this->common->select_data_by_condition('freelancer_hire_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
        } else {
            $contition_array = array('user_id' => $id, 'status' => '1' ,'free_hire_step' => 3);
            $this->data['freelancerhiredata'] = $this->common->select_data_by_condition('freelancer_hire_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
        }

// code for search
        $contition_array = array('status' => '1', 'is_delete' => '0');

        $field = $this->data['results'] = $this->common->select_data_by_condition('category', $contition_array, $data = 'category_name', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);


        $contition_array = array('status' => '1', 'is_delete' => '0','free_post_step' => 7);

        $freelancer_postdata = $this->data['results'] = $this->common->select_data_by_condition('freelancer_post_reg', $contition_array, $data = 'freelancer_post_otherskill,designation', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);
        // echo "<pre>"; print_r($results_recruiter);die();

        $contition_array = array('status' => '1', 'type' => '1');

        $skill = $this->data['skill'] = $this->common->select_data_by_condition('skill', $contition_array, $data = 'skill', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);

        $unique = array_merge($field, $skill, $freelancer_postdata);
        // echo count($unique);
        // $this->data['demo']=$unique;


        foreach ($unique as $key => $value) {
            foreach ($value as $ke => $val) {
                if ($val != "") {


                    $result[] = $val;
                }
            }
        }
        $results = array_unique($result);
        foreach($results as $key =>$value){
            $result1[$key]['label']=$value;
            $result1[$key]['value']=$value;
          }

 $contition_array = array('status' => '1');
          $location_list = $this->common->select_data_by_condition('cities', $contition_array, $data = 'city_name', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);
   

          foreach ($location_list as $key1 => $value) {
              foreach ($value as $ke1 => $val1) {
                 $location[] = $val1;
              }
          }
          //echo "<pre>"; print_r($location);die();
          foreach ($location as $key => $value) {
              $loc[$key]['label'] =$value;
              $loc[$key]['value'] =$value;
          }
         
 //echo "<pre>"; print_r($loc);die();

         // echo "<pre>"; print_r($loc);
          // echo "<pre>"; print_r($result1);die();

        $this->data['city_data']= array_values($loc);


         $this->data['demo']= array_values($result1);


        $this->load->view('freelancer/freelancer_hire/freelancer_hire_profile', $this->data);
    }

 public function pdf($id) {

$contition_array = array('user_id' => $id, 'status' => '1');
$this->data['freelancerdata'] = $freelancerdata = $this->common->select_data_by_condition('freelancer_post_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
 // echo "<pre>"; print_r($this->data['freelancerdata']);die();
$this->load->view('freelancer/freelancer_post/freelancer_pdf', $this->data);
 }

//Remove save candidate controller Start
    public function remove_save() {

        $saveid = $_POST['save_id'];
        //echo $saveid;die();
        $userid = $this->session->userdata('aileenuser');
        // echo $userid;echo $id;die();


        $data = array(
            'status' => 1
        );

        $updatedata = $this->common->update_data($data, 'save', 'save_id', $saveid);
    }

//Remove save candidate controller End

    public function freelancer_post_profile($id) {

        $userid = $this->session->userdata('aileenuser');

//if user deactive profile then redirect to freelancer/freelancer_post/freelancer_post_basic_information  start
        $contition_array = array('user_id'=> $userid,'status' => '0','is_delete'=> '0');

        $freelancerpost_deactive = $this->data['freelancerpost_deactive'] = $this->common->select_data_by_condition('freelancer_post_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);

        if( $freelancerpost_deactive)
        {
            redirect('freelancer/freelancer_post/freelancer_post_basic_information');
        }
    //if user deactive profile then redirect to freelancer/freelancer_post/freelancer_post_basic_information  End


        if ($id == $userid || $id == '') {

            $contition_array = array('user_id' => $userid);
            $this->data['freelancerpostdata'] = $this->common->select_data_by_condition('freelancer_post_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
            //echo "<pre>"; print_r($this->data['freelancerpostdata']); die();
        } else {
            $contition_array = array('user_id' => $id ,'free_post_step' => 7);
            $this->data['freelancerpostdata'] = $this->common->select_data_by_condition('freelancer_post_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
        }

        $contition_array = array('status' => '1', 'is_delete' => '0','free_post_step' => 7);

        $freelancer_postdata = $this->data['results'] = $this->common->select_data_by_condition('freelancer_post_reg', $contition_array, $data = 'designation,freelancer_post_otherskill', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby);
         //echo "<pre>"; print_r($freelancer_postdata);die();

        $contition_array = array('status' => '1', 'type' => '1');

        $skill = $this->data['results'] = $this->common->select_data_by_condition('skill', $contition_array, $data = 'skill', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby);

         $contition_array = array('status' => '1');

        $results_post = $this->data['results'] = $this->common->select_data_by_condition('freelancer_post', $contition_array, $data = 'post_name', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby);
         // echo "<pre>"; print_r($results_post);die();

        $contition_array = array('status' => '1', 'is_delete' => '0');

        $field = $this->data['results'] = $this->common->select_data_by_condition('category', $contition_array, $data = 'category_name', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);

        $uni = array_merge($skill, $freelancer_postdata, $field,$results_post);
        // echo count($unique);
        // $this->data['demo']=$uni;

        foreach ($uni as $key => $value) {
            foreach ($value as $ke => $val) {
                if ($val != "") {


                    $result[] = $val;
                }
            }
        }
        $results = array_unique($result);
        foreach($results as $key =>$value){
            $result1[$key]['label']=$value;
            $result1[$key]['value']=$value;
          }

 $contition_array = array('status' => '1');
          $location_list = $this->common->select_data_by_condition('cities', $contition_array, $data = 'city_name', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);
   

          foreach ($location_list as $key1 => $value1) {
              foreach ($value1 as $ke1 => $val1) {
                 $location[] = $val1;
              }
          }
          //echo "<pre>"; print_r($location);die();
          foreach ($location as $key => $value) {
              $loc[$key]['label'] =$value;
              $loc[$key]['value'] =$value;
          }
         
 //echo "<pre>"; print_r($loc);die();

        $this->data['city_data']= array_values($loc);

         
         $this->data['demo']= array_values($result1);
        $this->load->view('freelancer/freelancer_post/freelancer_post_profile', $this->data);
    }

    //keyskill automatic retrieve cobtroller start
    public function keyskill() {
        $json = [];
        $where = "type='1' AND status='1'";



        if (!empty($this->input->get("q"))) {
            $this->db->like('skill', $this->input->get("q"));
            $query = $this->db->select('skill_id as id,skill as text')
                    ->where($where)
                    ->limit(10)
                    ->get("skill");
            $json = $query->result();
        }


        echo json_encode($json);
    }

//keyskill automatic retrieve cobtroller End
//location automatic retrieve cobtroller start
    public function location() {
       $json = [];

        $this->load->database('aileensoul');


        // if (!empty($this->input->get("q"))) {
        //     $this->db->like('city_name', $this->input->get("q"));
        //     $query = $this->db->select('city_id as id,city_name as text')
        //             ->order_by("city_name", "asc")
        //             ->limit(10)
        //             ->get("cities");
        //     $json = $query->result();
        // }


        // echo json_encode($json);


          if (!empty($this->input->get("q"))) {
     $search_condition = "(city_name LIKE '" . trim($this->input->get("q")) . "%')";

     $tolist = $this->common->select_data_by_search('cities', $search_condition,$contition_array = array(), $data = 'city_id as id,city_name as text', $sortby = 'city_name', $orderby = 'asc', $limit = '', $offset = '', $join_str5 = '', $groupby = '');
   
//echo '<pre>'; print_r($tolist); die();
     }
      //  echo json_encode($tolist);
        echo json_encode($tolist);
    }

//location automatic retrieve cobtroller End
//freelancer post user search start

    public function freelancerpost_user($id) {

        $userid = $this->session->userdata('aileenuser');

        $contition_array = array('freelancer_post_reg.user_id' => $id, 'freelancer_post_reg.is_delete' => 0);

        $data = '*';

        $this->data['freelancerpostdata'] = $this->common->select_data_by_condition('freelancer_post_reg', $contition_array, $data, $sortby, $orderby, $limit, $offset, $join_str, $groupby);



        $this->load->view('freelancer/freelancer_post/freelancer_post_profile', $this->data);
    }

//freelancer post search end
    //freelancer hire user search start
    public function freelancerhire_user($id) {

        $userid = $this->session->userdata('aileenuser');
        //echo $userid;
        $contition_array = array('freelancer_hire_reg.user_id' => $id, 'freelancer_hire_reg.is_delete' => 0);

        $data = '*';

        $this->data['freelancerdata'] = $this->common->select_data_by_condition('freelancer_hire_reg', $contition_array, $data, $sortby, $orderby, $limit, $offset, $join_str, $groupby);


        $contition_array = array('user_id' => $id, 'is_delete' => 0);
        $this->data['freelancerpostdata'] = $this->common->select_data_by_condition('freelancer_post', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');



        $this->load->view('freelancer/freelancer_hire/freelancer_hire_post', $this->data);
    }

    //freelancer hire user search end 
//remove post at home page controoler start
    public function remove_post() {

        $postid = $_POST['post_id'];

        $data = array(
            'is_delete' => 1,
            'modify_date' => date('y-m-d h:i:s')
        );

        $updatedata = $this->common->update_data($data, 'freelancer_post', 'post_id', $postid);
    }

//remove post at home page controoler End
//invite user  at home page click on applied person controller Start
    public function invite_user($appid, $status, $postid, $personid) {
        $userid = $this->session->userdata('aileenuser');

        $data = array(
            'status' => $status,
            'modify_date' => date('y-m-d h:i:s')
        );


        $updatedata = $this->common->update_data($data, 'freelancer_apply', 'app_id', $appid);

        // insert notification

        $data = array(
            'not_type' => 4,
            'not_from_id' => $userid,
            'not_to_id' => $personid,
            'not_read' => 2,
            'not_from' => 5,
            'not_product_id' => $appid,
            "not_active" => 1,
            'not_created_date' => date('Y-m-d H:i:s')
        );

        $insert_id = $this->common->insert_data_getid($data, 'notification');
        // end notoification

        redirect('freelancer/freelancer_apply_list/' . $postid, 'refresh');
    }

//invite user  at home page click on applied person controller End
//deactivate user start for work
    public function deactivate() {
        
        $id =$_POST['id'];

        $data = array(
            'status' => 0
        );

        $update = $this->common->update_data($data, 'freelancer_post_reg', 'user_id', $id);

        // if ($update) {


        //     $this->session->set_flashdata('success', 'You are deactivate successfully.');
        //     redirect('dashboard', 'refresh');
        // } else {
        //     $this->session->flashdata('error', 'Sorry!! Your are not deactivate!!');
        //     redirect('freelancer/freelancer_post', 'refresh');
        // }
    }

// deactivate user end
//deactivate user start for hire
    public function deactivate_hire() {

    $id =$_POST['id'];

        $data = array(
            'status' => 0
        );

        $update = $this->common->update_data($data, 'freelancer_hire_reg', 'user_id', $id);
        $update = $this->common->update_data($data, 'freelancer_post', 'user_id', $id);

        // if ($update) {


        //     $this->session->set_flashdata('success', 'You are deactivate successfully.');
        //     redirect('dashboard', 'refresh');
        // } else {
        //     $this->session->flashdata('error', 'Sorry!! Your are not deactivate!!');
        //     redirect('freelancer/freelancer_hire_profile', 'refresh');
        // }
    }

// deactivate user end

    public function image_upload_ajax() {

        include 'db.php';

        session_start();


        $session_uid = $this->session->userdata('aileenuser');


        include_once 'getExtension.php';

        $valid_formats = array("jpg", "png", "gif", "bmp", "jpeg", "PNG", "JPG", "JPEG", "GIF", "BMP");
        if (isset($_POST) && $_SERVER['REQUEST_METHOD'] == "POST" && isset($session_uid)) {
            $name = $_FILES['photoimg']['name'];
            $size = $_FILES['photoimg']['size'];

            if ($name) {
                $ext = $this->common->getExtension($name);
                if (in_array($ext, $valid_formats)) {
                    if ($size < (1024 * 1024)) {
                        $actual_image_name = time() . $session_uid . "." . $ext;
                        $tmp = $_FILES['photoimg']['tmp_name'];
                        $bgSave = '<div id="uX' . $session_uid . '" class="bgSave wallbutton blackButton">Save Cover</div>';


// khyati start


                        $config['upload_path'] = $this->config->item('free_hire_bg_main_upload_path');
                        $config['allowed_types'] = $this->config->item('free_hire_bg_main_allowed_types');
                        // $config['file_name'] = $_FILES['picture']['name'];
                        $config['file_name'] = $_FILES['photoimg']['name'];
                        //$config['max_size'] = '1000000000000000';
                        //Load upload library and initialize configuration
                        $this->load->library('upload', $config);
                        $this->upload->initialize($config);

                        if ($this->upload->do_upload('photoimg')) {
                            $uploadData = $this->upload->data();

                            $picture = $uploadData['file_name'];
                        } else {
                            $picture = '';
                        }


                        $data = array(
                            'profile_background' => $picture
                        );

                        $update = $this->common->update_data($data, 'freelancer_hire_reg', 'user_id', $session_uid);
                        if ($update) {
                            $path = base_url($this->config->item('free_hire_bg_main_upload_path'));
                            echo $bgSave . '<img src="' . $path . $picture . '"  id="timelineBGload" class="headerimage ui-corner-all" style="top:0px"/>';
                        } else {
                            echo "Fail upload folder with read access.";
                        }
                    } else
                        echo "Image file size max 1 MB";
                } else
                    echo "Invalid file format.";
            } else
                echo "Please select image..!";

            exit;
        }
    }

    public function image_saveBG_ajax() {



        session_start();

        $session_uid = $this->session->userdata('aileenuser');

        if (isset($_POST['position']) && isset($session_uid)) {

            $position = $_POST['position'];

            $data = array(
                'profile_background_position' => $position
            );

            $update = $this->common->update_data($data, 'freelancer_hire_reg', 'user_id', $session_uid);
            if ($update) {

                echo $position;
            }
        }
    }

// cover pic controller

    public function ajaxpro_hire() {
        //echo "hiiii";die();
        $userid = $this->session->userdata('aileenuser');

        

$contition_array = array('user_id' => $userid);
        $user_reg_data = $this->common->select_data_by_condition('freelancer_hire_reg', $contition_array, $data = 'profile_background,profile_background_main', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        $user_reg_prev_image = $user_reg_data[0]['profile_background'];
        $user_reg_prev_main_image = $user_reg_data[0]['profile_background_main'];

        if ($user_reg_prev_image != '') {
            $user_image_main_path = $this->config->item('free_hire_bg_main_upload_path');
            $user_bg_full_image = $user_image_main_path . $user_reg_prev_image;
            if (isset($user_bg_full_image)) {
                unlink($user_bg_full_image);
            }
            
            $user_image_thumb_path = $this->config->item('free_hire_bg_thumb_upload_path');
            $user_bg_thumb_image = $user_image_thumb_path . $user_reg_prev_image;
            if (isset($user_bg_thumb_image)) {
                unlink($user_bg_thumb_image);
            }
        }
        if ($user_reg_prev_main_image != '') {
            $user_image_original_path = $this->config->item('free_hire_bg_original_upload_path');
            $user_bg_origin_image = $user_image_original_path . $user_reg_prev_main_image;
            if (isset($user_bg_origin_image)) {
                unlink($user_bg_origin_image);
            }
        }


        $data = $_POST['image'];


        // $imageName = time() . '.png';
        // $base64string = $data;
        // file_put_contents('uploads/free_hire_bg/' . $imageName, base64_decode(explode(',', $base64string)[1]));


$user_bg_path = $this->config->item('free_hire_bg_main_upload_path');
        $imageName = time() . '.png';
        $base64string = $data;
        file_put_contents($user_bg_path . $imageName, base64_decode(explode(',', $base64string)[1]));

        $user_thumb_path = $this->config->item('free_hire_bg_thumb_upload_path');
        $user_thumb_width = $this->config->item('free_hire_bg_thumb_width');
        $user_thumb_height = $this->config->item('free_hire_bg_thumb_height');

        $upload_image = $user_bg_path . $imageName;

        $thumb_image_uplode = $this->thumb_img_uplode($upload_image, $imageName, $user_thumb_path, $user_thumb_width, $user_thumb_height);



        $data = array(
            'profile_background' => $imageName
        );

        $update = $this->common->update_data($data, 'freelancer_hire_reg', 'user_id', $userid);

        $this->data['jobdata'] = $this->common->select_data_by_id('job_reg', 'user_id', $userid, $data = '*', $join_str = array());

        echo '<img src="' . $this->data['jobdata'][0]['profile_background'] . '" />';
    }

    public function image_hire() {
        //echo "hhhhhhhhh";die();
        $userid = $this->session->userdata('aileenuser');

        $config['upload_path'] = $this->config->item('free_hire_bg_original_upload_path');
        $config['allowed_types'] = $this->config->item('free_hire_bg_main_allowed_types');

        $config['file_name'] = $_FILES['image']['name'];

        //Load upload library and initialize configuration
        $this->load->library('upload', $config);
        $this->upload->initialize($config);

        if ($this->upload->do_upload('image')) {

            $uploadData = $this->upload->data();

            $image = $uploadData['file_name'];
        } else {

            $image = '';
        }


        $data = array(
            'profile_background_main' => $image,
            'modified_date' => date('Y-m-d h:i:s', time())
        );


        $updatedata = $this->common->update_data($data, 'freelancer_hire_reg', 'user_id', $userid);

        if ($updatedata) {
            echo $userid;
        } else {
            echo "welcome";
        }
    }

    // cover pic end
    // cover pic controller

    public function ajaxpro_work() {
        $userid = $this->session->userdata('aileenuser');


$contition_array = array('user_id' => $userid);
        $user_reg_data = $this->common->select_data_by_condition('freelancer_post_reg', $contition_array, $data = 'profile_background,profile_background_main', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        $user_reg_prev_image = $user_reg_data[0]['profile_background'];
        $user_reg_prev_main_image = $user_reg_data[0]['profile_background_main'];

        if ($user_reg_prev_image != '') {
            $user_image_main_path = $this->config->item('free_post_bg_main_upload_path');
            $user_bg_full_image = $user_image_main_path . $user_reg_prev_image;
            if (isset($user_bg_full_image)) {
                unlink($user_bg_full_image);
            }
            
            $user_image_thumb_path = $this->config->item('free_post_bg_thumb_upload_path');
            $user_bg_thumb_image = $user_image_thumb_path . $user_reg_prev_image;
            if (isset($user_bg_thumb_image)) {
                unlink($user_bg_thumb_image);
            }
        }
        if ($user_reg_prev_main_image != '') {
            $user_image_original_path = $this->config->item('free_post_bg_original_upload_path');
            $user_bg_origin_image = $user_image_original_path . $user_reg_prev_main_image;
            if (isset($user_bg_origin_image)) {
                unlink($user_bg_origin_image);
            }
        }




        $data = $_POST['image'];


        $user_bg_path = $this->config->item('free_post_bg_main_upload_path');
        $imageName = time() . '.png';
        $base64string = $data;
        file_put_contents($user_bg_path . $imageName, base64_decode(explode(',', $base64string)[1]));

        $user_thumb_path = $this->config->item('free_post_bg_thumb_upload_path');
        $user_thumb_width = $this->config->item('free_post_bg_thumb_width');
        $user_thumb_height = $this->config->item('free_post_bg_thumb_height');

        $upload_image = $user_bg_path . $imageName;

        $thumb_image_uplode = $this->thumb_img_uplode($upload_image, $imageName, $user_thumb_path, $user_thumb_width, $user_thumb_height);

        $data = array(
            'profile_background' => $imageName
        );
        //echo "<pre>";print_r($data);die();

        $update = $this->common->update_data($data, 'freelancer_post_reg', 'user_id', $userid);

        $this->data['jobdata'] = $this->common->select_data_by_id('freelancer_post_reg', 'user_id', $userid, $data = '*', $join_str = array());

        echo '<img src="' . $this->data['jobdata'][0]['profile_background'] . '" />';
    }

    public function image_work() {
        //echo "hiiii"; die();
        $userid = $this->session->userdata('aileenuser');

        $config['upload_path'] = $this->config->item('free_post_bg_original_upload_path');
        $config['allowed_types'] = $this->config->item('free_post_bg_main_allowed_types');

        $config['file_name'] = $_FILES['image']['name'];

        //Load upload library and initialize configuration
        $this->load->library('upload', $config);
        $this->upload->initialize($config);

        if ($this->upload->do_upload('image')) {

            $uploadData = $this->upload->data();

            $image = $uploadData['file_name'];
        } else {

            $image = '';
        }


        $data = array(
            'profile_background_main' => $image,
            'modify_date ' => date('Y-m-d h:i:s', time())
        );

        $updatedata = $this->common->update_data($data, 'freelancer_post_reg', 'user_id', $userid);

        if ($updatedata) {
            echo $userid;
        } else {
            echo "welcome";
        }
    }

    // cover pic end


    public function designation() {
        $userid = $this->session->userdata('aileenuser');


        $data = array(
            'designation' => trim($this->input->post('designation')),
            'modify_date' => date('Y-m-d', time())
        );

        $updatdata = $this->common->update_data($data, 'freelancer_post_reg', 'user_id', $userid);

        if ($updatdata) {

            if ($this->input->post('hitext') == 1) {
                redirect('freelancer/freelancer_post_profile', refresh);
            } elseif ($this->input->post('hitext') == 2) {
                redirect('freelancer/freelancer_save_post', refresh);
            } elseif ($this->input->post('hitext') == 3) {
                redirect('freelancer/freelancer_applied_post', refresh);
            }
        } else {
            $this->session->flashdata('error', 'Your data not inserted');
            redirect('freelancer/post_apply', refresh);
        }
    }

    //reactivate account start

    public function reactivate() {

        $userid = $this->session->userdata('aileenuser');
        $data = array(
            'status' => 1,
            'modify_date' => date('y-m-d h:i:s')
        );

        $updatdata = $this->common->update_data($data, 'freelancer_post_reg', 'user_id', $userid);
        if ($updatdata) {

            redirect('freelancer/freelancer_apply_post', refresh);
        } else {

            redirect('freelancer/reactivate', refresh);
        }
    }
    
    public function free_invite_user() {
        //echo "hiiiii";
         $postid = $_POST['post_id'];
         $invite_user = $_POST['invited_user']; 
        // echo $postid;
         //echo $invite_user;
         
        $userid = $this->session->userdata('aileenuser');
      
        $data = array(
            'user_id' => $userid,
            'post_id' => $postid,
            'invite_user_id' => $invite_user,
            'profile' => "freelancer"
            );
        $insert_id = $this->common->insert_data_getid($data, 'user_invite');
       
        if ($insert_id) {
            $data = array(
            'not_type' => 4,
            'not_from_id' => $userid,
            'not_to_id' => $invite_user,
            'not_read' => 2,
            'not_status' => 0,
            'not_product_id' => $insert_id,
            'not_from' => 5,
            "not_active" => 1,
            'not_created_date' => date('Y-m-d H:i:s')
            );
        $insert_id = $this->common->insert_data_getid($data, 'notification');
        echo 'Selected';
        } else {
            echo 'error';
        }
    }

//reactivate accont end

// delete portfilio pdf strat

    public function deletepdf() {

        $userid = $this->session->userdata('aileenuser');

         //if user deactive profile then redirect to artistic/index untill active profile start
         $contition_array = array('user_id'=> $userid,'status' => '0','is_delete'=> '0');

        $free_deactive = $this->data['free_deactive'] = $this->common->select_data_by_condition('freelancer_post_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);

        if($free_deactive)
        {
             redirect('freelancer/');
        }
     //if user deactive profile then redirect to artistic/index untill active profile End

        $contition_array = array('user_id' => $userid);
        $free_reg_data = $this->common->select_data_by_condition('freelancer_post_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

       $freeportfolio = $free_reg_data[0]['freelancer_post_portfolio_attachment'];

        if ($freeportfolio != '') {
            $free_pdf_path = 'uploads/freelancer_post_portfolio/main';
            $free_pdf = $free_pdf_path . $freeportfolio;
            if (isset($free_pdf)) { 
                unlink($free_pdf);
            }
        }

        $data = array(
            'freelancer_post_portfolio_attachment' => ''
        );

        $update = $this->common->update_data($data, 'freelancer_post_reg', 'user_id', $userid);
        echo 'ok';
    }

    //pdf delete end
}
