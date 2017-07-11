<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Artistic extends MY_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->library('form_validation');
        $this->load->model('email_model');
        if (!$this->session->userdata('aileenuser')) {
            redirect('login', 'refresh');
        }

        include ('include.php');
    }

    public function index() {
        $userid = $this->session->userdata('aileenuser');

        $contition_array = array('user_id' => $userid, 'status' => '0');
        $artdata = $this->common->select_data_by_condition('art_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
        if ($artdata) {

            $this->load->view('artistic/reactivate', $this->data);
        } else {

            $contition_array = array('user_id' => $userid, 'is_delete' => '0', 'status' => '1');
            $artdata = $this->common->select_data_by_condition('art_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

            $contition_array = array('user_id' => $userid, 'is_delete' => '0', 'status' => '1');
            $this->data['art'] = $this->common->select_data_by_condition('user', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');


            if (count($artdata) > 0) {

                if ($artdata[0]['art_step'] == 1) {
                    redirect('artistic/art_address', refresh);
                } else if ($artdata[0]['art_step'] == 2) {
                    redirect('artistic/art_information', refresh);
                } else if ($artdata[0]['art_step'] == 3) {
                    redirect('artistic/art_post', refresh);
                } else if ($artdata[0]['art_step'] == 4) {
                    redirect('artistic/art_post', refresh);
                }
            } else {
                $this->load->view('artistic/art_basic_information', $this->data);
            }
        }
    }

    public function comment() {
        $this->load->view('artistic/comment');
    }

    public function abc() {

        $userid = $this->session->userdata('aileenuser');

         //if user deactive profile then redirect to artistic/index untill active profile start
         $contition_array = array('user_id'=> $userid,'status' => '0','is_delete'=> '0');

        $artistic_deactive = $this->data['artistic_deactive'] = $this->common->select_data_by_condition('art_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);

        if($artistic_deactive)
        {
             redirect('artistic/');
        }
     //if user deactive profile then redirect to artistic/index untill active profile End

        $contition_array = array('status' => '1', 'type' => '2');
        $this->data['skill'] = $this->common->select_data_by_condition('skill', $contition_array, $data = '*', $sortby = 'skill', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');


        $contition_array = array('status' => '1', 'user_id' => $userid);
        $this->data['artistic'] = $this->common->select_data_by_condition('art_reg', $contition_array, $data = '*', $sortby = '', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        $skildata = explode(',', $this->data['artistic'][0]['art_skill']);
        $this->data['selectdata'] = $skildata;
        $this->load->view('artistic/abc', $this->data);
    }

    public function art_basic_information_update() {
        $userid = $this->session->userdata('aileenuser');

         //if user deactive profile then redirect to artistic/index untill active profile start
         $contition_array = array('user_id'=> $userid,'status' => '0','is_delete'=> '0');

        $artistic_deactive = $this->data['artistic_deactive'] = $this->common->select_data_by_condition('art_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);

        if($artistic_deactive)
        {
             redirect('artistic/');
        }
     //if user deactive profile then redirect to artistic/index untill active profile End

        $contition_array = array('user_id' => $userid, 'is_delete' => '0', 'status' => '1');
        $userdata = $this->common->select_data_by_condition('art_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        if ($userdata) {
            $step = $userdata[0]['art_step'];

            if ($step == 1 || $step > 1) {
                $this->data['firstname1'] = $userdata[0]['art_name'];
                $this->data['lastname1'] = $userdata[0]['art_lastname'];
                $this->data['email1'] = $userdata[0]['art_email'];
                $this->data['phoneno1'] = $userdata[0]['art_phnno'];
            }
        }

        // code for search
        $contition_array = array('status' => '1', 'is_delete' => '0' , 'art_step' => 4);
        $artdata = $this->data['results'] = $this->common->select_data_by_condition('art_reg', $contition_array, $data = 'art_name,art_lastname,designation,other_skill', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);


        $return_array = array();
        //  //echo  $return_array;

        foreach ($artdata as $get) {
            $return = array();
            $return = $get;


            $return['firstname'] = $get['art_name'] . " " . $get['art_lastname'];
            unset($return['art_name']);
            unset($return['art_lastname']);

            array_push($return_array, $return);
            //echo $returnarray; 
        }

        // $contition_array = array('status' => '1');
        // $artpost= $this->data['results'] =  $this->common->select_data_by_condition('art_post', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);

        $contition_array = array('status' => '1', 'type' => '2');

        $artpost = $this->data['results'] = $this->common->select_data_by_condition('skill', $contition_array, $data = 'skill', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);
        // echo "<pre>"; print_r($artpost);die();


        $uni = array_merge($return_array, $artpost);
        //   echo count($unique);


        foreach ($uni as $key => $value) {
            foreach ($value as $ke => $val) {
                if ($val != "") {


                    $result[] = $val;
                }
            }
        }
        $results = array_unique($result);
        foreach ($results as $key => $value) {
            $result1[$key]['label'] = $value;
            $result1[$key]['value'] = $value;
        }

        $this->data['demo'] = array_values($result1);
             $contition_array = array('status' => '1');

       
        $cty = $this->data['cty'] = $this->common->select_data_by_condition('cities', $contition_array, $data = 'city_name', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);
           

            foreach ($cty as $key => $value) {
            foreach ($value as $ke => $val) {
                if ($val != "") {


                    $resu[] = $val;
                }
            }
        }
        $resul = array_unique($resu);
        foreach ($resul as $key => $value) {
            $res[$key]['label'] = $value;
            $res[$key]['value'] = $value;
        }
        
        $this->data['de'] = array_values($res);


        $this->load->view('artistic/art_basic_information', $this->data);
    }

    public function art_basic_information_insert() { 

        $userid = $this->session->userdata('aileenuser');

         //if user deactive profile then redirect to artistic/index untill active profile start
         $contition_array = array('user_id'=> $userid,'status' => '0','is_delete'=> '0');

        $artistic_deactive = $this->data['artistic_deactive'] = $this->common->select_data_by_condition('art_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);

        if($artistic_deactive)
        {
             redirect('artistic/');
        }
     //if user deactive profile then redirect to artistic/index untill active profile End


        $this->form_validation->set_rules('firstname', 'Please Enter Your Name', 'required');

        $this->form_validation->set_rules('email', 'Please Enter Your EmailId', 'required|valid_email');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('artistic/art_basic_information');
        }


        $contition_array = array('user_id' => $userid, 'is_delete' => '0', 'status' => '1');
        $userdata = $this->common->select_data_by_condition('art_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');


        if ($userdata) {
            $data = array(
                'art_name' => $this->input->post('firstname'),
                'art_lastname' => $this->input->post('lastname'),
                'art_email' => $this->input->post('email'),
                'art_phnno' => $this->input->post('phoneno'),
                'modified_date' => date('Y-m-d', time())
            );

            $updatdata = $this->common->update_data($data, 'art_reg', 'user_id', $userid);

            if ($updatdata) {
                $this->session->set_flashdata('success', 'Basic Information updated successfully');
                redirect('artistic/art_address', refresh);
            } else {
                $this->session->flashdata('error', 'Sorry!! Your data not inserted');
                redirect('artistic/art_basic_information_insert', refresh);
            }
        } else {
            $data = array(
                'art_name' => $this->input->post('firstname'),
                'art_lastname' => $this->input->post('lastname'),
                'art_email' => $this->input->post('email'),
                'art_phnno' => $this->input->post('phoneno'),
                'user_id' => $userid,
                'created_date' => date('Y-m-d H:i:s', time()),
                'status' => 1,
                'is_delete' => 0,
                'art_step' => 1
            );



            $insert_id = $this->common->insert_data_getid($data, 'art_reg');
            if ($insert_id) {


                $this->session->set_flashdata('success', 'Basic Information updated successfully');
                redirect('artistic/art_address', refresh);
            } else {
                $this->session->flashdata('error', 'Sorry!! Your data not inserted');
                redirect('artistic/art_basic_information_insert', refresh);
            }
        }
    }

//check mail start
    public function check_email() {


        $email = $this->input->post('email');

        $userid = $this->session->userdata('aileenuser');

        $contition_array = array('user_id' => $userid, 'is_delete' => '0', 'status' => '1');
        $userdata = $this->common->select_data_by_condition('art_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        $email1 = $userdata[0]['art_email'];


        if ($email1) {
            $condition_array = array('is_delete' => '0', 'user_id !=' => $userid, 'status' => '1' , 'art_step' => 4);

            $check_result = $this->common->check_unique_avalibility('art_reg', 'art_email', $email, '', '', $condition_array);
        } else {

            $condition_array = array('is_delete' => '0', 'status' => '1');

            $check_result = $this->common->check_unique_avalibility('art_reg', 'art_email', $email, '', '', $condition_array);
        }

        if ($check_result) {
            echo 'true';
            die();
        } else {
            echo 'false';
            die();
        }
    }

//check mail end


    public function art_address() {

        $userid = $this->session->userdata('aileenuser');

         //if user deactive profile then redirect to artistic/index untill active profile start
         $contition_array = array('user_id'=> $userid,'status' => '0','is_delete'=> '0');

        $artistic_deactive = $this->data['artistic_deactive'] = $this->common->select_data_by_condition('art_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);

        if($artistic_deactive)
        {
             redirect('artistic/');
        }
     //if user deactive profile then redirect to artistic/index untill active profile End

        $contition_array = array('status' => 1);
        $this->data['countries'] = $this->common->select_data_by_condition('countries', $contition_array, $data = '*', $sortby = 'country_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');


$contition_array = array('user_id' => $userid, 'is_delete' => '0', 'status' => '1');
        $userdata = $this->common->select_data_by_condition('art_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');


        //for getting state data
        $contition_array = array('status' => 1,'country_id' => $userdata[0]['art_country']);
        $this->data['states'] = $this->common->select_data_by_condition('states', $contition_array, $data = '*', $sortby = 'state_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        //for getting city data
        $contition_array = array('status' => 1,'state_id'=> $userdata[0]['art_state']);
       $this->data['cities'] = $this->common->select_data_by_condition('cities', $contition_array, $data = '*', $sortby = 'city_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');



        

        if ($userdata) {
            $step = $userdata[0]['art_step'];

            if ($step == 2 || $step > 2 || ($step >= 1 && $step <= 2)) {
                $this->data['country1'] = $userdata[0]['art_country'];
                $this->data['state1'] = $userdata[0]['art_state'];
                $this->data['city1'] = $userdata[0]['art_city'];
                $this->data['pincode1'] = $userdata[0]['art_pincode'];
                $this->data['address1'] = $userdata[0]['art_address'];
            }
        }
        // code for search
        $contition_array = array('status' => '1', 'is_delete' => '0' , 'art_step' => 4);


        $artdata = $this->data['results'] = $this->common->select_data_by_condition('art_reg', $contition_array, $data = 'art_name,art_lastname,designation,other_skill', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);


        $return_array = array();
        //  //echo  $return_array;

        foreach ($artdata as $get) {
            $return = array();
            $return = $get;


            $return['firstname'] = $get['art_name'] . " " . $get['art_lastname'];
            unset($return['art_name']);
            unset($return['art_lastname']);

            array_push($return_array, $return);
            //echo $returnarray; 
        }

        // $contition_array = array('status' => '1');
        // $artpost= $this->data['results'] =  $this->common->select_data_by_condition('art_post', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);

        $contition_array = array('status' => '1', 'type' => '2');

        $artpost = $this->data['results'] = $this->common->select_data_by_condition('skill', $contition_array, $data = 'skill', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);
        // echo "<pre>"; print_r($artpost);die();


        $uni = array_merge($return_array, $artpost);
        //   echo count($unique);


        foreach ($uni as $key => $value) {
            foreach ($value as $ke => $val) {
                if ($val != "") {


                    $result[] = $val;
                }
            }
        }
        $results = array_unique($result);
        foreach ($results as $key => $value) {
            $result1[$key]['label'] = $value;
            $result1[$key]['value'] = $value;
        }

        $this->data['demo'] = array_values($result1);
             $contition_array = array('status' => '1');

       
        $citiesss = $this->data['cty'] = $this->common->select_data_by_condition('cities', $contition_array, $data = 'city_name', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);
           

        //    

        foreach ($citiesss as $key1) {
              
                 $location[] = $key1['city_name'];
             
          }
         // echo "<pre>"; print_r($location);die();
          foreach ($location as $key => $value) {
              $loc[$key]['label'] =$value;
              $loc[$key]['value'] =$value;
          }
        
        $this->data['city_data']= $loc;


        $this->load->view('artistic/art_address', $this->data);
    }

    public function ajax_data() {

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
    }

    public function art_address_insert() {

        $userid = $this->session->userdata('aileenuser');

         //if user deactive profile then redirect to artistic/index untill active profile start
         $contition_array = array('user_id'=> $userid,'status' => '0','is_delete'=> '0');

        $artistic_deactive = $this->data['artistic_deactive'] = $this->common->select_data_by_condition('art_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);

        if($artistic_deactive)
        {
             redirect('artistic/');
        }
     //if user deactive profile then redirect to artistic/index untill active profile End


        if ($this->input->post('next')) {

            $this->form_validation->set_rules('country', 'Country', 'required');
            $this->form_validation->set_rules('state', 'State', 'required');
            $this->form_validation->set_rules('address', 'Address', 'required');
            $this->form_validation->set_rules('pincode', 'Pincode', 'numeric');
           // echo $this->input->post('pincode');die();
            if ($this->form_validation->run() == FALSE) {
                $this->load->view('artistic/art_address');
            } else {


                $contition_array = array('user_id' => $userid, 'is_delete' => '0', 'status' => '1');
                $artuserdata = $this->common->select_data_by_condition('art_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
                if ($artuserdata[0]['art_step'] == 4) {

                    $data = array(
                        'art_country' => $this->input->post('country'),
                        'art_state' => $this->input->post('state'),
                        'art_city' => $this->input->post('city'),
                        'art_address' => $this->input->post('address'),
                        'art_pincode' => $this->input->post('pincode'),
                        'modified_date' => date('Y-m-d', time())
                            //'art_step' => 2
                    );
                } else {

                    $data = array(
                        'art_country' => $this->input->post('country'),
                        'art_state' => $this->input->post('state'),
                        'art_city' => $this->input->post('city'),
                        'art_address' => $this->input->post('address'),
                        'art_pincode' => $this->input->post('pincode'),
                        'modified_date' => date('Y-m-d', time()),
                        'art_step' => 2
                    );
                }
                $updatdata = $this->common->update_data($data, 'art_reg', 'user_id', $userid);


                if ($updatdata) {
                    $this->session->set_flashdata('success', 'Address updated successfully');
                    redirect('artistic/art_information', refresh);
                } else {
                    $this->session->flashdata('error', 'Your data not inserted');
                    redirect('artistic/art_address', refresh);
                }
            }
        }
    }

    public function art_information() {

        $userid = $this->session->userdata('aileenuser');

         //if user deactive profile then redirect to artistic/index untill active profile start
         $contition_array = array('user_id'=> $userid,'status' => '0','is_delete'=> '0');

        $artistic_deactive = $this->data['artistic_deactive'] = $this->common->select_data_by_condition('art_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);

        if($artistic_deactive)
        {
             redirect('artistic/');
        }
     //if user deactive profile then redirect to artistic/index untill active profile End
        $contition_array = array('user_id' => $userid, 'is_delete' => '0', 'status' => '1');
        $userdata = $this->common->select_data_by_condition('art_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');


        $contition_array = array('status' => 1, 'type' => 2);
        $this->data['skill'] = $this->common->select_data_by_condition('skill', $contition_array, $data = '*', $sortby = 'skill', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');


        if ($userdata) {
            $step = $userdata[0]['art_step'];

            if ($step == 3 || ($step >= 1 && $step <= 3) || $step > 3) {
                $this->data['artname1'] = $userdata[0]['art_yourart'];
                $this->data['desc_art1'] = $userdata[0]['art_desc_art'];
                $this->data['inspire1'] = $userdata[0]['art_inspire'];
                $this->data['skills1'] = $userdata[0]['art_skill'];
                $this->data['otherskill1'] = $userdata[0]['other_skill'];
            }
        }

        $skildata = explode(',', $userdata[0]['art_skill']);
        $this->data['selectdata'] = $skildata;
        //echo "<pre>"; print_r( $this->data['selectdata']); die();
        // code for search
        $contition_array = array('status' => '1', 'is_delete' => '0' , 'art_step' => 4);


        $artdata = $this->data['results'] = $this->common->select_data_by_condition('art_reg', $contition_array, $data = 'art_name,art_lastname,designation,other_skill', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);


        $return_array = array();
        //  //echo  $return_array;

        foreach ($artdata as $get) {
            $return = array();
            $return = $get;


            $return['firstname'] = $get['art_name'] . " " . $get['art_lastname'];
            unset($return['art_name']);
            unset($return['art_lastname']);

            array_push($return_array, $return);
            //echo $returnarray; 
        }

        // $contition_array = array('status' => '1');
        // $artpost= $this->data['results'] =  $this->common->select_data_by_condition('art_post', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);

        $contition_array = array('status' => '1', 'type' => '2');

        $artpost = $this->data['results'] = $this->common->select_data_by_condition('skill', $contition_array, $data = 'skill', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);
        // echo "<pre>"; print_r($artpost);die();


        $uni = array_merge($return_array, $artpost);
        //   echo count($unique);


        foreach ($uni as $key => $value) {
            foreach ($value as $ke => $val) {
                if ($val != "") {


                    $result[] = $val;
                }
            }
        }
        $results = array_unique($result);
        foreach ($results as $key => $value) {
            $result1[$key]['label'] = $value;
            $result1[$key]['value'] = $value;
        }

        $this->data['demo'] = array_values($result1);
             $contition_array = array('status' => '1');

       
        $cty = $this->data['cty'] = $this->common->select_data_by_condition('cities', $contition_array, $data = 'city_name', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);
           

            foreach ($cty as $key => $value) {
            foreach ($value as $ke => $val) {
                if ($val != "") {


                    $resu[] = $val;
                }
            }
        }
        $resul = array_unique($resu);
        foreach ($resul as $key => $value) {
            $res[$key]['label'] = $value;
            $res[$key]['value'] = $value;
        }
        
        $this->data['de'] = array_values($res);



        $this->load->view('artistic/art_information', $this->data);
    }

    public function art_information_insert() {
        $userid = $this->session->userdata('aileenuser');

         //if user deactive profile then redirect to artistic/index untill active profile start
         $contition_array = array('user_id'=> $userid,'status' => '0','is_delete'=> '0');

        $artistic_deactive = $this->data['artistic_deactive'] = $this->common->select_data_by_condition('art_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);

        if($artistic_deactive)
        {
             redirect('artistic/');
        }
     //if user deactive profile then redirect to artistic/index untill active profile End
        $skill = $this->input->post('skills');
        $otherskill = $this->input->post('other_skill');


        $contition_array = array('user_id' => $userid, 'is_delete' => '0', 'status' => '1');
        $artuserdata = $this->common->select_data_by_condition('art_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
        if ($artuserdata[0]['art_step'] == 4) {

            $data = array(
                'art_yourart' => $this->input->post('artname'),
                'other_skill' => $this->input->post('other_skill'),
                'art_skill' => implode(',', $skill),
                'art_desc_art' => $this->input->post('desc_art'),
                'art_inspire' => $this->input->post('inspire'),
                'modified_date' => date('Y-m-d', time()),
                    //'art_step' => 3
            );
        } else {

            $data = array(
                'art_yourart' => $this->input->post('artname'),
                'other_skill' => $this->input->post('other_skill'),
                'art_skill' => implode(',', $skill),
                'art_desc_art' => $this->input->post('desc_art'),
                'art_inspire' => $this->input->post('inspire'),
                'modified_date' => date('Y-m-d', time()),
                'art_step' => 3
            );
        }

        $updatdata = $this->common->update_data($data, 'art_reg', 'user_id', $userid);

        $skilldata = $this->common->select_data_by_id('skill', 'skill', $otherskill, $data = '*', $join_str = array());
        if ($skilldata || $otherskill == "") {
            
        } else {
            $data1 = array(
                'skill' => $this->input->post('other_skill'),
                'type' => 2,
                'status' => 1
            );

            $insertid = $this->common->insert_data_getid($data1, 'skill');
        }



        if ($updatdata) {
            $this->session->set_flashdata('success', 'Information updated successfully');
            redirect('artistic/art_portfolio', refresh);
        } else {
            $this->session->flashdata('error', 'Your data not inserted');
            redirect('artistic/art_information', refresh);
        }
    }

    public function art_portfolio() {

        $userid = $this->session->userdata('aileenuser');

         //if user deactive profile then redirect to artistic/index untill active profile start
         $contition_array = array('user_id'=> $userid,'status' => '0','is_delete'=> '0');

        $artistic_deactive = $this->data['artistic_deactive'] = $this->common->select_data_by_condition('art_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);

        if($artistic_deactive)
        {
             redirect('artistic/');
        }
     //if user deactive profile then redirect to artistic/index untill active profile End
        $contition_array = array('user_id' => $userid, 'is_delete' => '0', 'status' => '1');
        $userdata = $this->data['userdata'] = $this->common->select_data_by_condition('art_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        if ($userdata) {
            $step = $userdata[0]['art_step'];

            if ($step == 4 || ($step >= 1 && $step <= 4) || $step > 4) {
                $this->data['bestofmine1'] = $userdata[0]['art_bestofmine'];
                $this->data['achievmeant1'] = $userdata[0]['art_achievement'];
                $this->data['art_portfolio1'] = $userdata[0]['art_portfolio'];
            }
        }

        // code for search
        $contition_array = array('status' => '1', 'is_delete' => '0' , 'art_step' => 4);


        $artdata = $this->data['results'] = $this->common->select_data_by_condition('art_reg', $contition_array, $data = 'art_name,art_lastname,designation,other_skill', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);


        $return_array = array();
        //  //echo  $return_array;

        foreach ($artdata as $get) {
            $return = array();
            $return = $get;


            $return['firstname'] = $get['art_name'] . " " . $get['art_lastname'];
            unset($return['art_name']);
            unset($return['art_lastname']);

            array_push($return_array, $return);
            //echo $returnarray; 
        }

        // $contition_array = array('status' => '1');
        // $artpost= $this->data['results'] =  $this->common->select_data_by_condition('art_post', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);

        $contition_array = array('status' => '1', 'type' => '2');

        $artpost = $this->data['results'] = $this->common->select_data_by_condition('skill', $contition_array, $data = 'skill', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);
        // echo "<pre>"; print_r($artpost);die();


        $uni = array_merge($return_array, $artpost);
        //   echo count($unique);


        foreach ($uni as $key => $value) {
            foreach ($value as $ke => $val) {
                if ($val != "") {


                    $result[] = $val;
                }
            }
        }
        $results = array_unique($result);
        foreach ($results as $key => $value) {
            $result1[$key]['label'] = $value;
            $result1[$key]['value'] = $value;
        }

        $this->data['demo'] = array_values($result1);
             $contition_array = array('status' => '1');

       
        $cty = $this->data['cty'] = $this->common->select_data_by_condition('cities', $contition_array, $data = 'city_name', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);
           

            foreach ($cty as $key => $value) {
            foreach ($value as $ke => $val) {
                if ($val != "") {


                    $resu[] = $val;
                }
            }
        }
        $resul = array_unique($resu);
        foreach ($resul as $key => $value) {
            $res[$key]['label'] = $value;
            $res[$key]['value'] = $value;
        }
        
        $this->data['de'] = array_values($res);


        $this->load->view('artistic/art_portfolio', $this->data);
    }

    // public function art_portfolio_insert() {
    //     $userid = $this->session->userdata('aileenuser');
    //     //echo "<pre>"; print_r($_POST); die();
    //     //best of mine image upload code start
    //     $contition_array = array('user_id' => $userid);
    //     $art_reg_data = $this->common->select_data_by_condition('art_reg', $contition_array, $data = 'art_bestofmine', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
    //     $art_bestofmine = $art_reg_data[0]['art_bestofmine']; 
    //     if ($art_bestofmine != '') {
    //         $art_pdf_path = 'uploads/art_images/';
    //         $art_pdf = $art_pdf_path . $art_bestofmine;
    //         if (isset($art_pdf)) {
    //             unlink($art_pdf);
    //         }
    //     }
    //     $config['upload_path'] = 'uploads/art_images/';
    //     $config['allowed_types'] = 'pdf';
    //     $config['file_name'] = $_FILES['bestofmine']['name'];
    //     $config['upload_max_filesize'] = '40M';
    //     //Load upload library and initialize configuration
    //     $this->load->library('upload', $config);
    //     $this->upload->initialize($config);
    //     if ($this->upload->do_upload('bestofmine')) {
    //         $uploadData = $this->upload->data();
    //         $picture = $uploadData['file_name'];
    //     } else {
    //         $picture = '';
    //     }
    //     //best of mine image upload code End
    //     // //Achievement image upload code start
    //     // $config['upload_path'] = 'uploads/art_images/';
    //     // $config['allowed_types'] = 'jpg|jpeg|png|gif|mp4|3gp|pdf|mp3';
    //     // $config['file_name'] = $_FILES['achievmeant']['name'];
    //     // $config['upload_max_filesize'] = '40M';
    //     // //Load upload library and initialize configuration
    //     // $this->load->library('upload', $config);
    //     // $this->upload->initialize($config);
    //     // if ($this->upload->do_upload('achievmeant')) {
    //     //     $uploadData = $this->upload->data();
    //     //     $picture_achiev = $uploadData['file_name'];
    //     // } else {
    //     //     $picture_achiev = '';
    //     // }
    //     // //Achievement image upload code End
    //         $data = array(
    //             'art_bestofmine' => $picture,
    //             'art_portfolio' => $_POST('artportfolio'),
    //             'modified_date' => date('Y-m-d', time()),
    //             'art_step' => 4
    //         );
    //    echo "<pre>"; print_r($data); die();
    //     $updatdata = $this->common->update_data($data, 'art_reg', 'user_id', $userid);
    //     if ($updatdata) {
    //         $this->session->set_flashdata('success', 'Portfolio updated successfully');
    //         redirect('artistic/artistic_profile', refresh);
    //     } else {
    //         $this->session->flashdata('error', 'Your data not inserted');
    //         redirect('artistic/art_portfolio', refresh);
    //     }
    // }


    public function art_portfolio_insert() {
 //echo "<pre>"; print_r($_FILES); 
 // echo "<pre>"; print_r($_POST); die();


        $userid = $this->session->userdata('aileenuser');

         //if user deactive profile then redirect to artistic/index untill active profile start
         $contition_array = array('user_id'=> $userid,'status' => '0','is_delete'=> '0');

        $artistic_deactive = $this->data['artistic_deactive'] = $this->common->select_data_by_condition('art_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);

        if($artistic_deactive)
        {
             redirect('artistic/');
        }
     //if user deactive profile then redirect to artistic/index untill active profile End
        $artportfolio = $_POST['artportfolio'];
         $bestmine = $_POST['bestmine'];
        
        // $bestofmine = $_POST['bestofmine']; 
        //best of mine image upload code start
//echo "<pre>"; print_r($artportfolio); die();
    

        $contition_array = array('user_id' => $userid);
        $art_reg_data = $this->common->select_data_by_condition('art_reg', $contition_array, $data = 'art_bestofmine', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        $art_bestofmine = $art_reg_data[0]['art_bestofmine'];

        if ($art_bestofmine != '') {
            $art_pdf_path = $this->config->item('art_portfolio_main_upload_path');
            $art_pdf = $art_pdf_path . $art_bestofmine;
            if (isset($art_pdf)) {
                unlink($art_pdf);
            }
        }


         $config = array(
            'upload_path' => $this->config->item('art_portfolio_main_upload_path'),
            'max_size' => 2500000000000,
            'allowed_types' => $this->config->item('art_portfolio_main_allowed_types'),
            'file_name' => $_FILES['bestofmine']['name']
               
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
                $art_post_thumb['source_image'] = $this->config->item('art_portfolio_main_upload_path') . $response['result']['file_name'];
                $art_post_thumb['new_image'] = $this->config->item('art_portfolio_thumb_upload_path') . $response['result']['file_name'];
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

            $dataimage = $bestmine;
        }

       //echo "<pre>"; print_r($dataimage); die();

        //if ($dataimage) {
            $data = array(
                'art_bestofmine' => $dataimage,
                'art_portfolio' => $artportfolio,
                'modified_date' => date('Y-m-d', time()),
                'art_step' => 4
            );


            $updatdata = $this->common->update_data($data, 'art_reg', 'user_id', $userid);
       // } 
        //    if ($artportfolio) {


        //     $data = array(
        //         //'art_bestofmine' => $picture,
        //         'art_portfolio' => $artportfolio,
        //         'modified_date' => date('Y-m-d', time()),
        //         'art_step' => 4
        //     );


        //     $updatdata = $this->common->update_data($data, 'art_reg', 'user_id', $userid);
        // }

    }

    public function art_post() {

        $user_name = $this->session->userdata('user_name');


        $userid = $this->session->userdata('aileenuser');

         //if user deactive profile then redirect to artistic/index untill active profile start
         $contition_array = array('user_id'=> $userid,'status' => '0','is_delete'=> '0');

        $artistic_deactive = $this->data['artistic_deactive'] = $this->common->select_data_by_condition('art_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);

        if($artistic_deactive)
        {
             redirect('artistic/');
        }
     //if user deactive profile then redirect to artistic/index untill active profile End

        $contition_array = array('user_id' => $userid, 'status' => '1');
        $this->data['artisticdata'] = $this->common->select_data_by_condition('art_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        //echo "<pre>"; print_r($this->data['artisticdata']); die();
        $artregid = $this->data['artisticdata'][0]['art_id'];


//userlist for followdata strat
        $likeuserarray = explode(',', $this->data['artisticdata'][0]['art_skill']);
        //echo "<pre>"; print_r($likeuserarray); die();
        $contition_array = array('is_delete' => 0, 'status' => 1, 'user_id !=' => $userid , 'art_step' => 4);
        $userlist = $this->data['userlist'] = $this->common->select_data_by_condition('art_reg', $contition_array, $data = '*', $sortby = 'art_id', $orderby = 'DESC', $limit = '', $offset = '', $join_str = array(), $groupby = '');


//using skill user     
        foreach ($userlist as $row) {

            $userlistarray = explode(',', $row['art_skill']);
            //echo "<pre>"; print_r($likeuserarray);
            //echo "<pre>"; print_r($userlistarray); 
            if (array_intersect($likeuserarray, $userlistarray)) {
                $usernamelist[] = $row;
            }
        }


        $this->data['userlistview1'] = $usernamelist;
        //echo "<pre>"; print_r($this->data['userlistview1']); die();
//using city user     

        $artregcity = $this->data['artisticdata'][0]['art_city'];
        foreach ($userlist as $rowcity) {

            $userlistarray1 = explode(',', $rowcity['art_skill']);
            if (array_intersect($likeuserarray, $userlistarray1)) {
                
            } else {

                if ($artregcity == $rowcity['art_city']) {
                    $userlistcity[] = $rowcity;
                }
            }
        }

        $this->data['userlistview2'] = $userlistcity;
        // echo "<pre>"; print_r($this->data['userlistview2']); die();
//using state user     

        $contition_array = array('is_delete' => 0, 'status' => 1, 'user_id !=' => $userid, 'art_city !=' => $artregcity , 'art_step' => 4);
        $userlist3 = $this->data['userlist3'] = $this->common->select_data_by_condition('art_reg', $contition_array, $data = '*', $sortby = 'art_id', $orderby = 'DESC', $limit = '', $offset = '', $join_str = array(), $groupby = '');


        $artregstate = $this->data['artisticdata'][0]['art_state'];
        foreach ($userlist3 as $rowstate) {

            $userlistarray2 = explode(',', $rowstate['art_skill']);
            if (array_intersect($likeuserarray, $userlistarray2)) {
                
            } else {

                if ($artregstate == $rowstate['art_state']) {
                    $userliststate[] = $rowstate;
                }
            }
        }


        $this->data['userlistview3'] = $userliststate;

        //echo "<pre>"; print_r($this->data['userlistview3']); die();
//using last3 user     
        $contition_array = array('is_delete' => 0, 'status' => 1, 'user_id !=' => $userid, 'art_city !=' => $artregcity, 'art_state !=' => $artregstate , 'art_step' => 4);
        $userlastview = $this->data['userlastview'] = $this->common->select_data_by_condition('art_reg', $contition_array, $data = '*', $sortby = 'art_id', $orderby = 'DESC', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        $userlistarray4 = explode(',', $userlastview['art_skill']);
        if (array_intersect($likeuserarray, $userlistarray4)) {
            
        } else {
            $this->data['userlistview4'] = $userlastview;
        }
        //echo"<pre>"; print_r($this->data['userlistview4']); die();
//userlist for followdata end
// data fatch using follower start

        $contition_array = array('follow_from' => $artregid, 'follow_status' => '1', 'follow_type' => '1');
        $followerdata1 = $this->data['followerdata1'] = $this->common->select_data_by_condition('follow', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        //echo "<pre>"; print_r($this->data['followerdata']); die();


        foreach ($followerdata1 as $fdata) {

            $user_id = $this->db->get_where('art_reg', array('art_id' => $fdata['follow_to'], 'status' => '1'))->row()->user_id;


            $contition_array = array('art_post.user_id' => $user_id, 'art_post.status' => '1', 'art_post.user_id !=' => $userid, 'art_post.is_delete' => '0');
            $this->data['art_data'] = $this->common->select_data_by_condition('art_post', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');


            $followerabc[] = $this->data['art_data'];
        }

        //echo "<pre>"; print_r($followerabc); die();
//data fatch using follower end
//data fatch using skill start

        $userselectskill = $this->data['artisticdata'][0]['art_skill'];
        //echo  $userselectskill; die();
        $contition_array = array('art_skill' => $userselectskill, 'status' => '1' , 'art_step' => 4);
        $skilldata = $this->data['skilldata'] = $this->common->select_data_by_condition('art_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        //echo "<pre>"; print_r($this->data['skilldata']); die();

        foreach ($skilldata as $fdata) {


            $contition_array = array('art_post.user_id' => $fdata['user_id'], 'art_post.status' => '1', 'art_post.user_id !=' => $userid, 'art_post.is_delete' => '0');

            $this->data['art_data'] = $this->common->select_data_by_condition('art_post', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
            $skillabc[] = $this->data['art_data'];
        }


//data fatch using skill end
//data fatch using login user last post start
        $contition_array = array('art_post.user_id' => $userid, 'art_post.status' => '1', 'art_post.is_delete' => '0');

        $art_userdata = $this->data['art_userdata'] = $this->common->select_data_by_condition('art_post', $contition_array, $data = '*', $sortby = 'art_post_id', $orderby = 'DESC', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        if (count($art_userdata) > 0) {
            $userabc[][] = $this->data['art_userdata'][0];
        } else {
            $userabc[] = $this->data['art_userdata'][0];
        }
        //echo "<pre>"; print_r($userabc); die();
        //echo "<pre>"; print_r($skillabc);  die();
//data fatch using login user last post end
//echo count($skillabc);
//echo count($userabc);
//echo count($unique);
//echo count($followerabc); 


        if (count($skillabc) == 0 && count($userabc) != 0) {
            $unique = $userabc;
        } elseif (count($userabc) == 0 && count($skillabc) != 0) {
            $unique = $skillabc;
        } elseif (count($userabc) != 0 && count($skillabc) != 0) {
            $unique = array_merge($skillabc, $userabc);
        }

        //echo "<pre>"; print_r($userabc); die();
        //echo count($followerabc);  echo count($unique); die();

        if (count($followerabc) == 0 && count($unique) != 0) {
            $unique_user = $unique;
        } elseif (count($unique) == 0 && count($followerabc) != 0) {

            $unique_user = $followerabc;
        } elseif (count($unique) != 0 && count($followerabc) != 0) {
            $unique_user = array_merge($unique, $followerabc);
        }


        // foreach ($unique_user as $k => $v) { 
        //     foreach ($unique_user as $key => $value) {
        //         foreach ($value as $datak => $datav) {
        //             // echo "<pre>"; print_r($k); 
        //             // echo "<pre>"; print_r($datak); 
        //             // echo "<pre>"; print_r($v['user_id']); 
        //             // echo "<pre>"; print_r($datav['user_id']); die(); 
        //             if ($k != $datak && $v['user_id'] == $datav['user_id']) {
        //                 unset($unique_user[$k]);
        //             }
        //         }
        //     }
        // }  
        //echo "<pre>"; print_r($unique); die();

        foreach ($unique_user as $key1 => $val1) {
            foreach ($val1 as $ke => $va) {

                $qbc[] = $va;
            }
        }


        $qbc = array_unique($qbc, SORT_REGULAR);
        //echo "<pre>"; print_r($qbc); die();
        // sorting start

        $post = array();

        //$i =0;
        foreach ($qbc as $key => $row) {
            $post[$key] = $row['art_post_id'];
            //  $qbc[$i]['created_date'] = $this->time_elapsed_string(date('Y-m-d H:i:s', strtotime($row['created_date'])));
            //$i++;
        }

        array_multisort($post, SORT_DESC, $qbc);
        // echo '<pre>';
        // print_r($qbc);
        // exit;
        $this->data['finalsorting'] = $qbc;
        //echo "<pre>"; print_r($this->data['finalsorting'] ); die();
        // sorting end
// code for search
        $contition_array = array('status' => '1', 'is_delete' => '0', 'art_step' => 4);


        $artdata = $this->data['results'] = $this->common->select_data_by_condition('art_reg', $contition_array, $data = 'art_name,art_lastname,designation,other_skill', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);


        $return_array = array();
        //  //echo  $return_array;

        foreach ($artdata as $get) {
            $return = array();
            $return = $get;


            $return['firstname'] = $get['art_name'] . " " . $get['art_lastname'];
            unset($return['art_name']);
            unset($return['art_lastname']);

            array_push($return_array, $return);
            //echo $returnarray; 
        }

        // $contition_array = array('status' => '1');
        // $artpost= $this->data['results'] =  $this->common->select_data_by_condition('art_post', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);

        $contition_array = array('status' => '1', 'type' => '2');

        $artpost = $this->data['results'] = $this->common->select_data_by_condition('skill', $contition_array, $data = 'skill', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);
        // echo "<pre>"; print_r($artpost);die();


        $uni = array_merge($return_array, $artpost);
        //   echo count($unique);


        foreach ($uni as $key => $value) {
            foreach ($value as $ke => $val) {
                if ($val != "") {


                    $result[] = $val;
                }
            }
        }
        // / echo "<pre>"; print_r($result);die();
        $results = array_unique($result);
        foreach ($results as $key => $value) {
            $result1[$key]['label'] = $value;
            $result1[$key]['value'] = $value;
        }

        $this->data['demo'] = array_values($result1);
             $contition_array = array('status' => '1');

       
        $cty = $this->data['cty'] = $this->common->select_data_by_condition('cities', $contition_array, $data = 'city_name', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);
           

            foreach ($cty as $key => $value) {
            foreach ($value as $ke => $val) {
                if ($val != "") {


                    $resu[] = $val;
                }
            }
        }
        $resul = array_unique($resu);
        foreach ($resul as $key => $value) {
            $res[$key]['label'] = $value;
            $res[$key]['value'] = $value;
        }
        
        $this->data['de'] = array_values($res);

        $this->load->view('artistic/art_post', $this->data);
    }

    public function art_manage_post($id = "") {

        $userid = $this->session->userdata('aileenuser');

         //if user deactive profile then redirect to artistic/index untill active profile start
         $contition_array = array('user_id'=> $userid,'status' => '0','is_delete'=> '0');

        $artistic_deactive = $this->data['artistic_deactive'] = $this->common->select_data_by_condition('art_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);

        if($artistic_deactive)
        {
             redirect('artistic/');
        }
     //if user deactive profile then redirect to artistic/index untill active profile End
        $user_name = $this->session->userdata('user_name');

        if ($id == $userid || $id == '') {

            $contition_array = array('user_id' => $userid, 'status' => '1');
            $this->data['artisticdata'] = $this->common->select_data_by_condition('art_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

            $this->data['userdata'] = $this->common->select_data_by_id('user', 'user_id', $userid, $data = '*', $join_str = array());

            $contition_array = array('user_id' => $userid, 'is_delete' => 0);
            $this->data['artsdata'] = $this->common->select_data_by_condition('art_post', $contition_array, $data = '*', $sortby = 'art_post_id', $orderby = 'DESC', $limit = '', $offset = '', $join_str = array(), $groupby = '');
        } else {

            $contition_array = array('user_id' => $id, 'status' => '1' , 'art_step' => 4);
            $this->data['artisticdata'] = $this->common->select_data_by_condition('art_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');


            $this->data['userdata'] = $this->common->select_data_by_id('user', 'user_id', $id, $data = '*', $join_str = array());

            $contition_array = array('user_id' => $id, 'is_delete' => 0);
            $this->data['artsdata'] = $this->common->select_data_by_condition('art_post', $contition_array, $data = '*', $sortby = 'art_post_id', $orderby = 'DESC', $limit = '', $offset = '', $join_str = array(), $groupby = '');
        }
        //echo "<pre>"; print_r($this->data['artsdata']); die();
        // code for search
        $contition_array = array('status' => '1', 'is_delete' => '0' , 'art_step' => 4);


        $artdata = $this->data['results'] = $this->common->select_data_by_condition('art_reg', $contition_array, $data = 'art_name,art_lastname,designation,other_skill', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);


        $return_array = array();
        //echo  $return_array;

        foreach ($artdata as $get) {
            $return = array();
            $return = $get;


            $return['firstname'] = $get['art_name'] . " " . $get['art_lastname'];
            unset($return['art_name']);
            unset($return['art_lastname']);

            array_push($return_array, $return);
            //echo $returnarray; 
        }

        // $contition_array = array('status' => '1');
        // $artpost= $this->data['results'] =  $this->common->select_data_by_condition('art_post', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);

        $contition_array = array('status' => '1', 'type' => '2');

        $artpost = $this->data['results'] = $this->common->select_data_by_condition('skill', $contition_array, $data = 'skill', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);
        // echo "<pre>"; print_r($artpost);die();


        $uni = array_merge($return_array, $artpost);
        //   echo count($unique);


        foreach ($uni as $key => $value) {
            foreach ($value as $ke => $val) {
                if ($val != "") {


                    $result[] = $val;
                }
            }
        }
        $results = array_unique($result);
        foreach ($results as $key => $value) {
            $result1[$key]['label'] = $value;
            $result1[$key]['value'] = $value;
        }

        $this->data['demo'] = array_values($result1);
             $contition_array = array('status' => '1');

       
        $cty = $this->data['cty'] = $this->common->select_data_by_condition('cities', $contition_array, $data = 'city_name', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);
           

            foreach ($cty as $key => $value) {
            foreach ($value as $ke => $val) {
                if ($val != "") {


                    $resu[] = $val;
                }
            }
        }
        $resul = array_unique($resu);
        foreach ($resul as $key => $value) {
            $res[$key]['label'] = $value;
            $res[$key]['value'] = $value;
        }
        
        $this->data['de'] = array_values($res);



        $this->load->view('artistic/art_manage_post', $this->data);
    }

    public function art_addpost() {
        $userid = $this->session->userdata('aileenuser');

         //if user deactive profile then redirect to artistic/index untill active profile start
         $contition_array = array('user_id'=> $userid,'status' => '0','is_delete'=> '0');

        $artistic_deactive = $this->data['artistic_deactive'] = $this->common->select_data_by_condition('art_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);

        if($artistic_deactive)
        {
             redirect('artistic/');
        }
     //if user deactive profile then redirect to artistic/index untill active profile End
        $contition_array = array('user_id' => $userid, 'status' => '1');
        $this->data['artisticdata'] = $this->common->select_data_by_condition('art_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
        $this->load->view('artistic/art_addpost', $this->data);
    }

// khyati changes start
    //public function art_post_insert($id,$para) {
    public function art_post_insert($id = '', $para = '') {
        //echo $para; die();
        $userid = $this->session->userdata('aileenuser');

         //if user deactive profile then redirect to artistic/index untill active profile start
         $contition_array = array('user_id'=> $userid,'status' => '0','is_delete'=> '0');

        $artistic_deactive = $this->data['artistic_deactive'] = $this->common->select_data_by_condition('art_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);

        if($artistic_deactive)
        {
             redirect('artistic/');
        }
     //if user deactive profile then redirect to artistic/index untill active profile End

//echo '<pre>'; print_r($_POST); die();

        if ($para == $userid || $para == '') {
            $data = array(
                'art_post' => $this->input->post('my_text'),
                'art_description' => $this->input->post('product_desc'),
                'created_date' => date('Y-m-d H:i:s', time()),
                'status' => 1,
                'is_delete' => 0,
                'user_id' => $userid
            );
        } else {

            $data = array(
                'art_post' => $this->input->post('my_text'),
                'art_description' => $this->input->post('product_desc'),
                'created_date' => date('Y-m-d H:i:s', time()),
                'status' => 1,
                'is_delete' => 0,
                'user_id' => $para,
                'posted_user_id' => $userid
            );
        }

        $insert_id = $this->common->insert_data_getid($data, 'art_post');
        //echo $insert_id; die(); 
        $config = array(
            
            //'image_library' => 'gd2',
            'upload_path' => $this->config->item('art_post_main_upload_path'),
            'max_size' => 2500000000000,
            //'quality' => "60%",
            'allowed_types' => $this->config->item('art_post_main_allowed_types')
                //'overwrite' => true,
                //'remove_spaces' => true
        );
        //echo "<pre>"; print_r($config); die();
        $images = array();
        $this->load->library('upload');

        $files = $_FILES;
        $count = count($_FILES['postattach']['name']);

        $title = time();

        for ($i = 0; $i < $count; $i++) {

            $_FILES['postattach']['name'] = $files['postattach']['name'][$i];
            $_FILES['postattach']['type'] = $files['postattach']['type'][$i];
            $_FILES['postattach']['tmp_name'] = $files['postattach']['tmp_name'][$i];
            $_FILES['postattach']['error'] = $files['postattach']['error'][$i];
            $_FILES['postattach']['size'] = $files['postattach']['size'][$i];




            /** convert video to flash * */
            exec("ffmpeg -i {input}.mov -vcodec h264 -acodec aac -strict -2 {output}.mp4");



            $store = $_FILES['postattach']['name'];

            $store_ext = explode('.', $store);
            $store_ext = end($store_ext);

            $fileName = 'file_' . $title . '_' . $this->random_string() . '.' . $store_ext;

            $images[] = $fileName;
            $config['file_name'] = $fileName;


            $this->upload->initialize($config);
            $this->upload->do_upload();
            if ($this->upload->do_upload('postattach')) {
                
                $response['result'][] = $this->upload->data();
                $art_post_thumb[$i]['image_library'] = 'gd2';
                $art_post_thumb[$i]['source_image'] = $this->config->item('art_post_main_upload_path') . $response['result'][$i]['file_name'];
                $art_post_thumb[$i]['new_image'] = $this->config->item('art_post_thumb_upload_path') . $response['result'][$i]['file_name'];
                $art_post_thumb[$i]['create_thumb'] = TRUE;
                $art_post_thumb[$i]['maintain_ratio'] = TRUE;
                $art_post_thumb[$i]['thumb_marker'] = '';
                $art_post_thumb[$i]['width'] = $this->config->item('art_post_thumb_width');
                //$product_thumb[$i]['height'] = $this->config->item('product_thumb_height');
                $art_post_thumb[$i]['height'] = 2;
                $art_post_thumb[$i]['master_dim'] = 'width';
                $art_post_thumb[$i]['quality'] = "60%";
                $art_post_thumb[$i]['x_axis'] = '0';
                $art_post_thumb[$i]['y_axis'] = '0';
                $instanse = "image_$i";
                //Loading Image Library
                $this->load->library('image_lib', $art_post_thumb[$i], $instanse);
                $dataimage = $response['result'][$i]['file_name'];
                //Creating Thumbnail
                $this->$instanse->resize();
                $response['error'][] = $thumberror = $this->$instanse->display_errors();
                
                
                $return['data'][] = $this->upload->data();
                $return['status'] = "success";
                $return['msg'] = sprintf($this->lang->line('success_item_added'), "Image", "uploaded");


                $data = array(
                    'image_name' => $fileName,
                    'image_type' => 1,
                    'post_id' => $insert_id,
                    'created_date' => date('Y-m-d H:i:s', time()),
                    'is_deleted' => 1
                );

                $insert = $this->common->insert_data_getid($data, 'post_image');
            }  // } else { 
            //   redirect('artistic/art_post', refresh);
            // }
        }
        if ($id == manage) {


            if ($para == $userid || $para == '') {
                redirect('artistic/art_manage_post', refresh);
            } else {
                redirect('artistic/art_manage_post/' . $para, refresh);
            }
        } else {
            redirect('artistic/art_post', refresh);
        }
        // new code end
    }

    // khyati changes end

    public function art_editpost($id) {
        $contition_array = array('art_post_id' => $id);
        $this->data['artdata'] = $this->common->select_data_by_condition('art_post', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        $contition_array = array('status' => 1, 'type' => 2);
        $this->data['skill1'] = $this->common->select_data_by_condition('skill', $contition_array, $data = '*', $sortby = 'skill', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');


        $skildata = explode(',', $this->data['artdata'][0]['art_category']);

        $this->data['selectdata'] = $skildata;
        $this->load->view('artistic/art_editpost', $this->data);
    }

    public function art_editpost_insert($id) {


        $skill = $this->input->post('skills');
        $skillname = $this->input->post('other_skill');


        $this->form_validation->set_rules('postname', 'Post name', 'required');

        $this->form_validation->set_rules('description', 'Post description', 'required');


        if ($this->form_validation->run() == FALSE) {
            $this->load->view('artistic/art_editpost');
        } else {

            $config['upload_path'] = 'uploads/art_images/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif|mp4|3gp|pdf';

            $config['file_name'] = $_FILES['postattach']['name'];
            $config['upload_max_filesize'] = '40M';


            //Load upload library and initialize configuration
            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if ($this->upload->do_upload('postattach')) {
                $uploadData = $this->upload->data();

                $picture = $uploadData['file_name'];
            } else {
                $picture = '';
            }

            if ($picture) {
                $data = array(
                    'art_post' => $this->input->post('postname'),
                    'art_category' => implode(',', $skill),
                    'other_skill' => $this->input->post('other_skill'),
                    'art_description' => $this->input->post('description'),
                    'art_attachment' => $picture,
                    'modifiled_date' => date('Y-m-d', time())
                );
            } else {
                $data = array(
                    'art_post' => $this->input->post('postname'),
                    'art_category' => implode(',', $skill),
                    'other_skill' => $this->input->post('other_skill'),
                    'art_description' => $this->input->post('description'),
                    'art_attachment' => $this->input->post('hiddenimg'),
                    'modifiled_date' => date('Y-m-d', time())
                );
            }

            $updatdata = $this->common->update_data($data, 'art_post', 'art_post_id', $id);

            $skilldata = $this->common->select_data_by_id('skill', 'skill', $skillname, $data = '*', $join_str = array());

            if ($skilldata || $skillname == "") {
                
            } else {
                $data1 = array(
                    'skill' => $this->input->post('other_skill'),
                );

                $insertid = $this->common->update_data($data1, 'skill', 'skill', $skillname);
            }
            if ($updatdata) {
                redirect('artistic/art_manage_post', refresh);
            } else {
                $this->session->flashdata('error', 'Your data not inserted');
                redirect('artistic/art_editpost', refresh);
            }
        }
    }

    public function art_deletepost() {

        $id = $_POST['art_post_id'];

        $data = array(
            'is_delete' => 1,
            'modifiled_date' => date('Y-m-d', time())
        );


        $updatdata = $this->common->update_data($data, 'art_post', 'art_post_id', $id);

        $data = array(
            'is_deleted' => 0,
            'modify_date' => date('Y-m-d', time())
        );


        $updatdata = $this->common->update_data($data, 'post_image', 'post_id', $id);


        $this->data['userid'] = $userid = $this->session->userdata('aileenuser');


$contition_array = array('user_id' => $userid, 'status' => 1, 'is_delete' => '0');
$otherdata = $this->common->select_data_by_condition('art_post', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

$datacount = count($otherdata);



        if (count($otherdata) == 0) {
                    $notfound = '<div class="contact-frnd-post bor_none">';
                    $notfound .= '<div class="text-center rio">';
                    $notfound .= '<h4 class="page-heading  product-listing">No Post Found.</h4>';
                    $notfound .= '</div></div>';

                    $notvideo = 'Video Not Available';
                    $notaudio = 'Audio Not Available';
                    $notpdf = 'Pdf Not Available';
                    $notphoto = 'Photo Not Available';
                }

                // echo $notfound;
                // echo $datacount;
                // echo $notvideo;
                // echo $notaudio;
                // echo $notpdf;
                // echo $notphoto; die();

                echo json_encode(
                        array(
                            "notfound" => $notfound,
                            "notcount" => $datacount,
                            "notvideo" => $notvideo,
                            "notaudio" => $notaudio,
                            "notpdf" => $notpdf,
                            "notphoto" => $notphoto,
                ));

    }


    public function art_delete_post() {

        $id = $_POST['art_post_id'];

         $userid = $this->session->userdata('aileenuser');


        $data = array(
            'is_delete' => 1,
            'modifiled_date' => date('Y-m-d', time())
        );


        $updatdata = $this->common->update_data($data, 'art_post', 'art_post_id', $id);

        $data = array(
            'is_deleted' => 0,
            'modify_date' => date('Y-m-d', time())
        );


        $updatdata = $this->common->update_data($data, 'post_image', 'post_id', $id);


        $contition_array = array('user_id' => $userid, 'status' => '1');
        $this->data['artisticdata'] = $this->common->select_data_by_condition('art_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        //echo "<pre>"; print_r($this->data['artisticdata']); die();
        $artregid = $this->data['artisticdata'][0]['art_id'];


         $contition_array = array('follow_from' => $artregid, 'follow_status' => '1', 'follow_type' => '1');
        $followerdata1 = $this->data['followerdata1'] = $this->common->select_data_by_condition('follow', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        //echo "<pre>"; print_r($this->data['followerdata']); die();


        foreach ($followerdata1 as $fdata) {

            $user_id = $this->db->get_where('art_reg', array('art_id' => $fdata['follow_to'], 'status' => '1'))->row()->user_id;


            $contition_array = array('art_post.user_id' => $user_id, 'art_post.status' => '1', 'art_post.user_id !=' => $userid, 'art_post.is_delete' => '0');
            $this->data['art_data'] = $this->common->select_data_by_condition('art_post', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');


            $followerabc[] = $this->data['art_data'];
        }

        //echo "<pre>"; print_r($followerabc); die();
//data fatch using follower end
//data fatch using skill start

        $userselectskill = $this->data['artisticdata'][0]['art_skill'];
        //echo  $userselectskill; die();
        $contition_array = array('art_skill' => $userselectskill, 'status' => '1' , 'art_step' => 4);
        $skilldata = $this->data['skilldata'] = $this->common->select_data_by_condition('art_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        //echo "<pre>"; print_r($this->data['skilldata']); die();

        foreach ($skilldata as $fdata) {


            $contition_array = array('art_post.user_id' => $fdata['user_id'], 'art_post.status' => '1', 'art_post.user_id !=' => $userid, 'art_post.is_delete' => '0');

            $this->data['art_data'] = $this->common->select_data_by_condition('art_post', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
            $skillabc[] = $this->data['art_data'];
        }


//data fatch using skill end
//data fatch using login user last post start
        $contition_array = array('art_post.user_id' => $userid, 'art_post.status' => '1', 'art_post.is_delete' => '0');

        $art_userdata = $this->data['art_userdata'] = $this->common->select_data_by_condition('art_post', $contition_array, $data = '*', $sortby = 'art_post_id', $orderby = 'DESC', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        if (count($art_userdata) > 0) {
            $userabc[][] = $this->data['art_userdata'][0];
        } else {
            $userabc[] = $this->data['art_userdata'][0];
        }
        //echo "<pre>"; print_r($userabc); die();
        //echo "<pre>"; print_r($skillabc);  die();
//data fatch using login user last post end
//echo count($skillabc);
//echo count($userabc);
//echo count($unique);
//echo count($followerabc); 


        if (count($skillabc) == 0 && count($userabc) != 0) {
            $unique = $userabc;
        } elseif (count($userabc) == 0 && count($skillabc) != 0) {
            $unique = $skillabc;
        } elseif (count($userabc) != 0 && count($skillabc) != 0) {
            $unique = array_merge($skillabc, $userabc);
        }

        //echo "<pre>"; print_r($userabc); die();
        //echo count($followerabc);  echo count($unique); die();

        if (count($followerabc) == 0 && count($unique) != 0) {
            $unique_user = $unique;
        } elseif (count($unique) == 0 && count($followerabc) != 0) {

            $unique_user = $followerabc;
        } elseif (count($unique) != 0 && count($followerabc) != 0) {
            $unique_user = array_merge($unique, $followerabc);
        }



        foreach ($unique_user as $key1 => $val1) {
            foreach ($val1 as $ke => $va) {

                $qbc[] = $va;
            }
        }


        $qbc = array_unique($qbc, SORT_REGULAR);
        //echo "<pre>"; print_r($qbc); die();
        // sorting start

        $post = array();

        //$i =0;
        foreach ($qbc as $key => $row) {
            $post[$key] = $row['art_post_id'];
         }

        array_multisort($post, SORT_DESC, $qbc);
        // echo '<pre>';
        // print_r($qbc);
        // exit;
        $otherdata = $qbc;


         if (count($otherdata) > 0) { 
             foreach ($otherdata as $row) {
                 //  echo '<pre>'; print_r($finalsorting); die();
                 $userid = $this->session->userdata('aileenuser');
         
                 $contition_array = array('art_post_id' => $row['art_post_id'], 'status' => '1');
                 $artdelete = $this->data['artdelete'] = $this->common->select_data_by_condition('art_post', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
         
                 $likeuserarray = explode(',', $artdelete[0]['delete_post']);
         
                 if (!in_array($userid, $likeuserarray)) {}else{

                    $count[] = "abc";
                 }

                  }
  } 
//echo count($otherdata); die();
  if(count($otherdata) > 0){ 
          if(count($count) == count($otherdata)){ 
        
                    $datacount = "count";


                    $notfound = '<div class="contact-frnd-post bor_none">';
                    $notfound .= '<div class="text-center rio">';
                    $notfound .= '<h4 class="page-heading  product-listing">No post Found.</h4>';
                    $notfound .= '</div></div>';
                
            } }else{ 

                    $datacount = "count";

                    $notfound = '<div class="contact-frnd-post bor_none">';
                    $notfound .= '<div class="text-center rio">';
                    $notfound .= '<h4 class="page-heading  product-listing">No post Found.</h4>';
                    $notfound .= '</div></div>';
                
            }

            echo json_encode(
                        array(
                            "notfound" => $notfound,
                            "notcount" => $datacount,
                ));




    }


    public function artistic_contactperson($id) {

        $userid = $this->session->userdata('aileenuser');

         //if user deactive profile then redirect to artistic/index untill active profile start
         $contition_array = array('user_id'=> $userid,'status' => '0','is_delete'=> '0');

        $artistic_deactive = $this->data['artistic_deactive'] = $this->common->select_data_by_condition('art_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);

        if($artistic_deactive)
        {
             redirect('artistic/');
        }
     //if user deactive profile then redirect to artistic/index untill active profile End
        $contition_array = array('user_id' => $id , 'art_step' => 4);
        $this->data['contactperson'] = $this->common->select_data_by_condition('art_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

             $contition_array = array('status' => '1', 'is_delete' => '0' , 'art_step' => 4);


        $artdata = $this->data['results'] = $this->common->select_data_by_condition('art_reg', $contition_array, $data = 'art_name,art_lastname,designation,other_skill', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);


        $return_array = array();
        //echo  $return_array;

        foreach ($artdata as $get) {
            $return = array();
            $return = $get;


            $return['firstname'] = $get['art_name'] . " " . $get['art_lastname'];
            unset($return['art_name']);
            unset($return['art_lastname']);

            array_push($return_array, $return);
            //echo $returnarray; 
        }

        // $contition_array = array('status' => '1');
        // $artpost= $this->data['results'] =  $this->common->select_data_by_condition('art_post', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);

        $contition_array = array('status' => '1', 'type' => '2');

        $artpost = $this->data['results'] = $this->common->select_data_by_condition('skill', $contition_array, $data = 'skill', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);
        // echo "<pre>"; print_r($artpost);die();


        $uni = array_merge($return_array, $artpost);
        //   echo count($unique);


        foreach ($uni as $key => $value) {
            foreach ($value as $ke => $val) {
                if ($val != "") {


                    $result[] = $val;
                }
            }
        }
        $results = array_unique($result);
        foreach ($results as $key => $value) {
            $result1[$key]['label'] = $value;
            $result1[$key]['value'] = $value;
        }

        $this->data['demo'] = array_values($result1);
             $contition_array = array('status' => '1');

       
        $cty = $this->data['cty'] = $this->common->select_data_by_condition('cities', $contition_array, $data = 'city_name', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);
           

            foreach ($cty as $key => $value) {
            foreach ($value as $ke => $val) {
                if ($val != "") {


                    $resu[] = $val;
                }
            }
        }
        $resul = array_unique($resu);
        foreach ($resul as $key => $value) {
            $res[$key]['label'] = $value;
            $res[$key]['value'] = $value;
        }
        
        $this->data['de'] = array_values($res);

        $this->load->view('artistic/artistic_contactperson', $this->data);
    }

    public function artistic_contactperson_query($id) {


        $userid = $this->session->userdata('aileenuser');

         //if user deactive profile then redirect to artistic/index untill active profile start
         $contition_array = array('user_id'=> $userid,'status' => '0','is_delete'=> '0');

        $artistic_deactive = $this->data['artistic_deactive'] = $this->common->select_data_by_condition('art_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);

        if($artistic_deactive)
        {
             redirect('artistic/');
        }
     //if user deactive profile then redirect to artistic/index untill active profile End

        $contition_array = array('user_id' => $id ,'art_step' => 4);
        $this->data['contactperson'] = $this->common->select_data_by_condition('art_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');


        $email = $this->input->post('email');

        $toemail = $this->input->post('toemail');
        $userdata = $this->common->select_data_by_id('user', 'user_id', $userid, $data = '*', $join_str = array());

        $msg = 'Hey !' . " " . $this->data['contactperson'][0]['art_name'] . "<br/>" .
                $msg .= $userdata[0]['first_name'] . $userdata[0]['last_name'] . '(' . $userdata[0]['user_email'] . ')' . ',';
        $msg .= 'this person wants to contact with you!!';
        $msg .= "<br>";
        $msg .= $this->input->post('msg');
        $from = 'raval.khyati13@gmail.com';

        $subject = "contact message";


        $mail = $this->email_model->do_email($msg, $subject, $toemail, $from);


//insert contact start


        $data = array(
            'contact_from_id' => $userid,
            'contact_to_id' => $id,
            'contact_type' => 1,
            'created_date' => date('Y-m-d H:i:s', time()),
            'status' => 'contact_person',
            'contact_desc' => $this->input->post('msg')
        );


        $insertdata = $this->common->insert_data_getid($data, 'contact_person');


//insert contact person end 
//insert contact person notification start


        $data = array(
            'not_type' => 7,
            'not_from_id' => $userid,
            'not_to_id' => $id,
            'not_read' => 2,
            'not_product_id' => $insertdata,
            'not_from' => 3,
            'not_active' => 1,
            'not_created_date' => date('Y-m-d H:i:s')
        );

        $insert_id = $this->common->insert_data_getid($data, 'notification');

        if ($insertdata) {

            redirect('artistic/art_post', refresh);
        } else {
            $this->session->flashdata('error', 'Your data not inserted');
            redirect('artistic/artistic_contactperson/' . $id, refresh);
        }
//insert contact person notifiaction end           
    }

    public function art_user_post($id) {

        $this->data['userid'] = $id;
        $user_name = $this->session->userdata('user_name');


        $this->data['usdata'] = $this->common->select_data_by_id('user', 'user_id', $id, $data = '*', $join_str = array());


        $contition_array = array('user_id' => $id);
        $this->data['artdata'] = $this->common->select_data_by_condition('art_post', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        $this->load->view('artistic/art_manage_post', $this->data);
    }

    public function user_image_insert() {

        $userid = $this->session->userdata('aileenuser');

         //if user deactive profile then redirect to artistic/index untill active profile start
         $contition_array = array('user_id'=> $userid,'status' => '0','is_delete'=> '0');

        $artistic_deactive = $this->data['artistic_deactive'] = $this->common->select_data_by_condition('art_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);

        if($artistic_deactive)
        {
             redirect('artistic/');
        }
     //if user deactive profile then redirect to artistic/index untill active profile End


        if ($this->input->post('cancel1')) {
            redirect('artistic/art_post', refresh);
        } elseif ($this->input->post('cancel2')) {
            redirect('artistic/art_savepost', refresh);
        } elseif ($this->input->post('cancel3')) {
            redirect('artistic/art_addpost', refresh);
        } elseif ($this->input->post('cancel4')) {
            redirect('artistic/artistic_profile', refresh);
        } elseif ($this->input->post('cancel5')) {
            redirect('artistic/art_manage_post', refresh);
        } elseif ($this->input->post('cancel6')) {
            redirect('artistic/userlist', refresh);
        } elseif ($this->input->post('cancel7')) {
            redirect('artistic/following', refresh);
        } elseif ($this->input->post('cancel8')) {
            redirect('artistic/followers', refresh);
        }

        if (empty($_FILES['profilepic']['name'])) {
            $this->form_validation->set_rules('profilepic', 'Upload profilepic', 'required');
        } else {
//            $config['upload_path'] = 'uploads/art_images/';
//            $config['allowed_types'] = 'jpg|jpeg|png|gif|mp4|3gp|mpeg|mpg|mpe|qt|mov|avi|pdf';
//
//            $config['file_name'] = $_FILES['profilepic']['name'];
//
//            $this->load->library('upload', $config);
//            $this->upload->initialize($config);
//
//            if ($this->upload->do_upload('profilepic')) {
//                $uploadData = $this->upload->data();
//
//                $picture = $uploadData['file_name'];
//            } else {
//                $picture = '';
//            }

            $user_image = '';
            $user['upload_path'] = $this->config->item('art_profile_main_upload_path');
            $user['allowed_types'] = $this->config->item('art_profile_main_allowed_types');
            $user['max_size'] = $this->config->item('art_profile_main_max_size');
            $user['max_width'] = $this->config->item('art_profile_main_max_width');
            $user['max_height'] = $this->config->item('art_profile_main_max_height');
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
                $user_thumb['new_image'] = $this->config->item('art_profile_thumb_upload_path') . $imgdata['file_name'];
                $user_thumb['create_thumb'] = TRUE;
                $user_thumb['maintain_ratio'] = TRUE;
                $user_thumb['thumb_marker'] = '';
                $user_thumb['width'] = $this->config->item('art_profile_thumb_width');
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
                $redirect_url = site_url('artistic');
                redirect($redirect_url, 'refresh');
            } else {

                $contition_array = array('user_id' => $userid);
                $user_reg_data = $this->common->select_data_by_condition('art_reg', $contition_array, $data = 'art_user_image', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

                $user_reg_prev_image = $user_reg_data[0]['art_user_image'];

                if ($user_reg_prev_image != '') {
                    $user_image_main_path = $this->config->item('art_profile_main_upload_path');
                    $user_bg_full_image = $user_image_main_path . $user_reg_prev_image;
                    if (isset($user_bg_full_image)) {
                        unlink($user_bg_full_image);
                    }

                    $user_image_thumb_path = $this->config->item('art_profile_thumb_upload_path');
                    $user_bg_thumb_image = $user_image_thumb_path . $user_reg_prev_image;
                    if (isset($user_bg_thumb_image)) {
                        unlink($user_bg_thumb_image);
                    }
                }

                $user_image = $imgdata['file_name'];
            }

            $data = array(
                'art_user_image' => $user_image,
                'modified_date' => date('Y-m-d', time())
            );


            $updatdata = $this->common->update_data($data, 'art_reg', 'user_id', $userid);

            if ($updatdata) {
                if ($this->input->post('hitext') == 1) {
                    redirect('artistic/art_post', refresh);
                } elseif ($this->input->post('hitext') == 2) {
                    redirect('artistic/art_savepost', refresh);
                } elseif ($this->input->post('hitext') == 3) {
                    redirect('artistic/art_addpost', refresh);
                } elseif ($this->input->post('hitext') == 4) {
                    redirect('artistic/artistic_profile', refresh);
                } elseif ($this->input->post('hitext') == 5) {
                    redirect('artistic/art_manage_post', refresh);
                } elseif ($this->input->post('hitext') == 6) {
                    redirect('artistic/userlist', refresh);
                } elseif ($this->input->post('hitext') == 7) {
                    redirect('artistic/following', refresh);
                } elseif ($this->input->post('hitext') == 8) {
                    redirect('artistic/followers', refresh);
                } elseif ($this->input->post('hitext') == 9) {
                    redirect('artistic/art_photos', refresh);
                } elseif ($this->input->post('hitext') == 10) {
                    redirect('artistic/art_videos', refresh);
                } elseif ($this->input->post('hitext') == 11) {
                    redirect('artistic/art_audios', refresh);
                } elseif ($this->input->post('hitext') == 12) {
                    redirect('artistic/art_pdf', refresh);
                }
            } else {
                $this->session->flashdata('error', 'Your data not inserted');
                redirect('artistic/art_post', refresh);
            }
        }
    }

    public function artistic_profile($id = "") {


        $userid = $this->session->userdata('aileenuser');

         //if user deactive profile then redirect to artistic/index untill active profile start
         $contition_array = array('user_id'=> $userid,'status' => '0','is_delete'=> '0');

        $artistic_deactive = $this->data['artistic_deactive'] = $this->common->select_data_by_condition('art_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);

        if($artistic_deactive)
        {
             redirect('artistic/');
        }
     //if user deactive profile then redirect to artistic/index untill active profile End
        $this->data['id'] = $id;

        if ($id == $userid || $id == '') {

            $contition_array = array('user_id' => $userid, 'status' => '1');
            $this->data['artisticdata'] = $this->common->select_data_by_condition('art_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
        } else {

            $contition_array = array('user_id' => $id, 'status' => '1' , 'art_step' => 4);
            $this->data['artisticdata'] = $this->common->select_data_by_condition('art_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
        }

// code for search
        $contition_array = array('status' => '1', 'is_delete' => '0', 'art_step' => 4);


        $artdata = $this->data['results'] = $this->common->select_data_by_condition('art_reg', $contition_array, $data = 'art_name,art_lastname,designation,other_skill', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);


        $return_array = array();
        //  //echo  $return_array;

        foreach ($artdata as $get) {
            $return = array();
            $return = $get;


            $return['firstname'] = $get['art_name'] . " " . $get['art_lastname'];
            unset($return['art_name']);
            unset($return['art_lastname']);

            array_push($return_array, $return);
            //echo $returnarray; 
        }

        // $contition_array = array('status' => '1');
        // $artpost= $this->data['results'] =  $this->common->select_data_by_condition('art_post', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);

        $contition_array = array('status' => '1', 'type' => '2');

        $artpost = $this->data['results'] = $this->common->select_data_by_condition('skill', $contition_array, $data = 'skill', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);
        // echo "<pre>"; print_r($artpost);die();


        $uni = array_merge($return_array, $artpost);
        //   echo count($unique);


        foreach ($uni as $key => $value) {
            foreach ($value as $ke => $val) {
                if ($val != "") {


                    $result[] = $val;
                }
            }
        }
        $results = array_unique($result);
        foreach ($results as $key => $value) {
            $result1[$key]['label'] = $value;
            $result1[$key]['value'] = $value;
        }

        $this->data['demo'] = array_values($result1);


     $contition_array = array('status' => '1');

       
        $cty = $this->data['cty'] = $this->common->select_data_by_condition('cities', $contition_array, $data = 'city_name', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);
           

            foreach ($cty as $key => $value) {
            foreach ($value as $ke => $val) {
                if ($val != "") {


                    $resu[] = $val;
                }
            }
        }
        $resul = array_unique($resu);
        foreach ($resul as $key => $value) {
            $res[$key]['label'] = $value;
            $res[$key]['value'] = $value;
        }
        
        $this->data['de'] = array_values($res);






        $this->load->view('artistic/artistic_profile', $this->data);
    }

//keyskill automatic retrieve cobtroller start
    public function keyskill() {
        $json = [];
        $where = "type='2' AND status='1'";



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


        if (!empty($this->input->get("q"))) {
     $search_condition = "(city_name LIKE '" . trim($this->input->get("q")) . "%')";

     $tolist = $this->common->select_data_by_search('cities', $search_condition,$contition_array = array(), $data = 'city_id as id,city_name as text', $sortby = 'city_name', $orderby = 'desc', $limit = '', $offset = '', $join_str5 = '', $groupby = '');
   
//echo '<pre>'; print_r($tolist); die();
     }
      
        echo json_encode($tolist);
        }

//location automatic retrieve cobtroller End
// user list of artistic users

    public function userlist() {
        $this->data['userid'] = $userid = $this->session->userdata('aileenuser');

         //if user deactive profile then redirect to artistic/index untill active profile start
         $contition_array = array('user_id'=> $userid,'status' => '0','is_delete'=> '0');

        $artistic_deactive = $this->data['artistic_deactive'] = $this->common->select_data_by_condition('art_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);

        if($artistic_deactive)
        {
             redirect('artistic/');
        }
     //if user deactive profile then redirect to artistic/index untill active profile End
        $artdata = $this->data['artdata'] = $this->common->select_data_by_id('art_reg', 'user_id', $userid, $data = '*');

        $contition_array = array('user_id' => $userid, 'status' => '1');
        $this->data['artisticdata'] = $this->common->select_data_by_condition('art_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');


        $contition_array = array('is_delete' => 0, 'status' => 1, 'user_id !=' => $userid, 'art_step' => 4);
        $this->data['userlist'] = $this->common->select_data_by_condition('art_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');


        // followers count
        $join_str[0]['table'] = 'follow';
        $join_str[0]['join_table_id'] = 'follow.follow_to';
        $join_str[0]['from_table_id'] = 'art_reg.art_id';
        $join_str[0]['join_type'] = '';
        $contition_array = array('follow_to' => $artdata[0]['art_id'], 'follow_status' => 1, 'follow_type' => 1 , 'art_reg.art_step' => 4);

        $this->data['followers'] = count($this->common->select_data_by_condition('art_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str, $groupby = ''));

        // follow count end
        // fllowing count
        $join_str[0]['table'] = 'follow';
        $join_str[0]['join_table_id'] = 'follow.follow_from';
        $join_str[0]['from_table_id'] = 'art_reg.art_id';
        $join_str[0]['join_type'] = '';

        $contition_array = array('follow_from' => $artdata[0]['art_id'], 'follow_status' => 1, 'follow_type' => 1,'art_reg.art_step' => 4);

        $this->data['following'] = count($this->common->select_data_by_condition('art_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str, $groupby = ''));

        //following end
// code for search
        $contition_array = array('status' => '1', 'is_delete' => '0' ,'art_step' => 4);


        $artdata = $this->data['results'] = $this->common->select_data_by_condition('art_reg', $contition_array, $data = 'art_name,art_lastname,designation,other_skill', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);


        $return_array = array();
        //  //echo  $return_array;

        foreach ($artdata as $get) {
            $return = array();
            $return = $get;


            $return['firstname'] = $get['art_name'] . " " . $get['art_lastname'];
            unset($return['art_name']);
            unset($return['art_lastname']);

            array_push($return_array, $return);
            //echo $returnarray; 
        }

        // $contition_array = array('status' => '1');
        // $artpost= $this->data['results'] =  $this->common->select_data_by_condition('art_post', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);

        $contition_array = array('status' => '1', 'type' => '2');

        $artpost = $this->data['results'] = $this->common->select_data_by_condition('skill', $contition_array, $data = 'skill', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);
        // echo "<pre>"; print_r($artpost);die();


        $uni = array_merge($return_array, $artpost);
        //   echo count($unique);


        foreach ($uni as $key => $value) {
            foreach ($value as $ke => $val) {
                if ($val != "") {


                    $result[] = $val;
                }
            }
        }
        $results = array_unique($result);
        foreach ($results as $key => $value) {
            $result1[$key]['label'] = $value;
            $result1[$key]['value'] = $value;
        }

        $this->data['demo'] = array_values($result1);
             $contition_array = array('status' => '1');

       
        $cty = $this->data['cty'] = $this->common->select_data_by_condition('cities', $contition_array, $data = 'city_name', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);
           

            foreach ($cty as $key => $value) {
            foreach ($value as $ke => $val) {
                if ($val != "") {


                    $resu[] = $val;
                }
            }
        }
        $resul = array_unique($resu);
        foreach ($resul as $key => $value) {
            $res[$key]['label'] = $value;
            $res[$key]['value'] = $value;
        }
        
        $this->data['de'] = array_values($res);



        $this->load->view('artistic/artistic_userlist', $this->data);
    }

    public function follow() {
        $userid = $this->session->userdata('aileenuser');

         //if user deactive profile then redirect to artistic/index untill active profile start
         $contition_array = array('user_id'=> $userid,'status' => '0','is_delete'=> '0');

        $artistic_deactive = $this->data['artistic_deactive'] = $this->common->select_data_by_condition('art_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);

        if($artistic_deactive)
        {
             redirect('artistic/');
        }
     //if user deactive profile then redirect to artistic/index untill active profile End

        $art_id = $_POST["follow_to"];

        $artdata = $this->common->select_data_by_id('art_reg', 'user_id', $userid, $data = '*');

        $contition_array = array('follow_type' => 1, 'follow_from' => $artdata[0]['art_id'], 'follow_to' => $art_id);
        $follow = $this->common->select_data_by_condition('follow', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
        //  echo "<pre>"; print_r($follow); die();

        $contition_array = array('art_id' => $art_id, 'status' => 1, 'is_delete' => 0 ,'art_step' => 4);
        $followuserid = $this->common->select_data_by_condition('art_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');


        if ($follow) {
            $data = array(
                'follow_type' => 1,
                'follow_from' => $artdata[0]['art_id'],
                'follow_to' => $art_id,
                'follow_status' => 1,
            );
            $update = $this->common->update_data($data, 'follow', 'follow_id', $follow[0]['follow_id']);

            // insert notification

            $data = array(
                'not_type' => 8,
                'not_from_id' => $userid,
                'not_to_id' => $followuserid[0]['user_id'],
                'not_read' => 2,
                'not_product_id' => $follow[0]['follow_id'],
                'not_from' => 3,
                'not_active' => 1,
                'not_created_date' => date('Y-m-d H:i:s')
            );
//echo '<pre>'; print_r($data); die();
            $insert_id = $this->common->insert_data_getid($data, 'notification');
            // end notoification


            if ($update) {


                $follow = '<div id= "unfollowdiv" class="user_btn">';
                $follow .= '<button class="bg_following" id="unfollow' . $art_id . '" onClick="unfollowuser(' . $art_id . ')">
                               Following 
                      </button>';
                $follow .= '</div>';
                echo $follow;
            }
        } else {
            $data = array(
                'follow_type' => 1,
                'follow_from' => $artdata[0]['art_id'],
                'follow_to' => $art_id,
                'follow_status' => 1,
            );
            $insert = $this->common->insert_data_getid($data, 'follow');

            // insert notification

            $data = array(
                'not_type' => 8,
                'not_from_id' => $userid,
                'not_to_id' => $followuserid[0]['user_id'],
                'not_read' => 2,
                'not_product_id' => $insert,
                'not_from' => 3,
                'not_active' => 1,
                'not_created_date' => date('Y-m-d H:i:s')
            );

            $insert_id = $this->common->insert_data_getid($data, 'notification');
            // end notoification

            if ($insert) {

                $follow = '<div id= "unfollowdiv" class="user_btn">';
                $follow .= '<button class="bg_following" id="unfollow' . $art_id . '" onClick="unfollowuser(' . $art_id . ')">
                               Following 
                      </button>';
                $follow .= '</div>';
                echo $follow;
            }
        }
    }

    public function unfollow() {
        $userid = $this->session->userdata('aileenuser');

         //if user deactive profile then redirect to artistic/index untill active profile start
         $contition_array = array('user_id'=> $userid,'status' => '0','is_delete'=> '0');

        $artistic_deactive = $this->data['artistic_deactive'] = $this->common->select_data_by_condition('art_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);

        if($artistic_deactive)
        {
             redirect('artistic/');
        }
     //if user deactive profile then redirect to artistic/index untill active profile End

        $art_id = $_POST["follow_to"];

        $artdata = $this->common->select_data_by_id('art_reg', 'user_id', $userid, $data = '*');

        $contition_array = array('follow_type' => 1, 'follow_from' => $artdata[0]['art_id'], 'follow_to' => $art_id);

        $follow = $this->common->select_data_by_condition('follow', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');


        if ($follow) {
            $data = array(
                'follow_type' => 1,
                'follow_from' => $artdata[0]['art_id'],
                'follow_to' => $art_id,
                'follow_status' => 0,
            );
            $update = $this->common->update_data($data, 'follow', 'follow_id', $follow[0]['follow_id']);
            if ($update) {


                $unfollow = '<div id= "followdiv" class="user_btn"><button id="follow' . $art_id . '" onClick="followuser(' . $art_id . ')">
                               Follow 
                      </button></div>';

                echo $unfollow;
            }
        }
    }

    public function follow_two() {
        $userid = $this->session->userdata('aileenuser');

         //if user deactive profile then redirect to artistic/index untill active profile start
         $contition_array = array('user_id'=> $userid,'status' => '0','is_delete'=> '0');

        $artistic_deactive = $this->data['artistic_deactive'] = $this->common->select_data_by_condition('art_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);

        if($artistic_deactive)
        {
             redirect('artistic/');
        }
     //if user deactive profile then redirect to artistic/index untill active profile End

        $art_id = $_POST["follow_to"];

        $artdata = $this->common->select_data_by_id('art_reg', 'user_id', $userid, $data = '*');

        $contition_array = array('follow_type' => 1, 'follow_from' => $artdata[0]['art_id'], 'follow_to' => $art_id);
        $follow = $this->common->select_data_by_condition('follow', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
        //  echo "<pre>"; print_r($follow); die();

        if ($follow) {
            $data = array(
                'follow_type' => 1,
                'follow_from' => $artdata[0]['art_id'],
                'follow_to' => $art_id,
                'follow_status' => 1,
            );
            $update = $this->common->update_data($data, 'follow', 'follow_id', $follow[0]['follow_id']);

            // insert notification

            $data = array(
                'not_type' => 8,
                'not_from_id' => $artdata[0]['art_id'],
                'not_to_id' => $art_id,
                'not_read' => 2,
                'not_product_id' => $follow[0]['follow_id'],
                'not_from' => 3,
                'not_active' => 1,
                'not_created_date' => date('Y-m-d H:i:s')
            );

            $insert_id = $this->common->insert_data_getid($data, 'notification');
            // end notoification


            if ($update) {


                $follow = '<div class=" user_btn follow_btn_' . $art_id . '" id= "unfollowdiv">';
                $follow .= '<button class="bg_following" id="unfollow' . $art_id . '" onClick="unfollowuser_two(' . $art_id . ')"><span>
                               Following 
                      </span></button>';
                $follow .= '</div>';
                echo $follow;
            }
        } else {
            $data = array(
                'follow_type' => 1,
                'follow_from' => $artdata[0]['art_id'],
                'follow_to' => $art_id,
                'follow_status' => 1,
            );
            $insert = $this->common->insert_data_getid($data, 'follow');

            // insert notification

            $data = array(
                'not_type' => 8,
                'not_from_id' => $artdata[0]['art_id'],
                'not_to_id' => $art_id,
                'not_read' => 2,
                'not_product_id' => $insert,
                'not_from' => 3,
                'not_active' => 1,
                'not_created_date' => date('Y-m-d H:i:s')
            );

            $insert_id = $this->common->insert_data_getid($data, 'notification');
            // end notoification

            if ($insert) {

                $follow = '<div>';
                /*  $follow = '<button id="unfollow' . $art_id.'" onClick="unfollowuser('.$art_id.')"><span>Following</span></button>';
                  $follow .= '</div>'; */
                $follow .= '<button id="unfollow' . $art_id . '" onClick="unfollowuser_two(' . $art_id . ')"><span>Following</span></button>';
                $follow .= '</div>';
                echo $follow;
            }
        }
    }

    public function unfollow_two() {
        $userid = $this->session->userdata('aileenuser');

         //if user deactive profile then redirect to artistic/index untill active profile start
         $contition_array = array('user_id'=> $userid,'status' => '0','is_delete'=> '0');

        $artistic_deactive = $this->data['artistic_deactive'] = $this->common->select_data_by_condition('art_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);

        if($artistic_deactive)
        {
             redirect('artistic/');
        }
     //if user deactive profile then redirect to artistic/index untill active profile End

        $art_id = $_POST["follow_to"];

        $artdata = $this->common->select_data_by_id('art_reg', 'user_id', $userid, $data = '*');

        $contition_array = array('follow_type' => 1, 'follow_from' => $artdata[0]['art_id'], 'follow_to' => $art_id);

        $follow = $this->common->select_data_by_condition('follow', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');


        if ($follow) {
            $data = array(
                'follow_type' => 1,
                'follow_from' => $artdata[0]['art_id'],
                'follow_to' => $art_id,
                'follow_status' => 0,
            );
            $update = $this->common->update_data($data, 'follow', 'follow_id', $follow[0]['follow_id']);
            if ($update) {


                /*  $unfollow = '<div><button id="follow' . $art_id.'" onClick="followuser('.$art_id.')">
                  Follow
                  </button></div>'; */
                $unfollow = '<button id="unfollowdiv" onClick="followuser_two(' . $art_id . ')">
                               Follow 
                      </button>';

                echo $unfollow;
            }
        }
    }

    public function unfollow_following() {
        $userid = $this->session->userdata('aileenuser');

         //if user deactive profile then redirect to artistic/index untill active profile start
         $contition_array = array('user_id'=> $userid,'status' => '0','is_delete'=> '0');

        $artistic_deactive = $this->data['artistic_deactive'] = $this->common->select_data_by_condition('art_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);

        if($artistic_deactive)
        {
             redirect('artistic/');
        }
     //if user deactive profile then redirect to artistic/index untill active profile End

        $art_id = $_POST["follow_to"];

        $artdata = $this->common->select_data_by_id('art_reg', 'user_id', $userid, $data = '*');

        $contition_array = array('follow_type' => 1, 'follow_from' => $artdata[0]['art_id'], 'follow_to' => $art_id);

        $follow = $this->common->select_data_by_condition('follow', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');


        if ($follow) { //echo "falguni"; die();
            $data = array(
                'follow_type' => 1,
                'follow_from' => $artdata[0]['art_id'],
                'follow_to' => $art_id,
                'follow_status' => 0,
            );
            $update = $this->common->update_data($data, 'follow', 'follow_id', $follow[0]['follow_id']);


            if ($update) {




                $contition_array = array('follow_from' => $artdata[0]['art_id'], 'follow_status' => '1', 'follow_type' => '1');
                $followingotherdata = $this->data['followingotherdata'] = $this->common->select_data_by_condition('follow', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

                $followingdatacount = count($followingotherdata);

                $unfollow = '<div>(';
                $unfollow .= '' . $followingdatacount . '';
                $unfollow .= ')</div>';


                if (count($followingotherdata) == 0) {
                    $notfound = '<div>';
                    $notfound .= '<div class="text-center rio">';
                    $notfound .= '<h4 class="page-heading  product-listing" style="border:0px;margin-bottom: 11px;">No Following Found.</h4>';
                    $notfound .= '</div></div>';
                }

                echo json_encode(
                        array("unfollow" => $unfollow,
                            "notfound" => $notfound,
                            "notcount" => $followingdatacount,
                ));
            }
        }
    }

    public function followers($id = "") {
        $this->data['userid'] = $userid = $this->session->userdata('aileenuser');

         //if user deactive profile then redirect to artistic/index untill active profile start
         $contition_array = array('user_id'=> $userid,'status' => '0','is_delete'=> '0');

        $artistic_deactive = $this->data['artistic_deactive'] = $this->common->select_data_by_condition('art_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);

        if($artistic_deactive)
        {
             redirect('artistic/');
        }
     //if user deactive profile then redirect to artistic/index untill active profile End

        if ($id == $userid || $id == '') {

            $contition_array = array('user_id' => $userid, 'status' => '1', 'is_delete' => '0');
            $this->data['artisticdata'] = $this->common->select_data_by_condition('art_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');


            $artdata = $this->common->select_data_by_id('art_reg', 'user_id', $userid, $data = '*');


            $join_str[0]['table'] = 'follow';
            $join_str[0]['join_table_id'] = 'follow.follow_to';
            $join_str[0]['from_table_id'] = 'art_reg.art_id';
            $join_str[0]['join_type'] = '';

            $contition_array = array('follow_to' => $artdata[0]['art_id'], 'follow_status' => 1, 'follow_type' => 1, 'follow_status' => 1);

            $this->data['userlist'] = $this->common->select_data_by_condition('art_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str, $groupby = '');
            //echo "<pre>"; print_r($this->data['userlist']); die();
        } else {


            $contition_array = array('user_id' => $id, 'status' => '1', 'is_delete' => '0', 'art_step' => 4);
            $this->data['artisticdata'] = $this->common->select_data_by_condition('art_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');


            $artdata = $this->common->select_data_by_id('art_reg', 'user_id', $id, $data = '*');


            $join_str[0]['table'] = 'follow';
            $join_str[0]['join_table_id'] = 'follow.follow_to';
            $join_str[0]['from_table_id'] = 'art_reg.art_id';
            $join_str[0]['join_type'] = '';

            $contition_array = array('follow_to' => $artdata[0]['art_id'], 'follow_status' => 1, 'follow_type' => 1, 'follow_status' => 1,'art_reg.art_step' => 4);

            $this->data['userlist'] = $this->common->select_data_by_condition('art_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str, $groupby = '');
        }
// code for search
        $contition_array = array('status' => '1', 'is_delete' => '0','art_step' => 4);


        $artdata = $this->data['results'] = $this->common->select_data_by_condition('art_reg', $contition_array, $data = 'art_name,art_lastname,designation,other_skill', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);


        $return_array = array();
        //  //echo  $return_array;

        foreach ($artdata as $get) {
            $return = array();
            $return = $get;


            $return['firstname'] = $get['art_name'] . " " . $get['art_lastname'];
            unset($return['art_name']);
            unset($return['art_lastname']);

            array_push($return_array, $return);
            //echo $returnarray; 
        }

        // $contition_array = array('status' => '1');
        // $artpost= $this->data['results'] =  $this->common->select_data_by_condition('art_post', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);

        $contition_array = array('status' => '1', 'type' => '2');

        $artpost = $this->data['results'] = $this->common->select_data_by_condition('skill', $contition_array, $data = 'skill', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);
        // echo "<pre>"; print_r($artpost);die();


        $uni = array_merge($return_array, $artpost);
        //   echo count($unique);


        foreach ($uni as $key => $value) {
            foreach ($value as $ke => $val) {
                if ($val != "") {


                    $result[] = $val;
                }
            }
        }
        $results = array_unique($result);
        foreach ($results as $key => $value) {
            $result1[$key]['label'] = $value;
            $result1[$key]['value'] = $value;
        }
        $this->data['demo'] = array_values($result1);
             $contition_array = array('status' => '1');

       
        $cty = $this->data['cty'] = $this->common->select_data_by_condition('cities', $contition_array, $data = 'city_name', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);
           

            foreach ($cty as $key => $value) {
            foreach ($value as $ke => $val) {
                if ($val != "") {


                    $resu[] = $val;
                }
            }
        }
        $resul = array_unique($resu);
        foreach ($resul as $key => $value) {
            $res[$key]['label'] = $value;
            $res[$key]['value'] = $value;
        }
        
        $this->data['de'] = array_values($res);


        $this->load->view('artistic/art_followers', $this->data);
    }

    public function following($id = "") {

        $this->data['userid'] = $userid = $this->session->userdata('aileenuser');

         //if user deactive profile then redirect to artistic/index untill active profile start
         $contition_array = array('user_id'=> $userid,'status' => '0','is_delete'=> '0');

        $artistic_deactive = $this->data['artistic_deactive'] = $this->common->select_data_by_condition('art_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);

        if($artistic_deactive)
        {
             redirect('artistic/');
        }
     //if user deactive profile then redirect to artistic/index untill active profile End

        if ($id == $userid || $id == '') {


            $artdata = $this->common->select_data_by_id('art_reg', 'user_id', $userid, $data = '*');

            $contition_array = array('user_id' => $userid, 'status' => '1');
            $this->data['artisticdata'] = $this->common->select_data_by_condition('art_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');


            $join_str[0]['table'] = 'follow';
            $join_str[0]['join_table_id'] = 'follow.follow_from';
            $join_str[0]['from_table_id'] = 'art_reg.art_id';
            $join_str[0]['join_type'] = '';

            $contition_array = array('follow_from' => $artdata[0]['art_id'], 'follow_status' => 1, 'follow_type' => 1 ,'art_reg.art_step' => 4);

            $this->data['userlist'] = $this->common->select_data_by_condition('art_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str, $groupby = '');
        } else {


            $artdata = $this->common->select_data_by_id('art_reg', 'user_id', $id, $data = '*');

            $contition_array = array('user_id' => $id, 'status' => '1','art_step' => 4);
            $this->data['artisticdata'] = $this->common->select_data_by_condition('art_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');


            $join_str[0]['table'] = 'follow';
            $join_str[0]['join_table_id'] = 'follow.follow_from';
            $join_str[0]['from_table_id'] = 'art_reg.art_id';
            $join_str[0]['join_type'] = '';

            $contition_array = array('follow_from' => $artdata[0]['art_id'], 'follow_status' => 1, 'follow_type' => 1,'art_reg.art_step' => 4);

            $this->data['userlist'] = $this->common->select_data_by_condition('art_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str, $groupby = '');
        }
// code for search
        $contition_array = array('status' => '1', 'is_delete' => '0','art_step' => 4);


        $artdata = $this->data['results'] = $this->common->select_data_by_condition('art_reg', $contition_array, $data = 'art_name,art_lastname,designation,other_skill', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);


        $return_array = array();
        //  //echo  $return_array;

        foreach ($artdata as $get) {
            $return = array();
            $return = $get;


            $return['firstname'] = $get['art_name'] . " " . $get['art_lastname'];
            unset($return['art_name']);
            unset($return['art_lastname']);

            array_push($return_array, $return);
            //echo $returnarray; 
        }

        // $contition_array = array('status' => '1');
        // $artpost= $this->data['results'] =  $this->common->select_data_by_condition('art_post', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);

        $contition_array = array('status' => '1', 'type' => '2');

        $artpost = $this->data['results'] = $this->common->select_data_by_condition('skill', $contition_array, $data = 'skill', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);
        // echo "<pre>"; print_r($artpost);die();


        $uni = array_merge($return_array, $artpost);
        //   echo count($unique);


        foreach ($uni as $key => $value) {
            foreach ($value as $ke => $val) {
                if ($val != "") {


                    $result[] = $val;
                }
            }
        }
        $results = array_unique($result);
        foreach ($results as $key => $value) {
            $result1[$key]['label'] = $value;
            $result1[$key]['value'] = $value;
        }

        $this->data['demo'] = array_values($result1);
             $contition_array = array('status' => '1');

       
        $cty = $this->data['cty'] = $this->common->select_data_by_condition('cities', $contition_array, $data = 'city_name', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);
           

            foreach ($cty as $key => $value) {
            foreach ($value as $ke => $val) {
                if ($val != "") {


                    $resu[] = $val;
                }
            }
        }
        $resul = array_unique($resu);
        foreach ($resul as $key => $value) {
            $res[$key]['label'] = $value;
            $res[$key]['value'] = $value;
        }
        
        $this->data['de'] = array_values($res);






        $this->load->view('artistic/art_following', $this->data);
    }

// end of user lidt
    //deactivate user start
    public function deactivate() {

        $id = $_POST['id'];
        $data = array(
            'status' => 0
        );

        $update = $this->common->update_data($data, 'art_reg', 'user_id', $id);

        // if ($update) {
        //     $this->session->set_flashdata('success', 'You are deactivate successfully.');
        //     redirect('dashboard', 'refresh');
        // } else {
        //     $this->session->flashdata('error', 'Sorry!! Your are not deactivate!!');
        //     redirect('artistic', 'refresh');
        // }
    }

// deactivate user end
//Artistic Profile Save Post Start
    public function artistic_save() {

        $userid = $this->session->userdata('aileenuser');

         //if user deactive profile then redirect to artistic/index untill active profile start
         $contition_array = array('user_id'=> $userid,'status' => '0','is_delete'=> '0');

        $artistic_deactive = $this->data['artistic_deactive'] = $this->common->select_data_by_condition('art_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);

        if($artistic_deactive)
        {
             redirect('artistic/');
        }
     //if user deactive profile then redirect to artistic/index untill active profile End

        $id = $_POST['art_post_id'];

        $contition_array = array('post_id' => $id, 'user_id' => $userid, 'is_delete' => 0);
        $userdata = $this->common->select_data_by_condition('art_post_save', $contition_array, $data = '*', $sortby = '', $orderby = 'desc', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        $save_id = $userdata[0]['save_id'];

        if ($userdata) {

            $contition_array = array('post_delete' => 1);
            $jobdata = $this->common->select_data_by_condition('art_post_save', $contition_array, $data = 'save_id', $sortby = '', $orderby = 'desc', $limit = '', $offset = '', $join_str = array(), $groupby = '');

            $data = array(
                'post_delete' => 0,
                'post_save' => 1,
                'modify_date' => date('Y-m-d h:i:s', time())
            );


            $updatedata = $this->common->update_data($data, 'art_post_save', 'save_id', $save_id);


            if ($updatedata) {

                //$savepost = '<div> Saved Post </div>';
                $savepost .= '<i class="fa fa-bookmark" aria-hidden="true"></i>';
                $savepost .= 'Saved Post';
                //$savepost .= '</a>';      
                echo $savepost;
            }
        } else {

            $data = array(
                'post_id' => $id,
                'user_id' => $userid,
                'created_date' => date('Y-m-d H:i:s', time()),
                'is_delete' => 0,
                'post_save' => 1,
                'post_delete' => 0
            );


            $insert_id = $this->common->insert_data_getid($data, 'art_post_save');
            if ($insert_id) {

                //$savepost = '<div> Saved Post </div>';
                $savepost .= '<i class="fa fa-bookmark" aria-hidden="true"></i>';
                $savepost .= 'Saved Post';
                echo $savepost;
            }
        }
    }

    //Artistic Profile Save Post End
//Artistic Profile Save Post shown Start 
    public function art_savepost($id) {

        //artistic save post data start
        $userid = $this->session->userdata('aileenuser');
        $user_name = $this->session->userdata('user_name');

         //if user deactive profile then redirect to artistic/index untill active profile start
         $contition_array = array('user_id'=> $userid,'status' => '0','is_delete'=> '0');

        $artistic_deactive = $this->data['artistic_deactive'] = $this->common->select_data_by_condition('art_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);

        if($artistic_deactive)
        {
             redirect('artistic/');
        }
     //if user deactive profile then redirect to artistic/index untill active profile End


        $contition_array = array('user_id' => $userid, 'status' => '1');
        $this->data['artisticdata'] = $this->common->select_data_by_condition('art_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        $join_str[0]['table'] = 'user';
        $join_str[0]['join_table_id'] = 'user.user_id';
        $join_str[0]['from_table_id'] = 'art_post.user_id';
        $join_str[0]['join_type'] = '';

        $data = 'art_post.*,user.first_name,user.last_name';

        $this->data['art_data'] = $this->common->select_data_by_condition('art_post', $contition_array = array(), $data, $sortby = 'art_post_id', $orderby = 'DESC', $limit = '', $offset = '', $join_str, $groupby = '');

        //artistic save post data end
        //artistic manage post data start

        $userid = $this->session->userdata('aileenuser');
        $user_name = $this->session->userdata('user_name');

        if ($id == $userid || $id == '') {

            $contition_array = array('user_id' => $userid, 'status' => '1');
            $this->data['artisticdata'] = $this->common->select_data_by_condition('art_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

            $this->data['userdata'] = $this->common->select_data_by_id('user', 'user_id', $userid, $data = '*', $join_str = array());

            $contition_array = array('user_id' => $userid, 'is_delete' => '0');
            $this->data['artsdata'] = $this->common->select_data_by_condition('art_post', $contition_array, $data = '*', $sortby = 'art_post_id', $orderby = 'DESC', $limit = '', $offset = '', $join_str = array(), $groupby = '');
        } else {

            $contition_array = array('user_id' => $id, 'status' => '1','art_step' => 4);
            $this->data['artisticdata'] = $this->common->select_data_by_condition('art_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');


            $this->data['userdata'] = $this->common->select_data_by_id('user', 'user_id', $id, $data = '*', $join_str = array());

            $contition_array = array('user_id' => $id);
            $this->data['artsdata'] = $this->common->select_data_by_condition('art_post', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
        }

//artistics mange post data end
// code for search
        $contition_array = array('status' => '1', 'is_delete' => '0','art_step' => 4);


        $artdata = $this->data['results'] = $this->common->select_data_by_condition('art_reg', $contition_array, $data = 'art_name,art_lastname,designation,other_skill', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);


        $return_array = array();
        //  //echo  $return_array;

        foreach ($artdata as $get) {
            $return = array();
            $return = $get;


            $return['firstname'] = $get['art_name'] . " " . $get['art_lastname'];
            unset($return['art_name']);
            unset($return['art_lastname']);

            array_push($return_array, $return);
            //echo $returnarray; 
        }

        // $contition_array = array('status' => '1');
        // $artpost= $this->data['results'] =  $this->common->select_data_by_condition('art_post', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);

        $contition_array = array('status' => '1', 'type' => '2');

        $artpost = $this->data['results'] = $this->common->select_data_by_condition('skill', $contition_array, $data = 'skill', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);
        // echo "<pre>"; print_r($artpost);die();


        $uni = array_merge($return_array, $artpost);
        //   echo count($unique);


        foreach ($uni as $key => $value) {
            foreach ($value as $ke => $val) {
                if ($val != "") {


                    $result[] = $val;
                }
            }
        }
        $this->data['demo'] = $result;
             $contition_array = array('status' => '1');

       
        $cty = $this->data['cty'] = $this->common->select_data_by_condition('cities', $contition_array, $data = 'city_name', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);
           

            foreach ($cty as $key => $value) {
            foreach ($value as $ke => $val) {
                if ($val != "") {


                    $resu[] = $val;
                }
            }
        }
        $resul = array_unique($resu);
        foreach ($resul as $key => $value) {
            $res[$key]['label'] = $value;
            $res[$key]['value'] = $value;
        }
        
        $this->data['de'] = array_values($res);


        $this->load->view('artistic/art_savepost', $this->data);
    }

//Artistic Profile Save Post shown End
//Artistic  Profile Remove Save Post Start
    public function art_remove_save() {

        $id = $_POST['save_id'];
        $userid = $this->session->userdata('aileenuser');

         //if user deactive profile then redirect to artistic/index untill active profile start
         $contition_array = array('user_id'=> $userid,'status' => '0','is_delete'=> '0');

        $artistic_deactive = $this->data['artistic_deactive'] = $this->common->select_data_by_condition('art_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);

        if($artistic_deactive)
        {
             redirect('artistic/');
        }
     //if user deactive profile then redirect to artistic/index untill active profile End

        $data = array(
            'post_save' => 0,
            'post_delete' => 1,
            'modify_date' => date('Y-m-d h:i:s', time())
        );

        $updatedata = $this->common->update_data($data, 'art_post_save', 'save_id', $id);


        // if($updatedata){ 
        //                 //echo $removepost; 
        // }
    }

//Artistic Profile Remove Save Post Start


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


                        $config['upload_path'] = 'uploads/user_image/';
                        $config['allowed_types'] = 'jpg|jpeg|png|gif|mp4|3gp|mpeg|mpg|mpe|qt|mov|avi|pdf';
                        $config['file_name'] = $_FILES['photoimg']['name'];
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

                        $update = $this->common->update_data($data, 'art_reg', 'user_id', $session_uid);
                        if ($update) {
                            $path = base_url('uploads/user_image/');
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

            $update = $this->common->update_data($data, 'art_reg', 'user_id', $session_uid);
            if ($update) {

                echo $position;
            }
        }
    }

    // khyati change end 15 2 
//enter designation start

    public function art_designation() {

        $userid = $this->session->userdata('aileenuser');

         //if user deactive profile then redirect to artistic/index untill active profile start
         $contition_array = array('user_id'=> $userid,'status' => '0','is_delete'=> '0');

        $artistic_deactive = $this->data['artistic_deactive'] = $this->common->select_data_by_condition('art_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);

        if($artistic_deactive)
        {
             redirect('artistic/');
        }
     //if user deactive profile then redirect to artistic/index untill active profile End

        $data = array(
            'designation' => $this->input->post('designation'),
            'modified_date' => date('Y-m-d', time())
        );


        $updatdata = $this->common->update_data($data, 'art_reg', 'user_id', $userid);

        if ($updatdata) {

            if ($this->input->post('hitext') == 1) {
                redirect('artistic/art_post', refresh);
            } elseif ($this->input->post('hitext') == 2) {
                redirect('artistic/art_addpost', refresh);
            } elseif ($this->input->post('hitext') == 3) {
                redirect('artistic/artistic_profile', refresh);
            } elseif ($this->input->post('hitext') == 4) {
                redirect('artistic/art_savepost', refresh);
            } elseif ($this->input->post('hitext') == 5) {
                redirect('artistic/art_manage_post', refresh);
            } elseif ($this->input->post('hitext') == 6) {
                redirect('artistic/followers', refresh);
            } elseif ($this->input->post('hitext') == 7) {
                redirect('artistic/following', refresh);
            } elseif ($this->input->post('hitext') == 8) {
                redirect('artistic/userlist', refresh);
            }
        } else {
            $this->session->flashdata('error', 'Your data not inserted');
            redirect('artistic/art_post', refresh);
        }

        //}
    }

//designation end
// create pdf start

    public function creat_pdf($id) {

        $contition_array = array('image_id' => $id, 'is_deleted' => '1');
        $this->data['artdata'] = $this->common->select_data_by_condition('post_image', $contition_array, $data, $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
        //echo "<pre>"; print_r($this->data['artdata']); die();
        $this->load->view('artistic/art_pdfdispaly', $this->data);
    }

//create pdf end
    // create pdf start

    public function creat_pdf1($id) {
        //echo $id ; die();
        $contition_array = array('art_id' => $id, 'status' => '1');
        $this->data['artregdata'] = $this->common->select_data_by_condition('art_reg', $contition_array, $data, $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
        //echo "<pre>"; print_r($this->data['artregdata']); die();
        $this->load->view('artistic/art_pdfdispaly', $this->data);
    }

//create pdf end
// Artistic comments like start


    public function like_comment() {

        $userid = $this->session->userdata('aileenuser');

         //if user deactive profile then redirect to artistic/index untill active profile start
         $contition_array = array('user_id'=> $userid,'status' => '0','is_delete'=> '0');

        $artistic_deactive = $this->data['artistic_deactive'] = $this->common->select_data_by_condition('art_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);

        if($artistic_deactive)
        {
             redirect('artistic/');
        }
     //if user deactive profile then redirect to artistic/index untill active profile End
        $post_id = $_POST["post_id"];

        $contition_array = array('artistic_post_comment_id' => $_POST["post_id"], 'status' => '1');
        $artdata = $this->data['artdata'] = $this->common->select_data_by_condition('artistic_post_comment', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        $artistic_comment_likes_count = $artdata[0]['artistic_comment_likes_count'];
        $likeuserarray = explode(',', $artdata[0]['artistic_comment_like_user']);

        if (!in_array($userid, $likeuserarray)) {

            $user_array = array_push($likeuserarray, $userid);

            if ($artdata[0]['artistic_comment_likes_count'] == 0) {
                $userid = implode('', $likeuserarray);
            } else {
                $userid = implode(',', $likeuserarray);
            }

            $data = array(
                'artistic_comment_likes_count' => $artistic_comment_likes_count + 1,
                'artistic_comment_like_user' => $userid,
                'modify_date' => date('y-m-d h:i:s')
            );


            $updatdata = $this->common->update_data($data, 'artistic_post_comment', 'artistic_post_comment_id', $post_id);

            // insert notification

            if ($artdata[0]['user_id'] == $userid) {
                
            } else {

                $contition_array = array('not_type' => 5, 'not_from_id' => $userid, 'not_to_id' => $artdata[0]['user_id'], 'not_product_id' => $post_id, 'not_from' => 3, 'not_img' => 3);
                $artnotification = $this->common->select_data_by_condition('notification', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
                if ($artnotification[0]['not_read'] == 2) {
                    
                } elseif ($artnotification[0]['not_read'] == 1) {

                    $datalike = array(
                        'not_read' => 2
                    );

                    $where = array('not_type' => 5, 'not_from_id' => $userid, 'not_to_id' => $artdata[0]['user_id'], 'not_product_id' => $post_id, 'not_from' => 3, 'not_img' => 3);
                    $this->db->where($where);
                    $updatdata = $this->db->update('notification', $datalike);
                } else {

                    $data = array(
                        'not_type' => 5,
                        'not_from_id' => $userid,
                        'not_to_id' => $artdata[0]['user_id'],
                        'not_read' => 2,
                        'not_product_id' => $post_id,
                        'not_from' => 3,
                        'not_img' => 3,
                        'not_active' => 1,
                        'not_created_date' => date('Y-m-d H:i:s')
                    );

                    $insert_id = $this->common->insert_data_getid($data, 'notification');
                }
            }
            // end notoification


            $contition_array = array('artistic_post_comment_id' => $_POST["post_id"], 'status' => '1');
            $artdata1 = $this->data['artdata1'] = $this->common->select_data_by_condition('artistic_post_comment', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

            if ($updatdata) {

                //$cmtlike1 = '<div>';
                $cmtlike1 = '<a id="' . $artdata1[0]['artistic_post_comment_id'] . '" onClick="comment_like(this.id)">';
                $cmtlike1 .= ' <i class="fa fa-thumbs-up" aria-hidden="true">';
                $cmtlike1 .= '</i>';
                $cmtlike1 .= '<span> ';

                if ($artdata1[0]['artistic_comment_likes_count'] > 0) {
                    $cmtlike1 .= $artdata1[0]['artistic_comment_likes_count'] . '';
                }
                $cmtlike1 .= '</span>';
                $cmtlike1 .= '</a>';
                //$cmtlike1 .= '</div>';
                echo $cmtlike1;
            } else {
                
            }
        } else {

            foreach ($likeuserarray as $key => $val) {
                if ($val == $userid) {
                    $user_array = array_splice($likeuserarray, $key, 1);
                }
            }
            $data = array(
                'artistic_comment_likes_count' => $artistic_comment_likes_count - 1,
                'artistic_comment_like_user' => implode(',', $likeuserarray),
                'modify_date' => date('y-m-d h:i:s')
            );

            $updatdata = $this->common->update_data($data, 'artistic_post_comment', 'artistic_post_comment_id', $post_id);
            $contition_array = array('artistic_post_comment_id' => $_POST["post_id"], 'status' => '1');
            $artdata2 = $this->data['artdata2'] = $this->common->select_data_by_condition('artistic_post_comment', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

            if ($updatdata) {


                //$cmtlike1 = '<div>';
                $cmtlike1 = '<a id="' . $artdata2[0]['artistic_post_comment_id'] . '" onClick="comment_like(this.id)">';
                $cmtlike1 .= '<i class="fa fa-thumbs-up fa-1x" aria-hidden="true">';
                $cmtlike1 .= '</i>';
                $cmtlike1 .= '<span>';
                if ($artdata2[0]['artistic_comment_likes_count']) {
                    $cmtlike1 .= $artdata2[0]['artistic_comment_likes_count'] . '';
                }
                $cmtlike1 .= '</span>';
                $cmtlike1 .= '</a>';
                //$cmtlike1 .= '</div>';
                echo $cmtlike1;
            } else {
                
            }
        }
    }

    public function like_comment1() {

        $userid = $this->session->userdata('aileenuser');

         //if user deactive profile then redirect to artistic/index untill active profile start
         $contition_array = array('user_id'=> $userid,'status' => '0','is_delete'=> '0');

        $artistic_deactive = $this->data['artistic_deactive'] = $this->common->select_data_by_condition('art_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);

        if($artistic_deactive)
        {
             redirect('artistic/');
        }
     //if user deactive profile then redirect to artistic/index untill active profile End
        $post_id = $_POST["post_id"];

        $contition_array = array('artistic_post_comment_id' => $_POST["post_id"], 'status' => '1');
        $artdata = $this->data['artdata'] = $this->common->select_data_by_condition('artistic_post_comment', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        $artistic_comment_likes_count = $artdata[0]['artistic_comment_likes_count'];
        $likeuserarray = explode(',', $artdata[0]['artistic_comment_like_user']);

        if (!in_array($userid, $likeuserarray)) {

            $user_array = array_push($likeuserarray, $userid);

            if ($artdata[0]['artistic_comment_likes_count'] == 0) {
                $useridcl = implode('', $likeuserarray);
            } else {
                $useridcl = implode(',', $likeuserarray);
            }

            $data = array(
                'artistic_comment_likes_count' => $artistic_comment_likes_count + 1,
                'artistic_comment_like_user' => $useridcl,
                'modify_date' => date('y-m-d h:i:s')
            );


            $updatdata = $this->common->update_data($data, 'artistic_post_comment', 'artistic_post_comment_id', $post_id);


            // insert notification

            if ($artdata[0]['user_id'] == $userid) {
                
            } else {


                $contition_array = array('not_type' => 5, 'not_from_id' => $userid, 'not_to_id' => $artdata[0]['user_id'], 'not_product_id' => $post_id, 'not_from' => 3, 'not_img' => 3);
                $artnotification = $this->common->select_data_by_condition('notification', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
                if ($artnotification[0]['not_read'] == 2) {
                    
                } elseif ($artnotification[0]['not_read'] == 1) {

                    $datalike = array(
                        'not_read' => 2
                    );

                    $where = array('not_type' => 5, 'not_from_id' => $userid, 'not_to_id' => $artdata[0]['user_id'], 'not_product_id' => $post_id, 'not_from' => 3, 'not_img' => 3);
                    $this->db->where($where);
                    $updatdata = $this->db->update('notification', $datalike);
                } else {
                    $data = array(
                        'not_type' => 5,
                        'not_from_id' => $userid,
                        'not_to_id' => $artdata[0]['user_id'],
                        'not_read' => 2,
                        'not_product_id' => $post_id,
                        'not_from' => 3,
                        'not_img' => 3,
                        'not_active' => 1,
                        'not_created_date' => date('Y-m-d H:i:s')
                    );

                    $insert_id = $this->common->insert_data_getid($data, 'notification');
                }
            }
            // end notoification


            $contition_array = array('artistic_post_comment_id' => $_POST["post_id"], 'status' => '1');
            $artdata1 = $this->data['artdata1'] = $this->common->select_data_by_condition('artistic_post_comment', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

            if ($updatdata) {

                //$cmtlike1 = '<div>';
                $cmtlike1 = '<a id="' . $artdata1[0]['artistic_post_comment_id'] . '" onClick="comment_like1(this.id)">';
                $cmtlike1 .= ' <i class="fa fa-thumbs-up" aria-hidden="true">';
                $cmtlike1 .= '</i>';
                $cmtlike1 .= '<span> ';

                if ($artdata1[0]['artistic_comment_likes_count'] > 0) {
                    $cmtlike1 .= $artdata1[0]['artistic_comment_likes_count'] . '';
                }
                $cmtlike1 .= '</span>';
                $cmtlike1 .= '</a>';
                //$cmtlike1 .= '</div>';
                echo $cmtlike1;
            } else {
                
            }
        } else {

            foreach ($likeuserarray as $key => $val) {
                if ($val == $userid) {
                    $user_array = array_splice($likeuserarray, $key, 1);
                }
            }
            $data = array(
                'artistic_comment_likes_count' => $artistic_comment_likes_count - 1,
                'artistic_comment_like_user' => implode(',', $likeuserarray),
                'modify_date' => date('y-m-d h:i:s')
            );

            $updatdata = $this->common->update_data($data, 'artistic_post_comment', 'artistic_post_comment_id', $post_id);
            $contition_array = array('artistic_post_comment_id' => $_POST["post_id"], 'status' => '1');
            $artdata2 = $this->data['artdata2'] = $this->common->select_data_by_condition('artistic_post_comment', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

            if ($updatdata) {


                //$cmtlike1 = '<div>';
                $cmtlike1 = '<a id="' . $artdata2[0]['artistic_post_comment_id'] . '" onClick="comment_like1(this.id)">';
                $cmtlike1 .= '<i class="fa fa-thumbs-up fa-1x" aria-hidden="true">';
                $cmtlike1 .= '</i>';
                $cmtlike1 .= '<span>';
                if ($artdata2[0]['artistic_comment_likes_count']) {
                    $cmtlike1 .= $artdata2[0]['artistic_comment_likes_count'] . '';
                }
                $cmtlike1 .= '</span>';
                $cmtlike1 .= '</a>';
                //$cmtlike1 .= '</div>';
                echo $cmtlike1;
            } else {
                
            }
        }
    }

// Artistic comment like end 
//Artistic comment delete start
    public function delete_comment() {
        $userid = $this->session->userdata('aileenuser');

         //if user deactive profile then redirect to artistic/index untill active profile start
         $contition_array = array('user_id'=> $userid,'status' => '0','is_delete'=> '0');

        $artistic_deactive = $this->data['artistic_deactive'] = $this->common->select_data_by_condition('art_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);

        if($artistic_deactive)
        {
             redirect('artistic/');
        }
     //if user deactive profile then redirect to artistic/index untill active profile End
        $post_id = $_POST["post_id"];
        $post_delete = $_POST["post_delete"];

        $data = array(
            'status' => 0,
        );

        $updatdata = $this->common->update_data($data, 'artistic_post_comment', 'artistic_post_comment_id', $post_id);

        $contition_array = array('art_post_id' => $post_delete, 'status' => '1');
        $artdata = $this->data['artdata'] = $this->common->select_data_by_condition('artistic_post_comment', $contition_array, $data = '*', $sortby = 'artistic_post_comment_id', $orderby = 'DESC', $limit = '1', $offset = '', $join_str = array(), $groupby = '');
//echo '<pre>'; print_r($artdata); die();
        // all count of commnet 

        $contition_array = array('art_post_id' => $_POST["post_delete"], 'status' => '1');
        $allcomnt = $this->data['allcomnt'] = $this->common->select_data_by_condition('artistic_post_comment', $contition_array, $data = '*', $sortby = 'artistic_post_comment_id', $orderby = 'DESC', $limit = '', $offset = '', $join_str = array(), $groupby = '');

// khyati changes start
        if (count($artdata) > 0) {
            foreach ($artdata as $art) {

                $artname = $this->db->get_where('art_reg', array('user_id' => $art['user_id'], 'status' => 1))->row()->art_name;
                $artlastname = $this->db->get_where('art_reg', array('user_id' => $art['user_id']))->row()->art_lastname;
                $art_userimage = $this->db->get_where('art_reg', array('user_id' => $art['user_id'], 'status' => 1))->row()->art_user_image;

                $cmtinsert .= '<div class="all-comment-comment-box">';
                $cmtinsert .= '<a href="' . base_url('artistic/art_manage_post/' . $art['user_id'] . '') . '">';
                $cmtinsert .= '<div class="post-design-pro-comment-img">';
                $cmtinsert .= '<img  src="' . base_url($this->config->item('art_profile_thumb_upload_path') . $art_userimage) . '" alt="">  </div>';
                $cmtinsert .= '<div class="comment-name"><b>' . ucwords($artname) . '&nbsp;' . ucwords($artlastname) . '</b>';
                $cmtinsert .= '</div>';
                $cmtinsert .= '</a>';
                $cmtinsert .= '<div class="comment-details" id="showcomment' . $art['artistic_post_comment_id'] . '" >';
                $cmtinsert .= $this->common->make_links($art['comments']);
                $cmtinsert .= '</div>';
                $cmtinsert .= '<div class="edit-comment-box"><div class="inputtype-edit-comment">';

//              $cmtinsert .= '<textarea  name="' . $art['artistic_post_comment_id'] . '" id="editcomment' . $art['artistic_post_comment_id'] . '" style="display:none" onClick="commentedit(this.name)">';
//              $cmtinsert .= '' . $art['comments'] . '';
//              $cmtinsert .= '</textarea>';

                $cmtinsert .= '<div contenteditable="true" style="display:none; min-height:37px !important; margin-top: 0px!important; margin-left: 1.5% !important; width: 81%;" class="editable_text" name="' . $art['artistic_post_comment_id'] . '"  id="editcomment' . $art['artistic_post_comment_id'] . '" placeholder="Type Message ..." value= ""  onkeyup="commentedit(' . $art['artistic_post_comment_id'] . ')" onpaste="OnPaste_StripFormatting(this, event);">' . $art['comments'] . '</div>';
                $cmtinsert .= '<span class="comment-edit-button"><button id="editsubmit' . $art['artistic_post_comment_id'] . '" style="display:none" onClick="edit_comment(' . $art['artistic_post_comment_id'] . ')">Save</button></span>';
                $cmtinsert .= '</div></div>';

//              $cmtinsert .= '<button id="editsubmit' . $art['artistic_post_comment_id'] . '" style="display:none" onClick="edit_comment(' . $art['artistic_post_comment_id'] . ')">Comment</button><div class="art-comment-menu-design"> <div class="comment-details-menu" id="likecomment1' . $art['artistic_post_comment_id'] . '">';

                $cmtinsert .= '<div class="art-comment-menu-design"><div class="comment-details-menu" id="likecomment1' . $art['artistic_post_comment_id'] . '">';
                $cmtinsert .= '<a id="' . $art['artistic_post_comment_id'] . '"';
                $cmtinsert .= 'onClick="comment_like1(this.id)">';

                $userid = $this->session->userdata('aileenuser');
                $contition_array = array('artistic_post_comment_id' => $art['artistic_post_comment_id'], 'status' => '1');
                $artcommentlike = $this->data['artcommentlike'] = $this->common->select_data_by_condition('artistic_post_comment', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
                $likeuserarray = explode(',', $artcommentlike[0]['artistic_comment_like_user']);

                if (!in_array($userid, $likeuserarray)) {


                    $cmtinsert .= '<i class="fa fa-thumbs-up fa-1x" aria-hidden="true"></i>';
                } else {
                    $cmtinsert .= '<i class="fa fa-thumbs-up" aria-hidden="true"></i>';
                }
                $cmtinsert .= '<span> ';

                if ($art['artistic_comment_likes_count'] > 0) {
                    $cmtinsert .= '' . $art['artistic_comment_likes_count'];
                }
                $cmtinsert .= '</span>';
                $cmtinsert .= '</a></div>';

                $userid = $this->session->userdata('aileenuser');
                if ($art['user_id'] == $userid) {
                    $cmtinsert .= '<span role="presentation" aria-hidden="true"> · </span>';
                    $cmtinsert .= '<div class="comment-details-menu">';
                    $cmtinsert .= '<div id="editcommentbox' . $art['artistic_post_comment_id'] . '" style="display:block;">';
                    $cmtinsert .= '<a id="' . $art['artistic_post_comment_id'] . '"';
                    $cmtinsert .= 'onClick="comment_editbox(this.id)">';
                    $cmtinsert .= 'Edit';
                    $cmtinsert .= '</a></div>';
                    $cmtinsert .= '<div id="editcancle' . $art['artistic_post_comment_id'] . '" style="display:none;">';
                    $cmtinsert .= '<a id="' . $art['artistic_post_comment_id'] . '" onClick="comment_editcancle(this.id)">Cancel  </a></div>';
                    $cmtinsert .= '</div>';
                }

                $userid = $this->session->userdata('aileenuser');
                $art_userid = $this->db->get_where('art_post', array('art_post_id' => $art['art_post_id'], 'status' => 1))->row()->user_id;
                if ($art['user_id'] == $userid || $art_userid == $userid) {

                    $cmtinsert .= '<span role="presentation" aria-hidden="true"> · </span>';
                    $cmtinsert .= '<div class="comment-details-menu">';
                    $cmtinsert .=  '<input type="hidden" name="post_delete"';
                    $cmtinsert .=  'id="post_delete' . $art['artistic_post_comment_id'] . '" value= "' . $art['art_post_id'] . '">';
                    $cmtinsert .= '<a id="' . $art['artistic_post_comment_id'] . '"   onClick="comment_delete(this.id)"> Delete';
                    $cmtinsert .= '<span class="insertcomment' . $art['artistic_post_comment_id'] . '"></span>';
                    $cmtinsert .=  '</a></div>';
 
                }
                $cmtinsert .= '<span role="presentation" aria-hidden="true"> · </span>';
                $cmtinsert .= '<div class="comment-details-menu">';
                $cmtinsert .= '<p>' . $this->common->time_elapsed_string(date('Y-m-d H:i:s', strtotime($art['created_date']))) . '</p></div></div></div>';

                $cmtcount = '<a onclick="commentall(this.id)" id="' . $art['art_post_id'] . '">';
                $cmtcount .= '<i class="fa fa-comment-o" aria-hidden="true">' .
                        count($allcomnt) . '</i></a>';
                
                $cntinsert =  '<span class="comment_count" >';
                          if (count($allcomnt) > 0) {
           $cntinsert .= '' . count($allcomnt) . ''; 
           $cntinsert .=   '</span>'; 
           $cntinsert .=  '<span> Comment</span>';
                                }
            }
        } else {
//            $cmtcount = '<a onClick="commentall(this.id)" id="' . $art['art_post_id'] . '">';
//            $cmtcount .= '<i class="fa fa-comment-o" aria-hidden="true">';
//            $cmtcount .= '</i></a>';
            $cmtcount = '';
        }
        echo json_encode(
                array("comment" => $cmtinsert,
                    "count" => $cmtcount,
                    "commentcount" => $cntinsert));
    }

    public function delete_commenttwo() {
        $userid = $this->session->userdata('aileenuser');

         //if user deactive profile then redirect to artistic/index untill active profile start
         $contition_array = array('user_id'=> $userid,'status' => '0','is_delete'=> '0');

        $artistic_deactive = $this->data['artistic_deactive'] = $this->common->select_data_by_condition('art_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);

        if($artistic_deactive)
        {
             redirect('artistic/');
        }
     //if user deactive profile then redirect to artistic/index untill active profile End
        $post_id = $_POST["post_id"];
        $post_delete = $_POST["post_delete"];

        $data = array(
            'status' => 0,
        );

        $updatdata = $this->common->update_data($data, 'artistic_post_comment', 'artistic_post_comment_id', $post_id);


        $contition_array = array('art_post_id' => $post_delete, 'status' => '1');
        $artdata = $this->data['artdata'] = $this->common->select_data_by_condition('artistic_post_comment', $contition_array, $data = '*', $sortby = 'artistic_post_comment_id', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');
//echo '<pre>'; print_r($artdata); die();
// khyati changes start
        if (count($artdata) > 0) {
            foreach ($artdata as $art) {

                $artname = $this->db->get_where('art_reg', array('user_id' => $art['user_id'], 'status' => 1))->row()->art_name;

                $artlastname = $this->db->get_where('art_reg', array('user_id' => $art['user_id']))->row()->art_lastname;



                $art_userimage = $this->db->get_where('art_reg', array('user_id' => $art['user_id'], 'status' => 1))->row()->art_user_image;

                $cmtinsert .= '<div class="all-comment-comment-box">';
                $cmtinsert .= '<a href="' . base_url('artistic/art_manage_post/' . $art['user_id'] . '') . '">';
                $cmtinsert .= '<div class="post-design-pro-comment-img">';
                $cmtinsert .= '<img  src="' . base_url($this->config->item('art_profile_thumb_upload_path') . $art_userimage) . '" alt="">  </div>';
                $cmtinsert .= '<div class="comment-name"><b>' . ucwords($artname) . '&nbsp;' . ucwords($artlastname) . '</b>';
                $cmtinsert .= '</div>';
                $cmtinsert .= '</a>';
                $cmtinsert .= '<div class="comment-details" id= "showcommenttwo' . $art['artistic_post_comment_id'] . '" >';
                $cmtinsert .= $this->common->make_links($art['comments']);
                $cmtinsert .= '</div>';

                $cmtinsert .= '<div class="edit-comment-box"><div class="inputtype-edit-comment">';
//            $cmtinsert .= '<textarea  name="' . $art['artistic_post_comment_id'] . '" id="editcommenttwo' . $art['artistic_post_comment_id'] . '" style="display:none" onClick="commentedittwo(this.name)">';
//            $cmtinsert .= '' . $art['comments'] . '';
//            $cmtinsert .= '</textarea>';
                $cmtinsert .= '<div contenteditable="true" style="display:none; min-height:37px !important; margin-top: 0px!important; margin-left: 1.5% !important; width: 81%;" class="editable_text" name="' . $art['artistic_post_comment_id'] . '"  id="editcommenttwo' . $art['artistic_post_comment_id'] . '" placeholder="Type Message ..." value= ""  onkeyup="commentedittwo(' . $art['artistic_post_comment_id'] . ')" onpaste="OnPaste_StripFormatting(this, event);">' . $art['comments'] . '</div>';
                //$cmtinsert .= '<button id="editsubmittwo' . $art['artistic_post_comment_id'] . '" style="display:none" onClick="edit_commenttwo(' . $art['artistic_post_comment_id'] . ')">Comment</button><div class="art-comment-menu-design"> <div class="comment-details-menu" id="likecomment1' . $art['artistic_post_comment_id'] . '">';
                $cmtinsert .= '<span class="comment-edit-button"><button id="editsubmittwo' . $art['artistic_post_comment_id'] . '" style="display:none" onClick="edit_commenttwo(' . $art['artistic_post_comment_id'] . ')">Save</button></span>';
                $cmtinsert .= '</div></div>';

                $cmtinsert .= '<div class="art-comment-menu-design"><div class="comment-details-menu" id="likecomment1' . $art['artistic_post_comment_id'] . '">';
                $cmtinsert .= '<a id="' . $art['artistic_post_comment_id'] . '"';
                $cmtinsert .= 'onClick="comment_like1(this.id)">';

                $userid = $this->session->userdata('aileenuser');
                $contition_array = array('artistic_post_comment_id' => $art['artistic_post_comment_id'], 'status' => '1');
                $artcommentlike = $this->data['artcommentlike'] = $this->common->select_data_by_condition('artistic_post_comment', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
                $likeuserarray = explode(',', $artcommentlike[0]['artistic_comment_like_user']);

                if (!in_array($userid, $likeuserarray)) {


                    $cmtinsert .= '<i class="fa fa-thumbs-up fa-1x" aria-hidden="true"></i>';
                } else {
                    $cmtinsert .= '<i class="fa fa-thumbs-up" aria-hidden="true"></i>';
                }
                $cmtinsert .= '<span> ';

                if ($art['artistic_comment_likes_count'] > 0) {
                    $cmtinsert .= '' . $art['artistic_comment_likes_count'];
                }
                $cmtinsert .= '</span>';
                $cmtinsert .= '</a></div>';

                $userid = $this->session->userdata('aileenuser');
                if ($art['user_id'] == $userid) {

                    $cmtinsert .= '<span role="presentation" aria-hidden="true"> · </span>';
                    $cmtinsert .= '<div class="comment-details-menu">';


                    $cmtinsert .= '<div id="editcommentboxtwo' . $art['artistic_post_comment_id'] . '" style="display:block;">';
                    $cmtinsert .= '<a id="' . $art['artistic_post_comment_id'] . '"';
                    $cmtinsert .= 'onClick="comment_editboxtwo(this.id)">';
                    $cmtinsert .= 'Edit';
                    $cmtinsert .= '</a></div>';
                    $cmtinsert .= '<div id="editcancletwo' . $art['artistic_post_comment_id'] . '" style="display:none;">';
                    $cmtinsert .= '<a id="' . $art['artistic_post_comment_id'] . '" onClick="comment_editcancletwo(this.id)">Cancel  </a></div>';

                    $cmtinsert .= '</div>';
                }

                $userid = $this->session->userdata('aileenuser');

                $art_userid = $this->db->get_where('art_post', array('art_post_id' => $art['art_post_id'], 'status' => 1))->row()->user_id;

                if ($art['user_id'] == $userid || $art_userid == $userid) {
                    $cmtinsert .= '<span role="presentation" aria-hidden="true"> · </span>';
                    $cmtinsert .= '<div class="comment-details-menu">';
                    $cmtinsert .= '<input type="hidden" name="post_delete"';
                    $cmtinsert .= 'id="post_deletetwo"';
                    $cmtinsert .= 'value= "' . $art['art_post_id'] . '">';

                    $cmtinsert .= '<a id="' . $art['artistic_post_comment_id'] . '"';
                    $cmtinsert .= 'onClick="comment_deletetwo(this.id)">';
                    $cmtinsert .= 'Delete';
                    $cmtinsert .= '</a></div>';
                }
                $cmtinsert .= '<span role="presentation" aria-hidden="true"> · </span>';
                $cmtinsert .= '<div class="comment-details-menu">';
                $cmtinsert .= '<p>' . $this->common->time_elapsed_string(date('Y-m-d H:i:s', strtotime($art['created_date']))) . '</p></div></div></div>';

                // comment aount variable start
                $idpost = $art['art_post_id'];
                $cmtcount = '<a onClick="commentall1(this.id)" id="' . $idpost . '">';
                $cmtcount .= '<i class="fa fa-comment-o" aria-hidden="true">';
                $cmtcount .= ' ' . count($artdata) . '';
                $cmtcount .= '</i></a>';
                
           $cntinsert =  '<span class="comment_count" >';
                          if (count($artdata) > 0) {
           $cntinsert .= '' . count($artdata) . ''; 
           $cntinsert .=   '</span>'; 
           $cntinsert .=  '<span> Comment</span>';
                                }
            }
        } else {
//            $idpost = $art['art_post_id'];
//            $cmtcount = '<a onClick="commentall1(this.id)" id="' . $idpost . '">';
//            $cmtcount .= '<i class="fa fa-comment-o" aria-hidden="true">';
//            $cmtcount .= '</i></a>';
            $cmtcount .= '';
        }
        //echo $cmtinsert;
        echo json_encode(
                array("comment" => $cmtinsert,
                    "count" => $cmtcount,
                    "commentcount" => $cntinsert));
    }

//Artistic comment delete end
// artistics post like start

    public function like_post() {

        $userid = $this->session->userdata('aileenuser');

         //if user deactive profile then redirect to artistic/index untill active profile start
         $contition_array = array('user_id'=> $userid,'status' => '0','is_delete'=> '0');

        $artistic_deactive = $this->data['artistic_deactive'] = $this->common->select_data_by_condition('art_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);

        if($artistic_deactive)
        {
             redirect('artistic/');
        }
     //if user deactive profile then redirect to artistic/index untill active profile End
        $post_id = $_POST["post_id"];

        $contition_array = array('art_post_id' => $_POST["post_id"], 'status' => '1');
        $artdata = $this->data['artdata'] = $this->common->select_data_by_condition('art_post', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        $art_likes_count = $artdata[0]['art_likes_count'];
        $likeuserarray = explode(',', $artdata[0]['art_like_user']);

        if (!in_array($userid, $likeuserarray)) {

            $user_array = array_push($likeuserarray, $userid);

            if ($artdata[0]['art_likes_count'] == 0) {
                $useridin = implode('', $likeuserarray);
            } else {
                $useridin = implode(',', $likeuserarray);
            }

            $data = array(
                'art_likes_count' => $art_likes_count + 1,
                'art_like_user' => $useridin,
                'modifiled_date' => date('y-m-d h:i:s')
            );


            $updatdata = $this->common->update_data($data, 'art_post', 'art_post_id', $post_id);



            // insert notification

            if ($artdata[0]['user_id'] == $userid) {
                
            } else {

                $contition_array = array('not_type' => 5, 'not_from_id' => $userid, 'not_to_id' => $artdata[0]['user_id'], 'not_product_id' => $post_id, 'not_from' => 3, 'not_img' => 2);
                $artnotification = $this->common->select_data_by_condition('notification', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
                if ($artnotification[0]['not_read'] == 2) {
                    
                } elseif ($artnotification[0]['not_read'] == 1) {

                    $datalike = array(
                        'not_read' => 2
                    );

                    $where = array('not_type' => 5, 'not_from_id' => $userid, 'not_to_id' => $artdata[0]['user_id'], 'not_product_id' => $post_id, 'not_from' => 3, 'not_img' => 2);
                    $this->db->where($where);
                    $updatdata = $this->db->update('notification', $datalike);
                } else {

                    $data = array(
                        'not_type' => 5,
                        'not_from_id' => $userid,
                        'not_to_id' => $artdata[0]['user_id'],
                        'not_read' => 2,
                        'not_product_id' => $post_id,
                        'not_from' => 3,
                        'not_img' => 2,
                        'not_active' => 1,
                        'not_created_date' => date('Y-m-d H:i:s')
                    );

                    $insert_id = $this->common->insert_data_getid($data, 'notification');
                }
            }
            // end notoification



            $contition_array = array('art_post_id' => $_POST["post_id"], 'status' => '1');
            $artdata1 = $this->data['artdata1'] = $this->common->select_data_by_condition('art_post', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

            if ($updatdata) {

                $cmtlike = '<li>';
                $cmtlike .= '<a id="' . $artdata1[0]['art_post_id'] . '" class="ripple like_h_w" onClick="post_like(this.id)">';
                $cmtlike .= ' <i class="fa fa-thumbs-up fa-1x main_color" aria-hidden="true">';
                $cmtlike .= '</i>';
                $cmtlike .= '<span class="like_As_count"> ';
                if ($artdata1[0]['art_likes_count'] > 0) {
                    $cmtlike .= $artdata1[0]['art_likes_count'] . '';
                }
                $cmtlike .= '</span>';
                $cmtlike .= '</a>';
                $cmtlike .= '</li>';

                //popup box start like user name
//         $cmtlikeuser .= '<div id=popuplike' . $artdata1[0]['art_post_id'].' class="overlay">';
//         $cmtlikeuser .= '<div class="popup">';
//         $cmtlikeuser .= '<div class="pop_content">';

                $contition_array = array('art_post_id' => $artdata1[0]['art_post_id'], 'status' => '1', 'is_delete' => '0');
                $commnetcount = $this->common->select_data_by_condition('art_post', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

                $likeuser = $commnetcount[0]['art_like_user'];
                $countlike = $commnetcount[0]['art_likes_count'] - 1;

                $likelistarray = explode(',', $likeuser);
                //   $likelistarray = array_reverse($likelistarray);

                foreach ($likelistarray as $key => $value) {
                    $art_fname1 = $this->db->get_where('art_reg', array('user_id' => $value, 'status' => 1))->row()->art_name;
                    $art_lname1 = $this->db->get_where('art_reg', array('user_id' => $value, 'status' => 1))->row()->art_lastname;
//      $cmtlikeuser .= '<a href="'.base_url('artistic/art_manage_post/'.$value).'">';
//
//       $cmtlikeuser .= '' . ucwords($art_fname1) . '' . ucwords($art_lname1) . '&nbsp;';
//
//      $cmtlikeuser .= '</a>';
                }
//         $cmtlikeuser .= '<p class="okk"><a class="cnclbtn" href="#">Cancel</a></p>';
//         $cmtlikeuser .= '</div>';
//         $cmtlikeuser .= '</div>';
//         $cmtlikeuser .= '</div>';
                //popup box end like user name
//            $cmtlikeuser .= '<a href=#popuplike'. $artdata1[0]['art_post_id'].'>';
             $cmtlikeuser .= '<div class="like_one_other">';

                $cmtlikeuser .= ' <a href="javascript:void(0);"  onclick="likeuserlist(' . $artdata1[0]['art_post_id'] . ');">';
                $contition_array = array('art_post_id' => $artdata1[0]['art_post_id'], 'status' => '1', 'is_delete' => '0');
                $commnetcount = $this->common->select_data_by_condition('art_post', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

                $likeuser = $commnetcount[0]['art_like_user'];
                $countlike = $commnetcount[0]['art_likes_count'] - 1;

                $likelistarray = explode(',', $likeuser);
                $likelistarray = array_reverse($likelistarray);
              $art_fname = $this->db->get_where('art_reg', array('user_id' => $likelistarray[0], 'status' => 1))->row()->art_name;

              $art_lname = $this->db->get_where('art_reg', array('user_id' => $likelistarray[0], 'status' => 1))->row()->art_lastname;

                //$cmtlikeuser .= '<div class="fl" style=" padding-left: 22px;" >';
             

                if ($userid == $likelistarray[0]) {
                    $cmtlikeuser .= 'You &nbsp';
                } else {
                    $cmtlikeuser .= '' . ucwords($art_fname) . '&nbsp;' . ucwords($art_lname) . '&nbsp;';
                }
             

                if (count($likelistarray) > 1) {

                    // $cmtlikeuser .= '<div class="fl" style="padding-right: 5px;">';
                    $cmtlikeuser .= 'and';
                    // $cmtlikeuser .= '</div>';
                    // $cmtlikeuser .= '<div style="padding-left: 5px;">';
                    $cmtlikeuser .= ' ' . $countlike . ' others';
                    // $cmtlikeuser .= '</div>';
                }

                $cmtlikeuser .= '</a>';
                   $cmtlikeuser .= '</div>';


               // $like_user_count = $commnetcount[0]['art_likes_count'];
                
               $like_count = $commnetcount[0]['art_likes_count'];
             $like_user_count =  '<span class="comment_like_count">'; 
               if ($commnetcount[0]['art_likes_count'] > 0) { 
              $like_user_count .= '' . $commnetcount[0]['art_likes_count'] . ''; 
              $like_user_count .=     '</span>'; 
              $like_user_count .= '<span> Like</span>';
               }
              
                echo json_encode(
                        array("like" => $cmtlike,
                            "likeuser" => $cmtlikeuser,
                            "likecount" => $like_count,
                            "like_user_count" => $like_user_count));
            }
        } else {

            $contition_array = array('art_post_id' => $_POST["post_id"], 'status' => '1');
            $artdata1 = $this->data['artdata1'] = $this->common->select_data_by_condition('art_post', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

            foreach ($likeuserarray as $key => $val) {
                if ($val == $userid) { //echo $key;
                    $user_array = array_splice($likeuserarray, $key, 1);
                }
            }
            $data = array(
                'art_likes_count' => $art_likes_count - 1,
                'art_like_user' => implode(',', $likeuserarray),
                'modifiled_date' => date('y-m-d h:i:s')
            );


            $updatdata = $this->common->update_data($data, 'art_post', 'art_post_id', $post_id);
            $contition_array = array('art_post_id' => $_POST["post_id"], 'status' => '1');
            $artdata2 = $this->data['artdata2'] = $this->common->select_data_by_condition('art_post', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

            if ($updatdata) {


                $cmtlike = '<li>';

                $cmtlike .= '<a id="' . $artdata2[0]['art_post_id'] . '" class="ripple like_h_w" onClick="post_like(this.id)">';

//                $cmtlike .= ' <i class="fa fa-thumbs-o-up fa-1x" aria-hidden="true">';
                $cmtlike .= '<i class="fa fa-thumbs-up" style="color: #999;" aria-hidden="true">';
                $cmtlike .= '</i>';

                $cmtlike .= '<span class="like_As_count">';
                if ($artdata2[0]['art_likes_count'] > 0) {
                    $cmtlike .= $artdata2[0]['art_likes_count'] . '';
                }
                $cmtlike .= '</span>';
                $cmtlike .= '</a>';
                $cmtlike .= '</li>';

                //popup box start like user name
//         $cmtlikeuser .= '<div id=popuplike' . $artdata1[0]['art_post_id'].' class="overlay"';
//         $cmtlikeuser .= '<div class="popup">';
//         $cmtlikeuser .= '<div class="pop_content2">';

                $contition_array = array('art_post_id' => $artdata1[0]['art_post_id'], 'status' => '1', 'is_delete' => '0');
                $commnetcount = $this->common->select_data_by_condition('art_post', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

                $likeuser = $commnetcount[0]['art_like_user'];
                $countlike = $commnetcount[0]['art_likes_count'] - 1;

                $likelistarray = explode(',', $likeuser);
                //  $likelistarray = array_reverse($likelistarray);
//        echo '<pre>';
//        print_r($likelistarray);
//        exit;

                foreach ($likelistarray as $key => $value) {

                    $art_fname1 = $this->db->get_where('art_reg', array('user_id' => $value, 'status' => 1))->row()->art_name;

                    $art_lname1 = $this->db->get_where('art_reg', array('user_id' => $value, 'status' => 1))->row()->art_lastname;

//      $cmtlikeuser .= '<a href="'.base_url('artistic/art_manage_post/'.$value).'">';
//
//       $cmtlikeuser .= '' . ucwords($art_fname1) . '' . ucwords($art_lname1) . '&nbsp;';
//
//      $cmtlikeuser .= '</a>';
                }
//         $cmtlikeuser .= '<p class="okk"><a class="cnclbtn" href="#">Cancel</a></p>';
//         $cmtlikeuser .= '</div>';
//         $cmtlikeuser .= '</div>';
//         $cmtlikeuser .= '</div>';
                //popup box end like user name
//            $cmtlikeuser .= '<a href=#popuplike'. $artdata1[0]['art_post_id'].'>';
               $cmtlikeuser .= '<div class="like_one_other">';
               $cmtlikeuser .= ' <a href="javascript:void(0);"  onclick="likeuserlist(' . $artdata1[0]['art_post_id'] . ');">';

                $contition_array = array('art_post_id' => $artdata1[0]['art_post_id'], 'status' => '1', 'is_delete' => '0');
                $commnetcount = $this->common->select_data_by_condition('art_post', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

                $likeuser = $commnetcount[0]['art_like_user'];
                $countlike = $commnetcount[0]['art_likes_count'] - 1;

                $likelistarray = explode(',', $likeuser);
                $likelistarray = array_reverse($likelistarray);
                $art_fname12 = $this->db->get_where('art_reg', array('user_id' => $likelistarray[0], 'status' => 1))->row()->art_name;
                $art_lname12 = $this->db->get_where('art_reg', array('user_id' => $likelistarray[0], 'status' => 1))->row()->art_lastname;

                //$cmtlikeuser .= '<div class="fl" style=" padding-left: 22px;" >';
              
                $cmtlikeuser .= '' . ucwords($art_fname12) . '&nbsp;' . ucwords($art_lname12) . '&nbsp;';
           
                if (count($likelistarray) > 1) {

                    //    $cmtlikeuser .= '<div class="fl" style="padding-right: 5px;">';
                    $cmtlikeuser .= 'and';
                    //    $cmtlikeuser .= '</div>';
                    //    $cmtlikeuser .= '<div style="padding-left: 5px;">';
                    $cmtlikeuser .= ' ' . $countlike . ' others';
                    //   $cmtlikeuser .= '</div>';
                }
                $cmtlikeuser .= '</a>';
     $cmtlikeuser .= '</div>';
             $like_count = $commnetcount[0]['art_likes_count'];
             $like_user_count =  '<span class="comment_like_count">'; 
               if ($commnetcount[0]['art_likes_count'] > 0) { 
              $like_user_count .= '' . $commnetcount[0]['art_likes_count'] . ''; 
              $like_user_count .=     '</span>'; 
              $like_user_count .= '<span> Like</span>';
                 }
                                                                      

                echo json_encode(
                        array("like" => $cmtlike,
                            "likeuser" => $cmtlikeuser,
                             "likecount" => $like_count,
                            "like_user_count" => $like_user_count));
            }
        }
    }

// artistics post  like end
//artistic comment insert start

    public function insert_comment() {

        $userid = $this->session->userdata('aileenuser');

         //if user deactive profile then redirect to artistic/index untill active profile start
         $contition_array = array('user_id'=> $userid,'status' => '0','is_delete'=> '0');

        $artistic_deactive = $this->data['artistic_deactive'] = $this->common->select_data_by_condition('art_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);

        if($artistic_deactive)
        {
             redirect('artistic/');
        }
     //if user deactive profile then redirect to artistic/index untill active profile End

        $post_id = $_POST["post_id"];
        $post_comment = $_POST["comment"];

        $contition_array = array('art_post_id' => $_POST["post_id"], 'status' => '1');
        $artdatacomment = $this->data['artdatacomment'] = $this->common->select_data_by_condition('art_post', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        $data = array(
            'user_id' => $userid,
            'art_post_id' => $post_id,
            'comments' => $post_comment,
            'created_date' => date('Y-m-d H:i:s', time()),
            'status' => 1,
            'is_delete' => 0
        );



        $insert_id = $this->common->insert_data_getid($data, 'artistic_post_comment');


        // insert notification

        if ($artdatacomment[0]['user_id'] == $userid) {
            
        } else {
            $data = array(
                'not_type' => 6,
                'not_from_id' => $userid,
                'not_to_id' => $artdatacomment[0]['user_id'],
                'not_read' => 2,
                'not_product_id' => $insert_id,
                'not_from' => 3,
                'not_img' => 1,
                'not_active' => 1,
                'not_created_date' => date('Y-m-d H:i:s')
            );

            $insert_id = $this->common->insert_data_getid($data, 'notification');
        }
        // end notoification



        $contition_array = array('art_post_id' => $_POST["post_id"], 'status' => '1');
        $artdata = $this->data['artdata'] = $this->common->select_data_by_condition('artistic_post_comment', $contition_array, $data = '*', $sortby = 'artistic_post_comment_id', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');

// khyati changes start
        $cmtinsert = '<div class="insertcommenttwo' . $post_id . '">';
        foreach ($artdata as $art) {

            $artname = $this->db->get_where('art_reg', array('user_id' => $art['user_id'], 'status' => 1))->row()->art_name;

            $artlastname = $this->db->get_where('art_reg', array('user_id' => $art['user_id']))->row()->art_lastname;


            $art_userimage = $this->db->get_where('art_reg', array('user_id' => $art['user_id'], 'status' => 1))->row()->art_user_image;

            $cmtinsert .= '<div class="all-comment-comment-box">';
            $cmtinsert .= '<a href="' . base_url('artistic/art_manage_post/' . $art['user_id'] . '') . '">';
            $cmtinsert .= '<div class="post-design-pro-comment-img">';
            $cmtinsert .= '<img  src="' . base_url($this->config->item('art_profile_thumb_upload_path') . $art_userimage) . '" alt="">  </div>';
            $cmtinsert .= '<div class="comment-name"><b>' . ucwords($artname) . '&nbsp;' . ucwords($artlastname) . '</b>';
            $cmtinsert .= '</div>';
            $cmtinsert .= '</a>';
            $cmtinsert .= '<div class="comment-details" id= "showcommenttwo' . $art['artistic_post_comment_id'] . '" >';
            $cmtinsert .= $this->common->make_links($art['comments']);
            $cmtinsert .= '</div>';
            $cmtinsert .= '<div class="edit-comment-box"><div class="inputtype-edit-comment">';
//            $cmtinsert .= '<textarea  name="' . $art['artistic_post_comment_id'] . '" id="editcommenttwo' . $art['artistic_post_comment_id'] . '" style="display:none" onClick="commentedittwo(this.name)">';
//            $cmtinsert .= '' . $art['comments'] . '';
//            $cmtinsert .= '</textarea>';
            $cmtinsert .= '<div contenteditable="true" style="display:none; min-height:37px !important; margin-top: 0px!important; margin-left: 1.5% !important; width: 81%;" class="editable_text" name="' . $art['artistic_post_comment_id'] . '"  id="editcommenttwo' . $art['artistic_post_comment_id'] . '" placeholder="Type Message ..." value= ""  onkeyup="commentedittwo(' . $art['artistic_post_comment_id'] . ')" onpaste="OnPaste_StripFormatting(this, event);">' . $art['comments'] . '</div>';
            $cmtinsert .= '<span class="comment-edit-button"><button id="editsubmittwo' . $art['artistic_post_comment_id'] . '" style="display:none" onclick="edit_commenttwo(' . $art['artistic_post_comment_id'] . ')">Save</button></span>';
            $cmtinsert .= '</div></div>';

//            $cmtinsert .= '<button id="editsubmittwo' . $art['artistic_post_comment_id'] . '" style="display:none" onClick="edit_commenttwo(' . $art['artistic_post_comment_id'] . ')">Comment</button><div class="art-comment-menu-design"> <div class="comment-details-menu" id="likecomment1' . $art['artistic_post_comment_id'] . '">';
            $cmtinsert .= '<div class="art-comment-menu-design"><div class="comment-details-menu" id="likecomment1' . $art['artistic_post_comment_id'] . '">';
            $cmtinsert .= '<a id="' . $art['artistic_post_comment_id'] . '"';
            $cmtinsert .= 'onClick="comment_like1(this.id)">';



            $userid = $this->session->userdata('aileenuser');
            $contition_array = array('artistic_post_comment_id' => $art['artistic_post_comment_id'], 'status' => '1');
            $artcommentlike = $this->data['artcommentlike'] = $this->common->select_data_by_condition('artistic_post_comment', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
            $likeuserarray = explode(',', $artcommentlike[0]['artistic_comment_like_user']);

            if (!in_array($userid, $likeuserarray)) {


                $cmtinsert .= '<i class="fa fa-thumbs-up fa-1x" aria-hidden="true"></i>';
            } else {
                $cmtinsert .= '<i class="fa fa-thumbs-up" aria-hidden="true"></i>';
            }
            $cmtinsert .= '<span>';

            if ($art['artistic_comment_likes_count'] > 0) {
                $cmtinsert .= ' ' . $art['artistic_comment_likes_count'];
            }
            $cmtinsert .= '</span>';
            $cmtinsert .= '</a></div>';

            $userid = $this->session->userdata('aileenuser');
            if ($art['user_id'] == $userid) {
                $cmtinsert .= '<span role="presentation" aria-hidden="true"> · </span>';
                $cmtinsert .= '<div class="comment-details-menu">';


                $cmtinsert .= '<div id="editcommentboxtwo' . $art['artistic_post_comment_id'] . '" style="display:block;">';
                $cmtinsert .= '<a id="' . $art['artistic_post_comment_id'] . '"';
                $cmtinsert .= 'onClick="comment_editboxtwo(this.id)">';
                $cmtinsert .= 'Edit';
                $cmtinsert .= '</a></div>';
                $cmtinsert .= '<div id="editcancletwo' . $art['artistic_post_comment_id'] . '" style="display:none;">';
                $cmtinsert .= '<a id="' . $art['artistic_post_comment_id'] . '" onClick="comment_editcancletwo(this.id)">Cancel  </a></div>';

                $cmtinsert .= '</div>';
            }

            $userid = $this->session->userdata('aileenuser');

            $art_userid = $this->db->get_where('art_post', array('art_post_id' => $art['art_post_id'], 'status' => 1))->row()->user_id;

            if ($art['user_id'] == $userid || $art_userid == $userid) {
                $cmtinsert .= '<span role="presentation" aria-hidden="true"> · </span>';
                $cmtinsert .= '<div class="comment-details-menu">';

                $cmtinsert .= '<input type="hidden" name="post_deletetwo"';
                $cmtinsert .= 'id="post_deletetwo"';
                $cmtinsert .= 'value= "' . $art['art_post_id'] . '">';

                $cmtinsert .= '<a id="' . $art['artistic_post_comment_id'] . '"';
                $cmtinsert .= 'onClick="comment_deletetwo(this.id)">';
                $cmtinsert .= 'Delete';
                $cmtinsert .= '</a></div>';
            }
            $cmtinsert .= '<span role="presentation" aria-hidden="true"> · </span>';
            $cmtinsert .= '<div class="comment-details-menu">';
            $cmtinsert .= '<p>' . $this->common->time_elapsed_string(date('Y-m-d H:i:s', strtotime($art['created_date']))) . '</p></div></div></div>';


            // comment aount variable start
//            $idpost = $art['art_post_id'];
//            $cmtcount = '<a onClick="commentall(this.id)" id="' . $idpost . '">';
//            $cmtcount .= '<i class="fa fa-comment-o" aria-hidden="true">';
//            $cmtcount .= ' ' . count($artdata) . '';
//            $cmtcount .= '</i></a>';
//            
             $cntinsert =  '<span class="comment_count" >';
     if (count($artdata) > 0) {
           $cntinsert .= '' . count($artdata) . ''; 
           $cntinsert .=   '</span>'; 
           $cntinsert .=  '<span> Comment</span>';
        
           }
        }
        //echo $cmtinsert;
        echo json_encode(
                array("comment" => $cmtinsert,
                    "comment" => $cmtinsert,
                    "commentcount" => $cntinsert));
        // khyati chande 
    }

    public function insert_commentthree() {

        $userid = $this->session->userdata('aileenuser');

         //if user deactive profile then redirect to artistic/index untill active profile start
         $contition_array = array('user_id'=> $userid,'status' => '0','is_delete'=> '0');

        $artistic_deactive = $this->data['artistic_deactive'] = $this->common->select_data_by_condition('art_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);

        if($artistic_deactive)
        {
             redirect('artistic/');
        }
     //if user deactive profile then redirect to artistic/index untill active profile End

    $post_id = $_POST["post_id"];
      $post_comment = $_POST["comment"];
//die();

        $contition_array = array('art_post_id' => $_POST["post_id"], 'status' => '1');
        $artdatacomment = $this->data['artdatacomment'] = $this->common->select_data_by_condition('art_post', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        $data = array(
            'user_id' => $userid,
            'art_post_id' => $post_id,
            'comments' => $post_comment,
            'created_date' => date('Y-m-d H:i:s', time()),
            'status' => 1,
            'is_delete' => 0
        );



        $insert_id = $this->common->insert_data_getid($data, 'artistic_post_comment');

        // insert notification

        if ($artdatacomment[0]['user_id'] == $userid) {
            
        } else {
            $notificationdata = array(
                'not_type' => 6,
                'not_from_id' => $userid,
                'not_to_id' => $artdatacomment[0]['user_id'],
                'not_read' => 2,
                'not_product_id' => $insert_id,
                'not_from' => 3,
                'not_img' => 1,
                'not_active' => 1,
                'not_created_date' => date('Y-m-d H:i:s')
            );
            //echo "<pre>"; print_r($notificationdata); 
            $insert_id_notification = $this->common->insert_data_getid($notificationdata, 'notification');
        }
        // end notoification



        $contition_array = array('art_post_id' => $_POST["post_id"], 'status' => '1');
        $artdata = $this->data['artdata'] = $this->common->select_data_by_condition('artistic_post_comment', $contition_array, $data = '*', $sortby = 'artistic_post_comment_id', $orderby = 'DESC', $limit = '1', $offset = '', $join_str = array(), $groupby = '');

        //echo "<pre>"; print_r($artdata); die();
        // all count of commnet 

        $contition_array = array('art_post_id' => $_POST["post_id"], 'status' => '1');
        $allcomnt = $this->data['allcomnt'] = $this->common->select_data_by_condition('artistic_post_comment', $contition_array, $data = '*', $sortby = 'artistic_post_comment_id', $orderby = 'DESC', $limit = '', $offset = '', $join_str = array(), $groupby = '');
        // echo '<pre>'; print_r($artdata); die();            
// khyati changes start

        foreach ($artdata as $art) {

            $artname = $this->db->get_where('art_reg', array('user_id' => $art['user_id'], 'status' => 1))->row()->art_name;

            $artlastname = $this->db->get_where('art_reg', array('user_id' => $art['user_id']))->row()->art_lastname;


            $art_userimage = $this->db->get_where('art_reg', array('user_id' => $art['user_id'], 'status' => 1))->row()->art_user_image;

            $cmtinsert .= '<div class="all-comment-comment-box">';
            $cmtinsert .= '<a href="' . base_url('artistic/art_manage_post/' . $art['user_id'] . '') . '">';
            $cmtinsert .= '<div class="post-design-pro-comment-img">';
            $cmtinsert .= '<img  src="' . base_url($this->config->item('art_profile_thumb_upload_path') . $art_userimage) . '" alt="">  </div>';
            $cmtinsert .= '<div class="comment-name"><b>' . ucwords($artname) . '&nbsp;' . ucwords($artlastname) . '</b>';
            $cmtinsert .= '</div>';
            $cmtinsert .= '</a>';
            $cmtinsert .= '<div class="comment-details" id= "showcomment' . $art['artistic_post_comment_id'] . '" >';
            $cmtinsert .= $this->common->make_links($art['comments']);
            $cmtinsert .= '</div>';
            $cmtinsert .= '<div class="edit-comment-box"><div class="inputtype-edit-comment">';
            $cmtinsert .= '<div contenteditable="true" class="editable_text"  name="' . $art['artistic_post_comment_id'] . '" id="editcomment' . $art['artistic_post_comment_id'] . '" style="display:none; min-height:37px !important; margin-top: 0px!important; margin-left: 1.5% !important; width: 81%;" onkeyup="commentedit(' . $art['artistic_post_comment_id'] . ')" onpaste="OnPaste_StripFormatting(this, event);">';
            $cmtinsert .= '' . $art['comments'] . '';
            $cmtinsert .= '</div>';
            $cmtinsert .= '<span class="comment-edit-button"><button id="editsubmit' . $art['artistic_post_comment_id'] . '" style="display:none" onClick="edit_comment(' . $art['artistic_post_comment_id'] . ')">Save</button></span>';
            $cmtinsert .= '</div></div>';
            //$cmtinsert .= '<button id="editsubmit' . $art['artistic_post_comment_id'] . '" style="display:none" onClick="edit_comment(' . $art['artistic_post_comment_id'] . ')">Comment</button><div class="art-comment-menu-design"> <div class="comment-details-menu" id="likecomment1' . $art['artistic_post_comment_id'] . '">';

            $cmtinsert .= '<div class="art-comment-menu-design"><div class="comment-details-menu" id="likecomment1' . $art['artistic_post_comment_id'] . '">';
            $cmtinsert .= '<a id="' . $art['artistic_post_comment_id'] . '"';
            $cmtinsert .= 'onClick="comment_like1(this.id)">';



            $userid = $this->session->userdata('aileenuser');
            $contition_array = array('artistic_post_comment_id' => $art['artistic_post_comment_id'], 'status' => '1');
            $artcommentlike = $this->data['artcommentlike'] = $this->common->select_data_by_condition('artistic_post_comment', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
            $likeuserarray = explode(',', $artcommentlike[0]['artistic_comment_like_user']);

            if (!in_array($userid, $likeuserarray)) {


                $cmtinsert .= '<i class="fa fa-thumbs-up fa-1x" aria-hidden="true"></i>';
            } else {
                $cmtinsert .= '<i class="fa fa-thumbs-up" aria-hidden="true"></i>';
            }
            $cmtinsert .= '<span>';

            if ($art['artistic_comment_likes_count'] > 0) {
                $cmtinsert .= ' ' . $art['artistic_comment_likes_count'];
            }
            $cmtinsert .= '</span>';
            $cmtinsert .= '</a></div>';

            $userid = $this->session->userdata('aileenuser');
            if ($art['user_id'] == $userid) {

                $cmtinsert .= '<span role="presentation" aria-hidden="true"> · </span>';
                $cmtinsert .= '<div class="comment-details-menu">';
                $cmtinsert .= '<div id="editcommentbox' . $art['artistic_post_comment_id'] . '" style="display:block;">';
                $cmtinsert .= '<a id="' . $art['artistic_post_comment_id'] . '"';
                $cmtinsert .= 'onClick="comment_editbox(this.id)">';
                $cmtinsert .= 'Edit';
                $cmtinsert .= '</a></div>';
                $cmtinsert .= '<div id="editcancle' . $art['artistic_post_comment_id'] . '" style="display:none;">';
                $cmtinsert .= '<a id="' . $art['artistic_post_comment_id'] . '" onClick="comment_editcancle(this.id)">Cancel  </a></div>';

                $cmtinsert .= '</div>';
            }

            $userid = $this->session->userdata('aileenuser');
            $art_userid = $this->db->get_where('art_post', array('art_post_id' => $art['art_post_id'], 'status' => 1))->row()->user_id;

            if ($art['user_id'] == $userid || $art_userid == $userid) {

                $cmtinsert .= '<span role="presentation" aria-hidden="true"> · </span>';
                $cmtinsert .= '<div class="comment-details-menu">';
                
   $cmtinsert .=  '<input type="hidden" name="post_delete"';
   $cmtinsert .=  'id="post_delete' . $art['artistic_post_comment_id'] . '" value= "' . $art['art_post_id'] . '">';
   $cmtinsert .= '<a id="' . $art['artistic_post_comment_id'] . '"   onClick="comment_delete(this.id)"> Delete';
   $cmtinsert .= '<span class="insertcomment' . $art['artistic_post_comment_id'] . '"></span>';
   $cmtinsert .=  '</a></div>';
 
            }

            $cmtinsert .= '<span role="presentation" aria-hidden="true"> · </span>';
            $cmtinsert .= '<div class="comment-details-menu">';
            $cmtinsert .= '<p>' . $this->common->time_elapsed_string(date('Y-m-d H:i:s', strtotime($art['created_date']))) . '</p></div></div></div>';
//          $cntinsert .= '<a onclick="commentall(this.id)" id="' . $art['art_post_id'] . '">';
 //          $cntinsert .= '<i class="fa fa-comment-o" aria-hidden="true">' .
//                    count($allcomnt) . '</i>';
            
          $cntinsert =  '<span class="comment_count" >';
     if (count($allcomnt) > 0) {
           $cntinsert .= '' . count($allcomnt) . ''; 
           $cntinsert .=   '</span>'; 
           $cntinsert .=  '<span> Comment</span>';
        
           }
       }
        echo json_encode(
                array("count" => $cntinsert,
                    "comment" => $cmtinsert,
                    "commentcount" => $cntinsert));

        // khyati chande 
    }

//artistic comment insert end  
//artistic comment edit start
    public function edit_comment_insert() {

        $userid = $this->session->userdata('aileenuser');

         //if user deactive profile then redirect to artistic/index untill active profile start
         $contition_array = array('user_id'=> $userid,'status' => '0','is_delete'=> '0');

        $artistic_deactive = $this->data['artistic_deactive'] = $this->common->select_data_by_condition('art_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);

        if($artistic_deactive)
        {
             redirect('artistic/');
        }
     //if user deactive profile then redirect to artistic/index untill active profile End

        $post_id = $_POST["post_id"];
        $post_comment = $_POST["comment"];

        $data = array(
            'comments' => $post_comment,
            'modify_date' => date('y-m-d h:i:s')
        );

        $updatdata = $this->common->update_data($data, 'artistic_post_comment', 'artistic_post_comment_id', $post_id);
        if ($updatdata) {

            $contition_array = array('artistic_post_comment_id' => $_POST["post_id"], 'status' => '1');
            $artdata = $this->data['artdata'] = $this->common->select_data_by_condition('artistic_post_comment', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

            // $cmtlike = '<div>';
            $cmtlike = $this->common->make_links($artdata[0]['comments']) . "<br>";
            //   $cmtlike .= '</div>';
            echo $cmtlike;
        }
    }

//artistic comment edit end 
// cover pic controller

    public function ajaxpro() {
        $userid = $this->session->userdata('aileenuser');

         //if user deactive profile then redirect to artistic/index untill active profile start
         $contition_array = array('user_id'=> $userid,'status' => '0','is_delete'=> '0');

        $artistic_deactive = $this->data['artistic_deactive'] = $this->common->select_data_by_condition('art_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);

        if($artistic_deactive)
        {
             redirect('artistic/');
        }
     //if user deactive profile then redirect to artistic/index untill active profile End
        
        // REMOVE OLD IMAGE FROM FOLDER
        $contition_array = array('user_id' => $userid);
        $user_reg_data = $this->common->select_data_by_condition('art_reg', $contition_array, $data = 'profile_background,profile_background_main', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        $user_reg_prev_image = $user_reg_data[0]['profile_background'];
        $user_reg_prev_main_image = $user_reg_data[0]['profile_background_main'];

        if ($user_reg_prev_image != '') {
            $user_image_main_path = $this->config->item('art_bg_main_upload_path');
            $user_bg_full_image = $user_image_main_path . $user_reg_prev_image;
            if (isset($user_bg_full_image)) {
                unlink($user_bg_full_image);
            }

            $user_image_thumb_path = $this->config->item('art_bg_thumb_upload_path');
            $user_bg_thumb_image = $user_image_thumb_path . $user_reg_prev_image;
            if (isset($user_bg_thumb_image)) {
                unlink($user_bg_thumb_image);
            }
        }
        if ($user_reg_prev_main_image != '') {
            $user_image_original_path = $this->config->item('art_bg_original_upload_path');
            $user_bg_origin_image = $user_image_original_path . $user_reg_prev_main_image;
            if (isset($user_bg_origin_image)) {
                unlink($user_bg_origin_image);
            }
        }

        // REMOVE OLD IMAGE FROM FOLDER
        
        $data = $_POST['image'];

/*        $imageName = time() . '.png';
        $base64string = $data;
        file_put_contents('uploads/art_bg/' . $imageName, base64_decode(explode(',', $base64string)[1]));
 */
        $user_bg_path = $this->config->item('art_bg_main_upload_path');
        $imageName = time() . '.png';
        $base64string = $data;
        file_put_contents($user_bg_path . $imageName, base64_decode(explode(',', $base64string)[1]));

        $user_thumb_path = $this->config->item('art_bg_thumb_upload_path');
        $user_thumb_width = $this->config->item('art_bg_thumb_width');
        $user_thumb_height = $this->config->item('art_bg_thumb_height');

        $upload_image = $user_bg_path . $imageName;

        $thumb_image_uplode = $this->thumb_img_uplode($upload_image, $imageName, $user_thumb_path, $user_thumb_width, $user_thumb_height);


        $data = array(
            'profile_background' => $imageName
        );

        $update = $this->common->update_data($data, 'art_reg', 'user_id', $userid);

        $this->data['artdata'] = $this->common->select_data_by_id('art_reg', 'user_id', $userid, $data = '*', $join_str = array());

        echo '<img src="' . $this->data['artdata'][0]['profile_background'] . '" />';
    }

    public function image() {
        $userid = $this->session->userdata('aileenuser');

         //if user deactive profile then redirect to artistic/index untill active profile start
         $contition_array = array('user_id'=> $userid,'status' => '0','is_delete'=> '0');

        $artistic_deactive = $this->data['artistic_deactive'] = $this->common->select_data_by_condition('art_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);

        if($artistic_deactive)
        {
             redirect('artistic/');
        }
     //if user deactive profile then redirect to artistic/index untill active profile End

        $config['upload_path'] = $this->config->item('art_bg_original_upload_path');
        $config['allowed_types'] = 'jpg|jpeg|png|gif';

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


        $updatedata = $this->common->update_data($data, 'art_reg', 'user_id', $userid);

        if ($updatedata) {
            echo $userid;
        } else {
            echo "welcome";
        }
    }

    // cover pic end
// click on post after post open on new page start
    public function postnewpage($id = '') {
        $userid = $this->session->userdata('aileenuser');

         //if user deactive profile then redirect to artistic/index untill active profile start
         $contition_array = array('user_id'=> $userid,'status' => '0','is_delete'=> '0');

        $artistic_deactive = $this->data['artistic_deactive'] = $this->common->select_data_by_condition('art_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);

        if($artistic_deactive)
        {
             redirect('artistic/');
        }
     //if user deactive profile then redirect to artistic/index untill active profile End
        $contition_array = array('user_id' => $userid, 'status' => '1');
        $this->data['artisticdata'] = $this->common->select_data_by_condition('art_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        $contition_array = array('art_post_id' => $id, 'status' => '1');
        $this->data['art_data'] = $this->common->select_data_by_condition('art_post', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        //echo "<pre>"; print_r($this->data['art_data']);die();

        //code search
        $contition_array = array('status' => '1', 'is_delete' => '0','art_step' => 4);


        $artdata = $this->data['results'] = $this->common->select_data_by_condition('art_reg', $contition_array, $data = 'art_name,art_lastname,designation,other_skill', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);


        $return_array = array();
        //  //echo  $return_array;

        foreach ($artdata as $get) {
            $return = array();
            $return = $get;


            $return['firstname'] = $get['art_name'] . " " . $get['art_lastname'];
            unset($return['art_name']);
            unset($return['art_lastname']);

            array_push($return_array, $return);
            //echo $returnarray; 
        }

        $contition_array = array('status' => '1', 'type' => '2');

        $artpost = $this->data['results'] = $this->common->select_data_by_condition('skill', $contition_array, $data = 'skill', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);
        // echo "<pre>"; print_r($artpost);die();


        $uni = array_merge($return_array, $artpost);
        //   echo count($unique);


        foreach ($uni as $key => $value) {
            foreach ($value as $ke => $val) {
                if ($val != "") {


                    $result[] = $val;
                }
            }
        }
        $results = array_unique($result);
        foreach ($results as $key => $value) {
            $result1[$key]['label'] = $value;
            $result1[$key]['value'] = $value;
        }

        $this->data['demo'] = array_values($result1);
             $contition_array = array('status' => '1');

       
        $cty = $this->data['cty'] = $this->common->select_data_by_condition('cities', $contition_array, $data = 'city_name', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);
           

            foreach ($cty as $key => $value) {
            foreach ($value as $ke => $val) {
                if ($val != "") {


                    $resu[] = $val;
                }
            }
        }
        $resul = array_unique($resu);
        foreach ($resul as $key => $value) {
            $res[$key]['label'] = $value;
            $res[$key]['value'] = $value;
        }
        
        $this->data['de'] = array_values($res);



        $this->load->view('artistic/postnewpage', $this->data);
    }

// click on post after post open on new page end
//edit post start

    public function edit_post_insert() {

        $userid = $this->session->userdata('aileenuser');

        //echo "<pre>"; print_r($_POST); die();

         //if user deactive profile then redirect to artistic/index untill active profile start
         $contition_array = array('user_id'=> $userid,'status' => '0','is_delete'=> '0');

        $artistic_deactive = $this->data['artistic_deactive'] = $this->common->select_data_by_condition('art_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);

        if($artistic_deactive)
        {
             redirect('artistic/');
        }
     //if user deactive profile then redirect to artistic/index untill active profile End

        $post_id = $_POST["art_post_id"];
        $art_post = $_POST["art_post"];
       $art_description = $_POST["art_description"]; 

        $data = array(
            'art_post' => $art_post,
            'art_description' => $art_description,
            'modifiled_date' => date('y-m-d h:i:s')
        );

        $updatdata = $this->common->update_data($data, 'art_post', 'art_post_id', $post_id);
        if ($updatdata) {

            $contition_array = array('art_post_id' => $_POST["art_post_id"], 'status' => '1');
            $artdata = $this->data['artdata'] = $this->common->select_data_by_condition('art_post', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

            //echo "<pre>"; print_r($artdata); die();
            if ($this->data['artdata'][0]['art_post']) {
                $editpost = '<div><a>';
                $editpost .= $this->common->make_links($artdata[0]['art_post']) . "<br>";
                $editpost .= '</a></div>';
            }
            if ($this->data['artdata'][0]['art_description']) {
//                $com_link = $this->common->make_links($artdata[0]['art_description']);
//                $com_link = substr($com_link, 0, 200);
//                $editpostdes .= '<span class="show">';
//                $editpostdes .= $com_link;
//                $editpostdes .= '<span class="dots">...</span><span class="morectnt"><span></span>&nbsp;&nbsp;<a href="javascript:void(0);" class="showmoretxt">More</a></span></span>';
            
                $small = substr($artdata[0]['art_description'], 0, 180);
                    $editpostdes .= $small;
                    if(strlen($artdata[0]['art_description']) >180){
                        $editpostdes .= '...<span id="kkkk" onClick="khdiv(' . $_POST["art_post_id"] . ')">View More</div>'; 
                    }

                
                }
            //echo $editpost;   echo $editpostdes;
            echo json_encode(
                    array("title" => $editpost,
                        "description" => $editpostdes));
        }
    }

//edit post end
//reactivate account start

    public function reactivate() {

        $userid = $this->session->userdata('aileenuser');

        
        $data = array(
            'status' => 1,
            'modified_date' => date('y-m-d h:i:s')
        );

        $updatdata = $this->common->update_data($data, 'art_reg', 'user_id', $userid);
        if ($updatdata) {

            redirect('artistic/art_post', refresh);
        } else {

            redirect('artistic/reactivate', refresh);
        }
    }

//reactivate accont end 
//delete post particular user start
    public function del_particular_userpost() {

        $userid = $this->session->userdata('aileenuser');

         //if user deactive profile then redirect to artistic/index untill active profile start
         $contition_array = array('user_id'=> $userid,'status' => '0','is_delete'=> '0');

        $artistic_deactive = $this->data['artistic_deactive'] = $this->common->select_data_by_condition('art_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);

        if($artistic_deactive)
        {
             redirect('artistic/');
        }
     //if user deactive profile then redirect to artistic/index untill active profile End

        $post_id = $_POST['art_post_id'];

        $contition_array = array('art_post_id' => $post_id, 'status' => '1');
        $artdata = $this->data['artdata'] = $this->common->select_data_by_condition('art_post', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        $likeuserarray = explode(',', $artdata[0]['delete_post']);

        $user_array = array_push($likeuserarray, $userid);

        if ($artdata[0]['delete_post'] == 0) {
            $userid = implode('', $likeuserarray);
        } else {
            $userid = implode(',', $likeuserarray);
        }

        $data = array(
            'delete_post' => $userid,
            'modifiled_date' => date('y-m-d h:i:s')
        );

        $updatdata = $this->common->update_data($data, 'art_post', 'art_post_id', $post_id);




         $contition_array = array('user_id' => $userid, 'status' => '1');
        $this->data['artisticdata'] = $this->common->select_data_by_condition('art_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        //echo "<pre>"; print_r($this->data['artisticdata']); die();
        $artregid = $this->data['artisticdata'][0]['art_id'];


         $contition_array = array('follow_from' => $artregid, 'follow_status' => '1', 'follow_type' => '1');
        $followerdata1 = $this->data['followerdata1'] = $this->common->select_data_by_condition('follow', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        //echo "<pre>"; print_r($this->data['followerdata']); die();


        foreach ($followerdata1 as $fdata) {

            $user_id = $this->db->get_where('art_reg', array('art_id' => $fdata['follow_to'], 'status' => '1'))->row()->user_id;


            $contition_array = array('art_post.user_id' => $user_id, 'art_post.status' => '1', 'art_post.user_id !=' => $userid, 'art_post.is_delete' => '0');
            $this->data['art_data'] = $this->common->select_data_by_condition('art_post', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');


            $followerabc[] = $this->data['art_data'];
        }

        //echo "<pre>"; print_r($followerabc); die();
//data fatch using follower end
//data fatch using skill start

        $userselectskill = $this->data['artisticdata'][0]['art_skill'];
        //echo  $userselectskill; die();
        $contition_array = array('art_skill' => $userselectskill, 'status' => '1' , 'art_step' => 4);
        $skilldata = $this->data['skilldata'] = $this->common->select_data_by_condition('art_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        //echo "<pre>"; print_r($this->data['skilldata']); die();

        foreach ($skilldata as $fdata) {


            $contition_array = array('art_post.user_id' => $fdata['user_id'], 'art_post.status' => '1', 'art_post.user_id !=' => $userid, 'art_post.is_delete' => '0');

            $this->data['art_data'] = $this->common->select_data_by_condition('art_post', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
            $skillabc[] = $this->data['art_data'];
        }


//data fatch using skill end
//data fatch using login user last post start
        $contition_array = array('art_post.user_id' => $userid, 'art_post.status' => '1', 'art_post.is_delete' => '0');

        $art_userdata = $this->data['art_userdata'] = $this->common->select_data_by_condition('art_post', $contition_array, $data = '*', $sortby = 'art_post_id', $orderby = 'DESC', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        if (count($art_userdata) > 0) {
            $userabc[][] = $this->data['art_userdata'][0];
        } else {
            $userabc[] = $this->data['art_userdata'][0];
        }
        //echo "<pre>"; print_r($userabc); die();
        //echo "<pre>"; print_r($skillabc);  die();
//data fatch using login user last post end
//echo count($skillabc);
//echo count($userabc);
//echo count($unique);
//echo count($followerabc); 


        if (count($skillabc) == 0 && count($userabc) != 0) {
            $unique = $userabc;
        } elseif (count($userabc) == 0 && count($skillabc) != 0) {
            $unique = $skillabc;
        } elseif (count($userabc) != 0 && count($skillabc) != 0) {
            $unique = array_merge($skillabc, $userabc);
        }

        //echo "<pre>"; print_r($userabc); die();
        //echo count($followerabc);  echo count($unique); die();

        if (count($followerabc) == 0 && count($unique) != 0) {
            $unique_user = $unique;
        } elseif (count($unique) == 0 && count($followerabc) != 0) {

            $unique_user = $followerabc;
        } elseif (count($unique) != 0 && count($followerabc) != 0) {
            $unique_user = array_merge($unique, $followerabc);
        }



        foreach ($unique_user as $key1 => $val1) {
            foreach ($val1 as $ke => $va) {

                $qbc[] = $va;
            }
        }


        $qbc = array_unique($qbc, SORT_REGULAR);
        //echo "<pre>"; print_r($qbc); die();
        // sorting start

        $post = array();

        //$i =0;
        foreach ($qbc as $key => $row) {
            $post[$key] = $row['art_post_id'];
         }

        array_multisort($post, SORT_DESC, $qbc);
        // echo '<pre>';
        // print_r($qbc);
        // exit;
        $otherdata = $qbc;


         if (count($otherdata) > 0) { 
             foreach ($otherdata as $row) {
                 //  echo '<pre>'; print_r($finalsorting); die();
                 $userid = $this->session->userdata('aileenuser');
         
                 $contition_array = array('art_post_id' => $row['art_post_id'], 'status' => '1');
                 $artdelete = $this->data['artdelete'] = $this->common->select_data_by_condition('art_post', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
         
                 $likeuserarray = explode(',', $artdelete[0]['delete_post']);
         
                 if (!in_array($userid, $likeuserarray)) {}else{

                    $count[] = "abc";
                 }

                  }
  } 
//echo count($otherdata); die();
  if(count($otherdata) > 0){ 
          if(count($count) == count($otherdata)){ 
        
                    $datacount = "count";


                    $notfound = '<div class="contact-frnd-post bor_none">';
                    $notfound .= '<div class="text-center rio">';
                    $notfound .= '<h4 class="page-heading  product-listing">No post Found.</h4>';
                    $notfound .= '</div></div>';
                
            } }else{ 

                    $datacount = "count";

                    $notfound = '<div class="contact-frnd-post bor_none">';
                    $notfound .= '<div class="text-center rio">';
                    $notfound .= '<h4 class="page-heading  product-listing">No post Found.</h4>';
                    $notfound .= '</div></div>';
                
            }

            echo json_encode(
                        array(
                            "notfound" => $notfound,
                            "notcount" => $datacount,
                ));

    }

//delete post particular user end  
//multiple images for user start


    public function art_photos($id = "") {


        $userid = $this->session->userdata('aileenuser');

         //if user deactive profile then redirect to artistic/index untill active profile start
         $contition_array = array('user_id'=> $userid,'status' => '0','is_delete'=> '0');

        $artistic_deactive = $this->data['artistic_deactive'] = $this->common->select_data_by_condition('art_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);

        if($artistic_deactive)
        {
             redirect('artistic/');
        }
     //if user deactive profile then redirect to artistic/index untill active profile End
        $contition_array = array('user_id' => $userid, 'status' => '1');


        if ($id == $userid || $id == '') {

            $contition_array = array('user_id' => $userid, 'status' => '1');

            $artisticdata = $this->data['artisticdata'] = $this->common->select_data_by_condition('art_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
            //  echo "<pre>"; print_r($artisticdata); die();



            $contition_array = array('image_type' => 1, 'is_deleted' => '1');

            $artistic_data = $this->data['artistic_data'] = $this->common->select_data_by_condition('post_image', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

//echo "<pre>"; print_r($this->data['artistic_data']); die();

        } else {

            $contition_array = array('user_id' => $id, 'status' => '1','art_step' => 4);


            $artisticdata = $this->data['artisticdata'] = $this->common->select_data_by_condition('art_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');



            // $join_str[0]['table'] = 'post_image';
            // $join_str[0]['join_table_id'] = 'post_image.post_id';
            // $join_str[0]['from_table_id'] = 'art_post.art_post_id';
            // $join_str[0]['join_type'] = '';


            $contition_array = array('image_type' => 1, 'is_deleted' => '1');

             $artisticdata1= $this->data['artistic_data'] = $this->common->select_data_by_condition('post_image', $contition_array, $data, $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
        }
//code search
        $contition_array = array('status' => '1', 'is_delete' => '0','art_step' => 4);


        $artdata = $this->data['results'] = $this->common->select_data_by_condition('art_reg', $contition_array, $data = 'art_name,art_lastname,designation,other_skill', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);


        $return_array = array();
        //  //echo  $return_array;

        foreach ($artdata as $get) {
            $return = array();
            $return = $get;


            $return['firstname'] = $get['art_name'] . " " . $get['art_lastname'];
            unset($return['art_name']);
            unset($return['art_lastname']);

            array_push($return_array, $return);
            //echo $returnarray; 
        }

        $contition_array = array('status' => '1', 'type' => '2');

        $artpost = $this->data['results'] = $this->common->select_data_by_condition('skill', $contition_array, $data = 'skill', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);
        // echo "<pre>"; print_r($artpost);die();


        $uni = array_merge($return_array, $artpost);
        //   echo count($unique);


        foreach ($uni as $key => $value) {
            foreach ($value as $ke => $val) {
                if ($val != "") {


                    $result[] = $val;
                }
            }
        }
        $results = array_unique($result);
        foreach ($results as $key => $value) {
            $result1[$key]['label'] = $value;
            $result1[$key]['value'] = $value;
        }

        $this->data['demo'] = array_values($result1);
             $contition_array = array('status' => '1');

       
        $cty = $this->data['cty'] = $this->common->select_data_by_condition('cities', $contition_array, $data = 'city_name', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);
           

            foreach ($cty as $key => $value) {
            foreach ($value as $ke => $val) {
                if ($val != "") {


                    $resu[] = $val;
                }
            }
        }
        $resul = array_unique($resu);
        foreach ($resul as $key => $value) {
            $res[$key]['label'] = $value;
            $res[$key]['value'] = $value;
        }
        
        $this->data['de'] = array_values($res);



        $this->load->view('artistic/art_photos', $this->data);
    }

//multiple images for user end   
//multiple videos for user start


    public function art_videos($id) {

        $userid = $this->session->userdata('aileenuser');

         //if user deactive profile then redirect to artistic/index untill active profile start
         $contition_array = array('user_id'=> $userid,'status' => '0','is_delete'=> '0');

        $artistic_deactive = $this->data['artistic_deactive'] = $this->common->select_data_by_condition('art_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);

        if($artistic_deactive)
        {
             redirect('artistic/');
        }
     //if user deactive profile then redirect to artistic/index untill active profile End
        $contition_array = array('user_id' => $userid, 'status' => '1');


        if ($id == $userid || $id == '') {

            $contition_array = array('user_id' => $userid, 'status' => '1');
            $artisticdata = $this->data['artisticdata'] = $this->common->select_data_by_condition('art_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
            //echo "<pre>"; print_r($artisticdata); die();
            $contition_array = array('user_id' => $artisticdata[0]['user_id'], 'status' => 1, 'is_delete' => '0');

            $this->data['artistic_data'] = $this->common->select_data_by_condition('art_post', $contition_array, $data, $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
        } else {

            $contition_array = array('user_id' => $id, 'status' => '1','art_step' => 4);
            $artisticdata = $this->data['artisticdata'] = $this->common->select_data_by_condition('art_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

            $contition_array = array('user_id' => $artisticdata[0]['user_id'], 'status' => 1, 'is_delete' => '0');

            $this->data['artistic_data'] = $this->common->select_data_by_condition('art_post', $contition_array, $data, $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
        }

        //code search
        $contition_array = array('status' => '1', 'is_delete' => '0','art_step' => 4);


        $artdata = $this->data['results'] = $this->common->select_data_by_condition('art_reg', $contition_array, $data = 'art_name,art_lastname,designation,other_skill', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);


        $return_array = array();
        //  //echo  $return_array;

        foreach ($artdata as $get) {
            $return = array();
            $return = $get;


            $return['firstname'] = $get['art_name'] . " " . $get['art_lastname'];
            unset($return['art_name']);
            unset($return['art_lastname']);

            array_push($return_array, $return);
            //echo $returnarray; 
        }

        $contition_array = array('status' => '1', 'type' => '2');

        $artpost = $this->data['results'] = $this->common->select_data_by_condition('skill', $contition_array, $data = 'skill', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);
        // echo "<pre>"; print_r($artpost);die();


        $uni = array_merge($return_array, $artpost);
        //   echo count($unique);


        foreach ($uni as $key => $value) {
            foreach ($value as $ke => $val) {
                if ($val != "") {


                    $result[] = $val;
                }
            }
        }
        $results = array_unique($result);
        foreach ($results as $key => $value) {
            $result1[$key]['label'] = $value;
            $result1[$key]['value'] = $value;
        }

        $this->data['demo'] = array_values($result1);
     $contition_array = array('status' => '1');

       
        $cty = $this->data['cty'] = $this->common->select_data_by_condition('cities', $contition_array, $data = 'city_name', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);
           

            foreach ($cty as $key => $value) {
            foreach ($value as $ke => $val) {
                if ($val != "") {


                    $resu[] = $val;
                }
            }
        }
        $resul = array_unique($resu);
        foreach ($resul as $key => $value) {
            $res[$key]['label'] = $value;
            $res[$key]['value'] = $value;
        }
        
        $this->data['de'] = array_values($res);



        $this->load->view('artistic/art_videos', $this->data);
    }

//multiple videos for user end 
//multiple audios for user start


    public function art_audios($id) {

        $userid = $this->session->userdata('aileenuser');

         //if user deactive profile then redirect to artistic/index untill active profile start
         $contition_array = array('user_id'=> $userid,'status' => '0','is_delete'=> '0');

        $artistic_deactive = $this->data['artistic_deactive'] = $this->common->select_data_by_condition('art_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);

        if($artistic_deactive)
        {
             redirect('artistic/');
        }
     //if user deactive profile then redirect to artistic/index untill active profile End
        $contition_array = array('user_id' => $userid, 'status' => '1');


        if ($id == $userid || $id == '') {

            $contition_array = array('user_id' => $userid, 'status' => '1');
            $artisticdata = $this->data['artisticdata'] = $this->common->select_data_by_condition('art_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
            //echo "<pre>"; print_r($artisticdata); die();
            $contition_array = array('user_id' => $artisticdata[0]['user_id'], 'status' => 1, 'is_delete' => '0');

            $this->data['artistic_data'] = $this->common->select_data_by_condition('art_post', $contition_array, $data, $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
        } else {

            $contition_array = array('user_id' => $id, 'status' => '1','art_step' => 4);
            $artisticdata = $this->data['artisticdata'] = $this->common->select_data_by_condition('art_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

            $contition_array = array('user_id' => $artisticdata[0]['user_id'], 'status' => 1, 'is_delete' => '0');

            $this->data['artistic_data'] = $this->common->select_data_by_condition('art_post', $contition_array, $data, $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
        }


        //code search
        $contition_array = array('status' => '1', 'is_delete' => '0','art_step' => 4);


        $artdata = $this->data['results'] = $this->common->select_data_by_condition('art_reg', $contition_array, $data = 'art_name,art_lastname,designation,other_skill', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);


        $return_array = array();
        //  //echo  $return_array;

        foreach ($artdata as $get) {
            $return = array();
            $return = $get;


            $return['firstname'] = $get['art_name'] . " " . $get['art_lastname'];
            unset($return['art_name']);
            unset($return['art_lastname']);

            array_push($return_array, $return);
            //echo $returnarray; 
        }

        $contition_array = array('status' => '1', 'type' => '2');

        $artpost = $this->data['results'] = $this->common->select_data_by_condition('skill', $contition_array, $data = 'skill', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);
        // echo "<pre>"; print_r($artpost);die();


        $uni = array_merge($return_array, $artpost);
        //   echo count($unique);


        foreach ($uni as $key => $value) {
            foreach ($value as $ke => $val) {
                if ($val != "") {


                    $result[] = $val;
                }
            }
        }
        $results = array_unique($result);
        foreach ($results as $key => $value) {
            $result1[$key]['label'] = $value;
            $result1[$key]['value'] = $value;
        }

        $this->data['demo'] = array_values($result1);
             $contition_array = array('status' => '1');

       
        $cty = $this->data['cty'] = $this->common->select_data_by_condition('cities', $contition_array, $data = 'city_name', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);
           

            foreach ($cty as $key => $value) {
            foreach ($value as $ke => $val) {
                if ($val != "") {


                    $resu[] = $val;
                }
            }
        }
        $resul = array_unique($resu);
        foreach ($resul as $key => $value) {
            $res[$key]['label'] = $value;
            $res[$key]['value'] = $value;
        }
        
        $this->data['de'] = array_values($res);



        $this->load->view('artistic/art_audios', $this->data);
    }

//multiple audios for user end  
//multiple pdf for user start


    public function art_pdf($id) {

        $userid = $this->session->userdata('aileenuser');

         //if user deactive profile then redirect to artistic/index untill active profile start
         $contition_array = array('user_id'=> $userid,'status' => '0','is_delete'=> '0');

        $artistic_deactive = $this->data['artistic_deactive'] = $this->common->select_data_by_condition('art_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);

        if($artistic_deactive)
        {
             redirect('artistic/');
        }
     //if user deactive profile then redirect to artistic/index untill active profile End

        $contition_array = array('user_id' => $userid, 'status' => '1');


        if ($id == $userid || $id == '') {

            $contition_array = array('user_id' => $userid, 'status' => '1');
            $artisticdata = $this->data['artisticdata'] = $this->common->select_data_by_condition('art_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
           // echo "<pre>"; print_r($artisticdata); die();
            $contition_array = array('user_id' => $artisticdata[0]['user_id'], 'status' => 1, 'is_delete' => '0');

            $this->data['artistic_data'] = $this->common->select_data_by_condition('art_post', $contition_array, $data, $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
        } else { 

            $contition_array = array('user_id' => $id, 'status' => '1','art_step' => 4);
            $artisticdata = $this->data['artisticdata'] = $this->common->select_data_by_condition('art_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

            $contition_array = array('user_id' => $artisticdata[0]['user_id'], 'status' => 1, 'is_delete' => '0');

            $this->data['artistic_data'] = $this->common->select_data_by_condition('art_post', $contition_array, $data, $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
        }
        //code search
        $contition_array = array('status' => '1', 'is_delete' => '0','art_step' => 4);


        $artdata = $this->data['results'] = $this->common->select_data_by_condition('art_reg', $contition_array, $data = 'art_name,art_lastname,designation,other_skill', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);


        $return_array = array();
        //  //echo  $return_array;

        foreach ($artdata as $get) {
            $return = array();
            $return = $get;


            $return['firstname'] = $get['art_name'] . " " . $get['art_lastname'];
            unset($return['art_name']);
            unset($return['art_lastname']);

            array_push($return_array, $return);
            //echo $returnarray; 
        }

        $contition_array = array('status' => '1', 'type' => '2');

        $artpost = $this->data['results'] = $this->common->select_data_by_condition('skill', $contition_array, $data = 'skill', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);
        // echo "<pre>"; print_r($artpost);die();


        $uni = array_merge($return_array, $artpost);
        //   echo count($unique);


        foreach ($uni as $key => $value) {
            foreach ($value as $ke => $val) {
                if ($val != "") {


                    $result[] = $val;
                }
            }
        }
        $results = array_unique($result);
        foreach ($results as $key => $value) {
            $result1[$key]['label'] = $value;
            $result1[$key]['value'] = $value;
        }

        $this->data['demo'] = array_values($result1);

     $contition_array = array('status' => '1');

       
        $cty = $this->data['cty'] = $this->common->select_data_by_condition('cities', $contition_array, $data = 'city_name', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);
           

            foreach ($cty as $key => $value) {
            foreach ($value as $ke => $val) {
                if ($val != "") {


                    $resu[] = $val;
                }
            }
        }
        $resul = array_unique($resu);
        foreach ($resul as $key => $value) {
            $res[$key]['label'] = $value;
            $res[$key]['value'] = $value;
        }
        
        $this->data['de'] = array_values($res);


        
        $this->load->view('artistic/art_pdf', $this->data);
    }

//multiple pdf for user end    
    // khyati 9-5 multiple images like start
    public function like_postimg() {
        //$id = $_POST['save_id'];
        $post_image = $_POST['post_image_id'];
        $userid = $this->session->userdata('aileenuser');

         //if user deactive profile then redirect to artistic/index untill active profile start
         $contition_array = array('user_id'=> $userid,'status' => '0','is_delete'=> '0');

        $artistic_deactive = $this->data['artistic_deactive'] = $this->common->select_data_by_condition('art_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);

        if($artistic_deactive)
        {
             redirect('artistic/');
        }
     //if user deactive profile then redirect to artistic/index untill active profile End


        $contition_array = array('post_image_id' => $post_image, 'user_id' => $userid);

        $likeuser = $this->data['likeuser'] = $this->common->select_data_by_condition('art_post_image_like', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
//echo '<pre>'; print_r($likeuser); die();
        $contition_array = array('image_id' => $post_image);

        $likeuserid = $this->data['likeuserid'] = $this->common->select_data_by_condition('post_image', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
        $contition_array = array('art_post_id' => $likeuserid[0]['post_id']);

        $likepostid = $this->data['likepostid'] = $this->common->select_data_by_condition('art_post', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');


        if (!$likeuser) { //echo 1; die();
            $data = array(
                'post_image_id' => $post_image,
                'user_id' => $userid,
                'created_date' => date('Y-m-d H:i:s', time()),
                'is_unlike' => 0
            );
//echo "<pre>"; print_r($data); die();

            $insertdata = $this->common->insert_data_getid($data, 'art_post_image_like');


            // insert notification

            if ($likepostid[0]['user_id'] == $userid) {
                
            } else {
                $data = array(
                    'not_type' => 5,
                    'not_from_id' => $userid,
                    'not_to_id' => $likepostid[0]['user_id'],
                    'not_read' => 2,
                    'not_product_id' => $post_image,
                    'not_from' => 3,
                    'not_img' => 5,
                    'not_active' => 1,
                    'not_created_date' => date('Y-m-d H:i:s')
                );

                $insert_id = $this->common->insert_data_getid($data, 'notification');
            }
            // end notoification

            $contition_array = array('post_image_id' => $_POST["post_image_id"], 'is_unlike' => '0');
            $bdata1 = $this->data['bdata1'] = $this->common->select_data_by_condition('art_post_image_like', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

            if ($insertdata) {

                $imglike = '<li>';
                $imglike .= '<a id="' . $post_image . '" class="ripple like_h_w" onClick="post_likeimg(this.id)">';
                $imglike .= ' <i class="fa fa-thumbs-up" aria-hidden="true">';
                $imglike .= '</i>';
                $imglike .= '<span id="popup"> ';
                if (count($bdata1) > 0) {
                    $imglike .= count($bdata1) . '';
                }
                $imglike .= '</span>';
                $imglike .= '</a>';
                $imglike .= '</li>';

                echo $imglike;
            }
        } else {

            if ($likeuser[0]['is_unlike'] == 0) {

                $data = array(
                    'modify_date' => date('Y-m-d', time()),
                    'is_unlike' => 1
                );


                $updatdata = $this->common->update_data($data, 'art_post_image_like', 'post_image_like_id', $likeuser[0]['post_image_like_id']);

                $contition_array = array('post_image_id' => $_POST["post_image_id"], 'is_unlike' => '0');
                $bdata2 = $this->data['bdata2'] = $this->common->select_data_by_condition('art_post_image_like', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');



                if ($updatdata) {

                    $imglike1 = '<li>';
                    $imglike1 .= '<a id="' . $post_image . '" class="ripple like_h_w" onClick="post_likeimg(this.id)">';
                    $imglike1 .= '<i class="fa fa-thumbs-up fa-1x" aria-hidden="true">';
                    $imglike1 .= '</i>';
                    $imglike1 .= '<span id="popup">';
                    if (count($bdata2) > 0) {
                        $imglike1 .= count($bdata2) . '';
                    }
                    $imglike1 .= '</span>';
                    $imglike1 .= '</a>';
                    $imglike1 .= '</li>';

                    //10-5 user list start

                    $contition_array = array('post_image_id' => $post_image, 'is_unlike' => '0');
                    $commnetcount = $this->common->select_data_by_condition('art_post_image_like', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

                    foreach ($commnetcount as $comment) {
                        $art_fname1 = $this->db->get_where('art_reg', array('user_id' => $comment['user_id'], 'status' => 1))->row()->art_name;
                        $art_lname1 = $this->db->get_where('art_reg', array('user_id' => $comment['user_id'], 'status' => 1))->row()->art_lastname;
                    }
                       $cmtlikeuser .= '<div class="like_one_other">';

                 
                    $cmtlikeuser .= '<a href="javascript:void(0);"  onclick="likeuserlistimg(' . $post_image . ')">';

                    $contition_array = array('post_image_id' => $post_image, 'is_unlike' => '0');
                    $commnetcount = $this->common->select_data_by_condition('art_post_image_like', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');


                    $art_fname = $this->db->get_where('art_reg', array('user_id' => $commnetcount[0]['user_id'], 'status' => 1))->row()->art_name;
                    $art_lname = $this->db->get_where('art_reg', array('user_id' => $commnetcount[0]['user_id'], 'status' => 1))->row()->art_lastname;

                    if ($userid == $commnetcount[0]['user_id']) {

                        $cmtlikeuser .= 'You &nbsp';
                    } else {
                        $cmtlikeuser .= '' . ucwords($art_fname) . '';
                        $cmtlikeuser .= '&nbsp;';
                        $cmtlikeuser .= '' . ucwords($art_lname) . '';
                        $cmtlikeuser .= '&nbsp;';
                    }
                    if (count($commnetcount) > 1) {
                        $cmtlikeuser .= 'and ';
                        $cmtlikeuser .= '' . count($commnetcount) - 1 . '';
                        $cmtlikeuser .= '&nbsp;';
                        $cmtlikeuser .= 'others';
                    }
                    
                    

                   
                    $cmtlikeuser .= '</a>';
                     $cmtlikeuser .= '</div>';
                     $like_user_count =  '<span class="comment_like_count">'; 
               if (count($commnetcount) > 0) { 
              $like_user_count .= '' . count($commnetcount) . ''; 
              $like_user_count .=     '</span>'; 
              $like_user_count .= '<span> Like</span>';
               }
              
              
                    //    echo "123456789"; die();           
                //    $like_user_count = count($commnetcount);
                    echo json_encode(
                            array("like" => $imglike1,
                                "likeuser" => $cmtlikeuser,
                                "like_user_count" => $like_user_count));
                    //10-5 user list end               
                    // echo $imglike1;
                }
            } else {

                $data = array(
                    'modify_date' => date('Y-m-d', time()),
                    'is_unlike' => 0
                );


                $updatdata = $this->common->update_data($data, 'art_post_image_like', 'post_image_id', $post_image);


                // insert notification

                if ($likepostid[0]['user_id'] == $userid) {
                    
                } else {


                    $contition_array = array('not_type' => 5, 'not_from_id' => $userid, 'not_to_id' => $likepostid[0]['user_id'], 'not_product_id' => $post_image_id, 'not_from' => 3, 'not_img' => 5);
                    $artnotification = $this->common->select_data_by_condition('notification', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
                    if ($artnotification[0]['not_read'] == 2) {
                        
                    } elseif ($artnotification[0]['not_read'] == 1) {

                        $datalike = array(
                            'not_read' => 2
                        );

                        $where = array('not_type' => 5, 'not_from_id' => $userid, 'not_to_id' => $likepostid[0]['user_id'], 'not_product_id' => $post_image_id, 'not_from' => 3, 'not_img' => 5);
                        $this->db->where($where);
                        $updatdata = $this->db->update('notification', $datalike);
                    } else {


                        $data = array(
                            'not_type' => 5,
                            'not_from_id' => $userid,
                            'not_to_id' => $likepostid[0]['user_id'],
                            'not_read' => 2,
                            'not_product_id' => $post_image,
                            'not_from' => 3,
                            'not_img' => 5,
                            'not_active' => 1,
                            'not_created_date' => date('Y-m-d H:i:s')
                        );

                        $insert_id = $this->common->insert_data_getid($data, 'notification');
                    }
                }
                // end notoification


                $contition_array = array('post_image_id' => $_POST["post_image_id"], 'is_unlike' => '0');
                $bdata2 = $this->data['bdata2'] = $this->common->select_data_by_condition('art_post_image_like', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');



                if ($updatdata) {

                    $imglike1 = '<li>';
                    $imglike1 .= '<a id="' . $post_image . '" class="ripple like_h_w" onClick="post_likeimg(this.id)">';
                    $imglike1 .= '<i class="fa fa-thumbs-up main_color" aria-hidden="true">';
                    $imglike1 .= '</i>';
                    $imglike1 .= '<span  id="popup"> ';
                    if (count($bdata2) > 0) {
                        $imglike1 .= count($bdata2) . '';
                    }
                    $imglike1 .= '</span>';
                    $imglike1 .= '</a>';
                    $imglike1 .= '</li>';

                    //10-5 user list start

                    $contition_array = array('post_image_id' => $post_image, 'is_unlike' => '0');
                    $commnetcount = $this->common->select_data_by_condition('art_post_image_like', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
                    //       echo '<pre>'; print_r($commnetcount); die();                                     
                    foreach ($commnetcount as $comment) {
                        $art_fname1 = $this->db->get_where('art_reg', array('user_id' => $comment['user_id'], 'status' => 1))->row()->art_name;
                        $art_lname1 = $this->db->get_where('art_reg', array('user_id' => $comment['user_id'], 'status' => 1))->row()->art_lastname;
                    }
      $cmtlikeuser .= '<div class="like_one_other">';

                    $cmtlikeuser .= '<a href="javascript:void(0);"  onclick="likeuserlistimg(' . $post_image . ')">';

                    $contition_array = array('post_image_id' => $post_image, 'is_unlike' => '0');
                    $commnetcount = $this->common->select_data_by_condition('art_post_image_like', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
                    //echo "hehehe";   echo '<pre>'; echo count($commnetcount); print_r($commnetcount); die();         
                    $art_fname = $this->db->get_where('art_reg', array('user_id' => $commnetcount[0]['user_id'], 'status' => 1))->row()->art_name;
                    $art_lname = $this->db->get_where('art_reg', array('user_id' => $commnetcount[0]['user_id'], 'status' => 1))->row()->art_lastname;

              
                    if ($userid == $commnetcount[0]['user_id']) {
                        $cmtlikeuser .= 'You &nbsp';
                    } else {
                        $cmtlikeuser .= '' . ucwords($art_fname) . '';
                        $cmtlikeuser .= '&nbsp;';
                        $cmtlikeuser .= '' . ucwords($art_lname) . '';
                        $cmtlikeuser .= '&nbsp;';
                    }
                    if (count($commnetcount) > 1) {
                        $cmtlikeuser .= 'and ';
                        $cmtlikeuser .= '' . count($commnetcount) - 1 . '';
                        $cmtlikeuser .= '&nbsp;';
                        $cmtlikeuser .= 'others';
                    }

                   
                    $cmtlikeuser .= '</a>';
                     $cmtlikeuser .= '</div>';
                    //  echo $cmtlikeuser; die();  
               $like_user_count =  '<span class="comment_like_count">'; 
               if (count($commnetcount) > 0) { 
              $like_user_count .= '' . count($commnetcount) . ''; 
              $like_user_count .=     '</span>'; 
              $like_user_count .= '<span> Like</span>';
               }
              
                   // $like_user_count = count($commnetcount);
                    echo json_encode(
                            array("like" => $imglike1,
                                "likeuser" => $cmtlikeuser,
                                "like_user_count" => $like_user_count));
                    //10-5 user list end
                    //    echo $imglike1;
                }
            }
        }
    }

//multiple iamges like end 
//multiple 9-5 images comment strat

    public function insert_commentthreeimg() {

        $userid = $this->session->userdata('aileenuser');

         //if user deactive profile then redirect to artistic/index untill active profile start
         $contition_array = array('user_id'=> $userid,'status' => '0','is_delete'=> '0');

        $artistic_deactive = $this->data['artistic_deactive'] = $this->common->select_data_by_condition('art_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);

        if($artistic_deactive)
        {
             redirect('artistic/');
        }
     //if user deactive profile then redirect to artistic/index untill active profile End

        $post_image_id = $_POST["post_image_id"];
        $post_comment = $_POST["comment"];


        //$contition_array = array('post_image_id' => $_POST["post_image_id"], 'is_unlike' => '0');
        $contition_array = array('image_id' => $_POST["post_image_id"], 'is_deleted' => '1');
        $artimg = $this->data['artimg'] = $this->common->select_data_by_condition('post_image', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        $contition_array = array('art_post_id' => $artimg[0]["post_id"], 'is_delete' => 0);
        $artpostid = $this->data['artpostid'] = $this->common->select_data_by_condition('art_post', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        //echo "<pre>"; print_r($artpostid); die();

        $data = array(
            'user_id' => $userid,
            'post_image_id' => $post_image_id,
            'comment' => $post_comment,
            'created_date' => date('Y-m-d H:i:s', time()),
            'is_delete' => 0
        );
        $insert_id = $this->common->insert_data_getid($data, 'art_post_image_comment');

        // insert notification

        if ($artpostid[0]['user_id'] == $userid) {
            
        } else {
            $datanotification = array(
                'not_type' => 6,
                'not_from_id' => $userid,
                'not_to_id' => $artpostid[0]['user_id'],
                'not_read' => 2,
                'not_product_id' => $insert_id,
                'not_from' => 3,
                'not_img' => 4,
                'not_active' => 1,
                'not_created_date' => date('Y-m-d H:i:s')
            );
            //echo "<pre>"; print_r($datanotification); die();
            $insert_id_notification = $this->common->insert_data_getid($datanotification, 'notification');
        }
        // end notoification

        $contition_array = array('post_image_id' => $post_image_id, 'is_delete' => '0');
        $artcomment = $this->common->select_data_by_condition('art_post_image_comment', $contition_array, $data = '*', $sortby = 'post_image_comment_id', $orderby = 'DESC', $limit = '1', $offset = '', $join_str = array(), $groupby = '');

        // count of artcomment

        $contition_array = array('post_image_id' => $post_image_id, 'is_delete' => '0');
        $artcont = $this->common->select_data_by_condition('art_post_image_comment', $contition_array, $data = '*', $sortby = 'post_image_comment_id', $orderby = 'DESC', $limit = '', $offset = '', $join_str = array(), $groupby = '');


        // echo "<pre>"; print_r($artcont); die();
        foreach ($artcomment as $art_comment) {


            $art_name = $this->db->get_where('art_reg', array('user_id' => $art_comment['user_id']))->row()->art_name;

            $art_userimage = $this->db->get_where('art_reg', array('user_id' => $art_comment['user_id'], 'status' => 1))->row()->art_user_image;

            $cmtinsert = '<div class="all-comment-comment-box">';
            $cmtinsert .= '<a href="' . base_url('artistic/art_manage_post/' . $art_comment['user_id'] . '') . '">';
            $cmtinsert .= '<div class="post-design-pro-comment-img">';
            $cmtinsert .= '<img  src="' . base_url($this->config->item('art_profile_thumb_upload_path') . $art_userimage) . '" alt="">  </div>';
            $cmtinsert .= '<div class="comment-name"><b>' . $art_name . '</b>';
            $cmtinsert .= '</div>';
            $cmtinsert .= '</a>';

            $cmtinsert .= '<div class="comment-details" id= "showcommentimg' . $art_comment['post_image_comment_id'] . '"" >';
            $cmtinsert .= $this->common->make_links($art_comment['comment']);
            $cmtinsert .= '</div>';
            $cmtinsert .= '<div contenteditable="true" class="editable_text" name="' . $art_comment['post_image_comment_id'] . '" id="editcommentimg' . $art_comment['post_image_comment_id'] . '"style="display:none;" onkeyup="commenteditimg(' . $art_comment['post_image_comment_id'] . ')" onpaste="OnPaste_StripFormatting(this, event);">';

            $cmtinsert .= '' . $art_comment['comment'] . '';
            $cmtinsert .= '</div>';

            $cmtinsert .= '<button id="editsubmitimg' . $art_comment['post_image_comment_id'] . '" style="display:none;" onClick="edit_commentimg(' . $art_comment['post_image_comment_id'] . ')">Comment</button><div class="art-comment-menu-design"> <div class="comment-details-menu" id="likecommentimg' . $art_comment['post_image_comment_id'] . '">';

            $cmtinsert .= '<a id="' . $art_comment['post_image_comment_id'] . '"';
            $cmtinsert .= 'onClick="comment_likeimg(this.id)">';

            $contition_array = array('post_image_comment_id' => $art_comment['post_image_comment_id'], 'user_id' => $userid, 'is_unlike' => 0);

            $artcommentlike1 = $this->common->select_data_by_condition('art_comment_image_like', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

            if (count($artcommentlike1) == 0) {
                $cmtinsert .= '<i class="fa fa-thumbs-up fa-1x" aria-hidden="true"></i>';
            } else {

                $cmtinsert .= '<i class="fa fa-thumbs-up" aria-hidden="true"></i>';
            }

            $cmtinsert .= '<span> ';

            $contition_array = array('post_image_comment_id' => $art_comment['post_image_comment_id'], 'is_unlike' => '0');
            $mulcountlike = $this->data['mulcountlike'] = $this->common->select_data_by_condition('art_comment_image_like', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');


            if (count($mulcountlike) > 0) {
                //echo count($mulcountlike); 
            }
            $cmtinsert .= '</span>';
            $cmtinsert .= '</a></div>';

            $userid = $this->session->userdata('aileenuser');
            if ($art_comment['user_id'] == $userid) {

                $cmtinsert .= '<span role="presentation" aria-hidden="true"> · </span>';
                $cmtinsert .= '<div class="comment-details-menu">';


                $cmtinsert .= '<div id="editcommentboximg' . $art_comment['post_image_comment_id'] . '"style="display:block;">';

                $cmtinsert .= '<a id="' . $art_comment['post_image_comment_id'] . '"';
                $cmtinsert .= 'onClick="comment_editboximg(this.id)">';
                $cmtinsert .= 'Edit';
                $cmtinsert .= '</a></div>';

                $cmtinsert .= '<div id="editcancleimg' . $art_comment['post_image_comment_id'] . '"style="display:none;">';

                $cmtinsert .= '<a id="' . $art_comment['post_image_comment_id'] . '"';
                $cmtinsert .= 'onClick="comment_editcancleimg(this.id)">';
                $cmtinsert .= 'Cancel';
                $cmtinsert .= '</a></div>';

                $cmtinsert .= '</div>';
            }
            $userid = $this->session->userdata('aileenuser');


            $userid = $this->session->userdata('aileenuser');

            $art_userid = $this->db->get_where('art_post', array('art_post_id' => $art_comment['post_image_id'], 'status' => 1))->row()->user_id;


            if ($art_comment['user_id'] == $userid || $art_userid == $userid) {


                $cmtinsert .= '<span role="presentation" aria-hidden="true"> · </span>';
                $cmtinsert .= '<div class="comment-details-menu">';


                $cmtinsert .= '<input type="hidden" name="post_deleteimg"';
                // $cmtinsert .= 'id="post_deleteimg' . $art_comment['post_image_comment_id'] . '"';
                $cmtinsert .= 'id="post_deleteimg"';
                $cmtinsert .= 'value= "' . $art_comment['post_image_id'] . '">';
                $cmtinsert .= '<a id="' . $art_comment['post_image_comment_id'] . '"';
                $cmtinsert .= 'onClick="comment_deleteimg(this.id)">';
                $cmtinsert .= 'Delete';
                $cmtinsert .= '</a></div>';
            }

            $cmtinsert .= '<span role="presentation" aria-hidden="true"> · </span>';
            $cmtinsert .= '<div class="comment-details-menu">';
            $cmtinsert .= '<p>' . $this->common->time_elapsed_string(date('Y-m-d H:i:s', strtotime($art_comment['created_date']))) . '</p></div></div></div>';


            if (count($artcont) > 1) {
                // comment aount variable start
                $cmtcount = '<a onClick="commentallimg(this.id)" id="' . $post_image_id . '">';
                $cmtcount .= '<i class="fa fa-comment-o" aria-hidden="true">';
                $cmtcount .= ' ' . count($artcont) . '';
                $cmtcount .= '</i></a>';
            }
            // comment count variable end 
            
             $cntinsert =  '<span class="comment_count" >';
     if (count($artcont) > 0) {
           $cntinsert .= '' . count($artcont) . ''; 
           $cntinsert .=   '</span>'; 
           $cntinsert .=  '<span> Comment</span>';
        
           }
        }
        //   echo $cmtinsert;
        echo json_encode(
                array("comment" => $cmtinsert,
                    "count" => $cmtcount,
                    "commentcount" => $cntinsert));
    }

    public function mulimg_comment() {

        $userid = $this->session->userdata('aileenuser');

         //if user deactive profile then redirect to artistic/index untill active profile start
         $contition_array = array('user_id'=> $userid,'status' => '0','is_delete'=> '0');

        $artistic_deactive = $this->data['artistic_deactive'] = $this->common->select_data_by_condition('art_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);

        if($artistic_deactive)
        {
             redirect('artistic/');
        }
     //if user deactive profile then redirect to artistic/index untill active profile End

        $post_image_id = $_POST["post_image_id"];
        $post_comment = $_POST["comment"];


        $contition_array = array('image_id' => $_POST["post_image_id"], 'is_deleted' => '1');
        $artimg = $this->data['artimg'] = $this->common->select_data_by_condition('post_image', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        $contition_array = array('art_post_id' => $artimg[0]["post_id"], 'is_delete' => 0);
        $artpostid = $this->data['artpostid'] = $this->common->select_data_by_condition('art_post', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');


        $data = array(
            'user_id' => $userid,
            'post_image_id' => $post_image_id,
            'comment' => $post_comment,
            'created_date' => date('Y-m-d H:i:s', time()),
            'is_delete' => 0
        );
        $insert_id = $this->common->insert_data_getid($data, 'art_post_image_comment');

        // insert notification

        if ($artpostid[0]['user_id'] == $userid) {
            
        } else {
            $datanotification = array(
                'not_type' => 6,
                'not_from_id' => $userid,
                'not_to_id' => $artpostid[0]['user_id'],
                'not_read' => 2,
                'not_product_id' => $insert_id,
                'not_from' => 3,
                'not_img' => 4,
                'not_active' => 1,
                'not_created_date' => date('Y-m-d H:i:s')
            );

            $insert_id_notification = $this->common->insert_data_getid($datanotification, 'notification');
        }
        // end notoification

        $contition_array = array('post_image_id' => $post_image_id, 'is_delete' => '0');
        $artcomment = $this->common->select_data_by_condition('art_post_image_comment', $contition_array, $data = '*', $sortby = 'post_image_comment_id', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');


        foreach ($artcomment as $art_comment) {


            $art_name = $this->db->get_where('art_reg', array('user_id' => $art_comment['user_id']))->row()->art_name;

            $art_userimage = $this->db->get_where('art_reg', array('user_id' => $art_comment['user_id'], 'status' => 1))->row()->art_user_image;

            $cmtinsert .= '<div class="all-comment-comment-box">';
            $cmtinsert .= '<a href="' . base_url('artistic/art_manage_post/' . $art_comment['user_id'] . '') . '">';
            $cmtinsert .= '<div class="post-design-pro-comment-img">';
            $cmtinsert .= '<img  src="' . base_url($this->config->item('art_profile_thumb_upload_path') . $art_userimage) . '" alt="">  </div>';
            $cmtinsert .= '<div class="comment-name"><b>' . $art_name . '</b>';
            $cmtinsert .= '</div>';
            $cmtinsert .= '</a>';

            $cmtinsert .= '<div class="comment-details" id= "showcommenttwo' . $art_comment['post_image_comment_id'] . '"" >';
            $cmtinsert .= $this->common->make_links($art_comment['comment']);
            $cmtinsert .= '</div>';
            $cmtinsert .= '<div contenteditable="true"   class="editable_text" name="' . $art_comment['post_image_comment_id'] . '" id="editcommenttwo' . $art_comment['post_image_comment_id'] . '"style="display:none;" onkeyup="commentedittwo(' . $art_comment['post_image_comment_id'] . ')" onpaste="OnPaste_StripFormatting(this, event);">';

            $cmtinsert .= '' . $art_comment['comment'] . '';
            $cmtinsert .= '</div>';

            $cmtinsert .= '<button id="editsubmittwo' . $art_comment['post_image_comment_id'] . '" style="display:none;" onClick="edit_commenttwo(' . $art_comment['post_image_comment_id'] . ')">Comment</button><div class="art-comment-menu-design"> <div class="comment-details-menu" id="likecommentone' . $art_comment['post_image_comment_id'] . '">';

            $cmtinsert .= '<a id="' . $art_comment['post_image_comment_id'] . '"';
            $cmtinsert .= 'onClick="comment_liketwo(this.id)">';

            $contition_array = array('post_image_comment_id' => $art_comment['post_image_comment_id'], 'user_id' => $userid, 'is_unlike' => 0);

            $artcommentlike1 = $this->common->select_data_by_condition('art_comment_image_like', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

            if (count($artcommentlike1) == 0) {
                $cmtinsert .= '<i class="fa fa-thumbs-up fa-1x" aria-hidden="true"></i>';
            } else {

                $cmtinsert .= '<i class="fa fa-thumbs-up" aria-hidden="true"></i>';
            }

            $cmtinsert .= '<span> ';

            $contition_array = array('post_image_comment_id' => $art_comment['post_image_comment_id'], 'is_unlike' => '0');
            $mulcountlike = $this->data['mulcountlike'] = $this->common->select_data_by_condition('art_comment_image_like', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');


            if (count($mulcountlike) > 0) {
                $cmtinsert .= '' . count($mulcountlikeuser) . '';
            }
            $cmtinsert .= '</span>';
            $cmtinsert .= '</a></div>';

            $userid = $this->session->userdata('aileenuser');
            if ($art_comment['user_id'] == $userid) {

                $cmtinsert .= '<span role="presentation" aria-hidden="true"> · </span>';
                $cmtinsert .= '<div class="comment-details-menu">';


                $cmtinsert .= '<div id="editcommentboxtwo' . $art_comment['post_image_comment_id'] . '"style="display:block;">';

                $cmtinsert .= '<a id="' . $art_comment['post_image_comment_id'] . '"';
                $cmtinsert .= 'onClick="comment_editboxtwo(this.id)">';
                $cmtinsert .= 'Edit';
                $cmtinsert .= '</a></div>';

                $cmtinsert .= '<div id="editcancletwo' . $art_comment['post_image_comment_id'] . '"style="display:none;">';

                $cmtinsert .= '<a id="' . $art_comment['post_image_comment_id'] . '"';
                $cmtinsert .= 'onClick="comment_editcancletwo(this.id)">';
                $cmtinsert .= 'Cancel';
                $cmtinsert .= '</a></div>';

                $cmtinsert .= '</div>';
            }
            $userid = $this->session->userdata('aileenuser');


            $userid = $this->session->userdata('aileenuser');

            $art_userid = $this->db->get_where('art_post', array('art_post_id' => $art_comment['post_image_id'], 'status' => 1))->row()->user_id;


            if ($art_comment['user_id'] == $userid || $art_userid == $userid) {


                $cmtinsert .= '<span role="presentation" aria-hidden="true"> · </span>';
                $cmtinsert .= '<div class="comment-details-menu">';


                $cmtinsert .= '<input type="hidden" name="post_deletetwo"';
                $cmtinsert .= 'id="post_deletetwo' . $art_comment['post_image_comment_id'] . '"';
                $cmtinsert .= 'value= "' . $art_comment['post_image_id'] . '">';
                $cmtinsert .= '<a id="' . $art_comment['post_image_comment_id'] . '"';
                $cmtinsert .= 'onClick="comment_deletetwo(this.id)">';
                $cmtinsert .= 'Delete';
                $cmtinsert .= '</a></div>';
            }

            $cmtinsert .= '<span role="presentation" aria-hidden="true"> · </span>';
            $cmtinsert .= '<div class="comment-details-menu">';
            $cmtinsert .= '<p>' . $this->common->time_elapsed_string(date('Y-m-d H:i:s', strtotime($art_comment['created_date']))) . '</p></div></div></div>';
        }
        echo $cmtinsert;
    }

//multiple images comment end 
//multiple 9-5 images comment like start
    public function like_commentimg1() {

        $userid = $this->session->userdata('aileenuser');

         //if user deactive profile then redirect to artistic/index untill active profile start
         $contition_array = array('user_id'=> $userid,'status' => '0','is_delete'=> '0');

        $artistic_deactive = $this->data['artistic_deactive'] = $this->common->select_data_by_condition('art_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);

        if($artistic_deactive)
        {
             redirect('artistic/');
        }
     //if user deactive profile then redirect to artistic/index untill active profile End
        $post_image_comment_id = $_POST["post_image_comment_id"];

        $contition_array = array('post_image_comment_id' => $post_image_comment_id, 'user_id' => $userid);

        $likecommentuser = $this->data['likecommentuser'] = $this->common->select_data_by_condition('art_comment_image_like', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');


        $contition_array = array('post_image_comment_id' => $post_image_comment_id);
        $artimglike = $this->data['artimglike'] = $this->common->select_data_by_condition('art_post_image_comment', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        $contition_array = array('image_id' => $artimglike[0]['post_image_id'], 'image_type' => '1');
        $artlikeimg = $this->data['artlikeimg'] = $this->common->select_data_by_condition('post_image', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        $contition_array = array('art_post_id' => $artlikeimg[0]["post_id"]);
        $artimglikepost = $this->data['artimglikepost'] = $this->common->select_data_by_condition('art_post', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        //echo "<pre>"; print_r($artimglikepost); die();

        if (!$likecommentuser) {

            $data = array(
                'post_image_comment_id' => $post_image_comment_id,
                'user_id' => $userid,
                'created_date' => date('Y-m-d H:i:s', time()),
                'is_unlike' => 0
            );
//echo "<pre>"; print_r($data); die();

            $insertdata = $this->common->insert_data_getid($data, 'art_comment_image_like');


            // insert notification

            if ($artimglike[0]['user_id'] == $userid) {
                
            } else {
                $data = array(
                    'not_type' => 5,
                    'not_from_id' => $userid,
                    'not_to_id' => $artimglike[0]['user_id'],
                    'not_read' => 2,
                    'not_product_id' => $post_image_comment_id,
                    'not_from' => 3,
                    'not_img' => 6,
                    'not_active' => 1,
                    'not_created_date' => date('Y-m-d H:i:s')
                );
                //echo "<pre>"; print_r($data); die();
                $insert_id = $this->common->insert_data_getid($data, 'notification');
            }
            // end notoification


            $contition_array = array('post_image_comment_id' => $_POST["post_image_comment_id"], 'is_unlike' => '0');
            $adatacm = $this->data['adatacm'] = $this->common->select_data_by_condition('art_comment_image_like', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

            if ($insertdata) {


                $imglike .= '<a id="' . $post_image_comment_id . '" onClick="comment_likeimg(this.id)">';
                $imglike .= ' <i class="fa fa-thumbs-up" aria-hidden="true">';
                $imglike .= '</i>';
                $imglike .= '<span> ';
                if (count($adatacm) > 0) {
                    $imglike .= count($adatacm) . '';
                }
                $imglike .= '</span>';
                $imglike .= '</a>';


                echo $imglike;
            }
        } else {

            if ($likecommentuser[0]['is_unlike'] == 0) {

                $data = array(
                    'modify_date' => date('Y-m-d', time()),
                    'is_unlike' => 1
                );


                $where = array('post_image_comment_id' => $post_image_comment_id, 'user_id' => $userid);
                $this->db->where($where);
                $updatdata = $this->db->update('art_comment_image_like ', $data);

                $contition_array = array('post_image_comment_id' => $post_image_comment_id, 'is_unlike' => '0');
                $cdata2 = $this->data['adata2'] = $this->common->select_data_by_condition('art_comment_image_like', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');



                if ($updatdata) {



                    $imglike1 .= '<a id="' . $post_image_comment_id . '" onClick="comment_likeimg(this.id)">';
                    $imglike1 .= '<i class="fa fa-thumbs-up fa-1x" aria-hidden="true">';
                    $imglike1 .= '</i>';
                    $imglike1 .= '<span>';
                    if (count($cdata2) > 0) {
                        $imglike1 .= count($cdata2) . '';
                    }
                    $imglike1 .= '</span>';
                    $imglike1 .= '</a>';


                    echo $imglike1;
                }
            } else {

                $data = array(
                    'modify_date' => date('Y-m-d', time()),
                    'is_unlike' => 0
                );


                //$updatdata = $this->common->update_data($data, 'art_comment_image_like', 'post_image_comment_id', $post_image_comment_id);
                $where = array('post_image_comment_id' => $post_image_comment_id, 'user_id' => $userid);
                $this->db->where($where);
                $updatdata = $this->db->update('art_comment_image_like ', $data);

                // insert notification

                if ($artimglike[0]['user_id'] == $userid) {
                    
                } else {

                    $contition_array = array('not_type' => 5, 'not_from_id' => $userid, 'not_to_id' => $artimglike[0]['user_id'], 'not_product_id' => $post_image_comment_id, 'not_from' => 3, 'not_img' => 6);
                    $artnotification = $this->common->select_data_by_condition('notification', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
                    if ($artnotification[0]['not_read'] == 2) {
                        
                    } elseif ($artnotification[0]['not_read'] == 1) {

                        $datalike = array(
                            'not_read' => 2
                        );

                        $where = array('not_type' => 5, 'not_from_id' => $userid, 'not_to_id' => $artimglike[0]['user_id'], 'not_product_id' => $post_image_comment_id, 'not_from' => 3, 'not_img' => 6);
                        $this->db->where($where);
                        $updatdata = $this->db->update('notification', $datalike);
                    } else {
                        $data = array(
                            'not_type' => 5,
                            'not_from_id' => $userid,
                            'not_to_id' => $artimglike[0]['user_id'],
                            'not_read' => 2,
                            'not_product_id' => $post_image_comment_id,
                            'not_from' => 3,
                            'not_img' => 6,
                            'not_active' => 1,
                            'not_created_date' => date('Y-m-d H:i:s')
                        );
                        //echo "<pre>"; print_r($data); die();
                        $insert_id = $this->common->insert_data_getid($data, 'notification');
                    }
                }
                // end notoification



                $contition_array = array('post_image_comment_id' => $_POST["post_image_comment_id"], 'is_unlike' => '0');
                $bdata2 = $this->data['bdata2'] = $this->common->select_data_by_condition('art_comment_image_like', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');



                if ($updatdata) {


                    $imglike1 .= '<a id="' . $post_image_comment_id . '" onClick="comment_likeimg(this.id)">';
                    $imglike1 .= '<i class="fa fa-thumbs-up" aria-hidden="true">';
                    $imglike1 .= '</i>';
                    $imglike1 .= '<span> ';
                    if (count($bdata2) > 0) {
                        $imglike1 .= count($bdata2) . '';
                    }
                    $imglike1 .= '</span>';
                    $imglike1 .= '</a>';


                    echo $imglike1;
                }
            }
        }
    }

    public function mulimg_comment_like1() {

        $userid = $this->session->userdata('aileenuser');

         //if user deactive profile then redirect to artistic/index untill active profile start
         $contition_array = array('user_id'=> $userid,'status' => '0','is_delete'=> '0');

        $artistic_deactive = $this->data['artistic_deactive'] = $this->common->select_data_by_condition('art_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);

        if($artistic_deactive)
        {
             redirect('artistic/');
        }
     //if user deactive profile then redirect to artistic/index untill active profile End

        $post_image_comment_id = $_POST["post_image_comment_id"];

        $contition_array = array('post_image_comment_id' => $post_image_comment_id, 'user_id' => $userid);

        $likecommentuser = $this->data['likecommentuser'] = $this->common->select_data_by_condition('art_comment_image_like', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        $contition_array = array('post_image_comment_id' => $post_image_comment_id);
        $artimglike = $this->data['artimglike'] = $this->common->select_data_by_condition('art_post_image_comment', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        $contition_array = array('image_id' => $artimglike[0]['post_image_id'], 'image_type' => '1');
        $artlikeimg = $this->data['artlikeimg'] = $this->common->select_data_by_condition('post_image', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        $contition_array = array('art_post_id' => $artlikeimg[0]["post_id"]);
        $artimglikepost = $this->data['artimglikepost'] = $this->common->select_data_by_condition('art_post', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');


        if (!$likecommentuser) {

            $data = array(
                'post_image_comment_id' => $post_image_comment_id,
                'user_id' => $userid,
                'created_date' => date('Y-m-d H:i:s', time()),
                'is_unlike' => 0
            );
//echo "<pre>"; print_r($data); die();

            $insertdata = $this->common->insert_data_getid($data, 'art_comment_image_like');


            // insert notification

            if ($artimglike[0]['user_id'] == $userid) {
                
            } else {
                $data = array(
                    'not_type' => 5,
                    'not_from_id' => $userid,
                    'not_to_id' => $artimglike[0]['user_id'],
                    'not_read' => 2,
                    'not_product_id' => $insertdata,
                    'not_from' => 3,
                    'not_img' => 6,
                    'not_active' => 1,
                    'not_created_date' => date('Y-m-d H:i:s')
                );
                //echo "<pre>"; print_r($data); die();
                $insert_id = $this->common->insert_data_getid($data, 'notification');
            }
            // end notoification

            $contition_array = array('post_image_comment_id' => $_POST["post_image_comment_id"], 'is_unlike' => '0');
            $bdatacm = $this->data['bdatacm'] = $this->common->select_data_by_condition('art_comment_image_like', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

            if ($insertdata) {


                $imglike .= '<a id="' . $post_image_comment_id . '" onClick="comment_liketwo(this.id)">';
                $imglike .= ' <i class="fa fa-thumbs-up" aria-hidden="true">';
                $imglike .= '</i>';
                $imglike .= '<span> ';
                if (count($bdatacm) > 0) {
                    $imglike .= count($bdatacm) . '';
                }
                $imglike .= '</span>';
                $imglike .= '</a>';


                echo $imglike;
            }
        } else {

            if ($likecommentuser[0]['is_unlike'] == 0) {

                $data = array(
                    'modify_date' => date('Y-m-d', time()),
                    'is_unlike' => 1
                );


                $where = array('post_image_comment_id' => $post_image_comment_id, 'user_id' => $userid);
                $this->db->where($where);
                $updatdata = $this->db->update('art_comment_image_like ', $data);

                $contition_array = array('post_image_comment_id' => $post_image_comment_id, 'is_unlike' => '0');
                $bdata2 = $this->data['bdata2'] = $this->common->select_data_by_condition('art_comment_image_like', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');



                if ($updatdata) {


                    $imglike1 .= '<a id="' . $post_image_comment_id . '" onClick="comment_liketwo(this.id)">';
                    $imglike1 .= '<i class="fa fa-thumbs-up fa-1x" aria-hidden="true">';
                    $imglike1 .= '</i>';
                    $imglike1 .= '<span>';
                    if (count($bdata2) > 0) {
                        $imglike1 .= count($bdata2) . '';
                    }
                    $imglike1 .= '</span>';
                    $imglike1 .= '</a>';


                    echo $imglike1;
                }
            } else {

                $data = array(
                    'modify_date' => date('Y-m-d', time()),
                    'is_unlike' => 0
                );


                $where = array('post_image_comment_id' => $post_image_comment_id, 'user_id' => $userid);
                $this->db->where($where);
                $updatdata = $this->db->update('art_comment_image_like ', $data);


                // insert notification

                if ($artimglike[0]['user_id'] == $userid) {
                    
                } else {

                    $contition_array = array('not_type' => 5, 'not_from_id' => $userid, 'not_to_id' => $artimglike[0]['user_id'], 'not_product_id' => $post_image_comment_id, 'not_from' => 3, 'not_img' => 6);
                    $artnotification = $this->common->select_data_by_condition('notification', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
                    if ($artnotification[0]['not_read'] == 2) {
                        
                    } elseif ($artnotification[0]['not_read'] == 1) {

                        $datalike = array(
                            'not_read' => 2
                        );

                        $where = array('not_type' => 5, 'not_from_id' => $userid, 'not_to_id' => $artimglike[0]['user_id'], 'not_product_id' => $post_image_comment_id, 'not_from' => 3, 'not_img' => 6);
                        $this->db->where($where);
                        $updatdata = $this->db->update('notification', $datalike);
                    } else {
                        $data = array(
                            'not_type' => 5,
                            'not_from_id' => $userid,
                            'not_to_id' => $artimglike[0]['user_id'],
                            'not_read' => 2,
                            'not_product_id' => $post_image_comment_id,
                            'not_from' => 3,
                            'not_img' => 6,
                            'not_active' => 1,
                            'not_created_date' => date('Y-m-d H:i:s')
                        );
                        //echo "<pre>"; print_r($data); die();
                        $insert_id = $this->common->insert_data_getid($data, 'notification');
                    }
                }
                // end notoification

                $contition_array = array('post_image_comment_id' => $_POST["post_image_comment_id"], 'is_unlike' => '0');
                $bdata2 = $this->data['bdata2'] = $this->common->select_data_by_condition('art_comment_image_like', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');



                if ($updatdata) {


                    $imglike1 .= '<a id="' . $post_image_comment_id . '" onClick="comment_liketwo(this.id)">';
                    $imglike1 .= '<i class="fa fa-thumbs-up" aria-hidden="true">';
                    $imglike1 .= '</i>';
                    $imglike1 .= '<span> ';
                    if (count($bdata2) > 0) {
                        $imglike1 .= count($bdata2) . '';
                    }
                    $imglike1 .= '</span>';
                    $imglike1 .= '</a>';


                    echo $imglike1;
                }
            }
        }
    }

//multiple images comemnt like end
//business_profile 9-5 comment edit start
    public function edit_comment_insertimg() {

        $userid = $this->session->userdata('aileenuser');

         //if user deactive profile then redirect to artistic/index untill active profile start
         $contition_array = array('user_id'=> $userid,'status' => '0','is_delete'=> '0');

        $artistic_deactive = $this->data['artistic_deactive'] = $this->common->select_data_by_condition('art_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);

        if($artistic_deactive)
        {
             redirect('artistic/');
        }
     //if user deactive profile then redirect to artistic/index untill active profile End


        $post_image_comment_id = $_POST["post_image_comment_id"];
        $post_comment = $_POST["comment"];

        $data = array(
            'comment' => $post_comment,
            'modify_date' => date('y-m-d h:i:s')
        );


        $updatdata = $this->common->update_data($data, 'art_post_image_comment', 'post_image_comment_id', $post_image_comment_id);
        if ($updatdata) {

            $contition_array = array('post_image_comment_id' => $_POST["post_image_comment_id"], 'is_delete' => '0');
            $arteditdata = $this->data['arteditdata'] = $this->common->select_data_by_condition('art_post_image_comment', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

            $cmtlike = '<div>';
            $cmtlike .= $this->common->make_links($arteditdata[0]['comment']) . "<br>";
            $cmtlike .= '</div>';
            echo $cmtlike;
        }
    }

//business_profile comment edit end
    //multiple images 9-5  commnet delete start
    public function delete_commentimg() {
        $userid = $this->session->userdata('aileenuser');

         //if user deactive profile then redirect to artistic/index untill active profile start
         $contition_array = array('user_id'=> $userid,'status' => '0','is_delete'=> '0');

        $artistic_deactive = $this->data['artistic_deactive'] = $this->common->select_data_by_condition('art_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);

        if($artistic_deactive)
        {
             redirect('artistic/');
        }
     //if user deactive profile then redirect to artistic/index untill active profile End

        $post_image_comment_id = $_POST["post_image_comment_id"];
        $post_delete = $_POST["post_delete"];

        $data = array(
            'is_delete' => 1,
            'modify_date' => date('y-m-d h:i:s')
        );


        $updatdata = $this->common->update_data($data, 'art_post_image_comment', 'post_image_comment_id', $post_image_comment_id);


        $contition_array = array('post_image_id' => $post_delete, 'is_delete' => '0');
        $artcomment = $this->common->select_data_by_condition('art_post_image_comment', $contition_array, $data = '*', $sortby = 'post_image_comment_id', $orderby = 'DESC', $limit = '1', $offset = '', $join_str = array(), $groupby = '');

        // count of artcomment

        $contition_array = array('post_image_id' => $post_delete, 'is_delete' => '0');
        $artcont = $this->common->select_data_by_condition('art_post_image_comment', $contition_array, $data = '*', $sortby = 'post_image_comment_id', $orderby = 'DESC', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        //   echo "<pre>"; print_r($artcont); die();
        foreach ($artcomment as $art_comment) {


            $art_name = $this->db->get_where('art_reg', array('user_id' => $art_comment['user_id']))->row()->art_name;

            $art_userimage = $this->db->get_where('art_reg', array('user_id' => $art_comment['user_id'], 'status' => 1))->row()->art_user_image;

            $cmtinsert .= '<div class="all-comment-comment-box">';
            $cmtinsert .= '<a href="' . base_url('artistic/art_manage_post/' . $art_comment['user_id'] . '') . '">';
            $cmtinsert .= '<div class="post-design-pro-comment-img">';
            $cmtinsert .= '<img  src="' . base_url($this->config->item('art_profile_thumb_upload_path') . $art_userimage) . '" alt="">  </div>';
            $cmtinsert .= '<div class="comment-name"><b>' . $art_name . '</b>';
            $cmtinsert .= '</div>';
            $cmtinsert .= '</a>';

            $cmtinsert .= '<div class="comment-details" id= "showcommentimg' . $art_comment['post_image_comment_id'] . '">';
            $cmtinsert .= $art_comment['comment'];
            $cmtinsert .= '</div>';
            $cmtinsert .= '<div contenteditable="true"   class="editable_text" name="' . $art_comment['post_image_comment_id'] . '" id="editcommentimg' . $art_comment['post_image_comment_id'] . '"style="display:none;" onkeyup="commenteditimg(' . $art_comment['post_image_comment_id'] . ')" onpaste="OnPaste_StripFormatting(this, event);">';

            $cmtinsert .= '' . $this->common->make_links($art_comment['comment']) . '';
            $cmtinsert .= '</div>';

            $cmtinsert .= '<button id="editsubmitimg' . $art_comment['post_image_comment_id'] . '" style="display:none;" onClick="edit_commentimg(' . $art_comment['post_image_comment_id'] . ')">Comment</button><div class="art-comment-menu-design"> <div class="comment-details-menu" id="likecommentimg' . $art_comment['post_image_comment_id'] . '">';

            $cmtinsert .= '<a id="' . $art_comment['post_image_comment_id'] . '"';
            $cmtinsert .= 'onClick="comment_likeimg(this.id)">';

            $contition_array = array('post_image_comment_id' => $art_comment['post_image_comment_id'], 'user_id' => $userid, 'is_unlike' => 0);

            $artcommentlike1 = $this->common->select_data_by_condition('art_comment_image_like', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

            if (count($artcommentlike1) == 0) {
                $cmtinsert .= '<i class="fa fa-thumbs-up fa-1x" aria-hidden="true"></i>';
            } else {

                $cmtinsert .= '<i class="fa fa-thumbs-up" aria-hidden="true"></i>';
            }

            $cmtinsert .= '<span> ';

            $contition_array = array('post_image_comment_id' => $art_comment['post_image_comment_id'], 'is_unlike' => '0');
            $mulcountlike = $this->data['mulcountlike'] = $this->common->select_data_by_condition('art_comment_image_like', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');


            if (count($mulcountlike) > 0) {
                echo count($mulcountlike);
            }
            $cmtinsert .= '</span>';
            $cmtinsert .= '</a></div>';

            $userid = $this->session->userdata('aileenuser');
            if ($art_comment['user_id'] == $userid) {

                $cmtinsert .= '<span role="presentation" aria-hidden="true"> · </span>';
                $cmtinsert .= '<div class="comment-details-menu">';


                $cmtinsert .= '<div id="editcommentboximg' . $art_comment['post_image_comment_id'] . '"style="display:block;">';

                $cmtinsert .= '<a id="' . $art_comment['post_image_comment_id'] . '"';
                $cmtinsert .= 'onClick="comment_editboximg(this.id)">';
                $cmtinsert .= 'Edit';
                $cmtinsert .= '</a></div>';

                $cmtinsert .= '<div id="editcancleimg' . $art_comment['post_image_comment_id'] . '"style="display:none;">';

                $cmtinsert .= '<a id="' . $art_comment['post_image_comment_id'] . '"';
                $cmtinsert .= 'onClick="comment_editcancleimg(this.id)">';
                $cmtinsert .= 'Cancel';
                $cmtinsert .= '</a></div>';

                $cmtinsert .= '</div>';
            }
            $userid = $this->session->userdata('aileenuser');


            $userid = $this->session->userdata('aileenuser');

            $art_userid = $this->db->get_where('art_post', array('art_post_id' => $art_comment['post_image_id'], 'status' => 1))->row()->user_id;


            if ($art_comment['user_id'] == $userid || $art_userid == $userid) {


                $cmtinsert .= '<span role="presentation" aria-hidden="true"> · </span>';
                $cmtinsert .= '<div class="comment-details-menu">';


                $cmtinsert .= '<input type="hidden" name="post_deleteimg"';
                // $cmtinsert .= 'id="post_deleteimg' . $art_comment['post_image_comment_id'] . '"';
                $cmtinsert .= 'id="post_deleteimg"';
                $cmtinsert .= 'value= "' . $art_comment['post_image_id'] . '">';
                $cmtinsert .= '<a id="' . $art_comment['post_image_comment_id'] . '"';
                $cmtinsert .= 'onClick="comment_deleteimg(this.id)">';
                $cmtinsert .= 'Delete';
                $cmtinsert .= '</a></div>';
            }

            $cmtinsert .= '<span role="presentation" aria-hidden="true"> · </span>';
            $cmtinsert .= '<div class="comment-details-menu">';
            $cmtinsert .= '<p>' . $this->common->time_elapsed_string(date('Y-m-d H:i:s', strtotime($art_comment['created_date']))) . '</p></div></div></div>';

            if (count($artcont) > 1) {
                // comment aount variable start
                $cmtcount = '<a onClick="commentallimg(this.id)" id="' . $art_comment['post_image_id'] . '">';
                $cmtcount .= '<i class="fa fa-comment-o" aria-hidden="true">';
                $cmtcount .= ' ' . count($artcont) . '';
                $cmtcount .= '</i></a>';
            }
            // comment count variable end 
            
            
             $cntinsert =  '<span class="comment_count" >';
     if (count($artcont) > 0) {
           $cntinsert .= '' . count($artcont) . ''; 
           $cntinsert .=   '</span>'; 
           $cntinsert .=  '<span> Comment</span>';
        
           }
        }
        //   echo $cmtinsert;
        echo json_encode(
                array("comment" => $cmtinsert,
                    "count" => $cmtcount,
                    "commentcount" => $cntinsert,
                    ));
    }
    
    

// changes done 9-5
    public function delete_commenttwoimg() {
        $userid = $this->session->userdata('aileenuser');

         //if user deactive profile then redirect to artistic/index untill active profile start
         $contition_array = array('user_id'=> $userid,'status' => '0','is_delete'=> '0');

        $artistic_deactive = $this->data['artistic_deactive'] = $this->common->select_data_by_condition('art_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);

        if($artistic_deactive)
        {
             redirect('artistic/');
        }
     //if user deactive profile then redirect to artistic/index untill active profile End

        $post_image_comment_id = $_POST["post_image_comment_id"];
        $post_delete = $_POST["post_delete"];

        $data = array(
            'is_delete' => 1,
            'modify_date' => date('y-m-d h:i:s')
        );

        $updatdata = $this->common->update_data($data, 'art_post_image_comment', 'post_image_comment_id', $post_image_comment_id);


        $contition_array = array('post_image_id' => $post_delete, 'is_delete' => '0');
        $artcomment = $this->common->select_data_by_condition('art_post_image_comment', $contition_array, $data = '*', $sortby = 'post_image_comment_id', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        //   echo "<pre>"; print_r($artcomment); die();
        if (count($artcomment) > 0) {
            foreach ($artcomment as $art_comment) {

                $art_name = $this->db->get_where('art_reg', array('user_id' => $art_comment['user_id']))->row()->art_name;

                $art_userimage = $this->db->get_where('art_reg', array('user_id' => $art_comment['user_id'], 'status' => 1))->row()->art_user_image;

                $cmtinsert .= '<div class="all-comment-comment-box">';
                $cmtinsert .= '<a href="' . base_url('artistic/art_manage_post/' . $art_comment['user_id'] . '') . '">';
                $cmtinsert .= '<div class="post-design-pro-comment-img">';
                $cmtinsert .= '<img  src="' . base_url($this->config->item('art_profile_thumb_upload_path') . $art_userimage) . '" alt="">  </div>';
                $cmtinsert .= '<div class="comment-name"><b>' . $art_name . '</b>';
                $cmtinsert .= '</div>';
                $cmtinsert .= '</a>';

                $cmtinsert .= '<div class="comment-details" id= "showcommentimgtwo' . $art_comment['post_image_comment_id'] . '">';
                $cmtinsert .= $this->common->make_links($art_comment['comment']);
                $cmtinsert .= '</div>';
                $cmtinsert .= '<div contenteditable="true" class="editable_text" name="' . $art_comment['post_image_comment_id'] . '" id="editcommentimgtwo' . $art_comment['post_image_comment_id'] . '"style="display:none;" onkeyup="commenteditimgtwo(' . $art_comment['post_image_comment_id'] . ')" onpaste="OnPaste_StripFormatting(this, event);">';

                $cmtinsert .= '' . $art_comment['comment'] . '';
                $cmtinsert .= '</div>';

                $cmtinsert .= '<button id="editsubmitimgtwo' . $art_comment['post_image_comment_id'] . '" style="display:none;" onClick="edit_commentimgtwo(' . $art_comment['post_image_comment_id'] . ')">Comment</button><div class="art-comment-menu-design"> <div class="comment-details-menu" id="likecommentimg' . $art_comment['post_image_comment_id'] . '">';

                $cmtinsert .= '<a id="' . $art_comment['post_image_comment_id'] . '"';
                $cmtinsert .= 'onClick="comment_likeimg(this.id)">';

                $contition_array = array('post_image_comment_id' => $art_comment['post_image_comment_id'], 'user_id' => $userid, 'is_unlike' => 0);

                $artcommentlike1 = $this->common->select_data_by_condition('art_comment_image_like', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

                if (count($artcommentlike1) == 0) {
                    $cmtinsert .= '<i class="fa fa-thumbs-up fa-1x" aria-hidden="true"></i>';
                } else {

                    $cmtinsert .= '<i class="fa fa-thumbs-up" aria-hidden="true"></i>';
                }

                $cmtinsert .= '<span> ';

                $contition_array = array('post_image_comment_id' => $art_comment['post_image_comment_id'], 'is_unlike' => '0');
                $mulcountlike = $this->data['mulcountlike'] = $this->common->select_data_by_condition('art_comment_image_like', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');


                if (count($mulcountlike) > 0) {
                    $cmtinsert .= '' . count($mulcountlike) . '';
                }
                $cmtinsert .= '</span>';
                $cmtinsert .= '</a></div>';

                $userid = $this->session->userdata('aileenuser');
                if ($art_comment['user_id'] == $userid) {

                    $cmtinsert .= '<span role="presentation" aria-hidden="true"> · </span>';
                    $cmtinsert .= '<div class="comment-details-menu">';


                    $cmtinsert .= '<div id="editcommentboximgtwo' . $art_comment['post_image_comment_id'] . '"style="display:block;">';

                    $cmtinsert .= '<a id="' . $art_comment['post_image_comment_id'] . '"';
                    $cmtinsert .= 'onClick="comment_editboximgtwo(this.id)">';
                    $cmtinsert .= 'Edit';
                    $cmtinsert .= '</a></div>';

                    $cmtinsert .= '<div id="editcancleimgtwo' . $art_comment['post_image_comment_id'] . '"style="display:none;">';

                    $cmtinsert .= '<a id="' . $art_comment['post_image_comment_id'] . '"';
                    $cmtinsert .= 'onClick="comment_editcancleimgtwo(this.id)">';
                    $cmtinsert .= 'Cancel';
                    $cmtinsert .= '</a></div>';

                    $cmtinsert .= '</div>';
                }
                $userid = $this->session->userdata('aileenuser');


                $userid = $this->session->userdata('aileenuser');

                $art_userid = $this->db->get_where('art_post', array('art_post_id' => $art_comment['post_image_id'], 'status' => 1))->row()->user_id;


                if ($art_comment['user_id'] == $userid || $art_userid == $userid) {


                    $cmtinsert .= '<span role="presentation" aria-hidden="true"> · </span>';
                    $cmtinsert .= '<div class="comment-details-menu">';


                    $cmtinsert .= '<input type="hidden" name="post_deleteimgtwo"';
                    //$cmtinsert .= 'id="post_deleteimgtwo' . $art_comment['post_image_comment_id'] . '"';
                    $cmtinsert .= 'id="post_deleteimgtwo"';
                    $cmtinsert .= 'value= "' . $art_comment['post_image_id'] . '">';
                    $cmtinsert .= '<a id="' . $art_comment['post_image_comment_id'] . '"';
                    $cmtinsert .= 'onClick="comment_deleteimgtwo(this.id)">';
                    $cmtinsert .= 'Delete';
                    $cmtinsert .= '</a></div>';
                }

                $cmtinsert .= '<span role="presentation" aria-hidden="true"> · </span>';
                $cmtinsert .= '<div class="comment-details-menu">';
                $cmtinsert .= '<p>' . $this->common->time_elapsed_string(date('Y-m-d H:i:s', strtotime($art_comment['created_date']))) . '</p></div></div></div>';

                // comment aount variable start
                $idpost = $art['art_post_id'];
                $cmtcount = '<a onClick="commentallimg(this.id)" id="' . $post_delete . '">';
                $cmtcount .= '<i class="fa fa-comment-o" aria-hidden="true">';
                $cmtcount .= ' ' . count($artcomment) . '';
                $cmtcount .= '</i></a>';
            }
        } else {

            $cmtcount = '<a onClick="commentallimg(this.id)" id="' . $post_delete . '">';
            $cmtcount .= '<i class="fa fa-comment-o" aria-hidden="true">';
            $cmtcount .= '</i></a>';
        }
        
         $cntinsert =  '<span class="comment_count" >';
     if (count($artcomment) > 0) {
           $cntinsert .= '' . count($artcomment) . ''; 
           $cntinsert .=   '</span>'; 
           $cntinsert .=  '<span> Comment</span>';
        
           }
        //echo $cmtinsert;
        echo json_encode(
                array("comment" => $cmtinsert,
                    "count" => $cmtcount,
                    "commentcount" => $cntinsert
                    ));
    }

    //mulitple images commnet delete end 
    // khyati 17-4 changes start

    public function fourcomment($postid) {

        $userid = $this->session->userdata('aileenuser');

         //if user deactive profile then redirect to artistic/index untill active profile start
         $contition_array = array('user_id'=> $userid,'status' => '0','is_delete'=> '0');

        $artistic_deactive = $this->data['artistic_deactive'] = $this->common->select_data_by_condition('art_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);

        if($artistic_deactive)
        {
             redirect('artistic/');
        }
     //if user deactive profile then redirect to artistic/index untill active profile End

        //$post_id =  $postid; 
        $post_id = $_POST['art_post_id'];

        // html start

        $contition_array = array('art_post_id' => $post_id, 'status' => '1');
        $artdata = $this->data['artdata'] = $this->common->select_data_by_condition('artistic_post_comment', $contition_array, $data = '*', $sortby = 'artistic_post_comment_id', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        $fourdata = '<div class="insertcommenttwo' . $post_id . '">';

        if ($artdata) {
            foreach ($artdata as $rowdata) {

                $artname = $this->db->get_where('art_reg', array('user_id' => $rowdata['user_id']))->row()->art_name;
                $artlastname = $this->db->get_where('art_reg', array('user_id' => $rowdata['user_id']))->row()->art_lastname;

                $fourdata .= '<div class="all-comment-comment-box">';
                $fourdata .= '<a href="' . base_url('artistic/art_manage_post/' . $rowdata['user_id'] . '') . '">';
                $fourdata .= '<div class="post-design-pro-comment-img">';
                
                $art_userimage = $this->db->get_where('art_reg', array('user_id' => $rowdata['user_id'], 'status' => 1))->row()->art_user_image;
                if ($art_userimage) {
                    $fourdata .= '<img  src="' . base_url($this->config->item('art_profile_thumb_upload_path') . $art_userimage) . '"  alt=""></div>';
                } else {
                    $fourdata .= '<img src="' . base_url(NOIMAGE) . '" alt=""></div>';
                }
                $fourdata .= '<div class="comment-name">';
                $fourdata .= '<b>' . ucwords($artname) . '&nbsp' . ucwords($artlastname) . '</b></br> </div>';
                $fourdata .= '</a>';
                $fourdata .= '<div class="comment-details" id= "showcommenttwo' . $rowdata['artistic_post_comment_id'] . '">';

                $fourdata .= '<div id= "lessmore' . $rowdata['artistic_post_comment_id'] . '"  style="display:block;">';

                    $small = substr($rowdata['comments'], 0, 180);

                $fourdata .= '' . $this->common->make_links($small) . '';

                    // echo $this->common->make_links($small);

                     if (strlen($rowdata['comments']) > 180) {
                         $fourdata .= '... <span id="kkkk" onClick="seemorediv(' . $rowdata['artistic_post_comment_id'] . ')">See More</span>';
                        }

                $fourdata .= '</div>';


                $fourdata .= '<div id= "seemore' . $rowdata['artistic_post_comment_id'] . '"  style="display:none;">';

                $fourdata .= '' . $this->common->make_links($rowdata['comments']) . '</div></div>';

//                $fourdata .= '<textarea  name="' . $rowdata['artistic_post_comment_id'] . '" id="editcommenttwo' . $rowdata['artistic_post_comment_id'] . '" style="display:none" onClick="commentedittwo(this.name)">';
//                $fourdata .= '' . $rowdata['comments'] . '';
//                $fourdata .= '</textarea>';
                $fourdata .= '<div class="edit-comment-box"><div class="inputtype-edit-comment">';
                $fourdata .= '<div contenteditable="true" style="display:none; min-height:37px !important; margin-top: 0px!important; margin-left: 1.5% !important; width: 81%;" class="editable_text" name="' . $rowdata['artistic_post_comment_id'] . '"  id="editcommenttwo' . $rowdata['artistic_post_comment_id'] . '" placeholder="Type Message ..." value= ""  onkeyup="commentedittwo(' . $rowdata['artistic_post_comment_id'] . ')" onpaste="OnPaste_StripFormatting(this, event);">' . $rowdata['comments'] . '</div>';
                $fourdata .= '<span class="comment-edit-button"><button id="editsubmittwo' . $rowdata['artistic_post_comment_id'] . '" style="display:none" onClick="edit_commenttwo(' . $rowdata['artistic_post_comment_id'] . ')">Save</button></span>';
//                $fourdata .= '<input type="text" name="' . $rowdata['artistic_post_comment_id'] . '" id="editcommenttwo' . $rowdata['artistic_post_comment_id'] . '" style="display:none" value="' . $rowdata['comments'] . '"  onClick="commentedittwo(this.name)">';
//                $fourdata .= '<button id="editsubmittwo' . $rowdata['artistic_post_comment_id'] . '" style="display:none" onClick="edit_commenttwo(' . $rowdata['artistic_post_comment_id'] . ')">Comment</button>';
                $fourdata .= '</div></div><div class="art-comment-menu-design">';
                $fourdata .= '<div class="comment-details-menu" id="likecomment' . $rowdata['artistic_post_comment_id'] . '">';
                $fourdata .= '<a id="' . $rowdata['artistic_post_comment_id'] . '"   onClick="comment_like(this.id)">';

                $userid = $this->session->userdata('aileenuser');
                $contition_array = array('artistic_post_comment_id' => $rowdata['artistic_post_comment_id'], 'status' => '1');
                $artcommentlike = $this->data['artcommentlike'] = $this->common->select_data_by_condition('artistic_post_comment', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
                $likeuserarray = explode(',', $artcommentlike[0]['artistic_comment_like_user']);

                if (!in_array($userid, $likeuserarray)) {
                    $fourdata .= '<i class="fa fa-thumbs-up fa-1x" aria-hidden="true"></i>';
                } else {
                    $fourdata .= '<i class="fa fa-thumbs-up" aria-hidden="true"></i>';
                }

                $fourdata .= '<span> ';
                if ($rowdata['artistic_comment_likes_count']) {
                    $fourdata .= '' . $rowdata['artistic_comment_likes_count'] . '';
                }
                $fourdata .= '</span></a></div>';

                $userid = $this->session->userdata('aileenuser');
                if ($rowdata['user_id'] == $userid) {

                    $fourdata .= '<span role="presentation" aria-hidden="true"> · </span>';
                    $fourdata .= '<div class="comment-details-menu">';
                    $fourdata .= '<div id="editcommentboxtwo' . $rowdata['artistic_post_comment_id'] . '" style="display:block;">';
                    $fourdata .= '<a id="' . $rowdata['artistic_post_comment_id'] . '"   onClick="comment_editboxtwo(this.id)" class="editbox">Edit</a> </div>';
                    $fourdata .= '<div id="editcancletwo' . $rowdata['artistic_post_comment_id'] . '" style="display:none;">';
                    $fourdata .= '<a id="' . $rowdata['artistic_post_comment_id'] . '" onClick="comment_editcancletwo(this.id)">Cancel</a></div></div>';
                }
                $userid = $this->session->userdata('aileenuser');
                $art_userid = $this->db->get_where('art_post', array('art_post_id' => $rowdata['art_post_id'], 'status' => 1))->row()->user_id;
                if ($rowdata['user_id'] == $userid || $art_userid == $userid) {
                    $fourdata .= '<span role="presentation" aria-hidden="true"> · </span>';
                    $fourdata .= '<div class="comment-details-menu">';
                    $fourdata .= '<input type="hidden" name="post_delete"  id="post_deletetwo" value= "' . $rowdata['art_post_id'] . '">';
                    $fourdata .= '<a id="' . $rowdata['artistic_post_comment_id'] . '"';
                    //$fourdata .= 'onClick="comment_deletetwo(this.id)"> Delete <span class="insertcommenttwo' . $rowdata['artistic_post_comment_id'] . '">';
                    $fourdata .= 'onClick="comment_deletetwo(this.id)"> Delete';
                    $fourdata .= '</span> </a> </div>';
                }
                $fourdata .= '<span role="presentation" aria-hidden="true"> · </span>';
                $fourdata .= '<div class="comment-details-menu">  <p>';
                $fourdata .= '' . $this->common->time_elapsed_string(date('Y-m-d H:i:s', strtotime($rowdata['created_date']))) . '</br></p></div>';
                $fourdata .= '</div></div>';
            }
        } else {
            $fourdata = 'No comments Available!!!</div>';
        }
        echo $fourdata;
    }

    // khyati 9-5 changes end 


    public function fourcommentimg($postid) {

        $userid = $this->session->userdata('aileenuser');

         //if user deactive profile then redirect to artistic/index untill active profile start
         $contition_array = array('user_id'=> $userid,'status' => '0','is_delete'=> '0');

        $artistic_deactive = $this->data['artistic_deactive'] = $this->common->select_data_by_condition('art_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);

        if($artistic_deactive)
        {
             redirect('artistic/');
        }
     //if user deactive profile then redirect to artistic/index untill active profile End
        //$post_id =  $postid; 
        $image_id = $_POST['art_post_id'];

        // html start

        $contition_array = array('post_image_id' => $image_id, 'is_delete' => '0');

        $artmulimage1 = $this->common->select_data_by_condition('art_post_image_comment', $contition_array, $data = '*', $sortby = 'post_image_comment_id', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        // echo '<pre>'; print_r($artmulimage1); die();

        $fourdata = '<div class="insertcommentimgtwo' . $image_id . '">';


        foreach ($artmulimage1 as $rowdata) {

            $artname = $this->db->get_where('art_reg', array('user_id' => $userid))->row()->art_name;


            $artlastname = $this->db->get_where('art_reg', array('user_id' => $userid))->row()->art_lastname;



            $fourdata .= '<div class="all-comment-comment-box">';
            $fourdata .= '<a href="' . base_url('artistic/art_manage_post/' . $rowdata['user_id'] . '') . '">';
            $fourdata .= '<div class="post-design-pro-comment-img">';

            $art_userimage = $this->db->get_where('art_reg', array('user_id' => $rowdata['user_id'], 'status' => 1))->row()->art_user_image;

            $fourdata .= '<img  src="' . base_url($this->config->item('art_profile_thumb_upload_path') . $art_userimage) . '"  alt=""></div>';
            $fourdata .= '<div class="comment-name">';
            $fourdata .= '<b>' . ucwords($artname) . '&nbsp' . ucwords($artlastname) . '</b></br> </div>';
            $fourdata .= '</a>';  
            $fourdata .= '<div class="comment-details" id= "showcommentimgtwo' . $rowdata['post_image_comment_id'] . '">';
            $fourdata .= '' . $this->common->make_links($rowdata['comment']) . '</br></div>';

            $fourdata .= '<div contenteditable="true" class="editable_text" name="' . $rowdata['post_image_comment_id'] . '" id="editcommentimgtwo' . $rowdata['post_image_comment_id'] . '" style="display:none"  onClick="commenteditimgtwo(' . $rowdata['post_image_comment_id'] . ')" onpaste="OnPaste_StripFormatting(this, event);">';

            $fourdata .= '' . $rowdata['comment'] . '';
            $fourdata .= '</div>';

            $fourdata .= '<button id="editsubmitimgtwo' . $rowdata['post_image_comment_id'] . '" style="display:none" onClick="edit_commentimgtwo(' . $rowdata['post_image_comment_id'] . ')">Comment</button>';

            $fourdata .= '<div class="art-comment-menu-design">';
            $fourdata .= '<div class="comment-details-menu" id="likecommentimg' . $rowdata['post_image_comment_id'] . '">';
            $fourdata .= '<a id="' . $rowdata['post_image_comment_id'] . '"   onClick="comment_likeimgtwo(this.id)">';

            $userid = $this->session->userdata('aileenuser');
            $contition_array = array('post_image_comment_id' => $rowdata['post_image_comment_id'], 'user_id' => $userid, 'is_unlike' => 0);
            $artcommentlike = $this->data['artcommentlike'] = $this->common->select_data_by_condition('art_comment_image_like', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');


            if (count($artcommentlike) == 0) {
                $fourdata .= '<i class="fa fa-thumbs-up fa-1x" aria-hidden="true"></i>';
            } else {
                $fourdata .= '<i class="fa fa-thumbs-up" aria-hidden="true"></i>';
            }


            $contition_array = array('post_image_comment_id' => $rowdata['post_image_comment_id'], 'is_unlike' => '0');
            $mulcountlikeuser = $this->data['mulcountlikeuser'] = $this->common->select_data_by_condition('art_comment_image_like', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');


            $fourdata .= '<span>';
            if ($mulcountlikeuser) {
                $fourdata .= ' ' . count($mulcountlikeuser) . '';
            }

            $fourdata .= '</span></a></div>';

            $userid = $this->session->userdata('aileenuser');
            if ($rowdata['user_id'] == $userid) {

                $fourdata .= '<span role="presentation" aria-hidden="true"> · </span>';
                $fourdata .= '<div class="comment-details-menu">';
                $fourdata .= '<div id="editcommentboximgtwo' . $rowdata['post_image_comment_id'] . '" style="display:block;">';
                $fourdata .= '<a id="' . $rowdata['post_image_comment_id'] . '"   onClick="comment_editboximgtwo(this.id)">Edit</a> </div>';
                $fourdata .= '<div id="editcancleimgtwo' . $rowdata['post_image_comment_id'] . '" style="display:none;">';
                $fourdata .= '<a id="' . $rowdata['post_image_comment_id'] . '" onClick="comment_editcancleimgtwo(this.id)">Cancel</a></div></div>';
            }
            $userid = $this->session->userdata('aileenuser');
            $art_userid = $this->db->get_where('art_post', array('art_post_id' => $rowdata['art_post_id'], 'status' => 1))->row()->user_id;
            if ($rowdata['user_id'] == $userid || $art_userid == $userid) {

                $fourdata .= '<span role="presentation" aria-hidden="true"> · </span>';
                $fourdata .= '<div class="comment-details-menu">';


                //   $fourdata .= '<input type="hidden" name="post_deleteimgtwo"  id="post_deleteimgtwo' . $rowdata['post_image_comment_id'] . '" value= "' . $rowdata['post_image_id'] . '">';
                $fourdata .= '<input type="hidden" name="post_deleteimgtwo"  id="post_deleteimgtwo" value= "' . $rowdata['post_image_id'] . '">';
                $fourdata .= '<a id="' . $rowdata['post_image_comment_id'] . '"';
                //$fourdata .= 'onClick="comment_deletetwo(this.id)"> Delete <span class="insertcommenttwo' . $rowdata['post_image_comment_id'] . '">';
                $fourdata .= 'onClick="comment_deleteimgtwo(this.id)"> Delete';
                $fourdata .= '</span> </a> </div>';
            }
            $fourdata .= '<span role="presentation" aria-hidden="true"> · </span>';
            $fourdata .= '<div class="comment-details-menu">  <p>';
            $fourdata .= '' . $this->common->time_elapsed_string(date('Y-m-d H:i:s', strtotime($rowdata['created_date']))) . '</br></p></div>';
            $fourdata .= '</div></div>';
        }

        echo $fourdata;
    }

    public function deletepdf() {

        $userid = $this->session->userdata('aileenuser');

         //if user deactive profile then redirect to artistic/index untill active profile start
         $contition_array = array('user_id'=> $userid,'status' => '0','is_delete'=> '0');

        $artistic_deactive = $this->data['artistic_deactive'] = $this->common->select_data_by_condition('art_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);

        if($artistic_deactive)
        {
             redirect('artistic/');
        }
     //if user deactive profile then redirect to artistic/index untill active profile End

        $contition_array = array('user_id' => $userid);
        $art_reg_data = $this->common->select_data_by_condition('art_reg', $contition_array, $data = 'art_bestofmine', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        $art_bestofmine = $art_reg_data[0]['art_bestofmine'];

        if ($art_bestofmine != '') {
            $art_pdf_path = 'uploads/art_images/';
            $art_pdf = $art_pdf_path . $art_bestofmine;
            if (isset($art_pdf)) {
                unlink($art_pdf);
            }
        }

        $data = array(
            'art_bestofmine' => ''
        );

        $update = $this->common->update_data($data, 'art_reg', 'user_id', $userid);
        echo 'ok';
    }

    public function likeuserlistimg() {
        $post_id = $_POST['post_id'];

        $contition_array = array('post_image_id' => $post_id, 'is_unlike' => '0');
        $commnetcount = $this->common->select_data_by_condition('art_post_image_like', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
        
           $modal =    '<div class="modal-header">';
       $modal .=   '<button type="button" class="close" data-dismiss="modal">&times;</button>';
       $modal .=   '<h4 class="modal-title">';
       
       $modal .=    '' . count($commnetcount) . ' Like';
       
       $modal .= '</h4></div>';
       $modal .= '<div class="modal-body padding_less_right">';
       $modal .=     '<div class="like_user_list">';
       $modal .=     '<ul>';
          foreach ($commnetcount as $comment) {
             
     $art_name1 = $this->db->get_where('art_reg', array('user_id' => $comment['user_id'], 'status' => 1))->row()->art_name;
     $designation = $this->db->get_where('art_reg', array('user_id' => $comment['user_id'], 'status' => 1))->row()->designation;
     $art_image = $this->db->get_where('art_reg', array('user_id' => $comment['user_id'], 'status' => 1))->row()->art_user_image;
   
       $modal .=  '<li>';
       $modal .=  '<div class="like_user_listq">';
       $modal .=  '<a href="' . base_url('artistic/artistic_profile/' . $value) . '" title="' . $art_name1 . '" class="head_main_name" >';
       $modal .=  '<div class="like_user_list_img">';
       
       
         if ($art_image) {
                    $modal .= '<img  src="' . base_url($this->config->item('art_profile_thumb_upload_path') . $art_image) . '"  alt="">';
                } else {
                    $modal .= '<img src="' . base_url(NOIMAGE) . '" alt="">';
                }
       $modal .=  '</div>';
       $modal .=  '<div class="like_user_list_main_desc">';
       $modal .=  '<div class="like_user_list_main_name">';
       $modal .=  '' . ucwords($art_name1) . '';
       $modal .=  '</div></a>';
       $modal .=  '<div class="like_user_list_current_work">';


       if($designation){
       $modal .=  '<span class="head_main_work">' . $designation . '</span>';
        }else{
       $modal .=  '<span class="head_main_work">Current work</span>';

        }

       $modal .=  '</div>';
       $modal .=  '</div>';
       $modal .=  '</div>';
       $modal .=  '</li>';
            }
       $modal .=  '</ul>';
       $modal .=  '</div>';
       $modal .=  '<div class="clearfix"></div>';
       $modal .=  '</div>';
       $modal .=  '<div class="modal-footer">';
       $modal .=  '<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>';
       $modal .=  '</div>';
      
       echo $modal;
//        echo '<div class="likeduser">';
//        echo '<div class="likeduser-title">User List</div>';
//        foreach ($commnetcount as $comment) {
//            $art_name1 = $this->db->get_where('art_reg', array('user_id' => $comment['user_id'], 'status' => 1))->row()->art_name;
//            echo '<div class="likeuser_list"><a href="' . base_url('artistic/artistic_profile/' . $comment['user_id']) . '">';
//            echo ucwords($art_name1);
//            echo '</a></div>';
//        }
//        echo '<div>';
    }

    public function likeuserlist() {
       $post_id = $_POST['post_id'];

        $contition_array = array('art_post_id' => $post_id, 'status' => '1', 'is_delete' => '0');
        $commnetcount = $this->common->select_data_by_condition('art_post', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
       
        $likeuser = $commnetcount[0]['art_like_user'];
        $countlike = $commnetcount[0]['art_likes_count'] - 1;

        $likelistarray = explode(',', $likeuser);
        // $likelistarray = array_reverse($likelistarray);
   
        
         $modal =    '<div class="modal-header">';
    //   $modal .=   '<button type="button" class="close" data-dismiss="modal">&times;</button>';
       $modal .=   '<h4 class="modal-title">';
       
       $modal .=    '' . count($likelistarray) . ' Like';
       
       $modal .= '</h4></div>';
       $modal .= '<div class="modal-body padding_less_right">';
       $modal .=     '<div class="like_user_list">';
       $modal .=     '<ul>';
          foreach ($likelistarray as $key => $value) {
             
     $art_name1 = $this->db->get_where('art_reg', array('user_id' => $value, 'status' => 1))->row()->art_name;
     $designation = $this->db->get_where('art_reg', array('user_id' => $value, 'status' => 1))->row()->designation;
     $art_image = $this->db->get_where('art_reg', array('user_id' => $value, 'status' => 1))->row()->art_user_image;
   
       $modal .=  '<li>';
       $modal .=  '<div class="like_user_listq">';
       $modal .=  '<a href="' . base_url('artistic/artistic_profile/' . $value) . '" title="' . $art_name1 . '" class="head_main_name" >';
       $modal .=  '<div class="like_user_list_img">';
       
       
         if ($art_image) {
                    $modal .= '<img  src="' . base_url($this->config->item('art_profile_thumb_upload_path') . $art_image) . '"  alt="">';
                } else {
                    $modal .= '<img src="' . base_url(NOIMAGE) . '" alt="">';
                }
       $modal .=  '</div>';
       $modal .=  '<div class="like_user_list_main_desc">';
       $modal .=  '<div class="like_user_list_main_name">';
       $modal .=  '' . ucwords($art_name1) . '';
       $modal .=  '</div></a>';
       $modal .=  '<div class="like_user_list_current_work">';

       if($designation){
       $modal .=  '<span class="head_main_work">' . $designation . '</span>';
        }else{
       $modal .=  '<span class="head_main_work">Current work</span>';

        }

       $modal .=  '</div>';
       $modal .=  '</div>';
       $modal .=  '</div>';
       $modal .=  '</li>';
            }
       $modal .=  '</ul>';
       $modal .=  '</div>';
       $modal .=  '<div class="clearfix"></div>';
       $modal .=  '</div>';
      // $modal .=  '<div class="modal-footer">';
//$modal .=  '<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>';
      // $modal .=  '</div>';
      
       echo $modal;
//        echo '<div class="likeduser">';
//        echo '<div class="likeduser-title">User List</div>';
//        foreach ($likelistarray as $key => $value) {
//            $art_name1 = $this->db->get_where('art_reg', array('user_id' => $value, 'status' => 1))->row()->art_name;
//            echo '<div class="likeuser_list"><a href="' . base_url('artistic/artistic_profile/' . $value) . '">';
//            echo ucwords($art_name1);
//            echo '</a></div>';
//        }
//        echo '<div>';
    }

    // khyati changes start 19-5
    public function insert_commentimg() {

        $userid = $this->session->userdata('aileenuser');

         //if user deactive profile then redirect to artistic/index untill active profile start
         $contition_array = array('user_id'=> $userid,'status' => '0','is_delete'=> '0');

        $artistic_deactive = $this->data['artistic_deactive'] = $this->common->select_data_by_condition('art_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);

        if($artistic_deactive)
        {
             redirect('artistic/');
        }
     //if user deactive profile then redirect to artistic/index untill active profile End

        $post_image_id = $_POST["post_image_id"];
        $post_comment = $_POST["comment"];


        //$contition_array = array('post_image_id' => $_POST["post_image_id"], 'is_unlike' => '0');
        $contition_array = array('image_id' => $_POST["post_image_id"], 'is_deleted' => '1');
        $artimg = $this->data['artimg'] = $this->common->select_data_by_condition('post_image', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        $contition_array = array('art_post_id' => $artimg[0]["post_id"], 'is_delete' => 0);
        $artpostid = $this->data['artpostid'] = $this->common->select_data_by_condition('art_post', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        //echo "<pre>"; print_r($artpostid); die();

        $data = array(
            'user_id' => $userid,
            'post_image_id' => $post_image_id,
            'comment' => $post_comment,
            'created_date' => date('Y-m-d H:i:s', time()),
            'is_delete' => 0
        );
        $insert_id = $this->common->insert_data_getid($data, 'art_post_image_comment');

        // insert notification

        if ($artpostid[0]['user_id'] == $userid) {
            
        } else {
            $datanotification = array(
                'not_type' => 6,
                'not_from_id' => $userid,
                'not_to_id' => $artpostid[0]['user_id'],
                'not_read' => 2,
                'not_product_id' => $insert_id,
                'not_from' => 3,
                'not_img' => 4,
                'not_active' => 1,
                'not_created_date' => date('Y-m-d H:i:s')
            );
            //echo "<pre>"; print_r($datanotification); die();
            $insert_id_notification = $this->common->insert_data_getid($datanotification, 'notification');
        }
        // end notoification

        $contition_array = array('post_image_id' => $post_image_id, 'is_delete' => '0');
        $artcomment = $this->common->select_data_by_condition('art_post_image_comment', $contition_array, $data = '*', $sortby = 'post_image_comment_id', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        // count of artcomment

        $contition_array = array('post_image_id' => $post_image_id, 'is_delete' => '0');
        $artcont = $this->common->select_data_by_condition('art_post_image_comment', $contition_array, $data = '*', $sortby = 'post_image_comment_id', $orderby = 'DESC', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        $cmtinsert = '<div class="insertcommentimgtwo' . $post_image_id . '">';
        //echo "<pre>"; print_r($artcomment); die();
        foreach ($artcomment as $art_comment) {

            $art_name = $this->db->get_where('art_reg', array('user_id' => $art_comment['user_id']))->row()->art_name;

            $art_userimage = $this->db->get_where('art_reg', array('user_id' => $art_comment['user_id'], 'status' => 1))->row()->art_user_image;

            $cmtinsert .= '<div class="all-comment-comment-box">';
            $cmtinsert .= '<a href="' . base_url('artistic/art_manage_post/' . $art_comment['user_id'] . '') . '">';
            $cmtinsert .= '<div class="post-design-pro-comment-img">';
            $cmtinsert .= '<img  src="' . base_url($this->config->item('art_profile_thumb_upload_path') . $art_userimage) . '" alt="">  </div>';
            $cmtinsert .= '<div class="comment-name"><b>' . $art_name . '</b>';
            $cmtinsert .= '</div>';
            $cmtinsert .= '</a>';

            $cmtinsert .= '<div class="comment-details" id= "showcommentimgtwo' . $art_comment['post_image_comment_id'] . '"" >';
            $cmtinsert .= $this->common->make_links($art_comment['comment']);
            $cmtinsert .= '</div>';
            $cmtinsert .= '<div contenteditable="true" class="editable_text" name="' . $art_comment['post_image_comment_id'] . '" id="editcommentimgtwo' . $art_comment['post_image_comment_id'] . '"style="display:none;" onkeyup="commenteditimgtwo(' . $art_comment['post_image_comment_id'] . ')" onpaste="OnPaste_StripFormatting(this, event);">';

            $cmtinsert .= '' . $art_comment['comment'] . '';
            $cmtinsert .= '</div>';

            $cmtinsert .= '<button id="editsubmitimgtwo' . $art_comment['post_image_comment_id'] . '" style="display:none;" onClick="edit_commentimgtwo(' . $art_comment['post_image_comment_id'] . ')">Comment</button><div class="art-comment-menu-design"> <div class="comment-details-menu" id="likecommentimg' . $art_comment['post_image_comment_id'] . '">';

            $cmtinsert .= '<a id="' . $art_comment['post_image_comment_id'] . '"';
            $cmtinsert .= 'onClick="comment_likeimgtwo(this.id)">';

            $contition_array = array('post_image_comment_id' => $art_comment['post_image_comment_id'], 'user_id' => $userid, 'is_unlike' => 0);

            $artcommentlike1 = $this->common->select_data_by_condition('art_comment_image_like', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

            if (count($artcommentlike1) == 0) {
                $cmtinsert .= '<i class="fa fa-thumbs-up fa-1x" aria-hidden="true"></i>';
            } else {

                $cmtinsert .= '<i class="fa fa-thumbs-up" aria-hidden="true"></i>';
            }

            $cmtinsert .= '<span> ';

            $contition_array = array('post_image_comment_id' => $art_comment['post_image_comment_id'], 'is_unlike' => '0');
            $mulcountlike = $this->data['mulcountlike'] = $this->common->select_data_by_condition('art_comment_image_like', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');


            if (count($mulcountlike) > 0) {
                //echo count($mulcountlike); 
            }
            $cmtinsert .= '</span>';
            $cmtinsert .= '</a></div>';

            $userid = $this->session->userdata('aileenuser');
            if ($art_comment['user_id'] == $userid) {

                $cmtinsert .= '<span role="presentation" aria-hidden="true"> · </span>';
                $cmtinsert .= '<div class="comment-details-menu">';


                $cmtinsert .= '<div id="editcommentboximgtwo' . $art_comment['post_image_comment_id'] . '"style="display:block;">';

                $cmtinsert .= '<a id="' . $art_comment['post_image_comment_id'] . '"';
                $cmtinsert .= 'onClick="comment_editboximgtwo(this.id)">';
                $cmtinsert .= 'Edit';
                $cmtinsert .= '</a></div>';

                $cmtinsert .= '<div id="editcancleimgtwo' . $art_comment['post_image_comment_id'] . '"style="display:none;">';

                $cmtinsert .= '<a id="' . $art_comment['post_image_comment_id'] . '"';
                $cmtinsert .= 'onClick="comment_editcancleimgtwo(this.id)">';
                $cmtinsert .= 'Cancel';
                $cmtinsert .= '</a></div>';

                $cmtinsert .= '</div>';
            }
            $userid = $this->session->userdata('aileenuser');


            $userid = $this->session->userdata('aileenuser');

            $art_userid = $this->db->get_where('art_post', array('art_post_id' => $art_comment['post_image_id'], 'status' => 1))->row()->user_id;


            if ($art_comment['user_id'] == $userid || $art_userid == $userid) {


                $cmtinsert .= '<span role="presentation" aria-hidden="true"> · </span>';
                $cmtinsert .= '<div class="comment-details-menu">';


                $cmtinsert .= '<input type="hidden" name="post_deleteimgtwo"';
                // $cmtinsert .= 'id="post_deleteimg' . $art_comment['post_image_comment_id'] . '"';
                $cmtinsert .= 'id="post_deleteimgtwo"';
                $cmtinsert .= 'value= "' . $art_comment['post_image_id'] . '">';
                $cmtinsert .= '<a id="' . $art_comment['post_image_comment_id'] . '"';
                $cmtinsert .= 'onClick="comment_deleteimgtwo(this.id)">';
                $cmtinsert .= 'Delete';
                $cmtinsert .= '</a></div>';
            }

            $cmtinsert .= '<span role="presentation" aria-hidden="true"> · </span>';
            $cmtinsert .= '<div class="comment-details-menu">';
            $cmtinsert .= '<p>' . $this->common->time_elapsed_string(date('Y-m-d H:i:s', strtotime($art_comment['created_date']))) . '</p></div></div></div>';


            if (count($artcont) > 1) {
                // comment aount variable start
                $cmtcount = '<a onClick="commentallimg(this.id)" id="' . $post_image_id . '">';
                $cmtcount .= '<i class="fa fa-comment-o" aria-hidden="true">';
                $cmtcount .= ' ' . count($artcont) . '';
                $cmtcount .= '</i></a>';
            }
            // comment count variable end 
            
              $cntinsert =  '<span class="comment_count" >';
     if (count($artcont) > 0) {
           $cntinsert .= '' . count($artcont) . ''; 
           $cntinsert .=   '</span>'; 
           $cntinsert .=  '<span> Comment</span>';
        
           }
        }
        $cmtinsert .= '</div>';
        //   echo $cmtinsert;
        echo json_encode(
                array("comment" => $cmtinsert,
                    "count" => $cmtcount,
                    "commentcount" => $cntinsert
                    ));
    }

    // khyati changes end 19-5
    
    
      public function edit_more_insert() {

        $userid = $this->session->userdata('aileenuser');

         //if user deactive profile then redirect to artistic/index untill active profile start
         $contition_array = array('user_id'=> $userid,'status' => '0','is_delete'=> '0');

        $artistic_deactive = $this->data['artistic_deactive'] = $this->common->select_data_by_condition('art_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);

        if($artistic_deactive)
        {
             redirect('artistic/');
        }
     //if user deactive profile then redirect to artistic/index untill active profile End

        $post_id = $_POST["art_post_id"];
       

       
      

            $contition_array = array('art_post_id' => $_POST["art_post_id"], 'status' => '1');
            $artdata = $this->data['artdata'] = $this->common->select_data_by_condition('art_post', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

            
            if ($this->data['artdata'][0]['art_description']) {
//              
                   
                    $editpostdes .= $this->data['artdata'][0]['art_description'];
            }
            //echo $editpost;   echo $editpostdes;
            echo json_encode(
                    array(
                        "description" => $editpostdes
                    ));
        
    }

    
}
