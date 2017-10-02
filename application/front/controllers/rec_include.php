<?php
// user detail
$userid = $this->session->userdata('aileenuser');
// USERDATA USE FOR HEADER NAME AND IMAGE START
$contition_array = array('user_id' => $userid, 'is_delete' => '0', 'status' => '1');
$data = 'user_image,first_name';
$this->data['userdata'] = $this->common->select_data_by_condition('user', $contition_array, $data, $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
// USERDATA USE FOR HEADER NAME AND IMAGE END

$this->data['head'] = $this->load->view('head', $this->data, true);
$this->data['header'] = $this->load->view('header', $this->data, true);
$this->data['footer'] = $this->load->view('footer', $this->data, true);

$this->data['rec_search'] = $this->load->view('recruiter/rec_search', $this->data, true);
$this->data['recruiter_header2_border'] = $this->load->view('recruiter/recruiter_header2_border', $this->data, true);

// recruiter detail
$contition_array = array('user_id' => $userid, 'is_delete' => '0', 're_status' => '1');
$this->data['recdata'] = $this->common->select_data_by_condition('recruiter', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
