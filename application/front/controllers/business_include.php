<?php// user detail// USERDATA USE FOR HEADER NAME AND IMAGE START$contition_array = array('user_id' => $userid, 'is_delete' => '0', 'status' => '1');$data = 'user_image,first_name';$userdata = $this->data['userdata'] = $this->common->select_data_by_condition('user', $contition_array, $data, $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');// USERDATA USE FOR HEADER NAME AND IMAGE END$this->data['head'] = $this->load->view('head', $this->data, true);$this->data['header'] = $this->load->view('header', $this->data, true);$this->data['footer'] = $this->load->view('footer', $this->data, true);$this->data['business_search'] = $this->load->view('business_profile/business_search', $this->data, true);$this->data['business_header2_border'] = $this->load->view('business_profile/business_header2_border', $this->data, true);$slug = $this->uri->segment(3);if (is_numeric($slug)) {    $slug = '';}// THIS CODE FOR BUSINESS PROFILE IMAGE IN COVERPAGE START$contition_array = array('user_id' => $userid, 'status' => '1');$slug_data = $this->data['slug_data'] = $this->common->select_data_by_condition('business_profile', $contition_array, $data = 'business_slug,business_user_image', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');$this->data['business_login_slug'] = $slug_id = $slug_data[0]['business_slug'];$this->data['business_login_user_image'] = $business_user_image = $slug_data[0]['business_user_image'];if ($slug_id != '') {    if (($slug == $slug_data[0]['business_slug'] || $slug == '') && $slug != 'manage') {        $contition_array = array('user_id' => $userid, 'status' => '1', 'is_deleted' => 0);        $data = "business_profile_id,user_id,business_user_image,business_slug,industriyal,other_industrial,company_name,profile_background,city,state,business_type,business_step";        $business_common_data = $this->data['business_common_data'] = $this->common->select_data_by_condition('business_profile', $contition_array, $data, $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');    } elseif ($slug == 'manage') {        $userid = $this->uri->segment(4);        $contition_array = array('user_id' => $userid, 'status' => '1', 'is_deleted' => 0);        $data = "business_profile_id,user_id,business_user_image,business_slug,industriyal,other_industrial,company_name,profile_background,city,state,business_type,business_step";        $business_common_data = $this->data['business_common_data'] = $this->common->select_data_by_condition('business_profile', $contition_array, $data, $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');    } else {        $contition_array = array('business_slug' => $slug, 'status' => '1', 'business_step' => 4, 'is_deleted' => 0);        $data = "business_profile_id,user_id,business_user_image,business_slug,industriyal,other_industrial,company_name,profile_background,city,state,business_type,business_step";        $business_common_data = $this->data['business_common_data'] = $this->common->select_data_by_condition('business_profile', $contition_array, $data, $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');    }} else {    $business_common_data = $this->data['business_common_data'][0]['business_step'] = 0;}//echo '<pre>';//print_r($business_common_data);//exit;// THIS CODE FOR BUSINESS PROFILE IMAGE IN COVERPAGE END$this->data['business_user_following_count'] = $this->business_user_following_count($business_common_data[0]['business_profile_id']);$this->data['business_user_follower_count'] = $this->business_user_follower_count($business_common_data[0]['business_profile_id']);$this->data['business_user_contacts_count'] = $this->business_user_contacts_count($business_common_data[0]['business_profile_id']);$this->data['business_common'] = $this->load->view('business_profile/business_common', $this->data, true);?>