<?php 

$userid = $this->session->userdata('aileenuser');
$this->data['userdata'] = $this->user_model->getUserSelectedData($userid, $select_data = 'u.first_name,u.last_name,ul.email,ui.user_image,u.user_id,ui.profile_background,ui.profile_background_main');

$select_data='profile_background,username,fullname,freelancer_hire_user_image,profile_background,profile_background_main,designation,freelancer_hire_slug,free_hire_step';
$this->data['freehiredata'] = $this->freelancer_hire_model->getfreelancerhiredata($userid, $select_data);

$this->data['header'] = $this->load->view('header', $this->data, true);
$this->data['footer'] = $this->load->view('footer', $this->data, true);
$this->data['login_footer'] = $this->load->view('login_footer', $this->data, TRUE);
$this->data['left_footer'] = $this->load->view('leftfooter', $this->data, TRUE);

$this->data['freelancer_hire_search'] = $this->load->view('freelancer/freelancer_hire/freelancer_hire_search', $this->data, true);
$this->data['freelancer_hire_header2_border'] = $this->load->view('freelancer/freelancer_hire/freelancer_hire_header2_border', $this->data, true);

if ($this->uri->segment(2) == 'project') {
    $segment3 = explode('-', $this->uri->segment(3));
    $slugdata = array_reverse($segment3);
    $postid = $slugdata[0];
    $this->data['recliveid'] = $userid = $slugdata[1];
    $this->data['postid'] = $postid;

    $join_str[0]['table'] = 'freelancer_hire_reg';
    $join_str[0]['join_table_id'] = 'freelancer_hire_reg.user_id';
    $join_str[0]['from_table_id'] = 'freelancer_post.user_id';
    $join_str[0]['join_type'] = '';

    $contition_array = array('post_id' => $postid, 'freelancer_post.is_delete' => '0', 'freelancer_hire_reg.user_id' => $userid, 'freelancer_hire_reg.status' => '1', 'freelancer_hire_reg.free_hire_step' => '3');
    $data = 'freelancer_post.post_id,freelancer_post.post_name,freelancer_post.post_field_req,freelancer_post.post_description,freelancer_post.user_id,freelancer_post.post_currency,freelancer_post.post_rate';
    $this->data['projectdata'] = $this->common->select_data_by_condition('freelancer_post', $contition_array, $data, $sortby = 'freelancer_post.post_id', $orderby = 'desc', $limit = '', $offset = '', $join_str, $groupby = '');

    $fieldname = $this->data['fieldname'] = $this->db->select('category_name')->get_where('category', array('category_id' => $this->data['projectdata'][0]['post_field_req']))->row()->category_name;
    $currencyname = $this->data['currencyname'] = $this->db->select('currency_name')->get_where('currency', array('currency_id' => $this->data['projectdata'][0]['post_currency']))->row()->currency_name;
}

if ($this->uri->segment(2) == 'employer-details') {
    if (is_numeric($this->uri->segment(3))) {
        $id = $this->uri->segment(3);
    } else {
        $id = $category = $this->db->select('user_id')->get_where('freelancer_hire_reg', array('freelancer_hire_slug' => $this->uri->segment(3), 'status' => '1'))->row()->user_id;
    }
    
    $contition_array = array('user_id' => $id, 'is_delete' => '0', 'status' => '1');
    $data = "username,fullname";
    $employerdata = $this->data['employerdata'] = $this->common->select_data_by_condition('freelancer_hire_reg', $contition_array, $data, $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
    
    

}
$this->data['head'] = $this->load->view('head', $this->data, true);

?>

