<?php
// user detail
$userid = $this->data['user_id'] =  $this->session->userdata('aileenuser');
// USERDATA USE FOR HEADER NAME AND IMAGE START
$contition_array = array('user_id' => $userid, 'is_delete' => '0', 'status' => '1');
$data = 'user_image,first_name,last_name,user_email';
$this->data['userdata'] = $this->common->select_data_by_condition('user', $contition_array, $data, $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
// USERDATA USE FOR HEADER NAME AND IMAGE END

$this->data['head'] = $this->load->view('head', $this->data, true);
$this->data['header'] = $this->load->view('header', $this->data, true);
$this->data['footer'] = $this->load->view('footer', $this->data, true);
$this->data['login_footer'] = $this->load->view('login_footer', $this->data, TRUE);
$this->data['rec_search'] = $this->load->view('recruiter/rec_search', $this->data, true);
$this->data['recruiter_header2_border'] = $this->load->view('recruiter/recruiter_header2_border', $this->data, true);
// recruiter detail

// Start Job
$this->data['job_left'] = $this->load->view('job/job_left', $this->data, true);
$this->data['job_search'] = $this->load->view('job/job_search', $this->data, true);
$this->data['job_menubar'] = $this->load->view('job/menubar', $this->data, true);
$this->data['job_header2_border'] = $this->load->view('job/job_header2_border', $this->data, true);
// End Job

$id = $this->uri->segment(3);


if (($id == $userid || $id == '') || $this->uri->segment(2) == 'edit-post') {
$contition_array = array('user_id' => $userid, 'is_delete' => '0', 're_status' => '1');
$data = "rec_id,rec_firstname,rec_lastname,rec_email,re_status,rec_phone,re_comp_name,re_comp_email,re_comp_site,re_comp_country,re_comp_state,re_comp_city,user_id,re_comp_profile,re_comp_sector,	re_comp_activities,re_step,re_comp_phone,recruiter_user_image,profile_background,profile_background_main,designation,comp_logo";
$recdata = $this->data['recdata'] = $this->common->select_data_by_condition('recruiter', $contition_array, $data, $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
}else{
$contition_array = array('user_id' => $id, 'is_delete' => '0', 're_status' => '1');
$data = "rec_id,rec_firstname,rec_lastname,rec_email,re_status,rec_phone,re_comp_name,re_comp_email,re_comp_site,re_comp_country,re_comp_state,re_comp_city,user_id,re_comp_profile,re_comp_sector,	re_comp_activities,re_step,re_comp_phone,recruiter_user_image,profile_background,profile_background_main,designation,comp_logo";
$recdata = $this->data['recdata'] = $this->common->select_data_by_condition('recruiter', $contition_array, $data, $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
}