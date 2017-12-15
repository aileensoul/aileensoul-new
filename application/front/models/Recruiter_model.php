<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Recruiter_model extends CI_Model {

    function getJObDataBySlug($job_slug='',$select_data='*'){ 
        $this->db->select($select_data)->from('job_reg');
        $this->db->where("slug='$job_slug'");
        $query = $this->db->get();
        $result_array = $query->row_array();
        return $result_array;
    }
    
//     function getBusinessTypeName($business_type=''){
//        $business_name = $this->db->select('business_name')->get_where('business_type',array('type_id' => $business_type, 'status'=> '1', 'is_delete' => '0'))->row('business_name');
//        return $business_name;
//    }
    
//    function getIndustriyalName($industriyal=''){
//        $industriyal_name = $this->db->select('industry_name')->get_where('industry_type',array('industry_id' => $industriyal, 'status'=> '1', 'is_delete' => '0'))->row('industry_name');
//        return $industriyal_name;
//    }
    
    public function getRecruiterUserChat() {
        $recruiter_profile_id = $this->data['recruiter_login_profile_id'];

        $recruiter_id = $_POST['recruiter_id'];
        $user_data = $this->business_model->getBusinessDataBySlug($business_slug, $select_data = "business_profile_id,company_name,business_user_image,other_business_type,other_industrial,business_type,industriyal,business_slug");
        if ($user_data['business_type'] != '' || $user_data['business_type'] != 'null') {
            $user_data['business_type'] = $this->business_model->getBusinessTypeName($user_data['business_type']);
        }
        if ($user_data['industriyal'] != '' || $user_data['industriyal'] != 'null') {
            $user_data['industriyal'] = $this->business_model->getIndustriyalName($user_data['industriyal']);
        }
        $user_data['chat'] = $this->message_model->getBusinessChat($business_profile_id, $user_data['business_profile_id']);
        echo json_encode($user_data);
    }

}
