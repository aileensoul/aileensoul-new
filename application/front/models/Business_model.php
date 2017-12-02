<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Business_model extends CI_Model {

    function getBusinessDataBySlug($business_slug='',$select_data='*'){
        $this->db->select($select_data)->from('business_profile');
        $this->db->where("business_slug='$business_slug'");
        $query = $this->db->get();
        $result_array = $query->row_array();
        return $result_array;
    }
    
    function getBusinessTypeName($business_type=''){
        $business_name = $this->db->select('business_name')->get_where('business_type',array('type_id' => $business_type, 'status'=> '1', 'is_delete' => '0'))->row('business_name');
        return $business_name;
    }
    
    function getIndustriyalName($industriyal=''){
        $industriyal_name = $this->db->select('industry_name')->get_where('industry_type',array('industry_id' => $industriyal, 'status'=> '1', 'is_delete' => '0'))->row('industry_name');
        return $industriyal_name;
    }

}
