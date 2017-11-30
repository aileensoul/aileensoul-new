<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Message_model extends CI_Model {

    public function get_business_user_list() {
        $this->db->select('business_profile_id,company_name,business_user_image,user_id')->from('business_profile');
        $this->db->where(array('status' => '1','business_step'=> '4'));
        $query = $this->db->get();
        return $query->result_array();
    }
}
