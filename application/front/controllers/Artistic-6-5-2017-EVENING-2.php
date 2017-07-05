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
                    redirect('artistic/art_portfolio', refresh);
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
        $contition_array = array('status' => '1', 'is_delete' => '0');


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

        $this->load->view('artistic/art_basic_information', $this->data);
    }

    public function art_basic_information_insert() {

        $userid = $this->session->userdata('aileenuser');


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
                'created_date' => date('Y-m-d', time()),
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
            $condition_array = array('is_delete' => '0', 'user_id !=' => $userid, 'status' => '1');

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
        $contition_array = array('status' => 1);
        $this->data['countries'] = $this->common->select_data_by_condition('countries', $contition_array, $data = '*', $sortby = 'country_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        //for getting state data
        $contition_array = array('status' => 1);
        $this->data['states'] = $this->common->select_data_by_condition('states', $contition_array, $data = '*', $sortby = 'state_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        //for getting city data
        $contition_array = array('status' => 1);
        $this->data['cities'] = $this->common->select_data_by_condition('cities', $contition_array, $data = '*', $sortby = 'city_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');



        $contition_array = array('user_id' => $userid, 'is_delete' => '0', 'status' => '1');
        $userdata = $this->common->select_data_by_condition('art_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

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
        $contition_array = array('status' => '1', 'is_delete' => '0');


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


        if ($this->input->post('next')) {

            $this->form_validation->set_rules('country', 'Country', 'required');
            $this->form_validation->set_rules('state', 'State', 'required');
            $this->form_validation->set_rules('address', 'Address', 'required');
            $this->form_validation->set_rules('pincode', 'Pincode', 'numeric');

            if ($this->form_validation->run() == FALSE) {
                $this->load->view('artistic/art_address');
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
        $contition_array = array('status' => '1', 'is_delete' => '0');


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


        $this->load->view('artistic/art_information', $this->data);
    }

    public function art_information_insert() {
        $userid = $this->session->userdata('aileenuser');
        $skill = $this->input->post('skills');
        $otherskill = $this->input->post('other_skill');


        $data = array(
            'art_yourart' => $this->input->post('artname'),
            'other_skill' => $this->input->post('other_skill'),
            'art_skill' => implode(',', $skill),
            'art_desc_art' => $this->input->post('desc_art'),
            'art_inspire' => $this->input->post('inspire'),
            'modified_date' => date('Y-m-d', time()),
            'art_step' => 3
        );


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
        $contition_array = array('status' => '1', 'is_delete' => '0');


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



        $userid = $this->session->userdata('aileenuser');
        $artportfolio = $_POST['artportfolio'];
        // $bestofmine = $_POST['bestofmine']; 
        //best of mine image upload code start

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


        $config['upload_path'] = 'uploads/art_images/';
        $config['allowed_types'] = 'pdf';

        $config['file_name'] = $_FILES['image']['name'];
        $config['upload_max_filesize'] = '40M';

        //Load upload library and initialize configuration
        $this->load->library('upload', $config);
        $this->upload->initialize($config);

        if ($this->upload->do_upload('image')) {

            $uploadData = $this->upload->data();

            $picture = $uploadData['file_name'];
        } else {

            $picture = '';
        }

        if ($picture) {
            $data = array(
                'art_bestofmine' => $picture,
                // 'art_portfolio' => $artportfolio,
                'modified_date' => date('Y-m-d', time()),
                'art_step' => 4
            );


            $updatdata = $this->common->update_data($data, 'art_reg', 'user_id', $userid);
        } elseif ($artportfolio) {


            $data = array(
                //'art_bestofmine' => $picture,
                'art_portfolio' => $artportfolio,
                'modified_date' => date('Y-m-d', time()),
                'art_step' => 4
            );


            $updatdata = $this->common->update_data($data, 'art_reg', 'user_id', $userid);
        }

        if ($updatdata) {
            $this->session->set_flashdata('success', 'Portfolio updated successfully');
            redirect('artistic/artistic_profile', refresh);
        } else {
            $this->session->flashdata('error', 'Your data not inserted');
            redirect('artistic/art_portfolio', refresh);
        }
    }

    public function art_post() {

        $user_name = $this->session->userdata('user_name');


        $userid = $this->session->userdata('aileenuser');

        $contition_array = array('user_id' => $userid, 'status' => '1');
        $this->data['artisticdata'] = $this->common->select_data_by_condition('art_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        //echo "<pre>"; print_r($this->data['artisticdata']); die();
        $artregid = $this->data['artisticdata'][0]['art_id'];


//userlist for followdata strat
        $likeuserarray = explode(',', $this->data['artisticdata'][0]['art_skill']);
        //echo "<pre>"; print_r($likeuserarray); die();
        $contition_array = array('is_delete' => 0, 'status' => 1, 'user_id !=' => $userid);
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

        $contition_array = array('is_delete' => 0, 'status' => 1, 'user_id !=' => $userid, 'art_city !=' => $artregcity);
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
        $contition_array = array('is_delete' => 0, 'status' => 1, 'user_id !=' => $userid, 'art_city !=' => $artregcity, 'art_state !=' => $artregstate);
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
        $contition_array = array('art_skill' => $userselectskill, 'status' => '1');
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

        $this->data['art_userdata'] = $this->common->select_data_by_condition('art_post', $contition_array, $data = '*', $sortby = 'art_post_id', $orderby = 'DESC', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        $userabc[][] = $this->data['art_userdata'][0];


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

        //echo count($followerabc);  echo count($unique); die();

        if (count($followerabc) == 0 && count($unique) != 0) {
            $unique_user = $unique;
        } elseif (count($unique) == 0 && count($followerabc) != 0) {

            $unique_user = $followerabc;
        } elseif (count($unique) != 0 && count($followerabc) != 0) {
            $unique_user = array_merge($unique, $followerabc);
        }


        foreach ($unique_user as $k => $v) {
            foreach ($unique_user as $key => $value) {
                foreach ($value as $datak => $datav) {
                    if ($k != $datak && $v['user_id'] == $datav['user_id']) {
                        unset($unique_user[$k]);
                    }
                }
            }
        }

        foreach ($unique_user as $key1 => $val1) {
            foreach ($val1 as $ke => $va) {

                $qbc[] = $va;
            }
        }

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


        // sorting end
// code for search
        $contition_array = array('status' => '1', 'is_delete' => '0');


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



        $this->load->view('artistic/art_post', $this->data);
    }

    public function art_manage_post($id = "") {

        $userid = $this->session->userdata('aileenuser');
        $user_name = $this->session->userdata('user_name');

        if ($id == $userid || $id == '') {

            $contition_array = array('user_id' => $userid, 'status' => '1');
            $this->data['artisticdata'] = $this->common->select_data_by_condition('art_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

            $this->data['userdata'] = $this->common->select_data_by_id('user', 'user_id', $userid, $data = '*', $join_str = array());

            $contition_array = array('user_id' => $userid, 'is_delete' => 0);
            $this->data['artsdata'] = $this->common->select_data_by_condition('art_post', $contition_array, $data = '*', $sortby = 'art_post_id', $orderby = 'DESC', $limit = '', $offset = '', $join_str = array(), $groupby = '');
        } else {

            $contition_array = array('user_id' => $id, 'status' => '1');
            $this->data['artisticdata'] = $this->common->select_data_by_condition('art_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');


            $this->data['userdata'] = $this->common->select_data_by_id('user', 'user_id', $id, $data = '*', $join_str = array());

            $contition_array = array('user_id' => $id, 'is_delete' => 0);
            $this->data['artsdata'] = $this->common->select_data_by_condition('art_post', $contition_array, $data = '*', $sortby = 'art_post_id', $orderby = 'DESC', $limit = '', $offset = '', $join_str = array(), $groupby = '');
        }
        //echo "<pre>"; print_r($this->data['artisticdata']); die();
        // code for search
        $contition_array = array('status' => '1', 'is_delete' => '0');


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


        $this->load->view('artistic/art_manage_post', $this->data);
    }

    public function art_addpost() {
        $userid = $this->session->userdata('aileenuser');
        $contition_array = array('user_id' => $userid, 'status' => '1');
        $this->data['artisticdata'] = $this->common->select_data_by_condition('art_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
        $this->load->view('artistic/art_addpost', $this->data);
    }

// khyati changes start
    //public function art_post_insert($id,$para) {
    public function art_post_insert($id = '', $para = '') {
        //echo $para; die();
        $userid = $this->session->userdata('aileenuser');


        if ($para == $userid || $para == '') {
            $data = array(
                'art_post' => $this->input->post('my_text'),
                'art_description' => $this->input->post('product_desc'),
                'created_date' => date('Y-m-d', time()),
                'status' => 1,
                'is_delete' => 0,
                'user_id' => $userid
            );
        } else {

            $data = array(
                'art_post' => $this->input->post('my_text'),
                'art_description' => $this->input->post('product_desc'),
                'created_date' => date('Y-m-d', time()),
                'status' => 1,
                'is_delete' => 0,
                'user_id' => $para,
                'posted_user_id' => $userid
            );
        }

        $insert_id = $this->common->insert_data_getid($data, 'art_post');
        //echo $insert_id; die(); 
        $config = array(
            'upload_path' => 'uploads/khyati_images/',
            'max_size' => 2500000000000,
            'allowed_types' => 'gif|jpeg|jpg|png|pdf|mp4|mp3'
                //'overwrite' => true,
                //'remove_spaces' => true
        );
        $images = array();
        $this->load->library('upload');

        $files = $_FILES;
        $count = count($_FILES['postattach']['name']);

        for ($i = 0; $i < $count; $i++) {

            $_FILES['postattach']['name'] = $files['postattach']['name'][$i];
            $_FILES['postattach']['type'] = $files['postattach']['type'][$i];
            $_FILES['postattach']['tmp_name'] = $files['postattach']['tmp_name'][$i];
            $_FILES['postattach']['error'] = $files['postattach']['error'][$i];
            $_FILES['postattach']['size'] = $files['postattach']['size'][$i];

            $fileName = $title . '_' . $_FILES['postattach']['name'];
            $images[] = $fileName;
            $config['file_name'] = $fileName;

            $this->upload->initialize($config);
            $this->upload->do_upload();
            if ($this->upload->do_upload('postattach')) {//echo "hello"; die();
                $return['data'][] = $this->upload->data();
                $return['status'] = "success";
                $return['msg'] = sprintf($this->lang->line('success_item_added'), "Image", "uploaded");


                $data = array(
                    'image_name' => $fileName,
                    'image_type' => 1,
                    'post_id' => $insert_id,
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
    }

    public function artistic_contactperson($id) {

        $userid = $this->session->userdata('aileenuser');
        $contition_array = array('user_id' => $id);
        $this->data['contactperson'] = $this->common->select_data_by_condition('art_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        $this->load->view('artistic/artistic_contactperson', $this->data);
    }

    public function artistic_contactperson_query($id) {


        $userid = $this->session->userdata('aileenuser');

        $contition_array = array('user_id' => $id);
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
            'created_date' => date('Y-m-d', time()),
            'status' => 1,
            'is_delete' => $userid,
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
            'not_from' => 3
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
            $config['upload_path'] = 'uploads/art_images/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif|mp4|3gp|mpeg|mpg|mpe|qt|mov|avi|pdf';

            $config['file_name'] = $_FILES['profilepic']['name'];

            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if ($this->upload->do_upload('profilepic')) {
                $uploadData = $this->upload->data();

                $picture = $uploadData['file_name'];
            } else {
                $picture = '';
            }

            $data = array(
                'art_user_image' => $picture,
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
                }
            } else {
                $this->session->flashdata('error', 'Your data not inserted');
                redirect('artistic/art_post', refresh);
            }
        }
    }

    public function artistic_profile($id) {

        $userid = $this->session->userdata('aileenuser');
        $this->data['id'] = $id;

        if ($id == $userid || $id == '') {

            $contition_array = array('user_id' => $userid, 'status' => '1');
            $this->data['artisticdata'] = $this->common->select_data_by_condition('art_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
        } else {

            $contition_array = array('user_id' => $id, 'status' => '1');
            $this->data['artisticdata'] = $this->common->select_data_by_condition('art_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
        }

// code for search
        $contition_array = array('status' => '1', 'is_delete' => '0');


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

        if (!empty($this->input->get("q"))) {
            $this->db->like('city_name', $this->input->get("q"));
            $query = $this->db->select('city_id as id,city_name as text')
                    ->order_by("city_name", "asc")
                    ->limit(10)
                    ->get("cities");
            $json = $query->result();
        }


        echo json_encode($json);
    }

//location automatic retrieve cobtroller End
// user list of artistic users

    public function userlist() {
        $this->data['userid'] = $userid = $this->session->userdata('aileenuser');
        $artdata = $this->data['artdata'] = $this->common->select_data_by_id('art_reg', 'user_id', $userid, $data = '*');

        $contition_array = array('user_id' => $userid, 'status' => '1');
        $this->data['artisticdata'] = $this->common->select_data_by_condition('art_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');


        $contition_array = array('is_delete' => 0, 'status' => 1, 'user_id !=' => $userid);
        $this->data['userlist'] = $this->common->select_data_by_condition('art_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');


        // followers count
        $join_str[0]['table'] = 'follow';
        $join_str[0]['join_table_id'] = 'follow.follow_to';
        $join_str[0]['from_table_id'] = 'art_reg.art_id';
        $join_str[0]['join_type'] = '';
        $contition_array = array('follow_to' => $artdata[0]['art_id'], 'follow_status' => 1, 'follow_type' => 1);

        $this->data['followers'] = count($this->common->select_data_by_condition('art_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str, $groupby = ''));

        // follow count end
        // fllowing count
        $join_str[0]['table'] = 'follow';
        $join_str[0]['join_table_id'] = 'follow.follow_from';
        $join_str[0]['from_table_id'] = 'art_reg.art_id';
        $join_str[0]['join_type'] = '';

        $contition_array = array('follow_from' => $artdata[0]['art_id'], 'follow_status' => 1, 'follow_type' => 1);

        $this->data['following'] = count($this->common->select_data_by_condition('art_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str, $groupby = ''));

        //following end
// code for search
        $contition_array = array('status' => '1', 'is_delete' => '0');


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


        $this->load->view('artistic/artistic_userlist', $this->data);
    }

    public function follow() {
        $userid = $this->session->userdata('aileenuser');

        $art_id = $_POST["follow_to"];

        $artdata = $this->common->select_data_by_id('art_reg', 'user_id', $userid, $data = '*');

        $contition_array = array('follow_type' => 1, 'follow_from' => $artdata[0]['art_id'], 'follow_to' => $art_id);
        $follow = $this->common->select_data_by_condition('follow', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
        //  echo "<pre>"; print_r($follow); die();

        $contition_array = array('art_id' => $art_id, 'status' => 1, 'is_delete' => 0);
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
                'not_from' => 3
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
                'not_from' => 3
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
                'not_from' => 3
            );

            $insert_id = $this->common->insert_data_getid($data, 'notification');
            // end notoification


            if ($update) {


                $follow = '<div class=" user_btn_f follow_btn_' . $art_id . '" id= "unfollowdiv">';
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
                'not_from' => 3
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


            $contition_array = array('user_id' => $id, 'status' => '1', 'is_delete' => '0');
            $this->data['artisticdata'] = $this->common->select_data_by_condition('art_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');


            $artdata = $this->common->select_data_by_id('art_reg', 'user_id', $id, $data = '*');


            $join_str[0]['table'] = 'follow';
            $join_str[0]['join_table_id'] = 'follow.follow_to';
            $join_str[0]['from_table_id'] = 'art_reg.art_id';
            $join_str[0]['join_type'] = '';

            $contition_array = array('follow_to' => $artdata[0]['art_id'], 'follow_status' => 1, 'follow_type' => 1, 'follow_status' => 1);

            $this->data['userlist'] = $this->common->select_data_by_condition('art_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str, $groupby = '');
        }
// code for search
        $contition_array = array('status' => '1', 'is_delete' => '0');


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

        $this->load->view('artistic/art_followers', $this->data);
    }

    public function following($id = "") {

        $this->data['userid'] = $userid = $this->session->userdata('aileenuser');

        if ($id == $userid || $id == '') {


            $artdata = $this->common->select_data_by_id('art_reg', 'user_id', $userid, $data = '*');

            $contition_array = array('user_id' => $userid, 'status' => '1');
            $this->data['artisticdata'] = $this->common->select_data_by_condition('art_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');


            $join_str[0]['table'] = 'follow';
            $join_str[0]['join_table_id'] = 'follow.follow_from';
            $join_str[0]['from_table_id'] = 'art_reg.art_id';
            $join_str[0]['join_type'] = '';

            $contition_array = array('follow_from' => $artdata[0]['art_id'], 'follow_status' => 1, 'follow_type' => 1);

            $this->data['userlist'] = $this->common->select_data_by_condition('art_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str, $groupby = '');
        } else {


            $artdata = $this->common->select_data_by_id('art_reg', 'user_id', $id, $data = '*');

            $contition_array = array('user_id' => $id, 'status' => '1');
            $this->data['artisticdata'] = $this->common->select_data_by_condition('art_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');


            $join_str[0]['table'] = 'follow';
            $join_str[0]['join_table_id'] = 'follow.follow_from';
            $join_str[0]['from_table_id'] = 'art_reg.art_id';
            $join_str[0]['join_type'] = '';

            $contition_array = array('follow_from' => $artdata[0]['art_id'], 'follow_status' => 1, 'follow_type' => 1);

            $this->data['userlist'] = $this->common->select_data_by_condition('art_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str, $groupby = '');
        }
// code for search
        $contition_array = array('status' => '1', 'is_delete' => '0');


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





        $this->load->view('artistic/art_following', $this->data);
    }

// end of user lidt
    //deactivate user start
    public function deactivate($id) {

        $data = array(
            'status' => 0
        );

        $update = $this->common->update_data($data, 'art_reg', 'user_id', $id);

        if ($update) {

            $this->session->set_flashdata('success', 'You are deactivate successfully.');
            redirect('dashboard', 'refresh');
        } else {
            $this->session->flashdata('error', 'Sorry!! Your are not deactivate!!');
            redirect('artistic', 'refresh');
        }
    }

// deactivate user end
//Artistic Profile Save Post Start
    public function artistic_save() {

        $userid = $this->session->userdata('aileenuser');

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
                'created_date' => date('Y-m-d h:i:s', time()),
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

            $contition_array = array('user_id' => $id, 'status' => '1');
            $this->data['artisticdata'] = $this->common->select_data_by_condition('art_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');


            $this->data['userdata'] = $this->common->select_data_by_id('user', 'user_id', $id, $data = '*', $join_str = array());

            $contition_array = array('user_id' => $id);
            $this->data['artsdata'] = $this->common->select_data_by_condition('art_post', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
        }

//artistics mange post data end
// code for search
        $contition_array = array('status' => '1', 'is_delete' => '0');


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

        $this->load->view('artistic/art_savepost', $this->data);
    }

//Artistic Profile Save Post shown End
//Artistic  Profile Remove Save Post Start
    public function art_remove_save() {

        $id = $_POST['save_id'];
        $userid = $this->session->userdata('aileenuser');

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
                $data = array(
                    'not_type' => 5,
                    'not_from_id' => $userid,
                    'not_to_id' => $artdata[0]['user_id'],
                    'not_read' => 2,
                    'not_product_id' => $post_id,
                    'not_from' => 3,
                    'not_img' => 3
                );

                $insert_id = $this->common->insert_data_getid($data, 'notification');
            }
            // end notoification


            $contition_array = array('artistic_post_comment_id' => $_POST["post_id"], 'status' => '1');
            $artdata1 = $this->data['artdata1'] = $this->common->select_data_by_condition('artistic_post_comment', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

            if ($updatdata) {

                //$cmtlike1 = '<div>';
                $cmtlike1 = '<a id="' . $artdata1[0]['artistic_post_comment_id'] . '" onClick="comment_like(this.id)">';
                $cmtlike1 .= ' <i class="fa fa-thumbs-up" aria-hidden="true">';
                $cmtlike1 .= '</i>';
                $cmtlike1 .= '<span>';

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
                $cmtlike1 .= '<i class="fa fa-thumbs-o-up fa-1x" aria-hidden="true">';
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
                $data = array(
                    'not_type' => 5,
                    'not_from_id' => $userid,
                    'not_to_id' => $artdata[0]['user_id'],
                    'not_read' => 2,
                    'not_product_id' => $post_id,
                    'not_from' => 3,
                    'not_img' => 3
                );

                $insert_id = $this->common->insert_data_getid($data, 'notification');
            }
            // end notoification


            $contition_array = array('artistic_post_comment_id' => $_POST["post_id"], 'status' => '1');
            $artdata1 = $this->data['artdata1'] = $this->common->select_data_by_condition('artistic_post_comment', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

            if ($updatdata) {

                //$cmtlike1 = '<div>';
                $cmtlike1 = '<a id="' . $artdata1[0]['artistic_post_comment_id'] . '" onClick="comment_like1(this.id)">';
                $cmtlike1 .= ' <i class="fa fa-thumbs-up" aria-hidden="true">';
                $cmtlike1 .= '</i>';
                $cmtlike1 .= '<span>';

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
                $cmtlike1 .= '<i class="fa fa-thumbs-o-up fa-1x" aria-hidden="true">';
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
                $cmtinsert .= '<div class="post-design-pro-comment-img">';


                $cmtinsert .= '<img  src="' . base_url(ARTISTICIMAGE . $art_userimage) . '" alt="">  </div>';

                $cmtinsert .= '<div class="comment-name"><b>' . ucwords($artname) . '&nbsp;' . ucwords($artlastname) . '</b>';
                $cmtinsert .= '</div>';
                $cmtinsert .= '<div class="comment-details" id="showcomment' . $art['artistic_post_comment_id'] . '" >';
                $cmtinsert .= $art['comments'];
                $cmtinsert .= '</div>';
                $cmtinsert .= '<div class="edit-comment-box"><div class="inputtype-edit-comment">';

//            $cmtinsert .= '<textarea  name="' . $art['artistic_post_comment_id'] . '" id="editcomment' . $art['artistic_post_comment_id'] . '" style="display:none" onClick="commentedit(this.name)">';
//            $cmtinsert .= '' . $art['comments'] . '';
//            $cmtinsert .= '</textarea>';

                $cmtinsert .= '<div contenteditable="true" style="display:none; min-height:37px !important; margin-top: 0px!important; margin-left: 1.5% !important; width: 81%;" class="editable_text" name="' . $art['artistic_post_comment_id'] . '"  id="editcomment' . $art['artistic_post_comment_id'] . '" placeholder="Type Message ..." value= ""  onkeyup="commentedit(' . $art['artistic_post_comment_id'] . ')">' . $art['comments'] . '</div>';
                $cmtinsert .= '<span class="comment-edit-button"><button id="editsubmit' . $art['artistic_post_comment_id'] . '" style="display:none" onClick="edit_comment(' . $art['artistic_post_comment_id'] . ')">Save</button></span>';
                $cmtinsert .= '</div></div>';

//                $cmtinsert .= '<button id="editsubmit' . $art['artistic_post_comment_id'] . '" style="display:none" onClick="edit_comment(' . $art['artistic_post_comment_id'] . ')">Comment</button><div class="art-comment-menu-design"> <div class="comment-details-menu" id="likecomment1' . $art['artistic_post_comment_id'] . '">';

                $cmtinsert .= '<div class="art-comment-menu-design"><div class="comment-details-menu" id="likecomment1' . $art['artistic_post_comment_id'] . '">';
                $cmtinsert .= '<a id="' . $art['artistic_post_comment_id'] . '"';
                $cmtinsert .= 'onClick="comment_like1(this.id)">';

                $userid = $this->session->userdata('aileenuser');
                $contition_array = array('artistic_post_comment_id' => $art['artistic_post_comment_id'], 'status' => '1');
                $artcommentlike = $this->data['artcommentlike'] = $this->common->select_data_by_condition('artistic_post_comment', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
                $likeuserarray = explode(',', $artcommentlike[0]['artistic_comment_like_user']);

                if (!in_array($userid, $likeuserarray)) {


                    $cmtinsert .= '<i class="fa fa-thumbs-o-up fa-1x" aria-hidden="true"></i>';
                } else {
                    $cmtinsert .= '<i class="fa fa-thumbs-up" aria-hidden="true"></i>';
                }
                $cmtinsert .= '<span>';

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
                    $cmtinsert .= '<input type="hidden" name="post_delete"';
                    $cmtinsert .= 'id="post_delete"';
                    $cmtinsert .= 'value= "' . $art['art_post_id'] . '">';

                    $cmtinsert .= '<a id="' . $art['artistic_post_comment_id'] . '"';
                    $cmtinsert .= 'onClick="comment_delete(this.id)">';
                    $cmtinsert .= 'Delete';
                    $cmtinsert .= '</a></div>';
                }
                $cmtinsert .= '<span role="presentation" aria-hidden="true"> · </span>';
                $cmtinsert .= '<div class="comment-details-menu">';
                $cmtinsert .= '<p>' . $art['created_date'] . '</p></div></div></div>';

                $cmtcount = '<a onclick="commentall(this.id)" id="' . $art['art_post_id'] . '">';
                $cmtcount .= '<i class="fa fa-comment-o" aria-hidden="true">' .
                        count($allcomnt) . '</i></a>';
            }
        } else {
            $cmtcount = '<a onClick="commentall(this.id)" id="' . $art['art_post_id'] . '">';
            $cmtcount .= '<i class="fa fa-comment-o" aria-hidden="true">';
            $cmtcount .= '</i></a>';
        }
        echo json_encode(
                array("comment" => $cmtinsert,
                    "count" => $cmtcount));
    }

    public function delete_commenttwo() {
        $userid = $this->session->userdata('aileenuser');
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
                $cmtinsert .= '<div class="post-design-pro-comment-img">';


                $cmtinsert .= '<img  src="' . base_url(ARTISTICIMAGE . $art_userimage) . '" alt="">  </div>';

                $cmtinsert .= '<div class="comment-name"><b>' . ucwords($artname) . '&nbsp;' . ucwords($artlastname) . '</b>';
                $cmtinsert .= '</div>';
                $cmtinsert .= '<div class="comment-details" id= "showcommenttwo' . $art['artistic_post_comment_id'] . '" >';
                $cmtinsert .= $art['comments'];
                $cmtinsert .= '</div>';

                $cmtinsert .= '<div class="edit-comment-box"><div class="inputtype-edit-comment">';
//            $cmtinsert .= '<textarea  name="' . $art['artistic_post_comment_id'] . '" id="editcommenttwo' . $art['artistic_post_comment_id'] . '" style="display:none" onClick="commentedittwo(this.name)">';
//            $cmtinsert .= '' . $art['comments'] . '';
//            $cmtinsert .= '</textarea>';
                $cmtinsert .= '<div contenteditable="true" style="display:none; min-height:37px !important; margin-top: 0px!important; margin-left: 1.5% !important; width: 81%;" class="editable_text" name="' . $art['artistic_post_comment_id'] . '"  id="editcommenttwo' . $art['artistic_post_comment_id'] . '" placeholder="Type Message ..." value= ""  onkeyup="commentedittwo(' . $art['artistic_post_comment_id'] . ')">' . $art['comments'] . '</div>';
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


                    $cmtinsert .= '<i class="fa fa-thumbs-o-up fa-1x" aria-hidden="true"></i>';
                } else {
                    $cmtinsert .= '<i class="fa fa-thumbs-up" aria-hidden="true"></i>';
                }
                $cmtinsert .= '<span>';

                if ($art['artistic_comment_likes_count'] > 0) {
                    $cmtinsert .= '' . $art['artistic_comment_likes_count'];
                }
                $cmtinsert .= '</span>';
                $cmtinsert .= '</a></div>';

                $userid = $this->session->userdata('aileenuser');
                if ($art['user_id'] == $userid) {

                    $cmtinsert .= '<span role="presentation" aria-hidden="true"> · </span>';
                    $cmtinsert .= '<div class="comment-details-menu">';


                    $cmtinsert .= '<div id="editboxtwo' . $art['artistic_post_comment_id'] . '" style="display:block;">';
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
                $cmtinsert .= '<p>' . $art['created_date'] . '</p></div></div></div>';

                // comment aount variable start
                $idpost = $art['art_post_id'];
                $cmtcount = '<a onClick="commentall1(this.id)" id="' . $idpost . '">';
                $cmtcount .= '<i class="fa fa-comment-o" aria-hidden="true">';
                $cmtcount .= ' ' . count($artdata) . '';
                $cmtcount .= '</i></a>';
            }
        } else {
            $idpost = $art['art_post_id'];
            $cmtcount = '<a onClick="commentall1(this.id)" id="' . $idpost . '">';
            $cmtcount .= '<i class="fa fa-comment-o" aria-hidden="true">';
            $cmtcount .= '</i></a>';
        }
        //echo $cmtinsert;
        echo json_encode(
                array("comment" => $cmtinsert,
                    "count" => $cmtcount));
    }

//Artistic comment delete end
// artistics post like start

    public function like_post() {

        $userid = $this->session->userdata('aileenuser');
        $post_id = $_POST["post_id"];

        $contition_array = array('art_post_id' => $_POST["post_id"], 'status' => '1');
        $artdata = $this->data['artdata'] = $this->common->select_data_by_condition('art_post', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        $art_likes_count = $artdata[0]['art_likes_count'];
        $likeuserarray = explode(',', $artdata[0]['art_like_user']);

        if (!in_array($userid, $likeuserarray)) {

            $user_array = array_push($likeuserarray, $userid);

            if ($artdata[0]['art_likes_count'] == 0) {
                $userid = implode('', $likeuserarray);
            } else {
                $userid = implode(',', $likeuserarray);
            }

            $data = array(
                'art_likes_count' => $art_likes_count + 1,
                'art_like_user' => $userid,
                'modifiled_date' => date('y-m-d h:i:s')
            );


            $updatdata = $this->common->update_data($data, 'art_post', 'art_post_id', $post_id);



            // insert notification

            if ($artdata[0]['user_id'] == $userid) {
                
            } else {
                $data = array(
                    'not_type' => 5,
                    'not_from_id' => $userid,
                    'not_to_id' => $artdata[0]['user_id'],
                    'not_read' => 2,
                    'not_product_id' => $post_id,
                    'not_from' => 3,
                    'not_img' => 2
                );

                $insert_id = $this->common->insert_data_getid($data, 'notification');
            }
            // end notoification



            $contition_array = array('art_post_id' => $_POST["post_id"], 'status' => '1');
            $artdata1 = $this->data['artdata1'] = $this->common->select_data_by_condition('art_post', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

            if ($updatdata) {

                $cmtlike = '<li>';
                $cmtlike .= '<a id="' . $artdata1[0]['art_post_id'] . '" onClick="post_like(this.id)">';
                $cmtlike .= ' <i class="fa fa-thumbs-up" aria-hidden="true">';
                $cmtlike .= '</i>';
                $cmtlike .= '<span>';
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
                $cmtlikeuser .= ' <a href="javascript:void(0);"  onclick="likeuserlist(' . $artdata1[0]['art_post_id'] . ');">';
                $contition_array = array('art_post_id' => $artdata1[0]['art_post_id'], 'status' => '1', 'is_delete' => '0');
                $commnetcount = $this->common->select_data_by_condition('art_post', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

                $likeuser = $commnetcount[0]['art_like_user'];
                $countlike = $commnetcount[0]['art_likes_count'] - 1;

                $likelistarray = explode(',', $likeuser);

                $art_fname = $this->db->get_where('art_reg', array('user_id' => $likelistarray[0], 'status' => 1))->row()->art_name;

                $art_lname = $this->db->get_where('art_reg', array('user_id' => $likelistarray[0], 'status' => 1))->row()->art_lastname;

                //$cmtlikeuser .= '<div class="fl" style=" padding-left: 22px;" >';
                $cmtlikeuser .= '<div class="like_one_other">';

                $cmtlikeuser .= '' . ucwords($art_fname) . '&nbsp;' . ucwords($art_lname) . '&nbsp;';

                $cmtlikeuser .= '</div>';


                if (count($likelistarray) > 1) {

                    // $cmtlikeuser .= '<div class="fl" style="padding-right: 5px;">';
                    $cmtlikeuser .= 'and';
                    // $cmtlikeuser .= '</div>';
                    // $cmtlikeuser .= '<div style="padding-left: 5px;">';
                    $cmtlikeuser .= ' ' . $countlike . ' others';
                    // $cmtlikeuser .= '</div>';
                }

                $cmtlikeuser .= '</a>';

                $like_user_count = $commnetcount[0]['art_likes_count'];
                echo json_encode(
                        array("like" => $cmtlike,
                            "likeuser" => $cmtlikeuser,
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

                $cmtlike .= '<a id="' . $artdata2[0]['art_post_id'] . '" onClick="post_like(this.id)">';

                $cmtlike .= ' <i class="fa fa-thumbs-o-up fa-1x" aria-hidden="true">';
                $cmtlike .= '</i>';

                $cmtlike .= '<span>';
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
                $cmtlikeuser .= ' <a href="javascript:void(0);"  onclick="likeuserlist(' . $artdata1[0]['art_post_id'] . ');">';

                $contition_array = array('art_post_id' => $artdata1[0]['art_post_id'], 'status' => '1', 'is_delete' => '0');
                $commnetcount = $this->common->select_data_by_condition('art_post', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

                $likeuser = $commnetcount[0]['art_like_user'];
                $countlike = $commnetcount[0]['art_likes_count'] - 1;

                $likelistarray = explode(',', $likeuser);

                $art_fname12 = $this->db->get_where('art_reg', array('user_id' => $likelistarray[0], 'status' => 1))->row()->art_name;
                $art_lname12 = $this->db->get_where('art_reg', array('user_id' => $likelistarray[0], 'status' => 1))->row()->art_lastname;

                //$cmtlikeuser .= '<div class="fl" style=" padding-left: 22px;" >';
                $cmtlikeuser .= '<div class="like_one_other">';
                $cmtlikeuser .= '' . ucwords($art_fname12) . '&nbsp;' . ucwords($art_lname12) . '&nbsp;';
                $cmtlikeuser .= '</div>';
                if (count($likelistarray) > 1) {

                    //    $cmtlikeuser .= '<div class="fl" style="padding-right: 5px;">';
                    $cmtlikeuser .= 'and';
                    //    $cmtlikeuser .= '</div>';
                    //    $cmtlikeuser .= '<div style="padding-left: 5px;">';
                    $cmtlikeuser .= ' ' . $countlike . ' others';
                    //   $cmtlikeuser .= '</div>';
                }
                $cmtlikeuser .= '</a>';

                $like_user_count = $commnetcount[0]['art_likes_count'];

                echo json_encode(
                        array("like" => $cmtlike,
                            "likeuser" => $cmtlikeuser,
                            "like_user_count" => $like_user_count));
            }
        }
    }

// artistics post  like end
//artistic comment insert start

    public function insert_comment() {

        $userid = $this->session->userdata('aileenuser');

        $post_id = $_POST["post_id"];
        $post_comment = $_POST["comment"];

        $contition_array = array('art_post_id' => $_POST["post_id"], 'status' => '1');
        $artdatacomment = $this->data['artdatacomment'] = $this->common->select_data_by_condition('art_post', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        $data = array(
            'user_id' => $userid,
            'art_post_id' => $post_id,
            'comments' => $post_comment,
            'created_date' => date('Y-m-d', time()),
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
                'not_img' => 1
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
            $cmtinsert .= '<div class="post-design-pro-comment-img">';
            $cmtinsert .= '<img  src="' . base_url(ARTISTICIMAGE . $art_userimage) . '" alt="">  </div>';
            $cmtinsert .= '<div class="comment-name"><b>' . ucwords($artname) . '&nbsp;' . ucwords($artlastname) . '</b>';
            $cmtinsert .= '</div>';
            $cmtinsert .= '<div class="comment-details" id= "showcommenttwo' . $art['artistic_post_comment_id'] . '" >';
            $cmtinsert .= $art['comments'];
            $cmtinsert .= '</div>';
            $cmtinsert .= '<div class="edit-comment-box"><div class="inputtype-edit-comment">';
//            $cmtinsert .= '<textarea  name="' . $art['artistic_post_comment_id'] . '" id="editcommenttwo' . $art['artistic_post_comment_id'] . '" style="display:none" onClick="commentedittwo(this.name)">';
//            $cmtinsert .= '' . $art['comments'] . '';
//            $cmtinsert .= '</textarea>';
            $cmtinsert .= '<div contenteditable="true" style="display:none; min-height:37px !important; margin-top: 0px!important; margin-left: 1.5% !important; width: 81%;" class="editable_text" name="' . $art['artistic_post_comment_id'] . '"  id="editcommenttwo' . $art['artistic_post_comment_id'] . '" placeholder="Type Message ..." value= ""  onkeyup="commentedittwo(' . $art['artistic_post_comment_id'] . ')">' . $art['comments'] . '</div>';
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


                $cmtinsert .= '<i class="fa fa-thumbs-o-up fa-1x" aria-hidden="true"></i>';
            } else {
                $cmtinsert .= '<i class="fa fa-thumbs-up" aria-hidden="true"></i>';
            }
            $cmtinsert .= '<span>';

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
            $cmtinsert .= '<p>' . $art['created_date'] . '</p></div></div></div>';
            
            
            // comment aount variable start
            $idpost = $art['art_post_id'];
            $cmtcount = '<a onClick="commentall(this.id)" id="' . $idpost . '">';
            $cmtcount .= '<i class="fa fa-comment-o" aria-hidden="true">';
            $cmtcount .= ' ' . count($artdata) . '';
            $cmtcount .= '</i></a>';

        }
        //echo $cmtinsert;
        echo json_encode(
                array("comment" => $cmtinsert,
                    "count" => $cmtcount));
        // khyati chande 
    }

    public function insert_commentthree() {

        $userid = $this->session->userdata('aileenuser');

        $post_id = $_POST["post_id"];
        $post_comment = $_POST["comment"];


        $contition_array = array('art_post_id' => $_POST["post_id"], 'status' => '1');
        $artdatacomment = $this->data['artdatacomment'] = $this->common->select_data_by_condition('art_post', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
        
        $data = array(
            'user_id' => $userid,
            'art_post_id' => $post_id,
            'comments' => $post_comment,
            'created_date' => date('Y-m-d', time()),
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
                'not_img' => 1
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
            $cmtinsert .= '<div class="post-design-pro-comment-img">';


            $cmtinsert .= '<img  src="' . base_url(ARTISTICIMAGE . $art_userimage) . '" alt="">  </div>';

            $cmtinsert .= '<div class="comment-name"><b>' . ucwords($artname) . '&nbsp;' . ucwords($artlastname) . '</b>';
            $cmtinsert .= '</div>';
            $cmtinsert .= '<div class="comment-details" id= "showcomment' . $art['artistic_post_comment_id'] . '" >';
            $cmtinsert .= $art['comments'];
            $cmtinsert .= '</div>';
            $cmtinsert .= '<div class="edit-comment-box"><div class="inputtype-edit-comment">';
            $cmtinsert .= '<div contenteditable="true" class="editable_text"  name="' . $art['artistic_post_comment_id'] . '" id="editcomment' . $art['artistic_post_comment_id'] . '" style="display:none; min-height:37px !important; margin-top: 0px!important; margin-left: 1.5% !important; width: 81%;" onkeyup="commentedit(' . $art['artistic_post_comment_id'] . ')">';
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


                $cmtinsert .= '<i class="fa fa-thumbs-o-up fa-1x" aria-hidden="true"></i>';
            } else {
                $cmtinsert .= '<i class="fa fa-thumbs-up" aria-hidden="true"></i>';
            }
            $cmtinsert .= '<span>';

            if ($art['artistic_comment_likes_count'] > 0) {
                $cmtinsert .= '' . $art['artistic_comment_likes_count'];
            }
            $cmtinsert .= '</span>';
            $cmtinsert .= '</a></div>';

            $userid = $this->session->userdata('aileenuser');
            if ($art['user_id'] == $userid) {

                $cmtinsert .= '<span role="presentation" aria-hidden="true"> · </span>';
                $cmtinsert .= '<div class="comment-details-menu">';
                $cmtinsert .= '<div id="editbox' . $art['artistic_post_comment_id'] . '" style="display:block;">';
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

                $cmtinsert .= '<input type="hidden" name="post_delete"';
                $cmtinsert .= 'id="post_delete"';
                $cmtinsert .= 'value= "' . $art['art_post_id'] . '">';

                $cmtinsert .= '<a id="' . $art['artistic_post_comment_id'] . '"';
                $cmtinsert .= 'onClick="comment_delete(this.id)">';
                $cmtinsert .= 'Delete';
                $cmtinsert .= '</a></div>';
            }

            $cmtinsert .= '<span role="presentation" aria-hidden="true"> · </span>';
            $cmtinsert .= '<div class="comment-details-menu">';
            $cmtinsert .= '<p>' . $art['created_date'] . '</p></div></div></div>';
            $cntinsert = '<a onclick="commentall(this.id)" id="' . $art['art_post_id'] . '">';
            $cntinsert .= '<i class="fa fa-comment-o" aria-hidden="true">' .
                    count($allcomnt) . '</i>';
        }
        echo json_encode(
                array("count" => $cntinsert,
                    "comment" => $cmtinsert));

        // khyati chande 
    }

//artistic comment insert end  
//artistic comment edit start
    public function edit_comment_insert() {

        $userid = $this->session->userdata('aileenuser');

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
            $cmtlike = $artdata[0]['comments'] . "<br>";
            //   $cmtlike .= '</div>';
            echo $cmtlike;
        }
    }

//artistic comment edit end 
// cover pic controller

    public function ajaxpro() {
        $userid = $this->session->userdata('aileenuser');

        $data = $_POST['image'];


        $imageName = time() . '.png';
        $base64string = $data;
        file_put_contents('uploads/art_bg/' . $imageName, base64_decode(explode(',', $base64string)[1]));
        $data = array(
            'profile_background' => $imageName
        );

        $update = $this->common->update_data($data, 'art_reg', 'user_id', $userid);

        $this->data['artdata'] = $this->common->select_data_by_id('art_reg', 'user_id', $userid, $data = '*', $join_str = array());

        echo '<img src="' . $this->data['artdata'][0]['profile_background'] . '" />';
    }

    public function image() {
        $userid = $this->session->userdata('aileenuser');

        $config['upload_path'] = 'uploads/art_bg';
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
    public function postnewpage($data = '', $id = '') {
        $userid = $this->session->userdata('aileenuser');
        $contition_array = array('user_id' => $userid, 'status' => '1');
        $this->data['artisticdata'] = $this->common->select_data_by_condition('art_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        $contition_array = array('art_post_id' => $id, 'status' => '1');
        $this->data['art_data'] = $this->common->select_data_by_condition('art_post', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        //echo "<pre>"; print_r($this->data['art_data']);die();
        $this->load->view('artistic/postnewpage', $this->data);
    }

// click on post after post open on new page end
//edit post start

    public function edit_post_insert() {

        $userid = $this->session->userdata('aileenuser');

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
                $editpost .= $artdata[0]['art_post'] . "<br>";
                $editpost .= '</a></div>';
            }
            if ($this->data['artdata'][0]['art_description']) {

                $editpostdes = '<div>';
                $editpostdes .= $artdata[0]['art_description'] . "<br>";
                $editpostdes .= '</div>';
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
    }

//delete post particular user end  
//multiple images for user start


    public function art_photos($id = "") {


        $userid = $this->session->userdata('aileenuser');
        $contition_array = array('user_id' => $userid, 'status' => '1');


        if ($id == $userid || $id == '') {

            $contition_array = array('user_id' => $userid, 'status' => '1');

            $artisticdata = $this->data['artisticdata'] = $this->common->select_data_by_condition('art_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
            //  echo "<pre>"; print_r($artisticdata); die();



            $join_str[0]['table'] = 'post_image';
            $join_str[0]['join_table_id'] = 'post_image.post_id';
            $join_str[0]['from_table_id'] = 'art_post.art_post_id';
            $join_str[0]['join_type'] = '';

            $contition_array = array('user_id' => $artisticdata[0]['user_id'], 'status' => 1, 'is_delete' => '0');

            $this->data['artistic_data'] = $this->common->select_data_by_condition('art_post', $contition_array, $data, $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str, $groupby = '');
        } else {

            $contition_array = array('user_id' => $id, 'status' => '1');


            $artisticdata = $this->data['artisticdata'] = $this->common->select_data_by_condition('art_post', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');



            $join_str[0]['table'] = 'post_image';
            $join_str[0]['join_table_id'] = 'post_image.post_id';
            $join_str[0]['from_table_id'] = 'art_post.art_post_id';
            $join_str[0]['join_type'] = '';


            $contition_array = array('user_id' => $artisticdata[0]['user_id'], 'status' => 1, 'is_delete' => '0');

            $this->data['artistic_data'] = $this->common->select_data_by_condition('art_post', $contition_array, $data, $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str, $groupby = '');
        }

        $this->load->view('artistic/art_photos', $this->data);
    }

//multiple images for user end   
//multiple videos for user start


    public function art_videos($id) {

        $userid = $this->session->userdata('aileenuser');
        $contition_array = array('user_id' => $userid, 'status' => '1');


        if ($id == $userid || $id == '') {

            $contition_array = array('user_id' => $userid, 'status' => '1');
            $artisticdata = $this->data['artisticdata'] = $this->common->select_data_by_condition('art_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
            //echo "<pre>"; print_r($artisticdata); die();
            $contition_array = array('user_id' => $artisticdata[0]['user_id'], 'status' => 1, 'is_delete' => '0');

            $this->data['artistic_data'] = $this->common->select_data_by_condition('art_post', $contition_array, $data, $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
        } else {

            $contition_array = array('user_id' => $id, 'status' => '1');
            $artisticdata = $this->data['artisticdata'] = $this->common->select_data_by_condition('art_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

            $contition_array = array('user_id' => $artisticdata[0]['user_id'], 'status' => 1, 'is_delete' => '0');

            $this->data['artistic_data'] = $this->common->select_data_by_condition('art_post', $contition_array, $data, $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
        }

        $this->load->view('artistic/art_videos', $this->data);
    }

//multiple videos for user end 
//multiple audios for user start


    public function art_audios($id) {

        $userid = $this->session->userdata('aileenuser');
        $contition_array = array('user_id' => $userid, 'status' => '1');


        if ($id == $userid || $id == '') {

            $contition_array = array('user_id' => $userid, 'status' => '1');
            $artisticdata = $this->data['artisticdata'] = $this->common->select_data_by_condition('art_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
            //echo "<pre>"; print_r($artisticdata); die();
            $contition_array = array('user_id' => $artisticdata[0]['user_id'], 'status' => 1, 'is_delete' => '0');

            $this->data['artistic_data'] = $this->common->select_data_by_condition('art_post', $contition_array, $data, $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
        } else {

            $contition_array = array('user_id' => $id, 'status' => '1');
            $artisticdata = $this->data['artisticdata'] = $this->common->select_data_by_condition('art_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

            $contition_array = array('user_id' => $artisticdata[0]['user_id'], 'status' => 1, 'is_delete' => '0');

            $this->data['artistic_data'] = $this->common->select_data_by_condition('art_post', $contition_array, $data, $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
        }
        $this->load->view('artistic/art_audios', $this->data);
    }

//multiple audios for user end  
//multiple pdf for user start


    public function art_pdf($id) {

        $userid = $this->session->userdata('aileenuser');
        $contition_array = array('user_id' => $userid, 'status' => '1');


        if ($id == $userid || $id == '') {

            $contition_array = array('user_id' => $userid, 'status' => '1');
            $artisticdata = $this->data['artisticdata'] = $this->common->select_data_by_condition('art_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
            //echo "<pre>"; print_r($artisticdata); die();
            $contition_array = array('user_id' => $artisticdata[0]['user_id'], 'status' => 1, 'is_delete' => '0');

            $this->data['artistic_data'] = $this->common->select_data_by_condition('art_post', $contition_array, $data, $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
        } else {

            $contition_array = array('user_id' => $id, 'status' => '1');
            $artisticdata = $this->data['artisticdata'] = $this->common->select_data_by_condition('art_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

            $contition_array = array('user_id' => $artisticdata[0]['user_id'], 'status' => 1, 'is_delete' => '0');

            $this->data['artistic_data'] = $this->common->select_data_by_condition('art_post', $contition_array, $data, $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
        }
        $this->load->view('artistic/art_pdf', $this->data);
    }

//multiple pdf for user end    
    // khyati 12-4 multiple images like start
    public function mulimg_like() {
        //$id = $_POST['save_id'];
        $post_image = $_POST['post_image_id'];
        $userid = $this->session->userdata('aileenuser');


        $contition_array = array('post_image_id' => $post_image, 'user_id' => $userid);

        $likeuser = $this->data['likeuser'] = $this->common->select_data_by_condition('art_post_image_like', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        $contition_array = array('image_id' => $post_image);

        $likeuserid = $this->data['likeuserid'] = $this->common->select_data_by_condition('post_image', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
        $contition_array = array('art_post_id' => $likeuserid[0]['post_id']);

        $likepostid = $this->data['likepostid'] = $this->common->select_data_by_condition('art_post', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');


        if (!$likeuser) {

            $data = array(
                'post_image_id' => $post_image,
                'user_id' => $userid,
                'created_date' => date('Y-m-d', time()),
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
                    'not_product_id' => $insert_id,
                    'not_from' => 3,
                    'not_img' => 5
                );

                $insert_id = $this->common->insert_data_getid($data, 'notification');
            }
            // end notoification

            $contition_array = array('post_image_id' => $_POST["post_image_id"], 'is_unlike' => '0');
            $bdata1 = $this->data['bdata1'] = $this->common->select_data_by_condition('art_post_image_like', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

            if ($insertdata) {

                $imglike = '<li>';
                $imglike .= '<a id="' . $post_image . '" onClick="mulimg_like(this.id)">';
                $imglike .= ' <i class="fa fa-thumbs-up" aria-hidden="true">';
                $imglike .= '</i>';
                $imglike .= '<span>';
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


                $updatdata = $this->common->update_data($data, 'art_post_image_like', 'post_image_id', $post_image);

                $contition_array = array('post_image_id' => $_POST["post_image_id"], 'is_unlike' => '0');
                $bdata2 = $this->data['bdata2'] = $this->common->select_data_by_condition('art_post_image_like', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');



                if ($updatdata) {

                    $imglike1 = '<li>';
                    $imglike1 .= '<a id="' . $post_image . '" onClick="mulimg_like(this.id)">';
                    $imglike1 .= '<i class="fa fa-thumbs-o-up fa-1x" aria-hidden="true">';
                    $imglike1 .= '</i>';
                    $imglike1 .= '<span>';
                    if (count($bdata2) > 0) {
                        $imglike1 .= count($bdata2) . '';
                    }
                    $imglike1 .= '</span>';
                    $imglike1 .= '</a>';
                    $imglike1 .= '</li>';

                    echo $imglike1;
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
                    $data = array(
                        'not_type' => 5,
                        'not_from_id' => $userid,
                        'not_to_id' => $likepostid[0]['user_id'],
                        'not_read' => 2,
                        'not_product_id' => $post_image_id,
                        'not_from' => 3,
                        'not_img' => 5
                    );

                    $insert_id = $this->common->insert_data_getid($data, 'notification');
                }
                // end notoification


                $contition_array = array('post_image_id' => $_POST["post_image_id"], 'is_unlike' => '0');
                $bdata2 = $this->data['bdata2'] = $this->common->select_data_by_condition('art_post_image_like', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');



                if ($updatdata) {

                    $imglike1 = '<li>';
                    $imglike1 .= '<a id="' . $post_image . '" onClick="mulimg_like(this.id)">';
                    $imglike1 .= '<i class="fa fa-thumbs-up" aria-hidden="true">';
                    $imglike1 .= '</i>';
                    $imglike1 .= '<span>';
                    if (count($bdata2) > 0) {
                        $imglike1 .= count($bdata2) . '';
                    }
                    $imglike1 .= '</span>';
                    $imglike1 .= '</a>';
                    $imglike1 .= '</li>';

                    echo $imglike1;
                }
            }
        }
    }

//multiple iamges like end 
//multiple images comment strat

    public function mulimg_commentthree() {

        $userid = $this->session->userdata('aileenuser');

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
            'created_date' => date('Y-m-d', time()),
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
                'not_img' => 4
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
            $cmtinsert .= '<div class="post-design-pro-comment-img">';
            $cmtinsert .= '<img  src="' . base_url(ARTISTICIMAGE . $art_userimage) . '" alt="">  </div>';

            $cmtinsert .= '<div class="comment-name"><b>' . $art_name . '</b>';
            $cmtinsert .= '</div>';

            $cmtinsert .= '<div class="comment-details" id= "showcomment' . $art_comment['post_image_comment_id'] . '"" >';
            $cmtinsert .= $art_comment['comment'];
            $cmtinsert .= '</div>';
            $cmtinsert .= '<div contenteditable="true" class="editable_text" name="' . $art_comment['post_image_comment_id'] . '" id="editcomment' . $art_comment['post_image_comment_id'] . '"style="display:none;" onkeyup="commentedit(' . $art_comment['post_image_comment_id'] . ')">';

            $cmtinsert .= '' . $art_comment['comment'] . '';
            $cmtinsert .= '</div>';

            $cmtinsert .= '<button id="editsubmit' . $art_comment['post_image_comment_id'] . '" style="display:none;" onClick="edit_comment(' . $art_comment['post_image_comment_id'] . ')">Comment</button><div class="art-comment-menu-design"> <div class="comment-details-menu" id="likecomment' . $art_comment['post_image_comment_id'] . '">';

            $cmtinsert .= '<a id="' . $art_comment['post_image_comment_id'] . '"';
            $cmtinsert .= 'onClick="comment_like(this.id)">';

            $contition_array = array('post_image_comment_id' => $art_comment['post_image_comment_id'], 'user_id' => $userid, 'is_unlike' => 0);

            $artcommentlike1 = $this->common->select_data_by_condition('art_comment_image_like', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

            if (count($artcommentlike1) == 0) {
                $cmtinsert .= '<i class="fa fa-thumbs-o-up fa-1x" aria-hidden="true"></i>';
            } else {

                $cmtinsert .= '<i class="fa fa-thumbs-up" aria-hidden="true"></i>';
            }

            $cmtinsert .= '<span>';

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


                $cmtinsert .= '<div id="editcommentbox' . $art_comment['post_image_comment_id'] . '"style="display:block;">';

                $cmtinsert .= '<a id="' . $art_comment['post_image_comment_id'] . '"';
                $cmtinsert .= 'onClick="comment_editbox(this.id)">';
                $cmtinsert .= 'Edit';
                $cmtinsert .= '</a></div>';

                $cmtinsert .= '<div id="editcancle' . $art_comment['post_image_comment_id'] . '"style="display:none;">';

                $cmtinsert .= '<a id="' . $art_comment['post_image_comment_id'] . '"';
                $cmtinsert .= 'onClick="comment_editcancle(this.id)">';
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


                $cmtinsert .= '<input type="hidden" name="post_delete"';
                $cmtinsert .= 'id="post_delete' . $art_comment['post_image_comment_id'] . '"';
                $cmtinsert .= 'value= "' . $art_comment['post_image_id'] . '">';
                $cmtinsert .= '<a id="' . $art_comment['post_image_comment_id'] . '"';
                $cmtinsert .= 'onClick="comment_delete(this.id)">';
                $cmtinsert .= 'Delete';
                $cmtinsert .= '</a></div>';
            }

            $cmtinsert .= '<span role="presentation" aria-hidden="true"> · </span>';
            $cmtinsert .= '<div class="comment-details-menu">';
            $cmtinsert .= '<p>' . $art_comment['created_date'] . '</p></div></div></div>';


            if (count($artcont) > 1) {
                // comment aount variable start
                $cmtcount = '<a onClick="commentall(this.id)" id="' . $post_image_id . '">';
                $cmtcount .= '<i class="fa fa-comment-o" aria-hidden="true">';
                $cmtcount .= ' ' . count($artcont) . '';
                $cmtcount .= '</i></a>';
            }
            // comment count variable end 
        }
        //   echo $cmtinsert;
        echo json_encode(
                array("comment" => $cmtinsert,
                    "count" => $cmtcount));
    }

    public function mulimg_comment() {

        $userid = $this->session->userdata('aileenuser');

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
            'created_date' => date('Y-m-d', time()),
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
                'not_img' => 4
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
            $cmtinsert .= '<div class="post-design-pro-comment-img">';
            $cmtinsert .= '<img  src="' . base_url(ARTISTICIMAGE . $art_userimage) . '" alt="">  </div>';

            $cmtinsert .= '<div class="comment-name"><b>' . $art_name . '</b>';
            $cmtinsert .= '</div>';

            $cmtinsert .= '<div class="comment-details" id= "showcommenttwo' . $art_comment['post_image_comment_id'] . '"" >';
            $cmtinsert .= $art_comment['comment'];
            $cmtinsert .= '</div>';
            $cmtinsert .= '<div contenteditable="true"   class="editable_text" name="' . $art_comment['post_image_comment_id'] . '" id="editcommenttwo' . $art_comment['post_image_comment_id'] . '"style="display:none;" onkeyup="commentedittwo(' . $art_comment['post_image_comment_id'] . ')">';

            $cmtinsert .= '' . $art_comment['comment'] . '';
            $cmtinsert .= '</div>';

            $cmtinsert .= '<button id="editsubmittwo' . $art_comment['post_image_comment_id'] . '" style="display:none;" onClick="edit_commenttwo(' . $art_comment['post_image_comment_id'] . ')">Comment</button><div class="art-comment-menu-design"> <div class="comment-details-menu" id="likecommentone' . $art_comment['post_image_comment_id'] . '">';

            $cmtinsert .= '<a id="' . $art_comment['post_image_comment_id'] . '"';
            $cmtinsert .= 'onClick="comment_liketwo(this.id)">';

            $contition_array = array('post_image_comment_id' => $art_comment['post_image_comment_id'], 'user_id' => $userid, 'is_unlike' => 0);

            $artcommentlike1 = $this->common->select_data_by_condition('art_comment_image_like', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

            if (count($artcommentlike1) == 0) {
                $cmtinsert .= '<i class="fa fa-thumbs-o-up fa-1x" aria-hidden="true"></i>';
            } else {

                $cmtinsert .= '<i class="fa fa-thumbs-up" aria-hidden="true"></i>';
            }

            $cmtinsert .= '<span>';

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
            $cmtinsert .= '<p>' . $art_comment['created_date'] . '</p></div></div></div>';
        }
        echo $cmtinsert;
    }

//multiple images comment end 
//multiple images comment like start
    public function mulimg_comment_like() {

        $userid = $this->session->userdata('aileenuser');
        $post_image_comment_id = $_POST["post_image_comment_id"];

        $contition_array = array('post_image_comment_id' => $post_image_comment_id, 'user_id' => $userid);

        $likecommentuser = $this->data['likecommentuser'] = $this->common->select_data_by_condition('art_comment_image_like', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');


        $contition_array = array('artistic_post_comment_id' => $post_image_comment_id);
        $artimglike = $this->data['artimglike'] = $this->common->select_data_by_condition('artistic_post_comment', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');



        $contition_array = array('art_post_id' => $artimglike[0]["art_post_id"]);
        $artimglikepost = $this->data['artimglikepost'] = $this->common->select_data_by_condition('art_post', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        //echo "<pre>"; print_r($artimglikepost); die();

        if (!$likecommentuser) {

            $data = array(
                'post_image_comment_id' => $post_image_comment_id,
                'user_id' => $userid,
                'created_date' => date('Y-m-d', time()),
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
                    'not_to_id' => $artimglikepost[0]['user_id'],
                    'not_read' => 2,
                    'not_product_id' => $insertdata,
                    'not_from' => 3,
                    'not_img' => 6
                );
                //echo "<pre>"; print_r($data); die();
                $insert_id = $this->common->insert_data_getid($data, 'notification');
            }
            // end notoification


            $contition_array = array('post_image_comment_id' => $_POST["post_image_comment_id"], 'is_unlike' => '0');
            $adatacm = $this->data['adatacm'] = $this->common->select_data_by_condition('art_comment_image_like', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

            if ($insertdata) {


                $imglike .= '<a id="' . $post_image_comment_id . '" onClick="comment_like(this.id)">';
                $imglike .= ' <i class="fa fa-thumbs-up" aria-hidden="true">';
                $imglike .= '</i>';
                $imglike .= '<span>';
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
                $adata2 = $this->data['adata2'] = $this->common->select_data_by_condition('art_comment_image_like', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');



                if ($updatdata) {


                    $imglike1 .= '<a id="' . $post_image_comment_id . '" onClick="comment_like(this.id)">';
                    $imglike1 .= '<i class="fa fa-thumbs-o-up fa-1x" aria-hidden="true">';
                    $imglike1 .= '</i>';
                    $imglike1 .= '<span>';
                    if (count($adata2) > 0) {
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


                //$updatdata = $this->common->update_data($data, 'art_comment_image_like', 'post_image_comment_id', $post_image_comment_id);
                $where = array('post_image_comment_id' => $post_image_comment_id, 'user_id' => $userid);
                $this->db->where($where);
                $updatdata = $this->db->update('art_comment_image_like ', $data);

                // insert notification

                if ($artimglike[0]['user_id'] == $userid) {
                    
                } else {
                    $data = array(
                        'not_type' => 5,
                        'not_from_id' => $userid,
                        'not_to_id' => $artimglikepost[0]['user_id'],
                        'not_read' => 2,
                        'not_product_id' => $post_image_comment_id,
                        'not_from' => 3,
                        'not_img' => 6
                    );
                    //echo "<pre>"; print_r($data); die();
                    $insert_id = $this->common->insert_data_getid($data, 'notification');
                }
                // end notoification



                $contition_array = array('post_image_comment_id' => $_POST["post_image_comment_id"], 'is_unlike' => '0');
                $bdata2 = $this->data['bdata2'] = $this->common->select_data_by_condition('art_comment_image_like', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');



                if ($updatdata) {


                    $imglike1 .= '<a id="' . $post_image_comment_id . '" onClick="comment_like(this.id)">';
                    $imglike1 .= '<i class="fa fa-thumbs-up" aria-hidden="true">';
                    $imglike1 .= '</i>';
                    $imglike1 .= '<span>';
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
        $post_image_comment_id = $_POST["post_image_comment_id"];

        $contition_array = array('post_image_comment_id' => $post_image_comment_id, 'user_id' => $userid);

        $likecommentuser = $this->data['likecommentuser'] = $this->common->select_data_by_condition('art_comment_image_like', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        $likecommentuser = $this->data['likecommentuser'] = $this->common->select_data_by_condition('art_comment_image_like', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');


        $contition_array = array('artistic_post_comment_id' => $likecommentuser[0]["post_image_comment_id"]);
        $artimglike = $this->data['artimglike'] = $this->common->select_data_by_condition('artistic_post_comment', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');


        $contition_array = array('art_post_id' => $artimglike[0]["art_post_id"]);
        $artimglikepost = $this->data['artimglikepost'] = $this->common->select_data_by_condition('art_post', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');


        if (!$likecommentuser) {

            $data = array(
                'post_image_comment_id' => $post_image_comment_id,
                'user_id' => $userid,
                'created_date' => date('Y-m-d', time()),
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
                    'not_to_id' => $artimglikepost[0]['user_id'],
                    'not_read' => 2,
                    'not_product_id' => $insertdata,
                    'not_from' => 3,
                    'not_img' => 6
                );

                $insert_id = $this->common->insert_data_getid($data, 'notification');
            }
            // end notoification

            $contition_array = array('post_image_comment_id' => $_POST["post_image_comment_id"], 'is_unlike' => '0');
            $bdatacm = $this->data['bdatacm'] = $this->common->select_data_by_condition('art_comment_image_like', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

            if ($insertdata) {


                $imglike .= '<a id="' . $post_image_comment_id . '" onClick="comment_liketwo(this.id)">';
                $imglike .= ' <i class="fa fa-thumbs-up" aria-hidden="true">';
                $imglike .= '</i>';
                $imglike .= '<span>';
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
                    $imglike1 .= '<i class="fa fa-thumbs-o-up fa-1x" aria-hidden="true">';
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
                    $data = array(
                        'not_type' => 5,
                        'not_from_id' => $userid,
                        'not_to_id' => $artimglikepost[0]['user_id'],
                        'not_read' => 2,
                        'not_product_id' => $post_image_comment_id,
                        'not_from' => 3,
                        'not_img' => 6
                    );

                    $insert_id = $this->common->insert_data_getid($data, 'notification');
                }
                // end notoification

                $contition_array = array('post_image_comment_id' => $_POST["post_image_comment_id"], 'is_unlike' => '0');
                $bdata2 = $this->data['bdata2'] = $this->common->select_data_by_condition('art_comment_image_like', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');



                if ($updatdata) {


                    $imglike1 .= '<a id="' . $post_image_comment_id . '" onClick="comment_liketwo(this.id)">';
                    $imglike1 .= '<i class="fa fa-thumbs-up" aria-hidden="true">';
                    $imglike1 .= '</i>';
                    $imglike1 .= '<span>';
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
//business_profile comment edit start
    public function mul_edit_com_insert() {

        $userid = $this->session->userdata('aileenuser');

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
            $cmtlike .= $arteditdata[0]['comment'] . "<br>";
            $cmtlike .= '</div>';
            echo $cmtlike;
        }
    }

//business_profile comment edit end
    //multiple images commnet delete start
    public function mul_delete_comment() {
        $userid = $this->session->userdata('aileenuser');
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
            $cmtinsert .= '<div class="post-design-pro-comment-img">';
            $cmtinsert .= '<img  src="' . base_url(ARTISTICIMAGE . $art_userimage) . '" alt="">  </div>';

            $cmtinsert .= '<div class="comment-name"><b>' . $art_name . '</b>';
            $cmtinsert .= '</div>';

            $cmtinsert .= '<div class="comment-details" id= "showcomment' . $art_comment['post_image_comment_id'] . '">';
            $cmtinsert .= $art_comment['comment'];
            $cmtinsert .= '</div>';
            $cmtinsert .= '<div contenteditable="true"   class="editable_text" name="' . $art_comment['post_image_comment_id'] . '" id="editcomment' . $art_comment['post_image_comment_id'] . '"style="display:none;" onkeyup="commentedit(' . $art_comment['post_image_comment_id'] . ')">';

            $cmtinsert .= '' . $art_comment['comment'] . '';
            $cmtinsert .= '</div>';

            $cmtinsert .= '<button id="editsubmit' . $art_comment['post_image_comment_id'] . '" style="display:none;" onClick="edit_comment(' . $art_comment['post_image_comment_id'] . ')">Comment</button><div class="art-comment-menu-design"> <div class="comment-details-menu" id="likecomment' . $art_comment['post_image_comment_id'] . '">';

            $cmtinsert .= '<a id="' . $art_comment['post_image_comment_id'] . '"';
            $cmtinsert .= 'onClick="comment_like(this.id)">';

            $contition_array = array('post_image_comment_id' => $art_comment['post_image_comment_id'], 'user_id' => $userid, 'is_unlike' => 0);

            $artcommentlike1 = $this->common->select_data_by_condition('art_comment_image_like', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

            if (count($artcommentlike1) == 0) {
                $cmtinsert .= '<i class="fa fa-thumbs-o-up fa-1x" aria-hidden="true"></i>';
            } else {

                $cmtinsert .= '<i class="fa fa-thumbs-up" aria-hidden="true"></i>';
            }

            $cmtinsert .= '<span>';

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


                $cmtinsert .= '<div id="editcommentbox' . $art_comment['post_image_comment_id'] . '"style="display:block;">';

                $cmtinsert .= '<a id="' . $art_comment['post_image_comment_id'] . '"';
                $cmtinsert .= 'onClick="comment_editbox(this.id)">';
                $cmtinsert .= 'Edit';
                $cmtinsert .= '</a></div>';

                $cmtinsert .= '<div id="editcancle' . $art_comment['post_image_comment_id'] . '"style="display:none;">';

                $cmtinsert .= '<a id="' . $art_comment['post_image_comment_id'] . '"';
                $cmtinsert .= 'onClick="comment_editcancle(this.id)">';
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


                $cmtinsert .= '<input type="hidden" name="post_delete"';
                $cmtinsert .= 'id="post_delete' . $art_comment['post_image_comment_id'] . '"';
                $cmtinsert .= 'value= "' . $art_comment['post_image_id'] . '">';
                $cmtinsert .= '<a id="' . $art_comment['post_image_comment_id'] . '"';
                $cmtinsert .= 'onClick="comment_delete(this.id)">';
                $cmtinsert .= 'Delete';
                $cmtinsert .= '</a></div>';
            }

            $cmtinsert .= '<span role="presentation" aria-hidden="true"> · </span>';
            $cmtinsert .= '<div class="comment-details-menu">';
            $cmtinsert .= '<p>' . $art_comment['created_date'] . '</p></div></div></div>';

            if (count($artcont) > 1) {
                // comment aount variable start
                $cmtcount = '<a onClick="commentall(this.id)" id="' . $art_comment['post_image_id'] . '">';
                $cmtcount .= '<i class="fa fa-comment-o" aria-hidden="true">';
                $cmtcount .= ' ' . count($artcont) . '';
                $cmtcount .= '</i></a>';
            }
            // comment count variable end 
        }
        //   echo $cmtinsert;
        echo json_encode(
                array("comment" => $cmtinsert,
                    "count" => $cmtcount));
    }

    public function mul_delete_commenttwo() {
        $userid = $this->session->userdata('aileenuser');
        $post_image_comment_id = $_POST["post_image_comment_id"];
        $post_delete = $_POST["post_delete"];

        $data = array(
            'is_delete' => 1,
            'modify_date' => date('y-m-d h:i:s')
        );

        $updatdata = $this->common->update_data($data, 'art_post_image_comment', 'post_image_comment_id', $post_image_comment_id);


        $contition_array = array('post_image_id' => $post_delete, 'is_delete' => '0');
        $artcomment = $this->common->select_data_by_condition('art_post_image_comment', $contition_array, $data = '*', $sortby = 'post_image_comment_id', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        // echo "<pre>"; print_r($artcomment); die();
        foreach ($artcomment as $art_comment) {

            $art_name = $this->db->get_where('art_reg', array('user_id' => $art_comment['user_id']))->row()->art_name;

            $art_userimage = $this->db->get_where('art_reg', array('user_id' => $art_comment['user_id'], 'status' => 1))->row()->art_user_image;

            $cmtinsert .= '<div class="all-comment-comment-box">';
            $cmtinsert .= '<div class="post-design-pro-comment-img">';
            $cmtinsert .= '<img  src="' . base_url(ARTISTICIMAGE . $art_userimage) . '" alt="">  </div>';

            $cmtinsert .= '<div class="comment-name"><b>' . $art_name . '</b>';
            $cmtinsert .= '</div>';

            $cmtinsert .= '<div class="comment-details" id= "showcommenttwo' . $art_comment['post_image_comment_id'] . '">';
            $cmtinsert .= $art_comment['comment'];
            $cmtinsert .= '</div>';
            $cmtinsert .= '<div contenteditable="true" class="editable_text" name="' . $art_comment['post_image_comment_id'] . '" id="editcommenttwo' . $art_comment['post_image_comment_id'] . '"style="display:none;" onkeyup="commentedittwo(' . $art_comment['post_image_comment_id'] . ')">';

            $cmtinsert .= '' . $art_comment['comment'] . '';
            $cmtinsert .= '</div>';

            $cmtinsert .= '<button id="editsubmittwo' . $art_comment['post_image_comment_id'] . '" style="display:none;" onClick="edit_commenttwo(' . $art_comment['post_image_comment_id'] . ')">Comment</button><div class="art-comment-menu-design"> <div class="comment-details-menu" id="likecomment' . $art_comment['post_image_comment_id'] . '">';

            $cmtinsert .= '<a id="' . $art_comment['post_image_comment_id'] . '"';
            $cmtinsert .= 'onClick="comment_like(this.id)">';

            $contition_array = array('post_image_comment_id' => $art_comment['post_image_comment_id'], 'user_id' => $userid, 'is_unlike' => 0);

            $artcommentlike1 = $this->common->select_data_by_condition('art_comment_image_like', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

            if (count($artcommentlike1) == 0) {
                $cmtinsert .= '<i class="fa fa-thumbs-o-up fa-1x" aria-hidden="true"></i>';
            } else {

                $cmtinsert .= '<i class="fa fa-thumbs-up" aria-hidden="true"></i>';
            }

            $cmtinsert .= '<span>';

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
            $cmtinsert .= '<p>' . $art_comment['created_date'] . '</p></div></div></div>';
        }
        echo $cmtinsert;
    }

    //mulitple images commnet delete end 
    // khyati 17-4 changes start

    public function fourcomment($postid) {

        $userid = $this->session->userdata('aileenuser');
        //$post_id =  $postid; 
        $post_id = $_POST['art_post_id'];

        // html start

        $contition_array = array('art_post_id' => $post_id, 'status' => '1');
        $artdata = $this->data['artdata'] = $this->common->select_data_by_condition('artistic_post_comment', $contition_array, $data = '*', $sortby = 'artistic_post_comment_id', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        $fourdata = '<div class="insertcommenttwo' . $post_id . '">';

        if ($artdata) {
            foreach ($artdata as $rowdata) {

                $artname = $this->db->get_where('art_reg', array('user_id' => $userid))->row()->art_name;
                $artlastname = $this->db->get_where('art_reg', array('user_id' => $userid))->row()->art_lastname;

                $fourdata .= '<div class="all-comment-comment-box">';
                $fourdata .= '<div class="post-design-pro-comment-img">';

                $art_userimage = $this->db->get_where('art_reg', array('user_id' => $rowdata['user_id'], 'status' => 1))->row()->art_user_image;

                if ($art_userimage) {
                    $fourdata .= '<img  src="' . base_url(ARTISTICIMAGE . $art_userimage) . '"  alt=""></div>';
                } else {
                    $fourdata .= '<img src="' . base_url(NOIMAGE) . '" alt="">';
                }

                $fourdata .= '<div class="comment-name">';
                $fourdata .= '<b>' . ucwords($artname) . '&nbsp' . ucwords($artlastname) . '</b></br> </div>';

                $fourdata .= '<div class="comment-details" id= "showcommenttwo' . $rowdata['artistic_post_comment_id'] . '">';
                $fourdata .= '' . $rowdata['comments'] . '</div>';

//                $fourdata .= '<textarea  name="' . $rowdata['artistic_post_comment_id'] . '" id="editcommenttwo' . $rowdata['artistic_post_comment_id'] . '" style="display:none" onClick="commentedittwo(this.name)">';
//                $fourdata .= '' . $rowdata['comments'] . '';
//                $fourdata .= '</textarea>';
                $fourdata .= '<div class="edit-comment-box"><div class="inputtype-edit-comment">';
                $fourdata .= '<div contenteditable="true" style="display:none; min-height:37px !important; margin-top: 0px!important; margin-left: 1.5% !important; width: 81%;" class="editable_text" name="' . $rowdata['artistic_post_comment_id'] . '"  id="editcommenttwo' . $rowdata['artistic_post_comment_id'] . '" placeholder="Type Message ..." value= ""  onkeyup="commentedittwo(' . $rowdata['artistic_post_comment_id'] . ')">' . $rowdata['comments'] . '</div>';
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
                    $fourdata .= '<i class="fa fa-thumbs-o-up fa-1x" aria-hidden="true"></i>';
                } else {
                    $fourdata .= '<i class="fa fa-thumbs-up" aria-hidden="true"></i>';
                }

                $fourdata .= '<span>';
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
                $fourdata .= '' . date('d-M-Y', strtotime($rowdata['created_date'])) . '</br></p></div>';
                $fourdata .= '</div></div>';
            }
        } else {
            $fourdata = 'No comments Available!!!</div>';
        }
        echo $fourdata;
    }

    // khyati 17-4 changes end 


    public function multifourcomment($postid) {

        $userid = $this->session->userdata('aileenuser');
        //$post_id =  $postid; 
        $image_id = $_POST['art_post_id'];

        // html start

        $contition_array = array('post_image_id' => $image_id, 'is_delete' => '0');

        $artmulimage1 = $this->common->select_data_by_condition('art_post_image_comment', $contition_array, $data = '*', $sortby = 'post_image_comment_id', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        // echo '<pre>'; print_r($artmulimage1); die();

        $fourdata = '<div class="insertcommenttwo' . $image_id . '">';


        foreach ($artmulimage1 as $rowdata) {

            $artname = $this->db->get_where('art_reg', array('user_id' => $userid))->row()->art_name;


            $artlastname = $this->db->get_where('art_reg', array('user_id' => $userid))->row()->art_lastname;



            $fourdata .= '<div class="all-comment-comment-box">';
            $fourdata .= '<div class="post-design-pro-comment-img">';

            $art_userimage = $this->db->get_where('art_reg', array('user_id' => $rowdata['user_id'], 'status' => 1))->row()->art_user_image;


            $fourdata .= '<img  src="' . base_url(ARTISTICIMAGE . $art_userimage) . '"  alt=""></div>';

            $fourdata .= '<div class="comment-name">';
            $fourdata .= '<b>' . ucwords($artname) . '&nbsp' . ucwords($artlastname) . '</b></br> </div>';

            $fourdata .= '<div class="comment-details" id= "showcommenttwo' . $rowdata['post_image_comment_id'] . '">';
            $fourdata .= '' . $rowdata['comment'] . '</br></div>';

            $fourdata .= '<div contenteditable="true" class="editable_text" name="' . $rowdata['post_image_comment_id'] . '" id="editcommenttwo' . $rowdata['post_image_comment_id'] . '" style="display:none"  onClick="commentedittwo(' . $rowdata['post_image_comment_id'] . ')">';

            $fourdata .= '' . $rowdata['comment'] . '';
            $fourdata .= '</div>';

            $fourdata .= '<button id="editsubmittwo' . $rowdata['post_image_comment_id'] . '" style="display:none" onClick="edit_commenttwo(' . $rowdata['post_image_comment_id'] . ')">Comment</button>';

            $fourdata .= '<div class="art-comment-menu-design">';
            $fourdata .= '<div class="comment-details-menu" id="likecommentone' . $rowdata['post_image_comment_id'] . '">';
            $fourdata .= '<a id="' . $rowdata['post_image_comment_id'] . '"   onClick="comment_liketwo(this.id)">';

            $userid = $this->session->userdata('aileenuser');
            $contition_array = array('post_image_comment_id' => $rowdata['post_image_comment_id'], 'user_id' => $userid, 'is_unlike' => 0);
            $artcommentlike = $this->data['artcommentlike'] = $this->common->select_data_by_condition('art_comment_image_like', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');


            if (count($artcommentlike) == 0) {
                $fourdata .= '<i class="fa fa-thumbs-o-up fa-1x" aria-hidden="true"></i>';
            } else {
                $fourdata .= '<i class="fa fa-thumbs-up" aria-hidden="true"></i>';
            }


            $contition_array = array('post_image_comment_id' => $rowdata['post_image_comment_id'], 'is_unlike' => '0');
            $mulcountlikeuser = $this->data['mulcountlikeuser'] = $this->common->select_data_by_condition('art_comment_image_like', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');


            $fourdata .= '<span>';
            if ($mulcountlikeuser) {
                $fourdata .= '' . count($mulcountlikeuser) . '';
            }

            $fourdata .= '</span></a></div>';

            $userid = $this->session->userdata('aileenuser');
            if ($rowdata['user_id'] == $userid) {

                $fourdata .= '<span role="presentation" aria-hidden="true"> · </span>';
                $fourdata .= '<div class="comment-details-menu">';
                $fourdata .= '<div id="editcommentboxtwo' . $rowdata['post_image_comment_id'] . '" style="display:block;">';
                $fourdata .= '<a id="' . $rowdata['post_image_comment_id'] . '"   onClick="comment_editboxtwo(this.id)">Edit</a> </div>';
                $fourdata .= '<div id="editcancletwo' . $rowdata['post_image_comment_id'] . '" style="display:none;">';
                $fourdata .= '<a id="' . $rowdata['post_image_comment_id'] . '" onClick="comment_editcancletwo(this.id)">Cancel</a></div></div>';
            }
            $userid = $this->session->userdata('aileenuser');
            $art_userid = $this->db->get_where('art_post', array('art_post_id' => $rowdata['art_post_id'], 'status' => 1))->row()->user_id;
            if ($rowdata['user_id'] == $userid || $art_userid == $userid) {

                $fourdata .= '<span role="presentation" aria-hidden="true"> · </span>';
                $fourdata .= '<div class="comment-details-menu">';


                $fourdata .= '<input type="hidden" name="post_deletetwo"  id="post_deletetwo' . $rowdata['post_image_comment_id'] . '" value= "' . $rowdata['post_image_id'] . '">';
                $fourdata .= '<a id="' . $rowdata['post_image_comment_id'] . '"';
                //$fourdata .= 'onClick="comment_deletetwo(this.id)"> Delete <span class="insertcommenttwo' . $rowdata['post_image_comment_id'] . '">';
                $fourdata .= 'onClick="comment_deletetwo(this.id)"> Delete';
                $fourdata .= '</span> </a> </div>';
            }
            $fourdata .= '<span role="presentation" aria-hidden="true"> · </span>';
            $fourdata .= '<div class="comment-details-menu">  <p>';
            $fourdata .= '' . date('d-M-Y', strtotime($rowdata['created_date'])) . '</br></p></div>';
            $fourdata .= '</div></div>';
        }

        echo $fourdata;
    }

    public function deletepdf() {

        $userid = $this->session->userdata('aileenuser');
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
    
    public function likeuserlist() {
        $post_id = $_POST['post_id'];

        $contition_array = array('art_post_id' => $post_id, 'status' => '1', 'is_delete' => '0');
        $commnetcount = $this->common->select_data_by_condition('art_post', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
        
        $likeuser = $commnetcount[0]['art_like_user'];
        $countlike = $commnetcount[0]['art_likes_count'] - 1;

        $likelistarray = explode(',', $likeuser);
        echo '<div class="likeduser">';
        echo '<div class="likeduser-title">User List</div>';
        foreach ($likelistarray as $key => $value) {
            $art_name1 = $this->db->get_where('art_reg', array('user_id' => $value, 'status' => 1))->row()->art_name;
            echo '<div class="likeuser_list"><a href="'.base_url('artistic/artistic_profile/' . $value).'">';
            echo ucwords($art_name1);
            echo '</a></div>';
        }
        echo '<div>';
    }

}
