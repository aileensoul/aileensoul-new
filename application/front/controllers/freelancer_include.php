<?php 

$userid = $this->session->userdata('aileenuser');
$contition_array = array('user_id' => $userid, 'is_delete' => '0', 'status' => '1');
$this->data['userdata'] = $this->common->select_data_by_condition('user', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

// freelancer hire detail
$contition_array = array('user_id' => $userid, 'is_delete' => '0', 'status' => '1');
$this->data['freehiredata'] = $this->common->select_data_by_condition('freelancer_hire_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

// freelancer post detail
$contition_array = array('user_id' => $userid, 'is_delete' => '0', 'status' => '1');
$this->data['freepostdata'] = $this->common->select_data_by_condition('freelancer_post_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

$this->data['head'] = $this->load->view('head', $this->data, true);
$this->data['header'] = $this->load->view('header', $this->data, true);
$this->data['footer'] = $this->load->view('footer', $this->data, true);


$this->data['freelancer_post_search'] = $this->load->view('freelancer/freelancer_post/freelancer_post_search', $this->data, true);
$this->data['freelancer_hire_search'] = $this->load->view('freelancer/freelancer_hire/freelancer_hire_search', $this->data, true);
$this->data['freelancer_hire_header2_border'] = $this->load->view('freelancer/freelancer_hire/freelancer_hire_header2_border', $this->data, true);
$this->data['freelancer_post_header2_border'] = $this->load->view('freelancer/freelancer_post/freelancer_post_header2_border', $this->data, true);

?>