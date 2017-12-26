<?php

// user detail
$userid = $this->data['user_id'] = $this->session->userdata('aileenuser');
// USERDATA USE FOR HEADER NAME AND IMAGE START
$contition_array = array('user_id' => $userid, 'is_delete' => '0', 'status' => '1');
$data = 'user_image,first_name,last_name,user_email';
$this->data['userdata'] = $this->common->select_data_by_condition('user', $contition_array, $data, $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
// USERDATA USE FOR HEADER NAME AND IMAGE END
$contition_array = array('not_read' => '2', 'not_to_id' => $userid, 'not_type !=' => '1', 'not_type !=' => '2');
$result = $this->common->select_data_by_condition('notification', $contition_array, $data = 'count(*) as total', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
$this->data['user_notification_count'] = $count = $result[0]['total'];


$this->data['header'] = $this->load->view('header', $this->data, true);
$this->data['head_message'] = $this->load->view('head_message', $this->data, true);
$this->data['footer'] = $this->load->view('footer', $this->data, true);
$this->data['login_footer'] = $this->load->view('login_footer', $this->data, TRUE);
$this->data['rec_search'] = $this->load->view('recruiter/rec_search', $this->data, true);
$this->data['left_footer'] = $this->load->view('leftfooter', $this->data, TRUE);
$this->data['recruiter_header2_border'] = $this->load->view('recruiter/recruiter_header2_border', $this->data, true);
// recruiter detail
// Start Job
$this->data['job_left'] = $this->load->view('job/job_left', $this->data, true);
$this->data['job_search'] = $this->load->view('job/job_search', $this->data, true);
$this->data['job_menubar'] = $this->load->view('job/menubar', $this->data, true);
$this->data['job_header2_border'] = $this->load->view('job/job_header2_border', $this->data, true);
// End Job

$id = $this->uri->segment(3);


if (($id == $userid || $id == '') || $this->uri->segment(2) == 'edit-post' || $this->uri->segment(2) == 'apply-list' || $this->uri->segment(2) == 'recruiter_profile') {
    $contition_array = array('user_id' => $userid, 'is_delete' => '0', 're_status' => '1');
    $data = "rec_id,rec_firstname,rec_lastname,rec_email,re_status,rec_phone,re_comp_name,re_comp_email,re_comp_site,re_comp_country,re_comp_state,re_comp_city,user_id,re_comp_profile,re_comp_sector,re_comp_activities,re_step,re_comp_phone,recruiter_user_image,profile_background,profile_background_main,designation,comp_logo";
    $recdata = $this->data['recdata'] = $this->common->select_data_by_condition('recruiter', $contition_array, $data, $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
} else {
    $contition_array = array('user_id' => $id, 'is_delete' => '0', 're_status' => '1');
    $data = "rec_id,rec_firstname,rec_lastname,rec_email,re_status,rec_phone,re_comp_name,re_comp_email,re_comp_site,re_comp_country,re_comp_state,re_comp_city,user_id,re_comp_profile,re_comp_sector,re_comp_activities,re_step,re_comp_phone,recruiter_user_image,profile_background,profile_background_main,designation,comp_logo";
    $recdata = $this->data['recdata'] = $this->common->select_data_by_condition('recruiter', $contition_array, $data, $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
}


if ($this->uri->segment(2) == 'jobpost') {

    $segment3 = explode('-', $this->uri->segment(3));
    $slugdata = array_reverse($segment3);
    $postid = $slugdata[0];
    $this->data['recliveid'] = $userid = $slugdata[1];

    $contition_array = array('user_id' => $userid, 'is_delete' => '0', 're_status' => '1');
    $data = "re_comp_name";
    $recdata = $this->data['recdata'] = $this->common->select_data_by_condition('recruiter', $contition_array, $data, $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

    $data = 'post_name,max_year,,min_year,fresher,city,state';
    $contition_array = array('post_id' => $postid, 'status' => '1', 'rec_post.is_delete' => '0', 'rec_post.user_id' => $userid);
    $postdata = $this->common->select_data_by_condition('rec_post', $contition_array, $data, $sortby = '', $orderby = 'desc', $limit = '', $offset = '', $join_str = array(), $groupby = '');


    if (($postdata[0]['min_year'] != '0' || $postdata[0]['max_year'] != '0') && ($postdata[0]['fresher'] == 1)) {
        $exp_descp = $this->data['exp_descp'] = $postdata[0]['min_year'] . ' to ' . $postdata[0]['max_year'] . ' Years';
    } else {
        if (($postdata[0]['min_year'] != '0' || $postdata[0]['max_year'] != '0')) {
            $exp_descp = $this->data['exp_descp'] = $postdata[0]['min_year'] . ' to ' . $postdata[0]['max_year'] . ' Years';
        } else {
            $exp_descp = $this->data['exp_descp'] = "Fresher";
        }
    }

    $exp_title = $this->data['exp_title'] = $this->db->get_where('job_title', array(
                'title_id' => $postdata[0]['post_name']
            ))->row()->name;

    $state_name = $this->data['state_name'] = $this->db->get_where('states', array('state_id' => $postdata[0]['state']))->row()->state_name;
    $city_name = $this->data['city_name'] = $this->db->get_where('cities', array('city_id' => $postdata[0]['city']))->row()->city_name;
}

if ($this->uri->segment(2) == 'profile') { 
    $contition_array = array('user_id' => $this->uri->segment(3), 'is_delete' => '0', 're_status' => '1');
    $data = "re_comp_name,re_comp_city,re_comp_state,rec_firstname,rec_lastname";
    $recdescdata = $this->data['recdescdata'] = $this->common->select_data_by_condition('recruiter', $contition_array, $data, $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
    
     $statedesc_name = $this->data['statedesc_name'] = $this->db->get_where('states', array('state_id' => $recdescdata[0]['re_comp_state']))->row()->state_name;
    $citydesc_name = $this->data['citydesc_name'] = $this->db->get_where('cities', array('city_id' => $recdescdata[0]['re_comp_city']))->row()->city_name;
}

$this->data['head'] = $this->load->view('head', $this->data, true);
