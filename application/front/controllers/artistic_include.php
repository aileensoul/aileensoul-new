<?php
// user detail
$userid = $this->session->userdata('aileenuser');
$contition_array = array('user_id' => $userid, 'is_delete' => '0', 'status' => '1');
$this->data['userdata'] = $this->common->select_data_by_condition('user', $contition_array, $data = 'first_name,user_id,last_name,user_email,user_image', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
// artistics detail
$contition_array = array('user_id' => $userid, 'is_delete' => '0', 'status' => '1');
$this->data['artdata'] = $this->common->select_data_by_condition('art_reg', $contition_array, $data = 'art_id,art_name,art_lastname,art_skill,user_id,status,is_delete,art_step,art_user_image,profile_background,designation,slug', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
$this->data['head'] = $this->load->view('head', $this->data, true);
$this->data['header'] = $this->load->view('header', $this->data, true);
$this->data['footer'] = $this->load->view('footer', $this->data, true);
$this->data['artistic_search'] = $this->load->view('artist/artistic_search', $this->data, true);
$artregid = $this->data['artdata'][0]['art_id'];
$contition_array = array('follow_to' => $artregid, 'follow_status' => '1', 'follow_type' => '1');
$followerdata = $this->data['followerdata'] = $this->common->select_data_by_condition('follow', $contition_array, $data = 'follow_id,follow_type,follow_from,follow_to,follow_status', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
foreach ($followerdata as $followkey) {
    $contition_array = array('art_id' => $followkey['follow_from'], 'status' => '1');
    $artaval = $this->common->select_data_by_condition('art_reg', $contition_array, $data = 'art_id,art_name,art_lastname,art_skill,user_id,status,is_delete,art_step,art_user_image,profile_background,designation,slug', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
    if ($artaval) {

        $countlu[] = $artaval;
    }
}
$this->data['flucount'] = $flucount = count($countlu);
$contition_array = array('follow_from' => $artregid, 'follow_status' => '1', 'follow_type' => '1');
$followingdata = $this->data['followingdata'] = $this->common->select_data_by_condition('follow', $contition_array, $data = 'follow_id,follow_type,follow_from,follow_to,follow_status', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
foreach ($followingdata as $followkey) {
    $contition_array = array('art_id' => $followkey['follow_to'], 'status' => '1');
    $artaval = $this->common->select_data_by_condition('art_reg', $contition_array, $data = 'art_id,art_name,art_lastname,art_skill,user_id,status,is_delete,art_step,art_user_image,profile_background,designation,slug', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
    if ($artaval) {

        $countlfu[] = $artaval;
    }
}
$this->data['countfr'] = $countfr = count($countlfu);
$this->data['art_header2_border'] = $this->load->view('artist/art_header2_border', $this->data, true);
?>
