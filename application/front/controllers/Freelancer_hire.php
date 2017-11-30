<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Freelancer_hire extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('email_model');
        $this->lang->load('message', 'english');
         //AWS access info start
        $this->load->library('S3');
        //AWS access info end

        include ('include.php');
    }

    public function freelancer_hire() {

        $userid = $this->session->userdata('aileenuser');


        $contition_array = array('user_id' => $userid, 'status' => '0');
        $freelancerhiredata = $this->common->select_data_by_condition('freelancer_hire_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
        if ($freelancerhiredata) {

            $this->load->view('freelancer/freelancer_hire/reactivate');
        } else {


            $userid = $this->session->userdata('aileenuser');
            $contition_array = array('user_id' => $userid, 'status' => '1');
            $jobdata = $this->common->select_data_by_condition('freelancer_hire_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');


            if (count($jobdata) > 0) {

                if ($jobdata[0]['free_hire_step'] == 1) {
                    redirect('freelancer-hire/address-information', refresh);
                } else if ($jobdata[0]['free_hire_step'] == 2) {
                    redirect('freelancer-hire/professional-information', refresh);
                } else if ($jobdata[0]['free_hire_step'] == 3) {
                    redirect('freelancer-hire/home', refresh);
                }
            } else {
                redirect('freelancer-hire/registation',refresh);
               // $this->load->view('freelancer/freelancer_hire/freelancer_hire_basic_info', $this->data);
            }
        }
    }

    public function freelancer_hire_basic_info() {
        $userid = $this->session->userdata('aileenuser');
        //if user deactive profile then redirect to freelancer_hire/freelancer_hire/freelancer_hire_basic_info  start
        $contition_array = array('user_id' => $userid, 'status' => '0', 'is_delete' => '0');
        $freelancerhire_deactive = $this->data['freelancerhire_deactive'] = $this->common->select_data_by_condition('freelancer_hire_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);
        if ($freelancerhire_deactive) {
            redirect('freelancer_hire/freelancer_hire/freelancer_hire_basic_info');
        }
//if user deactive profile then redirect to freelancer_hire/freelancer_hire/freelancer_hire_basic_info  start
        $contition_array = array('user_id' => $userid, 'is_delete' => '0', 'status' => '1');
        $userdata = $this->common->select_data_by_condition('freelancer_hire_reg', $contition_array, $data = 'fullname,username,email,skyupid,phone,user_id,free_hire_step', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
        if ($userdata) {
            $step = $userdata[0]['free_hire_step'];
            if ($step == 1 || $step > 1) {
                $this->data['firstname1'] = $userdata[0]['fullname'];
                $this->data['lastname1'] = $userdata[0]['username'];
                $this->data['email1'] = $userdata[0]['email'];
                $this->data['skypeid1'] = $userdata[0]['skyupid'];
                $this->data['phoneno1'] = $userdata[0]['phone'];
            }
        }

//for search start
        $this->freelancer_hire_search();
//for search end
        $this->load->view('freelancer/freelancer_hire/freelancer_hire_basic_info', $this->data);
    }

    public function freelancer_hire_basic_info_insert() { 
        $userid = $this->session->userdata('aileenuser');
        $this->form_validation->set_rules('fname', 'Please Enter Your first Name', 'required');
        $this->form_validation->set_rules('lname', 'Please Enter Your last name', 'required');
        $this->form_validation->set_rules('email', 'Please Enter Your email', 'required|valid_email');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('freelancer/freelancer_hire/freelancer_hire_basic_info');
        } else {
            $contition_array = array('user_id' => $userid, 'status' => '1');
            $userdata = $this->common->select_data_by_condition('freelancer_hire_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
            $first_lastname = trim($this->input->post('fname')) . " " . trim($this->input->post('lname'));
            if ($userdata) {
                $data = array(
                    'fullname' => trim($this->input->post('fname')),
                    'username' => trim($this->input->post('lname')),
                    'email' => trim($this->input->post('email')),
                    'freelancer_hire_slug' => $this->setcategory_slug($first_lastname, 'freelancer_hire_slug', 'freelancer_hire_reg'),
                    'skyupid' => trim($this->input->post('skyupid')),
                    'phone' => trim($this->input->post('phone')),
                    'modified_date' => date('Y-m-d h:i:s')
                );
                $updatedata = $this->common->update_data($data, 'freelancer_hire_reg', 'user_id', $userid);
                if ($updatedata) {
                   // $this->session->set_flashdata('success', 'Basic information updated successfully');
                    redirect('freelancer-hire/address-information', refresh);
                } else {
                  //  $this->session->flashdata('error', 'Your data not inserted');
                    redirect('freelancer-hire/basic-information', refresh);
                }
            } else {
                $data = array(
                    'fullname' => trim($this->input->post('fname')),
                    'username' => trim($this->input->post('lname')),
                    'email' => trim($this->input->post('email')),
                    'freelancer_hire_slug' => $this->setcategory_slug($first_lastname, 'freelancer_hire_slug', 'freelancer_hire_reg'),
                    'skyupid' => trim($this->input->post('skyupid')),
                    'phone' => trim($this->input->post('phone')),
                    'status' => '1',
                    'is_delete' => '0',
                    'created_date' => date('Y-m-d h:i:s'),
                    'user_id' => $userid,
                    'free_hire_step' => '1'
                );
                $insert_id = $this->common->insert_data($data, 'freelancer_hire_reg');
                if ($insert_id) {
                 //   $this->session->set_flashdata('success', 'Basic information updated successfully');
                    redirect('freelancer-hire/address-information', refresh);
                } else {
                 //   $this->session->flashdata('error', 'Sorry!! Your data not inserted');
                    redirect('freelancer-hire/basic-information', refresh);
                }
            }
        }
    }

// freelancer_hire profile slug start

    public function setcategory_slug($slugname, $filedname, $tablename, $notin_id = array()) {
        $slugname = $oldslugname = $this->create_slug($slugname);
        $i = 1;
        while ($this->comparecategory_slug($slugname, $filedname, $tablename, $notin_id) > 0) {
            $slugname = $oldslugname . '-' . $i;
            $i++;
        }return $slugname;
    }

    public function comparecategory_slug($slugname, $filedname, $tablename, $notin_id = array()) {
        $this->db->where($filedname, $slugname);
        if (isset($notin_id) && $notin_id != "" && count($notin_id) > 0 && !empty($notin_id)) {
            $this->db->where($notin_id);
        }
        $num_rows = $this->db->count_all_results($tablename);
        return $num_rows;
    }

    public function create_slug($string) {
        $slug = preg_replace('/[^A-Za-z0-9-]+/', '-', strtolower(stripslashes($string)));
        $slug = preg_replace('/[-]+/', '-', $slug);
        $slug = trim($slug, '-');
        return $slug;
    }

    // freelancer_hire profile slug end
   function slug_script() {

        $this->db->select('reg_id,username,fullname');
        $res = $this->db->get('freelancer_hire_reg')->result();
        foreach ($res as $k => $v) {
            $data = array('freelancer_hire_slug' => $this->setcategory_slug($v->username." ".fullname, 'freelancer_hire_slug', 'freelancer_hire_reg'));
            $this->db->where('reg_id', $v->reg_id);
            $this->db->update('freelancer_hire_reg', $data);
        }
        echo "yes";
    }

//check email avilibity start
    public function check_email() {

        $email = trim($this->input->post('email'));

        $userid = $this->session->userdata('aileenuser');

        $contition_array = array('user_id' => $userid, 'is_delete' => '0', 'status' => '1');
        $userdata = $this->common->select_data_by_condition('freelancer_hire_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        $email1 = $userdata[0]['email'];

        if ($email1) {

            $condition_array = array('is_delete' => '0', 'user_id !=' => $userid, 'status' => '1');

            $check_result = $this->common->check_unique_avalibility('freelancer_hire_reg', 'email', $email, '', '', $condition_array);
        } else {

            $condition_array = array('is_delete' => '0', 'status' => '1');

            $check_result = $this->common->check_unique_avalibility('freelancer_hire_reg', 'email', $email, '', '', $condition_array);
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



    public function freelancer_hire_address_info() {
        $userid = $this->session->userdata('aileenuser');
        //if user deactive profile then redirect to freelancer_hire/freelancer_hire/freelancer_hire_basic_info  start
        $contition_array = array('user_id' => $userid, 'status' => '0', 'is_delete' => '0');
        $freelancerhire_deactive = $this->data['freelancerhire_deactive'] = $this->common->select_data_by_condition('freelancer_hire_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);
        if ($freelancerhire_deactive) {
            redirect('freelancer_hire/freelancer_hire/freelancer_hire_basic_info');
        }
//if user deactive profile then redirect to freelancer_hire/freelancer_hire/freelancer_hire_basic_info  End
        // code for display page start
        $this->freelancer_hire_check();
        // code for display page end
        $contition_array = array('status' => '1');
        $this->data['countries'] = $this->common->select_data_by_condition('countries', $contition_array, $data = '*', $sortby = 'country_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');
        $contition_array = array('user_id' => $userid, 'is_delete' => '0', 'status' => '1');
        $userdata = $this->common->select_data_by_condition('freelancer_hire_reg', $contition_array, $data = 'country,state,city,pincode,user_id,free_hire_step', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
        //for getting state data
        $contition_array = array('status' => '1', 'country_id' => $userdata[0]['country']);
        $this->data['states'] = $this->common->select_data_by_condition('states', $contition_array, $data = '*', $sortby = 'state_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        //for getting city data
        $contition_array = array('status' => '1', 'state_id' => $userdata[0]['state']);
        $this->data['cities'] = $this->common->select_data_by_condition('cities', $contition_array, $data = '*', $sortby = 'city_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        if ($userdata) {
            $step = $userdata[0]['free_hire_step'];

            if ($step == 2 || $step > 2 || ($step >= 1 && $step <= 2)) {
                $this->data['country1'] = $userdata[0]['country'];
                $this->data['state1'] = $userdata[0]['state'];
                $this->data['city1'] = $userdata[0]['city'];
                $this->data['pincode1'] = $userdata[0]['pincode'];
            }
        }

// code for search start
        $this->freelancer_hire_search();
// code for search end
        $this->load->view('freelancer/freelancer_hire/freelancer_hire_address_info', $this->data);
    }

    public function ajax_data() {
//ajax data for category and subcategory start
echo "123"; die();
        
        if (isset($_POST["category_id"]) && !empty($_POST["category_id"])) {
            //Get all state data
            $contition_array = array('category_id' => $_POST["category_id"], 'status' => '1');
            $subcategory = $this->data['subcategory'] = $this->common->select_data_by_condition('sub_category', $contition_array, $data = '*', $sortby = 'sub_category_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');

            //Count total number of rows
            //Display states list
            if (count($subcategory) > 0) {
                echo '<option value="">Select Area of Requirement</option>';
                foreach ($subcategory as $st) {
                    echo '<option value="' . $st['sub_category_id'] . '">' . $st['sub_category_name'] . '</option>';
                }
            } else {
                echo '<option value="">Area of Requirement not available</option>';
            }
        }



//ajax data for category and subcategory end 
        //ajax data for country and state and city
        if (isset($_POST["country_id"]) && !empty($_POST["country_id"])) {
            //Get all state data
            echo $_POST["country_id"];die();
            $contition_array = array('country_id' => $_POST["country_id"], 'status' => '1');
            $state = $this->data['states'] = $this->common->select_data_by_condition('states', $contition_array, $data = '*', $sortby = 'state_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');
echo "<pre>"; print_r($state);die();
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
            $contition_array = array('state_id' => $_POST["state_id"], 'status' => '1');
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

    public function freelancer_hire_check() {
        //  echo "hjjj";
        $userid = $this->session->userdata('aileenuser');
        $contition_array = array('user_id' => $userid, 'status' => '1', 'is_delete' => '0');
        $hire_step = $this->data['hire_step'] = $this->common->select_data_by_condition('freelancer_hire_reg', $contition_array, $data = 'free_hire_step', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);

        // echo $this->uri->segment(2); exit;

        if (count($hire_step) > 0) {
            if ($hire_step[0]['free_hire_step'] == '1') {
                if ($this->uri->segment(2) == 'address-information') {
                    
                } else {
                    redirect('freelancer-hire/address-information');
                }
            } elseif ($hire_step[0]['free_hire_step'] == '2') {
                if ($this->uri->segment(2) == 'professional-information') {
                    
                } elseif ($this->uri->segment(2) == 'address-information') {
                    
                } else {
                    redirect('freelancer-hire/professional-information');
                }
            }
        } else {
            redirect('freelancer-hire/basic-information');
        }
    }

    public function freelancer_hire_address_info_insert() {

        $userid = $this->session->userdata('aileenuser');



        if ($this->input->post('next')) {


            $this->form_validation->set_rules('country', 'Please Enter Your country', 'required');
            $this->form_validation->set_rules('state', 'Please Enter Your state', 'required');


            if ($this->form_validation->run() == FALSE) {

                $this->load->view('freelancer/freelancer_hire/freelancer_hire_address_info');
            } else {
                //echo "hhh";
                $contition_array = array('user_id' => $userid, 'status' => '1', 'free_hire_step' => '3');
                $userdata = $this->common->select_data_by_condition('freelancer_hire_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
                if ($userdata) {
                    $data = array(
                        'country' => trim($this->input->post('country')),
                        'state' => trim($this->input->post('state')),
                        'city' => trim($this->input->post('city')),
                        'pincode' => trim($this->input->post('pincode')),
                        'modified_date' => date('Y-m-d h:i:s')
                    );
                    $updatdata = $this->common->update_data($data, 'freelancer_hire_reg', 'user_id', $userid);
                    if ($updatdata) {

                      //  $this->session->set_flashdata('success', 'Address information updated successfully');
                        redirect('freelancer-hire/professional-information', refresh);
                    } else {

                       // $this->session->flashdata('error', 'Sorry!! Your data not inserted');
                        redirect('freelancer-hire/address-information', refresh);
                    }
                } else {
                    
                }



                $data = array(
                    'country' => trim($this->input->post('country')),
                    'state' => trim($this->input->post('state')),
                    'city' => trim($this->input->post('city')),
                    'pincode' => trim($this->input->post('pincode')),
                    'modified_date' => date('Y-m-d h:i:s'),
                    'user_id' => $userid,
                    'free_hire_step' => '2'
                );



                $updatdata = $this->common->update_data($data, 'freelancer_hire_reg', 'user_id', $userid);


                if ($updatdata) {

                 //   $this->session->set_flashdata('success', 'Address information updated successfully');
                    redirect('freelancer-hire/professional-information', refresh);
                } else {

                  //  $this->session->flashdata('error', 'Sorry!! Your data not inserted');
                    redirect('freelancer-hire/address-information', refresh);
                }
            }
        }
    }

    public function freelancer_hire_professional_info() {
        $userid = $this->session->userdata('aileenuser');
//if user deactive profile then redirect to freelancer_hire/freelancer_hire/freelancer_hire_basic_info  start
        $contition_array = array('user_id' => $userid, 'status' => '0', 'is_delete' => '0');
        $freelancerhire_deactive = $this->data['freelancerhire_deactive'] = $this->common->select_data_by_condition('freelancer_hire_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);
        if ($freelancerhire_deactive) {
            redirect('freelancer_hire/freelancer_hire/freelancer_hire_basic_info');
        }
//if user deactive profile then redirect to freelancer_hire/freelancer_hire/freelancer_hire_basic_info  End
        // code for display page start
        $this->freelancer_hire_check();
        // code for display page end
        $contition_array = array('user_id' => $userid, 'is_delete' => '0', 'status' => '1');
        $userdata = $this->common->select_data_by_condition('freelancer_hire_reg', $contition_array, $data = 'free_hire_step,professional_info', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
        if ($userdata) {
            $step = $userdata[0]['free_hire_step'];

            if ($step == 3 || ($step >= 1 && $step <= 3) || $step > 3) {
                $this->data['professional_info1'] = $userdata[0]['professional_info'];
            }
        }
// code for search start
        $this->freelancer_hire_search();
// code for search end
        $this->load->view('freelancer/freelancer_hire/freelancer_hire_professional_info', $this->data);
    }

    public function freelancer_hire_professional_info_insert() {

        $userid = $this->session->userdata('aileenuser');
        $contition_array = array('user_id' => $userid, 'is_delete' => '0', 'status' => '1');
        $userdata = $this->common->select_data_by_condition('freelancer_hire_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');





        if ($this->input->post('next')) {



//            $this->form_validation->set_rules('professional_info', ' Please Enter Your professional info', 'required');



//            if ($this->form_validation->run() == FALSE) {
//
//                $this->load->view('freelancer/freelancer_hire/freelancer_hire_professional_info');
//            } else {

                $data = array(
                    'professional_info' => trim($this->input->post('professional_info')),
                    'modified_date' => date('Y-m-d h:i:s'),
                    'user_id' => $userid,
                    'free_hire_step' => '3'
                );



                $updatdata = $this->common->update_data($data, 'freelancer_hire_reg', 'user_id', $userid);


                if ($updatdata) {

//                    $this->session->set_flashdata('success', 'professional information updated successfully');

                    if ($userdata[0]['free_hire_step'] == 3) {
                        redirect('freelancer-hire/employer-details', refresh);
                    } else {
                        redirect('freelancer-hire/add-projects?page=professional', refresh);
                    }
                } else {

                    $this->session->flashdata('error', 'Sorry!! Your data not inserted');
                    redirect('freelancer-hire/professional-information', refresh);
                }
           // }
        }
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
    //reactivate account start

    public function reactivate() {

        $userid = $this->session->userdata('aileenuser');
        $data = array(
            'status' => '1',
            'modified_date' => date('y-m-d h:i:s')
        );
        $data1 = array(
            'status' => '1',
            'modify_date' => date('y-m-d h:i:s')
        );

        $updatdata = $this->common->update_data($data, 'freelancer_hire_reg', 'user_id', $userid);
        $update = $this->common->update_data($data1, 'freelancer_post', 'user_id', $userid);
        if ($update && $updatdata) {

            redirect('freelancer-hire/home', refresh);
        } else {

            redirect('freelancer_hire/reactivate', refresh);
        }
    }

//reactivate accont end
    public function freelancer_hire_search() {
        $contition_array = array('status' => '1', 'is_delete' => '0');
        $field = $this->data['results'] = $this->common->select_data_by_condition('category', $contition_array, $data = 'category_name', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);

        $contition_array = array('status' => '1', 'is_delete' => '0', 'free_post_step' => '7');
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
        foreach ($results as $key => $value) {
            $result1[$key]['label'] = $value;
            $result1[$key]['value'] = $value;
        }
        $contition_array = array('status' => '1');
        $location_list = $this->common->select_data_by_condition('cities', $contition_array, $data = 'city_name', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);
        foreach ($location_list as $key1 => $value) {
            foreach ($value as $ke1 => $val1) {
                $location[] = $val1;
            }
        }
        foreach ($location as $key => $value) {
            $loc[$key]['label'] = $value;
            $loc[$key]['value'] = $value;
        }
        $this->data['city_data'] = array_values($loc);
        $this->data['demo'] = array_values($result1);
    }

}
