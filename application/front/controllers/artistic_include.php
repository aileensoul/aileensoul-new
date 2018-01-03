<?php
$userid = $this->session->userdata('aileenuser');
// USERDATA USE FOR HEADER NAME AND IMAGE START
$userdata = $this->data['userdata'] = $this->user_model->getUserSelectedData($userid, $select_data = 'u.first_name,u.user_id,u.last_name,ul.user_email,ui.user_image');


$userid = $this->session->userdata('aileenuser');
$contition_array = array('user_id' => $userid, 'is_delete' => '0', 'status' => '1');
$this->data['userdata'] = $this->common->select_data_by_condition('user', $contition_array, $data = 'first_name,user_id,last_name,user_email,user_image', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
// artistics detail
$contition_array = array('user_id' => $userid, 'is_delete' => '0', 'status' => '1');
$this->data['artdata'] = $this->common->select_data_by_condition('art_reg', $contition_array, $data = 'art_id,art_name,art_lastname,art_city,art_skill,other_skill,user_id,status,is_delete,art_step,art_user_image,profile_background,designation,slug', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');



 $segment3 = explode('-', $this->uri->segment(3));
 $slugdata = array_reverse($segment3);
 $regid = $slugdata[0];
//echo "<pre>"; print_r($regid); die();
$contition_array = array('art_id' => $regid, 'is_delete' => '0', 'status' => '1');
$this->data['meta_des'] = $meta_des = $this->common->select_data_by_condition('art_reg', $contition_array, $data = 'art_id,art_name,art_lastname,art_city,art_country,art_skill,other_skill,user_id,status,is_delete,art_step,art_user_image,profile_background,designation,slug', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

//echo "<pre>"; print_r($meta_des); die();

$this->data['location_city'] = $this->db->select('city_name')->get_where('cities', array('city_id' => $this->data['meta_des'][0]['art_city']))->row()->city_name;

$this->data['location_country'] = $this->db->select('country_name')->get_where('countries', array('country_id' => $this->data['meta_des'][0]['art_country']))->row()->country_name;

$art_othercategory = $this->db->select('other_category')->get_where('art_other_category', array('other_category_id' => $this->data['meta_des'][0]['other_skill']))->row()->other_category;

                                    $category = $this->data['meta_des'][0]['art_skill'];
                                    $category = explode(',' , $category);

                                    foreach ($category as $catkey => $catval) {
                                       $art_category = $this->db->select('art_category')->get_where('art_category', array('category_id' => $catval))->row()->art_category;
                                       $categorylist[] = ucwords($art_category);
                                     } 

                                    $listfinal1 = array_diff($categorylist, array('Other'));
                                    $listFinal = implode('/', $listfinal1);
                                       
                                    if(!in_array(26, $category)){ 
                                     $this->data['keyskill_meta'] = $listFinal;
                                   }else if($this->data['meta_des'][0]['art_skill'] && $this->data['meta_des'][0]['other_skill']){ 

                                    $trimdata = $listFinal .'/'.ucwords($art_othercategory);
                                    $this->data['keyskill_meta'] = trim($trimdata, ',');
                                   }
                                   else{ 
                                     $this->data['keyskill_meta'] = ucwords($art_othercategory);  
                                  }



$contition_array = array('not_read' => '2', 'not_to_id' => $userid, 'not_type !=' => '1', 'not_type !=' => '2');
$result = $this->common->select_data_by_condition('notification', $contition_array, $data = 'count(*) as total', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
$this->data['user_notification_count'] = $count = $result[0]['total'];

$this->data['head'] = $this->load->view('head', $this->data, true);
$this->data['header'] = $this->load->view('header', $this->data, true);
$this->data['footer'] = $this->load->view('footer', $this->data, true);
$this->data['left_footer'] = $this->load->view('leftfooter', $this->data,TRUE);
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

$this->data['login_footer'] = $this->load->view('login_footer', $this->data, TRUE);
?>
