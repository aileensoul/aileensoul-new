<?php

// user detail
$userid = $this->session->userdata('aileenuser');
$contition_array = array('user_id' => $userid, 'is_delete' => '0', 'status' => '1');
$this->data['userdata'] = $this->common->select_data_by_condition('user', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

// job detail
$contition_array = array('user_id' => $userid, 'is_delete' => '0', 'status' => '1');
$this->data['jobdata'] = $this->common->select_data_by_condition('job_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

$this->data['head'] = $this->load->view('head', $this->data, true);
$this->data['header'] = $this->load->view('header', $this->data, true);
$this->data['footer'] = $this->load->view('footer', $this->data, true);

// Start Job
$this->data['job_left'] = $this->load->view('job/job_left', $this->data, true);
$this->data['job_search'] = $this->load->view('job/job_search', $this->data, true);
$this->data['job_menubar'] = $this->load->view('job/menubar', $this->data, true);
$this->data['job_header2_border'] = $this->load->view('job/job_header2_border', $this->data, true);
$this->data['login_footer'] = $this->load->view('login_footer', $this->data, TRUE);
// End Job
// Start Recruiter
?>
